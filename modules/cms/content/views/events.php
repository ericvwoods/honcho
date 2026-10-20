<?php
  include('navbar.php');
?>

<!-- Begin Content -->
<div class="ibox-content">

    <p style="font-size: 15px;">
        Events show on the Events Calendar on the <?= out(CCMP) ?> home page<?= $scope_name !== '' ? ' (yours are marked with your '.out(strtolower(SUBENTITY)).'\'s name)' : '' ?>.
        Tick <strong>Public</strong> on an event to also show it on the public website's calendar.
        <?php if($past): ?><a href="<?= BASE_URL ?>cms-content/events">Show upcoming events</a><?php else: ?><a href="<?= BASE_URL ?>cms-content/events/past">Show past events</a><?php endif; ?>
    </p>

    <?php if(empty($eventrecs)): ?>
        <p style="font-size: 16px;"><strong>No <?= $past ? 'past' : 'upcoming' ?> events.</strong></p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="color:<?= SN_CLR ?>;">When</th>
                    <th style="color:<?= SN_CLR ?>;">Event</th>
                    <th style="color:<?= SN_CLR ?>;"><?= out(SUBENTITY) ?></th>
                    <th style="color:<?= SN_CLR ?>; text-align: center;">Public</th>
                    <th style="color:<?= SN_CLR ?>;">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($eventrecs as $row): ?>
                <?php $cms_s = strtotime($row->start_at); $cms_e = $row->end_at ? strtotime($row->end_at) : null; ?>
                <tr>
                    <td style="white-space: nowrap;">
                        <?= out(date('D M j, Y', $cms_s)) ?><?= $row->all_day ? '' : '<br><small>'.out(date('g:i a', $cms_s)).'</small>' ?>
                        <?php if($cms_e && date('Y-m-d', $cms_e) !== date('Y-m-d', $cms_s)): ?><br><small class="text-muted">to <?= out(date('D M j', $cms_e)) ?></small><?php endif; ?>
                    </td>
                    <td><strong><?= out($row->title) ?></strong><?php if($row->location !== ''): ?><br><small class="text-muted"><i class="fa fa-map-marker"></i> <?= out($row->location) ?></small><?php endif; ?></td>
                    <td><?= out($row->chapter) ?></td>
                    <td style="text-align: center;"><?= $row->is_public ? '<i class="fa fa-check" title="Also on the public website"></i>' : '' ?></td>
                    <td style="white-space: nowrap;">
                        <a class="btn btn-outline btn-primary" href="<?= BASE_URL ?>cms-content/updateevent/<?= (int) $row->id ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <form method="post" action="<?= BASE_URL ?>cms-content/delevent" style="display: inline;" onsubmit="return confirm('Delete this event? This cannot be undone.');">
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
            <a class="btn btn-outline btn-primary dim" href="<?= BASE_URL ?>cms-content/createevent"><h3><strong><i class="fa fa-calendar-plus-o"></i> Add an Event</strong></h3></a>
            <a class="btn btn-primary dim" href="<?= BASE_URL ?><?= $cms_home ?>"><h3><strong><i class="fa fa-times-circle"></i> Close</strong></h3></a>
        </div>
    </div>

</div>
<!-- End Content -->
