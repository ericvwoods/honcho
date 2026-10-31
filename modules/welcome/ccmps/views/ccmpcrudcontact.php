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

function cf_textarea($label, $name, $data, $rows = 3, $extra = '') {
    echo '<div class="form-group col-md-12">';
    echo '<label>' . htmlspecialchars($label) . '</label>';
    echo '<textarea class="form-control" name="' . $name . '" rows="' . $rows . '" ' . $extra . '>' . cf_val($data, $name) . '</textarea>';
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
    echo '<div class="ibox ccmp-form-section">'; // ccmp-form-section: the member's font sizes apply here too (_with_fontsize_style, 2026-10-27)
    echo '<div class="ibox-title">';
    echo '<center><a href="#' . $id . '" class="faq-question"><i class="fa ' . $icon . '"></i> ' . htmlspecialchars($title) . ' <i class="fa fa-unsorted fa-1x"></i></a></center>';
    echo '</div>';
    echo '<div id="' . $id . '" class="' . $collapseClass . '">';
    echo '<div class="ibox-content"><div class="row">';
}

function cf_section_close() {
    echo '</div></div></div></div>'; // .row .ibox-content #id .ibox
}

// Renders one editable row for a ccmps_aircraft record. $index is the
// array index used in the field names (aircraft[$index][fieldname]),
// so the submit handler can tell rows apart and match them back to the
// right database row via the hidden id field. $ac is either a real
// ccmps_aircraft row object (existing aircraft) or null (a blank row
// for adding a new one) — own_rent defaults to checked/"Owned" for a
// new blank row, matching the database's own default of 1.
function cf_aircraft_row($index, $ac = null) {
    $id                  = $ac->id ?? '';
    $registration_number = $ac->registration_number ?? '';
    $make                = $ac->make ?? '';
    $model                = $ac->model ?? '';
    $hp                  = $ac->hp ?? '';
    $engines             = $ac->engines ?? '';
    $own_rent_checked    = $ac ? !empty($ac->own_rent) : true; // default new rows to "Owned"

    echo '<input type="hidden" name="aircraft[' . $index . '][id]" value="' . htmlspecialchars($id) . '">';

    echo '<div class="form-group col-md-3">';
    echo '<label>Registration Number</label>';
    echo '<input type="text" class="form-control" name="aircraft[' . $index . '][registration_number]" value="' . htmlspecialchars($registration_number) . '">';
    echo '</div>';

    echo '<div class="form-group col-md-2">';
    echo '<label>Make</label>';
    echo '<input type="text" class="form-control" name="aircraft[' . $index . '][make]" value="' . htmlspecialchars($make) . '">';
    echo '</div>';

    echo '<div class="form-group col-md-2">';
    echo '<label>Model</label>';
    echo '<input type="text" class="form-control" name="aircraft[' . $index . '][model]" value="' . htmlspecialchars($model) . '">';
    echo '</div>';

    echo '<div class="form-group col-md-1">';
    echo '<label>HP</label>';
    echo '<input type="number" class="form-control" name="aircraft[' . $index . '][hp]" value="' . htmlspecialchars($hp) . '">';
    echo '</div>';

    echo '<div class="form-group col-md-1">';
    echo '<label>Engines</label>';
    echo '<input type="number" class="form-control" name="aircraft[' . $index . '][engines]" value="' . htmlspecialchars($engines) . '">';
    echo '</div>';

    echo '<div class="form-group col-md-1">';
    echo '<label>Owned</label><br>';
    echo '<input type="checkbox" name="aircraft[' . $index . '][own_rent]" value="1" ' . ($own_rent_checked ? 'checked' : '') . '> Owned';
    echo '</div>';

    // Only existing records can be deleted — a blank "add new" row has
    // nothing in the database yet to delete.
    if ($ac) {
        echo '<div class="form-group col-md-2">';
        echo '<label>&nbsp;</label><br>';
        echo '<label style="color: #ed5565;"><input type="checkbox" name="aircraft[' . $index . '][delete]" value="1"> Delete this aircraft</label>';
        echo '</div>';
    }
}

