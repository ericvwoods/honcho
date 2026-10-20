<?php /* Features with icons on both sides of a picture (the first item that has a picture). */
      $cms_pic = null; $cms_rest = array();
      foreach($section->items as $item){ if($cms_pic === null && $item->picture !== ''){ $cms_pic = $item; } else { $cms_rest[] = $item; } }
      if($cms_pic && $cms_pic->heading !== ''){ array_unshift($cms_rest, $cms_pic); } // its text still shows
      $cms_half = (int) ceil(count($cms_rest) / 2);
      $cms_sides = array(array_slice($cms_rest, 0, $cms_half), array_slice($cms_rest, $cms_half)); ?>
<section id="<?= out($section->anchor) ?>" class="container features">
    <?= $cms_head($section) ?>
    <div class="row">
        <?php foreach($cms_sides as $cms_side => $cms_list): ?>
        <div class="col-md-<?= $cms_pic ? 3 : 6 ?> text-center wow <?= $cms_side ? 'fadeInRight' : 'fadeInLeft' ?>">
            <?php foreach($cms_list as $n => $item): ?>
            <div class="<?= $n ? 'm-t-lg' : '' ?>">
                <?php if($item->icon !== ''): ?><i class="fa <?= out($item->icon) ?> features-icon" aria-hidden="true"></i><?php endif; ?>
                <?php if($item->heading !== ''): ?><h2><?= out($item->heading) ?></h2><?php endif; ?>
                <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if($cms_side == 0 && $cms_pic): ?>
        <div class="col-md-6 text-center wow zoomIn">
            <img src="<?= out($cms_pic->picture) ?>" alt="<?= out($cms_pic->alt_text) ?>" class="img-fluid">
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
