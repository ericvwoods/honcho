// ============================================================
// chapters/conventions.js — Conventions chapter of the Honcho Developer's Guide
// ============================================================
// Part III: Installation & Configuration. Written 2026-10-27: the coding
// patterns Honcho follows, in one place, each with its reason and where to
// see it in the code. Keep it current when a new pattern is agreed (CLAUDE.md
// carries the same rules in short form for Claude Code sessions).
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Where Things Go", blocks: [
  { type: 'p', text: "Honcho is one core product with a configuration per client (hybrid SaaS / custom). Most conventions exist to keep the core free of any one client, so a core release can go to every client." },
  { type: 'table', headers: ['Kind of thing', 'Home', 'Why', 'See'], rows: [
    ['Secrets, and anything that differs per server (address, database, keys, email)', '`.env`, read with `env()`', 'Never in git; each server has its own', 'Configuration chapter'],
    ['Things only a developer should change (routing, table names, structure)', '`config/config.php` constants', 'Changing them needs code', 'Configuration chapter'],
    ['Things the organization decides (names, wording, colors, logos, switches, financial year)', 'A `system_settings` row, read with `setting()`; System Settings screen', 'Each client sets its own without a code change', '`config/settings.php`'],
    ['Colors', '`scheme_color(\'<one of six>\', \'<Classic color>\')` constants', 'One scheme choice recolors everything; Classic = the old look', 'Configuration > Color Schemes'],
    ['Member-record fields a client may not want', 'A Member Fields switch (`CCMPS_SHOW_<FIELD>`), `ccmp_field_shown()`', 'Hide per client without deleting data or code', 'Configuration > System Settings'],
    ['Database changes', 'A dated, re-runnable file in `database/migrations/`', 'Same script on the Mac, staging and production; safe to run twice', 'below'],
    ['Client-only data fixes', 'Their own migration, clearly marked', 'Core migrations run for every client; data fixes only where they belong', 'to-do: core and client configurations'],
    ['Per-person preferences', 'Today: columns on `ccmps` / `honcho_user_accounts`. Planned: a core `system_user_preferences` table', 'One store for members and staff, survives member reloads', 'to-do: preferences table'],
  ]},
  { type: 'alert', variant: 'warning', text: "Never hard-code a client's name, wording, logo or color in a view. Use the constant (`SITENAME`, `CCMP`, `SUBENTITY`, `MAIN_LOGO`, the color constants)." },
]},

// ============================================================
{ tab: "Database", blocks: [
  { type: 'ul', items: [
    "**Every schema or data change is a migration** in `database/migrations/YYYY-MM-DD-<name>.sql`, with a header comment saying what and why. Never a `.sql` file in a module folder (it trips the engine's dev-mode check).",
    "**Safe to run more than once:** `CREATE TABLE IF NOT EXISTS`, `ADD COLUMN IF NOT EXISTS`, `INSERT IGNORE` on a unique key, `UPDATE ... WHERE` conditions that only match the first time. A re-run must never overwrite a value someone changed on a screen.",
    "**Back up before running** (Mac: `~/honcho-backups/`, staging: `~/backups/`), and note the backup in the to-do list entry.",
    "**Dropping a table** goes in its own script, run only after the change that replaced it has been checked (e.g. `2026-10-22-settings-phase1-drop-old-table.sql`).",
    "**Test data is disposable; real data arrives by ETL** from the legacy database before UAT and go-live. A data fix made on the test data must be repeatable in the ETL (to-do: Legacy data load).",
  ]},
  { type: 'p', text: "Queries: use `query_bind()` with named parameters for anything that comes from a user. Model rows are objects (`$row->field`); `$data` passed to a view is an array (`$data['field']`)." },
]},

// ============================================================
{ tab: "Security", blocks: [
  { type: 'ul', items: [
    "**Never assume a method is protected.** Many old `_check_function_permissions()` calls are commented out. Every public method that touches someone's data checks first.",
    "**Member records:** call `Ccmps::_member_access($recid, view|edit|create|admin)` before anything else; `_deny_member_access()` when it says no (Security chapter).",
    "**Other permissions:** Security Groups, `rbac_allowed('<module>', '<function>')` / `rbac_require()`. Member admin roles change only through `rbac_set_member_role()` and friends, never by writing the role columns.",
    "**Who you are comes from the session** (`$_SESSION['tg_user_id']`, `ccmp_rec_id`), never from the URL or a form field.",
    "**Every form that changes data is a POST with a session token** checked with `hash_equals` (e.g. `settings_token`, `cards_token`, `fontsize_token`). Links never change data.",
    "**Whitelists:** only fields on an explicit list are saved (`ccmpsubmit()`'s field lists); an absent text field is left alone, an absent checkbox saves as 0.",
    "**Methods starting with `_`** can't be reached from a URL: helpers are always `_`-prefixed.",
    "**Log it:** changes that matter go to the Auditlog with `logevent()` (who, what, old value, new value).",
    "**Text that goes straight into pages** (names, wording settings) can't contain `<` or `>`; everything else is escaped with `out()` / `htmlspecialchars()` when shown.",
  ]},
]},

