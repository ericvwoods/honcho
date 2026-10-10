// chapters/members.js — Honcho User's Guide: for every member

module.exports = [

{ tab: "My Profile", blocks: [
  { type: 'p', text: "Click **My Profile** on the home page to see your member record. It opens read-only, organized in tabs. Click **Update** to change it." },
  { type: 'table', headers: ['Tab', "What's in it"], rows: [
    ['**Contact Information**', 'Your name, email addresses, phone numbers and emergency contact'],
    ['**Addresses**', 'Mailing, physical, billing and shipping addresses'],
    ['**Membership**', 'Your member number, member type, chapter, status and current year'],
    ['**Pilot Certificate & Ratings**', 'Highest certificate, certificate number, ratings and total time'],
    ['**Aircraft**', 'Aircraft you own or rent, one row each'],
    ['**Roles & Permissions**', 'Admin roles you hold, if any'],
    ['**Preferences**', 'Language, contact preferences and text size'],
    ['**Account**', 'Your login details'],
  ]},
  { type: 'h2', text: 'Updating Your Profile' },
  { type: 'ol', items: [
    'Click **Update** on your profile.',
    'Open a section by clicking its heading, and change what you need.',
    'Click **Save Changes**. **Cancel** leaves without saving.',
  ]},
  { type: 'p', text: "Some fields are greyed out. Those are set by admins (for example your status, member type or chapter). If one of them is wrong, contact your Chapter Admin." },
  { type: 'h2', text: 'Your Aircraft' },
  { type: 'p', text: "In the **Aircraft** section each aircraft has its own row. Change a row to edit it, fill in a blank row to add one, or tick its delete box to remove it, then save." },
  { type: 'h2', text: 'Contact Preferences' },
  { type: 'p', text: 'Under **Preferences**:' },
  { type: 'ul', items: [
    '**Do Not Call**: you prefer not to be phoned.',
    '**Email Opt Out**: you prefer not to receive email.',
    "**Directory Opt Out**: you won't appear in the National Directory.",
    '**Mail Notices**: you want notices by post.',
  ]},
]},

{ tab: "Membership Status", blocks: [
  { type: 'p', text: "Your status shows on the **Membership** tab. It's worked out from your dues and records:" },
  { type: 'table', headers: ['Status', 'Meaning'], rows: [
    ['**Current**', 'In good financial standing'],
    ['**Past Due**', 'Dues unpaid, but still in the grace period'],
    ['**Pending**', "Your credentials or dues payment haven't been checked yet"],
    ['**Expired**', 'Dues unpaid and the grace period is over'],
  ]},
  { type: 'p', text: 'If your status looks wrong after paying, contact your Chapter Admin or the membership officer.' },
]},

{ tab: "Rosters and the Directory", blocks: [
  { type: 'table', headers: ['Page', 'Who is listed'], rows: [
    ['**My Chapter Roster**', "Current members of your chapter. The number on the tile is how many there are."],
    ['**National Directory**', "Current members in every chapter, except anyone who chose Directory Opt Out."],
    ['**Chapters**', "BPA's chapters and their details."],
  ]},
  { type: 'p', text: 'Use the search box above a list to find someone by name. Click a column heading to sort by it.' },
  { type: 'alert', variant: 'info', text: "Rosters and the directory are for members only. Please don't share members' details outside BPA." },
]},

{ tab: "Posting a Bulletin", blocks: [
  { type: 'p', text: "Bulletins are short posts members share with each other, such as an item for sale or a request for help. Click **My Bulletins** to see yours and add a new one." },
  { type: 'ol', items: [
    'Click **My Bulletins**, then the button to add a bulletin.',
    'Enter a title, a short description (shown in lists) and a full description (shown when someone opens it).',
    'Add a price or cost if there is one, and your contact details. Tick the alternate-contact option to show only an alternate contact.',
    'Add a photo if you like.',
    'Choose who can see it (see below) and save.',
  ]},
  { type: 'h3', text: 'Who Sees Your Post' },
  { type: 'table', headers: ['Choice', 'Who sees it'], rows: [
    ['**Public**', 'The general public, where the organization shows posts publicly'],
    ['**All Members**', 'Members in every chapter'],
    ['**Chapter Only**', 'Members of your chapter'],
  ]},
  { type: 'p', text: "New bulletins may need an admin's approval before others can see them. You can edit or remove your own bulletins from **My Bulletins** at any time." },
]},

{ tab: "Library, News and Events", blocks: [
  { type: 'table', headers: ['Tile', 'What to do there'], rows: [
    ['**Doc Library**', "Browse, preview and download documents shared with members. You'll only see documents you're allowed to see."],
    ['**ATIS**', 'Click to download the current ATIS document.'],
    ['**Sunshine**', 'Read acknowledgements about members, or send one in with the form (your name, email, phone and message).'],
    ['**Register Me**', "Register for the current event when registration is open. If it isn't, the tile does nothing."],
    ['**Sponsors**', "See BPA's sponsors."],
  ]},
]},

];
