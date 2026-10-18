<?php
  $rbac_tab = 'groups';
  include('pagehead.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="<?= BASE_URL ?>system-rbac/creategroup"><i class="fa fa-plus"></i> New group</a>
        </div>
        <div class="col-md-6 text-right">
            <form class="form-inline" style="display:inline;" action="<?= BASE_URL ?>system-rbac/person" method="post">
                <label for="pickperson">Check one person's access:&nbsp;</label>
                <select class="form-control" name="tg_user_id" id="pickperson" required>
                    <option value="">Pick a person…</option>
                    <?php foreach($people as $p) { ?>
                    <option value="<?= $p->id ?>"><?= out($p->name) ?> (<?= $p->kind ?>)</option>
                    <?php } ?>
                </select>
                <button class="btn btn-white" type="submit">Show</button>
            </form>
        </div>
    </div>

<br>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th style="color:<?= SN_CLR ?>;">Group</th>
                            <th style="color:<?= SN_CLR ?>;">Description</th>
                            <th style="color:<?= SN_CLR ?>; text-align:center;">Functions</th>
                            <th style="color:<?= SN_CLR ?>; text-align:center;">People</th>
                            <th style="color:<?= SN_CLR ?>;">Status</th>
                            <th style="color:<?= SN_CLR ?>;">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($grouprecs as $row) { ?>
                        <tr class='gradeA'>
                            <td><strong><?= out($row->title) ?></strong></td>
                            <td><?= out($row->description) ?></td>
                            <td style="text-align:center;"><?= intval($row->nfunctions) ?></td>
                            <td style="text-align:center;"><?= intval($row->npeople) ?></td>
                            <td><?= $row->active ? 'Active' : '<span class="label label-warning">Inactive</span>' ?></td>
                            <td style="white-space:nowrap;">
                                <a class="btn btn-xs btn-white" href="<?= BASE_URL ?>system-rbac/privileges/<?= $row->id ?>" title="Tick the functions this group may use"><i class="fa fa-check-square-o"></i> Privileges</a>
                                <a class="btn btn-xs btn-white" href="<?= BASE_URL ?>system-rbac/members/<?= $row->id ?>" title="Add or remove people"><i class="fa fa-user-plus"></i> Members</a>
                                <a class="btn btn-xs btn-white" href="<?= BASE_URL ?>system-rbac/updategroup/<?= $row->id ?>" title="Rename"><i class="fa fa-pencil"></i></a>
                                <form style="display:inline;" action="<?= BASE_URL ?>system-rbac/togglegroup" method="post"
                                      onsubmit="return confirm('<?= $row->active ? 'Deactivate' : 'Reactivate' ?> this group?');">
                                    <input type="hidden" name="token" value="<?= $token ?>">
                                    <input type="hidden" name="group_id" value="<?= $row->id ?>">
                                    <button class="btn btn-xs <?= $row->active ? 'btn-warning' : 'btn-primary' ?>" type="submit">
                                        <?= $row->active ? 'Deactivate' : 'Reactivate' ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?><?= $home ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div>
<!-- End Content -->
<br>

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            paging: true,
            searching: true,
            pageLength: 50,
            order: [],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [ {extend: 'excel', title: 'Security Groups'}, {extend: 'print'} ]
        });
    });
</script>
