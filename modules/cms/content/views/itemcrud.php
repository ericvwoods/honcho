<?php
  include('navbar.php');
  // only the fields this section's layout uses are shown, with its own labels (Content::_layouts())
  $cms_help = array(
      'icon'     => 'A Font Awesome 4 name, e.g. fa-plane, fa-users, fa-calendar. Find names at fontawesome.com/v4/icons.',
      'link_url' => 'Starts with https://, mailto: or tel:, or / for a page on this site, or # for a section of this page.',
      'body'     => 'Press Enter for a new line.',
  );
?>

<!-- Begin Content -->
<form method="post" action="<?= BASE_URL ?>cms-content/itemsubmit/<?= $recid > 0 ? (int) $recid : '' ?>">
<input type="hidden" name="token" value="<?= $token ?>">
<input type="hidden" name="section_id" value="<?= (int) $section->id ?>">

<div class="ibox-content">

    <p class="text-muted" style="font-size: 15px;"><?= out($section->title) ?>: <?= out($layout_desc) ?>.</p>

    <?php foreach($fields as $field => $label): ?>
    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="<?= $field ?>" style="color:<?= SN_CLR ?>; font-size: 18px;"><?= out($label) ?></label>
        <div class="col-md-7">

        <?php if($field == 'body'): ?>
            <textarea class="form-control" style="font-size: 16px;" name="body" id="body" rows="5"><?= out((string) $body) ?></textarea>

        <?php elseif($field == 'media_id'): ?>
            <input type="hidden" name="media_id" id="media_id" value="<?= (int) $media_id ?: '' ?>">
            <div id="pickedbox" style="margin-bottom: 8px;">
                <img id="pickedimg" src="<?= out($picked_url) ?>" alt="Chosen picture" style="max-width: 260px; max-height: 160px; <?= $picked_url === '' ? 'display: none;' : '' ?>">
                <span id="pickednone" class="text-muted" style="<?= $picked_url === '' ? '' : 'display: none;' ?>">No picture chosen.</span>
            </div>
            <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#pickerModal"><i class="fa fa-picture-o"></i> Choose a Picture</button>
            <button type="button" class="btn btn-outline btn-warning" id="clearpicture"><i class="fa fa-times"></i> No Picture</button>
            <br><small class="text-muted">Pictures come from the <a href="<?= BASE_URL ?>cms-content/media" target="_blank">Pictures page</a> (opens in a new tab; upload there, then reload the list here with the button in the picker).</small>

        <?php elseif($field == 'icon'): ?>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" style="width: 46px; justify-content: center;"><i id="iconpreview" class="fa <?= out((string) $icon) ?>"></i></span></div>
                <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="icon" id="icon" value="<?= out((string) $icon) ?>" maxlength="60" placeholder="fa-plane">
            </div>

        <?php else: ?>
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="<?= $field ?>" id="<?= $field ?>" value="<?= out((string) $$field) ?>"
                   maxlength="<?= array('heading' => 150, 'subheading' => 255, 'link_url' => 255, 'link_label' => 60, 'extra' => 100)[$field] ?? 255 ?>">
        <?php endif; ?>

        <?php if(isset($cms_help[$field])): ?><small class="text-muted"><?= out($cms_help[$field]) ?></small><?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" for="active" style="color:<?= SN_CLR ?>; font-size: 18px;">Shown</label>
        <div class="col-md-7" style="padding-top: 10px;">
            <label style="font-size: 16px;"><input type="checkbox" name="active" id="active" value="1" <?= $active ? 'checked' : '' ?> style="width: 18px; height: 18px;"> Show this item on the page</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary dim" type="submit"><h3><strong><i class="fa fa-save"></i> Save Changes</strong></h3></button>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>cms-content/items/<?= (int) $section->id ?>"><h3><strong><i class="fa fa-times-circle"></i> Cancel</strong></h3></a>
        </div>
    </div>

</div>
</form>

<?php if(isset($fields['media_id'])): ?>
<!-- Picture picker -->
<div class="modal fade" id="pickerModal" tabindex="-1" role="dialog" aria-labelledby="pickerTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="pickerTitle">Choose a Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php if(empty($mediarecs)): ?>
                    <p>There are no pictures yet. <a href="<?= BASE_URL ?>cms-content/media" target="_blank">Upload some on the Pictures page</a>, then save this item and come back, or reload this page.</p>
                <?php else: ?>
                <div class="row">
                    <?php foreach($mediarecs as $m): ?>
                    <div class="col-6 col-md-3" style="margin-bottom: 15px;">
                        <button type="button" class="btn btn-white pickone" style="width: 100%; padding: 4px;" data-id="<?= (int) $m->id ?>" data-url="<?= out($m->url) ?>" title="<?= out($m->alt_text) ?>">
                            <img src="<?= out($m->url) ?>" alt="<?= out($m->alt_text) ?>" style="width: 100%; height: 110px; object-fit: cover;" loading="lazy">
                            <small style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= out($m->alt_text !== '' ? $m->alt_text : $m->original_name) ?></small>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline btn-success" href="<?= BASE_URL ?>cms-content/media" target="_blank"><i class="fa fa-upload"></i> Upload Pictures</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- End Content -->

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var $ = window.jQuery;

        $(document).on('click', '.pickone', function(){
            $('#media_id').val($(this).data('id'));
            $('#pickedimg').attr('src', $(this).data('url')).show();
            $('#pickednone').hide();
            $('#pickerModal').modal('hide');
        });
        $('#clearpicture').on('click', function(){
            $('#media_id').val('');
            $('#pickedimg').hide().attr('src', '');
            $('#pickednone').show();
        });
        $('#icon').on('input', function(){
            var name = $(this).val().trim();
            $('#iconpreview').attr('class', /^fa-[a-z0-9-]+$/.test(name) ? 'fa ' + name : 'fa');
        });
    });
</script>
