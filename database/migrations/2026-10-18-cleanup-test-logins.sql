-- ---------------------------------------------------------------------------
-- TEST DATA ONLY (the Mac copy and staging, which was loaded from it).
-- Do NOT run on a real client database: it names specific test rows.
--
-- RBAC plan decision 9: clean up the logins before migrating (2026-10-18).
--  * Logins 2, 4, 5, 6 were test staff logins that all shared staff account 1
--    (sysadmin). Removed with their old DMS group and interface rows.
--  * Login 3 (ericvwoods@hotmail.com) pointed at member 2 (Charles Smith Jr)
--    while Eric's member record (1538) pointed at login 1, the staff sysadmin
--    login. Now login 3 <-> member 1538.
--  * 585 other members carried made-up login numbers (1..634, an old import
--    sequence) with no login behind them, so a new login N would have
--    attached itself to whichever member held N. Cleared to 0.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

DELETE FROM trongate_users                          WHERE id IN (2, 4, 5, 6) AND login_acct_info_table = 'honcho_user_accounts';
DELETE FROM dms_filelibrary_tguserid_security_group WHERE tguserid IN (2, 4, 5, 6);
DELETE FROM honcho_tguserid_interfaceid             WHERE tg_user_id IN (2, 4, 5, 6);
DELETE FROM trongate_tokens                         WHERE user_id IN (2, 4, 5, 6);

UPDATE trongate_users SET login_acct_table_id = 1538 WHERE id = 3 AND login_acct_info_table = 'ccmps';

-- every member link that doesn't match its login, cleared; then Eric's set
UPDATE ccmps c
  LEFT JOIN trongate_users t ON t.id = c.trongate_user_id AND t.login_acct_info_table = 'ccmps' AND t.login_acct_table_id = c.id
   SET c.trongate_user_id = 0
 WHERE c.trongate_user_id > 0 AND t.id IS NULL;

UPDATE ccmps SET trongate_user_id = 3 WHERE id = 1538 AND EXISTS (SELECT 1 FROM trongate_users WHERE id = 3 AND login_acct_table_id = 1538);
