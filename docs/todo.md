# Honcho To-Do List

Started 2026-10-06. Tick items off as they're done; add the date.
Code walkthroughs are tracked separately in `code-walkthrough-list.md`.

## Security — do soon

- [ ] **Revoke the Gmail app password** (noreply.honcho@gmail.com) in the Google account, create a new one and put it in `.env` (`SMTP_PASSWORD`) on the Mac and on staging. Moving the SMTP settings out of the code into `.env` was done 2026-10-22; the old password is still in git history.
- [x] Remove the PayPal sandbox logins, passwords and card numbers from `config/config.php`. Already gone, and never in git (checked 2026-10-22).
- [x] Remove the `TEMP_2ND_FACTOR` bypass (`654321`). Done 2026-10-22 in both logins; a blank entry no longer passes for an account with no second factor either (`hash_equals`, blank never matches).
- [x] `session_regenerate_id(true)` at the start of both `successfullogin()` functions (2026-10-22). Both logins tested on the Mac (staff by Eric).
- [x] DMS `manage()` takes the user's role from the URL. Fixed 2026-10-11 (`_get_dms_role()`), tested 2026-10-16.

- [x] **Member records open to any logged-in member** (found and proved 2026-10-27, test values restored; fixed 2026-10-27, not yet deployed). One rule, `Ccmps::_member_access($recid, view|edit|create|admin)` with `_national_admin()` and `_deny_member_access()`: own record; Member/System Admins and staff any; Chapter Admins their own chapter; Student Admins Q and S members (types 3, 4); create and admin actions for admins only. Applied to: `viewccmp`, `updateccmp`, `createccmp` (also crashed for everyone: missing default argument, and a `genders` table that is `ref_genders`), `ccmpsubmit` (a Chapter Admin's new members go in their own chapter), `export` (all members: national admins; own chapter: Chapter Admins), `mastercurrentroster` (national admins), `lockacct`, `unlockacct`, `bulkaction` (selected records filtered to the admin's members), `ditch_picture` (own or admin), `createccmpuseraccount`, `ccmpuseracctsubmit`. Before: an ordinary member could view, edit and save anyone's record, download the full member export and the national roster, lock accounts, run bulk actions and delete photos.
- [ ] Audit the rest of `Ccmps.php` (and the other modules) for public methods whose permission check is commented out; this round covered the member record actions above.

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
- [ ] RBAC step 6 (later): delete the old `pm_*` security tables. (`system_settings` row 16, `PM_SYS_SETTING_ID`, was deleted 2026-10-22 in settings phase 1.)
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
- [x] Drop the old CMS library tables (`cms_ccmps_filelibrary_*`). Done with the other old CMS tables in `2026-10-20-cms-drop-old-tables.sql` (not in `ccmps.sql`).

## PMS (add-on)

