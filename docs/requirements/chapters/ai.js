// chapters/ai.js — Honcho Requirements: Honcho AI and the Daily Coffee Report (requirement prefix AI).
// Rewritten 2026-10-30 from the AI plan (2026-10-29, https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt) as built,
// checked against modules/ai/Ai.php, engine/tg_helpers/ai_helper.php, coffee_helper.php, vault_helper.php,
// the 2026-10-29 AI migrations, the Administrator's Guide chapter 7 and the AI chapter of the Developer's Guide.
// Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "AI built into Honcho for admins: today a **Daily Coffee Report** (a short morning email, and optionally a Telegram message, with the numbers and news an admin needs); next, alerts, a chat assistant and changes made on request. Honcho gathers every fact itself; the AI only writes it up, so numbers are always exact and a plain report goes out when there is no AI." },
  { type: 'p', text: "Two tiers are proposed: the **standard** Honcho AI module on every hosting tier, and **premium** Hermes agents (general-purpose agents for work outside Honcho) on the Dedicated tier only. That split is awaiting sign-off." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**System Admins**', "Set up National's AI connection and National's Coffee Report; see usage for every scope"],
    ['**Member Admins**', "Receive National's report"],
    ['**Chapter Admins**', "Optionally set up their chapter's own AI connection; set up and receive their chapter's report; post their chapter's bulletins"],
    ['**Current members**', 'Set up and receive their own Coffee Report, when the organization offers it'],
  ]},
  { type: 'p', text: "**Module:** add-on (`ai`), off until switched on. **To-do section:** Daily Coffee Report and AI connections." },
]},

