<?php 

  include('navbar.php');

?>
<!-- Need form open before the buttons in order for the Save Changes submit button to work  -->
<form  method = "post" action="<?= BASE_URL ?>honcho-users/usersubmit/<?= $recid ?>">
    
<div class="ibox-content"> <!-- ibox for page header -->
<div class="row"> <!-- Page Row One  -->
    <div class="col-lg-12"> <!-- Col 12 Page Row One -->                
        <div class="ibox-content">               
            <div class="row"> 

            <?php if(strlen($picture) > 0): ?> <!--  if user pic -->
                <div class="col-md-1">          
<center><img alt="user picture" src="<?= BASE_URL?>honcho-users_module/<?= $_SESSION['honcho_acct_rec_id'] ?>/<?= $picture ?>"/> </center>
                </div> <!-- end col -->
            <?php else: ?> <!-- No pic  -->
            <?php endif; ?>
            
            <?php if($_SESSION['actionmode'] == 'updatemydata' || $_SESSION['actionmode'] == 'updateuser'): ?> 
                <div class="col-md-8">
                                                                     
                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
                <br>  
<span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $prefix ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?>   <?= $suffix ?></span> 
            </div> <!-- end column -->
            
            <?php elseif($_SESSION['actionmode'] == 'createuser'): ?>
                  <div class="col-md-9"> 
                <br>                                    
                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
              
<span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"> Creating New <?= HONCHOUSER ?></span> 
            </div> <!-- end column --> 
            
            <?php else: ?> 
                <div class="col-md-9">
                <br>                                    
                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
                <br>  
<span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $prefix ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?>   <?= $suffix ?></span> 
            </div> <!-- end column -->                    
            <?php endif; ?>            

            

<!-- Save button is same for all  -->          
<!-- now isolate which one for the correct Cancel button -->

       <?php if($_SESSION['actionmode'] == 'updatemydata' ): ?> <!-- there is no mmdc - users cant create their own records   -->

       <div class="col-md-3">
                <br>   
                <br> 
       <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
  
           <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-users/mydata/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
          
            </div>
       <?php elseif($_SESSION['actionmode'] == 'updateuser'): ?>
            <div class="col-md-3">
                <br>   
                <br> 
           <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
  
           <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/viewuser/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
          
            </div>
       <?php elseif($_SESSION['actionmode'] == 'createuser'): ?>
            <div class="col-md-3">
                <br>   
              
           <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
  
           <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/manage/mngallusers"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
          
            </div>        
   <?php else: ?> 
                       <div class="col-md-2">

                        <?php if($_SESSION['user_role_id'] == 6): ?> 
<!-- Since the role is regular user, dont show the manage button -->
                <br>   
                <br> 
                <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>honcho/index"><span style="color: <?= NB_CLR ?>; font-size: 24px;"><i class="fa fa-home"></i> Exit </span></a> 
                       </div>

                        <?php else: ?>         
                <br>   
                <br> 
                <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>honcho-users/manage/mngallusers"><span style="color: <?= NB_CLR ?>; font-size: 24px;"><i class="fa fa-list"></i> Manage </span></a> 
                       </div>
                        <?php endif; ?>
       <?php endif; ?>
               

                             
                          
            </div> <!-- end row -->

        </div> <!-- end ibox-->
        <br> <!-- Gap between header and 1st Collapse -->  

        <div class="ibox ">
          <!--  <div class="ibox-title">
                <a class="btn btn-outline" style="color:RoyalBlue;"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home </h<?= $_SESSION['fontsize'] ?>></a> 
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a> 
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" class="dropdown-item">Config option 1</a>
                        </li>
                        <li><a href="#" class="dropdown-item">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a> 
                </div>
            </div> -->
                <?php include('usercrudcontact.php'); ?>
                    <!--  <php include('ccmpcrudxxx.php'); ?> -->
                    <!--  <php include('ccmpcrudfinacct.php'); ?>  -->
                   <!-- <php include('ccmpcruduseracct.php'); ?> -->

        </div>
      </div> 
</div>    
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



<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
<!--    <div class="modal-content animated bounceInRight"> -->
         <div class="modal-content animated rotateInDownRight"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <i class="fa fa-key modal-icon"></i>
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
        
            <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="ChangeBtn1" id="ChangeBtn1" ></input>

                  <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
              </div>
          </form>

        </div> 
      </div>
    </div>

 
   <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                       <div class="modal-dialog">
                       <div class="modal-content animated rotateInDownRight">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <i class="fa fa-key modal-icon"></i>
                                   <h4 class="modal-title">Reset Password <?= $recid ?></h4>
                                   <small class="font-bold">Enter the new password and confirm</small>
                               </div> 

                          <center><h3 id="result" ></h3></center>

                            <form action="" method = "post">                                
                               <div class="modal-body"> 
                                   
                               <!-- All these values are passed to the javascript routine in template inspinia.php and then to Ccmps.php controller. Any field changes here must be made in inspinia or wont pass  -->
                                   <div class="form-group">
                               <!--        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password" > -->
                                       <input type="password" class="form-control" id="npass2" placeholder="New Password" >
                                   </div>  
                                   <div class="form-group">
                               <!--        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password" > -->
                                       <input type="password" class="form-control" id="cpass2" placeholder="Confirm New Password" >                   
                                   </div>
                                   <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  -->
                                       <input type="text" class="form-control" id="rpwl2" value="<?= MINPWLGTH ?>" hidden>
                                   </div>

                                   <div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw  by way of JS in layoutone.php -->
                                       <input type="text" class="form-control" id="dbtupd2" value="ccmps" hidden>
                                   </div>

                                  <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                       <input type="text" class="form-control" id="id2" value="<?= $recid ?>"  hidden>
                                   </div> 



                               </div>
                               <div class="modal-footer">

                  <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="ResetID" id="ResetBtn" ></input>

                                   <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                               </div>
                           </form>
                   

                <!--    <a class="btn btn-danger btn-outline demo4" href="<= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v" type="button" >Delete</a> -->
           </div>
                        
                           
 <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<br>');
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