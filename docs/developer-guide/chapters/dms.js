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
  { type: 'p', text: "Since RBAC step 4 (2026-10-18) DMS uses the shared **Security Groups** system (see the Security (RBAC) chapter). The old `dms_filelibrary_roles`, `_security_groups`, `_security_group_roles`, `_roles_functions` and `_tguserid_security_group` tables are no longer read; they stay until step 6. **Both logins** can use DMS." },
  { type: 'p', text: "Every public method still starts the same way, so the 36 call sites didn't change:" },
  { type: 'code', text: "$docfunction = 20; // the method's old dms_filelibrary_functions id\n$authorized = $this->_check_function_permissions($docfunction);" },
  { type: 'ol', items: [
    "**Logged in?** `trongatetoken` plus either `honcho_logged_in` or `ccmp_logged_in`; otherwise to the matching logout.",
    "**Allowed?** `_dms_function_code()` turns the old id into a Security Groups function (`dms/view_library`, `dms/approve_docs`, … - 36 ids onto 12 functions) and asks `rbac_allowed('dms', …)`. If not, a flash message and back to `manage` (or home).",
    "**Which view?** `_get_dms_role()` sets `$_SESSION['filelibrary_rolename']` (below). A lower view chosen on the manage page is kept.",
    "**Which documents?** `_check_doc_scope()` finds the document the action is about (`segment(3)`, `$_POST['recid']`, a comment's `doc_id`, or every ticked id for a bulk action) and checks it is within reach.",
  ]},

  { type: 'h2', text: 'Views and Which Documents' },
  { type: 'table', headers: ['filelibrary_rolename', 'Who', 'List and kanban show', 'May change'], rows: [
    ['`dmslibadmin`', 'Has `dms/approve_docs`: DMS Admins, Member System Admins, or a staff login in a group with it', 'Every document', 'Any document'],
    ['`dmslibsubadmin`', 'A **member** with `ccmps/chapter_admin` (and not `ccmps/system_admin`) who has `dms/approve_docs`: Chapter Admins', "Own chapter's documents, any status", "Only own chapter's documents. New or edited documents are saved into their own chapter (`submit()`)."],
    ['`dmslibuser`', 'Has `dms/view_library` but not `dms/approve_docs`: DMS Users (every member login)', 'Published documents (`status = 1`, `active = 1`) below their access level', 'Nothing (read and download published ones only)'],
  ]},
  { type: 'p', text: "Security Groups decide **what** someone may do; the view decides **which documents**. A custom group with, say, `edit_docs` but not `approve_docs` gets the user view, so it can't change anything - give management functions as a set. Chapter admins were given every DMS function on 2026-10-18 (`database/migrations/2026-10-18-system-rbac-step4.sql`)." },
  { type: 'p', text: "The role in the URL (`manage/dmslibuser`) can only **lower** the view, never raise it. After an action, methods still redirect with a `switch` on `filelibrary_rolename`." },

  { type: 'h2', text: 'Document Access Levels' },
  { type: 'p', text: "Separate from Security Groups. A staff login's level is `honcho_user_accounts.dmslibacclevel` (in `$_SESSION['dms_lib_access']`); members are level 0. In the user view only published documents whose `access` is below level + 1 appear, and `_check_doc_scope()` applies the same rule to viewing and downloading by URL. The levels themselves are maintained on **Library Access** (`dms-dmsfilelibraryaccess`)." },
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
    ["**The manage page took the user's role from the URL.** `manage()` set `$_SESSION['filelibrary_rolename'] = segment(3);`, so any logged-in user (including a member) could open `dms-dmslibrary/manage/dmslibadmin` and list every document. Honcho's menu links have no role in the URL, which left the role empty and crashed the page with a 500 (`$sql` never set).", '`manage()` around line 491, new `_get_dms_role()`', "2026-10-11: `_get_dms_role()` works out the role on the server. **Members:** `ccmps_system_admin` → `dmslibadmin`, `ccmps_subentity_admin` (chapter admin) → `dmslibsubadmin` (own chapter's documents only), everyone else → `dmslibuser`. **Staff:** the same group → role lookup as the Honcho login, or `dmslibadmin` when `dms_lib_access` is 99; no group, or a role `manage()` has no view for (`dmslibastadmin`), → `dmslibuser`. The role in the URL can only **lower** the result (an admin choosing the user view), never raise it. Since 2026-10-18 (RBAC step 4) it uses Security Groups; see the RBAC tab."],
    ['**Members could not use DMS beyond the list, and the list crashed when logged out.** `_check_function_permissions()` required the staff login, so a member\'s first click failed; `manage()` read the session user before any check.', '`_check_function_permissions()`, `manage()`', '2026-10-18 (RBAC step 4): either login works; `manage()` runs the check first, so a logged-out visitor goes to the login page.'],
    ['**Chapter admins got "Error 5103" after moving a card.** The `dmslibsubadmin` case was commented out in the redirect `switch` of `header0()`, `backlog()`, `pending()` and `header5()`.', 'Those four methods', '2026-10-18: case restored (back to the kanban when the move came from it).'],
    ['**`update()`, `create()` and `updatedoccomment()` gave a 500 from a link.** They required an argument this engine never passes.', 'Those three methods', "2026-10-18: `$retrying = ''` default."],
    ['**Every file upload gave a 500.** `submit_upload()` called `$this->file->upload()`, stock Trongate v2\'s File module, which this engine doesn\'t have (v1\'s built-in `upload_file()` is gone too). Two calls to `$this->dmslibrary->viewdocrec()` also crashed: a module can\'t load itself here.', '`submit_upload()`', "2026-10-18: new private `_upload_doc($config, $name)` saves `my_file` with `move_uploaded_file()` under the name the record stores (creating a chapter folder if needed); the self-calls redirect instead. The upload folders must be writable by the web server (on the Mac: `chmod 777` on `modules/dms/dmslibrary/assets`, `assets/docs`, `assets/archived`; staging's are owned by www-data)."],
    ['**Saving a new document gave a 500.** `document_id` was required with no default; no code fills or reads it, and MySQL runs in strict mode.', '`dms_filelibrary_docs`', "2026-10-18: column default `''` (`2026-10-18-system-rbac-step4.sql`)."],
    ['**Incomplete security group → role data** (group 1 → missing role 6; groups 2–4 no role; roles 2–3 no functions).', '`dms_filelibrary_*` tables', '2026-10-18: no longer read (RBAC step 4).'],
  ]},

  { type: 'h2', text: 'Not Yet Fixed' },
  { type: 'p', text: 'Found while writing this chapter (2026-10-06) and while switching DMS to Security Groups (2026-10-18).' },
  { type: 'table', headers: ['Issue', 'Where', 'Effect'], rows: [
    ['**Replacing a file on a document that already has one is unfinished.** The code is there but sits behind deliberate stops (`echo(6233); die();`, `echo(4812); die();`), and the duplicate check uses `isset()` on a lookup that returns `false`, so it always reports a duplicate.', '`submit_upload()`, around lines 5945–6060', 'Uploading to a document with a file shows "The file … already associated with document . File not replaced." A first upload works.'],
    ['`header5()` writes the label text into the status column: `$data[\'status\'] = DMS_KBB_HDR5;` (that constant is the string "Approved").', '`header5()`, around line 6556', 'The database runs in strict mode, so moving a card into the last column through `header5()` fails with a database error. It should be `1`. (`approvedoc()` sets `status = 1` correctly.)'],
    ['Audit-log entries use `$data[\'title\']`, which is never set in the move methods.', 'Column-move methods', 'The audit log records an empty title (plus a PHP warning).'],
    ['`index()` prints a "Contact System Admin" message and `die()`s before its real code.', '`index()`', '`dms-dmslibrary` with no method is a dead end; the real entry points are `manage` and `kanban`.'],
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
    'Pick an unused id (37 and up) and start the method with `$docfunction = <id>;` and `$this->_check_function_permissions($docfunction);`.',
    'Map the id to a Security Groups function in `_dms_function_code()`: an existing `dms/…` function, or a new one added to `system_functions` with a migration script (then tick it for the right groups).',
    'If the method acts on one document, add the id to the right list in `_check_doc_scope()` so chapter admins and members are limited to documents within reach.',
    'Add it to the function list at the top of `Dmslibrary.php`.',
  ]},
  { type: 'h2', text: 'Adding or Renaming a Lookup Value' },
  { type: 'p', text: 'Tag values, departments, access levels and file types are data, not code: add rows to the matching `dms_filelibrary_*` table. Access levels have their own maintenance screen (`dms-dmsfilelibraryaccess`). The old functions screen (`dms-dmsfilelibraryfunctions`) is off the menu: nothing reads that table since RBAC step 4.' },
]},

];

module.exports = sections;
