<?php 

  include('navbar.php');

?> 

<!-- *********************************************************************** -->
<!-- ************************* Interface Settingds ************************* -->
<!-- *********************************************************************** -->                 

<?php if($_SESSION['devicetype'] == 2 ): ?>  <!-- 1 computer 2 mobile or tablet -->
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
    <?php   $fgseldiv       = 'col-sm-5' ?>                        <!-- col width of regular dropdown boxes  -->
    <?php   $yesnodiv       = 'col-sm-3' ?>                        <!-- col width of yes/no dropdown boxes  -->     
    <?php   $labelclass     = 'col-sm-4 col-form-label' ?>         <!-- col width of field labels  -->
    <?php   $inputdivclass  = 'col-sm-7' ?>                        <!-- col width of input boxes  -->
    <?php   $inputstyle     = 'height: 50px; font-size: 25px;' ?>  <!-- height of input boxes & fontsize -->
    <?php   $labelstyle     = 'color:cornflowerblue;' ?>           <!-- label color -->
    <?php   $valueclass     = 'col-sm-6' ?>                        <!-- Value widths (may be different from view section) -->
    <?php   $selectstyle    = 'height: 50px; font-size: 28px;' ?>  <!-- height of regular dropdown boxes & fontsize  -->

    <?php elseif($_SESSION['fontsize'] == 2): ?> <!-- Medium Font h2  -->

    <?php   $fgdivclass     = 'form-group  row' ?>
    <?php   $fgseldiv       = 'col-sm-2' ?>
    <?php   $yesnodiv       = 'col-sm-1' ?>      
    <?php   $labelclass     = 'col-sm-2 col-form-label' ?>
    <?php   $inputdivclass  = 'col-sm-3' ?>
    <?php   $inputstyle     = 'height: 40px; font-size: 20px;' ?> 
    <?php   $labelstyle     = 'color:cornflowerblue;' ?> 
    <?php   $valueclass     = 'col-sm-6' ?>
    <?php   $selectstyle    = 'height: 40px; font-size: 20px;' ?>
    
    <?php elseif($_SESSION['fontsize'] == 3): ?> <!-- Smallest Font h3  -->
    <?php   $fgdivclass     = 'form-group  row' ?>
    <?php   $fgseldiv       = 'col-sm-7' ?>                        <!-- col width of regular dropdown boxes  -->
    <?php   $yesnodiv       = 'col-sm-3' ?>                        <!-- col width of yes/no dropdown boxes  -->     
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
    <?php   $vlabelclass     = 'col-sm-2 col-form-label' ?>
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
<!-- User Picture or Logo                                                    --> 
<!-- Header & Subheader                                                      -->                                  
<!-- *********************************************************************** -->

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


                <!--    <php if($_SESSION['admode'] == 'sysadminv'): ?> -->
                    <br />                           
                    <h1><p><?= $header ?></p></h1>
                    <h2><p><?= $subheader ?></p></h2>  
               <!--     ?php else: ?>

                    <php endif; ?> -->

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
                                    <div class="col-md-2"> 
                                    <?php if($_SESSION['admode'] == 'sysadminv' ): ?> 
              <!--      <a data-toggle="collapse" href="#faq1" class="faq-question">Setting ID: <?= $recid ?></a> -->
                                    <?php else: ?>
               
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

    <?php if($_SESSION['flashmsgcolor'] == 1): ?>

     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); 
     $_SESSION['flashmsgcolor'] = 0; ?> 

   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); 
     $_SESSION['flashmsgcolor'] = 0; ?> 
   
   <?php endif; ?>

<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                          
                           <strong> <?= validation_errors() ?></strong>
                           
<!-- If updating or creating else viewing  -->
<?php if($_SESSION['admode'] == 'sysadminu' || $_SESSION['admode'] == 'sysadminc'): ?> <!-- Updating or creating  -->     

<!--<php if($_SESSION['tab'] == 1): ?> -->

<form  method = "post" action="<?= BASE_URL ?>system-subentities/submit/<?= $recid ?>">

       <div class="row"> 
           <div class="col-md-12">
               <br>


<?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter -->

