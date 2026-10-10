<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> 
<head>
	<title>Ground School Courses</title> 

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
<!--	<link rel="shortcut icon" href="favicon.ico"> -->

	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="themes/unify/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="themes/unify/assets/css/hjastyle.css"> 
<!-- wont work	<link rel="stylesheet" href="klasses_module/css/hjastyle.css">  -->

	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="themes/unify/assets/css/headers/header-v4.css">
	<link rel="stylesheet" href="themes/unify/assets/css/footers/footer-v1.css">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="themes/unify/assets/plugins/animate.css">
	<link rel="stylesheet" href="themes/unify/assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="themes/unify/assets/plugins/font-awesome/css/font-awesome.min.css">

	<!-- For the slider from u1.index.blade.php-->
	<link rel="stylesheet" href="themes/unify/assets/plugins/hjaparallax-slider/css/parallax-slider.css">
	<link rel="stylesheet" href="themes/unify/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

	<!-- CSS Page Style -->
	<link rel="stylesheet" href="themes/unify/assets/css/pages/blog_magazine.css">

	<!-- CSS Theme -->
<!--	<link rel="stylesheet" href="themes/unify/assets/css/theme-colors/default.css" id="style_color">	Grenn -->
	<link rel="stylesheet" href="themes/unify/assets/css/theme-colors/blue.css" id="style_color">
	<link rel="stylesheet" href="themes/unify/assets/css/theme-skins/dark.css">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="themes/unify/assets/css/hjacustom.css"> 
<!-- wont work		<link rel="stylesheet" href="klasses_module/css/hjacustom.css"> -->
</head>

<body>
	<div class="wrapper">
		<!--=== Header v4 ===-->
		<div class="header-v4">

			<!-- Topbar -->
<!-- Common elements are housed in the Welcome module by convention to cascade changes.-->

<!-- didn't want to repeat all the layout files here so didn't use this
        <php include('layouts/ctctopbarv2.php'); ?> -->
<!--  Removed the ? above from <php to keep from erroring out even though commented out -->

<!-- Modules::run convention is controller/method so created a method in Welcome controller that calls ctctopnavbarv2 in the views/layout. Worked! -->
<?php $layout = 'ctcavtopbar' ?>
<?= Modules::run('welcome/runlayout', $layout); ?> 

			<!-- End Topbar -->

			<!-- Navbar -->
<!-- The banner was left on each template page and not included in the nav partial below to allow different banners on each page. -->
			<div class="navbar navbar-default mega-menu" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<div class="row">
							<div class="col-md-2">
					<!--			@include('layouts.hjalogo')  -->
							</div>
							<div class="col-md-10">
				<!--				<a href="#"><img class="header-banner img-responsive" src="themes/unify/assets/img/banners/adds.jpg" width="1000" alt=""></a> -->
								<a href="#"><img class="header-banner img-responsive" src="images/old hja/pages/all/" width="1000" alt=""></a>
							</div>
						</div>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="full-width-menu">Menu Bar</span>
							<span class="icon-toggle">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</span>
						</button>
					</div>
				</div>

				<div class="clearfix"></div>

		<!--	    clude('layouts.hjanav') -->

			<!-- End Navbar -->
		</div>


		<!--=== End Header v4 ===-->

		<!--=== Content Part ===-->

		<!--=== Breadcrumbs ===-->		
    <div class="breadcrumbs">
    <div class="container">
            <h1 class="pull-left"><a href="aviation">Pilot Groundschools</a></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="aviation">Aviation</a></li>
                <li class="active">Groundschool</li>
            </ul>
        </div>
    </div>   
		<!--=== End Breadcrumbs ===-->

