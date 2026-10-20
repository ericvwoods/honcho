<?php
/* Events calendar (FullCalendar 6, public/js/fullcalendar-6.1.15): month, week and list views; phones open on the
   list. Colours: national, your own chapter, other chapters. Click an event for its details. */
$cms_cal_id = $section->anchor.'-cal';
$cms_events = array();
foreach($section->items as $e){
    $cms_colour = $e->subentity_id == 0 ? '#1ab394' : ($e->mine ? '#1c84c6' : '#8c99a6');
    $cms_ev = array(
        'id'     => (int) $e->id,
        'title'  => (string) $e->title,
        'allDay' => (bool) $e->all_day,
        'start'  => $e->all_day ? substr($e->start_at, 0, 10) : str_replace(' ', 'T', $e->start_at),
        'color'  => $cms_colour,
        'extendedProps' => array(
            'location' => (string) $e->location, 'summary' => (string) $e->summary, 'description' => (string) $e->description,
            'chapter'  => (string) $e->chapter,  'picture' => (string) $e->picture, 'alt' => (string) $e->alt_text,
            'link'     => (string) $e->link_url, 'label'   => (string) $e->link_label,
        ),
    );
    if($e->end_at){ // all-day ends are exclusive in FullCalendar: the day after the last day
        $cms_ev['end'] = $e->all_day ? date('Y-m-d', strtotime(substr($e->end_at, 0, 10).' +1 day')) : str_replace(' ', 'T', $e->end_at);
    }
    $cms_events[] = $cms_ev;
}
?>
<section id="<?= out($section->anchor) ?>" class="features" style="margin-top: 0; padding-top: 50px;">
    <div class="container">
        <?= $cms_head($section) ?>
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <p class="text-center" style="font-size: 13px;">
                    <span style="display: inline-block; width: 12px; height: 12px; background: #1ab394; vertical-align: middle;"></span> National
                    <?php if($cms['site'] === 'member'): ?>
                    &nbsp; <span style="display: inline-block; width: 12px; height: 12px; background: #1c84c6; vertical-align: middle;"></span> Your <?= out(strtolower(SUBENTITY)) ?>
                    &nbsp; <span style="display: inline-block; width: 12px; height: 12px; background: #8c99a6; vertical-align: middle;"></span> Other <?= out(strtolower(SUBENTITIES)) ?>
                    <?php else: ?>
                    &nbsp; <span style="display: inline-block; width: 12px; height: 12px; background: #8c99a6; vertical-align: middle;"></span> <?= out(SUBENTITIES) ?>
                    <?php endif; ?>
                </p>
                <div id="<?= out($cms_cal_id) ?>" aria-label="<?= out($section->title) ?>"></div>
            </div>
        </div>
    </div>
</section>

<!-- Event details -->
<div class="modal fade" id="<?= out($cms_cal_id) ?>-modal" tabindex="-1" role="dialog" aria-labelledby="<?= out($cms_cal_id) ?>-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="<?= out($cms_cal_id) ?>-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img class="cms-ev-pic img-fluid m-b-sm" src="" alt="" style="display: none;">
                <p class="cms-ev-when" style="font-weight: 600;"></p>
                <p class="cms-ev-where text-muted"></p>
                <p class="cms-ev-chapter text-muted"></p>
                <p class="cms-ev-summary"></p>
                <div class="cms-ev-desc" style="white-space: pre-line;"></div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary cms-ev-link" href="#" style="display: none;"></a>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>js/fullcalendar-6.1.15/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        var el = document.getElementById(<?= json_encode($cms_cal_id) ?>);
        if(!el || !window.FullCalendar){ return; }
        var modalId = <?= json_encode($cms_cal_id.'-modal') ?>;
        var narrow  = window.innerWidth < 768;
        var events  = <?= json_encode($cms_events, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        // nothing this month: open on the list of the next 12 months instead of an empty grid
        var now = new Date(), thisMonth = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0');
        var hasThisMonth = events.some(function(e){ return e.start.substring(0, 7) === thisMonth; });
        var calendar = new FullCalendar.Calendar(el, {
            initialView: (narrow || !hasThisMonth) ? 'listUpcoming' : 'dayGridMonth',
            views: { listUpcoming: { type: 'list', duration: { months: 12 }, buttonText: 'Upcoming' } },
            headerToolbar: narrow ? { left: 'prev,next', center: 'title', right: 'today' }
                                  : { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,listUpcoming' },
            buttonText: { today: 'Today', month: 'Month', week: 'Week' },
            height: 'auto',
            dayMaxEvents: 3,
            eventDisplay: 'block', // every event a coloured bar (national / own chapter / other chapters)
            noEventsContent: 'No events this month',
            events: events,
            eventClick: function(info){
                info.jsEvent.preventDefault();
                var ev = info.event, p = ev.extendedProps, m = document.getElementById(modalId);
                var opts = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };
                var when = ev.start.toLocaleDateString(undefined, opts);
                if(!ev.allDay){ when += ', ' + ev.start.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' }); }
                if(ev.end){
                    var last = new Date(ev.end.getTime() - (ev.allDay ? 86400000 : 0));
                    if(last.toDateString() !== ev.start.toDateString()){ when += ' to ' + last.toLocaleDateString(undefined, opts); }
                    else if(!ev.allDay){ when += ' to ' + ev.end.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' }); }
                }
                m.querySelector('.modal-title').textContent = ev.title;
                m.querySelector('.cms-ev-when').textContent = when;
                m.querySelector('.cms-ev-where').textContent = p.location ? 'Where: ' + p.location : '';
                m.querySelector('.cms-ev-chapter').textContent = p.chapter;
                m.querySelector('.cms-ev-summary').textContent = p.summary;
                m.querySelector('.cms-ev-desc').textContent = p.description;
                var pic = m.querySelector('.cms-ev-pic');
                if(p.picture){ pic.src = p.picture; pic.alt = p.alt; pic.style.display = ''; } else { pic.style.display = 'none'; }
                var link = m.querySelector('.cms-ev-link');
                if(p.link){
                    link.href = p.link; link.textContent = p.label || 'More information'; link.style.display = '';
                    if(/^https?:\/\//i.test(p.link)){ link.target = '_blank'; link.rel = 'noopener'; } else { link.removeAttribute('target'); }
                } else { link.style.display = 'none'; }
                window.jQuery(m).modal('show');
            }
        });
        calendar.render();
    });
</script>
