// chapters/more.js — Honcho User's Guide: content, library, projects, system admin, staff

module.exports = {

content: [
  { tab: "What You Manage", blocks: [
    { type: 'p', text: "Content Admins decide what members see on the home page. Each item below has its own page under **Content Admin** in the side menu, with a list of posts and a button to add one." },
    { type: 'table', headers: ['Menu item', 'Where it shows on the home page'], rows: [
      ['**Marquee**', 'The scrolling line of short announcements across the top'],
      ['**Jumbotron**', 'The large featured area near the top, with a picture and a link'],
      ['**Bulletins**', "Members' bulletins (buy, sell, help wanted). You can approve, edit or remove any of them"],
      ['**Notices**', 'Announcements from the organization or a chapter'],
      ['**Job Posts**', 'Job openings, with a location'],
      ['**Activities**', 'Events, with start and end dates and times and a location'],
      ['**Chapters**', "Each chapter's entry on the Chapters page"],
    ]},
  ]},
  { tab: "Adding or Changing a Post", blocks: [
    { type: 'p', text: 'Every kind of post uses a similar form:' },
    { type: 'table', headers: ['Field', 'Notes'], rows: [
      ['**Title**', 'Keep it short; it shows in lists'],
      ['**Short description**', 'One or two lines shown in lists and on the home page'],
      ['**Full description**', 'Shown when someone opens the post'],
      ['**Photo**', 'Optional picture'],
      ['**Contact information**', 'Who to contact; you can show an alternate contact only'],
      ['**Who can see it**', '**Public**, **All Members** or **Chapter Only**'],
      ['**Dates**', 'Start and end dates for marquee items and activities'],
      ['**Active**', 'Untick to take a post down without deleting it'],
      ['**Approved**', "Posts from members stay hidden until this is set to Yes"],
    ]},
    { type: 'p', text: 'Click **Submit** to save. Only posts that are both **Active** and **Approved** appear on the home page.' },
    { type: 'alert', variant: 'warning', text: 'Deleting a post from a list can\'t be undone. To hide a post for now, untick **Active** instead.' },
  ]},
],

library: [
  { tab: "Finding Documents", blocks: [
    { type: 'p', text: "The Document Library stores BPA's documents: policies, minutes, forms and more. Open it from the **Doc Library** tile or menu item." },
    { type: 'p', text: "The list shows the documents you're allowed to see. Members see approved documents at or below their access level, from **Public** up through levels such as Leaders, Staff, Board and CEO." },
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
  { tab: "Adding a Document", blocks: [
    { type: 'p', text: 'If your role allows it, click the button to add a document:' },
    { type: 'ol', items: [
      'Choose whether this is a **record only** (no file, for example a note about a paper document) or **I will upload a file**.',
      'Fill in the title, subject, descriptions and author.',
      'Set the three labels (Organization, Category, Type), the access level and the priority.',
      'Choose the file to upload, if there is one, and save.',
    ]},
    { type: 'p', text: "If you upload a file with the same name as an existing one, the old file is kept as a backup rather than overwritten." },
  ]},
  { tab: "The Kanban Board", blocks: [
    { type: 'p', text: 'The kanban board shows documents moving from first draft to approval, one column per stage:' },
    { type: 'table', headers: ['Column', 'Meaning'], rows: [
      ['**Unrefined (not ready to work)**', 'An idea or rough draft. This column can be hidden'],
      ['**Backlog (ready to assign)**', 'Ready for someone to work on'],
      ['**In Progress**', 'Being drafted'],
      ['**In Review**', 'Final draft being reviewed'],
      ['**Pending Approval**', 'Waiting for approval'],
      ['**Approved**', 'Approved and published. This column can be hidden'],
    ]},
    { type: 'p', text: "Each card has buttons to move it to another stage, open it, or comment on it. When an approved document no longer needs to be on the board, mark it **Done** to take it off." },
    { type: 'h2', text: 'Comments, Holds and Rejections' },
    { type: 'ul', items: [
      'Add a **comment** to a document to give feedback; comments can be closed when dealt with.',
      'A document can be marked **on hold** or **blocked**, with a reason shown on the card.',
      'An approver can **reject** a document with a reason, or **approve** it, which clears any hold, block or rejection.',
    ]},
  ]},
],

projects: [
  { tab: "Projects (Add-on)", blocks: [
    { type: 'p', text: 'Projects is an add-on, so your organization may not have it. When it is turned on, open it from **PMS → Projects** in the side menu.' },
    { type: 'table', headers: ['Page', 'What you see', 'Who'], rows: [
      ['**My Projects**', 'Projects in Planning or Active status for your teams, and projects where you are the Product Owner', 'Everyone with Projects access'],
      ['**All Projects**', 'Every project in any status', 'Project admins'],
      ['**Teams**', 'Each team, how many members and projects it has', 'Project admins'],
    ]},
  ]},
  { tab: "Teams", blocks: [
    { type: 'ol', items: [
      'Open **Teams** and click the button to add a team. Give it a name (each active team needs a different one) and a description.',
      "Open the team and add people from the list. Adding someone gives them Projects access if they didn't have it.",
      'Remove a person from the team page when they leave it.',
    ]},
    { type: 'p', text: "A team can't be deleted while it still has projects in Planning or Active status. Complete, cancel or move those projects first." },
  ]},
  { tab: "Projects", blocks: [
    { type: 'p', text: 'To add a project, fill in:' },
    { type: 'table', headers: ['Field', 'Notes'], rows: [
      ['**Project name**', 'Required, up to 150 characters'],
      ['**Team**', 'The team doing the work'],
      ['**Product Owner**', 'The person who decides what the project delivers; can be left as none'],
      ['**Status**', '**Planning**, **Active**, **Complete** or **Cancelled**'],
      ['**Start and end dates**', "The end date can't be before the start date"],
      ['**Short description**', 'Up to 255 characters'],
    ]},
    { type: 'p', text: "If something is missing or wrong, the form shows what to fix and keeps what you typed. Team members and the Product Owner can open a project; others can't." },
  ]},
],

system: [
  { tab: "System Admin Pages", blocks: [
    { type: 'p', text: 'System Admins look after how Honcho is set up. These pages are under **System Admin** in the side menu.' },
    { type: 'table', headers: ['Menu item', 'What you do there'], rows: [
      ['**Member Permissions**', 'Every member\'s admin roles in one list (System, Member, Chapter and Student Admin). Click a box to give or remove a role'],
      ['**System Settings**', "Values that change how the system behaves, such as the current membership year, whether the Document Library shows its first and last kanban columns, and whether Projects is turned on. Only on installs without the staff portal (see below)"],
      ['**Font/Color Settings**', 'The sizes and colors offered in everyone\'s Display Size choices'],
      ['**Chapters**', 'Add and edit chapters'],
      ['**Auditlog**', 'A record of who did what and when: logins, changes, approvals and deletions. Only on installs without the staff portal (see below)'],
      ['**CCMPS Scopes**', 'The "who can see it" choices for posts'],
      ['**Developer Guide**', 'Technical documentation for whoever maintains Honcho'],
      ['**Master Spreadsheet**', 'Download every member as a spreadsheet'],
      ['**Projects**', 'The Projects add-on, when it is turned on'],
    ]},
    { type: 'alert', variant: 'info', text: "**Where System Settings and the Auditlog live.** When the Honcho staff portal is installed (as it is for BPA), these two pages are in the staff portal's **System Admin** menu, for staff system admins only, and they don't appear in the member menu. On a members-only install they're in the member **System Admin** menu." },
    { type: 'h2', text: 'Member Permissions' },
    { type: 'p', text: "Lists members with a checkbox for each admin role. It opens showing only members who hold a role; click **Show all members** to give someone a role for the first time. Clicking a box saves straight away, shows a confirmation at the top and is recorded in the Auditlog. The member sees the change the next time they log in." },
    { type: 'p', text: "You can't remove your own System Admin role, and there must always be at least one System Admin." },
    { type: 'alert', variant: 'warning', text: 'Changes to System Settings take effect for everyone straight away. Note the old value before changing one.' },
    { type: 'h2', text: 'Using the Audit Log' },
    { type: 'p', text: "Each entry shows the date and time (UTC), the person, the action and the record it touched. Use the search box to find all changes to one member or one document. The eye button opens one entry; the trash button deletes it (the deletion is itself logged)." },
  ]},
],

staff: [
  { tab: "The Staff Portal", blocks: [
    { type: 'p', text: "Employees use a separate staff login for the Honcho back office, not the member portal. After logging in they see a dashboard and a side menu with these sections: **Dashboard**, **DMS** (the Document Library), **CMS**, **Website CMS**, **People**, **Reports**, **System Configuration** and **Security**. Staff system admins also get **System Admin**, with **System Settings** and the **Auditlog** (described in Chapter 8)." },
    { type: 'p', text: 'The menu also links to the lists that other screens choose from: **Address Types**, **Bulk Actions** and **Post Scopes**. Changing an entry in one of these lists changes the choices everyone sees.' },
    { type: 'p', text: 'Staff with access to member records can switch to the member pages and use **Back to honcho** in the side menu to return.' },
    { type: 'p', text: 'A detailed staff guide will follow as the staff portal is updated.' },
  ]},
],

};
