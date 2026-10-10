<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>

<div class="ibox">
    <div class="ibox-title">
        <h2><strong><?= out($headline) ?></strong></h2>
        <?php if ($is_admin): ?>
        <div class="ibox-tools">
            <a class="btn btn-primary" href="<?= BASE_URL ?>pm/create_project"><i class="fa fa-plus"></i> New Project</a>
        </div>
        <?php endif; ?>
    </div>

    <div class="ibox-content">
        <?php include __DIR__ . '/flashmsg.php'; ?>

        <?php if (count($projects) === 0): ?>
            <h3 class="text-muted">
                <?= ($listmode === 'mine')
                    ? 'You are not on any teams with planning or active projects yet.'
                    : 'No projects have been created yet.' ?>
            </h3>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover pm-datatable">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Team</th>
                        <th>Product Owner</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>End</th>
                        <?php if ($is_admin): ?><th></th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $row): ?>
                    <tr>
                        <td>
                            <a href="<?= BASE_URL ?>pm/show_project/<?= (int) $row->id ?>"><strong><?= out($row->name) ?></strong></a>
                            <?php if ($row->shortdescription !== ''): ?>
                                <br><small class="text-muted"><?= out($row->shortdescription) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= out($row->team_name) ?></td>
                        <td><?= out($row->po_name) ?></td>
                        <td><?= out($row->status_title) ?></td>
                        <td><?= out($row->startdate_fmt) ?></td>
                        <td><?= out($row->enddate_fmt) ?></td>
                        <?php if ($is_admin): ?>
                        <td><a class="btn btn-xs btn-white" href="<?= BASE_URL ?>pm/create_project/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a></td>
                        <?php endif; ?>
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
