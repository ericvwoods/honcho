<?php
  // shared top of every Security screen: navbar, logo, page header, flash message, screen tabs
  include('navbar.php');
  $rbac_tab = $rbac_tab ?? '';
?>

<div class="ibox-content"> <!-- ibox for page header -->
    <div class="row">
        <div class="col-md-1">
            <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
        </div>

        <div class="col-md-7">
            <span style="color:<?= SN_CLR ?>; font-size: 30px;"><?= out($header) ?></span>

            <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
              set_flashdata(''); ?>
            <?php else: ?>
              <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
              set_flashdata(''); ?>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <br>
            <p>A <strong>group</strong> holds the functions its people may use. Tick functions on
               <em>Privileges</em>, add people on <em>Members</em>. A person gets everything any of their groups allows.
               Changes work on the person's next click and are written to the Auditlog.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-sm <?= $rbac_tab == 'groups' ? 'btn-primary' : 'btn-white' ?>" href="<?= BASE_URL ?>system-rbac/manage"><i class="fa fa-users"></i> Groups</a>
            <a class="btn btn-sm <?= $rbac_tab == 'person' ? 'btn-primary' : 'btn-white' ?>" href="<?= BASE_URL ?>system-rbac/person"><i class="fa fa-user"></i> Effective access</a>
            <?php if(!empty($group) && !empty($group->id)): ?>
                &nbsp;|&nbsp; <strong><?= out($group->title) ?>:</strong>
                <a class="btn btn-sm <?= $rbac_tab == 'privileges' ? 'btn-primary' : 'btn-white' ?>" href="<?= BASE_URL ?>system-rbac/privileges/<?= $group->id ?>"><i class="fa fa-check-square-o"></i> Privileges</a>
                <a class="btn btn-sm <?= $rbac_tab == 'members' ? 'btn-primary' : 'btn-white' ?>" href="<?= BASE_URL ?>system-rbac/members/<?= $group->id ?>"><i class="fa fa-user-plus"></i> Members</a>
                <a class="btn btn-sm <?= $rbac_tab == 'edit' ? 'btn-primary' : 'btn-white' ?>" href="<?= BASE_URL ?>system-rbac/updategroup/<?= $group->id ?>"><i class="fa fa-pencil"></i> Name &amp; description</a>
                <?php if(empty($group->active)): ?><span class="label label-warning">Inactive - gives nothing</span><?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div> <!-- End Ibox for page header -->
