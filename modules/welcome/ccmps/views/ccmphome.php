
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

        <!-- --     <title>INSPINIA - Landing Page</title> -->

    <!-- Bootstrap core CSS -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!-- --        <link href="<?= BASE_URL ?>themes/inspinia/Landing_Page/css/style.css" rel="stylesheet">   if comment out style will change.
        See line 35 template inspinia.php -->
</head>

<?php $_SESSION['release_version'] = "honcho &copy; 2026 - v2.0"; ?>

<!--  <body class="light-skin"> -->

<!-- CCMPS Module Roles -->

<!-- Honcho Module Roles -->
<!--
$_SESSION['honcho_sysadmin']      is system_user_accounts->honcho_system_admin;
$_SESSION['honcho_ccmp_sysadmin'] is system_user_accounts->ccmp_system_admin;
$_SESSION['honcho_ccmp_admin']    is system_user_accounts->ccmp_admin;  // "member" admin
-->

<div id="wrapper">

<?php if($_SESSION['device_type'] == 2 ): ?>
<?php else: ?>
<?php include('sidemenu.php'); ?>

<?php endif; ?>
<div id="page-wrapper">  <!-- -- class="white-bg" -->

<!-- --    <div id="page-wrapper" class="bg-primary"> -->
<!-- <div class="row border-bottom bg-primary"> -->
<!--   <div class="row border-bottom blue-bg"> -->
<div class="row border-bottom gray-bg">

</div>
<?php if($_SESSION['device_type'] == 2 ): ?>
<div class="row">
<div class="col-sm-5">
</div>
<div class="col-sm-7">
<!-- columns not working for spacing   <h2><?= CCMP ?> Services Portal</h2> -->
</div>
</div>
<nav role="navigation">

<!--    <div class="sidebar-collapse"> -->
<ul class="nav metismenu" id="side-menu">




<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>  <!-- buttons on sidemenu -->
<li><a class="navbar-minimalize " href="#"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i><span class="nav-label"> Open/Close Menu</span></a></li>

<li><a href="<?= BASE_URL ?>welcome-ccmps/ccmpmenu"><i class="fa fa-user"></i><span class="nav-label"> <?= CCMP?> Menu</span></a></li>


<?php if(rbac_allowed('cms', 'manage_content')): ?> <!-- content manager (cms-content): Content Admins and System Admins -->
<li> <a href="#"><i class="fa fa-globe"></i> <span class="nav-label"> <?= CMS_LABEL ?> </span><span class="fa fa-chevron-down"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="<?= BASE_URL ?>cms-content/sections"><i class="fa fa-list"></i> Page Sections</a></li>
        <li><a href="<?= BASE_URL ?>cms-content/media"><i class="fa fa-picture-o"></i> Pictures</a></li>
    </ul>
</li>
<?php endif; ?>

<?php if($_SESSION['ccmps_student_admin'] == 1): ?>

<li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> Student Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
    <ul class="nav nav-second-level collapse">
        <li>
          <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) --></a>

        </li>

    </ul>
</li>

<?php endif; ?>

<?php if($_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['subentity_role'] == 1): ?>

<li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> <?= SUBENTITY ?> Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
    <ul class="nav nav-second-level collapse">
        <li><a href="<?= BASE_URL ?>welcome-ccmps/manage/mngsubentity"><i class="fa fa-users"></i><?= SUBENTITY ?> <?= CCMPS ?></a></li>
    <!--    <li>
          <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> </a>

        </li> --> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) -->
    <!--    <li><a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/momads"><i class="fa fa-ellipsis-h"></i> Chapter Marquee</a></li>  -->
        <li><a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/momads"><i class="fa fa-thumb-tack"></i> <?= SUBENTITY ?> Bulletins</a></li>
        <li><a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/momads"><i class="fa fa-podcast"></i><?= SUBENTITY ?> Notices</a></li>
        <li><a href="<?= BASE_URL ?>cms-ccmpsjobs/manage/momads"><i class="fa fa-plane"></i> Job Posts</a></li>
        <li><a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/momads"><i class="fa fa-calendar"></i><?= SUBENTITY ?> Activities</a></li>
    <!--    <li><a href="<?= BASE_URL ?>dms-dmslibrary/manage"><i class="fa fa-book"></i> Chapter Library</a></li>  -->
    <!--    <li><a href="#"><i class="fa fa-list"></i> Chapter Info</a></li>  -->
                     <li>
                <a id="toggleSpinner3" href="<?= BASE_URL ?>welcome-ccmps/export/chapter"><i class="fa fa-table"></i> Export for Les</a>
               <div id="ibox3" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>

                </div>
        </li>
    </ul>
</li>

<?php endif; ?>


<?php if($_SESSION['ccmps_admin'] == 1 || $_SESSION['national_officer'] == 4  || $_SESSION['national_officer'] == 5 ): ?>

