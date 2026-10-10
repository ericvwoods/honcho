-- =====================================================================
-- Honcho PM Module (add-on) - SCHEMA  (Trongate v2 method names)
-- =====================================================================
-- Conventions (matched to the DMS module):
--   * Dates are Unix timestamps in INT columns, 0 = "no date".
--     (Check for 0 before formatting instead of comparing to
--      '01/01/1970' / '12/31/1969' after formatting.)
--   * People are stored ONLY as tg_user_id (trongate_users.id).
--     PM never references ccmps or honcho_user_accounts by name
--     except in the one user-lookup helper and the member picker.
--   * active / soft_deleted flags instead of hard deletes.
--   * No foreign key constraints (matches existing tables); indexes
--     are provided on every lookup column.
--   * Status numbers run LEFT-TO-RIGHT (1 = first column). Note this
--     is the opposite of DMS, where 6 is the leftmost column.
--
-- Phases: tables are tagged [P1]..[P5] by build phase.
-- =====================================================================


-- ---------------------------------------------------------------------
-- [P1] SETTINGS
-- ---------------------------------------------------------------------
-- PM-only settings, looked up by key name rather than by id so the
-- add-on never collides with system_settings ids used by Core.
--
-- The one setting Core itself must read (whether to show the PM menu)
-- belongs in system_settings. Add it by hand once you pick the next
-- free id, e.g.:
--   INSERT INTO system_settings (id, ..., settingvalue) VALUES (NN, ..., 1);

