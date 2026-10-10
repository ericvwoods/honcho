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
		        	<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/> 
				<!--	<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
				</div> <!-- end col -->
				<div class="col-md-6">
					<br>
			    	<h2>
			    		<?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?></h2>

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
                        	<li><a class="nav-link active" data-toggle="tab" href="#tab-1">Contact Info</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Credentials</a></li>                           	
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3">Financial Account</a></li>                        	
                            <li><a class="nav-link" data-toggle="tab" href="#tab-4">User Account</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-5">User Account Status</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-6">User Account Activity</a></li>

<?php if($action3_c > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                            <li><a class="nav-link" data-toggle="tab" href="#tab-7">Export</a></li>
<?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active"> <!-- 1 Contact Info   -->
                                <div class="panel-body">
									<div class="ibox-content"> 
									                         
		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				<br>
                        				
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Member Number</strong></label>
													<div class="col-sm-5"><?= $member_no ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Current Year</strong></label>
													<div class="col-sm-5"><?= $current_year ?></div> 
		                                        </div> 		                                         
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Member Type</strong> </label>
													<div class="col-sm-5"><?= $member_type ?></div> 
		                                        </div>	                                         
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Eligible Voter</strong> </label>
													<div class="col-sm-5"><?= $eligible_voter ?></div> 
		                                        </div>		                                        		                                        
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Email</strong> </label>
													<div class="col-sm-5"><?= $email_address ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Phone</strong> </label>
													<div class="col-sm-5"><?= $phone ?></div> 
		                                        </div> 	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mobile</strong> </label>
													<div class="col-sm-5"><?= $mobile ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Fax</strong> </label>
													<div class="col-sm-5"><?= $fax ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Opt Out Email</strong> </label>
													<div class="col-sm-5"><?= $emailoptout ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Do Not Call</strong> </label>
													<div class="col-sm-5"><?= $donotcall ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Deceased</strong> </label>
													<div class="col-sm-5"><?= $deceased ?></div> 
		                                        </div>   
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>No Address</strong> </label>
													<div class="col-sm-5"><?= $no_address ?></div> 
		                                        </div>		

		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Special Event</strong> </label>
													<div class="col-sm-5"><?= $special_event ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Record Created</strong></label>
													<div class="col-sm-5"><?= $created_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Created By</strong></label>
													<div class="col-sm-5"><?= $created_by ?></div> 
		                                        </div>	
												<div class="ibox-content">
												<center><strong>Mailing Address</strong></center>
												<br>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail Address1</strong></label> 
														<div class="col-sm-5"><?= $mailaddress1 ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail Address2</strong></label> 
														<div class="col-sm-5"><?= $mailaddress2 ?></div>
													</div>	 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail City</strong></label> 
														<div class="col-sm-5"><?= $mailcity ?></div> 
			                                        </div>		                                       
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail State</strong></label> 
														<div class="col-sm-5"><?= $mailstate ?></div> 
			                                        </div>	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail Zipcode</strong></label> 
														<div class="col-sm-5"><?= $mailzip ?></div> 
			                                        </div>
		                                        
												</div>


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>
	                                        
		                                   <!--     <div class="form-group row"><label class="col-lg-3 "><strong>Region</strong></label>
													<div class="col-sm-5"><= $region ?></div> 
		                                        </div>	-->		                                        		                                    	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Chapter</strong> </label>
													<div class="col-sm-5"><?= $chapter ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Chapter Role</strong> </label>
													<div class="col-sm-5"><?= $chapter_role ?></div> 
		                                        </div>
												<div class="form-group row"><label class="col-lg-3 "><strong>Chapter Admin</strong> </label>
													<div class="col-sm-5"><?= $chapter_admin ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Call Sign</strong> </label>
													<div class="col-sm-5"><?= $call_sign ?></div> 
		                                        </div>		                                        
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Mail Newsletter</strong> </label>
													<div class="col-sm-5"><?= $mail_notices ?></div> 
		                                        </div> 
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Gender</strong> </label>
													<div class="col-sm-5"><?= $gender ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Birthday</strong> </label>
													<div class="col-sm-5"><?= $birthday ?></div> 
		                                        </div>                                   	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Aircraft Owner</strong> </label>
													<div class="col-sm-5"><?= $aircraft_owner ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Aircraft Type</strong> </label>
													<div class="col-sm-5"><?= $aircraft_type ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Aircraft Reg #</strong> </label>
													<div class="col-sm-5"><?= $aircraft_reg ?></div>
		                                        </div>			                                        	
                                     
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Miscellaneous 1</strong> </label>
													<div class="col-sm-5"><?= $misc1 ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Miscellaneous 2</strong> </label>
													<div class="col-sm-5"><?= $misc2 ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Miscellaneous 3</strong> </label>
													<div class="col-sm-5"><?= $misc3 ?></div> 
		                                        </div>  		                                          		                                          
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Last Updated</strong></label>
													<div class="col-sm-5"><?= $updated_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Updated By</strong></label>
													<div class="col-sm-5"><?= $updated_by ?></div> 
		                                        </div>	
<!-- <p> .</p> -->
												<div class="ibox-content">
												<center><strong>Physical Address</strong></center>
												<br>	                                        
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phy Address 1</strong></label> 
														<div class="col-sm-5"><?= $physaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phy Address 2</strong></label> 
														<div class="col-sm-5"><?= $physaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phy City</strong></label> 
														<div class="col-sm-5"><?= $physcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phy State</strong></label> 
														<div class="col-sm-5"><?= $physstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phy Zipcode</strong></label> 
														<div class="col-sm-5"><?= $physzip ?></div> 
			                                        </div>
		                                    	</div>                                                           
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Member Record Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $notes ?></span>
		                                    </div>
		                                </div> 


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                            	

                            </div> <!-- End Tab 1 Panel -->

                            <div role="tabpanel" id="tab-2" class="tab-pane"> <!-- 2 Misc   -->
                               <div class="panel-body">
									<div class="ibox-content"> 
									                         
		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				<br>
                        				
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Highest Certificate</strong></label>
													<div class="col-sm-5"><?= $highest_certificate ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>HC Cert #</strong></label>
													<div class="col-sm-5"><?= $certificate_number ?></div> 
		                                        </div> 		                                         
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Total Time</strong> </label>
													<div class="col-sm-5"><?= $total_time ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>VIP</strong> </label>
													<div class="col-sm-5"><?= $vip ?></div> 
		                                        </div>

												<div class="ibox-content">
													<center><strong>Other Certificates & Certifications</strong></center>
													<br>		                                        	                                         
			                                    <!--    <div class="form-group row"><label class="col-lg-3 "><strong>Student</strong> </label>
														<div class="col-sm-5"><?= $student ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Private</strong> </label>
														<div class="col-sm-5"><?= $private ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Commercial</strong> </label>
														<div class="col-sm-5"><?= $commercial ?></div> 
			                                        </div> 	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>ATP</strong> </label>
														<div class="col-sm-5"><?= $atp ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Drone</strong> </label>
														<div class="col-sm-5"><?= $drone ?></div> 
			                                        </div> -->
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Other Crewmember</strong> </label>
														<div class="col-sm-5"><?= $other_crewmember ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>OC Cert #</strong> </label>
														<div class="col-sm-5"><?= $ocm_certnum ?></div> 
			                                        </div>

			                                        <div class="form-group row"><label class="col-lg-3 "><strong>A&P</strong> </label>
														<div class="col-sm-5"><?= $ap ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>A&P #</strong> </label>
														<div class="col-sm-5"><?= $ap_number ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>IA</strong> </label>
														<div class="col-sm-5"><?= $ia ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Military A&P</strong> </label>
														<div class="col-sm-5"><?= $military_maint ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Maintenance</strong> </label>
														<div class="col-sm-5"><?= $maintenance ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Air Traffic Cont</strong> </label>
														<div class="col-sm-5"><?= $atc ?></div> 
			                                        </div>					                                        		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Dispatcher</strong> </label>
														<div class="col-sm-5"><?= $dispatcher ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Other FAA Cert</strong> </label>
														<div class="col-sm-5"><?= $other_faa_cert ?></div> 
			                                        </div>		
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Other FAA Cert #</strong> </label>
														<div class="col-sm-5"><?= $ofc_certnum ?></div> 
			                                        </div>		
			                                    </div>	<!-- ibox-content -->

		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Hall of Fame</strong></label>
													<div class="col-sm-5"><?= $hall_of_fame ?></div> 
		                                        </div>		                                    	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Active Duty</strong> </label>
													<div class="col-sm-5"><?= $active_duty ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Former Military</strong> </label>
													<div class="col-sm-5"><?= $former_military ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Military Pilot</strong> </label>
													<div class="col-sm-5"><?= $military_pilot ?></div> 
		                                        </div>

												<div class="ibox-content">
													<center><strong>Ratings</strong></center>
													<br>

			                                        <div class="form-group row"><label class="col-lg-3 "><strong>SE Land</strong> </label>
														<div class="col-sm-5"><?= $se_land ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>ME Land</strong> </label>
														<div class="col-sm-5"><?= $me_land ?></div> 
			                                        </div>                                   	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>SE Sea</strong> </label>
														<div class="col-sm-5"><?= $se_sea ?></div> 
			                                        </div>	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>ME Sea</strong> </label>
														<div class="col-sm-5"><?= $me_sea ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Instrument</strong> </label>
														<div class="col-sm-5"><?= $instrument ?></div> 
			                                        </div>			                                        	
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>CFI</strong> </label>
														<div class="col-sm-5"><?= $cfi ?></div> 
			                                        </div>                                        
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>CFII</strong> </label>
														<div class="col-sm-5"><?= $cfii ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>MEI</strong> </label>
														<div class="col-sm-5"><?= $mei ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>DPE</strong> </label>
														<div class="col-sm-5"><?= $dpe ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>BGI</strong> </label>
														<div class="col-sm-5"><?= $bgi ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>AGI</strong> </label>
														<div class="col-sm-5"><?= $agi ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Rotocraft</strong> </label>
														<div class="col-sm-5"><?= $rotocraft ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Glider</strong> </label>
														<div class="col-sm-5"><?= $glider ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Balloon</strong> </label>
														<div class="col-sm-5"><?= $balloon ?></div> 
			                                        </div> 
			                                        <div class="form-group row"><label class="col-lg-3 "><strong>Airship</strong> </label>
														<div class="col-sm-5"><?= $airship ?></div> 
			                                        </div> 

		                                    </div> <!-- ibox-content -->
                                                          
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Credential Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $cred_notes ?></span>
		                                    </div>
		                                </div>


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                           	

							</div> <!-- End Tab 2 Panel  -->

                            <div role="tabpanel" id="tab-3" class="tab-pane"> <!-- 3 Financial Account  -->
                                <div class="panel-body">
									<div class="ibox-content"> 
									                         
		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				<br>

		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Financial Acct Id</strong> </label>
													<div class="col-sm-5"><?= $fin_id ?></div> 
		                                        </div> 
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Financial Acct Type</strong> </label>
													<div class="col-sm-5"><?= $fin_acct_type ?></div> 
		                                        </div> 	                 
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Billing Email</strong></label> 
													<div class="col-sm-5"><?= $fin_email ?></div> 
		                                        </div>
										<div class="ibox-content">
												<center><strong>Billing Address</strong></center>
												<br>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Bill To</strong></label> 
														<div class="col-sm-5"><?= $billname ?></div> 
			                                        </div>

			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Bill Phone</strong></label> 
														<div class="col-sm-5"><?= $billphone ?></div> 
			                                        </div>														                                        
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Address 1</strong></label> 
														<div class="col-sm-5"><?= $billaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Address 2</strong></label> 
														<div class="col-sm-5"><?= $billaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>City</strong></label> 
														<div class="col-sm-5"><?= $billcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>State</strong></label> 
														<div class="col-sm-5"><?= $billstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Zipcode</strong></label> 
														<div class="col-sm-5"><?= $billzip ?></div> 
			                                        </div>
		                                    	</div> 


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>	                                    	
		                                        <div class="form-group row"><label class="col-lg-4 "><strong>Balance</strong></label> 
													<div class="col-sm-5"><?= $acct_bal ?></div> 
		                                        </div>		                                    	

		                                        <div class="form-group row"><label class="col-lg-4 "><strong>Fin Acct Status</strong></label> 
													<div class="col-sm-5"><?= $fin_status ?></div> 
		                                        </div>

		                            	        <div class="form-group row"><label class="col-lg-4 "><strong>Fin Acct Inactive</strong></label>

													<?php if( $fin_inactive  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	
												<div class="ibox-content">
												<center><strong>Shipping Address</strong></center>
												<br>													
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

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Financial Account Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $fin_notes ?></span>
		                                    </div>
		                                </div>


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->
                            </div> <!-- End Tab 3 Panel -->


                            <div role="tabpanel" id="tab-4" class="tab-pane"> <!-- 4 User Account   -->
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

		                                  <!--     		<div class="form-group row"><label class="col-lg-3 "><strong>Email</strong></label> 
														<div class="col-sm-5"><?= $email_address ?></div> 
			                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Title</strong></label> 
													<div class="col-sm-5"><?= $title ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Org/Unit</strong></label> 
													<div class="col-sm-5"><?= $department ?></div> 
		                                        </div> -->


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-4">
		                                    	<br>

		                                        <div class="form-group row"><label class="col-lg-4 "><strong>User Id</strong></label> 
													<div class="col-sm-5"><?= $trongate_user_id ?></div> 
		                                        </div>

		                                        <?php if($action2_r == 1 ): ?>
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Phone</strong></label> 
														<div class="col-sm-5"><?= $phone ?></div> 
			                                        </div>

			                                    	
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Photo</strong></label> 
														<div class="col-sm-5" ><?= $picture ?></div> 
			                                        </div>
	           <form action="<?= BASE_URL ?>honcho/index/ccmps/uploadsysacctpic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">   <!--  .../submodule/$task/$recid/$frmpg/filter) & the task calls the submit_upload_picture function() -->
			<!--	<form action="submit upload picture/1" method="post" enctype="multipart/form-data"> -->
						<input type="file" name="picture" value="">
						<button type="submit" name="submit" value="Upload">Upload Photo</button>
	                <div class="form-group">
						<button class="btn btn-rounded btn-outline btn-primary" name="submit" type="submit" value="Upload">Upload Picture</button> 
					</div>  
				</form>			           
			                                        
												<?php endif; ?>


		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->


									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                            	

							</div> <!-- End Tab 4 Panel -->


                            <div role="tabpanel" id="tab-5" class="tab-pane"> <!-- 5 User Account Status   -->
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

		                            	<!--        <div class="form-group row"><label class="col-lg-3 "><strong>Email Confirmed</strong></label>

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
												</div> -->



			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>IP Address</strong></label> 
													<div class="col-sm-5"><?= $ip_address ?></div> 
			                                    </div> 
			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Token Exp</strong></label> 
													<div class="col-sm-5"><?= $token_expires ?></div> 
			                                    </div>  

											</div> <!-- end col -->
											<div class="col-md-6">

			                        	        <div class="form-group row"><label class="col-lg-3 "><strong>Reset Code</strong></label> 
													<div class="col-sm-5"><?= $reset_code ?></div> 
			                                    </div> 	                                     
			                        	<!--        <div class="form-group row"><label class="col-lg-3 "><strong>Activate Code</strong></label> 
													<div class="col-sm-5"><?= $activate_code ?></div> 
			                                    </div> -->


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

							</div> <!-- End Tab 5 -->

                            <div role="tabpanel" id="tab-6" class="tab-pane"> <!-- 6 User Account Activity   -->
                                <div class="panel-body">
									<div class="ibox-content">
									<br>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>No Logins</strong></label> 
											<div class="col-sm-5"><?= $num_logins ?></div> 
                                        </div>                                        
	                        	        <div class="form-group row"><label class="col-lg-2 "><strong>Last Login Device</strong></label> 
											<div class="col-sm-5"><?= $last_login_device ?></div> 
	                                    </div> 
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Last Login</strong></label> 
											<div class="col-sm-5"><?= $last_login ?></div> 
                                        </div>
                            	        <div class="form-group row"><label class="col-lg-2 "><strong>Last Logout</strong></label> 
											<div class="col-sm-5"><?= $last_logout ?></div> 
                                        </div>

                                <!--        <div class="form-group row"><label class="col-lg-2 "><strong>Date Created</strong></label> 
											<div class="col-sm-5"><?= $date_created ?></div> 
                                        </div> -->


 								</div> <!-- ibox content -->
                                                                                                                                                                                                                                                               
                                </div>  <!-- end panel -->    
                            </div> <!-- End Tab 6 Panel -->




 <!--<?php if($action3_c > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
				            <div role="tabpanel" id="tab-7" class="tab-pane">
                                <div class="panel-body">
									<div class="ibox-content">                                    	
                                    <strong>Export Member Record - Only Fields with Data or Yes Response</strong>
                                    <br>
                                    <br>

						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>

												<?php if(strlen($id) > 0) { ?>	
						                   		 	<th>Tbl Id</th>
												<?php } ?>
												<?php if($trongate_user_id > 0) { ?>	
						                    		<th>User Id</th>
												<?php } ?>  
											<!--	<php if(strlen($code) > 0) { ?>	
						                    		<th>Code</th>
												<php } ?> -->
												<?php if(strlen($username) > 0) { ?>	
						                    		<th>Username</th>
												<?php } ?>
												<?php if(strlen($tguserlevelname) > 0) { ?>	
						                    		<th>Access Level</th>
												<?php } ?>

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


					                    		<?php if(strlen($mailaddress1) > 0) { ?>
					                    		<th>Mail Addr1</th>
					                    		<?php } ?>

					                    		<?php if(strlen($mailaddress2) > 0) { ?>
					                    		<th>Mail Addr2</th>
					                    		<?php } ?>

					                    		<?php if(strlen($mailcity) > 0) { ?>
					                    		<th>Mail City</th>
					                    		<?php } ?>

					                    		<?php if(strlen($mailstate) > 0) { ?>
					                    		<th>Mail State</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($mailzip) > 0) { ?>
					                    		<th>Mail Zip</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($physaddress1) > 0) { ?>																			
					                    		<th>Phy Addr1</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($physaddress2) > 0) { ?>															
					                    		<th>Phy Addr2</th>
					                    		<?php } ?>

					                    		<?php if(strlen($physcity) > 0) { ?>					          									
					                    		<th>Phy City</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($physstate) > 0) { ?>							
					                    		<th>Phy State</th>
					                    		 <?php } ?> 

					                    		<?php if(strlen($physzip) > 0) { ?>																	
					                    		<th>Phy Zip</th>
					                    		<?php } ?>


					                    	<!--	<php if($mail_phys > 0) { ?>																	
					                    		<th>Mail=Phys</th>
					                    		<php } ?> -->

					                    		<?php if($vip > 0) { ?>																	
					                    		<th>VIP</th>
					                    		<?php } ?>

					                    		<?php if($student > 0) { ?>																	
					                    		<th>Student</th>
					                    		<?php } ?>

					                    		<?php if($private > 0) { ?>																	
					                    		<th>Private</th>
					                    		<?php } ?>

					                    		<?php if($commercial > 0) { ?>																	
					                    		<th>Commercial</th>
					                    		<?php } ?>

					                    		<?php if($atp > 0) { ?>																	
					                    		<th>ATP</th>
					                    		<?php } ?>

					                    		<?php if($drone > 0) { ?>																	
					                    		<th>Drone</th>
					                    		<?php } ?>

					                    		<?php if(strlen($other_crewmember) > 0) { ?>																	
					                    		<th>Other Crew</th>
					                    		<?php } ?>

					                    		<?php if(strlen($ocm_certnum) > 0) { ?>																	
					                    		<th>Other Cert #</th>
					                    		<?php } ?>

					                    		<?php if($ap > 0) { ?>																	
					                    		<th>A&P</th>
					                    		<?php } ?>

					                    		<?php if(strlen($ap_number) > 0) { ?>																	
					                    		<th>A&P #</th>
					                    		<?php } ?>

					                    		<?php if($ia > 0) { ?>																	
					                    		<th>IA</th>
					                    		<?php } ?>

					                    		<?php if($military_maint > 0) { ?>																	
					                    		<th>Military A&P</th>
					                    		<?php } ?>

					                    		<?php if($maintenance > 0) { ?>																	
					                    		<th>Manintenance</th>
					                    		<?php } ?>

					                    		<?php if($atc > 0) { ?>																	
					                    		<th>ATC</th>
					                    		<?php } ?>

					                    		<?php if($dispatcher > 0) { ?>																	
					                    		<th>Dispatcher</th>
					                    		<?php } ?>

					                    		<?php if(strlen($other_faa_cert) > 0) { ?>																	
					                    		<th>Other Cert</th>
					                    		<?php } ?>

					                    		<?php if(strlen($ofc_certnum) > 0) { ?>																	
					                    		<th>Other Cert #</th>
					                    		<?php } ?>

					                    		<?php if($se_land > 0) { ?>																	
					                    		<th>SE Land</th>
					                    		<?php } ?>

					                    		<?php if($me_land > 0) { ?>																	
					                    		<th>ME Land</th>
					                    		<?php } ?>

					                    		<?php if($se_sea > 0) { ?>																	
					                    		<th>SE Sea</th>
					                    		<?php } ?>

					                    		<?php if($me_sea > 0) { ?>																	
					                    		<th>ME Sea</th>
					                    		<?php } ?>

					                    		<?php if($instrument > 0) { ?>																	
					                    		<th>Instrument</th>
					                    		<?php } ?>

					                    		<?php if($cfi > 0) { ?>																	
					                    		<th>CFI</th>
					                    		<?php } ?>

					                    		<?php if($cfii > 0) { ?>																	
					                    		<th>CFII</th>
					                    		<?php } ?>

					                    		<?php if($mei > 0) { ?>																	
					                    		<th>MEI</th>
					                    		<?php } ?>

					                    		<?php if($dpe > 0) { ?>																	
					                    		<th>DPE</th>
					                    		<?php } ?>

					                    		<?php if($bgi > 0) { ?>																	
					                    		<th>BGI</th>
					                    		<?php } ?>

					                    		<?php if($agi > 0) { ?>																	
					                    		<th>AGI</th>
					                    		<?php } ?>

					                    		<?php if($rotocraft > 0) { ?>																	
					                    		<th>Rotocraft</th>
					                    		<?php } ?>

					                    		<?php if($glider > 0) { ?>																	
					                    		<th>Glider</th>
					                    		<?php } ?>

					                    		<?php if($balloon > 0) { ?>																	
					                    		<th>Balloon</th>
					                    		<?php } ?>

					                    		<?php if($airship > 0) { ?>																	
					                    		<th>Airship</th>
					                    		<?php } ?>

					                    		<?php if(strlen($cred_notes) > 0) { ?>																	
					                    		<th>Cred Notes</th>
					                    		<?php } ?>
				
												<?php if($num_logins > 0) { ?>	
						                    		<th>No Logins</th>
												<?php } ?> 

												<?php if(strlen($last_login_device) > 0) { ?>	
						                    		<th>Login Device</th>
												<?php } ?> 


												<?php if(strlen($last_login > 0) && $last_login != '01/01/1970'  ) { ?>	
						                    		<th>Last Login</th>
												<?php } ?> 
												<?php if(strlen($last_logout > 0) && $last_logout != '01/01/1970'  ) { ?>	
						                    		<th>Last Logout</th>
												<?php } ?> 

										<!--		<php if(strlen($token_expires > 0) && $token_expires != '01/01/1970'  ) { ?>	
						                    		<th>Token Exp</th>
												<php } ?> 						                   	
						   						                                      
												<php if(strlen($user_token) > 0) { ?>
						                    		<th>User Token</th>
												<php } ?> 		-->			   						                                      

												<?php if($inactive > 0) { ?>	
						                    		<th>Inactive</th>
												<?php } ?> 						   						                                      
												<?php if($locked > 0) { ?>	
						                    		<th>Locked</th>
												<?php } ?> 													
												<?php if($confirmed > 0) { ?>	
						                    		<th>Confirmed</th>
												<?php } ?> 												 						   						                                      
												<?php if($verified > 0) { ?>	
						                    		<th>Verified</th>
												<?php } ?> 	

												<?php if($approved > 0) { ?>	
						                    		<th>Approved</th>
												<?php } ?> 						   						                                      
					   						                                      
										<!--		<php if(strlen($reset_code) > 0) { ?>	
						                    		<th>Reset Code</th>
												<php } ?> 						   						                                      
												<php if($force_pw_chg > 0) { ?>	
						                    		<th>Force PW Chg</th>
												<php } ?> 						   						                                      
												<php if($timed_reset > 0) { ?>	
						                    		<th>Timed Reset</th>
												<php } ?> 					   						                                      
												<php if(strlen($reset_interval) > 0) { ?>	
						                    		<th>Reset Interval</th>
												<php } ?> 						   						                                      
									   						                                      
												<php if(strlen($ip_address) > 0) { ?>	
						                    		<th>IP Address</th>
												<php } ?>

												<php if(strlen($homepage) > 0) { ?>	
						                    		<th>Homepage</th>
												<php } ?> 	-->					   						                                      



												<?php if(strlen($fin_acct_type) > 0) { ?>	
					                    		<th>$Acct Type</th>
					                    		<?php } ?>

					                    		<?php if(strlen($acct_bal) > 0) { ?>																
					                    		<th>Acct Bal</th>
					                    		<?php } ?>

					                    		<?php if($fin_inactive > 0) { ?>																	
					                    		<th>$ Acct Inactive</th>
					                    		<?php } ?>

					                    		<?php if(strlen($fin_status) > 0) { ?>			
					                    		<th>$Acct Status <?php $fin_status ?></th>
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

					                    	<!--	<php if(strlen($fin_billship) > 0) { ?>																	
					                    		<th>Bill=Ship</th>
					                    		<php } ?> -->

					                    		<?php if(strlen($fin_notes) > 0) { ?>
					                    		<th>Fin Notes</th>
					                    		<?php } ?> 

					                    		<?php if(strlen($created_by) > 0) { ?>
					                    		<th>Created By</th>
					                    		<?php } ?> 

					                    <!--		<php if(strlen($created_at) > 0 && $created_at != '01/01/1970') { ?>	
					                    		<th>Created At</th>
					                    		<php } ?> -->

					                    		<?php if(strlen($updated_by) > 0) { ?>
					                    		<th>Updated By</th>
					                    		<?php } ?>

					                    		<?php if(strlen($updated_at) > 0 && $updated_at != '01/01/1970') { ?>	
					                    		<th>Updated At</th>
					                    		<?php } ?> 						   						                                      

					                    		<?php if(strlen($chapter) > 0) { ?>																	
					                    		<th>Chapter</th>
					                    		<?php } ?>

					                    		<?php if(strlen($region) > 0) { ?>																	
					                    		<th>Region</th>
					                    		<?php } ?>

							                    </tr>
						                    </thead>
					                    <tbody>
												<tr class='gradeA'>

												<?php if(strlen($id) > 0) { ?>	
						                   		 	<td><?= $id ?></td>
												<?php } ?>
												<?php if($trongate_user_id > 0) { ?>	
						                    		<td><?= $trongate_user_id ?></td>
												<?php } ?> 

										<!--		<php if(strlen($code) > 0) { ?>	
						                    		<td><?= $code ?></td>
												<php } ?> -->

												<?php if(strlen($username) > 0) { ?>	
						                    		<td><?= $username ?></td>
												<?php } ?>
												<?php if(strlen($tguserlevelname) > 0) { ?>	
						                    		<td><?= $tguserlevelname ?></td>
												<?php } ?>

											<!--	<php if(isset($status)) { ?>	
						                    		<td><?= $status ?></td>
												<php } ?> -->
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


												<?php if(strlen($mailaddress1) > 0) { ?>	
						                    		<td><?= $mailaddress1 ?></td>
												<?php } ?>

												<?php if(strlen($mailaddress2) > 0) { ?>	
						                    		<td><?= $mailaddress2 ?></td>
												<?php } ?>

												<?php if(strlen($mailcity) > 0) { ?>	
						                    		<td><?= $mailcity ?></td>
												<?php } ?>

												<?php if(strlen($mailstate) > 0) { ?>	
						                    		<td><?= $mailstate ?></td>
												<?php } ?>

												<?php if(strlen($mailzip) > 0) { ?>	
						                    		<td><?= $mailzip ?></td>
												<?php } ?>


												<?php if(strlen($physaddress1) > 0) { ?>	
						                    		<td><?= $physaddress1 ?></td>
												<?php } ?>

												<?php if(strlen($physaddress2) > 0) { ?>	
						                    		<td><?= $physaddress2 ?></td>
												<?php } ?>

												<?php if(strlen($physcity) > 0) { ?>	
						                    		<td><?= $physcity ?></td>
												<?php } ?>

												<?php if(strlen($physstate) > 0) { ?>	
						                    		<td><?= $physstate ?></td>
												<?php } ?>

												<?php if(strlen($physzip) > 0) { ?>	
						                    		<td><?= $physzip ?></td>
												<?php } ?>


												<!--		<php if($mail_phys == 1) { ?>
						                    				<td>Yes</td>

												<php } ?> -->


														<?php if($vip == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($student == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($private == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>



														<?php if($commercial == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($atp == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($drone == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>

												<?php if(strlen($other_crewmember) > 0) { ?>	
						                    		<td><?= $other_crewmember ?></td>
												<?php } ?> 		

												<?php if(strlen($ocm_certnum) > 0) { ?>	
						                    		<td><?= $ocm_certnum ?></td>
												<?php } ?> 	


														<?php if($ap == 1) { ?>
						                    				<td>Yes</td>

														<?php } ?> 


												<?php if(strlen($ap_number) > 0) { ?>	
						                    		<td><?= $ap_number ?></td>
												<?php } ?> 


														<?php if($ia == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($military_maint == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>

														<?php if($maintenance == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($atc == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($dispatcher == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


												<?php if(strlen($other_faa_cert) > 0) { ?>	
						                    		<td><?= $other_faa_cert ?></td>
												<?php } ?> 	

												<?php if(strlen($ofc_certnum) > 0) { ?>	
						                    		<td><?= $ofc_certnum ?></td>
												<?php } ?>



														<?php if($se_land == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($me_land == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($se_sea == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>

														<?php if($me_sea == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($instrument == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($cfi == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($cfii == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($mei == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($dpe == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($bgi == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($agi == 1) { ?>
						                    				<td>Yes</td>
 
												<?php } ?>


														<?php if($rotocraft == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($glider == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($balloon == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($airship == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


  												<?php if(strlen($cred_notes) > 0) { ?>	
						                    		<td><?= $cred_notes ?></td>
												<?php } ?> 													
												<?php if($num_logins > 0) { ?>	
						                    		<td><?= $num_logins ?></td>
												<?php } ?>


												<?php if(strlen($last_login_device) > 0) { ?>	
						                    		<td><?= $last_login_device ?></td>
												<?php } ?> 

												<?php if(strlen($last_login > 0) && $last_login != '01/01/1970'  ) { ?>	
						                    		<td><?= $last_login ?></td>
												<?php } ?> 
												<?php if(strlen($last_logout > 0) && $last_logout != '01/01/1970'  ) { ?>	
						                    		<td><?= $last_logout ?></td>
												<?php } ?>


										<!--		<php if(strlen($token_expires > 0) && $token_expires != '01/01/1970'  ) { ?>	
						                    		<td><?= $token_expires ?></td>
												<php } ?> 
						                   	
					   						                                      
												<php if(strlen($user_token) > 0) { ?>	
						                    		<td><?= $user_token ?></td>
												<php } ?> 	-->					   						                                      


														<?php if($inactive == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>


														<?php if($locked == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?>												 						   						                                      

														<?php if($confirmed == 1) { ?>
						                    				<td>Yes</td>

												<?php } ?> 


														<?php if($verified == 1) { ?>
						                    				<td>Yes</td>
														
												<?php } ?> 	

														<?php if($approved == 1) { ?> 
						                    				<td>Yes</td>
														
												<?php } ?> 


										<!--		<php if(strlen($activate_code) > 0) { ?>	
						                    		<td><?= $activate_code ?></td>
												<php } ?> 		-->

										<!--		<php if(strlen($reset_code)) { ?>	
						                    		<td><?= $reset_code ?></td>
												<php } ?> 	-->					   						                                      

	
											<!--		<php if($force_pw_chg == 1) { ?>
						                    				<td>Yes</td>

												<php } ?> 


														<php if($timed_reset == 1) { ?>
						                    				<td>Yes</td>

												<php } ?> 

												<php if(strlen($reset_interval) > 0) { ?>	
						                    		<td><?= $reset_interval ?></td>
												<php } ?>

				   						                                      					   						                                      					   						                                      
												<php if(strlen($ip_address) > 0) { ?>	
						                    		<td><?= $ip_address ?></td>
												<php } ?>

												<php if(strlen($homepage) > 0) { ?>	
						                    		<td><?= $homepage ?></td>
												<php } ?> -->

												<?php if(strlen($fin_acct_type) > 0) { ?>	
						                    		<td><?= $fin_acct_type ?></td>
												<?php } ?> 						   						                                      
												<?php if(strlen($acct_bal) > 0) { ?>	
						                    		<td><?= $acct_bal ?></td>
												<?php } ?> 



														<?php if($fin_inactive == 1) { ?>
						                    				<td>Yes</td>

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



												<!--		<php if($fin_billship == 1) { ?>
						                    				<td>Yes</td>

												<php } ?>  -->

												<?php if(strlen($fin_notes) > 0) { ?>	
						                    		<td><?= $fin_notes ?></td>
												<?php } ?> 
												<?php if(strlen($created_by) > 0) { ?>	
						                    		<td><?= $created_by ?></td>
												<?php } ?> 

										<!--		<php if(strlen($created_at) > 0 && $created_at != '01/01/1970') { ?>	
						                    		<td><?= $created_at ?></td>
												<php } ?> 	-->

												<?php if(strlen($updated_by) > 0) { ?>
						                    		<td><?= $updated_by ?></td>
												<?php } ?> 

												<?php if(strlen($updated_at) > 0 && $updated_at != '01/01/1970') { ?>	
						                    		<td><?= $updated_at ?></td>
												<?php } ?>	

					                    		<?php if(strlen($chapter) > 0) { ?>																	
					                    		<td><?= $chapter ?></td>
					                    		<?php } ?>

					                    		<?php if(strlen($region) > 0) { ?>																	
					                    		<td><?= $region ?></td>
					                    		<?php } ?>


												</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped -->
				                   
				                	</div> <!-- Table Responsive -->


				         <!--        	<br>
                                    <strong>Export Single Record - Financial Account Table Fields with Data</strong> <br>User Friendly Version - Translations & Calculated Fields
                                    <br>
                                   <br>

						            <div class="table-responsive">
				                    <table class="table table-striped table-bordered table-hover dataTables-example" >

					                    <thead>
						                    <tr>
	

							                    </tr>
						                    </thead>
					                    <tbody>
												<tr class='gradeA'>



												</tr>												

					                   		 </tbody>

					                    </table> <!-- End Table Striped --
				                   
				                	</div> <!-- Table Responsive -->


 									</div> <!-- ibox for tab 5 -->
                                </div> <!-- Panel Body for tab 5 -->
                            </div> <!--  Tab Panel for tab 7 -->
 <!--<?php endif; ?>  <!-- action 3 is for field access c,r,u,d fields and buttons  -->

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


 <?php if($action3_d > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/ccmps/create/<?= $recid ?>/v" >Update</a>

                    <a class="btn btn-outline btn-danger" type="button" onClick="return confirm('This account will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/ccmps/del/<?= $id ?>/v">Delete</a>

                    <a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/ccmps/manage">Close</a>


 					<a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal2">
                            xReset Password
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
                            set_flashdata($flash_msg); ?> no way to refresh modal to see the message -->
                           <center><h3 id="result" ></h3></center>

                             <form action="" method = "post">                                
                                <div class="modal-body"> 
									
								<!-- All these values are passed to the javascript routine in layoutone.php and then to Honcho.php controller. Any field changes here must be made inlayoutone or wont pass  -->
                                    <div class="form-group">
                                <!--        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password" > -->
										<input type="password" class="form-control" name="npass" id="npass" placeholder="New Password" >
                                    </div>  
                                    <div class="form-group">
                                <!--        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password" > -->
                                        <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm New Password" >										
                                    </div>
                                    <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  -->
                                        <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>" hidden>
                                    </div>

									<div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw  by way of JS in layoutone.php -->
                                        <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="ccmps" hidden>
                                    </div>

                                   <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                        <input type="text" class="form-control" name="recid" id="recid" value="<?= $recid ?>"  hidden>
                                    </div> 



                                </div>
                                <div class="modal-footer">

<input type="button" value="Reset Password"class="btn btn-primary block full-width m-b" name="ResetID" id="ResetBtn" ></input>

                                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>

<?php else: ?>
	                <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/ccmps/create/<?= $recid ?>/v" >Update</a>

                    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/ccmps/manage">Close</a>
				
                        <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal">
                            Change Password
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
									<div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw  by way of JS in layoutone.php -->
                                        <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="ccmps" hidden>
                                    </div>									
							
									

									<div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                        <input type="text" class="form-control" name="recid" id="recid" value="<?= $recid ?>"  hidden> 

                                    </div> 


                                </div>
                                <div class="modal-footer">

<input type="button" value="Change Password"class="btn btn-primary block full-width m-b" name="ChangeID" id="ChangeBtn" ></input>

                                    <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>


<?php endif; ?>
				



                <!--    <a class="btn btn-danger btn-outline demo4" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v" type="button" >Delete</a> -->
                </div>
           


</div> <!--  tabs container -->

</div> <!-- ibox content for the page content section -->

