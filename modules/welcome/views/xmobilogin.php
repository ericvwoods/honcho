<!-- mobilogin.php   -->

<div class="mb40 mb20-xs"></div><!-- space -->

            <div class="container">

                <div class="row">

                <div class="col-sm-3">
                </div>
                    <div class="col-sm-6">
                        <div class="form-wrapper">


                                                   <center> <h2>Black Pilots of America</h2></center>
                                                   <br>
                            <center><img alt="bpalogo" src="<?= BASE_URL ?>mobi/bpalogo125x103.jpg" /></center> 

                                             

                            <h3 class="title-underblock custom mb30">Please Sign In </h3>
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

                           <?= validation_errors() ?>  <!-- can only appear once per page!  The second instance will not show -->
                      <!--      <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/authenticate"> -->
                       <!--     <form class="form-horizontal" method = "post" action=""> -->
                       <!--     <?php echo form_open_upload('welcome/authenticate'); ?> -->
    <!--        <php if(DEFAULT_ENGINE = 'old'): ?>   -->                     
          <form class="form-horizontal" action="<?= BASE_URL ?>welcome/authenticate" method="post" enctype="multipart/form-data"> 
    <!--        <php endif; ?>  -->                                                 
                                <div class="form-group">
                                    <label for="username" class="input-desc">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                <!--    <input type="text" class="form-control" id="username" name="username" placeholder="email address" required> -->
                                </div><!-- End .from-group -->

                                <div class="form-group">
                                    <label for="password" class="input-desc">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                </div><!-- End .from-group -->
    <br>
                                <div class="form-group text-left clear-margin helper-group"> <!-- Very Small Red Text -->
                                    <a href="<?= BASE_URL ?>welcome/forgot_password/">Forgot your User Name or Password?</a>
                                </div><!-- End .form-group -->

                                <div class="form-group"> <!--  Green Text -->
                                <!--    <a href="<= BASE_URL ?>welcome/ca">Need a PTSC <?= CCMP ?> Account?</a> -->
                                    <a href="<?= BASE_URL ?>welcome/ca">Need an Account?</a>                    
                                </div><!-- End .form-group  -->

                            <!-- No self registration -->
                            <!--    <div class="form-group">
                                <a href="<= BASE_URL ?>welcome/ca">Need Donor or Store Account?</a>
                                </div> -->
                                
                           <!--     <div class="form-group mt15-r">
                                    <div class="checkbox">
                                      <label class="custom-checkbox-wrapper">
                                        <span class="custom-checkbox-container">
                                     
                                            <input type="checkbox" name="remember" id="remember" value="1">
                                            <span class="custom-checkbox-icon"></span>
                                        </span>
                                       <span>Remember me</span>
                                      </label>
                                    </div> End .checkbox -->

                                <!--    <div class="checkbox">
                                      <label class="custom-checkbox-wrapper">
                                        <span class="custom-checkbox-container">
                                     
                                            <input type="checkbox" name="norobot" id="norobot" value="1" required>
                                            <span class="custom-checkbox-icon"></span>
                                        </span>
                                       <span>I am not a robot!</span>
                                      </label>
                                    </div>< End .checkbox -->


                                    <div class="form-group">
                                  <!--      I'm using a: Phone/iPad/Tablet -->
                                      <!--  <div><label>  For a better experience what type of device are you using? </label></div> --><input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios" hidden>
                                  <!--       ...or Computer/Laptop -->
                                    </div>
                                </div><!-- End .form-group -->



                                <div class="mb10 mb20-xs"></div><!-- space -->
                            <div class="form-group mb10">
                                    <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-dark" name="submit" value="Submit">Submit</button>
                                    <a href="<?= BASE_URL ?>welcome/mobilogin"><button type="button" class="btn" >Cancel</button></a>
                                </div><!-- End .from-group -->

                            <!--    <center><a href="http://www.amazon.com/exec/obidos/tg/detail/-/0345432150/qid=1041850968/sr=12-1/102-3717357-2068906?v=glance&s=books">Click to Purchase<img alt="ptbook" src="<?= BASE_URL ?>mobi/ptbook480x176.png" img alt="ptbook" src="<?= BASE_URL ?>mobi/ptbook480x176.png" /></a></center> -->
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
<!-- <php include('footer.php'); ?> -->                
<!-- end: Footer -->
 