// ---- Permission checks used throughout this form ----
// $is_admin: broader group (subentity/member/system admin) — can edit
//            membership, certificate, ratings, aircraft, extended prefs.
// $is_system_admin: narrower, system_admin only — can edit true system
//            flags (locked, approved, soft_deleted, etc.) and see Notes.
$is_admin = !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);
// Recognizes either the module-scoped flag (ccmps.system_admin, this module
// only) or the future enterprise-wide flag (unprefixed, set by honcho once
// built, across every module). Safe today even though honcho isn't wired up.
$is_system_admin = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);
$locked = $is_admin ? '' : 'disabled'; // append to $extra on any field that should be view-only for non-admins
$locked_system = $is_system_admin ? '' : 'disabled'; // for the 7 core system flags — visible to everyone, editable only by system_admin

// VIP: visible/editable only to system_admin, subentity_admin (Chapter Admin),
// or ccmp_admin — deliberately excludes student_admin, per explicit spec.
$is_vip_admin = $is_system_admin || !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']);

// Chapter-admin-granting exception: lets a chapter president promote another
// member of their own chapter to subentity_admin, without needing full
// system_admin access. "President" is looked up dynamically by matching
// the title on $ccmpsubentityroles (already loaded for the dropdown)
// against the viewer's own role — never hardcode the role id, since it can
// change independently of this code.
$is_chapter_president = false;
if (!empty($_SESSION['ccmps_subentity_role']) && !empty($ccmpsubentityroles)) {
    foreach ($ccmpsubentityroles as $role) {
        if (strcasecmp($role->title, 'President') === 0 && (string) $role->id === (string) $_SESSION['ccmps_subentity_role']) {
            $is_chapter_president = true;
            break;
        }
    }
}
// System-level roles (system_admin, ccmp_admin) can grant Chapter Admin to
// anyone, nationally. A chapter's own subentity_admin or president can only
// grant it to a fellow member of their own chapter — never to someone in a
// different chapter, even if they somehow reach that member's edit page.
$is_own_chapter = !empty($_SESSION['ccmps_subentity']) && !empty($data['subentity']) && (string) $_SESSION['ccmps_subentity'] === (string) $data['subentity'];
$can_grant_chapter_admin = $is_system_admin
    || !empty($_SESSION['ccmps_ccmp_admin'])
    || (($is_chapter_president || !empty($_SESSION['ccmps_subentity_admin'])) && $is_own_chapter);
?>

<!-- ============================================================
     PERSONAL & CONTACT INFORMATION  (ccmps)
     ============================================================ -->
