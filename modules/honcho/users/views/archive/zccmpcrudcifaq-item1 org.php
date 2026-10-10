                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="row">
                                        <div class="col-md-2">   
                  <a data-toggle="collapse" href="#faq1" class="faq-question" style="color:royalblue;"><h<?= $_SESSION['fontsize'] ?>>Contact Information</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div> <!-- end col -->
                                    </div> <!-- row -->
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['crudtab'] == 1): ?>
                                        <div id="faq1" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq1" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                    <div class="ibox-content"> 

                            <!-- Show flash message then reset it to blank  -->
                            <?php if($_SESSION['crudtab'] == 1): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
                                    <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                                    $flash_msg = '';
                                    set_flashdata($flash_msg); ?> 
                            <?php endif; ?> 
                             
                                          
                           <strong> <?= validation_errors() ?></strong>
                           <br>
                           
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'  || $_SESSION['ccmpmode'] == 'mosc' || $_SESSION['ccmpmode'] == 'mosu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!--<php if($_SESSION['crudtab'] == 1): ?> -->

                                 <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>">
                                   
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcsc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 


                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <br>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Prefix</label>

                                            <div class="col-sm-2"><input name="salutation" type="text" class="form-control" value="<?= $salutation ?>" ></div>
                                        </div>

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">First<a style="color:Red;">*</a></label>

                                             <div class="col-sm-8"><input name="first_name" type="text" class="form-control" value="<?= $first_name ?>" required></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Middle</label>

                                            <div class="col-sm-8"><input name="middle_name" type="text" class="form-control" value="<?= $middle_name ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Last<a style="color:Red;">*</a></label>

                                            <div class="col-sm-8"><input name="last_name" type="text" class="form-control" value="<?= $last_name ?>" required> </div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Suffix</label>

                                            <div class="col-sm-8"><input name="suffix" type="text" class="form-control" value="<?=$suffix ?>" ></div>
                                        </div>

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="current_year" type="text" class="form-control" value="<?= $current_year ?>" hidden></div>
                                        </div>

                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="member_type" type="text" class="form-control" value="<?= $member_type ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong>Eligible Voter</strong></label>

                                             <div class="col-sm-8"><input name="eligible_voter" type="text" class="form-control" value="<?= $eligible_voter ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <?php else: ?>  
                                             <div class="form-group  row"><label class="col-sm-2 col-form-label"  style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uMember Number</h<?= $_SESSION['fontsize'] ?>></label>

                                                 <div class="col-sm-4"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>"></div>
                                            </div>
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Current Year</label>

                                                <div class="col-sm-2"><input name="current_year" type="text" class="form-control" value="<?= $current_year ?>" ></div>
                                            </div> 

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Member Type<a style="color:Red;">*</a></label>
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
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Eligible Voter</label>

                                            <div class="col-sm-8"><input name="eligible_voter" type="text" class="form-control" value="<?= $eligible_voter ?>" ></div>
                                        </div>                                                                                                                                  
                                        <?php endif; ?>            


                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Email<a style="color:Red;" required>*</a></label>

                                             <div class="col-sm-8"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" placeholder='[Not required for student members S or Q]' ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phone</label>

                                            <div class="col-sm-8"><input name="phone" type="text" class="form-control" value="<?= $phone ?>" ></div>
                                        </div>  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mobile</label>

                                            <div class="col-sm-8"><input name="mobile" type="text" class="form-control" value="<?= $mobile ?>" ></div>
                                        </div> 
                                                                                 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Fax</label>

                                            <div class="col-sm-8"><input name="fax" type="text" class="form-control" value="<?= $fax ?>" ></div>
                                        </div>
                                            <div class="form-group  row">  <label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Restricted Access</label> 
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

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Directory Opt Out</label>
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

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Email Opt Out</label>
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

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Do Not Call</label>
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

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail Newsletter</label>
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
                                            <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="deceased" type="text" class="form-control" value="<?= $deceased ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Deceased</label>
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
                                            <?php endif; ?>  
                                            <!--    <div class="form-group row"><label class="col-lg-3 "><strong>No Address</strong> </label>
                                                    <div class="col-sm-5"><?= $no_address ?></div> 
                                                </div>  --> 

                                            <!--    <div class="form-group row"><label class="col-lg-3 "><strong>Special Event</strong> </label>
                                                    <div class="col-sm-5"><?= $special_event ?></div> 
                                                </div>  -->
                                            <!--    <div class="form-group row"><label class="col-lg-3 "><strong>Record Created</strong></label>
                                                    <div class="col-sm-5"><?= $created_at ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Created By</strong></label>
                                                    <div class="col-sm-5"><?= $created_by ?></div> 
                                                </div>  -->
                                              
                                                      <div class="ibox-content">
                                                <center style="color:RoyalBlue;"><strong>Mailing Address</strong></center>
                                   
                                                <br>
                                                <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail Address1</label>
                                                    <div class="col-sm-8"><input name="mailaddress1" type="text" class="form-control" value="<?= $mailaddress1 ?>" ></div>
                                                </div>                                          
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail Address2</label>
                                                    <div class="col-sm-8"><input name="mailaddress2" type="text" class="form-control" value="<?= $mailaddress2 ?>" ></div>
                                                </div> 
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail City</label>
                                                    <div class="col-sm-8"><input name="mailcity" type="text" class="form-control" value="<?= $mailcity ?>" ></div>
                                                </div>                                         
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail State <?= $mailingstate ?></label> 
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


                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Mail Zip</label>
                                            <div class="col-sm-2"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" ></div>
                                        </div> 
                                                
                                              

                                    </div>
                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                <br>
                                            
                                            <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mmdu'):  ?>
                                    
                                            <div class="col-sm-2"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" hidden></div>
                                    
                                            <?php else: ?>  
                                                <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

     <!-- Treasurer/sysadmin can assign chapter to a new member including Chapter at Large  -->
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Chapter<a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                     
                                                <?php else: ?> <!-- Adding/Creating  -->
                                     
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Chapter<a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                         
                                             <?php endif; ?> 
                                            <?php endif; ?> 

                                            <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="chapter_role" type="text" class="form-control" value="<?= $chapter_role ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><?= SUBENTITY ?> Role<a style="color:Red;">*</a></label>
                                                <div class="col-sm-6"><select class="form-control m-b" name="chapter_role" >
                                                <!-- Loop through the dropdown array passed in $data  -->
                                                <?php foreach($chapterroles as $row) { ?>
                                                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                    <?php if($row->id == $chapter_role): ?> 
                                                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                    <?php else: ?> <!-- otherwise just create the option -->
                                                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                    <?php endif; ?>
                                                 <?php } ?>                                    
                                                 </select>
                                                </div>
                                                </div>
                                           <?php endif; ?> 

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>

                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" ><strong></strong></label>

                                             <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">National Officer<a style="color:Red;">*</a></label>
                                                <div class="col-sm-6"><select class="form-control m-b" name="national_officer" >
                                                <!-- Loop through the dropdown array passed in $data  -->
                                                <?php foreach($nationalroles as $row) { ?>
                                                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                    <?php if($row->id == $national_officer): ?> 
                                                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                    <?php else: ?> <!-- otherwise just create the option -->
                                                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                    <?php endif; ?>
                                                 <?php } ?>                                    
                                                 </select>
                                                </div>
                                                </div>
                                         <?php endif; ?>

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="student_admin" type="text" class="form-control" value="<?= $student_admin ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Student Admin</label>
                                                  <div class="col-sm-2"><select class="form-control m-b" name="student_admin" Value="<?= $student_admin ?>"  >
                                                    <?php if($student_admin == 1) { ?>
                                                        <option selected value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    <?php }else{ ?>
                                                        <option value=1>Yes</option>
                                                        <option selected value=0>No</option>
                                                    <?php } ?>
                                                    </select>
                                                   </div>                                              
                                                </div>
                                         <?php endif; ?> 

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="chapter_admin" type="text" class="form-control" value="<?= $chapter_admin ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><?= SUBENTITY ?> Admin</label>
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
                                         <?php endif; ?> 


                                            <?php if($_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                    <!--     <div class="form-group  row"> -->
                                      <!--      <label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

                                            <div class="col-sm-8"><input name="content_mgr" type="text" class="form-control" value="<?= $content_mgr ?>" hidden></div>
                                    <!--    </div> -->
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Content Manager</label>
                                                  <div class="col-sm-2"><select class="form-control m-b" name="content_mgr" Value="<?= $content_mgr ?>"  >
                                                    <?php if($content_mgr == 1) { ?>
                                                        <option selected value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    <?php }else{ ?>
                                                        <option value=1>Yes</option>
                                                        <option selected value=0>No</option>
                                                    <?php } ?>
                                                    </select>
                                                   </div>                                              
                                                </div>
                                         <?php endif; ?> 

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                     <!--    <div class="form-group  row"> -->
                                       <!--     <label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

                                             <div class="col-sm-8"><input name="member_admin" type="text" class="form-control" value="<?= $member_admin ?>" hidden></div>
                                     <!--   </div> -->
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->


                                            <?php else: ?>  
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><?= CCMP ?> Admin</label>
                                                  <div class="col-sm-2"><select class="form-control m-b" name="member_admin" Value="<?= $member_admin ?>"  >
                                                    <?php if($member_admin == 1) { ?>
                                                        <option selected value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    <?php }else{ ?>
                                                        <option value=1>Yes</option>
                                                        <option selected value=0>No</option>
                                                    <?php } ?>
                                                    </select>
                                                   </div>                                              
                                                </div>
                                         <?php endif; ?> 

                                        <!--  Here we reversed the usual logic so that only a system admin can create another system admin -->
                                        <?php if($_SESSION['systemadmin'] == 1) : ?>
                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">System Admin</label>
                                                  <div class="col-sm-2"><select class="form-control m-b" name="system_admin" Value="<?= $system_admin ?>"  >
                                                    <?php if($system_admin == 1) { ?>
                                                        <option selected value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    <?php }else{ ?>
                                                        <option value=1>Yes</option>
                                                        <option selected value=0>No</option>
                                                    <?php } ?>
                                                    </select>
                                                   </div>                                              
                                                </div>
                                            <?php else: ?>  

                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                     <!--    <div class="form-group  row"> -->
                                       <!--     <label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

                                             <div class="col-sm-8"><input name="system_admin" type="text" class="form-control" value="<?= $system_admin ?>" hidden></div>
                                     <!--   </div> -->
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->

                                         <?php endif; ?> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Call Sign</label>

                                            <div class="col-sm-8"><input name="call_sign" type="text" class="form-control" value="<?= $call_sign ?>" ></div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Gender<a style="color:Red;">*</a></label>
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

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Birthday</label>

                                            <div class="col-sm-8"><input name="birthday" type="text" class="form-control" value="<?= $birthday ?>" ></div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Minor</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="minor" Value="<?= $minor ?>"  >
                                                <?php if($minor == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Aircraft Owner</label>
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

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Aircraft Type<a style="color:Red;">*</a></label>
                                            <div class="col-sm-8"><select class="form-control m-b" name="aircraft_type" >
                                            <!-- Loop through the dropdown array passed in $data  -->
                                            <?php foreach($aircrafttypes as $row) { ?>
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                <?php if($row->id == $aircraft_type): ?> 
                                                    <option selected value="<?= $row->id ?>"><?= $row->type ?> [<?= $row->manufacturer ?> <?= $row->name ?>]</option>
                                                <?php else: ?> <!-- otherwise just create the option -->
                                                    <option value="<?= $row->id ?>"><?= $row->type ?> [<?= $row->manufacturer ?> <?= $row->name ?>]</option>
                                                <?php endif; ?>
                                             <?php } ?>                                    
                                             </select>
                                            </div>
                                            </div>

                                 <!--       <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong>Aircraft Type</strong></label>

                                            <div class="col-sm-8"><input name="aircraft_type" type="text" class="form-control" value="<?= $aircraft_type ?>" ></div>
                                        </div> -->



                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Aircraft Reg</label>

                                            <div class="col-sm-8"><input name="aircraft_reg" type="text" class="form-control" value="<?= $aircraft_reg ?>" ></div>
                                        </div>                                                  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Misc 1</label>

                                            <div class="col-sm-8"><input name="misc1" type="text" class="form-control" value="<?= $misc1 ?>" ></div>
                                        </div> 
                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="misc2" type="text" class="form-control" value="<?= $misc2 ?>" hidden></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                        <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
                                        </div>


                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <?php else: ?> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Misc 2</label>

                                        <div class="col-sm-8"><input name="misc2" type="text" class="form-control" value="<?= $misc2 ?>" ></div>
                                        </div>
                                        <?php endif; ?>  

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="misc3" type="text" class="form-control" value="<?= $misc3 ?>" hidden></div>
                                        </div>

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                        <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
                                        </div>

                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <?php else: ?> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Misc 3</label>

                                            <div class="col-sm-8"><input name="misc3" type="text" class="form-control" value="<?= $misc3 ?>" ></div>
                                        </div>                                                                                       <?php endif; ?>  


                                                 
                                           <!--     <div class="form-group row"><label class="col-lg-3 "><strong>Last Updated</strong></label>
                                                    <div class="col-sm-5"><?= $updated_at ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Updated By</strong></label>
                                                    <div class="col-sm-5"><?= $updated_by ?></div> 
                                                </div>  -->
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

                                                <div class="ibox-content">
                                                <center style="color:RoyalBlue;"><strong>uPhysical Address</strong></center>
                                                <br>                                            
                                          <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Same as Mailing?</label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phys Address1</label>
                                            <div class="col-sm-8"><input name="physaddress1" type="text" class="form-control" value="<?= $physaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phys Address2</label>
                                            <div class="col-sm-8"><input name="physaddress2" type="text" class="form-control" value="<?= $physaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phys City</label>
                                            <div class="col-sm-8"><input name="physcity" type="text" class="form-control" value="<?= $physcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phys State</label> 
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;">Phys Zip</label>
                                            <div class="col-sm-2"><input name="physzip" type="text" class="form-control" value="<?= $physzip ?>" ></div>
                                        </div>    
                                                </div>                                                           
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                    <?php if($_SESSION['ccmpmode'] == 'mmdv' || $_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="notes" type="text" class="form-control" value="<?= $notes ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <?php else: ?> 
                                            <div class="form-group row"><label class="col-sm-3 col-form-label" style="color:RoyalBlue;">Notes</label>
                                                <div class="col-sm-12"><input name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 
                           <!--      </form>  continuous-->


<!-- <php endif; ?> --><!-- End if($_SESSION['crudtab'] == 1) --> 

            <?php else: ?>  <!-- viewing Tab 1-->
                                                    
                                        <div class="row"> 
                                            <div class="col-md-6">

                                  <div class="btn-group">

                                 <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a>
                                        <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>

                                        </div>

                                <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>
                                        
                                <?php else: ?> 

                                <?php endif; ?> 

                                </div>
                                                <br>
                                                <br>
                                <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2): ?> 
                                           <!--      <div class="form-group row"><label class="col-lg-4" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Number</h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></label>  -->
                                                <div class="form-group row"><label class="col-lg-4" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Number</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $member_no ?></h<?= $_SESSION['fontsize'] ?>></div>      
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Current Year</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $current_year ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                               
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Type</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $member_type ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                           
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Eligible Voter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $eligible_voter ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                              
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Email</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $email_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Call Sign</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $call_sign ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Phone</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $phone ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Mobile</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mobile ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Fax</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $fax ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                 <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Restricted Access</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $vip ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Opt Out Directory</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $directoryoptout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                               
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Opt Out Email</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $emailoptout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Do Not Call</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $donotcall ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Mail Newsletter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mail_notices ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Deceased</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $deceased ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>   
                                         <!--       <div class="form-group row"><label class="col-lg-4 "><h<?= $_SESSION['fontsize'] ?>>No Address</label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $no_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->     

                                            <!--    <div class="form-group row"><label class="col-lg-4 "><h<?= $_SESSION['fontsize'] ?>>Special Event</label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $special_event ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  -->
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Date Created</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $created_at ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Created By</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $created_by ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Updated</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $updated_at ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Updated By</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $updated_by ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                <?php else: ?> 
                                           <!--      <div class="form-group row"><label class="col-lg-3" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Number</h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></label>  -->
                                                <div class="form-group row"><label class="col-lg-3" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Number</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $member_no ?></h<?= $_SESSION['fontsize'] ?>></div>      
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Current Year</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $current_year ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                               
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Type</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $member_type ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                           
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Eligible Voter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $eligible_voter ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                              
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Email</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $email_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Call Sign</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $call_sign ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Phone</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $phone ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Mobile</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mobile ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Fax</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $fax ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                 <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Restricted Access</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $vip ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Opt Out Directory</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $directoryoptout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                               
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Opt Out Email</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $emailoptout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Do Not Call</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $donotcall ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Mail Newsletter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mail_notices ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 

                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Deceased</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $deceased ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>   
                                         <!--       <div class="form-group row"><label class="col-lg-3 "><h<?= $_SESSION['fontsize'] ?>>No Address</label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $no_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->     

                                            <!--    <div class="form-group row"><label class="col-lg-3 "><h<?= $_SESSION['fontsize'] ?>>Special Event</label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $special_event ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  -->
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Date Created</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $created_at ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Created By</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $created_by ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Updated</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $updated_at ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Updated By</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $updated_by ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                <?php endif; ?>                                             

                                          <?php if($_SESSION['fontsize'] == 1 ) { ?>
                                          <br>
                                          <br>

                                          <?php } ?>

                                                <div class="ibox-content">
                                                <center  style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><strong>Mailing Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
                                                <br>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Address 1</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mailaddress1 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                              
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Address 2</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mailaddress2 ?></h<?= $_SESSION['fontsize'] ?>></div>
                                                    </div>   
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>City</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mailcity ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                             
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>State</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mailstate ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>  
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Zipcode</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mailzip ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                
                                                </div>


                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                <br>
                                                <br>
                                                <br>
                                            <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2) { ?> <!-- code same just column widths change  -->
<!--     <div class="form-group row"><label class="col-lg-3 "><strong>Region</strong></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $region ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>      -->                                                                                         
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $chapter ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter Role</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $chapter_role ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>National Role</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $national_officer ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Student Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $student_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $chapter_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Content Manager</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $content_mgr ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>   

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><?= CCMP ?> Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $member_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>System Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $system_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                              
                                            
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Gender</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $gender ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Birthday</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $birthday ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>     
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Minor</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $minor ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                   
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Owner</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_owner ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Type</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_type ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Reg #</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_reg ?></h<?= $_SESSION['fontsize'] ?>></div>
                                                </div>                                                      
                                     
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 1</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $misc1 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 2</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $misc2 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 3</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-7"><h<?= $_SESSION['fontsize'] ?>><?= $misc3 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <?php if($_SESSION['fontsize'] == 1) { ?>
                                                <br>                                            
                                                <br>
                                                <br>
                                                 <br>
                                                <br>
                                                <br>
                                                <br>
                                                 <br>
                                                <br>
                                                <?php }else{ ?>
                                                 <br>
                                                <br>
                                                 <br>
                                                 <br>
                                                <br>
                                                <?php } ?> 
                                            <?php }else{ ?>
                                           <!--     <div class="form-group row"><label class="col-lg-3 "><strong>Region</strong></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $region ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>      -->                                                                                         
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $chapter ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter Role</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $chapter_role ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>National Role</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $national_officer ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Student Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $student_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Chapter Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $chapter_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Content Manager</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $content_mgr ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>   

                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><?= CCMP ?> Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $member_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>System Admin</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $system_admin ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                              
                                            
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Gender</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $gender ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Birthday</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $birthday ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>     
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Minor</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $minor ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                   
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Owner</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_owner ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Type</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_type ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Aircraft Reg #</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $aircraft_reg ?></h<?= $_SESSION['fontsize'] ?>></div>
                                                </div>                                                      
                                     
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 1</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $misc1 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 2</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $misc2 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous 3</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $misc3 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                                    
                                            <?php } ?> <!-- Font size not 1 -->
                                            
                                                <br>




                                                <div class="ibox-content">
                                                <center style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>vPhysical Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
                                                <br> 

                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Address 1</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $physaddress1 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Address 2</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $physaddress2 ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>City</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $physcity ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>State</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $physstate ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Zipcode</h<?= $_SESSION['fontsize'] ?>></label> 
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $physzip ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                </div>                                                    

                                                       
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                        <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
                                            <br>
                                        <?php else: ?> 
                                    
                                            <div class="form-group row"><label class="col-sm-3 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Member Record Notes</h<?= $_SESSION['fontsize'] ?>></label>
                                                <div class="col-sm-12"> <span class="form-text m-b-none"><h<?= $_SESSION['fontsize'] ?>><?= $notes ?></h<?= $_SESSION['fontsize'] ?>></span>
                                                </div>
                                            </div> 
                                        <?php endif; ?>

 
                </form>


                <?php endif; ?> <!--  End Viewing Tab 1  -->

                                    </div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                              
                            

                            </div> <!-- End Tab 1 Panel -->
                                        </div>
                                    </div>
                            <!--    </div> -->