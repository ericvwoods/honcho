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
                    <button type="submit" form="chapterdues" class="btn btn-outline btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> Save</button>
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
                <form method="post" action="<?= BASE_URL ?>fin/chapterduessubmit" id="chapterdues">
                    <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= (int) $chapter->id ?>">
                    <div class="row">
                        <div class="col-md-3"><label for="annual_dues"><h3 style="color: <?= SN_CLR ?>; margin-top: 0;"><?= SUBENTITY ?> dues ($)</h3></label></div>
                        <div class="col-md-9 form-group"><input type="number" class="form-control" name="annual_dues" id="annual_dues" value="<?= number_format((float) $chapter->annual_dues, 2, '.', '') ?>" min="0" step="0.01" style="width: 140px;">
                            <small class="text-muted">Per year, on top of National's dues. 0 = no <?= strtolower(SUBENTITY) ?> dues (members are simply renewed).</small></div>
                    </div>
                    <?php if($national): ?>
                    <div class="row">
                        <div class="col-md-3"><label for="dues_collected_by"><h3 style="color: <?= SN_CLR ?>; margin-top: 0;">Collected by</h3></label></div>
                        <div class="col-md-9 form-group"><select class="form-control" name="dues_collected_by" id="dues_collected_by" style="width: 200px;">
                            <option value="chapter"<?= $chapter->dues_collected_by !== 'national' ? ' selected' : '' ?>>The <?= strtolower(SUBENTITY) ?></option>
                            <option value="national"<?= $chapter->dues_collected_by === 'national' ? ' selected' : '' ?>>National</option></select></div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-3"><h3 style="color: <?= SN_CLR ?>; margin-top: 0;">Proration</h3><small class="text-muted">For new <?= strtolower(CCMPS) ?> only.</small></div>
                        <div class="col-md-9">
                            <p style="margin-bottom: 4px;">Prorate the <?= strtolower(SUBENTITY) ?> dues of new:</p>
                            <?php foreach($types as $t): ?><label style="margin-right: 14px; font-weight: normal;"><input type="checkbox" name="prorate[<?= (int) $t->id ?>]" value="1"<?= in_array((int) $t->id, $proration['types'], true) ? ' checked' : '' ?>> <?= out($t->description) ?></label><?php endforeach; ?>
                            <p style="margin: 10px 0 4px;">Share of the <?= strtolower(SUBENTITY) ?> dues they pay, by the month they join (1 = full, 0.5 = half):</p>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                <?php foreach($month_names as $mo => $name): ?>
                                <div><label for="factor<?= $mo ?>" style="font-weight: normal; display: block;"><?= $name ?></label>
                                    <input type="number" class="form-control" name="factor[<?= $mo ?>]" id="factor<?= $mo ?>" value="<?= rtrim(rtrim(number_format($proration['months'][$mo], 4, '.', ''), '0'), '.') ?>" min="0" max="1" step="0.01" style="width: 78px;"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

