-- ---------------------------------------------------------------------------
-- Settings plan, phase 3 (2026-10-25): color schemes and logos.
--
-- system_color_schemes: one row per scheme, six colors, each with one job:
--   primary_clr    site name, top bar, headings, member names, tab titles
--   accent_clr     second part of the site name, record box headers
--   highlight_clr  icons, collapse titles
--   label_clr      form labels, table headings, Back buttons
--   value_clr      the values beside labels, table text, muted text
--   menu_clr       side menu text and icons
-- Classic has no colors (NULL): it means "each color constant keeps the color
-- written in config.php", so it looks exactly as before. Custom is the one
-- scheme whose colors are edited on the screen.
-- The scheme in use is the system_settings row COLOR_SCHEME (its id), on the
-- Look tab, with the main and header logos (picked from the website's
-- picture library, or the default logo).
-- Safe to run more than once: re-running never overwrites a choice or a
-- Custom color made on the screen.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS system_color_schemes (
  id            int unsigned NOT NULL AUTO_INCREMENT,
  name          varchar(60)  NOT NULL,
  description   varchar(255) NULL,
  primary_clr   varchar(7)   NULL,
  accent_clr    varchar(7)   NULL,
  highlight_clr varchar(7)   NULL,
  label_clr     varchar(7)   NULL,
  value_clr     varchar(7)   NULL,
  menu_clr      varchar(7)   NULL,
  is_custom     tinyint(1)   NOT NULL DEFAULT 0,
  sort_order    int          NOT NULL DEFAULT 0,
  created_by    int          NOT NULL DEFAULT 0,
  created_at    int          NOT NULL DEFAULT 0,
  updated_by    int          NOT NULL DEFAULT 0,
  updated_at    int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY uq_system_color_schemes_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO system_color_schemes (name, description, primary_clr, accent_clr, highlight_clr, label_clr, value_clr, menu_clr, is_custom, sort_order, created_at) VALUES
('Classic',          'The colors as they have always been (each set in config.php).', NULL, NULL, NULL, NULL, NULL, NULL, 0, 10, UNIX_TIMESTAMP()),
('Inspinia',         'Matches the back-office theme.',                                 '#1ab394', '#ed5565', '#f8ac59', '#2f4050', '#676a6c', '#1ab394', 0, 20, UNIX_TIMESTAMP()),
('Navy & Gold',      'Formal, aviation style.',                                        '#1f3a5f', '#b8860b', '#c0392b', '#1f3a5f', '#5f6b7a', '#2c5282', 0, 30, UNIX_TIMESTAMP()),
('Slate & Crimson',  'Quieter, higher contrast.',                                      '#3d4a5c', '#b3243a', '#d9822b', '#2f6b4f', '#6b7280', '#3d4a5c', 0, 40, UNIX_TIMESTAMP()),
('Custom',           'Your own six colors, set on this screen.',                       '#20b2aa', '#dc143c', '#ff7f50', '#006400', '#808080', '#1ab394', 1, 50, UNIX_TIMESTAMP());

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_by, created_at)
SELECT 'COLOR_SCHEME', 'Color scheme', s.id, 'int', 'Look', 'scheme', NULL, 'edit_settings', 'COLOR_SCHEME',
       'The colors of every screen. Classic keeps the colors as they have always been. Custom lets you set the six colors yourself.', 1, 0, UNIX_TIMESTAMP()
  FROM system_color_schemes s WHERE s.name = 'Classic';

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_by, created_at) VALUES
('MAIN_LOGO', 'Logo',            'welcome_module/images/bpalogo100x82.jpg', 'varchar', 'Look', 'image', NULL, 'edit_settings', 'MAIN_LOGO', 'Shown on the login pages and at the top of most screens. Upload new pictures under Website > Pictures; about 100 x 82 pixels looks best.', 2, 0, UNIX_TIMESTAMP()),
('HDR_LOGO',  'Header logo',     'welcome_module/images/bpalogo100x82.jpg', 'varchar', 'Look', 'image', NULL, 'edit_settings', 'HDR_LOGO',  'Shown in the header of some screens. Usually the same picture as the logo.', 3, 0, UNIX_TIMESTAMP());
