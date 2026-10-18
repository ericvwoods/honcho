-- ---------------------------------------------------------------------------
-- RBAC step 1 (Honcho RBAC Implementation Plan, approved 2026-10-18)
-- One shared permission system in the Core system module:
--   person (trongate_users.id) -> group -> functions, per module.
-- No role table: a group holds its functions directly.
-- Adds tables only. Nothing reads them until a module is switched over
-- (step 3 PMS, step 4 DMS, step 5 CCMPS). Safe to run more than once.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `system_modules` (
  `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code`        varchar(32)  NOT NULL,             -- used in code: rbac_allowed('pm', ...)
  `title`       varchar(100) DEFAULT NULL,
  `is_addon`    tinyint(1)   NOT NULL DEFAULT 0,   -- 0 = Core, 1 = add-on
  `enabled`     tinyint(1)   NOT NULL DEFAULT 1,   -- 0 = every check for this module fails
  `sort_order`  int(11)      NOT NULL DEFAULT 0,
  `created_by`  int(11) DEFAULT 0,
  `created_at`  int(11) DEFAULT 0,
  `updated_by`  int(11) DEFAULT 0,
  `updated_at`  int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `system_functions` (
  `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id`   int(10) unsigned NOT NULL,
  `code`        varchar(64)  NOT NULL,             -- used in code: rbac_allowed('pm', 'edit_projects')
  `title`       varchar(100) DEFAULT NULL,         -- shown on the privileges grid
  `description` varchar(255) DEFAULT NULL,
  `legacy_id`   int(11)      DEFAULT NULL,         -- id in the module's old *_functions table (migration aid)
  `sort_order`  int(11)      NOT NULL DEFAULT 0,
  `created_by`  int(11) DEFAULT 0,
  `created_at`  int(11) DEFAULT 0,
  `updated_by`  int(11) DEFAULT 0,
  `updated_at`  int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_code` (`module_id`, `code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `system_groups` (
  `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title`       varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active`      tinyint(1)   NOT NULL DEFAULT 1,   -- 0 = group gives nothing (kept for history)
  `created_by`  int(11) DEFAULT 0,
  `created_at`  int(11) DEFAULT 0,
  `updated_by`  int(11) DEFAULT 0,
  `updated_at`  int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `system_group_functions` (  -- a ticked box on the privileges grid
  `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id`    int(10) unsigned NOT NULL,
  `function_id` int(10) unsigned NOT NULL,
  `created_by`  int(11) DEFAULT 0,
  `created_at`  int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_function` (`group_id`, `function_id`),
  KEY `function_id` (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `system_group_users` (      -- a person in a group
  `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id`    int(10) unsigned NOT NULL,
  `tg_user_id`  int(11) NOT NULL,                  -- trongate_users.id (one per login)
  `created_by`  int(11) DEFAULT 0,
  `created_at`  int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_user` (`group_id`, `tg_user_id`),
  KEY `tg_user_id` (`tg_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------------
-- Seed: modules
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO `system_modules` (`code`, `title`, `is_addon`, `enabled`, `sort_order`, `created_at`) VALUES
  ('system', 'System',                     0, 1, 10, UNIX_TIMESTAMP()),
  ('ccmps',  'Members (CCMPS)',            0, 1, 20, UNIX_TIMESTAMP()),
  ('dms',    'Documents (DMS)',            0, 1, 30, UNIX_TIMESTAMP()),
  ('pm',     'Projects (PMS)',             1, 1, 40, UNIX_TIMESTAMP()),
  ('honcho', 'Staff back office (Honcho)', 1, 1, 50, UNIX_TIMESTAMP());

-- ---------------------------------------------------------------------------
-- Seed: functions. System now; PMS now (first module to switch, step 3).
-- DMS, Honcho and CCMPS functions are added in step 2 (migration).
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO `system_functions` (`module_id`, `code`, `title`, `description`, `legacy_id`, `sort_order`, `created_at`)
SELECT m.id, f.code, f.title, f.description, f.legacy_id, f.sort_order, UNIX_TIMESTAMP()
FROM system_modules m
JOIN (
  SELECT 'system' AS mod_code, 'manage_security' AS code, 'Manage security groups' AS title,
         'Open the Security screens: groups, privileges, members, effective access' AS description, NULL AS legacy_id, 10 AS sort_order
  UNION ALL SELECT 'pm', 'view_projects',    'View projects',                     'Project list and project page (index, show_project)',          1, 10
  UNION ALL SELECT 'pm', 'manage_projects',  'Manage the project list',           'manage_projects',                                               7, 20
  UNION ALL SELECT 'pm', 'edit_projects',    'Create and edit projects',          'create_project, submit_project',                                8, 30
  UNION ALL SELECT 'pm', 'delete_projects',  'Delete projects',                   'delete_project',                                                9, 40
  UNION ALL SELECT 'pm', 'use_templates',    'Create projects from templates',    'create_from_template',                                         22, 50
  UNION ALL SELECT 'pm', 'manage_templates', 'Manage templates',                  'manage_templates',                                             21, 60
  UNION ALL SELECT 'pm', 'view_teams',       'View teams',                        'manage_teams, show_team',                                       4, 70
  UNION ALL SELECT 'pm', 'edit_teams',       'Create and edit teams, add and remove members', 'create_team, submit_team, add_member, remove_member', 5, 80
  UNION ALL SELECT 'pm', 'delete_teams',     'Delete teams',                      'delete_team',                                                   6, 90
  UNION ALL SELECT 'pm', 'view_board',       'View the board',                    'board',                                                         2, 100
  UNION ALL SELECT 'pm', 'set_status',       'Move stories on the board',         'set_status',                                                    3, 110
  UNION ALL SELECT 'pm', 'view_backlog',     'View the product backlog',          'backlog',                                                      13, 120
  UNION ALL SELECT 'pm', 'view_sprints',     'View sprints',                      'manage_sprints',                                               10, 130
  UNION ALL SELECT 'pm', 'edit_sprints',     'Create and edit sprints',           'create_sprint, submit_sprint',                                 11, 140
  UNION ALL SELECT 'pm', 'close_sprints',    'Close sprints',                     'close_sprint',                                                 12, 150
  UNION ALL SELECT 'pm', 'view_stories',     'View stories',                      'show_story',                                                   14, 160
  UNION ALL SELECT 'pm', 'edit_stories',     'Create and edit stories',           'create_story, submit_story',                                   15, 170
  UNION ALL SELECT 'pm', 'delete_stories',   'Delete stories',                    'delete_story',                                                 16, 180
  UNION ALL SELECT 'pm', 'tick_criteria',    'Tick acceptance criteria',          'toggle_criterion',                                             17, 190
  UNION ALL SELECT 'pm', 'tick_tasks',       'Tick tasks done',                   'toggle_task',                                                  18, 200
  UNION ALL SELECT 'pm', 'add_comments',     'Comment on stories',                'add_comment',                                                  19, 210
  UNION ALL SELECT 'pm', 'link_docs',        'Link DMS documents to stories',     'link_doc, unlink_doc',                                         20, 220
) f ON f.mod_code = m.code;

-- ---------------------------------------------------------------------------
-- Seed: the System Admins group, holding Manage security. Nobody is in it yet:
-- add people on the Group members screen (system-rbac/members/<id>).
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO `system_groups` (`title`, `description`, `active`, `created_at`) VALUES
  ('System Admins', 'Can manage security groups', 1, UNIX_TIMESTAMP());

INSERT IGNORE INTO `system_group_functions` (`group_id`, `function_id`, `created_at`)
SELECT g.id, f.id, UNIX_TIMESTAMP()
FROM system_groups g
JOIN system_functions f ON f.code = 'manage_security'
JOIN system_modules m   ON m.id = f.module_id AND m.code = 'system'
WHERE g.title = 'System Admins';
