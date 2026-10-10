
<!-- Begin Top Menu   -->

<!-- Note: this file is not used for the ccmphome - it's navbar is hard coded at the top of the file --> 

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

              <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span> > <?= $_SESSION['ccmpmode'] ?> > <?= $id ?> > <?= $managemode?></strong></span> 
            <!-- Custom  -->
  
             <!--               <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span> > <?= $_SESSION['ccmpmode'] ?> > <?= $_SESSION['tab'] ?></strong></span>  -->
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
                    <li><span class="m-r"><a href="#"><h1 style="color: <?= NB_CLR ?>;" ><strong><?= CCMP ?> Services Portal</strong></h1></a> </span></li>
                <?php else: ?> 
                <!--    <li> <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME ?> </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME2 ?> </span> </a> </span></li> -->
              <!-- Custom  -->
                    <li> <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">S</span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">GAP </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME2 ?> </span> </a> </span></li>
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
                

            <li>
                <br>
                              
                             <!--   <?= $_SESSION['chapter_name'] ?>  -->       
<a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>" ><?= $_SESSION['ccmp_username'] ?></span>] </a> 

                             
                            
                            </li>
                <li>
                     <br>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>
                      </div>  <!-- col 6 -->
   
        </nav>
  </div> <!-- row  -->
  
<!-- From here down was added to change font size modal window  -->
<div class="modal inmodal" id="fontModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated rotateInDownRight">  <!-- rotateInDownRight, slideInRight,  bounceInRight, rotateIn, flip -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h3 class="modal-title"> <small><i class="fa fa-font fa-2x"></i></small> Fonts</h3>                   
                <strong><h2>Choose your desired font sizes:</h2></strong>
             
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
                        <label class="col-lg-6 col-form-label" style="color:CornFlowerBlue;"><h1>Enter:</h1></label>
                        </div>
                    </div> -->
<!--
                <ul>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h1>1 for Large</h1></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h2>2 for Medium</h2></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h3>3 for Small</h3></label> </li>
                    <li><label class="col-lg-12 col-form-label" style="color:CornFlowerBlue;"><h4>4 for X Small</h4></label> </li>                    
                </ul>  -->

                  
     <!--
                <div class="form-group row">
             <div class="col-lg-1">
             </div>
                    <div class="col-lg-6">
                        <label style="color:CornFlowerBlue;"><h2>For System Pages</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                        <p> <input type="text" class="form-control" name="fontsize" id="fontsize" value="<?= $_SESSION['fontsize'] ?>" placeholder="For Page Views" ></p>
                    </div>
                </div>
        
                <div class="form-group  row">
             <div class="col-lg-1">
             </div>                
                    <div class="col-lg-6">
                        <label  style="color:CornFlowerBlue;"><h2>For Tables & Lists</h2></label>
                    </div>
                    <div class="col-sm-2">
                        <br>
                         <input type="text" class="form-control" name="mfontsize" id="mfontsize" value="<?= $_SESSION['mfontsize'] ?>" placeholder="For Page Views" >
                    </div>
                    
                </div> -->
               
                <!-- not passing value selected in inspinia templates js -->
        <!--     <h2>
                 <div class="form-group  row"><label class="col-sm-5 col-form-label" style="color:CornFlowerBlue;"><h3>For Pages</h3></label></div> 
                <div><label><input type="radio"  value="1" id="fontsize1" name="fontsize"> Large </label></div>
                <div><label><input type="radio"  value="2" id="fontsize2" name="fontsize"> Medium </label></div>                                       
                <div><label><input type="radio"  value="3" id="fontsize3" name="fontsize"> Small </label></div>
                 <div><label><input type="radio"  checked="" value="4" id="fontsize4" name="fontsize"> X Small </label></div>
            </h2> -->
                                 <!-- not passing value selected in inspinia templates js -->
                <div class="form-group  row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">                
                        <h1>This is Large</h1>
                    </div>
                </div>
                <div class="form-group  row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">  
                         <h2>This is Medium</h2>
                    </div>
                </div>
                <br>
                <div class="form-group  row">
                    <div class="col-lg-3"></div>                    
                    <div class="col-lg-9">
                         <h3>This is Small</h3>
                    </div>
                </div>

                <br>                                                                                                                                                                               
                
                
                <div class="form-group  row">
          
                    <div class="col-lg-2"></div>

                    <div class="col-lg-4">
                        <label  style="color:CornFlowerBlue;"><h2>Select size:</h2></label>
                    </div>
                <div class="col-lg-4">
                <br>
         
                <select class="form-control m-b" name="fontsize" id="FontSel" value="<?= $_SESSION['fontsize'] ?>" style=" color: CornFlowerBlue; font-size:11pt" >
                     <?php if($_SESSION['fontsize'] == '1'): ?>
                         <option selected value=1>Large</option>
                         <option value='2'>Medium</option> 
                         <option value='3'>Small</option>
                       
                     <?php elseif($_SESSION['fontsize'] == '2'): ?>
                         <option value='1'>Large</option>
                         <option selected value='2'>Medium</option> 
                         <option value='3'>Small</option>
                                                                        
                     <?php elseif($_SESSION['fontsize'] == '3'): ?>
                         <option value='1'>Large</option>
                         <option value='2'>Medium</option> 
                         <option selected value='3'>Small</option>
                   
                     <?php endif; ?> 

                </select>
                                           
             
                     </div>
                </div>

            <br>
            <center><h3>You may need to refresh the page after submitting</h3></center>

            </div>
            <div class="modal-footer">
                <h2><input type="submit" value="Submit"class="btn btn-primary block full-width m-b" name="FontID" id="FontBtn" ></input></h2> <!-- Passes posted data to template inspinia.php js at bottom  -->
                 <h2><button type="button" class="btn btn-warning full-width m-b" data-dismiss="modal">Cancel</button></h2>

            </div>
          </form>

        </div> 
      </div>
    </div>
<!-- End Top Menu   -->

