      <header class="side-menu header-side-menu navbar-white left" role="banner">
            <button type="button" class="btn-toggle side-menu-btn pull-right collapsed" data-toggle="collapse" data-target="#main-navbar-container">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
            </button>
            <div class="side-menu-wrapper">
            	 <center><h3>Member Services Portal</h3></center>
                <h1 class="logo text-center">
                    <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                       <img src="<?= BASE_URL ?>welcome_module/images/bpalogo125x103.jpg" alt="BPALogo"> 
                        
                    </a>
                </h1>
          <!--      <div id="header-search-form">
                    <form class="navbar-form">
                        <input type="search" id="s" name="s" class="form-control" placeholder="Search in here...">
                        <button type="submit" class="btn-circle" title="Search"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- End #header-search-form -->
                <center><h3><?= $_SESSION['chapter_name'] ?></h3></center>
                            <!--   <center><h3><?= SUBENTITY ?> </h3></center>  -->
                <nav>

                    <ul class="nav navbar-nav nav-stacked">
                        <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><i class="fa fa-home"></i>Home</a>
          
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" ><i class="fa fa-user"></i>My <?= CCMP ?> Data</a>
          
                        </li>

                        <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentroster"><i class="fa fa-list"></i><?= SUBENTITY ?> Roster</a>
          
                        </li>
                   <!--    <li>
                            <a href="<?= BASE_URL ?>welcome-ccmps/events"><i class="fa fa-calendar"></i>Events Calendar</a>
                        </li>  -->
                            
                        <li>
                            <a href="#"><i class="fa fa-chain"></i>Links<span class="angle"></span></a>
                            <ul>
                                <li>
                                    <a href="#" target="_blank"><i class="fa fa-laptop"></i> <?= SUBENTITY ?> Website</a>

                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i> <?= SUBENTITY ?> Facebook Page</a>
                                    <ul>
                                    <!--    <li><a href="header.html">Header - Version 1</a></li> -->

                                    </ul>
                                </li>
                                <li>
                                    <a href="https://www.bpapilots.org" target="_blank"><i class="fa fa-laptop"></i> National Website</a>
                                </li>  
                            </ul>
                        </li>
                     <!--   <li>
                            <a href="#"><i class="fa fa-rocket"></i>Future! <span class="angle"></span></a>
                            <ul>
 
                                <li>
                                    <a href="#"><i class="fa fa-users"></i> Chapter Features<span class="angle"></a>
                                    <ul>
                                        <li><a href="elements-tabs.html"><i class="fa f-dollar"></i> Auto Dues Payment</a></li>
                                        <li><a href="elements-tabs.html"><i class="fa f-dashboard"></i> My Dashboard</a></li>
                                        <li><a href="elements-tabs.html"><i class="fa f-shopping-cart"></i> Chapter Store</a></li>
                                        <li><a href="elements-tabs.html"><i class="fa f-camera"></i> Photo Gallery</a></li>
                                        <li><a href="#"><i class="fa f-comments-o"></i> Chapter Blog</a></li>
                                        <li><a href="#"><i class="fa f-youtube"></i> YouTube Channel</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pencil"></i> Registrations<span class="angle"></span></a>
                                    <ul>
                                        <li><a href="elements-tabs.html">Skyhook!</a></li>
                                         <li><a href="elements-tabs.html">General Meeting</a></li>
                                         <li><a href="elements-tabs.html">Board Meeting</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gears"></i> Management<span class="angle"></a>
                                    <ul>
                                         <li><a href="elements-tabs.html">Summer Flight Academy</a></li>
                                         <li><a href="elements-tabs.html">Skyhook Events & Scoring</a></li>
                                         <li><a href="elements-tabs.html">Admin Tasks</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-star"></i> Other Features<span class="angle"></a>
                                    <ul>
                                         <li><a href="elements-tabs.html">Integrated Public Website</a></li>
                                         <li><a href="elements-tabs.html">National Store</a></li>
                                         <li><a href="elements-tabs.html">Social Feed</a></li>
                                         <li><a href="elements-tabs.html">Member Chat</a></li>
                                         <li><a href="elements-tabs.html">Forums</a></li>
                                         <li><a href="elements-tabs.html">Endless Possibilities!</a></li>
                                    </ul>
                                </li>                                
                            </ul>
                        </li> -->
