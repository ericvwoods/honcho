// ============================================================
// guide.js — table of contents for the Honcho Planning Book
// ============================================================
// Every plan in one downloadable document (created 2026-10-30). Each plan
// chapter starts with a Status section written here (status: blocks), then
// the plan itself from chapters/<plan>.js. The last part is built from
// docs/todo.md at build time (todo: true). Build with:
//   node generate.js   (needs the docx npm package)
// Private: pricing and business plans. Not exported to the Help pages.
// ============================================================

const guide = [

  { part: 'Part I: Overview', chapters: [
    { title: 'All the Plans',                     sections: require('./chapters/overview.js') },          // 1
  ]},

  { part: 'Part II: The Business', chapters: [
    { title: 'Pricing and AI Billing',           sections: require('./chapters/pricing.js'),              // 2
      status: [
        "**Status:** options written 2026-10-29; decisions not yet made (see Decisions for you).",
        "**Online copy:** https://claude.ai/artifact/3kynSEzd98AwCh2fJDBmpV",
        "**Since then:** the AI connection screens (built) record each scope's own key and monthly limit, which is option B per scope; usage by chapter is on the AI Usage page.",
      ] },
  ]},

  { part: 'Part III: Modules', chapters: [
    { title: 'Honcho AI Assistant',              sections: require('./chapters/ai.js'),                   // 3
      status: [
        "**Status:** phases 0 and 1 built 2026-10-29 on the Mac, not yet deployed: AI connections by scope (National and each chapter), the credential vault, usage and limits, and the Daily Coffee Report (email and Telegram, plus a Sports section). The two-tier recommendation is awaiting sign-off.",
        "**Online copy:** https://claude.ai/artifact/CNVNAd9y2V41kTnPu4Z3mt",
        "**Changed since the plan:** phase 1 became the Daily Coffee Report, ported from Eric's Python design; the AI only writes it up and a plain report goes out without it. Still open: email warnings at 50/80/100% of a limit, the OpenAI provider (waiting on OpenAI's approval), and the local-model connection type.",
      ] },
    { title: 'Digital Membership Cards',         sections: require('./chapters/member-cards.js'),         // 4
      status: [
        "**Status:** decisions made 2026-10-26 (the plan's recommendations; Google Wallet now, Apple Wallet and event registration later). Phase 1 built: My Card page, phone app Card tab, cancel and reissue.",
        "**Online copy:** https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc",
        "**Next:** phase 2 door check-in, then the Google Wallet button (Eric creates the issuer account first). Only 14 of 1,725 members have a photo, which weakens the photo check at the door.",
      ] },
    { title: 'Payments, Financial and Store',    sections: require('./chapters/financial-store.js'),      // 5
      status: [
        "**Status:** decisions made 2026-10-30 (below). Nothing built yet; F0, the payment base, is next. Money work comes before the Scheduler.",
        "**Online copy:** https://claude.ai/artifact/LYApDeBVM3JrM3szqaSAuR",
        "**Also decided:** Point of Sale is the final part of the Financial module; a separate Reporting module starts with gathering requirements (Chapter 7).",
      ] },
    { title: 'Scheduler',                        sections: require('./chapters/scheduler.js'),            // 6
      status: [
        "**Status:** decisions made 2026-10-30 (below). Nothing built yet; starts after the money work, and its invoicing needs the Financial add-on.",
        "**Online copy:** https://claude.ai/artifact/GyZQrdzfn2B197iL6GvRvD",
      ] },
  ]},

  { part: 'Part IV: The Project To-Do List', chapters: [
    { title: 'Project To-Do List',               todo: true },                                           // 7
  ]},

];

module.exports = guide;
