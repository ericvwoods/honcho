-- ---------------------------------------------------------------------------
-- Top bar name (2026-10-27): every screen's top bar shows the short name in the
-- accent color, then "Member Portal" on member pages or "EMS" on admin pages in
-- the primary color (title_bar_name() in utilities_helper.php). Only the labels
-- and help on System Settings > Organization change, so a System Admin can see
-- which words go where. Values are left alone; safe to re-run.
-- ---------------------------------------------------------------------------
UPDATE system_settings SET label = 'Short name',
       help = 'First word of the top bar on every screen (e.g. BPA), and in browser tab titles.'
 WHERE title = 'SHORTSITENAME';
UPDATE system_settings SET label = 'Member portal name',
       help = 'After the short name in the top bar of member pages, and on the member login page.'
 WHERE title = 'SITENAME4';
UPDATE system_settings SET label = 'Short system name',
       help = 'After the short name in the top bar of admin pages (e.g. EMS), and in the browser tab of staff pages.'
 WHERE title = 'SHORTSITENAME2';
