<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. gsclasses
3) Replace all Ccsingular with camelcase singular name ex. Class
4) Replace the table headers <th></th> to match database table
5) Replace the table definitions <td></td> to match database table
-->
<div class="container-fluid-full">
	<div class="row-fluid">
		
		<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>


	<!--	<div class="box span12" style="margin-bottom: 15px;"> -->
			<div class="box-header" style="margin-bottom: 15px;" data-original-title>
				<h2><i class="fa fa-gears"></i><span class="break"></span><?= $contentheader ?></h2>
<!-- <ul class="breadcrumb">
	<li>
		<a href="#"><?= $breadcrumb1 ?> </a> <a href="#"><?= $breadcrumb2 ?></a> 
	</li>
</ul> 	-->			
			</div>
	<!--	</div> -->

<?php
// extract the role_id if needed to control which field are visible by role
//      
?>

<p style="margin-top: 0px; margin-bottom: 15px;"> 
<?php if($filter_type !== 's') { ?>	
	<?php if($filter_type == 'df') { ?>
		<a href="<?= BASE_URL ?>dashboards/index/contacts/manage"><button type="submit" class="btn btn-default" >Close</button></a> 
	<?php }else{ ?>	
		<?php if($role_id !== 17) { ?>
			<a href="<?= BASE_URL ?>dashboards/index/contacts/create//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New Contact</button></a>
		<!--	<a href="<?= BASE_URL ?>dashboards/index/contacts/makexls//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Export .xls</button></a> -->
		<?php } ?>
			<a href="<?= BASE_URL ?>dashboards/index/contacts/manage//m/s"><button type="submit" class="btn btn-primary" >Search/Sort</button></a>  
			<?php if($role_id == 1) { ?>
				<a href="<?= BASE_URL ?>dashboards/index/contacts/manage//m/df"><button type="submit" class="btn btn-primary" >View Deleted Contacts</button></a>   <!--  DF deleted filter -->
			<?php } ?>
			<a href="<?= BASE_URL ?>dashboards"><button type="submit" class="btn btn-default" >Close</button></a>
	<?php } ?>
<?php }else{ ?>	
<!-- Searching  -->
<a href="<?= BASE_URL ?>dashboards/index/contacts/manage"><button type="submit" class="btn btn-default" >Close</button></a>
<?php } ?>
</p>

		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-content">
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
					<div class="adv-table table-responsive">
					<?php if($filter_type == 's') { ?>																			                                              
						<table class="display table table-striped table-bordered bootstrap-datatable datatable">
						<p><span> Click on any table header to sort ascending & decending</span></p>
						<?php }else{ ?>	 
						<table  class="display table table-bordered table-striped" id="dynamic-table"> 
					<?php } ?> 

						  <thead>
							  <tr>
						<!--	    <th>ID</th> -->
								<th>Type</th> 								  
								<th>Prefix</th> 
								<th>First</th>                                                                 
								<th>Last</th>
								<th>Suffix</th>
								<th>Title</th>
								<th>Company</th>
								<th>Phone</th>																
								<th>Email</th>		
								<th>Donor</th>
								<th>Sponsor</th>
								<th>POC</th>
								<?php if($filter_type == 'df') { ?>	
									<th>View Restore Remove Status</th>
								<?php }else{ ?>	
									<?php if($role_id == 1) { ?>
										<th>View Edit/Restore Del/Remove</th>
									<?php }else{ ?>
										<?php if($role_id !== 17) { ?>								                								                                                                                                                                                                                                                                                         
										<th>View Edit Delete</th>
									<?php }else{ ?>
										<th>View</th>
									<?php } ?> 
									<?php } ?> 

								<?php } ?> 
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php
								foreach($rows as $row) { 
								?>
								<tr>
									<!--  ******** CHANGE ***********  -->  

								<!--	<td><= $row->id ?></td> -->
									<td><?= $row->contacttype ?></td> 
									<td><?= $row->salutation ?></td> 
									<td><?= $row->firstname ?></td>
									<td><?= $row->lastname ?></td>
									<td><?= $row->suffix ?></td>  
									<td><?= $row->title ?></td>
									<td><?= $row->contacttype ?></td> 
									<td><?= $row->phone ?></td>									
									<td><?= $row->email ?></td>
									<td><?= $row->donor ?></td>
									<td><?= $row->sponsor ?></td>
									<td><?= $row->poc ?></td>									                                              
									<td> 
										
									<?php if($row->status == 9) { ?>
										
										<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/view/<?= $row->id ?>/m"><i class="halflings-icon white eye-open"></i></a>
										<a class="btn btn-success" href="<?= BASE_URL ?>dashboards/index/contacts/undel/<?= $row->id ?>/m"><i class="halflings-icon white plus"></i></a>
										<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/contacts/permdel/<?= $row->id ?>/m" onClick="return confirm('This contact and all associated child records will be permanently deleted. Are you sure?');" ><i class="halflings-icon white remove"></i></a>
										<span class="badge bg-important red">Deleted</span>
									<?php }else{ ?>	 
											<?php if($filter_type == 'df') { ?>	
												<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/view/<?= $row->id ?>/m/df"><i class="halflings-icon white eye-open"></i></a>
												<a class="btn btn-success" href="<?= BASE_URL ?>dashboards/index/contacts/undel/<?= $row->id ?>/m/df"><i class="halflings-icon white plus"></i></a>
												<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/contacts/permdel/<?= $row->id ?>/m" onClick="return confirm('This contact and all associated child records will be permanently deleted. Are you sure?');" ><i class="halflings-icon white trash"></i></a>
											<?php }else{ ?>	 
												<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/view/<?= $row->id ?>/m"><i class="halflings-icon white eye-open"></i></a>
												<?php if($role_id !== 17) { ?>	                             
													<a class="btn btn-success" href="<?= BASE_URL ?>dashboards/index/contacts/create/<?= $row->id ?>/m"><i class="halflings-icon white pencil"></i></a>
												<!--	<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/makepdf/<?= $row->id ?>/m"><i class="halflings-icon white file"></i></a> -->
													<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/contacts/del/<?= $row->id ?>/m" onClick="return confirm('This contact will be permanently deleted. Are you sure?');" ><i class="halflings-icon white trash"></i></a>
												<?php } ?>
											<?php } ?>
									<?php } ?> 
									
									</td>
									<!--  ******** END CHANGE ***********  -->  									
								</tr>
								<?php } ?>              
						  </tbody>
					  </table> 
					  </div>	           
				</div><!--/box content-->
			</div><!--/box span12-->
		</div><!--/fluid sortable-->
	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
