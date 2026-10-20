<?php /* Sunshine: illnesses, recoveries and passings. */ ?>
<section id="<?= out($section->anchor) ?>" class="features" style="margin-top: 0; padding-top: 50px;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row">
            <?php foreach($section->items as $p): ?>
            <div class="col-md-6">
                <div class="cms-sunshine-card">
                    <?php if($p->picture !== ''): ?><img src="<?= out($p->picture) ?>" alt="<?= out($p->alt_text !== '' ? $p->alt_text : $p->title) ?>"><?php endif; ?>
                    <h3 style="margin-top: 0;"><i class="fa fa-heart" style="color: indianred;" aria-hidden="true"></i> <?= out($p->title) ?></h3>
                    <?php if($p->summary !== ''): ?><p><strong><?= $cms_text($p->summary) ?></strong></p><?php endif; ?>
                    <?php if($p->body !== ''): ?><p><?= $cms_text($p->body) ?></p><?php endif; ?>
                    <?= $cms_link($p->link_url, $p->link_label, 'btn btn-xs btn-outline btn-primary') ?>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
