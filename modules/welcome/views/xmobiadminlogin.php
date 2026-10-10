<!-- mobilogin.php   -->

<div class="mb40 mb20-xs"></div><!-- space -->

            <div class="container">

                <div class="row">

                <div class="col-sm-3">
                </div>
                    <div class="col-sm-6">
                        <div class="form-wrapper">

                         <!--   <h2 class="title-underblock custom mb30"><?= CCMP ?> Login</h2> -->

                            <br>
                            <center><h3>Prime Time Sister Circles</h3> </center>
                        <!--    <center><h3>&</h3> </center>
                             <center><h3>Prime Time Woman Circles</h3> </center> -->
                            <center><h3>presented by</h3> </center>
                            <br>
                       <!--    <img alt="gandplogo" src="<?= BASE_URL ?>modules/welcome/views/gandplogo.png" /> --> <!--- wont see it -->
                            <center><img alt="gandplogo" src="<?= BASE_URL ?>mobi/gandplogo480x123.png" /></center> 

                                                

                            <h2 class="title-underblock custom mb30">Please Sign In</h2>

                            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/authenticate/"> 
                        <!--    <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>ccmps/authenticate/"> -->
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

                           <?= validation_errors() ?>  <!-- can only appear once per page!  The second instance will not show -->            
                                                  
                                <div class="form-group">
                                    <label for="username" class="input-desc">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                <!--    <input type="text" class="form-control" id="username" name="username" placeholder="email address" required> -->
                                </div><!-- End .from-group -->
                                <div class="form-group">
                                    <label for="password" class="input-desc">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                </div><!-- End .from-group -->

                                <div class="form-group">
                                    <input id="sysuser" name="sysuser" type="text" class="form-control" value=1 hidden>
                                </div> 

                                <div class="form-group text-left clear-margin helper-group"> <!-- Very Small Red Text -->
                                    <a href="<?= BASE_URL ?>welcome/forgot_password/">Forgot your User Name or Password?</a>
                                </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <span>I'm using a:</span>
                                        
                                      <!--  <div><label>  For a better experience what type of device are you using? </label></div> -->
                                        <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> <label> Phone </label> 
                                        <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> <label> Tablet/Laptop/Computer </label> 
                                    </div>

                                </div><!-- End .form-group -->
                                <div class="mb10 mb20-xs"></div><!-- space -->
                            <div class="form-group mb10">
                                    <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-dark" name="submit" value="Submit">Sign In Now</button>
                                    <a href="<?= BASE_URL ?>welcome/mobiadminlogin"><button type="button" class="btn" >Cancel</button></a>
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
<!-- <php include('footer.php'); ?> -->                
<!-- end: Footer -->
 