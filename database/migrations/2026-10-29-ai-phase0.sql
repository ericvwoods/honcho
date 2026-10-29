-- ---------------------------------------------------------------------------
-- Honcho AI module, phase 0: groundwork (AI plan 2026-10-29,
-- https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt).
--
--   system_modules 'ai'   add-on, OFF until switched on on the Security Groups
--                         Modules panel
--   ai_connections        one AI connection per scope: National (subentity_id 0)
--                         and each chapter that brings its own. The API key is
--                         stored encrypted (vault_helper.php); only its last 4
--                         characters are kept readable, to show which key it is.
--   ai_requests           one row per call to the AI: who, which scope, which
--                         feature, tokens, cost. Feeds the usage page and limits.
--   Security Groups functions (module 'ai'):
--     manage_national  set up National's connection   System Admins, Member System Admins
--     manage_chapter   set up their chapter's          Chapter Admins
--     use_ai           use the AI features             System, Member System, Member, Chapter Admins
--     view_usage       see AI usage                    System Admins, Member System Admins
--   AI_CHAPTER_FALLBACK  (System Settings > Features & Policy) a chapter with no
--                         connection of its own: use National's, or no AI.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

INSERT IGNORE INTO system_modules (code, title, is_addon, enabled, sort_order, created_at)
VALUES ('ai', 'AI assistant (Honcho AI)', 1, 0, 60, UNIX_TIMESTAMP());

CREATE TABLE IF NOT EXISTS ai_connections (
  id               int unsigned NOT NULL AUTO_INCREMENT,
  subentity_id     int NOT NULL DEFAULT 0,             -- 0 = National, else ccmps_subentities.id
  provider         varchar(20) NOT NULL DEFAULT 'anthropic',
  model            varchar(64) NOT NULL DEFAULT 'claude-opus-5-5',
  credential_enc   text NULL,                          -- vault_encrypt() of the API key
  credential_hint  varchar(8) NULL,                    -- last 4 characters, to recognize the key
  enabled          tinyint(1) NOT NULL DEFAULT 1,
  monthly_limit    decimal(8,2) NOT NULL DEFAULT 0.00, -- US dollars a month; 0 = no limit
  last_test_at     int NULL,
  last_test_ok     tinyint(1) NULL,
  last_test_msg    varchar(255) NULL,
  last_used_at     int NULL,
  created_by       int DEFAULT 0,
  created_at       int DEFAULT 0,
  updated_by       int DEFAULT 0,
  updated_at       int DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY subentity (subentity_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS ai_requests (
  id                 int unsigned NOT NULL AUTO_INCREMENT,
  connection_id      int unsigned NOT NULL,
  subentity_id       int NOT NULL DEFAULT 0,           -- the scope that paid: 0 = National
  tg_user_id         int NOT NULL DEFAULT 0,           -- who asked (0 = scheduled job)
  feature            varchar(32) NOT NULL,             -- test, brief, alert, chat, change
  provider           varchar(20) NOT NULL,
  model              varchar(64) NOT NULL,
  input_tokens       int NOT NULL DEFAULT 0,
  output_tokens      int NOT NULL DEFAULT 0,
  cache_read_tokens  int NOT NULL DEFAULT 0,
  cost               decimal(10,6) NOT NULL DEFAULT 0, -- US dollars, from ai_model_prices()
  status             varchar(12) NOT NULL DEFAULT 'ok',-- ok, error, refused, limit
  message            varchar(255) NULL,
  created_at         int NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY scope_month (subentity_id, created_at),
  KEY connection (connection_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'manage_national', 'Set up National''s AI connection', 'Enter, test and remove National''s AI key; used by System and Member Admins', 10, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'ai';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'manage_chapter', 'Set up own chapter''s AI connection', 'Enter, test and remove their chapter''s own AI key', 20, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'ai';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'use_ai', 'Use the AI assistant', 'Daily brief, alerts and chat, on their scope''s connection', 30, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'ai';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'view_usage', 'See AI usage', 'Usage and cost by National and chapter', 40, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'ai';

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_modules m   ON m.code = 'ai'
  JOIN system_functions f ON f.module_id = m.id
 WHERE (g.title IN ('System Admins', 'Member System Admins') AND f.code IN ('manage_national', 'use_ai', 'view_usage'))
    OR (g.title = 'Member Admins'  AND f.code = 'use_ai')
    OR (g.title = 'Chapter Admins' AND f.code IN ('manage_chapter', 'use_ai'));

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at)
VALUES ('AI_CHAPTER_FALLBACK', 'Chapters without their own AI', 'national', 'varchar', 'Features & Policy', 'select',
        'national=Use National''s AI connection;none=No AI (plain numbers only)', 'edit_settings', 'AI_CHAPTER_FALLBACK',
        'When a chapter hasn''t set up its own AI connection: its admins use National''s (National pays), or get no AI.', 90, UNIX_TIMESTAMP());
