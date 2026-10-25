<?php $_SESSION['release_version'] = "Black Pilots of America &copy; 2023 -  Beta v6.12.23.1"; ?>

 <!-- 2039 -->
<!--  <body class="light-skin"> -->


<div id="wrapper">
<?php include('sidemenu.php'); ?> 

<div id="page-wrapper" class="white-bg"> 
 
 <!--   <div id="page-wrapper" class="bg-primary"> -->
<!-- <div class="row border-bottom bg-primary"> -->
  <!--   <div class="row border-bottom blue-bg"> -->
             <div class="row border-bottom gray-bg"> 
            <!--    <div class="row border-bottom white-bg"> -->
 
            <div class="col-sm-4"> 

           <br>
           <br>
           <br>
  
         <ul class="nav navbar-top-links navbar-right">
                           
            <!--    <a class="navbar-minimalize minimalize-styl-2 btn btn-outline btn-navy" href="#"><i class="fa fa-caret-left"></i> Close </a> -->
      

             <?php if( ENV == 'dev'): ?>
             
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">

                 <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong> <?= CCMP ?> Services Portal </strong></span> 
          
            </a>

            <?php else: ?> 
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">                
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong> <?= CCMP ?> Services Portal </strong></span>  <!-- <?= $_SESSION['chapter_name'] ?> -->
            </a>
             <?php endif; ?> 
        <!--    <li class="dropdown">
               
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                   <strong> <i class="fa fa-gears"></i>  Settings </strong>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a  data-toggle="modal" data-target="#fontModal">

                            <div>
                                <h<?= $_SESSION['fontsize'] ?> style="color:Green;"> <i class="fa fa-font"></i> Change Font Sizes [<?= $_SESSION['dfontsize'] ?>]
                                </h<?= $_SESSION['fontsize'] ?>></span>
                            </div>
                        </a>
                    </li>
                   <li class="dropdown-divider"></li>
                    <li>
                        <a  href="">

                            <div>
                                <h<?= $_SESSION['fontsize'] ?> style="color:Gray;"><i class="fa fa-times-circle"></i> Close
                                </h<?= $_SESSION['fontsize'] ?>"></span>
                            </div>
                        </a>
                    </li>

                </ul>
            </li>     -->                     

        </ul>
            </div>
          
<div class="col-sm-5">     

              <!--    <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><h1> Black Pilots of America</h1></a> -->

  <!-- Green --> <!-- <h1><span class="text-navy"><strong><?= SITENAME ?></strong></span></h1> -->
  <!-- Blue --> <!--   <span class="m-r"><a href="#"><h1><strong><?= SHORTSITENAME ?> Member Services Portal</strong></h1></a> </span> -->
  <!-- Blk or White --><!--    <a class="btn " href="https://www.bpapilots.org" target="_blank"><h1><strong><?= CCMP ?> Services Portal</strong></h1></a> -->  <!-- white  if bg set to a color otherwise black -->
              <br>
              <ul>
                  
              <span class="m-r"><a href="https://www.bpapilots.org" target="_blank" style="color:DarkGrey;"><h1><!--<img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">--><strong><?= SITENAME ?> </strong></h1></a> </span> <!-- <?= CCMP ?> Services Portal -->
              </ul>
          
 </div>
     <!--   </div> -->
<nav class="navbar" role="navigation" style="margin-bottom: 0">

         <ul class="nav navbar-top-links navbar-right">
                         
            <li>
            <a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><span class="m-r-sm text-muted welcome-message"><i class="fa fa-user"></i> (<?= $_SESSION['ccmp_username'] ?>) </span></a>
            </li>

                <li>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
        </ul>

    </nav>
</div> 



        <!--  Begin Dashboard Panel Body --> 
    <!--    <div class="panel panel-success">  blue background--> 
        <div class="panel">
        
        <!--   <div class="panel-heading" style="color:Black;">
                <center> <h1><strong><?= CCMP ?> Services Portal</strong> </h1></center>
            </div> -->
<!-- <div class="panel-body"> -->

    <div class="row vertical-align">
        
         <div class="col-12">
             <br>
      <!--      <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> -->

        <marquee behavior="scroll" scrollamount="13" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> 
                                   <!--      <h2 style="color:darkgoldenrod;">

                                    A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to: Kansas City Blackhawks <span style="color: Tomato;"><strong>Jordan Watson</strong></span> Private Pilot <span style="color: Tomato;"><strong>Vincent Lewis</strong></span> First Solo and <span style="color: Tomato;"><strong>John Kemp</strong></span> Long X-Country! Also <span style="color: Tomato;"><strong> My Man </strong></span> Top Gun 2023! <span style="color: Tomato;"><strong> Michael Youngblood </strong></span> 1st Place Flour Bomb Drop <span style="color: Tomato;"><strong> Roscoe Draper </strong></span> 104th Birthday! <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>

                                    </h2>-->
                             
                                    <h2 style="color:darkgoldenrod;">

                                    A hearty  <span style="color: Tomato;"><i class="fa fa-heart fa-flip fa-1x"></i> </span> congratulations to:
                                    <?php
                                        foreach($marqueedata as $row) { ?>

                                        <span style="color: Tomato;"><strong><?= $row->title ?> </strong><small><?= $row->chapter ?></small></span> <?= $row->info1 ?>
                                       
                                
                                    <?php } ?> 

                                     <span style="color: mediumseagreen;">Great Job! <i class="fa fa-thumbs-up fa-1x"></i></span>
                                </h2>
        </marquee> 
            </div>

        </div> <!-- End row  -->
 


        </div> <!-- End row  --> 
  <hr> 

<div class="row wrapper border-bottom white-bg page-heading">
                    
       <div class="col-md-3">
        </div>    
                            <div class="col-md-1">
                            <br> 
                                                      <a href="https://www.bpapilots.org" target="_blank" title="BPA">
                                                        <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                                         <!--   <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"> -->
                                        </a> 
                            </div>
                            <div class="col-md-3">
                           <br>
<center>
                            <?php if($_SESSION['sidemenu'] == 'admin' ): ?> 
                                <!--Blue   --> <a href="#"><h1 style="color:cornflowerblue;"><strong> Administrator's Dashboard</strong></h1>  
                            <?php else: ?> <!--  Regular Member Menu  -->
                                <!--Blue   --> <a href="#"><h1 style="color:cornflowerblue;"><strong> <?= CCMP ?>'s Control Panel </strong> </h1>  
                            <?php endif; ?>   <!-- <?= CCMP ?>  -->

                            </h1>

                        </a>
</center>

                             <!--   <a href="#"><h2><strong><?= $_SESSION['ccmp_first'] ?> <?= $_SESSION['ccmp_last'] ?> </h2></a> -->


                          <!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
                            </div>
 <div class="col-md-2">
    <br>
                        <?php if($_SESSION['sidemenu'] == 'admin' ): ?> 
                            <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/admindashboard.jpg" alt="control panel">
                        <?php else: ?> <!--  Regular Member Menu  -->
                            <img src="<?= BASE_URL ?>welcome-ccmps_module/dashboard/controlpanel.jpg" alt="control panel">
                        <?php endif; ?> 

<!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
                            </div>

</div> <!-- End row -->
                        <!--    <= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> -->
 
         
<div class="col-lg-12">
    <hr>


<!-- DASHBOARD HEADER GOES HERE   -->
 
<?php if($_SESSION['sidemenu'] == 'admin' ): ?>  <!-- buttons on sidemenu -->  
<!-- Dont show buttons   -->
<!-- <php else: ?> -->
<!-- Show buttons   -->  

<?php if($_SESSION['chapter_admin'] == 1 || $_SESSION['chapter_role'] == 1): ?>      
  <div class="row">

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">     <i class="fa fa-users fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Members</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>
       
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-bulletinboard/manage/mmyads" style="color:Gray;">     <i class="fa fa-thumb-tack fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Bulletins</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentroster" style="color:Gray;">     <i class="fa fa-bullhorn fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Notices</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 
                      <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" style="color:Gray;">     <i class="fa fa-calendar fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Activities</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="color:Gray;">     <i class="fa fa-th-list fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Marquee</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-2">
                <!--     <div class="widget style1 white-bg"> -->
                    <div class="widget style1 gray-bg"> 
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/sponsors"style="color:Gray;">     <i class="fa fa-file fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                 <h2 style="font-weight: bold; color: gray; font-size:16pt"> Our Docs</h2> </a> 
                                <!--    <h2 style="color:LightGray;"> Sponsors</h2> </a>  -->
                            </div>
                        </div>
                    </div>
                </div> 
                   
  </div> <!--End row   -->
 <?php endif; ?>    <!--  End Chapter Admin --> 

<?php if($_SESSION['content_mgr'] == 1 ): ?> 
  <div class="row"> 

                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="color:Gray;">     <i class="fa fa-th-list fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Marquee</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory" style="color:Gray;">     <i class="fa fa-th-list fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Jumbotron</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 
       
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>cms-bulletinboard/manage/mmyads" style="color:Gray;">     <i class="fa fa-thumb-tack fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Bulletins</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/currentroster" style="color:Gray;">     <i class="fa fa-bullhorn fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Notices</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div> 
                      <div class="col-lg-2">
                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" style="color:Gray;">     <i class="fa fa-calendar fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Activities</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                <!--     <div class="widget style1 white-bg"> -->
                    <div class="widget style1 gray-bg"> 
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/sponsors"style="color:Gray;">     <i class="fa fa-file fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                 <h2 style="font-weight: bold; color: gray; font-size:16pt"> Library</h2> </a> 
                                <!--    <h2 style="color:LightGray;"> Sponsors</h2> </a>  -->
                            </div>
                        </div>
                    </div>
                </div> 

  </div> <!--End row   -->
