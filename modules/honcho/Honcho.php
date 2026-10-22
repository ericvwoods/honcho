<?php
session_start();
if (defined('DEBUGGING') && DEBUGGING == true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
/*

The Honcho module uses prepurchased HTML/CSS themes created by professional graphic designers.
Each role could theorhetically use a different theme. Here all the admin roles use the Inspina utilitarian theme.
Non-administrative users like members/customers, employees (to get company portal information), sponsors & board members
could get a more pleasing theme, possibly the same theme used for the website for a consistent user experience.

The themes themselves are housed in the Public folder as to be accessible by the website as well. However a future
version of Trongate may allow the assests folder in the module to read more than two subfolders deep to allow the
theme to be stored self contained in the module/submodules.

The dashboard module view folder is divided into different theme name subfolders (in this case Janux for admin functions).
The theme folder contains the main dashboard template file dashboard.php which builds the main dashboard page by
including other menu files (top, side, footer & contentmenu) & a content.php view file (which is initially set to the
custom dashboard for that user role), all in accordance with your role.

For simplicity, a robust set of roles have been predefined rather than employing a complicated role based access system.
These predefined roles with satisfy the requirements of the vast majority of website and web applications.
The dashboards controller Dashboards.php contains the locations of the files for each role and assigns them to the role
using a function called assign dashboards. These locations (filepaths) are then passed to the dashboard for construction
& rendering.  New custom roles can be created quickly by adding a section to assign dashboards for the new role id and creating
a folder  of view files or referencing already created files for other roles (see Hybrids below for an example). If it is a new
type of administrator then simply reference the admins menus and edit sidemenu.php to add the new role id to the if/case
statements for the desired menu items for that new role.

Since all admin roles are just subsets of sysadmin, there is one set of menu files for all types of administrators that use
if/case statements based on role id to determine which menu options to display.

These are found in the site/modules/dashboards/views/JANUX/admins view folder in the menus subfolder.

Pre-defined Roles  ???  This has changed!!!

Roles that share site/modules/dashboards/views/JANUX/admins': header.php, sidemenu.php, footer.php & contentmenu.php
The role ids are used in if/case statements to determine which menu options are available to the user.
They can also be used in if statements to determine which fields on a page are accessible in view files.

1  - System Administrator             - sysadmin          - the only one who can access & manage user accounts, groups, system settings, etc.
4  - Site Administrator               - siteadmin         - the public facing webpages general stuff. Can upload product pictures but not manage products or process orders.
5  - Blog Administrator               - blogadmin         - can create and manage blog posts.
6  - Shop Administrator               - shopadmin         - can manage products, orders, shipping, etc.
7  - Shipping Administrator           - shipadmin         - can only view orders (no changes) and manage shipping & receiving process, and adjust inventory.
8  - Site & Blog Administrator        - siteblogadmin     - combines Site & Blog privileges
9  - Site, Shop, & Ship Administrator - siteshopadmin     - combines Site, Shop, & Shipping privileges
10 - Site, Shop, Ship, & Blog Admin   - siteshopblogadmin - combines Site, Shop, Shipping, & Blog privileges
11 - Shop, Ship, & Blog Admin         - shopblogadmin     - combines Shop, Shipping, & Blog privileges
12 - Photo/Audio/Video Admin          - mediaadmin        - Upload & delete all media files for site, shop & blog
13 - Photo/Audio/Video Uploads Only   - mediauploader     - hire a photographer/videographer a get delivery to the site!
14 - Staff                            - staff             - May not be an employee but temp hire or volunteer staff
17 - Readonly                         - readonly          - Read only access to certain modules - piggly back off SysAdmin

Roles that have their own dashboards/views/janux/ menus.
2  - General User/Member/Customer     - member            - a logged in customer, client, user, or member.
3  - General Employee                 - employee          - not involved with the website. Provides links to employee information, calendar, notices, training, etc.
15 - Board Member                     - board             - May not be an employee but temp hire or volunteer staff

Hybrids: Uses a menu system from one role and the dashboard of another role
This one uses the admin menu system with the same menu selections as the system administrator but with the board member dashboard.
16 - Board Member with SysAdmin rights - boardsysadmin     - Board member with sysadmin rights

The dashboards module is also used to maintain reference tables. Each theme folder contains a folder with the CRUD for each table.
Each CRUD folder contains a manage.php, create.php, and view.php file for working with each table.


*/
//require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//var_dump(class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)); die();

/*
// Include PHPMailer - the require staements break it
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
*/
class Honcho extends Trongate {

  /* INDEX */

function index() {
//$funcid = 1; //  see honcho_functions table
//$authorized = $this->_check_function_permissions($funcid);
// echo(90); die();
// reset any other module modes you may be returning from
//echo(97); die();
//json($_SESSION); die();
//    $_SESSION['ccmpmode']     = ''; // was whatever assigned by sysadminsidemenu
//    $_SESSION['ccmpssidemenu'] = ''; // was admin - triggers the ccmphome sidemenu to display admin version
// echo(96); die();
// Set configuration for module and submodules
$data = $this->model->get('id','system_settings');

//echo(105);
//json($data);
//json($_SESSION); die();

/*
{ json $_SESSION
    "authenticated": 1,
    "tg_user_id": 4,
    "honcho_acct_rec_id": 3,
    "honcho_username": "eric",
    "whoisit": "Eric Woods",
    "jobtitle": "Board Member",
    "first_name": "Eric",
    "user_photo": "eric129x129.jpg",
    "dms_lib_access": 13,
    "honcho_subentity": 1,
    "honcho_logged_in": 1,
    "fontsize": 2,
    "tfontsize": 3,
    "device_type": 1,
    "interface_id": 1,
    "security_group_id": 4,
    "security_group_title": "usergrp",
    "trongatetoken": "RsfbNcKgfnGybAYhjBnkVh8NMvvnCwWq",
    "system_current_year": 2024,
    "system_grace_period": "1"
}

*/
/*  ??? work?
foreach($data as $row) {
  $constant_name = $row->constant_name;
  $value = $row->value;
  define($constant_name, $value);
  }
json($_SESSION); die();
*/
  $this->_clear_duplicate_cookies();

  // if there is an valid token set then get the user and then the user level

  /*
  $this->module('trongate_tokens');
  $trongate_user_obj = $this->trongate_tokens->_get_user_obj();
  $user_level = $trongate_user_obj->user_level_id;
  echo('Honcho.php line 85 - user level: ');
  print_r($user_level); die();
*/

//confirm if user has a user level of 'sysadmin'
//echo('Line 87: ');
//$this->module('trongate_tokens');
//$token = $this->trongate_tokens->_attempt_get_valid_token();
//print_r($token); die();

  // If passed a token, if it is valid you will get the user level
//$this->module('trongate_tokens');
//$user_level = $this->trongate_tokens->_get_user_level($token);
//echo $user_level; //outputs (something like) 'admin'

//print_r($_SESSION['tg_user_level']); die();
/*
  if($_SESSION['tg_user_level'] >0){
//    print('session tg_user_level > 0'); die();
    $_SESSION['role_id'] = $_SESSION['tg_user_level'];
    $role_id             = $_SESSION['tg_user_level'];  // passed from welcome.php-system_auth()

  }else{ // coming from welcome() where $_SESSION['role_id'] is already set
//print_r('line 87 - session tg_user_level NOT > 0');
//print_r($_SESSION['tg_user_level']); die();
    $role_id = $_SESSION['role_id'];
   //print_r($role_id); die();
  }
echo(135); die();
  //print('$role_id = ');
  // role id is set to 1 when use eric 1234
//  print_r($role_id); die(); // will be zero first time through on the way to loading the backend login form

  // store the role id in the dataset
   $data['role_id'] = $role_id;
//echo($role_id); die();
   //$theme = "janux";
   $theme = ADMINTHEME;  //

 // print_r('stop'); die();
  // if use Eric 1234 for shortcut testing, none of this exists cause no url
     if($role_id == 1){

      }else{

      }
*/
 // echo(156);
// new engine
//   $submod = segment(3);  // submodule old way: $this->url->segment(3);
//   $task   = segment(4);  // task
//   $recid  = segment(5);  // record id

//   $filter = segment(7);  // filter

//  print_r('stop'); die();
/*
  // echo('filter in honcho/index');
      echo('<br>');
   print_r($submod);
       echo('<br>');
   print_r($taskj);
         echo('<br>');
   print_r($recid);
   echo('<br>');
   print_r($filter);
     echo(175);
   die();
 */


 /*
   echo(216);
   echo('<br>');
   echo('Role Id: ');
   print_r($role_id);
   echo('<br>');
   echo('Theme: ');
   print_r($theme);
   echo('<br>');
   echo('Submod: ');
   print_r($submod);
   echo('<br>');
   echo('Task: ');
   print_r($task);
   echo('<br>');
   echo('Record Id: ');
   print_r($recid);
   echo('<br>');

   die();
*/



   /*
 print_r('Made it - index() - submod = ');
 print_r($submod); die(); // empty
*/
//echo(208);
//json($_SESSION); die();
//$role_id = $_SESSION['security_group_id'];
$int_id = $_SESSION['interface_id']; // 1 - inspiniausers 2 - inspiniaadmins
//echo(253); print_r($int_id); die();
if(strlen($int_id == 0)){

echo('Error 256 - interface id not set or session expired - Contact System Administrator on 202-207-5353 - use back button to continue.'); die();

}
 // $submodule = "dashboards-".$submod;
  $submodule = "honcho-".$submod; // only submod is system_accounts - so nothing passed?
//echo(261); die();
  if(empty($submod)){   // when dashboard/index runs & no one is logged in then $role_id = 0 & get login screen instead of dashboard
    // Or if use Eric 1234 it will be empty but the role_id = 1
//print_r('empty');  print_r($role_id); die();
//echo(265); die();
    // Assign Dashboard
   $dbrddata =  $this->_assigndshbrd($int_id, $submod);
//echo(268);
//json($dbrddata); die();



// now goes to line 207
//echo('line 150 - back from line 415'); die();
   // if role_id = 0 execution will not return here. Passed to login() and login screen drawn.
 //  json($dbrddata); die();

  }else{ // does this ever execute under the new paradigm ???
 echo('Error 264 - honcho - Contact System Administrator on 202-207-5353 - use back button to continue.'); die();
/*
   echo('Going to submodule: ');
   print_r($submodule);
   echo('<br>');
   echo('Submod: ');
   print_r($submod);
   echo('<br>');
   echo('task: ');
   print_r($task);
   echo('<br>');
   echo('with role_id: ');
   print_r($role_id);
   echo('<br>');
   echo('for record id: ');
   print_r($recid);
   echo('<br>');
   echo('using theme: ');
   print_r($theme);
   echo('<br>');
   echo('and record filter set to: ');
   print_r($filter);
   print_r($_POST); die(); */

 // json($_POST); die();

   // call the submodule and pull back the data to construct the dashboard
   //  ex. goes back to contacts/manage function
  $module =  $this->module($submodule);
// echo(308);
// print_r(module); die();
   $data = $this->$submod->task($task, $role_id, $recid, $theme, $frmpg, $filter);
   print_r($data); die();

/*
   echo('Line 229 Honcho - Returned from submodule - Result of task cases - Ex. line 592 in System_accounts');
   echo('<br>');
   if(DEFAULT_ENGINE == 'old'){
   print_r($data); die();
         }else{
   json($data); die();
    } */

   // put the filter in the data array so it will be passed to the view later on
   //$data['filter_type'] = $filter;
   //print_r('Dashboards: line 135');
   //print_r( $data['filter_type']); die();

   // this was invoked from sidemenu or dashboard large button and parameters
   // submodule (like contacts), task (like manage) were passed 8 lines above
   // then returns to here

 /*
   echo('Back from submodule: ');
   print_r($submodule);
   echo('<br>');
   echo('task: ');
   print_r($task);
   echo('<br>');
   echo('with role_id: ');
   print_r($role_id);
   echo('<br>');
   echo('for record id: ');
   print_r($recid);
   echo('<br>');
   echo('using theme: ');
   print_r($theme);
   echo('<br>');
   echo('from from page: ');
   print_r($frmpg);
   echo('<br>');
   echo('and record filter set to: ');
   print_r($filter)


 json($data); die(); // order still correct

 */
 //echo('Line 211 - honcho.php - submod = ');
//print_r($submod); die();
   // Assign Dashboard


   //    $dbrddata =  $this->_assigndshbrd($role_id, $submod); // line 414
   //     json($dbrddata); die();




  } // end empty submod - dont happen
//echo('honcho 369'); die();
 /*************** Get Rights for Sidemenu and Dashboard Buttons ***************/

// Find out if have admin rights by looking for a match in the honcho_tguserid_security_group table. dmslibuser = 5.

// need to go it it and set to session variable


$sgid = $_SESSION['security_group_id'];
//print_r($sgid); die();
 // Sysadmin - A user with sysadmin rights is given all other rights
//$sqlsysadmin = "SELECT * FROM honcho_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 1";
$sqlsysadmin = "SELECT * FROM honcho_users_security_group_roles WHERE security_group_id = $sgid AND role_id = 1";
$checkadmin_obj = $this->model->query($sqlsysadmin,'object');
//print_r($checkadmin_obj); die();

// ??? separate from ccmp superuser?
if(!empty($checkadmin_obj)){
    $_SESSION['sysadmin']    = 1;
    $_SESSION['admin']       = 1;
    $_SESSION['assistadmin'] = 1;
    $_SESSION['subadmin']    = 1;
    $_SESSION['cmsadmin']    = 1;
    $_SESSION['ccmpsadmin']  = 1;
    $_SESSION['useradmin']   = 1;

    $_SESSION['honcho_sysadmin']     = 1; // global all module rights
    $_SESSION['honcho_ccmps_admin']  = 1; // all rights to specific module named

 // set security group Session variable for each honcho module




//echo('honcho 403');
//json($usersg_obj );
//json($_SESSION); die();


}else{
//     echo('honcho 389');
/*
// DMS User?  Chack to see if their security group has that role
$sqluser = "SELECT * FROM honcho_users_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 6";
$checkuser_obj = $this->model->query($sqluser,'object');
echo(348); die();
if(!empty($checkuser_obj)){

    $sg_obj = $this->model->get_one_where('id', 6, 'honcho_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibuser

}
echo(380); die();
// DMS Subentity Admin?
$sqlsubadmin = "SELECT * FROM honcho_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 7";
$checksubadmin_obj = $this->model->query($sqlsubadmin,'object');

if(!empty($checksubadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 7, 'honcho_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibsubadmin

}

// DMS Admin? if both a subadmin and admin, admin from overwrite subadmin
$sqladmin = "SELECT * FROM honcho_tguserid_security_group WHERE tguserid = $tguserid AND security_group_id = 8 OR tguserid = $tguserid AND security_group_id = 1";
$checkadmin_obj = $this->model->query($sqladmin,'object');
if(!empty($checkadmin_obj)){

    $sg_obj = $this->model->get_one_where('id', 8, 'honcho_security_groups');
    $managemode =  $sg_obj->session_name; // dmslibadmin
}
*/
} // end else
 //echo('honcho 443'); die();
// DMS Filelibrary

    $tg_user_id =  $_SESSION['tg_user_id'];
    $sqluser = "SELECT * FROM dms_filelibrary_tguserid_security_group WHERE tguserid = $tg_user_id";
    $usersg_obj = $this->model->query($sqluser, 'object');
//json($usersg_obj); die();
    $_SESSION['filelibrary_security_group_id'] = $usersg_obj[0]->security_group_id;
// Get role from security group -
//print_r($_SESSION['filelibrary_security_group_id']); die();
$flsgid = $_SESSION['filelibrary_security_group_id'];
                $sgrolesql     = "SELECT * FROM dms_filelibrary_security_group_roles WHERE security_group_id = $flsgid";
                $sgrole_obj = $this->model->query($sgrolesql,'object');
                $roleid =  $sgrole_obj[0]->role_id;
//echo('<br>');
//print_r($roleid); die();
//json($sgrole_obj); die();
                $rolesql     = "SELECT * FROM dms_filelibrary_roles WHERE id = $roleid";
                $role_obj = $this->model->query($rolesql,'object');
                $role =  $role_obj[0]->session_name;
    $_SESSION['filelibrary_rolename'] = $role;

// Add dashboard data array to record data array
$data = array_merge($dbrddata,$data); // if you reverse this order it loops back to dashboard page
    //echo('array merged'); die();

   // Get which parent view file to call
   $view = $data['layout']; // honcho/views/inspinia/layoutone calls
                            // honcho/views/inspinia/user/usersidemenu.php, etc.
 //  echo('honcho 472');
 //  print_r($view); die();

  // Calculate the statistics
/*
  // leads table

  $leadnew = $this->model->count_where('status',0,'=','id','leads','','');
  $data['leadnew'] = $leadnew;
  $leaddel = $this->model->count_where('status',9,'=','id','leads','','');
  $data['leaddel'] = $leaddel;
  $leadrecs = $this->model->count('leads');
  $data['leadcnt'] = $leadrecs-$leaddel;

  // If not 0 or 9 then working (ie any status but new or deleted)

  $data['leadwrk'] = $leadrecs - $leadnew - $leaddel;

 // contacts table

 $contnew = $this->model->count_where('status',0,'=','id','contacts','','');
 $data['contnew'] = $contnew;
 $contdel = $this->model->count_where('status',9,'=','id','contacts','','');
 $data['contdel'] = $contdel;
 $contrecs = $this->model->count('contacts');
 $data['contcnt'] = $contrecs-$contdel;

 // If not 0 or 9 then working (ie any status but new or deleted)

 $data['contwrk'] = $contrecs - $contnew - $contdel;
*/
/*
print_r($view);
echo('<br>');
 echo('Honcho - line 259');
 json($data); die();
*/
//echo(489); die();
/*-------------------------------- Marquee Data ------------------------------*/
//echo(511);
//json($_SESSION); die();
    $mysube = $_SESSION['users_subentity'];
// print_r( $mysube);   die();
    $sql = "SELECT * FROM honcho_cms_marquee WHERE active = 1 AND approved = 1 AND scope = 1 OR active = 1 AND approved = 1 AND scope = 2 OR active = 1 AND approved = 1 AND subentity = $mysube";
    $data['marqueedata']= $this->model->query($sql,'object');
//echo(517);
//json($data['marqueedata']); die();
//
if($data['marqueedata']){
    foreach($data['marqueedata'] as $row) {

        // Need to convert subentity numbers to subentity names
        $subeid    = $row->subentity;
        $subeobj   = $this->model->get_where($subeid,'honcho_subentities');
        $row->subentity = $subeobj->title;
    }

    $nummarqueeitems =  count($data['marqueedata'],COUNT_NORMAL);

    switch($nummarqueeitems){ // if 0 thru 4 use small size image, otherwise large image
        case (0):

        break;

        default:
    }
}
//echo(539);die();
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


    /* Total approved records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 1 AND soft_deleted != 1";
    $approveddocs = $this->model->query($sql,'array');
    $_SESSION['approved_doc_records'] = count($approveddocs, COUNT_NORMAL);

    /* Total approved but not closed records in dms_filelibrary_docs table  */
    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 1 AND soft_deleted != 1";
    $approvedopendocs = $this->model->query($sql,'array');
    $_SESSION['approvedopen_doc_records'] = count($approvedopendocs, COUNT_NORMAL);

    $sql = "SELECT * FROM dms_filelibrary_docs WHERE status = 5 AND soft_deleted != 1";
    $backlogdocs = $this->model->query($sql,'array');
    $_SESSION['backlog_doc_records'] = count($backlogdocs, COUNT_NORMAL);
    $_SESSION['backlog_onhold_doc_records'] = $_SESSION['backlog_doc_records'] +  $_SESSION['onhold_doc_records'];
    $_SESSION['backlog_rej_onhold_doc_records'] =  $_SESSION['backlog_onhold_doc_records']  +  $_SESSION['rejected_doc_records'];

    /* Total user records in honcho_user_accounts table  */
    $sql = "SELECT * FROM honcho_user_accounts WHERE soft_deleted != 1";
    $totalusers = $this->model->query($sql,'array');
    $_SESSION['total_user_records'] = count($totalusers, COUNT_NORMAL);
 //  print_r($_SESSION['total_user_records']); die();
//echo(602); die();
        /* Total ccmps records in ccmps table  */
    $sql = "SELECT * FROM ccmps WHERE soft_deleted = 0"; // !=
    $totalusers = $this->model->query($sql,'array');
    $_SESSION['total_ccmps_records'] = count($totalusers, COUNT_NORMAL);
 //  print_r($_SESSION['total_user_records']); die();
 //
//    echo(609); die();
   // pass the data and redraw the screen - $view is which themes dashboard, not which roles dashboard.
   // $data['contentfile'] = 'login';  //is which roles dashboard
/*
echo('honcho-index 573');
echo('<br>');
print_r($view);
echo('<br>');
json($data); die();
*/
$_SESSION['logindata'] = $data;
   $this->view($view, $data); // default: inspina/layoutone

 }
 /* END INDEX */


function authenticate(){

//$sysfuncid = 3;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid);

// got the posted values already in welcome() - are there functions that point directly to this function ???
//echo(629); die();
    // fp = from post

        // get posted inputs from the login form
    $fpun  = post('username', true);

    $fppw  = post('password', true);

    $fprem = post('remember', true);
//print_r($fppw); die();
    $sysacct_obj = $this->model->get_one_where('username', $fpun, 'honcho_user_accounts');
//json($sysacct_obj); die();

    // if found store the record id for the reset_password function
    // pull any value out that you know is required to prove object exists - id is required
      $sysaccid = $sysacct_obj->id;
    if($sysaccid > 0){



  //  print_r('Line 649 - account found'); die();
            if($emulate =='on'){ // if the system administrator is emulating then wont have a password so set to true
              $password_result = 1;
              $emulate = '';

            }else{

            $password_result = $this->_verify_hash($fppw, $sysacct_obj->password);
  //  echo('Line 657 - password result '); print_r($password_result); die();
            }

            if ($password_result == 1){
             //  $sysacct_id = $sysacct_obj->id;
              // if remember is false make true for testing
                 $_SESSION['authenticated'] = 1;
                 $this->successfullogin($sysacct_obj->id, 'honcho_user_accounts', $fprem);

            }else{

                            // Prepare flash message
                  $flash_msg = 'Username/Password combo was not valid';
                  set_flashdata($flash_msg);

                  $this->login();

            }



    }else{
     // echo('line 454 invalid username'); die();
            // Prepare flash message
            $flash_msg = 'Username/Password combo was not valid';
            set_flashdata($flash_msg);

            $this->login();
  }


}


  function login() {  // this runs when logout as well
//$sysfuncid = 2;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not needed

/*
      $this->module('trongate_tokens');
      $this->trongate_tokens->_destroy();

        // Set configuration for module and submodules
$data = $this->model->get('id','system_settings');

foreach($data as $row) {
  $constant_name = $row->constant_name;
  $value = $row->value;
  define($constant_name, $value);
  }
*/

//  echo(683); die();
    $this->_clear_duplicate_cookies();
    $this->module('trongate_tokens');
    $this->trongate_tokens->_destroy();

    $flashdata =  $_SESSION['flashdata'];

    // Initialize certain session variables
    $_SESSION['flashdata']   =  $flashdata;
    $_SESSION['auditlogger'] = AUDITLOGGER;

//$data['site_name']   = "Honcho Core";  // perhaps put in config db or file
$data['content_name']   = "Honcho Core";  // perhaps put in config db or file

$theme = ADMINTHEME; // constant set in config.php


// Assign the proper dashboard
//$data['htmltitle']   = 'Honcho Login'; // html page title

$data['layout']   = $theme."/layoutone";
//$data['layout']   = $theme."/honcho"; // location of login dashboard honcho.php which calls contentmenu
// & contentfile below, NOT dashboard.php specified by $view. Must be a version for each theme.

$view =  $theme."/layoutone"; // the main dashboard.php file location - either janux or inspinia


/*----------------------- prompt to display the login backend form -----------------------*/


 // inspinia backend login page
  //  echo('Yep!'); die();
  //  $this->module('trongate_tokens');
  //  $this->trongate_tokens->_destroy();

//    $data = $this->_get_login_data_from_post(); // To repopulate the login form with un, pw, rem when fail validation

  //  json($data); die();
    $view =  $theme."/login"; // Bare login page login.php called instead of application dashboard dashboard.php
    $this->view($view, $data);


}
  function loginmvp() {  // this runs when logout as well

// print_r($error); die();
/*
      $this->module('trongate_tokens');
      $this->trongate_tokens->_destroy();

        // Set configuration for module and submodules
$data = $this->model->get('id','system_settings');

foreach($data as $row) {
  $constant_name = $row->constant_name;
  $value = $row->value;
  define($constant_name, $value);
  }
*/
//$data['site_name']   = "Honcho MVP";  // perhaps put in config db or file
$data['content_name']   = "Honcho MVP";  // perhaps put in config db or file

$theme = ADMINTHEME; // constant set in config.php


// Assign the proper dashboard
//$data['htmltitle']   = 'Honcho Login'; // html page title

$data['layout']   = $theme."/layoutone";
//$data['layout']   = $theme."/honcho"; // location of login dashboard honcho.php which calls contentmenu
// & contentfile below, NOT dashboard.php specified by $view. Must be a version for each theme.

$view =  $theme."/layoutone"; // the main dashboard.php file location - either janux or inspinia


/*----------------------- prompt to display the login backend form -----------------------*/


 // inspinia backend login page
  //  echo('Yep!'); die();
  //  $this->module('trongate_tokens');
  //  $this->trongate_tokens->_destroy();

//    $data = $this->_get_login_data_from_post(); // To repopulate the login form with un, pw, rem when fail validation

  //  json($data); die();
    $view =  $theme."/loginmvp"; // Bare login page login.php called instead of application dashboard dashboard.php
    $this->view($view, $data);


}

  function logout() {
//$sysfuncid = 5;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not needed
 //echo(768); die();
    $sadata['last_logout'] = time();
    $sarid = $_SESSION['honcho_acct_rec_id'];
 //  echo(771);
 //  json($_SESSION); die();


if($_SESSION['honcho_logged_in'] ==1){ // if logged in
    $this->model->update($sarid, $sadata, 'honcho_user_accounts');
 //   echo(773);
 //  json($_SESSION); die();
 }

          // Auditlog
        $flash_msg = 'You have logged out successfully!'; //
                set_flashdata($flash_msg);
  //              $flashmsgisset = 1;
                $_SESSION['flashmsgcolor'] = 1; // green
        $type  = 'security';
        $action = 'Logout';
        $func = 'honcho-successfullogout';
        $un   = 'UN: '.$_SESSION['honcho_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

    $this->_clear_duplicate_cookies();

    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));

    $this->module('trongate_tokens');
    $this->trongate_tokens->_destroy();

    // Unset all of the session variables.
    $_SESSION = array(); //session_unset(); //session_destroy();
    $_POST    = array();

    $this->login();

  }
/*
  function validate() {
echo('Made it to honcho-validate'); die();

  } */


  function modalresetpw() {  // called from JS in layoutone.php  - An sysadmin or admin can reset either a honcho_account or a ccmps account
$sysfuncid = 14;
$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid);
//
    // Database to update "ccmps" or "honcho_user_accounts" will be posted
    $dbtupd   = $this->input('dbtupd');
 //  print_r($dbtupd); die();


    // Get the input values & system acct recid hidden in the modal form and passed to javascript then posted here
    $npw   = $this->input('npass');

    // get system account record number for the user, not the sys/assist/admin $_SESSION['honcho_acct_rec_id']; who is logged in as in the change password function below
    $sarid = $this->input('recid');

   // $cpw = $this->input('cpass'); collected but not needed
//print_r($test);

//print_r($dbtupd);
//print_r($npw);
//print_r($sarid); die();

    // The new password and the repeat new password were already confirmed in the modals javascript
    // the new passwords format was also validated in the javascript

//If(strlen($npw) > 4 ){ // new password must be 5 or more character
 // not needed because validated in the javascript. Uncomment if you'd rather validate here but modal will
 // disappear because no javascript validation would have failed. Will have to select Change Password option again.

    //  Hash the new password
      $newhpw = $this->_hash_string($npw);
//echo ($newhpw); die();

      // Save the new password on acct reset by admin - modalchangepw below uses logged in user
//print_r($sarid); die();
      $npwdata['password']     = $newhpw;
      $npwdata['force_pw_chg'] = 1;

      if($dbtupd == "ccmps"){
        $this->model->update($sarid, $npwdata, 'ccmps');
        echo "The Password Was Successfully Reset";
      }else{
        if($dbtupd == "honcho_user_accounts"){
          $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
          echo "The Password Was Successfully Reset";
        }else{
          echo "No DB was specified - Honcho.php/modelresetpw() line 650";

        }
      }

      // Send to login screen

  //  redirect('welcome/login');

  }


  function modalchangepw() { //for changing your own system acct password. ccmps not passed because separate code in Welcome to change own ccmps password
$sysfuncid = 15;
$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid);

    // Get the input values
    $rpwl   = $this->input('rpwl'); // required password length hidden in form field - currently blank
    $pw     = $this->input('crpass');
    $npw    = $this->input('npass');
    $cpw    = $this->input('cpass');
    $dbtupd = $this->input('dbtupd'); // works
    $sarid  = $this->input('recid');  //
