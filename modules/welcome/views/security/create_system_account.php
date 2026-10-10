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
                        <h2 class="title-underblock custom mb30">Create System Account</h2>

                    <!--        <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/store_create_account/">  split this off and change this to create user account -->
                            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/create_user_account">
                       <!--     <?= flashdata() ?>  any errors in adding to cart -->
                       <?= validation_errors() ?>  <!-- can only appear once per page! The second instance will not show -->
                                <div class="form-group">
                                    <label for="username" class="input-desc">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="email address" required>
                                </div><!-- End .from-group -->
                                <div class="form-group mb10">
                                    <label for="password" class="input-desc">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div><!-- End .from-group -->
                                <div class="form-group mb10">
                                    <label for="password" class="input-desc">Repeat Password</label>
                                    <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Password" required>
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
 