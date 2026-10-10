

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

<!-- Begin Javascript   -->


<!-- Mainly scripts -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI  -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- iCheck -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script> 
<script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
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
<!-- Jvectormap -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?= BASE_URL ?>themes/inspinia/js/demo/sparkline-demo.js"></script>

<!-- From Datatables  -->

<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

 
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

<script>
    
        $('.emove').click(function (e) {

            e.preventDefault();
            var id = $(this).val();

           // alert(id); // test

            swal({
                  title: "Are you sure?",
                  text: "This record will be permanently deleted!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                  .then((willDelete) => {
                    if(willDelete) {
                        $.ajax({
                           // method: "POST",
                           // url: "welcome-ccmps/removerecord",
                            url:'<?= BASE_URL ?>welcome-ccmps/removerecord',
                            type: 'post',
                            data: {
                                'recid':id,
                                'remove': true
                            },
                            success: function (response) {
                                if(response == 200)
                                {
                                    swal("Success!","Record permanently deleted","success");
                                }
                                else if(response == 500)
                                {
                                   swal("Error!","The record failed to delete","error");
                                }
                            }

                        }):
                    }else{
                        swal("Deletion cancelled");
                    }
                }):
            }):

</script>


    <script>
        $(document).ready(function() {

  /*      $('.remove_btn').click(function (e) {

            e.preventDefault();
            var id    = $("#id").val();
         //   alert(id); // test
                swal({
                  title: "Are you sure?",
                  text: "This record will be permanently deleted!",
                  icon: "warning",
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: "Yes, delete it!",
                  showLoaderOnConfirm: true
                 // buttons: true,
                 // dangerMode: true,
                })         
               // .then((willDelete) => {
                 //   if(willDelete) {
                    // console.log('Yes');
               // .then((result) => {
                 //  if(result.isConfirmed) {
                    preConfirm: function(){
                        return new Promise(function(resolve) {

                        $.ajax({
                           // method: "POST",
                            url:'welcome-ccmps/removerecord', //<= BASE_URL ?>
                            type: 'POST',
                            data: {'recid':id, 'remove_btn':true}
                        })
                        .done(function(response) {
                            swal('Deleted', response.message, response.status);
                        })
                        .fail(function() {
                            swal('Oops...', 'Something went wrong', 'error');
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
                  //  alert('All fields are required');
                      alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+req_pw_length);
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({
                        
                        url:'<?= BASE_URL ?>welcome-ccmps/modalresetpw',
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

                        
                        url:'<?= BASE_URL ?>welcome-ccmps/modalchangepw',
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
                pageLength: 5,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExcelFile'},
                    {extend: 'pdf', title: 'PDFFile'},

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




               
//});

    </script>

<!-- End Javascript   -->    
</body>
</html>