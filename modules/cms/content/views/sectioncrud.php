<?php
  include('navbar.php');
?>

<!-- Begin Content -->
<form method="post" action="<?= BASE_URL ?>cms-content/sectionsubmit/<?= (int) $id ?>">
<input type="hidden" name="token" value="<?= $token ?>">

<div class="ibox-content">

    <p class="text-muted" style="font-size: 15px;"><?= out($layout_desc) ?>. Show or hide it, and change its place on the page, on the Page Sections list.</p>

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
