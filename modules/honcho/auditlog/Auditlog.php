<?php

/*----------------------------------------------------------------------------*/
/*------------------------ module HONCHO-AUDITLOG ----------------------------*/
/*----------------------------------------------------------------------------*/

/*--------------------------- function list ----------------------------------*/
/*
  index()
        _check_function_permissions($usersfunction)
  adminmenu()
  usermenu()
  userhome()
        _check_function_permissions($usersfunction)
  mydata
        _get_a_single_record($recid) anchor1
        _convert_to_user_friendly($data_sr)
  _get_a_single_record($recid)
  viewuser($recid = NULL)
        _check_function_permissions($usersfunction, $recid)
        _get_font_sizes()
        _get_a_single_record($recid)  anchor1
        _convert_to_user_friendly($data)  anchor3
  manage()
        _check_function_permissions($usersfunction)
        _get_font_sizes()
        _get_a_single_record($recid) anchor1
  updateuser($retrying) 
        _get_a_single_record($recid) anchor1
        _convert_null_integers_to_zeros($data) anchor4
  createuser($retrying)
        _get_font_sizes()
        _create_dropdowns()1975
  usersubmit() 
        $this->validation_helper 
        _users_fetch_data_from_post() anchor2
        _addr_simple_fetch_data_from_post()
        recalcstatus($recid)
        _addr_fetch_data_from_post()
        viewuser($recid)
        _generate_rand_code()
        _get_a_single_record($new_id) anchor1
        _convert_to_user_friendly($data) anchor3
        updateuser('yes')
        createuser('yes')
  _users_fetch_data_from_post() anchor2 
  _addr_simple_fetch_data_from_post($mailrecid,$physrecid)  
  _financial_fetch_data_from_post()  
  _convert_posted_fintbl_to_numerics($data = NULL) 
  _user_fetch_data_from_post()
  _get_subentity_data() 
  _create_dropdown_menus() 
  _convert_to_user_friendly($data) anchor3
        Change codes to names 
        Convert the Binary Yes/No fields
  _convert_null_integers_to_zeros($data) ancho4
  bulkaction()
        _check_function_permissions($usersfunction)
        recalcstatus($mcid)
        _generate_rand_code()
  fontsize()
  createuseruseraccount($reposted=NULL)
        useruseracctsubmit($data)
        _get_font_sizes()
        useruseracctsubmit($data)
  useruseracctsubmit($data = NULL) 
        _generate_rand_code() 
        recalcstatus($recid) 
  currentroster($posterid = null) 
        _check_function_permissions($usersfunction)
        _get_font_sizes()
        _get_a_single_record($recid) anchor1
  currentdirectory($posterid = null)  
        _check_function_permissions($usersfunction)  
        _get_font_sizes()  
  function spreadsheet_format_download()
  function userupload()
  function upload_form()
  function export()
  function mastercurrentroster($recid = null)
  function lesxlsfile()
  function _generate_rand_code()
  function modaladdemail()
  modalresetpw()
  modalchangepw()
  _hash_string($str)
  function lockacct()
  function unlockacct()
  function delrecord()
  function undelrecord()
  function removerecord()
  _get_user_token_expiration($tguserid2) 
  _convert_level_id_to_name($tguserid)
  uploaduserpic($recid)
  _init_picture_settings()
  submit_upload_picture($update_id) 
        _init_picture_settings()
        _make_sure_got_destination_folders($update_id, $picture_settings)
        upload_picture($config)
  _make_sure_got_destination_folders($update_id, $picture_settings) 
  ditch_picture($update_id)
  _reset_cart_dropdown()
  recalc_totals($data)
  _check_function_permissions($usersfunction, $recid = NULL)
  _get_font_sizes()
  refreshmysessiondata() 
  recalcstatus($recid) 
  numval($type, $vallimit, $val)
  events($id = NULL) 
  sponsors() 
  sendsponsorsformemail() 
  _creds_fetch_data_from_post()
  
*/
/* Add-ins
 
*/
/*----------------------------------------------------------------------------*/

require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Auditlog extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/
    
    function _construct(){
      $this->parent_module = 'honcho';
      $this->child_module  = 'auditlog';

    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module = '';
    }

