-- ---------------------------------------------------------------------------
-- Member Fields (2026-10-27): designated fields of the member record (ccmps)
-- that each client can show or hide, on System Settings > Member Fields
-- (System Admins). One row per designated field, title CCMPS_SHOW_<FIELD>,
-- 1 = shown, 0 = hidden. Code asks ccmp_field_shown('<field>') (config/settings.php).
-- A hidden field isn't on the profile page or the edit form, and saving the
-- form keeps its stored value. Designate a new field by adding a row here (or
-- in a later migration) and wrapping that field in ccmp_field_shown().
-- Start: the three the owner asked to hide on 2026-10-27 (start hidden).
-- INSERT IGNORE: re-running never overwrites a choice made on the screen.
-- ---------------------------------------------------------------------------

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_by, created_at) VALUES
('CCMPS_SHOW_DEPARTMENT', 'Department',  '0', 'tinyint', 'Member Fields', 'yesno', NULL, 'edit_settings', 'ccmps.department', 'Profession section of the profile and edit form.', 10, 0, UNIX_TIMESTAMP()),
('CCMPS_SHOW_REPORTS_TO', 'Reports To',  '0', 'tinyint', 'Member Fields', 'yesno', NULL, 'edit_settings', 'ccmps.reports_to', 'Profession section of the profile and edit form.', 20, 0, UNIX_TIMESTAMP()),
('CCMPS_SHOW_LEADSOURCE', 'Lead Source', '0', 'tinyint', 'Member Fields', 'yesno', NULL, 'edit_settings', 'ccmps.leadsource', 'Membership section of the profile and edit form.', 30, 0, UNIX_TIMESTAMP());
