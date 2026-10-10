                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq2" class="faq-question" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Credentials</h<?= $_SESSION['fontsize'] ?>></a>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['crudtab'] == 2): ?>
                                        <div id="faq2" class="panel-collapse">
                                    <?php else: ?>
                                        <div id="faq2" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                        <div class="faq-answer">
                                    <div class="ibox-content">
                    
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' || $_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu' || $_SESSION['ccmpmode'] == 'mosc' || $_SESSION['ccmpmode'] == 'mosu' || $_SESSION['ccmpmode'] == 'mcmc' || $_SESSION['ccmpmode'] == 'mcmu' || $_SESSION['ccmpmode'] == 'mamc' || $_SESSION['ccmpmode'] == 'mamu'): ?> <!-- Updating or creating  -->     

<!-- <php if($_SESSION['crudtab'] == 2): ?>  -->

                                   <!--     <form  method = "post" action="<= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> -->
                      
                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"></i><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 

                                    <div class="row"> 
                                        <div class="col-md-6">
                                    
                                    <br>
<!--  Begin Update/Create Tab 2 -->

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Highest Cert<a style="color:Red;">*</a></h<?= $_SESSION['fontsize'] ?>></label>
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
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Certificate No</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="certificate_number" type="text" class="form-control" value="<?= $certificate_number ?>" ></div>
                                        </div>                                               
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uTotal Time</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-2"><input name="total_time" type="text" class="form-control" value="<?= $total_time ?>" ></div>
                                        </div>
<br>
<br>
<br>
<br>                                                <div class="ibox-content">


                          <center><strong>Ratings</strong></center>
                          <br>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>SE Land</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>ME Land</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>SE Sea</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>ME Sea</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Instrument</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>CFI</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>CFII</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>MEI</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>DPE</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>BGI</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>AGI</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Rotocraft</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Glider</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Balloon</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Airship</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Drone</h<?= $_SESSION['fontsize'] ?>></label>
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
                                                
                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><h<?= $_SESSION['fontsize'] ?>><strong>Hall of Fame</strong></h<?= $_SESSION['fontsize'] ?>></label>

                                             <div class="col-sm-8"><input name="hall_of_fame" type="text" class="form-control" value="<?= $hall_of_fame ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                         <?php else: ?>                                                
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Hall of Fame</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <?php endif; ?> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Active Duty</h<?= $_SESSION['fontsize'] ?>></label>
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
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Former Military</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Military Pilot</h<?= $_SESSION['fontsize'] ?>></label>
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
                          
                             
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>uOther Crewmember</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="other_crewmember" type="text" class="form-control" value="<?= $other_crewmember ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other Crew Cert #</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="ocm_certnum" type="text" class="form-control" value="<?= $ocm_certnum ?>" ></div>
                                        </div> 

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P</h<?= $_SESSION['fontsize'] ?>></label>
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

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P #</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="ap_number" type="text" class="form-control" value="<?= $ap_number ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>IA</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Military A&P</h<?= $_SESSION['fontsize'] ?>></label>
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

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Maintenance</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>ATC</h<?= $_SESSION['fontsize'] ?>></label>
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Dispatcher</h<?= $_SESSION['fontsize'] ?>></label>
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
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="other_faa_cert" type="text" class="form-control" value="<?= $other_faa_cert ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert #</h<?= $_SESSION['fontsize'] ?>></label>
                                            <div class="col-sm-8"><input name="ofc_certnum" type="text" class="form-control" value="<?= $ofc_certnum ?>" ></div>
                                        </div>    
                                        
                                            </div> <!-- ibox-content -->

                                        <?php if($_SESSION['ccmpmode'] == 'mmdu'): ?>
                                        <!-- How to handle not updatable but still pass current value to the save   -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label" hidden><strong></strong></label>

                                             <div class="col-sm-8"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>" hidden></div>
                                        </div>
                                        <!-- END --How to handle not updatable by still pass current value to the save   -->
                                        <?php else: ?>                                 

                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Credential Notes</h<?= $_SESSION['fontsize'] ?>></label>
                                                <div class="col-sm-12"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>"> <span class="form-text m-b-none"></span>
                                                </div>
                                            </div>
                                        <?php endif; ?> 

                                    <?php if($_SESSION['ccmpmode'] == 'mmdc' || $_SESSION['ccmpmode'] == 'mmdu' ): ?> <!-- there is no mmdc - users cant create their own records   -->
                                        <div>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'momu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mosu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a> 
                                        </div>
                                    
                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmc'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmu'): ?>
                                        <div> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>                                        

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamc'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamu'): ?>
                                        <div>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-save"></i> Save Changes</h<?= $_SESSION['fontsize'] ?>></button>
                                        
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/viewccmp/<?= $recid ?>/2"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Cancel</h<?= $_SESSION['fontsize'] ?>></a>
                                        </div>

                                    <?php else: ?> 

                                    <?php endif; ?> 

                                                          
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                    



<!--  End Update create tab 2 -->


                                   <!--     </form>  continuous form  -->