/*----------------------------------------------------------------------------*/
/*---------------------------- function INDEX --------------------------------*/
/*----------------------------------------------------------------------------*/
    
  function index() { 
echo "honcho-auditlog-index() 152"; die();
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  


  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function _pairExists --------------------------*/
/*----------------------------------------------------------------------------*/
// --- Function to check role_id/function_id pair exists ---
function _pairExists($pairs, $val1, $val2) {

    foreach ($pairs as $pair) {
        if ($pair['role_id'] == $val1 && $pair['function_id'] == $val2) {

            return true;
        }
    }

    return false;
}

/*----------------------------------------------------------------------------*/
/*-------------------------- function ADMINMENU ------------------------------*/
/*----------------------------------------------------------------------------*/

    function adminmenu(){

 $_SESSION['userssidemenu'] = 'admin'; // admin menu
 redirect('honcho-users/userhome');

  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function USERMENU ------------------------------*/
/*----------------------------------------------------------------------------*/
  
    function usermenu(){

    $_SESSION['userssidemenu'] = ''; // member button sidemenu default
    redirect('honcho-users/userhome');

  } 
  /*----------------------------------------------------------------------------*/
/* ---------------------------- function MANAGE ----------------------------- */
/*----------------------------------------------------------------------------*/

function manage(){ // takes you to subentity admin manage page

$_SESSION['managemode'] = segment(3); // passed from sidemenu button sets the mode

 //echo('manage 1032');
 //json($_SESSION); die();
 
    if($_SESSION['useradmin'] == 1 || $_SESSION['sysadmin'] == 1 ){
        // ok no check   
    }else{
       // echo('Honcho-Auditlog 207'); die();
    $authorized = $this->_pairExists($_SESSION['$permissions_array'],$_SESSION['user_role_id'],7);
$authorized = 1;  // for testing
            if($authorized ==1){
        // everything is ok - continue to retrieve account record
 // echo('users/manage 1043 Authorized'); die();

 // this value kept going back to null if login & logout and login               
$_SESSION['users_current_year']   = $_SESSION['system_current_year'];  
// json($_SESSION); die(); 

            }else{
  //echo('users/mydata 1046 Not Authorized'); die();                 
         //       json($_SESSION); die();
    $flash_msg = 'You do not have permission to manage auditlog data  - please contact the system administrator.'; // 
                set_flashdata($flash_msg);
  //              $flashmsgisset = 1; 
                $_SESSION['flashmsgcolor'] = 0; //                 
        // Auditlog  
        $type  = 'security';
        $action = 'NoPermission';
        $func = 'honcho-auditlog_manage';
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
    }
/*        
echo('users/mydata 545 not authorized');
echo('<br>');
print_r($view);
echo('<br>');
json($_SESSION['logindata']); die(); */

 //redirect('honcho/index');     
    }
//echo(250); die();
//print_r($authorized); die(); // "goodtogo". if not goodtogo wont return here. Will go to userhome or login

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
 // $this->_get_font_sizes();
//echo(256); die();
    if(strlen($_SESSION['trongatetoken']) > 0){
        // ok do nothing
    }else{
        $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
        set_flashdata($flash_msg);

        // you logged out or session timed out - login again
        redirect('honcho/logout'); // clears everything then takes to login page
    }
  
    // What tab want to start on when entering a record
    $_SESSION['user_active_window'] = 0; // resetting 
 //echo(269);
//json($_SESSION); die();
      $currentyear = $_SESSION['users_current_year'];

      if($currentyear < 2026){
        $currentyear = 2026;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-manage-278';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: users';
        $str5 = 'Title: '.$title;
        $str6 = $time;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $str4, $str5, $un, $str6, $str3);

    }    
    
        $currentyear = $currentyear - 1;
      

    $_SESSION['actionmode'] = 'viewlist';
      
     $sql = "SELECT * FROM system_auditlog";
     $data['auditlogrecs'] = $this->model->query($sql,'object');

//echo(304); //  checkpoint
//json($data['auditlogrecs']); die();

        foreach($data['auditlogrecs'] as $row) { // step through the object of records and populate the $data array with selected data 
         
            $id         = $row->id; // 
            $type       = $row->type; //
            $action     = $row->action; //
            $func       = $row->func; //
            $str5       = $row->str5; //
            $str6       = $row->str6; //
            $str1       = $row->str1; //
            $str2       = $row->str2; //
            $str3       = $row->str3; //
            $str4       = $row->str4; //            
            $created_by = $row->created_by; //
            $created_at = $row->created_at; //

            $this->module('timedate');
            $format = 'datepicker_us';
            $row->created_at  = $this->timedate->get_nice_date($row->created_at, $format);

            if($row->created_at == '01/01/1970'){
              $row->created_at = ' ';
            }
            
} // end foreach 

    // CCMP Manage Bulk Actions Dropdwon for Current Records different than
    // past due for example can have make current button since everyone current
  
  // get dropdown for all tabs and will unset some on a $_SESSION['managemode'] case basis 
   $data['bulk_actions'] = $this->model->get('id','honcho_user_bulk_actions');
  
    unset($data['bulk_actions'][1]); // Make Current
    unset($data['bulk_actions'][3]); // Lock Account not implemented
    unset($data['bulk_actions'][4]); // Unlock Account not implemented    
    unset($data['bulk_actions'][5]); // Approve Account not implemented
    unset($data['bulk_actions'][6]); // Approve Members not implemented
    unset($data['bulk_actions'][8]); // Archive Members not implemented

//  echo(2515);
//  print_r($data['bulk_actions']); die();
/*
echo(347);
echo('<br>');
print_r($_SESSION['actionmode']);
echo('<br>'); 
json($data['auditlogrecs']); die();
*/
        $data['view_module']   = 'honcho/auditlog';
        $data['view_file']     = 'manage'; // 


        switch($_SESSION['actionmode']) { // 

        case 'viewlist': // managing all auditlog records

              $data['bc1']      = 'System Admin';
              $data['bc2']      = 'Auditlog';
              $data['activity'] = 'Auditlog Records';
            //  $data['header']   = 'System Administration';
        break;
    
        case 'mcmm': //  - used for current student members only - no past due tabs

              $data['bc1'] = CCMP.' Admin';
              $data['bc2'] = 'Manage Student '.CCMPS;
              $data['header']   = 'Student '.CCMPS;
              $data['activity'] = CCMP.' Administrator';


        break;

        }

/*
  echo(380); // checkpoint
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  die();
*/    
        $this->templates->inspinia($data);

  }
/*----------------------------------------------------------------------------*/
/*----------------------- End function manage --------------------------------*/
/*----------------------------------------------------------------------------*/





/*----------------------------------------------------------------------------*/
/*--------------------- function _GET_A_SINGLE_RECORD ------------------------*/
/*--------------------------------- anchor 1 ---------------------------------*/    
// anchor 1 - called from line 129 when viewing & line 452 when updating and 550 for my data

 
function _get_a_single_record($recid) {  
//print_r($recid); die();
        // Get an object of the record data to be shown
              // query for single record - ('order_by', 'table', limit, offset)

        $user_data = $this->model->get_where($recid,'honcho_user_accounts');
        $userid = $user_data->id;

        $_SESSION['fontsize']       = $user_data->fontsize;  // view pages
        $_SESSION['tfontsize']      = $user_data->tfontsize; // tables 
     //   $this->_get_font_sizes();
        $sbintid = $user_data->subentity;
        $sbintobj = $this->model->get_one_where('id', $sbintid, 'honcho_user_subentities');
       // print_r($sbintobj); die();
        $user_data->region = $sbintobj->region;

//echo(603);       
//json($user_data); die();

/*--------------- View - Convert to TG UL ID to Name -------------------*/
//       print_r($user_data); die();
        // pull out the trongate user id to search the trongate_users table for user_level_id

        $tguserid = $user_data->trongate_user_id; // record id for the user in trongate_user
  //      $levelname = $this->_convert_level_id_to_name($tguserid);
//echo(617); die();
 // print_r($tguserid);
 // print_r($levelname); die();
 //         $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');      
 //         $user_data->tguserlevel = $tguserobj->user_level_id; // for update dropdown
 
 //         $tguserlvlobj = $this->model->get_one_where('id', $tguserid, 'trongate_user_levels');    
 //         $user_data->levelname = $tguserlvlobj->level_title; // for update dropdown


/*----------------- View - Get User Token Expiration -------------------*/

        // pull out the trongate user id to search the trongate_users table for token expiration date
        $tguserid2 = $user_data->trongate_user_id; // record id for the user in trongate_user
        $tokenexpires = $this->_get_user_token_expiration($tguserid2); 
//print_r($tokenexpires); die(); 

        
/*-------------------------- Get the CCMP address ----------------------------*/
     
    // Get the address data
 /*   if(CCMPS_ADDR_TABLE == 'users_addresses_mp'){
        $addrdata = $this->model->get_one_where('user_id', $recid, CCMPS_ADDR_TABLE);
        
        unset($addrdata->id);
        unset($addrdata->code);
    }else{ */
        
        /* here you will need to get mailing and physical  */
     
         // get the record where the user_id = $user_id and type = 1 with $mailaddrdata
        $mailaddrsql = "SELECT * FROM honcho_user_addresses WHERE user_id = $userid AND type =1";
        $mailaddrobj = $this->model->query($mailaddrsql,'object');
        $mailaddrid  = $mailaddrobj[0]->id;       
        
        $mailaddrdata = $this->model->get_one_where('id', $mailaddrid, CCMPS_ADDR_TABLE);
        
//echo(650);
//json($mailaddrdata); die();

         // get the record where the user_id = $user_id and type = 2 with $physaddrdata
        $physaddrsql = "SELECT * FROM honcho_user_addresses WHERE user_id = $userid AND type =2";
        $physaddrobj = $this->model->query($physaddrsql,'object');
        $physaddrid  = $physaddrobj[0]->id;       
        
        $physaddrdata = $this->model->get_one_where('id', $physaddrid, CCMPS_ADDR_TABLE);
//echo(659);
//json($physaddrdata); die();

/*    address is not mandatory
    if($mailaddrdata == false){
        echo('Error users776: ');
        echo('No mailing address data found ');
        echo('<br>');
        print_r(CCMPS_ADDR_TABLE); 
        die(); //    
        
    }

    if($physaddrdata == false){
        echo('Error users783: ');
        echo('No physical address data found ');
        echo('<br>');
        print_r(CCMPS_ADDR_TABLE); 
        die(); //    
        
    }
*/
    
    
// Need to translate DB fips value to 2 letter state code for display
// get the fips code
// echo(637);  
// json($mailaddrdata); die();
 
if($mailaddrdata != false){
$mailaddrdata->mailstatefips = $mailaddrdata->state; // raw codes for dropdown
$mailaddrdata->mailcntyfips  = $mailaddrdata->county; // raw codes for dropdown
$mailaddrdata->mailcntrycode = $mailaddrdata->country; // raw codes for dropdown
}
    
if($physaddrdata != false){
$physaddrdata->physstatefips = $physaddrdata->state; // raw codes for dropdown
$physaddrdata->physcntyfips  = $physaddrdata->county; // raw codes for dropdown
$physaddrdata->physcntrycode = $physaddrdata->country; // raw codes for dropdown
}

/*
echo(701);
echo('<br>');
print_r($mailaddrdata->mailstatefips);
echo('<br>');
print_r($mailaddrdata->mailcntyfips);
echo('<br>');
print_r($mailaddrdata->mailcntrycode);
echo('<br>');
print_r($physaddrdata->physstatefips);
echo('<br>');
print_r($physaddrdata->physcntyfips);
echo('<br>');
print_r($physaddrdata->physcntrycode);die();
*/
 
// So nothing found will either return blank or false
// isset will return true if false so use != false for that check
// isset returns false on a blank which is what $mailaddrdata->mailstatefips is
// if there is not mailling address. If blank if(strlen($mailaddrdata->mailstatefips) > 0
// will return a 500 error.

 if(isset($mailaddrdata->mailstatefips)){ 
 //  if(strlen($mailaddrdata->mailstatefips) > 0){ 
  
   // translate fips code to 2-letter code for display
   // need id to set dropdown when editing
   // $stateobj = $this->model->get_one_where('fips',$mailstate,'ref_states');
    $stateobj = $this->model->get_where_custom('fips', $mailaddrdata->mailstatefips,'=', 'id', 'ref_states');  
//echo(660);
//json($stateobj); die();
    $mailaddrdata->state = $stateobj[0]->state_code;

// print_r( $mailaddrdata->state); die();
  // }else{ if there is an address then there should be a state because dropdown now
      
  //   $mailaddrdata->state = 'NA'; 
  // }

    // if there is an address then there should be a country because dropdown now
  // if(strlen($mailaddrdata->country) > 0){ 
    // 
       
       
  // }else{
    // $mailaddrdata->country = 'UNK'; 
  // }   
  
// put the result into the data array
$user_data->mailaddrdata = $mailaddrdata;
 }

//  echo(752); die();
  
// Now physical address

// So nothing found will either return blank or false
// isset will return true if false so use != false for that check
// isset returns false on a blank which is what $mailaddrdata->mailstatefips is
// if there is not mailling address. If blank if(strlen($physaddrdata->physstatefips) > 0
// will return a 500 error.

 if(isset($physaddrdata->physstatefips)){ 
  
   // translate fips code to 2-letter code for display
   // need id to set dropdown when editing
    $stateobj = $this->model->get_where_custom('fips', $physaddrdata->physstatefips,'=', 'id', 'ref_states');  
//echo(660);
//json($stateobj); die();
    $physaddrdata->state = $stateobj[0]->state_code;  
   
$user_data->physaddrdata = $physaddrdata;
 }  
 //echo(734); die();

// Need to translate DB county fips value to title for display
// get the fips code
   $mailcntyfips = $mailaddrdata->county;
//echo(739);
//print_r($mailcntyfips); die();

   if(isset($mailcntyfips)){ // can use isset because it will be blank if no address
    // translate fips code to 2-letter code for display
    // need id to set dropdown when editing - the id is order by parameter
    $countyobj = $this->model->get_where_custom('fips', $mailcntyfips,'=', 'id', 'ref_counties');   
 //echo(718);
 //json($countyobj); die();
    $mailaddrdata->county= $countyobj[0]->title;
//echo(721);
//print_r( $mailaddrdata->county); die();
  // }else{ dropdown so never blank
  //   $mailaddrdata->county = 'UNK';
    // update te data array for county
    $user_data->mailaddrdata = $mailaddrdata;  
   }
   
   // Need to translate DB county fips value to title for display
// get the fips code
   $physcntyfips = $physaddrdata->county;
//echo(759);
//print_r($physcntyfips); die();

   if(isset($physcntyfips)){ // can use isset because it will be blank if no address
    // translate fips code to 2-letter code for display
    // need id to set dropdown when editing - the id is order by parameter
    $countyobj = $this->model->get_where_custom('fips', $physcntyfips,'=', 'id', 'ref_counties');   
 //echo(765);
 //json($countyobj); die();
    $physaddrdata->county= $countyobj[0]->title;
    
        // update te data array for county
        $user_data->physaddrdata = $physaddrdata;
   }
   
// checkpoint
/*
  echo(816);
  echo('<br>');
  echo('$user_data');
  echo('<br>');
  json($user_data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  die();
*/ 
        return $user_data; // returns to 500, 1993
  }
  
/*----------------------------------------------------------------------------*/  
/*--------------------  function end _get_a_single_record --------------------*/
/*----------------------------------------------------------------------------*/
  
/*----------------------------------------------------------------------------*/
/* ---------------------------  function VIEWRECORD --------------------------- */
/*----------------------------------------------------------------------------*/
    
function viewrecord($recid = NULL){ // chaper admin on computer viewing user - passes recid after an update to return to view the changes

$_SESSION['actionmode'] = 'viewuser';
$usrfuncid = 6; 
$authorized = $this->_check_function_permissions($usrfuncid);
//echo(843); die();
    //get login screen if not logged in. However if logged in can pass a recid in url and see someone elses
    // record and change it

//    $usersfunction = 'viewuser';
//    $authorized = $this->_check_function_permissions($usersfunction, $recid); 

if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('honcho/logout'); // clears everything then takes to login page
}

//print_r($recid);

  $vbe = segment(5); // viewing before editing
//print_r($vbe); die();
  if($vbe == 'vbe'){ // if you are viewing before editing
    $_SESSION['user_active_window'] = segment(4);
    $vbe = ''; // reset

  } // else viewing after editing so want to return to tab just edited so dont change value of tab #
// print_r($_SESSION['user_active_window']); die();

 /*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();

  $data   = $this->_get_a_single_record($recid); // anchor1 - returns array
//echo(952); die();
  $data   = $this->_convert_to_user_friendly($data); // anchor 3
//echo(954); die();

  $data->recid         = $recid;
  $data->view_module   = 'honcho/users';
  $data->view_file     = 'usercrud'; // use all-in-one crud form for viewing
 //print_r($data->recid); die();
 

//echo(883);
//echo('<br>');
//json($data); die();
 

  
 switch($_SESSION['managemode']) { // 

  case 'mngallusers': // 

        $data->bc1 = HONCHOUSER.' Admin';
        $data->bc2 = 'View '.HONCHOUSER;

  break;

  case 'momv': // 

        $data->bc1 = SUBENTITY.' Admin';
        $data->bc2 = 'View '.HONCHOUSER;

  break;

}


if($_SESSION['user_active_window'] > 0) { // if it was set to something by another operation leave alone

}else{
       $_SESSION['user_active_window'] = 1; // start with all user profile collapse open
}

// checkpoint
/*
  echo(916);
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  die();
 */

$data = (array)$data; // convert to array to add data
    $this->templates->inspinia($data);
}
/*----------------------------------------------------------------------------*/
/* ----------------------------  END VIEWRECORD ------------------------------- */
/*----------------------------------------------------------------------------*/




    
/*----------------------------------------------------------------------------*/
/*---------------- function _ADDR_SIMPLE_FETCH_DATA_FROM_POST ----------------*/
/*----------------------------------------------------------------------------*/
    
  function _addr_simple_fetch_data_from_post($mailrecid,$physrecid) {
    // private function protected - 404 error
//echo(5798);
//json($_POST); die();

    // CCMPS Address Table

    $data['mailaddress1']      = post('mailaddr1', true);
    $data['mailaddress2']      = post('mailaddr2', true);
    $data['mailcity']          = post('mailcity', true);
    $data['mailstate']         = post('mailstate', true);
    $data['mailzip']           = post('mailzip', true);
  //  $atdata['mailcountry']       = post('mailcountry', true);

    $data['physaddress1']      = post('physicaladdr1', true);
    $data['physaddress2']      = post('physicaladdr2', true);
    $data['physcity']          = post('physicalcity', true);
    $data['physstate']         = post('physstate', true);

    $data['physzip']           = post('physicalzip', true);
  //  $atdata['physcountry']       = post('physcountry', true);

// evaluate mailphys - if yes then reset physaddresses to equal mailaddresses 
    $data['mail_eq_phys']         = post('sameasmailing', true);
 
    if($data['mail_eq_phys'] == 1){
      $data['mail_eq_phys'] = 1;
 
      $data['physaddress1']      =     $data['mailaddress1']; 
      $data['physaddress2']      =     $data['mailaddress2'];  
      $data['physcity']          =     $data['mailcity']; 
      $data['physstate']         =     $data['mailstate']; 
      $data['physzip']           =     $data['mailzip']; 

    }else{
      $data['mail_eq_phys'] = 0;

    } 
  
    return $data;

    }
  

