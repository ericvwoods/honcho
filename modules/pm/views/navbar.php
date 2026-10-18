<?php
/*
 * PM top bar - same layout as the DMS navbar, but it only uses values
 * PM always sets, so it never warns about a missing DMS/CCMP variable.
 */
?>
<div class="row">
    <div class="col-md-5">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <ul class="nav navbar-top-links navbar-left">
                    <li>
                        <br>
                        <a href="<?= BASE_URL ?>honcho"> <!-- PMS is staff-only: Home is the Honcho dashboard -->
                            <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i>
                                <strong>Home &gt; <?= out($bc1) ?> &gt;
                                    <span style="color: <?= NB_CLR ?>"><?= out($bc2) ?></span></strong></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="col-md-4">
        <br>
        <ul class="nav navbar-top-links navbar-left">
            <li><span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">S</span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">GAP </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;">EMS</span></a></span></li>
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="nav navbar-top-links navbar-right">
            <br>
            <li>
                <br>
                <a><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>"><?= out($_SESSION['whoisit'] ?? '') ?></span>]</a>
            </li>
            <li>
                <br>
                <a href="<?= BASE_URL ?>honcho/logout">
                    <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                </a>
            </li>
        </ul>
    </div>
</div>
