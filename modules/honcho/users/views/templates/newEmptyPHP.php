
<!-- *********************************************************************** -->
<!-- ****** Begin Boiler Plate for 1st CRUD Item containing Form Open ****** -->
<!-- *********************************************************************** -->

<div class="faq-item"> <!-- Ends at end of file -->

        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-3">
                        <!-- #faq? must be unique but not in any order  -->
                        <a data-toggle="collapse" href="#faq1" class="faq-question" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>>First CRUD Item</h<?= $_SESSION['fontsize'] ?>></a>
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['crudtab'] must be equal to #faq number  -->
                <?php if($_SESSION['crudtab'] == 1): ?>
                    <div id="faq1" class="panel-collapse">
                <?php else: ?>
                    <div id="faq1" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['crudtab'] == 1): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
                <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?> 
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
<?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'  || $_SESSION['ccmpmode'] == 'mosc' || $_SESSION['ccmpmode'] == 'mosu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!-- **************************** Begin Form ******************************* -->
<!-- Form to post the create/update form values - the view is also contained in the form -->
<!-- The first faq item must contain the form open and the last item the form close -->
<!-- *********************************************************************** -->

    <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>">
        
<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!-- Save button is same for all  -->

    <div>
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
           
<!-- now isolate which one for the correct Cancel button -->

       <?php if($_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->

           <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
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

<!-- *********************************************************************** -->
<!-- ********************** Begin Create/Update Fields ********************* -->
<!-- *********************************************************************** -->
        <div class="row"> 
            <div class="col-md-6">
<!-- *********************************************************************** -->
<!-- ****************** Left Column Create/Update Fields ******************* -->
<!-- *********************************************************************** -->                 

<p> Left column create/update fields go here </p>

<!-- Three constructs -->
    <p>Regular Fields</p>

<!-- All labels must be unique because they double as names for input fields for $_POST (extracted in _ccmps_fetch_data_from_post() line)-->
<?php $fields100 = ["Prefix" => "$salutation", 
                    "First <a style='color:Red;'>*</a>"  => "$first_name",
                    "Middle" => "$middle_name",
                    "Last <a style='color:Red;'>*</a>"   => "$last_name",
                    "Suffix" => "$suffix"]; ?>

<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _ccmps_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($fields100 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

    <p>Yes/No Dropdowns</p>

    <!-- Yes/No Dropdowns -->
    
    <?php $fields101 = ["Restricted Access" => "$vip",
                        "Directory Opt Out" => "$directoryoptout",
                        "Email Opt Out" => "$emailoptout",
                        "Do Not Call" => "$donotcall",
                        "Mail Newsletter" => "$mail_notices",
                        "Eligible Voter" => "$eligible_voter"                                                                     
                        ]; ?>

<?php foreach($fields101 as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
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

        <p>Table-driven Dropdowns</p>
        
    <!-- Table-driven Dropdown Menus -->     
        
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Mail State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="mailstate" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> 
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->state_code == $mailstatecode): ?> 
               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> 
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->  
        
                <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

<!-- Treasurer/sysadmin can assign chapter to a new member including Chapter at Large  -->
                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Chapter<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="chapter" style="<?= $selectstyle ?>">
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

                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Chapter<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="chapter" style="<?= $selectstyle ?>">
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
    
    
<!-- *********************************************************************** -->
<!-- **************** End Left Column Create/Update Fields ***************** -->
        </div> <!-- end col-6 -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ****************** Right Column Create/Update Fields ****************** -->
        <div class="col-md-6">
<!-- *********************************************************************** --> 


    <p> Right column create/update fields go here </p>            


<!-- *********************************************************************** -->
<!-- **************** End Right Column Create/Update Fields **************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


    <p>Create/update fields outside row go here</p>


<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
        <div>
        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><i class="fa fa-times-circle"></i> Cancel</a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><i class="fa fa-times-circle"></i> Cancel</a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><i class="fa fa-times-circle"></i> Cancel</a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><i class="fa fa-times-circle"></i> Cancel</a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
        </div>                                        

    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
        <div>
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><i class="fa fa-times-circle"></i> Cancel</a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
        <div>
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><i class="fa fa-times-circle"></i> Cancel</a>
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

    <div class="btn-group">

    <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
    <div>

   <!-- Change the /3 if necessary to this tab number to signify tab to return to after edit/cancel/exit -->

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a>
    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php else: ?> 

    <?php endif; ?> 
</div>

<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Left Column of View Fields ********************** -->
<!-- *********************************************************************** --> 


    <p>left column view fields go here</p>

    <p>Regular Fields</p>
    
    <?php $fieldsv100 = ["Prefix" => "$salutation",
                         "First"  => "$first_name",
                         "Last"   => "$lastname"
                         ]; ?>           

    <?php foreach($fieldsv100 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
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

    <p>right column view fields go here</p>
    

<!-- *********************************************************************** -->
<!-- ****************** End Right Column of View Fields ******************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right view columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


    <p>view fields outside row go here</p>


<!-- *********************************************************************** -->
<!-- **************************** End Form ********************************* -->
<!-- If this is the only faq crud item or the last faq crud item -->
<!-- Must close the form otherwise comment out so the other items will post their values-->

    </form>
<!-- *********************************************************************** --> 

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->
                     
