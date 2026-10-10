

		<!--	<ul class="breadcrumb">
			<ul>
				<li>
					<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> 
				</li>
			</ul> 
            <br> -->
			<div class="row-fluid">	


		<?php if ($role_id == 1|$role_id == 15 | $role_id == 17):  ?>
			<a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/leads/manage">
                               
							   <i class="fa fa-list"></i>
				<p>Leads</p> <!-- Subset of Contacts filtered by contacttype = . Not a separate table -->
						   <!--	<span class="badge"><?= $numposts;?></span> -->
						   <span class="badge"><?= $contcnt; ?></span>  
		   
		   <!--    <php if ($numinactiveposts > 0): ?> -->
				   <?php if ($contdel>0): ?> <!-- Deleted recs -->                                  
					   <?php if($contnew>0): ?> <!-- Deleted recs and New records -->
						   <?php if($contwrk>0): ?> <!-- Deleted recs and New records and Working Recs-->
							   <span class="notification red"><?= $contnew ?> New <?= $contwrk ?>  Wkg <?= $contdel ?>  Del</span>        
						   <?php else: ?><!-- Deleted recs and New records but no Working recs-->
							   <span class="notification red"><?= $lcontnew ?> New <?= $contdel ?>  Deleted</span>  
						   <?php endif; ?>
					   <?php else: ?> <!-- Deleted recs but no New records -->
						   <?php if($contwrk>0): ?> <!-- Deleted recs and Working recs but no New records -->
							   <span class="notification red"><?= $contwrk ?>  Working <?= $contdel ?>  Deleted</span> 
						   <?php else: ?> <!-- Deleted recs but no Working recs and no New records -->
							   <span class="notification blue"><?= $contdel ?>  Deleted</span> 
						   <?php endif; ?>
					   <?php endif; ?>
				   <?php else: ?> <!-- No Deleted records  -->
					   <?php if($contnew>0): ?> <!-- New Recs but no deleted -->
						   <?php if($contwrk>0): ?> <!-- New Recs, Working recs but no deleted -->
							   <span class="notification red"><?= $contnew ?> New <?= $contwrk ?>  Working</span>     													
						   <?php else: ?><!-- New Recs but no deleted no Working recs-->
							   <span class="notification red"><?= $contnew ?> New</span>     
						   <?php endif; ?> 
					   <?php else: ?> <!-- No New Records but No Deleted records  -->
						   <?php if($contwrk>0): ?> <!-- No New Records,  Working records but No Deleted records  -->
							   <span class="notification red"><?= $contwrk ?>  Working</span> 
						   <?php else: ?> <!-- No New Records but no Working records or No Deleted records  -->
						   <?php endif; ?> 
					   <?php endif; ?> <!-- End deleted or not -->
			   <?php endif; ?>                                                                              
			   </a>
		<?php endif; ?>  


			<!-- ****** CONTACTS ****** -->

			<?php if ($numinactiveposts > 0){ ?>                                         
                                    <a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/contacts/manage/1">
                                <?php }else{ ?>
                                    <a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/contacts/manage">
                                <?php } ?>                                      
					<i class="fa fa-vcard-o"></i>
                                        <p>Contacts</p>
				<!--	<span class="badge"><?= $numposts;?></span> -->
					<span class="badge">12</span>  

                                    <!--    <php if ($numinactiveposts > 0): ?> -->
											<?php if ($role_id == 1|$role_id == 15) : ?>                                           
												<span class="notification red">5 Deleted</span>
                                        <?php endif; ?>                                        
				</a>

				<!-- ****** Companies ****** -->

				<?php if ($numpendingrsps > 0){ ?>                                         
					<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage/1')?>">
                <?php }else{ ?>
					<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage')?>">
				<?php } ?> 
				                                      
					<i class="fa fa-building"></i>
					<p>Companies</p>
					<span class="badge">264</span>
					<?php if ($role_id == 1|$role_id == 15 ): ?>   
					<span class="notification red">1 Deleted</span>
				<?php endif; ?>
					</a>

			<!-- Affiliates -->
		<?php if ($role_id == 1|$role_id == 15 | $role_id == 17):  ?>
			<a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/affiliates/manage">
                                
				<i class="fa fa-handshake-o"></i>
				<p>Affliates</p>
				<span class="badge">24</span>
				<?php if ($numpendingrsps > 0): ?> 
					<span class="notification red"><?= $numpendingrsps;?></span>
				<?php endif; ?>
			</a>
		<?php endif; ?>



			<div class="clearfix"></div>							
			</div><!--/row-->
			<br>
			<?php if ($role_id == 1|$role_id == 15 | $role_id == 17):  ?>

			<div class="row-fluid">	

			<?php if ($numpendingcmts > 0){ ?>                                         
				<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage/1')?>">
                                <?php }else{ ?>
				<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage')?>">
                                <?php } ?>                                           
					<i class="fa fa-calendar"></i>
					<p>Events Calendar</p>
					<span class="badge"><?= $numcmts;?>9</span>
                                    <!--    <php if ($numpendingcmts > 0): ?> -->
											<?php if (1==1): ?>  
                                        <!--    <span class="notification red"><= $numpendingcmts;?></span> -->
											<span class="notification red">2 Pending Approval</span>
                                        <?php endif; ?>
				</a>
                                


