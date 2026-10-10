<!-- Because we want to use the same header as the welcome page on all pages -->

<!-- start: Header-->
<!-- EXCEPTION: had to copy header file into donate directory in or to pass $data for the cart dropdown -->
<?php include ('header.php'); ?> 
<!-- end: Header -->

<!-- start: Header-->
<!-- ?php $layout = 'header' ?>
<= Modules::run('welcome/runlayout', $layout); ?>            
<!-- end: Header -->

<!-- Locate all images in the welcome module in a folder under assets as opposed to public so can remain modular -->
<!--     <img src="welcome_module/ghana/ghanaflyer.png" alt="Entry Title"> (can only go one level down under assets which is ghana)
vs.      <img src="<= BASE_URL ?>themes/boss/images/ghana/ghanaflyer.png" alt="Entry Title"> -->


<!-- <div id="content" role="main"> Content tags are already in header.php and footer.php -->


<div class="mb40 mb20-xs"></div><!-- space -->

            <div class="container">

                <div class="row">

                    <div class="col-sm-3">

                    </div><!-- End .col-sm-3 -->


                    <div class="col-sm-6">

                        <div class="form-wrapper">
 
                     <!--   <h2 class="title-underblock custom mb30">Create <?= CCMP ?> Account</h2> -->
                     <!--   <h2 class="title-underblock custom mb30">Create an Account</h2> -->
                     <?php if ($_SESSION['tg_user_level'] ==1 ){ ?>
                        <h2 class="title-underblock custom mb30">Create Any Account</h2>
                      <?php }else{ ?>   
                        <h2 class="title-underblock custom mb30">Create an Account</h2>
                    <?php } ?> 
                            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/create_account">
                       <!--     <?= flashdata() ?>  any errors in adding to cart -->
                       <?= validation_errors() ?>  <!-- can only appear once per page! The second instance will not show -->

                            <?php if ($_SESSION['tg_user_level'] ==1 ){ ?>
                                <div class="form-group">  
                                    <div class="radio">
                                         <label>
                                         <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                         <?= CCMP ?> Account
                                        </label>
                                    </div><!-- end .radio -->

                                     <div class="radio">
                                          <label>
                                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                          Shopping or Donor Account
                                          </label>
                                    </div><!-- end .radio -->                            
                                    <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                        System Account
                                    </label>
                                    </div><!-- end .radio -->
                                </div><!-- End .form-group --> 
                            <?php }else{ ?>   
                                    <!-- Uncomment if you want them to be able to create their own system account-->
                                    <h3>Please select an account type:</h3>

                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        <?= CCMP ?> Account
                                        </label>
                                    </div><!-- end .radio -->

                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                            Donor or Shopping Account
                                        </label>
                                    </div><!-- end .radio -->
                                </div><!-- End .form-group --> 
                            <?php } ?>                       
                                                
                        <?php if ($_SESSION['tg_user_level'] ==1 ){ ?>
                          
                            <div class="form-group mb10">
                                <label for="userlevel" class="input-desc">Choose A User Level for System accounts</label> 
                                <select name='userlevel' class="form-control"> 

                                    <!--   <option>Select for Other System Accounts only</option> -->
                    
                                        <?php foreach($tguleveldpdwn as $row) { ?>
                                            <option value="<?= $row->id ?>"><?= $row->level_title ?></option>
                                        <?php } ?>

                                </select>
                             </div><!-- End .from-group -->
                             <?php }else{ ?>  <!-- If not a sysadmin then must be a CCMP account  -->
                                <div class="form-group mb10">
                             <!--   <label for="userlevel" class="input-desc">User Level</label> -->
                                <input type="hidden" class="form-control" id="userlevel" name="userlevel" value="2">
                            </div><!-- End .from-group -->
                                
                             <?php } ?> 

                            <div class="form-group mb10">
                                <label for="firstname" class="input-desc">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" required>
                            </div><!-- End .from-group -->

                            <div class="form-group mb10">
                                <label for="lastname" class="input-desc">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" required>
                            </div><!-- End .from-group --> 

                            <?php if ($_SESSION['tg_user_level'] ==1 ){ ?>
                                <div class="form-group mb10">
                                    <label for="username" class="input-desc">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                                </div><!-- End .from-group -->
                                <div class="form-group mb10">
                                    <label for="email" class="input-desc">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="valid email address" required>
                                </div><!-- End .from-group -->
                            <?php }else{ ?> 
                                <div class="form-group mb10">
                                    <label for="username" class="input-desc">Username</label>
                                    <input type="email" class="form-control" id="username" name="username" placeholder="valid email address" required>
                                </div><!-- End .from-group -->
                            <?php } ?>

                            <div class="form-group mb10">
                                <label for="password" class="input-desc">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                            </div><!-- End .from-group -->

                            <div class="form-group mb10">
                                <label for="password" class="input-desc">Repeat Password</label>
                                <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="password" required>
                                <br>
                                <div class="checkbox">
                                    <label class="custom-checkbox-wrapper">
                                    <span class="custom-checkbox-container">                                   
                                        <input type="checkbox" name="norobot" id="norobot" value="1" required>
                                        <span class="custom-checkbox-icon"></span>
                                    </span>
                                    <span>I am not a robot!</span>
                                    </label>
                                </div><!-- End .checkbox -->
                            </div><!-- End .from-group -->

                                <div class="mb10 mb20-xs"></div><!-- space -->
                                <div class="form-group mb10">
                                 <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-dark" name="submit" value="Submit">Create Account</button>
                                    <a href="<?= BASE_URL ?>welcome"><button type="button" class="btn" >Cancel</button></a>
                                </div><!-- End .from-group -->
                            </form>

                        </div><!-- End .form-wrapper -->                       

                    </div><!-- End .col-sm-6 -->

                    <div class="col-sm-3">
                    </div><!-- End .col-sm-3 -->


                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb40 mb20-xs"></div><!-- space -->

    <!--    </div><!-- End #content --> <!-- End content tag is already in the footer -->

<!-- Because we want the flxibility of using a different background on the page we are using a local footer -->
<!-- start: Footer-->
<?php include('footer.php'); ?>                 
<!-- end: Footer -->
 