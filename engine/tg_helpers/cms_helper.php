<?php
/*
  Website content (module cms) for the pages that show it: the member home (ccmphome) now,
  the public website later. Loaded by engine/ignition.php like the other helpers.

  cms_page($site, $subentity_id)   the sections to draw, in order, each with its content, and the
                                   one-page menu built from them. $site = 'member' or 'public'.
        _cms_items($section_id)
        _cms_posts($kind, $site, $subentity_id)
        _cms_events($site, $subentity_id)
        _cms_metrics()
        _cms_vitals($subentity_id)
        _cms_current_year()
  cms_media_url($file_name)        where a cms_media picture is served
  cms_link_attrs($url)             target/rel for links that leave the site

  Rules (Developer's Guide, Website chapter): a section shows when its show_member (or
  show_public and allow_public) box is ticked AND it has something to show; items need
  active = 1; posts need active = 1, status 'approved', today inside starts_on / ends_on, and subentity_id 0 or
  the member's own chapter (public: is_public = 1 and national or any chapter).
*/

function cms_page(string $site = 'member', int $subentity_id = 0): array {
    $model  = new Model();
    $public = ($site === 'public');

    $where = $public ? 'show_public = 1 AND allow_public = 1' : 'show_member = 1';
    $sections = $model->query("SELECT * FROM cms_sections WHERE $where ORDER BY sort_order, id", 'object');

    $kinds = array('marquee' => 'marquee', 'sunshine' => 'sunshine', 'bulletins' => 'bulletin', 'careers' => 'job');
    $out   = array();
    $menu  = array();
    foreach ((array) $sections as $section) {
        $section->anchor = 'sec-'.$section->code;
        $section->items  = array();
        if (isset($kinds[$section->layout])) {
            $section->items = _cms_posts($kinds[$section->layout], $site, $subentity_id);
        } elseif ($section->layout === 'calendar') {
            $section->items = _cms_events($site, $subentity_id);
        } elseif ($section->layout === 'metrics') {
            $section->items = _cms_metrics();
        } elseif ($section->layout === 'vitals') {
            $section->items = $public ? array() : _cms_vitals($subentity_id);
        } else {
            $section->items = _cms_items((int) $section->id);
        }
        if (empty($section->items)) {
            continue; // nothing to show: no section and no menu link
        }
        $out[] = $section;
        if ($section->menu_label !== '' && $section->layout !== 'marquee') {
            $menu[] = array('label' => $section->menu_label, 'anchor' => $section->anchor);
        }
    }
    return array('sections' => $out, 'menu' => $menu, 'site' => $site);
}

