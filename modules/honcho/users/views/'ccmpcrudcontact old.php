<!-- *********************************************************************** -->
<!-- ****** Begin Boiler Plate for 1st CRUD Item containing Form Open ****** -->
<!-- *********************************************************************** -->
<style>
        .special {
  font-weight: bold !important;
  color: #fff !important;
  background: #bc0000 !important;
  text-transform: uppercase;
}
 </style>

 <!-- Language  -->

<?php if($_SESSION['language'] == 1): ?>

<?php elseif($_SESSION['language'] == 2): ?> 

<?php endif; ?> 

<div class="faq-item"> <!-- Ends at end of file -->

        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">

                    <div class="col-md-12">
                        <!-- #faq? must be unique but not in any order  -->
                        <center><a data-toggle="collapse" href="#faq1" class="faq-question" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-address-card-o fa-1x" style="color:LightBlue;"></i> Contact Information <i class="fa fa-caret-down fa-1x" style="color:LightBlue;"></i></h<?= $_SESSION['fontsize'] ?>></a></center>
                        
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['ccmp_active_window'] must be equal to #faq number  -->
                <?php if($_SESSION['ccmp_active_window'] == 1): ?>
                    <div id="faq1" class="panel-collapse">
                <?php else: ?>
                    <div id="faq1" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['ccmp_active_window'] == 1): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
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

<?php if($_SESSION['mobileformat'] == 1 ): ?>  <!-- fg = form group -->
    <?php   $fgdivclass     = 'form-group  row' ?>
    <?php   $fgseldiv       = 'col-sm-4' ?>  <!-- was 5  -->
    <?php   $yesnodiv       = 'col-sm-2' ?>      
    <?php   $labelclass     = 'col-sm-3 col-form-label' ?>
    <?php   $inputdivclass  = 'col-sm-4' ?>
    <?php   $inputstyle     = 'height: 35px; font-size: 15px;' ?> 
    <?php   $labelstyle     = 'color:cornflowerblue;' ?> 
    <?php   $valueclass     = 'col-sm-3' ?>
    <?php   $selectstyle    = 'height: 35px; font-size: 15px;' ?> 

<?php else: ?> 
    
    <?php if($_SESSION['fontsize'] == 1 ): ?> <!-- Largest Font h1  -->
        <?php   $fgdivclass     = 'form-group  row' ?>                 <!-- form group tag for fields -->
        <?php   $fgseldiv       = 'col-sm-7' ?>                        <!-- col width of regular dropdown boxes  -->
        <?php   $yesnodiv       = 'col-sm-5' ?>                        <!-- col width of yes/no dropdown boxes  -->     
        <?php   $labelclass     = 'col-sm-4 col-form-label' ?>         <!-- col width of field labels  -->
        <?php   $inputdivclass  = 'col-sm-7' ?>                        <!-- col width of input boxes  -->
        <?php   $inputstyle     = 'height: 50px; font-size: 25px;' ?>  <!-- height of input boxes & fontsize -->
        <?php   $labelstyle     = 'color:cornflowerblue;' ?>           <!-- label color -->
        <?php   $valueclass     = 'col-sm-6' ?>                        <!-- Value widths (may be different from view section) -->
        <?php   $selectstyle    = 'height: 50px; font-size: 28px;' ?>  <!-- height of regular dropdown boxes & fontsize  -->

    <?php elseif($_SESSION['fontsize'] == 2): ?> <!-- Medium Font h2  -->

        <?php   $fgdivclass     = 'form-group  row' ?>
        <?php   $fgseldiv       = 'col-sm-5' ?>
        <?php   $yesnodiv       = 'col-sm-5' ?>      
        <?php   $labelclass     = 'col-sm-4 col-form-label' ?>
        <?php   $inputdivclass  = 'col-sm-6' ?>
        <?php   $inputstyle     = 'height: 40px; font-size: 20px;' ?> 
        <?php   $labelstyle     = 'color:cornflowerblue;' ?> 
        <?php   $valueclass     = 'col-sm-6' ?>
        <?php   $selectstyle    = 'height: 40px; font-size: 20px;' ?>
    
    <?php elseif($_SESSION['fontsize'] == 3): ?> <!-- Smallest Font h3  -->
        <?php   $fgdivclass     = 'form-group  row' ?>
        <?php   $fgseldiv       = 'col-sm-7' ?>                        <!-- col width of regular dropdown boxes  -->
        <?php   $yesnodiv       = 'col-sm-4' ?>                        <!-- col width of yes/no dropdown boxes  -->     
        <?php   $labelclass     = 'col-sm-4 col-form-label' ?>         <!-- col width of field labels  -->
        <?php   $inputdivclass  = 'col-sm-7' ?>                        <!-- col width of input boxes  -->
        <?php   $inputstyle     = 'height: 35px; font-size: 15px;' ?> 
        <?php   $labelstyle     = 'color:cornflowerblue;' ?> 
        <?php   $valueclass     = 'col-sm-6' ?>   
        <?php   $selectstyle    = 'height: 35px; font-size: 15px;' ?>
    <?php endif; ?>
