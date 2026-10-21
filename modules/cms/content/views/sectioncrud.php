<?php
  include('navbar.php');
?>

<!-- Begin Content -->
<form method="post" action="<?= BASE_URL ?>cms-content/sectionsubmit/<?= (int) $id ?>">
<input type="hidden" name="token" value="<?= $token ?>">

<div class="ibox-content">

    <?php if((int) $id > 0): ?>
    <p class="text-muted" style="font-size: 15px;"><?= out($layout_desc) ?>. Show or hide it, and change its place on the page, on the Page Sections list.</p>
    <?php else: ?>
    <p class="text-muted" style="font-size: 15px;">The new section goes at the bottom of the page. Next you add its items (slides, boxes, people...), then drag it into place on the Page Sections list.</p>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="layout" style="color:<?= SN_CLR ?>; font-size: 18px;">What it shows</label>
        <div class="col-md-6">
            <select class="form-control" style="height: 40px; font-size: 18px;" name="layout" id="layout" required>
                <option value="">Choose...</option>
                <?php foreach($layouts as $code => $l): ?>
                <option value="<?= out($code) ?>"<?= $layout === $code ? ' selected' : '' ?>><?= out($l[0]) ?> (<?= out($code) ?>)</option>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">The same look as the existing section of that kind. Sunshine, the Bulletin Board, Careers, the Marquee, the Calendar and the counts are fed from their own pages, so each exists once.</small>
        </div>
    </div>

    <div class="form-group row">
        <span class="col-md-2 col-form-label" style="color:<?= SN_CLR ?>; font-size: 18px;">Show on</span>
        <div class="col-md-6" style="font-size: 16px; padding-top: 8px;">
            <label style="margin-right: 30px;"><input type="checkbox" name="show_member" value="1"<?= $show_member ? ' checked' : '' ?>> <?= out(CCMP) ?> home</label>
            <label><input type="checkbox" name="show_public" value="1"<?= $show_public ? ' checked' : '' ?>> Public website</label>
            <br><small class="text-muted">A section shows only once it has at least one item switched on.</small>
        </div>
    </div>
    <?php endif; ?>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="title" style="color:<?= SN_CLR ?>; font-size: 18px;">Heading</label>
        <div class="col-md-6">
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="title" id="title" value="<?= out($title) ?>" maxlength="150" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="subtitle" style="color:<?= SN_CLR ?>; font-size: 18px;">Subtitle</label>
        <div class="col-md-6">
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="subtitle" id="subtitle" value="<?= out($subtitle) ?>" maxlength="255">
            <small class="text-muted">A line under the heading (optional).</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="menu_label" style="color:<?= SN_CLR ?>; font-size: 18px;">Menu label</label>
        <div class="col-md-6">
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="menu_label" id="menu_label" value="<?= out($menu_label) ?>" maxlength="40">
            <small class="text-muted">The link in the top menu that scrolls down to this section. Leave blank for no link.</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary dim" type="submit"><h3><strong><i class="fa fa-save"></i> Save Changes</strong></h3></button>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>cms-content/sections"><h3><strong><i class="fa fa-times-circle"></i> Cancel</strong></h3></a>
        </div>
    </div>

</div>
</form>
<!-- End Content -->
