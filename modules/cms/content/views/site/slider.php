<?php /* Picture slides: headline, text, button; the picture fills the slide (no picture = plain colour). */ ?>
<div id="<?= out($section->anchor) ?>" class="carousel slide" data-ride="carousel" aria-label="<?= out($section->title) ?>">
    <?php if(count($section->items) > 1): ?>
    <ol class="carousel-indicators">
        <?php foreach($section->items as $n => $item): ?>
        <li data-target="#<?= out($section->anchor) ?>" data-slide-to="<?= $n ?>" class="<?= $n == 0 ? 'active' : '' ?>"></li>
        <?php endforeach; ?>
    </ol>
    <?php endif; ?>
    <div class="carousel-inner" role="listbox">
        <?php foreach($section->items as $n => $item): ?>
        <div class="carousel-item <?= $n == 0 ? 'active' : '' ?>">
            <div class="container">
                <div class="carousel-caption blank">
                    <?php if($item->heading !== ''): ?><h1><?= $cms_text($item->heading) ?></h1><?php endif; ?>
                    <?php if($item->subheading !== ''): ?><p><?= out($item->subheading) ?></p><?php endif; ?>
                    <?php if($item->link_url !== ''): ?><p><?= $cms_link($item->link_url, $item->link_label, 'btn btn-lg btn-primary') ?></p><?php endif; ?>
                </div>
            </div>
            <?php if($item->picture !== ''): ?>
            <div class="header-back" role="img" aria-label="<?= out($item->alt_text) ?>" style="background: url('<?= out($item->picture) ?>');"></div>
            <?php else: ?>
            <div class="header-back cms-plain"></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php if(count($section->items) > 1): ?>
    <a class="carousel-control-prev" href="#<?= out($section->anchor) ?>" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
    <a class="carousel-control-next" href="#<?= out($section->anchor) ?>" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
    <?php endif; ?>
</div>
