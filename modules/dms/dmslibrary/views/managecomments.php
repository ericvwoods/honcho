<?php 
  include('navbar.php');
?>    

<!-- Begin Content   -->

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">   
                <div class="row"> 
                    
                    
                        <div class="col-md-1">  
                         <br>
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
                            
                           <?php if($_SESSION['filelibrary_rolename'] == 'dmslibadmin'): ?> 
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span> 
                                <a style="color:<?= SN2_CLR ?>;" href="#"><h2><?= $activity ?></h2></a>
                            <?php else: ?>
                               <span  style="color:<?= SN_CLR ?>; font-size: 30px;"><?= $header ?></span>                       
                            <?php endif; ?>                            
                        </span>
                        </div> <!-- end column -->
                          <div class="col-md-4">
                              <br>
                             <br>
                               <?php if($_SESSION['filelibrary_rolename'] == 'dmslibadmin'): ?>           
                    <ul class="nav navbar-top-links navbar-right">

                      
<a class="btn btn-primary btn-rounded btn-outline" href="<?= BASE_URL ?>dms-dmslibrary/kanban/m"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 20px;"><i class="fa fa-list-alt"></i> Kanban Board</span></a>
   <div class="col-md-1"> 
                      </div>
<a class="btn btn-primary btn-rounded btn-outline" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 20px;"><i class="fa fa-list"></i> Manage</span></a>                                                
                      
                    </ul> <!-- End Navbar right  -->
                       <?php endif; ?> 
                      </div> <!-- end column -->
              
                      <div class="col-md-2">
                           <br>
                            <br>
<!-- <a class="btn btn-primary btn-rounded btn-outline" href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin"><span style="color: <?= CCMPS_BACK_BTN_CLR ?>; font-size: 20px;"><i class="fa fa-list"></i> Manage Docs</span></a> -->                                               
                      
                      </div> <!-- end column -->
                </div> <!-- end row -->

            </div> <!-- end ibox-title- ln 17 -->
 <br>
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
   
        </div> <!-- line 9 col-lg-12  -->
        
<div class="col-md-12"> 

                       <!--         <input type="text" class="form-control" name="sqlfiltertag"  id="tag" value="3">

<h<?= $_SESSION['tfontsize'] ?>> with a type: </h<?= $_SESSION['tfontsize'] ?>>
                                <input type="text" class="form-control" name="sqlfiltertype" id="type" value="5"> -->

</div>

</div>
 <!--   </form> -->
 <!-- </div> --><!-- End Ibox for page -->
 
<div class="ibox-content"> 
    
<div class="row"> 

    <div class="col-md-12">
      
            <?php if($filter == 'None' || strlen($filter) < 1): ?> 
                     <?php if($_SESSION['filelibrary_rolename'] == 'dmslibadmin'): ?> 
 <h2><center><strong><?= $doctitle ?></strong></center></h2>
                      
                        <!--   <h2><center><strong>Document Comments </strong></center></h2> -->
                            
                            <br>
                          <!--  <h3><center><button href="<?= BASE_URL ?>dms-dmslibrary/create" class="btn btn-outline btn-primary dim"><i class="fa fa-clone"></i> 1Add Document</button></center></h3> -->
                     <!--       <center><a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>dms-dmslibrary/createdoccomment" ><h3><strong><i class="fa fa-clone"></i> Add Comment </strong></h3></a></center>  -->

  <center> 
  <button  type ="button" class="btn btn-outline btn-primary dim" title="Add Comment" data-toggle="modal" data-target="#xxx" >+ <i class="fa fa-comment-o"><strong> Add Comment</strong></i></button>
   <br>
</center>

                    <?php else: ?>
                            <h2><center><strong>All Available Documents</strong></center></h2>                        
                    <?php endif; ?> 
            <?php else: ?>
                                                      
                    <?php if($showclearfilterbtn == 1): ?>
                        <h2><center><strong>Filters Set
                        <br><br><span> <?= $filter ?> </span></strong></center></h2>
                            <br>  
                             <?php if($_SESSION['filelibrary_rolename']== 'dmslibuser'): ?> 

                               
                                <h3> <center><a href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibuser" class="btn btn-outline btn-primary dim" ><i class="fa fa-bolt"></i> Clear Filters</a></center></h3>                
                                                
                             <?php endif; ?>
                                
                             <?php if($_SESSION['filelibrary_rolename']== 'dmslibadmin'): ?> 

                                
                                <h3> <center><button href="<?= BASE_URL ?>dms-dmslibrary/manage/dmslibadmin" class="btn btn-outline btn-primary dim" ><i class="fa fa-bolt"></i> Clear Filters</button></center></h3>                
                                                             
                             <?php endif; ?>                            
                            
                                
                                
                   <?php else: ?>
                                    <br> 
                                    <h2><center><strong><span> <?= $filter ?> </span></strong></center></h2>
                                    <br> 

                             <?php if($_SESSION['filelibrary_rolename']== 'dmslibuser'): ?>
                                    <h2><center><strong>All Available Documents </strong></center></h2>                            
                                    <br> 
                                              
                             <?php endif; ?>
                                
                             <?php if($_SESSION['filelibrary_rolename']== 'dmslibadmin'): ?> 
                                    <h2><center><strong>All Documents </strong></center></h2>                            
                                    <br>                                     
                                    <center><a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>dms-dmslibrary/create/dmslibadmincreate" ><h3><strong><i class="fa fa-clone"></i> Add Document </strong></h3></a></center>
                             <?php endif; ?>                                
                            
                               
                     <?php endif; ?>  
            <?php endif; ?>

    </div> <!-- col-lg-  -->

