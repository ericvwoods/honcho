// chapters/members.js — Honcho Requirements: Member Records (requirement prefix MEM).
// Written 2026-10-30 as built, checked against modules/welcome/ccmps/Ccmps.php (_member_access, ccmpsubmit
// dues transaction, recalcstatus and its cutover guard, export, rosters, bulkaction), ccmps_types,
// the Member and Administrator's Guides, the to-do list and the CCMPS chapter of the Developer's Guide.
// Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "The heart of Honcho: one record per member (\"CCMPS\": customers, clients, members, participants), with their contact details, membership, chapter, status and dues, and for BPA their pilot certificates and aircraft. Members keep their own record up to date; admins manage everyone's within their reach; rosters, the directory and exports are drawn from it." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members**', 'View and update their own profile; see their chapter roster and the national directory'],
    ['**Chapter Admins**', "Manage their own chapter's members, export them, record renewals"],
    ['**Member Admins, System Admins**', 'Manage every member, run bulk actions, the national roster and the master spreadsheet'],
    ['**Student Admins**', 'Manage Q and S (student) members'],
  ]},
  { type: 'p', text: "**Module:** Core (CCMPS). The words \"Member\" and \"Chapter\" are settings (System Settings, Wording), so another organization can say \"Client\" and \"Branch\". **To-do sections:** Security; Permissions; Participants module; Legacy data load; Eligible voter rules." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'The Member Record' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-01', 'A member record holds contact information (name, emails, phones, emergency contact), addresses (mailing, physical, billing, shipping), membership (member number, type, chapter, status, current year), certificates and ratings, aircraft (one row each), roles, preferences, admin notes and account details.', 'Built (before Oct 2026)'],
    ['MEM-02', 'The record opens read-only in tabs; **Update** opens it for editing in collapsible sections; **Save Changes** saves and **Cancel** leaves without saving. Close returns to the page the person came from.', 'Built; Close behavior 27 Oct 2026'],
    ['MEM-03', 'Fields set by admins (status, member type, chapter and similar) are read-only for members.', 'Built (before Oct 2026)'],
    ['MEM-04', 'A member can upload a photo for their record (used on the membership card and at the door); the member or an admin can remove it.', 'Built (before Oct 2026)'],
    ['MEM-05', '**Member types:** R Regular, A Associate, Q Qualified Student, S Student, F Family, H Honorary, each with its National dues amount (BPA: $60, $35, $10, $10, $10, $0).', 'Built (before Oct 2026)'],
    ['MEM-06', 'An organization can hide fields it doesn\'t use with switches on **System Settings > Member Fields** (so far Department, Lead Source, Reports To), rather than removing them from the screens.', 'Built 27 Oct 2026'],
    ['MEM-07', 'Each member chooses their own text sizes (Small, Medium or Large) for tabs, headings, labels, values and buttons, from **Font** in the top bar or Preferences; pages follow their choice.', 'Built (before Oct 2026)'],
    ['MEM-08', 'Contact preferences: Do Not Call, Email Opt Out, Directory Opt Out (left out of the National Directory), Mail Notices.', 'Built (before Oct 2026)'],
    ['MEM-09', 'Members see and update their profile, including addresses, emergency contact, preferences, certificates and aircraft, in the phone app too.', 'Built (before Oct 2026)'],
  ]},

  { type: 'h2', text: 'Who May See and Change a Record' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-10', 'One rule decides who may open, change, create and manage records: a member their own record; Member Admins, System Admins and staff admins any record; Chapter Admins their own chapter\'s members (new members they add go in their chapter); Student Admins Q and S members. Only admins may create members, lock accounts, run bulk actions and create logins.', 'Built 27 Oct 2026 (before then any signed-in member could open and change any record)'],
    ['MEM-11', 'The full member export and the national roster are for national admins only; a Chapter Admin\'s export is always their own chapter.', 'Built 27 Oct 2026'],
  ]},

  { type: 'h2', text: 'Member Lists, Rosters and Exports' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-12', 'Admin member lists (All Members, Chapter Members, Student Members) with search, sorting, and per-row View, Update, Delete, Undelete and Permanently Delete. Delete can be undone; Permanently Delete removes the member and all their records.', 'Built (before Oct 2026)'],
    ['MEM-13', '**Bulk actions** on ticked members: set the Current Year, create login accounts, delete.', 'Built; Undelete added and Current Year routed through the dues steps 31 Oct 2026. Lock, Unlock, Approve User Acct, Approve CCMPS and Archive are listed but do nothing yet'],
    ['MEM-14', '**My Chapter Roster** (current members of the member\'s chapter) and **National Directory** (current members everywhere, except those who opted out), for members only.', 'Built; fixed 19 Oct 2026'],
    ['MEM-15', "**National Roster** (the treasurer's roster of current members) and **Master Spreadsheet** (all members as Excel) for national admins; **Export Members** (own chapter) for Chapter Admins.", 'Built; fixed 19 Oct 2026'],
    ['MEM-16', 'The admin home shows member counts by status: Current, Past Due, Current Student.', 'Built (before Oct 2026)'],
    ['MEM-17', '**Chapters** list and details (each chapter\'s officers and financial contact), for members; maintained by System Admins.', 'Built (before Oct 2026)'],
  ]},

  { type: 'h2', text: 'Status and Dues' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-18', "A member's status is worked out, not typed: **Current** (paid for the current membership year and received by National), **Pending** (renewed, waiting for National to record the money), **Past Due** (behind, while the grace period is on), **Expired** (behind, grace period off), **None** (deceased or deleted).", 'Built (before Oct 2026); lifetime rule 22 Oct 2026'],
    ['MEM-19', 'The membership year, the open dues payment year, the grace period (on or off) and the new-member proration are set on the Financial tab of System Settings. Changing the year or grace period re-checks every member\'s status after a confirmation and reports how many changed.', 'Built 22 Oct 2026'],
    ['MEM-20', "Renewing a member (setting their Current Year to the open dues payment year) creates a National dues record for that year: the member type's National dues, prorated for a brand-new Regular member, owed until National records it.", 'Built (before Oct 2026)'],
    ['MEM-21', 'National records that a renewal\'s money has been received, which makes the member Current.', '**Not built.** Nothing marks a dues record received yet, so renewed members would stay Pending. To be built first, with Dues (Financial, FIN-03)'],
    ['MEM-22', 'A lifetime member has Current Year 2099 and is always Current.', 'Built 22 Oct 2026'],
  ]},

  { type: 'h2', text: 'Locking, Deceased, Logins' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-23', 'A System Admin can **lock** a member (tick Locked) to stop them signing in without deleting them.', 'Built (before Oct 2026)'],
    ['MEM-24', 'Saving a member as **Deceased** stops them signing in, removes every admin role and group, and leaves them off rosters, the directory, the treasurer\'s spreadsheet and the counts. The record is kept; an email address isn\'t needed to save it.', 'Built 19 Oct 2026'],
    ['MEM-25', 'An admin can create a member\'s login from their record or with the bulk action; the member then chooses a new password at first sign-in.', 'Built (before Oct 2026)'],
  ]},

  { type: 'h2', text: 'Planned' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['MEM-26', '**Participants (Student) module:** S members (type 4) move to their own module, branded "Student" for BPA, and don\'t vote; Q members (type 3) stay in member records and vote.', 'Planned (decided 27 Oct 2026). No seeding by default; for BPA perhaps from S members, not decided'],
    ['MEM-27', '**Eligible voter rules:** whether a member may vote is worked out from their type and status, wherever status is recalculated; the Eligible Voter box becomes display-only.', 'Planned (later)'],
    ['MEM-28', 'Aviation-specific fields (certificates, ratings, chapter role, member number) move to their own table, switched on only for organizations that use them.', 'In progress (the code still reads some of them from the main record)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Q and S:** Q (Qualified Student) members are members and vote; S (Student) members are program participants and don't vote. The Student checkbox on the record is information only and decides nothing.",
    "**Status follows money, not a checkbox:** Current needs a dues record for the member's year that National has received in full.",
    "**Temporary cutover rule:** members whose Current Year is 2026 or earlier keep the status they have, because the old system's payment history isn't loaded. Remove the rule (or raise the year) after one full renewal cycle on Honcho; left in place it would hide a legacy member who stops renewing.",
    "**Hide, don't delete:** when an organization doesn't want a field, it is switched off on Member Fields, never removed from the screens.",
    "**Real data comes from the legacy system:** today's records are old test data; the real members load from the legacy database before acceptance testing, and again before go-live.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "Renewed members stay Pending until MEM-21 is built.",
    "Older parts of the member records code still need the permission review that fixed the record pages (Permissions, PERM-18).",
    "Only 14 of 1,725 test members have a photo.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['19 Oct 2026', 'Deceased members keep their record but lose sign-in, roles and groups (MEM-24).'],
    ['22 Oct 2026', 'Lifetime = Current Year 2099, always Current (MEM-22); the financial settings move to System Settings (MEM-19).'],
    ['27 Oct 2026', 'One access rule for member records (MEM-10).'],
    ['27 Oct 2026', 'Fields are hidden with Member Fields switches, never commented out (MEM-06).'],
    ['27 Oct 2026', 'Q members stay and vote; S members go to the Student module and don\'t vote (MEM-26).'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['Member Guide', 'Chapter 2, For Every Member'],
    ["Administrator's Guide", 'Chapters 2 and 3, Chapter Admins and Member Admins'],
    ["Developer's Guide", 'CCMPS chapter'],
    ['To-do list', 'Participants module; Legacy data load; Eligible voter rules'],
  ]},
]},

];