// -------------------------------------------------------------------------- //
// ---------------------------- function BULKACTION ------------------------- //
// -------------------------------------------------------------------------- //

  function bulkaction() {
  $usersfunction = 'bulkaction';
  $authorized = $this->_check_function_permissions($usersfunction); 
 //       print_r($_SESSION); die();
/*       
echo(155);
print_r($_POST); // array of ids called id
print_r($_POST['selected']); die(); // the dropdown item id
*/          
        $data = $_POST; // array of record ids called id & the dropdown item id
        
        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action
              
                if(!isset($data)){
                    die('Nothing Checked');
                }else{
 // print_r($data); die('SomethingChecked but no action chosen');
                }     
        break;
        
         case '2': // Make Current  
                if(!isset($data)){
                   die('Nothing Checked');
                }else{
//print_r($data);                 
//print_r($data['id']) ; die('make current');                  
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $mcid           = $row; // got the row number
                            $currentyear = $_SESSION['users_current_year'] ;

    if($currentyear < 2023){
        $currentyear = 2023;
  //  echo(187); die();
        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-bulkaction-110';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: users';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['usermode'];
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    }

                            $mcdata['current_year'] = $currentyear ;                           
//print_r($mcid );  
//print_r($mcdata); die();
                            $this->model->update($mcid, $mcdata, 'honcho_user_accounts');
                            $recalc = $this->recalcstatus($mcid);// nothing done with recalc, just trigger.
 
                 //           print_r('user line 214 made current all'); die(); 
                        }else{
                            echo('Line 216 users - row IS BLANK'); die();
                        }                 
                    } // end foreach
                }      
        break;
        
         case '3': // Create Acct 

       //  print_r($data); die();        
                if(!isset($data)){ // ignored because [selected] = 3 in array
                    die('Nothing Checked');
                
                }else{

       
        foreach($data['id'] as $row){
        
        $recid = $row;
        $usrobj = $this->model->get_one_where('id', $recid,'honcho_user_accounts');   

        $chptnum = $usrobj->subentity;                   
        $subentityobj = $this->model->get_one_where('id', $chptnum,'users_subentities');
//echo(107);
//print_r($recid); die(); 
//print_r($chptnum); die(); 

        
        // for trongate_users table
        // $data['user_level_id']  = DEFAULT_CCMP_USER_LEVEL;

        
        // loop through with user record id
        // get email address and assign to username      

        $emailaddr = $usrobj->email_address;
        $username  = $usrobj->username;
        
        if(strlen($username) > 0){
            // username & therefore an account already exists so skip adding
           // echo(136);
           //     print_r($username); die();
        }else{
            if(strlen($emailaddr) > 0){ // if email exists
                 $datac['username'] = $emailaddr;
            }else{
                // if no email set username to random 6 alphanumeric string
                $token_length = 5;
                $characters = '23456789abcdefghjkmnpqrstuvwxyz';
                $random_code = '';
                for ($i = 0; $i < $token_length; $i++) {
                    $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
                }
                $datac['username'] = 'temp-'.$random_string;
            }

                // for users table
                $datac['password']       = DEFAULT_CCMP_PASSWORD;
              //  $data['subentity']        = $subentityobj->id; // dropdown not shown for new records
                $datac['force_pw_chg']   = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0

            // save new record to trongate users and get trongate_user_id for users table
                $usrlvl['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
                $usrlvl['user_acct_info_table'] = 'honcho_user_accounts';
                $usrlvl['code'] = $this->_generate_rand_code();
    //echo(155);          
    //print_r($usrlvl); die();               
                $this->model->insert($usrlvl, 'trongate_users');
                $datac['trongate_user_id']  = $this->model->get_max('trongate_users');

                // Save user acct data to users
                $this->model->update($recid, $datac, 'honcho_user_accounts');

        } // end if username exists
   // print_r($recid);
   // print_r($datac); die();
  
  //print_r($data); die('Create Acct');
                }
                
        } // end foreach
        
        break;
 
         case '4': // Lock Acct   - not implemented        
                if(!isset($data)){
                    die('Nothing Checked');
                }else{
 // print_r($data); die('Lock Acct');
                }     
        break;

         case '5': // Unlock Acct - not implemented             
                if(!isset($data)){
                    die('Nothing Checked');
                }else{
 // print_r($data); die('Unlock Acct');
                }     
        break;
        
         case '6':        
                if(!isset($data)){
                   die('Nothing Checked');
                }else{
 // print_r($data); die('Approve Account');
                }       
               
        break;
        
         case '7': 
                if(!isset($data)){
                   die('Nothing Checked');
                }else{
 // print_r($data); die('Approve Member');
                }                    
        break;
        
         case '8':           
                if(!isset($data)){
                   die('Nothing Checked');
                }else{
 //  print_r($data);                 
  //print_r($data['id']) ; die('Delete');                  
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number
                            $deldata['soft_deleted'] = 1;
                        //    unset($data['selected']); // not in DB throws error
                        //    unset($data['id']); // no value, it was value of
                        //                        // selected item in dropdown 1-8
                        //    unset($data); // removes [DataTables_Table_0_length] => 25 
                            $data['soft_deleted'] = 1;                           
//print_r($delid );  
//print_r($deldata); die();
                            $this->model->update($delid, $deldata, 'honcho_user_accounts');
                            //print_r('deleted all'); die(); 
                        }else{
                            echo('Line 141 users - row IS BLANK'); die();
                        }                 
                    } // end foreach
                } 
       
        break;
        
         case '9':
                if(!isset($data)){
                   die('Nothing Checked');
                }else{
 // print_r($data); die('Archive');
                }       
               
        break;
        
        }
        
        switch($_SESSION['usermode']) {

          case 'momm': // managing your subentity records
                redirect('honcho-users/manage/momm');

          break;

                case 'mosm': // managing our subentity student members - used for student members only (S or Q)
                redirect('honcho-users/manage/mosm');

          break;
      
          case 'mcmm': // managing current members - used for student members only (S or Q)
                redirect('honcho-users/manage/mcmm');

          break;

          case 'mngallusers': // managing all members
                redirect('honcho-users/manage/mngallusers');

          break;

          case 'momv': // managing your subentity records
                redirect('honcho-users/manage/momm');

          break;

          case 'mosv': // managing our current subentity student members - used for student members only
                redirect('honcho-users/manage/mosm');

          break;
      
          case 'mcmv': // managing current members - used for student members only
                redirect('honcho-users/manage/mcmm');

          break;

          case 'mamv': // managing all members
                redirect('honcho-users/manage/mngallusers');

          break;
        }        

  }
