<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. gsclasses
3) Replace the fieldset form controls to match database table
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
			<h2><i class="fa fa-eye"></i><span class="break"></span><?= $contentheader ?></h2>
			<!--	<div class="box-icon"><a style='color: white'> * = required</a></div> -->
		</div>
		<!-- End page header no buttons for create-->
 
				<div class="box-content">
			
<!-- <php echo($frmpg); die(); ?> -->
			<!--	<a href="#"><?= $breadcrumb1 ?></a><a href="#"><?= $breadcrumb2 ?></a> -->
<?php if($role_id !== 17) { ?>				
			<a href="<?= BASE_URL ?>dashboards/index/ccmps/create/<?= $recid ?>/v"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Update</button></a>
			<a href="<?= BASE_URL ?>dashboards/index/ccmps/makepdf/<?= $row->id ?>/v"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Export</button></a>
			<a> </a><a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/ccmps/del/<?= $recid ?>/v" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');">Delete</a><a> </a>
<?php } ?> 
			<a class="btn btn-default" href="<?= BASE_URL ?>dashboards/index/ccmps/manage">Close</a>

				<div><hr style="border: 1px solid #d3d3d3"></div>        
			<!--	<= validation_errors() ?> -->
				
					<!-- if the $update_id exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
										
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/ccmps/<?= $role_id ?>/submit">
					<?php if(isset($alerttype)) { ?>	
					<div class="box-content alerts">
						<div class="alert alert-<?= $alerttype ?>">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h2><?= flashdata();
							$flash_msg = '';
							set_flashdata($flash_msg); ?></h2></strong>	
						</div>
					</div>	
					<?php } ?>	

						<!--  ******** CHANGE ***********  --> 
						<?php
						// This code works but moved to controller line 143
							// display the code name instead of it's id
						//	$tp = $this->model->get_where($topic,'gstopics');
							// replace the topic code with the name
						//	$topic = $tp->title;
						//	$lvl = $this->model->get_where($level,'gslevels');
							// replace the level code with the name
						//	$level = $lvl->title;									
						?>
<!--  start header and 1st accordian -->
<!-- <h2 class="title-underblock custom mb30"><SMALL><?= CCMP ?> Information</SMALL></h2> -->
<br>
<!-- <label class="control-label" for="inputError" > </label> -->

                            <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-bordered">
                                    <div class="panel-heading" role="tab" id="headingOne4">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                                <h2>General Information </h2>
                                                <span class="panel-icon"></span>
                                            </a>
                                        </h4>
                                    </div><!-- End .panel-heading -->
                                    <div id="collapseOne4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne4">
                                        <div class="panel-body">

<!--  end of 1st accordian -->

<!--<p>Id:  <?= $recid ?> </p> -->

<!-- <p>Name: <?= $salutation ?> <?= $firstname ?> <?= $middlename ?> <?= $lastname ?> <?= $suffix ?></p> -->

<div class="row-fluid">		
	<div class="box span12">
		<div class="box-content">
			<table class="table">
				<thead>
				<tr>
						<th></th>
					<!--	<th> </th> -->					
					</tr>
										
				<tr>
						<th>Name </th>
						<th><?= $salutation ?> <?= $firstname ?> <?= $middlename ?> <?= $lastname ?> <?= $suffix ?></th>
					</tr>					
					<tr>
						<th>Title </th>
						<th><?= $title ?></th>
					</tr>
					<tr>
						<th>Organization </th>
						<th><?= $orgid ?></th>
					</tr>							
					<tr>
						<th>Department </th>
						<th><?= $department ?></th>					
					</tr>
					<tr>
						<th>Lead Source</th>
						<th><?= $leadsource ?></th>					
					</tr>
					<tr>
						<th>AYMP POC</th>
						<th><?= $poc ?></th>					
					</tr>
					<tr>
						<th>Gender </th>
						<th><?= $gender ?></th>					
					</tr>	
					<tr>
					<th>Mailing List</th>
					<th><?= $emailoptout ?></th>										
					</tr>		

					<tr>
						<th>Shop Customer</th>
						<th><?= $shopcustomer ?></th>										
					</tr>	
					<tr>
						<th>Donor</th>
						<th><?= $donor ?></th>						
					</tr>		
					<tr>
						<th>Donor Level</th>
						<th><?= $level?></th>					
					</tr>
					<tr>						
						<th>VIP</th>
						<th><?= $vip ?></th>	
					</tr>												
				</thead>
			</table>   
		</div><!--/box-->	
	</div><!--/span-->

		
</div><!--/row-->



<fieldset>

	<div class="control-group">
		<div class="controls">
			<input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
		</div>
	</div>		

