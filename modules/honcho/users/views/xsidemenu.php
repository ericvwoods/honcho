<nav class="navbar-default navbar-static-side gray-bg" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">


                <div class="dropdown profile-element">
                    <?php if(strlen( $_SESSION['picture']) > 0): ?> 

                <a href="<?= BASE_URL ?>welcome-ccmps/mydata" ><center><img alt="user picture" src="<?= BASE_URL?>welcome-ccmps_module/<?= $_SESSION['ccmp_rec_id'] ?>/<?= $_SESSION['picture'] ?>"/> </center></a>
                                        
         <!-- for /public       <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" ><center><img alt="user picture" src="<?= BASE_URL?>ccmps_photos/<?= $_SESSION['ccmp_rec_id'] ?>/<?= $_SESSION['picture'] ?>"/> </center></a> -->

                    <?php endif; ?>
                <!--    <br> -->
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
<span class="block m-t-xs font-bold"><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?></span>
                        
    <!-- custom BPA -->                    
<!-- <span class="block m-t-xs font-bold"><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?> "<?= $_SESSION['call_sign'] ?>"</span> -->

<?= $_SESSION['subentity_name'] ?>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">


                    <li>
                        <a  data-toggle="modal" data-target="#fontModal">

                            <div>
                  
                            <h3> <i class="fa fa-font"></i> Change Font Sizes [<?= $_SESSION['dfontsize'] ?>]
                                </h3>
                            </div> 
                        </a>
                    </li>
<li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata">Refresh My Settings</a>
                    </li>

                    <!--    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li> -->
                        
                      <!--  <li> <a class="dropdown-item" href="<?= BASE_URL ?>welcome/logout">Logout</a></li> -->
                    </ul>
                </div>                
                 <div class="logo-element"> 
                
                 <!--    <a class="navbar-minimalize " href="#"><strong><i class="fa fa-chevron-right "></i></strong></a> -->
                </div>
            </li>


         <!--   <php if($_SESSION['national_officer'] == 1 ): ?> --> <!-- president -->

<?php if($_SESSION['ccmpssidemenu'] == 'admin' ): ?>  <!-- buttons on sidemenu -->
            <li><a class="navbar-minimalize " href="#"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i><span class="nav-label"> Expand/Hide Menu</span></a></li>
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

                </ul>
            </li>  
<?php endif; ?>

            <?php if($_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_subentities'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?> 
                      

 
            <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> <?= CCMPSSUBENTITY ?> Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>welcome-ccmps/manage/mngsubentity"><i class="fa fa-users"></i><?= CCMPSSUBENTITY ?> <?= CCMPS ?></a></li> <!-- manage subentity members-->
                <!--    <li>
                      <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> </a>

                    </li> --> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) -->
                <!--    <li><a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/momads"><i class="fa fa-ellipsis-h"></i> <?= CCMPSSUBENTITY ?> Marquee</a></li>  -->                 
                    <li><a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/momads"><i class="fa fa-thumb-tack"></i> <?= CCMPSSUBENTITY ?> Bulletins</a></li> 
                    <li><a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/momads"><i class="fa fa-podcast"></i><?= CCMPSSUBENTITY ?> Notices</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjobs/manage/momads"><i class="fa fa-briefcase"></i> Job Posts</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/momads"><i class="fa fa-calendar"></i><?= CCMPSSUBENTITY ?> Activities</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/momads"><i class="fa fa-book"></i> <?= CCMPSSUBENTITY ?> Library</a></li>  
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
                
