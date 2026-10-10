
<br>
<br>
            <center><p><h3>A Revolutionary You: Mind, Body and Spirit!</h3></p> </center>
                          
                            <center><h3>Prime Time Sister Circles</h3> </center>
                        <!--    <center><h3>&</h3> </center>
                             <center><h3>Prime Time Woman Circles</h3> </center> -->
                            <center><h3></h3> </center>
<div class ="container">
    <div class="text-center loginscreen animated fadeInDown"> <!-- middle-box   -->

        <div>
<!-- ccmps: salutation, first_name, middle_name, last_name, Suffix, gender, birthdate, photo, email, mobile, fax, donotcall, emailoptout, phoneother, assistantphone, assistantemail  -->
<!-- addresses: address1, address2, district, county, city, state, zip, full address-->
<!--  Type=1, Mailing-->

                            <h2 class="title-underblock custom mb30">Change My Contact Info</h2>


            <form class="m-t" method = "post" role="form" action="<?= BASE_URL ?>welcome/mobichangepassword">
                <div class="form-group">

                <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?>
                <br>
                <div class="form-group">
                    <input type="password" class="form-control" name="oldpassword" value="<?= $oldpassword ?>" placeholder="Old Password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="newpassword" value="<?= $newpassword ?>" placeholder="New Password...minimum length of 6" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm New Password" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="resetusername" value="<?= $resetusername ?>" 
                    hidden >
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit">Submit</button>

                <?php if($_SESSION['tg_user_level'] == 7): ?> <!-- ccmp - participant -->
                    <a class="btn btn-sm btn-white btn-block" href="<?= BASE_URL ?>welcome/mobihome">Cancel</a>
                <?php else: ?> 
                    <a class="btn btn-sm btn-white btn-block" href="<?= BASE_URL ?>welcome/mobiadminhome">Cancel</a>

                <?php endif; ?>

            </form>
            <p class="m-t"> <small>Gaston & Porter Health Improvement Center &copy; 2022</small> </p>
        </div>
    </div>

</div>