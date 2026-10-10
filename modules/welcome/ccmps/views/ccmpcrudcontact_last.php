<?php
/*
    ccmpcrudcontact.php
    ---------------------------------------------------------------
    Renders every editable field across all three tables:
        ccmps            -> $data (base member record)
        ccmps_aux        -> $data (merged in by controller; id/ccmp_id already stripped)
        ccmps_addresses  -> $data (merged in by controller; id/ccmp_id already stripped)

    Field names below match the real database column names exactly,
    so the submit handler can whitelist-and-split $_POST back into
    the three tables using the same column names shown here.
    ---------------------------------------------------------------
*/

// ---- Small local helpers to keep the markup below readable ----

function cf_val($data, $key) {
    return htmlspecialchars($data[$key] ?? '', ENT_QUOTES);
}

function cf_text($label, $name, $data, $type = 'text', $extra = '') {
    echo '<div class="form-group col-md-4">';
    echo '<label>' . htmlspecialchars($label) . '</label>';
    echo '<input type="' . $type . '" class="form-control" name="' . $name . '" value="' . cf_val($data, $name) . '" ' . $extra . '>';
    echo '</div>';
}

function cf_textarea($label, $name, $data, $rows = 3) {
    echo '<div class="form-group col-md-12">';
    echo '<label>' . htmlspecialchars($label) . '</label>';
    echo '<textarea class="form-control" name="' . $name . '" rows="' . $rows . '">' . cf_val($data, $name) . '</textarea>';
    echo '</div>';
}

function cf_select($label, $name, $data, $options, $valueField, $displayField, $displayField2 = null, $extra = '', $filterField = null) {
    $current = $data[$name] ?? '';
    echo '<div class="form-group col-md-4">';
    echo '<label>' . htmlspecialchars($label) . '</label>';
    echo '<select class="form-control" name="' . $name . '" ' . $extra . '>';
    echo '<option value="">-- Select --</option>';
    foreach ($options as $row) {
        $value = $row->$valueField;
        $text = $row->$displayField;
        if ($displayField2) {
            $text .= ' (' . $row->$displayField2 . ')';
        }
        $selected = ((string) $value === (string) $current) ? 'selected' : '';
        $filterAttr = $filterField ? ' data-filter="' . htmlspecialchars($row->$filterField) . '"' : '';
        echo '<option value="' . htmlspecialchars($value) . '" ' . $selected . $filterAttr . '>' . htmlspecialchars($text) . '</option>';
    }
    echo '</select>';
    echo '</div>';
}

function cf_section_open($id, $title, $icon = 'fa-folder-open', $open = false) {
    $collapseClass = $open ? 'panel-collapse collapse show' : 'panel-collapse collapse';
    echo '<div class="ibox">';
    echo '<div class="ibox-title">';
    echo '<center><a href="#' . $id . '" class="faq-question"><i class="fa ' . $icon . '"></i> ' . htmlspecialchars($title) . ' <i class="fa fa-unsorted fa-1x"></i></a></center>';
    echo '</div>';
    echo '<div id="' . $id . '" class="' . $collapseClass . '">';
    echo '<div class="ibox-content"><div class="row">';
}

function cf_section_close() {
    echo '</div></div></div></div>'; // .row .ibox-content #id .ibox
}
?>

<!-- ============================================================
     PERSONAL & CONTACT INFORMATION  (ccmps)
     ============================================================ -->
<?php cf_section_open('personal', 'Contact Information', 'fa-phone', true); ?>

    <div class="col-md-12"><h4>Personal Information</h4><hr></div>
    <?php
        cf_text('Salutation', 'salutation', $data);
        cf_text('First Name', 'first_name', $data);
        cf_text('Middle Name', 'middle_name', $data);
        cf_text('Last Name', 'last_name', $data);
        cf_text('Suffix', 'suffix', $data);
        cf_select('Gender', 'gender', $data, $genders, 'id', 'description');
        cf_text('Birthday', 'birthday', $data, 'text', 'placeholder="MM/DD/YYYY"');
    ?>
    <div class="form-group col-md-2">
        <label><input type="checkbox" name="minor" value="1" <?= !empty($data['minor']) ? 'checked' : '' ?>> Minor</label>
    </div>

    <div class="col-md-12"><h4>Contact Information</h4><hr></div>
    <?php
        cf_text('Email Address', 'email_address', $data, 'email');
        cf_text('Phone', 'phone', $data);
        cf_text('Mobile', 'mobile', $data);
        cf_text('Fax', 'fax', $data);
        cf_text('Website', 'website', $data, 'url');
        cf_text('Alternate Contact', 'alternate_contact', $data);
        cf_text('Alternate Phone', 'alternate_phone', $data);
        cf_text('Alternate Email', 'alternate_email', $data, 'email');
    ?>

    <div class="col-md-12"><h4>Emergency Contact</h4><hr></div>
    <?php
        cf_text('Emergency Contact Name', 'emergency_contact', $data);
        cf_text('Emergency Phone', 'emergency_phone', $data);
        cf_text('Emergency Email', 'emergency_email', $data, 'email');
    ?>

