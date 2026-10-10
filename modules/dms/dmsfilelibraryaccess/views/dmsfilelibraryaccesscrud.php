<?php
  include('navbar.php');
?>

<form method="post" action="<?= BASE_URL ?>dms-dmsfilelibraryaccess/accesssubmit/<?= $recid ?>">

    <div class="row"> <!-- Page Row One -->
        <div class="col-lg-12"> <!-- Col 12 Page Row One -->
            <div class="ibox-content">
                <div class="row">

                    <div class="col-md-1">
                   <br>
                        <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                        <br>
                        </div> <!-- end column -->
                    <div class="col-md-5">
                              <br>
                        <?php if($recid > 0): ?>
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">Updating <?= $entityname ?>: <?= $title ?></span>
                        <?php else: ?>
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">Creating New <?= $entityname ?></span>
                        <?php endif; ?>
                    </div> <!-- end column -->

                    <div class="col-md-6">
                        <br>
                        
                        <button class="btn btn-outline btn-primary" style="font-size: 20px;" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                        <a class="btn btn-outline btn-warning" style="font-size: 23px; color: coral;" type="button" href="<?= BASE_URL ?>dms-dmsfilelibraryaccess/manage"><i class="fa fa-times-circle"></i> Cancel</a>

                </div> <!-- end row -->
            </div> <!-- end ibox -->

            <br> <!-- Gap between header and form -->

            <div class="ibox">

                <div class="ibox-content">

                    <?php if($_SESSION['flashmsgcolor'] == 1): ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                    <?php else: ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                    <?php endif; ?>

                    <input type="hidden" name="recid" value="<?= $recid ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="color:<?= SN_CLR ?>;">Level:</h2>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="number" class="form-control m-b" style="height: 40px; font-size: 20px;" name="level" id="level" value="<?= $level ?>">
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="color:<?= SN_CLR ?>;">Title:</h2>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control m-b" style="height: 40px; font-size: 20px;" name="title" id="title" value="<?= $title ?>" maxlength="125">
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="color:<?= SN_CLR ?>;">Description:</h2>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control m-b" style="height: 40px; font-size: 20px;" name="description" id="description" value="<?= $description ?>" maxlength="255">
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="color:<?= SN_CLR ?>;">Number:</h2>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="number" class="form-control m-b" style="height: 40px; font-size: 20px;" name="number" id="number" value="<?= $number ?>">
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                </div> <!-- end ibox-content -->

            </div> <!-- end ibox -->

        </div> <!-- end col-lg-12 -->
    </div> <!-- end row -->

</form>

<?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: dms-dmsfilelibraryaccess/views/dmsfilelibraryaccesscrud</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
<?php endif; ?>