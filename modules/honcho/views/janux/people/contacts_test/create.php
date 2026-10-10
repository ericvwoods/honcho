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
				<?php if ($recid > 0): ?>
					<h3><?= $salutation ?> <?= $firstname ?> <?= $middlename ?> <?= $lastname ?> <?= $suffix ?></h3> 
				<?php endif; ?>

	<!-- 4  -->		<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/index/contacts_test/submit">


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
					<?php if ($recid > 0): ?>
						<h2>Update Contact Information</h2>
					<?php else: ?> 
						<h2>Add Contact Information</h2>
					<?php endif; ?>
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

	<?php if($recid > 0): ?> <!-- updating -->
		<!-- Extract the current selected contact type id -->

		<?php   $contype = $data['contacttype'];?>


		<!-- Dropdown fed by object - updating
		// need to get current value and preselect option to that value	-->							
				<div class="control-group">
				<label class="control-label" for="selectError3">Contact Type</label>
					<div class="controls" >
						<select name="contacttype" id="selectError3">

						<?php	foreach($contdpdwn as $row) { ?>
						<!-- If $row->id = current selected id then mark selected-->
							<?php if($row->id == $contype): ?> 
								<option selected value="<?= $row->id ?>"><?= $row->title ?></option>
							<?php else: ?>
								<option value="<?= $row->id ?>"><?= $row->title ?></option>
							<?php endif; ?>
						<?php } ?> 									
						</select>
					</div>
				</div>								
			<?php else: ?>  <!-- Adding -->
		<!-- Dropdown fed by object - new record so can just get the full list -->

		<div class="control-group">
		<label class="control-label" for="selectError3">USER LEVEL</label>
		<div class="controls"  >
			<select name="contacttype" id="selectError3">
			<?php foreach($contdpdwn as $row) { ?>
				<option value="<?= $row->id ?>"><?= $row->title ?></option>
			<?php } ?> 									
			</select>
		</div>
		</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="inputError" >Our POC </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="poc" value="<?= $poc ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Salutation </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="salutation" value="<?= $salutation ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >First Name </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="firstname" value="<?= $firstname ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Middle </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="middlename" value="<?= $middlename ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Last Name* </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="lastname" value="<?= $lastname ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Suffix </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="suffix" value="<?= $suffix ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Title </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="title" value="<?= $title ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Department </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="department" value="<?= $department ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Name </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="reportsto" value="<?= $reportsto ?>">                                                
		</div>
	</div> 
	 
	<?php if($recid > 0): ?> <!--updating -->

		<!-- Extract the current selected company id -->
		<?php   $companyid = $data['company']; ?>

		<!-- Dropdown fed by object - updating
		// need to get current value and preselect option to that value	-->							
				<div class="control-group">
				<label class="control-label" for="selectError3">Company</label>
					<div class="controls" >
						<select name="company" id="selectError3">

						<?php	foreach($compdpdwn as $row) { ?>
						<!-- If $row->id = current selected id then mark selected-->
						<?php if($row->id == $companyid): ?> 
							<option selected value="<?= $row->id ?>"><?= $row->name ?></option>
						<?php else: ?>
							<option value="<?= $row->id ?>"><?= $row->name ?></option>
						<?php endif; ?>
						<?php } ?> 									
						</select>
					</div>
				</div>								
			<?php else: ?> <!-- Adding a new record -->
		<!-- Dropdown fed by object - new record so can just get the full list -->

		<div class="control-group">
		<label class="control-label" for="selectError3">Company</label>
		<div class="controls"  >
			<select name="companyzz" id="selectError3">
			<?php foreach($compdpdwn as $row) { ?>
				<option value="<?= $row->id ?>"><?= $row->name ?></option>
			<?php } ?> 									
			</select>
		</div>
		</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="inputError" >Email </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="email" value="<?= $email ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Website </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="website" value="<?= $website ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Mobile </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="mobile" value="<?= $mobile ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Office Phone </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="phone" value="<?= $phone ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Other Phone </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="phoneother" value="<?= $phoneother ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Fax </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="fax" value="<?= $fax ?>">                                                
		</div>
	</div>

	<?php if($gender == ""): ?> 
	<div class="control-group">
	<label class="control-label" for="selectError3" >Gender </label>
		<div class="controls">
			<select id="selectError3" name="gender">
			    <option selected>Please select...</option>
				<option>Male</option>
				<option>Female</option>
				<option>Transgendered</option>
			</select>
		</div>
	</div>
	<?php endif; ?>
	<?php if($gender == "Male"): ?> 
	<div class="control-group">
	<label class="control-label" for="selectError3" >Gender </label>
		<div class="controls">
			<select id="selectError3" name="gender">
				<option selected>Male</option>
				<option>Female</option>
				<option>Transgendered</option>
			</select>
		</div>
	</div>
	<?php endif; ?>
	<?php if($gender == "Female"): ?> 
	<div class="control-group">
	<label class="control-label" for="selectError3" >Gender </label>
		<div class="controls">
			<select id="selectError3" name="gender">
				<option>Male</option>
				<option selected>Female</option>
				<option>Transgendered</option>
			</select>
		</div>
	</div>
	<?php endif; ?>
	<?php if($gender == "Transgendered"): ?> 
	<div class="control-group">
	<label class="control-label" for="selectError3" >Gender </label>
		<div class="controls">
			<select id="selectError3" name="gender">
				<option>Male</option>
				<option>Female</option>
				<option selected>Transgendered</option>
			</select>
		</div>
	</div>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="date01">Birthdate </label>
		<div class="controls">
		<input type="text" class="input-xlarge datepicker" id="date01" name="birthdate" value="<?= $birthdate ?>">
		</div>
	</div>

