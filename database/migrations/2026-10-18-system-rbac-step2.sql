-- ---------------------------------------------------------------------------
-- RBAC step 2: migrate today's permissions into the system_* tables
-- (Honcho RBAC Implementation Plan, approved 2026-10-18). Run after
-- 2026-10-18-system-rbac.sql. Old tables are read, never changed.
-- Nothing reads the new rows until a module is switched (steps 3-5).
-- Safe to run more than once. The report of what didn't map is
-- 2026-10-18-system-rbac-step2-report.sql.
-- ---------------------------------------------------------------------------

-- ---------------------------------------------------------------------------
-- A. Login rows for members. Creating a member creates its trongate_users row
-- (Ccmps.php ~3285); the test copy is missing them. On an install that has
-- them, nothing is inserted (ids already exist).
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO trongate_users (id, title, login_acct_table_id, login_acct_info_table)
SELECT c.trongate_user_id,
       LEFT(COALESCE(NULLIF(c.username, ''), NULLIF(c.email_address, ''), CONCAT('member ', c.id)), 32),
       c.id, 'ccmps'
  FROM ccmps c
 WHERE c.trongate_user_id > 0;

-- ---------------------------------------------------------------------------
-- B. Functions: one per action a person would recognise. The description
-- lists the old function/method names each one covers.
-- ---------------------------------------------------------------------------
DROP TEMPORARY TABLE IF EXISTS rbac_newfn;
CREATE TEMPORARY TABLE rbac_newfn (mod_code VARCHAR(32), code VARCHAR(64), title VARCHAR(100), description VARCHAR(255), sort_order INT);
INSERT INTO rbac_newfn VALUES
  -- CCMPS: the four member admin roles (the ccmps flags login copies into the session)
  ('ccmps', 'system_admin',  'Member System Admin',         'ccmps.system_admin -> ccmps_system_admin',       10),
  ('ccmps', 'member_admin',  'Member Admin',                'ccmps.ccmp_admin -> ccmps_ccmp_admin',           20),
  ('ccmps', 'chapter_admin', 'Chapter (Subentity) Admin',   'ccmps.subentity_admin -> ccmps_subentity_admin', 30),
  ('ccmps', 'student_admin', 'Student Admin',               'ccmps.student_admin -> ccmps_student_admin',     40),
  -- DMS: 36 dms_filelibrary_functions merged into 12 actions
  ('dms', 'view_library',    'View the document library',         'Old: index, showreason, manage, viewdocrec, fulldoc, fulldescription, previewdocrec', 10),
  ('dms', 'download_docs',   'Download documents',                'Old: downloaddoc',                                                       20),
  ('dms', 'edit_docs',       'Add and edit documents',            'Old: create, update, submit, submit_upload',                             30),
  ('dms', 'view_kanban',     'View the kanban board',             'Old: kanban',                                                            40),
  ('dms', 'move_cards',      'Move documents between columns',    'Old: header0, backlog, inprogress, inreview, pending, header5, done',    50),
  ('dms', 'approve_docs',    'Approve or reject documents',       'Old: approvedoc, modalrejectdoc',                                        60),
  ('dms', 'hide_docs',       'Hide and unhide documents',         'Old: hiderecord, unhiderecord',                                          70),
  ('dms', 'delete_docs',     'Delete and undelete documents',     'Old: delrecord, undelrecord',                                            80),
  ('dms', 'bulk_actions',    'Bulk actions',                      'Old: bulkaction',                                                        90),
  ('dms', 'view_comments',   'Read comments',                     'Old: viewdoccomment, managedoccomments',                                100),
  ('dms', 'add_comments',    'Add and edit comments',             'Old: modaladddoccomment, createdoccomment, submitdoccomment, updatedoccomment', 110),
  ('dms', 'manage_comments', 'Close and delete comments',         'Old: closedoccomment, deldoccomment, undeldoccomment',                  120),
  -- Honcho staff accounts (modules/honcho/users): 41 honcho_users_functions merged into 15 actions
  ('honcho', 'home',                'Staff home page',                     'Old: index, usermenu, userhome, mydata, fontsize, refreshmysessiondata', 10),
  ('honcho', 'admin_menu',          'Staff admin menu',                    'Old: adminmenu',                                              20),
  ('honcho', 'view_user',           'View a staff record',                 'Old: viewuser',                                               30),
  ('honcho', 'list_users',          'List staff',                          'Old: manage',                                                 40),
  ('honcho', 'edit_user',           'Edit staff records',                  'Old: updateuser, usersubmit, useruseracctsubmit, recalcstatus, numval, getphyscntydata, getmailcntydata, fetchcntys', 50),
  ('honcho', 'pictures',            'Upload and remove pictures',          'Old: uploaduserpic, submit_upload_picture, ditch_picture',    60),
  ('honcho', 'change_own_password', 'Change own password',                 'Old: modalchangepw',                                          70),
  ('honcho', 'create_users',        'Add staff',                           'Old: createuser, createuseruseraccount',                      80),
  ('honcho', 'reset_passwords',     'Reset passwords and emails',          'Old: modalresetpw, modaladdemail',                            90),
  ('honcho', 'lock_accounts',       'Lock and unlock accounts',            'Old: lockacct, unlockacct',                                  100),
  ('honcho', 'delete_users',        'Delete staff records',                'Old: delrecord, undelrecord, removerecord',                  110),
  ('honcho', 'bulk_actions',        'Bulk actions',                        'Old: bulkaction',                                            120),
  ('honcho', 'rosters_exports',     'Rosters, directory and exports',      'Old: currentroster, currentdirectory, mastercurrentroster, export, spreadsheet_format_download', 130),
  ('honcho', 'upload_users',        'Upload staff from a spreadsheet',     'Old: userupload, upload_form',                               140),
  ('honcho', 'events_sponsors',     'Events and sponsors',                 'Old: events, sponsors, sendsponsorsformemai',                150);

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, n.code, n.title, n.description, n.sort_order, UNIX_TIMESTAMP()
  FROM rbac_newfn n JOIN system_modules m ON m.code = n.mod_code;

