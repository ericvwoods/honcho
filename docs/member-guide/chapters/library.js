// chapters/library.js — Honcho Member Guide: the Document Library (moved from more.js 2026-10-29)
// Same block format and inline markup as docs/developer-guide/chapters/*.js

module.exports = [
  { tab: "Finding Documents", blocks: [
    { type: 'p', text: "The Document Library stores BPA's documents: policies, minutes, forms and more. Open it from the **Doc Library** tile or menu item. The button at the top takes you back: **Home** when you came from the member home, **Dashboard** when you came from the EMS (admin) menu." },
    { type: 'p', text: "The list shows the documents you're allowed to see. Members see approved documents at or below their access level, from **Public** up through levels such as Leaders, Staff, Board and CEO, and can open and download them. Chapter Admins also see all of their own chapter's documents and can manage them; Member System Admins and staff document admins see and manage everything. Who can do what is set on the **Security Groups** page." },
    { type: 'h2', text: 'Filters' },
    { type: 'p', text: 'Narrow the list with the filters above it and click the filter button. Each document is labeled three ways, which makes it easy to find:' },
    { type: 'table', headers: ['Label', 'Example'], rows: [
      ['**Organization**', 'Which organization or school the document belongs to'],
      ['**Category**', 'What it is about'],
      ['**Type**', 'What kind of document it is'],
    ]},
    { type: 'p', text: "You can also filter by chapter, file format, region, lead, access level, staff member, member and department." },
    { type: 'h2', text: 'Opening a Document' },
    { type: 'p', text: "Click a document to see its details. From there you can preview it in the browser or download it." },
  ]},
];
