<?php /* PM sub-menu at the top of every PM page */ ?>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-lg-12">
        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>pm"><i class="fa fa-folder-open"></i> My Projects</a>
        <?php if ($is_admin): ?>
            <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>pm/manage_projects"><i class="fa fa-list"></i> All Projects</a>
            <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>pm/manage_teams"><i class="fa fa-users"></i> Teams</a>
        <?php endif; ?>
    </div>
</div>
