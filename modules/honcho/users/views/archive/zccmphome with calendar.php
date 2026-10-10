

 <div id="page-wrapper" class="gray-bg"> 
 <div class="row border-bottom">

            <div class="col-sm-2">

           <br>
          
                 <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>  <?= CCMP  ?> Services Portal</a>
          
            </div>
<div class="col-lg-2">
<br>     

<!-- for spacing -->
<!--  <h3><i class="fa fa-home"></i> <?= CCMP  ?> Services Portal</h3> -->
 </div>
<div class="col-lg-5">     
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
                    
     
                            
                            <div class="col-md-1">
                            <br> 
                                                      <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                            <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
                                        </a> 
                            </div>
                            <div class="col-md-10">
                            <br> 
                           
                              <h1><?= $_SESSION['chapter_name'] ?></h1></span> 
                            </div>
</div>



<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq1" class="faq-question">Dashboard</a>
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
                    <div class="ibox-content">
                        <h3>
                            Knob - Dial
                        </h3>
                        <p>
                            Easily create knob input style.
                        </p>
                        <div class="text-center">
                            <small>Simple knob example</small><br/><br/>
                            <div class="m-r-md inline">
                            <input type="text" value="75" class="dial m-r-sm" data-fgColor="#1AB394" data-width="85" data-height="85" />
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="50" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <small>Dynamic knob example</small><br/><br/>
                            <div class="m-r-md inline">
                            <input type="text" value="75" class="dial m-r-sm" data-fgColor="#ED5565" data-width="85" data-height="85" data-cursor=true data-thickness=.3/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-step="1000" data-min="-15000" data-max="15000" data-displayPrevious=true/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="60" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 />
                            </div>
                        </div>
                    </div>
            </div>
            <br>
            <div class="row">
                      <div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-danger m-r-sm">12</button>
                                Total messages
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm">28</button>
                                Posts
                            </td>
                            <td>
                                <button type="button" class="btn btn-info m-r-sm">15</button>
                               Comments
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-info m-r-sm">20</button>
                                News
                            </td>
                            <td>
                                <button type="button" class="btn btn-success m-r-sm">40</button>
                                Likes
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger m-r-sm">30</button>
                                Notifications
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm">20</button>
                                Albums
                            </td>
                            <td>
                                <button type="button" class="btn btn-default m-r-sm">40</button>
                                Groups
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm">30</button>
                                Permissions
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>BPA Current Members</h5> <!--  $sql = "SELECT * FROM ccmps WHERE deceased < 1 AND current_year > $currentyear";    -->
                                <h1 class="no-margins">886,200</h1>
                                <div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Current Chapter Members</h5> <!--  $sql = "SELECT * FROM ccmps WHERE chapter = $chapter AND current_year > $currentyear AND deceased < 1";  -->
                                <h1 class="no-margins">1 738,200</h1>
                                <div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Income last day</h5>
                                <h1 class="no-margins">-200,100</h1>
                                <div class="stat-percent font-bold text-danger">12% <i class="fa fa-level-down"></i></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Income all</h5>
                                <h1 class="no-margins">54,200</h1>
                                <div class="stat-percent font-bold text-danger">24% <i class="fa fa-level-down"></i></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Monthly</span>
                        </div>
                        <h5>Views</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">386,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total views</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">Annual</span>
                        </div>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,800</h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-primary float-right">Today</span>
                        </div>
                        <h5>visits</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins">406,42</h1>
                                <div class="font-bold text-navy">44% <i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                            </div>
                            <div class="col-md-6">
                                <h1 class="no-margins">206,12</h1>
                                <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Monthly income</h5>
                        <div class="ibox-tools">
                            <span class="label label-primary">Updated 12.2015</span>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="flot-chart m-t-lg" style="height: 55px;">
                            <div class="flot-chart-content" id="flot-chart1"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Visits in last 24h</h5>
                                <h2>198 009</h2>
                                <div id="sparkline1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Visits week</h5>
                                <h2>65 000</h2>
                                <div id="sparkline2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Last month</h5>
                                <h2>680 900</h2>
                                <div id="sparkline3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Avarage time</h5>
                                <h2>00:06:40</h2>
                                <div id="sparkline4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Percentage distribution</h5>
                                <h2>42/20</h2>
                                <div class="text-center">
                                    <div id="sparkline5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Percentage division</h5>
                                <h2>100/54</h2>
                                <div class="text-center">
                                    <div id="sparkline6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Percentage distribution</h5>
                                <h2>685/211</h2>
                                <div class="text-center">
                                    <div id="sparkline7"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Percentage division</h5>
                                <h2>240/32</h2>
                                <div class="text-center">
                                    <div id="sparkline8"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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

