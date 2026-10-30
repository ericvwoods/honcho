// chapters/member-cards.js.js — plan chapter for the Honcho Planning Book (docs/plans).
// Converted 2026-10-30 from the online plan page: Digital Membership Cards (https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc)
// From now on this file is the master copy: change the plan here, rebuild with `node generate.js`,
// and republish the online page if it is still in use.

module.exports = [
 {
  "tab": "Overview",
  "blocks": [
   {
    "type": "p",
    "text": "_Plan for review · 26 October 2026_"
   },
   {
    "type": "p",
    "text": "Every member gets a card with a QR code: in the member portal and phone app, and in Apple Wallet or Google Wallet. At an event, a volunteer scans it with a phone. Honcho checks, live, that the member is current and has paid for that event, and records their attendance. Meetings use the same scan to take attendance."
   }
  ]
 },
 {
  "tab": "How it works at the door",
  "blocks": [
   {
    "type": "p",
    "text": "**1 · Member shows card:** From Apple or Google Wallet, the phone app, or the portal. No sign-in needed at the door."
   },
   {
    "type": "p",
    "text": "**2 · Volunteer scans:** A check-in page in the phone's browser, logged in, with the event chosen. Name or number lookup if the camera won't read it."
   },
   {
    "type": "p",
    "text": "**3 · Honcho checks live:** Card valid? Member current? Registered and paid for this event? Already checked in?"
   },
   {
    "type": "p",
    "text": "**4 · Admit and record:** A big green or red answer with the member's photo. Every scan goes into the event's attendance list."
   },
   {
    "type": "p",
    "text": "**Admit:** Current member, registered and paid (or a meeting with no fee)."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**Check:** Already checked in, Past Due (grace period), or registration pending payment."
   },
   {
    "type": "p",
    "text": "**Stop:** Not registered, unpaid, Expired, or a card that was cancelled."
   },
   {
    "type": "p",
    "text": "The volunteer can still let someone in after a \"Check\" or \"Stop\" (pay at the door, say). The override is recorded with their name."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**The QR code holds no personal information.** It's a long random code that only means something to Honcho. All the decisions are made live on the server, so a card never needs to be \"up to date\": if someone renews, lapses or is barred, the next scan knows. The photo on the scanner screen stops one card being passed around, and a second scan of the same card at the same event is flagged."
   }
  ]
 },
 {
  "tab": "What gets built",
  "blocks": [
   {
    "type": "table",
    "headers": [
     "Piece",
     "What it is"
    ],
    "rows": [
     [
      "**Member card**",
      "A \"My Card\" page in the portal and phone app: name, member number, chapter, member type, photo, \"valid through\" year (or \"Lifetime\" for 2099) and the QR code. Cancel and reissue a card if a phone is lost: the old QR stops working at once."
     ],
     [
      "**Door check-in**",
      "A phone-friendly page: choose the event, scan, see the answer. Name or member-number search as a fallback. Works for events and for chapter meetings."
     ],
     [
      "**Attendance**",
      "Each check-in recorded: who, which event, when, scanned by whom, the answer, any override. An attendance list per event with an Excel export, and counts on the event."
     ],
     [
      "**Apple Wallet**",
      "An \"Add to Apple Wallet\" button that downloads a signed card (`.pkpass`, style \"generic\") with the same QR."
     ],
     [
      "**Google Wallet**",
      "An \"Add to Google Wallet\" button: a signed link that saves the card to Google Wallet, with the same QR."
     ],
     [
      "**Card updates**",
      "When a member renews or changes chapter, the card in their Wallet updates itself (Google through its API; Apple through a small web service and Apple's push service)."
     ]
    ]
   },
   {
    "type": "h3",
    "text": "New tables"
   },
   {
    "type": "ul",
    "items": [
     "`ccmps_cards`: one active card per member (the random code, stored hashed; issued, cancelled; Wallet serial and object ids).",
     "`event_checkins`: event, member (or registration), time, scanned by, answer, override and reason.",
     "`wallet_devices` (Apple updates only): which iPhones hold which card, so Honcho can tell them to refresh.",
     "`events` gains: check-in open or not, members only, takes attendance."
    ]
   }
  ]
 },
 {
  "tab": "Phases",
  "blocks": [
   {
    "type": "p",
    "text": "Each phase works on its own and gets your sign-off before the next, as with the website and settings work."
   },
   {
    "type": "h3",
    "text": "Phase 1: The card in the portal and phone app"
   },
   {
    "type": "p",
    "text": "\"My Card\" page and phone app tab, cards table, cancel and reissue, a card for every member created on first view. No outside accounts needed; members can start showing it straight away."
   },
   {
    "type": "h3",
    "text": "Phase 2: Door check-in and attendance"
   },
   {
    "type": "p",
    "text": "The scanning page (camera QR reading with a small pinned library, since iPhone Safari has no built-in scanner), the live checks, overrides, the attendance list and export. Who may scan: Event Admins for any event, Chapter Admins for their chapter's events, and a new **Door Volunteers** group for the people at the table. Before the Event Module exists this checks membership only, which is all a meeting needs."
   },
   {
    "type": "h3",
    "text": "Phase 3: Apple Wallet and Google Wallet"
   },
   {
    "type": "p",
    "text": "The two \"Add to Wallet\" buttons. Needs the accounts below set up first, which can take a couple of weeks, so start them during Phase 1."
   },
   {
    "type": "h3",
    "text": "Phase 4: Cards that update themselves"
   },
   {
    "type": "p",
    "text": "Renewals, lapses and chapter changes pushed to the Wallet cards. Optional: the door check-in works without it, because it never trusts what's printed on the card."
   },
   {
    "type": "h3",
    "text": "Alongside: Event Module: registration and payment"
   },
   {
    "type": "p",
    "text": "Already on the to-do list: events with activities and fees, registration, and payment into the host's account (National, or the host chapter for the General Membership and Board meetings). When it lands, the door check-in starts answering \"registered and paid?\", and guests who aren't members get an emailed ticket with its own QR. It needs its own plan, mainly the payment processor choice."
   }
  ]
 },
 {
  "tab": "Accounts and costs",
  "blocks": [
   {
    "type": "table",
    "headers": [
     "Needed for",
     "Account",
     "Cost",
     "Lead time"
    ],
    "rows": [
     [
      "Apple Wallet",
      "Apple Developer Program, as an organization, plus a Pass Type ID and its signing certificate (renewed yearly)",
      "$99 a year",
      "An organization needs a D-U-N-S number (free, from Dun & Bradstreet), then Apple's review: allow 1 to 3 weeks"
     ],
     [
      "Google Wallet",
      "Google Pay & Wallet Console issuer account, Google Cloud service account",
      "Free",
      "Works in test mode at once; Google approves publishing in a few days"
     ],
     [
      "Phases 1, 2, 4 (Google)",
      "None",
      "None",
      "None"
     ]
    ]
   },
   {
    "type": "p",
    "text": "No new paid software: the Apple card is signed with PHP's own OpenSSL functions, and the Google link is a signed token, so nothing else needs to be installed. I'll confirm the current Apple and Google requirements against their documentation when Phase 3 starts."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**Whose Apple account?** Honcho will run for other organizations too. If the Apple and Google accounts are Honcho's (yours), one setup serves every client and each card still shows the client's name and colors. If they're BPA's, each new client repeats the setup. Check Apple's terms on issuing passes for other organizations before choosing."
   }
  ]
 },
 {
  "tab": "Security and privacy",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "**Only logged-in door staff can check a card.** Scanning the QR with an ordinary camera shows nothing useful.",
     "**Random, cancellable codes.** A lost phone means cancel and reissue; the old code is refused from then on. Codes are stored hashed, like passwords.",
     "**The card shows what a lock screen can safely show:** name, number, chapter, member type and year. No address, phone or email.",
     "**Every scan, override, cancellation and reissue goes in the Auditlog**, and the check-in page is limited to its groups (Security Groups functions such as `events/checkin`).",
     "**Screenshots:** a copied QR still shows the real member's photo at the door, and a second use at the same event is flagged."
    ]
   }
  ]
 },
 {
  "tab": "Decisions (accepted 2026-10-26)",
  "blocks": [
   {
    "type": "ol",
    "items": [
     "What should the card show? **Recommended:** name, member number, chapter, member type, photo (in the portal and app; Wallet cards have limited room for one), and \"Valid through 2027\" or \"Lifetime\".",
     "Who can scan at the door? **Recommended:** Event Admins (any event), Chapter Admins (their chapter's events) and a new Door Volunteers group that admins add people to for an event.",
     "Should a Past Due member (grace period) be admitted? **Recommended:** show \"Check\" (amber) and let the volunteer decide, so a member can renew on the spot.",
     "Do you need scanning without internet (hangars, rural airfields)? **Recommended:** not at first. If it's needed, a later step downloads the event's list to the volunteer's phone before the doors open and uploads the check-ins afterwards.",
     "Whose Apple and Google accounts? **Recommended:** Honcho's (yours), so every client is covered, after checking Apple's terms. Start the D-U-N-S and Apple enrollment during Phase 1 either way.",
     "Card design? **Recommended:** the logo and the color scheme from System Settings, so the card matches the portal, and a new client's card follows their own settings.",
     "Start with Phases 1 and 2 now, before the Event Module? **Recommended:** yes. Cards and meeting attendance are useful on their own, and the scanner simply gains the \"paid?\" check when registration arrives."
    ]
   }
  ]
 }
];
