-- ---------------------------------------------------------------------------
-- TEST DATA ONLY (the Mac copy and staging, which was loaded from it).
-- Do NOT run on a real client database: it names specific test rows.
--
-- RBAC plan decision 9: clean up the logins before migrating (2026-10-18).
--  * Logins 2, 4, 5, 6 were test staff logins that all shared staff account 1
--    (sysadmin). Removed with their old staff group, DMS group and interface rows.
--  * Login 3 (ericvwoods@hotmail.com) pointed at member 2 (Charles Smith Jr)
--    while Eric's member record (1538) pointed at login 1, the staff sysadmin
--    login. Now login 3 <-> member 1538.
--  * (Removed the same day) This script first also cleared 585 members'
--    trongate_user_id as "made-up". They are real: see
--    2026-10-18-restore-member-login-numbers.sql, which put them back.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

DELETE FROM trongate_users                          WHERE id IN (2, 4, 5, 6) AND login_acct_info_table = 'honcho_user_accounts';
DELETE FROM dms_filelibrary_tguserid_security_group WHERE tguserid IN (2, 4, 5, 6);
DELETE FROM honcho_tguserid_interfaceid             WHERE tg_user_id IN (2, 4, 5, 6);
DELETE FROM honcho_users_tguserid_security_group     WHERE tguserid IN (2, 4, 5, 6); -- added later the same day
DELETE FROM trongate_tokens                         WHERE user_id IN (2, 4, 5, 6);

UPDATE trongate_users SET login_acct_table_id = 1538 WHERE id = 3 AND login_acct_info_table = 'ccmps';

-- member 1313 also held 3; the restore script gives it 635
UPDATE ccmps SET trongate_user_id = 0 WHERE id = 1313 AND trongate_user_id = 3;
UPDATE ccmps SET trongate_user_id = 3 WHERE id = 1538 AND EXISTS (SELECT 1 FROM trongate_users WHERE id = 3 AND login_acct_table_id = 1538);
