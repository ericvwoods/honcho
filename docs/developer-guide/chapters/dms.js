// ============================================================
// chapters/dms.js — DMS chapter of the Honcho Developer's Guide
// ============================================================
// Core product. Written 2026-10-06 from the code and database
// (modules/dms/, dms_filelibrary_* tables). There is no in-app
// helpdocs page for DMS yet; the built-in online help comes later.
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Architecture", blocks: [
  { type: 'p', text: "DMS (Document Management System) is the Core module for storing, tagging, reviewing and approving documents. Each document is a record in `dms_filelibrary_docs`, optionally with an uploaded file. Records move through a six-column **kanban board** from Unrefined to Approved. The kanban board, the three-tag system and the role/security-group permission tables were later reused as the basis for the PMS add-on." },

  { type: 'h2', text: 'The Three Child Modules' },
  { type: 'p', text: 'DMS lives under the `dms` parent module, so every URL is `dms-<child>/<method>`.' },
  { type: 'table', headers: ['Module', 'Role'], rows: [
    ['`dms-dmslibrary`', "The library itself. `Dmslibrary.php` (~9,100 lines) holds every document, comment, kanban and file action. The function list at the top of the file is the quickest map of it."],
    ['`dms-dmsfilelibraryaccess`', 'Maintenance screen for the `dms_filelibrary_access` lookup table (document access levels). Uses the standard four-file maintenance-table pattern.'],
    ['`dms-dmsfilelibraryfunctions`', 'Maintenance screen for `dms_filelibrary_functions` (the permission function list). Same four-file pattern.'],
  ]},

  { type: 'h2', text: 'Key Views (modules/dms/dmslibrary/views/)' },
  { type: 'table', headers: ['File', 'Role'], rows: [
    ['`manage.php`', 'The filterable document list. Filters: subentity, the three tags, format, region, lead, access level, staff, member and department.'],
    ['`librarykanban.php`', 'The kanban board (~2,300 lines). Each card links to the method that moves it to the next column.'],
    ['`documentcrud.php`', 'Create/edit form for a document record, including the file upload.'],
    ['`commentcrud.php`, `managecomments.php`', 'Review comments on a document (add, close, delete/undelete).'],
    ['`fulldescription.php`, `pdfs.php`', 'Read-only views of a document.'],
  ]},
  { type: 'alert', variant: 'warning', text: "The views folder also contains old copies (`librarykanban_demo.php`, `templatecrud.php`, `templatecrud2.php`, and `.old`/`.last` files next to `Dmslibrary.php`). They are not loaded by any live code path. Edit only the files listed above." },

  { type: 'h2', text: 'Where Files Are Stored' },
  { type: 'p', text: 'Uploaded files go under `modules/dms/dmslibrary/assets/`, not under `public/`, so the web server never serves them directly. `previewdocrec()` and `downloaddoc()` read the file with `readfile()` after the permission check. Most uploads land in `assets/docs/`; some code paths use a per-subentity subfolder (`assets/<subentity folder>/`).' },
  { type: 'p', text: "When a replacement file has the same name and `DMS_FL_SAVE_BAK` is `1` (config.php), the old file is renamed to `<name>_<ext>.bak` and not overwritten." },

  { type: 'h2', text: 'Predecessor: cms-ccmpslibrary' },
  { type: 'p', text: 'An older, member-facing library lived at `modules/cms/ccmpslibrary/`. It was removed on 2026-10-16: DMS is the only document library. Its menu links now go to `dms-dmslibrary/manage` (the role is worked out on the server), and its upload folder is no longer mounted. Still left behind: the `CCMPS_FL_*` constants in config.php (some DMS views use them) and the old `cms_ccmps_filelibrary_*` database tables (no code reads them).' },
]},

