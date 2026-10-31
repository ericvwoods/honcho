-- ---------------------------------------------------------------------------
-- Dues, step 2: the status engine switch (2026-10-31). Off by default: the old status
-- rule stays until a Financial or System Admin switches the engine on (BPA: on the Mac
-- now; on staging and production after the dry-run legacy data load). When on, member
-- status comes from dues_helper.php (the dues records, the due date and the grace period),
-- recalculated after every change and nightly by fin/nightly/<CRON_KEY>, which also moves
-- system_current_year on to the membership year in force. Safe to run more than once.
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at)
VALUES ('DUES_STATUS_ENGINE', 'Status from the dues records (new engine)', '0', 'tinyint', 'Financial', 'yesno', '', 'edit_financial_settings', 'DUES_STATUS_ENGINE',
        'On: member status follows the dues records, the due date and the grace period, recalculated nightly, and the membership year moves on by itself after the due date. Off: the old rule. Switch on only after the dues history has been loaded.', 34, UNIX_TIMESTAMP());
