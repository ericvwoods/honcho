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
                <?php $kinds = array('upcoming' => 'Coming due', 'past_due' => 'Past Due', 'invoice_open' => 'National invoice open'); ?>
                <p><?= $on ? 'Reminders are <strong>on</strong>: the nightly job sends them.' : 'Reminders are <strong>off</strong>. Switch them on in System Settings, Financial (Send dues reminder emails).' ?></p>
                <?php if(empty($rows)): ?><p class="text-muted">No reminders sent yet.</p><?php else: ?>
                <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                    <thead><tr><th>Sent</th><th><?= CCMP ?></th><th>Reminder</th><th>Year</th><th>Email</th><th></th></tr></thead>
                    <tbody><?php foreach($rows as $r): ?>
                    <tr><td><?= date('M j, Y', strtotime($r->sent_on)) ?></td><td><?= out((string) $r->member_name) ?></td><td><?= out($kinds[$r->kind] ?? $r->kind) ?></td>
                        <td><?= (int) $r->membership_year ?></td><td><?= out($r->email) ?></td><td><?= $r->ok ? '' : '<span style="color: crimson;">not sent</span>' ?></td></tr>
                    <?php endforeach; ?></tbody></table></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

