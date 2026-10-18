<?php
  $rbac_tab = 'person';
  include('pagehead.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <form class="form-inline" action="<?= BASE_URL ?>system-rbac/person" method="post">
        <label for="pickperson">Person:&nbsp;</label>
        <select class="form-control" name="tg_user_id" id="pickperson" required>
            <option value="">Pick a person…</option>
            <?php foreach($people as $p) { ?>
            <option value="<?= $p->id ?>" <?= ($person && $person->tg_user_id == $p->id) ? 'selected' : '' ?>><?= out($p->name) ?> (<?= $p->kind ?>)</option>
            <?php } ?>
        </select>
        <button class="btn btn-white" type="submit">Show</button>
        <span class="text-muted">&nbsp; For checking only - nothing is changed here.</span>
    </form>

    <?php if($person): ?>
    <br>
    <p><strong><?= out($person->name) ?></strong> - <?= $person->kind ?> login<?= $person->email ? ', '.out($person->email) : '' ?></p>

    <h3>Groups</h3>
    <?php if(empty($groups)): ?>
        <p class="text-muted">Not in any group, so this login has no RBAC access.</p>
    <?php else: ?>
        <p>
        <?php foreach($groups as $g) { ?>
            <a class="btn btn-xs btn-white" href="<?= BASE_URL ?>system-rbac/members/<?= $g->id ?>"><?= out($g->title) ?></a>
            <?php if(!$g->active): ?><span class="label label-warning">inactive</span><?php endif; ?>
        <?php } ?>
        </p>
    <?php endif; ?>

    <h3>Functions this login ends up with</h3>
    <?php if(empty($functions)): ?>
        <p class="text-muted">None.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="color:<?= SN_CLR ?>;">Module</th>
                    <th style="color:<?= SN_CLR ?>;">Function</th>
                    <th style="color:<?= SN_CLR ?>;">Code</th>
                    <th style="color:<?= SN_CLR ?>;">Given by</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($functions as $f) { ?>
                <tr>
                    <td><?= out($f->module_title) ?></td>
                    <td><?= out($f->title) ?></td>
                    <td><code><?= out($f->module_code) ?>/<?= out($f->code) ?></code></td>
                    <td><?= out($f->via) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <a class="btn btn-white" href="<?= BASE_URL ?>system-rbac/manage">Back to groups</a>
</div>
<!-- End Content -->
<br>