<!--	<div class="control-group">
		<label class="control-label" for="inputError" >Birthdate </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="birthdate" value="<?= $birthdate ?>">                                                
		</div>
	</div> -->


	<div class="control-group">
		<label class="control-label" for="inputError" >Assistant </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="assistant" value="<?= $assistant ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Assistant Phone </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="assistantphone" value="<?= $assistantphone ?>">                                                
		</div>
	</div>


	<div class="control-group">
		<label class="control-label" for="inputError" >Assistant Email </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="assistantemail" value="<?= $assistantemail ?>">                                                
		</div>
	</div>

	<?php if($donotcall == 0): ?> 
	<div class="control-group">
		<label class="control-label">Do not call </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="donotcall" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="donotcall" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Do not call </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="donotcall" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="donotcall" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>


	<?php if($emailoptout == 0): ?> 
	<div class="control-group">
		<label class="control-label">Email Opt Out </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="emailoptout" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="emailoptout" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Email Opt Out</label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="emailoptout" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="emailoptout" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>

	<?php if($shopcustomer == 0): ?> 
	<div class="control-group">
		<label class="control-label">Shop Customer </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="shopcustomer" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="shopcustomer" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Shop Customer </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="shopcustomer" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="shopcustomer" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>



	<?php if($vip == 0): ?> 
	<div class="control-group">
		<label class="control-label">VIP </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="vip" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="vip" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">VIP </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="vip" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="vip" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>

	<?php if($donor == 0): ?> 
	<div class="control-group">
		<label class="control-label">Donor </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="donor" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="donor" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Donor </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="donor" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="donor" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>

	<?php if($recid > 0): ?> 
		<!-- Extract the current selected level id -->

		<?php   $donlvl = $data['level'];?>
	<!--	<php print_r($contype); die(); ?> -->

