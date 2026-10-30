// ============================================================
// guide.js — table of contents for Honcho Requirements (was the Planning Book)
// ============================================================
// Honcho's high-level requirements and every plan in one downloadable document
// (created 2026-10-30). Each feature chapter has the same shape: Purpose,
// Requirements (numbered, never renumbered, each Built / In progress / Planned /
// Changed / Not working, checked against the code), Business Rules, Known
// Problems, Decisions, Related Documents. Chapters still in plan form carry a
// Status section written here (status: lines) until they are converted.
// The last chapter is built from docs/todo.md at build time (todo: true).
// Build with:  node generate.js   (needs the docx npm package)
// Private: pricing and business plans. Not exported to the Help pages.
// Chapter numbers are cited in chapters/overview.js: keep them in step.
// ============================================================

const guide = [

  { part: 'Part I: Overview', chapters: [
    { title: 'About This Book',                  sections: require('./chapters/overview.js') },          // 1
  ]},

  { part: 'Part II: Core Features', chapters: [
    { title: 'Signing In and Accounts',          sections: require('./chapters/logins.js') },            // 2  LOGIN
    { title: 'Permissions and Security Groups',  sections: require('./chapters/permissions.js') },       // 3  PERM
    { title: 'Member Records',                   sections: require('./chapters/members.js') },           // 4  MEM
    { title: 'Digital Membership Cards',         sections: require('./chapters/member-cards.js') },      // 5  CARD
    { title: 'System Settings and Branding',     sections: require('./chapters/settings.js') },          // 6  SET
    { title: 'Document Library',                 sections: require('./chapters/library.js') },           // 7  DOC
    { title: 'Member Home and Website',          sections: require('./chapters/website.js') },           // 8  WEB
    { title: 'Help and Guides',                  sections: require('./chapters/help.js') },              // 9  HELP
  ]},

  { part: 'Part III: Add-ons and Coming Modules', chapters: [
    { title: 'Honcho AI and the Coffee Report', sections: require('./chapters/ai.js') },                // 10 AI
    { title: 'Payments, Financial and Store',    sections: require('./chapters/financial-store.js'),     // 11 (plan form)
      status: [
        "**Status:** decisions made 2026-10-30 (below). Nothing built yet; F0, the payment base, is next. Money work comes before the Scheduler.",
        "**Online copy:** https://claude.ai/artifact/LYApDeBVM3JrM3szqaSAuR",
        "**Found since the plan (30 Oct):** renewing a member already creates a National dues record (Member Records, MEM-20), but nothing marks it received (MEM-21), so renewed members stay Pending. F1 must include National's way of recording dues received.",
        "**Also decided:** Point of Sale is the final part of the Financial module; a separate Reporting module starts with gathering requirements (see the to-do list).",
      ] },
    { title: 'Scheduler',                        sections: require('./chapters/scheduler.js'),           // 12 (plan form)
      status: [
        "**Status:** decisions made 2026-10-30 (below). Nothing built yet; starts after the money work, and its invoicing needs the Financial add-on.",
        "**Online copy:** https://claude.ai/artifact/GyZQrdzfn2B197iL6GvRvD",
      ] },
  ]},

  { part: 'Part IV: The Business', chapters: [
    { title: 'Pricing and AI Billing',           sections: require('./chapters/pricing.js'),             // 13 (plan form)
      status: [
        "**Status:** options written 2026-10-29; decisions not yet made (see Decisions for you).",
        "**Online copy:** https://claude.ai/artifact/3kynSEzd98AwCh2fJDBmpV",
        "**Since then:** the AI connection screens (built) let each scope enter its own key and monthly limit, which is option B per scope; usage by chapter is on the AI Usage page.",
      ] },
  ]},

  { part: 'Part V: The Project To-Do List', chapters: [
    { title: 'Project To-Do List',               todo: true },                                          // 14
  ]},

];

module.exports = guide;
