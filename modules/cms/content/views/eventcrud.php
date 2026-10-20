<?php
  include('navbar.php');
  $cms_label = function($text, $for){ return '<label class="col-md-2 col-form-label" for="'.$for.'" style="color:'.SN_CLR.'; font-size: 18px;">'.out($text).'</label>'; };
  $cms_input = 'class="form-control" style="height: 40px; font-size: 18px;"';
?>

<!-- Begin Content -->
<form method="post" action="<?= BASE_URL ?>cms-content/eventsubmit/<?= $recid > 0 ? (int) $recid : '' ?>">
<input type="hidden" name="token" value="<?= $token ?>">

<div class="ibox-content">

    <div class="form-group row">
        <?= $cms_label('Title', 'title') ?>
        <div class="col-md-7"><input type="text" <?= $cms_input ?> name="title" id="title" value="<?= out((string) $title) ?>" maxlength="150" required></div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Starts', 'start_date') ?>
        <div class="col-md-7 form-inline">
            <input type="date" <?= $cms_input ?> name="start_date" id="start_date" value="<?= out((string) $start_date) ?>" required style="margin-right: 10px;">
            <label class="sr-only" for="start_time">Start time</label>
            <input type="time" <?= $cms_input ?> name="start_time" id="start_time" value="<?= out((string) $start_time) ?>">
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Ends', 'end_date') ?>
        <div class="col-md-7">
            <div class="form-inline">
                <input type="date" <?= $cms_input ?> name="end_date" id="end_date" value="<?= out((string) $end_date) ?>" style="margin-right: 10px;">
                <label class="sr-only" for="end_time">End time</label>
                <input type="time" <?= $cms_input ?> name="end_time" id="end_time" value="<?= out((string) $end_time) ?>">
            </div>
            <small class="text-muted">Optional. Leave the date blank for an event that ends the same day.</small>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <label style="font-size: 16px;"><input type="checkbox" name="all_day" id="all_day" value="1" <?= $all_day ? 'checked' : '' ?> style="width: 18px; height: 18px;"> All day (no times)</label>
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Location', 'location') ?>
        <div class="col-md-7"><input type="text" <?= $cms_input ?> name="location" id="location" value="<?= out((string) $location) ?>" maxlength="150"></div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Short description', 'summary') ?>
        <div class="col-md-7"><textarea class="form-control" style="font-size: 16px;" name="summary" id="summary" rows="2" maxlength="500"><?= out((string) $summary) ?></textarea></div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Full description', 'description') ?>
        <div class="col-md-7"><textarea class="form-control" style="font-size: 16px;" name="description" id="description" rows="6"><?= out((string) $description) ?></textarea></div>
    </div>

    <div class="form-group row">
        <?= $cms_label(SUBENTITY, 'subentity_id') ?>
        <div class="col-md-5">
            <?php if($scope === 'all'): ?>
            <select <?= $cms_input ?> name="subentity_id" id="subentity_id">
                <option value="0">National</option>
                <?php foreach($chapters as $cid => $cname): ?>
                <option value="<?= $cid ?>" <?= (int) $subentity_id === $cid ? 'selected' : '' ?>><?= out($cname) ?></option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
            <p class="form-control-plaintext" style="font-size: 18px;"><?= out($chapters[$scope] ?? '') ?></p>
            <?php endif; ?>
            <small class="text-muted">Whose event it is. Every <?= out(strtolower(CCMP)) ?> sees every event on the calendar.</small>
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Picture', 'media_id') ?>
        <div class="col-md-7">
            <input type="hidden" name="media_id" id="media_id" value="<?= (int) $media_id ?: '' ?>">
            <div style="margin-bottom: 8px;">
                <img id="pickedimg" src="<?= out($picked_url) ?>" alt="Chosen picture" style="max-width: 260px; max-height: 160px; <?= $picked_url === '' ? 'display: none;' : '' ?>">
                <span id="pickednone" class="text-muted" style="<?= $picked_url === '' ? '' : 'display: none;' ?>">No picture chosen.</span>
            </div>
            <button type="button" class="btn btn-outline btn-success" data-toggle="modal" data-target="#pickerModal"><i class="fa fa-picture-o"></i> Choose a Picture</button>
            <button type="button" class="btn btn-outline btn-warning" id="clearpicture"><i class="fa fa-times"></i> No Picture</button>
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Link', 'link_url') ?>
        <div class="col-md-7">
            <input type="text" <?= $cms_input ?> name="link_url" id="link_url" value="<?= out((string) $link_url) ?>" maxlength="255">
            <small class="text-muted">Optional, e.g. the registration page. Starts with https://, mailto: or /.</small>
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label('Button label', 'link_label') ?>
        <div class="col-md-4"><input type="text" <?= $cms_input ?> name="link_label" id="link_label" value="<?= out((string) $link_label) ?>" maxlength="60" placeholder="Register"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <label style="font-size: 16px;"><input type="checkbox" name="is_public" value="1" <?= $is_public ? 'checked' : '' ?> style="width: 18px; height: 18px;"> Public: also show it on the public website's calendar</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary dim" type="submit"><h3><strong><i class="fa fa-save"></i> Save Changes</strong></h3></button>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>cms-content/events"><h3><strong><i class="fa fa-times-circle"></i> Cancel</strong></h3></a>
        </div>
    </div>

</div>
</form>

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
                    <p>There are no pictures yet<?= rbac_allowed('cms', 'manage_content') ? '. <a href="'.BASE_URL.'cms-content/media" target="_blank">Upload some on the Pictures page</a>, then reload this page' : '; ask a Content Admin to upload one' ?>.</p>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
        // all-day events have no times
        function times(){ $('#start_time, #end_time').prop('disabled', $('#all_day').is(':checked')); }
        $('#all_day').on('change', times);
        times();
    });
</script>
