<?php

/*----------------------------------------------------------------------------*/
/*----------------------------- module HELP ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  Help (2026-10-29): the three guides as web pages, from the same chapter files as
  the Word guides. Each guide's docs/<guide>/generate.js writes content/<key>.json
  (docs/export-web.js); this module only reads and renders those files, so the web
  and Word versions can't disagree. Who sees which guide:
      member     every logged-in person
      admin      anyone with an admin role, and staff
      developer  member System Admins and staff system admins
  Replaces the hand-kept CCMPS help page (welcome-ccmps/helpdocs now redirects here).

  __construct()                     logged in
  index()                           the guides this person may read
        _allowed()
  guide($key, $chapter)             one chapter: contents on the left, the chapter's sections
        _allowed(), _load($key), _render_blocks()
  search()                          ?q=: matching sections across the allowed guides
        _allowed(), _load(), _plain()
  _allowed()                        key => title
  _is_admin(), _is_developer()
  _load($key)                       the decoded JSON, or null
  _render_blocks($blocks)           blocks -> HTML (escaped; **bold**, `code`, _italic_)
  _inline($text)
  _plain($blocks)                   text only, for search
  _font_px()                        the member's Values text size (Font pop-up)
  _home_url()
  _return_url($home)                the page the person came from, kept while they stay in Help
*/

class Help extends Trongate {

