-- ---------------------------------------------------------------------------
-- Settings plan, phase 4 (2026-10-25): clean-up.
-- ccmps_settings_copy is a leftover copy of ccmps_settings (the per-member
-- font size choices); nothing reads it.
-- Back up the database first. Safe to run more than once.
-- (ccmps_financial_settings is dropped by 2026-10-22-settings-phase1-drop-old-table.sql.)
-- ---------------------------------------------------------------------------

DROP TABLE IF EXISTS ccmps_settings_copy;
