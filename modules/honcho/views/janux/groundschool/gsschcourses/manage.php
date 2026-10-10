<!-- <ul class="breadcrumb">
	<li>
		<a href="#"><= $breadcrumb1 ?> </a> <a href="#"><= $breadcrumb2 ?></a> 
	</li>
</ul> -->

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

			</div>
	<!--	</div> -->

<?php
// extract the role_id
 //   $create_gscourse_url = "<= BASE_URL >dashboards/gsschcourses/1/gsccreate";       
?>

<p style="margin-top: 0px; margin-bottom: 15px;"> 

    <a href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gsccreate//gscm"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Schedule New Course</button></a>
    <a href="<?= BASE_URL ?>dashboards/index/<?= $role_id ?>"><button type="submit" class="btn btn-default" >Close</button></a>
	<?= flashdata();
$flash_msg = '';
set_flashdata($flash_msg); ?>       
</p>

		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-content">
														                                              
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ID</th>
								  <th>Course Number</th>                                                                 
								  <th>Name</th>
								  <th>Start Date</th>
								  <th>Status</th>                                                                                                                                                                                                                                                                    
                                  <th>View Edit Delete</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php
								foreach($rows as $row) { 

									$status = $row->active;

									if ($status == 1) {
										$status_label = "success";
										$status_desc = "Active";
									}else{
										$status_label = "default";
										$status_desc = "Inactive";
									}

								?>
								<tr>
									<td><?= $row->id ?></td>
									<td><?= $row->course_number ?></td>
									<td><?= $row->title ?></td>
									<td><?= $row->start_date ?></td>
									<td class="center">
										<span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
									</td>

									<!--  *******************  -->                                                                     
									<td>
						<!--			<a class="btn btn-success" href="<php echo base_url('Blogposts/activate/'.$row->id.'/bpmi')?>"><i class="halflings-icon white ok"></i></a> -->                                                                  

									<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscview/<?= $row->id ?>/gscm"><i class="halflings-icon white eye-open"></i></a>
                                                                 
                                    <a class="btn btn-info" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gsccreate/<?= $row->id ?>/gscm"><i class="halflings-icon white pencil"></i></a>  
								
									<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/gsschcourses/<?= $role_id ?>/gscdel/<?= $row->id ?>/gscm" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');" ><i class="halflings-icon white trash"></i></a>
                        
									</td>
								<!--  *******************  -->
						<!--			<td><a class="button button-outline" href="<= $update_url ?>">Update</a></td> -->
								</tr>
								<?php } ?>              
						  </tbody>
					  </table>            
				</div><!--/box content-->
			</div><!--/box span12-->
		</div><!--/fluid sortable-->


	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
