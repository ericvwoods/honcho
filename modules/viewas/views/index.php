<?php include('navbar.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/1#view-as-a-member" style="font-size: 20px;" title="Help: View as a member"><i class="fa fa-question-circle"></i> Help</a>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); set_flashdata(''); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); set_flashdata(''); ?>
                <?php endif; ?>
                <p style="color: #676a6c;">See Honcho exactly as a <?= strtolower(CCMP) ?> sees it, and act for them. A bar at the top of every page takes you back to your own account. Everything you do meanwhile is logged as you acting as them. Changing their password, login name or email, and reissuing their card, aren't available.</p>
                <form method="get" action="<?= BASE_URL ?>viewas" style="display: flex; gap: 10px; max-width: 560px; margin-bottom: 14px;">
                    <input type="text" class="form-control" name="q" value="<?= out($q) ?>" placeholder="Name, <?= strtolower(CCMP) ?> number or email" aria-label="Search" autofocus>
                    <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-search"></i> Find</button>
                </form>
                <?php if($q !== '' && empty($rows)): ?><p class="text-muted">Nobody found.</p><?php endif; ?>
                <?php if($rows): ?>
                <div class="table-responsive"><table class="table table-striped" style="font-size: 15px;">
                    <thead><tr><th><?= CCMP ?></th><th>No.</th><th><?= SUBENTITY ?></th><th>Email</th><th></th></tr></thead>
                    <tbody><?php foreach($rows as $r): ?>
                    <tr><td><?= out(trim($r->first_name.' '.$r->last_name)) ?><?= !empty($r->locked) ? ' <span class="label label-warning">locked</span>' : '' ?></td><td><?= out((string) $r->ccmp_number) ?></td>
                        <td><?= out((string) $r->chapter_name) ?></td><td><?= out((string) $r->email_address) ?></td>
                        <td><?php if($r->ok): ?>
                            <form method="post" action="<?= BASE_URL ?>viewas/start" style="margin: 0;"><input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="ccmp_id" value="<?= (int) $r->id ?>"><input type="hidden" name="return" value="viewas">
                                <button type="submit" class="btn btn-outline btn-primary btn-sm"><i class="fa fa-user-secret"></i> View as</button></form>
                            <?php else: ?><small class="text-muted"><?= out($r->why) ?></small><?php endif; ?></td></tr>
                    <?php endforeach; ?></tbody></table></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
