<?php
  include('navbar.php');

  // Same permission model as ccmpcrudcontact.php — kept in sync deliberately.
  $is_admin = !empty($_SESSION['subentity_admin']) || !empty($_SESSION['ccmp_admin']) || !empty($_SESSION['system_admin']);
  $is_system_admin = !empty($_SESSION['system_admin']);

  // VIP: visible only to system_admin, subentity_admin, or ccmp_admin — excludes student_admin.
  $is_vip_admin = $is_system_admin || !empty($_SESSION['subentity_admin']) || !empty($_SESSION['ccmp_admin']);

  // Chapter-admin visibility exception, mirrored from ccmpcrudcontact.php.
  // Note: this defaults to false unless the controller also passes
  // $ccmpsubentityroles into this view (same array updateccmp() already
  // loads for the edit form's dropdown) — without it, a chapter president
  // simply won't see this exception here, though system_admin/existing
  // subentity_admin still will via the other two conditions.
  $is_chapter_president = false;
  if (!empty($_SESSION['ccmps_subentity_role']) && !empty($ccmpsubentityroles)) {
      foreach ($ccmpsubentityroles as $role) {
          if (strcasecmp($role->title, 'President') === 0 && (string) $role->id === (string) $_SESSION['ccmps_subentity_role']) {
              $is_chapter_president = true;
              break;
          }
      }
  }
  $is_own_chapter = !empty($_SESSION['ccmps_subentity']) && !empty($data['subentity_id']) && (string) $_SESSION['ccmps_subentity'] === (string) $data['subentity_id'];
  $can_grant_chapter_admin = $is_system_admin
      || !empty($_SESSION['ccmp_admin'])
      || (($is_chapter_president || !empty($_SESSION['subentity_admin'])) && $is_own_chapter);

  if (!function_exists('vf_row')) {
      function vf_row($label, $name, $data) {
          $value = $data[$name] ?? '';
          echo '<div class="form-group col-md-4">';
          echo '<label>' . htmlspecialchars($label) . '</label>';
          echo '<div class="form-control-static">' . (strlen((string) $value) ? htmlspecialchars($value) : '<span class="text-muted">&mdash;</span>') . '</div>';
          echo '</div>';
      }
  }

  if (!function_exists('vf_bool_row')) {
      function vf_bool_row($label, $name, $data) {
          $checked = !empty($data[$name]);
          echo '<div class="form-group col-md-2">';
          echo '<label>' . htmlspecialchars($label) . '</label>';
          echo '<div class="form-control-static"><i class="fa ' . ($checked ? 'fa-check-square-o text-navy' : 'fa-square-o text-muted') . '"></i></div>';
          echo '</div>';
      }
  }

  if (!function_exists('vf_section_open')) {
      function vf_section_open($id, $title, $icon = 'fa-folder-open', $open = false) {
          $collapseClass = $open ? 'panel-collapse collapse show' : 'panel-collapse collapse';
          echo '<div class="ibox">';
          echo '<div class="ibox-title">';
          echo '<center><a href="#' . $id . '" class="faq-question"><i class="fa ' . $icon . '"></i> ' . htmlspecialchars($title) . ' <i class="fa fa-unsorted fa-1x"></i></a></center>';
          echo '</div>';
          echo '<div id="' . $id . '" class="' . $collapseClass . '">';
          echo '<div class="ibox-content"><div class="row">';
      }
  }

  if (!function_exists('vf_section_close')) {
      function vf_section_close() {
          echo '</div></div></div></div>';
      }
  }
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">

                <?php if (!empty($data['picture'])): ?>
                    <div class="col-md-1">
                        <center>
                            <img alt="<?= htmlspecialchars(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')) ?>"
                                 src="<?= BASE_URL ?>welcome-ccmps_module/assets/<?= $recid ?>/<?= $data['picture'] ?>"
                                 style="border-radius: 6px; width: 90px; height: 90px; object-fit: cover;">
                        </center>

                    </div>
                <?php else: ?>
                    <div class="col-md-1">
                        <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                    </div>

                <?php endif; ?>

                <div class="col-md-9">
                    <br>
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">
                        <?= htmlspecialchars($data['salutation'] ?? '') ?> <?= htmlspecialchars($data['first_name'] ?? '') ?> <?= htmlspecialchars($data['middle_name'] ?? '') ?> <?= htmlspecialchars($data['last_name'] ?? '') ?> <?= htmlspecialchars($data['suffix'] ?? '') ?>
                    </span>
                     <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>;"><?= $data['subentity'] ?> Chapter</span>
                </div>

                <div class="col-md-2">
                    <br><br>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>">
                        <i class="fa fa-pencil"></i> Update
                    </a>

                <?php if($_SESSION['ccmpmode'] == 'viewmydata'): ?> <!-  coming from sidemenu of ccmphome page -->
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                        <i class="fa fa-times-circle"></i> Close
                    </a>
                <?php else: ?>  <!-  coming from manage page as a subentity admin-->
                <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>welcome-ccmps/manage/mngsubentity">
                    <i class="fa fa-times-circle"></i> Close
                </a>
                <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<br>

