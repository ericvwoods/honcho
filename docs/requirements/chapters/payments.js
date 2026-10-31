// chapters/payments.js — Honcho Requirements: Payments (requirement prefix PAY).
// Written 2026-10-31 from the Financial and Store plan (2026-10-30) and the owner's decisions of 30-31 Oct:
// Payments = how money moves (gateways, payment records, refunds, webhooks, Point of Sale), separate from
// Financial (what is owed). PayPal first; others only when a client needs them. Nothing built yet.
// Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Moves the money for every part of Honcho. Financial (dues, invoices), the Store, and later Events and the Scheduler ask Payments to **collect an amount** for something; Payments takes it through a payment gateway (PayPal first) or records cash and checks, and tells them when it's paid or refunded. No other module talks to a payment provider." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members and customers**', 'Pay online; save a card; switch automatic renewal on or off'],
    ['**System Admins** (National) and **Chapter Admins** (their chapter, later)', "Connect their organization's payment account"],
    ['**Financial Admins**', 'See every payment, refund one, match payments with the gateway'],
    ['**Counter staff** (later)', 'Take payments in person'],
  ]},
  { type: 'p', text: "**Module:** **Core** (needed to collect dues). **To-do section:** Payments, Financial and Store." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'Gateways' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PAY-01', '**Gateway connections by scope:** National\'s, and later each chapter\'s own, like AI connections: provider, sandbox (test) or live, keys stored encrypted and never shown again, on/off, **Test connection**.', 'Planned (phase 2)'],
    ['PAY-02', '**PayPal first:** Checkout (pay with a PayPal account or a card without one), Subscriptions (automatic renewal), Vault (saved cards). Called through PayPal\'s REST API, since PayPal has no official PHP library for subscriptions.', 'Planned (phase 2)'],
    ['PAY-03', 'One internal interface for every provider, so Stripe or Square can be added later without changing any screen. Only PayPal is built until a client needs another.', 'Planned (phase 2)'],
    ['PAY-04', "**Payment confirmation by webhook:** the gateway's signed notice is what marks something paid, so a closed browser tab can't lose a payment; every notice is kept and processed once.", 'Planned (phase 2)'],
    ['PAY-05', 'Card numbers never touch Honcho: they stay with the provider (its own payment page or fields).', 'Planned (rule)'],
    ['PAY-06', '**Chapters\' own accounts:** a chapter connects its own PayPal, and money for its events, chapter dues and chapter store goes straight to it.', 'Planned (later phase)'],
  ]},

  { type: 'h2', text: 'Payment Records' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PAY-07', '**One payment record for every method:** card or PayPal online, saved card, prepaid balance, cash, check, other. Each records amount, method, reference (gateway id or check number), what it was for (a dues year, an invoice, an order), who paid, who recorded it and when.', 'Planned (cash and check in phase 1 with Dues; online methods in phase 2)'],
    ['PAY-08', '**Refunds**, full or partial, through the gateway or recorded for cash and check; the module it was for is told.', 'Planned (phase 2)'],
    ['PAY-09', '**Matching with the gateway:** a list of the gateway\'s payments against Honcho\'s, flagging any that don\'t match.', 'Planned (phase 2)'],
  ]},

  { type: 'h2', text: 'What Payments Makes Possible' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['PAY-10', '**Pay dues online** from the member home, with the receipt and status update (Financial, FIN-08).', 'Planned (phase 2)'],
    ['PAY-11', '**Automatic renewal** of dues (yearly, or monthly for flying clubs) through PayPal Subscriptions, with reminders before each renewal, retries and an email when a payment fails, and the grace period. First check in PayPal\'s sandbox: card-only subscribers without a PayPal account; how a change in the dues amount reaches existing subscriptions; fees compared with the legacy site.', 'Planned (phase 3)'],
    ['PAY-12', '**Saved card** charged when an invoice is issued (Financial add-on).', 'Planned'],
    ['PAY-13', '**Point of Sale:** taking payments in person for store items, services and booking balances. Options compared first (PayPal\'s in-person options and a second provider).', 'Planned (last)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Payments moves money; Financial decides what is owed.** A payment always points to what it was for.",
    "**Each organization uses its own payment account;** money never passes through Honcho's.",
    "**Test first:** a connection starts in the gateway's sandbox; switching to live is a deliberate step.",
    "Keys are stored encrypted, shown only by their last characters, and every connection change is in the Auditlog.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['30 Oct 2026', 'PayPal first, because it does recurring payments; National\'s account to start, chapters\' own later.'],
    ['31 Oct 2026', 'Payments is its own module for every gateway, separate from Financial; Core, since dues need it.'],
    ['31 Oct 2026', 'Built after the Dues phase of Financial; cash and check payments go into the payment record from the start.'],
    ['31 Oct 2026', 'Design for more providers, build only PayPal until a client needs another.'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['This book', 'Financial, Store, Scheduler (flight-time payments), Member Home and Website (Event Module)'],
    ['To-do list', 'Payments, Financial and Store'],
  ]},
]},

];
