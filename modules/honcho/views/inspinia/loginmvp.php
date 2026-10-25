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

<!-- <body class="white-bg"> -->
<!-- <body class="yellow-bg"> -->
<body class="gray-bg"> 

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
      <!--      <div>

                <h1 class="logo-name">DEV</h1>

            </div>
            <h3>Honcho Integration Platform</h3>
            <p>Development Environment</p>
            <p>A Trongate Framework Implementation</p> -->
            <div>
<!--  https://developer.mozilla.org/en-US/docs/Web/CSS/named-color -->

             <!--   <h1 class="logo-name"><?= SHORTSITENAME ?></h1> -->
                 <h1 class="logo-name" style=" color: coral;">MVP</h1>

            </div>
           <!--  <h2><?= SITENAME ?></h2> -->
              <h2>Honcho MVP</h2>
             
                <?= flashdata('<div style="font-weight: bold; color: crimson;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?>
         
            <p>Enterprise Management System</p>
           
        <div class="col-sm-1">     
                <div class="checkbox">
                  <label class="custom-checkbox-wrapper">
                    <span class="custom-checkbox-container">

   
             <!--    <span  style="color:cornflowerblue;">Login</span> -->
                   <span  style="font-weight: bold; color: lightseagreen; font-size:28pt">Login</span>
                  </label>
                </div><!-- End .checkbox -->
        </div>
            <form class="m-t" method = "post" role="form" action="<?= BASE_URL ?>honcho/authenticate">
                
                <div class="form-group">

                    <input type="text" class="form-control" name="username" value="<?= $username ?>" placeholder="Username"  required="">
                </div>
                <br>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" value="<?= $password ?>" placeholder="Password" required="">
                </div>
                <br>
                <div class="checkbox">
                  <label class="custom-checkbox-wrapper">
                    <span class="custom-checkbox-container">

                        <input type="checkbox" name="remember" id="remember" value="1">
                        <span class="custom-checkbox-icon"></span>
                    </span>
                   <span style='font-size: 20px;'>Remember me</span>
                  </label>
                </div><!-- End .checkbox -->
                
                <div class="checkbox">
                  <label class="custom-checkbox-wrapper">
                    <span class="custom-checkbox-container">

                        <input type="checkbox" name="norobot" id="norobot" value="1" required>
                        <span class="custom-checkbox-icon"></span>
                    </span>
                   <span style='font-size: 20px;'>I am not a robot!</span>
                       <div class="checkbox">


                  </div>
                </div><!-- End .checkbox -->
                <br>
                <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit" style='font-weight: bold; color: white; font-size: 20px;'>Submit</button>                                    
                <!-- <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit">Login</button> -->
                <br>
                  
                <a href="#">Forgot password?</a>
                <p></p>
         <!--       <p class="text-muted text-center"><h4>Don't have an account?</h4></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
                <p></p>
                <p></p>
          <!--      <a href="<?= BASE_URL ?>welcome"> <button type="button" class="btn btn-success block full-width m-b">Go to Website</button></a> -->
              
            </form>
            <p class="m-t"> Encore Digital Arts, LLC <small>powered by</small> hocho &copy; 2024  </p>
        </div>
    </div> 

    <!-- Mainly scripts -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
    
 
</body>

</html>

 <?php if(DEBUGGING == true): ?> 
 <?php
    echo('<h3>View: welcome/security/login</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
 <?php endif; ?>