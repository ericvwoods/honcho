<?php /* People with photos. */
      $cms_cols = max(3, (int) floor(12 / max(1, min(4, count($section->items))))); ?>
<section id="<?= out($section->anchor) ?>" class="gray-section team">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <?php foreach($section->items as $item): ?>
            <div class="col-sm-<?= $cms_cols ?> wow zoomIn">
                <div class="team-member">
                    <?php if($item->picture !== ''): ?><img src="<?= out($item->picture) ?>" class="img-fluid rounded-circle" alt="<?= out($item->alt_text !== '' ? $item->alt_text : $item->heading) ?>" style="width: 160px; height: 160px; object-fit: cover;"><?php endif; ?>
                    <h4><span class="navy"><?= out($item->heading) ?></span></h4>
                    <?php if($item->subheading !== ''): ?><p class="text-muted" style="margin-bottom: 6px;"><?= out($item->subheading) ?></p><?php endif; ?>
                    <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
                    <?php if($item->link_url !== ''): ?><p><a href="<?= out($item->link_url) ?>"<?= cms_link_attrs($item->link_url) ?>>Profile &raquo;</a></p><?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
