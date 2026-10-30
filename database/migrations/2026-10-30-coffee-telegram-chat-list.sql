-- ---------------------------------------------------------------------------
-- Coffee Report: a list of Telegram chat IDs per report, one per line (owner, 2026-10-30).
-- Each person on the list gets their own copy (each must press Start on the bot once);
-- a group's ID (starting with -) can be one of the lines. Safe to run more than once.
-- ---------------------------------------------------------------------------

ALTER TABLE coffee_reports MODIFY telegram_chat_id text NULL;
