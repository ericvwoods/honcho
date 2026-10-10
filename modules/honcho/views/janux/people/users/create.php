<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. vtigercontacts
3) Replace all Ccsingulate ex. Class
4) Replace the fieldset form controls to match database table
-->
<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>

<div class="row-fluid ui-sortable">	<!-- 1  -->			
	<div class="box span12"> <!-- 2  -->	
		<!-- Begin page header no buttons for create-->
<!--		<div class="box-header" style="margin-bottom: 15px;" data-original-title> if get rid of horz rules-->
		<div class="box-header" data-original-title> 		 
			<h2><i class="fa fa-pencil-square-o"></i><span class="break"></span><?= $contentheader ?></h2>
				<div class="box-icon"><a style='color: white'> * = required</a></div> 
		</div>
		<!-- End page header no buttons for create-->

		<div class="box-content"> <!-- 3  -->	

			<!--	<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> -->
								
					<!-- if the $recid exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
				<h3><?= $salutation ?> <?= $firstname ?> <?= $middlename ?> <?= $lastname ?> <?= $suffix ?></h3>

	<!-- 4  -->		<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/index/users/submit">
					<?php if($recid > 0): ?>
						<!--	<div class="form-actions">
								<!-- If record id passed then editing an existing record ->

								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
									<!-- Determine where to go if cancelling ->
									<?php if($frmpg == 'v'): ?>                                       
										<a href="<?= BASE_URL ?>dashboards/index/users/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
									<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page ->
									<a href="<?= BASE_URL ?>dashboards/index/users/manage"><button type="button" class="btn" >Cancel</button></a>
									<?php endif; ?>
							</div>   	
					<br> -->

					<?php endif; ?>
					<div><hr style="border: 1px solid #d3d3d3"></div>  
					<?php if(isset($alerttype)) { ?>	
					<div class="box-content alerts">
						<div class="alert alert-<?= $alerttype ?>">
						<strong><h2><?= validation_errors() ?></h2></strong>
						<button type="button" class="close" data-dismiss="alert">x</button>
						
						</div>
					</div>		
					<?php } ?>	
<!--  ******** CHANGE ***********  --> 

<!-- Unused vtiger_contactdetails fields
$data['photo']         

$data['contactid']
$data['contact_no']             
$data['contacttype']  
$data['website']       
$data['secondaryemail']     
$data['imagename']       
$data['note']         

-->
<fieldset>

<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">

<!--  General Info accordian header -->

	<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingOne4">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
					<h2>Update User Information</h2>
					<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
<!--  add " in" to the class statement below and it will open expanded. The aria-expanded above means nothing -->
		<div id="collapseOne4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne4">
			<div class="panel-body">

<!--  End General Info  accordian header-->

	<div class="control-group">
		<label class="control-label" for="inputError" >Id </label>
		<div class="controls">
			<input type="text" id="inputError" class="span1"  name="recid" value="<?= $recid ?>" readonly>                                                
		</div>
	</div>

	<?php if($inactive == 0): ?> 
	<div class="control-group">
		<label class="control-label">Inactive </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="inactive" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="inactive" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Inactive </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="inactive" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="inactive" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="inputError" >First Name </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="firstname" value="<?= $first_name ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Last Name* </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="lastname" value="<?= $lastname ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Username </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="username" value="<?= $username ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Email </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="email" value="<?= $email ?>">                                                
		</div>
	</div>

	<?php if($recid > 0): ?> 
		<!-- Extract the current selected orgid id -->

		<?php   $role = $data['role'];?>
	<!--	<php print_r($contype); die(); ?> -->

<!-- Dropdown fed by object - updating
// need to get current value and preselect option to that value	-->							
		<div class="control-group">
		<label class="control-label" for="selectError3">Role</label>
			<div class="controls" >
				<select name="contid" id="selectError3">

				<?php	foreach($roledpdwn as $row) { ?>
				<!-- If $row->id = current selected id then mark selected-->
					<?php if($row->id == $role): ?> 
						<option selected value="<?= $row->id ?>"><?= $row->title ?></option>
					<?php else: ?>
						<option value="<?= $row->id ?>"><?= $row->title ?></option>
					<?php endif; ?>
				<?php } ?> 									
				</select>
			</div>
		</div>								
	<?php else: ?> 
