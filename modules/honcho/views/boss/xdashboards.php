<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <meta name="description" content="Multipurpose, premium, bootstrap based bussiness, corporate, portfolio, blog, onepage, creative, magazine, personal, landing, coming soon html5 css3 template">

        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,400italic,600italic,700italic,600,800,300,700,800italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <!-- Google Fonts -->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/boss/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/boss/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/boss/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css"> <!-- I created -->
        <link rel="stylesheet" id="color-scheme" href="<?php echo base_url(); ?>assets/boss/css/colors/.css"> <!--Default blue -->
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/boss/images/icons/faviconx57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/boss/images/icons/faviconx72.png">
        
        <!-- Modernizr -->
        <script src="<?php echo base_url(); ?>assets/boss/js/modernizr.js"></script>

        <!--- jQuery -->
        <script src="<?php echo base_url(); ?>assets/boss/js/jquery.min.js"></script>

        <!-- Queryloader -->
        <script src="<?php echo base_url(); ?>assets/boss/js/queryloader2.min.js"></script>
	    
    </head>
    <body>

    <div class="boss-loader-overlay"></div><!-- End .boss-loader-overlay -->

<!-- when you use includes you need the physical location of the file - sidemenu-->

<?php include_once('application/modules/Admin/views/'.$sidemenu.'.php'); ?>
     
        <div id="main-content">
            <div id="admincontent" role="main">
<?php include_once('application/modules/Admin/views/'.$topmenu.'.php'); ?>   
<!--**************************************************-->
<!--  Content goes here - passed module location and name of view file that will fill in this area in $data -->

<div> <!-- see assests/css/custom.css -->

			<?php $this->load->view($module.'/'.$contentfile.'.php'); ?>
</div>

<!--**************************************************--> 
<?php include_once('application/modules/Admin/views/'.$footer.'.php'); ?>               
            </div><!-- End #content -->

        </div><!-- End #main-content -->

        <div class="boss-menu-overlay"></div><!-- End .boss-menu-overlay -->
    </div><!-- End #wrapper -->
<!--    <a href="#top" id="scroll-top" title="Back to Top"><i class="fa fa-angle-up"></i></a> -->
	<!-- END -->

    <!-- Smoothscroll -->
    <script src="<?php echo base_url(); ?>assets/boss/js/smoothscroll.js"></script>

    <script src="<?php echo base_url(); ?>assets/boss/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jquery.hoverIntent.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/waypoints-sticky.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jquery.debouncedresize.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/retina.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jquery.infinitescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jflickrfeed.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/twitter/jquery.tweet.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/contact.js"></script>
    <script src="<?php echo base_url(); ?>assets/boss/js/main.js"></script>
	
    </body>
</html>