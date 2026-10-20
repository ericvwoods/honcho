<?php /* Upcoming events (the full calendar comes in phase 5). */ ?>
<section id="<?= out($section->anchor) ?>" class="features" style="margin-top: 0; padding-top: 50px;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php foreach($section->items as $e): ?>
                <?php $cms_start = strtotime($e->start_at); ?>
                <div class="cms-event">
                    <strong><?= out(date('l, F j', $cms_start)) ?><?= $e->all_day ? '' : ' &middot; '.out(date('g:i a', $cms_start)) ?></strong>
                    <h3 style="margin: 4px 0;"><?= out($e->title) ?></h3>
                    <?php if($e->location !== ''): ?><div class="text-muted"><i class="fa fa-map-marker"></i> <?= out($e->location) ?></div><?php endif; ?>
                    <?php if($e->summary !== ''): ?><p style="margin: 6px 0 0;"><?= out($e->summary) ?></p><?php endif; ?>
                    <?= $cms_link($e->link_url, $e->link_label, 'btn btn-xs btn-primary m-t-xs') ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