<?php cf_section_close(); ?>

<!-- ============================================================
     ADDRESSES  (ccmps_addresses)
     ============================================================ -->
<?php cf_section_open('addresses', 'Addresses', 'fa-map'); ?>

    <div class="col-md-12"><h4>Mailing Address</h4><hr></div>
    <?php
        cf_text('Address 1', 'mailaddress1', $data);
        cf_text('Address 2', 'mailaddress2', $data);
        cf_text('City', 'mailcity', $data);
        cf_select('State', 'mailstate', $data, $states, 'state_code', 'name', 'state_code', 'id="mailstate" data-county-target="mailcounty"');
        cf_text('Zip', 'mailzip', $data);
        cf_select('County', 'mailcounty', $data, $counties, 'fips', 'title', null, 'id="mailcounty"', 'state');
        cf_select('Country', 'mailcountry', $data, $countries, 'alpha3', 'alpha3', 'name');
    ?>

    <div class="col-md-12"><h4>Physical Address</h4><hr></div>
    <div class="form-group col-md-4">
        <label><input type="checkbox" name="mail_phys" value="1" <?= !empty($data['mail_phys']) ? 'checked' : '' ?>> Same as mailing address</label>
    </div>
    <?php
        cf_text('Address 1', 'physaddress1', $data);
        cf_text('Address 2', 'physaddress2', $data);
        cf_text('City', 'physcity', $data);
        cf_select('State', 'physstate', $data, $states, 'state_code', 'name', 'state_code', 'id="physstate" data-county-target="physcounty"');
        cf_text('Zip', 'physzip', $data);
        cf_select('County', 'physcounty', $data, $counties, 'fips', 'title', null, 'id="physcounty"', 'state');
        cf_select('Country', 'physcountry', $data, $countries, 'alpha3', 'alpha3', 'name');
    ?>

    <div class="col-md-12"><h4>Billing Address</h4><hr></div>
    <?php
        cf_text('Bill To Name', 'billname', $data);
        cf_text('Billing Phone', 'billphone', $data);
        cf_text('Address 1', 'billaddress1', $data);
        cf_text('Address 2', 'billaddress2', $data);
        cf_text('City', 'billcity', $data);
        cf_select('State', 'billstate', $data, $states, 'state_code', 'name', 'state_code', 'id="billstate" data-county-target="billcounty"');
        cf_text('Zip', 'billzip', $data);
        cf_select('County', 'billcounty', $data, $counties, 'fips', 'title', null, 'id="billcounty"', 'state');
        cf_select('Country', 'billcountry', $data, $countries, 'alpha3', 'alpha3', 'name');
    ?>

    <div class="col-md-12"><h4>Shipping Address</h4><hr></div>
    <div class="form-group col-md-4">
        <label><input type="checkbox" name="bill_ship" value="1" <?= !empty($data['bill_ship']) ? 'checked' : '' ?>> Same as billing address</label>
    </div>
    <?php
        cf_text('Ship To Name', 'shipname', $data);
        cf_text('Shipping Phone', 'shipphone', $data);
        cf_text('Address 1', 'shipaddress1', $data);
        cf_text('Address 2', 'shipaddress2', $data);
        cf_text('City', 'shipcity', $data);
        cf_select('State', 'shipstate', $data, $states, 'state_code', 'name', 'state_code', 'id="shipstate" data-county-target="shipcounty"');
        cf_text('Zip', 'shipzip', $data);
        cf_select('County', 'shipcounty', $data, $counties, 'fips', 'title', null, 'id="shipcounty"', 'state');
        cf_select('Country', 'shipcountry', $data, $countries, 'alpha3', 'alpha3', 'name');
    ?>

<?php cf_section_close(); ?>

<!-- ============================================================
     MEMBERSHIP & CHAPTER  (ccmps)
     ============================================================ -->
