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
<!--    <div class="ibox-content"> -->
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">                   
                          
                        <div>
                            <h2>Manage Member Records</h2>
                        </div>

                        <div class="ibox-tools">
                       <!--     <a class="btn btn-rounded" href="<?= BASE_URL ?>dashboards/index/gsclasses/create/<?= $row->id ?>/m">Create</a> -->
                    <!--    <a class="btn btn-success btn-rounded btn-outline btn-bitbucket" href="<?= BASE_URL ?>honcho/index/system_accounts/create//m">
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
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Member Records</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Global Search</a></li>
                        </ul>
                        <div class="tab-content">

                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="ibox-content">
                                                            
                                    <strong>All Member Records</strong> <br>Choose a Record to View or Edit
                                    <br>

                                 
                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 
                                   <br>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                        <th>Num</th>
                        <th>Prefix</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Suffix</th>
                   <!--     <th>Chapter</th> -->
                        <th>Type</th>
                        <th>Current</th>

                        <th>Email</th> 
                        <th>Phone</th> 
                        <th>Mobile</th>

                 <!--       <th>Last Login</th> -->


                  <!--      <th>Locked</th> -->

                        <th>Updated</th>
                          <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                                foreach($rows as $row) { 

                                ?>
                                <tr class='gradeA'>
                            <!--        <td><?= $row->id ?></td> 
                                    <td><?= $row->trongate_user_id ?></td>   -->                            
                                    <td><?= $row->member_no ?></td>
                                    <td><?= $row->salutation ?></td>
                                    <td><?= $row->first_name ?></td>
                                    <td><?= $row->middle_name ?></td>
                                    <td><?= $row->last_name ?></td>
                                    <td><?= $row->suffix ?></td>
                             <!--       <td><?= $row->chapter ?></td> -->
                                    <td><?= $row->member_type ?></td>   
                                    <td><?= $row->current_year ?></td>                                                                         

                                   <td><?= $row->email_address ?></td> 
                                    <td><?= $row->phone ?></td>
                                    <td><?= $row->mobile ?></td> 

                           <!--         <td><?= $row->last_login ?></td> -->



                            <!--        <td><?= $row->locked ?></td> -->

                                    <td><?= $row->updated_at ?></td>
                                    <td>                                                                  
                            <div class="btn-group">
                                <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho/index/ccmps/view/<?= $row->id ?>/m" >View</a>
                                <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho/index/ccmps/create/<?= $row->id ?>/m">Update</a>
                                <a class="btn btn-rounded btn-outline btn-danger"  type="button" onClick="return confirm('This member will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/ccmps/del/<?= $row->id ?>/m">Delete</a>
                            </div>
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
               <!--        <th>Tbl Id</th> 
                        <th>User Id</th> -->
                        <th>Num</th>
                        <th>Prefix</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Suffix</th>
                 <!--       <th>Chapter</th> -->
                        <th>Type</th>
                        <th>Current</th>

                        <th>Email</th> 
                        <th>Phone</th> 

                <!--        <th>Last Login</th> -->



                 <!--       <th>Locked</th>  -->

                        <th>Updated</th>
                          <th>Actions</th>
                    </tr>
                    </tfoot>
                    </table>

                                    </div> 
                                </div> <!-- ibox content -->
                            </div> <!--  panel body -->
                            </div> <!-- End Tab Panel -->

                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="ibox-content">
                                  
                                    <strong>Global Search</strong> <br>All Database Fields
                                    <br>
                                    <br>
                                 

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>

                                                    <th>Tbl </th>


                                            <!--        <th>Code</th> -->


                                                    <th>Username</th>


                                                    <th>Access Level</th>

                                                    <th>Prefix</th>

                                                    <th>First</th>


                                                    <th>Middle</th>


                                                    <th>Last</th>


                                                    <th>Suffix</th>


                                                    <th>Chapter</th>
                                                    <th>Chapter Officer</th>
                                                    <th>Region</th>

                                                    <th>Email</th>


                                                    <th>Phone</th>


                                                    <th>Department</th>


                                                    <th>Notes</th>


                                                    <th>picture</th>




                                                <th>Mail Addr1</th>



                                                <th>Mail Addr2</th>



                                                <th>Mail City</th>



                                                <th>Mail State</th>



                                                <th>Mail Zip</th>



                                                <th>Phy Addr1</th>



                                                <th>Phy Addr2</th>



                                                <th>Phy City</th>



                                                <th>Phy State</th>



                                                <th>Phy Zip</th>



                                                <th>Mail=Phys</th>



                                                <th>VIP</th>



                                                <th>Student</th>



                                                <th>Private</th>



                                                <th>Commercial</th>



                                                <th>ATP</th>



                                                <th>Drone</th>



                                                <th>Other Crew</th>



                                                <th>Other Cert #</th>



                                                <th>A&P</th>



                                                <th>A&P #</th>



                                                <th>IA</th>



                                                <th>Military A&P</th>



                                                <th>Manintenance</th>



                                                <th>ATC</th>



                                                <th>Dispatcher</th>



                                                <th>Other Cert</th>



                                                <th>Other Cert #</th>



                                                <th>SE Land</th>



                                                <th>ME Land</th>



                                                <th>SE Sea</th>



                                                <th>ME Sea</th>



                                                <th>Instrument</th>



                                                <th>CFI</th>



                                                <th>CFII</th>



                                                <th>MEI</th>



                                                <th>DPE</th>



                                                <th>BGI</th>



                                                <th>AGI</th>



                                                <th>Rotocraft</th>



                                                <th>Glider</th>



                                                <th>Balloon</th>



                                                <th>Airship</th>



                                                <th>Cred Notes</th>

                

                                             <!--       <th>No Logins</th>


                                                    <th>Last Login</th>


                                                    <th>Last Logout</th>


                                                    <th>Token Exp</th>



                                                    <th>TG User Id</th>

                                                                                      

                                                    <th>User Token</th>



                                                    <th>Inactive</th>


                                                    <th>Locked</th>


                                                    <th>Confirmed</th>
                                                                                                                                    

                                                    <th>Verified</th>



                                                    <th>Approved</th>

                                                                                  

                                                    <th>Reset Code</th>


                                                    <th>Force PW Chg</th>


                                                    <th>Timed Reset</th>


                                                    <th>Reset Interval</th>

                                                                                                  

                                                    <th>IP Address</th>


                                                    <th>Homepage</th> -->


                                                <th>$Acct Type</th>



                                                <th>$Acct Bal</th>



                                                <th>$Acct Inactive</th>



                                                <th>$Acct Status</th>



                                                <th>Bill Email</th>



                                                <th>Bill Name</th>



                                                <th>Bill Phone</th>



                                                <th>Bill Addr1</th>



                                                <th>Bill Addr2</th>



                                                <th>Bill City</th>



                                                <th>Bill State</th>



                                                <th>Bill Zip</th>



                                                <th>Ship Name</th>



                                                <th>Ship Phone</th>



                                                <th>Ship Addr1</th>



                                                <th>Ship Addr2</th>



                                                <th>Ship City</th>



                                                <th>Ship State</th>



                                                <th>Ship Zip</th>



                                                <th>Bill=Ship</th>



                                                <th>Fin Notes</th>



                                                <th>Created By</th>


                                                <th>Created At</th>



                                                <th>Updated By</th>



                                                <th>Updated At</th>


                                            <!--      <th>Actions</th>  -->
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                                foreach($rows as $row) { 

                                ?>
                              
                                                    <td><?= $row->id ?></td>

                                        
                                            <!--        <td><= $row->code ?></td> -->
                                      
                                         
                                                    <td><?= $row->username ?></td>

                                                    <td><?= $row->tguserlevelname ?></td>
                          
                                                    <td><?= $row->salutation ?></td>
                                   
                                                    <td><?= $row->first_name ?></td>
                          
                                                    <td><?= $row->middle_name ?></td>
                                                            
                                    
                                                    <td><?= $row->last_name ?></td>
                                                        
                                        
                                                    <td><?= $row->suffix ?></td>
                                     
                                      
                                                    <td><?= $row->chapter ?></td>

                                                    <td><?= $row->chapter_role ?></td>

                                                    <td><?= $row->region ?></td>
                          
                                                    <td><?= $row->email_address ?></td>
                                                         
                                  
                                                    <td><?= $row->phone ?></td>
                 
                                                    <td><?= $row->department ?></td>
     
                                                    <td><?= $row->notes ?></td>
                       
             
                                                    <td><?= $row->picture ?></td>
                      

  
                                                    <td><?= $row->mailaddress1 ?></td>
                 
                                                    <td><?= $row->mailaddress2 ?></td>
                          

                          
                                                    <td><?= $row->mailcity ?></td>
                                
  
                                                    <td><?= $row->mailstate ?></td>
                          

                                                    <td><?= $row->mailzip ?></td>
                              


                              
                                                    <td><?= $row->physaddress1 ?></td>
                            

                                     
                                                    <td><?= $row->physaddress2 ?></td>
                                   

                                  
                                                    <td><?= $row->physcity ?></td>
                                    
   
                                                    <td><?= $row->physstate ?></td>
                                  

                                                    <td><?= $row->physzip ?></td>
                               


                                                        <?php if($row->mail_phys == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->vip == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->student == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->private == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>



                                                        <?php if($row->commercial == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->atp == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->drone == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>

  
                                                    <td><?= $row->other_crewmember ?></td>
                                

                          
                                                    <td><?= $row->ocm_certnum ?></td>
                                       


                                                        <?php if($row->ap == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                        <?php } ?> 


                              
                                                    <td><?= $row->ap_number ?></td>
                                       

                                                        <?php if($row->ia == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->military_maint == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>

                                                        <?php if($row->maintenance == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->atc == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->dispatcher == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                     
                                                    <td><?= $row->other_faa_cert ?></td>
                                     

                                    
                                                    <td><?= $row->ofc_certnum ?></td>
                                       



                                                        <?php if($row->se_land == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->me_land == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->se_sea == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>

                                                        <?php if($row->me_sea == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->instrument == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->cfi == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->cfii == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->mei == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->dpe == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->bgi == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->agi == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td> 
                                                <?php } ?>


                                                        <?php if($row->rotocraft == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->glider == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->balloon == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                        <?php if($row->airship == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                    
                                                    <td><?= $row->cred_notes ?></td>
                                                                                
                                 
                                     <!--               <td><?= $row->num_logins ?></td>
                       
                                                <?php if($row->last_login == '01/01/1970') { ?>    
                                                    <td> </td>
                                                <?php }else{ ?>
                                                    <td><?= $row->last_login ?></td>                                                  
                                                <?php } ?>

                                                <?php if($row->last_logout == '01/01/1970') { ?>    
                                                    <td> </td>
                                                <?php }else{ ?>
                                                    <td><?= $row->last_logout ?></td>                                                  
                                                <?php } ?>

                                                <?php if($row->token_expires == '01/01/1970') { ?>    
                                                    <td> </td>
                                                <?php }else{ ?>
                                                    <td><?= $row->token_expires ?></td>                                                  
                                                <?php } ?>


                                                    <td><?=  $row->trongate_user_id ?></td>
                                         
                                                                                  
  
                                                    <td><?= $row->user_token ?></td>
                                                                                  


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

                                                        <?php if($row->confirmed == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?> 


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


                                                    <td><?= $row->reset_code ?></td>
                                                                                

    
                                                    <?php if($row->force_pw_chg == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?> 


                                                        <?php if($row->timed_reset == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?> 

   
                                                    <td><?= $row->reset_interval ?></td>


                                                                                                                                                                                                                                              
   
                                                    <td><?= $row->ip_address ?></td>
                                                                                                
                         
                                                    <td><?= $row->homepage ?></td> -->
                             

                                                    <td><?= $row->fin_acct_type ?></td>
                                                                                   
   
                                                    <td><?= $row->acct_bal ?></td>

                                                        <?php if($row->fin_inactive == 1) { ?>
                                                            <td>Yes</td>
                                                        <?php }else{ ?>
                                                            <td>No</td>
                                                <?php } ?>


                                                    <td><?= $row->fin_status ?></td>

  
                                                    <td><?= $row->fin_email ?></td>
  
 
                                                    <td><?= $row->billname ?></td>

                                                    <td><?= $row->billphone ?></td>


      
                                                    <td><?= $row->billaddress1 ?></td>
       

               
                                                    <td><?= $row->billaddress2 ?></td>

   
                                                    <td><?= $row->billcity ?></td>
                

  
                                                    <td><?= $row->billstate ?></td>


  
                                                    <td><?= $row->billzip ?></td>
  
    
                                                    <td><?= $row->shipname ?></td>


 
                                                    <td><?= $row->shipphone ?></td>
 

   
                                                    <td><?= $row->shipaddress1 ?></td>


 
                                                    <td><?= $row->shipaddress2 ?></td>
   
                                                    <td><?= $row->shipcity ?></td>
                                 

  
                                                    <td><?= $row->shipstate ?></td>


                                                    <td><?= $row->shipzip ?></td>




                                                    <?php if($row->fin_billship == 1) { ?>
                                                        <td>Yes</td>
                                                    <?php }else{ ?>
                                                        <td>No</td>
                                                    <?php } ?>

                                   
                                                    <td><?= $row->in_notes ?></td>
                                 

                                                    <td><?= $row->created_by ?></td>
   

                                                <?php if($row->created_at == '01/01/1970') { ?>    
                                                    <td> </td>
                                                <?php }else{ ?>
                                                    <td><?= $created_at ?></td>                                                  
                                                <?php } ?>



                                                    <td><?= $row->updated_by ?></td>

                                                <?php if($row->updated_at == '01/01/1970') { ?>    
                                                    <td> </td>
                                                <?php }else{ ?>
                                                    <td><?= $row->updated_at ?></td>                                                  
                                                <?php } ?>
                            <!--        <td>                                                                  
                            <div class="btn-group">
                                <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho/index/ccmps/view/<?= $row->id ?>/m" >View</a>
                                <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>honcho/index/ccmps/create/<?= $row->id ?>/m">Update</a>
                                <a class="btn btn-rounded btn-outline btn-danger"  type="button" onClick="return confirm('This member will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/ccmps/del/<?= $row->id ?>/m">Delete</a>
                            </div>
                          
                                    </td>   -->                                                        

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
<!--
                                                    <th>Id</th>


                                                    <th>Code</th>


                                                    <th>Username</th>


                                                    <th>Access Level</th>



                                                    <th>First</th>


                                                    <th>Middle</th>


                                                    <th>Last</th>


                                                    <th>Suffix</th>


                                                    <th>Title</th>


                                                    <th>Email</th>


                                                    <th>Phone</th>


                                                    <th>Department</th>


                                                    <th>Notes</th>


                                                    <th>picture</th>




                                                <th>Mail Addr1</th>



                                                <th>Mail Addr2</th>



                                                <th>Mail City</th>



                                                <th>Mail State</th>



                                                <th>Mail Zip</th>



                                                <th>Phy Addr1</th>



                                                <th>Phy Addr2</th>



                                                <th>Phy City</th>



                                                <th>Phy State</th>



                                                <th>Phy Zip</th>



                                                <th>Mail=Phys</th>



                                                <th>VIP</th>



                                                <th>Student</th>



                                                <th>Private</th>



                                                <th>Commercial</th>



                                                <th>ATP</th>



                                                <th>Drone</th>



                                                <th>Other Crew</th>



                                                <th>Other Cert #</th>



                                                <th>A&P</th>



                                                <th>A&P #</th>



                                                <th>IA</th>



                                                <th>Military A&P</th>



                                                <th>Manintenance</th>



                                                <th>ATC</th>



                                                <th>Dispatcher</th>



                                                <th>Other Cert</th>



                                                <th>Other Cert #</th>



                                                <th>SE Land</th>



                                                <th>ME Land</th>



                                                <th>SE Sea</th>



                                                <th>ME Sea</th>



                                                <th>Instrument</th>



                                                <th>CFI</th>



                                                <th>CFII</th>



                                                <th>MEI</th>



                                                <th>DPE</th>



                                                <th>BGI</th>



                                                <th>AGI</th>



                                                <th>Rotocraft</th>



                                                <th>Glider</th>



                                                <th>Balloon</th>



                                                <th>Airship</th>



                                                <th>Cred Notes</th>

                

                                                    <th>No Logins</th>


                                                    <th>Last Login</th>


                                                    <th>Last Logout</th>


                                                    <th>Token Exp</th>



                                                    <th>TG User Id</th>

                                                                                      

                                                    <th>User Token</th>



                                                    <th>Inactive</th>


                                                    <th>Locked</th>


                                                    <th>Confirmed</th>
                                                                                                                                    

                                                    <th>Verified</th>



                                                    <th>Approved</th>

                                                                                  

                                                    <th>Reset Code</th>


                                                    <th>Force PW Chg</th>


                                                    <th>Timed Reset</th>


                                                    <th>Reset Interval</th>

                                                                                                  

                                                    <th>IP Address</th>


                                                    <th>Homepage</th>


                                                <th>Acct Type</th>



                                                <th>Acct Bal</th>



                                                <th>$ Acct Inactive</th>



                                                <th>Status</th>



                                                <th>Email</th>



                                                <th>Bill Name</th>



                                                <th>Bill Phone</th>



                                                <th>Bill Addr1</th>



                                                <th>Bill Addr2</th>



                                                <th>Bill City</th>



                                                <th>Bill State</th>



                                                <th>Bill Zip</th>



                                                <th>Ship Name</th>



                                                <th>Ship Phone</th>



                                                <th>Ship Addr1</th>



                                                <th>Ship Addr2</th>



                                                <th>Ship City</th>



                                                <th>Ship State</th>



                                                <th>Ship Zip</th>



                                                <th>Bill=Ship</th>



                                                <th>Fin Notes</th>



                                                <th>Created By</th>


                                                <th>Created At</th>



                                                <th>Updated By</th>



                                                <th>Updated At</th> -->

                    </tr>
                    </tfoot>
                    </table>

                                    </div> 
                                </div> <!-- ibox content -->
                            </div> <!--  panel body -->

                        </div> <!-- End Tab Panel 2 -->

                    </div> <!-- Tab Content for All Tabs  -->

                </div> <!--  tabs container -->




                <br>
                        <a class="btn btn-success btn-rounded btn-outline btn-bitbucket" href="<?= BASE_URL ?>honcho/index/ccmps/create//m">
                          <!--  <i class="fa fa-star"></i>--> Create New Account
                        </a>

                    <!--    <a class="btn btn-success btn-rounded btn-outline btn-primary" href="<= BASE_URL ?>honcho/index/ccmps/export">
                            <i class="fa fa-star"></i> Export Master Sheet
                        </a> -->
                    </div> <!-- ibox content for the page content section -->
                </div> 
            </div>
       <!--     </div> -->
        </div>

