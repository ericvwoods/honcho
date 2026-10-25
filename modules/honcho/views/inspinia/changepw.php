<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">

        <div>
           
                            <br>
                            <center><h3>Prime Time Sister Circles</h3> </center>
                        <!--    <center><h3>&</h3> </center>
                             <center><h3>Prime Time Woman Circles</h3> </center> -->
                            <center><h3>presented by</h3> </center>
                            <br>
                       <!--    <img alt="gandplogo" src="<?= BASE_URL ?>modules/welcome/views/gandplogo.png" /> --> <!--- wont see it -->
                            <center><img alt="gandplogo" src="<?= BASE_URL ?>mobi/gandplogo480x123.png" /></center> 

                                                <br>

                            <h2 class="title-underblock custom mb30">Please Sign In</h2>


            <form class="m-t" method = "post" role="form" action="<?= BASE_URL ?>honcho/changepw">
                <div class="form-group">

                <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?>
                <br>
                <div class="form-group">
                    <input type="password" class="form-control" name="resetpassword" value="<?= $resetpassword ?>" placeholder="Reset Password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="newpassword" value="<?= $newpassword ?>" placeholder="New Password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="resetusername" value="<?= $resetusername ?>" 
                    hidden >
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit">Submit</button>
                <a class="btn btn-sm btn-white btn-block" href="<?= BASE_URL ?>honcho/login">Cancel</a>

              
            </form>
            <p class="m-t"> <small>Encore Digital Arts, LLC &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>

</body>

</html>

<!--
<?php
        echo('tg_user_id: ');
    print_r($_SESSION['tg_user_id']);
        echo('<br>');
        echo('tg_user_level: ');
    print_r($_SESSION['tg_user_level']);
        echo('<br>');
        echo('role_id: ');
    print_r($_SESSION['role_id']);
        echo('<br>');
        echo('whoisit: ');
    print_r($_SESSION['whoisit']);
        echo('<br>');
        echo('key: ');
    print_r($_SESSION['key']);  // data at rest encryption key
        echo('<br>');
        echo('logged_in: ');
    print_r($_SESSION['logged_in']);
        echo('<br>');
        echo('store_logged_in: ');
    print_r($_SESSION['store_logged_in']);
        echo('<br>');
        echo('system_logged_in: ');
    print_r($_SESSION['system_logged_in']);
        echo('<br>');
        echo('store_username: ');
    print_r($_SESSION['store_username']);
        echo('<br>');
        echo('system_username: ');
    print_r($_SESSION['system_username']);
        echo('<br>');
        echo('store_acct_rec_id: ');
    print_r($_SESSION['store_acct_rec_id']);
        echo('<br>');
        echo('system_acct_rec_id: ');       
    print_r($_SESSION['system_acct_rec_id']);
        echo('<br>');
        echo('jobtitle: ');
    print_r($_SESSION['jobtitle']);
        echo('<br>');
        echo('first_name: ');
    print_r($_SESSION['first_name']);
        echo('<br>');
        echo('user_photo: ');
    print_r($_SESSION['user_photo']);
        echo('<br>');
        echo('cartitems: ');
    print_r($_SESSION['cartitems']);
        echo('<br>');
        echo('grand_total: ');
    print_r($_SESSION['grand_total']);
            echo('<br>');
    print_r($data);
    ?> -->
