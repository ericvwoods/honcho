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

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet"> 
    <link rel="stylesheet" href="<?= BASE_URL ?>themes/cool_mobi/blue/css/cool_mobi.css"> 

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> 
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <title>BPA Mobi</title>


</head>

<body class="gray-bg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.cjs.js"></script>
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

            <?php if($data['logged_in'] == 1 AND $data['home_page'] == 1): ?> 
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
                        <?= anchor(BASE_URL, 'Enterprise Management System') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php else: ?> <!-- Not a CCMP (everyone else)   -->
                    <div class="logo">             
                        <?= anchor(BASE_URL, 'Enterprise Management System') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php endif; ?>

            <?php else: ?> <!-- Not logged in   -->
                <?php if($data['admin_login'] == 1): ?> <!-- If came from the admin login screen   -->
                    <div class="logo">             
                        <?= anchor(BASE_URL, 'EMS Administration') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>
                <?php else: ?> <!-- Came from CCMP login screen   -->
                   <div class="logo">             
                        <?= anchor(BASE_URL, 'Enterprise Management System') ?> <!--  <= anchor(BASE_URL, WEBSITE_NAME) ?> -->
                    </div>               
                <?php endif; ?>

            <?php endif; ?> <!-- End logged in   -->

            
            <div>
                <?php if($data['logged_in'] == 1 AND $data['home_page'] == 1): ?> 
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
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/sparkline-demo.js"></script>


    <!-- iCheck from form-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/iCheck/icheck.min.js"></script>

    <!-- From Datatables  -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

 <!--   <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>  -->

    
    <script>
        $(document).ready(function() {

/*
swal({
  title: "Ajax request example",
  text: "Submit to run ajax request",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
    swal("Ajax request finished!");
  }, 2000);
});


*/


            // Reset password modal
            $("#ResetBtn").click(function(){
                var req_pw_length    = $("#rpwl").val();
                var new_password     = $("#npass").val();
                var confirm_password = $("#cpass").val();
                var sarecid            = $("#recid").val();

                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({
                        
                        url:'<?= BASE_URL ?>honcho/modalresetpw',
                        type: 'post',
                        data: {npass:new_password,cpass:confirm_password,recid:sarecid},
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#myModal2").modal("hide");
                            }, 3000);                       

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                        }, 500);

              }



                } // 1st else above
            });



            // change password modal
            $("#ChangeBtn").click(function(){
                var req_pw_length    = $("#rpwl").val();
                var current_password = $("#crpass").val();
                var new_password     = $("#npass").val();
                var confirm_password = $("#cpass").val();

                if(current_password =="" || new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({

                      /*  swal({
                            title: "Ajax request example",
                            text: "Submit to run ajax request",
                            url:'<?= BASE_URL ?>honcho/modalchangepw',
                            type: 'post',
                            data: {crpass:current_password,npass:new_password,cpass:confirm_password},
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                            }, function () {
                            setTimeout(function () {
                                swal("Ajax request finished!");
                            }, 2000);
                        }); */

                        
                        url:'<?= BASE_URL ?>honcho/modalchangepw',
                        type: 'post',
                        data: {crpass:current_password,npass:new_password,cpass:confirm_password},
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#crpass").val("");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#myModal").modal("hide");
                            }, 2500);
                        

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                        }, 500);

              }



                } // 1st else above
            });


            //from datatables
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

//from form
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
      

            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Number of orders",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Payments",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>

</body>
</html>