<?php endif; ?>    <!--  End Content Mgr -->  

<?php if($_SESSION['member_admin'] == 1 ): ?> 
  <div class="row"> 

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">     <i class="fa fa-users fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> All Members</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">     <i class="fa fa-child fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Students</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mastercurrentroster" style="color:Gray;">     <i class="fa fa-dollar fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Current Roster</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/export/all" style="color:Gray;">     <i class="fa fa-table fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Master XLS</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

<?php endif; ?>    <!--  End Member Admin --> 

<?php if($_SESSION['system_admin'] == 1 ): ?> 

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">     <i class="fa fa-list-alt fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Auditlog</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">

                  <!--   <div class="widget style1 yellow-bg"> -->
                    <div class="widget style1 gray-bg">
                        <div class="row vertical-align">
                            <div class="col-2">
                            <a href="<?= BASE_URL ?>welcome-ccmps/mydata/ccmpu" style="color:Gray;">     <i class="fa fa-gears fa-2x"></i> 
                            </div>
                            <div class="col-10 text-right">
                                  <h2 style="font-weight: bold; color: gray; font-size:16pt"> Settings</h2> </a>  
                            </div>
                        </div>
                    </div>
                </div>

  </div> <!--End row   -->
<?php endif; ?>    <!--  system_admin --> 



   <hr>
<?php endif; ?> 

   <br>
                           <?= flashdata('<div style="font-weight: bold; color: orange; font-size: 13pt">', '</div>'); 
                            $flash_msg = '';
                            set_flashdata($flash_msg); ?> 
   

                  <!--   <div class="jumbotron">
                      <h1>Registrations for the Summer Events are Open!</h1>
                
                      <h2><strong>Operation Skyhook</strong> May 25 - 29 Regular Registration ends May 20th</h2>
                      <h2><p><strong>Summer Flight Academy Scholarships</strong> July 8 - 22 Applications due May 15th</p></h2>
                      <h2><p><strong>General Membership Meeting - Detroit</strong> Aug 18 - 20 Regular Registration ends July 17th<a href="https://www.bpadetroit.org/events/bpa-national-board-meeting" target="_blank" > <u>Register</u></a></p></h2>

                    </div>  -->  


<!-- DASHBOARD HEADER HERE  -->
        <div class="panel panel-default"> <!-- default, success, primary, info, warning, danger -->
            <div class="panel-heading">
                Click to Open\Close
        <!--   <center><div style="font-weight: bold; color: gray; font-size:25pt"><?= CCMP ?> Dashboard</div></center> -->
        <!--   <center>    <i class="fa fa-dashboard fa-3x"></i> <h1><strong><?= CCMP ?> Dashboard</strong></h1> </center> -->
            </div>
            <div class="panel-body">

                 <div>
<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-3">


<a data-toggle="collapse" href="#faq8" class="faq-question" style="color:Gray;"> <h2><i class="fa fa-podcast fa-1x"></i><strong> Radar Scope</strong></h2>  </a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq8" class="panel-collapse collapse">
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                        <div class="ibox-content">
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">
<div class="row">
        <div class="col-9">
 <br> 
        <div class="jumbotron">
            <div id="jumboapp"> 

        <marquee class="blink" behavior="scroll" scrollamount="0" direction="down" >  
         <!--    <h1>{{ message }} Registrations for the Summer Events are Now Open!</h1> -->
              <h1>{{ jumbotronheader }}</h1> 
         </marquee>
           <!--   <div class="container" border:1px solid #ccc;">  -->
            <br /> 
                <marquee behavior="scroll" scrollamount="0" direction="up" onmouseover="this.stop();" onmouseout="this.start();"> 
                   <?php
                        foreach($jumbotrondata as $row) { ?>


<h2><strong><?= $row->title ?> </strong> <?= $row->location ?> <strong><?= $row->info1 ?></strong> <?= $row->info2 ?> <?= $row->info3 ?> <?= $row->info4 ?> <?= $row->info5 ?> <?= $row->info6 ?> <a href="<?=$row->extlink ?>" target="_blank"><u><?=$row->extlinklabel ?></u></a></h2>
                                

                        <?php } ?>

                </marquee>
 
            <!--     <h3>Mouseover Stop/Start</h3> -->
</div> <!-- end of jumboapp   -->
            </div> <!-- End jumbotron  -->


        </div> <!-- Endcol-9  -->

        <div class="col-2">
             <br> 
 <a href="https://www.bpapilots.org" target="_blank" title="BPA">
             <!--   <img src="<?= BASE_URL ?>welcome-ccmps_module/marquee/skyhook2023.237x373.jpg" alt="Logo"> -->
             <!--   <img src="<?= BASE_URL ?>welcome-ccmps_module/marquee/gaye206x211.jpg" alt="Logo"> -->
                <!--    <img src="<?= BASE_URL ?>cms-jumbotron_module/images/gaye318x326.jpg" alt="jumbotronimg"> -->

                 <img src="<?= BASE_URL ?>cms-jumbotron_module/images/<?= $jumbotronimg ?>" alt="jumbotronimg"> 
         
            </a> 

        </div>  <!-- end col-2 -->
</div>

        </div>

                           <!--  ****************************************************************************** -->
                                                        </div><!--ibox content  -->
                </div><!--ibox   -->       
                </div> <!-- faq answer-->                                  
                </div> <!-- End Tab 7 Panel -->
                </div><!-- faq#   -->
                </div><!-- col 12  -->
                </div><!-- row   -->
                </div>
                </div>
                </div><!-- End faq-item 1  -->

<!--  Begin Accordian Section -->
<div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-3">


<a data-toggle="collapse" href="#faq1" class="faq-question" style="color:Gray;"><h2><i class="fa fa-question fa-1x"></i><strong> Ask the Developers </strong></h2></a> <!--  <i class="fa fa-microphone fa-1x"> -->
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                <!--    <php print_r($_SESSION['hometab'] ); die();?> -->
                                    <?php if($_SESSION['hometab'] == 1): ?>
                                            <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq1" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq1" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                  
                                            <div class="faq-answer">

                                              <!--      <div class="ibox "> line 1243 -->
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->

                                                        <div class="ibox-content">  <!-- line 1241  -->
                                                          
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">

   <!--     <div class="row"> line 1067 -->
      <!--      <div class="col-lg-12"> 1187-->
          <!--      <div class="ibox "> ends line 1075 -->
                <!--    <div class="ibox-title">

                    </div> -->
             <!--       <div class="ibox-content"> ends line 1072 -->



<!--    <div class="row"> 1186 -->
 <!--      <div class="col-lg-12"> 607  -->
     <!--       <div class="ibox-title">   -->
                <div class="row"> 
                    <!--    <php print_r($recid ); print_r($picture); die(); ?> -->
                    <?php if(strlen($picture) > 0): ?> <!--  if blogger pic -->
                        <div class="col-md-1">  

<img alt="president" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $recid ?>/<?= $picture ?>" >  <!-- class="rounded-circle"   -->                      
                        </div> <!-- end col -->
                    <?php else: ?> <!-- No pic  -->
                        <div class="col-md-1">  
                      
                            <div class="row">
                                <div class="col-md-1"> <!-- for spacing --> 
                                </div>
                               <a href="#" title="">
                          
 <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="BPA Logo">
                               </a>
                            </div>
                        <br>
                        </div> <!-- end col -->
                    <?php endif; ?>
                        <div class="col-md-9">
                  
                        
                        <span class="m-r">
                         <!--   <h1 ><?= $header ?></h1> -->
                           <h1 >We need your feedback!</h1>
                           <h3>Thank you for helping to make our system better </h3>
                       <!--     <a href="#">
