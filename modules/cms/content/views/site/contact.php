<?php /* Contact details: one block per office or person. */ ?>
<section id="<?= out($section->anchor) ?>" class="gray-section contact">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row m-b-lg justify-content-center">
            <?php foreach($section->items as $item): ?>
            <div class="col-lg-3 col-md-4 m-b-md">
                <address>
                    <strong><span class="navy"><?= out($item->heading) ?></span></strong><br>
                    <?php if($item->body !== ''): ?><?= $cms_text($item->body) ?><br><?php endif; ?>
                    <?php if($item->extra !== ''): ?><abbr title="Phone">P:</abbr> <a href="tel:<?= out(preg_replace('/[^0-9+]/', '', $item->extra)) ?>"><?= out($item->extra) ?></a><br><?php endif; ?>
                    <?php if($item->link_url !== ''): ?><a href="<?= out($item->link_url) ?>"<?= cms_link_attrs($item->link_url) ?>><?= out($item->link_label !== '' ? $item->link_label : preg_replace('/^mailto:/i', '', $item->link_url)) ?></a><?php endif; ?>
                </address>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p><strong>&copy; <?= date('Y') ?> <?= out(SITENAME) ?></strong></p>
            </div>
        </div>
    </div>
</section>
