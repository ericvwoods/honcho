// ============================================================
// chapters/configuration.js — Configuration chapter of the Honcho Developer's Guide
// ============================================================
// Part III: Installation & Configuration. Written 2026-10-25 at the end of
// the Settings plan (phases 1-4): where every setting lives, the System
// Settings screen, color schemes, the theme, and what to change for a new client.
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Three Homes", blocks: [
  { type: 'p', text: "Every setting has exactly one home. Ask these questions in order; the first \"yes\" decides." },
  { type: 'table', headers: ['Question', 'Home', 'Changed by'], rows: [
    ['Is it a secret, or does it differ between the Mac, staging and production?', '`.env` (never committed; `.env.example` lists every name)', 'Whoever runs the server'],
    ['Would changing it need a code change, or break the app if changed by mistake?', '`config/config.php` (committed)', 'A developer'],
    ['Is it something the organization decides while running?', 'A row of `system_settings`, on the **System Settings** screen', 'The admin who owns it; logged in the Auditlog'],
  ]},
  { type: 'p', text: "Code reads all three the same way: as a constant. `config.php` defines `.env` values with `env('NAME', default)` and table values with `setting('TITLE', default)`, so a view writes `<?= SUBENTITY ?>` whichever home the value has. The default written in `config.php` is used when the row is missing or the database can't be read." },
  { type: 'alert', variant: 'warning', text: "Never put a key or password in `config.php` or a migration. Secrets go in `.env` only." },
  { type: 'h2', text: 'How It Loads' },
  { type: 'ul', items: [
    "`config/env.php` reads `.env` (real environment variables, as Docker passes them, win) and provides `env()`.",
    "`config/settings.php` provides `setting($title, $default, $refresh = false)` and `scheme_color($slot, $default)`. They read `system_settings` and the chosen row of `system_color_schemes` once per page, with their own PDO connection, because `config.php` runs before the database layer. A failure is written to the PHP error log and every constant falls back to its default.",
    "`config/config.php` defines the constants. `config/site_owner.php` (stock Trongate names) follows the organization name and support phone.",
  ]},
]},

// ============================================================
{ tab: "System Settings", blocks: [
  { type: 'p', text: "`system-settings` (`modules/system/settings/Settings.php`): one tab per `category`. Each person sees only the rows they may change; a save is checked row by row on the server. The Security chapter, System Settings tab, has the permission details." },
  { type: 'table', headers: ['Tab', 'Settings (system_settings.title)', 'Who'], rows: [
    ['Financial', '`system_current_year`, `grace_period`, `current_dues_pmt_year`, `dues_proration`. Saving the year or grace period re-checks every member\'s status after a confirmation. Lifetime members (year 2099, `CCMP_LIFETIME_YEAR`) stay Current.', 'Financial Admins, System Admins'],
    ['Organization', '`SITENAME`, `SHORTSITENAME`, `SITENAME2` (system name), `SITENAME4` / `SITENAME3` (member / staff login headings), `SHORTSITENAME2`, `PUBLIC_WEBSITE`, `SYS_ADMIN_PHONE`, `FACEBOOK_URL`, `TWITTER_URL`, `YOUTUBE_URL`', 'System Admins'],
    ['Wording', '`CCMP` / `CCMPS` (Member), `SUBENTITY` / `SUBENTITIES` (Chapter), `HONCHOUSER` / `HONCHOUSERS` (Staff), `CMS_LABEL` (Website), `CCMP_SECOND_FACTOR_NAME`, `SYSTEM_SECOND_FACTOR_NAME`', 'System Admins'],
    ['Member Fields', 'Designated fields of the member record a client can hide: `CCMPS_SHOW_DEPARTMENT`, `CCMPS_SHOW_REPORTS_TO`, `CCMPS_SHOW_LEADSOURCE` (all hidden for BPA). Views ask `ccmp_field_shown(\'department\')` (`config/settings.php`); a field with no row is always shown. A hidden field isn\'t on the profile or the edit form, and saving keeps its stored value. To designate another field: add a `CCMPS_SHOW_<FIELD>` row by migration (category Member Fields) and wrap that field in `ccmp_field_shown()` in `viewccmp.php` and `ccmpcrudcontact.php`.', 'System Admins'],
    ['Look', '`COLOR_SCHEME`, `MAIN_LOGO`, `HDR_LOGO` (default logo or a picture from Website > Pictures), `HOTLINK` / `HOTLINKLABEL` (member home button)', 'System Admins'],
    ['Features & Policy', '`CMS_PUBLIC_SITE` (front address shows the public website), `CMS_MEMBER_BULLETINS`, `MINPWLGTH` (6-64), `FORCE_PW_CHG_NEW_CCMP`', 'System Admins'],
    ['DMS', '`DMS_SUBENTITY`, `DMS_FL_TAG1-3`, Kanban headings `DMS_KBB_HDR0-5`, `DMS_KBB_SHOW_HDR0/5`, `FORCE_EDIT_TO_IN_PROG`, `FORCE_EDIT_TO_BACKLOG`', 'System Admins'],
  ]},
  { type: 'p', text: "Rows 1 and 2 are the current year and grace period: the staff login (`Honcho.php`) still reads them by id. Everything else reads by title." },
  { type: 'h2', text: 'Adding a Setting' },
  { type: 'ol', items: [
    "Write a migration in `database/migrations/` that inserts the row with `INSERT IGNORE` (so a re-run never overwrites a value changed on the screen): `title`, `label`, `settingvalue`, `category` (an existing tab or a new one), `input_type`, `options`, `rbac_function` (`edit_settings`, or `edit_financial_settings` for the Financial tab), `help`, `sort_order`.",
    "In `config.php`: `define('MY_SETTING', setting('MY_SETTING', '<default>'));` - or `(int) setting(...)` for numbers and switches. Code outside `config.php` that needs it after a save can call `setting('MY_SETTING', <default>)` directly.",
    "Input types: `text` (required, no < or >), `yesno`, `year`, `number` (`options` = range such as `6-64`), `fraction` (0-1), `url` (blank, `#` or https://), `phone`, `select` (`options` = `value=Label;value=Label`), `scheme`, `image`. A new kind of input needs a case in `Settings::_validate()` and in the view's `$setting_input`.",
    "Add it to the table above. New settings never come from the screen: a row does nothing until code reads it.",
  ]},
]},

