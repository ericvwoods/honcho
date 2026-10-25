
<?php 
  include('navbar.php');
?>    

    <!-- start: Nav Bar include statements still work when comment out must delete the ? from php-->

 <!--   <?php if($frmpg == 'ccmphomemc'): ?> <!-- ccmphomemc manage chapter  ->
                                  
     <php include('navbar.php'); ?>   <!-- Chapter Administration Portal  ->

    <?php else: ?> <!-- ccmphomema manage all ->
          <php include('navbar4.php'); ?>  <!-- National Treasurer Functions  ->
    
    <?php endif; ?> -->
  <!-- end: Nav Bar--> 

<!-- Begin Content   -->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

    <div class="ibox-content"> <!-- ibox for page header -->
            <div class="row">
                <div class="col-lg-12">
               
                    <div class="ibox-title">   
<div class="row">
<div class="col-lg-11">
                    <?php if($_SESSION['ccmpmode'] == 'momm'): ?> 
                          <div>
                            <span class="m-r"><a href="#"><h2><strong>Manage <?= SUBENTITY ?> <?= CCMPS ?></strong></h2>
                             <h2><?= $_SESSION['chapter_name'] ?> </h2></a></span>

                          </div>  

                    <?php elseif($_SESSION['ccmpmode'] == 'mcmm'): ?> 
                
                        <div>
                         
                          <span class="m-r"><a href="#"><h2><strong>Manage Current <?= CCMPS ?></strong></h2>
                          </h2></a></span>
                        </div>
                                            <?= flashdata('<div style="font-weight: bold; color:
                      green; ">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 
                            <br>

                    <?php elseif($_SESSION['ccmpmode'] == 'mamm'): ?>
                      
                        <div>
                         
                            <span class="m-r"><a href="#"><h2><strong>Manage All <?= CCMPS ?></strong> </h2>
                            </a></span>
                        </div>

                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 
                            <br>
                    <?php else: ?> 

                    <?php endif; ?>


</div> <!-- col 11 -->
<div class="col-lg-1">
          <ul class="nav navbar-top-links navbar-right">
            <li>
                 <!--   <php if(strlen($picture) > 0): ?> -->
                    <div class="col-md-1">   
                          <h1 class="logo text-center">
                              <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                                  <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                              </a>
                          </h1>
                </div> <!-- end col -->
            <!--  <php endif; ?> -->

            </li>
          </ul>
</div> <!-- col 1 -->

</div> <!-- row   -->

                    </div>

                <div class="ibox-content">  

                    <?php if($_SESSION['ccmpmode'] == 'momm'): ?> 
                        <div>
                          <strong>All <?= SUBENTITY ?> <?= CCMP ?> Records</strong> 
                           <br>Choose a Record to View/Edit
                        </div>

                    <?php elseif($_SESSION['ccmpmode'] == 'mcmm'): ?> 
                        <div>
                          <strong>Only Dues Current <?= CCMPS ?></strong> <br>Choose a Record to View/Edit
                        </div>

                    <?php elseif($_SESSION['ccmpmode'] == 'mamm'): ?>
                        <div>
                          <strong>All <?= CCMPS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit
                        </div>                      

                    <?php else: ?> 

                    <?php endif; ?>


              <!--        <?php if($mcma == 'mcm'): ?> 
                                    
                        <div>
                          <strong>Only Current Member Records - Excluding Deceased & Deleted</strong> <br>Choose a Record to View or Edit
                        </div>

                      <?php else: ?> 
                        <div>
                         <strong>All Member Records - Including Deceased & Deleted</strong> <br>Choose a Record to View or Edit
                        </div>
    
                      <?php endif; ?> -->

                                 <span class="loading words"></span>              
                            
                            <br>
    

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" > 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                     <!--   <th>DB Id</th>  -->
                        <th style="color:RoyalBlue;">Name</th> 
                        <th style="color:RoyalBlue;">Email</th>  
                        <th style="color:RoyalBlue;">Member Number</th> 
                        <th style="color:RoyalBlue;">Member Type</th> 
                        <th style="color:RoyalBlue;">Current Year</th>
                         <?php if($_SESSION['ccmpmode'] == 'momm'): ?> 
                         <?php else: ?> 
                            <th style="color:RoyalBlue;">Chapter</th>
                         <?php endif; ?>
                        <th style="color:RoyalBlue;">Location</th>                                           



                    
                   <!--     <th style="color:RoyalBlue;">Current</th>  -->

 
                   <!--     <th style="color:RoyalBlue;">Phone</th> -->
                   <!--     <th style="color:RoyalBlue;">Mobile</th> -->


                 
   <!--  <th>Locked?</th> -->
                     <!--   <th>Updated</th> -->
                     <!--       <th style="color:RoyalBlue;">Acct #</th> -->
                        <th style="color:RoyalBlue;">Options</th>
                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($rows as $row) { 

                                ?>
                                <tr class='gradeA'>
                                <!--    <td><?= $row->id ?></td> -->
                              <!--      <td><?= $row->trongate_user_id ?></td>   --> 
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></td> 
                                   <td><?= $row->email_address ?></td>
                                    <td><?= $row->member_no ?></td>
                                     <td><?= $row->member_type ?></td>    
                                    <td><?= $row->current_year ?></td>  
                                    <?php if($_SESSION['ccmpmode'] == 'momm'): ?> 
                                    <?php else: ?> 
                                          <td><?= $row->chapter ?></td>
                                    <?php endif; ?> 
                                    <td> <?= $row->mailcity ?>, <?= $row->mailstate ?> </td>
 
                                   <!--     <td><?= $row->phone ?></td> -->
                                  <!--      <td><?= $row->mobile ?></td> -->

                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                           <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                          <!--     <td><?= $row->trongate_user_id ?></td> -->
                                <td>                                                                  
                        <div class="btn-group">

                              <a class="btn btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View</a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $row->id ?>/1">Update</a> -->
                          <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?>


                          <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2"><i class="fa fa-undo"></i> Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $row->id ?>/manage"><i class="fa fa-user"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>

                        <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i> Add Email</a> 


                          <?php endif; ?>


                          <?php if($row->deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['ccmpmode'] != 'momm' ): ?> 

                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>
                          <?php endif; ?>

         

<!--
<?php
switch(strlen($row->email_address)) {
case ">0": echo '<a class="btn btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a>' ;
break;
case "<0": echo "You won Physics!";
break;
default: echo "You lost";
break;
}
?> -->
   <!-- Begin Modals -->       

   <div class="modal inmodal" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
                       <div class="modal-dialog">
                       <div class="modal-content animated bounceInRight">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <i class="fa fa-envelope modal-icon"></i>
                                   <h4 class="modal-title">Add Email Address</h4>
                                   <small class="font-bold">Enter your email address and confirm</small>
                               </div> 

                          <center><h3 id="result" ></h3></center>

                            <form action="" method = "post">                                
                               <div class="modal-body"> 
                                   
                               <!-- All these values are passed to the javascript routine in template inspinia.php and then to Ccmps.php controller. Any field changes here must be made in inspinia or wont pass  -->
                                   <div class="form-group">
                               <!--        <input type="password" class="form-control" name="npass" id="npass" value="<?= $npass ?>" placeholder="New Password" > -->
                                       <input type="email" class="form-control" name="npass" id="nemail" placeholder="Email Address" >
                                   </div>  
                                   <div class="form-group">
                               <!--        <input type="password" class="form-control" name="cpass" id="cpass" value="<?= $cpass ?>" placeholder="Confirm New Password" > -->
                                       <input type="password" class="form-control" name="cpass" id="cemail" placeholder="Confirm Email" >                                     
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

                                    <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="AddID" id="AddBtn" ></input>

                                   <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                               </div>
                           </form>


   <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                       <div class="modal-dialog">
                       <div class="modal-content animated bounceInRight">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <i class="fa fa-key modal-icon"></i>
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



                            </div>
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>
                     
                </div> <!-- end div table responsive-->


  <?php /*

  switch($_SESSION['ccmpmode']) {

   case 'momm':  
        echo('<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp/cachccmp">Create New Chapter Member</a>');

        echo('<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close*</a>');
   break;

   case 'mcmm':  
        echo('<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp/saccmp//mcm">Create New Member*</a>');
        echo('<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close*</a>'); 
   break;   

   case 'mamm':   
        echo('<a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp/saccmp//mam">Create New Member*</a>'); 
        echo('<a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close*</a>'); 
   break;   

//default:
        //include('navbar4.php');

     }  */ ?> 

  <?php if($_SESSION['ccmpmode'] == 'momm'): ?> <!-- mom manage our members - chapter admin-->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp"><i class="fa fa-user"></i> Create New Chapter Member</a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['ccmpmode'] == 'mcmm'): ?>  <!-- mom manage current members - member admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp"><i class="fa fa-user"></i> Create New Member</a>
    <!--    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp/saccmp//mcm"><i class="fa fa-user"></i> Create New Member</a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['ccmpmode'] == 'mamm'): ?>
            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp"><i class="fa fa-user"></i> Create New Member</a>
     <!--   <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmp/saccmp//mam"><i class="fa fa-user"></i> Create New Member</a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php else: ?> 

  <?php endif; ?>

                  <!--  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close</a> -->
            </div> <!-- ibox content table -->
 

        </div> <!-- col 12 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

<!-- End Content   -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){
            //from datatables
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExcelFile'},
                    {extend: 'pdf', title: 'PDFFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
           });
    </script>