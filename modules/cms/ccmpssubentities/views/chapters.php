
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
                <h1>Chapter Directory  </h1>
</div>
            </div>
                <br>
                <h3>Table of Chapters and hotlinks goes here.</h3>
            </div>
        </div>
                  
<center>
                <p style="color:RoyalBlue;"></p>
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




