<?php

/*----------------------------------------------------------------------------*/
/*------------------------ module SYSTEM-SETTINGS ----------------------------*/
/*----------------------------------------------------------------------------*/

/*
  The System Settings screen: every row of system_settings, one tab per category.
  Rebuilt 2026-10-22 (Settings plan, phase 1). Each row names the system function
  needed to change it (system_settings.rbac_function):
      edit_financial_settings  Financial tab - Financial Admins and System Admins
      edit_settings            every other tab - System Admins
  System Admins (is_system_admin(): staff sysadmins with HONCHO_MODULE=1, member
  system admins with 0) may change every row. Anyone else sees only the tabs
  they may change, and a save is checked row by row on the server.
  Saving the current year or grace period re-checks every member's status
  (Ccmps::recalc_all_member_statuses()) after a confirmation page.
  Phase 2 (2026-10-22) added the Organization, Wording, Features & Policy and Look
  tabs: config.php defines those constants with setting() (config/settings.php),
  so a change shows on the next page.

  __construct()
        system_admin_only('system-settings', 'edit_financial_settings')
  manage($tab)
        _check_function_permissions('manage')
        _get_font_sizes()
        _get_rows()
        _tabs($rows)
        _token()
        _home_url()
  settingssubmit($tab)
        _check_function_permissions('manage')
        _check_token()
        _get_rows()
        _can_change($row)
        _validate($row, $value)
        _needs_recheck($changes, $rows)
        _members_to_recheck()
        _save_changes($changes, $rows)
        _recheck_member_statuses()
  confirmsettings()
        _check_function_permissions('manage')
        _check_token()
        _get_rows()
        _can_change($row)
        _save_changes($changes, $rows)
        _recheck_member_statuses()
  _get_rows()
  _tabs($rows)
  _slug($category)
  _can_change($row)
  _validate($row, $value)
  _needs_recheck($changes, $rows)
  _members_to_recheck()
  _save_changes($changes, $rows)
        _audit()
  _recheck_member_statuses()
  _home_url()
  _token()
  _check_token()
  _audit($action, $title, $old, $new)
  _check_function_permissions($settingsfunction)
  _get_font_sizes()
*/

/* system_settings (one row per setting; code reads it with setting('<title>')):
       id                (auto increment) - rows 1 and 2 are the current year and grace period,
                         the ids the staff login (Honcho.php) still reads
       title             (varchar 255)  the name code uses, unique
       label             (varchar 100)  the name on the screen
       settingvalue      (varchar 255)
       type              (varchar 255)  old column, not used by the screen
       category          (varchar 32)   the screen's tab: Financial, DMS, ...
       input_type        (varchar 16)   text, yesno, year, number, fraction (0 to 1), url, phone, select
       options           (varchar 255)  select choices, value=Label;value=Label; for number a range, e.g. 6-64
       rbac_function     (varchar 64)   system function needed to change it
       description, help (varchar 255)  help is shown under the input
       sort_order        (int)
       created_by, created_at, updated_by, updated_at
   New rows come in with migrations, not on this screen: a setting does nothing until code reads it.
*/

/*----------------------------------------------------------------------------*/

