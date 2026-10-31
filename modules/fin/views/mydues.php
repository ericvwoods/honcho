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
                <?php $labels = array('open' => 'Open', 'paid' => 'Paid', 'waived' => 'Waived'); ?>
                <p>Status: <strong><?= out($status_names[(int) $m->status] ?? '') ?></strong>; paid through <?= (int) $m->current_year >= 2099 ? 'Lifetime' : ((int) $m->current_year ?: 'never') ?>.
                   Dues for the next membership year are due by <?= out($due_date) ?>.</p>
                <?php $open = array_filter($charges, function($c){ return $c->kind === 'national' && $c->status === 'open'; }); ?>
                <?php foreach($open as $c): ?>
                <div style="border: 1px solid #f3d3d3; border-radius: 6px; padding: 10px 14px; margin-bottom: 12px; max-width: 760px;">
                    <strong>National dues invoice <?= out($c->invoice_number) ?>: $<?= number_format((float) $c->balance, 2) ?> to pay</strong> (membership year <?= (int) $c->membership_year ?>)<br>
                    <?= out($pay_text) ?>
                </div>
                <?php endforeach; ?>
                <h3 style="color: <?= SN_CLR ?>;">Dues</h3>
                <?php if(empty($charges)): ?><p class="text-muted">No dues recorded in Honcho yet.</p><?php else: ?>
                <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                    <thead><tr><th>Year</th><th>Dues</th><th>Amount</th><th>Status</th><th>Invoice</th></tr></thead>
                    <tbody><?php foreach($charges as $c): ?>
                    <tr><td><?= (int) $c->membership_year ?></td><td><?= $c->kind === 'chapter' ? SUBENTITY : 'National' ?></td><td>$<?= number_format((float) $c->amount, 2) ?></td>
                        <td><?= out($labels[$c->status] ?? ucfirst($c->status)) ?></td><td><?= out($c->invoice_number) ?></td></tr>
                    <?php endforeach; ?></tbody></table></div>
                <?php endif; ?>
                <h3 style="color: <?= SN_CLR ?>;">Payments and receipts</h3>
                <?php if(empty($payments)): ?><p class="text-muted">No payments recorded in Honcho yet.</p><?php else: ?>
                <ul style="padding-left: 20px;"><?php foreach($payments as $p): ?>
                    <li><a href="<?= BASE_URL ?>fin/receipt/<?= (int) $p->id ?>">Receipt <?= out($p->receipt_number) ?></a>: $<?= number_format((float) $p->amount, 2) ?>, <?= $p->received_on ? date('M j, Y', strtotime($p->received_on)) : '' ?>, <?= (int) $p->received_by === 0 ? 'National' : strtolower(SUBENTITY) ?></li>
                <?php endforeach; ?></ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