<!-- Dropdown fed by object - new record so can just get the full list
// get orgid object for dropdown - you can show $row->title but save $row->id
$data['orgdpdwn'] = $this->model->get('id','orgid');  -->

		<div class="control-group">
		<label class="control-label" for="selectError3">Role</label>
		<div class="controls"  >
			<select name="contid" id="selectError3">
			<?php foreach($roledpdwn as $row) { ?>
				<option value="<?= $row->id ?>"><?= $row->title ?></option>
			<?php } ?> 									
			</select>
		</div>
		</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="inputError" >TG Id </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="tgid" value="<?= $trongate_user_id ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="date01">Last Login </label>
		<div class="controls">
		<input type="text" class="span6" id="date01" name="last_login" value="<?= $last_login ?>">
		</div>
	</div>









<!--  End content for General Info Panel -->

			</div><!-- End .panel-body -->
		</div><!-- End .panel-collapse -->
	</div><!-- End .panel border -->

<!--  ******** Mailing Address ***********  --> 
<!--  Mailing address accordian header -->
<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingTwo4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
				<h2>Update Profile</h2>
				<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
		<div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo4">
			<div class="panel-body">


<!--  end of Mailing address accordian header-->

	<div class="control-group">
		<label class="control-label" for="inputError" >Type 1 Address Id</label>
		<div class="controls">
			<input type="text" id="type1id" class="span6"  name="type1id" value="<?= $type1id ?>" readonly>                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address *</label>
		<div class="controls">
			<input type="text" id="type1address1" class="span6"  name="type1address1" value="<?= $type1address1 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="type1address2" class="span6"  name="type1address2" value="<?= $type1address2 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >City </label>
		<div class="controls">
			<input type="text" id="type1city" class="span6"  name="type1city" value="<?= $type1city ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >State </label>
		<div class="controls">
			<input type="text" id="type1state" class="span6"  name="type1state" value="<?= $type1state ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Zip </label>
		<div class="controls">
			<input type="text" id="type1zip" class="span6"  name="type1zip" value="<?= $type1zip ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Country </label>
		<div class="controls">
			<input type="text" id="type1country" class="span6"  name="type1country" value="<?= $type1country ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >District </label>
		<div class="controls">
			<input type="text" id="type1district" class="span6"  name="type1district" value="<?= $type1district ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >County </label>
		<div class="controls">
			<input type="text" id="type1county" class="span6"  name="type1county" value="<?= $type1county ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Address </label>
		<div class="controls">
			<input type="text" id="type1fulladdress" class="span6"  name="type1fullAddress" value="<?= $type1fullAddress ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Comment </label>
		<div class="controls">
			<input type="text" id="type1comment" class="span6"  name="type1comment" value="<?= $type1comment ?>">                                                
		</div>
	</div>


	</fieldset>

		<!--	</div><!-- End .panel-body -->
	<!--	</div><!-- End .panel-collapse -->
<!--	</div><!-- End .panel -->
<!--  End mailing address panel -->

<

<!--  ******** End of accordian panels ***********  -->




						<!--  ******** END CHANGE ***********  -->  
                                                   
						<div><hr style="border: 1px solid #d3d3d3"></div>

						<div class="form-actions">
							<!-- If record id passed then editing an existing record -->
							<?php if($recid > 0): ?>
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
								<!-- Determine where to go if cancelling -->
								<?php if($frmpg == 'v'): ?>                                       
									<a href="<?= BASE_URL ?>dashboards/index/users/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
								<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
								<a href="<?= BASE_URL ?>dashboards/index/users/manage"><button type="button" class="btn" >Cancel</button></a>
								<?php endif; ?>
							<?php else: ?>
							<!-- If no record id passed then creating a new record -->
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save New User</button>                                       
								<a href="<?= BASE_URL ?>dashboards/index/users/manage"><button type="button" class="btn" >Cancel</button></a>

							<?php endif; ?>
						</div><!--/form-actions--> 	
						



						</form>   <!-- 4  -->
				</div><!--/box-content--> <!-- 3  -->	
	</div><!--/box span12--> <!-- 2  -->	
</div><!--/row-fluid--><!-- 1  -->	