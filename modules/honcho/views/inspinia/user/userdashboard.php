
<!--
 <form action="" method = "post">
                            
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xcrpass" id="xcrpass" value="<?= $crpass ?>" placeholder="Current Password" >
                                    </div>                                    
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xnpass" id="xnpass" value="<?= $npass ?>" placeholder="New Password" >
                                    </div>  
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="xcpass" id="xcpass" value="<?= $cpass ?>" placeholder="Confirm New Password" >
                                    </div>  
                              
  <input type="button" value="AJAX Change Password"class="btn btn-primary block full-width m-b" name="xChangeID" id="xChangeBtn" ></input>
</form>
<h2 id="result"> </h2>  -->

 <!--<center><h1 class="logo-name">User Dashboard</h1></center> -->
<!-- <!DOCTYPE html>  -->

<head>
    <!-- Live!  -->
<script 
  src="https://www.paypal.com/sdk/js?client-id=BAAtkADTiIVx_23r5URdzoziqOm9qXLeCCnaTl2f9TvjWZa7La-VFwlE1MxyPxApQvbkRrSgiruz525nMQ&components=hosted-buttons&enable-funding=venmo&currency=USD">
</script>
 </head>
 <body>

<span hidden><?= $total_amt = 50; ?></span>  

<div class="ibox-content">

  <h2>Your total due is $<?= $total_amt ?> </h2>
<div id="paypal-container-URUG4DJCDRL5E"></div>

 </div> 
<script>
  paypal.HostedButtons({
    hostedButtonId: "URUG4DJCDRL5E",
  }).render("#paypal-container-URUG4DJCDRL5E")
</script>




<!-- Live ATXQadn-SAvTI8GhDEBOYSdaGDKzTc_YvSbqhZjbtt6lb7jYkhCWiK0xKeoQtUvEOTPlMU9JSzzLaeDd
Test
    ARwYHmMq7GYi-XbURKmH2zrwL1J0M8of_a3Tk2JrMM3nREovlbFX2H5wqXHouyyTANW0DZIC6gKCnrb0
 -->

</body>  



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