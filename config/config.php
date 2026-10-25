<?php
/*
Warning: Constant DMS_HM_TAB_TITLE_CLR already defined in /home/bpapilots/bpauat/config/config.php on line 234

Warning: Constant DMS_HM_TAB_ICON_CLR already defined in /home/bpapilots/bpauat/config/config.php on line 235

Warning: Constant DMS_CRUD_IBOX_HDR_CLR already defined in /home/bpapilots/bpauat/config/config.php on line 246

Warning: Constant CURRENCY_SYMBOL already defined in /home/bpapilots/bpauat/config/config.php on line 252

Warning: Constant APPPATH already defined in /home/bpapilots/bpauat/engine/ignition.php on line 103

Warning: Constant REQUEST_TYPE already defined in /home/bpapilots/bpauat/engine/ignition.php on line 104
*/

// Environment Specific - values come from .env (see config/env.php and .env.example)
require_once __DIR__.'/env.php';
require_once __DIR__.'/settings.php'; // setting('<title>', default): values from the System Settings screen
define('BASE_URL', env('BASE_URL', 'http://localhost/bpausa/'));

// API
define('JWT_SECRET', env('JWT_SECRET', ''));

// Location
define('APPPATH', dirname(dirname(__FILE__)).'/');
define('ADMINTHEME','inspinia'); // Private Area & Honcho Theme

// Routing
define('DEFAULT_MODULE', 'welcome');
define('DEFAULT_CONTROLLER', 'Welcome');
define('DEFAULT_METHOD', 'index');

// State
define('CCMPS_AUX_MODULE', 1); // "true" or "false" Base product only or extended ccmp properties
define('HONCHO_MODULE', (int) env('HONCHO_MODULE', 1)); // 1 = Honcho staff back office deployed (staff run System pages), 0 = Honcho Lite (member system admins do)
define('DEBUGGING', 0); // "true" or "false"
define('ENV', 'prod'); //dev or anything else is not dev. controls navbar breadcrumbs
define('WHATENV', env('WHATENV', 'dev')); // dev  Used in cart.php AND Welcome controller email parameters
define('VERSION_RELEASE', '1.0');

// Organization Specific
define('SITENAME', setting('SITENAME', 'Black Pilots of America')); // honcho
define('SITENAME2', setting('SITENAME2', 'Enterprise Management System')); // CORE, MVP
define('SITENAME3', setting('SITENAME3', 'Enterprise Mgmt System')); // honcho/views/inspinia/login
define('SITENAME4', setting('SITENAME4', 'Member Portal')); // welcome/views/security/login
define('SHORTSITENAME', setting('SHORTSITENAME', 'BPA')); //
define('SHORTSITENAME2', setting('SHORTSITENAME2', 'EMS')); // second factor entry page

// Sysadmin Contact Info
define('SYS_ADMIN_PHONE', setting('SYS_ADMIN_PHONE', '202.207.5353'));
define('DEVEMAIL', 'ericvwoods@hotmail.com'); // if WHATDEV = dev the will use this email address for testing.
// login header.php EXT_WEBSITE, SITENAME, FACEBOOK_URL, TWITTER_URL, YOUTUBE_URL

// honcho
define('USERS_IDNUM_REQ', 0); // user accts must have employee number
define('HONCHOUSER', setting('HONCHOUSER', 'Staffer')); // Employee, User, Staffer
define('HONCHOUSERS', setting('HONCHOUSERS', 'Staff')); // Employees, Users, Staff

// SECOND FACTOR SETTINGS
// if user community has limitations on texting or email (perhaps a minor)can use a table field. Each user table has a "second factor" field that can be used like high school mascot
define('CCMP_SECOND_FACTOR_NAME', setting('CCMP_SECOND_FACTOR_NAME', 'Member Number')); // High School Mascot
define('CCMP_SECOND_FACTOR_FIELD_NAME','id_number'); // second_factor
define('SYSTEM_SECOND_FACTOR_NAME', setting('SYSTEM_SECOND_FACTOR_NAME', 'Verification Code')); //
define('SYSTEM_SECOND_FACTOR_FIELD_NAME','second_factor'); // second_factor

define('WELCOME_BYPASS_2ND_FACTOR', false); //