<!-- <php endif; ?> --><!-- End if($_SESSION['crudtab'] == 2) -->

                            <?php else: ?>  <!-- viewing Tab 2-->

                                        <div class="row"> 
                                            <div class="col-md-6">
                                                

                              <div class="btn-group">

                           <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
                              <div>

                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2/umd" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                <a class="btn btn-outline btn-warning"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/ccmphome" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-home"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'momv'): ?> 
                            <div>

                                <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Exit</h<?= $_SESSION['fontsize'] ?>></a>
                            </div>

                            <?php elseif($_SESSION['ccmpmode'] == 'mosv'): ?> 
                                    <div>

                                    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/1" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i><h<?= $_SESSION['fontsize'] ?>> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mosm"><h<?= $_SESSION['fontsize'] ?>><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
                                    </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mcmv'): ?> 
                            <div>

                                      <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"></i> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
                
                                      </div>

                          <?php elseif($_SESSION['ccmpmode'] == 'mamv'): ?>

                                <div>
                                    <a class="btn btn-outline btn-primary"  type="button"  href="<?= BASE_URL ?>welcome-ccmps/updateccmp/<?= $recid ?>/2" ></i><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-pencil"> Update</h<?= $_SESSION['fontsize'] ?>></a>
                                    <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm/1"><h<?= $_SESSION['fontsize'] ?>><i class="fa fa-times-circle"></i> Home</h<?= $_SESSION['fontsize'] ?>></a>
                                      </div>
                                    
                          <?php else: ?> 

                          <?php endif; ?> 

                        </div>
                          
<br>
<br>
                            <?php if($_SESSION['fontsize'] == 1 || $_SESSION['fontsize'] == 2 ): ?> <!-- view   -->
                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Highest Certificate</h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $highest_certificate ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>
                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>HC Cert #</h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $certificate_number ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>                                               
                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Total Time </h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $total_time ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>
                                    <?php if($_SESSION['fontsize'] == 1): ?>
                                    <br>
                                    <br>
                                     <?php else: ?>
                                    
                                     <?php endif; ?> 
                          <?php else: ?> 
                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Highest Certificate</h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $highest_certificate ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>
                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>HC Cert #</h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $certificate_number ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>                                               
                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Total Time </h<?= $_SESSION['fontsize'] ?>></label>
                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $total_time ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                    </div>
                          <?php endif; ?> 
                                        

<br>
<br>

                                                <div class="ibox-content">  <!-- viewing  -->
                                                    <center style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><strong>Other Certificates & Certifications</strong></h<?= $_SESSION['fontsize'] ?>></center>
                                                    <br>                                                                                             
                                                <?php if($_SESSION['fontsize'] == 1  || $_SESSION['fontsize'] == 2) { ?>
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other Crewmember </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $other_crewmember ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>OC Cert # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ocm_certnum ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>

                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ap ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ap_number ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>IA </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ia ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Military A&P </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $military_maint ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Maintenance </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $maintenance ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Air Traffic Cont </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $atc ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                                                  
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Dispatcher </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $dispatcher ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $other_faa_cert ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-5 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ofc_certnum ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                           
                                                <?php }else{ ?>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other Crewmember </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $other_crewmember ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>OC Cert # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ocm_certnum ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>

                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ap ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>A&P # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ap_number ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>IA </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ia ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Military A&P </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $military_maint ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Maintenance </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $maintenance ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Air Traffic Cont </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $atc ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                                                  
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Dispatcher </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $dispatcher ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $other_faa_cert ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Other FAA Cert # </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $ofc_certnum ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                              
                                                <?php } ?>                         
      
                                                </div>  <!-- ibox-content -->

                                            </div> <!-- end col-6 -->
                                            <div class="col-md-6">
                                                <br>
                                          <br>
                                          <br>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Hall of Fame </h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $hall_of_fame ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>                                              
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Active Duty </h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $active_duty ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>  
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Former Military </h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $former_military ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>
                                                <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Military Pilot </h<?= $_SESSION['fontsize'] ?>></label>
                                                    <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $military_pilot ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                </div>

                                                <div class="ibox-content">
                                                    <center style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><strong>Ratings</strong></h<?= $_SESSION['fontsize'] ?>></center>
                                                    <br>

                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>SE Land </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $se_land ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>ME Land </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $me_land ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>SE Sea </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $se_sea ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>  
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>ME Sea </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $me_sea ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Instrument </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $instrument ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                                      
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>CFI </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $cfi ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div>                                        
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>CFII </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $cfii ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>MEI </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $mei ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>DPE </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $dpe ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>BGI </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $bgi ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>AGI </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $agi ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Rotocraft </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $rotocraft ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Glider </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $glider ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Balloon </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $balloon ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                                    <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Airship </h<?= $_SESSION['fontsize'] ?>></label>
                                                        <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $airship ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                                    </div> 
                                              <div class="form-group row"><label class="col-lg-3 " style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>>Drone </h<?= $_SESSION['fontsize'] ?>></label>
                            <div class="col-sm-5"><h<?= $_SESSION['fontsize'] ?>><?= $drone ?></h<?= $_SESSION['fontsize'] ?>></div> 
                                              </div> 
                                            </div> <!-- ibox-content -->
                                                          
                                            </div> <!-- end 2nd column -->

                                        </div> <!-- end row -->

                                        <?php if($_SESSION['ccmpmode'] == 'mmdv'): ?>
                                            <br>
                                        <?php else: ?> 
                                            <div class="form-group row"><label class="col-sm-2 col-form-label" style="color:RoyalBlue;"><h<?= $_SESSION['fontsize'] ?>><strong>Credential Notes</strong></h<?= $_SESSION['fontsize'] ?>></label>
                                                <div class="col-sm-12"> <span class="form-text m-b-none"><h<?= $_SESSION['fontsize'] ?>><?= $cred_notes ?></h<?= $_SESSION['fontsize'] ?>></span>
                                                </div>
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> <!--  End Viewing Tab 2  -->

                                    </div> <!-- end ibox -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- two includes were here -->

                      <!--   If this is the last tab then need two divs to ensure col-lg-12 line 9 is the last div -->
                        <!--    </div> 
                            </div> -->