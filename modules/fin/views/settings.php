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
                    <button type="submit" form="duessettings" class="btn btn-outline btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> Save</button>
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

                <?php $month_names = array(1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'); ?>
                <form method="post" action="<?= BASE_URL ?>fin/settingssubmit" id="duessettings">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <h3 style="color: <?= SN_CLR ?>;">National dues by <?= strtolower(CCMP) ?> type</h3>
                    <div class="table-responsive"><table class="table" style="font-size: 15px; max-width: 900px;">
                        <thead><tr><th>Type</th><th>National dues ($)</th><th>Always Current</th><th>Offered in the <?= SUBENTITY ?> at Large</th><th>Prorated for new <?= strtolower(CCMPS) ?></th></tr></thead>
                        <tbody><?php foreach($types as $t): ?>
                        <tr<?= $t->active ? '' : ' style="color: #aaa;"' ?>><td><?= out($t->ccmp_type.' '.$t->description) ?><?= $t->active ? '' : ' (retired)' ?></td>
                            <td><input type="number" class="form-control" name="dues[<?= (int) $t->id ?>]" value="<?= number_format((float) $t->national_dues, 2, '.', '') ?>" min="0" step="0.01" style="width: 120px;" aria-label="National dues for <?= out($t->description) ?>"></td>
                            <td><input type="checkbox" name="always[<?= (int) $t->id ?>]" value="1"<?= $t->always_current ? ' checked' : '' ?> aria-label="Always Current: <?= out($t->description) ?>"></td>
                            <td><input type="checkbox" name="atlarge[<?= (int) $t->id ?>]" value="1"<?= $t->at_large ? ' checked' : '' ?> aria-label="At large: <?= out($t->description) ?>"></td>
                            <td><input type="checkbox" name="prorate[<?= (int) $t->id ?>]" value="1"<?= in_array((int) $t->id, $proration['types'], true) ? ' checked' : '' ?> aria-label="Prorated: <?= out($t->description) ?>"></td></tr>
                        <?php endforeach; ?></tbody></table></div>

                    <h3 style="color: <?= SN_CLR ?>;">National proration schedule</h3>
                    <p class="text-muted">The share of National dues a <strong>new</strong> <?= strtolower(CCMP) ?> of a prorated type pays, by the month they join (1 = full dues, 0.5 = half). Renewals are never prorated.</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px;">
                        <?php foreach($month_names as $mo => $name): ?>
                        <div><label for="factor<?= $mo ?>" style="font-weight: normal; display: block;"><?= $name ?></label>
                            <input type="number" class="form-control" name="factor[<?= $mo ?>]" id="factor<?= $mo ?>" value="<?= rtrim(rtrim(number_format($proration['months'][$mo], 4, '.', ''), '0'), '.') ?>" min="0" max="1" step="0.01" style="width: 78px;"></div>
                        <?php endforeach; ?>
                    </div>

                    <h3 style="color: <?= SN_CLR ?>;"><?= SUBENTITY ?> dues</h3>
                    <p class="text-muted">Each <?= strtolower(SUBENTITY) ?>'s own dues (0 = none) and who collects them. A <?= strtolower(SUBENTITY) ?> whose dues National collects (the <?= SUBENTITY ?> at Large) has them recorded by National's Financial Admins. <?= SUBENTITY ?> Admins can also set their own amount and proration schedule.</p>
                    <div class="table-responsive"><table class="table table-striped" style="font-size: 15px; max-width: 900px;">
                        <thead><tr><th><?= SUBENTITY ?></th><th>Dues ($)</th><th>Collected by</th><th></th></tr></thead>
                        <tbody><?php foreach($chapters as $c): ?>
                        <tr><td><?= out($c->name) ?></td>
                            <td><input type="number" class="form-control" name="chapter_dues[<?= (int) $c->id ?>]" value="<?= number_format((float) $c->annual_dues, 2, '.', '') ?>" min="0" step="0.01" style="width: 120px;" aria-label="Dues for <?= out($c->name) ?>"></td>
                            <td><select class="form-control" name="collected[<?= (int) $c->id ?>]" style="width: 170px;" aria-label="Who collects <?= out($c->name) ?> dues">
                                <option value="chapter"<?= $c->dues_collected_by !== 'national' ? ' selected' : '' ?>>The <?= strtolower(SUBENTITY) ?></option>
                                <option value="national"<?= $c->dues_collected_by === 'national' ? ' selected' : '' ?>>National</option></select></td>
                            <td><a href="<?= BASE_URL ?>fin/chapterdues/<?= (int) $c->id ?>?return=fin/settings">Proration</a></td></tr>
                        <?php endforeach; ?></tbody></table></div>
                    <p class="text-muted">Due date, grace period and the other dues settings are on System Settings, Financial. New amounts apply to dues recorded from now on; invoices already raised keep their amounts.</p>
                </form>
            </div>
        </div>
    </div>
</div>

