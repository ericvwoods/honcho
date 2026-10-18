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
    ['1', 'Back up; build the tables, helper and screens. No module uses them.', 'Built 2026-10-18 (Mac). Not yet on staging.'],
    ['2', 'Migrate the data: DMS, Honcho and CCMPS functions; existing groups and people; a report of anything that will not map.', 'Not started'],
    ['3', 'Switch PMS to `rbac_require()`; team picker uses `rbac_person()`.', 'Not started'],
    ['4', 'Switch DMS; `manage()` uses the check instead of `_get_dms_role()`.', 'Not started'],
    ['5', 'Switch CCMPS: the `ccmps_*` session flags are set from groups at login; Member Permissions ticks become group memberships.', 'Not started'],
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
{ tab: "Checking Permissions", blocks: [
  { type: 'p', text: "Three plain functions in `engine/tg_helpers/rbac_helper.php`, loaded by `engine/ignition.php` like the other helpers, so they work everywhere:" },
  { type: 'code', text: "// In a controller method - stops here with a flash message if not allowed\nrbac_require('pm', 'edit_projects');\n\n// In a view or menu - true/false, for showing or hiding a link\n<?php if(rbac_allowed('pm', 'view_projects')): ?>\n    <li><a href=\"<?= BASE_URL ?>pm\"><i class=\"fa fa-folder-open\"></i> Projects</a></li>\n<?php endif; ?>\n\n// Name, email and kind (staff / member) of one login\n$person = rbac_person($tg_user_id);" },
  { type: 'ul', items: [
    "**Who** is always `$_SESSION['tg_user_id']`, which both logins set. It is never taken from the URL or a form.",
    "The chain is: `system_group_users` → `system_groups` (active) → `system_group_functions` → `system_functions` → `system_modules` (enabled). One joined query per page, remembered for the rest of that page (`_rbac_function_list()`), so a change on the Security screens works on the person's next click, with no logout.",
    "`rbac_require()` sends a person who is not logged in to `welcome/logout`; anyone else gets a flash message and goes to their home page (`honcho` for staff, `welcome-ccmps/ccmphome` for members).",
    "`rbac_person()` follows `trongate_users.login_acct_info_table` / `login_acct_table_id` to the account row (only `ccmps` and `honcho_user_accounts` are read), and falls back to `trongate_users.title`, then the username, when the row has no name.",
  ]},
  { type: 'alert', variant: 'info', text: "Nothing calls `rbac_require()` yet. Until a module is switched over (steps 3–5), its old permission code still decides." },
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
