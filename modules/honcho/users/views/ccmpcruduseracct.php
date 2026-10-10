
<!-- *********************************************************************** -->
<!-- ****** Begin Boiler Plate for 1st CRUD Item containing Form Open ****** -->
<!-- *********************************************************************** -->
 <div>


<div class="faq-item"> <!-- Ends at end of file -->
 
        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                        <!-- #faq? must be unique but not in any order  -->
                        <center><a data-toggle="collapse" href="#faq4" class="faq-question" style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-key fa-1x fa-1x"></i></span><strong> User Account </strong> <i class="fa fa-unsorted fa-1x" style="color: <?= CCMPS_HM_TAB_CARET_CLR ?>;"></i></h2>  </a> </center>

                     </div> <!-- end col -->
                 </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['ccmp_active_window'] must be equal to #faq number  -->
                <?php if($_SESSION['ccmp_active_window'] == 2): ?>
                    <div id="faq4" class="panel-collapse">
                <?php else: ?>
                    <div id="faq4" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['ccmp_active_window'] == 4): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
   <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php endif; ?>
        <?php endif; ?> 


       <strong> <?= validation_errors() ?></strong>
       <br>                        
<!-- *********************************************************************** -->
<!-- ************************* End Boiler Plate **************************** -->
<!-- *********************************************************************** -->   

<!-- *********************************************************************** -->
<!-- *************************** Begin Content ***************************** -->
<!-- *********************************************************************** -->                 

<!-- *********************************************************************** -->
<!-- ********************* Begin Create/Update Section ********************* -->
<!-- *********************************************************************** -->

