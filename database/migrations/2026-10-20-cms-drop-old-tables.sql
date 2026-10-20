-- ---------------------------------------------------------------------------
-- Content manager, phase 3 (2026-10-20): drop the old prototype CMS tables.
-- The eight modules/cms/ccmps* modules that used them were deleted in the same
-- change; the Website content manager (cms_sections, cms_items, cms_media,
-- cms_posts, events) replaces them. Decided 2026-10-20: keep nothing.
-- Includes the old CMS library tables (cms_ccmps_filelibrary_*), whose module
-- was removed 2026-10-16. Back up first; safe to re-run.
-- ---------------------------------------------------------------------------

DROP TABLE IF EXISTS cms_ccmps_activities;
DROP TABLE IF EXISTS cms_ccmps_activities_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_bulletins;
DROP TABLE IF EXISTS cms_ccmps_bulletins_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_events;
DROP TABLE IF EXISTS cms_ccmps_events_activities;
DROP TABLE IF EXISTS cms_ccmps_event_scopes;
DROP TABLE IF EXISTS cms_ccmps_event_types;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_access;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_docs;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_docs_atis_seed;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_doctags1;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_doctags2;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_doctags3;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_filetypes;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_rectypes;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_scopes;
DROP TABLE IF EXISTS cms_ccmps_filelibrary_status;
DROP TABLE IF EXISTS cms_ccmps_jobs;
DROP TABLE IF EXISTS cms_ccmps_jobs_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_jumbotron;
DROP TABLE IF EXISTS cms_ccmps_jumbotron_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_marquee;
DROP TABLE IF EXISTS cms_ccmps_marquee_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_notices;
DROP TABLE IF EXISTS cms_ccmps_notices_bulk_actions;
DROP TABLE IF EXISTS cms_ccmps_pms_projects;
DROP TABLE IF EXISTS cms_ccmps_pms_tasks;
DROP TABLE IF EXISTS cms_ccmps_sunshine;
DROP TABLE IF EXISTS cms_ccmps_sunshine_bulk_actions;
DROP TABLE IF EXISTS cms_users_activities;
DROP TABLE IF EXISTS cms_users_bulletins;
DROP TABLE IF EXISTS cms_users_jobs;
DROP TABLE IF EXISTS cms_users_jumbotron;
DROP TABLE IF EXISTS cms_users_marquee;
DROP TABLE IF EXISTS cms_users_notices;
