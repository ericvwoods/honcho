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


<div class="wrapper wrapper-content animated fadeInRight">
<!--	<div class="ibox-content"> -->
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">                   
                          
                        <div>
                            <h2>Manage System Accounts</h2>
                        </div>

                        <div class="ibox-tools">
                       <!-- 	<a class="btn btn-rounded" href="<?= BASE_URL ?>dashboards/index/gsclasses/create/<?= $row->id ?>/m">Create</a> -->
                    <!--   	<a class="btn btn-success btn-rounded btn-outline btn-bitbucket" href="<?= BASE_URL ?>honcho/index/system_accounts/create//m">
                            <i class="fa fa-star"></i> Create
                        </a> -->
                            <!--    <i class="fa fa-chevron-up"></i> -->
                           
                       <!--     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul> -->
                        <!--    <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>

                    </div>

				<div class="ibox-content">	
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1">System Accounts</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Export</a></li>
                        </ul>
                        <div class="tab-content">

                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                        <?= flashdata('<div style="font-weight: bold; color: black;">', '</div>'); 
                                        $flash_msg = '';
                                        set_flashdata($flash_msg); ?> <!-- Show flash message then reset it to blank  --> 
                                        <br>
									<div class="ibox-content">
                               <!--    Choose an Account -->
                                    <strong>Choose an Account</strong> 
                                     <br>
                                    <br>
                                
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
                        <th>First</th>
                        <th>Last</th>
                        <th>Username</th>
                        <th>Access Level</th>
                        <th>System Id</th>
                        <th>TG Id</th>                      
                        <th>Verified</th>
                        <th>Approved</th>
                        <th>Inactive</th>
                        <th>Locked</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
						  	<?php
								foreach($rows as $row) { 

								?>
								<tr class='gradeA'>
									<td><?= $row->first_name ?></td>
									<td><?= $row->last_name ?></td>
									<td><?= $row->username ?></td>
									<td><?= $row->levelname ?></td>
									<td><?= $row->id ?></td>
									<td><?= $row->trongate_user_id ?></td>
									<?php if($row->verified == 1) { ?>
	                    				<td>Yes</td>
									<?php }else{ ?>
										<td>No</td>
									<?php } ?> 																						
									<?php if($row->approved == 1) { ?>
	                    				<td>Yes</td>
									<?php }else{ ?>
										<td>No</td>
									<?php } ?> 
									<?php if($row->inactive == 1) { ?>
	                    				<td>Yes</td>
									<?php }else{ ?>
										<td>No</td>
									<?php } ?> 
									<?php if($row->locked == 1) { ?>
	                    				<td>Yes</td>
									<?php }else{ ?>
										<td>No</td>
									<?php } ?> 
                                                           
									<td>                                                                  
                            <div class="btn-group">
                                <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $row->id ?>/m" >View</a>
                                <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/create/<?= $row->id ?>/m">Update</a>
                                <a class="btn btn-rounded btn-outline btn-danger"  type="button" onClick="return confirm('This account will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/system_accounts/del/<?= $row->id ?>/m">Delete</a>
                            </div>
                          
                        
									</td>

								</tr>
								<?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>First</th>
                        <th>Last</th>
                        <th>Username</th>
                        <th>Access Level</th>
                        <th>System Id</th>
                        <th>TG Id</th>                      
                        <th>Verified</th>
                        <th>Approved</th>
                        <th>Inactive</th>
                        <th>Locked</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    </table>

                    </div> <!-- ibox content -->

									</div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->
                            </div> <!-- End Tab Panel -->

                            <div role="tabpanel" id="tab-2" class="tab-pane">
 								<div class="panel-body">
									<div class="ibox-content">
                                  
                                    <strong>All Database Fields</strong> <br>Export Raw  Table - No Translated or Calculated Fields
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
                        <th>First</th>
						<th>Middle</th>
						<th>Last</th>
						<th>Suffix</th>
						<th>Email</th>
 						<th>Phone</th> 
 						<th>Title</th> 
 						<th>Department</th>
 						<th>Notes</th>
 						<th>Photo</th>
						<th>URL String</th>
 						<th>Date Created</th>
 						<th>Logins</th>
 						<th>Last Login</th>
 						<th>Last Logout</th>
                        <th>TG Id</th>
						<th>User Token</th>
                        <th>Inactive</th>                
                        <th>Verified</th>
                        <th>Approved</th>
                        <th>Locked</th>
                        <th>Confirmed</th>
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
						  	<?php
								foreach($rows as $row) { 

								?>
								<tr class='gradeA'>
									<td><?= $row->id ?></td>
									<td><?= $row->code ?></td>
                        			<td><?= $row->username ?></td>
 									<td><?= $row->password ?></td>
									<td><?= $row->first_name ?></td>
									<td><?= $row->middle_name ?></td>
									<td><?= $row->last_name ?></td>
									<td><?= $row->suffix ?></td>
									<td><?= $row->email_address ?></td>
			 						<td><?= $row->phone ?></td> 
			 						<td><?= $row->title ?></td> 
			 						<td><?= $row->department ?></td>
			 						<td><?= $row->notes ?></td>
			 						<td><?= $row->photo ?></td>
									<td><?= $row->url_string ?></td>
			 						<td><?= $row->date_created ?></td>
			 						<td><?= $row->num_logins ?></td>
			 						<td><?= $row->last_login ?></td>
			 						<td><?= $row->last_logout ?></td>
			                        <td><?= $row->trongate_user_id ?></td>
									<td><?= $row->user_token ?></td>
			                        <td><?= $row->inactive ?></td>                
			                        <td><?= $row->verified ?></td>
			                        <td><?= $row->approved ?></td>
			                        <td><?= $row->locked ?></td>
			                        <td><?= $row->confirmed ?></td>
			                        <td><?= $row->activate_code ?></td>
			                        <td><?= $row->reset_code ?></td>
			                        <td><?= $row->force_pw_chg ?></td>
			                        <td><?= $row->timed_reset ?></td>
			                        <td><?= $row->reset_interval ?></td>
			                        <td><?= $row->ip_address ?></td>
			                        <td><?= $row->homepage ?></td>
			                        <td><?= $row->created_by ?></td>
			                        <td><?= $row->updated_by ?></td>
			                        <td><?= $row->created_at ?></td>
			                        <td><?= $row->updated_at ?></td>
                                                           
							<!--		<td>                                                                  
                            <div class="btn-group">
                                <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $row->id ?>/m" >View</a>
                                <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/create/<?= $row->id ?>/m">Update</a>
                                <button class="btn btn-rounded btn-outline btn-danger" type="button">Delete</button>
                            </div>
                          
                        
									</td> -->

								</tr>
								<?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
						<th>Id</th>
						<th>Code</th>
                        <th>Username</th>
 						<th>Password</th>
                        <th>First</th>
						<th>Middle</th>
						<th>Last</th>
						<th>Suffix</th>
						<th>Email</th>
 						<th>Phone</th> 
 						<th>Title</th> 
 						<th>Department</th>
 						<th>Notes</th>
 						<th>Photo</th>
						<th>URL String</th>
 						<th>Date Created</th>
 						<th>Logins</th>
 						<th>Last Login</th>
 						<th>Last Logout</th>
                        <th>TG Id</th>
						<th>User Token</th>
                        <th>Inactive</th>                
                        <th>Verified</th>
                        <th>Approved</th>
                        <th>Locked</th>
                        <th>Confirmed</th>
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
                    </tfoot>
                    </table>

									</div> <!-- ibox content -->
								</div> <!--  panel body -->
							</div> <!-- End Tab Panel 2 -->

              			</div> <!-- Tab Content for All Tabs  -->

					</div> <!--  tabs container -->

				</div> <!-- ibox content for the page content section -->




                <br>
                        <a class="btn btn-success btn-rounded btn-outline btn-bitbucket" href="<?= BASE_URL ?>honcho/index/system_accounts/create//m">
                          <!--  <i class="fa fa-star"></i>--> Create New Account
                        </a>

                    </div>
                </div>
            </div>
       <!--     </div> -->
        </div>