<?php cf_section_open('membership', 'Membership', 'fa-id-card'); ?>
    <?php
        cf_text('Member Number', 'ccmp_number', $data);
        cf_select('Member Type', 'ccmp_type', $data, $ccmptypes, 'id', 'ccmp_type', 'description');
        cf_select('Chapter', 'subentity', $data, $subentities, 'id', 'description');
        cf_select('Chapter Role', 'subentity_role', $data, $ccmpsubentityroles, 'id', 'description');
        cf_text('Current Year', 'current_year', $data, 'number');
        cf_select('Region', 'region', $data, $regions, 'id', 'description');
        cf_select('National Officer', 'national_officer', $data, $national_offices, 'id', 'description');
        cf_select('Preferred Language', 'language', $data, $languages, 'id', 'title');
        cf_select('Lead Source', 'leadsource', $data, $leadsources, 'id', 'title');
    ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="student" value="1" <?= !empty($data['student']) ? 'checked' : '' ?>> Student</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="active_duty" value="1" <?= !empty($data['active_duty']) ? 'checked' : '' ?>> Active Duty</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="former_military" value="1" <?= !empty($data['former_military']) ? 'checked' : '' ?>> Former Military</label></div>
<?php cf_section_close(); ?>

<!-- ============================================================
     ROLES & PERMISSIONS  (ccmps) — admin use only
     ============================================================ -->
