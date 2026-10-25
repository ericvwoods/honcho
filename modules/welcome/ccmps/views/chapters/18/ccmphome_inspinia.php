  <?php 

  switch($_SESSION['ccmpmode']) {
   case 'momv':  
        include('navbar.php');
  break; 

   case 'mcmv':  
        include('navbar4.php');
  break;   

   case 'mamv':   
        include('navbar4.php');
  break;
   case 'momm':  // create is called from manage or view pages
        include('navbar.php');
  break; 

    case 'momu':  // create is called from manage or view pages
        include('navbar.php');
  break;

    case 'momc':  // create is called from manage or view pages
        include('navbar.php');
  break;

   case 'mcmm':  
        include('navbar4.php');
  break;   

   case 'mcmu':  
        include('navbar4.php');
  break; 

   case 'mcmc':  
        include('navbar4.php');
  break; 

   case 'mamm':   
        include('navbar4.php');
  break;   

   case 'mamu':   
        include('navbar4.php');
  break; 

   case 'mamc':   
        include('navbar4.php');
  break;    
//default:
        //include('navbar4.php');

  }  ?> 

            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12"> 
        <div class="ibox-content">
            <div class="row"> 

                <?php if(strlen($picture) > 0): ?> 
                        <div class="col-md-1">   
                            <img alt="user picture" class="rounded-circle" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>"/> 
                        <!--    <img alt="user picture" class="rounded-circle" src="<= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
                        </div> <!-- end col -->
                <?php endif; ?>

                <div class="col-md-10">
                    <br>
                    <h2>
                        <?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?></h2>
                    <p><h2><?= $chapter ?></h2></p> 
                <!--      <p><h2><?= $chapter ?> Mode: <?= $_SESSION['ccmpmode'] ?> Tab: <?= $_SESSION['tab'] ?></h2></p> -->
<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/1">Done</a>
                </div> <!-- end column -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                         <!--   <php if(strlen($picture) > 0): ?> -->
                                <div class="col-md-1">   
                                    <h1 class="logo text-center">
                                        <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                                            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                                        </a>
                                    </h1>
                                </div> <!-- end col -->
                        <!--    <php endif; ?> -->

                        </li>
                    </ul>
            </div> <!-- end row -->



        </div>

       <br>                

                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="row">
                                    <div class="col-md-2">   
                  <a data-toggle="collapse" href="#faq1" class="faq-question">Contact Information</a>
                                    </div> <!-- end col -->
                  
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['tab'] == 1): ?>
                                        <div id="faq1" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq1" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
  <div id="calendar"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq2" class="faq-question">Credentials</a>
                             <!--       <small>Added by <strong>Mark Nowak</strong> <i class="fa fa-clock-o"></i> Today 3:30 pm - 11.06.2014</small> -->
                                </div>
                              <!--    <div class="col-md-3">
                                    <span class="small font-bold">Robert Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    42
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['tab'] == 2): ?>
                                        <div id="faq2" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq2" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                    <div class="ibox-content">
                    
                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!-- <php if($_SESSION['tab'] == 2): ?>  -->

                                   <!--     <form  method = "post" action="<= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->
                      

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 

                                    <div class="row"> 
                                        <div class="col-md-6">
                                    
                                    <br>
