<!DOCTYPE html>
<html lang="en">
<head>
<?php header('Access-Control-Allow-Origin: *'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
      <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/trongate.css">
 <!--   <link rel="stylesheet" href="<?= THEME_DIR ?>css/cool_mobi.css"> -->

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>themes/cool_mobi/orange/css/cool_mobi.css"> 

    <title>My Primetime</title>
</head>
<body class="gray-bg">

    <header> 

        <div id="header-lg">



    <!--        <div>
                <ul id="top-nav"> <!-- Left Side Menu  ->
 <?php if($data['logged_in'] == 1): ?>
        <li><a  href="#">Ask the Doctors</a></li>
        <li><a  href="#">News</a></li>
        <li><a  href="#">Events</a></li>
        <li><a  href="#">Enter Clinicals</a></li>    
        <li><a  href="#">See Clinicals</a></li>
        <li><a  href="#">Change Password</a></li>    
        <li><a  href="#">Change Contact Info</a></li>
        <li><a  href="#">Fill out a Form</a></li>          
        <li class="dropdown-divider"></li>
        <li><a  href="https://www.gastonandporter.org/"> GPHIC Website</a></li>
        <li><a  href="https://www.gastonandporter.org/contact">Contact Us Page</a></li>
        <li><a  href="https://www.facebook.com/groups/395220337174381/">Facebook Page</a></li>
        <li><a  href="http://www.amazon.com/exec/obidos/tg/detail/-/0345432150/qid=1041850968/sr=12-1/102-3717357-2068906?v=glance&s=books">Purchase Book</a></li>
        
        <li class="dropdown-divider"></li>

     <!--   <li><a class="dropdown-item" href="#">Go back to the Homepage</a></li> ->           
        <li><a  href="<?= BASE_URL ?>welcome/logout">Sign Out <i class="fa fa-sign-out"></i> </a></li> 

 <?php else: ?> 
        <li><a href="https://gastonandporter.org"><i class="fa fa-female"></i> GPHIC Website</a></li>
        <li><a  href="https://www.facebook.com/groups/395220337174381/">Facebook Page</a></li>
        <li><a href="http://www.amazon.com/exec/obidos/tg/detail/-/0345432150/qid=1041850968/sr=12-1/102-3717357-2068906?v=glance&s=books"><i class="fa fa-book"></i> Purchase Book</a></li>
        <li><a  href="https://www.gastonandporter.org/contact">Contact Us</a></li>
 <?php endif; ?>                   
                <!--    <li><a href="<?= BASE_URL ?>"><i class="fa fa-street-view"></i> Our Values</a></li>
                    <li><a href="<?= BASE_URL ?>"><i class="fa fa-gears"></i> How We Work</a></li> ->
                  
                </ul>
            </div> -->

        </div> 

                <div class="fixed-header">
            <?php if($data['logged_in'] == 1 AND $data['home_page'] == 0): ?> 
                <a href="<?= BASE_URL ?>welcome/mobihome"><i class="fa fa-home"></i> Home</a>
            <?php endif; ?> 
        <!--    <div id="hamburger" onclick="openSlideNav()">
                &#9776;
                <php if($data['logged_in'] == 1 AND $data['home_page'] == 0): ?> 
                    <?php echo anchor('welcome/mobihome', '<small><i class="fa fa-arrow-left"></i></small>'); ?>
                <php endif; ?> 
            </div>  -->         
        <!--    <div class="logo"><= WEBSITE_NAME ?></div> -->
        <!--        <div class="logo"><= SITENAME ?></div> -->

            <div> <!-- if this is removed, the MY PRIMETIME header no longer centers -->
            <!--    <?php if($data['logged_in'] == 1): ?>  
                    <?php echo anchor('welcome/mobihome', '<i class="fa fa-home"> Home</i>'); ?>
                <?php endif; ?>  -->
            </div>


            <?php if($data['logged_in'] == 1): ?>

                <?php if($data[tg_user_level] == 7): ?>
                    <div class="logo">             
                        <?= anchor(BASE_URL, 'My Primetime') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php else: ?> <!-- Not a CCMP (everyone else)   -->
                    <div class="logo">             
                        <?= anchor(BASE_URL, 'My Primetime Administration') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php endif; ?>

            <?php else: ?> <!-- Not logged in   -->
                <?php if($data['admin_login'] == 1): ?> <!-- If came from the admin login screen   -->
                    <div class="logo">             
                        <?= anchor(BASE_URL, 'My Primetime Administration') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php else: ?> <!-- Came from CCMP login screen   -->
                   <div class="logo">             
                        <?= anchor(BASE_URL, 'My Primetime') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>               
                <?php endif; ?>

            <?php endif; ?> <!-- End logged in   -->

            
            <div>
                <?php if($data['logged_in'] == 1 AND $data['home_page'] == 0): ?> 
                    <?php echo anchor('welcome/logout', 'Sign Out <i class="fa fa-sign-out"></i>'); ?>
                <?php endif; ?>  
            </div>

        </div> <!-- Fixed Header  -->
    </header>

 <div class="wrapper">  <!-- I added -->
    <main><?= Template::display($data) ?></main>
 </div> <!-- wrapper -->


 <?php if($data['logged_in'] == 1 AND $data['device_type'] == 2 AND $data['show_buttons'] == 1): ?> 


    <footer>
        <div id="footer-lg" class="container">
            <!-- it's okay to remove the links and add your own content here - everything is cool (DC) -->
            <div>&copy; Copyright <?= date('Y').' '.OUR_NAME ?></div>
            <div><?= anchor('https://trongate.io', 'Powered by honcho') ?></div>
        </div>
       <div class="fixed-footer">
    
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-medkit"></i>
                </div>
                <div>
                    Enter Clinicals
                </div>
            </div>             

            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-comments"></i>
                </div>
                <div>
                    My Circle Feed
                </div>
            </div>    

     <!--       <div onclick="goToUrl('https://www.facebook.com/groups/395220337174381/')">
                <div>
                    <i class="fa fa-facebook"></i>
                </div>
                <div>
                    Facebook Page
                </div>
            </div>  -->

            <div onclick="goToUrl('<?= BASE_URL ?>welcome/mobiaskptsc')">
                <div>
                    <i class="fa fa-user-md"></i>
                </div>
                <div>
                    Ask the Drs
                </div>
            </div> 

 
                  
      <!--      <div onclick="goToUrl('<?= BASE_URL ?>welcome/news')">
                <div>
                    <i class="fa fa-fire"></i>
                </div>
                <div>
                    Hot News!
                </div>
            </div>
            
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-calendar"></i>
                </div>
                <div>
                    Events
                </div>
            </div> 
                       
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-user-md"></i>
                </div>
                <div>
                    Ask the Drs
                </div>
            </div>
            

            
            
            <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-bar-chart"></i>
                </div>
                <div>
                    My Stats
                </div>
            </div>                
            
                <div onclick="goToUrl('#')">
                <div>
                    <i class="fa fa-file-text"></i>
                </div>
                <div>
                    Forms
                </div>
            </div>                

            <div onclick="goToUrl('<?= BASE_URL ?>welcome/menu')">
                <div>
                    <i class="fa fa-envelope"></i>
                </div>
                <div>
                    Menu
                </div>
            </div>             -->


        <!--    <div onclick="goToUrl('<?= BASE_URL ?>welcome/mobihelp')">
                <div>
                    <i class="fa fa-handshake-o"></i>
                </div>
                <div>
                    Help
                </div>
            </div>   -->          

            <div onclick="goToUrl('<?= BASE_URL ?>welcome/logout')">
                <div>
                    <i class="fa fa-sign-out"></i>
                </div>
                <div>
                    Sign Out
                </div>
            </div>        
            
        </div>
    </footer>
 <?php endif; ?>
 <?php if($data['logged_in'] == 1 AND $data['device_type'] == 2 AND $data['show_buttons'] == 2): ?> <!--Primetime Administration  -->

    <?php if($data['tg_user_level'] == 15): ?>

    <?php else: ?> 

            <footer>
                <div id="footer-lg" class="container">
                    <!-- it's okay to remove the links and add your own content here - everything is cool (DC) -->
                    <div>&copy; Copyright <?= date('Y').' '.OUR_NAME ?></div>
                    <div><?= anchor('https://trongate.io', 'Powered by honcho') ?></div>
                </div>
               <div class="fixed-footer">
            
                    <div onclick="goToUrl('<?= BASE_URL ?>welcome/mobiaskptsc')">
                        <div>
                            <i class="fa fa-user-md"> <small><?= $_SESSION['need_response']  ?></small></i>
                        </div>
                        <div>
                            Ask the Drs
                        </div>
                    </div> 


                    <div onclick="goToUrl('https://www.facebook.com/groups/395220337174381/')">
                        <div>
                            <i class="fa fa-facebook"></i>
                        </div>
                        <div>
                            Facebook Page
                        </div>
                    </div>             


                    <div onclick="goToUrl('<?= BASE_URL ?>welcome/mobihelp')">
                        <div>
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        <div>
                            Help
                        </div>
                    </div>             

                    <div onclick="goToUrl('<?= BASE_URL ?>welcome/logout')">
                        <div>
                            <i class="fa fa-sign-out"></i>
                        </div>
                        <div>
                            Sign Out
                        </div>
                    </div>        
                    
                </div>
            </footer>

    <?php endif; ?>


  <?php endif; ?> 
<!-- <div id="slide-nav">
    <div id="close-btn" onclick="closeSlideNav()">&times;</div>
    <ul auto-populate="true"></ul>
</div> -->



<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

<script src="<?= BASE_URL  ?>js/app.js"></script>
    <!-- Mainly scripts -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>/themes/inspinia/js/bootstrap.js"></script>

</body>
</html>