<?php
/**
 * Honcho AI (plan 2026-10-29, https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt),
 * phase 0: connections by scope, the provider layer and the usage log.
 *
 * Scope: National (subentity_id 0) or a chapter (ccmps_subentities.id). System
 * and Member Admins use National's connection; a Chapter Admin uses their
 * chapter's own, or, when it has none, what AI_CHAPTER_FALLBACK says (National's,
 * or none). Keys are stored encrypted (vault_helper.php).
 *
 * Provider layer: everything above it (briefs, alerts, chat, tools, Auditlog)
 * calls ai_send() and gets the same answer shape back whichever company
 * answers. Anthropic first (official PHP SDK, vendor/anthropic-ai/sdk); OpenAI
 * (organization key, or each admin's "Sign in with ChatGPT") once OpenAI
 * approves Honcho. Claude Pro/Max/Team subscription logins can't be used:
 * Anthropic allows them only in Claude.ai and Claude Code.
 *
 *   ai_providers()                         provider => label, models
 *   ai_model_prices()                      model => [input, output, cache read] US$ per million tokens
 *   ai_connection($subentity_id)           that scope's row, or false
 *   ai_scope_for_session()                 [subentity_id, 'own'|'national'|'none'] for the person logged in
 *   ai_month_spend($subentity_id)          US$ spent this calendar month by a scope
 *   ai_send($conn, $system, $messages, $opts)  one call; returns ['ok', 'text', 'message', ...] and logs it
 *   ai_test_connection($conn)              a tiny call; saves and returns the result
 *   ai_log(...)                            one ai_requests row
 */

function ai_providers(): array {
    return array(
        'anthropic' => array('label' => 'Anthropic (Claude)', 'available' => true,
                             'models' => array('claude-opus-5-5' => 'Claude Opus 5.5 (default)', 'claude-sonnet-5-5' => 'Claude Sonnet 5.5', 'claude-haiku-5-5' => 'Claude Haiku 5.5')),
        'openai'    => array('label' => 'OpenAI (ChatGPT) - coming once OpenAI approves Honcho', 'available' => false, 'models' => array()),
    );
}

function ai_model_prices(): array {
    // Anthropic list prices, US$ per million tokens: input, output, cache read (from the API docs, 2026-10).
    // Used only to estimate cost for the usage page and limits; the provider's bill is the real figure.
    return array(
        'claude-opus-5-5'   => array(4.00, 20.00, 0.20),
        'claude-sonnet-5-5' => array(2.00, 10.00, 0.20),
        'claude-haiku-5-5'  => array(0.10,  0.50, 0.01),
    );
}

function _ai_cost(string $model, int $in, int $out, int $cache_read): float {
    $p = ai_model_prices()[$model] ?? array(4.00, 20.00, 0.20);
    return ($in * $p[0] + $out * $p[1] + $cache_read * $p[2]) / 1000000;
}

function ai_connection(int $subentity_id) {
    $model = new Model();
    $rows  = $model->query_bind('SELECT * FROM ai_connections WHERE subentity_id = :s LIMIT 1', array('s' => $subentity_id), 'object');
    return $rows[0] ?? false;
}

function ai_scope_for_session(): array {
    // National admins (System Admins, staff sysadmins, Member Admins) use National's connection;
    // a Chapter Admin uses their chapter's, else AI_CHAPTER_FALLBACK decides.
    $national = !empty($_SESSION['honcho_logged_in']) || !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_ccmp_admin']);
    if ($national) {
        return array(0, 'national');
    }
    $chapter = (int) ($_SESSION['ccmps_subentity'] ?? 0);
    $own     = $chapter > 0 ? ai_connection($chapter) : false;
    if ($own && $own->enabled && $own->credential_enc) {
        return array($chapter, 'own');
    }
    return setting('AI_CHAPTER_FALLBACK', 'national') === 'national' ? array(0, 'national') : array($chapter, 'none');
}

function ai_month_spend(int $subentity_id): float {
    $model = new Model();
    $rows  = $model->query_bind('SELECT COALESCE(SUM(cost), 0) AS spent FROM ai_requests WHERE subentity_id = :s AND created_at >= :start',
                                array('s' => $subentity_id, 'start' => mktime(0, 0, 0, (int) date('n'), 1)), 'object');
    return (float) ($rows[0]->spent ?? 0);
}

function ai_log(object $conn, string $feature, string $model, int $in, int $out, int $cache_read, string $status, string $message = ''): void {
    $db = new Model();
    $db->insert(array(
        'connection_id'     => (int) $conn->id,
        'subentity_id'      => (int) $conn->subentity_id,
        'tg_user_id'        => (int) ($_SESSION['tg_user_id'] ?? 0),
        'feature'           => substr($feature, 0, 32),
        'provider'          => (string) $conn->provider,
        'model'             => $model,
        'input_tokens'      => $in,
        'output_tokens'     => $out,
        'cache_read_tokens' => $cache_read,
        'cost'              => round(_ai_cost($model, $in, $out, $cache_read), 6),
        'status'            => $status,
        'message'           => substr($message, 0, 255),
        'created_at'        => time(),
    ), 'ai_requests');
    if ($status === 'ok') {
        $db->update((int) $conn->id, array('last_used_at' => time()), 'ai_connections');
    }
}

