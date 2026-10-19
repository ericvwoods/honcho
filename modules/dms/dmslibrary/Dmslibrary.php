<?php
session_start();
if (defined('DEBUGGING') && DEBUGGING == true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
/*

DMS Filelibrary version 1.0

Functions:
index
showreason
kanban
manage
viewdocrec
update
create
submit
fulldoc
fulldescription
bulkaction
approvedoc
hiderecord
unhiderecord
delrecord
previewdocrec
downloaddoc
submit_upload
header0
backlog (~ header1)
inprogress (~ header2)
inreview (~ header3)
pending (~ header4)
header5
done
modaladddoccomment
modalrejectdoc
viewdoccomments
managedoccomments
closedoccomment
deldoccomment
undeldoccomment
undelrecord
updatedoccomment
submitdoccomment
_construct
_destruct
_check_function_permissions
_fontsize
_saveAndPreviewDocx
_docx_to_text
_get_dms_role (called by manage)
_get_mimetype
_get_font_sizes
_populate_dropdowns
_get_a_single_record
_get_a_single_comment

Tables:
 dms_filelibrary_docs, dms_filelibrary_docs_comments, dms_filelibrary_doctags1, dms_filelibrary_doctags2, dms_filelibrary_doctags3, dms_filelibray_filetypes,  dms_filelibray_functions, dms_filelibray_priority, dms_filelibrary_rectypes, dms_filelibrary_roles,  dms_filelibrary_roles_functions, dms_filelibrary_security_group_roles, dms_filelibrary_security_groups, dms_filelibrary_status
 dms_filelibrary_access, dms_filelibrary_tguserid_security_group
// dms_filelibrary_bulk_actions - not implemented

Templates: inspinia.php

Roles: 4 dmslibuser, 1 dmslibadmin, 3 dmslibsubadmin, 2 dmslibastadmin

Add-ins:
 CKEditor.js (inspinia.php)
 pdf.js
 PhpOffice\PhpSpreadsheet\Spreadsheet;
 PhpOffice\PhpSpreadsheet\Writer\Xlsx;
*/

require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dmslibrary extends Trongate {

  function __construct(){ // must start with two underscores
    $this->parent_module = 'dms';
    $this->child_module  = 'dmslibrary';

    // 1. Fetch show 1st column on Kanban Board
    $sys_setting_obj6 = $this->model->get_one_where('id', 6, 'system_settings');

    // 2. Debug the database result
    if (!$sys_setting_obj6) {
        // If we hit this, the database didn't find ID 6
        $_SESSION['DMS_KBB_SHOW_HDR0'] = 0;
    } else {
        // 3. Cast to integer and define
                $_SESSION['DMS_KBB_SHOW_HDR0'] = intval($sys_setting_obj6->settingvalue);

    }
    //    print_r( $_SESSION['DMS_KBB_SHOW_HDR0']); die();

    // 1. Fetch show 6th column on Kanban Board
    $sys_setting_obj8 = $this->model->get_one_where('id', 8, 'system_settings');

    // 2. Debug the database result
    if (!$sys_setting_obj8) {
        // If we hit this, the database didn't find ID 6
        $_SESSION['DMS_KBB_SHOW_HDR5'] = 0;
    } else {
        // 3. Cast to integer and define
                $_SESSION['DMS_KBB_SHOW_HDR5'] = intval($sys_setting_obj8->settingvalue);

    }
    //    print_r( $_SESSION['DMS_KBB_SHOW_HDR5']); die();




  }

  function __destruct(){ // must start with two underscores
    $this->parent_module = '';
    $this->child_module = '';
  }

/*-------------------------------------------------------------------------*/

/*----------------------------- function INDEX -------------------------*/

   function index() {

    // If fail authorization, execution flow will not return
    $docfunction = 1; // index
    $authorized = $this->_check_function_permissions($docfunction);

    echo "DMS-library-index() ... Contact System Admin on ";
    print_r(SYS_ADMIN_PHONE);
    echo " ... Use Back button"; die();

    $data['bc1']         = 'DMS';
    $data['bc2']         = 'Library';
    $data['activity']    = 'Content Manager';
    $data['header']      = 'Document Management System';

    $data['view_module']   = 'dms/dmslibrary';
    $data['view_file']     = 'pdfs';

    $this->templates->inspinia($data);

  }

/*-------------------------------------------------------------------------*/

/*-------------------------- function SHOWREASON -----------------------*/

   function showreason(){

       $docfunction = 2;
       $authorized = $this->_check_function_permissions($docfunction);

       $recid  = segment(3);
       // print_r(   $recid); die();
       $docobj = $this->model->get_where($recid,'dms_filelibrary_docs');
       $holdreason =  $docobj ->holdreason;
       echo(115);
       print_r($holdreason); die();
   }

/*-------------------------------------------------------------------------*/

/*---------------------------- function KANBAN -------------------------*/

   function kanban(){

        $calculations = $this->_dmslibrary_calculations();
//echo(176); die();
    $docfunction = 3;
    $authorized = $this->_check_function_permissions($docfunction);

    // chapter admins see only their own chapter's cards (RBAC step 4)
    $chapteronly = ($_SESSION['filelibrary_rolename'] == 'dmslibsubadmin') ? ' AND subentity = '.intval($this->_my_subentity()) : '';

    $hdr0sql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 6".$chapteronly;
    $data['header0'] = $this->model->query($hdr0sql,'object');

    $bklgsql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 5".$chapteronly;
    $data['backlog'] = $this->model->query($bklgsql,'object');

    $inprsql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 4".$chapteronly;
    $data['inprogress'] = $this->model->query($inprsql,'object');

    $inrvsql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 3".$chapteronly;
    $data['inreview'] = $this->model->query($inrvsql,'object');
//json($data['inreview']); die();
    $pnapsql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 2".$chapteronly;

    $hdr5sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 1 AND done = 0 AND soft_deleted != 1".$chapteronly;
    $data['header5'] = $this->model->query($hdr5sql,'object');

    $data['docpending'] = $this->model->query($pnapsql,'object');

    foreach($data['header0'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);

        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970' || $row->created_at == '12/31/1969'){
          $row->created_at = ' ';
        }
        if($row->assigndate == '01/01/1970' || $row->assigndate == '12/31/1969'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970' || $row->startdate == '12/31/1969'){
          $row->startdate = ' ';
        }
        if($row->duedate == '01/01/1970' || $row->duedate == '12/31/1969'){
          $row->duedate = ' ';
        }

       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
        $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assigned";
       }
    }

    foreach($data['backlog'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);

        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970' || $row->created_at == '12/31/1969'){
          $row->created_at = ' ';
        }
        if($row->assigndate == '01/01/1970' || $row->assigndate == '12/31/1969'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970' || $row->startdate == '12/31/1969'){
          $row->startdate = ' ';
        }
        if($row->duedate == '01/01/1970' || $row->duedate == '12/31/1969'){
          $row->duedate = ' ';
        }
//print_r($row->poc); die();
       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
//json($usrobj); die();

        $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assigned";
       }
    }

    foreach($data['inprogress'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);

        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970' || $row->created_at == '12/31/1969'){
          $row->created_at = ' ';
        }
        if($row->assigndate == '01/01/1970' || $row->assigndate == '12/31/1969'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970' || $row->startdate == '12/31/1969'){
          $row->startdate = ' ';
        }
        if($row->duedate == '01/01/1970' || $row->duedate == '12/31/1969'){
          $row->duedate = ' ';
        }

       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
         $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assigned";
       }
    }

    foreach($data['inreview'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }

       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
         $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
                 $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assined";
       }
    }

    foreach($data['docpending'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }

       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
         $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
                 $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assigned";
       }
    }

    foreach($data['header5'] as $row) {
        $doctag1obj = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;

        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);

        if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970' || $row->created_at == '12/31/1969'){
          $row->created_at = ' ';
        }
        if($row->assigndate == '01/01/1970' || $row->assigndate == '12/31/1969'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970' || $row->startdate == '12/31/1969'){
          $row->startdate = ' ';
        }
        if($row->duedate == '01/01/1970' || $row->duedate == '12/31/1969'){
          $row->duedate = ' ';
        }

       if($row->poc > 0){
        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;

        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
        $row->poc =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->poc =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->poc = "Not Assigned";
       }
    }
    $data['bc1']          = 'DMS';
    $data['bc2']          = 'Library';
    $data['activity']     = 'Kanban Board';
    $data['header']       = 'Document Library';

    $data['view_module']  = 'dms/dmslibrary';
    $data['view_file']    = 'librarykanban';
    $data['managemode']   = $_SESSION['filelibrary_rolename'];

    $this->templates->inspinia($data);

    }

/*-------------------------------------------------------------*/

/*--------------------- function MANAGE ---------------------*/

  function manage(){
//echo(441); die();
/*---------------------- Security Checks ---------------------*/
//  $docfunction = 4; // failure sends you to EMS login even if you came from CCMP module
//  $authorized = $this->_check_function_permissions($docfunction);
 //echo(487); die();
    // passed from sidemenu button sets the mode - ccmp or dmslibadmin

/*------------------- Get Passed Parameters -----------------*/

// The role in the URL is only a request: _get_dms_role() works out what the
// user is allowed and never gives more (typing /manage/dmslibadmin used to work)
$this->_check_function_permissions(4); // logged in + dms/view_library (manage used to skip the check)
$_SESSION['filelibrary_rolename'] = $this->_get_dms_role(segment(3));
// for testing
//$_SESSION['filelibrary_rolename'] = 'dmslibccmp'; // dmslibuser, ccmp
//echo(494); print_r($_SESSION['filelibrary_rolename']); die();
// $managemode =  $_SESSION['filelibrary_rolename'];
// $_SESSION['managemode'] = $managemode;

// json($_POST); die();
// all 0 first time through because no post - run filter was not pressed - what is posted is the name values from the manage view

// intval() - every filter is a numeric id that gets put straight into the SQL
// below, so anything that is not a number becomes 0 (no filter). Stops SQL injection.
$sqlfiltersub      = intval($_POST['sqlfiltersub']);
$sqlfiltertag1     = intval($_POST['sqlfiltertag1']);
$sqlfiltertag2     = intval($_POST['sqlfiltertag2']);
$sqlfiltertag3     = intval($_POST['sqlfiltertag3']);
$sqlfilterformat   = intval($_POST['sqlfilterformat']);
$sqlfilterregion   = intval($_POST['sqlfilterregion']);
$sqlfilterlead     = intval($_POST['sqlfilterlead']);
$sqlfilteraccess   = intval($_POST['sqlfilteraccess']);
$sqlfilterstaff    = intval($_POST['sqlfilterstaff']);
$sqlfilterccmp     = intval($_POST['sqlfilterccmp']);
$sqlfilterdept     = intval($_POST['sqlfilterdept']);
//print_r($_POST['sqlfilterlead']); die();

/* exists in manage.php but commented out
$sqlfilteruploader = $_POST['sqlfilteruploader'];
no term in sql statement defined for uploader below
 */
/*
    echo(474);
    echo('<br>');
    print_r($sqlfiltersub);
    echo('<br>');
    print_r($sqlfiltertag1);
    echo('<br>');
    print_r($sqlfiltertag2);
    echo('<br>');
    print_r($sqlfiltertag3);
    echo('<br>');
    print_r($sqlfilterformat);
//    echo('<br>');
//    print_r($sqlfilterregion); // null
    echo('<br>');
    print_r($sqlfilterlead);
//    echo('<br>');
//    print_r($sqlfilteraccess); // null
    echo('<br>');
    print_r($sqlfilterstaff);
    echo('<br>');
    print_r($sqlfilterccmp);
    echo('<br>');
    print_r($sqlfilterdept);
    die();
*/

/*------------ Get logged in user's info & preferences -----------*/

//echo(543); json($_SESSION); die();
if($_SESSION['acct_table'] == 'ccmps'){
    $user_id  = $_SESSION['ccmp_rec_id'];
    $user_obj = $this->model->get_where($user_id,'ccmps');

}else{
    $user_id  = $_SESSION['honcho_acct_rec_id'];
    $user_obj = $this->model->get_where($user_id,'honcho_user_accounts');
}

//json($user_obj); die();
    $tg_user_id      = $user_obj->trongate_user_id; // already set in session variable
if($_SESSION['acct_table'] == 'ccmps'){
    $subentity       = $user_obj->subentity;
    $subentityobj    = $this->model->get_where($subentity,'ccmps_subentities');
}else{
    $subentity       = $user_obj->honcho_subentity; // department, etc
    $subentityobj    = $this->model->get_where($subentity,'honcho_user_subentities');
}
//json($subentity); die();

    $subentity_name    = $subentityobj->description;
//json($subentityobj); die();
    $subentity_role    = $user_obj->subentity_role;
    $subentity_role_id = $user_obj->subentity_role;

    // get dropdown for all tabs
    $data = $this->_populate_dropdowns();

// echo(572);
// json($data); die(); // checkpoint

/*
    $data['bulk_actions'] = $this->model->get('id','dms_filelibrary_bulk_actions');
//echo($subentity_name); die();
    $data['doctags']   = $this->model->get('id','dms_filelibrary_doctags');
    $data['doctags3']  = $this->model->get('id','dms_filelibrary_doctags3');
    $data['filetypes'] = $this->model->get('id','dms_filelibrary_filetypes');
    $data['rectypes']  = $this->model->get('id','dms_filelibrary_rectypes');
*/

    unset($data['bulk_actions'][1]); // Cannot approve
    unset($data['bulk_actions'][2]); // Cannot Disapprove
    unset($data['bulk_actions'][6]); // Cannot Archive

    /*-------------------- Get Appropriate Docs -----------------------*/

/*
echo(580);
echo('<br>');
echo('SESSION[ccmpmode]: ');
echo('<br>');
echo('subentity: ');
echo($subentity);
echo('<br>');
echo('sqlfiltersub: ');
print_r($sqlfiltersub);
echo('<br>');
echo('sqlfiltertag1: ');
print_r($sqlfiltertag1);
echo('<br>');
echo('sqlfiltertag2: ');
print_r($sqlfiltertag2);
echo('<br>');
echo('sqlfiltertag3: ');
print_r($sqlfiltertag3);
echo('<br>');
echo('sqlfilterformat: ');
print_r($sqlfilterformat);
echo('<br>');
echo('sqlfilterregion: ');
print_r($sqlfilterregion);
echo('<br>');
echo('sqlfilteraccess: ');
print_r($sqlfilteraccess);
echo('<br>');
echo('sqlfilterstaff: ');
print_r($sqlfilterstaff);
echo('<br>');
echo('sqlfilterccmp: ');
print_r($sqlfilterccmp);
echo('<br>');
echo('sqlfiltersub_length: ');
print_r(strlen($sqlfiltersub));
echo('<br>');
echo('sqlfiltertag1_length: ');
print_r(strlen($sqlfiltertag1));
echo('<br>');
echo('sqlfiltertag2_length: ');
print_r(strlen($sqlfiltertag2));
echo('<br>');
echo('sqlfiltertag3_length: ');
print_r(strlen($sqlfiltertag3));
echo('<br>');
echo('sqlfilterformat_length: ');
print_r(strlen($sqlfilterformat));
echo('<br>');
echo('sqlfilterregion_length: ');
print_r(strlen($sqlfilterregion));
echo('<br>');
echo('sqlfilteruploader_length: ');
print_r(strlen($sqlfilteruploader));
echo('<br>');
echo('sqlfilteraccess_length: ');
print_r(strlen($sqlfilteraccess));
echo('<br>');
echo('sqlfilterstaff_length: ');
print_r(strlen($sqlfilterstaff));
echo('<br>');
echo('sqlfilterccmp_length: ');
print_r(strlen($sqlfilterccmp));
echo('sqlfilterdept_length: ');
print_r(strlen($sqlfilterdept));
 die();
*/

// when the page first loads no filter button is pressed so filters all null so get all docs
// check to see if all null therefore page just loaded
// OR or perhaps the page has loaded and the filter button pressed but all the filters on the default All (1)

//Case 1: No filters set. Either all = 0 (Run Filter button pushed with all set to All) or initial page load and all are Null

/*
$sqlfiltersub
$sqlfiltertag1
$sqlfiltertag2
$sqlfiltertag3
$sqlfilterformat
$sqlfilterregion
$sqlfilterlead - was uploader
$sqlfilteraccess
$sqlfilterstaff
$sqlfilterccmp
$sqlfilterdept
*/
/*
    echo(624);
    echo('<br>');
    print_r($filter);
    echo('<br>');
    print_r($sqlfiltersub);
    echo('<br>');
    print_r($sqlfiltertag1);
    echo('<br>');
    print_r($sqlfiltertag2);
    echo('<br>');
    print_r($sqlfiltertag3);
    echo('<br>');
    print_r($sqlfilterformat);
//    echo('<br>');
//    print_r($sqlfilterregion); // null
    echo('<br>');
    print_r($sqlfilterlead);
//    echo('<br>');
//    print_r($sqlfilteraccess); // null
    echo('<br>');
    print_r($sqlfilterstaff);
    echo('<br>');
    print_r($sqlfilterccmp);
    echo('<br>');
    print_r($sqlfilterdept);
    die();
*/

    if($sqlfiltersub == 0 AND $sqlfiltertag1 == 0 AND $sqlfiltertag2 == 0 AND $sqlfiltertag3 == 0 AND $sqlfilterformat == 0 AND $sqlfilterregion == 0 AND $sqlfilterlead == 0 AND $sqlfilteraccess == 0  AND $sqlfilterstaff == 0 AND $sqlfilterccmp == 0 AND $sqlfilterdept == 0 ){ // NO FILTERS SET - all are 1(All) or NULL  line 724

// Find out if have admin rights by looking for a match in the honcho_users_tguserid_security_group table. dmslibuser = 5.
 $tguserid = $_SESSION['tg_user_id'];
//echo(711); print_r($tguserid); die();
// DMS User
/* ??? is this necessary since have $_SESSION['filelibrary_rolename']?
$sqluser = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 6";
$checkuser_obj = $this->model->query($sqluser,'object');
if(!empty($checkuser_obj)){

    $sg_obj = $this->model->get_one_where('id', 6, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibuser
}

// DMS Subentity Admin
$sqlsubadmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 7";
$checksubadmin_obj = $this->model->query($sqlsubadmin,'object');

if(!empty($checksubadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 7, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibsubadmin

}

// DMS Admin: if both a subadmin and admin, admin from overwrite subadmin
$sqladmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 8 OR tguserid = $tguserid AND security_group_id = 1";
$checkadmin_obj = $this->model->query($sqladmin,'object');

if(!empty($checkadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 8, 'honcho_users_security_groups');
 //   echo(513); die();
    $managemode =  $sg_obj->session_name; // dmslibadmin
}

if($_SESSION['dms_lib_access'] == 99 ){ //sysadmin
    $managemode = 'dmslibadmin'; // Document Management System Admin
}
*/
//echo(752); // set on line 491
//print_r($_SESSION['filelibrary_rolename']); die();
    switch ($_SESSION['filelibrary_rolename']){

        case 'dmslibuser'; // logged in user is acting as himself - filetype = 0 is all. 1 is database where there is no physical file, 2 text, 3 pdf, 4 word, 5 ppt, 6 excel, 7 zip

            if(!empty($_SESSION['honcho_logged_in'])){ // staff have a document access level; members see level 0
                $usr_obj = $this->model->get_one_where('id', $_SESSION['honcho_acct_rec_id'], 'honcho_user_accounts' );
                $_SESSION['dms_lib_access'] = $usr_obj ? $usr_obj->dmslibacclevel : 0;
            }else{
                $_SESSION['dms_lib_access'] = 0;
            }
            $usrdocseclevel = intval($_SESSION['dms_lib_access']) + 1;
//print_r($usrdocseclevel); die();
        // show a non-admin only things that are final and ready - will show admin everything so they can fix them

              $sql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 1 AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

      //  $sql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 1 AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel OR active = 1 AND status > 0 AND poc = $usr_tguid";
//print_r($sql); die();
        break;

        case 'dmslibsubadmin'; // Chapter Admin - Dont need to be active or final because he can change that but must belong to his subentity

            $sql = "SELECT * FROM dms_filelibrary_docs WHERE subentity = $subentity";

        break;

        case 'dmslibadmin'; // Content Mgr - Can do everything so see all records

            $usrdocseclevel = $_SESSION['dms_lib_access'] + 1;

            $sql = "SELECT * FROM dms_filelibrary_docs";

        break;
    }

    $filter = 'None'; // all values 0
    $case = 'Case 1: No filters set. Either all = 0 (Set Filter button pushed with all set to All) or initial page load and all are Null';

/*
echo(785); // checkpoint
echo('<br>');
print_r($filter);
echo('<br>');
print_r($sql); die();
*/

    }else{ //from 625: AT LEAST ONE FILTER IS SET (not all 0 or null)
// this case ends on line 1200

//echo(795);
//echo('<br>');
//print_r($sqlfiltertag1); die();

         $usrdocseclevel = $_SESSION['dms_lib_access'] + 1; // because using < vs <=

            $whereclausealreadyset = 0; // reset just in case
           // $term11 = ''; // reset because of back button actions, etc.

            if($sqlfiltersub > 0){

                switch ($_SESSION['filelibrary_rolename']){
                      case 'dmslibuser';
                            $whereclausealreadyset = 1;
                            $subterm = ' WHERE subentity = '.$sqlfiltersub;
                            $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                      break;
                      case 'dmslibadmin'; // admin not restricted by status or security level
                            $whereclausealreadyset = 1;
                            $subterm = ' WHERE subentity = '.$sqlfiltersub;
                      break;
                }
//echo(769);
//print_r($subterm);
//echo('<br>');
//print_r($term5); die();
            }else{
//echo(618);
//print_r($sqlfiltersub); die();
                $subterm = '';
            }

            if($sqlfiltertag1 > 0){
                if($whereclausealreadyset == 1){

                    switch ($_SESSION['filelibrary_rolename']){
                          case 'dmslibuser';
                                $term1 = ' AND doctag1 = '.$sqlfiltertag1;
               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL'  AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                      break;
                          case 'dmslibadmin';
                                $term1 = ' AND doctag1 = '.$sqlfiltertag1;
                          break;
                    }

//echo(636);
//print_r($term1);
//echo('<br>');
//print_r($term11); die();

                }else{

                    switch ($_SESSION['filelibrary_rolename']){
                          case 'dmslibuser';
                                $whereclausealreadyset = 1;
                                $term1 = ' WHERE doctag1 = '.$sqlfiltertag1;
               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                       break;
                          case 'dmslibadmin';
                                $whereclausealreadyset = 1;
                                $term1 = ' WHERE doctag1 = '.$sqlfiltertag1;
                          break;
                    }
                }
//echo(655);
//print_r($term1);
//echo('<br>');
//print_r($term5); die();
            }else{
                $term1 = '';
            }
//echo(662);
//print_r($term1);
//echo('<br>');
//print_r($term11); die();

            if($sqlfiltertag2 > 0){

                switch ($_SESSION['filelibrary_rolename']){
                     case 'dmslibuser';

                    if($whereclausealreadyset == 1){

                         $term2 = ' AND doctag2 = '.$sqlfiltertag2;

                    }else{
                         $whereclausealreadyset = 1;
                         $term2 = ' WHERE doctag2 = '.$sqlfiltertag2;
                    }
               $term5 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                      break;

                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term2 = ' AND doctag2 = '.$sqlfiltertag2;

                    }else{
                         $whereclausealreadyset = 1;
                         $term2 = ' WHERE doctag2 = '.$sqlfiltertag2;
                    }

                      break;
                }
//echo(697);
//print_r($term2);
//echo('<br>');
//print_r($term5); die();
            }else{
                $term2 = '';
            }

            if($sqlfiltertag3 > 0){

                switch ($_SESSION['filelibrary_rolename']){
                     case 'dmslibuser';

                    if($whereclausealreadyset == 1){

                         $term3 = ' AND doctag3 = '.$sqlfiltertag3;

                    }else{
                         $whereclausealreadyset = 1;
                         $term3 = ' WHERE doctag3 = '.$sqlfiltertag3;
                    }
               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                      break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term3 = ' AND doctag3 = '.$sqlfiltertag3;

                    }else{
                         $whereclausealreadyset = 1;
                         $term3 = ' WHERE doctag3 = '.$sqlfiltertag3;
                    }

                      break;
                }
            }else{
                $term3 = '';
            }

            if($sqlfilterformat > 0){


                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){

                         $term4 = ' AND filetype = '.$sqlfilterformat;

                    }else{
                         $whereclausealreadyset = 1;
                         $term4 = ' WHERE filetype = '.$sqlfilterformat;
                    }
               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term4 = ' AND filetype = '.$sqlfilterformat;

                    }else{
                         $whereclausealreadyset = 1;
                         $term4 = ' WHERE filetype = '.$sqlfilterformat;
                    }

                      break;
                }
            }else{
                $term4 = '';
            }

            if($sqlfilterregion > 0){


                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){

                         $term5 = ' AND region = '.$sqlfilterregion;

                    }else{
                         $whereclausealreadyset = 1;
                         $term5 = ' WHERE region = '.$sqlfilterregion;
                    }
               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term5 = ' AND region = '.$sqlfilterregion;

                    }else{
                         $whereclausealreadyset = 1;
                         $term5 = ' WHERE region = '.$sqlfilterregion;
                    }

                      break;
                }
            }else{
                $term5 = '';
            }

               if($sqlfilterlead > 0){

                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){

                         $term6 = ' AND poc = '.$sqlfilterlead;

                    }else{
                         $whereclausealreadyset = 1;
                         $term6 = ' WHERE poc = '.$sqlfilterlead;
                    }

               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term6 = ' AND poc = '.$sqlfilterlead;

                    }else{
                         $whereclausealreadyset = 1;
                         $term6 = ' WHERE poc = '.$sqlfilterlead;
                    }

                      break;
                }
            }else{
                $term6 = '';
            }

               if($sqlfilteraccess > 0){

                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){

                         $term7 = ' AND access = '.$sqlfilteraccess;

                    }else{
                         $whereclausealreadyset = 1;
                         $term7 = ' WHERE access = '.$sqlfilteraccess;
                    }

               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term7 = ' AND access = '.$sqlfilteraccess;

                    }else{
                         $whereclausealreadyset = 1;
                         $term7 = ' WHERE access = '.$sqlfilteraccess;
                    }

                      break;
                }
            }else{
                $term7 = '';
            }

               if($sqlfilterstaff > 0){

                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){
//                          $term8 = ' AND tg_user_id = '.$sqlfilterstaff;
                         $term8 = ' AND staff = '.$sqlfilterstaff;

                    }else{
                         $whereclausealreadyset = 1;
                         $term8 = ' WHERE staff = '.$sqlfilterstaff;
                    }

               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term8 = ' AND staff = '.$sqlfilterstaff;

                    }else{
                         $whereclausealreadyset = 1;
                         $term8 = ' WHERE staff = '.$sqlfilterstaff;
                    }

                      break;
                }
            }else{
                $term8 = '';
            }

               if($sqlfilterccmp > 0){

                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){

                         $term9 = ' AND ccmp_id = '.$sqlfilterccmp;

                    }else{
                         $whereclausealreadyset = 1;
                         $term9 = ' WHERE ccmp_id = '.$sqlfilterccmp;
                    }

               $term11 = " AND active = 1 AND "
                       . "status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term9 = ' AND ccmp_id = '.$sqlfilterccmp;

                    }else{
                         $whereclausealreadyset = 1;
                         $term9 = ' WHERE ccmp_id = '.$sqlfilterccmp;
                    }

                      break;
                }
            }else{
                $term9 = '';
            }

               if($sqlfilterdept > 0){

                switch ($_SESSION['filelibrary_rolename']){
                 case 'dmslibuser';
                    if($whereclausealreadyset == 1){
//                          $term8 = ' AND tg_user_id = '.$sqlfilterstaff;
                         $term10 = ' AND department = '.$sqlfilterdept;

                    }else{
                         $whereclausealreadyset = 1;
                         $term10 = ' WHERE department = '.$sqlfilterdept;
                    }

               $term11 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";

                    break;
                      case 'dmslibadmin';

                    if($whereclausealreadyset == 1){

                         $term10 = ' AND department = '.$sqlfilterdept;

                    }else{
                         $whereclausealreadyset = 1;
                         $term10 = ' WHERE department = '.$sqlfilterdept;
                    }

                      break;
                }
            }else{
                $term10 = '';
            }


    echo(1175);
    echo('<br>');
    print_r($subterm);
    echo('<br>');
    print_r($term1);
    echo('<br>');
    print_r($term2);
    echo('<br>');
    print_r($term3);
    echo('<br>');
    print_r($term4);
    echo('<br>');
    print_r($term5);
    echo('<br>');
    print_r($term6);
    echo('<br>');
    print_r($term7);
    echo('<br>');
    print_r($term8);
    echo('<br>');
    print_r($term9);
    echo('<br>');
    print_r($term10);
    echo('<br>');
    print_r($term11);
      die();

    $sql = 'SELECT * FROM dms_filelibrary_docs'.$subterm.$term1.$term2.$term3.$term4.$term5.$term6.$term7.$term8.$term9.$term10.$term11;


        }  // end else

    $orgsql = $sql; // to show what failed query was to user

