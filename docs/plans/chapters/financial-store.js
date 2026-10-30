// chapters/financial-store.js.js — plan chapter for the Honcho Planning Book (docs/plans).
// Converted 2026-10-30 from the online plan page: Honcho Financial and Store (https://claude.ai/artifact/LYApDeBVM3JrM3szqaSAuR)
// From now on this file is the master copy: change the plan here, rebuild with `node generate.js`,
// and republish the online page if it is still in use.

module.exports = [
 {
  "tab": "Overview",
  "blocks": [
   {
    "type": "p",
    "text": "_Core dues + two add-ons · plan, decisions made · 30 Oct 2026_"
   },
   {
    "type": "p",
    "text": "One payment base and three parts. **Dues payments** (in Core) collect dues online with automatic renewal. **Financial** (add-on) sends invoices, keeps account balances, records expenses and, last of all, takes payments at a counter. **Store** (add-on) sells branded merchandise such as hats and T-shirts, tracks the orders and gives each buyer a receipt."
   }
  ]
 },
 {
  "tab": "What goes where",
  "blocks": [
   {
    "type": "p",
    "text": "Dues payment is in Core, so every member organization can collect dues without buying an add-on."
   },
   {
    "type": "table",
    "headers": [
     "Part",
     "Contains",
     "Who needs it"
    ],
    "rows": [
     [
      "**Core: payments and dues**",
      "PayPal connection, price list, payments, receipts, dues online, automatic renewal, cash and check recording, dues report",
      "Every member organization"
     ],
     [
      "**Financial add-on**",
      "Accounts and balances, invoices, card on file, monthly statements, expenses with receipt uploads, cost-share invoices, accounting export, Point of Sale",
      "Flight schools, clubs, partnerships, professional services"
     ],
     [
      "**Store add-on**",
      "Products, cart, orders, shipping and pickup, order receipts. National first, chapters' own stores later",
      "Anyone selling branded merchandise"
     ]
    ]
   }
  ]
 },
 {
  "tab": "Receipt or invoice?",
  "blocks": [
   {
    "type": "p",
    "text": "Both come from the same document, depending on when the money arrives:"
   },
   {
    "type": "table",
    "headers": [
     "Document",
     "When",
     "Examples"
    ],
    "rows": [
     [
      "**Receipt**",
      "Paid at the time of purchase",
      "A T-shirt order, dues paid online, a counter sale"
     ],
     [
      "**Invoice**",
      "Billed now, paid later",
      "A flight school's flight time, a partner's share of the hangar bill, a club's monthly statement"
     ]
    ]
   },
   {
    "type": "p",
    "text": "Each is a numbered PDF. Buyers can download it from their account or get it by email, and admins can reprint it. Once an invoice is paid, it shows as paid and its receipt is issued."
   }
  ]
 },
 {
  "tab": "What exists today",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "`ccmps_financial_transactions`: a dues payment record with invoice number, billing and shipping addresses and dues year. It's empty locally, and its only type is \"National Annual Dues\".",
     "`honcho_financial`: an account with a balance, for staff-side customers.",
     "`ccmps.paypal_txn_id`: left over from the legacy system's PayPal payments.",
     "The **Financial** settings tab (financial year, grace period), the **Financial Admins** group, and member status recalculation (current, past due, lifetime).",
     "An unused `store` page layout."
    ]
   },
   {
    "type": "p",
    "text": "The plan keeps dues status in the member record, where the portal already uses it, and adds the money side around it. The legacy data load (ETL) will bring dues history into the new tables."
   }
  ]
 },
 {
  "tab": "Payments go through PayPal",
  "blocks": [
   {
    "type": "p",
    "text": "PayPal is the first provider, as BPA uses it today:"
   },
   {
    "type": "table",
    "headers": [
     "Need",
     "PayPal product"
    ],
    "rows": [
     [
      "Pay online (dues, store, invoices)",
      "**Checkout** buttons: pay with a PayPal account or by card without one. Card numbers stay with PayPal, never in Honcho"
     ],
     [
      "Automatic dues renewal",
      "**Subscriptions**: a plan per dues type (yearly, or monthly for clubs). PayPal charges on schedule, retries failed payments, and tells Honcho by webhook"
     ],
     [
      "Card on file for flight time",
      "**Vault** (saved payment methods), charged when an invoice is issued. Financial add-on"
     ],
     [
      "Chapters paid into their own account",
      "Each chapter connects its own PayPal business account (later task)"
     ],
     [
      "Point of Sale",
      "PayPal's in-person options, or a second provider. Compared when we reach that phase"
     ],
     [
      "Sales tax on merchandise",
      "Rates you enter in Honcho (decided)"
     ]
    ]
   },
   {
    "type": "p",
    "text": "PayPal has no official PHP library for subscriptions, so Honcho calls PayPal's REST API directly from one helper (`payment_helper.php`). This is the same way it already calls Brevo and Telegram, and the same design as `ai_send()`: Stripe or Square can be added later as another provider without changing the screens. The PayPal client ID and secret are stored in the credential vault. A **webhook** verified with PayPal marks things paid, so a closed browser tab can't lose a payment. Each client uses their own PayPal business account."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**To check in PayPal's sandbox (test mode) before building automatic renewal:** whether members without a PayPal account can start a subscription with just a card; what happens to existing subscriptions when the dues amount changes (PayPal needs the plan's price updated); and how PayPal's fees compare with the legacy site's."
   }
  ]
 },
 {
  "tab": "Payments base and dues (Core)",
  "blocks": [
   {
    "type": "h3",
    "text": "Shared base"
   },
   {
    "type": "ul",
    "items": [
     "**Price list:** dues types, flight-hour and instructor rates, rental rates and products. Each has a price, a tax setting and an income category for the accounting export.",
     "**Accounts** (Financial add-on): one per person who pays (a member, or a staff-side customer such as a flight-school student), with a running balance. \"Add Funds\" is a prepayment into it.",
     "**Invoices and payments:** numbered invoices with line items, and payments by card, cash, check or balance. Refunds and credits, every change in the Auditlog.",
     "**Documents:** receipts, invoices and monthly statements as PDF, from a template that uses the organization's logo and colors."
    ]
   },
   {
    "type": "h3",
    "text": "Dues"
   },
   {
    "type": "ul",
    "items": [
     "**Dues types** by member type and year: National dues, and optionally chapter dues collected together. Flying-club dues can be monthly.",
     "**Pay online** from the member home. When paid, the member record updates and the existing status check runs. Lifetime members are skipped.",
     "**Automatic renewal:** an \"Auto-renew\" option at checkout starts a subscription. Members get a reminder before each renewal and a receipt after it. If a payment fails, PayPal retries, the member gets an email, and the grace period applies as it does now.",
     "**Admins** record cash and check payments, see who is due, overdue or on auto-renew, and email reminders."
    ]
   }
  ]
 },
 {
  "tab": "Financial add-on",
  "blocks": [
   {
    "type": "h3",
    "text": "Invoicing for flight schools and clubs"
   },
   {
    "type": "ul",
    "items": [
     "**From the Scheduler:** at check-in, aircraft hours times the rate, instructor time, and any fuel credit become invoice lines automatically.",
     "**Pay three ways:** card on file, the prepaid balance, or the link in the invoice email.",
     "**Monthly statements:** one statement covering club dues, flight time and partnership cost shares (the Scheduler's cost-sharing statements become invoices here).",
     "**Overdue rules:** an account past due can be blocked from new bookings. This is a switch."
    ]
   },
   {
    "type": "h3",
    "text": "Expenses with receipts, kept in the Document Library"
   },
   {
    "type": "ul",
    "items": [
     "**Expense entry** (parts, supplies, fuel, insurance, hangar, maintenance work): date, amount, vendor, category, and the aircraft or asset it's for. The Scheduler's cost-sharing and maintenance log use the same entries.",
     "**Upload the receipt** (a photo or PDF) on the same screen. Behind the scenes Honcho files it in the **Document Library** under Receipts, by asset and year. Only the admins who handle expenses (and, for a partnership, the partners) can open it.",
     "The expense shows a link to its receipt, and the Library's search and tags find receipts like any other document. One shared helper (`dms_file_upload()`) does this, so any module (maintenance paperwork, signed forms) can file uploads the same way."
    ]
   },
   {
    "type": "h3",
    "text": "Reports"
   },
   {
    "type": "ul",
    "items": [
     "Money collected by period and category, outstanding balances, expenses by asset, dues renewals, and an export for accounting software (for example a QuickBooks CSV). A Coffee Report section for yesterday's payments and new orders. A **Reporting module** across all of Honcho is a separate task: gather its requirements first."
    ]
   },
   {
    "type": "h3",
    "text": "Point of Sale (last)"
   },
   {
    "type": "ul",
    "items": [
     "Selling at a counter or an event: choose items from the price list or the store, or a booking to settle, then take the card on a reader or a phone. Cash and check are recorded by staff. The receipt is emailed or printed. PayPal's in-person options and a second provider (Square or Stripe) will be compared. This part gets its own options comparison when we reach it."
    ]
   }
  ]
 },
 {
  "tab": "Store add-on",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "**Products:** name, description, photos, price, and options such as size and color. Each combination can have its own stock count, with a \"sold out\" state.",
     "**Where it shows:** a Store page on the member portal and, optionally, on the public website, using the existing `store` layout. Optional members-only prices.",
     "**Buying:** cart, then PayPal checkout, which collects the shipping address. Sales tax at the rates you enter. Choose shipping (flat rate, or by weight) or \"pick up at an event or the office\".",
     "**Orders:** paid, packed, shipped (with a tracking number), picked up, refunded. Emails for the confirmation and when an order ships. The receipt PDF is in the buyer's account.",
     "**Store Admins:** a new security group that manages products, works through the order list and prints packing slips.",
     "**Chapter stores (later):** a chapter sells its own chapter-logo merchandise, paid into the chapter's own PayPal account and run by its Chapter Admins."
    ]
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**Stock it yourself, or print on demand?** With print on demand (Printful or Printify), each order is printed with the logo and shipped by the printer, so there's no stock to buy or store. You earn less per item. Decided: stock you hold first, print on demand as a later connection."
   }
  ]
 },
 {
  "tab": "Tables",
  "blocks": [
   {
    "type": "table",
    "headers": [
     "Table",
     "Holds"
    ],
    "rows": [
     [
      "`fin_items`",
      "Price list: kind (dues, service, rental, product), price, tax, income category"
     ],
     [
      "`fin_accounts`",
      "One per payer: tg_user_id or ccmp_id, balance, provider customer id, card-on-file summary (brand and last 4 digits only)"
     ],
     [
      "`fin_invoices` / `fin_invoice_lines`",
      "Number, account, status (draft, open, paid, void), due date, source (dues, booking, order, statement), lines"
     ],
     [
      "`fin_payments`",
      "Amount, method (card, cash, check, balance), provider payment id, refunds"
     ],
     [
      "`fin_subscriptions`",
      "Auto-renewals: dues type, interval, provider subscription id, status, next renewal"
     ],
     [
      "`fin_expenses`",
      "Date, amount, vendor, category, asset, linked Document Library receipt"
     ],
     [
      "`fin_provider_events`",
      "Every webhook received, so none is processed twice"
     ],
     [
      "`store_products` / `store_variants`",
      "Products, options, stock"
     ],
     [
      "`store_orders` / `store_order_lines`",
      "Orders, shipping, status, tracking, linked invoice"
     ]
    ]
   },
   {
    "type": "p",
    "text": "A store order is an invoice that was paid immediately. Dues, bookings and merchandise therefore all share the same payments, receipts and reports."
   }
  ]
 },
 {
  "tab": "Phases",
  "blocks": [
   {
    "type": "h3",
    "text": "F0: Payment base (Core)"
   },
   {
    "type": "ul",
    "items": [
     "PayPal connection screen (vault, sandbox first) and the verified webhook.",
     "Price list, invoices and payments tables, and the PDF receipt template."
    ]
   },
   {
    "type": "h3",
    "text": "F1: Dues online (Core)"
   },
   {
    "type": "ul",
    "items": [
     "Pay dues from the member home, with receipts and the status update.",
     "Cash and check recording, reminders, and the dues report."
    ]
   },
   {
    "type": "h3",
    "text": "F2: Automatic renewal (Core)"
   },
   {
    "type": "ul",
    "items": [
     "Sandbox checks first, then PayPal subscription plans per dues type.",
     "Renewal reminders, failed-payment emails and the grace period."
    ]
   },
   {
    "type": "h3",
    "text": "S1: Store, National (add-on)"
   },
   {
    "type": "ul",
    "items": [
     "Products with options and stock, cart, checkout, entered tax rates, orders, emails, receipts and Store Admins."
    ]
   },
   {
    "type": "h3",
    "text": "F3: Invoicing, accounts and expenses (Financial add-on)"
   },
   {
    "type": "ul",
    "items": [
     "Accounts and balances, invoices, card on file, monthly statements and the accounting export.",
     "Expenses with receipts filed in the Document Library.",
     "Built alongside the Scheduler, which comes after this money work."
    ]
   },
   {
    "type": "h3",
    "text": "F4: Chapters get paid"
   },
   {
    "type": "ul",
    "items": [
     "Chapters connect their own PayPal accounts for events and chapter dues.",
     "Chapter stores selling chapter-logo merchandise."
    ]
   },
   {
    "type": "h3",
    "text": "S2: Store extras"
   },
   {
    "type": "ul",
    "items": [
     "Shipping by weight, pickup at events, store reports.",
     "Print on demand."
    ]
   },
   {
    "type": "h3",
    "text": "F5: Point of Sale"
   },
   {
    "type": "ul",
    "items": [
     "Options comparison first, then counter sales of store items, services and booking balances."
    ]
   }
  ]
 },
 {
  "tab": "Decisions (Eric, 30 Oct 2026)",
  "blocks": [
   {
    "type": "ol",
    "items": [
     "**PayPal first**, because it does recurring payments. Other providers can be added later through the same helper.",
     "**Store is an add-on.** Dues collection is needed by every member organization, so dues payments go in **Core**. Invoicing, accounts, expenses and Point of Sale are the **Financial** add-on.",
     "**National's account to start.** Chapters' own accounts, including chapter stores for chapter-logo merchandise, are a later task (F4).",
     "**Merchandise you stock** first, print on demand later.",
     "**Sales tax:** rates entered in Honcho.",
     "**Money first:** these phases come before the Scheduler.",
     "**Expense receipts** are uploaded with the expense and filed in the Document Library.",
     "**Reporting module:** a separate task to gather requirements."
    ]
   }
  ]
 }
];