<!-- ============================================================
     CONTACT INFORMATION  (ccmps)
     ============================================================ -->
<?php vf_section_open('personal', 'Contact Information', 'fa-phone', true); ?>

    <div class="col-md-12"><h4>Personal Information</h4><hr></div>
    <?php
        vf_row('Salutation', 'salutation', $data);
        vf_row('First Name', 'first_name', $data);
        vf_row('Middle Name', 'middle_name', $data);
        vf_row('Last Name', 'last_name', $data);
        vf_row('Suffix', 'suffix', $data);
        vf_row('Gender', 'gender', $data);
        vf_row('Birthday', 'birthday', $data);
        vf_row('Date of Birth', 'dob', $data);
    ?>
    <?php
        vf_bool_row('Minor', 'minor', $data);
    ?>
    <?php if ($is_vip_admin): ?>
        <?php vf_bool_row('VIP', 'vip', $data); ?>
    <?php endif; ?>
    <?php
        vf_bool_row('Active Duty', 'active_duty', $data);
        vf_bool_row('Former Military', 'former_military', $data);
    ?>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Contact Information</h4><hr></div>
    <?php
        vf_row('Email Address', 'email_address', $data);
        vf_row('Phone', 'phone', $data);
        vf_row('Mobile', 'mobile', $data);
        vf_row('Fax', 'fax', $data);
        vf_row('Website', 'website', $data);
        vf_row('Profile URL', 'url_string', $data);
        vf_row('Alternate Contact', 'alternate_contact', $data);
        vf_row('Alternate Phone', 'alternate_phone', $data);
        vf_row('Alternate Email', 'alternate_email', $data);
    ?>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Emergency Contact</h4><hr></div>
    <?php
        vf_row('Emergency Contact Name', 'emergency_contact', $data);
        vf_row('Emergency Phone', 'emergency_phone', $data);
        vf_row('Emergency Email', 'emergency_email', $data);
    ?>

    <div class="col-md-12" style="margin-top: 25px;"><h4>Employment</h4><hr></div>
    <?php
        vf_row('Employer', 'employer', $data);
        vf_row('Title', 'title', $data);
        vf_row('Department', 'department', $data);
        vf_row('Reports To', 'reports_to', $data);
    ?>

<?php vf_section_close(); ?>

<!-- ============================================================
     ADDRESSES  (ccmps_addresses)
     ============================================================ -->
<?php vf_section_open('addresses', 'Addresses', 'fa-map'); ?>

    <div class="col-md-12"><h4>Mailing Address</h4><hr></div>
    <?php
        vf_row('Address 1', 'mailaddress1', $data);
        vf_row('Address 2', 'mailaddress2', $data);
        vf_row('City', 'mailcity', $data);
        vf_row('State', 'mailstate', $data);
        vf_row('Zip', 'mailzip', $data);
        vf_row('County', 'mailcounty', $data);
        vf_row('Country', 'mailcountry', $data);
    ?>

    <div class="col-md-12"><h4>Physical Address</h4><hr></div>
    <?php vf_bool_row('Same as mailing', 'mail_phys', $data); ?>
    <?php
        vf_row('Address 1', 'physaddress1', $data);
        vf_row('Address 2', 'physaddress2', $data);
        vf_row('City', 'physcity', $data);
        vf_row('State', 'physstate', $data);
        vf_row('Zip', 'physzip', $data);
        vf_row('County', 'physcounty', $data);
        vf_row('Country', 'physcountry', $data);
    ?>

    <div class="col-md-12"><h4>Billing Address</h4><hr></div>
    <?php
        vf_row('Bill To Name', 'billname', $data);
        vf_row('Billing Phone', 'billphone', $data);
        vf_row('Address 1', 'billaddress1', $data);
        vf_row('Address 2', 'billaddress2', $data);
        vf_row('City', 'billcity', $data);
        vf_row('State', 'billstate', $data);
        vf_row('Zip', 'billzip', $data);
        vf_row('County', 'billcounty', $data);
        vf_row('Country', 'billcountry', $data);
    ?>

    <div class="col-md-12"><h4>Shipping Address</h4><hr></div>
    <?php vf_bool_row('Same as billing', 'bill_ship', $data); ?>
    <?php
        vf_row('Ship To Name', 'shipname', $data);
        vf_row('Shipping Phone', 'shipphone', $data);
        vf_row('Address 1', 'shipaddress1', $data);
        vf_row('Address 2', 'shipaddress2', $data);
        vf_row('City', 'shipcity', $data);
        vf_row('State', 'shipstate', $data);
        vf_row('Zip', 'shipzip', $data);
        vf_row('County', 'shipcounty', $data);
        vf_row('Country', 'shipcountry', $data);
    ?>