<h2><?= $salutation ?> <?= $first_name ?> <?= $middle_name ?> <?= $last_name ?> <?= $suffix ?></h2>
                            </a>
                            <a href="#"><h2><?= $activity ?></h2></a> -->
                 
                        </span>

                        </div> <!-- end column -->
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <?php if(strlen($picture) > 0): ?>
                                    <div class="col-md-2">   
                                        <h1 class="logo text-center">
                                            <a href="#" title="bpalogo">
                                                <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                                            </a>
                                        </h1>
                                    </div> <!-- end col -->
                                <?php endif; ?> 
                            </li>
                        </ul>
                </div> <!-- end row -->

        <!--     </div> end ibox-title- ln 17 -->

        <!--     <div class="ibox-content">  Ends on 379  -->
                
  <!--  <center><h2><i class="fa fa-user-md"></i> Ask the Doctors</h2> </center>
        <center><h3>Primetime Sister Circles</h3></center> -->
                    <!-- Show flash message then reset it to blank  -->
                    
         <p>   <?= flashdata('<div style="font-weight: bold; color: gray;">', '</div>'); 
            $flash_msg = '';
            set_flashdata($flash_msg); ?> </p>
        
             <!--   <php if($data['tg_user_level'] == 15): ?> --><!-- if a principal Get their admin view - else on line 558 -->
                    <?php if($data['tg_user_level'] == 10): ?> <!-- if a principal Get their admin view - else on line 558 -->         
                    <div class="social-feed-box">

                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                                <div class="social-comment">

                                    <div class="media-body">

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Enter new post..." ><?= $askpost ?></textarea> 
                                                 
                                    </div>
                                </div>
                                <br>
                            <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Post 92</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost" ><i class="fa fa-remov"></i> Cancel 93</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

                            </div>
   

              <!--      </div>  337 ibox-content -->

                    <div class="social-feed-box">
        <tbody>
        <!--    <php echo(386);print_r($rows); ?> -->
            <?php foreach($rows as $row) { ?>

                            <div class="social-avatar">
                                <a href="" class="float-left">

                                    <?php if($pcrows->trongate_user_level == 7): ?>
                                  <!--      <p> 7 </p> -->
                                        <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $pcrows->ccmp_rec_id ?>/<?= $pcrows->posterspicture ?>"> 

                                    <?php else: ?> <!--  MAYBE make this the doctors case and add a case for anyone else -->
                               <!--     <p> not 7. 10 or 15 </p> -->
                                    <!--    <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?>"> -->
                                        <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->lvl10sapicdir ?>/<?= $row->posterspicture ?>">  
                                    <?php endif; ?> 
                                </a>
                                <div class="media-body">
                                <!--    <php if($row->trongate_user_level == 15): ?> --> <!-- user level of poster, not logged in user  -->
                               <!--     <php echo(124); print_r($row->trongate_user_level); die(); ?> -->
                                      <?php if($row->trongate_user_level == 10): ?> <!-- user level of poster, not logged in user  -->
                                        <a href="#">
                                           <i class="fa fa-user-md"></i> <?= $row->fname?> <?= $row->lname?> <!--prin <?= $row->trongate_user_level ?>/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php else: ?>
                                        <a href="#">
                                           <?= $row->fname?> <?= $row->lname?> <!-- ccmp <?= $row->trongate_user_level ?>/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?> -->
                                        </a>
                                    <?php endif; ?>  
                                <!--    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>-->
                                <small class="text-muted"><?= $row->post_date ?></small>

                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                   <h2> <?= $row->post ?> </h2>
                                </p>

                                <div class="btn-group">
                             <!--       <button class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> Edit Response</button> -->

                        <?php if($row->hidden == 1): ?>
                          <!--   <php if($row->trongate_user_level == 15): ?>--><!-- Posted by the principals themselves  -->
                              <?php if($row->trongate_user_level == 10): ?> <!-- Posted by the principals themselves  -->   
            <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiunhideaskpost/<?= $row->id ?>" ><i class="fa fa-eye"></i> Unhide Your Post</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Post</a>
                            <?php else: ?> <!-- question by a non principal  -->
                <a class="btn btn-dark btn-xs" href="<?= BASE_URL ?>welcome/mobiunhideaskpost/<?= $row->id ?>" ><i class="fa fa-eye"></i> Unhide Question</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
                            <?php endif; ?>                                  
                        <?php else: ?>  <!--- Not Hidden -->
                          <!--   <php if($row->trongate_user_level == 15): ?>--><!-- Posted by the principals themselves  -->
                              <?php if($row->trongate_user_level == 10): ?> <!-- Posted by the principals themselves  -->  
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobihideaskpost/<?= $row->id ?>" ><i class="fa fa-eye-slash"></i> Hide Your Post</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Post</a>
                            <?php else: ?> <!-- question by a non principal  -->
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobihideaskpost/<?= $row->id ?>" ><i class="fa fa-eye-slash"></i> Hide Question</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideleteaskpost/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
                            <?php endif; ?> 
                        <?php endif; ?>  

                                    
                                </div>
                            </div>
                            <div class="social-footer">
                                <!-- if a response exists in the database -->
                                <?php if(strlen($row->response) > 0 AND $row->response != ' '): ?> <!-- strlen of a space = 1  -->
                                <div class="social-comment">
                                    <div class="media-body">
                                   <!--   <a href="#">
                                            <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> Doctor's Response 171 
                                        </a> -->
                                      <a href="#" style="font-size: 10pt">
                                            <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->lvl10sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> <?= $first_name ?>'s Response 174 
                                        </a>

                                <!--        the response from the database -->
                                
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpostresponse" class="form-control" value="$askpostresponse" ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Edited Response</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                                    </div>
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                                    </div>
                                </div>



                                <!-- Else no reponse yet show response box   -->
                                <?php else: ?>
                                <div class="social-comment">
                                    <div class="media-body">

                          <!--   <php if($row->trongate_user_level == 15): ?>--><!-- Posted by the principals themselves  -->
                              <?php if($row->trongate_user_level == 10): ?> <!-- Posted by the officers themselves  --> 

                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="New Enter optional follow-on..." ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Follow-on</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>
<!--deleted code for optional follow-on   -->

                                    <?php else: ?> <!-- Not doctors responding to their own post  -->    

                                     <!--   <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> Doctor's Response 247 -->
                                     
                                    <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->lvl10sapicdir ?>/<?= $row->responsepicture ?>"> <i class="fa fa-user-md"></i> <?= $first_name ?>'s Response 249 
                               


                       <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> 
                            <div class="social-body">
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
<!--   This is the main response box -->   <textarea name="askpostresponse" class="form-control" value="$askpostresponse" placeholder="New Enter response...277" ><?= $row->response ?></textarea> 
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                           <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save New Response</a></button> 
        <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a>
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

                                    <?php endif; ?> 
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- End if response -->

                            </div>
            <!--    </td>            
            </tr>  -->
            <?php
            }
            ?>
        </tbody>
    </table>


<!--frm 77--><?php else: ?> 

<!-- Anyone but a principal - usrlvl 15. All the code above constructed the principals buttons
                                and posts from the principals admin view. Now need to cover the ccmp 7 & administrator 2 facil 10 & co facil 11-->
                    <?php if($data['tg_user_level'] == 2): ?> <!--  administrator -->

                    <?php endif; ?> <!-- End Administrator frm 300 -->

<!-- The Administration section is above this line where you have cases statements for the president/doctors and other bloggers -->
<!-- Below this dashed line is only the CCMP -->
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- There should be no cases where the you are getting data from the doctors below this line because they only do it in the admin section above this line -->
<!-- Therefore the only time you see $row->trongate_user_level == 15 should be when showing data from the doctors-->
<!--  <php echo(124); print_r($data['tg_user_level']); die(); ?> --> <!-- Still sees the die() if dont take out "?"  -->
                <?php if($data['tg_user_level'] == 7): ?> <!--   ccmp  -->
<?php if($_SESSION['ATP_PC_PO'] == 1): ?> <!--   only show presidents-->
<!-- skip code  -->
<?php else: ?> 
                    <div class="social-feed-box">

                        <form  method = "post" action="<?= BASE_URL ?>blogs-asks/saveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                        <!--        <div class="social-comment">  makes text in input smaller  -->

                            <!--        <div class="media-body">  -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Ask a question..." style="font-size: 14pt"><?= $askpost ?></textarea> 585
                                                 
                            <!--        </div> -->
                          <!--      </div>  makes text in input smaller -->
                         <!--      <br> -->
                            <!--    <div class="form-group"> -->
                                <p>    <div class="form-group">


       <button class="btn btn-primary btn-xs"><a name="submit" type="" value="Submit" style="font-size: 14pt"><i class="fa fa-save"></i> Submit Your Question</a></button> <!--  btn-xs  -->
        <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>blogs-asks/cancelaskpost/<?= $row->id ?>" style="font-size: 14pt"><i class="fa fa-times-circle"></i> Cancel</a> 
                                    </div> </p>
                                              
                            <!--    </div> -->

                                </div> <!-- social body  -->
                        </form>

                            </div>
<?php endif; ?> <!-- If president posts only  -->

              <!--     </div>  283 -->

                    <div class="social-feed-box">
        <tbody>
       <!--     <php print_r($rows); die(); ?> -->
