<?php 
  include('navbar.php');
?>    

<!-- Begin Content   -->

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">   
                <div class="row"> 

                    <?php if(strlen($picture) > 0): ?> <!--  if user pic -->
                        <div class="col-md-1">   
<img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/>                        
                        </div> <!-- end col -->
                    <?php else: ?> <!-- No pic  -->
                        <div class="col-md-1">  
                      
                            <div class="row">
                                <div class="col-md-1"> <!-- for spacing --> 
                                </div>
                               <a href="#" title="">
<img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
                               </a>
                            </div>
                        <br>
                        </div> <!-- end col -->
                    <?php endif; ?>
                        <div class="col-md-9">
                  
                        
                        <span class="m-r">
                           <h1 style="color:RoyalBlue;"><?= $header ?></h1>
                            <a href="#">
<h2><?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?></h2>
                            </a>
                            <a href="#"><h2><?= $activity ?></h2></a>
                 
                        </span>

                        </div> <!-- end column -->
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <?php if(strlen($picture) > 0): ?>
                                    <div class="col-md-2">   
                                        <h1 class="logo text-center">
                                            <a href="#" title="bpalogo">
                                                <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
                                            </a>
                                        </h1>
                                    </div> <!-- end col -->
                                <?php endif; ?> 
                            </li>
                        </ul>
                </div> <!-- end row -->

            </div> <!-- end ibox-title- ln 17 -->

            <div class="ibox-content">  

                <?php if($_SESSION['admode'] == 'mmyads'): ?> 

                    <div>
                      <h<?= $_SESSION['mfontsize'] ?>><strong>All Items</strong></h<?= $_SESSION['mfontsize'] ?>> 
                   <!--    <br>Choose a Record to View/Edit -->
                    </div>

                <?php elseif($_SESSION['ccmpmode'] == 'mcmm'): ?> 
                    <div>
                      <h<?= $_SESSION['mfontsize'] ?>><strong>Only Current <?= CCMPS ?></strong> <br>Choose a Record to View/Edit</h<?= $_SESSION['mfontsize'] ?>>
                    </div>

                <?php elseif($_SESSION['ccmpmode'] == 'mamm'): ?>
                    <div>
                      <h<?= $_SESSION['mfontsize'] ?>><strong>All <?= CCMPS ?> - Including Deceased & Deleted</strong> <br>Choose a Record to View/Edit</h<?= $_SESSION['mfontsize'] ?>>
                    </div>                      

                <?php else: ?> 

                <?php endif; ?>


          <!--        <?php if($mcma == 'mcm'): ?> 

                    <div>
                      <strong>Only Current Member Records - Excluding Deceased & Deleted</strong> <br>Choose a Record to View or Edit
                    </div>

                  <?php else: ?> 
                    <div>
                     <strong>All Member Records - Including Deceased & Deleted</strong> <br>Choose a Record to View or Edit
                    </div>

                  <?php endif; ?> -->

                        <!--     <span class="loading words"></span> -->             

                        <br>


                        <!-- Show flash message then reset it to blank  -->
                        <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                        $flash_msg = '';
                        set_flashdata($flash_msg); ?> 

<form  method = "post" action="<?= BASE_URL ?>cms-marquee/bulkaction/">  
                                   
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" > 
                <?php if($_SESSION['admode'] == 'mmyads'): ?> 
                     <thead>   <!-- Hide search box by breaking  -->
                <?php else: ?> 
                    <thead>
                <?php endif; ?>
                <tr>
              <!--     <th>Id</th> -->
                 <!--   <th width "20%">Member Num</th> -->
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Posted/Updated</h<?= $_SESSION['mfontsize'] ?>></th>
                               <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Status</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Title</h<?= $_SESSION['mfontsize'] ?>></th>
                     <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Message</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Scope</h<?= $_SESSION['mfontsize'] ?>></th>
                     <?php if($_SESSION['admode'] == 'mmyads'): ?> 
                     <?php else: ?> 
                        <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Poster</h<?= $_SESSION['mfontsize'] ?>></th>

                     <?php endif; ?>
                     <?php if($_SESSION['admode'] == 'mmyads'): ?> 
                     <?php else: ?> 
                        <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>><?= SUBENTITY ?></h<?= $_SESSION['mfontsize'] ?>></th>

                     <?php endif; ?>
