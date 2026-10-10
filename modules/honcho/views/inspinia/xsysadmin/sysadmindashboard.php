
                            <!-- Show flash message then reset it to blank  -->
                        <!--    <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> -->

 <center><h1 class="logo-name">SysAdmin Dashboard</h1></center>

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="widget style1">
                        <div class="row">
                            <div class="col-2 text-center">
                                <i class="fa fa-group fa-5x"></i>
                            </div>
                            <div class="col-6 text-right">
                                <span> Current Members </span>
                                <h2 class="font-bold">526</h2>
                            </div>
                            <div class="col-4 text-center">
                            
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Today degrees </span>
                            <h2 class="font-bold">26'C</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-envelope-o fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> New messages </span>
                            <h2 class="font-bold">260</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-music fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> New albums </span>
                            <h2 class="font-bold">12</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



 <!-- <h3>inspinia/admins/dashboards/sysadmindashboard.php</h3> -->

<!--
<?php
        echo('tg_user_id: ');
    print_r($_SESSION['tg_user_id']);
        echo('<br>');
        echo('tg_user_level: ');
    print_r($_SESSION['tg_user_level']);
        echo('<br>');
        echo('system_acct_rec_id: ');
    print_r($_SESSION['system_acct_rec_id']);
        echo('<br>');
        echo('store_acct_rec_id: ');
    print_r($_SESSION['store_acct_rec_id']);    
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
    ?>
    -->
     <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<h3>View: welcome-ccmps/ccmphome</h3>');
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