<?php if($_SESSION['chapteradmin'] == 1): ?> 

                        <li>
                            <a href="#"><i class="fa fa-gears"></i><?= SUBENTITY?> Admin<span class="angle"></span></a>
                            <ul>
                                <li>
                                        <a href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><i class="fa fa-users"></i> Manage Our <?= CCMPS ?></a> <!-- the 1 parameter  sets the session tab variable to 1 -->
                               
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-calendar"></i> Manage Events</a>

                                </li>  
                                <li>

                                         <a href="<?= BASE_URL ?>welcome-ccmps/lesxlsfile"><i class="fa fa-table"></i> <?= CCMP ?> Spreadsheet</a>

                          
                                </li>
                          <!--      <li>
                                <a href="<?= BASE_URL ?>welcome-ccmps/ccmpupload/momm"><i class="fa fa-table"></i> Upload  <?= CCMPS ?> from Excel</a>
                               
                                </li>    -->                        
                            </ul>
                        </li>

<?php endif; ?> 
<?php if($_SESSION['national_officer'] == 4): ?> 

                        <li>
                            <a href="#"><i class="fa fa-gears"></i> <?= CCMP ?> Admin<span class="angle"></span></a>
                            <ul>
                              
                  
                                <li>
                                        <a href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-users"></i> Current <?= CCMPS ?></a>
                               
                                </li>
                                              <li>
                                        <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster"><i class="fa fa-list"></i> Master Current Roster</a>
                               
                                </li>
                                <li>
                                        <a href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><i class="fa fa-users"></i> All <?= CCMPS ?></a>
                               
                                </li>
                                <li>
                                        <a href="<?= BASE_URL ?>welcome-ccmps/export"><i class="fa fa-table"></i> Master Spreadsheet</a>
                               
                                </li>
                                <li>
                                <a href="<?= BASE_URL ?>welcome-ccmps/ccmpupload/mamm"><i class="fa fa-table"></i> Upload  <?= CCMPS ?> from Excel</a>
                               
                                </li> 

                            </ul>
                        </li>

<?php endif; ?> 
                        <li><a href="<?= BASE_URL ?>welcome/logout/compccmp"><i class="fa fa-sign-out"></i>Logout</a></li> <!-- (<?= $_SESSION['ccmp_username'] ?>)  -->
                    </ul>
                    <br>
                    <?php if($_SESSION['chapteradmin'] == 1): ?> 
                        <h3><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?></h3>
                    <?php else: ?>
                        <p>Session Expired - Please Logout</p> 
                    <?php endif; ?> 
                </nav>
      
            <!-- left adjusted  -->


                <div class="mb200"></div>
                <div class="mb50"></div>

                <div class="row">
                    <div class="col-md-11">
                    in partnership with
                </div>
               <div class="mb30"></div>

                <div class="col-md-11">

                    <img src="<?= BASE_URL ?>welcome_module/images/encorelogo100x31.jpg" alt="EDALogo">
                   
                 </div>
                <div class="row"> 
                        <div class="col-md-6">
                <center> Digital Arts &copy; <?= $_SESSION['current_year']?></center>
                        </div>
                        <div class="col-md-7">
                        
                        </div>
                 </div>
                </div> 


                <!-- centered -->

            <!--    <div class="mb150"></div>
                <div class="row">
                    <div class="col-md-12">
                <center>in partnership with </center>
                </div>
                <div class="mb30"></div>
                    <div class="col-md-12">                       
                            <center><img src="<?= BASE_URL ?>welcome_module/images/encorelogo100x31.jpg" alt="EDALogo"> </center>
                     </div> 
                </div>                  
                    
                <div class="row"> 

                        <div class="col-md-12">
                        <center>Digital Arts </center>
                        </div>
                 </div> -->
            </div><!-- End .side-menu-wrapper -->
        </header><!-- end .side-menu -->