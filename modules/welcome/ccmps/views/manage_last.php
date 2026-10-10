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
                 <!-- --   <ul class="nav navbar-top-links navbar-right">
                        <li> -->
                         <!-- --   <?php if ($_SESSION['honcho_logged_in'] == 1): ?>
                                <a class="btn btn-warning btn-outline" href="<?= BASE_URL ?>honcho/index">
                                    <span style="font-size: 14px;">Admin</span>
                                </a>
                            <?php else: ?> -->
                            <br>
                            <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/createccmp">
                                <i class="fa fa-plus"></i> <span style="font-size: 16px;"> Create New <?= CCMP ?></span>
                            </a>
                            <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                                <i class="fa fa-home"></i> <span style="font-size: 16px;"> Admin Home</span>
                            </a>
                             <!-- --   <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                                    <span style="font-size: 16px;"><i class="fa fa-th-list"></i> Admin Dashboard</span>
                                </a> -->
                         <!-- --   <?php endif; ?> -->
                    <!-- --    </li>
                    </ul> -->
                </div>
            </div>
        </div> <!-- end ibox-title -->

        <div class="ibox-content">

            <form method="post" action="<?= BASE_URL ?>welcome-ccmps/bulkaction">
<div class='row'>
     <div class="col-md-9">
     </div>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
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
                                    Select <input type="checkbox" id="checkAll">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ccmpsrecs as $row): ?>
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
                                        <?php $can_delete = !empty($_SESSION['system_admin']) || !empty($_SESSION['subentity_admin']); ?>
                                        <?php if (!empty($row->soft_deleted)): ?>
                                            <?php if ($can_delete): ?>
                                            <a class="btn btn-outline btn-success btn-xs" data-toggle="tooltip" title="Undelete Record" href="<?= BASE_URL ?>welcome-ccmps/undelrecord/<?= $row->id ?>/m">
                                                <i class="fa fa-undo"></i> Undelete
                                            </a>
                                            <?php endif; ?>
                                            <?php if (!empty($_SESSION['system_admin'])): ?>
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

                <div class="row m-t">
                    <div class="col-md-9">
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                            <i class="fa fa-home"></i> <span style="font-size: 12px;"> Admin Home</span>
                        </a>
                    </div>
<!-- could insert the two columns containing bulk actions here and they would be inline with Admin Home button -->
                </div>
            </form>


        </div> <!-- end ibox-content -->

    </div> <!-- col-12 -->
</div> <!-- row -->

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#checkAll").click(function() {
        $(".checkItem").prop('checked', $(this).is(":checked"));
    });

    $('.dataTables-example').DataTable({
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
