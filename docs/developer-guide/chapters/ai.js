// ============================================================
// chapters/ai.js — Honcho AI chapter of the Honcho Developer's Guide
// ============================================================
// Part II: Add-ons. Started 2026-10-29 with phase 0 of the AI plan
// (https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt). Update it as each
// phase is built. Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Overview", blocks: [
  { type: 'p', text: "Honcho AI is an add-on module (`modules/ai/`, `system_modules` code `ai`, off until switched on on the Security Groups Modules panel). It calls an AI provider's API from PHP, so it runs on every deployment tier. The plan has six phases: 0 groundwork, 1 the daily Coffee Report, 2 alerts, 3 the Honcho connector (read-only MCP server for Claude.ai and Hermes), 4 the built-in Ask EMS chat, 5 confirmed changes. **Phase 0 is built** (2026-10-29)." },
  { type: 'table', headers: ['Piece', 'Where', 'What it does'], rows: [
    ['Connections', '`ai_connections`, `ai/connections`, `ai/connection/{id}`', "One AI provider account per scope: National (`subentity_id` 0) and any chapter that brings its own. Provider, model, encrypted key, on/off, monthly limit, last test."],
    ['Vault', '`engine/tg_helpers/vault_helper.php`', "`vault_encrypt()` / `vault_decrypt()`: AES-256-GCM, key from `VAULT_KEY` in `.env` (or derived from `JWT_SECRET`). Only the key's last 4 characters (`credential_hint`) are stored readable."],
    ['Provider layer', '`engine/tg_helpers/ai_helper.php`', "`ai_send($conn, $system, $messages, $opts)` returns the same shape whichever provider answers. Anthropic through the official PHP SDK (`anthropic-ai/sdk`, loaded only inside the call). OpenAI comes when OpenAI approves Honcho for \"Sign in with ChatGPT\"."],
    ['Usage log', '`ai_requests`, `ai/usage`', "One row per call: scope, person, feature, model, tokens, estimated cost (`ai_model_prices()`), status. Feeds the usage page and the monthly limit."],
  ]},
]},

// ============================================================
{ tab: "Scopes and Permissions", blocks: [
  { type: 'ul', items: [
    "**Who uses which connection** (`ai_scope_for_session()`): staff, System Admins and Member Admins use National's; a Chapter Admin uses their chapter's own if it is on and has a key; otherwise `AI_CHAPTER_FALLBACK` (System Settings > Features & Policy) says use National's, or no AI.",
    "**Security Groups functions** (module `ai`, migration `2026-10-29-ai-phase0.sql`): `manage_national` (System Admins, Member System Admins), `manage_chapter` (Chapter Admins, their own chapter only, checked against `$_SESSION['ccmps_subentity']`), `use_ai` (System, Member System, Member and Chapter Admins), `view_usage` (System Admins, Member System Admins).",
    "**Subscriptions can't be used.** Anthropic allows Claude Free/Pro/Max login tokens only in Claude.ai and Claude Code, so a connection always takes an API key. Clients whose admins have Claude use the Honcho connector (phase 3) instead.",
  ]},
]},

// ============================================================
{ tab: "Safety", blocks: [
  { type: 'ul', items: [
    "Every change is a POST with `$_SESSION['ai_token']`, checked with `hash_equals`; the key is never shown again after it is entered, and never written to the Auditlog (only its last 4 characters).",
    "Auditlog actions: `SaveAIConnection`, `TestAIConnection`, `RemoveAIKey`. Remove key asks for a second click and switches the connection off.",
    "`ai_send()` stops before calling when the connection is off, has no readable key, or the scope's estimated spend this month has reached its limit (status `limit`). Set a spend limit in the provider's console too, as a backstop.",
    "Errors come back as plain sentences (refused key, no credit, rate limit, no outgoing HTTPS), caught most-specific first from `Anthropic\\Core\\Exceptions\\*`. A `refusal` stop reason is logged as `refused`.",
    "Changing `VAULT_KEY` (or `JWT_SECRET` while `VAULT_KEY` is blank) makes stored keys unreadable: `vault_decrypt()` returns '' and the screen asks for the key again.",
  ]},
  { type: 'alert', variant: 'info', text: "**PHP 8.2 and composer.** The SDK needs PHP 8.1+, so `composer.json`'s platform moved from 7.4 to 8.2 (2026-10-29) and `composer.lock` is now committed. The same update raised PHPMailer, PhpSpreadsheet and Guzzle by minor versions and phpunit to 9.6.38 (9.6.15 had a security advisory)." },
]},

];

module.exports = sections;
