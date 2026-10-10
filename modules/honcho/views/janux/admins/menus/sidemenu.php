<!-- Janux  -->	

<div id="sidebar-left" class="span2">

				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
            <!--        <li><a href="<php echo base_url('/Users/honcho')?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> <php echo lang('dashboard');?></span></a></li> <!-- <php echo $role_id; ?> -->
                        <li><a href="<?= BASE_URL ?>dashboards"><i class="fa fa-dashboard"></i><span class="hidden-tablet"> <?= $menutitle ?></span></a></li>

                        <!-- x 
                         <li>  
							<a class="dropmenu" href="#"><i class="fa fa-gears"></i><span class="hidden-tablet"> x</span> ></a>
							<ul>
                            <?php if ($role_id == 1): ?>                                                              
								<li><a class="submenu" href="#"><i class="halflings-icon white book"></i><span class="hidden-tablet"> x</span></a></li>
                                                            <?php endif; ?>
								<li><a class="submenu"><i class="halflings-icon white book"></i><span class="hidden-tablet"> x</span></a></li>
                            </ul>
                        </li> -->
<!-- End x -->
                    <!-- People Menu--> 
                      <?php if ($role_id == 1|$role_id == 15|$role_id == 16 | $role_id == 17): ?>                                            
                        <li>                   
							<a class="dropmenu" href="#"><i class="fa fa-male"></i><span class="hidden-tablet"> People</span> ></a>
							<ul>
                            <?php if ($role_id == 1|$role_id == 15|$role_id == 16 | $role_id == 17):  ?>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/ccmps/manage"><i class="fa fa-child"></i><span class="hidden-tablet"> <?= CCMPS ?></span></a></li>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/leads/manage"><i class="fa fa-list"></i><span class="hidden-tablet"> Leads</span></a></li>
                                <?php endif; ?>                                    
                                <?php if ($role_id == 1|$role_id == 15|$role_id == 16 | $role_id == 17):  ?>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/contacts/manage"><i class="fa fa-vcard-o"></i><span class="hidden-tablet"> Contacts</span></a></li>                                                                                                                        
                                <?php endif; ?>
                                <?php if ($role_id == 1|$role_id == 15|$role_id == 16 | $role_id == 17):  ?>                            
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/companies/manage"><i class="fa fa-building"></i><span class="hidden-tablet"> Companies</span></a></li>
                                    <?php endif; ?>  
                                <?php if ($role_id == 1|$role_id == 15 | $role_id == 17):  ?>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/affiliates/manage"><i class="fa fa-handshake-o"></i><span class="hidden-tablet"> Affiliates</span></a></li>                                                                                                                 
                                <?php endif; ?>                                    
                            </ul>	
						</li>
                       <?php endif; ?>
                    <!-- End People Menu --> 

            <!-- Site -->   <?php if ($role_id == 1 |$role_id == 15): ?>                                            
 <!--                   <php if ($role_id == 1|$role_id == 4|$role_id == 8|$role_id == 9|$role_id == 10|$role_id == 12|$role_id == 13):  ?> -->
    <li>
                <!-- The red square with a number in it: span class="label label-important"> 3 </span>  -->
                <!--     <a class="dropmenu" href="#"><i class="fa fa-window-maximize"></i><span class="hidden-tablet"> <php echo lang('site');?></span> ></a> -->                        
							<a class="dropmenu" href="#"><i class="fa fa-window-maximize"></i><span class="hidden-tablet"> Website</span> ></a>
							<ul>
                            <?php if ($role_id == 1|$role_id == 15):  ?>                                                                
                                    <li><a class="submenu" href="#"><i class="fa fa-calendar"></i><span class="hidden-tablet"> Events</span></a></li> <!-- Events Calendar -->
                                <?php endif; ?>                            
                                <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11|$role_id == 12):  ?>                                                                
                                <!--    <li><a class="submenu" href="#"><i class="fa fa-image"></i><span class="hidden-tablet"> Media</span></a></li> --> <!-- change banners, etc. -->
                                <?php endif; ?>
                                <?php if ($role_id == 13|$role_id == 1): ?>     
                            <!--        <li><a class="submenu" href="#"><i class="fa fa-upload"></i><span class="hidden-tablet"> Upload Media</span></a></li> -->
                                <?php endif; ?>                                                                 
					<!--			<li><a class="submenu" href="#"><i class="icon-picture"></i><span class="hidden-tablet"> Role Id: <php echo $role_id; ?></span></a></li> -->

                            </ul>	
						</li>
    <!-- End Site -->   <?php endif; ?>


    <!-- Blog -->       <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11|$role_id == 12|$role_id == 13 | $role_id == 15):  ?>

        <li>
                                                    <!-- The red square with a number in it: span class="label label-important"> 3 </span>  -->
                       <!-- <a class="dropmenu" href="#"><i class="icon-comments"></i><span class="hidden-tablet"> <php echo lang('blog');?></span> ></a>  -->                        
							<a class="dropmenu" href="#"><i class="fa fa-comments"></i><span class="hidden-tablet"> Blog</span> ></a>
							<ul>
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15):  ?>
                           <!-- 								<li><a class="submenu" href="<php echo base_url('Blogposts/manage')?>"><span class="hidden-tablet"> All Posts <i class="fa fa-thumb-tack"></i> <?= $numposts ?></span></a></li> -->                                                                                             
								<li><a class="submenu" href="Blogposts/manage"><span class="hidden-tablet"> <i class="fa fa-thumb-tack"></i> Posts  <?= $numposts ?></span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15 AND $numinactiveposts > 0):  ?>
                        <!--    <li><a class="submenu" href="<php echo base_url('Blogposts/manage/1')?>"><span class="hidden-tablet">Inactive Posts <i class="fa fa-thumb-tack"></i> <span class="label label-important"><?= $numinactiveposts ?></span></span></a></li> -->                                                                                        
								<li><a class="submenu" href="Blogposts/manage/1"><span class="hidden-tablet">Inactive Posts <i class="fa fa-thumb-tack"></i> <span class="label label-important"><?= $numinactiveposts ?></span></span></a></li>
                                                            <?php endif; ?>                                                                
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15):  ?>
                        <!--    <li><a class="submenu" href="<php echo base_url('Blogcomments/manage')?>"><span class="hidden-tablet"> All Comments <i class="icon-comments-alt"></i> <?= $numcmts ?></span></a></li> -->                                                            
								<li><a class="submenu" href="Blogcomments/manage"><span class="hidden-tablet"> <i class="icon-comments-alt"></i> Comments on Posts <?= $numcmts ?></span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15 AND $numpendingcmts >0):  ?>
                       <!--     <li><a class="submenu" href="<php echo base_url('Blogcomments/manage/1')?>"><span class="hidden-tablet">Pending Comments <i class="icon-comments-alt"></i> <span class="label label-important"><?= $numpendingcmts ?></span></span></a></li> -->                                                            
								<li><a class="submenu" href="Blogcomments/manage/1"><span class="hidden-tablet">Pending Comments <i class="icon-comments-alt"></i> <span class="label label-important"><?= $numpendingcmts ?></span></span></a></li>
                                                            <?php endif; ?>                                                                
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15):  ?>
                        <!--    <li><a class="submenu" href="<php echo base_url('Blogresponses/manage')?>"><span class="hidden-tablet"> All Responses <i class="fa fa-reply"></i> <?= $numrsps ?></span></a></li> -->                                                            
								<li><a class="submenu" href="Blogresponses/manage"><span class="hidden-tablet"> <i class="fa fa-reply"></i> Responses to Comments <?= $numrsps ?></span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11 | $role_id == 15 AND $numpendingrsps >0):  ?>
                        <!--    <li><a class="submenu" href="<php echo base_url('Blogresponses/manage/1')?>"><span class="hidden-tablet">Pending Responses <i class="fa fa-reply"></i> <span class="label label-important"><?= $numpendingrsps ?></span></span></a></li>  -->                                                            
								<li><a class="submenu" href="Blogresponses/manage/1"><span class="hidden-tablet">Pending Responses <i class="fa fa-reply"></i> <span class="label label-important"><?= $numpendingrsps ?></span></span></a></li>
                                                            <?php endif; ?>                                                                   
                                                            <?php if ($role_id == 1|$role_id == 5|$role_id == 8|$role_id == 10|$role_id == 11|$role_id == 12 | $role_id == 15):  ?>
                           <!-- <li><a class="submenu" href="<php echo base_url('Blogfiles/manage')?>"><span class="hidden-tablet"> Media Files <i class="icon-picture"></i></span></a></li>  -->                                                                
                                <li><a class="submenu" href="Blogfiles/manage"><span class="hidden-tablet"><i class="icon-picture"></i> Media Files </span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 13|$role_id == 13): ?>   <!-- This is for contract photographers, etc. -->  
                                                                <li><a class="submenu" href="#"><i class="fa fa-upload"></i><span class="hidden-tablet"> Upload Media</span></a></li>
                                                            <?php endif; ?> 					

                                                        </ul>	
						</li>
    <!-- End Blog -->   <?php endif; ?>

    <!-- Store -->       <?php if ($role_id == 1 | $role_id == 15): ?>                                                                            
                <!--    <php if ($role_id == 1|$role_id == 6|$role_id == 9|$role_id == 10|$role_id == 11|$role_id == 7|$role_id == 12|$role_id == 13): ?>  -->                                              
                                                <li>  
                                                    <!-- The red square with a number in it: span class="label label-important"> 3 </span>  -->
							<a class="dropmenu" href="#"><i class="fa fa-shopping-cart"></i><span class="hidden-tablet"> Store</span> ></a>
							                            <ul>
                                                            <?php if ($role_id == 1|$role_id == 6|$role_id == 9|$role_id == 10|$role_id == 11|$role_id == 12 | $role_id == 15): ?>     
                                                                <li><a class="submenu" href="#"><i class="fa fa-usd"></i><span class="hidden-tablet"> Orders/Donations</span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 1|$role_id == 6|$role_id == 9|$role_id == 10|$role_id == 11|$role_id == 7 | $role_id == 15): ?>     
                                                                <li><a class="submenu" href="#"><i class="fa fa-truck"></i><span class="hidden-tablet"> Ship & Receive</span></a></li>
                                                            <?php endif; ?>

                                                            <?php if ($role_id == 1|$role_id == 6|$role_id == 9|$role_id == 10|$role_id == 11 | $role_id == 15): ?>
                           <!-- <li><a class="submenu" href="<php echo base_url('Shop_products/manage')?>"><i class="fa fa-gears"></i><span class="hidden-tablet"> Manage Products</span></a></li>  -->                                                                                           
								<li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/storeitems/manage"><i class="fa fa-tags"></i><span class="hidden-tablet"> Store Items</span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 1|$role_id == 6|$role_id == 9|$role_id == 10|$role_id == 11|$role_id == 12 | $role_id == 15): ?>     
                                                                <li><a class="submenu" href="#"><i class="fa fa-calculator"></i><span class="hidden-tablet"> Accounts</span></a></li>
                                                            <?php endif; ?>
                                                            <?php if ($role_id == 13|$role_id == 13): ?>   <!-- This is for contract photographers, etc. -->  
                                                        <!--        <li><a class="submenu" href="#"><i class="fa fa-upload"></i><span class="hidden-tablet"> Upload Media</span></a></li> -->
                                                            <?php endif; ?>                                                                

                                                        </ul>
                                                </li>        
    <!-- End Store -->   <?php endif; ?>






                        <?php if ($role_id == 1 | $role_id == 15): ?> 
                        <li>  
							<a class="dropmenu" href="#"><i class="fa fa-wrench"></i><span class="hidden-tablet"> Utilities</span> ></a>
							<ul>
                                <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/users/manage"><i class="fa fa-users"></i><span class="hidden-tablet"> User Accounts</span></a></li>                                                                                                                        
                            <?php if ($role_id == 1):  ?>
                                <li><a class="submenu" href="#"><i class="fa fa-check"></i><span class="hidden-tablet"> Change Settings</span></a></li>                                                                                                                      
								<li><a class="submenu" href="#"><i class="fa fa-times"></i><span class="hidden-tablet"> Deleted Records</span></a></li>
                                <?php if ($role_id == 1|$role_id == 15|$role_id == 16 | $role_id == 17):  ?>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/contacts_test/manage//m/s"><i class="fa fa-vcard-o"></i><span class="hidden-tablet"> Contacts Test</span></a></li>                                                                                                                     
                             <!--       <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/contacts_test/manage"><i class="fa fa-vcard-o"></i><span class="hidden-tablet"> Contacts Test All</span></a></li>  -->                                                                                                                  
                         <?php endif; ?>
                            <?php endif; ?>                                                           
                            </ul>
                        </li> 
                        <?php endif; ?>

    <!-- Help --> 
                        <li>  
							<a class="dropmenu" href="#"><i class="fa fa-book"></i><span class="hidden-tablet"> Help</span> ></a>
							<ul>
                                                            <?php if ($role_id == 1 | $role_id == 15): ?>                                                              
								<li><a class="submenu" href="#"><i class="halflings-icon white book"></i><span class="hidden-tablet"> Admin Guide</span></a></li>
                                                            <?php endif; ?>
								<li><a class="submenu"><i class="halflings-icon white book"></i><span class="hidden-tablet"> User Guide</span></a></li>
                            </ul>
                        </li>   
                        <li>  


