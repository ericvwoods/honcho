// chapters/logins.js — Honcho Requirements: Signing In and Accounts (requirement prefix LOGIN).
// Written 2026-10-30 as built, checked against modules/welcome/Welcome.php (authenticate, username_pw_check,
// secondfactor_check, successfullogin, mobile_bridge, changepassword, forgotpassword), the Honcho login,
// config.php (CCMP_SECOND_FACTOR_*, MINPWLGTH, FORCE_PW_CHG_NEW_CCMP), the to-do list and the Security chapter
// of the Developer's Guide. Requirement numbers never change or get reused.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "How people get into Honcho. There are two logins, by decision: members sign in to the **member portal** (and the phone app), and staff sign in to **Honcho**, the staff back office, when it is deployed. A person who is both a member and staff has an account in each." },
  { type: 'table', headers: ['Who', 'Signs in at'], rows: [
    ['**Members**, including member admins', 'The member portal login, and the phone app'],
    ['**Staff**', '`/honcho` (only when the staff module is deployed)'],
    ['**System administrator**', 'Full Honcho: the staff `sysadmin` account. Honcho Lite (member portal only): a member with the System Admin role'],
  ]},
  { type: 'p', text: "**Module:** Core (Welcome). **To-do sections:** Security, Login & accounts." },
]},

{ tab: "Requirements", blocks: [
  { type: 'p', text: "**Built** = working (date, where known; \"before Oct 2026\" = part of the original system). **Planned** = agreed, not built. **Not working** = exists but broken." },

  { type: 'h2', text: 'Member Sign-in' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['LOGIN-01', 'Members sign in with a username (usually their email address) and password, and tick "I am not a robot".', 'Built (before Oct 2026)'],
    ['LOGIN-02', "A second step asks for the member's second factor. For BPA this is the **Member Number**; its name is a setting (System Settings, Wording). An account with nothing on record for the second factor can't sign in, and a blank entry never passes.", 'Built; hardened 22 Oct 2026 (the shared temporary code 654321 was removed)'],
    ['LOGIN-03', '**Remember me** keeps the member signed in on that device for 3 days; otherwise the sign-in lasts for the browser session.', 'Built (before Oct 2026)'],
    ['LOGIN-04', 'Refused sign-ins, each with its own message: a **locked** account (names whom to contact), a **deleted** account, and a **deceased** member (portal, phone app and the app\'s saved sign-in).', 'Built 19 Oct 2026'],
    ['LOGIN-05', 'Each sign-in starts a new session id, so a session id planted beforehand is useless.', 'Built 22 Oct 2026'],
    ['LOGIN-06', 'When a session runs out, the next page says "Your Session has expired - please login again" and returns to the login.', 'Built (before Oct 2026)'],
    ['LOGIN-07', 'The phone app signs in with the same username and password as the portal.', 'Built (before Oct 2026)'],
    ['LOGIN-08', 'Sign-ins and sign-outs are recorded in the Auditlog.', 'Built (before Oct 2026)'],
  ]},

  { type: 'h2', text: 'Passwords' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['LOGIN-09', 'Members and staff can change their password. A password must be at least the minimum length set in System Settings (BPA: 6).', 'Built (before Oct 2026)'],
    ['LOGIN-10', 'A member whose account was created by an admin must choose a new password at first sign-in (a System Settings switch, on for BPA).', 'Built (before Oct 2026)'],
    ['LOGIN-11', '**Forgot password** for both logins: a one-time link with a short expiry (about 30 minutes), sent to the account\'s own email (or phone); the same message whether or not the account exists; the link works once; requests limited; logged.', "**Not working; rebuild planned.** Today's version emails one fixed address and stops before saving the new password. Until rebuilt, the System Administrator resets passwords"],
  ]},

  { type: 'h2', text: 'Staff and System Administrator Accounts' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['LOGIN-12', 'Staff sign in at `/honcho` with username, password and a Verification Code (the account\'s second factor), then land on the staff dashboard.', 'Built (before Oct 2026); dashboard address fixed 18 Oct 2026'],
    ['LOGIN-13', 'In Honcho Lite the system administrator is a member with the System Admin role. BPA has a dedicated one that isn\'t a person, `portaladmin` (Member Number SA-0001, out of the directory, never a current member). Its password is kept outside the code.', 'Built 27 Oct 2026'],
    ['LOGIN-14', 'Staff can view and edit their own account (name, job title, email, phone, photo, display sizes, password).', 'Planned. Today the staff **My Account** link shows a blank page'],
  ]},

  { type: 'h2', text: 'Planned' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['LOGIN-15', 'A real second factor: a one-time code by text or email, valid for a few minutes and usable once. Required for anyone with an admin role; optional for other members. Replaces the Member Number step.', 'Planned. Text messages wait on Brevo approving the toll-free number'],
    ['LOGIN-16', '**View as a member** (detailed plan: View as a Member tab, LOGIN-20 to LOGIN-29): a System Admin or Member Admin (a Chapter Admin within their chapter, if wanted) opens the portal as a member, to see exactly what they see and act for them. A "Return to my account" bar on every page; never gains more rights than the admin has; never sees or changes the member\'s password, second factor or card; every start, stop and change logged as "<admin> as <member>".', 'Planned (asked 27 Oct 2026). The legacy system\'s version is to be looked up first'],
    ['LOGIN-17', 'Members create their own account from the login page.', 'Not available: the link is switched off on the login page. Accounts are created by admins (or the legacy data load). Decide whether to offer it'],
  ]},
]},

