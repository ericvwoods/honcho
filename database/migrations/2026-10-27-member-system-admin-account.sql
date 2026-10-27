-- ---------------------------------------------------------------------------
-- Dedicated member System Admin account (BPA, 2026-10-27, owner's request).
-- For Honcho Lite (HONCHO_MODULE=0) the system admin is a member account with
-- the System Admin role; this gives the installation one that isn't a real
-- person, so the job doesn't depend on someone's own membership.
--   username  portaladmin   (not "sysadmin": the login checks staff accounts
--                            first, and the staff account is called sysadmin)
--   second factor (Member Number) = ccmp_number SA-0001
--   chapter National HQ (SUBENTITY_NATIONAL_ID 99, never counted), type
--   Honorary, current_year 0 (never a current member, so never counted or a
--   voter), out of the directory, no email or calls.
-- NO PASSWORD here: the account can't log in until one is set outside git
-- (password_hash, kept in ~/honcho-keys/, never committed). Role: joins the
-- Member System Admins group and the system_admin column copy is set, as
-- rbac_set_member_role() does. Safe to re-run: every step checks first.
-- ---------------------------------------------------------------------------

INSERT INTO ccmps (first_name, last_name, username, ccmp_number, subentity, ccmp_type,
                   current_year, status, directoryoptout, donotcall, emailoptout,
                   code, notes, paypal_txn_id, created_by, created_at, updated_by, updated_at)
SELECT 'System', 'Administrator', 'portaladmin', 'SA-0001', 99, 6,
       0, 0, 1, 1, 1,
       SUBSTRING(MD5(RAND()), 1, 32),
       'Dedicated System Admin account (not a person). Created 2026-10-27.', '',
       0, UNIX_TIMESTAMP(), 0, UNIX_TIMESTAMP()
  FROM DUAL
 WHERE NOT EXISTS (SELECT 1 FROM ccmps WHERE username = 'portaladmin');

SET @sa := (SELECT id FROM ccmps WHERE username = 'portaladmin');

-- No ccmps_aux row: its foreign key points at the old ccmps_org table, so a new
-- member can't have one yet (to-do list); the app reads a missing row as blanks.

-- the login row (trongate_users), as rbac_member_login() makes it
INSERT INTO trongate_users (title, login_acct_table_id, login_acct_info_table)
SELECT 'portaladmin', @sa, 'ccmps' FROM DUAL
 WHERE @sa IS NOT NULL
   AND NOT EXISTS (SELECT 1 FROM trongate_users WHERE login_acct_info_table = 'ccmps' AND login_acct_table_id = @sa);

SET @tg := (SELECT id FROM trongate_users WHERE login_acct_info_table = 'ccmps' AND login_acct_table_id = @sa);
UPDATE ccmps SET trongate_user_id = @tg WHERE id = @sa AND @tg IS NOT NULL;

-- System Admin role = membership of the Member System Admins group
INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_by, created_at)
SELECT g.id, @tg, 0, UNIX_TIMESTAMP() FROM system_groups g
 WHERE g.title = 'Member System Admins' AND @tg IS NOT NULL
   AND NOT EXISTS (SELECT 1 FROM system_group_users gu WHERE gu.group_id = g.id AND gu.tg_user_id = @tg);

UPDATE ccmps SET system_admin = 1 WHERE id = @sa;
