// chapters/ai.js.js — plan chapter for the Honcho Planning Book (docs/plans).
// Converted 2026-10-30 from the online plan page: Honcho AI Assistant Plan (https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt)
// From now on this file is the master copy: change the plan here, rebuild with `node generate.js`,
// and republish the online page if it is still in use.

module.exports = [
 {
  "tab": "Overview",
  "blocks": [
   {
    "type": "p",
    "text": "Daily briefs, alerts and an \"Ask EMS\" assistant built into Honcho, with Hermes kept as a premium tier."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**The recommendation:** Build the AI into Honcho as a module that calls the model's API directly from PHP. It can only use a fixed set of Honcho functions (\"tools\"), runs as the admin who asked, under the same Security Groups, and logs to the same Auditlog. No second system on each server. Hermes becomes the higher tier for organizations that want general-purpose agents for the rest of their business. It reaches Honcho through a read-only MCP server instead of the database. The same MCP server doubles as a **Claude connector**: a client whose admins already pay for Claude (Team or Enterprise) adds Honcho to Claude.ai and asks questions there, on their own subscription. A subscription can't power Honcho's own AI (Anthropic's terms limit subscription logins to Claude.ai and Claude Code), so the built-in module uses an API key. ChatGPT is different: OpenAI now lets apps use a subscriber's plan (\"Sign in with ChatGPT\"), so admins could optionally connect their own ChatGPT account, if the organization allows it."
   }
  ]
 },
 {
  "tab": "Two tiers",
  "blocks": [
   {
    "type": "h3",
    "text": "Standard: Honcho AI"
   },
   {
    "type": "ul",
    "items": [
     "Morning brief by email, tailored to each admin's role and chapter",
     "Alerts when a rule trips (failed payment, document waiting too long)",
     "\"Ask EMS\" chat box: questions about members, renewals, documents, events",
     "Changes on request, always confirmed by the admin first",
     "Works in Honcho Lite too: it's just another module"
    ]
   },
   {
    "type": "h3",
    "text": "Premium: Hermes agents"
   },
   {
    "type": "ul",
    "items": [
     "Agents for work outside Honcho: research, writing, email, other systems",
     "Other channels (Telegram, WhatsApp, Slack) and long-running memory",
     "Several agents with different jobs, installable skills",
     "Reads Honcho through the same MCP server as the Claude connector, with the same permissions",
     "Separate install per client, priced accordingly"
    ]
   }
  ]
 },
 {
  "tab": "How it fits Honcho",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "**Module:** `modules/ai/`, an add-on switched on per client on the Security Groups Modules panel, like PMS. Its own Developer's Guide chapter and Users' Guide section.",
     "**Provider layer:** the module talks to the model through one small interface (send messages and tools, get text and tool calls back, report tokens), so the tools, permissions, confirm step and Auditlog stay the same whichever company answers. First provider: Anthropic, through the official PHP SDK (`composer require anthropic-ai/sdk`), key in `.env` as `ANTHROPIC_API_KEY`, one key per client so each client's spend is separate. Second, when OpenAI grants access: OpenAI, with an organization key or per-admin ChatGPT connections. Third, **Local model (OpenAI-compatible)**: a model such as Qwen served on the client's own server by llama.cpp or Ollama (no Hermes needed), entered as a server address and model name with no key. Member data never leaves the server; suited to the Dedicated tier and the HIPAA option. It needs a larger droplet (8 GB or more), runs on the CPU (minutes per report, too slow for chat) and writes less well than Haiku, so it's an option, not the default.",
     "**Per-admin connections (optional):** an admin clicks \"Connect ChatGPT\" on their profile and approves; Honcho stores the refreshing token encrypted and can revoke it. Their chat (and their own brief) then runs on their ChatGPT Plus or Pro plan, within the weekly limit they set. An organization setting switches this on or off, because member data then goes to the admin's personal AI account. Claude logins can't be used this way (Anthropic's terms); Claude users have the connector in phase 3.",
     "**PHP version:** the Mac and staging both run PHP 8.2, but `composer.json` still pins the platform to 7.4. Raise it to 8.2 first and check the SDK's minimum before installing.",
     "**Permissions:** new functions in Security Groups: `ai/use_chat`, `ai/receive_brief`, `ai/manage_ai`. Each tool also checks the function it needs (for example `ccmps/edit`) as the person asking.",
     "**Settings:** System Settings rows for AI on/off, model, monthly spend cap, brief time and recipients.",
     "**Log:** table `ai_requests`: who, which feature, tokens in/out, cost, outcome. It feeds the spend cap and a small usage page.",
     "**Scheduling:** cron inside the Honcho container (or the droplet) calls `ai/runbriefs` and `ai/runalerts` with a server-only token.",
     "**Email:** Brevo, with the key we just made."
    ]
   }
  ]
 },
 {
  "tab": "Using a ChatGPT subscription",
  "blocks": [
   {
    "type": "p",
    "text": "The AI Connections menu shows **\"OpenAI (ChatGPT): coming once OpenAI approves Honcho\"**. That refers to OpenAI's **\"Sign in with ChatGPT\"**, which lets an app use a person's paid ChatGPT plan. Two things stand between a ChatGPT plan and Honcho:"
   },
   {
    "type": "ol",
    "items": [
     "**OpenAI has to approve Honcho first.** For commercial, hosted apps like Honcho, access is by **waitlist**: the developer applies through OpenAI's interest form and gets an app ID once approved. (Open-source and locally run tools get it self-serve, which is why tools like OpenCode or Hermes can already use a plan.)",
     "**Honcho doesn't have the OpenAI connection yet.** The menu entry is there, greyed out; the code that talks to OpenAI comes once there's approval to test against."
    ]
   },
   {
    "type": "p",
    "text": "So a paid ChatGPT account can't be used in Honcho yet. The options:"
   },
   {
    "type": "table",
    "headers": [
     "Option",
     "Uses a ChatGPT plan?",
     "Available"
    ],
    "rows": [
     [
      "**Anthropic API key** (Haiku, Sonnet, Opus)",
      "No: pay per use, a fraction of a cent to a few cents per report",
      "**Now**"
     ],
     [
      "**OpenAI API key** (platform.openai.com)",
      "No: a separate pay-per-use account from the ChatGPT plan",
      "After the OpenAI connection is built (a modest job)"
     ],
     [
      "**Sign in with ChatGPT**",
      "**Yes**",
      "After OpenAI approves Honcho and the connection is built"
     ]
    ]
   },
   {
    "type": "p",
    "text": "**Recommended path:**"
   },
   {
    "type": "ul",
    "items": [
     "**Now:** an Anthropic key with Claude Haiku 5.5 to see AI-written reports, for pennies a month.",
     "**In the background:** apply to OpenAI's waitlist (search \"Sign in with ChatGPT\" on OpenAI's developer site), describing Honcho as \"a membership management platform where each admin can connect their own ChatGPT plan\".",
     "**Once approved:** build the OpenAI connection, with both an OpenAI API key and per-person \"Connect ChatGPT\", so an admin's own plan powers their AI use in Honcho."
    ]
   },
   {
    "type": "p",
    "text": "A Claude Pro/Max/Team subscription can't be used the same way: Anthropic allows those logins only in Claude.ai and Claude Code. Claude users get the Honcho connector instead (phase 3)."
   }
  ]
 },
 {
  "tab": "Phases",
  "blocks": [
   {
    "type": "p",
    "text": "Each phase ends with your sign-off, as with RBAC and Settings. Phases 1 to 4 only read data."
   },
   {
    "type": "ul",
    "items": [
     "**Phase 0: Groundwork:** Model provider account and key, spend cap set in the provider's console, PHP platform raised to 8.2, SDK installed, the provider layer, module skeleton, `ai_requests` table, settings rows, Security Groups functions, and a privacy note on what member data may be sent to the model.",
     "**Phase 1: Morning brief** (read only): Fixed queries gather the numbers (new and lapsed members, renewals due this month, documents awaiting approval, events this week, Sunshine posts). The model turns them into a short email per admin, limited to what that admin may see: a Chapter Admin gets their chapter, a Member Admin gets national figures. Sent through Brevo at a set time. The model only sees counts and names, never passwords, addresses or birthdays. Briefs can go through the Batch API at half price, because nobody waits on them. **Without an API key** the brief still goes out as plain numbers; the AI only writes them up.",
     "**Phase 2: Alerts** (read only): Rules checked every hour or night (dues payment failed, document waiting more than N days, chapter with no admin, member card reissued twice in a week). Rules need no AI at all; the model is used only to word or group them when there are several. Each admin chooses which alerts they get.",
     "**Phase 3: Honcho connector (read-only MCP server)** (read only): Moved up from last place. The read tools (`find_members`, `member_counts`, `renewals_due`, `documents_pending`, `upcoming_events`, `chapter_summary`) offered over MCP, with each admin signing in to Honcho so their own permissions apply. One server serves two uses: **Claude.ai custom connectors** for clients who bring their own Claude, and **Hermes agents** on the Dedicated tier. Honcho must be reachable from the internet; Anthropic still calls custom connectors a beta.",
     "**Phase 4: Ask EMS chat** (read only): A chat panel on the EMS dashboard, using the same read tools as the connector, for clients on the built-in AI. Answers link to the real screens. Every tool runs as the admin asking, so a Chapter Admin can't see other chapters through the AI.",
     "**Phase 5: Changes on request** (changes data): Tools that change data (`extend_membership`, `post_bulletin`, `approve_document`, `lock_account`) never act directly. The AI shows what it will do (\"Extend these 3 memberships to 2027?\") and the admin clicks Confirm. The change runs through Honcho's existing code, and the Auditlog records \"AI for <admin>\". Undo where the screen has undo. Built-in chat only at first; changes through the connector come later, if at all."
    ]
   }
  ]
 },
 {
  "tab": "Safety rules",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "**Never more than the person asking.** No tool bypasses `rbac_allowed()`; no direct SQL from the model; the model never sees the database.",
     "**Every change is confirmed** by a person and logged. Nothing changes data from a brief or an alert.",
     "**Member-written text is untrusted.** Bulletin posts, notes and comments are passed to the model as data, marked as such; instructions inside them are ignored, and the confirm step catches anything that slips through.",
     "**Least data.** Each tool returns only the fields its job needs. Passwords, codes, card secrets, birthdays and home addresses never go to the model.",
     "**Off switch.** One setting turns the AI off for a client; reaching the monthly cap pauses it and emails the System Admin."
    ]
   }
  ]
 },
 {
  "tab": "Model and cost",
  "blocks": [
   {
    "type": "p",
    "text": "Starting point: Claude Opus 5.5, the current default model. Cheaper models are a choice to make after testing real briefs, not before. Prices per million tokens of text in and out:"
   },
   {
    "type": "table",
    "headers": [
     "Model",
     "In",
     "Out",
     "Use"
    ],
    "rows": [
     [
      "Claude Opus 5.5",
      "$4.00",
      "$20.00",
      "Default for chat and changes"
     ],
     [
      "Claude Sonnet 5.5",
      "$2.00",
      "$10.00",
      "Candidate for briefs if quality holds"
     ],
     [
      "Claude Haiku 5.5",
      "$0.10",
      "$0.50",
      "Candidate for wording alerts"
     ]
    ]
   },
   {
    "type": "p",
    "text": "Rough monthly estimate for BPA on Opus 5.5 (to be measured in phase 1):"
   },
   {
    "type": "table",
    "headers": [
     "Feature",
     "Assumption",
     "Per month"
    ],
    "rows": [
     [
      "Morning brief",
      "10 admins, about 3,000 tokens in and 800 out each, every day; half price through the Batch API",
      "about $5"
     ],
     [
      "Alerts",
      "Rules only; the model words a few summaries a day",
      "under $2"
     ],
     [
      "Ask EMS chat",
      "About 200 questions a month at 5 to 10 cents each (tool descriptions cached)",
      "$10 to $20"
     ]
    ]
   },
   {
    "type": "p",
    "text": "Cost controls: the provider console's spend limit per key, Honcho's own monthly cap from `ai_requests`, prompt caching for the fixed instructions and tool list, and the Batch API for briefs."
   }
  ]
 },
 {
  "tab": "Roadmap changes",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "The DigitalOcean cards DO-10 to DO-17 (install Hermes on every droplet, move the Coffee Brief scripts, read-only MySQL user, reporting views, stats skill) move to the **premium tier**. The reporting queries from DO-14 are reused by the morning brief.",
     "Your own Daily Coffee Report can stay on Hermes; it's a separate product from the clients' morning brief.",
     "New board cards for phases 0 to 5 once you sign off. The MCP server now comes before the built-in chat; per-admin ChatGPT follows OpenAI's approval."
    ]
   }
  ]
 },
 {
  "tab": "Decisions for you",
  "blocks": [
   {
    "type": "ol",
    "items": [
     "**Provider account:** one Anthropic account per client (their bill, their key) or one Honcho account resold with usage passed on?",
     "**Included or paid:** is the standard AI included in Honcho, or a paid option above the base price? Does Honcho Lite get it?",
     "**Who gets briefs at BPA:** which roles by default (System, Member, Chapter Admins), and what time?",
     "**Member data:** confirm the \"never sent\" list above, and whether members are told the portal uses AI for admins.",
     "**First tools:** the read tools in phase 3 and write tools in phase 4 are a starting list; add or remove.",
     "**Per-admin ChatGPT:** join OpenAI's \"Sign in with ChatGPT\" waitlist now (commercial apps need approval), and offer it behind an organization setting once approved?",
     "**Local model:** add the \"Local model (OpenAI-compatible)\" connection type for Dedicated-tier and privacy-sensitive clients, after the OpenAI provider (they share the same request format)?",
     "**Claude connector:** build the MCP server as phase 3 (it serves both \"bring your own Claude\" clients and the Hermes tier), as now proposed?"
    ]
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "Nothing is built yet. On sign-off: phase 0 first, then the morning brief, which is the quickest thing to show and only reads data."
   }
  ]
 }
];
