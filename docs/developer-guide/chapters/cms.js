// ============================================================
// chapters/cms.js — Website (CMS) chapter of the Honcho Developer's Guide
// ============================================================
// Core. Written 2026-10-20 as the content manager is built in phases
// (plan in docs/todo.md, "Home page content (CMS)"). Same block format
// and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Overview", blocks: [
  { type: 'p', text: "The content manager decides what the member home (`ccmphome.php`) and the public website show, section by section. In the code and database it is **`cms`**; users see the name in the `CMS_LABEL` constant (`config/config.php`, \"Website\" for BPA), like `CCMP` and `SUBENTITY`. Use the constant in any menu or page text." },
  { type: 'p', text: "It replaced the eight prototype modules in `modules/cms/` (marquee, jumbotron, bulletin board, notices, jobs, activities, sunshine, subentities) and their 37 `cms_ccmps_*` / `cms_users_*` tables (including the old CMS library tables), which were never finished. Decided 2026-10-20: rebuild, keep nothing; they were deleted in phase 3 (`database/migrations/2026-10-20-cms-drop-old-tables.sql`). Notices and Activities have no direct replacement: announcements go in the Marquee or Bulletin Board, activities become calendar events (phase 5)." },

  { type: 'h2', text: 'Phases' },
  { type: 'table', headers: ['Phase', 'What', 'Status'], rows: [
    ['1', 'Tables; Content Admin and Event Admin roles; `cms` permissions', 'Built 2026-10-20'],
    ['2', 'Content manager screens (`cms-content`): sections, items, picture library; Website menus', 'Built 2026-10-20'],
    ['3', 'Sunshine, Bulletin Board, Marquee and Careers screens on `cms_posts`; job detail page; old modules and tables deleted', 'Built 2026-10-20'],
    ['4', '`ccmphome.php` drawn from the tables, with the one-page menu', 'Built 2026-10-20'],
    ['5', 'Events calendar (FullCalendar 6) on `events`; event screens for Event Admins (all) and Chapter Admins (own chapter)', 'Built 2026-10-20'],
    ['6', 'Public website in the Welcome module (`welcome/website`, `welcome/job/{id}`, template `website`); BPA content loaded from bpapilots.org', 'Built 2026-10-20'],
    ['7', 'Posting by Chapter Admins (Sunshine, Bulletin Board, Careers for All Members or their chapter) and members (their own sticky notes, approved unless an admin holds them back)', 'Built 2026-10-20'],
    ['Last', 'Event Module: registration events and activities on `events` + `event_activities`', ''],
  ]},
]},

// ============================================================
{ tab: "Tables", blocks: [
  { type: 'p', text: "Created by `database/migrations/2026-10-20-cms-content-phase1.sql` (safe to re-run). InnoDB, utf8mb4, `created_by/at` and `updated_by/at` as `int` like the rest of the schema. Foreign keys: deleting a section deletes its items; deleting a picture sets `media_id` to NULL where it was used (the screens refuse to delete a picture in use anyway)." },
  { type: 'table', headers: ['Table', 'Holds', 'Key columns'], rows: [
    ['`cms_sections`', 'One row per page section', '`code` (unique, what page code looks for), `layout` (which template part draws it), `title`, `subtitle`, `menu_label` (blank = not in the one-page menu), `show_member`, `show_public`, `allow_public` (0 = member home only, e.g. Membership Vitals), `sort_order`'],
    ['`cms_items`', 'The repeating pieces inside a section', '`section_id`, `heading`, `subheading`, `body`, `icon` (Font Awesome 4 name), `media_id`, `link_url`, `link_label`, `extra` (price, time label...), `active`, `sort_order`'],
    ['`cms_media`', 'The picture library', '`file_name` (stored name in `public/uploads/cms/`), `original_name`, `alt_text`, `mime`, `width`, `height`, `bytes`'],
    ['`cms_posts`', 'Sunshine, Bulletin Board stickies, Marquee lines, Careers (phase 3)', '`kind` (sunshine / bulletin / marquee / job), `title`, `summary`, `body`, `location`, link, `media_id`, `color` (sticky), `subentity_id` (0 = All Members), `poster_subentity_id` (chapter of the Chapter Admin or member who posted it; 0 = a Content Admin), `is_public`, `active`, `status` (approved / pending / disapproved; only approved shows), `starts_on` / `ends_on`, `sort_order`'],
    ['`events`', 'Calendar events (phase 5); the top level of the future Event Module', '`title`, `summary`, `description`, `location`, `start_at` / `end_at` (datetime), `all_day`, `subentity_id` (0 = national), `is_public`, `approved`, `media_id`, link'],
  ]},
  { type: 'p', text: "`status` and `poster_subentity_id` were added by `database/migrations/2026-10-20-cms-posting-roles.sql` (phase 7), which also adds the `cms/chapter_posts` function." },
  { type: 'p', text: "17 sections are seeded, in today's page order: the 11 Inspinia landing sections (slider, services, features, team, features2, timeline, testimonials, comments, features3, pricing, contact) plus marquee, metrics, calendar, sunshine, bulletins and careers. `INSERT IGNORE` on `code`, so re-running keeps changes made on the screens. An 18th, **vitals** (Membership Vitals, member home only, last on the page), was added by `database/migrations/2026-10-21-cms-membership-vitals.sql`; it replaced a hardcoded block at the bottom of `ccmphome.php` whose numbers had never been filled in. **Two sliders** (`database/migrations/2026-10-21-cms-member-slider.sql`): `slider` is the public website's ("Website Slider", off the member home) and `member_slider` the member home's ("Member Home Slider", `allow_public = 0`); both use the slider layout, and the member one started with copies of the website slides." },
  { type: 'p', text: "The future Event Module adds `event_activities` (`event_id` → `events.id`) and registration; the calendar keeps reading `events`, so nothing built in phase 5 is redone." },
]},

