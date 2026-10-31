<?php

/*----------------------------------------------------------------------------*/
/*------------------------------ module VIEWAS -------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  View as a Member (owner's plan and decisions, 2026-10-31; requirements LOGIN-20 to LOGIN-29).
  An admin sees and uses Honcho as a member. Starting sets the admin's own session aside inside the
  session ($_SESSION['viewas']['stash']) and sets the session up as the member with the same helper the
  member login uses (member_session_setup()); Return puts the admin's session back exactly. Who may and
  who can be viewed as: viewas_can() (session_helper.php). Blocked actions: viewas_block().
  The Auditlog marks everything done meanwhile as "<admin> as <member>" (Auditlogger::logevent()).

  index()             search for a member to view as (name, member number, email)
        viewas_can(), _token()
  start()             POST: become the member
        _check_token(), viewas_can(), member_session_setup(), _audit()
  stop()              ?k=<key>: back to the admin's own account (also from Logout while viewing)
        _audit()
  _token(), _check_token($back), _home_url(), _audit($action, $what)
*/

class Viewas extends Trongate {

    function __construct(?string $module_name = null){
        parent::__construct($module_name);
        if(strcasecmp(segment(1), 'viewas') !== 0){
            return;
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

    if(viewas_active()){ redirect('welcome-ccmps/ccmphome'); }
    if(!rbac_allowed('system', 'view_as_member')){
        set_flashdata('You are not allowed to view Honcho as a '.strtolower(CCMP).'.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }
    $q = trim((string) ($_GET['q'] ?? ''));
    $rows = array();
    if(strlen($q) >= 2){
        $like   = '%'.$q.'%';
        $params = array('a' => $like, 'b' => $like, 'c' => $like, 'd' => $like, 'e' => $q);
        $rows   = $this->model->query_bind("SELECT m.*, COALESCE(NULLIF(s.description, ''), s.chapter_title) AS chapter_name FROM ccmps m
                                              LEFT JOIN ccmps_subentities s ON s.id = m.subentity
                                             WHERE COALESCE(m.deceased, 0) != 1 AND COALESCE(m.soft_deleted, 0) != 1
                                               AND (m.first_name LIKE :a OR m.last_name LIKE :b OR CONCAT(m.first_name, ' ', m.last_name) LIKE :c
                                                    OR m.email_address LIKE :d OR m.ccmp_number = :e)
                                             ORDER BY m.last_name, m.first_name LIMIT 25", $params, 'object');
        foreach($rows as $r){ list($r->ok, $r->why) = viewas_can($r); }
    }
    $data['q']           = $q;
    $data['rows']        = $rows;
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['bc1']         = CCMPS;
    $data['bc2']         = 'View as a '.CCMP;
    $data['header']      = 'View as a '.CCMP;
    $data['view_module'] = 'viewas';
    $data['view_file']   = 'index';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function START -------------------------------*/
/*----------------------------------------------------------------------------*/
  function start(){

    $this->_check_token('viewas');
    $target = $this->model->get_where((int) post('ccmp_id'), 'ccmps');
    list($ok, $why) = viewas_can($target);
    if(!$ok){
        set_flashdata($why);
        $_SESSION['flashmsgcolor'] = 0;
        redirect('viewas');
    }
    $stash = $_SESSION;
    unset($stash['viewas']);
    $staff = !empty($_SESSION['honcho_logged_in']);
    $info  = array(
        'stash'          => $stash,
        'admin_username' => $staff ? (string) ($_SESSION['honcho_username'] ?? $_SESSION['honcho_user_username'] ?? '') : (string) ($_SESSION['ccmp_username'] ?? ''),
        'admin_name'     => trim($staff ? ($_SESSION['honcho_user_first'] ?? '').' '.($_SESSION['honcho_user_last'] ?? '') : ($_SESSION['ccmp_first'] ?? '').' '.($_SESSION['ccmp_last'] ?? '')),
        'admin_tg'       => (int) ($_SESSION['tg_user_id'] ?? 0),
        'ccmp_id'        => (int) $target->id,
        'member_name'    => trim($target->first_name.' '.$target->last_name),
        'member_username'=> (string) $target->username,
        'chapter'        => (string) (dues_chapter((int) $target->subentity)->description ?? ''),
        'locked'         => !empty($target->locked),
        'started_at'     => time(),
        'key'            => bin2hex(random_bytes(12)),
        'return'         => preg_match('#^[a-z][a-z0-9_-]*(/[A-Za-z0-9_-]+)*$#', (string) post('return', true)) ? (string) post('return', true) : 'welcome-ccmps/viewccmp/'.(int) $target->id,
    );
    $this->_audit('ViewAsStart', $info['admin_username'].' started viewing as '.$info['member_name'].' (member '.$info['ccmp_id'].')');

    session_regenerate_id(true);
    $device = $_SESSION['device_type'] ?? 1;
    $_SESSION = array('viewas' => $info, 'device_type' => $device);
    member_session_setup($target);
    $this->module('trongate_tokens');
    $this->trongate_tokens->_generate_token(array('user_id' => (int) $target->trongate_user_id)); // the member's own token, in the session only

    set_flashdata('You are viewing Honcho as '.$info['member_name'].'.'.($info['locked'] ? ' This account is locked: the member can\'t sign in themselves.' : ''));
    $_SESSION['flashmsgcolor'] = 1;
    redirect('welcome-ccmps/ccmphome');
  }

/*----------------------------------------------------------------------------*/
/*------------------------------ function STOP -------------------------------*/
/*----------------------------------------------------------------------------*/
  function stop(){

    if(!viewas_active()){
        redirect($this->_home_url());
    }
    $info = $_SESSION['viewas'];
    if(!hash_equals((string) $info['key'], (string) ($_GET['k'] ?? ''))){
        redirect('welcome-ccmps/ccmphome');
    }
    $minutes = max(1, (int) round((time() - (int) $info['started_at']) / 60));
    $this->_audit('ViewAsStop', $info['admin_username'].' stopped viewing as '.$info['member_name'].' (member '.$info['ccmp_id'].') after '.$minutes.' min');
    session_regenerate_id(true);
    $_SESSION = $info['stash'];   // the admin's own session, exactly as it was
    set_flashdata('Back in your own account.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect($info['return']);
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _token(){
        if(empty($_SESSION['viewas_token'])){
            $_SESSION['viewas_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['viewas_token'];
    }

    function _check_token($back){
        if(REQUEST_TYPE != 'POST' || empty($_SESSION['viewas_token']) || !hash_equals($_SESSION['viewas_token'], (string) post('token'))){
            set_flashdata('The page had expired - nothing was changed. Please try again.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($back);
        }
    }

    function _home_url(){
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _audit($action, $what){ // written while still the admin (start) or still marked as viewing (stop)
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
        $this->auditlogger->logevent('update', $action, 'viewas', $un, $time, 'Rec: '.(int) post('ccmp_id'), 'Tbl: ccmps', substr($what, 0, 250));
    }

} // end controller
