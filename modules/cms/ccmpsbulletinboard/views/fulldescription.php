
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
        <!--Blue   --> <span class="m-r"><a href="#"><h1><?= $title ?></h1></a>  </span> 

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
                                    
<!--  the higher the number the smaller the font -->
<?php $oneless = $_SESSION['fontsize'] + 1; ?>                                     
                                    
<!-- <a data-toggle="collapse" href="#faq1" class="faq-question">Dashboard Metrics</a> -->
                        <?php if($oneless > 3): ?>
  <h3>    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $ccmp_id ?>"><strong><?= $poster ?> </strong> <?= $contact_info ?> <?= $alt_contact_info ?></h3></a>
                        <?php else: ?>
   <h<?= $_SESSION['fontsize'] ?>>    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $ccmp_id ?>" > <strong><?= $poster ?> </strong> <?= $contact_info ?> <?= $alt_contact_info ?></h<?= $_SESSION['fontsize'] ?>></a>                       
                        <?php endif; ?>             
 




                          <?php if($oneless > 3): ?>
                                <h3><strong>Posted</strong> <?= $created_at ?></h3>
                          <?php else: ?>
                                <h<?= $oneless ?>><strong>Posted</strong> <?= $created_at ?></h<?= $oneless ?>>
                          <?php endif; ?> 
                          
                          
 <?php if(strlen($cost) > 0): ?>                                
                        <?php if($oneless > 3): ?>
                            <h3> <strong>Price</strong> <?= $cost ?></h3>                                
                        <?php else: ?>        
                            <h<?= $oneless ?>> <strong>Price</strong> <?= $cost ?></h<?= $oneless ?>>
                        <?php endif; ?> 
 <?php endif; ?>
                          
  <?php if(strlen($current_bid) > 0): ?>
                           <?php if($oneless > 3): ?>
                                <h3><strong>Best Offer</strong> <?= $current_bid ?></h3>
                            <?php else: ?>
                                <h<?= $oneless ?>><strong>Best Offer</strong> <?= $current_bid ?></h<?= $oneless ?>>
                            <?php endif; ?>                          
 <?php endif; ?>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq1" class="panel-collapse">
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                        <div class="ibox-content">
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">
 
            <div class="row">
            <?php if($oneless > 3): ?>                
                <h3><strong><?= $shortdescription ?></strong></h3>
                
            <?php else: ?>
                <h<?= $_SESSION['fontsize'] ?>><strong><?= $shortdescription ?></strong></h<?= $_SESSION['fontsize'] ?>>
                
            <?php endif; ?> 
            </div>

            <br>
            <div class="row">
            <?php if($oneless > 3): ?>
                    <?php $_SESSION['tab'] = 3 ?>
                         <h3><?= $fulldescription ?></h3>   
                
            <?php else: ?>
                   <?php $_SESSION['tab'] = 3 ?>         
                <h<?= $oneless ?>><?= $fulldescription ?></h<?= $oneless ?>>
            <?php endif; ?> 
                
            </div>

            <br>
            <div class="row">
 <?php if($oneless > 3): ?>
                <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h3>Close</h3></a>
  <?php else: ?>               
               <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h<?= $oneless ?>>Close</h<?= $oneless ?>></a>
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






   <!-- Begin Modals -->
          
<div class="modal inmodal fade" id="bulletin-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:Blue;"><i class="fa fa-book"></i> Read More...</h4>
            </div>
            <div class="modal-body">
                <p><h1 style="color:Blue;"><strong>Bulletin</strong></h1></p>
                <h3><?= $row->fulldescription ?></h3>
                <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                            <img src="<?= BASE_URL ?>welcome_module/images/" alt="pic">
                                        </a> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <!--   <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-bulletinboard/delrecord/<?= $row->id ?>/m">Delete </a> -->
            </div>
        </div>
    </div>
</div> 



