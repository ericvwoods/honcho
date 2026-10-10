
<?php 
  include('navbar.php');
?>
<div class="container">    
<!-- <div class="row"> -->
    <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-2">
    <br> 
   <!--    <a href="#" title="fullbulletin">
           <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
       </a> -->
    </div>

    <div class="col-md-10">
   
        <!--Blue   --> <span class="m-r"><a href="#"><h1><?= $title ?></h1></a>  </span> 

  <!-- Green  --><!-- <span class="text-navy"> <h1><?= $_SESSION['chapter_name'] ?></h1></span> -->
    </div>
</div>


<!--  Begin Accordian Section -->
                 <div>
                 <div class="faq-item">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-12">
                                    

                                </div> <!-- col -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div id="faq1" class="panel-collapse">
                                  
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
<section id="team" class="gray-section team">
    <div class="container">

        <div class="row m-b-lg">

            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                        <div class="col-sm-1">
       
                                           <a href="#" title="fullbulletin">
           <img src="<?= BASE_URL ?>welcome_module/images/bpalogo100x82.jpg" alt="Logo">
       </a>
          </div>
            <div class="col-sm-4">
             <br>
                <h1>Sunshine   <i class="fa fa-heart fa-1x" style="color: indianred;"></i> </h1>
</div>
            </div>
                <br>
                <h3>There are no acknoledgements at this time.</h3>
            </div>
        </div>
                  
<center>
                <p style="color:RoyalBlue;">If you would like to volunteer your time and talents to the Sunshine Committee please contact us!</p>
</center>                      

                <center>
         <!--   <form action="<?= BASE_URL ?>cms-sunshine/sendsunshineformemail" method="POST" style=' width:600px'> -->
  <form action="<?= BASE_URL ?>cms-ccmpssunshine/sendsunshineformbrevoemail" method="POST" style=' width:600px'>                
                    
                    <div class="row"> 
                    <div class="col-md-12">
                        <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;">Name</label>                        
                            <input type="text" name="name" class="col-lg-8" value=<?= $_SESSION['ccmp_first'] ?>_<?= $_SESSION['ccmp_last'] ?>> 
                        </div>  

                        <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;">Email</label> 
                         
                            <input type="email" name="email" class="col-lg-8" value=<?= $_SESSION['ccmp_username'] ?> required> 
                        </div>
                        <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;">Phone</label> 

                            <input type="text" name="phone" class="col-lg-8" value=<?= str_replace(' ','-', $_SESSION['ccmp_mobile'] ) ?> >
                        </div>                        
                        <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;">Message</label> 
                           <textarea rows = "4" name="message" class="col-lg-8"  required></textarea> 
                        </div>

                    <!--   <input type="hidden" name="_next" value="<= BASE_URL ?>welcome-ccmps/sponsors"> -->
                        <input type="hidden" name="_next" value="https://www.bpauat.site/welcome-ccmps/sponsors">
                        <input type="hidden" name="_cc" value="ericvwoods@hotmail.com">

                        <div class="form-group row"><label class="col-lg-2 " style="color:RoyalBlue;"></label> 
                             <button type="submit">Send</button>
                                    <?= flashdata('<div style="font-weight: bold; color: green;">', '</div>'); 
                                    $flash_msg = '';
                                    set_flashdata($flash_msg); ?> 
                        </div>


                    </div>
                  
                </div>

            </form>
                             <div class="btn-group">
              
                    <a class="btn btn-outline btn-primary"  type="button" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Close</a>
                </div>   
                </center>

            </div>
        </div>
    </div>
</section>
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

                <div>

<!--   End Accordian Section --> 

</div>              

<script src="https://smtpjs.com/v3/smtp.js"></script>


<!-- elastimail smtp.elastimail.com port 2525 bpaems@gmail.com 10ED5065E00E43ECC42F6B4296CF9E55C1E0 -->
<script>
    function sendEmail(){
        alert('sponsors Fired!');
        return false;
        Email.send({
        //    Host: "smtp.gmail.com",
        //   Password: "Byus4Us!!"
            Host: "smtp.elastimail.com ",
            Username: "bpaems@gmail.com",
            Password: "10ED5065E00E43ECC42F6B4296CF9E55C1E0"
            To: 'bpaems@gmail.com',
            From: document.getElementById("name").value,
            Subject: "New Sponsor Form Inquiry",
            Body: "Name: " + document.getElementById("name").value
            + "<br> Email: " + document.getElementById("email").value
            + "<br> Mobile: " + document.getElementById("phone").value
            + "<br> Message: " + document.getElementById("message").value


    }). then(
        message => alert("Message Sent!")
    );

}
</script>




