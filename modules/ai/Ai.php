<?php

/*----------------------------------------------------------------------------*/
/*------------------------------ module AI -----------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  Honcho AI (plan 2026-10-29), phase 0: AI connections by scope and the usage page.
  National's connection is set up by System Admins (Security Groups ai/manage_national)
  and used by System and Member Admins; each chapter's by its Chapter Admins
  (ai/manage_chapter). Keys are stored encrypted (vault_helper.php); calls go through
  ai_send() (ai_helper.php). The module is an add-on: off until switched on on the
  Security Groups Modules panel (system_modules 'ai').

  __construct()                      module switched on, and logged in
  connections()                      National and the chapters: status, this month's spend
        _can_manage($subentity_id), _scope_name($subentity_id), _chapters()
        _token(), _home_url()
  connection($subentity_id)          the form for one scope's connection
        _can_manage($subentity_id), _scope_name($subentity_id)
  connectionsubmit()                 POST: save provider, model, key (blank = keep), on/off, limit
        _check_token(), _can_manage(), _audit()
  testconnection()                   POST: a tiny call to the AI; ai_test_connection()
        _check_token(), _can_manage(), _audit()
  removekey()                        POST: delete the stored key
        _check_token(), _can_manage(), _audit()
  usage($month)                      requests, tokens and estimated cost by scope and feature
        _scope_name(), _chapters()
  _can_manage($subentity_id)
  _can_view_all()
  _scope_name($subentity_id)
  _chapters()
  _token()
  _check_token($back)
  _home_url()
  _audit($action, $subentity_id, $what)
*/

class Ai extends Trongate {