<!-- <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Contact Phone/Email</h<?= $_SESSION['mfontsize'] ?>></th>  -->
<!-- <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Alt Contact Name/Phone/Email</h<?= $_SESSION['mfontsize'] ?>></th> -->
              <!--     <th>Message</th> -->
                <!--    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Location</h<?= $_SESSION['mfontsize'] ?>></th> -->
              <!--      <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Best Offer</h<?= $_SESSION['mfontsize'] ?>></th> -->
               <!--     <th>Alt Contact Info</th> -->
                    <!--   <th>Start Date</th>
                      <th>End Date</th> -->
                    
                <!--       <th style="color:RoyalBlue;">

                      
                         <div class="row">
                          <div class="col-lg-7 col-form-label"> 
                                                             <!-- Need a separate Submit button with this method ->
                                    <select class="form-control m-b" name="selected" id="selected"> 
                                        <?php foreach($bulk_actions as $row) { ?>

                                                <option value="<?= $row->id ?>"><h<?= $_SESSION['fontsize'] ?>><?= $row->title ?></h<?= $_SESSION['fontsize'] ?>></option>

                                        <?php } ?>                                     
                                    </select> 
                          </div>
                            <div class="col-lg-1 col-form-label"> <!-- this one col-lg-2 and the rest col-lg-3 by design to render properly   ->
                    
                                    <input id="ntcsubmit" style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" >
     
                            </div>
                               
                         </div>
                       <center>    Toggle All <input type="checkbox" id="checkAll"> </center>
                       </th> -->
                  
                      <th style="color:RoyalBlue;">
                          
                        <div class="row">
                              
                                               
                       <!--     <div class="col-lg-4 col-form-label"> 
                       Checked: 
                   
     
                            </div>
                            <div class="col-lg-1 col-form-label"> 
                    
                                    <input style="color:Blue;" class="btn btn-default btn-outline" type="submit" value="Submit" >
     
                            </div> -->
                            <div class="col-sm-6"> 
                                <a style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Actions</h<?= $_SESSION['mfontsize'] ?>></a>
                                                                         
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
                              <!--      <td><?= $row->id ?></td> -->
                              <!--      <td><?= $row->trongate_user_id ?></td>   -->                            
                               <!--     <td><?= $row->id ?></td> -->
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->created_at ?></h<?= $_SESSION['mfontsize'] ?>></td>
                
                                    <?php if($row->approved == 1): ?> 
                                        <?php if($row->active == 1): ?>
                                                <td><h<?= $_SESSION['mfontsize'] ?> style="color:;">Approved/Visable</h<?= $_SESSION['mfontsize'] ?>></td>
                
                                        <?php else: ?>
                <td><h<?= $_SESSION['mfontsize'] ?> style="color:Red;">Approved/Hidden</h<?= $_SESSION['mfontsize'] ?>></td>
                                        <?php endif; ?>                 
                                     
                                    <?php else: ?>                            
                                               <td><h<?= $_SESSION['mfontsize'] ?> style="color:Red;">Unapproved/Hidden</h<?= $_SESSION['mfontsize'] ?>></td>
                
                                    <?php endif; ?> 
                
                
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->title ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->info1 ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->scope ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                    <?php if($_SESSION['admode'] == 'mmyads'): ?> 
                                    <?php else: ?> 
                                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->poster ?></h<?= $_SESSION['mfontsize'] ?>></td>  
                                    <?php endif; ?> 
                                    <?php if($_SESSION['admode'] == 'mmyads'): ?> 
                                    <?php else: ?> 
                                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->chapter ?></h<?= $_SESSION['mfontsize'] ?>></td>  
                                    <?php endif; ?>                                                
                              <!--      <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->contact_info ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                              <!--      <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->alt_contact_info ?></h<?= $_SESSION['mfontsize'] ?>></td>--> 
                               <!--     <td><?= $row->shortdescription ?></td> -->
                               <!--     <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->location ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                                <!--    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->current_bid ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                               <!--     <td><?= $row->alt_contact_info ?></td> -->
                                 <!--   <td><?= $row->startdate ?></td>
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->enddate ?></h<?= $_SESSION['mfontsize'] ?>></td> -->

                          
                               <!--     <td><?= $row->trongate_user_id ?></td> -->

                            <!--         <td><?= $row->last_login ?></td> -->



                               <!--     <td><?= $row->locked ?></td> -->

                               <!--     <td><?= $row->updated_at ?></td> -->
                
                           <!--     <td><center><input type="checkbox" class="checkItem" value="<?= $row->id ?>" name="id[]"></center></td> -->



                 <!--  <div class="btn-group">  makes buttons stick together -->

                                <td> 

                              <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>cms-marquee/viewitem/<?= $row->id ?>" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-"></i>More</h<?= $_SESSION['mfontsize'] ?>></a> 

                              <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>cms-marquee/update/<?= $row->id ?>" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['mfontsize'] ?>></a>
                      <?php if($_SESSION['admode'] == 'mmyads'): ?>
                      <?php else: ?> 
                          <?php if($row->approved > 0): ?>                            
                                <a class="btn btn-outline btn-warning" type="button"  data-toggle="tooltip" data-placement="right" title="Disapprove Record"  href="<?= BASE_URL ?>cms-marquee/unapproverecord/<?= $row->id ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-thumbs-down"></i></h<?= $_SESSION['mfontsize'] ?>></a>  
                          <?php else: ?>
                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Approve Record"  href="<?= BASE_URL ?>cms-marquee/approverecord/<?= $row->id ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-thumbs-up"></i></h<?= $_SESSION['mfontsize'] ?>></a>  

                          <?php endif; ?>
                      <?php endif; ?>
                        <?php if($row->approved == 1): ?> 
                          <?php if($row->active > 0): ?>                            
                                <a class="btn btn-outline btn-warning" type="button"  data-toggle="tooltip" data-placement="right" title="Hide Record"  href="<?= BASE_URL ?>cms-marquee/hiderecord/<?= $row->id ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-eye-slash"></i></h<?= $_SESSION['mfontsize'] ?>></a>
                                                           
                          <?php else: ?>
                                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Unhide Record"  href="<?= BASE_URL ?>cms-marquee/unhiderecord/<?= $row->id ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-eye"></i></h<?= $_SESSION['mfontsize'] ?>></a>  

                          <?php endif; ?>
                        <?php endif; ?>

                    <!--      <?php if($row->deleted > 0): ?>                            
 <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record"  href="<?= BASE_URL ?>cms-marquee/undelrecord/<?= $row->id ?>/<?= $row->title ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-undo"></i></h<?= $_SESSION['mfontsize'] ?>></a>                               
                           
                          <?php else: ?> 
                              