// CCMPS Nomenclature
define('CCMP', setting('CCMP', 'Member')); // Customer, Client, Member, Participant
define('CCMPS', setting('CCMPS', 'Members')); // Customers, Clients, Members, Participants
define('CCMPS_ADDR_TABLE','ccmps_addresses'); // or ccmps_addresses or ccmps_addresses_mp
define('SUBENTITY', setting('SUBENTITY', 'Chapter')); // Subentity - used for page headers and buttons - Chapter, Circle, Branch etc
define('SUBENTITIES', setting('SUBENTITIES', 'Chapters')); // subentities
define('CCMP_LIFETIME_YEAR', 2099); // current_year of lifetime members: always Current (status 1); recalcstatus() and the dues year check in ccmpsubmit()
define('SUBENTITY_NATIONAL_ID', 99); // ccmps_subentities row for National HQ: not a chapter - hidden from the Chapters screen, never counted (0 = none). Why it exists is on docs/todo.md
define('CCMPSSUBENTITY', SUBENTITY); // Subentity - used for page headers and buttons - Chapter, Circle, Branch etc
define('CMS_PUBLIC_SITE', (int) setting('CMS_PUBLIC_SITE', 0)); // 1 = the site's front address shows the Website (welcome/website); 0 = it goes to the login (the organization uses an outside site, PUBLIC_WEBSITE)
define('CMS_MEMBER_BULLETINS', (int) setting('CMS_MEMBER_BULLETINS', 1)); // 1 = any logged-in member may post sticky notes on the Bulletin Board (moderated by Chapter, Content and System Admins)
define('CMS_LABEL', setting('CMS_LABEL', 'Website')); // menu name for the content manager (module cms) - Website, Web Pages, Our Site etc

// CCMPSHOME
define('HOTLINK', setting('HOTLINK', '#')); // '#' if no active link
define('HOTLINKLABEL', setting('HOTLINKLABEL', 'Register')); // General Meeting Registration, Skyhook Registration

// Color Branding - scheme_color('<one of six>', '<Classic color>'): the System Settings > Look color scheme
// (system_color_schemes). Classic keeps the color written here. Semantic colors (red/green DMS tabs) aren't schemed.
define('SN_FNT_WT',''); // sitename font weight
define('SN_FNT_SZ', '36px'); // sitename font size
define('SN_CLR', scheme_color('primary', 'lightseagreen')); // sitename color - coral, black default, coral, cornflowerblue, lightseagreen
define('SN2_CLR', scheme_color('accent', 'crimson')); // sitename color - lightseagreen, black default, coral, cornflowerblue
define('NB_CLR', scheme_color('primary', 'lightseagreen')); // Navbar color - coral

// CCMP crud
define('CCMPS_CRUD_IBOX_HDR_CLR', scheme_color('accent', 'crimson')); // coral
define('CCMPS_CRUD_LABEL_CLR', scheme_color('label', 'darkgreen')); // lightseagreen
define('CCMPS_CRUD_VALUE_CLR', scheme_color('value', 'gray')); // coral

// CCMPS Colors
define('USERS_HM_TAB_TITLE_CLR', scheme_color('primary', 'lightseagreen')); // CCMPS Collapse Title Bar Color - coral, cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('USERS_HM_TAB_ICON_CLR', scheme_color('highlight', 'lightseagreen')); // CCMPS Collapse Title Bar Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('USERS_HM_TAB_CARET_CLR', scheme_color('value', 'lightgray')); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral

// CCMPS Dashboard Colors
define('USERS_TBL_HDR_CLR', scheme_color('label', 'black')); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('USERS_TBL_DATA_CLR', scheme_color('value', 'gray')); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral

define('USERS_CRUD_TAB_TITLE_CLR', scheme_color('value', 'gray'));

// User Crud colors
define('USERS_CRUD_IBOX_HDR_CLR', scheme_color('accent', 'coral')); // crimson
define('USERS_CRUD_LABEL_CLR', scheme_color('label', 'darkgreen')); // lightseagreen
define('USERS_CRUD_VALUE_CLR', scheme_color('value', 'gray')); // coral

