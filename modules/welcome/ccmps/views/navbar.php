
<!-- Begin Top Menu   -->

<!-- Note: this file is not used for the ccmphome - it's navbar is hard coded at the top of the file -->

<!-- <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"> -->
                <div class="row">
     <div class="col-md-5">
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

        <div class="navbar-header">

         <!--   <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> -->
         <ul class="nav navbar-top-links navbar-left">
        <li>
            <br>


             <?php if( DEBUGGING == true): ?>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">

             <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"> </i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span> > <?= $_SESSION['ccmpmode'] ?> <?= $_SESSION['actionmode'] ?>> <?= $id ?></strong></span>
             <!--               <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span> > <?= $_SESSION['ccmpmode'] ?> > <?= $_SESSION['tab'] ?></strong></span>  -->
            </a>

            <?php else: ?>
            <a href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                <span class="m-r-sm text-muted welcome-message"><i class="fa fa-home"></i><strong>Home > <?= $bc1 ?> > <span style="color: <?= NB_CLR ?>"><?= $bc2 ?></span></strong></span>
            </a>
             <?php endif; ?>

        </li>
        <li>
               <br>
<!--   <?= $_SESSION['chapter_name'] ?>  -->
<a href="<?= BASE_URL ?>welcome-ccmps/refreshmysessiondata"><i class="fa fa-user"></i>[<span style="color: <?= NB_CLR ?>" ><?= $_SESSION['ccmp_username'] ?><?= $_SESSION['honcho_username'] ?></span>] </a>

        </li>
        </ul>

        </div>
  </div>  <!-- col 6 -->
          <div class="col-md-3" style="white-space: nowrap;"> <!-- was col-md-4: the links column needed room for Font (2026-10-27) -->
              <br>
            <ul class="nav navbar-top-links navbar-left">

                <?php if($_SESSION['ccmpmode'] == 'mmdv' ||  $data['view_file'] == 'directorylist' ||  $data['view_file'] == 'currentroster'): ?>
                    <li><span class="m-r"><?= title_bar_name('member') ?></span></li>
                <?php else: ?>

<li><span class="m-r"><?= title_bar_name('member') ?></span></li> <!-- title shrinks a little on narrower screens so it doesn't run into the links -->

                     <!-- <?= SITENAME2 ?>   -->
               <!--    <li> <span class="m-r"><a href="<?= PUBLIC_WEBSITE ?>" target="_blank" style="color: <?= NB_CLR ?>;"><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME ?> </span><span style="font-weight: <?= SN_FNT_WT ?>; color: <?= SN2_CLR ?>; font-size: <?= SN_FNT_SZ ?>;"><?= SITENAME2 ?> </span> </a> </span></li>  -->

                <?php endif; ?>

            </ul>

          </div>  <!-- col 4 -->
                <div class="col-md-4">

            <ul class="nav navbar-top-links navbar-right"> <!-- Change Password, Font, Logout: one line on normal screens (col-md-4), wrap only when narrow -->


            <li>
                   <br>
                <a href="#" data-toggle="modal" data-target="#myModal">
                     <span class="m-r-sm text-muted welcome-message"><strong><i class="fa fa-key"></i>Change Password </strong></span>
                </a>
            </li>
            <li>
                   <br>
                <a href="<?= BASE_URL ?>help"> <!-- Help: the Member, Administrator's and Developer's Guides as web pages (2026-10-29) -->
                     <span class="m-r-sm text-muted welcome-message"><strong><i class="fa fa-question-circle"></i> Help </strong></span>
                </a>
            </li>
            <?php if(!empty($_SESSION['ccmp_logged_in'])): ?> <!-- Font: the member's own Small/Medium/Large choices (2026-10-27) -->
            <li>
                   <br>
                <a href="#" data-toggle="modal" data-target="#fontModal">
                     <span class="m-r-sm text-muted welcome-message"><strong><i class="fa fa-font"></i> Font </strong></span>
                </a>
            </li>
            <?php endif; ?>
              <?php if($_SESSION['honcho_logged_in'] == 1): ?>
                 <li>
                     <br>
                    <a href="<?= BASE_URL ?>honcho/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
              <?php else: ?>
                <li>
                     <br>
                    <a href="<?= BASE_URL ?>welcome/logout">
                     <span class="m-r-sm text-muted welcome-message"><strong> Logout </strong><i class="fa fa-sign-out"></i></span>
                    </a>
                </li>
              <?php endif; ?>
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li> -->
            </ul>
                      </div>  <!-- col 6 -->

        </nav>
  </div> <!-- row  -->

