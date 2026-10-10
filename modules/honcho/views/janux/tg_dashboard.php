
<?php 
//echo 'In module Dashboards/views/janux/dashboard.php/';
//$topmenu = $params['topmenu'];  // not passing data
//$role_id = 1;
//$site_name = "Columbia Training Centers";
//$topmenu = 'sysadmin/sysadmintopmenu';
//$sidemenu = 'sysadmin/sysadminsidemenu';
//$footer = 'sysadmin/sysadminfooter';
// will be a general dashboard area then changes when select a menu item 
//$contentfile = 'sysadmin/sysadmindashboard';
//$breadcrumb = "System Administrator's Dashboard";
//echo($topmenu);
//die();
 ?>

<!-- <php $layout = 'ctcfooter' ?>
<= Modules::run('welcome/runlayout', $layout); ?>    works -->   

	 <?php include($topmenu.'.php');  ?> 

	<!-- end: Header -->

	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include($sidemenu.'.php'); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
		<!--	<div id="content" class="span10"> -->
			<div id="content">
			<!--  if you call the view using modules::run it replaces the whole page.  -->
		            <?php include($contentfile.'.php'); ?> 		
			</div>
			<!-- end: Content -->

		
		</div><!--/fluid-row-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>
	<?php include($footer.'.php');  ?> 	


	