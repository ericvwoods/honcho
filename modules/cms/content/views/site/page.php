<?php
/*
  Draws a Website page from cms_page() (engine/tg_helpers/cms_helper.php): the one-page menu,
  then each section with the part named after its layout (site/<layout>.php). Included by the
  member home (ccmphome.php) and, later, the public website. Needs $cms; uses the Inspinia
  landing-page styles, and the template's scroll / scrollspy / WOW scripts (templates/views/inspinia.php).
*/
$cms_dir = __DIR__;

// shared bits for the section parts
$cms_head = function($section){ // the heading block most sections start with
    $html = '<div class="row m-b-lg"><div class="col-lg-12 text-center"><div class="navy-line"></div><h1>'.out($section->title).'</h1>';
    if($section->subtitle !== ''){ $html .= '<p>'.out($section->subtitle).'</p>'; }
    return $html.'</div></div>';
};
$cms_text = function($text){ return nl2br(out((string) $text)); }; // Enter = new line
$cms_link = function($url, $label, $class){ // a button or link, or nothing
    if($url === ''){ return ''; }
    return '<a class="'.$class.'" href="'.out($url).'"'.cms_link_attrs($url).'>'.out($label !== '' ? $label : 'Learn more').'</a>';
};
$cms_job_url = function($id) use ($cms){ // a job's detail page on this site
    return BASE_URL.($cms['site'] === 'public' ? 'welcome/job/' : 'cms-content/job/').(int) $id;
};
?>
<style>
    /* Website page additions to the Inspinia landing styles */
    .cms-site section { scroll-margin-top: 70px; }
    .cms-site .header-back { background-size: cover !important; background-position: center !important; }
    .cms-site .header-back.cms-plain { background: linear-gradient(135deg, #1c84c6, #1ab394); }
    .cms-site .carousel-caption h1 { text-shadow: 0 1px 3px rgba(0,0,0,.45); }
    .cms-site .carousel-caption p  { text-shadow: 0 1px 2px rgba(0,0,0,.45); }
    .cms-site .testimonials .carousel { height: auto; } /* the theme fixes landing-page carousels at 470px (made for the slider) */
    .cms-ticker { overflow: hidden; white-space: nowrap; background: #f3f3f4; border-top: 1px solid #e7eaec; border-bottom: 1px solid #e7eaec; padding: 10px 0; }
    .cms-ticker-track { display: inline-block; padding-left: 100%; animation: cms-ticker var(--cms-ticker-time, 30s) linear infinite; }
    .cms-ticker:hover .cms-ticker-track, .cms-ticker:focus-within .cms-ticker-track { animation-play-state: paused; }
    .cms-ticker-item { display: inline-block; margin-right: 60px; font-size: 16px; }
    .cms-ticker-item i { color: #1ab394; margin-right: 6px; }
    @keyframes cms-ticker { from { transform: translateX(0); } to { transform: translateX(-100%); } }
    @media (prefers-reduced-motion: reduce) {
        .cms-ticker { white-space: normal; }
        .cms-ticker-track { animation: none; padding-left: 15px; }
    }
    .cms-site ul.notes { padding: 0; }
    .cms-site ul.notes li div { width: 210px; height: auto; min-height: 170px; }
    .cms-site ul.notes li div.cms-green { background: #d4f5c9; }
    .cms-site ul.notes li div.cms-blue  { background: #cfe8ff; }
    .cms-site ul.notes li div.cms-pink  { background: #ffd6e7; }
    .cms-site ul.notes li div a { position: static; display: inline-block; margin-top: 6px; text-decoration: underline; }
    .cms-sunshine-card { border: 1px solid #e7eaec; border-radius: 4px; padding: 15px; margin-bottom: 20px; background: #fff; height: calc(100% - 20px); }
    .cms-sunshine-card img { width: 90px; height: 90px; object-fit: cover; border-radius: 50%; float: left; margin-right: 15px; }
    .cms-metric { text-align: center; padding: 20px 10px; }
    .cms-metric i { font-size: 34px; color: #1ab394; }
    .cms-metric .cms-metric-value { font-size: 40px; font-weight: 600; line-height: 1.2; }
    .cms-job { border-bottom: 1px solid #e7eaec; padding: 15px 0; }
    .cms-job:last-child { border-bottom: 0; }
    .cms-event { border-left: 4px solid #1ab394; padding: 8px 15px; margin-bottom: 15px; background: #fff; }
    /* FullCalendar 6: undo Inspinia's rules for its old calendar (style.css "FULLCALENDAR": .fc-button, .fc-event...) */
    .cms-site .fc .fc-button { height: auto; line-height: 1.5; overflow: visible; padding: .35em .7em; color: #fff;
                               background-color: #1ab394; border: 1px solid #1ab394; text-transform: none; box-shadow: none; }
    .cms-site .fc .fc-button:hover, .cms-site .fc .fc-button-primary:not(:disabled).fc-button-active,
    .cms-site .fc .fc-button-primary:not(:disabled):active { background-color: #127e68; border-color: #127e68; color: #fff; }
    .cms-site .fc .fc-button:disabled { opacity: .6; }
    .cms-site .fc .fc-toolbar-title { font-size: 20px; white-space: nowrap; margin: 0 .5em; }
    .cms-site .fc .fc-toolbar-chunk { display: flex; align-items: center; gap: .5em; }
    .cms-site .fc .fc-button-group { display: inline-flex; width: auto; }
    .cms-site .fc .fc-button { width: auto; min-width: 0; flex: 0 0 auto; margin: 0; }
    .cms-site .fc .fc-direction-ltr .fc-toolbar > * > :not(:first-child) { margin-left: 0; }
    .cms-site .fc .fc-event { padding: 1px 3px; }
    .cms-site .fc .fc-event-time, .cms-site .fc .fc-event-title { color: inherit; padding: 0 1px; }
    .cms-site .fc .fc-list-event { background-color: transparent; border-color: transparent; padding: 0; }
    .cms-site .fc .fc-event a { background-color: transparent; border-color: transparent; padding: 0; color: inherit; }
    .cms-site .fc .fc-list-event:hover td { background-color: #f5f5f5; }
</style>

<div <?= $cms['site'] === 'member' ? 'id="page-top" ' : '' ?>class="landing-page no-skin-config cms-site"> <!-- the public template's <body> is #page-top -->

    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-expand-md landing-sticky-nav" role="navigation" aria-label="Page sections">
            <div class="container">
                <a class="navbar-brand page-scroll" href="#page-top"><?= out(SHORTSITENAME) ?><?= $cms['site'] === 'member' ? ' '.out(SITENAME4) : '' ?></a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Show the page menu">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                        <?php foreach($cms['menu'] as $m): ?>
                        <li><a class="nav-link page-scroll" href="#<?= out($m['anchor']) ?>"><?= out($m['label']) ?></a></li>
                        <?php endforeach; ?>
                        <?php if($cms['site'] === 'public'): ?>
                        <li class="cms-login"><a class="nav-link" href="<?= BASE_URL ?><?= empty($_SESSION['ccmp_logged_in']) ? 'welcome/login' : 'welcome-ccmps/ccmphome' ?>"><?= empty($_SESSION['ccmp_logged_in']) ? out(CCMP).' Login' : out(CCMP).' Home' ?></a></li>
                        <?php endif; ?>
                        <?php if($cms['site'] === 'member' && empty($_SESSION['mobile_app_view']) && defined('HOTLINK') && !in_array(HOTLINK, array('', '#'), true)): ?> <!-- HOTLINK '#' = no active link -->
                        <li><a class="nav-link" href="<?= HOTLINK ?>"><?= out(HOTLINKLABEL) ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <?php if(empty($cms['sections'])): ?>
        <div class="container" style="padding: 120px 15px 60px;">
            <p class="text-center text-muted" style="font-size: 16px;">Nothing has been put on this page yet.</p>
        </div>
    <?php endif; ?>

    <?php foreach($cms['sections'] as $cms_i => $section): ?>
        <?php
            $cms_file = $cms_dir.'/'.basename($section->layout).'.php';
            if(is_file($cms_file)){
                include($cms_file);
            }
        ?>
    <?php endforeach; ?>

</div>
