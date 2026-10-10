
	<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>
    
<div class="box span12" style="margin-bottom: 15px;">
		<div class="box-header" data-original-title>
        <h2><i class="fa fa-eye"></i><span class="break"></span><?= $contentheader ?></h2>
				<div class="box-icon"><a style='color: white'> * = required</a></div>
		</div>
</div>

<p style="margin-top: 0px; margin-bottom: 15px;"> 
<!-- style.css defaults    <a href="<?=$create_item_url?>"><button type="submit" class="btn btn-primary"style="background-color: #578EBE; border-color: #578EBE; color: #ffffff;" >Add Product</button></a> -->
                                                                      
<a href="<?= BASE_URL?>dashboards/gscourses/<? $role_id ?>/assign/<? $gscid ?>/gscv"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Assign Class</button></a>  

<a href="<?= BASE_URL ?>dashboards/gscourses/<?= $role_id ?>/gsccreate/<?= $recid ?>/gscv"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;">Update</button></a>

<a> </a><a class="btn btn-danger" href="<?= BASE_URL ?>dashboards/gscourses/<?= $role_id ?>/gscdel/<?= $recid ?>/gscv" onClick="return confirm('Confirm Deletion?');">Delete</a><a> </a><a class="btn btn-default" href="<?= BASE_URL ?>dashboards/gscourses/<?= $role_id ?>/gscmanage">Close</a>
</p>   
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2>Id: <?= $cmid ?><span class="break"></span>Post Title: <?= $posttitle ?></h2>
						<div class="box-icon">
                                                    <a style='color: white'></a>
						<!--	<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a> -->
						</div> 
					</div>
					<div class="box-content">
                               <!--             <?php echo $flash; ?> -->
                                            <?php if(isset($flash)){
                                                echo $flash;

                                            }
                                            ?>                                              
                                                <?php 
                                                // if the $update_id exists (editing a record) it will tack it on and update code will run
                                                // if adding a new record there will be no $update_id and create code will run
                                                    $form_location = base_url()."Blogcomments/create/".$update_id;
                                                ?>                                            
						<form class="form-horizontal" method = "post" action="<?= $form_location ?>">


						  <fieldset disabled>
						<!--	<div class="control-group">
                                                            <label class="control-label" for="inputError" >ID </label>
							  <div class="controls">
								<input type="text" id="inputError" class="span2"  name="id" value="<?= $id ?>">
                                                                
                                                          </div>
							</div> -->
                                                        <div class="control-group">
                                                              <label class="control-label" for="selectError3">Approved? </label>
                                                              <div class="controls">
                                                                  <?php
                                                                    $additional_dd_code = 'id="selectError3"';
                                                                    $options = array(
                                                                           ''          => 'Please select...', // optional - used when want to force to choose - no default
                                                                           '1'         => 'Yes',
                                                                           '0'         => 'No',
                                                                   );
                                                                   echo form_dropdown('cmtis_approved', $options, $cmtis_approved, $additional_dd_code);                                                                 
                                                                  ?>
                                                                  <span class="help-inline" style='color: red'><?php echo form_error('cmtis_approved'); ?></span>
                                                              </div>
                                                        </div>                                                        
							<div class="control-group">
                                                            <label class="control-label" for="inputError" >Commentator </label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="commentator" value="<?= $commentator ?>">                                
                                                          </div>
							</div>
							<div class="control-group">
                                                            <label class="control-label" for="inputError" >Email </label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="email" value="<?= $email ?>">                                                
                                                          </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Original Post </label>
							  <div class="controls">
								<textarea class="" id="textarea2" rows="5" name="postbody" style="width: 95%"><?= $postbody ?></textarea>
							  </div>
							</div>                                                     
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Comment </label>
							  <div class="controls">
								<textarea class="" id="textarea2" rows="5" name="comment" style="width: 95%"><?= $comment ?></textarea>
							  </div>
							</div>                                                      
                                                <?php if($role_id == 1) { ?>
							<div class="control-group">
							  <label class="control-label" for="inputError">Blog Post Number</label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="blog_post_id" value="<?= $blog_post_id ?>">
							  </div>
							</div>                                                      

                                                        <div class="control-group">
							  <label class="control-label" for="inputError">Commentator Id</label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="created_by" value="<?= $created_by ?>">
							  </div>
							</div>   
                                                        <div class="control-group">
							  <label class="control-label" for="inputError">Updater Id</label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="updated_by" value="<?= $updated_by ?>">
							  </div>
							</div>
                                                <?php  } ?>                
                                                        <div class="control-group">
							  <label class="control-label" for="inputError">Created</label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="created_at" value="<?= $created_at ?>">
							  </div>
							</div>                                                       
                                                        <div class="control-group">
							  <label class="control-label" for="inputError">Updated</label>
							  <div class="controls">
								<input type="text" id="inputError" class="span6"  name="updated_at" value="<?= $updated_at ?>">
							  </div>
							</div>                                                       
                                            <!--          <div><hr style="border: 1px solid #d3d3d3"></div> -->                                                      


                                                                                                     

						  </fieldset>
						</form>   						  
					</div>
					<div class="box-header" data-original-title>
						<h2>Total: <?= $query2->num_rows() ?><span class="break"></span>Responses</h2>
						<div class="box-icon">
                                                    <a style='color: white'></a>
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
                                            <?php $create_bresponse_url = base_url()."Blogresponses/create";?>
                                            <p style="margin-top: 0px; margin-bottom: 15px;"> 
                                                <a href="<?php echo base_url('Blogresponses/approve/viewpg')?>"><button type="submit" class="btn btn-primary"style="background-color: #43B5AD; border-color: #43B5AD; color: #ffffff;" >Approve All Responses</button></a>
                                            </p>                                     
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th><h3>Id</h3></th>                                                                                                                                                                                         
								  <th><h3>Responder</h3></th>
								  <th><h3>Email</h3></th>                                                                  
								  <th><h3>Response</h3></th>                                                                  
								  <th><h3>Status</h3></th>                                                                  
                                                                  <th><h6>Approve View Edit Reply Delete</h6></th>
							  </tr>
						  </thead>   
						  <tbody>
                                                        <?php
                                                        foreach($query2->result() as $row2) //$query2 is an array // convert object to array: $array =  (array) $yourObjectArr;
                                                      //   echo $query2['commentator']; die();
                                                        { ?>
							<tr>
                                                                <td><?= $row2->rpid ?></td>                                                                   
								<td><?= $row2->responder ?></td>
								<td><?= $row2->email ?></td>                                                                   
								<td><?= $row2->response ?></td>                                                    
								<td class="center">                                               
                                                                    <?php
                                                                    if($row2->rspis_approved == 1)
                                                                    { ?>                                               
                                                                                    <span class="label label-success">Approved</span>							
                                                                    <?php }else{ ?>

                                                                                    <span class="label label-important">Pending</span>                                                                                                                              
                                                                    <?php } ?>                                                                                  
								</td>                                                                          
								<td class="center">
                                            <?php
                                            if($row2->rspis_approved == 1)
                                            { ?>                                                                     
                                                <a class="btn btn-default" href="#">                                                                         
                                                        <i class="halflings-icon white ok"></i>  
                                                </a>
                                            <?php }else{ ?>
                                            
    <?php if($frmpg == 'bpmi') { ?>
        <a class="btn btn-success" href="<?php echo base_url('Blogresponses/approve/'.$row2->rpid.'/bpmi')?>"><i class="halflings-icon white ok"></i></a>                                            
                                                                                      
    <?php }else{ ?>
        <a class="btn btn-success" href="<?php echo base_url('Blogresponses/approve/'.$row2->rpid.'/bpm')?>"><i class="halflings-icon white ok"></i></a>
    <?php } ?>                                             
                                             
                                                                                                                  
                                            <?php } ?>
                                                
    <?php if($frmpg == 'bpmi') { ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/view/'.$row2->rpid.'/bpmi') ?>"><i class="halflings-icon white zoom-in"></i></a>                                            
                                                                                      
    <?php }else{ ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/view/'.$row2->rpid.'/bpm') ?>"><i class="halflings-icon white zoom-in"></i></a>  
    <?php } ?>                                            
                                            
    <?php if($frmpg == 'bpmi') { ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/create/'.$row2->rpid.'/bpmi')?>"><i class="halflings-icon white pencil"></i></a>                                              
                                                                                      
    <?php }else{ ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/create/'.$row2->rpid.'/bpm')?>"><i class="halflings-icon white pencil"></i></a>    
    <?php } ?>                                            
                                            
    <?php if($frmpg == 'bpmi') { ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/create/x'.$row2->rpid.'/bpmi')?>"><i class="fa fa-reply"></i></a>                                              
                                                                                      
    <?php }else{ ?>
        <a class="btn btn-info" href="<?php echo base_url('Blogresponses/create/x/'.$row2->rpid.'/bpm')?>"><i class="fa fa-reply"></i></a>    
    <?php } ?>                                             
    <?php if($frmpg == 'bpmi') { ?>
        <a class="btn btn-danger" href="<?php echo base_url('Blogresponses/delete/'.$row2->rpid.'/bpmi')?>" onClick="return confirm('Confirm Deletion?');"><i class="halflings-icon white trash"></i></a>                                              
                                                                                      
    <?php }else{ ?>
        <a class="btn btn-danger" href="<?php echo base_url('Blogresponses/delete/'.$row2->rpid.'/bpm')?>" onClick="return confirm('Confirm Deletion?');"><i class="halflings-icon white trash"></i></a>    
    <?php } ?>                                                                             
								</td>
							</tr>
                                                        <?php } ?>
                                                      
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->

			</div><!--/row-->
                        