<!--         <php print_r($_SESSION['ATP_PC_PO']); ?>  -->
        <?php if($_SESSION['ATP_PC_PO'] == 1): ?> <!--   only show presidents-->
     <!--   <php print_r($data['pcposts']); ?> -->
                           <!--  <?php $data['rows'] = $data['pcposts']; ?> -->
          <!--  <php print_r($data['rows']); ?> -->
        <?php endif; ?> 
       
         <?php foreach($rows as $row) { ?>
<?php if($_SESSION['ATP_PC_PO'] == 1 AND $row->trongate_user_level == 7): ?> 
<!-- skip code  -->
<?php else: ?>

                            <div class="social-avatar">
                                <a href="" class="float-left">

                                    <?php if($row->trongate_user_level == 7): ?>
                                  <!--      <p> 7 </p> -->
                                        <?php if(strlen($row->posterspicture) > 0): ?>
                                            <img alt="image" src="<?= BASE_URL?>ccmps_photos/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?>">
                                       


                                             <img alt="image" src="<?= BASE_URL?>ccmps_photos_thumbnails/default/default.png">




                                        <?php endif; ?> 
                                    <?php else: ?> <!--  MAYBE make this the doctors case and add a case for anyone else -->
                               <!--     <p> not 7 </p> -->
                                    <!--    <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->posterspicture ?>"> -->

<!-- need a default developers picture -->

<!-- <img alt="" src="<?= BASE_URL?>ccmps_photos/<?= $row->lvl10sapicdir ?>/<?= $row->posterspicture ?>"> -->

                                    <?php endif; ?> 
                                </a>
                                <div class="media-body">
                                 <!--   <php if($row->trongate_user_level == 15): ?> --> <!-- user level of poster, not logged in user  -->
                                    <?php if($row->trongate_user_level == 10): ?> <!-- user level of poster, not logged in user  -->
                                        <a href="#" style="font-size: 16pt">
                                           <i class="fa fa-desktop"></i> From the Developers<!-- <?= $row->fname?> <?= $row->lname?> -->
                                        </a> <!--  647  -->
                                    <?php else: ?>
         
                                            <a href="#" style="font-size: 14pt">
                                                <?= $row->fname?> <?= $row->lname?> 657<!-- ccmp <?= $_SESSION['tg_user_id'] ?> /<?= $row->trongate_user_level ?>/<?= $row->ccmp_rec_id ?>/<?= $row->posterspicture ?> -->
                                            </a>
                                     
                                    <?php endif; ?>  
                                <!--    661 -->
                                    <!--    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>-->
                                    <?php if(strlen($row->updated_at) > 0 AND $row->updated_at != $row->updated_at): ?> <!-- $row->updated_at != '1st Jan 1970'  -->
                                      <small class="text-muted" style="font-size: 12pt"><?= $row->post_date ?></small><small class="text-muted" style="font-size: 12pt"><strong> Updated388</strong> <?= $row->updated_at ?></small>
                                    <?php else: ?> 
                                        <small class="text-muted" style="font-size: 12pt"><?= $row->post_date ?></small>
                                    <?php endif; ?>                            

                            <div class="social-body">
<?php if($_SESSION['ATP_PC_PO'] == 1 AND $row->trongate_user_level == 7): ?> <!--   only show presidents posts-->
<!-- skip code  784-->
<?php else: ?> 

<?php if($row->trongate_user_id == $_SESSION['tg_user_id']): ?> <!-- If the user is looking at their own question  -->

                        <!--  Save changes to your own question -->
                        <form  method = "post" action="<?= BASE_URL ?>blogs-asks/saveaskpost/<?= $row->id ?>"> 
                            <div class="social-body">
 
                        <!--        <div class="social-comment">  makes text in input smaller  -->

                            <!--        <div class="media-body">  -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpost" class="form-control" value="$askpost" placeholder="Write your question here..." ><?= $row->post ?></textarea> 
                                                 
                            <!--        </div> -->
                          <!--      </div>  makes text in input smaller -->
                            <!--    <p></p> -->
                            <!--    <div class="form-group"> -->
                                    <div class="btn-group">


        <button class="btn btn-primary btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save Changes to Your Post 1116</a></button> 
        <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>blogs-asks/cancelaskpost/<?= $row->id ?>" ><i class="fa fa-times-circle"></i> Cancel</a> 
                                    </div>
                            <!--    </div> -->

                                </div>
                        </form>

  
<?php else: ?>
                                    <!-- SHOW THE QUESTION  -->
                                   <h2> <?= $row->post ?> </h2>
                               
                            <!--  all the comments on the question -->
                                <div class="btn-group">
                 <!-- If you posed the question you may edit or remove it so you will need what you wrote in a form  -->        
    <?php if($row->trongate_user_id == $_SESSION['tg_user_id']): ?>

                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobisaveeditsquestion/<?= $row->id ?>" ><i class="fa fa-save"></i> Save Edits</a>
                <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobideletequestion/<?= $row->id ?>" ><i class="fa fa-remove"></i> Delete Question</a>
    <?php endif; ?>                                
                                </div>                             
<?php endif; ?> 

                                <!-- Show the doctors response first then the rest of the comments  -->

                                <?php if(strlen($row->response) > 0 AND $row->response != ' '): ?> <!-- strlen of a space = 1  --> <!-- If the doctors response exists  -->

                                   <div class="social-avatar"> 
                                       <!-- If it is the Doctors own post they responded to in the admin section above say Doctors Follow on Post -->
                                     <div class="media-body"> 
                          <!--      <a href="" class="float-left"> -->
                                        <!--  <php if($row->trongate_user_level == 15): ?> -->
                                            <?php if($row->trongate_user_level == 10): ?>  
<!-- Their picture is already there as the poster so redundant --> <!-- <a href="#">
                                                    <img alt="image" src="<?= BASE_URL?>system_accounts_photos/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> xxx
                                                </a> -->

                                            <?php else: ?> <!-- Doctors picture with their response  --> 
                                            <!-- commented out for simplification and cant get text + date to line up with picture w/o date being next to text not under -->

                                            <!--    <a href="#">
                                                    <img alt="image" src="<?= BASE_URL?>system_accounts_photos_thumbnails/<?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?>"> 
                                                </a> -->
                                            <?php endif; ?>
                            
                                        <!--    <php if($row->trongate_user_level == 15): ?> -->
                                                <?php if($row->trongate_user_level == 10): ?> 
                                                <a href="#" style="font-size: 14pt">
                                                    <i class="fa fa-microphone"></i> <?= $first_name ?>'s Follow-on Post
                                                  <!--  <i class="fa fa-user-md"></i> Doctor's Follow-on Post -->
                                                     <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> -->
                                                </a>

                                            <?php else: ?> <!-- Else if it is not the Doctors own post, say Doctors Response --> 
                                                <a href="#" style="font-size: 14pt">
                                                    <i class="fa fa-microphone"></i> <?= $first_name ?>'s Response 747
                                                 <!--   <i class="fa fa-user-md"></i> Doctor's Response 471 -->
                                                    <!-- <?= $row->lvl15sapicdir ?>/<?= $row->responsepicture ?> decided no picture here -->
                                                </a>
                                            <?php endif; ?>

                                            <?php if(strlen($row->response_date) > 0 AND $row->response_date != '1st Jan 1970'): ?>
                                                <small class="text-muted" style="font-size: 12pt"><?= $row->response_date ?> 754</small>
                                            <?php endif; ?> 


                                            <!-- SHOW THE RESPONSE  -->

                                    <!-- the response from the database -->
                                   <h2> <?= $row->response ?> </h2>

                                        </div>  <!--media body -->
                                    </div>  <!-- social avatar  -->

  <!--  </a> -->

                                         

                                <?php endif; ?> 
  

                                        <!-- foreach loop to display the comments associated with this post  -->
      
                               <!--     <div class="media-body"> -->
                                    <!--    <div class="social-avatar"> dont know where closing div is. Made a difference -->
                                        <?php if(strlen($row->response) > 0): ?> 
                                       <!-- no spacing necessary so this intentionally left empty -->
                                        <?php else: ?> 
                                            <!-- was as break for space between docs response and participant responses  -->
                                      <!--  When comment put into a dropdown panel this became unnecessary -->

                                        <?php endif; ?> 
 <?php endif; ?> <!-- skip code line 668 -->

                   <!--     <div class="ibox-content"> -->
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: 13pt">View Questions or Comments (<?= $row->cmtcount ?>) <i class="fa fa-chevron-down"></i></a> <!-- 795  -->
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">

                                        <?php foreach($comments as $cmt) { ?>

                                            <?php if($cmt->post_id == $row->id): ?>  <!-- if this comment belongs to this post -->
                                       <!--     <div class="social-feed-box"> -->
                                        <!-- Purposely disabling pictures with comment - make choice in config - uncomment out to show pics  -->
                                            <!--    <?php if(strlen($cmt->commentorpicture) > 0): ?>
                                                    <img alt="image" src="<?= BASE_URL?>ccmps_photos_thumbnails/<?= $cmt->recid ?>/<?= $cmt->commentorpicture ?>">  
                                                <?php endif; ?> -->
                                        <?php if(strlen($row->response) > 0): ?> 
                                       
                                        <?php else: ?> 
                                             <br/>
                                        <?php endif; ?> 

                                                <?php if(strlen($cmt->updated_at) > 0 AND $cmt->updated_at != $cmt->comment_date): ?>
                                            <!--      <php print_r($cmt->updated_at); print_r($cmt->comment_date);  ?>   -->
  <br> <!-- 814 -->
                                                   <span><i class="fa fa-comment"></i></span> <small class="text-muted" style="font-size: 12pt"> <?= $cmt->fname ?> <?= $cmt->lname ?></small><small class="text-muted" style="font-size: 12pt"> <?= $cmt->comment_date ?></small><small class="text-muted" style="font-size: 12pt"><strong> Updated</strong> <?= $cmt->updated_at ?></small>
                                                <br/>
                                                <?php else: ?>
<br> <!--  818 -->
                                               <span ><i class="fa fa-comment"></i></span> <small class="text-muted" style="font-size: 12pt"> <?= $cmt->fname ?> <?= $cmt->lname ?></small><small class="text-muted" style="font-size: 12pt"> <?= $cmt->comment_date ?></small>
                                                <br/>
                                                <?php endif; ?>


                        <?php if($cmt->trongate_user_id == $_SESSION['tg_user_id']): ?> <!-- If the user is looking at their own comment  -->
                                                    <!-- Then need a form to edit it  -->
                                                   <!--     <p>edit form here</p> -->
                        <br/> <!-- no effect anymore -->

                        <!-- pc is passed so $_SESSION['ccmphomereturnto'] can be set in Asks controller/savecommentonpost() -->
                        <form  method = "post" action="<?= BASE_URL ?>blogs-asks/savecommentonpost/<?= $row->id ?>/<?= $cmt->id ?>/pc"> 
                         <!--   <div class="social-body"> -->
 
                         <!--      <div class="social-comment"> -->

                            <!--        <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                         <textarea name="askpostcomment" class="form-control" value="$askpostcomment" style="font-size:16pt"><?= $cmt->comment ?></textarea>
                                                 
                              <!--      </div> -->
                           <!--     </div> -->
                                                               <div class="form-group"> 
                               <!--     <p></p>  -->                       
                                    <div class="btn-group">
       <button class="btn btn-primary btn-xs"><a name="submit" type="" value="Submit" style="font-size: 14pt"><i class="fa fa-save"></i> Save Changes1</a></button><span style="color:White;">~</span> <!--  845  -->

        <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>welcome-ccmps/ccmphome" style="font-size: 14pt"><i class="fa fa-times-circle"></i> Cancel </a>

        <a class="btn btn-danger btn-xs" href="<?= BASE_URL ?>blogs-asks/deletecommentonpost/<?= $row->id ?>/<?= $cmt->id ?>/pc" style="font-size: 14pt"><i class="fa fa-times-circle"></i> Delete</a> 

                                </div>
   <!--     <button class="btn btn-primary" name="submit" type="" value="Submit" ><h3><i class="fa fa-save"></i> Save Changes to Your Comment566</h3></button> -->

     <!--   <button href="<?= BASE_URL ?>blogs-asks/blog/<?= $_SESSION['admode'] ?>" class="btn btn-warning btn-xs" name="cancelctc" ><h3><i class="fa fa-times-circle"></i> Cancel xxx</h3></button> -->

            <!--    <button href="<?= BASE_URL ?>blogs-asks/cancelaskpost/<?= $row->id ?>" class="btn btn-warning btn-xs" name="cancelctc" ><h3><i class="fa fa-times-circle"></i> Cancel xxx</h3></button> -->

    <!--    <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>blogs-asks/cancelaskpost/<?= $row->id ?>" ><i class="fa fa-times-circle"></i> Cancel</a> -->
                                 
                                      
                                </div>

                           <!--     </div> -->
                        </form>





                                                    <?php else: ?>

                                                        <!-- SHOW THE COMMENTS  -->
                                                      <h2>  <?= $cmt->comment ?> </h2>
                                                   <!--  <br>    --> <!-- Controls space between comments -->


                                                    <?php endif; ?>                                                                                                      

                                      <!--     </div> -->                           
   <!--  <textarea name="askpostcomment" value="$askpostcomment"> <?= $cmt->comment ?></textarea> -->                                
                           <!--     <p></p> -->
                                            <?php endif; ?>                               
                                                    
                                        <!-- End foreach comment -->            
                                        <?php
                                        }
                                        ?>
                                            </div> <!-- end class panel body  -->
                                        </div> <!-- end id = collapseOne  -->
                                    </div> <!-- end class = panel panel-default  -->
                       </div> <!-- end panel-group  -->
                    </div> <!-- end panel-body  -->
           <!--     </div>  ibox-content  -->
                                            <!-- Get New Comment on the  Question - not on the response  -->

            <!--        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> for now only comment on original post, not response like line 587 -->


                        <!-- pc is passed so $_SESSION['ccmphomereturnto'] can be set in Asks controller/savecommentonpost() -->
                        <form  method = "post" action="<?= BASE_URL ?>blogs-asks/savecommentonpost/<?= $row->id ?>//pc"><!-- Same as line 587 -->
                            <div class="social-body"> 
 
                            <!--    <div class="social-comment"> -->

                             <!--       <div class="media-body"> -->

                                    <!--     <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > -->
                                    <!-- Will need two cases: Blank when a 7 responds to a docs response or follow on & docs entering a follow on:placeholder="New Enter optional follow-on... -->
                             <!--       <php if($row->trongate_user_level == 15): ?>  not implementing comment on follow on, just original post      -->                            
                                    <!--     <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Follow-on line 542..." ></textarea> -->

                          <!--          <php else: ?> -->
                                     <!--    <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Response..." ></textarea> -->
<!-- Adds space between comments dropdown panel and the enter new comment back    <br/>  -->



                                        <!-- COMMENT ON A POST  -->
                                        <textarea name="askpostcomment" class="form-control" value="$askpostcomment" style="font-size: 14pt" required><?= $row->comment ?></textarea> <!-- dont work in textarea placeholder="Add comment..." -->
                        <!--            <php endif; ?>   -->                                                                                       
                              <!--      </div> -->
                           <!--     </div> -->

                            <!--    <div class="form-group"> -->
                                <!--  <div class="btn-group">  makes buttons stick together -->
                                <p>   <div class="btn-group">


   <!--  x     <button class="btn btn-primary btn-xs" name="submit" type="" value="Submit" ><h3><i class="fa fa-save"></i> Save Changes to Your Comment640</h3></button>
                <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>blogs-asks/cancelaskpost/<?= $row->id ?>" ><i class="fa fa-times-circle"></i> Cancel</a> -->

       <button class="btn btn-primary btn-xs"><a name="submit" type="" value="Submit" style="font-size: 14pt"><i class="fa fa-save"></i> Save New Comment1</a></button><span style="color:White;">~</span> <!--  930  -->
        <a class="btn btn-warning btn-xs" href="<?= BASE_URL ?>welcome-ccmps/ccmphome" style="font-size: 14pt"><i class="fa fa-times-circle"></i> Cancel</a> 


                                    </div> </p>

                                <!-- not implementing comment on follow on, just original post      --> 
                            <!--        <div class="btn-group">
 
                                    <!-- <php if($row->trongate_user_level == 15): ?> -->
                                    <?php if($row->trongate_user_level == 10): ?> 
                                      <!--      <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Follow-on)</a></button> 
                                                           <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> -->
                                    <?php else: ?> 
                                    <!--       <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Response)</a></button> 
                                            <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a> -->
                                    <?php endif; ?>

                                </div> 

                        
                        </form>
   
 <!--  Put end skip code here to take away ability to comment in Presidents corner -->

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                             <!--       </div> line 437 -->
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                             <!--       </div>  line 436 -->

                             <!-- End Get New Comment on the  Question - not on the response  -->




                                    </div>

                            </div>





                                <!--  Doctors response to the question -->

                            <div class="social-footer"> <!-- line 499 -->
                                <!-- if a response exists in the database -->
                                <?php if(strlen($row->response) > 0): ?>  <!-- line 506 -->
                         <!--       <div class="social-comment"> -->
                                    <!-- <div class="media-body"> -->                                        

