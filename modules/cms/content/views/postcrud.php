<?php
  include('navbar.php');
  $f = $k['fields']; // the fields this kind of post uses, with its labels (Content::_kinds())
  $cms_label = function($text, $for){ return '<label class="col-md-2 col-form-label" for="'.$for.'" style="color:'.SN_CLR.'; font-size: 18px;">'.out($text).'</label>'; };
?>

<!-- Begin Content -->
<form method="post" action="<?= BASE_URL ?>cms-content/postsubmit/<?= $recid > 0 ? (int) $recid : '' ?>">
<input type="hidden" name="token" value="<?= $token ?>">
<input type="hidden" name="kind" value="<?= out($kind) ?>">

<div class="ibox-content">

    <p class="text-muted" style="font-size: 15px;"><?= out($k['about']) ?></p>

    <div class="form-group row">
        <?= $cms_label($f['title'], 'title') ?>
        <div class="col-md-7">
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="title" id="title" value="<?= out((string) $title) ?>" maxlength="150" required>
        </div>
    </div>

    <?php if(isset($f['location'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['location'], 'location') ?>
        <div class="col-md-7"><input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="location" id="location" value="<?= out((string) $location) ?>" maxlength="150"></div>
    </div>
    <?php endif; ?>

    <?php if(isset($f['summary'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['summary'], 'summary') ?>
        <div class="col-md-7"><textarea class="form-control" style="font-size: 16px;" name="summary" id="summary" rows="3" maxlength="500"><?= out((string) $summary) ?></textarea></div>
    </div>
    <?php endif; ?>

    <?php if(isset($f['body'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['body'], 'body') ?>
        <div class="col-md-7">
            <textarea class="form-control" style="font-size: 16px;" name="body" id="body" rows="8"><?= out((string) $body) ?></textarea>
            <small class="text-muted">Press Enter for a new line; leave a blank line between paragraphs.</small>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($f['color'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['color'], 'color') ?>
        <div class="col-md-3">
            <select class="form-control" style="height: 40px; font-size: 18px;" name="color" id="color">
                <?php foreach($colors as $value => $name): ?>
                <option value="<?= $value ?>" <?= $color == $value ? 'selected' : '' ?>><?= $name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($f['media_id'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['media_id'], 'media_id') ?>
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
    <?php endif; ?>

    <div class="form-group row">
        <?= $cms_label($f['link_url'], 'link_url') ?>
        <div class="col-md-7">
            <input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="link_url" id="link_url" value="<?= out((string) $link_url) ?>" maxlength="255">
            <small class="text-muted">Optional. Starts with https://, mailto: or tel:, or / for a page on this site.</small>
        </div>
    </div>

    <?php if(isset($f['link_label'])): ?>
    <div class="form-group row">
        <?= $cms_label($f['link_label'], 'link_label') ?>
        <div class="col-md-4"><input type="text" class="form-control" style="height: 40px; font-size: 18px;" name="link_label" id="link_label" value="<?= out((string) $link_label) ?>" maxlength="60"></div>
    </div>
    <?php endif; ?>

    <div class="form-group row">
        <?= $cms_label($f['subentity_id'], 'subentity_id') ?>
        <div class="col-md-5">
            <select class="form-control" style="height: 40px; font-size: 18px;" name="subentity_id" id="subentity_id">
                <option value="0">All <?= out(CCMPS) ?></option>
                <?php foreach($chapters as $cid => $cname): ?>
                <option value="<?= $cid ?>" <?= (int) $subentity_id === $cid ? 'selected' : '' ?>><?= out($cname) ?></option>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">Choose <?= $role === 'content' ? 'a '.out(strtolower(SUBENTITY)) : 'your '.out(strtolower(SUBENTITY)) ?> to show it to that <?= out(strtolower(SUBENTITY)) ?>'s <?= out(strtolower(CCMPS)) ?> only.</small>
        </div>
    </div>

    <div class="form-group row">
        <?= $cms_label($f['dates'], 'starts_on') ?>
        <div class="col-md-7">
            <div class="form-inline">
                <label for="starts_on" style="margin-right: 6px;">from</label>
                <input type="date" class="form-control" style="height: 40px; font-size: 16px; margin-right: 12px;" name="starts_on" id="starts_on" value="<?= out((string) $starts_on) ?>">
                <label for="ends_on" style="margin-right: 6px;">until</label>
                <input type="date" class="form-control" style="height: 40px; font-size: 16px;" name="ends_on" id="ends_on" value="<?= out((string) $ends_on) ?>">
            </div>
            <small class="text-muted">Both optional: blank "from" means now, blank "until" means it stays up until you take it down.</small>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 col-form-label" style="color:<?= SN_CLR ?>; font-size: 18px;">Show</label>
        <div class="col-md-7" style="padding-top: 8px;">
            <label style="font-size: 16px; display: block;"><input type="checkbox" name="active" value="1" <?= $active ? 'checked' : '' ?> style="width: 18px; height: 18px;"> Shown</label>
            <?php if($can_public): ?>
            <label style="font-size: 16px; display: block;"><input type="checkbox" name="is_public" value="1" <?= $is_public ? 'checked' : '' ?> style="width: 18px; height: 18px;"> Also on the public website (when its section is shown there)</label>
            <?php endif; ?>
        </div>
    </div>

    <?php if($can_moderate): ?>
    <div class="form-group row">
        <?= $cms_label('Approval', 'status') ?>
        <div class="col-md-3">
            <select class="form-control" style="height: 40px; font-size: 18px;" name="status" id="status">
                <?php foreach($statuses as $value => $name): ?>
                <option value="<?= $value ?>" <?= $status === $value ? 'selected' : '' ?>><?= $name ?></option>
                <?php endforeach; ?>
            </select>
            <small class="text-muted">Only approved posts show on the Bulletin Board.</small>
        </div>
    </div>
    <?php elseif($kind === 'bulletin' && $status !== 'approved'): ?>
    <div class="form-group row">
        <label class="col-md-2 col-form-label" style="color:<?= SN_CLR ?>; font-size: 18px;">Approval</label>
        <div class="col-md-7" style="padding-top: 8px; font-size: 16px;">
            <?= $status === 'pending' ? 'Waiting for approval.' : 'Disapproved. If you change it and save, it goes back for approval.' ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary dim" type="submit"><h3><strong><i class="fa fa-save"></i> Save Changes</strong></h3></button>
            <a class="btn btn-outline btn-warning dim" href="<?= BASE_URL ?>cms-content/posts/<?= out($kind) ?>"><h3><strong><i class="fa fa-times-circle"></i> Cancel</strong></h3></a>
        </div>
    </div>

</div>
</form>

<?php if(isset($f['media_id'])): ?>
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
                    <p>There are no pictures yet.<?php if($role === 'content'): ?> <a href="<?= BASE_URL ?>cms-content/media" target="_blank">Upload some on the Pictures page</a>, then reload this page.<?php else: ?> The content admins add pictures to the library.<?php endif; ?></p>
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
                <?php if($role === 'content'): ?><a class="btn btn-outline btn-success" href="<?= BASE_URL ?>cms-content/media" target="_blank"><i class="fa fa-upload"></i> Upload Pictures</a><?php endif; ?>
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
    });
</script>
