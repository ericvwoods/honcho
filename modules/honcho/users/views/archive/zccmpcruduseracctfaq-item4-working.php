                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq4" class="faq-question" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>User Account</h<?= $_SESSION['fontsize'] ?>></a>
                            <!--        <small>Added by <strong>Janet North</strong> <i class="fa fa-clock-o"></i> Today 2:43 pm - 22.06.2014</small> -->
                                </div>
                             <!--    <div class="col-md-3">
                                    <span class="small font-bold">Robert Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span> 
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    42
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['crudtab'] == 4): ?>
                                        <div id="faq4" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq4" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                <div class="ibox-content"> 
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'  || $_SESSION['ccmpmode'] == 'mosc' || $_SESSION['ccmpmode'] == 'mosu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 

<!-- <php if($_SESSION['crudtab'] == 4): ?> -->

                                <!--        <form  method = "post" action="<= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 

                                       <br>
                                               <h<?= $_SESSION['fontsize'] ?> ><strong>Account Status</strong></h<?= $_SESSION['fontsize'] ?>>
                                             <br>
                                    <div class="row"> 
                                        <div class="col-md-5">
 
                                            <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uUser Id</h<?= $_SESSION['fontsize'] ?>></label> 
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>
                                            
                                        <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>xUsername</h<?= $_SESSION['fontsize'] ?>></label> 
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div>         
                                     <!--   <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" ></div> -->
                                        </div>                                            
                                            
                                            
                                           <!--     <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;">Username</label> 
                                                    <div class="col-sm-5"><?= $username ?></div> 
                                                </div> -->
                     
                                            <div class="form-group row"><label class="col-lg-5" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $tguserlevelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>
<br>

<div style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Account Status</h<?= $_SESSION['fontsize'] ?>></div>
                                            <br>
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uLogin Locked</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="locked" type="text" class="form-control" value="<?= $locked ?>" hidden></div>
</div>
<br>
<br>  
<!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>                                             
                                          <div class="form-group  row"><label class="col-sm-3 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uLogin Locked</h<?= $_SESSION['fontsize'] ?>></label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="locked" Value="<?= $locked ?>" >
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
<?php endif; ?>
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="inactive" type="text" class="form-control" value="<?= $inactive ?>" hidden></div>
</div>
<br>
<br>  
<!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>  
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="inactive" Value="<?= $inactive ?>" >
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
<?php endif; ?>
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="force_pw_chg" type="text" class="form-control" value="<?= $force_pw_chg ?>" hidden></div>
</div>
<br>
<br>  
<!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>   
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="force_pw_chg" Value="<?= $force_pw_chg ?>" >
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
<?php endif; ?>


                                        </div> <!-- end col-6 -->
                                        <div class="col-md-3">
<br>
<br>
<br>
<br>
<br>
<br>

    

                                        </div> <!-- end 2nd column -->

                                    </div> <!-- end row -->
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"><h<?= $_SESSION['fontsize'] ?>></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 
                            </form>  <!-- end of continuous form-->

