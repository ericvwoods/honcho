
<!-- *********************************************************************** -->
<!-- **** Begin Boiler Plate for inner CRUD Item - no form open or close **** -->
<!-- *********************************************************************** -->

<div class="faq-item"> <!-- Ends at end of file -->

        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                        <!-- #faq? must be unique but not in any order  -->
                        <center><a data-toggle="collapse" href="#faq2" class="faq-question" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-trophy fa-1x" style="color:LightBlue;"></i> Credentials <i class="fa fa-caret-down fa-1x" style="color:LightBlue;"></i></h<?= $_SESSION['fontsize'] ?>></a></center>
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['ccmp_active_window'] must be equal to #faq number  -->
                <?php if($_SESSION['ccmp_active_window'] == 2): ?>
                    <div id="faq2" class="panel-collapse">
                <?php else: ?>
                    <div id="faq2" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['ccmp_active_window'] == 2): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
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
<!-- If this is the first faq crud item uncomment-->
 <!--   <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>"> -->
<!-- *********************************************************************** -->

<!-- this is an inner crud item so no form open -->
       
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


 <!--  <p> Left column create/update fields go here </p> -->
                                    <br>
<!--  Begin Update/Create Tab 2 -->

    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Highest Cert<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="highest_certificate" style="<?= $selectstyle ?>">
    <!-- Loop through the dropdown array passed in $data  -->
    <?php foreach($highestcerts as $row) { ?>
        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->id == $highest_certificate): ?> 
                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
            <?php endif; ?>
         <?php } ?>                                    
         </select>
        </div>
    </div>


    <?php $fields200 = ["Certificate Number" => "$certificate_number",  
                        "Total Time"         => "$total_time"
                  
                    ]; ?>

    <?php foreach($fields200 as $label=> $value) { ?>
        <!-- create a unique field name that is used in the $_POST -->
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?> 


<?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu'): ?> 
<!-- CCMP cannot verify themselves -->
    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><h<?= $_SESSION['fontsize'] ?>><strong>Unverified</strong></h<?= $_SESSION['fontsize'] ?>></label>

         <div class="col-sm-8"><input name="unverified" type="text" class="form-control" value="<?= $unverified ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>

        <?php if($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?> <!-- Later add momc  -->

            <!-- Only member admin can set unverifed to false (ie is verified) -->

                <?php $fields209 = ["Unverified" => "$unverified"                                                                     
                                ]; ?>

                <?php foreach($fields209 as $label=> $value) { ?>
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

        <?php else: ?>

            <!-- Comes in as value goes out as name -->
            <?php if($unverified == 1) { ?>
                <!-- If unverified  - dont have the rights to verify -->

    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row">
         <div class="col-sm-8"><input name="unverified" type="text" class="form-control" value="<?= $unverified ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->




            <?php }else{ ?> <!-- Can only unverify -->
                <center><div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>> Check box to Unverify </h<?= $_SESSION['fontsize'] ?>> </label>
                    <input type="checkbox" class="checkItem" value="1" name="unverified">
                </div>  </center> 
            <?php } ?>

        <?php endif; ?>


    <?php endif; ?>

    <?php if($_SESSION['fontsize'] == 1): ?> 

        <!-- Done -->
    
    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
        <br>

    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!-- Done -->
        <br>
        <br>

    <?php endif; ?> 



    <div class="ibox-content">

        <center style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Ratings</h<?= $_SESSION['fontsize'] ?>></center>

        <br>
        <!-- Yes/No Dropdowns -->
        <?php $fields201 = ["SE Land"    => "$se_land",
                            "ME Land"    => "$me_land",
                            "SE Sea"     => "$se_sea",
                            "Me Sea"     => "$me_sea",
                            "Instrument" => "$instrument",
                            "CFI"        => "$cfi",
                            "CFII"       => "$cfii",
                            "MEI"        => "$mei",
                            "DPE"        => "$dpe",
                            "BGI"        => "$bgi",
                            "AGI"        => "$agi",
                            "Rotocraft"  => "$rotocraft",
                            "Glider"     => "$glider",
                            "Balloon"    => "$balloon",
                            "Airship"    => "$airship",    
                            "Drone"      => "$drone"                                                                     
                        ]; ?>

        <?php foreach($fields201 as $label=> $value) { ?>
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


    </div>  <!-- ibox-content -->
       
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

 <!--   <p> Right column create/update fields go here </p> -->  

    <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><h<?= $_SESSION['fontsize'] ?>><strong>Hall of Fame</strong></h<?= $_SESSION['fontsize'] ?>></label>

         <div class="col-sm-8"><input name="halloffame" type="text" class="form-control" value="<?= $hall_of_fame ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->
    <?php else: ?> 
        <!-- Yes/No Dropdowns -->
        <?php $fields203 = ["Hall of Fame" => "$hof"                                                                     
                        ]; ?>

        <?php foreach($fields203 as $label=> $value) { ?>
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

    <?php endif; ?> 
            <br>
        <!-- Yes/No Dropdowns -->
    <?php $fields4 = ["Active Duty"    => "$active_duty",
                      "Former Military"    => "$former_military",   
                      "Military Pilot"    => "$military_pilot"                                                                     
                    ]; ?>

    <?php foreach($fields4 as $label=> $value) { ?>
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

                               

    <div class="ibox-content">
        <center style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other Certificates & Certifications</h<?= $_SESSION['fontsize'] ?>></center>                                                    
                                                   
        <br>
                          
    <?php $fields200 = ["Other Crewmember"  => "$other_crewmember",  
                        "Other Cert Num"    => "$ocm_certnum",
                       ]; ?>

    <?php foreach($fields200 as $label=> $value) { ?> 
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?>
                                       
    <!-- Yes/No Dropdowns -->
        
    <?php $fields4 = ["A&P"    => "$ap"                                                                    
                    ]; ?>

    <?php foreach($fields4 as $label=> $value) { ?>
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

                          
    <?php $fields200 = ["A&P Num"  => "$ap_number"                       
                       ]; ?>

    <?php foreach($fields200 as $label=> $value) { ?> 
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?>
                                         
        <!-- Yes/No Dropdowns -->
    <?php $fields4 =  ["IA"           => "$ia",
                       "Military A&P" => "$military_maint",
                       "Maintenance"  => "$maintenance",
                       "ATC"          => "$atc",   
                       "Dispatcher"   => "$dispatcher"   
                    ]; ?>

    <?php foreach($fields4 as $label=> $value) { ?>
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
    
    <?php $fields200 = ["Other FAA Cert"  => "$other_faa_cert",  
                        "Other FAA Cert Num"    => "$ofc_certnum",
                       ]; ?>

    <?php foreach($fields200 as $label=> $value) { ?> 
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?>
                                        
    </div> <!-- ibox-content -->

<!-- *********************************************************************** -->
<!-- ****************** End Right Column of View Fields ******************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right view columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


  <!--  <p>Create/update fields outside row go here</p> -->
    <br>
    <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

         <div class="col-sm-8"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->
    <?php else: ?>                                 

        <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Credential Notes</h<?= $_SESSION['fontsize'] ?>></label>
            <div class="col-sm-12"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>"> <span class="form-text m-b-none"></span>
            </div>
        </div>
    <?php endif; ?> 


<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!-- Save button is same for all  -->
<br>
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
<!-- ********************* Left Column of View Fields ********************** -->
<!-- *********************************************************************** --> 


  <!--  <p>left column view fields go here</p> -->
                                                
    <div class="btn-group">

    <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
    <div>

    <!-- Passes a /1 to signify 1st tab to return to after edit/cancel/exit -->

    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php else: ?> 

    <?php endif; ?> 
</div>
                          
    <br>
    <br>

    <?php $itemsv200 = ["Highest Certificate" => "$highest_certificate",
                        "Highest Cert Number" => "$certificate_number",
                        "Total Time"          => "$total_time",
                        "Unverified"          => "$unverified"
                        ]; ?>           
            
    <?php foreach($itemsv200 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 


    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->
  
    
    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
      
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!-- Done -->
      
     

    <?php endif; ?>
        
        
<div class="ibox-content">  <!-- viewing  -->

    <center style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>>Ratings</h<?= $_SESSION['fontsize'] ?>></center>
    <br>

    <?php $itemsv203 = ["SE Land"    => "$se_land",
                        "ME Land"    => "$me_land",
                        "SE Sea"     => "$se_sea",
                        "ME Sea"     => "$me_sea",
                        "Instrument" => "$instrument",
                        "CFI"        => "$cfi",
                        "CFII"       => "$cfii",
                        "MEI"        => "$mei",
                        "DPE"        => "$dpe",
                        "BGI"        => "$bgi",
                        "AGI"        => "$agi",
                        "Rotocraft"  => "$rotocraft",
                        "Glider"     => "$glider",
                        "Balloon"    => "$balloon",
                        "Airship"    => "$airship",        
                        "Drone"      => "$drone"       
                        ]; ?>           
            
    <?php foreach($itemsv203 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                                                      
                                                    
 
</div>  <!-- ibox-content -->

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

  <!--  <p>right column view fields go here</p> -->
                                          <br>
                                          <br>
                                          <br>
                                          <br>
                                          
    <?php $itemsv202 = ["Hall of Fame"    => "$hall_of_fame",
                        "Active Duty"     => "$active_duty",
                        "Former Military" => "$former_military",
                        "Military Pilot"  => "$military_pilot"       
                        ]; ?>           
            
    <?php foreach($itemsv202 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                                            
    <?php if($_SESSION['fontsize'] == 1): ?> 

        <br> <!-- Done -->
        <br>
    <br>

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
      
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>

    <br> <!-- Done -->

     <?php endif; ?> 
                                                                                
    <div class="ibox-content">

          <center style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>>Other Certificates & Certifications</h<?= $_SESSION['fontsize'] ?>></center>
    <br>
    
    <?php $itemsv201 = ["Other Crewmember" => "$other_crewmember",
                        "Other Cert Num" => "$ocm_certnum",
                        "A&P" => "$ap",
                        "A&P Num" => "$ap_number",
                        "IA" => "$ia",
                        "Military A&P" => "$military_maint",
                        "Maintenance" => "$maintenance",
                        "ATC" => "$atc",
                        "Dispatcher" => "$dispatcher",
                        "Other FAA Cert" => "$other_faa_cert",
                        "Other FAA Cert Num" => "$ofc_certnum"       
                        ]; ?>           
            
    <?php foreach($itemsv201 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>         

    </div> <!-- ibox-content -->
       
<!-- *********************************************************************** -->
<!-- ****************** End Right Column of View Fields ******************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right view columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

  <!--  <p>view fields outside row go here</p> -->

    <!-- For formatting the notes field is outside of the row but inside the form -->
    <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
        <br>
    <?php else: ?>
        <br>    
    <?php $itemsv203 = ["Credential Notes (not visible to Member)" => "$cred_notes"
            
                        ]; ?>           
            
    <?php foreach($itemsv203 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>  
    <?php endif; ?>

<!-- *********************************************************************** -->
<!-- **************************** End Form ********************************* -->
<!-- If this is the only faq crud item or the last faq crud item -->
<!-- Must close the form otherwise comment out so the other items will post their values-->

 <!-- do not uncomment for inner item    </form> -->
<!-- *********************************************************************** --> 

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->
                     