</div> <!-- End Row -->
</form>
<div class="row"> <!-- * -->
     <div class="col-lg-12">
     
         <center>    
           <br>
             <h3>You must enter a resolution to close a comment</h3>
<form  method = "post" action="<?= BASE_URL ?>dms-dmslibrary/bulkaction/">  
                                 
                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover dataTables-example" > 

              <!--    <p>    Filter: <?=  $filter  ?>  </p>-->

                <?php if($_SESSION['filelibrary_rolename'] == 'dmslibuser'): ?> 
                     <thead>   <!-- Hide search box by breaking deleting <thead> -->
                <?php else: ?> 
                    <thead>
                <?php endif; ?>
                <tr>
           <!--   <th width "20%">Member Num</th> -->                   
                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Id</h<?= $_SESSION['tfontsize'] ?>></th>

                   <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Status</h<?= $_SESSION['tfontsize'] ?>></th>

                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Created</h<?= $_SESSION['tfontsize'] ?>></th>
                        
    

                    <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Commentor</h<?= $_SESSION['tfontsize'] ?>></th>
                   <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Comment</h<?= $_SESSION['tfontsize'] ?>></th>
                   <th style="color:<?= SN_CLR ?>;"><h<?= $_SESSION['tfontsize'] ?>>Resolution</h<?= $_SESSION['tfontsize'] ?>></th>
                  
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

                <?php if($row->soft_deleted == 1): ?> 
                <td><h<?= $_SESSION['tfontsize'] ?> style="color: <?= DMS_HM_TAB_TITLE_RED_CLR ?>">Deleted</h<?= $_SESSION['tfontsize'] ?>></td> 

                 <?php else: ?>
                            <?php if($row->status == "Open"): ?> 
                <td><h<?= $_SESSION['tfontsize'] ?> style="color: <?= DMS_HM_TAB_TITLE_RED_CLR ?>"><?= $row->status ?></h<?= $_SESSION['tfontsize'] ?>></td>
                            <?php else: ?>
                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->status ?></h<?= $_SESSION['tfontsize'] ?>></td>

                            <?php endif; ?>  

                      <?php endif; ?>                                    
                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->created_at ?></h<?= $_SESSION['tfontsize'] ?>></td>

                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->commentor ?></h<?= $_SESSION['tfontsize'] ?>></td>
                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->comment ?></h<?= $_SESSION['tfontsize'] ?>></td>
                <td><h<?= $_SESSION['tfontsize'] ?>><?= $row->resolution ?></h<?= $_SESSION['tfontsize'] ?>></td>
<!--  <div class="btn-group">  makes buttons stick together -->
                                <td> 

    <a class="btn btn-outline btn-primary" type="button" data-toggle="tooltip" data-placement="right" title="View Comment" href="<?= BASE_URL ?>dms-dmslibrary/viewdoccomment/<?= $row->id ?>/dmslibadmin" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-eye"></i></h<?= $_SESSION['tfontsize'] ?>></a>
       
    <a class="btn btn-outline btn-secondary"  type="button"  data-toggle="tooltip" data-placement="right" title="Update Comment"  href="<?= BASE_URL ?>dms-dmslibrary/updatedoccomment/<?= $row->id ?>/dmslibadminupdate" ><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-pencil"></i></h<?= $_SESSION['tfontsize'] ?>></a>
 
