<?php
  include('navbar.php');
  // the first two text fields this layout uses label the list's columns
  $cms_cols = array_values(array_intersect(array('heading', 'subheading', 'body', 'extra'), array_keys($fields)));
  $cms_cols = array_slice($cms_cols, 0, 2);
?>

<!-- Begin Content -->
<div class="ibox-content">

    <p style="font-size: 15px;">
        <?= out($layout_desc) ?>. <strong>Drag a row</strong> to change the order. Untick <strong>Shown</strong> to hide an item without deleting it.
    </p>

    <?php if(empty($itemrecs)): ?>
        <p style="font-size: 16px;"><strong>No items yet.</strong> Use <em>Add an Item</em> below.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="itemtable">
            <thead>
                <tr>
                    <th style="width: 30px;" aria-label="Drag to reorder"></th>
                    <?php if(isset($fields['media_id'])): ?><th style="color:<?= SN_CLR ?>;"><?= out($fields['media_id']) ?></th><?php endif; ?>
                    <?php foreach($cms_cols as $col): ?><th style="color:<?= SN_CLR ?>;"><?= out($fields[$col]) ?></th><?php endforeach; ?>
                    <th style="color:<?= SN_CLR ?>; text-align: center;">Shown</th>
                    <th style="color:<?= SN_CLR ?>;">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($itemrecs as $row): ?>
                <tr data-id="<?= (int) $row->id ?>">
                    <td class="draghandle" style="cursor: move; color: #999;" title="Drag to move"><i class="fa fa-bars"></i></td>
                    <?php if(isset($fields['media_id'])): ?>
                    <td style="width: 110px;">
                        <?php if($row->picture !== ''): ?><img src="<?= out($row->picture) ?>" alt="<?= out($row->alt_text) ?>" style="max-width: 100px; max-height: 70px;"><?php else: ?><small class="text-muted">None</small><?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <?php foreach($cms_cols as $col): ?>
                    <td><?= out(mb_strimwidth((string) $row->$col, 0, 120, '...')) ?></td>
                    <?php endforeach; ?>
                    <td style="text-align: center;">
                        <input type="checkbox" class="itembox" data-recid="<?= (int) $row->id ?>" <?= $row->active ? 'checked' : '' ?> aria-label="Show this item" style="width: 20px; height: 20px;">
                    </td>
                    <td style="white-space: nowrap;">
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>cms-content/updateitem/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <form method="post" action="<?= BASE_URL ?>cms-content/delitem" style="display: inline;" onsubmit="return confirm('Delete this item? This cannot be undone.');">
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
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/createitem/<?= (int) $section->id ?>"><h3><strong><i class="fa fa-clone"></i> Add an Item</strong></h3></a>
            <a class="btn btn-primary dim" href="<?= BASE_URL ?>cms-content/sections"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
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

        $(document).on('change', '.itembox', function(){
            var box = $(this), value = box.is(':checked') ? 1 : 0;
            box.prop('disabled', true);
            $.post('<?= BASE_URL ?>cms-content/toggleitem', { token: token, recid: box.data('recid'), value: value }, function(resp){
                say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                if(!resp || !resp.ok){ box.prop('checked', !value); }
            }, 'json').fail(function(){
                box.prop('checked', !value);
                say(false, 'Not saved - please try again.');
            }).always(function(){ box.prop('disabled', false); });
        });

        $('#itemtable tbody').sortable({
            handle: '.draghandle',
            axis: 'y',
            update: function(){
                var ids = $('#itemtable tbody tr').map(function(){ return $(this).data('id'); }).get();
                $.post('<?= BASE_URL ?>cms-content/orderitems', { token: token, ids: ids }, function(resp){
                    say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                }, 'json').fail(function(){ say(false, 'The order was not saved - please reload the page.'); });
            }
        });
    });
</script>
