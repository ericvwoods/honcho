<?php 

  include('navbar.php');

?>


<!-- <div class="scroll_content"> -->


 <!--   <div class="wrapper wrapper-content animated fadeInRight"> -->
        <div class="row"> <!-- Page Row One  -->
               <div class="col-lg-12"> <!-- Col 12 Page Row One -->                
                    <div class="ibox-content">
                <div class="row"> 
                        <div class="col-md-1">  
                         <br>
                            <div class="row">
                                <div class="col-md-6"> <!-- for spacing --> 
                                </div>
                             
                               <a href="#" title="">
<img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">                                     
                               </a>
                            </div>
                      
                        </div> <!-- end col -->
                   
                        <div class="col-md-10">
                            <p> </p>
                        <span class="m-r">
                           <?php if($managemode == 'dmslibadmin'): ?> 
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span> 
                                <a style="color:<?= SN2_CLR ?>;" href="#"><h2><?= $activity ?></h2></a>
                            <?php else: ?>
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span>
                                       <a style="color:<?= SN2_CLR ?>;" href="#"><h2><?= $activity ?></h2></a>
                            <?php endif; ?>                            
                        </span>
                        </div> <!-- end column -->
                          <div class="col-md-1">
                    <ul class="nav navbar-top-links navbar-right">

                      
 
                        <li>
<a class="btn btn-warning btn-rounded btn-outline" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 24px;"> Back </span></a>
                       
                        </li>
                    </ul> <!-- End Navbar right  -->
                      </div> <!-- end column -->
                </div> <!-- end row -->

                      
 
 <br> <!-- Gap between header and 1st Collapse Contact Information  -->

  
<!-- *********************************************************************** --> 
<!--   <php include('crud.php'); ?> -->

<!-- *********************************************************************** -->
<!-- ****** Begin Boiler Plate for 1st CRUD Item containing Form Open ****** -->
<!-- *********************************************************************** -->
<!-- 
<php if(DEBUGGING == true): ?> 
 <!--   <php
           echo('$_SESSION');
           echo('<br>');
           echo('<h3>$_SESSION</h3>');
           json($_SESSION);
           echo('<h3>$data</h3>');
           json($data);
        ?>
 <php endif; ?>
-->
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
                        
