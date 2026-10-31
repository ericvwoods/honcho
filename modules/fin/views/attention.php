<?php include("navbar.php"); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/6#dues" style="font-size: 20px;" title="Help: dues"><i class="fa fa-question-circle"></i> Help</a>
                    
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $close_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <?php if(($_SESSION["flashmsgcolor"] ?? 0) == 1): ?>
                  <?= flashdata("<div style=\"font-weight: bold; font-size: 20px; color: lightseagreen;\">", "</div>"); set_flashdata(""); ?>
                <?php else: ?>
                  <?= flashdata("<div style=\"font-weight: bold; font-size: 20px; color: crimson;\">", "</div>"); set_flashdata(""); ?>
                <?php endif; ?>

                <p style="color: #676a6c;">Cases Honcho can't settle on its own, for example chapter dues reversed after the <?= strtolower(CCMP) ?> had already paid National. Decide what to do (keep the payment, refund it outside Honcho, ask the chapter...), then mark the case resolved with a note.</p>
                <?php if(empty($open)): ?><p><strong>Nothing needs attention.</strong></p><?php endif; ?>
                <?php foreach($open as $a): ?>
                <div style="border: 1px solid #f3d3d3; border-radius: 6px; padding: 10px 14px; margin-bottom: 10px;">
                    <p style="margin: 0 0 6px;"><strong><?= out((string) $a->member_name) ?></strong> <small class="text-muted"><?= date('M j, Y g:ia', (int) $a->created_at) ?></small><br><?= out($a->message) ?></p>
                    <a href="<?= BASE_URL ?>fin/memberdues/<?= (int) $a->ccmp_id ?>?return=fin/attention">Open their dues</a>
                    <form method="post" action="<?= BASE_URL ?>fin/attentionresolve" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;">
                        <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="id" value="<?= (int) $a->id ?>">
                        <input type="text" class="form-control" name="resolution" maxlength="500" placeholder="What was done" style="flex: 1 1 300px;" required aria-label="What was done">
                        <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Resolved</button>
                    </form>
                </div>
                <?php endforeach; ?>
                <?php if(!empty($resolved)): ?>
                <h4 style="margin-top: 18px;">Recently resolved</h4>
                <ul style="padding-left: 20px;"><?php foreach($resolved as $a): ?><li><?= date('M j', (int) $a->resolved_at) ?>: <?= out((string) $a->member_name) ?>: <?= out($a->resolution) ?></li><?php endforeach; ?></ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

