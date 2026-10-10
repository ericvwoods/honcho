<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>BPA Login</title>
        <meta name="description" content="Multipurpose, premium, bootstrap based bussiness, corporate, portfolio, blog, onepage, creative, magazine, personal, landing, coming soon html5 css3 template">

        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,400italic,600italic,700italic,600,800,300,700,800italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <!-- Google Fonts -->
        
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/animate.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/style.css">
        <link rel="stylesheet" id="color-scheme" href="<?= BASE_URL ?>themes/boss/css/colors/green.css">
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="<?= BASE_URL ?>themes/boss/images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx72.png">
        
        <!-- Modernizr -->
        <script src="<?= BASE_URL ?>themes/boss/js/modernizr.js"></script>

        <!--- jQuery -->
        <script src="<?= BASE_URL ?>themes/boss/js/jquery.min.js"></script>

        <!-- Queryloader -->
        <script src="<?= BASE_URL ?>themes/boss/js/queryloader2.min.js"></script>
	    
    </head>
    <body>
    <div class="boss-loader-overlay"></div><!-- End .boss-loader-overlay -->

    <div id="login-section" class="fullheight"  data-bgattach="<?= BASE_URL ?>themes/boss/images/bosshoncho/rwy241920x1440.jpg">
        <div class="vcenter-container">

            <div class="vcenter">

                <div class="container">

                    <div class="row">

                        <div class="col-sm-6 col-sm-push-3 col-lg-4 col-lg-push-4">
                        
                        
                               
                            <h1 class="logo text-center">
                                <a href="#" title="none">
                                    <img src="<?= BASE_URL ?>welcome_module/images/bpalogo169x50.jpg" alt="aymp portal login">
                                </a>
                            </h1>
                            <div class="form-wrapper transparent">
                                <form method = "post" action="<?= BASE_URL ?>welcome/authenticate/mobiccmp">
                                    <div class="form-group">
                                        <label for="username" class="input-desc text-white">Username</label>
                                        <input type="text" class="form-control input-border-bottom white" id="username" name="username" placeholder="" required>
                                    </div><!-- End .from-group -->
                                    <div class="form-group mb10">
                                        <label for="password" class="input-desc text-white">Password</label>
                                        <input type="password" class="form-control input-border-bottom white" id="password" name="password" placeholder=""  required>
                                  </div><!-- End .from-group -->
                                <!--    <div class="form-group">
                                        <label for="username" class="input-desc text-white">Role</label>
                                        <input type="text" class="form-control input-border-bottom white" id="role_id" name="role_id" placeholder="" value="<?= $role_id ?>" required>
                                    </div> --><!-- End .from-group -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control input-border-bottom white" id="frmpg" name="frmpg" placeholder="" value="bosslogin" required>
                                    </div><!-- End .from-group -->
                                    <div class="form-group text-right clear-margin helper-group">
                                        <a href="recover-password.html" title="Recover Password">Forget password?</a>
                                    </div><!-- End .form-group -->
                                    <div class="form-group mt15-r">
                                        <div class="checkbox white text-white">
                                          <label class="custom-checkbox-wrapper">
                                            <span class="custom-checkbox-container">
                                                <input type="checkbox" name="remember" id="remember" value="true">
                                                <span class="custom-checkbox-icon"></span>
                                            </span>
                                           <span>Remember Me!</span>
                                          </label>
                                        </div><!-- End .checkbox -->
                                    </div><!-- End .form-group -->
                                    <div class="form-group mt15-r">
                                        <div class="checkbox white text-white">
                                          <label class="custom-checkbox-wrapper">
                                            <span class="custom-checkbox-container">
                                                <input type="checkbox" name="norobot" id="norobot" value="1" required>
                                                <span class="custom-checkbox-icon"></span>
                                            </span>
                                           <span>I am not a robot!</span>
                                          </label>
                                        </div><!-- End .checkbox -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group xss-margin text-center">
                                        <input type="submit" class="btn btn-sm btn-white btn-border btn-block no-radius" value="Submit">
                                    </div><!-- End .from-group -->
                                </form>
                            </div><!-- End .form-wrapper -->
                        </div><!-- End .col-sm-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .vcenter -->
        </div><!-- End .vcenter-container -->
    </div><!-- End .fullheight -->

	<!-- END -->
    <script src="<?= BASE_URL ?>themes/boss/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.hoverIntent.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.nicescroll.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/waypoints.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/waypoints-sticky.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.debouncedresize.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/retina.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/owl.carousel.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jflickrfeed.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/twitter/jquery.tweet.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/main.js"></script>
	
    </body>
</html>