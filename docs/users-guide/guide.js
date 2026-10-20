// ============================================================
// guide.js — table of contents for the Honcho User's Guide
// ============================================================
// Same structure as docs/developer-guide/guide.js. Build with:
//   node generate.js   (needs the docx npm package)
// Written for end users of the BPA deployment (Member / Chapter wording).
// ============================================================

const more = require('./chapters/more.js');
const admins = require('./chapters/admins.js');

const guide = [

  { part: 'Part I: Getting Started', chapters: [
    { title: 'Getting Started',                 sections: require('./chapters/getting-started.js') },
  ]},

  { part: 'Part II: Using the Member Portal', chapters: [
    { title: 'For Every Member',                sections: require('./chapters/members.js') },
    { title: 'Chapter Admins',                  sections: admins.chapterAdmins },
    { title: 'Member Admins',                   sections: admins.memberAdmins },
    { title: 'Website (Home Page Content)',     sections: more.content },
    { title: 'Document Library',                sections: more.library },
  ]},

  { part: 'Part III: Add-ons', chapters: [
    { title: 'Projects',                        sections: more.projects },
  ]},

  { part: 'Part IV: Administration', chapters: [
    { title: 'System Admins',                   sections: more.system },
    { title: 'The Staff Portal',                sections: more.staff },
  ]},

];

module.exports = guide;
