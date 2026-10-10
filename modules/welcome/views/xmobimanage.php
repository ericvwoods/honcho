
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
                          
                        <div>
                            <h2><?= $chapter_name ?> Chapter Member Roster</h2>
                        </div>

                    </div>

                <div class="ibox-content">  
                                               
                            <strong>All Member Records</strong> <br>Choose a Record to View or Edit
                            <br>
      
                                 
                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" > 
                    <thead>
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                        <th>Rec Id</th>
                        <th>Num</th>
                        <th>Prefix</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Suffix</th>
                        <th>Type</th>
                        <th>Current</th>

                        <th>Email</th> 
                        <th>Phone</th> 
                        <th>Mobile</th>
   <!--  <th>Locked?</th> -->
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($rows as $row) { 

                                ?>
                                <tr class='gradeA'>
                                    <td><?= $row->id ?></td> 
                              <!--      <td><?= $row->trongate_user_id ?></td>   -->                            
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



                               <!--     <td><?= $row->locked ?></td> -->

                                    <td><?= $row->updated_at ?></td>
                                    <td>                                                                  
                            <div class="btn-group">
                             <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>welcome/mobiview/<?= $row->id ?>/m" >View</a>                                
                           <!--     <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>honcho/index/ccmps/view/<?= $row->id ?>/m" >View</a> -->
                                <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>welcome/mobiupdate/<?= $row->id ?>/m">Update</a>

    <?php if($row->force_pw_chg > 0): ?>  
           <!-- Already in reset state   -->                             
                              
<?php else: ?>
    <a class="btn btn-outline btn-warning" type="button" href="<?= BASE_URL ?>welcome/mobiresetpw/<?= $row->id ?>/m">Reset</a> 
<?php endif; ?>

    <?php if($row->locked > 0): ?>                            
                                <a class="btn btn-rounded btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome/mobiunlockacct/<?= $row->id ?>/m">Unlock</a>
<?php else: ?>
                              <a class="btn btn-rounded btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome/mobilockacct/<?= $row->id ?>/m">Lock</a>
<?php endif; ?>

                            </div>
                          
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
               <!--        <th>Tbl Id</th> 
                        <th>User Id</th> -->
                        <th>Rec ID</th>
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
                        <th>Mobile</th> 
  <!--  <th>Locked?</th> -->
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                     
                </div> <!-- end div table responsive-->
                            <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome/mobihome">Close</a>
            </div> <!-- ibox content table -->
 
        </div> <!-- col 12 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->