<!-- Go to blog instead of homepage  -->   <!--     <li><a href="<php echo base_url('/blog')?>"><i class="icon-home"></i><span class="hidden-tablet"> <php echo lang('gotowebsite');?></span></a></li> -->
                        <li>
                    <!--        <a class="dropmenu" href="welcome"><i class="icon-home"></i><span class="hidden-tablet">Website</span></a> -->
                             <ul>
                                <li></li>
                             </ul>
                        </li>



                        <!--    <a href="welcome"><i class="icon-home"></i><span class="hidden-tablet"> Go to Website</span></a></li>  -->
                                <?php if ($role_id == 1): ?>
                            <!--     <li><a href="<php echo base_url('/home')?>"><i class="icon-home"></i><span class="hidden-tablet"> Exit to Homepage</span></a></li> -->   
                            <!--        <li><a href="/home"><i class="icon-home"></i><span class="hidden-tablet"> Exit to Homepage</span></a></li>     -->                                       
                                <?php endif; ?>                                            

    <!--		<li><a href="messages.html"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a href="tasks.html"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
						<li><a href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a href="widgets.html"><i class="icon-dashboard"></i><span class="hidden-tablet"> Widgets</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li><a href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
                        <li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li> -->
                        

        <!-- Courses -->   <?php if ($role_id == 1): ?>                                            
 <!--                   <php if ($role_id == 1|$role_id == 4|$role_id == 8|$role_id == 9|$role_id == 10|$role_id == 12|$role_id == 13):  ?> -->
 <li>
                <!-- The red square with a number in it: span class="label label-important"> 3 </span>  -->
                <!--     <a class="dropmenu" href="#"><i class="fa fa-window-maximize"></i><span class="hidden-tablet"> <php echo lang('site');?></span> ></a> -->                        
							<a class="dropmenu" href="#"><i class="fa fa-mortar-board"></i><span class="hidden-tablet"> Courses</span> ></a>
							<ul>
                                <?php if ($role_id == 1|$role_id == 4|$role_id == 8|$role_id == 9|$role_id == 10):  ?>