<?php cf_section_open('personal', 'Contact Information', 'fa-phone', true); ?>

    <div class="col-md-12"><h4>Personal Information</h4><hr></div>
    <?php
        cf_select('Salutation', 'salutation', $data, $salutations, 'id', 'title');
        cf_text('First Name', 'first_name', $data);
        cf_text('Middle Name', 'middle_name', $data);
        cf_text('Last Name', 'last_name', $data);
        cf_text('Suffix', 'suffix', $data);
        cf_select('Gender', 'gender', $data, $genders, 'id', 'description');
        cf_text('Birthday', 'birthday', $data, 'text', 'placeholder="MM/DD/YYYY"');
    ?>
    <?php
        // dob is stored as a unix timestamp (integer), but an <input type="date">
        // needs its value in YYYY-MM-DD format — convert here for display.
        // Distinct from `birthday` above: birthday is a freehand varchar (someone
        // can enter just a month/day if they don't want to disclose their age),
        // while dob is the actual full date when it's known/willing to be shared.
        $dob_display = !empty($data['dob']) ? date('Y-m-d', $data['dob']) : '';
    ?>
    <div class="form-group col-md-4">
        <label>Date of Birth</label>
        <input type="date" class="form-control" name="dob" value="<?= htmlspecialchars($dob_display) ?>">
    </div>
    <div class="form-group col-md-4" style="display: flex; flex-wrap: wrap; gap: 4px 18px; padding-top: 26px;"> <!-- the row's last third; Active Duty and Former Military always together -->
        <label><input type="checkbox" name="minor" value="1" <?= !empty($data['minor']) ? 'checked' : '' ?>> Minor</label>
        <label><input type="checkbox" name="student" value="1" <?= !empty($data['student']) ? 'checked' : '' ?> <?= $locked ?>> Student</label> <!-- admins only ($locked); not the Student member type -->
        <?php if ($is_vip_admin): ?>
        <label><input type="checkbox" name="vip" value="1" <?= !empty($data['vip']) ? 'checked' : '' ?>> VIP</label>
        <?php endif; ?>
        <span style="white-space: nowrap;">
            <label style="margin-right: 18px;"><input type="checkbox" name="active_duty" value="1" <?= !empty($data['active_duty']) ? 'checked' : '' ?>> Active Duty</label>
            <label><input type="checkbox" name="former_military" value="1" <?= !empty($data['former_military']) ? 'checked' : '' ?>> Former Military</label>
        </span>
        <?php if ($is_admin): ?> <!-- Deceased: moved here from Admin Notes 2026-10-27; still admins only (the save ignores it from members) -->
        <label><input type="checkbox" name="deceased" value="1" <?= !empty($data['deceased']) ? 'checked' : '' ?>> Deceased</label>
        <?php endif; ?>
    </div>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Contact Information</h4><hr></div>
    <?php
        cf_text('Email Address', 'email_address', $data, 'email');
        cf_text('Phone', 'phone', $data);
        cf_text('Mobile', 'mobile', $data);
        cf_text('Fax', 'fax', $data);
        cf_text('Website', 'website', $data, 'url');
        cf_text('Profile URL', 'url_string', $data);
        cf_text('Alternate Contact', 'alternate_contact', $data);
        cf_text('Alternate Phone', 'alternate_phone', $data);
        cf_text('Alternate Email', 'alternate_email', $data, 'email');
    ?>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Emergency Contact</h4><hr></div>
    <?php
        cf_text('Emergency Contact Name', 'emergency_contact', $data);
        cf_text('Emergency Phone', 'emergency_phone', $data);
        cf_text('Emergency Email', 'emergency_email', $data, 'email');
    ?>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Profession</h4><hr></div>
    <?php
        cf_text('Title', 'title', $data);
        cf_text('Employer', 'employer', $data);
        // Shown or hidden on System Settings > Member Fields. A hidden field isn't on the
        // form, and extract_text() skips fields that aren't posted, so its value is kept.
        if (ccmp_field_shown('department')) { cf_text('Department', 'department', $data); }
        if (ccmp_field_shown('reports_to')) { cf_text('Reports To', 'reports_to', $data); }
    ?>

<?php cf_section_close(); ?>

<!-- ============================================================
     ADDRESSES  (ccmps_addresses)
     ============================================================ -->
<?php cf_section_open('addresses', 'Addresses', 'fa-map', true); ?>

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
        cf_text('Member Number', 'ccmp_number', $data, 'text', $locked);
        cf_select('Member Type', 'ccmp_type', $data, $ccmptypes, 'id', 'ccmp_type', 'description', $locked);
        cf_select(SUBENTITY, 'subentity', $data, $subentities, 'id', 'description', null, $locked.' id="subentity" data-family-target="family_member_id"');
        cf_select(SUBENTITY.' Role', 'subentity_role', $data, $ccmpsubentityroles, 'id', 'title', null, $locked);
        cf_select('Family Member', 'family_member_id', $data, $family_members ?? array(), 'id', 'name', null, $locked.' id="family_member_id"', 'subentity'); // one member of the same chapter who is family (2026-10-31)
        cf_text('Current Year', 'current_year', $data, 'number', $locked);
        cf_select('Region', 'region', $data, $regions, 'id', 'description', null, $locked);
        cf_select('National Officer', 'national_officer', $data, $national_offices, 'id', 'description', null, $locked);
        if (ccmp_field_shown('leadsource')) { cf_select('Lead Source', 'leadsource', $data, $leadsources, 'id', 'title', 'referrer', $locked); } // System Settings > Member Fields
    ?>
    <!-- Student moved next to Minor (Personal Information) 2026-10-27 -->
    <div class="form-group col-md-2"><label><input type="checkbox" name="eligible_voter" value="1" <?= !empty($data['eligible_voter']) ? 'checked' : '' ?> <?= $locked ?>> Eligible Voter</label></div>
<?php cf_section_close(); ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>
<!-- ============================================================
     PILOT CERTIFICATE & RATINGS  (ccmps_aux)
     ============================================================ -->
