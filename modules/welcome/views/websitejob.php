<?php
/* A public job posting (Welcome::job, template "website"). Paragraphs: a blank line starts a new one. */
$cms_paras = preg_split('/\R\s*\R/', trim((string) $job->body));
?>
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-expand-md navbar-scroll" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>welcome/website"><?= out(SHORTSITENAME) ?></a>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <li><a class="nav-link" href="<?= BASE_URL ?>welcome/website#sec-careers"><i class="fa fa-arrow-left"></i> All Careers</a></li>
                <li class="cms-login"><a class="nav-link" href="<?= BASE_URL ?>welcome/login"><?= out(CCMP) ?> Login</a></li>
            </ul>
        </div>
    </nav>
</div>

<section class="container cms-page-pad" style="padding-bottom: 60px;">
    <div class="row">
        <div class="col-md-8">
            <h1><?= out($job->title) ?></h1>
            <?php if($job->location !== ''): ?>
                <h3 class="text-muted"><i class="fa fa-map-marker"></i> <?= out($job->location) ?></h3>
            <?php endif; ?>
            <?php if($job->summary !== ''): ?>
                <p style="font-size: 17px;"><strong><?= out($job->summary) ?></strong></p>
            <?php endif; ?>
            <?php foreach($cms_paras as $para): ?>
                <?php if($para !== ''): ?><p style="font-size: 16px;"><?= nl2br(out($para)) ?></p><?php endif; ?>
            <?php endforeach; ?>
            <?php if($job->ends_on): ?>
                <p class="text-muted">Open until <?= out(date('F j, Y', strtotime($job->ends_on))) ?>.</p>
            <?php endif; ?>
            <?php if($job->link_url !== ''): ?>
                <a class="btn btn-primary btn-lg" href="<?= out($job->link_url) ?>"<?= cms_link_attrs($job->link_url) ?>><i class="fa fa-paper-plane"></i> <?= out($job->link_label !== '' ? $job->link_label : 'Apply') ?></a>
            <?php endif; ?>
        </div>
        <?php if($job->picture !== ''): ?>
        <div class="col-md-4">
            <img src="<?= out($job->picture) ?>" alt="<?= out($job->alt_text) ?>" style="max-width: 100%;">
        </div>
        <?php endif; ?>
    </div>
</section>
