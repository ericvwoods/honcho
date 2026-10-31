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
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/member/2#my-dues" style="font-size: 20px;" title="Help: dues"><i class="fa fa-question-circle"></i> Help</a>
                    
                    <button type="button" class="btn btn-outline btn-default" style="font-size: 20px;" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
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
                <?php $methods = array('cash' => 'Cash', 'check' => 'Check', 'other' => 'Other', 'paypal' => 'PayPal'); ?>
                <div style="max-width: 640px; border: 1px solid #e7eaec; border-radius: 6px; padding: 18px 22px;">
                    <h2 style="margin-top: 0;"><?= out(SITENAME) ?></h2>
                    <h3 style="color: <?= SN_CLR ?>;">Receipt <?= out($p->receipt_number) ?></h3>
                    <table class="table" style="font-size: 16px;">
                        <tr><td>Received from</td><td><strong><?= out(trim($m->first_name.' '.$m->last_name)) ?></strong>, <?= CCMP ?> No. <?= out((string) $m->ccmp_number) ?></td></tr>
                        <tr><td>For</td><td><?= $charge ? (($charge->kind === 'chapter' ? out((string) ($chapter->description ?? $chapter->chapter_title ?? SUBENTITY)).' '.strtolower(SUBENTITY).' dues' : 'National dues'.($charge->invoice_number ? ', invoice '.out($charge->invoice_number) : '')).', membership year '.(int) $charge->membership_year) : '' ?></td></tr>
                        <tr><td>Amount</td><td><strong>$<?= number_format((float) $p->amount, 2) ?></strong></td></tr>
                        <tr><td>Paid by</td><td><?= out($methods[$p->method] ?? ucfirst($p->method)) ?><?= $p->reference ? ' ('.out($p->reference).')' : '' ?></td></tr>
                        <tr><td>Received on</td><td><?= $p->received_on ? date('F j, Y', strtotime($p->received_on)) : '' ?></td></tr>
                        <tr><td>Received by</td><td><?= (int) $p->received_by === 0 ? 'National' : out((string) ($chapter->description ?? $chapter->chapter_title ?? SUBENTITY)) ?></td></tr>
                        <?php if($p->status !== 'completed'): ?><tr><td>Status</td><td style="color: crimson;"><strong><?= out(ucfirst($p->status)) ?></strong></td></tr><?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

