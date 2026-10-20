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
    ['4', '`ccmphome.php` drawn from the tables, with the one-page menu', 'Next'],
    ['5', 'Events calendar (FullCalendar) on `events`', ''],
    ['6', 'Public website in the Welcome module; BPA content loaded', ''],
    ['Last', 'Event Module: registration events and activities on `events` + `event_activities`', ''],
  ]},
]},

// ============================================================
{ tab: "Tables", blocks: [
  { type: 'p', text: "Created by `database/migrations/2026-10-20-cms-content-phase1.sql` (safe to re-run). InnoDB, utf8mb4, `created_by/at` and `updated_by/at` as `int` like the rest of the schema. Foreign keys: deleting a section deletes its items; deleting a picture sets `media_id` to NULL where it was used (the screens refuse to delete a picture in use anyway)." },
  { type: 'table', headers: ['Table', 'Holds', 'Key columns'], rows: [
    ['`cms_sections`', 'One row per page section', '`code` (unique, what page code looks for), `layout` (which template part draws it), `title`, `subtitle`, `menu_label` (blank = not in the one-page menu), `show_member`, `show_public`, `allow_public` (0 = member home only, e.g. Metrics), `sort_order`'],
    ['`cms_items`', 'The repeating pieces inside a section', '`section_id`, `heading`, `subheading`, `body`, `icon` (Font Awesome 4 name), `media_id`, `link_url`, `link_label`, `extra` (price, time label...), `active`, `sort_order`'],
    ['`cms_media`', 'The picture library', '`file_name` (stored name in `public/uploads/cms/`), `original_name`, `alt_text`, `mime`, `width`, `height`, `bytes`'],
    ['`cms_posts`', 'Sunshine, Bulletin Board stickies, Marquee lines, Careers (phase 3)', '`kind` (sunshine / bulletin / marquee / job), `title`, `summary`, `body`, `location`, link, `media_id`, `color` (sticky), `subentity_id` (0 = national), `is_public`, `active`, `starts_on` / `ends_on`, `sort_order`'],
    ['`events`', 'Calendar events (phase 5); the top level of the future Event Module', '`title`, `summary`, `description`, `location`, `start_at` / `end_at` (datetime), `all_day`, `subentity_id` (0 = national), `is_public`, `approved`, `media_id`, link'],
  ]},
  { type: 'p', text: "17 sections are seeded, in today's page order: the 11 Inspinia landing sections (slider, services, features, team, features2, timeline, testimonials, comments, features3, pricing, contact) plus marquee, metrics, calendar, sunshine, bulletins and careers. `INSERT IGNORE` on `code`, so re-running keeps changes made on the screens." },
  { type: 'p', text: "The future Event Module adds `event_activities` (`event_id` → `events.id`) and registration; the calendar keeps reading `events`, so nothing built in phase 5 is redone." },
]},

// ============================================================
{ tab: "Permissions", blocks: [
  { type: 'p', text: "Module `cms` in Security Groups (see the Security chapter):" },
  { type: 'table', headers: ['Function', 'Allows', 'Groups'], rows: [
    ['`cms/manage_content`', 'Sections, items, pictures; phase 3 posts', 'Content Admins, Member System Admins, System Admins (staff)'],
    ['`cms/manage_events`', 'Every event, any chapter or national', 'Event Admins, Member System Admins, System Admins (staff)'],
    ['`cms/chapter_events`', 'Events for your own chapter', 'Chapter Admins'],
  ]},
  { type: 'p', text: "Members get Content Admins / Event Admins from the **Content Admin** and **Event Admin** checkboxes on their record or the Member Permissions screen (roles in `rbac_member_roles()`, columns `ccmps.content_admin` / `event_admin` kept as a synced copy; session flags `ccmps_content_admin` / `ccmps_event_admin`). Staff are added to those groups on the Security Groups screen, until the Staff Account screen exists." },
  { type: 'p', text: "Every `cms-content` page except `job` calls `_check_access()`: logged in with either login (`trongatetoken`) and `rbac_allowed('cms', 'manage_content')`; otherwise back to the member home or staff dashboard with a message. The old `ccmps_cms_admin` session flag is no longer used for menus; `refreshmysessiondata` still sets it, from `content_admin`, for the one legacy check in `Ccmps::_check_function_permissions()`." },
]},

