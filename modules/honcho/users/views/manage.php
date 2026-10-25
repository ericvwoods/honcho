
<?php 
  include('navbar.php');
?>  
<!-- 
viewxxxx
createxxxx
updatexxxx
manageallxxxx
xxxxrecs
value='xxxx' for name='dbtupd' (database to update) honcho/modalresetpw by way of JS in layoutone.php 
-->
<!-- Begin Content   -->
    
            <div class="row">
                <div class="col-lg-12">
  <div class="ibox-content">               
          
                <div class="row"> 


                       
                        <div class="col-md-1">  
                      
                            <div class="row">
                         
                                <div class="col-md-6"> <!-- for spacing --> 
                                </div>
                               <a href="#" title="">
                                       <br>
<img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
                               </a>
                            </div>
                        <br>
                        </div> <!-- end col -->
                 
                        <div class="col-md-4">
                  
                        
                        <span class="m-r">
                           <h1 style="color:<?= NB_CLR ?>;"><?= $activity ?></h1>
                            <a href="#"><h2 style="color:<?= NB_CLR ?>;"><?= $header ?></h2></a>
                 
                        </span>
                            </div> <!-- end column -->
                               <div class="col-md-4">
                       
                        <ul class="nav navbar-top-links navbar-right">
                 
                            <li>
                                <?php if(strlen($picture) > 0): ?>
                                    <div class="col-md-2">   
                                        <h1 class="logo text-center">
                                            <a href="#" title="bpalogo">
                                            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
                                            </a>
                                        </h1>
                                    </div> <!-- end col -->
                                <?php endif; ?> 
                            </li>
                        <li>
              </ul>   
                            </div> <!-- end column -->
                            <div class="col-md-1">
                                <br> 
                             
                               <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createuser">+ <i class="fa fa-user-o"></i><h3> Add <?= HONCHOUSER ?></h3></a> 
                            </div> <!-- end column -->
                             
                            <div class="col-md-2">
                               <br>  <p> </p>   
                               <a class="btn btn-primary btn-outline" href="<?= BASE_URL ?>honcho/index"><span style="color: <?= NB_CLR ?>; font-size: 24px;"><i class="fa fa-th-list"></i> Dashboard </span></a> 
                            </div> <!-- end column -->
                             
                          
                </div> <!-- end row -->

            </div> <!-- end ibox-title- ln 17 -->
 <br> <!-- Gap between header and 1st Collapse Contact Information  -->            
    <?php if($_SESSION['sysadmin'] == 1 || $_SESSION['useradmin'] == 1): ?> <!-- No mcmm which is student members is the elseif on line 1065  -->

            <div class="ibox-content">

 
                    <div class="tabs-container">
                      
                        <ul class="nav nav-tabs" role="tablist">
                            
                            <li><a class="nav-link active"  href="#tab-1"><h3>All <?= HONCHOUSER ?> Records</h3></a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-5"></a></li> 

                        </ul>
                  

                       
                        <div class="tab-content">

                           <div role="tabpanel" id="tab-1" class="tab-panel">
                                <div class="panel-body">
                                <!--    <div class="ibox-content"> -->
                                  
                               <!--     <strong>All User Accounts</strong> -->
                         
    <!--    <form  method = "post" action="<?= BASE_URL ?>honcho-users/bulkaction/">  -->                              
    
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                        <tr>
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Rec Id<h/<?= $_SESSION['tfontsize'] ?>></th> 
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Name<h/<?= $_SESSION['tfontsize'] ?>></th>  
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Email<h/<?= $_SESSION['tfontsize'] ?>></th> 
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Mobile<h/<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= SUBENTITY ?><h/<?= $_SESSION['tfontsize'] ?>></th>                                        
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= HONCHOUSER ?> Num<h/<?= $_SESSION['tfontsize'] ?>></th>                                 
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Username<h/<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Last Login<h/<?= $_SESSION['tfontsize'] ?>></th>                            
                         <!--   <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Locked?<h/<?= $_SESSION['tfontsize'] ?>></th> --> 
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Flags<h/<?= $_SESSION['tfontsize'] ?>></th>
                            <th style="color:<?= USERS_TBL_HDR_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Manage<h/<?= $_SESSION['tfontsize'] ?>></th>

                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                foreach($usersrecs as $row) { 

                                ?>
<?php if(strlen($row->id) > 0) { ?> <!-- Strip off the view data records from the recordset  -->
                                 
                                <tr class='gradeA'>
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['tfontsize'] ?>></td>  
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></h<?= $_SESSION['tfontsize'] ?>></td> 
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->email_address ?></h<?= $_SESSION['tfontsize'] ?>></td> 
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->mobile ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->subentity ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->id_number ?></h<?= $_SESSION['tfontsize'] ?>></td>                                   
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->username ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->last_login ?></h<?= $_SESSION['tfontsize'] ?>></td>   
                                <!--   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->locked ?></h<?= $_SESSION['tfontsize'] ?>></td> -->  
                                   <td style="color:<?= USERS_TBL_DATA_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= $row->flags ?></h<?= $_SESSION['tfontsize'] ?>></td>   

                                   <td><h<?= $_SESSION['tfontsize'] ?>>

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View </a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1">Update</a> -->
                               <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1""><i class="fa fa-pencil"></i> Update</a>
                          <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>honcho-users/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>honcho-users/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?>

                             <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>  <!-- no email address -->
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                <?php else: ?> <!-- no user acct but can create without email because student  -->
                                       <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                        <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                              <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                  <input type="text" class="form-control" name="recid" id="recid" value="<?= $row->id ?>"  hidden>
                              </div> 

                        <!--     <a class="btn btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> -->

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Add Email Address"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> 

                   <!--     <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Add Email</a> -->


                          <?php endif; ?>

                          <?php if($row->soft_deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record" href="<?= BASE_URL ?>honcho-users/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>honcho-users/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['managemode'] != 'mngsubentity' ): ?> 

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Archive Record" href="<?= BASE_URL ?>honcho-users/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>

                          <?php endif; ?>

                                    </h<?= $_SESSION['tfontsize'] ?>></td>                                                           

                                </tr>
            <?php } ?>                              
                                <?php
                                  
                                 } ?> 

                            </tbody>

                            </table>
                        </div> <!-- Table Responsive -->
                </div> <!--  panel body -->
            </div> <!-- End Tab Panel 1 -->
        </div> <!-- Tab Content for All Tabs  -->
    </div> <!--  tabs container -->
 </div> <!-- ibox content for the tabs container -->
             
 <?php elseif($_SESSION['managemode'] == 'mcmm' ): ?> <!-- Opening IF on line 77  --> 
  
  <!--  <php else: ?> --><!-- All Student Members when in Member Admin Mode-->
  
                 <div class="ibox-content">  
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                          <li><a class="nav-link active" data-toggle="tab" href="#tab-1">All Current Student <?= CCMPS ?> for <?= $_SESSION['system_current_year']?></a></li>
                          <li><a class="nav-link" data-toggle="tab" href="#tab-2">All Student <?= CCMP ?> Records</a></li> 
                        </ul>
                        <div class="tab-content"> <!-- For all tabs in this case mcmm  -->
                            
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="ibox-content">

                    <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                        <div>
                          <strong>All <?= SUBENTITY ?> <?= CCMP ?> Records</strong> 
                           <br>Choose a Record to View/Edit
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mcmm'): ?> 
                        <div>
                            <p><strong>Only Dues Current Student & Q Student <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
                        <div>
                          <strong>All <?= HONCHOUSERS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit
                        </div>                      

                    <?php else: ?> 

                    <?php endif; ?>
                    
                      <span class="loading words"></span>
                      
       <form  method = "post" action="<?= BASE_URL ?>honcho-users/bulkaction/">
           
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" > 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                     <!--   <th>DB Id</th>  -->
                        <th style="color:cornflowerblue;">Name</th> 
                        <th style="color:cornflowerblue;">Email</th>  
                
                      
                         <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                         <?php else: ?> 
                            <th style="color:cornflowerblue;"><?= SUBENTITY ?></th>
                         <?php endif; ?>
                        <th style="color:cornflowerblue;">Location</th>                                           
                        <th style="color:cornflowerblue;"><?= CCMP ?> Number</th> 
                        <th style="color:cornflowerblue;"><?= CCMP ?> Type</th> 
                        <th style="color:cornflowerblue;">Current Year</th>

                    
                   <!--     <th style="color:cornflowerblue;">Current</th>  -->

 
                   <!--     <th style="color:cornflowerblue;">Phone</th> -->
                   <!--     <th style="color:cornflowerblue;">Mobile</th> -->


                 
   <!--  <th>Locked?</th> -->
                     <!--   <th>Updated</th> -->
                         <!--   <th>Acct #</th> -->
                         <!--    <th>ID #</th>  -->
                      <th style="color:cornflowerblue;">
                         Toggle All <input type="checkbox" id="checkAll6">
                       </th>
                      <th style="color:cornflowerblue;">
                          
                        <div class="row">
                              
                                               
                            <div class="col-lg-3 col-form-label">
                            <!--   <h<?= $_SESSION['fontsize'] ?>> --> Checked: <!-- </h<?= $_SESSION['fontsize'] ?>> -->
                                   
     
                            </div>
                            <div class="col-sm-5"> 
                            
                              <select class="form-control m-b" name="selected" > 
                                        <?php foreach($bulk_actions6 as $row) { ?>

                                                <option value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->description ?></h<?= $_SESSION['fontsize'] ?>></option>

                                         <?php } ?>                                     
                                    </select> 
                                
                              </div>
                             <div class="col-sm-3"> 
                              <!--   <h<?= $_SESSION['fontsize'] ?>> --> <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" > <!-- </h<?= $_SESSION['fontsize'] ?>> -->

                             </div>
                         </div>   <!-- row -->
                        </th>


                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($usersrecs as $row) { 

                                ?>
                                <tr class='gradeA'>
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></td> 
                                   <td><?= $row->email_address ?></td> 
   
                                   
                                    <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                                    <?php else: ?> 
                                          <td><?= $row->chapter ?></td>
                                    <?php endif; ?> 
                                    <td> <?= $row->mailcity ?>, <?= $row->mailstate ?> </td>
                                    <td><?= $row->member_no ?></td>
                                     <td><?= $row->member_type ?></td> 
                                      <td><?= $row->current_year ?></td>  
      <td><center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center></td>
                                     


   
                                   <!--     <td><?= $row->phone ?></td> -->
                                  <!--      <td><?= $row->mobile ?></td> -->

                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                           <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                          <!--     <td><?= $row->trongate_user_id ?></td> -->
                           <!--       <td><?= $row->id ?></td> -->
                                <td>                                                                  
                 <!--       <div class="btn-group"> -->

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View</a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1">Update</a> -->
                               <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1""><i class="fa fa-pencil"></i> Update</a>
                      <!--    <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>honcho-users/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>honcho-users/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?> -->

                             <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                <?php else: ?> <!-- no user acct but can create without email because student  -->
                                       <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                        <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                              <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                  <input type="text" class="form-control" name="recid" id="recid" value="<?= $row->id ?>"  hidden>
                              </div> 

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Add Email Address"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> 

                   <!--     <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Add Email</a> -->


                          <?php endif; ?>

                          <?php if($row->soft_deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record" href="<?= BASE_URL ?>honcho-users/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>honcho-users/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['managemode'] != 'mngsubentity' ): ?> 

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Archive Record" href="<?= BASE_URL ?>honcho-users/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>

                          <?php endif; ?>

   <!--   </div>  --><!-- button group  -->
<!-- Modal was here  -->
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>

   <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> <!-- mom manage our members - chapter admin-->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= SUBENTITY ?> <?= CCMP ?></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['managemode'] == 'mcmm'): ?>  <!-- mom manage current members - member admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
    <!--    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mcm"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
     <!--   <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mam"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php else: ?> 

  <?php endif; ?>                    
                </div> <!-- end div table responsive-->
                
                
  </form>
                    </div> <!-- ibox content -->
                </div> <!--  panel body -->

            </div> <!-- End Tab Panel 1 -->        

                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="ibox-content">

               <!--     <php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                        <div>
                          <strong>All <?= SUBENTITY ?> <?= CCMP ?> Records</strong> 
                           <br>Choose a Record to View/Edit
                        </div>

                    <php elseif($_SESSION['managemode'] == 'mcmm'): ?> -->
                        <div>
                            <p><strong>All Student & Q Student <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

               <!--     <php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
                        <div>
                          <strong>All <?= HONCHOUSERS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit
                        </div>                      

                    <php else: ?> 

                    <php endif; ?> -->
                    
                      <span class="loading words"></span>
                      
       <form  method = "post" action="<?= BASE_URL ?>honcho-users/bulkaction/">
           
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" > 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                     <!--   <th>DB Id</th>  -->
                        <th style="color:cornflowerblue;">Name</th> 
                        <th style="color:cornflowerblue;">Email</th>  
                
                      
                         <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                         <?php else: ?> 
                            <th style="color:cornflowerblue;"><?= SUBENTITY ?></th>
                         <?php endif; ?>
                        <th style="color:cornflowerblue;">Location</th>                                           
                        <th style="color:cornflowerblue;"><?= CCMP ?> Number</th> 
                        <th style="color:cornflowerblue;"><?= CCMP ?> Type</th> 
                        <th style="color:cornflowerblue;">Current Year</th>

                    
                   <!--     <th style="color:cornflowerblue;">Current</th>  -->

 
                   <!--     <th style="color:cornflowerblue;">Phone</th> -->
                   <!--     <th style="color:cornflowerblue;">Mobile</th> -->


                 
   <!--  <th>Locked?</th> -->
                     <!--   <th>Updated</th> -->
                         <!--   <th>Acct #</th> -->
                         <!--    <th>ID #</th>  -->
                      <th style="color:cornflowerblue;">
                         Toggle All <input type="checkbox" id="checkAll6">
                       </th>
                      <th style="color:cornflowerblue;">
                          
                        <div class="row">
                              
                                               
                            <div class="col-lg-3 col-form-label">
                            <!--   <h<?= $_SESSION['fontsize'] ?>> --> Checked: <!-- </h<?= $_SESSION['fontsize'] ?>> -->
                                   
     
                            </div>
                            <div class="col-sm-5"> 
                            
                              <select class="form-control m-b" name="selected" > 
                                        <?php foreach($bulk_actions6 as $row) { ?>

                                                <option value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->description ?></h<?= $_SESSION['fontsize'] ?>></option>

                                         <?php } ?>                                     
                                    </select> 
                                
                              </div>
                             <div class="col-sm-3"> 
                              <!--   <h<?= $_SESSION['fontsize'] ?>> --> <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" > <!-- </h<?= $_SESSION['fontsize'] ?>> -->

                             </div>
                         </div>   <!-- row -->
                        </th>


                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($data5 as $row) { // $data5 - All Student members query when in mcmm mode

                                ?>
                                <tr class='gradeA'>
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></td> 
                                   <td><?= $row->email_address ?></td> 
   
                                   
                                    <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                                    <?php else: ?> 
                                          <td><?= $row->chapter ?></td>
                                    <?php endif; ?> 
                                    <td> <?= $row->mailcity ?>, <?= $row->mailstate ?> </td>
                                    <td><?= $row->member_no ?></td>
                                     <td><?= $row->member_type ?></td> 
                                      <td><?= $row->current_year ?></td>  
      <td><center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center></td>
                                     


   
                                   <!--     <td><?= $row->phone ?></td> -->
                                  <!--      <td><?= $row->mobile ?></td> -->

                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                           <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                          <!--     <td><?= $row->trongate_user_id ?></td> -->
                           <!--       <td><?= $row->id ?></td> -->
                                <td>                                                                  
                 <!--       <div class="btn-group"> -->

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="View Record"  href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View</a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1">Update</a> -->
                               <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1""><i class="fa fa-pencil"></i> Update</a>
                      <!--    <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>honcho-users/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>honcho-users/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?> -->

                             <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                <?php else: ?> <!-- no user acct but can create without email because student  -->
                                       <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                        <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                              <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                  <input type="text" class="form-control" name="recid" id="recid" value="<?= $row->id ?>"  hidden>
                              </div> 

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Add Email Address"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> 

                   <!--     <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Add Email</a> -->


                          <?php endif; ?>

                          <?php if($row->soft_deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record" href="<?= BASE_URL ?>honcho-users/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>honcho-users/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['managemode'] != 'mngsubentity' ): ?> 

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Archive Record" href="<?= BASE_URL ?>honcho-users/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>

                          <?php endif; ?>

   <!--   </div>  --><!-- button group  -->
<!-- Modal was here  -->
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>

   <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> <!-- mom manage our members - chapter admin-->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= SUBENTITY ?> <?= CCMP ?></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['managemode'] == 'mcmm'): ?>  <!-- mom manage current members - member admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
    <!--    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mcm"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
     <!--   <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mam"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php else: ?> 

  <?php endif; ?>                    
                </div> <!-- end div table responsive-->
                
                
  </form>
                    </div> <!-- ibox content -->
                </div> <!--  panel body -->

            </div> <!-- End Tab Panel 2 -->             
            
                
    <?php elseif($_SESSION['managemode'] == 'mosm' ): ?> <!-- Manage our chapter student members   -->
                 <div class="ibox-content">  
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                          <li><a class="nav-link active" data-toggle="tab" href="#tab-1">All Current <?= SUBENTITY ?> Student <?= CCMPS ?> for <?= $_SESSION['system_current_year']?></a></li>
                          <li><a class="nav-link" data-toggle="tab" href="#tab-2">All <?= SUBENTITY ?> Student <?= CCMP ?> Records</a></li> 
                        </ul>
                        <div class="tab-content"> <!-- For all tabs in this case mosm  -->
                            
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="ibox-content">
<!-- Should be only one case now -->                                  
                    <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                        <div>
                          <strong>All <?= SUBENTITY ?> <?= CCMP ?> Records</strong> 
                           <br>Choose a Record to View/Edit
                        </div>


                    <?php elseif($_SESSION['managemode'] == 'mosm'): ?> 
                        <div>
                            <p><strong>Only Dues Current <?= SUBENTITY ?> Student & Q Student <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mcmm'): ?> 
                        <div>
                            <p><strong>Only Dues Current Student & Q Student <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
                        <div>
                          <strong>All <?= HONCHOUSERS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit
                        </div>                      

                    <?php else: ?> 

                    <?php endif; ?>
                    
                      <span class="loading words"></span>
                      
       <form  method = "post" action="<?= BASE_URL ?>honcho-users/bulkaction/">
           
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" > 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                     <!--   <th>DB Id</th>  -->
                        <th style="color:cornflowerblue;">Name</th> 
                        <th style="color:cornflowerblue;">Email</th>
                        <th style="color:cornflowerblue;">Username</th>  
                
                      
                         <?php if($_SESSION['managemode'] == 'mosm'): ?> 
                         <?php else: ?> 
                            <th style="color:cornflowerblue;"><?= SUBENTITY ?></th>
                         <?php endif; ?>
                        <th style="color:cornflowerblue;">Location</th>                                           
                        <th style="color:cornflowerblue;"><?= CCMP ?> Number</th> 
                        <th style="color:cornflowerblue;"><?= CCMP ?> Type</th> 
                        <th style="color:cornflowerblue;">Current Year</th>

                    
                   <!--     <th style="color:cornflowerblue;">Current</th>  -->

 
                   <!--     <th style="color:cornflowerblue;">Phone</th> -->
                   <!--     <th style="color:cornflowerblue;">Mobile</th> -->


                 
   <!--  <th>Locked?</th> -->
                     <!--   <th>Updated</th> -->
                         <!--   <th>Acct #</th> -->
                         <!--    <th>ID #</th>  -->
                      <th style="color:cornflowerblue;">
                         Toggle All <input type="checkbox" id="checkAll7">
                       </th>
                      <th style="color:cornflowerblue;">
                          
                        <div class="row">
                              
                                               
                            <div class="col-lg-3 col-form-label">
                            <!--   <h<?= $_SESSION['fontsize'] ?>> --> Checked: <!-- </h<?= $_SESSION['fontsize'] ?>> -->
                                   
     
                            </div>
                            <div class="col-sm-5"> 
                            
                              <select class="form-control m-b" name="selected" > 
                                        <?php foreach($bulk_actions6 as $row) { ?>

                                                <option value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->description ?></h<?= $_SESSION['fontsize'] ?>></option>

                                         <?php } ?>                                     
                                    </select> 
                                
                              </div>
                             <div class="col-sm-3"> 
                              <!--   <h<?= $_SESSION['fontsize'] ?>> --> <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" > <!-- </h<?= $_SESSION['fontsize'] ?>> -->

                             </div>
                         </div>   <!-- row -->
                        </th>


                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($usersrecs as $row) { 

                                ?>
                                <tr class='gradeA'>
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></td> 
                                    <td><?= $row->email_address ?></td> 
                                    <td><?= $row->username ?></td> 
                                   
                                    <?php if($_SESSION['managemode'] == 'mosm'): ?> 
                                    <?php else: ?> 
                                          <td><?= $row->chapter ?></td>
                                    <?php endif; ?> 
                                    <td> <?= $row->mailcity ?>, <?= $row->mailstate ?> </td>
                                    <td><?= $row->member_no ?></td>
                                     <td><?= $row->member_type ?></td> 
                                      <td><?= $row->current_year ?></td>  
      <td><center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center></td>
                                     


   
                                   <!--     <td><?= $row->phone ?></td> -->
                                  <!--      <td><?= $row->mobile ?></td> -->

                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                           <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                          <!--     <td><?= $row->trongate_user_id ?></td> -->
                           <!--       <td><?= $row->id ?></td> -->
                                <td>                                                                  
                 <!--       <div class="btn-group"> -->

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="View Record"  href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View</a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1">Update</a> -->
                               <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1""><i class="fa fa-pencil"></i> Update</a>
                      <!--    <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>honcho-users/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>honcho-users/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?> -->

                             <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                <?php else: ?> <!-- no user acct but can create without email because student  -->
                                       <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                        <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                              <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                  <input type="text" class="form-control" name="recid" id="recid" value="<?= $row->id ?>"  hidden>
                              </div> 

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Add Email Address"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> 

                   <!--     <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Add Email</a> -->


                          <?php endif; ?>

                          <?php if($row->soft_deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record" href="<?= BASE_URL ?>honcho-users/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>honcho-users/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['managemode'] != 'mngsubentity'  AND $_SESSION['managemode'] != 'mosm' ): ?> 

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Archive Record" href="<?= BASE_URL ?>honcho-users/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>

                          <?php endif; ?>

   <!--   </div>  --><!-- button group  -->
<!-- Modal was here  -->
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>

   <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> <!-- mom manage our members - chapter admin-->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= SUBENTITY ?> <?= CCMP ?></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> aClose</a> 
  <?php elseif($_SESSION['managemode'] == 'mcmm'): ?>  <!-- mom manage current members - member admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
    <!--    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mcm"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> bClose</a> 
  <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
     <!--   <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mam"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> cClose</a> 
  <?php else: ?> 

  <?php endif; ?>                    
 </div> <!-- end div table for current mosm responsive-->
 </form>
                    </div> <!-- ibox content -->
                </div> <!--  panel body -->

            </div> <!-- End Tab Panel 1 -->               

                                       
                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="ibox-content">
<!-- Should be only one case now -->                                  
                    <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> 
                        <div>
                          <strong>All <?= SUBENTITY ?> <?= CCMP ?> Records</strong> 
                           <br>Choose a Record to View/Edit
                        </div>


                    <?php elseif($_SESSION['managemode'] == 'mosm'): ?> 
                        <div>
                            <p><strong>All Student & Q Student <?= SUBENTITY ?> <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mcmm'): ?> 
                        <div>
                            <p><strong>Only Dues Current Student & Q Student <?= CCMPS ?></strong></p>
                         
                          <p>Choose a Record to View/Edit</p>
                        </div>

                    <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
                        <div>
                          <strong>All <?= HONCHOUSERS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit
                        </div>                      

                    <?php else: ?> 

                    <?php endif; ?>
                    
                      <span class="loading words"></span>
                      
       <form  method = "post" action="<?= BASE_URL ?>honcho-users/bulkaction/">
           
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example"> 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                     <!--   <th>DB Id</th>  -->
                     
                  
                    
                        <th style="color:cornflowerblue;">Name</th>
                        <th style="color:cornflowerblue;">Email</th>
                        <th style="color:cornflowerblue;">Username</th>  
                
                      
                         <?php if($_SESSION['managemode'] == 'mosm'): ?> 
                         <?php else: ?> 
                            <th style="color:cornflowerblue;"><?= SUBENTITY ?></th>
                         <?php endif; ?>
                        <th style="color:cornflowerblue;">Location</th>                                           
                        <th style="color:cornflowerblue;"><?= CCMP ?> Number</th> 
                        <th style="color:cornflowerblue;"><?= CCMP ?> Type</th> 
                        <th style="color:cornflowerblue;">Current Year</th>

                   
                   <!--     <th style="color:cornflowerblue;">Current</th>  -->

 
                   <!--     <th style="color:cornflowerblue;">Phone</th> -->
                   <!--     <th style="color:cornflowerblue;">Mobile</th> -->


                 
   <!--  <th>Locked?</th> -->
                     <!--   <th>Updated</th> -->
                         <!--   <th>Acct #</th> -->
                         <!--    <th>ID #</th>  -->
                      <th style="color:cornflowerblue;">
                         Toggle All <input type="checkbox" id="checkAll8">
                       </th>
                      <th style="color:cornflowerblue;">
                          
                        <div class="row">
                              
                                               
                            <div class="col-lg-3 col-form-label">
                            <!--   <h<?= $_SESSION['fontsize'] ?>> --> Checked: <!-- </h<?= $_SESSION['fontsize'] ?>> -->
                                   
     
                            </div>
                            <div class="col-sm-5"> 
                            
                              <select class="form-control m-b" name="selected" > 
                                        <?php foreach($bulk_actions6 as $row) { ?>

                                                <option value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->description ?></h<?= $_SESSION['fontsize'] ?>></option>

                                         <?php } ?>                                     
                                    </select> 
                                
                              </div>
                             <div class="col-sm-3"> 
                              <!--   <h<?= $_SESSION['fontsize'] ?>> --> <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" > <!-- </h<?= $_SESSION['fontsize'] ?>> -->

                             </div>
                         </div>   <!-- row -->
                        </th>


                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($data5 as $row) { 

                                ?>
                                <tr class='gradeA'>
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->first_name ?> <?= $row->middle_name ?></td> 
                                    <td><?= $row->email_address ?></td>
                                    <td><?= $row->username ?></td>
                                   
                                    <?php if($_SESSION['managemode'] == 'mosm'): ?> 
                                    <?php else: ?> 
                                          <td><?= $row->chapter ?></td>
                                    <?php endif; ?> 
                                    <td> <?= $row->mailcity ?>, <?= $row->mailstate ?> </td>
                                    <td><?= $row->member_no ?></td>
                                     <td><?= $row->member_type ?></td> 
                                      <td><?= $row->current_year ?></td>  
      <td><center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center></td>
                                     


   
                                   <!--     <td><?= $row->phone ?></td> -->
                                  <!--      <td><?= $row->mobile ?></td> -->

                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                           <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                          <!--     <td><?= $row->trongate_user_id ?></td> -->
                              <!--    <td><?= $row->id ?></td> -->
                                <td>                                                                  
                 <!--       <div class="btn-group"> -->

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="View Record"  href="<?= BASE_URL ?>honcho-users/viewuser/<?= $row->id ?>/1" ><i class="fa fa-eye"></i> View</a> <!-- The 1 sets the $_SESSION tab default  -->         
 <!-- must specify tab to update & dont know at this point <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1">Update</a> -->
                               <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1"><i class="fa fa-pencil"></i> Update</a>
                          <?php if($row->locked > 0): ?> 
                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>honcho-users/unlockacct/<?= $row->id ?>"><i class="fa fa-unlock-alt"></i> Unlock</a>
                          <?php else: ?>                                
                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>honcho-users/lockacct/<?= $row->id ?>"><i class="fa fa-lock"></i> Lock</a>
                          <?php endif; ?>

                             <?php if(strlen($row->email_address) > 0): ?> 
                                <?php if(strlen($row->trongate_user_id > 0)): ?>  
                                    <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> 2054Reset PW</a> 
                                <?php else: ?>

                                      <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>

                                <?php endif; ?>

                          <?php else: ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->username > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                <?php else: ?> <!-- no user acct but can create without email because student  -->
                                       <a class="btn btn-outline btn-primary"  type="button"  data-toggle="tooltip" data-placement="right" title="Create User Account" href="<?= BASE_URL ?>honcho-users/createuseraccount/<?= $row->id ?>/manage"><i class="fa fa-key"></i> Create Acct</a>
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                            <?php if($row->member_type == 'S' || $row->member_type == 'Q'): ?> <!-- if they are a type of student member may not have an email address  -->                                           
                                                <?php if(strlen($row->trongate_user_id > 0)): ?>  <!-- if have an tg_user_id - show reset button they must have an account  -->
                                                        <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2" data-toggle="tooltip" data-placement="right" title="Reset Password"><i class="fa fa-undo"></i> Reset PW</a> 
                                                <?php endif; ?>                          
                                            <?php endif; ?>
                                                        
                              <div class="form-group"> <!-- Used to pass the recid to ajax function  -->
                                  <input type="text" class="form-control" name="recid" id="recid" value="<?= $row->id ?>"  hidden>
                              </div> 

                              <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Add Email Address"  href="<?= BASE_URL ?>honcho-users/updateuser/<?= $row->id ?>/1" ><i class="fa fa-envelope"></i> Add Email</a> 

                   <!--     <a class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope"></i> Add Email</a> -->


                          <?php endif; ?>

                          <?php if($row->soft_deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record" href="<?= BASE_URL ?>honcho-users/undelrecord/<?= $row->id ?>/m"><i class="fa fa-undo"></i> Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record" href="<?= BASE_URL ?>honcho-users/delrecord/<?= $row->id ?>/m"><i class="fa fa-trash"></i> Delete</a>

                          <?php endif; ?>


                          <?php if($_SESSION['national_officer'] == 4 AND $_SESSION['managemode'] != 'mngsubentity'): ?> 

                                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Archive Record" href="<?= BASE_URL ?>honcho-users/archiverecord/<?= $row->id ?>/m"><i class="fa fa-archive"></i> Archive</a>

                          <?php endif; ?>

   <!--   </div>  --><!-- button group  -->
<!-- Modal was here  -->
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>

   <?php if($_SESSION['managemode'] == 'mngsubentity'): ?> <!-- mom manage our members - chapter admin-->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= SUBENTITY ?> <?= CCMP ?></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> dClose</a> 
  <?php elseif($_SESSION['managemode'] == 'mcmm'): ?>  <!-- mom manage current members - member admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
    <!--    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mcm"><i class="fa fa-user"></i> Create New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> eClose</a> 
  <?php elseif($_SESSION['managemode'] == 'mngallusers'): ?>
            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp"><i class="fa fa-user"></i> Create New <?= CCMP ?></a>
     <!--   <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mam"><i class="fa fa-user"></i> fCreate New <?= CCMP ?></a> -->
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome"><i class="fa fa-times-circle"></i> Close</a> 
  <?php else: ?> 

  <?php endif; ?>                    
 </div> <!-- end div table for current mosm responsive-->
 </form>
                    </div> <!-- ibox content -->
                </div> <!--  panel body -->

            </div> <!-- End Tab Panel 2 -->    
                
                
    <?php endif; ?> <!-- Ends last case mosm chapter student members  -->
                
                
   <!-- Begin Modals -->       
  <!-- Begin Modal 1 -->                
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <i class="fa fa-envelope modal-icon"></i>
                <h4 class="modal-title">Add/Change Email Address</h4>
                <h3 class="font-bold">Enter a new email address and confirm it please</h3>
            </div> 
        <!-- Show flash message then reset it to blank  -->
   <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
        $flash_msg = '';
        set_btn($flash_msg); ?> no way to refresh modal to see the message -->
       <center><h3 id="result" ></h3></center>

         <form action="" method = "post">                                
            <div class="modal-body">
                                   
                <div class="form-group">
                    <input type="text" class="form-control" name="nemail" id="nemail" value="<?= $nemail ?>" placeholder="New Email" >
                </div>  
                <div class="form-group">
                    <input type="text" class="form-control" name="cemail" id="cemail" value="<?= $cemail ?>" placeholder="Confirm New Email" >
                </div>
                <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  -->
                    <input type="text" class="form-control" name="rpwl" id="rpwl" value="<?= MINPWLGTH ?>"  hidden>
                </div> 
<div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw by way of JS in layoutone.php -->
                    <input type="text" class="form-control" name="dbtupd" id="dbtupd" value="users" hidden>
                </div>

            </div>
            <div class="modal-footer">

<input type="button" value="Submit"class="btn btn-primary block full-width m-b" name="AddemailID" id="AddemailBtn" ></input>

                  <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
              </div>
          </form>

        </div> 
      </div>
    </div>
</div>

   <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                       <div class="modal-dialog">
                       <div class="modal-content animated bounceInRight">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <i class="fa fa-key modal-icon"></i>
                               <!--    <h4 class="modal-title">Reset Password recid <?= $_SESSION['honcho_acct_rec_id'] ?> line1262</h4> -->
                                   <h4 class="modal-title">Reset Password</h4>

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
                                       <input type="password" class="form-control"  id="cpass2" placeholder="Confirm New Password" >                   
                                   </div>
                                   <div class="form-group"> <!-- Used to pass the minimum pw length to ajax function  -->
                                       <input type="text" class="form-control"  id="rpwl2" value="<?= MINPWLGTH ?>" hidden>
                                   </div>

                                   <div class="form-group"> <!-- Used to post the DB to update to honcho/modalresetpw  by way of JS in layoutone.php -->
                                       <input type="text" class="form-control" id="dbtupd2" value="users" hidden>
                                   </div>

                                  <div class="form-group"> <!-- Used to pass the recid to ajax function -  data passed to page not available to a modal form. Use $_SESSION variable -->
                                       <input type="text" class="form-control"  id="id2" value="<?= $_SESSION['honcho_acct_rec_id'] ?>"  hidden>
                                   </div> 

                               </div>
                               <div class="modal-footer">

                  <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="PwResetBtn" id="PwResetBtn" ></input>

                                   <button type="button" class="btn btn-whiteblock full-width m-b" data-dismiss="modal">Cancel</button>
                               </div>
                           </form>
                   

                <!--    <a class="btn btn-danger btn-outline demo4" href="<= BASE_URL ?>honcho/index/system_accounts/del/<?= $id ?>/v" type="button" >Delete</a> -->
           </div>
  <!-- End Modal 2 -->

  <!-- End Modals -->   


  <?php /*

  switch($_SESSION['managemode']) {

   case 'mngsubentity':  
        echo('<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/cachccmp">Create New <?= SUBENTITY ?> <?= CCMP ?></a>');

        echo('<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome">Close*</a>');
   break;

   case 'mcmm':  
        echo('<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mcm">Create New <?= CCMP ?>*</a>');
        echo('<a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome">Close*</a>'); 
   break;   

   case 'mngallusers':   
        echo('<a class="btn btn-rounded btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>honcho-users/createccmp/saccmp//mam">Create New <?= CCMP ?>*</a>'); 
        echo('<a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome">Close*</a>'); 
   break;   

//default:
        //include('navbar4.php');

     }  */ ?> 



                  <!--  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>honcho-users/ccmphome">Close</a> -->
            </div> <!-- ibox content table -->
 

        </div> <!-- col 12 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

<!-- End Content   -->


    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script> 
    
 <!--   <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
 <script   src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
  <script   src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> -->
 
        <script type="text/javascript">
        $(document).ready(function(){
            
            // Reset password modal - Reset Password button calls MyModal2 which calls this which posts values from form to honcho/modalresetpw
            $("#PwResetBtn").click(function(){ // keyed off name=PwResetBtn, not the id

          //   alert('Fired');  
                var req_pw_length    = $("#rpwl2").val();
                var new_password     = $("#npass2").val();
                var confirm_password = $("#cpass2").val();
                var db_to_update     = $("#dbtupd2").val();
                var sarecid          = $("#id2").val();
//alert(sarecid);
                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //    alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+'All fields are required: inspinia template line 260');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else
//alert(sarecid);
                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else
     // alert('run ajax');  
                    $.ajax({
                        
                        url:'<?= BASE_URL ?>honcho-users/modalresetpw',
                        type: 'post',
                        data: {npass:new_password,cpass:confirm_password,recid:sarecid,dbtupd:db_to_update}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#npass2").val("");
                                $("#cpass2").val("");
                                $("#dbtupd2").val("");
                                $("#myModal2").modal("hide");
                            }, 3000);                       

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);

              }

                } // 1st else above
            });


            $("#checkAll").click(function(){     
   //       var checkall = document.getElementById("checkAll").value;
    //      alert(checkall);
                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll2").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll3").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });            
 
             $("#checkAll4").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
            
 
             $("#checkAll5").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });

             $("#checkAll6").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });

             $("#checkAll7").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });

             $("#checkAll8").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });            
            //from datatables
               $('.dataTables-example').DataTable({
          //  $('.dataTables-example').removeAttr('width').DataTable({
                // keep the buttons from wrapping until you get to 7 but disables sort
              //  fixedColumns:   {
             //       left: 0,
             //       right: 1
             //   } 
                
      //                 columnDefs: [
      //      { width: 450, targets: 8 }
      //              ],
     //               fixedColumns: true,
        
                pageLength: 1000,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                fastrender: true,
                buttons: [
                    {extend: 'copy'},
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
            /*        columnDefs:[{
                           targets:5,
                        checkboxes: {
                         selectRow:true
                        }
                    }
                ] */


            });
           });
    </script>
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