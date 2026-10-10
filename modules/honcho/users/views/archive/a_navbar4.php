
<!-- Begin Top Menu   -->

<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
        <div class="navbar-header">
         <!--   <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
         <ul class="nav navbar-top-links navbar-left">
        <li>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
             <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong> Home | <?= CCMP ?> Administration</strong></span>
            </a>
        </li>



  <!--      <li>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
             <span class="m-r-sm text-muted welcome-message"> <?= CCMP ?> Administration</strong></span>
            </a>
        </li>  -->  
     

        </ul>

        </div>
            <ul class="nav navbar-top-links navbar-left">


                <li>
                     <h2><strong> <?= SITENAME ?></strong></h2> 
                </li>

            </ul>        

            <ul class="nav navbar-top-links navbar-right">



            <!--    <li>
                    <span class="m-r-sm text-muted welcome-message"><strong> Welcome <?php echo($firstname); ?></strong></span>

                </li> -->


      <!--      <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-user"><strong> My Account</strong></i>  
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="mailbox.html">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="profile.html">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="float-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="grid_options.html">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li> -->
            <li>
                                <a>
                                       
                             <!--   <?= $_SESSION['ccmpmode'] ?> --><i class="fa fa-user"></i> (<?= $_SESSION['ccmp_username'] ?>) <!-- <?= $_SESSION['ccmp_first'] ?> -->

                             
                                </a>
                            </li>
                <li>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>

        </nav>


<!-- End Top Menu   -->