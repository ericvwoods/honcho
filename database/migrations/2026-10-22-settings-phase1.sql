-- ---------------------------------------------------------------------------
-- Settings plan, phase 1 (approved 2026-10-22): one settings table, limited
-- by permission.
--
--   * system_settings gains the columns the System Settings screen needs to
--     draw each setting (label, category = the screen's tab, input_type,
--     options, help, sort_order) and rbac_function = what you need to change it:
--       edit_financial_settings  Financial tab: Financial Admins and System Admins
--       edit_settings            everything else: System Admins only
--     (System Admins = today's rule, system_admin_only(): staff sysadmins with
--     HONCHO_MODULE=1, member system admins with 0. They may change every row.)
--   * The four financial settings move in from ccmps_financial_settings.
--     current year stays row 1 and grace period goes in as row 2, the ids the
--     staff login and the phone API have always read.
--   * New member role Financial Admin (group Financial Admins, ccmps column
--     financial_admin, which already existed unused). The group also holds
--     system/edit_financial_settings; staff can be added on the Security screens.
--   * PM_SYS_SETTING_ID (row 16) deleted: nothing reads it since RBAC step 3.
--
-- Safe to run more than once, as long as ccmps_financial_settings still
-- exists. It is dropped by 2026-10-22-settings-phase1-drop-old-table.sql,
-- run after this one has been checked.
-- ---------------------------------------------------------------------------

ALTER TABLE system_settings
  ADD COLUMN IF NOT EXISTS label         varchar(100) NULL                         AFTER title,
  ADD COLUMN IF NOT EXISTS category      varchar(32)  NOT NULL DEFAULT 'General'   AFTER type,
  ADD COLUMN IF NOT EXISTS input_type    varchar(16)  NOT NULL DEFAULT 'text'      AFTER category,
  ADD COLUMN IF NOT EXISTS options       varchar(255) NULL                         AFTER input_type,
  ADD COLUMN IF NOT EXISTS rbac_function varchar(64)  NOT NULL DEFAULT 'edit_settings' AFTER options,
  ADD COLUMN IF NOT EXISTS help          varchar(255) NULL                         AFTER description,
  ADD COLUMN IF NOT EXISTS sort_order    int          NOT NULL DEFAULT 0           AFTER help;

ALTER TABLE system_settings ADD UNIQUE INDEX IF NOT EXISTS uq_system_settings_title (title);

-- ---------------------------- financial settings ---------------------------

-- Row 1 had a stale copy of the current year: take the live value, first run only
UPDATE system_settings s
  JOIN ccmps_financial_settings f ON f.title = 'system_current_year'
   SET s.settingvalue = f.settingvalue
 WHERE s.id = 1 AND s.category <> 'Financial';

INSERT IGNORE INTO system_settings (id, title, settingvalue, type, description, created_by, created_at)
SELECT 2, 'grace_period', f.settingvalue, 'boolean', f.description, 0, UNIX_TIMESTAMP()
  FROM ccmps_financial_settings f WHERE f.title = 'grace_period';

INSERT IGNORE INTO system_settings (title, settingvalue, type, description, created_by, created_at)
SELECT f.title, f.settingvalue, f.type, f.description, 0, UNIX_TIMESTAMP()
  FROM ccmps_financial_settings f WHERE f.title IN ('current_dues_pmt_year', 'dues_proration');

UPDATE system_settings SET category = 'Financial', rbac_function = 'edit_financial_settings', input_type = 'year', sort_order = 10,
       label = 'Current membership year',
       help  = 'The membership year in force. Members last renewed for an earlier year are Past Due (grace period on) or Expired (off). Changing it re-checks every member''s status.'
 WHERE title = 'system_current_year';

UPDATE system_settings SET category = 'Financial', rbac_function = 'edit_financial_settings', input_type = 'yesno', sort_order = 20,
       label = 'Grace period',
       help  = 'On: members behind on dues show as Past Due. Off: they show as Expired. Changing it re-checks every member''s status.'
 WHERE title = 'grace_period';

