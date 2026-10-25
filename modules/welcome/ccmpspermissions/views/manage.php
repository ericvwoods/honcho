<?php
  include('navbar.php');
?>

<!-- Begin Content -->

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="row">

                    <div class="col-md-1">
                        <div class="row">
                            <div class="col-md-6"> <!-- for spacing -->
                            </div>
                            <a href="#" title="">
                                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                            </a>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-7">
                        <span class="m-r">
                            <span style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span>
                        </span>

                <?php if($_SESSION['flashmsgcolor'] == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
                  $flash_msg = '';
                  set_flashdata($flash_msg); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
                  $flash_msg = '';
                  set_flashdata($flash_msg); ?>
                <?php endif; ?>

                        <!-- result of the last checkbox click -->
                        <div id="permmsg" style="font-weight: bold; font-size: 18px;"></div>
                    </div> <!-- end column -->

                <div class="col-md-4">
                    <br>
                    <p>Click a box to give or remove a permission. It saves straight away and is written to the Auditlog.
                       A change takes effect the next time that <?= strtolower(CCMP) ?> logs in.
                       Each box is a membership of a Security Group (Member System Admins, Member Admins, Chapter Admins, Student Admins).</p>
                </div>

            </div> <!-- end row -->

        </div> <!-- end col-lg-12 -->

    </div> <!-- end row -->

</div> <!-- End Ibox for page -->

<div class="ibox-content">

    <div class="row">
        <div class="col-md-12">
            <?php if($showall): ?>
                Showing all <?= strtolower(CCMPS) ?> (<?= count($permissionrecs) ?>).
                <a href="<?= BASE_URL ?>welcome-ccmpspermissions/manage">Show only <?= strtolower(CCMPS) ?> with a permission</a>
            <?php else: ?>
                Showing <?= strtolower(CCMPS) ?> with at least one permission (<?= count($permissionrecs) ?>).
                <a href="<?= BASE_URL ?>welcome-ccmpspermissions/manage/all">Show all <?= strtolower(CCMPS) ?></a>
            <?php endif; ?>
        </div>
    </div>

<br>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover dataTables-example">

                    <thead>
                        <tr>
                            <th style="color:<?= SN_CLR ?>;">Name</th>
                            <th style="color:<?= SN_CLR ?>;">Username</th>
                            <th style="color:<?= SN_CLR ?>;"><?= SUBENTITY ?></th>
                            <?php foreach($flags as $col => $flag) { ?>
                            <th style="color:<?= SN_CLR ?>; text-align:center;"><?= $flag[0] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($permissionrecs as $row) { ?>
                            <tr class='gradeA'>
                                <td><?= out($row->last_name) ?>, <?= out($row->first_name) ?></td>
                                <td><?= out($row->username) ?></td>
                                <td><?= out($row->chapter) ?></td>
                                <?php foreach($flags as $col => $flag) { ?>
                                <td style="text-align:center;" data-order="<?= intval($row->$col) ?>">
                                    <input type="checkbox" class="permbox" data-recid="<?= $row->id ?>" data-flag="<?= $col ?>" <?= intval($row->$col) == 1 ? 'checked' : '' ?>>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <tr></tr>
                    </tfoot>

                </table>

            </div> <!-- end table-responsive -->

        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div> <!-- end ibox-content -->

<!-- End Content -->
<br>

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            paging: true,
            searching: true,
            pageLength: 100,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'Permissions'},
                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        // each click saves one permission (togglepermission in Ccmpspermissions.php)
        $(document).on('change', '.permbox', function(){
            var box   = $(this);
            var value = box.is(':checked') ? 1 : 0;
            box.prop('disabled', true);

            $.post('<?= BASE_URL ?>welcome-ccmpspermissions/togglepermission', {
                token: '<?= $permissions_token ?>',
                recid: box.data('recid'),
                flag:  box.data('flag'),
                value: value
            }, function(resp){
                if(resp && resp.ok){
                    $('#permmsg').css('color', 'lightseagreen').text(resp.msg);
                    box.closest('td').attr('data-order', value);
                }else{
                    box.prop('checked', !value); // put it back
                    $('#permmsg').css('color', 'crimson').text(resp && resp.msg ? resp.msg : 'Not saved.');
                }
            }, 'json').fail(function(){
                box.prop('checked', !value);
                $('#permmsg').css('color', 'crimson').text('Not saved - please reload the page and try again.');
            }).always(function(){
                box.prop('disabled', false);
            });
        });
    });
</script>

<?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: welcome-ccmpspermissions/views/manage</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
 ?>
<?php endif; ?>
