			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>

			
			
			<ul class="breadcrumb">
				<li>
			<!--		<i class="icon-home"></i> -->
					<a href="<?php echo base_url('/Users/honcho')?>"><i class="fa fa-microphone"></i> <?php echo lang('site_name');?></a> 
			<!--		<i class="icon-angle-right"></i> -->
				</li>
		<!--		<li><a href="#">Dashboard</a></li> -->
			</ul>

			<div class="row-fluid">	

                                <?php if ($numinactiveposts > 0){ ?>                                         
                                    <a class="quick-button span2" href="<?php echo base_url('Blogposts/manage/1')?>">
                                <?php }else{ ?>
                                    <a class="quick-button span2" href="<?php echo base_url('Blogposts/manage')?>">
                                <?php } ?>                                      
					<i class="fa fa-thumb-tack"></i>
                                        <p><?php echo lang('posts');?></p>
					<span class="badge"><?= $numposts;?></span>
                                        <?php if ($numinactiveposts > 0): ?>                                         
                                            <span class="notification red"><?= $numinactiveposts;?></span>
                                        <?php endif; ?>                                        
				</a>
                                <?php if ($numpendingcmts > 0){ ?>                                         
				<a class="quick-button span2" href="<?php echo base_url('Blogcomments/manage/1')?>">
                                <?php }else{ ?>
				<a class="quick-button span2" href="<?php echo base_url('Blogcomments/manage')?>">
                                <?php } ?>                                           
					<i class="icon-comments-alt"></i>
					<p><?php echo lang('comments');?></p>
					<span class="badge"><?= $numcmts;?></span>
                                        <?php if ($numpendingcmts > 0): ?> 
                                            <span class="notification red"><?= $numpendingcmts;?></span>
                                        <?php endif; ?>
				</a>
                                <?php if ($numpendingrsps > 0){ ?>                                         
				<a class="quick-button span2" href="<?php echo base_url('Blogresponses/manage/1')?>">
                                <?php }else{ ?>
				<a class="quick-button span2" href="<?php echo base_url('Blogresponses/manage')?>">
                                <?php } ?>                                       
					<i class="fa fa-reply"></i>
					<p><?php echo lang('responses');?></p>
					<span class="badge"><?= $numrsps;?></span>
                                        <?php if ($numpendingrsps > 0): ?> 
                                            <span class="notification red"><?= $numpendingrsps;?></span>
                                        <?php endif; ?>
				</a>

			<div class="clearfix"></div>
							
			</div><!--/row-->


	<!-- start: JavaScript

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->