//print_r($sarid); die();

    // The new password and the repeat new password were already confirmed in the modals javascript
    // the new passwords format was also validated in the javascript

//If(strlen($npw) > 4 ){ // new password must be 5 or more character
 // not needed because validated in the javascript. Uncomment if you'd rather validate here but modal will
 // disappear because no javascript validation would have failed. Will have to select Change Password option again.

/*
    // get account record number of the currently logged in user
    $sarid = $_SESSION['honcho_acct_rec_id'];

    //echo ($pw); die(); */

    // find the honcho_user_accounts record - if were using this for front end would be a case statement for ccmps vs. honcho_user_accounts

    $sysacctobj = $this->model->get_one_where('id', $sarid, 'honcho_user_accounts');

    // get the saved hashed password
    $realpw = $sysacctobj->password;

  // Verify that the current password entered when hashed matches the saved hashed password (trongate function)
   $pw_result =  password_verify($pw, $realpw);
//echo "pw_result: ";
//echo($pw_result); die();
   // If the current password is verified
   if($pw_result > 0){
//echo('passed!'); die();
    //  Hash the new password
      $newhpw = $this->_hash_string($npw);
//echo ($newhpw); die();

      // Save the new password on the currently logged in account & reset force pw chg flag back to No since the just did it
      $npwdata['password']     = $newhpw;
      $npwdata['force_pw_chg'] = 0;

      if($dbtupd == "ccmps"){  // never the case since Welcome has own code to change your own ccmps password
        $this->model->update($sarid, $npwdata, 'ccmps');
        echo "Your Password Was Successfully Changed";
      }else{
        if($dbtupd == "honcho_user_accounts"){
          $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
          echo "Your Password Was Successfully Changed";
        }else{
          echo "No DB was specified - Honcho.php/modelresetpw() line 650";

        }
      }

   // delete when working  $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
   // delete  when working echo "Your Password Was Successfully Changed";
      // Send to login screen
      // redirect('welcome/login');

   }else{ //current password was not verified
      echo('Current Password is incorrect, try again.');

      //$error_type = 'm';
      //$msg = "The Current Password Failed Validation.";
      //$result = false;
      //echo(json_encode(array('rs'=>$result,'errType'=>$error_type,'msg'=>$msg)));
   }

  }


