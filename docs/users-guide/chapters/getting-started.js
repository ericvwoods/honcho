// chapters/getting-started.js — Honcho User's Guide
// Same block format and inline markup as docs/developer-guide/chapters/*.js

module.exports = [

{ tab: "Who This Guide Is For", blocks: [
  { type: 'p', text: "Honcho is the system Black Pilots of America (BPA) uses to run its membership: member records, chapter rosters, the member home page, the document library and projects. This guide explains how to use each part, screen by screen." },
  { type: 'p', text: "Honcho can be set up with different words for different organizations. In BPA's system a person is a **Member** and a local group is a **Chapter**, so that's what this guide says. Another organization may see \"Client\" and \"Branch\" in the same places." },
  { type: 'h2', text: 'What You Can Do Depends on Your Role' },
  { type: 'p', text: 'Every member can see and update their own information. Some members are also given admin roles to help run the organization; those roles add menus and pages. Use the chapters that match your roles.' },
  { type: 'table', headers: ['Role', 'Who has it', 'What it adds', 'See chapter'], rows: [
    ['**Member**', 'Every member with a login', 'Your profile, rosters, directory, bulletins, library', '2'],
    ['**Chapter Admin**', 'Members chosen to run a chapter', "Your chapter's members, student members, chapter posts and exports", '3'],
    ['**Member Admin**', 'National membership officers', 'All members, statuses, bulk changes, master spreadsheet', '4'],
    ['**Student Admin**', 'Members who manage student programs', 'Student member lists', '3 and 4'],
    ['**Content Admin**', 'Members who manage the home page', 'Marquee, jumbotron, bulletins, notices, job posts, activities', '5'],
    ['**Document Library user or admin**', 'Members and staff given library access', 'Find, add, review and approve documents', '6'],
    ['**Projects user or admin**', 'Staff and members on project teams (add-on)', 'Teams and projects', '7'],
    ['**System Admin**', 'A few trusted people', 'Settings, chapters, audit log, everything above', '8'],
    ['**Staff**', 'Employees using the separate staff login', 'The Honcho staff portal', '9'],
  ]},
  { type: 'alert', variant: 'info', text: "Admin roles are ticked on your member record by a Member Admin or System Admin. If a menu in this guide is missing for you, you don't have that role. Ask your chapter's officers." },
]},

{ tab: "Logging In", blocks: [
  { type: 'h2', text: 'Member Portal Login' },
  { type: 'ol', items: [
    'Go to the BPA Member Portal address your chapter gave you.',
    'Enter your **Username** (usually your email address) and your **Password**.',
    'Tick **I am not a robot!** and click **Submit**.',
    "On the next screen, **For Added Security Enter:** your **Member Number**, then click **Submit**.",
  ]},
  { type: 'p', text: "Tick **Remember me** only on your own computer or phone." },
  { type: 'p', text: "The first time you log in with an account an admin created for you, you'll be asked to choose a new password." },
  { type: 'h2', text: 'Creating an Account' },
  { type: 'p', text: "If you're a member but have never logged in, click **Create an account** on the login page. Enter your email address as your username, choose a password, repeat it and submit." },
  { type: 'h2', text: 'Forgot Your Password?' },
  { type: 'p', text: "Click **Forgot password?** on the login page, enter your email address and click **Send Reset Link**. If the address matches an account, a reset link is emailed to it; check your junk mail too. The link opens a page where you enter and repeat a new password." },
  { type: 'alert', variant: 'warning', text: "Password reset and the second login step are being rebuilt. Until that work is finished, if the reset email doesn't arrive, contact the System Administrator to reset your password. Later, the second step will send a one-time code to your phone or email in place of your member number." },
  { type: 'h2', text: 'Staying Logged In and Logging Out' },
  { type: 'p', text: "If you leave the portal idle for a while you'll see **Your Session has expired - please login again.** Just log in again. When you're done, use **Logout** from the home page or the side menu, especially on a shared computer." },
]},

{ tab: "Finding Your Way Around", blocks: [
  { type: 'h2', text: 'The Home Page' },
  { type: 'p', text: "After you log in you land on the member home page. Across the top are the **marquee** (a scrolling line of announcements) and the **jumbotron** (featured items). Below them, your chapter's notices, job posts and activities are listed, and a set of tiles takes you to everything else:" },
  { type: 'table', headers: ['Tile', 'What it opens'], rows: [
    ['**My Profile**', 'Your own member record (Chapter 2)'],
    ['**My Bulletins**', "Bulletins you've posted, and a button to post a new one"],
    ['**My Chapter Roster**', "Your chapter's current members"],
    ['**National Directory**', 'Current members across all chapters'],
    ['**Chapters**', "BPA's chapters and their details"],
    ['**Doc Library**', 'Shared documents you can read and download'],
    ['**ATIS**', 'Downloads the current ATIS document from the library'],
    ['**Sunshine**', 'Acknowledgements about members, and a form to send one in (your name, email, phone and message)'],
    ['**Register Me**', 'Registration for the current event, when one is open'],
    ['**Sponsors**', "BPA's sponsors"],
    ['**Admin**', 'Admin pages, shown only if you have an admin role'],
    ['**Logout**', 'Ends your session'],
  ]},
  { type: 'h2', text: 'The Side Menu (Admins)' },
  { type: 'p', text: "Members with admin roles also get a side menu on the left with a section per role: Member Admin, Chapter Admin, Content Admin, PMS, System Admin and Reports. **Expand/Hide Menu** at the top shrinks it to icons to give the page more room. Click a section to open its list of pages." },
  { type: 'h2', text: 'Text Size' },
  { type: 'p', text: "You can make tabs, section headings, labels, values and buttons larger or smaller. Open **My Profile**, click **Update**, go to the **Preferences** section and choose a size for each under **Display Size**, then save." },
]},

{ tab: "The Mobile App", blocks: [
  { type: 'p', text: 'The **BPA Member Portal** app works in your phone\'s web browser and can be added to your home screen like an app.' },
  { type: 'table', headers: ['Screen', 'What you can do'], rows: [
    ['**Sign in**', 'Log in with the same username and password as the website'],
    ['**Home**', 'The member home page'],
    ['**My Profile**', 'See and update your contact details, addresses, emergency contact, preferences, pilot certificates and ratings, and aircraft; tap **Save changes**'],
    ['**My Chapter**', "Your chapter's roster"],
    ['**Directory**', 'The national directory'],
    ['**Change password**', 'Choose a new password'],
  ]},
  { type: 'p', text: "Admin pages aren't in the app. Use the website on a computer for those." },
]},

];
