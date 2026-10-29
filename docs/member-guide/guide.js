// ============================================================
// guide.js — table of contents for the Honcho Member Guide
// ============================================================
// For every member (renamed from the Users' Guide 2026-10-29; the admin
// chapters moved to docs/admin-guide). Build with:
//   node generate.js   (needs the docx npm package)
// Written for the BPA deployment (Member / Chapter wording).
// ============================================================

const guide = [

  { part: 'Part I: Getting Started', chapters: [
    { title: 'Getting Started',                 sections: require('./chapters/getting-started.js') },
  ]},

  { part: 'Part II: Using the Member Portal', chapters: [
    { title: 'For Every Member',                sections: require('./chapters/members.js') },
    { title: 'Document Library',                sections: require('./chapters/library.js') },
  ]},

];

module.exports = guide;
