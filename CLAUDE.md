# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A member-management portal for Black Pilots of America (BPA), built on the **Trongate v2** PHP MVC framework (PHP 7.4 platform target in composer, runs under XAMPP locally). Internally the product is generic: "CCMPS" = Customers/Clients/Members/Participants, "Honcho" = the staff/back-office side, "DMS" = document management. Org-specific nomenclature (`CCMP` = "Member", `SUBENTITY` = "Chapter", etc.), branding colors, and feature flags all come from constants in `config/config.php`. Use those constants in UI text rather than hardcoding "Member"/"Chapter".

Git repo: private `github.com/ericvwoods/honcho` (branch `main`, created 2026-10-10). `.gitignore` keeps out `.env`, DB dumps, user uploads (DMS docs, `assets/<id>/` photos), unused theme files and backup copies. There is no build step and no test suite. PHPUnit is in `require-dev` but no tests exist.

## Running / debugging

- Local URL: `http://localhost/bpausa/`.
- **Secrets and per-install settings live in `.env`** (root, never committed; `.env.example` lists them): `BASE_URL`, `WHATENV`, `JWT_SECRET`, `DB_*`, `BREVO_*`, `SYNC_BREVO`, `SMTP_*`, `HONCHO_MODULE`. `config/env.php` loads it (real environment variables win, for Docker) and provides `env('NAME', default)`; `config/config.php` and `config/database.php` read from it. Never put a key or password back into a committed file.
- **Organization settings live in the `system_settings` table** (System Settings screen, `system-settings`, one tab per `category`): names and wording (`SITENAME`, `CCMP`, `SUBENTITY`, ...), contact links, the color scheme and logos (color constants are `scheme_color('<slot>', '<Classic color>')`), `CMS_PUBLIC_SITE` (1 = the front address shows the public Website), `CMS_MEMBER_BULLETINS`, financial settings, DMS labels. `config/config.php` defines those constants with `setting('<title>', <default>)` (`config/settings.php`), so code keeps using the constants. Where a new setting goes: secret or differs per server = `.env`; needs a code change = `config.php`; decided by the organization = a `system_settings` row added by a migration (Settings plan, `docs/todo.md`).
- Schema changes go in `database/migrations/<date>-<name>.sql` (written to be safe to re-run). Never put a `.sql` file in a module folder.
- DB config is in `config/database.php` (local MySQL `bpausa`). `ccmps.sql` / `ccmps_aux.sql` at the root are schema+test-data dumps. Treat the data as disposable.
- Composer deps (`vendor/`): phpspreadsheet, phpmailer, brevo. Run `composer install` from the root.
- Blank or partly rendered page: uncomment the `ini_set('display_errors'...)` lines at the top of `public/index.php`.
- Error log: `tail -30 /Applications/XAMPP/xamppfiles/logs/php_error_log`
- **500 errors on new files** are usually permissions (files copied through Finder end up `-rw-------`, which Apache can't read). Fix with:
  `find modules -name "*.php" -exec chmod 644 {} \; && find modules -type d -exec chmod 755 {} \;`
- The "Constant ... already defined" warnings are expected: `APPPATH` and `REQUEST_TYPE` are defined in both `config/config.php` and `engine/ignition.php`.
- Do not set `ENV` to `'dev'` casually. In dev mode `Core` redirects to `trongate_control` whenever a module folder contains a `*.sql` file, and several module folders do (e.g. `modules/pm/pm_schema.sql`).

## Request flow & routing

`.htaccess` → `public/index.php` → `engine/ignition.php` (session, config, autoloader, URL segments, helpers) → `new Core` (`engine/Core.php`).

- URL `/{module}/{method}` maps to `modules/{module}/{Module}.php::method()`.
- **Child modules** use a hyphen: `/welcome-ccmps/ccmphome` maps to `modules/welcome/ccmps/Ccmps.php::ccmphome()`. Most of the app lives as child modules under `modules/welcome/`, `modules/honcho/`, `modules/dms/`, `modules/cms/`, `modules/system/`.
- Methods starting with `_` can't be called from a URL. All helper/private logic follows this convention.
- Module assets are served through `/{module}_module/...` (`MODULE_ASSETS_TRIGGER`).
- 404s go to `templates/error_404` (`ERROR_404` constant). Custom routes are in `config/custom_routing.php`.

## Controller conventions

- Controllers `extends Trongate`. Through `__get` magic, `$this->model` is the generic `engine/Model.php`, a port of the **v1** Model kept so the ~3,000 legacy call sites keep working. Its methods take an explicit table name, e.g. `$this->model->get_where($id, 'ccmps_scopes')` (a null id returns false), `get_one_where`, `insert`, `update`, `query_bind`. Any other `$this->{name}` lazy-loads that module (e.g. `$this->templates`, `$this->trongate_tokens`).
- **Engine is a v1/v2 hybrid; keep 1.x code working.** For v2-style modules (currently only `modules/pm/`), the following were added on top of the hybrid engine:
  - `Trongate::make_model()`: if `modules/<module>/<Module>_model.php` exists, `$this->model` is that class (it must `extend Model` and call query methods on `$this`; there is no `$this->db` / Db module).
  - `modules/validation/Validation.php`: a minimal `$this->validation->set_rules()/run()` that checks the `form_close()` CSRF token and supports `callback_*`.
  - `block_url()` in `utilities_helper.php`.
  
  Stock-v2 code from elsewhere may need adapting to this.
- Pages render via `$this->templates->inspinia($data)` (back-office Inspinia theme, `public/themes/inspinia/`: Bootstrap 4.3.1, jQuery 3.7.1; unused theme files were removed 2026-10-25, so link only files that exist there, and restore a removed plugin from git rather than copying it in from elsewhere; see the Configuration chapter, Theme tab). Other layouts are `cool_mobi`, `public`, `store`, `boss`, `admin`. The template includes the content view named by `$data['view_module']` (e.g. `'welcome/ccmpsscopes'`) and `$data['view_file']`.
- Model rows come back as **objects** (`$row->field`), but `$data` passed to views is an **array**. A common bug is `$data->recid = ...` when it should be `$data['recid'] = ...`.
- Auth is session-based. Methods check `$_SESSION['trongatetoken']` and redirect to `welcome/logout` when it's missing. Per-controller `_check_function_permissions($fn)` switches on session flags (`ccmp_logged_in`, `ccmps_admin`, `ccmps_system_admin`, `honcho_sysadmin`, `honcho_ccmps_admin`, …). RBAC behavior is toggled by `CCMPS_RBAC`. System Settings and the Auditlog (`modules/system/settings`, `auditlogger`) are gated in their constructors by `system_admin_only()` (`utilities_helper.php`): staff sysadmins only when `HONCHO_MODULE=1` (Honcho deployed), member system admins only when `0` (Honcho Lite). Internal calls such as `logevent()` are not gated.
- **RBAC (being rolled out, plan approved 2026-10-18):** one shared permission system in Core `system`: person (`trongate_users.id`) → `system_groups` → `system_functions`, per `system_modules` row. Module code asks `rbac_allowed('pm','edit_projects')` / `rbac_require(...)` (`engine/tg_helpers/rbac_helper.php`); `rbac_person($tg_user_id)` names a login. Screens: `system-rbac` (same gate as Settings). Steps 1-2 (tables, helper, screens, data) are done; **PMS is switched** (step 3: `Pm.php` calls `rbac_allowed('pm', …)`, on/off is `rbac_module_enabled('pm')`) and **DMS is switched** (step 4: `Dmslibrary::_check_function_permissions()` maps each old function id to `dms/<code>`, `_check_doc_scope()` limits chapter admins and members to documents within reach; either login works). **CCMPS member admin roles are switched** (step 5): System/Member/Chapter/Student/Content/Event Admin are group memberships; the `ccmps` columns are a synced copy (`rbac_set_member_role()`, `rbac_sync_member_columns()`); login and refresh set the `ccmps_*` flags from the groups (`rbac_member_session_flags()`, which also sets `ccmps_admin`). Saving a member as Deceased removes all their roles and groups (`rbac_clear_member_access()`), and deceased members are refused login. Always change these roles through those helpers, never by writing the columns directly. Developer's Guide chapter: `chapters/security.js`.
- Flash messages: `set_flashdata($msg)`, plus `$_SESSION['flashmsgcolor']`.
- **Close returns to where the person came from**, not to the home page (owner, 2026-10-27). The linking page passes `?return=<path>`; the screen also accepts the same-site referrer, keeps it in the session while the person stays on that screen's pages, and accepts only a `module/method/args` path of this site. Copy `Cards::_return_url()` (`modules/welcome/cards/Cards.php`).
- Controllers start with a docblock "call map" listing each method and the `_helpers` it calls. Keep it up to date when you add methods.

### Maintenance-table CRUD pattern

Simple lookup tables (e.g. `modules/welcome/ccmpsscopes/`, `ccmpsaddresstypes/`, `ccmpsfinancialtypes/`) all use the same four-file shape, and new ones should copy it:
- `Xxx.php` (capitalized controller): `manage`, `createX`, `updateX`, `Xsubmit`, `delrecord`, `undelrecord`, `_fetch_data_from_post`, `_get_a_single_record`, `_check_function_permissions`, `_get_font_sizes`
- `views/manage.php` (datatable list), `views/xxxcrud.php` (lowercase single-record form), `views/navbar.php`

`ai prompts/simple/` holds the canonical example files and the prompt used to generate new ones. When moving a module to a different parent (e.g. `welcome` → `dms`), change the parent-module strings, but leave `welcome/logout` and `welcome-ccmps/ccmphome` as they are.

## Key subsystems

- **`modules/welcome/Welcome.php`**: login, second factor (`CCMP_SECOND_FACTOR_*` constants), logout, token generation, `mobile_bridge()`.
- **`modules/welcome/ccmps/Ccmps.php`** (~8.5k lines): the core member record system (home dashboard, CRUD, rosters, directory, exports). Its in-app developer docs are at `welcome-ccmps/helpdocs` (`views/helpdocs.php`).
- **`ccmps` / `ccmps_aux` split**: aviation-specific member fields (certificates, ratings, chapter role, `member_no`, `deleted`, …) live in `ccmps_aux` (keyed by `ccmp_id`), gated by `CCMPS_AUX_MODULE`. `ccmps_split_helpers.php` (root) is the single source of truth for which fields are aux (`_ccmps_aux_fields`, `_split_ccmp_data`, `_merge_ccmp_row`). `aux_field_query_report.txt` lists queries in `Ccmps.php` that still reference aux fields on `ccmps` directly. This migration is in progress.
- **Member cards** (`engine/tg_helpers/card_helper.php`, `modules/welcome/cards/`, table `ccmps_cards`; plan 2026-10-26): QR code `HC1:<card id>:<HMAC>` keyed by `CARD_SECRET` (or derived from `JWT_SECRET`), checked with `card_lookup()`. Phase 1 (portal + phone app) built; door check-in, then Google Wallet next; Apple Wallet and event registration later.
- **`modules/welcome/api/Api.php`**: JSON/JWT API (`login`, `mydata`, `update_mydata`, `chapterroster`, `directory`, `lookups`, `change_password`) used by the PWA in `public/ccmpsmobile/`. The field lists in `app.js` must match the `*_TEXT_FIELDS` lists in `Api.php` exactly.
- **`modules/honcho/`**: staff back office. **`modules/dms/`**: document library with kanban workflow (column labels `DMS_KBB_HDR*`). **`modules/cms/`**: the content manager (`cms-content`, menu name `CMS_LABEL` = "Website") for the member home and the public website (drawn by `cms_page()` in `engine/tg_helpers/cms_helper.php` and `modules/cms/content/views/site/`), being built in phases (`docs/todo.md`; Developer's Guide chapter `chapters/cms.js`). The old prototype CMS modules and their `cms_ccmps_*` tables were deleted in phase 3 (2026-10-20). **`modules/pm/`**: project management (see its README; enabled through a `system_settings` row).
- `trongate_*` modules are stock framework modules. `system_settings` table values plus `config.php` constants together control feature toggles.

## Developer's Guide (keep it updated)

`docs/developer-guide/` builds the single **Honcho Developer's Guide** (`.docx`): `guide.js` lists parts/chapters (Part I Core: CCMPS, DMS, Security, Website (CMS); Part II Add-ons: PMS; Part III: Developer Workstation, Deploying on DigitalOcean, Configuration; planned: Welcome, Participants/"Student"), and `chapters/<module>.js` holds each chapter. `chapters/ccmps.js` is hand-synced with `modules/welcome/ccmps/views/helpdocs.php`. Build: `node generate.js` (needs Node + `npm install docx`). **When you change a module's code, update its chapter (and `helpdocs.php` for CCMPS) in the same piece of work, and tell the user what changed.** `docs/code-walkthrough-list.md` tracks code to walk the owner through; `docs/todo.md` is the project to-do list (add items there when the user asks for something "on the list", and tick them off when done).

## Repo hygiene notes

- There are many dead or backup copies (`* copy.php`, `*_old.php`, `*.last`, `x*`-prefixed views/modules, `legacy views/`, `preclaudearchive/`). Edit the live file, which is the one without a suffix (e.g. `Ccmps.php`, `inspinia.php`, `app.js`). Don't "fix" the backups.
- If the user hand-edits a file outside the session, re-read it before changing it so their edits aren't overwritten from a stale copy.
