<?php 
  include('navbar.php');
?>    

<!-- Begin Content   -->

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">   
                <div class="row"> 
                        <div class="col-md-1">  
                         <br>
                            <div class="row">
                                <div class="col-md-6"> <!-- for spacing --> 
                                </div>
                             
                               <a href="#" title="">
<img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">                                     
                               </a>
                            </div>
                      
                        </div> <!-- end col -->
                   
                        <div class="col-md-7">
                            <p> </p>
                        <span class="m-r">
                           <?php if($managemode == 'dmslibadmin'): ?> 
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span> 
                                <a style="color:<?= SN2_CLR ?>;" href="#"><h2><?= $activity ?></h2></a>
                            <?php else: ?>
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span>                       
                            <?php endif; ?>                            
                        </span>
                        </div> <!-- end column -->
                          <div class="col-md-3">
                              <br>
                               <br>
                               <?php if($managemode == 'dmslibadmin'): ?>           
                    <ul class="nav navbar-top-links navbar-right">

                      
<a class="btn btn-primary btn-rounded btn-outline" href="<?= BASE_URL ?>cms-ccmpslibrary/kanban/m"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 24px;"><i class="fa fa-list-alt"></i> Kanban Board</span></a>
                      
                    </ul> <!-- End Navbar right  -->
                       <?php endif; ?> 
                      </div> <!-- end column -->
              
                      <div class="col-md-1">
                           <br>
                              
