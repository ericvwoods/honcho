<?php
  $rbac_tab = 'privileges';
  include('pagehead.php');
?>

<!-- Begin Content -->
<div class="ibox-content">
    <form action="<?= BASE_URL ?>system-rbac/privilegessubmit" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input type="hidden" name="group_id" value="<?= $group->id ?>">

        <p>Tick what people in <strong><?= out($group->title) ?></strong> may do, then <strong>Save</strong>.
           Only switched-on modules are listed.</p>

        <?php if(empty($modules)): ?>
            <p class="text-muted">No functions are set up yet.</p>
        <?php endif; ?>

        <div class="row">
        <?php foreach($modules as $mcode => $module) { ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?= out($module['title']) ?></strong>
                        <label class="pull-right" style="font-weight:normal;">
                            <input type="checkbox" class="selectall" data-module="<?= out($mcode) ?>"> Select all
                        </label>
                    </div>
                    <div class="panel-body">
                        <?php foreach($module['functions'] as $f) { ?>
                        <div class="checkbox" style="margin-top:2px; margin-bottom:2px;">
                            <label title="<?= out($f->description) ?>">
                                <input type="checkbox" class="fnbox fn-<?= out($mcode) ?>" name="functions[]" value="<?= $f->id ?>"
                                       <?= isset($ticked[$f->id]) ? 'checked' : '' ?>>
                                <?= out($f->title) ?> <span class="text-muted" style="font-size:11px;">(<?= out($f->code) ?>)</span>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>

        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
        <a class="btn btn-white" href="<?= BASE_URL ?>system-rbac/manage">Back to groups</a>
    </form>
</div>
<!-- End Content -->
<br>

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function(){
        // "Select all" per module; it shows ticked when every box in the module is ticked
        function syncAll(mod){
            var boxes = $('.fn-' + mod);
            $('.selectall[data-module="' + mod + '"]').prop('checked', boxes.length > 0 && boxes.filter(':checked').length == boxes.length);
        }
        $('.selectall').each(function(){ syncAll($(this).data('module')); });
        $(document).on('change', '.selectall', function(){
            $('.fn-' + $(this).data('module')).prop('checked', $(this).is(':checked'));
        });
        $(document).on('change', '.fnbox', function(){
            var cls = $.grep(this.className.split(' '), function(c){ return c.indexOf('fn-') == 0; })[0];
            if(cls){ syncAll(cls.substring(3)); }
        });
    });
</script>
