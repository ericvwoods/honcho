// ============================================================
// guide.js — table of contents for the Honcho Developer's Guide
// ============================================================
// Parts and chapters, in the order they appear in the Word file.
// Each chapter's content lives in its own file under chapters/
// (same block format as before: tab → blocks).
//
// To add a chapter: create chapters/<name>.js, then add a line
// to the right part below.
// ============================================================

const guide = [

  { part: 'Part I: Core Product', chapters: [
    { title: 'CCMPS (Members)',              sections: require('./chapters/ccmps.js') },
    { title: 'DMS (Document Management)',    sections: require('./chapters/dms.js') },
    { title: 'Security (RBAC)',              sections: require('./chapters/security.js') },
    { title: 'Website (CMS)',                sections: require('./chapters/cms.js') },
    // Planned: Welcome — login, logout, second factor, mobile bridge,
    // and the public website (phase 6 of the Website chapter).
  ]},

  { part: 'Part II: Add-ons', chapters: [
    { title: 'PMS (Project Management)',     sections: require('./chapters/pms.js') },
    { title: 'Honcho AI',                    sections: require('./chapters/ai.js') },
    // Planned: Participants — branded per client from a system_settings
    // row (e.g. "Student" for BPA); members who join programs but rarely
    // renew, kept out of the ccmps table. Seeded from ccmps_type = 4.
  ]},

  { part: 'Part III: Installation & Configuration', chapters: [
    { title: 'Developer Workstation (VS Code & Claude Code)', sections: require('./chapters/workstation.js') },
    { title: 'Deploying on DigitalOcean',    sections: require('./chapters/deployment.js') },
    { title: 'Configuration',                sections: require('./chapters/configuration.js') },
    { title: 'Conventions',                  sections: require('./chapters/conventions.js') },
  ]},

];

module.exports = guide;