- [ ] **Reverse-engineer user stories with acceptance criteria for each module** (owner, 2026-10-27) and store them in PMS once its story pages are finished. PMS already has the tables: `pm_stories` (title, description, status, priority, points, accepted by/at) and `pm_story_criteria` (the acceptance criteria per story).
    - One PMS project per module: CCMPS (members), DMS, Security (RBAC and logins), Website (CMS), System Settings, Member Cards, PMS itself, Welcome; later the Student module and Events.
    - Each story written from the role's side ("As a Chapter Admin, I can ... so that ..."), with testable criteria (Given / When / Then), drawn from the code, the Developer's and Users' Guides and the decisions in this list.
    - Can be drafted before PMS is ready (a file per module, imported by a script later), and doubles as the **UAT test script**: worth having before UAT starts.
    - **The system project (owner, 2026-10-27):** every client gets a **pre-seeded project that represents the system itself** (its modules' stories and criteria), alongside the projects the client creates. Design notes:
        - Marked as the system project (e.g. a flag on `pm_projects`), seeded by a core migration; **core stories come with each core release**, the client's own (custom) stories are added to it per client (core-and-client model).
        - An **option to surface it** (System Settings switch: shown or hidden in the project lists).
        - **Only certain users, in defined roles**: Security Groups functions for it (e.g. view, comment, accept stories, edit), separate from ordinary PMS access. Which roles get what: to decide with the owner.
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
- **Who goes where (decided 2026-10-27):** members with type **Q, Qualified Student** (`ccmp_type` 3) **stay in CCMPS** and **vote**. Students who take part in BPA programs and have a regular **S, Student** membership (`ccmp_type` 4) **move to the Student module** and **don't vote**. The **Student checkbox** on the member record (`ccmps.student`) is information only; it decides nothing.
- [ ] Seed from `ccmps` where `ccmp_type = 4`; still to decide: payments, aircraft, logins, and what happens to the moved `ccmps` rows. Do it in the ETL from the legacy database, not just on the test data.
- [ ] Voting: Student-module participants are never eligible voters (handled by the **Eligible voter rules** task below).
- [ ] Then the CCMPS **Student Members** list (`manage/mosm`, `mcmm`) and the home-page student counts mean Q members only (`ccmp_type` 3), which the counts already use.

## Daily Coffee Report (add-on)

- [ ] Answer the 8 questions in the [Daily Coffee Report plan](https://claude.ai/code/artifact/10a47ac5-0f45-4456-8550-1aedf286a9f1) (sections and options, skill vs scripts, AI vs plain data, who schedules, who delivers, Docker layout, Hermes profiles, who may use it).
- [ ] Phase 1: prove the Hermes handoff by hand (`coffee-brief` reads a `<config>` block; one job created with curl via `POST /api/jobs`).

## Developer's Guide

- [x] **Conventions chapter** (Part III, `chapters/conventions.js`, 2026-10-27): where things go, database, security, screens, code style, docs and releases. Keep it current when a pattern is agreed.
- [ ] **Per-user preferences table** (core): `system_user_preferences` (login id = `trongate_users.id`, preference key, value) instead of columns on `ccmps` (`tab_setting` ... `button_setting`, `fontsize`, `mfontsize`, `language`) and on `honcho_user_accounts` (`fontsize`, `tfontsize`). One store for members and staff; new preferences need no table change; the Font pop-up then works for staff too; member reloads (ETL) don't touch preferences. Do before the ETL (requested 2026-10-27).
- [ ] Chapters still to write: Welcome, Participants. (Configuration written 2026-10-25.) "Deploying on DigitalOcean" started 2026-10-08 (`chapters/deployment.js`); keep it updated as each DO-xx step is done.
- [ ] CCMPS Testing tab describes `lib/CcmpsPermissions.php` and `run_integration_tests.sh`, which aren't in the project.
- [ ] Delete the old `CCMPS_Developer_Documentation.docx` (superseded).
- [ ] Install Node.js on this Mac so the guide can be rebuilt without a temporary copy.
- [x] Rebuilt both guides 2026-10-25 (temporary Node 20 + docx 9 in the session's scratch folder); fixed two unescaped quotes in `chapters/cms.js` that had stopped the Developer's Guide from building. Run `node --check chapters/*.js` after editing a chapter.

## Home page content (CMS)

- [x] All 8 content modules read a table named `scopes`; now `ccmps_scopes` (2026-10-16). Can't be tested until the item below is done.
- [x] ~~Finish the 8 content modules~~ - replaced by the content manager below (decided 2026-10-20: the old CMS code and tables were a prototype; rebuild, best practices, throw the old ones out). Their debug stops were commented out 2026-10-20.

**Content manager for the member home (`ccmphome.php`) and a public website (plan agreed 2026-10-20; sign-off after each phase):**
- [x] Phase 1 - Foundation (built 2026-10-20, approved): tables `cms_sections` (on/off for member home and public site, order, heading, one-page menu label), `cms_items`, `cms_media` (picture library), `cms_posts` (Sunshine, Bulletin Board stickies, Marquee, Careers), `events` (top level of the future Event Module). Permissions in Security Groups: the existing Content Admin and Event Admin checkboxes become member roles (groups Content Admins, Event Admins); new `cms` functions; Chapter Admins add events for their own chapter; staff get the same through the Security Groups screen.
- [x] Phase 2 (built 2026-10-20, deployed 5c89428; menu name is the `CMS_LABEL` constant, "Website") - Content manager screens (`cms-content`), from both the staff and member menus: sections list (show/hide per site, order, headings, menu labels), items per section, picture uploader and picker.
- [x] Phase 3 (built 2026-10-20, deployed e2396d3; old tables dropped on staging after backup) - Feed screens on `cms_posts`: Sunshine (illnesses, deaths), Bulletin Board (yellow stickies), Marquee, Careers (with a detail page per job, public). Delete the 8 old CMS modules and their `cms_ccmps_*` / `cms_users_*` tables.
- [x] Phase 4 (built 2026-10-20, deployed c45fb23) - `ccmphome.php` rebuilt from the tables, keeping the Inspinia look: the 11 demo sections plus Sunshine, Bulletin Board, Calendar, Marquee, Metrics (member home only) and Careers; the one-page top menu (click, scroll to the section) is built from the sections switched on.
- [x] Phase 5 (built 2026-10-20, deployed 8857eef) - Events calendar (FullCalendar 6.1.15, pinned copy in `public/js/`, not Inspinia's 2016 version): Chapter Admins add events for their chapter, Event Admins and System Admins for any; public checkbox; member home shows every chapter's events (colour-coded), public site only public ones.
- [x] Remove the temporary "Test..." content from the Mac's database (done 2026-10-20 when the BPA content was loaded).
- [x] Phase 6 (built 2026-10-20, deployed 71d9872; content copied to staging after backup) - Public website in the Welcome module (`welcome/website`, `welcome/job/{id}`; the front address shows it only when `CMS_PUBLIC_SITE=1`), and BPA's text, pictures and meeting dates loaded from bpapilots.org on the Mac.
- [ ] BPA content gaps (decide or supply): Operation Skyhook and Summer Flight Academy 2027 dates for the calendar; a national contact email or phone for Contact Us; testimonials / partner quotes if wanted; which Summer Flight Academy location is right (bpapilots.org says both Atlanta Speedway KHMP and Houston Southwest KAXH; Houston was used). `PUBLIC_WEBSITE` in `config/config.php` still points to sgapleaders.org, not bpapilots.org.
- [x] Phase 7 (built 2026-10-20, not yet deployed) - Posting roles, as decided 2026-10-20: Chapter Admins (`cms/chapter_posts`) post Sunshine, Bulletin Board and Careers for All Members (the default) or their own chapter, never Public; members post their own sticky notes (`CMS_MEMBER_BULLETINS`), approved at once; Chapter, Content and System Admins can set a note Pending or Disapproved. Migration `2026-10-20-cms-posting-roles.sql` (run on the Mac).
- [ ] Content manager lists: the Delete button in the Options column is drawn far too big (wide box). Already like this before phase 7; find which stylesheet sizes form buttons in tables.
- [ ] The Chapters tile / menu item on the member home links to `cms-ccmpschapters/viewpage`, a module that never existed (the unused bulletin modal and the old Vue/axios jumbotron script were removed in phase 4).
- [ ] Last: Event Module - rewrite registration's hard-coded events (Skyhook, General Meeting, Board Meeting) to use `events` with an `event_activities` child table; the calendar keeps reading `events`.
    - Who hosts (owner's notes, 2026-10-21): **Operation Skyhook** and the **Summer Flight Academy** are national events. The **General Membership Meeting** and the **National Board Meeting** rotate between chapters, and the registration money goes **directly to the host chapter**.
    - So an event needs a host (National or a chapter, `events.subentity_id`), and registration must take payment into the host's account: the host chapter's payment-acceptance details (payment account / processor settings, payee, contact) need a home, probably on the Chapters screen (`ccmps_subentities`, next to `financial_email` / `financial_contact`), with National's own details for national events. Keep payment secrets out of the database in plain text.

## Core product and client configurations (hybrid SaaS / custom) - after BPA is perfected

Decided 2026-10-27: once this BPA instance is right, it becomes the blueprint for the **Honcho core**. Each new client gets **its own configuration in Git**, and its own **staging and production** (one droplet per client, as planned for BPA). Core improvements flow to every client; client-specific work stays with that client.
- [ ] **Decide the Git layout.** Options: (a) a core repo plus a small repo per client (settings, seed data, logo and pictures, custom modules) laid over the core at deploy; (b) the core repo with a `clients/<name>/` folder per client; (c) a branch per client (not recommended: merging core fixes into every branch gets painful). Recommendation to discuss: (a).
- [ ] **Releases:** a client deploys a tagged core version plus its own configuration; a core upgrade is tested on the client's staging before production.
- [ ] **Separate core from BPA** in what exists today:
    - **Migrations:** core schema changes vs BPA data fixes (lifetime 2099, chapter states, BPA website content). Core migrations run for every client; client data scripts only for that client.
    - **Defaults in `config.php`** still name BPA (organization name, logo `bpalogo100x82.jpg`, `SUBENTITY_NATIONAL_ID` 99, BPA's Wallet issuer in `.env`). New clients start from neutral defaults and set theirs on System Settings.
    - **Aviation fields** (certificates, ratings, aircraft; `ccmps_aux`, `CCMPS_AUX_MODULE`) are BPA-specific: keep them as an optional module, off for clients that don't need them.
    - **Phone app** wording ("BPA Member Portal", already on the list), the **Users' Guide** (written for BPA), website content.
    - **Per-client accounts:** Google Wallet issuer (and Apple later), Brevo, email, payments; and the **Inspinia licence** question.
- [ ] **New-client checklist:** the Configuration chapter's New Client tab grows into the full runbook (droplet, `.env`, migrations, client configuration, System Settings, accounts).

## Legacy data load (ETL) - before UAT, and again before go-live

The data on the Mac and staging is old test data. The real data comes from the legacy BPA database (bpapilots.org, different structure) by an ETL, run just before UAT starts and again just before go-live. Things the ETL must repeat or allow for (noted 2026-10-26):
- [ ] **Data fixes made on the test data** - build them into the ETL or re-run them after it: lifetime members `current_year` 9999 -> 2099 and status Current (`2026-10-22-lifetime-members.sql`); chapter states and National HQ (`2026-10-21-chapter-state*.sql`); deceased members keep no roles (`2026-10-19-clear-deceased-member-roles.sql`); RBAC step 2 (login rows and group memberships from the role columns, `2026-10-18-system-rbac-step2.sql`) and member login numbers. Not `2026-10-18-cleanup-test-logins.sql` (test data only).
- [ ] **Settings are not data**: the `system_settings` rows (financial year, grace period, names, wording, colors), `system_color_schemes`, CMS content and Security Groups set up on the screens must survive the load. Load members, not the whole database.
- [ ] **Member ids**: member cards (`ccmps_cards`), Security Group memberships (`trongate_users` ids), photos (`assets/<id>/`) and the audit log all point at `ccmps.id`. Either keep the legacy ids, or clear `ccmps_cards` (and make the Google Wallet objects inactive) and rebuild logins and groups after each load, so no card or role lands on the wrong person.
- [ ] Check `trongate_users` shape against the real data (see the RBAC item about member creation).
- [ ] Photos: only 14 of 1,725 test members have one; see what the legacy site holds.
- [ ] Map the legacy dues and status fields to `current_year` / `status` / `ccmps_financial_transactions`, and lifetime members to 2099.
- [ ] Plan the ETL itself (field mapping from the legacy structure) once SSH or FTP access to the legacy host works.

## Settings (plan approved 2026-10-22)

[Honcho Settings Plan](https://claude.ai/artifact/1duFrj6djyVgxZdH8xMJtW): every setting in one home (`.env`, `config.php`, or `system_settings` with a screen). Sign-off after each phase.
- [x] Phase 1 (built 2026-10-22, deployed a3eef28 with both migrations run on staging after backup `~/backups/bpa_staging-2026-10-22-before-settings-phase1.sql.gz`): `system_settings` gains label/category/input_type/options/rbac_function/help/sort_order; the four financial settings moved in from `ccmps_financial_settings` (Financial tab); new Financial Admins group and member role (`ccmps.financial_admin`); System Settings rebuilt as tabs, each person sees only what they may change; saving the year or grace period re-checks member statuses after a confirmation. Migrations `2026-10-22-settings-phase1.sql`, `2026-10-22-lifetime-members.sql` (both run on the Mac; backup `~/honcho-backups/bpausa-2026-10-22-before-settings-phase1.sql.gz`) and `-drop-old-table.sql` (not run yet, on the Mac or staging: run after the Financial tab is checked).
- [x] Lifetime members and the status re-check: `current_year` 2099 = lifetime member, always Current (decided 2026-10-22). `recalcstatus()` rule 2, `CCMP_LIFETIME_YEAR` in `config.php`, saving a record keeps 2099; `2026-10-22-lifetime-members.sql` changed the 9999s to 2099 and set lifetime members Current (run on the Mac).
- [x] Phase 2 (built 2026-10-22, deployed 7060e66 with its migration run on staging after backup `~/backups/bpa_staging-2026-10-22-before-settings-phase2.sql.gz`): `setting()` in `config/settings.php`, used by `config.php`; Organization, Wording, Features & Policy and Look tabs (`2026-10-22-settings-phase2.sql`, run on the Mac); `PUBLIC_WEBSITE` now bpapilots.org; `CMS_PUBLIC_SITE` / `CMS_MEMBER_BULLETINS` moved from `.env`. Decided by going ahead with the plan's recommendations: wording is on the screen (System Admins only), the two switches moved.
- [x] Phase 3 (built 2026-10-25, not yet deployed): color schemes (`system_color_schemes`: six scheme colors - Primary, Accent, Highlight, Label, Value, Menu - 57 color constants use `scheme_color()`; Classic = today's colors exactly; Inspinia, Navy & Gold, Slate & Crimson, Custom with color pickers) and logos from the picture library on the Look tab; 58 typed-in logo paths now use `MAIN_LOGO`. Migration `2026-10-25-settings-phase3.sql` (run on the Mac; backup `~/honcho-backups/bpausa-2026-10-25-before-settings-phase3.sql.gz`).
- [ ] Later: the ~229 colors typed straight into views move to the scheme as each screen is touched; colors as CSS variables.
- [x] Phase 4 (2026-10-25, not yet deployed): deleted 60 unused constants (kept 8 for coming work: `WHATENV`, `DEVEMAIL`, `BREVO_SMTP_KEY`, `CURRENCY_*`, `PAYPAL_*`, `DEFAULT_CONTROLLER`) and the three duplicate DMS color definitions; `site_owner.php` follows the organization name; `ccmps_settings_copy` dropped (`2026-10-25-settings-phase4-cleanup.sql`, run on the Mac); Configuration chapter of the Developer's Guide (`chapters/configuration.js`).
- [ ] `Ccmps::recalcstatus()` and `recalc_all_member_statuses()` are public, so anyone can run them from the address bar (`welcome-ccmps/recalc_all_member_statuses`). Make them `_`-prefixed (update the callers) or check permissions.
- [ ] New members get the password `123456` (`DEFAULT_CCMP_PASSWORD`). Give them a random one and a set-password link (with Forgot password).

## Theme (Inspinia) - decided 2026-10-25

Keep Inspinia for now; don't hand-write a copy of it. Move gradually to plain Bootstrap 5 + a small Honcho stylesheet.
- [x] Step 1 (2026-10-25, not yet deployed): audit done. Removed 488 unused theme files (120 demo pages, unused plugins in `js/plugins` and `css/plugins`, demo scripts, email templates; 10 MB) with git rm; every file the app references is kept, including `Landing_Page` and `img/landing` (member home, sponsors). (The 290 MB was mostly `Utils/`, 247 MB, ignored by git and never deployed; left alone on the Mac.) jQuery 3.1.1 -> 3.7.1 (checksum matches jquery.com) on the 61 Inspinia pages.
- [ ] Eric to click-test with jQuery 3.7.1 (menus, DataTables lists, calendar, pop-ups, file upload); then delete the old `public/themes/inspinia/js/jquery-3.1.1.min.js`. To go back: swap the two names in the views.
- [ ] 5 pages load `js/plugins/bs-custom-file/bs-custom-file-input.min.js`, which was never in the theme (a 404; the file inputs work without it). Remove the reference or add the file.
- [ ] Other templates load their own old jQuery: janux and `js/` 1.9.1, epona 2.2.3, `Landing_Page` 2.1.1, cool_mobi CDN 1.11.0 / 3.2.1 / 3.5.1. Check which are still used; update or delete them.
- [ ] Check the Inspinia licence terms: paid themes are usually licensed per end product, and Honcho is planned per client.
- [ ] Later: a Honcho theme on free Bootstrap 5 (CSS variables, so the color schemes become real variables), keeping Inspinia's look and class names; move screens over as they are touched. Then no theme licence is needed.

## Digital membership cards (plan drafted 2026-10-26, awaiting decisions)

[Digital Membership Cards plan](https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc): a card with a QR code in the portal, phone app, Apple Wallet and Google Wallet; scanned at the door for event entry (registered and paid) and meeting attendance.
- [x] Decisions (2026-10-26): go ahead with the plan's recommendations; Google Wallet now, Apple Wallet and event registration later.
- [x] Phase 1 (built 2026-10-26, not yet deployed): My Card page (`welcome-cards`), Card button on the member record, phone app Card tab (`welcome-api/mycard`, `reissuecard`), `ccmps_cards` (`2026-10-26-member-cards.sql`, run on the Mac), cancel and reissue. Only 14 of 1,725 members have a photo: ask members to add one, or the photo check at the door won't help much.
- [ ] Phase 2: door check-in page and attendance (`event_checkins`, Door Volunteers group, overrides, export).
- [ ] Phase 3: Google Wallet button (Eric: create the issuer account at pay.google.com/business/console). Apple Wallet later: start the D-U-N-S number and Apple Developer (organization) enrollment early, 1 to 3 weeks.
- [ ] Phase 4: Wallet cards update themselves on renewal or chapter change.
- [ ] Depends on the Event Module (below) for "registered and paid" at the door and guest tickets.

## Eligible voter rules (later)

- [ ] **Work out `eligible_voter` by rules instead of a checkbox** (owner, 2026-10-27). Voting depends on **currency of membership and member type**, not type alone: e.g. Associate members can't vote even when current; Q (Qualified Student) members can; S students (Student module) never can. Steps:
    - Write down BPA's full rule set with the owner (which member types vote; what "current" means here, e.g. status Current only or Past Due in the grace period too; lifetime and honorary members; deceased, deleted, locked; any rule about chapter or time as a member).
    - One function (e.g. `ccmp_voting_eligible($member)`) that applies the rules, used everywhere; the member types that vote become a setting (e.g. a "Votes" column on `ccmps_types`, or a System Settings row) rather than being written into the code.
    - Recalculate it wherever status is recalculated (`recalcstatus()`, the Financial Settings re-check, saves that change type or year) and in the ETL; the Eligible Voter box on the record becomes display-only (or an admin override with a reason, if the rules allow one).
    - A list or export of eligible voters for elections.

## Small fixes

- [x] System > Subentities (Chapters) gives a 500 on every page: it reads/writes `system_subentities`, which doesn't exist. Rebuilt 2026-10-21 on `ccmps_subentities` (maintenance-table pattern, State and Active added). Still open: whether it gets the staff-only / Lite rule like Settings and the Auditlog.
- [ ] **Revisit National HQ** (`ccmps_subentities` id 99, `SUBENTITY_NATIONAL_ID` in `config.php`): why is it in the chapter table? No members, events or posts use it (checked 2026-10-21). For now it is inactive, has no state, is hidden from the Chapters screen and never counted. Decide whether to keep it (and what for) or delete it.
- [ ] James H. Green Chapter has no state (no member addresses to go on); fill it in on the Chapters screen.
- [ ] Member home ATIS tile hidden 2026-10-16 (it downloaded doc 1 from the removed CMS library). Upload ATIS to DMS and put its id in the link in `ccmphome.php`, then re-add it to the Users' Guide.

- [ ] `Ccmps::currentroster()` (and any other method using the same `$this->login()` line) gives a 500 when the session has expired: `login()` doesn't exist. Redirect to `welcome/logout` instead (found 2026-10-22).
- [x] Debug line numbers on buttons removed 2026-10-27: "128 Update", "137 Close", "141 Close" (`viewccmp.php`); "69Cancel", "80 Cancel", "92 Cancel", "103 Manage All" (`ccmpcrud.php`).
- [ ] The **Student Members** list links (`welcome-ccmps/manage/mosm`, `mcmm`) show every member: `manage()` no longer filters by student. Filter to Q members (`ccmp_type` 3), as the home-page counts do; S students belong to the Student module (decided 2026-10-27). Found 2026-10-27.
- [ ] Other screens whose Close goes to the home page instead of back where you came from: fix as they're touched (pattern: `Cards::_return_url()`).
- [ ] Member-list bulk actions Lock, Unlock, Approve User Acct, Approve CCMPS and Archive are listed but do nothing (`Ccmps.php` `bulkaction()`).

- [x] `sidemenu.php` Content Admin block is missing its closing `</li>` (~line 161). Replaced by the Website block 2026-10-20.
