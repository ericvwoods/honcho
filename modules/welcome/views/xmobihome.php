<!-- <div id="content" role="main"> Content tags are already in header.php and footer.php -->

<!--<div class="mb40 mb20-xs"></div><!-- space -->

<div class="container">

<div class="row">

<div class="col-sm-3">
</div>
    <div class="col-sm-6">
        <div class="form-wrapper">
<br>
            <center><h3 class="title-underblock custom mb30">Welcome <?= $_SESSION['ccmp_first'] ?> </h3></center>  
            <center><p><h2>Black Pilots of America</h2></p> </center>
       <!--     <button class="btn btn-dark " type="button"><i class="fa fa-stethoscope"></i>&nbsp;&nbsp;News</button>
            
                <button class="btn btn-dark " type="button"><i class="fa fa-stethoscope"></i>&nbsp;&nbsp;Events</button>

                <button class="btn btn-dark " type="button"><i class="fa fa-stethoscope"></i>&nbsp;&nbsp;Ask Drs</button> -->
        

      
<center>
<!-- Show flash message then reset it to blank  -->

<?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
$flash_msg = '';
set_flashdata($flash_msg); ?> 

<h3>
<div class="btn-group">
<button data-toggle="dropdown" class="btn btn-dark dropdown-toggle">I want to ... </button>

<ul class="dropdown-menu">
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobimydata">View/Update My Information</a></li>

<!--       <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobicpw">Change My Password</a></li> -->
<li><a class="dropdown-item" href="#">Pay My Dues (future)</a></li>

<li class="dropdown-divider"></li>

<li><a class="dropdown-item" href="#">Register for Skyhook (Future)</a></li> 
<li><a class="dropdown-item" href="#">Register for the Board Meeting (Future)</a></li>
<li><a class="dropdown-item" href="#">Register for the General Meeting (Future)</a></li>    
 
<!--       <li><a class="dropdown-item" href="#">Social Feed</a></li>    
<li><a class="dropdown-item" href="#">Enter Clinical Data</a></li>    
<li><a class="dropdown-item" href="#">See my Clinical Data</a></li> -->

<!--       <li class="dropdown-divider"></li> -->
<!--       <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Ask the President</a></li> -->       
<!--        <li><a class="dropdown-item" href="#">National Social Feed</a></li>    -->    
<!--       <li><a class="dropdown-item" href="#">Get the latest News</a></li>
<li><a class="dropdown-item" href="#">See the Events Calendar</a></li> -->
<li class="dropdown-divider"></li>
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobicurrentroster">View Current Chapter Roster</a></li> 
<!-- If Chapter_role is 1 (President) of chapter_admin is flag 1 they have been given chapter admin rights in Welcome-_ccmp_auth --> 
<?php if($_SESSION['chapteradmin'] == 1): ?>                            
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobichapterroster">Manage Chapter (Phone version) <?= $_SESSION['chapteradmin'] ?></a></li>         
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/chapterroster">Manage Chapter (Computer version)</a></li>  
<?php endif; ?>

<!-- end if -->
<li class="dropdown-divider"></li>
<li><a class="dropdown-item" href="#" target="_blank">Go to our Chapter Website (future)</a></li>
<li><a class="dropdown-item" href="#" target="_blank">Go to our Chapter Facebook Page (future)</a></li>
        <li class="dropdown-divider"></li>
<li><a class="dropdown-item" href="https://www.bpapilots.org/" target="_blank">Go to the National Website</a></li>
<li><a class="dropdown-item" href="#" target="_blank">Go to the National Facebook Page (future)</a></li>



<!--        <li class="dropdown-divider"></li>
<li><a class="dropdown-item" href="#">Take a Survey</a></li>  
<li><a class="dropdown-item" href="#">Fill out a Form</a></li>
<li><a class="dropdown-item" href="https://www.gastonandporter.org/contact">Go to Contact Us Page</a></li> -->