<!-- Member (mmd-manage.my.data)c/u, CA (mom-manage.our.members) c/u, SA (mos-manage.our.students)c/u, MCM (mcm-manage.current.members)c/u ??? , MAM (mam-manage.all.members) c/u   -->
<?php if($_SESSION['ccmpmode'] == 'updatemydata' || $_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'  || $_SESSION['ccmpmode'] == 'mosc' || $_SESSION['ccmpmode'] == 'mosu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!-- **************************** Begin Form ******************************* -->
<!-- Form to post the create/update form values - the view is also contained in the form -->
<!-- The first faq item must contain the form open and the last item the form close -->
<!-- *********************************************************************** -->

    <!-- This is the last faq item with no opening tag but a closing tag at the bottom -->
        
<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!-- Save button is same for all  -->

    <div>
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>          
<!-- now isolate which one for the correct Cancel button -->

    <?php if($_SESSION['ccmpmode'] == 'updatemydata' ): ?> <!-- there is no mmdc - users cant create their own records   -->

        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcsc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>                                        

    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php else: ?> 

    <?php endif; ?>
             
<!-- ************************* End Save/Cancel buttons ********************* -->

<!-- *************************** Begin Section Header ********************** -->
       
            <div style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></div>
       
<!-- *************************** End Section Header ************************ -->

<!-- *********************************************************************** -->
<!-- ********************** Begin Create/Update Fields ********************* -->
<!-- *********************************************************************** -->
        <div class="row"> 
            <div class="col-md-6">
<!-- *********************************************************************** -->
<!-- ****************** Left Column Create/Update Fields ******************* -->
<!-- *********************************************************************** -->                 


 <!--    <p> Left column create/update fields go here </p> -->
<br>
<!-- These next 3 fields are view only.  Replace with view code when developed.  ???  -->
    
    <div class="form-group row"><label class="<?= $labelclass ?>" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>User Id</h<?= $_SESSION['fontsize'] ?>></label> 
         <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>

    <div class="form-group  row"><label class="<?= $labelclass ?>" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label> 
         <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div>         
      <!--   <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" ></div> -->
    </div>                                            

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>UN</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" hidden></div>
</div>

    <div class="form-group row"><label class="<?= $labelclass ?>" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $levelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>LVL</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="levelname" type="text" class="form-control" value="<?= $levelname ?>" hidden></div>
</div>

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>TGUID</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="tg_user_id" type="text" class="form-control" value="<?= $trongate_user_id?>" hidden></div>
</div>

    <div class="form-group row"><label class="<?= $labelclass ?>" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $levelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>

<!-- <div style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Account Status</h<?= $_SESSION['fontsize'] ?>></div> -->
                                        
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Locked</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="loginlocked" type="text" class="form-control" value="<?= $locked ?>" hidden></div>
</div>
<br>
<br>  
<!-- END --How to handle not updatable by still pass current value to the save   -->

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="logininactive" type="text" class="form-control" value="<?= $inactive ?>" hidden></div>
</div>
<br>
<br>  
<!-- END --How to handle not updatable by still pass current value to the save   -->

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>

     <div class="col-sm-8"><input name="forcepwchange" type="text" class="form-control" value="<?= $force_pw_chg ?>" hidden></div>
</div>
<br>
<br>   
<!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>

    <!-- Yes/No Dropdowns -->
    <!--   "Login Inactive" => "$inactive", -->
    <?php $fields401 = ["Login Locked"    => "$locked",
                        "Login Inactive"  => "$inactive",
                        "Force PW Change" => "$force_pw_chg"
                    ]; ?>

    <?php foreach($fields401 as $label=> $value) { ?>
        <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
        <?php $inputname = strtolower($inputname); ?> 
                <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
                  <div class="<?= $yesnodiv ?>"><select class="form-control m-b" name="<?= $inputname ?>" Value="<?= $value ?>" style="<?= $selectstyle ?>">
                    <?php if($value == 1) { ?>
                        <option selected value=1>Yes</option>
                        <option value=0>No</option>
                    <?php }else{ ?>
                        <option value=1>Yes</option>
                        <option selected value=0><h<?= $_SESSION['fontsize'] ?>>No</h<?= $_SESSION['fontsize'] ?>></option>
                    <?php } ?>
                    </select>
                   </div>                                              
                </div> 
    <?php } ?>   

<?php endif; ?>
        <br>

      
<!-- *********************************************************************** -->
  <?php if($_SESSION['fontsize'] == 0):  ?> <!--  just for testing -->
<!-- <php if($_SESSION['mobileformat'] == 1 ): ?> -->
<!-- if mobile make all one column  -->
<?php else: ?> 
<!-- ******************* End Left Column of Create/Update Fields ******************** -->
        </div> <!-- end col-6 -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Right Column of Create/Update Fields ********************* -->
        <div class="col-md-6">
<!-- *********************************************************************** --> 
  <?php endif; ?>


 <!--   <p> Right column create/update fields go here </p>   -->         
<!--<br>
<br>
<br>
<br>
<br>
<br> -->

<!-- *********************************************************************** -->
<!-- **************** End Right Column Create/Update Fields **************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


  <!--  <p>Create/update fields outside row go here</p> -->


<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!-- Save button is same for all  -->

    <div>
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button> 
    
<!-- now isolate which one for the correct Cancel button -->

    <?php if($_SESSION['ccmpmode'] == 'updatemydata' ): ?> <!-- there is no mmdc - users cant create their own records   -->

        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcsc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>                                        

    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php else: ?> 

    <?php endif; ?> 

<!-- *********************************************************************** -->
<!-- ********************** End Create/Update Fields *********************** -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************** End Create/Update Section ********************** -->
<!-- *********************************************************************** -->
            <?php else: ?> <!-- Only thing left is all view modes  -->
<!-- *********************************************************************** -->
<!-- ************************** Begin View Section ************************* -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ************************ Begin Viewing Fields ************************* -->
<!-- *********************************************************************** -->
                                                    
    <div class="row"> <!-- Contains the left and right view columns  -->
         <div class="col-md-6">

<!-- *********************************************************************** -->
<!-- ******************* Update/Exit Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!--  Or if user account   -->

                <div class="btn-group">

            <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>

                <div>

                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2/umd" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
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

                  <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
              </div>

                      <?php if($trongate_user_id > 0): ?>
<!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
<a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2"><h<?= $_SESSION['fontsize'] ?>>Reset Password</h<?= $_SESSION['fontsize'] ?>></a> 
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

<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Left Column of View Fields ********************** -->
<!-- *********************************************************************** --> 


    <!-- <p>left column view fields go here</p> -->
                                                             
  <?php if($_SESSION['ccmpmode'] == 'viewmydata'): ?>
    <div>
<!-- <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome" style="font-weight: bold; font-size: 46px; color: lightseagreen;"> &#8592; </a> -->
    <!-- Passes a /1 to signify 1st tab to return to after edit/cancel/exit -->

 <!--   <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> xHome</h<?= $_SESSION['fontsize'] ?>></a> -->

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a> <!-- /2 tab number to reopen  -->
    <a data-toggle="modal" data-target="#fontModal" class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-wrench"></i> Font [<span style="color: lightgray"><?= $_SESSION['dfontsize'] ?></span>]</h<?= $_SESSION['fontsize'] ?>> </a>       
             

        
    </div>
 
  <?php endif; ?>  
                          
                                    <br>
                                    <br>
                            <?php if($_SESSION['ccmp_active_window'] == 4): ?> <!-- can only show the flashmsg once on a page -->
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

                                            <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>User Id</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $levelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                            



                                     <?php }else{ ?>       
                                            <div class="col-md-5">

                                            <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>User Id</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $levelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                
                                   <?php } ?> <!-- Fontsize not 1  -->
        <br>
    <?php $itemsv102 = [ 
                        "Student Admin"     => "$student_admin",
                        "Chapter Admin"     => "$chapter_admin",
                        "Content Admin"     => "$content_mgr",
                        "Member Admin"      => "$member_admin",
                        "System Admin"      => "$system_admin"

                        ]; ?>           

