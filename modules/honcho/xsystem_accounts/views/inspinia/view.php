<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. gsclasses
3) Replace the fieldset form controls to match database table
-->
	<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>

                 
		<div class="ibox-content">
			<div class="row"> 
		        <div class="col-md-1">	 
		        	<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>system_accounts_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/> 
				<!--	<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
				</div> <!-- end col -->
				<div class="col-md-6">
					<br>
			    	<h2>
			    		<?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?> <?php echo($title); ?> </h2>

		        </div> <!-- end column -->
		    </div> <!-- end row -->

			  <!--      <div class="btn-group">
                        <a class="btn btn-rounded btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $id ?>/m" >Update</a>
                        <a class="btn btn-outline btn-danger" type="button" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v">Delete</a>
                        <a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Close</a>
                    </div>  -->
			<!--	<div class="box-icon"><a style='color: white'> * = required</a></div> -->

		</div>

<div class="ibox-content">	
                    <div class="tabs-container">
                    	<?= flashdata();
						$flash_msg = '';
						set_flashdata($flash_msg); ?>
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1">System Account</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Status</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3">Activity</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-4">Financials</a></li>
<?php if($action3_c > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                            <li><a class="nav-link" data-toggle="tab" href="#tab-5">Export</a></li>
<?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
									<div class="ibox-content"> 
									                         
		                                <div class="row"> 
		                                    <div class="col-md-5">
		                        				<br>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Username</strong> </label>
													<div class="col-sm-5"><?= $username ?></div> 
		                                        </div>                         
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Level</strong> </label>
													<div class="col-sm-5"><?= $tguserlevelname ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Title</strong></label> 
													<div class="col-sm-5"><?= $title ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Org/Unit</strong></label> 
													<div class="col-sm-5"><?= $department ?></div> 
		                                        </div>


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-4">
		                                    	<br>

		                                        <div class="form-group row"><label class="col-lg-4 "><strong>TG User Id</strong></label> 
													<div class="col-sm-5"><?= $trongate_user_id ?></div> 
		                                        </div>

		                                        <?php if($action2_r == 1 ): ?>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phone</strong></label> 
														<div class="col-sm-5"><?= $phone ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Email</strong></label> 
														<div class="col-sm-5"><?= $email_address ?></div> 
			                                        </div>
			                                    	
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Photo</strong></label> 
														<div class="col-sm-5" ><?= $picture ?></div> 
			                                        </div>
	           <form action="<?= BASE_URL ?>honcho/index/system_accounts/uploadsysacctpic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">   <!--  .../submodule/$task/$recid/$frmpg/filter) & the task calls the submit_upload_picture function() -->
			<!--	<form action="submit upload picture/1" method="post" enctype="multipart/form-data"> -->
						<input type="file" name="picture" value="">
						<button type="submit" name="submit" value="Upload">Upload Photo</button>
	            <!--    <div class="form-group">
						<button class="btn btn-rounded btn-outline btn-primary" name="submit" type="submit" value="Upload">Upload Picture</button> 
					</div>  -->
				</form>			           
			                                        
												<?php endif; ?>


		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $notes ?></span>
		                                    </div>
		                                </div>


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->
                            </div> <!-- End Tab Panel -->

                            <div role="tabpanel" id="tab-2" class="tab-pane">
 								<div class="panel-body">
									<div class="ibox-content">

									<br>
									                                     
		                                <div class="row">
		                                                                               
											<div class="col-md-6">
		                            	        <div class="form-group row"><label class="col-lg-3 "><strong>Login Locked</strong></label>

													<?php if( $locked  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	

		                            	        <div class="form-group row"><label class="col-lg-3 "><strong>Login Inactive</strong></label>

													<?php if( $inactive  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	

		                            	        <div class="form-group row"><label class="col-lg-3 "><strong>Email Confirmed</strong></label>

													<?php if( $confirmed  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>

												<div class="form-group row"><label class="col-lg-3 "><strong>Approved</strong></label> 	                                    
													<?php if( $approved   > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	
												</div>

												<div class="form-group row"><label class="col-lg-3 "><strong>Verified Identity</strong></label> 	                                    
													<?php if( $verified   > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	
												</div>


			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>IP Address</strong></label> 
													<div class="col-sm-5"><?= $ip_address ?></div> 
			                                    </div> 


											</div> <!-- end col -->
											<div class="col-md-6">
			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Token Exp</strong></label> 
													<div class="col-sm-5"><?= $token_expires ?></div> 
			                                    </div>  
			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Reset Code</strong></label> 
													<div class="col-sm-5"><?= $reset_code ?></div> 
			                                    </div> 	                                     
			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Activate Code</strong></label> 
													<div class="col-sm-5"><?= $activate_code ?></div> 
			                                    </div> 


												<div class="form-group row"><label class="col-lg-3 "><strong>Force PW Change</strong></label> 	                                    
													<?php if( $force_pw_chg   > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	
												</div>

												<div class="form-group row"><label class="col-lg-3 "><strong>Timed PW Reset</strong></label> 	                                    
													<?php if( $timed_reset   > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	
												</div>

			                                    <div class="form-group row"><label class="col-lg-3 "><strong>Reset Interval (days)</strong></label> 
													<div class="col-sm-5"><?= $reset_interval ?></div> 
			                                    </div>  


			                        	<!--  



			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Homepage</strong></label> 
													<div class="col-sm-5"><?= $homepage ?></div> 
			                                    </div> -->

											</div> <!-- end col -->
		 								</div>  <!-- end row -->

									</div> <!-- ibox content -->
								</div> <!--  panel body -->
							</div> <!-- End Tab Panel 2 -->


                            <div role="tabpanel" id="tab-3" class="tab-pane">
                                <div class="panel-body">
									<div class="ibox-content">
									<br>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>No Logins</strong></label> 
											<div class="col-sm-5"><?= $num_logins ?></div> 
                                        </div>                                        

                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Last Login</strong></label> 
											<div class="col-sm-5"><?= $last_login ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Last Logout</strong></label> 
											<div class="col-sm-5"><?= $last_logout ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Updated By</strong></label> 
											<div class="col-sm-5"><?= $updated_by ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Updated At</strong></label> 
											<div class="col-sm-5"><?= $updated_at ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Created By</strong></label> 
											<div class="col-sm-5"><?= $created_by ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Created At</strong></label> 
											<div class="col-sm-5"><?= $created_at ?></div> 
                                        </div>
                                        <div class="form-group row"><label class="col-lg-2 "><strong>Date Created</strong></label> 
											<div class="col-sm-5"><?= $date_created ?></div> 
                                        </div>


 								</div> <!-- ibox content -->
                                                                                                                                                                                                                                                               
                                </div>  <!-- end panel -->    
							</div> <!-- End Tab 3 -->

                            <div role="tabpanel" id="tab-4" class="tab-pane">
                                <div class="panel-body">
									<div class="ibox-content"> 
									                         
		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				<br>

		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Financial Acct Id</strong> </label>
													<div class="col-sm-5"><?= $fin_id ?></div> 
		                                        </div> 
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Financial Acct Type</strong> </label>
													<div class="col-sm-5"><?= $acct_type ?></div> 
		                                        </div> 	                 
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Billing Contact Email</strong></label> 
													<div class="col-sm-5"><?= $fin_email ?></div> 
		                                        </div>
												<div class="ibox-content">
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Bill To</strong></label> 
														<div class="col-sm-5"><?= $billname ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Bill Phone</strong></label> 
														<div class="col-sm-5"><?= $billphone ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Address1</strong></label> 
														<div class="col-sm-5"><?= $billaddress1 ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Address2</strong></label> 
														<div class="col-sm-5"><?= $billaddress2 ?></div>
													</div>	 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>City</strong></label> 
														<div class="col-sm-5"><?= $billcity ?></div> 
			                                        </div>		                                       
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>State</strong></label> 
														<div class="col-sm-5"><?= $billstate ?></div> 
			                                        </div>	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Zipcode</strong></label> 
														<div class="col-sm-5"><?= $billzip ?></div> 
			                                        </div>
												</div>


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>	                                    	
		                                        <div class="form-group row"><label class="col-lg-4 "><strong>Balance</strong></label> 
													<div class="col-sm-5"><?= $acct_bal ?></div> 
		                                        </div>		                                    	

		                                        <div class="form-group row"><label class="col-lg-4 "><strong>$ Acct Status</strong></label> 
													<div class="col-sm-5"><?= $fin_status ?></div> 
		                                        </div>

		                            	        <div class="form-group row"><label class="col-lg-3 "><strong>$ Acct Inactive</strong></label>

													<?php if( $fin_inactive  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	
												<div class="ibox-content">
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Ship To</strong></label> 
														<div class="col-sm-5"><?= $shipname ?></div> 
			                                        </div>

			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Ship Phone</strong></label> 
														<div class="col-sm-5"><?= $shipphone ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Address 1</strong></label> 
														<div class="col-sm-5"><?= $shipaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Address 2</strong></label> 
														<div class="col-sm-5"><?= $shipaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>City</strong></label> 
														<div class="col-sm-5"><?= $shipcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>State</strong></label> 
														<div class="col-sm-5"><?= $shipstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Zipcode</strong></label> 
														<div class="col-sm-5"><?= $shipzip ?></div> 
			                                        </div>
		                                    	</div>                                                           
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $fin_notes ?></span>
		                                    </div>
		                                </div>


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->
                            </div> <!-- End Tab 4 Panel -->


<?php if($action3_c > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
				            <div role="tabpanel" id="tab-5" class="tab-pane">
                                <div class="panel-body">
									<div class="ibox-content">                                    	
                                    <strong>Export Single Record - System Account Table Fields with Data</strong> <br>User Friendly Version - Translations & Calculated Fields
                                    <br>
                                    <br>

						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>

												<?php if(isset($id)) { ?>	
						                   		 	<th>Id</th>
												<?php } ?> 
												<?php if(strlen($code) > 0) { ?>	
						                    		<th>Code</th>
												<?php } ?>
												<?php if(strlen($username) > 0) { ?>	
						                    		<th>Username</th>
												<?php } ?>
												<?php if(strlen($tguserlevelname) > 0) { ?>	
									<!--		<php if(isset($tguserlevelname)) { ?>	-->
						                    		<th>Access Level</th>
												<?php } ?>
											<!--	<?php if(isset($status)) { ?>	
						                    		<th>Status</th>
												<?php } ?> -->
												<?php if(strlen($first_name) > 0) { ?>	
						                    		<th>First</th>
												<?php } ?>                     	
												<?php if(strlen($middle_name) > 0) { ?>	
						                    		<th>Middle</th>
												<?php } ?>                     	
												<?php if(strlen($last_name) > 0) { ?>	
						                    		<th>Last</th>
												<?php } ?>                     	
												<?php if(strlen($suffix) > 0) { ?>	
						                    		<th>Suffix</th>
												<?php } ?>
												<?php if(strlen($title) > 0) { ?>	
						                    		<th>Title</th>
												<?php } ?>                      
												<?php if(strlen($email_address) > 0) { ?>	
						                    		<th>Email</th>
												<?php } ?>                     	  
												<?php if(strlen($phone) > 0) { ?>	
						                    		<th>Phone</th>
												<?php } ?>                     		
												<?php if(strlen($department) > 0) { ?>	
						                    		<th>Department</th>
												<?php } ?>
												<?php if(strlen($notes) > 0) { ?>	
						                    		<th>Notes</th>
												<?php } ?>
												<?php if(strlen($picture) > 0) { ?>	
						                    		<th>picture</th>
												<?php } ?> 
												<?php if(strlen($url_string) > 0) { ?>	
						                    		<th>URL String</th>
												<?php } ?> 
												<?php if(isset($date_created) && $date_created != '01/01/1970') { ?>	
						                    		<th>Date Created</th>
												<?php } ?> 												
												<?php if(isset($num_logins)) { ?>	
						                    		<th>No Logins</th>
												<?php } ?> 
												<?php if(isset($last_login) && $last_login != '01/01/1970') { ?>	
						                    		<th>Last Login</th>
												<?php } ?> 
												<?php if(isset($last_logout) && $last_logout != '01/01/1970') { ?>	
						                    		<th>Last Logout</th>
												<?php } ?> 
												<?php if(isset($token_expires)) { ?>	
						                    		<th>Token Exp</th>
												<?php } ?> 
												<?php if(isset($trongate_user_id)) { ?>	
						                    		<th>TG User Id</th>
												<?php } ?>  						                   	
						   						                                      
												<?php if(strlen($user_token) > 0) { ?>	
						                    		<th>User Token</th>
												<?php } ?> 						   						                                      

												<?php if(isset($inactive)) { ?>	
						                    		<th>Inactive</th>
												<?php } ?> 						   						                                      
												<?php if(isset($locked)) { ?>	
						                    		<th>Locked</th>
												<?php } ?> 													
												<?php if(isset($confirmed)) { ?>	
						                    		<th>Confirmed</th>
												<?php } ?> 												 						   						                                      
												<?php if(isset($verified)) { ?>	
						                    		<th>Verified</th>
												<?php } ?> 						   						                                      
												<?php if(isset($approved)) { ?>	
						                    		<th>Approved</th>
												<?php } ?> 						   						                                      
												<?php if(strlen($activate_code) > 0) { ?>	
						                    		<th>Activate Code</th>
												<?php } ?> 						   						                                      
												<?php if(strlen($reset_code) > 0) { ?>	
						                    		<th>Reset Code</th>
												<?php } ?> 						   						                                      
												<?php if(isset($force_pw_chg)) { ?>	
						                    		<th>Force PW Chg</th>
												<?php } ?> 						   						                                      
												<?php if(isset($timed_reset)) { ?>	
						                    		<th>Timed Reset</th>
												<?php } ?> 					   						                                      
												<?php if(strlen($reset_interval) > 0) { ?>	
						                    		<th>Reset Interval</th>
												<?php } ?> 						   						                                      
									   						                                      
												<?php if(strlen($ip_address) > 0) { ?>	
						                    		<th>IP Address</th>
												<?php } ?> 						   						                                      
												<?php if(strlen($homepage) > 0) { ?>	
						                    		<th>Homepage</th>
												<?php } ?> 						   						                                      
												<?php if(isset($created_by)) { ?>	
						                    		<th>Created By</th>
												<?php } ?> 						   						                                      
												<?php if(isset($updated_by)) { ?>	
						                    		<th>Updated By</th>
												<?php } ?> 						   						                                      
												<?php if(isset($created_at) && $created_at != '01/01/1970') { ?>	
						                    		<th>Created At</th>
												<?php } ?> 						   						                                      
												<?php if(isset($updated_at) && $updated_at != '01/01/1970') { ?>	
						                    		<th>Updated At</th>
												<?php } ?>
							                    </tr>
						                    </thead>
					                    <tbody>
												<tr class='gradeA'>
<!--
	If you want to change translated the values in all tables to follow then change the value like this - otherwise just say Yes or No as below
												<?php if(isset($approved)) { ?>
														<?php if($approved = 1) { ?>
															<?=	$approved = 'Yes' ?>

														<?php }else{ ?>
															<?=	$approved = 'No' ?>
														<?php } ?> 
						                    			<td><?= $approved ?></td>
												<?php } ?> 


-->
												<?php if(isset($id)) { ?>	
						                   		 	<td><?= $id ?></td>
												<?php } ?> 
												<?php if(strlen($code) > 0) { ?>	
						                    		<td><?= $code ?></td>
												<?php } ?>
												<?php if(strlen($username) > 0) { ?>	
						                    		<td><?= $username ?></td>
												<?php } ?>
												<?php if(isset($tguserlevelname)) { ?>
										<!--		<php if(strlen($tguserlevelname) > 0) { ?>	-->
						                    		<td><?= $tguserlevelname ?></td>
												<?php } ?>
											<!--	<?php if(isset($status)) { ?>	
						                    		<td><?= $status ?></td>
												<?php } ?> -->
												<?php if(strlen($first_name) > 0) { ?>	
						                    		<td><?= $first_name ?></td>
												<?php } ?>                     	
												<?php if(strlen($middle_name) > 0) { ?>	
						                    		<td><?= $middle_name ?></td>
												<?php } ?>                     	
												<?php if(strlen($last_name)) { ?>	
						                    		<td><?= $last_name ?></td>
												<?php } ?>                     	
												<?php if(strlen($suffix) > 0) { ?>	
						                    		<td><?= $suffix ?></td>
												<?php } ?>
												<?php if(strlen($title)) { ?>	
						                    		<td><?= $title ?></td>
												<?php } ?>                      
												<?php if(strlen($email_address) > 0) { ?>	
						                    		<td><?= $email_address ?></td>
												<?php } ?>                     	  
												<?php if(strlen($phone) > 0) { ?>	
						                    		<td><?= $phone ?></td>
												<?php } ?>                     		
												<?php if(strlen($department) > 0) { ?>	
						                    		<td><?= $department ?></td>
												<?php } ?>
												<?php if(strlen($notes) > 0) { ?>	
						                    		<td><?= $notes ?></td>
												<?php } ?>
												<?php if(strlen($picture) > 0) { ?>	
						                    		<td><?= $picture ?></td>
												<?php } ?> 
												<?php if(strlen($url_string) > 0) { ?>	
						                    		<td><?= $url_string ?></td>
												<?php } ?> 
												<?php if(isset($date_created) && $date_created != '01/01/1970') { ?>	
						                    		<td><?= $date_created ?></td>
												<?php } ?> 												
												<?php if(isset($num_logins)) { ?>	
						                    		<td><?= $num_logins ?></td>
												<?php } ?> 
												<?php if(isset($last_login) && $last_login != '01/01/1970') { ?>	
						                    		<td><?= $last_login ?></td>
												<?php } ?> 
												<?php if(isset($last_logout) && $last_logout != '01/01/1970') { ?>	
						                    		<td><?= $last_logout ?></td>
												<?php } ?> 
												<?php if(isset($token_expires)) { ?>	
						                    		<td><?= $token_expires ?></td>
												<?php } ?> 
												<?php if(isset($trongate_user_id)) { ?>	
						                    		<td><?= $trongate_user_id ?></td>
												<?php } ?>  						                   	
					   						                                      
												<?php if(strlen($user_token) > 0) { ?>	
						                    		<td><?= $user_token ?></td>
												<?php } ?> 						   						                                      

												<?php if(isset($inactive)) { ?>
														<?php if($inactive == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?>

												<?php if(isset($locked)) { ?>
														<?php if($locked == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?>												 						   						                                      
												<?php if(isset($confirmed)) { ?>
														<?php if($confirmed == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?> 	
												<?php if(isset($verified)) { ?>
														<?php if($verified == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 															
												<?php } ?> 	

												<?php if(isset($approved)) { ?>
														<?php if($approved == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?> 

												<?php if(strlen($activate_code) > 0) { ?>	
						                    		<td><?= $activate_code ?></td>
												<?php } ?> 						   						                                      
												<?php if(strlen($reset_code)) { ?>	
						                    		<td><?= $reset_code ?></td>
												<?php } ?> 						   						                                      

												<?php if(isset($force_pw_chg)) { ?>
													<?php if($force_pw_chg == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?> 

												<?php if(isset($timed_reset)) { ?>
														<?php if($timed_reset == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?>
												<?php } ?> 

												<?php if(strlen($reset_interval) > 0) { ?>	
						                    		<td><?= $reset_interval ?></td>
												<?php } ?>

				   						                                      					   						                                      					   						                                      
												<?php if(strlen($ip_address) > 0) { ?>	
						                    		<td><?= $ip_address ?></td>
												<?php } ?> 						   						                                      
												<?php if(strlen($homepage) > 0) { ?>	
						                    		<td><?= $homepage ?></td>
												<?php } ?> 	
												<?php if(isset($created_by)) { ?>	
						                    		<td><?= $created_by ?></td>
												<?php } ?> 						   						                                      
												<?php if(isset($updated_by)) { ?>	
						                    		<td><?= $updated_by ?></td>
												<?php } ?> 						   						                                      
												<?php if(isset($created_at) && $created_at != '01/01/1970') { ?>	
						                    		<td><?= $created_at ?></td>
												<?php } ?> 						   						                                      
												<?php if(isset($updated_at) && $updated_at != '01/01/1970') { ?>	
						                    		<td><?= $updated_at ?></td>
												<?php } ?>
												</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped -->
				                   
				                	</div> <!-- Table Responsive -->

									<br>
 									<strong>Export Single Record - All System Account Table Fields</strong> <br>Raw Data - No Translations or Calculated Fields
 									<br>
 									<br>
						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>												
					                   		 	<th>Id</th>											
											
					                    		<th>Code</th>											
											
					                    		<th>Username</th>
					                    		<th>Password</th>																						
					                    	<!--	<th>Status</th> -->																					
					                    		<th>First</th>																						
					                    		<th>Middle</th>																						
					                    		<th>Last</th>																						
					                    		<th>Suffix</th>																						
					                    		<th>Title</th>																						
					                    		<th>Email</th>																						
					                    		<th>Phone</th>																						
					                    		<th>Department</th>																						
					                    		<th>Notes</th>																						
					                    		<th>Photo</th>																						
					                    		<th>URL String</th>																						
					                    		<th>Date Created</th>																						
					                    		<th>No Logins</th>																						
					                    		<th>Last Login</th>																						
					                    		<th>Last Logout</th>																					
					                    		<th>TG User Id</th>																						
					                    		<th>User Token</th>																						

					                    		<th>Login Inactive</th>																						
					                    		<th>Login Locked</th>						                    		
					                    		<th>Email Confirmed</th>																							
					                    		<th>Verified Identity</th>																						
					                    		<th>Approved</th>																						
					                    		<th>Activate Code</th>																						
					                    		<th>Reset Code</th>																						
					                    		<th>Force PW Chg</th>																						
					                    		<th>Timed Reset</th>																						
					                    		<th>Reset Interval</th>																						
					                    		<th>IP Address</th>																						
					                    		<th>Homepage</th>
					                    		<th>Created By</th>																						
					                    		<th>Updated By</th>																						
					                    		<th>Created At</th>																						
					                    		<th>Updated At</th>

							                    </tr>
						                    </thead>
					                    <tbody>
											<tr class='gradeA'>

					                   		 	<td><?= $id ?></td>																						
					                    		<td><?= $code ?></td>																						
					                    		<td><?= $username ?></td>
					                    		<td>#######</td>																						
					                    	<!--	<td><?= $status ?></td>	-->																				
					                    		<td><?= $first_name ?></td>																						
					                    		<td><?= $middle_name ?></td>											
					                    		<td><?= $last_name ?></td>																						
					                    		<td><?= $suffix ?></td>																						
					                    		<td><?= $title ?></td>																						
					                    		<td><?= $email_address ?></td>											
					                    		<td><?= $phone ?></td>																						
					                    		<td><?= $department ?></td>																						
					                    		<td><?= $notes ?></td>																						
					                    		<td><?= $picture ?></td>																						
					                    		<td><?= $url_string ?></td>																						
					                    		<td><?= $date_created_raw ?></td>											
					                    		<td><?= $num_logins ?></td>											
					                    		<td><?= $last_login_raw ?></td>											
					                    		<td><?= $last_logout_raw ?></td>
					                    		<td><?= $trongate_user_id ?></td>
					                    		<td><?= $user_token ?></td>

					                    		<td><?= $inactive ?></td>
					                    		<td><?= $locked ?></td>					                    		
					                    		<td><?= $confirmed ?></td>					                    		
					                    		<td><?= $verified ?></td>
					                    		<td><?= $approved ?></td>
					                    		<td><?= $activate_code ?></td>
					                    		<td><?= $reset_code ?></td>
					                    		<td><?= $force_pw_chg ?></td>
					                    		<td><?= $timed_reset ?></td>
					                    		<td><?= $reset_interval ?></td>

					                    		<td><?= $ip_address ?></td>
					                    		<td><?= $homepage ?></td>
					                    		<td><?= $created_by_raw ?></td>
					                    		<td><?= $updated_by_raw ?></td>
					                    		<td><?= $created_at_raw ?></td>
					                    		<td><?= $updated_at_raw ?></td>
											</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped -->
				                   
				                	</div> <!-- Table Responsive -->
				                	<br>
                                    <strong>Export Single Record - Financial Account Table Fields with Data</strong> <br>User Friendly Version - Translations & Calculated Fields
                                    <br>
                                    <br>

						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>
												<?php if(isset($fin_id)) { ?>	
						                   		 	<th>Id</th>
												<?php } ?>

					                   		 	<?php if(strlen($fin_code) > 0) { ?>											
					                    			<th>Code</th>
					                    		<?php } ?>

					                    		<?php if(strlen($sys_acct_id) > 0) { ?>										
					                    		<th>System Acct Id</th>
					                    		<?php } ?>

												<?php if(strlen($acct_type) > 0) { ?>	
					                    		<th>Acct Type</th>
					                    		<?php } ?>

					                    		<?php if(strlen($acct_bal) > 0) { ?>																
					                    		<th>Acct Bal</th>
					                    		<?php } ?>

					                    		<?php if(isset($fin_inactive)) { ?>																	
					                    		<th>$ Acct Inactive</th>
					                    		<?php } ?>

					                    		<?php if(strlen($fin_status) > 0) { ?>					
					                    		<th>Status</th>
					                    		<?php } ?>

					                    		<?php if(strlen($fin_email) > 0) { ?>
					                    		<th>Email</th>
					                    		<?php } ?>

					                    		<?php if(strlen($billname) > 0) { ?>																				
					                    		<th>Bill Name</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($billphone) > 0) { ?>																
					                    		<th>Bill Phone</th>
					                    		<?php } ?>

					                    		<?php if(strlen($billaddress1) > 0) { ?>
					                    		<th>Bill Addr1</th>
					                    		<?php } ?>

					                    		<?php if(strlen($billaddress2) > 0) { ?>
					                    		<th>Bill Addr2</th>
					                    		<?php } ?>

					                    		<?php if(strlen($billcity) > 0) { ?>
					                    		<th>Bill City</th>
					                    		<?php } ?>

					                    		<?php if(strlen($billstate) > 0) { ?>
					                    		<th>Bill State</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($billzip) > 0) { ?>
					                    		<th>Bill Zip</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($shipname) > 0) { ?>
					                    		<th>Ship Name</th>
					                    		<?php } ?>

					                    		<?php if(strlen($shipphone) > 0) { ?>
					                    		<th>Ship Phone</th>
					                    		<?php } ?>

					                    		<?php if(strlen($shipaddress1) > 0) { ?>																			
					                    		<th>Ship Addr1</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($shipaddress2) > 0) { ?>															
					                    		<th>Ship Addr2</th>
					                    		<?php } ?>

					                    		<?php if(strlen($shipcity) > 0) { ?>					          									
					                    		<th>Ship City</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($shipstate) > 0) { ?>							
					                    		<th>Ship State</th>
					                    		 <?php } ?> 

					                    		<?php if(strlen($shipzip) > 0) { ?>																	
					                    		<th>Ship Zip</th>
					                    		<?php } ?>

					                    		<?php if(strlen($fin_notes) > 0) { ?>
					                    		<th>Notes</th>
					                    		<?php } ?> 

					                    		<?php if(isset($fin_date_created) && $fin_date_created != '01/01/1970') { ?>				               
					                    		<th>Date Created</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($fin_created_by) > 0) { ?>
					                    		<th>Created By</th>
					                    		<?php } ?>

					                    		<?php if(strlen($fin_updated_by) > 0) { ?>
					                    		<th>Updated By</th>
					                    		<?php } ?>
						   						                                      
												<?php if(isset($fin_created_at) && $fin_created_at != '01/01/1970') { ?>	
						                    		<th>Created At</th>
												<?php } ?> 						   						                                      
												<?php if(isset($fin_updated_at) && $fin_updated_at != '01/01/1970') { ?>	
						                    		<th>Updated At</th>
												<?php } ?>

							                    </tr>
						                    </thead>
					                    <tbody>
												<tr class='gradeA'>

												<?php if(isset($fin_id)) { ?>	
						                   		 	<td><?= $fin_id ?></td>
												<?php } ?>

												<?php if(strlen($fin_code) > 0) { ?>	
						                    		<td><?= $fin_code ?></td>
												<?php } ?>

												<?php if(strlen($sys_acct_id) > 0) { ?>	
						                    		<td><?= $sys_acct_id ?></td>
												<?php } ?>

												<?php if(strlen($acct_type) > 0) { ?>	
						                    		<td><?= $acct_type ?></td>
												<?php } ?>

												<?php if(strlen($acct_bal) > 0) { ?>	
						                    		<td><?= $acct_bal ?></td>
												<?php } ?>

												<?php if(isset($fin_inactive)) { ?>
														<?php if($fin_inactive == 1) { ?>
						                    				<td>Yes</td>
														<?php }else{ ?>
															<td>No</td>
														<?php } ?> 
												<?php } ?>

												<?php if(strlen($fin_status) > 0) { ?>	
						                    		<td><?= $fin_status ?></td>
												<?php } ?>

												<?php if(strlen($fin_email) > 0) { ?>	
						                    		<td><?= $fin_email ?></td>
												<?php } ?>

												<?php if(strlen($billname) > 0) { ?>	
						                    		<td><?= $billname ?></td>
												<?php } ?>

												<?php if(strlen($billphone) > 0) { ?>	
						                    		<td><?= $billphone ?></td>
												<?php } ?>

												<?php if(strlen($billaddress1) > 0) { ?>	
						                    		<td><?= $billaddress1 ?></td>
												<?php } ?>

												<?php if(strlen($billaddress2) > 0) { ?>	
						                    		<td><?= $billaddress2 ?></td>
												<?php } ?>

												<?php if(strlen($billcity) > 0) { ?>	
						                    		<td><?= $billcity ?></td>
												<?php } ?>

												<?php if(strlen($billstate) > 0) { ?>	
						                    		<td><?= $billstate ?></td>
												<?php } ?>

												<?php if(strlen($billzip) > 0) { ?>	
						                    		<td><?= $billzip ?></td>
												<?php } ?>

												<?php if(strlen($shipname) > 0) { ?>	
						                    		<td><?= $shipname ?></td>
												<?php } ?>

												<?php if(strlen($shipphone) > 0) { ?>	
						                    		<td><?= $shipphone ?></td>
												<?php } ?>

												<?php if(strlen($shipaddress1) > 0) { ?>	
						                    		<td><?= $shipaddress1 ?></td>
												<?php } ?>

												<?php if(strlen($shipaddress2) > 0) { ?>	
						                    		<td><?= $shipaddress2 ?></td>
												<?php } ?>

												<?php if(strlen($shipcity) > 0) { ?>	
						                    		<td><?= $shipcity ?></td>
												<?php } ?>

												<?php if(strlen($shipstate) > 0) { ?>	
						                    		<td><?= $shipstate ?></td>
												<?php } ?>

												<?php if(strlen($shipzip) > 0) { ?>	
						                    		<td><?= $shipzip ?></td>
												<?php } ?>

												<?php if(strlen($fin_notes) > 0) { ?>	
						                    		<td><?= $fin_notes ?></td>
												<?php } ?>

												<?php if(isset($fin_date_created) && $fin_date_created != '01/01/1970') { ?>	
						                    		<td><?= $fin_date_created ?></td>
												<?php } ?> 												
	
												<?php if(isset($fin_created_by)) { ?>	
						                    		<td><?= $fin_created_by ?></td>
												<?php } ?> 

												<?php if(isset($fin_updated_by)) { ?>	
						                    		<td><?= $fin_updated_by ?></td>
												<?php } ?> 

												<?php if(isset($fin_created_at) && $fin_created_at != '01/01/1970') { ?>	
						                    		<td><?= $fin_created_at ?></td>
												<?php } ?> 	

												<?php if(isset($fin_updated_at) && $fin_updated_at != '01/01/1970') { ?>	
						                    		<td><?= $fin_updated_at ?></td>
												<?php } ?>

												</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped -->
				                   
				                	</div> <!-- Table Responsive -->

									<br>
 									<strong>Export Single Record - All Financial Account Table Fields</strong> <br>Raw Data - No Translations or Calculated Fields
 									<br>
 									<br>
						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>												
					                   		 	<th>Id</th>											
					                    		<th>Code</th>											
					                    		<th>System Acct Id</th>
					                    		<th>Acct Type</th>																				
					                    		<th>Acct Bal</th>																					
					                    		<th>$ Acct Inactive</th>																					
					                    		<th>$ Acct Status</th>																						
					                    		<th>Email</th>																						
					                    		<th>Bill Name</th>																			
					                    		<th>Bill Phone</th>
					                    		<th>Bill Addr1</th>
					                    		<th>Bill Addr2</th>
					                    		<th>Bill City</th>
					                    		<th>Bill State</th>
					                    		<th>Bill Zip</th>
					                    		<th>Ship Name</th>
					                    		<th>Ship Phone</th>																				
					                    		<th>Ship Addr1</th>																				
					                    		<th>Ship Addr2</th>						          													
					                    		<th>Ship City</th>								
					                    		<th>Ship State</th>																					
					                    		<th>Ship Zip</th>																					
					                    		<th>Notes</th>						                    		
					                    		<th>Date Created</th>
					                    		<th>Created By</th>	
					                    		<th>Updated By</th>	
					                    		<th>Created At</th>																					
					                    		<th>Updated At</th>																					
							                </tr>
						                    </thead>
					                    <tbody>
											<tr class='gradeA'>

					                   		 	<td><?= $fin_id ?></td>																				
					                    		<td><?= $fin_code ?></td>																			
					                    		<td><?= $sys_acct_id ?></td>
					                    		<td><?= $acct_type ?></td>																		
					                    		<td><?= $acct_bal ?></td>																			
					                    		<td><?= $fin_inactive ?></td>											
					                    		<td><?= $fin_status ?></td>																			
					                    		<td><?= $fin_email ?></td>																			
					                    		<td><?= $billname ?></td>																			
					                    		<td><?= $billphone ?></td>											
					                    		<td><?= $billaddress1 ?></td>																		
					                    		<td><?= $billaddress2 ?></td>																		
					                    		<td><?= $billcity ?></td>																			
					                    		<td><?= $billstate ?></td>																			
					                    		<td><?= $billzip ?></td>																			
					                    		<td><?= $shipname ?></td>																			
					                    		<td><?= $shipphone ?></td>											
					                    		<td><?= $shipaddress1 ?></td>																		
					                    		<td><?= $shipaddress2 ?></td>																		
					                    		<td><?= $shipcity ?></td>																			
					                    		<td><?= $shipstate ?></td>																			
					                    		<td><?= $shipzip ?></td>
					                    		<td><?= $fin_notes ?></td>					                    		
					                    		<td><?= $fin_date_created ?></td>					                    		
					                    		<td><?= $fin_created_by_raw ?></td>
					                    		<td><?= $fin_updated_by_raw ?></td>
					                    		<td><?= $fin_created_at_raw ?></td>
					                    		<td><?= $fin_updated_at_raw ?></td>

											</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped -->
				                   
				                	</div> <!-- Table Responsive -->
 									</div> <!-- ibox for tab 5 -->
                                </div> <!-- Panel Body for tab 5 -->
                            </div> <!--  Tab Panel for tab 5 -->
<?php endif; ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->

              	</div> <!-- Tab Content for All Tabs  -->


                <br>
                <div class="modal" id="delete-modal" style="display: none;">
    <div class="modal-heading danger"><i class="fa fa-trash"></i> Delete Record</div>
    <div class="modal-body">
        <?= form_open('members/submit_delete/'.$update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a Member record.  This cannot be undone.  Do you really want to do this?</p> 
        <?php 
        echo '<p>'.form_button('close', 'Cancel', $attr_close);
        echo form_submit('submit', 'Yes - Delete Now', array("class" => 'danger')).'</p>';
        echo form_close();
        ?>
    </div>
</div>
		        <div class="btn-group">

<!--
 <php if($action3_d > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  --
                    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/create/<?= $recid ?>/v" >Update</a>

                    <a class="btn btn-outline btn-danger" type="button" onClick="return confirm('This account will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v">Delete</a>

                    <a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Close</a>


 					<a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal2"> <!-- myModal2 is for resetting passwords --
                            myReset Password
                    </a>
                   

                    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Reset Password</h4>
                                    <small class="font-bold">Enter your new password and confirm</small>
                                </div> 
                            <!-- Show flash message then reset it to blank  -->
                       <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> no way to refresh modal to see the message --
                           <center><h3 id="result" ></h3></center>

                             <form action="" method = "post">                                
                                <div class="modal-body">                                  
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password" >
                                    </div>  
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password" >
                                    </div>
                                    <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  --
                                        <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>"  hidden>
                                    </div>
									<div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw  by way of JS in layoutone.php --
                                        <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="system_accounts" hidden>
                                    </div>
                                   <div class="form-group"> <!-- Used to pass the recid to ajax function  --
                                        <input type="text" class="form-control" name="recid" id="recid" value="<?= $recid ?>"  hidden>
                                    </div> 



                                </div>
                                <div class="modal-footer">

<input type="button" value="Reset Password"class="btn btn-primary block full-width m-b" name="ResetID" id="ResetBtn" ></input>

                                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>

<php else: ?> -->
	                <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/create/<?= $recid ?>/v" >Update</a>

                    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Close</a>
				
                        <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal">
                            Change My System Account Password
                        </a>
                   

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
                            set_flashdata($flash_msg); ?> no way to refresh modal to see the message -->
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
                                    <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  -->
                                        <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>"  hidden>
                                    </div> 
									<div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw by way of JS in layoutone.php -->
                                        <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="system_accounts" hidden>
                                    </div>

									<div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                        <input type="text" class="form-control" name="recid" id="recid" value="<?= $recid ?>"  hidden>
                                    </div> 									
                                </div>
                                <div class="modal-footer">

<input type="button" value="Submit"class="btn btn-primary block full-width m-b" name="ChangeID" id="ChangeBtn" ></input>

                                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>


<!-- <php endif; ?> -->
				



                <!--    <a class="btn btn-danger btn-outline demo4" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v" type="button" >Delete</a> -->
                </div>
           


</div> <!--  tabs container -->

</div> <!-- ibox content for the page content section -->