// Logos
define('MAIN_LOGO', setting('MAIN_LOGO', 'welcome_module/images/bpalogo100x82.jpg')); // welcome_module/images/bpalogo100x82.jpg
define('HDR_LOGO', setting('HDR_LOGO', 'welcome_module/images/bpalogo100x82.jpg')); // welcome_module/images/bpalogo100x82.jpg
define('SMALL_LOGO','welcome_module/images/');
define('PLAIN_LOGO',''); // welcome_module/images/xyz100x82.jpg

// Social Media
//define('EXT_WEBSITE','https://www');
define('PUBLIC_WEBSITE', setting('PUBLIC_WEBSITE', 'https://www.bpapilots.org')); // the organization's public website (was sgapleaders.org by mistake until 2026-10-22)
define('FACEBOOK_URL', setting('FACEBOOK_URL', ''));
define('TWITTER_URL', setting('TWITTER_URL', ''));
define('YOUTUBE_URL', setting('YOUTUBE_URL', ''));

// CCMPSHOME COLORS
define('CCMPS_DBRD_HDR_CLR', scheme_color('primary', 'lightseagreen')); // CCMPS Dashbord Header Color - lightseagreen, cornflowerblue,coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('CCMPS_BACK_BTN_CLR', scheme_color('label', 'darkgreen')); // CCMPS Back Button Color - lightseagreen
define('CCMPS_HM_TAB_TITLE_CLR', scheme_color('primary', 'lightseagreen')); // CCMPS Collapse Title Bar Color - coral, cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('CCMPS_HM_TAB_ICON_CLR', scheme_color('highlight', '#676a6c')); // CCMPS Collapse Title Bar Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('CCMPS_HM_TAB_CARET_CLR', scheme_color('value', 'lightgray')); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coralfine('CCMPS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral

define('CCMPS_HM_CLPSE_OPEN', 0); // first collapse always open
define('CCMPS_HM_ALL_CLPSE_OPEN', 0); // all collapses always open
define('CCMPS_HM_SIDE_MENU_CLR', scheme_color('menu', '#1ab394'));
define('CCMPS_HM_SIDE_ICON_CLR', scheme_color('menu', '#1ab394')); // coral, crimson, Inspinia green #1ab394

define('CCMPS_CCMP_NAME_CLR', scheme_color('primary', 'lightseagreen'));
define('CCMPS_CCMP_FNT_SZ','28px');
define('CCMPS_CRUD_TAB_TITLE_CLR', scheme_color('value', 'gray'));

// Trongate v2: required by engine/Core.php for 404 handling.
// Points at modules/templates/Templates.php::error_404()
define('ERROR_404', 'templates/error_404');

// Interface Parameters
// could set defaults for fonts  - currently ccmps line 4441

define('REQUEST_TYPE', $_SERVER['REQUEST_METHOD']);
define('MODULE_ASSETS_TRIGGER', '_module');
//define('DEFAULT_ENGINE', 'old'); // code checks for 'old' or else executes

// Security Settings
define('AUDITLOGGER', 1); // Auditlogging Level 1 = log everything
define('MINPWLGTH', (int) setting('MINPWLGTH', 6)); // password length used in layoutone.php - change password modal - used by ccmps view
define('DEFAULT_CCMP_PASSWORD','$2y$11$0vmDNooSnMscr6MRK./fuewANo6F2GkHfpMuPr/XzsltWBuOe0e5K'); // 123456
define('DEFAULT_USRNMEQEMAIL', 1); // 1 = TRUE 0 = FALSE CCMP
define('HONCHO_DEFAULT_USRNMEQEMAIL', 0); // 1 = TRUE 0 = FALSE CCMP
define('FORCE_PW_CHG_NEW_CCMP', setting('FORCE_PW_CHG_NEW_CCMP', '1')); // 1 = TRUE 0 = FALSE
define('SKIP_CHG_DEFAULT_USERNAME', 1); // Skip the page that allows changing the default username & Force PW Reset
define('SKIP_NEW_ACCT_CONFIRMATION', 1); // Skip showing the acct added to the users record and return to manage page
define('DEFAULT_CCMP_USER_LEVEL','7'); // 7 = CCMP

// CCMPS Filelibrary
define('CCMPS_FL_TAG1','Entity'); // Tag 1 - limit to 14 characters if possible

