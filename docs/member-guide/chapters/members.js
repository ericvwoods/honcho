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
  { type: 'p', text: "If BPA offers it, **My Coffee Report** in the side menu sets up a short message each morning, just for you: bulletins from National and your chapter first, then the sections you choose. It comes by email, and by Telegram too if you like." },
  { type: 'table', headers: ['Section', 'What you get'], rows: [
    ['**Membership**', "How many members are Current nationwide and in your chapter"],
    ['**Birthdays today**', "Members of your chapter whose birthday is today (names only). Members who chose not to be listed in the directory are left out"],
    ['**Upcoming events**', "National's and your chapter's events in the days ahead"],
    ['**Sunshine and Bulletin Board**', 'Posts showing today on the member home'],
    ['**Weather**', 'Today\'s forecast for the places you list, one per line (City, ST)'],
    ['**Markets**', 'Yesterday\'s closing prices for the ticker symbols you list (for example AAPL, or ^GSPC for the S&P 500), and exchange rates'],
    ['**News**', 'Recent headlines for the topics you list'],
    ['**Sports**', "Yesterday's results and today's games for the leagues you tick; golf leaderboards"],
  ]},

  { type: 'h2', text: 'Getting It Working' },
  { type: 'ol', items: [
    "**Make sure your membership is Current.** The report is for Current members. Your status is on the Membership tab of your profile; if it isn't Current you can still set the report up, but it can't be switched on until it is.",
    "**Check your email address.** The report goes to the email address on your profile (shown under **Sent to**). If it's missing or wrong, update your profile first.",
    "Open **My Coffee Report** and choose **On: send it**, the time, your time zone and the days you want it.",
    "Tick the sections you want and fill in their boxes (for example your city for Weather). The numbers set the order.",
    "Click **Save**.",
    "Click **Preview** to see today's report on the page, or **Email it to me now** to get a copy straight away. If the email doesn't arrive within a few minutes, look in your junk or spam folder and mark it as not junk.",
  ]},
  { type: 'p', text: "From then on it arrives at your chosen time on your chosen days. **Recently sent** on the page lists your last reports; click one to read it again." },

  { type: 'h2', text: 'Getting It in Telegram Too' },
  { type: 'p', text: "Telegram is a free messaging app. To get your report there as well, you need the Telegram app on your phone (or Telegram on your computer), signed in." },
  { type: 'ol', items: [
    "On My Coffee Report, click **Link my Telegram**. A link to BPA's Telegram bot, **@BPAPilotsCoffeeBot**, appears.",
    "Open that link **on the phone or computer where you use Telegram** (tap it on your phone, or click it on your computer). Telegram opens a chat with the bot.",
    "Tap **Start** at the bottom of that chat. This is the step that lets the bot message you: a bot can't send anything until you press Start.",
    "Come back to My Coffee Report and click **I pressed Start**. You'll see \"Telegram linked\", and the bot sends you a short message to confirm.",
    "Tick **Send it to my Telegram too** and click **Save**.",
  ]},
  { type: 'alert', variant: 'warning', text: "Use the link from the page. Finding the bot by searching for it in Telegram and pressing Start won't link your report, because the link carries a code that tells BPA it's you." },
  { type: 'p', text: "To stop Telegram, untick **Send it to my Telegram too** and save, or click **Unlink Telegram**." },

  { type: 'h2', text: "If It Doesn't Work" },
  { type: 'table', headers: ['What you see', 'What to do'], rows: [
    ['**My Coffee Report** isn\'t in the menu', "BPA hasn't switched member reports on yet"],
    ['"The Coffee Report is for Current members"', 'Your membership isn\'t Current. Renew, or ask your Chapter Admin if you think your status is wrong'],
    ['"Add an email address to your profile first"', 'Add your email address on your profile, then come back'],
    ['The email never arrives', 'Check junk or spam; check the address under **Sent to**; check the report is **On** and today is ticked'],
    ['The Telegram link doesn\'t open the bot', 'Open it on the device where Telegram is installed; on a computer without the Telegram app, install it or open web.telegram.org first'],
    ['"Not found yet" after **I pressed Start**', 'Make sure you opened the link from the page (not a search) and tapped **Start**; wait a few seconds and click **I pressed Start** again. If it still isn\'t found, click **New link** and repeat'],
    ['Telegram stopped arriving', 'If you blocked or deleted the bot, open the link again and press Start, or click **Link my Telegram** again'],
  ]},
]},

{ tab: "My Dues", blocks: [
  { type: 'p', text: "**My Dues** in the side menu shows your dues: each membership year's chapter and National dues, any National invoice still to pay (with how to pay it), and your payments with their receipts." },
  { type: 'ul', items: [
    "**How it works:** you pay your chapter dues to your chapter. When your chapter records them, you're emailed your **National dues invoice**, and your membership is **Pending** until National receives that payment. Then you're emailed a receipt and you're **Current**.",
    "**Receipts:** click a receipt number to open it; **Print** prints it.",
    "**Reminders:** BPA may email you before your dues are due, while you're Past Due, or while a National invoice is open.",
    "If something looks wrong (for example you paid but show as Pending), contact your Chapter Administrator.",
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
