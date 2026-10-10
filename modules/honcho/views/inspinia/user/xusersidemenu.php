
<nav class="navbar-default navbar-static-side" role="navigation">
<!-- <?php echo("inspinia/admins/menus/sidemenu.php"); ?> -->
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                     <!--   <img alt="user photo" class="rounded-circle" src="<?= BASE_URL ?>honcho_module/assets/user_photos/<?= $user_photo ?>"/> -->
  <img alt="user photo" class="rounded-circle" src="<?= BASE_URL ?>public/system_accounts_photos_thumbnails/<?= $_SESSION['system_acct_rec_id'] ?>/<?= $user_photo ?>"/>
                      


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
                        AYMP
                    </div>
                </li>
            <!--    <li class="active">
                    <a href="<?= BASE_URL ?>honcho"><i class="fa fa-dashboarfd"></i> <span class="nav-label">Dashboard</span><span class="float-right label label-primary">SPECIAL</span><span class="label label-info float-right">NEW</span><span class="label label-warning float-right">16/24</span><span class="label label-warning float-right">NEW</span></a>
                </li> -->
                <li class="active">
                    <a href="<?= BASE_URL ?>honcho"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>                
                <li>
                    <a href="#"><i class="fa fa-folder-open"></i> <span class="nav-label">Doc Mgmt System</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a class="submenu" href="<?= BASE_URL ?>dms-dmslibrary/manage"><i class="fa fa-file"></i><span class="hidden-tablet"> Document Library</span></a></li>                
                   
                    </ul>
                </li>     

                </ul>
            </li>


            </ul>

        </div>
    </nav>