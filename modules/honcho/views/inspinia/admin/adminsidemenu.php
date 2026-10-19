
<nav class="navbar-default navbar-static-side" role="navigation">  <!-- white-bg  -->
<!-- <?php echo("inspinia/admins/menus/sidemenu.php"); ?> -->
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
               <li class="nav-header">
                    <div class="dropdown profile-element">    <!-- white-bg  -->
            <?php if(strlen($_SESSION['user_photo']) > 0): ?> <!--  if user pic -->
         <!--   <p> <?= $_SESSION['user_photo']  ?></p>
            <p> <?= $_SESSION['honcho_acct_rec_id']  ?></p> -->
                <div class="col-md-1">
<center><img alt="user picture" src="<?= BASE_URL?>honcho-users_module/<?= $_SESSION['honcho_acct_rec_id'] ?>/<?= $_SESSION['user_photo'] ?>"/> </center>
                </div> <!-- end col -->
            <?php else: ?> <!-- No pic  -->

            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
            <?php endif; ?>

        <!--    <img alt="user photo" class="rounded-circle" src="<?= BASE_URL ?>system_accounts_photos_thumbnails/<?= $_SESSION['system_acct_rec_id'] ?>/<?= $user_photo ?>"/> -->


                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo($whoisit); ?></span>
                            <span class="text-muted text-xs block">My Profile<b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!--    <li><a class="dropdown-item" href="profile.html">My Profile</a></li> -->
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $_SESSION['tg_user_id']?>">My Account</a></li>
                        <!--    <li><a class="dropdown-item" href="contacts.html">My Contacts</a></li> -->

                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>honcho/login">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <?= SHORTSITENAME ?>
                    </div>
                </li>   <!-- nav header -->
            <!--    <li class="active">
                    <a href="<?= BASE_URL ?>honcho"><i class="fa fa-dashboarfd"></i> <span class="nav-label">Dashboard</span><span class="float-right label label-primary">SPECIAL</span><span class="label label-info float-right">NEW</span><span class="label label-warning float-right">16/24</span><span class="label label-warning float-right">NEW</span></a>
                </li> -->
              <!--  <li class="active">
                    <a href="<?= BASE_URL ?>honcho"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li> -->


                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label"><?= CCMPS ?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                    <li>
                        <a id="toggleSpinner4" href="<?= BASE_URL ?>welcome-ccmpsaddresstypes/manage"><i class="fa fa-table"></i> Address Types</a>
                    </li>
               <!-- Financial Types hidden: ccmps_financial_types was never built (route blocked in Ccmpsfinancialtypes.php)
                    <li>
                        <a id="toggleSpinner4" href="<?= BASE_URL ?>welcome-ccmpsfinancialtypes/manage"><i class="fa fa-table"></i> Financial Types</a>
                    </li> -->

                    <li>
                        <a id="toggleSpinner4" href="<?= BASE_URL ?>welcome-ccmpsbulkactions/manage"><i class="fa fa-table"></i> Bulk Actions</a>
                    </li>
                    </ul>
                </li>
                <?php if(rbac_allowed('dms', 'view_library')): ?> <!-- DMS: Security Groups decide (RBAC step 4) -->
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">DMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage"><i class="fa fa-play"></i> Document Library</a></li>
                        <?php if(rbac_allowed('dms', 'view_kanban')): ?>
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/kanban"><i class="fa fa-play"></i> Kanban Board</a></li>
                        <?php endif; ?>
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmsfilelibraryaccess/manage"><i class="fa fa-play"></i> Library Access</a></li>
                        <?php /* Library Functions edited dms_filelibrary_functions, which nothing reads since RBAC step 4 (Security Groups decide). Retire with the old tables in step 6.
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmsfilelibraryfunctions/manage"><i class="fa fa-play"></i> Library Functions</a></li> */ ?>
                        <li>

                           <div id="ibox4" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>

                            </div>
                    </li>
                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibuser"><i class="fa fa-play"></i> Document Library</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><i class="fa fa-play"></i> DMS Admin</a></li>  -->

                    </ul>
                </li>
                <?php endif; ?> <!-- end DMS -->
                <?php if(rbac_allowed('pm', 'view_projects')): ?> <!-- Project Management System: Security Groups decide (false when PMS is switched off) -->
                <li>
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">PMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>pm"><i class="fa fa-play"></i> Projects</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li>
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">CMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a id="toggleSpinner4" href="<?= BASE_URL ?>welcome-ccmpsscopes/manage"><i class="fa fa-table"></i> Post Scopes</a>
                        </li>
                        <li>
                           <div id="ibox4" class="sk-spinner sk-spinner-wave" style="display: none;"> <!-- toggle none/show  -->

                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                    </li>
                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibuser"><i class="fa fa-play"></i> Document Library</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><i class="fa fa-play"></i> DMS Admin</a></li>  -->

                    </ul>
                </li>
                <!--
                <li>
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Website CMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/news/index"><i class="fa fa-play"></i> News</a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-comments"></i> Blog</a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-truck"></i> Online Store</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/ccmps/manage"><i class="fa fa-picture-o"></i> Homepage Slider</a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/contacts/manage"><i class="fa fa-calendar-o"></i> Events Calendar</a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-camera"></i> Photo Gallery</a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-play"></i> Videos</a></li>

                       </ul>
                </li>
          -->

            <?php if($_SESSION['useradmin'] == 1 ): ?>
                <li>
               <!--     <a href="#"><i class="fa fa-group"></i> <span class="nav-label">People</span><span class="fa arrow"></span></a> -->
                    <ul class="nav nav-second-level collapse">
                    <!--  <li><a class="submenu" href="<?= BASE_URL ?>honcho/ccmps_admin_menu"><i class="fa fa-user"></i> <?= CCMPS ?></a></li> -->
                      <li><a class="submenu" href="<?= BASE_URL ?>welcome-ccmps/manage/honcho/honchomngallccmps"><i class="fa fa-user"></i> All <?= CCMPS ?></a></li>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(HONCHO_MODULE == 1 && !empty($_SESSION['honcho_sysadmin'])): ?> <!-- members reach these in Honcho Lite (system_admin_only()) -->
                <li>
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">System Admin</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>system-settings/manage"><i class="fa fa-gears"></i> System Settings</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>system-auditlogger/manage/sysadmin"><i class="fa fa-table"></i> Auditlog</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>system-rbac/manage"><i class="fa fa-lock"></i> Security Groups</a></li>
                    </ul>
                </li>
            <?php endif; ?>
          <!--
                <li>
                    <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/ccmps/export"><i class="fa fa-table"></i> Master Sheet</a></li>
                    </ul>
                </li>
