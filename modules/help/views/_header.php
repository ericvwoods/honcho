<?php include('_style.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-5" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-6" style="padding-top: 18px;">
                    <form class="help-search" method="get" action="<?= BASE_URL ?>help/search" role="search">
                        <input type="search" class="form-control" name="q" id="help_q" value="<?= out($q ?? '') ?>" placeholder="Search the guides" aria-label="Search the guides">
                        <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-search"></i></button>
                        <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="color: coral; white-space: nowrap;"><i class="fa fa-times-circle"></i> Close</a>
                    </form>
                </div>
            </div>
        </div>
        <br>
