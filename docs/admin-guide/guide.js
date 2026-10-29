// ============================================================
// guide.js — table of contents for the Honcho Administrator's Guide
// ============================================================
// For Chapter, Member, Student, Content, Event, Financial and System Admins and
// staff (created 2026-10-29: admin chapters moved from the Users' Guide, plus
// Getting Started as an Admin and AI and the Coffee Report). Build with:
//   node generate.js   (needs the docx npm package)
// Chapter numbers are referenced in the text ("see Chapter 6"): keep them in step.
// ============================================================

const more = require('./chapters/more.js');
const admins = require('./chapters/admins.js');

const guide = [

  { part: 'Part I: Getting Started', chapters: [
    { title: 'Getting Started as an Admin',     sections: require('./chapters/getting-started.js') },   // 1
  ]},

  { part: 'Part II: Running the Organization', chapters: [
    { title: 'Chapter Admins',                  sections: admins.chapterAdmins },                       // 2
    { title: 'Member Admins',                   sections: admins.memberAdmins },                        // 3
    { title: 'Website (Home Page Content)',     sections: more.content },                               // 4
    { title: 'Document Library',                sections: more.library },                               // 5
  ]},

  { part: 'Part III: System Setup', chapters: [
    { title: 'System Admins',                   sections: more.system },                                // 6
    { title: 'AI and the Daily Coffee Report',  sections: require('./chapters/ai.js') },                // 7
  ]},

  { part: 'Part IV: Add-ons and Staff', chapters: [
    { title: 'Projects',                        sections: more.projects },                              // 8
    { title: 'The Staff Portal',                sections: more.staff },                                 // 9
  ]},

];

module.exports = guide;
