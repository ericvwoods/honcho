<?php include('navbar.php'); include('_header.php'); ?>
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <nav class="col-md-3 help-toc" aria-label="Contents">
                        <a href="<?= BASE_URL ?>help"><i class="fa fa-chevron-left"></i> All guides</a>
                        <?php $part = ''; foreach($guide->chapters as $c): ?>
                            <?php if($c->part !== $part): $part = $c->part; ?><div class="help-part"><?= out($part) ?></div><?php endif; ?>
                            <a href="<?= BASE_URL ?>help/guide/<?= $key ?>/<?= (int) $c->num ?>" class="<?= $c->num == $chapter->num ? 'current' : '' ?>"><?= (int) $c->num ?>. <?= out($c->title) ?></a>
                            <?php if($c->num == $chapter->num): foreach($sections as $s): ?>
                            <a href="#<?= out($s->slug) ?>" style="padding-left: 18px; font-size: 14px;"><?= out($s->tab) ?></a>
                            <?php endforeach; endif; ?>
                        <?php endforeach; ?>
                    </nav>
                    <article class="col-md-9 help-page">
                        <h1 style="color: <?= SN_CLR ?>; margin-top: 0; font-size: 1.9em;">Chapter <?= (int) $chapter->num ?>: <?= out($chapter->title) ?></h1>
                        <?php foreach($sections as $s): ?>
                        <h2 class="help-section" id="<?= out($s->slug) ?>"><?= out($s->tab) ?></h2>
                        <?= $s->html ?>
                        <?php endforeach; ?>
                        <hr>
                        <div style="display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                            <span><?php if($prev): ?><a href="<?= BASE_URL ?>help/guide/<?= $key ?>/<?= (int) $prev->num ?>"><i class="fa fa-chevron-left"></i> <?= out($prev->title) ?></a><?php endif; ?></span>
                            <span><?php if($next): ?><a href="<?= BASE_URL ?>help/guide/<?= $key ?>/<?= (int) $next->num ?>"><?= out($next->title) ?> <i class="fa fa-chevron-right"></i></a><?php endif; ?></span>
                        </div>
                        <p class="text-muted" style="font-size: 13px; margin-top: 12px;"><?= out($guide->title) ?>, updated <?= out($guide->generated) ?>. The same text is in the Word version of the guide.</p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
