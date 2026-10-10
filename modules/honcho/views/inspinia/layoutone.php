<?php


if(DEBUGGING == true){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "";}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= SHORTSITENAME ?> <?= SHORTSITENAME2 ?></title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Sweet Alert -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


</head>

<body>
    <div id="wrapper">


    <!-- start: Side  Menu -->
    <?php include($sidemenu.'.php'); ?>
	<!-- end: Side Menu -->



        <div id="page-wrapper" class="gray-bg">


        <div class="row border-bottom">

            <?php include($topmenu.'.php');  ?>
        <!--    <php include($contentmenu.'.php');  ?> -->

        </div>
                         <?php
                                    if(!empty($marqueedata)){ ?>

        <marquee behavior="scroll" scrollamount="13" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                                   <!--      <h2 style="color:darkgoldenrod;">

                                    A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to: Kansas City Blackhawks <span style="color: Tomato;"><strong>Jordan Watson</strong></span> Private Pilot <span style="color: Tomato;"><strong>Vincent Lewis</strong></span> First Solo and <span style="color: Tomato;"><strong>John Kemp</strong></span> Long X-Country! Also <span style="color: Tomato;"><strong> My Man </strong></span> Top Gun 2023! <span style="color: Tomato;"><strong> Michael Youngblood </strong></span> 1st Place Flour Bomb Drop <span style="color: Tomato;"><strong> Roscoe Draper </strong></span> 104th Birthday! <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>

                                    </h2>-->

                                    <h2 style="color:darkgoldenrod;">


                                    <?php

                                        foreach($marqueedata as $row) { ?>

                                        <span><strong><?= $row->title ?> </strong><small><?= $row->subentity ?></small></span> <?= $row->info1 ?> <?= $row->info2 ?> <?= $row->info3 ?> <?= $row->info4 ?> <?= $row->info5 ?> <?= $row->info6 ?> <?= $row->extlinklabel ?> <?= $row->extlink ?>


                                    <?php } ?>

                                     <span style="color: mediumseagreen;">Thank You! <i class="fa fa-thumbs-up fa-1x"></i></span>
                                </h2>
        </marquee>
        <?php } ?>
        <!-- If you take out of down div and put in content div it will box instead of extending full width  -->
        <div>
            <?php include($breadcrumbfile.'.php');  ?>
        </div>

        <div class="wrapper wrapper-content">

<!--    <php include($contentmenu.'.php');  ?> -->
    <!--    <?php echo($contentfile); ?> -->

            <?php include($contentfile.'.php');  ?>

        </div>

        <div class="footer">
            <div class="float-right">
           <!--     floated right -->
            </div>
            <div>
                <strong>powered by</strong> honcho &copy; 2026
            </div>

        </div>

        </div>


    </div>

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


            // Reset password modal - Reset Password button calls MyModal2 which calls this which posts values from form to honcho/modalresetpw
            $("#ResetBtn").click(function(){
                var req_pw_length    = $("#rpwl").val();
                var new_password     = $("#npass").val();
                var confirm_password = $("#cpass").val();
                var db_to_update     = $("#dbtupd").val();
                var sarecid          = $("#recid").val();

                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?');
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({

                        url:'<?= BASE_URL ?>honcho/modalresetpw',
                        type: 'post',
                        data: {npass:new_password,cpass:confirm_password,recid:sarecid,dbtupd:db_to_update}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#dbtupd").val("");
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
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
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
                var db_to_update     = $("#dbtupd").val();
                var sarecid          = $("#recid").val();

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
                        data: {crpass:current_password,npass:new_password,cpass:confirm_password,dbtupd:db_to_update,recid:sarecid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#crpass").val("");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#dbtupd").val("");
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
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
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
