
<!-- Begin Top Menu   -->

<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="row" style="width: 100%;">
     <div class="col-md-5">

        <div class="navbar-header">

         <ul class="nav navbar-top-links navbar-left">
        <li>
            <br>
            <a href="<?= BASE_URL ?><?= $home_url ?>">
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span></strong></span>
            </a>
        </li>
        </ul>

        </div>
  </div>  <!-- col 5 -->
          <div class="col-md-4">
              <br>
            <ul class="nav navbar-top-links navbar-left">
                <li><span class="m-r"><?= title_bar_name($title_kind ?? 'admin') ?></span></li>
            </ul>
          </div>  <!-- col 4 -->
                <div class="col-md-3">
            <ul class="nav navbar-top-links navbar-right">
            <li>
                   <br>
<a href="<?= BASE_URL ?><?= !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/refreshmysessiondata' ?>"><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>" ><?= out($_SESSION['ccmp_username'] ?? '') ?><?= out($_SESSION['honcho_username'] ?? '') ?></span>] </a>
            </li>
              <?php if(!empty($_SESSION['honcho_logged_in'])): ?>
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
            </ul>
                      </div>  <!-- col 3 -->

  </div> <!-- row  -->
</nav>


<!-- End Top Menu   -->
