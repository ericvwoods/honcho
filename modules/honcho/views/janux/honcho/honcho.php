<!-- dashboards/views/janux/honcho/honcho.php
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
			<h2><i class="fa fa-pencil-square-o"></i><span class="break"></span>Login</h2> <!-- blue form header -->
				<div class="box-icon"><a style='color: white'> </a></div> 
		</div>
		<!-- End page header no buttons for create-->

				<div class="box-content">
<!-- <php echo($frmpg); die(); ?> -->
			<!--	<a href="#"><= $breadcrumb1 ?></a><a href="#"><= $breadcrumb2 ?></a> -->

				<div><hr style="border: 1px solid #d3d3d3"></div>        
				
					<!-- if the $recid exists (editing a record) it will tack it on and update code will run
					if adding a new record there will be no $update_id and create code will run -->
										
					<form class="form-horizontal" method = "post" action="<?= BASE_URL ?>dashboards/validate">
        
                    <!--    <div class="box-content alerts">
                            <div class="alert alert-<= $alerttype ?>">
                            <strong><h2><= validation_errors() ?></h2></strong>
                            <button type="button" class="close" data-dismiss="alert"></button>
                            
                            </div>
                        </div>	-->	

                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="inputError" >Username </label>
                                <div class="controls">
                                    <input type="text" id="inputError" class="span6"  name="username" value="<?= $username ?>">                                                
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="inputError" >Password </label>
                                <div class="controls">
                                    <input type="password" id="inputError" class="span6"  name="password" value="<?= $password ?>">                                                
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <input type="hidden" id="inputError" class="span2"  name="frmpg" value="<?= $frmpg ?>">                                                
                                </div>
                            </div>		

                        </fieldset>

                        <div><hr style="border: 1px solid #d3d3d3"></div>                                                      

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Login</button>                                    
                            <a href="<?= BASE_URL ?>dashboards/honcho"> <button type="button" class="btn" >Cancel</button></a>
                            <a href="<?= BASE_URL ?>welcome"> <button type="button" class="btn btn-success" >Website</button></a>
                        </div>						
                    </form>   
		</div><!--/box-content--> 
	</div><!--/box span12-->
</div><!--/row-fluid-->