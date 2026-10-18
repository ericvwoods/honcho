// ============================================================
// chapters/pms.js — PMS chapter of the Honcho Developer's Guide
// ============================================================
// Add-on. Written 2026-10-06 from the code and database
// (modules/pm/, pm_* tables) and modules/pm/README.md.
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Architecture", blocks: [
  { type: 'p', text: "PMS (Project Management System) is an **add-on**: a client only has it if it is installed and switched on. It is built on the DMS pattern (the same user → security group → role → function permission chain, and later a kanban board), but it is written in **Trongate v2 style**, unlike the rest of Honcho." },
  { type: 'p', text: "**Phase 1 (built): Teams and Projects.** Phase 2 (sprints, stories, a kanban board, templates, document links) has tables and function ids already in place but no code yet." },

  { type: 'h2', text: 'Files' },
  { type: 'table', headers: ['File', 'Role'], rows: [
    ['`modules/pm/Pm.php`', 'The controller: decides what happens. Every public method is a page or a form target; helpers are `private` (a URL to a private method returns 404).'],
    ['`modules/pm/Pm_model.php`', 'All database work. The controller reaches it as `$this->model->...`.'],
    ['`modules/pm/views/`', 'Lists, show pages and forms for projects and teams, plus shared pieces: `navbar.php`, `pmmenu.php`, `flashmsg.php`, `formerrors.php`, `datatable.php`.'],
    ['`modules/pm/pm_schema.sql`', 'Creates all 24 `pm_*` tables and their reference data.'],
    ['`modules/pm/README.md`', 'Install notes, URL list and v1 → v2 changes. **Written for stock Trongate v2**, so parts of it do not apply here (see the Known Issues tab).'],
  ]},

  { type: 'h2', text: 'How PMS Differs From the Legacy Modules' },
  { type: 'table', headers: ['Topic', 'Legacy modules (CCMPS, DMS)', 'PMS'], rows: [
    ['Database calls', "`$this->model` is the shared legacy `Model`; SQL is usually built by joining strings", 'Its own `Pm_model`; every query with a value uses `query_bind()` with named placeholders (`:team_id`)'],
    ['Private helpers', '`_underscore` names', '`private function`'],
    ['Forms', 'Hand-written `$_POST` checks', '`form_open()`/`form_close()` (adds a CSRF token) and `$this->validation`'],
    ['Allowed values', 'Checked in place, if at all', 'Whitelist callbacks (`team_check`, `po_check`, `status_check`…) run by validation'],
    ['People', 'Each module reads user tables its own way', "One method, `get_user()`, turns a `tg_user_id` into a person, following `trongate_users.login_acct_info_table`"],
  ]},

  { type: 'h2', text: 'Engine Additions PMS Depends On' },
  { type: 'p', text: "Honcho's engine was modified to run Trongate 1.x code. To run PMS without breaking any of that, four small pieces were added on 2026-10-06:" },
  { type: 'ul', items: [
    "`Trongate::make_model()` (`engine/Trongate.php`): if `modules/<module>/<Module>_model.php` exists, `$this->model` is that class; otherwise it is the shared legacy `Model`, as before. `Pm_model` extends the legacy `Model`, so it calls `$this->query_bind()` etc. directly; there is no `$this->db`.",
    "`modules/validation/Validation.php`: `set_rules()` and `run()`. `run()` checks the CSRF token first (a bad token redirects to `BASE_URL`), then the rules: `required`, `min_length[n]`, `max_length[n]`, `numeric`, `integer`, `valid_email`, `valid_date`, `callback_<method>`. Errors go where `validation_errors()` reads them.",
    "`block_url()` (`engine/tg_helpers/utilities_helper.php`): a validation callback calls `block_url('pm/team_check')` first so it 404s if visited as a page.",
    "`Templates::error_404($data = [])`: made the argument optional so 404 pages stop crashing (affected the whole app, not just PMS).",
  ]},
]},