<li class="dropdown-divider"></li>
<!--        <li><a class="dropdown-item" href="#">Get Help</a></li> -->
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobicpw">Change My Password</a></li>    
               
<li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/logout">Sign Out <i class="fa fa-sign-out"></i> </a></li>
</ul>
</div>
</h3>
<center><p><h3>Time to Renew your Membership for 2023!</h3></p></center>
<!--
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QZXCLSPAMZKMN">
<table>
<tbody><tr><td><input type="hidden" name="on0" value="Membership Dues">Membership Dues</td></tr><tr><td><select name="os0">
<option value="Renew National Regular Membership">Renew National Regular Membership $61.80 USD</option>
<option value="Renew National Associate Membership">Renew National Associate Membership $36.25 USD</option>
<option value="Renew National Family Membership">Renew National Family Membership $10.75 USD</option>
<option value="Renew National Student Membership">Renew National Student Membership $10.75 USD</option>
</select> </td></tr>
</tbody></table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img loading="lazy" alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></div><div class="thrv_wrapper thrv_text_element"><p data-css="tve-u-168d4fe012e" style="text-align: center;"><br>For electronic payments:&nbsp;<br>Click the application image on the left and print the PDF (shows in a new window)</p><p data-css="tve-u-168d4fe012e" style="text-align: center;">To pay by Check:<br>Click the application image on the left and print the PDF (shows in a new window)</p><p data-css="tve-u-168d4fe012e" style="text-align: center;">Please remit application and check (if applicable) to:</p><p data-css="tve-u-168d4fe012e" style="text-align: center;">BPA Pilots<br>c/o Les Morris<br>P.O. Box 1295<br>Green Valley, AZ 85622</p></div></div></div></div></div><div id="landingpage-bottom-section" class="landingpage-section bottom-section placeholder-section hide-section"><div class="section-background"></div><div class="section-content"></div></div></div></div>            </div>
<div class="fr-dropdown-holder tcb-style-wrap"></div>
</div> -->
<br>
<center><img alt="eoygive"  src="<?= BASE_URL ?>mobi/bpalogo380x320.jpg" img alt="eoygive"/></center> 
<br>
<!-- <center><a href="https://www.paypal.com/donate?token=kN6ITFLyCDgI3BT4doMsfAOCjnj2DApo-QTkC_YeLnylCqA8V04YazE8hn33iE8aSvN8u1HabLK-MP8a"><img alt="ptbook"  src="<?= BASE_URL ?>mobi/btn_donateCC_LG.gif" img alt="donate"/></a></center>    -->                     

<p class="m-t"> <small>Black Pilots of America &copy; 2022</small> </p>
</center>


<!-- <center><p><h3>Make 2021 Tax Year Donations until April 15th!</h3></p></center>
<center><img alt="eoygive"  src="<?= BASE_URL ?>mobi/eoygiving380x353.jpg" img alt="eoygive"/></center> 
<br>
<center><a href="https://www.paypal.com/donate?token=kN6ITFLyCDgI3BT4doMsfAOCjnj2DApo-QTkC_YeLnylCqA8V04YazE8hn33iE8aSvN8u1HabLK-MP8a"><img alt="ptbook"  src="<?= BASE_URL ?>mobi/btn_donateCC_LG.gif" img alt="donate"/></a></center> -->                        
        
       <!--    <img alt="gandplogo" src="<?= BASE_URL ?>modules/welcome/views/gandplogo.png" /> --> <!--- wont see it -->



        </div><!-- End .form-wrapper -->

    </div><!-- End .col-sm-6 -->

<div class="col-sm-3">
</div>

</div><!-- End .row -->
</div><!-- End .container -->

<!--     <div class="mb40 mb20-xs"></div><!-- space -->

<!--    </div><!-- End #content --> <!-- End content tag is already in the footer -->

<!-- Because we want the flxibility of using a different background on the page we are using a local footer -->

<!-- start: Footer-->
<!-- <php include('footer.php'); ?> -->                
<!-- end: Footer -->