// ============================================================
{ tab: "Color Schemes", blocks: [
  { type: 'p', text: "The Look tab's color scheme (`COLOR_SCHEME` = an id in `system_color_schemes`). A scheme is six colors, each with one job:" },
  { type: 'table', headers: ['Color', 'Used for', 'Classic value'], rows: [
    ['Primary', 'Site name, top bar, headings, member names, tab titles', 'lightseagreen'],
    ['Accent', 'Second part of the site name, record box headers', 'crimson / coral'],
    ['Highlight', 'Icons, collapse titles', 'coral, gray'],
    ['Label', 'Form labels, table headings, Back buttons', 'darkgreen, black'],
    ['Value', 'Values beside labels, table text, tab captions, carets', 'gray, lightgray'],
    ['Menu', 'Side menu text and icons', '#1ab394'],
  ]},
  { type: 'ul', items: [
    "Every color constant in `config.php` is `scheme_color('<color>', '<its Classic color>')` - 57 of them. The red and green DMS tab colors mean something (closed / open), so they aren't schemed.",
    "**Classic** stores no colors: each constant keeps the color written in `config.php`, exactly as before schemes. Inspinia, Navy & Gold and Slate & Crimson give each job one color everywhere. **Custom** is the scheme whose six colors are set with color pickers on the screen.",
    "A new scheme is a row in `system_color_schemes` (by migration). Choose colors that read on white.",
    "Not yet covered: about 229 colors typed straight into views. Move them to the constants as screens are touched (to-do list).",
  ]},
]},

// ============================================================
{ tab: "Theme", blocks: [
  { type: 'p', text: "The screens use **Inspinia**, a paid admin theme, in `public/themes/inspinia/`: **Bootstrap 4.3.1** underneath, the Inspinia skin (`css/style.css`, `js/inspinia.js`), and plugins such as DataTables, metisMenu (side menu), slimScroll, SweetAlert, FullCalendar 3, Chart.js, Flot, Summernote and jQuery UI. Pages load it through `$this->templates->inspinia($data)` and by linking files under `themes/inspinia/` directly (64 live files). The member home and public website also use its `Landing_Page/` styles and `img/landing/`." },
  { type: 'table', headers: ['Item', 'Now'], rows: [
    ['jQuery', '**3.7.1** (`js/jquery-3.7.1.min.js`, checksum matches jquery.com), on the 61 Inspinia pages since 2026-10-25. Was 3.1.1 (2016). The old file stays until the screens have been click-tested, so going back is a find-and-replace of the file name; then delete it.'],
    ['Files', 'Only what the app references. On 2026-10-25 an audit of every `themes/inspinia/...` path in the code (and the fonts and images the kept CSS loads) removed 488 unused files: the 120 demo pages, unused `js/plugins` and `css/plugins` folders, demo scripts, email templates. They are in git history (commit 8947f68).'],
    ['`Utils/`', 'The theme\'s original source package (247 MB). Ignored by git, so never deployed; kept on the Mac only.'],
    ['Known gap', '5 pages load `js/plugins/bs-custom-file/bs-custom-file-input.min.js`, which was never in the theme (404; file inputs work without it).'],
    ['Licence', 'Paid themes are usually licensed per end product; check Inspinia\'s terms before deploying Honcho for more than one client.'],
  ]},
  { type: 'h2', text: 'Rules' },
  { type: 'ul', items: [
    "**Need a plugin that was removed?** Restore just that folder from git: `git checkout 8947f68~1 -- public/themes/inspinia/js/plugins/<name>` (and its `css/plugins/<name>` if it has one).",
    "**Never edit the theme's own files** (`css/style.css`, `js/inspinia.js`): add rules to `css/custom.css` or the page, so the theme can be updated or replaced.",
    "**New libraries** go in their own pinned folder, as FullCalendar 6.1.15 did (`public/js/fullcalendar-6.1.15/`), not into the theme.",
    "Colors come from the color scheme constants (Color Schemes tab), not typed into views.",
  ]},
  { type: 'h2', text: 'Where It Is Going' },
  { type: 'p', text: "Decided 2026-10-25: keep Inspinia for now rather than hand-writing a copy of it, and move gradually to **free Bootstrap 5 plus a small Honcho stylesheet** that keeps Inspinia's look and class names (`ibox`, `navbar-static-side`, ...), screen by screen as screens are touched. Bootstrap 5 is built on CSS variables, so the color schemes become real variables, and no theme licence is needed at the end. Other old layouts (janux, epona, cool_mobi) load their own older jQuery copies; they are on the to-do list to check and update or delete." },
]},