<?php if (!empty($_SESSION['system_admin'])): ?>
<?php cf_section_open('roles', 'Roles &amp; Permissions (Admin Only)', 'fa-shield'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="system_admin" value="1" <?= !empty($data['system_admin']) ? 'checked' : '' ?>> System Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="student_admin" value="1" <?= !empty($data['student_admin']) ? 'checked' : '' ?>> Student Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="subentity_admin" value="1" <?= !empty($data['subentity_admin']) ? 'checked' : '' ?>> Chapter Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="locked" value="1" <?= !empty($data['locked']) ? 'checked' : '' ?>> Locked</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="inactive" value="1" <?= !empty($data['inactive']) ? 'checked' : '' ?>> Inactive</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="approved" value="1" <?= !empty($data['approved']) ? 'checked' : '' ?>> Approved</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="soft_deleted" value="1" <?= !empty($data['soft_deleted']) ? 'checked' : '' ?>> Soft Deleted</label></div>
<?php cf_section_close(); ?>
<?php endif; ?>

<!-- ============================================================
     EMPLOYMENT  (ccmps)
     ============================================================ -->
<?php cf_section_open('employment', 'Employment', 'fa-briefcase'); ?>
    <?php
        cf_text('Employer', 'employer', $data);
        cf_text('Title', 'title', $data);
        cf_text('Department', 'department', $data);
        cf_text('Reports To', 'reports_to', $data);
    ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     PREFERENCES  (ccmps)
     ============================================================ -->
<?php cf_section_open('preferences', 'Preferences', 'fa-cog'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="donotcall" value="1" <?= !empty($data['donotcall']) ? 'checked' : '' ?>> Do Not Call</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="emailoptout" value="1" <?= !empty($data['emailoptout']) ? 'checked' : '' ?>> Email Opt Out</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="directoryoptout" value="1" <?= !empty($data['directoryoptout']) ? 'checked' : '' ?>> Directory Opt Out</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="mail_notices" value="1" <?= !empty($data['mail_notices']) ? 'checked' : '' ?>> Mail Notices</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="vip" value="1" <?= !empty($data['vip']) ? 'checked' : '' ?>> VIP</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="deceased" value="1" <?= !empty($data['deceased']) ? 'checked' : '' ?>> Deceased</label></div>
<?php cf_section_close(); ?>

<!-- ============================================================
     NOTES  (ccmps)
     ============================================================ -->
<?php cf_section_open('notes', 'Notes', 'fa-sticky-note'); ?>
    <?php cf_textarea('Notes', 'notes', $data, 5); ?>
<?php cf_section_close(); ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>
<!-- ============================================================
     ============  BEGIN CCMPS_AUX EXTENSION FIELDS  ============
     Everything from here to the end of this file lives in
     ccmps_aux, not ccmps or ccmps_addresses. A baseline deployment
     without this table can skip this whole block by leaving
     CCMPS_AUX_MODULE undefined or set to 0.
     ============================================================ -->

<!-- ============================================================
     MEMBERSHIP EXTRAS  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('membership_extras', 'Membership Extras', 'fa-id-card'); ?>
    <?php cf_text('Old Participant ID', 'old_participant_id', $data); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="eligible_voter" value="1" <?= !empty($data['eligible_voter']) ? 'checked' : '' ?>> Eligible Voter</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="hall_of_fame" value="1" <?= !empty($data['hall_of_fame']) ? 'checked' : '' ?>> Hall of Fame</label></div>
<?php cf_section_close(); ?>

<!-- ============================================================
     ADDITIONAL ROLES  (ccmps_aux) — admin use only
     ============================================================ -->
<?php if (!empty($_SESSION['system_admin'])): ?>
<?php cf_section_open('additional_roles', 'Additional Roles (Admin Only)', 'fa-shield'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="chapter_admin" value="1" <?= !empty($data['chapter_admin']) ? 'checked' : '' ?>> Chapter Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="member_admin" value="1" <?= !empty($data['member_admin']) ? 'checked' : '' ?>> Member Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="event_admin" value="1" <?= !empty($data['event_admin']) ? 'checked' : '' ?>> Event Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="content_mgr" value="1" <?= !empty($data['content_mgr']) ? 'checked' : '' ?>> Content Manager</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="unverified" value="1" <?= !empty($data['unverified']) ? 'checked' : '' ?>> Unverified</label></div>
<?php cf_section_close(); ?>
<?php endif; ?>

<!-- ============================================================
     PILOT CERTIFICATE  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('certificate', 'Pilot Certificate', 'fa-plane'); ?>
    <?php
        cf_text('Call Sign', 'call_sign', $data);
        cf_text('Total Flight Time (hrs)', 'total_time', $data, 'number');
        cf_text('Highest Certificate', 'highest_certificate', $data, 'number');
        cf_text('Certificate Number', 'certificate_number', $data);
    ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="military_pilot" value="1" <?= !empty($data['military_pilot']) ? 'checked' : '' ?>> Military Pilot</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="private" value="1" <?= !empty($data['private']) ? 'checked' : '' ?>> Private</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="commercial" value="1" <?= !empty($data['commercial']) ? 'checked' : '' ?>> Commercial</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="atp" value="1" <?= !empty($data['atp']) ? 'checked' : '' ?>> ATP</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="cfi" value="1" <?= !empty($data['cfi']) ? 'checked' : '' ?>> CFI</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="cfii" value="1" <?= !empty($data['cfii']) ? 'checked' : '' ?>> CFII</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="mei" value="1" <?= !empty($data['mei']) ? 'checked' : '' ?>> MEI</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="dpe" value="1" <?= !empty($data['dpe']) ? 'checked' : '' ?>> DPE</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="bgi" value="1" <?= !empty($data['bgi']) ? 'checked' : '' ?>> BGI</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="agi" value="1" <?= !empty($data['agi']) ? 'checked' : '' ?>> AGI</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="dispatcher" value="1" <?= !empty($data['dispatcher']) ? 'checked' : '' ?>> Dispatcher</label></div>

    <?php
        cf_text('Other Crewmember', 'other_crewmember', $data);
        cf_text('OCM Cert #', 'ocm_certnum', $data);
        cf_text('Other FAA Cert', 'other_faa_cert', $data);
        cf_text('OFC Cert #', 'ofc_certnum', $data);
    ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     RATINGS & CATEGORIES  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('ratings', 'Ratings &amp; Categories', 'fa-certificate'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="se_land" value="1" <?= !empty($data['se_land']) ? 'checked' : '' ?>> SE Land</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="me_land" value="1" <?= !empty($data['me_land']) ? 'checked' : '' ?>> ME Land</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="se_sea" value="1" <?= !empty($data['se_sea']) ? 'checked' : '' ?>> SE Sea</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="me_sea" value="1" <?= !empty($data['me_sea']) ? 'checked' : '' ?>> ME Sea</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="instrument" value="1" <?= !empty($data['instrument']) ? 'checked' : '' ?>> Instrument</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="rotocraft" value="1" <?= !empty($data['rotocraft']) ? 'checked' : '' ?>> Rotorcraft</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="glider" value="1" <?= !empty($data['glider']) ? 'checked' : '' ?>> Glider</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="balloon" value="1" <?= !empty($data['balloon']) ? 'checked' : '' ?>> Balloon</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="drone" value="1" <?= !empty($data['drone']) ? 'checked' : '' ?>> Drone</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="airship" value="1" <?= !empty($data['airship']) ? 'checked' : '' ?>> Airship</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="atc" value="1" <?= !empty($data['atc']) ? 'checked' : '' ?>> ATC</label></div>

    <div class="form-group col-md-2"><label><input type="checkbox" name="ap" value="1" <?= !empty($data['ap']) ? 'checked' : '' ?>> A&amp;P</label></div>
    <?php cf_text('A&P Number', 'ap_number', $data); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="ia" value="1" <?= !empty($data['ia']) ? 'checked' : '' ?>> IA</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="military_maint" value="1" <?= !empty($data['military_maint']) ? 'checked' : '' ?>> Military Maintenance</label></div>
    <?php cf_text('Maintenance Notes', 'maintenance', $data); ?>

    <?php cf_textarea('Credential Notes', 'cred_notes', $data); ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     AIRCRAFT  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('aircraft', 'Aircraft', 'fa-fighter-jet'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="aircraft_owner" value="1" <?= !empty($data['aircraft_owner']) ? 'checked' : '' ?>> Aircraft Owner</label></div>
    <?php
        cf_text('Aircraft Type', 'aircraft_type', $data);
        cf_text('Make/Model/HP', 'aircraft_mmhp', $data);
        cf_text('Registration (Tail #)', 'aircraft_reg', $data);
    ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     EXTENDED PREFERENCES  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('extended_preferences', 'Extended Preferences', 'fa-cog'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="no_address" value="1" <?= !empty($data['no_address']) ? 'checked' : '' ?>> No Address on File</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="special_event" value="1" <?= !empty($data['special_event']) ? 'checked' : '' ?>> Special Event Contact</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="confirmed" value="1" <?= !empty($data['confirmed']) ? 'checked' : '' ?>> Confirmed</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="skyhook" value="1" <?= !empty($data['skyhook']) ? 'checked' : '' ?>> Skyhook</label></div>
    <?php cf_text('Homepage URL', 'homepage', $data, 'url'); ?>
<?php cf_section_close(); ?>

<?php endif; // end CCMPS_AUX_MODULE ?>

<!-- ============================================================
     Sticky-panel toggle script — same pattern already used
     for the Membership Vitals accordion on the landing page.
     Handles every .faq-question link on this page, no matter
     how many sections you add later.
     ============================================================ -->
<script>
function initFaqAccordionAndCountyFilter() {
    var triggers = document.querySelectorAll('.faq-question');
    triggers.forEach(function(trigger) {
        if (trigger.dataset.faqBound) return; // already wired up — skip if this ever runs twice
        trigger.dataset.faqBound = '1';

        var targetId = trigger.getAttribute('href');
        var panel = document.querySelector(targetId);
        if (panel) {
            trigger.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                panel.classList.toggle('show');
            });
        }
    });

    // Cascading state -> county filter. Each county <option> carries
    // data-filter="<state_code>" (from ref_counties.state). When a
    // state dropdown changes, hide county options that don't belong
    // to that state, and clear the county selection if it no longer
    // matches (so a stale county from a previous state can't get saved).
    var stateSelects = document.querySelectorAll('.form-control[data-county-target]');
    stateSelects.forEach(function(stateSelect) {
        var countySelect = document.getElementById(stateSelect.getAttribute('data-county-target'));
        if (!countySelect) return;

        function filterCounties() {
            var selectedState = stateSelect.value;
            var options = countySelect.querySelectorAll('option');
            options.forEach(function(option) {
                if (!option.value) return; // keep the blank "-- Select --" option always visible
                var matches = !selectedState || option.getAttribute('data-filter') === selectedState;
                option.hidden = !matches;
            });
            // If the currently selected county doesn't belong to the newly chosen state, clear it
            var current = countySelect.options[countySelect.selectedIndex];
            if (current && current.value && current.hidden) {
                countySelect.value = '';
            }
        }

        stateSelect.addEventListener('change', filterCounties);
        filterCounties(); // run once on load so it's correctly filtered for the existing saved state
    });
}

// DOMContentLoaded only fires once, and won't fire again if the browser
// restores this page from its back-forward cache (bfcache) after
// navigating away and back — which would leave this script never running
// at all. Checking document.readyState covers that case: if the DOM is
// already parsed by the time this line runs, initialize immediately
// instead of waiting for an event that has already happened.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFaqAccordionAndCountyFilter);
} else {
    initFaqAccordionAndCountyFilter();
}

// Belt-and-suspenders for the bfcache case specifically: if the browser
// restores this exact page from back/forward navigation, `pageshow`
// fires with event.persisted === true. The idempotency guard above
// means calling this again here is always safe, even if it already ran.
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        initFaqAccordionAndCountyFilter();
    }
});
</script>