// ============================================================
{ tab: "Schema", blocks: [
  { type: 'h2', text: 'The Document Record' },
  { type: 'h3', text: '`dms_filelibrary_docs`, one row per document' },
  { type: 'table', headers: ['Column(s)', 'Meaning'], rows: [
    ['`title`, `subject`, `shortdescription`, `fulldescription`, `notes`, `author`', 'Descriptive text.'],
    ['`status`', 'Kanban column, an id from `dms_filelibrary_status` (see the Kanban & Tagging tab). Note the numbering runs **backwards**: 6 = Unrefined … 1 = Approved.'],
    ['`active`, `done`, `soft_deleted`', '`active = 0` hides a record (`hiderecord`). `done = 1` takes an Approved record off the board (`done()`). `soft_deleted = 1` is the delete flag.'],
    ['`onhold` + `holdreason`, `blocked` + `blocker`, `rejected` + `rejectreason`', 'Workflow flags shown on the card. `approvedoc()` clears all three.'],
    ['`doctag1`, `doctag2`, `doctag3`', 'The three tags, ids into `dms_filelibrary_doctags1/2/3`.'],
    ['`access`', 'Access level, an id from `dms_filelibrary_access`. Limits which Regular Users can see the document (see the RBAC tab).'],
    ['`rectype`', '`1` = DB record only (no file), `2` = has an uploaded file.'],
    ['`filename`, `location`, `filetype`, `filemime`, `filesize`, `filedate`, `extlink`', 'The uploaded file and where it lives.'],
    ['`subentity`, `department`, `region`, `staff`, `ccmp_id`, `poc`', 'Who and what the document belongs to. `poc` is the point of contact.'],
    ['`priority`, `points`, dates (`assigndate`, `eststartdate`, `estenddate`, `startdate`, `enddate`, `duedate`)', 'Planning fields. Dates are Unix timestamps (`int`).'],
    ['`previews`, `downloads`', 'Counters.'],
    ['`created_*`, `updated_*`, `uploaded_*`', 'Audit columns (user id + Unix timestamp).'],
  ]},
  { type: 'h3', text: '`dms_filelibrary_docs_comments`, review comments' },
  { type: 'p', text: 'One row per comment on a document (`doc_id`), with `status`, `type`, `resolution`, who closed it and when, and `soft_deleted`.' },

  { type: 'h2', text: 'Lookup Tables' },
  { type: 'table', headers: ['Table', 'Holds'], rows: [
    ['`dms_filelibrary_status`', 'The six kanban statuses (ids 1–6).'],
    ['`dms_filelibrary_doctags1/2/3`', 'The values for each of the three tags.'],
    ['`dms_filelibrary_access`', 'Access levels 1 (Public) to 13 (CEO).'],
    ['`dms_filelibrary_priority`, `_rectypes`, `_filetypes`', 'Priority, record type and allowed file types (with MIME type).'],
    ['`dms_filelibrary_departments`, `_subentities`', 'Departments (each tied to a `doctag1` value) and the DMS subentities (`DMS_SUBENTITY`, e.g. "School").'],
    ['`dms_filelibrary_bulk_actions`', 'Options for the bulk-action dropdown on the manage page.'],
  ]},

  { type: 'h2', text: 'Permission Tables' },
  { type: 'p', text: '`dms_filelibrary_roles`, `_functions`, `_roles_functions`, `_security_groups`, `_security_group_roles`, `_tguserid_security_group`. How they fit together is covered in the RBAC tab.' },
]},

// ============================================================
{ tab: "RBAC", blocks: [
  { type: 'h2', text: 'The Chain: User → Security Group → Role → Functions' },
  { type: 'p', text: 'Unlike CCMPS (where the table-driven check is disabled), DMS really does enforce its permission tables. Every public method starts with:' },
  { type: 'code', text: "$docfunction = 20; // this method's id in dms_filelibrary_functions\n$authorized = $this->_check_function_permissions($docfunction);" },
  { type: 'ol', items: [
    "**At login**, `Honcho.php` (around line 443) looks up the user in `dms_filelibrary_tguserid_security_group` and sets `$_SESSION['filelibrary_security_group_id']`, then follows `dms_filelibrary_security_group_roles` to the role and sets `$_SESSION['filelibrary_rolename']` (the role's `session_name`).",
    "**On every request**, `_check_function_permissions()` checks the session hasn't expired (`trongatetoken`) and the user is authenticated, then repeats that group → role lookup.",
    "It then looks for a row in `dms_filelibrary_roles_functions` with that `role_id` and the method's `function_id`. If one exists, the method runs; if not, the user is sent to `dms-dmslibrary/manage` with a \"not authorized\" flash message.",
  ]},
  { type: 'p', text: "A user with no security group gets a plain-text error (\"Error 7935\") and stops there." },

  { type: 'h2', text: 'Roles' },
  { type: 'table', headers: ['id', 'session_name', 'Meaning'], rows: [
    ['1', '`dmslibadmin`', 'Admin, has all 36 functions'],
    ['2', '`dmslibastadmin`', 'Assistant Admin'],
    ['3', '`dmslibsubadmin`', 'Subentity Admin'],
    ['4', '`dmslibuser`', 'Regular User, has 4 functions'],
  ]},
  { type: 'p', text: "After an action, many methods redirect with a `switch` on `$_SESSION['filelibrary_rolename']`, so each role returns to its own version of the manage page." },

  { type: 'h2', text: 'Function Ids' },
  { type: 'p', text: "Function ids 1–36 in `dms_filelibrary_functions` map one-to-one to the public methods (1 `index`, 3 `kanban`, 4 `manage`, 12 `approvedoc`, 19–24 the six column moves, 25 `done`, …). When adding a method, add a row there, use its id in the method, and grant it to roles in `dms_filelibrary_roles_functions`." },

  { type: 'h2', text: 'Document Access Levels' },
  { type: 'p', text: "Separate from roles. A user's level comes from their account (`honcho_user_accounts.dmslibacclevel`, loaded into `$_SESSION['dms_lib_access']`). On the manage page, a **Regular User** (`dmslibuser`) only sees **Approved** documents (`status = 1`) whose `access` is at or below their level. Admin roles see every document regardless of level." },
]},

