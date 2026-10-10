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
    
?>

<p style="margin-top: 0px; margin-bottom: 15px;"> 

<!--    <a href="<?=$create_gsclasses_url?>"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New Course</button></a>  -->  
    <a href="<?= BASE_URL ?>dashboards/index/gsclasses/create//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New Class</button></a>
    <a href="<?= BASE_URL ?>dashboards"><button type="submit" class="btn btn-default" >Close</button></a>       
</p>

		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-content">
				<?= flashdata();
				$flash_msg = '';
				set_flashdata($flash_msg); ?>														                                              
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							      <th>ID</th> 
								  <th>Cert Code</th>                                                                 
								  <th>Name</th>
								  <th>Note</th>                                                                                                                                                                                                                                                             
                                  <th>View Edit Delete</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php
								foreach($rows as $row) { 

								?>
								<tr>
									<td><?= $row->id ?></td>
									<td><?= $row->certcode ?></td>
									<td><?= $row->title ?></td>
									<td><?= $row->note ?></td>
                                                                 
									<td>
						<!--			<a class="btn btn-success" href="<php echo base_url('Blogposts/activate/'.$row->id.'/bpmi')?>"><i class="halflings-icon white ok"></i></a> -->                                                                  

									<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/gsclasses/view/<?= $row->id ?>/m"><i class="halflings-icon white eye-open"></i></a>
                                                                 
                                    <a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/gsclasses/create/<?= $row->id ?>/m"><i class="halflings-icon white pencil"></i></a>  
								
									<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/gsclasses/del/<?= $row->id ?>/m" onClick="return confirm('This class will be permanently deleted. Confirm Deletion?');" ><i class="halflings-icon white trash"></i></a>
                        
									</td>

								</tr>
								<?php } ?>              
						  </tbody>
					  </table>            
				</div><!--/box content-->
			</div><!--/box span12-->
		</div><!--/fluid sortable-->
	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