class Settings extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

  // System Admins, and anyone with system/edit_financial_settings (Financial Admins).
  // Internal calls from other modules are not checked.
  function __construct(?string $module_name = null){
    parent::__construct($module_name);
    system_admin_only('system-settings', 'edit_financial_settings');
  }

  function _construct(){
    $this->parent_module = 'system';
    $this->child_module  = 'settings';
  }

  function _destruct(){
    $this->parent_module = '';
    $this->child_module  = '';
  }

  function index() {
    redirect('system-settings/manage');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage($tab = NULL){ // the tabs this person may change; one tab's settings as a form

    $settingsfunction = 'manage';
    $authorized = $this->_check_function_permissions($settingsfunction);

    // Get font size preference for views & manage page
    $this->_get_font_sizes();

    $rows = $this->_get_rows();
    $tabs = $this->_tabs($rows);

    if(empty($tabs)){ // e.g. a Financial Admin group switched off
        set_flashdata('You are not authorized to change any settings.');
        $_SESSION['flashmsgcolor'] = 0; // crimson
        redirect($this->_home_url());
    }

    $tab = (string) ($tab ?? segment(3));
    if(!isset($tabs[$tab])){
        $tab = array_key_first($tabs);
    }

    $data['tabs']     = $tabs;
    $data['tab']      = $tab;
    $data['settings'] = array();
    foreach($rows as $row){
        if($this->_slug($row->category) == $tab && $this->_can_change($row)){
            $data['settings'][] = $row;
        }
    }

    $data['view_module'] = 'system/settings';
    $data['view_file']   = 'manage';

    $data['token']    = $this->_token();
    $data['home_url'] = $this->_home_url();

    $data['bc1']      = is_system_admin() ? 'System Admin' : 'Financial Admin';
    $data['bc2']      = 'System Settings';
    $data['header']   = 'System Settings';

    $this->templates->inspinia($data);
  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- function SETTINGSSUBMIT --------------------------*/
/*----------------------------------------------------------------------------*/
  function settingssubmit($tab = NULL){ // saves one tab; asks first when member statuses will be re-checked

    $settingsfunction = 'manage';
    $authorized = $this->_check_function_permissions($settingsfunction);
    $this->_check_token();

    $tab  = (string) ($tab ?? segment(3));
    $rows = $this->_get_rows();

    $changes = array(); // id => new value
    $errors  = array();
    foreach($rows as $row){
        if($this->_slug($row->category) != $tab || !$this->_can_change($row)){
            continue; // other tabs, and rows this person may not change, are never read from the post
        }
        $value = trim((string) post('setting_'.$row->id));
        $error = $this->_validate($row, $value);
        if($error !== ''){
            $errors[] = $error;
            continue;
        }
        if($value !== (string) $row->settingvalue){
            $changes[$row->id] = $value;
        }
    }

    if(!empty($errors)){
        set_flashdata('Nothing was saved. '.implode(' ', array_unique($errors)));
        $_SESSION['flashmsgcolor'] = 0; // crimson
        redirect('system-settings/manage/'.$tab);
    }

    if(empty($changes)){
        set_flashdata('No changes to save.');
        $_SESSION['flashmsgcolor'] = 1;
        redirect('system-settings/manage/'.$tab);
    }

    if($this->_needs_recheck($changes, $rows)){ // show what will happen, save on confirm
        $_SESSION['settings_pending'] = array('tab' => $tab, 'changes' => $changes);

        $data['changes'] = array();
        foreach($rows as $row){
            if(isset($changes[$row->id])){
                $data['changes'][] = (object) array('label' => $row->label ?: $row->title, 'input_type' => $row->input_type,
                                                    'old' => $row->settingvalue, 'new' => $changes[$row->id]);
            }
        }
        $data['members']  = $this->_members_to_recheck();
        $data['tab']      = $tab;
        $data['token']    = $this->_token();
        $data['home_url'] = $this->_home_url();

        $this->_get_font_sizes();
        $data['view_module'] = 'system/settings';
        $data['view_file']   = 'confirm';
        $data['bc1']    = is_system_admin() ? 'System Admin' : 'Financial Admin';
        $data['bc2']    = 'Confirm Settings';
        $data['header'] = 'Confirm Settings';
        $this->templates->inspinia($data);
        return;
    }

    $this->_save_changes($changes, $rows);
    set_flashdata(count($changes) == 1 ? '1 setting saved.' : count($changes).' settings saved.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-settings/manage/'.$tab);
  }

/*---------------------- End function settingssubmit -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function CONFIRMSETTINGS --------------------------*/
/*----------------------------------------------------------------------------*/
  function confirmsettings(){ // the confirmation page's Save: save, then re-check every member's status

    $settingsfunction = 'manage';
    $authorized = $this->_check_function_permissions($settingsfunction);
    $this->_check_token();

    $pending = $_SESSION['settings_pending'] ?? null;
    unset($_SESSION['settings_pending']);
    if(empty($pending['changes'])){
        set_flashdata('Nothing to save - the page had expired. Please make the change again.');
        $_SESSION['flashmsgcolor'] = 0; // crimson
        redirect('system-settings/manage');
    }

    $rows    = $this->_get_rows();
    $changes = array();
    foreach($rows as $row){ // checked again: the permission could have changed in between
        if(isset($pending['changes'][$row->id]) && $this->_can_change($row)){
            $changes[$row->id] = $pending['changes'][$row->id];
        }
    }

    $this->_save_changes($changes, $rows);
    $changed = $this->_recheck_member_statuses();

    $msg = (count($changes) == 1 ? '1 setting saved. ' : count($changes).' settings saved. ');
    $msg .= ($changed == 1 ? '1 '.strtolower(CCMP)."'s status changed." : $changed.' '.strtolower(CCMPS)."' status changed.");
    set_flashdata($msg);
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-settings/manage/'.$pending['tab']);
  }

/*---------------------- End function confirmsettings ------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------------ SMALL HELPERS -------------------------------*/
/*----------------------------------------------------------------------------*/

    function _get_rows(){ // every setting, in screen order
        return (array) $this->model->query("SELECT * FROM system_settings ORDER BY category, sort_order, id", 'object');
    }

    function _tabs($rows){ // slug => tab name, for the categories holding a row this person may change
        $order = array('Financial', 'Organization', 'Wording', 'Look', 'Features & Policy', 'DMS', 'General');
        $tabs  = array();
        foreach($rows as $row){
            if($this->_can_change($row)){
                $tabs[$this->_slug($row->category)] = $row->category;
            }
        }
        uasort($tabs, function($a, $b) use ($order){
            $ia = array_search($a, $order); $ib = array_search($b, $order);
            return ($ia === false ? 99 : $ia) <=> ($ib === false ? 99 : $ib) ?: strcmp($a, $b);
        });
        return $tabs;
    }

    function _slug($category){ // 'Features & Policy' -> 'features-policy', for the URL
        return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower((string) $category)), '-');
    }

    function _can_change($row){ // System Admins change every row; others need the row's function
        return is_system_admin() || rbac_allowed('system', (string) $row->rbac_function);
    }

    function _validate($row, $value){ // '' when the value is fine, else what's wrong
        $label = $row->label ?: $row->title;
        switch($row->input_type){
            case 'yesno':
                return in_array($value, array('0', '1'), true) ? '' : $label.' must be On or Off.';
            case 'year':
                return (ctype_digit($value) && (int) $value >= 2000 && (int) $value <= 2100) ? '' : $label.' must be a year, e.g. '.date('Y').'.';
            case 'number': // options can give a range, e.g. '6-64'
                if(!preg_match('/^-?\d+$/', $value)){ return $label.' must be a whole number.'; }
                if(preg_match('/^(-?\d+)-(-?\d+)$/', (string) $row->options, $range) && ((int) $value < (int) $range[1] || (int) $value > (int) $range[2])){
                    return $label.' must be from '.$range[1].' to '.$range[2].'.';
                }
                return '';
            case 'url': // blank, '#' (none) or a full web address
                if($value === '' || $value === '#'){ return ''; }
                return (filter_var($value, FILTER_VALIDATE_URL) && preg_match('#^https?://#i', $value)) ? '' : $label.' must be a full web address starting with https://, or blank.';
            case 'phone':
                return ($value === '' || preg_match('/^[0-9 ().+\-]{7,25}$/', $value)) ? '' : $label.' must be a phone number (digits, spaces, dots, dashes).';
            case 'fraction':
                return (is_numeric($value) && (float) $value >= 0 && (float) $value <= 1) ? '' : $label.' must be a number from 0 to 1, e.g. 0.75.';
            case 'select':
                foreach(explode(';', (string) $row->options) as $option){
                    if(trim(explode('=', $option)[0]) === $value){ return ''; }
                }
                return $label.': choose one of the listed values.';
            default: // text - shown straight into pages, so no < or >
                if($value === ''){ return $label.' can\'t be blank.'; }
                if(strpbrk($value, '<>') !== false){ return $label.' can\'t contain the less-than or greater-than sign.'; }
                return mb_strlen($value) <= 255 ? '' : $label.' is too long (255 characters at most).';
        }
    }

    function _needs_recheck($changes, $rows){ // does the change move members between Current / Past Due / Expired?
        foreach($rows as $row){
            if(isset($changes[$row->id]) && in_array($row->title, array('system_current_year', 'grace_period'))){
                return true;
            }
        }
        return false;
    }

    function _members_to_recheck(){ // the members recalc_all_member_statuses() goes through
        $rows = $this->model->query("SELECT COUNT(*) AS n FROM ccmps WHERE deceased != 1 AND soft_deleted != 1", 'object');
        return !empty($rows) ? (int) $rows[0]->n : 0;
    }

    function _save_changes($changes, $rows){ // one update and one Auditlog entry per changed row
        $by = (int) ($_SESSION['tg_user_id'] ?? 0);
        foreach($rows as $row){
            if(!isset($changes[$row->id])){
                continue;
            }
            $this->model->update($row->id, array('settingvalue' => $changes[$row->id], 'updated_by' => $by, 'updated_at' => time()), 'system_settings');
            $this->_audit('UpdateSetting', $row->title, $row->settingvalue, $changes[$row->id]);
        }
        setting('system_current_year', null, true); // read the table again for the rest of this page

        // the person saving sees the new year and grace period straight away; everyone else at next login
        $_SESSION['system_current_year'] = $_SESSION['ccmps_current_year'] = intval(setting('system_current_year', 0));
        $_SESSION['system_grace_period'] = $_SESSION['ccmps_grace_period'] = intval(setting('grace_period', 0));
    }

    function _recheck_member_statuses(){ // re-runs every member's status; returns how many changed
        $before = array();
        foreach((array) $this->model->query("SELECT id, status FROM ccmps", 'object') as $row){
            $before[$row->id] = (int) $row->status;
        }

        $this->module('welcome-ccmps');
        $this->ccmps->recalc_all_member_statuses();

        $changed = 0;
        foreach((array) $this->model->query("SELECT id, status FROM ccmps", 'object') as $row){
            if(($before[$row->id] ?? null) !== (int) $row->status){
                $changed++;
            }
        }
        $this->_audit('RecheckMemberStatuses', 'ccmps.status', '', $changed.' changed');
        return $changed;
    }

    function _home_url(){ // where Home and Close go: staff dashboard or member home
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _token(){ // ties the forms to this session
        if(empty($_SESSION['settings_token'])){
            $_SESSION['settings_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['settings_token'];
    }

    function _check_token(){ // every save is a POST from this screen
        if(REQUEST_TYPE != 'POST' || empty($_SESSION['settings_token']) || !hash_equals($_SESSION['settings_token'], (string) post('token'))){
            set_flashdata('The page had expired - nothing was saved. Please try again.');
            $_SESSION['flashmsgcolor'] = 0; // crimson
            redirect('system-settings/manage');
        }
    }

    function _audit($action, $title, $old, $new){
        $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', $action, 'system-settings', $un, $time, 'Setting: '.$title, 'Old: '.$old, 'New: '.$new, 'Tbl: system_settings');
    }

/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($settingsfunction) {
    // protected - private function
    // who may open the screen is checked in __construct(); here: still logged in.
    // Which rows they may change is _can_change().

        switch($settingsfunction) {

          case 'manage': //

if(!empty($_SESSION['trongatetoken'])){ // logged in
                    $data = "goodtogo";
                    return $data;
}else{ // not logged in at all - send to login form

        set_flashdata('Your Session has expired - please login again.');
        $_SESSION['flashmsgcolor'] = 0; // crimson

    redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout'); // clears everything then takes to login page

}

          break;

        }
    }

/*----------------------- End _check_function_permissions --------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function _GET_FONT_SIZES ---------------------*/
/*----------------------------------------------------------------------------*/

    function _get_font_sizes() {
    // protected - private function
    // Reuses the ccmp's fontsize preferences, same as the parent Ccmps module

if(!empty($_SESSION['ccmp_rec_id'])){
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id, 'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize ?? '';  // view pages
    $_SESSION['tfontsize']      = $ccmp_obj->tfontsize ?? ''; // tables
}

         switch($_SESSION['fontsize'] ?? '') {
          case '1':
                 $_SESSION['fontsize'] = 'Large';
          break;
          case '2':
                 $_SESSION['fontsize'] = 'Medium';
          break;
          case '3':
                 $_SESSION['fontsize'] = 'Small';
          break;
        }

          switch($_SESSION['tfontsize'] ?? '') {
          case '1':
                 $_SESSION['tfontsize'] = 'Large';
          break;
          case '2':
                 $_SESSION['tfontsize'] = 'Medium';
          break;
          case '3':
                 $_SESSION['tfontsize'] = 'Small';
          break;
        }

    return;
    }
/*------------------------- End _get_font_sizes ------------------------------*/


} // end controller
