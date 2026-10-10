<!-- mobilogin.php   -->

<div class="mb40 mb20-xs"></div><!-- space -->

            <div class="container">

                <div class="row">

                <div class="col-sm-3">
                </div>
                    <div class="col-sm-6">
                        <div class="form-wrapper">

                         <!--   <h2 class="title-underblock custom mb30"><?= CCMP ?> Login</h2> -->
                   
                            <center><h2>Black Pilots of America</h2> </center>
                        <!--    <center><h3>&</h3> </center>
                             <center><h3>Prime Time Woman Circles</h3> </center> -->
                            <center><h3></h3> </center>
                         <br>
                       <!--    <img alt="gandplogo" src="<?= BASE_URL ?>modules/welcome/views/gandplogo.png" /> --> <!--- wont see it -->
                            <center><img alt="bpalogo" src="<?= BASE_URL ?>mobi/bpalogo125x103.jpg" /></center> 

                                             
<br>

                            <center><h3>For Security Please Provide:</h3></center>
                            <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 

                           <?= validation_errors() ?>  <!-- can only appear once per page!  The second instance will not show -->
                   
          <form class="form-horizontal" action="<?= BASE_URL ?>welcome/validate2nd" method="post" enctype="multipart/form-data"> 
    <!--        <php endif; ?>  -->                                                 
                                <div class="form-group">
                                    <label for="username" class="input-desc">Member Number</label>
                                    <input type="text" class="form-control" id="member_number" name="member_number" required>
                                <!--    <input type="text" class="form-control" id="username" name="username" placeholder="email address" required> -->
                                </div><!-- End .from-group -->


                                <div class="mb10 mb20-xs"></div><!-- space -->
                            <div class="form-group mb10">
                                    <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-dark" name="submit" value="Submit">Submit</button>
                                    <a href="<?= BASE_URL ?>welcome/login"><button type="button" class="btn" >Cancel</button></a>
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
 