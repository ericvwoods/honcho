
<!-- *********************************************************************** -->
<!-- **** Begin Boiler Plate forinner CRUD Item - no form open or close **** -->
<!-- *********************************************************************** -->

<div class="faq-item"> <!-- Ends at end of file -->

        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                        <!-- #faq? must be unique but not in any order  -->
                        <center><a data-toggle="collapse" href="#faq3" class="faq-question" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>>Financial Account <i class="fa fa-caret-down fa-1x" style="color:LightBlue;"></i></h<?= $_SESSION['fontsize'] ?>></a></center>
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['ccmp_active_window'] must be equal to #faq number  -->
                <?php if($_SESSION['ccmp_active_window'] == 3): ?>
                    <div id="faq3" class="panel-collapse">
                <?php else: ?>
                    <div id="faq3" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <!-- $_SESSION['ccmp_active_window'] must be equal to #faq number  -->
        <?php if($_SESSION['ccmp_active_window'] == 3): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
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
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>

    <?php $itemsv300 = ["Financial Acct Id"   => "$fin_id",
                        "Financial Acct Type" => "$vfin_acct_type",
                        ]; ?>           
            
    <?php foreach($itemsv300 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><!-- <label class="col-sm-3 col-form-label" style="color:cornflowerblue;" ><h<?= $_SESSION['fontsize'] ?>>Account Type</h<?= $_SESSION['fontsize'] ?>></label> -->

     <div class="col-sm-8"><input name="fin_acct_type" type="text" class="form-control" value="<?= $fin_acct_type ?>" hidden></div>
</div>
<!-- END --How to handle not updatable by still pass current value to the save   -->

<?php else: ?>


    <?php $itemsv300 = ["Financial Acct Id" => "$fin_id"
                        ]; ?>           
            
    <?php foreach($itemsv300 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 


<!-- Dropdown Box  --> 

<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Account Type<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>


<div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="fin_acct_type" style="<?= $selectstyle ?>">
<!-- Loop through the dropdown array passed in $data  -->
<?php foreach($accttypes as $row) { ?>
    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
        <?php if($row->id == $fin_acct_type): ?> 
            <option selected value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option>
        <?php else: ?> <!-- otherwise just create the option -->
            <option value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option>
        <?php endif; ?>
     <?php } ?>                                    
     </select>
    </div>
</div>

<?php endif; ?> 

<!-- Regular Input Field  -->                                    
                                    
<?php $fields301 = ["Billing Email" => "$fin_email"
                ]; ?>

<?php foreach($fields301 as $label=> $value) { ?> 
    <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>  

    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->
  

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->

       
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
         <!-- Done -->
               
       

     <?php endif; ?>

<div class="ibox-content">
    
<center style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>><strong>Billing Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->
        <br>
        <br>
        <br>
        <br>

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
        <br>
        <br>
       
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!-- Done -->
   
  

     <?php endif; ?>


<!-- Regular Input Fields  -->                                    
                                    
<?php $fields303 = ["Bill To Name"  => "$billname",
                    "Bill To Phone" => "$billphone",
                    "Bill Address1" => "$billaddress1",
                    "Bill Address2" => "$billaddress2",
                    "Bill City"     => "$billcity"
                ]; ?>

<?php foreach($fields303 as $label=> $value) { ?> 
    <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!-- Dropdown Box  --> 

<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Bill State</h<?= $_SESSION['fontsize'] ?>></label> 
<div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="billstate" style="<?= $selectstyle ?>">
<!-- Loop through the dropdown array passed in $data  -->
  <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
    <?php if($row->state_code == $billstatecode): ?> <!-- was$ culid -->
       <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
    <?php else: ?> <!-- otherwise just create the option -->
        <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
    <?php endif; ?>
  <?php } ?>                                    
  </select>
</div>
</div> <!-- end state code -->      

    <!-- Regular Input Field  -->                                    
                                    
<?php $fields304 = ["Bill Zip"  => "$billzip"
                ]; ?>

<?php foreach($fields304 as $label=> $value) { ?> 
    <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>   

       </div>   <!-- ibox-content -->
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

 <!--   <p> Right column create/update fields go here </p>-->    
    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->


    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
      
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
  <br>

     <?php endif; ?> 

<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?> <!--  combined --> 

    <?php $itemsv202 = ["Balance"   => "$acct_bal",
                        "Status"    => "$vfin_status",
                        "Inactive"  => "$vfin_inactive"
                        ]; ?>           
            
    <?php foreach($itemsv202 as $label=> $value) { ?> 

        <div class="<?= $vfgdivclass ?>"><label class="<?= $vlabelclass ?>" style="<?= $vlabelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $vvalueclass1 ?>"><h<?= $_SESSION['fontsize'] ?>><?= $value ?></h<?= $_SESSION['fontsize'] ?>></div>
        </div>

    <?php } ?> 
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row">

 <!--   <label class="col-sm-2 col-form-label" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></label> -->

     <div class="col-sm-8"><input name="acct_bal" type="text" class="form-control" value="<?= $acct_bal ?>" hidden></div>
</div>
<!-- END --How to handle not updatable by still pass current value to the save   -->

<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row">

  <!--  <label class="col-sm-2 col-form-label" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></label> -->

     <div class="col-sm-8">

        <!-- <input name="fin_status" type="text" class="form-control" value="<?= $fin_status ?>" hidden></div> -->
     </div>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row">

 <!--   <label class="col-sm-2 col-form-label" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></label> -->

     <div class="col-sm-8"><input name="fin_inactive" type="text" class="form-control" value="<?= $fin_inactive ?>" hidden></div>
</div>


<!-- END --How to handle not updatable by still pass current value to the save   -->     

<?php else: ?> 
  
  
<!-- Regular Input Field  -->                                    
                                    
<?php $fields305 = ["Balance"  => "$acct_bal"
                ]; ?>

<?php foreach($fields305 as $label=> $value) { ?> 
    <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
    <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?>

<!-- Dropdown Box  --> 

<div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Status<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
<div class="<?= $fgseldiv ?>"><select class="form-control m-b" name="fin_status" style="<?= $selectstyle ?>">
<!-- Loop through the dropdown array passed in $data  -->
<?php foreach($finstatuses as $row) { ?>
    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
        <?php if($row->id == $fin_status): ?> 
            <option selected value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option>
        <?php else: ?> <!-- otherwise just create the option -->
            <option value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option>
        <?php endif; ?>
     <?php } ?>                                    
     </select>
    </div>
</div>  

<!-- Yes/No Dropdowns -->

<?php $fields306 = ["Inactive" => "$fin_inactive"                                                                     
                ]; ?>

<?php foreach($fields306 as $label=> $value) { ?>
    <?php $inputname = str_replace(' ', '', $label); ?> <!-- create a unique field name that is used in the $_POST -->
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
    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->
        <br>
        <br>
        <br>
        <br>

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
        <br>
    
       
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!-- Done -->
    
     <?php endif; ?>



<div class="ibox-content">
    
<center style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>><strong> Shipping Address</strong></h<?= $_SESSION['fontsize'] ?>></center>
    <?php if($_SESSION['fontsize'] == 1): ?> 
        <br> <!-- Done -->
        <br>
        <br>
        <br>
        <br>

    <?php elseif($_SESSION['fontsize'] == 2):  ?>
        <br> <!-- Done -->
        <br>
        <br>
        <br>
       
        
    <?php elseif($_SESSION['fontsize'] == 3):  ?>
        <br> <!-- Done -->

     <?php endif; ?>

<!-- Yes/No Dropdowns -->

<?php $fields307 = ["Same as Billing" => "$fin_billship"                                                                     
                ]; ?>

<?php foreach($fields307 as $label=> $value) { ?>
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

<!-- Regular Input Fields  -->                                    
                                    
<?php $fields308 = ["Ship To Name"  => "$shipname",
                    "Ship To Phone" => "$shipphone",
                    "Ship Address1" => "$shipaddress1",
                    "Ship Address2" => "$shipaddress2",
                    "Ship City"     => "$shipcity"
                ]; ?>


<?php foreach($fields308 as $label=> $value) { ?> 
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
    <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
        <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
        </div>
    </div>
<?php } ?> 

<!-- Dropdown Box  --> 

        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>>Ship State</h<?= $_SESSION['fontsize'] ?>></label> 
        <div class="<?= $fgseldiv ?>"><select type="text" class="form-control m-b" name="shipstate" style="<?= $selectstyle ?>">
        <!-- Loop through the dropdown array passed in $data  -->
          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
            <?php if($row->state_code == $shipstatecode): ?> <!-- was$ culid -->
               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
            <?php else: ?> <!-- otherwise just create the option -->
                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
            <?php endif; ?>
          <?php } ?>                                    
          </select>
        </div>
        </div> <!-- end state code -->

<!-- Regular Input Field  -->                                    
                                    
<?php $fields309 = ["Ship Zip"  => "$shipzip"
                ]; ?>

<?php foreach($fields309 as $label=> $value) { ?> 
        <?php $inputname = str_replace("<a style='color:Red;'>*</a>", '', $label); ?>
        <?php $inputname = str_replace(' ', '', $inputname); ?> 
        <?php $inputname = strtolower($inputname); ?>
        <div class="<?= $fgdivclass ?>"><label class="<?= $labelclass ?>" style="<?= $labelstyle ?>"><h<?= $_SESSION['fontsize'] ?>><?= $label ?></h<?= $_SESSION['fontsize'] ?>></label>
            <div class="<?= $inputdivclass ?>"><input style="<?= $inputstyle ?>" name="<?= $inputname ?>" type="text" class="form-control" value="<?= $value ?>" >
            </div>
        </div>
<?php } ?> 

</div>  <!--  end ibox content -->

<!-- *********************************************************************** -->
<!-- **************** End Right Column Create/Update Fields **************** -->       
       </div> <!-- end 2nd column -->        
    </div> <!-- End row containing the left and right Create/Update columns  -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- For formatting the notes field is outside of the row but inside the form -->
<!-- *********************************************************************** -->

 <!--    <p>Create/update fields outside row go here</p> -->
<br>
<?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
<!-- How to handle not updatable but still pass current value to the save   -->
 <div class="form-group  row"><label class="col-sm-2 col-form-label"><strong></strong></label>

     <div class="col-sm-8"><input name="fin_notes" type="text" class="form-control" value="<?= $fin_notes ?>" hidden></div>
</div>
<!-- END --How to handle not updatable by still pass current value to the save   -->
<?php else: ?>

<br>
                                
<div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Financial Notes</h<?= $_SESSION['fontsize'] ?>></label>
    <div class="col-sm-12"><input name="fin_notes" type="text" class="form-control" value="<?= $fin_notes ?>"> <span class="form-text m-b-none"></span>
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
<!-- ******************* Update/Cancel Button Boiler Plate ******************* -->
<!-- *********************************************************************** -->

    <div class="btn-group">

    <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
    <div>

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


<!-- *********************************************************************** -->
<!-- ******************* End Left Column of View Fields ******************** -->
        </div> <!-- end col-6 -->
<!-- *********************************************************************** -->

<!-- *********************************************************************** -->
<!-- ********************* Right Column of View Fields ********************* -->
        <div class="col-md-6">
<!-- *********************************************************************** --> 


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

 <!-- do not uncomment for inner item    </form> -->
<!-- *********************************************************************** --> 

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->
                     
