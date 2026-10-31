<nav class="navbar-default navbar-static-side gray-bg" role="navigation">
<style>
#side-menu > li > a { /* admin menu: one line per item (2026-10-28); was 14px bold uppercase with letter spacing, which wrapped */
    font-family: 'Open Sans', helvetica, arial, sans-serif;
    font-weight: 600;
    font-size: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    white-space: nowrap;
    color: gray; /* same grey as the admin tiles' labels on the member home (ccmphome.php), 2026-10-28 */
}
#side-menu > li > a > i { width: 18px; } /* icons in one column */
#side-menu > li > a.navbar-minimalize { font-size: 13px; } /* Expand/Hide: smaller than the other items (2026-10-28) */
#side-menu > li > a.navbar-minimalize > i { width: auto; margin-right: 1px; } /* the < > pair sits close to the words */

.navbar-static-side .widget.style1.gray-bg {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 5px;
    padding-bottom: 5px;
}
</style>
    <div class="sidebar-collapse">
    <div class="dropdown profile-element">
          <?php if(strlen( $_SESSION['picture']) > 0): ?>
 <!-- <?= $_SESSION['ccmp_rec_id'] ?><?= $_SESSION['picture'] ?> -->

      <a href="<?= BASE_URL ?>welcome-ccmps/mydata" ><center><img alt="user picture" src="<?= BASE_URL ?>welcome-ccmps_module/assets/<?= $_SESSION['ccmp_rec_id'] ?>/<?= $_SESSION['picture'] ?>"/> </center></a>

          <?php endif; ?>
      <!--    <br> -->
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
<span style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; font-size:14pt" class="block m-t-xs font-bold"><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?></span>
<?php if(strlen( $_SESSION['call_sign']) > 0): ?>
<span style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; font-size:14pt" class="block m-t-xs font-bold">"<?= $_SESSION['call_sign'] ?>"</span>
<?php endif; ?>
<!-- custom BPA -->
<!-- <span class="block m-t-xs font-bold"><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?> "<?= $_SESSION['call_sign'] ?>"</span> -->

<span style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; font-size:8pt" class="block m-t-xs font-bold"><?= $_SESSION['subentity_name'] ?></span>
          </a>
    </div> <!-- end profile-element: was never closed, so the menu sat inside it and vanished when Expand/Hide collapsed the menu (2026-10-28) -->
        <ul class="nav metismenu" id="side-menu">



         <!--   <php if($_SESSION['national_officer'] == 1 ): ?> --> <!-- president -->

<?php
// Admin tile and admin menu only when at least one admin section below will show
// (Member, Chapter, System Admin, the Website content manager, trainer, or a honcho staff module flag).
// Chapter President alone (subentity_role 1) has no section, so it no longer opens an empty menu.
$has_admin_menu = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_admin'])
    || !empty($_SESSION['ccmps_subentity_admin']) || rbac_allowed('cms', 'manage_content') || rbac_allowed('cms', 'manage_events')
    || rbac_allowed('system', 'edit_financial_settings')
    || !empty($_SESSION['honcho_trainer']) || !empty($_SESSION['honcho_all_modules'])
    || !empty($_SESSION['honcho_ccmps_module_all']) || !empty($_SESSION['honcho_ccmps_module_ccmps'])
    || !empty($_SESSION['honcho_ccmps_module_subentities']) || !empty($_SESSION['honcho_ccmps_module_cms']);
if(!$has_admin_menu && $_SESSION['ccmpssidemenu'] == 'admin'){
    $_SESSION['ccmpssidemenu'] = ''; // roles removed since Admin was clicked - back to the member menu (ccmphome reads this too)
}
?>
<?php if($_SESSION['ccmpssidemenu'] == 'admin' && $has_admin_menu): ?>  <!-- buttons on sidemenu -->
            <li><a class="navbar-minimalize " href="#"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i><span class="nav-label"> Expand/Hide</span></a></li>
