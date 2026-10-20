<?php /* Steps in order, alternating left and right. */ ?>
<section id="<?= out($section->anchor) ?>" class="timeline gray-section">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row features-block">
            <div class="col-lg-12">
                <div class="vertical-container light-timeline center-orientation">
                    <?php foreach($section->items as $item): ?>
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg"><i class="fa <?= out($item->icon !== '' ? $item->icon : 'fa-circle') ?>" aria-hidden="true"></i></div>
                        <div class="vertical-timeline-content">
                            <h2><?= out($item->heading) ?></h2>
                            <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
                            <?php if($item->extra !== ''): ?><span class="vertical-date"><?= out($item->extra) ?></span><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
