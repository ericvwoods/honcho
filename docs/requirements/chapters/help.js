// chapters/help.js — Honcho Requirements: Help and Guides (requirement prefix HELP).
// Written 2026-10-30 as built, from modules/help/Help.php (_allowed, _is_admin, _is_developer, guide, search),
// docs/export-web.js and the three guides' generate.js. Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Gives everyone the instructions for what they can do, inside Honcho and as downloadable Word documents, from one source so the two never disagree. Three guides: the **Member Guide** (what every member does), the **Administrator's Guide** (admin screens and step-by-step setup) and the **Developer's Guide** (code, servers, conventions)." },
  { type: 'p', text: "**Module:** Core (Help). **To-do section:** Developer's Guide." },
]},

{ tab: "Requirements", blocks: [
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['HELP-01', 'Three guides, each a Word document and the same text as web pages in Honcho, made from the same chapter files.', 'Built 29 Oct 2026'],
    ['HELP-02', 'Who reads which: the Member Guide for every signed-in person; the Administrator\'s Guide for anyone with an admin role and for staff; the Developer\'s Guide for System Admins (member or staff).', 'Built 29 Oct 2026'],
    ['HELP-03', '**Help** in the top bar of member pages and in the member side menu opens the guides a person may read.', 'Built 29 Oct 2026'],
    ['HELP-04', 'Each chapter shows its contents on the left with links to each section, and links to the previous and next chapter.', 'Built 29 Oct 2026'],
    ['HELP-05', 'Search across the guides a person may read.', 'Built 29 Oct 2026'],
    ['HELP-06', 'Help text follows the member\'s chosen text size.', 'Built 29 Oct 2026'],
    ['HELP-07', 'Admin screens link straight to the section that explains them (for example the AI connection and Coffee Report settings pages).', 'Built 29 Oct 2026 (more screens as they are worked on)'],
    ['HELP-08', 'Close returns to the page the person came from.', '**Not built:** Close goes to the home page (breaks the Close rule; small fix)'],
    ['HELP-09', 'When a feature changes, its guide chapters and these requirements are updated in the same piece of work, and the guides rebuilt.', 'Built (working rule since Oct 2026)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "Guide text is never edited in Honcho itself: it is changed in the chapter files and rebuilt, so the Word and web versions always match.",
    "This requirements book is **not** a Help page: it holds pricing and business plans and stays private.",
    "Guides use the organization's words (Member, Chapter) as BPA has them; another organization's guides would be rebuilt with its words.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [ "Close goes to the home page instead of back to where the person came from (HELP-08)." ] },
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['29 Oct 2026', 'Split the guides into Member, Administrator\'s and Developer\'s, and put all three in Honcho as Help pages.'],
    ['30 Oct 2026', 'This requirements book joins them as a fourth, private document; user stories will live in the Projects module.'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ["Developer's Guide", 'Conventions chapter (keeping the guides updated)'],
    ['Guide sources', '`docs/member-guide`, `docs/admin-guide`, `docs/developer-guide`'],
  ]},
]},

];
