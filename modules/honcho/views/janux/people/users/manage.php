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

<?php if($role_id !== 17) { ?>
    <a href="<?= BASE_URL ?>dashboards/index/users/create//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New User</button></a>
<!--	<a href="<= BASE_URL ?>dashboards/index/contacts/makexls//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Export</button></a> -->
<?php } ?>
    <a href="<?= BASE_URL ?>dashboards"><button type="submit" class="btn btn-default" >Close</button></a>   
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
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							    <th>Id</th> 								  
								<th>Inactive</th> 
								<th>First</th>                                                                 
								<th>Last</th>
								<th>Username</th>
								<th>Email</th>
								<th>Role</th>
								<th>TG Id</th>
								<th>Last Login</th>
								<?php if($role_id !== 17) { ?>								                								                                                                                                                                                                                                                                                         
                                	<th>View Edit Delete</th>
								<?php }else{ ?>
                                	<th>View</th>
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
									<td><?= $row->id ?></td>
									<td><?= $row->inactive ?></td>  
									<td><?= $row->first_name ?></td>
									<td><?= $row->last_name ?></td>
									<td><?= $row->username ?></td>  
									<td><?= $row->email_address ?></td>
									<td><?= $row->role_id ?></td>
									<td><?= $row->trongate_user_id ?></td>
									<td><?= $row->last_login ?></td>								                                              
									<td>                                                                

									<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/view/<?= $row->id ?>/m"><i class="halflings-icon white eye-open"></i></a>
                                    <?php if($role_id !== 17) { ?>	                             
                                   		<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/contacts/create/<?= $row->id ?>/m"><i class="halflings-icon white pencil"></i></a>
									<!--	<a class="btn btn-info" href="<= BASE_URL ?>dashboards/index/contacts/makepdf/<= $row->id ?>/m"><i class="halflings-icon white file"></i></a> -->
										<?php if($row->status == 9) { ?>
											<span class="badge bg-important green">Undelete</span>
											<?php }else{ ?>	  
											<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/contacts/del/<?= $row->id ?>/m" onClick="return confirm('This user will be permanently deleted. Confirm Deletion?');" ><i class="halflings-icon white trash"></i></a>
										<?php } ?>
									<?php } ?>
									
									</td>
									<!--  ******** END CHANGE ***********  -->  									
								</tr>
								<?php } ?>              
						  </tbody>
					  </table>            
				</div><!--/box content-->
			</div><!--/box span12-->
		</div><!--/fluid sortable-->
	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