<!-- <php endif; ?> --><!-- End if($_SESSION['crudtab'] == 4) -->

                                        <?php else: ?>  <!-- viewing Tab 4-->
                             <!--       <div class="row"> 
                                        <div class="col-md-6"> -->

                              <div class="btn-group">

                          <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>

                              <div>

                                    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4/umd" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>

                                        <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
                     <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal">
                            <h<?= $_SESSION['fontsize'] ?>>Change My Password</h<?= $_SESSION['fontsize'] ?>>
                        </a>
              </div>                      
                                        <?php else: ?>

                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>"><h<?= $_SESSION['fontsize'] ?>>Create User Account</h<?= $_SESSION['fontsize'] ?>></a>   </div>
                                        <?php endif; ?>

                          <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
                            <div>
                                                            <div>
   
                                <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> xUpdate</h<?= $_SESSION['fontsize'] ?>></a>
                                <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                            </div>

                                    <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2"><h<?= $_SESSION['fontsize'] ?>>xReset Password</h<?= $_SESSION['fontsize'] ?>></a> 
              </div>                      
                                    <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>"><i class="fa fa-clone"></i><h<?= $_SESSION['fontsize'] ?>> Create User Account</h<?= $_SESSION['fontsize'] ?>></a>   </div>
                                    <?php endif; ?>


                          <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
                            <div>
                                                            <div>
   
                                <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" ><i class="fa fa-pencil"></i> <h<?= $_SESSION['fontsize'] ?>>Update</h<?= $_SESSION['fontsize'] ?>></a>
                                <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-times-circle"></i><h<?= $_SESSION['fontsize'] ?>> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                            </div>

                                    <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2"><h<?= $_SESSION['fontsize'] ?>>Reset Password2837</h<?= $_SESSION['fontsize'] ?>></a> 
              </div>                      
                                    <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>"><i class="fa fa-clone"></i><h<?= $_SESSION['fontsize'] ?>> Create User Account</h<?= $_SESSION['fontsize'] ?>></a>   </div>
                                    <?php endif; ?>


                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>

                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" ><i class="fa fa-pencil"></i> Update</a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><i class="fa fa-home"></i> Home</a>                                      
                       
                                    <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
                                    <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>"><i class="fa fa-clone"></i> Create User Account</a>   </div>
                                    <?php endif; ?>




                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" ><i class="fa fa-pencil"></i> Update</a>
                                    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1"><i class="fa fa-times-circle"></i> Exit</a>
                    
                                <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-warning" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
                                <?php else: ?>

                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>/view"><i class="fa fa-clone"></i> Create User Account</a>   </div>
                                <?php endif; ?>

                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>
                          
                                    <br>
                                    <br>
                            <?php if($_SESSION['crudtab'] == 4): ?> <!-- can only show the flashmsg once on a page -->
                                    <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                                    $flash_msg = '';
                                    set_flashdata($flash_msg); ?> 
                            <?php endif; ?> 
                                          
                           <strong> <?= validation_errors() ?></strong>
                                    <br>
                                    <h<?= $_SESSION['fontsize'] ?> ><strong>User Account Credentials</strong></h<?= $_SESSION['fontsize'] ?>>
                                                               <br>
                                        <div class="row">
                                            
                                     <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2) { ?>  <!-- all fields are the same except col widths of labels -->       
                                            <div class="col-md-5">

                                            <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vUser Id</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $tguserlevelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                            
                                            
                                     <?php }else{ ?>       
                                            <div class="col-md-5">

                                            <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vUser Id</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $tguserlevelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                
                                   <?php } ?> <!-- Fontsize not 1  -->