<!--  Begin Update/Create Tab 2 -->

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Highest Cert<a style="color:Red;">*</a></label>
                                        <div class="col-sm-4"><select class="form-control m-b" name="highest_certificate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($highestcerts as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $highest_certificate): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->cert_title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Certificate No</label>
                                            <div class="col-sm-8"><input name="certificate_number" type="text" class="form-control" value="<?= $certificate_number ?>" ></div>
                                        </div>                                               
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Total Time</label>
                                            <div class="col-sm-2"><input name="total_time" type="text" class="form-control" value="<?= $total_time ?>" ></div>
                                        </div>
                                            <div class="form-group  row">  <label class="col-sm-2 col-form-label">VIP</label> 
                                              <div class="col-sm-2"><select class="form-control m-b" name="vip" Value="<?= $vip ?>" >
                                                <?php if($vip == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                                <div class="ibox-content">
                          <center><strong>Ratings</strong></center>
                          <br>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Land</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="se_land" Value="<?= $se_land ?>" >
                                                <?php if($se_land == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Land</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="me_land" Value="<?= $me_land ?>" >
                                                <?php if($me_land == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">SE Sea</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="se_sea" Value="<?= $se_sea ?>" >
                                                <?php if($se_sea == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ME Sea</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="me_sea" Value="<?= $me_sea ?>" >
                                                <?php if($me_sea == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Instrument</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="instrument" Value="<?= $instrument ?>" >
                                                <?php if($instrument == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="cfi" Value="<?= $cfi ?>" >
                                                <?php if($cfi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">CFII</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="cfii" Value="<?= $cfii ?>" >
                                                <?php if($cfii == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">MEI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="mei" Value="<?= $mei ?>" >
                                                <?php if($mei == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">DPE</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="dpe" Value="<?= $dpe ?>" >
                                                <?php if($dpe == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">BGI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="bgi" Value="<?= $bgi ?>" >
                                                <?php if($bgi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">AGI</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="agi" Value="<?= $agi ?>" >
                                                <?php if($agi == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Rotocraft</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="rotocraft" Value="<?= $rotocraft ?>" >
                                                <?php if($rotocraft == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Glider</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="glider" Value="<?= $glider ?>" >
                                                <?php if($glider == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Balloon</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="balloon" Value="<?= $balloon ?>" >
                                                <?php if($balloon == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Airship</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="airship" Value="$<?= $airship ?>" >
                                                <?php if($airship == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Drone</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="drone" Value="$<?= $drone ?>" >
                                                <?php if($drone == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                                </div>  <!-- ibox-content -->

                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Hall of Fame</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="hall_of_fame" Value="<?= $hall_of_fame ?>" >
                                                <?php if($hall_of_fame == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Active Duty</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="active_duty" Value="<?= $active_duty ?>" >
                                                <?php if($active_duty == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                          
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Former Military</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="former_military" Value="$<?= $former_military ?>" >
                                                <?php if($former_military == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>   
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military Pilot</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="military_pilot" Value="<?= $military_pilot ?>" >
                                                <?php if($military_pilot == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                                <div class="ibox-content">
                          <center><strong>Other Certificates & Certifications</strong></center>
                          <br>                                                                                       
                             
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crewmember</label>
                                            <div class="col-sm-8"><input name="other_crewmember" type="text" class="form-control" value="<?= $other_crewmember ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other Crew Cert #</label>
                                            <div class="col-sm-8"><input name="ocm_certnum" type="text" class="form-control" value="<?= $ocm_certnum ?>" ></div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">A&P</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="ap" Value="<?= $ap ?>" >
                                                <?php if($ap == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">A&P #</label>
                                            <div class="col-sm-8"><input name="ap_number" type="text" class="form-control" value="<?= $ap_number ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">IA</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="ia" Value="<?= $ia ?>" >
                                                <?php if($ia == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Military A&P</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="military_maint" Value="<?= $military_maint ?>" >
                                                <?php if($military_maint == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Maintenance</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="maintenance" Value="<?= $maintenance ?>" >
                                                <?php if($maintenance == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">ATC</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="atc" Value="<?= $atc ?>" >
                                                <?php if($atc == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Dispatcher</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="dispatcher" Value="<?= $dispatcher ?>" >
                                                <?php if($dispatcher == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert</label>
                                            <div class="col-sm-8"><input name="other_faa_cert" type="text" class="form-control" value="<?= $other_faa_cert ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert #</label>
                                            <div class="col-sm-8"><input name="ofc_certnum" type="text" class="form-control" value="<?= $ofc_certnum ?>" ></div>
                                        </div>    
                                        
                                            </div> <!-- ibox-content -->
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Credential Notes</label>
                                    <div class="col-sm-12"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 


                                      

                                                          
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                    



<!--  End Update create tab 2 -->


                                   <!--     </form>  continuous form  -->


<!-- <php endif; ?> --><!-- End if($_SESSION['tab'] == 2) -->

                            <?php else: ?>  <!-- viewing Tab 2-->

                                        <div class="row"> 
                                            <div class="col-md-6">
                                                

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                            <!--          <a class="btn btn-outline btn-warning"  type="button" href="<= BASE_URL ?>welcome-ccmps/manage/momm/2">Close</a> -->
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                         <!--             <a class="btn btn-outline btn-warning"  type="button" href="<= BASE_URL ?>welcome-ccmps/manage/mcmm/2">Close</a> -->
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" >Update</a>
                                 <!--     <a class="btn btn-outline btn-warning"  type="button" href="<= BASE_URL ?>welcome-ccmps/manage/mamm/2">Close</a> -->
                                      </div>
                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>
<br>
<br>
                                        
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Highest Certificate</strong></label>
                                                    <div class="col-sm-5"><?= $highest_certificate ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>HC Cert #</strong></label>
                                                    <div class="col-sm-5"><?= $certificate_number ?></div> 
                                                </div>                                               
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Total Time</strong> </label>
                                                    <div class="col-sm-5"><?= $total_time ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>VIP</strong> </label>
                                                    <div class="col-sm-5"><?= $vip ?></div> 
                                                </div>

                                                <div class="ibox-content">
                                                    <center><strong>Other Certificates & Certifications</strong></center>
                                                    <br>                                                                                             
                        
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Other Crewmember</strong> </label>
                                                        <div class="col-sm-5"><?= $other_crewmember ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>OC Cert #</strong> </label>
                                                        <div class="col-sm-5"><?= $ocm_certnum ?></div> 
                                                    </div>

                                                    <div class="form-group row"><label class="col-lg-3 "><strong>A&P</strong> </label>
                                                        <div class="col-sm-5"><?= $ap ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>A&P #</strong> </label>
                                                        <div class="col-sm-5"><?= $ap_number ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>IA</strong> </label>
                                                        <div class="col-sm-5"><?= $ia ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Military A&P</strong> </label>
                                                        <div class="col-sm-5"><?= $military_maint ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Maintenance</strong> </label>
                                                        <div class="col-sm-5"><?= $maintenance ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Air Traffic Cont</strong> </label>
                                                        <div class="col-sm-5"><?= $atc ?></div> 
                                                    </div>                                                                  
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Dispatcher</strong> </label>
                                                        <div class="col-sm-5"><?= $dispatcher ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Other FAA Cert</strong> </label>
                                                        <div class="col-sm-5"><?= $other_faa_cert ?></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Other FAA Cert #</strong> </label>
                                                        <div class="col-sm-5"><?= $ofc_certnum ?></div> 
                                                    </div>      
                                                </div>  <!-- ibox-content -->

                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                <br>
                                          <br>
                                          <br>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Hall of Fame</strong></label>
                                                    <div class="col-sm-5"><?= $hall_of_fame ?></div> 
                                                </div>                                              
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Active Duty</strong> </label>
                                                    <div class="col-sm-5"><?= $active_duty ?></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Former Military</strong> </label>
                                                    <div class="col-sm-5"><?= $former_military ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 "><strong>Military Pilot</strong> </label>
                                                    <div class="col-sm-5"><?= $military_pilot ?></div> 
                                                </div>

                                                <div class="ibox-content">
                                                    <center><strong>Ratings</strong></center>
                                                    <br>

                                                    <div class="form-group row"><label class="col-lg-3 "><strong>SE Land</strong> </label>
                                                        <div class="col-sm-5"><?= $se_land ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>ME Land</strong> </label>
                                                        <div class="col-sm-5"><?= $me_land ?></div> 
                                                    </div>                                      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>SE Sea</strong> </label>
                                                        <div class="col-sm-5"><?= $se_sea ?></div> 
                                                    </div>  
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>ME Sea</strong> </label>
                                                        <div class="col-sm-5"><?= $me_sea ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Instrument</strong> </label>
                                                        <div class="col-sm-5"><?= $instrument ?></div> 
                                                    </div>                                                      
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>CFI</strong> </label>
                                                        <div class="col-sm-5"><?= $cfi ?></div> 
                                                    </div>                                        
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>CFII</strong> </label>
                                                        <div class="col-sm-5"><?= $cfii ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>MEI</strong> </label>
                                                        <div class="col-sm-5"><?= $mei ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>DPE</strong> </label>
                                                        <div class="col-sm-5"><?= $dpe ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>BGI</strong> </label>
                                                        <div class="col-sm-5"><?= $bgi ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>AGI</strong> </label>
                                                        <div class="col-sm-5"><?= $agi ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Rotocraft</strong> </label>
                                                        <div class="col-sm-5"><?= $rotocraft ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Glider</strong> </label>
                                                        <div class="col-sm-5"><?= $glider ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Balloon</strong> </label>
                                                        <div class="col-sm-5"><?= $balloon ?></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 "><strong>Airship</strong> </label>
                                                        <div class="col-sm-5"><?= $airship ?></div> 
                                                    </div> 
                                              <div class="form-group row"><label class="col-lg-3 "><strong>Drone</strong> </label>
                            <div class="col-sm-5"><?= $drone ?></div> 
                                              </div> 
                                            </div> <!-- ibox-content -->
                                                          
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                    
                                        <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Credential Notes</strong></label>
                                            <div class="col-sm-12"> <span class="form-text m-b-none"><?= $cred_notes ?></span>
                                            </div>
                                        </div>

                                    <?php endif; ?> <!--  End Viewing Tab 2  -->

                                    </div> <!-- end ibox -->

                              


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq3" class="faq-question">Financial Account</a>
                             <!--       <small>Added by <strong>Monica Rother</strong> <i class="fa fa-clock-o"></i> Yestorday 7:60 pm - 12.06.2014</small> -->
                                </div>
                                 <!--    <div class="col-md-3">
                                    <span class="small font-bold">Robert Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    42
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['tab'] == 3): ?>
                                        <div id="faq3" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq3" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                <div class="ibox-content"> 
                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!--<php if($_SESSION['tab'] == 3): ?> -->

                                  <!--      <form  method = "post" action="<= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 





                                           
                                    <div class="row"> 
                                        <div class="col-md-6">
                                    <br>

                                            <div class="form-group row"><label class="col-lg-3 ">Financial Acct Id </label>
                          <div class="col-sm-5"><?= $fin_id ?></div> 
                                            </div> 

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Account Type</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="fin_acct_type" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($accttypes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $fin_acct_type): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->acct_type_title ?> [<?= $row->description ?>]</option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end acct_type -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Billing Email</strong></label> 
                                        <div class="col-sm-8"><input name="fin_email" type="text" class="form-control w-b" placeholder="defaults to contact email if left blank" value="<?= $fin_email ?>" ></div>
                                      </div>
 <br>
                    <div class="ibox-content">
                        <center><strong>Billing Address</strong></center>
                        <br>
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill To Name</strong></label> 
                                        <div class="col-sm-8"><input name="billname" type="text" class="form-control" placeholder="defaults to contact name if left blank" value="<?= $billname ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill To Phone</strong></label> 
                                        <div class="col-sm-8"><input name="billphone" type="text" class="form-control" placeholder="defaults to contact phone if left blank" value="<?= $billphone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Address1</strong></label> 
                                        <div class="col-sm-8"><input name="billaddress1" type="text" class="form-control" value="<?= $billaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Address2</strong></label> 
                                        <div class="col-sm-8"><input name="billaddress2" type="text" class="form-control" value="<?= $billaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill City</strong></label> 
                                        <div class="col-sm-8"><input name="billcity" type="text" class="form-control" value="<?= $billcity ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill State</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="billstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $billstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Bill Zip</strong></label> 
                                        <div class="col-sm-2"><input name="billzip" type="text" class="form-control" value="<?= $billzip ?>" ></div>
                                          </div> 
   </div> 

                                        </div> <!-- end col-6 -->
                                        <div class="col-md-6">
                                          <br>                                        
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Balance</strong></label> 
                                        <div class="col-sm-2"><input name="acct_bal" type="text" class="form-control" value="<?= $acct_bal ?>" ></div>
                                        </div>                                         

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Status</strong></label> 
                                        <div class="col-sm-6"><select type="text" class="form-control m-b" name="fin_status" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($finstatuses as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $fin_status): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->fin_status_title ?> [<?= $row->description ?> ]</option>
                                            <?php endif; ?>

                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end fin_status -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Inactive</strong></label>
                                          <div class="col-sm-2"><select class="form-control m-b" name="fin_inactive" Value="<?= $fin_inactive ?>" >
                                            <?php if($fin_inactive == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>  

 

                        <div class="ibox-content">
                        <center><strong>Shipping Address</strong></center>
                        <br> 

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Same as Billing?</strong></label>
                                          <div class="col-sm-2"><select class="form-control" name="fin_billship" Value="<?= $fin_billship ?>" >
                                            <?php if($fin_billship == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div>                          
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship To Name</strong></label> 
                                        <div class="col-sm-8"><input name="shipname" type="text" class="form-control" value="<?= $shipname ?>" placeholder="defaults to contact name if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship To Phone</strong></label> 
                                        <div class="col-sm-8"><input name="shipphone" type="text" class="form-control" value="<?= $shipphone ?>" placeholder="defaults to contact phone if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Address1</strong></label> 
                                        <div class="col-sm-8"><input name="shipaddress1" type="text" class="form-control" value="<?= $shipaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Address2</strong></label> 
                                        <div class="col-sm-8"><input name="shipaddress2" type="text" class="form-control" value="<?= $shipaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship City</strong></label> 
                                        <div class="col-sm-8"><input name="shipcity" type="text" class="form-control" value="<?= $shipcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship State</strong></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="shipstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $shipstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                                        <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Ship Zip</strong></label> 
                                        <div class="col-sm-2"><input name="shipzip" type="text" class="form-control" value="<?= $shipzip ?>" ></div>
                                        </div>  


                                          </div>   
                                        </div> <!-- end 2nd column -->
                                    </div> <!-- end row -->
                                
                                <div class="form-group row"><label class="col-sm-2 col-form-label"><strong>Financial Acct Notes</strong></label>
                                    <div class="col-sm-12"><input name="fin_notes" type="text" class="form-control" value="<?= $fin_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>




                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/3">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
                                  <!--      </form> continuous form -->

 <!-- <php endif; ?> --> <!-- End if($_SESSION['tab'] == 3) -->

                    <?php else: ?>  <!-- viewing Tab 3 -->                                                           
                                        <div class="row"> 
                                            <div class="col-md-6">

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                 <!--     <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/3">Close</a> -->
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                 <!--     <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/3">Close</a> -->
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/3" >Update</a>
                                  <!--    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/3">Close</a> -->
                                      </div>
                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>                                          
                                                <br>
                                    <br>

                                                <div class="form-group row"><label class="col-lg-3 ">Financial Acct Id</label>
                                                    <div class="col-sm-5"><?= $fin_id ?></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-3 ">Acct Type </label>
                                                    <div class="col-sm-5"><?= $fin_acct_type ?></div> 
                                                </div>                   
                                                <div class="form-group row"><label class="col-lg-3 ">Billing Email</label> 
                                                    <div class="col-sm-5"><?= $fin_email ?></div> 
                                                </div>
                                                                 
                                                <div class="form-group row"><label class="col-lg-3 ">Bill To = Ship To</label> 
                                                    <div class="col-sm-5"><?= $fin_billship ?></div> 
                                                </div>
                                        <div class="ibox-content">
                                                <center><strong>Billing Address</strong></center>
                                                <br>
                                                    <div class="form-group row"><label class="col-lg-4 ">Bill To</label> 
                                                        <div class="col-sm-5"><?= $billname ?></div> 
                                                    </div>

                                                    <div class="form-group row"><label class="col-lg-4 ">Bill Phone</label> 
                                                        <div class="col-sm-5"><?= $billphone ?></div> 
                                                    </div>                                                                                              
                                                    <div class="form-group row"><label class="col-lg-4 ">Address 1</label> 
                                                        <div class="col-sm-5"><?= $billaddress1 ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">Address 2</label> 
                                                        <div class="col-sm-5"><?= $billaddress2 ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">City</label> 
                                                        <div class="col-sm-5"><?= $billcity ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">State</label> 
                                                        <div class="col-sm-5"><?= $billstate ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">Zipcode</label> 
                                                        <div class="col-sm-5"><?= $billzip ?></div> 
                                                    </div>
                                                </div> 


                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                <br>
                                          <br>
                                          <br>                                          
                                                <div class="form-group row"><label class="col-lg-4 ">Balance</label> 
                                                    <div class="col-sm-5"><?= $acct_bal ?></div> 
                                                </div>                                              

                                                <div class="form-group row"><label class="col-lg-4 ">Status</label> 
                                                    <div class="col-sm-5"><?= $fin_status ?></div> 
                                                </div>

                                                <div class="form-group row"><label class="col-lg-4 ">Inactive</label>

                                                    <?php if( $fin_inactive  > 0) { ?>
                                                        <div class="col-sm-5">Yes</div>
                                                    <?php }else{ ?>

                                                        <div class="col-sm-5">No</div>
                                                    <?php } ?>                                 
                                                </div>  

                                                <div class="form-group row"><label class="col-lg-3 ">.</label> 
                                                    <div class="col-sm-5"></div> 
                                                </div>

                                                <div class="ibox-content">
                                                <center><strong>Shipping Address</strong></center>
                                                <br>                                                    
                                                    <div class="form-group row"><label class="col-lg-4 ">Ship To</label> 
                                                        <div class="col-sm-5"><?= $shipname ?></div> 
                                                    </div>

                                                    <div class="form-group row"><label class="col-lg-4 ">Ship Phone</label> 
                                                        <div class="col-sm-5"><?= $shipphone ?></div> 
                                                    </div>                                              
                                                    <div class="form-group row"><label class="col-lg-4 ">Address 1</label> 
                                                        <div class="col-sm-5"><?= $shipaddress1 ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">Address 2</label> 
                                                        <div class="col-sm-5"><?= $shipaddress2 ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">City</label> 
                                                        <div class="col-sm-5"><?= $shipcity ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">State</label> 
                                                        <div class="col-sm-5"><?= $shipstate ?></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-4 ">Zipcode</label> 
                                                        <div class="col-sm-5"><?= $shipzip ?></div> 
                                                    </div>
                                                </div>                                                           
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                    
                                        <div class="form-group row"><label class="col-sm-2 col-form-label">Financial Account Notes</label>
                                            <div class="col-sm-12"> <span class="form-text m-b-none"><?= $fin_notes ?></span>
                                            </div>
                                        </div>

                                    <?php endif; ?> <!--  End Viewing Tab 3  -->
                                    </div> <!-- end ibox -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq4" class="faq-question">User Account</a>
                            <!--        <small>Added by <strong>Janet North</strong> <i class="fa fa-clock-o"></i> Today 2:43 pm - 22.06.2014</small> -->
                                </div>
                             <!--    <div class="col-md-3">
                                    <span class="small font-bold">Robert Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    42
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['tab'] == 4): ?>
                                        <div id="faq4" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq4" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                <div class="ibox-content"> 
                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  --> 

<!-- <php if($_SESSION['tab'] == 4): ?> -->

                                <!--        <form  method = "post" action="<= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                         
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 

                                       <br>
                                             <h3>User Account Credentials</h3>
                                             <br>
                                    <div class="row"> 
                                        <div class="col-md-5">
 
                                            <div class="form-group row"><label class="col-lg-3 ">User Id</label> 
                          <div class="col-sm-5"><?= $trongate_user_id ?></div> 
                                            </div>

                                            <div class="form-group row"><label class="col-lg-3 ">Username </label>
                          <div class="col-sm-5"><?= $username ?></div> 
                                            </div>                       
                                            <div class="form-group row"><label class="col-lg-3 ">Level</label>
                          <div class="col-sm-5"><?= $tguserlevelname ?></div> 
                                            </div>
<br>

                                            <h3>Account Status</h3>
                                            <br>
                                          <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Login Locked</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="locked" Value="<?= $locked ?>" >
                                                <?php if($locked == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Login Inactive</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="inactive" Value="<?= $inactive ?>" >
                                                <?php if($inactive == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                                  
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label"><strong>Force PW Change</strong></label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="force_pw_chg" Value="<?= $force_pw_chg ?>" >
                                                <?php if($force_pw_chg == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>



                                        </div> <!-- end col-6 -->
                                        <div class="col-md-4">
                                          <br>


<br>
<br>
<br>
<br>
<br>

    

                                        </div> <!-- end 2nd column -->

                                    </div> <!-- end row -->

                                    <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                      <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' ): ?>
                                      <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                      <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/4">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
                            </form>  <!-- end of continuous form-->

<!-- <php endif; ?> --><!-- End if($_SESSION['tab'] == 4) -->

                                        <?php else: ?>  <!-- viewing Tab 4-->
                                <!--    <div class="row"> 
                                        <div class="col-md-6"> -->

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'momv'): ?>
                              <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >Update</a>
                               <!--       <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/4">Close</a> -->
                                      <?php if($locked > 0): ?> 
                                            <a class="btn btn-outline btn-primary" type="button" href="<?= BASE_URL ?>welcome-ccmps/unlockacct/<?= $recid ?>/v">Unlock</a>
                                      <?php else: ?>                                
                                            <a class="btn btn-outline btn-danger" type="button" href="<?= BASE_URL ?>welcome-ccmps/lockacct/<?= $recid ?>/v">Lock</a>
                                      <?php endif; ?> 
                                    
                                        <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
                                        <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
                                        <?php endif; ?>
                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>
                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >Update</a>
                               <!--       <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/4">Close</a> -->
                                    <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-danger" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
                                    <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
                                    <?php endif; ?>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>
                                <div>
                                      <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/4" >xUpdate</a>
                                      <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/4">xClose</a>
                                <?php if($trongate_user_id > 0): ?>
              <!--   <a class="btn btn-success btn-outline btn-bitbucket" data-toggle="modal" data-target="#myModal3">Reset</a> -->
            <a class="btn btn-outline btn-warning" data-toggle="modal" data-target="#myModal2">Reset Password</a> 
              </div>                      
                                <?php else: ?>  
                       <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/createccmpuseraccount/<?= $recid ?>">Create User Account</a>   </div>
                                <?php endif; ?>

                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>                                          
                                    <br>
                                    <br>
                                                               <h3>User Account Credentials</h3>
                                                               <br>
                                        <div class="row"> 
                                            <div class="col-md-5">

                                            <div class="form-group row"><label class="col-lg-3 ">User Id</label> 
                          <div class="col-sm-5"><?= $trongate_user_id ?></div> 
                                            </div>

                                                <div class="form-group row"><label class="col-lg-3 ">Username</label>
                                                    <div class="col-sm-5"><?= $username ?></div> 
                                                </div>                         
                                                <div class="form-group row"><label class="col-lg-3 ">Level</label>
                                                    <div class="col-sm-5"><?= $tguserlevelname ?></div> 
                                                </div>
<br>

                                                <h3>Account Status</h3>
                                                <br>
                                                <div class="form-group row"><label class="col-lg-3 ">Login Locked</label>

                                                    <?php if( $locked  > 0) { ?>
                                                        <div class="col-sm-5">Yes</div>
                                                    <?php }else{ ?>

                                                        <div class="col-sm-5">No</div>
                                                    <?php } ?>                                 
                                                </div>  

                                                <div class="form-group row"><label class="col-lg-3 ">Login Inactive</label>

                                                    <?php if( $inactive  > 0) { ?>
                                                        <div class="col-sm-5">Yes</div>
                                                    <?php }else{ ?>

                                                        <div class="col-sm-5">No</div>
                                                    <?php } ?>                                 
                                                </div>  

                        <div class="form-group row"><label class="col-lg-3 ">Force PW Change</label>                                      
                          <?php if( $force_pw_chg   > 0) { ?>
                            <div class="col-sm-5">Yes</div>
                          <?php }else{ ?>

                            <div class="col-sm-5">No</div>
                          <?php } ?>  
                        </div>                        
                                                <div class="form-group row"><label class="col-lg-3 ">IP Address</label> 
                                                    <div class="col-sm-5"><?= $ip_address ?></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-3 ">Token Expires</label> 
                                                    <div class="col-sm-5"><?= $token_expires ?></div> 
                                                </div>
                                        <div class="form-group row"><label class="col-lg-3 ">Reset Code</label> 
                          <div class="col-sm-5"><?= $reset_code ?></div> 
                                          </div>                                       
                                <!--        <div class="form-group row"><label class="col-lg-3 "><strong>Activate Code</strong></label> 
                          <div class="col-sm-5"><?= $activate_code ?></div> 
                                          </div> -->




                        <div class="form-group row"><label class="col-lg-3 ">Timed PW Reset</label>                                       
                          <?php if( $timed_reset   > 0) { ?>
                            <div class="col-sm-5">Yes</div>
                          <?php }else{ ?>

                            <div class="col-sm-5">No</div>
                          <?php } ?>  
                        </div>

                                          <div class="form-group row"><label class="col-lg-3 ">Reset Interval (days)</label> 
                          <div class="col-sm-5"><?= $reset_interval ?></div> 
                                          </div>  

                                                <br>
                                                <h3>Account Activity</h3>
                                                <br>

                                                <div class="form-group row"><label class="col-lg-2 ">No Logins</label> 
                                                    <div class="col-sm-5"><?= $num_logins ?></div> 
                                                </div>                                        
                                                <div class="form-group row"><label class="col-lg-2 ">Last Login Device</label> 
                                                    <div class="col-sm-5"><?= $last_login_device ?></div> 
                                                </div> 
                                                <div class="form-group row"><label class="col-lg-2 ">Last Login</label> 
                                                    <div class="col-sm-5"><?= $last_login ?></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-2 ">Last Logout</label> 
                                                    <div class="col-sm-5"><?= $last_logout ?></div> 
                                                </div>



                                            </div> <!-- end col-6 -->
                                            <div class="col-md-4">

                                                <br>


<br>
<br>
<br>
<br>
<br>




                                  
                                                    
                                                                        


                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

        <?php endif; ?> <!--  End Viewing Tab 4  -->    

                                    </div> <!-- end ibox -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<br>
<a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm/1">Done</a>


  <!-- future sections        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq5" class="faq-question">The standard chunk of Lorem Ipsum used since ?</a>
                                    <small>Added by <strong>Robert Task</strong> <i class="fa fa-clock-o"></i> Today 1:23 pm - 12.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Sandra Smith</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    76
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq5" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                content here (get rid of <p> tag)

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq6" class="faq-question">Contrary to popular belief, Lorem Ipsum ?</a>
                                    <small>Added by <strong>Monica Smith</strong> <i class="fa fa-clock-o"></i> Today 7:220 pm - 13.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Robert Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">Love</span>
                                        <span class="tag-item">CC</span>
                                        <span class="tag-item">Help</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    11
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq6" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                content here (get rid of <p> tag)
                                                    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq7" class="faq-question"> Many desktop publishing packages ? </a>
                                    <small>Added by <strong>Damien Sate</strong> <i class="fa fa-clock-o"></i> Yestorday 4:50 pm - 8.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Alex Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">International</span>
                                        <span class="tag-item">What</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    64
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq7" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                content here (get rid of <p> tag)
                                                    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq8" class="faq-question">Lorem Ipsum, you need to be sure there isn't ?</a>
                                    <small>Added by <strong>Pablo Sarnoq</strong> <i class="fa fa-clock-o"></i> Today 1:30 am - 1.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Natalie Cole</span>
                                    <div class="tag-list">
                                        <span class="tag-item">Translations</span>
                                        <span class="tag-item">CC</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    10
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq8" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                content here (get rid of <p> tag)
                                                    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq9" class="faq-question">There are many variations of passages ?</a>
                                    <small>Added by <strong>Monica Smith</strong> <i class="fa fa-clock-o"></i> Today 1:60 pm - 11.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Alex Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    23
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq9" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                content here (get rid of <p> tag)
                                                    
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> last section -->






                    </div> <!-- ibox small border bottom -->
                </div>
         
<!--        <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
            </div>
        </div> -->

  