<?php
  $rbac_tab = 'members';
  include('pagehead.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" action="<?= BASE_URL ?>system-rbac/addmember" method="post">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="hidden" name="group_id" value="<?= $group->id ?>">
                <label for="addperson">Add a person:&nbsp;</label>
                <select class="form-control" name="tg_user_id" id="addperson" required>
                    <option value="">Pick a person…</option>
                    <?php foreach($others as $p) { ?>
                    <option value="<?= $p->id ?>"><?= out($p->name) ?> (<?= $p->kind ?>)<?= $p->email ? ' - '.out($p->email) : '' ?></option>
                    <?php } ?>
                </select>
                <button class="btn btn-primary" type="submit"><i class="fa fa-user-plus"></i> Add</button>
            </form>
            <p class="text-muted" style="margin-top:6px;">Only people with a login are listed. Someone with both a member
               and a staff login appears twice; add the login(s) that should get this access.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th style="color:<?= SN_CLR ?>;">Name</th>
                            <th style="color:<?= SN_CLR ?>;">Login</th>
                            <th style="color:<?= SN_CLR ?>;">Email</th>
                            <th style="color:<?= SN_CLR ?>;">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($members as $p) { ?>
                        <tr class='gradeA'>
                            <td><a href="<?= BASE_URL ?>system-rbac/person/<?= $p->id ?>" title="Effective access"><?= out($p->name) ?></a></td>
                            <td><?= $p->kind ?></td>
                            <td><?= out($p->email) ?></td>
                            <td>
                                <form style="display:inline;" action="<?= BASE_URL ?>system-rbac/removemember" method="post"
                                      onsubmit="return confirm('Remove this person from the group?');">
                                    <input type="hidden" name="token" value="<?= $token ?>">
                                    <input type="hidden" name="group_id" value="<?= $group->id ?>">
                                    <input type="hidden" name="tg_user_id" value="<?= $p->id ?>">
                                    <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-times"></i> Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if(empty($members)): ?><p class="text-muted">Nobody is in this group yet.</p><?php endif; ?>
            </div>
        </div>
    </div>

    <a class="btn btn-white" href="<?= BASE_URL ?>system-rbac/manage">Back to groups</a>
</div>
<!-- End Content -->
<br>
