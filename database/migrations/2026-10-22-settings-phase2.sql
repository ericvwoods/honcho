-- ---------------------------------------------------------------------------
-- Settings plan, phase 2 (2026-10-22): organization settings move from
-- config.php and .env to system_settings, as new tabs of System Settings
-- (System Admins only: rbac_function edit_settings).
--
-- config.php now defines these constants with setting('<title>', <old value>)
-- (config/settings.php), so code keeps using the constant names and a missing
-- row falls back to the old value. Each row starts with today's value, except:
--   PUBLIC_WEBSITE  https://www.bpapilots.org (was sgapleaders.org by mistake)
--   CMS_PUBLIC_SITE / CMS_MEMBER_BULLETINS  moved from .env; no install had them
--                   set there, so they start at the old defaults (0 and 1).
-- INSERT IGNORE: re-running never overwrites a value changed on the screen.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_by, created_at) VALUES
-- Organization
('SITENAME',       'Organization name',     'Black Pilots of America',      'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SITENAME',       'Shown in page headings, browser titles and emails.', 10, 0, UNIX_TIMESTAMP()),
('SHORTSITENAME',  'Short name',            'BPA',                          'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SHORTSITENAME',  'Used in browser tab titles and short headings.', 20, 0, UNIX_TIMESTAMP()),
('SITENAME2',      'System name',           'Enterprise Management System', 'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SITENAME2',      'Shown after the organization name in the top bar of the screens.', 30, 0, UNIX_TIMESTAMP()),
('SITENAME4',      'Member login heading',  'Member Portal',                'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SITENAME4',      'Under the organization name on the member login page.', 40, 0, UNIX_TIMESTAMP()),
('SITENAME3',      'Staff login heading',   'Enterprise Mgmt System',       'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SITENAME3',      'On the staff login page.', 50, 0, UNIX_TIMESTAMP()),
('SHORTSITENAME2', 'Short system name',     'EMS',                          'varchar', 'Organization', 'text',  NULL, 'edit_settings', 'SHORTSITENAME2', 'In the browser tab of staff pages, after the short name.', 60, 0, UNIX_TIMESTAMP()),
('PUBLIC_WEBSITE', 'Public website',        'https://www.bpapilots.org',    'varchar', 'Organization', 'url',   NULL, 'edit_settings', 'PUBLIC_WEBSITE', 'The organization''s public website. The site name in the top bar links to it.', 70, 0, UNIX_TIMESTAMP()),
('SYS_ADMIN_PHONE','Support phone',         '202.207.5353',                 'varchar', 'Organization', 'phone', NULL, 'edit_settings', 'SYS_ADMIN_PHONE','The number to call for help with the portal.', 80, 0, UNIX_TIMESTAMP()),
('FACEBOOK_URL',   'Facebook page',         '',                             'varchar', 'Organization', 'url',   NULL, 'edit_settings', 'FACEBOOK_URL',   'Full address, or leave blank.', 90, 0, UNIX_TIMESTAMP()),
('TWITTER_URL',    'X (Twitter) page',      '',                             'varchar', 'Organization', 'url',   NULL, 'edit_settings', 'TWITTER_URL',    'Full address, or leave blank.', 91, 0, UNIX_TIMESTAMP()),
('YOUTUBE_URL',    'YouTube channel',       '',                             'varchar', 'Organization', 'url',   NULL, 'edit_settings', 'YOUTUBE_URL',    'Full address, or leave blank.', 92, 0, UNIX_TIMESTAMP()),
-- Wording
('CCMP',           'One member',            'Member',     'varchar', 'Wording', 'text', NULL, 'edit_settings', 'CCMP',           'What the organization calls a member: Member, Client, Participant ... Used on every screen.', 10, 0, UNIX_TIMESTAMP()),
('CCMPS',          'Members (plural)',      'Members',    'varchar', 'Wording', 'text', NULL, 'edit_settings', 'CCMPS',          'The plural of the word above.', 20, 0, UNIX_TIMESTAMP()),
('SUBENTITY',      'One chapter',           'Chapter',    'varchar', 'Wording', 'text', NULL, 'edit_settings', 'SUBENTITY',      'What the organization calls its local groups: Chapter, Branch, Circle ...', 30, 0, UNIX_TIMESTAMP()),
('SUBENTITIES',    'Chapters (plural)',     'Chapters',   'varchar', 'Wording', 'text', NULL, 'edit_settings', 'SUBENTITIES',    'The plural of the word above.', 40, 0, UNIX_TIMESTAMP()),
('HONCHOUSER',     'One staff member',      'Staffer',    'varchar', 'Wording', 'text', NULL, 'edit_settings', 'HONCHOUSER',     'What staff accounts are called: Staffer, Employee, User ...', 50, 0, UNIX_TIMESTAMP()),
('HONCHOUSERS',    'Staff (plural)',        'Staff',      'varchar', 'Wording', 'text', NULL, 'edit_settings', 'HONCHOUSERS',    'The plural of the word above.', 60, 0, UNIX_TIMESTAMP()),
('CMS_LABEL',      'Content manager menu name', 'Website','varchar', 'Wording', 'text', NULL, 'edit_settings', 'CMS_LABEL',      'Menu name for the screens that manage the member home and public website.', 70, 0, UNIX_TIMESTAMP()),
('CCMP_SECOND_FACTOR_NAME',   'Member second factor name', 'Member Number',     'varchar', 'Wording', 'text', NULL, 'edit_settings', 'CCMP_SECOND_FACTOR_NAME',   'What members are asked for after their password.', 80, 0, UNIX_TIMESTAMP()),
('SYSTEM_SECOND_FACTOR_NAME', 'Staff second factor name',  'Verification Code', 'varchar', 'Wording', 'text', NULL, 'edit_settings', 'SYSTEM_SECOND_FACTOR_NAME', 'What staff are asked for after their password.', 90, 0, UNIX_TIMESTAMP()),
-- Features & Policy
('CMS_PUBLIC_SITE',       'Public website on this site',      '0', 'tinyint', 'Features & Policy', 'yesno',  NULL,   'edit_settings', 'CMS_PUBLIC_SITE',       'On: the site''s front address shows the public website built in the content manager. Off: it goes straight to the login page.', 10, 0, UNIX_TIMESTAMP()),
('CMS_MEMBER_BULLETINS',  'Members may post sticky notes',    '1', 'tinyint', 'Features & Policy', 'yesno',  NULL,   'edit_settings', 'CMS_MEMBER_BULLETINS',  'On: any logged-in member may post Bulletin Board notes. Chapter, Content and System Admins can set them pending or disapproved.', 20, 0, UNIX_TIMESTAMP()),
('MINPWLGTH',             'Minimum password length',          '6', 'int',     'Features & Policy', 'number', '6-64', 'edit_settings', 'MINPWLGTH',             'The fewest characters a new password may have (6 to 64).', 30, 0, UNIX_TIMESTAMP()),
('FORCE_PW_CHG_NEW_CCMP', 'New members change their password','1', 'tinyint', 'Features & Policy', 'yesno',  NULL,   'edit_settings', 'FORCE_PW_CHG_NEW_CCMP', 'On: a new member must choose their own password the first time they log in.', 40, 0, UNIX_TIMESTAMP()),
-- Look (colors and logos come in phase 3)
('HOTLINK',      'Member home button link',  '#',        'varchar', 'Look', 'url',  NULL, 'edit_settings', 'HOTLINK',      'Address of the extra button in the member home''s top menu, e.g. a registration page. # = no button.', 10, 0, UNIX_TIMESTAMP()),
('HOTLINKLABEL', 'Member home button label', 'Register', 'varchar', 'Look', 'text', NULL, 'edit_settings', 'HOTLINKLABEL', 'The words on that button.', 20, 0, UNIX_TIMESTAMP()),
-- DMS
('DMS_SUBENTITY', 'Organization label', 'School', 'varchar', 'DMS', 'text', NULL, 'edit_settings', 'DMS_SUBENTITY', 'Name of the organization field on library documents and in the library list.', 5, 0, UNIX_TIMESTAMP());
