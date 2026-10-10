<?php 

  include('navbar.php');

?> 

            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12"> 
        <div class="ibox-content">
            <div class="row"> 

                <?php if(strlen($picture) > 0): ?> 
                        <div class="col-md-1">   
                            <img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/> 
                        <!--    <img alt="user picture" class="rounded-circle" src="<= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
                        </div> <!-- end col -->

                <?php else: ?> <!-- No pic  -->
                        <div class="col-md-1">  
                        <br> 
                        <div class="row">
                            <div class="col-md-1">  
                            </div>
                          <a href="#" title="">
                                            <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
                                        </a>
                       
                      </div>
                      <br>

                      </div> <!-- end col -->
                <?php endif; ?>

                <div class="col-md-9">
                    <br>
                    <?php if($_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv' ): ?> 
                    <br />                           
                            <h1><p><?= $header ?></p></h1>
                        <!--    <h2><p><?= $subheader ?></p></h2> -->
                    <?php else: ?>
                            <?php if($_SESSION['admode'] == 'cmmadsc'): ?> 
                                <h1><p><?= $header ?></p></h1>
                                <h2><p><?= $subheader ?></p></h2>                        
                            <?php else: ?> <!-- momads chapter    -->
                               
                                <h1><p><?= $header ?></p></h1>
                                <h2><p><?= $subheader ?></p></h2>                                               
                            <?php endif; ?> 
                    <?php endif; ?> 

                </div> <!-- end column -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                         <!--   <php if(strlen($picture) > 0): ?> -->
                                <div class="col-md-2">   
                                    <h1 class="logo text-center">
                                        <a href="#" title="">
                                         <!--   <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo"> -->
                                        </a>
                                    </h1>
                                </div> <!-- end col -->
                        <!--    <php endif; ?> -->

                        </li>
                    </ul>
            </div> <!-- end row -->



        </div>

       <br>                

                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="row">
                                    <!--    <div class="col-md-1"> 
                                        </div> -->
                                                                           
                                    <div class="col-md-11"> 
                                    <?php if($_SESSION['admode'] == 'mmyadsv' || $_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc'): ?> 
                    <a data-toggle="collapse" href="#faq1" class="faq-question">My Job</a>
                                    <?php else: ?>
                    <a data-toggle="collapse" href="#faq1" class="faq-question"> <h2> Job Posting</h2></a>
                                    <?php endif; ?>                  
                                    </div> <!-- end col -->

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['tab'] == 1): ?>
                                        <div id="faq1" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq1" class="panel-collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                    <div class="ibox-content"> 

                                                                    <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                          
                           <strong> <?= validation_errors() ?></strong>
                           
                           <!-- If updating or creating else viewing  -->
                                    <?php if($_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'cmmadsc' || $_SESSION['admode'] == 'cmmadsu' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'): ?> <!-- Updating or creating  -->     

<!--<php if($_SESSION['tab'] == 1): ?> -->

                                 <form  method = "post" action="<?= BASE_URL ?>cms-jobs/submit/<?= $recid ?>">
                                   
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <br>
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Active/Visible</h<?= $_SESSION['fontsize'] ?>>  </strong></label>
                                                          <div class="col-sm-1"><select class="form-control m-b" name="active" Value="<?= $active ?>" >
                                                            <?php if($active == 1) { ?>
                                                                <option selected value=1>Yes</option>
                                                                <option value=0>No</option>
                                                            <?php }else{ ?>
                                                                <option value=1>Yes</option>
                                                                <option selected value=0>No</option>
                                                            <?php } ?>
                                                            </select>
                                                           </div>                                              
                                                        </div>                                   <!--       <h<?= $_SESSION['fontsize'] ?>>       </h<?= $_SESSION['fontsize'] ?>>        -->

                                               <!--      <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

                                                         <div class="col-sm-2"><input name="ccmp_id" type="text" class="form-control" value="<?= $ccmp_id ?>" hidden></div>
                                               <!--     </div> -->

                                                    <?php if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc'): ?>
                                                    <!-- How to handle not updatable but still pass current value to the save   -->
                                                 <!--    <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

                                                         <div class="col-sm-2"><input name="approved" type="text" class="form-control" value="<?= $approved ?>" hidden></div>
                                              <!--      </div> -->
                                                    <!-- END --How to handle not updatable by still pass current value to the save   -->
                                                    <?php else: ?>                                        
                                                      <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Approved</h<?= $_SESSION['fontsize'] ?>>  </strong></label>
                                                          <div class="col-sm-1"><select class="form-control m-b" name="approved" Value="<?= $approved ?>" >
                                                            <?php if($active == 1) { ?>
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

                                                        <?php if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'cmmadsu' || $_SESSION['admode'] == 'cmmadsc' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'): ?>
                                              
                                                    <!--     <div class="col-sm-2"><input name="scope" type="text" class="form-control" value="<?= $scope ?>" hidden></div> -->

                                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                                <div class="col-sm-2"><select class="form-control m-b" name="scope" >
                                                                <!-- Loop through the dropdown array passed in $data  -->
                                                                <?php foreach($scopes as $row) { ?>
                                                                <!-- If $row->id = currently selected scope id then pre-select that option -->
                                                                    <?php if($row->id == $scope): ?> 
                                                                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                                    <?php else: ?> <!-- otherwise just create the option -->
                                                                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                                    <?php endif; ?>
                                                                 <?php } ?>                                    
                                                                 </select>
                                                                </div>
                                                                </div>

                                                        <?php else: ?>  <!-- Not a member, must be chapter admin or member admin  -->
                                                            <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

                                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></strong><a style="color:Red;">*</a></label>
                                                                <div class="col-sm-8"><select class="form-control m-b" name="scope" >
                                                                <!-- Loop through the dropdown array passed in $data  -->
                                                                <?php foreach($scopes as $row) { ?>
                                                                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                                    <?php if($row->id == $scope): ?> 
                                                                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                                                                    <?php else: ?> <!-- otherwise just create the option -->
                                                                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                                                                    <?php endif; ?>
                                                                 <?php } ?>                                    
                                                                 </select>
                                                                </div>
                                                                </div>
                                                 
                                                            <?php else: ?> <!-- Adding/Creating  -->
                                                 
                                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></strong><a style="color:Red;">*</a></label>
                                                                <div class="col-sm-8"><select class="form-control m-b" name="scope" >
                                                                <!-- Loop through the dropdown array passed in $data  -->
                                                                <?php foreach($scopes as $row) { ?>
                                                                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                                    <?php if($row->id == $scope): ?> 
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

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Title<a style="color:Red;">*</a> <small>(limit 50)</small></h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-4"><input name="title" type="text" class="form-control form-control-sm" value="<?= $title ?>" placeholder=""required></div>
                                                    </div>

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>Message<a style="color:Red;">*</a> <small>(limit 500)</small></h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-4"><input name="shortdescription" type="text" class="form-control form-control-sm" value="<?= $shortdescription ?>" placeholder="" required></div>
                                                    </div> 

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Contact Info</h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-4"><input name="contact_info" type="text" class="form-control form-control-sm" value="<?= $contact_info ?>" ></div>
                                                    </div>

                                               <!--     <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Alt Contact Name/Phone/Email</h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-3"><input name="alt_contact_info" type="text" class="form-control form-control-sm" value="<?= $alt_contact_info ?>" ></div>
                                                    </div> -->

                                               <!--     <div class="form-group  row"><label class="col-sm-1 col-form-label"><strong>Use Alt Contact Only</strong></label>
                                                          <div class="col-sm-1"><select class="form-control m-b" name="alt_contact_only" Value="<?= $alt_contact_only ?>" >
                                                            <?php if($lt_contact_only == 1) { ?>
                                                                <option selected value=1>Yes</option>
                                                                <option value=0>No</option>
                                                            <?php }else{ ?>
                                                                <option value=1>Yes</option>
                                                                <option selected value=0>No</option>
                                                            <?php } ?>
                                                            </select>
                                                           </div>                                              
                                                        </div> -->

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Location</h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                        <div class="col-sm-4"><input name="location" type="text" class="form-control form-control-sm" value="<?= $location ?>" ></div>
                                                    </div>

                                               <!--     <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Enter Current Best Offer</h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                        <div class="col-sm-1"><input name="current_bid" type="text" class="form-control form-control-sm" value="<?= $current_bid ?>" ></div>
                                                    </div> -->


 <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> More Info</h<?= $_SESSION['fontsize'] ?>></strong></label>
<div class="col-sm-4">    
                                                    <textarea  class="form-control border-left m-t" style="height: 200px" name="fulldescription" id="job_editor"> <!-- id is for CKEditor    -->
                                                            <?= $fulldescription ?>
                                                   </textarea>
</div>
</div>

                <!--    <div class="ibox-content no-padding">

                        <div class="summernote">
                            <= $fulldescription ?>
                            <br/>

                        </div>

                    </div> -->

                                                    <?php if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'cmmadsu' || $_SESSION['admode'] == 'cmmadsc' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'): ?>
                                                    <!-- How to handle not updatable but still pass current value to the save   -->
                                                     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                                         <div class="col-sm-1"><input name="tg_user_id" type="text" class="form-control" value="<?= $tg_user_id ?>" hidden></div>
                                                    </div>
                                                    <!-- END --How to handle not updatable by still pass current value to the save   -->
                                                    <?php else: ?>                                        
                                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>TG User Id</h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                            <div class="col-sm-1"><input name="tg_user_id" type="text" class="form-control" value="<?= $tg_user_id ?>" ></div>
                                                        </div>
                                                    <?php endif; ?>





                                                        <!-- Must choose the chapter for Chapter Only scope -->
                                                        <!-- If you are a ccmp or CA you dont choose chapter when adding or updating a job  -->
                                                        <?php if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'):  ?>
                                                
                                                        <div class="col-sm-2"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" hidden></div>
                                                
                                                        <?php else: ?>  
                                                            <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

                                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Chapter<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                                <div class="col-sm-4"><select class="form-control m-b" name="chapter" >
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
                                                 
                                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> <?= SUBENTITY ?><a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                                <div class="col-sm-4"><select class="form-control m-b" name="chapter" >
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

                                            </div> <!-- end col-12 -->


                                        </div> <!-- end row -->


                                    <?php if($_SESSION['admode'] == 'mmyadsu' ||$_SESSION['admode'] == 'cmmadsu' || $_SESSION['admode'] == 'momadsu'): ?>  <!-- If any of the roles cancel an update show the record  -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-jobs/viewjob/<?= $recid ?>"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> <!-- href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"   -->
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'mmyadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-jobs/manage/mmyads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a> <!-- href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"   -->
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'cmmadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>cms-jobs/manage/cmmads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'momadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>cms-jobs/manage/momads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 


<!-- Viewing Tab 1-->  <?php else: ?>  <!-- Viewing Tab 1-->
                                                    
                                        <div class="row"> 
                                            <div class="col-md-12">

                                                <br>

                                                <?php if($_SESSION['admode'] !== 'mmyadsv'): ?>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Poster</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $poster ?> </h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                <?php endif; ?> 
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Posted/Updated</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $created_at ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Title</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $title ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Message</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-8"><h<?= $_SESSION['fontsize'] ?>><?= $shortdescription ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $scope ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Chapter</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $chapternm ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                                                                 
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Active/Visible</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $active ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                            <!--    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Approved</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $approved ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->                                               


                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Contact Info</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $contact_info ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                            <!--     <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Alt Contact Name/Phone/Email</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $alt_contact_info ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->
                                         <!--       <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Use Alt Contact Only</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $alt_contact_only ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Location</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $location ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                                
                                            <!--    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Best Offer</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $current_bid ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> -->
                                                <div class="form-group row"><label class="col-sm-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> More Info</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-lg-7"><h<?= $_SESSION['fontsize'] ?>> <?= $fulldescription ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                            </div> <!-- end col-6 -->

                                         <!--   <div class="col-md-6"> -->
                                                                       
                                          <!--  </div> --> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                <!--  <div class="btn-group"> -->

                                <?php if($_SESSION['admode'] == 'mmyadsv'): ?>
                                <div>
                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>cms-jobs/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>cms-jobs/manage/mmyads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                <?php else: ?> 
                                     <?php if($_SESSION['admode'] == 'cmmadsv'): ?>
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>cms-jobs/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>cms-jobs/manage/cmmads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>
                                    <?php else: ?> <!-- momads  -->
                                        <div>

                                        <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>cms-jobs/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>cms-jobs/manage/momads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div> 
                                        
                                    <?php endif; ?> 
 
                                        
           

                                <?php endif; ?> 

                                </div> 
                               <!--         <div class="form-group row"><label class="col-lg-1 ">Photo</label> 
                                                        <div class="col-sm-5" ><?= $picture ?></div> 
                                        </div> 
               <form action="<?= BASE_URL ?>welcome-ccmps/uploadccmppic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">   
                        <input type="file" name="picture" value="">
                        <button type="submit" name="submit" value="Upload">Upload Photo</button>
 
                </form> -->


                <?php endif; ?> <!--  End Viewing Tab 1  -->

                                    </div> <!-- end ibox -->

                              
                                </div> <!-- End Panel Body -->                              
                            

                            </div> <!-- End Tab 1 Panel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


<br>
                    </div> <!-- ibox small border bottom -->


                </div>
        
        </div> <!-- new ibox  -->   
                

