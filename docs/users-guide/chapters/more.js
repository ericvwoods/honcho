// chapters/more.js — Honcho User's Guide: content, library, projects, system admin, staff

module.exports = {

content: [
  { tab: "What You Manage", blocks: [
    { type: 'p', text: "Content Admins (and System Admins) decide what the member home page and the public website show. Open **Website** in the side menu, or the Website tiles on the Admin page. Staff with the Content Admins Security Group see **Website** in the staff menu and use the same pages." },
    { type: 'table', headers: ['Page', 'What it does'], rows: [
      ['**Page Sections**', 'Every section of the page, top to bottom: the picture slider, feature boxes, team, timeline, quotes, prices, contact details, and the Sunshine, Bulletin Board, Calendar, Marquee, Careers and member-numbers sections. Show or hide each one on the member home and on the public website, drag sections into a new order, and change headings'],
      ['**Items**', 'The pieces inside a section, such as the slides in the slider or the people in Team'],
      ['**Pictures**', 'Upload pictures once, then choose them for any slide or item'],
      ['**Sunshine**', 'Illnesses, recoveries and passings: a name, the news, more details, a photo'],
      ['**Bulletin Board**', 'Short notes shown as coloured sticky notes'],
      ['**Marquee**', 'One-line announcements that scroll across the page'],
      ['**Careers**', 'Job postings. Each has its own page with the full description and an Apply button'],
      ['**Events**', 'The events calendar (Event Admins and System Admins: every event; Chapter Admins: their own chapter\'s events, under **Chapter Events** in the Chapter Admin menu)'],
    ]},
    { type: 'p', text: "What you enter shows on the lower part of the member home page, below the member tiles, in the order of the Page Sections list. A menu bar across the top of that part has a link for each section that has a menu label; clicking one scrolls down to it. A section that is switched off, or has nothing in it yet, doesn't show at all." },
    { type: 'p', text: "**The public website** uses the same sections, for anyone, without logging in. It shows only the sections whose **Public website** box is ticked, the Sunshine, Bulletin Board, Marquee and Careers posts ticked **Also on the public website**, and the events ticked **Public**. Member numbers never show there. Its menu has a **Member Login** button. Your system administrator decides whether the website is the site's front page; until then it can be viewed at the address ending in `welcome/website`." },
    { type: 'alert', variant: 'info', text: "The old Notices and Activities pages are gone: put announcements in the Marquee or on the Bulletin Board, and activities on the events calendar." },
  ]},
  { tab: "Events Calendar", blocks: [
    { type: 'p', text: "The Calendar section of the member home shows every chapter's events: national events in green, your own chapter's in blue and other chapters' in grey. Members can switch between **Month**, **Week** and **List**, and click an event to see its details and its button (for example **Register**). On a phone the calendar opens as a list." },
    { type: 'ul', items: [
      "**Who adds events:** Event Admins and System Admins add and change any event, national or for any chapter (**Website → Events**). Chapter Admins add and change their own chapter's events (**Chapter Admin → Chapter Events**, or the Events tile on the Admin page); their events are always saved to their chapter.",
      "**Adding one:** click **Add an Event**. Give it a title and a start date; the start time, end date and end time are optional. Tick **All day** for an event without times. Add a location, a short description (shown in the details), a full description, a picture and a link with a button label if you like.",
      "**Public:** tick it to also show the event on the public website's calendar, once the public site is built.",
      "The list shows upcoming events; **Show past events** lists the ones that are over. **Delete** asks first and can't be undone.",
    ]},
  ]},
  { tab: "Page Sections", blocks: [
    { type: 'ul', items: [
      "**Show or hide:** tick or untick a section's **Member home** or **Public website** box. It saves straight away and a message at the top confirms it. Some sections, such as the member numbers, are for the member home only.",
      "**Order:** drag a row by its handle (the three lines on the left) to a new place. The new order saves when you let go.",
      "**Edit:** change the section's **heading**, an optional **subtitle**, and its **menu label**: the link in the page's top menu that scrolls down to the section. Leave the label blank for no link.",
      "**Items:** sections you fill yourself have an **Items** button. Sections such as Sunshine or Careers get their content from their own pages instead.",
    ]},
  ]},
  { tab: "Items", blocks: [
    { type: 'p', text: "The item form only shows the boxes that section uses, with labels that say what each is for (for example **Headline** and **Button link** for a slide, or **Name**, **Role** and **Photo** for a team member)." },
    { type: 'ul', items: [
      "**Picture:** click **Choose a Picture** and pick one from the library. Upload new pictures on the Pictures page first. **No Picture** removes it.",
      "**Icon:** a Font Awesome name such as `fa-plane`; a preview shows next to the box.",
      "**Links** start with `https://`, `mailto:` or `tel:`, or `/` for a page on this site, or `#` for a section of the page.",
      "**Shown:** untick to hide an item without deleting it. You can also tick or untick it on the Items list.",
      "Drag items on the list to change their order. **Delete** asks first and can't be undone.",
    ]},
  ]},
  { tab: "Sunshine, Bulletin Board, Marquee, Careers", blocks: [
    { type: 'p', text: "Each has a list (open it from the **Website** menu, or **Posts** on the Page Sections list) and an **Add** button. The form only asks for what that kind of post uses." },
    { type: 'ul', items: [
      "**" + "Chapter" + ":** leave it on **National (everyone)**, or choose a chapter to show the post to that chapter's members only.",
      "**Show from / until:** both optional. A post appears on its start date and disappears after its end date by itself; blank means now and no end. The list's **Today** column says whether each post is showing, waiting to start, or ended.",
      "**Shown:** untick to take a post down at once without deleting it. **Also on the public website** lets it appear there once the public site is built and its section is switched on for it.",
      "New posts go to the top of the list; drag rows to change the order.",
      "**Careers:** the short description shows in the list; the full description, employer and location, picture, closing date and **Apply** button show on the job's own page.",
    ]},
  ]},
  { tab: "Pictures", blocks: [
    { type: 'ul', items: [
      "Click **Choose Files**, pick one or more JPEG, PNG, GIF or WebP pictures (up to 10 MB each), then **Upload**. Very wide pictures are made smaller automatically so the page loads quickly.",
      "Give each picture a short **description** of what it shows. Screen readers read it aloud to people who can't see the picture. It saves when you click out of the box.",
      "Each picture shows how many times it's used. A picture can only be deleted when nothing uses it.",
    ]},
  ]},
],

library: [
  { tab: "Finding Documents", blocks: [
    { type: 'p', text: "The Document Library stores BPA's documents: policies, minutes, forms and more. Open it from the **Doc Library** tile or menu item." },
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
      ['**Member Permissions**', 'Every member\'s admin roles in one list (System, Member, Chapter, Student, Content and Event Admin). Click a box to give or remove a role'],
      ['**System Settings**', "Values that change how the system behaves, such as the current membership year, whether the Document Library shows its first and last kanban columns, and the colors and labels used across the site. Only on installs without the staff portal (see below)"],
      ['**Font/Color Settings**', 'The sizes and colors offered in everyone\'s Display Size choices'],
      ['**Chapters**', 'Add and edit chapters'],
      ['**Auditlog**', 'A record of who did what and when: logins, changes, approvals and deletions. Only on installs without the staff portal (see below)'],
      ['**Security Groups**', 'Groups of people and the functions each group may use. Only on installs without the staff portal (see below)'],
      ['**CCMPS Scopes**', 'The "who can see it" choices for posts'],
      ['**Developer Guide**', 'Technical documentation for whoever maintains Honcho'],
      ['**Master Spreadsheet**', 'Download every member as a spreadsheet'],
    ]},
    { type: 'alert', variant: 'info', text: "**Where System Settings, the Auditlog and Security Groups live.** When the Honcho staff portal is installed (as it is for BPA), these three pages are in the staff portal's **System Admin** menu, for staff system admins only, and they don't appear in the member menu. On a members-only install they're in the member **System Admin** menu. Projects is part of the staff portal, so it isn't in the member menu." },
    { type: 'h2', text: 'Member Permissions' },
    { type: 'p', text: "Lists members with a checkbox for each admin role. It opens showing only members who hold a role; click **Show all members** to give someone a role for the first time. Clicking a box saves straight away, shows a confirmation at the top and is recorded in the Auditlog. The member sees the change the next time they log in. Each box is a membership of a Security Group (Member System Admins, Member Admins, Chapter Admins, Student Admins), so the same change shows on the Security Groups page. If a member also gets a role from another group, the box can't be cleared here; the message says so." },
    { type: 'p', text: "You can't remove your own System Admin role, and there must always be at least one System Admin." },
    { type: 'alert', variant: 'warning', text: 'Changes to System Settings take effect for everyone straight away. Note the old value before changing one.' },
    { type: 'h2', text: 'Security Groups' },
    { type: 'p', text: "A group is a named set of people, such as \"PM Admins\", together with the functions they may use. Click **New group** to create one, then use its **Privileges** button to tick its functions (one panel per module, with **Select all**) and its **Members** button to add people. Anyone with a login can be added; someone with both a member and a staff login appears twice. A person gets everything any of their groups allows, and a change works on their next click." },
    { type: 'p', text: "**Effective access** shows one person's groups and every function they end up with. **Deactivate** switches a group off without losing its settings. Every change is recorded in the Auditlog." },
    { type: 'p', text: "The **Modules** panel on the same page switches an add-on, such as Projects, on or off for everyone. When Projects is off, its pages and its menu item disappear." },
    { type: 'alert', variant: 'info', text: "Security Groups are new (October 2026). The modules move over to them one at a time, starting with Projects, which already uses them: whoever is in **PM Admins** or **PM Users** can open Projects, and adding someone to a project team gives them PM User access. Until a module has moved, its own permission settings still decide who can do what." },
    { type: 'h2', text: 'Using the Audit Log' },
    { type: 'p', text: "Each entry shows the date and time (UTC), the person, the action and the record it touched. Use the search box to find all changes to one member or one document. The eye button opens one entry; the trash button deletes it (the deletion is itself logged)." },
  ]},
],

staff: [
  { tab: "The Staff Portal", blocks: [
    { type: 'p', text: "Employees use a separate staff login for the Honcho back office, not the member portal. After logging in they see a dashboard and a side menu with these sections: **Dashboard**, **DMS** (the Document Library), **PMS** (Projects), **CMS**, **Website CMS**, **People**, **Reports**, **System Configuration** and **Security**. Staff system admins also get **System Admin**, with **System Settings**, the **Auditlog** and **Security Groups** (described in Chapter 8)." },
    { type: 'p', text: 'The menu also links to the lists that other screens choose from: **Address Types**, **Bulk Actions** and **Post Scopes**. Changing an entry in one of these lists changes the choices everyone sees.' },
    { type: 'p', text: 'Staff with access to member records can switch to the member pages and use **Back to honcho** in the side menu to return.' },
    { type: 'p', text: 'A detailed staff guide will follow as the staff portal is updated.' },
  ]},
],

};
