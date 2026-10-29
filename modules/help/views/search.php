<?php include('navbar.php'); include('_header.php'); ?>
        <div class="ibox">
            <div class="ibox-content help-page">
                <p><a href="<?= BASE_URL ?>help"><i class="fa fa-chevron-left"></i> All guides</a></p>
                <?php if(strlen($q) < 2): ?>
                    <p>Type at least two letters to search.</p>
                <?php elseif(empty($results)): ?>
                    <p>Nothing found for <strong><?= out($q) ?></strong>. Try fewer or different words.</p>
                <?php else: ?>
                    <p><?= count($results) ?> section(s) found for <strong><?= out($q) ?></strong>.</p>
                    <?php foreach($results as $r): ?>
                    <div style="margin-bottom: 16px;">
                        <a href="<?= BASE_URL ?>help/guide/<?= $r->key ?>/<?= (int) $r->num ?>#<?= out($r->slug) ?>" style="font-weight: bold; font-size: 1.05em;"><?= out($r->tab) ?></a>
                        <div class="text-muted" style="font-size: 13px;"><?= out($r->guide) ?> &rsaquo; Chapter <?= (int) $r->num ?>: <?= out($r->chapter) ?></div>
                        <div style="font-size: .95em;">&hellip;<?= out($r->snippet) ?>&hellip;</div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
