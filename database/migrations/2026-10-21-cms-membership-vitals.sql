-- ---------------------------------------------------------------------------
-- Membership Vitals (2026-10-21): the hardcoded block at the bottom of the
-- member home (ccmphome.php) becomes a Website section, layout 'vitals',
-- counted by _cms_vitals() in engine/tg_helpers/cms_helper.php.
-- Member home only (allow_public = 0); By the Numbers is the public-facing one,
-- so it is opened to the public site here (and now counts only current members
-- and chapters).
-- Safe to run more than once (INSERT IGNORE keeps changes made on the screens;
-- By the Numbers is switched on for the public site only the first time).
-- ---------------------------------------------------------------------------

INSERT IGNORE INTO cms_sections (code, layout, title, subtitle, menu_label, show_member, show_public, allow_public, sort_order, created_at)
VALUES ('vitals', 'vitals', 'Membership Vitals', '', 'Vitals', 1, 0, 0, 180, UNIX_TIMESTAMP());

UPDATE cms_sections SET allow_public = 1, show_public = 1, updated_at = UNIX_TIMESTAMP()
 WHERE code = 'metrics' AND allow_public = 0;