<!-- A title with spaces will crash in UAT.  The title is for the auditlog only -->
<!--<php
//$str = $row->title ;
//$new_str = str_replace(' ', '', $str); // Outputs: removes all spaces
?> -->
  
          <?php if($row->soft_deleted > 0): ?>                            
                <a class="btn btn-outline btn-primary" type="button"  data-toggle="tooltip" data-placement="right" title="Undelete Record"  href="<?= BASE_URL ?>dms-dmslibrary/undeldoccomment/<?= $row->id ?>/dmslibadmin/m"><h<?= $_SESSION['tfontsize'] ?>>Un <i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>></a>  

          <?php else: ?>
                <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>dms-dmslibrary/deldoccomment/<?= $row->id ?>/dmslibadmin/m"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>></a>
          <?php endif; ?>

    <?php if($row->id == 1): ?> <!-- If it is the document 1 which is ATIS do not allow to be deleted  -->
    <!-- ATIS - do nothing  -->
    <?php else: ?>
<!--  <a class="btn btn-outline btn-danger" type="button"  data-toggle="tooltip" data-placement="right" title="Delete Record"  href="<?= BASE_URL ?>dms-dmslibrary/delrecord/<?= $row->id ?>/<?= $new_str ?>"><h<?= $_SESSION['tfontsize'] ?>><i class="fa fa-trash"></i></h<?= $_SESSION['tfontsize'] ?>></a>  --> 
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
        
  <?php if($_SESSION['filelibrary_rolename'] == 'dmslibadmin' ): ?>
        
  <center> 
  <button  type ="button" class="btn btn-outline btn-primary dim" title="Add Comment" data-toggle="modal" data-target="#xxx" >+ <i class="fa fa-comment-o"><strong> Add Comment</strong></i></button>
<!--   <br>
                                        <p>A warning message, with a function attached to the "Confirm"-button...</p>
                                        <button class="btn btn-warning btn-sm demo3">Run example</button>   -->
</center>
   <!--     <a class="btn btn-outline btn-primary"   type="button" href="<?= BASE_URL ?>dms-dmslibrary/create"><span style="font-size: 20px; color: lightseagreen;"><i class="fa fa-clone"></i> Add Document</span></a> -->
 <!--       <a class="btn btn-outline btn-secondary" type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><span style="font-size: 20px;"> <i class="fa fa-home"></i> Home</span></a>  -->
 
  <?php endif; ?>
          
</div> <!-- End col-12  -->   
</div> <!-- End Row  -->
</div> <!-- ibox content for all documents  -->
 

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
                 <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>dms-dmslibrary/delrecord/<?= $row->id ?>/m">Delete <?= $row->id ?></a>
            </div>
        </div>
    </div>
</div> -->

    <div class="modal inmodal" id="xxx" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated rotateInDownLeft">  <!-- rotateInDownRight, slideInRight,  bounceInRight, rotateIn, flip -->

            <div class="modal-header">
             <!--   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> -->
                <h2 class="modal-title"><span style="color: darkgreen";><i class="fa fa-comments-o fa-1x"></i> Add Comment</span></h2>
               
                    <h2 class="modal-title"><span style="color: black";><i class="fa fa-file fa-1x"></i> <?= $doctitle ?></span></h2>             
            </div> 

            <form action="<?= BASE_URL ?>dms-dmslibrary/modaladddoccomment" method = "post">   
            <div class="modal-body">               
                <div class="form-group"> <!-- Used to pass the recid to ajax function.  --> 

    <textarea  class="form-control border-left m-t" style="height: 200px" name="doccomment" id=""><?php
$t = time();
echo date("m-d-Y H:i a", $t) . "\n" . "\n";
?></textarea> 

    <input type="text" class="form-control" name="recid" id="recid" value="<?= $docid ?>" hidden >
   
     <input type="text" class="form-control" name="managemode" id="managemode" value="dmslibadmin"  hidden>
     <input type="text" class="form-control" name="frmpg" id="frmpg" value="mc" hidden >
     <input type="text" class="form-control" name="status" id="status" value="3" hidden > 

                </div>
            </div>  
            <div class="modal-footer">

 <div class="row">
    <div class="col-md-5">
                                                                           
<input type="submit" value="Add"class="btn btn-primary block m-b" name="DocCommentBtn" id="DocCommentBtn" ></input>
    
    </div>
        <div class="col-md-4">
       
        <input type="button" value="Cancel" class="btn btn-warning block m-b" data-dismiss="modal"></input>

    </div>
</div>


<!-- Must load jquery first when locally controlling datatables settings below. OK for datatables js to be in Inspinia template file  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){

            $('.demo3').click(function () {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {

//alert('fired!');

        var frmpg        = $("#frmpg").val();
        var recid        = $("#recid").val();

                    $.ajax({                       
                        url:'<?= BASE_URL ?>dms-dmslibrary/deldoccomment',
                        type: 'post',
                        data: {frmpg:frmpg,recid:recid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("frmpg").val("");
                                $("#recid").val("");
                                $("#myModal").modal("hide");
                            }, 2500);
                        

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                            console.log($errmsg);
                        }          
                    });




        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
});

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