<?php /* A row of short boxes (up to 4 per row). */
      $cms_cols = max(3, (int) floor(12 / max(1, min(4, count($section->items))))); ?>
<section id="<?= out($section->anchor) ?>" class="container services">
    <?php if($section->subtitle !== '' || $cms_i > 0): ?><?= $cms_head($section) ?><?php endif; ?>
    <div class="row">
        <?php foreach($section->items as $item): ?>
        <div class="col-sm-<?= $cms_cols ?>">
            <?php if($item->heading !== ''): ?><h2><?= out($item->heading) ?></h2><?php endif; ?>
            <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
            <?php if($item->link_url !== ''): ?><p><a class="navy-link" href="<?= out($item->link_url) ?>"<?= cms_link_attrs($item->link_url) ?>><?= out($item->link_label !== '' ? $item->link_label : 'Details') ?> &raquo;</a></p><?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</section>
