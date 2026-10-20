// ============================================================
// chapters/security.js — Security (RBAC) chapter of the Honcho Developer's Guide
// ============================================================
// Core. Written 2026-10-18 when RBAC step 1 was built, from the
// approved Honcho RBAC Implementation Plan, modules/system/rbac/,
// engine/tg_helpers/rbac_helper.php and the system_* tables.
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Overview", blocks: [
  { type: 'p', text: "One permission system for every module, in the Core `system` module beside System Settings and the Auditlog. An admin ticks the **functions** a **group** may use, then adds **people** to the group. Every module asks the same question: \"may this person do this?\"" },
  { type: 'p', text: "It replaces, one module at a time, the four separate setups that exist today (Honcho's `honcho_users_*`, DMS's `dms_filelibrary_*`, PMS's `pm_*` security tables, and CCMPS's yes/no flags on the member record). The plan was approved on 2026-10-18 with all 12 recommendations; the plan document has the full reasoning." },

  { type: 'table', headers: ['Term', 'Meaning'], rows: [
    ['Person', 'A login: one `trongate_users.id`. Staff (`honcho_user_accounts`) and members (`ccmps`) are treated alike. Someone with both logins is two people here, by design (decision 12).'],
    ['Group', 'A named set of people, e.g. "PM Admins", "Chapter Admins". A group can hold functions from several modules. A person in several groups gets everything any of them allows.'],
    ['Function', 'One thing a person can be allowed to do in one module, named for the action a person would recognise ("Create and edit projects"), not per PHP method.'],
    ['Module', 'CCMPS, DMS, PMS, Honcho, System. Switching a module off (`system_modules.enabled = 0`) fails every check for it.'],
  ]},
  { type: 'p', text: "There is **no role table**: a group holds its functions directly. RBAC answers **what** someone may do; **which records** (own chapter, own teams) stays in each module's queries." },

  { type: 'h2', text: 'Rollout' },
  { type: 'table', headers: ['Step', 'What', 'State'], rows: [
    ['1', 'Back up; build the tables, helper and screens. No module uses them.', 'Done 2026-10-18; on staging.'],
    ['2', 'Migrate the data: DMS, Honcho and CCMPS functions; existing groups and people; a report of anything that will not map.', 'Done 2026-10-18; on staging. See the Migration tab.'],
    ['3', 'Switch PMS to `rbac_require()`; team picker uses `rbac_person()`.', 'Done 2026-10-18; on staging. See the PMS chapter.'],
    ['4', 'Switch DMS: every action asks Security Groups, either login; chapter admins manage their own chapter\'s documents.', 'Done 2026-10-18; on staging. See the DMS chapter, RBAC tab.'],
    ['5', 'Switch CCMPS: the `ccmps_*` session flags are set from groups at login; Member Permissions ticks become group memberships.', 'Built 2026-10-18 (Mac). See the CCMPS chapter, Member Admin Roles.'],
    ['6', 'Retire the old tables (rename with `zz_`, drop later).', 'Not started'],
  ]},
]},

// ============================================================
{ tab: "Tables", blocks: [
  { type: 'p', text: "Created by `database/migrations/2026-10-18-system-rbac.sql` (kept out of the module folders: a `.sql` file inside a module folder sets off Trongate's dev-mode redirect). The script uses `CREATE TABLE IF NOT EXISTS` and `INSERT IGNORE`, so it is safe to run more than once." },
  { type: 'table', headers: ['Table', 'One row per', 'Key columns'], rows: [
    ['`system_modules`', 'Module', '`code` (`system`, `ccmps`, `dms`, `pm`, `honcho`), `title`, `is_addon`, `enabled`, `sort_order`'],
    ['`system_functions`', 'Thing a person can be allowed to do', '`module_id`, `code` (unique per module), `title`, `description`, `legacy_id` (id in the module\'s old `*_functions` table), `sort_order`'],
    ['`system_groups`', 'Group', '`title` (unique), `description`, `active` (0 = gives nothing, settings kept)'],
    ['`system_group_functions`', 'Ticked box on the privileges grid', '`group_id`, `function_id` (unique pair)'],
    ['`system_group_users`', 'Person in a group', '`group_id`, `tg_user_id` (unique pair)'],
  ]},
  { type: 'p', text: "Audit columns follow `system_settings` (`created_by`, `created_at` as a Unix time, `updated_by`, `updated_at`)." },

  { type: 'h2', text: 'What Step 1 Seeds' },
  { type: 'ul', items: [
    "The five modules, all enabled.",
    "System: `manage_security` (\"Manage security groups\").",
    "PMS: 22 functions, one per old `pm_functions` row, with readable names (`view_projects`, `edit_projects`, `edit_teams`, …) and `legacy_id` pointing at the old row. PMS is the first module to switch (step 3).",
    "A **System Admins** group holding `manage_security`, with nobody in it.",
  ]},
  { type: 'p', text: "DMS, Honcho and CCMPS functions are added in step 2, when their old functions are merged into actions." },
]},