</fieldset>

<!--  end content for 1st accordian -->

			</div><!-- End .panel-body -->
		</div><!-- End .panel-collapse -->
	</div><!-- End .panel -->
	<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingTwo4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
				<h2><?= CCMP ?> Information</h2>
				<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
		<div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo4">
			<div class="panel-body">

			<div class="row-fluid">				
			<div class="box span12">
		<div class="box-content">
			<table class="table">
			<?php if ($vip == 1):  ?>

				<?php if ($role_id == 1| $role_id == 17):  ?>
					<thead>
					<tr>
						<th> </th>
						<th> </th>					
					</tr>
					<tr>	
						<th>Do Not Call List</th>
						<th><?= $donotcall ?></th>
					</tr>									
					<tr>									
						<th>Office Phone </th>
						<th><?= $phone ?></th>
					</tr>	
					<tr>
						<th>Other Phone </th>
						<th><?= $phoneother ?></th>					
					</tr>
					<tr>
						<th>Cell Phone</th>
						<th><?= $mobile?></th>					
					</tr>
					<tr>
						<th>Fax</th>
						<th><?= $fax ?></th>					
					</tr>
					<tr>
						<th>Email Address </th>
						<th><?= $email ?> </th>
					</tr>
					<tr>
						<th>Assistant's Name </th>
						<th><?= $assistant ?></th>					
					</tr>	
					<tr>
						<th>Assistant's Phone </th>
						<th><?= $assistantphone ?> </th>					
					</tr>	
					<tr>
						<th>Assistant's Email </th>
						<th><?= $assistantemail ?> </th>					
					</tr>	

					<tr>
						<th>Birthday </th>
						<th><?= $birthdate ?></th>
					</tr>						

				</thead>					

				<?php else: ?> <!-- Not the right role with permissions to view VIP <?= CCMP ?> data  -->

				<thead>
					<tr>
						<th>*** Sorry your role permissions do not allow access to VIP <?= CCMP ?> data ***</th>					
					</tr>
				
				</thead>

				<?php endif; ?> 

				<?php else: ?> <!-- Not VIP show regardless of role-->
					<thead>
					<tr>
						<th> </th>
						<th> </th>					
					</tr>
					<tr>	
						<th>Do Not Call List</th>
						<th><?= $donotcall ?></th>
					</tr>						
					<tr>									
						<th>Office Phone </th>
						<th><?= $phone ?></th>
					</tr>	
					<tr>
						<th>Other Phone </th>
						<th><?= $phoneother ?></th>					
					</tr>
					<tr>
						<th>Cell Phone</th>
						<th><?= $mobile?></th>					
					</tr>
					<tr>
						<th>Fax</th>
						<th><?= $fax ?></th>					
					</tr>
					<tr>
						<th>Email Address </th>
						<th><?= $email ?> </th>
					</tr>
					<tr>
						<th>Assistant's Name </th>
						<th><?= $assistant ?></th>					
					</tr>	
					<tr>
						<th>Assistant's Phone </th>
						<th><?= $assistantphone ?> </th>					
					</tr>	
					<tr>
						<th>Assistant's Email </th>
						<th><?= $assistantemail ?> </th>					
					</tr>	

					<tr>
						<th>Birthday </th>
						<th><?= $birthdate ?></th>
					</tr>						
				</thead>
			<?php endif; ?>   	
			</table>   
		</div><!--/box-->	
		</div><!--/span-->				
</div><!--/row-->

			</div><!-- End .panel-body -->
		</div><!-- End .panel-collapse -->
	</div><!-- End .panel -->
	<div class="panel panel-bordered">
		<div class="panel-heading" role="tab" id="headingThree4">
			<h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
					<h2>Notes</h2>
					<span class="panel-icon"></span>
				</a>
			</h4>
		</div><!-- End .panel-heading -->
	<div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree4">
		<div class="panel-body">
		<div class="row-fluid sortable">				
			<div class="box span12">
		<div class="box-content">
			<table class="table">
				<thead>
				<tr>
						<th> </th>
						<th> </th>					
					</tr>									

					<tr>
					<!--	<th>Notes</th> -->
						<th><?= $notes ?></th>					
					</tr>

				</thead>
			</table>   
		</div><!--/box-->	
		</div><!--/span-->				
</div><!--/row-->
		</div><!-- End .panel-body -->
		</div><!-- End .panel-collapse -->
	</div><!-- End .panel -->
</div><!-- End .panel-group -->
<!--  end accordian -->
						<!--  ******** END CHANGE ***********  --> 

					          <div><hr style="border: 1px solid #d3d3d3"></div>                                                      
				
					</form>   
				</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->