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
                </div>
                    <div class="col-sm-6">
                        <div class="form-wrapper">

                         <!--   <h2 class="title-underblock custom mb30"><?= CCMP ?> Login</h2> -->
                            <h2 class="title-underblock custom mb30">Verify Email Address</h2>
                            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/verify_email/"> 
                        <!--    <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>ccmps/authenticate/"> -->
                        <?= flashdata();
				            $flash_msg = '';
				            set_flashdata($flash_msg); ?>

                           <?= validation_errors() ?>  <!-- can only appear once per page!  The second instance will not show -->


                        <!--   <h3>Please select your account type:</h3>
                                <div class="form-group">

                                <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                <?= CCMP ?> Account
                            </label>
                        </div><!-- end .radio --

                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Store or Donor Account
                            </label>
                        </div><!-- end .radio --
                        </div><!-- End .form-group -->
                                                  
                                <div class="form-group">
                                   <label for="username" class="input-desc">Enter your email address and </label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="email address" required>
                                </div><!-- End .from-group -->

                                <div class="form-group mt15-r">
                                    <div class="checkbox">
                                      <label class="custom-checkbox-wrapper">
                                        <span class="custom-checkbox-container">
                                     
                                            <input type="checkbox" name="norobot" id="norobot" value="1" required>
                                            <span class="custom-checkbox-icon"></span>
                                        </span>
                                       <span>I am not a robot!</span>
                                      </label>
                                    </div><!-- End .checkbox -->
                                </div><!-- End .form-group -->
                                <div class="mb10 mb20-xs"></div><!-- space -->
                            <div class="form-group mb10">
                                    <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-dark" name="submit" value="Submit">Register for an Account</button>
                                    <a href="<?= BASE_URL ?>welcome"><button type="button" class="btn" >Cancel</button></a>
                                </div><!-- End .from-group -->
                            </form>
                        </div><!-- End .form-wrapper -->

                    </div><!-- End .col-sm-6 -->

                <div class="col-sm-3">
                </div>

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb40 mb20-xs"></div><!-- space -->

    <!--    </div><!-- End #content --> <!-- End content tag is already in the footer -->

<!-- Because we want the flxibility of using a different background on the page we are using a local footer -->
<!-- start: Footer-->
<?php include('footer.php'); ?>                 
<!-- end: Footer -->
 