// ============================================================
{ tab: "Schema", blocks: [
  { type: 'h2', text: 'Phase 1 Tables (in use)' },
  { type: 'table', headers: ['Table', 'Holds'], rows: [
    ['`pm_teams`', '`name` (unique among active teams), `description`, `active` (0 = deleted).'],
    ['`pm_team_members`', 'One row per person per team: `team_id`, `tg_user_id`, `active`. Removing a member sets `active = 0`; adding them back reactivates the same row.'],
    ['`pm_projects`', '`team_id`, `name`, `shortdescription`, `description`, `product_owner` (a `tg_user_id`), `status`, `startdate`/`enddate` (Unix timestamps), `soft_deleted`, `template_id` (Phase 2).'],
    ['`pm_project_status`', '1 Planning, 2 Active, 3 Complete, 4 Cancelled. "Open" projects are 1 and 2.'],
    ['`pm_settings`', "Key/value settings. Only `include_ccmps_users` is read today."],
    ['`pm_roles`, `pm_functions`, `pm_roles_functions`, `pm_security_groups`, `pm_security_group_roles`, `pm_tguserid_security_group`', 'Permissions (see the RBAC tab).'],
  ]},
  { type: 'h2', text: 'Phase 2 Tables (created, not used yet)' },
  { type: 'p', text: '`pm_sprints`, `pm_stories`, `pm_story_status`, `pm_priority`, `pm_story_sprint_moves`, `pm_story_criteria`, `pm_story_tasks`, `pm_story_comments`, `pm_doc_links` (links to DMS documents), `pm_templates`, `pm_template_stories`, `pm_template_criteria`, `pm_template_tasks`.' },
  { type: 'p', text: "All `pm_*` tables use `created_at`/`created_by`/`updated_at`/`updated_by` audit columns with Unix timestamps and `tg_user_id`s, like DMS." },
]},

// ============================================================
{ tab: "RBAC", blocks: [
  { type: 'p', text: "Since RBAC step 3 (2026-10-18) PMS uses the shared **Security Groups** system (see the Security (RBAC) chapter): person → groups → functions, read on every request. The old `pm_roles`, `pm_security_*`, `pm_roles_functions` and `pm_tguserid_security_group` tables are no longer read; they stay until step 6 retires them." },
  { type: 'table', headers: ['Function (pm/…)', 'Pages'], rows: [
    ['`view_projects`', '`pm`, `show_project`'],
    ['`manage_projects`', '`manage_projects`. Also makes the person a PMS **admin** (`is_admin()`): sees every project and the admin buttons.'],
    ['`edit_projects`', '`create_project`, `submit_project`'],
    ['`delete_projects`', '`delete_project`'],
    ['`view_teams`', '`manage_teams`, `show_team`'],
    ['`edit_teams`', '`create_team`, `submit_team`, `add_member`, `remove_member`'],
    ['`delete_teams`', '`delete_team`'],
  ]},
  { type: 'p', text: "The other 15 `pm/` functions (board, sprints, stories, templates…) are for Phase 2 pages that don't exist yet. Groups from step 2: **PM Admins** (all 22) and **PM Users** (view projects, board, backlog, stories, tick criteria and tasks, comments, document links)." },

  { type: 'h2', text: 'The Check: check_permission()' },
  { type: 'p', text: "Every public method in `Pm.php` starts with `$this->check_permission('<function code>');`. It:" },
  { type: 'ol', items: [
    "sends the user to `honcho/logout` if `$_SESSION['trongatetoken']` is empty or `$_SESSION['authenticated']` is not 1, so **PMS needs a Honcho (staff) login**: it is sold with Honcho (decided 2026-10-18);",
    "sends them to `honcho` with a message unless `rbac_allowed('pm', <code>)`.",
  ]},
  { type: 'p', text: "The constructor first checks `rbac_module_enabled('pm')`: the Projects switch in the Modules panel on the Security Groups page (`system_modules.enabled`). This replaced the hard-coded `PM_SYS_SETTING_ID` and its `system_settings` row (16 here), which is no longer read." },

  { type: 'h2', text: 'Who Sees Which Projects' },
  { type: 'ul', items: [
    '**Admins** (`pm/manage_projects`) see every project.',
    "**Everyone else** sees projects where they are the Product Owner or an active member of the project's team (`get_my_projects()`, `can_view_project()`). Typing another team's project URL is refused.",
    "Adding someone to a team who can't open PMS yet puts them in the **PM Users** security group (`grant_pm_user_if_missing()`, using `rbac_allowed_for()`). The flash message says so and both steps are audited.",
  ]},

  { type: 'h2', text: 'Who Can Be Picked' },
  { type: 'p', text: "The team-member and Product Owner pickers list every staff login, built from `trongate_users` by `rbac_people()`. If `pm_settings.include_ccmps_users` is `1`, member logins are added too, marked with the `CCMP` label. Names come from `rbac_person()` (`Pm_model::get_user()`), which falls back to the login's title when the account row has no name." },
]},


