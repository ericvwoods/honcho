<?php
  include('navbar.php');
  $cms_sticky = array('yellow' => '#fff7b3', 'green' => '#d4f5c9', 'blue' => '#cfe8ff', 'pink' => '#ffd6e7');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <p style="font-size: 15px;">
        <?= out($k['about']) ?> <strong>Drag a row</strong> to change the order (new posts start at the top).
        Untick <strong>Shown</strong> to take a post down without deleting it; posts also come and go on their own with their dates.
    </p>

    <?php if(empty($postrecs)): ?>
        <p style="font-size: 16px;"><strong>Nothing posted yet.</strong> Use <em>Add</em> below.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="posttable">
            <thead>
                <tr>
                    <th style="width: 30px;" aria-label="Drag to reorder"></th>
                    <?php if(isset($k['fields']['media_id'])): ?><th style="color:<?= SN_CLR ?>;">Picture</th><?php endif; ?>
                    <th style="color:<?= SN_CLR ?>;"><?= out($k['fields']['title']) ?></th>
                    <th style="color:<?= SN_CLR ?>;"><?= out(SUBENTITY) ?></th>
                    <th style="color:<?= SN_CLR ?>;">Today</th>
                    <th style="color:<?= SN_CLR ?>; text-align: center;">Public</th>
                    <th style="color:<?= SN_CLR ?>; text-align: center;">Shown</th>
                    <th style="color:<?= SN_CLR ?>;">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($postrecs as $row): ?>
                <tr data-id="<?= (int) $row->id ?>">
                    <td class="draghandle" style="cursor: move; color: #999;" title="Drag to move"><i class="fa fa-bars"></i></td>
                    <?php if(isset($k['fields']['media_id'])): ?>
                    <td style="width: 90px;"><?php if($row->picture !== ''): ?><img src="<?= out($row->picture) ?>" alt="<?= out($row->alt_text) ?>" style="max-width: 80px; max-height: 60px;"><?php endif; ?></td>
                    <?php endif; ?>
                    <td>
                        <?php if($kind == 'bulletin'): ?><span style="display: inline-block; width: 14px; height: 14px; background: <?= $cms_sticky[$row->color] ?? $cms_sticky['yellow'] ?>; border: 1px solid #ccc; vertical-align: middle;"></span><?php endif; ?>
                        <strong><?= out($row->title) ?></strong>
                        <?php if($row->summary !== ''): ?><br><small class="text-muted"><?= out(mb_strimwidth($row->summary, 0, 140, '...')) ?></small><?php endif; ?>
                    </td>
                    <td><?= out($row->chapter) ?></td>
                    <td><?= out($row->status) ?></td>
                    <td style="text-align: center;"><?= $row->is_public ? '<i class="fa fa-check" title="May show on the public website"></i>' : '' ?></td>
                    <td style="text-align: center;">
                        <input type="checkbox" class="postbox" data-recid="<?= (int) $row->id ?>" <?= $row->active ? 'checked' : '' ?> aria-label="Show this post" style="width: 20px; height: 20px;">
                    </td>
                    <td style="white-space: nowrap;">
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>cms-content/updatepost/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <form method="post" action="<?= BASE_URL ?>cms-content/delpost" style="display: inline;" onsubmit="return confirm('Delete this post? This cannot be undone.');">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <input type="hidden" name="recid" value="<?= (int) $row->id ?>">
                            <button class="btn btn-outline btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/createpost/<?= out($kind) ?>"><h3><strong><i class="fa <?= $k['icon'] ?>"></i> Add <?= out($k['one']) ?></strong></h3></a>
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/sections"><h3><strong><i class="fa fa-list"></i> Page Sections</strong></h3></a>
            <a class="btn btn-primary dim" href="<?= BASE_URL ?><?= $cms_home ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div>
<!-- End Content -->

<script>
    // the template loads jQuery and jQuery UI after this view, so wait for the page to finish
    document.addEventListener('DOMContentLoaded', function(){
        var $ = window.jQuery;
        var token = '<?= $token ?>';

        function say(ok, msg){
            $('#cmsmsg').css('color', ok ? 'lightseagreen' : 'crimson').text(msg);
        }

        $(document).on('change', '.postbox', function(){
            var box = $(this), value = box.is(':checked') ? 1 : 0;
            box.prop('disabled', true);
            $.post('<?= BASE_URL ?>cms-content/togglepost', { token: token, recid: box.data('recid'), value: value }, function(resp){
                say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                if(!resp || !resp.ok){ box.prop('checked', !value); }
            }, 'json').fail(function(){
                box.prop('checked', !value);
                say(false, 'Not saved - please try again.');
            }).always(function(){ box.prop('disabled', false); });
        });

        $('#posttable tbody').sortable({
            handle: '.draghandle',
            axis: 'y',
            update: function(){
                var ids = $('#posttable tbody tr').map(function(){ return $(this).data('id'); }).get();
                $.post('<?= BASE_URL ?>cms-content/orderposts', { token: token, ids: ids }, function(resp){
                    say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                }, 'json').fail(function(){ say(false, 'The order was not saved - please reload the page.'); });
            }
        });
    });
</script>
