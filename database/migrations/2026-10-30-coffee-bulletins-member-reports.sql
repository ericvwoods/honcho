-- ---------------------------------------------------------------------------
-- Coffee Report bulletins and member Coffee Reports (owner, 2026-10-30).
--
-- coffee_bulletins: a message printed word for word at the top of Coffee Reports.
--   subentity_id 0 = National (every report); a chapter's = that chapter's admin
--   report and its members' reports. audience: all | admins | members.
-- coffee_member_reports: one row per member who set up their own report
--   (Current members only; plain facts; email to their own address, and optionally
--   Telegram through the organization's bot, i.e. National's report bot).
-- coffee_runs.ccmp_id: 0 = an admin (scope) report, else the member's own report.
-- COFFEE_MEMBER_REPORTS: System Settings switch for the whole member feature.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS coffee_bulletins (
  id           int unsigned NOT NULL AUTO_INCREMENT,
  subentity_id int          NOT NULL DEFAULT 0,
  title        varchar(150) NOT NULL DEFAULT '',
  body         text         NULL,
  link_url     varchar(500) NOT NULL DEFAULT '',
  audience     varchar(10)  NOT NULL DEFAULT 'all',   -- all | admins | members
  show_from    date         NULL,
  show_until   date         NULL,
  active       tinyint(1)   NOT NULL DEFAULT 1,
  created_by   int          NOT NULL DEFAULT 0,
  created_at   int          NOT NULL DEFAULT 0,
  updated_by   int          NOT NULL DEFAULT 0,
  updated_at   int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY ix_coffee_bulletins_scope (subentity_id, active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS coffee_member_reports (
  id                 int unsigned NOT NULL AUTO_INCREMENT,
  ccmp_id            int          NOT NULL,
  enabled            tinyint(1)   NOT NULL DEFAULT 0,
  send_time          char(5)      NOT NULL DEFAULT '06:00',
  timezone           varchar(40)  NOT NULL DEFAULT 'America/New_York',
  days               varchar(30)  NOT NULL DEFAULT 'mon,tue,wed,thu,fri',
  sections           text         NULL,
  telegram_enabled   tinyint(1)   NOT NULL DEFAULT 0,
  telegram_chat_id   varchar(64)  NOT NULL DEFAULT '',
  telegram_link_code varchar(32)  NOT NULL DEFAULT '',
  last_sent_on       date         NULL,
  created_at         int          NOT NULL DEFAULT 0,
  updated_at         int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY ux_coffee_member_reports_member (ccmp_id),
  KEY ix_coffee_member_reports_enabled (enabled)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE coffee_runs ADD COLUMN IF NOT EXISTS ccmp_id int NOT NULL DEFAULT 0 AFTER subentity_id;
ALTER TABLE coffee_runs ADD INDEX IF NOT EXISTS ix_coffee_runs_member (ccmp_id);

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at)
VALUES ('COFFEE_MEMBER_REPORTS', 'Members can get their own Coffee Report', '0', 'tinyint', 'Features & Policy', 'yesno',
        '', 'edit_settings', 'COFFEE_MEMBER_REPORTS',
        'On: Current members can switch on their own Daily Coffee Report (My Coffee Report in the member menu), sent by email and optionally Telegram. Needs the AI module switched on. Each member report is one email a day: check the Brevo plan''s daily limit.', 95, UNIX_TIMESTAMP());
