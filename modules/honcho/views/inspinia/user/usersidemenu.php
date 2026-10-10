
<nav class="navbar-default navbar-static-side" role="navigation">  <!-- white-bg  -->
<!-- <?php echo("inspinia/admins/menus/sidemenu.php"); ?> -->
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
               <li class="nav-header"> 
                    <div class="dropdown profile-element">    <!-- white-bg  -->
            <?php if(strlen($_SESSION['user_photo']) > 0): ?> <!--  if user pic -->
                <div class="col-md-1">          
<center><img alt="user picture" src="<?= BASE_URL?>honcho-users_module/<?= $_SESSION['honcho_acct_rec_id'] ?>/<?= $_SESSION['user_photo'] ?>"/> </center>
                </div> <!-- end col -->
            <?php else: ?> <!-- No pic  -->
            <?php endif; ?>
            
        <!--    <img alt="user photo" class="rounded-circle" src="<?= BASE_URL ?>system_accounts_photos_thumbnails/<?= $_SESSION['system_acct_rec_id'] ?>/<?= $user_photo ?>"/> -->                    


                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo($whoisit); ?></span>
                            <span class="text-muted text-xs block">My Profile<b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!--    <li><a class="dropdown-item" href="profile.html">My Profile</a></li> -->
                         <!--   <li><a class="dropdown-item" href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $_SESSION['tg_user_id']?>">My Account</a></li> -->
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>honcho-users/mydata">My Account</a></li>

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
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">DMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage"><i class="fa fa-play"></i><span class="hidden-tablet"> Document Library</span></a></li>          
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/kanban"><i class="fa fa-play"></i><span class="hidden-tablet"> Kanban Board</span></a></li>          
                        
                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibuser"><i class="fa fa-play"></i><span class="hidden-tablet"> Document Library</span></a></li>          
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><i class="fa fa-play"></i><span class="hidden-tablet"> DMS Admin</span></a></li>  -->        
                   
                    </ul>
                </li>  
                
                <!--
                <li>
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Website CMS</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/news/index"><i class="fa fa-play"></i><span class="hidden-tablet"> News</span></a></li> 

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-comments"></i><span class="hidden-tablet"> Blog</span></a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-truck"></i><span class="hidden-tablet"> Online Store</span></a></li>                         
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/ccmps/manage"><i class="fa fa-picture-o"></i><span class="hidden-tablet"> Homepage Slider</span></a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/contacts/manage"><i class="fa fa-calendar-o"></i><span class="hidden-tablet"> Events Calendar</span></a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-camera"></i><span class="hidden-tablet"> Photo Gallery</span></a></li>

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-play"></i><span class="hidden-tablet"> Videos</span></a></li> 

                       </ul>
                </li>
          -->
                
            <?php if($_SESSION['useradmin'] == 1 ): ?>                                         
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label">People</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    <!--  <li><a class="submenu" href="<?= BASE_URL ?>honcho/ccmps_admin_menu"><i class="fa fa-user"></i><span class="hidden-tablet"> <?= CCMPS ?></span></a></li> -->
                      <li><a class="submenu" href="<?= BASE_URL ?>welcome-ccmps/manage/honcho/honchomngallccmps"><i class="fa fa-user"></i><span class="hidden-tablet"> All <?= CCMPS ?></span></a></li>  
                   
                    </ul>
                </li>
            <?php endif; ?>
          <!--     
                <li>
                    <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/ccmps/export"><i class="fa fa-table"></i><span class="hidden-tablet"> Master Sheet</span></a></li>
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

                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Fin Acct Types</span></a></li>

                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Fin Acct Status</span></a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"> System Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Config Table</span></a></li>
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
                                <li>
                        <a href="#"><i class="fa fa-lock"></i> <span class="nav-label">System Admin</span><span class="fa arrow"></span></a>
                     
                        <ul class="nav nav-second-level">

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho-users/manage"><i class="fa fa-group"></i><span class="hidden-tablet"> User Accounts</span></a></li>

                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-shield"></i><span class="hidden-tablet"> System Acct Access</span></a></li> -->

                        <li><a class="submenu" href="<?= BASE_URL ?>honcho-auditlog/manage"><i class="fa fa-camera"></i><span class="hidden-tablet"> Audit Log</span></a></li>

                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-list-ul"></i><span class="hidden-tablet"> User Levels</span></a></li> -->

                    <!--    <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/system_accounts/manage"><i class="fa fa-group"></i><span class="hidden-tablet"> TG Users</span></a></li> -->

                           <!--   <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> TG Administrators</span></a></li> 
                        <li><a class="submenu" href="<?= BASE_URL ?>honcho/index/companies/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> TG Comments</span></a></li> -->
                        </ul>
                    </li>     
             <!--   <li>
                                <li><a class="submenu" href="<?= BASE_URL ?>welcome/login" target="_blank" ><i class="fa fa-sign-in"></i><span class="hidden-tablet"> <?= CCMP ?> Login</span></a></li>
  
                </li> -->
                <li>
                                <li><a class="submenu" href="<?= BASE_URL ?>welcome" target="_blank" ><i class="fa fa-sign-in"></i><span class="hidden-tablet"> Public Website</span></a></li>
  
                </li>
            </ul>

        </div>
    </nav>