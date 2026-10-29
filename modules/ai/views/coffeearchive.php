<?php
  include('navbar.php');
  $status_labels = array('sent' => 'Sent', 'partial' => 'Sent, some sections unavailable', 'plain' => 'Sent without AI', 'failed' => 'Not sent');
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
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/coffee" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <?php if(empty($runs)): ?>
                <p class="text-muted">Nothing sent yet.</p>
                <?php else: ?>
                <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px;">
                    <thead><tr><th>When</th><th>Kind</th><th>Result</th><th>Write-up</th><th>Emails</th><th>Telegram</th><th>Notes</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach($runs as $r): ?>
                    <tr>
                        <td style="white-space: nowrap;"><?= date('D M j, g:ia', (int) $r->started_at) ?></td>
                        <td><?= $r->kind === 'test' ? 'Test' : 'Scheduled' ?></td>
                        <td style="color: <?= $r->status === 'failed' ? 'crimson' : SN_CLR ?>;"><?= out($status_labels[$r->status] ?? $r->status) ?></td>
                        <td><?= $r->ai_used ? 'AI' : 'Plain' ?></td>
                        <td><?= (int) $r->recipients ?></td>
                        <td><?= !empty($r->telegram_sent) ? 'Sent' : '<span class="text-muted">&mdash;</span>' ?></td>
                        <td><small class="text-muted"><?= out((string) $r->message) ?></small></td>
                        <td><a class="btn btn-outline btn-primary btn-sm" href="<?= BASE_URL ?>ai/coffeerun/<?= (int) $r->id ?>" style="font-size: 15px;"><i class="fa fa-eye"></i> View</a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