    function __construct(?string $module_name = null){
        parent::__construct($module_name);
        if(strcasecmp(segment(1), 'help') !== 0){
            return; // used by another module, not visited as a page
        }
        if(empty($_SESSION['trongatetoken'])){
            set_flashdata('Your Session has expired - please login again.');
            redirect('welcome/logout');
        }
    }

/*----------------------------------------------------------------------------*/
/*----------------------------- function INDEX -------------------------------*/
/*----------------------------------------------------------------------------*/
  function index(){

    $guides = array();
    foreach($this->_allowed() as $key => $title){
        $g = $this->_load($key);
        if($g){
            $guides[] = (object) array('key' => $key, 'title' => $g->title, 'subtitle' => $g->subtitle, 'generated' => $g->generated,
                                       'chapters' => $g->chapters);
        }
    }
    $data['guides']      = $guides;
    $data['q']           = '';
    $data['font_px']     = $this->_font_px();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($data['home_url']); // Close goes back where they came from
    $data['bc1']         = 'Help';
    $data['bc2']         = 'Guides';
    $data['header']      = 'Help';
    $data['view_module'] = 'help';
    $data['view_file']   = 'index';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function GUIDE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function guide($key = NULL, $chapter = NULL){

    $key     = (string) ($key ?? segment(3));
    $chapter = (int) ($chapter ?? segment(4));
    $allowed = $this->_allowed();
    if(!isset($allowed[$key])){
        set_flashdata('That guide is for admins only.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('help');
    }
    $g = $this->_load($key);
    if(!$g || empty($g->chapters)){
        set_flashdata('That guide isn\'t available yet.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('help');
    }
    $chapter = max(1, min(count($g->chapters), $chapter ?: 1));
    $c = $g->chapters[$chapter - 1];

    $sections = array();
    foreach($c->sections as $s){
        $sections[] = (object) array('tab' => $s->tab, 'slug' => $s->slug, 'html' => $this->_render_blocks($s->blocks));
    }

    $data['guide']       = $g;
    $data['key']         = $key;
    $data['chapter']     = $c;
    $data['sections']    = $sections;
    $data['prev']        = $chapter > 1 ? $g->chapters[$chapter - 2] : null;
    $data['next']        = $chapter < count($g->chapters) ? $g->chapters[$chapter] : null;
    $data['q']           = '';
    $data['font_px']     = $this->_font_px();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($data['home_url']); // Close goes back where they came from
    $data['bc1']         = 'Help';
    $data['bc2']         = $g->title;
    $data['header']      = $g->title;
    $data['view_module'] = 'help';
    $data['view_file']   = 'guide';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function SEARCH ------------------------------*/
/*----------------------------------------------------------------------------*/
  function search(){

    $q = trim(substr((string) ($_GET['q'] ?? ''), 0, 100));
    $results = array();
    if(strlen($q) >= 2){
        $words = array_filter(preg_split('/\s+/', strtolower($q)));
        foreach($this->_allowed() as $key => $title){
            $g = $this->_load($key);
            if(!$g){ continue; }
            foreach($g->chapters as $c){
                foreach($c->sections as $s){
                    $text  = $this->_plain($s->blocks);
                    $hay   = strtolower($c->title.' '.$s->tab.' '.$text);
                    $score = 0;
                    foreach($words as $w){
                        if(strpos($hay, $w) === false){ continue 2; } // every word must appear
                        $score += substr_count($hay, $w) + (stripos($s->tab.' '.$c->title, $w) !== false ? 5 : 0);
                    }
                    $pos  = stripos($text, reset($words));
                    $snip = $pos === false ? substr($text, 0, 180) : substr($text, max(0, $pos - 70), 200);
                    $results[] = (object) array('guide' => $g->title, 'key' => $key, 'num' => $c->num, 'chapter' => $c->title,
                                                'tab' => $s->tab, 'slug' => $s->slug, 'snippet' => trim($snip), 'score' => $score);
                }
            }
        }
        usort($results, function($a, $b){ return $b->score <=> $a->score; });
        $results = array_slice($results, 0, 40);
    }

    $data['results']     = $results;
    $data['q']           = $q;
    $data['font_px']     = $this->_font_px();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($data['home_url']); // Close goes back where they came from
    $data['bc1']         = 'Help';
    $data['bc2']         = 'Search';
    $data['header']      = 'Help: search';
    $data['view_module'] = 'help';
    $data['view_file']   = 'search';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _allowed(){
        $keys = array('member' => 'Member Guide');
        if($this->_is_admin()){ $keys['admin'] = 'Administrator\'s Guide'; }
        if($this->_is_developer()){ $keys['developer'] = 'Developer\'s Guide'; }
        return $keys;
    }

    function _is_admin(){ // the same test as the EMS side menu, plus staff
        return !empty($_SESSION['honcho_logged_in']) || !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_admin'])
            || !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_student_admin'])
            || rbac_allowed('cms', 'manage_content') || rbac_allowed('cms', 'manage_events') || rbac_allowed('system', 'edit_financial_settings');
    }

    function _is_developer(){ // System Admins: member system admins, or staff system admins
        return !empty($_SESSION['ccmps_system_admin']) || (!empty($_SESSION['honcho_logged_in']) && !empty($_SESSION['honcho_sysadmin']));
    }

    function _load($key){
        static $cache = array();
        if(!preg_match('/^[a-z]+$/', (string) $key)){
            return null;
        }
        if(!array_key_exists($key, $cache)){
            $file = APPPATH.'modules/help/content/'.$key.'.json';
            $cache[$key] = is_file($file) ? json_decode((string) file_get_contents($file)) : null;
        }
        return $cache[$key];
    }

    function _inline($text){ // escape, then **bold**, `code`, _italic_ (as the Word generator)
        $h = htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
        $h = preg_replace('/`([^`]+)`/', '<code>$1</code>', $h);
        $h = preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $h);
        $h = preg_replace('/(?<![\w`])_([^_]+)_(?![\w`])/', '<em>$1</em>', $h);
        return $h;
    }

    function _render_blocks($blocks){
        $out = '';
        foreach((array) $blocks as $b){
            switch($b->type ?? ''){
                case 'h2':  $out .= '<h3 class="help-h2">'.$this->_inline($b->text).'</h3>'; break;
                case 'h3':  $out .= '<h4 class="help-h3">'.$this->_inline($b->text).'</h4>'; break;
                case 'p':   $out .= '<p>'.$this->_inline($b->text).'</p>'; break;
                case 'ul':
                case 'ol':
                    $tag = $b->type;
                    $out .= '<'.$tag.'>';
                    foreach((array) $b->items as $i){ $out .= '<li>'.$this->_inline($i).'</li>'; }
                    $out .= '</'.$tag.'>';
                    break;
                case 'alert':
                    $variant = in_array($b->variant ?? '', array('info', 'warning', 'danger', 'success'), true) ? $b->variant : 'info';
                    $out .= '<div class="alert alert-'.$variant.'">'.$this->_inline($b->text).'</div>';
                    break;
                case 'code':
                    $out .= '<pre class="help-code">'.htmlspecialchars((string) $b->text, ENT_QUOTES, 'UTF-8').'</pre>';
                    break;
                case 'table':
                    $out .= '<div class="table-responsive"><table class="table table-bordered help-table"><thead><tr>';
                    foreach((array) $b->headers as $h){ $out .= '<th>'.$this->_inline($h).'</th>'; }
                    $out .= '</tr></thead><tbody>';
                    foreach((array) $b->rows as $row){
                        $out .= '<tr>';
                        foreach((array) $row as $cell){ $out .= '<td>'.$this->_inline($cell).'</td>'; }
                        $out .= '</tr>';
                    }
                    $out .= '</tbody></table></div>';
                    break;
            }
        }
        return $out;
    }

    function _plain($blocks){
        $parts = array();
        foreach((array) $blocks as $b){
            if(isset($b->text)){ $parts[] = $b->text; }
            foreach((array) ($b->items ?? array()) as $i){ $parts[] = $i; }
            foreach((array) ($b->headers ?? array()) as $h){ $parts[] = $h; }
            foreach((array) ($b->rows ?? array()) as $row){ $parts[] = implode(' ', (array) $row); }
        }
        return trim(preg_replace('/\s+/', ' ', str_replace(array('**', '`'), '', implode(' ', $parts))));
    }

    function _font_px(){ // the member's Values size from the Font pop-up (member_font_sizes()), for the guide text
        $id = (int) ($_SESSION['ccmp_rec_id'] ?? 0);
        if($id > 0){
            $v = member_font_sizes($id)['value'] ?? null;
            if($v && preg_match('/\((\d+)px\)/', (string) ($v['options'][$v['current']] ?? ''), $m)){
                return max(12, min(24, (int) $m[1]));
            }
        }
        return 16;
    }

    function _home_url(){
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _return_url($home){ // the page the person came from, kept while they move between Help pages
        $from = (string) ($_GET['return'] ?? '');
        if($from === '' && strpos((string) ($_SERVER['HTTP_REFERER'] ?? ''), BASE_URL) === 0){
            $from = substr($_SERVER['HTTP_REFERER'], strlen(BASE_URL));
        }
        $from = (string) strtok($from, '?#');

        if(strcasecmp((string) strtok($from, '/'), 'help') === 0){
            return $_SESSION['help_return'] ?? $home; // moving within Help: keep the original page
        }
        // only a page of this site: module/method/args, no scheme, dots or double slashes
        $_SESSION['help_return'] = preg_match('#^[a-z][a-z0-9_-]*(/[A-Za-z0-9_-]+)*$#', $from) ? $from : $home;
        return $_SESSION['help_return'];
    }
}
