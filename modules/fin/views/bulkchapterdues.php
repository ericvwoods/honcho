<?php
  include('navbar.php');
  $methods = array('check' => 'Check', 'cash' => 'Cash', 'other' => 'Other');
  $ok_rows = array_filter($rows, function($r){ return $r->why === ''; });
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

                <?php if($results): ?>
                <div style="border: 1px solid #e7eaec; border-radius: 6px; padding: 10px 14px; margin-bottom: 14px;">
                    <strong>Done:</strong>
                    <ul style="margin: 6px 0 0; padding-left: 20px;"><?php foreach($results as $r): ?>
                        <li style="color: <?= $r['ok'] ? SN_CLR : 'crimson' ?>;"><?= out($r['msg']) ?></li><?php endforeach; ?></ul>
                </div>
                <?php endif; ?>

                <?php if(empty($rows)): ?>
                    <p class="text-muted">No <?= strtolower(CCMPS) ?> left to record. Tick <?= strtolower(CCMPS) ?> on a <?= strtolower(CCMP) ?> list and choose <strong><?= SUBENTITY ?> Dues Paid</strong>.</p>
                <?php else: ?>
                <p>Record <?= strtolower(SUBENTITY) ?> dues for membership year <strong><?= $year ?></strong>. Each <?= strtolower(CCMP) ?> gets the same steps as one at a time: the payment is recorded, the National invoice is raised and emailed, and their status becomes Pending.</p>
                <form method="post" action="<?= BASE_URL ?>fin/bulkchapterduessubmit">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                        <thead><tr><th></th><th><?= CCMP ?></th><th><?= SUBENTITY ?></th><th>Paid through</th><th><?= SUBENTITY ?> dues</th><th></th></tr></thead>
                        <tbody><?php foreach($rows as $r): ?>
                        <tr>
                            <td><?php if($r->why === ''): ?><input type="checkbox" name="ccmp[]" value="<?= (int) $r->m->id ?>" checked aria-label="Include <?= out($r->m->first_name.' '.$r->m->last_name) ?>"><?php endif; ?></td>
                            <td><?= out(trim($r->m->first_name.' '.$r->m->last_name)) ?></td>
                            <td><?= out((string) ($r->chapter->description ?? $r->chapter->chapter_title ?? '')) ?></td>
                            <td><?= (int) $r->m->current_year ?: 'never' ?></td>
                            <td><?= $r->amount > 0 ? '$'.number_format($r->amount, 2).($r->new ? ' <small class="text-muted">(new, prorated)</small>' : '') : 'none (renew)' ?></td>
                            <td><?= $r->why !== '' ? '<span class="text-muted">Skipped: '.out($r->why).'</span>' : '' ?></td>
                        </tr><?php endforeach; ?></tbody>
                    </table></div>
                    <?php if($ok_rows): ?>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end;">
                        <div><label for="method" style="font-weight: normal;">Paid by</label>
                            <select class="form-control" name="method" id="method" style="width: 140px;"><?php foreach($methods as $v => $l): ?><option value="<?= $v ?>"><?= $l ?></option><?php endforeach; ?></select></div>
                        <div><label for="reference" style="font-weight: normal;">Check number or reference (applies to all)</label>
                            <input type="text" class="form-control" name="reference" id="reference" maxlength="100" style="width: 260px;"></div>
                        <div><label for="received_on" style="font-weight: normal;">Received on</label>
                            <input type="date" class="form-control" name="received_on" id="received_on" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" style="width: 180px;" required></div>
                    </div>
                    <button type="submit" class="btn btn-outline btn-primary" style="font-size: 18px; margin-top: 12px;"><i class="fa fa-check"></i> Record the ticked <?= strtolower(CCMPS) ?></button>
                    <?php endif; ?>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
