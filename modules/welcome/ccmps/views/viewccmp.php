<?php
  include('navbar.php');

  // Same permission model as ccmpcrudcontact.php — kept in sync deliberately.
  $is_admin = !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);
  // Recognizes either the module-scoped flag (ccmps.system_admin, this
  // module only) or the future enterprise-wide flag (unprefixed, set by
  // honcho once built, across every module). Safe today even though
  // honcho isn't wired up yet.
  $is_system_admin = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);

  // VIP: visible only to system_admin, subentity_admin, or ccmp_admin — excludes student_admin.
  $is_vip_admin = $is_system_admin || !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']);

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
      || !empty($_SESSION['ccmps_ccmp_admin'])
      || (($is_chapter_president || !empty($_SESSION['ccmps_subentity_admin'])) && $is_own_chapter);

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
      // Buffers this section's content rather than echoing it immediately.
      // The tab <li> link is recorded right away; the actual .tab-pane
      // markup gets assembled once vf_section_close() captures the
      // buffered content, and everything is printed together at the end
      // via vf_tabs_render() — Bootstrap tabs need every <li> to exist
      // inside one <ul>, and every pane inside one .tab-content wrapper,
      // which isn't possible if we echo section-by-section as we go.
      function vf_section_open($id, $title, $icon = 'fa-folder-open', $active = false) {
          $activeClass = $active ? ' active' : '';
          $GLOBALS['vf_tab_links'][] = '<li><a class="nav-link' . $activeClass . '" data-toggle="tab" href="#' . $id . '"><i class="fa ' . $icon . '"></i> ' . htmlspecialchars($title) . '</a></li>';
          $GLOBALS['vf_tab_current_id'] = $id;
          $GLOBALS['vf_tab_current_active'] = $active;
          ob_start();
      }
  }

  if (!function_exists('vf_section_close')) {
      function vf_section_close() {
          $content = ob_get_clean();
          $id = $GLOBALS['vf_tab_current_id'];
          $activeClass = !empty($GLOBALS['vf_tab_current_active']) ? ' active' : '';
          $GLOBALS['vf_tab_panes'][] = '<div id="' . $id . '" class="tab-pane' . $activeClass . '"><div class="panel-body"><div class="row">' . $content . '</div></div></div>';
      }
  }

  if (!function_exists('vf_tabs_render')) {
      function vf_tabs_render() {
          $links = implode('', $GLOBALS['vf_tab_links'] ?? []);
          $panes = implode('', $GLOBALS['vf_tab_panes'] ?? []);
          echo '<div class="tabs-container">';
          echo '<ul class="nav nav-tabs">' . $links . '</ul>';
          echo '<div class="tab-content">' . $panes . '</div>';
          echo '</div>';
      }
  }

  $GLOBALS['vf_tab_links'] = [];
  $GLOBALS['vf_tab_panes'] = [];
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

                <div class="col-md-6">

                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">
                        <?= htmlspecialchars($data['salutation'] ?? '') ?> <?= htmlspecialchars($data['first_name'] ?? '') ?> <?= htmlspecialchars($data['middle_name'] ?? '') ?> <?= htmlspecialchars($data['last_name'] ?? '') ?> <?= htmlspecialchars($data['suffix'] ?? '') ?>
                    </span>
                     <h3 style="color:<?= CCMPS_CCMP_NAME_CLR ?>;"><?= $data['subentity'] ?> <?= SUBENTITY ?></h3>
                </div>

                <div class="col-md-5" style="white-space: nowrap; text-align: right;"> <!-- Update, Card and Close on one line -->
                    <br>
                    <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>">
                        <i class="fa fa-pencil"></i><span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Update</span>
                    </a>
                    <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?><?= $_SESSION['ccmpmode'] == 'ccmp' ? 'welcome-cards/mycard' : 'welcome-cards/card/'.$recid ?>?return=<?= rawurlencode(strtok(substr(current_url(), strlen(BASE_URL)), '?#')) ?>"> <!-- membership card (welcome-cards); Close comes back here -->
                        <i class="fa fa-qrcode"></i><span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Card</span>
                    </a>

                <?php if($_SESSION['ccmpmode'] == 'ccmp'): ?> <!-  coming from sidemenu of ccmphome page -->
                    <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                        <i class="fa fa-times-circle"></i><span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Close</span>
                    </a>
                <?php elseif (in_array($_SESSION['ccmpmode'], array('mngallccmps', 'mngdeleted'))): ?>  <!-  coming from the All Members list -->
                    <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/manage/<?= $_SESSION['ccmpmode'] ?>">
                        <i class="fa fa-times-circle"></i><span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Close</span>
                    </a>
                <?php elseif ($_SESSION['ccmpmode'] == 'mamv'): ?>  <!-  coming from manage page as a ccmp admin-->
                    <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/manage/ccmp_admin">
                        <i class="fa fa-times-circle"></i><span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Close</span>
                    </a>
                <?php else: ?>  <!-  coming from manage page as a subentity admin-->
                <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/manage/subentity_admin">
                    <i class="fa fa-times-circle"></i> <span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"> Close</span>
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
        vf_bool_row('Student', 'student', $data); // a flag only; not the Student member type
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

    <div class="col-md-12" style="margin-top: 25px;"><h4>Profession</h4><hr></div>
    <?php
        vf_row('Title', 'title', $data);
        vf_row('Employer', 'employer', $data);
        if (ccmp_field_shown('department')) { vf_row('Department', 'department', $data); } // System Settings > Member Fields
        if (ccmp_field_shown('reports_to')) { vf_row('Reports To', 'reports_to', $data); }
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
        vf_row(SUBENTITY, 'subentity', $data);
        vf_row(SUBENTITY.' Role', 'subentity_role', $data);
        vf_row('Current Year', 'current_year', $data);
        vf_row('Region', 'region', $data);
        vf_row('National Officer', 'national_officer', $data);
        if (ccmp_field_shown('leadsource')) { vf_row('Lead Source', 'leadsource', $data); } // System Settings > Member Fields
    ?>
    <?php
        vf_bool_row('Eligible Voter', 'eligible_voter', $data);
    ?>
