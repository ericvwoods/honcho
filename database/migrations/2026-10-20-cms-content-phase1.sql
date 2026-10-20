-- ---------------------------------------------------------------------------
-- Content manager, phase 1 (2026-10-20): tables for the member home
-- (ccmphome) and the public website, and who may edit them.
--
--   cms_sections  one row per page section: on/off for the member home and the
--                 public site, order, heading, label in the one-page menu
--   cms_items     the repeating pieces inside a section (slides, boxes, people...)
--   cms_media     the picture library (files in public/uploads/cms/)
--   cms_posts     Sunshine, Bulletin Board stickies, Marquee lines, Careers
--   events        calendar events; the top level of the future Event Module
--                 (activities will be a child table, event_activities.event_id)
--
-- Permissions (Security Groups): the Content Admin and Event Admin checkboxes
-- on the member record become roles like the other four; module 'cms' gets
-- three functions. Staff are given them on the Security Groups screen.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS cms_sections (
  id          int unsigned NOT NULL AUTO_INCREMENT,
  code        varchar(40)  NOT NULL,            -- unique key the page code looks for
  layout      varchar(40)  NOT NULL,            -- which part of the template draws it
  title       varchar(150) NOT NULL DEFAULT '',
  subtitle    varchar(255) NOT NULL DEFAULT '',
  menu_label  varchar(40)  NOT NULL DEFAULT '', -- blank = not in the one-page menu
  show_member tinyint(1)   NOT NULL DEFAULT 1,  -- shown on the member home
  show_public tinyint(1)   NOT NULL DEFAULT 0,  -- shown on the public website
  allow_public tinyint(1)  NOT NULL DEFAULT 1,  -- 0 = member home only (e.g. Metrics)
  sort_order  int          NOT NULL DEFAULT 0,
  created_by  int          NOT NULL DEFAULT 0,
  created_at  int          NOT NULL DEFAULT 0,
  updated_by  int          NOT NULL DEFAULT 0,
  updated_at  int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cms_media (
  id            int unsigned NOT NULL AUTO_INCREMENT,
  file_name     varchar(255) NOT NULL,             -- stored name in public/uploads/cms/
  original_name varchar(255) NOT NULL DEFAULT '',
  alt_text      varchar(255) NOT NULL DEFAULT '',  -- describes the picture for screen readers
  mime          varchar(60)  NOT NULL DEFAULT '',
  width         int          NOT NULL DEFAULT 0,
  height        int          NOT NULL DEFAULT 0,
  bytes         int          NOT NULL DEFAULT 0,
  created_by    int          NOT NULL DEFAULT 0,
  created_at    int          NOT NULL DEFAULT 0,
  updated_by    int          NOT NULL DEFAULT 0,
  updated_at    int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY file_name (file_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cms_items (
  id          int unsigned NOT NULL AUTO_INCREMENT,
  section_id  int unsigned NOT NULL,
  heading     varchar(150) NOT NULL DEFAULT '',
  subheading  varchar(255) NOT NULL DEFAULT '',
  body        text NULL,
  icon        varchar(60)  NOT NULL DEFAULT '',   -- Font Awesome class, e.g. fa-plane
  media_id    int unsigned NULL,                  -- picture from cms_media
  link_url    varchar(255) NOT NULL DEFAULT '',
  link_label  varchar(60)  NOT NULL DEFAULT '',
  extra       varchar(100) NOT NULL DEFAULT '',   -- price, job title, date... per layout
  active      tinyint(1)   NOT NULL DEFAULT 1,
  sort_order  int          NOT NULL DEFAULT 0,
  created_by  int          NOT NULL DEFAULT 0,
  created_at  int          NOT NULL DEFAULT 0,
  updated_by  int          NOT NULL DEFAULT 0,
  updated_at  int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY section_order (section_id, sort_order),
  KEY media_id (media_id),
  CONSTRAINT cms_items_section FOREIGN KEY (section_id) REFERENCES cms_sections (id) ON DELETE CASCADE,
  CONSTRAINT cms_items_media   FOREIGN KEY (media_id)   REFERENCES cms_media (id)    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cms_posts (
  id           int unsigned NOT NULL AUTO_INCREMENT,
  kind         varchar(20)  NOT NULL,              -- sunshine | bulletin | marquee | job
  title        varchar(150) NOT NULL DEFAULT '',
  summary      varchar(500) NOT NULL DEFAULT '',
  body         text NULL,                          -- full text (job detail page)
  location     varchar(150) NOT NULL DEFAULT '',
  link_url     varchar(255) NOT NULL DEFAULT '',
  link_label   varchar(60)  NOT NULL DEFAULT '',
  media_id     int unsigned NULL,
  color        varchar(20)  NOT NULL DEFAULT '',   -- sticky colour on the Bulletin Board
  subentity_id int          NOT NULL DEFAULT 0,    -- 0 = national
  is_public    tinyint(1)   NOT NULL DEFAULT 0,    -- may appear on the public website
  active       tinyint(1)   NOT NULL DEFAULT 1,
  starts_on    date NULL,                          -- show from (blank = now)
  ends_on      date NULL,                          -- show until (blank = no end)
  sort_order   int          NOT NULL DEFAULT 0,
  created_by   int          NOT NULL DEFAULT 0,
  created_at   int          NOT NULL DEFAULT 0,
  updated_by   int          NOT NULL DEFAULT 0,
  updated_at   int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY kind_active (kind, active, sort_order),
  KEY media_id (media_id),
  CONSTRAINT cms_posts_media FOREIGN KEY (media_id) REFERENCES cms_media (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS events (
  id           int unsigned NOT NULL AUTO_INCREMENT,
  title        varchar(150) NOT NULL,
  summary      varchar(500) NOT NULL DEFAULT '',
  description  text NULL,
  location     varchar(150) NOT NULL DEFAULT '',
  start_at     datetime NOT NULL,
  end_at       datetime NULL,
  all_day      tinyint(1)   NOT NULL DEFAULT 0,
  subentity_id int          NOT NULL DEFAULT 0,    -- 0 = national; else the chapter that owns it
  is_public    tinyint(1)   NOT NULL DEFAULT 0,    -- shown on the public website's calendar
  approved     tinyint(1)   NOT NULL DEFAULT 1,
  media_id     int unsigned NULL,
  link_url     varchar(255) NOT NULL DEFAULT '',   -- e.g. registration page
  link_label   varchar(60)  NOT NULL DEFAULT '',
  created_by   int          NOT NULL DEFAULT 0,
  created_at   int          NOT NULL DEFAULT 0,
  updated_by   int          NOT NULL DEFAULT 0,
  updated_at   int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY start_at (start_at),
  KEY subentity_public (subentity_id, is_public),
  KEY media_id (media_id),
  CONSTRAINT events_media FOREIGN KEY (media_id) REFERENCES cms_media (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- The sections, in today's page order. The 11 Inspinia sections first, then
-- the new ones. INSERT IGNORE keeps any changes made on the screens.
INSERT IGNORE INTO cms_sections (code, layout, title, subtitle, menu_label, show_member, show_public, allow_public, sort_order, created_at) VALUES
  ('slider',       'slider',       'Slider',                    '',                                        '',              1, 1, 1,  10, UNIX_TIMESTAMP()),
  ('marquee',      'marquee',      'Marquee',                   '',                                        '',              1, 0, 1,  20, UNIX_TIMESTAMP()),
  ('services',     'services',     'Services',                  '',                                        'Features',      1, 1, 1,  30, UNIX_TIMESTAMP()),
  ('features',     'features',     'Features',                  '',                                        '',              1, 1, 1,  40, UNIX_TIMESTAMP()),
  ('metrics',      'metrics',      'By the Numbers',            '',                                        'Metrics',       1, 0, 0,  50, UNIX_TIMESTAMP()),
  ('calendar',     'calendar',     'Events Calendar',           '',                                        'Calendar',      1, 1, 1,  60, UNIX_TIMESTAMP()),
  ('team',         'team',         'Our Team',                  '',                                        'Team',          1, 1, 1,  70, UNIX_TIMESTAMP()),
  ('sunshine',     'sunshine',     'Sunshine',                  'Illnesses and passings in our family',    'Sunshine',      1, 0, 1,  80, UNIX_TIMESTAMP()),
  ('bulletins',    'bulletins',    'Bulletin Board',            '',                                        'Bulletin Board', 1, 0, 1, 90, UNIX_TIMESTAMP()),
  ('features2',    'features2',    'More Features',             '',                                        '',              1, 1, 1, 100, UNIX_TIMESTAMP()),
  ('timeline',     'timeline',     'Our Workflow',              '',                                        '',              1, 1, 1, 110, UNIX_TIMESTAMP()),
  ('testimonials', 'testimonials', 'Testimonials',              '',                                        'Testimonials',  1, 1, 1, 120, UNIX_TIMESTAMP()),
  ('comments',     'comments',     'What Our Partners Say',     '',                                        '',              1, 1, 1, 130, UNIX_TIMESTAMP()),
  ('features3',    'features3',    'Even More Features',        '',                                        '',              1, 1, 1, 140, UNIX_TIMESTAMP()),
  ('careers',      'careers',      'Careers',                   '',                                        'Careers',       1, 1, 1, 150, UNIX_TIMESTAMP()),
  ('pricing',      'pricing',      'Pricing',                   '',                                        'Pricing',       1, 1, 1, 160, UNIX_TIMESTAMP()),
  ('contact',      'contact',      'Contact Us',                '',                                        'Contact',       1, 1, 1, 170, UNIX_TIMESTAMP());

-- Permissions ---------------------------------------------------------------
INSERT IGNORE INTO system_modules (code, title, is_addon, enabled, sort_order, created_at)
VALUES ('cms', 'Content (CMS)', 0, 1, 40, UNIX_TIMESTAMP());

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, n.code, n.title, n.description, n.sort_order, UNIX_TIMESTAMP()
  FROM (SELECT 'ccmps' AS mod_code, 'content_admin' AS code, 'Content Admin' AS title, 'Member role: the Content Admin checkbox' AS description, 50 AS sort_order
        UNION ALL SELECT 'ccmps', 'event_admin',    'Event Admin',                'Member role: the Event Admin checkbox',                             60
        UNION ALL SELECT 'cms',   'manage_content', 'Manage site content',        'Sections, items, pictures, Sunshine, Bulletin Board, Marquee, Careers', 10
        UNION ALL SELECT 'cms',   'manage_events',  'Manage all events',          'Add, change and publish events for any chapter or national',        20
        UNION ALL SELECT 'cms',   'chapter_events', 'Manage own chapter events',  'Add and change events for your own chapter',                        30) n
  JOIN system_modules m ON m.code = n.mod_code;

INSERT IGNORE INTO system_groups (title, description, active, created_at) VALUES
  ('Content Admins', 'Members with the Content Admin role, and staff given it here; manage the member home and public website content', 1, UNIX_TIMESTAMP()),
  ('Event Admins',   'Members with the Event Admin role, and staff given it here; manage every event on the calendar',                    1, UNIX_TIMESTAMP());

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM (SELECT 'Content Admins' AS grp, 'ccmps' AS mod_code, 'content_admin' AS code
        UNION ALL SELECT 'Content Admins',       'cms',   'manage_content'
        UNION ALL SELECT 'Event Admins',         'ccmps', 'event_admin'
        UNION ALL SELECT 'Event Admins',         'cms',   'manage_events'
        UNION ALL SELECT 'Chapter Admins',       'cms',   'chapter_events'
        UNION ALL SELECT 'Member System Admins', 'cms',   'manage_content'
        UNION ALL SELECT 'Member System Admins', 'cms',   'manage_events'
        UNION ALL SELECT 'System Admins',        'cms',   'manage_content'
        UNION ALL SELECT 'System Admins',        'cms',   'manage_events') x
  JOIN system_groups g    ON g.title = x.grp
  JOIN system_modules m   ON m.code = x.mod_code
  JOIN system_functions f ON f.module_id = m.id AND f.code = x.code;

-- Members already ticked (none today) join the matching group
INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_at)
SELECT g.id, c.trongate_user_id, UNIX_TIMESTAMP()
  FROM ccmps c JOIN system_groups g ON g.title = 'Content Admins'
 WHERE c.content_admin = 1 AND c.trongate_user_id > 0 AND COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1;
INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_at)
SELECT g.id, c.trongate_user_id, UNIX_TIMESTAMP()
  FROM ccmps c JOIN system_groups g ON g.title = 'Event Admins'
 WHERE c.event_admin = 1 AND c.trongate_user_id > 0 AND COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1;
