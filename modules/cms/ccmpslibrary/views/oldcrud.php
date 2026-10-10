
            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12"> 

                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="row">
                                    <!--    <div class="col-md-1"> 
                                        </div> -->
                                                                           
                                    <div class="col-md-11"> 
                                    <?php if($_SESSION['admode'] == 'mmyadsv' || $_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc'): ?> 
                    <a data-toggle="collapse" href="#faq1" class="faq-question"> Document Library</a>
                                    <?php else: ?>
                    <a data-toggle="collapse" href="#faq1" class="faq-question"> <h2> Document Library</h2></a>
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


   <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php endif; ?>
   <br>  
<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                          
                           <strong> <?= validation_errors() ?></strong>
                           
                           <!-- If updating or creating else viewing  -->
                                    <?php if($_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'cmmadsc' || $_SESSION['admode'] == 'cmmadsu' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'): ?> <!-- Updating or creating  -->     

<!--<php if($_SESSION['tab'] == 1): ?> -->

                                 <form  method = "post" action="<?= BASE_URL ?>cms-library/submit/<?= $recid ?>">
                                   
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <br>


                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Title<a style="color:Red;">*</a> <small><!--(limit 100) --></small></h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-4"><input name="title" type="text" class="form-control form-control-sm" value="<?= $title ?>" placeholder=""required></div>
                                                    </div>

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>Description<a style="color:Red;">*</a> <small><!-- (limit 500) --></small></h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-4"><input name="shortdescription" type="text" class="form-control form-control-sm" value="<?= $shortdescription ?>" placeholder="" required></div>
                                                    </div> 

                                                    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Author</h<?= $_SESSION['fontsize'] ?>></strong></label>

                                                        <div class="col-sm-2"><input name="author" type="text" class="form-control form-control-sm" value="<?= $author ?>" ></div>
                                                    </div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>Document Tag</h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-2"><select class="form-control m-b" name="doctag" >
                        <!-- Loop through the dropdown array passed in $data  -->
                        <?php foreach($doctags as $row) { ?>
                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                            <?php if($row->id == $scope): ?> 
                                <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php else: ?> <!-- otherwise just create the option -->
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php endif; ?>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>Document Type</h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-2"><select class="form-control m-b" name="doctype" >
                        <!-- Loop through the dropdown array passed in $data  -->
                        <?php foreach($doctypes as $row) { ?>
                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                            <?php if($row->id == $scope): ?> 
                                <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php else: ?> <!-- otherwise just create the option -->
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php endif; ?>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div> 

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-2"><select class="form-control m-b" name="scope" >
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
        <?php if($_SESSION['admode'] == 'cmmadsc' || $_SESSION['admode'] == 'momadsc' ) { ?>
            <!-- if adding stay with defaults of True for both  -->
        <?php }else{ ?>
              <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Active</h<?= $_SESSION['fontsize'] ?>>  </strong></label>
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
                </div>

              <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Approved</h<?= $_SESSION['fontsize'] ?>>  </strong></label>
                  <div class="col-sm-1"><select class="form-control m-b" name="approved" Value="<?= $approved ?>" >
                    <?php if($approved == 1) { ?>
                        <option selected value=1>Yes</option>
                        <option value=0>No</option>
                    <?php }else{ ?>
                        <option value=1>Yes</option>
                        <option selected value=0>No</option>
                    <?php } ?>
                    </select>
                   </div>                                              
                </div>
            
              <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Draft</h<?= $_SESSION['fontsize'] ?>>  </strong></label>
                  <div class="col-sm-1"><select class="form-control m-b" name="draft" Value="<?= $draft ?>" >
                    <?php if($draft == 1) { ?>
                        <option selected value=1>Yes</option>
                        <option value=0>No</option>
                    <?php }else{ ?>
                        <option value=1>Yes</option>
                        <option selected value=0>No</option>
                    <?php } ?>
                    </select>
                   </div>                                              
                </div>            
        <?php } ?>      

            <!--  this is for the paradiam when you ask for the filetype when record created then compare filetype of upload with it -->
                 <!--    <div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>File Type</h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-2"><select class="form-control m-b" name="filetype" value="<?= $filetype ?>">
                        
                        <?php foreach($filetypes as $row) { ?>
                            <?php if($row->id == $filetype): ?> 
                                <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php else: ?> 
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php endif; ?>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div>             -->
            <!-- Here only asking if it is a database record or a file attachment: rectype  -->
                     <div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>>Record Type</h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-2"><select class="form-control m-b" name="rectype" value=<?= $rectype ?>>
                        
                        <?php foreach($rectypes as $row) { ?>
                            <?php if($row->id == $rectype): ?> 
                                <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php else: ?> 
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                            <?php endif; ?>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> 


                                                <!--    <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> File Location</h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                        <div class="col-sm-4"><input name="location" type="text" class="form-control form-control-sm" value="<?= $location ?>" ></div>
                                                    </div> -->


 <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> More Info</h<?= $_SESSION['fontsize'] ?>></strong></label>
<div class="col-sm-4">    
                                                    <textarea  class="form-control border-left m-t" style="height: 200px" name="fulldescription" id="doc_editor"> <!-- id is for CKEditor    -->
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
                                                        <!-- If you are a ccmp or CA you dont choose chapter when adding or updating a doc  -->
                                                        <?php if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'momadsu' || $_SESSION['admode'] == 'momadsc'):  ?>
                                                
                                                        <div class="col-sm-2"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" hidden></div>
                                                
                                                        <?php else: ?>  
                                                            <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

                                                                <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>> Chapter<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></strong></label>
                                                                <div class="col-sm-3"><select class="form-control m-b" name="chapter" >
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
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-library/viewdoc/<?= $recid ?>"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> <!-- href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"   -->
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'mmyadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-library/manage/mmyads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a> <!-- href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"   -->
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'cmmadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>cms-library/manage/cmmads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['admode'] == 'momadsc' ): ?> <!-- Return to the manage page you came from -->
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>cms-library/manage/momads"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 


<?php else: ?>  <!-- Viewing Tab 1-->
                                                    
    <div class="row"> 
        <div class="col-md-12">

            <br>
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Doc Id#</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $id ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div> 
            <?php if($_SESSION['admode'] !== 'mmyadsv'): ?>
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Poster</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $poster ?> </h<?= $_SESSION['fontsize'] ?>></div> 
                </div>
            <?php endif; ?> 
           
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Title</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $title ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Description</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-8"><h<?= $_SESSION['fontsize'] ?>><?= $shortdescription ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>

            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Author</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $author ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>  

            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Document Tag</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $tagtitle ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div> 

            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Document Type</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $typetitle ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div> 

            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Scope</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $scope ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Chapter</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $chapternm ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>                                                                                                 
            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Active/Visible</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $active ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>

           <div class="form-group row"><label class="col-lg-2" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Approved</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $approved ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>                                               

            <div class="form-group row"><label class="col-lg-2" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Draft</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $draft ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div>  
            

            <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> File Type</h<?= $_SESSION['fontsize'] ?>></label>
                <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $filetypetitle ?></h<?= $_SESSION['fontsize'] ?>></div> 
            </div> 
<!-- <?php json($rectype); ?> -->
<?php if($rectype > 1 ): ?>  <!-- <php if($filetype > 1 ): ?> this was when specified filetype first. Now specify rectype first -->
 
    <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> File Name</h<?= $_SESSION['fontsize'] ?>></label>

        
<!-- If a filename already exists we are attempting to replace a file  -->        
<?php if(strlen($filename) > 0): ?>
            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>> <?= $filename ?></h<?= $_SESSION['fontsize'] ?>></div> 
                        </div> 
<!-- Here we will replace a file on disk by uploading a new one. If it is the same name it will overwrite.
If different name must delete the old one that was orphaned on the disk  -->

        <?php if($_SESSION['admode'] == 'mmyadsv' ): ?>
        <!-- dont allow ccmp to upload unless chapter admin or content manager or system Admin --> 
        <?php else: ?>    
<!-- <php echo(436); print_r($recid); die(); ?> -->
            <?php
                validation_errors();
             //   $form_location = BASE_URL.'cms-library/submit_upload/'.$recid; // http://localhost/honchotg/cms-library/submit_upload/$recid
                echo form_open_upload($form_location); 
                echo form_file_select('my_file');
             /*   echo form_submit('/viewdoc', 'Upload File 450'); */
                echo form_submit('/submit_upload/<?= $recid ?>', 'Upload Replacement');  
                echo form_close();
            ?>
          <br>
         <?php endif; ?> 

<?php else: ?>
         <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?> style="color:Red;"> File Missing</h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div> 

        <?php if($_SESSION['admode'] == 'mmyadsv' ): ?>
        <!-- dont allow member to upload unless are a chapter admin or content manager or system Admin --> 
        <?php else: ?>    

            <?php
                validation_errors();
            //    $form_location = BASE_URL.'cms-library/submit_upload/'.$recid;
                echo form_open_upload($form_location); // http://localhost/honchotg/cms-library/submit_upload/$recid
                echo form_file_select('my_file');
                echo form_submit('/viewdoc', 'Upload File (no file)'); /* for debugging */
           /*   echo form_submit('/viewdoc', 'Upload File 470'); */
                echo form_close();
            ?>
          <br>
         <?php endif; ?> 
<?php endif; ?> 

<!-- If there is a physical file then More Info will just have notes. If not then it contains the document text and should be viewed in  full page so a view button will be shown below for rec/file type = 1  -->
    <div class="form-group row"><label class="col-sm-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> Downloads</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-lg-7"><h<?= $_SESSION['fontsize'] ?>> <?= $downloads ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>
    <div class="form-group row"><label class="col-sm-2 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>> More Info</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-lg-7"><h<?= $_SESSION['fontsize'] ?>> <?= $fulldescription ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>    
  <?php endif; ?> <!-- $rectype > 1  -->  






</div> <!-- end col-6 -->

<!--   <div class="col-md-6"> -->
                           
<!--  </div> --> <!-- end 2nd column -->

</div> <!-- end row -->
<div class="row">
   
                                <!--  <div class="btn-group"> -->

                    <?php if($_SESSION['admode'] == 'mmyadsv'): ?>

                            <div>
                                <?php if($filetype == 0 || $filetype == 1 || strlen($filename) < 1): ?> <!-- Missing or Database Filetype or no filename -->
                                <!-- nothing to download -->

                                        <?php if($filetype == 1): ?>
                                             <a class="btn btn-outline btn-success"  type="button"  href="<?= BASE_URL ?>cms-library/fulldescription/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-database"></i>  511View</h<?= $_SESSION['fontsize'] ?>></a>             
                                        <?php endif; ?> 
          
                                <?php endif; ?>


                                <!--        <?php if($filetype == 2): ?> 
                          <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>" download><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['fontsize'] ?>></a> 

                          <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>/p" target="_blank" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Preview</h<?= $_SESSION['fontsize'] ?>></a> 
                                        <?php endif; ?> -->



                        <?php if($filetype == 3): ?> <!-- If PDF either preview or force a download   -->


                              <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>" download><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['fontsize'] ?>></a> 

                              <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>/p" target="_blank" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-eye"></i> Preview</h<?= $_SESSION['fontsize'] ?>></a> 

                        <?php else: ?> 
                                        <?php if($filetype == 1): ?>
                                            <!-- no download button  -->
                                               <?php else: ?> 
   <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>" target="_blank" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['fontsize'] ?>></a>                                                         
                                        <?php endif; ?> 


                                            <!-- not a PDF  -->
                                                                   
                                            <?php endif; ?>

                                <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/mmyads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>


                            </div>

                    <?php endif; ?>
                                
                                

                    <?php if($_SESSION['admode'] == 'cmmadsv'): ?>    
                            <div>

                            <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>cms-library/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>
                                <?php if($filetype == 0 || $filetype == 1 || strlen($filename) < 1): ?> <!-- Missing or Database Filetype or no filename -->
                                <!-- nothing to download -->

                                        <?php if($filetype == 1): ?>
                                             <a class="btn btn-outline btn-success"  type="button"  href="<?= BASE_URL ?>cms-library/fulldescription/<?= $recid ?>/v" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-database"></i>  View</h<?= $_SESSION['fontsize'] ?>></a>             
                                        <?php endif; ?> 
         
                                <?php endif; ?>


                               <?php if($filetype == 2): ?> <!-- If PDF either preview or force a download   -->
                          <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>" download><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['fontsize'] ?>></a> 

                     <!--     <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>/p" target="_blank" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Preview</h<?= $_SESSION['fontsize'] ?>></a> -->
                               <?php endif; ?>

                               <?php if($filetype == 3): ?> <!-- If PDF either preview or force a download   -->
                          <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>" download><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['fontsize'] ?>></a> 

                          <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-library/downloaddoc/<?= $id ?>/p" target="_blank" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-eye"></i> Preview</h<?= $_SESSION['fontsize'] ?>></a> 
                                        
                               <?php endif; ?>

                    <?php if($id == 1): ?> <!-- If it is the document 1 which is ATIS do not allow to be deleted  -->
                    <!-- ATIS - do nothing  -->
                    <?php else: ?>

                        <!-- A title with spaces will crash in UAT.  The title is for the auditlog only -->
                        <?php
                        $str = $row->title ;
                        $new_str = str_replace(' ', '', $str); // Outputs: removes all spaces
                        ?>
                                
                         <a id="btnDelRec" class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-library/delrecord/<?= $id ?>/<?= $new_str ?>"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-trash"></i> Delete</h<?= $_SESSION['fontsize'] ?>></a>   
                    <?php endif; ?>

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/cmmads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>

                        </div>

                    <?php endif; ?>
                                
                                
                    <?php if($_SESSION['admode'] == 'momadsv'): ?>    
                                               
                            <div>

                            <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>cms-library/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>

                            <?php if($filetype == 1): ?>

                                
                                 <a class="btn btn-outline btn-success"  type="button"  href="<?= BASE_URL ?>cms-library/fulldescription/<?=  $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-database"></i>  View</h<?= $_SESSION['fontsize'] ?>></a>             
                            <?php endif; ?> 

                            <a id="btnDelRec" class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-library/delrecord/<?= $recid ?>/<?= $new_str ?>"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-trash"></i> Delete</h<?= $_SESSION['fontsize'] ?>></a> 
                                                       
                            <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/momads" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>
                            </div> 
                                        
                    <?php endif; ?> 
 
                              

                                </div> 

</div> <!-- End row   -->


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
                

