

 <div id="page-wrapper" class="gray-bg"> 
 <div class="row border-bottom">

<!--    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> -->
         <!--   <div class="navbar-header"> -->
            <div class="col-sm-2">
            </div>
<div class="col-lg-3">
<br>     
  <h3><?= CCMP  ?> Services Portal</h3>
 </div>
<div class="col-lg-4">     
    <span color="blue" ><h1><?= SITENAME  ?></h1></span>
 </div>
     <!--   </div> -->
<nav class="navbar" role="navigation" style="margin-bottom: 0">

         <ul class="nav navbar-top-links navbar-right">
       
            <li>
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-user"></i> (<?= $_SESSION['ccmp_username'] ?>) </span>
            </li>

                <li>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
        </ul>

    </nav>
</div> 



<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-1">
            <span><img src="<?= BASE_URL ?>welcome_module/images/bpalogo125x103.jpg" alt="BPALogo"> 
        </div>    
        <div class="col-lg-8">
            <br>

            <h1><?= $_SESSION['chapter_name'] ?></h1></span>
       
            <ol class="breadcrumb">
           <!--     <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Extra pages
                </li>
                <li class="breadcrumb-item active">
                    <strong>Calendar</strong>
                </li> -->
            </ol>
        </div>
    </div>


                <div>
                <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq1" class="faq-question">Events Calendar</a>
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
                                                        
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                            </div>  
                                                            <div class="col-lg-6">
                                                                <div class="ibox-content">
                                                                <div id="calendar"></div>
                                                                   </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                            </div>  

                                                        </div><!-- row  -->
                                                     
                                                    </div><!--ibox   -->
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 1 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  -->  
 
                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq2" class="faq-question">Notices</a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq2" class="panel-collapse collapse">
                                  
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
                                                        
                                                        </div>
                                                    </div><!--ibox   -->
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 1 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  -->              

                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq3" class="faq-question"><!-- <?= SUBENTITY  ?> -->Photos & Videos</a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq3" class="panel-collapse collapse">
                                  
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
                                                                       <div class="row">
                    <div class="col-md-3 mb40">


                    </div><!-- End .col-md-6 -->

                     <div class="col-md-4">
                        <br>
                         <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/Trvo5PQWwdw" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   -->
                        </div><!-- End .embed-responsive -->    
                    </div><!-- End .col-md-6 -->
    
                    <div class="col-md-4">
                        <br>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/wixm0fN1QD0" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   -->
                        </div><!-- End .embed-responsive -->  
                

                    </div><!-- End .col-md-6 -->
                    <div class="col-md-1">

                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
                                                        </div>
                                                    </div><!--ibox   -->
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 1 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq5" class="faq-question">Bulletin Board</a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq5" class="panel-collapse collapse">
                                  
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
                                                      
                                                                    <div class="wrapper wrapper-content animated fadeInUp">
                <div class="row">
                 <div class="col-lg-12">
                    <ul class="notes">
                        <li>
                            <div>
                               <small>Eric Woods 1-4-2023</small>
                               <h4>I need a ride to Skyhook!</h4>
                                <p>Leaving from the Nashville metro area. KXYZ is closest. Will split the gas.</p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/1077">Contact Me </a> 
                             <!--   <a href="#"><i class="fa fa-trash-o "></i></a> -->
                           
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>Rich Millhouse 1-16-2023</small>
                                <h4>Slightly Used MK-D Comm/Nav</h4>
                                <p>With glideslope and CDI. $1500 OBO</p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/1077">Contact Me </a> 
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>David Toliver 1-14-2023</small>
                                <h4>Silent Auction! New Bose Headset still in the box. Will update bids daily. Bids close next week.</h4>
                                <p> Current bid is $25 </p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/1262">Contact Me </a> 
                            </div>
                        </li>
                    <!--    <li>
                            <div>
                                <small>3:33:12 6-03-2014</small>
                                <h4>The generated Lorem Ipsum </h4>
                                <p>The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                                <a href="#"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>5:20:11 4-04-2014</small>
                                <h4>Contrary to popular belief</h4>
                                <p>Hampden-Sydney College in Virginia, looked up one.</p>
                                <a href="#"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>2:10:12 4-05-2014</small>
                                <h4>There are many variations</h4>
                                <p>All the Lorem Ipsum generators on the Internet .</p>
                                <a href="#"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>10:15:26 6-04-2014</small>
                                <h4>Ipsum used standard chunk of Lorem</h4>
                                <p>Standard chunk  is reproduced below for those.</p>
                                <a href="#"><i class="fa fa-trash-o "></i></a>
                            </div> 
                        </li> -->
                    </ul>
                </div>
            </div>
                                                        </div>
                                                   
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 1 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  -->              



<div class="footer">
<!--    <div class="float-right">
        10GB of <strong>250GB</strong> Free.
    </div>-->
    <div>
        <strong>Copyright</strong> Encore Digital Arts &copy; 2022-<?= $_SESSION['current_year'] ?>
    </div> 
</div>







