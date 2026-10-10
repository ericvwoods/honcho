<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/trongate.css">
 <!--   <link rel="stylesheet" href="<?= THEME_DIR ?>css/cool_mobi.css"> -->

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>themes/cool_mobi/orange/css/cool_mobi.css"> <!-- change theme color:black,purple,orange,red,blue,green -->

    <title>PTSC Mobi</title>
</head>
<body class="gray-bg">
    <header>
        <div id="header-lg">
            <div class="logo">
              <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                 <?= anchor(BASE_URL, 'Primetime') ?>
            </div>
            <div>
                <ul id="top-nav"> <!-- Left Side Menu  -->
                    <li><a href="<?= BASE_URL ?>welcome/home"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-lightbulb-o"></i> About Us</a></li>
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-street-view"></i> Our Values</a></li>
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-gears"></i> How We Work</a></li>
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-send"></i> Get In Touch</a></li>
                </ul>
            </div>
        </div>
        <div class="fixed-header">
            <div id="hamburger" onclick="openSlideNav()">
                &#9776;
            </div>           
        <!--    <div class="logo"><= WEBSITE_NAME ?></div> -->
        <!--        <div class="logo"><= SITENAME ?></div> -->
                <div class="logo">Primetime</div>
            <div>
                <?php 
                echo anchor('#', '<i class="fa fa-user"></i>'); 
                echo anchor('welcome/logout', '<i class="fa fa-sign-out"></i>'); 
                ?>
            </div>
        </div>
    </header>

    <main><?= Template::display($data) ?></main>
<!-- <php $_SESSION['LOGGED_IN'] = 1; ?> -->
<?php if($_SESSION['LOGGED_IN'] == 1): ?>
    <footer>
        <div id="footer-lg" class="container">
            <!-- it's okay to remove the links and add your own content here - everything is cool (DC) -->
            <div>&copy; Copyright <?= date('Y').' '.OUR_NAME ?></div>
            <div><?= anchor('https://trongate.io', 'Powered by Trongate') ?></div>
        </div>
        <div class="fixed-footer">
            <div onclick="goToUrl('<?= BASE_URL ?>')">
                <div>
                    <i class="fa fa-home"></i>
                </div>
                <div>
                    Home
                </div>
            </div>
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-search"></i>
                </div>
                <div>
                    Search
                </div>
            </div>
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-map-marker"></i>
                </div>
                <div>
                    Find Us
                </div>
            </div>
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-phone"></i>
                </div>
                <div>
                    Contact
                </div>
            </div>
        </div>
    </footer>

<div id="slide-nav">
    <div id="close-btn" onclick="closeSlideNav()">&times;</div>
    <ul auto-populate="true"></ul>
</div>
<?php endif; ?> 

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

<script src="<?= BASE_URL  ?>js/app.js"></script>
    <!-- Mainly scripts -->
    <script src="http://localhost/honchotg/themes/inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="http://localhost/honchotg/themes/inspinia/js/popper.min.js"></script>
    <script src="http://localhost/honchotg/themes/inspinia/js/bootstrap.js"></script>

</body>
</html>