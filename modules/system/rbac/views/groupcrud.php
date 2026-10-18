<?php
  $rbac_tab = 'edit';
  include('pagehead.php');
?>

<!-- Begin Content -->
<div class="ibox-content">
    <form action="<?= BASE_URL ?>system-rbac/groupsubmit" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input type="hidden" name="id" value="<?= intval($group->id) ?>">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" style="color:cornflowerblue;" for="title">Group name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" id="title" maxlength="100" required
                       value="<?= out($group->title) ?>" placeholder="e.g. DMS Editors, Chapter Admins, PM Admins">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" style="color:cornflowerblue;" for="description">Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" id="description" maxlength="255"
                       value="<?= out($group->description) ?>" placeholder="What this group is for">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-8">
                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
                <a class="btn btn-white" href="<?= BASE_URL ?>system-rbac/manage">Cancel</a>
                <?php if(!$group->id): ?>
                    <span class="text-muted">&nbsp; After saving, tick the group's functions and add its people.</span>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<!-- End Content -->
<br>
