
<!-- *********************************************************************** -->
<!-- ****** Begin Boiler Plate for 1st CRUD Item containing Form Open ****** -->
<!-- *********************************************************************** -->
 <!--
    <?php if(DEBUGGING == true): ?> 
 <?php
    echo('$_SESSION');
    echo('<br>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
 <?php endif; ?> -->
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



<div class="ibox-content"> <!-- ibox for page header -->
        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">

                    <div class="col-md-12">
                        <!-- #faq? must be unique but not in any order - insert XXX to stop toggling closed -->
            <?php if($_SESSION['user_role_id'] == 6): ?>
              <center><a data-toggle="collapse" href="XXX#faq1" class="faq-question" style="color: <?= USERS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= USERS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-address-card-o fa-1x fa-1x"></i></span><strong> My Profile</strong> <!-- <i class="fa fa-unsorted fa-1x" style="color: <?= USERS_HM_TAB_CARET_CLR ?>;"></i> --> </h2>  </a> </center>            
            <?php else: ?>             
              <center><a data-toggle="collapse" href="XXX#faq1" class="faq-question" style="color: <?= USERS_HM_TAB_TITLE_CLR ?>;"> <h2><span style="color: <?= USERS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-address-card-o fa-1x fa-1x"></i></span><strong> <?= $prefix ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?>   <?= $suffix ?> Profile</strong> <!-- <i class="fa fa-unsorted fa-1x" style="color: <?= USERS_HM_TAB_CARET_CLR ?>;"></i> --> </h2>  </a> </center>
            <?php endif; ?>


                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['user_active_window'] must be equal to #faq number  -->
                <?php if($_SESSION['user_active_window'] == 1): ?>
                    <div id="faq1" class="panel-collapse">
                <?php else: ?>
                    <div id="faq1" class="panel-collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['USER_active_window'] == 1): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
   <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php endif; ?>
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
    <?php   $fgseldiv       = 'col-sm-6' ?>                         <!-- col width of regular dropdown boxes  -->
    <?php   $yesnodiv       = 'col-sm-6' ?>                         <!-- col width of yes/no dropdown boxes  -->     
    <?php   $labelclass     = 'col-sm-4 col-form-label' ?>          <!-- Width between labels & input boxes in update/create mode  -->
    <?php   $inputdivclass  = 'col-sm-6' ?>                         <!-- col width of input boxes  -->
    <?php   $inputstyle     = 'height: 40px; font-size: 20px;' ?> 
    <?php   $labelstyle     = 'color:cornflowerblue;' ?> 
    <?php   $valueclass     = 'col-sm-6' ?>
    <?php   $selectstyle    = 'height: 40px; font-size: 20px;' ?>   <!-- height of regular dropdown boxes & fontsize  -->
    
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
    <?php   $vlabelstyle     = 'color:darkgreen;' ?>           <!-- label color -->
    <?php   $vvalueclass1    = 'col-sm-6' ?>                        <!-- Value widths -->
    <?php   $vvalueclass2    = 'col-sm-6' ?> <!-- not used  -->

    <?php elseif($_SESSION['fontsize'] == 2): ?> <!-- Medium Font h2  -->

    <?php   $vfgdivclass     = 'form-group  row' ?>
    <?php   $vlabelclass     = 'col-sm-5 col-form-label' ?>
    <?php   $vlabelstyle     = 'color:darkgreen;' ?>
    <?php   $vinputdivclass  = 'col-sm-7' ?>     <!-- not used  -->                   <!-- col width of input boxes  -->
    <?php   $vvalueclass1    = 'col-sm-7' ?>
    <?php   $vvalueclass2    = 'col-sm-5' ?>     <!-- not used  -->
    
    <?php elseif($_SESSION['fontsize'] == 3): ?> <!-- Smallest Font h3  -->
    <?php   $vfgdivclass     = 'form-group  row' ?>     
    <?php   $vlabelclass     = 'col-sm-3 col-form-label' ?>
    <?php   $vlabelstyle     = 'color:darkgreen;' ?> 
    <?php   $vvalueclass1    = 'col-sm-5' ?>
    <?php   $vvalueclass2    = 'col-sm-5' ?> <!-- not used  -->

    <?php endif; ?>
<?php endif; ?> 
<!-- *********************************************************************** -->
<!-- ********************* Begin Create/Update Section ********************* -->
<!-- *********************************************************************** -->

<!-- Member (mmd-manage.my.data)c/u, CA (mom-manage.our.members) c/u, SA (mos-manage.our.students)c/u, MCM (mcm-manage.current.members)c/u ??? , MAM (mam-manage.all.members) c/u   -->
<?php if($_SESSION['actionmode'] == 'updateuser' || $_SESSION['actionmode'] == 'updatemydata' || $_SESSION['actionmode'] == 'createuser' || $_SESSION['managemode'] == 'momu'  || $_SESSION['managemode'] == 'mosc' || $_SESSION['managemode'] == 'mosu' || $_SESSION['managemode'] == 'mcmc' || $_SESSION['managemode'] == 'mcmu' || $_SESSION['managemode'] == 'mamc' || $_SESSION['managemode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!-- **************************** Begin Form ******************************* -->
<!-- Form to post the create/update form values - the view is also contained in the form -->
<!-- The first faq item must contain the form open and the last item the form close -->
<!-- *********************************************************************** -->

 <!--   <form  method = "post" action="<?= BASE_URL ?>honcho-users/usersubmit/<?= $recid ?>"> -->
        
<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->


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

<!--
    All needed values to edit, create, or validate a record were passed to
    this form to either visible or hidden controls.
     
    Hidden controls are ones the user cannot, because of role or should not
    because they are system controlled, edit - but may be needed to validate.
       
    The posted values were named with the unique update/create field labels 
    concatenated and with spaces, asterisks, or underscores removed by the form.
    
    Cannot simply use the db field names as control names because the form may
    have fields from several tables with the same name combined with the fact 
    that fields are named on the fly using a loop as the controls are dynamically
    created.
-->

 <!--  <p> Left column create/update fields go here </p> -->
 <br> 

     <div class="ibox-content text-box">
         
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><strong><?= HONCHOUSER  ?> Info</strong></h<?= $_SESSION['fontsize'] ?>></center>
    </div> 
         <br>
       
<!-- All labels must be unique because they double as names for input fields for $_POST (extracted in _USERS_fetch_data_from_post() line)-->
<?php $items1 = ["Employee Id" => "$id_number",
                "Prefix" => "$prefix"]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _USERS_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($items1 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>; "><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
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
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
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
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
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
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
        </div>
    </div>
<?php } ?>

<?php $items4 = [
                
                "Suffix" => "$suffix"];
                ?>


<?php foreach($items4 as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>">
        </div>
    </div>
<?php } ?>

<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Gender<span style="color:Red;">*</span></h<?= $_SESSION['fontsize'] ?>></label>
<div class="<?= $fgseldiv ?>"><select class="form-control" name="gender" style="<?= $selectstyle ?>">
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

<?php $items15 = ["Birthday"   => "$birthday",                
                  "Employer"   => "$employer",
                  "Title"      => "$title",
                  "Department" => "$department",
                  "Supervisor" => "$reports_to"
                ]; ?>

<?php foreach($items15 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!-- Yes/No Dropdowns -->
<?php $items16 = [
                  "Minor"           => "$minor",
                  "Student"         => "$student",
                  "Alumnus"         => "$alumnus",
                  "Active Duty"     => "$active_duty",
                  "Former Military" => "$former_military"
                ]; ?>
<!-- "Eligible Voter"  => "$eligible_voter"  not for HONCHOUSER to edit -->
<?php foreach($items16 as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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


            <?php if($_SESSION['managemode'] == 'mngsubentity' || $_SESSION['managemode'] == 'momu' || $_SESSION['managemode'] == 'updatemydata'):  ?>

            <div class="col-sm-2"><input name="subentity" type="text" class="form-control" value="<?= $subentity ?>" hidden></div>

            <?php else: ?>  
                <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

<!-- Ex. Treasurer/sysadmin can assign chapter to a new member including Chapter at Large  -->
                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?><a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="subentity" style="<?= $selectstyle ?>">
                    <!-- Loop through the dropdown array passed in $data  -->
                    <?php foreach($subentities as $row) { ?>
                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                        <?php if($row->id == $subentity): ?> 
                            <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                        <?php else: ?> <!-- otherwise just create the option -->
                            <option value="<?= $row->id ?>"><?= $row->title ?></option>
                        <?php endif; ?>
                     <?php } ?>                                    
                     </select>
                    </div>
                    </div>

                <?php else: ?> <!-- Adding/Creating  -->

                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?><a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="subentity" style="<?= $selectstyle ?>">
                    <!-- Loop through the dropdown array passed in $data  -->
                    <?php foreach($subentities as $row) { ?>
                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                        <?php if($row->id == $subentity): ?> 
                            <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                        <?php else: ?> <!-- otherwise just create the option -->
                            <option value="<?= $row->id ?>"><?= $row->title ?></option>
                        <?php endif; ?>
                     <?php } ?>                                    
                     </select>
                    </div>
                    </div>

             <?php endif; ?> 
            <?php endif; ?> 

            <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>

    <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

             <div class="<?= $fgseldiv ?>"><input name="subentity_role" type="text" class="form-control" value="<?= $subentity_role ?>" hidden></div>
        </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>  
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?> Role<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="subentity_role" style="<?= $selectstyle ?>">
                <!-- Loop through the dropdown array passed in $data  -->
                <?php foreach($subentityroles as $row) { ?>
                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                    <?php if($row->id == $subentity_role): ?> 
                        <option selected value="<?= $row->id ?>"><?= $row->title ?></option>
                    <?php else: ?> <!-- otherwise just create the option -->
                        <option value="<?= $row->id ?>"><?= $row->title ?></option>
                    <?php endif; ?>
                 <?php } ?>                                    
                 </select>
                </div>
                </div>
           <?php endif; ?> 

        <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>

    <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" ><strong></strong></label>

             <div class="col-lg-7"><input name="nationalofficer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
        </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->

            <?php else: ?>
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= HONCHOUSER ?> Type <a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
                <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="idtype" style="<?= $selectstyle ?>" >
                <!-- Loop through the dropdown array passed in $data  -->
                <?php foreach($usertypes as $row) { ?>
                <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                    <?php if($row->id == $id_type): ?> 
                        <option selected value="<?= $row->id ?>"><?= $row->id_type ?> <?= $row->user_type ?></option>
                    <?php else: ?> <!-- otherwise just create the option -->
                        <option value="<?= $row->id ?>"><?= $row->id_type ?> <?= $row->user_type ?></option>
                    <?php endif; ?>
                 <?php } ?>                                    
                 </select>
                </div>
                </div>     
    
                <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Officer Type<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
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
    
    
<!--  These are hidden fields to pass values back to the $_POST array that this type of user is not allowed to edit but needed for a create since they were initialization defaults passed to the form-->

        <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>  

            <!-- The ccmp is not allowed to change these values but needed for validations/creates/etc. Are initialized from DB (update) or defaults (new Rec) then passed to this form -->
            <!-- These values are passed back to _USERS_fetch_data_from_post() around line 3300 -->
            
            <div class="col-sm-8"><input name="id" type="text" class="form-control" value="<?= $id ?>" hidden></div> 

            <div class="col-sm-8"><input name="idtype" type="text" class="form-control" value="<?= $id_type ?>" hidden></div>
            
            <div class="col-sm-8"><input name="idnumber" type="text" class="form-control" value="<?= $id_number ?>" hidden></div>

            <div class="col-sm-8"><input name="deceased" type="text" class="form-control" value="<?= $deceased ?>" hidden></div>
            
            <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" hidden></div>
            <div class="col-sm-8"><input name="locked" type="text" class="form-control" value="<?= $locked ?>" hidden></div> 
            <div class="col-sm-8"><input name="inactive" type="text" class="form-control" value="<?= $inactive ?>" hidden></div>
            <div class="col-sm-8"><input name="forcepwchg" type="text" class="form-control" value="<?= $force_pw_chg ?>" hidden></div>
    <div class="col-sm-8"><input name="timedreset" type="text" class="form-control" value="<?= $timed_reset ?>" hidden></div>

            <!-- replace with a date picker!  -->
            <div class="col-sm-8"><input name="dob" type="text" class="form-control" value="<?= $dob ?>" hidden></div>
                         
        <!-- How to handle not updatable but still pass current value to the save      

             <div class="col-sm-8"><input name="activatecode" type="text" class="form-control" value="<?= $activate_code ?>" hidden></div>
     
             <div class="col-sm-8"><input name="approved" type="text" class="form-control" value="<?= $approved ?>" hidden></div>

             <div class="col-sm-8"><input name="code" type="text" class="form-control" value="<?= $code ?>" hidden></div>

             <div class="col-sm-8"><input name="admin" type="text" class="form-control" value="<?= $admin ?>" hidden></div>

             <div class="col-sm-8"><input name="cmsadmin" type="text" class="form-control" value="<?= $cms_admin ?>" hidden></div>

           

             <div class="col-sm-8"><input name="currentyear" type="text" class="form-control" value="<?= $current_year ?>" hidden></div>


             <div class="col-sm-8"><input name="createdat" type="text" class="form-control" value="<?= $created_at ?>" hidden></div>

             <div class="col-sm-8"><input name="createdby" type="text" class="form-control" value="<?= $created_by ?>" hidden></div>

             <div class="col-sm-8"><input name="datecreated" type="text" class="form-control" value="<?= $date_created ?>" hidden></div>

             <div class="col-sm-8"><input name="deceased" type="text" class="form-control" value="<?= $deceased ?>" hidden></div>

             <div class="col-sm-8"><input name="dob" type="text" class="form-control" value="<?= $dob ?>" hidden></div>

             <div class="col-sm-8"><input name="emailverified" type="text" class="form-control" value="<?= $email_verified ?>" hidden></div>

        

             <div class="col-sm-8"><input name="fontsize" type="text" class="form-control" value="<?= $fontsize ?>" hidden></div>

          

          

             <div class="col-sm-8"><input name="inactive" type="text" class="form-control" value="<?= $inactive ?>" hidden></div>

             <div class="col-sm-8"><input name="ipaddress" type="text" class="form-control" value="<?= $ip_address ?>" hidden></div>

             <div class="col-sm-8"><input name="lastlogin" type="text" class="form-control" value="<?= $last_login ?>" hidden></div>

             <div class="col-sm-8"><input name="lastlogindevice" type="text" class="form-control" value="<?= $last_login_device ?>" hidden></div>

             <div class="col-sm-8"><input name="lastlogout" type="text" class="form-control" value="<?= $last_logout ?>" hidden></div>

             <div class="col-sm-8"><input name="leadsource" type="text" class="form-control" value="<?= $leadsource ?>" hidden></div>

             <div class="col-sm-8"><input name="locked" type="text" class="form-control" value="<?= $locked ?>" hidden></div>

             <div class="col-sm-8"><input name="numlogins" type="text" class="form-control" value="<?= $num_logins ?>" hidden></div>

             <div class="col-sm-8"><input name="picture" type="text" class="form-control" value="<?= $picture ?>" hidden></div>

             <div class="col-sm-8"><input name="region" type="text" class="form-control" value="<?= $region ?>" hidden></div>

             <div class="col-sm-8"><input name="resetinterval" type="text" class="form-control" value="<?= $reset_interval ?>" hidden></div>

             <div class="col-sm-8"><input name="resetcode" type="text" class="form-control" value="<?= $reset_code ?>" hidden></div>

             <div class="col-sm-8"><input name="secondfactor" type="text" class="form-control" value="<?= $second_factor ?>" hidden></div>

             <div class="col-sm-8"><input name="deleted" type="text" class="form-control" value="<?= $soft_deleted ?>" hidden></div>

             <div class="col-sm-8"><input name="student" type="text" class="form-control" value="<?= $student ?>" hidden></div>

             <div class="col-sm-8"><input name="studentadmin" type="text" class="form-control" value="<?= $student_admin ?>" hidden></div>

             <div class="col-sm-8"><input name="subentity" type="text" class="form-control" value="<?= $subentity ?>" hidden></div>

             <div class="col-sm-8"><input name="subentityadmin" type="text" class="form-control" value="<?= $subentity_admin ?>" hidden></div>

             <div class="col-sm-8"><input name="subentityrole" type="text" class="form-control" value="<?= $subentity_role ?>" hidden></div>

             <div class="col-sm-8"><input name="systemadmin" type="text" class="form-control" value="<?= $system_admin ?>" hidden></div>

             <div class="col-sm-8"><input name="status" type="text" class="form-control" value="<?= $status ?>" hidden></div>

             <div class="col-sm-8"><input name="tfontsize" type="text" class="form-control" value="<?= $tfontsize ?>" hidden></div>

         
             <div class="col-sm-8"><input name="trongateuserid" type="text" class="form-control" value="<?= $trongate_user_id ?>" hidden></div>

             <div class="col-sm-8"><input name="updatedat" type="text" class="form-control" value="<?= $updated_at ?>" hidden></div>

             <div class="col-sm-8"><input name="updatedby" type="text" class="form-control" value="<?= $updated_by ?>" hidden></div>

             <div class="col-sm-8"><input name="usertoken" type="text" class="form-control" value="<?= $user_token ?>" hidden></div>



             <div class="col-sm-8"><input name="vip" type="text" class="form-control" value="<?= $vip ?>" hidden></div>

             <div class="col-sm-8"><input name="mailcounty" type="text" class="form-control" value="<?= $mailcounty ?>" hidden></div>

             <div class="col-sm-8"><input name="mailcountry" type="text" class="form-control" value="<?= $mailcountry ?>" hidden></div>

             <div class="col-sm-8"><input name="physicalcounty" type="text" class="form-control" value="<?= $mailcounty ?>" hidden></div>

             <div class="col-sm-8"><input name="physicalcountry" type="text" class="form-control" value="<?= $mailcountry ?>" hidden></div>
   -->       
<!-- END -- How to handle not updatable by still pass current value to the save -->

        <?php else: ?> <!-- Everyone else except the ccmp himself (admins).  Which admins is controlled by whether or not they have access to the menu item  -->
       
            <div class="col-sm-8"><input name="id" type="text" class="form-control" value="<?= $id ?>" hidden></div> 
            <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" hidden></div> 
   <!--         <div class="col-sm-8"><input name="id_number" type="text" class="form-control" value="<?= $id_number ?>" hidden></div> -->

                <?php if($_SESSION['USERS_subentity_role'] == 1 || $_SESSION['USERS_subentity_role'] == 4): ?> 

                <?php $items5 = ["Id Number"    => "$id_number"
                                ]; ?>

                <?php foreach($items5 as $label=> $value) { ?> 
                    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
                    <?php $inputname = str_replace(' ', '', $inputname); ?> 
                    <?php $inputname = strtolower($inputname); ?>
                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
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
                    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
                        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
                        </div>
                    </div>
                <?php } ?>  



                <?php else: ?> <!-- If the fields are not shown their current values will not be passed back to the controller causing an error  -->
                       <!-- Capture their current values ato be passsed back unchanged  -->

                <!-- How to handle not updatable but still pass current value to the save   -->
                 <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                     <div class="col-sm-8"><input name="idnumber" type="text" class="form-control" value="<?= $id_number ?>" hidden></div>
                </div>
                <!-- END --How to handle not updatable by still pass current value to the save   -->

                <!-- How to handle not updatable but still pass current value to the save   -->
                 <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                     <div class="col-sm-8"><input name="currentyear" type="text" class="form-control" value="<?= $current_year ?>" hidden></div>
                </div>
                <!-- END --How to handle not updatable by still pass current value to the save   -->

                <!-- How to handle not updatable but still pass current value to the save   -->
             <!--    <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                     <div class="col-sm-8"><input name="idtype" type="text" class="form-control" value="<?= $id_type ?>" hidden></div>
                </div> -->
                <!-- END --How to handle not updatable by still pass current value to the save   -->

                <?php endif; ?>



                    <!-- Yes/No Dropdowns -->

<?php $items18 = ["Deceased" => "$deceased"                                                                     
                ]; ?>

<?php foreach($items18 as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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
                                                                                                                       
        <?php endif; ?> <!-- end admin  -->            
<!-- Both user & Admin   -->

    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><strong>Contact Info</strong></h<?= $_SESSION['fontsize'] ?>></center>
    </div> 
<br>
<?php $items6a = ["Email <a style='color:Red;'>*</a>" => "$email_address"             
                ]; ?>

<?php foreach($items6a as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
        </div>
    </div>
<?php } ?> 

<?php $items6 = [  
                "Phone"            => "$phone",
                "Work Phone"       => "$work_phone",
                "Mobile"           => "$mobile",
                "WhatsApp"         => "$whatsapp",
                "Fax"              => "$fax",
                "TTY"              => "$tty",
                "Website"          => "$website",
                "Alternate Contact" => "$alternate_contact",
                "Alternate Phone"   => "$alternate_phone",
                "Alternate Email"   => "$alternate_email"              
                ]; ?>

<?php foreach($items6 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

                <!-- Yes/No Dropdowns -->
<?php $items19 = [  "Use Alt Contact"  => "$use_alt_contact"
                 
                ]; ?>

<?php foreach($items19 as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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


<?php $items8 = ["Emergency Contact" => "$emergency_contact",
                 "Emergency Phone"   => "$emergency_phone",
                 "Emergency Email"   => "$emergency_email"
                ]; ?>

<?php foreach($items8 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>                


 

     </div> <!-- End ibox content  -->




 

<!-- Spacing above the mailing address box -->


    <?php if($_SESSION['fontsize'] == 1): ?> 

        <br> <!-- Done -->
        <br>        
        <br>
        <br>
        <br>
         
    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br>  <!-- Done -->
       
  

    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br>  <!-- Done -->
        <br>
        <br>  

     <?php endif; ?> 



       
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

          


        <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>
        <!-- How to handle not updatable but still pass current value to the save   -->
         <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label> 

             <div class="col-sm-2"><input name="studentadmin" type="text" class="form-control" value="<?= $student_admin ?>" hidden></div>
        </div>
        <!-- END --How to handle not updatable by still pass current value to the save   -->
            <?php else: ?>
        <!-- How to handle not updatable but still pass current value to the save   -->

             <div class="col-sm-2"><input name="studentadmin" type="text" class="form-control" value="<?= $student_admin ?>" hidden></div>
             <div class="col-sm-2"><input name="admin" type="text" class="form-control" value="<?= $admin ?>" hidden></div>
             <div class="col-sm-2"><input name="contentadmin" type="text" class="form-control" value="<?= $contentadmin ?>" hidden></div>
             <div class="col-sm-2"><input name="useradmin" type="text" class="form-control" value="<?= $useradmin ?>" hidden></div>
        
        

           
      <?php endif; ?>
    
        <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>
    
        <!-- How to handle not updatable but still pass current value to the save   
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous1" type="text" class="form-control" value="<?= $misc1 ?>" hidden></div>
            </div>
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous2" type="text" class="form-control" value="<?= $misc2 ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous3" type="text" class="form-control" value="<?= $flags ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>

            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                 <div class="col-sm-8"><input name="miscellaneous3" type="text" class="form-control" value="<?= $flags ?>" hidden></div>
            </div>

             <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="national_officer" type="text" class="form-control" value="<?= $national_officer ?>" hidden></div>
            </div>
        
        
        
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="force_pw_change" type="text" class="form-control" value="<?= $force_pw_change ?>" hidden></div>
            </div>

            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="inactive" type="text" class="form-control" value="<?= $inactive ?>" hidden></div>
            </div>
            <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                <div class="col-sm-8"><input name="locked" type="text" class="form-control" value="<?= $locked ?>" hidden></div>
            </div>
 
        END --How to handle not updatable by still pass current value to the save   -->

    <?php endif; ?>

<!-- Spacing above the physical address box -->

    <?php if($_SESSION['fontsize'] == 1): ?> 

    <br> <!-- Done -->



    <?php elseif($_SESSION['fontsize'] == 2):  ?>


    <?php elseif($_SESSION['fontsize'] == 3):  ?>


     <?php endif; ?> 


   

    <div class="ibox-content">
        
                <center style="<?= $labelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><strong><h<?= $_SESSION['fontsize'] ?>>Mailing Address</h<?= $_SESSION['fontsize'] ?>></strong></center>

                <br>

<?php $items9 = ["Mailing Addr1 <a style='color:green;'>*</a>"  => $mailaddrdata->address1,
                "Mailing Addr2"   => $mailaddrdata->address2,  
                "Mailing City"    => $mailaddrdata->city
                ]; ?>

<?php foreach($items9 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:green;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>                 
                                      
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Mailing State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select id="mailingstate" type="text" class="form-control m-b" name="mailingstate" onchange="FetchMailCounties(this.value)" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->fips == $mailaddrdata->mailstatefips): ?> <!-- -->
               <option selected value="<?php echo $row->state_code ?>"><?= $row->name ?> </option> <!-- -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?php echo $row->state_code ?>"><?= $row->name ?> </option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->

<?php $items10 = ["Mailing Zip" => $mailaddrdata->zip
                ]; ?>

<?php foreach($items10 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!--  if you want the zipcode box to be short use this one instead
        <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Mail Zip</h<?= $_SESSION['fontsize'] ?>></label>
            <div class="col-sm-2"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" style="<?= $inputstyle ?>" ></div>
        </div> -->

       <!-- county code -->
        <div class="col-sm-8"><input name="orgmailingcounty" type="text" class="form-control" value="<?= $mailaddrdata->mailcntyfips ?>" hidden></div>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Mailing County</h<?= $_SESSION['fontsize'] ?>></label>  
        <div class="<?= $fgseldiv ?>">
                <select  class="form-control m-b" id="mailcounty" name="mailingcounty" style="<?= $selectstyle ?>">

                   <option style="<?= $selectstyle ?>"></option> 
                                   
                </select>   
           
        </div> 
        </div>
        <!-- end county code -->
        
        <!-- country code -->
        
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Mailing Country</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="mailingcountry" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($country_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->alpha3 == $mailaddrdata->mailcntrycode): ?> <!-- was$ culid -->
               <option selected value="<?= $row->alpha3 ?>"><?= $row->name ?> <?= $row->alpha3 ?></option> <!-- $row->level_title -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->alpha3 ?>"><?= $row->name ?> <?= $row->alpha3 ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end country code -->

      <br>   
    <center style="<?= $labelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Physical Address</h<?= $_SESSION['fontsize'] ?>></center>
    <br>
   

<!-- Yes/No Dropdowns -->
<?php $items19 = ["Same as Mailing" => "$mail_eq_phys"
                ]; ?>

<?php foreach($items19 as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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

<?php $items20 = ["Physical Addr1" => $physaddrdata->address1,
                "Physical Addr2"   => $physaddrdata->address2,  
                "Physical City"    => $physaddrdata->city
                ]; ?>

<?php foreach($items20 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:green;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>                 
                                      
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Physical State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select id="physicalstate" type="text" class="form-control m-b" name="physicalstate" onchange="FetchPhysCounties(this.value)" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->fips == $physaddrdata->physstatefips): ?> <!-- -->
               <option selected value="<?php echo $row->state_code ?>"><?= $row->name ?> </option> <!-- -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?php echo $row->state_code ?>"><?= $row->name ?> </option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->

<?php $items21 = ["Physical Zip" => $physaddrdata->zip
                ]; ?>

<?php foreach($items21 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

        <!-- county code -->
        <div class="col-sm-8"><input name="orgphysicalcounty" type="text" class="form-control" value="<?= $physaddrdata->physcntyfips ?>" hidden></div>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Physical County</h<?= $_SESSION['fontsize'] ?>></label>  
        <div class="<?= $fgseldiv ?>">
                <select  class="form-control m-b" id="physcounty" name="physicalcounty" style="<?= $selectstyle ?>">

                   <option style="<?= $selectstyle ?>"></option> 
                                   
                </select>   
           
        </div> 
        </div>
        <!-- end county code -->

        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Physical Country</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="physicalcountry" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($country_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->alpha3 == $physaddrdata->physcntrycode): ?> <!-- was$ culid -->
               <option selected value="<?= $row->alpha3 ?>"><?= $row->name ?> <?= $row->alpha3 ?></option> <!-- $row->level_title -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->alpha3 ?>"><?= $row->name ?> <?= $row->alpha3 ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end country code -->
     
       </div> <!-- end ibox content -->
       
       <br>
            <div class="ibox-content">
               <center style="<?= $labelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><strong><h<?= $_SESSION['fontsize'] ?>>Preferences</h<?= $_SESSION['fontsize'] ?>></strong></center>    
               <br>
               
 <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Language<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
<div class="<?= $fgseldiv ?>"><select class="form-control" name="language" style="<?= $selectstyle ?>">
<!-- Loop through the dropdown array passed in $data  -->
<?php foreach($languages as $row) { ?>
<!-- If $row->id = currently selected user_level_id then pre-select that option -->
    <?php if($row->id == $language): ?> 
        <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
    <?php else: ?> <!-- otherwise just create the option -->
        <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
    <?php endif; ?>
 <?php } ?>                                    
 </select>
</div>
</div> 
     
<!-- Yes/No Dropdowns -->

<?php $items7x = ["Limit Dir Info"   => "$limit_dir_info",
                 "Directory Opt Out" => "$directoryoptout",
                 "Email Opt Out"     => "$emailoptout",
                 "Do Not Call"       => "$donotcall",
                 "Mail Notices"      => "$mail_notices"   
                ]; ?>

<?php foreach($items7x as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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


    </div> 
       <br>
<div class="ibox-content">
               <center style="<?= $labelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><strong><h<?= $_SESSION['fontsize'] ?>>Miscellaneous</h<?= $_SESSION['fontsize'] ?>></strong></center>    
               <br>    
<?php $items17 = [
                 "Miscellaneous 1"   => "$misc1",
                 "Miscellaneous 2"   => "$misc2",
                 "Flags"   => "$flags"  
               


                ]; ?>

<?php foreach($items17 as $label=> $value) { ?> 
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

        </div>  
<div class="ibox-content">
               <center style="<?= $labelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><strong><h<?= $_SESSION['fontsize'] ?>>User Account</h<?= $_SESSION['fontsize'] ?>></strong></center>    
               <br>     
<?php $items17x = ["Force PW Chg"   => "$force_pw_chg",
                 "Locked" => "$locked",
                 "Inactive"          => "$inactive"   
                ]; ?>

<?php foreach($items17x as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label> 
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
        </div>
    </div> <!-- column 6 --> 
 <!-- *********************************************************************** -->
<!-- ****************** End Right Column Create/Update Fields Fields ******************** -->     
</div><!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

 <!--   <p>Create/update fields outside row go here</p> -->
   
    <?php if($_SESSION['actionmode'] == 'updatemydata'): ?>
    <!-- How to handle not updatable but still pass current value to the save   -->
     <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

         <div class="col-sm-8"><input name="notes" type="text" class="form-control" value="<?= $notes ?>" hidden></div>
    </div>
    <!-- END --How to handle not updatable by still pass current value to the save   -->
    <?php else: ?>                                 

        <div ><label class="col-sm-12 col-form-label" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Private Notes (not visible by <?= HONCHOUSER ?>)</h<?= $_SESSION['fontsize'] ?>></label>        </div>
            <div class="col-sm-12"><input style="<?= $inputstyle ?>"  name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span>
            </div>

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

<div class="row">
 
                <div class="col-lg-12">
                    <div class="tabs-container">
 <?php if($_SESSION['USERS_VIEW_TABS_HORZ'] == 1): ?> 
                        
               <?php else: ?>
                                  <div class="tabs-left">
                                     
                <?php endif; ?> 
<ul class="nav nav-tabs">
    <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= HONCHOUSER  ?> Info</h<?= $_SESSION['fontsize'] ?>></span></a></li>
    <li><a class="nav-link" data-toggle="tab" href="#tab-2"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Contacts</h<?= $_SESSION['fontsize'] ?>></span></a></li>
    <li><a class="nav-link" data-toggle="tab" href="#tab-3"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Addresses</h<?= $_SESSION['fontsize'] ?>></span></a></li>                                
    <li><a class="nav-link" data-toggle="tab" href="#tab-4"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous</h<?= $_SESSION['fontsize'] ?>></span></a></li>
    <li><a class="nav-link" data-toggle="tab" href="#tab-5"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Preferences</h<?= $_SESSION['fontsize'] ?>></span></a></li>
    <li><a class="nav-link" data-toggle="tab" href="#tab-6"><span  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_TAB_TITLE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>User Account</h<?= $_SESSION['fontsize'] ?>></span></a></li>
    <li><a href="<?= BASE_URL ?>honcho-users/updateuser/<?= $recid ?>/1" style="color: <?= USERS_HM_TAB_ICON_CLR ?>"><h<?= $_SESSION['fontsize'] ?>><span style="color: <?= USERS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-pencil fa-1x fa-1x"></i></span> Update</h<?= $_SESSION['fontsize'] ?>> </a>
<!-- Next line calls a php modal in Navbar.php which call ajax function in template/views/inspinia.php which calls the fontsize function in the users controller -->
 <!--   <li><a data-toggle="modal" data-target="#fontModal" style="color: coral"><h<?= $_SESSION['fontsize'] ?>><span style="color: <?= USERS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-wrench fa-1x fa-1x"></i></span> Font [<span style="color: lightgray"><?= $_SESSION['fontname'] ?></span>]</h<?= $_SESSION['fontsize'] ?>></a></li> -->
                           </ul>

                            <div class="tab-content ">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body"> 
                                   <!--     <center>xxx</center> -->


<!-- <div class="ibox-content text-box"> -->
<!-- <div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><strong><?= HONCHOUSER  ?> Info</strong></h<?= $_SESSION['fontsize'] ?>></center>
    </div>
    </div>     -->  
<div class="row"> 
    
    <div class="col-sm-4">          
         
<?php $itemsv100 = ["Name"        => "",  
                    ]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. -->
<!-- The input's name="xyz" field passes back the changed values from the form to _USERS_fetch_data_from_post() in the $_POST array -->
<!-- and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run.-->
<!-- Therefore the name fields here do not have to match the name in the database because the functions does that mapping. -->
<!-- This is important because we are only passing two values (label name and the elements value) but a third, -->
<!-- the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

         
<?php foreach($itemsv100 as $label=> $value) { ?> 
        
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>

    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $prefix ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?></h<?= $_SESSION['fontsize'] ?>>  </div> 
    </div> 
 
<?php } ?> 
    
   
<?php $itemsv100A = [
                    SUBENTITY       => "$subentity",
                    "Officer"       => "$subentity_role",
                    "Region"        => "$region",
                    "HQ Officer"    => "$national_officer",
                    "Employer"      => "$employer",
                    "Title"         => "$title" 
                    ]; ?>
       
<?php foreach($itemsv100A as $label=> $value) { ?> 
 

    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
       
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>
 
<?php } ?>

    <?php $itemsv102B1 = ["Alumnus"   => "$alumnus"
                       
                        ]; ?>           

       
    <?php foreach($itemsv102B1 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>
               
    </div> <!-- end col -->
    <div class="col-sm-4"> 

<?php $itemsv100B = [ 
                   
                    "Gender"     => "$gender",
                    "DoB"        => "$dob",
                    "Minor"      => "$minor",
                    "Student"    => "$student",
                    "Birthday"   => "$birthday",
                    "Department" => "$department",
                    "Supervisor" => "$reports_to"
                    ]; ?>
       
<?php foreach($itemsv100B as $label=> $value) { ?> 
 

    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
   
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div> 
 
<?php } ?>        

            <?php $itemsv102B2 = [
                        "Fmr Military"   => "$former_military"
                        ]; ?>           

       
    <?php foreach($itemsv102B2 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>
               
        
   </div> <!-- end col --> 
   <div class="col-sm-4">
<?php $itemsv100B = [HONCHOUSER." Id"    => "$id_number",
                    HONCHOUSER." Type"       => "$id_type",  
                    HONCHOUSER." Status"     => "$status", 
                    "Current Year"     => "$current_year",
                    "Eligible Voter"   => "$eligible_voter",
                    "Active Duty"      => "$active_duty"
                     
                    ]; ?>


            
<?php foreach($itemsv100B as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>       
   </div> <!-- end col --> 
           
</div>  <!-- end row -->          
              
<!-- </div> --><!-- end ibox content  --> 
                </div> <!-- End Panel Body  -->
            </div> <!-- id tab 1  -->
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                                        
                                        
                                         
<div class="row">
    
    <div class="col-sm-5">          
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Primary Contact</h<?= $_SESSION['fontsize'] ?>></center>         
    </div>
</div> 
<?php $itemsv100C = [
                    "Home"     => "$phone",
                    "Work"     => "$work_phone",
                    "Mobile"   => "$mobile",
                    "WhatsApp" => "$whatsapp",
                    "Email"    => "$email_address",
                    "Fax"      => "$fax",
                    "TTY"      => "$tty",
                    "Use Alt Contact"  => "$use_alt_contact"
                    ]; ?>         
            
<?php foreach($itemsv100C as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>
    </div> <!-- end col -->

    
    <div class="col-sm-7"> 
<?php $itemsv100G = [
                    "Alternate"  => "$alternate_contact",
                    "Phone"      => "$alternate_phone",
                    "Email"      => "$alternate_email"

                    ]; ?>


<div class="row">
    <div class="col">  
  <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Secondary Contacts</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>         
<div class="row">
    <div class="col-lg-6">  
        
        
<?php foreach($itemsv100G as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>
    </div> <!-- end col -->
    <div class="col-lg-6">
        
 <?php $itemsv100H = [
                    "Emergency" => "$emergency_contact",
                    "Phone"   => "$emergency_phone",
                    "Email"   => "$emergency_email"

                    ]; ?>       
        
<?php foreach($itemsv100H as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>        
    </div> <!-- end col --> 
</div>  <!-- end row --> 
                                                                       
        </div> <!-- end col 8 -->
    </div> <!-- end row -->
</div> <!-- end panel body  -->

 </div> <!-- end tab-2  tab-pane  -->
 
    <div id="tab-3" class="tab-pane">
       <div class="panel-body">
           
            <!-- Start A First Row  -->
            <div class="row">
                     
               <div class="col-lg-6"> <!-- First Row Left Column -->
                   
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Mailing Address</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>
                   
    <?php $itemsv101 = ["Address" => "$mailaddrdata->address1",
                        ""        => "$mailaddrdata->address2",
                        "City"    => "$mailaddrdata->city",
                        "State"   => "$mailaddrdata->state",
                        "Zip"     => "$mailaddrdata->zip",
                        "County"  => "$mailaddrdata->county",
                        "Country" => "$mailaddrdata->country"
                        ]; ?>           
            
    <?php foreach($itemsv101 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>
                     
<?php $itemsv101B = ["Physical = Mailing"   => "$mail_eq_phys"



                    ]; ?>

<?php foreach($itemsv101B as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>                      
               </div> <!-- end col 6 -->
                   <div class="col-lg-6"> <!-- First Row Right Column -->
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Physical Address</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>

                       
    <?php $itemsv102 = ["Address" => "$physaddrdata->address1",
                        "" => "$physaddrdata->address2",
                        "City"      => "$physaddrdata->city",
                        "State"     => "$physaddrdata->state",
                        "Zip"       => "$physaddrdata->zip",
                        "County"    => "$physaddrdata->county",
                        "Country"   => "$physaddrdata->country"
                        ]; ?>           
            
    <?php foreach($itemsv102 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                       
                       </div> <!-- end col 6 -->
                       
                       
                       
            </div> <!-- end first row parent -->
                       
            <br>
            <!-- Start A Second Row  -->
            <div class="row"> <!-- 2nd row Parent -->
           
                    
                    
 <?php if(strlen($billaddress1) > 0 ): ?>                   
                         <div class="col-lg-6"> <!-- Second Row Left Column -->
                             
                    
       
                                         
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Billing Address</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>
    <?php $itemsv111 = ["Address" => "$billaddress1",
                        "" => "$billaddress2",
                        "City"      => "$billcity",
                        "State"     => "$billstate",
                        "Zip"       => "$billzip"
                        ]; ?>           
            
    <?php foreach($itemsv111 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                             
                       </div> <!-- end Second Row Left Column col 6 -->
        <?php endif; ?>
                       
        <?php if(strlen($shipaddress1) > 0 ): ?>                        
                         <div class="col-lg-6"> <!-- Second Row Right Column -->
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Shipping Address</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>

<?php $itemsv101B = ["Shipping = Billing"   => "$bill_eq_ship"



                    ]; ?>

<?php foreach($itemsv101B as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>                              
                             
    <?php $itemsv112 = ["Address" => "$shipaddress1",
                        "" => "$shipaddress2",
                        "City"      => "$shipcity",
                        "State"     => "$shipstate",
                        "Zip"       => "$shipzip"
                        ]; ?>           
            
    <?php foreach($itemsv112 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                              
                       </div> <!-- end Second Row Right Column col 6 -->
        <?php endif; ?>
           
                       
                       
                      
            </div> <!-- end <!-- 2nd row Parent -->
       
       </div> <!-- end panel body  -->
   </div> <!-- end tab-3 tab-pane -->
   
    <div id="tab-4" class="tab-pane">
       <div class="panel-body">
           
           <div class="row"> <!-- First row Parent -->
           
               <div class="col-lg-6"> <!-- First Row Left Column -->           
<div class="row">
    <div class="col">  
<!--  <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Miscellaneous</h<?= $_SESSION['fontsize'] ?>></center> -->           
    </div>
</div>           

    <?php $itemsv102B = [ "Miscellaneous 1" => "$misc1",
                        "Miscellaneous 2"   => "$misc2",
                        "Flags"             => "$flags"
                        ]; ?>           

       
    <?php foreach($itemsv102B as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>
                   
                   
               </div> <!-- end First Row Left Column -->
               
                <div class="col-lg-6"> <!-- First Row Right Column -->
    <?php $itemsv102C = ["Last Updated"       => "$updated_at",
                        "Updated By"        => "$updated_by",
                        "Date Created"      => "$created_at", 
                        "Created By"        => "$created_by"
                        ]; ?>           

       
    <?php foreach($itemsv102C as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>                     
                </div> <!-- end First Row Right Column  -->
                
</div> <!-- end First Row Parent  -->
           
       </div> <!-- end panel body  -->
   </div> <!-- end tab-4 tab-pane -->

       <div id="tab-5" class="tab-pane">
       <div class="panel-body">
           
           <div class="row"> <!-- First row Parent -->
           
               <div class="col-lg-9"> <!-- First Row Left Column -->           
<!-- <div class="row">
    <div class="col">  
  <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Options</h<?= $_SESSION['fontsize'] ?>></center>            
    </div>
</div> -->                      

<?php $itemsv100DE = ["Limit Directory Info"=> "$limit_dir_info",
                     "Opt Out Directory"    => "$directoryoptout",
                     "Opt Out Emails"       => "$emailoptout",
                     "Do Not Call"          => "$donotcall",
                     "Mail Notices"         => "$mail_notices",
                     "Language"             => "$language"

                    ]; ?>

<?php foreach($itemsv100DE as $label=> $value) { ?> 
 
    <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $vvalueclass1 ?>" style="color:<?= USERS_CRUD_VALUE_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>  
    </div>
 
<?php } ?>          
 
 
               </div> <!-- end First Row Left Column -->
               
                <div class="col-lg-3"> <!-- First Row Right Column -->
<!-- content here  --> 
                </div> <!-- end First Row Right Column  -->
                
</div> <!-- end First Row Parent  -->
           
       </div> <!-- end panel body  -->
   </div> <!-- end tab-4 tab-pane -->
   <div id="tab-6" class="tab-pane">
       <div class="panel-body">

            <!-- Start A First Row  -->
            <div class="row">
                     
               <div class="col-lg-6"> <!-- First Row Left Column -->
                   
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Login Credentials</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>                    

                                   <div class="form-group row"><label class="col-lg-3 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>User Id</h<?= $_SESSION['fontsize'] ?>></label> 
                          <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $trongate_user_id ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-3" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Username</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $username ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-3" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Level</h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $levelname ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                    
                   
               </div> <!-- end col 6 -->
                   <div class="col-lg-6"> <!-- First Row Right Column -->
<div class="row">
 <div class="col-lg-3"> 
    </div>
 <div class="col-lg-6">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>User Roles</h<?= $_SESSION['fontsize'] ?>></center>        
 </div>
    <div class="col-lg-3"> 
    </div>

</div>
                       <!--
 <div class="row">

    <div class="col-lg-10"> 

<div class="form-group row"><label class="col-lg-6" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?> Admin</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $subentity_admin ?></h<?= $_SESSION['fontsize'] ?>></div> </div>

<div class="form-group row"><label class="col-lg-6" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Content Admin</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $cms_admin ?></h<?= $_SESSION['fontsize'] ?>></div> </div>

<div class="form-group row"><label class="col-lg-6" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= HONCHOUSER ?> Admin</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $admin ?></h<?= $_SESSION['fontsize'] ?>></div> </div>

<div class="form-group row"><label class="col-lg-6" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Student Admin</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $student_admin ?></h<?= $_SESSION['fontsize'] ?>></div> </div>

<div class="form-group row"><label class="col-lg-6" style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>System Admin</h<?= $_SESSION['fontsize'] ?>></label>
        <div class="col-sm-4"><h<?= $_SESSION['fontsize'] ?>><?= $system_admin ?></h<?= $_SESSION['fontsize'] ?>></div> </div>

      
        
        
        
    </div>

    </div>
 -->                        
                       </div> <!-- end col 6 -->
                       
                       
                       
            </div> <!-- end first row parent -->
                       
            <br>
            <!-- Start A Second Row  -->
            <div class="row"> <!-- 2nd row Parent -->                  
                         <div class="col-lg-6"> <!-- Second Row Left Column -->
                             
  
       
                                         
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Account Status</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>

<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Login Locked</h<?= $_SESSION['fontsize'] ?>></label>

    <?php if( $locked  > 0) { ?>
        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
    <?php }else{ ?>

        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
    <?php } ?>                                 
</div>  

<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Login Inactive</h<?= $_SESSION['fontsize'] ?>></label>

    <?php if( $inactive  > 0) { ?>
        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
    <?php }else{ ?>

        <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
    <?php } ?>                                 
</div>  

<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Force PW Change</h<?= $_SESSION['fontsize'] ?>></label>                                      
  <?php if( $force_pw_chg   > 0) { ?>
    <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
  <?php }else{ ?>

    <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
  <?php } ?>  
</div>                        
<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>IP Address</h<?= $_SESSION['fontsize'] ?>></label> 
    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ip_address ?></h<?= $_SESSION['fontsize'] ?>></div> 
</div> 
<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Login Token Expires</h<?= $_SESSION['fontsize'] ?>></label> 
    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $token_expires ?></h<?= $_SESSION['fontsize'] ?>></div> 
</div>
<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Reset Code</h<?= $_SESSION['fontsize'] ?>></label> 
    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $reset_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
</div>                                       
<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Activate Code</h<?= $_SESSION['fontsize'] ?>></label> 
    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $activate_code ?></h<?= $_SESSION['fontsize'] ?>></div> 
</div>  

<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Timed PW Reset</h<?= $_SESSION['fontsize'] ?>></label>                                       
  <?php if( $timed_reset   > 0) { ?>
    <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">Yes</div></h<?= $_SESSION['fontsize'] ?>>
  <?php }else{ ?>

    <h<?= $_SESSION['fontsize'] ?>><div class="col-sm-5">No</div></h<?= $_SESSION['fontsize'] ?>>
  <?php } ?>  
</div>

<div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Reset Interval (days)</h<?= $_SESSION['fontsize'] ?>></label> 
    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $reset_interval ?></h<?= $_SESSION['fontsize'] ?>></div> 
</div>  

                             
                       </div> <!-- end Second Row Left Column col 6 -->
                      
                         <div class="col-lg-6"> <!-- Second Row Right Column -->
<div class="row">
    <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= USERS_CRUD_IBOX_HDR_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Account Activity</h<?= $_SESSION['fontsize'] ?>></center>        
    </div>
</div>


    <div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Num Logins</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $num_logins ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>                                        
    <div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Last Login Device</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login_device ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div> 
    <div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Last Login</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_login ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>
    <div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Last Logout</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $last_logout ?></h<?= $_SESSION['fontsize'] ?>></div> 
    </div>
    <div class="form-group row"><label class="col-lg-5 " style="color:<?= USERS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Photo</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="col-sm-5" ><h<?= $_SESSION['fontsize'] ?>><?= $picture ?></h<?= $_SESSION['fontsize'] ?>> </div>
    </div>
               <form action="<?= BASE_URL ?>honcho-users/uploaduserpic/<?= $recid ?>/v" method = "post" enctype="multipart/form-data">                  
                       <input type="file" name="picture" value="">
    <button type="submit" name="submit" value="Upload">Upload Photo</button>
   
                       </div> <!-- end Second Row Right Column col 6 -->
    
           
                       
                       
                      
            </div> <!-- end <!-- 2nd row Parent -->          
        
       </div> <!-- end panel body  -->
   </div> <!-- end tab-6 tab-pane -->

   <div id="tab-7" class="tab-pane">
       <div class="panel-body">
           <!-- Content Here -->           
       </div> <!-- end panel body  -->
   </div> <!-- end tab-7 tab-pane -->
   
   <div id="tab-8" class="tab-pane">
       <div class="panel-body">
           <!-- Content Here -->           
       </div> <!-- end panel body  -->
   </div> <!-- end tab-8 tab-pane --> 
 </div> <!-- end tab content  -->


 <?php if($_SESSION['USERS_VIEW_TABS_HORZ'] == 1): ?> 
                       
<?php else: ?>
     </div> <!-- Tabs left -->
                                  
<?php endif; ?> 

        </div> <!-- Tabs container  -->                   

    </div> <!-- col 12  -->
</div> <!-- end tabs container for all tabs  -->



<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->


 <!--   <p>view fields outside row go here</p> -->
    <!-- For formatting the notes field is outside of the row but inside the form -->
    <?php if($_SESSION['actionmode'] == 'viewmydata'): ?>
        <br>
    <?php else: ?>
        <br>    
    <?php $itemsv103 = ["Private Notes" => "$notes"
            
                        ]; ?>           
<div class="ibox-content"><!-- text-box narrows the height and moves label eft  -->
    
    <?php foreach($itemsv103 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?>  
 </'div>       
        
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
</div>
<!-- From here down was added to change font size modal window  -->
<div class="modal inmodal" id="fontModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated rotateInDownRight">  <!-- rotateInDownRight, slideInRight,  bounceInRight, rotateIn, flip -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h3 class="modal-title"> <small><i class="fa fa-font fa-2x"></i></small> Fonts</h3>                   
                <strong><h2>Choose your desired font sizes:</h2></strong>
             
            </div> 
        <!-- Show flash message then reset it to blank  -->
   <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
        $flash_msg = '';
        set_flashdata($flash_msg); ?> no way to refresh modal to see the message -->
       <center><h3 id="result" ></h3></center>

            <form action="" method = "post">  
            <div class="modal-body">
                
                <div class="form-group"> <!-- Used to pass the recid to ajax function. It is the record of the session user since changing own record always  -->                   
                    <input type="text" class="form-control" name="recid" id="recid" value="<?= $_SESSION['user_rec_id'] ?>"  hidden>
                </div>
                <!--    <div class="row">
                        <div class="col-lg-8">
                        <label class="col-lg-6 col-form-label" style="color:CornFlowerBlue;"><h1>Enter:</h1></label>
                        </div>
                    </div> -->
<!--
                <ul>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h1>1 for Large</h1></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h2>2 for Medium</h2></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h3>3 for Small</h3></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h4>4 for X Small</h4></label> </li>                    
                </ul>  -->

                  
     <!--
                <div class="form-group row">
             <div class="col-lg-1">
             </div>
                    <div class="col-lg-6">
                        <label style="color:CornFlowerBlue;"><h2>For System Pages</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <p> <input type="text" class="form-control" name="fontsize" id="fontsize" value="<?= $_SESSION['fontsize'] ?>" placeholder="For Page Views" ></p>
                    </div>
                </div>
        
                <div class="form-group  row">
             <div class="col-lg-1">
             </div>                
                    <div class="col-lg-6">
                        <label  style="color:CornFlowerBlue;"><h2>For Tables & Lists</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                         <input type="text" class="form-control" name="mfontsize" id="mfontsize" value="<?= $_SESSION['mfontsize'] ?>" placeholder="For Page Views" >
                    </div>
                    
                </div> -->
               
                <!-- not passing value selected in inspinia templates js -->
        <!--     <h2>
                 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:CornFlowerBlue;"><h3>For Pages</h3></label></div> 
                <div><label><input type="radio"  value="1" id="fontsize1" name="fontsize"> Large </label></div>
                <div><label><input type="radio"  value="2" id="fontsize2" name="fontsize"> Medium </label></div>                                       
                <div><label><input type="radio"  value="3" id="fontsize3" name="fontsize"> Small </label></div>
                 <div><label><input type="radio"  checked="" value="4" id="fontsize4" name="fontsize"> X Small </label></div>
            </h2> -->
                                 <!-- not passing value selected in inspinia templates js -->
                <div class="form-group  row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">                
                        <h1>This is Large</h1>
                    </div>
                </div>
                <div class="form-group  row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">  
                         <h2>This is Medium</h2>
                    </div>
                </div>
                <br>
                <div class="form-group  row">
                    <div class="col-lg-3"></div>                    
                    <div class="col-lg-9">
                         <h3>This is Small</h3>
                    </div>
                </div>

                <br>                                                                                                                                                                               
                
                
                <div class="form-group  row">
          
                    <div class="col-lg-2"></div>

                    <div class="col-lg-4">
                        <label  style="color:CornFlowerBlue;"><h2>Select size:</h2></label>
                    </div>
                <div class="col-lg-4">
                <br>
         
                <select class="form-control m-b" name="fontsize" id="FontSel" value="<?= $_SESSION['fontsize'] ?>" style=" color: CornFlowerBlue; font-size:11pt" >
                     <?php if($_SESSION['fontsize'] == '1'): ?>
                         <option selected value=1>Large</option>
                         <option value='2'>Medium</option> 
                         <option value='3'>Small</option>
                       
                     <?php elseif($_SESSION['fontsize'] == '2'): ?>
                         <option value='1'>Large</option>
                         <option selected value='2'>Medium</option> 
                         <option value='3'>Small</option>
                                                                        
                     <?php elseif($_SESSION['fontsize'] == '3'): ?>
                         <option value='1'>Large</option>
                         <option value='2'>Medium</option> 
                         <option selected value='3'>Small</option>
                   
                     <?php endif; ?> 

                </select>
                                           
             
                     </div>
                </div>

            <br>
            <center><h3>You may need to refresh the page after submitting</h3></center>

            </div>
            <div class="modal-footer">
                <h2><input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="FontID" id="FontBtn" ></input></h2> <!-- Passes posted data to template inspinia.php js at bottom  -->
                 <h2><button type="button" class="btn btn-warning full-width m-b" data-dismiss="modal">Cancel</button></h2>

            </div>
          </form>

        </div> 
      </div>
    </div>
 
<script>
                $("#FontBtn").click(function(){
             //   var nfontsize  = $("#fontsize").val();
                var nfontsize  = document.getElementById("FontSel").value;
            //    var nmfontsize = document.getElementById("MFontSel").value;
                var sarecid    = $("#recid").val();
alert('683');
//alert(nfontsize);
//alert(sarecid);
                    $.ajax({
                  
                        url:'<?= BASE_URL ?>welcome-ccmps/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,recid:sarecid}, 
                      //  data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid}, 
                      //  dataType: "json",  // if wanted to pass to php function fontsize()
              //   as json object and not input. As json could send to node.js or API

                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#fontsize").val("");
                                $("#mfontsize").val("");
                                $("#recid").val("");
                                $("#tabsleft").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);
                        
                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }

                        
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
