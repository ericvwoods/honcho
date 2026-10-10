

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">MOB</h1>

            </div>
            <h3>Honcho Integration Platform</h3>
            <p>Development Environment</p>
            <p>A Trongate Framework Implementation</p>

            <form class="m-t" method = "post" role="form" action="<?= BASE_URL ?>honcho/welcome">
                <div class="form-group">
                                <?= flashdata('<div style="font-weight: bold; color: red;">', '</div>'); 
                $flash_msg = '';
                set_flashdata($flash_msg); ?>
                    <input type="text" class="form-control" name="username" value="<?= $username ?>" placeholder="Username"  required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" value="<?= $password ?>" placeholder="Password" required="">
                </div>
                <label> <input name="remember" type="checkbox" class="i-checks"> Remember me </label>
                <button type="submit" class="btn btn-primary block full-width m-b" name="submit" value="Submit">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p></p>
         <!--       <p class="text-muted text-center"><h4>Don't have an account?</h4></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
                <p></p>
                <p></p>
          <!--      <a href="<?= BASE_URL ?>welcome"> <button type="button" class="btn btn-success block full-width m-b">Go to Website</button></a> -->
              
            </form>
            <p class="m-t"> <small>Encore Digital Arts, LLC &copy; 2022</small> </p>
        </div>
    </div>



   


