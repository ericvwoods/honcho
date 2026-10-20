<?php /* Quotes in speech bubbles, with photos. */ ?>
<section id="<?= out($section->anchor) ?>" class="comments gray-section" style="margin-top: 0">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row features-block">
            <?php foreach($section->items as $item): ?>
            <div class="col-lg-4 m-b-lg">
                <div class="bubble">&ldquo;<?= $cms_text($item->body) ?>&rdquo;</div>
                <div class="comments-avatar">
                    <?php if($item->picture !== ''): ?><span class="float-left"><img alt="<?= out($item->alt_text !== '' ? $item->alt_text : $item->heading) ?>" src="<?= out($item->picture) ?>" style="object-fit: cover;"></span><?php endif; ?>
                    <div class="media-body">
                        <div class="commens-name"><?= out($item->heading) ?></div>
                        <?php if($item->subheading !== ''): ?><small class="text-muted"><?= out($item->subheading) ?></small><?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
