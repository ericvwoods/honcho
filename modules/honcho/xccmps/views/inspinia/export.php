<!--
1) Replace all lcparent with the lowercase parent module name ex. dashboards
2) Replace all lcmodname with lowercase module name ex. gsclasses
3) Replace the fieldset form controls to match database table
-->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>


<div class="wrapper wrapper-content animated fadeInRight">
<!--    <div class="ibox-content"> -->
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">                   
                          
                        <div>
                            <h2>Export Member Records</h2>
                        </div>

                        <div class="ibox-tools">
                       <!--     <a class="btn btn-rounded" href="<?= BASE_URL ?>dashboards/index/gsclasses/create/<?= $row->id ?>/m">Create</a> -->
                    <!--    <a class="btn btn-success btn-rounded btn-outline btn-bitbucket" href="<?= BASE_URL ?>honcho/index/system_accounts/create//m">
                            <i class="fa fa-star"></i> Create
                        </a> -->
                            <!--    <i class="fa fa-chevron-up"></i> -->
                           
                       <!--     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul> -->
                        <!--    <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>

                    </div>

                <div class="ibox-content">  
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Member Records</a></li>

                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="ibox-content">
                                  
                                    <strong>Member Master Sheet</strong> 
                                    <br>
                                    <br>
                                 

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
    <!--    <th>id</th> -->
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
                 <!--      <tr class='gradeA'> -->
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

                            </table>
                        </div> <!-- Table Responsive -->

                    </div> <!-- ibox content -->
                </div> <!--  panel body -->

            </div> <!-- End Tab Panel 1 -->

        </div> <!-- Tab Content for All Tabs  -->

<!-- </div> -->
    </div> <!--  tabs container -->


 </div> <!-- ibox content for the tabs contaner -->

                </div> <!-- ibox for colum lg 12  -->
            </div> <!-- class row  -->

        </div> <!-- Class wrapper fade-in right  -->

