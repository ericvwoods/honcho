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
<img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
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
                                                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                                            </a>
                                        </h1>
                                    </div> <!-- end col -->
                                <?php endif; ?> 
                            </li>
                        </ul>
                </div> <!-- end row -->

            </div> <!-- end ibox-title- ln 17 -->

            <div class="ibox-content">  

                <a class="btn btn-primary"  type="button" href="<?= BASE_URL ?><?= HONCHO_MODULE == 1 ? 'honcho' : 'welcome-ccmps/ccmphome' ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-times-circle"></i> Close</h<?= $_SESSION['mfontsize'] ?>></a>  
                <br><br>

                <?php if($_SESSION['admode'] == 'sysadmin'): ?> 

                    <div>
                      <h<?= $_SESSION['mfontsize'] ?>><strong>Auditlog</strong></h<?= $_SESSION['mfontsize'] ?>> 
                   
                    </div>

                <?php else: ?> 

                <?php endif; ?>

            <!--    <span class="loading words"></span> -->             

                <br>


                <!-- Show flash message then reset it to blank  -->
                <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?> 

<!-- Bulk actions removed 2026-10-16 (not needed this version); bulkaction() is still in Auditlogger.php -->
                                   
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" > 

                <thead>

                <tr>

                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Recno</h<?= $_SESSION['mfontsize'] ?>></th>  
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Type</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Action</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Function</h<?= $_SESSION['mfontsize'] ?>></th>
                <!--    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>User</h<?= $_SESSION['mfontsize'] ?>></th> -->
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>One</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Two</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Three</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Four</h<?= $_SESSION['mfontsize'] ?>></th>
                <!--    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Five</h<?= $_SESSION['mfontsize'] ?>></th>
                    <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Six</h<?= $_SESSION['mfontsize'] ?>></th>  -->
                    
                    
                    <th style="color:RoyalBlue;">
                          
                        <div class="row">                              
                            <div class="col-sm-6"> 
                                <a style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Options</h<?= $_SESSION['mfontsize'] ?>></a>                                
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

                                <!--    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->created_at ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['mfontsize'] ?>></td>  
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->type ?></h<?= $_SESSION['mfontsize'] ?>></td>                
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->action ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->func ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                <!--    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->created_by ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str1 ?></h<?= $_SESSION['mfontsize'] ?>></td>  
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str2 ?></h<?= $_SESSION['mfontsize'] ?>></td>  
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str3 ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str4 ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                                <!--    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str5 ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                                    <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->str6 ?></h<?= $_SESSION['mfontsize'] ?>></td> -->
                                 




                 <!--  <div class="btn-group">  makes buttons stick together -->
                                <td> 

                              <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>system-auditlogger/viewntc/<?= $row->id ?>/1" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-eye"></i></h<?= $_SESSION['mfontsize'] ?>></a> <!-- The 1 sets the $_SESSION tab default  -->         
                          <!--    <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>system-auditlogger/update/<?= $row->id ?>/1" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['mfontsize'] ?>></a> -->

                          <?php if($row->deleted > 0): ?>                            
 <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record"  href="<?= BASE_URL ?>system-auditlogger/undelrecord/<?= $row->id ?>/<?= $row->action ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-undo"></i></h<?= $_SESSION['mfontsize'] ?>></a>                               
                           
                          <?php else: ?>
<a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>system-auditlogger/delrecord/<?= $row->id ?>/<?= $row->type ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['mfontsize'] ?>></a>

 <div class="modal inmodal fade" id="delete-modal".<?= $row->id ?> tabindex="-1" role="dialog"  aria-hidden="true">

    <div class="modal-dialog modal-sm">
    
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Log</h4>
            </div>
           <form action="" method = "post"> 
            <div class="modal-body">
                <p><h1><strong>Are you sure?</strong></h1></p>
                <h3>Once deleted it can't be undone.</h3>
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                 <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>system-auditlogger/delrecord/<?= $row->id ?>/<?= $row->title ?>">Delete</a>
            </div>
            </form>
  
    </div>
</div>                   

    
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

        <a class="btn btn-primary"  type="button" href="<?= BASE_URL ?><?= HONCHO_MODULE == 1 ? 'honcho' : 'welcome-ccmps/ccmphome' ?>"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-times-circle"></i> Close</h<?= $_SESSION['mfontsize'] ?>></a>  

            </div> <!-- ibox content table -->
 

        </div> <!-- end col-lg-12 ln 16 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

<!-- End Content   -->
<br>


   <!-- Begin Modals -->


<!-- Must load jquery first when locally controlling datatables settings below. OK for datatables js to be in Inspinia template file  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
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