<!--  Begin Accordian Section -->
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
                                                    <!--    <div class="ibox-content">  --><!-- BEGINNING OF CONTENT FOR SECTION  -->
<!--  ****************************************************************************** -->

    <!--    <div class="row wrapper border-bottom white-bg page-heading"> --><!--BEGINNING OF NOTICES  -->
 

        <div class="wrapper wrapper-content animated fadeInRight"> 
            <br>
            <div class="row"><!-- ROW OF NOTICES  -->


            <!--    <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                                <span class="product-price">
                                New
                                </span>
                                <small class="text-muted">Scope</small> -->
                           <!--    //  <a href="#" class="product-name"> Title</a> -->
                               
                          <!--      <a href="#" class="text-navy"><h2>Title</h2></a> -->


                           <!--  //   <div class="small m-t-xs"> -->
                               
                           <!--         <h3>Description</h3>
                               
                                <div class="m-t text-right"> -->

                                <!-- //   <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                <!--                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

           <!--     <div class="col-md-3">
                    <div class="ibox">
                       <div class="ibox-content product-box"> 


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New
                                </span> 
                                <small class="text-muted">Public</small>
                           <!--     <a href="#" class="product-name"> Title</a> 
                               
                                <a href="#" class="text-navy"><h2>KC BPA Open House</h2></a> 


                        
                               
                                    <h3>Kids will be provided free airplane rides! </h3>
                               
                                <div class="m-t text-right">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Sign Up! <i class="fa fa-long-arrow-right"></i>   </a>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div> -->

                 <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= CCMPS ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>National Dues are Due!</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>It is time to renew your national membership for <?= CURRENT_YEAR ?>! Act now to ensure your chapter receives it <?= CURRENT_YEAR ?> charter.</h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= CCMPS ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>Board Meeting Hotel Reservations</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>­MLK Weekend January 13 – January 16, 2023

Comfort Inn and Suites Montgomery, AL

Please call the hotel directly to make reservations

Comfort Inn and Suites: 10015 Chantilly Parkway, Montgomery, AL 36117

Phone number: (334) 532-4444 

Hotel room prices will start at $96 plus tax. Rental Cars can be arranged through Hertz Rental Car with drop off and pick up at Motion Field

Hertz rental will deliver cars upon request. Please call and make your reservation.

Hertz Rental: (334) 701-4059 </h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= CCMPS ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>September BPA ATIS</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3><a href="https://www.bpapilots.org" target="_blank">www.bpapilots.org</h3>
                                    <p><h4><a href="https://www.dropbox.com/t/DW2tJuohcPM3VSFy" target="_blank">Download</h4></p>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= SUBENTITY  ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>Special Vote</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>We have an opportunity to obtain hangar space at a reduced rate! We will discuss and vote at the next meeting. Please attend!</h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end FAQ  -->


                </div> <!-- ROW   -->
                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF NOTICES SECTION -->



<!--  ****************************************************************************** -->

           <!--     </div> --><!-- END Ibox content END OF CONTENT OF SECTION -->
               </div> <!-- ibox   -->                
                </div> <!-- faq answer-->                              
                            
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->

                </div>
                </div><!-- row   -->
                </div><!-- class md-col-12  -->
                </div><!-- row   --> 
                </div><!-- faq item   -->             

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq3" class="faq-question">Bulletin Board</a>
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
                                    <!--       <div class="ibox-content">  want gray backround -->
                                        <!-- BEGINNING OF CONTENT FOR SECTION  -->
                                        <!--  ****************************************************************************** -->
                <div class="wrapper wrapper-content animated fadeInUp">
                <div class="row">
                 <div class="col-lg-12">
                    <ul class="notes">

                        <li>
                            <div>
                               <small>Eric Woods 1-4-2023</small>
                               <h4>I need a ride to Skyhook!</h4>
                                <p>Leaving from the Nashville metro area. KXYZ is closest. Will split the gas.</p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/274">Contact Me </a> 
                             <!--   <a href="#"><i class="fa fa-trash-o "></i></a> -->
                           
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>Rich Millhouse 1-16-2023</small>
                                <h4>Slightly Used MK-D Comm/Nav</h4>
                                <p>With glideslope and CDI. $1500 OBO</p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/277">Contact Me </a> 
                            </div>
                        </li>
                        <li>
                            <div>
                                <small>David Toliver 1-14-2023</small>
                                <p><h4>Silent Auction!</h4></p>
                                <p>New Bose Headset still in the box. Will update bids daily. Bids close next week.</p>
                                <p> Current bid is $25 </p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/304">Contact Me </a> 
                            </div>
                        </li>
                                                <li>
                            <div>
                               <small>George Thompson 1-4-2023</small>
                               <h4>RV 9A Kit and Caboodle for Sale!</h4>
                                <p>The purchaser has the benefits of an advanced project with no waiting line for pieces.</p>
                                <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/304">Contact Me </a> 
                             <!--   <a href="#"><i class="fa fa-trash-o "></i></a> -->
                           
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
            </div> <!-- End of items  -->

            <!--  ****************************************************************************** -->
        <!--    </div> --><!-- ibox content   -->
            </div> <!-- ibox -->                                
            </div> <!-- End Tab 1 Panel -->
            </div><!-- faq#   -->
            </div><!-- col 12  -->
            </div><!-- row   -->
            </div>
            </div>
            </div><!-- End faq-item  -->  

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->

                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq4" class="faq-question"><!-- <?= SUBENTITY  ?> -->Photos & Videos</a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq4" class="panel-collapse collapse">
                                  
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
                                                    <!--    <div class="ibox-content"> white background -->
                    <!--  ****************************************************************************** -->
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

                <!--  ****************************************************************************** -->
         <!--       </div> --><!--ibox content  --> 
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
              
