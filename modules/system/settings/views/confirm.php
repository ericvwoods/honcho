<?php
  include('navbar.php');

  // how a value reads on this page: On/Off for switches, the value itself otherwise
  $shown = function($input_type, $value) {
      if($input_type == 'yesno'){ return $value === '1' ? 'On' : 'Off'; }
      return out((string) $value);
  };
?>

<form method="post" action="<?= BASE_URL ?>system-settings/confirmsettings">
    <input type="hidden" name="token" value="<?= $token ?>">

    <div class="row"> <!-- Page Row One -->
        <div class="col-lg-12"> <!-- Col 12 Page Row One -->
            <div class="ibox-content">
                <div class="row">

                    <div class="col-md-1">
                   <br>
                        <img src="<?= BASE_URL ?><?= MAIN_LOGO ?>" alt="Logo">
                        <br>
                        </div> <!-- end column -->
                    <div class="col-md-11">
                              <br>
                        <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">Save these settings and re-check <?= CCMP ?> statuses?</span>
                    </div> <!-- end column -->

                </div> <!-- end row -->
            </div> <!-- end ibox -->

            <br> <!-- Gap between header and form -->

            <div class="ibox">

                <div class="ibox-content">

                    <table class="table table-bordered" style="font-size: 18px; max-width: 800px;">
                        <thead>
                            <tr>
                                <th style="color:<?= SN_CLR ?>;">Setting</th>
                                <th style="color:<?= SN_CLR ?>;">Now</th>
                                <th style="color:<?= SN_CLR ?>;">Will be</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($changes as $change): ?>
                            <tr>
                                <td><?= out($change->label) ?></td>
                                <td><?= $shown($change->input_type, $change->old) ?></td>
                                <td><strong><?= $shown($change->input_type, $change->new) ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <p style="font-size: 18px;">Saving will re-check the dues status of <strong><?= number_format($members) ?> <?= strtolower(CCMPS) ?></strong> (everyone not deceased or deleted). Members behind on dues become <strong>Past Due</strong> when the grace period is on, or <strong>Expired</strong> when it's off. You'll see how many changed when it's done.</p>
                    <p style="font-size: 16px; color: #676a6c;">Lifetime <?= strtolower(CCMPS) ?> (year <?= CCMP_LIFETIME_YEAR ?>) are always Current. For now, <?= strtolower(CCMPS) ?> last renewed for 2026 or earlier keep their status: dues payments are only on record from 2027 on.</p>
                    <br>

                    <button class="btn btn-outline btn-primary dim" type="submit" name="submit" value="Confirm"><h3><strong><i class="fa fa-save"></i> Save and re-check</strong></h3></button>
                    <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>system-settings/manage/<?= $tab ?>"><h3><strong><i class="fa fa-times-circle"></i> Cancel</strong></h3></a>

                </div> <!-- end ibox-content -->

            </div> <!-- end ibox -->

        </div> <!-- end Col 12 Page Row One -->
    </div> <!-- end Page Row One -->

</form>

<!-- End Content -->
<br>