<!-- used to show docs response here but moved above  -->

                                            <!-- Get New Comment on the  Question - not on the response  -->

            <!--        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisaveaskresponse/<?= $row->id ?>"> for now only comment on original post, not response like line 587 -->
                        <form  method = "post" action="<?= BASE_URL ?>welcome/mobisavecommentonpost/<?= $row->id ?>/<?= $cmtid ?>"> <!-- Same as line 587 -->
                     <!--       <div class="social-body"> -->
 
                                <div class="social-comment"> 

                                    <div class="media-body"> 

                                         <input name="askpost" type="textarea" class="form-control" placeholder="Type Post here..." value=<?= $askpost ?> > 
                                    <!-- Will need two cases: Blank when a 7 responds to a docs response or follow on & docs entering a follow on:placeholder="New Enter optional follow-on... -->
                                  <?php if($row->trongate_user_level == 10): ?> <!-- 15 for docs  not implementing comment on follow on, just original post      -->                            
                                        <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Follow-on line 542..." ></textarea> 

                                    <?php else: ?> 
                                     <!--    <textarea name="askresponse" class="form-control" value="$askresponse" placeholder="Comment on Response..." ></textarea> --
                                        <textarea name="askpostcomment" class="form-control" value="$askpostcomment" placeholder="Click here to comment3 on docs response...line 560". ><?= $row->comment ?></textarea> -->
                                   <?php endif; ?>                                                                                          
                                    </div> 
                                </div> 
                                                           <!--    <div class="form-group"> --
                                    <div class="btn-group">


        <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-save"></i> Save New Comment 707 dr</a></button> 
                       <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a> 
                                    </div> -->

                                <!-- not implementing comment on follow on, just original post      --> 
                                    <div class="btn-group">
 
                                 <!--   <php if($row->trongate_user_level == 15): ?> -->
                                    <?php if($row->trongate_user_level == 10): ?>  
                                            <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Follow-on)</a></button> 
                                                           <a href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" class="btn btn-white btn-xs" name="cancelcoq" >Cancel</a>
                                    <?php else: ?> 
                                      <button class="btn btn-white btn-xs"><a name="submit" type="" value="Submit" ><i class="fa fa-comment"></i> Save Comment (Response)</a></button> 
                                            <a class="btn btn-white btn-xs" href="<?= BASE_URL ?>welcome/mobicancelaskpost/<?= $row->id ?>" ><i class="fa fa-remov"></i> Cancel</a> 
                                    <?php endif; ?>
                                    </div> 
                                </div> 

                               </div>  <!--line  -->
                        </form>

  <!--      <textarea class="form-control" value="$post"><?= $row->response ?></textarea> -->
                             <!--       </div> line 437 -->
                                   
                                <!--        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                        <small class="text-muted">10.07.2014</small>  -->
                             <!--       </div>  line 436 -->

                             <!-- End Get New Comment on the  Question - not on the response  -->

                                </div> <!-- social footer -->



                                <!-- Else no reponse yet show response box   -->
                                <?php else: ?> <!-- line 525 -->
                           <!--     <div class="social-comment">
                                    <div class="media-body"> -->

                                <!--    <php if($row->trongate_user_level == 15): ?> --><!-- Posted by the principals themselves ie A doctor's post -->
  <?php if($row->trongate_user_level == 10): ?> <!-- Posted by the principals themselves ie A doctor's post -->

                                    <?php else: ?> <!-- Not doctors responding to their own post line 514 -->    <!-- Comment on question -->



                                    <?php endif; ?> <!-- line 547 -->
                               <!--     </div>
                                </div> -->
                                <?php endif; ?> <!-- line 525, 605, 665 -->

                                <!-- End if response -->

                            </div>
            <!--    </td>            
            </tr>  -->
<?php endif; ?> <!-- Skip Code  -->
            <!-- end foreach -->
            <?php 
            }
            ?>
        </tbody>
    </table>


<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <?php endif; ?> <!-- End CCMP frm line 304 -->
            <?php endif; ?> <!-- line 77, 298 -->

               
                
              
                
        <!--    </div> --><!-- line 272 row-->
 

  
  <!--   </div> --> <!--  ibox content  begins 279 -->
 
 <!--   </div> --> <!-- line 275 ibox content page -->

<!-- End Content   -->
<br>


   <!-- Begin Modals -->
