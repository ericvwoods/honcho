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

{ tab: "How Dues Work (Concept of Operations)", blocks: [
  { type: 'p', text: "As described by the owner on 31 Oct 2026 (BPA's practice, carried over from the legacy system). Other organizations may differ, for example in the due date; the design makes those things settings." },
  { type: 'ul', items: [
    "**Two kinds of dues.** Each chapter decides whether to charge **chapter dues** and how much (possibly none). **National dues** depend on the member's class (member type). Chapters and National each collect their own; chapters don't remit to National, because **National invoices members directly**.",
    "**Annual dues, flexible billing.** Dues are for a year, but members should be able to pay **monthly, quarterly or in one annual payment**.",
    "**Due date.** Dues are due **September 30** for the upcoming year. Another organization may use a different date.",
    "**Statuses** (the member record's Status and Current Year fields): **Current** = both chapter and National dues received. **Pending** = chapter dues paid, National's invoice not yet paid. **Past Due** = not paid by the due date while the grace period is on. **Expired** = not paid and the grace period is off (or has ended).",
    "**Grace period, manual today.** A Financial Admin turns a grace period flag on or off. With it on, an unpaid member goes from Current to **Past Due** on October 1; with it off, straight to **Expired**. The grace period ends when the flag is turned off. A calendar alternative is wanted: due date and grace period end set by dates.",
    "**Legacy flow.** A Chapter Admin changing the member's Current Year meant \"chapter dues received\". That created a dues transaction meaning \"a National invoice must be raised\"; the Financial Admin tracked the invoice, and marking it paid moved the member from Pending to Current.",
    "**Proration.** Only **new Regular members'** dues are prorated, by a factor the Financial Admin can change at any time. A calendar-driven factor (by the month someone joins) multiplied by the dues amount is welcome.",
    "**Who does what.** Chapter dues: the **Chapter Admin** (there is no chapter treasurer role; it may be split out later). National dues: the **Financial Admin**.",
    "**Exceptions.** **Lifetime** and **Honorary** members are always Current. The **Family** membership is being removed. There is no refund or waiver policy today.",
    "**Still to define:** which receipts and reports are needed.",
  ]},
  { type: 'h2', text: 'Clarifications (owner, 31 Oct 2026)' },
  { type: 'ul', items: [
    "**Chapter dues paid is what triggers National's invoice,** so National can't be paid before the chapter.",
    "**Installments:** a member paying monthly or quarterly who is up to date counts as **Current**.",
    "**Family members** become **Regular** if they hold any pilot or mechanic certificate, otherwise **Associate**.",
    "**Proration:** National and each chapter have their **own proration schedule**; each chooses which member types are prorated (BPA National: Regular only). Proration is for **new members only**, never for renewals, even late ones.",
    "**Chapter at Large** (a special chapter): no chapter dues today but may have them later; its dues are **billed by and paid to National**. All member types are available in it unless a Financial Admin switches some off.",
    "**The National invoice** is emailed to the member as soon as their chapter dues are recorded, ideally with a **PayPal link carrying the amount**, to speed payment.",
    "**Year label:** dues due September 30, 2026 are for membership year **2027**.",
  ]},
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
    ['FIN-01', '**Dues amounts:** National dues by member type (as today); **chapter dues** set by each chapter (0 = none), by its Chapter Admin; changes take effect for a chosen membership year.', 'Planned (phase 1)'],
    ['FIN-02', "**Record chapter dues** (a button replacing \"edit Current Year\"): amount, method (cash, check, other), check number or reference, date. Honcho records the payment (in Payments\' payment record, PAY-07), marks the chapter charge paid, **raises the National invoice** and updates Current Year. A chapter with no dues gets **Renew** instead. Changing Current Year by hand still works and runs the same steps.", 'Planned (phase 1)'],
    ['FIN-03', "**Settle National invoices:** the Financial Admin's list of open National invoices by chapter and year; **Mark paid** one at a time or as a batch, with method and reference; the member becomes Current. Replaces MEM-21.", 'Planned (phase 1)'],
    ['FIN-04', '**Dues report** by chapter and membership year: Current, Pending, Past Due and Expired counts and dollars; open National invoices; Excel export.', 'Planned (phase 1)'],
    ['FIN-05', "**Reminders** by email before the due date and while Past Due, on dates the Financial Admin sets; a list of who was reminded.", 'Planned (phase 1)'],
    ['FIN-06', "**Receipts:** every dues payment gets a numbered receipt, emailed and printable. Other receipts and reports to be defined with the owner.", 'Planned (phase 1)'],
    ['FIN-07', "**Member's dues history** on their profile: years, amounts, payments, receipts, open invoices.", 'Planned (phase 1)'],
    ['FIN-08', "**Pay online:** the National invoice email carries a **Pay now** link (PayPal, amount filled in) that marks the invoice paid by itself; and automatic renewal (PAY-10, PAY-11).", 'Planned (with Payments)'],
    ['FIN-09', "The temporary rule that leaves members paid through 2026 at their current status (Member Records) is removed once the new dues records cover everyone.", 'Planned (phase 1, with the data load)'],
  ]},

  { type: 'h2', text: 'Dues: Settings, Charges and Status' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['FIN-20', "**Due date** (month and day; BPA September 30) and the membership year it pays for (paid by Sep 30, 2026 = 2027), as settings, so other organizations can differ.", 'Built 31 Oct 2026 (Mac; engine switched on there, off on staging until the dry-run data load)'],
    ['FIN-21', "**Grace period, two modes:** **Manual** (BPA's flag: on until a Financial Admin turns it off) or **Calendar** (a grace end date). With grace on, an unpaid member becomes Past Due after the due date; with it off or ended, Expired.", 'Built 31 Oct 2026 (Mac; engine switched on there, off on staging until the dry-run data load)'],
    ['FIN-22', "**Two charges per member per membership year:** the **chapter charge** and the **National charge** (the National invoice), each with amount, any proration, balance and billing plan. The existing National dues records are carried over.", 'Planned (phase 1)'],
    ['FIN-23', "**Status calculated automatically every night** and after every dues change, so the due date and a calendar grace end take effect by themselves: **Current** (both paid, or chapter dues are 0 and National paid), **Pending** (chapter paid, National not), **Past Due**, **Expired**. Lifetime and Honorary are always Current.", 'Built 31 Oct 2026 (Mac; engine switched on there, off on staging until the dry-run data load)'],
    ['FIN-24', "**Proration schedules:** National and each chapter have their own schedule (a factor by join month) and choose which member types it applies to. **New members only**, never renewals.", 'Planned (phase 1)'],
    ['FIN-25', "**Chapter at Large:** its chapter dues (none today) are billed by and paid to **National**, so the Financial Admin records them; every member type is available in it unless a Financial Admin switches some off.", 'Planned (phase 1)'],
    ['FIN-26', "**Billing plans:** annual, quarterly or monthly; a quarterly or monthly plan splits a charge into dated installments, and a member whose installments are up to date counts as paid. Recorded by hand in phase 1; charged automatically with Payments.", 'Planned (phase 1; automatic with Payments)'],
    ['FIN-27', "**Corrections:** **Void** (a mistake) and **Waive** (with a reason), Financial Admins only, logged, though BPA has no refund or waiver policy today.", 'Planned (phase 1)'],
    ['FIN-28', "**Permissions** as separate functions: record chapter dues (Chapter Admins), settle National invoices and dues settings (Financial Admins), so a chapter treasurer role can be added later as a group with no code change.", 'Planned (phase 1)'],
    ['FIN-29', "**Retire the Family member type:** Family members become **Regular** if they hold a pilot or mechanic certificate (Sport, Recreational, Private, Commercial, ATP, A&P, Drone Pilot or Military, including the military pilot tick; not Student or Grandfathered), otherwise **Associate**; then the type is switched off. On the test data all 34 became Associate.", 'Built 31 Oct 2026 (Mac; migration `2026-10-31-dues-step1-foundations.sql`)'],
    ['FIN-30', "**Chapter Admin bulk actions** on the chapter members list: tick members and run **Record chapter dues paid** (one amount, method, date and reference applied to each; or **Renew** where there are no chapter dues), **Delete** and **Undelete**. Each member gets the same steps as one at a time (payment record, National invoice, status).", 'Planned (dues step 3; owner, 31 Oct 2026)'],
    ['FIN-31', "**Financial Admin bulk National dues paid:** tick members (or open invoices) and mark their National dues paid at once, with method, date and reference, for members who paid another way than the invoice.", 'Planned (dues step 4; owner, 31 Oct 2026)'],
    ['FIN-32', "**Backing out chapter dues** (unpaid, a bounced check, a mistake): the Chapter Admin chooses **Reverse chapter dues** with a reason, or changes Current Year back. The chapter payment is marked reversed, the chapter charge reopens and status is recalculated. If the National invoice is **unpaid**, it is voided (\"chapter dues reversed\") so National doesn't expect the money, and the member is told the invoice is withdrawn. If it is **already paid**, nothing is undone automatically: it goes on the Financial Admin's **Needs attention** list and they're emailed to decide. Every reversal is in the Auditlog.", 'Planned (dues steps 3-4; owner, 31 Oct 2026)'],
    ['FIN-33', "**Reversing a National payment** (a bounced check or a mistake): the Financial Admin reverses it with a reason; the invoice reopens and status is recalculated.", 'Planned (dues step 4)'],
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
    ['31 Oct 2026', 'Concept of operations and clarifications recorded above; design FIN-20 to FIN-29 drafted for approval.'],
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
