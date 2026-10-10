<!-- contains the background image for the login page -->
<!-- If using the same background for each page could delete this file and use layouts/footer like the header -->

    <div class="container">
        <span>Honcho Core &copy; 2024 - v.<?= VERSION_RELEASE ?> </span>
    </div><!-- End .container -->

</div><!-- End #content -->
</div><!-- End #wrapper -->
    
    
 <!--<a href="#top" id="scroll-top" class="smaller dark no-radius" title="Back to Top"><i class="fa fa-angle-up"></i></a> -->

    <!-- BOSS Theme -->
    
    <!-- Modernizr -->
    <script src="<?= BASE_URL ?>themes/boss/js/modernizr.js"></script>

    <!--- jQuery -->
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.min.js"></script>

    <!-- Queryloader -->
    <script src="<?= BASE_URL ?>themes/boss/js/queryloader2.min.js"></script>
        
    <!-- Smoothscroll -->
    <script src="<?= BASE_URL ?>themes/boss/js/smoothscroll.js"></script>

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
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.kwicks.min.js"></script>

    <script src="<?= BASE_URL ?>themes/boss/js/skrollr.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.countTo.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/isotope.pkgd.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/wow.min.js"></script>

    <script src="<?= BASE_URL ?>themes/boss/js/jquery.mb.YTPlayer.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/jquery.magnific-popup.min.js"></script>   
    <script src="<?= BASE_URL ?>themes/boss/js/mediaelement-and-player.min.js"></script>

    <script src="<?= BASE_URL ?>themes/boss/js/jquery.backstretch.min.js"></script>

    <script src="<?= BASE_URL ?>themes/boss/js/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/contact.js"></script>
    <script src="<?= BASE_URL ?>themes/boss/js/main.js"></script>

    <script>
        $(function () {
            "use strict";
             $.backstretch("<= BASE_URL ?>welcome_module/ghana/"); 
         //  $.backstretch("<?= BASE_URL ?>welcome_module/images/clouds1770x1080.jpg"); // cloudbackground.jpeg - another background setting in boss template view file
    
             // Kwicks Plugin
            if ($.fn.kwicks) {
                $('.kwicks').kwicks({
                    maxSize : '75%',
                    behavior: 'slideshow',
                    spacing: '1px',
                    duration: 600,
                    interval: 10000
                });
                }       
                    // Slider Revolution
        jQuery('#revslider').revolution({
            delay:8000,
            startwidth:1170,
            startheight:520,
            fullWidth:"on",
            hideTimerBar: "on",
            spinner:"spinner2",
            navigationStyle: "preview4",
            soloArrowLeftHOffset:0,
            soloArrowRightHOffset:0
        });

            /*---- Google map - Footer - top ----- 
            if (document.getElementById("map")) {
                var locations = [
                    ['<div class="map-info-box"><ul class="contact-info-list"><li><span><i class="fa fa-home fa-fw"></i></span> Mimar Sinan Mh., Konak/İzmir, Türkiye</li><li><span><i class="fa fa-phone fa-fw"></i></span> +90 0 (232) 324 11 83</li></ul></div>', 38.396652, 27.090560, 9]
                    /* center:new google.maps.LatLng(38.749431,-76.957078), old:  38.396652, 27.090560, 9]
                ];

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: new google.maps.LatLng(38.749431, -76.957078),
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
                });

                var infowindow = new google.maps.InfoWindow();


                var marker, i;

                for (i = 0; i < locations.length; i++) {  
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    animation: google.maps.Animation.DROP,
                    icon: '<= BASE_URL ?>images/welcome/pin.png',
                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
                }
            } */

        }());
    </script>
    
    </body>
</html>