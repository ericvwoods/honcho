// chapters/permissions.js — Honcho Requirements: Permissions and Security Groups (requirement prefix PERM).
// Written 2026-10-30 as built, from the approved RBAC plan (2026-10-18), engine/tg_helpers/rbac_helper.php,
// modules/system/rbac/, the to-do list (Permissions) and the Security chapter of the Developer's Guide.
// Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "One permission system for every part of Honcho. A System Admin ticks the **functions** a **group** may use (for example \"Create and edit projects\") and adds **people** to the group. Every module then asks the same question: may this person do this?" },
  { type: 'p', text: "Permissions say **what** someone may do. **Which records** they may do it to (their own chapter, their own record) is decided by each module and described in its chapter." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**System Admins**', 'Create groups, choose their functions, add people, switch add-on modules on and off'],
    ['**Member Admins** and System Admins', "Give members admin roles with the checkboxes on the member record or the Member Permissions screen"],
    ['**Everyone**', 'Gets exactly the menus and pages their groups allow'],
  ]},
  { type: 'p', text: "**Module:** Core (System). **To-do section:** Permissions (RBAC)." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'Groups and Functions' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PERM-01', 'A person (one login) belongs to any number of groups; a group holds functions from any number of modules; a person may do everything any of their groups allows. Staff and member logins are treated alike, but each login is a separate person.', 'Built 18 Oct 2026'],
    ['PERM-02', 'Functions are named for what a person would recognize ("Create and edit projects"), not for pieces of code.', 'Built 18 Oct 2026'],
    ['PERM-03', 'A group can be switched off without deleting it; it then gives nothing.', 'Built 18 Oct 2026'],
    ['PERM-04', 'A change takes effect on the person\'s next click; nobody has to sign out.', 'Built 18 Oct 2026'],
  ]},

  { type: 'h2', text: 'Security Groups Screens' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PERM-05', '**Security Groups** screens: list groups with their counts; create, rename, switch off; tick a group\'s functions, one panel per module with "Select all"; add and remove people from a list of every login; see one person\'s **effective access** (every function they have and which group gives it).', 'Built 18 Oct 2026'],
    ['PERM-06', '**Modules panel:** switch an add-on (Projects, AI, and later the Store, Financial, Scheduler) on or off for everyone. Core modules can\'t be switched off.', 'Built 18 Oct 2026'],
    ['PERM-07', 'Only System Admins open these screens: staff system admins when the staff module is deployed, member System Admins in Honcho Lite. The same rule guards System Settings and the Auditlog.', 'Built 18 Oct 2026'],
    ['PERM-08', 'Every change is recorded in the Auditlog (groups created, renamed, switched; functions added and removed; people added and removed; modules switched).', 'Built 18 Oct 2026'],
  ]},

  { type: 'h2', text: 'Member Admin Roles' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PERM-09', "Members' admin roles are **System Admin, Member Admin, Chapter Admin, Student Admin, Content Admin, Event Admin** and **Financial Admin**. Each is a group; ticking the role on the member record or on the **Member Permissions** screen (every member's roles in one list) adds the member to the group, and the Security Groups screens show the same.", 'Built 18 Oct 2026 (Content and Event 20 Oct, Financial 22 Oct)'],
    ['PERM-10', 'A member\'s menus follow their roles: the EMS (admin) part of the member menu appears only for members with an admin role.', 'Built 16 Oct 2026'],
    ['PERM-11', 'Saving a member as **Deceased** removes all their roles and groups.', 'Built 19 Oct 2026'],
    ['PERM-12', 'Chapter Admins act only within their own chapter: its members, member cards, documents, events and posts.', 'Built 18-27 Oct 2026 (per module)'],
    ['PERM-13', 'Financial Admins may change only the Financial tab of System Settings.', 'Built 22 Oct 2026'],
  ]},

  { type: 'h2', text: 'Modules Using It' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PERM-14', 'Projects (PMS) asks Security Groups for every page and its menu.', 'Built 18 Oct 2026'],
    ['PERM-15', 'The Document Library asks Security Groups for every action, from either login.', 'Built 18 Oct 2026'],
    ['PERM-16', 'The Website (content manager), System Settings and AI use Security Groups functions.', 'Built 20-29 Oct 2026'],
    ['PERM-17', "The member records' many older checks read the admin roles, which now come from the groups. Converting them to ask Security Groups directly, function by function, is later work.", 'Partly built (roles from groups 18 Oct 2026); conversion planned'],
    ['PERM-18', 'Every page that changes or reveals data checks permission before doing anything. A review of older code for checks that were switched off found and fixed the member record pages (27 Oct 2026); the rest of the member records code and other modules still need the same review.', 'Partly built; review planned'],
    ['PERM-19', 'The old per-module permission tables are retired once nothing reads them.', 'Planned (last step)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**No roles separate from groups:** a group holds its functions directly.",
    "**Staff groups take staff logins, member roles take member logins,** so a leftover entry can't cross sides.",
    "**Who** is always the signed-in person; never a value from the page address or a form.",
    "Switching a module off makes every check for it fail, so its menus and pages disappear for everyone.",
    "Members' own sticky notes on the Bulletin Board need no function, only the Member Bulletins setting.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "Student Admins have no section in the member side menu.",
    "Creating a member writes the login row with a different shape from the one Security Groups reads. Check the real BPA database before go-live so both agree.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['18 Oct 2026', 'RBAC plan approved with all 12 recommendations (one shared system in Core; groups hold functions; two logins remain two people; the old setups migrated, then retired).'],
    ['18 Oct 2026', 'Chapter Admins get every Document Library function, limited to their own chapter.'],
    ['18 Oct 2026', 'Security Groups, System Settings and the Auditlog share one gate: System Admins only (PERM-07).'],
    ['19 Oct 2026', 'A deceased member keeps no roles or groups (PERM-11).'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ["Administrator's Guide", 'Chapter 6, System Admins (Security Groups, Member Permissions)'],
    ["Developer's Guide", 'Security chapter (tables, `rbac_allowed()`, screens, migration)'],
    ['To-do list', 'Permissions (RBAC)'],
  ]},
]},

];