<!--  Only show Member Menu For honcho sysadmin or a ccmp user-->
             <?php if($_SESSION['honcho_all_modules'] == 1 || $_SESSION['ccmp_logged_in'] == 1): ?>  <!-- no member ccmphome for honcho admins -->
<li><a href="<?= BASE_URL ?>welcome-ccmps/ccmpmenu"><i class="fa fa-home"></i><span class="nav-label"> <?= CCMP?> Home</span></a></li>
                 <?php else: ?>


            <?php endif; ?>
<!--
            // superuser rights
            $_SESSION['ccmps_admin']           = admin
            $_SESSION['ccmps_subentity_admin'] = subentity_admin
            $_SESSION['ccmps_student_admin']   = student_admin
            $_SESSION['ccmps_cms_admin']       = cms_admin
            $_SESSION['ccmps_system_admin']    = system_admin

-->
<?php if($_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_ccmps'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?>

 <li> <a href="#"><i class="fa fa-users"></i><span class="nav-label"> <?= CCMP ?> Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
            <ul class="nav nav-second-level collapse">

                <li>


              <a id="toggleSpinner1" href="<?= BASE_URL ?>welcome-ccmps/manage/ccmp_admin"><i class="fa fa-users"></i> All <?= CCMPS ?> (<?=$_SESSION['total_ccmp_records'] ?>)</a>


                           <div id="ibox1" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>

                            </div>
                    </li>

                    <li>
                      <!--       <a href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-child"></i> Student <?= CCMPS ?>(<?= $_SESSION['num_all_current_student_members'] ?>)--></a>
                     <!--   <a href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-users"></i> Current <?= CCMPS ?> (<?= $_SESSION['num_all_current_members'] ?>)</a> -->
                    </li>

                </ul>
            </li>
<?php endif; ?>

            <?php if($_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_subentities'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?>



            <li> <a href="#"><i class="fa fa-building"></i><span class="nav-label"> <?= CCMPSSUBENTITY ?> Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>welcome-ccmps/manage/subentity_admin"><i class="fa fa-users"></i><?= CCMPSSUBENTITY ?> <?= CCMPS ?></a></li> <!-- manage subentity members-->
                    <?php if(rbac_allowed('cms', 'chapter_events') && !rbac_allowed('cms', 'manage_events')): ?> <!-- Event Admins find Events under Website -->
                    <li><a href="<?= BASE_URL ?>cms-content/events"><i class="fa fa-calendar"></i> <?= CCMPSSUBENTITY ?> Events</a></li>
                    <?php endif; ?>
                    <?php if(rbac_allowed('cms', 'chapter_posts') && !rbac_allowed('cms', 'manage_content')): ?> <!-- Content Admins find these under Website -->
                    <li><a href="<?= BASE_URL ?>cms-content/posts/sunshine"><i class="fa fa-heart"></i> Sunshine</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/bulletin"><i class="fa fa-thumb-tack"></i> Bulletin Board</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/job"><i class="fa fa-briefcase"></i> Careers</a></li>
                    <?php endif; ?>
                <!--    <li>
                      <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> </a>

                    </li> --> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) -->
                 <!-- --   <li><a href="<?= BASE_URL ?>dms-dmslibrary/manage/momads"><i class="fa fa-book"></i> <?= CCMPSSUBENTITY ?> Library</a></li> -->
                <li>    <a href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><i class="fa fa-file-text-o"></i>  Doc Library <span class="fa arrow"></span></a> </li>
                <?php if(rbac_module_enabled('ai') && rbac_allowed('ai', 'manage_chapter')): ?> <!-- the chapter's own AI connection (2026-10-29) -->
                <li><a href="<?= BASE_URL ?>ai/connections"><i class="fa fa-magic"></i> <?= CCMPSSUBENTITY ?> AI</a></li>
                <li><a href="<?= BASE_URL ?>ai/coffee"><i class="fa fa-coffee"></i> Coffee Report</a></li>
                <?php endif; ?>

                <!--    <li><a href="#"><i class="fa fa-list"></i> <?= CCMPSSUBENTITY ?> Info</a></li>  -->
                                 <li>
                            <a id="toggleSpinner3" href="<?= BASE_URL ?>welcome-ccmps/export/chapter"><i class="fa fa-table"></i> Export <?= CCMPS  ?></a>
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

<?php if(rbac_allowed('cms', 'manage_content') || rbac_allowed('cms', 'manage_events')): ?> <!-- content manager (cms-content): Content Admins, Event Admins and System Admins; replaces the old Content Admin screens (2026-10-20) -->
            <li> <a href="#"><i class="fa fa-globe"></i> <span class="nav-label"> <?= CMS_LABEL ?> </span><span class="fa fa-chevron-down"></span></a>
                <ul class="nav nav-second-level collapse">
                    <?php if(rbac_allowed('cms', 'manage_events')): ?>
                    <li><a href="<?= BASE_URL ?>cms-content/events"><i class="fa fa-calendar"></i> Events</a></li>
                    <?php endif; ?>
                    <?php if(rbac_allowed('cms', 'manage_content')): ?>
                    <li><a href="<?= BASE_URL ?>cms-content/sections"><i class="fa fa-list"></i> Page Sections</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/media"><i class="fa fa-picture-o"></i> Pictures</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/sunshine"><i class="fa fa-heart"></i> Sunshine</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/bulletin"><i class="fa fa-thumb-tack"></i> Bulletin Board</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/marquee"><i class="fa fa-ellipsis-h"></i> Marquee</a></li>
                    <li><a href="<?= BASE_URL ?>cms-content/posts/job"><i class="fa fa-briefcase"></i> Careers</a></li>
                    <?php endif; ?>
                </ul>
            </li>
<?php endif; ?>

<?php /* PMS hidden from members 2026-10-18: Pm.php check_permission() only accepts the staff login
         (authenticated), so a member was sent to honcho/logout. Staff reach it from adminsidemenu.php.
         Running PMS needs the Honcho staff module (decided 2026-10-18). A later member view of the
         kanban + own tasks is on the backlog. */ ?>
<?php if(false && ($_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1)): ?>
            <li> <a href="#"><i class="fa fa-tasks"></i><span class="nav-label"> PMS </span><span class="fa fa-chevron-down"></span></a> <!-- Project Management System - access per function is checked in modules/pm/Pm.php -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>pm"><i class="fa fa-folder-open"></i> Projects</a></li>
                </ul>
            </li>
<?php endif; ?>

<!-- <php endif; ?> -->
<?php if(!is_system_admin() && rbac_allowed('system', 'edit_financial_settings')): ?> <!-- Financial Admins: only the Financial tab of System Settings -->
            <li><a href="<?= BASE_URL ?>system-settings/manage/financial"><i class="fa fa-usd"></i> <span class="nav-label">Financial Settings</span></a></li>
<?php endif; ?>
<?php if(dues_engine_on() && (rbac_allowed('fin', 'settle_national_dues') || rbac_allowed('fin', 'manage_dues_settings') || (rbac_allowed('fin', 'record_chapter_dues') && !empty($_SESSION['ccmps_subentity_admin'])))): ?> <!-- Dues (fin, 2026-10-31) -->
            <li> <a href="#"><i class="fa fa-money"></i><span class="nav-label"> Dues </span><span class="fa fa-chevron-down"></span></a>
                <ul class="nav nav-second-level collapse">
                <?php if(rbac_allowed('fin', 'settle_national_dues')): $dues_attn = count(dues_attention_open()); ?>
                    <li><a href="<?= BASE_URL ?>fin/invoices"><i class="fa fa-file-text-o"></i> National Invoices</a></li>
                    <li><a href="<?= BASE_URL ?>fin/attention"><i class="fa fa-exclamation-triangle"></i> Needs Attention<?= $dues_attn ? ' ('.$dues_attn.')' : '' ?></a></li>
                <?php endif; ?>
                <?php if(rbac_allowed('fin', 'manage_dues_settings')): ?>
                    <li><a href="<?= BASE_URL ?>fin/settings"><i class="fa fa-sliders"></i> Dues Settings</a></li>
                <?php endif; ?>
                <?php if(rbac_allowed('fin', 'record_chapter_dues') && !empty($_SESSION['ccmps_subentity_admin']) && !empty($_SESSION['ccmps_subentity'])): ?>
                    <li><a href="<?= BASE_URL ?>fin/chapterdues/<?= (int) $_SESSION['ccmps_subentity'] ?>"><i class="fa fa-building"></i> <?= SUBENTITY ?> Dues</a></li>
                <?php endif; ?>
                </ul>
            </li>
<?php endif; ?>
<?php if($_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?>

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
<?php if($_SESSION['ccmps_system_admin'] == 1): ?> <!-- member system admins only, Honcho or not -->
                    <li>
                            <a href="<?= BASE_URL ?>welcome-ccmpspermissions/manage"><i class="fa fa-key"></i> <?= CCMP ?> Permissions </a>

                    </li>
<?php endif; ?>
                    <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/managefontsizes"><i class="fa fa-gears"></i> Font/Color Settings </a>

                    </li>
                    <li>
                            <a href="<?= BASE_URL ?>system-subentities/manage"><i class="fa fa-gears"></i> <?= SUBENTITIES ?> </a>

                    </li>
<?php if(rbac_module_enabled('ai') && (rbac_allowed('ai', 'manage_national') || rbac_allowed('ai', 'view_usage'))): ?> <!-- Honcho AI connections and usage (2026-10-29) -->
                    <li><a href="<?= BASE_URL ?>ai/connections"><i class="fa fa-magic"></i> AI Connections</a></li>
                    <li><a href="<?= BASE_URL ?>ai/coffee"><i class="fa fa-coffee"></i> Coffee Report</a></li>
<?php endif; ?>
             <!--   <li>
                    <a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a>
                </li> -->

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
                    <li>

                            <a id="toggleSpinner4" href="<?= BASE_URL ?>welcome-ccmps/ccmpsscopes/manage"><i class="fa fa-table"></i> CCMPS Scopes</a>
                           <div id="ibox4" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>

                            </div>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>help"><i class="fa fa-book"></i> Help &amp; Guides </a>

                    </li>

               <!--     <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/export"><i class="fa fa-table"></i> Master Spreadsheet</a>

                    </li>   -->

                </ul>
            </li>

<?php endif; ?>

<?php if( ENV == 'dev'): ?>
<!-- <php   $_SESSION['honcho_trainer'] = 1; ?>  still sees command if ? left in -->
<?php endif; ?>

<?php if($_SESSION['honcho_trainer'] == 1): ?>

            <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> Honcho Trainer </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">


                    <li>
                            <a href="<?= BASE_URL ?>honchodemo-simplecrud/manage"><i class="fa fa-gears"></i> Simple CRUD </a>
                    </li>

                    <li>
                            <a href="<?= BASE_URL ?>honchodemo-simplecrud/calendar"><i class="fa fa-gears"></i> Calendar </a>
                    </li>
                     <li>
                            <a href="<?= BASE_URL ?>honchodemo-simplecrud/evocalendar"><i class="fa fa-gears"></i> Evo Calendar </a>
                    </li>

               <!--     <li>

                            <a id="toggleSpinner4" href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin"><i class="fa fa-table"></i> Spinner</a>
                           <div id="ibox4" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                       <!--         <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>

                            </div>
                    </li>   -->



               <!--     <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/export"><i class="fa fa-table"></i> Master Spreadsheet</a>

                    </li>   -->

                </ul>
            </li>

<?php endif; ?>

<?php if($_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_ccmps_module_ccmps'] == 1): ?> <!-- no empty Reports menu; member reports can be added later -->
            <li> <a href="#"><i class="fa fa-file-text-o"></i><span class="nav-label"> Reports </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">


                <!--    <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster"><i class="fa fa-list"></i> National Roster</a>

                    </li> -->
                    <?php if($_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_ccmps_module_ccmps'] == 1): ?>
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
                    <?php endif; ?>
                </ul>
            </li>
<?php endif; ?> <!-- Reports -->



                    <?php if($_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_ccmps_module_ccmps'] == 1): ?>
<li><a href="<?= BASE_URL ?>honcho/index"><span class="nav-label">Back to honcho </span><i class="fa fa-sign-out"></i></a></li>
                    <?php else: ?>

                    <?php if(strlen($_SESSION['trongatetoken']) > 0): ?>
            <li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>

                    <?php else: ?>
                        <p>Session Expired - Please Logout</p>
                        <li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>

                    <?php endif; ?>


                    <?php endif; ?>

            <?php else: ?> <!--  Regular Member Menu  -->

<div class="row-fluid">
<br>
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                                <!-- the /1 is collapse #sets $_SESSION['ccmp_active_window'] so a failed validation will return to open the collapse -->
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/1">     <i class="fa fa-address-card-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i></a>
                            </div>
                            <div class="col-10 text-right">

                                <a href="<?= BASE_URL ?>welcome-ccmps/mydata/1" style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> My Profile</span> </a>
                             <!-- --   <a href="<?= BASE_URL ?>welcome-ccmps/mydata/1" style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:16pt"> My Profile</span> </a> -->
                            </div>
                        </div>
                    </div>

                    <div class="widget style1 gray-bg"> <!-- digital membership card (welcome-cards, 2026-10-26) -->
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-cards/mycard">     <i class="fa fa-qrcode fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i></a>
                            </div>
                            <div class="col-10 text-right">
                                <a href="<?= BASE_URL ?>welcome-cards/mycard" style="font-family: 'Open Sans', helvetica, arial, sans-serif; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> My Card</a>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($_SESSION['ccmp_logged_in']) && rbac_module_enabled('ai') && (int) setting('COFFEE_MEMBER_REPORTS', 0) === 1): ?>
                    <div class="widget style1 gray-bg"> <!-- the member's own Daily Coffee Report (ai/mycoffee, 2026-10-30) -->
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>ai/mycoffee">     <i class="fa fa-coffee fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i></a>
                            </div>
                            <div class="col-10 text-right">
                                <a href="<?= BASE_URL ?>ai/mycoffee" style="font-family: 'Open Sans', helvetica, arial, sans-serif; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> My Coffee Report</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>



                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentroster">     <i class="fa fa-list fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                    <a href="<?= BASE_URL ?>welcome-ccmps/currentroster" style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> Our Roster (<?= $_SESSION['num_current_chapter_members'] ?>)</span> </a>
                                <!-- --  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Our Roster (<?= $_SESSION['num_current_chapter_members'] ?>)</h2> </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory">     <i class="fa fa-address-card-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
 <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> Directory (<?= $_SESSION['num_current_members'] ?>)</span> </a>
                            <!-- --      <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Directory (<?= $_SESSION['num_current_members'] ?>)</h2> </a> -->
                            </div>
                        </div>
                    </div>

<?php if(false): ?> <!-- Chapters hidden 2026-10-21: its page (cms-ccmpschapters) was removed with the old CMS -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpschapters/viewpage" style="color:Gray;">
                           <!--      <a href="#" style="color:LightGray;"> -->
                                 <i class="fa fa-sitemap fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                              <!---        <h2 style="color:LightGray;"> <?= SUBENTITIES ?></h2> </a>  -->
<a href="<?= BASE_URL ?>cms-ccmpschapters/viewpage" style="font-family: 'Open Sans', helvetica, arial, sans-serif; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt"> <?= SUBENTITIES ?> (<?= $_SESSION['num_subentities'] ?>)</span> </a>
                             <!-- --     <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> <?= SUBENTITIES ?> (<?= $_SESSION['num_subentities'] ?>) </h2> </a> -->
                            </div>
                        </div>
                    </div>
<?php endif; ?>


<?php if(CMS_MEMBER_BULLETINS == 1): ?> <!-- members post their own sticky notes (cms-content, 2026-10-20) -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-content/posts/bulletin"><i class="fa fa-thumb-tack fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i></a>
                            </div>
                            <div class="col-10 text-right">
                                <a href="<?= BASE_URL ?>cms-content/posts/bulletin" style="font-family: 'Open Sans', helvetica, arial, sans-serif; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:11pt">My Sticky Notes</a>
                            </div>
                        </div>
                    </div>
<?php endif; ?>

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
<!-- was /manage/dmslibccmp  -->  <a href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibuser" style="color:Gray;">     <i class="fa fa-file-text-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Library</h2> </a>
                            </div>
                        </div>
                    </div>

               <!--    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                          <div class="col-2">
                            <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/<?= $id ?>/<?= $filename ?>/<?= $filetype ?>" style="color:Red;">     <i class="fa fa-newspaper-o fa-2x"></i>
                            </div>
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/1" style="color:Gray;" target="_blank">     <i class="fa fa-newspaper-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                           <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> ATIS</h2> </a>
                            </div>
                        </div>
                    </div> -->

               <!--     <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpssunshine/viewpage" style="color:Gray;">     <i class="fa fa-heart fa-2x" style="color: indianred;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Sunshine</h2> </a>

                            </div>
                        </div>
                    </div> -->

               <!--     <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" style="color:Gray;">     <i class="fa fa-pencil fa-2x" style="color: cornflowerblue;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> Register Me</h2> </a>
                            </div>
                        </div>
                    </div> -->


             <!--       <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/sponsors" style="color:Gray;">     <i class="fa fa-handshake-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Sponsors</h2> </a>
                            </div>
                        </div>
                    </div> -->


<?php if($has_admin_menu): ?> <!-- was also shown for Chapter President / Student / Content Admin, which have no admin-menu section -->

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/adminmenu" style="color:Gray;">     <i class="fa fa-gears fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> <?= SHORTSITENAME2 ?></h2> </a>
                            </div>
                        </div>
                    </div>

<?php endif; ?>

                    <div class="widget style1 gray-bg"> <!-- Help: the guides as web pages (2026-10-29) -->
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>help" style="color:Gray;">     <i class="fa fa-question-circle fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Help</h2> </a>
                            </div>
                        </div>
                    </div>

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome/logout/compccmp" style="color:Gray;">     <i class="fa fa-sign-out fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:12pt"> Logout</h2> </a>
                            </div>
                        </div>
                    </div>

</div> <!-- row-fluid  -->


<?php endif; ?> <!-- buttons on sidemenu   -->
        </ul>

    </div>

</nav>

<script>
// Explicit, version-agnostic sidebar-submenu toggling — not relying on
// the metisMenu plugin being correctly initialized (it requires an
// explicit $('#side-menu').metisMenu(); call somewhere in the theme's
// own JS, which this page has no direct control over and can't verify
// actually runs). Same underlying reasoning as the viewccmp.php tab
// fix: rather than depend on a specific plugin/Bootstrap version
// convention, handle the click directly and set the inline height
// style itself — style.css's own rule
// (.nav-second-level.collapse[style] { height: auto !important; })
// specifically keys off that inline style attribute, so this works
// regardless of which class convention (.in vs .show) the loaded
// Bootstrap version actually expects.
function initCcmpsSidebarToggles() {
    var toggles = document.querySelectorAll('#side-menu > li > a[href="#"]');
    toggles.forEach(function (link) {
        if (link.dataset.sidebarBound) return;
        link.dataset.sidebarBound = '1';

        var submenu = link.nextElementSibling;
        if (!submenu || !submenu.classList.contains('nav-second-level')) return;

        link.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            var isOpen = submenu.style.height && submenu.style.height !== '0px';
            if (isOpen) {
                submenu.style.height = '0px';
                submenu.style.overflow = 'hidden';
                submenu.classList.remove('in');
                submenu.classList.remove('show');
            } else {
                submenu.style.height = 'auto';
                submenu.style.overflow = 'visible';
                submenu.classList.add('in');
                submenu.classList.add('show');
            }
        });
    });
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCcmpsSidebarToggles);
} else {
    initCcmpsSidebarToggles();
}
</script>