<?php endif; ?>

<?php if($_SESSION['mobileformat'] == 1 ): ?>  <!-- fg = form group -->
<!--  default --> <?php $vfgdivclass  = 'form-group row' ?>   <!-- Class of the label/value combo  -->
<!--  default --> <?php $vlabelclass  = 'col-lg-4' ?>         <!-- Width of the label column  -->
<!--  default --> <?php $vlabelstyle  = 'color:cornflowerblue;' ?> <!-- Style of the view labels  -->
<!--  default --> <?php $vvalueclass1 = 'col-sm-5' ?>         <!-- Width of value column  -->           
<!--  default --> <?php $vvalueclass2 = 'col-sm-7' ?>         <!-- Width of value column  --> 

<?php else: ?>

    <?php if($_SESSION['fontsize'] == 1 ): ?> <!-- Largest Font h1  -->
        <?php   $vfgdivclass     = 'form-group  row' ?>                 <!-- form group tag for fields -->   
        <?php   $vlabelclass     = 'col-sm-4 col-form-label' ?>         <!-- col width of field labels  -->
        <?php   $vlabelstyle     = 'color:cornflowerblue;' ?>           <!-- label color -->
        <?php   $vvalueclass1    = 'col-sm-6' ?>                        <!-- Value widths -->
        <?php   $vvalueclass2    = 'col-sm-6' ?> 

    <?php elseif($_SESSION['fontsize'] == 2): ?> <!-- Medium Font h2  -->

        <?php   $vfgdivclass     = 'form-group  row' ?>
        <?php   $vlabelclass     = 'col-sm-4 col-form-label' ?>
        <?php   $vlabelstyle     = 'color:cornflowerblue;' ?> 
        <?php   $vvalueclass1    = 'col-sm-5' ?>
        <?php   $vvalueclass2    = 'col-sm-5' ?>     
    
    <?php elseif($_SESSION['fontsize'] == 3): ?> <!-- Smallest Font h3  -->
        <?php   $vfgdivclass     = 'form-group  row' ?>     
        <?php   $vlabelclass     = 'col-sm-3 col-form-label' ?>
        <?php   $vlabelstyle     = 'color:cornflowerblue;' ?> 
        <?php   $vvalueclass1    = 'col-sm-5' ?>
        <?php   $vvalueclass2    = 'col-sm-5' ?> 

    <?php endif; ?>
<?php endif; ?> 
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
            
    <?php if($_SESSION['fontsize'] == 1): ?> 

        <div class="col-md-6"> <!-- Done -->

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <div class="col-md-6"> <!-- Done -->

    <?php elseif($_SESSION['fontsize'] == 3):  ?>

        <div class="col-md-5"> <!-- Done -->
            
     <?php endif; ?>             
            
           
<!-- *********************************************************************** -->
<!-- ****************** Left Column Create/Update Fields ******************* -->
<!-- *********************************************************************** -->                 


 <!--  <p> Left column create/update fields go here </p> -->
 <br> 
 
