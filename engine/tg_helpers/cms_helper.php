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
  cms_media_url($file_name)        where a cms_media picture is served
  cms_link_attrs($url)             target/rel for links that leave the site

  Rules (Developer's Guide, Website chapter): a section shows when its show_member (or
  show_public and allow_public) box is ticked AND it has something to show; items need
  active = 1; posts need active = 1, today inside starts_on / ends_on, and subentity_id 0 or
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
            $section->items = $public ? array() : _cms_metrics();
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
                                 WHERE p.kind = :kind AND p.active = 1 AND $scope
                                   AND (p.starts_on IS NULL OR p.starts_on <= :t1)
                                   AND (p.ends_on IS NULL OR p.ends_on >= :t2)
                                 ORDER BY p.sort_order, p.id DESC", $params, 'object');
    foreach ((array) $rows as $row) {
        $row->picture = $row->file_name ? cms_media_url($row->file_name) : '';
    }
    return (array) $rows;
}

function _cms_events(string $site, int $subentity_id): array {
    // upcoming events (phase 5 replaces this list with the calendar)
    $model  = new Model();
    $params = array('now' => date('Y-m-d 00:00:00'));
    if ($site === 'public') {
        $scope = 'e.is_public = 1';
    } else {
        $scope = '(e.subentity_id = 0 OR e.subentity_id = :sub)';
        $params['sub'] = $subentity_id;
    }
    $rows = $model->query_bind("SELECT e.* FROM events e
                                 WHERE e.approved = 1 AND $scope AND COALESCE(e.end_at, e.start_at) >= :now
                                 ORDER BY e.start_at LIMIT 12", $params, 'object');
    return (array) $rows;
}

function _cms_metrics(): array {
    // member numbers, counted fresh, the same way ccmphome counts them (current_year = paid-up year)
    $model = new Model();
    $one   = function ($sql, $params = array()) use ($model) {
        $rows = $model->query_bind($sql, $params, 'object');
        return !empty($rows) ? (int) $rows[0]->n : 0;
    };
    $year = (int) ($_SESSION['ccmps_current_year'] ?? date('Y'));
    $live = "COALESCE(deceased,0) != 1 AND COALESCE(soft_deleted,0) != 1";
    return array(
        array('label' => 'Current '.CCMPS,         'value' => $one("SELECT COUNT(*) AS n FROM ccmps WHERE $live AND current_year >= :y", array('y' => $year)),     'icon' => 'fa-users'),
        array('label' => 'Renewal due',            'value' => $one("SELECT COUNT(*) AS n FROM ccmps WHERE $live AND current_year = :y", array('y' => $year - 1)), 'icon' => 'fa-refresh'),
        array('label' => SUBENTITIES,              'value' => $one("SELECT COUNT(*) AS n FROM ccmps_subentities"),                                             'icon' => 'fa-sitemap'),
        array('label' => 'Chartered '.SUBENTITIES, 'value' => $one("SELECT COUNT(*) AS n FROM ccmps_subentities WHERE chartered = 1"),                         'icon' => 'fa-certificate'),
    );
}

function cms_media_url(string $file_name): string {
    return BASE_URL.'uploads/cms/'.rawurlencode($file_name);
}

function cms_link_attrs(string $url): string {
    // links to other sites open in a new tab
    return preg_match('~^https?://~i', $url) && strpos($url, BASE_URL) !== 0 ? ' target="_blank" rel="noopener"' : '';
}
