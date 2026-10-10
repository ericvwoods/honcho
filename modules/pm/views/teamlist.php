<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>

<div class="ibox">
    <div class="ibox-title">
        <h2><strong>Teams</strong></h2>
        <div class="ibox-tools">
            <a class="btn btn-primary" href="<?= BASE_URL ?>pm/create_team"><i class="fa fa-plus"></i> New Team</a>
        </div>
    </div>

    <div class="ibox-content">
        <?php include __DIR__ . '/flashmsg.php'; ?>

        <?php if (count($teams) === 0): ?>
            <h3 class="text-muted">No teams yet. Create one to get started.</h3>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover pm-datatable">
                <thead>
                    <tr><th>Team</th><th>Description</th><th>Members</th><th>Open Projects</th><th></th></tr>
                </thead>
                <tbody>
                <?php foreach ($teams as $row): ?>
                    <tr>
                        <td><a href="<?= BASE_URL ?>pm/show_team/<?= (int) $row->id ?>"><strong><?= out($row->name) ?></strong></a></td>
                        <td><?= out($row->description) ?></td>
                        <td><?= (int) $row->member_count ?></td>
                        <td><?= (int) $row->project_count ?></td>
                        <td><a class="btn btn-xs btn-white" href="<?= BASE_URL ?>pm/create_team/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>

<?php include __DIR__ . '/datatable.php'; ?>