// ============================================================
{ tab: "Permissions", blocks: [
  { type: 'p', text: "Module `cms` in Security Groups (see the Security chapter):" },
  { type: 'table', headers: ['Function', 'Allows', 'Groups'], rows: [
    ['`cms/manage_content`', 'Sections, items, pictures; phase 3 posts', 'Content Admins, Member System Admins, System Admins (staff)'],
    ['`cms/manage_events`', 'Every event, any chapter or national', 'Event Admins, Member System Admins, System Admins (staff)'],
    ['`cms/chapter_events`', 'Events for your own chapter', 'Chapter Admins'],
    ['`cms/chapter_posts`', 'Sunshine, Bulletin Board and Careers posts for All Members or your own chapter (never Public); approve, hold back or disapprove your chapter\'s sticky notes', 'Chapter Admins'],
  ]},
  { type: 'p', text: "Any member may post Bulletin Board sticky notes while `CMS_MEMBER_BULLETINS` is 1 (System Settings > Features & Policy since 2026-10-22, default 1; set 0 where the CCMPS records are customers who shouldn't post). No group is needed." },
  { type: 'p', text: "Members get Content Admins / Event Admins from the **Content Admin** and **Event Admin** checkboxes on their record or the Member Permissions screen (roles in `rbac_member_roles()`, columns `ccmps.content_admin` / `event_admin` kept as a synced copy; session flags `ccmps_content_admin` / `ccmps_event_admin`). Staff are added to those groups on the Security Groups screen, until the Staff Account screen exists." },
  { type: 'p', text: "Every `cms-content` page except `job`, the event pages (`_event_scope()`) and the post pages (`_post_scope()`, see Content Manager Screens) calls `_check_access()`: logged in with either login (`trongatetoken`) and `rbac_allowed('cms', 'manage_content')`; otherwise back to the member home or staff dashboard with a message. The old `ccmps_cms_admin` session flag is no longer used for menus; `refreshmysessiondata` still sets it, from `content_admin`, for the one legacy check in `Ccmps::_check_function_permissions()`." },
]},

