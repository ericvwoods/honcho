<?php /* Member numbers, counted when the page opens (member home and public site). */ ?>
<section id="<?= out($section->anchor) ?>" class="gray-section" style="margin-top: 0; padding: 50px 0;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <?php foreach($section->items as $m): ?>
            <div class="col-6 col-md-3">
                <div class="cms-metric">
                    <i class="fa <?= $m['icon'] ?>" aria-hidden="true"></i>
                    <div class="cms-metric-value"><?= number_format((int) $m['value']) ?></div>
                    <div><?= out($m['label']) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