<!-- Dropdown fed by object - updating
// need to get current value and preselect option to that value	-->							
		<div class="control-group">
		<label class="control-label" for="selectError3">Donor Level</label>
			<div class="controls" >
				<select name="level" id="selectError3">

				<?php	foreach($dldpdwn as $row) { ?>
				<!-- If $row->id = current selected id then mark selected-->
					<?php if($row->id == $donlvl): ?> 
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

		<div class="control-group">
		<label class="control-label" for="selectError3">Donor Level</label>
		<div class="controls"  >
			<select name="contacttype" id="selectError3">
			<?php foreach($dldpdwn as $row) { ?>
				<option value="<?= $row->id ?>"><?= $row->title ?></option>
			<?php } ?> 									
			</select>
		</div>
		</div>
	<?php endif; ?>

	<?php if($sponsor == 0): ?> 
	<div class="control-group">
		<label class="control-label">Sponsor </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="sponsor" id="optionsRadios1" value="0" checked="">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="sponsor" id="optionsRadios2" value="1">
			Yes
			</label>
		</div>
	</div>
	<?php else: ?> 
		<div class="control-group">
		<label class="control-label">Sponsor </label>
		<div class="controls">
			<label class="radio">
			<input type="radio" name="sponsor" id="optionsRadios1" value="0">
			No
			</label>
			<div style="clear:both"></div>
			<label class="radio">
			<input type="radio" name="sponsor" id="optionsRadios2" value="1" checked="">
			Yes
			</label>
		</div>
	</div>
	<?php endif; ?>

	<?php if($recid > 0): ?> 
		<!-- Extract the current selected leadsource id -->
		<?php   $lsid = $data['leadsource'];?>
<!-- Dropdown fed by object - updating
// need to get current value and preselect option to that value	-->							
		<div class="control-group">
		<label class="control-label" for="selectError3">Lead Source</label>
		<div class="controls" >
			<select name="leadsource" id="selectError3">

			<?php	foreach($lsdpdwn as $row) { ?>
			<!-- If $row->id = current selected id then mark selected-->
			<?php if($row->id == $lsid): ?> 
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
// get leadsource object for dropdown - you can show $row->title but save $row->id
$data['lsdpdwn'] = $this->model->get('id','leadsources');  -->

		<div class="control-group">
		<label class="control-label" for="selectError3">Lead Source</label>
		<div class="controls"  >
			<select name="leadsource" id="selectError3">
			<?php foreach($lsdpdwn as $row) { ?>
				<option value="<?= $row->id ?>"><?= $row->title ?></option>
			<?php } ?> 									
			</select>
		</div>
		</div>
	<?php endif; ?>

	<div class="control-group hidden-phone">
		<label class="control-label" for="notes">Notes </label>
		<div class="controls">
		<textarea class="cleditor" id="notes" name="notes" rows="5"><?= $notes ?></textarea>
	<!--	<textarea class="cleditor" id="notes" name="notes" rows="5" value="<?= $notes ?>"> -->
		</div>
	</div>

	<div class="control-group">
<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
		<div class="controls">
			<input type="hidden" id="frmpg" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
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
				<?php if ($recid > 0): ?>
					<h2>Update Mailing Address</h2>
				<?php else: ?> 
					<h2>Add Mailing Address</h2>
				<?php endif; ?>
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
			<input type="text" id="type1fulladdress" class="span6"  name="type1fulladdress" value="<?= $type1fulladdress ?>">                                                
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

<!--  ******** Physical Address Panel ***********  --> 
	<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingThree4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
				<?php if ($recid > 0): ?>
					<h2>Update Physical Address</h2>
				<?php else: ?> 
					<h2>Add Physical Address</h2>
				<?php endif; ?>
					<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
	<div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree4">
		<div class="panel-body">

		<div class="control-group">
		<label class="control-label" for="inputError" >Type 2 Address Id</label>
		<div class="controls">
			<input type="text" id="type2id" class="span6"  name="type2id" value="<?= $type2id ?>" readonly>                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address *</label>
		<div class="controls">
			<input type="text" id="type2address1" class="span6"  name="type2address1" value="<?= $type2address1 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="type2address2" class="span6"  name="type2address2" value="<?= $type2address2 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >City </label>
		<div class="controls">
			<input type="text" id="type2city" class="span6"  name="type2city" value="<?= $type2city ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >State </label>
		<div class="controls">
			<input type="text" id="type2state" class="span6"  name="type2state" value="<?= $type2state ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Zip </label>
		<div class="controls">
			<input type="text" id="type2zip" class="span6"  name="type2zip" value="<?= $type2zip ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Country </label>
		<div class="controls">
			<input type="text" id="type2country" class="span6"  name="type2country" value="<?= $type2country ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >District </label>
		<div class="controls">
			<input type="text" id="type2district" class="span6"  name="type2district" value="<?= $type2district ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >County </label>
		<div class="controls">
			<input type="text" id="type2county" class="span6"  name="type2county" value="<?= $type2county ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Address </label>
		<div class="controls">
			<input type="text" id="type2fulladdress" class="span6"  name="type2fulladdress" value="<?= $type2fulladdress ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Comment </label>
		<div class="controls">
			<input type="text" id="type2comment" class="span6"  name="type2comment" value="<?= $type2comment ?>">                                                
		</div>
	</div>


	</fieldset>

			</div><!-- End .panel-body -->
		</div><!-- End .panel-collapse -->
	</div><!-- End .panel border-->


 <!--</div><!-- End .panel-group ??? where go?-->

<!--  End mailing address panel -->

<!--  ******** Billing Address ***********  --> 
<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingFour4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
				<?php if ($recid > 0): ?>
					<h2>Update Billing Address</h2>
				<?php else: ?> 
					<h2>Add Billing Address</h2>
				<?php endif; ?>
					<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
	<div id="collapseFour4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour4">
		<div class="panel-body">

		<div class="control-group">
		<label class="control-label" for="inputError" >Type 3 Address Id</label>
		<div class="controls">
			<input type="text" id="type3id" class="span6"  name="type3id" value="<?= $type3id ?>" readonly>                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address *</label>
		<div class="controls">
			<input type="text" id="type3address1" class="span6"  name="type3address1" value="<?= $type3address1 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="type3address2" class="span6"  name="type3address2" value="<?= $type3address2 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >City </label>
		<div class="controls">
			<input type="text" id="type3city" class="span6"  name="type3city" value="<?= $type3city ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >State </label>
		<div class="controls">
			<input type="text" id="type3state" class="span6"  name="type3state" value="<?= $type3state ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Zip </label>
		<div class="controls">
			<input type="text" id="type3zip" class="span6"  name="type3zip" value="<?= $type3zip ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Country </label>
		<div class="controls">
			<input type="text" id="type3country" class="span6"  name="type3country" value="<?= $type3country ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >District </label>
		<div class="controls">
			<input type="text" id="type3district" class="span6"  name="type3district" value="<?= $type3district ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >County </label>
		<div class="controls">
			<input type="text" id="type3county" class="span6"  name="type3county" value="<?= $type3county ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Address </label>
		<div class="controls">
			<input type="text" id="type3fulladdress" class="span6"  name="type3fulladdress" value="<?= $type3fulladdress ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Comment </label>
		<div class="controls">
			<input type="text" id="type3comment" class="span6"  name="type3comment" value="<?= $type3comment ?>">                                                
		</div>
	</div>


	</fieldset>

	</div><!-- End .panel-body -->
 </div><!-- End .panel-collapse -->
</div><!-- End .panel border-->

<!--  End billing address accordian -->

<!--  ******** Shipping Address ***********  --> 

<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingFive4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive4" aria-expanded="false" aria-controls="collapseFive4">
				<?php if ($recid > 0): ?>
					<h2>Update Shipping Address</h2>
				<?php else: ?> 
					<h2>Add Shipping Address</h2>
				<?php endif; ?>
					<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
	<div id="collapseFive4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive4">
		<div class="panel-body">

		<div class="control-group">
		<label class="control-label" for="inputError" >Type 4 Address Id</label>
		<div class="controls">
			<input type="text" id="type4id" class="span6"  name="type4id" value="<?= $type4id ?>" readonly>                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address *</label>
		<div class="controls">
			<input type="text" id="type4address1" class="span6"  name="type4address1" value="<?= $type4address1 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="type4address2" class="span6"  name="type4address2" value="<?= $type4address2 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >City </label>
		<div class="controls">
			<input type="text" id="type4city" class="span6"  name="type4city" value="<?= $type4city ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >State </label>
		<div class="controls">
			<input type="text" id="type4state" class="span6"  name="type4state" value="<?= $type4state ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Zip </label>
		<div class="controls">
			<input type="text" id="type4zip" class="span6"  name="type4zip" value="<?= $type4zip ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Country </label>
		<div class="controls">
			<input type="text" id="type4country" class="span6"  name="type4country" value="<?= $type4country ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >District </label>
		<div class="controls">
			<input type="text" id="type4district" class="span6"  name="type4district" value="<?= $type4district ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >County </label>
		<div class="controls">
			<input type="text" id="type4county" class="span6"  name="type4county" value="<?= $type4county ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Address </label>
		<div class="controls">
			<input type="text" id="type4fulladdress" class="span6"  name="type4fulladdress" value="<?= $type4fulladdress ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Comment </label>
		<div class="controls">
			<input type="text" id="type4comment" class="span6"  name="type4comment" value="<?= $type4comment ?>">                                                
		</div>
	</div>


	</fieldset>

	</div><!-- End .panel-body -->
 </div><!-- End .panel-collapse -->
</div><!-- End .panel border-->

<!--  End Shipping address accordian -->

<!--  ******** End of accordian panels ***********  -->




						<!--  ******** END CHANGE ***********  -->  
                                                   
						<div><hr style="border: 1px solid #d3d3d3"></div>

						<div class="form-actions">
							<!-- If record id passed then editing an existing record -->
							<?php if($recid > 0): ?>
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
								<!-- Determine where to go if cancelling -->
								<?php if($frmpg == 'v'): ?>                                       
									<a href="<?= BASE_URL ?>dashboards/index/contacts_test/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
								<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
								<a href="<?= BASE_URL ?>dashboards/index/contacts_test/manage"><button type="button" class="btn" >Cancel</button></a>
								<?php endif; ?>
							<?php else: ?>
							<!-- If no record id passed then creating a new record -->
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save New Test Contact</button>                                       
								<a href="<?= BASE_URL ?>dashboards/index/contacts_test/manage"><button type="button" class="btn" >Cancel</button></a>

							<?php endif; ?>
						</div><!--/form-actions--> 	
						



						</form>   <!-- 4  -->
				</div><!--/box-content--> <!-- 3  -->	
	</div><!--/box span12--> <!-- 2  -->	
</div><!--/row-fluid--><!-- 1  -->	