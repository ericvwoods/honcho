  <?php 

  switch($_SESSION['ccmpmode']) {

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

<!--



<!-- Begin Content   -->
    <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

  <div class="ibox-content">
         <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">

            <div class="row"> 

                        <div class="col-md-1">   
                           <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> 
                        <!--    <img alt="user picture" class="rounded-circle" src="<= BASE_URL?>honcho-system_accounts_module/assets/user_pictures/<?= $picture ?>"/>  original location--> 
                        </div> <!-- end col -->
          

                <div class="col-md-9">
                   

                    <?php if($recid > 0) { ?>   <!-- Updating  -->

                                 <span class="break"><h2><strong>Updating <?= $salutation ?> <?= $first_name ?> <?= $last_name ?></strong></h2></span>                                    
                         <p><h2><?= $chapternm ?></h2></p>

                    <?php }else{ ?> 

                                <span class="break"><h2><strong>New <?= CCMP ?> Application </strong></h2></span>  <!-- Adding New Account -->                                   
                           <h2><?= SITENAME ?></h2>
                    <?php } ?> 

                </div> <!-- end column -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                         <!--   <php if(strlen($picture) > 0): ?> -->
                                <div class="col-md-2">   
                                    <h1 class="logo text-center">
                                        <a href="index.html" title="Boss - Multipurpose Premium Html5 Template">
                                         <!--   <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> -->
                                        </a>
                                    </h1>
                                </div> <!-- end col -->
                        <!--    <php endif; ?> -->

                        </li>
                    </ul>
            </div> <!-- end row -->






   
                           
                            <div class="ibox-tools">
                             
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!-- Show flash message then reset it to blank  -->
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

<!-- <php if() { ?>  must use php and not shorthand = when using IF or wont work. = works everywhere else when just returning a value  -->
<!-- Also question marks are still read during execution if followed by php even when commented out and will stop rendering of the page -->                              
                                <br>
               
                           <strong> <?= validation_errors() ?></strong>

                            <h3>Contact Information</h3>
                            <a style="color:Red;">*</a> = required
                        <!--    <form  method = "post" action="<?= BASE_URL ?>honcho/index/system_accounts/submit/<?= $id ?>/<?= $frmpg ?>"> -->










                                <form  method = "post" action="<?= BASE_URL ?>welcome-ccmps/ccmpsubmit/<?= $recid ?>/<?= $frmpg ?>/<?= $mcma ?>"> <!-- frmpg passed to form and passed back in Post below-->

                                <!--   --> 
                        <!--    <form  method = "post" action="/submit/<?= $id ?>/<?= $frmpg ?>"> -->
                        <!--    <form  method = "post" action="<?= current_url(); ?>submit/<?= $id ?>/<?= $frmpg ?>"> -->
                            <!--    <form  method = "post" action="<?=__DIR__?>/../../submit/<?= $id ?>/<?= $frmpg ?>"> -->
                                <div class="row"> 

                                    <div class="col-md-6">
<!-- <php if($action3_r > 0): ?>   --> 
                                            <!-- For debugging  -->
                                  <!--       <div class="form-group  row"><label class="col-sm-2 col-form-label">DB Rec Id</label>

                                             <div class="col-sm-10"><input name="id" type="text" class="form-control" value="<?= $id ?>" ></div>
                                        </div>       -->                             


<!-- <php endif; ?> -->

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Prefix</label>

                                            <div class="col-sm-2"><input name="salutation" type="text" class="form-control" value="<?= $salutation ?>" ></div>
                                        </div>

                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">First<a style="color:Red;">*</a></label>

                                             <div class="col-sm-8"><input name="first_name" type="text" class="form-control" value="<?= $first_name ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Middle</label>

                                            <div class="col-sm-8"><input name="middle_name" type="text" class="form-control" value="<?= $middle_name ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Last<a style="color:Red;">*</a></label>

                                            <div class="col-sm-8"><input name="last_name" type="text" class="form-control" value="<?= $last_name ?>" > </div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Suffix</label>

                                            <div class="col-sm-8"><input name="suffix" type="text" class="form-control" value="<?=$suffix ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Call Sign</label>

                                            <div class="col-sm-8"><input name="call_sign" type="text" class="form-control" value="<?= $call_sign ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Gender<a style="color:Red;">*</a></label>
                                        <div class="col-sm-3"><select class="form-control m-b" name="gender" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($genders as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $gender): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>                                        


                                   <!--     <div class="form-group  row"><label class="col-sm-2 col-form-label">Gender</label>

                                            <div class="col-sm-10"><input name="gender" type="text" class="form-control" value="<?= $gender ?>" ></div>
                                        </div> -->

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Birthday</label>

                                            <div class="col-sm-4"><input name="birthday" type="text" class="form-control" value="<?= $birthday ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phone</label>

                                            <div class="col-sm-8"><input name="phone" type="text" class="form-control" value="<?= $phone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile</label>

                                            <div class="col-sm-8"><input name="mobile" type="text" class="form-control" value="<?= $mobile ?>" ></div>
                                        </div> 
                                                                                 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Fax</label>

                                            <div class="col-sm-8"><input name="fax" type="text" class="form-control" value="<?= $fax ?>" ></div>
                                        </div>

 <?php if($_SESSION['ccmpmode'] == 'momc' || $_SESSION['ccmpmode'] == 'momu'):  ?>
 <?php else: ?>  
                                  <?php if($recid > 0):  ?>   <!-- Updating  - If new the chapter is assigned to the same one as the chapter admin -->

     <!-- Treasurer/sysadmin can assign chapter to a new member including Chapter at Large  -->
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter<a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                      


                                    <?php else: ?> <!-- Adding/Creating  -->
                                     
                                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter<a style="color:Red;">*</a></label>
                                                    <div class="col-sm-8"><select class="form-control m-b" name="chapter" >
                                                    <!-- Loop through the dropdown array passed in $data  -->
                                                    <?php foreach($chapters as $row) { ?>
                                                    <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                                        <?php if($row->id == $chapter): ?> 
                                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php else: ?> <!-- otherwise just create the option -->
                                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->chapter_title ?>]</option>
                                                        <?php endif; ?>
                                                     <?php } ?>                                    
                                                     </select>
                                                    </div>
                                                    </div>
                                         
                                   <?php endif; ?> 
<?php endif; ?> 




                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><?= SUBENTITY ?> Role<a style="color:Red;">*</a></label>
                                        <div class="col-sm-6"><select class="form-control m-b" name="chapter_role" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($chapterroles as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $chapter_role): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->office_title ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>
                                    <!--    <div class="form-group  row"><label class="col-sm-2 col-form-label">Chapter Role</label>

                                            <div class="col-sm-10"><input name="chapter_role" type="text" class="form-control" value="<?= $chapter_role ?>" ></div>
                                        </div> -->

<!-- <php if($action3_r > 0): ?> -->

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label"><?= SUBENTITY ?> Admin</label>
                                          <div class="col-sm-2"><select class="form-control m-b" name="chapter_admin" Value="<?= $chapter_admin ?>"  >
                                            <?php if($chapter_admin == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                              
                                        </div>
<!--<php endif; ?> -->


                                            
                               <!--         <div class="form-group  row"><label class="col-sm-2 col-form-label">User Level</label>

                                            <div class="col-sm-10"><input name="tguserlevelname" type="text" class="form-control" value=<?= $tguserlevelname ?> ></div>
                                        </div> -->
<br>                                    
                                        <center>Mailing Address </center>
                                        
<br>
                                        <div class="ibox-content"> 
                                        <div class="form-group row"><label class="col-sm-2 col-form-label">Mail Address1</label>
                                            <div class="col-sm-8"><input name="mailaddress1" type="textarea" class="form-control" value="<?= $mailaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Address2</label>
                                            <div class="col-sm-8"><input name="mailaddress2" type="text" class="form-control" value="<?= $mailaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail City</label>
                                            <div class="col-sm-8"><input name="mailcity" type="text" class="form-control" value="<?= $mailcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail State <?= $mailingstate ?></label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="mailstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $mailstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                             <!--           <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail State</label>
                                            <div class="col-sm-10"><input name="mailstate" type="text" class="form-control" value="<?= $mailstate ?>" ></div>
                                        </div> -->
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Zip</label>
                                            <div class="col-sm-2"><input name="mailzip" type="text" class="form-control" value="<?= $mailzip ?>" ></div>
                                        </div> 
                                    </div> <!-- End Ibox  -->                                                                                                      
                                    </div> <!-- end col-6 -->
                                    <div class="col-md-6">

                                        <!-- member number not required when adding - do a case with no red asterisk  -->

                                    <?php if($frmpg == 'cavu' || $frmpg == 'camu') { ?>  <!-- required if editing  -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Member Number<a style="color:Red;">*</a></label>

                                             <div class="col-sm-4"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>"></div>
                                        </div>
                                    <?php }else{ ?> <!-- not required if new -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Member Number</label>

                                             <div class="col-sm-4"><input name="member_no" type="text" class="form-control" value="<?= $member_no ?>"></div>
                                        </div>
                                    <?php } ?>




                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Member Type<a style="color:Red;">*</a></label>
                                        <div class="col-sm-4"><select class="form-control m-b" name="member_type" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                        <?php foreach($membertypes as $row) { ?>
                                        <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->id == $member_type): ?> 
                                                <option selected value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->id ?>"><?= $row->ccmp_type ?> [<?= $row->description ?>]</option>
                                            <?php endif; ?>
                                         <?php } ?>                                    
                                         </select>
                                        </div>
                                        </div>

<!-- <php if($action3_r > 0): ?>  --> <!--  <div class="form-group  row"><label class="col-sm-2 col-form-label">Verified by National</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="verified" Value="<?= $verified ?>" readonly>
                                                <?php if($verified == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>    -->                               
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Current Year</label>

                                            <div class="col-sm-2"><input name="current_year" type="text" class="form-control" value="<?= $current_year ?>" ></div>
                                        </div> 


                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Eligible Voter</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="eligible_voter" Value="<?= $eligible_voter ?>" >
                                                <?php if($eligible_voter == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

<!-- <php endif; ?>  -->                                          


                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Email<a style="color:Red;">*</a></label>

                                             <div class="col-sm-8"><input name="email_address" type="text" class="form-control" value="<?= $email_address ?>" ></div>
                                        </div>
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email Opt Out</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="emailoptout" Value="<?= $emailoptout ?>" >
                                                <?php if($emailoptout == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Directory Opt Out</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="directoryoptout" Value="<?= $directoryoptout ?>" >
                                                <?php if($directoryoptout == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Do Not Call</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="donotcall" Value="<?= $donotcall ?>" >
                                                <?php if($donotcall == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                            
                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mail Newsletter</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="mail_notices" Value="<?= $mail_notices ?>" >
                                                <?php if($mail_notices == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  
<!-- <php if($action3_r > 0): ?> -->
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

                                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Deceased</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="deceased" Value="<?= $deceased ?>" >
                                                <?php if($deceased == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>      
                                      <!--      <div class="form-group  row"><label class="col-sm-2 col-form-label">No Address</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="no_address" Value="<?= $no_address ?>" >
                                                <?php if($no_address == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>  -->
                                    <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Special Event</label>
                                              <div class="col-sm-3"><select class="form-control m-b" name="special_event" Value="<?= $special_event ?>" >
                                                <?php if($special_event == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> -->

<!-- <php endif; ?>   -->                                         
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Misc 1</label>

                                            <div class="col-sm-8"><input name="misc1" type="text" class="form-control" value="<?= $misc1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Misc 2</label>

                                            <div class="col-sm-8"><input name="misc2" type="text" class="form-control" value="<?= $misc2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Misc 3</label>

                                            <div class="col-sm-8"><input name="misc3" type="text" class="form-control" value="<?= $misc3 ?>" ></div>
                                        </div> 


<br>


                                        <center>Physical Address </center>
<br>
                                        <div class="ibox-content"> 
                                          <div class="form-group  row"><label class="col-sm-2 col-form-label">Same as Mailing?</label>
                                          <div class="col-sm-2"><select class="form-control" name="mail_phys" Value="<?= $mail_phys ?>" >
                                            <?php if($mail_phys == 1) { ?>
                                                <option selected value=1>Yes</option>
                                                <option value=0>No</option>
                                            <?php }else{ ?>
                                                <option value=1>Yes</option>
                                                <option selected value=0>No</option>
                                            <?php } ?>
                                            </select>
                                           </div>                                                  
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Address1</label>
                                            <div class="col-sm-8"><input name="physaddress1" type="text" class="form-control" value="<?= $physaddress1 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Address2</label>
                                            <div class="col-sm-8"><input name="physaddress2" type="text" class="form-control" value="<?= $physaddress2 ?>" ></div>
                                        </div> 
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys City</label>
                                            <div class="col-sm-8"><input name="physcity" type="text" class="form-control" value="<?= $physcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys State</label> 
                                        <div class="col-sm-4"><select type="text" class="form-control m-b" name="physstate" >
                                        <!-- Loop through the dropdown array passed in $data  -->
                                          <?php foreach($state_codes as $row) { ?> <!-- was $usrlvls  -->
                                            <!-- If $row->id = currently selected user_level_id then pre-select that option -->
                                            <?php if($row->state_code == $physstatecode): ?> <!-- was$ culid -->
                                               <option selected value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option> <!-- $row->level_title -->
                                            <?php else: ?> <!-- otherwise just create the option -->
                                                <option value="<?= $row->state_code ?>"><?= $row->name ?> <?= $row->state_code ?></option>
                                            <?php endif; ?>
                                          <?php } ?>                                    
                                          </select>
                                        </div>
                                        </div> <!-- end state code -->



                                <!--        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys State</label>
                                            <div class="col-sm-10"><input name="physstate" type="text" class="form-control" value="<?= $physstate ?>" ></div>
                                        </div>  -->
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Phys Zip</label>
                                            <div class="col-sm-2"><input name="physzip" type="text" class="form-control" value="<?= $physzip ?>" ></div>
                                        </div>                                                                                                                           </div> <!-- End Ibox  -->
                                    </div> <!-- end 2nd column -->
                                </div> <!-- end row -->

                         <!--       <br> -->
                            
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Notes</label>
                                    <div class="col-sm-12"><input name="notes" type="text" class="form-control" value="<?= $notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                   <!--     <php if($action3_r > 0): ?> line 753 --><!-- action 3 is for field access c,r,u,d fields and buttons  -->
                                 <h3>Credentials </h3>
                                 <br> 
                                <div class="row">
                                    <div class="col-md-6">

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

                                    <!--     <div class="form-group  row"><label class="col-sm-2 col-form-label">Highest Certificate</label>
                                            <div class="col-sm-10"><input name="highest_certificate" type="text" class="form-control" value="<?= $highest_certificate ?>" ></div>
                                        </div>  -->
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Certificate No</label>
                                            <div class="col-sm-8"><input name="certificate_number" type="text" class="form-control" value="<?= $certificate_number ?>" ></div>
                                        </div>                                            
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert</label>
                                            <div class="col-sm-8"><input name="other_faa_cert" type="text" class="form-control" value="<?= $other_faa_cert ?>" ></div>
                                        </div>
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Other FAA Cert #</label>
                                            <div class="col-sm-8"><input name="ofc_certnum" type="text" class="form-control" value="<?= $ofc_certnum ?>" ></div>
                                        </div>                                                               
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
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Drone</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="drone" Value="<?= $drone ?>" >
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

                                    </div> <!-- column -->

                                <div class="col-md-6"> 
                                         <div class="form-group  row"><label class="col-sm-2 col-form-label">Total Time</label>
                                            <div class="col-sm-2"><input name="total_time" type="text" class="form-control" value="<?= $total_time ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Owner</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="aircraft_owner" Value="<?= $aircraft_owner ?>"  >
                                                <?php if($aircraft_owner == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Type</label>

                                            <div class="col-sm-8"><input name="aircraft_type" type="text" class="form-control" value="<?= $aircraft_type ?>" ></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Aircraft Reg</label>

                                            <div class="col-sm-8"><input name="aircraft_reg" type="text" class="form-control" value="<?= $aircraft_reg ?>" ></div>
                                        </div>
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

<!-- <php if($action3_r > 0): ?> -->



<!-- <php endif; ?> -->
                                            
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


                                 </div>             
                                </div>  <!-- end row -->    
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Credential Notes</label>
                                    <div class="col-sm-12"><input name="cred_notes" type="text" class="form-control" value="<?= $cred_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <h3>Financial Account</h3>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                   
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Account Type</label> 
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

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Acct Status</label> 
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

                               <!--     <php endif; ?> -->
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Fin Contact's Email</label> 
                                        <div class="col-sm-8"><input name="fin_email" type="text" class="form-control w-b" placeholder="defaults to contact email if left blank" value="<?= $fin_email ?>" ></div>
                                        </div>

<br>

                                        <center>Billing Address </center>
<br>
                                    <div class="ibox-content"> 
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Name</label> 
                                        <div class="col-sm-8"><input name="billname" type="text" class="form-control" placeholder="defaults to contact name if left blank" value="<?= $billname ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill To Phone</label> 
                                        <div class="col-sm-8"><input name="billphone" type="text" class="form-control" placeholder="defaults to contact phone if left blank" value="<?= $billphone ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address1</label> 
                                        <div class="col-sm-8"><input name="billaddress1" type="text" class="form-control" value="<?= $billaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Address2</label> 
                                        <div class="col-sm-8"><input name="billaddress2" type="text" class="form-control" value="<?= $billaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill City</label> 
                                        <div class="col-sm-8"><input name="billcity" type="text" class="form-control" value="<?= $billcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill State</label> 
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

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Bill Zip</label> 
                                        <div class="col-sm-2"><input name="billzip" type="text" class="form-control" value="<?= $billzip ?>" ></div>
                                        </div>
                                    </div> <!-- End Ibox  -->

                                    </div> <!--  col end  -->
                                    <div class="col-md-6">


                                <!--    <php if($action3_r > 0): ?> --><!-- action 3 is for field access c,r,u,d fields and buttons  -->


                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Balance</label> 
                                        <div class="col-sm-2"><input name="acct_bal" type="text" class="form-control" value="<?= $acct_bal ?>" ></div>
                                        </div>
                                    
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Acct Inactive</label>
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
                               <!--    <php endif; ?> -->

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Shipping Addr same as Billing?</label>
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
                                        <br>
                                        <p></p>
                                        <center>Shipping Address </center>
<br>                                    
                                    <div class="ibox-content">
                                     
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Name</label> 
                                        <div class="col-sm-8"><input name="shipname" type="text" class="form-control" value="<?= $shipname ?>" placeholder="defaults to contact name if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship To Phone</label> 
                                        <div class="col-sm-8"><input name="shipphone" type="text" class="form-control" value="<?= $shipphone ?>" placeholder="defaults to contact phone if left blank"></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address1</label> 
                                        <div class="col-sm-8"><input name="shipaddress1" type="text" class="form-control" value="<?= $shipaddress1 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Address2</label> 
                                        <div class="col-sm-8"><input name="shipaddress2" type="text" class="form-control" value="<?= $shipaddress2 ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship City</label> 
                                        <div class="col-sm-8"><input name="shipcity" type="text" class="form-control" value="<?= $shipcity ?>" ></div>
                                        </div>

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship State</label> 
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

                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Ship Zip</label> 
                                        <div class="col-sm-2"><input name="shipzip" type="text" class="form-control" value="<?= $shipzip ?>" ></div>
                                        </div>                                        
                                    </div> <!-- End Ibox  -->
                                    </div> <!--  col end  -->
                                </div> <!-- row end -->
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Financial Acct Notes</label>
                                    <div class="col-sm-12"><input name="fin_notes" type="text" class="form-control" value="<?= $fin_notes ?>"> <span class="form-text m-b-none"></span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                 <h3>User Account </h3>
                                 <br> 
                                <div class="row">
                                    <div class="col-md-6">
  <!-- <div class="col-sm-2"><input type="text" class="form-control" value=<?= $locked ?> ></div> -->
                                    <!--    <div class="form-group">
                                            <label> <input type="checkbox" name="locked"> Locked </label>
                                        </div> --><!-- if checkbox, $locked = "on" when checked, NULL when not checked  -->
                                        <div class="form-group  row"><label class="col-sm-3 col-form-label">Username<a style="color:Red;">*</a></label>

                                            <div class="col-sm-8"><input name="username" type="text" class="form-control" value="<?= $username ?>" placeholder="defaults to contact email if left blank"> </div>
                                        </div>
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Login Locked</label>
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

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Login Inactive</label>
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

                                          <div class="form-group  row"><label class="col-sm-3 col-form-label">Approved (Self Regisration Only)</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="approved" Value="<?= $approved ?>" >
                                                <?php if($approved == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div>                                          

                                                                                             

                                    </div> <!-- column -->

                                <div class="col-md-6"> 
                            <?php if($recid > 0): ?> <!-- Updating vs. Adding a new record  -->


                                <!-- Extract the current user_level_id (from trongate_users table) from $data array to preselect that option -->
                           <!-- <?php   $culid = $data['currentuserlevel'];?>
                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Access Level:</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="userlevel" >
                                <!-- Loop through the dropdown array passed in $data  ->
                                  <?php foreach($usrlvls as $row) { ?>
                                    <!-- If $row->id = currently selected user_level_id then pre-select that option ->
                                    <?php if($row->id == $culid): ?> 
                                       <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                    <?php else: ?> <!-- otherwise just create the option ->
                                        <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                    <?php endif; ?>
                                  <?php } ?>                                    
                                  </select>
                                </div>
                                </div>  -->

                                            
                            <?php else: ?> <!-- Adding -->
<!-- Dropdown fed by object - new record so can just get the full list
// get topics object for dropdown - you can show $row->title but save $row->id
$data['tpcs'] = $this->model->get('id','gstopics');  -->

                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Password</label>
  <!-- <div class="col-sm-8"><input name="password" type="text" class="form-control" value="<?= $password ?>" ></div> -->
                                    <div class="col-sm-8"><input name="password" type="text" class="form-control" value="Preset to a system default" disabled></div>
                                </div>

                                <div class="form-group  row"><label class="col-sm-3 col-form-label">Access Level</label>
                                    <div class="col-sm-8"><input name="userlevel" type="text" class="form-control" value="Preset to a system default" disabled></div>
                            <!--    <div class="col-sm-8"><select class="form-control m-b" name="userlevel" >
                                    
                                <!-- Loop through the dropdown array passed in $data  ->
                                  <?php foreach($usrlvls as $row) { ?>
                                    <!-- If $row->id = currently selected user_level_id then pre-select that option ->
                                        <?php if($row->id == $usrlvlid): ?> <!-- ccmp = 4 ->
                                            <option selected value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                        <?php else: ?> 
                                            <option value="<?= $row->id ?>"><?= $row->description ?> [<?= $row->level_title ?>]</option>
                                        <?php endif; ?> 
                                  <?php } ?>                                    
                                  </select> 
                                </div> -->
                                </div> 

                            <?php endif; ?> <!-- End adding  -->

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Email Confirmed (Self Reg Only)</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="confirmed" Value="<?= $confirmed ?>" >
                                                <?php if($confirmed == 1) { ?>
                                                    <option selected value=1>Yes</option>
                                                    <option value=0>No</option>
                                                <?php }else{ ?>
                                                    <option value=1>Yes</option>
                                                    <option selected value=0>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 


                                <!--        <php if($recid > 0): ?> <!--  Updating --> <!-- decided to set default by passing the value of 1 so wont have to change interface code if rule changes-->
                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Force PW Change</label>
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

                              <!--          <php else: ?> <!-- Adding ->  

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Force PW Change New</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="force_pw_chg" Value="<?= $force_pw_chg ?>" >
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                              </select>
                                            </div>
                                        </div>


                                        <php endif; ?>  -->




                                     <!--       <div class="form-group  row"><label class="col-sm-3 col-form-label">Timed Reset</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="timed_reset" Value="<?= $timed_reset ?>" >
                                                <?php if($timed_reset == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 

                                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Reset Interval</label>
                                                <div class="col-sm-2"><input name="reset_interval" type="text" class="form-control" value="<?= $reset_interval ?>" ></div>
                                            </div> -->

                                        <!--    <div class="form-group  row"><label class="col-sm-3 col-form-label">Rec Id</label> -->
                                                <div class="col-sm-2"><input name="id" type="text" class="form-control" value="<?= $recid ?>" hidden></div> <!-- after the first failed save $id blanks but $recid stays -->
                                        <!--    </div> -->                                      

                                       <!--     <div class="form-group  row"><label class="col-sm-3 col-form-label">Frmpg</label> -->
                                                <div class="col-sm-2"><input name="frmpg" type="text" class="form-control" value="<?= $frmpg ?>" hidden></div> <!-- passed to form and passed back in Post below or URL above -->
                                       <!--    </div> -->

                                       <!--     <div class="form-group  row"><label class="col-sm-3 col-form-label">Status</label>
                                              <div class="col-sm-2"><select class="form-control m-b" name="locked" Value="$locked" >
                                                <?php if($status == 1) { ?>
                                                    <option selected>Yes</option>
                                                    <option>No</option>
                                                <?php }else{ ?>
                                                    <option>Yes</option>
                                                    <option selected>No</option>
                                                <?php } ?>
                                                </select>
                                               </div>                                              
                                            </div> 
                                      -->
   
                                 </div>             
                                </div>  <!-- end row -->    


                                <!--     <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div> -->


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        
                                <?php if($recid > 0 || $id > 0): ?> <!-- If record id passed then editing an existing record -->
                                    <div class="btn-group">


                                    <?php if($_SESSION['ccmpmode'] == 'momv' || $_SESSION['ccmpmode'] == 'momu' ): ?>
                                        <button class="btn btn-outline btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        <div>
                                        <a class="btn btn-outline btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmv' || $_SESSION['ccmpmode'] == 'mcmu' ): ?> 
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        <div>
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamv' || $_SESSION['ccmpmode'] == 'mamu' ): ?>
                                        <button class="btn btn-outline  btn-primary" name="submit" type="submit" value="Submit">Save Changes</button>
                                        <div>
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 



                                <?php else: ?> <!-- If no record id passed then creating a new record -->


                                    <?php if($_SESSION['ccmpmode'] == 'momm' || $_SESSION['ccmpmode'] == 'momv' || $_SESSION['ccmpmode'] == 'momc' ): ?>
                                        <button class="btn btn-outline  btn-primary" type="submit" name="submit" value="Submit" >Save New <?= CCMP ?></button> 
                                        <div>
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/momm">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mcmm' || $_SESSION['ccmpmode'] == 'mcmv' || $_SESSION['ccmpmode'] == 'mcmc' ): ?> 
                                        <button class="btn btn-outline  btn-primary" type="submit" name="submit" value="Submit" >Save New <?= CCMP ?></button> 
                                        <div>
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mcmm">Cancel</a>
                                        </div>

                                    <?php elseif($_SESSION['ccmpmode'] == 'mamm' || $_SESSION['ccmpmode'] == 'mamv' || $_SESSION['ccmpmode'] == 'mamc' ): ?>
                                        <button class="btn btn-outline  btn-primary" type="submit" name="submit" value="Submit" >Save New <?= CCMP ?></button> 
                                        <div>
                                        <a class="btn btn-outline  btn-warning"  type="button" href="<?= BASE_URL ?>welcome-ccmps/manage/mamm">Cancel</a>
                                        </div>
                                            
                                    <?php else: ?> 

                                    <?php endif; ?> 
                                      
                            

                                <?php endif; ?>
                                </div> <!-- button group -->                       
                            </div>
                        </div>
                    </form>

                </div> <!-- ibox content -->
            </div>
        </div>
    </div> <!-- ibox content -->

   
