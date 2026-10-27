<?php
  // Top of every content manager page: breadcrumb, who is logged in, logout, page header and flash message.
  // Works for both logins: Home and Logout follow the login (staff -> honcho, member -> ccmphome).
  $cms_staff  = !empty($_SESSION['honcho_logged_in']);
  $cms_home   = $cms_staff ? 'honcho' : 'welcome-ccmps/ccmphome';
  $cms_logout = $cms_staff ? 'honcho/logout' : 'welcome/logout';
  $cms_user   = $cms_staff ? ($_SESSION['honcho_username'] ?? '') : ($_SESSION['ccmp_username'] ?? '');
?>

<!-- Begin Top Menu -->
<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0; width: 100%;">
        <ul class="nav navbar-top-links navbar-left" style="padding: 15px;">
            <li>
                <a href="<?= BASE_URL ?><?= $cms_home ?>">
                    <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i> <strong>Home &gt; <?= out($bc1) ?> &gt; <span style="color: <?= NB_CLR ?>"><?= out($bc2) ?></span></strong></span>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-top-links" style="padding: 15px;"> <!-- the admin title, as on the other admin screens (2026-10-27) -->
            <li><span class="m-r"><?= title_bar_name('admin') ?></span></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right" style="padding: 15px;">
            <li><span class="m-r-sm text-muted"><i class="fa fa-user"></i> <?= out($cms_user) ?></span></li>
            <li>
                <a href="<?= BASE_URL ?><?= $cms_logout ?>"><span class="m-r-sm text-muted welcome-message"><strong>Logout</strong> <i class="fa fa-sign-out"></i></span></a>
            </li>
        </ul>
    </nav>
</div>
<!-- End Top Menu -->

<div class="ibox-content">
    <div class="row">
        <div class="col-md-1 d-none d-md-block">
            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="<?= out(SHORTSITENAME) ?> logo" style="max-width: 100%;">
        </div>
        <div class="col-md-11">
            <span style="color:<?= SN_CLR ?>; font-size: 30px;"><?= out($header) ?></span>
            <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: lightseagreen;">', '</div>'); ?>
            <?php else: ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 18px; color: crimson;">', '</div>'); ?>
            <?php endif; ?>
            <div id="cmsmsg" style="font-weight: bold; font-size: 16px; min-height: 22px;" aria-live="polite"></div>
        </div>
    </div>
</div>
