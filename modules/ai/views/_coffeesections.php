<?php
  // The section list of a Coffee Report settings form: position box, on/off, help, and each option
  // (one per line lists, numbers, checkboxes, golf boards). Used by coffeesettings.php and mycoffee.php (2026-10-30).
  // Needs $config (sections) and $catalog (coffee_sections()).
?>
                        <?php foreach($config->sections as $i => $s): $c = $catalog[$s['key']]; ?>
                            <div style="border: 1px solid #e7eaec; border-radius: 6px; padding: 10px 14px; margin-bottom: 10px;">
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <input type="number" class="form-control" name="section_order[<?= $s['key'] ?>]" value="<?= $i + 1 ?>" min="1" max="20" style="width: 70px;" aria-label="Position of <?= out($c['label']) ?>">
                                    <label style="margin: 0; font-size: 17px;"><input type="checkbox" name="section_on[<?= $s['key'] ?>]" value="1"<?= $s['on'] ? ' checked' : '' ?>> <?= out($c['label']) ?></label>
                                </div>
                                <small class="text-muted"><?= out($c['help']) ?></small>
                                <?php $group = null; foreach($c['options'] as $name => $opt): $value = (string) ($s['options'][$name] ?? $opt[1]); $id = 'opt_'.$s['key'].'_'.$name; $type = $opt[2] ?? ''; ?>
                                <?php if(($opt[3] ?? null) !== $group): $group = $opt[3] ?? null; ?>
                                <?php if($group !== null): ?><div style="margin-top: 10px; font-weight: bold; font-size: 15px;"><?= out($group) ?></div><?php endif; ?>
                                <?php endif; ?>
                                <?php if($type === 'check'): // a league: one checkbox (Sports, 2026-10-29) ?>
                                <label style="display: inline-block; margin: 4px 16px 0 0; font-weight: normal; font-size: 15px;">
                                    <input type="checkbox" name="<?= $id ?>" id="<?= $id ?>" value="1"<?= $value === '1' ? ' checked' : '' ?>> <?= out($opt[0]) ?></label>
                                <?php continue; endif; ?>
                                <?php if($type === 'board'): // a golf tour: off or a leaderboard size ?>
                                <div style="display: flex; align-items: center; gap: 10px; margin-top: 4px;">
                                    <label for="<?= $id ?>" style="font-weight: normal; font-size: 15px; margin: 0; min-width: 180px;"><?= out($opt[0]) ?></label>
                                    <select class="form-control" name="<?= $id ?>" id="<?= $id ?>" style="max-width: 200px;">
                                        <?php foreach(array('off' => 'Off', '10' => 'Top 10', '25' => 'Top 25', 'full' => 'Full leaderboard') as $v => $l): ?>
                                        <option value="<?= $v ?>"<?= $value === (string) $v ? ' selected' : '' ?>><?= $l ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php continue; endif; ?>
                                <div style="margin-top: 8px;">
                                    <label for="<?= $id ?>" style="font-weight: normal; font-size: 15px;"><?= out($opt[0]) ?></label>
                                    <?php if(strpos($opt[0], 'one per line') !== false): ?>
                                    <textarea class="form-control" name="<?= $id ?>" id="<?= $id ?>" rows="3"><?= out($value) ?></textarea>
                                    <?php else: ?>
                                    <input type="number" class="form-control" name="<?= $id ?>" id="<?= $id ?>" value="<?= out($value) ?>" min="1" max="168" style="max-width: 120px;">
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
