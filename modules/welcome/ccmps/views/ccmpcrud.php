<?php

  include('navbar.php');

?>

<form method="post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>">

    <div class="row"> <!-- Page Row One -->
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


                    <?php if ($_SESSION['actionmode'] == 'updatemydata' || $_SESSION['actionmode'] == 'updateuser'): ?>
                     <!-- --   <div class="col-md-1">
                            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                        </div> -->
                        <div class="col-md-7">
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">
                                <?= $data['salutation_display'] ?? '' ?> <?= $data['first_name'] ?> <?= $data['middle_name'] ?> <?= $data['last_name'] ?> <?= $data['suffix'] ?>
                            </span>
                        </div>

                    <?php elseif ($_SESSION['actionmode'] == 'createuser'): ?>
                        <div class="col-md-7">
                            <br>
                                <!-- --    <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> -->
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"> Creating New <?= CCMP ?></span>
                        </div>

                    <?php else: ?>
                      <!--   <div class="col-md-1">
                            <br>
                                     <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                        </div>  -->
                        <div class="col-md-7">
                            <br>
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">
                                <?= $data['salutation_display'] ?? '' ?> <?= $data['first_name'] ?> <?= $data['middle_name'] ?> <?= $data['last_name'] ?> <?= $data['suffix'] ?>
                            </span>
                              <h3 style="color:<?= CCMPS_CCMP_NAME_CLR ?>;"><?= $data['chapter_name'] ?> <?= SUBENTITY ?></h3>
                        </div>
                    <?php endif; ?>

                    <!-- Save / Cancel buttons - which pair depends on mode -->
                    <?php if ($_SESSION['actionmode'] == 'ccmpu'): ?>
                        <div class="col-md-4">
                            <br>
                            <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">
                                <span style="color: <?= NB_CLR ?>; font-size: 16px;"><i class="fa fa-save"></i> Save Changes</span>
                            </button>
                            <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>welcome-ccmps/mydata/1">
                                <span style="color: <?= NB_CLR ?>; font-size: 16px;"><i class="fa fa-times-circle"></i> 69Cancel</span>
                            </a>
                        </div>

                    <?php elseif ($_SESSION['actionmode'] == 'subentity_admin_update' || $_SESSION['actionmode'] == 'mamu'): ?>
                        <div class="col-md-4">
                            <br>
                            <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">
                                <span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"><i class="fa fa-save"></i> Save Changes</span>
                            </button>
                            <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">
                                <span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"><i class="fa fa-times-circle"></i> 80 Cancel</span>
                            </a>
                        </div>

                    <?php elseif ($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['actionmode'] == 'createuser'): ?>
                        <div class="col-md-4">
                            <br>
                            <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">
                                <span class="btn-label-text"><i class="fa fa-save"></i> Save Changes</span>
                            </button>
                        <!-- --    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps"> -->
                        <a class="btn btn-outline btn-primary" style="padding: 8px 12px;" href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps">
                            <span class="btn-label-text" style="color: <?= NB_CLR ?>; font-size: 19px;"><i class="fa fa-times-circle"></i> 92 Cancel</span>
                        </a>
                        </div>

                    <?php else: ?>
                        <div class="col-md-4">
                            <br>
                            <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                                <span style="color: <?= NB_CLR ?>; font-size: 19px;"><i class="fa fa-home"></i> Home</span>
                            </a>
                            <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps">
                                <span style="color: <?= NB_CLR ?>; font-size: 19px;"><i class="fa fa-list"></i> 103 Manage All</span>
                            </a>
                        </div>
                    <?php endif; ?>

                </div> <!-- end row -->
            </div> <!-- end ibox-content -->
        </div>
    </div>

    <br>

    <!-- All member fields, organized by table / section -->
    <?php include('ccmpcrudcontact.php'); ?>

</form>

<!-- ============================================================
     MODALS (unchanged from original — password change / reset)
     ============================================================ -->

<div class="modal" id="delete-modal" style="display: none;">
    <div class="modal-heading danger"><i class="fa fa-trash"></i> Delete Record</div>
    <div class="modal-body">
        <?= form_open('members/submit_delete/' . $update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a Member record. This cannot be undone. Do you really want to do this?</p>
        <?php
        echo '<p>' . form_button('close', 'Cancel', $attr_close ?? array('class' => 'btn btn-white', 'data-dismiss' => 'modal')); // $attr_close was never set here
        echo form_submit('submit', 'Yes - Delete Now', array("class" => 'danger')) . '</p>';
        echo form_close();
        ?>
    </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated rotateInDownRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-key modal-icon"></i>
                <h4 class="modal-title">Change Password</h4>
                <small class="font-bold">Enter your current password and confirm a new one</small>
            </div>
            <center><h3 id="result"></h3></center>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control" name="crpass" id="crpass" value="<?= $crpass ?>" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="system_accounts" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="recid" id="recid" value="<?= $recid ?>" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Submit" class="btn btn-primary block full-width m-b" name="ChangeBtn1" id="ChangeBtn1">
                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated rotateInDownRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-key modal-icon"></i>
                <h4 class="modal-title">Reset Password <?= $recid ?></h4>
                <small class="font-bold">Enter the new password and confirm</small>
            </div>
            <center><h3 id="result"></h3></center>
            <form action="" method="post">
                <div class="modal-body">
                    <!-- Values below are read by JS in inspinia.php and posted to Ccmps.php controller. -->
                    <div class="form-group">
                        <input type="password" class="form-control" id="npass2" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="cpass2" placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="rpwl2" value="<?= MINPWLGTH ?>" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dbtupd2" value="ccmps" hidden>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="id2" value="<?= $recid ?>" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Submit" class="btn btn-primary block full-width m-b" name="ResetID" id="ResetBtn">
                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (DEBUGGING == true): ?>
    <?php
        echo('<h3>View: welcome-ccmps/views/ccmpcrud</h3>');
        echo('<h3>Session Id: ' . session_id() . '</h3>');
        echo('<h3>$_SESSION</h3>');
        json($_SESSION);
        echo('<h3>$data</h3>');
        json($data);
    ?>
<?php endif; ?>