// ============================================================
{ tab: "Drawing the Page", blocks: [
  { type: 'p', text: "The lower half of the member home (`ccmphome.php`, below the member tiles) is drawn from the tables since phase 4; the hard-coded Inspinia demo block was removed. The public website (phase 6) will use the same code with `'public'`." },
  { type: 'table', headers: ['Piece', 'Does'], rows: [
    ['`engine/tg_helpers/cms_helper.php`', 'Loaded by `engine/ignition.php`. `cms_page($site, $subentity_id)` returns `sections` (each with `anchor` = `sec-<code>` and `items`), `menu` (label + anchor) and `site`. Also `cms_media_url()` and `cms_link_attrs()` (links to other sites open in a new tab)'],
    ['`Ccmps::ccmphome()`', "`$data['cms'] = cms_page('member', $_SESSION['ccmps_subentity'])`"],
    ['`modules/cms/content/views/site/page.php`', 'Included by `ccmphome.php`: the sticky one-page menu (Home + each section with a menu label; the Marquee never gets a link; `HOTLINK` when it isn\'t `#`), then each section with `site/<layout>.php`. Its `<style>` block holds the few additions to the Inspinia landing styles (ticker, sticky-note colours, Sunshine cards, metrics, careers, events, vitals)'],
    ['`site/<layout>.php`', 'One per layout: slider, marquee, services, features, features2, features3, metrics, vitals, calendar, team, sunshine, bulletins, timeline, testimonials, comments, careers, pricing, contact. They get `$section`, `$cms`, and helpers from `page.php`: `$cms_head` (heading block), `$cms_text` (escaped, Enter = line break), `$cms_link` (button), `$cms_job_url`'],
  ]},
  { type: 'h2', text: 'Rules' },
  { type: 'ul', items: [
    "A section is drawn when its box for that site is ticked (`show_member`, or `show_public` and `allow_public`) **and** it has something to show; an empty section gets neither a block nor a menu link. With nothing at all the page says so.",
    "Items: `active = 1`, in `sort_order`. Posts: `active = 1`, today between `starts_on` and `ends_on` (blanks are open), and on the member home `subentity_id` 0 or the member's own chapter (`ccmps_subentity`); on the public site `is_public = 1`. Events: approved, from two months back to 18 months ahead (up to 1,000); the member home shows **every** chapter's events, coloured national (green), the member's own chapter (blue) and other chapters (grey); the public site only `is_public = 1`.",
    "**Calendar** (`site/calendar.php`): FullCalendar 6.1.15, a pinned copy in `public/js/fullcalendar-6.1.15/` (MIT licence beside it; no jQuery or moment needed; Inspinia's bundled 2.9.1 is not used). Month, week and list views; screens under 768 px open on the list. The events are written into the page as JSON (`json_encode` with the `JSON_HEX_*` flags); all-day end dates are made exclusive (the day after) as FullCalendar expects. Clicking an event fills a Bootstrap modal using `textContent` (no HTML from the data).",
    "**By the Numbers** (`metrics`, member home and public site), counted fresh each time: current " + "members (`current_year` ≥ the current year, not deceased or deleted) chapters (every **active** `ccmps_subentities` row, chartered or not, except National HQ, `SUBENTITY_NATIONAL_ID` in `config.php`; the Place Holder rows are inactive) and **States**, the distinct `state` codes of the active chapters (left off while none is filled in). The first box's label is just `CCMPS` ("Members"), though it counts current members only. `state` was added and prefilled by `database/migrations/2026-10-21-chapter-state.sql` from each chapter's most common member mailing state (ties and unknowns left blank; the prefill only runs while no chapter has a state). Renewal due and chartered chapters were dropped on 2026-10-21 when it was opened to the public; the renewal numbers live in Membership Vitals. The year is `_cms_current_year()`: the session's `ccmps_current_year`, or for public visitors the `system_current_year` row of `ccmps_financial_settings` that login reads.",
    "**Membership Vitals** (`site/vitals.php`, member home only, `_cms_vitals($subentity_id)`): one box for the member's own chapter (named from `ccmps_subentities.description`, else `chapter_title`; left out when the member has no chapter) and one for National, each with current members (`current_year` ≥ the current year), past due (`current_year` = last year) and renewal rate = current ÷ (current + past due); then a table of current members by type, one row per `ccmps_types` row, chapter and national side by side. Deceased and soft-deleted records are never counted. By the Numbers is meant for the public site; Vitals is the member-home view.",
    "Layout notes: **slider** uses each item's picture as the slide background (none = a plain colour); **features** / **features2** put the first item that has a picture in the middle and split the rest left and right; **testimonials** rotates when there are several quotes; **pricing** highlights the middle of three plans and turns the body's lines into the list; **contact** turns the Phone field into a `tel:` link; **careers** links to `cms-content/job/{id}`.",
    "The menu, smooth scrolling (`a.page-scroll`), scrollspy and WOW animations come from the scripts already in `templates/views/inspinia.php`; the ticker uses CSS only and stands still for people who turn motion off (`prefers-reduced-motion`).",
    "Everything stored is printed through `out()`.",
  ]},
]},

