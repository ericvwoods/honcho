
<!-- *********************************************************************** -->
<!-- **** Begin Boiler Plate forinner CRUD Item - no form open or close **** -->
<!-- *********************************************************************** -->

<div class="faq-item"> <!-- Ends at end of file -->

        <div class="row"> <!-- Row One  -->
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-3">
                        <!-- #faq? must be unique but not in any order  -->
                        <a data-toggle="collapse" href="#faq2" class="faq-question" style="color:cornflowerblue;"><h<?= $_SESSION['fontsize'] ?>>Inner CRUD Item</h<?= $_SESSION['fontsize'] ?>></a>
                    </div> <!-- end col -->
                </div> <!-- row -->
            </div> 
        </div><!-- End Row One  -->

        <div class="row"> <!-- Begin Row Two - Ends near end of file -->
            <div class="col-lg-12"> <!--   -->

                <!-- $_SESSION['crudtab'] must be equal to #faq number  -->
                <?php if($_SESSION['crudtab'] == 2): ?>
                    <div id="faq2" class="panel-collapse">
                <?php else: ?>
                    <div id="faq2" class="panel-collapse collapse">
                <?php endif; ?> 
                    <div class="faq-answer">
                <div class="ibox-content"> 

        <!-- Show flash message then reset it to blank  -->
        <!-- $_SESSION['crudtab'] must be equal to #faq number  -->
        <?php if($_SESSION['crudtab'] == 2): ?> <!-- can only show the flashmsg once on a page - show in the open section -->
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


   <p> Left column create/update fields go here </p>

       
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
        
  <!-- Change the /2 if necessary to this tab number to signify tab to return to after edit/cancel/exit -->

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>> </a>
    <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>

    </div>

    <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
    <div>

    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
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

 <!-- do not uncomment for inner item    </form> -->
<!-- *********************************************************************** --> 

    <?php endif; ?> <!--  End Create/Update else View   -->
    
<!-- *********************************************************************** -->
<!-- ***************** End Create/Update/View Section ********************** -->
<!-- *********************************************************************** --> 
                                                          
        </div> <!-- End Column 12 -->                     
    </div><!-- End Row Two -->
</div> <!-- End FAQ Item -->
                     
