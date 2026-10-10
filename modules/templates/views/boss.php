<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>BPA EMS</title>
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

        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/font-awesome.css">

        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/animate.css">
       <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/bootstrap.min.css">  
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/magnific-popup.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/mediaelementplayer.css">        
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/style.css">
        
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/jquery.kwicks.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>themes/boss/css/revslider/revslider-index5.css">
        
        <!-- Default is blue  -->        
   <!--     <link rel="stylesheet" id="color-scheme" href="<?= BASE_URL ?>themes/boss/css/colors/green.css"> -->
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="<?= BASE_URL ?>themes/boss/images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= BASE_URL ?>themes/boss/images/icons/faviconx72.png">

<div class="wrapper">  
    <main><?= Template::display($data) ?></main>
 </div> 
        
            <!-- Fullcalendar Jquery Plugin  -->
      <!--  <script src='fullcalendar/dist/index.global.js'></script> -->
    <!-- Modernizr -->
    <script src="<?= BASE_URL ?>themes/boss/js/modernizr.js"></script>

    <!--- jQuery -->
   <script src="<?= BASE_URL ?>themes/boss/js/jquery.min.js"></script>

    <!-- Queryloader -->
    <script src="<?= BASE_URL ?>themes/boss/js/queryloader2.min.js"></script>

    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
        <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/twittwr-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --> <!-- breaks the collapse on ccmphome  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

 

        <script  type="text/javascript">
                $(document).ready(function(){
                   // var url = '<php echo BASE_URL ?>welcome-ccmps/load';
                  //  alert(<php echo $eventdatajson ?>);
                 // alert('echo $eventdatajson');
                    var events = <?php echo json_encode($eventdatajson) ?>;
                  //  alert(events)
                // console.log(events)
                 $('#calendar').fullCalendar({
                    editable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                            },

                   // events: '<php echo BASE_URL.'welcome-ccmps/load' ?>',

                  //      events: [
                  //      {
                  //        title: 'Event1',
                  //        start: '2022-12-20'
                  //      },
                  //      {
                  //        title: 'Event2',
                  //        start: '2022-12-21'
                  //      }
                        // etc...
                  //    ],

                   // events: 'events',
                  // events: 'http://localhost/honchotg/welcome-ccmps/load',
                    events: events,
                    selectHelper: true,
                    selectable: true,
                  /*  select:function(start,end,allday){
                        var title = prompt("Enter Event Title");
                        if(title)
                        {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end   = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: '<?php echo BASE_URL ?>welcome-fullcalendar/insert',
                                type:"POST",
                                data:{title:title, start:start, end:end},
                                success:function(){
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Event Added Successfully");
                                } 
                            })
                        }
                    } */
                    /*            editable: true, // can drag and drop and edit events
                                eventResize:function(event){
                                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                                    var end   = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                                    var title = event.title;
                                    var id    = event.id;

                                    $.ajax({
                                        url: '<?php echo BASE_URL ?>welcome-fullcalendar/update',
                                        type:"POST",
                                        data:{title:title, start:start, end:end id:id},
                                        success:function(){
                                            calendar.fullCalendar('refetchEvents');
                                            alert("Event Updated Successfully"); 
                                } 
                            }) 

                        } 
                                eventDrop:function(event){
                                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                                    var end   = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                                    var title = event.title;
                                    var id    = event.id;

                                    $.ajax({
                                        url: '<?php echo BASE_URL ?>welcome-fullcalendar/update',
                                        type:"POST",
                                        data:{title:title, start:start, end:end id:id},
                                        success:function(){
                                            calendar.fullCalendar('refetchEvents');
                                            alert("Event Updated Successfully"); 
                                } 
                            }) 

                        } 

                            eventClick:function(){

                            if(confirm("Are you sure you want to remove it?"))
                            {

                                var id = event.id;
                                $.ajax({
                                        url: '<?php echo BASE_URL ?>welcome-fullcalendar/delete',
                                        type:"POST",
                                        data:{id:id},
                                        success:function(){
                                            calendar.fullCalendar('refetchEvents');
                                            alert("Event Successfully Removed"); 
                                } 
                            }) 

                            }

                        } */
                    });

                   // alert('script ran');

                });
        </script>
        
    </head>
    <body>


<!-- <body class="gray-bg"> -->

<!--
 <div class="wrapper">  
    <main><?= Template::display($data) ?></main>
 </div> 
-->


    <!-- Google map javascript api v3 -->
 <!--   <script src="//maps.googleapis.com/maps/api/js?sensor=false"></script> google map -->

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

  <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC5JrXPZVlRq4mcsUd2zA5J9V-JEGOvEc&callback=myMap"></script> -->


    <script>

        $(function () {
         //   "use strict";
            "use strict";

  //           $.backstretch("<= BASE_URL ?>welcome_module/ghana/outreachbackground655x434.jpg"); 
           $.backstretch("<?= BASE_URL ?>welcome_module/images/clouds1770x1080.jpg"); //cloudbackground.jpeg - not use dby login screen - see security footer file
    
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

            /*---- Google map - Footer - top ----- *
            if (document.getElementById("map")) {
                var locations = [
                    ['<div class="map-info-box"><ul class="contact-info-list"><li><span><i class="fa fa-home fa-fw"></i></span> Mimar Sinan Mh., Konak/İzmir, Türkiye</li><li><span><i class="fa fa-phone fa-fw"></i></span> +90 0 (232) 324 11 83</li></ul></div>', 38.396652, 27.090560, 9]
                    /* center:new google.maps.LatLng(38.749431,-76.957078), old:  38.396652, 27.090560, 9]*
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
                    icon: '<?= BASE_URL ?>images/welcome/pin.png',
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