-->
        <!--
            <li>


                <a href="<?= BASE_URL ?>honcho/index/sysconfig/manage"><i class="fa fa-wrench"></i> <span class="nav-label">System Configuration</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#"> System Acct Tables<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">

                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i> Fin Acct Types</a></li>

                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i> Fin Acct Status</a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"> System Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i> Config Table</a></li>
                         <li>
                                <a href="#"> sys table 2</a>
                            </li>
                            <li>
                                <a href="#"> sys table 3</a>
                            </li>

                        </ul>
                    </li>
                 <li>
                        <a href="#"> <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#"> Audit Log</a>
                            </li>
                            <li>
                                <a href="#"> sys table 2</a>
                            </li>
                            <li>
                                <a href="#"> sys table 3</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>
-->
                      <!--          <li>
                        <a href="#"><i class="fa fa-lock"></i> <span class="nav-label">Security</span><span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">

                   <!--     <li><a class="submenu" href="<?= BASE_URL ?>honcho-users/manage"><i class="fa fa-group"></i> System Accounts</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/ccmps/manage"><i class="fa fa-camera"></i> Audit Log</a></li>   -->

   <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-list-ul"></i> User Levels</a></li> -->



                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-shield"></i> System Acct Access</a></li> -->


                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/system_accounts/manage"><i class="fa fa-group"></i> TG Users</a></li>

                           <!--   <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i> TG Administrators</a></li>
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i> TG Comments</a></li>
                        </ul>
                    </li>
           <li>
                                <li><a class="submenu" href="<?= BASE_URL ?>welcome/login" target="_blank" ><i class="fa fa-sign-in"></i> <?= CCMP ?> Login</a></li>

                </li>
                <li>
                                <li><a class="submenu" href="<?= BASE_URL ?>welcome" target="_blank" ><i class="fa fa-sign-in"></i> Public Website</a></li>

                </li> -->
            </ul>

        </div>
    </nav>
