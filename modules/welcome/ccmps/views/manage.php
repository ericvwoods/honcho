<?php
  include('navbar.php');

  // Looks up the real status title from ccmps_status (passed in from the
  // controller as $statuses) instead of assuming which numeric ids exist.
  // Color-coding is matched against the resulting text, not the id, so it
  // still works correctly if new status rows get added later.
  if (!function_exists('cf_status_label')) {
      function cf_status_label($status, $statuses) {
          $label = 'Unknown';
          foreach ($statuses as $row) {
              if ((string) $row->id === (string) $status) {
                  $label = $row->title;
                  break;
              }
          }

          $color = '#999'; // default/unknown
          if (stripos($label, 'current') !== false) {
              $color = '#1ab394';
          } elseif (stripos($label, 'past due') !== false) {
              $color = '#f8ac59';
          } elseif (stripos($label, 'expired') !== false) {
              $color = '#ed5565';
          }

          return '<span style="color: ' . $color . ';">' . htmlspecialchars($label) . '</span>';
      }
  }

  // Renders one member table — reused for every tab pane (and for the
  // single mngdeleted view) rather than duplicating this markup 5+ times.
  if (!function_exists('render_manage_table')) {
      function render_manage_table($records, $show_chapter_column, $statuses, $table_id) {
?>
                <div class="table-responsive">
                    <table id="<?= htmlspecialchars($table_id) ?>" class="table table-striped table-bordered table-hover manage-datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <?php if (!empty($show_chapter_column)): ?>
                                    <th><?= SUBENTITY ?></th>
                                <?php endif; ?>
                                <th>Location</th>
                                <th><?= CCMP ?> Number</th>
                                <th><?= CCMP ?> Type</th>
                                <th>Status</th>
                                <th>Current Year</th>
                                <th>Misc 1</th>
                                <th>Actions</th>
                                <th>
                                    Select <input type="checkbox" class="checkAll">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $row): ?>
                                <tr class="gradeA">
                                    <td><?= htmlspecialchars($row->last_name) ?> <?= htmlspecialchars($row->suffix) ?>, <?= htmlspecialchars($row->first_name) ?> <?= htmlspecialchars($row->middle_name) ?></td>
                                    <?php if (!empty($show_chapter_column)): ?>
                                        <td><?= htmlspecialchars($row->chapter_title ?? '') ?></td>
                                    <?php endif; ?>
                                    <td><?= htmlspecialchars($row->mailcity ?? '') ?>, <?= htmlspecialchars($row->mailstate ?? '') ?></td>
                                    <td><?= htmlspecialchars($row->ccmp_number ?? '') ?></td>
                                    <td><?= htmlspecialchars($row->ccmp_type_desc ?? '') ?></td>
                                    <td><?= cf_status_label($row->status, $statuses) ?></td>
                                    <td><?= htmlspecialchars($row->current_year ?? '') ?></td>
                                    <td><?= htmlspecialchars($row->misc1 ?? '') ?></td>
                                    <td>
                                        <a class="btn btn-outline btn-primary btn-xs" data-toggle="tooltip" title="View Record" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $row->id ?>/1">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a class="btn btn-outline btn-warning btn-xs" data-toggle="tooltip" title="Update Record" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $row->id ?>/1">
                                            <i class="fa fa-pencil"></i> Update
                                        </a>
                                        <?php
                                            // Recognizes the module-scoped flag or the future
                                            // enterprise-wide Honcho flag (unprefixed) — see Ccmps.php.
                                            $is_sys_admin_here = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);
                                            $can_delete = $is_sys_admin_here || !empty($_SESSION['ccmps_subentity_admin']);
                                        ?>
                                        <?php if (!empty($row->soft_deleted)): ?>
                                            <?php if ($can_delete): ?>
                                            <a class="btn btn-outline btn-success btn-xs" data-toggle="tooltip" title="Undelete Record" href="<?= BASE_URL ?>welcome-ccmps/undelrecord/<?= $row->id ?>/m">
                                                <i class="fa fa-undo"></i> Undelete
                                            </a>
                                            <?php endif; ?>
                                            <?php if ($is_sys_admin_here): ?>
                                            <a class="btn btn-outline btn-danger btn-xs" data-toggle="tooltip" title="Permanently Delete" href="<?= BASE_URL ?>welcome-ccmps/permdelete/<?= $row->id ?>"
                                               onclick="return confirm('This permanently deletes the record and cannot be undone. Continue?');">
                                                <i class="fa fa-trash"></i> Delete Permanently
                                            </a>
                                            <?php endif; ?>
                                        <?php elseif ($can_delete): ?>
                                            <a class="btn btn-outline btn-danger btn-xs" data-toggle="tooltip" title="Delete Record" href="<?= BASE_URL ?>welcome-ccmps/delrecord/<?= $row->id ?>">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