/*
echo(1201);
echo('<br>');
echo('User doc Sec Level ');
print_r($usrdocseclevel);
echo('<br>');
print_r($sql); die();
*/

// checkpoint
$submit = post('submit', true);

//print_r($submit); die();

if($submit == 'Submit'){
echo(1215); die();
/*
if(!isset($data['rows'])){
    echo(1135);
    echo('<br>');
    print_r($case);
    echo('<br>');
    print_r($sql);
    echo('<br>');
    echo("filter: ");
    print_r($filter); die();  // no $data['filter']
}else{
    echo(1144);
    echo('<br>');
    echo("case: ");
    print_r($case);
    echo('<br>');
    echo("data['filter']: ");
    print_r($data['filter']);
    echo('<br>');
    print_r($sql);
    echo('<br>');
    json($data['rows']);
 die();
};
*/

} // end if submit = "Submit"
// end checkpoint
//echo(1244); die();  // no Submit if goes straight here instead of 1215
    if(strlen($subterm) < 1){
        $subterm = ' = All ';
    }else{ // convert to description

        $subobj = $this->model->get_where($sqlfiltersub, 'honcho_user_subentities');
        $subtitle = $subobj->title;
        $subterm = $subtitle;
        $subterm = ' = '.$subterm.' ';

        $filter = '<span style="color:darkgreen;">'.SUBENTITY.'</span>: <span style="color:crimson;">'.$subtitle.'</span> ';
    };

    if(strlen($term1) < 1){
        $term1 = ' = All ';
    }else{
        $formatobj1 = $this->model->get_where($sqlfiltertag1, 'dms_filelibrary_doctags1');
        $fmttitle1 = $formatobj1->title;
        $term1 = $fmttitle1;
        $term1 = ' = '.$term1.' ';

        $filter = $filter.'<span style="color:darkgreen;">'.DMS_FL_TAG1.'</span>: <span style="color:crimson;">'.$fmttitle1.'</span> ';

    };

    if(strlen($term2) < 1){
        $term2 = ' = All ';
    }else{
        $formatobj2 = $this->model->get_where($sqlfiltertag2, 'dms_filelibrary_doctags2');
        $fmttitle2 = $formatobj2->title;
        $term2 = $fmttitle2;
        $term2 = ' = '.$term2.' ';

       $filter = $filter.'<span style="color:darkgreen;">'.DMS_FL_TAG2.'</span>: <span style="color:crimson;">'.$fmttitle2.'</span> ';

    };

    if(strlen($term3) < 1){
        $term3 = ' = All ';
    }else{
        $formatobj3 = $this->model->get_where($sqlfiltertag3, 'dms_filelibrary_doctags3');
        $fmttitle3 = $formatobj3->title;
        $term3 = $fmttitle3;
        $term3 = ' = '.$term3.' ';

    $filter = $filter.'<span style="color:darkgreen;">'.DMS_FL_TAG3.'</span>: <span style="color:crimson;">'.$fmttitle3.'</span> ';

    };

    if(strlen($term4) < 1){
        $term4 = ' = All ';
    }else{ // convert to description

        $formatobj4 = $this->model->get_where($sqlfilterformat, 'dms_filelibrary_filetypes');
        $fmttitle4 = $formatobj4->description;
        $term4 = $fmttitle4;
        $term4 = ' = '.$term4.' ';

        $filter = $filter.'<span style="color:darkgreen;">Filetype</span>: <span style="color:crimson;">'.$fmttitle4.'</span> ';

    };

    if(strlen($term5) < 1){
        $term5 = ' = All ';
    }else{ // convert to description

        $formatobj5 = $this->model->get_where($sqlfilterregion, 'ref_region_codes');
        $fmttitle5 = $formatobj5->description;
        $term5 = $fmttitle5;
        $term5 = ' = '.$term5.' ';

        $filter = $filter.'<span style="color:darkgreen;">Region</span>: <span style="color:crimson;">'.$fmttitle5.'</span> ';

    };

    if(strlen($term6) < 1){
        $term6 = ' = All ';
    }else{ // convert to description
 //  echo(1282); die();
        $formatobj6 = $this->model->get_where($sqlfilterlead, 'trongate_users');
        $fmttitle6 = $formatobj6->title;
        $term6 = $fmttitle6;
        $term6 = ' = '.$term6.' ';

        $filter = $filter.'<span style="color:darkgreen;">Lead</span>: <span style="color:crimson;">'.$fmttitle6.'</span> ';

    };

    if(strlen($term7) < 1){
        $term7 = ' = All ';
    }else{ // convert to description

        $formatobj7 = $this->model->get_where($sqlfilteraccess, 'dms_filelibrary_access');
        $fmttitle7 = $formatobj7->description;
        $term7 = $fmttitle7;
        $term7 = ' = '.$term7.' ';

        $filter = $filter.'<span style="color:darkgreen;">Access</span>: <span style="color:crimson;">'.$fmttitle7.'</span> ';

    };

    if(strlen($term8) < 1){
        $term8 = ' = All ';
    }else{ // convert to description

        $formatobj8 = $this->model->get_where($sqlfilterstaff, 'trongate_users');
        $fmttitle8 = $formatobj8->code;
        $term8 = $fmttitle8;
        $term8 = ' = '.$term8.' ';

        $filter = $filter.'<span style="color:darkgreen;">Staff</span>: <span style="color:crimson;">'.$fmttitle8.'</span> ';

    };

    if(strlen($term9) < 1){
        $term9 = ' = All ';
    }else{ // convert to description

        $formatobj9 = $this->model->get_where($sqlfilterccmp, 'ccmps');
        $fmttitle9 = $formatobj9->last_name;
        $term9 = $fmttitle9;
        $term9 = ' = '.$term9.' ';

        $filter = $filter.'<span style="color:darkgreen;">'.CCMP.'</span>: <span style="color:crimson;">'.$fmttitle9.'</span> ';

    };


    if(strlen($term10) < 1){
        $term10 = ' = All ';
    }else{ // convert to description

        $formatobj10 = $this->model->get_where($sqlfilterdept, 'dms_filelibrary_departments');
        $fmttitle10 = $formatobj10->title;
        $term10 = $fmttitle10;
        $term10 = ' = '.$term10.' ';

        $filter = $filter.'<span style="color:darkgreen;">Department</span>: <span style="color:crimson;">'.$fmttitle10.'</span> ';

    };

    if(strlen($subtitle) < 1){
        $subtitle = 'All';
    }
    if(strlen($fmttitle1) < 1){
        $fmttitle1 = 'All';
    }
    if(strlen($fmttitle2) < 1){
        $fmttitle2 = 'All';
    }
    if(strlen($fmttitle3) < 1){
        $fmttitle3 = 'All';
    }
    if(strlen($fmttitle4) < 1){
        $fmttitle4 = 'All';
    }
    if(strlen($fmttitle5) < 1){
        $fmttitle5 = 'All';
    }
    if(strlen($fmttitle6) < 1){
        $fmttitle6 = 'All';
    }
    if(strlen($fmttitle7) < 1){
        $fmttitle7 = 'All';
    }
    if(strlen($fmttitle8) < 1){
        $fmttitle8 = 'All';
    }
    if(strlen($fmttitle9) < 1){
        $fmttitle9 = 'All';
    }

    if(strlen($fmttitle10) < 1){
        $fmttitle10 = 'All';
    }

    $allfilter = SUBENTITY.$subterm.DMS_FL_TAG1.$term1.DMS_FL_TAG2.$term2.DMS_FL_TAG3.$term3.'Format '.$term5.'Region '.$term5.'Lead '.$term6.'Access '.$term7.'Staff '.$term8.CCMP.$term9.'Dept '.$term10;

    if($subtitle == 'All' AND $fmttitle1 == 'All' AND $fmttitle2 == 'All' AND $fmttitle3 == 'All' AND $fmttitle4 == 'All' AND $fmttitle5 == 'All' AND $fmttitle6 == 'All' AND $fmttitle7 == 'All' AND $fmttitle8 == 'All' AND $fmttitle9 == 'All' AND $fmttitle10 == 'All'){
    //    echo(1383); die();
      $filter = 'None';
    }

/*
 echo(1428);
 print_r($filter);
 print_r($sql); die();
*/

   // create the $data and fill it with the rows from the table
  $data['rows'] = $this->model->query($sql,'object');

//echo(1436);
//json($data['rows']); die();

  if($data['rows']){ // if you find records to match the query then continue
   // since not null ok

/*
   if(strlen($allfilter) == 50){ //strlen Tag 1 = All Tag 2 = All Tag 3 = All Format = All is 50. Hopefully others arent
         $filter = 'None';
         $data['showclearfilterbtn'] = 0;
   }else{
        $data['showclearfilterbtn'] = 1;
   } */

   //print_r($filter); die();
    $data['sql'] = $sql; // for user interface
    $data['filter'] = $filter; // for user interface
    $data['showclearfilterbtn'] = 1;
/*
echo(1416);
echo('<br>');
print_r( $filter);
json($data); die();
*/
   }else{
     // null since no records found or empty library

        $data['showclearfilterbtn'] = 0;
        switch ($_SESSION['filelibrary_rolename']){
        case 'dmslibuser'; // logged in user is acting as himself - filetype = 0 is all. 1 is database where there is no physical file, 2 text, 3 pdf, 4 word, 5 ppt, 6 excel, 7 zip

      //old      $sql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 1 AND filename != 'NULL' AND access < '.$usrdocseclevel.' OR active = 1 AND status = 1 AND filetype = 0";
 $sql = "SELECT * FROM dms_filelibrary_docs WHERE active = 1 AND status = 1 AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                $data['rows'] = $this->model->query($sql,'object');
                $data['filter'] = '<span style="color:crimson;">No matches for </span> '.$filter;
                $data['showclearfilterbtn'] = 0;
                break;
              case 'dmslibadmin';
                $sql = 'SELECT * FROM dms_filelibrary_docs';
                $data['rows'] = $this->model->query($sql,'object');
                $data['filter'] = '<span style="color:crimson;">No matches for </span> '.$filter;
                $data['showclearfilterbtn'] = 0;
              break;
        }

/*
echo(1442);
echo('<br>');
print_r( $filter);
json($data); die();
*/

} // end if $data['rows'] exists

/*--------------------- Add User Friendly Values ----------------*/

//loop through the records and add a user friendly values to each record
// cannot convert values because interface uses the id key values

 //json($data['rows']); die();
 foreach($data['rows'] as $row) {
     $filetype = $row->filetype;
  switch($filetype) {

  case '1': // DB Record
       $row->fileicon = 'fa fa-database fa-1x';
  break;

  case '2': // Text
        $row->fileicon = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $row->fileicon = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
       $row->fileicon = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
       $row->fileicon = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $row->fileicon = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
       $row->fileicon = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3
      $row->fileicon = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $row->fileicon = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV
       $row->fileicon = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
       $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
       $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  default;

    $row->fileicon = 'fa fa-eye fa-1x';
}

    $tagobj1 = $this->model->get_where($row->doctag1, 'dms_filelibrary_doctags1');
    $row->doctag1 = $tagobj1->title;

    if(strlen($row->doctag1) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1

        $row->doctag1 = '';
    }

    $tagobj2 = $this->model->get_where($row->doctag2, 'dms_filelibrary_doctags2');
    $row->doctag2 = $tagobj2->title;

    if(strlen($row->doctag2) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags2

        $row->doctag2 = '';
    }

    $tagobj3 = $this->model->get_where($row->doctag3, 'dms_filelibrary_doctags3');
    $row->doctag3 = $tagobj3->title;

    if(strlen($row->doctag3) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags3

        $row->doctag3 = '';
    }

    $deptobj = $this->model->get_where($row->department, 'dms_filelibrary_departments');
    $row->department = $deptobj->title;

    if(strlen($row->department) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_departments

        $row->department = '';
    }


    $ftypeobj = $this->model->get_where($row->filetype, 'dms_filelibrary_filetypes');
    $row->filetypetitle = $ftypeobj->title;

/*    if(strlen($row->filetypetitle) < 1){

        $row->filetypetitle = 'Missing';
    } */

    if(strlen($row->filename) < 1){  // no file name

        if($row->rectype > 1){ // not DB only
              $row->filename = 'File Missing';

        }else{
             $row->filename = 'NA';
               $row->filetypetitle = '1602DB Record';

               if($row->updated_at > $row->created_at){

                   $row->filedate = $row->updated_at;
               }else{

                   $row->filedate = $row->created_at;
               }

        }

    }



}
/*
echo(1623);
print_r($row->poc);
json($data['rows']); die(); // checkpoint - user friendly values
*/
    // step through the array of records and pull out needed values for view pg
    foreach($data['rows'] as $row) {

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.

//    $tgusrid   = $row->uploaded_by;
//    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
 //   $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table);
//json($tgusrobj); die();


    // Get the poster's name for each record
    if($row->uploaded_by > 0){ // was $tgusrid
     $tgusrid   = $row->uploaded_by;
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;

    $uploader_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
//json($uploader_obj); die();
     $row->uploader =  $uploader_obj->first_name.' '.$uploader_obj->last_name;
    }else{
      $row->uploader = 'NA';
    }
//echo(1611);
//print_r($row->uploader); die(); // ok

/*----------- Change values to display descriptions instead of code -----*/
//print_r($row->poc ); die();
       if($row->poc > 0){

        $tguidobj = $this->model->get_where($row->poc, 'trongate_users');
//print_r($tguidobj); die();
        $user_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->poc,
                $user_acct_table);
//echo(1624);
//json($usrobj); die();

        $row->poc =  $usrobj->first_name.' '.$usrobj->last_name; // see 1915
// print_r($row->poc ); die();
        // add contact data for lead if one assigned
        $row->lead_phone =  $usrobj->phone;
        $row->lead_mobile =  $usrobj->mobile;
        $row->lead_whatsapp =  $usrobj->whatsapp;
        $row->lead_email =  $usrobj->email_address;

       }else{
         $row->poc = "NA";
       }
 //  echo(1638); die();
    $statusobj   = $this->model->get_one_where('id', $row->status, 'dms_filelibrary_status');
    $row->status = $statusobj->title;
//echo(1638); die();
    $accessobj   = $this->model->get_where($row->access,'dms_filelibrary_access');
    $row->access = $accessobj->title;
//echo(1644);
//print_r($row->access); die();

if($row->subentity > 0){
    $subentity = $row->subentity;
    $subentity_obj = $this->model->get_where($subentity,
                'dms_filelibrary_subentities');
 // echo(1651); die();
       $row->subentity =  $subentity_obj->title;
    }else{
  //      echo(1654); die();
      $row->subentity = 'NA';
}
/*    $subentityid    = $row->subentity;
    $subentityobj   = $this->model->get_where($subentityid,'honcho_user_subentities');
    $row->subentity = $subentityobj->description; */
/*
    $this->module('timedate');
    $format = 'datepicker_us';
    $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
    $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
    $row->filedate= $this->timedate->get_nice_date($row->filedate, $format);

    if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
      $row->updated_at = ' ';
    } */
 // echo(1670); die();

    } // end foreach data['rows']

// checkpoint - descriptions in place of codes - lead contact info added
//echo(1717);
//json($data['rows']); die();

    /*----------- Add $data array elements for manage view --------------*/

    $data['logged_in']     = $_SESSION['logged_in'];
    $data['home_page']      = 0;

    $data['content_name']   = SITENAME;
//  $data['subentity_name']  = $subentity_name; // do anything with this? -no! no subs in hq dms

    $data['view_module']   = 'dms/dmslibrary';
    $data['view_file']     = 'manage'; //

    $data['managemode']     = $_SESSION['filelibrary_rolename'];
/*
    echo(1733);
    echo('<br>');
    json($_SESSION['filelibrary_rolename']); die();
*/

    switch($_SESSION['filelibrary_rolename']) {

    case 'dmslibuser': // managing your own ads/docs

          $data['bc1']          = 'DMS';
     //     $data['bc2']          = 'Manage My Documents'; not allowing user to have own docs
          $data['bc2']          = 'Document Library';
          $data['salutation']   = $ccmp_obj->salutation;
          $data['first_name']   = $ccmp_obj->first_name;
          $data['middle_name']  = $ccmp_obj->middle_name;
          $data['last_name']    = $ccmp_obj->last_name;
          $data['suffix']       = $ccmp_obj->suffix;
        //  $data['header']       = 'Manage My Documents';
          $data['header']      = SHORTSITENAME.' Document Library';
        //  $data['activity']    = 'Content Manager';

    break;
/*
    case 'dmslibsubadmin': // subentity admin

          $data['bc1']         = 'DMS';
          $data['bc2']         = SUBENTITY.' Documents';
          $data['activity']    = $_SESSION['subentity_name'];
       //   $data['header']      = 'Manage Chapter Documents'; hard coded
    break;
*/
    case 'dmslibadmin': // content manager

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'All Document Records';

          $data['header']      = 'Document Management System';
          $data['activity']    = 'Document Library';


    break;

    }
// for testing
//$_SESSION['filelibrary_rolename'] = 'dmslibccmp'; // dmslibuser, ccmp

 // bulk actions may be too dangerous
 //   print_r($data['bulk_actions']); die();

 // echo(1782);
 // json($data); die(); // checkpoint

        $this->templates->inspinia($data);

  }

/*------------------------ End manage ------------------------*/

/*-------------------- FUNCTION VIEWDOCREC -------------------*/

    function viewdocrec(){

    $libfuncid = 5; // id in library functions table
    $authorized = $this->_check_function_permissions($libfuncid);

$_SESSION['callingfunc'] = 'viewdocrec';

    if(strlen($_SESSION['trongatetoken']) > 0){
        // ok do nothing
    }else{
        $flash_msg = 'Your Session has expired - please login again.';

        set_flashdata($flash_msg);
        $_SESSION['flashmsgcolor'] = 0; //red

        // you logged out or session timed out - login again
        redirect('honcho/logout'); // clears everything then takes to login page
    }

/*----------------------- Get Passed Parameters -------------------------*/

      //  $_SESSION['actionmode']  = segment(2); // viewdocrec
        $recid                   = segment(3); // 1
        $_SESSION['frmpg']       = segment(5);

/*---------------------------- Run Queries ------------------------------*/
  // Get record to view

  $data = $this->_get_a_single_record($recid);
 //echo(1650);
 //json($data);
  $_SESSION['oldfilename']  = $data->filename;

/*--------------------- Convert to User Friendly Values ----------------*/

      if($data['onhold'] == 1){
        $data['onhold'] = 'Yes';
    }else{
        $data['onhold'] = 'No';
    }

    if($data['blocked'] == 1){
        $data['blocked'] = 'Yes';
    }else{
        $data['blocked'] = 'No';
    }

    if($data['rejected'] == 1){
        $data['rejected'] = 'Yes';
    }else{
        $data['rejected'] = 'No';
    }

  $data['created_at']        = $adobj->created_at;
  $data['updated_at']        = $adobj->updated_at;
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);
   $data['uploaded_at']  = $this->timedate->get_nice_date($data['uploaded_at'],
          $format);

if($data['rectype'] == 1){ // DB entry no doc
    $rectypenum          = 1; // need to preserve org value for below
    $data['rectype']     = 'DB Record';
    $data['filetype']    = 'NA';
    $data['filename']    = 'NA';
    $data['filemime']    = 'NA';
    $data['filesize']    = 'NA';
    $data['filedate']    = 'NA';
    $data['uploaded_by'] = 'NA';
    $data['uploaded_at'] = 'NA';
    $data['downloads']   = 'NA';
    $data['rectype']     = 'DB Record';
    $data['subentity']   = 0;
}else{

    if(strlen($data['filename']) < 1){
        $data['rectype']     = 'Document Awaiting Upload';
    }else{

        $data['rectype']     = 'Document';
    }

    $ftypeobj = $this->model->get_where($data['filetype'], 'dms_filelibrary_filetypes');
    $filetypetitle = $ftypeobj->title;
    $filetype = $ftypeobj->id;
    $data['filetype'] = $ftypeobj->title;

    if(strlen($data['filesize']) == 0){
       $data['filesize'] = '';
    }

 }

  if($data['active'] == 1){
    $data['active'] = 'Yes';
  }else{
    $data['active'] = 'No';
  }

  $data['alt_contact_only'] = $adobj->alt_contact_only;
  //print_r($data['alt_contact_only']); die();
  if($data['alt_contact_only'] == 1){
    $data['alt_contact_only'] = 'Yes';
  }else{
    $data['alt_contact_only'] = 'No';
  }

  if($data['done'] == 1){
    $data['done'] = 'Yes';
  }else{
        $data['done'] = 'No';
  }

  if($data['uploaded_at'] == '01/01/1970' || $data['uploaded_at'] == '12/31/1969'){
    $data['uploaded_at'] = 'NA';
  }

    $priorityobj      = $this->model->get_where($data['priority'], 'dms_filelibrary_priority');
    $data['priority'] = $priorityobj->title;
    if(strlen( $data['priority']) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['priority'] = 'NA';
    }

    $deptobj      = $this->model->get_where($data['department'], 'dms_filelibrary_departments');
    $data['department'] = $deptobj->title;

    $accessobj      = $this->model->get_where($data['access'], 'dms_filelibrary_access');
    $data['access'] = $accessobj->title;
/*
    $subentobj      = $this->model->get_where($data['subentity'], 'honcho_user_subentities');
    $data['subentity']  = $subentobj->title;
    if(strlen( $data['subentity']) < 1){
        $data['subentity'] = '';
    }  */

    $statusobj      = $this->model->get_where($data['status'], 'dms_filelibrary_status');
    $data['status'] = $statusobj->title;
    if(strlen( $data['status']) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['status'] = 'NA';
    }

    $regobj         = $this->model->get_where($data['region'], 'ref_region_codes');
    $data['region'] = $regobj->title;
    if(strlen( $data['region']) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['region'] = '';
    }

    $ccmpobj      = $this->model->get_where($data['ccmp_id'], 'ccmps');
    $fn  = $ccmpobj->first_name;
    $ln  = $ccmpobj->last_name;
    $data['ccmp'] = $fn.' '.$ln;
    if(strlen( $data['ccmp']) < 2){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['ccmp'] = '';
    }
/*
    $husrobj = $this->model->get_one_where('trongate_user_id', $data['tg_user_id'], 'honcho_user_accounts');
    $fn  = $husrobj->first_name;
    $ln  = $husrobj->last_name;
    $data['staff'] = $fn.' '.$ln;
    if(strlen( $data['staff']) < 2){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['staff'] = '';
    }
 */

    $staffobj = $this->model->get_one_where('trongate_user_id', $data['staff'], 'honcho_user_accounts');
    $fn  = $staffobj->first_name;
    $ln  = $staffobj->last_name;
    $data['staff'] = $fn.' '.$ln;
    if(strlen( $data['staff']) < 2){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['staff'] = '';
    }

    $pocobj = $this->model->get_one_where('trongate_user_id', $data['poc'], 'honcho_user_accounts'); // see 1622
    $fn  = $pocobj->first_name;
    $ln  = $pocobj->last_name;
    $data['poc'] = $fn.' '.$ln;
    if(strlen( $data['poc']) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['poc'] = '';
    }

    $tagobj1 = $this->model->get_where($data['doctag1'], 'dms_filelibrary_doctags1');
    $tagtitle = $tagobj1->title;
    $data['doctag1'] = $tagobj1->title;

    if(strlen($tagtitle) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1

        $data['tagtitle'] = 'Missing';
    }else{
        $data['tagtitle'] = $tagtitle;

    }

    $tagobj2 = $this->model->get_where($data['doctag2'], 'dms_filelibrary_doctags2');
    $tagtitle = $tagobj2->title;
    $data['doctag2'] = $tagobj2->title;

    $typeobj = $this->model->get_where($data['doctag3'], 'dms_filelibrary_doctags3');
    $typetitle = $typeobj->title;
    $data['doctag3'] = $typeobj->title;

    if(strlen($typetitle) < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags3

        $data['typetitle'] = 'Missing';
    }else{
        $data['typetitle'] = $typetitle;
    }
// print_r($data['rectype']); die();
// print_r($data['uploaded_by']); die();
if($rectypenum == 1){ // DB entry no doc - will remain "NA" for display as set above
}else{
    $tgusrid = $data['uploaded_by']; // this would have been "NA" and caused an error
    if($tgusrid > 0){

    $tgusrobj  = $this->model->get_where( $tgusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;

    $uploader_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);

       $data['uploaded_by'] =  $uploader_obj->first_name.' '.$uploader_obj->last_name;
    }else{
       $data['uploaded_by'] = 'NA';
    }
}
//echo(1699); die();
//print_r($data['tg_user_id']); die();
    // Staff Mbr
    $tgusrid = $data['tg_user_id'];
    if($tgusrid > 0){
    $tgusrobj  = $this->model->get_where( $tgusrid,'trongate_users');
//echo(1862); die();
    $user_acct_table = $tgusrobj->login_acct_info_table;

    $uploader_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);

       $data['tg_user_id'] =  $uploader_obj->first_name.' '.$uploader_obj->last_name;
    }else{
       $data['tg_user_id'] = 'NA';
    }

    $subentity = $data['subentity'];
//print_r($subentity); die();

if($subentity > 0){

    $subentity_obj = $this->model->get_where($subentity,
                'dms_filelibrary_subentities');

       $data['subentity'] =  $subentity_obj->title;
    }else{
       $data['subentity'] = '';
    }
//echo(1864);
//json($data); die();
 switch( $filetype) {

  case '1': // DB Record
        $data['fileicon'] = 'fa fa-database fa-1x';
  break;

  case '2': // Text
        $data['fileicon'] = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $data['fileicon'] = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
        $data['fileicon'] = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
        $data['fileicon'] = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $data['fileicon'] = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
        $data['fileicon'] = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3
        $data['fileicon'] = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  default;
  $data['fileicon'] = 'fa fa-file-text-o fa-1x';
}
  // Where the Upload Button posts the selected file from the Choose File button
 // $data['form_location'] = BASE_URL.'dms-dmslibrary/submit_upload/docs';

