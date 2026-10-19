    <!-- start: Nav Bar -->
    <?php include('navbar.php'); ?>                   
    <!-- end: Nav Bar-->
    
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

    <div class="ibox-content"> <!-- ibox for page header -->
            <div class="row">
                <div class="col-lg-12">
               
            <div class="row">
                <div class="col-lg-12">
               
                    <div class="ibox-title">   
<div class="row">
<div class="col-lg-11">
                
                        <div>
                            <!--Blue   --> <span class="m-r"><a href="#"> <h2><strong>National Roster</strong></h2></a> </span>
                      <!--    <h2><strong>National Directory</strong></h2> -->
                          <h3>Only <?= CCMPS ?> Who Have Opted In for Inclusion</h3>
                        </div>
    
                    <?= flashdata('<div style="font-weight: bold; color:
                      green; ">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

</div> <!-- col 11 -->
<div class="col-lg-1">
          <ul class="nav navbar-top-links navbar-right">
            <li>
                 <!--   <php if(strlen($picture) > 0): ?> -->
                    <div class="col-md-1">   
                          <h1 class="logo text-center">
                              <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                                  <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
                              </a>
                          </h1>
                </div> <!-- end col -->
            <!--  <php endif; ?> -->

            </li>
          </ul>
</div> <!-- col 1 -->

</div> <!-- row   -->

                <div class="ibox-content">  
                                               
                            <strong></strong>

                        <!--    <p>Click on the <?= CCMP ?>  Number to see the entire record</p> -->
                            

                                 
                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

                                   <br>
                    <div class="table-responsive">
                 <!--   <table class="table table-striped table-bordered table-hover" >  -->
                   <table class="table table-striped table-bordered table-hover dataTables-example" > 
             <!--   <php if($_SESSION['chapteradmin'] == 1): ?> -->
                    <thead>  <!-- removing this this makes the table read only by causing the print options and search box not to show - remove from below too -->
             <!--   <php endif; ?> -->
                    <tr>
                  <!--     <th>Tbl Id</th> 
                        <th>User Id</th> -->
                      
                         <th style="color:RoyalBlue;">Name </th>
                          <th style="color:RoyalBlue;">Call Sign</th>
                         <th style="color:RoyalBlue;">Address</th>
                     <!--   <th>Prefix</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Suffix</th>-->
                        
                 <!--       <th>Current</th> -->
                        
 
                        <th style="color:RoyalBlue;">Email</th> 
                        <th style="color:RoyalBlue;">Phone</th> 
                        <th style="color:RoyalBlue;">Mobile</th>
                        <th style="color:RoyalBlue;"><?= SUBENTITY ?></th>
                        <th style="color:RoyalBlue;"><?= SUBENTITY ?> Role</th>
                       
                        <th style="color:RoyalBlue;"><?= CCMP ?> Number</th>
                  <!--      <th>Type</th> -->
                 
                    <!--      <th>Options</th> -->
                       </tr>
                      </thead> 
                  
             <!--   <php if($_SESSION['chapteradmin'] == 1): ?> -->
                 <!--   </thead> --> <!-- removing this this makes the table read only by causing the print options and search box not to show - remove from below too -->
            <!--    <php endif; ?> -->

                    <tbody>
                            <?php
                                foreach(($ccmpsrecs ?? array()) as $row) { // the controller passes ccmpsrecs 

                                ?>
                                <tr class='gradeA'>
                            <!--        <td><?= $row->id ?></td> 
                                    <td><?= $row->trongate_user_id ?></td>   -->                            
                                 <!--   <td><a href="<= BASE_URL ?>welcome-ccmps/viewccmp/<?= $row->id ?>/msp"><?= $row->ccmp_number ?></a></td>-->
                                    
                                    <td><?= $row->last_name ?> <?= $row->suffix ?>, <?= $row->salutation ?> <?= $row->first_name ?> <?= $row->middle_name ?></td>
                                       <td><?= $row->call_sign ?></td> 
                                    <?php if($row->vip == 1): ?>
                                        <td>Restricted Access</td>
                                    <?php else:  ?>
                                        <td><?= $row->mailaddress1 ?> <?= $row->mailaddress2 ?> <?= $row->mailcity ?>, <?= $row->mailstate ?> <?= $row->mailzip ?></td> 
                                    <?php endif; ?>
                                    <td><?= $row->email_address ?></td>
                                    <?php if($row->vip == 1): ?>
                                        <td>Restricted Access</td>
                                        <td>Restricted Access</td>
                                    <?php else:  ?> 
                                        <td><?= $row->phone ?></td>
                                        <td><?= $row->mobile ?></td>
                                    <?php endif; ?>
                                    <td><?= $row->subentity ?></td>
                                    <td><?= $row->subentity_role ?></td>                                                       
                                 
                                    <td><?= $row->ccmp_number ?></td>
                            <!--        <td><?= $row->ccmp_type ?></td>  -->
                        <!--    <td><div class="btn-group">
                             <a class="btn btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>welcome/mobiviewccmp/<?= $row->id ?>" >View</a>                                
                            </div></td> -->
                           <!--         <td><?= $row->last_login ?></td> -->



                            <!--        <td><?= $row->locked ?></td> -->

                             <!--       <td><?= $row->updated_at ?></td> -->
                             <!--       <td>                                                                  
                            <div class="btn-group">
                             <a class="btn btn-rounded btn-outline btn-primary" type="button"  href="<?= BASE_URL ?>welcome/mobiviewccmp/<?= $row->id ?>/m" >View</a>                                
                                <a class="btn btn-rounded btn-outline btn-warning" type="button" href="<?= BASE_URL ?>welcome/mobiupdatemydata/<?= $row->id ?>/m">Update</a> 

                            </div>
                          
                                    </td>     -->                                                      

                                </tr>
                                <?php } ?> 

                    </tbody>
                    <tfoot>
                    <tr>
               <!--        <th>Tbl Id</th> 
                        <th>User Id</th> -->
                  <!--       <th><?= CCMP ?> Number</th>
                         <th>Name</th> -->
                     <!--   <th>Prefix</th>
                        <th>First</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Suffix</th>-->
               
                     
                  <!--      <th>Current</th> -->

                     
                    <!--   <th>Call Sign</th>
                        <th>Email</th> 
                        <th>Phone</th> 
                        <th>Mobile</th> 
                          <th><?= SUBENTITY ?></th>
                        <th>Type</th> -->
                   <!--     <th>Updated</th> -->
                  <!--      <th>Options</th> -->
                    </tr>
                    </tfoot>
                </table>
                </div> <!-- end div table responsive-->
                            <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><i class="fa fa-times-circle"></i> Close</a>
            </div> <!-- ibox content table -->
 
        </div> <!-- col 12 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){


            //from datatables
            $('.dataTables-example').DataTable({
           //     paging: false,
           //     searching: false,
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
               /*     { extend: 'copy'},
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
           });
    </script>