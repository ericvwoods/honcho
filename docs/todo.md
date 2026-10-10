# Honcho To-Do List

Started 2026-10-06. Tick items off as they're done; add the date.
Code walkthroughs are tracked separately in `code-walkthrough-list.md`.

## Security — do soon

- [ ] **Revoke the Gmail app password in `Welcome.php` `checkemail()`** (around line 1262) in the Google account, create a new one, and move SMTP settings out of the code.
- [ ] **Remove the PayPal sandbox logins, passwords and card numbers** from the comments in `config/config.php`; rotate anything still live.
- [ ] **Remove the `TEMP_2ND_FACTOR` bypass**: `'654321'` is accepted as a second factor by both logins when the session has no code (`Welcome.php` ~429, `Honcho.php` ~1387).
- [ ] **Call `session_regenerate_id(true)` after a successful login** in both logins (prevents session fixation).
- [ ] DMS `manage()` takes the user's role from the URL (covered by the RBAC plan, step 4).

## Login & accounts

- [ ] **Real second factor (2FA)**: a one-time code by **text (SMS)** or **email**, valid for a few minutes, single use. Required for anyone in an admin / super-user group; optional for other members. SMS provider: being set up. Replaces today's "member number" second factor.
- [ ] **Forgot password** for both logins (rebuild; the member version in `Welcome.php` is unfinished): random one-time token stored hashed with an expiry (~30 min); emailed (or texted) to the account's **own** address; same message whether or not the account exists; link works once; limit how often it can be requested; logged in the audit log. Today's version emails one hard-coded address with a hard-coded link, never creates a token, and `newpassword()` stops at a debug `die()`.
- [ ] Decide: full authentication redesign (one login per person, members and staff as profiles) or RBAC only.

## Permissions (RBAC)

- [ ] Answer the 12 decisions in the [Honcho RBAC Implementation Plan](https://claude.ai/code/artifact/d55caab2-e13a-4502-bdbe-e52b7f7f4561), then approve it.

## DMS

- [ ] `header5()` saves the text "Approved" into the numeric `status` column, so the save fails in strict mode (should be `1`).
- [ ] Security group → role data is incomplete (group 1 → missing role 6; groups 2–4 no role).
- [ ] Subentity Admin gets "Error 5103" after moving a card (case commented out).
- [ ] `manage()` gives a 500 error when nobody is logged in.
- [ ] Test the manage-page filters while logged in after the 2026-10-06 SQL-injection fix.

## PMS (add-on)

- [ ] Test the logged-in pages and forms on this engine.
- [ ] Remove the `ini_set('display_errors'...)` / `error_reporting` debug lines at the top of `Pm.php`.
- [ ] Team-member picker lists nobody (fixed by RBAC plan step 3: build the list from `trongate_users`).
- [ ] `PM_SYS_SETTING_ID` is hard-coded in `Pm.php`.
- [ ] Add PMS to the mobile menu in `ccmphome.php` (`device_type == 2`).

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

## Home page content (CMS)

- [ ] All 8 content modules (marquee, jumbotron, bulletins, notices, jobs, activities, sunshine, chapters) read a table named `scopes` on their add/edit/list pages; this database only has `ccmps_scopes`. Check production, then point them at the right table. (Found 2026-10-07 while writing the User's Guide.)

## Small fixes

- [ ] Debug line numbers show on buttons: "128 Update" (`viewccmp.php` line 128) and "69Cancel" / "80 Cancel" (`ccmpcrud.php` lines 70 and 81).
- [ ] Member-list bulk actions Lock, Unlock, Approve User Acct, Approve CCMPS and Archive are listed but do nothing (`Ccmps.php` `bulkaction()`).

- [ ] `sidemenu.php` Content Admin block is missing its closing `</li>` (~line 161).