// this really is not a physical location it is where to post form to
  $data['form_location'] = BASE_URL.'dms-dmslibrary/submit_upload/'.$recid.'/'.$_SESSION['filelibrary_rolename'];
//legacy code
//$data['form_location'] = str_replace('/submit', '/submit_upload', current_url());
//$data['form_location']  = $data['form_location'].$recid;


/*--------------------- Set Navbar & Header Information -----------------*/

/* Based on $_SESSION['filelibrary_rolename'] */

    $data['bc1']          = 'DMS';
    $data['bc2']          = 'View A Document Record';
    $data['header']       = $adobj->title;

 switch($_SESSION['filelibrary_rolename']) {

  case 'dmslibadmin':     // admin

        $data['subheader']    = 'Administrator';

  break;

  case 'dmslibastadmin': // assistant admin

        $data['header']       = $adobj->title;
        $data['subheader']    = 'Assistant Administrator';

  break;

  case 'dmslibsubadmin': // subentity

        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Administrator';

  break;

  case 'dmslibuser': // Module User

        $data['header']       = $adobj->title;
        $data['subheader']    = 'User';

  break;

  default;
//echo('1821 - No matching role');
//print_r($_SESSION['filelibrary_rolename']); die();
        // Auditlog
        $type  = 'viewdocrecrec';
        $action = '2145 - No matching role';
        $func = 'docrecord-view';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'File: '.$docdata['filename'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2084: No matching filelibrary role name ... Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

}

/*--------------------------- Set Additional Values ---------------------*/

  $data['recid']         = $recid;
  $data['view_module']   = 'dms/dmslibrary';
  $data['view_file']     = 'documentcrud'; // use all-in-one crud form for viewing

/*
echo(1980);
echo('<br>');
print_r($recid);
json($data); die();
*/

/*--------------------------- Show Doc ---------------------------*/

    $this->templates->inspinia($data);
}

/*------------------------- End View -------------------------*/


/*---------------------------- FUNCTION UPDATE --------------------------*/

  function update($retrying = ''){  // either yes or docid which it will ignore (default: this engine passes no arguments)
//print_r($retrying); die();
  $libfuncid = 6; // id in library functions table
  $authorized = $this->_check_function_permissions($libfuncid);

$_SESSION['callingfunc'] = 'update';

  $recid      = segment(3);
  $managemode = segment(4);
  $_SESSION['frmpg'] = segment(5); // from manage, view or kanban - where to return

// Find out if have admin rights by looking for a match in the honcho_users_tguserid_security_group table. dmslibuser = 5.
 $tguserid = $_SESSION['tg_user_id'];
//print_r($retrying); die();
/*
  8 - dmslibadmin
  9 - dmslibasstadmin
  7 - dmslibsubadmin
  6 - dmslibuser
  */

// DMS User
/* ??? Still needed
$sqluser = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 5";
$checkuser_obj = $this->model->query($sqluser,'object');
if(!empty($checkuser_obj)){

    $sg_obj = $this->model->get_one_where('id', 5, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibuser
}

// DMS Subentity Admin?
$sqlsubadmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 6";
$checksubadmin_obj = $this->model->query($sqlsubadmin,'object');

if(!empty($checksubadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 6, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibsubadmin

}

// DMS Admin? if both a subadmin and admin, admin from overwrite subadmin
$sqladmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 7 OR tguserid = $tguserid AND security_group_id = 1";
$checkadmin_obj = $this->model->query($sqladmin,'object');
if(!empty($checkadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 7, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibadmin
}
*/
// for testing - keeps defaulting to dmslibsubadmin when logged inas sysadmin
//$managemode = 'dmslibadmin';

// checkpoint
/*
echo(2167);
echo('<br>');
print_r($recid);
echo('<br>');
print_r($_SESSION['filelibrary_rolename']); die();
*/

    // firsttime through it passes the recid automatically so have code
    //  ingore it unless it is a "yes"
//print_r($retrying); die();
    $retry = $retrying;

    if( $retry == 'yes'){
      // retry does not pass a segment value
      // keep tab number the same for the retry
    }else{
      $_SESSION['crudtab'] = segment(4);

    }

    if($retry == 'yes'){
      $retry = 'no'; // reset - not sure if necessary
      $data = $_POST;
      unset($_POST['submit']);// not in DB will cause error

      // need to reset dropdowns to attempted values ???

    }else{ // getting record to edit
      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid, $_SESSION['filelibrary_rolename']);
 //echo(2281);
 //json($data); die();

    }

/*-------------------- Get Dropdown Values ------------------*/
    // get dropdown for all tabs

   $dropdowndata =  $this->_populate_dropdowns();
   $data = array_merge($data, $dropdowndata);
//json($data); die();

    // some dropdowns want to preselect something other than default first value
/*
    if(strlen($data['mailstatecode']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstatecode'] = 'NA';
    }
*/

/*------------- Set Navbar & Header Information --------------*/
// echo(1977);
// print_r($managemode); die();

 switch($_SESSION['filelibrary_rolename']) { //

  case 'dmslibuser': // ccmp updating from manage page
            // regular ccmp or user who can only update docs assigned to them
        $data['managemode'] = 'dmslibuserupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';
  break;

  case 'dmslibadmin': // content manager updating any Doc from manage page

        $data['managemode'] = 'dmslibadminupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';
      //  $data['subentitynm']  = $subentitynm; // set dropdown?
  break;

  case 'dmslibsubadmin': // subentity admin updating a subentity Doc from manage page

        $data['managemode'] = 'dmslibsubadminupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';

        $data['subheader']  = SUBENTITY.' Lead';
      //  $data['subentitynm']  = $subentitynm;// set dropdown?
  break;

  }

/*--------------------- Set Additional Values --------------------*/

  switch($data['filetype']) {

  case '1': // DB Record
        $data['fileicon'] = 'fa fa-database fa-1x';
  break;

  case '2': // Text
        $data['fileicon'] = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $data['fileicon'] = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
        $data['fileicon'] = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
        $data['fileicon'] = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $data['fileicon'] = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
        $data['fileicon'] = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3
        $data['fileicon'] = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  default;
  $data['fileicon'] = 'fa fa-file-text-o fa-1x';
}

    // Header Information
    $data['subentitynm']   = $_SESSION['subentity_name'];
//echo(2077);
//print_r($data['subentitynm']); die();
    // To control input fields
    $data['recid']         = $recid;

    $data['view_module']   = 'dms/dmslibrary';
    $data['view_file']     = 'documentcrud'; // use all-in-one crud form for updating

    /*------------------- Get logged in user's info & preferences -------*/

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

 /*
echo '<pre>';
print_r($data['staffs']);
echo '</pre>';
die();
*/

/*
 echo(2417);
 echo('<br>');
 print_r($recid);
 echo('<br>');
 print_r($managemode);
 echo('<br>');
 json($data); die();
*/

    $this->templates->inspinia($data);

}

/*------------------------ End update -----------------------*/

/*----------------------- FUNCTION CREATE -------------------*/

function create($retrying = ''){ // either Yes or dmslibadmincreate which it will ignore (default: this engine passes no arguments)

  $libfuncid = 7;
  $authorized = $this->_check_function_permissions($libfuncid);

/*--------- Get logged in user's info & preferences ----------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

  $retry = $retrying; // for failed validation repost
//echo(2116);
//print_r($retry); die();
// print_r($managemode); // not passed on retry through url
// print_r($_POST['manamgemode']); // posted on a retry

    if($retry == 'yes'){

        $data = $_POST; // get what was posted from the form
        $managemode = $_POST['managemode']; // dmslibadmincreate or dmslibsubadmincreate
//json($data); die();

      }else{
        // do nothing and continue
      }

// DMS User
/*      ???  Still needed
  $tguserid = $_SESSION['tg_user_id'];
//  print_r($tguserid); die();
$sqluser = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 5";
$checkuser_obj = $this->model->query($sqluser,'object');


if(!empty($checkuser_obj)){

    $sg_obj = $this->model->get_one_where('id', 5, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibuser

}

// DMS Subentity Admin?
$sqlsubadmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 6";
$checksubadmin_obj = $this->model->query($sqlsubadmin,'object');

if(!empty($checksubadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 6, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibsubadmin

}


// DMS Admin? if both a subadmin and admin, admin from overwrite subadmin
$sqladmin = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 7 OR tguserid = $tguserid AND security_group_id = 1";
$checkadmin_obj = $this->model->query($sqladmin,'object');
if(!empty($checkadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 7, 'honcho_users_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibadmin
}

*/
     // }

      // override for testing
  //$managemode = 'dmslibadmin'; // preserve managemode 1st try from changing to blank on retry

/*
echo(2171);
print_r($managemode);
echo('<br>');
print_r($retrying); die();
*/

/*-------------------------- Populate Dropdowns  -----------------------*/

    // get dropdown for all tabs
    if($retry == 'yes'){
       // need to reset dropdowns to attempted values
       $dropdowndata =  $this->_populate_dropdowns();
       $data = array_merge($data, $dropdowndata);
       //$retry = 'no'; // reset - not sure if necessary
    }else{
       $data =  $this->_populate_dropdowns(); // creates the $data array and wipes out any settings before
    }
//echo(2188);
//json($data); die();

 /* // remove any dropdown choices not priviledged to
    if($_SESSION['usermode'] == 'ccmp' || $_SESSION['usermode'] == 'dmslibsubadmin'){ // dmslibsubadmin when CA creating a doc

    // remove the Visible option public which is the 1st element
   // unset($data['ccmps_scopes'][0]); // no public docs
*/

    $data['bc1']        = 'DMS';
    $data['bc2']        = 'Create Record';
    $data['header']     = 'Document Library';
    $data['subheader']  = 'Creating Document Record';

 // tells documentcrud.php to render fields
$data['managemode'] = 'dmslibadmincreate';

//echo(1938);
//json($data); die();

  if($retry == 'yes'){ // headed back to create form
        // already the correct names
        $data['rectype']           = $data['attachingafile'];
      //  $data['shortdescription']  = $data['subject'];

//echo(2214);
//json($data); die();
  }else{ // if initial try need posted values to match DB field names

        // Initialize New Record after array has been created so not wiped out

        $data['rectype']        = 2; // defaulting to rectype = physical document vs. 1 = DB record
        $data['active']         = 1;
       // $data['done']       = 1;

        // translate field labels which tagged values may not match
        // DB field name values originally submitted to the form
        // this is a result of the dynamic field generation system in the UI

       // $data['shortdescription'] = $data['subject'];
        $data['ccmp']          = 0;
        $data['staff']         = 0;
        $data['points']        = 0;

//echo(2232);
//json($data); die();

  }

 //echo(2237); die();
       // $data['tg_user_id'] =  $_SESSION['tg_user_id']; // you are posting
       // $data['ccmp_id']    =  $_SESSION['ccmp_rec_id'];
        $data['view_module']   = 'dms/dmslibrary';
        $data['view_file']     = 'documentcrud';

// echo(2359);
// json($data); die();

        $this->templates->inspinia($data);

}

/*------------------- End function create -------------------*/

/*--------------------------- FUNCTION SUBMIT --------------------------*/

  function submit() {

//  $docfunction = 8;
 // $authorized = $this->_check_function_permissions($docfunction);
 // echo(2520);  die();
  $recid = segment(3); // if updating there will be a record id

  $submit     = post('submit', true);
  $managemode = post('managemode', true); // from a hidden field to pass thru from button to crud form to controller -better to get from SESSION ???

//  echo(2380);
//  print_r( $managemode); die(); //dmslibadminupdate

  $crudmode = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crudmode  = 'updating';
  }else{
     $crudmode  = 'adding';
  }
/*
  // checkpoint
  echo(2539);
  echo('<br>');
  echo('$_POST = ');
  json($_POST);
  echo('<br>');
  echo('$recid = ');
  print_r($recid);
  echo('<br>');
  echo('$submit = ');
  print_r($submit);
  echo('<br>');
  echo('$crudmode = ');
  print_r($crudmode);
  echo('<br>');
  echo('$retrying = ');
  print_r($retrying);
  echo('<br>');
  echo('$_session[honcho_acct_rec_id] = ');
  print_r($_SESSION['ccmp_rec_id']);
  echo('<br>');
  echo('$managemode = ');
  print_r($managemode);
  echo('<br>');
  echo('$_session = ');
  json($_SESSION); die();
*/
 // echo(2564);
 //     json($_POST); die();
if ($submit == 'Submit') {
  // Get values from post for validation purposes

  $title = $_POST['title'];

// Your are editing or creating the record - uploading the file is submit_upload

    $titlelen = strlen($_POST['title']);
    $msglen   = strlen($_POST['subject']);
//print_r($_POST['subject']); die();
//    $this->validation_helper->set_rules('title', 'Title field is '.$titlelen.
//     ' characters long and the', 'required|min_length[1]|max_length[50]');
/*
    $this->validation_helper->set_rules('subject', 'Message field'
    . ' is '.$msglen.' characters long and the',
       'required|min_length[1]|max_length[500]');
*/
  // used to cause program to logout with new engine - beta works fine so substituted validation_helper.php from beta ??? still true?

   // $result = $this->validation_helper->run();
    $result = 1; // commented out because only required field is title and using Javascript to check for that
/*
      echo(2588);
      echo('<br>');
      print_r($result);
           echo('<br>');
      print_r($_POST['access']); die();
*/

    if($_POST['access'] == 0){ // did not select an access - default 0 was posted
     //   echo(2040); die();
       set_flashdata('Error: An Access selection is required');

    $_SESSION['flashmsgcolor'] = 0; //  set flash message to red
        $result = 0;
    }

}

/*
echo(2606);
echo('<br>');
echo('$recid = ');
print_r($recid);
echo('<br>');
echo('Results of validation helpers');
echo('<br>');
echo('$result = ');
print_r($result);
echo('<br>');
echo('$_POST = ');
json($_POST); die();
*/

  if($result > 0){ // if passed all validations above - save the record

        if($recid > 0){ // Passed Updating - line 2857 passed Adding
//print_r($recid); die();


            // get some comparison information for other operations
//print_r($docdata); die();
            $docobj = $this->model->get_where($recid,'dms_filelibrary_docs');
            $currentloc = $docobj->location;
            $filename   = $docobj->filename;
            $filetype   = $docobj->filetype;
            $filedate   = $docobj->filedate;

 // only if chapter librarian would we move file
         //   $newloc     = $docdata['location']; ???

/*
echo(2633);
print_r($newloc);
echo(2373);
print_r($currentloc); die();
 */

$newloc = $currentloc;

            if($newloc == $currentloc){// did not reassign to new subentity during the editing
                // no need to move file
            }else{ // assigned doc to new subentity so need to move the file

                // however if it is DB only than no file to move so skip that step
                if($filetype == 1 || $filetype == 0){
                    // Do nothing
                }else{ // $filetype not 0 or 1


//$filepath = APPPATH.'modules/dms/dmslibrary/assets/'.$currentloc.'/'.$filename;

//print_r($filepath); die();

$yep = copy(APPPATH.'modules/dms/dmslibrary/assets/'.$currentloc.'/'.$filename, APPPATH.'modules/dms/dmslibrary/assets/'.$newloc.'/'.$filename);

if($yep == TRUE){
    // since the copy was successful now delete the orphaned file
        if (!unlink($filepath)) {

        // Auditlog
        $type  = 'CopyDeleteDoc';
        $action = 'UpdateChapter';
        $func = 'Library-submit';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Filepath:'.$filepath;
        $str5 = 'Title: '.$title;
        $str6 = 'Error 2723: File copied to new directory but the old file cannot be deleted';

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2723: The subentity on the file was successfully changed and the file copied to the new direftory but the old file cannot be deleted. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }else {
         // Everything OK. The file was moved and orphaned record deleted.
         // So now update the location
           $docdata['location'] = $newloc;
        }

}else{
        // Auditlog
        $type  = 'CopyDeleteDoc';
        $action = 'UpdateChapter';
        $func = 'Library-submit';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Filepath:'.$filepath;
        $str5 = 'Title: '.$title;
        $str6 = 'Error 2749: The file failed to copy to the new subentity location';

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2749: The file failed to copy to the new subentity location so the subentity cannot be changed. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

}
                } // $filetype not 0 or 1

            } // end of code to copy a record to a new record to avoid being overwritten


// Compare location to see if changed. If so copy file to new location
// and delete from old location
// only using a single location in this implementation

            // get values from the form
            $docdata = $_POST;
// echo(2810);
//json($_POST); die();
            // convert date picker dates to unix integer timestamps

            $docdata['assigndate']       = strtotime($docdata['assigndate']);
            $docdata['duedate']          = strtotime($docdata['duedate']);
            $docdata['eststartdate']     = strtotime($docdata['eststartdate']);
            $docdata['startdate']        = strtotime($docdata['startdate']);
            $docdata['estenddate']       = strtotime($docdata['estenddate']);
            $docdata['enddate']          = strtotime($docdata['enddate']);
            $docdata['submitted']        = strtotime($docdata['submitted']);


            if($docdata['assigndate'] == -68400){
                $docdata['assigndate'] = 0;
            }
            if($docdata['duedate'] == -68400){
                $docdata['duedate'] = 0;
            }
            if($docdata['eststartdate'] == -68400){
                $docdata['eststartdate'] = 0;
            }
            if($docdata['startdate'] == -68400){
                $docdata['startdate'] = 0;
            }
             if($docdata['estenddate'] == -68400){
                $docdata['estenddate'] = 0;
             }
            if($docdata['enddate'] == -68400){
                $docdata['enddate'] = 0;
            }
            if($docdata['submitted'] == -68400){
                $docdata['submitted'] = 0;
            }
            // Add timestamps
            $docdata['updated_at'] = TIME();
            $docdata['updated_by'] = $_SESSION['tg_user_id'];

            // translate to fields in the DB
            $docdata['done']             = $docdata['completed'];
    //        $docdata['subject']          = $docdata['subject'];
            $docdata['rectype']          = $docdata['attachingafile'];
            $docdata['ccmp_id']          = $docdata['ccmp'];
            $docdata['poc']             = $docdata['poc'];
           // $docdata['tg_user_id']       = $docdata['staff'];
//echo(2834);
//json($docdata); die();

            // these are not fields in the DB and would cause an 500 error
            unset($docdata['submit']);
            unset($docdata['csrf_token']);
            unset($docdata['managemode']);

            unset($docdata['attachingafile']);
            unset($docdata['ccmp']);
          //  unset($docdata['staff']);
            unset($docdata['completed']);

            if($docdata['rectype'] == 2){ // set to 2 or edited from 1 to 2  2 is yes, 1 is DB Record

                if($docdata['filetype'] == 0 || $docdata['filetype'] == 1 || strlen($docdata['filetype']) < 1){ // was set to DB Record - converting to doc
//echo(2496);
//print_r($docdata['filetype']); die();
                    $docdata['filetype'] == 0; // Reset to 0 until file uploaded
                }
            }
//echo(2501);
//print_r($docdata['filetype']); die();



// checkpoint
/*
echo(2861);
echo('<br>');
print_r($recid);
echo('<br>');
json($docdata); die();
 */
            $this->model->update($recid, $docdata, 'dms_filelibrary_docs');

//echo(2514);
//print_r("Updated Data Saved!"); die();
//print_r($managemode); die();

            // Auditlog
            $type  = 'update';
            $action = 'UpdateDocRec';
            $func = 'ccmp-doclib-sumbit-updating';
            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
            $format = 'minitime'; // I added to Timedate.php
            $this->module('timedate');
            $timestamp = time();
            $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: dms_filelibrary_docs';
            $str5 = 'Title: '.$docdata['title'];
            $str6 = 'Mode: '.$managemode;

            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    if($docdata['filetype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was updated successfully.');
    }else{
      set_flashdata('The document record was updated successfully.');
    }
    $_SESSION['flashmsgcolor'] = 1; // green

//echo(2543);
//print_r($managemode ); die();

    // Reset managemode
    $managemode = '';
/*
            switch($managemode) {

             case 'dmslibuser': // CCMP managing my docs


             break;

             case 'dmslibsubadminupdate': // CA managing subentity docs

                 $managemode = 'dmssublibadmin';


             break;

             case 'dmslibadminupdate': // CM managing all docs

                   $managemode = 'dmslibadmin';

             break;

           default:

        // Auditlog
        $type  = 'update';
        $action = 'No managemode';
        $func = 'ccmp-doclib-submit-update';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2585: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

           }

           */
    if($_SESSION['frmpg'] == 'k'){ // came from kanban board when launched the update
        $_SESSION['frmpg'] = ''; // reset global
                   redirect('dms-dmslibrary/kanban/k');
               // }elseif ($frmpg == 'v'){
               //    redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
    }else{
                  // redirect('dms-dmslibrary/manage/dmslibadmin');
          redirect('dms-dmslibrary/viewdocrec/'.$recid.'/'.$_SESSION['filelibrary_rolename']); // show the updated record
    }
/*---------------------- Adding a new record -------------------*/
        }else{ // Passed Adding - only one place you add from and thats manage - 2601
//echo(2879); die();
            // Show new record after adding
            $docdata = $_POST; // already did the validations so its good to go
            //
            //  $points = $_POST['points'];

            if(strlen($docdata['points']) == 0){ // not needed. defaults to 0 now
      $docdata['points'] = 0;
            }
$docdata['poc'] = $docdata['poc'];
  //  unset($docdata['lead']);

// translate strings to integers for saving
 //not necessasry but works!
    $docdata['doctag1']        = (int)$docdata['doctag1'];
    $docdata['doctag2']        = (int)$docdata['doctag2'];
    $docdata['doctag3']        = (int)$docdata['doctag3'];
    $docdata['subentity']      = (int)$docdata['subentity'];
    if($_SESSION['filelibrary_rolename'] == 'dmslibsubadmin'){
        $docdata['subentity']  = $this->_my_subentity(); // chapter admins save into their own chapter only
    }
    $docdata['region']         = (int)$docdata['region'];
 //   $docdata['attachingafile'] = (int)$docdata['attachingafile'];
    $docdata['access']         = (int)$docdata['access'];
    $docdata['priority']       = (int)$docdata['priority'];
    $docdata['status']         = (int)$docdata['status'];
    $docdata['active']         = (int)$docdata['active'];
//    $docdata['completed']      = (int)$docdata['completed'];
    $docdata['points']         = (int)$docdata['points'];
//    $docdata['ccmp']           = (int)$docdata['ccmp'];
    $docdata['staff']          = (int)$docdata['staff'];
    $docdata['poc']           = (int)$docdata['poc'];
    $docdata['blocked']        = (int)$docdata['blocked'];
    $docdata['onhold']         = (int)$docdata['onhold'];
    $docdata['rejected']       = (int)$docdata['rejected'];
    $docdata['department']       = (int)$docdata['department'];
    $docdata['done']       = (int)$docdata['done'];
    $docdata['ccmp_id']       = (int)$docdata['ccmp_id'];
     $docdata['rectype']       = (int)$docdata['rectype'];
//echo(2633);
//json( $docdata ); die();
            // translate to fields in the DB



         //   $docdata['shortdescription'] = $docdata['description']; no such thing as plain description in the database

       //     $docdata['ccmp_id']          = $docdata['ccmp']; //tagged with ccmp
          //  $docdata['tg_user_id']       = $docdata['staff']; // tagged with staff member
      //      $docdata['done']             = $docdata['completed'];
/*
  if($docdata['status'] == 0 ){ // if no status change to
      $docdata['status'] = 5; // new doc to backlog if not otherwise specified
  }
*/

            // these are not fields in the DB and would cause an 500 error
            unset($docdata['submit']);
            unset($docdata['managemode']);
            unset($docdata['description']);
            unset($docdata['attachingafile']);
            unset($docdata['ccmp']);
          //  unset($docdata['staff']);
            unset($docdata['completed']);

/*
echo(2935);
echo "<br>";
json($docdata); die();
*/

// dont let subentity admin or ccmp change the subentity - only the content manager
// the subentity dropdown is disable for adding - need to assign subentity
//    if($_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'dmslibsubadminc'){

/*
    if($managemode == 'dmslibadmincreate' || $managemode == 'dmslibsubadmincreate'){

        $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'honcho_user_accounts');
        $chptnum = $usrobj->subentity;
        $docdata['subentity']  = $chptnum; // this is where it is assigned when adding
        $docdata['location'] = $chptnum; ;

     }else{ // ccmadsc
        $docdata['subentity']  = $_POST['subentity'];
        $docdata['location'] = $_POST['subentity'];
     }

    // Initialize Defaults redundant ???
    $docdata['active'] = 1;
    $docdata['done'] = 1;
    $docdata['ccmp_id']    = $_SESSION['ccmp_rec_id'];
*/
    // If it is a DB only record user will not be uploading a file to populate the filetype field
    // So if the posted rectype = 1 the initialize with a filetype of 1 DB Record (no file)

    // no rectype or filetype posted
  //  if( $docdata['rectype'] == 1){ // DB Record
  //      $docdata['filetype'] = 1; // DB Record
  //  }

    // Other initializations not editable by the user
    $docdata['downloads'] = 0;
    $docdata['previews'] = 0;
   // $docdata['priority'] = 0;

    // Add timestamps
   // $docdata['updated_at'] = TIME();
    $docdata['created_at'] = TIME();
    $docdata['created_by'] =  $_SESSION['tg_user_id'];

//Need to convert dates to integers
    $docdata['assigndate']       = strtotime($docdata['assigndate']);
    $docdata['duedate']          = strtotime($docdata['duedate']);
    $docdata['eststartdate']     = strtotime($docdata['eststartdate']);
    $docdata['startdate']        = strtotime($docdata['startdate']);
    $docdata['estenddate']       = strtotime($docdata['estenddate']);
    $docdata['enddate']          = strtotime($docdata['enddate']);
    $docdata['submitted']        = strtotime($docdata['submitted']);

 // If any dates not entered then make them 0

    if($docdata['assigndate'] == ''){

        $docdata['assigndate'] = 0;
    }


    if($docdata['eststartdate'] == ''){

        $docdata['eststartdate'] = 0;
    };


    if($docdata['estenddate'] == ''){

        $docdata['estenddate'] = 0;
    }


    if($docdata['startdate'] == ''){

        $docdata['startdate'] = 0;
    }


    if($docdata['enddate'] == ''){

        $docdata['enddate'] = 0;
    }


    if($docdata['duedate'] == ''){

        $docdata['duedate'] = 0;
    }


    if($docdata['submitted'] == ''){

        $docdata['submitted'] = 0;
    }

/*
echo('3034 about to insert a new doc record: ');
echo "<br>";
json($docdata); die();
*/
    //insert the new document record
    $this->model->insert($docdata, 'dms_filelibrary_docs');
 //echo('Line 3040 - New doc record added!'); die();

/* This was when save filetype first (DB or filetype. Now saving rectype first (DB or file)
   if($docdata['filetype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');
    }
    */
//echo(3161);
//print_r($docdata['rectype']); die();
    if($docdata['rectype'] > 1 || $docdata['rectype'] == 0 ){ // 1 = database where there is no physical file 2 is physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');
    }
    $_SESSION['flashmsgcolor'] = 1; //  set flash message to green

// get the new record's id so can view
// OR when need to add to other tables with this foreign key
    $newid = $this->model->get_max('dms_filelibrary_docs');

    // Auditlog
    $type  = 'insert';
    $action = 'CreateDocRec';
    $func = 'ccmp-doclib-sumbit-adding';
    $un   = 'TGuid: '.$_SESSION['tg_user_id']; //$un   = 'UN: '.$_SESSION['ccmp_username'];
    $format = 'minitime'; // I added to Timedate.php
    $this->module('timedate');
    $timestamp = time();
    $time   = $this->timedate->get_nice_date($timestamp, $format);
    $time = $time.' UTC';
    $str3 = 'Rec: '.$newid;
    $str4 = 'Tbl: dms_filelibrary_docs';
    $str5 = 'Title: '.$docdata['title'];
    $str6 = 'Mode: '.$managemode;

    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


//echo('2782 $managemode');
//echo "<br>";
//print_r($managemode); die();

    // Reset $managemode
    $managemode = '';
/*
    switch($managemode) { // return to the normal state which by default is viewing

      case 'dmslibuser': // ccmp updating from manage page
                // regular ccmp w/o admin rights cannot update document records
      break;

      case 'dmslibadmincreate': // content manager creating any Doc from manage page

            $managemode = 'dmslibadmin';
            $_SESSION['managemode'] = $managemode;

      break;

      case 'dmslibsubadmincreate': // subentity admin creating a subentity Doc from manage page

            $managemode = 'dmslibsubadmin';
            $_SESSION['managemode'] = $managemode;

      break;

      default;

        // Auditlog
        $type  = 'createrec';
        $action = 'No managemode';
        $func = 'docrecord-create';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$newid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2826: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

    }
    */
        redirect('dms-dmslibrary/viewdocrec/'.$newid.'/'.$_SESSION['filelibrary_rolename']); // show the new record

      } // end passed validation updating or adding

// echo('1063 passed all validations and added or updated a record'); die();

  }else{  // failed a validation

// echo('3119 Failed validation either updating or adding '); die();

// print_r($recid); die();
      if($recid > 0){ // failed updating

// echo('3124 Failed validation updating'); die();
// print_r($docdata); die();

        $this->update('yes');

      }else{ // failed adding

// echo('3131 Failed validation adding');
// print_r($docdata); die();

        $this->create('yes');

      } // failed adding or updating

  } // end passed or failed validation

