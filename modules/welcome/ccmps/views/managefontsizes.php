<?php
  include('navbar.php');

  $type_labels = [
      'tab'    => 'Tabs',
      'header' => 'Section Headers',
      'label'  => 'Field Labels',
      'value'  => 'Field Values',
      'button' => 'Buttons',
  ];
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-9">
                    <h1 style="color:cornflowerblue;"><i class="fa fa-paint-brush"></i> Display Settings</h1>
                    <p class="text-muted">Size and color for each element type. Size is per-tier (members choose small/medium/large for each element in their own Preferences tab — this controls what those tiers actually mean). Color is module-wide, not a per-member choice — one value applies to everyone. Leave a color blank to use the theme's own default for that element instead of overriding it.</p>
                </div>
                <div class="col-md-3">
                    <br>
                    <a class="btn btn-outline btn-warning" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">
                        <i class="fa fa-times-circle"></i> Close
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<form method="post" action="<?= BASE_URL ?>welcome-ccmps/savefontsizesettings">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">

                <?php foreach ($grouped_settings as $type => $rows): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><?= htmlspecialchars($type_labels[$type] ?? ucfirst($type)) ?></h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 25px;">
                        <?php foreach ($rows as $row): ?>
                            <?php if ($row->title === 'color'): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?= htmlspecialchars($row->description) ?></label>
                                        <input type="text" class="form-control" name="px[<?= $row->id ?>]" value="<?= htmlspecialchars($row->settingvalue) ?>" placeholder="e.g. #1ab394 — leave blank for theme default">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted">Notes</label>
                                        <textarea class="form-control" name="notes[<?= $row->id ?>]" rows="2" placeholder="Optional — admin-facing reminder about this setting"><?= htmlspecialchars($row->notes ?? '') ?></textarea>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?= htmlspecialchars($row->description) ?> (<?= htmlspecialchars($row->title) ?>)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="px[<?= $row->id ?>]" value="<?= htmlspecialchars($row->settingvalue) ?>" min="1" max="72">
                                            <span class="input-group-addon">px</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted">Notes</label>
                                        <textarea class="form-control" name="notes[<?= $row->id ?>]" rows="2" placeholder="Optional — admin-facing reminder about this setting"><?= htmlspecialchars($row->notes ?? '') ?></textarea>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Changes
                        </button>
                        <a class="btn btn-white" href="<?= BASE_URL ?>welcome-ccmps/ccmphome">Cancel</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<?php if (DEBUGGING == true): ?>
    <?php
        echo('<h3>View: welcome-ccmps/views/managefontsizes</h3>');
        echo('<h3>$_SESSION</h3>');
        json($_SESSION);
    ?>
<?php endif; ?>
