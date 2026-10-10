
<!--
 <form action="" method = "post">

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xcrpass" id="xcrpass" value="<?= $crpass ?>" placeholder="Current Password" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xnpass" id="xnpass" value="<?= $npass ?>" placeholder="New Password" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xcpass" id="xcpass" value="<?= $cpass ?>" placeholder="Confirm New Password" >
                                    </div>

  <input type="button" value="AJAX Change Password"class="btn btn-primary block full-width m-b" name="xChangeID" id="xChangeBtn" ></input>
</form>
<h2 id="result"> </h2>  -->



 <!-- <center><h1 class="logo-name">Admin Dashboard</h1></center> -->

 <!-- <h3>inspinia/admins/dashboards/sysadmindashboard.php</h3> -->

 <!--
 <?php if($_SESSION['sysadmin'] == 1 || $_SESSION['subadmin'] == 1): ?>
    <br>
    <?= SUBENTITY ?> Administration
  <div class="row">

                <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngsubentity" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-users fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> <?= CCMPS ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/momads" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-thumb-tack fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Bulletins</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/momads" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-podcast fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Notices</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                      <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/momads" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-calendar fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Activities</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/momads" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-ellipsis-h fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Marquee</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/momads" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-file-text-o fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                 <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Docs</h2> </a>

                            </div>
                        </div>
                    </div>
                </div>

  </div>
  <?php endif; ?>  -->  <!--  End Chapter Admin -->


