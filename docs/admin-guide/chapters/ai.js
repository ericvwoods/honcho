// chapters/ai.js — Honcho Administrator's Guide: AI and the Daily Coffee Report (written 2026-10-29).
// Step-by-step setup for System Admins (National) and Chapter Admins (their chapter).
// Same block format and inline markup as docs/developer-guide/chapters/*.js

module.exports = [

{ tab: "What It Does", blocks: [
  { type: 'p', text: "The **Daily Coffee Report** is a short morning email for admins: membership numbers, upcoming events, Sunshine and Bulletin Board posts, documents waiting for approval, and any weathermembership numbers, today's birthdays, upcoming events, Sunshine and Bulletin Board posts, documents waiting for approval, and any weather, news and YouTube sections you choose. It can also go to a Telegram chat." },
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
    ['**Sent to**', "Tick to send it to the scope's admins (National: System and Member Admins; a chapter: its Chapter Admins); the page names them. **Also send it to these addresses** always receive it, ticked or not: one per line. Each address gets one copy, even if it is also an admin's"],
    ['**Telegram**', 'Optional: see Step 4'],
    ['**Email subject**', 'For example "BPA Daily Coffee Report"'],
    ['**Tone**', 'How the AI should write, for example "Friendly and brief, for volunteer leaders reading on a phone". It never changes the facts'],
    ['**Sections**', 'Tick the sections you want. The number boxes set their order (1 first). Fill in each section\'s options, then **Save**'],
  ]},
  { type: 'h2', text: 'The Sections' },
  { type: 'table', headers: ['Section', 'What it shows', 'Options'], rows: [
    ['**Membership**', 'Current members, past due, renewal rate; new members in the last 7 days', 'none'],
    ['**Birthdays today**', "Current, Pending and Past Due members whose birthday is today (a chapter: its own; National: everyone, with their chapter). Names only, no ages. It uses the Date of Birth on the member's record, or the Birthday field when there is no Date of Birth. Switched on, second, in every report", 'none'],
    ['**Upcoming events**', "Approved calendar events (a chapter sees its own and National's)", 'Days ahead'],
    ['**Sunshine and Bulletin Board**', 'Posts showing today on the member home', 'none'],
    ['**Documents waiting for approval**', "Document Library items in Pending Approval (a chapter: its own)", 'none'],
    ['**Weather**', "Today's forecast for each place", 'Locations, one per line, e.g. "Chicago, IL"'],
    ['**Markets**', "The previous trading day's close and change for each ticker symbol you list (stocks and funds such as AAPL, indices ^GSPC S&P 500, ^DJI Dow, ^IXIC Nasdaq, Bitcoin BTC-USD, gold GC=F, oil CL=F); WTI crude, the Prime Rate and the 30-year mortgage rate; exchange rates from US dollars", 'Ticker symbols, one per line; tick oil and rates (these need a free FRED API key on the server, set by whoever looks after it); currency codes, one per line (EUR, GTQ)'],
    ['**News**', 'Recent headlines for each search topic, duplicates removed', 'Topics, one per line; hours to look back; most headlines'],
    ['**YouTube channels**', 'New videos from chosen channels', 'One per line: "Name | channel ID" (the ID starts with UC); hours to look back'],
    ['**Sports**', "Yesterday's results and today's games for the leagues you tick (NFL, MLB, NBA, WNBA, MLS, NWSL), and golf leaderboards (PGA Tour, LPGA Tour, DP World Tour, PGA Tour Champions)", 'Tick leagues; for each golf tour choose Off, Top 10, Top 25 or Full leaderboard. Top 10 includes everyone tied at 10th, as on the tours\' own leaderboards'],
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
  { type: 'p', text: "The report can also go to Telegram: to several people, each getting their own copy, and/or to a group with the admins in it. Email and Telegram are sent separately, so if one fails the other still arrives. BPA's bot is **@BPAPilotsCoffeeBot**; National's report holds its token, and members' own reports use the same bot." },
  { type: 'h2', text: 'Making a Bot (once, by a System Admin)' },
  { type: 'ol', items: [
    "In Telegram, open **@BotFather** and send **/newbot**.",
    "Give it a **name** (what people see, for example \"BPA Coffee Report\") and a **username** ending in \"bot\" (permanent, for example BPAPilotsCoffeeBot).",
    "BotFather replies with the bot's **token** (123456789:ABC...) and its link (t.me/<username>). Keep the token private.",
    "Optional, in @BotFather: **/setuserpic** for the logo, **/setdescription** for the text people see before pressing Start.",
    "Turn on **Two-Step Verification** in your Telegram settings (Privacy and Security): whoever controls the account that made the bot controls the bot.",
  ]},
  { type: 'h2', text: 'Opening the Bot and Pressing Start' },
  { type: 'p', text: "A bot can't message anyone first. Everyone who should receive the report opens the bot once and taps **Start**. A new bot doesn't appear in anyone's chat list until they open it:" },
  { type: 'ul', items: [
    "**Easiest:** tap the link **t.me/<bot username>** (for BPA, t.me/BPAPilotsCoffeeBot), from BotFather's message or sent to them by email or text. It opens the chat with the bot.",
    "Or open **https://t.me/<bot username>** in a browser, which offers to open Telegram.",
    "Or search for **@<bot username>** in Telegram's search bar; a brand-new bot can take a while to appear in search.",
  ]},
  { type: 'p', text: "The chat opens with a **Start** button at the bottom: tap it. The bot then stays in their chat list." },
  { type: 'h2', text: 'Setting Up the Report' },
  { type: 'ol', items: [
    "In the report's settings, paste the **bot token** (only once; it's kept encrypted) and click **Save**.",
    "Click **Find chat ID**. Honcho lists the chats that have messaged the bot. Copy each number into **Chat IDs**, one per line (a group's number starts with -).",
    "Tick **Send to Telegram too** and click **Save**.",
    "Click **Telegram test**. The report should arrive in every chat on the list.",
  ]},
  { type: 'ul', items: [
    "**A person's chat ID is the same for every bot.** If you switch to a new bot, keep the chat IDs; each person only presses Start on the new bot.",
    "**A group:** add the bot to the group, post any message there, then Find chat ID shows the group's number.",
    "Long reports arrive as two or three messages. Tick **Remove the saved bot token** and save to delete the token.",
    "iMessage isn't available: it only works from an Apple computer, not a web server.",
  ]},
]},

{ tab: "Step 5: Test, Then Switch On", blocks: [
  { type: 'ul', items: [
    "**Preview** builds today's report and shows it on the page. Nothing is sent. Use it while choosing sections.",
    "**Send a test** emails it **To me** (your own address), or **To everyone on the \"Sent to\" list** as a dry run of the real email. If your account has no email address, only the list choice is offered.",
    "**Telegram test** sends it to the Telegram chat.",
    "When you're happy, set **Report** to **On** and **Save**. From the next scheduled time it goes out on the days you ticked, once a day.",
  ]},
  { type: 'h2', text: 'The Sent List' },
  { type: 'p', text: "**Sent** (on the Coffee Report page) lists every report sent: when, whether the AI wrote it, how many emails went out, whether Telegram worked, and any notes. **View** shows the report and, underneath, exactly what each section collected, so you can check the facts." },
]},

{ tab: "Bulletins", blocks: [
  { type: 'p', text: "A **bulletin** is a short notice printed word for word at the top of the Coffee Reports, right under the title, for as long as you choose. The AI never rewrites it." },
  { type: 'ol', items: [
    "Open **EMS > System Admin > Coffee Report** (Chapter Admins: **EMS > Chapter Admin > Coffee Report**) and click **Bulletins** on your report's row.",
    "Click **Add**. Give it a **title**, a short **message** and, if you like, a **link** (a full address starting with https://).",
    "Choose where it goes: **every report** (admins and members), **admins' reports only**, or **members' own reports only**.",
    "Set **Shows from** and **until** (both optional: blank means now, and no end), and click **Save**.",
  ]},
  { type: 'table', headers: ['Posted by', 'Appears on'], rows: [
    ['**National** (System Admins)', "National's report, every chapter's admin report and every member's own report (as chosen)"],
    ['**A chapter** (its Chapter Admins)', "That chapter's admin report and its members' own reports (as chosen)"],
  ]},
  { type: 'p', text: "The list shows whether each bulletin is **Showing** today, **Starts later**, has **Ended** or is **Hidden**. Untick **Shown** to take one down without deleting it; **Delete** asks for a second click." },
]},

{ tab: "Members' Own Reports", blocks: [
  { type: 'p', text: "Members can also get their own Daily Coffee Report: bulletins first, then the sections they choose (membership numbers, events, Sunshine and Bulletin Board, weather, markets, news and sports)(membership numbers, birthdays in their chapter, events, Sunshine and Bulletin Board, weather, markets, news and sports). It is plain facts, without AI, sent to the member's own email address and, if they link it, their Telegram." },
  { type: 'ul', items: [
    "**Switch it on for the organization:** **System Settings > Features & Policy > Members can get their own Coffee Report**. Members then see **My Coffee Report** in their menu. The AI module must be on.",
    "**Only Current members** can switch theirs on; anyone else sees why not. A member who stops being Current simply stops receiving it.",
    "**Membership numbers for members** are the totals of Current members nationwide and in their chapter.",
    "**Telegram:** members link their own Telegram to the organization's bot, the bot saved on **National's** Coffee Report (Step 4; BPA's is @BPAPilotsCoffeeBot), from a link on their My Coffee Report page. The Member Guide walks them through it.",
    "**Email volume:** every member report is one email a day. Brevo's free plan sends 300 a day; if many members switch it on, the Brevo plan must be sized to match.",
    "The Coffee Report page shows how many members have theirs switched on.",
  ]},
]},

{ tab: "If Something Goes Wrong", blocks: [
  { type: 'table', headers: ['What you see', 'What to do'], rows: [
    ['"No AI connection ... plain facts"', 'Fine if intended. To have the AI write it, do Step 1'],
    ['"The API key was refused"', 'The key was mistyped or deleted. Create a new one in the Anthropic Console and paste it again'],
    ['"The AI provider account needs credit"', 'Add credit or a payment method in the Anthropic Console'],
    ["\"This month's AI limit ... has been reached\"", 'Raise the monthly limit on the AI connection, or wait for next month; reports go out plain meanwhile'],
    ['"MAIL_FROM_EMAIL is not set"', 'Do Step 3'],
    ['"Email error: ..."', "Usually an unverified sender: check the sender in Brevo"],
    ['"Telegram: ... (Unauthorized)"', 'The bot token is wrong or was replaced: copy it again from @BotFather and paste it in Bot token'],
    ['"Telegram: sent to 1 of 2 chats. Not sent: 123456789 (... chat not found)"', "That person hasn't pressed **Start** on the bot (or the number is wrong). Send them the bot's t.me link; once they tap Start, Telegram test again"],
    ['"Telegram: ... (Forbidden: bot was blocked by the user)"', 'That person blocked the bot: they open the bot, unblock it and press Start'],
    ['"... unavailable" in one section', "That source didn't answer today; the rest of the report was still sent. If it keeps happening, check the section's options"],
    ['Nothing arrives at the set time', 'Check Report is On and today is ticked. The server must run the Coffee Report scheduler every 15 minutes (set up by whoever looks after the server)'],
  ]},
]},

];
