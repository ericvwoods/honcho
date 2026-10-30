// chapters/scheduler.js — Honcho Requirements, still in plan form (to be converted to the requirements format).
// Converted 2026-10-30 from the online plan page: Honcho Scheduler Plan (https://claude.ai/artifact/GyZQrdzfn2B197iL6GvRvD)
// From now on this file is the master copy: change the plan here, rebuild with `node generate.js`,
// and republish the online page if it is still in use.

module.exports = [
 {
  "tab": "Overview",
  "blocks": [
   {
    "type": "p",
    "text": "_Honcho add-on · plan approved · 30 Oct 2026_"
   },
   {
    "type": "p",
    "text": "Book a customer, an asset and a performer into one time slot, with a conflict check across all three. For example: a student, an airplane and an instructor; a patient, an exam room and a doctor; a member and a meeting room with no performer."
   }
  ]
 },
 {
  "tab": "What it does",
  "blocks": [
   {
    "type": "p",
    "text": "It follows the screens you sent from Flight Schedule Pro, rebuilt the Honcho way:"
   },
   {
    "type": "ul",
    "items": [
     "**Schedule board:** one day with a column for each asset and performer, hours down the side, and grey shading where someone or something is unavailable. Click an empty slot to book it. Filter by asset, performer, activity type and location.",
     "**New Reservation** and **Find a Time**: book a slot you choose, or let Honcho list the times when everything a booking needs is free.",
     "**Asset catalog** (the Aircraft page) and **performer directory** (the Instructors page): photo cards with a location filter and badges such as \"Chief\".",
     "**On the member home:** My Reservations, a New Reservation button and expiry alerts (\"Your Medical Certificate expired 12/1/2022\").",
     "**Reports:** hours per customer, how busy each asset and performer is, and no-shows, exported to Excel."
    ]
   },
   {
    "type": "p",
    "text": "N3775RAircraft"
   },
   {
    "type": "p",
    "text": "N28QWAircraft"
   },
   {
    "type": "p",
    "text": "Alex RemyInstructor"
   },
   {
    "type": "p",
    "text": "William MooreInstructor"
   },
   {
    "type": "p",
    "text": "Rich HartInstructor"
   },
   {
    "type": "p",
    "text": "8am"
   },
   {
    "type": "p",
    "text": "7:00 Maintenance (asset only)"
   },
   {
    "type": "p",
    "text": "9am"
   },
   {
    "type": "p",
    "text": "10am"
   },
   {
    "type": "p",
    "text": "10:00 Dual lesson J. Smith"
   },
   {
    "type": "p",
    "text": "10:00 Dual lesson J. Smith"
   },
   {
    "type": "p",
    "text": "11am"
   },
   {
    "type": "p",
    "text": "12pm"
   },
   {
    "type": "p",
    "text": "12:00 Ground school K. Lee"
   },
   {
    "type": "p",
    "text": "1pm"
   },
   {
    "type": "p",
    "text": "1:00 Solo · T. Ray"
   },
   {
    "type": "p",
    "text": "An example of the board with made-up bookings. One reservation appears in every column it uses: the 10:00 dual lesson holds both N3775R and William Moore. A solo flight uses only the aircraft; ground school uses only the instructor."
   }
  ]
 },
 {
  "tab": "Names are settings",
  "blocks": [
   {
    "type": "p",
    "text": "Each organization names its three roles on **System Settings > Scheduler**, the same way `CCMP` = \"Member\". Code uses constants such as `SCHED_CUSTOMER`, `SCHED_ASSET` and `SCHED_PERFORMER` (with plural forms) and never hard-codes \"Student\" or \"Aircraft\"."
   },
   {
    "type": "table",
    "headers": [
     "Organization",
     "Customer",
     "Asset",
     "Performer"
    ],
    "rows": [
     [
      "Flight school (BPA)",
      "Student",
      "Aircraft",
      "Instructor"
     ],
     [
      "Clinic",
      "Patient",
      "Exam Room",
      "Doctor"
     ],
     [
      "Salon",
      "Client",
      "Chair",
      "Stylist"
     ],
     [
      "Clubhouse",
      "Member",
      "Room",
      "(switched off)"
     ]
    ]
   },
   {
    "type": "p",
    "text": "One switch, **Use performers**, hides the performer everywhere for organizations that only book assets. Assets can also be split into kinds, as Flight Schedule Pro does with Aircraft, Meeting Rooms and Equipment. Each kind gets its own name and its own filter on the board."
   }
  ]
 },
 {
  "tab": "Business profiles",
  "blocks": [
   {
    "type": "p",
    "text": "One setting, **Business type**, chosen when the Scheduler is first set up. It fills in the names, adds starter activity types, says where performers come from, and switches on the sub-modules that kind of business needs. It's a starting point, not a lock: each switch can still be changed on its own. A flight school that also wants cost sharing can switch it on."
   },
   {
    "type": "table",
    "headers": [
     "Business type",
     "Names",
     "Performers are",
     "Maintenance",
     "Cost sharing",
     "Meters"
    ],
    "rows": [
     [
      "Flying club / aircraft partnership",
      "Member · Aircraft · Instructor",
      "Members (member login)",
      "on (annual, ELT, oil…)",
      "on",
      "Hobbs, tach"
     ],
     [
      "Flight school",
      "Student · Aircraft · Instructor",
      "Staff accounts (members allowed too)",
      "on (adds 100-hour)",
      "off",
      "Hobbs, tach"
     ],
     [
      "Equipment / tool rental",
      "Customer · Tool · (none)",
      "No performers",
      "on (service intervals)",
      "off",
      "hours used"
     ],
     [
      "Professional services",
      "Client · Room · Practitioner",
      "Staff accounts",
      "off",
      "off",
      "none"
     ],
     [
      "Custom",
      "Typed in",
      "Chosen",
      "each switched by hand",
      "",
      ""
     ]
    ]
   },
   {
    "type": "p",
    "text": "A clinic could rename \"Client\" to \"Patient\", or a salon \"Room\" to \"Chair\". The profile is only a starting point."
   }
  ]
 },
 {
  "tab": "Every performer has a login",
  "blocks": [
   {
    "type": "p",
    "text": "A performer must be someone who can sign in, so they always see their own schedule. A setting says where performers come from:"
   },
   {
    "type": "ul",
    "items": [
     "**Members:** a member who instructs uses their member login. No second account is needed. This suits flying clubs and partnerships.",
     "**Staff accounts:** an instructor, doctor or practitioner who isn't a member gets a Honcho staff account. This suits flight schools and professional services, where performers are rarely members.",
     "**Both** (the flight school default): staff instructors plus any member instructors."
    ]
   },
   {
    "type": "p",
    "text": "Both kinds already have a `trongate_users` row, so a performer is stored as one `tg_user_id` and the security groups work the same for both. A staff instructor who also flies as a customer (a flight review, for example) has two accounts, one in each place, as you said."
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**One limit:** Honcho Lite (member portal only, no staff module) has no staff accounts, so it can only use member performers. A flight school or clinic needs Honcho with the staff module deployed. The Business type screen will say so when you pick one of those."
   }
  ]
 },
 {
  "tab": "Maintenance sub-module",
  "blocks": [
   {
    "type": "p",
    "text": "Switched on by the flying, flight school and rental profiles. For each asset it keeps:"
   },
   {
    "type": "ul",
    "items": [
     "**Meters:** Hobbs and tach (or \"hours used\" for a tool). Updated at check-in, or entered by hand.",
     "**Inspections by hours, by date, or both:** annual (12 calendar months), 100-hour (aircraft used for hire or instruction), ELT (12 months), transponder and pitot-static (24 months), oil change (for example every 50 hours), and recurring Airworthiness Directives. Each one tracks when it was last done and when it is next due.",
     "**Alerts** before something is due (for example 10 hours or 30 days ahead), on the board, by email, and as a Coffee Report section.",
     "**Grounding:** when an item is overdue, the asset can't be booked past that point, and existing bookings are flagged for staff.",
     "**Squawks:** a pilot reports a problem at check-in. Staff decide whether it grounds the aircraft, then close it when fixed.",
     "**Maintenance log:** work done, by whom, meter reading, cost, and the signed paperwork filed in the Document Library."
    ]
   }
  ]
 },
 {
  "tab": "Cost sharing sub-module (partnerships and clubs)",
  "blocks": [
   {
    "type": "p",
    "text": "For splitting an aircraft's costs among its partners:"
   },
   {
    "type": "ul",
    "items": [
     "**Expenses per aircraft:** insurance, hangar or tiedown, annual, maintenance (taken from the maintenance log), loan, subscriptions. Each is one-off or repeating (monthly, yearly).",
     "**Split rules per expense type:** fixed costs equally or by ownership share; flying costs by hours flown, which the Scheduler already knows from check-in.",
     "**Monthly statement per partner:** their share of each expense, hours flown, and the total. Shown on screen, exported to Excel and emailed.",
     "**Cost per hour:** fixed costs plus flying costs divided by hours flown, to help set a club's rental rate."
    ]
   },
   {
    "type": "p",
    "text": "Collecting the money stays with the financial module. These statements say what each partner owes; the financial module will invoice it and record payments."
   }
  ]
 },
 {
  "tab": "Activity types decide what a booking needs",
  "blocks": [
   {
    "type": "p",
    "text": "The three roles aren't fixed per organization; they're set per **activity type**. Each type says which roles it needs, how long it usually lasts, its color, its buffer time and who may book it:"
   },
   {
    "type": "table",
    "headers": [
     "Activity type",
     "Customer",
     "Asset",
     "Performer",
     "Who can book"
    ],
    "rows": [
     [
      "Dual lesson",
      "required",
      "Aircraft",
      "required",
      "Member or staff"
     ],
     [
      "Solo / rental",
      "required",
      "Aircraft",
      "none",
      "Member (if checked out)"
     ],
     [
      "Ground lesson",
      "required",
      "Meeting room (optional)",
      "required",
      "Member or staff"
     ],
     [
      "Maintenance",
      "none",
      "Aircraft",
      "none",
      "Staff only"
     ],
     [
      "Time off",
      "none",
      "none",
      "required",
      "The performer or staff"
     ]
    ]
   },
   {
    "type": "p",
    "text": "This one setting covers all the cases you described, so the module needs no separate \"with performer\" and \"without performer\" versions."
   }
  ]
 },
 {
  "tab": "How it fits Honcho",
  "blocks": [
   {
    "type": "ul",
    "items": [
     "**Customers are existing records.** At BPA a customer is a `ccmps` member, so Summer Flight Academy students book through the same login.",
     "**Performers are logins.** Each performer links to a `trongate_users` account, either a member login or a staff account (see above).",
     "**Assets and locations belong to a scope.** National, or a chapter through `subentity_id`, so a chapter can schedule its own airplane. Chapter Admins manage only their own.",
     "**Permissions use RBAC.** A `schedule` module row with these functions: view_board, book_self, book_others, manage_resources, manage_settings and view_reports. It is switched on per client like PMS (an add-on, not Core).",
     "**Messages use what's already built.** Brevo email for confirmations and reminders, Telegram later, the cron pattern from the Coffee Report, and a \"Today's schedule\" section for the Coffee Report."
    ]
   }
  ]
 },
 {
  "tab": "Tables",
  "blocks": [
   {
    "type": "p",
    "text": "New tables, all prefixed `sched_`, created by one re-runnable migration:"
   },
   {
    "type": "table",
    "headers": [
     "Table",
     "Holds"
    ],
    "rows": [
     [
      "`sched_locations`",
      "Name, address, time zone, subentity_id"
     ],
     [
      "`sched_resource_types`",
      "Kinds such as Aircraft, Meeting Room and Instructor: role (asset or performer), singular and plural names, icon, sort order"
     ],
     [
      "`sched_resources`",
      "Each airplane, room or instructor: type, name, photo, description, location, badge, hourly rate, status (in service or grounded), tg_user_id for performers"
     ],
     [
      "`sched_activity_types`",
      "Name, color, needs customer / asset type / performer, default and minimum/maximum length, buffer before and after, who can book"
     ],
     [
      "`sched_hours`",
      "Each resource's regular hours, by weekday"
     ],
     [
      "`sched_blocks`",
      "One-off unavailability: time off, closures (maintenance is a reservation, so it shows as a red block)"
     ],
     [
      "`sched_reservations`",
      "Activity type, customer, location, start, end, status (tentative, confirmed, checked out, checked in, cancelled, no-show), notes, created_by, recurrence group"
     ],
     [
      "`sched_reservation_resources`",
      "One row per resource a reservation holds. The conflict check reads this table"
     ]
    ]
   },
   {
    "type": "h3",
    "text": "Preventing double bookings"
   },
   {
    "type": "p",
    "text": "A booking is allowed only if none of its resources (and not the customer either) has another active reservation that overlaps (`start < new_end AND end > new_start`, buffers included) and each resource is within its hours and has no block. The check and the insert run in one transaction that locks those resources' rows, so two people clicking at the same moment can't both get the slot. The form checks as you type, and the server checks again on Save."
   },
   {
    "type": "p",
    "text": "**Find a Time** uses the same rules: for each day in the range it works out the free time each needed resource has in common and lists the slots long enough for the booking."
   }
  ]
 },
 {
  "tab": "The board: build it, don't buy it",
  "blocks": [
   {
    "type": "p",
    "text": "The theme's FullCalendar is version 2.9.1 from 2016. A column per aircraft or instructor needs FullCalendar's Scheduler add-on, which needs a paid license for commercial use, and you'd need one for every client. I recommend drawing the board ourselves: CSS grid columns, time rows, and blocks placed from start and end times, as in the example above. It's a few hundred lines of plain JavaScript with no build step, no license fees, and works the same on a phone. A personal week or month view can use a current open-source (MIT) FullCalendar later, if that's wanted."
   }
  ]
 },
 {
  "tab": "Phases",
  "blocks": [
   {
    "type": "h3",
    "text": "Phase 0: Foundations"
   },
   {
    "type": "ul",
    "items": [
     "Migration: tables, the RBAC module and functions, and the Scheduler settings tab (Business type, names, where performers come from, sub-module switches).",
     "Setup screens using the maintenance-table pattern: locations, resource types, resources (with photos), activity types and hours."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 1: Staff booking"
   },
   {
    "type": "ul",
    "items": [
     "Day board with filters, date picker and Today.",
     "Reservation form: create, change, cancel, with the live conflict check.",
     "Blocks (time off, closures). Asset catalog and performer directory."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 2: Members book themselves"
   },
   {
    "type": "ul",
    "items": [
     "My Reservations and New Reservation on the member home.",
     "Find a Time.",
     "Confirmation, change and reminder emails.",
     "Performers see and manage their own day."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 3: Operations"
   },
   {
    "type": "ul",
    "items": [
     "Week and month views. Repeating bookings (every Tuesday for 8 weeks).",
     "Check out and check in (Hobbs and tach readings for aircraft, meters for any asset).",
     "No-show marking. Reports and Excel export."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 4: Maintenance sub-module"
   },
   {
    "type": "ul",
    "items": [
     "Inspection items by hours and/or date, with presets per business type.",
     "Alerts, grounding that blocks bookings, squawks, and a maintenance log with Document Library paperwork."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 5: Cost sharing sub-module"
   },
   {
    "type": "ul",
    "items": [
     "Aircraft expenses and split rules.",
     "Monthly partner statements and cost per hour.",
     "Hands the amounts to the financial module once it exists."
    ]
   },
   {
    "type": "h3",
    "text": "Phase 6: Rules and reach"
   },
   {
    "type": "ul",
    "items": [
     "Qualifications: an asset can require a checkout, and an activity can require a current medical or flight review. These checks feed the expiry alerts on the home page.",
     "Calendar feed (iCal) for Google and Apple calendars.",
     "Phone app screen, Coffee Report section, Telegram and SMS reminders."
    ]
   },
   {
    "type": "alert",
    "variant": "info",
    "text": "**Not in this plan:** account balances, Add Funds, charging for flight time and collecting partners' shares. All of that comes with the financial module, which will use the hours and statements this module records."
   }
  ]
 },
 {
  "tab": "Decisions (Eric, 30 Oct 2026)",
  "blocks": [
   {
    "type": "ol",
    "items": [
     "**An add-on,** sold as its own option like PMS.",
     "**Staff book first** (Phase 1); members book for themselves from Phase 2.",
     "**Every performer has a login:** a member login (clubs and partnerships) or a Honcho staff account (flight schools and professional services). Someone who is both a performer and a customer has an account in each place.",
     "**Chapters can own assets** as well as National.",
     "**Billing comes with the financial module.**",
     "**\"Scheduler\" is the default menu name.** A System Admin can change it on System Settings, like the role names. Code `sched`.",
     "**A Business type setting** (flying club or partnership, flight school, equipment rental, professional services, custom) presets the names and performers and switches on the Maintenance and Cost sharing sub-modules."
    ]
   }
  ]
 }
];
