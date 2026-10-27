
<!-- Begin Top Menu   -->

<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
<div class="row"> 
     <div class="col-md-5">  
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

        <div class="navbar-header">
     
         <!--   <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
         <ul class="nav navbar-top-links navbar-left">
        <li>
            <br>
      
             <?php if( DEBUGGING == true): ?>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">

             <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span> > <?= $_SESSION['ccmpmode'] ?> > <?= $id ?></strong></span>
            </a>         

            <?php else: ?> 
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">                
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span></strong></span>
            </a>
             <?php endif; ?> 

        </li>
      
        </ul>

        </div>
  </div>  <!-- col 6 -->
          <div class="col-md-4">
              <br>
            <ul class="nav navbar-top-links navbar-left">

                <?php if($_SESSION['ccmpmode'] == 'mmdv' ||  $data['view_file'] == 'directorylist' ||  $data['view_file'] == 'currentroster'): ?> 
                    <li><span class="m-r"><?= title_bar_name('admin') ?></span></li>
                <?php else: ?> 


                    <li><span class="m-r"><?= title_bar_name('admin') ?></span></li> 

                    <!-- <?= SITENAME2 ?>   -->
               <!--    <li> <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME ?> </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME2 ?> </span> </a> </span></li>  -->
              
                <?php endif; ?> 
               
            </ul> 
       
          </div>  <!-- col 4 -->
                <div class="col-md-3">
          <!--   <li>
             
                <br>
                <a  data-toggle="modal" data-target="#fontModal">

                    <div>

                        <i class="fa fa-wrench"></i> Change Font [<span style="color: <?= NB_CLR ?>"><?= $_SESSION['dfontsize'] ?></span>]
                            
                    </div> 
                </a>
            </li> -->
            <ul class="nav navbar-top-links navbar-right">
       
                <?php if($_SESSION['ccmpmode'] == 'mngallccmps' || $_SESSION['ccmpmode'] == 'honchomngallccmps' ): ?> 

                    <?php else: ?> 

<!-- no modal to make it work <li> <br> <a data-toggle="modal" data-target="#fontModal"  style="color: <?= CCMPS_HM_TAB_TITLE_CLR ?>"><span style="color: <?= CCMPS_HM_TAB_ICON_CLR ?>;"><i class="fa fa-wrench fa-1x"></i></span><strong>Font</strong></a></li>  -->                            
          
      <?php endif; ?> 
            <li> 
                   <br> 
<!--   <?= $_SESSION['chapter_name'] ?>  -->       
<a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>" ><?= $_SESSION['ccmp_username'] ?><?= $_SESSION['honcho_username'] ?></span>] </a> 
           
            </li>
              <?php if($_SESSION['honcho_logged_in'] == 1): ?>
                 <li>
                     <br>
                    <a href="<?= BASE_URL ?>honcho/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>           
              <?php else: ?>  
                <li>
                     <br>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
              <?php endif; ?> 
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>
                      </div>  <!-- col 6 -->
   
        </nav>
  </div> <!-- row  -->
  

<!-- End Top Menu   -->