<!--          
<div class="modal inmodal fade" id="delete-modal<?= $row->id; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete Notice</h4>
            </div>
            <div class="modal-body">
                <p><h1><strong>Are you sure?</strong></h1></p>
                <h3>Once deleted it can't be undone.</h3>
                <?php echo $row->id; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                 <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-notices/delrecord/<?= $row->id ?>/m">Delete <?= $row->id ?></a>
            </div>
        </div>
    </div>
</div> -->


<!-- Must load jquery first when locally controlling datatables settings below. OK for datatables js to be in Inspinia template file  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
        <script>
        $(document).ready(function(){
            // code to dynamically generate for DelButton
            var myRow = 0;
            $(".DelButton").each(function(){
                myRow = myRow +1;
                $(this).attr("id", "DelButton" + myRow);
            });

            //from datatables
            $('.dataTables-example').DataTable({
                paging: true,
                searching: true,
                pageLength: 1000,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
              /*      { extend: 'copy'},
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
                    } */
                ] 

            });
                    // $("#btn.8").on('click',function(){  
                        $("#btn.5").click(function(){  
alert('fired!');                

            });
                        $("#checkAll").click(function(){  
//alert('fired!');  
  // Each submit button on a tab that triggers what is selected in the dropdown for bulk actions must be unique.
                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll2").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });
 
             $("#checkAll3").click(function(){     

                if($(this).is(":checked")){
             
                    $(".checkItem").prop('checked',true);
                }else{
               
                    $(".checkItem").prop('checked',false);
                }
           
            });            



         
    });
    </script>
               <!--     </div> 282 -->
            <!--    </div> 273 -->
            </div>

      <!--      <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">National</span>
                        </div>
                        <h5>National Members</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?= $numcurrentbpamembers ?></h1>
                        <div class="stat-percent font-bold text-danger"><?= $pcntcurrentbpamembers ?>%  Renewal Rate </div>
                        <small><?= $numpastduebpamembers ?> past due</small>
                    </div>
                </div>
            </div> -->


           </div> <!-- ibox content line 268 -->

    <!--    </div> ibox line 246 -->

       



                           <!--  ****************************************************************************** -->
                                                        </div><!--ibox content  -->
                </div><!--ibox   -->       
                </div> <!-- faq answer-->                                  
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->
                </div><!-- col 12  -->
                </div><!-- row   -->
                </div>
                </div>
                </div><!-- End faq-item  -->
<!--   End Accordian Section -->  

<!--  Begin Accordian Section -->
                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">

                                    <a data-toggle="collapse" href="#faq2" class="faq-question" style="color:Gray;"><h2> <i class="fa fa-bullhorn fa-1x"></i> <strong> Notices </strong></h2></a>
                       
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 2): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq2" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq2" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                    
                                    <!--    <div id="faq2" class="panel-collapse collapse"> -->
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox "> 
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                    <!--    <div class="ibox-content">  --><!-- BEGINNING OF CONTENT FOR SECTION  -->
<!--  ****************************************************************************** -->

    <!--    <div class="row wrapper border-bottom white-bg page-heading"> --><!--BEGINNING OF NOTICES  -->
 

        <div class="wrapper wrapper-content animated fadeInUp"> 
            <br>
            <div class="row"><!-- ROW OF NOTICES  -->

                <?php foreach($ntcdata as $row) { ?>

                 <div class="col-md-3">
                    <div class="ibox">         
                        <div class="ibox-content product-box">


                            <div class="product-desc">
<ul class="nav metismenu" > <!-- keeps bullets from showing up -->                           
                        <li>
                            <div>
                                <?= $row->created_at ?> 
                             <p class="text-muted">For <?= $row->scope ?></p>

                              <h2 style="color:RoyalBlue;" ><?= $row->title ?></h2>
                              <h3>  <?= $row->shortdescription ?> </h3>
                                <?php if(strlen($row->cost) > 0): ?>
                                   
                              <p>  <strong>Cost</strong> <?= $row->cost ?> </p>
                                 
                                <?php else: ?>
                                <?php endif; ?>

                             <!--    <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>   -->                                 
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact</strong> <?= $row->contact_info ?>
                                <?php endif; ?>  

                            <!--    <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  --> 
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:RoyalBlue;" href="<?= BASE_URL ?>cms-notices/fullnotice/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>
</ul>
  </div> <!-- class="product-desc"  -->
                        </div> <!-- class="ibox-content product-box" -->
                        
                    </div> <!-- class="ibox"  -->
   
                 </div> <!--  class="col-md-3"  -->

                        <?php } ?> 




                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF NOTICES SECTION -->



<!--  ****************************************************************************** -->

                </div> <!-- END Ibox content END OF CONTENT OF SECTION -->
               </div> <!-- ibox   -->                
                </div> <!-- faq answer-->                              
                            
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->

                </div>
                </div><!-- row   -->
                </div><!-- class md-col-12  -->

                </div><!-- row   --> 
                </div><!-- faq item   -->             

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   <!-- <i class="fa fa-ellipsis-v"></i>  -->
                                    <a data-toggle="collapse" href="#faq3" class="faq-question" style="color:Gray;"><h2><i class="fa fa-thumb-tack fa-1x"></i><strong> Bulletins </strong></h2></a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 3): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq3" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq3" class="panel-collapse collapse">
                                    <?php endif; ?> 

                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                    <!--       <div class="ibox-content">  want gray backround -->
                                        <!-- BEGINNING OF CONTENT FOR SECTION  -->
                                        <!--  ****************************************************************************** -->
                <div class="wrapper wrapper-content animated fadeInUp">
                <div class="row">
                 <div class="col-lg-12">
                    <ul class="notes">

                        <?php foreach($adsdata as $row) { ?>
                        <li>
                            <div>
                              <?= $row->poster ?> <?= $row->created_at ?>

                               <h4><?= $row->title ?></h4>
                                <?= $row->shortdescription ?>
                                <?php if(strlen($row->cost) > 0): ?>
                                    <br>  
                                    <strong>Price</strong> <?= $row->cost ?>
                                <?php else: ?>
                                <?php endif; ?>

                                <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>                                       
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact Me</strong> <?= $row->contact_info ?>
                                <?php endif; ?>

                                <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:RoyalBlue;" href="<?= BASE_URL ?>cms-bulletinboard/fullbulletin/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>

                        <?php } ?> 

                    </ul>
                </div>
            </div>
            </div> <!-- End of items  -->

            <!--  ****************************************************************************** -->
        <!--    </div> --><!-- ibox content   -->
            </div> <!-- ibox -->                                
            </div> <!-- End Tab 1 Panel -->
            </div><!-- faq#   -->
            </div><!-- col 12  -->
            </div><!-- row   -->
            </div>
            </div>
            </div><!-- End faq-item  -->  

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section --

                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                    <a data-toggle="collapse" href="#faq4" class="faq-question" style="color:RoyalBlue;"><strong>Photos & Videos <span class="fa fa-caret-down"></span></strong></a>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq4" class="panel-collapse collapse">
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
            
                                                    <!--    <div class="ibox-content"> white background --
                    <!--  ****************************************************************************** --
                    <div class="row">
                    <div class="col-md-3 mb40">


                    </div>

                     <div class="col-md-4">
                        <br>
                         <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/Trvo5PQWwdw" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   --
                        </div>    
                    </div>
    
                    <div class="col-md-4">
                        <br>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/wixm0fN1QD0" allowfullscreen></iframe>  <!--  src="//www.youtube.com/embed/kn-1D5z3-Cs"   --
                        </div> 
                

                    </div>
                    <div class="col-md-1">

                    </div>
                </div>

                <!--  ****************************************************************************** --
         
                </div><!--ibox   --       
                </div> <!-- faq answer--                                 
                </div> <!-- End Tab 1 Panel --
                </div><!-- faq#   --
                </div><!-- col 12  --
                </div><!-- row   --
                </div>
                </div>
                </div><!-- End faq-item  --

<!--   End Accordian Section -->  
              