// ============================================================
{ tab: "config.php", blocks: [
  { type: 'p', text: "What stays in `config/config.php` after the Settings plan (2026-10-25: 124 constants; 60 unused ones and three duplicate definitions were deleted):" },
  { type: 'table', headers: ['Group', 'Constants'], rows: [
    ['From .env', '`BASE_URL`, `WHATENV`, `JWT_SECRET`, `HONCHO_MODULE`, `BREVO_*`, `SYNC_BREVO`, `SMTP_*` (database settings are in `config/database.php`)'],
    ['Engine & routing', '`APPPATH`, `ADMINTHEME`, `DEFAULT_MODULE`, `DEFAULT_CONTROLLER`, `DEFAULT_METHOD`, `ERROR_404`, `REQUEST_TYPE`, `MODULE_ASSETS_TRIGGER`, `ENV` (keep `prod`: `dev` redirects to trongate_control), `DEBUGGING`, `VERSION_RELEASE`'],
    ['Structure', '`CCMPS_AUX_MODULE`, `CCMPS_ADDR_TABLE`, `CCMP_SECOND_FACTOR_FIELD_NAME`, `SYSTEM_SECOND_FACTOR_FIELD_NAME`, `SUBENTITY_NATIONAL_ID`, `CCMP_LIFETIME_YEAR`, `DEFAULT_CCMP_USER_LEVEL`, `DMS_FL_SAVE_BAK`, `AUDITLOGGER`'],
    ['Account behaviour', '`DEFAULT_CCMP_PASSWORD` (to be replaced: to-do), `DEFAULT_USRNMEQEMAIL`, `HONCHO_DEFAULT_USRNMEQEMAIL`, `SKIP_CHG_DEFAULT_USERNAME`, `SKIP_NEW_ACCT_CONFIRMATION`, `USERS_IDNUM_REQ`, `WELCOME_BYPASS_2ND_FACTOR`'],
    ['Kept for coming work', '`DEVEMAIL`, `WHATENV` (forgot password), `CURRENCY_CODE`, `CURRENCY_SYMBOL`, `PAYPAL_*` (Event Module payments)'],
    ['Look', 'The color constants (`scheme_color()`), font sizes (`*_FNT_SZ`, `SN_FNT_WT`), `SMALL_LOGO`, `PLAIN_LOGO`'],
    ['Organization (from the table)', 'Everything on the System Settings tabs, via `setting()`'],
  ]},
]},

// ============================================================
{ tab: "New Client", blocks: [
  { type: 'p', text: "Setting Honcho up for another organization. Most of it is the System Settings screen; nothing in the code changes." },
  { type: 'ol', items: [
    "**Server:** copy `.env.example` to `.env` and fill it in (site address, database, `JWT_SECRET`, email, `HONCHO_MODULE` = 1 with the staff back office or 0 for Honcho Lite). See the Deploying on DigitalOcean chapter.",
    "**Database:** load the schema and run every file in `database/migrations/` in date order.",
    "**Organization tab:** names, public website, support phone, social links.",
    "**Wording tab:** what they call members, chapters and staff, and the second-factor names.",
    "**Look tab:** upload their logo under Website > Pictures, pick it as Logo and Header logo, choose a color scheme (or Custom with their brand colors).",
    "**Features & Policy tab:** public website on or off, member sticky notes, password rules.",
    "**Financial tab:** current year, grace period, dues payment year, proration. Give their treasurer the Financial Admin role.",
    "**Chapters:** System Admin > Chapters. Set `SUBENTITY_NATIONAL_ID` in `config.php` if they have a national office row (BPA: 99), or 0.",
  ]},
]},

];

module.exports = sections;
