<?php
  include('navbar.php');
  // paragraphs: a blank line starts a new one, a single Enter is a line break
  $cms_paras = preg_split('/\R\s*\R/', trim((string) $job->body));
?>

<!-- Begin Content -->
<div class="ibox-content">
    <div class="row">
        <div class="col-md-8">
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
                <a class="btn btn-primary btn-lg" href="<?= out($job->link_url) ?>" target="_blank" rel="noopener"><i class="fa fa-paper-plane"></i> <?= out($job->link_label !== '' ? $job->link_label : 'Apply') ?></a>
            <?php endif; ?>
        </div>
        <?php if($job->picture !== ''): ?>
        <div class="col-md-4">
            <img src="<?= out($job->picture) ?>" alt="<?= out($job->alt_text) ?>" style="max-width: 100%;">
        </div>
        <?php endif; ?>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <a class="btn btn-primary dim" href="<?= BASE_URL ?><?= $cms_home ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>
</div>
<!-- End Content -->
