                            <br>
                            <center><h3>A Revolutionary You: Mind, Body and Spirit!</h3></center>

                             <center><h3>




        <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-dark dropdown-toggle">I want to ... </button>

    <ul class="dropdown-menu">

        <?php if($data['tg_user_level'] == 15): ?> <!-- principal - the doctors -->
                <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Refresh Page</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiadminhome">Go back to Homepage</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptw">Go to Ask the Doctors PTW</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipresurvey">Conduct a Pre-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipostsurvey">Conduct a Post-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobistrawpoll">Conduct a Straw Poll</a></li>            
            <li class="dropdown-divider"></li>
        <?php endif; ?>         
        <?php if($data['tg_user_level'] == 11 || $data['tg_user_level'] == 12 ): ?> <!-- facilitator & cofacilitator -->
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Refresh Page</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiauditsheet">Audit Sheet</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipresurvey">Conduct a Pre-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipostsurvey">Conduct a Post-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobidownload">Download Materials</a></li>            
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Fill out a Form</a></li>              
        <?php endif; ?>
        <?php if($data['tg_user_level'] == 2): ?> <!-- administrator -->
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Refresh Page</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiauditsheet">Audit Sheet</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipresurvey">Conduct a Pre-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobipostsurvey">Conduct a Post-Survey</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiacctverify">Verify a New Account</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Fill out a Form</a></li>             
        <?php endif; ?>          
        <?php if($data['tg_user_level'] == 7): ?> <!-- ccmp - participant -->
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Refresh Page</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobihome">Go back to Homepage</a></li>
            <li class="dropdown-divider"></li>        
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobinews">Get the latest News</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobievents">See the Events Calendar</a></li>

        <?php endif; ?>  
   <!--     <?php if($data['tg_user_level'] == 15): ?> <!-- principal - the doctors --
            <!-- omit this option --
        <?php else: ?>
            <li><a class="dropdown-item" href="#">View Only Ask the Doctors</a></li>
        <?php endif; ?> -->


        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="https://www.gastonandporter.org/">Go to our Website</a></li>
        <li><a class="dropdown-item" href="https://www.gastonandporter.org/contact">Go to Contact Us Page</a></li>
        <li><a class="dropdown-item" href="https://www.facebook.com/groups/395220337174381/">Go to our Facebook Page</a></li>
        <li><a class="dropdown-item" href="http://www.amazon.com/exec/obidos/tg/detail/-/0345432150/qid=1041850968/sr=12-1/102-3717357-2068906?v=glance&s=books">Purchase the book Primetime</a></li>

        <li class="dropdown-divider"></li>        

        <li><a class="dropdown-item" href="#">Change My Password</a></li>    
        <li><a class="dropdown-item" href="#">Change My Contact Info</a></li>
        <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobihelp">Get Help</a></li>  
        <li class="dropdown-divider"></li>
        <!-- If it is a    -->  

        <?php if($_SESSION['tg_user_level'] == 15): ?> <!-- if a principal, logout to Primetime Admin -->
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/logout/1">Sign Out <i class="fa fa-sign-out"></i> </a></li>

        <?php else: ?>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/logout">Sign Out <i class="fa fa-sign-out"></i> </a></li>
        <?php endif; ?>

    </ul>
