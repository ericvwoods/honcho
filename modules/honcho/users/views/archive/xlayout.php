
<!DOCTYPE html>
<html>

<head> 



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Toastr style -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <title><?= SHORTSITENAME ?> MSP</title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/textSpinners/spinners.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

  <!--  <link href="<= BASE_URL ?>themes/inspinia/css/plugins/summernote/summernote-bs4.css" rel="stylesheet"> -->
<!--  style for event calendar -->  

<style> 
.fc-disabled {
    background-color: #F0F0F0 !important;
    color: #000;
    cursor: default;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:10px;
}
.faq-item {
  padding: 1px; /* was 20px I changed style.css 6236 */
  margin-bottom: 2px;
  background: #fff;
  
  width: 100%; /* I added - cant go <96% or title of collapse witll wrap on log ones
 /* color: red; can change the default background text */

}
/* WIDGETS */
.widget {
  border-radius: 5px;
  padding: 15px 35px; /*  default was 20  */
  margin-bottom: 10px;
  margin-top: 10px;
}
.widget.style1 h2 {
  font-size: 22px; /*  default was 30  */
}
.widget h2,
.widget h3 {
  margin-top: 5px;
  margin-bottom: 0;
}
.widget-text-box {
  padding: 20px;
  border: 1px solid #e7eaec;
  background: #ffffff;
}
.widget-head-color-box {
  border-radius: 5px 5px 0 0;
  margin-top: 10px;
}
.widget .flot-chart {
  height: 100px;
}
.vertical-align div {
  display: inline-block;
  vertical-align: middle;
}
.vertical-align h2,
.vertical-align h3 {
  margin: 0;
}
.todo-list {
  list-style: none outside none;
  margin: 0;
  padding: 0;
  font-size: 14px;
}
.todo-list.small-list {
  font-size: 12px;
}
.todo-list.small-list > li {
  background: #f3f3f4;
  border-left: none;
  border-right: none;
  border-radius: 4px;
  color: inherit;
  margin-bottom: 2px;
  padding: 6px 6px 6px 12px;
}
.todo-list.small-list .btn-xs,
.todo-list.small-list .btn-group-xs > .btn {
  border-radius: 5px;
  font-size: 10px;
  line-height: 1.5;
  padding: 1px 2px 1px 5px;
}
.todo-list > li {
  background: #f3f3f4;
  border-left: 6px solid #e7eaec;
  border-right: 6px solid #e7eaec;
  border-radius: 4px;
  color: inherit;
  margin-bottom: 2px;
  padding: 10px;
}
.todo-list .handle {
  cursor: move;
  display: inline-block;
  font-size: 16px;
  margin: 0 5px;
}
.todo-list > li .label {
  font-size: 9px;
  margin-left: 10px;
}
.check-link {
  font-size: 16px;
}
.todo-completed {
  text-decoration: line-through;
}
.geo-statistic h1 {
  font-size: 36px;
  margin-bottom: 0;
}
.glyphicon.fa {
  font-family: "FontAwesome";
}
</style>

<!--    <style type="text/css" media="screen">
        #spinner{
            position: fixed;
            top: 50%;
            left: 50%;
        }
    </style> -->

</head>

<!-- <body class="fixed-nav fixed-nav-basic"> -->
<!-- <body> -->
<!-- <body class="skin-1"> -->
 <body class="light-skin"> 

<div id="wrapper"> 

<!--
<div class="row">
    <div class="col-md-1">-->
    <!-- start: Side  Menu -->
    <?php include('sidemenu.php'); ?>                   
    <!-- end: Side Menu -->
    <?php include($contentfile.'.php');  ?> 


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

<!-- Peity -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/demo/peity-demo.js"></script>

<!-- EayPIE -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?= BASE_URL ?>themes/inspinia/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/chartJs/Chart.min.js"></script>

<!-- Full Calendar -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- JS Knob -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- SUMMERNOTE --
    <script src="<= BASE_URL ?>themes/inspinia/js/plugins/summernote/summernote-bs4.js"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

       });
    </script> -->

<script> 
    $(function() {
        $(".dial").knob();
    });
</script>


