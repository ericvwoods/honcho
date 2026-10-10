
<!-- Begin Top Menu   -->

<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
        <div class="navbar-header">
         <!--   <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
         <ul class="nav navbar-top-links navbar-left">
        <li>
        
            <br>
            <br>
             <?php if( ENV == 'dev'): ?>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">

             <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong>Home / <?= $bc1 ?> / <?= $bc2 ?> / <?= $_SESSION['admode'] ?> / <?= $id ?></strong></span>
             <!--               <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home | <?= $bc1 ?> | <?= $bc2 ?> | <?= $_SESSION['admode'] ?> | <?= $_SESSION['tab'] ?></strong></span>  -->
            </a>

            <?php else: ?> 
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">                
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong><?= $bc1 ?> / <?= $bc2 ?></strong></span>
            </a>
             <?php endif; ?> 
        </li>



  <!--      <li>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
             <span class="m-r-sm text-muted welcome-message"> Member Services Portal</strong></span>
            </a>
        </li>  -->        

        </ul>

        </div>
            <ul class="nav navbar-top-links navbar-left">


                <li>
             <!--   <span class="m-r"><a href="#"><h1><strong>Content Management System</strong></h1></a> </span>  -->
       <span class="m-r"><a href="https://www.bpapilots.org" target="_blank" style="color:Black;"><h1><!--<img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">--><strong><?= SITENAME ?> </strong></h1></a> </span> 
                  <!--    <h1><span class="text-navy"><strong><?= SITENAME ?></strong></span></h1> -->
                </li>

            </ul>        

            <ul class="nav navbar-top-links navbar-right">



            <!--    <li>
                    <br>
                   <a href="#"><strong> Preferences</strong></a>

                </li> -->

            <li class="dropdown">
                  <br>
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                   <strong> <i class="fa fa-gears"></i>  Settings </strong>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a  data-toggle="modal" data-target="#fontModal">

                            <div>
                                <h<?= $_SESSION['fontsize'] ?> style="color:Green;"> <i class="fa fa-font"></i> Change Font Sizes [<?= $_SESSION['dfontsize'] ?>]
                                </h<?= $_SESSION['fontsize'] ?>></span>
                            </div>
                        </a>
                    </li>
                   <li class="dropdown-divider"></li>
                    <li>
                        <a  href="">

                            <div>
                                <h<?= $_SESSION['fontsize'] ?> style="color:Gray;"><i class="fa fa-times-circle"></i> Close
                                </h<?= $_SESSION['fontsize'] ?>"></span>
                            </div>
                        </a>
                    </li>
                 <!--   <li class="dropdown-divider"></li>
                    <li>
                        <a href="profile.html">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="float-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="grid_options.html">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li> -->
                </ul>
            </li> 
            
            
            <li>
                 <br>
                    <a>
                    <i class="fa fa-user"></i> (<?= $_SESSION['ccmp_username'] ?>)
                    </a>
            </li>
            <li>
                 <br>
                <a href="<?= BASE_URL ?>welcome/logout">
                 <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                </a>
            </li>
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>

        </nav>


<!-- End Top Menu   -->

