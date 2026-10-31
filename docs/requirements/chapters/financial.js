// chapters/financial.js — Honcho Requirements: Financial (requirement prefix FIN).
// Written 2026-10-31 from the Financial and Store plan (2026-10-30, https://claude.ai/artifact/LYApDeBVM3JrM3szqaSAuR)
// and the owner's decisions of 30-31 Oct: Financial = what is owed (dues, invoices, accounts, expenses);
// Payments = how money moves (chapter payments.js); Dues first, then Payments. Nothing built yet, except the
// National dues record that renewals already create (Member Records, MEM-20). Requirement numbers never change.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Keeps track of **what is owed, by whom, and why**: membership dues first, then invoices, account balances, statements and expenses for flight schools, clubs and partnerships. Money itself is taken and recorded by the **Payments** module; Financial asks Payments to collect an amount and is told when it's paid." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members**', 'See what they owe and their dues history; get receipts'],
    ['**Chapter Admins**', "Renew their chapter's members and record dues they collected"],
    ['**Financial Admins**, National treasurer', 'Record dues received by National, see who has paid, send reminders, run reports'],
    ['**Flight schools, clubs, partnerships** (add-on)', 'Invoice customers, keep balances, send statements, record expenses'],
  ]},
  { type: 'p', text: "**Module:** dues are **Core** (every member organization collects dues); invoicing, accounts, statements, expenses and Point of Sale are the **Financial add-on**, switched on per client. **To-do section:** Payments, Financial and Store." },
]},

{ tab: "What Exists Today", blocks: [
  { type: 'ul', items: [
    "Renewing a member (Current Year set to the open dues payment year) creates a **National dues record** in `ccmps_financial_transactions`: the member type's National dues, prorated for a brand-new Regular member, owed until National records it (MEM-20).",
    "Member status reads that record: **Current** only when National has received the dues in full; **Pending** until then (MEM-18).",
    "Nothing yet lets National record dues received (MEM-21), so renewed members would stay Pending.",
    "Member types carry their National dues amounts (R $60, A $35, Q $10, S $10, F $10, H $0); the Financial tab of System Settings holds the membership year, open dues payment year, grace period and proration; a Financial Admins group exists.",
    "`honcho_financial` (staff-side accounts with a balance) and `ccmps.paypal_txn_id` (legacy PayPal) are left from the original system.",
  ]},
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'Dues (Core, first)' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['FIN-01', '**Dues types and amounts** per member type, with National dues (as today) and optionally chapter dues collected together; amounts changed by Financial Admins, effective for a chosen dues year.', 'Planned (phase 1)'],
    ['FIN-02', "**Record a dues payment** taken by cash, check or other means: who paid, amount, method, check number or reference, date, who recorded it. Chapter Admins for their chapter's members; Financial Admins for anyone. The payment goes into the Payments module's payment record (PAY-07), so all money is in one place.", 'Planned (phase 1)'],
    ['FIN-03', '**National records dues received** (from a chapter or a member): one at a time or by a batch for a chapter remittance, which clears the dues record and makes the member Current. Replaces MEM-21.', 'Planned (phase 1)'],
    ['FIN-04', "**Dues report:** by chapter and year: paid, pending National's receipt, past due, expired; totals collected; exports to Excel.", 'Planned (phase 1)'],
    ['FIN-05', '**Reminders:** emails to members whose dues are coming due or past due, at times the Financial Admins choose; a list of who was reminded.', 'Planned (phase 1)'],
    ['FIN-06', "**Receipts:** every dues payment gets a numbered receipt, emailed to the member and kept on their record (printable).", 'Planned (phase 1)'],
    ['FIN-07', "**Member's dues history** on their profile: years paid, amounts, receipts.", 'Planned (phase 1)'],
    ['FIN-08', 'Paying dues **online**, and **automatic renewal**, through the Payments module (PAY-10, PAY-11).', 'Planned (with Payments)'],
    ['FIN-09', "The temporary rule that leaves members paid through 2026 at their current status (Member Records) is removed after one full renewal cycle on Honcho.", 'Planned (after the 2027 cycle)'],
  ]},

  { type: 'h2', text: 'Invoicing and Accounts (add-on)' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['FIN-10', '**Price list:** services, rentals, products and fees, each with a price, tax setting and income category for the accounting export.', 'Planned'],
    ['FIN-11', '**Accounts:** one per paying person (a member, or a staff-side customer such as a flight-school student) with a running balance; **Add Funds** is a prepayment into it.', 'Planned'],
    ['FIN-12', '**Invoices:** numbered, with lines, due date and status (draft, open, paid, void); paid by card on file, prepaid balance or a link in the invoice email (through Payments).', 'Planned'],
    ['FIN-13', '**From the Scheduler:** each check-in turns aircraft hours, instructor time and fuel credit into invoice lines.', 'Planned (with Scheduler phase 3)'],
    ['FIN-14', "**Monthly statements** combining club dues, flight time and partnership cost shares; the Scheduler's cost-sharing statements become invoices here.", 'Planned'],
    ['FIN-15', '**Overdue rule:** an account past due can be blocked from new bookings (a switch).', 'Planned'],
    ['FIN-16', '**Expenses** (parts, supplies, fuel, insurance, hangar, maintenance) with the receipt uploaded on the same screen and filed in the Document Library under Receipts, by asset and year, with limited access (DOC-19).', 'Planned'],
    ['FIN-17', '**Documents:** receipts, invoices and statements as PDF from a template with the organization\'s logo and colors.', 'Planned'],
    ['FIN-18', '**Reports and export:** income by period and category, outstanding balances, expenses by asset, and an export for accounting software (for example a QuickBooks CSV).', 'Planned'],
    ['FIN-19', '**Store orders** are recorded here as invoices paid at once, so all income shows in one set of reports (Store chapter).', 'Planned (with the Store)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Financial decides what is owed; Payments moves the money.** Financial never talks to a payment provider.",
    "**Status follows money:** a member is Current when their year's dues are received in full; Financial's records drive the existing status check.",
    "Lifetime members (year 2099) owe no dues.",
    "Every change to an amount, a payment or a receipt is recorded in the Auditlog with who did it.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['30 Oct 2026', 'Dues collection is Core; invoicing, accounts, expenses and Point of Sale are the Financial add-on; money work comes before the Scheduler.'],
    ['30 Oct 2026', 'Expense receipts are filed in the Document Library behind the scenes.'],
    ['31 Oct 2026', 'Financial (what is owed) and Payments (how money moves) are separate modules.'],
    ['31 Oct 2026', '**Dues first**, then Payments.'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['This book', 'Member Records (MEM-18 to MEM-22), Payments, Store, Scheduler'],
    ['To-do list', 'Payments, Financial and Store'],
    ['Original plan, 30 Oct 2026', 'https://claude.ai/artifact/LYApDeBVM3JrM3szqaSAuR'],
  ]},
]},

];