<?php vf_section_close(); ?>

<!-- ============================================================
     MEMBERSHIP  (ccmps) — visible to everyone, edit still admin-gated
     ============================================================ -->
<?php vf_section_open('membership', 'Membership', 'fa-id-card'); ?>
    <?php
        vf_row('Member Number', 'ccmp_number', $data);
        vf_row('Member Type', 'ccmp_type', $data);
        vf_row('Chapter', 'subentity', $data);
        vf_row('Chapter Role', 'subentity_role', $data);
        vf_row('Current Year', 'current_year', $data);
        vf_row('Region', 'region', $data);
        vf_row('National Officer', 'national_officer', $data);
        vf_row('Lead Source', 'leadsource', $data);
    ?>
    <?php
        vf_bool_row('Student', 'student', $data);
        vf_bool_row('Eligible Voter', 'eligible_voter', $data);
    ?>
<?php vf_section_close(); ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>
<!-- ============================================================
     PILOT CERTIFICATE & RATINGS  (ccmps_aux)
     ============================================================ -->
<?php vf_section_open('certificate', 'Pilot Certificate & Ratings', 'fa-plane'); ?>
    <?php vf_bool_row('Hall of Fame', 'hall_of_fame', $data); ?>
    <?php
        vf_row('Call Sign', 'call_sign', $data);
    ?>
    <?php vf_bool_row('Aircraft Owner', 'aircraft_owner', $data); ?>
    <?php
        vf_row('Total Flight Time (hrs)', 'total_time', $data);
        vf_row('Highest Certificate', 'highest_certificate', $data);
        vf_row('Certificate Number', 'certificate_number', $data);
    ?>
    <?php
        vf_bool_row('Military Pilot', 'military_pilot', $data);
        vf_bool_row('Private', 'private', $data);
        vf_bool_row('Commercial', 'commercial', $data);
        vf_bool_row('ATP', 'atp', $data);
        vf_bool_row('CFI', 'cfi', $data);
        vf_bool_row('CFII', 'cfii', $data);
        vf_bool_row('MEI', 'mei', $data);
        vf_bool_row('DPE', 'dpe', $data);
        vf_bool_row('BGI', 'bgi', $data);
        vf_bool_row('AGI', 'agi', $data);
        vf_bool_row('Dispatcher', 'dispatcher', $data);
    ?>
    <?php
        vf_row('Other Crewmember', 'other_crewmember', $data);
        vf_row('OCM Cert #', 'ocm_certnum', $data);
        vf_row('Other FAA Cert', 'other_faa_cert', $data);
        vf_row('OFC Cert #', 'ofc_certnum', $data);
    ?>

    <div class="col-md-12"><h4>Ratings &amp; Categories</h4><hr></div>
    <?php
        vf_bool_row('SE Land', 'se_land', $data);
        vf_bool_row('ME Land', 'me_land', $data);
        vf_bool_row('SE Sea', 'se_sea', $data);
        vf_bool_row('ME Sea', 'me_sea', $data);
        vf_bool_row('Instrument', 'instrument', $data);
        vf_bool_row('Rotorcraft', 'rotocraft', $data);
        vf_bool_row('Glider', 'glider', $data);
        vf_bool_row('Balloon', 'balloon', $data);
        vf_bool_row('Drone', 'drone', $data);
        vf_bool_row('Airship', 'airship', $data);
        vf_bool_row('ATC', 'atc', $data);
        vf_bool_row('A&P', 'ap', $data);
    ?>
    <?php vf_row('A&P Number', 'ap_number', $data); ?>
    <?php
        vf_bool_row('IA', 'ia', $data);
        vf_bool_row('Military Maintenance', 'military_maint', $data);
    ?>
    <?php vf_row('Maintenance Notes', 'maintenance', $data); ?>
    <div class="form-group col-md-12">
        <label>Credential Notes</label>
        <div class="form-control-static"><?= nl2br(htmlspecialchars($data['cred_notes'] ?? '')) ?></div>
    </div>