UPDATE system_settings SET category = 'Financial', rbac_function = 'edit_financial_settings', input_type = 'year', sort_order = 30,
       label = 'Dues payment year',
       help  = 'The only year members can pay dues for. To pay for more than one year, a member contacts the Treasurer.'
 WHERE title = 'current_dues_pmt_year';

UPDATE system_settings SET category = 'Financial', rbac_function = 'edit_financial_settings', input_type = 'fraction', sort_order = 40,
       label = 'New member dues proration',
       help  = 'The share of full dues a new member pays: 1.0 = full dues, 0.75 = 25% off, 0 = free.'
 WHERE title = 'dues_proration';

-- --------------------------------- DMS rows --------------------------------

UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 10, label = 'Tag 1 label', help = 'Name of the first tag on library documents (14 characters or fewer reads best).' WHERE title = 'DMS_FL_TAG1';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 20, label = 'Tag 2 label', help = 'Name of the second tag on library documents.' WHERE title = 'DMS_FL_TAG2';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 30, label = 'Tag 3 label', help = 'Name of the third tag on library documents.' WHERE title = 'DMS_FL_TAG3';
UPDATE system_settings SET category = 'DMS', input_type = 'yesno', sort_order = 40, label = 'Show the first Kanban column', help = 'Show the first column of the document Kanban board.' WHERE title = 'DMS_KBB_SHOW_HDR0';
UPDATE system_settings SET category = 'DMS', input_type = 'yesno', sort_order = 50, label = 'Show the last Kanban column', help = 'Show the last (sixth) column of the document Kanban board.' WHERE title = 'DMS_KBB_SHOW_HDR5';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 60, label = 'Kanban column 1', help = 'Heading of the first Kanban column.' WHERE title = 'DMS_KBB_HDR0';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 61, label = 'Kanban column 2', help = 'Heading of the second Kanban column.' WHERE title = 'DMS_KBB_HDR1';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 62, label = 'Kanban column 3', help = 'Heading of the third Kanban column.' WHERE title = 'DMS_KBB_HDR2';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 63, label = 'Kanban column 4', help = 'Heading of the fourth Kanban column.' WHERE title = 'DMS_KBB_HDR3';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 64, label = 'Kanban column 5', help = 'Heading of the fifth Kanban column.' WHERE title = 'DMS_KBB_HDR4';
UPDATE system_settings SET category = 'DMS', input_type = 'text', sort_order = 65, label = 'Kanban column 6', help = 'Heading of the sixth Kanban column.' WHERE title = 'DMS_KBB_HDR5';
UPDATE system_settings SET category = 'DMS', input_type = 'yesno', sort_order = 70, label = 'Edit page on Backlog → In Progress', help = 'Open the editing page when a card is moved from Backlog to In Progress on the Kanban board.' WHERE title = 'FORCE_EDIT_TO_IN_PROG';
UPDATE system_settings SET category = 'DMS', input_type = 'yesno', sort_order = 71, label = 'Edit page on Unrefined → Backlog', help = 'Open the editing page when a card is moved from Unrefined to Backlog on the Kanban board.' WHERE title = 'FORCE_EDIT_TO_BACKLOG';

DELETE FROM system_settings WHERE title = 'PM_SYS_SETTING_ID';

-- ------------------------------- permissions -------------------------------

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'edit_financial_settings', 'Change financial settings', 'The Financial tab of System Settings: current year, grace period, dues payment year, proration', 20, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'system';

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'edit_settings', 'Change system settings', 'Every System Settings tab. System Admins have it without being given it (system_admin_only rule)', 30, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'system';

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'financial_admin', 'Financial Admin', 'Member role: the Financial Admin tick on the member record', 70, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'ccmps';

INSERT IGNORE INTO system_groups (title, description, active, created_at)
VALUES ('Financial Admins', 'Members with the Financial Admin role, and staff given it here; change the financial settings (current year, grace period, dues)', 1, UNIX_TIMESTAMP());

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_functions f ON f.code IN ('edit_financial_settings', 'financial_admin')
  JOIN system_modules m   ON m.id = f.module_id AND m.code IN ('system', 'ccmps')
 WHERE g.title = 'Financial Admins'
   AND NOT EXISTS (SELECT 1 FROM system_group_functions x WHERE x.group_id = g.id AND x.function_id = f.id);
