
<!-- <div id="content" role="main"> Content tags are already in header.php and footer.php -->

<!--<div class="mb40 mb20-xs"></div><!-- space -->

            <div class="container">

                <div class="row">

                <div class="col-sm-3">
                </div>
                    <div class="col-sm-6">
                        <div class="form-wrapper">
<br>
                    <!--        <center><h2 class="title-underblock custom mb30">Welcome to My Primetime</h2></center>  -->
                            <center><p><h3>A Revolutionary You: Mind, Body and Spirit!</h3></p> </center>
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

        <li><a class="dropdown-item" href="#">My Circle Social Feed</a></li>    
        <li><a class="dropdown-item" href="#">Enter Clinical Data</a></li>    
        <li><a class="dropdown-item" href="#">See my Clinical Data</a></li>

        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobiaskptsc">Ask the Doctors</a></li>        
        <li><a class="dropdown-item" href="#">National Social Feed</a></li>        
        <li><a class="dropdown-item" href="#">Get the latest News</a></li>
        <li><a class="dropdown-item" href="#">See the Events Calendar</a></li>
      
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="https://www.gastonandporter.org/">Go to our Website</a></li>
        <li><a class="dropdown-item" href="https://www.facebook.com/groups/395220337174381/">Go to our Facebook Page</a></li>
        <li><a class="dropdown-item" href="http://www.amazon.com/exec/obidos/tg/detail/-/0345432150/qid=1041850968/sr=12-1/102-3717357-2068906?v=glance&s=books">Purchase the book Primetime</a></li>

        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Take a Survey</a></li>  
        <li><a class="dropdown-item" href="#">Fill out a Form</a></li>
        <li><a class="dropdown-item" href="https://www.gastonandporter.org/contact">Go to Contact Us Page</a></li>

        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/mobicpw">Change My Password</a></li>    
        <li><a class="dropdown-item" href="#">Update My Contact Info</a></li>

        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Get Help</a></li>              
        <li><a class="dropdown-item" href="<?= BASE_URL ?>welcome/logout">Sign Out <i class="fa fa-sign-out"></i> </a></li>
    </ul>
</div>
</h3>
</center>

<center><p><h3>Make 2021 Tax Year Donations until April 15th!</h3></p></center>
<center><img alt="eoygive"  src="<?= BASE_URL ?>mobi/eoygiving380x353.jpg" img alt="eoygive"/></center> 
<br>
<center><a href="https://www.paypal.com/donate?token=kN6ITFLyCDgI3BT4doMsfAOCjnj2DApo-QTkC_YeLnylCqA8V04YazE8hn33iE8aSvN8u1HabLK-MP8a"><img alt="ptbook"  src="<?= BASE_URL ?>mobi/btn_donateCC_LG.gif" img alt="donate"/></a></center>                         
                        
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
 