<!-- <li><a class="submenu" href="<php echo base_url('Site/manage')?>"><i class="fa fa-gears"></i><span class="hidden-tablet"> Manage Site</span></a></li> -->
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/manage"><i class="fa fa-clock-o"></i><span class="hidden-tablet"> Scheduled Courses</span></a></li>                                                                                                                        
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/ccmps/manage"><i class="fa fa-child"></i><span class="hidden-tablet"> <?= CCMPS ?></span></a></li>
                                    <?php endif; ?>

                            </ul>	
						</li>
    <!-- End Courses -->   <?php endif; ?>

            <!-- Groundschool Setup -->   <?php if ($role_id == 1): ?>                                            
 <!--                   <php if ($role_id == 1|$role_id == 4|$role_id == 8|$role_id == 9|$role_id == 10|$role_id == 12|$role_id == 13):  ?> -->
 <li>
                <!-- The red square with a number in it: span class="label label-important"> 3 </span>  -->
                <!--     <a class="dropmenu" href="#"><i class="fa fa-window-maximize"></i><span class="hidden-tablet"> <php echo lang('site');?></span> ></a> -->                        
							<a class="dropmenu" href="#"><i class="fa fa-gears"></i><span class="hidden-tablet"> School Setup</span> ></a>
							<ul>
                                <?php if ($role_id == 1|$role_id == 4|$role_id == 8|$role_id == 9|$role_id == 10):  ?>
<!-- <li><a class="submenu" href="<php echo base_url('Site/manage')?>"><i class="fa fa-gears"></i><span class="hidden-tablet"> Manage Site</span></a></li> -->                                                                                                                     
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gscourses/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Course Types</span></a></li> 
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gsclasses/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Class Types</span></a></li>                                     
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gslessons/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Lesson Types</span></a></li>  
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gscerts/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Certificate Codes</span></a></li>  
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gslevels/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Level Codes</span></a></li>
                                    <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/gstopics/manage"><i class="fa fa-table"></i><span class="hidden-tablet"> Topic Codes</span></a></li>    
                                    <?php endif; ?>

                            </ul>	
						</li>
    <!-- End Grounschool -->   <?php endif; ?>
					</ul>
                    <br>
                    <span style="text-align:left;float:left"><a href="http://www.encoredigitalarts.com" alt="encoredigitalarts.com" target="new window">&copy; 2020  Encore Digital Arts, LLC</a></span>                    
		        </div>
</div>