<!-- All labels must be unique because they double as names for input fields for $_POST (extracted in _ccmps_fetch_data_from_post() line)-->
<?php $items1 = ["Prefix" => "$salutation"]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _ccmps_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($items1 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>  

<?php $items1b = [
                
                "First <a style='color:Red;'>*</a>" => "$first_name"]; ?>


<?php foreach($items1b as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>"required>
        </div>
    </div>
<?php } ?> 

<?php $items2 = [
                
                "Middle" => "$middle_name"]; ?>


<?php foreach($items2 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>">
        </div>
    </div>
<?php } ?> 

<?php $items3 = [
                "Last <a style='color:Red;'>*</a>"   => "$last_name"]; ?>


<?php foreach($items3 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
        </div>
    </div>
<?php } ?>

<?php $items4 = [
                
                "Suffix" => "$suffix"]; ?>


<?php foreach($items4 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>">
        </div>
    </div>
<?php } ?>




<!-- Ex. BEFORE   <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>1stPrefix</h<?= $_SESSION['fontsize'] ?>></label>

            <div class="<= $inputdivclass ?>"><input style="<= $inputstyle ?>" name="salutation" type="text" class="form-control" value="<?= $salutation ?>" ></div>
        </div> -->

<!--  These are hidden fields to pass values back to the $_POST array that this type of user is not allowed to edit but needed for a create since they were initialization defaults passed to the form-->

        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>  <!-- The ccmp is not allowed to change these values but needed for a create since they were initialization defaults passed to the form -->

        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="membernumber" type="text" class="form-control" value="<?= $member_no ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="currentyear" type="text" class="form-control" value="<?= $current_year ?>" hidden></div>
        </div>

        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="member_type" type="text" class="form-control" value="<?= $member_type ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong>Eligible Voter</strong></label>

             <div class="col-sm-8"><input name="eligiblevoter" type="text" class="form-control" value="<?= $eligible_voter ?>" hidden></div>
        </div>
                <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="status" type="text" class="form-control" value="<?= $status ?>" hidden></div>
        </div>
<!-- END -- How to handle not updatable by still pass current value to the save -->

        <?php else: ?> <!-- Everyone else except the ccmp himself (admins).  Which admins is controlled by whether or not they have access to the menu item  -->


<?php if($_SESSION['chapter_role'] == 1 || $_SESSION['chapter_role'] == 4): ?> 

<?php $items5 = ["Member Number" => "$member_no"
                ]; ?>

<?php foreach($items5 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>  

<?php $items5b = ["Current Year"   => "$current_year"
                ]; ?>

<?php foreach($items5b as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>  



<?php else: ?> <!-- If the fields are not shown their current values will not be passed back to the controller cusing an error  -->
               <!-- Capture their current values ato be passsed back unchanged  -->

        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="membernumber" type="text" class="form-control" value="<?= $member_no ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->

        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="currentyear" type="text" class="form-control" value="<?= $current_year ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->

        <!-- How to handle not updatable but still pass current value to the save   -->
     <!--    <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="member_type" type="text" class="form-control" value="<?= $member_type ?>" hidden></div>
        </div> -->
        <!-- END --How to handle not updatable by still pass current value to the save   -->

<?php endif; ?>

        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Member Type <a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="member_type" style="<?= $selectstyle ?>" >
        <!-- Loop through the dropdown array passed in $data  -->
        <?php foreach($membertypes as $row) { ?>
        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->id == $member_type): ?> 
                <option selected value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
            <?php endif; ?>
         <?php } ?>                                    
         </select>
        </div>
        </div> 

        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong><?= $status ?></strong></label>

             <div class="col-sm-8"><input name="status" type="text" class="form-control" value="<?= $status ?>" hidden></div>
        </div>

<!-- EX. BEFORE   <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>uMember Number</h<?= $_SESSION['fontsize'] ?>></label>

                 <div class="col-sm-4"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>"></div>
            </div>
 -->

                                                                                                                                 
        <?php endif; ?>            

<?php $items6 = ["Email <a style='color:Red;'>*</a>" => "$email_address",  
                "Phone"  => "$phone",
                "Mobile"  => "$mobile",
                "Fax"  => "$fax"

                ]; ?>

<?php foreach($items6 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

    <!--     <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Email<a style="color:Red;" required>*</a></h<?= $_SESSION['fontsize'] ?>></label>

             <div class="col-sm-8"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" placeholder='[Not required for student members S or Q]' ></div>
        </div>
        <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Phone</h<?= $_SESSION['fontsize'] ?>></label>

            <div class="col-sm-8"><input name="phone" type="text" class="form-control" value="<?= $phone ?>" ></div>
        </div>  
        <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Mobile</h<?= $_SESSION['fontsize'] ?>></label>

            <div class="col-sm-8"><input name="mobile" type="text" class="form-control" value="<?= $mobile ?>" ></div>
        </div> 

        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Fax</h<?= $_SESSION['fontsize'] ?>></label>

            <div class="<?= $valueclass ?>"><input name="fax" type="text" class="form-control" value="<?= $fax ?>" ></div>
        </div> -->

<!-- Yes/No Dropdowns -->

<?php $items7 = ["Restricted Access" => "$vip",
                 "Directory Opt Out" => "$directoryoptout",
                 "Email Opt Out" => "$emailoptout",
                 "Do Not Call" => "$donotcall",
                 "Mail Newsletter" => "$mail_notices",
                 "Eligible Voter" => "$eligible_voter"                                                                     
                ]; ?>

<?php foreach($items7 as $label=> $value) { ?>
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




<?php $items8 = ["Alternate Contact" => "$alternate_contact",
                 "Alternate Phone"   => "$alternate_phone",
                 "Alternate Email"   => "$alternate_email"
                ]; ?>

<?php foreach($items8 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 
 

<!-- Spacing above the mailing address box -->


    <?php if($_SESSION['fontsize'] == 1): ?> 

        <br> <!-- Done -->
        <br>        
        <br>
        <br>
        <br>
         
    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br>  <!-- Done -->
        <br>
        <br>        
  

    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br>  <!-- Done -->
        <br>
        <br>  

     <?php endif; ?> 



            <div class="ibox-content">
                <center style="<?= $labelstyle ?>"><strong><h<?= $_SESSION['fontsize'] ?>>Mailing Address</h<?= $_SESSION['fontsize'] ?>></strong></center>



    <?php if($_SESSION['fontsize'] == 1): ?> 

        <br> <!-- Done -->
        <br>
        <br>        
        <br>
        <br>

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br>  <!-- Done -->
        <br>
        <br>   
        <br>
        <br>
      
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br>  <!-- Done -->
        <br>
        <br>   
        <br>
        <br>

     <?php endif; ?> 

                
                


<?php $items9 = ["Mail Addr1" => "$mailaddress1",
                "Mail Addr2" => "$mailaddress2",  
                "Mail City"  => "$mailcity"
                ]; ?>

<?php foreach($items9 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>                 
                                      
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Mail State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="mailstate" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->state_code == $mailstatecode): ?> <!-- was$ culid -->
               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->

<?php $items10 = ["Mail Zip" => "$mailzip"
                ]; ?>

<?php foreach($items10 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!--  if you want the zipcode box to be short use this one instead
        <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Mail Zip</h<?= $_SESSION['fontsize'] ?>></label>
            <div class="col-sm-2"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" style="<?= $inputstyle ?>" ></div>
        </div> -->



    </div>
       
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


 <!--   <p> Right column create/update fields go here </p>  --> 



            <br>

            <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mmdu'):  ?>

            <div class="col-sm-2"><input name="chapter" type="text" class="form-control" value="<?= $chapter ?>" hidden></div>

            <?php else: ?>  
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

            <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>

    <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="<?= $fgseldiv ?>"><input name="chapter_role" type="text" class="form-control" value="<?= $chapter_role ?>" hidden></div>
        </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>  
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?> Role<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="chapter_role" style="<?= $selectstyle ?>">
                <!-- Loop through the dropdown array passed in $data  -->
                <?php foreach($chapterroles as $row) { ?>
                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                    <?php if($row->id == $chapter_role): ?> 
                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                    <?php else: ?> <!-- otherwise just create the option -->
                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                    <?php endif; ?>
                 <?php } ?>                                    
                 </select>
                </div>
                </div>
           <?php endif; ?> 

        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>

    <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" ><strong></strong></label>

             <div class="col-lg-7"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
        </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>  
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>National Officer<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="national_officer" style="<?= $selectstyle ?>">
                <!-- Loop through the dropdown array passed in $data  -->
                <?php foreach($nationalroles as $row) { ?>
                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                    <?php if($row->id == $national_officer): ?> 
                        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
                    <?php else: ?> <!-- otherwise just create the option -->
                        <option value="<?= $row->id ?>"><?= $row->description ?></option>
                    <?php endif; ?>
                 <?php } ?>                                    
                 </select>
                </div>
                </div>
         <?php endif; ?>

        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-2"><input name="studentadmin" type="text" class="form-control" value="<?= $student_admin ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->
            <?php else: ?>

<!-- Yes/No Dropdowns - You need a separate one for each because of the hidden values-->

<?php $items11 = ["Student Admin" => "$student_admin"
                ]; ?>

<?php foreach($items11 as $label=> $value) { ?>
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

        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="chapteradmin" type="text" class="form-control" value="<?= $chapter_admin ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>

<!-- Yes/No Dropdowns -->
<?php $items12 = ["Chapter Admin" => "$chapter_admin"
                ]; ?>

<?php foreach($items12 as $label=> $value) { ?>
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


            <?php if($_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momu' ): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
    <!--     <div class="<?= $fgdivclass ?>"> -->
      <!--      <label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

            <div class="col-sm-8"><input name="contentmanager" type="text" class="form-control" value="<?= $content_mgr ?>" hidden></div>
    <!--    </div> -->
        <!-- END --How to handle not updatable by still pass current value to the save   -->
            <?php else: ?>

<!-- Yes/No Dropdowns -->
<?php $items13 = ["Content Manager" => "$content_mgr"
                ]; ?>

<?php foreach($items13 as $label=> $value) { ?>
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

        <?php if($_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momu'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
     <!--    <div class="<?= $fgdivclass ?>"> -->
       <!--     <label class="col-sm-2 col-form-label" hidden><strong></strong></label> -->

             <div class="col-sm-8"><input name="memberadmin" type="text" class="form-control" value="<?= $member_admin ?>" hidden></div>
     <!--   </div> -->
        <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>

<!-- Yes/No Dropdowns -->
<?php $items14 = ["Member Admin" => "$member_admin"
                ]; ?>

<?php foreach($items14 as $label=> $value) { ?>
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

        <!-- Only a system admin can create another system admin -->
        
        <?php if($_SESSION['system_admin'] == 1) : ?>
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>System Admin</h<?= $_SESSION['fontsize'] ?>></label>
                  <div class="<?= $yesnodiv ?>"><select class="form-control m-b" name="systemadmin" Value="<?= $system_admin ?>" style="<?= $selectstyle ?>" >
                    <?php if($system_admin == 1) { ?>
                        <option selected value=1>Yes</option>
                        <option value=0>No</option>
                    <?php }else{ ?>
                        <option value=1>Yes</option>
                        <option selected value=0>No</option>
                    <?php } ?>
                    </select>
                   </div>                                              
                </div>
        <?php else: ?>  

                <!-- Non Editable Yes/No  -->
                
                <?php $items112 = ["System Admin" => "$system_admin"
                                ]; ?>        

                <?php foreach($items112 as $label=> $value) { ?> 

                    <?php if($value == 1) {
                        $value = "Yes";
                   }else{
                        $value = "No";
                   } ?>
                        
                    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
                        <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
                    </div>


                <?php } ?>         
                <!-- How to handle not updatable but still pass current value to the save   -->
  
                <div class="col-sm-8"><input name="systemadmin" type="text" class="form-control" value="<?= $system_admin ?>" hidden></div>
     
                <!-- END --How to handle not updatable by still pass current value to the save   -->

         <?php endif; ?> 

        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Gender<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="gender" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
        <?php foreach($genders as $row) { ?>
        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->id == $gender): ?> 
                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
            <?php endif; ?>
         <?php } ?>                                    
         </select>
        </div>
        </div> 

<?php $items15 = ["Call Sign" => "$call_sign",
                 "Birthday" => "$birthday"
                ]; ?>

<?php foreach($items15 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!-- Yes/No Dropdowns ??? so why not separarate for each for hidden values-->
<?php $items16 = ["Minor" => "$minor",
                 "Aircraft Owner" => "$aircraft_owner"
                ]; ?>

<?php foreach($items16 as $label=> $value) { ?>
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

            <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Aircraft Type<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="aircraft_type" style="<?= $selectstyle ?>">
            <!-- Loop through the dropdown array passed in $data  -->
            <?php foreach($aircrafttypes as $row) { ?>
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                <?php if($row->id == $aircraft_type): ?> 
                    <option selected value="<?= $row->id ?>"><?= $row->type ?> [<?= $row->manufacturer ?> <?= $row->name ?>]</option>
                <?php else: ?> <!-- otherwise just create the option -->
                    <option value="<?= $row->id ?>"><?= $row->type ?> [<?= $row->manufacturer ?> <?= $row->name ?>]</option>
                <?php endif; ?>
             <?php } ?>                                    
             </select>
            </div>
            </div>

<?php $items17 = ["Aircraft Reg"     => "$aircraft_reg",  
                 "Miscellaneous 1"   => "$misc1",
                 "Miscellaneous 2"   => "$misc2",
                 "Miscellaneous 3"   => "$misc3",
                 "Emergency Contact" => "$emergency_contact",
                 "Emergency Phone"   => "$emergency_phone",
                 "Emergency Email"   => "$emergency_email"
                ]; ?>

<?php foreach($items17 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 


            <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="col-sm-8"><input name="deceased" type="text" class="form-control" value="<?= $deceased ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->
            <?php else: ?>
    <!-- Yes/No Dropdowns -->

<?php $items18 = ["Deceased" => "$deceased"                                                                     
                ]; ?>

<?php foreach($items18 as $label=> $value) { ?>
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
    
        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous1" type="text" class="form-control" value="<?= $misc1 ?>" hidden></div>
            </div>
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous2" type="text" class="form-control" value="<?= $misc2 ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous3" type="text" class="form-control" value="<?= $misc3 ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>

            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous3" type="text" class="form-control" value="<?= $misc3 ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>

        <!-- END --How to handle not updatable by still pass current value to the save   -->

    <?php endif; ?>

<!-- Spacing above the physical address box -->

    <?php if($_SESSION['fontsize'] == 1): ?> 

    <br> <!-- Done -->



    <?php elseif($_SESSION['fontsize'] == 2):  ?>


    <?php elseif($_SESSION['fontsize'] == 3):  ?>


     <?php endif; ?> 




    <div class="ibox-content">
    <center style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Physical Address</h<?= $_SESSION['fontsize'] ?>></center>
    <br>
    <br>

<!-- Yes/No Dropdowns -->
<?php $items19 = ["Same as Mailing" => "$mail_phys "
                ]; ?>

<?php foreach($items19 as $label=> $value) { ?>
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

<?php $items20 = ["Physical Addr1" => "$physaddress1",
                "Physical Addr2"  => "$physaddress2",  
                "Physical City"   => "$physcity"
                ]; ?>

<?php foreach($items20 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>                 
                                      
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Physical State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="physstate" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->state_code == $physstatecode): ?> <!-- was$ culid -->
               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->

<?php $items21 = ["Physical Zip" => "$physzip"
                ]; ?>

<?php foreach($items21 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!-- *********************************************************************** -->
<!-- ****************** End Right Column Create/Update Fields Fields ******************** -->       
       </div> <!-- end ibox content -->        
    </div> <!-- column 6 --> 
</div><!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

 <!--   <p>Create/update fields outside row go here</p> -->
   <br>
    <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

         <div class="col-sm-8"><input name="notes" type="text" class="form-control" value="<?= $notes ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->
    <?php else: ?>                                 

        <div ><label class="col-sm-12 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Contact Notes</h<?= $_SESSION['fontsize'] ?>></label>        </div>
            <div class="col-sm-12"><input style="<?= $inputstyle ?>"  name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span>
            </div>

    <?php endif; ?> 


<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<br>

    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
        <div>
        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
        <div> 
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><i class="fa fa-save"><h<?= $_SESSION['fontsize'] ?>></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>                                        

    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
        <div>
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
        <div>
        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>

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

<!-- *********************************************************************** -->
<!-- ******************* Update/Exit Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

    <div class="btn-group">

    <?php if($_SESSION['ccmpmode'] == 'viewmydata'): ?>
    <div>

    <!-- Passes a /1 to signify 1st tab to return to after edit/cancel/exit -->

    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php else: ?> 

    <?php endif; ?> 
</div>

<!-- *********************************************************************** -->

<!-- ********************* Left Column of View Fields ********************** -->
<!-- *********************************************************************** --> 

            <br>
            <br>

<?php $itemsv100 = ["Prefix"        => "$salutation",  
                    "First"             => "$first_name",
                    "Middle"            => "$middle_name",
                    "Last"              => "$last_name",
                    "Suffix"            => "$suffix",
                    "Member Number"     => "$member_no",
                    "Member Type"       => "$member_type",  
                    "Status"            => "$status", 
                    "Current Year"      => "$current_year",     
                    "Email"             => "$email_address",
                    "Phone"             => "$phone",
                    "Mobile"            => "$mobile",
                    "Fax"               => "$fax",
                    "Restricted Access" => "$vip",
                    "Opt Out Directory" => "$directoryoptout",
                    "Opt Out Emails"    => "$emailoptout",
                    "Do Not Call"       => "$donotcall",
                    "Mail Newsletter"   => "$mail_notices",
                    "Eligible Voter"    => "$eligible_voter",
                    "Alternate Contact" => "$alternate_contact",
                    "Alternate Phone"   => "$alternate_phone",
                    "Alternate Email"   => "$alternate_email",  
                    "Date Created"      => "$created_at", 
                    "Created By"        => "$created_by"
                    ]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _ccmps_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($itemsv100 as $label=> $value) { ?> 

    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
    </div>

<?php } ?>              
                                               
                                       
    <!-- Spacing above the mailing address box -->


    <?php if($_SESSION['fontsize'] == 1): ?> 

        <br> <!--  Done  -->
        <br>


    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <!--  Done  -->
<br>
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <!--  Done  -->

    <?php endif; ?> 
        
    <div class="ibox-content">
        
    <center  style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><strong>Mailing Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
    <br>
    
    <?php $itemsv101 = ["Address 1" => "$mailaddress1",
                        "Address 2" => "$mailaddress2",
                        "City"      => "$mailcity",
                        "State"     => "$mailstate",
                        "Zip"       => "$mailzip"
                        ]; ?>           
            
    <?php foreach($itemsv101 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>             

            </div>

<!-- *********************************************************************** -->
<!-- ******************* End Left Column of View Fields ******************** -->
        </div> <!-- end col-6 -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Right Column of View Fields ********************* -->
        <div class="col-md-6">
<!-- *********************************************************************** --> 


 <!--   <p>right column view fields go here</p> -->

    <br>
    <br>

    <?php $itemsv102 = ["Chapter"           => "$chapter",
                        "Chapter Role"      => "$chapter_role",
                        "National Role"     => "$national_officer",
                        "Student Admin"     => "$student_admin",
                        "Chapter Admin"     => "$chapter_admin",
                        "Content Manager"   => "$content_mgr",
                        "Member Admin"      => "$member_admin",
                        "System Admin"      => "$system_admin",
                        "Gender"            => "$gender",
                        "Call Sign"         => "$call_sign",
                        "Birthday"          => "$birthday",
                        "Minor"             => "$minor",
                        "Aircraft Owner"    => "$aircraft_owner",
                        "Aircraft Type"     => "$aircraft_type",
                        "Aircraft Reg"      => "$aircraft_reg",
                        "Miscellaneous 1"   => "$misc1",
                        "Miscellaneous 2"   => "$misc2",
                        "Miscellaneous 3"   => "$misc3",
                        "Emergency Contact" => "$emergency_contact",
                        "Emergency Phone"   => "$emergency_phone",
                        "Emergency Email"   => "$emergency_email",
                        "Deceased"          => "$deceased",
                        "Last Update"       => "$updated_at",
                        "Updated By"        => "$updated_by"
                        ]; ?>           
            
    <?php foreach($itemsv102 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 
    
        
    <!-- Vertical spacing above physical address box depending on font size  -->
    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!--  Done  -->
        <br> 
        <br> 
        <br>  
         <br>
    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!--  Done  -->
        <br> 
        <br>       

    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!--  Done  -->
        <br> 
    

    <?php endif; ?>  

    <div class="ibox-content">
    <center style="<?= $vlabelstyle ?>"><strong><h<?= $_SESSION['fontsize'] ?>>Physical Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
    <br>
            
    <?php $itemsv102 = ["Address 1" => "$physaddress1",
                        "Address 2" => "$physaddress2",
                        "City"      => "$physcity",
                        "State"     => "$physstate",
                        "Zip"       => "$physzip"
                        ]; ?>           
            
    <?php foreach($itemsv102 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>  
            </div>           

<!-- *********************************************************************** -->
<!-- ****************** End Right Column of View Fields ******************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right view columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


 <!--   <p>view fields outside row go here</p> -->
    <!-- For formatting the notes field is outside of the row but inside the form -->
    <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
        <br>
    <?php else: ?>
        <br>    
    <?php $itemsv103 = ["Notes (not visible to Member)" => "$notes"
            
                        ]; ?>           
            
    <?php foreach($itemsv103 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>  
    <?php endif; ?>

<!-- *********************************************************************** -->
<!-- **************************** End Form ********************************* -->
<!-- If this is the only faq crud item or the last faq crud item -->
<!-- Must close the form therwise comment out so the other items will post their values-->

    </form>
<!-- *********************************************************************** --> 

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->
                     