<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>

<div class="ibox">
    <div class="ibox-title">
        <h2><strong><?= out($headline) ?></strong></h2>
    </div>
    <div class="ibox-content">

        <?php include __DIR__ . '/formerrors.php'; ?>

        <?= form_open($form_location) ?>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Team name *</strong></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" maxlength="100" required value="<?= out($name) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="description" maxlength="255" value="<?= out($description) ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-8 offset-sm-2">
                    <button class="btn btn-primary" type="submit" name="submit" value="Submit"><i class="fa fa-save"></i>
                        <?= ($update_id > 0) ? 'Save Changes' : 'Save New Team' ?></button>
                    <a class="btn btn-white" href="<?= BASE_URL . $cancel_url ?>"><i class="fa fa-times-circle"></i> Cancel</a>
                </div>
            </div>

        <?= form_close() ?>
    </div>
</div>
</div>
