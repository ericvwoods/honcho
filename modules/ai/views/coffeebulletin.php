<?php
  include('navbar.php');
  $b = $bulletin;
  $label_style = 'color:'.SN_CLR.'; margin-top: 0;';
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
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/7#bulletins" style="font-size: 20px;" title="Help: bulletins"><i class="fa fa-question-circle"></i> Help</a>
                    <button type="submit" form="bulletinform" class="btn btn-outline btn-primary" style="font-size: 20px;"><i class="fa fa-save"></i> Save</button>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/coffeebulletins/<?= $subentity_id ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
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

                <form method="post" action="<?= BASE_URL ?>ai/coffeebulletinsubmit" id="bulletinform">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="hidden" name="subentity_id" value="<?= $subentity_id ?>">
                    <input type="hidden" name="id" value="<?= (int) $b->id ?>">

                    <div class="row">
                        <div class="col-md-3"><label for="title"><h3 style="<?= $label_style ?>">Title</h3></label></div>
                        <div class="col-md-9 form-group"><input type="text" class="form-control" name="title" id="title" maxlength="150" value="<?= out((string) $b->title) ?>" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="body"><h3 style="<?= $label_style ?>">Message</h3></label></div>
                        <div class="col-md-9 form-group">
                            <textarea class="form-control" name="body" id="body" rows="5" maxlength="2000"><?= out((string) $b->body) ?></textarea>
                            <small class="text-muted">Printed exactly as written, under the report's title. Plain text; keep it short.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="link_url"><h3 style="<?= $label_style ?>">Link</h3></label></div>
                        <div class="col-md-9 form-group">
                            <input type="url" class="form-control" name="link_url" id="link_url" maxlength="500" value="<?= out((string) $b->link_url) ?>" placeholder="https://... (optional)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="audience"><h3 style="<?= $label_style ?>">Goes on</h3></label></div>
                        <div class="col-md-9 form-group">
                            <select class="form-control" name="audience" id="audience" style="max-width: 360px;">
                                <option value="all"<?= $b->audience === 'all' ? ' selected' : '' ?>>Every report (admins and <?= strtolower(CCMPS) ?>)</option>
                                <option value="admins"<?= $b->audience === 'admins' ? ' selected' : '' ?>>Admins' reports only</option>
                                <option value="members"<?= $b->audience === 'members' ? ' selected' : '' ?>><?= CCMPS ?>' own reports only</option>
                            </select>
                            <small class="text-muted"><?= $subentity_id === 0 ? 'National\'s bulletins reach every '.strtolower(SUBENTITY).' too.' : 'Only '.out($scope_name).'\'s reports.' ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><h3 style="<?= $label_style ?>">Shows</h3></div>
                        <div class="col-md-9 form-group">
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                                <label for="show_from" style="margin: 0; font-weight: normal;">From</label>
                                <input type="date" class="form-control" name="show_from" id="show_from" value="<?= out((string) $b->show_from) ?>" style="max-width: 190px;">
                                <label for="show_until" style="margin: 0; font-weight: normal;">until</label>
                                <input type="date" class="form-control" name="show_until" id="show_until" value="<?= out((string) $b->show_until) ?>" style="max-width: 190px;">
                            </div>
                            <small class="text-muted">Both optional: blank From means now, blank until means no end. The dates are each report's own date.</small><br>
                            <label style="font-weight: normal; margin-top: 8px;"><input type="checkbox" name="active" value="1"<?= $b->active ? ' checked' : '' ?>> Shown (untick to take it down without deleting it)</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