{ tab: "Requirements", blocks: [
  { type: 'p', text: "Everything marked Built was built 29-30 Oct 2026 and deployed to staging on 30 Oct 2026 (Help-linked guides and Sports included)." },

  { type: 'h2', text: 'AI Connections' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-01', 'The AI module is an add-on, switched on and off on the Security Groups Modules panel; its menus appear only when it is on.', 'Built 29 Oct 2026'],
    ['AI-02', "Each scope has its own AI connection: **National**, and each chapter that wants one. A connection holds the provider, model, API key, on/off and a monthly limit in dollars. System Admins set National's; a chapter's Chapter Admins set their chapter's.", 'Built 29 Oct 2026'],
    ['AI-03', 'API keys are stored encrypted and never shown again; the screen shows only the last 4 characters. **Remove key** (click twice to confirm) deletes the key and switches the connection off. Every change is in the Auditlog.', 'Built 29 Oct 2026'],
    ['AI-04', '**Test connection** sends one tiny question and records the result and date.', 'Built 29 Oct 2026'],
    ['AI-05', "A chapter without its own connection uses National's, or gets no AI, as a National setting decides.", 'Built 29 Oct 2026'],
    ['AI-06', "When a scope's estimated cost this month reaches its limit, its AI pauses until next month; reports go out plain meanwhile.", 'Built 29 Oct 2026'],
    ['AI-07', 'Every AI call is logged: who, scope, feature, model, tokens, estimated cost and outcome. The **Usage** page shows requests and cost by month, scope and feature.', 'Built 29 Oct 2026'],
    ['AI-08', "Email warnings to a scope's admins at 50%, 80% and 100% of its monthly limit.", 'Planned'],
  ]},

  { type: 'h2', text: 'Providers' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-09', 'Anthropic with three models: Claude Opus 5.5 (default), Sonnet 5.5 and Haiku 5.5. Every call goes through one provider layer, so screens, limits and logging stay the same whichever company answers.', 'Built 29 Oct 2026'],
    ['AI-10', '**OpenAI:** an OpenAI API key, and **Sign in with ChatGPT** so an admin\'s own ChatGPT plan pays for their use, behind an organization on/off setting (member data then goes to the admin\'s personal AI account).', "Planned. Shown greyed out (\"coming once OpenAI approves Honcho\"); Sign in with ChatGPT needs OpenAI's approval (waitlist; Eric to apply)"],
    ['AI-11', '**Local model** (OpenAI-compatible): a model such as Qwen on the client\'s own server, entered as an address and model name with no key, so member data never leaves the server. For Dedicated and HIPAA clients; needs 8 GB or more and is slow on CPU.', 'Planned, with or after AI-10'],
    ['AI-12', 'The screens explain that a Claude or ChatGPT **subscription** can\'t be entered: the providers allow subscription logins only in their own apps, so Honcho needs an API key.', 'Built 29 Oct 2026'],
  ]},

  { type: 'h2', text: 'The Daily Coffee Report' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-13', 'A report per scope (National and each chapter). Honcho collects the facts; the AI writes them up using only those facts, keeping every number exact; with no AI, at the limit or on any AI failure, the plain facts are sent instead.', 'Built 29 Oct 2026'],
    ['AI-14', 'Settings: on/off, send time, time zone, days of the week, email subject, the tone the AI should write in, and the sections with their order and options.', 'Built 29 Oct 2026'],
    ['AI-15', "Sections: **Membership** (current, past due, renewal rate, new in 7 days), **Upcoming events**, **Sunshine and Bulletin Board**, **Documents waiting for approval**, **Weather** (places), **Markets** (the previous trading day's close and change for listed ticker symbols, including indices, crypto, gold and oil futures; WTI crude, Prime Rate and 30-year mortgage from FRED with a free key; exchange rates from US dollars), **News** (topics, hours back, most headlines), **YouTube channels** (new videos), **Sports** (yesterday's results and today's games for NFL, MLB, NBA, WNBA, MLS, NWSL; PGA, LPGA, DP World and Champions leaderboards at Top 10, Top 25 or Full, ties included). A chapter's report counts its own chapter.", 'Built 29 Oct 2026; Sports and Markets 30 Oct 2026'],
    ['AI-16', "Recipients: the scope's admins when ticked (the page names them, and anyone left out for having no email), plus extra addresses that always receive it; each address gets one copy.", 'Built 29 Oct 2026'],
    ['AI-17', 'Optionally also to **Telegram**: a list of chat IDs, each person or group getting its own copy (a list since 30 Oct 2026); bot token stored encrypted, a **Find chat ID** helper; email and Telegram are sent separately, so one failing doesn\'t stop the other; long reports arrive in parts.', 'Built 29 Oct 2026'],
    ['AI-18', '**Preview** (shows today\'s report, sends nothing), **Send a test** to me or to everyone on the list, **Telegram test**.', 'Built 29 Oct 2026'],
    ['AI-19', "**Sent** list: every run with time, whether the AI wrote it, emails sent, Telegram result and notes; **View** shows the report and exactly what each section collected.", 'Built 29 Oct 2026'],
    ['AI-20', "The server checks every 15 minutes and sends each report once on each ticked day at its time. The check is protected by a secret key.", 'Built 29 Oct 2026; running on staging since 30 Oct 2026 (first scheduled report sent that day)'],
    ['AI-21', 'Emails come from a sender address verified with Brevo (the organization\'s own domain); a test server sends everything to the developer only.', 'Built 29 Oct 2026; BPA\'s domain verified with Brevo 29 Oct'],
    ['AI-22', 'Each admin gets a morning brief tailored to their role and chapter.', '**Changed:** replaced by one Coffee Report per scope (AI-13), built from Eric\'s Python Coffee Brief design (decided 29 Oct 2026)'],
    ['AI-23', 'A "Today\'s schedule" section from the Scheduler, and a "Yesterday\'s payments and new orders" section from Payments.', 'Planned (with those modules)'],
  ]},

  { type: 'h2', text: 'Bulletins' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-28', "A **bulletin** (title, message, optional link) is printed word for word at the top of Coffee Reports, under the title, between optional show-from and show-until dates; the AI never rewrites it.", 'Built 30 Oct 2026'],
    ['AI-29', "National's bulletins (System Admins) go on every report; a chapter's (its Chapter Admins) go on that chapter's admin report and its members' reports. Each bulletin goes on every report, admins' reports only, or members' reports only.", 'Built 30 Oct 2026'],
    ['AI-30', 'Bulletins list with Showing / Starts later / Ended / Hidden; hide without deleting; delete with a second click; every change in the Auditlog.', 'Built 30 Oct 2026'],
  ]},

  { type: 'h2', text: "Members' Own Coffee Reports" },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-31', "Each member can have their own Daily Coffee Report (**My Coffee Report** in the member menu): on/off, time, time zone, days, and their own sections and options. The organization switches the feature on in System Settings.", 'Built 30 Oct 2026'],
    ['AI-32', "Only **Current** members can switch it on or receive it; anyone else is told why. A scheduled report for a member who is no longer eligible isn't sent and is logged.", 'Built 30 Oct 2026. Current depends on Status, which the Payments and Financial work will drive'],
    ['AI-33', "Member sections: Membership, Upcoming events, Sunshine and Bulletin Board, Weather, Markets, News, Sports. No Documents waiting for approval (admin work) and no YouTube.", 'Built 30 Oct 2026'],
    ['AI-34', "A member's Membership section shows the totals of Current members nationwide and in their chapter. Further statistics to be decided.", 'Built 30 Oct 2026 (more planned)'],
    ['AI-35', 'Members\' reports are plain facts (no AI), with the bulletins first.', 'Built 30 Oct 2026 (decided: AI for members may come later)'],
    ['AI-36', "Sent to the member's own email address, and optionally to their Telegram, linked to the organization's bot (the bot on National's report) by pressing Start on a link.", 'Built 30 Oct 2026'],
    ['AI-37', 'Preview, Email it to me now, and a list of recently sent reports the member can open again.', 'Built 30 Oct 2026'],
    ['AI-38', '**Paid extra for members:** YouTube channels in their own report.', 'Planned (owner, 30 Oct 2026); price and billing with the Financial module'],
    ['AI-39', "**Paid extra for members:** their personal calendar (Google or Outlook) in their own report.", 'Planned (owner, 30 Oct 2026); price and billing with the Financial module'],
  ]},

  { type: 'h2', text: 'Coming Phases' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['AI-24', '**Alerts:** rules checked hourly or nightly (dues payment failed, document waiting more than N days, chapter with no admin, member card reissued twice in a week). Rules need no AI; the AI only words or groups them. Each admin chooses which alerts they get.', 'Planned (phase 2)'],
    ['AI-25', '**Honcho connector:** a read-only connection (an MCP server) offering tools such as find members, member counts, renewals due, documents pending, upcoming events and chapter summary, with each admin signing in so their own permissions apply. Serves clients who bring their own Claude (Claude.ai custom connectors) and Hermes agents on the Dedicated tier.', 'Planned (phase 3)'],
    ['AI-26', '**Ask EMS:** a chat panel on the admin dashboard using the same read tools; answers link to the real screens; every tool runs as the admin asking.', 'Planned (phase 4)'],
    ['AI-27', '**Changes on request:** tools that change data (extend memberships, post a bulletin, approve a document, lock an account) only propose; the admin confirms; the change runs through Honcho\'s own code and the Auditlog records "AI for <admin>".', 'Planned (phase 5)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Never more than the person asking:** the AI uses only Honcho's own functions, as the admin who asked, under the same Security Groups; it never sees the database or writes its own queries.",
    "**Every change is confirmed** by a person and logged; nothing changes data from a report or an alert.",
    "**Member-written text is untrusted:** posts, notes and comments go to the AI as data, and instructions inside them are ignored.",
    "**Least data:** passwords, codes, card secrets, birthdays and home addresses never go to the AI.",
    "**Facts from code, words from the AI:** numbers in the Coffee Report are collected by Honcho, never calculated by the AI.",
    "**Keys are never shown or logged;** only the last 4 characters identify one.",
    "**Off switch:** switching the module off, or a connection off, stops all AI use for that scope at once.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "Until an Anthropic API key is entered (on staging and the Mac), reports go out as plain facts.",
    "National's Telegram delivery on staging is off until the bot token is pasted on the staging settings page (a token encrypted on one server can't be read on another).",
    "Member reports send one email per member per day: size the Brevo plan to the number switched on (the free plan is 300 a day).",
    "BPA's bot, @BPAPilotsCoffeeBot, belongs to Eric's Telegram account (made 30 Oct 2026); move it to a BPA-controlled account later if BPA gets one.",
    "Stock prices come from Yahoo Finance's free but unofficial feed, which, like ESPN's, can change without notice and has no published terms for commercial use. For clients, offer a licensed provider (several have free tiers with a key).",
    "The sports results come from ESPN's free but unofficial feeds: they can change without notice (that section then says \"unavailable\"), and their terms for commercial use aren't published. Review before selling Sports to clients.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['29 Oct 2026', 'National and each chapter have their own AI connection; Member and System Admins use National\'s; Chapter Admins may enter their own.'],
    ['29 Oct 2026', "The Coffee Report is rebuilt in PHP inside Honcho from Eric's Python design (runs on every hosting tier); Eric's personal Hermes brief stays separate."],
    ['29 Oct 2026', 'Telegram added as a delivery channel; iMessage is not possible from a server.'],
    ['29 Oct 2026', 'Local model connection type added to the plan (AI-11).'],
    ['30 Oct 2026', 'Sports section from ESPN\'s free scoreboards.'],
    ['30 Oct 2026', 'Bulletins from National and chapters, at the top of every report (AI-28, AI-29).'],
    ['30 Oct 2026', 'A separate BPA Telegram bot, @BPAPilotsCoffeeBot, for National\'s report and members\' reports; Telegram chats as a list, each getting its own copy (AI-17).'],
    ['30 Oct 2026', "Members' own reports: plain facts, email plus Telegram, Current members only, no YouTube; YouTube and calendars become paid extras (AI-31 to AI-39)."],
    ['Open', 'Standard AI in Honcho plus Hermes as a premium Dedicated tier (the two-tier proposal).'],
    ['Open', "Is the standard AI included or paid, and does Honcho Lite get it? Which roles get reports at BPA by default? Confirm the never-sent data list and whether members are told admins use AI. The first tools for the connector and for changes."],
  ]},
]},

{ tab: "Not Included", blocks: [
  { type: 'ul', items: [
    "**iMessage** delivery (needs an Apple computer, not a server).",
    "**Claude subscriptions** powering Honcho's own AI (Anthropic's terms); Claude users get the connector (AI-25) instead.",
    "**Hermes agents** on the Honcho Cloud and shared-hosting tiers.",
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ["Administrator's Guide", 'Chapter 7, AI and the Daily Coffee Report'],
    ["Developer's Guide", 'Honcho AI chapter'],
    ['This book', 'Pricing and AI Billing (who pays for AI use)'],
    ['To-do list', 'Daily Coffee Report and AI connections'],
    ['Original plan, 29 Oct 2026', 'https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt'],
  ]},
]},

];
