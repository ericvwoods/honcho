<?php

/*----------------------------------------------------------------------------*/
/*------------------------- module SYSTEM-RBAC -------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  __construct()                  system_admin_only() - same rule as System Settings / Auditlog
  manage()                       groups list (+ pick a person for effective access)
        _get_font_sizes()
        _people()
        _token()
  creategroup()                  blank group form
        _show_group_form()
  updategroup()                  group form for segment(3)
        _get_group()
        _show_group_form()
  groupsubmit()                  POST - insert or update a group
        _check_token()
        _audit()
  togglemodule()                 POST - switch an add-on module on / off
        _check_token()
        _audit()
  togglegroup()                  POST - deactivate / reactivate a group
        _check_token()
        _get_group()
        _audit()
  privileges()                   checkbox grid of functions for group segment(3)
        _get_group()
        _enabled_functions()
  privilegessubmit()             POST - saves the grid (adds and removes)
        _check_token()
        _get_group()
        _enabled_functions()
        _audit()
  members()                      people in group segment(3), add / remove
        _get_group()
        _people()
  addmember()                    POST
        _check_token()
        _get_group()
        _audit()
  removemember()                 POST
        _check_token()
        _get_group()
        _audit()
  person()                       effective access for tg user segment(3) - changes nothing
        _people()
  _sync_member()                 member login's roles -> ccmps columns (rbac_sync_member_columns)
  _get_group()
  _enabled_functions()
  _people()
  _token()
  _check_token()
  _audit()
  _page()
  _get_font_sizes()
*/

/* The Security screens of the shared permission system (Honcho RBAC plan,
   approved 2026-10-18). Tables: system_modules, system_functions,
   system_groups, system_group_functions, system_group_users.
   Module code asks rbac_allowed() / rbac_require() (engine/tg_helpers/rbac_helper.php).
   Who may open these screens: staff sysadmins when Honcho is deployed,
   member system admins in Honcho Lite (HONCHO_MODULE) - system_admin_only(). */

/*----------------------------------------------------------------------------*/

class Rbac extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function __construct(?string $module_name = null){
      parent::__construct($module_name);
      system_admin_only('system-rbac');
    }

    function _construct(){
      $this->parent_module = 'system';
      $this->child_module  = 'rbac';
    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module  = '';
    }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // list of security groups

    $sql = "SELECT g.id, g.title, g.description, g.active,
                   (SELECT COUNT(*) FROM system_group_functions gf WHERE gf.group_id = g.id) AS nfunctions,
                   (SELECT COUNT(*) FROM system_group_users gu     WHERE gu.group_id = g.id) AS npeople
              FROM system_groups g
             ORDER BY g.active DESC, g.title";

    $data['grouprecs'] = $this->model->query($sql, 'object');
    $data['people']    = $this->_people();
    $data['modules']   = $this->model->query("SELECT id, code, title, is_addon, enabled FROM system_modules ORDER BY sort_order", 'object');

    $data['header']    = 'Security Groups';
    $data['bc2']       = 'Groups';
    $this->_page($data, 'manage');
  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function CREATEGROUP / UPDATEGROUP ----------------*/
