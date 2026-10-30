// chapters/member-cards.js — Honcho Requirements: Digital Membership Cards (requirement prefix CARD).
// Rewritten 2026-10-30 from the plan of 2026-10-26 (https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc),
// checked against the code: engine/tg_helpers/card_helper.php, wallet_helper.php,
// modules/welcome/cards/, welcome-api mycard/reissuecard/googlewallet, 2026-10-26-member-cards.sql.
// Requirement numbers never change or get reused; a dropped requirement stays, marked Dropped.

module.exports = [

{ tab: "Purpose", blocks: [
  { type: 'p', text: "Every member has a digital membership card with a QR code, in the member portal, the phone app and their phone's wallet. At an event or meeting, a volunteer scans it and Honcho checks, at that moment, that the person is a current member (and, once the Event Module exists, registered and paid), and records their attendance." },
  { type: 'table', headers: ['Who', 'Uses it to'], rows: [
    ['**Members**', 'Show their card at the door; replace it if their phone is lost'],
    ['**Member, System and Chapter Admins**', "See and replace a member's card"],
    ['**Event Admins, Chapter Admins, Door Volunteers**', 'Scan cards at the door (planned)'],
  ]},
  { type: 'p', text: "**Module:** Core (part of the member records). **To-do section:** Digital membership cards." },
]},

{ tab: "How It Works at the Door", blocks: [
  { type: 'p', text: "The door check-in is planned (phase 2); this is how it is designed to work." },
  { type: 'ol', items: [
    "**The member shows the card** from the phone app, the portal or a phone wallet. No sign-in is needed at the door.",
    "**A volunteer scans it** on a check-in page in their phone's browser, logged in, with the event chosen.",
    "**Honcho checks live:** is the card valid, the member current, registered and paid, already checked in?",
    "**The answer appears** in green, amber or red with the member's photo, and the scan goes into the event's attendance list.",
  ]},
  { type: 'p', text: "Because every decision is made on the server at the moment of the scan, a card never needs to be \"up to date\": if someone renews, lapses or is barred, the next scan knows." },
]},

{ tab: "Requirements", blocks: [
  { type: 'p', text: "**Built** = working (date built; deployed to staging unless noted). **In progress** = built but not yet working. **Planned** = agreed, not built. **Changed** = built differently from the plan, with the reason." },

  { type: 'h2', text: 'The Card' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['CARD-01', 'Every member has one active card. It is created automatically the first time the member (or an admin) opens it.', 'Built 26 Oct 2026'],
    ['CARD-02', 'The card shows the organization\'s logo and name, the member\'s photo (or initials when there is no photo), name, member number, chapter, member type, and "Valid through" with the year paid through, or "Lifetime".', 'Built 26 Oct 2026'],
    ['CARD-03', 'The card carries a QR code that identifies the card only. It contains no personal information, and nothing stored in the database is enough to make a working code.', '**Changed:** built as a card number plus a signature made with a server key (`HC1:<card>:<signature>`), not a stored random code as planned. Same protection, and changing the key cancels every card at once'],
    ['CARD-04', "The card's colors come from the organization's color scheme (System Settings), so it matches the portal and each client's cards follow their own settings.", 'Built 26 Oct 2026'],
    ['CARD-05', 'Members open their card from **My Card** in the home page side menu, and from the **Card** tab of the phone app.', 'Built 26 Oct 2026'],
    ['CARD-06', 'Deceased and deleted members have no card.', 'Built 26 Oct 2026'],
    ['CARD-07', 'Cards are for members only; staff accounts have none.', 'Built 26 Oct 2026'],
  ]},

  { type: 'h2', text: 'Lost or Replaced Cards' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['CARD-08', 'A member can cancel their card and get a new one (for a lost phone) from the portal or the phone app, after confirming that the old card stops working. The old QR code is refused from that moment, wherever it is.', 'Built 26 Oct 2026'],
    ['CARD-09', "An admin can do the same for a member they manage (CARD-11).", 'Built 26 Oct 2026'],
    ['CARD-10', 'Every replacement, and every "Add to Google Wallet", is recorded in the Auditlog with who did it.', 'Built 26 Oct 2026'],
  ]},

  { type: 'h2', text: "Seeing Someone Else's Card" },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['CARD-11', "System Admins, Member Admins and staff with member-records access can open any member's card from the **Card** button on the member record. Chapter Admins can open cards of their own chapter's members only.", 'Built 26 Oct 2026'],
  ]},

  { type: 'h2', text: 'Phone Wallets' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['CARD-12', '**Add to Google Wallet** button on My Card and in the phone app saves the card, with the same QR code, to Google Wallet.', '**In progress:** built 26 Oct 2026, not yet working. Waiting on a permission step in the Google Pay & Wallet Console (Google last refused with 403). Then Google must approve publishing; until then only test accounts can save cards'],
    ['CARD-13', "When a card is replaced, its old copy in Google Wallet shows as inactive.", '**In progress** (as CARD-12)'],
    ['CARD-14', '**Add to Apple Wallet** button.', 'Planned, later. Needs a D-U-N-S number and Apple Developer enrollment as an organization ($99 a year, 1 to 3 weeks); start early'],
    ['CARD-15', "Wallet cards update themselves when a member renews or changes chapter.", "Planned (phase 4). Today Google's copy is refreshed whenever the member taps Add to Google Wallet again"],
  ]},

  { type: 'h2', text: 'Door Check-in and Attendance' },
  { type: 'table', headers: ['ID', 'Requirement', 'Status'], rows: [
    ['CARD-16', 'A phone-friendly check-in page: the volunteer chooses the event and scans with the camera; search by name or member number when a code won\'t scan.', 'Planned (phase 2)'],
    ['CARD-17', 'Each scan answers **Admit** (green: current, registered and paid, or a meeting with no fee), **Check** (amber: already checked in, Past Due within the grace period, or payment pending) or **Stop** (red: not registered, unpaid, Expired, or a cancelled card), with the member\'s photo.', 'Planned (phase 2)'],
    ['CARD-18', 'The volunteer may still admit someone after Check or Stop (to pay at the door, say). The override is recorded with their name and reason.', 'Planned (phase 2)'],
    ['CARD-19', 'A second scan of the same card at the same event is flagged.', 'Planned (phase 2)'],
    ['CARD-20', "Every scan goes into the event's attendance list, with an Excel export and counts on the event.", 'Planned (phase 2)'],
    ['CARD-21', 'Who may scan: Event Admins (any event), Chapter Admins (their chapter\'s events), and a new **Door Volunteers** group that admins add people to.', 'Planned (phase 2)'],
    ['CARD-22', 'Works for chapter meetings and attendance before the Event Module exists, checking membership only. "Registered and paid" and emailed guest tickets with their own QR code arrive with the Event Module.', 'Planned (phase 2; Event Module later)'],
  ]},
]},

