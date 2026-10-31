// chapters/overview.js — Honcho Requirements, chapter 1 (written 2026-10-30).
// The index of every plan: status, where its online copy and to-do items are, and the agreed order of work.
// Keep the "Plans at a Glance" table in step with guide.js and each plan's status note.

module.exports = [

{ tab: "How to Use This Book", blocks: [
  { type: 'p', text: "This book says what Honcho does and what it will do, feature by feature: Honcho's high-level requirements. The **user stories** with acceptance criteria will live in the Project Management module and name the requirement they deliver; **how to use** each feature is in the Member and Administrator's Guides; **how it works inside** is in the Developer's Guide." },
  { type: 'p', text: "Each feature chapter has the same shape: **Purpose** (what and who for), **Requirements** (numbered, such as CARD-08), **Business Rules**, **Known Problems**, **Decisions** (dated) and **Related Documents**. Requirement numbers never change or get reused, so user stories and test results can always point to them." },
  { type: 'table', headers: ['Status', 'Means'], rows: [
    ['**Built**', 'Working, with the date it was built ("before Oct 2026" = part of the original system). Deployed to staging unless the chapter says otherwise'],
    ['**In progress**', 'Built but not working yet (for example, waiting on an outside account)'],
    ['**Planned**', 'Agreed, not built'],
    ['**Changed**', 'Built differently from the plan, with the reason'],
    ['**Not working** / **Not built**', 'Exists but broken, or expected but missing'],
  ]},
  { type: 'p', text: "Every Core chapter and the AI chapter were checked against the code on 30 Oct 2026, not copied from the plans. The last part is the **project to-do list**, rebuilt from `docs/todo.md` every time the book is made. The book is the master copy: when a feature changes, its chapter is updated and the book rebuilt (`node generate.js` in `docs/requirements`), and the new `Honcho_Requirements.docx` is copied to Downloads." },
  { type: 'alert', variant: 'warning', text: "**Private:** this book holds pricing and business plans. It lives in `docs/requirements`, which is never deployed to a server, and is not one of the Help pages. Share it only on purpose." },
]},

{ tab: "Chapters at a Glance", blocks: [
  { type: 'table', headers: ['Ch.', 'Feature', 'Prefix', 'Where it stands (30 Oct 2026)'], rows: [
    ['2', '**Signing In and Accounts**', 'LOGIN', 'Built; Forgot password broken (rebuild planned); real two-step codes and "view as a member" planned'],
    ['3', '**Permissions and Security Groups**', 'PERM', 'Built and used by Projects, the Library, the Website, Settings and AI; older member-record checks still to convert'],
    ['4', '**Member Records**', 'MEM', 'Built; recording dues received by National not built, so renewals stay Pending; Student module and voter rules planned'],
    ['5', '**Digital Membership Cards**', 'CARD', 'Card built; Google Wallet waiting on Google; door check-in next'],
    ['6', '**System Settings and Branding**', 'SET', 'Built; colors still typed into screens move to the scheme gradually'],
    ['7', '**Document Library**', 'DOC', 'Built; replacing a file and moving to Approved on the board are broken'],
    ['8', '**Member Home and Website**', 'WEB', 'Built; public website ready but off for BPA; Event Module planned'],
    ['9', '**Help and Guides**', 'HELP', 'Built'],
    ['10', '**Honcho AI and the Coffee Report**', 'AI', 'Connections and Coffee Report built and on staging (daily report running); alerts, connector, chat and changes planned; two-tier split awaiting sign-off'],
    ['11', '**Financial**', 'FIN', 'Decided 31 Oct: what is owed. Dues (Core) are the next build; invoicing and accounts are an add-on'],
    ['12', '**Payments**', 'PAY', 'Decided 31 Oct: how money moves, every gateway (PayPal first). Core; built after Dues'],
    ['13', '**Store**', 'STORE', 'Decided 30 Oct; add-on; after Project Management is finished'],
    ['14', '**Scheduler**', 'SCHED', 'Decided 30 Oct; nothing built; still in plan form'],
    ['15', '**Pricing and AI Billing**', 'PRICE', 'Options written; decisions not made; plan form'],
    ['16', '**Project To-Do List**', '', 'Everything else, from `docs/todo.md`'],
  ]},
  { type: 'p', text: "**Still to add:** Projects (the PMS add-on: teams and projects built; to be finished after Payments), the staff back office (Honcho), the phone app, and later the Event Module, Participants (Student), Reporting and Emulation chapters as they are planned." },
]},

{ tab: "Order of Work", blocks: [
  { type: 'p', text: "Agreed so far (owner, 30-31 Oct 2026), in order:" },
  { type: 'ol', items: [
    "**Dues** (Financial, Core): dues types, recording cash and check payments, National recording dues received, dues report, reminders, receipts (FIN-01 to FIN-07).",
    "**Payments** (Core): the PayPal connection, payment records and refunds, paying dues online, then automatic renewal (PAY-01 to PAY-11).",
    "**Finish Project Management**: stories with acceptance criteria, tasks and the kanban board, and the system project that holds the user stories for these requirements (Projects chapter to be written).",
    "**Store** (add-on), National first (STORE-01 to STORE-05).",
    "**Invoicing, accounts and expenses** (Financial add-on), with the **Scheduler**'s first phases, which need it for flight-time invoices.",
    "**Chapters' own payment accounts and stores**, the Scheduler's maintenance and cost-sharing phases, then **Point of Sale** last.",
  ]},
  { type: 'p', text: "Still to be placed: member cards phases 2 to 4, AI phases 2 to 5, the Participants (Student) module, the Event Module, the Reporting module (requirements first) and the legacy data load, which must happen before user acceptance testing and again before go-live." },
]},

{ tab: "Where Things Live", blocks: [
  { type: 'table', headers: ['What', 'Where'], rows: [
    ['This book', '`docs/requirements/Honcho_Requirements.docx` (and a copy in Downloads)'],
    ['Chapters (master copies)', '`docs/requirements/chapters/*.js`'],
    ['Project to-do list', '`docs/todo.md`'],
    ['Dev Board (cards by column)', 'https://claude.ai/artifact/TV9y61yxM6pVW1bKmbizym'],
    ['Online plan pages', 'Listed at the top of each plan chapter'],
    ["Member, Administrator's and Developer's Guides", '`docs/member-guide`, `docs/admin-guide`, `docs/developer-guide`, and Help in Honcho'],
    ['Code walkthroughs', '`docs/code-walkthrough-list.md`'],
  ]},
]},

];
