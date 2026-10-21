<?php /* Bulletin Board: sticky notes (Inspinia "notes"), in the colour chosen for each. */ ?>
<section id="<?= out($section->anchor) ?>" class="gray-section" style="margin-top: 0; padding: 50px 0;">
    <div class="container">
        <?= $cms_head($section) ?>
        <ul class="notes">
            <?php foreach($section->items as $p): ?>
            <li>
                <div class="cms-<?= in_array($p->color, array('green', 'blue', 'pink'), true) ? $p->color : 'yellow' ?>">
                    <small><?= out(date('M j', (int) $p->created_at)) ?></small>
                    <h4><?= out($p->title) ?></h4>
                    <?php if($p->summary !== ''): ?><p><?= $cms_text($p->summary) ?></p><?php endif; ?>
                    <?php if($p->link_url !== ''): ?><a href="<?= out($p->link_url) ?>"<?= cms_link_attrs($p->link_url) ?>><?= out($p->link_label !== '' ? $p->link_label : 'More') ?></a><?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <div style="clear: both;"></div>
        <?php if($cms['site'] === 'member' && CMS_MEMBER_BULLETINS == 1): ?>
        <p class="text-center m-t-md"><a class="btn btn-primary" href="<?= BASE_URL ?>cms-content/createpost/bulletin"><i class="fa fa-thumb-tack"></i> Post a Sticky Note</a></p>
        <?php endif; ?>
    </div>
</section>
