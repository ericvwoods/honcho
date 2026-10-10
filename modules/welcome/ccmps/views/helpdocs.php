<?php
  include('navbar.php');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-9">
                    <h1 style="color:cornflowerblue;"><i class="fa fa-book"></i> CCMPS Developer Documentation</h1>
                    <p class="text-muted">Internal reference for developers maintaining this module. Visible to system_admin only.</p>
                </div>
                <div class="col-md-3">
                    <br>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                        <i class="fa fa-times-circle"></i> Close
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-architecture"><i class="fa fa-sitemap"></i> Architecture</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-schema"><i class="fa fa-database"></i> Schema</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-rbac"><i class="fa fa-shield"></i> RBAC</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-auxmodule"><i class="fa fa-puzzle-piece"></i> CCMPS_AUX_MODULE</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-known-issues"><i class="fa fa-exclamation-triangle"></i> Known Issues</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-testing"><i class="fa fa-flask"></i> Testing</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-extending"><i class="fa fa-plus-square"></i> Extending</a></li>
            </ul>

            <div class="tab-content">

                <!-- ============================================================
                     ARCHITECTURE
                     ============================================================ -->
                <div id="tab-architecture" class="tab-pane active">
                    <div class="panel-body">

                        <h2>The Five Files</h2>
                        <p>This module is built from five files that work together. Understanding what each one is <em>for</em> — and just as importantly, what it's <em>not</em> for — is the fastest way to orient yourself in this codebase.</p>

                        <table class="table table-bordered">
                            <thead>
                                <tr><th>File</th><th>Role</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>Ccmps.php</code></td>
                                    <td>The controller. Every action — save, view, delete, manage-list, this help page — is a method here. This is where real security enforcement lives: server-side whitelist stripping, permission checks, database queries. Roughly 8,000 lines; most of it is untouched legacy code from before this module's active development phase (see <strong>Known Issues</strong>).</td>
                                </tr>
                                <tr>
                                    <td><code>ccmpcrud.php</code></td>
                                    <td>Thin wrapper around the edit form. Renders the header (photo, name, Save/Cancel buttons — which pair depends on <code>$_SESSION['actionmode']</code>), then <code>include()</code>s <code>ccmpcrudcontact.php</code> for the actual fields. Rarely needs changes on its own.</td>
                                </tr>
                                <tr>
                                    <td><code>ccmpcrudcontact.php</code></td>
                                    <td>The real edit form. Every editable field lives here, organized into collapsible sections. This is the file you'll touch most often when adding/moving/re-permissioning a field.</td>
                                </tr>
                                <tr>
                                    <td><code>viewccmp.php</code></td>
                                    <td>The read-only view — what a member sees when they open "My Profile" before clicking Update. Same field set as the edit form, conceptually, but rendered as plain text via Bootstrap <strong>tabs</strong> (not collapse panels) using an output-buffering trick — see the code comments at the top of the file for how <code>vf_section_open()</code>/<code>vf_section_close()</code>/<code>vf_tabs_render()</code> work together.</td>
                                </tr>
                                <tr>
                                    <td><code>manage.php</code></td>
                                    <td>The admin list/management view. One unified table (not per-mode duplicates like the original legacy version had), with real SQL <code>JOIN</code>s pulling chapter name, address, and member-type label directly rather than translating codes in PHP.</td>
                                </tr>
                            </tbody>
                        </table>

                        <h2>Styling</h2>
                        <p>Tab/section labels and other UI chrome are styled in <code>custom.css</code>, not <code>style.css</code> and not in any PHP file.</p>
                        <div class="alert alert-warning">
                            <strong>Never add rules to <code>themes/inspinia/css/style.css</code> directly.</strong> That's the theme's own vendor file — a future theme update will silently overwrite it, and anything added there goes with it. <code>custom.css</code> (loaded via its own <code>&lt;link&gt;</code> tag in <code>inspinia.php</code>, placed immediately after <code>style.css</code>'s so it wins the cascade on anything overlapping) is the correct home for every module-specific style going forward. <code>style.css</code> still has some of the previous developer's own hand-edits baked into it from before this project (e.g. a <code>padding: 1px</code> change with a comment noting the original value) — those weren't retroactively migrated, so a theme update could still silently lose them; only new work is protected by this convention going forward.
                        </div>

                        <h3>The Font Size Preference System (per-element, per-user)</h3>
                        <p>Five independently-configurable elements — tabs, section headers, field labels, field values, buttons — each with its own small/medium/large choice, per member. This intentionally allows mismatched combinations (e.g. tiny tabs with huge field values); that flexibility was a deliberate choice, not an oversight, partly in anticipation of a future mobile-specific mode where sizes would be preset for what renders best and members wouldn't be allowed to edit them at all.</p>
                        <p>Two tables work together:</p>
                        <ul>
                            <li><code>ccmps_settings</code> — 15 rows: one per (element type &times; size tier) combination. Columns: <code>id</code>, <code>title</code> ('small'/'medium'/'large'), <code>settingvalue</code> (the actual pixel number), <code>type</code> ('tab'/'header'/'label'/'value'/'button'), <code>description</code> (the human-readable dropdown label, e.g. "Medium Tabs"). Editable by system_admin via a dedicated CRUD (<code>managefontsizes()</code>/<code>savefontsizesettings()</code>, linked from the sidemenu) — this is where the actual pixel values for each tier get configured, shared across every member.</li>
                            <li><code>ccmps</code> — 5 columns (<code>tab_setting</code>, <code>header_setting</code>, <code>label_setting</code>, <code>value_setting</code>, <code>button_setting</code>), each an FK id into <code>ccmps_settings</code>. This is the per-member choice, editable via 5 ordinary dropdowns in Preferences — no modal, no AJAX, just normal form fields saved through the regular <code>ccmpsubmit()</code> flow.</li>
                        </ul>

                        <div class="alert alert-warning">
                            <strong>Never hardcode a specific <code>ccmps_settings</code> id as "the medium option for type X."</strong> The schema's own column defaults do exactly this (<code>tab_setting</code> defaults to <code>2</code>, <code>header_setting</code> to <code>5</code>, and so on — each the middle id of its 3-row block, assuming a specific insert order) — that's acceptable as a database-level fallback, since MySQL <code>DEFAULT</code> clauses can only be literal values, not dynamic lookups. But no <em>application code</em> should make that same assumption. Every place that needs to resolve "what does this stored id actually mean" — the inline style generator in <code>inspinia.php</code>, and the display translation in <code>_convert_to_user_friendly()</code> — looks the row up by matching <code>type</code> + <code>title = 'medium'</code> instead, and only falls back to that lookup if the stored id is missing or its <code>type</code> doesn't match what's expected. If <code>ccmps_settings</code> ever gets reordered or reseeded, a hardcoded-id assumption would silently point at the wrong type/tier combination with no error anywhere to catch it.
                        </div>

                        <h3>How the CSS actually gets generated</h3>
                        <p>Since the real pixel values are per-user and only knowable at request time, this can't be static CSS at all — it's a small inline <code>&lt;style&gt;</code> block, generated directly in <code>inspinia.php</code> on every page load. Views in this app render via <code>include()</code>, which preserves the calling controller's <code>$this</code> — so <code>inspinia.php</code> can call <code>$this-&gt;model</code> directly, the same way <code>manage.php</code> and <code>viewccmp.php</code> already do inline, without needing every controller action to pre-compute this and pass it through <code>$data</code>.</p>
                        <pre>// Simplified — see inspinia.php for the full version with the
// type+title fallback guard included.
$ccmp = $this->model->get_where($_SESSION['ccmp_rec_id'], 'ccmps');
$settings = $this->model->get('id', 'ccmps_settings');
// ...resolve each of the 5 stored ids against $settings,
// falling back to type+title 'medium' if anything's missing...
echo '&lt;style&gt;' . implode("\n", $css_rules) . '&lt;/style&gt;';</pre>

                        <h3>What this replaced</h3>
                        <p>A single-value, session-based system that was genuinely broken in three separate ways, not just outdated:</p>
                        <ul>
                            <li>It used the stored font size as an HTML <em>heading level</em> (<code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>) via <code>&lt;h&lt;?= $_SESSION['fontsize'] ?&gt;&gt;...&lt;/h&lt;?= $_SESSION['fontsize'] ?&gt;&gt;</code>, conflating a user's visual preference with document structure — actively confusing anything relying on heading hierarchy, like screen readers.</li>
                            <li>Three different places set that same session variable with mutually incompatible conventions: raw numeric passthrough, a self-correcting default, and a <code>switch</code> that silently converted the number into word-strings (<code>'Large'</code>/<code>'Medium'</code>/<code>'Small'</code>) — which would have broken the heading-level trick outright if it ran afterward.</li>
                            <li>A 12+-call-site helper function, <code>_get_font_sizes()</code>, referenced <code>$ccmp_id</code> before ever assigning it, so its entire database-lookup body was silently dead code the whole time.</li>
                        </ul>
                        <p>All of it — the heading-level trick, the three inconsistent assignment sites, the broken helper function, the standalone Font modal and its AJAX save handler, and the <code>ccmps.fontsize</code> column itself — has been fully removed, not just deprecated.</p>

                        <h2>Trongate MVC Conventions</h2>
                        <ul>
                            <li>Controller methods render a view by setting <code>$data['view_module']</code> / <code>$data['view_file']</code>, then calling <code>$this->templates->inspinia($data)</code>.</li>
                            <li><strong>Trongate does not reliably auto-map URL segments to method parameters.</strong> Don't declare <code>function foo($id)</code> expecting the framework to populate <code>$id</code> from the URL — pull it explicitly with <code>segment(3)</code> instead. We found this the hard way: a parameter with no default value (<code>function updateccmp($retrying)</code>) threw a fatal <code>ArgumentCountError</code> the moment it was called via a plain link, because Trongate called it with zero arguments. Always give parameters a default, or better, don't rely on them at all.</li>
                            <li><code>$this->model->get_where($id, 'table')</code> returns a single <code>stdClass</code> object. <code>$this->model->get_one_where($col, $val, 'table')</code> — same shape, matched by an arbitrary column instead of the primary key. <code>$this->model->query($sql, 'object')</code> — returns an <strong>array</strong> of row objects, even for a single-row result; you need <code>$result[0]</code> to get at it. Mixing these up (assigning object-syntax onto what's actually an array) caused a real fatal crash we had to trace and fix.</li>
                            <li><code>$this->model->get_where_custom($col, $val, '=', $orderCol, 'table')</code> — used for lookups keyed on something other than the primary key, or when you need every matching row rather than just one.</li>
                        </ul>

                        <div class="alert alert-warning">
                            <strong>The single most common bug class in this codebase:</strong> confusing whether a value is an object (<code>-&gt;</code>) or an array (<code>[]</code>). PHP does <em>not</em> reliably throw a loud, obvious error when you get this wrong — depending on context it can silently no-op, throw a quiet warning, or (for property <em>assignment</em> on an array specifically) throw a genuine fatal <code>Error</code>. When something behaves strangely for no obvious reason, checking this mismatch first has paid off repeatedly during this module's development.
                        </div>

                    </div>
                </div>

                <!-- ============================================================
                     SCHEMA
                     ============================================================ -->
                <div id="tab-schema" class="tab-pane">
                    <div class="panel-body">

                        <div class="alert alert-info">
                            <strong>Resolved:</strong> <code>ccmps.salutation</code> was originally <code>varchar(55)</code> despite the code treating it as an integer FK to <code>ref_salutations</code> — since fixed by converting the column to <code>tinyint(1) DEFAULT 0</code> directly in the database. If any member record had a pre-existing free-text salutation (like "Mr.") saved before this change, it's worth a quick check that the type conversion didn't silently coerce it to <code>0</code> rather than mapping it to the correct <code>ref_salutations.id</code> — MySQL will happily do that coercion without erroring, especially outside strict SQL mode.
                        </div>

                        <p>Of everything in the full database dump, only the tables below are actually referenced by this module's code. Tables prefixed <code>cms_</code> belong to a separate content-management module and aren't used here at all. Tables prefixed <code>dms_</code> and <code>honcho_</code> are separate modules entirely (document library and superuser administration, respectively) — conceptually related in places, but not queried directly by any file in this module.</p>

                        <h2>Core Tables</h2>
                        <p>Present regardless of <code>CCMPS_AUX_MODULE</code>. Together, these are what a baseline (non-aviation) deployment of this product actually needs.</p>

                        <h3><code>ccmps</code> — the parent record</h3>
                        <p>One row per person. Organized below by section, matching the form's own layout — the fastest way to find "where does this field live" is to find its section here.</p>

                        <table class="table table-bordered table-condensed">
                            <thead><tr><th>Section</th><th>Fields</th><th>Who can edit</th></tr></thead>
                            <tbody>
                                <tr><td>Personal / Contact / Emergency</td><td><code>salutation</code>, <code>first_name</code>, <code>middle_name</code>, <code>last_name</code>, <code>suffix</code>, <code>gender</code>, <code>birthday</code>, <code>dob</code>, <code>minor</code>, <code>email_address</code>, <code>phone</code>, <code>mobile</code>, <code>fax</code>, <code>website</code>, <code>url_string</code>, <code>alternate_contact/phone/email</code>, <code>emergency_contact/phone/email</code>, <code>active_duty</code>, <code>former_military</code></td><td>The member themselves, freely</td></tr>
                                <tr><td>Employment</td><td><code>employer</code>, <code>title</code>, <code>reports_to</code>, <code>department</code></td><td>The member themselves, freely</td></tr>
                                <tr><td>Membership</td><td><code>ccmp_number</code>, <code>ccmp_type</code>, <code>subentity</code>, <code>subentity_role</code>, <code>current_year</code>, <code>region</code>, <code>national_officer</code>, <code>leadsource</code>, <code>student</code>, <code>eligible_voter</code></td><td><code>system_admin</code>, <code>subentity_admin</code>, or <code>ccmp_admin</code> — never the member themselves</td></tr>
                                <tr><td>Roles &amp; Permissions</td><td><code>system_admin</code>, <code>student_admin</code>, <code>ccmp_admin</code>, <code>content_admin</code>, <code>event_admin</code>, <code>locked</code>, <code>inactive</code>, <code>approved</code></td><td><code>system_admin</code> only</td></tr>
                                <tr><td>Roles &amp; Permissions (broader visibility)</td><td><code>soft_deleted</code></td><td>Visible to <code>system_admin</code>/<code>subentity_admin</code>; editable by <code>system_admin</code> only</td></tr>
                                <tr><td>Preferences</td><td><code>vip</code></td><td><code>system_admin</code>, <code>subentity_admin</code>, or <code>ccmp_admin</code> — deliberately excludes <code>student_admin</code></td></tr>
                                <tr><td>Preferences</td><td><code>subentity_admin</code></td><td>See the RBAC tab's worked example — the chapter-admin-granting exception</td></tr>
                                <tr><td>Preferences</td><td><code>language</code>, <code>donotcall</code>, <code>emailoptout</code>, <code>directoryoptout</code>, <code>mail_notices</code></td><td>The member themselves, freely</td></tr>
                                <tr><td>Admin Notes</td><td><code>notes</code>, <code>deceased</code></td><td>Fully hidden from the member; <code>system_admin</code>/<code>subentity_admin</code>/<code>ccmp_admin</code> can see and edit</td></tr>
                                <tr><td>Account</td><td><code>activate_code</code>, <code>reset_code</code></td><td>Fully hidden from everyone except <code>system_admin</code>, who can both see and edit</td></tr>
                                <tr><td>Account (display-only)</td><td><code>num_logins</code>, <code>last_login</code>, <code>last_logout</code>, <code>ip_address</code></td><td>Visible to everyone with page access; editable by <strong>no one</strong> — application-managed</td></tr>
                                <tr><td><em>Application-managed, not shown anywhere in the CRUD form</em></td><td><code>code</code>, <code>status</code>, <code>fontsize</code>, <code>trongate_user_id</code>, <code>username</code>, <code>password</code>, <code>date_created</code>, <code>last_login_device</code>, <code>user_token</code>, <code>force_pw_chg</code>, <code>timed_reset</code>, <code>reset_interval</code>, <code>created_by</code>, <code>updated_by</code>, <code>misc1/2/3</code>, <code>created_at</code>, <code>updated_at</code>, <code>paid</code>, <code>paypal_txn_id</code>, <code>last_payment_date</code>, <code>payment_amount</code>, <code>picture</code></td><td>Never — set entirely by business logic elsewhere (auth flow, payment processing, <code>recalcstatus()</code>)</td></tr>
                                <tr><td><em>Present in schema, not currently exposed anywhere</em></td><td><code>library_admin</code>, <code>financial_admin</code></td><td>Reserved for a future Honcho-managed feature — deliberately not built into this CRUD, per explicit product decision</td></tr>
                            </tbody>
                        </table>

                        <h3><code>ccmps_addresses</code> — one row per member, four address types</h3>
                        <p>All fields freely member-editable. Each of <code>mail</code>/<code>phys</code>/<code>bill</code>/<code>ship</code> repeats the same pattern: <code>address1</code>, <code>address2</code>, <code>city</code>, <code>state</code>, <code>zip</code>, <code>county</code>, <code>country</code>. <code>bill</code> and <code>ship</code> additionally have their own <code>name</code>/<code>phone</code> pair. <code>mail_phys</code> and <code>bill_ship</code> are the two "same as above" checkboxes.</p>

                        <h2>Extension Tables (gated by <code>CCMPS_AUX_MODULE</code>)</h2>
                        <p>Aviation-specific. Only relevant to this particular deployment; a non-aviation buyer of this product would never see any of this. See the <strong>CCMPS_AUX_MODULE</strong> tab for how the gating itself works.</p>

                        <h3><code>ccmps_aux</code> — pilot certificate &amp; ratings extension</h3>
                        <table class="table table-bordered table-condensed">
                            <thead><tr><th>Fields</th><th>Who can edit</th></tr></thead>
                            <tbody>
                                <tr><td><code>hall_of_fame</code></td><td>Visible to everyone; editable only by <code>system_admin</code>/<code>subentity_admin</code>/<code>ccmp_admin</code></td></tr>
                                <tr><td><code>aircraft_owner</code></td><td>The member themselves, freely — synced automatically from <code>ccmps_aircraft</code> on every page load (see below)</td></tr>
                                <tr><td>Everything else — <code>call_sign</code>, <code>total_time</code>, <code>highest_certificate</code>, <code>certificate_number</code>, every certificate/rating checkbox, <code>maintenance</code>, <code>cred_notes</code>, etc.</td><td>The member themselves, freely</td></tr>
                            </tbody>
                        </table>

                        <h3><code>ccmps_aircraft</code> — one-to-many, a member can own/rent multiple aircraft</h3>
                        <table class="table table-bordered table-condensed">
                            <thead><tr><th>Column</th><th>Notes</th></tr></thead>
                            <tbody>
                                <tr><td><code>ccmp_id</code></td><td>FK to <code>ccmps.id</code> — always re-verified server-side before any update/delete, never trusted from the submitted form</td></tr>
                                <tr><td><code>registration_number</code>, <code>make</code>, <code>model</code></td><td>Free text</td></tr>
                                <tr><td><code>hp</code></td><td>Integer</td></tr>
                                <tr><td><code>engines</code></td><td>Integer count, despite the <code>tinyint(1)</code> type — that's a MySQL display-width quirk, not a value restriction</td></tr>
                                <tr><td><code>own_rent</code></td><td>Boolean. <strong>1 = owned, 0 = rented</strong> — this specific convention was explicitly confirmed, worth remembering since it's not self-evident from the column name alone.</td></tr>
                            </tbody>
                        </table>
                        <p>See the <strong>Extending</strong> tab for the full one-to-many pattern this table established (array-indexed form fields, per-row insert/update/delete logic in <code>ccmpsubmit()</code>).</p>

                        <h2>Reference / Lookup Tables</h2>
                        <p>Most follow one shape: <code>id</code> + <code>title</code> + <code>description</code>. A few deviate, noted below since assuming the standard shape on those specifically has already caused real bugs.</p>

                        <table class="table table-bordered table-condensed">
                            <thead><tr><th>Table</th><th>Shape</th><th>Used for</th></tr></thead>
                            <tbody>
                                <tr><td><code>ref_genders</code></td><td>standard</td><td><code>ccmps.gender</code></td></tr>
                                <tr><td><code>ref_languages</code></td><td>standard</td><td><code>ccmps.language</code></td></tr>
                                <tr><td><code>ref_region_codes</code></td><td>standard</td><td><code>ccmps.region</code></td></tr>
                                <tr><td><code>ref_salutations</code></td><td>standard</td><td><code>ccmps.salutation</code> — see the discrepancy noted at the top of this tab</td></tr>
                                <tr><td><code>ref_leadsource</code></td><td>standard, plus <code>referrer</code> (text) and <code>referrer_id</code> (int, not currently used by any UI)</td><td><code>ccmps.leadsource</code> — dropdown shows "Title (Referrer)"</td></tr>
                                <tr><td><code>ccmps_types</code></td><td>deviates: label column is <code>ccmp_type</code>, not <code>title</code></td><td><code>ccmps.ccmp_type</code></td></tr>
                                <tr><td><code>ccmps_subentities</code></td><td>deviates: label column is <code>chapter_title</code>, not <code>title</code>. Also holds <code>region</code> — the chapter's own region, a distinct concept from a person's individual <code>ccmps.region</code></td><td><code>ccmps.subentity</code></td></tr>
                                <tr><td><code>ccmps_subentity_roles</code></td><td>standard <em>today</em> — originally shipped as <code>office_title</code>, renamed to <code>title</code> partway through this module's development. The chapter-president lookup depends on matching <code>title = 'President'</code>.</td><td><code>ccmps.subentity_role</code></td></tr>
                                <tr><td><code>ref_national_offices</code></td><td>deviates: label column is <code>office_title</code>, not <code>title</code> — this one was <em>never</em> renamed, unlike the table above. Easy to confuse the two.</td><td><code>ccmps.national_officer</code></td></tr>
                                <tr><td><code>ccmps_status</code></td><td>standard</td><td><code>ccmps.status</code> — real lookup as of the latest version; <code>recalcstatus()</code> (legacy, unrebuilt) still hardcodes ids 1/2/5 on the write side, which happen to match this table's actual rows today</td></tr>
                                <tr><td><code>ref_states</code></td><td>deviates: <code>name</code> + <code>state_code</code> (not title/description); dropdown shows "state_code (name)"</td><td>all four <code>*state</code> fields in <code>ccmps_addresses</code></td></tr>
                                <tr><td><code>ref_countries</code></td><td>deviates: <code>name</code> + <code>alpha3</code></td><td>all four <code>*country</code> fields in <code>ccmps_addresses</code></td></tr>
                                <tr><td><code>ref_counties</code></td><td>deviates: <code>fips</code> + <code>title</code> + <code>state</code> (used for client-side cascading filter by state)</td><td>all four <code>*county</code> fields in <code>ccmps_addresses</code></td></tr>
                                <tr><td><code>ccmps_bulk_actions</code></td><td>standard</td><td>bulk-action dropdown on <code>manage.php</code>'s member list — bulk actions performed <em>on ccmps records</em>. This wasn't always correct: the dropdown originally queried <code>subentities_bulk_actions</code> instead, a similarly-named table that had no effect when edited, which is exactly how this got caught — someone edited it expecting the dropdown to change, and nothing happened.</td></tr>
                                <tr><td><code>subentities_bulk_actions</code></td><td>standard</td><td><em>Not currently used by any code.</em> Reserved for bulk actions performed on the <em>subentity (chapter) list</em>, on a future subentity-management page that doesn't exist yet. Don't confuse this with the table above — the naming distinction (<code>ccmps_*</code> vs. <code>subentities_*</code>) tracks which list the actions apply to, not which manage page they live on.</td></tr>
                                <tr><td><code>ccmps_settings</code></td><td>deviates: <code>type</code> groups rows into 5 blocks of 3 (one per element type, one row per size tier), <code>settingvalue</code> holds the actual pixel number rather than a description</td><td>The font-size preference system — see the Styling tab for the full mechanism. Editable via a dedicated system_admin CRUD (<code>managefontsizes()</code>), not through the normal member-record whitelist.</td></tr>
                            </tbody>
                        </table>

                        <h2>Framework Table Used Directly</h2>
                        <p><code>trongate_tokens</code> (<code>id</code>, <code>token</code>, <code>user_id</code>, <code>expiry_date</code>, <code>code</code>) — queried in <code>_convert_to_user_friendly()</code> to display token expiration on the read-only view. This is a Trongate framework table, not one specific to this module — worth knowing since it means the query pattern depends on framework internals staying stable, not just this module's own schema.</p>

                        <h2>Referenced Only in Untouched Legacy Code (not actually used)</h2>
                        <p><code>ccmps_financial</code>, <code>ccmps_financial_statuses</code>, <code>ccmps_financial_types</code>, <code>ccmps_scopes</code> all appear in old, unrebuilt functions — mostly commented out, or populating a dropdown array that no current form section actually renders. None of this drives any real feature today. Worth knowing they exist in case a future financial-tracking feature gets built and this legacy code gets revived rather than rewritten from scratch.</p>

                    </div>
                </div>

                <!-- ============================================================
                     RBAC
                     ============================================================ -->
                <div id="tab-rbac" class="tab-pane">
                    <div class="panel-body">

                        <h2>Session Variable Scoping Convention</h2>
                        <div class="alert alert-info">
                            <strong><code>ccmps_</code>-prefixed session variables are scoped to this module only. Unprefixed variables are enterprise-wide, spanning every module.</strong> For example, <code>$_SESSION['ccmps_system_admin']</code> is set from <code>ccmps.system_admin</code> and grants system-admin rights within the CCMPS module only. <code>$_SESSION['system_admin']</code> (no prefix) will be set by the Honcho module, from <code>honcho_user_accounts</code>, and grants system-admin rights across <em>every</em> module — Honcho isn't built yet, but this module's code already recognizes it, since an enterprise-wide admin should obviously have full rights here too. Every permission check that involves <code>system_admin</code> checks both forms with <code>||</code>, for exactly this reason. The same convention applies to future roles: <code>ccmps_content_admin</code>/<code>ccmps_event_admin</code> will be this module's own content/event management (not yet built); a future unprefixed <code>library_admin</code> would control one shared document library across the whole enterprise.
                        </div>

                        <h2>The Core Rule</h2>
                        <div class="alert alert-warning">
                            <strong>A <code>disabled</code> HTML attribute is UX polish, not security.</strong> Anyone can remove it via browser dev tools and submit the field anyway. Every permission check that matters is duplicated server-side in <code>ccmpsubmit()</code>, which independently strips restricted fields from the save whitelist before anything touches the database — regardless of what the submitted form claims. If you ever add a new restricted field, you MUST add the strip logic in <code>ccmpsubmit()</code>, not just hide/disable it in the form. The form-side gating exists purely so the UI doesn't lie to the user about what they can do.
                        </div>

                        <h2>The Permission Variables</h2>
                        <table class="table table-bordered">
                            <thead><tr><th>Variable</th><th>Meaning</th></tr></thead>
                            <tbody>
                                <tr><td><code>$is_system_admin</code></td><td><code>$_SESSION['ccmps_system_admin'] || $_SESSION['system_admin']</code> — the narrowest, most trusted tier, recognizing either module-scoped or future enterprise-wide admin. Controls the 7+ core system flags (System Admin, Student Admin, CCMP Admin, Content Admin, Event Admin, Locked, Inactive, Approved), permanent delete, and Account tab fields (activate_code, reset_code).</td></tr>
                                <tr><td><code>$is_admin</code></td><td><code>system_admin || subentity_admin || ccmp_admin</code>. The broader "trusted staff" tier — Membership section, Pilot Certificate &amp; Ratings, Admin Notes, soft delete.</td></tr>
                                <tr><td><code>$is_vip_admin</code></td><td><code>system_admin || subentity_admin || ccmp_admin</code> — deliberately excludes <code>student_admin</code>. Controls VIP field visibility specifically.</td></tr>
                                <tr><td><code>$is_chapter_president</code></td><td>True if the viewer's own <code>ccmps_subentity_role</code> matches the role whose <code>title = 'President'</code> in <code>ccmps_subentity_roles</code>. Looked up dynamically — never hardcode the role id, since it can change independently of this code.</td></tr>
                                <tr><td><code>$is_own_chapter</code></td><td>True if the viewer's own chapter (<code>$_SESSION['ccmps_subentity']</code>) matches the <em>target record's</em> chapter. Critical: the target's chapter must be read from the raw id, never from a friendly-translated display string (see the worked example below).</td></tr>
                                <tr><td><code>$can_grant_chapter_admin</code></td><td><code>system_admin || ccmp_admin || ((subentity_admin || is_chapter_president) &amp;&amp; is_own_chapter)</code>. See below.</td></tr>
                            </tbody>
                        </table>

                        <h2>Worked Example: Chapter-Admin Granting</h2>
                        <p>This is the most nuanced permission rule in the module, and a good template for reasoning about any future rule of similar shape:</p>
                        <ul>
                            <li><code>system_admin</code> and <code>ccmp_admin</code> operate at the <strong>national level</strong> — they can grant Chapter Admin to any member, in any chapter, with no restriction.</li>
                            <li>A chapter's own <code>subentity_admin</code>, or a member whose role is Chapter President, can <strong>only</strong> grant it to a fellow member of their <em>own</em> chapter.</li>
                        </ul>
                        <pre>$can_grant_chapter_admin = $is_system_admin
    || !empty($_SESSION['ccmp_admin'])
    || (($is_chapter_president || !empty($_SESSION['ccmps_subentity_admin'])) && $is_own_chapter);</pre>

                        <div class="alert alert-warning">
                            <strong>A real bug we found and fixed here:</strong> <code>viewccmp.php</code> receives data <em>after</em> <code>_convert_to_user_friendly()</code> has already run, which overwrites <code>$data['subentity']</code> with the chapter's <em>text name</em> for display purposes. Comparing that text name against the viewer's raw numeric session id would never match — silently hiding the grant checkbox from every legitimate chapter president, with no error anywhere to indicate why. Fixed by preserving the raw id under a separate <code>$data['subentity_id']</code> key before the text translation happens. <strong>Lesson: when a value is going to get "friendly-formatted" for display, always ask whether anything downstream still needs the raw form — and if so, keep both.</strong>
                        </div>

                        <h2>Visible-but-Disabled vs. Fully-Hidden</h2>
                        <p>Two distinct patterns are used throughout, and the choice between them is deliberate, not arbitrary:</p>
                        <ul>
                            <li><strong>Visible but disabled</strong> — the field renders for everyone, greyed out for those without edit rights. Used when it's reasonable for someone to <em>see</em> their own status even if they can't change it (e.g. Soft Deleted, once visibility was extended to chapter admins).</li>
                            <li><strong>Fully hidden</strong> — the field/section doesn't render in the DOM at all for unauthorized viewers. Used for genuinely sensitive things (Notes, Deceased, the core system-permission flags) where even knowing the field exists isn't appropriate for a regular member.</li>
                        </ul>

                    </div>
                </div>

                <!-- ============================================================
                     CCMPS_AUX_MODULE
                     ============================================================ -->
                <div id="tab-auxmodule" class="tab-pane">
                    <div class="panel-body">

                        <h2>Core vs. Extension</h2>
                        <p>This module was deliberately split so it can be sold and deployed two ways:</p>
                        <ul>
                            <li><strong>Baseline / core</strong> — <code>ccmps</code> + <code>ccmps_addresses</code> only. Works for any organization with "customers, clients, members, or participants" (the generic <code>ccmp</code> naming reflects this intentionally).</li>
                            <li><strong>Full / with extension</strong> — adds <code>ccmps_aux</code> and <code>ccmps_aircraft</code>, which are aviation-specific (pilot certificates, ratings, aircraft ownership). Only relevant to this particular customer (a pilots' association); a different buyer would never need this.</li>
                        </ul>

                        <h2>How the Gate Works</h2>
                        <p>Set once, in your config file:</p>
                        <pre>define('CCMPS_AUX_MODULE', 1); // full deployment
// or simply leave it undefined for a baseline-only deployment</pre>
                        <p>Every aux-table section in <code>ccmpcrudcontact.php</code> and <code>viewccmp.php</code> is wrapped in:</p>
                        <pre>&lt;?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?&gt;
    ... section content ...
&lt;?php endif; ?&gt;</pre>
                        <p>With the constant undefined or 0, these sections don't just hide — they never render into the page at all, and no query for their data ever runs.</p>

                        <div class="alert alert-warning">
                            <strong>One gotcha to remember when moving a field between a core and an aux section:</strong> if a field lives in <code>ccmps_aux</code> but ends up displayed inside an otherwise-core section (this happened once with <code>hall_of_fame</code>, briefly placed in "Roles &amp; Permissions"), it needs its <em>own</em> inline <code>CCMPS_AUX_MODULE</code> check — wrapping just that one field, not the whole section — or a baseline deployment without <code>ccmps_aux</code> would try to display data from a table that doesn't exist.
                        </div>

                        <h2>Currently Aux-Gated Sections</h2>
                        <p>Pilot Certificate &amp; Ratings, Aircraft. (Additional Roles was removed entirely once its fields were renamed/relocated to core <code>ccmps</code> columns — see Known Issues.)</p>

                    </div>
                </div>

                <!-- ============================================================
                     KNOWN ISSUES
                     ============================================================ -->
                <div id="tab-known-issues" class="tab-pane">
                    <div class="panel-body">

                        <h2>The Debug-Die() Landmine Pattern</h2>
                        <div class="alert alert-warning">
                            The single most common bug found throughout this legacy codebase: a leftover debug line like <code>echo(1234); print_r($_SESSION); die();</code> sitting mid-function from whoever last debugged it. <code>die()</code> halts execution immediately — everything after it, including the actual save/redirect logic, silently never runs. We found and fixed this exact pattern independently in at least five different functions (<code>delrecord</code>, <code>undelrecord</code>, <code>removerecord</code>/<code>permdelete</code>, <code>ccmpsubmit</code>, <code>manage</code>) before recognizing it as a systemic pattern, then swept the entire ~8,000-line file and commented out all 334 remaining occurrences in one pass. <strong>If you find a function that appears to "do nothing" or die unexpectedly, search it for a bare <code>die();</code> first — it is the most likely cause.</strong>
                        </div>

                        <h2>Confirmed Real Bugs Found &amp; Fixed (Reference List)</h2>
                        <table class="table table-bordered">
                            <thead><tr><th>Bug</th><th>Where</th><th>Fix</th></tr></thead>
                            <tbody>
                                <tr><td><strong>Session variable prefix mismatch — arguably the most severe bug found in this codebase.</strong> Every permission check for system_admin/student_admin/subentity_admin checked the unprefixed session key, but <code>refreshmysessiondata()</code> (the actual login/session-population function) only ever sets the <code>ccmps_</code>-prefixed version. This meant every permission check involving these three roles silently evaluated to false for <em>every user, including genuine admins</em> — not a visibility bug, a complete non-function. Caught only because a real system_admin logged in and found their own admin-only features inaccessible.</td><td>Every permission variable definition and every direct <code>$_SESSION[...]</code> check across all four files (<code>Ccmps.php</code>, <code>ccmpcrudcontact.php</code>, <code>viewccmp.php</code>, <code>manage.php</code>)</td><td>Added the <code>ccmps_</code> prefix throughout, matching the established (and correctly-used-elsewhere) convention already visible in <code>$_SESSION['ccmps_subentity']</code>/<code>$_SESSION['ccmps_subentity_role']</code>. <strong>Separately confirmed and still unresolved:</strong> <code>ccmp_admin</code>, <code>content_admin</code>, and <code>event_admin</code> are never assigned to any session variable anywhere in this file, under any naming — those three roles have never been functional at all, regardless of prefix. The actual login handler must live in a different module/controller not yet reviewed.</td></tr>
                                <tr><td>Object-syntax assignment on an array (<code>$data-&gt;prop = x</code> when <code>$data</code> is actually an array)</td><td><code>viewccmp()</code>, <code>updateccmp()</code></td><td>PHP throws a genuine fatal <code>Error</code> for property <em>assignment</em> on an array (not a silent no-op, despite that being true for property <em>reads</em>). Converted to array syntax throughout.</td></tr>
                                <tr><td>Wrong table name used consistently, never actually tested</td><td><code>ccmps_subentity_offices</code> used in 13 places — real table is <code>ccmps_subentity_roles</code></td><td>Global rename. Lesson: a name appearing consistently throughout legacy code is not proof it's correct.</td></tr>
                                <tr><td>Boolean-to-string conversion breaking checkbox state</td><td><code>_convert_to_user_friendly()</code> converted every boolean to the string <code>'Yes'</code>/<code>'No'</code> for view-page display, but the edit form's checkboxes used <code>!empty()</code> on the same field — and <code>!empty('No')</code> is <code>true</code>, since a non-empty string is always truthy regardless of content.</td><td>Removed the Yes/No conversion; the view page's own <code>vf_bool_row()</code> does its own direct truthy check instead.</td></tr>
                                <tr><td>Missing function parameter default</td><td><code>function updateccmp($retrying)</code></td><td>Trongate doesn't reliably auto-populate parameters from URL segments; calling it via a plain link threw a fatal <code>ArgumentCountError</code>. Added a default value.</td></tr>
                                <tr><td>Duplicate section boundary tags</td><td><code>viewccmp.php</code>, during a section reorder</td><td>An accidentally-inserted extra <code>endif</code> prematurely closed the <code>CCMPS_AUX_MODULE</code> gate, leaving the file's real closing <code>endif</code> orphaned with nothing left to close — a fatal parse error. Always verify balance after restructuring conditional blocks, not just run <code>php -l</code> on the final result (which would have caught it, but checking structure explicitly is faster to debug).</td></tr>
                                <tr><td>Bulk-action dropdown silently pointed at the wrong table</td><td><code>manage()</code> queried <code>subentities_bulk_actions</code>; a separate, similarly-named <code>ccmps_bulk_actions</code> table (the actually-intended one, per its name) had no effect when edited</td><td>Repointed the query. Caught by direct experience: someone edited the table expecting the dropdown to change, and nothing happened.</td></tr>
                                <tr><td>Real login never actually set the admin session flags it needed to</td><td><code>successfullogin()</code> in <code>Welcome.php</code> — the assignments for <code>ccmps_student_admin</code>, <code>ccmps_system_admin</code>, and <code>ccmps_cms_admin</code> were commented out. A separate function, <code>refreshmysessiondata()</code>, did set them correctly, but nothing guaranteed it ran on every login. <code>ccmps_ccmp_admin</code> was never assigned at all, anywhere.</td><td>Uncommented and fixed the real login flow. <code>ccmp_admin</code> now gets assigned during login too. Caught directly: a real system_admin logged in and the flag still wasn't set.</td></tr>
                                <tr><td>Font size preference: three mutually incompatible conventions for the same session variable, plus a dead-code helper function</td><td><code>$_SESSION['fontsize']</code> was set as a raw number in one place, a self-correcting 1/2/3 default in another, and converted to word-strings (<code>'Large'</code>/<code>'Medium'</code>/<code>'Small'</code>) via <code>switch</code> in a third — the last of which would silently break the numeric <code>&lt;h#&gt;</code> heading-level trick everywhere else read it as a number. Separately, <code>_get_font_sizes()</code> (called from 12+ places) referenced <code>$ccmp_id</code> before ever assigning it, so its entire database-lookup body was dead code the whole time.</td><td>Replaced entirely with the 5-element, per-user, database-backed system described in the Styling section above — not just the heading-level trick, but the single-value session variable itself. <code>_get_font_sizes()</code> kept as a documented no-op (12+ call sites still invoke it) rather than deleted; everything else — the old column, the AJAX handler, all three inconsistent assignment sites — removed outright.</td></tr>
                            </tbody>
                        </table>

                        <h2>What's Genuinely Still Broken (Not Yet Fixed)</h2>
                        <ul>
                            <li>Large swaths of the original ~8,000-line <code>Ccmps.php</code> are untouched legacy code, some containing the same debug-die pattern in functions that were never specifically exercised/fixed during this module's active development.</li>
                            <li>The broader role/function-permission-table RBAC system (<code>_check_function_permissions()</code>) is scaffolded but intentionally disabled (commented out) throughout — the simpler session-variable-based checks documented in the RBAC tab are what's actually enforcing anything today.</li>
                        </ul>

                    </div>
                </div>

                <!-- ============================================================
                     TESTING
                     ============================================================ -->
                <div id="tab-testing" class="tab-pane">
                    <div class="panel-body">

                        <h2>What Exists</h2>
                        <p>A PHPUnit suite with two honest tiers:</p>
                        <ul>
                            <li><strong>Unit tests (no database)</strong> — pure permission logic extracted into <code>lib/CcmpsPermissions.php</code>, with no <code>$_SESSION</code> or <code>$this-&gt;model</code> dependency at all. Specifically locks in the chapter-admin same-chapter bug and the subentity/subentity_id mixup as permanent regression tests.</li>
                            <li><strong>Integration tests (real database)</strong> — a disposable <code>bpausa_test</code> database gets created, schema loaded, tests run inside a transaction that's rolled back after each test, then the whole database is dropped again. Never touches the real <code>bpausa</code> database.</li>
                        </ul>

                        <div class="alert alert-warning">
                            <strong>Honest limitation:</strong> the integration tests do not call <code>Ccmps.php</code>'s actual PHP methods — Trongate's exact bootstrap/autoload mechanism (<code>Core.php</code>, <code>Model.php</code>) wasn't available to build against safely. Instead they replicate the same SQL query patterns the real code depends on (the aircraft-owner sync check, the chapter-matching lookup) and verify those against a live database. This catches schema drift and query-logic bugs, but it's one level below "calls the real controller." Upgrading this to call the real class directly is possible if <code>Model.php</code>/<code>Core.php</code> source becomes available.
                        </div>

                        <h2>Running It</h2>
                        <pre># One-time setup:
composer require --dev phpunit/phpunit
# or: brew install phpunit

# Every time:
./run_integration_tests.sh</pre>
                        <p>Creates <code>bpausa_test</code>, loads the schema, runs everything, drops the test database again. Safe to run repeatedly.</p>

                    </div>
                </div>

                <!-- ============================================================
                     EXTENDING
                     ============================================================ -->
                <div id="tab-extending" class="tab-pane">
                    <div class="panel-body">

                        <h2>Adding a New Field — Step by Step</h2>
                        <ol>
                            <li><strong>Confirm the real column</strong> — table, name, type. Never assume based on a similarly-named field elsewhere; several bugs in this module came from exactly that assumption.</li>
                            <li><strong>Decide the permission tier</strong> — freely member-editable? Visible-but-disabled for non-admins? Fully hidden? Match it to an existing pattern in the RBAC tab rather than inventing a new one, unless the rule genuinely doesn't fit any existing tier.</li>
                            <li><strong>Add it to the form</strong> (<code>ccmpcrudcontact.php</code>) — <code>cf_text()</code>/<code>cf_select()</code> for the appropriate table's section. If it's on <code>ccmps_aux</code>, make sure the section itself (or the field specifically) is wrapped in the <code>CCMPS_AUX_MODULE</code> check.</li>
                            <li><strong>Add it to the view</strong> (<code>viewccmp.php</code>) — <code>vf_row()</code> for plain text, <code>vf_bool_row()</code> for a checkbox-style field, inside the matching tab.</li>
                            <li><strong>Add it to the server-side whitelist</strong> (<code>Ccmps.php</code>, <code>ccmpsubmit()</code>) — this is the step most likely to be forgotten, and the one that actually matters for security. If it's restricted, add it to the appropriate strip list (<code>system_admin_only</code>, <code>broader_admin_only_text/bool</code>, or a new dedicated check if the rule doesn't fit an existing one) — <strong>never</strong> rely on the form's <code>disabled</code> attribute alone.</li>
                            <li><strong>Lint everything</strong> — <code>php -l</code> on every file touched, every time. It's caught a real, otherwise-invisible bug (a malformed conditional block) more than once during this module's development.</li>
                        </ol>

                        <h2>Adding a New One-to-Many Child Table</h2>
                        <p>The <code>ccmps_aircraft</code> table (a member can own/rent multiple aircraft) is the reference implementation for this pattern:</p>
                        <ul>
                            <li>Fetch the full list in <code>_get_a_single_record()</code>, stored under its own key (e.g. <code>$data['aircraft_records']</code>) — not merged into the flat single-value <code>$data</code> array like everything else.</li>
                            <li>The form renders each existing record as its own editable row using array-indexed field names (<code>aircraft[0][make]</code>, <code>aircraft[1][make]</code>, ...), plus a couple of always-present blank rows for adding new ones — no JavaScript needed.</li>
                            <li>The save handler in <code>ccmpsubmit()</code> loops the submitted array: a row with a real <code>id</code> matching one this person actually owns gets updated (or deleted, if its delete checkbox was checked); a row with no <code>id</code> but real data gets inserted; a genuinely blank row is silently skipped. <strong>Ownership is always re-verified server-side against the database</strong> — never trust a submitted id at face value, or one member could edit/delete another member's records by guessing an id.</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if (DEBUGGING == true): ?>
    <?php
        echo('<h3>View: welcome-ccmps/views/helpdocs</h3>');
        echo('<h3>$_SESSION</h3>');
        json($_SESSION);
    ?>
<?php endif; ?>
