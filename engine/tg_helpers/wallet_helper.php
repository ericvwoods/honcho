<?php
/*
  Wallet helper - Google Wallet for the digital membership cards (plan 2026-10-26,
  phase 3). Apple Wallet comes later. Uses PHP's own OpenSSL and cURL: no packages.

  Settings (.env): GOOGLE_WALLET_ISSUER_ID, GOOGLE_WALLET_KEY_FILE (the service account
  JSON key, kept outside the project, never committed), GOOGLE_WALLET_LOGO_URL (optional:
  a public https logo Google can fetch), GOOGLE_WALLET_PREFIX (optional: keeps this
  install's card ids apart from other installs on the same issuer; default from BASE_URL).

  gwallet_configured()                  issuer id and key file present?
  gwallet_save_url($card, $details)     creates or refreshes the card's Wallet object; the
                                        "Add to Google Wallet" address (or throws)
  gwallet_deactivate($card)             a cancelled card: its Wallet object becomes INACTIVE
        _gwallet_ensure_class()         the shared card template (genericClass), made once
        _gwallet_object($card, $details) the Wallet object for one card
        _gwallet_request($method, $path, $body)   REST call -> [status, decoded body]
        _gwallet_token()                OAuth access token for the service account
        _gwallet_jwt($claims)           RS256-signed JWT with the service account key
        _gwallet_key()                  the key file, read once
        _gwallet_hex($color)            a CSS color name or #hex -> #rrggbb for Google

  Card objects: <issuer>.<prefix>_card_<card id>, one per ccmps_cards row
  (google_object_id). Template: <issuer>.member_card. Demo mode: only the test
  accounts set in the Wallet console can save cards until publishing is approved.
*/

function gwallet_configured(): bool {
    $file = (string) env('GOOGLE_WALLET_KEY_FILE', '');
    return env('GOOGLE_WALLET_ISSUER_ID', '') !== '' && $file !== '' && is_readable($file);
}

function _gwallet_key(): array {
    static $key = null;
    if ($key === null) {
        $key = json_decode((string) @file_get_contents((string) env('GOOGLE_WALLET_KEY_FILE', '')), true);
        if (!is_array($key) || empty($key['client_email']) || empty($key['private_key'])) {
            throw new RuntimeException('Google Wallet key file is missing or not a service account key.');
        }
    }
    return $key;
}

