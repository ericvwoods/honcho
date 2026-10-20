// chapters/admins.js — Honcho User's Guide: Chapter Admins and Member Admins

const memberList = [
  { type: 'h2', text: 'Working With the Member List' },
  { type: 'p', text: 'Every member list works the same way. Each row has buttons at the right:' },
  { type: 'table', headers: ['Button', 'What it does'], rows: [
    ['**View Record**', "Opens the member's profile, read-only"],
    ['**Update Record**', "Opens the member's profile for editing; click **Save Changes** when done"],
    ['**Delete Record**', 'Removes the member from the active lists. This can be undone'],
    ['**Undelete Record**', 'Shown on deleted members: brings the member back'],
    ['**Permanently Delete**', 'Shown on deleted members: removes the member and all their records for good. This cannot be undone'],
  ]},
  { type: 'p', text: 'Use the search box above the list to find a member, and click a column heading to sort.' },
  { type: 'h3', text: 'Bulk Actions' },
  { type: 'p', text: 'To change many members at once, tick the box on each row (or **Select** at the top to tick them all), choose an action from the **Bulk Actions** list below the table and click **Submit**.' },
  { type: 'table', headers: ['Action', 'What it does'], rows: [
    ['**Current Year**', "Marks the ticked members as members for the current year"],
    ['**User Acct**', "Creates a login account for each ticked member who doesn't have one"],
    ['**Delete**', 'Deletes the ticked members (can be undone one at a time with Undelete Record)'],
  ]},
  { type: 'p', text: "**Lock**, **Unlock**, **Approve User Acct**, **Approve CCMPS** and **Archive** also appear in the list but don't do anything yet." },
  { type: 'h3', text: 'Locking a Member' },
  { type: 'p', text: "To stop a member logging in without deleting them, open them with **Update Record**, tick **Locked** in **Roles & Permissions** and save (System Admins only). When they try to log in they see \"Your account has been locked. Please contact your Chapter Administrator.\" Untick **Locked** to let them back in." },
  { type: 'h3', text: 'Marking a Member Deceased' },
  { type: 'p', text: "Open the member with **Update Record**, go to **Admin Notes**, tick **Deceased** and click **Save Changes**. When you save:" },
  { type: 'ul', items: [
    "They can no longer log in, on the website or the phone app.",
    "Every admin role the member had (System, Member, Chapter, Student, Content or Event Admin) is taken away, and they're removed from all Security Groups, including access to the Document Library.",
    "They no longer appear on the chapter roster, the national directory, the treasurer's spreadsheet or the member counts.",
    "Their record isn't deleted. You can still find it in the member list.",
    "An email address isn't needed to save the record.",
  ]},
  { type: 'alert', variant: 'info', text: "Unticking Deceased lets the member log in again, but doesn't give their roles back. If it was a mistake, give the member their roles again." },
];

module.exports = {

chapterAdmins: [
  { tab: "Your Chapter Admin Pages", blocks: [
    { type: 'p', text: "If you're a Chapter Admin, the side menu has a **Chapter Admin** section, and the home page's **Admin** tile shows **Chapter Administration**. Everything here is limited to your own chapter." },
    { type: 'table', headers: ['Menu item', 'What you do there'], rows: [
      ['**Chapter Members**', "See and manage your chapter's members"],
      ['**Student Members**', "Your chapter's student members"],
      ['**Doc Library**', "Your chapter's documents in the Document Library (Chapter 6): add and edit them, move them on the kanban board, approve, hide or delete them, and manage comments. You can only change your own chapter's documents, and anything you add is saved to your chapter."],
      ['**Export Members**', "Download your chapter's members as a spreadsheet"],
    ]},
  ]},
  { tab: "Managing Chapter Members", blocks: memberList.concat([
    { type: 'h2', text: 'Adding a Member' },
    { type: 'p', text: "Click the button to add a member above the list, fill in their details and save. To let them log in, either tick them and use the **User Acct** bulk action, or create the account from their record. They'll be asked to choose a new password the first time they log in." },
  ])},
  { tab: "Chapter Posts", blocks: [
    { type: 'p', text: "The old Chapter Bulletins, Chapter Notices, Job Posts and Chapter Activities pages were retired in October 2026 while the home page is rebuilt. For now, ask a Content Admin to post Sunshine, Bulletin Board, Marquee or Careers items for your chapter (Chapter 5); they can limit a post to your chapter." },
    { type: 'p', text: "**Chapter Events:** add and change your chapter's events on the events calendar from **Chapter Events** in the Chapter Admin menu (or the Events tile on the Admin page). Every member sees them on the calendar, marked with your chapter's name; tick **Public** to also show one on the public website. See Chapter 5, Events Calendar." },
  ]},
],

memberAdmins: [
  { tab: "Your Member Admin Pages", blocks: [
    { type: 'p', text: "Member Admins manage membership across every chapter. The side menu has a **Member Admin** section, and the **Reports** section has the national roster and the master spreadsheet." },
    { type: 'table', headers: ['Menu item', 'What you do there'], rows: [
      ['**All Members**', 'Every member in every chapter. The number shows how many'],
      ['**Student Members**', 'Every student member'],
      ['**National Roster**', "The treasurer's roster of current members"],
      ['**Master Spreadsheet**', 'Download all members as a spreadsheet'],
    ]},
    { type: 'p', text: 'On the home page, the Admin tile also shows member counts by status: **Current**, **Past Due** and **Current Student**.' },
  ]},
  { tab: "Managing All Members", blocks: memberList.concat([
    { type: 'h2', text: 'Statuses and the Current Year' },
    { type: 'p', text: "A member's status (Current, Past Due, Pending, Expired) depends on their dues and the current membership year. At the start of a new year, use the **Current Year** bulk action on members who have paid." },
    { type: 'h2', text: 'Giving Someone an Admin Role' },
    { type: 'p', text: "Open the member with **Update Record**, go to **Roles & Permissions**, tick the roles they should have (for example Chapter Admin or Content Admin) and save. They see the new menus the next time they log in. System, Member, Chapter and Student Admin are kept in Security Groups, so the change also shows there. System Admins can also set everyone's roles from one list: **System Admin > Member Permissions** (Chapter 8)." },
    { type: 'alert', variant: 'warning', text: 'Only give admin roles to people who need them. A Member Admin can see and change every member\'s details.' },
  ])},
],

};
