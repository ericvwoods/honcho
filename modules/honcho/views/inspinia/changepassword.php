<!-- Because we want to use the same header as the welcome page on all pages -->

<!-- start: Header-->
<!-- EXCEPTION: had to copy header file into donate directory in or to pass $data for the cart dropdown -->
<!-- <php include ('header.php'); ?> -->
<!-- end: Header -->

<!-- start: Header-->
<!-- ?php $layout = 'header' ?>
<= Modules::run('welcome/runlayout', $layout); ?>            
<!-- end: Header -->

<!-- Locate all images in the welcome module in a folder under assets as opposed to public so can remain modular -->
<!--     <img src="welcome_module/ghana/ghanaflyer.png" alt="Entry Title"> (can only go one level down under assets which is ghana)
vs.      <img src="<= BASE_URL ?>themes/boss/images/ghana/ghanaflyer.png" alt="Entry Title"> -->


<!-- <div id="content" role="main"> Content tags are already in header.php and footer.php -->
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password</title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">

            <div class="container">

                <div class="row">

                 <!--   <div class="col-sm-1">

                    </div> --><!-- End .col-sm-1 -->


                    <div class="col-sm-12">

                        <div class="form-wrapper">
                      <span style=" color: coral; font-size: 100px;"><?= SHORTSITENAME ?></span> <!--  font-weight: bold;  -->
        
                            
<div class="mb0 mb20-xs"></div><!-- space -->
                        <div class="title-underblock custom mb30" style="font-size: 30px; color: darkgray;">Change Password</div>
<br>
                            <form class="form-horizontal" method = "post" action="<?= BASE_URL ?>honcho/changepassword">
                                <h3>
   <?php if($_SESSION['flashmsgcolor'] == 1): ?> 
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php else: ?>
     <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); 
     $flash_msg = '';
     set_flashdata($flash_msg); ?> 
   <?php endif; ?>
                       <?= validation_errors() ?>  
                                </h3><!-- can only appear once per page! The second instance will not show -->
                                <br>
                                <div class="form-group mb10">
                                    <label for="password" class="input-desc"><h3>Current Password</h3></label>
                                    <input type="password" class="form-control" id="currentpassword" name="resetpassword" placeholder="" required>
                                </div><!-- End .from-group -->
 <br>
                                <div class="form-group mb10">
                                    <label for="password" class="input-desc"><h3>New Password</h3></label>
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="" required>
                                    </div><!-- End .from-group -->
                                     <br>
                                    <div class="form-group mb10">
                                    <label for="password" class="input-desc"><h3>Repeat New Password</h3></label>
                                    <input type="password" class="form-control" id="repeatnewpassword" name="confirmpassword" placeholder="" required>
                                    </div><!-- End .form-group --> 

                                    <div class="col-sm-8"><input name="resetusername" type="text" class="form-control" value="<?= $resetusername ?>" hidden></div>
            
                                   <div class="form-group text-left clear-margin helper-group">
                                       <br>
                                   <h3> <div class="checkbox">
                                      <label class="custom-checkbox-wrapper">
                                        <span class="custom-checkbox-container">                                   
                                            <input type="checkbox" name="norobot" id="norobot" value="1" required>
                                            <span class="custom-checkbox-icon"></span>
                                        </span>
                                       <span>I am not a robot!</span>
                                      </label>
                                    </div><!-- End .checkbox -->
                                    </h3>
                                </div><!-- End .from-group -->

      <br>
                                <div class="form-group mb10">
                                 <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                    <button type="submit" class="btn btn-primary" name="submit" value="Submit"><h3>Submit</h3></button>
                                    <a href="<?= BASE_URL ?>honcho"><button style="color:darkgray;" type="button" class="btn btn-dark btn-outline" ><h3>Cancel</h3></button></a>
                                </div><!-- End .from-group -->
                            </form>

                        </div><!-- End .form-wrapper -->                       

                    </div><!-- End .col-sm-6 -->

                 <!--   <div class="col-sm-1">
                    </div> --><!-- End .col-sm-3 -->


                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb40 mb20-xs"></div><!-- space -->
    </div>
    
 
 <?php if(DEBUGGING == true): ?> 
 <?php
  echo('<br>');
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
    
    
    </body>
    <!--    </div><!-- End #content --> <!-- End content tag is already in the footer -->

<!-- Because we want the flxibility of using a different background on the page we are using a local footer -->
<!-- start: Footer-->
<!-- <php include('footer.php'); ?> -->                
<!-- end: Footer -->
 