function _gwallet_b64(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function _gwallet_jwt(array $claims): string {
    $key   = _gwallet_key();
    $input = _gwallet_b64(json_encode(array('alg' => 'RS256', 'typ' => 'JWT'))).'.'._gwallet_b64(json_encode($claims));
    if (!openssl_sign($input, $signature, $key['private_key'], OPENSSL_ALGO_SHA256)) {
        throw new RuntimeException('Google Wallet: could not sign with the key.');
    }
    return $input.'.'._gwallet_b64($signature);
}

function _gwallet_token(): string {
    static $token = null, $expires = 0;
    if ($token !== null && time() < $expires - 60) {
        return $token;
    }
    $key = _gwallet_key();
    $now = time();
    $jwt = _gwallet_jwt(array('iss' => $key['client_email'], 'scope' => 'https://www.googleapis.com/auth/wallet_object.issuer',
                              'aud' => 'https://oauth2.googleapis.com/token', 'iat' => $now, 'exp' => $now + 3600));
    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt_array($ch, array(CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15,
        CURLOPT_POSTFIELDS => http_build_query(array('grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer', 'assertion' => $jwt))));
    $body = json_decode((string) curl_exec($ch), true);
    curl_close($ch);
    if (empty($body['access_token'])) {
        throw new RuntimeException('Google Wallet: sign-in failed ('.($body['error_description'] ?? $body['error'] ?? 'no answer').').');
    }
    $token   = $body['access_token'];
    $expires = $now + (int) ($body['expires_in'] ?? 3600);
    return $token;
}

function _gwallet_request(string $method, string $path, ?array $body = null): array {
    $ch = curl_init('https://walletobjects.googleapis.com/walletobjects/v1/'.$path);
    $opts = array(CURLOPT_CUSTOMREQUEST => $method, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 20,
                  CURLOPT_HTTPHEADER => array('Authorization: Bearer '._gwallet_token(), 'Content-Type: application/json'));
    if ($body !== null) {
        $opts[CURLOPT_POSTFIELDS] = json_encode($body);
    }
    curl_setopt_array($ch, $opts);
    $raw    = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($status, json_decode((string) $raw, true));
}

function _gwallet_fail(string $what, int $status, $body): void {
    $msg = is_array($body) ? ($body['error']['message'] ?? '') : '';
    if ($status == 403) {
        $msg = 'the service account has no access to this issuer. In the Wallet console, add it under Users as a Developer. '.$msg;
    }
    throw new RuntimeException('Google Wallet: '.$what.' failed ('.$status.') '.$msg);
}

function _gwallet_ids(): array {
    $issuer = (string) env('GOOGLE_WALLET_ISSUER_ID', '');
    $prefix = (string) env('GOOGLE_WALLET_PREFIX', '');
    if ($prefix === '') { // e.g. localhost, uat_bpapilots_org: Mac, staging and production never share card ids
        $prefix = preg_replace('/[^a-z0-9]+/', '_', strtolower((string) parse_url(BASE_URL, PHP_URL_HOST)));
    }
    return array($issuer, trim($prefix, '_'));
}

function _gwallet_ensure_class(): string {
    static $done = null;
    list($issuer) = _gwallet_ids();
    $class_id = $issuer.'.member_card';
    if ($done === $class_id) {
        return $class_id;
    }
    list($status, $body) = _gwallet_request('GET', 'genericClass/'.rawurlencode($class_id));
    if ($status == 404) {
        list($status, $body) = _gwallet_request('POST', 'genericClass', array('id' => $class_id));
    }
    if ($status < 200 || $status >= 300) {
        _gwallet_fail('the card template', $status, $body);
    }
    $done = $class_id;
    return $class_id;
}

function _gwallet_hex(string $color): string {
    $names = array('darkgreen' => '#006400', 'black' => '#000000', 'lightseagreen' => '#20b2aa', 'crimson' => '#dc143c',
                   'coral' => '#ff7f50', 'gray' => '#808080', 'grey' => '#808080', 'lightgray' => '#d3d3d3');
    $color = strtolower(trim($color));
    if (preg_match('/^#[0-9a-f]{6}$/', $color)) {
        return $color;
    }
    return $names[$color] ?? '#1f3a5f';
}

function _gwallet_object(object $card, object $details, string $object_id, string $class_id): array {
    $text = function ($value) { return array('defaultValue' => array('language' => 'en-US', 'value' => (string) $value)); };
    $modules = array();
    foreach (array('number' => array($details->member_word.' No.', $details->member_number),
                   'chapter' => array(SUBENTITY, $details->chapter),
                   'type' => array($details->member_word.' type', $details->member_type),
                   'valid' => array('Valid through', $details->valid_through)) as $id => $pair) {
        if (trim((string) $pair[1]) !== '') {
            $modules[] = array('id' => $id, 'header' => $pair[0], 'body' => (string) $pair[1]);
        }
    }
    $object = array(
        'id'                 => $object_id,
        'classId'            => $class_id,
        'state'              => $card->status == 'active' ? 'ACTIVE' : 'INACTIVE',
        'cardTitle'          => $text($details->org_name),
        'subheader'          => $text($details->member_word),
        'header'             => $text($details->name),
        'textModulesData'    => $modules,
        'barcode'            => array('type' => 'QR_CODE', 'value' => card_code($card), 'alternateText' => $details->member_number),
        'hexBackgroundColor' => _gwallet_hex(CCMPS_CRUD_LABEL_CLR),
    );
    $logo = (string) env('GOOGLE_WALLET_LOGO_URL', '');
    if (preg_match('#^https://#', $logo)) {
        $object['logo'] = array('sourceUri' => array('uri' => $logo), 'contentDescription' => $text($details->org_short.' logo'));
    }
    return $object;
}

function gwallet_save_url(object $card, object $details): string {
    if (!gwallet_configured()) {
        throw new RuntimeException('Google Wallet is not set up on this site.');
    }
    $class_id = _gwallet_ensure_class();
    list($issuer, $prefix) = _gwallet_ids();
    $object_id = $issuer.'.'.$prefix.'_card_'.(int) $card->id;
    $object    = _gwallet_object($card, $details, $object_id, $class_id);

    // create it, or refresh it with the member's current details (chapter, year, ...)
    list($status, $body) = _gwallet_request('PUT', 'genericObject/'.rawurlencode($object_id), $object);
    if ($status == 404) {
        list($status, $body) = _gwallet_request('POST', 'genericObject', $object);
    }
    if ($status < 200 || $status >= 300) {
        _gwallet_fail('the card', $status, $body);
    }
    if ((string) $card->google_object_id !== $object_id) {
        (new Model())->update((int) $card->id, array('google_object_id' => $object_id), 'ccmps_cards');
    }

    $key = _gwallet_key();
    $jwt = _gwallet_jwt(array('iss' => $key['client_email'], 'aud' => 'google', 'typ' => 'savetowallet', 'iat' => time(),
                              'payload' => array('genericObjects' => array(array('id' => $object_id, 'classId' => $class_id)))));
    return 'https://pay.google.com/gp/v/save/'.$jwt;
}

function gwallet_deactivate(object $card): void {
    if (!gwallet_configured() || empty($card->google_object_id)) {
        return;
    }
    try {
        _gwallet_request('PATCH', 'genericObject/'.rawurlencode($card->google_object_id), array('state' => 'INACTIVE'));
    } catch (Throwable $e) {
        error_log('gwallet_deactivate: '.$e->getMessage()); // the door check refuses the old code anyway
    }
}