<div class="modal inmodal" id="fontModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

               
                <h3 class="modal-title"> <small><i class="fa fa-pencil"></i></small> Font Sizes</h3>                   
                <h2>Enter your default font sizes:</h2>
             
            </div> 
        <!-- Show flash message then reset it to blank  -->
   <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
        $flash_msg = '';
        set_flashdata($flash_msg); ?> no way to refresh modal to see the message -->
       <center><h3 id="result" ></h3></center>

            <form action="" method = "post">  
            <div class="modal-body">
                
                <div class="form-group"> <!-- Used to pass the recid to ajax function. It is the record of the session user since changing own record always  -->                   
                    <input type="text" class="form-control" name="recid" id="recid" value="<?= $_SESSION['ccmp_rec_id'] ?>"  hidden>
                </div>
                <!--    <div class="row">
                        <div class="col-lg-8">
                        <label class="col-lg-6 col-form-label" style="color:RoyalBlue;"><h1>Enter:</h1></label>
                        </div>
                    </div> -->
                        
                        
                 <div >
                       <div class="col-lg-12">
                           <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h1>1 for Large</h1></label>
                       </div>
                         </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                 <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h2>2 for Medium</h2></label>
                       </div>
                 </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                 <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h3>3 for Small</h3></label>
                       </div>
                 </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                  <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h4>4 for X Small</h4></label>
                       </div>                         
                 </div>
                  
             
                <div class="form-group row">
             
                    <div class="col-lg-8">
                        <label class="col-lg-6 col-form-label" style="color:RoyalBlue;"><h2>For Site Pages</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <p> <input type="text" class="form-control" name="fontsize" id="xfont" value="<?= $_SESSION['fontsize'] ?>" placeholder="For Page Views" ></p>
                    </div>
                </div>
        
                <div class="form-group  row">
                
                    <div class="col-lg-8">
                        <label class="col-lg-7 col-form-label" style="color:RoyalBlue;"><h2>For Tables & Lists</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                         <input type="text" class="form-control" name="mfontsize" id="mfont" value="<?= $_SESSION['mfontsize'] ?>" placeholder="For Page Views" >
                    </div>
                    
                </div> 
                <h2>Note: You may have to refresh the page to see the new font size</h2>
  
                <!-- not passing value selected in inspinia templates js -->
        <!--     <h2>
                 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h3>For Pages</h3></label></div> 
                <div><label><input type="radio"  value="1" id="fontsize1" name="fontsize"> Large </label></div>
                <div><label><input type="radio"  value="2" id="fontsize2" name="fontsize"> Medium </label></div>                                       
                <div><label><input type="radio"  value="3" id="fontsize3" name="fontsize"> Small </label></div>
                 <div><label><input type="radio"  checked="" value="4" id="fontsize4" name="fontsize"> X Small </label></div>
            </h2> -->
                                 <!-- not passing value selected in inspinia templates js -->
                                       <!--    <div class="form-group  row"><label class="col-sm-6 col-form-label" style="color:RoyalBlue;"><h3>For Pages</h3></label>
                                              <div class="col-sm-6"><select class="form-control m-b" name="fontsize" id="font" value="<?= $_SESSION['fontsize'] ?>"  >
                                                <?php if($_SESSION['fontsize'] == '1'): ?>
                                                    <option selected value=1>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php elseif($_SESSION['fontsize'] == '2'): ?>
                                                    <option value='1'>Large</option>
                                                    <option selected value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option>                                                    
                                                <?php elseif($_SESSION['fontsize'] == '3'): ?>
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option selected value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php else: ?> 
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option selected value='4'>XSmall</option> 
                                                <?php endif; ?> 
                                                    
                                                </select>
                                               </div>                                              
                                            </div> -->
             <!--   <div class="form-group  row"><label class="col-sm-6 col-form-label" style="color:RoyalBlue;"><h3>For Tables</h3></label>
                                              <div class="col-sm-6">
                                                  <select class="form-control m-b" name="mfontsize" value="<?=  $_SESSION['mfontsize'] ?>"  >
                                                <?php if($_SESSION['mfontsize'] == '1'): ?>
                                                    <option selected value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php elseif($_SESSION['mfontsize'] == '2'): ?>
                                                    <option value='1'>Large</option>
                                                    <option selected value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option>                                                    
                                                <?php elseif($_SESSION['mfontsize'] == '3'): ?>
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option selected value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php else: ?> 
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option selected value='4'>XSmall</option> 
                                                <?php endif; ?> 
                                                </select>
                                               </div>                                              
                                            </div> -->
                
             
             <!--   <h3>Note: Refresh the page after changing the settings </h3> -->
   
            </div>
            <div class="modal-footer">
                <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="FontID" id="FontBtn" ></input> <!-- Passes posted data to template inspinia.php js at bottom  -->
                 <button type="button" class="btn btn-warning full-width m-b" data-dismiss="modal">Cancel</button>

            </div>
          </form>

        </div> 
      </div>
    </div>