</div>
</h3></center>

    <center><h2><i class="fa fa-user-md"></i> Ask the Doctors</h2> </center>
        <center><h3>Primetime Sister Circles</h3></center>
                    <!-- Show flash message then reset it to blank  -->
         <p>   <?= flashdata('<div style="font-weight: bold; color: gray;">', '</div>'); 
            $flash_msg = '';
            set_flashdata($flash_msg); ?> </p>
        
                <?php if($data[tg_user_level] == 15): ?> <!-- if a principal Get their admin view - else on line 300 -->        
                    <div class="social-feed-box">

                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                                <div class="social-comment">

                                    <div class="media-body">

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Enter new post..." ><?= $askpost ?></textarea> 
                                                 
                                    </div>
                                </div>
                                <br>
                            <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Post</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

                            </div>


                    </div>

                    <div class="social-feed-box">
        <tbody>
            <?php foreach($rows as $row) { ?>

                            <div class="social-avatar">
                                <a href="" class="float-left">

                                    <?php if($row->trongate_user_level == 7): ?>
                                  <!--      <p> 7 </p> -->
                                        <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?>"> 

                                    <?php else: ?> <!--  MAYBE make this the doctors case and add a case for anyone else -->
                               <!--     <p> not 7 </p> -->
                                        <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?>"> 
                                    <?php endif; ?> 
                                </a>
                                <div class="media-body">
                                    <?php if($row->trongate_user_level == 15): ?> <!-- user level of poster, not logged in user  -->
                                        <a href="#">
                                           <i class="fa fa-user-md"></i> <?= $row->fname?> <?= $row->lname?> <!--prin <?= $row->trongate_user_level ?>/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php else: ?>
                                        <a href="#">
                                           <?= $row->fname?> <?= $row->lname?> <!-- ccmp <?= $row->trongate_user_level ?>/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php endif; ?>  
                                <!--    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>-->
                                <small class="text-muted"><?= $row->post_date ?></small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    <?= $row->post ?>
                                </p>

                                <div class="btn-group">
                             <!--       <button class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> Edit Response</button> -->

                        <?php if($row->hidden == 1): ?>
                             <?php if($row->trongate_user_level == 15): ?> <!-- Posted by the principals themselves  -->  
            <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiunhideaskpost/<?= $row->id ?>" ><i class="fa fa-eye"></i> Unhide Your Post</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Post</a>
                            <?php else: ?> <!-- question by a non principal  -->
                <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiunhideaskpost/<?= $row->id ?>" ><i class="fa fa-eye"></i> Unhide Question</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
                            <?php endif; ?>                                  
                        <?php else: ?>  <!--- Not Hidden -->
                             <?php if($row->trongate_user_level == 15): ?> <!-- Posted by the principals themselves  -->   
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobihideaskpost/<?= $row->id ?>" ><i class="fa fa-eye-slash"></i> Hide Your Post</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Post</a>
                            <?php else: ?> <!-- question by a non principal  -->
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobihideaskpost/<?= $row->id ?>" ><i class="fa fa-eye-slash"></i> Hide Question</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
                            <?php endif; ?> 
                        <?php endif; ?>  

                                    
                                </div>
                            </div>
                            <div class="social-footer">
                                <!-- if a response exists in the database -->
                                <?php if(strlen($row->response) > 0 AND $row->response != ' '): ?> <!-- strlen of a space = 1  -->
                                <div class="social-comment">
                                    <div class="media-body">
                                      <a href="#">
                                            <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> Doctor's Response <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> -->
                                        </a>
                                <!--        the response from the database -->
                                
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpostresponse" class="form-control" value="$askpostresponse" ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Edited Response</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                                    </div>
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                                    </div>
                                </div>



                                <!-- Else no reponse yet show response box   -->
                                <?php else: ?>
                                <div class="social-comment">
                                    <div class="media-body">

                                    <?php if($row->trongate_user_level == 15): ?> <!-- Posted by the principals themselves  -->

                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="New Enter optional follow-on..." ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Follow-on</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>






                                 <!--       <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> Doctor's Response <textarea class="form-control" value="$post" placeholder=" NEW Enter optional follow-on..."><?= $row->response ?></textarea> -->

                                    <?php else: ?> <!-- Not doctors responding to their own post  -->    

                                        <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> Doctor's Response <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> -->



                       <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
<!--   This is the main response box -->   <textarea name="askpostresponse" class="form-control" value="$askpostresponse" placeholder="New Enter response...277" ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save New Response</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

                                    <?php endif; ?> 
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- End if response -->

                            </div>
            <!--    </td>            
            </tr>  -->
            <?php
            }
            ?>
        </tbody>
    </table>


<!--frm 77--><?php else: ?> <!-- Anyone but a principal - usrlvl 15. All the code above constructed the principals buttons
                                and posts from the principals admin view. Now need to cover the ccmp 7 & administrator 2 facil 10 & co facil 11-->
                    <?php if($data[tg_user_level] == 2): ?> <!--  administrator -->

                    <?php endif; ?> <!-- End Administrator frm 300 -->