// Successful save happened by line

} // end function

/*--------------------------- End Submit -------------------------------*/

/*--------------------------- FUNCTION SUBMITDOCCOMMENT --------------------------*/
/****** NOTE! The add comment is not used.  Comments are added from a modal form.  ***/
  function submitdoccomment() {

  $docfunction = 36;
  $authorized = $this->_check_function_permissions($docfunction);
//  echo(2258);  die();
  $recid = segment(3); // if updating there will be a record id
  $managemode = segment(4);
  $submit     = post('submit', true);


 //echo(3174);
 // print_r( $managemode); die(); //dmslibadminupdate

  $crudmode = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crudmode  = 'updating';
  }else{
     $crudmode  = 'adding';
  }
/*
  // checkpoint
  echo(3192);
  echo('<br>');
  echo('$_POST = ');
  json($_POST);
  echo('<br>');
  echo('$recid = ');
  print_r($recid);
  echo('<br>');
  echo('$submit = ');
  print_r($submit);
  echo('<br>');
  echo('$crudmode = ');
  print_r($crudmode);
  echo('<br>');
  echo('$retrying = ');
  print_r($retrying);
  echo('<br>');
  echo('$_session[honcho_acct_rec_id] = ');
  print_r($_SESSION['ccmp_rec_id']);
  echo('<br>');
  echo('$managemode = ');
  print_r($managemode);
  echo('<br>');
  echo('$_session = ');
  json($_SESSION); die();
*/

if ($submit == 'Submit') {
  // Get values from post for validation purposes

  $status          = $_POST['status'];
  $fulldescription = $_POST['fulldescription'];

// Your are editing or creating the record - uploading the file is submit_upload

    $desclen = strlen($_POST['fulldescription']);
//    $msglen = strlen($_POST['subject']);
//print_r($_POST['subject']); die();
//    $this->validation_helper->set_rules('title', 'Title field is '.$titlelen.
//     ' characters long and the', 'required|min_length[1]|max_length[50]');
/*
    $this->validation_helper->set_rules('subject', 'Message field'
    . ' is '.$msglen.' characters long and the',
       'required|min_length[1]|max_length[500]');
*/
  // used to cause program to logout with new engine - beta works fine so substituted validation_helper.php from beta ??? still true?

   // $result = $this->validation_helper->run();
    $result = 1; // commented out because only required field is title and using Javascript to check for that
//      echo(3235);
//      print_r($result); die();
//      print_r($_POST['access']); die();

}

/*
echo(3250);
echo('<br>');
echo('$recid = ');
print_r($recid);
echo('<br>');
echo('Results of validation helpers');
echo('<br>');
echo('$result = ');
print_r($result);
echo('<br>');
echo('$_POST = ');
json($_POST); die();
*/

  if($result > 0){ // if passed all validations above - save the record

        if($recid > 0){ // Passed Updating - line  passed Adding

            // get values from the form
            $docdata = $_POST;
            $docdata['comment'] = $docdata['fulldescription'];

            if(strlen(trim($docdata['resolution'])) > 0){
                $docdata['status'] = 0;

            }else{
                $docdata['status'] = 1;

                $docdata['closed_at'] = 0;
            }

             if($docdata['status'] == 0 ){

                $docdata['closed_at'] = time();
                $docdata['closed_by'] = $_SESSION['tg_user_id'];
             }

            // Add timestamps
            $docdata['updated_at'] = TIME();
            $docdata['updated_by'] = $_SESSION['tg_user_id'];

            // these are not fields in the DB and would cause an 500 error
            unset($docdata['submit']);
            unset($docdata['fulldescription']);
            unset($docdata['managemode']);

// checkpoint
/*
echo(3279);
echo('<br>');
print_r($recid);
echo('<br>');
json($docdata); die();
*/
            $this->model->update($recid, $docdata, 'dms_filelibrary_docs_comments');
/*
echo(2514);
print_r("Updated Data Saved!"); die();
print_r($managemode); die();
*/
            // Auditlog
            $type  = 'update';
            $action = 'UpdateDocComment';
            $func = 'dms-doclib-sumbit-updating-comment';
            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
            $format = 'minitime'; // I added to Timedate.php
            $this->module('timedate');
            $timestamp = time();
            $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: dms_filelibrary_docs_comments';
            $str5 = 'Title: '.$docdata['comment'];
            $str6 = 'Mode: '.$managemode;

            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


      set_flashdata('The comment was updated successfully.');

    $_SESSION['flashmsgcolor'] = 1; // green

//echo(2543);
//print_r($managemode ); die();

    // Reset managemode
    $managemode = '';
/*
            switch($managemode) {

             case 'dmslibuser': // CCMP managing my docs


             break;

             case 'dmslibsubadminupdate': // CA managing subentity docs

                 $managemode = 'dmssublibadmin';


             break;

             case 'dmslibadminupdate': // CM managing all docs

                   $managemode = 'dmslibadmin';

             break;

           default:

        // Auditlog
        $type  = 'update';
        $action = 'No managemode';
        $func = 'ccmp-doclib-submit-update';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2585: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

           }

           */
    if($_SESSION['frmpg'] == 'k'){ // came from kanban board when launched the update
        $_SESSION['frmpg'] = ''; // reset global
                   redirect('dms-dmslibrary/kanban/k');
               // }elseif ($frmpg == 'v'){
               //    redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
    }else{
                  // redirect('dms-dmslibrary/manage/dmslibadmin');
          redirect('dms-dmslibrary/viewdoccomment/'.$recid .'/dmslibadmin'); // show the updated comment
    }
/*---------------------- Adding a new record -------------------*/
        }else{ // Passed Adding - only one place you add from and thats manage - 2601

            // Show new record after adding
            $docdata = $_POST; // already did the validations so its good to go
            //
            //  $points = $_POST['points'];

            if(strlen($docdata['points']) == 0){
      $docdata['points'] = 0;
            }

// translate strings to integers for saving
/* not necessasry but works!
    $docdata['doctag1']        = (int)$docdata['doctag1'];
    $docdata['doctag2']        = (int)$docdata['doctag2'];
    $docdata['doctag3']        = (int)$docdata['doctag3'];
    $docdata['subentity']      = (int)$docdata['subentity'];
    if($_SESSION['filelibrary_rolename'] == 'dmslibsubadmin'){
        $docdata['subentity']  = $this->_my_subentity(); // chapter admins save into their own chapter only
    }
    $docdata['region']         = (int)$docdata['region'];
    $docdata['attachingafile'] = (int)$docdata['attachingafile'];
    $docdata['access']         = (int)$docdata['access'];
    $docdata['priority']       = (int)$docdata['priority'];
    $docdata['status']         = (int)$docdata['status'];
    $docdata['active']         = (int)$docdata['active'];
    $docdata['completed']      = (int)$docdata['completed'];
    $docdata['points']         = (int)$docdata['points'];
    $docdata['ccmp']           = (int)$docdata['ccmp'];
    $docdata['staff']          = (int)$docdata['staff'];
    $docdata['poc']           = (int)$docdata['poc'];
    $docdata['blocked']        = (int)$docdata['blocked'];
    $docdata['onhold']         = (int)$docdata['onhold'];
    $docdata['rejected']       = (int)$docdata['rejected'];
    */
//echo(2633);
//json( $docdata ); die();
            // translate to fields in the DB

            $docdata['shortdescription'] = $docdata['shortdescription'];
            $docdata['rectype']          = $docdata['attachingafile'];
            $docdata['ccmp_id']          = $docdata['ccmp']; //tagged with ccmp
          //  $docdata['tg_user_id']       = $docdata['staff']; // tagged with staff member
            $docdata['done']             = $docdata['completed'];
/*
  if($docdata['status'] == 0 ){ // if no status change to
      $docdata['status'] = 5; // new doc to backlog if not otherwise specified
  }
*/

            // these are not fields in the DB and would cause an 500 error
            unset($docdata['submit']);
            unset($docdata['managemode']);
            unset($docdata['description']);
            unset($docdata['attachingafile']);
            unset($docdata['ccmp']);
          //  unset($docdata['staff']);
            unset($docdata['completed']);

/*
echo(2638);
echo "<br>";
json($docdata); die();
*/

// dont let subentity admin or ccmp change the subentity - only the content manager
// the subentity dropdown is disable for adding - need to assign subentity
//    if($_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'dmslibsubadminc'){

/*
    if($managemode == 'dmslibadmincreate' || $managemode == 'dmslibsubadmincreate'){

        $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'honcho_user_accounts');
        $chptnum = $usrobj->subentity;
        $docdata['subentity']  = $chptnum; // this is where it is assigned when adding
        $docdata['location'] = $chptnum; ;

     }else{ // ccmadsc
        $docdata['subentity']  = $_POST['subentity'];
        $docdata['location'] = $_POST['subentity'];
     }

    // Initialize Defaults redundant ???
    $docdata['active'] = 1;
    $docdata['done'] = 1;
    $docdata['ccmp_id']    = $_SESSION['ccmp_rec_id'];
*/
    // If it is a DB only record user will not be uploading a file to populate the filetype field
    // So if the posted rectype = 1 the initialize with a filetype of 1 DB Record (no file)

    // no rectype or filetype posted
  //  if( $docdata['rectype'] == 1){ // DB Record
  //      $docdata['filetype'] = 1; // DB Record
  //  }

    // Other initializations not editable by the user
    $docdata['downloads'] = 0;
    $docdata['previews'] = 0;
   // $docdata['priority'] = 0;

    // Add timestamps
    $docdata['updated_at'] = TIME();
    $docdata['created_at'] = TIME();
    $docdata['created_by'] =  $_SESSION['tg_user_id'];

//Need to convert dates to integers
    $docdata['assigndate']       = strtotime($docdata['assigndate']);
    $docdata['duedate']          = strtotime($docdata['duedate']);
    $docdata['eststartdate']     = strtotime($docdata['eststartdate']);
    $docdata['startdate']        = strtotime($docdata['startdate']);
    $docdata['estenddate']       = strtotime($docdata['estenddate']);
    $docdata['enddate']          = strtotime($docdata['enddate']);
    $docdata['submitted']        = strtotime($docdata['submitted']);

 // If any dates not entered then make them 0

    if($docdata['assigndate'] == ''){

        $docdata['assigndate'] = 0;
    }


    if($docdata['eststartdate'] == ''){

        $docdata['eststartdate'] = 0;
    };


    if($docdata['estenddate'] == ''){

        $docdata['estenddate'] = 0;
    }


    if($docdata['startdate'] == ''){

        $docdata['startdate'] = 0;
    }


    if($docdata['enddate'] == ''){

        $docdata['enddate'] = 0;
    }


    if($docdata['duedate'] == ''){

        $docdata['duedate'] = 0;
    }


    if($docdata['submitted'] == ''){

        $docdata['submitted'] = 0;
    }

/*
echo('2754 about to insert a new doc record: ');
echo "<br>";
json($docdata); die();
*/
    //insert the new document record
    $this->model->insert($docdata, 'dms_filelibrary_docs');
// echo('Line 2760 - New doc record added!'); die();

/* This was when save filetype first (DB or filetype. Now saving rectype first (DB or file)
   if($docdata['filetype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');
    }
    */

    if($docdata['rectype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');
    }
    $_SESSION['flashmsgcolor'] = 1; //  set flash message to green

// get the new record's id so can view
// OR when need to add to other tables with this foreign key
    $newid = $this->model->get_max('dms_filelibrary_docs');

    // Auditlog
    $type  = 'insert';
    $action = 'CreateDocRec';
    $func = 'ccmp-doclib-sumbit-adding';
    $un   = 'TGuid: '.$_SESSION['tg_user_id']; //$un   = 'UN: '.$_SESSION['ccmp_username'];
    $format = 'minitime'; // I added to Timedate.php
    $this->module('timedate');
    $timestamp = time();
    $time   = $this->timedate->get_nice_date($timestamp, $format);
    $time = $time.' UTC';
    $str3 = 'Rec: '.$newid;
    $str4 = 'Tbl: dms_filelibrary_docs';
    $str5 = 'Title: '.$docdata['title'];
    $str6 = 'Mode: '.$managemode;

    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


//echo('2782 $managemode');
//echo "<br>";
//print_r($managemode); die();

    // Reset $managemode
    $managemode = '';
/*
    switch($managemode) { // return to the normal state which by default is viewing

      case 'dmslibuser': // ccmp updating from manage page
                // regular ccmp w/o admin rights cannot update document records
      break;

      case 'dmslibadmincreate': // content manager creating any Doc from manage page

            $managemode = 'dmslibadmin';
            $_SESSION['managemode'] = $managemode;

      break;

      case 'dmslibsubadmincreate': // subentity admin creating a subentity Doc from manage page

            $managemode = 'dmslibsubadmin';
            $_SESSION['managemode'] = $managemode;

      break;

      default;

        // Auditlog
        $type  = 'createrec';
        $action = 'No managemode';
        $func = 'docrecord-create';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$newid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 2826: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

    }
    */
        redirect('dms-dmslibrary/viewdocrec/'.$newid.'/'.$_SESSION['filelibrary_rolename']); // show the new record

      } // end passed validation updating or adding

// echo('1063 passed all validations and added or updated a record'); die();

  }else{  // failed a validation

// echo('3119 Failed validation either updating or adding '); die();

// print_r($recid); die();
      if($recid > 0){ // failed updating

// echo('3124 Failed validation updating'); die();
// print_r($docdata); die();

        $this->update('yes');

      }else{ // failed adding

// echo('3131 Failed validation adding');
// print_r($docdata); die();

        $this->create('yes');

      } // failed adding or updating

  } // end passed or failed validation

// Successful save happened by line

} // end function

/*--------------------------- End Submitdoccomment -------------------------------*/
/*------------------------ Function Fulldoc -----------------------------*/

/* Populates fulldescription.php view to show the fulldescription field */

  function fulldoc() { // called by a view's <a> tag

  $docfunction = 9;
  $authorized = $this->_check_function_permissions($docfunction);

 $doc_id = segment(3);
// $tgusrid = segment(4);
$_SESSION['tab'] = 0; // doc board section - open collapse when close doc - no doc collapse
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences -----------*/

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

//echo(2885);
//print_r($doc_id); die();

// Get record to view

    $adobj = $this->model->get_where($doc_id,'dms_filelibrary_docs');

    $data['tg_user_id']       = $adobj->tg_user_id;
    $data['ccmp_id']          = $adobj->ccmp_id;
    $data['downloads']        = $adobj->downloads;
    $data['active']           = $adobj->active;
    $data['done']             = $adobj->done;
    $data['status']           = $adobj->status;
    $data['doctag']           = $adobj->doctag;
    $data['doctype']          = $adobj->doctype;
    $data['filetype']         = $adobj->filetype;
    $data['filemime']         = $adobj->filemime;
    $data['priority']         = $adobj->priority;
    $data['scope']            = $adobj->scope;
    $data['region']           = $adobj->region;
    $data['department']       = $adobj->department;
    $data['access']           = $adobj->access;
    $data['subentity']        = $adobj->subentity;
    $data['title']            = $adobj->title;
        $data['subject']            = $adobj->subject;
    $data['author']           = $adobj->author;
    $data['shortdescription'] = $adobj->shortdescription;
    $data['fulldescription']  = $adobj->fulldescription;
    $data['notes']            = $adobj->notes;
    $data['filename']         = $adobj->filename;
    $data['filesize']         = $adobj->filesize;
    $data['filedate']         = $adobj->filedate;
    $data['location']         = $adobj->location;
    $data['orglogo']          = $adobj->orglogo;
    $data['smallimage']       = $adobj->smallimage;
    $data['largeimage']       = $adobj->largeimage;
    $data['extlink']          = $adobj->extlink;
    $data['uploaded_at']      = $adobj->uploaded_at;
    $data['uploaded_by']      = $adobj->uploaded_by;
    $data['created_at']       = $adobj->created_at;
    $data['created_by']       = $adobj->created_by;
    $data['updated_at']       = $adobj->updated_at;
    $data['updated_by']       = $adobj->updated_by;

    $data['poc']             = $adobj->assignedto;
//echo(2927);
//print_r($data['poc']); die();
    $data['assigndate']       = $adobj->assigned;
    $data['duedate']          = $adobj->duedate;
    $data['eststartdate']     = $adobj->eststart;
    $data['startdate']        = $adobj->actualstart;
    $data['estenddate']       = $adobj->estend;
    $data['enddate']          = $adobj->actualend;
    $data['submitted']        = $adobj->submitted;

    $data['onhold']           = $adobj->onhold;
    $data['holdreason']       = $adobj->holdreason;
    $data['blocked']          = $adobj->blocked;
    $data['blocker']          = $adobj->blocker;

    $data['rejected']         = $adobj->rejected;
    $data['rejectreason']     = $adobj->rejectreason;

    $tgusrid                  = $adobj->tg_user_id;

  // Translate codes
      $tgusrid   = $adobj->tg_user_id;
      // Check the ccmp
      $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid, 'honcho_user_accounts');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

      $this->module('timedate');
      $format = 'datepicker_us';
      $data['created_at']  = $this->timedate->get_nice_date($data
              ['created_at'], $format);
      $data['updated_at']  = $this->timedate->get_nice_date($data
              ['updated_at'], $format);
 //print_r($data['created_at']); die();
      $data['bc1'] = 'DMS';
      $data['bc2'] = 'View Document';

      $data['view_module']      = 'dms/dmslibrary';
      $data['view_file']        = 'fulldescription';

//echo(2966);
//print_r($data); die();

        $this->templates->inspinia($data);

  }

/*------------------------------- End fulldoc ---------------------------*/

/*------------------------ Function Fulldescription ---------------------*/
/* Populates fulldescription.php view to show the fulldescription field       */

  function fulldescription() { // called ccmphome view <a> tag

    $docfunction = 10;
    $authorized = $this->_check_function_permissions($docfunction);

    $rec_id = segment(3);
    $data['frompage']  = segment(4); // came from either manage (m) or view (v) pageso return there in back button

    $_SESSION['tab'] = 3; // bulletin board section - open collapse when close bulletin
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences ------------*/

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

//echo(2994);
//print_r($bulletin_id); die();
//
  // Get record to view
  $adobj = $this->model->get_where($rec_id,'dms_filelibrary_docs');

  // assign values to the data array and pass to fulldescription view page

    $data['id']               = $adobj->id;
 //   $data['tg_user_id']       = $adobj->tg_user_id;
    $data['ccmp_id']          = $adobj->ccmp_id;
    $data['downloads']        = $adobj->downloads;
    $data['active']           = $adobj->active;
    $data['done']             = $adobj->done;
    $data['rectype']          = $adobj->rectype;
    $data['doctag']           = $adobj->doctag;
    $data['doctype']          = $adobj->doctype;
    $data['filetype']         = $adobj->filetype;
    $data['filemime']         = $adobj->filemime;
    $data['priority']         = $adobj->priority;
    $data['scope']            = $adobj->scope;
    $data['access']           = $adobj->access;
    $data['region']           = $adobj->region;
    $data['department']       = $adobj->department;
    $data['subentity']        = $adobj->subentity;
    $data['title']            = $adobj->title;
    $data['author']           = $adobj->author;
    $data['shortdescription'] = $adobj->shortdescription;
    $data['fulldescription']  = $adobj->fulldescription;
    $data['notes']            = $adobj->notes;
    $data['filename']         = $adobj->filename;
    $data['filesize']         = $adobj->filesize;
    $data['filedate']         = $adobj->filedate;
    $data['location']         = $adobj->location;
    $data['orglogo']          = $adobj->orglogo;
    $data['smallimage']       = $adobj->smallimage;
    $data['largeimage']       = $adobj->largeimage;
    $data['extlink']          = $adobj->extlink;
    $data['uploaded_at']      = $adobj->uploaded_at;
    $data['uploaded_by']      = $adobj->uploaded_by;
    $data['created_at']       = $adobj->created_at;
    $data['created_by']       = $adobj->created_by;
    $data['updated_at']       = $adobj->updated_at;
    $data['updated_by']       = $adobj->updated_by;

    $data['poc']             = $adobj->assignedto;
    $data['assigndate']       = $adobj->assigned;
    $data['duedate']          = $adobj->duedate;
    $data['eststartdate']     = $adobj->eststart;
    $data['startdate']        = $adobj->actualstart;
    $data['estenddate']       = $adobj->estend;
    $data['enddate']          = $adobj->actualend;
    $data['submitted']        = $adobj->submitted;

    $data['onhold']           = $adobj->onhold;
    $data['holdreason']       = $adobj->holdreason;
    $data['blocked']          = $adobj->blocked;
    $data['blocker']          = $adobj->blocker;

    $data['rejected']         = $adobj->rejected;
    $data['rejectreason']     = $adobj->rejectreason;

    $_SESSION['oldfilename']  = $adobj->filename;

  $tgusrid        = $adobj->tg_user_id;
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'honcho_user_accounts');
  $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

/*--------------------- Convert to User Friendly Values -----------------*/

  $data['created_at']       = $adobj->created_at;
  $data['updated_at']       = $adobj->updated_at;
  $data['uploaded_at']      = $adobj->uploaded_at;

  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);
  $data['uploaded_at']  = $this->timedate->get_nice_date($data['uploaded_at'],
          $format);
/*--------------------- Set Navbar & Header Information -----------------*/
//echo 3076;
//print_r($_SESSION['ccmpmode']); die(); // dmslibadminv
 switch($_SESSION['filelibrary_rolename']) {
 /* {

  case 'ccmp': // Refresh page while viewing

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View DB Record';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
 //       $data['subentitynm']    = $subentity_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;

  break;

  case 'ccmpv': // Refresh page while viewing

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
 //       $data['subentitynm']    = $subentity_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;

  break; */

  case 'dmslibsubadmin': // subentity admin refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A DB Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Admin';

  break;

  case 'dmslibsubadminv': // subentity admin refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Admin';

  break;

  case 'dmslibadmin': // content manager refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A DB Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Library Admin';


  break;

  case 'dmslibadminv': // content manager refreshes page during view
//echo(3140); die();
        $_SESSION['ccmpmode']   = 'dmslibadminv'; // manage all  viewing
        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager';

  break;

  default;

        // Auditlog
        $type  = 'viewfulldesc';
        $action = 'No role';
        $func = 'docrecord-view';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3169: No matching ccmpmode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

}

      $data['view_module']      = 'dms/dmslibrary';
      $data['view_file']        = 'fulldescription';

//echo(3178);
//print_r($data); die();

        $this->templates->inspinia($data);

  }

/*------------------------------- End fulldescription -------------------*/

/*------------------------------- Function Bulkaction -------------------*/

  function bulkaction() {

echo "DMS-library-bulkaction() ... Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

    $docfunction = 11;
    $authorized = $this->_check_function_permissions($docfunction);

        $data = $_POST; // array of record ids called id & the dropdown item id

        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action

        break;

         case '2':
                if(!isset($data)){
                   die('2Nothing Checked');
                }else{
  print_r($data); die('Approve Docs');
                }

        break;

         case '3':
                if(!isset($data)){
                   die('3Nothing Checked');
                }else{
  print_r($data); die('Disapprove Docs');
                }
        break;


         case '4':
                if(!isset($data)){
                   die('4Nothing Checked');
                }else{
  print_r($data); die('Hide Docs');
                }

        break;

         case '5':
                if(!isset($data)){
                   die('5Nothing Checked');
                }else{
  print_r($data); die('Unhide Docs');
                }
        break;

         case '6':
                if(!isset($data)){
                   die('6Nothing Checked');
                }else{
 //  print_r($data);
//  print_r($data['id']) ; die('Delete');
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number

//print_r($delid );
                            // Need to grab title before delete for the log
                            $adobj = $this->model->get_where($delid,'dms_filelibrary_docs');
                            $title = $adobj->title;
                           // print_r($title); die();

                            // Hard delete
                            $this->model->delete($delid, 'dms_filelibrary_docs');
//echo('Deleted!'); die();

                            // Auditlog
                            $type  = 'bulkdelete';
                            $action = 'HardDeleteDoc';
                            $func = 'docs-bulkaction-case 6';
                            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
                            $format = 'minitime'; // I added to Timedate.php
                            $this->module('timedate');
                            $timestamp = time();
                            $time   = $this->timedate->get_nice_date($timestamp, $format);
                            $time = $time.' UTC';
                            $str3 = 'Rec: '.$delid;
                            $str4 = 'Tbl: dms_filelibrary_docs';
                            $str5 = 'Title: '.$title;
                            $str6 = 'Mode: '.$managemode;

                            $this->module('system-auditlogger');
                            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

                            //print_r('deleted all'); die();
                        }else{
                            echo('Line 117 library.php - row IS BLANK'); die();
                        }
                    } // end foreach
                }

        break;

         case '7':
                if(!isset($data)){
                   die('7Nothing Checked');
                }else{
  print_r($data); die('Archive');
                }

        break;

        }
    //    echo('109');
    //    print_r($_SESSION['ccmpmode']); die();

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': //  Chapter Admin managing your subentity docs
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': //  Chapter Admin managing your subentity docs
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // Content Mgr managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

        }

  }

/*------------------------ End bulkaction ------------------------*/