<a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-marquee/delrecord/<?= $row->id ?>/<?= $row->title ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['mfontsize'] ?>></a>                           
                        <?php endif; ?> -->

<?php
$str = $row->title ;
$new_str = str_replace(' ', '', $str); // Outputs: removes all spaces
?>

 <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>cms-marquee/delrecord/<?= $row->id ?>/<?= $new_str ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['mfontsize'] ?>></a>   


                         
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

  <?php if($_SESSION['admode'] == 'mmyads' ): ?> <!-- ccmp -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>cms-marquee/create"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-clone"></i> Create New Item</h<?= $_SESSION['mfontsize'] ?>></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-times-circle"></i> Close</h<?= $_SESSION['mfontsize'] ?>></a> 
  <?php elseif($_SESSION['admode'] == 'cmmads' || $_SESSION['admode'] == 'momads'): ?> <!-- Content Manager or Chapter Admin -->
        <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>cms-marquee/create"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-clone"></i> Create New Item</h<?= $_SESSION['mfontsize'] ?>></a>
        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-times-circle"></i> Close</h<?= $_SESSION['mfontsize'] ?>></a>  
  <?php else: ?> 

  <?php endif; ?>

                  <!--  <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close</a> -->
            </div> <!-- ibox content table -->
 

        </div> <!-- end col-lg-12 ln 16 -->
  
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
                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Job</h4>
            </div>
            <div class="modal-body">
                <p><h1><strong>Are you sure?</strong></h1></p>
                <h3>Once deleted it can't be undone.</h3>
                <?php echo $row->id; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                 <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-marquee/delrecord/<?= $row->id ?>/m">Delete <?= $row->id ?></a>
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
              /*      { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExcelFile'},
                    {extend: 'pdf', title: 'PDFFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    } */
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
