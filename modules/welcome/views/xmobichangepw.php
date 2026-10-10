
<br>
<br>
                            <center><p><h2>Black Pilots of America</h2></p> </center>
<div class ="container">
    <div class="text-center loginscreen animated fadeInDown"> <!-- middle-box   -->

        <div>



                            <h2 class="title-underblock custom mb30">Change My Password</h2>


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
            <p class="m-t"> <small>Black Pilots of America &copy; 2022</small> </p>
        </div>
    </div>

</div>