
	<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>

<div class="row-fluid ui-sortable">				
	<div class="box span12">
		<!-- Begin page header no buttons for create-->
<!--		<div class="box-header" style="margin-bottom: 15px;" data-original-title> if get rid of horz rules-->
		<div class="box-header" data-original-title> 		 
			<h2><i class="fa fa-upload"></i><span class="break"></span><?= $contentheader ?></h2>
				<div class="box-icon"><a style='color: white'> * = required</a></div> 
		</div>
		<!-- End page header no buttons for create-->

				<div class="box-content">
<!-- <php echo($frmpg); die(); ?> -->
			<!--	<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> -->

				<div><hr style="border: 1px solid #d3d3d3"></div>        

				
					<!-- if the $update_id exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
                    <h5 class="title">Upload Picture</h5>
                    <?= validation_errors() ?>	
                    <p>Please choose a primary picture and the hit 'Upload':</p>
                    <?php
                        //   echo form_open_upload($form_location, $attributes, $additional_code); full syntax
                        //   echo form_file_select($name, $attributes, $additional_code); full syntax                        
                        echo form_open_upload('dashboards/index/storeitems/submit_upload_picture/'.$update_id.'/'.$_SESSION['fpg']);
						echo form_file_select('picture');
                        
                        echo form_submit('submit', 'Upload');
						echo '&nbsp;';
						$attributes['class'] = 'button button-outline';
						echo anchor($cancel_url, 'Cancel', $attributes);                                 
                        echo form_close();

?>
 

				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->