<div class="ibox-content text-box">
        <center  style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><strong>Super User Privileges</strong></h<?= $_SESSION['fontsize'] ?>></center>
    <?php foreach($itemsv102 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 
</div> <!-- end ibox content  -->

     <h<?= $_SESSION['fontsize'] ?> ><strong>Account Status</strong></h<?= $_SESSION['fontsize'] ?>>
                                                <br>
                                            <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2) { ?> <!-- all fields are the same except col widths of labels -->
                                            
                                                <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Login Locked</h<?= $_SESSION['fontsize'] ?>></label>

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
                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>No Logins</h<?= $_SESSION['fontsize'] ?>></label> 
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
               <form action="<?= BASE_URL ?>welcome-ccmps/uploadccmppic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">                  
                       <input type="file" name="picture" value="">
    <button type="submit" name="submit" value="Upload">Upload Photo</button>
       </div>
                    </div> <!-- end col-6 -->  

                        
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
                        <div class="form-group row"><label class="col-lg-4 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Photo</h<?= $_SESSION['fontsize'] ?>></label> 
                        <div class="col-sm-5" ><h<?= $_SESSION['fontsize'] ?>><?= $picture ?></h<?= $_SESSION['fontsize'] ?>></div>
                        </div>
                   <form action="<?= BASE_URL ?>welcome-ccmps/uploadccmppic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">                    
                    <input type="file" name="picture" value="">
    <button type="submit" name="submit" value="Upload">Upload Photo</button>
       </div>
                    <?php } ?>
                                                              
                           
<!-- *********************************************************************** -->
  <?php if($_SESSION['fontsize'] == 0):  ?> <!--  just for testing -->
<!-- <php if($_SESSION['mobileformat'] == 1 ): ?> -->
<!-- if mobile make all one column  -->
<?php else: ?> 
<!-- ******************* End Left Column of View Fields ******************** -->
        </div> <!-- end col-6 -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Right Column of View Fields ********************* -->
        <div class="col-md-6">
<!-- *********************************************************************** --> 
  <?php endif; ?>

 <!--   <p>right column view fields go here</p> -->
 

<!-- *********************************************************************** -->
<!-- ****************** End Right Column of View Fields ******************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right view columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


<!--    <p>view fields outside row go here</p>  -->
                            


<!-- *********************************************************************** -->
<!-- ************************* End Continous Form ************************** -->
<!-- If this is the only faq crud item or the last faq crud item -->
     </form>  <!-- only in last faq item by actual order not faq# -->
<!-- *********************************************************************** -->

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->

 <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<h3>View: welcome-ccmps/views/ccmpcrud</h3>');
    echo('<h3>New Session Id</h3>');
    $session_id = session_id();
    echo ('<h3>'.$session_id.'</h3>');    
    echo('<h3>$_COOKIE</h3>');
    json($_COOKIE);
    echo('<br>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
 <?php endif; ?>