function _cms_items(int $section_id): array {
    $model = new Model();
    $rows  = $model->query_bind("SELECT i.*, m.file_name, m.alt_text FROM cms_items i
                                   LEFT JOIN cms_media m ON m.id = i.media_id
                                  WHERE i.section_id = :sid AND i.active = 1
                                  ORDER BY i.sort_order, i.id", array('sid' => $section_id), 'object');
    foreach ((array) $rows as $row) {
        $row->picture = $row->file_name ? cms_media_url($row->file_name) : '';
    }
    return (array) $rows;
}

function _cms_posts(string $kind, string $site, int $subentity_id): array {
    $model  = new Model();
    $today  = date('Y-m-d');
    $params = array('kind' => $kind, 't1' => $today, 't2' => $today);
    if ($site === 'public') {
        $scope = 'p.is_public = 1';
    } else {
        $scope = '(p.subentity_id = 0 OR p.subentity_id = :sub)';
        $params['sub'] = $subentity_id;
    }
    $rows = $model->query_bind("SELECT p.*, m.file_name, m.alt_text FROM cms_posts p
                                  LEFT JOIN cms_media m ON m.id = p.media_id
                                 WHERE p.kind = :kind AND p.active = 1 AND p.status = 'approved' AND $scope
                                   AND (p.starts_on IS NULL OR p.starts_on <= :t1)
                                   AND (p.ends_on IS NULL OR p.ends_on >= :t2)
                                 ORDER BY p.sort_order, p.id DESC", $params, 'object');
    foreach ((array) $rows as $row) {
        $row->picture = $row->file_name ? cms_media_url($row->file_name) : '';
    }
    return (array) $rows;
}

function _cms_events(string $site, int $subentity_id): array {
    // calendar events from two months back to 18 months ahead. The member home shows every
    // chapter's events (own chapter marked); the public site only the ones ticked Public.
    $model  = new Model();
    $params = array('from' => date('Y-m-d 00:00:00', strtotime('-2 months')), 'to' => date('Y-m-d 23:59:59', strtotime('+18 months')));
    $scope  = ($site === 'public') ? ' AND e.is_public = 1' : '';
    $rows = $model->query_bind("SELECT e.*, m.file_name, m.alt_text,
                                       COALESCE(NULLIF(s.description, ''), s.chapter_title) AS chapter
                                  FROM events e
                                  LEFT JOIN cms_media m ON m.id = e.media_id
                                  LEFT JOIN ccmps_subentities s ON s.id = e.subentity_id
                                 WHERE e.approved = 1 $scope AND e.start_at <= :to AND COALESCE(e.end_at, e.start_at) >= :from
                                 ORDER BY e.start_at LIMIT 1000", $params, 'object');
    foreach ((array) $rows as $row) {
        $row->picture = $row->file_name ? cms_media_url($row->file_name) : '';
        $row->chapter = $row->subentity_id > 0 ? (string) $row->chapter : 'National';
        $row->mine    = ($site !== 'public' && $subentity_id > 0 && (int) $row->subentity_id === $subentity_id);
    }
    return (array) $rows;
}

function _cms_metrics(): array {
    // By the Numbers (member home and public site): current members, chapters and their states, counted fresh
    // (current_year = paid-up year). Renewal and chartered counts were dropped 2026-10-21; Vitals has the renewal numbers.
    $model = new Model();
    $one   = function ($sql, $params = array()) use ($model) {
        $rows = $model->query_bind($sql, $params, 'object');
        return !empty($rows) ? (int) $rows[0]->n : 0;
    };
    $year = _cms_current_year();
    $live = "COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1";
    $metrics = array(
        array('label' => CCMPS,                    'value' => $one("SELECT COUNT(*) AS n FROM ccmps WHERE $live AND current_year >= :y", array('y' => $year)),     'icon' => 'fa-users'),
        array('label' => SUBENTITIES,              'value' => $one("SELECT COUNT(*) AS n FROM ccmps_subentities WHERE active = 1 AND id != :hq", array('hq' => (int) SUBENTITY_NATIONAL_ID)), 'icon' => 'fa-sitemap'),
    );
    // states the active chapters are in (ccmps_subentities.state); left off until at least one is filled in
    $states = $one("SELECT COUNT(DISTINCT state) AS n FROM ccmps_subentities WHERE active = 1 AND id != :hq AND state IS NOT NULL AND state != ''", array('hq' => (int) SUBENTITY_NATIONAL_ID));
    if ($states > 0) {
        $metrics[] = array('label' => 'States', 'value' => $states, 'icon' => 'fa-map-marker');
    }
    return $metrics;
}

function _cms_vitals(int $subentity_id): array {
    // Membership Vitals (member home only): current, past due (paid last year, not this year) and
    // renewal rate = current / (current + past due), for the member's chapter and nationally,
    // then current members by type (ccmps_types). Counted fresh, like _cms_metrics().
    $model = new Model();
    $year  = _cms_current_year();
    $rows  = $model->query_bind("SELECT subentity, ccmp_type, SUM(current_year >= :y1) AS cur, SUM(current_year = :y2) AS due
                                   FROM ccmps
                                  WHERE COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1
                                  GROUP BY subentity, ccmp_type", array('y1' => $year, 'y2' => $year - 1), 'object');
    $types = $model->query("SELECT id, description FROM ccmps_types ORDER BY id", 'object');

    $box = function ($label) { return array('label' => $label, 'current' => 0, 'due' => 0, 'rate' => 0); };
    $national = $box('National');
    $chapter  = null;
    if ($subentity_id > 0) {
        $sub = $model->get_where($subentity_id, 'ccmps_subentities');
        $chapter = $box($sub ? ($sub->description !== '' && $sub->description !== null ? $sub->description : $sub->chapter_title) : SUBENTITY);
    }
    $by_type = array();
    foreach ((array) $types as $t) {
        $by_type[(int) $t->id] = array('label' => $t->description, 'chapter' => 0, 'national' => 0);
    }
    foreach ((array) $rows as $r) {
        $mine = ($chapter !== null && (int) $r->subentity === $subentity_id);
        $national['current'] += (int) $r->cur;
        $national['due']     += (int) $r->due;
        if ($mine) {
            $chapter['current'] += (int) $r->cur;
            $chapter['due']     += (int) $r->due;
        }
        if (isset($by_type[(int) $r->ccmp_type])) {
            $by_type[(int) $r->ccmp_type]['national'] += (int) $r->cur;
            if ($mine) { $by_type[(int) $r->ccmp_type]['chapter'] += (int) $r->cur; }
        }
    }
    $rate = function ($b) { return ($b['current'] + $b['due'] > 0) ? (int) round(100 * $b['current'] / ($b['current'] + $b['due'])) : 0; };
    $national['rate'] = $rate($national);
    if ($chapter !== null) { $chapter['rate'] = $rate($chapter); }
    return array('chapter' => $chapter, 'national' => $national, 'types' => array_values($by_type));
}

function _cms_current_year(): int {
    // the membership year: from the session when logged in, else the same setting login reads
    // (public visitors have no session value)
    if (!empty($_SESSION['ccmps_current_year'])) {
        return (int) $_SESSION['ccmps_current_year'];
    }
    $year = (int) setting('system_current_year', 0);
    return $year > 0 ? $year : (int) date('Y');
}

function cms_media_url(string $file_name): string {
    return BASE_URL.'uploads/cms/'.rawurlencode($file_name);
}

function cms_link_attrs(string $url): string {
    // links to other sites open in a new tab
    return preg_match('~^https?://~i', $url) && strpos($url, BASE_URL) !== 0 ? ' target="_blank" rel="noopener"' : '';
}