// ============================================================
{ tab: "Screens", blocks: [
  { type: 'ul', items: [
    "**Close and Cancel go back where the person came from**, not to the home page. The linking page passes `?return=<path>`; the screen also accepts the same-site referrer, keeps it in the session while the person stays on its pages, and accepts only a `module/method/args` path. Copy `Cards::_return_url()`.",
    "**Per-person text sizes win.** Pages render with `$this->templates->inspinia($this->_with_fontsize_style($data))`. Never write a `font-size` inline on tabs, headings, labels, values or `.btn-label-text`; it overrides the member's choice. Use the existing classes instead.",
    "**Site-specific CSS goes in `themes/inspinia/css/custom.css`** (linked with a version number so browsers fetch changes), never in the theme's own `style.css`.",
    "**New libraries** go in their own pinned folder under `public/js/` with a README noting the version, licence and checksum (e.g. `qrcode-generator-1.4.4`), not into the theme and not from a CDN at run time.",
    "**Buttons:** Save and Cancel sit together, same size; no debug text on labels (old line numbers like \"128 Update\" were removed).",
    "**The top bar name** is `title_bar_name('member')` on member pages (BPA Member Portal) and `title_bar_name('admin')` on admin pages (BPA EMS): the words are System Settings > Organization (`SHORTSITENAME`, `SITENAME4`, `SHORTSITENAME2`), the colors the scheme's accent and primary. A new navbar calls the helper; never type the name into a view (old navbars said \"SGAP EMS\", another client's name, until 2026-10-27).",
    "**Hiding a member field** a client doesn't want: a Member Fields switch, never commenting it out.",
    "**Check it on screen.** For layout work, render the page in headless Chrome, screenshot and measure (`getBoundingClientRect`, `getComputedStyle`) at 1440 and 1280 wide before and after; a blind CSS fix once missed a third-party stylesheet that resized every button.",
  ]},
]},

// ============================================================
{ tab: "Code Style", blocks: [
  { type: 'ul', items: [
    "**Match the code around you:** naming, comment density and idioms of the file you're in. A simple change copies the existing pattern; a better approach is proposed, not slipped in.",
    "**Call map:** each controller starts with a docblock listing its methods and the helpers each calls. Keep it current.",
    "**Comments say why**, with the date when a rule was decided (e.g. \"Lifetime members (2099) are always Current, decided 2026-10-22\").",
    "**Shared logic is a helper** in `engine/tg_helpers/` (e.g. `card_helper.php`, `rbac_helper.php`, `wallet_helper.php`) when more than one module needs it; settings helpers that config needs live in `config/settings.php`.",
    "**Edit the live file**, never the backup copies (`* copy.php`, `*_old.php`, `x*` views).",
    "**Engine is a v1/v2 Trongate hybrid:** `$this->model` is the generic v1 Model; stock v2 code may need adapting (CLAUDE.md, Controller conventions).",
  ]},
]},

// ============================================================
{ tab: "Docs and Releases", blocks: [
  { type: 'ul', items: [
    "**When code changes, its docs change in the same piece of work:** the module's chapter here, the **Member Guide** (`docs/member-guide`) for anything every member sees, the **Administrator's Guide** (`docs/admin-guide`) for admin screens and setup walkthroughs, and `CLAUDE.md` for a new rule. Rebuilding a guide also refreshes its Help pages (`modules/help/content/<key>.json`); commit that file with it.",
    "**`docs/todo.md`** is the list: add what's asked for \"later\", tick items off with the date and the commit.",
    "**Syntax-check after editing:** `php -l` on PHP files, `node --check` on the guide's chapter files (a stray quote once stopped the guide from building).",
    "**Commits** say what changed and why; never commit `.env` or key files (Google Wallet's key lives in `~/honcho-keys/`).",
    "**Deploys** to staging: push, back up staging's database, pull and rebuild, run new migrations, then check the pages and logs. Always asked for first.",
  ]},
]},

];

module.exports = sections;