<!--  Begin Accordian Section -->
                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">

                                    <a data-toggle="collapse" href="#faq4" class="faq-question" style="color:Gray;"><h2> <i class="fa fa-dollar fa-1x"></i> <strong> Jobs </strong></h2></a>
                       
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 4): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq4" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq4" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                    
                                    <!--    <div id="faq4" class="panel-collapse collapse"> -->
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox "> 
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                    <!--    <div class="ibox-content">  --><!-- BEGINNING OF CONTENT FOR SECTION  -->
<!--  ****************************************************************************** -->

    <!--    <div class="row wrapper border-bottom white-bg page-heading"> --><!--BEGINNING OF JOBS  -->
 

        <div class="wrapper wrapper-content animated fadeInUp"> 
            <br>
            <div class="row"><!-- ROW OF JOBS  -->

                <?php foreach($jobdata as $row) { ?>

                 <div class="col-md-3">
                    <div class="ibox">         
                        <div class="ibox-content product-box">


                            <div class="product-desc">
<ul class="nav metismenu" > <!-- keeps bullets from showing up -->                           
                        <li>
                            <div>
                                <?= $row->created_at ?> 
                             <p class="text-muted">For <?= $row->scope ?></p>

                              <h2 style="color:RoyalBlue;" ><?= $row->title ?></h2>
                              <h3>  <?= $row->shortdescription ?> </h3>
                                <?php if(strlen($row->location) > 0): ?>
                                   
                              <p>  <strong>Location</strong> <?= $row->location ?> </p>
                                 
                                <?php else: ?>
                                <?php endif; ?>

                             <!--    <?php if(strlen($row->current_bid) > 0): ?>  
                                    <strong>OBO is</strong> <?= $row->current_bid ?>
                                <?php else: ?>
                                <?php endif; ?>   -->                                 
                            
                                <?php if(strlen($row->contact_info) > 0): ?>  
                                    <strong>Contact</strong> <?= $row->contact_info ?>
                                <?php endif; ?>  

                            <!--    <?php if(strlen($row->alt_contact_info) > 0): ?>
                                        <?php if(strlen($row->contact_info) > 0): ?>  
                                            <strong>or</strong>   <?= $row->alt_contact_info ?>  
                                        <?php else: ?>
                                            <strong>Contact</strong>  <?= $row->alt_contact_info ?>  
                                        <?php endif; ?>
                                <?php endif; ?>  --> 
                      <!--      Commented out to make fullbulletin available on all so can see bigger print even if isnt a full description -->
                           <!--      <php if(strlen($row->fulldescription) > 0): ?> -->
 <a style="color:RoyalBlue;" href="<?= BASE_URL ?>cms-jobs/fulljob/<?= $row->id ?>/<?= $row->tg_user_id ?>">   <strong>Read more...</strong></a><!--    <a class="btn btn-outline btn-blue btn-xs" type="button" data-toggle="modal" data-target="#bulletin-modal"><i class="fa fa-book"></i> Read More...</a> -->
                                                                                 
                          <!--      <php endif; ?>  -->
                                  
                                <!--    <a href="<?= BASE_URL ?>welcome-ccmps/currentdirectory/<?= $row->ccmp_id ?>"><strong>Contact Me</strong></a> -->

                            </div>
                        </li>
</ul>
  </div> <!-- class="product-desc"  -->
                        </div> <!-- class="ibox-content product-box" -->
                        
                    </div> <!-- class="ibox"  -->
   
                 </div> <!--  class="col-md-3"  -->

                        <?php } ?> 




                </div> <!-- WRAPPER CONTENT  -->
            <!--   </div> --> <!-- WRAPPER BORDER - END OF JOBS SECTION -->



<!--  ****************************************************************************** -->

                </div> <!-- END Ibox content END OF CONTENT OF SECTION -->
               </div> <!-- ibox   -->                
                </div> <!-- faq answer-->                              
                            
                </div> <!-- End Tab 1 Panel -->
                </div><!-- faq#   -->

                </div>
                </div><!-- row   -->
                </div><!-- class md-col-12  -->

                </div><!-- row   --> 
                </div><!-- faq item   -->             

<!--   End Accordian Section -->   


<!--  Begin Accordian Section -->

                <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-2">   
                                     <a data-toggle="collapse" href="#faq5" class="faq-question" style="color:Gray;"><h2><i class="fa fa-calendar fa-1x"></i></i><strong> Events & Activities </strong></h2></a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 5): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq5" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq5" class="panel-collapse collapse">
                                    <?php endif; ?>                                     
                                      
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">

                                                   <!--     <div class="ibox-content"> -->
                            <!--  ****************************************************************************** -->


<!-- Vue JS Call  -->
<!-- <div id="messageapp">{{ message }}</div>  -->


       <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">

                    <!--
                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="text-center p-lg">
                                <h2>If you don't find the answer to your question</h2>
                                <span>add your question by selecting </span>
                            </div>
                        </div>  -->

<!--                    
              <?php foreach($actdata as $row) { ?>        
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h1><?= $row->title ?></h1>
                              <h3><?= $row->id ?>Posted by <strong><?= $row->poster ?> </strong> <i class="fa fa-clock-o"></i> <?= $row->created_at ?> </h3>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
<div class="row">
    <div class="col-lg-2">
    </div>
        <div class="col-lg-8">
    <h3><?= $row->shortdescription ?></h3>          
    </div>

        <div class="col-lg-2">
    </div>
</row>                            
                          

                        </div>
                    </div>
          
             <?php } ?>    
                        <br>
                        <br> -->
                        
                        <div class="ibox-content">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <?php foreach($actdata as $row) { ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        <!--    <h1 class="panel-title">  Makes type dark gray-->
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $row->id ?>"><h3> <?= $row->activitydates ?>, <?= $row->location ?></h3> <h2><!-- <i class="fa fa-angle-down fa-1x"></i> --> <?= $row->title ?> </h2> 
                                         <!--   </h1> -->
                                        </div>                                        
                                        <div id="collapse<?= $row->id ?>" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <a><?= $row->extlink ?></a>
                                            <!--     <br>
                                                <a><?= $row->location ?></a> -->
                                                 <br>
                                                <h2><?= $row->shortdescription ?></h2>
                                                 <br>
                                                 <h3><?= $row->fulldescription ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
               
<!--
                        <div class="faq-item">
                            <div class="row">
                                <div class="col-md-7">
                                    <a data-toggle="collapse" href="#faq9" class="faq-question">There are many variations of passages ?</a>
                                    <small>Added by <strong>Monica Smith</strong> <i class="fa fa-clock-o"></i> Today 1:60 pm - 11.06.2014</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="small font-bold">Alex Nowak</span>
                                    <div class="tag-list">
                                        <span class="tag-item">General</span>
                                        <span class="tag-item">License</span>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="small font-bold">Voting </span><br/>
                                    23
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="faq9" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>
                                                There are many variations of passages of Lorem Ipsum available, but the
                                                majority have suffered alteration in some form, by injected humour, or
                                                randomised words which don't look even slightly believable. If you are
                                                going to use a passage
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>



                           <!--  ****************************************************************************** -->                                                        
                                                  <!--      </div> --><!--ibox content  -->
                                                    </div><!--ibox   -->
                              
                                            </div> <!-- faq answer-->                              
                            
                                        </div> <!-- End Tab 6 Panel -->
                                    </div><!-- faq#   -->

                                </div><!-- col 12  -->
                            </div><!-- row   -->
                      </div>
                    </div>
                </div><!-- End faq-item  --> 

<!--   End Accordian Section --> 

<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-3">


 <!-- <a data-toggle="collapse" href="#faq6" class="faq-question" style="color:Gray;"><h2><i class="fa fa-book fa-1x"></i><strong> Library </strong></h2></a> -->
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 6): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq6" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq6" class="panel-collapse collapse">
                                    <?php endif; ?> 
                                      
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                        <div class="ibox-content">
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">

            <div class="row">
                
            </div> <!-- row  -->
           </div> <!-- wrapper-content  -->
     <!--  ****************************************************************************** -->
                                                        </div><!--ibox content  -->
                </div><!--ibox   -->       
                </div> <!-- faq answer-->                                  
                </div> <!-- End Tab 6 Panel -->
                </div><!-- faq#   -->
                </div><!-- col 12  -->
                </div><!-- row   -->
                </div>
                </div>
                </div><!-- End faq-item  -->
<!--   End Accordian Section --> 

<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-3">


<a data-toggle="collapse" href="#faq7" class="faq-question" style="color:Gray;"><h2><i class="fa fa-bar-chart-o fa-1x"></i><strong> Metrics </strong></h2></a>
                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if($_SESSION['hometab'] == 7): ?>
                                      <?php $_SESSION['hometab'] = 0; ?> <!-- reset to 0 -->
                                            <div id="faq7" class="panel-collapse">
                                      
                                    <?php else: ?> 
                                            <div id="faq7" class="panel-collapse collapse">
                                    <?php endif; ?>                                    
                                     
                                  
                                            <div class="faq-answer">

                                                    <div class="ibox ">
                                                      <!--    <div class="ibox-title">
                                                          <center> <h5>  </h5></center>
                                                           <div class="ibox-tools">
                                                                <a class="collapse-link">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                                    <i class="fa fa-wrench"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-user">
                                                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                                                    </li>
                                                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="close-link">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div> 
                                                        </div>-->
                                                        <div class="ibox-content">
                            <!--  ****************************************************************************** -->
        <div class="wrapper wrapper-content">

            <div class="row">
                <!--    <div class="ibox-content">
                        <h3>
                            Knob - Dial
                        </h3>
                        <p>
                            Easily create knob input style.
                        </p>
                        <div class="text-center">
                            <small>Simple knob example</small><br/><br/>
                            <div class="m-r-md inline">
                            <input type="text" value="<?= $pcntcurrentchaptermembers ?>" class="dial m-r-sm" data-fgColor="#1AB394" data-width="85" data-height="85" />
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="50" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <small>Dynamic knob example</small><br/><br/>
                            <div class="m-r-md inline">
                            <input type="text" value="75" class="dial m-r-sm" data-fgColor="#ED5565" data-width="85" data-height="85" data-cursor=true data-thickness=.3/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-step="1000" data-min="-15000" data-max="15000" data-displayPrevious=true/>
                            </div>
                            <div class="m-r-md inline">
                            <input type="text" value="60" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 />
                            </div>
                        </div>
                    </div> -->
            </div>

            <br>


        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                             <span class="label label-warning float-right">Chapter</span>
                        </div>
                        <h5>Chapter Members</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?= $numcurrentchaptermembers ?></h1>
                         <div class="stat-percent font-bold text-info">  <?= $pcntcurrentchaptermembers ?>%  Renewal Rate  </div>
                        <small><?= $numpastduechaptermembers ?> past due</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">National</span>
                        </div>
                        <h5>National Members</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?= $numcurrentbpamembers ?></h1>
                        <div class="stat-percent font-bold text-danger"><?= $pcntcurrentbpamembers ?>%  Renewal Rate </div>
                        <small><?= $numpastduebpamembers ?> past due</small>
                    </div>
                </div>
            </div>


            </div>

            <div class="row">
                      <div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numregchaptermembers ?></button>
                                Chapter Regular Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numregbpamembers ?></button>
                                National Regular Members
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numfamchaptermembers ?></button>
                                Chapter Family Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numfambpamembers ?></button>
                                National Family Members
                            </td>
 
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numascchaptermembers ?></button>
                                Chapter Associate Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numascbpamembers ?></button>
                                National Associate Members
                            </td>
 
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numstuchaptermembers ?></button>
                                Chapter Student Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numstubpamembers ?></button>
                                National Student Members
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numqstuchaptermembers ?></button>
                                Chapter Q Student Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numqstubpamembers ?></button>
                                National Q Student Members
                            </td>
 
                        </tr>  
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning m-r-sm"><?= $numhonchaptermembers ?></button>
                                Chapter Honorary Members
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary m-r-sm"><?= $numhonbpamembers ?></button>
                                National Honorary Members
                            </td>
 
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       



                           <!--  ****************************************************************************** -->
                                                        </div><!--ibox content  -->
                </div><!--ibox   -->       
                </div> <!-- faq answer-->                                  
                </div> <!-- End Tab 7 Panel -->
                </div><!-- faq#   -->
                </div><!-- col 12  -->
                </div><!-- row   -->
                </div>
                </div>
                </div><!-- End faq-item  -->