// ---------------------------- end bulkaction  ----------------------------- // 
  
// -------------------------------------------------------------------------- //
// ----------------------------- function FONTSIZE -------------------------- //
// -------------------------------------------------------------------------- //
  
  function fontsize() {  // call by ajax function in template inspinia.php
  // navbar.php calls ajax in inspinia.php
//*----------------- Get logged in user's info & preferences ----------------*/
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
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 0;
    $fs = 2; // default to medium if no value
}

if($fs == 1){  // override tabs choice and make horz if large font
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 1;
}else{
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 0;

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
echo(4355); die();      
  $this->_get_font_sizes();
//  redirect('');
  }

// ------------------------------- end FONTSIZE ----------------------------- //


/*----------------------------------------------------------------------------*/
/*------------------------------- Reports ------------------------------------*/
/*----------------------------------------------------------------------------*/
// ******************  function SPREADSHEET_FORMAT_DOWNOAD ****************** //  
    
  function spreadsheet_format_download() {
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="hello_world.xlsx"');

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1','Col Header 1'); 
      $sheet->setCellValue('B1','Col Header 2'); 
      $sheet->setCellValue('C1','Col Header 3'); 
      $sheet->setCellValue('D1','Col Header 4'); 

      $writer = new Xlsx($spreadsheet);
      $writer->save("php://output");
  }


  // ****************************  function EXPORT ************************** //
  
    function export() { // Master Spreadsheet Format
    $usersfunction = 'export';
    $authorized = $this->_check_function_permissions($usersfunction); 

        //*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
    $scope    = segment(3); 
    $subentity = $_SESSION['subentity'];
//print_r($scope); die();
//print_r($subentity); die();
if($scope == 'subentity'){
        // query for subentity records
    $sql = "SELECT * FROM honcho_user_accounts WHERE subentity = $subentity";
    $data = $this->model->query($sql,'object'); 

//json($data); die();
}else{
    // query for all records - (syntax: 'order_by', 'table', limit, offset)
    $data = $this->model->get('subentity','honcho_user_accounts'); //

}

    // convert the object to an array to add additional data for the view 
  //  $data = (array)$data;
 //json($data); die();
    foreach($data as $row) { // step through the array of records and pull out needed values

      $userrecid = $row->id;
//print_r($userrecid); die();
      $addrobj   = $this->model->get_one_where('user_id',$userrecid,'users_addresses');
 // json($addrobj); die();
      $row->mailaddress1 = $addrobj->mailaddress1;
      $row->mailaddress2 = $addrobj->mailaddress2;
      $row->mailcity     = $addrobj->mailcity;
      $row->mailstate    = $addrobj->mailstate;
      $row->mailzip      = $addrobj->mailzip;
      $row->mailcountry  = $addrobj->mailcountry;
      $row->physaddress1 = $addrobj->physaddress1;
      $row->physaddress2 = $addrobj->physaddress2;
      $row->physcity     = $addrobj->physcity;
      $row->physstate    = $addrobj->physstate;
      $row->physzip      = $addrobj->physzip;
      $row->physcountry  = $addrobj->physcountry;
 //     print_r($userrecid); die();

      // dont need any financial data for Master Spreadsheet
      //$finobj   = $this->model->get_one_where('user_id',$userrecid,'users_financial');
      //print_r($finobj); die();

  }

// dont add this before you do the loop above or it will fail when trying to loop through these non-user entries


 //    json($data); die();


      foreach($data as $row) { // step through the array of records and pull out needed values
    
          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/ 

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
          $levelname = $levelobj->level_title;  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $natofficeid        = $row->national_officer;
          $natofficeobj       = $this->model->get_where($natofficeid,'ref_national_offices');
          $row->national_officer = $natofficeobj->description;


          $memtypeid        = $row->id_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
          $row->id_type = $memtypeobj->id_type;

          $actypeid           = $row->aircraft_type;
          $actypeobj          = $this->model->get_where($actypeid,'aircraft_types');
          $row->aircraft_type = $actypeobj->name;

          $subentityid    = $row->subentity;
          $subentityobj   = $this->model->get_where($subentityid,'users_subentities');
          $row->subentity = $subentityobj->description;

          $subentityroleid     = $row->subentity_role;
          $subentityroleobj    = $this->model->get_where($subentityroleid,'users_subentity_offices');
          $row->subentity_role = $subentityroleobj->description;

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'users_certificate_types');
          $row->highest_certificate = $highcertobj->description;

          $fintypeid          = $row->fin_acct_type;
          $fintypeobj         = $this->model->get_where($fintypeid ,'users_financial_types');
          $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          $finstatusid     = $row->fin_status;
          $finstatusobj    = $this->model->get_where($finstatusid,'users_financial_statuses');
          $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/
          
          if($row->student_admin == 1) { 
               $row->student_admin = 'TRUE';
          }else{ 
               $row->student_admin = 'FALSE';
          }
          
          if($row->cms_admin == 1) { 
               $row->cms_admin = 'TRUE';
          }else{ 
               $row->cms_admin = 'FALSE';
          }

          if($row->subentity_admin == 1) { 
               $row->subentity_admin = 'TRUE';
          }else{ 
               $row->subentity_admin = 'FALSE';
          }

          if($row->admin == 1) { 
               $row->admin = 'TRUE';
          }else{ 
               $row->admin = 'FALSE';
          }

                    
          if($row->system_admin == 1) { 
               $row->system_admin = 'TRUE';
          }else{ 
               $row->system_admin = 'FALSE';
          }
          
          if($row->eligible_voter == 1) { 
               $row->eligible_voter = 'TRUE';
          }else{ 
               $row->eligible_voter = 'FALSE';
          }

          if($row->emailoptout == 1) { 
               $row->emailoptout = 'TRUE';
          }else{ 
               $row->emailoptout = 'FALSE';
          }

          if($row->directoryoptout == 1) { 
               $row->directoryoptout = 'TRUE';
          }else{ 
               $row->directoryoptout = 'FALSE';
          }

          if($row->dontcall == 1) { 
               $row->donotcall = 'TRUE';
          }else{ 
               $row->donotcall = 'FALSE';
          }

          if($row->mail_notices == 1) { 
               $row->mail_notices = 'TRUE';
          }else{ 
               $row->mail_notices = 'FALSE';
          }

          if($row->deceased == 1) { 
               $row->deceased = 'TRUE';
          }else{ 
               $row->deceased = 'FALSE';
          }

          if($row->no_address == 1) { 
               $row->no_address = 'TRUE';
          }else{ 
               $row->no_address = 'FALSE';
          }

          if($row->special_event == 1) { 
               $row->special_event = 'TRUE';
          }else{ 
               $row->special_event = 'FALSE';
          }

          if($row->mail_notices == 1) { 
               $row->mail_notices = 'TRUE';
          }else{ 
               $row->mail_notices = 'FALSE';
          }

          if($row->aircraft_owner == 1) { 
               $row->aircraft_owner = 'TRUE';
          }else{ 
               $row->aircraft_owner = 'FALSE';
          }


          if($row->hall_of_fame == 1) { 
               $row->hall_of_fame = 'TRUE';
          }else{ 
               $row->hall_of_fame = 'FALSE';
          }

          if($row->alumnus == 1) { 
               $row->alumnus = 'TRUE';
          }else{ 
               $row->alumnus = 'FALSE';
          }
          
          if($row->active_duty == 1) { 
               $row->active_duty = 'TRUE';
          }else{ 
               $row->active_duty = 'FALSE';
          }

          if($row->former_military == 1) { 
               $row->former_military = 'TRUE';
          }else{ 
               $row->former_military = 'FALSE';
          }

          if($row->military_pilot == 1) { 
               $row->military_pilot = 'TRUE';
          }else{ 
               $row->military_pilot = 'FALSE';
          }

          if($row->vip == 1) { 
               $row->vip = 'TRUE';
          }else{ 
               $row->vip = 'FALSE';
          }

          if($row->student == 1) { 
               $row->student = 'TRUE';
          }else{ 
               $row->student = 'FALSE';
          }

          if($row->minor == 1) { 
               $row->minor = 'TRUE';
          }else{ 
               $row->minor = 'FALSE';
          }

          if($row->private == 1) { 
               $row->private = 'TRUE';
          }else{ 
               $row->private = 'FALSE';
          }


          if($row->commercial == 1) { 
               $row->commercial = 'TRUE';
          }else{ 
               $row->commercial = 'FALSE';
          }

          if($row->atp == 1) { 
               $row->atp = 'TRUE';
          }else{ 
               $row->atp = 'FALSE';
          } 

          if($row->drone == 1) { 
               $row->drone = 'TRUE';
          }else{ 
               $row->drone = 'FALSE';
          }

          if($row->ap == 1) { 
               $row->ap = 'TRUE';
          }else{ 
               $row->ap = 'FALSE';
          }

          if($row->ia == 1) { 
               $row->ia = 'TRUE';
          }else{ 
               $row->ia = 'FALSE';
          }

          if($row->military_maint == 1) { 
               $row->military_maint = 'TRUE';
          }else{ 
               $row->military_maint = 'FALSE';
          }

          if($row->maintenance == 1) { 
               $row->maintenance = 'TRUE';
          }else{ 
               $row->maintenance = 'FALSE';
          }

          if($row->atc == 1) { 
               $row->atc = 'TRUE';
          }else{ 
               $row->atc = 'FALSE';
          }

          if($row->dispatcher == 1) { 
               $row->dispatcher = 'TRUE';
          }else{ 
               $row->dispatcher = 'FALSE';
          }

          if($row->se_land == 1) { 
               $row->se_land = 'TRUE';
          }else{ 
               $row->se_land = 'FALSE';
          }

          if($row->me_land == 1) { 
               $row->me_land = 'TRUE';
          }else{ 
               $row->me_land = 'FALSE';
          }

          if($row->se_sea == 1) { 
               $row->se_sea = 'TRUE';
          }else{ 
               $row->se_sea = 'FALSE';
          }

          if($row->me_sea == 1) { 
               $row->me_sea = 'TRUE';
          }else{ 
               $row->me_sea = 'FALSE';
          } 

          if($row->instrument == 1) { 
               $row->instrument = 'TRUE';
          }else{ 
               $row->instrument = 'FALSE';
          }

          if($row->cfi == 1) { 
               $row->cfi = 'TRUE';
          }else{ 
               $row->cfi = 'FALSE';
          }

          if($row->cfii == 1) { 
               $row->cfii = 'TRUE';
          }else{ 
               $row->cfii = 'FALSE';
          }

          if($row->mei == 1) { 
               $row->mei = 'TRUE';
          }else{ 
               $row->mei = 'FALSE';
          } 

          if($row->dpe == 1) { 
               $row->dpe = 'TRUE';
          }else{ 
               $row->dpe = 'FALSE';
          }

          if($row->bgi == 1) { 
               $row->bgi = 'TRUE';
          }else{ 
               $row->bgi = 'FALSE';
          }

          if($row->agi == 1) { 
               $row->agi = 'TRUE';
          }else{ 
               $row->agi = 'FALSE';
          }

          if($row->rotocraft == 1) { 
               $row->rotocraft = 'TRUE';
          }else{ 
               $row->rotocraft = 'FALSE';
          }

          if($row->glider == 1) { 
               $row->glider = 'TRUE';
          }else{ 
               $row->glider = 'FALSE';
          }

          if($row->balloon == 1) { 
               $row->balloon = 'TRUE';
          }else{ 
               $row->balloon = 'FALSE';
          }

          if($row->airship == 1) { 
               $row->airship = 'TRUE';
          }else{ 
               $row->airship = 'FALSE';
          }      

          if($row->mail_notices == 1) { 
               $row->mail_notices = 'TRUE';
          }else{ 
               $row->mail_notices = 'FALSE';
          }   


} // end foreach

        // Add these elements to properly draw the screen

