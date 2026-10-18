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
    // Planned: CMS & Welcome — the modules/cms/ content shown on
    // ccmphome (marquee, jumbotron, bulletins, notices, jobs, activities,
    // library) and the public-facing page in the welcome parent module.
  ]},

  { part: 'Part II: Add-ons', chapters: [
    { title: 'PMS (Project Management)',     sections: require('./chapters/pms.js') },
    // Planned: Participants — branded per client from a system_settings
    // row (e.g. "Student" for BPA); members who join programs but rarely
    // renew, kept out of the ccmps table. Seeded from ccmps_type = 4.
  ]},

  { part: 'Part III: Installation & Configuration', chapters: [
    { title: 'Deploying on DigitalOcean',    sections: require('./chapters/deployment.js') },
    // Planned: Configuration — the config folder, defaults, and what
    // to change for a new client.
  ]},

];

module.exports = guide;
