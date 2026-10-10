<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]--> 
<head>
	<title>[dashboards/views/janux/honcho.php]</title> 

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
<!--	<link rel="shortcut icon" href="favicon.ico"> -->

	<!-- Web Fonts - Unify-->
<!--	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'> -->


	<!-- start: Janux CSS -->
	<!-- start: CSS -->
	<link id="bootstrap-style" href="<?= BASE_URL ?>themes/janux/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= BASE_URL ?>themes/janux/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?= BASE_URL ?>themes/janux/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?= BASE_URL ?>themes/janux/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->

	<!-- <php endif; ?> -->

<!--	<link id="base-style" href="themes/janux/css/style.css" rel="stylesheet"> <!-- Gray - competes w unify below -->
<!--	<link rel="stylesheet" href="dashboards_module/assets/css/ctcstyle.css"> <!-- Green - copied from unify-->
<!-- And with neither style sheet above it is BLUE -->

	<!-- CSS Global Compulsory -->
	<!-- <link rel="stylesheet" href="themes/unify/assets/plugins/bootstrap/css/bootstrap.min.css"> -->


	<!-- CSS Header and Footer form Unify Theme--> <!-- not using the Unify header and footer -->
<!--	<link rel="stylesheet" href="dashboards_module/assets/css/header-v4.css">
	<link rel="stylesheet" href="dashboards_module/assets/css/footer-v1.css"> -->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="<?= BASE_URL ?>themes/assets/janux/img/favicon.ico">
	<!-- end: Favicon -->
</head>

<body>
	<div class="wrapper">
		<!--=== Header v4 ===-->
		<div class="header-v4">
        <!-- Local header is stored in the layouts folder -->
		<!--	<php include('layouts/ctcadmintopbar.php'); ?>  -->
		</div><!--=== End Header v4 ===-->

		<!--=== Content Part ===-->
<!--		<div class="container content"> -->

<?php
 //echo($topmenu);
// this should be the first time through but once you make a menu selection the selection will get overwritten
// I think the  only thing that needs to change is the content file and the breadcrumb
//$role_id = 1;
//$site_name = "Columbia Training Centers";
//$topmenu = 'sysadmin/sysadmintopmenu';
//$sidemenu = 'sysadmin/sysadminsidemenu';
//$footer = 'sysadmin/sysadmin/footer';
//$contentfile = 'sysadmin/sysadmindashboard';
//$breadcrumb = "System Administrator's Dashboard";
//die();
   ?>
					
<!--  <php include($topmenu.'.php');  ?> --> <!-- either here for full screen width or below for container width-->

<!-- end: Header -->

			<div class="container"> 
				
				<div class="row-fluid"> 


					<!-- start: Side  Menu -->
				<!--	<php include($sidemenu.'.php'); ?>	-->				
					<!-- end: Side Menu -->
					
					<noscript>
						<div class="alert alert-block span10">
							<h4 class="alert-heading">Warning!</h4>
							<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
						</div>
					</noscript>

					<!-- start: Content dashboards/views/janux/honcho fed by Dashboards line 73-->
					<div id='content' class="span10">
                    <?php echo('<br>'); ?>
                    <?php echo('<br>'); ?>
                    <?php echo('<br>'); ?>
             <?php include($contentmenu.'.php');  ?> <!--  admins/menus/honchocontentmenu. Or could move above w/o <br> and be screen width -->
			<?php echo('<br>'); ?>
			<?php include($contentfile.'.php'); ?>

			        </div> <!-- end: Content -->

			
					</div> --> <!--/fluid-row 
			</div>     <!-- container-fluid-full -->

	<!--		<div class="clearfix"></div> -->
			<?php include($footer.'.php');  ?> 				
<!--	</div>  container content -->

		<!--=== Footer Version 1 ===-->
<!-- Global footer is stored in the welcome module -->		

<!-- <= Modules::run('welcome/runlayout', $layout); ?>    works -->     

		<!--=== End Footer Version 1 ===-->

</div> <!-- wrapper ->

	<!--=== Style Switcher ===  -->
 <!--   clude('layouts.unify.u1styleswitcher') -->
	<!--=== End Style Switcher ===-->

	<script src="https://use.fontawesome.com/2a4a13bc72.js"></script>

<!-- start: JavaScript-->

<script src="<?= BASE_URL ?>themes/janux/js/jquery-1.9.1.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery-migrate-1.0.0.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.ui.touch-punch.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/modernizr.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/bootstrap.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.cookie.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/fullcalendar.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.dataTables.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/excanvas.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.flot.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.flot.pie.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.flot.stack.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.flot.resize.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.chosen.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.uniform.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.cleditor.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.noty.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.elfinder.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.raty.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.iphone.toggle.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.uploadify-3.1.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.gritter.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.imagesloaded.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.masonry.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.knob.modified.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/jquery.sparkline.min.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/counter.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/retina.js"></script>

<script src="<?= BASE_URL ?>themes/janux/js/custom.js"></script>
<!-- end: JavaScript-->


<script type="text/javascript">
jQuery(document).ready(function() {
//	App.init();

});
</script>
</body>
</html>



