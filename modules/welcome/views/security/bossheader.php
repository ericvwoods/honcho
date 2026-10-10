<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Line 6 title</title>
        <meta name="description" content="Multipurpose">

        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,400italic,600italic,700italic,600,800,300,700,800italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <!-- Google Fonts -->

        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/font-awesome.css">

        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/animate.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/magnific-popup.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/mediaelementplayer.css">        
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/style.css">
        
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/jquery.kwicks.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/revslider/revslider-index5.css">   

        <!-- Defaults to blue  -->     
   <!--     <link rel="stylesheet" id="color-scheme" href="<?= BASE_URL ?>themes/boss/css/colors/green.css"> -->
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="<?= BASE_URL ?>themes/boss/images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx72.png">
        
        <!-- Modernizr --
        <script src="<?= BASE_URL ?>themes/boss/js/modernizr.js"></script>

        <!--- jQuery --
        <script src="<?= BASE_URL ?>themes/boss/js/jquery.min.js"></script>

        <!-- Queryloader --
        <script src="<?= BASE_URL ?>themes/boss/js/queryloader2.min.js"></script>  -->
	    
    </head>
    <body>
   
    <br>
    <br>    
    <br>
    
    <div class="boss-loader-overlay"></div><!-- End .boss-loader-overlay -->
    <div id="wrapper" class="boxed">
        <header id="header" class="no-border" role="banner">
            <div class="collapse navbar-white" id="header-search-form">
                <form class="navbar-form animated fadeInDown" >
                    <input type="search" id="s" name="s" class="form-control" placeholder="Search in here...">
                    <button type="submit" title="Search"><i class="fa fa-search"></i></button>
                </form>
            </div><!-- End #header-search-form -->
            <nav class="navbar navbar-white animated-dropdown ttb-dropdown" role="navigation">
              
                <div class="navbar-top clearfix">
                    <div class="container-fluid">
                        <div class="pull-left">

                            <div class="social-icons hidden-xs">
                            <a href="<?= EXT_WEBSITE ?>" target="_blank"><?= SITENAME ?></a> 
                            <a href="#" class="social-icon icon-facebook" title="Facebook"> <!-- Not used - just renders slash for spacing  -->
                                <!--    <i class="fa fa-facebook"></i> -->
                                </a>
                                <a href="<?= FACEBOOK_URL?>" class="social-icon icon-facebook" title="Facebook" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="<?= TWITTER_URL?>" class="social-icon icon-twitter" title="Twitter" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="<?= YOUTUBE_URL?>" class="social-icon icon-youtube" title="YouTube" target="_blank">
                                    <i class="fa fa-youtube"></i>
                                </a>


                        <!--        <a href="#" class="social-icon icon-google-plus" title="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                                <a href="#" class="social-icon icon-dribbble" title="Dribbble">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                                <a href="#" class="social-icon icon-reddit" title="Reddit">
                                    <i class="fa fa-reddit"></i>
                                </a>
                                <a href="#" class="social-icon icon-skype" title="Skype">
                                    <i class="fa fa-skype"></i> -->
                                </a>
                            </div><!-- End .social-icons -->

                        </div><!-- End .pull-left -->


                        <div class="pull-right">
     <!-- Insert starts here -->                       
                        <?php if ($_SESSION['tg_user_id'] > 0){ ?>  
                            <div class="dropdown account-dropdown pull-right">
                                <a class="dropdown-toggle" href="#" id="account-dropdown" data-toggle="dropdown" aria-expanded="true">
                                       
                                
                                    <a href="<?= BASE_URL ?>welcome/logout">(<?= $_SESSION['ccmp_username'] ?>)  <strong>Logout</strong></a> 
                              <!--  <span class="angle"></span> -->
                                </a> 
                                <ul class="dropdown-menu" role="menu" aria-labelledby="account-dropdown">
                               <!--    <li role="presentation"><a role="menuitem" tabindex="-1" href="shop-dashboard.html">My Account</a></li> -->
<!-- Not needed w/line 92 --> <?php if ($_SESSION['tg_user_id'] > 0){ ?>                                         
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= BASE_URL ?>welcome/logout/compccmp">Logout </a></li>
                                <!--    <li role="presentation"><a role="menuitem" tabindex="-1" href="my_account">My Account</a></li> -->
                                <?php }else{ ?>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="login">Login</a></li>
                                   
                                <!--    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= BASE_URL ?>welcome/mobilogin">Mobile Login </a></li> --> <!-- why doesnt this need welcome/ and the other 2 above do?-->
                                <?php } ?> 

                                <!--    <li role="presentation"><a role="menuitem" tabindex="-1" href="dashboards">Admin</a></li> -->
                             <!--       <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Wishlist</a></li> -->
                                </ul>
                            </div><!-- End .account-dropdown -->
        <?php }else{ ?>
                      <a href="<?= BASE_URL ?>honcho/login" target="_blank"><strong>Admin Login</strong></a> 
                      <a href="<?= BASE_URL ?>honcho/loginmvp" target="_blank"><strong>MVP Login</strong></a> 
            <?php if( ENV == 'dev'): ?>
           <!--   <a role="menuitem" tabindex="-1" href="<?= BASE_URL ?>welcome/mobilogin">Mobile Login <i class="fa fa-sign-in"></i></a> -->
            <?php endif; ?> 
        <?php } ?> 
        <!-- Insert ends here -->
                            <div class="dropdowns-container pull-right clearfix">

                            <!--    <div class="dropdown currency-dropdown pull-right">
                                    <a class="dropdown-toggle" href="#" id="currency-dropdown" data-toggle="dropdown" aria-expanded="true">
                                    Currency
                                    <span class="angle"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="currency-dropdown">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Us Dollar</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Euro</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Turkish TL</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Pound</a></li>
                                    </ul>
                                </div><-- End .currency-dropdown -->

                         <!--       <div class="dropdown language-dropdown pull-right">
                                    <a class="dropdown-toggle" href="#" id="language-dropdown" data-toggle="dropdown" aria-expanded="true">
                                    Languages
                                    <span class="angle"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="language-dropdown">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">English</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Spanish</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">French</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">German</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Italian</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Swedish</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Amharic</a></li>
                                    </ul>
                                </div><!-- End .curreny-dropdown -->
                            </div><!-- End. dropdowns-container -->

                        </div><!-- End .pull-right -->
                    </div><!-- End .container-fluid -->
                </div><!-- End .navbar-top -->



                <div class="container-fluid">
                    <div class="navbar-header fullwidth not-sticky">

                   <!--     <button type="button" class="navbar-toggle pull-right collapsed" data-toggle="collapse" data-target="#main-navbar-container">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                        </button> -->
                        <!-- <img src="<= BASE_URL ?>welcome_module/images/aymp_logo75x62.png" alt="Banner" class="header-banner">  -->
                        <a><img src="<?= BASE_URL ?><?= SMALL_LOGO ?>" alt="SMALL_LOGO" class="header-banner"></a> 
                     

                    <!--     <a class="navbar-brand text-uppercase" href="<?= BASE_URL ?>welcome" title="Boss - Multipurpose Premium Html5 Template">BPA</a>
                        <br>   -->    

    <!--    <img src="<?= BASE_URL ?>welcome_module/images/blankltfcloudbanner870x90.jpg" alt="Banner" class="header-banner"> -->

  <!--  <a href="<?= BASE_URL ?>welcome/ghana"> <img src="<?= BASE_URL ?>welcome_module/images/ghana2020cloudbanner870x90.jpg" alt="Banner" class="header-banner"> </a>  -->

   <!-- <a href="<?= BASE_URL ?>welcome/ghana"> <img src="<?= BASE_URL ?>welcome_module/images/learntoflyleft540x90.jpg" alt="Banner" class="header-banner"> </a> --> 


                <div class="row">
                    <div class="col-md-1">


                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                      <br>
                    
  <!-- <h1><?= CCMP ?> Services Portal</h1>  -->
    <h1>Honcho Core</h1>
                

                    </div><!-- End .col-md-6 -->
                    <div class="col-md-3">

                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->










                   <!--     <img src="<?= BASE_URL ?>themes/boss/images/welcome/n33443inflight870x90.jpg" alt="Banner" class="header-banner"> -->

                 <!--       <button type="button" class="navbar-btn btn-icon pull-right last" data-toggle="collapse" data-target="#header-search-form"><i class="fa fa-search"></i></button> -->