<a class="btn btn-primary btn-rounded btn-outline" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 24px;"><i class="fa fa-dashboard"></i></span></a>                                                
                      
                      </div> <!-- end column -->
                </div> <!-- end row -->

            </div> <!-- end ibox-title- ln 17 -->
 <br>
            <div class="ibox-content">  



                        <!-- <br> try to show break only if there is a flash msg -->


                        <!-- Show flash message then reset it to blank -->
                     <!--   <= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); -->
                     <!--   $flash_msg = '';-->
                     <!--   set_flashdata($flash_msg); ?> -->
    <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
      $flash_msg = '';
      set_flashdata($flash_msg); ?> 
    <?php else: ?>
      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
      $flash_msg = '';
      set_flashdata($flash_msg); ?> 
    <?php endif; ?>
    <br>  
                     
    <?php if($managemode== 'dmslibccmp'): ?>
        <form action="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibccmp" method = "post">
    <?php endif; ?>
            
    <?php if($managemode== 'subentitylist'): ?>  
        <form action="<?= BASE_URL ?>cms-ccmpslibrary/manage/momads" method = "post">
    <?php endif; ?>
            
     <?php if($managemode== 'dmslibadmin'): ?>         
        <form action="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin" method = "post">
    <?php endif; ?>


            <div class="row"> 
                    <div class="col-lg-12">
                        <center><h2><strong> Filter Documents </strong></h2></center>
                <br>
                    </div>
            </div>
            
            <div class="row"> 

                <?php if($managemode== 'dmslibadmin'): ?> 
                
                    <div class="col-md-1">

                     <h2 style="color:<?= SN_CLR ?>;"><?= CCMP ?>:</h2> 
                   </div> <!-- col-md-1  -->
                     <div class="col-md-2">

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="sqlfilterccmp" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        
                        <?php foreach($filtccmps as $row) { ?>
                                <option value="<?= $row->id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>                        
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>
               
                    </div> <!-- col-md-2  -->
           <!--             <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="subentity" style="height: 40px; font-size: 20px;">
                       
                        <option selected value = 0>Select</option>                    
                        <?php foreach($filtsubentities as $row) { ?>
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>                         
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>
               
                    </div>  -->

                    <div class="col-md-1">

                     <h2 style="color:<?= SN_CLR ?>;">Region:</h2> 
                   </div> <!-- col-md-1  -->
                     <div class="col-md-2">

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="sqlfilterregion" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtregions as $row) { ?>

                                <option value="<?= $row->id ?>"><?= $row->description ?></option>
                          
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>
               
                    </div> <!-- col-md-2  -->

                <?php endif; ?> 

                <?php if($managemode== 'dmslibadmin'): ?>                     
                     <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;"> File Type: </h2> 
                    </div> <!-- col-md-1  -->
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b " name="sqlfilterformat" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtfiletypes as $row) { ?>

                                 <option value="<?= $row->id ?>"><?= $row->title ?></option>

                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> <!-- col-md-2  -->  
                <?php endif; ?> 
                    
                <?php if($managemode== 'dmslibadmin'): ?> 
                    <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;">Staff: </h2> 
                    </div> <!-- col-md-1  -->
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b " name="sqlfilterstaff" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtstaffs as $row) { ?>
                                 <option value="<?= $row->trongate_user_id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> <!-- col-md-2  --> 
                <?php endif; ?> 
                    
                <!--     <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;">Uploader: </h2> 
                    </div> 
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b " name="sqlfilteruploader" style="height: 40px; font-size: 20px;">
                      
                        <option selected value = 0>Select</option>
                        <?php foreach($uploaders as $row) { ?>

                                 <option value="<?= $row->trongate_user_id ?>"><?= $row->first_name ?> <?= $row->last_name ?></option>

                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div>  -->                     

                    
                    <div class="col-md-1">

                     <h2 style="color:<?= SN_CLR ?>;"><?= CCMPS_FL_TAG1 ?>:</h2> 
                   </div> <!-- col-md-1  -->
                     <div class="col-md-2">

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="sqlfiltertag1" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtdoctags1 as $row) { ?>
                      
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                         
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>
               
                    </div> <!-- col-md-2  -->                      
                    <div class="col-md-1">
                     <h2 style="color:<?= SN_CLR ?>;"><?= CCMPS_FL_TAG2 ?>:</h2> 
                   </div> <!-- col-md-1  -->
                     <div class="col-md-2">

                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="sqlfiltertag2" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtdoctags2 as $row) { ?>
   
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                          
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>
               
                    </div> <!-- col-md-3  -->
                    
                     <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;"> <?= CCMPS_FL_TAG3 ?>: </h2> 
                    </div> <!-- col-md-1  -->
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b" name="sqlfiltertag3" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtdoctags3 as $row) { ?>
                       
                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                           
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> <!-- col-md-2  -->


                <?php if($managemode== 'dmslibccmp'): ?>                     
                     <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;"> File Type: </h2> 
                    </div> <!-- col-md-1  -->
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b " name="sqlfilterformat" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtfiletypes as $row) { ?>

                                 <option value="<?= $row->id ?>"><?= $row->title ?></option>

                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> <!-- col-md-2  -->  
                <?php endif; ?>
                    
                <?php if($managemode== 'dmslibadmin'): ?>                                                       
                    <div class="col-md-1">
                    <h2 style="color:<?= SN_CLR ?>;">Access: </h2> 
                    </div> <!-- col-md-1  -->
                     <div class="col-md-2">
                   
                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><strong><h<?= $_SESSION['fontsize'] ?>></h<?= $_SESSION['fontsize'] ?>></strong></label>
                        <div class="col-sm-7"><select class="form-control m-b " name="sqlfilteraccess" style="height: 40px; font-size: 20px;">
                        <!-- Loop through the dropdown array passed in $data  -->
                        <option selected value = 0>Select</option>
                        <?php foreach($filtdoclib_access as $row) { ?>
                                 <option value="<?= $row->id ?>"><?= $row->title ?></option>
                         <?php } ?>                                    
                         </select>
                        </div>
                        </div>                   
                    </div> <!-- col-md-2  -->  
                <?php endif; ?>            
            
            </div> <!-- row  --> 
                  
                  <div class="row">                 
                        <div class="col-md-12">
                            <h3> <center><button name="submit" type="submit" value="Submit" class="btn btn-outline btn-primary" type="button"><strong><i class="fa fa-bolt"></i> Run Filters</strong></button></center></h3>
                               <!--     <input type="submit" value="Run Filter" class="btn btn-outline btn-lg btn-primary " name="remove_btn" id="remove_btn" ></input> -->
                        </div> <!-- end col  -->                    
                    </div> <!-- row  --> 
            </div> <!-- 60: ibox content  -->
   
        </div> <!-- line 9 col-lg-12  -->
        
<div class="col-md-12"> 

                       <!--         <input type="text" class="form-control" name="sqlfiltertag"  id="tag" value="3">

<h<?= $_SESSION['tfontsize'] ?>> with a type: </h<?= $_SESSION['tfontsize'] ?>>
                                <input type="text" class="form-control" name="sqlfiltertype" id="type" value="5"> -->

</div>
    <br>
</div>
 <!--   </form> -->
 </div> <!-- *End Row -->           
<div class="row"> 

    <div class="col-md-12">
      
            <?php if($filter == 'None' || strlen($filter) < 1): ?> 
                     <?php if($managemode == 'dmslibadmin'): ?> 
                           <h2><center><strong>All Documents </strong></center></h2>
                            
                            <br>
                          <!--  <h3><center><button href="<?= BASE_URL ?>cms-ccmpslibrary/create" class="btn btn-outline btn-primary dim"><i class="fa fa-clone"></i> 1Add Document</button></center></h3> -->
                            <center><a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-ccmpslibrary/create/dmslibadmincreate" ><h3><strong><i class="fa fa-clone"></i> Add Document </strong></h3></a></center>

                    <?php else: ?>
                            <h2><center><strong>All Available Documents</strong></center></h2>                        
                    <?php endif; ?> 
            <?php else: ?>
                                                      
                    <?php if($showclearfilterbtn == 1): ?>
                        <h2><center><strong>Filters Set
                        <br><br><span> <?= $filter ?> </span></strong></center></h2>
                            <br>  
                             <?php if($managemode== 'dmslibccmp'): ?> 

                               
                                <h3> <center><a href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibccmp" class="btn btn-outline btn-primary dim" ><i class="fa fa-bolt"></i> Clear Filters</a></center></h3>                
                                                
                             <?php endif; ?>
                                
                             <?php if($managemode== 'dmslibadmin'): ?> 

                                
                                <h3> <center><button href="<?= BASE_URL ?>cms-ccmpslibrary/manage/dmslibadmin" class="btn btn-outline btn-primary dim" ><i class="fa fa-bolt"></i> Clear Filters</button></center></h3>                
                                                             
                             <?php endif; ?>                            
                            
                                
                                
                   <?php else: ?>
                                    <br> 
                                    <h2><center><strong><span> <?= $filter ?> </span></strong></center></h2>
                                    <br> 

                             <?php if($managemode== 'dmslibccmp'): ?>
                                    <h2><center><strong>All Available Documents </strong></center></h2>                            
                                    <br> 
                                              
                             <?php endif; ?>
                                
                             <?php if($managemode== 'dmslibadmin'): ?> 
                                    <h2><center><strong>All Documents </strong></center></h2>                            
                                    <br>                                     
                                    <center><a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-ccmpslibrary/create/dmslibadmincreate" ><h3><strong><i class="fa fa-clone"></i> 2Add Document </strong></h3></a></center>
                             <?php endif; ?>                                
                            
                               
                     <?php endif; ?>  
            <?php endif; ?>

    </div> <!-- col-lg-  -->

</div> <!-- End Row -->
</form>
<div class="row"> <!-- * -->
     <div class="col-lg-12">
         <center>    
<form  method = "post" action="<?= BASE_URL ?>cms-ccmpslibrary/bulkaction/">  
                                 
                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover dataTables-example" > 

              <!--    <p>    Filter: <?=  $filter  ?>  </p>-->

                <?php if($managemode == 'dmslibccmps'): ?> 
                     <thead>   <!-- Hide search box by breaking deleting <thead> -->
                <?php else: ?> 
                    <thead>
                <?php endif; ?>
                <tr>
           <!--   <th width "20%">Member Num</th> -->                   
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Id</h<?= $_SESSION['tfontsize'] ?>></th>        
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Title</h<?= $_SESSION['tfontsize'] ?>></th>               
                <!--    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Topic</h<?= $_SESSION['tfontsize'] ?>></th> -->
                <?php if($managemode == 'dmslibccmp'): ?> 
    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Author</h<?= $_SESSION['tfontsize'] ?>></th>
            <?php else: ?> 
                   <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Assigned To</h<?= $_SESSION['tfontsize'] ?>></th>
                <?php endif; ?>
            
                    
                    <?php if($managemode== 'dmslibadmin'): ?> 
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Status</h<?= $_SESSION['tfontsize'] ?>></th>
                    <?php endif; ?>
                <!--                
<!--    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= SUBENTITY ?></h<?= $_SESSION['tfontsize'] ?>></th> -->
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Region</h<?= $_SESSION['tfontsize'] ?>></th>
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= CCMPS_FL_TAG1 ?></h<?= $_SESSION['tfontsize'] ?>></th>
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= CCMPS_FL_TAG2 ?></h<?= $_SESSION['tfontsize'] ?>></th>
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>><?= CCMPS_FL_TAG3 ?></h<?= $_SESSION['tfontsize'] ?>></th>
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>File Type</h<?= $_SESSION['tfontsize'] ?>></th>            
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>File Name</h<?= $_SESSION['tfontsize'] ?>></th>              
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>File Date</h<?= $_SESSION['tfontsize'] ?>></th>  
                <!--     <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>File Size</h<?= $_SESSION['tfontsize'] ?>></th>  -->

                    <?php if($managemode== 'dmslibadmin'): ?> 
                        <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Access</h<?= $_SESSION['tfontsize'] ?>></th> 
                    <?php endif; ?>     

                  
                      <th style="color:RoyalBlue;">
                          
                        <div class="row">
                              
                                               
                       <!--     <div class="col-lg-4 col-form-label"> 
                       Checked: 
                   
     
                            </div>
                            <div class="col-lg-1 col-form-label"> 
                    
                                    <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" >
     
                            </div> -->
                            <div class="col-sm-6"> 
                                <a style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Manage</h<?= $_SESSION['tfontsize'] ?>></a>
                                                                         
                                     <!--      <div class="input-group-prepend">
                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"  >Action </button>
                                               
                                                <ul class="dropdown-menu">
                                            
                                                    <?php foreach($bulk_actions as $row) { ?>
                                                    
                                                 <li>
                                                          
                                                 <option name="selected" type=submit" value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->title ?></h<?= $_SESSION['fontsize'] ?>></option>
                                                    
                                                </li>


                                                    <?php } ?>
                                                 
                                                    <li class="dropdown-divider"></li>
                                                    <li><a href="#" style="color:Orange;" ><h<?= $_SESSION['fontsize'] ?>>Cancel</h<?= $_SESSION['fontsize'] ?>></a></li>
                                                   
                                                </ul>
                                                          
                                            </div>  -->
                                         

                                
                              </div>


                         </div>   <!-- row -->
                        </th>
                    </tr>
                    </thead>


                    <tbody>
                            <?php
                                foreach($rows as $row) { 

                                ?>
                                <tr class='gradeA'>
                         
                                    <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['tfontsize'] ?>></td>
                              <!--      <td><?= $row->trongate_user_id ?></td>   -->                            
                               <!--     <td><?= $row->id ?></td> -->


                               <!--     <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->created_at ?></h<?= $_SESSION['tfontsize'] ?>></td> -->
                
                                    <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->title ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                 <!--    <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->shortdescription ?></h<?= $_SESSION['tfontsize'] ?>></td> -->
                
                                
                                    <?php if($managemode == 'dmslibccmp'): ?> 
                                   <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->author ?></h<?= $_SESSION['tfontsize'] ?>></td>
                
                                    <?php else: ?> 
                                   <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->lead ?></h<?= $_SESSION['tfontsize'] ?>></td>
               
                                    <?php endif; ?>
                                     <?php if($managemode== 'dmslibadmin'): ?> 
                                    <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->status ?></h<?= $_SESSION['tfontsize'] ?>></td>
                 <?php endif; ?>
                                <!--   <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->subenttitle ?></h<?= $_SESSION['tfontsize'] ?>></td> -->
                                   <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->regiontitle ?></h<?= $_SESSION['tfontsize'] ?>></td>
                                   <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->doctag1 ?></h<?= $_SESSION['tfontsize'] ?>></td>
         <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->doctag2 ?></h<?= $_SESSION['tfontsize'] ?>></td>
                         <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->doctag3 ?></h<?= $_SESSION['tfontsize'] ?>></td>
                               <?php if($row->filetypetitle  == 'Missing'): ?> 
                 <td><h<?= $_SESSION['tfontsize'] ?> style="color:Red;"><?= $row->filetypetitle ?></h<?= $_SESSION['tfontsize'] ?>></td>
                
                               <?php else: ?> 
                            <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->filetypetitle ?></h<?= $_SESSION['tfontsize'] ?>></td>
                               <?php endif; ?>                 
                
                
                            <?php if($row->filename == 'File Missing' ): ?>
                                <td><h<?= $_SESSION['tfontsize'] ?> style="color:Red;"><?= $row->filename ?></h<?= $_SESSION['tfontsize'] ?>></td>
                            <?php else: ?>
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->filename ?></h<?= $_SESSION['tfontsize'] ?>></td>
                           <?php endif; ?>
                 <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->filedate ?></h<?= $_SESSION['tfontsize'] ?>></td> 
                          <!--  <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->filesize ?></h<?= $_SESSION['tfontsize'] ?>></td> -->
                            <?php if($managemode== 'dmslibadmin'): ?> 
                                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->access ?></h<?= $_SESSION['tfontsize'] ?>></td>
 
                            <?php endif; ?>
 

<!--  <div class="btn-group">  makes buttons stick together -->
                                <td> 
<?php if($managemode == 'dmslibccmp' ): ?>
    <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $row->id ?>/dmslibccmp" ><h<?= $_SESSION['tfontsize'] ?>><i class="<?= $row->fileicon ?>"></i> Info </h<?= $_SESSION['tfontsize'] ?>></a>
     <?php if(strlen($row->filename) > 0 AND $row->filename != 'File Missing'): ?> <!-- Filename Exists-->
         <?php if($row->filetype == 1 ): ?> <!-- Missing or Database Filetype  -->


    <!--     <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="View" href="<?= BASE_URL ?>cms-ccmpslibrary/fulldescription/<?= $row->id ?>/m" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-database"></i> View</h<?= $_SESSION['tfontsize'] ?>></a> -->                                 
         <!-- nothing to download -->
         <?php else: ?> 

                 <?php if($row->filetype == 3): ?> <!-- If PDF either preview or force a download   -->
                     <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $row->id ?>" download><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['tfontsize'] ?>></a> 

                     <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="Preview" href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $row->id ?>/p" target="_blank" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye"></i> Preview</h<?= $_SESSION['tfontsize'] ?>></a> 
<!--                      <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-ccmpslibrary/saveAndPreviewDocx" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-save"></i> SaveandP</h<?= $_SESSION['tfontsize'] ?>></a> -->
<!-- <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-ccmpslibrary/docx_to_text/<?= $row->id ?>" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-save"></i> DtoTP</h<?= $_SESSION['tfontsize'] ?>></a> -->

                 <?php else: ?> 
                     <!-- not a PDF  -->
                     <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-download"></i> Download</h<?= $_SESSION['tfontsize'] ?>></a>
                 <?php endif; ?>                             

         <?php endif; ?>

         <?php if($row->filetype < 2): ?> 

<!--    <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Preview" href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $row->id ?>" target="_blank" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye"></i> -Preview</h<?= $_SESSION['tfontsize'] ?>></a>   -->                                  
<!--        <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Preview" href="<?= BASE_URL ?>cms-ccmpslibrary/previewdocrec/<?= $row->id ?>/p"  target="_blank" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye"></i> Preview</h<?= $_SESSION['tfontsize'] ?>></a> -->
         <?php endif; ?>


     <?php else: ?> 
     <!-- filename is missing  -->
     <?php endif; ?>


<?php endif; ?> <!-- not mmyads, dmslibccmp  -->


 <!-- No need to approve chapter docs  -->


<?php if($managemode == 'dmslibadmin' ): ?>
      <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $row->id ?>/dmslibadmin" ><h<?= $_SESSION['tfontsize'] ?>><i class="<?= $row->fileicon ?>"></i> Info </h<?= $_SESSION['tfontsize'] ?>></a>
 
<!--    <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>cms-ccmpslibrary/viewdocrec/<?= $row->id ?>/dmslibadmin" ><h<?= $_SESSION['tfontsize'] ?>><i class="<?= $row->fileicon ?>"></i> Info </h<?= $_SESSION['tfontsize'] ?>></a> -->          
    <a class="btn btn-outline btn-secondary"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/update/<?= $row->id ?>/dmslibadminupdate" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['tfontsize'] ?>></a>

    <?php if($row->approved > 0): ?>                            
          <a class="btn btn-outline btn-secondary" type="button"  data-toggle="tooltip" data-placement="right" title="Disapprove Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/unapproverecord/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-thumbs-down"></i></h<?= $_SESSION['tfontsize'] ?>></a>  
    <?php else: ?>
          <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Approve Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/approverecord/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-thumbs-up"></i></h<?= $_SESSION['tfontsize'] ?>></a>  

    <?php endif; ?>


    <?php if($row->approved == 1): ?> 
          <?php if($row->active > 0): ?>                            
                <a class="btn btn-outline btn-secondary" type="button"  data-toggle="tooltip" data-placement="right" title="Hide Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/hiderecord/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye-slash"></i></h<?= $_SESSION['tfontsize'] ?>></a>

          <?php else: ?>
                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Unhide Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/unhiderecord/<?= $row->id ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye"></i></h<?= $_SESSION['tfontsize'] ?>></a>  

          <?php endif; ?>
    <?php endif; ?>


    <?php if($row->filetype == 1): ?> 
 <!--       <a class="btn btn-outline btn-success" type="button" data-toggle="tooltip" data-placement="right" title="View DB Record" href="<?= BASE_URL ?>cms-ccmpslibrary/fulldescription/<?= $row->id ?>/m" ><h<?= $_SESSION['tfontsize'] ?>>580<i class="fa fa-database"></i></h<?= $_SESSION['tfontsize'] ?>></a> -->

    <?php else: ?> <!-- It is a real file so check to see if it is missing before showing a download button  -->
            <?php if($row->filename == 'File Missing' ): ?> <!-- "File Missing" is computed and passed to the form, not a value in the DB filename field   -->
                <!-- if the filename is File Missing then dont show the download button  -->
            <?php else: ?>

                          <a class="btn btn-outline btn-secondary" type="button" data-toggle="tooltip" data-placement="right" title="Download" href="<?= BASE_URL ?>cms-ccmpslibrary/downloaddoc/<?= $row->id ?>" download><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-download"></i></h<?= $_SESSION['tfontsize'] ?>></a> 
             <?php endif; ?>
                          
                          
    <?php endif; ?>
                          
                        
                     <!--     <php if($row->deleted > 0): ?>                            
 <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/undelrecord/<?= $row->id ?>/<?= $row->title ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-undo"></i></h<?= $_SESSION['tfontsize'] ?>></a>                               
                           
                          <php else: ?>  -->
 <!-- hiding button to force using bulk delete until confirm delete can be implemented                              
<a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/delrecord/<?= $row->id ?>/<?= $row->title ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>></a>         -->                   
<?php endif; ?>  


 
 
<!-- A title with spaces will crash in UAT.  The title is for the auditlog only -->
<?php
$str = $row->title ;
$new_str = str_replace(' ', '', $str); // Outputs: removes all spaces
?>

    <?php if($row->id == 1): ?> <!-- If it is the document 1 which is ATIS do not allow to be deleted  -->
    <!-- ATIS - do nothing  -->
    <?php else: ?>
<!--  <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-ccmpslibrary/delrecord/<?= $row->id ?>/<?= $new_str ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>></a>  --> 
    <?php endif; ?>
 

                         
                                    </td>                                                           

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                </table>
                     
                </div> <!-- end div table responsive-->
</form>
            </center>
        </div> <!-- End Column  -->
     </div> <!-- End Row  --> 
     
<div class=row">
    <div class="col-md-12">
        
  <?php if($managemode == 'dmslibadmin' ): ?>
        
<center><a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-ccmpslibrary/create" ><h3><strong><i class="fa fa-clone"></i> Add Document </strong></h3></a></center>
   <!--     <a class="btn btn-outline btn-primary"   type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/create"><span style="font-size: 20px; color: lightseagreen;"><i class="fa fa-clone"></i> Add Document</span></a> -->
 <!--       <a class="btn btn-outline btn-secondary" type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><span style="font-size: 20px;"> <i class="fa fa-home"></i> Home</span></a>  -->
 
  <?php endif; ?>
          
</div> <!-- End col-12  -->   
</div> <!-- End Row  -->

 

        </div> <!-- end col-lg-12 ln 16 -->

    <!--    <a class="btn btn-outline btn-secondary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a> -->
                                       
    </div> <!-- row -->

    </div> <!-- ibox content page -->

<!-- End Content   -->
<br>


   <!-- Begin Modals -->
<!--          
<div class="modal inmodal fade" id="delete-modal<?= $row->id; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> DeletDoc</h4>
            </div>
            <div class="modal-body">
                <p><h1><strong>Are you sure?</strong></h1></p>
                <h3>Once deleted it can't be undone.</h3>
                <?php echo $row->id; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                 <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-ccmpslibrary/delrecord/<?= $row->id ?>/m">Delete <?= $row->id ?></a>
            </div>
        </div>
    </div>
</div> -->


<!-- Must load jquery first when locally controlling datatables settings below. OK for datatables js to be in Inspinia template file  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){
            // code to dynamically generate for DelButton
            var myRow = 0;
            $(".DelButton").each(function(){
                myRow = myRow +1;
                $(this).attr("id", "DelButton" + myRow);
            });

            //from datatables
            $('.dataTables-example').DataTable({
                paging: true,
                searching: true,
                pageLength: 1000,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                 /*   { extend: 'copy'}, 
                    {extend: 'csv'},*/
                    {extend: 'excel', title: 'ExcelFile'},
                 /*   {extend: 'pdf', title: 'PDFFile'}, */

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    } /*  */
                ] 

            });
                    // $("#btn.8").on('click',function(){  
                        $("#btn.5").click(function(){  
alert('fired!');                

            });
                        $("#checkAll").click(function(){  
//alert('fired!');  
  // Each submit button on a tab that triggers what is selected in the dropdown for bulk actions must be unique.
                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll2").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll3").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });            



         
    });
    </script>

<!--     $("#btn.id").click(function(){
                var del_recno = $("#btn.id").val();
 alert(del_recno);               
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                }); 
  }); -->
 <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<h3>View: welcome-ccmps/ccmphome</h3>');
    echo('<h3>New Session Id</h3>');
    $session_id = session_id();
    echo ('<h3>'.$session_id.'</h3>');    
    echo('<h3>$_COOKIE</h3>');
    json($_COOKIE);
    echo('<br>');
    echo('<h3>$data</h3>');
    json($data);    
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
 ?>
 <?php endif; ?> 