function _show_change_pw_form($fpun){ // takes a validated username
//$sysfuncid = 16;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // cant reach error 404

      $this->module('trongate_tokens');
      $this->trongate_tokens->_destroy();

      //$data['site_name']   = "AYMP";  // perhaps put in config db or file
      $data['content_name']   = "Aviation Youth Mentoring Program";  // perhaps put in config db or file
      //$theme = "janux";
      $theme = ADMINTHEME; // constant set in config.php - inspinia


      // Assign the proper dashboard
      //$data['htmltitle']   = 'Honcho Login'; // html page title

      $data['layout']   = $theme."/layoutone";
      //$data['layout']   = $theme."/honcho"; // location of login dashboard honcho.php which calls contentmenu
      // & contentfile below, NOT dashboard.php specified by $view. Must be a version for each theme.

      //$view =  $theme."/layoutone"; // the main dashboard.php file location - either janux or inspinia


      $data['resetusername'] = $fpun;
   //   $view =  $theme."/changepw"; // Bare login page login.php called instead of application dashboard dashboard.php
      $view =  $theme."/changepassword"; // Bare login page login.php called instead of application dashboard dashboard.php

//json($data); die();
      $this->view($view, $data);

  }


  function changepassword() {

//$sysfuncid = 9;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid);
//json($_POST); die();

    // Get the input values
    $run  = post('resetusername'); // was previously validated and passed to chg pw form and posted here
    $rpw  = post('resetpassword');
    $npw  = post('newpassword');
    $cpw  = post('confirmpassword');
    $remcpw  = 0; // not used when changing password. Only when logging and re-logging in.
//echo('Line 910 ');
//print_r($run); die();

    if($npw == $cpw){ // validate form input
//echo(914); die();
        // validate reset password

        $sysacct_obj = $this->model->get_one_where('username', $run, 'honcho_user_accounts');

        $password_result = $this->_verify_hash($rpw, $sysacct_obj->password);
 // echo('Line 713 - password result '); print_r($password_result); die();


        if ($password_result == 1){

          // Save the new password & reset the force pw change flag to no
          $npwdata['password'] = $this->_hash_string($npw);
//echo(927); die();
          // reset the force password change flag
          $npwdata['force_pw_chg'] = 0;

          $this->model->update($sysacct_obj->id, $npwdata, 'honcho_user_accounts');

          // prepare the success message
          $flash_msg = 'Your Password Was Successfully Changed. Please Login.';
          set_flashdata($flash_msg);

//  echo('Line 721 - Passed! '); die();
            // should be no remeber value since coming from a change password form and not login screen
           // $this->successfullogin($sysacct_obj->id, 'honcho_user_accounts', $remcpw);  // successfullogin on line 1122
            $this->login();
        }else{

            // Prepare flash message
            $flash_msg = 'Reset Password was not valid';
            set_flashdata($flash_msg);

            $this->_show_change_pw_form($run);
        }


    }else{
echo(952); die();
        // error passwords dont match

            // Prepare flash message
            $flash_msg = 'New & Confirm Passwords do not match';
            set_flashdata($flash_msg);

            $this->_show_change_pw_form($run);

    }// if newpassword = confirmpassword

  }