<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq5" class="faq-question">Job Opportunities</a>
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
                                                   <!--     <div class="ibox-content"> -->
                            <!--  ****************************************************************************** -->


    <!--    <div class="row wrapper border-bottom white-bg page-heading"> --><!--BEGINNING OF NOTICES  -->
 

        <div class="wrapper wrapper-content animated fadeInRight"> 
            <br>
            <div class="row"><!-- ROW OF NOTICES  -->


            <!--    <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                                <span class="product-price">
                                New
                                </span>
                                <small class="text-muted">Scope</small> -->
                           <!--    //  <a href="#" class="product-name"> Title</a> -->
                               
                          <!--      <a href="#" class="text-navy"><h2>Title</h2></a> -->


                           <!--  //   <div class="small m-t-xs"> -->
                               
                           <!--         <h3>Description</h3>
                               
                                <div class="m-t text-right"> -->

                                <!-- //   <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                <!--                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-3">
                    <div class="ibox">
                       <div class="ibox-content product-box"> 


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New
                                </span> -->
                                <small class="text-muted">Members Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>Aviation Maintenance Technology Instructor</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>Train the next generation of A&P mechanics in a new Part-147 training facility.  Full time and Part time available.  Retirees and former military encouraged to apply.  Curricula, syllabi, lesson plans, and projects are all created and ready to go. Must have current FAA Airframe and Powerplant certification.

Must have minimum 3 years verifiable work experience in aircraft maintenance. Aviation Institute of Maintenance Chicago •  

Chicago, Illinois, USA 

Position Type: Permanent 

Salary Range: 62,000-Neg 

Relocation: None 

Travel: None</h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Sign Up! </a> -->
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>

                 <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= CCMPS ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>.</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>.</h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">


                            <div class="product-desc">
                            <!--    <span class="product-price">
                                New 
                                </span> -->
                                <small class="text-muted"><?= CCMPS ?> Only</small>
                           <!--     <a href="#" class="product-name"> Title</a> -->
                               
                                <a href="#" class="text-navy"><h2>.</h2></a> 


                           <!--     <div class="small m-t-xs"> -->
                               
                                    <h3>.</h3>
                               
                                <div class="m-t text-right">

                                <!--    <a href="#" class="btn btn-xs btn-outline btn-primary">Read More <i class="fa fa-long-arrow-right"></i>  </a>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end FAQ  -->


                </div> <!-- ROW   -->
                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF NOTICES SECTION -->




                           <!--  ****************************************************************************** -->                                                        
                                                  <!--      </div> --><!--ibox content  -->
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

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->

                <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq6" class="faq-question">Events Calendar</a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq6" class="panel-collapse">
                                  
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

                            <!--  ****************************************************************************** -->

                                                                <div id="calendar"></div>

                           <!--  ****************************************************************************** -->
                                                                  
                                                                </div><!--ibox content  -->
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
<!--   End Accordian Section -->  
              

<div class="footer">
<!--    <div class="float-right">
        10GB of <strong>250GB</strong> Free.
    </div>-->
    <div>
        <strong>Copyright</strong> Encore Digital Arts &copy; 2022-<?= $_SESSION['current_year'] ?>
    </div> 
</div>







