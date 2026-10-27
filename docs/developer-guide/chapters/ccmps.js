// ============================================================
// chapters/ccmps.js — CCMPS chapter of the Honcho Developer's Guide
// ============================================================
// This is the "keep in sync" source of truth for the Word version.
// When modules/welcome/ccmps/views/helpdocs.php changes, update the
// matching section here, then re-run generate.js. Text uses a
// lightweight inline markup:
//   **bold**   `code`   _italic_
// Block types: h2, h3, p, ul, ol, table, alert, code
// ============================================================

const sections = [

// ============================================================
{ tab: "Architecture", blocks: [
  { type: 'h2', text: 'The Five Files' },
  { type: 'p', text: "This module is built from five files that work together. Understanding what each one is _for_ — and just as importantly, what it's _not_ for — is the fastest way to orient yourself in this codebase." },
  { type: 'table', headers: ['File', 'Role'], rows: [
    ['`Ccmps.php`', "The controller. Every action — save, view, delete, manage-list, this help page — is a method here. This is where real security enforcement lives: server-side whitelist stripping, permission checks, database queries. Roughly 8,000 lines; most of it is untouched legacy code from before this module's active development phase (see **Known Issues**)."],
    ['`ccmpcrud.php`', "Thin wrapper around the edit form. Renders the header (photo, name, Save/Cancel buttons — which pair depends on `$_SESSION['actionmode']`), then `include()`s `ccmpcrudcontact.php` for the actual fields. Rarely needs changes on its own."],
    ['`ccmpcrudcontact.php`', "The real edit form. Every editable field lives here, organized into collapsible sections. This is the file you'll touch most often when adding/moving/re-permissioning a field."],
    ['`viewccmp.php`', 'The read-only view — what a member sees when they open "My Profile" before clicking Update. Same field set as the edit form, conceptually, but rendered as plain text via Bootstrap **tabs** (not collapse panels) using an output-buffering trick — see the code comments at the top of the file for how `vf_section_open()`/`vf_section_close()`/`vf_tabs_render()` work together.'],
    ['`manage.php`', 'The admin list/management view. One unified table (not per-mode duplicates like the original legacy version had), with real SQL `JOIN`s pulling chapter name, address, and member-type label directly rather than translating codes in PHP.'],
  ]},
  { type: 'h2', text: 'Styling' },
  { type: 'p', text: "Tab/section labels and other UI chrome are styled in `custom.css`, not `style.css` and not in any PHP file." },
  { type: 'alert', variant: 'warning', text: "**Never add rules to `themes/inspinia/css/style.css` directly.** That's the theme's own vendor file — a future theme update will silently overwrite it, and anything added there goes with it. `custom.css` (loaded via its own `<link>` tag in `inspinia.php`, placed immediately after `style.css`'s so it wins the cascade on anything overlapping) is the correct home for every module-specific style going forward. `style.css` still has some of the previous developer's own hand-edits baked into it from before this project (e.g. a `padding: 1px` change with a comment noting the original value) — those weren't retroactively migrated, so a theme update could still silently lose them; only new work is protected by this convention going forward." },

  { type: 'h3', text: 'The Font Size Preference System (per-element, per-user)' },
  { type: 'p', text: "Five independently-configurable elements — tabs, section headers, field labels, field values, buttons — each with its own small/medium/large choice, per member. This intentionally allows mismatched combinations (e.g. tiny tabs with huge field values); that flexibility was a deliberate choice, not an oversight, partly in anticipation of a future mobile-specific mode where sizes would be preset for what renders best and members wouldn't be allowed to edit them at all." },
  { type: 'p', text: "Two tables work together:" },
  { type: 'ul', items: [
    "`ccmps_settings` — 15 rows: one per (element type × size tier) combination. Columns: `id`, `title` ('small'/'medium'/'large'), `settingvalue` (the actual pixel number), `type` ('tab'/'header'/'label'/'value'/'button'), `description` (the human-readable dropdown label, e.g. \"Medium Tabs\"). Editable by system_admin via a dedicated CRUD (`managefontsizes()`/`savefontsizesettings()`, linked from the sidemenu) — this is where the actual pixel values for each tier get configured, shared across every member.",
    "`ccmps` — 5 columns (`tab_setting`, `header_setting`, `label_setting`, `value_setting`, `button_setting`), each an FK id into `ccmps_settings`. This is the per-member choice, editable via 5 ordinary dropdowns in Preferences — no modal, no AJAX, just normal form fields saved through the regular `ccmpsubmit()` flow.",
  ]},

  { type: 'alert', variant: 'warning', text: "**Never hardcode a specific `ccmps_settings` id as \"the medium option for type X.\"** The schema's own column defaults do exactly this (`tab_setting` defaults to `2`, `header_setting` to `5`, and so on — each the middle id of its 3-row block, assuming a specific insert order) — that's acceptable as a database-level fallback, since MySQL `DEFAULT` clauses can only be literal values, not dynamic lookups. But no *application code* should make that same assumption. Every place that needs to resolve \"what does this stored id actually mean\" — the inline style generator in `inspinia.php`, and the display translation in `_convert_to_user_friendly()` — looks the row up by matching `type` + `title = 'medium'` instead, and only falls back to that lookup if the stored id is missing or its `type` doesn't match what's expected. If `ccmps_settings` ever gets reordered or reseeded, a hardcoded-id assumption would silently point at the wrong type/tier combination with no error anywhere to catch it." },

  { type: 'h3', text: 'How the CSS actually gets generated' },
  { type: 'p', text: "Since the real pixel values are per-user and only knowable at request time, this can't be static CSS at all — it's a small inline `<style>` block, generated directly in `inspinia.php` on every page load. Views in this app render via `include()`, which preserves the calling controller's `$this` — so `inspinia.php` can call `$this->model` directly, the same way `manage.php` and `viewccmp.php` already do inline, without needing every controller action to pre-compute this and pass it through `$data`." },
  { type: 'code', text: "// Simplified — see inspinia.php for the full version with the\n// type+title fallback guard included.\n$ccmp = $this->model->get_where($_SESSION['ccmp_rec_id'], 'ccmps');\n$settings = $this->model->get('id', 'ccmps_settings');\n// ...resolve each of the 5 stored ids against $settings,\n// falling back to type+title 'medium' if anything's missing...\necho '<style>' . implode(\"\\n\", $css_rules) . '</style>';" },

  { type: 'h3', text: 'What this replaced' },
  { type: 'p', text: "A single-value, session-based system that was genuinely broken in three separate ways, not just outdated:" },
  { type: 'ul', items: [
    "It used the stored font size as an HTML _heading level_ (`<h1>` through `<h6>`) via `<h<?= $_SESSION['fontsize'] ?>>...</h<?= $_SESSION['fontsize'] ?>>`, conflating a user's visual preference with document structure — actively confusing anything relying on heading hierarchy, like screen readers.",
    "Three different places set that same session variable with mutually incompatible conventions: raw numeric passthrough, a self-correcting default, and a `switch` that silently converted the number into word-strings (`'Large'`/`'Medium'`/`'Small'`) — which would have broken the heading-level trick outright if it ran afterward.",
    "A 12+-call-site helper function, `_get_font_sizes()`, referenced `$ccmp_id` before ever assigning it, so its entire database-lookup body was silently dead code the whole time.",
  ]},
  { type: 'p', text: "All of it — the heading-level trick, the three inconsistent assignment sites, the broken helper function, the standalone Font modal and its AJAX save handler, and the `ccmps.fontsize` column itself — has been fully removed, not just deprecated." },

  { type: 'h2', text: 'Trongate MVC Conventions' },
  { type: 'ul', items: [
    "Controller methods render a view by setting `$data['view_module']` / `$data['view_file']`, then calling `$this->templates->inspinia($data)`.",
    "**Trongate does not reliably auto-map URL segments to method parameters.** Don't declare `function foo($id)` expecting the framework to populate `$id` from the URL — pull it explicitly with `segment(3)` instead. We found this the hard way: a parameter with no default value (`function updateccmp($retrying)`) threw a fatal `ArgumentCountError` the moment it was called via a plain link, because Trongate called it with zero arguments. Always give parameters a default, or better, don't rely on them at all.",
    "`$this->model->get_where($id, 'table')` returns a single `stdClass` object. `$this->model->get_one_where($col, $val, 'table')` — same shape, matched by an arbitrary column instead of the primary key. `$this->model->query($sql, 'object')` — returns an **array** of row objects, even for a single-row result; you need `$result[0]` to get at it. Mixing these up (assigning object-syntax onto what's actually an array) caused a real fatal crash we had to trace and fix.",
    "`$this->model->get_where_custom($col, $val, '=', $orderCol, 'table')` — used for lookups keyed on something other than the primary key, or when you need every matching row rather than just one.",
  ]},
  { type: 'alert', variant: 'warning', text: "**The single most common bug class in this codebase:** confusing whether a value is an object (`->`) or an array (`[]`). PHP does _not_ reliably throw a loud, obvious error when you get this wrong — depending on context it can silently no-op, throw a quiet warning, or (for property _assignment_ on an array specifically) throw a genuine fatal `Error`. When something behaves strangely for no obvious reason, checking this mismatch first has paid off repeatedly during this module's development." },
]},

// ============================================================
{ tab: "Schema", blocks: [
  { type: 'alert', variant: 'info', text: '**Resolved:** `ccmps.salutation` was originally `varchar(55)` despite the code treating it as an integer FK to `ref_salutations` — since fixed by converting the column to `tinyint(1) DEFAULT 0` directly in the database. If any member record had a pre-existing free-text salutation (like "Mr.") saved before this change, it\'s worth a quick check that the type conversion didn\'t silently coerce it to `0` rather than mapping it to the correct `ref_salutations.id` — MySQL will happily do that coercion without erroring, especially outside strict SQL mode.' },
  { type: 'p', text: 'Of everything in the full database dump, only the tables below are actually referenced by this module\'s code. Tables prefixed `cms_` belong to a separate content-management module and aren\'t used here at all. Tables prefixed `dms_` and `honcho_` are separate modules entirely (document library and superuser administration, respectively) — conceptually related in places, but not queried directly by any file in this module.' },

  { type: 'h2', text: 'Core Tables' },
  { type: 'p', text: 'Present regardless of `CCMPS_AUX_MODULE`. Together, these are what a baseline (non-aviation) deployment of this product actually needs.' },

  { type: 'h3', text: '`ccmps` — the parent record' },
  { type: 'p', text: "One row per person. Organized below by section, matching the form's own layout — the fastest way to find \"where does this field live\" is to find its section here." },
  { type: 'table', headers: ['Section', 'Fields', 'Who can edit'], rows: [
    ['Personal / Contact / Emergency', '`salutation`, `first_name`, `middle_name`, `last_name`, `suffix`, `gender`, `birthday`, `dob`, `minor`, `email_address`, `phone`, `mobile`, `fax`, `website`, `url_string`, `alternate_contact/phone/email`, `emergency_contact/phone/email`, `active_duty`, `former_military`', 'The member themselves, freely'],
    ['Employment', '`employer`, `title`, `reports_to`, `department`', 'The member themselves, freely'],
    ['Membership', '`ccmp_number`, `ccmp_type`, `subentity`, `subentity_role`, `current_year`, `region`, `national_officer`, `leadsource`, `student`, `eligible_voter`', '`system_admin`, `subentity_admin`, or `ccmp_admin` — never the member themselves'],
    ['Roles & Permissions', '`system_admin`, `student_admin`, `ccmp_admin`, `content_admin`, `event_admin`, `financial_admin`, `locked`, `inactive`, `approved`', '`system_admin` only'],
    ['Roles & Permissions (broader visibility)', '`soft_deleted`', 'Visible to `system_admin`/`subentity_admin`; editable by `system_admin` only'],
    ['Preferences', '`vip`', '`system_admin`, `subentity_admin`, or `ccmp_admin` — deliberately excludes `student_admin`'],
    ['Roles & Permissions', '`subentity_admin` (Chapter Admin)', "Not locked like the other role boxes: see the RBAC tab's worked example — the chapter-admin-granting exception. Moved here from Preferences 2026-10-19"],
    ['Preferences', '`language`, `donotcall`, `emailoptout`, `directoryoptout`, `mail_notices`', 'The member themselves, freely'],
    ['Admin Notes', '`notes`, `deceased`', 'Fully hidden from the member; `system_admin`/`subentity_admin`/`ccmp_admin` can see and edit'],
    ['Account', '`activate_code`, `reset_code`', 'Fully hidden from everyone except `system_admin`, who can both see and edit'],
    ['Account (display-only)', '`num_logins`, `last_login`, `last_logout`, `ip_address`', 'Visible to everyone with page access; editable by **no one** — application-managed'],
    ['_Application-managed, not shown anywhere in the CRUD form_', '`code`, `status`, `fontsize`, `trongate_user_id`, `username`, `password`, `date_created`, `last_login_device`, `user_token`, `force_pw_chg`, `timed_reset`, `reset_interval`, `created_by`, `updated_by`, `misc1/2/3`, `created_at`, `updated_at`, `paid`, `paypal_txn_id`, `last_payment_date`, `payment_amount`, `picture`', 'Never — set entirely by business logic elsewhere (auth flow, payment processing, `recalcstatus()`)'],
    ['_Present in schema, not currently exposed anywhere_', '`library_admin`', 'Reserved for a future Honcho-managed feature — deliberately not built into this CRUD, per explicit product decision'],
  ]},

  { type: 'h3', text: '`ccmps_addresses` — one row per member, four address types' },
  { type: 'p', text: 'All fields freely member-editable. Each of `mail`/`phys`/`bill`/`ship` repeats the same pattern: `address1`, `address2`, `city`, `state`, `zip`, `county`, `country`. `bill` and `ship` additionally have their own `name`/`phone` pair. `mail_phys` and `bill_ship` are the two "same as above" checkboxes.' },

  { type: 'h2', text: 'Extension Tables (gated by `CCMPS_AUX_MODULE`)' },
  { type: 'p', text: 'Aviation-specific. Only relevant to this particular deployment; a non-aviation buyer of this product would never see any of this. See the **CCMPS_AUX_MODULE** tab for how the gating itself works.' },

  { type: 'h3', text: '`ccmps_aux` — pilot certificate & ratings extension' },
  { type: 'table', headers: ['Fields', 'Who can edit'], rows: [
    ['`hall_of_fame`', 'Visible to everyone; editable only by `system_admin`/`subentity_admin`/`ccmp_admin`'],
    ['`aircraft_owner`', 'The member themselves, freely — synced automatically from `ccmps_aircraft` on every page load (see below)'],
    ['Everything else — `call_sign`, `total_time`, `highest_certificate`, `certificate_number`, every certificate/rating checkbox, `maintenance`, `cred_notes`, etc.', 'The member themselves, freely'],
  ]},

  { type: 'h3', text: '`ccmps_aircraft` — one-to-many, a member can own/rent multiple aircraft' },
  { type: 'table', headers: ['Column', 'Notes'], rows: [
    ['`ccmp_id`', 'FK to `ccmps.id` — always re-verified server-side before any update/delete, never trusted from the submitted form'],
    ['`registration_number`, `make`, `model`', 'Free text'],
    ['`hp`', 'Integer'],
    ['`engines`', "Integer count, despite the `tinyint(1)` type — that's a MySQL display-width quirk, not a value restriction"],
    ['`own_rent`', "Boolean. **1 = owned, 0 = rented** — this specific convention was explicitly confirmed, worth remembering since it's not self-evident from the column name alone."],
  ]},
  { type: 'p', text: 'See the **Extending** tab for the full one-to-many pattern this table established (array-indexed form fields, per-row insert/update/delete logic in `ccmpsubmit()`).' },

  { type: 'h2', text: 'Reference / Lookup Tables' },
  { type: 'p', text: 'Most follow one shape: `id` + `title` + `description`. A few deviate, noted below since assuming the standard shape on those specifically has already caused real bugs.' },
  { type: 'table', headers: ['Table', 'Shape', 'Used for'], rows: [
    ['`ref_genders`', 'standard', '`ccmps.gender`'],
    ['`ref_languages`', 'standard', '`ccmps.language`'],
    ['`ref_region_codes`', 'standard', '`ccmps.region`'],
    ['`ref_salutations`', 'standard', '`ccmps.salutation` — see the discrepancy noted at the top of this tab'],
    ['`ref_leadsource`', 'standard, plus `referrer` (text) and `referrer_id` (int, not currently used by any UI)', '`ccmps.leadsource` — dropdown shows "Title (Referrer)"'],
    ['`ccmps_types`', 'deviates: label column is `ccmp_type`, not `title`', '`ccmps.ccmp_type`'],
    ['`ccmps_subentities`', "deviates: label column is `chapter_title`, not `title`. Also holds `region` — the chapter's own region, a distinct concept from a person's individual `ccmps.region` — plus `state` (two-letter `ref_states` code) and `active` (0 = left out of the website counts, e.g. the Place Holder rows), both added 2026-10-21. Maintained on the Chapters screen, `system-subentities/manage` (System Admin menu; Honcho: " + "Members menu), rebuilt 2026-10-21 on the maintenance-table pattern; a chapter can only be deleted when no member record belongs to it. The National HQ row (`SUBENTITY_NATIONAL_ID` in `config.php`, 99) is not a chapter: hidden from that screen and never counted", '`ccmps.subentity`'],
    ['`ccmps_subentity_roles`', "standard _today_ — originally shipped as `office_title`, renamed to `title` partway through this module's development. The chapter-president lookup depends on matching `title = 'President'`.", '`ccmps.subentity_role`'],
    ['`ref_national_offices`', 'deviates: label column is `office_title`, not `title` — this one was _never_ renamed, unlike the table above. Easy to confuse the two.', '`ccmps.national_officer`'],
    ['`ccmps_status`', 'standard', "`ccmps.status` — real lookup as of the latest version; `recalcstatus()` (legacy, unrebuilt) still hardcodes ids 1/2/5 on the write side, which happen to match this table's actual rows today. Lifetime members (`current_year` = `CCMP_LIFETIME_YEAR`, 2099; 9999 was changed to 2099 on 2026-10-22) are always Current (1), and saving a record keeps 2099 instead of reverting it to the dues payment year"],
    ['`ref_states`', 'deviates: `name` + `state_code` (not title/description); dropdown shows "state_code (name)"', 'all four `*state` fields in `ccmps_addresses`'],
    ['`ref_countries`', 'deviates: `name` + `alpha3`', 'all four `*country` fields in `ccmps_addresses`'],
    ['`ref_counties`', 'deviates: `fips` + `title` + `state` (used for client-side cascading filter by state)', 'all four `*county` fields in `ccmps_addresses`'],
    ['`ccmps_bulk_actions`', 'standard', "bulk-action dropdown on `manage.php`'s member list — bulk actions performed _on ccmps records_. This wasn't always correct: the dropdown originally queried `subentities_bulk_actions` instead, a similarly-named table that had no effect when edited, which is exactly how this got caught — someone edited it expecting the dropdown to change, and nothing happened."],
    ['`subentities_bulk_actions`', 'standard', '_Not currently used by any code._ Reserved for bulk actions performed on the _subentity (chapter) list_, on the subentity-management page (`system-subentities`), which doesn\'t use them yet. Don\'t confuse this with the table above — the naming distinction (`ccmps_*` vs. `subentities_*`) tracks which list the actions apply to, not which manage page they live on.'],
    ['`ccmps_settings`', 'deviates: `type` groups rows into 5 blocks of 3 (one per element type, one row per size tier), `settingvalue` holds the actual pixel number rather than a description', 'The font-size preference system — see the Styling tab for the full mechanism. Editable via a dedicated system_admin CRUD (`managefontsizes()`), not through the normal member-record whitelist.'],
  ]},

  { type: 'h2', text: 'Framework Table Used Directly' },
  { type: 'p', text: '`trongate_tokens` (`id`, `token`, `user_id`, `expiry_date`, `code`) — queried in `_convert_to_user_friendly()` to display token expiration on the read-only view. This is a Trongate framework table, not one specific to this module — worth knowing since it means the query pattern depends on framework internals staying stable, not just this module\'s own schema.' },

  { type: 'h2', text: 'Referenced Only in Untouched Legacy Code (not actually used)' },
  { type: 'p', text: '`ccmps_financial`, `ccmps_financial_statuses`, `ccmps_financial_types`, `ccmps_scopes` all appear in old, unrebuilt functions — mostly commented out, or populating a dropdown array that no current form section actually renders. None of this drives any real feature today. Worth knowing they exist in case a future financial-tracking feature gets built and this legacy code gets revived rather than rewritten from scratch.' },
]},

// ============================================================
{ tab: "RBAC", blocks: [
  { type: 'h2', text: 'Session Variable Scoping Convention' },
  { type: 'alert', variant: 'info', text: "**`ccmps_`-prefixed session variables are scoped to this module only. Unprefixed variables are enterprise-wide, spanning every module.** For example, `$_SESSION['ccmps_system_admin']` is set from `ccmps.system_admin` and grants system-admin rights within the CCMPS module only. `$_SESSION['system_admin']` (no prefix) will be set by the Honcho module, from `honcho_user_accounts`, and grants system-admin rights across _every_ module — Honcho isn't built yet, but this module's code already recognizes it, since an enterprise-wide admin should obviously have full rights here too. Every permission check that involves `system_admin` checks both forms with `||`, for exactly this reason. The same convention applies to future roles: `ccmps_content_admin`/`ccmps_event_admin` will be this module's own content/event management (not yet built); a future unprefixed `library_admin` would control one shared document library across the whole enterprise." },

  { type: 'h2', text: 'The Core Rule' },
  { type: 'alert', variant: 'warning', text: "**A `disabled` HTML attribute is UX polish, not security.** Anyone can remove it via browser dev tools and submit the field anyway. Every permission check that matters is duplicated server-side in `ccmpsubmit()`, which independently strips restricted fields from the save whitelist before anything touches the database — regardless of what the submitted form claims. If you ever add a new restricted field, you MUST add the strip logic in `ccmpsubmit()`, not just hide/disable it in the form. The form-side gating exists purely so the UI doesn't lie to the user about what they can do." },

  { type: 'h2', text: 'The Permission Variables' },
  { type: 'table', headers: ['Variable', 'Meaning'], rows: [
    ['`$is_system_admin`', "`$_SESSION['ccmps_system_admin'] || $_SESSION['system_admin']` — the narrowest, most trusted tier, recognizing either module-scoped or future enterprise-wide admin. Controls the 7+ core system flags (System Admin, Student Admin, CCMP Admin, Content Admin, Event Admin, Locked, Inactive, Approved), permanent delete, and Account tab fields (activate_code, reset_code)."],
    ['`$is_admin`', '`system_admin || subentity_admin || ccmp_admin`. The broader "trusted staff" tier — Membership section, Certificates & Ratings, Admin Notes, soft delete.'],
    ['`$is_vip_admin`', '`system_admin || subentity_admin || ccmp_admin` — deliberately excludes `student_admin`. Controls VIP field visibility specifically.'],
    ['`$is_chapter_president`', "True if the viewer's own `ccmps_subentity_role` matches the role whose `title = 'President'` in `ccmps_subentity_roles`. Looked up dynamically — never hardcode the role id, since it can change independently of this code."],
    ['`$is_own_chapter`', "True if the viewer's own chapter (`$_SESSION['ccmps_subentity']`) matches the _target record's_ chapter. Critical: the target's chapter must be read from the raw id, never from a friendly-translated display string (see the worked example below)."],
    ['`$can_grant_chapter_admin`', '`system_admin || ccmp_admin || ((subentity_admin || is_chapter_president) && is_own_chapter)`. See below.'],
  ]},

  { type: 'h2', text: 'Worked Example: Chapter-Admin Granting' },
  { type: 'p', text: 'This is the most nuanced permission rule in the module, and a good template for reasoning about any future rule of similar shape:' },
  { type: 'ul', items: [
    '`system_admin` and `ccmp_admin` operate at the **national level** — they can grant Chapter Admin to any member, in any chapter, with no restriction.',
    "A chapter's own `subentity_admin`, or a member whose role is Chapter President, can **only** grant it to a fellow member of their _own_ chapter.",
  ]},
  { type: 'code', text: "$can_grant_chapter_admin = $is_system_admin\n    || !empty($_SESSION['ccmp_admin'])\n    || (($is_chapter_president || !empty($_SESSION['ccmps_subentity_admin'])) && $is_own_chapter);" },
  { type: 'alert', variant: 'warning', text: "**A real bug we found and fixed here:** `viewccmp.php` receives data _after_ `_convert_to_user_friendly()` has already run, which overwrites `$data['subentity']` with the chapter's _text name_ for display purposes. Comparing that text name against the viewer's raw numeric session id would never match — silently hiding the grant checkbox from every legitimate chapter president, with no error anywhere to indicate why. Fixed by preserving the raw id under a separate `$data['subentity_id']` key before the text translation happens. **Lesson: when a value is going to get \"friendly-formatted\" for display, always ask whether anything downstream still needs the raw form — and if so, keep both.**" },

  { type: 'h2', text: 'Member Permissions Screen' },
  { type: 'p', text: "`welcome-ccmpspermissions/manage` (System Admin menu → Member Permissions, added 2026-10-16) lists members with a checkbox for each super-user flag, so permissions can be seen and set in one place instead of record by record. It opens showing only members who hold a permission; `manage/all` shows every member (deceased and soft-deleted excluded)." },
  { type: 'ul', items: [
    '**Who:** member system admins only, whether or not the Honcho staff module is deployed. The check in `__construct()` reads `system_admin` from the database, not the session, so removing someone\'s System Admin locks them out of the screen at once. Staff logins are sent back to the Honcho dashboard.',
    '**Columns:** the flags login copies into the session, listed in `_permission_flags()`: `system_admin`, `ccmp_admin`, `subentity_admin`, `student_admin`, `content_admin`, `event_admin` (since 2026-10-20, for the content manager), `financial_admin` (since 2026-10-22: Financial Admins change the Financial tab of System Settings). `library_admin` is on `ccmps` but nothing reads it yet; add it to `_permission_flags()` and `rbac_member_roles()` when something does.',
    '**Saving:** each click posts to `togglepermission()` (AJAX, JSON reply). Since RBAC step 5 (2026-10-18) a tick **joins or leaves the role\'s Security Group** (`rbac_set_member_role()`: Member System Admins, Member Admins, Chapter Admins, Student Admins, Content Admins, Event Admins) and the `ccmps` column is re-synced from the groups; a role the member also gets from another group can\'t be removed here (the reply says so). It writes a `GrantPermission`/`RemovePermission` Auditlog entry. Only columns in `_permission_flags()` can be changed, and a per-session token stops other sites posting changes.',
    "**Safety:** you can't remove your own System Admin, and the last System Admin can't be removed.",
    "**When it takes effect:** at that member's next login, because login sets the `ccmps_*` flags from the groups (`rbac_member_session_flags()`). Changing your own flags updates your session straight away.",
  ]},

  { type: 'h2', text: 'Member Admin Roles Live in Security Groups' },
  { type: 'p', text: "Since RBAC step 5 (2026-10-18) the four member admin roles are Security Groups functions (`ccmps/system_admin`, `member_admin`, `chapter_admin`, `student_admin`). The `ccmps` columns (`system_admin`, `ccmp_admin`, `subentity_admin`, `student_admin`) are kept as a **copy** so existing queries and reports keep working; `rbac_sync_member_columns()` rewrites them after every change. The Member Permissions screen, the Roles & Permissions boxes on the member record (`ccmpsubmit()`) and the Security Groups screens all go through the same helpers, so the three always agree." },
  { type: 'ul', items: [
    "**Login and refresh** (`Welcome.php`, `refreshmysessiondata()`): the flags are set from the columns, then from the groups when the member has a login row. They also set `ccmps_admin` from `ccmps_ccmp_admin`; the menus check `ccmps_admin`, which nothing used to set, so the Member Admin menu now appears.",
    "**A member with no login row** gets one (`trongate_users`) when given a role; a member who never gets a role doesn't need one. Members with no login row keep column-based flags.",
    "**Deceased members** keep no roles: saving a record with Deceased ticked calls `rbac_clear_member_access()`, which removes the login from every Security Group and clears the four columns (since 2026-10-19; older records were cleared by `2026-10-19-clear-deceased-member-roles.sql`). Soft-deleted members were left out of the groups in step 2, so their columns may still show roles.",
  ]},

  { type: 'h2', text: 'When a Member Is Marked Deceased' },
  { type: 'p', text: "`ccmps.deceased` is a checkbox in the **Admin Notes** section of the edit form (hidden from the member; `system_admin`, `subentity_admin` and `ccmp_admin` can set it). Ticking it and saving does the following:" },
  { type: 'ul', items: [
    "**Roles and groups removed** (since 2026-10-19): after the role checkboxes are applied, `ccmpsubmit()` calls `rbac_clear_member_access()` (`rbac_helper.php`). It deletes every `system_group_users` row for the member's login (all groups, including DMS Users) and sets `system_admin`, `ccmp_admin`, `subentity_admin` and `student_admin` to 0. It runs on every save while the box stays ticked, so ticking a role on a deceased member doesn't stick.",
    "**Email not required:** the save skips the \"Email Address is required\" check (`$is_deceased`).",
    "**Left out of lists and counts:** home-page counts, the chapter roster (`currentroster()`), the national directory (`currentdirectory()`), the treasurer's spreadsheet (`mastercurrentroster()`), the member-list year tiers in `manage()` (the \"all records\" tier still shows them), and the PWA API's `chapterroster` and `directory` all filter `deceased != 1`. Exports show the column as TRUE/FALSE.",
    "**Older records:** `database/migrations/2026-10-19-clear-deceased-member-roles.sql` cleared members marked deceased before the rule (Leslie Morris, 1435). Safe to re-run.",
    "**Login refused** (since 2026-10-19): `Welcome::username_pw_check()` stops a deceased member after the password check and before any token is made (\"This account is no longer active\"). `mobile_bridge()` and the PWA API's `login()` and token check refuse them too, so an app session ends at its next request. A member already signed in on the website stays signed in until they log out or the session ends.",
  ]},
  { type: 'alert', variant: 'warning', text: "Unticking Deceased lets the member log in again but doesn't give back roles or groups; they have to be granted again." },

  { type: 'h2', text: 'Login Holds' },
  { type: 'p', text: "`Welcome::username_pw_check()` runs after the password is checked and before a login token is made. A hold sets a flash message and sends the person back to `welcome/login`:" },
  { type: 'table', headers: ['Column', 'Message', 'Since'], rows: [
    ['`locked`', "\"Your account has been locked. Please contact your <SUBENTITY> Administrator.\" (staff: \"your System Administrator\")", '2026-10-19'],
    ['`deceased` (members)', '"This account is no longer active. Please contact your Administrator."', '2026-10-19'],
    ['`soft_deleted`', '"Your account has been deleted. Please contact the System Administrator."', '2026-10-19'],
    ['`inactive`', '"Your account is inactive…" (checked again in `authenticate()`)', 'earlier'],
  ]},
  { type: 'p', text: "The unapproved check in the same method still only `return`s an error, which `authenticate()` ignores, so it doesn't stop a login (on the to-do list)." },

  { type: 'h2', text: 'Terminology Constants' },
  { type: 'p', text: "Org-specific words come from `config/config.php`: `CCMP` / `CCMPS` (Member/Members), `SUBENTITY` / `SUBENTITIES` (Chapter/Chapters, or Branch, Office…). Screen text uses the constant, never the word: `<?= SUBENTITY ?> Admin` in a view, `SUBENTITY.' Admin'` in PHP, `strtolower(SUBENTITY)` mid-sentence. Swept through the live member, CMS, DMS and Subentities screens on 2026-10-19. Not covered: data (chapter names, Security Group titles such as \"Chapter Admins\"), code identifiers, and the phone app, which hard-codes its words in `public/ccmpsmobile/index.html` (on the to-do list)." },

  { type: 'h2', text: 'Visible-but-Disabled vs. Fully-Hidden' },
  { type: 'p', text: 'Two distinct patterns are used throughout, and the choice between them is deliberate, not arbitrary:' },
  { type: 'ul', items: [
    "**Visible but disabled** — the field renders for everyone, greyed out for those without edit rights. Used when it's reasonable for someone to _see_ their own status even if they can't change it (e.g. Soft Deleted, once visibility was extended to chapter admins).",
    '**Fully hidden** — the field/section doesn\'t render in the DOM at all for unauthorized viewers. Used for genuinely sensitive things (Notes, Deceased, the core system-permission flags) where even knowing the field exists isn\'t appropriate for a regular member.',
  ]},
]},

// ============================================================
{ tab: "Member Cards", blocks: [
  { type: 'p', text: "Digital membership cards ([plan](https://claude.ai/artifact/3QVrXXRpZryjkkj21NLftc), 2026-10-26). Phase 1, built: the card in the member portal and the phone app. Next: door check-in and attendance (phase 2), Google Wallet (phase 3). Apple Wallet and event registration come later." },
  { type: 'table', headers: ['Piece', 'Where'], rows: [
    ['Logic', '`engine/tg_helpers/card_helper.php`: `card_for_member()`, `card_code()`, `card_lookup()`, `card_reissue()`, `card_details()`'],
    ['Portal', '`modules/welcome/cards/` (`welcome-cards`): `mycard` (the member\'s own; side menu **My Card**), `card/<id>` (admins; **Card** button on the member record), `reissue` (POST)'],
    ['Phone app', '`welcome-api/mycard` (GET) and `welcome-api/reissuecard` (POST); the **Card** tab in `public/ccmpsmobile/` (shell cache `bpa-shell-v17`)'],
    ['QR drawing', '`public/js/qrcode-generator-1.4.4/qrcode.js` (MIT, npm checksum in its README), in the browser'],
    ['Table', '`ccmps_cards` (`2026-10-26-member-cards.sql`): one active row per member; cancelled rows are kept'],
  ]},
  { type: 'h2', text: 'The Code' },
  { type: 'p', text: "The QR holds `HC1:<card id>:<signature>`. The signature is the first 16 bytes of `HMAC-SHA256('card:<id>:<issued_at>')`, base64url (22 characters), keyed with `CARD_SECRET` from `.env`, or a key derived from `JWT_SECRET` when that's not set. So the code carries no personal information, the table holds nothing that makes a working code, and `card_lookup()` (compares with `hash_equals`) rejects anything made up or tampered with. A cancelled card's code still verifies but returns `status = cancelled`, so the door can say \"cancelled card\" rather than \"not ours\". **Changing `CARD_SECRET` (or `JWT_SECRET` when it's unset) cancels every card at once.**" },
  { type: 'ul', items: [
    "A card is made the first time it's viewed (`issued_by` 0). Deceased and deleted members get none.",
    "Reissue (lost phone) cancels the active card and issues a new row; logged as `ReissueCard` in the Auditlog.",
    "Who may see and reissue someone else's card (`Cards::_can_manage()`): member System and Member Admins, staff system and member admins, Chapter Admins for their own chapter.",
    "Card colors: the scheme's Label color (`CCMPS_CRUD_LABEL_CLR`, dark in every scheme) with the Accent color (`SN2_CLR`). It shows name, member number, chapter, member type, photo (initials if none) and \"Valid through\" (`current_year`, or Lifetime for 2099).",
    "The phone app keeps the last card it loaded (`localStorage` `bpa_card`) so it opens without signal at the door; sign-out removes it.",
  ]},
]},

// ============================================================
{ tab: "CCMPS_AUX_MODULE", blocks: [
  { type: 'h2', text: 'Core vs. Extension' },
  { type: 'p', text: 'This module was deliberately split so it can be sold and deployed two ways:' },
  { type: 'ul', items: [
    '**Baseline / core** — `ccmps` + `ccmps_addresses` only. Works for any organization with "customers, clients, members, or participants" (the generic `ccmp` naming reflects this intentionally).',
    "**Full / with extension** — adds `ccmps_aux` and `ccmps_aircraft`, which are aviation-specific (pilot certificates, ratings, aircraft ownership). Only relevant to this particular customer (a pilots' association); a different buyer would never need this.",
  ]},

  { type: 'h2', text: 'How the Gate Works' },
  { type: 'p', text: 'Set once, in your config file:' },
  { type: 'code', text: "define('CCMPS_AUX_MODULE', 1); // full deployment\n// or simply leave it undefined for a baseline-only deployment" },
  { type: 'p', text: 'Every aux-table section in `ccmpcrudcontact.php` and `viewccmp.php` is wrapped in:' },
  { type: 'code', text: "<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>\n    ... section content ...\n<?php endif; ?>" },
  { type: 'p', text: "With the constant undefined or 0, these sections don't just hide — they never render into the page at all, and no query for their data ever runs." },

  { type: 'alert', variant: 'warning', text: '**One gotcha to remember when moving a field between a core and an aux section:** if a field lives in `ccmps_aux` but ends up displayed inside an otherwise-core section (this happened once with `hall_of_fame`, briefly placed in "Roles & Permissions"), it needs its _own_ inline `CCMPS_AUX_MODULE` check — wrapping just that one field, not the whole section — or a baseline deployment without `ccmps_aux` would try to display data from a table that doesn\'t exist.' },

  { type: 'h2', text: 'Currently Aux-Gated Sections' },
  { type: 'p', text: 'Certificates & Ratings, Aircraft. (Additional Roles was removed entirely once its fields were renamed/relocated to core `ccmps` columns — see Known Issues.)' },
]},

// ============================================================
{ tab: "Known Issues", blocks: [
  { type: 'h2', text: 'The Debug-Die() Landmine Pattern' },
  { type: 'alert', variant: 'warning', text: 'The single most common bug found throughout this legacy codebase: a leftover debug line like `echo(1234); print_r($_SESSION); die();` sitting mid-function from whoever last debugged it. `die()` halts execution immediately — everything after it, including the actual save/redirect logic, silently never runs. We found and fixed this exact pattern independently in at least five different functions (`delrecord`, `undelrecord`, `removerecord`/`permdelete`, `ccmpsubmit`, `manage`) before recognizing it as a systemic pattern, then swept the entire ~8,000-line file and commented out all 334 remaining occurrences in one pass. **If you find a function that appears to "do nothing" or die unexpectedly, search it for a bare `die();` first — it is the most likely cause.**' },

  { type: 'h2', text: 'Confirmed Real Bugs Found & Fixed (Reference List)' },
  { type: 'table', headers: ['Bug', 'Where', 'Fix'], rows: [
    ['**Session variable prefix mismatch — arguably the most severe bug found in this codebase.** Every permission check for system_admin/student_admin/subentity_admin checked the unprefixed session key, but `refreshmysessiondata()` (the actual login/session-population function) only ever sets the `ccmps_`-prefixed version. This meant every permission check involving these three roles silently evaluated to false for _every user, including genuine admins_ — not a visibility bug, a complete non-function. Caught only because a real system_admin logged in and found their own admin-only features inaccessible.',
      'Every permission variable definition and every direct `$_SESSION[...]` check across all four files (`Ccmps.php`, `ccmpcrudcontact.php`, `viewccmp.php`, `manage.php`)',
      "Added the `ccmps_` prefix throughout, matching the established (and correctly-used-elsewhere) convention already visible in `$_SESSION['ccmps_subentity']`/`$_SESSION['ccmps_subentity_role']`. **Separately confirmed and still unresolved:** `ccmp_admin`, `content_admin`, and `event_admin` are never assigned to any session variable anywhere in this file, under any naming — those three roles have never been functional at all, regardless of prefix. The actual login handler must live in a different module/controller not yet reviewed."],
    ['Object-syntax assignment on an array (`$data->prop = x` when `$data` is actually an array)', '`viewccmp()`, `updateccmp()`', 'PHP throws a genuine fatal `Error` for property _assignment_ on an array (not a silent no-op, despite that being true for property _reads_). Converted to array syntax throughout.'],
    ['Wrong table name used consistently, never actually tested', '`ccmps_subentity_offices` used in 13 places — real table is `ccmps_subentity_roles`', 'Global rename. Lesson: a name appearing consistently throughout legacy code is not proof it\'s correct.'],
    ["Boolean-to-string conversion breaking checkbox state", "`_convert_to_user_friendly()` converted every boolean to the string `'Yes'`/`'No'` for view-page display, but the edit form's checkboxes used `!empty()` on the same field — and `!empty('No')` is `true`, since a non-empty string is always truthy regardless of content.", "Removed the Yes/No conversion; the view page's own `vf_bool_row()` does its own direct truthy check instead."],
    ['Missing function parameter default', '`function updateccmp($retrying)`', "Trongate doesn't reliably auto-populate parameters from URL segments; calling it via a plain link threw a fatal `ArgumentCountError`. Added a default value."],
    ['Duplicate section boundary tags', '`viewccmp.php`, during a section reorder', "An accidentally-inserted extra `endif` prematurely closed the `CCMPS_AUX_MODULE` gate, leaving the file's real closing `endif` orphaned with nothing left to close — a fatal parse error. Always verify balance after restructuring conditional blocks, not just run `php -l` on the final result (which would have caught it, but checking structure explicitly is faster to debug)."],
    ['Bulk-action dropdown silently pointed at the wrong table', "`manage()` queried `subentities_bulk_actions`; a separate, similarly-named `ccmps_bulk_actions` table (the actually-intended one, per its name) had no effect when edited", 'Repointed the query. Caught by direct experience: someone edited the table expecting the dropdown to change, and nothing happened.'],
    ['Real login never actually set the admin session flags it needed to', "`successfullogin()` in `Welcome.php` — the assignments for `ccmps_student_admin`, `ccmps_system_admin`, and `ccmps_cms_admin` were commented out. A separate function, `refreshmysessiondata()`, did set them correctly, but nothing guaranteed it ran on every login. `ccmps_ccmp_admin` was never assigned at all, anywhere.", 'Uncommented and fixed the real login flow. `ccmp_admin` now gets assigned during login too. Caught directly: a real system_admin logged in and the flag still wasn\'t set.'],
    ['Font size preference: three mutually incompatible conventions for the same session variable, plus a dead-code helper function', "`$_SESSION['fontsize']` was set as a raw number in one place, a self-correcting 1/2/3 default in another, and converted to word-strings (`'Large'`/`'Medium'`/`'Small'`) via `switch` in a third — the last of which would silently break the numeric `<h#>` heading-level trick everywhere else read it as a number. Separately, `_get_font_sizes()` (called from 12+ places) referenced `$ccmp_id` before ever assigning it, so its entire database-lookup body was dead code the whole time.", "Replaced entirely with the 5-element, per-user, database-backed system described in the Styling section above — not just the heading-level trick, but the single-value session variable itself. `_get_font_sizes()` kept as a documented no-op (12+ call sites still invoke it) rather than deleted; everything else — the old column, the AJAX handler, all three inconsistent assignment sites — removed outright."],
    ['Roster and directory never listed anyone', '`currentroster.php`, `directorylist.php`', "The views looped over `$rows`, but `currentroster()` / `currentdirectory()` pass `ccmpsrecs`. Views now loop over `$ccmpsrecs`; `$subentity_name` comes from `$_SESSION['subentity_name']`. Fixed 2026-10-19."],
    ['Roster, directory, export and master roster crashed or showed blank pilot columns', '`currentroster()`, `currentdirectory()`, `export()`, `mastercurrentroster()` and their views', "Any blank lookup id crashed `Model::get_where()` (now returns false for null). The queries read only `ccmps`, so aux fields (certificates, ratings, total time, call sign) were missing: they now use `_member_select()`, which joins `ccmps_aux` when `CCMPS_AUX_MODULE` is on. Old column names in the views were renamed (`member_no` → `ccmp_number`, `member_type` → `ccmp_type`, `chapter` → `subentity`, `chapter_role` → `subentity_role`, `other_faq_cert` → `other_faa_cert`); aircraft type and registration come from the first `ccmps_aircraft` row (`_first_aircraft()`). `special_event` and `no_address` no longer exist and print blank. Fixed 2026-10-19."],
  ]},

  { type: 'h2', text: "What's Genuinely Still Broken (Not Yet Fixed)" },
  { type: 'ul', items: [
    "Large swaths of the original ~8,000-line `Ccmps.php` are untouched legacy code, some containing the same debug-die pattern in functions that were never specifically exercised/fixed during this module's active development.",
    "The broader role/function-permission-table RBAC system (`_check_function_permissions()`) is scaffolded but intentionally disabled (commented out) throughout — the simpler session-variable-based checks documented in the RBAC tab are what's actually enforcing anything today.",
  ]},
]},

// ============================================================
{ tab: "Testing", blocks: [
  { type: 'h2', text: 'What Exists' },
  { type: 'p', text: 'A PHPUnit suite with two honest tiers:' },
  { type: 'ul', items: [
    "**Unit tests (no database)** — pure permission logic extracted into `lib/CcmpsPermissions.php`, with no `$_SESSION` or `$this->model` dependency at all. Specifically locks in the chapter-admin same-chapter bug and the subentity/subentity_id mixup as permanent regression tests.",
    "**Integration tests (real database)** — a disposable `bpausa_test` database gets created, schema loaded, tests run inside a transaction that's rolled back after each test, then the whole database is dropped again. Never touches the real `bpausa` database.",
  ]},
  { type: 'alert', variant: 'warning', text: '**Honest limitation:** the integration tests do not call `Ccmps.php`\'s actual PHP methods — Trongate\'s exact bootstrap/autoload mechanism (`Core.php`, `Model.php`) wasn\'t available to build against safely. Instead they replicate the same SQL query patterns the real code depends on (the aircraft-owner sync check, the chapter-matching lookup) and verify those against a live database. This catches schema drift and query-logic bugs, but it\'s one level below "calls the real controller." Upgrading this to call the real class directly is possible if `Model.php`/`Core.php` source becomes available.' },
  { type: 'h2', text: 'Running It' },
  { type: 'code', text: "# One-time setup:\ncomposer require --dev phpunit/phpunit\n# or: brew install phpunit\n\n# Every time:\n./run_integration_tests.sh" },
  { type: 'p', text: 'Creates `bpausa_test`, loads the schema, runs everything, drops the test database again. Safe to run repeatedly.' },
]},

// ============================================================
{ tab: "Extending", blocks: [
  { type: 'h2', text: 'Adding a New Field — Step by Step' },
  { type: 'ol', items: [
    '**Confirm the real column** — table, name, type. Never assume based on a similarly-named field elsewhere; several bugs in this module came from exactly that assumption.',
    '**Decide the permission tier** — freely member-editable? Visible-but-disabled for non-admins? Fully hidden? Match it to an existing pattern in the RBAC tab rather than inventing a new one, unless the rule genuinely doesn\'t fit any existing tier.',
    "**Add it to the form** (`ccmpcrudcontact.php`) — `cf_text()`/`cf_select()` for the appropriate table's section. If it's on `ccmps_aux`, make sure the section itself (or the field specifically) is wrapped in the `CCMPS_AUX_MODULE` check.",
    '**Add it to the view** (`viewccmp.php`) — `vf_row()` for plain text, `vf_bool_row()` for a checkbox-style field, inside the matching tab.',
    "**Add it to the server-side whitelist** (`Ccmps.php`, `ccmpsubmit()`) — this is the step most likely to be forgotten, and the one that actually matters for security. If it's restricted, add it to the appropriate strip list (`system_admin_only`, `broader_admin_only_text/bool`, or a new dedicated check if the rule doesn't fit an existing one) — **never** rely on the form's `disabled` attribute alone.",
    "**Lint everything** — `php -l` on every file touched, every time. It's caught a real, otherwise-invisible bug (a malformed conditional block) more than once during this module's development.",
  ]},
  { type: 'h2', text: 'Adding a New One-to-Many Child Table' },
  { type: 'p', text: 'The `ccmps_aircraft` table (a member can own/rent multiple aircraft) is the reference implementation for this pattern:' },
  { type: 'ul', items: [
    "Fetch the full list in `_get_a_single_record()`, stored under its own key (e.g. `$data['aircraft_records']`) — not merged into the flat single-value `$data` array like everything else.",
    'The form renders each existing record as its own editable row using array-indexed field names (`aircraft[0][make]`, `aircraft[1][make]`, ...), plus a couple of always-present blank rows for adding new ones — no JavaScript needed.',
    "The save handler in `ccmpsubmit()` loops the submitted array: a row with a real `id` matching one this person actually owns gets updated (or deleted, if its delete checkbox was checked); a row with no `id` but real data gets inserted; a genuinely blank row is silently skipped. **Ownership is always re-verified server-side against the database** — never trust a submitted id at face value, or one member could edit/delete another member's records by guessing an id.",
  ]},
]},

];

module.exports = sections;