<?php $layout = 'ctcavnav' ?>
<?= Modules::run('welcome/runlayout', $layout); ?> 

		<div class="container content"> 

                 <div class="row margin-bottom-30">

               <div class="text-center margin-bottom-80">
                    <h2 class="title-v2 title-center">Groundschool Courses</h2>
                </div>
    </div>  
       <div class="row margin-bottom-30">
            <div class="col-md-9 mb-margin-bottom-30">
                <!-- Accordion v1 -->                
                <div class="panel-group acc-v1" id="accordion-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-One">
                                    {{ $course1->title }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-One" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                            <!--            <img class="img-responsive" src="images/hja/pages/classes/classroom.jpg" alt=""> -->
                                        <img class="img-responsive" src="gscourses_module/images/gleim_pvtkit_org.png" alt="">
                                        
                            <p></p>
                                        <p>Our ground school is taught in our clean, comfortable classroom located at our offices in Fort Washington, Maryland. Our ground school instructors are unmatched in experience in the DC Metro area.</p>                                    
                              <p></p>        
                                 <i class="fa fa-map-marker"></i> <a href="https://www.google.com/maps/@38.749431,-76.957078,14z?hl=en-US" target="_blank">Potomac Airfield (KVKX) 10300 Glen Way, Ft. Washington, MD 20744</a>
     <p></p>  
                                 <img class="img-responsive" src="gscourses_module/images/yellowbiplane.png" alt="">
                                    </div>                     <!-- img/sitepages/classes/n33443_inflight.png-->
                                    <div class="col-md-8">
                               <!--         <p>Our ground school flight training is taught in a clean, comfortable classroom located at Potomac Airfield in Fort Washington, Maryland. Our flight instructors are unmatched in experience in the DC Metro area.</p> -->
                        <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                            <center> <h2>{{ $course1->title }} Schedule</h2> </center>
                            <p>Classes held from 9am to 1pm on scheduled day. Successful completion of this 40 hour course qualifies you to sit for the Private Pilot written exam.</p>
                            <p>Use the Contact Us page to <a href="/contactus">Sign Up Now!</a></p>
                        </div>
                                        <!--Basic Table-->
                <table class="table">
                    <thead>
                        <tr>
                            <th><center>Class</center></th>
                            <th><center>Date</center></th>
                            <th class="hidden-sm">Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course1classes as $ppgss)  

                        <tr>
                            <td><center>{{ $ppgss->sort_order }}</center></td>
                            <td>{{ Carbon\Carbon::parse($ppgss->klassdate)->format('M d, Y') }}</td>
                            <td class="hidden-sm">{{ $ppgss->topic }}</td>                     
                        </tr>

                        @endforeach

