    <!-- start: Nav Bar -->
    <?php include('navbar.php'); ?>                   
    <!-- end: Nav Bar-->

<!-- Begin Content   -->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>
            <div class="ibox-content">  
                                               
                                               <strong>Create a Les Formatted Spreadsheet - Just press the Excel button to Download</strong> <br>Choose a Record to View or Edit
                                               <br>
                         
                                                    
                                              
                                               <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                                               $flash_msg = '';
                                               set_flashdata($flash_msg); ?> 
                   
                                       <div class="table-responsive">
                                         <table class="table table-striped table-bordered table-hover dataTables-example" > 
                                        <thead>
                                         <tr>
                        <th>MEM_NO</th>
                        <th>MEM_SUF</th>
                        <th>TITLE</th>
                        <th>FIRST_NAME</th>
                        <th>MIDDLE_INITIAL</th>
                        <th>LAST_NAME</th>
                        <th>BPA_CHAPTER</th>
                        <th>NATIONAL_OFFICER</th>
                        <th>CHAP_OFFICER</th>
                        <th>PRIMARY_ADDRESS_LINE_1</th>
                        <th>PRIMARY_ADDRESS_LINE_2</th>
                        <th>CITY</th>
                        <th>STATE_PROV_</th>
                        <th>Zip Code</th>
                        <th>COUNTRY</th>
                        <th>HOME_PHONE</th>
                        <th>CELLULAR_PHONE</th>
                        <th>E_MAIL_1</th>
                        <th>FAX</th>
                        <th>BIRTHDAY</th>
                        <th>CURRENT_YEAR</th>
                        <th>CERTIFICATES</th>
                        <th>CERT_NO</th>
                        <th>TOTAL_TIME</th>
                        <th>SINGLE_ENGINE_LAND</th>
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
                        <th>A_C_TYPE</th>

                                       </tr>
                                       </thead>
                   
                   
                                       <tbody>
 <tr class='gradeA'> 
                            <?php
                                foreach($data as $row) { 

                                ?>
<?php if(strlen($row->id) > 0) { ?> <!-- Strip off the view data records from the recordset  -->
                                 
       <!--     <td><?= $row->id ?></td> -->
                        <td><?= $row->member_no ?></td>
                        <td><?= $row->member_type ?></td>
                        <td><?= $row->salutation ?></td>
                        <td><?= $row->first_name ?></td>
                        <td><?= $row->middle_name ?></td>
                        <td><?= $row->last_name ?></td>
                        <td><?= $row->chapter ?></td>
                        <td><?= $row->national_officer ?></td>
                        <td><?= $row->chapter_role ?></td>
                        <td><?= $row->mailaddress1 ?></td>
                        <td><?= $row->mailaddress2 ?></td>
                        <td><?= $row->mailcity ?></td>
                        <td><?= $row->mailstate ?></td>
                        <?php if($row->mailstate == "NJ" OR $row->mailstate == "CT"  OR $row->mailstate == "MA" OR $row->mailstate == "nj") { ?> 
                            <td>'<?= $row->mailzip ?></td>
                        <?php }else{ ?>
                            <td><?= $row->mailzip ?></td>   
                        <?php } ?>  
                        <td><?= $row->mailcountry ?></td>
                        <td><?= $row->phone ?></td>
                        <td><?= $row->mobile ?></td>
                        <td><?= $row->email_address ?></td>
                        <td><?= $row->fax ?></td>
                        <td><?= $row->birthday ?></td>
                        <td><?= $row->current_year ?></td>
                        <td><?= $row->highest_certificate ?></td>
                        <td><?= $row->certificate_number ?></td>
                        <td><?= $row->total_time ?></td>
                        <td><?= $row->se_land ?></td>
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
                        <td><?= $row->aircraft_type ?></td>                          
                            </tr>

            <?php } ?>                              
                                <?php
                                  
                                 } ?> 
                   
                                       </tbody>
                                       <tfoot>
                                       <tr>
                        <th>MEM_NO</th>
                        <th>MEM_SUF</th>
                        <th>TITLE</th>
                        <th>FIRST_NAME</th>
                        <th>MIDDLE_INITIAL</th>
                        <th>LAST_NAME</th>
                        <th>BPA_CHAPTER</th>
                        <th>NATIONAL_OFFICER</th>
                        <th>CHAP_OFFICER</th>
                        <th>PRIMARY_ADDRESS_LINE_1</th>
                        <th>PRIMARY_ADDRESS_LINE_2</th>
                        <th>CITY</th>
                        <th>STATE_PROV_</th>
                        <th>Zip Code</th>
                        <th>COUNTRY</th>
                        <th>HOME_PHONE</th>
                        <th>CELLULAR_PHONE</th>
                        <th>E_MAIL_1</th>
                        <th>FAX</th>
                        <th>BIRTHDAY</th>
                        <th>CURRENT_YEAR</th>
                        <th>CERTIFICATES</th>
                        <th>CERT_NO</th>
                        <th>TOTAL_TIME</th>
                        <th>SINGLE_ENGINE_LAND</th>
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
                        <th>A_C_TYPE</th>

                                       </tr>
                                       </tfoot>
                                   </table>
                                        
                                   </div> <!-- end div table responsive-->
                                           
                                            <a class="btn btn-rounded btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close</a>
                                    </div> <!-- ibox content table -->


        </div> <!-- col 12 -->
  
    </div> <!-- row -->
 
    </div> <!-- ibox content page -->

<!-- End Content   -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){
            //from datatables
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
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
                    }
                ]

            });
           });
    </script>
<!-- Begin Footer   -->

<!-- End Footer   -->