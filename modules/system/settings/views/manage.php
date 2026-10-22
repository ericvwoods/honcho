<?php
  include('navbar.php');

  // one setting: its label, the input its input_type calls for, and its help line
  $setting_input = function($row) {
      $name  = 'setting_'.$row->id;
      $value = (string) $row->settingvalue;
      $style = 'height: 40px; font-size: 20px;';
      switch($row->input_type) {
          case 'yesno':
              $html  = '<select class="form-control m-b" style="'.$style.' max-width: 160px;" name="'.$name.'" id="'.$name.'">';
              $html .= '<option value="1"'.($value === '1' ? ' selected' : '').'>On</option>';
              $html .= '<option value="0"'.($value !== '1' ? ' selected' : '').'>Off</option>';
              return $html.'</select>';
          case 'select':
              $html = '<select class="form-control m-b" style="'.$style.'" name="'.$name.'" id="'.$name.'">';
              foreach(explode(';', (string) $row->options) as $option){
                  $parts = explode('=', $option, 2);
                  $val   = trim($parts[0]);
                  $html .= '<option value="'.out($val).'"'.($val === $value ? ' selected' : '').'>'.out(trim($parts[1] ?? $val)).'</option>';
              }
              return $html.'</select>';
          case 'year':
              return '<input type="number" class="form-control m-b" style="'.$style.' max-width: 160px;" name="'.$name.'" id="'.$name.'" value="'.out($value).'" min="2000" max="2100" step="1" required>';
          case 'number':
              $range = preg_match('/^(-?\d+)-(-?\d+)$/', (string) $row->options, $m) ? ' min="'.$m[1].'" max="'.$m[2].'"' : '';
              return '<input type="number" class="form-control m-b" style="'.$style.' max-width: 200px;" name="'.$name.'" id="'.$name.'" value="'.out($value).'" step="1"'.$range.' required>';
          case 'url':
              return '<input type="text" inputmode="url" class="form-control m-b" style="'.$style.'" name="'.$name.'" id="'.$name.'" value="'.out($value).'" maxlength="255" placeholder="https://">';
          case 'phone':
              return '<input type="tel" class="form-control m-b" style="'.$style.' max-width: 260px;" name="'.$name.'" id="'.$name.'" value="'.out($value).'" maxlength="25">';
          case 'fraction':
              return '<input type="number" class="form-control m-b" style="'.$style.' max-width: 160px;" name="'.$name.'" id="'.$name.'" value="'.out($value).'" min="0" max="1" step="0.01" required>';
          default: // text
              return '<input type="text" class="form-control m-b" style="'.$style.'" name="'.$name.'" id="'.$name.'" value="'.out($value).'" maxlength="255" required>';
      }
  };
?>

<form method="post" action="<?= BASE_URL ?>system-settings/settingssubmit/<?= $tab ?>">
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
                    <div class="col-md-5">
                              <br>
                        <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;"><?= $header ?></span>
                    </div> <!-- end column -->

                    <div class="col-md-6">
                        <br>
                        <button class="btn btn-outline btn-primary" style="font-size: 20px;" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

                        <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?><?= $home_url ?>" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Close</a>
                    </div> <!-- end column -->

                </div> <!-- end row -->
            </div> <!-- end ibox -->

            <br> <!-- Gap between header and form -->

            <div class="ibox">

                <div class="ibox-content">

                    <?php if(($_SESSION['flashmsgcolor'] ?? 0) == 1): ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: lightseagreen;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                    <?php else: ?>
                      <?= flashdata('<div style="font-weight: bold; font-size: 20px; color: crimson;">', '</div>');
                      $flash_msg = '';
                      set_flashdata($flash_msg); ?>
                    <?php endif; ?>

                    <ul class="nav nav-tabs" style="margin-bottom: 20px;">
                        <?php foreach($tabs as $slug => $tabname): ?>
                        <li class="<?= $slug == $tab ? 'active' : '' ?>">
                            <a class="nav-link<?= $slug == $tab ? ' active' : '' ?>" href="<?= BASE_URL ?>system-settings/manage/<?= $slug ?>" style="font-size: 18px;<?= $slug == $tab ? ' color: '.SN_CLR.'; font-weight: bold;' : '' ?>"><?= out($tabname) ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if($tab == 'financial'): ?>
                    <p style="font-size: 16px; color: #676a6c;">Saving a new <strong>current membership year</strong> or turning the <strong>grace period</strong> on or off re-checks every <?= strtolower(CCMP) ?>'s status (Current, Past Due, Expired). You'll see what will change and confirm before anything is saved.</p>
                    <br>
                    <?php endif; ?>

                    <?php foreach($settings as $row): ?>
                    <div class="row">
                        <div class="col-md-3"><label for="setting_<?= $row->id ?>"><h2 style="color:<?= SN_CLR ?>;"><?= out($row->label ?: $row->title) ?>:</h2></label></div>
                        <div class="col-md-6">
                            <div class="form-group row"><div class="col-sm-12">
                                <?= $setting_input($row) ?>
                                <?php if(!empty($row->help)): ?><small class="text-muted" style="font-size: 14px;"><?= out($row->help) ?></small><?php endif; ?>
                                <?php if(!empty($row->updated_at)): ?><br><small class="text-muted">Last changed <?= date('M j, Y', (int) $row->updated_at) ?></small><?php endif; ?>
                            </div></div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div> <!-- end ibox-content -->

            </div> <!-- end ibox -->

        </div> <!-- end Col 12 Page Row One -->
    </div> <!-- end Page Row One -->

</form>

<!-- End Content -->
<br>

<?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: system-settings/views/manage</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
<?php endif; ?>