<!--                        <tr>
                            <td><center>1</center></td>
                            <td>21 Jan 2017</td>
                            <td class="hidden-sm">Airplanes and Aerodynamics (Ch. 1)</td>                     
                        </tr>
                        <tr>
                            <td><center>2</center></td>
                            <td>28 Jan 2017</td>
                            <td class="hidden-sm">Airplane Instruments, Engines, and Systems (Ch. 2)</td>                       
                        </tr>
                        <tr>
                            <td><center>3</center></td>
                            <td>4 Feb 2017</td>
                            <td class="hidden-sm">Airports, Air Traffic Control, and Airspace (Ch. 3)</td>                       
                        </tr>
                        <tr>
                            <td><center>4</center></td>
                            <td>11 Feb 2017</td>
                            <td class="hidden-sm">FAR's (Ch. 4)</td>                          
                        </tr>
                        <tr>
                            <td><center>5</center></td>
                            <td>18 Feb 2017</td>
                            <td class="hidden-sm">Airplane Performance and Weight and Balance (Ch. 5)</td>                          
                        </tr>
                        <tr>
                            <td><center>6</center></td>
                            <td>25 Feb 2017</td>
                            <td class="hidden-sm">Aeromedical Factors and ADM (Ch. 6)</td>                          
                        </tr>
                        <tr>
                            <td><center>7</center></td>
                            <td>4 Mar 2017</td>
                            <td class="hidden-sm">Aviation Weather (Ch. 7) & Weather Services (Ch. 8)</td>                          
                        </tr>
                        <tr>
                            <td><center>8</center></td>
                            <td>11 Mar 2017</td>
                            <td class="hidden-sm">Navigation: Charts, Publications, Flight Computers (Ch. 9)</td>                          
                        </tr>
                        <tr>
                            <td><center>9</center></td>
                            <td>18 Mar 2017</td>
                            <td class="hidden-sm">Navigation Systems (Ch. 10)</td>                          
                        </tr>
                        <tr>
                            <td><center>10</center></td>
                            <td>25 Mar 2017</td>
                            <td class="hidden-sm">Cross-Country Flight Planning (Ch. 11)</td>                          
                        </tr>      -->


                    </tbody>
                </table>
                <!--End Basic Table-->




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Two">
                                    {{ $course2->title }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-Two" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">

                        <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                            <center> <h2>{{ $course2->title }} Schedule</h2> </center>
                         <center>   <p>Classes start at 6pm on scheduled day. Sign up now!</p> </center>
                     </br>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-check color-green"></i> Experienced instrument instructors with inclimate weather experience</li>
                                            <li><i class="fa fa-check color-green"></i> Learn to handle real-world situations</li>
                                            <li><i class="fa fa-check color-green"></i> FAA Certified Flight Simulator</li>
                                        </ul>                         
                        </div>

                                        <!--Basic Table-->
                <table class="table">
                    <thead>
                        <tr>
                            <th><center>Class</center></th>
                            <th><center>Date</center></th>
                            <th class="hidden-sm">Subject</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($course2classes as $ipgss)  
                        <tr>
                            <td><center>{{ $ipgss->sort_order }}</center></td>
                            <td>{{ Carbon\Carbon::parse($ipgss->klassdate)->format('M d, Y') }}</td>
                            <td class="hidden-sm">{{ $ipgss->topic }}</td>                     
                        </tr>
                        @endforeach

<!--                        <tr>
                            <td><center>1</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Airplane Instruments (2.0 hrs)</td>                     
                        </tr>
                        <tr>
                            <td><center>2</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Attitude Instrument Flying and Aerodynamics (2.0 hrs)</td>                       
                        </tr>
                        <tr>
                            <td><center>3</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Navigation Systems (2.0 hrs)</td>                       
                        </tr>
                        <tr>
                            <td><center>4</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Federal Regulations (2.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>5</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Airports, Air Traffic Control, and Airspace (2.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>6</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Holding and Instrument Approaches (3.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>7</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aeromedical Factors and Aeronautical Decision Making (1.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>8</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aviation Weather (2.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>9</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aviation Weather Services (2.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>10</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">IFR Enroute (2.0 hrs)</td>                          
                        </tr> 
                        <tr>
                            <td><center>11</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">IFR Flights (3.0 hrs)</td>                          
                        </tr>     -->                                            
                    </tbody>
                </table>
                <!--End Basic Table-->

                                    </div>
                                    <div class="col-md-4">
                                        <img class="img-responsive" src="gscourses_module/images/krmnils33_224x350.png" alt="">
                           <!--            <img class="img-responsive" src="img/sitepages/classes/classroom.jpg" alt=""> -->
                            <p></p>
                            <img class="img-responsive" src="gscourses_module/images/n33443872x572cp.jpg" alt=""> 
                             <p></p>
                                        <p>Our ground school is taught in our clean, comfortable classroom located at our offices in Fort Washington, Maryland. Our ground school instructors are unmatched in experience in the DC Metro area.</p>                                    
                              <p></p>        
                                 <i class="fa fa-map-marker"></i> <a href="https://www.google.com/maps/@38.749431,-76.957078,14z?hl=en-US" target="_blank">Potomac Airfield (KVKX) 10300 Glen Way, Ft. Washington, MD 20744</a>
     <p></p>  
                                 
                                    </div>                                           
                                    </div>
                                </div>
                            </div>


                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Three">
                                    {{ $course3->title }}
                                </a>
                            </h4>
                        </div>


                        <div id="collapse-Three" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">

                        <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                            <center> <h2>{{ $course3->title }} Schedule</h2> </center>
                         <center>   <p>Classes start at 6pm on scheduled day. Sign up now!</p> </center>
                     </br>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-check color-green"></i> Taught by experienced career pilots</li>
                                            <li><i class="fa fa-check color-green"></i> Navigate the complexities of the FAA regs on flying for hire</li>
                                            <li><i class="fa fa-check color-green"></i> Learn about the opportunities for commercial pilots</li>
                                        </ul>                         
                        </div>
                                        <!--Basic Table-->
                <table class="table">
                    <thead>
                        <tr>
                            <th><center>Class</center></th>
                            <th>Date</th>
                            <th class="hidden-sm">Subject</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($course3classes as $cpgss)  
                        <tr>
                            <td><center>{{ $cpgss->sort_order }}</center></td>
                            <td>{{ Carbon\Carbon::parse($cpgss->klassdate)->format('M d, Y') }}</td>
                            <td class="hidden-sm">{{ $cpgss->topic }}</td>                     
                        </tr>
                        @endforeach

<!--                        <tr>
                            <td><center>1</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Airplane Instruments (2.0 hrs)</td>                     
                        </tr>
                        <tr>
                            <td><center>2</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Attitude Instrument Flying and Aerodynamics (2.0 hrs)</td>                       
                        </tr>
                        <tr>
                            <td><center>3</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Navigation Systems (2.0 hrs)</td>                       
                        </tr>
                        <tr>
                            <td><center>4</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Federal Regulations (2.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>5</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Airports, Air Traffic Control, and Airspace (2.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>6</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Holding and Instrument Approaches (3.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>7</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aeromedical Factors and Aeronautical Decision Making (1.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>8</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aviation Weather (2.5 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>9</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">Aviation Weather Services (2.0 hrs)</td>                          
                        </tr>
                        <tr>
                            <td><center>10</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">IFR Enroute (2.0 hrs)</td>                          
                        </tr> 
                        <tr>
                            <td><center>11</center></td>
                            <td>TBD</td>
                            <td class="hidden-sm">IFR Flights (3.0 hrs)</td>                          
                        </tr>     -->                                            
                    </tbody>
                </table>
                <!--End Basic Table-->
                        </div>


                                    <div class="col-md-4">
                                        <img class="img-responsive" src="gscourses_module/images/b787_750x320.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Four">
                                    FAA Approved Flight Simulator
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-Four" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                    <p>Available by appointment with your instructor.</p>
                                        <ul class="list-unstyled">
                    <li><i class="fa fa-check color-green"></i> Time tested instrument flying trainer</li>
                    <li><i class="fa fa-check color-green"></i> FAA approved to log flight hours</li>
                    <li><i class="fa fa-check color-green"></i> A highly effective learning environment</li>
                    <li><i class="fa fa-check color-green"></i> We maximize use to save you money!</li>                                            
                </ul> 
                    <p>The ATC 610 may be used to simulate all of the following:</p>
                      <ul class="list-unstyled">
                    <li><i class="fa fa-check color-green"></i> VOR Approaches</li>
                    <li><i class="fa fa-check color-green"></i> ADF Approaches</li>
                    <li><i class="fa fa-check color-green"></i> ILS Approaches</li>
                    <li><i class="fa fa-check color-green"></i> LOC BC Approaches</li>  
                    <li><i class="fa fa-check color-green"></i> DME Arcs</li>
                    <li><i class="fa fa-check color-green"></i> Airway Navigation</li>
                    <li><i class="fa fa-check color-green"></i> Holding Patterns</li>
                    <li><i class="fa fa-check color-green"></i> IFR Cross Countries</li>
                    </ul> 
                                    </div>
                                    <div class="col-md-6">
         <div class="container mediumwhitebg">

            <!-- Portfolio Box (FancyBox)-->
            <ul class="list-unstyled row portfolio-box">
                <li class="col-sm-4">
                    <a class="thumbnail fancybox-button zoomer" data-rel="fancybox-button" title="FAA Approved ATC-610" href="img/sitepages/aircraft/atc610closeup872x549.jpg">
                        <img class="full-width img-responsive" src="gscourses_module/images/atc610closeup872x549.jpg" alt="">
                        <span class="portfolio-box-in">
                            <i class="rounded-x icon-magnifier-add"></i>
                        </span>
                    </a>    
                    <div class="headline-left"><p>FAA Approved ATC-610 (click for larger image)</p></div>
                </li>
            </ul>
            <!-- End Portfolio Box (FancyBox)-->
        </div><!--/end container-->                                       
                                        
                                        
                                  <!--      <img class="img-responsive" src="img/sitepages/aircraft/atc610closeup872x549.jpg" alt="">-->
                                    </div>
                                </div>
                            </div>
                        </div>



                <!-- End Accordion v1 -->
                     </div>
</div>                     
            </div><!--/col-md-9-->
            
                   <div class="col-md-3 col-sm-6">
                        <div class="service-block service-block-blue">
                            <i class="icon-custom icon-color-light rounded-x icon-line icon-pencil"></i>
                    <!--        <h2 class="heading-md">Guaranteed Passage of Your FAA Written Exams!</h2> -->
                            <h2 class="heading-md">Private Pilot</h2> 
                            <h2 class="heading-md">Groundschool Begins</h2>
                            <h2 class="heading-md">This Fall!</h2> 
                            <p>We guarantee you will pass your exam on the first try or you can repeat all or any portion of the course at no charge.</p>
                        </div>
                       <div class="row margin-bottom-20"></div>
                       <!-- Service Box -->
            <div class="row">
            
                  <center>  <img class="" src="gscourses_module/images/gleim_pvtkit.png" alt="">  </center>
                             <div class="row margin-bottom-20"></div>
                <center>    <h1 class="title-v3-md margin-bottom-10">Complete Kits Available!</h1> </center>
                    <p>The Private Pilot Kit includes all of the books and supplies that you need for your training!</p><p> It includes: Flight Bag, Gleim Cap, Flight Computer, FAR/AIM, FAA Test Prep Online-Private Pilot, Logbook, Pilot Handbook, Plotter, Private Pilot Flight Maneuvers and Practical Test Prep, Private Pilot FAA Knowledge Test book, Private Pilot Syllabus book, and Private Pilot Training Record book.</p>
             
              </div>
            <!-- End Service Box -->      
                    </div>
      
    </div>  <!-- /row -->               











 

		</div> <!-- container content -->
		<!-- End Content Part -->

        <!--=== Footer Version 1 ===-->
<?php $layout = 'ctcfooter' ?>
<?= Modules::run('welcome/runlayout', $layout); ?>         

        <!--=== End Footer Version 1 ===-->
	</div><!--/wrapper-->

	<!--=== Style Switcher ===  -->
 <!--   clude('layouts.unify.u1styleswitcher') -->
	<!--=== End Style Switcher ===-->

	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="themes/unify/assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="themes/unify/assets/plugins/jquery/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="themes/unify/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="themes/unify/assets/plugins/back-to-top.js"></script>
	<script type="text/javascript" src="themes/unify/assets/plugins/smoothScroll.js"></script>
	<!-- From u1.index.blade.php -->
	<script type="text/javascript" src="themes/unify/assets/plugins/parallax-slider/js/modernizr.js"></script>
	<script type="text/javascript" src="themes/unify/assets/plugins/parallax-slider/js/jquery.cslider.js"></script>
	<script type="text/javascript" src="themes/unify/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>

	<!-- JS Customization -->
	<script type="text/javascript" src="themes/unify/assets/js/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="themes/unify/assets/js/app.js"></script>
	<script type="text/javascript" src="themes/unify/assets/js/plugins/owl-carousel.js"></script>
	<script type="text/javascript" src="themes/unify/assets/js/plugins/style-switcher.js"></script> 
	<script type="text/javascript" src="themes/unify/assets/js/plugins/parallax-slider.js"></script>	

	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			OwlCarousel.initOwlCarousel();
			StyleSwitcher.initStyleSwitcher();
			ParallaxSlider.initParallaxSlider();
		});
	</script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/respond.js"></script>
	<script src="assets/plugins/html5shiv.js"></script>
	<script src="assets/plugins/placeholder-IE-fixes.js"></script>
	<![endif]-->
</body>
</html>
