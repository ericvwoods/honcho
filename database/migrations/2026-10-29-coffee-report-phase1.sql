-- ---------------------------------------------------------------------------
-- Honcho AI phase 1: the Daily Coffee Report (owner, 2026-10-29).
-- Each scope (National = subentity_id 0, or a chapter) configures its own
-- report: sections and their options, days, time, time zone, recipients, tone.
-- Collectors gather each section in plain code; the scope's AI connection
-- writes them up (ai_send); without AI, or if it fails, the plain sections are
-- sent. Every run is kept (coffee_runs) with the raw section data.
-- Who edits a scope's report: the same people who manage its AI connection
-- (ai/manage_national, ai/manage_chapter). Safe to run more than once.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS coffee_reports (
  id               int unsigned NOT NULL AUTO_INCREMENT,
  subentity_id     int NOT NULL DEFAULT 0,
  enabled          tinyint(1) NOT NULL DEFAULT 0,
  send_time        char(5) NOT NULL DEFAULT '06:00',          -- HH:MM in the time zone below
  timezone         varchar(40) NOT NULL DEFAULT 'America/New_York',
  days             varchar(30) NOT NULL DEFAULT 'mon,tue,wed,thu,fri',
  subject          varchar(150) NOT NULL DEFAULT 'Your Daily Coffee Report',
  tone             varchar(500) NULL,                          -- an instruction for the AI's writing
  sections         text NULL,                                  -- JSON: [{key, on, options}] in display order
  send_to_admins   tinyint(1) NOT NULL DEFAULT 1,              -- the scope's admins
  extra_recipients text NULL,                                  -- more addresses, one per line
  last_sent_on     date NULL,                                  -- the local date of the last scheduled send
  created_by       int DEFAULT 0,
  created_at       int DEFAULT 0,
  updated_by       int DEFAULT 0,
  updated_at       int DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY subentity (subentity_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS coffee_runs (
  id            int unsigned NOT NULL AUTO_INCREMENT,
  subentity_id  int NOT NULL DEFAULT 0,
  kind          varchar(12) NOT NULL DEFAULT 'scheduled',     -- scheduled, test, preview
  status        varchar(12) NOT NULL DEFAULT 'sent',          -- sent, partial, plain, failed, preview
  ai_used       tinyint(1) NOT NULL DEFAULT 0,
  report_text   mediumtext NULL,                              -- what was sent (plain text)
  sections_raw  mediumtext NULL,                              -- JSON: each section's collected data or error
  recipients    int NOT NULL DEFAULT 0,
  message       varchar(255) NULL,
  run_by        int NOT NULL DEFAULT 0,                       -- tg_user_id, 0 = schedule
  started_at    int NOT NULL DEFAULT 0,
  finished_at   int NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY scope_time (subentity_id, started_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