<!-- The Administration section is above this line where you have cases statements for the doctors and other administrators -->
<!-- Below this dashed line is only the CCMP -->
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- There should be no cases where the you are getting data from the doctors below this line because they only do it in the admin section above this line -->
<!-- Therefore the only time you see $row->trongate_user_level == 15 should be when showing data from the doctors-->

                <?php if($data[tg_user_level] == 7): ?> <!--   ccmp  -->

                    <div class="social-feed-box">

                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                        <!--        <div class="social-comment">  makes text in input smaller  -->

                            <!--        <div class="media-body">  -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Click here to write your question..." ><?= $askpost ?></textarea> 
                                                 
                            <!--        </div> -->
                          <!--      </div>  makes text in input smaller -->
                         <!--      <br> -->
                            <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Submit Your Question</a></button> 
        <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelsq" >Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

                            </div>


                    </div>

                    <div class="social-feed-box">
        <tbody>
            <?php foreach($rows as $row) { ?>

                            <div class="social-avatar">
                                <a href="" class="float-left">

                                    <?php if($row->trongate_user_level == 7): ?>
                                  <!--      <p> 7 </p> -->
                                        <?php if(strlen($row->posterspicture) > 0): ?>
                                            <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?>">
                                        <?php else: ?> 
                                             <img alt="image" src="<?= BASE_URL?>ccmps_photos_thumbnails/default/default.jpg">
                                        <?php endif; ?> 
                                    <?php else: ?> <!--  MAYBE make this the doctors case and add a case for anyone else -->
                               <!--     <p> not 7 </p> -->
                                        <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?>"> 
                                    <?php endif; ?> 
                                </a>
                                <div class="media-body">
                                    <?php if($row->trongate_user_level == 15): ?> <!-- user level of poster, not logged in user  -->
                                        <a href="#">
                                           <i class="fa fa-user-md"></i> <?= $row->fname?> <?= $row->lname?> <!--prin <?= $row->trongate_user_level ?>/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php else: ?>
                                        <a href="#">
                                            <?= $row->fname?> <?= $row->lname?> <!-- ccmp <?= $_SESSION['tg_user_id'] ?> /<?= $row->trongate_user_level ?>/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php endif; ?>  
                                    <!--    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>-->
                                    <?php if(strlen($row->updated_at) > 0 AND $row->updated_at != '1st Jan 1970'): ?>
                                        <small class="text-muted"><?= $row->post_date ?></small><small class="text-muted"><strong> Updated</strong> <?= $row->updated_at ?></small>
                                    <?php else: ?> 
                                        <small class="text-muted"><?= $row->post_date ?></small>
                                    <?php endif; ?>            
                                </div>
                            </div>

                            <div class="social-body">
<?php if($row->trongate_user_id == $_SESSION['tg_user_id']): ?> <!-- If the user is looking at their own question  -->

                        <!--  Save changes to your own question -->
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                        <!--        <div class="social-comment">  makes text in input smaller  -->

                            <!--        <div class="media-body">  -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Write your question here..." ><?= $row->post ?></textarea> 
                                                 
                            <!--        </div> -->
                          <!--      </div>  makes text in input smaller -->
                            <!--    <p></p> -->
                            <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Changes to Your Question</a></button> 
        <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelsq" >Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>


<?php else: ?>
                              
                                   <?= $row->post ?>
                               


                            <!--  all the comments on the question -->
                                <div class="btn-group">
                 <!-- If you posed the question you may edit or remove it so you will need what you wrote in a form  -->        
    <?php if($row->trongate_user_id == $_SESSION['tg_user_id']): ?>

                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobisaveeditsquestion/<?= $row->id ?>" ><i class="fa fa-save"></i> Save Edits</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideletequestion/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
    <?php endif; ?>                                
                                </div>                             
<?php endif; ?> 
                                <!-- Show the doctors response first then the rest of the comments  -->

                                <?php if(strlen($row->response) > 0 AND $row->response != ' '): ?> <!-- strlen of a space = 1  --> <!-- If the doctors response exists  -->

                                   <div class="social-avatar"> 
                                       <!-- If it is the Doctors own post they responded to in the admin section above say Doctors Follow on Post -->
                                     <div class="media-body"> 
                          <!--      <a href="" class="float-left"> -->
                                            <?php if($row->trongate_user_level == 15): ?> 
<!-- Their picture is already there as the poster so redundant --> <!-- <a href="#">
                                                    <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> xxx
                                                </a> -->

                                            <?php else: ?> <!-- Doctors picture with their response  --> 
                                            <!-- commented out for simplification and cant get text + date to line up with picture w/o date being next to text not under -->

                                            <!--    <a href="#">
                                                    <img alt="image" src="<?= BASE_URL?>system_accounts_photos_thumbnails/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> 
                                                </a> -->
                                            <?php endif; ?>
                            
                                            <?php if($row->trongate_user_level == 15): ?> 
                                                <a href="#">
                                                    <i class="fa fa-user-md"></i> Doctor's Follow-on Post <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> -->
                                                </a>

                                            <?php else: ?> <!-- Else if it is not the Doctors own post, say Doctors Response --> 
                                                <a href="#">
                                                    <i class="fa fa-user-md"></i> Doctor's Response <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> -->
                                                </a>
                                            <?php endif; ?>

                                            <?php if(strlen($row->response_date) > 0 AND $row->response_date != '1st Jan 1970'): ?>
                                                <small class="text-muted"><?= $row->response_date ?></small>
                                            <?php endif; ?> 

                                    <!-- the response from the database -->
                                      <p>  <?= $row->response ?></p>

                                        </div>  <!--media body -->
                                    </div>  <!-- social avatar  -->

  <!--  </a> -->

                                         

                                <?php endif; ?> 


                                        <!-- foreach loop to display the comments associated with this post  -->
      
                               <!--     <div class="media-body"> -->
                                    <!--    <div class="social-avatar"> dont know where closing div is. Made a difference -->
                                        <?php if(strlen($row->response) > 0): ?> 
                                       <!-- no spacing necessary so this intentionally left empty -->
                                        <?php else: ?> 
                                            <!-- was as break for space between docs response and participant responses  -->
                                      <!--  When comment put into a dropdown panel this became unnecessary -->

                                        <?php endif; ?> 

                   <!--     <div class="ibox-content"> -->
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">View Comments (<?= $row->cmtcount ?>) <i class="fa fa-chevron-down"></i></a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">

                                        <?php foreach($comments as $cmt) { ?>

                                            <?php if($cmt->post_id == $row->id): ?>  <!-- if this comment belongs to this post -->
                                       <!--     <div class="social-feed-box"> -->
                                        <!-- Purposely disabling pictures with comment - make choice in config - uncomment out to show pics  -->
                                            <!--    <?php if(strlen($cmt->commentorpicture) > 0): ?>
                                                    <img alt="image" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $cmt->recid ?>/<?= $cmt->commentorpicture ?>">  
                                                <?php endif; ?> -->
                                        <?php if(strlen($row->response) > 0): ?> 
                                       
                                        <?php else: ?> 
                                             <br/>
                                        <?php endif; ?> 
                                                <?php if(strlen($cmt->updated_at) > 0 AND $cmt->updated_at != '1st Jan 1970'): ?>

                                                   <span><i class="fa fa-comment"></i></span> <small class="text-muted"> </small><?= $cmt->fname ?> <?= $cmt->lname ?><small class="text-muted"> <?= $cmt->comment_date ?></small><small class="text-muted"><strong> Updated</strong> <?= $cmt->updated_at ?></small>
                                                <br/>
                                                <?php else: ?>

                                               <span><i class="fa fa-comment"></i></span> <small class="text-muted"> </small><?= $cmt->fname ?> <?= $cmt->lname ?><small class="text-muted"> <?= $cmt->comment_date ?></small>
                                                <br/>
                                                <?php endif; ?>


                        <?php if($cmt->trongate_user_id == $_SESSION['tg_user_id']): ?> <!-- If the user is looking at their own comment  -->
                                                    <!-- Then need a form to edit it  -->
                                                   <!--     <p>edit form here</p> -->
                        <br/> <!-- no effect anymore -->


                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisavecommentonpost/<?= $row->id ?>/<?= $cmt->id ?>"> 
                      <!--      <div class="social-body"> -->
 
                           <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpostcomment" class="form-control" value="$askpostcomment" ><?= $cmt->comment ?></textarea>
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                               <!--     <p></p>  -->                       
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Changes to Your Comment</a></button>
                <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelctc" >Cancel</a> 
    <!--    <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a> -->
                                    </div>
                                      
                            <!--    </div> -->

                           <!--     </div> -->
                        </form>





                                                    <?php else: ?>
                                                        <?= $cmt->comment ?>
                                                   <br> <!--     --> <!-- Controls space between comments -->


                                                    <?php endif; ?>                                                                                                      

                                      <!--     </div> -->                           
   <!--  <textarea name="askpostcomment" value="$askpostcomment"> <?= $cmt->comment ?></textarea> -->                                
                           <!--     <p></p> -->
                                            <?php endif; ?>                               
                                                    
                                        <!-- End foreach comment -->            
                                        <?php
                                        }
                                        ?>
                                            </div> <!-- end class panel body  -->
                                        </div> <!-- end id = collapseOne  -->
                                    </div> <!-- end class = panel panel-default  -->
                       </div> <!-- end panel-group  -->
                    </div> <!-- end panel-body  -->
           <!--     </div>  ibox-content  -->
                                            <!-- Get New Comment on the  Question - not on the response  -->

            <!--        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> for now only comment on original post, not response like line 587 -->
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisavecommentonpost/<?= $row->id ?>/<?= $cmtid ?>"> <!-- Same as line 587 -->
                     <!--       <div class="social-body"> -->
 
                                <div class="social-comment"> 

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                    <!-- Will need two cases: Blank when a 7 responds to a docs response or follow on & docs entering a follow on:placeholder="New Enter optional follow-on... -->
                             <!--       <php if($row->trongate_user_level == 15): ?>  not implementing comment on follow on, just original post      -->                            
                                    <!--     <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Follow-on line 542..." ></textarea> -->

                          <!--          <php else: ?> -->
                                     <!--    <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Response..." ></textarea> -->
<!-- Adds space between comments dropdown panel and the enter new comment back    <br/>  -->
                                        <textarea name="askpostcomment" class="form-control" value="$askpostcomment" placeholder="Click here to comment..." ><?= $row->comment ?></textarea> 
                        <!--            <php endif; ?>   -->                                                                                       
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save New Comment</a></button> 
                       <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> 
                                    </div>

                                <!-- not implementing comment on follow on, just original post      --> 
                            <!--        <div class="btn-group">
 
                                    <?php if($row->trongate_user_level == 15): ?> 
                                            <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Follow-on)</a></button> 
                                                           <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> 
                                    <?php else: ?> 
                                     !--       <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Response)</a></button> 
                                            <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a> --
                                    <?php endif; ?>
                                    </div> -->
                                </div> 

                          <!--      </div> line 461 -->
                        </form>

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                             <!--       </div> line 437 -->
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                             <!--       </div>  line 436 -->

                             <!-- End Get New Comment on the  Question - not on the response  -->




                                    </div>

                            </div>





                                <!--  Doctors response to the question -->

                            <div class="social-footer"> <!-- line 499 -->
                                <!-- if a response exists in the database -->
                                <?php if(strlen($row->response) > 0): ?>  <!-- line 506 -->
                         <!--       <div class="social-comment"> -->
                                    <!-- <div class="media-body"> -->                                        