/*----------------------------------------------------------------------------*/
  function creategroup(){
    $group = new stdClass();
    $group->id = 0; $group->title = ''; $group->description = ''; $group->active = 1;
    $this->_show_group_form($group);
  }

  function updategroup(){
    $group = $this->_get_group(segment(3, 'int'));
    $this->_show_group_form($group);
  }

  function _show_group_form($group){
    $data['group']  = $group;
    $data['header'] = $group->id ? 'Edit Security Group' : 'New Security Group';
    $data['bc2']    = $data['header'];
    $this->_page($data, 'groupcrud');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function GROUPSUBMIT --------------------------*/
/*----------------------------------------------------------------------------*/
  function groupsubmit(){ // POST from groupcrud
    $this->_check_token();

    $id          = intval(post('id'));
    $title       = trim((string) post('title', true));
    $description = trim((string) post('description', true));

    $back = $id ? 'system-rbac/updategroup/'.$id : 'system-rbac/creategroup';

    if($title == '' || strlen($title) > 100){
        set_flashdata('Enter a group name (up to 100 characters).');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }

    // names must be unique
    $dupe = $this->model->query_bind("SELECT id FROM system_groups WHERE title = :title AND id != :id",
                                     array('title' => $title, 'id' => $id), 'object');
    if(!empty($dupe)){
        set_flashdata('There is already a group called '.out($title).'.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }

    $updata['title']       = $title;
    $updata['description'] = substr($description, 0, 255);
    $updata['updated_by']  = intval($_SESSION['tg_user_id'] ?? 0);
    $updata['updated_at']  = time();

    if($id){
        $this->_get_group($id); // must exist
        $this->model->update($id, $updata, 'system_groups');
        $this->_audit('update', 'UpdateGroup', 'rbac-groupsubmit', $id, 'system_groups', 'Group: '.$title);
    }else{
        $updata['active']     = 1;
        $updata['created_by'] = $updata['updated_by'];
        $updata['created_at'] = $updata['updated_at'];
        $id = $this->model->insert($updata, 'system_groups');
        $this->_audit('insert', 'CreateGroup', 'rbac-groupsubmit', $id, 'system_groups', 'Group: '.$title);
    }

    set_flashdata('Group '.out($title).' saved.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/manage');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function TOGGLEMODULE -------------------------*/
/*----------------------------------------------------------------------------*/
  function togglemodule(){ // POST from manage - a switched-off module fails every check (its menu items go too)
    $this->_check_token();
    $module = $this->model->get_where(intval(post('module_id')), 'system_modules');

    // only add-ons; Honcho itself is switched by HONCHO_MODULE in .env
    if(!$module || intval($module->is_addon) != 1 || $module->code == 'honcho'){
        set_flashdata('That module can not be switched off here.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('system-rbac/manage');
    }

    $updata['enabled']    = $module->enabled ? 0 : 1;
    $updata['updated_by'] = intval($_SESSION['tg_user_id'] ?? 0);
    $updata['updated_at'] = time();
    $this->model->update($module->id, $updata, 'system_modules');

    $action = $updata['enabled'] ? 'EnableModule' : 'DisableModule';
    $this->_audit('update', $action, 'rbac-togglemodule', $module->id, 'system_modules', 'Module: '.$module->title);

    set_flashdata(out($module->title).($updata['enabled'] ? ' switched on.' : ' switched off.'));
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/manage');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function TOGGLEGROUP --------------------------*/
/*----------------------------------------------------------------------------*/
  function togglegroup(){ // POST from manage - an inactive group gives nothing but keeps its settings
    $this->_check_token();
    $group = $this->_get_group(intval(post('group_id')));

    $updata['active']     = $group->active ? 0 : 1;
    $updata['updated_by'] = intval($_SESSION['tg_user_id'] ?? 0);
    $updata['updated_at'] = time();
    $this->model->update($group->id, $updata, 'system_groups');
    rbac_sync_group_members($group->id); // member admin roles: keep the ccmps columns in step

    $action = $updata['active'] ? 'ActivateGroup' : 'DeactivateGroup';
    $this->_audit('update', $action, 'rbac-togglegroup', $group->id, 'system_groups', 'Group: '.$group->title);

    set_flashdata('Group '.out($group->title).($updata['active'] ? ' reactivated.' : ' deactivated.'));
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/manage');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function PRIVILEGES ---------------------------*/
/*----------------------------------------------------------------------------*/
  function privileges(){ // tick the functions this group may use, one section per module
    $group = $this->_get_group(segment(3, 'int'));

    $ticked = array();
    $rows = $this->model->query_bind("SELECT function_id FROM system_group_functions WHERE group_id = :gid",
                                     array('gid' => $group->id), 'object');
    foreach($rows as $row){ $ticked[$row->function_id] = true; }

    // group the functions by module for the view
    $modules = array();
    foreach($this->_enabled_functions() as $f){
        $modules[$f->module_code]['title']       = $f->module_title;
        $modules[$f->module_code]['functions'][] = $f;
    }

    $data['group']   = $group;
    $data['modules'] = $modules;
    $data['ticked']  = $ticked;
    $data['header']  = 'Privileges: '.$group->title;
    $data['bc2']     = 'Group privileges';
    $this->_page($data, 'privileges');
  }

/*----------------------------------------------------------------------------*/
/*------------------------- function PRIVILEGESSUBMIT ------------------------*/
/*----------------------------------------------------------------------------*/
  function privilegessubmit(){ // POST from privileges - the boxes as they are now
    $this->_check_token();
    $group = $this->_get_group(intval(post('group_id')));

    $enabled = array(); // only functions of switched-on modules can be set here
    foreach($this->_enabled_functions() as $f){ $enabled[(int) $f->id] = $f->module_code.'/'.$f->code; }

    $wanted = array();
    foreach((array) ($_POST['functions'] ?? array()) as $fid){
        $fid = intval($fid);
        if(isset($enabled[$fid])){ $wanted[$fid] = true; }
    }

    $current = array();
    $rows = $this->model->query_bind("SELECT function_id FROM system_group_functions WHERE group_id = :gid",
                                     array('gid' => $group->id), 'object');
    foreach($rows as $row){
        if(isset($enabled[(int) $row->function_id])){ $current[(int) $row->function_id] = true; } // leave switched-off modules' ticks alone
    }

    $added = array_diff_key($wanted, $current);
    $removed = array_diff_key($current, $wanted);

    $me = intval($_SESSION['tg_user_id'] ?? 0);
    foreach(array_keys($added) as $fid){
        $this->model->insert(array('group_id' => $group->id, 'function_id' => $fid, 'created_by' => $me, 'created_at' => time()), 'system_group_functions');
    }
    foreach(array_keys($removed) as $fid){
        $this->model->query_bind("DELETE FROM system_group_functions WHERE group_id = :gid AND function_id = :fid",
                                 array('gid' => $group->id, 'fid' => $fid));
    }

    if($added || $removed){
        rbac_sync_group_members($group->id); // member admin roles: keep the ccmps columns in step
        $addlist = implode(', ', array_intersect_key($enabled, $added));
        $remlist = implode(', ', array_intersect_key($enabled, $removed));
        $this->_audit('update', 'SetGroupPrivileges', 'rbac-privilegessubmit', $group->id, 'system_groups',
                      'Group: '.$group->title, substr('Added: '.($addlist ?: 'none').' | Removed: '.($remlist ?: 'none'), 0, 250));
        set_flashdata('Privileges saved: '.count($added).' added, '.count($removed).' removed.');
    }else{
        set_flashdata('No changes.');
    }
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/privileges/'.$group->id);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MEMBERS ------------------------------*/
/*----------------------------------------------------------------------------*/
  function members(){ // people in a group
    $group = $this->_get_group(segment(3, 'int'));

    $ingroup = array();
    $rows = $this->model->query_bind("SELECT tg_user_id FROM system_group_users WHERE group_id = :gid",
                                     array('gid' => $group->id), 'object');
    foreach($rows as $row){ $ingroup[(int) $row->tg_user_id] = true; }

    $members = array(); $others = array();
    foreach($this->_people() as $p){
        if(isset($ingroup[(int) $p->id])){ $members[] = $p; } else { $others[] = $p; }
    }

    $data['group']   = $group;
    $data['members'] = $members;
    $data['others']  = $others;
    $data['header']  = 'Members: '.$group->title;
    $data['bc2']     = 'Group members';
    $this->_page($data, 'members');
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function ADDMEMBER / REMOVEMEMBER -------------*/
/*----------------------------------------------------------------------------*/
  function addmember(){ // POST from members
    $this->_check_token();
    $group = $this->_get_group(intval(post('group_id')));
    $tg_user_id = intval(post('tg_user_id'));

    $person = rbac_person($tg_user_id);
    if(!$person){
        set_flashdata('Pick a person to add.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('system-rbac/members/'.$group->id);
    }

    $exists = $this->model->query_bind("SELECT id FROM system_group_users WHERE group_id = :gid AND tg_user_id = :uid",
                                       array('gid' => $group->id, 'uid' => $tg_user_id), 'object');
    if(empty($exists)){
        $this->model->insert(array('group_id' => $group->id, 'tg_user_id' => $tg_user_id,
                                   'created_by' => intval($_SESSION['tg_user_id'] ?? 0), 'created_at' => time()), 'system_group_users');
        $this->_audit('insert', 'AddGroupMember', 'rbac-addmember', $group->id, 'system_group_users',
                      'Group: '.$group->title, 'Person: '.$person->name.' ('.$person->kind.', TGUID '.$tg_user_id.')');
        $this->_sync_member($tg_user_id);
    }

    set_flashdata(out($person->name).' added to '.out($group->title).'.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/members/'.$group->id);
  }

  function removemember(){ // POST from members
    $this->_check_token();
    $group = $this->_get_group(intval(post('group_id')));
    $tg_user_id = intval(post('tg_user_id'));
    $person = rbac_person($tg_user_id);
    $name = $person ? $person->name : 'TGUID '.$tg_user_id;

    $this->model->query_bind("DELETE FROM system_group_users WHERE group_id = :gid AND tg_user_id = :uid",
                             array('gid' => $group->id, 'uid' => $tg_user_id));
    $this->_sync_member($tg_user_id);
    $this->_audit('delete', 'RemoveGroupMember', 'rbac-removemember', $group->id, 'system_group_users',
                  'Group: '.$group->title, 'Person: '.$name.' (TGUID '.$tg_user_id.')');

    set_flashdata(out($name).' removed from '.out($group->title).'.');
    $_SESSION['flashmsgcolor'] = 1;
    redirect('system-rbac/members/'.$group->id);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function PERSON -------------------------------*/
/*----------------------------------------------------------------------------*/
  function person(){ // effective access for one login - for checking, changes nothing
    $tg_user_id = segment(3, 'int');
    if(!$tg_user_id && post('tg_user_id')){ // picker on the manage page
        redirect('system-rbac/person/'.intval(post('tg_user_id')));
    }

    $person = $tg_user_id ? rbac_person($tg_user_id) : false;

    $groups = array(); $functions = array();
    if($person){
        $groups = $this->model->query_bind("SELECT g.id, g.title, g.active FROM system_group_users gu
                                              JOIN system_groups g ON g.id = gu.group_id
                                             WHERE gu.tg_user_id = :uid ORDER BY g.title",
                                           array('uid' => $tg_user_id), 'object');

        // the same chain rbac_allowed() walks, with the group(s) that give each function
        $functions = $this->model->query_bind("SELECT m.title AS module_title, f.title, f.code, m.code AS module_code,
                                                      GROUP_CONCAT(DISTINCT g.title ORDER BY g.title SEPARATOR ', ') AS via
                                                 FROM system_group_users gu
                                                 JOIN system_groups g           ON g.id = gu.group_id AND g.active = 1
                                                 JOIN system_group_functions gf ON gf.group_id = g.id
                                                 JOIN system_functions f        ON f.id = gf.function_id
                                                 JOIN system_modules m          ON m.id = f.module_id AND m.enabled = 1
                                                WHERE gu.tg_user_id = :uid
                                                GROUP BY f.id
                                                ORDER BY m.sort_order, f.sort_order",
                                              array('uid' => $tg_user_id), 'object');
    }

    $data['person']    = $person;
    $data['groups']    = $groups;
    $data['functions'] = $functions;
    $data['people']    = $this->_people();
    $data['header']    = 'Effective Access'.($person ? ': '.$person->name : '');
    $data['bc2']       = 'Effective access';
    $this->_page($data, 'person');
  }

/*-------------------------- End function person -----------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------------ PRIVATE HELPERS -----------------------------*/
/*----------------------------------------------------------------------------*/

  function _get_group($id){
    $group = $id ? $this->model->get_where(intval($id), 'system_groups') : false;
    if(!$group){
        set_flashdata('That group was not found.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('system-rbac/manage');
    }
    return $group;
  }

  function _enabled_functions(){
    // functions of switched-on modules, in screen order
    return $this->model->query("SELECT f.id, f.code, f.title, f.description, m.code AS module_code, m.title AS module_title
                                  FROM system_functions f
                                  JOIN system_modules m ON m.id = f.module_id AND m.enabled = 1
                                 ORDER BY m.sort_order, f.sort_order, f.title", 'object');
  }

  function _people(){
    // every login, named, "staff" or "member" beside it (shared with PMS's picker)
    return rbac_people();
  }

  function _sync_member($tg_user_id){
    // a member login's admin roles changed: keep the ccmps columns (and Member Permissions) in step
    $tg = $this->model->get_where(intval($tg_user_id), 'trongate_users');
    if($tg && $tg->login_acct_info_table == 'ccmps'){
        rbac_sync_member_columns((int) $tg->login_acct_table_id);
    }
  }

  function _token(){
    // checked by every POST here so another site can't post changes in your name
    if(empty($_SESSION['rbac_token'])){
        $_SESSION['rbac_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['rbac_token'];
  }

  function _check_token(){
    if(empty($_SESSION['rbac_token']) || !hash_equals($_SESSION['rbac_token'], (string) post('token'))){
        set_flashdata('That page had expired - nothing was saved. Please try again.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('system-rbac/manage');
    }
  }

  function _audit($type, $action, $func, $recid, $table, $str5 = NULL, $str6 = NULL){
    $un = 'UN: '.(!empty($_SESSION['honcho_logged_in']) ? ($_SESSION['honcho_username'] ?? '') : ($_SESSION['ccmp_username'] ?? ''));
    $this->module('timedate');
    $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';

    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, 'Rec: '.$recid, 'Tbl: '.$table, $str5, $str6);
  }

  function _page($data, $view){
    $this->_get_font_sizes();

    $data['token']       = $this->_token();
    $data['view_module'] = 'system/rbac';
    $data['view_file']   = $view;
    $data['bc1']         = 'Security';
    $data['activity']    = 'System Administrator';
    $data['home']        = HONCHO_MODULE == 1 ? 'honcho' : 'welcome-ccmps/ccmphome';

    $this->templates->inspinia($data);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function _GET_FONT_SIZES ---------------------*/
/*----------------------------------------------------------------------------*/

    function _get_font_sizes() {
    // protected - private function
    // Get user's fontsize preferences: staff from honcho_user_accounts, members from ccmps
    if(!empty($_SESSION['honcho_logged_in'])){
        $user_obj               = $this->model->get_where(intval($_SESSION['honcho_acct_rec_id']),'honcho_user_accounts');
        $_SESSION['fontsize']   = $user_obj ? $user_obj->fontsize : 2;  // view pages
        $_SESSION['mfontsize']  = $user_obj ? $user_obj->tfontsize : 3; // manage page
    }else{
        $ccmp_obj               = $this->model->get_where(intval($_SESSION['ccmp_rec_id'] ?? 0),'ccmps');
        $_SESSION['fontsize']   = $ccmp_obj ? $ccmp_obj->fontsize : 2;
        $_SESSION['mfontsize']  = $ccmp_obj ? $ccmp_obj->mfontsize : 3;
    }

    $names = array('1' => 'Large', '2' => 'Medium', '3' => 'Small', '4' => 'X Small');
    $_SESSION['dfontsize']  = $names[(string) $_SESSION['fontsize']]  ?? 'Medium';
    $_SESSION['dmfontsize'] = $names[(string) $_SESSION['mfontsize']] ?? 'Small';

    return;
    }

/*------------------------- End _get_font_sizes ------------------------------*/

} // end controller