<?php
      }
  }
?>

<div class="row">
    <div class="col-lg-12">

        <div class="ibox-title">
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                </div>
                <div class="col-md-8">
                    <br>
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">
                        <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>;"><?= $_SESSION['subentity_name'] ?> </span> <?= CCMPS ?>
                    </span>
                </div>
                <div class="col-md-3">
                    <br>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/createccmp">
                        <i class="fa fa-plus"></i> <span style="font-size: 16px;"> Create New <?= CCMP ?></span>
                    </a>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                        <i class="fa fa-home"></i> <span style="font-size: 16px;"> Admin Home</span>
                    </a>
                </div>
            </div>
        </div> <!-- end ibox-title -->

        <div class="ibox-content">

            <form method="post" action="<?= BASE_URL ?>welcome-ccmps/bulkaction">
                <div class='row'>
                    <div class="col-md-9"></div>
                    <div class="col-md-1">
                        <select class="form-control m-b" name="selected">
                            <?php foreach ($bulk_actions as $row): ?>
                                <option value="<?= $row->id ?>"><?= htmlspecialchars($row->title) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input class="btn btn-default btn-outline" type="submit" value="Submit">
                    </div>
                </div>
                <br>

                <?php if (!empty($tabbed)): ?>

                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <?php foreach ($tabs as $i => $tab): ?>
                                <li><a class="nav-link<?= $i === 0 ? ' active' : '' ?>" data-toggle="tab" href="#<?= $tab['key'] ?>"><?= htmlspecialchars($tab['label']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($tabs as $i => $tab): ?>
                                <div id="<?= $tab['key'] ?>" class="tab-pane<?= $i === 0 ? ' active' : '' ?>">
                                    <div class="panel-body">
                                        <?php render_manage_table($tab['records'], $show_chapter_column, $statuses, 'dt_' . $tab['key']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                <?php else: ?>

                    <?php render_manage_table($ccmpsrecs, $show_chapter_column, $statuses, 'dt_single'); ?>

                <?php endif; ?>

                <div class="row m-t">
                    <div class="col-md-9">
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                            <i class="fa fa-home"></i> <span style="font-size: 12px;"> Admin Home</span>
                        </a>
                    </div>
                </div>
            </form>

        </div> <!-- end ibox-content -->

    </div> <!-- col-12 -->
</div> <!-- row -->

<!-- Loaded directly here, not just relying on inspinia.php's own later
     <script> tags — confirmed via a working comparison page
     (system-settings/manage) that inspinia.php's shared jQuery load is
     genuinely unreliable for reasons not yet fully understood; that page
     works specifically because it also loads its own copy directly
     rather than depending on the shared template. Matching that proven
     pattern here instead of continuing to depend on the shared load.
     DataTables itself needed the same treatment — jQuery loading
     correctly on its own wasn't sufficient, since $(...).DataTable was
     still not a function afterward, meaning the DataTables library tag
     in inspinia.php is apparently just as unreliable as jQuery's was. -->
<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
// jQuery and DataTables are both now loaded directly above, so this
// could safely use $(document).ready() instead — kept as 'load' anyway
// since it's still correct and there's no reason to churn this further.
window.addEventListener('load', function() {
    // "Select all" per-table, not global — each tab has its own table now.
    $(".checkAll").click(function() {
        $(this).closest('table').find(".checkItem").prop('checked', $(this).is(":checked"));
    });

    $('.manage-datatable').each(function() {
        $(this).DataTable({
            pageLength: 1000,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExcelFile'},
                {extend: 'pdf', title: 'PDFFile'},
                {extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                }
            ]
        });
    });
});

// Explicit, version-agnostic tab switching — same reasoning as the
// viewccmp.php tabs fix: not relying on Bootstrap's native
// data-toggle="tab" handling, which has previously failed silently on
// this app due to a Bootstrap-version mismatch. Handles clicks directly
// instead, so it works regardless of which Bootstrap version is active.
function initManageTabs() {
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

            // DataTables miscalculates column widths for tables that were
            // hidden (inactive tab pane) at initialization time — force a
            // recalculation now that this pane is actually visible.
            var table = targetPane.querySelector('table.manage-datatable');
            if (table && window.jQuery && jQuery.fn.DataTable && jQuery.fn.DataTable.isDataTable(table)) {
                jQuery(table).DataTable().columns.adjust();
            }
        });
    });
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initManageTabs);
} else {
    initManageTabs();
}
</script>

<?php if (DEBUGGING == true): ?>
    <?php
        echo('<h3>View: welcome-ccmps/manage</h3>');
        echo('<h3>$_SESSION</h3>');
        json($_SESSION);
        echo('<h3>$data</h3>');
        json($data);
    ?>
<?php endif; ?>
