// chapters/pricing.js.js — plan chapter for the Honcho Planning Book (docs/plans).
// Converted 2026-10-30 from the online plan page: Honcho Pricing and AI Billing (https://claude.ai/artifact/3kynSEzd98AwCh2fJDBmpV)
// From now on this file is the master copy: change the plan here, rebuild with `node generate.js`,
// and republish the online page if it is still in use.

module.exports = [
 {
  "tab": "Overview",
  "blocks": [
   {
    "type": "p",
    "text": "How to price the modules and hosting, and how to limit, control and bill for AI use by organization or by chapter. Companion to the Honcho AI Assistant plan."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**The short version:** Three deployment tiers: **Dedicated** (own droplet, Honcho AI and Hermes agents), **Honcho Cloud** on honcho.online (Docker subsites, Honcho AI, no Hermes) and **Self-hosted shared** (ordinary cPanel host, no Docker or Hermes). Price Honcho the way the membership-software market already does (by size, plus add-on modules, plus tier). For AI, use **credits**: each plan includes a monthly allowance, usage stops at a cap unless the client buys more, and Honcho meters every request by organization, chapter and admin. Offer **bring-your-own-key** as the alternative for dedicated-server clients who want to pay the model provider themselves, a **Claude connector** for clients whose admins already pay for Claude, and, once OpenAI approves Honcho, **per-admin ChatGPT** where each admin's own plan pays for their use."
   }
  ]
 },
 {
  "tab": "Deployment tiers",
  "blocks": [
   {
    "type": "p",
    "text": "The Honcho AI module calls the AI provider's API from PHP, so it runs on every tier. Hermes agents need an always-on server of their own, so they're only on Dedicated. Names are working names."
   },
   {
    "type": "table",
    "headers": [
     "",
     "Dedicated: highest",
     "Honcho Cloud: middle",
     "Self-hosted shared: entry"
    ],
    "rows": [
     [
      "Runs on",
      "The client's own DigitalOcean droplet",
      "A shared honcho.online droplet, one subsite per client",
      "An ordinary cPanel shared host, the client's or ours"
     ],
     [
      "Docker",
      "Yes: Honcho, database, web proxy (and Hermes)",
      "Yes: one Honcho container per client, one database server with a database each, subdomains routed by the web proxy",
      "No"
     ],
     [
      "Web address",
      "Client's own domain",
      "`client.honcho.online` or their own domain",
      "Client's own domain"
     ],
     [
      "Staging copy for testing",
      "Yes, same droplet",
      "Optional, a second subsite",
      "No"
     ],
     [
      "Honcho AI (brief, alerts, Ask EMS)",
      "Yes: credits, or the client's own key",
      "Yes: credits",
      "Yes, with limits: chat must answer within the host's time limit (often 30 to 60 seconds)"
     ],
     [
      "Hermes agents",
      "Yes, on the same or a second droplet, reading Honcho through the MCP server",
      "No",
      "No"
     ],
     [
      "Custom work",
      "Yes: client configuration in git, custom modules",
      "Configuration only: settings, logo, wording, member fields",
      "Configuration only"
     ],
     [
      "Updates",
      "We deploy a tested release to staging, then production",
      "We update all subsites together from one release",
      "Files copied over SFTP or cPanel Git; slower, and SSH may be blocked"
     ],
     [
      "Backups",
      "Nightly off-server, plus droplet backups",
      "Nightly per client, off-server",
      "The host's backups plus a nightly export we set up"
     ],
     [
      "HIPAA",
      "Optional: DigitalOcean BAA on covered products, plus an AI provider BAA",
      "No",
      "No: shared hosts generally won't sign a BAA"
     ],
     [
      "AI billing",
      "Credits, or bring-your-own-key with a lower module fee",
      "Credits with a hard cap and top-ups",
      "Credits with a hard cap and top-ups"
     ],
     [
      "Best for",
      "Large or regulated organizations; BPA",
      "Small and mid-size organizations",
      "Very small groups on a tight budget, or a client tied to an existing host"
     ],
     [
      "Price level",
      "Setup fee + highest monthly",
      "Middle monthly",
      "Lowest monthly; client may pay their host separately"
     ]
    ]
   },
   {
    "type": "p",
    "text": "HIPAA terms are from secondary sources; confirm DigitalOcean's covered-product list and the AI provider's BAA terms before offering it."
   }
  ]
 },
 {
  "tab": "What similar companies do",
  "blocks": [
   {
    "type": "p",
    "text": "Public information on AI pricing is thin, especially for membership software, and most of these figures come from comparison blogs rather than the vendors' own pages. Treat them as direction, not quotes."
   },
   {
    "type": "table",
    "headers": [
     "Group",
     "What they do",
     "Examples"
    ],
    "rows": [
     [
      "Membership software (AMS)",
      "Priced by contacts or members, with modules sold separately. AI is either missing or bundled into higher tiers; no one publishes per-use AI prices.",
      "Wild Apricot from $66/month at 100 contacts, no AI. MemberClicks from $3,500/year, AI through its parent's suite. Glue Up $4,500 to $15,500/year."
     ],
     [
      "Community platforms",
      "AI bundled in the plan with a monthly credit allowance; agents only on top plans.",
      "Circle: 2,500 AI credits a month on some plans (sources disagree on which). Mighty Networks: AI co-host on the entry plan. Hivebrite about $895/month, AI price not published."
     ],
     [
      "Large SaaS",
      "Subscription plus included AI credits, with paid overage. Some charge per outcome instead.",
      "HubSpot $10 per 1,000 credits over the allowance. Atlassian 25 AI credits per user a month. GitHub Copilot credits at $0.01. Zendesk $1.50 per resolved conversation."
     ],
     [
      "Bring your own key",
      "The client pays the model provider directly; the vendor charges a platform fee for its features.",
      "ServiceNow, Scenario."
     ],
     [
      "Metered resale",
      "The vendor resells model usage with a markup; billing tools now automate this.",
      "OpenRouter about 5.5%. Stripe's own example uses a 30% markup (its LLM token billing is still in private preview)."
     ]
    ]
   },
   {
    "type": "p",
    "text": "The pattern: **hybrid** pricing (subscription + included credits + overage) is becoming the default, credits are replacing raw token prices, and buyers want caps so bills can't surprise them. Nonprofit associations are especially sensitive to surprise bills."
   }
  ]
 },
 {
  "tab": "Pricing the product",
  "blocks": [
   {
    "type": "p",
    "text": "Three dimensions, so a small chapter-based nonprofit and a large association pay sensibly different amounts:"
   },
   {
    "type": "ul",
    "items": [
     "**Size:** bands by active members (for example up to 250, 1,000, 2,500, 5,000+), the way AMS vendors price by contacts. Members, not admin seats, because nonprofits have few paid staff and many volunteer admins.",
     "**Modules:** Core (Welcome, CCMPS, DMS, Website, Security) in every plan; add-ons priced separately: PMS, Student/Participants, Events and registration, Member cards with Wallet, AI.",
     "**Tier:** Self-hosted shared, Honcho Cloud or Dedicated, as in the chart above. Dedicated carries a setup fee and is where custom work and Hermes live, matching the hybrid SaaS/custom model."
    ]
   },
   {
    "type": "p",
    "text": "Market anchors above suggest roughly $1,000 to $5,000 a year for small-to-mid associations on shared hosting, and more for dedicated. Actual numbers are your call; this plan only sets the structure."
   }
  ]
 },
 {
  "tab": "Options for AI billing",
  "blocks": [
   {
    "type": "h3",
    "text": "A. Included credits, hard cap, top-ups recommended"
   },
   {
    "type": "p",
    "text": "Each plan with AI includes a monthly allowance of Honcho AI credits (for example 1 credit = 1 cent of retail value). Briefs, alerts and chat spend credits at published rates. At the cap, AI pauses until next month or a top-up pack is bought; overage billing is off unless the client turns it on."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "Predictable bills, which nonprofits need",
     "Credits hide model prices, so changing models doesn't change the price list",
     "Matches what Circle, HubSpot and Atlassian do"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "You carry the provider bill and the risk if the rates are set wrong",
     "Needs a credits ledger and a usage page"
    ]
   },
   {
    "type": "h3",
    "text": "B. Bring your own key"
   },
   {
    "type": "p",
    "text": "The client opens their own Anthropic account, puts the key in their Honcho settings, and pays the provider directly. Honcho charges a flat AI module fee and still meters, caps and reports usage."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "No token risk for you",
     "Clients who want their own data terms or already have an account",
     "Fits dedicated droplets"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Setup friction for volunteer-run groups",
     "No margin on usage",
     "Support load when their key or billing fails"
    ]
   },
   {
    "type": "h3",
    "text": "C. Pass-through with markup"
   },
   {
    "type": "p",
    "text": "Honcho records the real cost of every request and invoices it monthly, plus a markup (the examples above range from about 5% to 30%)."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "Simple to explain, fair to light users",
     "Margin on every request"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Bills vary month to month",
     "Clients see token jargon and model prices"
    ]
   },
   {
    "type": "h3",
    "text": "D. Flat fee, fair use"
   },
   {
    "type": "p",
    "text": "One price for the AI module, \"unlimited\" within a fair-use limit that Honcho enforces quietly."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "Easiest to sell and bill"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Heavy users cost more than they pay; agents make this worse",
     "\"Fair use\" disputes"
    ]
   },
   {
    "type": "h3",
    "text": "E. Per outcome"
   },
   {
    "type": "p",
    "text": "A price per thing done: per brief, per answered question, per completed change, like Zendesk's per-resolution price."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "Clients pay for results they can see"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Hard to define \"an outcome\" for chat",
     "Still needs caps"
    ]
   },
   {
    "type": "h3",
    "text": "F. Connect your own Claude"
   },
   {
    "type": "p",
    "text": "The client's admins already have Claude (Team or Enterprise). Their owner adds Honcho as a custom connector in Claude.ai; each admin signs in to Honcho once and asks questions in Claude.ai, with their own Honcho permissions. Their subscription pays for the AI. A subscription can't power Honcho's built-in AI: Anthropic's terms limit subscription logins to Claude.ai and Claude Code, so the built-in module always needs an API key."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "No token cost or risk for you",
     "Admins use a tool they already know",
     "Same MCP server as the Hermes tier",
     "Briefs and alerts still work as plain numbers, no key needed"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Chat only: no AI-written briefs, no confirmed changes",
     "Honcho must be reachable from the internet, with per-admin sign-in",
     "Custom connectors are still a beta"
    ]
   },
   {
    "type": "h3",
    "text": "G. Each admin connects their own ChatGPT"
   },
   {
    "type": "p",
    "text": "With OpenAI's \"Sign in with ChatGPT\" (opened to app plan usage on 29 Sept 2026), an admin connects their ChatGPT Plus or Pro account on their Honcho profile. Their chat and their own brief run on their plan, within a weekly limit they set per app. Commercial hosted apps need OpenAI's approval (waitlist). Not possible with Claude subscriptions, which Anthropic limits to Claude.ai and Claude Code."
   },
   {
    "type": "p",
    "text": "**For:**"
   },
   {
    "type": "ul",
    "items": [
     "No token cost for you or the organization",
     "Spend is naturally split by admin, so by chapter too",
     "Admins keep using a plan they already pay for"
    ]
   },
   {
    "type": "p",
    "text": "**Against:**"
   },
   {
    "type": "ul",
    "items": [
     "Member data goes into each admin's personal AI account: an organization on/off setting is required",
     "Admins need Plus or Pro; volunteer admins may not have it",
     "Org-wide alerts still need an organization key or plain numbers",
     "Waitlist, and a second provider to build and test"
    ]
   },
   {
    "type": "p",
    "text": "**Recommended mix:** A on Honcho Cloud and Self-hosted shared, and as the default on Dedicated; B offered to Dedicated clients for a lower module fee; F available on every tier as a low-price AI option (connector fee only) and alongside A for clients who want both. G added when OpenAI approves Honcho, behind an organization setting. Within A, the morning brief and alerts are cheap enough to include outright; chat and changes spend credits."
   }
  ]
 },
 {
  "tab": "Limits and control, by organization and by chapter",
  "blocks": [
   {
    "type": "p",
    "text": "The same controls work for every billing option, because Honcho meters every request itself from the model's reported token counts."
   },
   {
    "type": "ul",
    "items": [
     "Organization pool: The monthly allowance or budget. Warnings to the System Admin at 50%, 80% and 100%. At 100%: pause, or allow overage if the client turned it on.",
     "Chapter allocation (optional): The organization splits its pool across chapters, or gives some chapters a share. When a chapter's share runs out, a setting decides: stop, or borrow from the national pool. National features (briefs for national admins) draw from a National share.",
     "Admin limits (optional): A daily or monthly limit per admin, and who may use chat at all (Security Groups function `ai/use_chat`).",
     "Feature settings: Which model each feature uses (cheaper models for briefs and alerts if quality holds), and briefs sent through the half-price batch service."
    ]
   },
   {
    "type": "p",
    "text": "**Billing chapters:** start with a **usage-by-chapter report** the organization can use to charge chapters back itself. Billing chapters directly (each with its own payment method) can come later, alongside the planned chapter payment accounts for event registration."
   }
  ]
 },
 {
  "tab": "What gets built",
  "blocks": [
   {
    "type": "table",
    "headers": [
     "Piece",
     "What it does"
    ],
    "rows": [
     [
      "`ai_requests`",
      "One row per AI call: organization, chapter, admin, feature, model, tokens in and out, cost, credits charged."
     ],
     [
      "`ai_credit_ledger`",
      "Allowance granted each month, top-ups bought, credits spent; running balance per organization and chapter."
     ],
     [
      "Rate card",
      "System settings: credits per feature or per 1,000 tokens for each model, so prices change without code."
     ],
     [
      "Budget checks",
      "Before each call: is there balance at the admin, chapter and organization level? After: record the actual cost."
     ],
     [
      "Usage page",
      "For System Admins: this month's use by chapter, admin and feature, balance, and a CSV for chargebacks."
     ],
     [
      "Provider side",
      "One Anthropic workspace and key per client, each with a spend limit set in the provider's console as a backstop behind Honcho's own caps."
     ],
     [
      "Invoicing",
      "To start: the monthly usage report feeds a manual or Stripe invoice for top-ups and overage. Later: Stripe usage billing, once its token billing leaves preview."
     ]
    ]
   }
  ]
 },
 {
  "tab": "A worked example (illustrative)",
  "blocks": [
   {
    "type": "p",
    "text": "Using the cost estimates from the AI plan, on Opus 5.5 prices, with credits at 1 cent and a 40% margin on model cost:"
   },
   {
    "type": "table",
    "headers": [
     "Use",
     "Model cost",
     "Credits"
    ],
    "rows": [
     [
      "One morning brief (batch)",
      "about $0.015",
      "included"
     ],
     [
      "One chat question",
      "$0.05 to $0.10",
      "7 to 14"
     ],
     [
      "One confirmed change",
      "about $0.10",
      "14"
     ],
     [
      "Monthly allowance, standard AI",
      "covers about 150 questions",
      "2,000"
     ],
     [
      "Top-up pack",
      "model cost about $7",
      "1,000 for $10"
     ]
    ]
   },
   {
    "type": "p",
    "text": "The rates are placeholders until phase 1 of the AI plan measures real usage."
   }
  ]
 },
 {
  "tab": "Decisions for you",
  "blocks": [
   {
    "type": "ol",
    "items": [
     "**AI billing model:** A (credits) as default with B (own key) for dedicated clients, as recommended, or another mix?",
     "**Overage:** hard stop at the cap by default, with overage only if the client opts in?",
     "**Chapter allocation:** offer it from the start, or begin with organization-level pools and the chapter usage report?",
     "**Size bands:** price by active members, as AMS vendors do? Which band edges?",
     "**Which modules are add-ons** and which are in Core (DMS and Website are Core today).",
     "**Margin target** on AI usage (the examples range from about 5% to 30%; the worked example uses 40% to cover failed and retried calls).",
     "**Per-admin ChatGPT (G):** apply to OpenAI's waitlist now, and allow it only where the organization switches it on?",
     "**Claude connector (F):** sold as part of the AI module, or a separate low-price add-on?",
     "**Tier names and whether the entry tier gets AI** (it can, with shorter chat answers), or AI starts at Honcho Cloud.",
     "**BPA itself:** as the first client and blueprint, is BPA billed like everyone else, or a founding-client arrangement?"
    ]
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "Before setting real prices, it's worth confirming two or three AMS competitors' current AI pricing directly with their sales teams; little of it is published."
   },
   {
    "type": "h3",
    "text": "Sources"
   },
   {
    "type": "ul",
    "items": [
     "Raklet: association management software pricing (https://www.raklet.com/blog/association-management-software-reviews-pricing/)",
     "Member Lounge: association software with built-in AI (https://memberlounge.app/best-association-software-built-in-ai-2026/)",
     "Member Lounge: AMS buyer's guide (https://memberlounge.app/association-management-software-the-2026-buyers-guide/)",
     "Schoolmaker: Circle pricing (https://schoolmaker.com/blog/circle-so-pricing)",
     "Learning Revolution: Mighty Networks vs Circle (https://www.learningrevolution.net/mighty-networks-vs-circle/)",
     "Zylo: 2026 SaaS pricing trends (https://zylo.com/blog/saas-pricing-trends)",
     "Ibbaka: AI pricing predictions for 2026 (https://www.ibbaka.com/ibbaka-market-blog/b2b-saas-and-agentic-ai-pricing-predictions-for-2026)",
     "Usagebox: AI credits as the new pricing primitive (https://usagebox.com/articles/ai-credits-new-pricing-primitive-2026)",
     "Kinde: BYOK pricing (https://kinde.com/learn/billing/billing-for-ai/byok-pricing/)",
     "Geekflare: BYOK strategy (https://geekflare.com/guides/byok-ai-business-strategy/)",
     "Stripe: billing for LLM tokens (https://docs.stripe.com/billing/token-billing)",
     "TechCrunch: Stripe token billing (https://techcrunch.com/2026/03/02/stripe-wants-to-turn-your-ai-costs-into-a-profit-center)",
     "Lava: usage-based billing for AI (https://www.lava.so/blog/usage-based-billing-ai)",
     "TrueFoundry: OpenRouter BYOK (https://www.truefoundry.com/blog/openrouter-byok-explained-cheaper-often-faster-and-changing)",
     "WinBuzzer: subscription logins banned in third-party apps (https://winbuzzer.com/2026/02/19/anthropic-bans-claude-subscription-oauth-in-third-party-apps-xcxwbn/)",
     "Claude Help Center: custom connectors using remote MCP (https://support.claude.com/en/articles/11175166)",
     "The New Stack: Sign in with ChatGPT for third-party tools (https://thenewstack.io/sign-in-with-chatgpt/)",
     "DEV Community: Sign in with ChatGPT for developers (https://dev.to/hassann/sign-in-with-chatgpt-for-developers-the-oauth-flow-plan-usage-and-what-it-means-for-your-api-bill-48f7)"
    ]
   }
  ]
 }
];