<hr>
<?php if($_SESSION['sysadmin'] == 1 || $_SESSION['cmsadmin'] == 1): ?>
<!--  <hr> -->
 <!-- <br> -->
 Document Management System

  <div class="row">
                <div class="col-lg-2">

                    <div class="widget style1 lazur-bg">
                        <p>   Document Library </p>
                        <div class="row vertical-align">
                            <div class="col-3">
                                   <br>
                                <a href="<?= BASE_URL ?>dms-dmslibrary/manage" style="font-weight: bold; color: white; ">     <i class="fa fa-file-text-o fa-3x"></i>
                            </div>
                            <div class="col-9 text-right">
                                Total <h2 class="font-bold"><?= $_SESSION['num_doc_records'] ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <a href="<?= BASE_URL ?>dms-dmslibrary/kanban" style="font-weight: bold; color: white; ">
   <div class="widget style1 lazur-bg">
                        <p style="font-weight: bold; color: white";>   Kanban Board </p>
                        <div class="row vertical-align">
                            <div class="col-1">

                                <span><i class="fa fa-list-alt fa-3x"></i>
                            </div>
                            <div class="col-1 text-right">
                             </span> </a>
                           <!-- --    In Revue <h2 class="font-bold">  <?= $_SESSION['inreview_doc_records'] ?></h2>  -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1">
                    <?php if($_SESSION['unrefined_doc_records'] > 0): ?>
                           <div class="widget style1 yellow-bg">
                    <?php else: ?>
                           <div class="widget style1 gray-bg">
                    <?php endif; ?>
                    <div class="row vertical-align">
                        <p>Unrefined</p>
                        <div class="col-1">
                        </div>
                        <h2 class="font-bold"><?= $_SESSION['unrefined_doc_records'] ?></h2>
                    </div>
                </div>
            </div>

                <div class="col-lg-1">
                    <?php if($_SESSION['backlog_doc_records'] > 0): ?>
                           <div class="widget style1 yellow-bg">
                    <?php else: ?>
                           <div class="widget style1 gray-bg">
                    <?php endif; ?>
                    <div class="row vertical-align">
                        <p>Backlogged</p>
                        <div class="col-1">
                        </div>
                        <h2 class="font-bold"><?= $_SESSION['backlog_doc_records'] ?></h2>
                    </div>
                </div>
            </div>

                <div class="col-lg-1">
                    <?php if($_SESSION['inprogress_doc_records'] > 0): ?>
                           <div class="widget style1 lazur-bg">
                    <?php else: ?>
                           <div class="widget style1 gray-bg">
                    <?php endif; ?>
                    <div class="row vertical-align">
                        <p>In Progress</p>
                        <div class="col-1">
                        </div>
                        <h2 class="font-bold"><?= $_SESSION['inprogress_doc_records'] ?></h2>
                    </div>
                </div>
             </div>

             <div class="col-lg-1">
                 <?php if($_SESSION['inreview_doc_records'] > 0): ?>
                        <div class="widget style1 lazur-bg">
                 <?php else: ?>
                        <div class="widget style1 gray-bg">
                 <?php endif; ?>
                 <div class="row vertical-align">
                     <p>In Review</p>
                     <div class="col-1">
                     </div>
                     <h2 class="font-bold"><?= $_SESSION['inreview_doc_records'] ?></h2>
                 </div>
             </div>
          </div>

          <div class="col-lg-1">
              <?php if($_SESSION['pending_doc_records'] > 0): ?>
                     <div class="widget style1 yellow-bg">
              <?php else: ?>
                     <div class="widget style1 gray-bg">
              <?php endif; ?>
              <div class="row vertical-align">
                   <div class="col-1">
                  <p>Pending</p>

                  <h2 class="font-bold"><?= $_SESSION['pending_doc_records'] ?></h2>
                  </div>
              </div>
          </div>
       </div>


       <div class="col-lg-1">
           <?php if($_SESSION['onhold_doc_records'] > 0): ?>
                  <div class="widget style1 red-bg">
           <?php else: ?>
                  <div class="widget style1 gray-bg">
           <?php endif; ?>
           <div class="row vertical-align">
               <p>On Hold</p>
               <div class="col-1">
               </div>
               <h2 class="font-bold"><?= $_SESSION['onhold_doc_records'] ?></h2>
           </div>
       </div>
    </div>

          <div class="col-lg-1">
              <?php if($_SESSION['blocked_doc_records'] > 0): ?>
                     <div class="widget style1 red-bg">
              <?php else: ?>
                     <div class="widget style1 gray-bg">
              <?php endif; ?>
              <div class="row vertical-align">
                  <p>Blocked</p>
                  <div class="col-1">
                  </div>
                  <h2 class="font-bold"><?= $_SESSION['blocked_doc_records'] ?></h2>
              </div>
          </div>
       </div>

       <div class="col-lg-1">
           <?php if($_SESSION['rejected_doc_records'] > 0): ?>
                  <div class="widget style1 red-bg">
           <?php else: ?>
                  <div class="widget style1 gray-bg">
           <?php endif; ?>
           <div class="row vertical-align">
               <p>Rejected</p>
               <div class="col-1">
               </div>
               <h2 class="font-bold"><?= $_SESSION['rejected_doc_records'] ?></h2>
           </div>
       </div>
    </div>



  </div>
<?php endif; ?>   <!--   End Content Mgr -->

<hr>

 <!--
<?php if($_SESSION['ccmpsadmin'] == 1 AND $_SESSION['sysadmin'] == 1 ): ?>
     <hr>
<?= CCMP ?> Administration
  <div class="row">
                <div class="col-lg-2">
                    <div class="widget style1 yellow-bg">
                        <p>   Manage Leaders </p>
                        <div class="row vertical-align">
                            <div class="col-3">
                                <a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin" style="font-weight: bold; color: white; ">     <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-9 text-right">
                                <h2 class="font-bold">21</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2">
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                                <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_current_and_pd_ccmps'] ?></strong>
                            </div>
                            <div class="col-10 text-right">
                            <i class="fa fa-users fa-2x"></i>     <span style="font-weight: bold; color: gray; font-size:16pt"> All <?= CCMPS ?></span> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_current_subentity_members'] ?></strong>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Current<br> <?= CCMPS ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="#" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_current_subentity_members'] ?></strong>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Past Due<br> <?= CCMPS ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm" style="color:cornflowerblue; font-size:18pt">   <strong><?= $_SESSION['num_current_subentity_student_members'] ?></strong>
                            </div>
                            <div class="col-10 text-right">
                                <h2 style="font-weight: bold; color: gray; font-size:16pt"> Student <?= CCMPS ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                                <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_ccmps_records'] ?></strong>
                            </div>
                            <div class="col-10 text-right">
                                <span style="font-weight: bold; color: gray; font-size:16pt"> All <?= CCMPS ?></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/export/all" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-table fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Master<br> XLS</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

