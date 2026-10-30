<?php
  include('navbar.php');
  $status_labels = array('sent' => 'Sent', 'partial' => 'Sent, some sections unavailable', 'plain' => 'Sent without AI', 'failed' => 'Not sent');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1"><img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo"></div>
                <div class="col-md-6" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $header ?></span>
                </div>
                <div class="col-md-5" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>ai/connections" style="font-size: 18px;"><i class="fa fa-magic"></i> AI Connections</a>
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/7" style="font-size: 18px;" title="Help: the Daily Coffee Report"><i class="fa fa-question-circle"></i></a>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 18px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
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

                <p style="color: #676a6c;">A short email each morning for the admins: membership, events, posts, documents, plus weather, news and video sections you choose.
                   The AI writes it up from the collected facts; without AI, the plain facts are sent. <strong>Bulletins</strong> you post are printed word for word at the top.</p>
                <?php if($member_reports !== null): ?>
                <p style="color: #676a6c;"><?= CCMPS ?>' own Coffee Reports: <?= (int) setting('COFFEE_MEMBER_REPORTS', 0) === 1
                    ? '<strong>available</strong> (My Coffee Report in the '.strtolower(CCMP).' menu); '.(int) $member_reports.' switched on.'
                    : 'switched off (System Settings, Features &amp; Policy).' ?></p>
                <?php endif; ?>

                <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px;">
                    <thead><tr><th>Scope</th><th>Status</th><th>When</th><th>Write-up</th><th>Last sent</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach($rows as $row): $r = $row->report; ?>
                    <tr>
                        <td><strong><?= out($row->name) ?></strong></td>
                        <td><?= $r && $r->enabled ? '<span style="color: '.SN_CLR.'; font-weight: bold;">On</span>' : '<span class="text-muted">'.($r ? 'Off' : 'Not set up').'</span>' ?></td>
                        <td><?= $r ? out($r->send_time).' '.out(str_replace(array('America/', '_'), array('', ' '), $r->timezone)).'<br><small class="text-muted">'.out(str_replace(',', ', ', ucwords($r->days, ','))).'</small>' : '&mdash;' ?></td>
                        <td><?= $row->ai ? 'AI' : '<span class="text-muted">Plain (no AI connection)</span>' ?></td>
                        <td><?php if($row->last): ?>
                                <?= date('M j, g:ia', (int) $row->last->started_at) ?><br>
                                <small style="color: <?= in_array($row->last->status, array('sent', 'partial', 'plain'), true) ? SN_CLR : 'crimson' ?>;"><?= out($status_labels[$row->last->status] ?? $row->last->status) ?><?= $row->last->kind === 'test' ? ' (test)' : '' ?></small>
                            <?php else: ?><span class="text-muted">Never</span><?php endif; ?></td>
                        <td style="white-space: nowrap;">
                            <?php if($row->can_manage): ?>
                            <a class="btn btn-outline btn-primary btn-sm" href="<?= BASE_URL ?>ai/coffeesettings/<?= $row->subentity_id ?>" style="font-size: 15px;"><i class="fa fa-pencil"></i> <?= $r ? 'Settings' : 'Set up' ?></a>
                            <a class="btn btn-outline btn-primary btn-sm" href="<?= BASE_URL ?>ai/coffeebulletins/<?= $row->subentity_id ?>" style="font-size: 15px;"><i class="fa fa-bullhorn"></i> Bulletins</a>
                            <?php endif; ?>
                            <?php if($row->last): ?>
                            <a class="btn btn-outline btn-default btn-sm" href="<?= BASE_URL ?>ai/coffeearchive/<?= $row->subentity_id ?>" style="font-size: 15px;"><i class="fa fa-archive"></i> Sent</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
