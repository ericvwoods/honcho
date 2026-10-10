<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>

<div class="ibox">
    <div class="ibox-title">
        <h2><strong><?= out($headline) ?></strong></h2>
    </div>
    <div class="ibox-content">

        <?php include __DIR__ . '/formerrors.php'; ?>

        <?php if (count($teams) === 0): ?>
            <div class="alert alert-warning">
                You need at least one team before you can create a project.
                <a href="<?= BASE_URL ?>pm/create_team">Create a team</a>.
            </div>
        <?php endif; ?>

        <?= form_open($form_location) ?>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Project name *</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" maxlength="150" required value="<?= out($name) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Team *</strong></label>
                <div class="col-sm-4">
                    <select class="form-control" name="team_id" required>
                        <option value="">Select</option>
                        <?php foreach ($teams as $tid => $tname): ?>
                            <option value="<?= (int) $tid ?>" <?= ((int) $tid === (int) $team_id) ? 'selected' : '' ?>><?= out($tname) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Product Owner</strong></label>
                <div class="col-sm-4">
                    <select class="form-control" name="product_owner">
                        <option value="0">Not Assigned</option>
                        <?php foreach ($users as $uid => $uname): ?>
                            <option value="<?= (int) $uid ?>" <?= ((int) $uid === (int) $product_owner) ? 'selected' : '' ?>><?= out($uname) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Only the PO or a PM admin can accept user stories.</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Status</strong></label>
                <div class="col-sm-3">
                    <select class="form-control" name="status">
                        <?php foreach ($statuses as $sid => $stitle): ?>
                            <option value="<?= (int) $sid ?>" <?= ((int) $sid === (int) $status) ? 'selected' : '' ?>><?= out($stitle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Start date</strong></label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="startdate" value="<?= out($startdate) ?>">
                </div>
                <label class="col-sm-2 col-form-label"><strong>End date</strong></label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="enddate" value="<?= out($enddate) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Short description</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="shortdescription" maxlength="255" value="<?= out($shortdescription) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="description" rows="6"><?= out($description) ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-8 offset-sm-2">
                    <button class="btn btn-primary" type="submit" name="submit" value="Submit"><i class="fa fa-save"></i>
                        <?= ($update_id > 0) ? 'Save Changes' : 'Save New Project' ?></button>
                    <a class="btn btn-white" href="<?= BASE_URL . $cancel_url ?>"><i class="fa fa-times-circle"></i> Cancel</a>
                </div>
            </div>

        <?= form_close() ?>
    </div>
</div>
</div>
