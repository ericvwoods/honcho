// chapters/getting-started.js — Honcho Administrator's Guide (created 2026-10-29 from the
// Users' Guide's role table and side-menu section). Same block format as docs/developer-guide.

module.exports = [

{ tab: "Who This Guide Is For", blocks: [
  { type: 'p', text: "Honcho is the system Black Pilots of America (BPA) uses to run its membership. This guide is for the people who run it: Chapter, Member, Student, Content, Event, Financial and System Admins, and staff. Everything every member does (logging in, your own profile and card, rosters, the directory, finding documents) is in the **Honcho Member Guide**." },
  { type: 'p', text: "Honcho can be set up with different words for different organizations. In BPA's system a person is a **Member** and a local group is a **Chapter**, so that's what this guide says." },
  { type: 'h2', text: 'Your Role Decides What You See' },
  { type: 'p', text: 'Admin roles add menus and pages. Use the chapters that match your roles.' },
  { type: 'table', headers: ['Role', 'Who has it', 'What it adds', 'See chapter'], rows: [
    ['**Chapter Admin**', 'Members chosen to run a chapter', "Your chapter's members, posts, events, documents, exports, and your chapter's own AI and Coffee Report", '2, 7'],
    ['**Member Admin**', 'National membership officers', 'All members, statuses, bulk changes, master spreadsheet', '3'],
    ['**Student Admin**', 'Members who manage student programs', 'Student member lists', '2, 3'],
    ['**Content Admin**', 'Members who manage the home page and website', 'Page sections, pictures, Sunshine, Bulletin Board, Marquee, Careers', '4'],
    ['**Event Admin**', 'Members who manage the events calendar', "Every event on the calendar (Chapter Admins add their own chapter's)", '4'],
    ['**Document Library admin**', 'Members and staff given library rights', 'Add, review and approve documents on the kanban board', '5'],
    ['**Financial Admin**', 'The Treasurer, and anyone else they choose', 'Financial Settings: the current membership year, grace period, dues payment year, new-member dues', '6'],
    ['**System Admin**', 'A few trusted people', "System Settings, Security Groups, member permissions, chapters, the audit log, and National's AI and Coffee Report", '6, 7'],
    ['**Projects user or admin**', 'Staff and members on project teams (add-on)', 'Teams and projects', '8'],
    ['**Staff**', 'Employees using the separate staff login', 'The Honcho staff portal', '9'],
  ]},
  { type: 'alert', variant: 'info', text: "Roles are given on a member's record (Roles & Permissions) by a Member Admin or System Admin, or on the Security Groups screen. Someone sees new menus the next time they log in." },
]},

{ tab: "The EMS Menu", blocks: [
  { type: 'p', text: "Admins reach their pages through **EMS** on the member home's side menu (the name is set on System Settings > Organization). It opens the admin side menu, with a section per role: Member Admin, Chapter Admin, Website, PMS, System Admin and Reports. Click a section to open its pages." },
  { type: 'ul', items: [
    "**Expand/Hide** at the top shrinks the menu to icons to give the page more room; click the arrows again to open it.",
    "**Member Home** goes back to the member home page.",
    "Pages have a **Close** button that returns to where you came from.",
  ]},
]},

];