{ tab: "Business Rules", blocks: [
  { type: 'ul', items: [
    "**One active card per member.** Replacing a card cancels the old one first.",
    "**\"Valid through\"** is the member's paid-through year; a lifetime member (year 2099) shows **Lifetime**.",
    "**The card decides nothing.** Membership, payment and attendance are checked live when the card is scanned, never read from the card.",
    "**Only logged-in door staff can check a card.** Scanning the QR code with an ordinary camera shows only a code that means nothing elsewhere.",
    "**The card shows only what a lock screen can safely show:** no address, phone number or email.",
    "**Photos matter at the door:** the photo on the scanner screen stops a card (or a screenshot of one) being shared. In the current test data only 14 of 1,725 members have a photo, so members should be asked to add one.",
  ]},
]},

{ tab: "Decisions", blocks: [
  { type: 'table', headers: ['Date', 'Decision'], rows: [
    ['26 Oct 2026', "Go ahead with the plan's recommendations: the card contents (CARD-02), who may scan (CARD-21), Past Due members get Check rather than Stop (CARD-17), no scanning without internet at first, the organization's color scheme on the card (CARD-04), and phases 1 and 2 before the Event Module."],
    ['26 Oct 2026', 'Google Wallet now; Apple Wallet and event registration later.'],
    ['26 Oct 2026', "The Apple and Google accounts are Honcho's own, so one setup serves every client (check Apple's terms on issuing passes for other organizations first)."],
    ['26 Oct 2026', 'The QR code is a signed card number rather than a stored random code (CARD-03).'],
  ]},
]},

{ tab: "Not Included", blocks: [
  { type: 'ul', items: [
    "**Scanning without internet** (hangars, rural airfields): not at first. If needed later, the event's list would be downloaded to the volunteer's phone before the doors open and the check-ins uploaded afterwards.",
    "**Guest tickets and paid-registration checks:** part of the Event Module, which needs its own plan.",
  ]},
]},

{ tab: "Related Documents", blocks: [
  { type: 'table', headers: ['Document', 'Where'], rows: [
    ['Member Guide', 'Chapter 2, For Every Member: Your Membership Card'],
    ["Developer's Guide", 'CCMPS chapter: Member Cards (`card_helper.php`, `wallet_helper.php`, `welcome-cards`, the phone API)'],
    ['To-do list', 'Digital membership cards (Chapter 7 of this book)'],
    ['Original plan, 26 Oct 2026', 'https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc'],
  ]},
]},

];