<?php endif; ?>
-->


<?php if($_SESSION['sysadmin'] == 1): ?>

<!-- System Administration
 <div class="row">
                <div class="col-lg-2">
                    <div class="widget style1 blue-bg">
                        <p>   User Accounts </p>
                        <div class="row vertical-align">
                            <div class="col-3">
                                <a href="<?= BASE_URL ?>honcho-users/manage/mngallusers" style="font-weight: bold; color: white; ">     <i class="fa fa-users fa-3x"></i> </a>
                            </div>
                            <div class="col-9 text-right">
                                <h2 class="font-bold"><?= $_SESSION['total_user_records'] ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-2">
                     <div class="widget style1 yellow-bg">

                        <p>  <?= CCMP ?>  Accounts </p>
                        <div class="row vertical-align">
                            <div class="col-3">
    <a href="<?= BASE_URL ?>welcome-ccmps/manage/honcho/honchomngallccmps" style="font-weight: bold; color: white; ">
    <i class="fa fa-users fa-3x"></i>    </a>
                            </div>
                            <div class="col-9 text-right">
                                <h2 class="font-bold"><?= $_SESSION['total_ccmps_records'] ?></h2> </a>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin" style="color:cornflowerblue;">     <i class="fa fa-list-alt fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Auditlog</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:cornflowerblue;">     <i class="fa fa-gears fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Settings</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

  </div>  -->
<?php endif; ?>    <!--   -->

<?php if($_SESSION['ccmps_admin'] == 1 AND $_SESSION['ccmps_system_admin'] == 0 ): ?>
     <hr>
<?= CCMP ?> Administration
  <div class="row">
                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;"> <?= $_SESSION['num_current_and_pd_ccmps'] ?>    <i class="fa fa-users fa-2x"></ i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Total <?= CCMPS ?></h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">  All <?= CCMPS ?>   <i class="fa fa-child fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Students</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster" style="color:Gray;">     <i class="fa fa-dollar fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Current Roster</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/export/all" style="color:Gray;">     <i class="fa fa-table fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Master XLS</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>
  </div> <!--End row   -->
<?php endif; ?>    <!--   -->

<?php if($_SESSION['ccmps_admin'] == 0 AND $_SESSION['ccmps_system_admin'] == 1 ): ?>
     <hr>
System Administration
  <div class="row">
                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin" style="color:Gray;">     <i class="fa fa-list-alt fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Auditlog</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>system-settings/manage" style="color:Gray;">     <i class="fa fa-gears fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Settings</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

  </div> <!--End row   -->
<?php endif; ?>    <!--  ccmp_system_admin -->
<?php if($_SESSION['honcho_all_modules'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1): ?>
     <hr>
System Administration
  <div class="row">
                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin" style="color:Gray;">     <i class="fa fa-list-alt fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Auditlog</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>system-settings/manage" style="color:Gray;">     <i class="fa fa-gears fa-2x"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Settings</h2> </a>
                            </div>
                        </div>
                    </div>
                </div>

  </div> <!--End row   -->

<?php endif; ?>    <!--  ccmp_system_admin -->




 <?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: welcome-ccmps/ccmphome</h3>');
    echo('<h3>New Session Id</h3>');
    $session_id = session_id();
    echo ('<h3>'.$session_id.'</h3>');
    echo('<h3>$_COOKIE</h3>');
    json($_COOKIE);
    echo('<br>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
 <?php endif; ?>
