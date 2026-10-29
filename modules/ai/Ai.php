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
  Phase 1, the Daily Coffee Report (coffee_helper.php), edited by the same people as the scope's connection:
  coffee()                           National's and the chapters' reports: on/off, time, last run
        _can_manage(), _can_view_all(), _scope_name(), _chapters()
  coffeesettings($subentity_id)      the settings form: sections and options, days, time, recipients, tone
        _can_manage(), coffee_config(), coffee_sections()
  coffeesubmit()                     POST: save the settings
        _check_token(), _can_manage(), _audit()
  coffeepreview()                    POST: build today's report and show it; nothing is sent
        _check_token(), _can_manage(), coffee_run($id, 'preview')
  coffeetest()                       POST: build it and email it to the person asking (test_to=me) or the "Sent to" list (test_to=list)
        _check_token(), _can_manage(), _my_email(), coffee_run($id, 'test', $to, ['email']), _audit()
  coffeetelegramtest()               POST: build it and send it to the scope's Telegram chat
        _check_token(), _can_manage(), coffee_run($id, 'test', null, ['telegram']), _audit()
  coffeetelegramchats()              POST: list the chats that have messaged the saved bot, to find the chat ID
        _check_token(), _can_manage(), coffee_telegram_chats()
  coffeearchive($subentity_id)       the scope's past runs
  coffeerun($run_id)                 one past run: the report and each section's raw data
  coffeecron($key)                   for the server's scheduler (no login): sends every report that is due;
                                     $key must equal COFFEE_CRON_KEY in .env
        coffee_due_reports(), coffee_run($id, 'scheduled')
  _my_email()
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
        if(strcasecmp(segment(2), 'coffeecron') === 0){
            return; // the scheduler has no login; coffeecron() checks its own key
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
/*---------------------------- function COFFEE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function coffee(){ // the Daily Coffee Reports this person may see

    $all = $this->_can_view_all();
    $own = (int) ($_SESSION['ccmps_subentity'] ?? 0);
    if(!$all && !$this->_can_manage($own)){
        set_flashdata('You are not authorized to set up the Coffee Report.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($this->_home_url());
    }

    $scopes = $all ? array(0 => $this->_scope_name(0)) + $this->_chapters() : array($own => $this->_scope_name($own));
    $saved  = array();
    foreach((array) $this->model->query("SELECT * FROM coffee_reports", 'object') as $r){
        $saved[(int) $r->subentity_id] = $r;
    }
    $last = array();
    foreach((array) $this->model->query("SELECT r.* FROM coffee_runs r JOIN (SELECT subentity_id, MAX(id) AS id FROM coffee_runs WHERE kind != 'preview' GROUP BY subentity_id) x ON x.id = r.id", 'object') as $r){
        $last[(int) $r->subentity_id] = $r;
    }
    $rows = array();
    foreach($scopes as $subentity_id => $name){
        $subentity_id = (int) $subentity_id;
        if($subentity_id > 0 && $all && !isset($saved[$subentity_id]) && !$this->_can_manage($subentity_id)){
            continue; // chapters that haven't set one up aren't listed for National
        }
        $rows[] = (object) array('subentity_id' => $subentity_id, 'name' => $name, 'report' => $saved[$subentity_id] ?? null,
                                 'last' => $last[$subentity_id] ?? null, 'can_manage' => $this->_can_manage($subentity_id),
                                 'ai' => (bool) _coffee_connection($subentity_id));
    }

    $data['rows']        = $rows;
    $data['home_url']    = $this->_home_url();
    $data['bc1']         = $all ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']         = 'Coffee Report';
    $data['header']      = 'Daily Coffee Report';
    $data['view_module'] = 'ai';
    $data['view_file']   = 'coffee';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------ function COFFEESETTINGS ---------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeesettings($subentity_id = NULL){

    $subentity_id = (int) ($subentity_id ?? segment(3));
    if(!$this->_can_manage($subentity_id)){
        set_flashdata('You are not authorized to set up that Coffee Report.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('ai/coffee');
    }

    $data['subentity_id'] = $subentity_id;
    $data['scope_name']   = $this->_scope_name($subentity_id);
    $data['config']       = coffee_config($subentity_id);
    $data['catalog']      = coffee_sections();
    $data['ai']           = (bool) _coffee_connection($subentity_id);
    $data['admins']       = count(coffee_scope_admin_emails($subentity_id));
    $data['admin_list']   = coffee_scope_admins($subentity_id); // by name, for the "Sent to" line
    $data['my_email']     = $this->_my_email(); // for the test's "To me" choice
    $data['list_recipients'] = coffee_list_recipients($data['config']); // the "Sent to" list as it will be sent, each address once
    $data['preview']      = $_SESSION['coffee_preview'] ?? null; // set by coffeepreview(), shown once
    unset($_SESSION['coffee_preview']);
    $data['token']        = $this->_token();
    $data['home_url']     = $this->_home_url();
    $data['bc1']          = $subentity_id === 0 ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']          = 'Coffee Report';
    $data['header']       = 'Coffee Report: '.$data['scope_name'];
    $data['view_module']  = 'ai';
    $data['view_file']    = 'coffeesettings';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*------------------------- function COFFEESUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeesubmit(){

    $subentity_id = (int) post('subentity_id');
    $back = 'ai/coffeesettings/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/coffee');
    }

    $catalog = coffee_sections();
    $errors  = array();

    $time = (string) post('send_time', true);
    if(!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $time)){
        $errors[] = 'Choose a send time.';
    }
    $tz = (string) post('timezone', true);
    if(!in_array($tz, DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US'), true) && $tz !== 'UTC'){
        $errors[] = 'Choose a time zone from the list.';
    }
    $days = array_values(array_intersect(array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'), (array) ($_POST['days'] ?? array())));
    $subject = trim((string) post('subject', true));
    if($subject === '' || strlen($subject) > 150){
        $errors[] = 'The email subject is required (150 characters at most).';
    }
    $tg_token = trim((string) ($_POST['telegram_token'] ?? '')); // not cleaned: the token's characters must stay as they are
    $tg_chat  = trim((string) post('telegram_chat_id', true));
    if($tg_token !== '' && !preg_match('/^\d{5,15}:[A-Za-z0-9_-]{30,50}$/', $tg_token)){
        $errors[] = 'That doesn\'t look like a Telegram bot token (it looks like 123456789:ABC...). Copy it again from @BotFather.';
    }
    if($tg_chat !== '' && !preg_match('/^(-?\d{4,20}|@[A-Za-z][A-Za-z0-9_]{4,31})$/', $tg_chat)){
        $errors[] = 'The Telegram chat ID is a number (groups start with -), or @channelname.';
    }
    $extra = array();
    foreach(_coffee_lines((string) ($_POST['extra_recipients'] ?? '')) as $line){
        if(filter_var($line, FILTER_VALIDATE_EMAIL)){ $extra[] = $line; } else { $errors[] = 'Not an email address: '.out($line).'.'; }
    }

    // sections in the order given by their position boxes
    $order = (array) ($_POST['section_order'] ?? array());
    $sections = array();
    foreach($catalog as $key => $section){
        $options = array();
        foreach($section['options'] as $name => $option){
            $options[$name] = substr(trim((string) ($_POST['opt_'.$key.'_'.$name] ?? '')), 0, 2000);
        }
        $sections[] = array('key' => $key, 'on' => !empty($_POST['section_on'][$key]), 'options' => $options, 'pos' => (int) ($order[$key] ?? 99));
    }
    usort($sections, function($a, $b){ return $a['pos'] <=> $b['pos']; });
    foreach($sections as &$sec){ unset($sec['pos']); }
    unset($sec);

    if(!empty($errors)){
        set_flashdata(implode(' ', $errors));
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }

    $record = array('enabled' => post('enabled') == 1 ? 1 : 0, 'send_time' => $time, 'timezone' => $tz, 'days' => implode(',', $days),
                    'subject' => $subject, 'tone' => substr(trim((string) post('tone', true)), 0, 500), 'sections' => json_encode($sections),
                    'send_to_admins' => post('send_to_admins') == 1 ? 1 : 0, 'extra_recipients' => implode("\n", $extra),
                    'telegram_enabled' => post('telegram_enabled') == 1 ? 1 : 0, 'telegram_chat_id' => $tg_chat,
                    'updated_by' => (int) ($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time());
    if($tg_token !== ''){
        $record['telegram_token_enc']  = vault_encrypt($tg_token);
        $record['telegram_token_hint'] = vault_hint($tg_token);
    }elseif(post('telegram_remove') == 1){
        $record['telegram_token_enc'] = NULL; $record['telegram_token_hint'] = NULL; $record['telegram_enabled'] = 0;
    }
    $existing = $this->model->query_bind('SELECT id FROM coffee_reports WHERE subentity_id = :s', array('s' => $subentity_id), 'object');
    if(!empty($existing)){
        $this->model->update((int) $existing[0]->id, $record, 'coffee_reports');
    }else{
        $record['subentity_id'] = $subentity_id;
        $record['created_by'] = $record['updated_by'];
        $record['created_at'] = time();
        $this->model->insert($record, 'coffee_reports');
    }
    $on = implode(', ', array_map(function($s) use ($catalog){ return $catalog[$s['key']]['label']; }, array_filter($sections, function($s){ return $s['on']; })));
    $this->_audit('SaveCoffeeReport', $subentity_id, ($record['enabled'] ? 'on' : 'off').', '.$time.' '.$tz.' '.$record['days'].'; sections: '.$on
                  .'; Telegram '.($record['telegram_enabled'] ? 'on' : 'off').($tg_token !== '' ? ', new bot token ending '.$record['telegram_token_hint'] : '').(post('telegram_remove') == 1 && $tg_token === '' ? ', bot token removed' : ''));

    set_flashdata('Saved.'.($record['enabled'] ? '' : ' The report is switched off; switch it on to have it sent.'));
    $_SESSION['flashmsgcolor'] = 1;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*------------------------- function COFFEEPREVIEW ---------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeepreview(){ // today's report, shown on the settings page; nothing is sent

    $subentity_id = (int) post('subentity_id');
    $back = 'ai/coffeesettings/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/coffee');
    }
    set_time_limit(180);
    $run = coffee_run($subentity_id, 'preview');
    $_SESSION['coffee_preview'] = array('text' => $run->report_text, 'ai' => $run->ai_used, 'message' => $run->message);
    redirect($back.'#preview');
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function COFFEETEST ----------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeetest(){ // build it and email it: to the person asking, or to everyone on the "Sent to" list (2026-10-29)

    $subentity_id = (int) post('subentity_id');
    $back = 'ai/coffeesettings/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/coffee');
    }
    $email = $this->_my_email();
    if(post('test_to') === 'list'){
        $to   = null; // coffee_run() uses the saved "Sent to" list: the scope's admins (if ticked) and the extra addresses
        $note = 'Sent to the "Sent to" list. ';
    }else{
        if($email === ''){
            set_flashdata('Your account has no email address. Choose "To everyone on the Sent to list", or add an email address to your profile.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($back);
        }
        $to   = array($email);
        $note = '';
    }
    set_time_limit(180);
    $run = coffee_run($subentity_id, 'test', $to, array('email'));
    $this->_audit('TestCoffeeReport', $subentity_id, $run->status.($run->message ? ': '.$run->message : ''));
    set_flashdata($run->recipients > 0 ? 'Test sent. '.$note.$run->message : 'The test was not sent. '.$note.$run->message);
    $_SESSION['flashmsgcolor'] = $run->recipients > 0 ? 1 : 0;
    redirect($back);
  }

/*----------------------------------------------------------------------------*/
/*---------------------- function COFFEETELEGRAMTEST -------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeetelegramtest(){ // build it and send it to the scope's Telegram chat

    $subentity_id = (int) post('subentity_id');
    $back = 'ai/coffeesettings/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/coffee');
    }
    $config = coffee_config($subentity_id);
    if(empty($config->telegram_enabled) || empty($config->telegram_token_enc) || trim((string) $config->telegram_chat_id) === ''){
        set_flashdata('Switch Telegram on and save a bot token and chat ID first.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back.'#telegram');
    }
    set_time_limit(180);
    $run = coffee_run($subentity_id, 'test', null, array('telegram'));
    $this->_audit('TestCoffeeTelegram', $subentity_id, $run->status.($run->message ? ': '.$run->message : ''));
    set_flashdata($run->telegram_sent ? 'Telegram test sent. '.$run->message : 'The Telegram test was not sent. '.$run->message);
    $_SESSION['flashmsgcolor'] = $run->telegram_sent ? 1 : 0;
    redirect($back.'#telegram');
  }

/*----------------------------------------------------------------------------*/
/*--------------------- function COFFEETELEGRAMCHATS -------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeetelegramchats(){ // who has messaged the bot: shows chat IDs to copy

    $subentity_id = (int) post('subentity_id');
    $back = 'ai/coffeesettings/'.$subentity_id;
    $this->_check_token($back);
    if(!$this->_can_manage($subentity_id)){
        redirect('ai/coffee');
    }
    $config = coffee_config($subentity_id);
    $token  = vault_decrypt($config->telegram_token_enc ?? null);
    if($token === ''){
        set_flashdata('Save the bot token first.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back.'#telegram');
    }
    try{
        $chats = coffee_telegram_chats($token);
        if(empty($chats)){
            set_flashdata('No chats found. Send the bot a message (or add it to your group and post there), then click Find chat ID again.');
            $_SESSION['flashmsgcolor'] = 0;
        }else{
            $list = array();
            foreach($chats as $id => $name){ $list[] = $name.': '.$id; }
            set_flashdata('Chats that messaged the bot - copy the number into Chat ID: '.implode('; ', $list));
            $_SESSION['flashmsgcolor'] = 1;
        }
    }catch(Throwable $e){
        set_flashdata('Telegram: '.substr($e->getMessage(), 0, 150));
        $_SESSION['flashmsgcolor'] = 0;
    }
    redirect($back.'#telegram');
  }

/*----------------------------------------------------------------------------*/
/*------------------------ function COFFEEARCHIVE ----------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeearchive($subentity_id = NULL){

    $subentity_id = (int) ($subentity_id ?? segment(3));
    if(!$this->_can_manage($subentity_id) && !$this->_can_view_all()){
        redirect('ai/coffee');
    }
    $data['runs'] = $this->model->query_bind("SELECT id, kind, status, ai_used, recipients, telegram_sent, message, started_at, finished_at FROM coffee_runs
                                               WHERE subentity_id = :s AND kind != 'preview' ORDER BY id DESC LIMIT 60", array('s' => $subentity_id), 'object');
    $data['subentity_id'] = $subentity_id;
    $data['home_url']     = $this->_home_url();
    $data['bc1']          = $subentity_id === 0 ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']          = 'Coffee Report';
    $data['header']       = 'Sent Coffee Reports: '.$this->_scope_name($subentity_id);
    $data['view_module']  = 'ai';
    $data['view_file']    = 'coffeearchive';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function COFFEERUN -----------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeerun($run_id = NULL){

    $run = $this->model->get_where((int) ($run_id ?? segment(3)), 'coffee_runs');
    if(!$run || (!$this->_can_manage((int) $run->subentity_id) && !$this->_can_view_all())){
        redirect('ai/coffee');
    }
    $data['run']          = $run;
    $data['sections']     = json_decode((string) $run->sections_raw, true) ?: array();
    $data['home_url']     = $this->_home_url();
    $data['bc1']          = (int) $run->subentity_id === 0 ? 'System Admin' : SUBENTITY.' Admin';
    $data['bc2']          = 'Coffee Report';
    $data['header']       = 'Coffee Report of '.date('M j, Y g:ia', (int) $run->started_at);
    $data['view_module']  = 'ai';
    $data['view_file']    = 'coffeerun';
    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function COFFEECRON ----------------------------*/
/*----------------------------------------------------------------------------*/
  function coffeecron($key = NULL){ // called by the server's scheduler every 15 minutes; no login

    $expected = (string) env('COFFEE_CRON_KEY', '');
    $key      = (string) ($key ?? segment(3));
    header('Content-Type: text/plain; charset=utf-8');
    if($expected === '' || strlen($expected) < 24 || !hash_equals($expected, $key)){
        http_response_code(403);
        echo "Forbidden\n";
        return;
    }
    if(!rbac_module_enabled('ai')){
        echo "AI module off\n";
        return;
    }
    set_time_limit(900);
    $due = coffee_due_reports();
    foreach($due as $report){
        // mark first, so a slow run can't be started twice by the next call
        $this->model->update((int) $report->id, array('last_sent_on' => $report->local_date), 'coffee_reports');
        $run = coffee_run((int) $report->subentity_id, 'scheduled');
        echo $this->_scope_name((int) $report->subentity_id).': '.$run->status.', '.$run->recipients." sent\n";
    }
    echo count($due)." report(s) due\n";
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

    function _my_email(){ // the person asking: their member record's address (staff: their staff account's)
        if(!empty($_SESSION['ccmp_rec_id'])){
            $row = $this->model->get_where((int) $_SESSION['ccmp_rec_id'], 'ccmps');
            return $row ? trim((string) $row->email_address) : '';
        }
        if(!empty($_SESSION['honcho_user_rec_id'])){
            $row = $this->model->get_where((int) $_SESSION['honcho_user_rec_id'], 'honcho_user_accounts');
            return $row ? trim((string) ($row->email ?? $row->email_address ?? '')) : '';
        }
        return '';
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
