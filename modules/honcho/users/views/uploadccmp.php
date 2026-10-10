  
<?php 
  include('navbar.php');
?>    

<!-- Begin Content   -->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>



<!--  <div class="ibox-content"> <!-- -->

           <!--     <div class="ibox content"> <!--   -->
 <!--    <div class="ibox-title"> -->

                <div class="row"> 
            
               <!--   <div class="col-md-0">
                  </div> -->
                  <div class="col-md-12">
  <!-- <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> -->
                      <div class="navbar-header">
                       <!--   <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
                       <ul class="nav navbar-top-links navbar-center">

                        <!--    <li>
                                 <span class="m-r-sm text-muted welcome-message"><strong> <?= CCMP ?> Administration<!-- <?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?> -></strong></span>
                            </li> -->
                            
                            <li>    
                                  <span class="break"><h2><strong>Uploading New/Updated <?= CCMPS ?> from Excel</strong></h2></span>
                            </li>     
                      </ul>
                      </div> <!--  end navbar-header -->

                  <!-- Show flash message then reset it to blank  -->
                  <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                  $flash_msg = '';
                  set_flashdata($flash_msg); ?> 
                  <strong> <?= validation_errors() ?></strong>

                     
                  </div> <!-- col 10-->  
              </div>  <!-- row -->  
              <div class="row"> 

               <!--   <div class="col-md-2">
                  </div> -->
                  <div class="col-md-12">
                    <br>
                      <form  method = "post" enctype="multipart/form-data" action="<?= BASE_URL ?>welcome-ccmps/ccmpupload/mamm"> <!-- frmpg passed to form and passed back in Post below-->
                    <!--    <p><h3>Select file:</h3></p> -->
                        <input type="file" name="file_upload"/>
                        <br><br>
                        <input type="submit" value="Upload to Staging"/>
                      </form> 
                  </div>
              </div>