if($scope == 'subentity'){
    $data['bc1'] = CCMPSSUBENTITY.' Admin';
    $data['bc2'] = CCMPSSUBENTITY.' Spreadsheet';

    $data['h1']         = 'Export '.CCMPSSUBENTITY.' Spreadsheet';
    $data['h2']         = CCMPSSUBENTITY.' Administrator';
    $data['tablabel']   = 'All '.CCMPSSUBENTITY.' '.CCMP.' Records';
    $data['panellabel'] = CCMPSSUBENTITY.' '.CCMPS.' Master Sheet';
//json($data); die();
}else{
    $data['bc1'] = CCMP.' Admin';
    $data['bc2'] = 'Master Spreadsheet';

    $data['h1']         = 'Export Master Spreadsheet';
    $data['h2']         = 'Member Administrator';
    $data['tablabel']   = 'All '.CCMP.' Records';
    $data['panellabel'] = CCMP.' Master Sheet';

}

    //   $data['subentity_name']  = $subentity_name;
      $data['view_module']   = 'honcho/users';
      $data['view_file']     = 'export'; // read only roster

//     json($data); die();
      $this->templates->inspinia($data);                 
    
    }
    


/*----------------------------------------------------------------------------*/
/*-------------------------------- Common Utility Functions ------------------*/
/*----------------------------------------------------------------------------*/



