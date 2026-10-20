<?php /* Two columns of text, each with a large icon. */ ?>
<section id="<?= out($section->anchor) ?>" class="features">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <?php foreach($section->items as $item): ?>
            <div class="col-lg-5 features-text m-b-lg">
                <?php if($item->icon !== ''): ?><i class="fa <?= out($item->icon) ?> big-icon float-right" aria-hidden="true"></i><?php endif; ?>
                <?php if($item->picture !== ''): ?><img src="<?= out($item->picture) ?>" alt="<?= out($item->alt_text) ?>" class="img-fluid m-b-sm"><?php endif; ?>
                <?php if($item->heading !== ''): ?><h2><?= out($item->heading) ?></h2><?php endif; ?>
                <?php if($item->body !== ''): ?><p><?= $cms_text($item->body) ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
