<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= SHORTSITENAME ?> Second Factor</title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

</head>

<!-- <body class="white-bg"> -->
<!-- <body class="yellow-bg"> -->
<body class="gray-bg">





    <div class="middle-box text-center loginscreen animated fadeInDownBig">
        <div>
             <!--   <h1 class="logo-name"><?= SHORTSITENAME ?></h1> -->
               <h1 style=" color: crimson; font-size: 72px"> <?= SHORTSITENAME ?></h1><h2  style=" color: lightseagreen; font-size: 40px"> <?= SITENAME4 ?></h2>
            <h2>For Added Security Enter:</h2>

                <!-- Status Message  -->
                <div class="form-group">
                    <?php if($_SESSION['flashmsgcolor'] == 1): ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: lightseagreen;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                      <br>
                    <?php else: ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: crimson;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                      <br>
                    <?php endif; ?>

                       <!-- wipe out session variables after using session variables needed to display msg -->


          <form class="form-horizontal" action="<?= BASE_URL ?>welcome/secondfactor_check" method="post" enctype="multipart/form-data">

                 <?php if($_SESSION['acct_table'] == 'ccmps'): ?>
         <div class="col-sm-12">
             <!--   <div class="checkbox"> -->

               <!--   <label class="custom-checkbox-wrapper"> -->

                   <span  style="font-weight: bold; color: lightseagreen; font-size:18pt"><?= CCMP_SECOND_FACTOR_NAME  ?></span>
               <!--   </label> -->

             <!--   </div> -->  <!-- End .checkbox -->
        </div>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" id="member_number" name="second_factor"  required="">
                </div><!-- End .from-group -->

                    <?php endif; ?>

                  <?php if($_SESSION['acct_table'] == 'honcho_user_accounts'): ?>
                      <div class="col-sm-12">
             <!--   <div class="checkbox"> -->

               <!--   <label class="custom-checkbox-wrapper"> -->

                   <span  style="font-weight: bold; color: lightseagreen; font-size:18pt"><?= SYSTEM_SECOND_FACTOR_NAME  ?></span>
               <!--   </label> -->

             <!--   </div> -->  <!-- End .checkbox -->
        </div>
                                <div class="form-group">
                                    <label for="username" class="input-desc"></label>
                                    <input type="text" class="form-control" id="member_number" name="second_factor" required>
                                </div><!-- End .from-group -->
                  <?php endif; ?>
                             <!--   <php  $_SESSION = array(); ?> -->
                                <br>

                            <div class="form-group mb10">
                                    <!--   <input type="submit" class="btn btn-dark" name="submit"  value="Create Account">  must change in controller to look for Create Account and not Submit-->
                                   <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit" style='font-weight: bold; color: white; font-size: 20px;'>Submit</button>
                              <!--      <a href="<?= BASE_URL ?>welcome/logout"><button type="button" class="btn" >Cancel</button></a> -->
                                </div><!-- End .from-group -->
            </form>
                      <p class="m-t"> <?= SITENAME ?></p>
                      <p><small>powered by</small> hocho &copy; 2023  </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>


</body>

</html>

<!-- Display important values when in debugging mode  -->

<?php define('DEBUGGING', false); ?>

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
