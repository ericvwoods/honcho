<?php
  include('navbar.php');
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
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/coffeearchive/<?= (int) $run->subentity_id ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>
        <br>
        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <p><strong><?= $run->ai_used ? 'Written by the AI' : 'Plain report' ?></strong>, <?= (int) $run->recipients ?> recipient(s).
                   <?= $run->message ? '<br><small class="text-muted">'.out($run->message).'</small>' : '' ?></p>
                <pre style="white-space: pre-wrap; font-family: inherit; font-size: 15px; background: #f8f8f8; border: 1px solid #e7eaec; padding: 14px; max-width: 760px;"><?= out((string) $run->report_text) ?></pre>

                <h3 style="color: <?= SN_CLR ?>; margin-top: 24px;">Collected data</h3>
                <p class="text-muted">What each section found, before the write-up. Use it to check the report's facts.</p>
                <?php foreach($sections as $s): ?>
                <h4 style="margin-bottom: 4px;"><?= out($s['label'] ?? '') ?><?= empty($s['ok']) ? ' <small style="color: crimson;">(unavailable)</small>' : '' ?></h4>
                <pre style="white-space: pre-wrap; font-size: 13px; background: #fafafa; border: 1px solid #eee; padding: 10px; max-width: 760px;"><?= out($s['text'] ?? '') ?></pre>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