<br><br>
                    <div class="ibox-content">
                  
                    <strong>Uploaded <?= CCMPS ?></strong><br>
                    <div>Staging Table</div>
                    <br>
                   
                                 

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
    <!--    <th>id</th> -->
                        <th>Options</th> 
                        <th>MEM_NO</th> 
                        <th>TYPE</th> 
                        <th>TITLE</th>
                        <th>FIRST_NAME</th>
                        <th>MIDDLE_INITIAL</th>
                        <th>LAST_NAME</th>
                        <th>SUFFIX</th>
                        <th>BPA_CHAPTER</th>
    
                        <th>ADDRESS 1</th>
                        <th>ADDRESS 2</th>
                        <th>CITY</th>
                        <th>STATE</th>
                        <th>ZIP</th>
                    <!--    <th>COUNTRY</th> -->
                        <th>HOME_PHONE</th>
                        <th>CELLULAR_PHONE</th>
                        <th>EMAIL</th>
                        <th>FAX</th>
                        <th>BIRTHYEAR</th> 
                     <!--   <th>CURRENT_YEAR</th> -->
                        <th>HIGHEST CERT</th>
                        <th>CERT NO</th>
                        <th>TOTAL TIME</th>

                   <!--     <th>SINGLE_ENGINE_LAND</th>
                        <th>SINGLE_ENGINE_SEA</th>
                        <th>MULTI_ENGINE_LAND</th>
                        <th>MULTI_ENGINE_SEA</th>
                        <th>INSTRUMENT</th>
                        <th>FREE_BALLOON</th>
                        <th>ROTOCRAFT</th>
                        <th>GLIDER</th>
                        <th>FLIGHT_INSTRUCTOR</th>
                        <th>FLIGHT_INSTRUCTOR_INSTRUMENT</th>
                        <th>GROUND_INSTRUCTOR</th>
                        <th>ADVANCED_GROUND_INSTRUCTOR</th>
                        <th>DISPATCHER</th>
                        <th>FLIGHT_INSTRUCTOR_MULTI_ENGINE</th>
                        <th>DESIGNATED_PILOT_EXAMINER</th>
                        <th>OTHER CREWMEMBER</th>
                        <th>Certificate.</th>
                        <th>MAINTENANCE</th>
                        <th>A_P</th>
                        <th>AI</th>
                        <th>MAINT_MILITARY</th>
                        <th>AIRSHIP</th>
                        <th>AIR_TRAFFIC_CONTROLLER</th>
                        <th>OTHER_FAA_CERTIFICATE</th>
                        <th>Cert.</th>
                        <th>DECEASED</th>
                        <th>SPECIAL_EVENT</th>
                        <th>NEWSLTR</th>
                        <th>NO_ADDRESS</th>
                        <th>CALL_SIGN</th>
                        <th>REG_NO</th>
                        <th>A_C_TYPE</th> -->

                    </tr>
                    </thead>
                    <tbody>
                 <!--      <tr class='gradeA'> -->
                            <?php
                                foreach($datauploaded as $row) { 

                                ?>
<?php if(strlen($row->id) > 0) { ?> <!-- Strip off the view data records from the recordset  -->
                                 
       <!--     <td><?= $row->id ?></td> -->
                         <td>
                           <p> <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmpuploaded/<?= $row->id ?>" >Update</a></p>

                     <!--     <?php if($row->deleted > 0): ?>                            

                                <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/undelrecord/<?= $row->id ?>">Undelete</a>                               
                          <?php else: ?>

                                <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/delrecord/<?= $row->id ?>">Delete </a>

                          <?php endif; ?> -->



                         </td> 
                        <td><?= $row->member_no ?></td> 
                        <td><?= $row->member_type ?></td> 
                        <td><?= $row->salutation ?></td>
                        <td><?= $row->first_name ?></td>
                        <td><?= $row->middle_name ?></td>
                        <td><?= $row->last_name ?></td>
                        <td><?= $row->suffix ?></td>
                        <td><?= $row->chapter ?></td>
       
                        <td><?= $row->mailaddress1 ?></td>
                        <td><?= $row->mailaddress2 ?></td>
                        <td><?= $row->mailcity ?></td>
                        <td><?= $row->mailstate ?></td>
                        <?php if($row->mailstate == "NJ" OR $row->mailstate == "CT"  OR $row->mailstate == "MA" OR $row->mailstate == "NJ") { ?> 
                            <td>'<?= $row->mailzip ?></td>
                        <?php }else{ ?>
                            <td><?= $row->mailzip ?></td>   
                        <?php } ?>  
                   <!--     <td><?= $row->mailcountry ?></td> -->
                        <td><?= $row->phone ?></td>
                        <td><?= $row->mobile ?></td>
                        <td><?= $row->email_address ?></td>
                        <td><?= $row->fax ?></td>
                        <td><?= $row->birthday ?></td> 
                    <!--    <td><?= $row->current_year ?></td> -->
                        <td><?= $row->highest_certificate ?></td>
                        <td><?= $row->certificate_number ?></td>
                        <td><?= $row->total_time ?></td>


                     <!--   <td><?= $row->se_land ?></td>
                        <td><?= $row->se_sea ?></td>
                        <td><?= $row->me_land ?></td>
                        <td><?= $row->me_sea ?></td>
                        <td><?= $row->instrument ?></td>
                        <td><?= $row->balloon ?></td>
                        <td><?= $row->rotocraft ?></td>
                        <td><?= $row->glider ?></td>
                        <td><?= $row->cfi ?></td>
                        <td><?= $row->cfii ?></td>
                        <td><?= $row->bgi ?></td>
                        <td><?= $row->agi ?></td>
                        <td><?= $row->dispatcher ?></td>
                        <td><?= $row->mei ?></td>
                        <td><?= $row->dpe ?></td>
                        <td><?= $row->other_crewmember ?></td>
                        <td><?= $row->ocm_certnum ?></td>
                        <td><?= $row->maintenance ?></td>
                        <td><?= $row->ap ?></td>
                        <td><?= $row->ia ?></td>
                        <td><?= $row->military_maint ?></td>
                        <td><?= $row->airship ?></td>
                        <td><?= $row->atc ?></td>
                        <td><?= $row->other_faq_cert ?></td>                        
                        <td><?= $row->ofc_certnum ?></td>
                        <td><?= $row->deceased ?></td>
                        <td><?= $row->special_event ?></td>
                        <td><?= $row->mail_notices ?></td>
                        <td><?= $row->no_address ?></td>
                        <td><?= $row->call_sign ?></td>
                        <td><?= $row->aircraft_reg ?></td>
                        <td><?= $row->aircraft_type ?></td>  -->                        
                            </tr>

            <?php } ?>                              
                                <?php
                                  
                                 } ?> 

                            </tbody>

                            </table>
                                                       <p> <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmpuploaded/<?= $row->id ?>" >Import into <?= CCMP ?> Table</a></p>
                        </div> <!-- Table Responsive -->

                    </div> <!-- ibox content -->

   