// DMS Filelibrary

define('DMS_FL_TAG1', setting('DMS_FL_TAG1', 'Organization')); // Tag 1 - limit to 14 characters if possible
define('DMS_SUBENTITY', setting('DMS_SUBENTITY', 'School')); // Subentity
define('DMS_FL_TAG2', setting('DMS_FL_TAG2', 'Category')); // Tag 2
define('DMS_FL_TAG3', setting('DMS_FL_TAG3', 'Type')); // Tag 3
define('DMS_FL_SAVE_BAK', 1); // rename .bak vs. overwrite if same name

// The DMS labels above and the Kanban headings below are rows of system_settings (System Settings > DMS);
// DMS_KBB_SHOW_HDR0/5 and FORCE_EDIT_* are read from that table by Dmslibrary into the session
//define('DMS_KBB_SHOW_HDR0', 1); // show 1st column - true/false
//define('DMS_KBB_SHOW_HDR5', 1); // show 6th column - true/false
define('DMS_KBB_HDR0', setting('DMS_KBB_HDR0', 'Unrefined (not ready to work)')); // Kanban Board Column Header 6 status id
define('DMS_KBB_HDR1', setting('DMS_KBB_HDR1', 'Backlog (ready to assign)')); // Kanban Board Column Header 5 status id
define('DMS_KBB_HDR2', setting('DMS_KBB_HDR2', 'In Progress')); // Kanban Board Column Header 4 status id
define('DMS_KBB_HDR3', setting('DMS_KBB_HDR3', 'In Review')); // Kanban Board Column Header 3 status id
define('DMS_KBB_HDR4', setting('DMS_KBB_HDR4', 'Pending Approval')); // Kanban Board Column Header 2 status id
define('DMS_KBB_HDR5', setting('DMS_KBB_HDR5', 'Approved')); // Kanban Board Column Header 1 status id

// DMS Sizes & Colors
define('DMS_CRUD_IBOX_HDR_CLR', scheme_color('accent', 'crimson')); // Tag 3
define('DMS_HM_TAB_TITLE_CLR', scheme_color('primary', 'darkgreen'));
define('DMS_HM_TAB_ICON_CLR', scheme_color('highlight', 'darkgreen'));
define('DMS_HM_TAB_TITLE_RED_CLR','crimson');  // Comment tab close
define('DMS_HM_TAB_ICON_RED_CLR','crimson');
define('DMS_BACK_BTN_CLR', scheme_color('label', 'darkgreen')); // CCMPS Back Button Color - lightseagreen
define('DMS_HM_TAB_CARET_CLR', scheme_color('value', 'lightgray')); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coralfine('DMS_DBRD_HDR_CLR','lightseagreen'); // CCMPS Dashbord Header Color - cornflowerblue,lightseagreen, coral
define('DMS_CRUD_TAB_TITLE_CLR', scheme_color('value', 'darkgreen')); // gray
define('DMS_CRUD_LABEL_CLR', scheme_color('label', 'darkgreen')); // lightseagreen
define('DMS_CRUD_VALUE_CLR', scheme_color('value', 'gray')); // coral

// SHOPPING CART SETTINGS
define('CURRENCY_CODE','USD');
define('CURRENCY_SYMBOL','$');

// Brevo Integration
define('BREVO_SMTP_KEY', env('BREVO_SMTP_KEY', ''));
define('BREVO_API_KEY', env('BREVO_API_KEY', ''));
define('SYNC_BREVO', (int) env('SYNC_BREVO', 0)); // 1 = SYNC, 0 no sync

// SMTP email (forgot password); the password lives in .env, never in code
define('SMTP_HOST', env('SMTP_HOST', 'smtp.gmail.com'));
define('SMTP_PORT', (int) env('SMTP_PORT', 465));
define('SMTP_USERNAME', env('SMTP_USERNAME', ''));
define('SMTP_PASSWORD', env('SMTP_PASSWORD', ''));

// PayPal Integration
define('PAYPAL_IPN','');  // "ON" or not. If ON paypal.php with save order, if not, thankyou.php will save order

define('PAYPAL_EMAIL_ADDRESS','payments@mybusiness.com');
