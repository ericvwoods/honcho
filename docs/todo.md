# Honcho To-Do List

Started 2026-10-06. Tick items off as they're done; add the date.
Code walkthroughs are tracked separately in `code-walkthrough-list.md`.

## Security — do soon

- [ ] **Revoke the Gmail app password in `Welcome.php` `checkemail()`** (around line 1262) in the Google account, create a new one, and move SMTP settings out of the code.
- [ ] **Remove the PayPal sandbox logins, passwords and card numbers** from the comments in `config/config.php`; rotate anything still live.
- [ ] **Remove the `TEMP_2ND_FACTOR` bypass**: `'654321'` is accepted as a second factor by both logins when the session has no code (`Welcome.php` ~429, `Honcho.php` ~1387).
- [ ] **Call `session_regenerate_id(true)` after a successful login** in both logins (prevents session fixation).
- [x] DMS `manage()` takes the user's role from the URL. Fixed 2026-10-11 (`_get_dms_role()`), tested 2026-10-16.

## Login & accounts

- [ ] **Real second factor (2FA)**: a one-time code by **text (SMS)** or **email**, valid for a few minutes, single use. Required for anyone in an admin / super-user group; optional for other members. SMS provider: being set up. Replaces today's "member number" second factor.
- [ ] **Forgot password** for both logins (rebuild; the member version in `Welcome.php` is unfinished): random one-time token stored hashed with an expiry (~30 min); emailed (or texted) to the account's **own** address; same message whether or not the account exists; link works once; limit how often it can be requested; logged in the audit log. Today's version emails one hard-coded address with a hard-coded link, never creates a token, and `newpassword()` stops at a debug `die()`.
- [x] Decide: full authentication redesign or RBAC only. **RBAC only** for this version, keeping the two logins (2026-10-17).
- [ ] Later (backlog): full login redesign, with one login per person and members and staff as profiles.
- [ ] The Honcho login doesn't reset `acct_table`, so member and staff session flags mix when both logins are used in one browser.
- [ ] Chapter-admin delete redirects to the Honcho login.
- [ ] `/honcho` shows "Error 256" instead of the login page.
- [ ] **Staff Account profile CRUD**: staff side menu My Profile → My Account (`adminsidemenu.php` / `usersidemenu.php`) links to the old `honcho/index/system_accounts/view/<tg_user_id>` route and shows a blank page. Build view/edit for the logged-in staff member's own account (name, job title, email, phone, photo, font sizes, password change), likely from `modules/honcho/users/` (a copy of the CCMPS views, not wired up). Log changes with `logevent()`; update the Developer's Guide.
- [x] After the staff login the dashboard was drawn at `honcho/authenticate`, so the back button went to the login form's address; PMS's Home breadcrumb went to the member home. Login now redirects to `honcho`; PMS Home goes to `honcho` (2026-10-18).

## Permissions (RBAC)

