<?php 


  include('navbar.php');

?> 


<!-- Begin Content   -->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

  <div class="ibox-content">
         <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">



                       
   <div class="row">
              <div class="col-md-1">  
                                       
                  <a href="#" title="">
                                <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo"> 
                  </a>
               
              </div>


 <div class="col-md-10">  


          <span class="break" style="color:RoyalBlue;"><h2><strong>Creating a New User Account</strong></h2><p><h2> for  <?= $first_name ?> <?= $last_name ?></h2></p></span>

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
               
                           <strong> <?= validation_errors() ?></strong>

                                       




                                 <h3>New User Account </h3>
                                 <br> 
                                <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpuseracctsubmit/<?= $recid ?>"> <!-- frmpg passed to form and passed back in Post below-->
                                <div class="row">
                                    <div class="col-md-6">
  <!-- <div class="col-sm-2"><input type="text" class="form-control" value=<?= $locked ?> ></div> -->
                                    <!--    <div class="form-group">
                                            <label> <input type="checkbox" name="locked"> Locked </label>
                                        </div> --><!-- if checkbox, $locked = "on" when checked, NULL when not checked  -->


                                         <div class="form-group  row"><label class="col-sm-3 col-form-label">Contact Email<a style="color:Red;">*</a></label>

                                            <div class="col-sm-8"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Username</label>

                                            <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" placeholder="defaults to contact email above" disabled> </div>
                                        </div>


                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Password</label>
  <!-- <div class="col-sm-8"><input name="password" type="text" class="form-control" value="<?= $password ?>" ></div> -->
                                    <div class="col-sm-8"><input name="password" type="text" class="form-control" value="Preset to a system default" disabled></div>
                                </div>
                                       
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Force PW Change</label>
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

                                      <!--      <div class="form-group  row"><label class="col-sm-3 col-form-label">Login Locked</label>
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
                                            </div>   -->                                                

                                    </div> <!-- column -->

                                <div class="col-md-6"> 


                                            </div> <!-- class col-6 -->

                                        <!--    <div class="form-group  row"><label class="col-sm-3 col-form-label">Rec Id</label> -->
                                                <div class="col-sm-2"><input name="id" type="text" class="form-control" value="<?= $recid ?>" hidden></div> <!-- after the first failed save $id blanks but $recid stays -->
                                        <!--    </div> -->                                      

                                       <!--     <div class="form-group  row"><label class="col-sm-3 col-form-label">Frmpg</label> -->
                                                <div class="col-sm-2"><input name="frmpg" type="text" class="form-control" value="<?= $frmpg ?>" hidden></div> <!-- passed to form and passed back in Post below or URL above -->
                                     <!--       </div> -->


   
                                 </div>             
                                </div>  <!-- end row -->    


                                <!--     <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div> -->


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        
                  
                                        <div class="btn-group">


<button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Account</button>
                                            <!-- Determine where to go if cancelling -->



                           <?php if($_SESSION['returnto'] == 'manage'): ?>

                                  <?php $_SESSION['returnto'] = ''; ?>
                                  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/<?=  $_SESSION['mode'] ?>"><i class="fa fa-times-circle"></i> Cancel</a>

                          <?php else: ?> 
                                  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>"><i class="fa fa-times-circle"></i> Cancel</a>
                          <?php endif; ?> 





                               
                                       <!--    <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>">Cancel</a> -->
                     
                                         <!--       <button class="btn btn-white btn-sm" type="submit">Cancel</button> -->


                                        </div> <!-- button group -->                       
                                    </div>
                                </div>
                            </form>

                        </div> <!-- ibox content -->
                    </div>
                </div>
    </div> <!-- ibox content -->

   