// ============================================================
{ tab: "Public Website", blocks: [
  { type: 'p', text: "Phase 6 (2026-10-20). The public website is the same page code with `cms_page('public', 0)`: only sections ticked **Public website** (and allowed there), posts ticked **Also on the public website**, and events ticked **Public**. No login is needed." },
  { type: 'table', headers: ['Piece', 'Does'], rows: [
    ['`Welcome::website()`', '`welcome/website`: the public homepage. Template `website`, view `modules/welcome/views/website.php` (includes `site/page.php`)'],
    ['`Welcome::job()`', '`welcome/job/{id}`: a public job page (Careers post that is shown, public and inside its dates; otherwise back to the Careers section). View `websitejob.php`. The Careers section links here on the public site and to `cms-content/job/{id}` on the member home (`$cms_job_url`)'],
    ['`Welcome::index()`', 'The front address. `CMS_PUBLIC_SITE` = 1 shows the website; 0 (the default) goes to the login as before. `welcome/website` always works, so the site can be built and checked before it is switched on'],
    ['`modules/templates/views/website.php`', '`Templates::website()`: a full page with the Inspinia landing styles, `<body id="page-top" class="landing-page">`, and only the scripts the page needs (jQuery, Bootstrap, scroll / scrollspy / sticky header, WOW). `$page_title` and `$page_description` fill the title and meta description'],
    ['`CMS_PUBLIC_SITE`', 'System Settings > Features & Policy ("Public website on this site"; moved from `.env` 2026-10-22), read by `config/config.php` with `setting()`. BPA keeps 0 while bpapilots.org (WordPress, `PUBLIC_WEBSITE`) is its public site'],
  ]},
  { type: 'ul', items: [
    "The page's menu shows **" + "Member Login** on the public site (**Member Home** when already logged in); the brand is `SHORTSITENAME` alone (the member home adds `SITENAME4`).",
    "Member-only sections never appear publicly: Membership Vitals has `allow_public = 0` (By the Numbers was opened to the public by the 2026-10-21 migration); Sunshine, Bulletin Board and Marquee are seeded off for the public site.",
    "The calendar opens on **Upcoming** (a 12-month list) when the current month has no events, and always on phones.",
  ]},
  { type: 'h2', text: 'BPA content (2026-10-20)' },
  { type: 'p', text: "Loaded from the public pages of bpapilots.org (home, About, Officials, Join, Upcoming Meetings, Give) by a one-off loader on the Mac: slider (3 slides), About BPA, What We Do, Signature Programs, Our Year, Officials (6, with photos), Why Join BPA?, Membership Classes (dues are set by chapters, so no prices), Contact, and the 14 Board / General Membership meetings from January 2027 to 2033 as public national all-day events. 11 pictures; the three wide banner graphics were left out because their words are part of the image. Nothing was invented: no testimonials or partner quotes (those sections stay empty and hidden), no Operation Skyhook / Summer Flight Academy dates (the site gives none), no national phone or email (the site lists only chapter contacts). The site gives two Summer Flight Academy locations (Atlanta Speedway and Houston Southwest); Houston, from its About and program text, was used." },
  { type: 'p', text: "Content is data, not code: it reaches staging by copying the five tables (`cms_sections`, `cms_items`, `cms_media`, `cms_posts`, `events`) and the `public/uploads/cms/` files, after a staging backup." },
]},