<!-- ****** BLOG POSTS ****** -->

<?php if ($numinactiveposts > 0){ ?>                                         
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage/1')?>">
                                <?php }else{ ?>
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage')?>">
                                <?php } ?>                                      
								<i class="fa fa-thumb-tack"></i>
                                        <p>Blog Posts</p>
				<!--	<span class="badge"><?= $numposts;?></span> -->
					<span class="badge">12</span>  

                                    <!--    <php if ($numinactiveposts > 0): ?> -->
											<?php if (1==2): ?>                                           
												<span class="notification red">3 New</span>
                                        <?php endif; ?>                                        
				</a>
                                <?php if ($numpendingcmts > 0){ ?>                                         
				<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage/1')?>">
                                <?php }else{ ?>
				<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage')?>">
                                <?php } ?>                                           
								<i class="icon-comments-alt"></i>
					<p>Comments on Posts</p>
					<span class="badge"><?= $numcmts;?>9</span>
                                    <!--    <php if ($numpendingcmts > 0): ?> -->
											<?php if (1==1): ?>  
                                        <!--    <span class="notification red"><= $numpendingcmts;?></span> -->
											<span class="notification red">2 Pending Approval</span>
                                        <?php endif; ?>
				</a>
                                <?php if ($numpendingrsps > 0){ ?>                                         
				<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage/1')?>">
                                <?php }else{ ?>
				<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage')?>">
                                <?php } ?>                                       
					<i class="fa fa-reply"></i>
					<p>Responses</p>
					<span class="badge"><?= $numrsps;?>28</span>
                                        <?php if (1==1): ?> 
                                            <span class="notification red"><?= $numpendingrsps;?>7 Pending Approval</span>
                                        <?php endif; ?>
				</a>

<!-- ****** END BLOG SECTION ******  -->
			<div class="clearfix"></div>
							
			</div><!--/row-->			
			<br>
			<div class="row-fluid">	


			<div class="clearfix"></div>
							
			</div><!--/row-->
			<br>
			<div class="row-fluid">	
						
                                <?php if ($numinactiveposts > 0){ ?>                                         
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage/1')?>">
                                <?php }else{ ?>
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage')?>">
                                <?php } ?>                                      
					<i class="fa fa-dollar"></i>
                                        <p>Orders/Donations</p>
				<!--	<span class="badge"><?= $numposts;?></span> -->
					<span class="badge">12</span>  

                                    <!--    <php if ($numinactiveposts > 0): ?> -->
											<?php if (1==1): ?>                                           
												<span class="notification red">5 New</span>
                                        <?php endif; ?>                                        
				</a>


				<?php if ($numinactiveposts > 0){ ?>                                         
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage/1')?>">
                                <?php }else{ ?>
                                    <a class="quick-button span2" href="<php echo base_url('Blogposts/manage')?>">
                                <?php } ?>                                      
					<i class="fa fa-truck"></i>
                                        <p>Shipping & Receiving</p>
				<!--	<span class="badge"><?= $numposts;?></span> -->
					<span class="badge">73</span>  

                                    <!--    <php if ($numinactiveposts > 0): ?> -->
											<?php if (1==1): ?>                                           
												<span class="notification red">4 Pending Shipments</span>
                                        <?php endif; ?>                                        
				</a>

				<a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/storeitems/manage">
                              
							  <i class="fa fa-tags"></i>
												  <p>Store Items</p>
						  <!--	<span class="badge"><?= $numposts;?></span> -->
							  <span class="badge">0</span>  
		  
											  <!--    <php if ($numinactiveposts > 0): ?> -->
													  <?php if (1==1): ?>                                           
														  <span class="notification red">5 New</span>
												  <?php endif; ?>                                        
						  </a>
		  
					  <?php if ($numinactiveposts > 0){ ?>                                         
											  <a class="quick-button span2" href="<php echo base_url('Blogposts/manage/1')?>">
										  <?php }else{ ?>
											  <a class="quick-button span2" href="<php echo base_url('Blogposts/manage')?>">
										  <?php } ?>                                      
							  <i class="fa fa-calculator"></i>
												  <p>Accounts</p>
						  <!--	<span class="badge"><?= $numposts;?></span> -->
							  <span class="badge">12</span>  
		  
											  <!--    <php if ($numinactiveposts > 0): ?> -->
													  <?php if (1==1): ?>                                           
														  <span class="notification red">0 New</span>
												  <?php endif; ?>                                        
						  </a>

			<div class="clearfix"></div>

							
			</div><!--/row-->
			<br>
			<div class="row-fluid">	

			
			<!-- Users -->

			<a class="quick-button span2" href="<?= BASE_URL ?>dashboards/index/users/manage">
                                
				<i class="fa fa-users"></i>
				<p>Users</p>
				<span class="badge">264</span>
				<?php if ($numpendingrsps > 0): ?> 
					<span class="notification red"><?= $numpendingrsps;?></span>
				<?php endif; ?>
			</a>

			<div class="clearfix"></div>

							
			</div><!--/row-->
	<?php endif; ?>