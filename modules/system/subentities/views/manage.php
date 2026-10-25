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

                <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
                  $flash_msg = '';
                  set_flashdata($flash_msg); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
                  $flash_msg = '';
                  set_flashdata($flash_msg); ?>
                <?php endif; ?>
                    </div> <!-- end column -->

                <div class="col-md-4">
                    <p class="text-muted" style="margin-top: 10px;">Untick <strong>Active</strong> to leave a <?= strtolower(SUBENTITY) ?> out of the counts on the website. A <?= strtolower(SUBENTITY) ?> can only be deleted when no <?= CCMP ?> record belongs to it.</p>
                </div>

            </div> <!-- end row -->

        </div> <!-- end col-lg-12 -->

    </div> <!-- end row -->

</div> <!-- End Ibox for page -->

<div class="ibox-content">

<br>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover dataTables-example">

                    <thead>
                        <tr>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Id</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Short Name</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Full Name</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>State</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Region</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Chartered</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Active</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= CCMPS ?></h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Options</h<?= $_SESSION['tfontsize'] ?>></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($subentitiesrecs as $row) { ?>
                            <tr class='gradeA'<?= $row->active ? '' : ' style="color: #999;"' ?>>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= out($row->chapter_title) ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= out($row->description) ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= out($row->state) ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= out($row->region_title) ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->chartered ? 'Yes' : 'No' ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->active ? 'Yes' : 'No' ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= (int) $row->members ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td style="white-space: nowrap;">
                                    <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Update Record" href="<?= BASE_URL ?>system-subentities/updatesubentity/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['tfontsize'] ?>> Update</a>

                                    <?php if((int) $row->members == 0): ?>
                                    <form method="post" action="<?= BASE_URL ?>system-subentities/delrecord/<?= $row->id ?>" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="token" value="<?= $token ?>">
                                        <button class="btn btn-outline btn-danger" type="submit" data-toggle="tooltip" data-placement="right" title="Delete Record"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>> Delete</button>
                                    </form>
                                    <?php endif; ?>
                                </td>
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
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>system-subentities/createsubentity"><h3><strong><i class="fa fa-clone"></i> Add a <?= $entityname ?></strong></h3></a>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?><?= $home_url ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div> <!-- end ibox-content for all subentities -->

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
            order: [],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: '<?= SUBENTITIES ?>'},
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
    });
</script>

<?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: system-subentities/views/manage</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
<?php endif; ?>