// ============================================================
{ tab: "Content Manager Screens", blocks: [
  { type: 'p', text: "`modules/cms/content/Content.php` (URL `cms-content/...`), views in `modules/cms/content/views/`. Reached from **Website** in the member side menu (admin menu), the Website tiles on the member Admin page, the phone menu in `ccmphome.php`, and **Website** in both staff menus (`adminsidemenu.php`, `usersidemenu.php`). The Website menu opens for `manage_content` or `manage_events`; inside, the content pages need `manage_content` and Events needs `manage_events`." },
  { type: 'table', headers: ['URL', 'Does'], rows: [
    ['`sections`', 'List of sections: drag to reorder (jQuery UI sortable → `ordersections`), tick Member home / Public website (AJAX `togglesection`), Edit, Items'],
    ['`updatesection/{id}` → `sectionsubmit/{id}`', 'Heading (required, 150), subtitle (255), menu label (40)'],
    ['`createsection` → `sectionsubmit/0`', 'Add a Section (button on Page Sections, added 2026-10-21): an item layout (slider, services, features 1-3, team, timeline, testimonials, comments, pricing, contact) + heading, subtitle, menu label and the two Show boxes. The feed layouts exist once and are not offered. The new row gets `code` = `custom-<heading slug>` (unique, `-2`, `-3`...; `_section_code()`), so its anchor is `#sec-custom-...`; `allow_public = 1`; `sort_order` = last + 10. Then the Items page opens. Sections cannot be deleted yet: untick both Show boxes to hide one'],
    ['`items/{section_id}`', 'Items of one section: drag to reorder (`orderitems`), Shown checkbox (`toggleitem`), Edit, Delete (POST `delitem`). Feed sections (no item fields) redirect back'],
    ['`createitem/{section_id}`, `updateitem/{id}` → `itemsubmit/{id}`', 'One form; only the fields the layout uses, with its labels'],
    ['`media`', 'Picture library: upload several at once (`uploadmedia`), description saved on blur (`updatemedia`), Delete only when unused (POST `delmedia`)'],
    ['`posts/{kind}`', 'Sunshine (`sunshine`), Bulletin Board (`bulletin`), Marquee (`marquee`) or Careers (`job`): the posts within the login\'s reach (see below) with picture, chapter, Posted by, Approval drop-down for sticky notes (`statuspost`, not for members), what shows **today** (Waiting for approval / Disapproved / Hidden / Starts / Ended / Showing), public tick, Shown checkbox (`togglepost`), drag to reorder (`orderposts`, Content Admins only: the order is shared), Edit, Delete (POST `delpost`). The Sections list links feed sections to their list (**Posts**)'],
    ['`createpost/{kind}`, `updatepost/{id}` → `postsubmit/{id}`', 'One form; `_kinds()` lists each kind\'s fields and labels (e.g. Sunshine: Name, News, More details, Photo; Careers: Job title, Employer and location, Short and Full description, Logo, How to apply). Every kind has a chapter (All Members = 0, the default), show from / until dates and Shown; Content Admins also get Also on the public website, and sticky notes get Approval for everyone but members. Chapter Admins pick pictures but can\'t upload. New posts go to the top'],
    ['`job/{id}`', 'A job\'s detail page for anyone logged in (no Website permission needed): paragraphs from the full description, location, picture, closing date, Apply button. Hidden, not yet started or ended jobs send the visitor home with a message. The public website gets its own copy in phase 6'],
    ['`events` (`events/past`)', 'Upcoming (or past) events: when, title and location, chapter, public tick, Edit, Delete (POST `delevent`). Event Admins and System Admins see all; a Chapter Admin sees only their chapter\'s'],
    ['`createevent`, `updateevent/{id}` → `eventsubmit/{id}`', 'Title (required), start date (required) and time, optional end date and time, All day (times disabled), location, short and full description, chapter (National or any chapter; a Chapter Admin can\'t choose: always their own), picture, link and button label (e.g. Register), Public. Checks: real dates (`checkdate`) and times, end not before start, link rules as for items'],
  ]},
  { type: 'h2', text: 'Who manages which events' },
  { type: 'p', text: "`_event_scope()` decides for every event page: `cms/manage_events` → `'all'`; otherwise a member login with a chapter and `cms/chapter_events` → their chapter id (`ccmps_subentity`); anyone else goes home with a message. A chapter-scoped user can only open, save or delete events whose `subentity_id` is their chapter, and their saves always store their chapter whatever is posted. Menus: **Events** under Website for `manage_events`; **Chapter Events** in the Chapter Admin menu and an Events tile on the Admin page for `chapter_events`. Events are saved `approved = 1` (the column is kept for the Event Module)." },
  { type: 'h2', text: 'Who manages which posts' },
  { type: 'p', text: "Decided 2026-10-20. `_post_scope($kind)` returns the login's role for every post page; `_post_reach()` (SQL) and `_in_reach()` (one post) limit what it sees and changes, and anything out of reach is \"not found\". `_load_post()` does both for the pages that take a post id." },
  { type: 'table', headers: ['Role', 'Who', 'Kinds', 'Reach', 'May set'], rows: [
    ['`content`', '`cms/manage_content` (Content Admins, System Admins)', 'All four', 'Every post', 'Any chapter, Public, Approval, order'],
    ['`chapter`', '`cms/chapter_posts` (Chapter Admins), member login with a chapter', 'Sunshine, Bulletin Board, Careers', 'Posts for their chapter, posts made by their chapter\'s members or Chapter Admins (`poster_subentity_id`), and their own', 'All Members or their chapter; Approval on sticky notes. Public is kept as it was'],
    ['`member`', 'any member login, `CMS_MEMBER_BULLETINS` = 1', 'Bulletin Board', 'Their own notes (`created_by`)', 'All Members or their chapter. Notes go up `approved`; saving a disapproved note makes it `pending`'],
  ]},
  { type: 'p', text: "Menus: Content Admins find the lists under **Website**; Chapter Admins get Sunshine, Bulletin Board and Careers in the Chapter Admin menu; members get a **My Sticky Notes** tile in the member side menu and a **Post a Sticky Note** button under the Bulletin Board on the home page." },
  { type: 'h2', text: 'Posts (cms_posts)' },
  { type: 'ul', items: [
    "**What shows:** `active = 1`, `status = 'approved'`, `starts_on` blank or today or earlier, `ends_on` blank or today or later; for members, `subentity_id` 0 or their own chapter; on the public site, also `is_public = 1` and the section's `show_public`. Phase 4 and 6 queries apply these rules.",
    "**Checks in `postsubmit()`:** title required (150), short text 500, location 150, link rules as for items, dates must be real (`checkdate`) and until can't be before from, a chapter the login may not choose → All Members, unknown picture → none.",
    "**Bulletin colours:** yellow, green, blue, pink (`color`).",
  ]},
  { type: 'h2', text: 'Layouts' },
  { type: 'p', text: "`Content::_layouts()` maps each `layout` to a description and the item fields it uses (field name → label on the form), or `null` plus where the content comes from (marquee, sunshine, bulletins, careers, calendar, metrics, vitals). A fourth value names the post kind for feed sections that are `cms_posts` lists (marquee, sunshine, bulletins → `bulletin`, careers → `job`). A new kind of section = a layout added there + `site/<layout>.php`; then Content Admins add sections of it with Add a Section (a feed layout's single row goes in a migration)." },
  { type: 'h2', text: 'Safety' },
  { type: 'ul', items: [
    "**Token:** every form and AJAX call carries `$_SESSION['cms_token']` (`_token()` / `_check_token()`, `hash_equals`), so another site can't post changes in the user's name.",
    "**Output:** all stored text is printed through `out()`. Flash messages print as HTML, so upload file names are escaped before they go into one.",
    "**Links:** `link_url` must start with `https://`, `http://`, `mailto:`, `tel:`, `/` or `#` (no `javascript:`). Icons must match `fa-[a-z0-9-]+`.",
    "**Uploads:** type checked from the file's content (`finfo`), not its name: JPEG, PNG, GIF, WebP only; 10 MB each; `getimagesize()` must read it. Stored under a random name (`YYYYMMDD-<12 hex>.ext`) in `public/uploads/cms/`, served as `BASE_URL.'uploads/cms/'`. JPEG/PNG wider than 1920 px are shrunk with GD. The first description is made from the file name.",
    "**Audit:** saves, shows/hides, uploads and deletes are logged (`func` = `cms-content`).",
  ]},
  { type: 'h2', text: 'Files and folders' },
  { type: 'ul', items: [
    "`public/uploads/` is outside git (`.gitignore`). On staging it is a mounted folder (`/srv/honcho/staging/files/public/uploads`, owned by `www-data`), so pictures survive deploys; `Content.php` creates `cms/` inside it on the first upload.",
    "On the Mac, Apache runs as `daemon`, so `public/uploads/cms/` must be writable by it (`chmod 777`, like the DMS assets folders).",
    "The views wait for `DOMContentLoaded` and use `window.jQuery`: the Inspinia template loads jQuery and jQuery UI after the page content.",
  ]},
]},

];

module.exports = sections;
