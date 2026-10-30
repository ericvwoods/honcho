// chapters/overview.js — Honcho Planning Book, chapter 1 (written 2026-10-30).
// The index of every plan: status, where its online copy and to-do items are, and the agreed order of work.
// Keep the "Plans at a Glance" table in step with guide.js and each plan's status note.

module.exports = [

{ tab: "How to Use This Book", blocks: [
  { type: 'p', text: "This book gathers every Honcho plan in one place. Each plan is a chapter that opens with its **status**: what's decided, what's built and what's next. The last part is the **project to-do list**, rebuilt from `docs/todo.md` every time the book is made, so it is always current on the day of the date on the title page." },
  { type: 'p', text: "The book is the master copy of the plans. When a plan changes, its chapter is updated and the book rebuilt (`node generate.js` in `docs/plans`), and the new `Honcho_Planning_Book.docx` is copied to Downloads. The online plan pages still work, but may fall behind this book." },
  { type: 'alert', variant: 'warning', text: "**Private:** this book holds pricing and business plans. It lives in `docs/plans`, which is never deployed to a server, and is not one of the Help pages. Share it only on purpose." },
]},

{ tab: "Plans at a Glance", blocks: [
  { type: 'table', headers: ['Chapter', 'Plan', 'Status (30 Oct 2026)', 'To-do section'], rows: [
    ['2', '**Pricing and AI Billing**', 'Options written; decisions not yet made', 'Core product and client configurations'],
    ['3', '**Honcho AI Assistant**', 'Phases 0 and 1 (AI connections, Daily Coffee Report) built on the Mac, not deployed; tier plan awaiting sign-off', 'Daily Coffee Report and AI connections'],
    ['4', '**Digital Membership Cards**', 'Decisions made 26 Oct; phase 1 (My Card) built; door check-in and Google Wallet next', 'Digital membership cards'],
    ['5', '**Payments, Financial and Store**', 'Decisions made 30 Oct; nothing built; F0 (payment base) is next', 'Payments, Financial and Store'],
    ['6', '**Scheduler**', 'Decisions made 30 Oct; nothing built; starts after the money work', 'Scheduler'],
    ['7', '**Project To-Do List**', 'Everything else: security, logins, RBAC, Settings, CMS, legacy data load, Participants, Reporting module and more', 'All'],
  ]},
  { type: 'p', text: "Plans that were carried out step by step in the to-do list rather than written as separate pages (RBAC, Settings, the Website, the theme, the legacy data load) are in Chapter 7." },
]},

{ tab: "Order of Work", blocks: [
  { type: 'p', text: "What has been agreed so far, in order:" },
  { type: 'ol', items: [
    "**Deploy what's waiting** to staging (everything since the last deploy: AI phases 0 and 1, Help pages, guides, side menu and library fixes), with its migrations and settings. Always asked first.",
    "**Money first** (decided 30 Oct): payment base, dues online and automatic renewal (Core), then the National store.",
    "**Invoicing, accounts and expenses** (Financial add-on), built alongside the **Scheduler**'s first phases, which need it for flight-time invoices.",
    "**Chapters' own accounts and stores**, then the Scheduler's maintenance and cost-sharing phases, then **Point of Sale** last.",
  ]},
  { type: 'p', text: "Still to be placed in the order: member cards phases 2 to 4, AI phases 2 to 5, the Participants (Student) module, the Event Module, the Reporting module (requirements first) and the legacy data load, which must happen before user acceptance testing and again before go-live." },
]},

{ tab: "Where Things Live", blocks: [
  { type: 'table', headers: ['What', 'Where'], rows: [
    ['This book', '`docs/plans/Honcho_Planning_Book.docx` (and a copy in Downloads)'],
    ['Plan chapters (master copies)', '`docs/plans/chapters/*.js`'],
    ['Project to-do list', '`docs/todo.md`'],
    ['Dev Board (cards by column)', 'https://claude.ai/artifact/TV9y61yxM6pVW1bKmbizym'],
    ['Online plan pages', 'Listed at the top of each plan chapter'],
    ["Member, Administrator's and Developer's Guides", '`docs/member-guide`, `docs/admin-guide`, `docs/developer-guide`, and Help in Honcho'],
    ['Code walkthroughs', '`docs/code-walkthrough-list.md`'],
  ]},
]},

];