/*------------------------ Function approvedoc -------------------*/

   function approvedoc() {

    $docfunction = 12;
    $authorized = $this->_check_function_permissions($docfunction);

    $recid = segment(3);
    $managemode = segment(4);
    $frmpg = segment(5); // from manage, view or kanban
  //  echo(3356);
  //  print_r($recid);
  //  print_r($managemode);
  //  print_r($frmpg); die();

        $data['status']   = 1; // approved
        $data['blocked']  = 0;
        $data['onhold']   = 0;
        $data['rejected'] = 0;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(3351);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'ApproveDoc';
        $func = 'docs-approvedoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

      default;

        // Auditlog
        $type  = 'approvedoc';
        $action = 'No role';
        $func = 'doc-approvedoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3415: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }
/*------------------------------ End approvedoc ------------------------*/

/* --------------------- Function hiderecord ------------------- */

    function hiderecord() {

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        $docfunction = 13;
        $authorized = $this->_check_function_permissions($docfunction, $recid);

        // if delete it doesnt matter where you came from you go back to manage
        //because intent at that time is not to see the details.

        $data['active'] = 0;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(3438);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'HideDoc';
        $func = 'docs-hiderecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'hiderecrec';
        $action = 'No role';
        $func = 'docrecord-hiderec';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3516: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*-------------------------- End hiderecord ----------------------*/

/* -------------------- Function unhiderecord ------------------- */

    function unhiderecord() {

        $docfunction = 14;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.
 //print_r($managemode); die();
        $data['active'] = 1;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(1412);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'UnhideDoc';
        $func = 'docs-unhiderecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

     default;

        // Auditlog
        $type  = 'unhiderec';
        $action = 'No role';
        $func = 'docrecord-unhidedoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3601: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*------------------------------- End unhiderecord ----------------------*/

/* -------------------------- Function delrecord ---------------------- */

    function delrecord() {

    $recid = segment(3);
    $managemode = segment(4);
    $frmpg = segment(5); // from manage, view or kanban
//print_r($recid); die();
        $docfunction = 15;
        $authorized = $this->_check_function_permissions($docfunction, $recid);

        $docobj        = $this->model->get_one_where('id', $recid, 'dms_filelibrary_docs');
        $title         = $docobj->title; // need the name for the auditlog
        $filename      = $docobj->filename;
        $filetype      = $docobj->filetype; // if 1 then no associated file to delete
        $subentfileloc = $docobj->subentity; // all documents are in a subentity file directory
//print_r( $filetype ); die();
if($filetype == 0 || $filetype == 1){ // 0 = File Missing or 1 = DB Record (no file)
    // no file to delete so skip removal step
}else{
        // remove file from disk
        $file_pointer = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filename;
     //   $path = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/';
        if (!unlink($file_pointer)) {

echo "Error: 3613 file cannot be deleted. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }else {
         //   echo ("$file_pointer has been deleted"); die();
        }
}
//print_r($title); die();
//print_r($_SESSION['ccmpmode']);die();

$deldata['soft_deleted'] = 1;
$result = $this->model->update($recid, $deldata, 'dms_filelibrary_docs');

//    $result = $this->model->delete($recid,'dms_filelibrary_docs');
//print_r($result); die();

    //  Auditlog
        $type  = 'delete';
        $action = 'SoftDeleteDoc';
        $func = 'docs-delrecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

// Can delete from Manage or View pages so need both cases for each mode
        switch($_SESSION['filelibrary_rolename']) {
/*        switch($_SESSION['ccmpmode']) {
          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    /*      case 'ccmpv': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadminv': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadminv': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'deleterec';
        $action = 'No managemode';
        $func = 'dms-delrecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3717: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

}

/*----------------------------- End delrecord -----------------*/

/* --------------------- Function undelrecord ---------------- */

  function undelrecord() {

    $recid = segment(3);
    $managemode = segment(4);
    $frmpg = segment(5); // from manage, view or kanban
//print_r($recid); die();
    $docfunction = 32;
    $authorized = $this->_check_function_permissions($docfunction, $recid);

    $docobj        = $this->model->get_one_where('id', $recid, 'dms_filelibrary_docs');
    $title         = $docobj->title; // need the name for the auditlog
    $filename      = $docobj->filename;
    $filetype      = $docobj->filetype; // if 1 then no associated file to delete
    $subentfileloc = $docobj->subentity; // all documents are in a subentity file directory

//print_r( $filetype ); die();
if($filetype == 0 || $filetype == 1){ // 0 = File Missing or 1 = DB Record (no file)
    // no file to delete so skip removal step
}else{
    // has a file been uploaded yet to undelete?
    if(strlen($filename) > 0){
        // remove file from disk
        $file_pointer = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filename;
     //   $path = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/';
        if (!unlink($file_pointer)) {

echo "Error: 4036 file cannot be undeleted. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();
    }
        }else {
         //   echo ("$file_pointer has been deleted"); die();
        }
}
$undeldata['soft_deleted'] = 0;
$result = $this->model->update($recid, $undeldata, 'dms_filelibrary_docs');
//print_r($result); die();

    //  Auditlog
        $type  = 'undelete';
        $action = 'UnDeleteDoc';
        $func = 'dms-undelrecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

// Can delete from Manage or View pages so need both cases for each mode
        switch($_SESSION['filelibrary_rolename']) {
/*        switch($_SESSION['ccmpmode']) {
          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    /*      case 'ccmpv': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadminv': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadminv': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'undelrec';
        $action = 'No role';
        $func = 'dms-unhide';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3835: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

}

/*--------------------- End undelrecord -----------------------*/

/* ------------------ Function previewdocrec ----------------- */

  function previewdocrec() {

    $docfunction = 16;
    $authorized = $this->_check_function_permissions($docfunction);

    $docid    = segment(3);
    $filename = segment(4);
    $filetype = segment(5);

// Replace %20 with a space but when upload system inserts _ for spaces so Ill do this here
    $filenm = str_replace('%20', '_', $filename);
//print_r($filenm); die();

        switch($filetype) {

          case '1': // show database entry in a modal
echo(3725);
print_r($fulldescription); die();
            exit;

          break;

          case '2': // Text .txt Will open in same browser window if don't target = use _blank
//echo(3732); die();
            header('Content-disposition: inline');
            header('Content-type: text/plain');
            readfile('../public/filelibrary/'.$filenm); // not in public in dms/filelibrary/assets/...
            exit;

          break;

          case '3': // PDF .pdf

            header('Content-disposition: inline');
            header('Content-type: application/pdf');
            readfile('../public/filelibrary/'.$filenm);
            exit;

          break;
          case '4': // Word .docx
header('Content-disposition: inline');
header('Content-type: application/msword'); // not sure if this is the correct MIME type
readfile('<?= BASE_URL ?>/dms-dmslibrary/50/hello.docx');
exit;
          //  readfile('../public/filelibrary/'.$filenm);
          //  exit;

          break;
        default;

        // Auditlog
        $type  = 'docfunction';
        $action = 'UnsupportedDoctype';
        $func = 'docfunction-preview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 3778: Preview not supported for document type. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

      }
    }

/*------------------------------- End previewdocrec --------------------*/

/* --------------------------- Function downloaddoc ------------------- */

  function downloaddoc() {

    $docfunction = 17;
    $authorized = $this->_check_function_permissions($docfunction);

//    echo(4782); die(); // this stop breaks pdf downloads but not word docs
    $docid    = segment(3);
    $preview  = segment(4); // if pass a p as the last parameter
 //   $filename = segment(4);  // cant pass in URL - server blocks
//print_r($docid); die();// 1
//print_r($preview); die(); //  'p'

// Replace %20 with a space - works but server wont pass %20 in URL and get 403 and this function wont run
// therefore only pass docid and go get the filename & type from DB
// and then correct

    $docobj    = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');

    $filename  = $docobj->filename;
    $filetype  = $docobj->filetype;
    $filemime  = $docobj->filemime;  // what was automatically saved when the file was uploaded - read from $_FILES as file_type

//    $filenm    = str_replace('%20', '_', $filename);
$filenm = str_replace(['%20',' ', '_'], '-', $filename);  // when uploaded, spaces were converted to dashes
//print_r($filenm); die();
    $downloads = $docobj->downloads;
    $previews  = $docobj->previews;

    $subentfileloc = $docobj->subentity;
    $fileloc       = $docobj->location;

 //  print_r($subentfileloc); die();

//print_r($previews); die(); // 0

// Use the $filetype to get the proper mime
    $filetypeobj = $this->model->get_one_where('id', $filetype, 'dms_filelibrary_filetypes');
    $mimetype    = $filetypeobj->mime;
    // $mimetype   = $filemime; // doesnt download - loads machine code
 //   $mimetype    = "application/octet-stream";

/*
echo(3829);
print_r($mimetype);
echo('<br>');
print_r($filemime);
die();
*/
    // If there is a subdirectory for each subentity by number so don't overwrite other subentitys doc with same name

/*
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/force-download";
*/
    /*
echo(3851);
print_r($previews);
echo('<br>');
print_r($preview); die();
*/

//   echo(3857);
//   print_r($filetype); die();
//   print($subentfileloc); die();
//    print_r($filenm); die();
if($preview == 'p'){
        switch($filetype) {

          case '2': // Text .txt

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
         //   header('Content-type: application/octet-stream');  // or text/plain
         //   readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm); // all in one dir filelibrary
            readfile(APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm);
           // exit;

          break;

          case '3': // PDF .pdf
//echo(3876); die(); // previews is correct it has added 1
      $filepath = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm;
 //print_r($filepath); die();
//      if(file_exists($filepath)){
            header('Content-disposition: inline; filename='.$filenm);
//echo(3881); die(); // here the number has added 1

            header($mimetype);

               readfile($filepath);
//echo(3886); die(); // here the number has added 2 - try to subtract 1
   //     $docobj    = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');
   //     $previews  = $docobj->previews;
   //     $previews = $previews - .5;
   //     $upddata['previews'] = $previews;
   //     $this->model->update($docid, $upddata, 'dms_filelibrary_docs');
   // echo(3892); die(); // if try to subtract 1 above you get 0 (it subtracts 2)
   // // if you try to subtract a half it adds 2!
          //  header('Content-type: application/pdf');
//            readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);


//          }else{
//echo('Error: 3899 No file exist - hit the back button and contact the administrator'); die();
 //         }

          break;

          case '4': // Word Doc .docx only

//  echo(3348); die();
//$filenm = "Hello.docx"; // for testing

               if($preview == 'p'){
                       $filepath = APPPATH.'modules/dms/dmslibrary/assets/'.$fileloc.'/'.$filenm;
/*
               echo('fileloc');
              print_r($fileloc);
              echo('<br>');
              print_r($filenm);
              echo('<br>');
              print_r($mimetype);
              echo('<br>');
              print_r($filepath);
              echo('<br>');
             echo('Does file exist? (blank = No, 1 = Yes): '); print_r(file_exists($filepath)); die();
*/
          if(file_exists($filepath)){  // previewing & file exists
            /*    header('Content-disposition: inline');
                header('Content-type: application/octet-stream'); // not sure if this is the correct MIME type
                readfile($filepath); */
$file = $filepath;
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: inline; filename="' . basename($file) . '"');
header('Content-Length: ' . filesize($file));

if (ob_get_level()) {
    ob_end_clean(); // This discards anything currently in the buffer
}
readfile($filepath);
exit;
readfile($file);

          }else{// previewing & file doesn't exist
echo('Library Error: 3706 Preview File not found - hit the back button and contact the administrator'); die();
          }

               }else{  // not preview, downloading

          //    $filepath = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm;
                $filepath = APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm;

/*
              print_r($subentfileloc);
              echo('<br>');
              print_r($filenm);
              echo('<br>');
              print_r($mimetype);
              echo('<br>');
              print_r($filepath);
              echo('<br>');
             echo('Does file exist? (blank = No, 1 = Yes): '); print_r(file_exists($filepath)); die();
*/
          if(file_exists($filepath)){ // downloading & file exists
              header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
       //    header('Content-Type: application/msword');
        //    header('Content-Type: application/octet-stream');
            header('Content-Description: File Transfer');
        //    header('Content-Disposition: attachment; filename="TEST_FILE.docx"');
            header('Content-Disposition: attachment; filename='.$filenm); // New filename (set to old)
            //header('Content-Disposition: inline; filename='.$filenm);

if (ob_get_level()) {
    ob_end_clean(); // This discards anything currently in the buffer
}

    readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);
        //    readfile($filepath);
            exit;

        //readfile(APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm);

        //    header('Content-disposition: inline; filename='.$filenm);
        //    header($mimetype);

         //   header('Content-type: application/msword');
         //   header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');


         //   readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);
//$checkpath = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm;
//print_r($checkpath); die();
          //  readfile(APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$filenm);

          }else{ // downloading & file doesnt exist
echo('Library Error: 3976 Download File not found - hit the back button and contact the administrator'); die();
          }
          }
          break;


          case '6': // Powerpoint  .pptx only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
         //   header('Content-type: application/ms-powerpoint');
            readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);
            exit;

          break;


          case '7': // Excel  .xlsx only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
        //    header('Content-type: application/ms-excel');
        //   header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);
            exit;

          break;

          case '8': // Zip  .zip only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
          //  header('Content-type: application/zip');
          //  readfile('../public/filelibrary/'.$filenm);
            readfile(APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm);
            exit;

          break;
// .doc Content-type: application/msword
// .csv text/csv
// .gif image/gif
// .htm, .html text/html
// unknown application/octet-stream

    }

        // Opens pdf in browser where download will open pdf in acrobat
        // if preview dont count as a download
       // $previews = $previews + 1;
       // $upddata['previews'] = $previews;
    //    $this->model->update($docid, $upddata, 'dms_filelibrary_docs');
/*
echo(4028);
echo('<br>');
print_r($previews);
echo('<br>');
print_r($upddata['previews']); die();
 */
    //    $previews = 0;// reset to avoid double counting if run twice in a row
     //   $upddata['previews'] = 0; // reset to avoid double counting if run twice in a row

        // Auditlog
        $type  = 'preview';
        $action = 'PreviewDoc';
        $func = 'library-downloaddoc-preview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docobj->id;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docobj->title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
    }else{ // not previewing - downloading
//echo(5058); die();
// 1. Set the correct MIME type for .docx
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

// 2. Clear any potential "junk" or white space in the buffer
if (ob_get_level()) {
    ob_end_clean();
}

// 3. Set the disposition. Always wrap the filename in quotes to handle spaces!
header('Content-Disposition: attachment; filename="' . $filenm . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

// 4. Important: Set the Content-Length so the browser knows the file size
$full_path = APPPATH.'modules/dms/dmslibrary/assets/docs/'.$filenm;

// print_r($full_path); die();
if (file_exists($full_path)) {
    header('Content-Length: ' . filesize($full_path));
    readfile($full_path);

    // 5. CRITICAL: Stop the script immediately
    exit;
} else {
    die("Error: File not found.");
}




        $downloads = $downloads + 1;
        $upddata['downloads'] = $downloads;


    //print_r($upddata); die();
        $this->model->update($docid, $upddata, 'dms_filelibrary_docs');
    //print_r($upddata['downloads']); die();
        $downloads = 0;// reset to avoid double counting if run twice in a row
        $upddata['downloads'] = 0; // reset to avoid double counting if run twice in a row

//print_r($downloads);
//print_r($upddata['downloads']); die();
        // Auditlog
        $type  = 'download';
        $action = 'DownloadDoc';
        $func = 'library-downloaddoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docobj->id;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docobj->title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
    }
//print_r('exited'); die();
  }

/*------------------------------- End downloaddoc ----------------------*/

/* --------------------------- Function submit_upload ------------------ */

   function submit_upload() {

//    $docfunction = 18;
//    $authorized = $this->_check_function_permissions($docfunction);

    $docid = segment(3);
    $managemode = segment(4);
    $orgfiledate = substr($_POST['moddate'], 0,25);


//  print_r($_POST['moddate']); die();

/*
echo(5188);
echo("<br>");
print_r($docid);
echo("<br>");
print_r($managemode);
echo("<br>");
print_r($orgfiledate);
echo("<br>");
print_r($_FILES['my_file']['name']); die();
*/

  if ($_FILES['my_file']['name'] == '') {
    redirect($_SERVER['HTTP_REFERER']);
  }

    // Stores the file name
    $filename = $_FILES['my_file']['name'];

    // Store the file mime type - NOT USED - but can show what mime to add to filetype table
    $type = $_FILES["my_file"]["type"];
    $filemime = $type;

    // Store the files full path
    $fullpath = $_FILES["my_file"][""];

    // Store the file size
    $size = $_FILES["my_file"]["size"];
    $filesize = $size/1024;
    $filesize = round($filesize , 1);

    $ext =  strtolower(pathinfo($filename,PATHINFO_EXTENSION));

    $docrecobj = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');
//json($docrecobj); die();
    $filetype    = $docrecobj->filetype; // number
    $subentfileloc  = $docrecobj->subentity; // number
  //  $docrecfilename = $docrecobj->filename; // to test if spelled wrong

 /*
    echo "File actual name is ". $filename."<br>";
    echo "File has ".$type." mime type" . "<br>"; // not in tg docs
    echo "File has size of ".$filesize."<br>"; // not in tg docs
    echo "File has extension of ".$ext."<br>"; // not in tg docs
    echo "Record filetype is ".$docfiletype."<br>"; // not in tg docs
 //   echo "File fullpath of ".$fullpath."<br>"; // not used ??? - not in tg docs
 //   echo "File location of ".$location."<br>"; // not used ??? - not in tg docs
    die();
*/

            switch ($ext){
            case 'txt':
                $uploadfiletype = 2;
            break;

            case 'pdf':
                $uploadfiletype = 3;
            break;

            case 'doc':
                $uploadfiletype = 4;
            break;

            case 'docx':

                $uploadfiletype = 4;
            break;

            case 'ppt':
                $uploadfiletype = 5;
            break;

            case 'pptx':
                $uploadfiletype = 5;
            break;

            case 'xls':
                $uploadfiletype = 6;
            break;

            case 'xlsx':
                $uploadfiletype = 6;
            break;

            case 'zip':
                $uploadfiletype = 7;
            break;

            case 'mp3':
                $uploadfiletype = 8;
            break;

            case 'mp4':
                $uploadfiletype = 9;
            break;

            case 'mov':
                $uploadfiletype = 10;
            break;

            case 'jpg':
                $uploadfiletype = 11;
            break;

            case 'jpeg':
                $uploadfiletype = 11;
            break;

            case 'png':
                $uploadfiletype = 12;
            break;

            case 'bmp':
                $uploadfiletype = 13;
            break;

            default;

    set_flashdata('Error 4230: File type '.$ext.' is not allowed. Contact the System Administrator '.SYS_ADMIN_PHONE.'. Use the back button.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('dms-dmslibrary/viewdocrec/'.$docid);
        }

/* this whole section was if you asked for and saved the filetype on the record first.

// if $filetype has been saved then see if it matches what trying to upload

if( $uploadfiletype  ==  $docfiletype ){
    // uploading the type of file you specified
    // all is OK
//echo('4242 filetypes match!'); die();

}else{
// not uploading the filetype specified on the record
    $result = 0; // fail validation

//echo('4248 filetypes dont match!'); die();

    set_flashdata('The document file type does not match the type on the record. Try another document or change the file type on the record.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('dms-dmslibrary/viewdocrec/'.$docid);
}
*/
  //PLEASE NOTE: max_size is in kilobytes
//  $validation_str = 'allowed_types[pdf,txt,xlsx,docx,pptx,gif,jpg,jpeg,png,bmp,zip,mp3,mp4,mov]|max_size[20000]'; // 20mb
//  $this->validation_helper->set_rules('my_file', 'file', $validation_str);

 // $result = $this->validation_helper->run();

 $result = 1;
/*
echo(5239);
print_r($result);
print_r($filename);
print_r($docid); die();
*/
  if ($result == true) {

 //   print_r($docid); die();
    $docobj = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');
    $subentfileloc = $docobj->subentity; // number
 //json($docobj); die();


    // If you are replacing a file there will be an old filename
    // If you are uploading to a newly created record it will be NULL
    $oldfilename     = $docobj->filename;
//print_r($oldfilename); die();
// Ex. "1 YIAP Brochure - Signed - Rayan Salahuddin.pdf "" -> 1_yiap_brochure_signed_rayan_salahuddin.pdf
// Must be done in this order. There may be threes and twos underscores after system replaces things with underscores
    $oldfilename = str_replace(' ', '_', $oldfilename); // replace space with underscore
    $oldfilename = str_replace('___', '_', $oldfilename);  // convert triple underscores to single
    $oldfilename = str_replace('__', '_', $oldfilename);  // convert double underscores to single
    $oldfilename = strtolower($oldfilename);

    $oldfilelocation = $docobj->location;
    $oldfilelocation = str_replace(' ', '_', $oldfilelocation);
    $oldfilelocation = strtolower($oldfilelocation);

    $newfilename = $filename;
// this new system (bizwebsolutions) server uses dashes so rename db fiename stored with dashes for retrieval
    $newfilename = str_replace(' ', '-', $newfilename); // replace space with dash
    $newfilename = str_replace('---', '-', $newfilename);  // convert triple underscores to dash
    $newfilename = str_replace('--', '-', $newfilename);  // convert double underscores to dash
    $newfilename = str_replace('_', '-', $newfilename); // replace underscore with dash
    $newfilename = str_replace('---', '-', $newfilename);  // convert triple dashs to dash
    $newfilename = str_replace('--', '-', $newfilename);  // convert double dashs to dash
    $newfilename = strtolower($newfilename);


/* old system uploaded with underscores for spaces
    $newfilename = str_replace(' ', '_', $newfilename); // replace space with underscore
    $newfilename = str_replace('___', '_', $newfilename);  // convert triple underscores to single
    $newfilename = str_replace('__', '_', $newfilename);  // convert double underscores to single
    $newfilename = strtolower($newfilename);
*/
    // if you didnt already save filetype on record before strating the upload
    // $docdata will save it on the update below.
    // if you are using the ask the user for filetype upfront then comment this out
    // and use commented out code below that compares what was already saved on the record
    // with what was just uploaded

    $docdata['filetype'] = $uploadfiletype;
    $docdata['filesize'] = $filesize;
/*
echo(5380);
echo("<br>");
print_r($filename);
echo("<br>");
print_r($oldfilename);
echo("<br>");
print_r($newfilename);
echo("<br>");
print_r($docid);
die();
*/

// this is when you always want the most current newsletter to be docid 1 so you can hardcode a button on the ccmphome
if ($docid == 'x'){ // currently not implemented. docid 1 always most current newsletter to link to button.

// the first doc is the ATIS. It is overwritten if replaced by a ATIS with the same name
// or the old ATIS is saved as new document if replaced by a ATIS with a different name

    if ($oldfilename == $newfilename){ // ex. perhaps a mistake in the first one and re-uploading

        // if the file has the same name you need to delete it before uploading or filesystem with append
        // something to make it unique

        // Need to lookup how to delete a file off the disk

        $file_pointer = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$oldfilename;
        $path = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/';

        /* delete instead of rename */
        if (!unlink($file_pointer)) {


echo "Error: 4738 file : $file_pointer cannot be replaced due to an error. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }else {
         //   echo ("$file_pointer has been deleted"); die();
        }
//       echo(3100); die();

        // Now upload the new file of the same name
        //$config['destination'] = '../public/filelibrary';
    //    $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
        $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc;
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->_upload_doc($config, $newfilename);

        //replaced with same file, do not need to update the document record (perhaps timestamps)
        set_flashdata('The file '.$newfilename.' successfully overwrote a file having the same name.');
        $_SESSION['flashmsgcolor'] = 1;
    }else{ // different filename
 echo(5340); die();
        //upload the file
        //$config['destination'] = '../public/filelibrary';
//        $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
        $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc;
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->_upload_doc($config, $newfilename);

        // now want to copy the old ATIS to its own new record to preserve access to it
        // no need for a file upload because the file is already there

        $doc1obj = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');

        // Initialize New Record with old data
        $copydata['tg_user_id']       = $doc1obj->tg_user_id;
        $copydata['ccmp_id']          = $doc1obj->ccmp_id;
        $copydata['downloads']        = $doc1obj->downloads;
        $copydata['active']           = $doc1obj->active;
        $copydata['done']             = $doc1obj->done;
        $copydata['doctag']           = $doc1obj->doctag;
        $copydata['doctype']          = $doc1obj->doctype;
        $copydata['filetype']         = $doc1obj->filetype;
        $copydata['priority']         = $doc1obj->priority;
        $copydata['scope']            = $doc1obj->scope;
        $copydata['access']           = $doc1obj->access;
        $copydata['subentity']        = $doc1obj->subentity;
        $copydata['title']            = $doc1obj->title;
                $copydata['subject']            = $doc1obj->subject;
        $copydata['author']           = $doc1obj->author;
        $copydata['shortdescription'] = $doc1obj->shortdescription;
        $copydata['fulldescription']  = $doc1obj->fulldescription;
        $copydata['notes']            = $doc1obj->notes;
        $copydata['filename']         = $doc1obj->filename;
        $copydata['filesize']         = $doc1obj->filesize;
        $copydata['filedate']         = $doc1obj->filedate;
        $copydata['location']         = $doc1obj->location;
        $copydata['orglogo']          = $doc1obj->orglogo;
        $copydata['smallimage']       = $doc1obj->smallimage;
        $copydata['largeimage']       = $doc1obj->largeimage;
        $copydata['extlink']          = $doc1obj->extlink;
        $copydata['uploaded_at']      = $doc1obj->uploaded_at;
        $copydata['uploaded_by']      = $doc1obj->uploaded_by;
        $copydata['created_at']       = $doc1obj->created_at;
        $copydata['created_by']       = $doc1obj->created_by;
        $copydata['updated_at']       = $doc1obj->updated_at;
        $copydata['updated_by']       = $doc1obj->updated_by;

//echo('4405 uploaded ATIS and about to create a new record with the old ATIS information: ');
//json($copydata); die();

        // Replace filename with new name and location AFTER you copy the old information for the new record
        $docdata['filename'] = $newfilename;
        $docdata['location'] = $subentfileloc;

        // If title hasnt changed when this new ATIS was uploaded then CM didnt edit the record first
        // with the new name so we need to change it and prompt CM to edit title & description fields
        // But there is no way to know what it was before if CM edited first so just set defaults
        // Make the procedure upload first then edit if necessary
        // One constriant is you cant edit & upload in the same transaction without completing one of them first.
        // Two independent actions you are trying to account for.

        $docdata['title']            = 'Newsletter';
        $docdata['shortdescription'] = 'Current Newsletter';
        // new poster & subentity and let CM edit the rest if necessary
        $docdata['ccmp_id']    = $_SESSION['ccmp_rec_id'];
        $docdata['tg_user_id'] = $_SESSION['tg_user_id'];
      // probably not needed $docdata['subentity']    = 50;// subentity should always be 50 for ATIS
        $docdata['scope']      = 1; // Newsletter should be public
        $docdata['access']     = 1; // Newsletter should be public
        $docdata['downloads']  = 0;
        $docdata['created_by']  = $_SESSION['tg_user_id'];
        $docdata['updated_by']  = $_SESSION['tg_user_id'];
        $docdata['created_at']  = time();
        $docdata['updated_at']  = time();
// ??? Why need all ccmp_id, tg_user_id, created_by and update_by?

echo(4434);
//json( $_SESSION);
json( $docdata); die();

        $this->model->update($docid, $docdata, 'dms_filelibrary_docs');

        //insert the new record for the old ATIS
        $this->model->insert($copydata, 'dms_filelibrary_docs');

// echo('Line 4443 - New doc record added!'); die();

        // get the new record's id so can view

        $new_id = $this->model->get_max('dms_filelibrary_docs');

        // Auditlog
        $type  = 'insert';
        $action = 'ReplacedATIS';
        $func = 'library-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$new_id;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$copydata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


        set_flashdata('The new ATIS '.$newfilename.' was successfully uploaded and new record created for prior ATIS '.$oldfilename);
        $_SESSION['flashmsgcolor'] = 0;
    } // if oldfilename = newfilename

        // Only CM maintains ATIS but make it flexible in case add others
        $mode = $_SESSION['ccmpmode']; // dmslibadminv for CM
        $modeprefix = substr($mode, 0,3); // cmm so want pass dmslibadmin to manage
//print_r($modeprefix); die();

        switch ($modeprefix){
            case 'cmm':
                redirect('dms-dmslibrary/manage/dmslibadmin');
            break;

            case '':

            break;

  default;

    set_flashdata('Error 4788: No matching modeprefix '.$modeprefix. '. Contact the System Administrator 202-207-5353. Use the back button.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('dms-dmslibrary/viewdocrec/'.$docid);

        }

  }else{ // if $docid not = 1

/*
echo(4497);
echo('<br>');
print_r($docid); // ok
echo("<br>");
print_r($filename);
echo("<br>");
print_r($oldfilename);
echo("<br>");
print_r($filesize);
echo("<br>");
print_r($filetype); die();
*/
    // Newly uploaded file is $filename
    // Get the old one for comparison - it will be null if a new record
    // File has already uploaded so just update the document record with the file information

// Ex. "1 YIAP Brochure - Signed - Rayan Salahuddin.pdf" => 1_yiap_brochure_signed_rayan_salahuddin.pdf
// Must be done in this order. There may be threes and twos underscores after system replaces things with underscores
    $newfilename = str_replace(' ', '_', $newfilename); // replace space with underscore
    $newfilename = str_replace('___', '_', $newfilename);  // convert triple underscores to single
    $newfilename = str_replace('__', '_', $newfilename);  // convert double underscores to single

    $filename    = strtolower($newfilename);
//print_r($filename);die();
    $docdata['filename']    = $filename;
    $docdata['filedate']    = $orgfiledate;
    $docdata['filesize']    = $filesize;
    $docdata['filemime']    = $filemime;
    $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
    $docdata['uploaded_at'] = time();
    $docdata['downloads']   = 0;
  //  $docdata['location']    = $subentfileloc; // not implementing separate doc directories by subentities

    $oldfilename = str_replace(' ', '_', $oldfilename); // replace space with underscore
    $oldfilename = str_replace('___', '_', $oldfilename);  // convert triple underscores to single
    $oldfilename = str_replace('__', '_', $oldfilename);  // convert double underscores to single
    $oldfilename = strtolower($oldfilename);

    //  tc1 - Upload a "Missing File" - added a new record and now uploading the file
    if (strlen($oldfilename) == 0) { //
        //upload the file
            // now we have established that the filename is different from the existing one
            // now need to determine if it exists on another record, if so we will be
            // compromising the other record if we allow it so we wont

            $dupobj =  $this->model->get_one_where('filename', $filename, 'dms_filelibrary_docs');

            //if(isset($dupobj)){ // duplicate found on another record
            if($dupobj != false){ // duplicate found on another record
//echo(5661);
//json($dupobj); die();
             $rectitle = $dupobj->title;
             $dupid = $dupobj->id;
//echo(4550); die();
 //print_r( $dupid); die();
        set_flashdata("Error 6053: The document $filename already exists on document $rectitle.  Link: '.<p href='$dupid'> <? $rectitle ?> </p>.'");
        $_SESSION['flashmsgcolor'] = 0;

                redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$managemode); // was $this->dmslibrary->viewdocrec(): this engine can't load a module from itself
         //       redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$managemode);

            }else{ // not found in library so continue
               // echo(4559); die();



        //$config['destination'] = '../public/filelibrary';
        // $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc;
        $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
        $config['make_rand_name'] = false;
//print_r($config['destination']);die();

        // Note: upload_file() converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->_upload_doc($config, $filename);
 //json($file_info);
 //json($docdata); die();
        // no old file to delete so just add file data to the document record
        $this->model->update($docid, $docdata, 'dms_filelibrary_docs');
        //set some flashdata
        set_flashdata('The document '.$docdata['filename'].' was successfully uploaded.');
        $_SESSION['flashmsgcolor'] = 1;

        // Auditlog
        $type  = 'FileUpload';
        $action = 'tc1NewOrMissing';
        $func = 'library-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$_SESSION['filelibrary_rolename']);
    }
    }else{ //There is an existing file on the record
    //    echo('4600 There is an existing file'); die();

        if ($oldfilename == $filename){
    //    echo('4603 tc3 - Replacing existing file with one of the same name'); die();

      //  $file_pointer = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/'.$docdata['filename'];
      //  $path = APPPATH.'modules/dms/dmslibrary/assets/'.$subentfileloc.'/';
          $file_pointer = APPPATH.'modules/dms/dmslibrary/assets/docs/'.$docdata['filename'];
          $path = APPPATH.'modules/dms/dmslibrary/assets/docs/';

        $docdata['filedate'] =  filectime($file_pointer);
/*
echo(4612);
echo("<br>");
print_r($file_pointer);
echo("<br>");
print_r($docdata['filedate']);
echo("<br>");
print_r($docdata['filesize']);
echo("<br>");
print_r($path); die();
*/
  $this->model->update($docid, $docdata, 'dms_filelibrary_docs');

/* could not get to rename or copy so will delete and replace
if (file_exists($path))     {
  //  echo(3269); die();
        $i=1;
        $new_path=$path;

        while (file_exists($new_path))
        {
            // get file extension
          //  $extension = pathinfo($path, PATHINFO_EXTENSION);
            $extension = pathinfo($file_pointer, PATHINFO_EXTENSION);


            // get file's name
            $filename = pathinfo($file_pointer, PATHINFO_FILENAME);

            // get file's directory
         //   $directory=dirname($path);

            // add and combine the filename, iterator, extension
            $new_filename = $filename . '-' . $i . '.' . $extension;
 //    print_r($new_filename); die();
            // add file name to the end of the path to place it in the new directory; the while loop will check it again
            $new_path = $new_filename;

            $i++;
        }

           $new_path = $path.$new_path;
         //  $new_path = $new_path;
     //      $opendirectory = opendir($path);
           print_r($file_pointer);
           echo('<br>');
           print_r($new_path); die();

        if(!copy($filepointer, $new_path)){
            echo 'Error 4660: error renaming file'; die();
        }else{
            echo(4662); die();
        }

     //   closedir($opendirectory);
}else{

    echo('Error: 4668 File not found! Contact the System Administrator. Use back button.'); die();

}  */
//echo(4671);
//echo("<br>");
//print_r($ext); die();
     if ( DMS_FL_SAVE_BAK == 1){ // rename to a backup file
        $fileroot = pathinfo($file_pointer, PATHINFO_FILENAME);
        $bakfilename = $path.$fileroot.'_'.$ext.'.bak' ;
//echo(5034);
//echo("<br>");
//print_r($file_pointer);
//echo("<br>");
//print_r($bakfilename); die();

//  tc4 - Upload a "Missing File" - added a new record and now uploading the file
// must check to see if a backup file exists - if so it will delete existing file and keep old backup instead of rename (dont know why)
if(file_exists($bakfilename)){ // delete it so existing file will be backed up (renamed) and not auto deleted by the system
  //echo('5107 tc4 - Replacing existing file with one of the same name'); die();
            /* delete old backup */
            unlink($bakfilename);

            // echo ("$bakfilename has been deleted"); die();
            // Auditlog
            $type  = 'delete';
            $action = 'DeletedBackup';
            $func = 'library-submit_upload';
            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
            $format = 'minitime'; // I added to Timedate.php
            $this->module('timedate');
            $timestamp = time();
            $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$docid;
            $str4 = 'Tbl: dms_filelibrary_docs';
            $str5 = 'Fullpath: '.$bakfilename;
            $str6 = 'Mode: '.$managemode;

            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

     //   set_flashdata('The new ATIS '.$newfilename.' was successfully uploaded and new record created for prior ATIS '.$oldfilename);
     //   $_SESSION['flashmsgcolor'] = 0;
}
       rename($file_pointer, $bakfilename);  // if replacing a file rename original with .bak extension


     }else {
            /* delete instead of rename */
            if (!unlink($file_pointer)) {

echo "Error: 4719 file cannot be found most probably because the name of the file in the directory does not match the name in the database. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

            }else {
                echo ("$file_pointer has been deleted"); die();
            }
     }
//echo(4727); die();
//
        // Now upload the new file of the same name
        //$config['destination'] = '../public/filelibrary';
      //  $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
        $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->_upload_doc($config, $filename);

        //replaced with file of same name, no need to update record but could have different date

            $docdata['filename']    = $filename;
            $docdata['filedate']    = $orgfiledate; //org saved above - info on source file changes to todays date when uploaded
            $docdata['filesize']    = $filesize;
            $docdata['filemime']    = $filemime;
            $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
            $docdata['uploaded_at'] = time();
            $docdata['downloads']   = 0;

         //   $docdata['location'] = $subentfileloc ; // see if need to add path to download or not  ???
//json(  $docdata); die();
//json($_FILES); die();
            // now update the doc record with the new filename
            $this->model->update($docid, $docdata, 'dms_filelibrary_docs');

        set_flashdata('The document '.$docdata['filename'].' was successfully uploaded and replaced.');
        $_SESSION['flashmsgcolor'] = 1;

        // Auditlog
        $type  = 'upload';
        $action = 'tc3ReplaceSame';
        $func = 'dmslibrary-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$_SESSION['filelibrary_rolename']);

        }else{ // you are replacing the file with a different name so delete first one so not orphaned
     //   echo('5181 tc2 - Replacing existing file with one of a different name'); die();

            $old_pointer = APPPATH.'modules/dms/dmslibrary/assets/docs/'.$oldfilename;
            $path = APPPATH.'modules/dms/dmslibrary/assets/docs/';
            $fileroot = pathinfo($old_pointer, PATHINFO_FILENAME); // existing file w/o ext
            $bakfilename = $path.$fileroot.'_'.$ext.'.bak' ;
//print_r($oldfilename); // existing file
//echo('<br>');
//print_r($filename); die(); // new file
            // now we have established that the filename is different from the existing one
            // now need to determine if it exists on another record, if so we will be
            // compromising the other record if we allow it somwe wont

            $dupobj =  $this->model->get_one_where('filename', $filename, 'dms_filelibrary_docs');

            if(isset($dupobj)){ // duplicate found on another record
//json($dupobj); die();
             $rectitle = $dupobj->title;
             $dupid = $dupobj->id;
//echo(4797); die();
 //print_r( $dupid); die();
//  set_flashdata("<a href='dms-dmslibrary/viewdocrec/$dupid/$managemode'> The document $filename already exists on document $rectitle</a>");

set_flashdata("The file $filename already associated with document $rectitle. File not replaced.");


        $_SESSION['flashmsgcolor'] = 0;

                redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$managemode); // was $this->dmslibrary->viewdocrec(): this engine can't load a module from itself
         //       redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$managemode);

            }else{ // not found in library so continue
                echo(6233); die();
            }
echo(4812); die();

/*
            echo(5188);
            print_r($oldfilename);
            echo('<br>');
            print_r($path);
            echo('<br>');
            print_r($fileroot);
            echo('<br>');
            print_r($old_pointer);
            echo('<br>');
            print_r($bakfilename);
            echo('<br>');
            echo('End'); die();
*/
            // Instead of deleting the old file rename it with a .bak extension and tack on the old ext with an underscore
            rename($old_pointer, $bakfilename);  // if replacing a file rename original with .bak extension

            //upload the file
            //$config['destination'] = '../public/filelibrary';

            $config['destination'] = APPPATH.'modules/dms/dmslibrary/assets/docs';
            $config['make_rand_name'] = false;

            // Upload the new file with a framework function upload_file
            // Note: converts the filename to all lowercase before saving to the harddrive
            $file_info = $this->_upload_doc($config, $filename);
//json($file_info); die();
//json($_FILES); die();
//print_r($file_info['file_path']); die();

// kept in case other filedates are desired in the future
/*
$file_name = $file_info['file_path'];

$filedatea =  date("F d Y H:i:s.", fileatime($file_name));
$filedatem =  date("F d Y H:i:s.", filemtime($file_name));
$filedatec =  date("F d Y H:i:s.", filectime($file_name));
print_r($filedatea);
echo('<br>');
print_r($filedatem);
echo('<br>');
print_r($filedatec); die();
*/

            $docdata['filename']    = $filename;
            $docdata['filedate']    = $orgfiledate; //org saved above - info on source file changes to todays date when uploaded
            $docdata['filesize']    = $filesize;
            $docdata['filemime']    = $filemime;
            $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
            $docdata['uploaded_at'] = time();
            $docdata['downloads']   = 0;

         //   $docdata['location'] = $subentfileloc ; // see if need to add path to download or not  ???
//json(  $docdata); die();
//json($_FILES); die();
            // now update the doc record with the new filename
            $this->model->update($docid, $docdata, 'dms_filelibrary_docs');

            //set some flashdata
            set_flashdata('The document '.$docdata['filename'].' was successfully uploaded.');
            $_SESSION['flashmsgcolor'] = 1;
          //  redirect('dms-dmslibrary/viewdocrec/'.$docid);


        // Auditlog
        $type  = 'upload';
        $action = 'tc2ReplaceDifferent';
        $func = 'dmslibrary-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

              redirect('dms-dmslibrary/viewdocrec/'.$docid.'/'.$managemode);
        }

    }
echo(5303); die();


  }


  } else { // $result = false
    echo(5310);
    print_r($docid);die();
    //validation error! Present the form again.
   // $this->upload();
 //redirect('dms-dmslibrary/manage/ccmp');
     set_flashdata('The document '.$newfilename.' has an invalid file extension. Please choose another file.');
     $_SESSION['flashmsgcolor'] = 1;
     redirect('dms-dmslibrary/viewdocrec/'.$docid);
  }// if $result = true

} // End function submit upload

/*------------------------- End submit_upload --------------------*/

/* ------------------------- Function header0 ------------------ */

// header 0 is an optional kanban board column to make 5 instead of 4
    function header0() {

        $docfunction = 19;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
//echo(5082);
//print_r($managemode); die();
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 6; //ex 6 unrefined

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(4941);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'header0';
        $func = 'docs-header0';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
//echo(4961);
// print_r($managemode); die(); //dmslibadmin

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record (restored 2026-10-18: chapter admins can move cards)
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No role';
        $func = 'docrecord-header0';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 5410: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*------------------------------- End header0 --------------------------*/

/* ----------------------- Function backlog -------------------- */

    function backlog() {

        $docfunction = 20;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
//echo(5027);
//print_r($managemode); die();
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 5;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5036);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'Backlog';
        $func = 'docs-backlog';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
//echo(5056);
// print_r($managemode); die(); //dmslibadmin

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record (restored 2026-10-18: chapter admins can move cards)
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No role';
        $func = 'docrecord-backlog';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


echo "Error 5103: No matching manage mode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*------------------------------- End backlog --------------------------*/

/* --------------------------- Function inprogress -------------------- */

    function inprogress() {

        $docfunction = 21;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
//        echo(5123);
//        print_r($managemode); die();

        //
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 4;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5134);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'InProgress';
        $func = 'docs-inprogress';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die();

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No inprogress';
        $func = 'docrecord-inprogress';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 4113: No matching manage mode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*------------------------- End inprogress ----------------------*/

/* ------------------------ Function inreview ------------------- */

    function inreview() {

        $docfunction = 22;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
 //       echo(5220);
 //       print_r($managemode); die();

        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 3;
        $data['rejected'] = 0;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5231);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'InReview';
        $func = 'docs-inreview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die();

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No role';
        $func = 'docrecord-inreview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 5297: No matching manage mode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*------------------------------- End inreview -------------------------*/

/* --------------------------- Function pending ----------------------- */

   function pending() {

        $docfunction = 23;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
//echo(5317);
//print_r($managemode); die();
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 2;

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5326);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'Pending';
        $func = 'docs-pending';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die();

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record (restored 2026-10-18: chapter admins can move cards)
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No role';
        $func = 'docrecord-pending';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 5795: No matching filelibrary role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*--------------------------- End pending -----------------------*/

/* --------------------- Function header5 ----------------------- */

    function header5() {

        // header 5 is an optional far right kanban board column

        $docfunction = 24;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
//echo(5414);
//print_r($managemode); die();
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = DMS_KBB_HDR5; //ex 1 approved

        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5423);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'header5';
        $func = 'docs-header5';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
//echo(5443);
// print_r($managemode); die(); //dmslibadmin

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record (restored 2026-10-18: chapter admins can move cards)
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No role';
        $func = 'docrecord-header5';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 5892: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }

/*----------------------- End header5 -----------------------*/

/* --------------------- Function done ---------------------- */

   function done() { // marking record as done (remove from kanban board)

        $docfunction = 25;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
//echo(5508);
//print_r($managemode); die();

        $frmpg = segment(5); // from manage, view or kanban

        $data['done'] = 1;
        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5515);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'DoneDocRecord';
        $func = 'docs-donerecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

      default;

        // Auditlog
        $type  = 'donedocrecord';
        $action = 'No role';
        $func = 'doc-donerecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 5580: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }
/* ----------------------------- End done ------------------ */


/*------------------- Function modaladddoccomment --------------------*/

  function modaladddoccomment() {
//echo('made it!'); die();
        $docfunction = 26; //permissions($docfunction);
        $authorized = $this->_check_function_permissions($docfunction);
 //echo('made it!'); die();
  if($_POST['DocCommentBtn'] == "Add"){ // values from modal form - this is button name from kanban board via ajax
       $comment = $_POST['doccomment']; // from manage, view or kanban
//       echo(6025);
//        print_r($comment); die();
       $recid = $_POST['recid'];
       $managemode = $_POST['managemode'];
       $frmpg = $_POST['frmpg'];
       $status = $_POST['status'];
    //   echo(5754);
      // json($_POST); die();
  }else{ // coming from modal comment button
           $comment = $_POST['doccomment']; // from manage, view or kanban
      // print_r($comment); die();
        $recid = $_POST['recid'];
        $managemode = $_POST['managemode'];
        $frmpg = $_POST['frmpg']; // from manage, view or kanban
        $status = $_POST['status'];
    //   echo(5763);
      // json($_POST); die();
  }
    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.

    $tgusrid   = $_SESSION['tg_user_id'];
//print_r($tgusrid ); die();
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table); die();
//print_r($tgusrobj); die();
    // Get the rejector's name for each comment
    if($tgusrid > 0){
    $commenter_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
     $commentdata['commentor']  =  $commenter_obj->first_name.' '.$commenter_obj->last_name;
    }else{
     $commentdata['commentor'] = 'Unk';
    }

        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);

        // when using a table of comments
        $commentdata['doc_id'] = $recid;
        $commentdata['status'] = 1; // open  0 - closed
        $commentdata['type']   = $_POST['status']; // what phase doc was in when comment added becomes the comment type
        $commentdata['comment'] = $_POST['doccomment'];
        $commentdata['created_at'] = time();
        $commentdata['created_by'] = $_SESSION['tg_user_id'];
//json($commentdata); die();
        $this->model->insert($commentdata, 'dms_filelibrary_docs_comments');

        // Auditlog
        $type  = 'update';
        $action = 'AddDocComment';
        $func = 'dmslibrary-modaladdcomment';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
       // }


//json($_SESSION); die();
 //print_r($_SESSION['filelibrary_rolename']); die();
        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records

      //    print_r($frmpg);
     //    print_r($recid); die();
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }elseif ($frmpg == 'mc'){ // manage comments
                   redirect('dms-dmslibrary/managedoccomments/'.$recid.'/dmslibadminmc');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

        default;

        // Auditlog
        $type  = 'modaladddoccomment';
        $action = 'No role';
        $func = 'dmslibrary-modaladddoccomment';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 6115: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }
/*------------------- End modaladddoccomment -----------------*/

/*----------------- Function View Doc Comments ---------------*/

function viewdoccomment(){
//echo(5972); die();


  $docfunction = 27; // manage
  $authorized = $this->_check_function_permissions($docfunction);

/*------------------ Get Passed Parameters -------------------*/

    $recid      = segment(3);
    $managemode = segment(4); // to pass to comments view buttons

/*----------------------- Run Queries ------------------------*/
  // Get record to view

  $data = $this->_get_a_single_comment($recid);
//echo(5993);
//json($data); die();
  $docid      = $data['doc_id'];
//echo(5995);
//print_r($docid); die();
/*-------------- Convert to User Friendly Values -------------*/
/* example
    if($data['onhold'] == 1){
        $data['onhold'] = 'Yes';
    }else{
        $data['onhold'] = 'No';
    }
*/
    if($data['status'] == 1){
        $data['status'] = 'Open';
    }else{
        $data['status'] = 'Closed';
    }

        $typeobj = $this->model->get_one_where('id', $data['type'], 'dms_filelibrary_status');
        $data['type']  = $typeobj->title;

//echo(6025);
//json($data); die();

/*
    $ccmpobj      = $this->model->get_where($data['ccmp_id'], 'ccmps');
    $fn  = $ccmpobj->first_name;
    $ln  = $ccmpobj->last_name;
    $data['ccmp'] = $fn.' '.$ln;
    if(strlen( $data['ccmp']) < 2){ // happens if default 0 is used and nothing returned from dms_filelibrary_doctags1
        $data['ccmp'] = '';
    }
*/

//echo(6025);
//json($data); die();

/*--------------- Set Navbar & Header Information ------------*/

/* Based on $_SESSION['filelibrary_rolename'] */

    $data['bc1']          = 'DMS';
    $data['bc2']          = 'View A Comment';
    $data['header']       = $adobj->title;

 switch($_SESSION['filelibrary_rolename']) {

  case 'dmslibadmin':     // admin

        $data['subheader']    = 'Administrator';

  break;

  case 'dmslibastadmin': // assistant admin

        $data['header']       = $adobj->title;
        $data['subheader']    = 'Assistant Administrator';

  break;

  case 'dmslibsubadmin': // subentity

        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Administrator';

  break;

  case 'dmslibuser': // Module User

        $data['header']       = $adobj->title;
        $data['subheader']    = 'User';

  break;

  default;
//echo('6066 - No matching managemode');
//print_r($managemode); die();
        // Auditlog
        $type  = 'viewdocrecrec';
        $action = '2145 - No matching role';
        $func = 'docrecord-view';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'File: '.$docdata['filename'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 1841: No matching filelibrary role name ... Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

}

/*--------------------------- Set Additional Values ---------------------*/

  $data['recid']        = $recid;
  $data['docid']        = $docid;
  $data['managemode']   = $managemode;

  $data['view_module']  = 'dms/dmslibrary';
  $data['view_file']    = 'commentcrud'; // use all-in-one crud form for viewing

/*
echo(1854);
echo('<br>');
print_r($recid);
echo('<br>');
print_r($managemode);
json($data); die();
*/
/*-------------------------------- Show Doc -----------------------------*/

    $this->templates->inspinia($data);

} // end

/*---------------------- End View Doc Comments ---------------*/

/*----------------- Manage Doc Comments ----------------------*/

  function managedoccomments(){
//echo(6857); die();
  $docfunction = 28; //
  $authorized = $this->_check_function_permissions($docfunction);

  $docid = intval(segment(3)); // intval() - goes straight into the comments SQL below. Stops SQL injection.

//echo(6863);
//echo('<br>');
//print_r($docid ); die();

/*---------------- Get Passed Parameters --------------------*/

 $managemode =  $_SESSION['filelibrary_rolename'];
// for crud
//json($_POST); die();
    $doc_id     = $_POST['doc_id'];

    $comment_id = $_POST['id'];
    $created_at = $_POST['created_at'];
    $status     = $_POST['status'];
    $commentor  = $_POST['commentor'];
    $comment    = $_POST['comment'];

    $type       = $_POST['type'];
    $resolution = $_POST['resolution'];
    $resolver   = $_POST['resolver'];
    $closed_by  = $_POST['closed_by'];
    $closed_at  = $_POST['closed_at'];
    $created_by = $_POST['created_by'];
    $updated_at = $_POST['updated_at'];
    $updated_by = $_POST['updated_by'];

    /*
    echo(6008);
    echo('<br>');
    print_r($comment_id);
    echo('<br>');
    print_r($doc_id);
    echo('<br>');
    print_r($status);
    echo('<br>');
    print_r($type);
    echo('<br>');
    print_r($commentor);
    echo('<br>');
    print_r($comment);
    echo('<br>');
    print_r($resolution);
    echo('<br>');
    print_r($created_at);
    echo('<br>');
    print_r($created_by);
    echo('<br>');
    print_r($updated_at);
    echo('<br>');
    print_r($updated_by);
    die();
*/


/*------------- Get logged in user's info & preferences -----------*/

//json($_SESSION); die();
    if(!empty($_SESSION['honcho_logged_in'])){ // staff; members use DMS too (RBAC step 4)
        $user_obj = $this->model->get_where(intval($_SESSION['honcho_acct_rec_id'] ?? 0),'honcho_user_accounts');
    }else{
        $user_obj = $this->model->get_where(intval($_SESSION['ccmp_rec_id'] ?? 0),'ccmps');
    }
//json($user_obj); die();
    $tg_user_id      = $user_obj->trongate_user_id; // already set in session variable
/*
//    $subentity       = $user_obj->honcho_subentity; // department, etc
//json($subentity); die();
    $subentityobj      = $this->model->get_where($subentity,'honcho_user_subentities');
    $subentity_name    = $subentityobj->description;

    $subentity_role    = $user_obj->subentity_role;
    $subentity_role_id = $user_obj->subentity_role;
*/
    // get dropdown for all tabs & create the $data object

    $data = $this->_populate_dropdowns();

// echo(6931);
// json($data); die(); // checkpoint

/*  Not allowing bulk actions
    $data['bulk_actions'] = $this->model->get('id','dms_filelibrary_bulk_actions');
    $data['doctags']   = $this->model->get('id','dms_filelibrary_doctags');
    $data['doctags3']  = $this->model->get('id','dms_filelibrary_doctags3');
    $data['filetypes'] = $this->model->get('id','dms_filelibrary_filetypes');
    $data['rectypes']  = $this->model->get('id','dms_filelibrary_rectypes');
    unset($data['bulk_actions'][1]); // Cannot approve
    unset($data['bulk_actions'][2]); // Cannot Disapprove
    unset($data['bulk_actions'][6]); // Cannot Archive
 */

 $tguserid = $_SESSION['tg_user_id'];

/*
 echo(6954);
 print_r($managemode);
 echo('<br>');
 print_r($tguserid); die();
*/

if($managemode == 'dmslibuser'){
// users should not see comments (or get comments button to start with.  This is backup)

}else{

    // Get the title of the document
    $docobj = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');
    $data['doctitle'] = $docobj->title;

    // Get the comments
    $sql = "SELECT * FROM dms_filelibrary_docs_comments WHERE doc_id = $docid";

}

 // this is for CRUD, not manage ???

$submit = post('submit', true);
//print_r($submit); die();

if($submit == 'Submit'){

   // create the $data and fill it with the rows from the table
  $data['rows'] = $this->model->query($sql,'object');

echo(6984);
json($data['rows']); die();

  if($data['rows']){ // if you find records to match the query then continue
   // since not null ok


//echo(6103);
//echo('<br>');
//json($data); die();

   }else{
     // null since no records found or empty library

   /*     switch ($_SESSION['filelibrary_rolename']){
        case 'dmslibuser'; // logged in user is acting as himself
        $sql = "SELECT * FROM dms_filelibrary_docs_comments";
                $data['rows'] = $this->model->query($sql,'object');
 //echo(6997); die();
                break;
              case 'dmslibadmin';

                $sql = 'SELECT * FROM dms_filelibrary_comments';
                $data['rows'] = $this->model->query($sql,'object');
 //echo(7003); die();
             break; */
        }

}else{ // just get records
        $data['sql'] = $sql; // for user interface ???

        $data['rows'] = $this->model->query($sql,'object');



}

//echo(7009);
//echo('<br>');
//json($data); die();
/*------------------------- Add User Friendly Values -------------*/

//loop through the records and add a user friendly values to each record
 //json($data['rows']); die(); // even if no POST there are the dropdown values
 foreach($data['rows'] as $row){
//echo(7019); die();
// there is no "type"
 //   $typeobj = $this->model->get_where($row->type, 'dms_filelibrary_status');

//    $row->type = $typeobj->title;

//    if($row->type < 1){ // happens if default 0 is used and nothing returned from dms_filelibrary_status

//        $row->type = 'Error 6141';
//    }

    if($row->status == 1){

        $row->status = 'Open';
    }else{

        $row->status = 'Closed';
    }

    $this->module('timedate');
    $format = 'datepicker_us';

    $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);

    $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
      if($row->updated_at == '01/01/1970' || $row->updated_at == '12/31/1969'){
      $row->updated_at = ' ';
    }
      if($row->created_at == '01/01/1970' || $row->created_at == '12/31/1969'){
      $row->created_at = ' ';
    }

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.

    $tgusrid   = $row->created_by;
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;

    // Get the creator's name for each record
    if($tgusrid > 0){
    $commentor_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
//json($commentor_obj); die();
     $row->created_by =  $commentor_obj->first_name.' '.$commentor_obj->last_name;
    }else{
      $row->created_by = 'NA';
    }

    $tgupdusrid   = $row->updated_by;
    $tgusrobj  = $this->model->get_where($tgupdusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;

    // Get the updator's name for each record
    if($tgupdusrid > 0){
    $commentor_obj = $this->model->get_one_where('trongate_user_id', $tgupdusrid,
                $user_acct_table);
//json($commentor_obj); die();
     $row->updated_by =  $commentor_obj->first_name.' '.$commentor_obj->last_name;
    }else{
      $row->updated_by = 'NA';
    }

    } // end foreach

// checkpoint
//echo(7082);
//json($data['rows']); die();

    /*----------- Add $data array elements for manage view --------------*/
    $data['docid']     = segment(3);
    $data['logged_in'] = $_SESSION['logged_in'];
    $data['home_page'] = 0;

    $data['content_name']   = SITENAME;
//  $data['subentity_name']  = $subentity_name; // do anything with this? -no! no subs in hq dms

    $data['view_module']   = 'dms/dmslibrary';
    $data['view_file']     = 'managecomments'; //

    $data['managemode']     = $managemode;

/*
    echo(7107);
    echo('<br>');
    print_r($_SESSION['managemode'] );
    echo('<br>');
    json($_SESSION); die();
*/

    switch($_SESSION['filelibrary_rolename']) {

    case 'dmslibuser': // error - no access


    break;
/*
    case 'dmslibsubadmin': // subentity admin

          $data['bc1']         = 'DMS';
          $data['bc2']         = SUBENTITY.' Documents';
          $data['activity']    = $_SESSION['subentity_name'];
       //   $data['header']      = 'Manage Chapter Documents'; hard coded
    break;
*/
    case 'dmslibadmin': // content manager

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'Comments';

          $data['header']      = 'Document Management System';
          $data['activity']    = 'Adjudicate Comments';


    break;

    }

 // bulk actions may be too dangerous
 //   print_r($data['bulk_actions']); die();

 // echo(6254);
 // json($data); die(); // checkpoint

        $this->templates->inspinia($data);

  }


/*------------------- End managedoccomments ----------------------*/

/* ---------------- Function closedoccomment ---------------- */

   function closedoccomment() { // marking record as done (remove from kanban board)

        $docfunction = 29;
        $authorized = $this->_check_function_permissions($docfunction);

        $recid = segment(3);
        $managemode = segment(4);
//echo(5508);
//print_r($managemode); die();

        $frmpg = segment(5); // from manage, view or kanban

        $data['done'] = 1;
        $this->model->update($recid, $data, 'dms_filelibrary_docs');

       // echo(5515);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'DoneDocRecord';
        $func = 'docs-donerecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

      default;

        // Auditlog
        $type  = 'donedocrecord';
        $action = 'No role';
        $func = 'doc-donerecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 6648: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }
/* ------------------- End closedoccomment ------------------ */

/* --------------------- Function deldoccomment ------------- */

    function deldoccomment() {

    $recid = segment(3);
    $managemode = segment(4);
    $frmpg = segment(5); // from manage, view or kanban

  //  $recid = $_POST['recid'];
//json($_POST); die();
//print_r($frmpg); die();
//print_r($recid); die();
        $docfunction = 30;
        $authorized = $this->_check_function_permissions($docfunction, $recid);

        $comobj        = $this->model->get_one_where('id', $recid, 'dms_filelibrary_docs_comments');
        $title         = $comobj->title; // need the name for the auditlog
        $parentid      = $comobj->doc_id;

//print_r($title); die();
//print_r($_SESSION['ccmpmode']);die();

$deldata['soft_deleted'] = 1;
$deldata['status'] = 0;
$result = $this->model->update($recid, $deldata, 'dms_filelibrary_docs_comments');

    //  Auditlog
        $type  = 'delete';
        $action = 'SoftDeleteComment';
        $func = 'docs-delcomment';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs_comments';
        $str5 = 'Title: '.$title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

// Can delete from Manage or View pages so need both cases for each mode
  //      print_r($managemode); die();
  //      print_r($frmpg); die();
        switch($_SESSION['filelibrary_rolename']) {

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records

          if($frmpg == 'm'){
                redirect('dms-dmslibrary/managedoccomments/'.$parentid.'/dmslibadmin');
            }else{
                // print_r($recid); die();

                redirect('dms-dmslibrary/viewdoccomment/'.$recid.'/dmslibadmin');

          }

          break;

    /*      case 'ccmpv': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadminv': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadminv': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'deletecomment';
        $action = 'No role';
        $func = 'dms-delcomment';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 6596: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

}

/*------------------------ End deldoccomment -----------------*/


/* --------------- Function undeldoccomment ----------------- */

    function undeldoccomment() {

    $recid = segment(3);
    $managemode = segment(4);
    $frmpg = segment(5); // from manage, view or kanban
//print_r($frmpg); die();
        $docfunction = 31;
        $authorized = $this->_check_function_permissions($docfunction, $recid);
        $comobj        = $this->model->get_one_where('id', $recid, 'dms_filelibrary_docs_comments');
        $title         = $comobj->title; // need the name for the auditlog
        $parentid      = $comobj->doc_id;

//print_r($title); die();
//print_r($_SESSION['ccmpmode']);die();

$deldata['soft_deleted'] = 0;
$deldata['status'] = 1;
$result = $this->model->update($recid, $deldata, 'dms_filelibrary_docs_comments');

    //  Auditlog
        $type  = 'undelete';
        $action = 'UnSoftDeleteComment';
        $func = 'docs-undelcomment';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs_comments';
        $str5 = 'Title: '.$title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

// Can delete from Manage or View pages so need both cases for each mode
        switch($_SESSION['filelibrary_rolename']) {


          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
          if($frmpg == 'm'){
                redirect('dms-dmslibrary/managedoccomments/'.$parentid.'/dmslibadmin');
            }else{
                redirect('dms-dmslibrary/viewdoccomment/'.$recid.'/dmslibadmin');

          }

          break;

    /*      case 'ccmpv': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break; */

          case 'dmslibsubadminv': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadminv': // CM managing all records
                redirect('dms-dmslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'deleterec';
        $action = 'No role';
        $func = 'dms-delrecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 6860: No matching role. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

}

/*--------------------- End undeldoccomment -----------------*/

/*--------------- Function updatedoccomment -----------------*/

  function updatedoccomment($retrying = ''){  // either yes or docid which it will ignore (default: this engine passes no arguments)
//print_r($retrying); die();
  $libfuncid = 33; // id in library functions table
  $authorized = $this->_check_function_permissions($libfuncid);

  $recid      = segment(3);
  $managemode = segment(4);

// checkpoint
/*
echo(6909);
echo('<br>');
print_r($recid);
echo('<br>');
print_r($managemode); die();
*/

 // $_SESSION['frmpg'] = segment(5); // from manage, view or kanban - where to return

// Find out if have admin rights by looking for a match in the honcho_users_tguserid_security_group table. dmslibuser = 5.
 $tguserid = $_SESSION['tg_user_id'];

/*
  8 - dmslibadmin
  9 - dmslibasstadmin
  7 - dmslibsubadmin
  6 - dmslibuser
  */


    // firsttime through it passes the recid automatically so have code
    //  ingore it unless it is a "yes"

    $retry = $retrying;

    if( $retry == 'yes'){
      // retry does not pass a segment value
      // keep tab number the same for the retry
    }else{
 //     $_SESSION['crudtab'] = segment(4);

    }

    if($retry == 'yes'){
      $retry = 'no'; // reset - not sure if necessary
      $data = $_POST;
      unset($_POST['submit']);// not in DB will cause error

      // need to reset dropdowns to attempted values ???

    }else{ // getting record to edit
      // get data from DB instead of Post
        $data   = $this->_get_a_single_comment($recid, $_SESSION['filelibrary_rolename']);
 //echo(1954);
 //json($data); die();

    }

/*--------------------------- Get Dropdown Values -----------------------*/
    // get dropdown for all tabs

   $dropdowndata =  $this->_populate_dropdowns();
   $data = array_merge($data, $dropdowndata);
//json($data); die();

    // some dropdowns want to preselect something other than default first value
/*  Ex.
    if(strlen($data['mailstatecode']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstatecode'] = 'NA';
    }
*/

/*----------------------- Set Navbar & Header Information ---------------*/
 //echo(7489);
 //print_r($_SESSION['filelibrary_rolename']); die();

 switch($_SESSION['filelibrary_rolename']) { //

  case 'dmslibuser': // ccmp updating from manage page
        // regular ccmp or user who can only update docs assigned to them
        $data['managemode'] = 'dmslibuserupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Comment';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Comment';
  break;

  case 'dmslibadmin': // content manager updating any Doc from manage page

        $data['managemode'] = 'dmslibadminupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Comment';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Comment';
      //  $data['subentitynm']  = $subentitynm; // set dropdown?
  break;

  case 'dmslibsubadmin': // subentity admin updating a subentity Doc from manage page

        $data['managemode'] = 'dmslibsubadminupdate';
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Comment';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Comment';

        $data['subheader']  = SUBENTITY.' Lead';
      //  $data['subentitynm']  = $subentitynm;// set dropdown?
  break;

  }

/*--------------------- Set Additional Values --------------------*/

// User Friendly View Only Values

    if($data['status'] == 1){
        $data['status'] = 'Open'; // will this break on the save? Datatype mismatch.
        $data['closed_at'] = ''; // in case closed and reopened, value reset
    }else{
        $data['status'] = 'Closed';

    }
    // Header Information
//    $data['subentitynm']   = $_SESSION['subentity_name'];
//echo(2077);
//print_r($data['subentitynm']); die();
    // To control input fields
    $data['recid']         = $recid;

    $data['view_module']   = 'dms/dmslibrary';
    $data['view_file']     = 'commentcrud'; // use all-in-one crud form for updating

    /*----------- Get logged in user's info & preferences -------*/

  // Get font size preference for views & manage page
  $this->_get_font_sizes();
 /*
 echo(2090);
 echo('<br>');
 print_r($recid);
 echo('<br>');
 print_r($managemode);
 echo('<br>');
 json($data); die();
*/
    $this->templates->inspinia($data);

}

/*------------------- End updatedoccomment -------------------*/

/*----------------- Function modalrejectdoc ------------------*/

  function modalrejectdoc() {

        $docfunction = 34;
        $authorized = $this->_check_function_permissions($docfunction);

  if($_POST['DocCommentBtn'] == "Submit"){ // values from modal form - this is button name from kanban board via ajax
       $recid = $_POST['recid'];
       $managemode = $_POST['managemode'];
       $frmpg = $_POST['frmpg'];
       $status = $_POST['status'];
    //   echo(5887);
    //   json($_POST); die();
  }else{ //
        $recid = $_POST['recid'];
        $managemode = $_POST['managemode'];
        $frmpg = $_POST['frmpg'];
        $status = $_POST['status'];
       // $frmpg = segment(5); // from manage, view or kanban
    echo(5893);
    json($_POST); die();
  }
//echo(5900);
//print_r($status);
//json($_POST); die();

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.

    $tgusrid   = $_SESSION['tg_user_id'];
//print_r($tgusrid ); die();
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
    $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table); die();
//print_r($tgusrobj); die();
    // Get the rejector's name for each comment
    if($tgusrid > 0){
    $commenter_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
     $commentdata['commentor']  =  $commenter_obj->first_name.' '.$commenter_obj->last_name;
    }else{
     $commentdata['commentor'] = 'Unk';
    }

        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);

        if($status == 2){ // if rejecting from pending approval send back (currently only place calls this function so technically not needed)
            $data['rejected'] = 1; // True
            $data['status']   = 4; // In Progress
        }

//json($data); die();
        $this->model->update($recid, $data, 'dms_filelibrary_docs'); // when using a field on parent record

        // when using a table of comments
        $commentdata['doc_id'] = $recid;
        $commentdata['status'] = 1; // open  0 - closed
        $commentdata['type']   = $_POST['status']; // what phase doc was in when comment added
        $commentdata['comment'] = $_POST['doccomment'];
        $commentdata['created_at'] = time();
        $commentdata['created_by'] = $_SESSION['tg_user_id'];

        $this->model->insert($commentdata, 'dms_filelibrary_docs_comments');

        $rejectdata['rejectreason'] = $_POST['doccomment'];

        $this->model->update($recid, $rejectdata, 'dms_filelibrary_docs');

       // Auditlog
        $type  = 'update';
        $action = 'RejectDocument';
        $func = 'dmslibrary-modalrejectdoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
       // }
 //print_r($_SESSION['managemode']); die();
        switch($_SESSION['filelibrary_rolename']) {

          case 'ccmp': // CCMP managing my records
                redirect('dms-dmslibrary/manage/ccmp');

          break;

          case 'dmslibsubadmin': // CA managing our subentity record
                redirect('dms-dmslibrary/manage/dmslibsubadmin');

          break;

          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('dms-dmslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('dms-dmslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');
                }else{
                   redirect('dms-dmslibrary/manage/dmslibadmin');
                }

          break;

    default;

        // Auditlog
        $type  = 'unapprovedocrec';
        $action = 'No role';
        $func = 'dmslibrary-modalrejectdoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: dms_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$_SESSION['filelibrary_rolename'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

echo "Error 7178: No matching managemode. Contact System Admin on ";
print_r(SYS_ADMIN_PHONE);
echo " ... Use Back button"; die();

        }

    }
/*------------------------- End modalrejectdoc -------------------------*/

/*--------------------------- SUPPORTING FUNCTIONS ----------------------*/

/*------------------------- _populate_dropdowns ------------------------*/

    function _populate_dropdowns() { //from 2078

// Filtered dropdowns for searching

 // doctags1 filter
    $sqldt1 = 'SELECT * FROM dms_filelibrary_doctags1 WHERE id IN (SELECT DISTINCT doctag1 FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtdoctags1'] = $this->model->query($sqldt1,'object');

  //doctags2 filter
    $sqldt2 = 'SELECT * FROM dms_filelibrary_doctags2 WHERE id IN (SELECT DISTINCT doctag2 FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtdoctags2'] = $this->model->query($sqldt2,'object');

  //doctags3 filter
    $sqldt3 = 'SELECT * FROM dms_filelibrary_doctags3 WHERE id IN (SELECT DISTINCT doctag3 FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtdoctags3'] = $this->model->query($sqldt3,'object');

    // file types filter
    $sqlft = 'SELECT * FROM dms_filelibrary_filetypes WHERE id IN (SELECT DISTINCT filetype FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtfiletypes'] = $this->model->query($sqlft,'object');

     // access filter
    $sqlaccess = 'SELECT * FROM dms_filelibrary_access WHERE id IN (SELECT DISTINCT access FROM dms_filelibrary_docs)';
    $data['filtdoclib_access'] = $this->model->query($sqlaccess,'object');



    // subentitys filter
    $sqlsubs = 'SELECT * FROM dms_filelibrary_subentities WHERE id IN (SELECT DISTINCT subentity FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtsubentities'] = $this->model->query($sqlsubs,'object');
//json($data['filtsubentities']); die();

    // regions dropdown
    $sqlregions = 'SELECT * FROM ref_region_codes WHERE id IN (SELECT DISTINCT region FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtregions'] = $this->model->query($sqlregions,'object');
/*
    // uploaders filter
    $sqlupld = 'SELECT trongate_user_id, first_name, last_name FROM ccmps WHERE trongate_user_id IN (SELECT DISTINCT uploaded_by FROM dms_filelibrary_docs) ORDER BY last_name';
    $data['filtuploaders'] = $this->model->query($sqlupld,'object');
    //   json( $data['filtuploaders'] ); die();
*/
    // ccmps filter
    $sqlccmps = 'SELECT id, first_name, last_name FROM ccmps WHERE id IN (SELECT DISTINCT ccmp_id FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtccmps'] = $this->model->query($sqlccmps,'object');
    //   json( $data['filtccmps'] ); die();

    // lead filter
    $sqlleads = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts WHERE trongate_user_id IN (SELECT DISTINCT poc FROM dms_filelibrary_docs) ORDER BY last_name';
    $data['filtleads'] = $this->model->query($sqlleads,'object');
//json( $data['filtleads'] ); die();

    // staff filter
    $sqlstaffs = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts WHERE trongate_user_id IN (SELECT DISTINCT staff FROM dms_filelibrary_docs) ORDER BY last_name';
    $data['filtstaffs'] = $this->model->query($sqlstaffs,'object');
    //   json( $data['filtstaffs'] ); die();

     // status filter
    $sqlfiltstatus = 'SELECT * FROM dms_filelibrary_status WHERE id IN (SELECT DISTINCT status FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtstatuses'] = $this->model->query($sqlfiltstatus,'object');

     // department filter
    $sqlfiltdept = 'SELECT * FROM dms_filelibrary_departments WHERE id IN (SELECT DISTINCT department FROM dms_filelibrary_docs) ORDER BY title';
    $data['filtdocdepts'] = $this->model->query($sqlfiltdept,'object');
//print_r($data['filtdocdepts']); die();



// unfiltered dropdowns for editing and creating

 // status
    $sqlstatus = 'SELECT * FROM dms_filelibrary_status ORDER BY id DESC';
    $data['statuses'] = $this->model->query($sqlstatus,'object');

  // priority
    $sqlpriority = 'SELECT * FROM dms_filelibrary_priority ORDER BY id DESC';
    $data['priorities'] = $this->model->query($sqlpriority,'object');

 // doctags1
    $sqldt1 = 'SELECT * FROM dms_filelibrary_doctags1 ORDER BY description';
    $data['doctags1'] = $this->model->query($sqldt1,'object');

  //doctags2
    $sqldt2 = 'SELECT * FROM dms_filelibrary_doctags2 ORDER BY title';
    $data['doctags2'] = $this->model->query($sqldt2,'object');

  //doctags3
    $sqldt3 = 'SELECT * FROM dms_filelibrary_doctags3 ORDER BY title';
    $data['doctags3'] = $this->model->query($sqldt3,'object');

    // file types
    $sqlft = 'SELECT * FROM dms_filelibrary_filetypes ORDER BY title';
    $data['filetypes'] = $this->model->query($sqlft,'object');

    // subentitys dropdown
    $sqlsubs = 'SELECT * FROM dms_filelibrary_subentities ORDER BY title';
    $data['subentities'] = $this->model->query($sqlsubs,'object');
 //json($data['subentities']); die();

    // departments dropdown
    $sqldepartments = 'SELECT * FROM dms_filelibrary_departments ORDER BY title';
    $data['departments'] = $this->model->query($sqldepartments,'object');

    // regions dropdown
    $sqlregions = 'SELECT * FROM ref_region_codes ORDER BY title';
    $data['regions'] = $this->model->query($sqlregions,'object');
//json($data['regions'] ); die();

    // uploaders
 //   $sqlupld = 'SELECT trongate_user_id, first_name, last_name FROM ccmps ORDER BY last_name';
//    $data['uploaders'] = $this->model->query($sqlupld,'object');
//json($data['uploaders'] ); die();

    // leads - using staffs
//    $sqlleads = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts ORDER BY last_name';
//    $data['leads'] = $this->model->query($sqlleads,'object');
//json($data['leads'] ); die();

    // ccmps (ex. SGAP participant leader)
    $sqlccmps = 'SELECT id, first_name, last_name FROM ccmps ORDER BY last_name';
    $data['ccmps'] = $this->model->query($sqlccmps,'object');
 //json( $data['ccmps'] ); die();


// A comment type is the status at the time the comment was created
    $sqlstatus = 'SELECT * FROM dms_filelibrary_status ORDER BY id DESC';
    $data['types'] = $this->model->query($sqlstatus,'object');

 //json($data['subentities']); die();

     // staff

    $sqlstaffs = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts ORDER BY last_name';
    $data['staffs'] = $this->model->query($sqlstaffs,'object');
 //   $data['leads']  =  $data['staffs'];
//json( $data['staffs'] ); die();

  $honcho_doclib_access_sql = 'SELECT * FROM dms_filelibrary_access ORDER BY id DESC';

  $data['honcho_doclib_access'] = $this->model->query($honcho_doclib_access_sql,'object');

    return $data;

    }