// ============================================================
{ tab: "Migration", blocks: [
  { type: 'p', text: "Step 2 copies today's permissions into the new tables. Scripts, in the order a deploy runs them (all in `database/migrations/`, all safe to re-run):" },
  { type: 'table', headers: ['Script', 'What it does'], rows: [
    ['`2026-10-18-system-rbac.sql`', 'Step 1: the five tables; System and PMS functions; the System Admins group.'],
    ['`2026-10-18-cleanup-test-logins.sql`', '**Test data only.** Removes test staff logins 2, 4, 5, 6; links login 3 to member 1538.'],
    ['`2026-10-18-restore-member-login-numbers.sql`', '**Test data only.** Puts back the member login numbers an earlier version of the cleanup cleared.'],
    ['`2026-10-18-system-rbac-step2.sql`', 'Step 2: login rows for members that lack one; CCMPS, DMS and Honcho functions; the groups and their people.'],
    ['`2026-10-18-system-rbac-step2-report.sql`', 'Read-only report: what did not map, and each group\'s functions and people.'],
  ]},

  { type: 'h2', text: 'Member Logins' },
  { type: 'p', text: "Members sign in with the username and password on their `ccmps` row, but creating a member also creates a `trongate_users` row and stores its id in `ccmps.trongate_user_id` (`Ccmps.php` ~3285). The member pages use that number to identify the logged-in member (chapter-admin lookups, post authors), and RBAC uses it as the person. The test copy was missing the rows, so step 2 inserts one per member number (`INSERT IGNORE` by id: nothing happens where they exist)." },

  { type: 'h2', text: 'How Old Permissions Map' },
  { type: 'table', headers: ['Old', 'New group', 'Functions'], rows: [
    ['Honcho `sysadmingrp` (skips every check)', 'System Admins', '`system/manage_security` + all 15 Honcho functions'],
    ['Honcho `usergrp` (regular user role)', 'Staff Users', 'Own account: home, view, edit, pictures, change password'],
    ['DMS `dmssysadmingrp` (dmslibadmin)', 'DMS Admins', 'All 12 DMS functions'],
    ['DMS `dmsusergrp` (dmslibuser)', 'DMS Users', 'View the library, download. Every member login is put here, as members get dmslibuser today.'],
    ['PMS PM Admins / PM Users', 'PM Admins / PM Users', 'Their role\'s functions, 1:1'],
    ['`ccmps.system_admin`', 'Member System Admins', '`ccmps/system_admin` + all DMS functions (members with it are DMS admins today)'],
    ['`ccmps.ccmp_admin`', 'Member Admins', '`ccmps/member_admin`'],
    ['`ccmps.subentity_admin`', 'Chapter Admins', '`ccmps/chapter_admin` + DMS user functions'],
    ['`ccmps.student_admin`', 'Student Admins', '`ccmps/student_admin`'],
    ['`ccmps.content_admin` (added 2026-10-20)', 'Content Admins', '`ccmps/content_admin` + `cms/manage_content`'],
    ['`ccmps.event_admin` (added 2026-10-20)', 'Event Admins', '`ccmps/event_admin` + `cms/manage_events`'],
  ]},
  { type: 'p', text: "Content manager (2026-10-20, `database/migrations/2026-10-20-cms-content-phase1.sql`): module `cms` has three functions: `manage_content` (sections, items, pictures, Sunshine, Bulletin Board, Marquee, Careers), `manage_events` (every event) and `chapter_events` (events for your own chapter, given to Chapter Admins). Member System Admins and staff System Admins get `manage_content` and `manage_events`. Staff are given content or event rights by adding them to Content Admins or Event Admins on the Security Groups screen; members get them from the Content Admin / Event Admin checkboxes." },
  { type: 'p', text: "DMS's 36 and Honcho's 41 method-level functions were merged into 12 and 15 actions; each function's description lists the old names it covers. Staff groups take staff logins only and member roles take member logins only, so a stale row can't cross sides. Deceased and deleted members are left out." },

  { type: 'h2', text: 'Not Migrated (from the report)' },
  { type: 'ul', items: [
    "Honcho `admingrp` and `asstadmingrp`: their roles have no functions. DMS `dmsadmingrp`, `dmsasstadmingrp`, `dmssubadmingrp`: no role. They give nothing today.",
    "DMS group 1 → role 6, which doesn't exist (its other row, role 1, carried across).",
    "Chapter admins got the **dmslibsubadmin** DMS role from code, but that role had no functions in the tables. Step 4 (2026-10-18) gave Chapter Admins every DMS function, limited to their own chapter's documents.",
    "`Dmslibrary.php` has blocks that look for staff groups 5–8 in `honcho_users_tguserid_security_group` (which has only 1–4); they are all commented out.",
    "Test data: one chapter admin with no login number (Margaret Fisher, 1536); one deceased member with roles (Leslie Morris, 1435), cleared 2026-10-19 along with the rule that a deceased member keeps no roles or groups.",
  ]},
]},

