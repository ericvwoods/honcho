<?php
  include('navbar.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <p style="font-size: 15px;">
        These are the sections of the <?= out(CCMP) ?> home page and the public website, top to bottom.
        <strong>Drag a row</strong> to move a section. Tick the boxes to show or hide it on each site; each click saves straight away.
        The <strong>menu label</strong> is the link in the page's top menu that scrolls down to the section (blank = no link).
    </p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="sectiontable">
            <thead>
                <tr>
                    <th style="width: 30px;" aria-label="Drag to reorder"></th>
                    <th style="color:<?= SN_CLR ?>;">Section</th>
                    <th style="color:<?= SN_CLR ?>;">What it shows</th>
                    <th style="color:<?= SN_CLR ?>;">Menu label</th>
                    <th style="color:<?= SN_CLR ?>; text-align: center;"><?= out(CCMP) ?> home</th>
                    <th style="color:<?= SN_CLR ?>; text-align: center;">Public website</th>
                    <th style="color:<?= SN_CLR ?>;">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($sectionrecs as $row): ?>
                <?php $layout = $layouts[$row->layout] ?? array($row->layout, null, ''); ?>
                <tr data-id="<?= (int) $row->id ?>">
                    <td class="draghandle" style="cursor: move; color: #999;" title="Drag to move"><i class="fa fa-bars"></i></td>
                    <td><strong><?= out($row->title) ?></strong><?php if($row->subtitle !== ''): ?><br><small class="text-muted"><?= out($row->subtitle) ?></small><?php endif; ?></td>
                    <td>
                        <?= out($layout[0]) ?>
                        <?php if(empty($layout[1])): ?>
                            <br><small class="text-muted">From <?= out($layout[2]) ?></small>
                        <?php else: ?>
                            <br><small class="text-muted"><?= (int) $row->item_count ?> item<?= $row->item_count == 1 ? '' : 's' ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= out($row->menu_label) ?></td>
                    <td style="text-align: center;">
                        <input type="checkbox" class="sectionbox" data-recid="<?= (int) $row->id ?>" data-field="show_member" <?= $row->show_member ? 'checked' : '' ?>
                               aria-label="Show <?= out($row->title) ?> on the <?= out(CCMP) ?> home" style="width: 20px; height: 20px;">
                    </td>
                    <td style="text-align: center;">
                        <?php if($row->allow_public): ?>
                        <input type="checkbox" class="sectionbox" data-recid="<?= (int) $row->id ?>" data-field="show_public" <?= $row->show_public ? 'checked' : '' ?>
                               aria-label="Show <?= out($row->title) ?> on the public website" style="width: 20px; height: 20px;">
                        <?php else: ?>
                        <small class="text-muted"><?= out(CCMP) ?> home only</small>
                        <?php endif; ?>
                    </td>
                    <td style="white-space: nowrap;">
                        <?php if(!empty($layout[1])): ?>
                        <a class="btn btn-outline btn-success" href="<?= BASE_URL ?>cms-content/items/<?= (int) $row->id ?>"><i class="fa fa-list"></i> Items</a>
                        <?php elseif(!empty($layout[3])): ?>
                        <a class="btn btn-outline btn-success" href="<?= BASE_URL ?>cms-content/posts/<?= $layout[3] ?>"><i class="fa fa-list"></i> Posts</a>
                        <?php endif; ?>
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>cms-content/updatesection/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/media"><h3><strong><i class="fa fa-picture-o"></i> Pictures</strong></h3></a>
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

        // each tick saves one setting
        $(document).on('change', '.sectionbox', function(){
            var box = $(this), value = box.is(':checked') ? 1 : 0;
            box.prop('disabled', true);
            $.post('<?= BASE_URL ?>cms-content/togglesection', {
                token: token, recid: box.data('recid'), field: box.data('field'), value: value
            }, function(resp){
                say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                if(!resp || !resp.ok){ box.prop('checked', !value); }
            }, 'json').fail(function(){
                box.prop('checked', !value);
                say(false, 'Not saved - please try again.');
            }).always(function(){ box.prop('disabled', false); });
        });

        // drag a row to move the section; the new order saves when you let go
        $('#sectiontable tbody').sortable({
            handle: '.draghandle',
            axis: 'y',
            update: function(){
                var ids = $('#sectiontable tbody tr').map(function(){ return $(this).data('id'); }).get();
                $.post('<?= BASE_URL ?>cms-content/ordersections', { token: token, ids: ids }, function(resp){
                    say(resp && resp.ok, resp ? resp.msg : 'Not saved.');
                }, 'json').fail(function(){ say(false, 'The order was not saved - please reload the page.'); });
            }
        });
    });
</script>
