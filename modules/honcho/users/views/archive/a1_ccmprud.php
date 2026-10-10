  <?php 

  switch($_SESSION['ccmpmode']) {
   case 'momv':  
        include('navbar.php');
  break; 

   case 'mcmv':  
        include('navbar4.php');
  break;   

   case 'mamv':   
        include('navbar4.php');
  break;
   case 'momm':  // create is called from manage or view pages
        include('navbar.php');
  break; 

    case 'momu':  // create is called from manage or view pages
        include('navbar.php');
  break;

    case 'momc':  // create is called from manage or view pages
        include('navbar.php');
  break;

   case 'mcmm':  
        include('navbar4.php');
  break;   

   case 'mcmu':  
        include('navbar4.php');
  break; 

   case 'mcmc':  
        include('navbar4.php');
  break; 

   case 'mamm':   
        include('navbar4.php');
  break;   

   case 'mamu':   
        include('navbar4.php');
  break; 

   case 'mamc':   
        include('navbar4.php');
  break;    
//default:
        //include('navbar4.php');

  }  ?> 

<!-- Begin Content   -->
<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>

                 
		<div class="ibox-content">
			<div class="row"> 
       
   				<?php if(strlen($picture) > 0): ?> 
				        <div class="col-md-1">	 
				        	<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/> 
						<!--	<img alt="user picture" class="rounded-circle" src="<= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
						  </div> <!-- end col -->
            <div class="col-md-10">
          <?php else: ?> 
              <div class="col-md-11">
				  <?php endif; ?>
       
		<!--		<div class="col-md-11"> -->

                    <?php if($recid > 0) { ?>   <!-- Either Viewing or Updating  -->
                    	<?php if($_SESSION['ccmpmode'] == 'momv' || $_SESSION['ccmpmode'] == 'mcmv' || $_SESSION['ccmpmode'] == 'mamv' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamu' )  { ?>
	          <br>
				    		<h2><?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?> </h2>
				    		
				  
				    		<p><h2><?= $chapternm ?></h2></p>

                      	<?php }else{ ?> <!-- Updating -->

								<span class="break"><h2><strong>Updating <?= $salutation ?> <?= $first_name ?> <?= $last_name ?></strong></h2></span>  
 								<p><h2><?= $chapternm ?></h2></p>
                      	<?php } ?> 
                                                                   
                        

                    <?php }else{ ?> <!-- Creating -->

                                <span class="break"><h2><strong>New <?= CCMP ?> Application</strong></h2></span>  <!-- Adding New Account -->                                   
                           <h2><?= SITENAME ?></h2>

                    <?php } ?> 


		        </div> <!-- end column -->
					<ul class="nav navbar-top-links navbar-right">
						<li>
				         <!-- 	<php if(strlen($picture) > 0): ?> -->
						    <div class="col-md-1">	 
					                <h1 class="logo text-center">
					                    <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
					                        <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
					                    </a>
					                </h1>
							</div> <!-- end col -->
						<!--	<php endif; ?> -->

						</li>
					</ul>

		    </div> <!-- end row -->

			  <!--      <div class="btn-group">
                        <a class="btn btn-rounded btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $id ?>/m" >Update</a>
                        <a class="btn btn-outline btn-danger" type="button" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v">Delete</a>
                        <a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Close</a>
                    </div>  -->
			<!--	<div class="box-icon"><a style='color: white'> * = required</a></div> -->

		</div>

        <div class="ibox-content">	

<!--  Optional Buttons here -->
                            	
                         <!--      <div class="btn-group">

			                     <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
			                     		<div>
                                     	<a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                     	<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm">Close</a> 
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
		                				<div>
                                     	<a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                     	<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm">Close</a> </div>
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
			                      		<div>
                                     	<a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                     	<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm">Close</a>
                                    	</div>
		                                
			                    <?php else: ?> 

			                    <?php endif; ?> 

			                	</div>
			                	
			                	<br> -->


                    <div class="tabs-container">
                    	<?= flashdata();
						$flash_msg = '';
						set_flashdata($flash_msg); ?>
                        <ul class="nav nav-tabs" role="tablist">
                           <?php if($_SESSION['tab'] == 1): ?>
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">aContact Info </a></li> <!-- <?= $id ?> -->
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Credentials</a></li>                            
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Financial Account</a></li> <!--  <?= $fin_id ?> -->
                                <?php if($trongate_user_id > 0): ?> 
                                  <li><a class="nav-link" data-toggle="tab" href="#tab-4">User Account</a></li> <!--  <?= $trongate_user_id ?>  -->
                                <?php else: ?>  
                                   <li><a class="nav-link" data-toggle="tab" href="#tab-4">No User Account</a></li>
                               <?php endif; ?>

                          <?php elseif($_SESSION['tab'] == 2): ?> 
                                <li><a class="nav-link" data-toggle="tab" href="#tab-1">Contact Info </a></li> <!-- <?= $id ?> -->
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-2">aCredentials</a></li>                            
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Financial Account</a></li> <!--  <?= $fin_id ?> -->
                                <?php if($trongate_user_id > 0): ?> 
                                  <li><a class="nav-link" data-toggle="tab" href="#tab-4">User Account</a></li> <!--  <?= $trongate_user_id ?>  -->
                                <?php else: ?>  
                                   <li><a class="nav-link" data-toggle="tab" href="#tab-4">No User Account</a></li>
                               <?php endif; ?>

                          <?php elseif($_SESSION['tab'] == 3): ?>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-1">Contact Info </a></li> <!-- <?= $id ?> -->
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Credentials</a></li>                            
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-3">aFinancial Account</a></li> <!--  <?= $fin_id ?> -->
                                <?php if($trongate_user_id > 0): ?> 
                                  <li><a class="nav-link" data-toggle="tab" href="#tab-4">User Account</a></li> <!--  <?= $trongate_user_id ?>  -->
                                <?php else: ?>  
                                   <li><a class="nav-link" data-toggle="tab" href="#tab-4">No User Account</a></li>
                               <?php endif; ?>
                          <?php elseif($_SESSION['tab'] == 4): ?>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-1">Contact Info </a></li> <!-- <?= $id ?> -->
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Credentials</a></li>                            
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Financial Account</a></li> <!--  <?= $fin_id ?> -->
                                <?php if($trongate_user_id > 0): ?> 
                                  <li><a class="nav-link active" data-toggle="tab" href="#tab-4">aUser Account</a></li> <!--  <?= $trongate_user_id ?>  -->
                                <?php else: ?>  
                                   <li><a class="nav-link active" data-toggle="tab" href="#tab-4">aNo User Account</a></li>
                               <?php endif; ?>
                          <?php else: ?> 
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">dContact Info </a></li> <!-- <?= $id ?> -->
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Credentials</a></li>                            
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Financial Account</a></li> <!--  <?= $fin_id ?> -->
                                <?php if($trongate_user_id > 0): ?> 
                                  <li><a class="nav-link" data-toggle="tab" href="#tab-4">User Account</a></li> <!--  <?= $trongate_user_id ?>  -->
                                <?php else: ?>  
                                   <li><a class="nav-link" data-toggle="tab" href="#tab-4">No User Account</a></li>
                               <?php endif; ?>
                          <?php endif; ?> 





                       <!--    <li><a class="nav-link" data-toggle="tab" href="#tab-5">User Account Status</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-6">User Account Activity</a></li> -->