CREATE TABLE pm_settings (
  id            INT(11)      NOT NULL AUTO_INCREMENT,
  setting_key   VARCHAR(64)  NOT NULL,
  settingvalue  VARCHAR(255) NOT NULL DEFAULT '',
  description   VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY uk_setting_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_settings (setting_key, settingvalue, description) VALUES
('include_ccmps_users', '0', '1 = offer CCMP members in team-member picker; 0 = Honcho users only');


-- ---------------------------------------------------------------------
-- [P1] PERMISSIONS  (mirrors the DMS pattern)
--   user -> security group -> role -> allowed functions
-- ---------------------------------------------------------------------

CREATE TABLE pm_roles (
  id            INT(11)      NOT NULL AUTO_INCREMENT,
  title         VARCHAR(64)  NOT NULL,
  session_name  VARCHAR(64)  NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_roles (id, title, session_name) VALUES
(1, 'PM Administrator', 'pmadmin'),
(2, 'PM User',          'pmuser');

CREATE TABLE pm_security_groups (
  id     INT(11)      NOT NULL AUTO_INCREMENT,
  title  VARCHAR(64)  NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_security_groups (id, title) VALUES
(1, 'PM Admins'),
(2, 'PM Users');

CREATE TABLE pm_security_group_roles (
  id                 INT(11) NOT NULL AUTO_INCREMENT,
  security_group_id  INT(11) NOT NULL,
  role_id            INT(11) NOT NULL,
  PRIMARY KEY (id),
  KEY idx_sg (security_group_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_security_group_roles (security_group_id, role_id) VALUES
(1, 1),
(2, 2);

CREATE TABLE pm_tguserid_security_group (
  id                 INT(11) NOT NULL AUTO_INCREMENT,
  tg_user_id         INT(11) NOT NULL,
  security_group_id  INT(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_user (tg_user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_functions (
  id     INT(11)      NOT NULL AUTO_INCREMENT,
  title  VARCHAR(64)  NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Starter list; grows as controller functions are written.
INSERT INTO pm_functions (id, title) VALUES
(1,  'index / show_project'),
(2,  'board'),
(3,  'set_status'),
(4,  'manage_teams / show_team'),
(5,  'create_team / submit_team / add_member / remove_member'),
(6,  'delete_team'),
(7,  'manage_projects'),
(8,  'create_project / submit_project'),
(9,  'delete_project'),
(10, 'manage_sprints'),
(11, 'create_sprint / submit_sprint'),
(12, 'close_sprint'),
(13, 'backlog (product backlog list)'),
(14, 'show_story'),
(15, 'create_story / submit_story'),
(16, 'delete_story'),
(17, 'toggle_criterion'),
(18, 'toggle_task'),
(19, 'add_comment'),
(20, 'link_doc / unlink_doc'),
(21, 'manage_templates'),
(22, 'create_from_template');

CREATE TABLE pm_roles_functions (
  id           INT(11) NOT NULL AUTO_INCREMENT,
  role_id      INT(11) NOT NULL,
  function_id  INT(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_role_func (role_id, function_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin: everything
INSERT INTO pm_roles_functions (role_id, function_id)
SELECT 1, id FROM pm_functions;

-- User: work the board and stories; no team/project/sprint admin,
-- no deletes, no templates. (Accepting a story is further limited in
-- code to the project's Product Owner or a pmadmin.)
INSERT INTO pm_roles_functions (role_id, function_id) VALUES
(2, 1), (2, 2), (2, 3), (2, 13), (2, 14), (2, 15),
(2, 17), (2, 18), (2, 19), (2, 20);


-- ---------------------------------------------------------------------
-- [P1] TEAMS & PROJECTS
-- ---------------------------------------------------------------------

CREATE TABLE pm_teams (
  id           INT(11)      NOT NULL AUTO_INCREMENT,
  name         VARCHAR(100) NOT NULL,
  description  VARCHAR(255) NOT NULL DEFAULT '',
  active       TINYINT(1)   NOT NULL DEFAULT 1,
  created_at   INT(11)      NOT NULL DEFAULT 0,
  created_by   INT(11)      NOT NULL DEFAULT 0,
  updated_at   INT(11)      NOT NULL DEFAULT 0,
  updated_by   INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- A user can be on many teams.
CREATE TABLE pm_team_members (
  id          INT(11)    NOT NULL AUTO_INCREMENT,
  team_id     INT(11)    NOT NULL,
  tg_user_id  INT(11)    NOT NULL,
  active      TINYINT(1) NOT NULL DEFAULT 1,
  created_at  INT(11)    NOT NULL DEFAULT 0,
  created_by  INT(11)    NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY uk_team_user (team_id, tg_user_id),
  KEY idx_user (tg_user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_project_status (
  id     INT(11)     NOT NULL AUTO_INCREMENT,
  title  VARCHAR(32) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_project_status (id, title) VALUES
(1, 'Planning'),
(2, 'Active'),
(3, 'Complete'),
(4, 'Cancelled');

-- A project belongs to exactly one team.
CREATE TABLE pm_projects (
  id                INT(11)      NOT NULL AUTO_INCREMENT,
  team_id           INT(11)      NOT NULL,
  name              VARCHAR(150) NOT NULL,
  shortdescription  VARCHAR(255) NOT NULL DEFAULT '',
  description       TEXT         NULL,
  product_owner     INT(11)      NOT NULL DEFAULT 0,   -- tg_user_id
  subentity         INT(11)      NOT NULL DEFAULT 0,   -- DMS asset folder for uploads
  template_id       INT(11)      NOT NULL DEFAULT 0,   -- set if created from a template
  status            INT(11)      NOT NULL DEFAULT 1,   -- pm_project_status
  startdate         INT(11)      NOT NULL DEFAULT 0,
  enddate           INT(11)      NOT NULL DEFAULT 0,
  active            TINYINT(1)   NOT NULL DEFAULT 1,
  soft_deleted      TINYINT(1)   NOT NULL DEFAULT 0,
  created_at        INT(11)      NOT NULL DEFAULT 0,
  created_by        INT(11)      NOT NULL DEFAULT 0,
  updated_at        INT(11)      NOT NULL DEFAULT 0,
  updated_by        INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_team (team_id),
  KEY idx_po (product_owner)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ---------------------------------------------------------------------
-- [P2] SPRINTS, STORIES, CRITERIA, TASKS
-- ---------------------------------------------------------------------

-- status: 1 Planned, 2 Active, 3 Closed.
-- Rule enforced in code: at most one Active sprint per project.
CREATE TABLE pm_sprints (
  id          INT(11)      NOT NULL AUTO_INCREMENT,
  project_id  INT(11)      NOT NULL,
  name        VARCHAR(100) NOT NULL,
  goal        VARCHAR(255) NOT NULL DEFAULT '',
  startdate   INT(11)      NOT NULL DEFAULT 0,
  enddate     INT(11)      NOT NULL DEFAULT 0,
  status      TINYINT(1)   NOT NULL DEFAULT 1,
  closed_at   INT(11)      NOT NULL DEFAULT 0,
  closed_by   INT(11)      NOT NULL DEFAULT 0,
  created_at  INT(11)      NOT NULL DEFAULT 0,
  created_by  INT(11)      NOT NULL DEFAULT 0,
  updated_at  INT(11)      NOT NULL DEFAULT 0,
  updated_by  INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_project (project_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Board columns. This table IS the whitelist for setstatus().
CREATE TABLE pm_story_status (
  id          INT(11)     NOT NULL AUTO_INCREMENT,
  title       VARCHAR(32) NOT NULL,
  sort_order  INT(11)     NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_story_status (id, title, sort_order) VALUES
(1, 'Sprint Backlog',     1),
(2, 'In Progress',        2),
(3, 'In Review',          3),
(4, 'Pending Acceptance', 4),
(5, 'Accepted',           5);

CREATE TABLE pm_priority (
  id     INT(11)     NOT NULL AUTO_INCREMENT,
  title  VARCHAR(32) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pm_priority (id, title) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High'),
(4, 'Critical');

-- sprint_id = 0 means the story is in the PRODUCT backlog (not on a board).
CREATE TABLE pm_stories (
  id                  INT(11)      NOT NULL AUTO_INCREMENT,
  project_id          INT(11)      NOT NULL,
  sprint_id           INT(11)      NOT NULL DEFAULT 0,
  title               VARCHAR(200) NOT NULL,
  shortdescription    VARCHAR(255) NOT NULL DEFAULT '',
  description         TEXT         NULL,                 -- CKEditor free text
  status              INT(11)      NOT NULL DEFAULT 1,   -- pm_story_status
  priority            INT(11)      NOT NULL DEFAULT 2,   -- pm_priority
  points              INT(11)      NOT NULL DEFAULT 0,
  assignee            INT(11)      NOT NULL DEFAULT 0,   -- tg_user_id
  duedate             INT(11)      NOT NULL DEFAULT 0,
  blocked             TINYINT(1)   NOT NULL DEFAULT 0,
  blocked_reason      VARCHAR(255) NOT NULL DEFAULT '',
  onhold              TINYINT(1)   NOT NULL DEFAULT 0,
  onhold_reason       VARCHAR(255) NOT NULL DEFAULT '',
  sort_order          INT(11)      NOT NULL DEFAULT 0,
  accepted_by         INT(11)      NOT NULL DEFAULT 0,
  accepted_at         INT(11)      NOT NULL DEFAULT 0,
  accepted_override   TINYINT(1)   NOT NULL DEFAULT 0,   -- 1 = accepted with unmet criteria
  template_story_id   INT(11)      NOT NULL DEFAULT 0,
  active              TINYINT(1)   NOT NULL DEFAULT 1,
  soft_deleted        TINYINT(1)   NOT NULL DEFAULT 0,
  created_at          INT(11)      NOT NULL DEFAULT 0,
  created_by          INT(11)      NOT NULL DEFAULT 0,
  updated_at          INT(11)      NOT NULL DEFAULT 0,
  updated_by          INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_project_sprint (project_id, sprint_id),
  KEY idx_sprint_status (sprint_id, status),
  KEY idx_assignee (assignee)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Records every time a sprint closes and the closer sends an unfinished
-- story to the product backlog (to_sprint_id = 0) or to another sprint.
CREATE TABLE pm_story_sprint_moves (
  id              INT(11) NOT NULL AUTO_INCREMENT,
  story_id        INT(11) NOT NULL,
  from_sprint_id  INT(11) NOT NULL,
  to_sprint_id    INT(11) NOT NULL DEFAULT 0,
  moved_at        INT(11) NOT NULL DEFAULT 0,
  moved_by        INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_story (story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_story_criteria (
  id          INT(11)    NOT NULL AUTO_INCREMENT,
  story_id    INT(11)    NOT NULL,
  criterion   TEXT       NOT NULL,
  met         TINYINT(1) NOT NULL DEFAULT 0,
  met_by      INT(11)    NOT NULL DEFAULT 0,
  met_at      INT(11)    NOT NULL DEFAULT 0,
  sort_order  INT(11)    NOT NULL DEFAULT 0,
  created_at  INT(11)    NOT NULL DEFAULT 0,
  created_by  INT(11)    NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_story (story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_story_tasks (
  id          INT(11)      NOT NULL AUTO_INCREMENT,
  story_id    INT(11)      NOT NULL,
  title       VARCHAR(255) NOT NULL,
  assignee    INT(11)      NOT NULL DEFAULT 0,
  done        TINYINT(1)   NOT NULL DEFAULT 0,
  done_by     INT(11)      NOT NULL DEFAULT 0,
  done_at     INT(11)      NOT NULL DEFAULT 0,
  sort_order  INT(11)      NOT NULL DEFAULT 0,
  created_at  INT(11)      NOT NULL DEFAULT 0,
  created_by  INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_story (story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ---------------------------------------------------------------------
-- [P3] COMMENTS  (cloned from dms_filelibrary_docs_comments)
-- ---------------------------------------------------------------------

CREATE TABLE pm_story_comments (
  id            INT(11)    NOT NULL AUTO_INCREMENT,
  story_id      INT(11)    NOT NULL,
  comment       TEXT       NOT NULL,
  resolution    TEXT       NULL,
  closed        TINYINT(1) NOT NULL DEFAULT 0,
  closed_at     INT(11)    NOT NULL DEFAULT 0,
  closed_by     INT(11)    NOT NULL DEFAULT 0,
  active        TINYINT(1) NOT NULL DEFAULT 1,
  soft_deleted  TINYINT(1) NOT NULL DEFAULT 0,
  created_at    INT(11)    NOT NULL DEFAULT 0,
  created_by    INT(11)    NOT NULL DEFAULT 0,
  updated_at    INT(11)    NOT NULL DEFAULT 0,
  updated_by    INT(11)    NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_story (story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ---------------------------------------------------------------------
-- [P4] LINKS TO DMS DOCUMENTS  (DMS schema is not modified)
-- ---------------------------------------------------------------------
-- story_id = 0 means the document is attached to the project as a whole.

CREATE TABLE pm_doc_links (
  id          INT(11) NOT NULL AUTO_INCREMENT,
  doc_id      INT(11) NOT NULL,              -- dms_filelibrary_docs.id
  project_id  INT(11) NOT NULL,
  story_id    INT(11) NOT NULL DEFAULT 0,
  linked_at   INT(11) NOT NULL DEFAULT 0,
  linked_by   INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY uk_link (doc_id, project_id, story_id),
  KEY idx_story (story_id),
  KEY idx_project (project_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ---------------------------------------------------------------------
-- [P5] TEMPLATES  (copied into live tables, never referenced live)
-- ---------------------------------------------------------------------

CREATE TABLE pm_templates (
  id           INT(11)      NOT NULL AUTO_INCREMENT,
  name         VARCHAR(150) NOT NULL,
  description  TEXT         NULL,
  active       TINYINT(1)   NOT NULL DEFAULT 1,
  created_at   INT(11)      NOT NULL DEFAULT 0,
  created_by   INT(11)      NOT NULL DEFAULT 0,
  updated_at   INT(11)      NOT NULL DEFAULT 0,
  updated_by   INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_template_stories (
  id                INT(11)      NOT NULL AUTO_INCREMENT,
  template_id       INT(11)      NOT NULL,
  title             VARCHAR(200) NOT NULL,
  shortdescription  VARCHAR(255) NOT NULL DEFAULT '',
  description       TEXT         NULL,
  priority          INT(11)      NOT NULL DEFAULT 2,
  points            INT(11)      NOT NULL DEFAULT 0,
  sort_order        INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_template (template_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_template_criteria (
  id                 INT(11) NOT NULL AUTO_INCREMENT,
  template_story_id  INT(11) NOT NULL,
  criterion          TEXT    NOT NULL,
  sort_order         INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_tstory (template_story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pm_template_tasks (
  id                 INT(11)      NOT NULL AUTO_INCREMENT,
  template_story_id  INT(11)      NOT NULL,
  title              VARCHAR(255) NOT NULL,
  sort_order         INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY idx_tstory (template_story_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
