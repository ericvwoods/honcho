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
  Step 4, National's side (fin/settle_national_dues unless noted):
  invoices()             National invoices by year, chapter and status; tick and Mark paid (FIN-03, FIN-31); also the
                         members ticked on a member list with the National Dues Paid bulk action ($_SESSION['fin_inv_ids'])
  invoicespaid()         POST: dues_mark_national_paid() for each ticked invoice
  nationalaction()       POST from a member's Dues page: paid, void, waive, resend, reverse (FIN-27, FIN-33)
  attention()            the Needs attention cases; attentionresolve() POST: resolved with a note
  settings()             fin/manage_dues_settings: National dues by member type, type options, National's proration
                         schedule, every chapter's dues amount and who collects them; settingssubmit() POST
  chapterdues($id)       a chapter's dues and proration schedule: its Chapter Admins (own chapter) or dues settings
                         people (any chapter, plus who collects them); chapterduessubmit() POST
        _can_settle(), _can_settings(), _can_chapter_settings($id), _proration($scope), _save_proration($scope)
  Step 5, reports and members:
  report()               fin/view_dues_reports: per chapter, member counts by status and the year's dues dollars
                         (Chapter Admins: their own chapter); reportexport() the same as Excel, plus a member sheet
        _report_chapter()
  reminders()            who was reminded (dues_reminders), for the dues people
  receipt($payment_id)   a printable receipt: the member themselves or their dues people (dues_can_see_payment())
  mydues()               a member's own dues: years, invoices, payments, receipts; how to pay an open invoice

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
    $data['can_settle']   = $this->_can_settle();
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
    $rem = dues_run_reminders(); // only when DUES_REMINDERS is on
    $names = array(0 => 'none', 1 => 'current', 2 => 'past due', 3 => 'pending', 5 => 'expired');
    $counts = array();
    foreach($r['counts'] as $code => $n){ $counts[] = ($names[$code] ?? $code).' '.$n; }
    $summary = 'membership year '.$new.($old !== $new ? ' (was '.$old.')' : '').', grace '.($r['grace'] ? 'on' : 'off').'; '
             .count($r['changes']).' status change(s); '.implode(', ', $counts)
             .'; reminders: '.$rem['upcoming'].' upcoming, '.$rem['past_due'].' past due, '.$rem['invoice_open'].' open invoice';
    if($old !== $new || !empty($r['changes'])){
        $this->_audit('DuesNightly', $summary);
    }
    echo $summary."\n";
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function INVOICES ------------------------------*/
/*----------------------------------------------------------------------------*/
  function invoices(){

    if(!$this->_can_settle()){ $this->_deny(); }
    $year    = (int) ($_GET['year'] ?? dues_open_year());
    $chapter = (int) ($_GET['chapter'] ?? 0);
    $status  = in_array($_GET['status'] ?? 'open', array('open', 'paid', 'void', 'waived', 'all'), true) ? ($_GET['status'] ?? 'open') : 'open';
    $picked  = !empty($_GET['picked']) ? array_map('intval', (array) ($_SESSION['fin_inv_ids'] ?? array())) : array();
    $where   = array("c.kind = 'national'", 'c.membership_year = :y');
    $params  = array('y' => $year);
    if($chapter > 0){ $where[] = 'c.subentity_id = :s'; $params['s'] = $chapter; }
    if($status !== 'all'){ $where[] = 'c.status = :st'; $params['st'] = $status; }
    if($picked){ $where[] = 'c.ccmp_id IN ('.implode(',', $picked).')'; }
    $data['rows'] = $this->model->query_bind("SELECT c.*, m.first_name, m.last_name, m.ccmp_number, m.email_address,
                                                     COALESCE(NULLIF(s.description, ''), s.chapter_title) AS chapter_name
                                                FROM dues_charges c JOIN ccmps m ON m.id = c.ccmp_id
                                                LEFT JOIN ccmps_subentities s ON s.id = c.subentity_id
                                               WHERE ".implode(' AND ', $where)." ORDER BY m.last_name, m.first_name LIMIT 1000", $params, 'object');
    if($picked){ // ticked members with no open invoice for the year: say why
        $have = array_map(function($r){ return (int) $r->ccmp_id; }, (array) $data['rows']);
        $data['missing'] = array();
        foreach(array_diff($picked, $have) as $id){
            $m = $this->model->get_where((int) $id, 'ccmps');
            if($m){ $data['missing'][] = trim($m->first_name.' '.$m->last_name).': no '.$status.' National invoice for '.$year.' (chapter dues not recorded yet?)'; }
        }
    }
    $data['totals'] = $this->model->query_bind("SELECT status, COUNT(*) AS n, SUM(amount) AS amount FROM dues_charges
                                                 WHERE kind = 'national' AND membership_year = :y GROUP BY status", array('y' => $year), 'object');
    $data['year'] = $year; $data['chapter'] = $chapter; $data['status'] = $status; $data['picked'] = (bool) $picked;
    $data['chapters'] = $this->model->query("SELECT id, COALESCE(NULLIF(description, ''), chapter_title) AS name FROM ccmps_subentities WHERE active = 1 ORDER BY name", 'object');
    $data['attention'] = count(dues_attention_open());
    $data['results']   = $_SESSION['fin_inv_results'] ?? null;
    unset($_SESSION['fin_inv_results']);
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'National Invoices';
    $data['header']      = 'National Dues Invoices';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'invoices';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------- function INVOICESPAID ----------------------------*/
/*----------------------------------------------------------------------------*/
  function invoicespaid(){

    $back = 'fin/invoices?'.http_build_query(array('year' => (int) post('year'), 'chapter' => (int) post('chapter'), 'status' => 'open', 'picked' => (int) post('picked')));
    $this->_check_token($back);
    if(!$this->_can_settle()){ $this->_deny(); }
    $date = (string) post('received_on', true);
    if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || $date > date('Y-m-d')){
        set_flashdata('Enter the date the payments were received (not in the future).');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }
    $results = array(); $done = 0;
    foreach(array_map('intval', (array) ($_POST['charge'] ?? array())) as $cid){
        list($ok, $msg) = dues_mark_national_paid($cid, array('method' => (string) post('method', true), 'reference' => (string) post('reference', true), 'date' => $date));
        $results[] = array('ok' => $ok, 'msg' => $msg);
        if($ok){ $done++; }
    }
    if(empty($results)){
        set_flashdata('Tick the invoices that were paid.');
        $_SESSION['flashmsgcolor'] = 0;
    }
    $this->_audit('NationalDuesPaid', $done.' of '.count($results).' National invoices marked paid ('.(string) post('method', true).' '.(string) post('reference', true).')');
    $_SESSION['fin_inv_results'] = $results;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*------------------------ function NATIONALACTION ---------------------------*/
/*----------------------------------------------------------------------------*/
  function nationalaction(){ // from a member's Dues page: paid | void | waive | resend | reverse

    $id   = (int) post('ccmp_id');
    $back = 'fin/memberdues/'.$id.'#national';
    $this->_check_token($back);
    if(!$this->_can_settle()){ $this->_deny(); }
    $charge = $this->model->get_where((int) post('charge_id'), 'dues_charges');
    if(!$charge || (int) $charge->ccmp_id !== $id || $charge->kind !== 'national'){
        redirect($back);
    }
    $reason = trim((string) post('reason', true));
    switch((string) post('do')){
        case 'paid':
            list($ok, $msg) = dues_mark_national_paid((int) $charge->id, array('method' => (string) post('method', true), 'reference' => (string) post('reference', true),
                                                                                'date' => (string) post('received_on', true)));
            break;
        case 'void':
        case 'waive':
            list($ok, $msg) = dues_set_charge_status((int) $charge->id, post('do') === 'void' ? 'void' : 'waived', $reason);
            break;
        case 'reverse':
            list($ok, $msg) = $reason === '' ? array(false, 'Say why the payment is being reversed.') : dues_reverse_national((int) $charge->id, $reason);
            break;
        case 'resend':
            $ok  = $charge->status === 'open' && dues_send_invoice($charge);
            $msg = $ok ? 'Invoice '.$charge->invoice_number.' emailed again.' : 'Not sent (the invoice isn\'t open, or the member has no email address).';
            break;
        default:
            redirect($back);
    }
    if($ok){ $this->_audit('NationalInvoice'.ucfirst((string) post('do')), 'member '.$id.': '.$msg.($reason !== '' ? ' Reason: '.$reason : '')); }
    set_flashdata($msg);
    $_SESSION['flashmsgcolor'] = $ok ? 1 : 0;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function ATTENTION ------------------------------*/
/*----------------------------------------------------------------------------*/
  function attention(){

    if(!$this->_can_settle()){ $this->_deny(); }
    $data['open']     = dues_attention_open();
    $data['resolved'] = $this->model->query("SELECT a.*, CONCAT(c.first_name, ' ', c.last_name) AS member_name FROM dues_attention a
                                               LEFT JOIN ccmps c ON c.id = a.ccmp_id WHERE a.resolved_at > 0 ORDER BY a.resolved_at DESC LIMIT 25", 'object');
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'Needs Attention';
    $data['header']      = 'Dues: Needs Attention';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'attention';
    $this->templates->inspinia($data);
  }

  function attentionresolve(){

    $this->_check_token('fin/attention');
    if(!$this->_can_settle()){ $this->_deny(); }
    $case = $this->model->get_where((int) post('id'), 'dues_attention');
    $note = trim((string) post('resolution', true));
    if(!$case || $case->resolved_at > 0 || $note === ''){
        set_flashdata('Say what was done to resolve it.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('fin/attention');
    }
    $this->model->update((int) $case->id, array('resolved_at' => time(), 'resolved_by' => (int) ($_SESSION['tg_user_id'] ?? 0), 'resolution' => substr($note, 0, 500)), 'dues_attention');
    $this->_audit('DuesAttentionResolved', 'case '.(int) $case->id.' (member '.(int) $case->ccmp_id.'): '.$note);
    set_flashdata('Marked resolved.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('fin/attention');
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function SETTINGS ------------------------------*/
/*----------------------------------------------------------------------------*/
  function settings(){ // National dues by member type, type options, National proration, chapters' dues

    if(!$this->_can_settings()){ $this->_deny(); }
    $data['types']     = $this->model->query('SELECT * FROM ccmps_types ORDER BY id', 'object');
    $data['proration'] = $this->_proration(0);
    $data['chapters']  = $this->model->query("SELECT id, COALESCE(NULLIF(description, ''), chapter_title) AS name, annual_dues, dues_collected_by
                                                FROM ccmps_subentities WHERE active = 1 ORDER BY name", 'object');
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'Dues Settings';
    $data['header']      = 'Dues Settings';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'settings';
    $this->templates->inspinia($data);
  }

  function settingssubmit(){

    $this->_check_token('fin/settings');
    if(!$this->_can_settings()){ $this->_deny(); }
    $changes = array();
    foreach($this->model->query('SELECT * FROM ccmps_types ORDER BY id', 'object') as $t){
        $amount = round(max(0, (float) ($_POST['dues'][$t->id] ?? $t->national_dues)), 2);
        $row = array('national_dues' => $amount, 'always_current' => !empty($_POST['always'][$t->id]) ? 1 : 0, 'at_large' => !empty($_POST['atlarge'][$t->id]) ? 1 : 0);
        if((float) $t->national_dues != $amount || (int) $t->always_current !== $row['always_current'] || (int) $t->at_large !== $row['at_large']){
            $this->model->update((int) $t->id, $row + array('updated_by' => (int) ($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'ccmps_types');
            $changes[] = $t->ccmp_type.' $'.number_format($amount, 2).($row['always_current'] ? ' always Current' : '').($row['at_large'] ? '' : ' not at large');
        }
    }
    foreach($this->model->query("SELECT id, annual_dues, dues_collected_by FROM ccmps_subentities WHERE active = 1", 'object') as $c){
        if(!isset($_POST['chapter_dues'][$c->id])){ continue; }
        $amount = round(max(0, (float) $_POST['chapter_dues'][$c->id]), 2);
        $by     = ($_POST['collected'][$c->id] ?? '') === 'national' ? 'national' : 'chapter';
        if((float) $c->annual_dues != $amount || $c->dues_collected_by !== $by){
            $this->model->update((int) $c->id, array('annual_dues' => $amount, 'dues_collected_by' => $by), 'ccmps_subentities');
            $changes[] = 'chapter '.$c->id.' $'.number_format($amount, 2).' by '.$by;
        }
    }
    $changes = array_merge($changes, $this->_save_proration(0));
    $this->_audit('DuesSettings', $changes ? implode('; ', $changes) : 'no changes');
    set_flashdata($changes ? 'Saved. New amounts apply to invoices raised from now on; invoices already raised keep their amounts.' : 'Nothing changed.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('fin/settings');
  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function CHAPTERDUES ----------------------------*/
/*----------------------------------------------------------------------------*/
  function chapterdues($subentity_id = NULL){ // a chapter's own dues amount and proration schedule

    $id = (int) ($subentity_id ?? segment(3));
    if(!$id && !empty($_SESSION['ccmps_subentity'])){ $id = (int) $_SESSION['ccmps_subentity']; }
    if(!$this->_can_chapter_settings($id)){ $this->_deny(); }
    $data['chapter']   = dues_chapter($id);
    $data['types']     = $this->model->query('SELECT * FROM ccmps_types WHERE active = 1 ORDER BY id', 'object');
    $data['proration'] = $this->_proration($id);
    $data['national']  = $this->_can_settings();
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = SUBENTITY.' Admin';
    $data['bc2']         = SUBENTITY.' Dues';
    $data['header']      = SUBENTITY.' Dues: '.(string) ($data['chapter']->description ?: $data['chapter']->chapter_title);
    $data['view_module'] = 'fin';
    $data['view_file']   = 'chapterdues';
    $this->templates->inspinia($data);
  }

  function chapterduessubmit(){

    $id = (int) post('subentity_id');
    $this->_check_token('fin/chapterdues/'.$id);
    if(!$this->_can_chapter_settings($id)){ $this->_deny(); }
    $chapter = dues_chapter($id);
    $amount  = round(max(0, (float) post('annual_dues')), 2);
    $row     = array('annual_dues' => $amount);
    if($this->_can_settings()){ $row['dues_collected_by'] = post('dues_collected_by') === 'national' ? 'national' : 'chapter'; }
    $this->model->update($id, $row, 'ccmps_subentities');
    $changes = array_merge(array('dues $'.number_format($amount, 2).(isset($row['dues_collected_by']) ? ' by '.$row['dues_collected_by'] : '')), $this->_save_proration($id));
    $this->_audit('ChapterDuesSettings', 'chapter '.$id.' ('.$chapter->chapter_title.'): '.implode('; ', $changes));
    set_flashdata('Saved. The new amount applies to dues recorded from now on.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('fin/chapterdues/'.$id);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function REPORT -------------------------------*/
/*----------------------------------------------------------------------------*/
  function report(){

    $chapter = $this->_report_chapter();
    $year    = (int) ($_GET['year'] ?? dues_year_for());
    $data['rows']     = dues_report($year, $chapter);
    $data['year']     = $year;
    $data['chapter']  = $chapter;
    $data['national'] = $this->_can_settle() || $this->_can_settings();
    $data['chapters'] = $data['national'] ? $this->model->query("SELECT id, COALESCE(NULLIF(description, ''), chapter_title) AS name FROM ccmps_subentities WHERE active = 1 ORDER BY name", 'object') : array();
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'Dues Report';
    $data['header']      = 'Dues Report '.$year;
    $data['view_module'] = 'fin';
    $data['view_file']   = 'report';
    $this->templates->inspinia($data);
  }

  function reportexport(){ // Excel: Summary sheet + one row per member

    $chapter = $this->_report_chapter();
    $year    = (int) ($_GET['year'] ?? dues_year_for());
    require_once APPPATH.'vendor/autoload.php';
    $book  = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $book->getActiveSheet();
    $sheet->setTitle('Summary');
    $sheet->fromArray(array(SUBENTITY, 'Current', 'Pending', 'Past Due', 'Expired', SUBENTITY.' dues paid', 'National invoiced', 'National paid', 'National outstanding', 'Open invoices'), null, 'A1');
    $r = 2;
    foreach(dues_report($year, $chapter) as $row){
        $sheet->fromArray(array($row->name, (int) $row->current_n, (int) $row->pending_n, (int) $row->past_due_n, (int) $row->expired_n,
                                (float) $row->chapter_paid, (float) $row->national_invoiced, (float) $row->national_paid, (float) $row->national_open, (int) $row->open_n), null, 'A'.$r++);
    }
    $names = array(0 => 'None', 1 => 'Current', 2 => 'Past Due', 3 => 'Pending', 5 => 'Expired');
    $ms = $book->createSheet();
    $ms->setTitle(CCMPS);
    $ms->fromArray(array(SUBENTITY, 'Last name', 'First name', CCMP.' No.', 'Type', 'Status', 'Paid through', SUBENTITY.' dues', SUBENTITY.' dues status', 'National invoice', 'National amount', 'National balance', 'National status', 'Email'), null, 'A1');
    $r = 2;
    foreach(dues_report_members($year, $chapter) as $m){
        $ms->fromArray(array($m->chapter_name, $m->last_name, $m->first_name, $m->ccmp_number, $m->type_name, $names[(int) $m->status] ?? '', (int) $m->current_year,
                             $m->chapter_amount === null ? '' : (float) $m->chapter_amount, (string) $m->chapter_status, (string) $m->invoice_number,
                             $m->national_amount === null ? '' : (float) $m->national_amount, $m->national_balance === null ? '' : (float) $m->national_balance,
                             (string) $m->national_status, (string) $m->email_address), null, 'A'.$r++);
    }
    foreach(array($sheet, $ms) as $sh){
        $sh->getStyle('1:1')->getFont()->setBold(true);
        foreach(range('A', 'N') as $col){ $sh->getColumnDimension($col)->setAutoSize(true); }
    }
    $this->_audit('DuesReportExport', 'year '.$year.($chapter ? ', chapter '.$chapter : ', all chapters'));
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="dues-'.$year.($chapter ? '-chapter-'.$chapter : '').'.xlsx"');
    header('Cache-Control: max-age=0');
    (new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($book))->save('php://output');
    exit;
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function REMINDERS -----------------------------*/
/*----------------------------------------------------------------------------*/
  function reminders(){

    if(!$this->_can_settle() && !$this->_can_settings()){ $this->_deny(); }
    $data['rows'] = $this->model->query("SELECT r.*, CONCAT(m.first_name, ' ', m.last_name) AS member_name FROM dues_reminders r
                                           LEFT JOIN ccmps m ON m.id = r.ccmp_id ORDER BY r.id DESC LIMIT 200", 'object');
    $data['on']          = (int) setting('DUES_REMINDERS', 0) === 1;
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'Reminders';
    $data['header']      = 'Dues Reminders Sent';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'reminders';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function RECEIPT ------------------------------*/
/*----------------------------------------------------------------------------*/
  function receipt($payment_id = NULL){

    $p = $this->model->get_where((int) ($payment_id ?? segment(3)), 'pay_payments');
    if(!dues_can_see_payment($p)){ $this->_deny(); }
    $data['p']       = $p;
    $data['m']       = $this->model->get_where((int) $p->payer_ccmp_id, 'ccmps');
    $data['charge']  = $p->applies_to === 'dues_charge' ? $this->model->get_where((int) $p->applies_to_id, 'dues_charges') : false;
    $data['chapter'] = $data['charge'] ? dues_chapter((int) $data['charge']->subentity_id) : false;
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url(!empty($_SESSION['ccmp_logged_in']) && (int) $p->payer_ccmp_id === (int) ($_SESSION['ccmp_rec_id'] ?? 0) ? 'fin/mydues' : $this->_home_url());
    $data['title_kind']  = !empty($_SESSION['ccmp_logged_in']) && (int) $p->payer_ccmp_id === (int) ($_SESSION['ccmp_rec_id'] ?? 0) ? 'member' : 'admin';
    $data['bc1']         = 'Dues';
    $data['bc2']         = 'Receipt';
    $data['header']      = 'Receipt '.$p->receipt_number;
    $data['view_module'] = 'fin';
    $data['view_file']   = 'receipt';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MYDUES -------------------------------*/
/*----------------------------------------------------------------------------*/
  function mydues(){ // a member's own dues

    if(empty($_SESSION['ccmp_logged_in']) || empty($_SESSION['ccmp_rec_id'])){ $this->_deny(); }
    $id = (int) $_SESSION['ccmp_rec_id'];
    $data['m']         = $this->model->get_where($id, 'ccmps');
    $data['charges']   = $this->model->query_bind("SELECT * FROM dues_charges WHERE ccmp_id = :m AND status != 'void' ORDER BY membership_year DESC, kind", array('m' => $id), 'object');
    $data['payments']  = $this->model->query_bind("SELECT * FROM pay_payments WHERE payer_ccmp_id = :m AND status = 'completed' ORDER BY id DESC", array('m' => $id), 'object');
    $data['pay_text']  = trim((string) setting('DUES_PAY_INSTRUCTIONS', ''));
    $data['due_date']  = date('F j, Y', strtotime(dues_due_date(dues_year_for() + 1)));
    $data['status_names'] = array(0 => 'None', 1 => 'Current', 2 => 'Past Due', 3 => 'Pending', 5 => 'Expired');
    $data['title_kind']  = 'member';
    $data['home_url']    = $this->_home_url();
    $data['close_url']   = $this->_return_url($this->_home_url());
    $data['bc1']         = 'My '.CCMP;
    $data['bc2']         = 'My Dues';
    $data['header']      = 'My Dues';
    $data['view_module'] = 'fin';
    $data['view_file']   = 'mydues';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _can_settle(){ return rbac_allowed('fin', 'settle_national_dues'); }

    function _can_settings(){ return rbac_allowed('fin', 'manage_dues_settings'); }

    function _can_chapter_settings($id){ // dues settings people: any chapter; Chapter Admins: their own
        if($id <= 0 || !dues_chapter($id)){ return false; }
        if($this->_can_settings()){ return true; }
        return rbac_allowed('fin', 'record_chapter_dues') && !empty($_SESSION['ccmps_subentity_admin']) && (int) ($_SESSION['ccmps_subentity'] ?? -1) === $id;
    }

    function _report_chapter(){ // national dues people: any chapter (0 = all, ?chapter=); Chapter Admins: their own, always
        if(!rbac_allowed('fin', 'view_dues_reports')){ $this->_deny(); }
        if($this->_can_settle() || $this->_can_settings()){
            return (int) ($_GET['chapter'] ?? 0);
        }
        if(!empty($_SESSION['ccmps_subentity_admin']) && !empty($_SESSION['ccmps_subentity'])){
            return (int) $_SESSION['ccmps_subentity'];
        }
        $this->_deny();
    }

    function _deny(){
        set_flashdata('You are not authorized to do that.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }

    function _proration($scope){ // [month => factor], and the member type ids it applies to
        $months = array_fill(1, 12, 1.0);
        foreach($this->model->query_bind('SELECT join_month, factor FROM dues_proration WHERE subentity_id = :s', array('s' => (int) $scope), 'object') as $r){
            $months[(int) $r->join_month] = (float) $r->factor;
        }
        $types = array_map(function($r){ return (int) $r->ccmp_type_id; }, (array) $this->model->query_bind('SELECT ccmp_type_id FROM dues_proration_types WHERE subentity_id = :s', array('s' => (int) $scope), 'object'));
        return array('months' => $months, 'types' => $types);
    }

    function _save_proration($scope){ // from the posted factors (0-1) and ticked types; returns what changed
        $old = $this->_proration($scope);
        $changes = array();
        for($mo = 1; $mo <= 12; $mo++){
            $f = round(max(0, min(1, (float) ($_POST['factor'][$mo] ?? $old['months'][$mo]))), 4);
            if(abs($f - $old['months'][$mo]) > 0.00001){
                $this->model->query_bind('INSERT INTO dues_proration (subentity_id, join_month, factor, updated_by, updated_at) VALUES (:s, :m, :f, :b, :t)
                                          ON DUPLICATE KEY UPDATE factor = VALUES(factor), updated_by = VALUES(updated_by), updated_at = VALUES(updated_at)',
                                         array('s' => (int) $scope, 'm' => $mo, 'f' => $f, 'b' => (int) ($_SESSION['tg_user_id'] ?? 0), 't' => time()));
                $changes[] = 'month '.$mo.' '.$f;
            }
        }
        $types = array_map('intval', array_keys((array) ($_POST['prorate'] ?? array())));
        if($types != $old['types'] || array_diff($types, $old['types']) || array_diff($old['types'], $types)){
            $this->model->query_bind('DELETE FROM dues_proration_types WHERE subentity_id = :s', array('s' => (int) $scope));
            foreach($types as $t){
                $this->model->query_bind('INSERT IGNORE INTO dues_proration_types (subentity_id, ccmp_type_id) VALUES (:s, :t)', array('s' => (int) $scope, 't' => $t));
            }
            $changes[] = 'prorated types '.implode(',', $types);
        }
        return $changes;
    }

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
