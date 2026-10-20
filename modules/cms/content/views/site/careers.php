<?php /* Careers: open jobs; each links to its own page. */ ?>
<section id="<?= out($section->anchor) ?>" class="features" style="margin-top: 0; padding-top: 50px;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php foreach($section->items as $p): ?>
                <div class="cms-job">
                    <?php if($p->picture !== ''): ?><img src="<?= out($p->picture) ?>" alt="<?= out($p->alt_text) ?>" class="float-right" style="max-width: 90px; max-height: 60px; margin-left: 15px;"><?php endif; ?>
                    <h3 style="margin-bottom: 2px;"><a href="<?= $cms_job_url($p->id) ?>"><?= out($p->title) ?></a></h3>
                    <?php if($p->location !== ''): ?><div class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= out($p->location) ?></div><?php endif; ?>
                    <?php if($p->summary !== ''): ?><p style="margin: 6px 0;"><?= out($p->summary) ?></p><?php endif; ?>
                    <a class="btn btn-xs btn-primary" href="<?= $cms_job_url($p->id) ?>">Details</a>
                    <?php if($p->ends_on): ?><small class="text-muted m-l-sm">Open until <?= out(date('M j, Y', strtotime($p->ends_on))) ?></small><?php endif; ?>
                    <div style="clear: both;"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
