// chapters/members.js — Honcho Member Guide: for every member

module.exports = [

{ tab: "My Profile", blocks: [
  { type: 'p', text: "Click **My Profile** on the home page to see your member record. It opens read-only, organized in tabs. Click **Update** to change it." },
  { type: 'table', headers: ['Tab', "What's in it"], rows: [
    ['**Contact Information**', 'Your name, email addresses, phone numbers and emergency contact'],
    ['**Addresses**', 'Mailing, physical, billing and shipping addresses'],
    ['**Membership**', 'Your member number, member type, chapter, status and current year'],
    ['**Certificates & Ratings**', 'Highest certificate, certificate number, ratings and total time'],
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
  { type: 'h2', text: 'Text Size' },
  { type: 'p', text: "Click **Font** in the top bar (next to Change Password) to choose how large text appears for you: tabs, headings, labels, values and buttons, each Small, Medium or Large. Click **Save** and the page reloads with the new sizes. The same choices are under **Preferences** on your profile." },
  { type: 'h2', text: 'Contact Preferences' },
  { type: 'p', text: 'Under **Preferences**:' },
  { type: 'ul', items: [
    '**Do Not Call**: you prefer not to be phoned.',
    '**Email Opt Out**: you prefer not to receive email.',
    "**Directory Opt Out**: you won't appear in the National Directory.",
    '**Mail Notices**: you want notices by post.',
  ]},
]},

{ tab: "Your Membership Card", blocks: [
  { type: 'p', text: "Click **My Card** in the side menu (or the **Card** tab in the phone app) to see your digital membership card: your name, member number, chapter, member type, the year your membership runs to, and a QR code." },
  { type: 'p', text: "Show the QR code at the door of BPA events and meetings. A volunteer scans it and the system checks, at that moment, that your membership is current. The code contains no personal information." },
  { type: 'p', text: "In the phone app the card also opens without signal, as long as you've opened it once before with signal." },
  { type: 'h2', text: 'Lost Your Phone?' },
  { type: 'p', text: "Open My Card on another device, tick **I understand the old card stops working** and click **Cancel and issue a new card**. The QR code on the lost phone stops working at once. Your Chapter Admin or a Member Admin can do this for you too." },
  { type: 'alert', variant: 'info', text: "Coming soon: **Add to Google Wallet**, so the card sits in your phone's wallet. Apple Wallet will follow." },
]},

{ tab: "My Coffee Report", blocks: [
  { type: 'p', text: "If your organization offers it, **My Coffee Report** in the side menu sets up a short email each morning, just for you: bulletins from National and your chapter first, then the sections you choose." },
  { type: 'table', headers: ['Section', 'What you get'], rows: [
    ['**Membership**', "How many members are Current nationwide and in your chapter"],
    ['**Upcoming events**', "National's and your chapter's events in the days ahead"],
    ['**Sunshine and Bulletin Board**', 'Posts showing today on the member home'],
    ['**Weather**', 'Today\'s forecast for the places you list, one per line (City, ST)'],
    ['**Markets**', 'Yesterday\'s closing prices for the ticker symbols you list (for example AAPL, or ^GSPC for the S&P 500), and exchange rates'],
    ['**News**', 'Recent headlines for the topics you list'],
    ['**Sports**', "Yesterday's results and today's games for the leagues you tick; golf leaderboards"],
  ]},
  { type: 'ol', items: [
    "Choose **On: send it**, the time, your time zone and the days.",
    "Tick the sections you want and fill in their boxes. The numbers set the order.",
    "Click **Save**, then **Preview** to see today's report, or **Email it to me now**.",
  ]},
  { type: 'ul', items: [
    "It goes to the email address on your profile.",
    "**Telegram:** click **Link my Telegram**, open the link, press **Start** in Telegram, then come back and click **I pressed Start**. Tick **Send it to my Telegram too** and save. **Unlink Telegram** stops it.",
    "It's for **Current** members. If your membership isn't Current, you can set it up, but it can't be switched on until it is.",
    "**Recently sent** lists your last reports; click one to read it again.",
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
  { type: 'p', text: "**Lifetime members** have the year **2099** on their Membership tab and are always Current." },
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

{ tab: "Library, News and Events", blocks: [
  { type: 'table', headers: ['Tile', 'What to do there'], rows: [
    ['**Doc Library**', "Browse, preview and download documents shared with members. You'll only see documents you're allowed to see."],
    ['**Register Me**', "Register for the current event when registration is open. If it isn't, the tile does nothing."],
    ['**Sponsors**', "See BPA's sponsors."],
    ['**My Sticky Notes**', "Post a short note on the home page's Bulletin Board, and change or delete the notes you posted. You can also use **Post a Sticky Note** under the Bulletin Board."],
  ]},
  { type: 'p', text: "**Sticky notes:** your note goes up as soon as you save it, for all members or just your chapter (you choose). A Chapter Admin or Content Admin may take a note off the board; your **My Sticky Notes** list then says **Waiting for approval** or **Disapproved**. If you change a disapproved note and save it, it goes back to them for approval." },
]},

];
