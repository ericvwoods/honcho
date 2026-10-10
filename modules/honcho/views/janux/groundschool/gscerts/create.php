<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. gsclasses
3) Replace all Ccsingulate ex. Class
4) Replace the fieldset form controls to match database table
-->
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
			<h2><i class="fa fa-pencil-square-o"></i><span class="break"></span><?= $contentheader ?></h2>
				<div class="box-icon"><a style='color: white'> * = required</a></div> 
		</div>
		<!-- End page header no buttons for create-->

				<div class="box-content">
<!-- <php echo($frmpg); die(); ?> -->
			<!--	<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> -->

				<div><hr style="border: 1px solid #d3d3d3"></div>        
				
					<!-- if the $recid exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
										
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/index/gscerts/submit">

						<?= validation_errors() ?>			

						<!--  ******** CHANGE ***********  --> 

						<fieldset>
							<div class="control-group">
						<!--    <label class="control-label" for="selectError3">Approved? *</label> -->
						<!--	<div class="controls"> -->
						<!--	<php
								$additional_dd_code = 'id="selectError3"';
								$options = array(
										''          => 'Please select...', // optional: used when want to force to choose ie no default
										'1'         => 'Yes',
										'0'         => 'No',
								);
								echo form_dropdown('cmtis_approved', $options, $cmtis_approved, $additional_dd_code);                                                                 
								?>
								<span class="help-inline" style='color: red'><php echo form_error('cmtis_approved'); ?></span>
								</div> 
							</div> -->
						<!--	<php if(recid > 0): ?> -->
								<div class="control-group">
									<label class="control-label" for="inputError" >Id </label>
									<div class="controls">
										<input type="text" id="inputError" class="span1"  name="recid" value="<?= $recid ?>" readonly>                                                
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="inputError" >Cert Code Name*  </label>
									<div class="controls">
										<input type="text" id="inputError" class="span6"  name="title" value="<?= $title ?>">                                                
									</div>
								</div>

							<!--	<div class="control-group">
									<div class="controls">
										<input type="hidden" id="inputError" class="span2"  name="updateid" value="<= $recid ?>">                                                
									</div>
								</div> -->
						
					<!--		<php endif; ?> -->

							<div class="control-group">
								<label class="control-label" for="inputError" >Description </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="description" value="<?= $description ?>">                                
								</div>
							</div>

							<div class="control-group">
					<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
								<div class="controls">
									<input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
								</div>
							</div>		
 
						</fieldset>

						<!--  ******** END CHANGE ***********  -->  

					          <div><hr style="border: 1px solid #d3d3d3"></div>                                                      

							<div class="form-actions">
								<!-- If record id passed then editing an existing record -->
								<?php if($recid > 0): ?>
								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
									<!-- Determine where to go if cancelling -->
									<?php if($frmpg == 'v'): ?>                                       
										<a href="<?= BASE_URL ?>dashboards/index/gscerts/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
									<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
									<a href="<?= BASE_URL ?>dashboards/index/gscerts/manage"><button type="button" class="btn" >Cancel</button></a>
									<?php endif; ?>
								<?php else: ?>
								<!-- If no record id passed then creating a new record -->
								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save New Certcode</button>                                       
									<a href="<?= BASE_URL ?>dashboards/index/gscerts/manage"><button type="button" class="btn" >Cancel</button></a>

								<?php endif; ?>
							</div>						
					</form>   
				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->