/* ASSIGN DASHBOARD MENUS */

  function _assigndshbrd($rid = NULL, $submod = NULL){  // assign dashboard - $rid is 0 when no one logged in so get login screen below ie this-> login()

//print_r($rid); die();  // user_level-id from trongate users table . 1 = sysadmin, 7 = ccmps
//     echo('Made it!'); die();
    $data['site_name']   = SITENAME;  // in config file
    //  echo('dashboard 1 line 389'); die();
      // These come from line 818
      $data['role_id']     = $rid; // for testing straight from URL
      $data['logged_in']   = $_SESSION['logged_in'] ; // whether or not to show login or logout button, etc
      $data['whoisit']     = $_SESSION['whoisit']; // for sidemenu & topmenu
      $data['jobtitle']    = $_SESSION['jobtitle'];
      $data['firstname']   = $_SESSION['first_name'];
      $data['user_photo']  = $_SESSION['user_photo'];

//print_r($data['user_photo'] ); die();
   //   $theme = "janux";  // janux is for system/site administration. Customers, employees or users they will get Boss, Unify, etc. to be consistent w/site theme
      $theme = ADMINTHEME;
      $data['layout']   = $theme."/layoutone"; // the main layout file location
      $view =  $theme."/layoutone";

//echo(1121);
//print_r($rid); die();

    if($rid == 1) // Regular User
    {
      // Assign the proper dashboard
      $data['htmltitle']      = "Users Dashboard"; // html page title
      $data['menutitle']      = "Users Menu";
      $data['topmenu']        = "user/usertopmenu";  //the name of the php file containing the top menu code
      $data['sidemenu']       = "user/usersidemenu";
      $data['footer']         = "user/userfooter"; // not used
      $data['contentmenu']    = "user/usercontentmenu"; // not used
      $data['contentfile']    = "user/userdashboard"; // upon login

      $data['breadcrumbfile'] = "user/userbreadcrumbs"; // no flash message cause form flash message wont fire too
   //   $data['breadcrumbfile'] = "admin/adminbreadcrumbserror"; // if a permissions throws an error - red flash message

      $data['content_name']   = "User's Dashboard";
      $data['breadcrumb1']    = "User"; // displayed in the content file
      $data['breadcrumb2']    = "Dashboard"; // displayed in the content file

      return $data;
    }

    elseif($rid == 2)//  Admin
      {

      // Assign the proper dashboard
      $data['htmltitle']      = "Administrators Dashboard"; // html page title
      $data['menutitle']      = "Admin Menu";
      $data['topmenu']        = "admin/admintopmenu";  //the name of the php file containing the top menu code
      $data['sidemenu']       = "admin/adminsidemenu";
      $data['footer']         = "admin/adminfooter"; // not used
      $data['contentmenu']    = "admin/admincontentmenu"; // not used
      $data['contentfile']    = "admin/admindashboard"; // upon login

      $data['breadcrumbfile'] = "admin/adminbreadcrumbs"; // no flash message cause form flash message wont fire too
   //   $data['breadcrumbfile'] = "admin/adminbreadcrumbserror"; // if a permissions throws an error - red flash message

      $data['content_name']   = "Administrator's Dashboard";
      $data['breadcrumb1']    = "Admin"; // displayed in the content file
      $data['breadcrumb2']    = "Dashboard"; // displayed in the content file


 //echo('dashboard 1 honcho.php line 426');
 //json($data); die();
      return $data; // return to index() line 150
    }

    elseif($rid == 3) //assistant administrator
    {
        print_r("Its an Assistant Administrator!");
        die();
    }

      elseif($rid == 4) // siteadmin
      {
        print_r("Its a Siteadmin!");
        die();
      }

            elseif($rid == 4) // system Admin
      {

      // Assign the proper dashboard
      $data['htmltitle']      = "SysAdmin Dashboard"; // html page title
      $data['menutitle']      = "SysAdmin Menu";
      $data['topmenu']        = "sysadmin/sysadmintopmenu";  //the name of the php file containing the top menu code
      $data['sidemenu']       = "sysadmin/sysadminsidemenu";
      $data['footer']         = "sysadmin/sysadminfooter"; // not used
      $data['contentmenu']    = "sysadmin/sysadmincontentmenu"; // not used
      $data['contentfile']    = "sysadmin/sysadmindashboard"; // upon login
      $data['breadcrumbfile'] = "sysadmin/sysadminbreadcrumbs";
//print_r($submod); die();

    /*   if(strlen($submod) > 0){ // coming from a submodule
          // __DIR__ = /Applications/MAMP/htdocs/honchotg/modules/honcho/controllers/
          $data['breadcrumbfile']    = __DIR__."/../". $submod ."/views/inspinia/breadcrumbs";

       }else{ // is a parent module
          $data['breadcrumbfile'] = "honcho_user_accounts/breadcrumbs";
       } */
//print_r($data['breadcrumbfile']); die();
//      echo(946);
//print_r($data); die();
      $data['content_name']   = "System Administrator's Dashboard";
      $data['breadcrumb1']    = "SysAdmin"; // displayed in the content file
      $data['breadcrumb2']    = "Dashboard"; // displayed in the content file


 //echo('dashboard 1 honcho.php line 426');
 //json($data); die();
      return $data; // return to index() line 150
      }

      elseif($rid == 5) //
      {

      }

      elseif($rid == 6) // $rid 6 reserved for ccmp customer/client/member/participant
      {
        print_r("Its an Employee!");
        die();
      }

      elseif($rid == 7)
      {
      // Assign the proper dashboard
      $data['htmltitle']      = "CCMPs Dashboard"; // html page title
      $data['menutitle']      = "CCMP Menu";
      $data['topmenu']        = "ccmp/admintopmenu";  //the name of the php file containing the top menu code
      $data['sidemenu']       = "ccmp/adminsidemenu";
      $data['footer']         = "ccmp/adminfooter"; // not used
      $data['contentmenu']    = "ccmp/admincontentmenu"; // not used
      $data['contentfile']    = "ccmp/admindashboard"; // upon login

      $data['breadcrumbfile'] = "ccmp/adminbreadcrumbs"; // no flash message cause form flash message wont fire too
   //   $data['breadcrumbfile'] = "admin/adminbreadcrumbserror"; // if a permissions throws an error - red flash message

      $data['content_name']   = "CCMP's Dashboard";
      $data['breadcrumb1']    = "CCMP"; // displayed in the content file
      $data['breadcrumb2']    = "Dashboard"; // displayed in the content file
//print_r($data); die();
      return $data;

      }

      elseif($rid == 8) // affiliate
      {
        print_r("Its a Affiliate!");
        print_r("<br />");
        print_r("Coming Soon!");
        die();
      }

      elseif($rid == 9) //mediauploader
      {
        print_r("Its a Media Uploader!");
        print_r("<br />");
        print_r("Coming Soon!");
        die();
      }

      elseif($rid == 10) //readonly
      {
        print_r("Its a Read Only");
        print_r("<br />");
        print_r("Coming Soon!");
        die();
      }

      elseif($rid == 11) // facilitator
      {
        print_r("Its a Level 11!");
        print_r("<br />");
        print_r("Coming Soon!");
        die();
      }

      // 12 cofacillitator, 13expert, 14 evaluator, 15 principal

      else // No role_id or role_id = 0 so didn't log in so send back to login page
      {
            //  print_r("Its a Nobody - send to login"); die();

        $this->login();


      }

  }

