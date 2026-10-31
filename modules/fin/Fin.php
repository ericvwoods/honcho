<?php

/*----------------------------------------------------------------------------*/
/*------------------------------- module FIN ---------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  Financial (Core; dues first, 2026-10-31). Step 2: the nightly job. Step 3: recording chapter dues
  (one member, or ticked members in bulk) and reversing them. National invoices, settings and reports
  come in steps 4-5. The work itself is in engine/tg_helpers/dues_helper.php.

  __construct()          signed in (except nightly)
  memberdues($ccmp_id)   one member's dues: charges, invoices, payments; Record chapter dues / Renew; Reverse
        dues_can_record(), _member(), _return_url(), _token()
  recorddues()           POST: dues_record_chapter() for one member
        _check_token(), dues_can_record(), _audit()
  reversedues()          POST: dues_reverse_chapter() with a reason
        _check_token(), dues_can_record(), _audit()
  bulkchapterdues()      the ticked members (from the member list's bulk action): amounts, who can't be recorded and why
        dues_can_record()
  bulkchapterduessubmit()  POST: records each ticked member the same way as one at a time; results shown on the page
        _check_token(), dues_can_record(), dues_record_chapter(), _audit()

  nightly($key)          for the server's scheduler, once a day (no login): moves the membership year
                         on when its due date passes (dues_roll_year()) and recalculates every member's
                         status (dues_recalc_all()). Only while DUES_STATUS_ENGINE is on. $key must equal
                         CRON_KEY in .env (or COFFEE_CRON_KEY when CRON_KEY isn't set).
        _audit($action, $what)
  _member($ccmp_id), _return_url($home), _token(), _check_token($back), _home_url()
*/

class Fin extends Trongate {