/**
 * One call to the scope's AI. $messages are [['role' => 'user'|'assistant', 'content' => '...'], ...].
 * $opts: feature (for the log), max_tokens, effort (low|medium|high).
 * Returns ['ok' => bool, 'text' => answer, 'message' => error for people, 'input_tokens', 'output_tokens'].
 * Stops before calling when the connection is off, has no key, or the scope's monthly limit is reached.
 */
function ai_send(object $conn, string $system, array $messages, array $opts = array()): array {
    $feature = (string) ($opts['feature'] ?? 'chat');
    $fail    = function (string $status, string $msg) use ($conn, $feature) {
        ai_log($conn, $feature, (string) $conn->model, 0, 0, 0, $status, $msg);
        return array('ok' => false, 'text' => '', 'message' => $msg, 'input_tokens' => 0, 'output_tokens' => 0);
    };

    if (!$conn->enabled) {
        return $fail('error', 'This AI connection is switched off.');
    }
    $key = vault_decrypt($conn->credential_enc);
    if ($key === '') {
        return $fail('error', 'No API key is saved for this connection (or it can no longer be read). Enter it again.');
    }
    $limit = (float) $conn->monthly_limit;
    if ($limit > 0 && ai_month_spend((int) $conn->subentity_id) >= $limit) {
        return $fail('limit', 'This month\'s AI limit of $'.number_format($limit, 2).' has been reached.');
    }

    switch ($conn->provider) {
        case 'anthropic':
            return _ai_send_anthropic($conn, $key, $system, $messages, $opts, $feature, $fail);
        default:
            return $fail('error', 'This AI provider isn\'t available yet.');
    }
}

function _ai_send_anthropic(object $conn, string $key, string $system, array $messages, array $opts, string $feature, callable $fail): array {
    require_once APPPATH.'vendor/autoload.php'; // composer libraries are loaded only where needed

    try {
        $client  = new \Anthropic\Client(apiKey: $key);
        $message = $client->messages->create(
            model: (string) $conn->model,
            maxTokens: (int) ($opts['max_tokens'] ?? 16000),
            system: $system,
            messages: $messages,
            outputConfig: array('effort' => (string) ($opts['effort'] ?? 'medium')),
        );
    } catch (\Anthropic\Core\Exceptions\AuthenticationException $e) {
        return $fail('error', 'The API key was refused. Check it in the Anthropic Console and enter it again.');
    } catch (\Anthropic\Core\Exceptions\PermissionDeniedException $e) {
        return $fail('error', 'The API key isn\'t allowed to use this model.');
    } catch (\Anthropic\Core\Exceptions\NotFoundException $e) {
        return $fail('error', 'The model wasn\'t found. Choose another model for this connection.');
    } catch (\Anthropic\Core\Exceptions\RateLimitException $e) {
        return $fail('error', 'The AI provider is busy or this account\'s limit was reached. Try again in a minute.');
    } catch (\Anthropic\Core\Exceptions\APIStatusException $e) {
        $type = $e->type->value ?? '';
        return $fail('error', $type === 'billing_error' ? 'The AI provider account needs credit or a payment method.' : 'The AI provider returned an error ('.($type ?: 'unknown').').');
    } catch (\Anthropic\Core\Exceptions\APIConnectionException $e) {
        return $fail('error', 'Honcho couldn\'t reach the AI provider. Check that this server may make outgoing HTTPS calls.');
    } catch (\Throwable $e) {
        return $fail('error', 'The AI call failed: '.substr($e->getMessage(), 0, 150));
    }

    $in    = (int) ($message->usage->inputTokens ?? 0);
    $out   = (int) ($message->usage->outputTokens ?? 0);
    $cache = (int) ($message->usage->cacheReadInputTokens ?? 0);

    if ($message->stopReason === 'refusal') {
        ai_log($conn, $feature, (string) $conn->model, $in, $out, $cache, 'refused', 'The AI declined this request.');
        return array('ok' => false, 'text' => '', 'message' => 'The AI declined this request.', 'input_tokens' => $in, 'output_tokens' => $out);
    }

    $text = '';
    foreach ($message->content as $block) {
        if ($block->type === 'text') {
            $text .= $block->text;
        }
    }
    ai_log($conn, $feature, (string) $conn->model, $in, $out, $cache, 'ok');
    return array('ok' => true, 'text' => $text, 'message' => '', 'input_tokens' => $in, 'output_tokens' => $out);
}

function ai_test_connection(object $conn): array {
    $result = ai_send($conn, 'You are checking that an API connection works.', array(array('role' => 'user', 'content' => 'Reply with the single word OK.')),
                      array('feature' => 'test', 'max_tokens' => 1024, 'effort' => 'low'));
    $msg = $result['ok'] ? 'Connected: the AI answered.' : $result['message'];
    $db  = new Model();
    $db->update((int) $conn->id, array('last_test_at' => time(), 'last_test_ok' => $result['ok'] ? 1 : 0, 'last_test_msg' => substr($msg, 0, 255)), 'ai_connections');
    return array('ok' => $result['ok'], 'message' => $msg);
}
