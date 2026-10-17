<?php $_SESSION['release_version'] = "honcho Core &copy; 2024 - v1.0"; ?>

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
<div id="page-wrapper" class="white-bg"> 
           
 <!--   <div id="page-wrapper" class="bg-primary"> -->
<!-- <div class="row border-bottom bg-primary"> -->
  <!--   <div class="row border-bottom blue-bg"> -->
    <div class="row border-bottom gray-bg"> 
    <!--    <div class="row border-bottom white-bg"> -->

        <div class="col-sm-4"> 

        <br>
        <br>
        <?php if($_SESSION['mobileformat'] == 1 ): ?>
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        <?php endif; ?>
        <br>
  
         <ul class="nav navbar-top-links navbar-right">
                           
            <!--    <a class="navbar-minimalize minimalize-styl-2 btn btn-outline btn-navy" href="#"><i class="fa fa-caret-left"></i> Close </a> -->
      

             
                <?php if($_SESSION['device_type'] == 2 ): ?>
       
                <?php else: ?> 
                    <?php if( ENV == 'dev'): ?>                        
                            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">                
                                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong> <?= CCMP ?> Services Portal <?= $_SESSION['ccmpmode'] ?></strong></span>  <!-- <?= $_SESSION['chapter_name'] ?> -->
                            </a>
                    <?php else: ?>
                            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">                
                                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong> <?= CCMP ?> Services Portal</strong></span>  <!-- <?= $_SESSION['chapter_name'] ?> -->
                            </a>             
             
                    <?php endif; ?>
              <?php endif; ?>

            <li class="dropdown">
               
            <!--    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                   <strong> <i class="fa fa-gears"></i>  Settings </strong>
                </a> -->

            </div>
          
    
  <div class="col-sm-4"> 
              <!--    <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><h1> Black Pilots of America</h1></a> -->

  <!-- Green --> <!-- <h1><span class="text-navy"><strong><?= SITENAME ?></strong></span></h1> -->
  <!-- Blue --> <!--   <span class="m-r"><a href="#"><h1><strong><?= SHORTSITENAME ?> <?= CCMP ?> Services Portal</strong></h1></a> </span> -->
  <!-- Blk or White --><!--    <a class="btn " href="<?= PUBLIC_WEBSITE ?>" target="_blank"><h1><strong><?= CCMP ?> Services Portal</strong></h1></a> -->  <!-- white  if bg set to a color otherwise black -->
       
 <?php if($_SESSION['device_type'] == 2 ): ?>
            
    
             
                  <center>       <h3>     <a href="<?= PUBLIC_WEBSITE ?>" target="_blank" title="BPA">
                               <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo"> 
                       <!--    <img src="<?= BASE_URL ?><?= SMALL_LOGO ?>" alt="Small Logo">  -->  <!-- bpalogo169x50.jpg  -->
                             <!--    <img src="<?= BASE_URL ?>welcome_module/images/bpalogo169x50.jpg" alt="Logo"> 
                               <!--     <img src="<?= BASE_URL ?><?= PLAIN_LOGO ?>" alt="Plain Logo"> -->                      
                                        
                          </a> </h3>
                     
                     <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color:Black;"><h1><!--<img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">--><strong><?= SITENAME ?> </strong></h1></a> </span> <!-- <?= CCMP ?> Services Portal -->
              
                  </center>
                     <?php else: ?> 

       <br>
              <ul>   
                  <br>
             <!--   <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color:Black;"><h1><!--<img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">--><!-- <strong><?= SITENAME ?> </strong></h1></a> </span> -->  <!-- <?= CCMP ?> Services Portal -->
           <!--    <span style=" color: coral; font-size: 32px;">x<?= SITENAME ?></span>      -->
            <!--    <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME ?> </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME2 ?> </span> </a> </span> -->
            <!-- custom  -->
            <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">S</span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">GAP </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"> EMS</span> </a> </span> <!-- <?= SITENAME2 ?> -->
                  <h3>  <?= flashdata('<div style="font-weight: bold; color: orange; font-size: 13pt">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?>  </h3>
              </ul>
      
      
            <?php endif; ?> 
 </div> 

     <!--   </div> -->

 <div class="col-sm-4">      
<br>
 <?php if($_SESSION['device_type'] == 2 ): ?>
   <?php else: ?> 
<nav class="navbar" role="navigation" style="margin-bottom: 0">

    <ul class="nav navbar-top-links navbar-right">
            <?php if($_SESSION['emulating'] == 1 ): ?>
                <br>
                <br>
             
                <br>
                <br>
                <li>
                <a href="<?= BASE_URL ?>welcome/logout" type="button" class = "btn btn-default  btn-xs" style="font-weight: bold; color: red; font-size:14pt"> End Emulation  </a>
                 </li>
            <?php else: ?> 
                 <li>
                    <a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><span class="m-r-sm text-muted welcome-message"><i class="fa fa-user"></i> [<span style="color: <?= NB_CLR ?>" ><?= $_SESSION['ccmp_username'] ?></span>] </span></a>
                </li>
                <?php if($_SESSION['honcho_logged_in'] == 1): ?>
                    <li>
                        <a href="<?= BASE_URL ?>honcho/logout">
                         <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                        </a>
                    </li>
                 <?php else: ?>
                    <li>
                        <a href="<?= BASE_URL ?>welcome/logout">
                         <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                        </a>
                    </li>                    
                    
                 <?php endif; ?> 
                
            <?php endif; ?> 

            </ul>

    </nav>

<?php endif; ?> 
</div> 
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

 
<?php if($_SESSION['ccmps_cms_admin'] == 1): ?> 
            <li> <a href="#"><i class="fa fa-gears"></i> <span class="nav-label"> Content Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/cmsadmin"><i class="fa fa-ellipsis-h"></i> Marquee</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjumbotron/manage/cmsadmin"><i class="fa fa-window-maximize"></i> Jumbotron</a></li>
                    <li><a href="<?= BASE_URL ?>cms-bulletinboard/manage/cmsadmin"><i class="fa fa-thumb-tack"></i> Bulletin Board</a></li>  
                    <li><a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/cmsadmin"><i class="fa fa-podcast"></i> Notices</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjobs/manage/cmsadmin"><i class="fa fa-plane"></i> Job Posts</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/cmsadmin"><i class="fa fa-calendar"></i> Activities</a></li>
                    <li><a href="<?= BASE_URL ?>dms-dmslibrary/manage"><i class="fa fa-file-text-o"></i> Doc Library</a></li>     
                    <li><a href="#"><i class="fa fa-list"></i> <?= SUBENTITIES ?> ($_SESSION['num_chapters'])</a></li>
                <li>
                    <a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a>
                </li>                                                             
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
                                 
            <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> Chapter Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>welcome-ccmps/manage/mngsubentity"><i class="fa fa-users"></i>Chapter <?= CCMPS ?></a></li>
                <!--    <li>
                      <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> </a>

                    </li> --> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) -->
                <!--    <li><a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/momads"><i class="fa fa-ellipsis-h"></i> Chapter Marquee</a></li>  -->                 
                    <li><a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/momads"><i class="fa fa-thumb-tack"></i> Chapter Bulletins</a></li> 
                    <li><a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/momads"><i class="fa fa-podcast"></i>Chapter Notices</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjobs/manage/momads"><i class="fa fa-plane"></i> Job Posts</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/momads"><i class="fa fa-calendar"></i>Chapter Activities</a></li>
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


                    <li>
                            <a href="<?= BASE_URL ?>system-settings/manage"><i class="fa fa-gears"></i> System Settings </a>
                   
                    </li> 
                <li>
                    <a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a>
                </li>

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
                                  <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> My Chapter Roster (<?= $_SESSION['num_current_chapter_members'] ?>)</h2> </a>  
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

                   <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                         <!--   <div class="col-2">
                            <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/<?= $id ?>/<?= $filename ?>/<?= $filetype ?>" style="color:Red;">     <i class="fa fa-newspaper-o fa-2x"></i> 
                            </div>  -->                            
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/1" style="color:Gray;" target="_blank">     <i class="fa fa-newspaper-o fa-2x" style="color: cornflowerblue;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: cornflowerblue; font-size:14pt"> ATIS</h2> </a>  
                            </div>
                        </div>
                    </div> 

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

 

