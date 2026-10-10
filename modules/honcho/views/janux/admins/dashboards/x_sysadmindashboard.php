			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>

			
			
	<!--		<ul class="breadcrumb">
				<li>
					<a href="#"><?= $breadcrumb1 ?> </a> <a href="#"><?= $breadcrumb2 ?></a> 
				</li>
			</ul> -->

<!-- Blog -->
			<div class="row-fluid">	
                                <?php if ($numinactiveposts > 0){ ?>                                         
                            <!--        <a class="quick-button span2" href="<php echo base_url('Blogposts/manage/1')?>"> -->
                                <?php }else{ ?>
                            <!--        <a class="quick-button span2" href="<php echo base_url('Blogposts/manage')?>">  -->
                                <?php } ?>                                      
				<!--	<i class="fa fa-thumb-tack"></i>  -->
                                   <!--     <p><php echo lang('posts');?></p> 
					<span class="badge"><?= $numposts;?></span> -->
                                        <?php if ($numinactiveposts > 0): ?>                                         
                                       <!--     <span class="notification red"><?= $numinactiveposts;?></span>  -->
                                        <?php endif; ?>                                        
				</a>
                                <?php if ($numpendingcmts > 0){ ?>                                         
			<!--	<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage/1')?>"> -->
                                <?php }else{ ?>
			<!--	<a class="quick-button span2" href="<php echo base_url('Blogcomments/manage')?>"> -->
                                <?php } ?>                                           
				<!--	<i class="icon-comments-alt"></i> -->
				<!--	<p><php echo lang('comments');?></p>  -->
					<span class="badge"><?= $numcmts;?></span>
                                        <?php if ($numpendingcmts > 0): ?> 
                                            <span class="notification red"><?= $numpendingcmts;?></span>
                                        <?php endif; ?>
				</a>
                                <?php if ($numpendingrsps > 0){ ?>                                         
		<!--		<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage/1')?>">  -->
                                <?php }else{ ?>
		<!--		<a class="quick-button span2" href="<php echo base_url('Blogresponses/manage')?>">  -->
                                <?php } ?>                                       
				<!--	<i class="fa fa-reply"></i>  -->
					<p><php echo lang('responses');?></p>
					<span class="badge"><?= $numrsps;?></span>
                                        <?php if ($numpendingrsps > 0): ?> 
                                            <span class="notification red"><?= $numpendingrsps;?></span>
                                        <?php endif; ?>
				</a>

			<div class="clearfix"></div>
							
			</div><!--/row-->
<!-- End Blog -->
	