<!--<php if($action3_c > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                        <!--    <li><a class="nav-link" data-toggle="tab" href="#tab-7">Export</a></li> -->
<!--<php endif; ?> -->
                        </ul>
                        <div class="tab-content">
                          
                <?php if($_SESSION['ccmpmode'] == 'momv'  AND $_SESSION['tab'] == 1 ): ?>
                     <div role="tabpanel active" id="tab-1" class="tab-pane active"> 
                <?php else: ?>   
                           <?php if($_SESSION['tab'] == 1): ?>
                                <div role="tabpanel active" id="tab-1" class="tab-pane active"> <!-- 1 Contact Info   --> 

                          <?php elseif($_SESSION['tab'] == 2): ?> 
                                <div role="tabpanel" id="tab-1" class="tab-pane"> 

                          <?php elseif($_SESSION['tab'] == 3): ?>
                                <div role="tabpanel" id="tab-1" class="tab-pane"> 
                          <?php elseif($_SESSION['tab'] == 4): ?>
                                <div role="tabpanel" id="tab-1" class="tab-pane"> 
                          <?php else: ?> 
                                <div role="tabpanel active" id="tab-1" class="tab-pane active"> 
                          <?php endif; ?> 
                <?php endif; ?> 



                                <div class="panel-body">

									<div class="ibox-content"> 

										                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                          
                           <strong> <?= validation_errors() ?></strong>
                           
                           
									<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 	

<?php if($_SESSION['tab'] == 1): ?>

						         <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>">
                                   
                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                    	<div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 


		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				<br>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Prefix</strong></label>

                                            <div class="col-sm-2"><input name="salutation" type="text" class="form-control" value="<?= $salutation ?>" ></div>
                                        </div>

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>First</strong><a style="color:Red;">*</a></label>

                                             <div class="col-sm-8"><input name="first_name" type="text" class="form-control" value="<?= $first_name ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Middle</strong></label>

                                            <div class="col-sm-8"><input name="middle_name" type="text" class="form-control" value="<?= $middle_name ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Last</strong><a style="color:Red;">*</a></label>

                                            <div class="col-sm-8"><input name="last_name" type="text" class="form-control" value="<?= $last_name ?>" > </div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Suffix</strong></label>

                                            <div class="col-sm-8"><input name="suffix" type="text" class="form-control" value="<?=$suffix ?>" ></div>
                                        </div>


                                         <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Member Number</strong></label>

                                             <div class="col-sm-4"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Current Year</strong></label>

                                            <div class="col-sm-2"><input name="current_year" type="text" class="form-control" value="<?= $current_year ?>" ></div>
                                        </div> 		                                         
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Member Type</strong><a style="color:Red;">*</a></label>
                                        <div class="col-sm-4"><select class="form-control m-b" name="member_type" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($membertypes as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $member_type): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div> 

                                        <!-- How to handle not updatable by still pass current value to the save   -->                                        

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong>Eligible Voter</strong></label>

                                             <div class="col-sm-8"><input name="eligible_voter" type="text" class="form-control" value="<?= $eligible_voter ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Email</strong><a style="color:Red;">*</a></label>

                                             <div class="col-sm-8"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phone</strong></label>

                                            <div class="col-sm-8"><input name="phone" type="text" class="form-control" value="<?= $phone ?>" ></div>
                                        </div>	
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mobile</strong></label>

                                            <div class="col-sm-8"><input name="mobile" type="text" class="form-control" value="<?= $mobile ?>" ></div>
                                        </div> 
                                                                                 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Fax</strong></label>

                                            <div class="col-sm-8"><input name="fax" type="text" class="form-control" value="<?= $fax ?>" ></div>
                                        </div>
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Email Opt Out</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="emailoptout" Value="<?= $emailoptout ?>" >
                                                <?php if($emailoptout == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Directory Opt Out</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="directoryoptout" Value="<?= $directoryoptout ?>" >
                                                <?php if($directoryoptout == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Do Not Call</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="donotcall" Value="<?= $donotcall ?>" >
                                                <?php if($donotcall == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Deceased</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="deceased" Value="<?= $deceased ?>" >
                                                <?php if($deceased == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>   
		                                    <!--    <div class="form-group row"><label class="col-lg-3 "><strong>No Address</strong> </label>
													<div class="col-sm-5"><?= $no_address ?></div> 
		                                        </div>	-->	

		                                    <!--    <div class="form-group row"><label class="col-lg-3 "><strong>Special Event</strong> </label>
													<div class="col-sm-5"><?= $special_event ?></div> 
		                                        </div>	-->
		                                    <!--    <div class="form-group row"><label class="col-lg-3 "><strong>Record Created</strong></label>
													<div class="col-sm-5"><?= $created_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Created By</strong></label>
													<div class="col-sm-5"><?= $created_by ?></div> 
		                                        </div>	-->
												<div class="ibox-content">
												<center><strong>Mailing Address</strong></center>
												<br>
			                                    <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Mail Address1</strong></label>
                                            		<div class="col-sm-8"><input name="mailaddress1" type="textarea" class="form-control" value="<?= $mailaddress1 ?>" ></div>
                                        		</div> 	                                        
		                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mail Address2</strong></label>
		                                            <div class="col-sm-8"><input name="mailaddress2" type="text" class="form-control" value="<?= $mailaddress2 ?>" ></div>
		                                        </div> 
		                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mail City</strong></label>
		                                            <div class="col-sm-8"><input name="mailcity" type="text" class="form-control" value="<?= $mailcity ?>" ></div>
		                                        </div>	                                       
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mail State <?= $mailingstate ?></strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="mailstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $mailstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->


                           				<div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mail Zip</strong></label>
                                            <div class="col-sm-2"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" ></div>
                                        </div> 
		                                        
												</div>


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>
	                                        
 											<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'):  ?>
                           			
                                            <div class="col-sm-2"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" hidden></div>
                                    
 											<?php else: ?>  
                                 			 	<?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

     <!-- Treasurer/sysadmin can assign chapter to a new member including Chapter at Large  -->
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Chapter</strong><a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                     
         										<?php else: ?> <!-- Adding/Creating  -->
                                     
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Chapter</strong><a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                         
                                  			 <?php endif; ?> 
										        <?php endif; ?> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong><?= SUBENTITY ?> Role</strong><a style="color:Red;">*</a></label>
                                        <div class="col-sm-6"><select class="form-control m-b" name="chapter_role" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($chapterroles as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $chapter_role): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>


                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong><?= SUBENTITY ?> Admin</strong></label>
                                          <div class="col-sm-2"><select class="form-control m-b" name="chapter_admin" Value="<?= $chapter_admin ?>"  >
                                            <?php if($chapter_admin == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                              
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Call Sign</strong></label>

                                            <div class="col-sm-8"><input name="call_sign" type="text" class="form-control" value="<?= $call_sign ?>" ></div>
                                        </div>	                                        
	                                            <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Mail Newsletter</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="mail_notices" Value="<?= $mail_notices ?>" >
                                                <?php if($mail_notices == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Gender</strong><a style="color:Red;">*</a></label>
                                        <div class="col-sm-3"><select class="form-control m-b" name="gender" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($genders as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $gender): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Birthday</strong></label>

                                            <div class="col-sm-4"><input name="birthday" type="text" class="form-control" value="<?= $birthday ?>" ></div>
                                        </div>                                  	
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Aircraft Owner</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="aircraft_owner" Value="<?= $aircraft_owner ?>"  >
                                                <?php if($aircraft_owner == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Aircraft Type</strong></label>

                                            <div class="col-sm-8"><input name="aircraft_type" type="text" class="form-control" value="<?= $aircraft_type ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Aircraft Reg</strong></label>

                                            <div class="col-sm-8"><input name="aircraft_reg" type="text" class="form-control" value="<?= $aircraft_reg ?>" ></div>
                                        </div>		                                        	
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Misc 1</strong></label>

                                            <div class="col-sm-8"><input name="misc1" type="text" class="form-control" value="<?= $misc1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Misc 2</strong></label>

                                            <div class="col-sm-8"><input name="misc2" type="text" class="form-control" value="<?= $misc2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Misc 3</strong></label>

                                            <div class="col-sm-8"><input name="misc3" type="text" class="form-control" value="<?= $misc3 ?>" ></div>
                                        </div>  		                                          		                                          
		                                   <!--     <div class="form-group row"><label class="col-lg-3 "><strong>Last Updated</strong></label>
													<div class="col-sm-5"><?= $updated_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 "><strong>Updated By</strong></label>
													<div class="col-sm-5"><?= $updated_by ?></div> 
		                                        </div>	-->
<!-- <p> .</p> -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
												<div class="ibox-content">
												<center><strong>Physical Address</strong></center>
												<br>	                                        
                                          <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Same as Mailing?</strong></label>
                                          <div class="col-sm-2"><select class="form-control" name="mail_phys" Value="<?= $mail_phys ?>" >
                                            <?php if($mail_phys == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phys Address1</strong></label>
                                            <div class="col-sm-8"><input name="physaddress1" type="text" class="form-control" value="<?= $physaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phys Address2</strong></label>
                                            <div class="col-sm-8"><input name="physaddress2" type="text" class="form-control" value="<?= $physaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phys City</strong></label>
                                            <div class="col-sm-8"><input name="physcity" type="text" class="form-control" value="<?= $physcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phys State</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="physstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $physstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                                <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys State</label>
                                            <div class="col-sm-10"><input name="physstate" type="text" class="form-control" value="<?= $physstate ?>" ></div>
                                        </div>  -->
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Phys Zip</strong></label>
                                            <div class="col-sm-2"><input name="physzip" type="text" class="form-control" value="<?= $physzip ?>" ></div>
                                        </div>    
		                                    	</div>                                                           
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
                                <div class="form-group row"><label class="col-sm-3 col-form-label"><strong>Notes</strong></label>
                                    <div class="col-sm-12"><input name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                    	<div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
								</form>
 <?php endif; ?> <!-- End if($_SESSION['tab'] == 1) --> 

			<?php else: ?>  <!-- viewing Tab 1-->
							                        
		                                <div class="row"> 
		                                    <div class="col-md-6">

		                          <div class="btn-group">

			                     <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
			                     		<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" >Update</a>
                                     	<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/1">Close</a> 
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
		                				<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" >Update</a>
                                     	<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1">Close</a> 
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
			                      		<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" >Update</a>
                                     	<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1">Close</a>
                                    	</div>
		                                
			                    <?php else: ?> 

			                    <?php endif; ?> 

			                	</div>
		                        				<br>
		                        				<br>
		                        			
		                        			
                        				
		                                        <div class="form-group row"><label class="col-lg-3 ">Member Number</label>
													<div class="col-sm-5"><?= $member_no ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Current Year</label>
													<div class="col-sm-5"><?= $current_year ?></div> 
		                                        </div> 		                                         
		                                        <div class="form-group row"><label class="col-lg-3 ">Member Type</label>
													<div class="col-sm-5"><?= $member_type ?></div> 
		                                        </div>	                                         
		                                        <div class="form-group row"><label class="col-lg-3 ">Eligible Voter</label>
													<div class="col-sm-5"><?= $eligible_voter ?></div> 
		                                        </div>		                                        		                                        
		                                        <div class="form-group row"><label class="col-lg-3 ">Email</label>
													<div class="col-sm-5"><?= $email_address ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Phone</label>
													<div class="col-sm-5"><?= $phone ?></div> 
		                                        </div> 	
		                                        <div class="form-group row"><label class="col-lg-3 ">Mobile</label>
													<div class="col-sm-5"><?= $mobile ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Fax</label>
													<div class="col-sm-5"><?= $fax ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Opt Out Email</label>
													<div class="col-sm-5"><?= $emailoptout ?></div> 
		                                        </div>
                                            <div class="form-group row"><label class="col-lg-3 ">Opt Out Directory</label>
                          <div class="col-sm-5"><?= $directoryoptout ?></div> 
                                            </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Do Not Call</label>
													<div class="col-sm-5"><?= $donotcall ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Deceased</label>
													<div class="col-sm-5"><?= $deceased ?></div> 
		                                        </div>   
		                                        <div class="form-group row"><label class="col-lg-3 ">No Address</label>
													<div class="col-sm-5"><?= $no_address ?></div> 
		                                        </div>		

		                                    <!--    <div class="form-group row"><label class="col-lg-3 ">Special Event</label>
													<div class="col-sm-5"><?= $special_event ?></div> 
		                                        </div>	-->
		                                        <div class="form-group row"><label class="col-lg-3 ">Record Created</label>
													<div class="col-sm-5"><?= $created_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Created By</label>
													<div class="col-sm-5"><?= $created_by ?></div> 
		                                        </div>	
												<div class="ibox-content">
												<center><strong>Mailing Address</strong></center>
												<br>
			                                        <div class="form-group row"><label class="col-lg-3 ">Mail Address1</label> 
														<div class="col-sm-5"><?= $mailaddress1 ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-3 ">Mail Address2</label> 
														<div class="col-sm-5"><?= $mailaddress2 ?></div>
													</div>	 
			                                        <div class="form-group row"><label class="col-lg-3 ">Mail City</label> 
														<div class="col-sm-5"><?= $mailcity ?></div> 
			                                        </div>		                                       
			                                        <div class="form-group row"><label class="col-lg-3 ">Mail State</label> 
														<div class="col-sm-5"><?= $mailstate ?></div> 
			                                        </div>	
			                                        <div class="form-group row"><label class="col-lg-3 ">Mail Zipcode</label> 
														<div class="col-sm-5"><?= $mailzip ?></div> 
			                                        </div>
		                                        
												</div>


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>
		                                    	<br>
		                                    	<br>

	                                        
		                                   <!--     <div class="form-group row"><label class="col-lg-3 "><strong>Region</strong></label>
													<div class="col-sm-5"><?= $region ?></div> 
		                                        </div>		-->	                                        		                                    	
		                                        <div class="form-group row"><label class="col-lg-3 ">Chapter</label>
													<div class="col-sm-5"><?= $chapter ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 ">Chapter Role</label>
													<div class="col-sm-5"><?= $chapter_role ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Chapter Admin</label>
													<div class="col-sm-5"><?= $chapter_admin ?></div> 
		                                        </div>												
		                                        <div class="form-group row"><label class="col-lg-3 ">Call Sign</label>
													<div class="col-sm-5"><?= $call_sign ?></div> 
		                                        </div>		                                        
		                                        <div class="form-group row"><label class="col-lg-3 ">Mail Newsletter</label>
													<div class="col-sm-5"><?= $mail_notices ?></div> 
		                                        </div> 
		                                        <div class="form-group row"><label class="col-lg-3 ">Gender</label>
													<div class="col-sm-5"><?= $gender ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Birthday</label>
													<div class="col-sm-5"><?= $birthday ?></div> 
		                                        </div>                                   	
		                                        <div class="form-group row"><label class="col-lg-3 ">Aircraft Owner</label>
													<div class="col-sm-5"><?= $aircraft_owner ?></div> 
		                                        </div>	
		                                        <div class="form-group row"><label class="col-lg-3 ">Aircraft Type</label>
													<div class="col-sm-5"><?= $aircraft_type ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Aircraft Reg #</label>
													<div class="col-sm-5"><?= $aircraft_reg ?></div>
		                                        </div>			                                        	
                                     
		                                        <div class="form-group row"><label class="col-lg-3 ">Miscellaneous 1</label>
													<div class="col-sm-5"><?= $misc1 ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Miscellaneous 2</label>
													<div class="col-sm-5"><?= $misc2 ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Miscellaneous 3</label>
													<div class="col-sm-5"><?= $misc3 ?></div> 
		                                        </div>  		                                          		                                          
		                                        <div class="form-group row"><label class="col-lg-3 ">Last Updated</label>
													<div class="col-sm-5"><?= $updated_at ?></div> 
		                                        </div>
		                                        <div class="form-group row"><label class="col-lg-3 ">Updated By</label>
													<div class="col-sm-5"><?= $updated_by ?></div> 
		                                        </div>	
<!-- <p> .</p> -->
												<div class="ibox-content">
												<center><strong>Physical Address</strong></center>
												<br>	                                        
			                                        <div class="form-group row"><label class="col-lg-4 ">Phy Address 1</label> 
														<div class="col-sm-5"><?= $physaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Phy Address 2</label> 
														<div class="col-sm-5"><?= $physaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Phy City</label> 
														<div class="col-sm-5"><?= $physcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Phy State</label> 
														<div class="col-sm-5"><?= $physstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Phy Zipcode</label> 
														<div class="col-sm-5"><?= $physzip ?></div> 
			                                        </div>
		                                    	</div>                                                           
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label">Member Record Notes</label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $notes ?></span>
		                                    </div>
		                                </div> 

										<div class="form-group row"><label class="col-lg-1 ">Photo</label> 
														<div class="col-sm-5" ><?= $picture ?></div> 
			                                    </div> 
	           <form action="<?= BASE_URL ?>welcome-ccmps/uploadccmppic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">   <!--  .../submodule/$task/$recid/$frmpg/filter) & the task calls the submit_upload_picture function() -->
			<!--	<form action="submit upload picture/1" method="post" enctype="multipart/form-data"> -->
						<input type="file" name="picture" value="">
						<button type="submit" name="submit" value="Upload">Upload Photo</button>
	           <!--     <div class="form-group">
						<button class="btn btn-rounded btn-outline btn-primary" name="submit" type="submit" value="Upload">Upload Picture</button> 
					</div>  -->
				</form>


									<?php endif; ?> <!--  End Viewing Tab 1  -->

									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                            	
							

                            </div> <!-- End Tab 1 Panel -->


							
                <?php if($_SESSION['ccmpmode'] == 'momv'  AND $_SESSION['tab'] == 1 ): ?>
                      <div role="tabpanel" id="tab-2" class="tab-pane"> 
                <?php else: ?>                          
                           <?php if($_SESSION['tab'] == 1): ?>
                             <!--   <div role="tabpanel active" id="tab-1" class="tab-pane active"> --><!-- 1 Contact Info   --> 
                                <div role="tabpanel" id="tab-2" class="tab-pane"> 
                          <?php elseif($_SESSION['tab'] == 2): ?> 
                                <div role="tabpanel active" id="tab-2" class="tab-pane active"> <!-- Active   -->
                          <?php elseif($_SESSION['tab'] == 3): ?>
                                <div role="tabpanel" id="tab-2" class="tab-pane"> 
                          <?php elseif($_SESSION['tab'] == 4): ?>
                                <div role="tabpanel" id="tab-2" class="tab-pane"> 
                          <?php else: ?> 
                                <div role="tabpanel" id="tab-2" class="tab-pane"> 
                          <?php endif; ?> 
                <?php endif; ?>


                               <div class="panel-body">
									<div class="ibox-content">
                    
									<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 	

<?php if($_SESSION['tab'] == 2): ?>

						           <!--     <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->
                            <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>">

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                    	<div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                    	<div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 

                                    <div class="row"> 
                                        <div class="col-md-6">
                                    
                                    <br>
<!--  Begin Update/Create Tab 2 -->

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Highest Cert<a style="color:Red;">*</a></label>
                                        <div class="col-sm-4"><select class="form-control m-b" name="highest_certificate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($highestcerts as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $highest_certificate): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Certificate No</label>
                                            <div class="col-sm-8"><input name="certificate_number" type="text" class="form-control" value="<?= $certificate_number ?>" ></div>
                                        </div>  	                                         
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Total Time</label>
                                            <div class="col-sm-2"><input name="total_time" type="text" class="form-control" value="<?= $total_time ?>" ></div>
                                        </div>
                                            <div class="form-group  row">  <label class="col-sm-2 col-form-label">VIP <?= $vip ?></label> 
                                              <div class="col-sm-2"><select class="form-control m-b" name="vip" Value="<?= $vip ?>" >
                                                <?php if($vip == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

												<div class="ibox-content">
                          <center><strong>Ratings</strong></center>
                          <br>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Land</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="se_land" Value="<?= $se_land ?>" >
                                                <?php if($se_land == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Land</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="me_land" Value="<?= $me_land ?>" >
                                                <?php if($me_land == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Sea</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="se_sea" Value="<?= $se_sea ?>" >
                                                <?php if($se_sea == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Sea</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="me_sea" Value="<?= $me_sea ?>" >
                                                <?php if($me_sea == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Instrument</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="instrument" Value="<?= $instrument ?>" >
                                                <?php if($instrument == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="cfi" Value="<?= $cfi ?>" >
                                                <?php if($cfi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFII</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="cfii" Value="<?= $cfii ?>" >
                                                <?php if($cfii == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">MEI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="mei" Value="<?= $mei ?>" >
                                                <?php if($mei == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">DPE</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="dpe" Value="<?= $dpe ?>" >
                                                <?php if($dpe == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">BGI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="bgi" Value="<?= $bgi ?>" >
                                                <?php if($bgi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">AGI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="agi" Value="<?= $agi ?>" >
                                                <?php if($agi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Rotocraft</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="rotocraft" Value="<?= $rotocraft ?>" >
                                                <?php if($rotocraft == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Glider</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="glider" Value="<?= $glider ?>" >
                                                <?php if($glider == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Balloon</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="balloon" Value="<?= $balloon ?>" >
                                                <?php if($balloon == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Airship</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="airship" Value="$<?= $airship ?>" >
                                                <?php if($airship == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Drone</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="drone" Value="$<?= $drone ?>" >
                                                <?php if($drone == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

			                                    </div>	<!-- ibox-content -->

		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Hall of Fame</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="hall_of_fame" Value="<?= $hall_of_fame ?>" >
                                                <?php if($hall_of_fame == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Active Duty</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="active_duty" Value="<?= $active_duty ?>" >
                                                <?php if($active_duty == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                          
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Former Military</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="former_military" Value="$<?= $former_military ?>" >
                                                <?php if($former_military == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>   
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military Pilot</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="military_pilot" Value="<?= $military_pilot ?>" >
                                                <?php if($military_pilot == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

												<div class="ibox-content">
                          <center><strong>Other Certificates & Certifications</strong></center>
                          <br>                                                                                       
                             
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crewmember</label>
                                            <div class="col-sm-8"><input name="other_crewmember" type="text" class="form-control" value="<?= $other_crewmember ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crew Cert #</label>
                                            <div class="col-sm-8"><input name="ocm_certnum" type="text" class="form-control" value="<?= $ocm_certnum ?>" ></div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">A&P</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="ap" Value="<?= $ap ?>" >
                                                <?php if($ap == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">A&P #</label>
                                            <div class="col-sm-8"><input name="ap_number" type="text" class="form-control" value="<?= $ap_number ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">IA</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="ia" Value="<?= $ia ?>" >
                                                <?php if($ia == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military A&P</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="military_maint" Value="<?= $military_maint ?>" >
                                                <?php if($military_maint == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Maintenance</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="maintenance" Value="<?= $maintenance ?>" >
                                                <?php if($maintenance == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ATC</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="atc" Value="<?= $atc ?>" >
                                                <?php if($atc == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Dispatcher</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="dispatcher" Value="<?= $dispatcher ?>" >
                                                <?php if($dispatcher == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert</label>
                                            <div class="col-sm-8"><input name="other_faa_cert" type="text" class="form-control" value="<?= $other_faa_cert ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert #</label>
                                            <div class="col-sm-8"><input name="ofc_certnum" type="text" class="form-control" value="<?= $ofc_certnum ?>" ></div>
                                        </div>    
                                        
		                                    </div> <!-- ibox-content -->
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Credential Notes</label>
                                    <div class="col-sm-12"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                    	<div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                    	<div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 


		                              

                                                          
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            



<!--  End Update create tab 2 -->


						                </form>


 <?php endif; ?> <!-- End if($_SESSION['tab'] == 2) -->

						                <?php else: ?>  <!-- viewing Tab 2-->

		                                <div class="row"> 
		                                    <div class="col-md-6">
		                        				

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/2">Close</a> 
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/2">Close</a> 
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/2">Close</a>
                                      </div>
                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>
<br>
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
                                          <br>
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
                                              <div class="form-group row"><label class="col-lg-3 "><strong>Drone</strong> </label>
                            <div class="col-sm-5"><?= $drone ?></div> 
                                              </div> 
		                                    </div> <!-- ibox-content -->
                                                          
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Credential Notes</strong></label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $cred_notes ?></span>
		                                    </div>
		                                </div>

									<?php endif; ?> <!--  End Viewing Tab 2  -->

									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                           	

							</div> <!-- End Tab 2 Panel  -->



                <?php if($_SESSION['ccmpmode'] == 'momv'  AND $_SESSION['tab'] == 1 ): ?>
                         <div role="tabpanel" id="tab-3" class="tab-pane"> 
                <?php else: ?>   
                           <?php if($_SESSION['tab'] == 1): ?>
                                    <div role="tabpanel" id="tab-3" class="tab-pane"> 

                          <?php elseif($_SESSION['tab'] == 2): ?> 
                                    <div role="tabpanel" id="tab-3" class="tab-pane"> 

                          <?php elseif($_SESSION['tab'] == 3): ?>
                                    <div role="tabpanel active" id="tab-3" class="tab-pane active"> <!-- 3 Active  -->
                          <?php elseif($_SESSION['tab'] == 4): ?>
                                    <div role="tabpanel" id="tab-3" class="tab-pane"> 
                          <?php else: ?> 
                                    <div role="tabpanel" id="tab-3" class="tab-pane"> 
                          <?php endif; ?> 
                <?php endif; ?> 


                                <div class="panel-body">
									<div class="ibox-content"> 
									<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 	

<?php if($_SESSION['tab'] == 3): ?>

						                <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>">

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 





                                           
                                    <div class="row"> 
                                        <div class="col-md-6">
                                    <br>

                                            <div class="form-group row"><label class="col-lg-3 ">Financial Acct Id </label>
                          <div class="col-sm-5"><?= $fin_id ?></div> 
                                            </div> 

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Account Type</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="fin_acct_type" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($accttypes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $fin_acct_type): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end acct_type -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Billing Email</strong></label> 
                                        <div class="col-sm-8"><input name="fin_email" type="text" class="form-control w-b" placeholder="defaults to contact email if left blank" value="<?= $fin_email ?>" ></div>
                                      </div>
 <br>
                    <div class="ibox-content">
                        <center><strong>Billing Address</strong></center>
                        <br>
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill To Name</strong></label> 
                                        <div class="col-sm-8"><input name="billname" type="text" class="form-control" placeholder="defaults to contact name if left blank" value="<?= $billname ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill To Phone</strong></label> 
                                        <div class="col-sm-8"><input name="billphone" type="text" class="form-control" placeholder="defaults to contact phone if left blank" value="<?= $billphone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Address1</strong></label> 
                                        <div class="col-sm-8"><input name="billaddress1" type="text" class="form-control" value="<?= $billaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Address2</strong></label> 
                                        <div class="col-sm-8"><input name="billaddress2" type="text" class="form-control" value="<?= $billaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill City</strong></label> 
                                        <div class="col-sm-8"><input name="billcity" type="text" class="form-control" value="<?= $billcity ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill State</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="billstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $billstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Zip</strong></label> 
                                        <div class="col-sm-2"><input name="billzip" type="text" class="form-control" value="<?= $billzip ?>" ></div>
                                          </div> 
   </div> 

                                        </div> <!-- end col-6 -->
                                        <div class="col-md-6">
                                          <br>                                        
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Balance</strong></label> 
                                        <div class="col-sm-2"><input name="acct_bal" type="text" class="form-control" value="<?= $acct_bal ?>" ></div>
                                        </div>                                         

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Status</strong></label> 
                                        <div class="col-sm-6"><select type="text" class="form-control m-b" name="fin_status" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($finstatuses as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $fin_status): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option>
                                            <?php endif; ?>

                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end fin_status -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Inactive</strong></label>
                                          <div class="col-sm-2"><select class="form-control m-b" name="fin_inactive" Value="<?= $fin_inactive ?>" >
                                            <?php if($fin_inactive == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>  

 

                        <div class="ibox-content">
                        <center><strong>Shipping Address</strong></center>
                        <br> 

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Same as Billing?</strong></label>
                                          <div class="col-sm-2"><select class="form-control" name="fin_billship" Value="<?= $fin_billship ?>" >
                                            <?php if($fin_billship == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>                          
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship To Name</strong></label> 
                                        <div class="col-sm-8"><input name="shipname" type="text" class="form-control" value="<?= $shipname ?>" placeholder="defaults to contact name if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship To Phone</strong></label> 
                                        <div class="col-sm-8"><input name="shipphone" type="text" class="form-control" value="<?= $shipphone ?>" placeholder="defaults to contact phone if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Address1</strong></label> 
                                        <div class="col-sm-8"><input name="shipaddress1" type="text" class="form-control" value="<?= $shipaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Address2</strong></label> 
                                        <div class="col-sm-8"><input name="shipaddress2" type="text" class="form-control" value="<?= $shipaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship City</strong></label> 
                                        <div class="col-sm-8"><input name="shipcity" type="text" class="form-control" value="<?= $shipcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship State</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="shipstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $shipstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Zip</strong></label> 
                                        <div class="col-sm-2"><input name="shipzip" type="text" class="form-control" value="<?= $shipzip ?>" ></div>
                                        </div>  


                                          </div>   
                                        </div> <!-- end 2nd column -->
                                    </div> <!-- end row -->
                                
                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Financial Acct Notes</strong></label>
                                    <div class="col-sm-12"><input name="fin_notes" type="text" class="form-control" value="<?= $fin_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>








                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
						                </form>

 <?php endif; ?> <!-- End if($_SESSION['tab'] == 3) -->

					<?php else: ?>  <!-- viewing Tab 3 -->									                         
		                                <div class="row"> 
		                                    <div class="col-md-6">

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/3">Close</a> 
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/3">Close</a> 
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/3">Close</a>
                                      </div>
                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>                                          
		                        				<br>
                                    <br>

		                                        <div class="form-group row"><label class="col-lg-3 ">Financial Acct Id</label>
													<div class="col-sm-5"><?= $fin_id ?></div> 
		                                        </div> 
		                                        <div class="form-group row"><label class="col-lg-3 ">Acct Type </label>
													<div class="col-sm-5"><?= $fin_acct_type ?></div> 
		                                        </div> 	                 
		                                        <div class="form-group row"><label class="col-lg-3 ">Billing Email</label> 
													<div class="col-sm-5"><?= $fin_email ?></div> 
		                                        </div>
		                                                         
		                                        <div class="form-group row"><label class="col-lg-3 ">Bill To = Ship To</label> 
													<div class="col-sm-5"><?= $fin_billship ?></div> 
		                                        </div>
										<div class="ibox-content">
												<center><strong>Billing Address</strong></center>
												<br>
			                                        <div class="form-group row"><label class="col-lg-4 ">Bill To</label> 
														<div class="col-sm-5"><?= $billname ?></div> 
			                                        </div>

			                                        <div class="form-group row"><label class="col-lg-4 ">Bill Phone</label> 
														<div class="col-sm-5"><?= $billphone ?></div> 
			                                        </div>														                                        
			                                        <div class="form-group row"><label class="col-lg-4 ">Address 1</label> 
														<div class="col-sm-5"><?= $billaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Address 2</label> 
														<div class="col-sm-5"><?= $billaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">City</label> 
														<div class="col-sm-5"><?= $billcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">State</label> 
														<div class="col-sm-5"><?= $billstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Zipcode</label> 
														<div class="col-sm-5"><?= $billzip ?></div> 
			                                        </div>
		                                    	</div> 


		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-6">
		                                    	<br>
                                          <br>
                                          <br>	                                    	
		                                        <div class="form-group row"><label class="col-lg-4 ">Balance</label> 
													<div class="col-sm-5"><?= $acct_bal ?></div> 
		                                        </div>		                                    	

		                                        <div class="form-group row"><label class="col-lg-4 ">Status</label> 
													<div class="col-sm-5"><?= $fin_status ?></div> 
		                                        </div>

		                            	        <div class="form-group row"><label class="col-lg-4 ">Inactive</label>

													<?php if( $fin_inactive  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	

		                                        <div class="form-group row"><label class="col-lg-3 ">.</label> 
													<div class="col-sm-5"></div> 
		                                        </div>

												<div class="ibox-content">
												<center><strong>Shipping Address</strong></center>
												<br>													
			                                        <div class="form-group row"><label class="col-lg-4 ">Ship To</label> 
														<div class="col-sm-5"><?= $shipname ?></div> 
			                                        </div>

			                                        <div class="form-group row"><label class="col-lg-4 ">Ship Phone</label> 
														<div class="col-sm-5"><?= $shipphone ?></div> 
			                                        </div>		                                        
			                                        <div class="form-group row"><label class="col-lg-4 ">Address 1</label> 
														<div class="col-sm-5"><?= $shipaddress1 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Address 2</label> 
														<div class="col-sm-5"><?= $shipaddress2 ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">City</label> 
														<div class="col-sm-5"><?= $shipcity ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">State</label> 
														<div class="col-sm-5"><?= $shipstate ?></div> 
			                                        </div>
			                                        <div class="form-group row"><label class="col-lg-4 ">Zipcode</label> 
														<div class="col-sm-5"><?= $shipzip ?></div> 
			                                        </div>
		                                    	</div>                                                           
		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		                            
		                                <div class="form-group row"><label class="col-sm-2 col-form-label">Financial Account Notes</label>
		                                    <div class="col-sm-12"> <span class="form-text m-b-none"><?= $fin_notes ?></span>
		                                    </div>
		                                </div>

									<?php endif; ?> <!--  End Viewing Tab 3  -->
									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->
                            </div> <!-- End Tab 3 Panel -->



                <?php if($_SESSION['ccmpmode'] == 'momv' AND $_SESSION['tab'] == 1 ): ?>
                      <div role="tabpanel" id="tab-4" class="tab-pane">
                <?php else: ?>                          
                           <?php if($_SESSION['tab'] == 1): ?>
                             <!--   <div role="tabpanel active" id="tab-1" class="tab-pane active"> --><!-- 1 Contact Info   --> 
                                <div role="tabpanel" id="tab-4" class="tab-pane"> 
                          <?php elseif($_SESSION['tab'] == 2): ?> 
                                <div role="tabpanel" id="tab-4" class="tab-pane">
                          <?php elseif($_SESSION['tab'] == 3): ?>
                                <div role="tabpanel" id="tab-4" class="tab-pane"> 
                          <?php elseif($_SESSION['tab'] == 4): ?>
                                <div role="tabpanel active" id="tab-4" class="tab-pane active"> <!-- Active   -->
                          <?php else: ?> 
                                <div role="tabpanel" id="tab-4" class="tab-pane"> 
                          <?php endif; ?> 
                 <?php endif; ?> 






                                <div class="panel-body">
									<div class="ibox-content"> 
									<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 

<?php if($_SESSION['tab'] == 4): ?>

						                <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>">

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 

                                       <br>
                                             <h3>User Account Credentials</h3>
                                             <br>
                                    <div class="row"> 
                                        <div class="col-md-5">
 
                                            <div class="form-group row"><label class="col-lg-3 ">User Id</label> 
                          <div class="col-sm-5"><?= $trongate_user_id ?></div> 
                                            </div>

                                            <div class="form-group row"><label class="col-lg-3 ">Username </label>
                          <div class="col-sm-5"><?= $username ?></div> 
                                            </div>                       
                                            <div class="form-group row"><label class="col-lg-3 ">Level</label>
                          <div class="col-sm-5"><?= $tguserlevelname ?></div> 
                                            </div>
<br>

                                            <h3>Account Status</h3>
                                            <br>
                                          <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Login Locked</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="locked" Value="<?= $locked ?>" >
                                                <?php if($locked == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Login Inactive</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="inactive" Value="<?= $inactive ?>" >
                                                <?php if($inactive == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                                  
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Force PW Change</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="force_pw_chg" Value="<?= $force_pw_chg ?>" >
                                                <?php if($force_pw_chg == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>



                                        </div> <!-- end col-6 -->
                                        <div class="col-md-4">
                                          <br>


<br>
<br>
<br>
<br>
<br>

                                  <!--      <div class="form-group row"><label class="col-lg-3 "><strong>Reset Code</strong></label> 
                          <div class="col-sm-5"><?= $reset_code ?></div> 
                                          </div>  -->                                     
                                <!--        <div class="form-group row"><label class="col-lg-3 "><strong>Activate Code</strong></label> 
                          <div class="col-sm-5"><?= $activate_code ?></div> 
                                          </div> -->



<!--
                        <div class="form-group row"><label class="col-lg-3 "><strong>Timed PW Reset</strong></label>                                      
                          <?php if( $timed_reset   > 0) { ?>
                            <div class="col-sm-5">Yes</div>
                          <?php }else{ ?>

                            <div class="col-sm-5">No</div>
                          <?php } ?>  
                        </div>

                                          <div class="form-group row"><label class="col-lg-3 "><strong>Reset Interval (days)</strong></label> 
                          <div class="col-sm-5"><?= $reset_interval ?></div> 
                                          </div>  -->


                              
                                        <!--     <div class="form-group row"><label class="col-lg-4 "><strong>Phone</strong></label> 
                            <div class="col-sm-5"><?= $phone ?></div> 
                                              </div> -->

                                            
            
                                              
                        


                                        </div> <!-- end 2nd column -->

                                    </div> <!-- end row -->

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
						                </form>

 <?php endif; ?> <!-- End if($_SESSION['tab'] == 4) -->

						                <?php else: ?>  <!-- viewing Tab 4-->
                                <!--    <div class="row"> 
                                        <div class="col-md-6"> -->

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/4">Close</a>
                                      <?php if($locked > 0): ?> 
                                            <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/unlockacct/<?= $recid ?>/v">Unlock</a>
                                      <?php else: ?>                                
                                            <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/lockacct/<?= $recid ?>/v">Lock</a>
                                      <?php endif; ?> 
                                    
            <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
            <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
          <?php endif; ?>
                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >Update</a>
                                      <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/4">Close</a> 
            <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
            <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
          <?php endif; ?>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >xUpdate</a>
                                      <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/4">xClose</a>
            <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-warning" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
            <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
          <?php endif; ?>

                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>                                          
                                    <br>
                                    <br>
									                           <h3>User Account Credentials</h3>
									                           <br>
		                                <div class="row"> 
		                                    <div class="col-md-5">

                                            <div class="form-group row"><label class="col-lg-3 ">User Id</label> 
                          <div class="col-sm-5"><?= $trongate_user_id ?></div> 
                                            </div>

		                                        <div class="form-group row"><label class="col-lg-3 ">Username</label>
													<div class="col-sm-5"><?= $username ?></div> 
		                                        </div>                         
		                                        <div class="form-group row"><label class="col-lg-3 ">Level</label>
													<div class="col-sm-5"><?= $tguserlevelname ?></div> 
		                                        </div>
<br>

		                                        <h3>Account Status</h3>
		                                        <br>
		                            	        <div class="form-group row"><label class="col-lg-3 ">Login Locked</label>

													<?php if( $locked  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	

		                            	        <div class="form-group row"><label class="col-lg-3 ">Login Inactive</label>

													<?php if( $inactive  > 0) { ?>
														<div class="col-sm-5">Yes</div>
													<?php }else{ ?>

														<div class="col-sm-5">No</div>
													<?php } ?>	                               
												</div>	

                        <div class="form-group row"><label class="col-lg-3 ">Force PW Change</label>                                      
                          <?php if( $force_pw_chg   > 0) { ?>
                            <div class="col-sm-5">Yes</div>
                          <?php }else{ ?>

                            <div class="col-sm-5">No</div>
                          <?php } ?>  
                        </div>                        
			                        	        <div class="form-group row"><label class="col-lg-3 ">IP Address</label> 
													<div class="col-sm-5"><?= $ip_address ?></div> 
			                                    </div> 
			                        	        <div class="form-group row"><label class="col-lg-3 ">Token Expires</label> 
													<div class="col-sm-5"><?= $token_expires ?></div> 
			                                    </div>
                                        <div class="form-group row"><label class="col-lg-3 ">Reset Code</label> 
                          <div class="col-sm-5"><?= $reset_code ?></div> 
                                          </div>                                       
                                <!--        <div class="form-group row"><label class="col-lg-3 "><strong>Activate Code</strong></label> 
                          <div class="col-sm-5"><?= $activate_code ?></div> 
                                          </div> -->




                        <div class="form-group row"><label class="col-lg-3 ">Timed PW Reset</label>                                       
                          <?php if( $timed_reset   > 0) { ?>
                            <div class="col-sm-5">Yes</div>
                          <?php }else{ ?>

                            <div class="col-sm-5">No</div>
                          <?php } ?>  
                        </div>

                                          <div class="form-group row"><label class="col-lg-3 ">Reset Interval (days)</label> 
                          <div class="col-sm-5"><?= $reset_interval ?></div> 
                                          </div>  

			                                    <br>
												<h3>Account Activity</h3>
												<br>

		                            	        <div class="form-group row"><label class="col-lg-2 ">No Logins</label> 
													<div class="col-sm-5"><?= $num_logins ?></div> 
		                                        </div>                                        
			                        	        <div class="form-group row"><label class="col-lg-2 ">Last Login Device</label> 
													<div class="col-sm-5"><?= $last_login_device ?></div> 
			                                    </div> 
		                            	        <div class="form-group row"><label class="col-lg-2 ">Last Login</label> 
													<div class="col-sm-5"><?= $last_login ?></div> 
		                                        </div>
		                            	        <div class="form-group row"><label class="col-lg-2 ">Last Logout</label> 
													<div class="col-sm-5"><?= $last_logout ?></div> 
		                                        </div>



		                                    </div> <!-- end col-6 -->
		                                    <div class="col-md-4">
		                                    	<br>


<br>
<br>
<br>
<br>
<br>




		                          
			                                  <!--     <div class="form-group row"><label class="col-lg-4 "><strong>Phone</strong></label> 
														<div class="col-sm-5"><?= $phone ?></div> 
			                                        </div> -->

			           <!-- perhaps for system account                         	
			                                        <div class="form-group row"><label class="col-lg-4 "><strong>Photo</strong></label> 
														<div class="col-sm-5" ><?= $picture ?></div> 
			                                        </div> 


	           <form action="<?= BASE_URL ?>welcome-ccmps/uploadccmppic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">   
						<input type="file" name="picture" value="">
						<button type="submit" name="submit" value="Upload">Upload Photo</button>

				</form>			     -->      
			                                        
																		


		                                    </div> <!-- end 2nd column -->

		                                </div> <!-- end row -->

		<?php endif; ?> <!--  End Viewing Tab 4  -->	
									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                            	

							</div> <!-- End Tab 4 Panel -->





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

			                     <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
			                     		<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
		                				<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                    	</div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
			                      		<div>
                                     	<a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>" >Update</a>
                                    	</div>
		                                
			                    <?php else: ?> 

			                    <?php endif; ?> 



			                     <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
			                     		<div> 			                    
										<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm">Close</a> 
										</div>
			                    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
		                				<div>
	                                     <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm">Close</a> </div>
	                                    </div>

			                    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
			                      		<div>
		                                <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm">Close</a>
		                                </div>

			                    <?php else: ?> 

			                    <?php endif; ?> 

<?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Any Updating or creating mode -->
<!--  No buttons  -->
<?php else: ?>  
                    <?php if($trongate_user_id > 0): ?> 
						
            <!-- commented out to declutter. will work if uncomment because doesnt affect navigation since modal.
						<a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a>  
            -->
 


                    <?php else: ?>  
                   		 <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>
					<?php endif; ?>


                          <?php if($deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/undelrecord/<?= $recid ?>/v">Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/delrecord/<?= $recid ?>/v">Delete</a>

                          <?php endif; ?>
  <?php endif; ?> 
				
<!-- Begin Modal Form -->


   
   <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                       <div class="modal-dialog">
                       <div class="modal-content animated bounceInRight">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <i class="fa fa-laptop modal-icon"></i>
                                   <h4 class="modal-title">Reset Password</h4>
                                   <small class="font-bold">Enter the new password and confirm</small>
                               </div> 

                          <center><h3 id="result" ></h3></center>

                            <form action="" method = "post">                                
                               <div class="modal-body"> 
                                   
                               <!-- All these values are passed to the javascript routine in template inspinia.php and then to Ccmps.php controller. Any field changes here must be made in inspinia or wont pass  -->
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

									<input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="ResetID" id="ResetBtn" ></input>

                                   <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                               </div>
                           </form>
                   

                <!--    <a class="btn btn-danger btn-outline demo4" href="<= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v" type="button" >Delete</a> -->
                </div>
           


</div> <!--  tabs container -->

</div> <!-- ibox content for the page content section -->


<!-- End Modal Form -->

<!-- End Content   -->

<!-- Begin Footer   -->


<!-- End Footer   -->