    function __construct(?string $module_name = null){
        parent::__construct($module_name);
        if(strcasecmp(segment(1), 'fin') !== 0 || strcasecmp(segment(2), 'nightly') === 0){
            return; // used by another module, or the scheduler (nightly checks its own key)
        }
        if(empty($_SESSION['trongatetoken'])){
            set_flashdata('Your Session has expired - please login again.');
            redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout');
        }
        if(!dues_engine_on()){
            set_flashdata('Dues recording starts when the dues engine is switched on (System Settings, Financial).');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($this->_home_url());
        }
    }

/*----------------------------------------------------------------------------*/
/*-------------------------- function MEMBERDUES -----------------------------*/
/*----------------------------------------------------------------------------*/
  function memberdues($ccmp_id = NULL){

    $m = $this->_member((int) ($ccmp_id ?? segment(3)));
    if(!$m || !dues_can_record($m)){
        set_flashdata('You are not authorized to record that '.strtolower(CCMP).'\'s dues.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }
    $year    = dues_open_year();
    $chapter = dues_chapter((int) $m->subentity);
    $type    = $this->model->get_where((int) $m->ccmp_type, 'ccmps_types');
    $new     = _dues_is_new_member($m);
    $data['m']          = $m;
    $data['year']       = $year;
    $data['chapter']    = $chapter;
    $data['type']       = $type;
    $data['new_member'] = $new;
    $data['chapter_amount']  = round((float) ($chapter->annual_dues ?? 0) * ($new ? dues_prorate_factor((int) $m->subentity, (int) $m->ccmp_type, date('Y-m-d')) : 1), 2);
    $data['national_amount'] = round((float) ($type->national_dues ?? 0) * ($new ? dues_prorate_factor(0, (int) $m->ccmp_type, date('Y-m-d')) : 1), 2);
    $data['charges']    = $this->model->query_bind('SELECT * FROM dues_charges WHERE ccmp_id = :m ORDER BY membership_year DESC, kind', array('m' => (int) $m->id), 'object');
    $data['payments']   = $this->model->query_bind("SELECT * FROM pay_payments WHERE payer_ccmp_id = :m ORDER BY id DESC", array('m' => (int) $m->id), 'object');
    $data['chapter_charge']  = _dues_charge((int) $m->id, $year, 'chapter');
    $data['national_charge'] = _dues_charge((int) $m->id, $year, 'national');
    $data['status_names'] = array(0 => 'None', 1 => 'Current', 2 => 'Past Due', 3 => 'Pending', 5 => 'Expired');
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url('welcome-ccmps/viewccmp/'.(int) $m->id);
    $data['bc1']         = CCMPS;
    $data['bc2']         = 'Dues';
    $data['header']      = trim($m->first_name.' '.$m->last_name).': Dues';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'memberdues';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function RECORDDUES -----------------------------*/
/*----------------------------------------------------------------------------*/
  function recorddues(){

    $id   = (int) post('ccmp_id');
    $back = 'fin/memberdues/'.$id;
    $this->_check_token($back);
    $m = $this->_member($id);
    if(!$m || !dues_can_record($m)){
        redirect($this->_home_url());
    }
    $date = (string) post('received_on', true);
    if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || $date > date('Y-m-d')){
        set_flashdata('Enter the date the dues were received (not in the future).');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }
    list($ok, $msg) = dues_record_chapter($id, dues_open_year(), array('method' => (string) post('method', true), 'reference' => (string) post('reference', true),
                                                                       'date' => $date, 'note' => (string) post('note', true)));
    if($ok){ $this->_audit('RecordChapterDues', 'member '.$id.': '.$msg); }
    set_flashdata($msg);
    $_SESSION['flashmsgcolor'] = $ok ? 1 : 0;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function REVERSEDUES ----------------------------*/
/*----------------------------------------------------------------------------*/
  function reversedues(){

    $id   = (int) post('ccmp_id');
    $back = 'fin/memberdues/'.$id;
    $this->_check_token($back);
    $m = $this->_member($id);
    if(!$m || !dues_can_record($m)){
        redirect($this->_home_url());
    }
    $reasons = array('bounced' => 'Check bounced', 'unpaid' => 'Not actually paid', 'mistake' => 'Entered by mistake', 'other' => 'Other');
    $reason  = $reasons[(string) post('reason', true)] ?? '';
    $detail  = trim((string) post('detail', true));
    if($reason === '' || ($reason === 'Other' && $detail === '')){
        set_flashdata('Choose why the dues are being reversed (and say why for Other).');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back.'#reverse');
    }
    list($ok, $msg) = dues_reverse_chapter($id, dues_open_year(), $reason.($detail !== '' ? ': '.$detail : ''));
    if($ok){ $this->_audit('ReverseChapterDues', 'member '.$id.': '.$msg); }
    set_flashdata($msg);
    $_SESSION['flashmsgcolor'] = $ok ? 1 : 0;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*------------------------ function BULKCHAPTERDUES --------------------------*/
/*----------------------------------------------------------------------------*/
  function bulkchapterdues(){ // the members ticked on a member list (Ccmps::bulkaction, Chapter Dues Paid / Current Year)

    $ids  = array_map('intval', (array) ($_SESSION['fin_bulk_ids'] ?? array()));
    $year = dues_open_year();
    $rows = array();
    foreach($ids as $id){
        $m = $this->_member($id);
        if(!$m){ continue; }
        $why = '';
        if(!dues_can_record($m)){ $why = 'not yours to record'; }
        elseif((int) $m->current_year >= CCMP_LIFETIME_YEAR){ $why = 'lifetime member'; }
        else{
            $ch = _dues_charge($id, $year, 'chapter');
            if($ch && in_array($ch->status, array('paid', 'waived'), true)){ $why = 'already recorded for '.$year; }
        }
        $chapter = dues_chapter((int) $m->subentity);
        $new     = _dues_is_new_member($m);
        $amount  = round((float) ($chapter->annual_dues ?? 0) * ($new ? dues_prorate_factor((int) $m->subentity, (int) $m->ccmp_type, date('Y-m-d')) : 1), 2);
        $rows[] = (object) array('m' => $m, 'chapter' => $chapter, 'amount' => $amount, 'new' => $new, 'why' => $why);
    }
    $data['rows']        = $rows;
    $data['year']        = $year;
    $data['results']     = $_SESSION['fin_bulk_results'] ?? null;
    unset($_SESSION['fin_bulk_results']);
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $_SESSION['fin_bulk_return'] ?? $this->_home_url();
    $data['bc1']         = CCMPS;
    $data['bc2']         = SUBENTITY.' Dues Paid';
    $data['header']      = SUBENTITY.' dues paid: '.count($rows).' '.strtolower(count($rows) === 1 ? CCMP : CCMPS);
    $data['view_module'] = 'fin';
    $data['view_file']   = 'bulkchapterdues';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*--------------------- function BULKCHAPTERDUESSUBMIT -----------------------*/
/*----------------------------------------------------------------------------*/
  function bulkchapterduessubmit(){

    $back = 'fin/bulkchapterdues';
    $this->_check_token($back);
    $date = (string) post('received_on', true);
    if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || $date > date('Y-m-d')){
        set_flashdata('Enter the date the dues were received (not in the future).');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }
    $chosen  = array_map('intval', (array) ($_POST['ccmp'] ?? array()));
    $allowed = array_map('intval', (array) ($_SESSION['fin_bulk_ids'] ?? array()));
    $results = array();
    $done    = 0;
    foreach(array_intersect($chosen, $allowed) as $id){
        $m = $this->_member($id);
        if(!$m || !dues_can_record($m)){ continue; }
        list($ok, $msg) = dues_record_chapter($id, dues_open_year(), array('method' => (string) post('method', true), 'reference' => (string) post('reference', true),
                                                                           'date' => $date, 'note' => 'bulk'));
        $results[] = array('ok' => $ok, 'msg' => $msg);
        if($ok){ $done++; }
    }
    $this->_audit('BulkChapterDues', $done.' of '.count($results).' recorded for '.dues_open_year().' ('.(string) post('method', true).' '.(string) post('reference', true).')');
    $_SESSION['fin_bulk_results'] = $results;
    $_SESSION['fin_bulk_ids'] = array_values(array_diff($allowed, $chosen)); // what's left on the page
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function NIGHTLY ------------------------------*/
/*----------------------------------------------------------------------------*/
  function nightly($key = NULL){

    $expected = (string) env('CRON_KEY', env('COFFEE_CRON_KEY', ''));
    $key      = (string) ($key ?? segment(3));
    header('Content-Type: text/plain; charset=utf-8');
    if($expected === '' || strlen($expected) < 24 || !hash_equals($expected, $key)){
        http_response_code(403);
        echo "Forbidden\n";
        return;
    }
    if((int) setting('DUES_STATUS_ENGINE', 0) !== 1){
        echo "Dues status engine off\n";
        return;
    }
    set_time_limit(900);
    list($old, $new) = dues_roll_year(true);
    $r = dues_recalc_all(true);
    $names = array(0 => 'none', 1 => 'current', 2 => 'past due', 3 => 'pending', 5 => 'expired');
    $counts = array();
    foreach($r['counts'] as $code => $n){ $counts[] = ($names[$code] ?? $code).' '.$n; }
    $summary = 'membership year '.$new.($old !== $new ? ' (was '.$old.')' : '').', grace '.($r['grace'] ? 'on' : 'off').'; '
             .count($r['changes']).' status change(s); '.implode(', ', $counts);
    if($old !== $new || !empty($r['changes'])){
        $this->_audit('DuesNightly', $summary);
    }
    echo $summary."\n";
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _member($ccmp_id){
        $m = $ccmp_id > 0 ? $this->model->get_where((int) $ccmp_id, 'ccmps') : false;
        return ($m && empty($m->deceased) && empty($m->soft_deleted)) ? $m : false;
    }

    function _home_url(){
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _return_url($home){ // the page the person came from, kept while they stay on the dues pages (Cards::_return_url())
        $from = (string) ($_GET['return'] ?? '');
        if($from === '' && strpos((string) ($_SERVER['HTTP_REFERER'] ?? ''), BASE_URL) === 0){
            $from = substr($_SERVER['HTTP_REFERER'], strlen(BASE_URL));
        }
        $from = (string) strtok($from, '?#');
        if(strcasecmp((string) strtok($from, '/'), 'fin') === 0){
            return $_SESSION['fin_return'] ?? $home;
        }
        $_SESSION['fin_return'] = preg_match('#^[a-z][a-z0-9_-]*(/[A-Za-z0-9_-]+)*$#', $from) ? $from : $home;
        return $_SESSION['fin_return'];
    }

    function _token(){
        if(empty($_SESSION['fin_token'])){
            $_SESSION['fin_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['fin_token'];
    }

    function _check_token($back){ // every change is a POST from these screens
        if(REQUEST_TYPE != 'POST' || empty($_SESSION['fin_token']) || !hash_equals($_SESSION['fin_token'], (string) post('token'))){
            set_flashdata('The page had expired - nothing was changed. Please try again.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($back);
        }
    }

    function _audit($action, $what){
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $un = $action === 'DuesNightly' ? 'UN: scheduler' : (!empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? ''));
        $this->auditlogger->logevent('update', $action, 'fin', $un, $time, 'Rec: dues', 'Tbl: dues_charges', substr($what, 0, 250));
    }

} // end controller