<?php if($managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'): ?> 
<?php else: ?>                         

<?php endif; ?> 
    <center>     <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
      $flash_msg = '';
      set_flashdata($flash_msg); ?> 
    <?php else: ?>
      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
      $flash_msg = '';
      set_flashdata($flash_msg); ?> 
    <?php endif; ?></center>
     

    <br>  
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->
<!-- <?= $_SESSION['ccmp_active_window'] ?> -->

<div id="faq1" class="panel-collapse">

<div class="faq-answer">
<div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <?php if($_SESSION['ccmp_active_window'] == 1): ?> <!-- can only show the flashmsg once on a page - show in the open section -->

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

<!-- ************************ Edit/Create Fields *************************** -->

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

<!-- **************************** View Fields ****************************** -->
    
<?php if($_SESSION['mobileformat'] == 1 ): ?>  <!-- fg = form group -->
<!--  default --> <?php $vfgdivclass  = 'form-group row' ?>   <!-- Class of the label/value combo  -->
<!--  default --> <?php $vlabelclass  = 'col-lg-4' ?>         <!-- Width of the label column  -->
<!--  default --> <?php $vlabelstyle  = 'color:cornflowerblue;' ?> <!-- Style of the view labels  -->
<!--  default --> <?php $vvalueclass1 = 'col-sm-5' ?>         <!-- Width of value column  -->           
<!--  default --> <?php $vvalueclass2 = 'col-sm-7' ?>         <!-- Width of value column  --> 

<?php else: ?>

    <?php if($_SESSION['fontsize'] == 1 ): ?> <!-- Largest Font h1  -->
    
    <?php   $vfgdivclass     = 'form-group  row' ?>          <!-- form group tag for fields -->
    <?php   $vlabelclass     = 'col-sm-4 col-form-label' ?>  <!-- col width of field labels  -->
    <?php   $vvalueclass1    = 'col-sm-6' ?>                 <!-- col width of view fields  -->
    <?php   $vlabelstyle     = 'color:cornflowerblue;' ?>    <!-- label color -->

    <?php elseif($_SESSION['fontsize'] == 2): ?> <!-- Medium Font h2  -->

    <?php   $vfgdivclass     = 'form-group  row' ?>          <!-- form group tag for fields -->
    <?php   $vlabelclass     = 'col-sm-3 col-form-label' ?>  <!-- col width of field labels  -->
    <?php   $vvalueclass1    = 'col-sm-9' ?>                 <!-- col width of view fields  -->
    <?php   $vlabelstyle     = 'color:cornflowerblue;' ?>    <!-- label color -->
 <!--   <php   $vinputdivclass  = 'col-sm-7' ?>   -->              <!-- col width of input boxes  -->
 <!--   <php   $vvalueclass2    = 'col-sm-5' ?>  -->   <!-- not used  -->
    
    <?php elseif($_SESSION['fontsize'] == 3): ?> <!-- Smallest Font h3  -->
    
    <?php   $vfgdivclass     = 'form-group  row' ?>          <!-- form group tag for fields -->
    <?php   $vlabelclass     = 'col-sm-3 col-form-label' ?>  <!-- col width of field labels  -->
    <?php   $vvalueclass1    = 'col-sm-6' ?>                 <!-- col width of view fields  -->
    <?php   $vlabelstyle     = 'color:cornflowerblue;' ?>    <!-- label color --> 

    <?php endif; ?>
<?php endif; ?> 
<!-- *********************************************************************** -->
<!-- ********************* Begin Create/Update Section ********************* -->
<!-- *********************************************************************** -->

<!-- Member (mmd-manage.my.data)c/u, CA (mom-manage.our.members) c/u, SA (mos-manage.our.students)c/u, MCM (mcm-manage.current.members)c/u ??? , MAM (mam-manage.all.members) c/u   -->
<?php if($managemode == 'dmslibadminupdate' || $managemode == 'dmssublibadminupdate' || $managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'): ?> <!-- Updating or creating  -->     

<!-- **************************** Begin Form ******************************* -->
<!-- Form to post the create/update form values - the view is also contained in the form -->
<!-- The first faq item must contain the form open and the last item the form close -->
<!-- *********************************************************************** -->

    <form  method = "post" action="<?= BASE_URL ?>cms-ccmpslibrary/submit/<?= $recid ?>">
        
<!-- *********************************************************************** -->
<!-- ******************* Save/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

<!-- Save button is same for all  - However ccmps don't edit doc records unless dmslibadmin rights-->

<div>
          
<!--   <?php if($managemode == 'dmslibadminupdate' || $managemode == 'dmssublibadminupdate' || $managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'): ?> 
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $recid ?>/dmslibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 

       <?php endif; ?> -->
</div>

<!-- ************************* End Save/Cancel buttons ********************* -->

<!-- *********************************************************************** -->
<!-- ********************** Begin Create/Update Fields ********************* -->
<!-- *********************************************************************** -->
<?php if($managemode == 'dmslibadminupdate' || $managemode == 'dmssublibadminupdate'): ?> 

     <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= SN_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><strong>Update Document Record</strong></h<?= $_SESSION['fontsize'] ?>></center>
    </div> 
<?php endif; ?>
<?php if($managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'): ?> 

     <div class="col">  
 <center  style="<?= $vlabelstyle ?>; color:<?= SN_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><strong>Create A Document Record</strong></h<?= $_SESSION['fontsize'] ?>></center>
    </div> 
<?php endif; ?> 
<br>

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
 
 
     <div class="ibox-content text-box">
            <div class="row"> 
         <div class="col-md-2"> 
         </div>

            </div>
         
    <!-- How to handle not updatable but still pass current value to the save   -->
    <div class="<?= $fgdivclass ?>"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

        <div class="col-sm-8"><input name="managemode" type="text" class="form-control" value="<?= $managemode ?>" hidden></div>
   </div> 
    


    
<?php if($recid > 0):  ?>  

 <!-- Field --> 
 
    <!-- All labels must be unique because they double as names for input fields for $_POST (extracted in _ccmps_fetch_data_from_post() line)-->
<?php $items1ss = ["Title <a style='color:Red;'>*</a>"       => "$title"
        ]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _ccmps_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($items1ss as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>; "><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
        </div>
    </div>
<?php } ?>
    
 <!-- Dropdown--> 
 
    <?php if(DEBUGGING == true): ?>                  
<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= CCMPS_FL_TAG1 ?> <?= $doctag1 ?></h<?= $_SESSION['fontsize'] ?>></label>
    <?php else: ?>
<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= CCMPS_FL_TAG1 ?></h<?= $_SESSION['fontsize'] ?>></label>                        
    <?php endif; ?>
<div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="doctag1" style="<?= $selectstyle ?>">
<!-- Loop through the dropdown array passed in $data  -->
  <option selected value='0'>NA</option>
<?php foreach($doctags1 as $row) { ?>
<!-- If $row->id = currently selected user_level_id then pre-select that option -->
    <?php if($row->id == $doctag1): ?> 
        <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
    <?php else: ?> <!-- otherwise just create the option -->
        <option value="<?= $row->id ?>"><?= $row->description ?></option>
    <?php endif; ?>
 <?php } ?>                                    
 </select>
</div>
</div>
    
<!-- Yes/No Dropdowns -->
<?php $items01xyz = [
                  "Attaching a File" => "$rectype"
                ]; ?>
<!-- "Eligible Voter"  => "$eligible_voter"  not for ccmp to edit -->
<?php foreach($items01xyz as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
        <?php if(DEBUGGING == true): ?> 
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?> ?<a style='color:Red;'>*</a> <?= $value ?> </h<?= $_SESSION['fontsize'] ?>></label> 
        <?php else: ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?>? <a style='color:Red;'>*</a></h<?= $_SESSION['fontsize'] ?>></label> 
        <?php endif; ?>               
                <div class="<?= $yesnodiv ?>"><select class="form-control m-b" name="<?= $inputname ?>" Value="<?= $value ?>" style="<?= $selectstyle ?>">
                <?php if($value == 2) { ?>
                    <option selected value=2>Yes</option>
                    <option value=1>No</option>
                <?php }else{ ?>
                    <option value=2>Yes</option>
                    <option selected value=1>No</option>
                <?php } ?>
                </select>
               </div>                                              
            </div> 
<?php } ?>
       
<?php else: ?> <!-- Creating  -->
 <!-- Field --> 
 
    <!-- All labels must be unique because they double as names for input fields for $_POST (extracted in _ccmps_fetch_data_from_post() line)-->
<?php $items1ss = ["Title <a style='color:Red;'>*</a>"       => "$title"
        ]; ?>
<!-- "" => "", -->
<!-- The form field label names are $label and the values passed to the form from the DB are $value. The input's name="xyz" field passes back the changed values from the form to _ccmps_fetch_data_from_post() in the $_POST array and the values are assigned to a $data array containing the field names of the DB table(s) and either update or create queries are run. Therefore the name fields here do not have to match the name in the database because the functions does that mapping. This is important because we are only passing two values (label name and the elements value) but a third, the name field is needed and must be unique or the second occurence will overwrite the first one. Therefore a unique name value ($inputname) can and will be created on the fly from the label names if they are unique.-->

<?php foreach($items1ss as $label=> $value) { ?>
    <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
 
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>; "><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
        </div>
    </div>
<?php } ?>
    
  <!-- Dropdown-->
    <!-- Subentity -->    
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= SUBENTITY ?></h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="subentity" style="<?= $selectstyle ?>">
    <!-- Loop through the dropdown array passed in $data  -->
     <option selected value='0'>NA</option>
    <?php foreach($subentities as $row) { ?>
    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
        <?php if($row->id == $subentity): ?> 
            <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
        <?php else: ?> <!-- otherwise just create the option -->
            <option value="<?= $row->id ?>"><?= $row->description ?></option>
        <?php endif; ?>
     <?php } ?>                                    
     </select>
    </div>
    </div>
    
<!-- Yes/No Dropdowns -->
<?php $items01xyz = [
                  "Attaching a File" => "$rectype"
                ]; ?>
<!-- "Eligible Voter"  => "$eligible_voter"  not for ccmp to edit -->
<?php foreach($items01xyz as $label=> $value) { ?>
    <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
    <?php $inputname = str_replace(' ', '', $inputname); ?> 
    <?php $inputname = strtolower($inputname); ?>
        <?php if(DEBUGGING == true): ?> 
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?> ?<a style='color:Red;'>*</a> <?= $value ?> </h<?= $_SESSION['fontsize'] ?>></label> 
        <?php else: ?>
            <div class="<?= $fgdivclass ?>">  <label class="<?= $labelclass ?>" style="<?= $labelstyle ?>; color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>><?= $label ?>? <a style='color:Red;'>*</a></h<?= $_SESSION['fontsize'] ?>></label> 
        <?php endif; ?>               
                <div class="<?= $yesnodiv ?>"><select class="form-control m-b" name="<?= $inputname ?>" Value="<?= $value ?>" style="<?= $selectstyle ?>">
                <?php if($value == 2) { ?>
                    <option selected value=2>Yes</option>
                    <option value=1>No</option>
                <?php }else{ ?>
                    <option value=2>Yes</option>
                    <option selected value=1>No</option>
                <?php } ?>
                </select>
               </div>                                              
            </div> 
<?php } ?>
    
             <?php endif; ?> 
          
   
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

  <div class="ibox-content text-box">
      
                      
    </div> <!-- ibox content --> 
 </div>
 <!-- *********************************************************************** -->
<!-- ****************** End Right Column Create/Update Fields Fields ******************** -->     
</div><!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

 <!--   <p>Create/update fields outside row go here</p> -->

  <div ><label class="col-sm-12 col-form-label" style="color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Full Text</h<?= $_SESSION['fontsize'] ?>></label></div>
    <textarea  class="form-control border-left m-t" style="height: 200px" name="fulldescription" id="doc_editor"> <!-- id is for CKEditor    -->
              <?= $fulldescription ?>
    </textarea> 

     <div ><label class="col-sm-12 col-form-label" style="color:<?= CCMPS_CRUD_LABEL_CLR ?>;"><h<?= $_SESSION['fontsize'] ?>>Notes</h<?= $_SESSION['fontsize'] ?>></label></div>
     <div class="col-sm-12"><input style="<?= $inputstyle ?>"  name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span></div>
    
 
       <?php if($managemode == 'dmslibadminupdate'): ?> 
       <br>   
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> </h<?= $_SESSION['fontsize'] ?>></button>
    <!-- now isolate which one for the correct Cancel button - same if subentity admin--> 
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $recid ?>/dmslibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> </h<?= $_SESSION['fontsize'] ?>></a> 

       <?php endif; ?>
       <?php if($managemode == 'dmssublibadminupdate'): ?> 
       <br>   
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> </h<?= $_SESSION['fontsize'] ?>></button>
    <!-- now isolate which one for the correct Cancel button - same if subentity admin--> 
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $recid ?>/dmssublibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> </h<?= $_SESSION['fontsize'] ?>></a> 

       <?php endif; ?>    
      <?php if($managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'): ?> 
       <br>   
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> </h<?= $_SESSION['fontsize'] ?>></button>
    <!-- now isolate which one for the correct Cancel button - same if subentity admin--> 
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> </h<?= $_SESSION['fontsize'] ?>></a> 

       <?php endif; ?>
    </form>
      <?php if($managemode == 'dmslibadmincreate'): ?> 
       <br>   
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> </h<?= $_SESSION['fontsize'] ?>></button>
    <!-- now isolate which one for the correct Cancel button - same if subentity admin--> 
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> </h<?= $_SESSION['fontsize'] ?>></a> 

       <?php endif; ?>
       <?php if($managemode == 'dmssublibadmincreate'): ?> 
       <br>   
    <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> </h<?= $_SESSION['fontsize'] ?>></button>
    <!-- now isolate which one for the correct Cancel button - same if subentity admin--> 
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmssublibadmin"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> </h<?= $_SESSION['fontsize'] ?>></a> 

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
        <!--    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Agile board</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Miscellaneous</a>
                        </li>
                        <li  class="breadcrumb-item active">
                            <strong>Agile board</strong>
                        </li>
                    </ol>
                </div>
            </div> -->

        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Backlog</h3>
                           <!-- <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p> -->

                           <!-- <div class="input-group">
                                <input type="text" placeholder="Add new task. " class="input form-control-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Add task</button>
                                </span>
                            </div> -->

                            <ul class="sortable-list connectList agile-list" id="todo">
                                <li class="warning-element" id="task1">
                                    Title: New Document <br>
                                    Simply dummy text of the printing and typesetting industry.
                                    <div class="agile-detail">
                                        <a href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/83/dmslibadmin" class="float-right btn btn-xs btn-white"><i class="fa fa-eye"></i> View</a>
                                        <i class="fa fa-clock-o"></i> 3.13.2024
                                    </div>
                                </li>
                                <li class="success-element" id="task2">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="info-element" id="task3">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="danger-element" id="task4">
                                    All the Lorem Ipsum generators
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-primary">Done</a>
                                        <i class="fa fa-clock-o"></i> 06.10.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task5">
                                    Which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task6">
                                    Packages and web page editors now use Lorem Ipsum as
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-primary">Done</a>
                                        <i class="fa fa-clock-o"></i> 08.04.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task7">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="info-element" id="task8">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>In Progress</h3>
                       <!--     <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p> -->
                            <ul class="sortable-list connectList agile-list" id="inprogress">
                                <li class="success-element" id="task9">
                                    Quisque venenatis ante in porta suscipit.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 12.10.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task10">
                                    Phasellus sit amet tortor sed enim mollis accumsan in consequat orci.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task11">
                                    Nunc sed arcu at ligula faucibus tempus ac id felis. Vestibulum et nulla quis turpis sagittis fringilla.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task12">
                                    Ut porttitor augue non sapien mollis accumsan.
                                    Nulla non elit eget lacus elementum viverra.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="info-element" id="task13">
                                    Packages and web page editors now use Lorem Ipsum as
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-primary">Done</a>
                                        <i class="fa fa-clock-o"></i> 08.04.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task14">
                                    Quisque lacinia tellus et odio ornare maximus.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="danger-element" id="task15">
                                    Enim mollis accumsan in consequat orci.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 11.04.2015
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>In Review</h3>
                           <!-- <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p> -->
                            <ul class="sortable-list connectList agile-list" id="completed">
                                <li class="info-element" id="task16">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task17">
                                    Ut porttitor augue non sapien mollis accumsan.
                                    Nulla non elit eget lacus elementum viverra.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task18">
                                    Which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task19">
                                    Packages and web page editors now use Lorem Ipsum as
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-primary">Done</a>
                                        <i class="fa fa-clock-o"></i> 08.04.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task20">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="info-element" id="task21">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task22">
                                    Simply dummy text of the printing and typesetting industry.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 12.10.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task23">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Awaiting Approval</h3>
                         <!--   <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p> -->
                            <ul class="sortable-list connectList agile-list" id="completed">
                                <li class="info-element" id="task16">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task17">
                                    Ut porttitor augue non sapien mollis accumsan.
                                    Nulla non elit eget lacus elementum viverra.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task18">
                                    Which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 09.12.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task19">
                                    Packages and web page editors now use Lorem Ipsum as
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-primary">Done</a>
                                        <i class="fa fa-clock-o"></i> 08.04.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task20">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                                <li class="info-element" id="task21">
                                    Sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 16.11.2015
                                    </div>
                                </li>
                                <li class="warning-element" id="task22">
                                    Simply dummy text of the printing and typesetting industry.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Tag</a>
                                        <i class="fa fa-clock-o"></i> 12.10.2015
                                    </div>
                                </li>
                                <li class="success-element" id="task23">
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                    <div class="agile-detail">
                                        <a href="#" class="float-right btn btn-xs btn-white">Mark</a>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <h4>
                        Serialised Output
                    </h4>
                    <p>
                        Serializes the sortable's item id's into an array of string.
                    </p>

                    <div class="output p-m m white-bg"></div>


                </div>
            </div>


        </div>
    </div> <!-- col 12  -->
</div> <!-- end row -->

<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

 <!--   <p>view fields outside row but inside the form go here</p> -->

<!-- *********************************************************************** -->
<!-- **************************** End Form ********************************* -->
<!-- If this is the only faq crud item or the last faq crud item -->
<!--    </form> -->
<!-- *********************************************************************** --> 
 
    <?php endif; ?> <!--  End Create/Update else View   -->
   
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                        
        </div> <!-- End Column 12 --> 

    </div><!-- End Row Two -->

</div> <!-- End FAQ Item -->
  
 <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<h3>View: cms-ccmpslibrary/$managemode</h3>');
    echo('<h3>New Session Id</h3>');
    $session_id = session_id();
    echo ('<h3>'.$session_id.'</h3>');    
    echo('<h3>$_COOKIE</h3>');
    json($_COOKIE);
    echo('<br>');
    echo('<h3>$data</h3>');
    json($data);    
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);

 ?>
 <?php endif; ?>

<!-- *********************************************************************** -->            
   </div>     
       
                    
                           
