
<!-- <h1><? echo $headline; ?></h1> -->
				<div class="box span12" style="margin-bottom: 15px;">
					<div class="box-header" data-original-title>
						<h2><i class="fa fa-gears"></i><span class="break"></span>Manage Blog Comments</h2>

					</div>
                                </div>

<?php
    $create_bcomment_url = base_url()."Blogcomments/create";
    $approve_all_bcmts_url = base_url()."Blogcomments/approve_all_comments_from_db";     
?>
<p style="margin-top: 0px; margin-bottom: 15px;">
<!--        <a href="<?=$create_bcomment_url?>"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Create New Comment</button></a> -->
        <a href="<?=$approve_all_bcmts_url?>"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Approve All Comments for All Posts</button></a> </p>     
        

		<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
                                            <?php if($onlyinactive == 1){ ?>
                                               <h2><?= $totalcomments ?> <i class="icon-comments-alt"></i><span class="break"></span>All Pending Comments for All Posts</h2>
                                            <?php }else{ ?>
                                                <h2><?= $totalcomments ?> <i class="icon-comments-alt"></i><span class="break"></span>All Comments for All Posts</h2>
                                            <?php } ?>
                                                
						<div class="box-icon">
                                                <!--    <a style='color: white'> * = required</a> -->
						<!--	<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a> -->
						</div>
					</div>
					<div class="box-content">
                                                <?php if(isset($flash)){
                                                    echo $flash;
                                                }
                                                ?>                                            
                                                                                
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                                            <?php if ($role_id == 1): ?>                                                              
								  <th><h3>Id</h3></th>
								  <th><h3>Post Id</h3></th>
                                                            <?php endif; ?>  
								  <th><h3>Post Title</h3></th>                                                                                                                            
								  <th><h3>Commentator</h3></th>
								  <th><h3>Comment</h3></th>                                                                  
								  <th><h3>Status</h3></th>                                                                  
                                                                  <th><h6>View Approve Edit Reply Delete</h6></th>
							  </tr>
						  </thead>   
						  <tbody>
                                                        <?php
                                                        foreach($query->result() as $row) 
                                            //            foreach($query->result_array() as $row)                                                            
                                                            // could assign edit link to a variable and substitute below. Either works>
                                                            // $edit_shop_product = base_url()."blogposts/create/".$row->id
                                                        { ?>
							<tr>
                                                            <?php if ($role_id == 1): ?>  
                                                                <td><?= $row->cmid ?></td>                                                                   
                                                                <td><?= $row->blog_post_id ?></td>
                                                            <?php endif; ?>                                                                  
								<td><?= $row->posttitle ?></td> 
								<td><?= $row->commentator ?></td>                                                                
								<td><?= $row->comment ?></td>                                                    
								<td class="center">                                               
                                                                    <?php
                                                                    if($row->cmtis_approved == 1)
                                                                    { ?>                                               
                                                                                    <span class="label label-success">Approved</span>							
                                                                    <?php }else{ ?>

                                                                                    <span class="label label-important">Pending</span>                                                                                                                              
                                                                    <?php } ?>                                                                                  
								</td>                                                                          
								<td class="center">
									<a class="btn btn-info" href="<?php echo base_url('Blogcomments/view/'.$row->cmid)?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
                                                                        <?php if($row->cmtis_approved == 1){ ?>
                                                                            <a class="btn btn-default" href="<?php echo base_url('Blogcomments/approve/'.$row->cmid.'/cm')?>">                                                                         
										<i class="halflings-icon white ok"></i>  
                                                                            </a>
                                                                        <?php }else{ ?>
                                                                            <a class="btn btn-success" href="<?php echo base_url('Blogcomments/approve/'.$row->cmid.'/cm')?>">                                                                         
										<i class="halflings-icon white ok"></i>  
                                                                            </a>
                                                                        <?php } ?>                                                                    
									
									<a class="btn btn-info" href="<?php echo base_url('Blogcomments/create/'.$row->cmid)?>">                                                                         
										<i class="halflings-icon white pencil"></i>  
									</a>

                                                                        <?php if($onlyinactive == 1){ ?>
                                                                            <a class="btn btn-info" href="<?php echo base_url('Blogresponses/reply/'.$row->blog_post_id.'/mci')?>">                                                                         
                                                                                    <i class="fa fa-reply"></i>  
                                                                            </a>  
                                                                        <?php }else{ ?>
                                                                            <a class="btn btn-info" href="<?php echo base_url('Blogresponses/reply/'.$row->blog_post_id.'/mc')?>">                                                                         
                                                                                    <i class="fa fa-reply"></i>  
                                                                            </a>  
                                                                        <?php } ?>   
                                                                    
                                                                  
									<a class="btn btn-danger" href="<?php echo base_url('Blogcomments/delete/'.$row->cmid)?>" onClick="return confirm('This Comment and all associated Responses will be permanently deleted. Confirm Deletion?');" >
    
										<i class="halflings-icon white trash"></i>  
									</a>                                                                    
								</td>
							</tr>
                                                        <?php } ?>
                                                      
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

	