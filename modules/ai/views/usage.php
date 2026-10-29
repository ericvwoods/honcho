<?php
  include('navbar.php');

  $features = array('test' => 'Connection tests', 'brief' => 'Daily brief', 'alert' => 'Alerts', 'chat' => 'Chat', 'change' => 'Changes');
  $total = 0.0;
  foreach($rows as $row){ $total += (float) $row->cost; }
?>

<div class="row"> <!-- Page Row One -->
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                </div>
                <div class="col-md-6" style="padding-top: 18px;">
                    <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $header ?>: <?= date('F Y', strtotime($month.'-01')) ?></span>
                </div>
                <div class="col-md-5" style="padding-top: 18px;">
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>ai/usage/<?= $prev ?>" style="font-size: 18px;"><i class="fa fa-chevron-left"></i> <?= date('M', strtotime($prev.'-01')) ?></a>
                    <?php if($next !== ''): ?>
                    <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>ai/usage/<?= $next ?>" style="font-size: 18px;"><?= date('M', strtotime($next.'-01')) ?> <i class="fa fa-chevron-right"></i></a>
                    <?php endif; ?>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>ai/connections" style="font-size: 18px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                </div>
            </div>
        </div>

        <br>

        <div class="ibox">
            <div class="ibox-content" style="font-size: 16px;">
                <?php if(empty($rows)): ?>
                    <p class="text-muted">No AI use in <?= date('F Y', strtotime($month.'-01')) ?>.</p>
                <?php else: ?>
                <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px; font-variant-numeric: tabular-nums;">
                    <thead><tr><th>Scope</th><th>Used for</th><th style="text-align: right;">Requests</th><th style="text-align: right;">Answered</th><th style="text-align: right;">Tokens in</th><th style="text-align: right;">Tokens out</th><th style="text-align: right;">Estimated cost</th></tr></thead>
                    <tbody>
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td><?= out($row->scope) ?></td>
                            <td><?= out($features[$row->feature] ?? $row->feature) ?></td>
                            <td style="text-align: right;"><?= number_format((int) $row->requests) ?></td>
                            <td style="text-align: right;"><?= number_format((int) $row->answered) ?></td>
                            <td style="text-align: right;"><?= number_format((int) $row->input_tokens) ?></td>
                            <td style="text-align: right;"><?= number_format((int) $row->output_tokens) ?></td>
                            <td style="text-align: right;">$<?= number_format((float) $row->cost, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot><tr><th colspan="6">Total</th><th style="text-align: right;">$<?= number_format($total, 2) ?></th></tr></tfoot>
                </table>
                </div>
                <?php endif; ?>
                <p class="text-muted">Estimated from each provider's list prices. Each scope's provider bill is the real figure.</p>
            </div>
        </div>
    </div>
</div>