<script>

    $(document).ready(function() {

     //   var clickBox = document.getElementById("toggleSpinners");
   //     var clickBox = document.getElementById("toggleSpinner1");
   //     clickBox.onclick = startSpinner;

   //     function startSpinner() { 
                   
   //         alert('Yep startSpinner');
      //    $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
      //    $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
      //     console.log("spinner started");
    //    }

alert('DOCUMENT READY FIRED IN LAYOUT!');

//both methods work to capture onclick

            $('#toggleSpinner1').on('click',function(){
//alert('Yep1');
                document.getElementById("ibox1").style.display = "";
         //   $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
         //   $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
             console.log("spinner started"); 
            });

            $('#toggleSpinner2').on('click',function(){

                document.getElementById("ibox2").style.display = "";

             console.log("spinner started"); 
            });

            $('#toggleSpinner3').on('click',function(){

                document.getElementById("ibox3").style.display = "";

             console.log("spinner started"); 
            });

            $('#toggleSpinner4').on('click',function(){

                document.getElementById("ibox4").style.display = "";

             console.log("spinner started"); 
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });     


        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
/* for Evenrcalendar Module */
$(function () {
    $('#calendar').fullCalendar({
        //timeFormat: 'H(:mm)t',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        //hiddenDays: [ 2, 4 ],
        events: function(start, end, timezone, callback) {
            $.ajax({
       //org         url : '<?php echo WEB_ROOT; ?>api/process.php?cmd=calview',
            //    url : '<?php echo BASE_URL; ?>api/process.php?cmd=calview',
                url : '<?php echo BASE_URL; ?>welcome-eventcalendar/index/calview',
                dataType: 'json',
                type    : 'POST',
                data    : {
                    start   : start.format(),
                    end     : end.format()
                },
                success: function(doc) {
                    var events = [];
                    //console.log('events #########');
                    callback(doc);
                }
            });
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function (date, allDay) { },
        eventClick: function(calEvent, jsEvent, view) {
            //alert('Event: ' + calEvent.title);
            //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //alert('View: ' + view.name);
            // change the border color just for fun
            //$(this).css('border-color', 'red');
        },
        dayRender: function(date, cell){
            //console.log('dayRender');
            //console.log(date.format());
            //$(cell).addClass('fc-disabled').html('Disabled');
             $(cell).css('opacity', 1);
            //$(cell).css("display", "none");//    display:none;
        },
        viewRender: function(view, element) {},
        eventRender: function(ev, element, view) {
            //element.qtip({content: ev.title});
        },
        eventAfterRender : function(ev, element, view) {
            if(ev.block == true) {
                //console.log('After Render = ' + ev.title + ' BLOCK ? ' + ev.block);
                //fc-day fc-widget-content
                var start = ev.start.format();
                $("td.fc-day[data-date='"+ start +"']").addClass('fc-disabled');
            }
        }
        /*,
        
        eventMouseover: function(calEvent, jsEvent) {
            var tooltip = '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' + calEvent.title + '</div>';
            var $tootlip = $(tooltip).appendTo('body');
        
            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $tooltip.fadeIn('500');
                $tooltip.fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $tooltip.css('top', e.pageY + 10);
                $tooltip.css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.tooltipevent').remove();
        }*/
    });
});//off


            var sparklineCharts = function(){
                 $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                     type: 'line',
                     width: '100%',
                     height: '60',
                     lineColor: '#1ab394',
                     fillColor: "#ffffff"
                 });

                 $("#sparkline2").sparkline([24, 43, 43, 55, 44, 62, 44, 72], {
                     type: 'line',
                     width: '100%',
                     height: '60',
                     lineColor: '#1ab394',
                     fillColor: "#ffffff"
                 });

                 $("#sparkline3").sparkline([74, 43, 23, 55, 54, 32, 24, 12], {
                     type: 'line',
                     width: '100%',
                     height: '60',
                     lineColor: '#ed5565',
                     fillColor: "#ffffff"
                 });

                 $("#sparkline4").sparkline([24, 43, 33, 55, 64, 72, 44, 22], {
                     type: 'line',
                     width: '100%',
                     height: '60',
                     lineColor: '#ed5565',
                     fillColor: "#ffffff"
                 });

                 $("#sparkline5").sparkline([1, 4], {
                     type: 'pie',
                     height: '140',
                     sliceColors: ['#1ab394', '#F5F5F5']
                 });

                 $("#sparkline6").sparkline([5, 3], {
                     type: 'pie',
                     height: '140',
                     sliceColors: ['#1ab394', '#F5F5F5']
                 });

                 $("#sparkline7").sparkline([2, 2], {
                     type: 'pie',
                     height: '140',
                     sliceColors: ['#ed5565', '#F5F5F5']
                 });

                 $("#sparkline8").sparkline([2, 3], {
                     type: 'pie',
                     height: '140',
                     sliceColors: ['#ed5565', '#F5F5F5']
                 });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();
            // set font button

            $("#FontBtn").click(function(){
                var nfontsize  = $("#fontsize").val();
                var nmfontsize = $("#mfontsize").val();
                var sarecid    = $("#recid").val();
//alert(nfontsize);
                    $.ajax({
                      
                        url:'<?= BASE_URL ?>welcome-ccmps/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#fontsize").val("");
                                $("#mfontsize").val("");
                                $("#recid").val("");
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
                    
            });    
    });

</script>
    <!-- Run Scripts  -->
    <script>
  const { createApp } = Vue

  createApp({
    data() {
      return {
        message: 'Coming Soon!'
      }
    }
  }).mount('#app')
  
</script>
</body>

</html>
