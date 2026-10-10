  <div class="ibox-content">
         <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">

<?php if($recid > 0) { ?>   <!-- Updating  -->
<span class="break"><h2>Updating <?= $salutation ?> <?= $first_name ?> <?= $last_name ?></h2></span>

<?php }else{ ?> 
<span class="break"><h2>Creating System Account</h2></span>  <!-- Adding New Account -->

<?php } ?> 
                    <!-- These values are returned in memory as $this->input('id', true);  -->
                    <!-- These values must be in system_accounts/_system_accounts_fetch_data_from_post() to be captured from memory
                          and stored in $data to be saved to DB -->      
                           
                            <div class="ibox-tools">
                             
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                <br>
               
                            <?= validation_errors() ?>

                            <h3>User Account></h3>
                            <a style="color:Red;">*</a> = required
                        <!--    <form  method = "post" action="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $id ?>/<?= $frmpg ?>"> -->
                                <form  method = "post" action="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $recid ?>/<?= $frmpg ?>"> <!-- frmpg passed to form and passed back in URL or Post below-->

                                <!--   --> 
                        <!--    <form  method = "post" action="/submit/<?= $id ?>/<?= $frmpg ?>"> -->
                        <!--    <form  method = "post" action="<?= current_url(); ?>submit/<?= $id ?>/<?= $frmpg ?>"> -->
                            <!--	<form  method = "post" action="<?=__DIR__?>/../../submit/<?= $id ?>/<?= $frmpg ?>"> -->
                                <div class="row"> 

                                    <div class="col-md-6">

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">First<a style="color:Red;">*</a></label>

                                             <div class="col-sm-10"><input name="first_name" type="text" class="form-control" value=<?= $first_name ?> ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Middle</label>

                                            <div class="col-sm-10"><input name="middle_name" type="text" class="form-control" value=<?= $middle_name ?> ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Last<a style="color:Red;">*</a></label>

                                            <div class="col-sm-10"><input name="last_name" type="text" class="form-control" value=<?= $last_name ?>> </div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Suffix</label>

                                            <div class="col-sm-10"><input name="suffix" type="text" class="form-control" value=<?= $suffix ?> ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Username<a style="color:Red;">*</a></label>

                                            <div class="col-sm-10"><input name="username" type="text" class="form-control" value=<?= $username ?> ></div>
                                        </div>
                               <!--         <div class="form-group  row"><label class="col-sm-2 col-form-label">User Level</label>

                                            <div class="col-sm-10"><input name="tguserlevelname" type="text" class="form-control" value=<?= $tguserlevelname ?> ></div>
                                        </div> -->

                            <?php if($recid > 0): ?> <!-- Updating vs. Adding a new record  -->

                            <?php if($action3_r > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                                <!-- Extract the current user_level_id (from trongate_users table) from $data array to preselect that option -->
                                <?php   $culid = $data['currentuserlevel'];?>
                        
                                
                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Access Level:</label>

                                <div class="col-sm-9"><select class="form-control m-b" name="userlevel" >
                                <!-- Loop through the dropdown array passed in $data  -->
                                  <?php foreach($usrlvls as $row) { ?>
                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                    <?php if($row->id == $culid): ?> 
                                       <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                    <?php else: ?> <!-- otherwise just create the option -->
                                        <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                    <?php endif; ?>
                                  <?php } ?>                                    
                                  </select>
                                </div>
                                </div>

                            <?php endif; ?> <!--  $action3_r  -->                         
                            <?php else: ?> <!-- Adding -->
<!-- Dropdown fed by object - new record so can just get the full list
// get topics object for dropdown - you can show $row->title but save $row->id
$data['tpcs'] = $this->model->get('id','gstopics');  -->

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Password<a style="color:Red;">*</a></label>

                                    <div class="col-sm-10"><input name="password" type="text" class="form-control" value=<?= $password ?> ></div>
                                </div>

                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Access Level:</label>

                                <div class="col-sm-9"><select class="form-control m-b" name="userlevel" >
                                <!-- Loop through the dropdown array passed in $data  -->
                                  <?php foreach($usrlvls as $row) { ?>
                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                        <?php if($row->id == 4): ?> <!-- ccmp = 4 -->
                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                        <?php else: ?> 
                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                        <?php endif; ?> 
                                  <?php } ?>                                    
                                  </select>
                                </div>
                                </div> 

                            <?php endif; ?>

                                    </div> <!-- end col-6 -->
                                    <div class="col-md-6">

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>

                                            <div class="col-sm-10"><input name="title" type="text" class="form-control" value=<?= $title ?> ></div>
                                        </div>                                        
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Org/Unit</label>

                                            <div class="col-sm-10"><input name="department" type="text" class="form-control" value=<?= $department ?> ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phone</label>

                                            <div class="col-sm-10"><input name="phone" type="text" class="form-control" value=<?= $phone ?> ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Email<a style="color:Red;">*</a></label>

                                             <div class="col-sm-10"><input name="email_address" type="text" class="form-control" value=<?= $email_address ?> ></div>
                                        </div>
                                  <!--      <div class="form-group  row"><label class="col-sm-2 col-form-label">Photo</label>

                                            <div class="col-sm-10"><input name="photo" type="text" class="form-control" value=<?= $photo ?> ></div>
                                        </div> -->
                                <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Homepage</label>

                                            <div class="col-sm-10"><input name="homepage" type="text" class="form-control" value=<?= $homepage ?> ></div>
                                        </div> -->                                                                                   
                                    </div> <!-- end 2nd column -->
                                </div> <!-- end row -->

                         <!--       <br> -->
                            
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Notes</label>
                                    <div class="col-sm-12"><input name="notes" type="text" class="form-control" value=<?= $notes ?> > <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                        <?php if($action3_r > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                                 <h3>User Account Status </h3>
                                 <br> 
                                <div class="row">
                                    <div class="col-md-6">
  <!-- <div class="col-sm-2"><input type="text" class="form-control" value=<?= $locked ?> ></div> -->
                                    <!--    <div class="form-group">
                                            <label> <input type="checkbox" name="locked"> Locked </label>
                                        </div> --><!-- if checkbox, $locked = "on" when checked, NULL when not checked  -->

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Login Locked</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="locked" Value="$locked" >
                                                <?php if($locked == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Login Inactive</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="inactive" Value="$inactive" >
                                                <?php if($inactive == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                                  
                                            </div>
                                          <div class="form-group  row"><label class="col-sm-3 col-form-label">Verified Identity</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="verified" Value="$verified" >
                                                <?php if($verified == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                          <div class="form-group  row"><label class="col-sm-3 col-form-label">Approved</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="approved" Value="$approved" >
                                                <?php if($approved == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                          

                                                                                             

                                    </div> <!-- column -->

                                <div class="col-md-6"> 

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Email Confirmed</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="confirmed" Value="$confirmed" >
                                                <?php if($confirmed == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <?php if($recid > 0): ?> <!--  Updating -->
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Force PW Change</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="force_pw_chg" Value="$force_pw_chg" >
                                                <?php if($force_pw_chg == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                        <?php else: ?> <!-- Adding -->

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Force PW Change New</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="force_pw_chg" Value="$force_pw_chg" >
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                              </select>
                                            </div>
                                        </div>


                                        <?php endif; ?>




                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Timed Reset</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="timed_reset" Value="$timed_reset" >
                                                <?php if($timed_reset == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Reset Interval</label>
                                                <div class="col-sm-3"><input name="reset_interval" type="text" class="form-control" value=<?= $reset_interval ?> ></div>
                                            </div>

                                        <!--    <div class="form-group  row"><label class="col-sm-3 col-form-label">Rec Id</label> -->
                                                <div class="col-sm-2"><input name="id" type="text" class="form-control" value="<?= $recid ?>" hidden></div> <!-- after the first failed save $id blanks but $recid stays -->
                                        <!--    </div> -->                                      

                                       <!--     <div class="form-group  row"><label class="col-sm-3 col-form-label">Frmpg</label> -->
                                                <div class="col-sm-3"><input name="frmpg" type="text" class="form-control" value="<?= $frmpg ?>" hidden></div> <!-- passed to form and passed back in Post below or URL above -->
                                     <!--       </div> -->

                                       <!--     <div class="form-group  row"><label class="col-sm-3 col-form-label">Status</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="locked" Value="$locked" >
                                                <?php if($status == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                      -->
   
                                 </div>             
                                </div>  <!-- end row -->    


                                <!--     <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div> -->

                                <div class="hr-line-dashed"></div>
                        <?php endif; ?>

                                <h3>Financial Account</h3>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if($action3_r > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Account Type</label> 
                                        <div class="col-sm-8"><select type="text" class="form-control m-b" name="acct_type" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($accttypes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $accttypeid): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end acct_type -->
                                    <?php endif; ?>
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Fin Contact's Email</label> 
                                        <div class="col-sm-8"><input name="fin_email" type="text" class="form-control w-b" placeholder="defaults to user email if left blank" value=<?= $fin_email ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Copy Billing Info to Shipping Info?</label>
                                          <div class="col-sm-3"><select class="form-control" name="fin_billisship" Value="$Fin_billisship" >
                                            <?php if($fin_billisship == 1) { ?>
                                                <option selected>Yes</option>
                                                <option>No</option>
                                            <?php }else{ ?>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>         

                                    <div class="ibox-content"> 
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Name</label> 
                                        <div class="col-sm-8"><input name="billname" type="text" class="form-control" placeholder="defaults to user name if left blank" value=<?= $billname ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Phone</label> 
                                        <div class="col-sm-8"><input name="billphone" type="text" class="form-control" placeholder="defaults to user phone if left blank" value=<?= $billphone ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address1</label> 
                                        <div class="col-sm-8"><input name="billaddress1" type="text" class="form-control" value=<?= $billaddress1 ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address2</label> 
                                        <div class="col-sm-8"><input name="billaddress2" type="text" class="form-control" value=<?= $billaddress2 ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill City</label> 
                                        <div class="col-sm-8"><input name="billcity" type="text" class="form-control" value=<?= $billcity ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill State</label> 
                                        <div class="col-sm-8"><select type="text" class="form-control m-b" name="billstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $billstate): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Zip</label> 
                                        <div class="col-sm-3"><input name="billzip" type="text" class="form-control" value=<?= $billzip ?> ></div>
                                        </div>
                                    </div> <!-- End Ibox  -->

                                    </div> <!--  col end  -->
                                    <div class="col-md-6">

                                        <div class="form-group  row"> 
                                        <div class="col-sm-3"><input name="fin_id" type="text" class="form-control" value=<?= $fin_id ?> hidden></div>
                                        </div>

                                    <?php if($action3_r > 0): ?> <!-- action 3 is for field access c,r,u,d fields and buttons  -->


                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Balance</label> 
                                        <div class="col-sm-3"><input name="acct_bal" type="text" class="form-control" value=<?= $acct_bal ?> ></div>
                                        </div>
                                    
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">$ Acct Status</label> 
                                        <div class="col-sm-6"><select type="text" class="form-control m-b" name="fin_status" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($finstatuses as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $finstatusid): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end acct_type -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">$ Acct Inactive</label>
                                          <div class="col-sm-3"><select class="form-control m-b" name="fin_inactive" Value="$fin_inactive" >
                                            <?php if($fin_inactive == 1) { ?>
                                                <option selected>Yes</option>
                                                <option>No</option>
                                            <?php }else{ ?>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>
                                    <?php endif; ?>
                                    <div class="ibox-content"> 
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Name</label> 
                                        <div class="col-sm-6"><input name="shipname" type="text" class="form-control" value=<?= $shipname ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Phone</label> 
                                        <div class="col-sm-6"><input name="shipphone" type="text" class="form-control" value=<?= $shipphone ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address1</label> 
                                        <div class="col-sm-6"><input name="shipaddress1" type="text" class="form-control" value=<?= $shipaddress1 ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address2</label> 
                                        <div class="col-sm-6"><input name="shipaddress2" type="text" class="form-control" value=<?= $shipaddress2 ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship City</label> 
                                        <div class="col-sm-6"><input name="shipcity" type="text" class="form-control" value=<?= $shipcity ?> ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship State</label> 
                                        <div class="col-sm-8"><select type="text" class="form-control m-b" name="shipstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $shipstate): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Zip</label> 
                                        <div class="col-sm-3"><input name="shipzip" type="text" class="form-control" value=<?= $shipzip ?> ></div>
                                        </div>                                        
                                    </div> <!-- End Ibox  -->
                                    </div> <!--  col end  -->
                                </div> <!-- row end -->


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        
                                        <?php if($recid > 0 | $id > 0): ?> <!-- If record id passed then editing an existing record -->
                                        <div class="btn-group">

<!-- <a class="btn btn-rounded btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $recid ?>/v" >Save Changes</a> -->
<button class="btn btn-rounded btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                            <!-- Determine where to go if cancelling -->
                                            <?php if($frmpg == 'v'): ?>
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $recid ?>">Cancel</a>
                     
                                         <!--       <button class="btn btn-white btn-sm" type="submit">Cancel</button> -->
                                            <?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Cancel</a>

                                            <?php endif; ?>

                                        <?php else: ?> <!-- If no record id passed then creating a new record -->
                                            
 <button class="btn btn-rounded btn-outline btn-primary" type="submit" name="submit" value="Submit" >Save New Account</button> 

 <!-- <a class="btn btn-rounded btn-outline btn-warning" type="submit" value="Submit">New Save Account</a> -->
                                        <!--        <a class="btn btn-rounded btn-outline btn-warning" type="submit" value="Submit" href="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $id ?>/<?= $frmpg ?>">New Save Account</a> -->
                        <!-- Determine where to go if cancelling -->
                                            <?php if($frmpg == 'v'): ?>
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/view/<?= $recid ?>">Cancel new-view</a>
                     
                                         <!--       <button class="btn btn-white btn-sm" type="submit">Cancel</button> -->
                                            <?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho/index/system_accounts/manage">Cancel</a>

                                            <?php endif; ?>

                                        <?php endif; ?>
                                        </div> <!-- button group -->                       
                                    </div>
                                </div>
                            </form>

                        </div> <!-- ibox content -->
                    </div>
                </div>
    </div> <!-- ibox content -->    
