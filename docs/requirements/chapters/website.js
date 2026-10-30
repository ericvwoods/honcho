// chapters/website.js — Honcho Requirements: Member Home and Website (requirement prefix WEB).
// Written 2026-10-30 as built, from modules/cms/content/, cms_page() in engine/tg_helpers/cms_helper.php,
// Welcome::website()/job()/index(), the CMS chapter of the Developer's Guide, the Administrator's Guide
// (Website chapter) and the to-do list (Home page content). Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Decides what the **member home** shows below the member tiles, and runs an optional **public website** from the same content, section by section, without a web designer. Content Admins manage pages, pictures and posts; Event Admins and Chapter Admins keep the events calendar; Chapter Admins and members post to the Sunshine, Bulletin Board and Careers sections." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members**', 'Read the member home; post their own sticky notes'],
    ['**Content Admins**, System Admins', 'Manage sections, items, pictures and every post; put posts on the public website'],
    ['**Event Admins**', 'Add and change any event'],
    ['**Chapter Admins**', "Post for all members or their chapter; approve their chapter's sticky notes; add their chapter's events"],
    ['**The public**', 'See the public website, when it is switched on'],
  ]},
  { type: 'p', text: "**Module:** Core (CMS). Its menu name is a setting (\"Website\" for BPA). **To-do section:** Home page content (CMS)." },
]},

{ tab: "Requirements", blocks: [
  { type: 'h2', text: 'The Member Home' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['WEB-01', 'The member home has tiles for My Profile, My Chapter Roster, National Directory, Chapters, Doc Library, Register Me, Sponsors, My Sticky Notes, EMS (admins only) and Logout, and a side menu with the same plus My Card, Help and the admin sections a member\'s roles allow.', 'Built (before Oct 2026); My Card 26 Oct, Help 29 Oct, EMS label 28 Oct 2026'],
    ['WEB-02', 'Below the tiles, the organization\'s own page: sections in the order the Content Admins set, with a menu bar whose links scroll to each section. Sections that are off or empty don\'t show.', 'Built 20 Oct 2026'],
    ['WEB-03', 'Section types: picture slider, feature boxes, team (Officials), timeline, quotes, prices, contact details, Sunshine, Bulletin Board, Calendar, Marquee, Careers, and member numbers (member home only).', 'Built 20 Oct 2026'],
    ['WEB-04', 'The slider is 470 pixels tall and crops pictures to the screen width, keeping heads in view; the guide gives the best picture size (1920 x 640).', 'Built 20 Oct 2026; crop fixed 27 Oct'],
  ]},

  { type: 'h2', text: 'Managing Content' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['WEB-05', '**Page Sections:** show or hide each section on the member home and on the public website, drag to reorder, change headings, subtitles and menu labels.', 'Built 20 Oct 2026'],
    ['WEB-06', '**Items** inside a section (slides, team members and so on), with a form showing only the boxes that section uses; pictures chosen from the library; hide without deleting; drag to reorder.', 'Built 20 Oct 2026'],
    ['WEB-07', '**Pictures:** upload JPEG, PNG, GIF or WebP up to 10 MB; very wide pictures are made 1920 wide; each has a description for screen readers and a use count; a picture in use can\'t be deleted.', 'Built 20 Oct 2026'],
    ['WEB-08', 'Pictures are also the source for the logos on System Settings.', 'Built 25 Oct 2026'],
  ]},

  { type: 'h2', text: 'Posts' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['WEB-09', '**Sunshine** (illnesses, recoveries, passings), **Bulletin Board** (sticky notes), **Marquee** (scrolling one-liners) and **Careers** (job postings, each with its own page and Apply button).', 'Built 20 Oct 2026'],
    ['WEB-10', 'Each post is for All Members or one chapter, may also go on the public website, and has optional show-from and show-until dates; the list says whether each is showing, waiting or ended.', 'Built 20 Oct 2026'],
    ['WEB-11', 'Chapter Admins post Sunshine, Bulletin Board and Careers for All Members or their chapter, never the public website.', 'Built 20 Oct 2026'],
    ['WEB-12', 'Members post their own sticky notes, which go up at once (if the Member Bulletins setting is on); a Chapter, Content or System Admin can set one Pending or Disapproved to take it down; a changed disapproved note goes back for approval.', 'Built 20 Oct 2026'],
  ]},

  { type: 'h2', text: 'Events Calendar' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['WEB-13', "The calendar shows every chapter's events: national in green, the member's own chapter in blue, others in grey; Month, Week and List views; a list on phones and when the month is empty.", 'Built 20 Oct 2026'],
    ['WEB-14', "Event Admins and System Admins add any event; Chapter Admins add their own chapter's. An event has a title, dates and times or All day, location, descriptions, picture, a link with a button label, and a Public tick.", 'Built 20 Oct 2026'],
    ['WEB-15', '**Event Module:** registration for events with activities and fees, paid into the host\'s account (National, or the host chapter for the rotating General Membership and Board meetings); replaces today\'s hard-coded registration events.', 'Planned (needs its own plan; payments come from the Payments chapter)'],
  ]},

  { type: 'h2', text: 'Public Website' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['WEB-16', 'A public website from the same content, with no login: only sections ticked Public website, posts ticked for it and public events; member numbers never; a Member Login button.', 'Built 20 Oct 2026'],
    ['WEB-17', 'A setting decides whether the site\'s front address shows the public website or the login; the website\'s own address always works, so it can be built before it is switched on.', 'Built 20 Oct 2026. BPA keeps it off while bpapilots.org stays its public site'],
    ['WEB-18', "BPA's content (slider, About, programs, officials, membership classes, contact, meeting dates 2027-2033) loaded from bpapilots.org without inventing anything.", 'Built 20 Oct 2026. Gaps for BPA to supply: Skyhook and Summer Flight Academy dates, a national contact, testimonials, the right Academy location'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Content is data, not code:** it moves between servers by copying the content tables and pictures, after a backup.",
    "Member-only sections (member numbers, Sunshine, Bulletin Board, Marquee by default) never appear on the public website.",
    "Only Content Admins and System Admins can put a post on the public website.",
    "Old Notices and Activities are gone: announcements go in the Marquee or Bulletin Board, activities on the calendar.",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "The Delete button on the content lists is drawn far too wide.",
    "The Chapters tile and menu item link to a page that doesn't exist.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['20 Oct 2026', 'Replace the unfinished prototype content modules with a new content manager, built in phases with sign-off; keep the Inspinia look.'],
    ['20 Oct 2026', 'Posting roles: Chapter Admins for All Members or their chapter, members their own sticky notes, approved at once unless an admin holds them back.'],
    ['21 Oct 2026', 'Skyhook and the Summer Flight Academy are national events; the General Membership and Board meetings rotate between chapters, and their registration money goes to the host chapter.'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['Member Guide', 'Chapter 2: Library, News and Events'],
    ["Administrator's Guide", 'Chapter 4, Website (Home Page Content)'],
    ["Developer's Guide", 'Website (CMS) chapter'],
    ['To-do list', 'Home page content (CMS)'],
  ]},
]},

];