<!-- Change Password Modal
     Fields/ids (#crpass, #npass, #cpass, #rpwl, #dbtupd, #recid) and the
     #ChangeBtn1 click handler that posts them to welcome-ccmps/modalchangepw
     are already wired up globally in inspinia.php - this just supplies the
     markup so the existing handler has something to read. Only one #myModal
     should exist per page; don't pair this with another page-local #myModal
     (e.g. a font-size modal) on the same view. -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="changePasswordModalLabel">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="recid" value="<?= $_SESSION['ccmp_rec_id'] ?>">
        <input type="hidden" id="dbtupd" value="ccmps">
        <!-- Minimum new-password length enforced client-side by the existing
             #ChangeBtn1 handler. Set to 8 to match the mobile app's policy. -->
        <input type="hidden" id="rpwl" value="8">
        <div class="form-group">
          <label>Current Password</label>
          <input type="password" id="crpass" class="form-control" autocomplete="current-password">
        </div>
        <div class="form-group">
          <label>New Password</label>
          <input type="password" id="npass" class="form-control" autocomplete="new-password">
        </div>
        <div class="form-group">
          <label>Confirm New Password</label>
          <input type="password" id="cpass" class="form-control" autocomplete="new-password">
        </div>
        <span id="result" class="text-success"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
        <button type="button" id="ChangeBtn1" class="btn btn-primary">Change Password</button>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($_SESSION['ccmp_logged_in'])): ?>
<?php
  // Font pop-up: the member's own size choices (member_font_sizes(), saved by welcome-ccmps/savefontsizes)
  if (empty($_SESSION['fontsize_token'])) { $_SESSION['fontsize_token'] = bin2hex(random_bytes(16)); }
  $font_choices = member_font_sizes((int) ($_SESSION['ccmp_rec_id'] ?? 0));
?>
<div class="modal fade" id="fontModal" tabindex="-1" role="dialog" aria-labelledby="fontModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="fontModalLabel">Font Size</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Choose how large text appears on your pages.</p>
        <?php foreach ($font_choices as $type => $choice): ?>
        <div class="form-group">
          <label for="font_<?= $type ?>"><?= out($choice['label']) ?></label>
          <select class="form-control font-size-choice" id="font_<?= $type ?>" name="<?= out($choice['column']) ?>">
            <?php foreach ($choice['options'] as $id => $text): ?>
            <option value="<?= (int) $id ?>"<?= $id == $choice['current'] ? ' selected' : '' ?>><?= out($text) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <?php endforeach; ?>
        <span id="fontResult" class="text-danger"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
        <button type="button" id="fontSaveBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('fontSaveBtn').addEventListener('click', function () {
    var body = new URLSearchParams();
    body.append('token', <?= json_encode($_SESSION['fontsize_token']) ?>);
    document.querySelectorAll('#fontModal .font-size-choice').forEach(function (el) { body.append(el.name, el.value); });
    fetch(<?= json_encode(BASE_URL.'welcome-ccmps/savefontsizes') ?>, { method: 'POST', body: body, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.ok) { window.location.reload(); } // the new sizes apply on reload
        else { document.getElementById('fontResult').textContent = res.msg; }
      })
      .catch(function () { document.getElementById('fontResult').textContent = 'Could not save. Please try again.'; });
  });
</script>
<?php endif; ?>

<!-- End Top Menu   -->