/* END ASSIGN DASHBOARD MENUS */


function _get_login_data_from_post() {  // used!
$sysfuncid = 11;
$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not needed cant reach - page not not

  // fp - from post

  if(DEFAULT_ENGINE == 'old'){
      $data['fpusername']  = $this->input('username', true);
      $data['fppassword']  = $this->input('password', true);
      $data['fpremember']  = $this->input('remember', true);
  //    echo('line 972 Honcho'); die();

    }else{
      $data['fpusername']  = $input['username'];
      $data['fppassword']  = $input['password'];
      $data['fpremember']  = $input['remember'];
     // echo('line 978 Honcho'); die();

  }


  return $postdata;
}


function _verify_hash($plain_text_str, $hashed_string){
//$sysfuncid = 12;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not needed cant reach - page not not

//  echo('in verify hash: $result');
//echo($hashed_string);   die();
    $pwverifiedresult =  password_verify($plain_text_str, $hashed_string);
//echo($result); die();
    return $pwverifiedresult; // true or false

}

function _hash_string($str){
//$sysfuncid = 13;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not needed cant reach - page not found

//echo('in hasher'); die();

    $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
               'cost' => 11 ));

    return $hashed_string;
}

    function secondfactor_check(){

    // get posted input from the second factor form
    $second_factor  = post('second_factor', true);


    if(WELCOME_BYPASS_2ND_FACTOR == true){


        $this->successfullogin();

    }
/*
echo('Line 245');
echo('<br>');
echo('Inputted 2nd Factor: ');
print_r($second_factor);
echo('<br>');
echo('Correct 2nd Factor: ');
print_r($_SESSION['second_factor']); die(); // got from DB with successful un/pw ck above
*/

    // Now you need to validate the second factor input against the correct one.
    // A blank second factor on record never matches (a blank entry used to pass),
    // and there is no shared temporary code any more (TEMP_2ND_FACTOR removed 2026-10-22):
    // an account with no second factor can't log in until one is set on its record.
    $correct_second_factor = isset($_SESSION['second_factor']) ? (string) $_SESSION['second_factor'] : '';

    if(strlen($correct_second_factor) > 0 AND hash_equals($correct_second_factor, (string) $second_factor)){  // valid second factor
//echo(256); die();
        $this->successfullogin();

    }else{
 //       echo(' they are NOT equal'); die();

        // Auditlog
        $type  = 'login';
        $action = 'Invalid2ndFactor';
        $func = 'welcome-validate2nd';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $str3 = 'SF: '.$second_factor;
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';

        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);
// xxx need cases for CCMP_SECOND_FACTOR_NAME and SYSTEM_SECOND_FACTOR_NAME
        $flash_msg = 'Your Second Factor was not valid'; // 2nd factor was not valid
        //$flash_msg = 'Your '.SECOND_FACTOR_NAME.' was not valid'; // 2nd factor was not valid
        set_flashdata($flash_msg);

        redirect('honcho/login');  // login page
    }
}