<!--   End Accordian Section --> 
<!-- <php endif; ?> -->
 
                                        </div>
                                        <div class="panel-footer">
                                             <small><?= $_SESSION['release_version'] ?></small>  
                                        </div>
                                    </div>            
                </div>
                <!-- Last 3 divs end the dashboard panel and panel body -->
            </div>
        </div>
    <!--    <hr>  -->
    </div>



<!--  Begin footer here -->

<!-- <div class="footer bg-primary"> -->
<!-- <div class="footer bg-gray"> -->
<!-- <div class="footer blue-bg"> -->
<!-- <div class="footer teal-bg"> -->



<!--  End footer here -->

</div> <!--  line 139 panel -->

 
  <!-- <div class="float-left"> -->
                                                         
   <!--    <h3> <img src="<?= BASE_URL ?>welcome_module/images/encoreletter29x38.png" alt="Logo"> ncore Business Solutions</h3>Encore Cyber Group &copy; 2022 - <?= $_SESSION['current_year'] ?> <?= $_SESSION['release_version'] ?> -->

<!-- </div> --> <!-- wrapper -->

   <!-- Begin Modals -->
<div class="modal inmodal fade" id="security-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:Red;"><i class="fa fa-warning"></i> Security Alert!</h4>
            </div>
            <div class="modal-body">
                <p><h1 style="color:Red;"><strong>Phishing Attack</strong></h1></p>
                <h3>Someone is sending emails posing as John Hicks wanting to buy gifts for employees and soliciting money from BPA members. </p><p><span style="color:Red;"> Do not open and delete immediately!</span></h3></p>
                <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                            <img src="<?= BASE_URL ?>welcome_module/images/sahicks.jpg" alt="Logo">
                                        </a> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <!--   <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-bulletinboard/delrecord/<?= $row->id ?>/m">Delete </a> -->
            </div>
        </div>
    </div>
</div> 

 <!-- Not Used   -->         
<div class="modal inmodal fade" id="bulletin-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:Blue;"><i class="fa fa-book"></i> Read More...</h4>
            </div>
            <div class="modal-body">
                <p><h1 style="color:Blue;"><strong>Bulletin</strong></h1></p>
                <h3><?= $row->fulldescription ?></h3>
                <a href="#" title="Boss - Multipurpose Premium Html5 Template">
                                            <img src="<?= BASE_URL ?>welcome_module/images/" alt="pic">
                                        </a> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <!--   <a class="btn  btn-danger" type="button" href="<?= BASE_URL ?>cms-bulletinboard/delrecord/<?= $row->id ?>/m">Delete </a> -->
            </div>
        </div>
    </div>
</div> 

<!-- From here down was added to change font size modal window  -->
<div class="modal inmodal" id="fontModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>


                <h3 class="modal-title"> <small><i class="fa fa-pencil"></i></small> Font Sizes</h3>                   
                <h2>Enter your default font sizes:</h2>
             
            </div> 
        <!-- Show flash message then reset it to blank  -->
   <!--    <= flashdata('<center><div style="font-weight: bold; color: red;">', '</div></center>'); 
        $flash_msg = '';
        set_flashdata($flash_msg); ?> no way to refresh modal to see the message -->
       <center><h3 id="result" ></h3></center>

            <form action="" method = "post">  
            <div class="modal-body">
                
                <div class="form-group"> <!-- Used to pass the recid to ajax function. It is the record of the session user since changing own record always  -->                   
                    <input type="text" class="form-control" name="recid" id="recid" value="<?= $_SESSION['ccmp_rec_id'] ?>"  hidden>
                </div>
                <!--    <div class="row">
                        <div class="col-lg-8">
                        <label class="col-lg-6 col-form-label" style="color:RoyalBlue;"><h1>Enter:</h1></label>
                        </div>
                    </div> -->
                        
                        
                 <div >
                       <div class="col-lg-12">
                           <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h1>1 for Large</h1></label>
                       </div>
                         </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                 <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h2>2 for Medium</h2></label>
                       </div>
                 </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                 <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h3>3 for Small</h3></label>
                       </div>
                 </div>
                 <div class="form-group">
                       <div class="col-lg-12">
                                  <label class="col-lg-12 col-form-label" style="color:RoyalBlue;"><h4>4 for X Small</h4></label>
                       </div>                         
                 </div>
                  
             
                <div class="form-group row">
             
                    <div class="col-lg-8">
                        <label class="col-lg-6 col-form-label" style="color:RoyalBlue;"><h2>For Site Pages</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <p> <input type="text" class="form-control" name="fontsize" id="fontsize" value="<?= $_SESSION['fontsize'] ?>" placeholder="For Page Views" ></p>
                    </div>
                </div>
        
                <div class="form-group  row">
                
                    <div class="col-lg-8">
                        <label class="col-lg-7 col-form-label" style="color:RoyalBlue;"><h2>For Tables & Lists</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                         <input type="text" class="form-control" name="mfontsize" id="mfontsize" value="<?= $_SESSION['mfontsize'] ?>" placeholder="For Page Views" >
                    </div>
                    
                </div> 
                  <h2>Note: You may have to refresh the page to see the new font size</h2>
                <!-- not passing value selected in inspinia templates js -->
        <!--     <h2>
                 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:RoyalBlue;"><h3>For Pages</h3></label></div> 
                <div><label><input type="radio"  value="1" id="fontsize1" name="fontsize"> Large </label></div>
                <div><label><input type="radio"  value="2" id="fontsize2" name="fontsize"> Medium </label></div>                                       
                <div><label><input type="radio"  value="3" id="fontsize3" name="fontsize"> Small </label></div>
                 <div><label><input type="radio"  checked="" value="4" id="fontsize4" name="fontsize"> X Small </label></div>
            </h2> -->
                                 <!-- not passing value selected in inspinia templates js -->
                                      <!--     <div class="form-group  row"><label class="col-sm-6 col-form-label" style="color:RoyalBlue;"><h3>For Pages</h3></label>
                                              <div class="col-sm-6"><select class="form-control m-b" name="fontsize" value="<?= $_SESSION['fontsize'] ?>"  >
                                                <?php if($_SESSION['fontsize'] == '1'): ?>
                                                    <option selected value=1>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php elseif($_SESSION['fontsize'] == '2'): ?>
                                                    <option value='1'>Large</option>
                                                    <option selected value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option>                                                    
                                                <?php elseif($_SESSION['fontsize'] == '3'): ?>
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option selected value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php else: ?> 
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option selected value='4'>XSmall</option> 
                                                <?php endif; ?> 
                                                    
                                                </select>
                                               </div>                                              
                                            </div>
                <div class="form-group  row"><label class="col-sm-6 col-form-label" style="color:RoyalBlue;"><h3>For Tables</h3></label>
                                              <div class="col-sm-6">
                                                  <select class="form-control m-b" name="mfontsize" value="<?=  $_SESSION['mfontsize'] ?>"  >
                                                <?php if($_SESSION['mfontsize'] == '1'): ?>
                                                    <option selected value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php elseif($_SESSION['mfontsize'] == '2'): ?>
                                                    <option value='1'>Large</option>
                                                    <option selected value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option value='4'>XSmall</option>                                                    
                                                <?php elseif($_SESSION['mfontsize'] == '3'): ?>
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option selected value='3'>Small</option>
                                                    <option value='4'>XSmall</option> 
                                                <?php else: ?> 
                                                    <option value='1'>Large</option>
                                                    <option value='2'>Medium</option> 
                                                    <option value='3'>Small</option>
                                                    <option selected value='4'>XSmall</option> 
                                                <?php endif; ?> 
                                                </select>
                                               </div>                                              
                                            </div> -->
                
             
             <!--   <h3>Note: Refresh the page after changing the settings </h3> -->
   
            </div>
            <div class="modal-footer">
                <input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="FontID" id="FontBtn" ></input> <!-- Passes posted data to template inspinia.php js at bottom  -->
                 <button type="button" class="btn btn-warning full-width m-b" data-dismiss="modal">Cancel</button>

            </div>
          </form>

        </div> 
      </div>
    </div>

<!-- Put all session variables in hidden input fields to eliminate php evaluations for display logic -->

<!-- Begin Javascript for this view page  -->

    <!-- Vue.js CDN  for only this page ccmps/views/ccmphome. All others use templates/inspinia.php -->
    <!--     <script src="https://unpkg.com/vue@next"></script> latest dev version -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script> 

    <script>

      const JumboApp = {
        data() {
          return {
            jumbotronheader: 'What\'s Goin\' On!',
          //   jumbotronheader: 'Be There or Be Square!',
          }
        }
      }

      Vue.createApp(JumboApp).mount("#jumboapp")

    </script> 