<?php vf_section_close(); ?>

<!-- ============================================================
     AIRCRAFT  (ccmps_aircraft) — one member can own/rent multiple
     aircraft; each is its own row in a separate table.
     ============================================================ -->
<?php vf_section_open('aircraft', 'Aircraft', 'fa-fighter-jet'); ?>
    <?php $aircraft_records = $data['aircraft_records'] ?? []; ?>
    <?php if (empty($aircraft_records)): ?>
        <div class="col-md-12"><em class="text-muted">No aircraft on file.</em></div>
    <?php else: ?>
        <?php foreach ($aircraft_records as $i => $ac): ?>
            <div class="col-md-12"><h4>Aircraft <?= $i + 1 ?></h4><hr></div>
            <?php
                vf_row('Registration Number', 'registration_number', (array) $ac);
                vf_row('Make', 'make', (array) $ac);
                vf_row('Model', 'model', (array) $ac);
                vf_row('HP', 'hp', (array) $ac);
                vf_row('Engines', 'engines', (array) $ac);
                vf_bool_row('Owned', 'own_rent', (array) $ac);
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php vf_section_close(); ?>
<?php endif; ?>


<!-- ============================================================
     ROLES & PERMISSIONS  (ccmps) — the 7 true system flags stay
     hidden from non-system-admins even in view mode.
     ============================================================ -->
<?php vf_section_open('roles', 'Roles & Permissions', 'fa-shield'); ?>
    <?php
        vf_bool_row('System Admin', 'system_admin', $data);
        vf_bool_row('Student Admin', 'student_admin', $data);
        vf_bool_row('CCMP Admin', 'ccmp_admin', $data);
        vf_bool_row('Locked', 'locked', $data);
        vf_bool_row('Inactive', 'inactive', $data);
        vf_bool_row('Approved', 'approved', $data);
    ?>
    <?php if ($is_system_admin || !empty($_SESSION['subentity_admin'])): ?>
        <?php vf_bool_row('Soft Deleted', 'soft_deleted', $data); ?>
    <?php endif; ?>
<?php vf_section_close(); ?>

<!-- ============================================================
     PREFERENCES  (ccmps)
     ============================================================ -->
<?php vf_section_open('preferences', 'Preferences', 'fa-cog'); ?>
    <?php vf_row('Preferred Language', 'language', $data); ?>
    <?php
        vf_bool_row('Do Not Call', 'donotcall', $data);
        vf_bool_row('Email Opt Out', 'emailoptout', $data);
        vf_bool_row('Directory Opt Out', 'directoryoptout', $data);
        vf_bool_row('Mail Notices', 'mail_notices', $data);
    ?>
    <?php if ($can_grant_chapter_admin): ?>
        <?php vf_bool_row('Chapter Admin', 'subentity_admin', $data); ?>
    <?php endif; ?>
<?php vf_section_close(); ?>

<?php if ($is_admin): ?>
<!-- ============================================================
     ADMIN NOTES  (ccmps) — visible only to subentity/member/system admins
     ============================================================ -->
<?php vf_section_open('notes', 'Admin Notes', 'fa-sticky-note'); ?>
    <?php vf_bool_row('Deceased', 'deceased', $data); ?>
    <div class="form-group col-md-12">
        <label>Notes</label>
        <div class="form-control-static"><?= nl2br(htmlspecialchars($data['notes'] ?? '')) ?></div>
    </div>
<?php vf_section_close(); ?>
<?php endif; ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>

<!-- Additional Roles section removed — chapter_admin merged into subentity_admin,
     content_mgr renamed/moved to ccmps.content_admin, event_admin moved to
     ccmps (both now shown in Roles & Permissions above), unverified deleted. -->

<?php endif; // end CCMPS_AUX_MODULE ?>

<!-- Same accordion toggle script as the edit form -->
<script>
function initFaqAccordion() {
    var triggers = document.querySelectorAll('.faq-question');
    triggers.forEach(function(trigger) {
        if (trigger.dataset.faqBound) return;
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
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFaqAccordion);
} else {
    initFaqAccordion();
}
window.addEventListener('pageshow', function(event) {
    if (event.persisted) initFaqAccordion();
});
</script>

<?php if (DEBUGGING == true): ?>
    <?php
        echo('<h3>View: welcome-ccmps/views/viewccmp</h3>');
        echo('<h3>$_SESSION</h3>');
        json($_SESSION);
        echo('<h3>$data</h3>');
        json($data);
    ?>
<?php endif; ?>
