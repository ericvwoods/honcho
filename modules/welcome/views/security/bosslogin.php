
<!-- start: Header-->
 <?php include ('header.php'); ?> <!-- Use the standard header on this page -->
<!-- end: Header -->

<!--  <div class="mb40 mb20-xs"></div>  --><!-- vertical space -->  

<div class="container">
    <br>
    <br>  
    <div class="row">

    <div class="col-sm-3"> <!-- for horizontal spacing -->
    </div>
        
    <div class="col-sm-6">
        
        <div class="form-wrapper"> <!-- or "form-wrapper transparent" no light gray panel containing fields-->
            
            <?php if($_SESSION['tg_user_id'] > 0): ?>
            
            <h2> You must logout to continue:</h2>  
 <a href="<?= BASE_URL ?>welcome/logout"><button type="button" class="btn btn-dark" style='font-size: 20px;'>Logout</button></a>
 <!--  will need a -->
 
 <!-- this wont work because it will return but the trongatetoken will be missing from the cookie  -->
 <!-- <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome"><button type="button" class="btn" style='font-size: 20px;'>Back</button></a> -->
            <?php else: ?>
            
            <h1 class="title-underblock custom mb30">Login</h1>
            
            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>welcome/authenticate"> 
                
                <!-- Status Message  -->
                <div class="form-group">
                    <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?> 
                      <br>
                    <?php else: ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                      <br>
                    <?php endif; ?> 
                  
                    <!-- Input fields  -->
                    <label for="username" class="input-desc" style='font-size: 20px;'>User ID</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                    
                </div><!-- End .form-group -->
                
                <div class="form-group mb10">
                    <label for="password" class="input-desc" style='font-size: 20px;'>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                </div><!-- End .form-group -->
                
                <br>

                <div class="form-group mt15-r">
                    
                    <div class="checkbox">
                      <label class="custom-checkbox-wrapper">
                          
                        <span class="custom-checkbox-container">
                            <input type="checkbox" name="remember" id="remember" value="1">
                            <span class="custom-checkbox-icon"></span>
                        </span>
                          
                       <span style='font-size: 20px;'>Remember me</span>
                       
                      </label>
                    </div><!-- End .checkbox -->

                    <!--
                    <div class="checkbox">
                      <label class="custom-checkbox-wrapper">
                    
                        <span class="custom-checkbox-container">
                            <input type="checkbox" name="mobileformat" id="mobileformat" value="1">
                            <span class="custom-checkbox-icon"></span>
                        </span>
                    
                       <span  style='font-size: 20px;'>I'm using a mobile phone or tablet</span><br>

                      </label>
                    </div> --><!-- End .checkbox -->

                    <div class="checkbox">
                      <label class="custom-checkbox-wrapper">
                          
                        <span class="custom-checkbox-container">
                            <input type="checkbox" name="norobot" id="norobot" value="1" required>
                            <span class="custom-checkbox-icon"></span>
                        </span>
                          
                        <span style='font-size: 20px;'>I am not a robot!</span>
                       
                      </label>
                        
                    </div><!-- End .checkbox -->

                </div><!-- End .form-group -->

                <div class="form-group mb20">
             
                    <button type="submit" class="btn btn-dark" name="submit" value="Submit" style='font-size: 20px;'>Submit</button>
                    
                <!--    <a href="<?= BASE_URL ?>welcome"><button type="button" class="btn" style='font-size: 20px;'>Cancel</button></a> -->
                        
                </div><!-- End .from-group -->
            </form>
            <?php endif; ?>
            
        </div>  <!-- End .form-wrapper -->

    </div><!-- End .col-sm-6 -->

    <div class="col-sm-3"> <!-- for horizontal spacing -->
    </div>

    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb35 mb20-xs"></div><!-- vertical spacing -->

<!-- Page background image is contained in the welcome/views/security/footer.php file -->
<!-- start: Footer-->
<?php include('footer.php'); ?>                 
<!-- end: Footer -->

<!-- Display important values when in debugging mode  -->
<?php if(DEBUGGING == true): ?> 
<?php

echo('<h3>View: welcome/security/login</h3>');
echo('<h3>New Session Id</h3>');
$session_id = session_id();
echo ('<h3>'.$session_id.'</h3>');
echo('<h3>$_COOKIE</h3>');
json($_COOKIE);
echo('<br>');
echo('<h3>$_SESSION</h3>');
json($_SESSION);
echo('<h3>$data</h3>');
json($data);

?>
<?php endif; ?> 