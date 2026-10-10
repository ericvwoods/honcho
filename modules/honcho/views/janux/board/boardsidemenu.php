<!-- Janux  -->	
<div id="sidebar-left" class="span2">

				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="<?= BASE_URL ?>dashboards"><i class="fa fa-dashboard"></i><span class="hidden-tablet"> <?= $menutitle ?></span></a></li>
<!-- Eventhough board members have separate menus, for added security still check the role id -->
<!--People -->   <?php if ($role_id == 1 | $role_id == 15 | $role_id == 16): ?>                                            
                        <li>
							<a class="dropmenu" href="#"><i class="fa fa-users"></i><span class="hidden-tablet"> People</span> ></a>
							<ul>
                                <li><a class="submenu" href="<?= BASE_URL ?>dashboards/index/vtcontacts/manage"><i class="fa fa-vcard-o"></i><span class="hidden-tablet"> Contacts</span></a></li>   <!-- Vtiger CRM -->                                                                                                                     
                            </ul>	
						</li>
<!-- End People -->   <?php endif; ?>

<!-- Help Menu -->      <li>  
							<a class="dropmenu" href="#"><i class="fa fa-book"></i><span class="hidden-tablet"> Help</span> ></a>
							<ul>
                                                            <?php if ($role_id == 1 | $role_id == 16): ?>                                                              
								<li><a class="submenu" href="#"><i class="halflings-icon white book"></i><span class="hidden-tablet"> Admin Guide</span></a></li>
                                                            <?php endif; ?>
								<li><a class="submenu"><i class="halflings-icon white book"></i><span class="hidden-tablet"> User Guide</span></a></li>
                            </ul>
                        </li>   
<!-- End Help Menu -->  <li>  


		        </div>
</div>