function successfullogin($id, $db, $remember=null) { // after un & pw authenticated - called on line 753
//$sysfuncid = 6;
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid); // not need get page is not working

//equivalent function as the Welcome module successfullogin();

//echo(1422); die();
    // New session id now the login has passed, so an id planted before login
    // (session fixation) is worthless. Session data is kept.
    session_regenerate_id(true);

    $this->module('trongate_tokens');

    if ($remember == 1) {
        $remember = true;
    }else{
        $remember = false;
    }
    // get the account
    $acct_obj = $this->model->get_where($id, $db);
//echo(1435);
//json($acct_obj); die();

    $pwresetflag = $acct_obj->force_pw_chg;
    $fpun = $acct_obj->username;
 //echo(1411); die();
//print_r($pwresetflag); die();

        if($pwresetflag == 1){
//echo('pw reset flag true'); die();
            $flash_msg = "Your password was reset. Please change your password and login again.";
            set_flashdata($flash_msg);
            $flashmsgisset = 1;
            $_SESSION['flashmsgcolor'] = 1; // 1=green 2=red

            //pass the validated username to the reset form to be posted to back to changepw()
            $this->_show_change_pw_form($fpun);
        }else{

    $_SESSION['users_current_year']   = $_SESSION['system_current_year'];

    $_SESSION['tg_user_id']           = $acct_obj->trongate_user_id;
    $_SESSION['honcho_acct_rec_id']   = $acct_obj->id;
    $_SESSION['honcho_username']      = $acct_obj->username;
 //   $_SESSION['whoisit']              = $acct_obj->first_name.' '.$acct_obj->last_name;
    $_SESSION['jobtitle']             = $acct_obj->title;
    $_SESSION['first_name']           = $acct_obj->first_name;
    $_SESSION['user_photo']           = $acct_obj->picture;
    $_SESSION['dms_lib_access']       = $acct_obj->dmslibacclevel;
    $_SESSION['users_subentity']      = $acct_obj->honcho_subentity;

    $_SESSION['honcho_logged_in']     = 1; // For private are test to see if logged in to the backend.(Cant allow both)

    $_SESSION['fontsize']             = $acct_obj->fontsize;  // view pages
    $_SESSION['tfontsize']            = $acct_obj->tfontsize; // manage page

    // ??? set automatically
    $_SESSION['device_type']          = 1; // pc vs. mobile

    // Get the tg userid of the user
    $tgusrid = $_SESSION['tg_user_id']; // already set earlier
//print_r($tgusrid); die();
//print_r($_SESSION['tg_user_id']); die();
    $interface_obj = $this->model->get_one_where('tg_user_id', $tgusrid, 'honcho_tguserid_interfaceid');
    $interfaceid = $interface_obj->interface_id;
//   print_r($interfaceid); die();
    $_SESSION['interface_id'] = $interfaceid ;
// echo(1452);
 //json( $_SESSION); die();
    // RBAC
    // get the single security group that they belong to
  //  print_r($tgusrid); die();
    $assigned_security_group_obj = $this->model->get_one_where('tguserid', $tgusrid, 'honcho_users_tguserid_security_group');
  //   json($assigned_security_group_obj); die();
    $_SESSION['security_group_id'] =  $assigned_security_group_obj->security_group_id;
//print_r($_SESSION['security_group_id']); die();

    // Get the name of that security group
    $security_group_obj = $this->model->get_one_where('id', $_SESSION['security_group_id'], 'honcho_users_security_groups');
  //  echo('honcho1464');
 //    json($security_group_obj); die();

    // assign the security group name to a session variable
    $_SESSION['security_group_title'] = $security_group_obj->title;
 //   print_r($_SESSION['security_group_title']); die();

     // extract the security group id and get the role id
     $grpid  = $security_group_obj->id;
 //    print_r($grpid); die();
  // get role object

$role_obj = $this->model->get_one_where('security_group_id', $grpid, 'honcho_users_security_group_roles');
//     json($role_obj); die();
     $grproleid  = $role_obj->role_id;
   //  print_r($grproleid); die();
   //  Set users role id = to the group id since one-to-one in this version
        $_SESSION['user_role_id'] = $grproleid;

// echo('honcho 1483');
// json($_SESSION); die();

// Create an array of permissions for this role

$sql = "SELECT role_id, function_id FROM honcho_users_roles_functions";
$permissions_array = $this->model->query($sql,'array');
$_SESSION['$permissions_array'] = $permissions_array;
//json($_SESSION['$permissions_array']); die();

// Test
//print_r($_SESSION['user_role_id']); die();
//json($permissions_array); die();
//$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],1);
//print_r($authorized); die();

     /* ex for sysadmin
     {
    "id": 1,
    "title": "sysadmingrp",
    "description": "system administrator group"
    }
     */

 //echo(1381);
 //json($_SESSION); die();
 /* result when sysadmin logs in
{
    "authenticated": 1,
    "tg_user_id": 1,
    "honcho_acct_rec_id": 1,
    "honcho_username": "sysadmin",
    "whoisit": "System Admin",
    "jobtitle": "Default System Administrator Account",
    "first_name": "System",
    "user_photo": "eric129x129.jpg",
    "dms_lib_access": 99,
    "honcho_subentity": 1,
    "honcho_logged_in": 1,
    "fontsize": 2,
    "tfontsize": 3,
    "device_type": 1,
    "interface_id": 2,
    "security_group_id": 1,
    "security_group_title": "sysadmingrp"
}
 */


   // print_r($interfaceid); die();
     // get all the Access Groups the user is assigned to
 //    $sql = "SELECT * FROM honcho_tguserid_access_groups WHERE tguserid = $tgusrid"; / old
   //  $sql = "SELECT * FROM honcho_tguserid_security_group WHERE tguserid = $tgusrid";
    // $access_groups_obj = $this->model->query($sql,'object');

     //   $access_groups_obj = $this->model->get_one_where('id', $tgusrid, 'honcho_tguserid_security_group' );
    //json($access_groups_obj); die();
    // $security_group_id = $access_groups_obj->security_group_id;
    // print_r($security_group_id); die();
    // now that we have the security group get the session_name and make that a session variable



    //    $_SESSION['security_group_id'] =  $security_group_id;
    //    $_SESSION['security_group'] = $security_group_obj->session_name;

     /*   foreach($access_groups_obj as $row) { // have all the security groups now get all functions
            $security_group_id = $row->security_group_id;
           // $sql = "SELECT * FROM honcho_access_group_permissions WHERE access_group_id = $access_group_id"; // old
            $sql = "SELECT * FROM honcho_security_group_functions WHERE security_group_id = $security_group_id";

            $group_functions_obj = $this->model->query($sql,'object');
            json($group_functions_obj); die();

            /*    foreach($group_functions_obj as $row) {
                  //  $securitygroupid = $row->security_group_id;
                    $functionid = $row->function_id;
                    $value = $row->value;
                  //  $sessionname  = $row->permission_session_name;
                  //  $permissionid = $row->permission_id;
                  //  $value = $row->value;
/*
                    if ( $value == 1){ // so wont overwrite a perm already set to 1 with a 0 from
                                       // another group user belongs to that doesnt have this perm
                        // Go get permission name from permissions table
                        $permission_obj = $this->model->get_one_where('id', $permissionid, 'honcho_permissions');

                        $sessionname = $permission_obj->permission_session_name;
                        $_SESSION[$sessionname] = 1; // creates session variable in memory
                    }




                }
        }  */

    //update num logins
    $num_logins = $acct_obj->num_logins;
    $data['num_logins'] = $num_logins + 1;
    $data['last_login'] = time();
   // $data['user_token'] = '';
//echo(1613); die();
    $this->model->update($id, $data, $db);

    $token_data['user_id'] = $acct_obj->trongate_user_id;
//echo(1616); die();
    if ($remember == true) {
//print_r($remember); die();
        //set token for 60 days (cookie)
        $thirty_days = 86400*60; //number of seconds in 60 days
        $nowtime = time(); // unix timestamp
        $token_data['expiry_date'] = $nowtime+$thirty_days; //60 days ahead as a timestamp
        $token_data['set_cookie'] = true;
    //print_r($token_data); die();
    //json($data); die();
        $this->module('trongate_tokens');
        $this->trongate_tokens->_generate_token($token_data); //generate toke & set cookie
 // echo('remember is true - generated token'); die();
 //json($data); die();
    } else {

        //set short term token (session)
        $_SESSION['trongatetoken'] = $this->trongate_tokens->_generate_token($token_data);
   //echo('remember is false - generated token'); die();

    }
//echo('take to page'); die();

/**************  Extract CCMP & DMS module settings from system table ***************************/

    $syssettingid                    = 1;
    $sys_setting_obj                 = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['system_current_year'] =  $sys_setting_obj->settingvalue;
    $_SESSION['system_current_year'] = intval($_SESSION['system_current_year']);

    $syssettingid                     = 2;
    $sys_setting_obj                  = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['system_grace_period']  =  $sys_setting_obj->settingvalue;

    $syssettingid                      = 14;
    $sys_setting_obj                   = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['force_edit_to_in_prog'] =  $sys_setting_obj->settingvalue;
    $_SESSION['force_edit_to_in_prog']   = intval($_SESSION['force_edit_to_in_prog']);

    $syssettingid                      = 15;
    $sys_setting_obj                   = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['force_edit_to_backlog'] =  $sys_setting_obj->settingvalue;
    $_SESSION['force_edit_to_backlog']   = intval($_SESSION['force_edit_to_backlog']);
 //   echo(1500);
//    json($_SESSION); die();
 /*
    $ccmpsettingid                    = 1;
    $ccmp_setting_obj                 = $this->model->get_where($ccmpsettingid ,'ccmps_settings');
    $_SESSION['ccmps_current_year']   =  $ccmp_setting_obj->settingvalue;
    $_SESSION['ccmps_current_year']   = intval($_SESSION['ccmps_current_year']);
//print_r($_SESSION['ccmps_current_year']); die();
    $ccmpssettingid                  = 2;
    $ccmps_setting_obj               = $this->model->get_where($ccmpssettingid ,'ccmps_settings');
    $_SESSION['ccmps_grace_period']  =  $ccmps_setting_obj->settingvalue;

    // For CCMP Module Views
 //  ccmp_active_window needed?

    $_SESSION['ccmp_subentity']       = 1; // national
 // $_SESSION['ccmp_subentity_role']  = 1; // national

 */


/*
echo(1681);
echo('<br>');
json( $_SESSION);
json($data); die();
*/
  /*
        // Auditlog
        $type  = 'login';
        $action = 'LoginSuccessful';
        $func = 'welcome-username_pw_check';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'SecGrp-RoleId: '.$_SESSION['security_group'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $str6 = 'Device: '.$_SESSION['device_type'];

        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $ip_address); */

        // Auditlog
        $type  = 'security';
        $action = 'Logged In';
        $func = 'honcho-successfullogin';
        $un   = 'UN: '.$_SESSION['honcho_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

        // redirect instead of $this->index() so the dashboard's address is honcho, not the
        // login form's POST target (honcho/authenticate) - the back button then works
        redirect('honcho');
}
}
/*
function _pairExists($pairs, $val1, $val2) {
    print_r($pairs);
    echo('<br>');
    print_r($val1);
    echo('<br>');
    print_r($val2); die();
    foreach ($paris as $pair) {
        if ($pair[0] == $val1 && $pair[1] == $val2) {
    echo('1656 Yes'); die();
            return true;
        }
    }
    echo('1660 No'); die();
    return false;
}
*/