<!-- *********************************************************************** -->
<!--                               UPDATING                                  -->
<!--  Regular Fields                                                         --> 
<!--  Yes/No Fields                                                          -->
<!--  Table Driven Dropdowns                                                 -->                                         
<!-- *********************************************************************** -->
                          
    <?php $fields100 = ["Short Name<a style='color:Red;'>*</a>"   => "$title",
                        "Full Name<a style='color:Red;'>*</a>" => "$description"                      
                    ]; ?>

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



        <!-- Yes/No Dropdowns -->
        <?php $fields101 = ["Chartered" => "$chartered"                                                                     
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



    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Region</h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="region" style="<?= $selectstyle ?>">
    <!-- Loop through the dropdown array passed in $data  -->
    <?php foreach($regions as $row) { ?>
        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->id == $description): ?> 
                <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->id ?>"><?= $row->description ?></option>
            <?php endif; ?>
         <?php } ?>                                    
         </select>
        </div>
    </div>


    <?php $fields104 = ["Logo"      => "$logo",  
                        "Website"   => "$website",
                        "Facebook"  => "$facebook",                        
                        "Instagram" => "$instagram",
                        "YouTube"   => "$youtube"                                          
                    ]; ?>

    <?php foreach($fields104 as $label=> $value) { ?>
        <!-- create a unique field name that is used in the $_POST -->
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?> 

                                                 
<?php else: ?> <!-- Creating  -->

<!-- *********************************************************************** -->
<!--                               CREATING                                  -->
<!--  Regular Fields                                                         --> 
<!--  Yes/No Fields                                                          -->
<!--  Table Driven Dropdowns                                                 -->                                         
<!-- *********************************************************************** -->

<!-- Regular Input Fields  -->

    <?php $fields200 = ["Short Name<a style='color:Red;'>*</a>" => "$title",
                        "Full Name<a style='color:Red;'>*</a>"  => "$description" 
                  
                    ]; ?>

    <?php foreach($fields200 as $label=> $value) { ?>
        <!-- create a unique field name that is used in the $_POST -->
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" required>
            </div>
        </div>
    <?php } ?> 


<!-- Yes/No Dropdown  -->

    <?php $fields209 = ["Chartered" => "$chartered"                                                                     
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

<!-- Table Fed Dropdown  -->

    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Region</h<?= $_SESSION['fontsize'] ?>></label>
    <div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="region" style="<?= $selectstyle ?>">
    <!-- Loop through the dropdown array passed in $data  -->
    <?php foreach($regions as $row) { ?>
        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->id == $highest_certificate): ?> 
                <option selected value="<?= $row->id ?>"><?= $row->description ?></option>
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->id ?>"><?= $row->description ?></option>
            <?php endif; ?>
         <?php } ?>                                    
         </select>
        </div>
    </div>

<!-- Regular Input Fields  -->

    <?php $fields203 = ["Logo"       => "$logo",  
                        "Website"    => "$website",
                        "Facebook"   => "$facebook",                        
                        "Instagram"  => "$instagram",
                        "YouTube"    => "$youtube"  
                  
                    ]; ?>

    <?php foreach($fields203 as $label=> $value) { ?>
        <!-- create a unique field name that is used in the $_POST -->
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
    <?php } ?> 

<?php endif; ?> 
                                                     
</div>
</div>

<!-- *********************************************************************** -->
<!--                            Save & Cancel Buttons                        -->                                      
<!-- *********************************************************************** -->

    <div>
    <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>> Save </h<?= $_SESSION['fontsize'] ?>></button>

    <?php if($_SESSION['frmpg'] == 'sysadminm'):  ?>  
        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>system-subentities/manage"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
    </div>
    <?php else: ?> <!--came from sysadminv -->
    <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>system-subentities/viewrecord/<?= $recid ?>"><h<?= $_SESSION['fontsize'] ?>> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
    </div>                                                 

    <?php endif; ?> 

                

<?php else: ?>  <!-- Viewing -->
 
<!-- *********************************************************************** -->
<!--                              Viewing                                  -->
<!--  Regular Fields                                                         --> 
<!--  Yes/No Fields                                                          -->
<!--  Table Driven Dropdowns                                                 -->                                         
<!-- *********************************************************************** -->                                                   
    <div class="row"> 
        <div class="col-md-12">

         <br>

         <?php $itemsv100 = [SUBENTITY.' Id'       => "$id",
                            "Short Name" => "$title",
                            "Full Name"  => "$description",
                            "Chartered"  => "$chartered",
                            "Region"     => "$region",
                            "Logo"       => "$logo",  
                            "Website"    => "$website",
                            "Facebook"   => "$facebook",                        
                            "Instagram"  => "$instagram",
                            "YouTube"    => "$youtube"  
                                 
                            ]; ?>           
                
        <?php foreach($itemsv100 as $label=> $value) { ?> 

            <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
                <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
            </div>

        <?php } ?>  

        </div> <!-- end col-12 -->

                                    

    </div> <!-- end row -->

<!-- *********************************************************************** -->
<!--                            Update & Back Buttons                        -->                                      
<!-- *********************************************************************** -->

<!--  <div class="btn-group"> -->

    <?php if($_SESSION['admode'] == 'sysadminv'): ?>

        <div>
            <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>system-subentities/update/<?= $recid ?>" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i>  Update</h<?= $_SESSION['fontsize'] ?>></a>

            <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>system-subentities/manage" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-list"></i> Back</h<?= $_SESSION['fontsize'] ?>></a>
        </div>

    <?php else: ?> 


    <?php endif; ?> 

        </div> 

<?php endif; ?> <!--  End Viewing  -->

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
<!-- End Program  -->