<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
            
             <!--       <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search"> -->
                </div>
                     <?php if(ENV == 'dev' AND  strlen($_SESSION['ccmpmode']) > 0): ?>                        
        
                <h3>  <span class="m-r-sm text-muted welcome-message"><strong> ccmpmode: <?= $_SESSION['ccmpmode'] ?></strong></span> </h3>
                            
                    <?php else: ?>
                                   
             
                    <?php endif; ?>              
            </form>

        </div>
            <ul class="nav navbar-top-links navbar-left">

 
                <li>
                     <span ><h2><strong><?= SITENAME ?></strong></h2></span> 
                   <!--   <h2><?php echo($site_name); ?></h2> -->
                </li>

            </ul>        

            <ul class="nav navbar-top-links navbar-right">
           <!--     <li>
                    <div class="text-center">
                        <a type="button" class="btn" data-toggle="modal" data-target="#myModal">
                            Change Password
                        </a>
                    </div>

                    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Change Password</h4>
                                    <small class="font-bold">Enter your current password and confirm a new one</small>
                                </div> 
                            <!-- Show flash message then reset it to blank  -->
                       <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> no way to refresh modal to see the message --
                           <center><h3 id="result" ></h3></center>

                             <form action="" method = "post">                                
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="crpass" id="crpass" value="<?= $crpass ?>" placeholder="Current Password" >
                                    </div>                                    
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password" >
                                    </div>  
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password" >
                                    </div>
                                    <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  --
                                        <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>"  hidden>
                                    </div>    
                                </div>
                                <div class="modal-footer">

<input type="button" value="Change Password"class="btn btn-primary block full-width m-b" name="ChangeID" id="ChangeBtn" ></input>

                                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </li> -->



                <li>
                    <div class="text-center">
                        <a type="button" class="btn" data-toggle="modal" data-target="#aModal">
                            Re-Login
                        </a>
                    </div>

                    <div class="modal inmodal" id="aModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Re-Login</h4>
                                    <small class="font-bold"></small>
                                </div>

                            <form class="m-t" method = "post" role="form" action="<?= BASE_URL ?>honcho/welcome">                                
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" value="<?= $username ?>" placeholder="Username"  required="">
                                    </div>
                                    <?php if($_SESSION['tg_user_level'] == 1) { ?> <!-- if you are a system administrator -->
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" value="<?= $password ?>" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label> <input type="checkbox" name="remember"> Remember Me </label>
                                        </div>
                                        <div class="form-group">
                                            <label> <input type="checkbox" name="emulate"> Emulate </label>
                                        </div>
                                   
                                    <?php }else{ ?>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" value="<?= $password ?>" placeholder="Password" required>
                                        </div>
                                     <?php } ?>  
                                 <!--   <p><strong>Please enter your current password and confirm a new password</strong></p>
                                    <div class="form-group"><label></label> <input name="current_pw" type="password" placeholder="Enter current password" class="form-control"></div>
                                    <div class="form-group"><label></label> <input name="new_pw" type="password" placeholder="Enter new password" class="form-control"></div>
                                    <div class="form-group"><label></label> <input name="confirm_new_pw" type="password" placeholder="Enter new password again" class="form-control"></div> -->

                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit">Login</button>
                                    <button type="button" class="btn btn-danger full-width m-b" data-dismiss="modal">Cancel</button>

                                <!--    <a href="#"><small>Forgot password?</small></a>
                                    <p></p>
                                    <p class="text-muted text-center"><small>Do not have an account?</small></p>
                                    <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                                    <p></p>
                                    <p></p>
                                    <a href="<?= BASE_URL ?>welcome"> <button type="button" class="btn btn-success block full-width m-b">Go to Website</button></a> -->
                                  
                                 <!--   <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button> -->
                                <!--    <button type="button" class="btn btn-primary">Save New Password</button> -->
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </li>

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
                    <a href="<?= BASE_URL ?>honcho/logout">
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