{ tab: "View as a Member (Plan)", blocks: [
  { type: 'p', text: "**Plan, 31 Oct 2026, awaiting the owner's decisions** (LOGIN-16 in detail). An admin sees Honcho exactly as a member does, and can act for them, without knowing their password." },
  { type: 'h2', text: 'How the Legacy System Did It' },
  { type: 'p', text: "A button and a drop-down of members; choosing one ran the login's last step as that member. The admin's own login was **replaced**, so going back to the admin screens meant logging out and in again." },
  { type: 'h2', text: 'How Honcho Will Do It' },
  { type: 'ul', items: [
    "**Two identities in one session.** Starting puts the admin's own session aside inside the same session, then sets the session up as the member, using the **same code the member login uses** (taken out of the login into one shared helper, so the two can never drift apart). **Return to my account** puts the admin's session back exactly as it was. One click each way; no logging out.",
    "**A bar on every page** while viewing as a member: \"Viewing as <member> (<chapter>). Return to my account\", in a colour that can't be missed, on the member and admin page layouts.",
    "**Starting:** a **View as** button on the member record, and a **View as a member** page with a search box (name, member number, email). A drop-down of 1,700 members is too long.",
    "**Logout** while viewing as a member ends the viewing and returns to the admin's account; logging out again logs the admin out.",
    "**Only one member at a time;** switching to another member returns to the admin first. Looking at two accounts side by side means a second browser (or a private window) signed in separately.",
  ]},
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['LOGIN-20', '**View as** a member from their record or a search page; the session becomes theirs, with their menus and data, until **Return to my account**.', 'Planned'],
    ['LOGIN-21', 'The admin\'s own session is set aside and restored exactly; the member login\'s setup steps live in one shared helper used by both the login and View as.', 'Planned'],
    ['LOGIN-22', 'A **Viewing as** bar on every page with **Return to my account**; Logout returns to the admin first.', 'Planned'],
    ['LOGIN-23', '**Who may:** System Admins and Member Admins, any member; Chapter Admins, their own chapter\'s members (if chosen). A new Security Groups function, `system/view_as_member`.', 'Planned (decision)'],
    ['LOGIN-24', "**Never more than the admin has:** nobody can view as a System Admin; only System Admins can view as a member who holds any admin role.", 'Planned (decision)'],
    ['LOGIN-25', "**Blocked while viewing as a member:** changing the member's password or second factor, their login name or email address, reissuing their card, and (when they exist) paying or voting for them. The page says why.", 'Planned (decision)'],
    ['LOGIN-26', "**Everything logged:** start and stop (admin, member, time), and every change made while viewing is written to the Auditlog as \"<admin> as <member>\".", 'Planned'],
    ['LOGIN-27', "Deceased and deleted members can't be viewed as; locked members can (to see what they'd see), with a warning.", 'Planned'],
    ['LOGIN-28', "Members can be told: their profile shows when an admin last viewed their account (no email).", 'Planned (decision)'],
    ['LOGIN-29', 'Works from either login: a staff System Admin signed in at /honcho can view as a member and return to the staff account.', 'Planned'],
  ]},
  { type: 'h2', text: 'Build Steps' },
  { type: 'ol', items: [
    "Move the member session setup out of the login into a shared helper; the login keeps working unchanged (tested first).",
    "View as / Return: the session swap, the bar, Logout handling, the search page and the button, permission and safety checks.",
    "The Auditlog marks changes made while viewing as a member; the blocked actions refuse with a message.",
    "Guides: Administrator's Guide (how to use it, what's blocked), Developer's Guide (how the swap works).",
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**Two logins per person, by design** (decided 17 Oct 2026). Someone who is both staff and a member signs in to each separately and has separate permissions in each.",
    "**A member username must never equal a staff username.** The login checks staff accounts first, so a matching member could never sign in. That's why BPA's member system administrator is `portaladmin`, not `sysadmin`.",
    "The staff `sysadmin` account is for `/honcho` only; on the member portal it passes both steps, then loops on \"Session has expired\".",
    "Deceased members can't sign in, and lose every admin role and group when the record is saved as Deceased (see Permissions).",
  ]},
]},

{ tab: "Known Problems", blocks: [
  { type: 'ul', items: [
    "Signing in to both logins in one browser mixes their session settings (the staff login doesn't clear the member's).",
    "`/honcho` can show \"Error 256\" instead of the login page.",
    "An \"unapproved account\" check exists in the member login but never stops anyone. Decide whether accounts need approval before turning it on.",
    "The Gmail app password once written in the code must still be revoked in the Google account (it is in the code's history).",
    "The Member Guide's \"Creating an Account\" section describes a link that is switched off (LOGIN-17); the guide needs correcting.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['17 Oct 2026', 'Keep two logins for this version; a full login redesign (one login per person, members and staff as profiles) is backlog.'],
    ['19 Oct 2026', 'Deceased, locked and deleted accounts are refused with their own messages (LOGIN-04).'],
    ['22 Oct 2026', 'The shared temporary second-factor code is removed; an account needs its own second factor (LOGIN-02).'],
    ['27 Oct 2026', 'A dedicated member system administrator account, `portaladmin`, for running BPA as Honcho Lite (LOGIN-13).'],
    ['27 Oct 2026', '"View as a member" to be built (LOGIN-16).'],
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['Member Guide', 'Chapter 1, Getting Started: Logging In'],
    ["Administrator's Guide", 'Chapter 6, System Admins'],
    ["Developer's Guide", 'Security chapter: Login Hardening; System Admin Accounts'],
    ['To-do list', 'Security; Login & accounts'],
  ]},
]},

];