<br>

     <h<?= $_SESSION['fontsize'] ?> ><strong>Account Status</strong></h<?= $_SESSION['fontsize'] ?>>
                                                <br>
                                            <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2) { ?> <!-- all fields are the same except col widths of labels -->
                                            
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uLogin Locked</h<?= $_SESSION['fontsize'] ?>></label>

                                                    <?php if( $locked  > 0) { ?>
                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php }else{ ?>

                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php } ?>                                 
                                                </div>  

                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>

                                                    <?php if( $inactive  > 0) { ?>
                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php }else{ ?>

                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php } ?>                                 
                                                </div>  

                        <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>                                      
                          <?php if( $force_pw_chg   > 0) { ?>
                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php }else{ ?>

                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php } ?>  
                        </div>                        
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>IP Address</h<?= $_SESSION['fontsize'] ?>></label> 
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ip_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Token Expires</h<?= $_SESSION['fontsize'] ?>></label> 
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $token_expires ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                        <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Reset Code</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $reset_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                          </div>                                       
                                <!--        <div class="form-group row"><label class="col-lg-5 "><strong>Activate Code</strong></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $activate_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                          </div> -->




                        <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Timed PW Reset</h<?= $_SESSION['fontsize'] ?>></label>                                       
                          <?php if( $timed_reset   > 0) { ?>
                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php }else{ ?>

                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php } ?>  
                        </div>

                                          <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Reset Interval (days)</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><?= $reset_interval ?></div> 
                                          </div>                                                 
                                                
                                                
                                            <?php }else{ ?>    <!-- fontsize was 1  or 2 above  -->
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vLogin Locked</h<?= $_SESSION['fontsize'] ?>></label>

                                                    <?php if( $locked  > 0) { ?>
                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-4">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php }else{ ?>

                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-4">No</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php } ?>                                 
                                                </div>  

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>

                                                    <?php if( $inactive  > 0) { ?>
                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php }else{ ?>

                                                        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                                                    <?php } ?>                                 
                                                </div>  

                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>                                      
                          <?php if( $force_pw_chg   > 0) { ?>
                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php }else{ ?>

                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php } ?>  
                        </div>                        
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>IP Address</h<?= $_SESSION['fontsize'] ?>></label> 
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ip_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Token Expires</h<?= $_SESSION['fontsize'] ?>></label> 
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $token_expires ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Reset Code</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $reset_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                          </div>                                       
                                <!--        <div class="form-group row"><label class="col-lg-4 "><strong>Activate Code</strong></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $activate_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                          </div> -->




                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Timed PW Reset</h<?= $_SESSION['fontsize'] ?>></label>                                       
                          <?php if( $timed_reset   > 0) { ?>
                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php }else{ ?>

                            <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
                          <?php } ?>  
                        </div>

                                          <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Reset Interval (days)</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><?= $reset_interval ?></div> 
                                          </div>  
                        <?php } ?> <!-- Fontsize not 1 or 2  -->
    <br>
     <h<?= $_SESSION['fontsize'] ?> ><strong>Account Activity</strong></h<?= $_SESSION['fontsize'] ?>>
    <br>

                    <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2) { ?>
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vNo Logins</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $num_logins ?></h<?= $_SESSION['fontsize'] ?>></div> 
                    </div>                                        
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Login Device</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login_device ?></h<?= $_SESSION['fontsize'] ?>></div> 
                    </div> 
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Login</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login ?></h<?= $_SESSION['fontsize'] ?>></div> 
                    </div>
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Logout</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_logout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                    </div>
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Photo</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5" ><h<?= $_SESSION['fontsize'] ?>><?= $picture ?></h<?= $_SESSION['fontsize'] ?>> </div>
                    </div>
   
                    </div> <!-- end col-6 -->  
                    <div class="col-md-4"> <!-- 2nd column -->

                    </div> <!-- end 2nd column -->

                    </div> <!-- end row -->

                        
                    <?php }else{ ?>
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vNo Logins</h<?= $_SESSION['fontsize'] ?>></label> 
                            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $num_logins ?></h<?= $_SESSION['fontsize'] ?>></div> 
                        </div>                                        
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Login Device</h<?= $_SESSION['fontsize'] ?>></label> 
                            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login_device ?></h<?= $_SESSION['fontsize'] ?>></div> 
                        </div> 
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Login</h<?= $_SESSION['fontsize'] ?>></label> 
                            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login ?></h<?= $_SESSION['fontsize'] ?>></div> 
                        </div>
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Last Logout</h<?= $_SESSION['fontsize'] ?>></label> 
                            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_logout ?></h<?= $_SESSION['fontsize'] ?>></div> 
                        </div>
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>vPhoto</h<?= $_SESSION['fontsize'] ?>></label> 
                                        <div class="col-sm-5" ><h<?= $_SESSION['fontsize'] ?>><?= $picture ?></h<?= $_SESSION['fontsize'] ?>></div>
                                                </div>
                                                              
                                                               
                        </div> <!-- end col-6 -->
                        <div class="col-md-4"> <!-- 2nd column -->

                        </div> <!-- end 2nd column -->

                        </div> <!-- end row -->

                
                    <?php } ?>  
                            
                        <input type="file" name="picture" value="">
                        <button type="submit" name="submit" value="Upload">Upload Photo</button>
        <?php endif; ?> <!--  End Viewing Tab 4  -->    

                            
                                
                          

                     
                               