// ============================================================
{ tab: "Kanban & Tagging", blocks: [
  { type: 'h2', text: 'The Six Columns' },
  { type: 'table', headers: ['Column', 'status id', 'Label constant', 'Method that moves a card here', 'function id'], rows: [
    ['1 (optional)', '6', '`DMS_KBB_HDR0`', '`header0()`', '19'],
    ['2', '5', '`DMS_KBB_HDR1`', '`backlog()`', '20'],
    ['3', '4', '`DMS_KBB_HDR2`', '`inprogress()`', '21'],
    ['4', '3', '`DMS_KBB_HDR3`', '`inreview()`', '22'],
    ['5', '2', '`DMS_KBB_HDR4`', '`pending()`', '23'],
    ['6 (optional)', '1', '`DMS_KBB_HDR5`', '`header5()` / `approvedoc()`', '24 / 12'],
  ]},
  { type: 'p', text: "Each move method takes `/<recid>/<managemode>/<frompage>` in the URL, updates `status`, writes an audit-log entry, and redirects back to where the user came from (`k` = kanban, `v` = view page, otherwise the manage page). `done()` sets `done = 1`, which removes an Approved card from the board." },

  { type: 'h2', text: 'Column Labels and Settings' },
  { type: 'ul', items: [
    "**Labels** come from the `DMS_KBB_HDR0`–`DMS_KBB_HDR5` constants in `config/config.php`.",
    "**Showing the optional first and last columns** comes from `system_settings` rows 6 (`DMS_KBB_SHOW_HDR0`) and 8 (`DMS_KBB_SHOW_HDR5`). The `Dmslibrary` constructor reads them into `$_SESSION` on every request.",
    "`system_settings` also has rows 7 and 9–13 holding the same column labels, and rows 3–5 holding the tag labels. **The code does not read those rows**: it uses the `config.php` constants. Change labels in `config.php`.",
    "`system_settings` rows 14 and 15 (`FORCE_EDIT_TO_IN_PROG`, `FORCE_EDIT_TO_BACKLOG`) are not referenced anywhere in the code yet.",
  ]},

  { type: 'h2', text: 'The Three-Tag System' },
  { type: 'p', text: "Every document can carry one value from each of three independent tag lists, stored in `doctag1`, `doctag2` and `doctag3`. The **meaning** of each tag is set per client by renaming it, not by changing code:" },
  { type: 'table', headers: ['Tag', 'Label constant (config.php)', 'This deployment', 'Values table'], rows: [
    ['1', '`DMS_FL_TAG1`', 'Organization', '`dms_filelibrary_doctags1`'],
    ['2', '`DMS_FL_TAG2`', 'Category', '`dms_filelibrary_doctags2`'],
    ['3', '`DMS_FL_TAG3`', 'Type', '`dms_filelibrary_doctags3`'],
  ]},
  { type: 'p', text: "Tag 1 is the \"owner\" tag: `dms_filelibrary_departments` rows each belong to a `doctag1` value. All three tags are filters on the manage page, and the active filters are shown above the list using the label constants." },
  { type: 'alert', variant: 'info', text: 'For a new client, setting up DMS mostly means renaming the three tags and the six column labels in `config.php`, then loading their own values into the three `doctags` tables.' },
]},

