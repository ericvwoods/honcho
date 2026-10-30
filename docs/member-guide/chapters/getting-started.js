// chapters/getting-started.js — Honcho Member Guide (admin material moved to the Administrator's Guide 2026-10-29)
// Same block format and inline markup as docs/developer-guide/chapters/*.js

module.exports = [

{ tab: "Who This Guide Is For", blocks: [
  { type: 'p', text: "Honcho is the system Black Pilots of America (BPA) uses to run its membership: member records, chapter rosters, the member home page, the document library and projects. This guide explains how to use each part, screen by screen." },
  { type: 'p', text: "Honcho can be set up with different words for different organizations. In BPA's system a person is a **Member** and a local group is a **Chapter**, so that's what this guide says. Another organization may see \"Client\" and \"Branch\" in the same places." },
  { type: 'p', text: "This guide is for **every member**: logging in, your profile and membership card, rosters and the directory, events and the Document Library." },
  { type: 'alert', variant: 'info', text: "**Admins:** if you run a chapter, manage members, edit the website or set up the system, the **Honcho Administrator's Guide** covers your admin pages step by step." },
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
  { type: 'h2', text: 'Getting an Account' },
  { type: 'p', text: "Your login is created for you by your Chapter Admin or the membership office; you can't create one yourself on the login page. If you're a member and have never logged in, ask your Chapter Admin for your username and starting password." },
  { type: 'h2', text: 'Forgot Your Password?' },
  { type: 'p', text: "Click **Forgot password?** on the login page, enter your email address and click **Send Reset Link**. If the address matches an account, a reset link is emailed to it; check your junk mail too. The link opens a page where you enter and repeat a new password." },
  { type: 'alert', variant: 'warning', text: "Password reset and the second login step are being rebuilt. Until that work is finished, if the reset email doesn't arrive, contact the System Administrator to reset your password. Later, the second step will send a one-time code to your phone or email in place of your member number." },
  { type: 'h2', text: 'Staying Logged In and Logging Out' },
  { type: 'p', text: "If you leave the portal idle for a while you'll see **Your Session has expired - please login again.** Just log in again. When you're done, use **Logout** from the home page or the side menu, especially on a shared computer." },
]},

{ tab: "Finding Your Way Around", blocks: [
  { type: 'h2', text: 'The Home Page' },
  { type: 'p', text: "After you log in you land on the member home page. Below the tiles, the organization's own page shows what its Content Admins have put there, such as a picture slider, announcements, Sunshine, the Bulletin Board, upcoming events, Careers and contact details; the menu bar above it jumps to each part. The tiles take you to everything else:" },
  { type: 'table', headers: ['Tile', 'What it opens'], rows: [
    ['**My Profile**', 'Your own member record (Chapter 2)'],
    ['**My Chapter Roster**', "Your chapter's current members"],
    ['**National Directory**', 'Current members across all chapters'],
    ['**Chapters**', "BPA's chapters and their details"],
    ['**Doc Library**', 'Shared documents you can read and download'],
    ['**Register Me**', 'Registration for the current event, when one is open'],
    ['**Sponsors**', "BPA's sponsors"],
    ['**EMS**', "Admin pages, shown only if you have an admin role (see the Administrator's Guide)"],
    ['**Logout**', 'Ends your session'],
  ]},
  { type: 'h2', text: 'Help' },
  { type: 'p', text: "This guide is also in Honcho: click **Help** in the side menu of the home page, or at the top of your profile pages. Use the search box to find a topic." },
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
