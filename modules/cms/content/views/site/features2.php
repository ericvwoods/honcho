<?php /* Text blocks either side of a picture (the first item that has a picture). */
      $cms_pic = null; $cms_rest = array();
      foreach($section->items as $item){ if($cms_pic === null && $item->picture !== ''){ $cms_pic = $item; } else { $cms_rest[] = $item; } }
      if($cms_pic && $cms_pic->heading !== ''){ array_unshift($cms_rest, $cms_pic); }
      $cms_half = (int) ceil(count($cms_rest) / 2);
      $cms_sides = array(array_slice($cms_rest, 0, $cms_half), array_slice($cms_rest, $cms_half)); ?>
<section id="<?= out($section->anchor) ?>" class="features">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row features-block">
            <?php foreach($cms_sides as $cms_side => $cms_list): ?>
            <div class="col-lg-<?= $cms_pic ? 3 : 6 ?> features-text <?= $cms_side ? 'text-right wow fadeInRight' : 'wow fadeInLeft' ?>">
                <?php foreach($cms_list as $item): ?>
                <div class="m-b-lg">
                    <?php if($item->subheading !== ''): ?><small><?= out($item->subheading) ?></small><?php endif; ?>
                    <?php if($item->heading !== ''): ?><h2><?= out($item->heading) ?></h2><?php endif; ?>
                    <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
                    <?= $cms_link($item->link_url, $item->link_label, 'btn btn-primary') ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if($cms_side == 0 && $cms_pic): ?>
            <div class="col-lg-6 text-center wow zoomIn">
                <img src="<?= out($cms_pic->picture) ?>" class="img-fluid" alt="<?= out($cms_pic->alt_text) ?>">
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
