<!-- <ul class="breadcrumb">
	<li>
		<a href="#"><= $breadcrumb1 ?> </a> <a href="#"><= $breadcrumb2 ?></a> 
	</li>
</ul> -->

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

			</div>
	<!--	</div> -->

<?php
// extract the role_id if needed to control which field are visible by role
//      
?>

<p style="margin-top: 0px; margin-bottom: 15px;"> 

    <a href="<?= BASE_URL ?>dashboards/index/gstopics/gsccreate//m"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New Topic</button></a>
    <a href="<?= BASE_URL ?>dashboards"><button type="submit" class="btn btn-default" >Close</button></a>
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
								<th>Name</th>                                                                 
								<th>Description</th>                                                                                                                                                                                                                                                         
                                <th>View Edit Delete</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php
								foreach($rows as $row) { 
								?>
								<tr>
									<td><?= $row->id ?></td>
									<td><?= $row->title ?></td>
									<td><?= $row->description ?></td>  
									<!--  ******** CHANGE ***********  -->                                                                     
									<td>                                                                

									<a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/gstopics/view/<?= $row->id ?>/m"><i class="halflings-icon white eye-open"></i></a>
                                                                 
                                    <a class="btn btn-info" href="<?= BASE_URL ?>dashboards/index/gstopics/create/<?= $row->id ?>/m"><i class="halflings-icon white pencil"></i></a>  
								
									<a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/index/gstopics/del/<?= $row->id ?>/m" onClick="return confirm('This lcsingular will be permanently deleted. Confirm Deletion?');" ><i class="halflings-icon white trash"></i></a>
                          
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
