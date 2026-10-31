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
- [ ] **Emulate a member ("view as")** (asked 2026-10-27): a System Admin or Member Admin (a Chapter Admin only within their chapter, if wanted) can open the portal as any member, to see exactly what that member sees and act as them. The legacy system has this; how it works there has to be looked up (owner doesn't remember), then rebuilt. Design points: a `system` RBAC function (e.g. `emulate_members`); the admin's own session is saved and restored by a clear "Return to my account" bar shown on every page while emulating; never emulate someone with more rights (no System Admin through emulation) and never see or change their password, second factor or card; every start/stop and every change made while emulating goes in the Auditlog as "<admin> as <member>"; decide whether some actions (payments, voting) are blocked while emulating. Update the Security chapter and the Users' Guide (admins).
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
    - Each story written from the role's side ("As a Chapter Admin, I can ... so that ..."), with testable criteria (Given / When / Then), drawn from the code, the Developer's, Member and Administrator's Guides and the decisions in this list.
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
- [ ] **Seeding (owner, 2026-10-27): no seeding by default**: the module starts empty for a client. For BPA, **perhaps** seed it with the S members (`ccmps` where `ccmp_type = 4`); not decided. If so, still to decide: payments, aircraft, logins, and what happens to the moved `ccmps` rows. Do it in the ETL from the legacy database, not just on the test data.
- [ ] Voting: Student-module participants are never eligible voters (handled by the **Eligible voter rules** task below).
- [ ] Then the CCMPS **Student Members** list (`manage/mosm`, `mcmm`) and the home-page student counts mean Q members only (`ccmp_type` 3), which the counts already use.

## Daily Coffee Report and AI connections (owner, 2026-10-29)

The Coffee Report is the Honcho AI module's daily brief (AI plan phase 1: https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt). Eric's existing Python scripts (written by another AI) gather the information; the AI only assembles it into the report. **National and each chapter have their own AI connection:** Member Admins and System Admins use National's; each Chapter Admin can enter their chapter's own.

- [x] **Eric: hand over the Coffee Report Python scripts** (received 2026-10-29) (copy them into the repo, e.g. `tools/coffee/`, or say where they live) with a sample of what each one outputs.
- [x] **Review the scripts and decide how they run** (2026-10-29: rebuilt in PHP inside Honcho, approved by Eric; personal pieces stay in his Hermes brief): keep them as Python called by Honcho's scheduler (needs Python on the server, so Dedicated and Honcho Cloud only), or port the data-gathering to PHP so it also runs on cPanel shared hosting. List each script's sources (Honcho database, outside websites, keys it needs) and what it returns. Recommendation to Eric before any porting.
- [x] **AI connections by scope (National and chapter)** (phase 0 built 2026-10-29: `ai/connections`, `ai/connection/{id}`, Test connection, Remove key; Anthropic API keys. Still to come: Sign in with ChatGPT when OpenAI approves). One screen per scope: provider and credentials, a **Test connection** button, on/off, monthly limit. National's is set by System Admins and used by System Admins and Member Admins; a chapter's is set by that chapter's Chapter Admin and used by that chapter's admins. Accepted credentials: an Anthropic or OpenAI **API key**, or **Sign in with ChatGPT** once OpenAI approves Honcho. A Claude Pro/Max/Team **subscription can't be entered** (Anthropic allows those logins only in Claude.ai and Claude Code); chapters with Claude use the Honcho connector instead (AI plan phase 3). Security Groups functions such as `ai/manage_national`, `ai/manage_chapter`.
- [x] **Credential vault** (built 2026-10-29, `vault_helper.php`; replace and revoke on the connection screen, Auditlog `SaveAIConnection` / `RemoveAIKey`). Encrypted storage for every AI key and token (encryption key in `.env`, never in the database or git); shown once when entered, then masked; replace, revoke, last used; every change in the Auditlog. Reused for other per-client secrets later.
- [ ] **Which connection a request uses** (built 2026-10-29: `ai_scope_for_session()`, `AI_CHAPTER_FALLBACK`, the monthly limit check and the `ai/usage` page; still to do: email warnings at 50/80/100%). National admins use National's; a Chapter Admin uses their chapter's if set; otherwise a National setting decides: fall back to National's, or plain numbers with no AI. Each scope's use and cost recorded separately in `ai_requests` and shown on a usage page, with warnings at 50/80/100% of the scope's limit (pricing plan: https://claude.ai/artifact/3kynSEzd98AwCh2fJDBmpV).
- [x] **Coffee Report settings screen, per chapter (and one for National)** (built 2026-10-29, `ai/coffeesettings/{id}`). Choose the sections (from what the scripts provide), the order, the delivery time and time zone, the days, who receives it (the scope's admins by default, plus chosen members or addresses), email subject, and a short instruction for the AI's tone. **Preview** and **Send me a test** buttons. Chapter Admins edit their chapter's; System and Member Admins edit National's.
- [x] **Coffee Report runner** (built 2026-10-29: `coffee_run()`, `ai/coffeecron`, archive `ai/coffeearchive`; on staging since 2026-10-30: MAIL_FROM_*, COFFEE_CRON_KEY, the new Brevo key, `WHATENV=prod` in `~/stack/staging.env` (old file kept as `staging.env.bak-2026-10-30`), crontab every 15 minutes; first scheduled report sent to Eric and David that day). Scheduled job: for each scope due, run its sections' scripts, pass the results to that scope's AI connection to assemble the report, and send it through Brevo; with no connection or at the limit, send the plain numbers. Keep each sent report (archive page per scope), log failures and email the scope's admins when a report can't be sent.
- [x] **Markets section** (owner, 2026-10-30): ticker symbols' previous close and change (Yahoo Finance spark feed, no key, unofficial), WTI / Prime / 30-year mortgage (FRED official API, free `FRED_API_KEY`), exchange rates (open.er-api.com). Mac only until the next deploy.
- [ ] Eric: get a free FRED API key (fred.stlouisfed.org, My Account > API Keys) and put it in `.env` on the Mac and `~/stack/staging.env` as `FRED_API_KEY`.
- [ ] **Staging Telegram:** paste National's bot token on the staging Coffee Report settings page and tick Send to Telegram (tokens encrypted on the Mac can't be read on staging).
- [ ] Add an Anthropic API key (Haiku is cheapest) on staging's AI Connections so reports are AI-written.
- [x] **Bulletins** (owner, 2026-10-30): National and chapter bulletins printed word for word at the top of Coffee Reports (`coffee_bulletins`, `ai/coffeebulletins`). Mac only until deployed.
- [x] **Member Coffee Reports** (owner, 2026-10-30): My Coffee Report for Current members (`coffee_member_reports`, `ai/mycoffee`, `COFFEE_MEMBER_REPORTS` setting): plain facts, email plus Telegram through National's bot, no Documents or YouTube; Membership = Current totals nationwide and in the chapter (more statistics to be decided). Migration `2026-10-30-coffee-bulletins-member-reports.sql` (run on the Mac). Mac only until deployed.
- [x] **Telegram chat list** (owner, 2026-10-30): a report's Chat IDs box takes a list, one per line; each person or group gets its own copy (`2026-10-30-coffee-telegram-chat-list.sql`).
- [x] BPA bot **@BPAPilotsCoffeeBot** created in @BotFather (Eric's account, 2026-10-30) and its token loaded on staging's National report. Later, if BPA gets an organization Telegram account: move the bot to it.
- [ ] Member Coffee Report statistics: decide what else goes in a member's Membership section (owner: TBD).
- [ ] **Paid member extras** (owner, 2026-10-30): **YouTube channels** and **personal calendars** (Google / Outlook) in a member's own Coffee Report, as enhancements a member pays for. Needs the Financial module (pricing, payment, entitlement per member).
- [ ] Before offering member reports widely: size the Brevo plan (one email per member per day; free plan 300/day). (The BPA-named bot is done.)
- [ ] **Local model connection type** (owner, 2026-10-29): a third provider in `ai_helper.php`, **Local model (OpenAI-compatible)**: a server address and model name, no key, for a model like Qwen served on the client's own server by llama.cpp or Ollama (no Hermes needed). Shares the OpenAI request format, so build it with or after the OpenAI provider. For the Dedicated tier and privacy-sensitive (HIPAA) clients; needs 8 GB+ and is CPU-slow (fine for the Coffee Report, not chat). Keep the model server bound to the Docker network only.
- [x] **Docs:** Developer's Guide Honcho AI chapter; Administrator's Guide chapter 7, AI and the Daily Coffee Report, a step-by-step walkthrough (2026-10-29).
- [x] ~~Hermes-run Coffee Report for clients~~: replaced by the above (2026-10-29). Eric's own Hermes Coffee Brief stays separate.

## Scheduler (add-on; plan approved 2026-10-30)

Books a customer, an asset and a performer into one time slot (student + aircraft + instructor; patient + exam room + doctor; or customer + asset with no performer), with a conflict check across all of them. Plan: https://claude.ai/artifact/GyZQrdzfn2B197iL6GvRvD

**Decisions (owner, 2026-10-30):** an **add-on** (`system_modules` `sched`, RBAC like PMS). **Staff book first** (phase 1), members from phase 2. **Every performer has a login** (owner, 2026-10-30): a member login (clubs, partnerships) or a Honcho staff account (flight schools, professional services, where performers are rarely members); stored as one `tg_user_id`. A setting says where performers come from: Members / Staff accounts / Both. Someone who is both a performer and a customer (e.g. an instructor getting a flight review) has an account in each place. Honcho Lite has no staff accounts, so staff performers need the staff module deployed. **Business type setting** (owner, 2026-10-30): Flying club / aircraft partnership, Flight school, Equipment / tool rental, Professional services, Custom; presets the names, starter activity types, where performers come from and the sub-module switches (Maintenance, Cost sharing, Meters), each still changeable. **Chapters can own assets** (`subentity_id`). **Billing waits for the financial module.** The menu name ("Scheduler") and the three role names (customer / asset / performer, singular and plural) are System Settings rows; a **Use performers** switch. Build the day board ourselves (CSS grid + plain JS): FullCalendar's resource view needs a paid license per client.

- [ ] **Phase 0, foundations:** migration (`sched_locations`, `sched_resource_types`, `sched_resources`, `sched_activity_types`, `sched_hours`, `sched_blocks`, `sched_reservations`, `sched_reservation_resources`), RBAC module and functions (view_board, book_self, book_others, manage_resources, manage_settings, view_reports), Scheduler settings tab (Business type, names, performer source, sub-module switches); setup screens in the maintenance-table pattern (locations, resource types, resources with photos, activity types, hours).
- [ ] **Phase 1, staff booking:** day board (a column per asset and performer, unavailable shading, filters, date picker, Today); reservation form with live conflict check and a locked transaction on Save; blocks (time off, closures); asset catalog and performer directory; performer-only logins.
- [ ] **Phase 2, members book themselves:** My Reservations and New Reservation on the member home; Find a Time; confirmation, change and reminder emails (Brevo, cron like the Coffee Report).
- [ ] **Phase 3, operations:** week and month views; repeating bookings; check-out and check-in (Hobbs/tach or any meter); no-shows; reports and Excel export. Billing hooks when the financial module is built.
- [ ] **Phase 4, Maintenance sub-module:** meters (Hobbs/tach, hours used); inspection items by hours and/or date with presets per business type (annual, 100-hour for hire/instruction, ELT, transponder/pitot-static, oil change, recurring ADs); alerts ahead of due (board, email, Coffee Report); grounding blocks bookings and flags existing ones; squawks at check-in; maintenance log with cost and DMS paperwork.
- [ ] **Phase 5, Cost sharing sub-module (partnerships, clubs):** expenses per aircraft (insurance, hangar/tiedown, annual, maintenance from the log, loan), one-off or repeating; split rules (equal, ownership share, hours flown); monthly partner statements (screen, Excel, email); cost per hour. Invoicing and payments go to the financial module.
- [ ] **Phase 6, rules and reach:** qualifications (asset checkout, current medical or flight review) feeding home-page expiry alerts; iCal feed; phone app screen; Coffee Report "Today's schedule" section; Telegram/SMS reminders.
- [ ] **Docs:** Developer's Guide chapter (Part II Add-ons) and an Administrator's Guide chapter, built with each phase.

## Financial, Payments and Store (decided 2026-10-30/31; requirements chapters FIN, PAY, STORE)

**Split (owner, 2026-10-31):** **Financial** = what is owed (dues, invoices, accounts, statements, expenses); **Payments** = how money moves (every gateway, payment records, refunds, webhooks, Point of Sale); **Store** = merchandise. Dues and Payments are **Core**; invoicing/accounts/expenses/POS are the Financial add-on; the Store is an add-on. Earlier decisions stand: PayPal first (through its REST API, design for more providers, build only PayPal), National's account first and chapters' own later, stocked merchandise first, sales tax at entered rates, expense receipts filed in the Document Library.

**Order of work (owner, 2026-10-31):** Dues, then Payments, then finish Project Management (PMS section above), then the Store, then invoicing/accounts with the Scheduler, then chapters' accounts and stores, then Point of Sale.

Existing pieces: `ccmps_financial_transactions` (the National dues record renewals create; status reads it), `ccmps_types.national_dues`, the Financial settings tab and Financial Admins group, `honcho_financial`, `ccmps.paypal_txn_id`, unused `store` layout.

- [x] **Dues step 1, foundations** (2026-10-31, Mac): settings (due date, grace mode, grace end, billing plans), member-type flags (active, always Current for Honorary, at large), chapters' `dues_collected_by` (Chapter at Large = national), proration schedules (National seeded, Regular only), `dues_charges`, `dues_installments`, `pay_payments`, RBAC module `fin` and functions, Family retired (34 test members became Associate), type pickers show active types only. Migration `2026-10-31-dues-step1-foundations.sql` (run on the Mac). Next: step 2, the status engine.
- [ ] Data load question: what does the **Grandfathered** certificate mean? Two test members (1443, 1467) have it: Regular, no certificate number. Possibly members made Regular before a pilot certificate was required. Confirm with BPA or the legacy data during the dry-run load.
- [ ] **1. Dues (Financial, Core), FIN-01 to FIN-07:** dues types and amounts (National, optional chapter dues); record cash/check payments (into the Payments payment record, PAY-07); **National records dues received** (one or a chapter batch: clears the dues record, member becomes Current; MEM-21); dues report by chapter and year; reminders; numbered receipts; dues history on the profile.
- [ ] **2. Payments (Core), PAY-01 to PAY-10:** gateway connection by scope (National first; vault; sandbox then live; Test connection); PayPal Checkout; verified webhooks kept and processed once; payment records for every method; refunds; matching with the gateway; **pay dues online**.
- [ ] **3. Automatic renewal, PAY-11:** first check in the sandbox (card-only subscribers, changing the dues amount on existing subscriptions, fees vs the legacy site); then PayPal Subscriptions per dues type, reminders, failed-payment emails, grace period.
- [ ] **4. Finish Project Management** (see PMS above), then **5. Store, National (add-on), STORE-01 to STORE-05**.
- [ ] **6. Invoicing, accounts and expenses (Financial add-on), FIN-10 to FIN-19:** price list, accounts and Add Funds, invoices, saved cards (PAY-12), statements, overdue rule, expenses with Document Library receipts, PDFs, reports and accounting export; with the Scheduler.
- [ ] **7. Chapters' own payment accounts (PAY-06) and chapter stores (STORE-06)**; store extras (STORE-07, STORE-08).
- [ ] **8. Point of Sale (PAY-13)**, the final part: compare options first.
- [ ] Legacy ETL: dues history (and `paypal_txn_id`) into the new tables.

## Reporting module (owner, 2026-10-30)

- [ ] **Gather the requirements** with Eric before any design: who uses reports (members, chapter/national admins, staff, partners); which reports each module needs (membership, dues, financial, store, Scheduler utilization and maintenance, DMS, events); on-screen vs Excel/PDF vs emailed on a schedule; saved and shared reports (like Flight Schedule Pro's Saved Items); filters and scope limits (a Chapter Admin sees only their chapter); whether users build their own. Then write a plan.

## Requirements book (`docs/requirements`, started 2026-10-30)

- [x] Format approved with the Member Cards chapter; Core chapters written and checked against the code (2026-10-30): Signing In, Permissions, Member Records, Cards, Settings, Document Library, Member Home and Website, Help.
- [x] Honcho AI converted (AI-01 to AI-27, 2026-10-30).
- [x] Financial (FIN-), Payments (PAY-) and Store (STORE-) written as separate chapters (2026-10-31).
- [ ] Convert to requirements form: Scheduler (SCHED-), Pricing (PRICE-).
- [ ] Add chapters: Projects (PMS: teams and projects built; write it when planning the finish, order step 4), the staff back office (Honcho), the phone app; later Event Module, Participants (Student), Reporting, Emulation as they're planned.

## Developer's Guide

- [x] **Conventions chapter** (Part III, `chapters/conventions.js`, 2026-10-27): where things go, database, security, screens, code style, docs and releases. Keep it current when a pattern is agreed.
- [ ] **Per-user preferences table** (core): `system_user_preferences` (login id = `trongate_users.id`, preference key, value) instead of columns on `ccmps` (`tab_setting` ... `button_setting`, `fontsize`, `mfontsize`, `language`) and on `honcho_user_accounts` (`fontsize`, `tfontsize`). One store for members and staff; new preferences need no table change; the Font pop-up then works for staff too; member reloads (ETL) don't touch preferences. Do before the ETL (requested 2026-10-27).
- [ ] Chapters still to write: Welcome, Participants. (Configuration written 2026-10-25.) "Deploying on DigitalOcean" started 2026-10-08 (`chapters/deployment.js`); keep it updated as each DO-xx step is done.
- [ ] CCMPS Testing tab describes `lib/CcmpsPermissions.php` and `run_integration_tests.sh`, which aren't in the project.
- [x] Deleted the old `CCMPS_Developer_Documentation.docx` (superseded by the Honcho Developer's Guide), 2026-10-30.
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
    - **Phone app** wording ("BPA Member Portal", already on the list), the **Member and Administrator's Guides** (written for BPA), website content.
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

- [x] Help pages: **Close** went to the home page; now returns to where the person came from (`Help::_return_url()`, copied from `Cards`), requirement HELP-08 (2026-10-30, Mac only).

- [ ] `ccmps_aux.ccmp_id` has a foreign key to the old `ccmps_org` table, not `ccmps`, so a member created since that copy was made can't get an aux row (2 such members on the Mac, including the `portaladmin` account added 2026-10-27). Point the key at `ccmps`, add the missing rows, then decide whether `ccmps_org` can go.

- [x] System > Subentities (Chapters) gives a 500 on every page: it reads/writes `system_subentities`, which doesn't exist. Rebuilt 2026-10-21 on `ccmps_subentities` (maintenance-table pattern, State and Active added). Still open: whether it gets the staff-only / Lite rule like Settings and the Auditlog.
- [ ] **Revisit National HQ** (`ccmps_subentities` id 99, `SUBENTITY_NATIONAL_ID` in `config.php`): why is it in the chapter table? No members, events or posts use it (checked 2026-10-21). For now it is inactive, has no state, is hidden from the Chapters screen and never counted. Decide whether to keep it (and what for) or delete it.
- [ ] James H. Green Chapter has no state (no member addresses to go on); fill it in on the Chapters screen.
- [ ] Member home ATIS tile hidden 2026-10-16 (it downloaded doc 1 from the removed CMS library). Upload ATIS to DMS and put its id in the link in `ccmphome.php`, then re-add it to the Member Guide.

- [ ] `Ccmps::currentroster()` (and any other method using the same `$this->login()` line) gives a 500 when the session has expired: `login()` doesn't exist. Redirect to `welcome/logout` instead (found 2026-10-22).
- [x] Debug line numbers on buttons removed 2026-10-27: "128 Update", "137 Close", "141 Close" (`viewccmp.php`); "69Cancel", "80 Cancel", "92 Cancel", "103 Manage All" (`ccmpcrud.php`).
- [ ] The **Student Members** list links (`welcome-ccmps/manage/mosm`, `mcmm`) show every member: `manage()` no longer filters by student. Filter to Q members (`ccmp_type` 3), as the home-page counts do; S students belong to the Student module (decided 2026-10-27). Found 2026-10-27.
- [ ] Other screens whose Close goes to the home page instead of back where you came from: fix as they're touched (pattern: `Cards::_return_url()`).
- [ ] Member-list bulk actions Lock, Unlock, Approve User Acct, Approve CCMPS and Archive are listed but do nothing (`Ccmps.php` `bulkaction()`).

- [x] `sidemenu.php` Content Admin block is missing its closing `</li>` (~line 161). Replaced by the Website block 2026-10-20.