// -------------------------------------------------------------------------- //
// -------------- function _CONVERT_NULL_INTEGERS_TO_ZEROS ------------------ //
// -------------------------------------------------------------------------- //

function _convert_null_integers_to_zeros($data){ // anchor4

// if any of these iteger valueswere null on the save it would cause an error.
    // could check each one and set to a value and log the error
 /*   
    "status": 2,
    "approved": 1,
    "email_verified": 1,
    "locked": 0,
    "inactive": 0,
    "language": 1,
    "id_type": 1,
    "minor": 0,
    "subentity": 2,
    "subentity_role": 1,
    "cms_admin": 1,
    "student_admin": 1,
    "subentity_admin": 1,
    "admin": 1,
    "system_admin": 1,
    "national_officer": 10,
    "eligible_voter": 0,
    "gender": 1,
    "dob": 0,
    "use_alt_contact": 0,
    "alumnus": 1,
    "active_duty": 1,
    "former_military": 0,
    "student": 0,
    "region": 1,
    "emailoptout": 0,
    "directoryoptout": 0,
    "limit_dir_info": 0,
    "mail_notices": 0,
    "mail_eq_phys": 0,
    "bill_eq_ship": 0,
    "deceased": 0,
    "vip": 0,
    "leadsource": 0,
    "date_created": 0,
    "num_logins": 0,
    "last_login_device": 1,
    "force_pw_chg": 0,
    "timed_reset": 0,
    "reset_interval": 0,
    "soft_deleted": 0,
    "created_by": 0,
    "created_at": 0,
    "updated_by": 3,
    "updated_at": 1705322307,
    "tguserlevel": 7,
            
if($data['eligible_voter'] !=1) { 
  $data['eligible_voter'] = 0;
}

if($data['student_admin'] != 1) { 
  $data['student_admin'] = 0;
}

if($data['cms_admin'] != 1) { 
  $data['cms_admin'] = 0;
}

if($data['subentity_admin'] != 1) { 
  $data['subentity_admin'] = 0;
}

if($data['admin'] != 1) { 
  $data['admin'] = 0;
}

if($data['system_admin'] != 1) { 
  $data['system_admin'] = 0;
}

if($data['emailoptout'] !=1) { 
  $data['emailoptout'] = 0;
}

if($data['directoryoptout'] !=1) { 
  $data['directoryoptout'] = 0;
}

if($data['donotcall'] !=1) { 
  $data['donotcall'] = 0;
}

if($data['mail_notices'] !=1) { 
  $data['mail_notices'] = 0;
}

if($data['deceased'] !=1) { 
  $data['deceased'] = 0;
}

if($data['alumnus'] !=1) { 
  $data['alumnus'] = 0;
}

if($data['active_duty'] !=1) { 
  $data['active_duty'] = 0;
}

if($data['former_military'] !=1) { 
  $data['former_military'] = 0;
}

if($data['vip'] !=1) { 
  $data['vip'] = 0;
}

  if($data['student'] !=1) { 
    $data['student'] = 0;
  }

if($data['minor'] !=1) { 
  $data['minor'] = 0;
}
*/
  return $data;

} //end function

// ------------------ end _CONVERT_NULL_INTEGERS_TO_ZEROS ------------------- //


// -------------------------------------------------------------------------- //
// ------------------- function _CONVERT_TO_USER_FRIEDLY -------------------- //
// -------------------------------------------------------------------------- //
  
