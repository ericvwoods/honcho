<?php include __DIR__ . '/navbar.php'; ?>

<div class="wrapper wrapper-content">
<?php include __DIR__ . '/pmmenu.php'; ?>
<?php include __DIR__ . '/flashmsg.php'; ?>

<div class="row">
    <!-- Left: members -->
    <div class="col-lg-7">
        <div class="ibox">
            <div class="ibox-title">
                <h2><strong><?= out($team->name) ?></strong></h2>
                <div class="ibox-tools">
                    <a class="btn btn-white" href="<?= BASE_URL ?>pm/create_team/<?= (int) $team->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </div>
            <div class="ibox-content">
                <?php if ($team->description !== ''): ?>
                    <p><?= out($team->description) ?></p>
                <?php endif; ?>

                <h3>Members</h3>
                <?php if (count($members) === 0): ?>
                    <p class="text-muted">No members yet.</p>
                <?php else: ?>
                <table class="table table-striped">
                    <tbody>
                    <?php foreach ($members as $m): ?>
                        <tr>
                            <td><i class="fa fa-user"></i> <?= out($m->name) ?>
                                <?php if ($m->source === 'member'): ?><span class="label"><?= CCMP ?></span><?php endif; ?>
                            </td>
                            <td><?= out($m->email) ?></td>
                            <td class="text-right">
                                <?= form_open('pm/remove_member/' . (int) $m->member_id, [
                                        'style'    => 'display: inline;',
                                        // form_open() HTML-escapes attribute values itself,
                                        // so only JSON-encode the text here (no out()).
                                        'onsubmit' => 'return confirm(' . json_encode('Remove ' . $m->name . ' from this team?', JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) . ');'
                                    ]) ?>
                                    <button type="submit" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-user-times"></i> Remove</button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <h3 style="margin-top: 20px;">Add a member</h3>
                <?php if (count($candidates) === 0): ?>
                    <p class="text-muted">Everyone eligible is already on this team.</p>
                <?php else: ?>
                    <?= form_open('pm/add_member/' . (int) $team->id, ['class' => 'form-inline']) ?>
                        <select class="form-control" name="tg_user_id" required style="min-width: 280px; margin-right: 10px;">
                            <option value="">Select a person</option>
                            <?php foreach ($candidates as $uid => $uname): ?>
                                <option value="<?= (int) $uid ?>"><?= out($uname) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add</button>
                    <?= form_close() ?>
                    <small class="text-muted">People added here get PM User access automatically if they don't have PM access yet.</small>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right: projects + delete -->
    <div class="col-lg-5">
        <div class="ibox">
            <div class="ibox-title"><h3><i class="fa fa-folder-open"></i> Projects</h3></div>
            <div class="ibox-content">
                <?php if (count($projects) === 0): ?>
                    <p class="text-muted">This team has no projects.</p>
                <?php else: ?>
                    <ul class="list-unstyled">
                    <?php foreach ($projects as $p): ?>
                        <li style="padding: 4px 0;">
                            <a href="<?= BASE_URL ?>pm/show_project/<?= (int) $p->id ?>"><?= out($p->name) ?></a>
                            <span class="text-muted">(<?= out($p->status_title) ?>)</span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-content">
                <?= form_open('pm/delete_team/' . (int) $team->id, ['onsubmit' => "return confirm('Delete this team?');"]) ?>
                    <button type="submit" class="btn btn-outline btn-danger"><i class="fa fa-trash"></i> Delete Team</button>
                <?= form_close() ?>
                <small class="text-muted">A team with planning or active projects can't be deleted.</small>
            </div>
        </div>
    </div>
</div>
</div>