<?php if(ENV == '' || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['ccmps_cms_admin'] == 1 || $_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_student_admin'] == 1 || $_SESSION['national_officer'] == 1  || $_SESSION['national_officer'] == 2  || $_SESSION['national_officer'] == 3  || $_SESSION['national_officer'] == 4  || $_SESSION['national_officer'] == 5   || $_SESSION['national_officer'] == 6 || $_SESSION['national_officer'] == 7 || $_SESSION['chapter_role'] == 1): ?>

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
<div class="scroll_content">


        <!--  Begin Dashboard Panel Body --> 
    <!--    <div class="panel panel-success">  blue background--> 
        <div class="panel">
        
        <!--   <div class="panel-heading" style="color:Black;">
                <center> <h1><strong><?= CCMP ?> Services Portal</strong> </h1></center>
            </div> -->
<!-- <div class="panel-body"> -->

    <div class="row vertical-align">
        
         <div class="col-12">
            
      <!--      <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> -->
<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>
    <!-- dont show the marquee -->
<?php else: ?> 
     <br>
        <marquee behavior="scroll" scrollamount="13" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> 
                                   <!--      <h2 style="color:darkgoldenrod;">

                                    A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to: Kansas City Blackhawks <span style="color: Tomato;"><strong>Jordan Watson</strong></span> Private Pilot <span style="color: Tomato;"><strong>Vincent Lewis</strong></span> First Solo and <span style="color: Tomato;"><strong>John Kemp</strong></span> Long X-Country! Also <span style="color: Tomato;"><strong> My Man </strong></span> Top Gun 2023! <span style="color: Tomato;"><strong> Michael Youngblood </strong></span> 1st Place Flour Bomb Drop <span style="color: Tomato;"><strong> Roscoe Draper </strong></span> 104th Birthday! <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>

                                    </h2>-->
                             
                                    <h2 style="color:darkgoldenrod;">

                                    A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to:
                                    <?php
                                        foreach($marqueedata as $row) { ?>

                                        <span style="color: <?= SN2_CLR ?>;"><strong><?= $row->title ?> </strong><small><?= $row->subentity ?></small></span> <?= $row->info1 ?>
                                       
                                
                                    <?php } ?> 

                                     <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>
                                </h2>
        </marquee>
<?php endif; ?>         
            </div>

        </div> <!-- End row  -->
 


        </div> <!-- End row  --> 
 <!-- <hr> -->

<div class="row wrapper border-bottom white-bg page-heading">
                    
       <div class="col-md-3">
        </div>    
                    <div class="col-md-1">
                           
                    <h3>     <a href="<?= PUBLIC_WEBSITE ?>" target="_blank" title="BPA">
                            <!--   <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">-->                    
                                        
                                        </a> </h3>
                            </div>
                            <div class="col-md-3">

                        <!--   <br> -->
<center>
                            <?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?> 
                                <!--Blue   --> <a href="#"><h1 style="color: CCMPS_DBRD_HDR_CLR;"><strong> Administrator's Dashboard</strong></h1>  
                            <?php else: ?> <!--  Regular <?= CCMP ?> Menu  -->
                                <!--Blue   --> <a href="#"><h1 style="color: <?= CCMPS_DBRD_HDR_CLR ?>;"><strong><?= $_SESSION['subentity_title'] ?><br> <?= CCMP ?>'s Dashboard </strong> </h1>  
                            <?php endif; ?>   <!-- <?= CCMP ?>  -->

                            </h1>

                        </a>
</center>

                             <!--   <a href="#"><h2><strong><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?> </h2></a> -->


                          <!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
                            </div>
 <div class="col-md-2">
<!--   <br> -->
                        <?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?> 
                       <!--     <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/admindashboard.jpg" alt="control panel"> -->
                        <?php else: ?> <!--  Regular <?= CCMP ?> Menu  -->
                      <!--      <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/controlpanel.jpg" alt="control panel"> -->
                        <?php endif; ?> 

<!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
                            </div>

</div> <!-- End row -->
                        <!--    <= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> -->
 
         
<div class="col-lg-12">
<!--    <hr> -->



<!-- WHICH SIDEMENU   -->
 
<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>  <!-- buttons on sidemenu -->  
<!-- Dont show buttons   -->
<!-- <php else: ?> -->
<!-- Show buttons   -->  

<?php if($_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['subentity_role'] == 1 || $_SESSION['honcho_ccmps_module_subentities'] == 1): ?>      
    <br>
    <?= SUBENTITY ?> Administration ggg
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

<?php if($_SESSION['ccmps_cms_admin'] == 1 || $_SESSION['honcho_ccmps_module_cms'] == 1): ?>
 <!-- <hr> -->
 <br>
Content Administration
  <div class="row"> 

                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/cmsadmin" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-ellipsis-h fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Marquee</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsjumbotron/manage/cmsadmin" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-th-list fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Jumbotron</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 
       
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/cmsadmin" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-thumb-tack fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Bulletins</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/cmsadmin" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-podcast fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Notices</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 
                      <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/cmsadmin" style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-calendar fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Activities</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                <!--     <div class="widget style1 white-bg"> -->
                    <div class="widget style1 gray-bg"> 
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>dms-dmslibrary/manage"style="color:cornflowerblue; font-size:18pt">     <i class="fa fa-file-text-o fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                 <h2 style="font-weight: bold; color: gray; font-size:16pt"> Doc Library</h2> </a> 
                                <!--    <h2 style="color:LightGray;"> Sponsors</h2> </a>  -->
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




<!--  <?php if($_SESSION['ccmps_admin'] == 1 AND $_SESSION['ccmps_system_admin'] == 1 ): ?>   -->
<?php if($_SESSION['ccmps_admin'] == 1): ?> 
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
System Administration xxx
 <div class="row"> 

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
<!--  <?php if($_SESSION['ccmps_admin'] == 1 AND $_SESSION['ccmps_system_admin'] == 0 ): ?>  -->
<?php if($_SESSION['ccmps_admin'] == 1): ?>
     <hr>
<?= CCMP ?> Administration ccc
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
            <div class="panel-heading">
            <!--    Click Item to Open\Close -->
        <!--   <center><div style="font-weight: bold; color: gray; font-size:25pt"><?= CCMP ?> Dashboard</div></center> -->
        <!--   <center>    <i class="fa fa-dashboard fa-3x"></i> <h1><strong><?= CCMP ?> Dashboard</strong></h1> </center> -->
            </div>
            <div class="panel-body">

                 <div>
<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">


<center><a data-toggle="collapse" href="#faq8" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-podcast fa-1x"></i></span><strong> Radar</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <?php if($_SESSION['hometab'] == 8 || CCMPS_HM_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq8" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq8" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                  
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
        <div class="col-9">
 <br> 
        <div class="jumbotron">
            
        <marquee class="blink" behavior="scroll" scrollamount="0" direction="down" >  
                            <h1>What's Goin' On!</h1> 
        </marquee>            
 <br /> 
        <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> 
            <?php foreach($jumbotrondata as $row) { ?>                           

                <h2><strong><?= $row->title ?> </strong> <?= $row->location ?> <strong><?= $row->info1 ?></strong> <?= $row->info2 ?> <?= $row->info3 ?> <?= $row->info4 ?> <?= $row->info5 ?> <?= $row->info6 ?> <a href="<?=$row->extlink ?>" target="_blank"><u><?=$row->extlinklabel ?></u></a> <a href="<?= BASE_URL ?>dms-dmslibrary/downloaddoc/<?=$row->libid ?>?>" target="_blank"><u><?=$row->libdoclinklabel ?></u></a></h2>
            
            <?php } ?> 
        </marquee>
            
            
   <!--     <div id="jumboapp"> 

        <marquee class="blink" behavior="scroll" scrollamount="0" direction="down" >  
                            <h1>{{ jumbotronheader }}</h1> 
         </marquee>
 
            <br /> 
                <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> 
                    
                    <div v-for="item in items" > 
                                           
                    <h2><strong>{{ item.title }} </strong> {{ item.location }} <strong>{{ item.info1 }}</strong> {{ item.info2 }} {{ item.info3 }} {{ item.info4 }} {{ item.info5 }} {{ item.info6 }} <a href="{{ item.extlink }}" target="_blank"><u>{{ item.extlinklabel }}</u></a></h2>
                    
                    </div>
                    


                </marquee>
 
         
        </div>  end of jumboapp   -->

   </div> <!-- End jumbotron  -->


        </div> <!-- Endcol-9  -->

        <div class="col-2">
             <br> 
 <a href="<?= PUBLIC_WEBSITE ?>" target="_blank" title="BPA">

    <img src="<?= BASE_URL ?>cms-ccmpsjumbotron_module/images/<?= $jumbotronimg ?>" alt="<?= $jumbotronimg ?>"> 
         
 </a> 

        </div>  <!-- end col-2 -->
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
                </div><!-- End faq-item 1  -->

 

<!--  Begin Accordian Section -->
                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">
                                   <?php if($_SESSION['new_notice'] == 1): ?>
                                      <center><a data-toggle="collapse" href="#faq2" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-newspaper-o fa-1x"></i></span><strong> News <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/newimg.png" alt="new img"></strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                     
                                   <?php else: ?>
                                       <center><a data-toggle="collapse" href="#faq2" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-newspaper-o fa-1x"></i></span><strong> News</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                      
                                   <?php endif; ?> 
                                       
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 2 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq2" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq2" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                    
                                    <!--    <div id="faq2" class="panel-collapse collapse"> -->
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox "> 
  

        <div class="wrapper wrapper-content animated fadeInUp"> 
            <br>
            <div class="row"><!-- ROW OF NOTICES  -->

                <?php foreach($ntcdata as $row) { ?>

                 <div class="col-md-3">
                    <div class="ibox">         
                        <div class="ibox-content product-box">


                            <div class="product-desc">
<ul class="nav metismenu" > <!-- keeps bullets from showing up -->                           
                        <li>
                            <div>
                                <?= $row->created_at ?> 
                             <p class="text-muted">For <?= $row->scope ?></p>

                              <h2 style="color:CornFlowerBlue;" ><?= $row->title ?></h2>
                              <h3>  <?= $row->shortdescription ?> </h3>
                                <?php if(strlen($row->cost) > 0): ?>
                                   
                              <p>  <strong>Cost</strong> <?= $row->cost ?> </p>
                                 
                                <?php else: ?>
                                <?php endif; ?>

                             <!--    <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>   -->                                 
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact</strong> <?= $row->contact_info ?>
                                <?php endif; ?>  

                            <!--    <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  --> 
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:CornFlowerBlue;" href="<?= BASE_URL ?>cms-ccmpsnotices/fullnotice/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>
</ul>
  </div> <!-- class="product-desc"  -->
                        </div> <!-- class="ibox-content product-box" -->
                        
                    </div> <!-- class="ibox"  -->
   
                 </div> <!--  class="col-md-3"  -->

                        <?php } ?> 




                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF NOTICES SECTION -->



<!--  ****************************************************************************** -->

                </div> <!-- END Ibox content END OF CONTENT OF SECTION -->
               </div> <!-- ibox   -->                
                </div> <!-- faq answer-->                              
                            
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->

                </div>
                </div><!-- row   -->
                </div><!-- class md-col-12  -->

                </div><!-- row   --> 
                </div><!-- faq item   -->             

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">
                                   <?php if($_SESSION['new_bulletin'] == 1): ?>
                                      <center><a data-toggle="collapse" href="#faq3" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-thumb-tack fa-1x"></i></span><strong> Bulletins <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/newimg.png" alt="new img"></strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                     
                                   <?php else: ?>
                                       <center><a data-toggle="collapse" href="#faq3" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-thumb-tack fa-1x"></i></span><strong> Bulletin Board</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                      
                                   <?php endif; ?>    
                                    
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 3 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq3" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq3" class="panel-collapse collapse">
                                    <?php endif; ?> 

                                  
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
                                    <!--       <div class="ibox-content">  want gray backround -->
                                        <!-- BEGINNING OF CONTENT FOR SECTION  -->
                                        <!--  ****************************************************************************** -->
                <div class="wrapper wrapper-content animated fadeInUp">
                <div class="row">
                 <div class="col-lg-12">
                    <ul class="notes">

                        <?php foreach($adsdata as $row) { ?>
                        <li>
                            <div>
                              <?= $row->poster ?> <?= $row->created_at ?>

                               <h4><?= $row->title ?></h4>
                                <?= $row->shortdescription ?>
                                <?php if(strlen($row->cost) > 0): ?>
                                    <br>  
                                    <strong>Price</strong> <?= $row->cost ?>
                                <?php else: ?>
                                <?php endif; ?>

                                <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>                                       
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact Me</strong> <?= $row->contact_info ?>
                                <?php endif; ?>

                                <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:CornFlowerBlue;" href="<?= BASE_URL ?>cms-ccmpsbulletinboard/fullbulletin/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>

                        <?php } ?> 

                    </ul>
                </div>
            </div>
            </div> <!-- End of items  -->

            <!--  ****************************************************************************** -->
        <!--    </div> --><!-- ibox content   -->
            </div> <!-- ibox -->                                
            </div> <!-- End Tab 1 Panel -->
            </div><!-- faq#   -->
            </div><!-- col 12  -->
            </div><!-- row   -->
            </div>
            </div>
            </div><!-- End faq-item  -->  

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section --

                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq4" class="faq-question" style="color:CornFlowerBlue;"><strong>Photos & Videos <span class="fa fa-caret-down"></span></strong></a>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq4" class="panel-collapse collapse">
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
            
                                                    <!--    <div class="ibox-content"> white background --
                    <!--  ****************************************************************************** --
                    <div class="row">
                    <div class="col-md-3 mb40">


                    </div>

                     <div class="col-md-4">
                        <br>
                         <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/Trvo5PQWwdw" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   --
                        </div>    
                    </div>
    
                    <div class="col-md-4">
                        <br>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/wixm0fN1QD0" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   --
                        </div> 
                

                    </div>
                    <div class="col-md-1">

                    </div>
                </div>

                <!--  ****************************************************************************** --
         
                </div><!--ibox   --       
                </div> <!-- faq answer--                                 
                </div> <!-- End Tab 1 Panel --
                </div><!-- faq#   --
                </div><!-- col 12  --
                </div><!-- row   --
                </div>
                </div>
                </div><!-- End faq-item  --

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->
                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">
                                   <?php if($_SESSION['new_job'] == 1): ?>
                                      <center><a data-toggle="collapse" href="#faq4" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-briefcase fa-1x"></i></span><strong> Openings <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/newimg.png" alt="new img"></strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                     
                                   <?php else: ?>
                                       <center><a data-toggle="collapse" href="#faq4" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-briefcase fa-1x"></i></span><strong> Openings</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                      
                                   <?php endif; ?> 
 
                             
                       
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 4 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq4" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq4" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                    
                                    <!--    <div id="faq4" class="panel-collapse collapse"> -->
                                  
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
                                                    <!--    <div class="ibox-content">  --><!-- BEGINNING OF CONTENT FOR SECTION  -->
<!--  ****************************************************************************** -->

    <!--    <div class="row wrapper border-bottom white-bg page-heading"> --><!--BEGINNING OF JOBS  -->
 

        <div class="wrapper wrapper-content animated fadeInUp"> 
            <br>
            <div class="row"><!-- ROW OF JOBS  -->

                <?php foreach($jobdata as $row) { ?>

                 <div class="col-md-3">
                    <div class="ibox">         
                        <div class="ibox-content product-box">


                            <div class="product-desc">
<ul class="nav metismenu" > <!-- keeps bullets from showing up -->                           
                        <li>
                            <div>
                                <?= $row->created_at ?> 
                             <p class="text-muted">For <?= $row->scope ?></p>

                              <h2 style="color:CornFlowerBlue;" ><?= $row->title ?></h2>
                              <h3>  <?= $row->shortdescription ?> </h3>
                                <?php if(strlen($row->location) > 0): ?>
                                   
                              <p>  <strong>Location</strong> <?= $row->location ?> </p>
                                 
                                <?php else: ?>
                                <?php endif; ?>

                             <!--    <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>   -->                                 
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact</strong> <?= $row->contact_info ?>
                                <?php endif; ?>  

                            <!--    <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  --> 
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:CornFlowerBlue;" href="<?= BASE_URL ?>cms-ccmpsjobs/fulljob/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>
</ul>
  </div> <!-- class="product-desc"  -->
                        </div> <!-- class="ibox-content product-box" -->
                        
                    </div> <!-- class="ibox"  -->
   
                 </div> <!--  class="col-md-3"  -->

                        <?php } ?> 




                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF JOBS SECTION -->



<!--  ****************************************************************************** -->

                </div> <!-- END Ibox content END OF CONTENT OF SECTION -->
               </div> <!-- ibox   -->                
                </div> <!-- faq answer-->                              
                            
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->

                </div>
                </div><!-- row   -->
                </div><!-- class md-col-12  -->

                </div><!-- row   --> 
                </div><!-- faq item   -->             

<!--   End Accordian Section -->   


<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">
                                   <?php if($_SESSION['new_activity'] == 1): ?>
                                      <center><a data-toggle="collapse" href="#faq5" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-calendar fa-1x"></i></span><strong> Calendar<img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/newimg.png" alt="new img"></strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                     
                                   <?php else: ?>
                                       <center><a data-toggle="collapse" href="#faq5" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-calendar fa-1x"></i></span><strong> Calendar</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>
                                      
                                   <?php endif; ?> 
                                     
                                     </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 5 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq5" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq5" class="panel-collapse collapse">
                                    <?php endif; ?>                                     
                                      
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">

                                                   <!--     <div class="ibox-content"> -->
                            <!--  ****************************************************************************** -->


<!-- Vue JS Call  -->
<!-- <div id="messageapp">{{ message }}</div>  -->


       <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">

                    <!--
                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="text-center p-lg">
                                <h2>If you don't find the answer to your question</h2>
                                <span>add your question by selecting </span>
                            </div>
                        </div>  -->

<!--                    
              <?php foreach($actdata as $row) { ?>        
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h1><?= $row->title ?></h1>
                              <h3><?= $row->id ?>Posted by <strong><?= $row->poster ?> </strong> <i class="fa fa-clock-o"></i> <?= $row->created_at ?> </h3>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
<div class="row">
    <div class="col-lg-2">
    </div>
        <div class="col-lg-8">
    <h3><?= $row->shortdescription ?></h3>          
    </div>

        <div class="col-lg-2">
    </div>
</row>                            
                          

                        </div>
                    </div>
          
             <?php } ?>    
                        <br>
                        <br> -->
                        
                        <div class="ibox-content">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <?php foreach($actdata as $row) { ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        <!--    <h1 class="panel-title">  Makes type dark gray-->
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $row->id ?>"><h3> <?= $row->activitydates ?>, <?= $row->location ?></h3> <h2><!-- <i class="fa fa-angle-down fa-1x"></i> --> <?= $row->title ?> </h2> 
                                         <!--   </h1> -->
                                        </div>                                        
                                        <div id="collapse<?= $row->id ?>" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <a><?= $row->extlink ?></a>
                                            <!--     <br>
                                                <a><?= $row->location ?></a> -->
                                                 <br>
                                                <h2><?= $row->shortdescription ?></h2>
                                                 <br>
                                                 <h3><?= $row->fulldescription ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
               
<!--
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq9" class="faq-question">There are many variations of passages ?</a>
                                    <small>Added by <strong>Monica Smith</strong> <i class="fa fa-clock-o"></i> Today 1:60 pm - 11.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Alex Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    23
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq9" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                There are many variations of passages of Lorem Ipsum available, but the
                                                majority have suffered alteration in some form, by injected humour, or
                                                randomised words which don't look even slightly believable. If you are
                                                going to use a passage
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>



                           <!--  ****************************************************************************** -->                                                        
                                                  <!--      </div> --><!--ibox content  -->
                                                    </div><!--ibox   -->
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 6 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  --> 

<!--   End Accordian Section --> 

<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-11">

<!-- <center><a data-toggle="collapse" href="#faq7" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-stethoscope fa-1x"></i></span><strong> Vital Signs</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center> -->
 <center><a data-toggle="collapse" href="#faq7" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-line-chart fa-1x"></i></span><strong> Metrics</strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center> 
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 7 || CCMPS_HM_ALL_CLPSE_OPEN == 1): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq7" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq7" class="panel-collapse collapse">
                                    <?php endif; ?>                                    
                                     
                                  
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
                             <span class="label label-warning float-right">Chapter</span>
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
                                Chapter Associate <?= CCMPS ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numascbpamembers ?></button>
                                National Associate <?= CCMPS ?>
                            </td>
 
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numstuchaptermembers ?></button>
                                Chapter Student <?= CCMPS ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numstubpamembers ?></button>
                                National Student <?= CCMPS ?>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numqstuchaptermembers ?></button>
                                Chapter Q Student <?= CCMPS ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numqstubpamembers ?></button>
                                National Q Student <?= CCMPS ?>
                            </td>
 
                        </tr>  
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numhonchaptermembers ?></button>
                                Chapter Honorary <?= CCMPS ?>
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
</div> 



<!-- Put all session variables in hidden input fields to eliminate php evaluations for display logic -->

<!-- Begin Javascript for this view page  -->

    <!-- Vue.js CDN  for only this page ccmps/views/ccmphome. All others use templates/inspinia.php -->
    <!--     <script src="https://unpkg.com/vue@next"></script> latest dev version -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> 

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

      Vue.createApp(JumboApp).mount("#jumboapp")
 
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
 <!-- hx-get="https://dummyjson.com/users"  --> 
 <button hx-get="#" hx-confirm="HTMX Installed!"> Test for HTMX</button>
 <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
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