-- ---------------------------------------------------------------------------
-- Coffee Report delivery by Telegram (owner, 2026-10-29), alongside email.
-- Each scope can name a Telegram bot (token stored encrypted with vault_encrypt();
-- only its last 4 characters readable) and a chat: one person, or a group of the
-- scope's admins. Email and Telegram are sent independently.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------
ALTER TABLE coffee_reports
  ADD COLUMN IF NOT EXISTS telegram_enabled    tinyint(1) NOT NULL DEFAULT 0 AFTER extra_recipients,
  ADD COLUMN IF NOT EXISTS telegram_token_enc  text NULL AFTER telegram_enabled,
  ADD COLUMN IF NOT EXISTS telegram_token_hint varchar(8) NULL AFTER telegram_token_enc,
  ADD COLUMN IF NOT EXISTS telegram_chat_id    varchar(64) NULL AFTER telegram_token_hint;

ALTER TABLE coffee_runs
  ADD COLUMN IF NOT EXISTS telegram_sent tinyint(1) NOT NULL DEFAULT 0 AFTER recipients;
