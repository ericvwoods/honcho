<?php
  include('navbar.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <form method="post" action="<?= BASE_URL ?>cms-content/uploadmedia" enctype="multipart/form-data" class="form-inline" style="margin-bottom: 15px;">
        <input type="hidden" name="token" value="<?= $token ?>">
        <label for="pictures" style="font-size: 16px; margin-right: 10px;"><strong>Upload pictures:</strong></label>
        <input type="file" name="pictures[]" id="pictures" accept="image/jpeg,image/png,image/gif,image/webp" multiple required style="margin-right: 10px;">
        <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Upload</button>
    </form>
    <p class="text-muted">
        JPEG, PNG, GIF or WebP, up to <?= (int) $max_mb ?> MB each; you can choose several at once. Very wide pictures are made smaller so pages load quickly.
        Give each picture a short <strong>description</strong> (what it shows) - screen readers read it to people who can't see the picture. It saves when you leave the box.
    </p>

    <?php if(empty($mediarecs)): ?>
        <p style="font-size: 16px;"><strong>No pictures yet.</strong></p>
    <?php else: ?>
    <div class="row">
        <?php foreach($mediarecs as $m): ?>
        <div class="col-sm-6 col-md-4 col-lg-3" style="margin-bottom: 20px;">
            <div class="ibox" style="border: 1px solid #e7eaec; margin-bottom: 0;">
                <a href="<?= out($m->url) ?>" target="_blank" title="Open full size">
                    <img src="<?= out($m->url) ?>" alt="<?= out($m->alt_text) ?>" style="width: 100%; height: 170px; object-fit: cover; display: block;" loading="lazy">
                </a>
                <div style="padding: 8px;">
                    <label class="sr-only" for="alt<?= (int) $m->id ?>">Description</label>
                    <input type="text" class="form-control alttext" id="alt<?= (int) $m->id ?>" data-recid="<?= (int) $m->id ?>" value="<?= out($m->alt_text) ?>" maxlength="255" placeholder="What the picture shows">
                    <small class="text-muted" style="display: block; margin-top: 4px;">
                        <?= (int) $m->width ?> &times; <?= (int) $m->height ?> &middot; <?= round($m->bytes / 1024) ?> KB &middot;
                        <?= $m->used > 0 ? 'used '.(int) $m->used.' time'.($m->used == 1 ? '' : 's') : 'not used' ?>
                    </small>
                    <?php if($m->used == 0): ?>
                    <form method="post" action="<?= BASE_URL ?>cms-content/delmedia" style="margin-top: 6px;" onsubmit="return confirm('Delete this picture? This cannot be undone.');">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <input type="hidden" name="recid" value="<?= (int) $m->id ?>">
                        <button class="btn btn-outline btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/sections"><h3><strong><i class="fa fa-list"></i> Page Sections</strong></h3></a>
            <a class="btn btn-primary dim" href="<?= BASE_URL ?><?= $cms_home ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div>
<!-- End Content -->

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var $ = window.jQuery;
        var token = '<?= $token ?>';

        // a description saves when you leave its box, if it changed
        $('.alttext').each(function(){ $(this).data('saved', $(this).val()); });
        $(document).on('blur', '.alttext', function(){
            var box = $(this);
            if(box.val() === box.data('saved')){ return; }
            $.post('<?= BASE_URL ?>cms-content/updatemedia', { token: token, recid: box.data('recid'), alt_text: box.val() }, function(resp){
                $('#cmsmsg').css('color', resp && resp.ok ? 'lightseagreen' : 'crimson').text(resp ? resp.msg : 'Not saved.');
                if(resp && resp.ok){ box.data('saved', box.val()); }
            }, 'json').fail(function(){ $('#cmsmsg').css('color', 'crimson').text('Not saved - please try again.'); });
        });
    });
</script>
