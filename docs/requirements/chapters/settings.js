// chapters/settings.js — Honcho Requirements: System Settings and Branding (requirement prefix SET).
// Written 2026-10-30 as built, checked against the system_settings table (tabs and rows on the Mac),
// modules/system/settings/, config/settings.php (setting(), scheme_color()), title_bar_name() in
// utilities_helper.php, the Settings plan (2026-10-22), the to-do list (Settings, Theme) and the
// Security and Configuration chapters of the Developer's Guide. Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Lets each organization make Honcho its own without code changes: its names and wording, logos and colors, contact links, policies, financial year and which member fields it uses. Honcho is sold to many organizations, so anything an organization decides lives here; secrets and server details live in the server's private settings file; only what needs a code change lives in the code." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**System Admins**', 'Change every tab'],
    ['**Financial Admins**', 'Change the Financial tab only'],
  ]},
  { type: 'p', text: "**Module:** Core (System). **To-do sections:** Settings; Theme." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'The Settings Screen' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['SET-01', '**System Settings**, one tab per area: Organization, Wording, Look, Features & Policy, Financial, Member Fields, Document Library. Each setting has a label and help text.', 'Built 22 Oct 2026 (tabs added through 27 Oct)'],
    ['SET-02', 'Each person sees only the tabs and settings they may change, and the server ignores a change to any other setting.', 'Built 22 Oct 2026'],
    ['SET-03', 'Each value is checked for its kind: text (no page markup), on/off, year, number with a range, fraction, web address, phone, list choice, color scheme, picture.', 'Built 22 Oct 2026'],
    ['SET-04', 'Every change is recorded in the Auditlog with its old and new value.', 'Built 22 Oct 2026'],
    ['SET-05', 'A change shows on the next page anyone opens. If the settings can\'t be read, every setting falls back to its built-in default and the problem is logged.', 'Built 22 Oct 2026'],
    ['SET-06', 'New settings arrive with an update to the system (a database migration), never typed in on the screen, since a setting does nothing until the code reads it.', 'Built 22 Oct 2026 (rule)'],
  ]},

  { type: 'h2', text: 'Names, Wording and Contacts' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['SET-07', "**Organization:** the organization's full and short names, the portal and admin names, its public website, support phone, Facebook, X and YouTube links.", 'Built 22 Oct 2026'],
    ['SET-08', "**Wording:** the words for a member and members, a chapter and chapters, a staff user and users, the website menu, and the names of the member and staff second factors. Screens use these words everywhere instead of \"Member\" and \"Chapter\".", 'Built 22 Oct 2026 (screens converted 19 Oct)'],
    ['SET-09', "**Top bar name:** every member page shows the short name plus \"Member Portal\" (BPA Member Portal) and every admin page the short name plus \"EMS\" (BPA EMS), in the scheme's colors, linking to the public website. Both words are settings.", 'Built 27 Oct 2026'],
  ]},

  { type: 'h2', text: 'Look' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['SET-10', '**Color schemes:** Classic (BPA\'s original colors), Inspinia, Navy & Gold, Slate & Crimson, and Custom with six color pickers. A scheme gives six jobs one color each everywhere: Primary, Accent, Highlight, Label, Value, Menu.', 'Built 25 Oct 2026'],
    ['SET-11', 'The main logo and the header logo are chosen from the Website picture library.', 'Built 25 Oct 2026'],
    ['SET-12', 'A configurable extra button on the member home (link and label).', 'Built 22 Oct 2026'],
    ['SET-13', 'The roughly 229 colors still typed straight into individual screens move to the scheme as each screen is worked on.', 'Planned (gradual)'],
    ['SET-14', 'A Honcho theme on free Bootstrap 5 replaces the paid Inspinia theme, screen by screen, keeping its look; colors become true scheme variables. Until then, check whether Inspinia\'s licence allows one copy per client.', 'Planned (decided 25 Oct 2026); unused theme files already removed'],
  ]},

  { type: 'h2', text: 'Features, Policies and Fields' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['SET-15', '**Features & Policy:** whether the front address shows the public website or the login; whether members may post sticky notes; minimum password length; new members must change their password; what chapters without their own AI connection get; whether members can have their own Coffee Report.', 'Built 22 Oct 2026 (AI setting 29 Oct, member Coffee Reports 30 Oct)'],
    ['SET-16', '**Financial:** current membership year, grace period, open dues payment year, new member dues proration (see Member Records).', 'Built 22 Oct 2026'],
    ['SET-17', '**Member Fields:** switch member-record fields the organization doesn\'t use off and on (see Member Records, MEM-06).', 'Built 27 Oct 2026'],
    ['SET-18', '**Document Library:** the library\'s chapter word, its three tag names, and the kanban column titles and which columns show (see Document Library).', 'Built 22 Oct 2026'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'table', headers: ['Kind of setting', 'Lives in', 'Examples'], rows: [
    ['Secret, or different on each server', "The server's private settings file (`.env`), never in the code or database", 'Database password, API keys, mail sender, server address'],
    ['Needs a code change to mean anything', 'The code (`config.php`)', 'Internal switches'],
    ['Decided by the organization', 'System Settings', 'Names, colors, policies, financial year'],
  ]},
  { type: 'ul', items: [
    "Never type the organization's name, colors or logo into a screen: use the settings.",
    "Financial Admins can change only the Financial tab, and every change to the year or grace period re-checks member statuses after a confirmation.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "The member status re-check can be started by anyone from the address bar; it must be limited to the settings screen.",
    "New members get the same starting password (`123456`); they should get a random one and a set-password link, with the Forgot password rebuild (Logins, LOGIN-11).",
    "Phone app wording is still typed in (\"BPA Member Portal\", \"Member\", \"My Chapter\"); the app should take the organization's words from the server.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['22 Oct 2026', 'Settings plan approved: every setting has one home (private file, code, or System Settings with a screen), delivered in phases with a sign-off after each.'],
    ['22 Oct 2026', 'A Financial Admin role that may change only the Financial tab.'],
    ['25 Oct 2026', 'Color schemes with six jobs; Classic keeps BPA\'s colors exactly.'],
    ['25 Oct 2026', 'Keep the Inspinia theme for now and move gradually to plain Bootstrap 5 with a small Honcho stylesheet.'],
    ['27 Oct 2026', 'Top bar shows "<short name> Member Portal" or "<short name> EMS", configurable (SET-09).'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ["Administrator's Guide", 'Chapter 6, System Admins: System Settings'],
    ["Developer's Guide", 'Configuration chapter; Security chapter, System Settings'],
    ['To-do list', 'Settings; Theme (Inspinia)'],
    ['Original Settings plan, 22 Oct 2026', 'https://claude.ai/artifact/1duFrj6djyVgxZdH8xMJtW'],
  ]},
]},

];