-- old function id -> new function code (used below to carry each old role's functions across)
DROP TEMPORARY TABLE IF EXISTS rbac_oldmap;
CREATE TEMPORARY TABLE rbac_oldmap (mod_code VARCHAR(32), old_id INT, code VARCHAR(64));
INSERT INTO rbac_oldmap VALUES
  ('dms',1,'view_library'),('dms',2,'view_library'),('dms',3,'view_kanban'),('dms',4,'view_library'),('dms',5,'view_library'),
  ('dms',6,'edit_docs'),('dms',7,'edit_docs'),('dms',8,'edit_docs'),('dms',9,'view_library'),('dms',10,'view_library'),
  ('dms',11,'bulk_actions'),('dms',12,'approve_docs'),('dms',13,'hide_docs'),('dms',14,'hide_docs'),('dms',15,'delete_docs'),
  ('dms',16,'view_library'),('dms',17,'download_docs'),('dms',18,'edit_docs'),('dms',19,'move_cards'),('dms',20,'move_cards'),
  ('dms',21,'move_cards'),('dms',22,'move_cards'),('dms',23,'move_cards'),('dms',24,'move_cards'),('dms',25,'move_cards'),
  ('dms',26,'add_comments'),('dms',27,'view_comments'),('dms',28,'view_comments'),('dms',29,'manage_comments'),('dms',30,'manage_comments'),
  ('dms',31,'manage_comments'),('dms',32,'delete_docs'),('dms',33,'add_comments'),('dms',34,'approve_docs'),('dms',35,'add_comments'),
  ('dms',36,'add_comments'),
  ('honcho',1,'home'),('honcho',2,'admin_menu'),('honcho',3,'home'),('honcho',4,'home'),('honcho',5,'home'),('honcho',6,'view_user'),
  ('honcho',7,'list_users'),('honcho',8,'edit_user'),('honcho',9,'create_users'),('honcho',10,'edit_user'),('honcho',11,'bulk_actions'),
  ('honcho',12,'home'),('honcho',13,'create_users'),('honcho',14,'edit_user'),('honcho',15,'edit_user'),('honcho',16,'edit_user'),
  ('honcho',17,'edit_user'),('honcho',18,'rosters_exports'),('honcho',19,'rosters_exports'),('honcho',20,'rosters_exports'),
  ('honcho',21,'upload_users'),('honcho',22,'upload_users'),('honcho',23,'rosters_exports'),('honcho',24,'rosters_exports'),
  ('honcho',25,'reset_passwords'),('honcho',26,'reset_passwords'),('honcho',27,'change_own_password'),('honcho',28,'lock_accounts'),
  ('honcho',29,'lock_accounts'),('honcho',30,'delete_users'),('honcho',31,'delete_users'),('honcho',32,'delete_users'),
  ('honcho',33,'pictures'),('honcho',34,'pictures'),('honcho',35,'pictures'),('honcho',36,'home'),('honcho',37,'edit_user'),
  ('honcho',38,'edit_user'),('honcho',39,'events_sponsors'),('honcho',40,'events_sponsors'),('honcho',41,'events_sponsors');
-- PMS functions were seeded 1:1 in step 1 (system_functions.legacy_id)
INSERT INTO rbac_oldmap SELECT 'pm', f.legacy_id, f.code FROM system_functions f JOIN system_modules m ON m.id = f.module_id AND m.code = 'pm';

-- ---------------------------------------------------------------------------
-- C. Groups. One per old group that actually gives something, plus one per
-- member admin role. Old groups that give nothing are listed in the report.
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO system_groups (title, description, active, created_at) VALUES
  ('Staff Users',          'From honcho_users usergrp (regular user role): own staff account',                1, UNIX_TIMESTAMP()),
  ('DMS Admins',           'From dms_filelibrary dmssysadmingrp (dmslibadmin role): all DMS functions',       1, UNIX_TIMESTAMP()),
  ('DMS Users',            'From dms_filelibrary dmsusergrp (dmslibuser role); every member login, as today', 1, UNIX_TIMESTAMP()),
  ('PM Admins',            'From pm_security_groups PM Admins (pmadmin role)',                                1, UNIX_TIMESTAMP()),
  ('PM Users',             'From pm_security_groups PM Users (pmuser role)',                                  1, UNIX_TIMESTAMP()),
  ('Member System Admins', 'Members with the System Admin role; also DMS admin, as today',                    1, UNIX_TIMESTAMP()),
  ('Member Admins',        'Members with the Member Admin role',                                              1, UNIX_TIMESTAMP()),
  ('Chapter Admins',       'Members with the Chapter (Subentity) Admin role; DMS user access, as today',       1, UNIX_TIMESTAMP()),
  ('Student Admins',       'Members with the Student Admin role',                                             1, UNIX_TIMESTAMP());
UPDATE system_groups SET description = 'Can manage security groups; from honcho_users sysadmingrp: all staff back-office functions'
 WHERE title = 'System Admins' AND description = 'Can manage security groups';

-- group -> functions -------------------------------------------------------
DROP TEMPORARY TABLE IF EXISTS rbac_gf;
CREATE TEMPORARY TABLE rbac_gf (grp VARCHAR(100), mod_code VARCHAR(32), code VARCHAR(64));

-- old role -> its functions, through the map
INSERT INTO rbac_gf SELECT DISTINCT 'Staff Users', 'honcho', o.code FROM honcho_users_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'honcho' AND o.old_id = rf.function_id WHERE rf.role_id = 6;
INSERT INTO rbac_gf SELECT DISTINCT 'DMS Admins', 'dms', o.code FROM dms_filelibrary_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'dms' AND o.old_id = rf.function_id WHERE rf.role_id = 1;
INSERT INTO rbac_gf SELECT DISTINCT 'DMS Users', 'dms', o.code FROM dms_filelibrary_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'dms' AND o.old_id = rf.function_id WHERE rf.role_id = 4;
INSERT INTO rbac_gf SELECT DISTINCT 'PM Admins', 'pm', o.code FROM pm_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'pm' AND o.old_id = rf.function_id WHERE rf.role_id = 1;
INSERT INTO rbac_gf SELECT DISTINCT 'PM Users', 'pm', o.code FROM pm_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'pm' AND o.old_id = rf.function_id WHERE rf.role_id = 2;

-- Honcho sysadmin skips every check today (security_group_id 1), so: every staff function
INSERT INTO rbac_gf SELECT 'System Admins', 'honcho', f.code FROM system_functions f JOIN system_modules m ON m.id = f.module_id AND m.code = 'honcho';

-- member admin roles; DMS access the way Dmslibrary::_get_dms_role() gives it to members today
INSERT INTO rbac_gf VALUES ('Member System Admins', 'ccmps', 'system_admin'), ('Member Admins', 'ccmps', 'member_admin'),
                           ('Chapter Admins', 'ccmps', 'chapter_admin'),     ('Student Admins', 'ccmps', 'student_admin');
INSERT INTO rbac_gf SELECT 'Member System Admins', 'dms', f.code FROM system_functions f JOIN system_modules m ON m.id = f.module_id AND m.code = 'dms';
INSERT INTO rbac_gf SELECT DISTINCT 'Chapter Admins', 'dms', o.code FROM dms_filelibrary_roles_functions rf
  JOIN rbac_oldmap o ON o.mod_code = 'dms' AND o.old_id = rf.function_id WHERE rf.role_id = 4; -- same as DMS Users

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM rbac_gf x
  JOIN system_groups g    ON g.title = x.grp
  JOIN system_modules m   ON m.code = x.mod_code
  JOIN system_functions f ON f.module_id = m.id AND f.code = x.code;

-- group -> people (only logins that exist) ---------------------------------
DROP TEMPORARY TABLE IF EXISTS rbac_gu;
CREATE TEMPORARY TABLE rbac_gu (grp VARCHAR(100), tg_user_id INT, acct_table VARCHAR(50)); -- acct_table: the kind of login allowed in

-- staff: the old staff and DMS/PM group tables (PMS and DMS check the staff login, so staff logins only)
INSERT INTO rbac_gu SELECT 'System Admins', tguserid, 'honcho_user_accounts' FROM honcho_users_tguserid_security_group WHERE security_group_id = 1;
INSERT INTO rbac_gu SELECT 'Staff Users',   tguserid, 'honcho_user_accounts' FROM honcho_users_tguserid_security_group WHERE security_group_id = 4;
INSERT INTO rbac_gu SELECT 'DMS Admins',    tguserid, 'honcho_user_accounts' FROM dms_filelibrary_tguserid_security_group WHERE security_group_id = 1;
INSERT INTO rbac_gu SELECT 'DMS Users',     tguserid, 'honcho_user_accounts' FROM dms_filelibrary_tguserid_security_group WHERE security_group_id = 5;
INSERT INTO rbac_gu SELECT 'PM Admins',     tg_user_id, 'honcho_user_accounts' FROM pm_tguserid_security_group WHERE security_group_id = 1;
INSERT INTO rbac_gu SELECT 'PM Users',      tg_user_id, 'honcho_user_accounts' FROM pm_tguserid_security_group WHERE security_group_id = 2;

-- members: their role flags (living, not deleted), and every member login gets DMS user access as today
INSERT INTO rbac_gu SELECT 'Member System Admins', trongate_user_id, 'ccmps' FROM ccmps WHERE system_admin = 1    AND trongate_user_id > 0 AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1;
INSERT INTO rbac_gu SELECT 'Member Admins',        trongate_user_id, 'ccmps' FROM ccmps WHERE ccmp_admin = 1      AND trongate_user_id > 0 AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1;
INSERT INTO rbac_gu SELECT 'Chapter Admins',       trongate_user_id, 'ccmps' FROM ccmps WHERE subentity_admin = 1 AND trongate_user_id > 0 AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1;
INSERT INTO rbac_gu SELECT 'Student Admins',       trongate_user_id, 'ccmps' FROM ccmps WHERE student_admin = 1   AND trongate_user_id > 0 AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1;
INSERT INTO rbac_gu SELECT 'DMS Users',            trongate_user_id, 'ccmps' FROM ccmps WHERE trongate_user_id > 0 AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1;

INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_at)
SELECT g.id, x.tg_user_id, UNIX_TIMESTAMP()
  FROM rbac_gu x
  JOIN system_groups g  ON g.title = x.grp
  JOIN trongate_users t ON t.id = x.tg_user_id AND t.login_acct_info_table = x.acct_table; -- a stale staff row can't put a member in a staff group

DROP TEMPORARY TABLE IF EXISTS rbac_newfn, rbac_oldmap, rbac_gf, rbac_gu;