// --- Function to check role_id/function_id pair exists ---
function _pairExists($pairs, $val1, $val2) {

    foreach ($pairs as $pair) {
        if ($pair['role_id'] == $val1 && $pair['function_id'] == $val2) {

            return true;
        }
    }

    return false;
}

  function thankyou() {
echo(1715);
echo('<br>');
// thankyou?cc=USD&amt=5.00&tx=7EG90661RS364335Y&st=COMPLETED

    $conf  = segment(2);  //
 print_r($conf);
  //  echo('<br>');
   $cmstart= strpos($conf,"&amt=") +5;
 // print_r($cmstart);
 //   echo('<br>');
   $cmend =  strpos($conf,"&tx") -1;
   $cmlength = $cmend-$cmstart +1;
 //   print_r($cmend);
    $payment = substr($conf, $cmstart, $cmlength);
     echo('<br>');
     print_r($payment);
     echo('<br>');
    $trstart = strpos($conf,"&tx") + 4;
    $trend =  strpos($conf,"&st") -1;
    $trlength = $trend-$trstart +1;
    $transid = substr($conf, $trstart, $trlength);
    print_r($transid);
    echo('<br>');
    $ststart = strpos($conf,"&st") + 4;
 //       print_r($ststart);
 //       echo('<br>');
    $status = substr($conf, $ststart, 100);
    $status = trim($status);
    print_r($status);
 die();

  }
 function ccmps_admin_menu() {
$sysfuncid = 10;
$authorized = $this->_pairExists($permissions_array,$_SESSION['user_role_id'],$sysfuncid);
   //  $_SESSION['ccmp_system_admin'] = 1;
     $_SESSION['ccmp_username'] = $_SESSION['honcho_username'];
   // $_SESSION['ccmpmode']     = "honcho_ccmps_system_admin";
    $_SESSION['ccmpssidemenu'] = 'admin'; // triggers the ccmphome sidemenu to display admin version

    redirect('welcome-ccmps/ccmphome');
 }