<!-- used to show docs response here but moved above  -->

                                            <!-- Get New Comment on the  Question - not on the response  -->

            <!--        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> for now only comment on original post, not response like line 587 -->
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisavecommentonpost/<?= $row->id ?>/<?= $cmtid ?>"> <!-- Same as line 587 -->
                     <!--       <div class="social-body"> -->
 
                                <div class="social-comment"> 

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                    <!-- Will need two cases: Blank when a 7 responds to a docs response or follow on & docs entering a follow on:placeholder="New Enter optional follow-on... -->
                             <!--       <?php if($row->trongate_user_level == 15): ?>  not implementing comment on follow on, just original post      -->                            
                                    <!--     <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Follow-on line 542..." ></textarea> -->

                          <!--          <?php else: ?> -->
                                     <!--    <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Response..." ></textarea> --
                                        <textarea name="askpostcomment" class="form-control" value="$askpostcomment" placeholder="Click here to comment3 on docs response...line 560". ><?= $row->comment ?></textarea> 
                        <!--            <?php endif; ?>   -->                                                                                       
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> --
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save New Comment dr</a></button> 
                       <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> 
                                    </div> -->

                                <!-- not implementing comment on follow on, just original post      --> 
                            <!--        <div class="btn-group">
 
                                    <?php if($row->trongate_user_level == 15): ?> 
                                            <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Follow-on)</a></button> 
                                                           <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> 
                                    <?php else: ?> 
                                     !--       <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Response)</a></button> 
                                            <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a> --
                                    <?php endif; ?>
                                    </div> -->
                                </div> 

                          <!--      </div> line 461 -->
                        </form>

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                             <!--       </div> line 437 -->
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                             <!--       </div>  line 436 -->

                             <!-- End Get New Comment on the  Question - not on the response  -->

                                </div> <!-- social footer -->



                                <!-- Else no reponse yet show response box   -->
                                <?php else: ?> <!-- line 525 -->
                           <!--     <div class="social-comment">
                                    <div class="media-body"> -->

                                    <?php if($row->trongate_user_level == 15): ?> <!-- Posted by the principals themselves ie A doctor's post -->


                                    <?php else: ?> <!-- Not doctors responding to their own post line 514 -->    <!-- Comment on question -->



                                    <?php endif; ?> <!-- line 547 -->
                               <!--     </div>
                                </div> -->
                                <?php endif; ?> <!-- line 525, 605, 665 -->

                                <!-- End if response -->

                            </div>
            <!--    </td>            
            </tr>  -->
            <!-- end foreach -->
            <?php 
            }
            ?>
        </tbody>
    </table>


<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <?php endif; ?> <!-- End CCMP frm line 304 -->
            <?php endif; ?> <!-- line 77, 298 -->

                </div>
                <br/>
    <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiaskptsc" ><i class="fa fa-arrow-up"></i> Back to Top</a>
    <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiadminhome" >Exit to Homepage <i class="fa fa-arrow-right"></i></a>


                <br/>
                          <br/>
                        </div>
