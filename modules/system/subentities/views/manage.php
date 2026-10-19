<!-- *********************************************************************** -->
<!--                               NAVBAR                                  -->
<!--                                                           --> 
<!--                                                          -->
<!--                                                  -->                                         
<!-- *********************************************************************** -->
<?php 
  include('navbar.php');
?>    
<!-- *********************************************************************** -->
<!--                               Header                                    -->
<!--  Picture                                                                --> 
<!--  Or Logo                                                                -->
<!--  Users Full Name                                                        -->                                         
<!-- *********************************************************************** -->

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
<!-- *********************************************************************** -->
<!--                               Table Label                               -->                                     
<!-- *********************************************************************** -->
            <div class="ibox-content">  

                    <div>
                      <h3><strong><?= SHORTSITENAME ?> <?= SUBENTITIES ?></strong></h3> 
                   
                    </div>
          

                <br>

    <!-- Show flash message then reset it to blank  -->

    <?php if($_SESSION['flashmsgcolor'] == 1): ?>

     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); 
     $_SESSION['flashmsgcolor'] = 0; ?> 

   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); 
     $_SESSION['flashmsgcolor'] = 0; ?> 
   
   <?php endif; ?>

<!-- *********************************************************************** -->
<!--                                 Datatable                               -->                                     
<!-- *********************************************************************** -->
                                   
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example" > 

        <thead>

            <tr>

                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Num</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>><?= SUBENTITY ?></h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Full Name</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Chartered</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Region</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Website</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Facebook</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Instagram</h<?= $_SESSION['mfontsize'] ?>></th>
                <th style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>YouTube</h<?= $_SESSION['mfontsize'] ?>></th>

                <th style="color:RoyalBlue;">                  
                    <div class="row">                              
                        <div class="col-sm-6"> 
                            <a style="color:RoyalBlue;"><h<?= $_SESSION['mfontsize'] ?>>Options</h<?= $_SESSION['mfontsize'] ?>></a>                                
                        </div>
                     </div>  
                </th>
            </tr>

        </thead>

        <tbody>
                <?php
                    foreach($subentities as $row) { 

                    ?>
                    <tr class='gradeA'>

                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->id ?></h<?= $_SESSION['mfontsize'] ?>></td>
                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->title ?></h<?= $_SESSION['mfontsize'] ?>></td>
                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->description ?></h<?= $_SESSION['mfontsize'] ?>></td>
                                                              
                        <?php   if($row->chartered == 1) { 
                               $row->chartered = 'Yes';
                          }else{ 
                               $row->chartered = 'No';
                          }
                          ?>
                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->chartered ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                        <td><h<?= $_SESSION['mfontsize'] ?>><?= $row->region ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                        <td><h<?= $_SESSION['mfontsize'] ?>><a href=<?= $row->website ?> target="_blank" title="BPA"><?= $row->website ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                        <td><h<?= $_SESSION['mfontsize'] ?>><a href=<?= $row->facebook ?> target="_blank" title="BPA"><?= $row->facebook ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                        <td><h<?= $_SESSION['mfontsize'] ?>><a href=<?= $row->instagram ?> target="_blank" title="BPA"><?= $row->instagram ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                        <td><h<?= $_SESSION['mfontsize'] ?>><a href=<?= $row->youtube ?> target="_blank" title="BPA"><?= $row->youtube ?></h<?= $_SESSION['mfontsize'] ?>></td> 
                <td> 
                  <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Record" href="<?= BASE_URL ?>system-subentities/viewrecord/<?= $row->id ?>" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-eye"> View</i></h<?= $_SESSION['mfontsize'] ?>></a>
                <a class="btn btn-outline btn-warning"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Record"  href="<?= BASE_URL ?>system-subentities/update/<?= $row->id ?>" ><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-pencil"> Update</i></h<?= $_SESSION['mfontsize'] ?>></a>
                         
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

            <!--    <div class="btn-group"> -->
                            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>system-subentities/create"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-user"></i> Create New <?= SUBENTITY ?></h<?= $_SESSION['mfontsize'] ?>></a>
                 
             

        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><h<?= $_SESSION['mfontsize'] ?>><i class="fa fa-times-circle"></i> Close</h<?= $_SESSION['mfontsize'] ?>></a>  
 <!--  </div> -->
            </div> <!-- ibox content table -->
 

        </div> <!-- end col-lg-12 ln 16 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

<!-- End Content   -->
<br>


   <!-- Begin Modals -->


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


