-- ---------------------------------------------------------------------------
-- Settings plan, phase 1, last step: drop ccmps_financial_settings.
-- Its four rows were copied into system_settings by 2026-10-22-settings-phase1.sql
-- (Financial tab of System Settings), and nothing reads it any more.
-- Run only after that script, once the Financial tab shows the right values.
-- Back up the database first. Safe to run more than once.
-- ---------------------------------------------------------------------------

DROP TABLE IF EXISTS ccmps_financial_settings;
