<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/trongate.css">
    <link rel="stylesheet" href="<?= THEME_DIR ?>css/cool_mobi.css">
    <title>Cool Mobi</title>
</head>
<body>
    <header>
        <div id="header-lg">
            <div class="logo">
                <?= anchor(BASE_URL, WEBSITE_NAME) ?>
            </div>
            <div>
                <ul id="top-nav">
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i> Home</a></li>
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
            <div class="logo"><?= WEBSITE_NAME ?></div>
            <div>
                <?php 
                echo anchor('#', '<i class="fa fa-user"></i>'); 
                echo anchor('#', '<i class="fa fa-sign-out"></i>'); 
                ?>
            </div>
        </div>
    </header>
    <main><?= Template::display($data) ?></main>
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

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

<script src="<?= BASE_URL  ?>js/app.js"></script>
</body>
</html>