<?php

/*----------------------------------------------------------------------------*/
/*------------------ module WELCOME-CCMPSPERMISSIONS -------------------------*/
/*----------------------------------------------------------------------------*/

/*
  __construct()
        _check_function_permissions()
  manage()                       manage = members holding a permission, manage/all = every member
        _get_font_sizes()
  togglepermission()             ajax from manage page - saves one checkbox
        _check_function_permissions()
  _permission_flags()
  _check_function_permissions()
  _get_font_sizes()
*/

/* One screen to see and set every member's super-user flags (columns on ccmps).
   Only the flags that login copies into the session are listed - see
   _permission_flags(). A change takes effect at that member's next login
   (or right away if you change your own). Member system admins only, with or
   without the Honcho staff module. */

/*----------------------------------------------------------------------------*/

class Ccmpspermissions extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function __construct(?string $module_name = null){
      parent::__construct($module_name);
      $this->_check_function_permissions(); // every page here is member system admin only
    }

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'ccmpspermissions';
    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module  = '';
    }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------------- function _PERMISSION_FLAGS -----------------------*/
/*----------------------------------------------------------------------------*/

  function _permission_flags() {
    // ccmps column => array(column heading, session variable login sets from it)
    // library_admin is on ccmps too but nothing reads it
    // yet - add it here (and to rbac_member_roles()) when something does
    return array(
        'system_admin'    => array('System Admin',        'ccmps_system_admin'),
        'ccmp_admin'      => array(CCMP.' Admin',         'ccmps_ccmp_admin'),
        'subentity_admin' => array(SUBENTITY.' Admin',    'ccmps_subentity_admin'),
        'student_admin'   => array('Student Admin',       'ccmps_student_admin'),
        'content_admin'   => array('Content Admin',       'ccmps_content_admin'),
        'event_admin'     => array('Event Admin',         'ccmps_event_admin'),
        'financial_admin' => array('Financial Admin',     'ccmps_financial_admin'),
    );
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the permissions manage page

    // Get font size preference for views & manage page
    $this->_get_font_sizes();

    $flags = $this->_permission_flags();

    $showall = (segment(3) == 'all'); // default is only members holding a permission

    $sql = "SELECT c.id, c.first_name, c.last_name, c.username, s.description AS chapter, c."
         . implode(', c.', array_keys($flags))
         . " FROM ccmps c LEFT JOIN ccmps_subentities s ON s.id = c.subentity"
         . " WHERE COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1";

    if(!$showall){
        $sql .= " AND (c." . implode(' = 1 OR c.', array_keys($flags)) . " = 1)";
    }

    $sql .= " ORDER BY c.last_name, c.first_name";

    $data['permissionrecs'] = $this->model->query($sql, 'object');
    $data['flags']          = $flags;
    $data['showall']        = $showall;

    // checked by togglepermission() so another site can't post changes in your name
    if(empty($_SESSION['permissions_token'])){
        $_SESSION['permissions_token'] = bin2hex(random_bytes(16));
    }
    $data['permissions_token'] = $_SESSION['permissions_token'];

    $data['view_module'] = 'welcome/ccmpspermissions';
    $data['view_file']   = 'manage';

// customize form
    $data['entityname']  = 'Permission';
    $data['entitynames'] = 'Permissions';

    $data['bc1']      = 'System Admin';
    $data['bc2']      = 'Manage '.CCMP.' '.$data['entitynames'];
    $data['header']   = 'Manage '.CCMP.' '.$data['entitynames'];
    $data['activity'] = 'System Administrator';

    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function TOGGLEPERMISSION --------------------------*/
/*----------------------------------------------------------------------------*/

  function togglepermission(){ // ajax from a checkbox on the manage page - returns json

    header('Content-Type: application/json');

    $token = post('token');
    $recid = intval(post('recid'));
    $flag  = post('flag');
    $value = (post('value') == 1) ? 1 : 0;

    $flags = $this->_permission_flags();

    if(empty($_SESSION['permissions_token']) || !hash_equals($_SESSION['permissions_token'], (string)$token)){
        echo json_encode(array('ok' => false, 'msg' => 'Page expired - please reload it.'));
        die();
    }
    if(!isset($flags[$flag]) || $recid < 1){ // only whitelisted columns can be changed
        echo json_encode(array('ok' => false, 'msg' => 'Unknown permission.'));
        die();
    }

    $member = $this->model->get_where($recid, 'ccmps');
    if(!$member){
        echo json_encode(array('ok' => false, 'msg' => 'Member not found.'));
        die();
    }

    // don't let anyone lock themselves (or everyone) out of this screen
    if($flag == 'system_admin' && $value == 0){
        if($recid == intval($_SESSION['ccmp_rec_id'])){
            echo json_encode(array('ok' => false, 'msg' => 'You cannot remove your own System Admin.'));
            die();
        }
        $admins = $this->model->query("SELECT COUNT(*) AS n FROM ccmps WHERE system_admin = 1 AND id != $recid", 'object');
        if(intval($admins[0]->n) < 1){
            echo json_encode(array('ok' => false, 'msg' => 'There must be at least one System Admin.'));
            die();
        }
    }

    // RBAC step 5: a tick joins / leaves the role's Security Group; the ccmps column is re-synced from it
    foreach(rbac_member_roles() as $role_fn => $role){
        if($role['col'] == $flag){
            rbac_set_member_role($recid, $role_fn, $value == 1, intval($_SESSION['tg_user_id'] ?? 0));
        }
    }

    // changing your own flags takes effect now; everyone else at next login
    if($recid == intval($_SESSION['ccmp_rec_id'])){
        rbac_member_session_flags($recid);
    }

    // Auditlog
    $type   = 'update';
    $action = $value ? 'GrantPermission' : 'RemovePermission';
    $func   = 'ccmpspermissions-togglepermission';
    $un     = 'UN: '.$_SESSION['ccmp_username'];
    $format = 'minitime'; // I added to Timedate.php
    $this->module('timedate');
    $time   = $this->timedate->get_nice_date(time(), $format).' UTC';
    $str3   = 'Rec: '.$recid;
    $str4   = 'Tbl: ccmps';
    $str5   = 'Member: '.$member->first_name.' '.$member->last_name;
    $str6   = $flag.'='.$value;

    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    // read back: a role also given by another Security Group can't be removed here
    $after = $this->model->get_where($recid, 'ccmps');
    if(intval($after->$flag) != $value){
        echo json_encode(array('ok' => false, 'msg' => $member->first_name.' '.$member->last_name.' still has '.$flags[$flag][0]
                         .' through another Security Group - change it on the Security Groups page.'));
        die();
    }

    echo json_encode(array('ok' => true, 'msg' => $flags[$flag][0].($value ? ' given to ' : ' removed from ').$member->first_name.' '.$member->last_name.'.'));
    die();
  }

/*---------------------- End function togglepermission -----------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions() {
    // protected - private function. Called once from __construct() for every page.
    // Reads system_admin from the database, not the session, so someone whose
    // System Admin was just removed loses this screen straight away.

        if(empty($_SESSION['ccmp_logged_in']) || empty($_SESSION['ccmp_rec_id'])){ // not a member login
            if(!empty($_SESSION['honcho_logged_in'])){
                set_flashdata('That page is for '.CCMP.' system admins.');
                redirect('honcho');
            }
            redirect('welcome/logout'); // clears everything then takes to login page
        }

        $me = $this->model->get_where(intval($_SESSION['ccmp_rec_id']), 'ccmps');
        if(!$me || intval($me->system_admin) != 1){
            set_flashdata('You are not authorized to manage '.CCMP.' permissions.');
            $_SESSION['flashmsgcolor'] = 0; // crimson
            redirect('welcome-ccmps/ccmphome');
        }

        return true;
    }

/*----------------------- End _check_function_permissions --------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function _GET_FONT_SIZES ---------------------*/
/*----------------------------------------------------------------------------*/

    function _get_font_sizes() {
    // protected - private function
    // Reuses the ccmp's fontsize preferences, same as the parent Ccmps module

if($_SESSION['ccmp_rec_id']){
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id, 'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize;  // view pages
    $_SESSION['tfontsize']      = $ccmp_obj->tfontsize; // tables
}

         switch($_SESSION['fontsize']) {
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

          switch($_SESSION['tfontsize']) {
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