<?php vf_section_close(); ?>

<?php if (defined('CCMPS_AUX_MODULE') && CCMPS_AUX_MODULE == 1): ?>
<!-- ============================================================
     PILOT CERTIFICATE & RATINGS  (ccmps_aux)
     ============================================================ -->
<?php vf_section_open('certificate', 'Certificates & Ratings', 'fa-plane'); ?>
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
        vf_bool_row(CCMP . ' Admin', 'ccmp_admin', $data);
        vf_bool_row('Content Admin', 'content_admin', $data);
        vf_bool_row('Event Admin', 'event_admin', $data);
        vf_bool_row('Financial Admin', 'financial_admin', $data);
    ?>
    <?php if ($can_grant_chapter_admin): ?>
        <?php vf_bool_row(SUBENTITY . ' Admin', 'subentity_admin', $data); ?>
    <?php endif; ?>
    <?php
        vf_bool_row('Locked', 'locked', $data);
        vf_bool_row('Inactive', 'inactive', $data);
        vf_bool_row('Approved', 'approved', $data);
    ?>
    <?php if ($is_system_admin || !empty($_SESSION['ccmps_subentity_admin'])): ?>
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

    <div class="col-md-12" style="margin-top: 25px;"><h4>Display Size</h4><hr></div>
    <?php
        vf_row('Tabs', 'tab_setting', $data);
        vf_row('Section Headers', 'header_setting', $data);
        vf_row('Field Labels', 'label_setting', $data);
        vf_row('Field Values', 'value_setting', $data);
        vf_row('Buttons', 'button_setting', $data);
    ?>
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

<!-- ============================================================
     ACCOUNT  (ccmps) — application/system-managed fields.
     num_logins/last_login/last_logout/ip_address: view-only for
     everyone with access to this page at all — the application
     itself sets these, no one edits them regardless of role.
     activate_code/reset_code: visible only to system_admin.
     ============================================================ -->
<?php vf_section_open('account', 'Account', 'fa-key'); ?>
    <?php
        vf_row('Number of Logins', 'num_logins', $data);
        vf_row('Last Login', 'last_login', $data);
        vf_row('Last Logout', 'last_logout', $data);
        vf_row('IP Address', 'ip_address', $data);
    ?>
    <?php if ($is_system_admin): ?>
        <?php
            vf_row('Activate Code', 'activate_code', $data);
            vf_row('Reset Code', 'reset_code', $data);
        ?>
    <?php endif; ?>
<?php vf_section_close(); ?>

<?php
    // All sections above only buffered their content — nothing has actually
    // been printed to the page yet. This assembles and prints the real
    // <ul class="nav nav-tabs"> + <div class="tab-content"> structure now
    // that every section (and every conditional skip) has been resolved.
    vf_tabs_render();
?>

<script>
// Explicit, version-agnostic tab switching — not relying on Bootstrap's
// native data-toggle="tab" handling. That was the original approach, but
// it silently does nothing if the page's actual Bootstrap build doesn't
// match the convention (e.g. Bootstrap 5 renamed this to data-bs-toggle;
// this page also loads htmx/Alpine.js, suggesting parts of the stack may
// be mixed/upgraded independently). This handles clicks directly instead,
// so it works regardless of which Bootstrap version is actually active.
// Same idempotency-guard pattern already used for the FAQ accordion
// elsewhere in this module, for the same underlying reason.
function initCcmpsTabs() {
    var container = document.querySelector('.tabs-container');
    if (!container) return;

    var links = container.querySelectorAll('.nav-tabs > li > a');
    links.forEach(function (link) {
        if (link.dataset.tabBound) return;
        link.dataset.tabBound = '1';

        link.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            var targetId = link.getAttribute('href');
            var targetPane = container.querySelector(targetId);
            if (!targetPane) return;

            container.querySelectorAll('.nav-tabs > li > a').forEach(function (l) {
                l.classList.remove('active');
            });
            container.querySelectorAll('.tab-pane').forEach(function (p) {
                p.classList.remove('active');
            });

            link.classList.add('active');
            targetPane.classList.add('active');
        });
    });
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCcmpsTabs);
} else {
    initCcmpsTabs();
}
window.addEventListener('pageshow', function (event) {
    if (event.persisted) initCcmpsTabs();
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