// ============================================================
{ tab: "Content Manager Screens", blocks: [
  { type: 'p', text: "`modules/cms/content/Content.php` (URL `cms-content/...`), views in `modules/cms/content/views/`. Reached from **Website** in the member side menu (admin menu), the Website tiles on the member Admin page, the phone menu in `ccmphome.php`, and **Website** in both staff menus (`adminsidemenu.php`, `usersidemenu.php`); all gated by `rbac_allowed('cms', 'manage_content')`." },
  { type: 'table', headers: ['URL', 'Does'], rows: [
    ['`sections`', 'List of sections: drag to reorder (jQuery UI sortable → `ordersections`), tick Member home / Public website (AJAX `togglesection`), Edit, Items'],
    ['`updatesection/{id}` → `sectionsubmit/{id}`', 'Heading (required, 150), subtitle (255), menu label (40)'],
    ['`items/{section_id}`', 'Items of one section: drag to reorder (`orderitems`), Shown checkbox (`toggleitem`), Edit, Delete (POST `delitem`). Feed sections (no item fields) redirect back'],
    ['`createitem/{section_id}`, `updateitem/{id}` → `itemsubmit/{id}`', 'One form; only the fields the layout uses, with its labels'],
    ['`media`', 'Picture library: upload several at once (`uploadmedia`), description saved on blur (`updatemedia`), Delete only when unused (POST `delmedia`)'],
    ['`posts/{kind}`', 'Sunshine (`sunshine`), Bulletin Board (`bulletin`), Marquee (`marquee`) or Careers (`job`): list with picture, chapter, what shows **today** (Hidden / Starts / Ended / Showing), public tick, Shown checkbox (`togglepost`), drag to reorder (`orderposts`), Edit, Delete (POST `delpost`). The Sections list links feed sections to their list (**Posts**)'],
    ['`createpost/{kind}`, `updatepost/{id}` → `postsubmit/{id}`', 'One form; `_kinds()` lists each kind\'s fields and labels (e.g. Sunshine: Name, News, More details, Photo; Careers: Job title, Employer and location, Short and Full description, Logo, How to apply). Every kind has a chapter (National = 0), show from / until dates, Shown, and Also on the public website. New posts go to the top'],
    ['`job/{id}`', 'A job\'s detail page for anyone logged in (no Website permission needed): paragraphs from the full description, location, picture, closing date, Apply button. Hidden, not yet started or ended jobs send the visitor home with a message. The public website gets its own copy in phase 6'],
  ]},
  { type: 'h2', text: 'Posts (cms_posts)' },
  { type: 'ul', items: [
    "**What shows:** `active = 1`, `starts_on` blank or today or earlier, `ends_on` blank or today or later; for members, `subentity_id` 0 or their own chapter; on the public site, also `is_public = 1` and the section's `show_public`. Phase 4 and 6 queries apply these rules.",
    "**Checks in `postsubmit()`:** title required (150), short text 500, location 150, link rules as for items, dates must be real (`checkdate`) and until can't be before from, unknown chapter → National, unknown picture → none.",
    "**Bulletin colours:** yellow, green, blue, pink (`color`).",
  ]},
  { type: 'h2', text: 'Layouts' },
  { type: 'p', text: "`Content::_layouts()` maps each `layout` to a description and the item fields it uses (field name → label on the form), or `null` plus where the content comes from (marquee, sunshine, bulletins, careers, calendar, metrics). A fourth value names the post kind for feed sections that are `cms_posts` lists (marquee, sunshine, bulletins → `bulletin`, careers → `job`). Add a layout there, add the section row in a migration, and draw it in the page template (phase 4)." },
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
