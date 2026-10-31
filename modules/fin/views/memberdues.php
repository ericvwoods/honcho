<?php
  include('navbar.php');
  $label_style = 'color:'.SN_CLR.'; margin-top: 0;';
  $methods = array('check' => 'Check', 'cash' => 'Cash', 'other' => 'Other');
  $paid_chapter = $chapter_charge && in_array($chapter_charge->status, array('paid', 'waived'), true);
  $nat_label = array('open' => 'Open (awaiting payment)', 'paid' => 'Paid', 'void' => 'Voided', 'waived' => 'Waived');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/2#chapter-dues" style="font-size: 20px;" title="Help: chapter dues"><i class="fa fa-question-circle"></i> Help</a>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $close_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); set_flashdata(''); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); set_flashdata(''); ?>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>"><?= CCMP ?></h3></div>
                    <div class="col-md-9">
                        <?= out(trim($m->first_name.' '.$m->last_name)) ?>, <?= CCMP ?> No. <?= out((string) $m->ccmp_number) ?>,
                        <?= out((string) ($type->description ?? '')) ?>, <?= out((string) ($chapter->description ?? $chapter->chapter_title ?? '')) ?><br>
                        Status: <strong><?= out($status_names[(int) $m->status] ?? '') ?></strong>; paid through <?= (int) $m->current_year ?: 'never' ?>
                        <?= $new_member ? ' <span class="label label-info">New '.strtolower(CCMP).': dues may be prorated</span>' : '' ?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>"><?= $year ?> dues</h3><small class="text-muted">The year being renewed (the open dues year).</small></div>
                    <div class="col-md-9">
                        <p><?= SUBENTITY ?> dues: <strong><?= $paid_chapter ? 'recorded ($'.number_format((float) $chapter_charge->amount, 2).')' : '$'.number_format($chapter_amount, 2).' not yet recorded' ?></strong>
                           <?= ($chapter && $chapter->dues_collected_by === 'national') ? '<br><small class="text-muted">This '.strtolower(SUBENTITY).'\'s dues are collected by National.</small>' : '' ?><br>
                           National invoice: <strong><?= $national_charge ? out($national_charge->invoice_number).', $'.number_format((float) $national_charge->amount, 2).', '.$nat_label[$national_charge->status] : 'not raised yet (it is raised when the '.strtolower(SUBENTITY).' dues are recorded): $'.number_format($national_amount, 2) ?></strong></p>

                        <?php if(!$paid_chapter): ?>
                        <form method="post" action="<?= BASE_URL ?>fin/recorddues" style="max-width: 720px;">
                            <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="ccmp_id" value="<?= (int) $m->id ?>">
                            <?php if($chapter_amount > 0): ?>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end;">
                                <div><label for="method" style="font-weight: normal;">Paid by</label>
                                    <select class="form-control" name="method" id="method" style="width: 140px;"><?php foreach($methods as $v => $l): ?><option value="<?= $v ?>"><?= $l ?></option><?php endforeach; ?></select></div>
                                <div><label for="reference" style="font-weight: normal;">Check number or reference</label>
                                    <input type="text" class="form-control" name="reference" id="reference" maxlength="100" style="width: 220px;"></div>
                                <div><label for="received_on" style="font-weight: normal;">Received on</label>
                                    <input type="date" class="form-control" name="received_on" id="received_on" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" style="width: 180px;" required></div>
                            </div>
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px; margin-top: 10px;"><i class="fa fa-check"></i> Record <?= strtolower(SUBENTITY) ?> dues paid ($<?= number_format($chapter_amount, 2) ?>)</button>
                            <?php else: ?>
                            <input type="hidden" name="method" value="none"><input type="hidden" name="received_on" value="<?= date('Y-m-d') ?>">
                            <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px;"><i class="fa fa-refresh"></i> Renew for <?= $year ?></button>
                            <small class="text-muted">&nbsp;No <?= strtolower(SUBENTITY) ?> dues are set.</small>
                            <?php endif; ?>
                            <p class="text-muted" style="margin-top: 8px;">This raises the National invoice ($<?= number_format($national_amount, 2) ?>) and emails it to the <?= strtolower(CCMP) ?>; they show as Pending until National is paid.</p>
                        </form>
                        <?php else: ?>
                        <div id="reverse" style="border: 1px solid #f3d3d3; border-radius: 6px; padding: 12px 14px; max-width: 720px;">
                            <strong>Reverse <?= strtolower(SUBENTITY) ?> dues</strong> (unpaid, a bounced check, a mistake)
                            <p class="text-muted" style="margin: 4px 0 8px;">
                                <?php if($national_charge && $national_charge->status === 'open'): ?>
                                    National's invoice <?= out($national_charge->invoice_number) ?> isn't paid, so it will be voided and the <?= strtolower(CCMP) ?> told it's withdrawn.
                                <?php elseif($national_charge && in_array($national_charge->status, array('paid', 'waived'), true)): ?>
                                    National's invoice <?= out($national_charge->invoice_number) ?> is already paid: nothing is undone there; the Financial Admin is alerted to decide.
                                <?php endif; ?>
                                The <?= strtolower(CCMP) ?> goes back to paid through <?= $year - 1 ?>.
                            </p>
                            <form method="post" action="<?= BASE_URL ?>fin/reversedues" id="reverseform">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="ccmp_id" value="<?= (int) $m->id ?>">
                                <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end;">
                                    <div><label for="reason" style="font-weight: normal;">Why</label>
                                        <select class="form-control" name="reason" id="reason" style="width: 200px;" required>
                                            <option value="">Choose...</option><option value="bounced">Check bounced</option><option value="unpaid">Not actually paid</option>
                                            <option value="mistake">Entered by mistake</option><option value="other">Other</option></select></div>
                                    <div style="flex: 1 1 240px;"><label for="detail" style="font-weight: normal;">Details</label>
                                        <input type="text" class="form-control" name="detail" id="detail" maxlength="150"></div>
                                </div>
                                <button type="submit" class="btn btn-outline btn-danger" style="font-size: 16px; margin-top: 10px;" id="reversebtn"><i class="fa fa-undo"></i> Reverse</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-3"><h3 style="<?= $label_style ?>">History</h3></div>
                    <div class="col-md-9">
                        <?php if(empty($charges)): ?><p class="text-muted">No dues records yet.</p><?php else: ?>
                        <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                            <thead><tr><th>Year</th><th>Dues</th><th>Amount</th><th>Balance</th><th>Status</th><th>Invoice</th><th>Note</th></tr></thead>
                            <tbody><?php foreach($charges as $c): ?>
                            <tr><td><?= (int) $c->membership_year ?></td><td><?= $c->kind === 'chapter' ? SUBENTITY : 'National' ?></td>
                                <td>$<?= number_format((float) $c->amount, 2) ?><?= (float) $c->prorate_factor < 1 ? ' <small class="text-muted">(prorated)</small>' : '' ?></td>
                                <td>$<?= number_format((float) $c->balance, 2) ?></td><td><?= out(ucfirst($c->status)) ?></td><td><?= out($c->invoice_number) ?></td><td><small><?= out($c->reason) ?></small></td></tr>
                            <?php endforeach; ?></tbody></table></div>
                        <?php endif; ?>
                        <?php if(!empty($payments)): ?>
                        <h4>Payments</h4>
                        <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                            <thead><tr><th>Receipt</th><th>Received</th><th>Amount</th><th>Method</th><th>Reference</th><th>Status</th></tr></thead>
                            <tbody><?php foreach($payments as $p): ?>
                            <tr><td><?= out($p->receipt_number) ?></td><td><?= $p->received_on ? date('M j, Y', strtotime($p->received_on)) : '' ?></td><td>$<?= number_format((float) $p->amount, 2) ?></td>
                                <td><?= out(ucfirst($p->method)) ?></td><td><?= out($p->reference) ?></td><td><?= out(ucfirst($p->status)) ?></td></tr>
                            <?php endforeach; ?></tbody></table></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  (function(){ // a second click confirms a reversal
    var f = document.getElementById('reverseform');
    if(!f){ return; }
    f.addEventListener('submit', function(e){
      if(!f.dataset.armed){ e.preventDefault(); f.dataset.armed = '1'; document.getElementById('reversebtn').innerHTML = '<i class="fa fa-undo"></i> Click again to reverse'; }
    });
  })();
</script>
