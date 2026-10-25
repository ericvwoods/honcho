<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= SHORTSITENAME ?> CA Portal</title>

    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Sweet Alert -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
 <!--   <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet"/> -->
    
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">

    <style type="text/css" media="screen">
        #spinner{
            position: fixed;
            top: 50%;
            left: 50%;
        }
    </style>

        <style>
            .blink {
                animation: blinker 0.0s linear infinite;
                color: teal;
                font-family: sans-serif;
            }
            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
        </style>

    <!-- New from layout  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Toastr style -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <title><?= SHORTSITENAME ?> MSP</title>

 <!--   <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'> -->
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/textSpinners/spinners.css" rel="stylesheet">

<!--    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/codemirror/codemirror.css" rel="stylesheet"> -->

<!--  style for event calendar -->  
<!--
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

-->
    
    <!-- end from layout  -->

</head>


<!--  <body> background will be black -->
<!-- <body class="gray-bg"> -->
    <!-- <body class="skin-1"> -->
    <body class="light-skin">

 <div class="wrapper">  <!-- I added -->
    <main><?= Template::display($data) ?></main>
   
 </div> <!-- wrapper -->

<!-- js from layout  -->

<!-- end js function from layout  -->

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>


<!-- From former ccmphome's layout file   -->



<!-- Begin Javascript   -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script> 
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.1/dist/sweetalert2.all.min.js"></script>  -->
 <!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script> -->

<!--
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/fullcalendar.min.js"></script> -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jsKnob/jquery.knob.js"></script>

       <!-- Mainly scripts -->

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

    <!-- ChartJS-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/chartJs/Chart.min.js"></script>

    <!-- From Datatables  -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    
    <!-- CKEditor 4.20.1 Standard  -->
        
    <script src="<?= BASE_URL ?>ckeditor/ckeditor.js"></script>

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pdfjs/pdf.js"></script>

    <!-- BS custom file -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>


    <!-- Vue.js CDN  -->
 <!--   <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->

    
    <!-- Run Scripts  -->

<script>
    CKEDITOR.replace('bulletin_editor'); // in bulletin crud.php
</script>
<script>
    CKEDITOR.replace('notice_editor'); // in notice crud.php
</script>
<script>
    CKEDITOR.replace('job_editor'); // in job crud.php
</script>
<script>
    CKEDITOR.replace('activity_editor'); // in activity crud.php
</script>
<script>
    CKEDITOR.replace('doc_editor'); // in library crud.php
</script>
<script>
    CKEDITOR.replace('marquee_editor'); // in library crud.php