/**
* Every time you call session_start(), PHP adds another
* identical session cookie to the response header. Do this
* enough times, and your response header becomes big enough
* to choke the web server.
*
* This method clears out the duplicate session cookies. You can
* call it after each time you've called session_start(), or call it
* just before you send your headers.
*/

function _clear_duplicate_cookies() {

    // If headers have already been sent, there's nothing we can do
    if (headers_sent()) {
        return;
    }

    $cookies = array();
    foreach (headers_list() as $header) {
        // Identify cookie headers
        if (strpos($header, 'Set-Cookie:') === 0) {
            $cookies[] = $header;
        }
    }
    // Removes all cookie headers, including duplicates
    header_remove('Set-Cookie');

    // Restore one copy of each cookie
    foreach(array_unique($cookies) as $cookie) {
        header($cookie, false);
    }

}

  function autobackupsql(){

    $databases = ['honchomvp'];
    $user = 'root';
    $pass = 'root';
    $host = 'localhost';

//chgrp -R _www /the/parent/directory/here
    date_default_timezone_set("America/New York");
  //  print_r('Ok'); die();
    foreach($databases as $database){

      if(!is_dir(("/Applications/MAMP/htdocs/honchotg/databases/$database"))){

        mkdir("/Applications/MAMP/htdocs/honchotg/databases/$database", 0755);
     print_r('nope'); die();
      }

$filename = $database."_".date("F_d_Y")."@".date("g_ia").uniqid("_", false);
$folder = "/Applications/MAMP/htdocs/honchotg/databases/$database/".$filename.".sql";

//exec("c:/xampp/mysql/bin/mysqldump --user={$user} --pasword={$pass} --host={$host} {$database} --result={$folder}", $output);
exec("/Applications/MAMP/bin/apache2/bin/mysqldump --user={$user} --pasword={$pass} --host={$host} {$database} --result={$folder}", $output);

}
print_r($output); die();
  }

function X_check_function_permissions($funcid = NULL){
/*
echo(1245);
echo('<br>');
print_r($sysfuncid);
echo('<br>');
json($_SESSION); die();
*/
// die();

$sgid = $_SESSION['security_group_id'];
$sql = "SELECT * FROM honcho_security_group_functions WHERE security_group_id = $sgid AND function_id = $funcid";
         $sgf_obj = $this->model->query($sql,'object');


  //   $sysacct_obj = $this->model->get_one_where('username', $funcid, 'honcho_security_group_functions');
         if(isset($sgf_obj)){
                  //json($sgf_obj); die();
         $value = $sgf_obj[0]->value;
//print_r($value); die();
                   if($value == 1){
                       return true;
                   }else{
    $flash_msg = 'You are not authorized to execute this function'; //
    set_flashdata($flash_msg);

    // login again
    redirect('honcho/logout'); // clears everything then takes to login page

                   }

         }else{
    $flash_msg = 'You are not authorized to execute this function'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('honcho/logout'); // clears everything then takes to login page
         }

/*
if($_SESSION['honcho_logged_in'] == 1 || $_SESSION['authenticated'] == 1){

//echo(1268); die();
    if($sysfuncid == 0){ // if you need to do something special with a function
        // get all the permission ids the assigned to this function
         $sql = "SELECT * FROM honcho_functions_permissions WHERE function_id = $sysfuncid";
         $fp_obj = $this->model->query($sql,'object');
         //json($fp_obj); die();
              foreach($fp_obj as $row) { // even if only one becase query returns object in matrix
                $reqpermid = $row->permission_id;
              }
        //print_r($reqpermid); die();
        // json($_SESSION); die();
         $permission_obj = $this->model->get_one_where('id', $reqpermid, 'honcho_permissions');
         $sessname =  $permission_obj->permission_session_name;
      //print_r($sessname); die();
         $reqsession = $_SESSION[$sessname];
     //print_r($reqsession); die();
         if($reqsession == 1){
             echo('yep'); die();

         }else{
             echo('nope'); die();
         }
    }else{
     // do nothing - being logged in is sufficient
   // echo(1287); die();
    }

}else{ // if you are not logged in then nothing else to consider
//echo(1292); die();
    $flash_msg = 'You must be authenticated to execute this function'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('honcho/logout'); // clears everything then takes to login page
}
*/
//echo(1298); die();
}

} // end of class
