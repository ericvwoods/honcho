<?php
  include('navbar.php');

  // one labelled text box, the same layout for every field on this form
  $field = function($name, $label, $value, $max = 255, $type = 'text', $help = '') {
      $html  = '<div class="row"><div class="col-md-2"><label for="'.$name.'"><h2 style="color:'.SN_CLR.';">'.$label.':</h2></label></div>';
      $html .= '<div class="col-md-6"><div class="form-group row"><div class="col-sm-12">';
      $html .= '<input type="'.$type.'" class="form-control m-b" style="height: 40px; font-size: 20px;" name="'.$name.'" id="'.$name.'" value="'.out((string) $value).'" maxlength="'.$max.'">';
      if($help !== ''){ $html .= '<small class="text-muted">'.$help.'</small>'; }
      return $html.'</div></div></div></div>';
  };
?>

<form method="post" action="<?= BASE_URL ?>system-subentities/subentitysubmit/<?= $recid ?>">
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
                        <?php if($recid > 0): ?>
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">Updating: <?= out($chapter_title) ?></span>
                        <?php else: ?>
                            <span style="color:<?= CCMPS_CCMP_NAME_CLR ?>; font-size: <?= CCMPS_CCMP_FNT_SZ ?>;">Creating New <?= $entityname ?></span>
                        <?php endif; ?>
                    </div> <!-- end column -->

                    <div class="col-md-6">
                        <br>
                        <button class="btn btn-outline btn-primary" style="font-size: 20px;" name="submit" type="submit" value="Submit"><i class="fa fa-save"></i> Save Changes</button>

                        <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>system-subentities/manage" style="font-size: 20px; color: coral;"><i class="fa fa-times-circle"></i> Cancel</a>
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

                    <?= $field('chapter_title', 'Short Name', $chapter_title, 125, 'text', 'Required. Used in lists and menus.') ?>
                    <?= $field('description', 'Full Name', $description, 255, 'text', 'Shown on the member home and the website when filled in.') ?>

                    <div class="row">
                        <div class="col-md-2">
                            <label for="state"><h2 style="color:<?= SN_CLR ?>;">State:</h2></label>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control m-b" style="height: 40px; font-size: 20px;" name="state" id="state">
                                        <option value="">(none)</option>
                                        <?php foreach($states as $st): ?>
                                        <option value="<?= out($st->state_code) ?>"<?= strtoupper((string) $state) === $st->state_code ? ' selected' : '' ?>><?= out($st->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-muted">By the Numbers on the website counts the states of the active <?= strtolower(SUBENTITIES) ?>.</small>
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-2">
                            <label for="region"><h2 style="color:<?= SN_CLR ?>;">Region:</h2></label>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control m-b" style="height: 40px; font-size: 20px;" name="region" id="region">
                                        <option value="">(none)</option>
                                        <?php foreach($regions as $rg): ?>
                                        <option value="<?= (int) $rg->id ?>"<?= (int) $region === (int) $rg->id ? ' selected' : '' ?>><?= out($rg->title) ?><?= $rg->description !== $rg->title ? ' - '.out($rg->description) : '' ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-2">
                            <h2 style="color:<?= SN_CLR ?>;">Status:</h2>
                        </div> <!-- col-md-2 -->
                        <div class="col-md-6" style="font-size: 18px; padding-top: 18px;">
                            <label style="margin-right: 30px;"><input type="checkbox" name="chartered" value="1"<?= $chartered ? ' checked' : '' ?>> Chartered</label>
                            <label><input type="checkbox" name="active" value="1"<?= $active ? ' checked' : '' ?>> Active</label>
                            <br><small class="text-muted">Inactive <?= strtolower(SUBENTITIES) ?> (e.g. place holders) are left out of the counts on the website.</small>
                        </div> <!-- col-md-6 -->
                    </div> <!-- end row -->

                    <?= $field('annual_dues', 'Annual Dues', $annual_dues, 12, 'text', 'Chapter dues, e.g. 25.00') ?>
                    <?= $field('chapter_email', SUBENTITY.' Email', $chapter_email, 255, 'email') ?>
                    <?= $field('financial_contact', 'Financial Contact', $financial_contact) ?>
                    <?= $field('financial_email', 'Financial Email', $financial_email, 255, 'email') ?>
                    <?= $field('financial_phone', 'Financial Phone', $financial_phone, 255, 'tel') ?>
                    <?= $field('website', 'Website', $website, 255, 'url', 'Full address, e.g. https://example.org') ?>
                    <?= $field('facebook', 'Facebook', $facebook, 255, 'url') ?>
                    <?= $field('instagram', 'Instagram', $instagram, 255, 'url') ?>
                    <?= $field('youtube', 'YouTube', $youtube, 255, 'url') ?>
                    <?= $field('logo', 'Logo', $logo, 255, 'text', 'Path or address of the logo picture') ?>

                </div> <!-- end ibox-content -->

            </div> <!-- end ibox -->

        </div> <!-- end col-lg-12 -->
    </div> <!-- end row -->

</form>

<?php if(DEBUGGING == true): ?>
 <?php
    echo('<h3>View: system-subentities/views/subentitiescrud</h3>');
    echo('<h3>$_SESSION</h3>');
    json($_SESSION);
    echo('<h3>$data</h3>');
    json($data);
 ?>
<?php endif; ?>
