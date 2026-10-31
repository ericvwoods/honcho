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

                <?php $labels = array('open' => 'Open', 'paid' => 'Paid', 'void' => 'Voided', 'waived' => 'Waived'); ?>
                <p>
                    <?php foreach($totals as $t): ?><span style="margin-right: 18px;"><strong><?= out($labels[$t->status] ?? $t->status) ?>:</strong> <?= (int) $t->n ?> ($<?= number_format((float) $t->amount, 2) ?>)</span><?php endforeach; ?>
                    <?php if($attention): ?><a href="<?= BASE_URL ?>fin/attention" style="color: crimson; font-weight: bold;"><i class="fa fa-exclamation-triangle"></i> <?= (int) $attention ?> need<?= $attention == 1 ? 's' : '' ?> attention</a><?php endif; ?>
                </p>
                <?php if($results): ?>
                <div style="border: 1px solid #e7eaec; border-radius: 6px; padding: 10px 14px; margin-bottom: 14px;"><strong>Done:</strong>
                    <ul style="margin: 6px 0 0; padding-left: 20px;"><?php foreach($results as $r): ?><li style="color: <?= $r['ok'] ? SN_CLR : 'crimson' ?>;"><?= out($r['msg']) ?></li><?php endforeach; ?></ul></div>
                <?php endif; ?>
                <?php if($picked): ?>
                    <p><strong>The <?= strtolower(CCMPS) ?> you ticked</strong> on the list. <a href="<?= BASE_URL ?>fin/invoices">Show all invoices</a></p>
                    <?php foreach(($missing ?? array()) as $miss): ?><p class="text-muted" style="margin: 0;">Skipped: <?= out($miss) ?></p><?php endforeach; ?>
                <?php else: ?>
                <form method="get" action="<?= BASE_URL ?>fin/invoices" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; margin-bottom: 12px;">
                    <div><label for="year" style="font-weight: normal;">Year</label><input type="number" class="form-control" name="year" id="year" value="<?= (int) $year ?>" style="width: 110px;"></div>
                    <div><label for="chapter" style="font-weight: normal;"><?= SUBENTITY ?></label>
                        <select class="form-control" name="chapter" id="chapter" style="width: 260px;"><option value="0">All</option>
                        <?php foreach($chapters as $c): ?><option value="<?= (int) $c->id ?>"<?= (int) $c->id === $chapter ? ' selected' : '' ?>><?= out($c->name) ?></option><?php endforeach; ?></select></div>
                    <div><label for="status" style="font-weight: normal;">Showing</label>
                        <select class="form-control" name="status" id="status" style="width: 150px;"><?php foreach(array('open' => 'Open', 'paid' => 'Paid', 'void' => 'Voided', 'waived' => 'Waived', 'all' => 'All') as $v => $l): ?><option value="<?= $v ?>"<?= $v === $status ? ' selected' : '' ?>><?= $l ?></option><?php endforeach; ?></select></div>
                    <button type="submit" class="btn btn-outline btn-default">Show</button>
                </form>
                <?php endif; ?>

                <?php if(empty($rows)): ?><p class="text-muted">No invoices to show.</p><?php else: ?>
                <form method="post" action="<?= BASE_URL ?>fin/invoicespaid">
                    <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="year" value="<?= (int) $year ?>">
                    <input type="hidden" name="chapter" value="<?= (int) $chapter ?>"><input type="hidden" name="picked" value="<?= $picked ? 1 : 0 ?>">
                    <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                        <thead><tr><th><?php if($status === 'open'): ?><input type="checkbox" id="checkall" aria-label="Tick all"><?php endif; ?></th><th>Invoice</th><th><?= CCMP ?></th><th><?= SUBENTITY ?></th><th>Amount</th><th>Status</th><th>Emailed</th><th></th></tr></thead>
                        <tbody><?php foreach($rows as $r): ?>
                        <tr><td><?php if($r->status === 'open'): ?><input type="checkbox" name="charge[]" value="<?= (int) $r->id ?>" class="inv"<?= $picked ? ' checked' : '' ?> aria-label="<?= out($r->invoice_number) ?>"><?php endif; ?></td>
                            <td><?= out($r->invoice_number) ?></td><td><?= out(trim($r->first_name.' '.$r->last_name)) ?></td><td><?= out((string) $r->chapter_name) ?></td>
                            <td>$<?= number_format((float) $r->amount, 2) ?><?= (float) $r->prorate_factor < 1 ? ' <small class="text-muted">(prorated)</small>' : '' ?></td>
                            <td><?= out($labels[$r->status] ?? $r->status) ?><?= $r->reason ? '<br><small class="text-muted">'.out($r->reason).'</small>' : '' ?></td>
                            <td><?= $r->invoiced_at ? date('M j', (int) $r->invoiced_at) : '<span class="text-muted">no</span>' ?></td>
                            <td><a href="<?= BASE_URL ?>fin/memberdues/<?= (int) $r->ccmp_id ?>?return=fin/invoices">Dues</a></td></tr>
                        <?php endforeach; ?></tbody></table></div>
                    <?php if($status === 'open'): ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end;">
                        <div><label for="method" style="font-weight: normal;">Paid by</label>
                            <select class="form-control" name="method" id="method" style="width: 140px;"><option value="check">Check</option><option value="cash">Cash</option><option value="paypal">PayPal</option><option value="other">Other</option></select></div>
                        <div><label for="reference" style="font-weight: normal;">Reference (applies to all ticked)</label><input type="text" class="form-control" name="reference" id="reference" maxlength="100" style="width: 260px;"></div>
                        <div><label for="received_on" style="font-weight: normal;">Received on</label><input type="date" class="form-control" name="received_on" id="received_on" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" style="width: 180px;" required></div>
                    </div>
                    <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px; margin-top: 12px;"><i class="fa fa-check"></i> Mark the ticked invoices paid</button>
                    <?php endif; ?>
                </form>
                <script>
                  (function(){ var all = document.getElementById('checkall'); if(!all){ return; }
                    all.addEventListener('change', function(){ document.querySelectorAll('input.inv').forEach(function(b){ b.checked = all.checked; }); }); })();
                </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

