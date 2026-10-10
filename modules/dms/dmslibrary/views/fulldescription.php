
<?php 
  include('navbar.php');
?>
<div class="container">    
<!-- <div class="row"> -->
    <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-2">
    <br> 
       <a href="#" title="fullbulletin">
           <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
       </a> 
    </div>

    <div class="col-md-10">
    <br> 
        <!--Blue   --> <span class="m-r"><a href="#"><h1>x<?= $title ?></h1></a>  </span> 

  <!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
    </div>
</div>



<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-12">
                                    
<!-- The higher the number the smaller the font -->

 <!--<?= $fontsize = 4; ?> <!-- for testing  -->

<?php $fontsize = $_SESSION['fontsize']; ?> 

<!-- Trying to prevent print from being too small  -->
<?php if($fontsize > 3): ?> 
    <?= $fontsize = 3; ?> 
   
<?php endif; ?>     

<a href="#" > <h<?= $fontsize ?>> <strong><?= $author ?></strong></h<?= $fontsize ?>></a>

<h<?= $fontsize ?>> <strong>Posted</strong> <?= $created_at ?></h<?= $fontsize ?>>      
                          
<?php if(strlen($location) > 0): ?>

    <h<?= $fontsize ?>> <strong>Location</strong> <?= $location ?></h<?= $fontsize ?>>                                 

 <?php endif; ?>

 <?php if(strlen($shortdescription) > 0): ?>                                
                        
    <h<?= $fontsize ?>> <strong>Description</strong> <?= $shortdescription ?></h<?= $fontsize ?>>                                  

 <?php endif; ?>
                  
</div> <!-- col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            
                <div id="faq1" class="panel-collapse">
          
                    <div class="faq-answer">

                            <div class="ibox ">

                                <div class="ibox-content">
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">
 

            <div class="row">
 
                       <h<?= $fontsize ?>> <?= $fulldescription ?></h<?= $fontsize ?>>
                       
                    <!--   <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?= BASE_URL ?>/cms-ccmpslibrary/50/hello.docx' ' width='1366px' height='623px' frameborder='0'></iframe> -->
<!-- <iframe src="<?= BASE_URL ?>/cms-ccmpslibrary/50/hello.docx" ></iframe> -->
  <iframe src="https://docs.google.com/gview?url=<?= BASE_URL ?>/cms-ccmpslibrary/50/hello.docx&embedded=true"></iframe>
<iframe src="http://docs.google.com/gview?url=http://localhost/honchocore/modules/cms/ccmpslibrary/assets/50/hello.docx"></iframe>  
            </div>

            <br>
            <div class="row">

                 <?php $_SESSION['tab'] = 0 ?> <!-- There is no Library section on the ccmphome  -->



                <?php if($_SESSION['admode'] == 'mmyads'): ?>   

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/mmyads" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>
                <?php endif; ?> 

                <?php if($_SESSION['admode'] == 'mmyadsv'): ?>   

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/viewdoc/<?= $id ?>" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>
                <?php endif; ?> 

                <?php if($_SESSION['admode'] == 'momads'): ?>             

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/momads" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>                 
                                  
                <?php endif; ?> 

                <?php if($_SESSION['admode'] == 'momadsv'): ?>             

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/viewdoc/<?= $id ?>" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>                 
                                  
                <?php endif; ?> 


                <?php if($_SESSION['admode'] == 'cmmads'): ?>             

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/manage/cmmads" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>                 
                                  
                <?php endif; ?> 

                <?php if($_SESSION['admode'] == 'cmmadsv'): ?>             

                    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>cms-library/viewdoc/<?= $id ?>" ><h<?= $fontsize ?>><i class="fa fa-list"></i> Back</h<?= $fontsize ?>></a>                 
                                  
                <?php endif; ?> 


            </div>
                           <!--  ****************************************************************************** -->
                                                        </div><!--ibox content  -->
                </div><!--ibox   -->       
                </div> <!-- faq answer-->                                  
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->
                </div><!-- col 12  -->
                </div><!-- row   -->
                </div>
                </div>
                </div><!-- End faq-item  -->
<!--   End Accordian Section -->  

                <div>

<!--   End Accordian Section --> 

</div>              