<?php cf_section_open('certificate', 'Certificates & Ratings', 'fa-plane'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="hall_of_fame" value="1" <?= !empty($data['hall_of_fame']) ? 'checked' : '' ?> <?= $locked ?>> Hall of Fame</label></div>
    <?php
        cf_text('Call Sign', 'call_sign', $data, 'text');
    ?>
    <div class="form-group col-md-2">
        <label><input type="checkbox" name="aircraft_owner" value="1" <?= !empty($data['aircraft_owner']) ? 'checked' : '' ?>> Aircraft Owner</label>
    </div>
    <?php
        cf_text('Total Flight Time (hrs)', 'total_time', $data, 'number');
        cf_text('Highest Certificate', 'highest_certificate', $data, 'number');
        cf_text('Certificate Number', 'certificate_number', $data, 'text');
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
        cf_text('Other Crewmember', 'other_crewmember', $data, 'text');
        cf_text('OCM Cert #', 'ocm_certnum', $data, 'text');
        cf_text('Other FAA Cert', 'other_faa_cert', $data, 'text');
        cf_text('OFC Cert #', 'ofc_certnum', $data, 'text');
    ?>

    <div class="col-md-12"><h4>Ratings &amp; Categories</h4><hr></div>
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
    <?php cf_text('A&P Number', 'ap_number', $data, 'text'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="ia" value="1" <?= !empty($data['ia']) ? 'checked' : '' ?>> IA</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="military_maint" value="1" <?= !empty($data['military_maint']) ? 'checked' : '' ?>> Military Maintenance</label></div>
    <?php cf_text('Maintenance Notes', 'maintenance', $data, 'text'); ?>

    <?php cf_textarea('Credential Notes', 'cred_notes', $data, 3); ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     AIRCRAFT  (ccmps_aircraft) — one member can own/rent multiple
     aircraft; each is its own row in a separate table, not a single
     flat field on ccmps_aux like the old aircraft_type/mmhp/reg
     fields were (those are gone — replaced by this).
     ============================================================ -->
<?php cf_section_open('aircraft', 'Aircraft', 'fa-fighter-jet'); ?>
    <?php
        $aircraft_records = $data['aircraft_records'] ?? [];
        $aircraft_index = 0;
        foreach ($aircraft_records as $ac):
    ?>
    <div class="col-md-12"><h4>Aircraft <?= $aircraft_index + 1 ?></h4><hr></div>
    <?php cf_aircraft_row($aircraft_index, $ac); ?>
    <?php
        $aircraft_index++;
        endforeach;
    ?>

    <?php for ($i = 0; $i < 2; $i++): ?>
    <div class="col-md-12"><h4>Add Aircraft</h4><hr></div>
    <?php cf_aircraft_row($aircraft_index, null); ?>
    <?php $aircraft_index++; endfor; ?>
<?php cf_section_close(); ?>
<?php endif; ?>


<!-- ============================================================
     ROLES & PERMISSIONS  (ccmps)
     ============================================================ -->
<?php cf_section_open('roles', 'Roles & Permissions', 'fa-shield'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="system_admin" value="1" <?= !empty($data['system_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> System Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="student_admin" value="1" <?= !empty($data['student_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> Student Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="ccmp_admin" value="1" <?= !empty($data['ccmp_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> <?= CCMP ?> Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="content_admin" value="1" <?= !empty($data['content_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> Content Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="event_admin" value="1" <?= !empty($data['event_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> Event Admin</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="financial_admin" value="1" <?= !empty($data['financial_admin']) ? 'checked' : '' ?> <?= $locked_system ?>> Financial Admin</label></div>
    <?php if ($can_grant_chapter_admin): ?> <!-- not $locked_system: chapter presidents may grant it too -->
    <div class="form-group col-md-2"><label><input type="checkbox" name="subentity_admin" value="1" <?= !empty($data['subentity_admin']) ? 'checked' : '' ?>> <?= SUBENTITY ?> Admin</label></div>
    <?php endif; ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="locked" value="1" <?= !empty($data['locked']) ? 'checked' : '' ?> <?= $locked_system ?>> Locked</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="inactive" value="1" <?= !empty($data['inactive']) ? 'checked' : '' ?> <?= $locked_system ?>> Inactive</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="approved" value="1" <?= !empty($data['approved']) ? 'checked' : '' ?> <?= $locked_system ?>> Approved</label></div>
    <?php if ($is_system_admin || !empty($_SESSION['ccmps_subentity_admin'])): ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="soft_deleted" value="1" <?= !empty($data['soft_deleted']) ? 'checked' : '' ?> <?= $locked_system ?>> Soft Deleted</label></div>
    <?php endif; ?>
<?php cf_section_close(); ?>

<!-- ============================================================
     PREFERENCES  (ccmps)
     ============================================================ -->
<?php cf_section_open('preferences', 'Preferences', 'fa-cog'); ?>
    <?php cf_select('Preferred Language', 'language', $data, $languages, 'id', 'title'); ?>
    <div class="form-group col-md-2"><label><input type="checkbox" name="donotcall" value="1" <?= !empty($data['donotcall']) ? 'checked' : '' ?>> Do Not Call</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="emailoptout" value="1" <?= !empty($data['emailoptout']) ? 'checked' : '' ?>> Email Opt Out</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="directoryoptout" value="1" <?= !empty($data['directoryoptout']) ? 'checked' : '' ?>> Directory Opt Out</label></div>
    <div class="form-group col-md-2"><label><input type="checkbox" name="mail_notices" value="1" <?= !empty($data['mail_notices']) ? 'checked' : '' ?>> Mail Notices</label></div>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Display Size</h4><hr></div>
    <?php
        // Each dropdown is filtered to its own element type from the same
        // $ccmps_settings lookup array (all 15 rows), populated by
        // updateccmp() into 5 pre-filtered variables — see Ccmps.php.
        cf_select('Tabs', 'tab_setting', $data, $tab_settings, 'id', 'description');
        cf_select('Section Headers', 'header_setting', $data, $header_settings, 'id', 'description');
        cf_select('Field Labels', 'label_setting', $data, $label_settings, 'id', 'description');
        cf_select('Field Values', 'value_setting', $data, $value_settings, 'id', 'description');
        cf_select('Buttons', 'button_setting', $data, $button_settings, 'id', 'description');
    ?>
<?php cf_section_close(); ?>
<?php if ($is_admin): ?>
<!-- ============================================================
     ADMIN NOTES  (ccmps) — visible only to subentity/member/system admins
     ============================================================ -->
<?php cf_section_open('notes', 'Admin Notes', 'fa-sticky-note'); ?>
    <!-- Deceased moved to Personal Information, next to Former Military (2026-10-27) -->
    <?php cf_textarea('Notes', 'notes', $data, 5); ?>
<?php cf_section_close(); ?>
<?php endif; ?>

<!-- ============================================================
     ACCOUNT  (ccmps) — activate_code/reset_code, editable only by
     system_admin. Fully hidden for everyone else, same treatment
     as Admin Notes above.
     ============================================================ -->
<?php if ($is_system_admin): ?>
<?php cf_section_open('account', 'Account', 'fa-key'); ?>
    <?php
        cf_text('Activate Code', 'activate_code', $data);
        cf_text('Reset Code', 'reset_code', $data);
    ?>
<?php cf_section_close(); ?>
<?php endif; ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>
<!-- ============================================================
     ============  BEGIN CCMPS_AUX EXTENSION FIELDS  ============
     Everything from here to the end of this file lives in
     ccmps_aux, not ccmps or ccmps_addresses. A baseline deployment
     without this table can skip this whole block by leaving
     CCMPS_AUX_MODULE undefined or set to 0.
     ============================================================ -->

<!-- Additional Roles section removed — chapter_admin merged into subentity_admin,
     content_mgr renamed/moved to ccmps.content_admin, event_admin moved to
     ccmps (both now shown in Roles & Permissions above), unverified deleted. -->

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

    // Same idea for Family Member: only members of the chosen chapter are offered
    // (each option's data-filter is that member's chapter id). Changing the chapter
    // clears a family member from another chapter; ccmpsubmit() checks it again.
    var chapterSelect = document.querySelector('.form-control[data-family-target]');
    var familySelect = chapterSelect ? document.getElementById(chapterSelect.getAttribute('data-family-target')) : null;
    if (familySelect) {
        var filterFamily = function() {
            familySelect.querySelectorAll('option').forEach(function(option) {
                if (!option.value) return;
                option.hidden = option.getAttribute('data-filter') !== chapterSelect.value;
            });
            var current = familySelect.options[familySelect.selectedIndex];
            if (current && current.value && current.hidden) {
                familySelect.value = '';
            }
        };
        chapterSelect.addEventListener('change', filterFamily);
        filterFamily();
    }
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