// ============================================================
{ tab: "Known Issues", blocks: [
  { type: 'h2', text: 'Fixed' },
  { type: 'table', headers: ['Bug', 'Where', 'Fix'], rows: [
    ['**SQL injection through request values.** The manage-page filters (`$_POST[\'sqlfilter...\']`) and the document id in `managedoccomments/<id>` were concatenated straight into SQL, so a logged-in user could change the query by editing a value in the browser.', '`manage()` (the eleven `$sqlfilter...` lines), `managedoccomments()`', "2026-10-06: each value is now read with `intval()`. Anything that is not a number becomes `0` (no filter). **Rule going forward:** any request value that goes into a hand-built SQL string must be `intval()`'d first (or use `query_bind()`)."],
    ["**The manage page took the user's role from the URL.** `manage()` set `$_SESSION['filelibrary_rolename'] = segment(3);`, so any logged-in user (including a member) could open `dms-dmslibrary/manage/dmslibadmin` and list every document. Honcho's menu links have no role in the URL, which left the role empty and crashed the page with a 500 (`$sql` never set).", '`manage()` around line 491, new `_get_dms_role()`', "2026-10-11: `_get_dms_role()` works out the role on the server. **Members:** `ccmps_system_admin` → `dmslibadmin`, `ccmps_subentity_admin` (chapter admin) → `dmslibsubadmin` (own chapter's documents only), everyone else → `dmslibuser`. **Staff:** the same group → role lookup as the Honcho login, or `dmslibadmin` when `dms_lib_access` is 99; no group, or a role `manage()` has no view for (`dmslibastadmin`), → `dmslibuser`. The role in the URL can only **lower** the result (an admin choosing the user view), never raise it."],
  ]},

  { type: 'h2', text: 'Not Yet Fixed' },
  { type: 'p', text: 'Found while writing this chapter (2026-10-06).' },
  { type: 'table', headers: ['Issue', 'Where', 'Effect'], rows: [
    ['`header5()` writes the label text into the status column: `$data[\'status\'] = DMS_KBB_HDR5;` (that constant is the string "Approved").', '`header5()`, around line 6556', 'The database runs in strict mode, so moving a card into the last column through `header5()` fails with a database error. It should be `1`. (`approvedoc()` sets `status = 1` correctly.)'],
    ['Security group → role mappings are incomplete. Group 1 maps to role 1 and to role **6, which does not exist**. Groups 2, 3 and 4 have no role at all. Roles 2 and 3 have no functions.', '`dms_filelibrary_security_group_roles`, `dms_filelibrary_roles_functions` (data)', 'Anyone placed in groups 2–4 hits a PHP error at login and on every DMS page. The permission check only ever uses the **first** role row for a group.'],
    ['The `dmslibsubadmin` case is commented out in the redirect `switch` after a column move.', '`backlog()` and the other move methods', 'A Subentity Admin who moves a card gets "Error 5103: No matching manage mode".'],
    ['Audit-log entries use `$data[\'title\']`, which is never set in the move methods.', 'Column-move methods', 'The audit log records an empty title (plus a PHP warning).'],
    ['`index()` prints a "Contact System Admin" message and `die()`s before its real code.', '`index()`', '`dms-dmslibrary` with no method is a dead end; the real entry points are `manage` and `kanban`.'],
    ['`manage()` crashes when nobody is logged in: it loads the user record from the session before any login check.', '`manage()`, around line 556', 'A logged-out visitor gets a 500 error page, not the login page.'],
  ]},
  { type: 'alert', variant: 'warning', text: 'The same **debug-die() landmine** described in the CCMPS chapter applies here: the file has many commented-out `echo(NNNN); die();` lines. If a DMS function seems to do nothing, check for one that is not commented out.' },
]},

// ============================================================
{ tab: "Testing", blocks: [
  { type: 'p', text: 'There are no automated tests for DMS. Test by hand as a user in each role, on the manage page, the kanban board, and an upload with `DMS_FL_SAVE_BAK` on.' },
]},

// ============================================================
{ tab: "Extending", blocks: [
  { type: 'h2', text: 'Adding a New Method' },
  { type: 'ol', items: [
    'Add a row to `dms_filelibrary_functions` and note its id.',
    'Start the method with `$docfunction = <id>;` and `$this->_check_function_permissions($docfunction);`.',
    'Grant it to the right roles in `dms_filelibrary_roles_functions`.',
    'Add it to the function list at the top of `Dmslibrary.php`.',
  ]},
  { type: 'h2', text: 'Adding or Renaming a Lookup Value' },
  { type: 'p', text: 'Tag values, departments, access levels and file types are data, not code: add rows to the matching `dms_filelibrary_*` table. Access levels and functions have their own maintenance screens (`dms-dmsfilelibraryaccess`, `dms-dmsfilelibraryfunctions`).' },
]},

];

module.exports = sections;
