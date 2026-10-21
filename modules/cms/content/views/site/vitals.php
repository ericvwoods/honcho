<?php /* Membership Vitals: the member's chapter and national numbers, counted when the page opens
            (member home only, _cms_vitals() in cms_helper.php). Replaced the hardcoded block in ccmphome.php. */
$v = $section->items;
$v_boxes = array_filter(array($v['chapter'], $v['national']));
?>
<section id="<?= out($section->anchor) ?>" style="margin-top: 0; padding: 50px 0;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <?php foreach($v_boxes as $b): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="cms-vital">
                    <div class="cms-vital-label"><?= out($b['label']) ?> <?= out(CCMPS) ?></div>
                    <div class="cms-metric-value"><?= number_format((int) $b['current']) ?></div>
                    <div><strong class="text-navy"><?= (int) $b['rate'] ?>%</strong> renewal rate</div>
                    <small class="text-muted"><?= number_format((int) $b['due']) ?> past due</small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if(!empty($v['types'])): ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table table-striped m-t-md">
                    <caption class="sr-only">Current <?= out(CCMPS) ?> by type</caption>
                    <thead>
                        <tr>
                            <th scope="col">Current <?= out(CCMPS) ?> by type</th>
                            <?php if($v['chapter'] !== null): ?><th scope="col" class="text-right"><?= out($v['chapter']['label']) ?></th><?php endif; ?>
                            <th scope="col" class="text-right">National</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($v['types'] as $t): ?>
                        <tr>
                            <th scope="row" style="font-weight: normal;"><?= out($t['label']) ?></th>
                            <?php if($v['chapter'] !== null): ?><td class="text-right"><?= number_format((int) $t['chapter']) ?></td><?php endif; ?>
                            <td class="text-right"><?= number_format((int) $t['national']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
