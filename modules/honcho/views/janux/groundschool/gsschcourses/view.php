
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
			<a href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gsccreate/<?= $recid ?>/gscv"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Update</button></a>

<a> </a><a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscdel/<?= $recid ?>/gscv" onClick="return confirm('This scheduled course will be permanently deleted. Confirm Deletion?');">Delete</a><a> </a><a class="btn btn-default" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscmanage">Close</a>
				<div><hr style="border: 1px solid #d3d3d3"></div>        
			<!--	<= validation_errors() ?> -->
				
					<!-- if the $update_id exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
<!--					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/create/<?= $update_id?>"> -->											
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscsubmit">
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
									<label class="control-label" for="inputError" >Course Number </label>
									<div class="controls">
										<input type="text" id="inputError" class="span1"  name="course_number" value="<?= $course_number ?>" readonly>                                                
									</div>
								</div>

							<div class="control-group">
								<label class="control-label" for="inputError" >Course Name </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="title" value="<?= $title ?>" readonly>                                
								</div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Start Date </label>
							  <div class="controls">
								<input type="text" name="start_date" class="span2" id="date01" value="<?= $start_date ?>" readonly>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">End Date </label>
							  <div class="controls">
								<input type="text" name="end_date" class="span2" id="date02" value="<?= $end_date ?>" readonly>
							  </div>
							</div>							

							<div class="control-group">
								<label class="control-label" for="inputError" >Days & Times </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="times" value="<?= $times ?>" readonly>                                
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Description</label>
							  <div class="controls">
								<textarea  name="description" id="textarea2" class="span6" rows="3" readonly><?= $description ?></textarea>
							  </div>
							</div>

							<div class="control-group">
									<label class="control-label" for="selectError3">Active? *</label>
									<div class="controls">
										<?php
										$additional_dd_code = 'id="selectError3"';
										$options = array(
												'1'         => 'Yes',
												'0'         => 'No',
										);
										echo form_dropdown('active', $options, $active, $additional_dd_code, 'disabled=disabled');                                                                 
										?>
										<span class="help-inline" style='color: red' disabled="disabled"></span>
									</div>
							</div>  

							<div class="control-group">
								<label class="control-label" for="inputError" >Type </label>
								<div class="controls">
									<input type="text" id="inputError" class="span6"  name="type" value="<?= $type ?>" readonly>                                                
								</div>
							</div>

							<div class="control-group">
					<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
								<div class="controls">
									<input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
								</div>
							</div>		

						</fieldset>

					          <div><hr style="border: 1px solid #d3d3d3"></div>                                                      

					<!--		<div class="form-actions">                                      
								<a href="<= BASE_URL ?>dashboards/gsschcourses/<= $role_id ?>/gscmanage"><button type="button" class="btn" >Close</button></a>
							</div>	-->					
					</form>   

				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->