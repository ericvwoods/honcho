<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
   <div class="col-md-12">
<div class="row">

    <div class="col-md-3">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
    </div><!-- col-  -->
    <!-- Begin Top Menu   -->

    <!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->

        <div class="col-md-7">
            <!-- --    <br> -->
            <ul class="nav navbar-top-links navbar-left">
                <li><span class="m-r"><?= title_bar_name('admin') ?></span></li>
            </ul>
        </div>  <!-- col 5 -->

        <div class="col-md-2">

            <ul class="nav navbar-top-links navbar-right">

                <li>

                    <!--  <br>   -->
                    <a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>" ><?= $_SESSION['ccmp_username'] ?><?= $_SESSION['honcho_username'] ?></span>] </a>
                </li>

                <li>
                     <!-- --   <br> -->
                    <a href="<?= BASE_URL ?>welcome/logout">
                        <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>


            </ul>
        </div>  <!-- col 6 -->





    <!-- End Top Menu   -->

</div>
</div>