<?php if($_SESSION['ccmps_student_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_students'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?> 
                      
                                 
            <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> Student Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li>
                      <a href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-child"></i> Student <?= CCMPS ?> <!-- (<?= $_SESSION['num_all_current_chapter_student_members'] ?>) --></a>

                    </li>   
             
                </ul>
            </li>   

<?php endif; ?> 

                        
<?php if($_SESSION['ccmps_cms_admin'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_cms'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?> 
            <li> <a href="#"><i class="fa fa-gears"></i> <span class="nav-label"> Content Admin <?= $_SESSION['honcho_ccmps_module_all'] ?> </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= BASE_URL ?>cms-ccmpsmarquee/manage/cmsadmin"><i class="fa fa-ellipsis-h"></i> Marquee</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjumbotron/manage/cmsadmin"><i class="fa fa-th-list"></i> Jumbotron</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/cmsadmin"><i class="fa fa-thumb-tack"></i> Bulletins</a></li>  
                    <li><a href="<?= BASE_URL ?>cms-ccmpsnotices/manage/cmsadmin"><i class="fa fa-podcast"></i> Notices</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsjobs/manage/cmsadmin"><i class="fa fa-briefcase"></i> Job Posts</a></li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpsactivities/manage/cmsadmin"><i class="fa fa-calendar"></i> Activities</a></li>
                        <li>
                            <a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin"><i class="fa fa-file-text-o"></i>  Doc Library <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= BASE_URL ?>cms-ccmpslibrary/kanban/s">Kanban Board</a>  <!--s=invoked from sidemenu  -->
                                </li>
                           <!--     <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li> -->

                            </ul>
                        </li>
                    <li><a href="<?= BASE_URL ?>cms-ccmpssubentities/manage/cmsadmin"><i class="fa fa-list"></i> <?= SUBENTITIES ?></a></li> 
                        
                    <!--                    
                    <li><a href="#"><i class="fa fa-list"></i> <?= SUBENTITIES ?> <?= $_SESSION['num_chapters'] ?></a></li>
                    <li><a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a></li>                                                             
-->
                </ul>
<?php endif; ?> 
                


<!-- <php endif; ?> -->
<?php if($_SESSION['ccmps_system_admin'] == 1 || $_SESSION['honcho_ccmps_module_all'] == 1 || $_SESSION['honcho_all_modules'] == 1): ?>

            <li> <a href="#"><i class="fa fa-gears"></i><span class="nav-label"> System Admin </span><span class="fa fa-chevron-down"></span></a><!-- <span class="fa arrow"></span> -->
                <ul class="nav nav-second-level collapse">


                    <li>
                            <a href="<?= BASE_URL ?>system-settings/manage"><i class="fa fa-gears"></i> System Settings </a>
                   
                    </li> 

                    <li>
                            <a href="<?= BASE_URL ?>system-subentities/manage"><i class="fa fa-gears"></i> <?= SUBENTITIES ?> </a>
                   
                    </li> 
             <!--   <li>
                    <a href="<?= BASE_URL ?>blogs-asks/blog/no1"><i class="fa fa-question"></i> <span class="nav-label"> Ask the Devs (<?= $_SESSION['need_response'] ?>)</span></a>
                </li> -->

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
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-1">
                                <!-- the /1 is collapse #sets $_SESSION['ccmp_active_window'] so a failed validation will return to open the collapse -->
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/1">     <i class="fa fa-address-card-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> My Profile</h2> </a>  
                            </div>
                        </div>
                    </div>



                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-1">
                            <a href="<?= BASE_URL ?>cms-ccmpsbulletinboard/manage/mmyads" style="color:Gray;">     <i class="fa fa-thumb-tack fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> My Bulletins</h2> </a>  
                            </div>
                        </div>
                    </div>

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentroster" style="color:Gray;">     <i class="fa fa-list fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Our Roster (<?= $_SESSION['num_current_chapter_members'] ?>)</h2> </a>  
                            </div>
                        </div>
                    </div>
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="color:Gray;">     <i class="fa fa-address-card-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Directory (<?= $_SESSION['num_current_and_pd_members'] ?>)</h2> </a>  
                            </div>
                        </div>
                    </div>          
                     
                    <div class="widget style1 gray-bg"> 
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpschapters/viewpage" style="color:Gray;"> 
                           <!--      <a href="#" style="color:LightGray;"> -->
                                 <i class="fa fa-sitemap fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                              <!---        <h2 style="color:LightGray;"> <?= SUBENTITIES ?></h2> </a>  -->
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> <?= SUBENTITIES ?> (<?= $_SESSION['num_chapters'] ?>) </h2> </a>  
                            </div>
                        </div>
                    </div>                  


                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibccmp" style="color:Gray;">     <i class="fa fa-file-text-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Library</h2> </a>  
                            </div>
                        </div>
                    </div>

               <!--    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                          <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $id ?>/<?= $filename ?>/<?= $filetype ?>" style="color:Red;">     <i class="fa fa-newspaper-o fa-2x"></i> 
                            </div>                             
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/1" style="color:Gray;" target="_blank">     <i class="fa fa-newspaper-o fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i> 
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
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Sponsors</h2> </a>  
                            </div>
                        </div>
                    </div> -->


<?php if($_SESSION['honcho_all_modules'] == 1 || $_SESSION['ccmps_system_admin'] == 1 || $_SESSION['ccmps_subentity_admin'] == 1 || $_SESSION['ccmps_content_admin'] == 1 || $_SESSION['ccmps_admin'] == 1 || $_SESSION['ccmps_student_admin'] == 1 || $_SESSION['ccmps_subentity_role'] == 1): ?>

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/adminmenu" style="color:Gray;">     <i class="fa fa-gears fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Admin</h2> </a>  
                            </div>
                        </div>
                    </div> 

<?php endif; ?>    

                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome/logout/compccmp" style="color:Gray;">     <i class="fa fa-sign-out fa-2x" style="color: <?= CCMPS_HM_SIDE_ICON_CLR ?>;"></i>
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: <?= CCMPS_HM_SIDE_MENU_CLR ?>; font-size:14pt"> Logout</h2> </a>  
                            </div>
                        </div>
                    </div> 
                     
</div> <!-- row-fluid  -->


<?php endif; ?> <!-- buttons on sidemenu   -->                         
        </ul>
 
    </div>
  
</nav>
