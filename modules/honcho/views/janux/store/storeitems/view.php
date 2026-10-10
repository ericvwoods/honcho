
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
			<h2><i class="fa fa-eye"></i><span class="break"></span><?= $contentheader ?></h2>
			<!--	<div class="box-icon"><a style='color: white'> * = required</a></div> -->
		</div>
		<!-- End page header no buttons for create-->

				<div class="box-content">
			
<!-- <php echo($frmpg); die(); ?> -->
			<!--	<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> -->
			<a href="<?= BASE_URL ?>dashboards/index/storeitems/create/<?= $recid ?>/v"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Update</button></a>
			<a href="<?= BASE_URL ?>dashboards/index/storeitems/update_picture/<?= $recid ?>/v"><button type="button" class="btn btn-warning" >Update Picture</button></a>
<a> </a><a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/storeitems/del/<?= $recid ?>/v" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');">Delete</a><a> </a><a class="btn btn-default" href="<?= BASE_URL ?>dashboards/index/storeitems/manage">Close</a>
				<div><hr style="border: 1px solid #d3d3d3"></div>        
			<!--	<= validation_errors() ?> -->
				
					<!-- if the $update_id exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
										
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/storeitems/<?= $role_id ?>/submit">
						<?= flashdata();
						$flash_msg = '';
						set_flashdata($flash_msg); ?>	
						<?= validation_errors() ?>								

						<fieldset>
							<div class="control-group">

								<div class="control-group">
									<label class="control-label" for="inputError" >Id </label>
									<div class="controls">
										<input type="text" id="inputError" class="span1"  name="recid" value="<?= $recid ?>" readonly>                                                
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="inputError" >Item Name</label>
									<div class="controls">
										<input type="text" id="inputError" class="span6"  name="item_title" value="<?= $item_title ?>" readonly>                                                
									</div>
								</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >In Stock? </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="in_stock" value="<?= $in_stock ?>" readonly>                                
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >Item Code </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="item_code" value="<?= $item_code ?>" readonly>                                
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >Description </label>
								<div class="controls">
									<textarea id="inputError" class="span6" rows="10" name="item_description" readonly>  <?= $item_description ?></textarea>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >Picture </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="picture" value="<?= $picture ?>" readonly>                                
								</div>
							</div>

							<div class="control-group">
					<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
								<div class="controls">
									<input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
								</div>
							</div>		

						</fieldset>
					<!--	<div><hr style="border: 1px solid #d3d3d3"></div>  -->                                                    		
					</form>

				</div><!--/box-content--> 

				<div class="container-fluid">
						<div class="row-fluid">

						<?php if($picture ==''): ?>

						<?php else: ?>
							<div class="col-sm-3 col-md-6 col-lg-4"><img src="<?= BASE_URL ?>store/storeitempics/thumbs/<?= $picture ?>" alt="<?= $item_title ?> pic"></div>
						<?php endif; ?>
	
						</div>
					</div>
<br>
	</div><!--/box span12-->

</div><!--/row-fluid-->