/*----------------- End _populate_dropdowns ------------------*/

/*----------------- _get_a_single_record --------------------*/

  function _get_a_single_record($recid, $managemode = NULL) {

    // Get an object of the record data to be shown

        $docdata = $this->model->get_where($recid,'dms_filelibrary_docs');
/*
echo(8057);
print_r($recid);
json($docdata); die();


/*--------- View - Convert Updated By & Created By to a Name -----------*/

        $updated_by = $docdata->updated_by;
//echo('Line 1181');
//print_r($updated_by); die();

        $created_by = $docdata->created_by;
//print_r($created_by); die();
        // raw are the codes
        $updated_by_raw = $docdata->updated_by;
        $created_by_raw = $docdata->created_by;

        // get tg user id, use trongate_users tbl to get acct_table, get name


        // updater could be the user himself updated_by is their trongate userid
        $tguserobj2 = $this->model->get_one_where
        ('trongate_user_id', $updated_by, 'honcho_user_accounts');
// echo('3717 $tguserobj2');
// json($tguserobj2); die();

        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;

        $tguserobj3 = $this->model->get_one_where
        ('trongate_user_id', $created_by, 'honcho_user_accounts');

        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;

// get lead (assigned to) name - could beccmp or honcho user

        $tgusrid = $docdata->poc;
//print_r($tgusrid); die();


//echo(3740);
//print_r($docdata->poc); die();
        // if not a real record pass thru updated_by & created_by as the NULL
        //  that it is so wont show up in data-present only tabular reports
        // otherwise you are passing spaces and it will come thru as not null
        //  and not empty and isset = true

        if(strlen($updated_by_first) >0){
            $updatedby        = $updated_by_first.' '.$updated_by_last;
        }
        if(strlen($created_by_first) >0){
          $createdby        = $created_by_first.' '.$created_by_last;
        }

//echo "line 1219";
//print_r($createdby); die();

/*------------ View - Convert Codes & Convert Dates to Nice Dates -------*/
//echo(3763); die();
        // Get dates


        $updated_at   = $docdata->updated_at;
        $created_at   = $docdata->created_at;

        $startdate    = $docdata->startdate;
        $enddate      = $docdata->enddate;
        $assigndate   = $docdata->assigndate;
        $duedate      = $docdata->duedate;
        $eststartdate = $docdata->eststartdate;
        $estenddate   = $docdata->estenddate;
        $submitted    = $docdata->submitted;

//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report

        $date_created_raw = $docdata->date_created;
        $updated_at_raw   = $docdata->updated_at;
        $created_at_raw   = $docdata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        if($managemode == 'dmslibadminupdate'){
        $format = 'datepicker'; //full, cool,shorter,mini, oldschool,datepicker_us,monyear
        }else{
         $format = 'datepicker_us';
        }
//echo(8094);
//json($_SESSION); die();

//echo(8147);
//print_r($recid);
//json($docdata); die();
/*
echo(8151);
json($_SESSION); die();
*/
// if called by viewdocrec can convert to user friendly - but if adding or editing need the numeric unix timestamp

if($_SESSION['callingfunc'] == 'viewdocrec' ){
    $_SESSION['callingfunc'] = ''; // reset
        $this->module('timedate');
        $startdate   = $this->timedate->get_nice_date($startdate, $format);
        $enddate     = $this->timedate->get_nice_date($enddate, $format);
        $assigndate  = $this->timedate->get_nice_date($assigndate, $format);
        $duedate     = $this->timedate->get_nice_date($duedate, $format);
        $eststartdate    = $this->timedate->get_nice_date($eststartdate, $format);
        $estenddate      = $this->timedate->get_nice_date($estenddate, $format);
        $submitted   = $this->timedate->get_nice_date($submitted, $format);

        $docdata->assigndate     = $assigndate;
        $docdata->duedate        = $duedate;
        $docdata->eststartdate   = $eststartdate;
        $docdata->startdate      = $startdate;
        $docdata->estenddate     = $estenddate;
        $docdata->enddate        = $enddate;
        $docdata->submitted      = $submitted;


}
/*
echo(8178);
//print_r($recid);
json($docdata);
json( $_SESSION);
*/


if($_SESSION['callingfunc'] == 'update' ){
     $_SESSION['callingfunc'] = ''; // reset
$assigndate   = date('Y-m-d', $docdata->assigndate);
$eststartdate = date('Y-m-d', $docdata->eststartdate);
$estenddate   = date('Y-m-d', $docdata->estenddate);
$startdate    = date('Y-m-d', $docdata->startdate);
$enddate      = date('Y-m-d', $docdata->enddate);
$duedate      = date('Y-m-d', $docdata->duedate);
$submitted    = date('Y-m-d', $docdata->submitted);

        $docdata->assigndate     = $assigndate;
        $docdata->duedate        = $duedate;
        $docdata->eststartdate   = $eststartdate;
        $docdata->startdate      = $startdate;
        $docdata->estenddate     = $estenddate;
        $docdata->enddate        = $enddate;
        $docdata->submitted      = $submitted;



if($docdata->assigndate == "1969-12-31"){
    $docdata->assigndate = ''; // reset the calendar widget to
}

if($docdata->duedate == "1969-12-31"){
    $docdata->duedate = ''; // reset the calendar widget to
}

if($docdata->eststartdate == "1969-12-31"){
    $docdata->eststartdate = ''; // reset the calendar widget to
}

if($docdata->startdate == "1969-12-31"){
    $docdata->startdate = ''; // reset the calendar widget to
}

if($docdata->estenddate == "1969-12-31"){
    $docdata->estenddate = ''; // reset the calendar widget to
}

if($docdata->enddate == "1969-12-31"){
    $docdata->enddate = ''; // reset the calendar widget to
}

if($docdata->submitted == "1969-12-31"){
    $docdata->submitted = ''; // reset the calendar widget to
}

// echo(8203);
//json($docdata); die();
}
        $this->module('timedate');
        $created_at = $this->timedate->get_nice_date($created_at, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $created_at;
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);
//print_r($createdat); die();

/*------ View - Add Converted Codes &  Nice Dates to the Array ----------*/

        // convert the object to an array to add additional data for the view
        $docdata = (array)$docdata;





       // Translated Codes
       $docdata['updated_by']      = $updatedby;

//print_r($ccmpdata['updated_by'] ); die();
       $docdata['created_by']      = $createdby;

       // Translated Dates

        if($docdata['startdate'] == '12/31/1969' || $docdata['startdate'] == '01/01/1970'){
          $docdata['startdate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['enddate'] == '12/31/1969' || $docdata['enddate'] == '01/01/1970'){
          $docdata['enddate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['assigndate'] == '12/31/1969' || $docdata['assigndate'] == '01/01/1970'){
          $docdata['assigndate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['duedate'] == '12/31/1969' || $docdata['duedate'] == '01/01/1970'){
          $docdata['duedate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['eststartdate'] == '12/31/1969' || $docdata['eststartdate'] == '01/01/1970'){
          $docdata['eststartdate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['estenddate'] == '12/31/1969' || $docdata['estenddate'] == '01/01/1970'){
          $docdata['estenddate'] = '';
        }else{
          // Do nothing
        }

        if($docdata['submitted'] == '12/31/1969' || $docdata['submitted'] == '01/01/1970'){
          $docdata['submitted'] = '';
        }else{
          // Do nothing
        }

       $docdata['updated_at']      = $updatedat;
       $docdata['created_at']      = $createdat;

       $docdata['updated_by']      = $_SESSION['tg_user_id'];
//print_r($docdata['updated_by']); die();
        if($docdata['updated_at'] == '01/01/1970' || $docdata['updated_at'] == '12/31/1969'){

          $docdata['updated_at'] = 0; // before was ' '; i guess for display
        }else{
          // Do nothing
        }

        if($docdata['created_at'] == '12/31/1969' || $docdata['created_at'] == '01/01/1970'){

          $docdata['created_at'] = 0;
        }else{
          // Do nothing
        }
/*
echo(8212);
echo('<br>');
json($docdata); die();
*/
      $data = $docdata;


//echo('Line 3483');
//json($data); die();


      return $data; // returns to 555 when editing and other placed when viewing
    }


/*------------------------- End _get_a_single_record --------------------*/

/*------------------- _get_a_single_comment ------------------------*/

  function _get_a_single_comment($recid, $managemode = NULL) {

    // Get an object of the record data to be shown

        $comdata = $this->model->get_where($recid,'dms_filelibrary_docs_comments');
/*
echo(7591);
echo('<br>');
print_r($recid);
json($comdata); die();
*/

/*--------- Translate codes to user-friendly values ----------*/

        $updated_by  = $comdata->updated_by;
        $created_by  = $comdata->created_by;
        $closed_by   = $comdata->closed_by;
        $resolver    = $comdata->resolver;

        // raw are the codes
        $updated_by_raw   = $comdata->updated_by;
        $created_by_raw   = $comdata->created_by;
        $closed_by_raw    = $comdata->closed_by;
        $resolver_raw     = $comdata->resolver;

        // get tg user id, use trongate_users tbl to get acct_table, get name

        $tguserobj2 = $this->model->get_one_where
        ('trongate_user_id', $updated_by, 'honcho_user_accounts');
 //echo('7615 $tguserobj2');
 //json($tguserobj2); die();

        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;

        $tguserobj3 = $this->model->get_one_where
        ('trongate_user_id', $created_by, 'honcho_user_accounts');
// echo('7623 $tguserobj3');
// json($tguserobj3); die();
        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;

        $tguserobj4 = $this->model->get_one_where
        ('trongate_user_id', $closed_by, 'honcho_user_accounts');
// echo('7630 $tguserobj4');
// json($tguserobj4); die();
        $closed_by_first = $tguserobj4->first_name;
        $closed_by_last  = $tguserobj4->last_name;

        $tguserobj5 = $this->model->get_one_where
        ('trongate_user_id', $resolver, 'honcho_user_accounts');
// echo('7483 $tguserobj5');
// json($tguserobj5); die();
        $resolved_by_first = $tguserobj5->first_name;
        $resolved_by_last  = $tguserobj5->last_name;
//print_r($resloved_by_first); die();
        // if not a real record pass thru updated_by & created_by as the NULL
        //  that it is so wont show up in data-present only tabular reports
        // otherwise you are passing spaces and it will come thru as not null
        //  and not empty and isset = true

        if(strlen($updated_by_first) >0){
          $updatedby        = $updated_by_first.' '.$updated_by_last;
        }else{
            $updatedby        = ' ';
        }
//echo('Line 7554');
//print_r($updatedby); die();
        if(strlen($created_by_first) >0){
          $createdby        = $created_by_first.' '.$created_by_last;
        }else{
            $createdby        = ' ';
        }
//echo('Line 7560');
//print_r($createdby); die();
        if(strlen($closed_by_first) >0){
          $closedby        = $closed_by_first.' '.$closed_by_last;
        }else{
            $closedby        = ' ';
        }
//echo('Line 7512');
//print_r(strlen($resolved_by_first)); die();
        if(strlen($resolved_by_first) >0){
//echo('Line 7509'); die();
          $resolver        = $resolved_by_first.' '.$resolved_by_last;
        }else{
//echo('Line 7512'); die();
            $resolver        = ' ';
        }
//echo('Line 7517');
//print_r($resolver); die();
/*---- View - Convert Codes & Convert Dates to Nice Dates ----*/

        // Get dates

        $updated_at  = $comdata->updated_at;
        $created_at  = $comdata->created_at;
        $closed_at   = $comdata->closed_at;

//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report

        $date_created_raw = $comdata->date_created;
        $updated_at_raw   = $comdata->updated_at;
        $created_at_raw   = $comdata->created_at;
        $closed_at_raw    = $comdata->closed_at;
//echo('Line 7665');
//print_r($managemode); die();  ???
        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        if($managemode == 'dmslibadminupdate'){
        $format = 'datepicker'; //full, cool,shorter,mini, oldschool,datepicker_us,monyear
        }else{
         $format = 'datepicker_us';
        }
        $this->module('timedate');

        $created_at = $this->timedate->get_nice_date($created_at, $format);
        $closed_at = $this->timedate->get_nice_date($closed_at, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $created_at;
        $closeddat     = $closed_at;
//print_r($createdat); die();

/*-- View - Add Converted Codes &  Nice Dates to the Array ---*/

        // convert the object to an array to add additional data for the view
        $comdata = (array)$comdata;

//     $comdata['assigndate']     = $assigndate;

       // Translated Codes
       $comdata['updated_by']  = $updatedby;
       $comdata['created_by']  = $createdby;
       $comdata['closed_by']   = $closedby;
       $comdata['resolver']    = $resolver;

       // Translated Dates
/*
        if($docdata['assigndate'] == '01/01/1970' || $docdata['assigndate'] == '12/31/1969'){
          $docdata['assigndate'] = '';
        }else{
          // Do nothing
        }
*/

       $comdata['updated_at']    = $updatedat;
       $comdata['created_at']    = $createdat;
       $comdata['closed_at']     = $closeddat;

//print_r($comdata['updated_by']); die();
        if($comdata['updated_at'] == '01/01/1970' || $comdata['updated_at'] == '12/31/1969'){

          $comdata['updated_at'] = 0; // before was ' '; i guess for display
        }else{
          // Do nothing
        }

        if($comdata['created_at'] == '01/01/1970' || $comdata['created_at'] == '12/31/1969'){

          $comdata['created_at'] = 0;
        }else{
          // Do nothing
        }

        if($comdata['closed_at'] == '01/01/1970' || $comdata['closed_at'] == '12/31/1969'){

          $comdata['closed_at'] = 0;
        }else{
          // Do nothing
        }

      $data = $comdata;

//echo('Line 7542');
//json($data); die();

      return $data; // returns to ### when editing and other placed when viewing
    }

/*------------------- End _get_a_single_comment --------------*/

/* --------------------- Function FONTSIZE ------------------ */

  function _fontsize() {  // call by ajax function in template inspinia.php
  // navbar.php calls ajax in inspinia.php

//*----------------- Get logged in user's info & preferences ----------*/
      // If there is ANY error in the function code the execution with fail
      // with no error messages surfaced. This code must be perfect!

      // Get the input values posted here
      //Do not use $_POST when called by an ajax function. Use plain post.

      $fs     = post('fontsize');
     // $mfs    = post('tfontsize');
      $sarid  = post('recid');

// If the user entered something that was not 1,2,3 then set it to 2 medium for pages
// NOTE: no longer entered, dropdown menu hard coded for 1,2 or 3


      if($fs == 1 || $fs == 2 || $fs == 3){
}else{
    $_SESSION['DMS_VIEW_TABS_HORZ'] = 0;
    $fs = 2; // default to medium if no value
}

if($fs == 1){  // override tabs choice and make horz if large font
    $_SESSION['DMS_VIEW_TABS_HORZ'] = 1;
}else{
    $_SESSION['DMS_VIEW_TABS_HORZ'] = 0;

}


// If the user entered something that was not 1,2,3 then set it to 3 small for tables
//if($mfs == 1 || $mfs == 2 || $mfs == 3 || $mfs == 4){
//}else{
//    $mfs = 3;
//}
 //print_r($sarid); die();
      $fontdata['fontsize']   = $fs;
 //     $fontdata['tfontsize']  = $mfs;
// echo(4691); die();
      $this->model->update($sarid, $fontdata, 'honcho_user_accounts');
// Just saved the new font values
// Get font size preference for views & manage page
  $this->_get_font_sizes();
//  redirect('');
  }

/*--------------------------- End fontsize -----------------------------*/

/*--------------------------- Function _saveAndPreviewDocx --------------*/
public function _saveAndPreviewDocx()
{
   // echo(4472); die();
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    $description_data = "This is a sample text and i want it to preview this in a browser in word file";
    $section->addText($description_data);

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    try {
        $objWriter->save(storage_path('new_doc12.docx'));
    } catch (Exception $e) {
    }
 // How can i view the file in the browser form here or form the view using the phpWord

}

/*--------------------------- End _saveAndPreviewDocx -------------------*/

/*--------------------------- Function _docx_to_text -------------------*/

function _docx_to_text($input_file = NULL){
        $docid    = segment(3);
            $docobj    = $this->model->get_one_where('id', $docid, 'dms_filelibrary_docs');
    $filetype  = $docobj->filetype;
    $filename  = $docobj->filename;
    $filenm    = str_replace('%20', '_', $filename);
//print_r($filenm); die();

    $fileloc = $docobj->location;

          $input_file = APPPATH.'modules/dms/dmslibrary/assets/'.$fileloc.'/'.$filenm;
 //print_r($input_file); die();
    $xml_filename = "word/document.xml"; //content file name
    $zip_handle = new ZipArchive;
    $output_text = "";

    if(true === $zip_handle->open($input_file)){

        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text = strip_tags($xml_handle->saveXML());
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{

    $output_text .="";
    }
    print_r($output_text); die();
    return $output_text;
}

/*--------------------------- End _docx_to_text ------------------------*/

/*--------------------------- Function _get_mimetype -------------------*/

function _get_mimetype($filepath) {
    if(!preg_match('/\.[^\/\\\\]+$/',$filepath)) {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filepath);
    }
    switch(strtolower(preg_replace('/^.*\./','',$filepath))) {
        // START MS Office 2007 Docs
        case 'docx':
            return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        case 'docm':
            return 'application/vnd.ms-word.document.macroEnabled.12';
        case 'dotx':
            return 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
        case 'dotm':
            return 'application/vnd.ms-word.template.macroEnabled.12';
        case 'xlsx':
            return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        case 'xlsm':
            return 'application/vnd.ms-excel.sheet.macroEnabled.12';
        case 'xltx':
            return 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
        case 'xltm':
            return 'application/vnd.ms-excel.template.macroEnabled.12';
        case 'xlsb':
            return 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
        case 'xlam':
            return 'application/vnd.ms-excel.addin.macroEnabled.12';
        case 'pptx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
        case 'pptm':
            return 'application/vnd.ms-powerpoint.presentation.macroEnabled.12';
        case 'ppsx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
        case 'ppsm':
            return 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12';
        case 'potx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.template';
        case 'potm':
            return 'application/vnd.ms-powerpoint.template.macroEnabled.12';
        case 'ppam':
            return 'application/vnd.ms-powerpoint.addin.macroEnabled.12';
        case 'sldx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.slide';
        case 'sldm':
            return 'application/vnd.ms-powerpoint.slide.macroEnabled.12';
        case 'one':
            return 'application/msonenote';
        case 'onetoc2':
            return 'application/msonenote';
        case 'onetmp':
            return 'application/msonenote';
        case 'onepkg':
            return 'application/msonenote';
        case 'thmx':
            return 'application/vnd.ms-officetheme';
            //END MS Office 2007 Docs

    }
    return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filepath);
}

/*-------------------- End _docx_to_text ------------------------*/

/*-------------------- Function _upload_doc ---------------------*/

    function _upload_doc($config, $name = '') {
        // Saves the posted file (my_file) into $config['destination'] as $name - the filename the caller
        // stores on the document record - or, without one, the uploaded name in lowercase. Replaces $this->file->upload(): stock v2's File module,
        // which this engine doesn't have (every DMS upload gave a 500 until 2026-10-18).
        $file = $_FILES['my_file'] ?? null;
        if(!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])){
            set_flashdata('The file did not upload (error '.intval($file['error'] ?? UPLOAD_ERR_NO_FILE).'). It may be larger than the server allows.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($_SERVER['HTTP_REFERER'] ?? 'dms-dmslibrary/manage');
        }

        $dir = rtrim($config['destination'], '/');
        if(!is_dir($dir) && !mkdir($dir, 0775, true)){
            set_flashdata('The file could not be saved: the folder '.basename($dir).' could not be created. Contact the System Administrator.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($_SERVER['HTTP_REFERER'] ?? 'dms-dmslibrary/manage');
        }

        $name = strtolower(basename($name != '' ? $name : $file['name'])); // basename(): no folder names
        $path = $dir.'/'.$name;
        if(!move_uploaded_file($file['tmp_name'], $path)){
            set_flashdata('The file could not be saved on the server. Contact the System Administrator.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect($_SERVER['HTTP_REFERER'] ?? 'dms-dmslibrary/manage');
        }

        return array('file_name' => $name, 'file_path' => $path, 'file_type' => $file['type'], 'file_size' => $file['size']);
    }

/*------------------ End function _upload_doc --------------------*/

/*------------------- Function _get_dms_role ---------------------*/

    function _get_dms_role($requested = '') {
        // Which documents the list shows and which buttons it offers (RBAC step 4, 2026-10-18):
        //   dmslibadmin    - every document              (DMS Admins, Member System Admins)
        //   dmslibsubadmin - own chapter's documents     (Chapter Admins: members with ccmps/chapter_admin)
        //   dmslibuser     - published documents only    (DMS Users)
        //   ''             - no DMS access
        // Security Groups decide WHAT (rbac_allowed); this decides WHICH documents.
        // $requested (from the URL) can lower the view but never raise it.

        $rank = array('dmslibuser' => 1, 'dmslibsubadmin' => 2, 'dmslibadmin' => 3);

        if(!rbac_allowed('dms', 'view_library')){
            return '';
        }

        $member = (!empty($_SESSION['ccmp_logged_in']) && empty($_SESSION['honcho_logged_in']));

        if(!rbac_allowed('dms', 'approve_docs')){
            $allowed = 'dmslibuser';
        }elseif($member && rbac_allowed('ccmps', 'chapter_admin') && !rbac_allowed('ccmps', 'system_admin')){
            $allowed = 'dmslibsubadmin'; // manages own chapter's documents only
        }else{
            $allowed = 'dmslibadmin';
        }

        if(isset($rank[$requested]) && $rank[$requested] < $rank[$allowed]){
            return $requested; // e.g. an admin choosing the plain user view
        }
        return $allowed;
    }

/*------------------ End function _get_dms_role ------------------*/

/*------------------ Function _dms_function_code -----------------*/

    function _dms_function_code($libraryfunction) {
        // each method passes its old dms_filelibrary_functions id; this is the
        // Security Groups function (dms/<code>) that id now needs - see
        // database/migrations/2026-10-18-system-rbac-step2.sql
        $map = array(
             1 => 'view_library',  2 => 'view_library',  3 => 'view_kanban',   4 => 'view_library',  5 => 'view_library',
             6 => 'edit_docs',     7 => 'edit_docs',     8 => 'edit_docs',     9 => 'view_library', 10 => 'view_library',
            11 => 'bulk_actions', 12 => 'approve_docs', 13 => 'hide_docs',    14 => 'hide_docs',    15 => 'delete_docs',
            16 => 'view_library', 17 => 'download_docs',18 => 'edit_docs',    19 => 'move_cards',   20 => 'move_cards',
            21 => 'move_cards',   22 => 'move_cards',   23 => 'move_cards',   24 => 'move_cards',   25 => 'move_cards',
            26 => 'add_comments', 27 => 'view_comments',28 => 'view_comments',29 => 'manage_comments',30 => 'manage_comments',
            31 => 'manage_comments',32 => 'delete_docs',33 => 'add_comments', 34 => 'approve_docs', 35 => 'add_comments',
            36 => 'add_comments',
        );
        return $map[intval($libraryfunction)] ?? '';
    }

/*------------ Function _check_function_permissions --------------*/

    function _check_function_permissions($libraryfunction, $recid = NULL) {  // protected - private function
        // Every DMS action calls this with its old function id. Either login works (members use DMS too).
        // 1. logged in  2. Security Groups allow the function  3. the document is within reach (_check_doc_scope)

        $home = !empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome';

        if(empty($_SESSION['trongatetoken']) || (empty($_SESSION['honcho_logged_in']) && empty($_SESSION['ccmp_logged_in']))){
            set_flashdata('Your Session has expired - please login again.');
            $_SESSION['flashmsgcolor'] = 0; //red
            redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout'); // clears everything then to login page
        }

        $code = $this->_dms_function_code($libraryfunction);
        if($code == '' || !rbac_allowed('dms', $code)){
            set_flashdata('You are not authorized to use that Document Library function. Contact the System Administrator '.SYS_ADMIN_PHONE);
            $_SESSION['flashmsgcolor'] = 0;
            redirect(($code != 'view_library' && rbac_allowed('dms', 'view_library')) ? 'dms-dmslibrary/manage' : $home);
        }

        // keep a lower view chosen on the manage page; never higher than allowed
        $_SESSION['filelibrary_rolename'] = $this->_get_dms_role($_SESSION['filelibrary_rolename'] ?? '');

        $this->_check_doc_scope(intval($libraryfunction));
        return true;
    }

/*--------------------- End _check_function_permissions -----------------*/

/*------------------- Function _check_doc_scope ------------------*/

    function _check_doc_scope($libraryfunction) {
        // WHICH documents: admins reach all. Chapter admins change only their own chapter's
        // documents (and read those plus published ones). Everyone else reads published
        // documents at their access level - the same rule as the manage list.

        $role = $_SESSION['filelibrary_rolename'];
        if($role == 'dmslibadmin'){
            return;
        }

        $read      = array(2, 5, 9, 10, 16, 17, 27, 28);                                          // read-only functions
        $bydoc     = array(2, 5, 6, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 28, 32); // segment(3) = document id
        $bypost    = array(26, 34);                                                               // $_POST['recid'] = document id
        $bycomment = array(27, 29, 30, 31, 33, 36);                                               // segment(3) = comment id

        $docids = array();
        if(in_array($libraryfunction, $bydoc)){
            $docids[] = intval(segment(3));
        }elseif(in_array($libraryfunction, $bypost)){
            $docids[] = intval($_POST['recid'] ?? 0);
        }elseif(in_array($libraryfunction, $bycomment)){
            $comment = $this->model->get_where(intval(segment(3)), 'dms_filelibrary_docs_comments');
            if($comment){ $docids[] = intval($comment->doc_id); }
        }elseif($libraryfunction == 11){ // bulk action - every ticked document
            foreach((array) ($_POST['selected'] ?? array()) as $selected){ $docids[] = intval($selected); }
        }

        $mysubentity = $this->_my_subentity();
        $mylevel     = intval($_SESSION['dms_lib_access'] ?? 0) + 1; // manage() uses access < level

        foreach($docids as $docid){
            if($docid < 1){ continue; } // a new document or comment
            $doc = $this->model->get_where($docid, 'dms_filelibrary_docs');
            if(!$doc){ continue; }      // the action reports a missing record itself

            $mine      = ($role == 'dmslibsubadmin' && intval($doc->subentity) == $mysubentity);
            $published = (intval($doc->active) == 1 && intval($doc->status) == 1 && intval($doc->access) < $mylevel);
            $ok        = in_array($libraryfunction, $read) ? ($mine || $published) : $mine;

            if(!$ok){
                set_flashdata('That document is not available to you'.($role == 'dmslibsubadmin' ? ' - it belongs to another '.strtolower(SUBENTITY).'.' : '.'));
                $_SESSION['flashmsgcolor'] = 0;
                redirect('dms-dmslibrary/manage');
            }
        }
    }

    function _my_subentity() {
        // the logged-in person's chapter (members) or department (staff)
        if(!empty($_SESSION['ccmp_logged_in']) && empty($_SESSION['honcho_logged_in'])){
            $me = $this->model->get_where(intval($_SESSION['ccmp_rec_id'] ?? 0), 'ccmps');
            return $me ? intval($me->subentity) : -1;
        }
        $me = $this->model->get_where(intval($_SESSION['honcho_acct_rec_id'] ?? 0), 'honcho_user_accounts');
        return $me ? intval($me->honcho_subentity) : -1;
    }

/*------------------- End function _check_doc_scope ---------------*/

/*------------ Function _dmslibrary_calculations --------------*/

    function _dmslibrary_calculations() {  // protected - private function - for dashboard metrics - repeated in Dmslibrary-kanban()

  /* Total records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE soft_deleted != 1";
    $alldocs = $this->model->query($sql,'array');
    $_SESSION['num_doc_records'] = count($alldocs, COUNT_NORMAL);

    /* Total in unrefined records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 6 AND soft_deleted != 1";
    $unrefdocs = $this->model->query($sql,'array');
    $_SESSION['unrefined_doc_records'] = count($unrefdocs, COUNT_NORMAL);
//print_r($_SESSION['unrefined_doc_records']); die();
    /* Total in backlog records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE onhold = 1 AND soft_deleted != 1";
    $onholddocs = $this->model->query($sql,'array');
    $_SESSION['onhold_doc_records'] = count($onholddocs, COUNT_NORMAL);

     /* Total pending approval records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 2 AND soft_deleted != 1";
    $penddocs = $this->model->query($sql,'array');
    $_SESSION['pending_doc_records'] = count($penddocs, COUNT_NORMAL);

    /* Total in review records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 3 AND soft_deleted != 1";
    $inreviewdocs = $this->model->query($sql,'array');
    $_SESSION['inreview_doc_records'] = count($inreviewdocs, COUNT_NORMAL);

     /* Total inprogress records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 4 AND blocked != 1 AND rejected != 1 AND soft_deleted != 1";
    $inprogressdocs = $this->model->query($sql,'array');
    $_SESSION['inprogress_doc_records'] = count($inprogressdocs, COUNT_NORMAL);

     /* Total blocked records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 4 AND blocked = 1 AND soft_deleted != 1";
    $blockeddocs = $this->model->query($sql,'array');
    $_SESSION['blocked_doc_records'] = count($blockeddocs, COUNT_NORMAL);

    /* Total rejected records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE rejected = 1 AND soft_deleted != 1";
    $rejecteddocs = $this->model->query($sql,'array');
    $_SESSION['rejected_doc_records'] = count($rejecteddocs, COUNT_NORMAL);

    /* Total rejected records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 1 AND soft_deleted != 1";
    $approveddocs = $this->model->query($sql,'array');
    $_SESSION['approved_doc_records'] = count($approveddocs, COUNT_NORMAL);

    /* Total approved but not closed records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 1 AND done = 0 AND soft_deleted != 1";
    $approvedopendocs = $this->model->query($sql,'array');
    $_SESSION['approvedopen_doc_records'] = count($approvedopendocs, COUNT_NORMAL);
//print_r($_SESSION['approvedopen_doc_records']); die();
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 5 AND soft_deleted != 1";
    $backlogdocs = $this->model->query($sql,'array');
    $_SESSION['backlog_doc_records'] = count($backlogdocs, COUNT_NORMAL);
    $_SESSION['backlog_onhold_doc_records'] = $_SESSION['backlog_doc_records'] +  $_SESSION['onhold_doc_records'];
    $_SESSION['backlog_rej_onhold_doc_records'] =  $_SESSION['backlog_onhold_doc_records']  +  $_SESSION['rejected_doc_records'];

    $syssettingid                      = 14;
    $sys_setting_obj                   = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['force_edit_to_in_prog'] =  $sys_setting_obj->settingvalue;
    $_SESSION['force_edit_to_in_prog']   = intval($_SESSION['force_edit_to_in_prog']);

    $syssettingid                      = 15;
    $sys_setting_obj                   = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['force_edit_to_backlog'] =  $sys_setting_obj->settingvalue;
    $_SESSION['force_edit_to_backlog']   = intval($_SESSION['force_edit_to_backlog']);

    return;
}
/*--------------------- Function _get_font_sizes -----------------------*/

    function _get_font_sizes() {
    // protected - private function
    // Get user's fontsize preferences for manage page and all other pages
    if(!empty($_SESSION['honcho_logged_in'])){ // staff
        $user_obj               = $this->model->get_where(intval($_SESSION['honcho_acct_rec_id'] ?? 0),'honcho_user_accounts');
    }else{                                      // members use DMS too (RBAC step 4)
        $user_obj               = $this->model->get_where(intval($_SESSION['ccmp_rec_id'] ?? 0),'ccmps');
    }
    $_SESSION['fontsize']       = $user_obj ? ($user_obj->fontsize ?? 2) : 2;   // view pages
    $_SESSION['tfontsize']      = $user_obj ? ($user_obj->tfontsize ?? 3) : 3;  // manage page (members have no tfontsize)

 //  print_r($_SESSION['fontsize']); die();

    // default sizes

         switch($_SESSION['fontsize']) {

          case '': // managing my records
                $_SESSION['fontsize'] = 2;
                $_SESSION['fontname'] = 'Medium';
          break;

          case '0': // managing my records
                $_SESSION['fontsize'] = 2;
                $_SESSION['fontname'] = 'Medium';
          break;

          case '1': // managing my records

               $_SESSION['fontname']   = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['fontname'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['fontname'] = 'Small';
          break;

        }

   //print_r($_SESSION['dfontsize']); die();

          switch($_SESSION['tfontsize']) {

          case '1': // managing my records
                 $_SESSION['tfontsize'] = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['tfontsize'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['tfontsize'] = 'Small';
          break;

        }

    return;
    }

/*------------------------ End _get_font_sizes -------------------*/

} // End controller
