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
										
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/index/ccmps/submit">
					<?php if($recid > 0): ?>
							<div class="form-actions">
								<!-- If record id passed then editing an existing record -->

								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save Changes</button>
									<!-- Determine where to go if cancelling -->
									<?php if($frmpg == 'v'): ?>                                       
										<a href="<?= BASE_URL ?>dashboards/index/ccmps/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
									<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
									<a href="<?= BASE_URL ?>dashboards/index/ccmps/manage"><button type="button" class="btn" >Cancel</button></a>
									<?php endif; ?>


							</div>	
<br>
<br>
<?php endif; ?>
					<?php if(isset($alerttype)) { ?>	
					<div class="box-content alerts">
						<div class="alert alert-<?= $alerttype ?>">
						<strong><h2><?= validation_errors() ?></h2></strong>
						<button type="button" class="close" data-dismiss="alert">×</button>
						
						</div>
					</div>		
					<?php } ?>	
<!--  ******** CHANGE ***********  --> 

<!-- Unused vtiger_contactdetails fields
$data['photo']         

$data['contactid']
$data['contact_no']             
$data['contacttype']  
$data['otheremail']       
$data['secondaryemail']     
$data['imagename']       
$data['note']         

-->
<fieldset>

<!--<div class="control-group">
		<div class="controls"> 
			<input type="hidden" id="inputError" class="span2"  name="updateid" value="<= $recid ?>">                                                
		</div>
	</div> -->

	<!--<div class="control-group">
		<label class="control-label" for="inputError" >Company Id </label>
		<div class="controls">
			<input type="text" id="inputError" class="span1"  name="accountid" value="<= $account ?>" readonly>                                                
		</div>
	</div> -->

	<div class="control-group">
		<label class="control-label" for="inputError" >Id </label>
		<div class="controls">
			<input type="text" id="inputError" class="span1"  name="recid" value="<?= $recid ?>" readonly>                                                
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

	<?php if($recid > 0): ?> 
								<!-- Extract the current selected orgid id -->
								<?php   $orid = $data['orgid'];?>
<!-- Dropdown fed by object - updating
// need to get current value and preselect option to that value	-->							
								<div class="control-group">
								<label class="control-label" for="selectError3">Organization</label>
								<div class="controls" >
								  <select name="orgid" id="selectError3">

								  <?php	foreach($orgdpdwn as $row) { ?>
									<!-- If $row->id = current selected id then mark selected-->
									<?php if($row->id == $orid): ?> 
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
								<label class="control-label" for="selectError3">Organization</label>
								<div class="controls"  >
								  <select name="orgid" id="selectError3">
								    <?php foreach($orgdpdwn as $row) { ?>
									   <option value="<?= $row->id ?>"><?= $row->title ?></option>
								    <?php } ?> 									
								  </select>
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
								  <select name="orgid" id="selectError3">
								    <?php foreach($lsdpdwn as $row) { ?>
									   <option value="<?= $row->id ?>"><?= $row->title ?></option>
								    <?php } ?> 									
								  </select>
								</div>
							  </div>
							<?php endif; ?>


	<div class="control-group">
		<label class="control-label" for="inputError" >AYMP POCs </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="poc" value="<?= $poc ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Email </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="email" value="<?= $email ?>">                                                
		</div>
	</div>

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

	<?php if($gender == ""): ?> 
	<div class="control-group">
	<label class="control-label" for="selectError3" >Gender* </label>
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
	<label class="control-label" for="selectError3" >Gender* </label>
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
	<label class="control-label" for="selectError3" >Gender* </label>
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
	<label class="control-label" for="selectError3" >Gender* </label>
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
		<label class="control-label" for="date01">Birthdate* </label>
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

	<div class="control-group">
		<label class="control-label" for="inputError" >Donor Level </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="level" value="<?= $level ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Shop Customer </label>
		<div class="controls">
			<input type="text" id="inputError" class="span6"  name="shopcustomer" value="<?= $shopcustomer?>">                                                
		</div>
	</div>

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

	<div class="control-group hidden-phone">
		<label class="control-label" for="notes">Notes </label>
		<div class="controls">
		<textarea class="cleditor" id="notes" rows="5"></textarea>
		</div>
	</div>

	<div class="control-group">
<!--		<label class="control-label" for="inputError" >Frmpg: </label> -->
		<div class="controls">
			<input type="hidden" id="frmpg" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
		</div>
	</div>		

	<div class="control-group">
		<label class="control-label" for="inputError" >Address Type Id</label>
		<div class="controls">
			<input type="text" id="typeid" class="span6"  name="typeId" value="<?= $typeId ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Ship Name </label>
		<div class="controls">
			<input type="text" id="shipname" class="span6"  name="shipName" value="<?= $shipName ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Ship Phone </label>
		<div class="controls">
			<input type="text" id="shipphone" class="span6"  name="shipPhone" value="<?= $shipPhone ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="address1" class="span6"  name="address1" value="<?= $address1 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Address </label>
		<div class="controls">
			<input type="text" id="address2" class="span6"  name="address2" value="<?= $address2 ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >City </label>
		<div class="controls">
			<input type="text" id="city" class="span6"  name="city" value="<?= $city ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >State </label>
		<div class="controls">
			<input type="text" id="state" class="span6"  name="state" value="<?= $state ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Zip </label>
		<div class="controls">
			<input type="text" id="zip" class="span6"  name="zip" value="<?= $zip ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Country </label>
		<div class="controls">
			<input type="text" id="country" class="span6"  name="country" value="<?= $country ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Full Address </label>
		<div class="controls">
			<input type="text" id="fulladdress" class="span6"  name="fullAddress" value="<?= $fullAddress ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >Comment </label>
		<div class="controls">
			<input type="text" id="comment" class="span6"  name="comment" value="<?= $comment ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >District </label>
		<div class="controls">
			<input type="text" id="district" class="span6"  name="#" value="<?= $district ?>">                                                
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="inputError" >County </label>
		<div class="controls">
			<input type="text" id="county" class="span6"  name="#" value="<?= $county ?>">                                                
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
										<a href="<?= BASE_URL ?>dashboards/index/ccmps/view/<?= $recid ?>"><button type="button" class="btn" >Cancel</button></a>
									<?php else: ?> <!-- if not coming from the view page you are coming from the Manage page -->
									<a href="<?= BASE_URL ?>dashboards/index/ccmps/manage"><button type="button" class="btn" >Cancel</button></a>
									<?php endif; ?>
								<?php else: ?>
								<!-- If no record id passed then creating a new record -->
								<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save New Contact</button>                                       
									<a href="<?= BASE_URL ?>dashboards/index/ccmps/manage"><button type="button" class="btn" >Cancel</button></a>

								<?php endif; ?>
							</div>						
					</form>   
				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->