// chapters/ai.js — Honcho Administrator's Guide: AI and the Daily Coffee Report (written 2026-10-29).
// Step-by-step setup for System Admins (National) and Chapter Admins (their chapter).
// Same block format and inline markup as docs/developer-guide/chapters/*.js

module.exports = [

{ tab: "What It Does", blocks: [
  { type: 'p', text: "The **Daily Coffee Report** is a short morning email for admins: membership numbers, upcoming events, Sunshine and Bulletin Board posts, documents waiting for approval, and any weather, news and YouTube sections you choose. It can also go to a Telegram chat." },
  { type: 'p', text: "Honcho collects every fact itself. If you connect an AI, the AI turns those facts into a friendly, easy-to-read report; it is told to use only the facts it is given and to keep every number exactly. Without AI, or if the AI is unavailable that day, the plain facts are sent instead, so the report always goes out." },
  { type: 'table', headers: ['Who', 'Sets up', 'Gets'], rows: [
    ['**System Admins**', "National's AI connection and National's Coffee Report", "National's report"],
    ['**Member Admins**', '(nothing)', "National's report, if National sends it to admins"],
    ['**Chapter Admins**', "Their chapter's own AI connection (optional) and their chapter's Coffee Report", "Their chapter's report"],
  ]},
  { type: 'alert', variant: 'info', text: "The AI module must be switched on first: **System Admin > Security Groups > Modules**, switch on **AI assistant (Honcho AI)**. Until then the AI and Coffee Report pages aren't in the menu." },
]},

{ tab: "Step 1: Connect the AI", blocks: [
  { type: 'p', text: "Skip this step to send plain reports. To have the AI write them:" },
  { type: 'ol', items: [
    "Sign in at **console.anthropic.com** with the account that will pay for the AI (or create one). Add a payment method.",
    "In the Console, set a **monthly spend limit** for the account. This is your safety net.",
    "Open **API keys** and create a key (name it, for example, \"Honcho\"). Copy it; it is shown only once.",
    "In Honcho open **EMS > System Admin > AI Connections** (Chapter Admins: **EMS > Chapter Admin > Chapter AI**) and click **Set up** (or **Edit**).",
    "Paste the key, choose a model (Claude Opus 5.5 is the default; Sonnet and Haiku cost less), set a **monthly limit** in dollars, leave Connection **On**, and click **Save**.",
    "Click **Test connection**. \"Connected: the AI answered\" means it works.",
  ]},
  { type: 'alert', variant: 'warning', text: "A Claude or ChatGPT **subscription** (Pro, Max, Plus, Team) can't be used here. The providers allow those logins only in their own apps. Honcho needs an **API key**, which is billed by use." },
  { type: 'ul', items: [
    "The key is stored encrypted and never shown again; the screen shows only its last 4 characters.",
    "When this month's estimated cost reaches your limit, the AI pauses until next month and reports go out plain.",
    "**Remove key** (click twice) deletes the key and switches the connection off.",
    "**Chapters without their own connection** use National's, or get no AI, depending on **System Settings > Features & Policy > Chapters without their own AI**.",
    "**Usage** (on the AI Connections page) shows requests and estimated cost by month, National and each chapter.",
  ]},
]},

{ tab: "Step 2: Set Up the Report", blocks: [
  { type: 'p', text: "Open **EMS > System Admin > Coffee Report** (Chapter Admins: **EMS > Chapter Admin > Coffee Report**) and click **Set up** or **Settings**." },
  { type: 'table', headers: ['Setting', 'What to enter'], rows: [
    ['**Report**', '**Off** while you set it up; **On** when you want it sent every day'],
    ['**When**', 'The time, your time zone, and the days of the week'],
    ['**Sent to**', "Tick to send it to the scope's admins (National: System and Member Admins; a chapter: its Chapter Admins). Add more addresses, one per line"],
    ['**Telegram**', 'Optional: see Step 4'],
    ['**Email subject**', 'For example "BPA Daily Coffee Report"'],
    ['**Tone**', 'How the AI should write, for example "Friendly and brief, for volunteer leaders reading on a phone". It never changes the facts'],
    ['**Sections**', 'Tick the sections you want. The number boxes set their order (1 first). Fill in each section\'s options, then **Save**'],
  ]},
  { type: 'h2', text: 'The Sections' },
  { type: 'table', headers: ['Section', 'What it shows', 'Options'], rows: [
    ['**Membership**', 'Current members, past due, renewal rate; new members in the last 7 days', 'none'],
    ['**Upcoming events**', "Approved calendar events (a chapter sees its own and National's)", 'Days ahead'],
    ['**Sunshine and Bulletin Board**', 'Posts showing today on the member home', 'none'],
    ['**Documents waiting for approval**', "Document Library items in Pending Approval (a chapter: its own)", 'none'],
    ['**Weather**', "Today's forecast for each place", 'Locations, one per line, e.g. "Chicago, IL"'],
    ['**News**', 'Recent headlines for each search topic, duplicates removed', 'Topics, one per line; hours to look back; most headlines'],
    ['**YouTube channels**', 'New videos from chosen channels', 'One per line: "Name | channel ID" (the ID starts with UC); hours to look back'],
  ]},
  { type: 'p', text: "A YouTube channel ID: open the channel on youtube.com, choose **About** (or **Share channel**) and copy the channel ID, which starts with **UC**." },
]},

{ tab: "Step 3: Email Sender", blocks: [
  { type: 'p', text: "Reports are emailed through Brevo, from an address Brevo has verified. This is done once, by whoever looks after the server:" },
  { type: 'ol', items: [
    "In Brevo, open **Settings > Senders, Domains & Dedicated IPs > Senders** and add the address reports should come from (ideally one at the organization's own domain). Brevo emails a confirmation link to it; click it.",
    "In the server's **.env** file set **MAIL_FROM_EMAIL** to that address and **MAIL_FROM_NAME** to the name people should see, for example \"BPA Coffee Report\".",
  ]},
  { type: 'alert', variant: 'info', text: "On a test server (WHATENV=dev) every report goes only to the developer's address, never to real admins, so testing is safe." },
]},

{ tab: "Step 4: Telegram (Optional)", blocks: [
  { type: 'p', text: "The report can also go to a Telegram chat: one person, or a group with the admins in it. Email and Telegram are sent separately, so if one fails the other still arrives." },
  { type: 'ol', items: [
    "In Telegram, open **@BotFather**, send **/newbot**, choose a name and a username ending in \"bot\". BotFather replies with a **token** like 123456789:ABC....",
    "For a group: add the new bot to your admins' group. For yourself: open the bot and press **Start**. Then post any message (in the group or to the bot).",
    "In the report's settings, tick **Send to Telegram too**, paste the **bot token**, and click **Save**.",
    "Click **Find chat ID**. Honcho lists the chats that have messaged the bot; copy the number (groups start with -) into **Chat ID** and **Save** again.",
    "Click **Telegram test**. The report should arrive in the chat.",
  ]},
  { type: 'p', text: "Long reports arrive as two or three messages. The token is stored encrypted; tick **Remove the saved bot token** and save to delete it. iMessage isn't available: it only works from an Apple computer, not a web server." },
]},

{ tab: "Step 5: Test, Then Switch On", blocks: [
  { type: 'ul', items: [
    "**Preview** builds today's report and shows it on the page. Nothing is sent. Use it while choosing sections.",
    "**Send me a test** emails it to you (if your account has no email address, to the report's extra addresses).",
    "**Telegram test** sends it to the Telegram chat.",
    "When you're happy, set **Report** to **On** and **Save**. From the next scheduled time it goes out on the days you ticked, once a day.",
  ]},
  { type: 'h2', text: 'The Sent List' },
  { type: 'p', text: "**Sent** (on the Coffee Report page) lists every report sent: when, whether the AI wrote it, how many emails went out, whether Telegram worked, and any notes. **View** shows the report and, underneath, exactly what each section collected, so you can check the facts." },
]},

{ tab: "If Something Goes Wrong", blocks: [
  { type: 'table', headers: ['What you see', 'What to do'], rows: [
    ['"No AI connection ... plain facts"', 'Fine if intended. To have the AI write it, do Step 1'],
    ['"The API key was refused"', 'The key was mistyped or deleted. Create a new one in the Anthropic Console and paste it again'],
    ['"The AI provider account needs credit"', 'Add credit or a payment method in the Anthropic Console'],
    ["\"This month's AI limit ... has been reached\"", 'Raise the monthly limit on the AI connection, or wait for next month; reports go out plain meanwhile'],
    ['"MAIL_FROM_EMAIL is not set"', 'Do Step 3'],
    ['"Email error: ..."', "Usually an unverified sender: check the sender in Brevo"],
    ['"Telegram: not sent (Unauthorized)"', 'The bot token is wrong: copy it again from @BotFather'],
    ['"Telegram: not sent (chat not found)"', 'Wrong chat ID, or nobody has messaged the bot: post in the chat and use Find chat ID'],
    ['"... unavailable" in one section', "That source didn't answer today; the rest of the report was still sent. If it keeps happening, check the section's options"],
    ['Nothing arrives at the set time', 'Check Report is On and today is ticked. The server must run the Coffee Report scheduler every 15 minutes (set up by whoever looks after the server)'],
  ]},
]},

];