function _convert_to_user_friendly($data){ // anchor3 - called at 505
// invoked right after get a single record if it was invoked to view a record

/*

Code to Value
// Core

status
id_type
subentity
subentity_role
region 
gender
national_officer
language
leadsource
created_by
updated_by 
levelid - already converted elsewhere & levelname created
 
Yes/No 

cms_admin
student_admin
subentity_admin
admin
system_admin
student
minor
eligible_voter
emailoptout
directoryoptout
donotcall
mail_notices
deceased
use_alt_contact
mail_eq_phys
bill_eq_ship
alumnus
active_duty
former_military
vip
limit_dir_info
force_pw_chg
timed_reset
soft_deleted
 
Dates
 * dob
created_at
updated_at
last_login_raw
last_logout_raw
date_created_raw
updated_at_raw
created_at_raw
tokenexpires_raw": null,
updated_by_raw
created_by_raw
 
    "mailaddrdata": {
        "id": 1,
        "code": null,
        "user_id": 1,
        "type": 1,
        "address1": "714 Swan Creek Road",
        "address2": "ma2 multi",
        "city": "Fort Washington",
        "state": "MD",
        "zip": "00121",
        "county": "Prince George",
        "country": "USA",
        "begin_date": 0,
        "end_date": 0,
        "mailstatefips": 24,
        "mailcntyfips": "24033",
        "mailcntrycode": "USA"
    },
    "physaddrdata": {
        "id": 2,
        "code": null,
        "user_id": 1,
        "type": 2,
        "address1": "physa1 multi",
        "address2": "pa2 multi",
        "city": "pamulti",
        "state": "MD",
        "zip": "20015",
        "county": "Prince George",
        "country": "USA",
        "begin_date": 0,
        "end_date": 0,
        "physstatefips": 24,
        "physcntyfips": "24033",
 */ 
//echo (3546);
//json($data); die();     
    // Change codes to names

    $statusid           = $data->status;
    $statusobj          = $this->model->get_where($statusid,'honcho_user_status');
    $data->status     = $statusobj->title;

    $memtypeid          = $data->id_type;
    $memtypeobj         = $this->model->get_where($memtypeid,'honcho_user_types');
    $data->id_type    = $memtypeobj->description;

    $subentityid        = $data->honcho_subentity;
    $subentityobj       = $this->model->get_where($subentityid,'honcho_user_subentities');
    $data->subentity  = $subentityobj->description;
 
    $subentityrole      = $data->subentity_role;
    $subentityroleobj   = $this->model->get_where($subentityrole,'honcho_user_subentity_offices');
    $data->subentity_role = $subentityroleobj->description;

    $regionid           = $subentityobj->region;
        if(strlen($regionid) > 0){  // check if null
    $regionobj          = $this->model->get_where($regionid,'ref_region_codes');
    $data->region     = $regionobj->description;
    }else{
        $data->region = 'NA';
        }
//echo(3552);
//print_r($data->region); die();
        
    $genderid           = $data->gender;     
    $gendertypeobj      = $this->model->get_where($genderid,'ref_genders');
    $data->gender     = $gendertypeobj->description; // for view file
   
    $natofficeid        = $data->national_officer;
    $natofficeobj       = $this->model->get_where($natofficeid,'ref_national_offices');
    $data->national_officer = $natofficeobj->description;
 
    $languageid         = $data->language;
    $languageobj        = $this->model->get_where($languageid,'ref_languages');
    $data->language   = $languageobj->description; // or title if want native language like "Espanol"

    //Save the raw codes for exports, etc.

    $updated_by_raw = $data->updated_by;
    $created_by_raw = $data->created_by;
       
    $createdbyid        = $data->created_by;   
    if($createdbyid  == 0){
      $data->created_by = "Sysadmin";
      $createdbyid = 1;
    }else{  
         
      $createdbyobj       = $this->model->get_where_custom('trongate_user_id', $createdbyid ,'=', 'id', 'honcho_user_accounts');  
      $data->created_by = $createdbyobj[0]->last_name;
    } 
 // print_r($data->created_by); die(); 
 
    $updatedbyid        = $data->updated_by;   
    if($updatedbyid  == 0){
      $data->updated_by = "Sysadmin";
      $updatedbyid  = 1;
    }else{
     
      $updatedbyobj       = $this->model->get_where_custom('trongate_user_id', $updatedbyid ,'=', 'id', 'honcho_user_accounts');  
      $data->updated_by = $updatedbyobj[0]->last_name;
    } 
  
    if($data->leadsource > 0){
        $leadsourceid       = $data['leadsource'];
        $leadsourceobj      = $this->model->get_where($leadsourceid,'ref_leadsource');
        $data->leadsource = $leadsourceobj->description;
    }else{
       $data->leadsource = 'NA'; 
    }
//echo(3621); die();
    /*------------------- Convert the Codes to descriptions ----------------------*/
     
      if($data->last_login_device == 1){
      
          $data->last_login_device = 'Computer/Laptop';
      }else{
        
        if($data->last_login_device == 2){

          $data->last_login_device = 'Phone';

          }else{
             $data->last_login_device = 'Never Logged In';
             $data->lastlogindevice = 1;
          }
      }
      
    /*------ Convert the Binary Yes/No fields ----------*/
 

    if($data->student_admin == 1) { 
      $data->student_admin = 'Yes';
    }else{ 
      $data->student_admin = 'No';
    }

    if($data->cms_admin == 1) { 
      $data->cms_admin = 'Yes';
    }else{ 
      $data->cms_admin = 'No';
    }

    if($data->subentity_admin == 1) { 
      $data->subentity_admin = 'Yes';
    }else{ 
      $data->subentity_admin = 'No';
    }
 
    if($data->admin == 1) { 
      $data->admin = 'Yes';
    }else{ 
      $data->admin = 'No';
    }

    if($data->system_admin == 1) { 
      $data->system_admin = 'Yes';
    }else{ 
      $data->system_admin = 'No';
    }
  
    if($data->student == 1) { 
      $data->student = 'Yes';
    }else{ 
      $data->student = 'No';
    }
    
    if($data->minor == 1) { 
      $data->minor = 'Yes';
    }else{ 
      $data->minor = 'No';
    }

    if($data->eligible_voter == 1) { 
      $data->eligible_voter = 'Yes';
    }else{ 
      $data->eligible_voter = 'No';
    }

    if($data->emailoptout == 1) { 
      $data->emailoptout = 'Yes';
    }else{ 
      $data->emailoptout = 'No';
    }

    if($data->directoryoptout == 1) { 
      $data->directoryoptout = 'Yes';
    }else{ 
      $data->directoryoptout = 'No';
    }

    if($data->donotcall == 1) { 
      $data->donotcall = 'Yes';
    }else{ 
      $data->donotcall = 'No';
    }

    if($data->mail_notices == 1) { 
      $data->mail_notices = 'Yes';
    }else{ 
      $data->mail_notices = 'No';
    }

    if($data->deceased == 1) { 
      $data->deceased = 'Yes';
    }else{ 
      $data->deceased = 'No';
    }

    if(  $data->use_alt_contact == 1) { 
        $data->use_alt_contact  = 'Yes';
    }else{ 
        $data->use_alt_contact  = 'No';
    }
    
    if(  $data->mail_eq_phys == 1) { 
        $data->mail_eq_phys  = 'Yes';
    }else{ 
        $data->mail_eq_phys  = 'No';
    }
    
    if(  $data->bill_eq_ship == 1) { 
        $data->bill_eq_ship  = 'Yes';
    }else{ 
        $data->bill_eq_ship  = 'No';
    }

    if($data->alumnus == 1) { 
      $data->alumnus = 'Yes';
    }else{ 
      $data->alumnus = 'No';
    }
    
    if($data->active_duty == 1) { 
      $data->active_duty = 'Yes';
    }else{ 
      $data->active_duty = 'No';
    }

    if($data->former_military == 1) { 
      $data->former_military = 'Yes';
    }else{ 
      $data->former_military = 'No';
    }

    if($data->vip == 1) { 
      $data->vip = 'Yes';
    }else{ 
      $data->vip = 'No';
    }

    if($data->limit_dir_info == 1) { 
      $data->limit_dir_info = 'Yes';
    }else{ 
      $data->limit_dir_info = 'No';
    }

   

    if($data->soft_deleted == 1) { 
      $data->soft_deleted = 'Yes';
    }else{ 
      $data->soft_deleted = 'No';
    }    
//
    
    if($data->approved == 1) { 
      $data->approved = 'Yes';
    }else{ 
      $data->approved = 'No';
    }
    
    if($data->email_verified == 1) { 
      $data->email_verified = 'Yes';
    }else{ 
      $data->email_verified = 'No';
    }    
    
    /*
    if($data->locked == 1) { 
      $data->locked = 'Yes';
    }else{ 
      $data->locked = 'No';
    }    
     
    if($data->inactive == 1) { 
      $data->inactive = 'Yes';
    }else{ 
      $data->inactive = 'No';
    }
   
    if($data->force_pw_chg == 1) { 
      $data->force_pw_chg = 'Yes';
    }else{ 
      $data->force_pw_chg = 'No';
    } 
    
     * 
    if($data->timed_reset == 1) { 
      $data->timed_reset = 'Yes';
    }else{ 
      $data->timed_reset = 'No';
    }    


    */
    /*
    
    if($data-> == 1) { 
      $data-> = 'Yes';
    }else{ 
      $data-> = 'No';
    }

    */
    
    /*------ Convert the integer Dates ----------*/
  

     // Save the raw Non-Translated dates for dropdowns, etc.
       $data->last_login_raw     = $last_login_raw;
       $data->last_logout_raw    = $last_logout_raw;
       $data->date_created_raw   = $date_created_raw;
       $data->updated_at_raw     = $updated_at_raw;
       $data->created_at_raw     = $created_at_raw;
       $data->updated_by_raw     = $updated_by_raw;
       $data->created_by_raw     = $created_by_raw;
          
    // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
    $format = 'datepicker_us'; // options: full, cool,shorter, mini, oldschool,datepicker,monyear
    $this->module('timedate');
/* 
echo(3843);
echo('<br>');
print_r($data->last_login);
echo('<br>');
print_r($data->last_logout); die();
*/
    
/*
dob
last_login
last_logout
date_created
updated_at
created_at
*/
    
    $data->dob          = $this->timedate->get_nice_date($data->dob, $format); 
    $data->last_login   = $this->timedate->get_nice_date($data->last_login, $format);   
    $data->last_logout  = $this->timedate->get_nice_date($data->last_logout,$format);
    $data->date_created = $this->timedate->get_nice_date($data->date_created, $format);
    $data->updated_at   = $this->timedate->get_nice_date($data->updated_at, $format);
    $data->created_at   = $this->timedate->get_nice_date($data->created_at, $format);
    
    $tokenobj = $this->model->get_where_custom('user_id', $data->trongate_user_id ,'=', 'id', 'trongate_tokens');  
 
    $tokenexpires = $tokenobj[0]->expiry_date;

    if(strlen($tokenexpires) > 0){
             $data->token_expires   = $tokenexpires; // translation on line 192
             $data->token_expires  = $this->timedate->get_nice_date($data->token_expires, $format); 
    }else{
             $data->token_expires   = 'No Token Found'; // translation on line 192
    }
//echo(3876);
//echo('<br>');
//print_r($data->token_expires); die();
   
     
/*------ Blank out the false 01/01/1970 date when 0 ----------*/

    
    if($data->dob == '01/01/1970'){

      $data->dob = ' ';
    }

    if($data->last_login == '01/01/1970'){

      $data->last_login = ' ';
    }
    
    if($data->last_logout == '01/01/1970'){

      $data->last_logout = ' ';
    }    
 
    if($data->date_created == '01/01/1970'){

      $data->date_created = ' ';
    }  
    
    if($data->updated_at == '01/01/1970'){

      $data->updated_at = ' ';
    }

    if($data->created_at == '01/01/1970'){

      $data->created_at = ' ';
    }
  
    if($data->token_expires == '01/01/1970'){

      $data->token_expires = ' ';
    }
  
/*        
echo(3940);
echo('<br>');
print_r($data->last_login);
echo('<br>');
print_r($data->last_logout); 
echo('<br>');
print_r($data->date_created);
echo('<br>');
print_r($data->updated_at);
echo('<br>');
print_r($data->created_at);
echo('<br>');
print_r($data->token_expires);
echo('<br>');
json($tokenobj);
echo('<br>');
json($data); die();
*/

    return $data; // returns to 519, 954

} // end function