- [x] Answer the 12 decisions in the [Honcho RBAC Implementation Plan](https://claude.ai/code/artifact/d55caab2-e13a-4502-bdbe-e52b7f7f4561), then approve it. All 12 recommendations accepted, plan approved (2026-10-18).
- [x] RBAC step 1: back up and build (five `system_*` tables, `rbac_helper.php`, `system-rbac` screens). Built and tested on the Mac 2026-10-18; backup `~/honcho-backups/bpausa-2026-10-18-before-rbac.sql.gz`. Local test logins cleaned up the same day (decision 9): `database/migrations/2026-10-18-cleanup-test-logins.sql` removed staff test logins 2, 4, 5, 6, linked login 3 to Eric's member record 1538, and cleared 585 made-up member login numbers (backup `~/honcho-backups/bpausa-2026-10-18-before-login-cleanup.sql.gz`). Tested by Eric; deployed to staging 2026-10-18 (e4c2789) with both scripts run there.
- [x] RBAC step 2: migrate the data (`2026-10-18-system-rbac-step2.sql` + report). Reviewed by Eric; on staging 2026-10-18 (fd9afa4).
- [x] RBAC step 3: switch PMS to Security Groups (`rbac_allowed()` per page, team picker via `rbac_people()`, menu via `rbac_allowed()`, Modules panel / `system_modules.enabled` instead of `PM_SYS_SETTING_ID`). On staging 2026-10-18 (4a24c68).
- [x] RBAC step 4: switch DMS to Security Groups (either login; chapter admins limited to their own chapter; `2026-10-18-system-rbac-step4.sql`). On staging 2026-10-18 (8aab527).
- [ ] RBAC step 5: CCMPS member admin roles live in Security Groups (Member Permissions, record checkboxes and Security screens all sync; login flags from groups). Built and tested on the Mac 2026-10-18.
- [x] Leslie Morris (1435, deceased) still had System/Chapter/Student Admin in the `ccmps` columns. Cleared 2026-10-19 (`2026-10-19-clear-deceased-member-roles.sql`); saving a record with Deceased ticked now removes all roles and group memberships (`rbac_clear_member_access()`).
- [x] Deceased members are refused login (2026-10-19): `username_pw_check()`, `mobile_bridge()`, and the API login and token check.
- [x] Locked members are refused login with "Your account has been locked. Please contact your <SUBENTITY> Administrator." (2026-10-19)
- [x] Soft-deleted accounts are refused login with "Your account has been deleted…" (2026-10-19).
- [ ] The unapproved check in `Welcome::username_pw_check()` still only `return`s (and `$unapproved` is never set), so it never stops a login. Decide whether approval should be enforced before turning it on.
- [x] `SUBENTITY` / `SUBENTITIES` used for screen text across the live member, CMS, DMS and Subentities screens (2026-10-19).
- [ ] Phone app branding: `public/ccmpsmobile/index.html` / `app.js` hard-code "BPA Member Portal", "Member", "My Chapter" and the "Chapter" tab. Have the API send the `CCMP` / `SUBENTITY` terms (and the org name) and fill them in.
- [x] Roster, directory and export crashed (500) on a blank lookup id: `Model::get_where()` now returns false for null (2026-10-19).
- [x] Roster, directory, export and master roster: aux fields joined (`_member_select()`), old column names renamed, aircraft from `ccmps_aircraft`, and the roster/directory views now actually list members (2026-10-19).
- [x] Every DMS file upload gave a 500: `$this->file->upload()` (stock v2 File module) doesn't exist here, and two `$this->dmslibrary->viewdocrec()` self-calls crashed. New `_upload_doc()` in `Dmslibrary.php`; Mac upload folders made writable (2026-10-18).
- [ ] DMS: replacing the file on a document that already has one is unfinished - deliberate `echo(6233); die();` / `echo(4812); die();` stops in `submit_upload()`, and its duplicate check (`isset()` on `false`) always says "already associated". First uploads work.
- [x] Saving a new DMS document gave a 500: `document_id` required with no default (strict mode). Default `''` added in the step 4 script; the document form's copied delete pop-up crashed on an unset `$attr_close` (2026-10-18).
- [ ] RBAC step 6 (later): delete the unused `system_settings` row 16 (`PM_SYS_SETTING_ID`) along with the old `pm_*` security tables.
- [x] RBAC step 4: decide what DMS functions Chapter Admins need (the dmslibsubadmin role has none in the tables; it's handled in code today). Decided 2026-10-18: manage their own chapter's documents (all DMS functions, own chapter only).
- [ ] Creating a member inserts into `trongate_users` with columns this database doesn't have (`user_level_id`, `user_acct_info_table`, `code`; this table has `title`, `login_acct_table_id`, `login_acct_info_table`) - `Ccmps.php` ~3285 and ~3978. Check the real BPA `trongate_users` before go-live: RBAC and member creation must agree on one shape.
- [x] Staff DMS checks in `Dmslibrary.php` look for staff security groups 5-8, which don't exist. Turned out to be commented out (dead code), 2026-10-18.
- [x] Member side menu showed the Admin tile (and an empty Reports menu) to members with no admin role, e.g. Chapter President only. Now one `$has_admin_menu` check in `sidemenu.php` (2026-10-16, verified).
- [x] Member Permissions screen (`welcome-ccmpspermissions/manage`): see and set every member's admin roles in one list (2026-10-16).
- [x] Member Admin role doesn't open the Member Admin menu: login sets `ccmps_ccmp_admin` (from `ccmp_admin`) but menus check `ccmps_admin`, which only "refresh my session data" sets, from a nonexistent `admin` column. Fixed 2026-10-18 (RBAC step 5: `rbac_member_session_flags()` sets `ccmps_admin`).
- [ ] Student Admin has no section in the member side menu (only the older `ccmphome.php` layout has one).

## DMS

- [ ] `header5()` saves the text "Approved" into the numeric `status` column, so the save fails in strict mode (should be `1`).
- [x] Security group → role data is incomplete (group 1 → missing role 6; groups 2–4 no role). No longer read: DMS uses Security Groups (RBAC step 4, 2026-10-18).
- [x] Subentity Admin gets "Error 5103" after moving a card (case commented out). Fixed 2026-10-18 (case restored in header0, backlog, pending, header5).
- [x] `manage()` gives a 500 error when nobody is logged in. Fixed 2026-10-18: goes to the login page.
- [ ] Test the manage-page filters while logged in after the 2026-10-06 SQL-injection fix.
- [ ] Drop the old CMS library tables (`cms_ccmps_filelibrary_*`, 11 tables incl. `..._docs_atis_seed`). The `cms-ccmpslibrary` module was removed 2026-10-16 and no code reads them. Do it on the Mac, staging and `ccmps.sql` together.

## PMS (add-on)

- [ ] Test the logged-in pages and forms on this engine.
- [x] Remove the `ini_set('display_errors'...)` / `error_reporting` debug lines at the top of `Pm.php`. Done 2026-10-18 (RBAC step 3).
- [x] Team-member picker lists nobody (fixed by RBAC plan step 3: build the list from `trongate_users`). Done 2026-10-18 (RBAC step 3).
- [x] `PM_SYS_SETTING_ID` is hard-coded in `Pm.php`. Done 2026-10-18 (RBAC step 3).
- [ ] Add PMS to the mobile menu in `ccmphome.php` (`device_type == 2`).
- [x] Staff side menu had no PMS link. Added PMS → Projects to `adminsidemenu.php` (2026-10-18).
- [ ] Member side menu shows PMS → Projects to member system admins, but `Pm.php` `check_permission()` only accepts the staff login (`authenticated`), so a member who clicks it lands on the staff login. Link hidden 2026-10-18 (`if(false && …)` in `sidemenu.php`). Decided 2026-10-18: running PMS needs the Honcho staff module, so the full member link doesn't come back; see the next item.
- [ ] Later (backlog): members can view a project's kanban board and work only the tasks assigned to them (`pm_story_tasks.assignee`). Needs the PMS kanban/task pages (not built yet) and RBAC step 3 first; then a "PM Participants" group with two functions plus an "assigned to me" filter.

## Participants module (add-on, branded "Student" for BPA)

- [ ] Design: two `system_settings` rows for the label (singular + plural).
- [ ] Seed from `ccmps` where `ccmp_type = 4`; decide on type 3, payments, aircraft, logins, and what happens to the moved `ccmps` rows.

## Daily Coffee Report (add-on)

- [ ] Answer the 8 questions in the [Daily Coffee Report plan](https://claude.ai/code/artifact/10a47ac5-0f45-4456-8550-1aedf286a9f1) (sections and options, skill vs scripts, AI vs plain data, who schedules, who delivers, Docker layout, Hermes profiles, who may use it).
- [ ] Phase 1: prove the Hermes handoff by hand (`coffee-brief` reads a `<config>` block; one job created with curl via `POST /api/jobs`).

## Developer's Guide

- [ ] Chapters still to write: CMS & Welcome, Participants, Configuration (config folder and per-client changes). "Deploying on DigitalOcean" started 2026-10-08 (`chapters/deployment.js`); keep it updated as each DO-xx step is done.
- [ ] CCMPS Testing tab describes `lib/CcmpsPermissions.php` and `run_integration_tests.sh`, which aren't in the project.
- [ ] Delete the old `CCMPS_Developer_Documentation.docx` (superseded).
- [ ] Install Node.js on this Mac so the guide can be rebuilt without a temporary copy.
- [ ] Rebuild both guides (`docs/developer-guide`, `docs/users-guide`): chapters changed 2026-10-16 (DMS, deployment, CCMPS Member Permissions; Users' Guide System Admin, staff portal, ATIS).

## Home page content (CMS)

- [x] All 8 content modules read a table named `scopes`; now `ccmps_scopes` (2026-10-16). Can't be tested until the item below is done.
- [x] ~~Finish the 8 content modules~~ - replaced by the content manager below (decided 2026-10-20: the old CMS code and tables were a prototype; rebuild, best practices, throw the old ones out). Their debug stops were commented out 2026-10-20.

**Content manager for the member home (`ccmphome.php`) and a public website (plan agreed 2026-10-20; sign-off after each phase):**
- [x] Phase 1 - Foundation (built 2026-10-20, approved): tables `cms_sections` (on/off for member home and public site, order, heading, one-page menu label), `cms_items`, `cms_media` (picture library), `cms_posts` (Sunshine, Bulletin Board stickies, Marquee, Careers), `events` (top level of the future Event Module). Permissions in Security Groups: the existing Content Admin and Event Admin checkboxes become member roles (groups Content Admins, Event Admins); new `cms` functions; Chapter Admins add events for their own chapter; staff get the same through the Security Groups screen.
- [ ] Phase 2 (built and tested on the Mac 2026-10-20, waiting on sign-off; menu name is the `CMS_LABEL` constant, "Website") - Content manager screens (`cms-content`), from both the staff and member menus: sections list (show/hide per site, order, headings, menu labels), items per section, picture uploader and picker.
- [ ] Phase 3 - Feed screens on `cms_posts`: Sunshine (illnesses, deaths), Bulletin Board (yellow stickies), Marquee, Careers (with a detail page per job, public). Delete the 8 old CMS modules and their `cms_ccmps_*` / `cms_users_*` tables.
- [ ] Phase 4 - `ccmphome.php` rebuilt from the tables, keeping the Inspinia look: the 11 demo sections plus Sunshine, Bulletin Board, Calendar, Marquee, Metrics (member home only) and Careers; the one-page top menu (click, scroll to the section) is built from the sections switched on.
- [ ] Phase 5 - Events calendar (Inspinia FullCalendar): Chapter Admins add events for their chapter, Event/Content Admins for any; public checkbox; member home shows all, public site only public ones.
- [ ] Phase 6 - Public website in the Welcome module: same template, the sections switched on for public, plus public calendar and Careers. Then load BPA's text and pictures from bpapilots.org.
- [ ] Last: Event Module - rewrite registration's hard-coded events (Skyhook, General Meeting, Board Meeting) to use `events` with an `event_activities` child table; the calendar keeps reading `events`.

## Small fixes

- [ ] System > Subentities (Chapters) gives a 500 on every page: it reads/writes `system_subentities`, which doesn't exist. The real table is `ccmps_subentities` (different columns, e.g. `chapter_title`). Decide whether it gets the staff-only / Lite rule like Settings and the Auditlog.
- [ ] Member home ATIS tile hidden 2026-10-16 (it downloaded doc 1 from the removed CMS library). Upload ATIS to DMS and put its id in the link in `ccmphome.php`, then re-add it to the Users' Guide.

- [ ] Debug line numbers show on buttons: "128 Update" (`viewccmp.php` line 128) and "69Cancel" / "80 Cancel" (`ccmpcrud.php` lines 70 and 81).
- [ ] Member-list bulk actions Lock, Unlock, Approve User Acct, Approve CCMPS and Archive are listed but do nothing (`Ccmps.php` `bulkaction()`).

- [x] `sidemenu.php` Content Admin block is missing its closing `</li>` (~line 161). Replaced by the Website block 2026-10-20.