<li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> <?= CCMP ?> Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
    <ul class="nav nav-second-level collapse">


        <li>
                <a id="toggleSpinner1" href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps"><i class="fa fa-users"></i> All <?= CCMPS ?> (<?=$_SESSION['total_ccmp_records'] ?>)</a>
               <div id="ibox1" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>

                </div>
        </li>

        <li>
                <a href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-child"></i> Student <?= CCMPS ?> <!--(<?= $_SESSION['num_all_current_student_members'] ?>)--></a>
         <!--   <a href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-users"></i> Current <?= CCMPS ?> (<?= $_SESSION['num_all_current_members'] ?>)</a> -->
        </li>

        <li>
                <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster"><i class="fa fa-list"></i> National Roster</a>

        </li>


        <li>
                <a id="toggleSpinner2" href="<?= BASE_URL ?>welcome-ccmps/export"><i class="fa fa-table"></i> Master Spreadsheet</a>
                <div id="ibox2" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>

                </div>
        </li>

    </ul>
</li>

<?php endif; ?>
<?php if($_SESSION['ccmps_system_admin'] == 1): ?>

<li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> System Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
    <ul class="nav nav-second-level collapse">


<?php if(HONCHO_MODULE == 0): ?> <!-- staff run System Settings when Honcho is deployed -->
        <li>
                <a href="<?= BASE_URL ?>system-settings/manage"><i class="fa fa-gears"></i> System Settings </a>

        </li>
        <li>
                <a href="<?= BASE_URL ?>system-rbac/manage"><i class="fa fa-lock"></i> Security Groups </a>
        </li>
<?php endif; ?>
        <li>
                <a href="<?= BASE_URL ?>welcome-ccmpspermissions/manage"><i class="fa fa-key"></i> <?= CCMP ?> Permissions </a>
        </li>
    <li>
        <a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a>
    </li>

<?php if(HONCHO_MODULE == 0): ?> <!-- staff run the Auditlog when Honcho is deployed -->
        <li>

                <a id="toggleSpinner4" href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin"><i class="fa fa-table"></i> Auditlog</a>
               <div id="ibox4" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>

                </div>
        </li>
<?php endif; ?>



   <!--     <li>
                <a href="<?= BASE_URL ?>welcome-ccmps/export"><i class="fa fa-table"></i> Master Spreadsheet</a>

        </li>   -->

    </ul>
</li>

<?php endif; ?>

<!--    <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> Preferences </span><span class="fa fa-chevron-down"></span></a>
    <ul class="dropdown-menu dropdown-alerts">
        <li>
            <a  data-toggle="modal" data-target="#fontModal">

                <div>

                <h3> <i class="fa fa-font"></i> Change Font Sizes [<?= $_SESSION['dfontsize'] ?>]
                    </h3>
                </div>
            </a>
        </li>
       <li class="dropdown-divider"></li>
        <li>
            <a  href="">

                <div>
                    <h3><i class="fa fa-times-circle"></i> Close
                    </h3></span>
                </div>
            </a>
        </li>

    </ul>
</li> -->
<li> <a href="#"><i class="fa fa-file-text-o"></i><span class="nav-label"> Reports </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
    <ul class="nav nav-second-level collapse">


        <li>
                <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster"><i class="fa fa-list"></i> National Roster</a>

        </li>
        <li>
                <a id="toggleSpinner3" href="<?= BASE_URL ?>welcome-ccmps/export/all"><i class="fa fa-table"></i> Master Spreadsheet</a>
               <div id="ibox3" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>

                </div>
        </li>

    </ul>
</li>
        <?php if(strlen($_SESSION['trongatetoken']) > 0): ?>
<li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>
<!--     <li><a class="navbar-minimalize " href="#"><i class="fa fa-caret-left"></i><span class="nav-label">Close Menu</span></a></li> -->
        <?php else: ?>
            <p>Session Expired - Please Logout</p>
            <li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>

        <?php endif; ?>



<?php else: ?> <!--  Regular <?= CCMP ?> Menu  -->

      <div class="col-sm-5">
          <center>   <h2><?= CCMP ?> Services Portal</h2> </center>
          <br>
<div class="row-fluid">

        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-1">
                <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:gray;">     <i class="fa fa-folder fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> 401My Profile</h2> </a>
                </div>
            </div>
        </div>


<?php if($_SESSION['device_type'] == 999 ): ?>
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-1">
                <a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/mmyads" style="color:Gray;">     <i class="fa fa-thumb-tack fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> My Bulletins</h2> </a>
                </div>
            </div>
        </div>
<?php endif; ?>
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome-ccmps/currentroster" style="color:Gray;">     <i class="fa fa-list fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> My <?= SUBENTITY ?> Roster (<?= $_SESSION['num_current_chapter_members'] ?>)</h2> </a>
                </div>
            </div>
        </div>
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="color:Gray;">     <i class="fa fa-address-card-o fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> National Directory (<?= $_SESSION['num_current_members'] ?>)</h2> </a>
                </div>
            </div>
        </div>

<?php if($_SESSION['device_type'] == 999 ): ?>  <!-- Temporarily cutoff member menu here  -->

        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>cms-ccmpschapters/viewpage" style="color:Gray;">
               <!--      <a href="#" style="color:LightGray;"> -->
                     <i class="fa fa-list fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                  <!---        <h2 style="color:LightGray;"> <?= SUBENTITIES ?></h2> </a>  -->
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> <?= SUBENTITIES ?> (<?= $_SESSION['num_chapters'] ?>) </h2> </a>
                </div>
            </div>
        </div>


        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>dms-dmslibrary/manage" style="color:Gray;">     <i class="fa fa-file fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Doc Library</h2> </a>
                </div>
            </div>
        </div>

