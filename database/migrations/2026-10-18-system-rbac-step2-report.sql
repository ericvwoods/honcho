-- ---------------------------------------------------------------------------
-- RBAC step 2 report: what the migration could not carry across, and the
-- result per group. Read-only. Run after 2026-10-18-system-rbac-step2.sql:
--   mysql -uroot bpausa -t < database/migrations/2026-10-18-system-rbac-step2-report.sql
-- ---------------------------------------------------------------------------

SELECT '1. Old groups that give nothing (no role, or a role with no functions) - not migrated' AS report;
SELECT 'honcho' AS module, g.id, g.title, COALESCE(GROUP_CONCAT(gr.role_id), 'no role') AS roles
  FROM honcho_users_security_groups g
  LEFT JOIN honcho_users_security_group_roles gr ON gr.security_group_id = g.id
 WHERE g.id != 1  -- sysadmingrp skips checks, migrated to System Admins
 GROUP BY g.id
HAVING SUM(EXISTS (SELECT 1 FROM honcho_users_roles_functions rf WHERE rf.role_id = gr.role_id)) = 0 OR SUM(gr.role_id IS NOT NULL) = 0
UNION ALL
SELECT 'dms', g.id, g.title, COALESCE(GROUP_CONCAT(gr.role_id), 'no role')
  FROM dms_filelibrary_security_groups g
  LEFT JOIN dms_filelibrary_security_group_roles gr ON gr.security_group_id = g.id
 GROUP BY g.id
HAVING SUM(EXISTS (SELECT 1 FROM dms_filelibrary_roles_functions rf WHERE rf.role_id = gr.role_id)) = 0 OR SUM(gr.role_id IS NOT NULL) = 0;

SELECT '2. Group -> role rows pointing at a role that does not exist' AS report;
SELECT 'dms' AS module, gr.security_group_id, gr.role_id, gr.comments FROM dms_filelibrary_security_group_roles gr
  LEFT JOIN dms_filelibrary_roles r ON r.id = gr.role_id WHERE r.id IS NULL
UNION ALL
SELECT 'honcho', gr.security_group_id, gr.role_id, gr.comments FROM honcho_users_security_group_roles gr
  LEFT JOIN honcho_users_security_roles r ON r.id = gr.role_id WHERE r.id IS NULL
UNION ALL
SELECT 'pm', gr.security_group_id, gr.role_id, '' FROM pm_security_group_roles gr
  LEFT JOIN pm_roles r ON r.id = gr.role_id WHERE r.id IS NULL;

SELECT '3. Old memberships whose login does not exist - not migrated' AS report;
SELECT 'honcho' AS module, x.tguserid AS tg_user_id, x.security_group_id FROM honcho_users_tguserid_security_group x LEFT JOIN trongate_users t ON t.id = x.tguserid WHERE t.id IS NULL
UNION ALL
SELECT 'dms', x.tguserid, x.security_group_id FROM dms_filelibrary_tguserid_security_group x LEFT JOIN trongate_users t ON t.id = x.tguserid WHERE t.id IS NULL
UNION ALL
SELECT 'pm', x.tg_user_id, x.security_group_id FROM pm_tguserid_security_group x LEFT JOIN trongate_users t ON t.id = x.tg_user_id WHERE t.id IS NULL;

SELECT '3b. Old staff memberships that now point at a member login - not migrated' AS report;
SELECT 'honcho' AS module, x.tguserid AS tg_user_id, x.security_group_id FROM honcho_users_tguserid_security_group x JOIN trongate_users t ON t.id = x.tguserid AND t.login_acct_info_table != 'honcho_user_accounts'
UNION ALL
SELECT 'dms', x.tguserid, x.security_group_id FROM dms_filelibrary_tguserid_security_group x JOIN trongate_users t ON t.id = x.tguserid AND t.login_acct_info_table != 'honcho_user_accounts'
UNION ALL
SELECT 'pm', x.tg_user_id, x.security_group_id FROM pm_tguserid_security_group x JOIN trongate_users t ON t.id = x.tg_user_id AND t.login_acct_info_table != 'honcho_user_accounts';

SELECT '4. Members holding an admin role but with no login number - not migrated' AS report;
SELECT id, first_name, last_name, system_admin, ccmp_admin, subentity_admin, student_admin
  FROM ccmps
 WHERE (system_admin = 1 OR ccmp_admin = 1 OR subentity_admin = 1 OR student_admin = 1)
   AND COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1
   AND NOT EXISTS (SELECT 1 FROM trongate_users t WHERE t.id = ccmps.trongate_user_id AND ccmps.trongate_user_id > 0);

SELECT '5. Members holding an admin role who are deceased or deleted - left out' AS report;
SELECT id, first_name, last_name, system_admin, ccmp_admin, subentity_admin, student_admin, deceased, soft_deleted
  FROM ccmps
 WHERE (system_admin = 1 OR ccmp_admin = 1 OR subentity_admin = 1 OR student_admin = 1)
   AND (COALESCE(deceased,0) = 1 OR COALESCE(soft_deleted,0) = 1);

SELECT '6. Result: each group, its functions and people' AS report;
SELECT g.title AS grp,
       (SELECT GROUP_CONCAT(CONCAT(m.code, '/', f.code) ORDER BY m.sort_order, f.sort_order SEPARATOR ' ')
          FROM system_group_functions gf JOIN system_functions f ON f.id = gf.function_id JOIN system_modules m ON m.id = f.module_id
         WHERE gf.group_id = g.id) AS functions,
       (SELECT COUNT(*) FROM system_group_users gu WHERE gu.group_id = g.id) AS people
  FROM system_groups g ORDER BY g.title;