// ============================================================
{ tab: "Install & Enable", blocks: [
  { type: 'p', text: 'What a new client installation needs for the PMS add-on, on this engine:' },
  { type: 'ol', items: [
    'Copy `modules/pm/` into the app, and make sure the four engine additions from the Architecture tab are present.',
    'Run `modules/pm/pm_schema.sql`.',
    "Make sure the Security Groups tables and the `pm` functions exist (`database/migrations/2026-10-18-system-rbac.sql` and `...-step2.sql`). Switch Projects on in the **Modules** panel on the Security Groups page.",
    "Give the first admin access: add their staff login to the **PM Admins** group (Security Groups → PM Admins → Members).",
    "The **PMS → Projects** menu item is in the staff side menu, `modules/honcho/views/inspinia/admin/adminsidemenu.php`, shown only when `rbac_allowed('pm', 'view_projects')`, so it disappears when PMS is switched off. The member side menu (`sidemenu.php`) still has the block, switched off with `if(false && …)`: running PMS needs the Honcho staff module, so PMS is sold with Honcho, never to a members-only client (decided 2026-10-18).",
    "Optional: `UPDATE pm_settings SET settingvalue = '1' WHERE setting_key = 'include_ccmps_users';` to offer members in the pickers.",
  ]},
  { type: 'p', text: "PMS also uses the `timedate` and `system-auditlogger` modules and the constants `SYS_ADMIN_PHONE`, `NB_CLR`, `SN_*` and `PUBLIC_WEBSITE` from `config.php`." },
  { type: 'alert', variant: 'warning', text: "Don't follow README steps 4 and 6 on this engine. They are written for stock Trongate v2: Honcho's templates module already has `inspinia()`, and step 6's sample code uses `$this->db`, which does not exist here." },
]},

// ============================================================
{ tab: "Known Issues", blocks: [
  { type: 'table', headers: ['Issue', 'Effect'], rows: [
    ["PMS was built and tested (42 checks, per the README) on **stock** Trongate v2, not on Honcho's modified engine.", 'On this engine the first request crashed with a 500 until the engine additions were made (2026-10-06). The logged-in pages and forms have **not yet been re-tested** on this engine.'],
  ]},
]},

// ============================================================
{ tab: "Testing", blocks: [
  { type: 'p', text: "The README lists 42 checks that passed on stock Trongate v2: form validation, CSRF and tampering, permissions, routing, output escaping and audit logging. There is no automated test suite in this project. Until one exists, repeat the README's checks by hand on this engine after changes." },
]},

// ============================================================
{ tab: "Extending", blocks: [
  { type: 'h2', text: 'Adding a Page or Form' },
  { type: 'ol', items: [
    "Use (or add) a function id in `pm_functions` and grant it in `pm_roles_functions`.",
    "Add a public method to `Pm.php` that starts with `$this->check_permission(<id>);` and builds `$data` with `base_data()`.",
    "Put all SQL in a `Pm_model` method, using `query_bind()` with placeholders for every value.",
    "For a form: set rules with `$this->validation->set_rules()`, put whitelist checks in a public `*_check` callback that starts with `block_url('pm/<name>')`, and on failure call the form method again so it redisplays with what was typed.",
    "Log changes with the private `audit()` helper.",
  ]},
  { type: 'h2', text: 'Phase 2' },
  { type: 'p', text: "The tables and function ids (10–22) for sprints, the story backlog, the kanban board, templates and DMS document links already exist. The kanban board should follow the DMS board's design (see the DMS chapter)." },
]},

];

module.exports = sections;