<?php /* ATIS tile hidden 2026-10-16: it downloaded doc 1 from the old cms-ccmpslibrary
         (removed). Re-point it to the ATIS document's id in DMS before turning it back on.
       <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/ATIS_DOC_ID" style="color:Gray;" target="_blank">     <i class="fa fa-newspaper-o fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> ATIS</h2> </a>
                </div>
            </div>
        </div>
*/ ?>

        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>cms-ccmpssunshine/viewpage" style="color:Gray;">     <i class="fa fa-heart fa-2x" style="color: indianred;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Sunshine</h2> </a>
                   <!--    <h2 style="color:LightGray;"> Sunshine</h2> </a>    -->
                </div>
            </div>
        </div>

<?php if (empty($_SESSION['mobile_app_view'])): ?>
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" style="color:Gray;">     <i class="fa fa-pencil fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Register Me</h2> </a>
                </div>
            </div>
        </div>
<?php endif; ?>


        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome-ccmps/sponsors" style="color:Gray;">     <i class="fa fa-handshake-o fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Sponsors</h2> </a>
                </div>
            </div>
        </div>



<?php if(ENV == '' || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['ccmps_subentity_admin'] == 1 || rbac_allowed('cms', 'manage_content') || $_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_student_admin'] == 1 || $_SESSION['national_officer'] == 1  || $_SESSION['national_officer'] == 2  || $_SESSION['national_officer'] == 3  || $_SESSION['national_officer'] == 4  || $_SESSION['national_officer'] == 5   || $_SESSION['national_officer'] == 6 || $_SESSION['national_officer'] == 7 || $_SESSION['chapter_role'] == 1): ?>

        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome-ccmps/adminmenu" style="color:Gray;">     <i class="fa fa-gears fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Admin</h2> </a>
                </div>
            </div>
        </div>

<?php endif; ?>

<?php endif; ?> <!-- from line 397 if = 999 ie cut off most member buttons and this admin button above -->

        <?php if($_SESSION['honcho_logged_in'] == 1 ): ?>
          <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>honcho/logout" style="color:Gray;">     <i class="fa fa-sign-out fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Logout</h2> </a>
                </div>
            </div>
          </div>
        <?php else: ?>
          <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome/logout/compccmp" style="color:Gray;">     <i class="fa fa-sign-out fa-2x" style="color: cornflowerblue;"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Logout</h2> </a>
                </div>
            </div>
          </div>

        <?php endif; ?>
</div> <!-- row-fluid  -->

</div>
<?php endif; ?> <!--   -->
</ul>

<!-- 117   </div>  -->

</nav>



<?php else: ?> <!-- Not a mobile phone - regular computer  -->

<!-- line 7961 style.css control menu item colors    -->

<div class="scroll_content">


<!-- --  if you take out 476 -->
<div class="panel">

<div class="row vertical-align">

<div class="col-12">

        <!--      <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> -->
    <?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>

    <?php else: ?>
          <!-- --  <?php if(SHOW_MARQUEE == 1 ): ?>
                <br>
                <marquee behavior="scroll" scrollamount="13" direction="left" onmouseover="this.stop();" onmouseout="this.start();">

                            <h2 style="color:darkgoldenrod;">

                            A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to:
                            <?php
                                foreach($marqueedata as $row) { ?>

                                <span style="color: <?= SN2_CLR ?>;"><strong><?= $row->title ?> </strong><small><?= $row->subentity ?></small></span> <?= $row->info1 ?>

                            <?php } ?>

                            <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>
                        </h2>
                </marquee>
                  <hr>
            <?php endif; ?> -->
    <?php endif; ?>
    <h3>  <?= flashdata('<div style="font-weight: bold; color: orange; font-size: 13pt">', '</div>');
                $flash_msg = '';
                set_flashdata($flash_msg); ?>  </h3>
</div> <!-- End col  -->

</div> <!-- End row  -->

</div> <!-- End row  -->

<div class="row">


<div class="col-lg-12">
<!--    <hr> -->


<!-- WHICH SIDEMENU   -->

<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>  <!-- buttons on sidemenu -->
<!-- Dont show buttons   -->
<!-- <php else: ?> -->
<!-- Show buttons   -->

<?php if($_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['subentity_role'] == 1 || $_SESSION['honcho_ccmps_module_subentities'] == 1): ?>
<br>
<?= SUBENTITY ?> Administration
<div class="row">

    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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
      <!--   <div class="widget style1 yellow-bg"> -->
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
      <!--   <div class="widget style1 yellow-bg"> -->
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
      <!--   <div class="widget style1 yellow-bg"> -->
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
      <!--   <div class="widget style1 yellow-bg"> -->
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
    <!--     <div class="widget style1 white-bg"> -->
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>dms-dmslibrary/manage" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-file-text-o fa-2x"></i>
                </div>
                <div class="col-10 text-right">
                     <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our<br> Docs</h2> </a>
                    <!--    <h2 style="color:LightGray;"> Sponsors</h2> </a>  -->
                </div>
            </div>
        </div>
    </div>

</div> <!--End row   -->
<?php endif; ?>    <!--  End Chapter Admin -->

<?php if(rbac_allowed('cms', 'manage_content')): ?> <!-- content manager (cms-content) -->
<br>
<?= CMS_LABEL ?>
<div class="row">

    <div class="col-lg-2">
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>cms-content/sections" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-list fa-2x"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: gray; font-size:16pt"> Page Sections</h2> </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2">
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>cms-content/media" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-picture-o fa-2x"></i>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: gray; font-size:16pt"> Pictures</h2> </a>
                </div>
            </div>
        </div>
    </div>

</div> <!--End row   -->
<?php endif; ?>    <!--  End Content Mgr -->
<?php if($_SESSION['honcho_all_modules'] == 1 || $_SESSION['honcho_ccmps_module_ccmps'] == 1|| $_SESSION['honcho_ccmps_module_all'] == 1): ?>
<br>
<?= CCMP ?> Administration  aaa
<div class="row">

    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                    <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_current_and_pd_ccmps'] ?></strong>
                </div>
                <div class="col-10 text-right">
                      <span style="font-weight: bold; color: gray; font-size:16pt"> Total<br> <?= CCMPS ?></span> </a>
                </div>
            </div>
        </div>
    </div>
<div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm" style="color:cornflowerblue; font-size:18pt">   <strong><?= $_SESSION['num_current_subentity_student_members'] ?></strong>
                </div>
                <div class="col-10 text-right">
                      <h2 style="font-weight: bold; color: gray; font-size:16pt"> Current Student<br> <?= CCMPS ?></h2> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                    <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_ccmps_records'] ?></strong>
                </div>
                <div class="col-10 text-right">
                      <span style="font-weight: bold; color: gray; font-size:16pt"> All<br> <?= CCMP ?> Records</span> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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
</div> <!--End row   -->
<?php endif; ?>





<?php if($_SESSION['ccmps_admin'] == 1 AND $_SESSION['ccmps_system_admin'] == 1 ): ?>
<hr>
<?= CCMP ?> Administration  bbb
<div class="row">

    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
        <div class="widget style1 gray-bg">
            <div class="row vertical-align">
                <div class="col-2">
                    <a href="<?= BASE_URL ?>welcome-ccmps/manage/mngallccmps" style="color:cornflowerblue; font-size:18pt"> <strong><?= $_SESSION['num_current_and_pd_ccmps'] ?></strong>
                </div>
                <div class="col-10 text-right">
                    <span style="font-weight: bold; color: gray; font-size:16pt"> Total <?= CCMPS ?></span> </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
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

      <!--   <div class="widget style1 yellow-bg"> -->
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
</div> <!--End row   -->

<hr>
System Administration ccc
<div class="row">

<?php if(HONCHO_MODULE == 0): ?> <!-- staff run the Auditlog when Honcho is deployed -->
    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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
<?php endif; ?>

    <div class="col-lg-2">

      <!--   <div class="widget style1 yellow-bg"> -->
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

</div> <!--End row   -->
<?php endif; ?>    <!--   -->





<?php endif; ?>





      <!--   <div class="jumbotron">
          <h1>Registrations for the Summer Events are Open!</h1>

          <h2><strong>Operation Skyhook</strong> May 25 - 29 Regular Registration ends May 20th</h2>
          <h2><p><strong>Summer Flight Academy Scholarships</strong> July 8 - 22 Applications due May 15th</p></h2>
          <h2><p><strong>General Membership Meeting - Detroit</strong> Aug 18 - 20 Regular Registration ends July 17th<a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" > <u>Register</u></a></p></h2>

        </div>  -->



<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>
<!-- dont show collapse - make user go back to member menu   -->
<?php else: ?>

<!-- DASHBOARD HEADER HERE  -->
<div class="panel panel-default"> <!-- default, success, primary, info, warning, danger -->
<!-- --  <div class="panel-heading">
   Click Item to Open\Close --
<!-- --   <center><div style="font-weight: bold; color: gray; font-size:25pt">[1077 Menu Here]</div></center> --
<!--   <center>    <i class="fa fa-dashboard fa-3x"></i> <h1><strong><?= CCMP ?> Dashboard</strong></h1> </center> --
</div>  -->

<!--    <body id="page-top" class="landing-page no-skin-config">  -->
<div id="page-top" class="landing-page no-skin-config">
<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-expand-md landing-sticky-nav" role="navigation">  <!-- navbar-fixed-top -->
            <div class="container">
                <a class="navbar-brand" href="index.html" ><?= SHORTSITENAME ?> <?= SITENAME4 ?></a>

                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                        <li><a class="nav-link page-scroll" href="#features">Features</a></li>
                        <li><a class="nav-link page-scroll" href="#team">Team</a></li>
                        <li><a class="nav-link page-scroll" href="#testimonials">Testimonials</a></li>
                        <li><a class="nav-link page-scroll" href="#pricing">Pricing</a></li>
                        <li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
<?php if (empty($_SESSION['mobile_app_view'])): ?>
                         <li><a class="nav-link page-scroll" href="<?= HOTLINK ?>"><?= HOTLINKLABEL ?></a></li>
<?php endif; ?>
                    </ul>
                </div>
             <!-- --   <a class="nav-link page-scroll" href="#contact"><a class="" style="font-family: 'Open Sans', helvetica, arial, sans-serif; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11p text-decoration: underline; margin-top: 0px; margin-left: 0px;" href="<?= HOTLINK ?>"><?= HOTLINKLABEL ?></a></a> -->
            </div>
        </nav>
</div>
<div class="row vertical-align">

    <div class="col-12">

            <!--      <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> -->
        <?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>
            <!-- dont show the marquee -->
        <?php else: ?>

        <?php endif; ?>
    </div> <!-- End col  -->

</div> <!-- End row  -->
<div id="inSlider" class="carousel slide" data-ride="carousel" >
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>We craft<br/>
                        brands, web apps,<br/>
                        and user interfaces<br/>
                        we are IN+ studio</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing.</p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">READ MORE</a>
                        <a class="caption-link" href="#" role="button">Inspinia Theme</a>
                    </p>
                </div>
                <div class="carousel-image wow zoomIn">
                    <img src="<?= BASE_URL ?>themes/inspinia/img/landing/laptop.png" alt="laptop"/>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h1>We create meaningful <br/> interfaces that inspire.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#inSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#inSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<section id="features" class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>Full responsive</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>LESS/SASS Files</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>6 Charts Library</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Advanced Forms</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
        </div>
    </div>
</section>

<section  class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Over 40+ unique view<br/> <span class="navy"> with many custom components</span> </h1>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 text-center wow fadeInLeft">
            <div>
                <i class="fa fa-mobile features-icon"></i>
                <h2>Full responsive</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-bar-chart features-icon"></i>
                <h2>6 Charts Library</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
        </div>
        <div class="col-md-6 text-center  wow zoomIn">
            <img src="<?= BASE_URL ?>themes/inspinia/img/landing/perspective.png" alt="dashboard" class="img-fluid">
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <div>
                <i class="fa fa-envelope features-icon"></i>
                <h2>Mail pages</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-google features-icon"></i>
                <h2>AngularJS version</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Discover great feautres</h1>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
        </div>
    </div>
    <div class="row features-block">
        <div class="col-lg-6 features-text wow fadeInLeft">
            <small>INSPINIA</small>
            <h2>Perfectly designed </h2>
            <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.</p>
            <a href="" class="btn btn-primary">Learn more</a>
        </div>
        <div class="col-lg-6 text-right wow fadeInRight">
            <img src="<?= BASE_URL ?>themes/inspinia/img/landing/dashboard.png" alt="dashboard" class="img-fluid float-right">
        </div>
    </div>
</section>

<section id="team" class="gray-section team">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Our Team</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 wow fadeInLeft">
                <div class="team-member">
                    <img src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar3.jpg" class="img-fluid rounded-circle img-small" alt="">
                    <h4><span class="navy">Amelia</span> Smith</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus. </p>
                    <ul class="list-inline social-icon">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member wow zoomIn">
                    <img src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar1.jpg" class="img-fluid rounded-circle" alt="">
                    <h4><span class="navy">John</span> Novak</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
                    <ul class="list-inline social-icon">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 wow fadeInRight">
                <div class="team-member">
                    <img src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar2.jpg" class="img-fluid rounded-circle img-small" alt="">
                    <h4><span class="navy">Peter</span> Johnson</h4>
                    <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
                    <ul class="list-inline social-icon">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Even more great feautres</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div>
        <div class="row features-block">
            <div class="col-lg-3 features-text wow fadeInLeft">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.</p>
                <a href="" class="btn btn-primary">Learn more</a>
            </div>
            <div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
                <img src="<?= BASE_URL ?>themes/inspinia/img/landing/iphone.jpg" class="img-fluid" alt="dashboard">
            </div>
            <div class="col-lg-3 features-text text-right wow fadeInRight">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.</p>
                <a href="" class="btn btn-primary">Learn more</a>
            </div>
        </div>
    </div>

</section>

<section class="timeline gray-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Our workflow</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div>
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Meeting</h2>
                            <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                            </p>
                            <a href="#" class="btn btn-xs btn-primary"> More info</a>
                            <span class="vertical-date"> Today <br/> <small>Dec 24</small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-file-text"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Decision</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            <a href="#" class="btn btn-xs btn-primary"> More info</a>
                            <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Implementation</h2>
                            <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                            <a href="#" class="btn btn-xs btn-primary"> More info</a>
                            <span class="vertical-date"> Monday <br/> <small>Jan 02</small> </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>

<section id="testimonials" class="navy-section testimonials" style="margin-top: 0">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center wow zoomIn">
                <i class="fa fa-comment big-icon"></i>
                <h1>
                    What our users say
                </h1>
                <div class="testimonials-text">
                    <i>"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."</i>
                </div>
                <small>
                    <strong>12.02.2014 - Andy Smith</strong>
                </small>
            </div>
        </div>
    </div>

</section>

<section class="comments gray-section" style="margin-top: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>What our partners say</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada. </p>
            </div>
        </div>
        <div class="row features-block">
            <div class="col-lg-4">
                <div class="bubble">
                    "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                </div>
                <div class="comments-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar3.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                            Andrew Williams
                        </div>
                        <small class="text-muted">Company X from California</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bubble">
                    "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                </div>
                <div class="comments-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar1.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                            Andrew Williams
                        </div>
                        <small class="text-muted">Company X from California</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bubble">
                    "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                </div>
                <div class="comments-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="<?= BASE_URL ?>themes/inspinia/img/landing/avatar2.jpg">
                    </a>
                    <div class="media-body">
                        <div class="commens-name">
                            Andrew Williams
                        </div>
                        <small class="text-muted">Company X from California</small>
                    </div>
                </div>
            </div>



        </div>
    </div>

</section>

<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>More and more extra great feautres</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-lg-offset-1 features-text">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <i class="fa fa-bar-chart big-icon float-right"></i>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
            </div>
            <div class="col-lg-5 features-text">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <i class="fa fa-bolt big-icon float-right"></i>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-lg-offset-1 features-text">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <i class="fa fa-clock-o big-icon float-right"></i>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
            </div>
            <div class="col-lg-5 features-text">
                <small>INSPINIA</small>
                <h2>Perfectly designed </h2>
                <i class="fa fa-users big-icon float-right"></i>
                <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
            </div>
        </div>
    </div>

</section>
<section id="pricing" class="pricing">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>App Pricing</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 wow zoomIn">
                <ul class="pricing-plan list-unstyled">
                    <li class="pricing-title">
                        Basic
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$16</span> / month
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <a class="btn btn-primary btn-xs" href="#">Signup</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 wow zoomIn">
                <ul class="pricing-plan list-unstyled selected">
                    <li class="pricing-title">
                        Standard
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$22</span> / month
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <strong>Support platform</strong>
                    </li>
                    <li class="plan-action">
                        <a class="btn btn-primary btn-xs" href="#">Signup</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 wow zoomIn">
                <ul class="pricing-plan list-unstyled">
                    <li class="pricing-title">
                        Premium
                    </li>
                    <li class="pricing-desc">
                        Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                    </li>
                    <li class="pricing-price">
                        <span>$160</span> / month
                    </li>
                    <li>
                        Dashboards
                    </li>
                    <li>
                        Projects view
                    </li>
                    <li>
                        Contacts
                    </li>
                    <li>
                        Calendar
                    </li>
                    <li>
                        AngularJs
                    </li>
                    <li>
                        <a class="btn btn-primary btn-xs" href="#">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row m-t-lg">
            <div class="col-lg-12 text-center m-t-lg">
                <p>*Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. <span class="navy">Various versions</span>  have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
            </div>
        </div>
    </div>

</section>

<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
            </div>
        </div>
        <div class="row m-b-lg justify-content-center">
            <div class="col-lg-3 ">
                <address>
                    <strong><span class="navy">Company name, Inc.</span></strong><br/>
                    795 Folsom Ave, Suite 600<br/>
                    San Francisco, CA 94107<br/>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis, totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:test@email.com" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2015 Company Name</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>

<!-- Mainly scripts -->
<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/wow/wow.min.js"></script>


<script>

    $(document).ready(function () {

        $('body').scrollspy({
            target: '#navbar',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
    });

    var cbpAnimatedHeader = (function() {
        var docElem = document.documentElement,
                header = document.querySelector( '.navbar-default' ),
                didScroll = false,
                changeHeaderOn = 200;
        function init() {
            window.addEventListener( 'scroll', function( event ) {
                if( !didScroll ) {
                    didScroll = true;
                    setTimeout( scrollPage, 250 );
                }
            }, false );
        }
        function scrollPage() {
            var sy = scrollY();
            if ( sy >= changeHeaderOn ) {
                $(header).addClass('navbar-scroll')
            }
            else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }
        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }
        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>

</div>
</html>
     <div> <!-- end panel-body  -->


<!--  Begin Accordian Section -->
     <div>
     <div class="faq-item">
        <div class="row">
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-11">
<br>
<center><a data-toggle="collapse" href="#faq7" class="faq-question" style="font-family: 'open sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 30px; font-weight: 200; color: #676a6c; margin-left: 150px;"> <span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-line-chart fa-1x"></i></span> Membership Vitals <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i>  </a> </center>
<!-- <center><a data-toggle="collapse" href="#faq7" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <span style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:18pt"><i class="fa fa-stethoscope fa-2x"></i><strong> Membership Vital Signs</strong></span> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i> </a> </center> -->
                    </div> <!-- col -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <!-- --    <php if($_SESSION['hometab'] == 7 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                          <php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 --
                                <div id="faq7" class="panel-collapse collapse show">  <!-- open  class="panel-collapse"   --

                        <php else: ?> -->
                                <div id="faq7" class="panel-collapse collapse">  <!-- closed  class="panel-collapse collapse" -->
                      <!-- --  <php endif; ?> -->


                                <div class="faq-answer">

                                        <div class="ibox ">
                                          <!--    <div class="ibox-title">
                                              <center> <h5>  </h5></center>
                                               <div class="ibox-tools">
                                                    <a class="collapse-link">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </a>
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                        <i class="fa fa-wrench"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-user">
                                                        <li><a href="#" class="dropdown-item">Config option 1</a>
                                                        </li>
                                                        <li><a href="#" class="dropdown-item">Config option 2</a>
                                                        </li>
                                                    </ul>
                                                    <a class="close-link">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>-->
                                            <div class="ibox-content">
                <!--  ****************************************************************************** -->
<div class="wrapper wrapper-content">

<div class="row">


    <!--    <div class="ibox-content">
            <h3>
                Knob - Dial
            </h3>
            <p>
                Easily create knob input style.
            </p>
            <div class="text-center">
                <small>Simple knob example</small><br/><br/>
                <div class="m-r-md inline">
                <input type="text" value="<?= $pcntcurrentchaptermembers ?>" class="dial m-r-sm" data-fgColor="#1AB394" data-width="85" data-height="85" />
                </div>
                <div class="m-r-md inline">
                <input type="text" value="25" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                </div>
                <div class="m-r-md inline">
                <input type="text" value="50" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                </div>
            </div>
            <div class="text-center">
                <small>Dynamic knob example</small><br/><br/>
                <div class="m-r-md inline">
                <input type="text" value="75" class="dial m-r-sm" data-fgColor="#ED5565" data-width="85" data-height="85" data-cursor=true data-thickness=.3/>
                </div>
                <div class="m-r-md inline">
                <input type="text" value="25" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-step="1000" data-min="-15000" data-max="15000" data-displayPrevious=true/>
                </div>
                <div class="m-r-md inline">
                <input type="text" value="60" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 />
                </div>
            </div>
        </div> -->
</div>

<br>


<div class="row">
<div class="col-lg-2">
    <div class="ibox ">
        <div class="ibox-title">
            <div class="ibox-tools">
                 <span class="label label-warning float-right"><?= SUBENTITY ?></span>
            </div>
            <h5><?= SUBENTITY ?> <?= CCMPS ?></h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins"><?= $numcurrentchaptermembers ?></h1>
             <div class="stat-percent font-bold text-info">  <?= $pcntcurrentchaptermembers ?>%  Renewal Rate  </div>
            <small><?= $numpastduechaptermembers ?> past due</small>
        </div>
    </div>
</div>
<div class="col-lg-2">
    <div class="ibox ">
        <div class="ibox-title">
            <div class="ibox-tools">
                <span class="label label-info float-right">National</span>
            </div>
            <h5>National <?= CCMPS ?></h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins"><?= $numcurrentbpamembers ?></h1>
            <div class="stat-percent font-bold text-danger"><?= $pcntcurrentbpamembers ?>%  Renewal Rate </div>
            <small><?= $numpastduebpamembers ?> past due</small>
        </div>
    </div>
</div>


</div>

<div class="row">
          <div>
        <table class="table">
            <tbody>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numregchaptermembers ?></button>
                    <?= SUBENTITY ?> Regular <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numregbpamembers ?></button>
                    National Regular <?= CCMPS ?>
                </td>

            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numfamchaptermembers ?></button>
                    <?= SUBENTITY ?> Family <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numfambpamembers ?></button>
                    National Family <?= CCMPS ?>
                </td>

            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numascchaptermembers ?></button>
                    <?= SUBENTITY ?> Associate <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numascbpamembers ?></button>
                    National Associate <?= CCMPS ?>
                </td>

            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numstuchaptermembers ?></button>
                    <?= SUBENTITY ?> Student <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numstubpamembers ?></button>
                    National Student <?= CCMPS ?>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numqstuchaptermembers ?></button>
                    <?= SUBENTITY ?> Q Student <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numqstubpamembers ?></button>
                    National Q Student <?= CCMPS ?>
                </td>

            </tr>
            <tr>
                <td>
                    <button type="button" class="btn btn-warning m-r-sm"><?= $numhonchaptermembers ?></button>
                    <?= SUBENTITY ?> Honorary <?= CCMPS ?>
                </td>
                <td>
                    <button type="button" class="btn btn-primary m-r-sm"><?= $numhonbpamembers ?></button>
                    National Honorary <?= CCMPS ?>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>





               <!--  ****************************************************************************** -->
                                            </div><!--ibox content  -->
    </div><!--ibox   -->
    </div> <!-- faq answer-->
    </div> <!-- End Tab 7 Panel -->
    </div><!-- faq#   -->
    </div><!-- col 12  -->
    </div><!-- row   -->
    </div>
    </div>
    </div><!-- End faq-item  -->

<!--   End Accordian Section -->
<!-- <php endif; ?> -->






<?php endif; ?>


            </div>
            <div class="panel-footer">
            <!--    Developed by Encore Business Solutions &copy; 2022 - <?= $_SESSION['system_current_year'] ?> -->
                 <small><?= $_SESSION['release_version'] ?></small>
            </div>
        </div>
    </div>
    <!-- Last 3 divs end the dashboard panel and panel body -->
</div>
</div>
<!--    <hr>  -->
</div>



<!--  Begin footer here -->

<!-- <div class="footer bg-primary"> -->
<!-- <div class="footer bg-gray"> -->
<!-- <div class="footer blue-bg"> -->
<!-- <div class="footer teal-bg"> -->



<!--  End footer here -->

</div> <!--  1060 -->

<!--  The next 4 I added when I put in the slimscroll scroll_content on line 111 -->
</div>
</div> <!--  631 panel_body -->
</div> <!--  625  panel panel-default-->
</div>  <!-- col-lg-12" -->
</div>  <!-- End class="scroll_content" -->
<?php endif; ?>   <!-- 98 device_type = 2  -->

<div class="float-left">

<!--  <h3> <img src="<?= BASE_URL ?>welcome_module/images/encoreletter29x38.png" alt="Logo"> ncore Business Solutions</h3> -->
<!--  Encore Business &copy; 2022 - <?= $_SESSION['current_year'] ?> -->
<!-- <h3> <img src="<?= BASE_URL ?>welcome_module/images/encoreletter29x38.png" alt="Logo"> ncore Business Solutions</h3>Encore Cyber Group &copy; 2022 - <?= $_SESSION['current_year'] ?> -->

</div>  <!-- wrapper -->

<!-- Begin Modals -->
<div class="modal inmodal fade" id="security-modal" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" style="color:Red;"><i class="fa fa-warning"></i> Security Alert!</h4>
</div>
<div class="modal-body">
    <p><h1 style="color:Red;"><strong>Phishing Attack</strong></h1></p>
    <h3>Someone is sending emails posing as John Hicks wanting to buy gifts for employees and soliciting money from BPA members. </p><p><span style="color:Red;"> Do not open and delete immediately!</span></h3></p>
    <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                <img src="<?= BASE_URL ?>welcome_module/images/sahicks.jpg" alt="Logo">
                            </a>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
  <!--   <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-ccmpsbulletinboard/delrecord/<?= $row->id ?>/m">Delete </a> -->
</div>
</div>
</div>
</div>

<!-- Not Used   -->
<div class="modal inmodal fade" id="bulletin-modal" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" style="color:Blue;"><i class="fa fa-book"></i> Read More...</h4>
</div>
<div class="modal-body">
    <p><h1 style="color:Blue;"><strong>Bulletin</strong></h1></p>
    <h3><?= $row->fulldescription ?></h3>
    <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                <img src="<?= BASE_URL ?>welcome_module/images/" alt="pic">
                            </a>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
  <!--   <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-ccmpsbulletinboard/delrecord/<?= $row->id ?>/m">Delete </a> -->
</div>
</div>
</div>
</div>   <!-- body?  -->



<!-- Put all session variables in hidden input fields to eliminate php evaluations for display logic -->

<!-- Begin Javascript for this view page  -->

<!-- Vue.js CDN  for only this page ccmps/views/ccmphome. All others use templates/inspinia.php -->
<!--     <script src="https://unpkg.com/vue@next"></script> latest dev version -->
<!-- --   <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->

<script>

const JumboApp = {

data() {
return {
jumbotronheader: 'What\'s Goin\' On!',
    errorMsg: "",
    items: []
}
},
mounted: function() { // executes on startup
   // this.getAllItems();

    // alert('mounted');

},
methods: {

    getAllItems(){
         axios.get("http://localhost/honchotg/cms-ccmpsjumbotron/jumbotronitems").then((response)=> {
//  axios.get("http://localhost/honchotg/cms-ccmpsjumbotron/jumbotronitems").then(function(response) {
             this.items = response.data
             console.log(response.data);

}) //axios.get


 /*     axios.get("http://localhost/honchotg/cms-ccmpsjumbotron/jumbotronitems").then(function(response){
          if(response.data.error){
               alert('bad');
              jumboapp.errorMsg = response.data.message;
          }else{
             // alert(response.data.message);
            //console.log(response);
           // console.log(response.data);
           _this.items = response.data
           // items() = response.data;
            console.log(items);

           // return items;

          }  // reponse msg   */

     // }); //axios.get
} // get all items
} // methods

}

<!--    Vue.createApp(JumboApp).mount("#jumboapp") -->

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
var triggers = document.querySelectorAll('.faq-question');

triggers.forEach(function(trigger) {
    var targetId = trigger.getAttribute('href'); // e.g. "#faq7"
    var panel = document.querySelector(targetId);

    if (panel) {
        trigger.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            panel.classList.toggle('show');
        });
    }
});
});
</script>

<script>
let blinking_text = document.getElementById('blink_effect');
setInterval(function() {
blinking_text.style.visibility = (blinking_text.style.visibility == 'hidden' ? '' : 'hidden');
}, 500);
</script>
<style>#blink_effect {
color: darkgray;
font-size: 20 px;

}    </style>
<?php if(DEBUGGING == true): ?>
<!-- hx-get="https://dummyjson.com/users"
<button hx-get="#" hx-confirm="HTMX Installed!"> Test for HTMX</button>
<h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1> -->
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
