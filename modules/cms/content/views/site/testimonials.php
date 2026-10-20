<?php /* One large quote; several quotes take turns. */ ?>
<section id="<?= out($section->anchor) ?>" class="navy-section testimonials" style="margin-top: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <i class="fa fa-comment big-icon" aria-hidden="true"></i>
                <h1><?= out($section->title) ?></h1>
                <div id="<?= out($section->anchor) ?>-q" class="carousel slide" data-ride="carousel" data-interval="9000">
                    <div class="carousel-inner">
                        <?php foreach($section->items as $n => $item): ?>
                        <div class="carousel-item <?= $n == 0 ? 'active' : '' ?>">
                            <div class="testimonials-text"><i>&ldquo;<?= $cms_text($item->body) ?>&rdquo;</i></div>
                            <small><strong><?= out($item->heading) ?><?= $item->subheading !== '' ? ' &middot; '.out($item->subheading) : '' ?></strong></small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
