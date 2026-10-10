
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
			<!--	<= validation_errors() ?> -->
				
					<!-- if the $update_id exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
<!--					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/create/<?= $update_id?>"> -->											
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscsubmit">

						<?= validation_errors() ?>								

						<fieldset>
							<div class="control-group">

							<?php if($recid > 0): ?>
								<div class="control-group">
									<label class="control-label" for="inputError" >Id </label>
									<div class="controls">
										<input type="text" id="inputError" class="span1"  name="recid" value="<?= $recid ?>" readonly>                                                
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="inputError" >Course Number </label>
									<div class="controls">
										<input type="text" id="inputError" class="span1"  name="course_number" value="<?= $course_number ?>" readonly>                                                
									</div>
								</div>

								<div class="control-group">
								<label class="control-label" for="inputError" >Course Name </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="title" value="<?= $title ?>">                                
								</div>
							</div>
						
							<?php else: ?>							

							<div class="control-group">
						    <label class="control-label" for="selectError3">Choose Course Type *</label> 
							<div class="controls">
							<?php
								$additional_dd_code = 'id="selectError3"';

								echo form_dropdown('type', $gscourseoptions, $preselectopt , $additional_dd_code);  
                                                               
								?>
								<span class="help-inline" style='color: red'><php echo form_error('cmtis_approved'); ?></span>
								</div> 
							</div> 
							<?php endif; ?>

							<div class="control-group">
							  <label class="control-label" for="date01">Course Start Date *</label>
							  <div class="controls">
								<input type="text" name="start_date" class="input-xlarge datepicker" id="date01" value="<?= $start_date ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Course End Date *</label>
							  <div class="controls">
								<input type="text" name="end_date" class="input-xlarge datepicker" id="date02" value="<?= $end_date ?>">
							  </div>
							</div>							

							<div class="control-group">
								<label class="control-label" for="inputError" >Class Days & Times </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="times" value="<?= $times ?>">                                
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >Topic </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="topic" value="<?= $topic ?>">                                
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="description" id="textarea2" rows="3"><?= $description ?></textarea>
							  </div>
							</div>

							<div class="control-group">
									<label class="control-label" for="selectError3">Active? *</label>
									<div class="controls">
										<?php
										$additional_dd_code = 'id="selectError3"';
										$options = array(
												''          => 'Please select...', // optional - used when want to force to choose - no default
												'1'         => 'Yes',
												'0'         => 'No',
										);
										echo form_dropdown('active', $options, $active, $additional_dd_code);                                                                 
										?>
										<span class="help-inline" style='color: red'><php echo form_error('is_active'); ?></span>
									</div>
							</div>  
							<?php if($recid > 0): ?>
								<div class="control-group">
								<label class="control-label" for="inputError" >Type Code </label>
								<div class="controls">
									<input type="text" id="inputError" class="span1"  name="type" value="<?= $type ?>"readonly>                                                
								</div>
							</div>								
							<?php else: ?>
							<?php endif; ?>

							<div class="control-group">
					<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
								<div class="controls">
									<input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
								</div>
							</div>		

						</fieldset>

					          <div><hr style="border: 1px solid #d3d3d3"></div>                                                      

							<div class="form-actions">
								<!-- If record id passed then editing an existing record -->
								<?php if($recid > 0): ?>
								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
									<!-- Determine where to go if cancelling -->
									<?php if($frmpg == 'gscv'): ?>                                       
										<a href="<?= BASE_URL ?>dashboards/gsclasses/<?= $role_id ?>/gscview/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
									<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
									<a href="<?= BASE_URL ?>dashboards/gsclasses/<?= $role_id ?>/gscmanage"><button type="button" class="btn" >Cancel</button></a>
									<?php endif; ?>
								<?php else: ?>
								<!-- If no record id passed then creating a new record -->
								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save New Course</button>                                       
									<a href="<?= BASE_URL ?>dashboards/gsclasses/<?= $role_id ?>/gscmanage"><button type="button" class="btn" >Cancel</button></a>


								<?php endif; ?>
							</div>						
					</form>   

				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->