// ---------------------- end _CONVERT_TO_USER_FRIEDLY ---------------------- //
  
// **********************  function _GENERATE_RAND_CODE ********************* //
     
    // generate a random 16 character code for unique ids
    function _generate_rand_code() {
  // protected - private function

      $token_length = 16;
      $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
      $random_code = '';
      for ($i = 0; $i < $token_length; $i++) {
          $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
      }
      $random_code = $random_string;
     // echo('Line 1117 Random PW ');
      //print_r($random_pw); die();

      return $random_code;
    }


// *************************  function _HASH_STRING ************************* //
  
    function _hash_string($str){

    //       echo('in hasher'); die();
   
           $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
               'cost' => 11 ));
   
           return $hashed_string;
       }

// ***********************  function _VERIFY_HASH *************************** //
       
    function _verify_hash($plain_text_str, $hashed_string){
   
           $result =  password_verify($plain_text_str, $hashed_string);
   
           return $result; // true or false
       }


// **************************  function DELRECORD *************************** //
    
    function delrecord() { // delete single record
     // 404 if not logged in. White page if you are but will lock if pass a recid
 //   $usersfunction = 'lockacct';
 //   $authorized = $this->_check_function_permissions($usersfunction); 

      $recid = segment(3);
   //   $frmpg = segment(4); // can lock and unlock from manage or view


 //     echo(5916);
 //     print_r($recid); die();
      $data['soft_deleted'] = 1;

      $this->model->update($recid, $data, 'honcho_user_accounts');

 //  echo(7664);
 //  print_r($_SESSION['actionmode']); die();   
        switch($_SESSION['actionmode']) {

          case 'viewlist': // managing all users
                redirect('honcho-users/manage/mngallusers');

          break;  

          case 'viewuser': // managing a user
                redirect('honcho-users/viewuser/'.$recid);

          break;


      }
       
    }

// **************************  function UNDELRECORD ************************* //
    
       function undelrecord() {
     // 404 if not logged in. White page if you are but will lock if pass a recid
 //   $usersfunction = 'lockacct';
 //   $authorized = $this->_check_function_permissions($usersfunction); 

      $recid = segment(3);
   //   $frmpg = segment(4); // can lock and unlock from manage or view


   //   echo(5916);
   //   print_r($frmpg); die();
      $data['soft_deleted'] = 0;

      $this->model->update($recid, $data, 'honcho_user_accounts');

 //  echo(7664);
 //  print_r($_SESSION['actionmode']); die();   
        switch($_SESSION['actionmode']) {

          case 'viewlist': // managing all users
                redirect('honcho-users/manage/mngallusers');

          break;  

          case 'viewuser': // managing a user
                redirect('honcho-users/viewuser/'.$recid);

          break;


      }
    }
    
// *************************  function REMOVERECORD ************************* //
    
    function removerecord() { // permanently removes record and user account
echo(8324);       
echo('Not implemented'); die();

$recid = $_POST['recid']; // posted from JS function using ajax
       // $recid = segment(3);

        $usrobj = $this->model->get_one_where('id', $recid, 'honcho_user_accounts'); 
        $removetgu = $usrobj->trongate_user_id;

        // run delete query on trongate_users table
        $removeusr = $this->model->delete($removetgu, 'trongate_users');

        // get id of financial child record to delete
        $finobj = $this->model->get_one_where('user_id', $recid, 'users_financial'); 
        $removeid = $finobj->id;

        // run delete query on financial table
        $removefin = $this->model->delete($removeid, 'users_financial'); 

        // get id of address child record to delete
        $adrobj = $this->model->get_one_where('user_id', $recid, 'users_addresses'); 
        $remvid = $adrobj->id;

        // run delete query on address table
        $removeaddr = $this->model->delete($remvid, 'users_addresses');

        // remove the parent record
        $removeuser = $this->model->delete($recid, 'honcho_user_accounts');  

        $flash_msg = 'The member was permanently deleted.';
        set_flashdata($flash_msg);

//echo(5178);
//print_r($removeid); die();
//echo('5173 add remove code'); die();

        switch($_SESSION['usermode']) {

          case 'momm': // managing your subentity records
                redirect('honcho-users/manage/momm');

          break;

          case 'mosm': // managing your subentity records
                redirect('honcho-users/manage/mosm');

          break;
      
          case 'mcmm': // managing current members - used for student members only
                redirect('honcho-users/manage/mcmm');

          break;

          case 'mngallusers': // managing all members
                redirect('honcho-users/manage/mngallusers');

          break;
        }

    }


// ************************  function _GET_FONT_SIZES *********************** //
    
    function _get_font_sizes() {
    // protected - private function
    // Get user's fontsize preferences for manage page and all other pages
//json($_SESSION); die();        
    $user_id                    = $_SESSION['honcho_acct_rec_id'];
    $user_obj                   = $this->model->get_where($user_id,'honcho_user_accounts');
    $_SESSION['fontsize']       = $user_obj->fontsize;  // view pages
    $_SESSION['tfontsize']      = $user_obj->tfontsize; // manage page 
    
    
 //  print_r($_SESSION['fontsize']); die();
   
    // default sizes
    
         switch($_SESSION['fontsize']) {

          case '1': // managing my records
                 $_SESSION['fontsize'] = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['fontsize'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['fontsize'] = 'Small';
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



// ************************************************************************** //
// ***********************  function EMAILAUDITLOG ************************** //
// ************************************************************************** //
  
    function emailauditlog(){

        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $message  = $_POST['message'];
        $message  = wordwrap($message,70);
        $sender   = "bpaems@gmail.com"; // or $email - inquirers email from form
        $receiver = "bpaems@gmail.com,ericvwoods@hotmail.com";
        $subject  = "Sponsor Volunteer Submission - $name";
        $body     = "Subject: $subject\nFrom: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

        if(mail($receiver, $subject, $body, $sender)){  // mail is an inbuilt php mail function
      //      echo('Message Sent');
        $flash_msg = 'Your message was sent successfully!'; // 
        set_flashdata($flash_msg);

        $data['view_module']   = 'honcho/users';
        $data['view_file']     = 'sponsors'; // full member directory

        $data['bc1'] = 'MSP';

        $this->templates->inspinia($data);

        }else{

        $flash_msg = 'Your message failed to send.'; // 
        set_flashdata($flash_msg);

        $data['view_module']   = 'honcho/users';
        $data['view_file']     = 'sponsors'; // full member directory

        $data['bc1'] = 'MSP';

        $this->templates->inspinia($data);

        }
    }


    
} // end controller