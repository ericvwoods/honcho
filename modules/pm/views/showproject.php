<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>
<?php include __DIR__ . '/flashmsg.php'; ?>

<div class="row">
    <!-- Left: project details -->
    <div class="col-lg-8">
        <div class="ibox">
            <div class="ibox-title">
                <h2><strong><?= out($project->name) ?></strong>
                    <span class="label label-primary" style="margin-left: 10px;"><?= out($project->status_title) ?></span>
                </h2>
                <?php if ($is_admin): ?>
                <div class="ibox-tools">
                    <a class="btn btn-white" href="<?= BASE_URL ?>pm/create_project/<?= (int) $project->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="ibox-content">
                <?php if ($project->shortdescription !== ''): ?>
                    <h3><?= out($project->shortdescription) ?></h3>
                <?php endif; ?>

                <table class="table" style="max-width: 600px;">
                    <tr><th style="width: 180px;">Team</th><td><?= out($project->team_name) ?></td></tr>
                    <tr><th>Product Owner</th><td><?= out($project->po_name) ?></td></tr>
                    <tr><th>Start</th><td><?= out($project->startdate_fmt) ?></td></tr>
                    <tr><th>End</th><td><?= out($project->enddate_fmt) ?></td></tr>
                </table>

                <?php if (trim((string) $project->description) !== ''): ?>
                    <h4>Description</h4>
                    <div style="white-space: pre-wrap;"><?= out($project->description) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Phase 2 puts the Product Backlog and Sprints here -->
        <div class="ibox">
            <div class="ibox-title"><h3>Backlog &amp; Sprints</h3></div>
            <div class="ibox-content text-muted">Coming in Phase 2.</div>
        </div>
    </div>

    <!-- Right: team members -->
    <div class="col-lg-4">
        <div class="ibox">
            <div class="ibox-title">
                <h3><i class="fa fa-users"></i> Team: <?= out($project->team_name) ?></h3>
                <?php if ($is_admin): ?>
                <div class="ibox-tools">
                    <a class="btn btn-xs btn-white" href="<?= BASE_URL ?>pm/show_team/<?= (int) $project->team_id ?>">Manage team</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="ibox-content">
                <?php if (count($members) === 0): ?>
                    <p class="text-muted">No members yet.</p>
                <?php else: ?>
                    <ul class="list-unstyled">
                    <?php foreach ($members as $m): ?>
                        <li style="padding: 4px 0;">
                            <i class="fa fa-user"></i> <?= out($m->name) ?>
                            <?php if ((int) $m->tg_user_id === (int) $project->product_owner): ?>
                                <span class="label label-info">PO</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($is_admin): ?>
        <div class="ibox">
            <div class="ibox-content">
                <?= form_open('pm/delete_project/' . (int) $project->id,
                        ['onsubmit' => "return confirm('Delete this project? It will be hidden from all lists.');"]) ?>
                    <button type="submit" class="btn btn-outline btn-danger"><i class="fa fa-trash"></i> Delete Project</button>
                <?= form_close() ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>
