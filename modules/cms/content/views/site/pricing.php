<?php /* Plans and prices; with three plans the middle one is highlighted. */
      $cms_n = count($section->items); $cms_cols = max(3, (int) floor(12 / max(1, min(4, $cms_n)))); ?>
<section id="<?= out($section->anchor) ?>" class="pricing">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <?php foreach($section->items as $n => $item): ?>
            <div class="col-lg-<?= $cms_cols ?> wow zoomIn">
                <ul class="pricing-plan list-unstyled <?= ($cms_n == 3 && $n == 1) ? 'selected' : '' ?>">
                    <li class="pricing-title"><?= out($item->heading) ?></li>
                    <?php if($item->extra !== ''): ?><li class="pricing-price"><span><?= out($item->extra) ?></span> <?= out($item->subheading) ?></li><?php endif; ?>
                    <?php foreach(preg_split('/\R/', trim((string) $item->body)) as $cms_line): ?>
                        <?php if(trim($cms_line) !== ''): ?><li><?= out(trim($cms_line)) ?></li><?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($item->link_url !== ''): ?><li class="plan-action"><?= $cms_link($item->link_url, $item->link_label, 'btn btn-primary btn-xs') ?></li><?php endif; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