    function __construct(?string $module_name = null){
        parent::__construct($module_name);
        if(strcasecmp(segment(1), 'ai') !== 0){
            return; // used by another module, not visited as a page
        }

        if(empty($_SESSION['trongatetoken'])){ // not logged in
            set_flashdata('Your Session has expired - please login again.');
            redirect('welcome/logout');
        }
        if(!rbac_module_enabled('ai')){
            set_flashdata('The AI module is switched off. A System Admin can switch it on under Security Groups, Modules.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($this->_home_url());
        }
    }

/*----------------------------------------------------------------------------*/
/*------------------------- function CONNECTIONS -----------------------------*/
/*----------------------------------------------------------------------------*/
  function connections(){ // National's and the chapters' connections

    $all = $this->_can_view_all();
    $own = (int) ($_SESSION['ccmps_subentity'] ?? 0);
    if(!$all && !$this->_can_manage($own)){
        set_flashdata('You are not authorized to set up AI connections.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }

    $scopes = $all ? array_merge(array(0 => $this->_scope_name(0)), $this->_chapters()) : array($own => $this->_scope_name($own));
    $rows = array();
    foreach($scopes as $subentity_id => $name){
        $conn = ai_connection((int) $subentity_id);
        if(!$conn && $subentity_id > 0 && $all && !$this->_can_manage((int) $subentity_id)){
            continue; // chapters without their own connection aren't listed for National; the count says how many
        }
        $rows[] = (object) array(
            'subentity_id' => (int) $subentity_id,
            'name'         => $name,
            'conn'         => $conn,
            'spent'        => ai_month_spend((int) $subentity_id),
            'can_manage'   => $this->_can_manage((int) $subentity_id),
        );
    }

    $data['rows']        = $rows;
    $data['all']         = $all;
    $data['fallback']    = setting('AI_CHAPTER_FALLBACK', 'national');
    $data['chapters_without'] = $all ? count($scopes) - count($rows) : 0;
    $data['providers']   = ai_providers();
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();
    $data['bc1']         = $all ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']         = 'AI Connections';
    $data['header']      = 'AI Connections';
    $data['view_module'] = 'ai';
    $data['view_file']   = 'connections';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------- function CONNECTION ------------------------------*/
/*----------------------------------------------------------------------------*/
  function connection($subentity_id = NULL){ // the form for one scope

    $subentity_id = (int) ($subentity_id ?? segment(3));
    if(!$this->_can_manage($subentity_id)){
        set_flashdata('You are not authorized to set up that AI connection.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('ai/connections');
    }

    $data['subentity_id'] = $subentity_id;
    $data['scope_name']   = $this->_scope_name($subentity_id);
    $data['conn']         = ai_connection($subentity_id);
    $data['providers']    = ai_providers();
    $data['token']        = $this->_token();
    $data['home_url']     = $this->_home_url();
    $data['bc1']          = $subentity_id === 0 ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']          = 'AI Connection';
    $data['header']       = 'AI Connection: '.$data['scope_name'];
    $data['view_module']  = 'ai';
    $data['view_file']    = 'connection';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*---------------------- function CONNECTIONSUBMIT ---------------------------*/
/*----------------------------------------------------------------------------*/
  function connectionsubmit(){ // POST from the connection form

    $subentity_id = (int) post('subentity_id');
    $this->_check_token('ai/connection/'.$subentity_id);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/connections');
    }

    $providers = ai_providers();
    $provider  = (string) post('provider', true);
    $model     = (string) post('model', true);
    $key       = trim((string) ($_POST['api_key'] ?? '')); // not cleaned: keys contain characters post() would change
    $limit     = (string) post('monthly_limit', true);
    $errors    = array();

    if(empty($providers[$provider]['available'])){
        $errors[] = 'Choose an AI provider that is available.';
    }elseif(!isset($providers[$provider]['models'][$model])){
        $errors[] = 'Choose a model from the list.';
    }
    if($key !== '' && (strlen($key) < 20 || strlen($key) > 300 || preg_match('/\s/', $key))){
        $errors[] = 'That doesn\'t look like an API key. Copy it again from the provider\'s console.';
    }
    if($limit === '' || !is_numeric($limit) || (float) $limit < 0 || (float) $limit > 100000){
        $errors[] = 'The monthly limit must be a dollar amount (0 for no limit).';
    }
    if(!empty($errors)){
        set_flashdata(implode(' ', $errors));
        $_SESSION['flashmsgcolor'] = 0;
        redirect('ai/connection/'.$subentity_id);
    }

    $conn   = ai_connection($subentity_id);
    $record = array(
        'provider'      => $provider,
        'model'         => $model,
        'enabled'       => post('enabled') == 1 ? 1 : 0,
        'monthly_limit' => round((float) $limit, 2),
        'updated_by'    => (int) ($_SESSION['tg_user_id'] ?? 0),
        'updated_at'    => time(),
    );
    if($key !== ''){
        $record['credential_enc']  = vault_encrypt($key);
        $record['credential_hint'] = vault_hint($key);
        $record['last_test_at'] = NULL; $record['last_test_ok'] = NULL; $record['last_test_msg'] = NULL; // a new key hasn't been tested
    }

    if($conn){
        $this->model->update((int) $conn->id, $record, 'ai_connections');
    }else{
        $record['subentity_id'] = $subentity_id;
        $record['created_by']   = $record['updated_by'];
        $record['created_at']   = time();
        $this->model->insert($record, 'ai_connections');
    }

    $this->_audit('SaveAIConnection', $subentity_id, $provider.' '.$model.', '.($record['enabled'] ? 'on' : 'off').', limit $'.number_format($record['monthly_limit'], 2).($key !== '' ? ', new key ending '.$record['credential_hint'] : ''));
    set_flashdata('Saved.'.($key !== '' ? ' Click Test connection to check the key.' : ''));
    $_SESSION['flashmsgcolor'] = 1;
    redirect('ai/connection/'.$subentity_id);
  }

/*----------------------------------------------------------------------------*/
/*------------------------ function TESTCONNECTION ---------------------------*/
/*----------------------------------------------------------------------------*/
  function testconnection(){ // POST: one tiny call, so the admin knows the key works

    $subentity_id = (int) post('subentity_id');
    $back = post('back') === 'list' ? 'ai/connections' : 'ai/connection/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/connections');
    }

    $conn = ai_connection($subentity_id);
    if(!$conn){
        set_flashdata('Save a connection first.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }

    $result = ai_test_connection($conn);
    $this->_audit('TestAIConnection', $subentity_id, $result['ok'] ? 'ok' : $result['message']);
    set_flashdata($this->_scope_name($subentity_id).': '.$result['message']);
    $_SESSION['flashmsgcolor'] = $result['ok'] ? 1 : 0;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function REMOVEKEY -----------------------------*/
/*----------------------------------------------------------------------------*/
  function removekey(){ // POST: delete the stored key (the connection stays, switched off)

    $subentity_id = (int) post('subentity_id');
    $this->_check_token('ai/connection/'.$subentity_id);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/connections');
    }

    $conn = ai_connection($subentity_id);
    if($conn){
        $this->model->update((int) $conn->id, array('credential_enc' => NULL, 'credential_hint' => NULL, 'enabled' => 0,
                             'last_test_at' => NULL, 'last_test_ok' => NULL, 'last_test_msg' => NULL,
                             'updated_by' => (int) ($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'ai_connections');
        $this->_audit('RemoveAIKey', $subentity_id, 'key ending '.($conn->credential_hint ?: '?').' removed');
    }
    set_flashdata('The key was removed and the connection switched off.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('ai/connection/'.$subentity_id);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function USAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function usage($month = NULL){ // this month (or YYYY-MM): requests, tokens and estimated cost

    $all = rbac_allowed('ai', 'view_usage');
    $own = (int) ($_SESSION['ccmps_subentity'] ?? 0);
    if(!$all && !$this->_can_manage($own)){
        set_flashdata('You are not authorized to see AI usage.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }

    $month = (string) ($month ?? segment(3));
    if(!preg_match('/^\d{4}-\d{2}$/', $month)){
        $month = date('Y-m');
    }
    $start = strtotime($month.'-01 00:00:00');
    $end   = strtotime('+1 month', $start);

    $sql    = "SELECT subentity_id, feature, COUNT(*) AS requests, SUM(status = 'ok') AS answered,
                      SUM(input_tokens) AS input_tokens, SUM(output_tokens) AS output_tokens, SUM(cost) AS cost
                 FROM ai_requests WHERE created_at >= :start AND created_at < :end".($all ? '' : ' AND subentity_id = :own')."
                GROUP BY subentity_id, feature ORDER BY subentity_id, feature";
    $params = array('start' => $start, 'end' => $end);
    if(!$all){ $params['own'] = $own; }

    $names = array(0 => $this->_scope_name(0)) + $this->_chapters();
    $rows  = array();
    foreach((array) $this->model->query_bind($sql, $params, 'object') as $row){
        $row->scope = $names[(int) $row->subentity_id] ?? (SUBENTITY.' '.(int) $row->subentity_id);
        $rows[] = $row;
    }

    $data['rows']        = $rows;
    $data['month']       = $month;
    $data['prev']        = date('Y-m', strtotime('-1 month', $start));
    $data['next']        = date('Y-m', $end) <= date('Y-m') ? date('Y-m', $end) : '';
    $data['home_url']    = $this->_home_url();
    $data['bc1']         = $all ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']         = 'AI Usage';
    $data['header']      = 'AI Usage';
    $data['view_module'] = 'ai';
    $data['view_file']   = 'usage';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _can_manage($subentity_id){ // National: ai/manage_national; a chapter: its own Chapter Admins
        if((int) $subentity_id === 0){
            return rbac_allowed('ai', 'manage_national');
        }
        return rbac_allowed('ai', 'manage_chapter') && (int) ($_SESSION['ccmps_subentity'] ?? 0) === (int) $subentity_id;
    }

    function _can_view_all(){ // National's admins see every chapter's connection status
        return rbac_allowed('ai', 'manage_national') || rbac_allowed('ai', 'view_usage');
    }

    function _scope_name($subentity_id){
        if((int) $subentity_id === 0){
            return 'National';
        }
        return $this->_chapters()[(int) $subentity_id] ?? (SUBENTITY.' '.(int) $subentity_id);
    }

    function _chapters(){ // id => name, active chapters except National HQ
        static $chapters = null;
        if($chapters === null){
            $chapters = array();
            $rows = $this->model->query_bind('SELECT id, COALESCE(NULLIF(description, \'\'), chapter_title) AS name FROM ccmps_subentities
                                               WHERE active = 1 AND id != :hq ORDER BY name', array('hq' => (int) SUBENTITY_NATIONAL_ID), 'object');
            foreach((array) $rows as $row){
                $chapters[(int) $row->id] = (string) $row->name;
            }
        }
        return $chapters;
    }

    function _token(){ // ties the forms to this session
        if(empty($_SESSION['ai_token'])){
            $_SESSION['ai_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['ai_token'];
    }

    function _check_token($back){ // every change is a POST from these screens
        if(REQUEST_TYPE != 'POST' || empty($_SESSION['ai_token']) || !hash_equals($_SESSION['ai_token'], (string) post('token'))){
            set_flashdata('The page had expired - nothing was changed. Please try again.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($back);
        }
    }

    function _home_url(){ // where Home and Close go: staff dashboard or member home
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _audit($action, $subentity_id, $what){ // never the key itself, only its last 4 characters
        $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', $action, 'ai', $un, $time, 'Scope: '.$this->_scope_name($subentity_id), $what, 'Tbl: ai_connections');
    }
}
