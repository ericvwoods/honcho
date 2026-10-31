-- ---------------------------------------------------------------------------
-- View as a Member (owner's decisions 2026-10-31; requirements LOGIN-20 to LOGIN-29).
-- Security Groups function system/view_as_member for System Admins (staff and member),
-- Member Admins and Chapter Admins (their own chapter's members, enforced in viewas_can()).
-- Nobody can view as a System Admin; only System Admins can view as a member with an admin role.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'view_as_member', 'View as a member', 'See and use Honcho as a member (Chapter Admins: their own chapter''s members), with a bar to return to your own account; logged', 60, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'system';

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_modules m ON m.code = 'system'
  JOIN system_functions f ON f.module_id = m.id AND f.code = 'view_as_member'
 WHERE g.title IN ('System Admins', 'Member System Admins', 'Member Admins', 'Chapter Admins');
