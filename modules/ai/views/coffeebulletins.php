<?php
  include('navbar.php');
  $audiences = array('all' => 'Everyone', 'admins' => 'Admins\' reports only', 'members' => CCMPS.'\' reports only');
  $today = date('Y-m-d');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-7" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= out($header) ?></span>
                </div>
                <div class="col-md-4" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/7#bulletins" style="font-size: 20px;" title="Help: bulletins"><i class="fa fa-question-circle"></i> Help</a>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>ai/coffeebulletin/<?= $subentity_id ?>/0" style="font-size: 20px;"><i class="fa fa-plus"></i> Add</a>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/coffee" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
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

                <p style="color: #676a6c;">A bulletin is printed word for word at the top of the Coffee Reports, between its show dates.
                   <?= $subentity_id === 0 ? 'National\'s bulletins go on every report: National\'s and each '.strtolower(SUBENTITY).'\'s admin report, and every '.strtolower(CCMP).'\'s own report.'
                                           : 'This '.strtolower(SUBENTITY).'\'s bulletins go on its admin report and on its '.strtolower(CCMPS).'\' own reports.' ?></p>

                <?php if(empty($bulletins)): ?>
                <p class="text-muted">No bulletins yet. Click <strong>Add</strong> to post one.</p>
                <?php else: ?>
                <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px;">
                    <thead><tr><th>Bulletin</th><th>Goes on</th><th>Shows</th><th>Today</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach($bulletins as $b):
                        $showing = $b->active && (!$b->show_from || $b->show_from <= $today) && (!$b->show_until || $b->show_until >= $today);
                        $state   = !$b->active ? 'Hidden' : ($showing ? 'Showing' : ($b->show_from && $b->show_from > $today ? 'Starts later' : 'Ended')); ?>
                    <tr>
                        <td><strong><?= out($b->title) ?></strong><?php if($b->body): ?><br><small class="text-muted"><?= out(mb_strimwidth((string) $b->body, 0, 140, '...')) ?></small><?php endif; ?></td>
                        <td><?= out($audiences[$b->audience] ?? $b->audience) ?></td>
                        <td style="white-space: nowrap;"><?= $b->show_from ? date('M j, Y', strtotime($b->show_from)) : 'Now' ?> to <?= $b->show_until ? date('M j, Y', strtotime($b->show_until)) : 'no end' ?></td>
                        <td><span style="color: <?= $showing ? SN_CLR : '#999' ?>; font-weight: <?= $showing ? 'bold' : 'normal' ?>;"><?= $state ?></span></td>
                        <td style="white-space: nowrap;">
                            <a class="btn btn-outline btn-primary btn-sm" href="<?= BASE_URL ?>ai/coffeebulletin/<?= $subentity_id ?>/<?= (int) $b->id ?>" style="font-size: 15px;"><i class="fa fa-pencil"></i> Change</a>
                            <form method="post" action="<?= BASE_URL ?>ai/coffeebulletindelete" style="display: inline;" class="bulletin-delete">
                                <input type="hidden" name="token" value="<?= $token ?>"><input type="hidden" name="subentity_id" value="<?= $subentity_id ?>"><input type="hidden" name="id" value="<?= (int) $b->id ?>">
                                <button type="submit" class="btn btn-outline btn-danger btn-sm" style="font-size: 15px;"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <p class="text-muted" style="font-size: 14px;">Delete asks for a second click. To take a bulletin down but keep it, untick <strong>Shown</strong> on its form.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
  document.querySelectorAll('form.bulletin-delete').forEach(function(f){ // a second click confirms
    f.addEventListener('submit', function(e){
      var b = f.querySelector('button');
      if(!f.dataset.armed){ e.preventDefault(); f.dataset.armed = '1'; b.innerHTML = '<i class="fa fa-trash"></i> Click again to delete'; }
    });
  });
</script>
