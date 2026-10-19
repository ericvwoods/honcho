-- ---------------------------------------------------------------------------
-- Deceased members keep no admin roles or Security Group memberships.
-- From now on ccmpsubmit() does this when Deceased is ticked and saved
-- (rbac_clear_member_access()); this clears the records marked before that.
-- Safe to re-run.
-- ---------------------------------------------------------------------------

DELETE gu FROM system_group_users gu
  JOIN trongate_users t ON t.id = gu.tg_user_id AND t.login_acct_info_table = 'ccmps'
  JOIN ccmps c ON c.id = t.login_acct_table_id AND c.trongate_user_id = t.id
 WHERE c.deceased = 1;

UPDATE ccmps
   SET system_admin = 0, ccmp_admin = 0, subentity_admin = 0, student_admin = 0
 WHERE deceased = 1
   AND (system_admin = 1 OR ccmp_admin = 1 OR subentity_admin = 1 OR student_admin = 1);
