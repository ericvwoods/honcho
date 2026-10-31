// chapters/library.js — Honcho Requirements: Document Library (requirement prefix DOC).
// Written 2026-10-30 as built, from modules/dms/dmslibrary (Dmslibrary.php, manage, librarykanban, documentcrud),
// the DMS chapter of the Developer's Guide (Architecture, Kanban & Tagging, Known Issues), the Member and
// Administrator's Guides, System Settings (DMS tab) and the to-do list. Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Stores the organization's documents (policies, minutes, forms and more), finds them through labels and filters, and takes new documents through review and approval on a kanban board. Members read and download what they're allowed to see; admins add documents and move them to approval." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members**', 'Find, preview and download approved documents at or below their access level'],
    ['**Chapter Admins**', "Manage their own chapter's documents: add, edit, move on the board, approve, hide, delete, comment"],
    ['**Document admins** (member System Admins, staff DMS Admins)', 'Manage every document'],
  ]},
  { type: 'p', text: "**Module:** Core (DMS). Its board and three-label design were later reused for Projects. **To-do section:** DMS." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'Documents' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['DOC-01', 'A document is a record (title, subject, short and full description, author, access level, priority, chapter, region, department, dates) with or without an uploaded file. "Record only" is for a paper document or a note.', 'Built (before Oct 2026)'],
    ['DOC-02', 'Files are kept where the web server can\'t hand them out directly; preview and download happen only after the permission check.', 'Built (before Oct 2026)'],
    ['DOC-03', 'Uploading a file with the same name as an existing one keeps the old file as a backup instead of overwriting it.', 'Built (before Oct 2026)'],
    ['DOC-04', 'Uploading a file to a new document works.', 'Built; fixed 18 Oct 2026 (every upload had failed)'],
    ['DOC-05', 'Replacing the file on a document that already has one.', '**Not working:** unfinished code stops with "already associated … File not replaced"'],
  ]},

  { type: 'h2', text: 'Finding Documents' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['DOC-06', 'Every document carries one value from each of **three labels**. Each organization names the labels (BPA: Organization, Category, Type) on System Settings and loads its own values.', 'Built (before Oct 2026); names as settings 22 Oct 2026'],
    ['DOC-07', 'The list filters by the three labels, chapter, file format, region, lead, access level, staff member, member and department, and shows the active filters.', 'Built (before Oct 2026); filters made injection-safe 6 Oct 2026'],
    ['DOC-08', 'Members see approved documents at or below their **access level** (Public up through levels such as Leaders, Staff, Board, CEO).', 'Built (before Oct 2026)'],
    ['DOC-09', 'The back button says **Home** for someone who came from the member home and **Dashboard** for someone who came from the admin menu, and goes there.', 'Built 29 Oct 2026'],
  ]},

  { type: 'h2', text: 'Review and Approval' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['DOC-10', 'A **kanban board** with six columns: Unrefined, Backlog, In Progress, In Review, Pending Approval, Approved. The first and last can be hidden, and every column title is a setting.', 'Built (before Oct 2026); titles and switches as settings 22 Oct 2026'],
    ['DOC-11', 'Each card has buttons to move it to another column, open it and comment on it. Every move is recorded in the Auditlog. **Done** takes an approved document off the board.', 'Built (before Oct 2026)'],
    ['DOC-12', 'Comments on a document; a comment can be closed when dealt with, deleted and restored.', 'Built (before Oct 2026)'],
    ['DOC-13', 'A document can be put **on hold** or marked **blocked** with a reason shown on the card; an approver can **reject** it with a reason or **approve** it, which clears any hold, block or rejection.', 'Built (before Oct 2026)'],
    ['DOC-14', 'Moving a card into the Approved column from the board.', '**Not working:** fails with a database error (the column\'s title is saved where a number belongs). Approving from the document works'],
    ['DOC-15', 'Two settings, "edit moves a document to In Progress" and "to Backlog", exist but nothing uses them yet.', 'Planned (not built)'],
  ]},

  { type: 'h2', text: 'Access' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['DOC-16', 'Every action asks Security Groups, from either login (member or staff).', 'Built 18 Oct 2026'],
    ['DOC-17', 'Chapter Admins have every library function, limited to their own chapter\'s documents; anything they add is saved to their chapter.', 'Built 18 Oct 2026'],
    ['DOC-18', 'Someone who isn\'t signed in is sent to the login page.', 'Built 18 Oct 2026'],
  ]},

  { type: 'h2', text: 'Planned' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['DOC-19', 'Other modules file uploads into the library behind the scenes, under a fixed place (for example Receipts, by asset and year) with access limited to the right people: expense receipts first, maintenance paperwork later.', 'Planned (Financial add-on, FIN-16; decided 30 Oct 2026)'],
    ['DOC-20', 'The Coffee Report lists documents waiting for approval.', 'Built 29 Oct 2026 (Coffee Report section)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Setting up the library for a new organization** is mostly renaming the three labels and the board's column titles in System Settings, then loading the organization's own label values.",
    "**Any value from a page that goes into a database query is checked as a number first** (the rule adopted after the 6 Oct 2026 fix).",
    "The library works out each person's role on the server, never from the page address.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "DOC-05 (replacing a file) and DOC-14 (moving to Approved on the board).",
    "Board moves write an empty title into the Auditlog.",
    "Opening the library's address with no page named shows a \"Contact System Admin\" message; the real entry points are the list and the board.",
    "The manage-page filters should be re-tested while signed in since the 6 Oct fix.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['16 Oct 2026', 'The Document Library is the only library; the older member library was removed.'],
    ['18 Oct 2026', 'The library uses Security Groups; Chapter Admins get every function for their own chapter (DOC-16, DOC-17).'],
    ['30 Oct 2026', 'Expense receipts are filed in the library behind the scenes (DOC-19).'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['Member Guide', 'Chapter 3, Document Library'],
    ["Administrator's Guide", 'Chapter 5, Document Library'],
    ["Developer's Guide", 'DMS chapter'],
    ['To-do list', 'DMS'],
  ]},
]},

];