<!--
                        <div class="dropdown cart-dropdown pull-right">
                            <button type="button" class="navbar-btn btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> <?= $_SESSION['cartitems'] ?></button>
                            <p></p>
                            <div class="dropdown-menu cart-dropdown-menu" role="menu">
                                <p class="cart-dropdown-desc"><i class="fa fa-cart-plus"></i>You have <?= $_SESSION['cartitems'] ?> items(s) in your shopping cart:</p>
                                <hr>
                                
                                <?php
								foreach($rows as $row) { ?>                       
                                    <?php if ($row->item_qty > 0){ ?>

                                        <div class="product clearfix">
                                            <a href="#" class="remove-btn" title="Remove"><i class="fa fa-close"></i></a>
                                            <figure>
                                            <a href="product.html" title="Product Name"><img class="img-responsive" src="<?= BASE_URL ?><?= $row->item_image ?>" alt="Product image"></a>
                                            </figure> 
                                            <div class="product-meta">
                                                <h4 class="product-name"><a href="product.html"><?=  $row->item_title  = str_replace("%20"," ",$row->item_title)?></a></h4>
                                                <div class="product-quantity">Quantity <?= $row->item_qty ?></div><!-- End .product-quantity -->
                                           <!--     <div class="product-price-container">
                                                    <span class="product-price">$<?= $row->item_price ?></span> -->
                                            <!--       <span class="product-old-price">$120.50</span> -->
                                                </div><!-- End .product-price-container ->
                                            </div><!-- End .product-meta ->
                                        </div><!-- End .product ->
                                     <?php } ?> <!--  End if  ->
                                     
                                <?php } ?> <!--  End foreach  ->
                                <hr>
                                <div class="cart-action">
                                    <div class="pull-left cart-action-total">
                                        <span>Grand Total: $<?= $_SESSION['grand_total'] ?></span>
                                    </div><!-- End .pull-left ->
                                    <br>
                                    <div class="pull-right">
                                        <a href="<?= BASE_URL ?>welcome/cart" class="btn btn-custom no-radius">Go to Cart</a>
                                    </div>
                                </div><!-- End .cart-action ->
                            </div><!-- End .dropdown-menu ->
                        </div><!-- End .cart-dropdown ->
                    -->
                    </div><!-- End .navbar-header -->
                </div><!-- /.container-fluid -->

          <!--      <div class="sticky-menu"> 
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse collapse-row " id="main-navbar-container">
                            <ul class="nav navbar-nav navbar-nav-colored navbar-nav-border">
                                <li class="visible-lg"><a href="<?= BASE_URL ?>welcome">Home</a></li>
                                <li class="visible-lg"><a href="<?= BASE_URL ?>welcome/events">Events</a></li>                                
                             <!--   <li class="visible-lg"><a href="#">Blog</a></li>
                                <li class="visible-lg"><a href="#">Shop</a></li>
                                <li class="visible-lg"><a href="#">Gallery</a></li> ->
                                <li class="visible-lg"><a href="<?= BASE_URL ?>welcome/donate">Donate</a></li> 
                                <li class="visible-lg"><a href="<?= BASE_URL ?>welcome/cart">Cart</a></li>         
                            </ul>
                        </div><!-- /.navbar-collapse ->
                    </div><!-- /.container-fluid ->
                </div><!-- End .sticky-menu -->
            </nav> 
        </header><!-- End #header -->
