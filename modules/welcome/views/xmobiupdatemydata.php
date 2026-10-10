  <div class="ibox-content">
         <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">


<span class="break"><h2>Updating Information for <?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?></h2></span>


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

                            <h3>Contact Information</h3>
                            <a style="color:Red;">*</a> = required
                        <!--    <form  method = "post" action="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $id ?>/<?= $frmpg ?>"> -->
                                <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveupdate/<?= $recid ?>/<?= $frmpg ?>"> <!-- frmpg passed to form and passed back in URL or Post below-->

                                <!--   --> 
                        <!--    <form  method = "post" action="/submit/<?= $id ?>/<?= $frmpg ?>"> -->
                        <!--    <form  method = "post" action="<?= current_url(); ?>submit/<?= $id ?>/<?= $frmpg ?>"> -->
                            <!--	<form  method = "post" action="<?=__DIR__?>/../../submit/<?= $id ?>/<?= $frmpg ?>"> -->
                                <div class="row"> 

                                    <div class="col-md-6">
                                    <?php if($_SESSION['chapteradmin'] == 1): ?> 
                                 <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Member Type<a style="color:Red;">*</a></label>

                                             <div class="col-sm-10"><input name="member_type" type="text" class="form-control" value="<?= $member_type ?>" ></div>
                                        </div> -->
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Current Year<a style="color:Red;"></a></label>

                                            <div class="col-sm-10"><input name="current_year" type="text" class="form-control" value="<?= $current_year ?>" ></div>
                                        </div>              

                                    <?php endif; ?>
                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Member Type<a style="color:Red;">*</a></label>
                                        <div class="col-sm-9"><select class="form-control m-b" name="member_type" >
                                        <!-- Loop through the dropdown array passed in $data  - see Welcome-mobiupdatemydata() -->
                                        <?php foreach($membertypes as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $membertypeid): ?> <!-- from Welcome - _get_a_single_record() -->
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->ccmp_type ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->ccmp_type ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>                                    
                                    
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Prefix<a style="color:Red;"></a></label>

                                             <div class="col-sm-10"><input name="salutation" type="text" class="form-control" value="<?= $salutation ?>" ></div>
                                        </div> 
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">First<a style="color:Red;">*</a></label>

                                             <div class="col-sm-10"><input name="first_name" type="text" class="form-control" value="<?= $first_name ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Middle</label>

                                            <div class="col-sm-10"><input name="middle_name" type="text" class="form-control" value="<?= $middle_name ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Last<a style="color:Red;">*</a></label>

                                            <div class="col-sm-10"><input name="last_name" type="text" class="form-control" value="<?= $last_name ?>" > </div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Suffix</label>

                                            <div class="col-sm-10"><input name="suffix" type="text" class="form-control" value="<?=$suffix ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Call Sign</label>

                                            <div class="col-sm-10"><input name="call_sign" type="text" class="form-control" value="<?= $call_sign ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Email<a style="color:Red;">*</a></label>

                                             <div class="col-sm-10"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phone</label>

                                            <div class="col-sm-10"><input name="phone" type="text" class="form-control" value="<?= $phone ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile</label>

                                            <div class="col-sm-10"><input name="mobile" type="text" class="form-control" value="<?= $mobile ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Fax</label>

                                            <div class="col-sm-10"><input name="fax" type="text" class="form-control" value="<?= $fax ?>" ></div>
                                        </div>                                        
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Gender<a style="color:Red;">*</a></label>
                                        <div class="col-sm-9"><select class="form-control m-b" name="gender" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($genders as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $genderid): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Birthday</label>

                                            <div class="col-sm-10"><input name="birthday" type="text" class="form-control" value="<?= $birthday ?>" ></div>
                                        </div> 

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Owner <?= $aircraft_owner ?></label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="aircraft_owner" Value="<?= $aircraft_owner ?>" >
                                                <?php if($aircraft_owner == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Type</label>

                                            <div class="col-sm-10"><input name="aircraft_type" type="text" class="form-control" value="<?= $aircraft_type ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Reg #</label>

                                            <div class="col-sm-10"><input name="aircraft_reg" type="text" class="form-control" value="<?= $aircraft_reg ?>" ></div>
                                        </div> 
                                   
                                <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter</label>

                                            <div class="col-sm-10"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" ></div>
                                        </div>  -->

                                        <?php if($_SESSION['chapteradmin'] == 1): ?> 

                                       <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter Role<a style="color:Red;"></a></label>
                                        <div class="col-sm-9"><select class="form-control m-b" name="chapter_role" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($chapterroles as $row) { ?>
                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $chapterroleid): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter Admin</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="chapter_admin" Value="<?= $chapter_admin ?>" >
                                                <?php if($chapter_admin == 'Yes') { ?>
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


 
                                        <center>Mailing Address </center>
<br>
<div class="ibox-content"> 
                                        <div class="form-group row"><label class="col-sm-2 col-form-label">Mail Address1</label>
                                            <div class="col-sm-10"><input name="mailaddress1" type="textarea" class="form-control" value="<?= $mailaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Address2</label>
                                            <div class="col-sm-10"><input name="mailaddress2" type="text" class="form-control" value="<?= $mailaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail City</label>
                                            <div class="col-sm-10"><input name="mailcity" type="text" class="form-control" value="<?= $mailcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail State</label> 
                                        <div class="col-sm-10"><select type="text" class="form-control m-b" name="mailstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $mailstate): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                             <!--           <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail State</label>
                                            <div class="col-sm-10"><input name="mailstate" type="text" class="form-control" value="<?= $mailstate ?>" ></div>
                                        </div> -->
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Zip</label>
                                            <div class="col-sm-10"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" ></div>
                                        </div>                                                                                                                        
                            <!--        </div> <!-- end col-6 ->
                                    <div class="col-md-6"> -->


                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email Opt Out</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="emailoptout" Value="<?= $emailoptout ?>" >
                                                <?php if($emailoptout == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Do Not Call</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="donotcall" Value="<?= $donotcall ?>" >
                                                <?php if($donotcall == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                            
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Newsletter</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="mail_notices" Value="<?= $mail_notices ?>" >
                                                <?php if($mail_notices == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                                                                                 
                                            </div> <!-- ibox -->

<br>
<p></p>  <!-- 1 paragraph = 1/2 br -->
                                        <center>Physical Address </center>
<br>
<div class="ibox-content"> 
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Same as Mailing Address?</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="mail_phys" Value="<?= $mail_phys ?>" >
                                                <?php if($mail_phys == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Address1</label>
                                            <div class="col-sm-10"><input name="physaddress1" type="text" class="form-control" value="<?= $physaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Address2</label>
                                            <div class="col-sm-10"><input name="physaddress2" type="text" class="form-control" value="<?= $physaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys City</label>
                                            <div class="col-sm-10"><input name="physcity" type="text" class="form-control" value="<?= $physcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys State</label> 
                                        <div class="col-sm-10"><select type="text" class="form-control m-b" name="physstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $physstate): ?> <!-- was$ culid -->
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Zip</label>
                                            <div class="col-sm-10"><input name="physzip" type="text" class="form-control" value="<?= $physzip ?>" ></div>
                                        </div>                                                                                                                           
                                    </div> <!-- end 2nd column -->
                                </div> <!-- end row -->
</div> <!-- ibox -->
                                <div class="hr-line-dashed"></div>
                   <!--     <php if($action3_r > 0): ?> line 753 --><!-- action 3 is for field access c,r,u,d fields and buttons  -->
                           <!--      <h3></h3>
                                 <br> 
                                <div class="row">
                                    <div class="col-md-6">
                                                                                        
                                    </div> <!-- column ->

                                <div class="col-md-6"> 
                                        


                                 </div>             
                                </div>  <!-- end row -->    


                                <h3>Financial Account</h3>
                           <!--     <br> -->
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Fin Contact's Email</label> 
                                        <div class="col-sm-8"><input name="fin_email" type="text" class="form-control w-b" placeholder="defaults to user email if left blank" value="<?= $fin_email ?>" ></div>
                                        </div>

        
                                        <center>Billing Address </center>
<br>
                                    <div class="ibox-content"> 
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Name</label> 
                                        <div class="col-sm-8"><input name="billname" type="text" class="form-control" placeholder="defaults to user name if left blank" value="<?= $billname ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Phone</label> 
                                        <div class="col-sm-8"><input name="billphone" type="text" class="form-control" placeholder="defaults to user phone if left blank" value="<?= $billphone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address1</label> 
                                        <div class="col-sm-8"><input name="billaddress1" type="text" class="form-control" value="<?= $billaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address2</label> 
                                        <div class="col-sm-8"><input name="billaddress2" type="text" class="form-control" value="<?= $billaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill City</label> 
                                        <div class="col-sm-8"><input name="billcity" type="text" class="form-control" value="<?= $billcity ?>" ></div>
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
                                        <div class="col-sm-3"><input name="billzip" type="text" class="form-control" value="<?= $billzip ?>" ></div>
                                        </div>
                                    </div> <!-- End Ibox  -->

                        <!--            </div> <!--  col end  ->
                                    <div class="col-md-6"> -->
<br>
                                        <center>Shipping Address </center>
                                        <br>
                                        <div class="ibox-content">
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Same as Billing Address?</label>
                                          <div class="col-sm-3"><select class="form-control" name="fin_billship" Value="<?=  $fin_billship ?>" >
                                            <?php if($fin_billship == 'Yes') { ?>
                                                <option selected>Yes</option>
                                                <option>No</option>
                                            <?php }else{ ?>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>                                         
<br>

                            <!--        <div class="ibox-content"> -->
                                     
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Name</label> 
                                        <div class="col-sm-6"><input name="shipname" type="text" class="form-control" value="<?= $shipname ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Phone</label> 
                                        <div class="col-sm-6"><input name="shipphone" type="text" class="form-control" value="<?= $shipphone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address1</label> 
                                        <div class="col-sm-6"><input name="shipaddress1" type="text" class="form-control" value="<?= $shipaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address2</label> 
                                        <div class="col-sm-6"><input name="shipaddress2" type="text" class="form-control" value="<?= $shipaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship City</label> 
                                        <div class="col-sm-6"><input name="shipcity" type="text" class="form-control" value="<?= $shipcity ?>" ></div>
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
                                        <div class="col-sm-3"><input name="shipzip" type="text" class="form-control" value="<?= $shipzip ?>" ></div>
                                        </div>                                        
                                    </div> <!-- End Ibox  -->

<br>
                                <h3>Credentials</h3>


                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Highest Certificate</label> 
                                        <div class="col-sm-8"><select type="text" class="form-control m-b" name="highest_certificate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($cert_titles as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->

                                            <?php if($row->id == $highcertid): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->description ?> </option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> </option>
                                            <?php endif; ?>
                                          <?php } ?>
                                          </select>
                                        </div>
                                        </div> <!--  -->


                                 <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Highest Certificate</label>
                                            <div class="col-sm-10"><input name="highest_certificate" type="text" class="form-control" value="<?= $highest_certificate ?>" ></div>
                                        </div>  -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Certificate No</label>
                                            <div class="col-sm-10"><input name="certificate_number" type="text" class="form-control" value="<?= $certificate_number ?>" ></div>
                                        </div>                                            
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert</label>
                                            <div class="col-sm-10"><input name="other_faa_cert" type="text" class="form-control" value="<?= $other_faa_cert ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert #</label>
                                            <div class="col-sm-10"><input name="ofc_certnum" type="text" class="form-control" value="<?= $ofc_certnum ?>" ></div>
                                        </div>                                                               
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crewmember</label>
                                            <div class="col-sm-10"><input name="other_crewmember" type="text" class="form-control" value="<?= $other_crewmember ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crew Cert #</label>
                                            <div class="col-sm-10"><input name="ocm_certnum" type="text" class="form-control" value="<?= $ocm_certnum ?>" ></div>
                                        </div> 
<br>
<!--
                                <medium class="text-navy">Check all that apply</medium>
                                <div class="form-group row"><!-- <label class="col-sm-2 col-form-label"><h3>Credentials</h3> <br/><small class="text-navy">Check all that apply</small></label> ->
                                         <div class="i-checks"><label> <input type="checkbox" name="ap" value="1"> <i></i> A & P </label></div>
</div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">A&P #</label>
                                            <div class="col-sm-10"><input name="ap_number" type="text" class="form-control" value="<?= $ap_number ?>" ></div>
                                        </div>
<div class="form-group row">
                                        <div class="i-checks"><label> <input type="checkbox" name="ia"value="1"> <i></i> IA  </label></div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">IA #</label>
                                            <div class="col-sm-10"><input name="ia_number" type="text" class="form-control" value="<?= $ia_number ?>" ></div>
                                        </div>
</div>
<div class="form-group row">                                        
                                        <div class="i-checks"><label> <input type="checkbox" name="option3"value="1"> <i></i> Option three </label></div>
                                 </div>       
                                <div class="form-group row">
                                         <div class="i-checks"><label> <input type="checkbox" name="option4" value="1"> <i></i> Option 4 </label></div>
                                        <div class="i-checks"><label> <input type="checkbox" name="option5"value="1"> <i></i> Option 5  </label></div>
                                        <div class="i-checks"><label> <input type="checkbox" name="option6"value="1"> <i></i> Option 6 </label></div>
                                 </div> 
-->




                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">IA</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="ia" Value="<?= $ia ?>" >
                                                <?php if($ia == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military A&P</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="military_maint" Value="<?= $military_maint ?>" >
                                                <?php if($military_maint == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Land</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="se_land" Value="<?= $se_land ?>" >
                                                <?php if($se_land == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Land</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="me_land" Value="<?= $me_land ?>" >
                                                <?php if($me_land == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Sea</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="se_sea" Value="<?= $se_sea ?>" >
                                                <?php if($se_sea == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Sea</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="me_sea" Value="<?= $me_sea ?>" >
                                                <?php if($me_sea == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Instrument</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="instrument" Value="<?= $instrument ?>" >
                                                <?php if($instrument == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFI</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="cfi" Value="<?= $cfi ?>" >
                                                <?php if($cfi == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFII</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="cfii" Value="<?= $cfii ?>" >
                                                <?php if($cfii == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">MEI</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="mei" Value="<?= $mei ?>" >
                                                <?php if($mei == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                                                                        
                              <!--      </div> <!-- column ->

                                <div class="col-md-6"> -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Total Time</label>
                                            <div class="col-sm-10"><input name="total_time" type="text" class="form-control" value="<?= $total_time ?>" ></div>
                                        </div>                                    
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Active Duty</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="active_duty" Value="<?= $active_duty ?>" >
                                                <?php if($active_duty == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                          
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Former Military</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="former_military" Value="$<?= $former_military ?>" >
                                                <?php if($former_military == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>   
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military Pilot</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="military_pilot" Value="<?= $military_pilot ?>" >
                                                <?php if($military_pilot == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                            
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ATC</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="atc" Value="<?= $atc ?>" >
                                                <?php if($atc == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Dispatcher</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="dispatcher" Value="<?= $dispatcher ?>" >
                                                <?php if($dispatcher == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                             

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Maintenance</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="maintenance" Value="<?= $maintenance ?>" >
                                                <?php if($maintenance == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Drone</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="drone" Value="<?= $drone ?>" >
                                                <?php if($drone == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                           </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">DPE</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="dpe" Value="<?= $dpe ?>" >
                                                <?php if($dpe == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">BGI</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="bgi" Value="<?= $bgi ?>" >
                                                <?php if($bgi == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">AGI</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="agi" Value="<?= $agi ?>" >
                                                <?php if($agi == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Rotocraft</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="rotocraft" Value="<?= $rotocraft ?>" >
                                                <?php if($rotocraft == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Glider</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="glider" Value="<?= $glider ?>" >
                                                <?php if($glider == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Balloon</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="balloon" Value="<?= $balloon ?>" >
                                                <?php if($balloon == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Airship</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="airship" Value="$<?= $airship ?>" >
                                                <?php if($airship == 'Yes') { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 




                                    </div> <!--  col end  -->
                                </div> <!-- row end -->





                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        

                                        <div class="btn-group">

<!-- <a class="btn btn-rounded btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $recid ?>/v" >Save Changes</a> -->
<button class="btn btn-rounded btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                            <!-- Determine where to go if cancelling -->
                                            <?php if($frmpg == 'v'): ?>
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome/mobiviewccmp/<?= $recid ?>">Cancel</a>
                                            <?php elseif($frmpg == 'm'): ?> 
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome/mobichapterroster/">Cancel</a>
                                            <?php else: ?> <!-- if not coming from the view page or manage page you are coming from the mmd page mobimydata -->
                                                <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome/mobimydata/">Cancel</a>

                                            <?php endif; ?>


                                        </div> <!-- button group -->                       
                                    </div>
                                </div>
                            </form>

                        </div> <!-- ibox content -->
                    </div>
                </div>
    </div> <!-- ibox content -->    
