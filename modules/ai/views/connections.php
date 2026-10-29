<?php
  include('navbar.php');

  // one status pill: what an admin needs to know at a glance
  $status = function($conn){
      if(!$conn || empty($conn->credential_enc)){ return array('#999999', 'No key'); }
      if(!$conn->enabled){ return array('#999999', 'Switched off'); }
      if($conn->last_test_ok === NULL){ return array('coral', 'Not tested'); }
      return $conn->last_test_ok ? array(SN_CLR, 'Working') : array('crimson', 'Test failed');
  };
?>

<div class="row"> <!-- Page Row One -->
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                </div>
                <div class="col-md-6" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $header ?></span>
                </div>
                <div class="col-md-5" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>ai/usage" style="font-size: 20px;"><i class="fa fa-bar-chart"></i> Usage</a>
                    <a class="btn btn-outline btn-default" href="<?= BASE_URL ?>help/guide/admin/7#step-1-connect-the-ai" style="font-size: 20px;" title="Help: connecting the AI"><i class="fa fa-question-circle"></i></a>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>

        <br>

        <div class="ibox">
            <div class="ibox-content">

                <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>'); set_flashdata(''); ?>
                <?php else: ?>
                  <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>'); set_flashdata(''); ?>
                <?php endif; ?>

                <p style="font-size: 16px; color: #676a6c;">
                    Each connection is an AI provider account with its own API key and bill. <strong>National's</strong> is used by System Admins and <?= CCMP ?> Admins.
                    A <?= strtolower(SUBENTITY) ?> may set up its own for its <?= SUBENTITY ?> Admins; <?= strtolower(SUBENTITIES) ?> without one
                    <?= $fallback === 'national' ? 'use National\'s' : 'get no AI (plain numbers only)' ?> (System Settings, Features &amp; Policy).
                    Keys are stored encrypted and never shown again after you enter them.
                </p>

                <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px;">
                    <thead><tr><th>Scope</th><th>Provider and model</th><th>Key</th><th>Status</th><th>This month</th><th>Limit</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach($rows as $row): $conn = $row->conn; list($clr, $label) = $status($conn); ?>
                        <tr>
                            <td><strong><?= out($row->name) ?></strong></td>
                            <td><?= $conn ? out(($providers[$conn->provider]['models'][$conn->model] ?? $conn->model)) : '<span class="text-muted">Not set up</span>' ?></td>
                            <td><?= $conn && $conn->credential_hint ? '&hellip;'.out($conn->credential_hint) : '<span class="text-muted">&mdash;</span>' ?></td>
                            <td><span style="display: inline-block; padding: 2px 10px; border-radius: 12px; color: #fff; background: <?= $clr ?>; font-size: 14px;"><?= $label ?></span>
                                <?php if($conn && $conn->last_test_at): ?><br><small class="text-muted"><?= date('M j, g:ia', (int) $conn->last_test_at) ?></small><?php endif; ?></td>
                            <td style="font-variant-numeric: tabular-nums;">$<?= number_format($row->spent, 2) ?></td>
                            <td style="font-variant-numeric: tabular-nums;"><?= $conn && (float) $conn->monthly_limit > 0 ? '$'.number_format((float) $conn->monthly_limit, 2) : '<span class="text-muted">None</span>' ?></td>
                            <td style="white-space: nowrap;">
                                <?php if($row->can_manage): ?>
                                <a class="btn btn-outline btn-primary btn-sm" href="<?= BASE_URL ?>ai/connection/<?= $row->subentity_id ?>" style="font-size: 15px;"><i class="fa fa-pencil"></i> <?= $conn ? 'Edit' : 'Set up' ?></a>
                                <?php if($conn && $conn->credential_enc): ?>
                                <form method="post" action="<?= BASE_URL ?>ai/testconnection" style="display: inline;">
                                    <input type="hidden" name="token" value="<?= $token ?>">
                                    <input type="hidden" name="subentity_id" value="<?= $row->subentity_id ?>">
                                    <input type="hidden" name="back" value="list">
                                    <button type="submit" class="btn btn-outline btn-success btn-sm" style="font-size: 15px;"><i class="fa fa-plug"></i> Test</button>
                                </form>
                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>

                <?php if($all && $chapters_without > 0): ?>
                <p class="text-muted" style="font-size: 15px;"><?= $chapters_without ?> <?= strtolower(SUBENTITIES) ?> have no AI connection of their own.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
