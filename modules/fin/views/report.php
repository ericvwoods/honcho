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
                <form method="get" action="<?= BASE_URL ?>fin/report" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; margin-bottom: 12px;">
                    <div><label for="year" style="font-weight: normal;">Membership year</label><input type="number" class="form-control" name="year" id="year" value="<?= (int) $year ?>" style="width: 120px;"></div>
                    <?php if($national): ?>
                    <div><label for="chapter" style="font-weight: normal;"><?= SUBENTITY ?></label>
                        <select class="form-control" name="chapter" id="chapter" style="width: 260px;"><option value="0">All</option>
                        <?php foreach($chapters as $c): ?><option value="<?= (int) $c->id ?>"<?= (int) $c->id === $chapter ? ' selected' : '' ?>><?= out($c->name) ?></option><?php endforeach; ?></select></div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-outline btn-default">Show</button>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>fin/reportexport?year=<?= (int) $year ?>&chapter=<?= (int) $chapter ?>"><i class="fa fa-file-excel-o"></i> Excel</a>
                    <?php if($national): ?><a class="btn btn-outline btn-default" href="<?= BASE_URL ?>fin/reminders">Reminders sent</a><?php endif; ?>
                </form>
                <p class="text-muted">Member counts are today's statuses. Dollars are for membership year <?= (int) $year ?>.</p>
                <?php $t = array_fill_keys(array('current_n', 'pending_n', 'past_due_n', 'expired_n', 'chapter_paid', 'national_invoiced', 'national_paid', 'national_open', 'open_n'), 0); ?>
                <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                    <thead><tr><th><?= SUBENTITY ?></th><th>Current</th><th>Pending</th><th>Past Due</th><th>Expired</th><th><?= SUBENTITY ?> dues paid</th><th>National invoiced</th><th>National paid</th><th>Outstanding</th></tr></thead>
                    <tbody><?php foreach($rows as $r): foreach($t as $k => $v){ $t[$k] += (float) $r->$k; } ?>
                    <tr><td><?= out($r->name) ?></td><td><?= (int) $r->current_n ?></td><td><?= (int) $r->pending_n ?></td><td><?= (int) $r->past_due_n ?></td><td><?= (int) $r->expired_n ?></td>
                        <td>$<?= number_format((float) $r->chapter_paid, 2) ?></td><td>$<?= number_format((float) $r->national_invoiced, 2) ?></td><td>$<?= number_format((float) $r->national_paid, 2) ?></td>
                        <td>$<?= number_format((float) $r->national_open, 2) ?><?= $r->open_n ? ' <small class="text-muted">('.(int) $r->open_n.')</small>' : '' ?></td></tr>
                    <?php endforeach; ?></tbody>
                    <?php if(count($rows) > 1): ?>
                    <tfoot><tr style="font-weight: bold;"><td>Total</td><td><?= (int) $t['current_n'] ?></td><td><?= (int) $t['pending_n'] ?></td><td><?= (int) $t['past_due_n'] ?></td><td><?= (int) $t['expired_n'] ?></td>
                        <td>$<?= number_format($t['chapter_paid'], 2) ?></td><td>$<?= number_format($t['national_invoiced'], 2) ?></td><td>$<?= number_format($t['national_paid'], 2) ?></td><td>$<?= number_format($t['national_open'], 2) ?></td></tr></tfoot>
                    <?php endif; ?>
                </table></div>
            </div>
        </div>
    </div>
</div>