</script>

    <!-- SUMMERNOTE --
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/summernote/summernote-bs4.js"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

       });
    </script> -->

    <script>

        $(document).ready(function() {

//alert('DOCUMENT READY FIRED IN INSPINIA!');
//  bsCustomFileInput.init() // this line stopped doc ready from firing
// begin from layout
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
    // end from layout
    
           $("#bullsubmit").click(function(){
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction); 
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works                           
                    if(confirm('This bulletin will be permanently deleted. Confirm Deletion?'))
                    {  

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!'); 
                         
                    }else{ 
                        return false; // kills php execution of the delete
                    } 



                } // if bulkaction != 6, if not ignore and keep executing
            });

           $("#ntcsubmit").click(function(){
  //alert('Fired!');          
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction); 
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works                           
                    if(confirm('This notice will be permanently deleted. Confirm Deletion?'))
                    {  

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!'); 
                         
                    }else{ 
                        return false; // kills php execution of the delete
                    } 



                } // if bulkaction != 6, if not ignore and keep executing
            });          
             
            // set font button

            $("#FontBtn").click(function(){
             //   var nfontsize  = $("#fontsize").val();
                var nfontsize = document.getElementById("font").value;
                var nmfontsize = $("#mfontsize").val();
                var sarecid    = $("#recid").val();
//alert(nfontsize);
                    $.ajax({
                      
                        url:'<?= BASE_URL ?>welcome-ccmps/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid}, 
                      //  dataType: "json",  // if wanted to pass to php function fontsize()
              //   as json object and not input. As json could send to node.js or API
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
 

            // Reset password modal - Reset Password button calls MyModal2 which calls this which posts values from form to honcho/modalresetpw
            $("#ResetBtn").click(function(){
                            alert('Fired');  
                var req_pw_length    = $("#rpwl2").val();
                var new_password     = $("#npass2").val();
                var confirm_password = $("#cpass2").val();
                var db_to_update     = $("#dbtupd2").val();
                var sarecid          = $("#id2").val();
//alert(sarecid);
                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //    alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+'All fields are required: inspinia template line 260');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else
//alert(sarecid);
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
                                $("#npass2").val("");
                                $("#cpass2").val("");
                                $("#dbtupd2").val("");
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
            $("#ChangeBtn1").click(function(){
           //           $('#ChangeBtn').on('click',function(){

                alert('Fired');                
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
            
            // add email button

            $("#AddemailBtn").click(function(){
             //   var req_pw_length    = $("#rpwl").val();
                var new_email     = $("#nemail").val();
                var confirm_email = $("#cemail").val();
                var db_to_update  = $("#dbtupd").val();
                var sarecid       = $("#recid").val();

           //     if(new_password == "" || confirm_password == ""){ // 1st else
                  //  alert('All fields are required');
               //       alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+req_pw_length);
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
            //    }else{ // 1st else

            //     if(new_password.length >= req_pw_length){


                  if(new_email == confirm_email){ // 2nd else

                    $.ajax({
                        
                        url:'<?= BASE_URL ?>welcome-ccmps/modaladdemail',
                        type: 'post',
                        data: {nemail:new_email,cemail:confirm_email,recid:sarecid,dbtupd:db_to_update}, // these are values posted as inputs (not url segments)
                        success:function(response){

                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#nemail").val("");
                                $("#cemail").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 3500);                       
                    
                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new email address does not match the confirm email.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#nemail").val("");
                            $("#cemail").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
          //    }else{ 
          //      alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
          //              setTimeout(function(){
          //                //  $("#result").fadeOut("slow");
          //                  $("#npass").val("");
          //                  $("#cpass").val("");
          //                  $("#dbtupd").val("");
          //              }, 500);

          //    }



              //  } // 1st else above
            });




/*
            //from datatables
            $('.dataTables-example').DataTable({
                pageLength: 25,
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

            });  */

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
    

    <script id="script">
        //
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        //
  //      alert('hello');
        var url = './pdf/example.pdf';
//var url = <?= BASE_URL ?>.'./pdf/example.pdf';

        var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1.5,
                zoomRange = 0.25,
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num, scale) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport(scale);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').value = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num,scale);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Zoom in page.
         */
        function onZoomIn() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale += zoomRange;
            var num = pageNum;
            renderPage(num, scale)
        }
        document.getElementById('zoomin').addEventListener('click', onZoomIn);

        /**
         * Zoom out page.
         */
        function onZoomOut() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale -= zoomRange;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomout').addEventListener('click', onZoomOut);

        /**
         * Zoom fit page.
         */
        function onZoomFit() {
            if (scale >= pdfDoc.scale) {
                return;
            }
            scale = 1;
            var num = pageNum;
            queueRenderPage(num, scale);
        }
        document.getElementById('zoomfit').addEventListener('click', onZoomFit);


        /**
         * Asynchronously downloads PDF.
         */
        PDFJS.getDocument(url).then(function (pdfDoc_) {
            pdfDoc = pdfDoc_;
            var documentPagesNumber = pdfDoc.numPages;
            document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

            $('#page_num').on('change', function() {
                var pageNumber = Number($(this).val());

                if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                    queueRenderPage(pageNumber, scale);
                }

            });

            // Initial/first page rendering
            renderPage(pageNum, scale);
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
                            url:'<?php BASE_URL ?>welcome-ccmps/removerecord',
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

                        })
                    }else{
                        swal("Deletion cancelled");
                    }
                })
            });

</script>

<!-- would go in document ready  -->
<!-- see layout file
    
            $('#spinner').show();
                setTimeount(function(){
                    http:send()
                }, 5000);

                var el = document.getElementById('display');
                my_promise.then(function(msg){
                     $('#spinner').hide();
                    el.innerText = "success-" + msg;
                }, function(msg){
                    el.innerText = msg;

                });

                    el.innerText = "Promise all created";
            }
-->
  <!--      $('.remove_btn').click(function (e) {

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

   Would go in doc ready                     -->

<!-- End Javascript   -->    
</body>
</html>

