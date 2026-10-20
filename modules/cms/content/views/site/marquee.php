<?php /* Marquee: one line of announcements scrolling across; pauses on hover; still for people who turn motion off. */
      $cms_secs = max(20, 6 * count($section->items)); ?>
<div id="<?= out($section->anchor) ?>" class="cms-ticker" role="region" aria-label="<?= out($section->title) ?>">
    <div class="cms-ticker-track" style="--cms-ticker-time: <?= $cms_secs ?>s;">
        <?php foreach($section->items as $item): ?>
        <span class="cms-ticker-item"><i class="fa fa-bullhorn" aria-hidden="true"></i>
            <?php if($item->link_url !== ''): ?><a href="<?= out($item->link_url) ?>"<?= cms_link_attrs($item->link_url) ?>><?= out($item->title) ?></a><?php else: ?><?= out($item->title) ?><?php endif; ?>
        </span>
        <?php endforeach; ?>
    </div>
</div>
