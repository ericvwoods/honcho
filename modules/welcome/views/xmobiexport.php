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


                                    <div class="ibox-content">
                                                            
                                    <strong>All Chapter Member Records</strong> <br>Choose a Record to View or Edit
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
                                <a class="btn btn-rounded btn-warning" type="button" href="<?= BASE_URL ?>honcho/index/ccmps/create/<?= $row->id ?>/m">Update</a>
                            <!--    <a class="btn btn-rounded btn-outline btn-danger"  type="button" onClick="return confirm('This member will be permanently deleted. Confirm Deletion?');" href="<?= BASE_URL ?>honcho/index/ccmps/del/<?= $row->id ?>/m">Delete</a> -->
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