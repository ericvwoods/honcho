<?php
  include('navbar.php');
?>

<!-- Begin Content -->

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="row">
                <!--    <br>
                    <br> -->
                    <div class="col-md-1">
                      
                        <div class="row">
                            <div class="col-md-6"> <!-- for spacing -->
                            </div>
                            <a href="#" title="">
                                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                            </a>
                        </div>
                    </div> <!-- end col -->
                <!--    <p> </p> -->
                    <div class="col-md-7">
                        
                        <span class="m-r">
                            <span style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span>
                        <!--    <a style="color:<?= SN2_CLR ?>;" href="#"><h2><?= $activity ?></h2></a> -->
                        </span>

                 <!--  can delete this if use the block below -->                
                <?php if($_SESSION['flashmsgcolor'] == 1): ?>
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

                </div> <!-- end row -->

            </div> <!-- end ibox-title -->

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
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Title</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Description</h<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Options</h<?= $_SESSION['tfontsize'] ?>></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($ccmpsfinancialtypesrecs as $row) { ?>
                            <tr class='gradeA'>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->fin_type_title ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->description ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                <td>
                                    <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Update Record" href="<?= BASE_URL ?>welcome-ccmpsfinancialtypes/updatefinancialtype/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['tfontsize'] ?>> Update</a>

                                    <a class="btn btn-outline btn-danger" type="button" data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>welcome-ccmpsfinancialtypes/delrecord/<?= $row->id ?>" onclick="return confirm('Are you sure you want to delete this record?');"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>> Delete</a>
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
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>welcome-ccmpsfinancialtypes/createfinancialtype"><h3><strong><i class="fa fa-clone"></i> Add a <?= $entityname ?></strong></h3></a>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>honcho/index"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>        
        </div>
    </div>

</div> <!-- end ibox-content for all financial types -->

<!-- End Content -->
<br>

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            paging: true,
            searching: true,
            pageLength: 100,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'ExcelFile'},
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
    echo('<h3>View: welcome-ccmpsfinancialtypes/views/manage</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
<?php endif; ?>
