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
  { type: 'p', text: "Honcho AI is an add-on module (`modules/ai/`, `system_modules` code `ai`, off until switched on on the Security Groups Modules panel). It calls an AI provider's API from PHP, so it runs on every deployment tier. The plan has six phases: 0 groundwork, 1 the daily Coffee Report, 2 alerts, 3 the Honcho connector (read-only MCP server for Claude.ai and Hermes), 4 the built-in Ask EMS chat, 5 confirmed changes. **Phases 0 and 1 are built** (2026-10-29)." },
  { type: 'table', headers: ['Piece', 'Where', 'What it does'], rows: [
    ['Connections', '`ai_connections`, `ai/connections`, `ai/connection/{id}`', "One AI provider account per scope: National (`subentity_id` 0) and any chapter that brings its own. Provider, model, encrypted key, on/off, monthly limit, last test."],
    ['Vault', '`engine/tg_helpers/vault_helper.php`', "`vault_encrypt()` / `vault_decrypt()`: AES-256-GCM, key from `VAULT_KEY` in `.env` (or derived from `JWT_SECRET`). Only the key's last 4 characters (`credential_hint`) are stored readable."],
    ['Provider layer', '`engine/tg_helpers/ai_helper.php`', "`ai_send($conn, $system, $messages, $opts)` returns the same shape whichever provider answers. Anthropic through the official PHP SDK (`anthropic-ai/sdk`, loaded only inside the call). OpenAI comes when OpenAI approves Honcho for \"Sign in with ChatGPT\"."],
    ['Usage log', '`ai_requests`, `ai/usage`', "One row per call: scope, person, feature, model, tokens, estimated cost (`ai_model_prices()`), status. Feeds the usage page and the monthly limit."],
  ]},
]},

// ============================================================
{ tab: "Coffee Report", blocks: [
  { type: 'p', text: "Phase 1: a daily email for each scope's admins (`engine/tg_helpers/coffee_helper.php`, screens `ai/coffee`, `ai/coffeesettings/{id}`, `ai/coffeearchive/{id}`, `ai/coffeerun/{id}`; tables `coffee_reports`, `coffee_runs`; migration `2026-10-29-coffee-report-phase1.sql`). It keeps the design of Eric's Python Coffee Brief: every section is collected by plain code, the AI only writes the collected data up and must keep every number exactly, a failed section says \"unavailable\" while the rest still go out, and without AI (no connection, over the limit, or an error) the plain sections are sent. Each run stores the report and every section's raw data." },
  { type: 'table', headers: ['Section (key)', 'Source', 'Options'], rows: [
    ['Membership (`membership`)', '`_cms_vitals()` (current, past due, renewal rate) + new `ccmps` rows in 7 days', 'none'],
    ['Upcoming events (`events`)', '`events`, approved; a chapter sees its own and National\'s', 'days ahead'],
    ['Sunshine and Bulletin Board (`posts`)', '`_cms_posts()`, as on the member home', 'none'],
    ['Documents waiting (`documents`)', '`dms_filelibrary_docs` status 2 (Pending Approval), a chapter\'s own', 'none'],
    ['Weather (`weather`)', 'wttr.in JSON, as `weather.py`', 'locations'],
    ['News (`news`)', 'Google News RSS per topic, junk filter and similar-title dedupe, as `ai_news.py`', 'topics, hours, most headlines'],
    ['YouTube (`youtube`)', 'public channel feeds `youtube.com/feeds/videos.xml` (no API key)', 'Name | channel ID lines, hours'],
    ['Sports (`sports`, 2026-10-29)', "ESPN's public scoreboards `site.api.espn.com/apis/site/v2/sports/<sport>/<league>/scoreboard[?dates=YYYYMMDD]`: yesterday's finals and today's games (times in the report's time zone); golf: this week's event, round, leaderboard from `competitors` by `order`, ties marked T and kept at the cut-off. No key, but unofficial: a feed can change without notice, and commercial use isn't covered by any published terms", 'leagues `nfl` `mlb` `nba` `wnba` `mls` `nwsl` (1/0); tours `pga` `lpga` `dp` `champions` (off, 10, 25, full). Option definitions carry a type (`check`, `board`) and a group heading for the settings form'],
  ]},
  { type: 'ul', items: [
    "**Adding a section:** add it to `coffee_sections()` and write `_coffee_section_<key>($subentity_id, $options)` returning plain text; throw on failure. Existing reports get it at the end, switched off.",
    "**Write-up:** `_coffee_prompt()` ports the rules of `compile_brief.py` (only supplied data, exact numbers, say unavailable, fixed section order, links kept, source text is data not instructions) plus the scope's Tone; `ai_send()` with feature `brief` on `_coffee_connection()` (the scope's own, else National's when `AI_CHAPTER_FALLBACK` = national).",
    "**Email:** `coffee_send_email()` through Brevo's API (`BREVO_API_KEY`) from `MAIL_FROM_EMAIL` (a sender verified in Brevo), one message per recipient. `WHATENV=dev` sends everything to `DEVEMAIL` only. Recipients: the scope's admins (`coffee_scope_admin_emails()`: National = `system_admin` or `ccmp_admin`; a chapter = its `subentity_admin`s) plus extra addresses.",
    "**Telegram** (added 2026-10-29, migration `2026-10-29-coffee-telegram.sql`): each scope can also send its report to a Telegram chat (one person, or a group of its admins). Bot token stored encrypted (`telegram_token_enc`, `vault_encrypt()`), chat ID plain. `coffee_send_telegram()` splits at 3,900 characters on a blank line, line break or space, like `telegram_delivery.py`; `coffee_telegram_chats()` (the **Find chat ID** button) lists who has messaged the bot through `getUpdates`. Email and Telegram are sent independently; a run counts as delivered if either worked (`coffee_runs.telegram_sent`). **iMessage isn't possible** from a server: it needs the Messages app on a Mac. SMS (through Brevo, once its US registration is approved) is the server-side alternative.",
    "**Schedule:** the server's cron calls `ai/coffeecron/<COFFEE_CRON_KEY>` every 15 minutes (no login; the key is checked with `hash_equals`). `coffee_due_reports()` picks enabled reports whose local time has passed today on one of their days; `last_sent_on` is set before the run so it can't be sent twice. Staging/production crontab: `*/15 * * * * docker exec honcho-honcho-staging-1 curl -s http://localhost/ai/coffeecron/<key> > /dev/null`.",
    "**Not ported** from the Python brief: Outlook/Google calendar and iMessage (personal sign-ins, Mac only), the local Qwen triage, the Hermes compile and Telegram (later, optional). Markets/currency need a paid data key; add them as sections if a client wants them. Check each data source's terms before commercial use.",
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