// ============================================================
{ tab: "Checking Permissions", blocks: [
  { type: 'p', text: "Three plain functions in `engine/tg_helpers/rbac_helper.php`, loaded by `engine/ignition.php` like the other helpers, so they work everywhere:" },
  { type: 'code', text: "// In a controller method - stops here with a flash message if not allowed\nrbac_require('pm', 'edit_projects');\n\n// In a view or menu - true/false, for showing or hiding a link\n<?php if(rbac_allowed('pm', 'view_projects')): ?>\n    <li><a href=\"<?= BASE_URL ?>pm\"><i class=\"fa fa-folder-open\"></i> Projects</a></li>\n<?php endif; ?>\n\n// Name, email and kind (staff / member) of one login\n$person = rbac_person($tg_user_id);" },
  { type: 'ul', items: [
    "**Who** is always `$_SESSION['tg_user_id']`, which both logins set. It is never taken from the URL or a form.",
    "The chain is: `system_group_users` → `system_groups` (active) → `system_group_functions` → `system_functions` → `system_modules` (enabled). One joined query per page, remembered for the rest of that page (`_rbac_function_list()`), so a change on the Security screens works on the person's next click, with no logout.",
    "`rbac_require()` sends a person who is not logged in to `welcome/logout`; anyone else gets a flash message and goes to their home page (`honcho` for staff, `welcome-ccmps/ccmphome` for members).",
    "`rbac_person()` follows `trongate_users.login_acct_info_table` / `login_acct_table_id` to the account row (only `ccmps` and `honcho_user_accounts` are read), and falls back to `trongate_users.title`, then the username, when the row has no name.",
  ]},
  { type: 'p', text: "Three more: `rbac_allowed_for($tg_user_id, $module, $function)` asks about someone else (PMS uses it before putting a new team member in PM Users); `rbac_module_enabled($module)` reads the module switch; `rbac_people($kinds)` lists every staff and/or member login with a name (the Security screens' people list and PMS's pickers)." },
  { type: 'alert', variant: 'info', text: "Switched: **PMS** (step 3), **DMS** (step 4) and the **CCMPS member admin roles** (step 5: `rbac_member_roles()`, `rbac_set_member_role()`, `rbac_sync_member_columns()`, `rbac_sync_group_members()`, `rbac_member_session_flags()`). CCMPS's many individual `$_SESSION['ccmps_*']` checks still read the flags, which now come from the groups; converting them to `rbac_allowed()` is later work." },
]},

// ============================================================
{ tab: "Security Screens", blocks: [
  { type: 'p', text: "The `system-rbac` child module (`modules/system/rbac/`). Linked as **Security Groups** under System Admin." },
  { type: 'table', headers: ['Screen', 'URL', 'What the admin does'], rows: [
    ['Groups', '`system-rbac/manage`', 'List groups with their function and people counts; create, rename, deactivate or reactivate. A picker opens one person\'s effective access.'],
    ['Group form', '`system-rbac/creategroup`, `updategroup/<id>`', 'Name (unique) and description'],
    ['Group privileges', '`system-rbac/privileges/<id>`', 'Tick the functions the group may use, one panel per switched-on module, with "Select all" per module. Save adds and removes the difference.'],
    ['Group members', '`system-rbac/members/<id>`', 'Add people from a list of every login (name, staff or member, email); remove people'],
    ['Effective access', '`system-rbac/person/<tg user id>`', "A person's groups and every function they end up with, and which group gives each. For checking; changes nothing."],
    ['Modules panel', 'on `system-rbac/manage`; POST `togglemodule`', "Switch an add-on on or off for everyone (`system_modules.enabled`). Core modules can't be switched off; Honcho is switched by `HONCHO_MODULE`. Audited as `EnableModule` / `DisableModule`."],
  ]},

  { type: 'h2', text: 'Who Can Open Them' },
  { type: 'p', text: "The constructor calls `system_admin_only('system-rbac')`: the same rule as System Settings and the Auditlog (decided 2026-10-18). With `HONCHO_MODULE=1` only staff sysadmins get in and the link is in the staff side menu (`adminsidemenu.php`); with `HONCHO_MODULE=0` (Honcho Lite) member system admins get in and the link is on the member System Admin menu (`sidemenu.php`, `ccmphome.php`). Member system admins keep the Member Permissions screen for the everyday admin checkboxes. The seeded `manage_security` function is not checked yet." },

  { type: 'h2', text: 'Safety' },
  { type: 'ul', items: [
    "Every change is a POST carrying a per-session token (`$_SESSION['rbac_token']`, checked with `hash_equals`); a page without it saves nothing.",
    "Only function ids of switched-on modules are accepted from the privileges form; ticks for switched-off modules are left as they are.",
    "Every change is written to the Auditlog: `CreateGroup`, `UpdateGroup`, `ActivateGroup`, `DeactivateGroup`, `SetGroupPrivileges` (lists what was added and removed), `AddGroupMember`, `RemoveGroupMember`.",
  ]},
]},

];

module.exports = sections;
