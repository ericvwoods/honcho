// chapters/store.js — Honcho Requirements: Store (requirement prefix STORE).
// Written 2026-10-31 from the Financial and Store plan (2026-10-30) and the owner's decisions. Nothing built yet.
// Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Sells branded merchandise (hats, T-shirts and the like with the logo) to members and, optionally, the public: products, cart, checkout, orders, shipping or pickup, and a receipt for every order. Payment goes through the Payments module; each order is recorded in Financial." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members and the public**', 'Buy, pay, get a receipt, see their orders'],
    ['**Store Admins**', 'Manage products and stock, work through orders, print packing slips'],
    ['**Chapter Admins** (later)', "Run their chapter's own store"],
  ]},
  { type: 'p', text: "**Module:** add-on. **To-do section:** Payments, Financial and Store." },
]},

{ tab: "Requirements", blocks: [
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['STORE-01', '**Products:** name, description, photos, price, and options such as size and color, each combination with its own stock count and a sold-out state; optional members-only prices.', 'Planned (National store)'],
    ['STORE-02', 'A **Store** page on the member portal and, optionally, the public website.', 'Planned (National store)'],
    ['STORE-03', '**Cart and checkout** through Payments, collecting the shipping address; sales tax at rates entered in Honcho; flat-rate shipping or pickup.', 'Planned (National store)'],
    ['STORE-04', '**Orders:** paid, packed, shipped (with a tracking number), picked up, refunded; confirmation and shipped emails; receipt in the buyer\'s account. Each order is an invoice paid at once in Financial (FIN-19).', 'Planned (National store)'],
    ['STORE-05', 'A **Store Admins** security group.', 'Planned (National store)'],
    ['STORE-06', "**Chapter stores:** a chapter sells its own chapter-logo merchandise, paid into its own account (PAY-06), run by its Chapter Admins.", 'Planned (later)'],
    ['STORE-07', 'Shipping by weight, pickup at events, store reports.', 'Planned (later)'],
    ['STORE-08', '**Print on demand** (Printful or Printify): each order printed and shipped by the printer, no stock held.', 'Planned (later)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "Merchandise the organization stocks itself comes first; print on demand later.",
    "Sales tax uses rates entered in Honcho.",
    "All money goes through Payments and is recorded in Financial.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['30 Oct 2026', 'The Store is an add-on; National store first, chapter stores later; stocked merchandise first; entered tax rates.'],
    ['31 Oct 2026', 'Orders go through Financial (as invoices paid at once) and Payments.'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['This book', 'Financial (FIN-19), Payments (PAY-06)'],
    ['To-do list', 'Payments, Financial and Store'],
  ]},
]},

];
