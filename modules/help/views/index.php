<?php include('navbar.php'); include('_header.php'); ?>
        <div class="ibox">
            <div class="ibox-content help-page">
                <?php if(($_SESSION['flashmsgcolor'] ?? 1) == 0): ?>
                  <?= flashdata('<div style="font-weight: bold; color: crimson;">', '</div>'); set_flashdata(''); ?>
                <?php endif; ?>
                <div class="row">
                <?php foreach($guides as $g): ?>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <h2 style="color: <?= SN_CLR ?>; margin-top: 0;"><a href="<?= BASE_URL ?>help/guide/<?= $g->key ?>" style="color: inherit;"><i class="fa fa-book"></i> <?= out($g->title) ?></a></h2>
                        <p class="text-muted"><?= out($g->subtitle) ?></p>
                        <ol style="font-size: 15px; padding-left: 1.4em;">
                            <?php foreach($g->chapters as $c): ?>
                            <li><a href="<?= BASE_URL ?>help/guide/<?= $g->key ?>/<?= (int) $c->num ?>"><?= out($c->title) ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                        <small class="text-muted">Updated <?= out($g->generated) ?></small>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
