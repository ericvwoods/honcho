<?php

/*----------------------------------------------------------------------------*/
/*------------------------ module HONCHO-USERS ------------------------------*/
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

//require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Users extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/
    
    function __construct(){
      $this->parent_module = 'honcho';
      $this->child_module  = 'users';

    }

    function __destruct(){
      $this->parent_module = '';
      $this->child_module = '';
    }

/*----------------------------------------------------------------------------*/
/*---------------------------- function INDEX --------------------------------*/
/*----------------------------------------------------------------------------*/
    
  function index() {

//$usersfunction = 'index'; // 1
//$authorized = $this->_check_function_permissions($usersfunction); 

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
echo "honcho-users-index() 155"; die();

  }

/*----------------------------------------------------------------------------*/
/* ---------------------------- function VIEWUSER ----------------------------- */
/*----------------------------------------------------------------------------*/
function viewuser() {
    
    $usrid = segment(3);
  echo "line 165 honcho-users-viewuser() Usrid: ";
  print_r($usrid); die();  
}

/*----------------------------------------------------------------------------*/
/* ---------------------------- function MANAGE ----------------------------- */
/*----------------------------------------------------------------------------*/

function manage(){ // takes you to subentity admin manage page

echo(165); die();
$_SESSION['managemode'] = segment(3); // passed from sidemenu button sets the mode

 //echo('manage 1032');
 //json($_SESSION); die();
 
    if($_SESSION['useradmin'] == 1 || $_SESSION['sysadmin'] == 1 ){
        // ok no check   
    }else{
       // echo('Users-Manage 1038'); die();
    $authorized = $this->_pairExists($_SESSION['$permissions_array'],$_SESSION['user_role_id'],7);

            if($authorized ==1){
        // everything is ok - continue to retrieve account record
 // echo('users/manage 1043 Authorized'); die();  
 //json($_SESSION); die();              
            }else{
  //echo('users/mydata 1046 Not Authorized'); die();                 
         //       json($_SESSION); die();
    $flash_msg = 'You do not have permission to manage user account data  - please contact the system administrator.'; // 
                set_flashdata($flash_msg);
  //              $flashmsgisset = 1; 
                $_SESSION['flashmsgcolor'] = 0; //                 
        // Auditlog  
        $type  = 'security';
        $action = 'NoPermission';
        $func = 'honcho-users_manage';
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
        
/*        
echo('users/mydata 209 not authorized');
echo('<br>');
print_r($view);
echo('<br>');
json($_SESSION['logindata']); die(); */

 redirect('honcho/index');           
    }
  
    }
//echo(1047);
//print_r($authorized); die(); // "goodtogo". if not goodtogo wont return here. Will go to userhome or login

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
 // $this->_get_font_sizes();
//echo(1054); die();
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
    
      $currentyear = $_SESSION['users_current_year'];

      if($currentyear < 2026){
        $currentyear = 2026;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-manage-1108';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: users';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['managemode'];
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $str5, $str6,$str1, $str2, $str3, $str4, $un, $time );

    }    
    
        $currentyear = $currentyear - 1;
      
switch($_SESSION['managemode']){

  case 'mngallusers': // managing all user records
//echo(1003); die();
  // start the spinner - the spinner div is in usercrud
    $_SESSION['actionmode'] = 'viewlist';
      
     $sql = "SELECT * FROM honcho_user_accounts";
     $data['usersrecs'] = $this->model->query($sql,'object');
 
  break;

  case 'mngsubentity': // managing your subentity records
 
      $_SESSION['actionmode'] = 'viewlist';
      
      // get the logged in user's id - only allowed to work on records from his own subentity
        $recid = $_SESSION['user_rec_id'];
      
//echo(1240);
//print_r($recid); die();

        if($recid < 1){ // session expired - not logged in
          $this->login();
        }

        // get the subentity id of the user. Can only admin your subentity's records
        $user_rec = $this->_get_a_single_record($recid); // anchor1
        
echo(1028);      
json($user_rec); die();
        
    //  print_r($user_array); die();
        $subentityadmin    = $user_rec['subentity_admin']; // 1
        $subentity_name    = $user_rec['subentity']; // 2
        $subentity         = $user_rec['subentity']; // 2
        $subentity_role    = $user_rec['subentity_role']; // 1      
        $subentity_role_id = $user_rec['subentity_role']; // 1

// echo(1251);
// print_r($subentity); die();
        
      //  $subentity_role_id = $users_subentity_role_obj->id;
      //  print_r($subentity); die();

        // get the roster records from user table for the subentity number
          // query for all records - (syntax: 'order_by', 'table', limit, offset)
          //  $data['usersrecs']      = $this->model->get('last_name','honcho_user_accounts'); // works manage
    
      // get the subentity members
      //$sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
      //$sql = "SELECT * FROM users WHERE subentity = $subentity AND deceased != 1  AND soft_deleted != 1 AND current_year > $currentyear"; // filter by current year if have five year look back
      //$sql = "SELECT * FROM users WHERE subentity = $subentity AND deceased != 1  AND soft_deleted != 1";
        $sql = "SELECT * FROM honcho_user_accounts WHERE subentity = $subentity"; // 
      
        $data['usersrecs'] = $this->model->query($sql,'object');
        
 //echo(1149);
 //json($data['usersrecs']); die();

          break;

            case 'subadmin': // ??? same as above? managing your subentity records

//echo(2601); die();
        $recid      = $_SESSION['user_rec_id'];

        if($recid < 1){ // session expired - not logged in
          $this->login();
        }
        echo(1069);
print_r($recid); die();
$user_array   = $this->_get_a_single_record($recid); // anchor1 - returns array - values not codes
 
echo(1251);      
    json($user_array); die();
    
        $subentityadmin  = $user_array['subentity_admin'];
        $subentity_name  = $user_array['subentity'];
        $subentity       = $user_array['subentity'];


        $subentity_role = $user_array['subentity_role'];
       
        $subentity_role_id = $user_array['subentity_role'];
      //  $users_subentity_role_id = $users_subentity_role_obj->id;
      //  print_r($subentity); die();

        // get the roster records from user table for the subentity number
          // query for all records - (syntax: 'order_by', 'table', limit, offset)
          //  $data['usersrecs']      = $this->model->get('last_name','honcho_user_accounts'); // works manage

 //print_r($currentyear); die();       
        $sql = "SELECT * FROM honcho_user_accounts WHERE subentity = $subentity AND current_year > $currentyear AND deceased != 1 AND soft_deleted != 1 AND id_type = 3 OR subentity = $subentity AND current_year > $currentyear AND deceased != 1 AND soft_deleted != 1 AND id_type = 4"; // S or Q students - all for a subentity
      //  $sql = "SELECT * FROM users WHERE subentity = $subentity"; // 
         //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
       // $data['usersrecs']  = $this->model->query($sql,'object');
        $data['usersrecs'] = $this->model->query($sql,'object');
//print_r($data['usersrecs'] ); die();

          break;


}

//echo(1105); //  checkpoint
//json($data['usersrecs']); die();

        foreach($data['usersrecs'] as $row) { // step through the object of records and populate the $data array with selected data 
         
            $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
            $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

            /*------------------ Change values to display descriptions instead of codes -----------------*/ 

            // Change codes to names
/*
            $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
            $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
            $levelname = $levelobj->level_title;  // capture the level name
            // now we need to insert the levelnames in the array for display
            $row->levelname = $levelname;
*/
            $memtypeid        = $row->id_type;
            $memtypeobj       = $this->model->get_where($memtypeid,'honcho_user_types');
            $row->id_type = $memtypeobj->id_type;

            $statusid    = $row->status;
            $statusobj   = $this->model->get_where($statusid,'honcho_user_status');
            $row->status = $statusobj->title;

            $subentityrole    = $row->subentity_role;
            $subentityobj   = $this->model->get_where($subentityrole,'honcho_user_subentity_offices');
            $row->subentity_role = $subentityobj->description;

            $subentityid    = $row->subentity;
            $subentityobj   = $this->model->get_where($subentityid,'honcho_user_subentities');
            $row->subentity = $subentityobj->description;

            $fintypeid          = $row->fin_acct_type;
            $fintypeobj         = $this->model->get_where($fintypeid ,'honcho_user_financial_types');
            $row->fin_acct_type = $fintypeobj->fin_type_title;

            $finstatusid     = $row->fin_status;
            $finstatusobj    = $this->model->get_where($finstatusid,'honcho_user_financial_statuses');
            $row->fin_status = $finstatusobj->fin_status_title;

            $this->module('timedate');
            $format = 'datepicker_us';
            $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

            if($row->updated_at == '01/01/1970'){
              $row->updated_at = ' ';
            }
            
            // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
            $format = 'datepicker_us'; // options: full, cool,shorter, mini, oldschool,datepicker,monyear
            $this->module('timedate'); 
            $row->last_login   = $this->timedate->get_nice_date($data->last_login, $format);        

            if($row->last_login == '01/01/1970'){

              $row->last_login = ' ';
            }
    
            // Get the address data
            $recid = $row->id;
            $addrdataobj = $this->model->get_one_where('user_id',$recid,'honcho_user_addresses');

            $row->mailaddress1 = $addrdataobj->mailaddress1;
            $row->mailaddress2 = $addrdataobj->mailaddress2;
            $row->mailcity     = $addrdataobj->mailcity;
            $row->mailstate    = $addrdataobj->mailstate;
            $row->mailzip      = $addrdataobj->mailzip;

            $row->physaddress1 = $addrdataobj->physaddress1;
            $row->physaddress2 = $addrdataobj->physaddress2;
            $row->physcity     = $addrdataobj->physcity;
            $row->physstate    = $addrdataobj->physstate;
            $row->physzip      = $addrdataobj->physzip;
            
            
            
            
//json($addrdataobj); die();
} // end foreach for current year

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
//  print_r($currentyear); die();
    
$previousyear = $currentyear; // because 1 has been subtracted from current year
// already to use the > sign in query because some pay for years in advance

/*
echo(1295);
print_r($_SESSION['managemode']);
//print_r($previousyear); die(); 
json($data['usersrecs']); die();
*/

        $data['subentity_name']  = $subentity_name; // not sure I do anything with this
        $data['view_module']   = 'honcho/users';
        $data['view_file']     = 'manage'; // 

 //print_r($_SESSION['managemode']); die();  //
        switch($_SESSION['managemode']) { // 

        case 'mngallusers': // managing all member records

              $data['bc1']      = HONCHOUSER.' Admin';
              $data['bc2']      = 'Manage All '.HONCHOUSERS;
              $data['activity'] = HONCHOUSER.' Administration';
              $data['header']   = 'Manage All '.HONCHOUSERS;
        break;
    
        case 'mngsubentity': // managing your subentity records

              $data['bc1']      = CCMPSSUBENTITY.' Admin';
              $data['bc2']      = 'Manage '.CCMPS;
              $data['header']   = CCMPSSUBENTITY.' '.CCMPS;
              $data['activity'] = $_SESSION['subentity_name'];

        break;
    
        case 'mosm': //  - used for current subentity student members only - no past due tabs

              $data['bc1']      = CCMPSSUBENTITY.' Admin';
              $data['bc2']      = 'Student '.CCMPS;
              $data['header']   = 'Current Student '.CCMPS;
              $data['activity'] = $_SESSION['subentity_name'];
              
        break;    

        case 'mcmm': //  - used for current student members only - no past due tabs

              $data['bc1'] = CCMP.' Admin';
              $data['bc2'] = 'Manage Student '.CCMPS;
              $data['header']   = 'Student '.CCMPS;
              $data['activity'] = CCMP.' Administrator';


        break;

        }

/*
  echo(1255); // checkpoint
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
/*------------------------- function UPDATEUSER ------------------------------*/
/*----------------------------------------------------------------------------*/
  
function updateuser($retrying){ // subentity admin on computer needs edit/create form create.php
//echo(1282); die();
$usrfuncid = 8; 
$authorized = $this->_check_function_permissions($usrfuncid);

    $retry = $retrying;  // first time through for unknown reason it passes the recid, on retry = yes.
    $recid = segment(3);
   
    if( $retry == 'yes'){ 
      // retry does not pass a segment value
      // keep tab number the same for the retry
        $retry = 'no'; // reset - not sure if necessary
        $data = $_POST; // get what was posted from the form
echo(1271);
json($_POST); die();
    }else{
          $_SESSION['user_active_window'] = segment(4); // what collapse called the update - return with that tab open
    }

//print_r($_SESSION['user_active_window']); die();
    $userobj     = $this->model->get_where($recid,'honcho_user_accounts');

    $_SESSION['current_email'] = $userobj->email_address;
    $usrchptrid    = $userobj->subentity;
    $subentityobj  = $this->model->get_where($usrchptrid,'honcho_user_subentities');
    $subentitynm   = $subentityobj->title;
  //  $id_type       = $subentityobj->id_type;

/*
echo(1287);
echo('<br>');
json($userobj);
echo('<br>');
json($_SESSION); die();
*/
    
/*----- Need to change mode to what was requested and by whom ----------------*/

 switch($_SESSION['managemode']) {

  case 'mngallusers': // managing all members

      $_SESSION['actionmode'] = 'updateuser'; //  updating 

  break;

  case 'updatemydata': // managing your subentity records - coming from manage or view pages

      $_SESSION['usermode'] = 'updatemydata'; // updating - updatemydata
 echo(1307); die();
  break;

}

    if($retry == 'yes'){
      $retry = 'no'; // reset -not sure if necessary
        $data = $_POST;
echo(1315);
echo('check county and country'); die();
        // need to reset dropdowns to attempted values - these are special case since share the same dropdown list
        $data['mailstateid'] = $data['mailstate'];
        $data['physstateid'] = $data['physstate'];       
        $data['billstateid'] = $data['billstate'];
        $data['shipstateid'] = $data['shipstate'];

        $data['mailcntyid'] = $data['mailcounty'];
        $data['physcntyid'] = $data['physcounty'];       
        $data['billcntyid'] = $data['billcounty'];
        $data['shipcntyid'] = $data['shipcounty'];
        
        $data['mailcntryid'] = $data['mailcountry'];
        $data['physcntryid'] = $data['physcountry'];       
        $data['billcntryid'] = $data['billcountry'];
        $data['shipcntryid'] = $data['shipcountry'];                

    }else{
      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid); // anchor1 - returns $user_data from 938
     //   $data = $this->_convert_null_integers_to_zeros($data); // anchor4
/* 
echo(1341);
print_r($data->mailaddrdata->state); 
echo('<br>');
json($data);
echo('<br>');
json($_SESSION);        
die();
*/
    // need to preset dropdowns to attempted values - these are special case since share the same dropdown list
    $data->mailstateid = $data->mailaddrdata->state;
    $data->physstateid = $data->physaddrdata->state;
    $data->billstateid = $data->billaddrdata->state;
    $data->shipstateid = $data->shipaddrdata->state;
    }

    // if a state code value is NULL we dont want the dropdown to default to AL
    if(strlen($data->mailstateid) >0){
      // Ok not null do nothing
    }else{

      $data->mailstateid = 'NA';
    }
    
    if(strlen($data->physstateid) >0){
      // Ok not null do nothing
    }else{

      $data->physstateid = 'NA';
    }
    
    if(strlen($data->billstateid) >0){
      // Ok not null do nothing
    }else{

      $data->billstateid = 'NA';
    }
    if(strlen($data->shipstateid) >0){
      // Ok not null do nothing
    }else{

      $data->shipstateid = 'NA';
    }

/*------------------------ Populate Dropdowns  -------------------------------*/
 
$data= (array)$data;

    // genders
    $data['genders'] = $this->model->get('id','ref_genders'); 

    // languages
    $data['languages'] = $this->model->get('id','ref_languages'); 

        // regions
    $data['regions'] = $this->model->get('id','ref_region_codes'); 
    
    // subentitys
    $data['subentities'] = $this->model->get('id','honcho_user_subentities'); 

    // subentity roles
    $data['subentityroles'] = $this->model->get('id','honcho_user_subentity_offices'); 

    // national roles
    $data['nationalroles'] = $this->model->get('id','ref_national_offices'); 
      
    // membership types
    $data['usertypes'] = $this->model->get('id','honcho_user_types');   

    // Financial Acct Types
    $data['accttypes'] = $this->model->get('id','honcho_user_financial_types'); 

    // Financial Acct Status
    $data['finstatuses'] = $this->model->get('id','honcho_user_financial_statuses'); 

 //echo(1415);
 //json($data); die();
    
    // states
    $data['state_codes'] = $this->model->get('id','ref_states'); 

    // counties
    $data['county_codes'] = $this->model->get('id','ref_counties'); 
    
    $mstid     = 'FL';  

    $mailcntys = $this->model->get_where_custom('state', $mstid ,'=', 'id', 'ref_counties');
   //  $mailcntys[] = (array)$mailcntys;
   // echo(1968);
   // json($mailcntys ); die();
    // countries
    $data['country_codes'] = $this->model->get('id','ref_countries'); 
 

// To control input fields.
    $data['recid']         = $recid;
    $data['subentitynm']   = $subentitynm;
    $data['view_module']   = 'honcho/users';

//echo(1435);
//print_r($_SESSION['actionmode']); die();

 switch($_SESSION['actionmode']) { 

  case 'updatemydata': // 

        $data['bc1'] = 'MSP';
        $data['bc2'] = 'My Profile > Updating';
        $data['subentitynm'] = $subentitynm;

  break;

  case 'updateuser': // 

        $data['bc1'] = HONCHOUSER.' Admin';
        $data['bc2'] = 'Update '.HONCHOUSER;
        $data['subentitynm'] = $subentitynm;

  break;

  case 'momu': // 

        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'View '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;
  break;


  }

     // CCMP Single Page CRUD
    $data['view_file']  = 'usercrud'; // use all-in-one crud form for updating
    
/*
  echo(1470);
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
// ------------------------- End function updateuser ------------------------ //
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*-------------------------- function CREATECCMP -----------------------------*/
/*----------------------------------------------------------------------------*/

function createuser($retrying){ // Adding - may be first time or with values after failed validation
                                                 
  $retry = $retrying; // for failed validation repost

  //*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
 // $this->_get_font_sizes();
//echo(1503); 
//print_r($_SESSION['actionmode']); die(); // = viewlist
//print_r($reposted); die(); ???
//print_r($retry); die();
//json($_SESSION); die();
  // who is creating - subentity admin ca or member admin ma so if cancel go back to correct manage page
  //$who_creating_from_btn = segment(3); // ca or ma

//print_r($who_creating_from_btn); die();

 switch($_SESSION['actionmode']) {
     
  case 'viewlist': // managing all members

      $_SESSION['actionmode'] = 'createuser'; //
        $data['bc1'] = HONCHOUSER.' Admin';
        $data['bc2'] = 'Create New '.HONCHOUSER;
  break;

  case 'momm': // managing your subentity records - coming from manage or view pages
      $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'honcho_user_accounts');
      $chptnum = $usrobj->subentity;
      $subentityobj = $this->model->get_one_where('id', $chptnum,'users_subentities');

      $_SESSION['usermode'] = 'momc'; // mom - ca creating from subentity members page
 //print_r($_SESSION['usermode']); die();
  break;

  case 'mosm': // managing your subentity student records - coming from manage or view pages
      $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'honcho_user_accounts');
      $chptnum = $usrobj->subentity;
      $subentityobj = $this->model->get_one_where('id', $chptnum,'users_subentities');

      $_SESSION['usermode'] = 'mosc'; // mom - ca creating from subentity students page
 //print_r($_SESSION['usermode']); die();
  break;


  case 'mcmm': // managing current members - used for student members only

      $_SESSION['usermode'] = 'mcmc'; // mcm - ma creating from current member page

  break;
}

 $_SESSION['user_active_window'] = 1; // open the first tab

    if($retry == 'yes'){
        $retry = 'no'; // reset -not sure if necessary

        $data = $_POST; // get what was posted from the form 

        // the names of the posted values are derived from the label names of the form to ensure uniqueness 
        // as a loop is used to create the input code and each name="" value must be unique
        // however values sent to the form use the another name in some cases (typically database name)
        // so if you are retrying you must convert what was sent back from the form to the names expected to
        // be received by the form. Ex. $data['first_name'] orig sent to form and $_POST['first'] returned
        // by the form. So must id which value names coming back from the form are different than those passed
        // to the form.

        // $itemsv100 in usercrudcifaq-item1.php
/*
                    Passed Back         Passed To Form

                    "Prefix"            => "$salutation",  
                    "First"             => "$first_name",
                    "Middle"            => "$middle_name",
                    "Last"              => "$last_name",
            Same         "Suffix"            => "$suffix",
                    "Member Number"     => "$id_number",
                    "Member Type"       => "$id_type",  
            Same         "Status"            => "$status", 
                    "Current Year"      => "$current_year",     
                    "Email"             => "$email_address",
            Same        "Phone"             => "$phone",
            Same        "Mobile"            => "$mobile",
            Same        "Fax"               => "$fax",
                    "Restricted Access" => "$vip",
                    "Opt Out Directory" => "$directoryoptout",
                    "Opt Out Emails"    => "$emailoptout",
            Same        "Do Not Call"       => "$donotcall",
                    "Mail Newsletter"   => "$mail_notices",
                    "Eligible Voter"    => "$eligible_voter",
                    "Alternate Contact" => "$alternate_contact",
                    "Alternate Phone"   => "$alternate_phone",
                    "Alternate Email"   => "$alternate_email",  
                    "Date Created"      => "$created_at", 
                    "Created By"        => "$created_by"

*/
        // th ones marked same alresy exist in $data because same name
        // therefore only need:
        // To form second try    passed from form 1st try           
        $data['salutation']        = $data['prefix'];
        $data['first_name']        = $data['first'];
        $data['middle_name']       = $data['middle'];
        $data['last_name']         = $data['last'];
        $data['id_number']         = $data['idnumber'];
        $data['id_type']           = $data['idtype'];
        
        $data['current_year']      = $data['currentyear'];
        $data['email_address']     = $data['email'];
        $data['vip']               = $data['restrictedaccess'];
        $data['directoryoptout']   = $data['optoutdirectory'];
        $data['emailoptout']       = $data['optoutemails'];
        $data['mail_notices']      = $data['mailnewsletter'];
        $data['eligible_voter']    = $data['eligiblevoter'];
        $data['alternate_contact'] = $data['alternatecontact'];
        $data['alternate_phone']   = $data['alternatephone'];
        $data['alternate_email']   = $data['alternateemail'];
        $data['created_at']        = $data['datecreated'];
        $data['created_by']        = $data['createdby'];

        // need to reset dropdowns to attempted values - these are special case since share the same dropdown list
        $data['mailstateid'] = $data['mailstate'];
        $data['physstateid'] = $data['physstate'];
        $data['physstateid'] = $data['billstate'];
        $data['shipstateid'] = $data['shipstate'];
        $data['subentityid'] = $data['subentity']; 

        $data['password']      = DEFAULT_CCMP_PASSWORD;
        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
//echo(4267);
//json($data); die();
    }else{

        $data['password'] = DEFAULT_CCMP_PASSWORD;

        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;

        //Dropdowns
        // Gender - Let it default to male
 //       $data['unverified']          = 1;
        $data['id_type']           = 5; // regular "employee"
        $data['subentity_role']    = 1; // none - regular "department" member
        $data['mailstateid']       = 'NA'; // Unknown - using code and not id
        $data['physstateid']       = 'NA'; // Unknown
      
        $data['fin_acct_type']     = 1; // Personal financial acct
        $data['fin_status']        = 9; // Unused - account never been used
        $data['physstateid']       = 'NA'; // Unknown
        $data['shipstateid']       = 'NA'; // Unknown

        $data['subentity']         = 1;  // "department" executive office
        $data['national_officer']  = 10; // NA - not corp officer or board
        $data['minor']             = 0;
      }

    // if a state code value is NULL we dont want the dropdown to default to AL
    if(strlen($data['mailstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstateid'] = 'NA';
    }
    if(strlen($data['physstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['physstateid'] = 'NA';
    }
    if(strlen($data['physstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['physstateid'] = 'NA';
    }
    if(strlen($data['shipstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['shipstateid'] = 'NA';
    }

/*------------------ Populate Dropdowns  ---------------------*/
        
        // membership types
        $data['usertypes'] = $this->model->get('id','honcho_user_types');    

        // subentitys
        $data['subentitys'] = $this->model->get('id','honcho_user_subentities'); 

        // subentity roles
        $data['subentityroles'] = $this->model->get('id','honcho_user_subentity_offices'); 

        // national roles
        $data['nationalroles'] = $this->model->get('id','ref_national_offices'); 

        // states
        $data['state_codes'] = $this->model->get('id','ref_states'); 

        // genders
        $data['genders'] = $this->model->get('id','ref_genders'); 

        // Financial Acct Types
  //      $data['accttypes'] = $this->model->get('id','users_financial_types'); 

        // Financial Acct Status
 //       $data['finstatuses'] = $this->model->get('id','users_financial_statuses'); 

        $data['view_module']   = 'honcho/users';

     // CCMP Single Page CRUD

        $data['view_file']     = 'usercrud'; // use all-in-one crud form for creating
/*
  echo(2328);
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  die();
*/
          // template is the default location (templates/views/cool_mobi) using old engine, new engine uses public/themes/cool_mobi/black
          $this->templates->inspinia($data);
}

/*----------------------------------------------------------------------------*/
/*----------------------- End function createuser ----------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function USERSUBMIT -----------------------------*/
/*----------------------------------------------------------------------------*/

function usersubmit(){ // used by both user & admin when editing/creating

// make sure session is still active so session variables are available
// dont want to submit with missing parameters
if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
  // echo(747); die();
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // 
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('honcho/logout'); // clears everything then takes to login page
}

  $recid = segment(3); // if updating there will be a record id, if adding nothing

  $submit = post('submit', true);

  $crud = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crud  = 'updating';
  }else{
     $crud  = 'adding';

  }

// checkpoint
/*
  echo(1787);
  echo('<br>');
  echo('$_session[usermode] = ');
  print_r($_SESSION['usermode']);
  echo('<br>');
  echo('$_session[tab] = ');
  print_r($_SESSION['user_active_window']);
  echo('<br>');
  echo('$recid = ');
  print_r($recid);
  echo('<br>');
  echo('$submit = ');
  print_r($submit);
  echo('<br>');
  echo('$crud = ');
  print_r($crud);
  echo('<br>');
  echo('$_POST = ');
  json($_POST); die();
*/

  if ($submit == 'Submit') {

    // Grab the user table data from the post and translate posted label names to DB field names
    $userdata_post = $this->_users_fetch_data_from_post();  // anchor2

// anchor2 
/*
echo(1820);
echo('<br>');
echo('$userdata_post) = '); 
json($userdata_post); die();
*/
        
/*----------- Convert User Friendly Back to DB Values for Save  --------------*/

    $mstateobj = $this->model->get_where_custom('state_code', $userdata_post['mailstate'],'=', 'id', 'ref_states'); 
    $userdata_post['mailstate']  = $mstateobj[0]->fips;      


    $pstateobj = $this->model->get_where_custom('state_code', $userdata_post['physstate'],'=', 'id', 'ref_states'); 
    $userdata_post['physstate']  = $pstateobj[0]->fips;   
    
/*----------------------------------------------------------------------------*/
  
    // assign update_id to recid and add it to the poster array
    $update_id = $recid;  // came in the URL not POST
    $userdata_post['recid'] = $recid; // add recid from url to post data

    if($recid > 0){ // updating

    }else{ // ADDING

   // new record font defaults
    $userdata_post['fontsize']  = 2; // set default font to medium for pages
    $userdata_post['tfontsize'] = 3; // set default font to small for tables

    }
    
    // future - add the credential data to the contact data since same table destination
    // future - $userstbldata = array_merge($userdata_post,$credsdata_post);
    // combine for users table update
            
    // split into two so can do two saves with only data needed for each address record
//echo(1856);
//json($userdata_post); die();
    $mailaddrdata['address1'] = $userdata_post['mailaddress1']; 
    $mailaddrdata['address2'] = $userdata_post['mailaddress2'];      
    $mailaddrdata['city']     = $userdata_post['mailcity'];
    $mailaddrdata['state']    = $userdata_post['mailstate'];    
    $mailaddrdata['zip']      = $userdata_post['mailzip'];            
    $mailaddrdata['county']   = $userdata_post['mailcounty'];
    $mailaddrdata['country']  = $userdata_post['mailcountry'];
//echo(2455);
//json($mailaddrdata); die();
    $physaddrdata['address1'] = $userdata_post['physaddress1'];
    $physaddrdata['address2'] = $userdata_post['physaddress2'];     
    $physaddrdata['city']     = $userdata_post['physcity'];
    $physaddrdata['state']    = $userdata_post['physstate'];   
    $physaddrdata['zip']      = $userdata_post['physzip'];           
    $physaddrdata['county']   = $userdata_post['physcounty'];  
    $physaddrdata['country']  = $userdata_post['physcountry'];  
//echo(2464);
//json( $physaddrdata); die();        
    
    // set all the table data to what was posted then later unset what doesnt belong 
    $userstbldata = $userdata_post;
//echo(2469);      
//json($userstbldata); die();     
    // get the id of the user record being edited to save the address data edits
    $userid =  $userstbldata['id'];

    // evaluate mailphys - if yes then reset physaddresses to equal mailaddresses 
    $mail_eq_phys  = $userdata_post['mail_eq_phys'];
//print_r($mail_eq_phys); die();
    if($mail_eq_phys == 1){

     $userstbldata['mail_eq_phys'] = 1;

     $physaddrdata['address1'] = $userdata_post['mailaddress1'];
     $physaddrdata['address2'] = $userdata_post['mailaddress2'];     
     $physaddrdata['city']     = $userdata_post['mailcity'];
     $physaddrdata['state']    = $userdata_post['mailstate'];    
     $physaddrdata['zip']      = $userdata_post['mailzip'];           
     $physaddrdata['county']   = $userdata_post['mailcounty']; 
     $physaddrdata['country']  = $userdata_post['mailcountry'];

     }else{
       $userstbldata['mail_eq_phys'] = 0;
     }
/*       
echo(1904);
json($mailaddrdata);
json($physaddrdata);  die();
*/              
    // Now unset the address data that doesnt belong in order to save to users table

    unset($userstbldata['mailaddress1']);
    unset($userstbldata['mailaddress2']);
    unset($userstbldata['mailcity']);
    unset($userstbldata['mailstate']);
    unset($userstbldata['mailzip']);
    unset($userstbldata['mailcounty']);
    unset($userstbldata['mailcountry']);

    unset($userstbldata['physaddress1']);
    unset($userstbldata['physaddress2']);
    unset($userstbldata['physcity']);
    unset($userstbldata['physstate']);
    unset($userstbldata['physzip']);
    unset($userstbldata['physcounty']);
    unset($userstbldata['physcountry']);      

//unset($userstbldata['username']); // if dont want to be able to change username - maybe config ???       
/*
    echo(1920);
echo('<br>');
echo('$userstbldata) = '); 
json($userstbldata); die();
*/

/*---------------------------- Record Validations ----------------------------*/
    
    // Examine the posted data from the form & perform the checks for uniqueness
    // (Email Address, Username, & Member Number)
    
    // check to see if the email address is already taken - somebody could attempt to change theirs to one that exists already or add one that exists
    $emadr = $userdata_post['email_address'];

    // Set to passing validations and if any fail any of the tests below then set to 0.
    $result = 1;

    // Begin validation tests
    // was an email address provided and is it already in the DB
    if(strlen($emadr) > 0){ // if the user submitted an email address - otherwise it will match on blank records

      $emadr = trim($emadr);
//print_r($emadr); die();
      $usr_obj = $this->model->get_one_where('email_address', $emadr, 'honcho_user_accounts');
//echo(1952);
//json($usr_obj); die();

      $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
      if($recordfndid > 0){ // record found id exists so there is a user with that username

        // check if record found id is same as the record being edited which is ok
        // because changing your username is allowed

        // if there is no update_id then you are adding so it is not ok to find a duplicate
        if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate
//echo('Email address found but Everything OK'); die();

          // its the same record being edited so everything OK
          // nothing to do here just keep executing

        }else{ 
//echo('Email Address found but NOT OK'); die();

          // here a different user trying to change his username to someone elses
          // need to set flash msg fo rthe error and send back to the create form
          $result = 0;  // failed validation

          $flash_msg = 'The Email Address is already taken.';
          set_flashdata($flash_msg);

          $flashmsgisset = 1;

        } // will keep executing

        // no one found with that email address

      } // the email address wasn't found so it is unique - keep executing
//echo('No duplicate found - continuing execution'); die();

    }else{ // no email address

            if($userdata_post['id_type'] == 3 || $userdata_post['id_type'] == 4 || $deceased == 1){
               // continue execution - student members & deceased do not need email addresses
      //          echo(2580); die();
            }else{

                // if you are updating a different tab it wont fail you for not having the data. 
                $result = 0;  // failed validation
echo(1993); die();
                $flash_msg = 'The Email Address is required.';
                set_flashdata($flash_msg);

                $flashmsgisset = 1;
        }
     // if($_SESSION['user_active_window'] == 1 || $crud == "adding"){ // default is tab 1 so id adding from create form this will run OR actually editing tab 1 will run
     // }
    } 

    // check to see if the username is already taken - somebody could attempt to change theirs to one that exists already
    $usrnm = $userdata_post['username'];
//echo(2005);        
//print_r($usrnm); die();

//echo(2008);
//print_r($userstbldata['username']); die();
    if(strlen($usrnm) > 0){ // if the user submitted a username - otherwise it will match on blank records

      $usernm = trim($usrnm);

      $usr_obj = $this->model->get_one_where('username', $usernm, 'honcho_user_accounts'); //  ??? work?
      $mbrno = $usr_obj->id_number;
//echo(2016);
//print_r($mbrno);
//json($usr_obj); die();

      $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
      if($recordfndid > 0){ // record found id exists so there is a user with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

        // check if record found id is same as the record being edited which is ok
        // because changing your username is allowed
        // if there is no update_id then you are adding so it is not ok to find a duplicate
        if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate

          // its the same record being edited so everything OK
          // nothing to do here just keep executing
 //         echo('Found but Everything OK'); die();
//echo(2036); die();
        }else{ 
//echo('Found but not OK'); die();
          // here a different user trying to change his username to someone elses
          // need to set flash msg for the error and send back to the create form
          if($_SESSION['user_active_window'] == 1 || $crud == "adding"){ 
              $result = 0;  // failed validation
echo(2041); die();
              $flash_msg = 'The Username already exists.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;
          }
        } // will keep executing - 2118

      } // the username wasn't found so unique - keep executing
     // print_r('no duplicate found'); die();

    }else{ // no username submitted (updatemydata,...)

      // by here we have validated that an email exist and properly formatted
// print_r($userdata_post['email_address']); 
      // No username submitted - either wasnt allowed to edit (updatemydata) or a new record
      // Need to know if should be set to the email address
      // Or set to a random if no email address - having no email
      // address is ok if you are a certain id_type (member type 3 or 4).

/*
echo(2057);
echo('<br>');
print_r($userdata_post['deceased']);
echo('<br>');
print_r($userdata_post['email_address']);
echo('<br>');
print_r($userdata_post['id_type']);
echo('<br>');
print_r(HONCHO_DEFAULT_USRNMEQEMAIL);
echo('<br>');
json($userstbldata); die(); // 
*/
echo(2073);
print_r($userstbldata['username']); die();
        // make the username = email if that option flag is set (also see line 1658) ???
        if(HONCHO_DEFAULT_USRNMEQEMAIL == 1){ // 

           if(strlen($userdata_post['email_address']) > 0){

               $userdata_post['username'] = $userdata_post['email_address'];

           }else{
               if($userdata_post['id_type'] == 3 || $userdata_post['id_type'] == 4){
                  // continue execution - student members do not need an email address
                  // but they do need a username - when adding username field
                  // not available because we dont know what the member type will be.
                   // cant give all same username because already giving them
                   // the same password.
               $token_length = 6;
               $characters = '23456789abcdefghjkmnpqrstuvwxyz';
               $random_code = '';
               for ($i = 0; $i < $token_length; $i++) {
                   $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
               }
               $userdata_post['username'] = $random_string;

               }
        }
//echo(2686); die();
       }else{ // username not required to be equal to email
//echo(2688); die();            
             if($_SESSION['user_active_window'] == 1 || $crud == "adding"){ 
                 $result = 0;  // failed validation
echo(2099); die();
                 $flash_msg = ' A Username is required.';
                 set_flashdata($flash_msg);

                 $flashmsgisset = 1;
             }
       }

     } 

// checkpoint

/*
echo('2118 the 3 values that are validated');
echo('<br>');
echo("userdata_post['deceased']");
echo('<br>');
print_r($userdata_post['deceased']);
echo('<br>');
echo("userdata_post['email address']");
echo('<br>');
print_r($userdata_post['email_address']);
echo('<br>');
echo("userdata_post['username']");
echo('<br>');
print_r($userdata_post['username']);
echo('<br>');
echo("userdata_post['id_number']");
echo('<br>');
print_r($userdata_post['id_number']);
echo('<br>');
echo("userdata_post['id_type']");
echo('<br>');
print_r($userdata_post['id_type']);
echo('<br>'); 
echo("HONCHO_DEFAULT_USRNMEQEMAIL");
echo('<br>');
print_r(HONCHO_DEFAULT_USRNMEQEMAIL);
echo('<br>');
echo("userstbldata");
print_r($userstbldata['username']);
json($userstbldata); die(); // 
*/

    // check to see if the member number is already taken - somebody could attempt to change theirs to one that exists already
      
        if(strlen($userdata_post['id_number']) > 0){ // if the user submitted a member number - otherwise it will match on blank records
                  
          $userdata_post['id_number'] = trim($userdata_post['id_number']);
          $usr_obj = $this->model->get_where_custom('id_number', $userdata_post['id_number'],'=', 'id', 'honcho_user_accounts');        
//echo(2155); 
//json($usr_obj); die();
                     
          $recordfndid = $usr_obj->id; // record found id (or not)
//echo(2739);
//print_r($recordfndid); die();
          if($recordfndid > 0){ // record found id exists so there is a user with that username
echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed ???
            // if there is no update_id then you are adding so it is not ok to find a duplicate
            if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate
echo(2168); die();
              // its the same record being edited so everything OK
              // nothing to do here just keep executing
echo(2172); die();
            }else{ 

              // here a different user trying to change his username to someone elses
              // need to set flash msg for the error and send back to the create form
              if($_SESSION['user_active_window'] == 1 || $crud == "adding"){ 
                  $result = 0;  // failed validation
echo(2167); die();
                  $flash_msg = 'The Member Number already exists.';
                  set_flashdata($flash_msg);

                  $flashmsgisset = 1;
              }
              
              
            } // will keep executing
            
          } // the username wasn't found so unique - keep executing
/*
print_r('2179 no duplicate username found');
echo('<br>');
print_r($result); die();
*/
        }else{ 
          /* Uncomment to require a member number
              if($_SESSION['user_active_window'] == 1 || $crud == "adding"){ 
                  $result = 0;  // failed validation

                  $flash_msg = 'A Member Number is required.';
                  set_flashdata($flash_msg);

                  $flashmsgisset = 1;
              }
              */

        }
// checkpoint
/*
echo(2210);
echo('<br>');
echo('$recid = ');
print_r($recid);
echo('<br>');
echo('Results of validation helpers');
echo('<br>');
print_r($result);
echo('<br>');
echo('$userdata_post');         
json($userdata_post);
echo('<br>');
json($userstbldata); die();
*/
               
    if($result > 0){ // if passed all validations above - save the record - ends 3337
        
        if($recid > 0){ // Passed Updating
            // get the address record id for the user_id (=$recid)
            unset($userstbldata['id']); // autoincrement
            unset($userstbldata['recid']); // not in any DB - will break update query
            unset($userstbldata['current_year']); // not 

            /*
echo(2237);
echo('<br>');
print_r($_POST['idtype']); 
echo('<br>');
print_r($userstbldata['username']);
echo('<br>');
print_r($userstbldata['email_address']);
echo('<br>');
json($userdata_post); die(); // user acct data
*/

    // Check if email address should match username
    if(HONCHO_DEFAULT_USRNMEQEMAIL == 1){ 
        $userstbldata['username'] = $userstbldata['email_address'];
    }
    
    
    $userstbldata['updated_at'] = TIME();
    $userstbldata['updated_by'] = $_SESSION['tg_user_id'];
//echo(2253);
//echo('<br>');
//print_r($userstbldata['username']); die();
    if(isset($userstbldata)){

/*
echo(2259); // checkpoint
echo('<br>');
print_r($recid);
echo('<br>');
json($userstbldata); die();
*/
       
         $this->model->update($recid, $userstbldata, 'honcho_user_accounts');
//echo(2271); die();               
        // Auditlog
        $type  = 'userupdate';
        $action = 'UpdateUser';
        $func = 'users-usersubmit-2258';
        $func = 'users-usersub';
        $un   = 'UN: '.$_SESSION['honcho_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: users';
        $str5 = 'Successfull';
        $str6 = $_SESSION['usermode'];
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
/*         
echo(2278);
echo('<br>');
echo('user update saved!');
echo('<br>');
echo('now save the address data:');
json($mailaddrdata);
json($physaddrdata);
echo('<br>');
print_r($userid); die();
*/

        // update the table where the user_id = $user_id and type = 1 with $mailaddrdata
        // if there is no address record in the table there will not be an error just nothing changes
        $mailaddrsql = "SELECT * FROM honcho_user_addresses WHERE user_id = $userid AND type =1";
        $mailaddrobj = $this->model->query($mailaddrsql,'object');
        $mailaddrid  = $mailaddrobj[0]->id;

 /*       
echo(2300); 
echo('<br>');
echo('$mailaddrdata[address1]:');
print_r($mailaddrdata['address1']);
echo('<br>');
echo('$mailaddrid:');
print_r($mailaddrid);
echo('<br>');
echo('$mailaddrobj:');
json($mailaddrobj);
echo('<br>');
echo('$mailaddrdata:');
json($mailaddrdata);die(); 
*/
        
        // first determine if there is a mailaddr1 which is required to have a mailing address
        // a) if there is a mailaddr1 and an existing mailing address record then save the update
        // b) if there is a mailaddr1 and no mailing address record exists then create one and
        // initialize it to the update values
        // c) if there is no mailaddr1 then skip the update (dont want to create and store with
        // only the dropdown defaults 00,00000,USA)
//echo(2903);      
//print_r($mailaddrdata['address1']); die();       
        
if(strlen($mailaddrdata['address1']) > 0){
 //echo('2907 mailaddr1'); die(); 
 
    if(isset($mailaddrid)){ // if isset then a record exists and update it
   //  echo(3064);
   //  json($mailaddrdata); die();
     
        $this->model->update($mailaddrid, $mailaddrdata, 'users_addresses');
        
        // Auditlog
        $type  = 'userupdate';
        $action = 'UpdateMailAddr';
        $func = 'users-usersubmit-2898';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$mailaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Successfull';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
               
    }else{ // need to create a record and initialize with the update
     //   echo('3068 have mailaddr1 but no record'); die();
     $mailaddrdata['user_id'] = $userstbldata['id'];
     $mailaddrdata['type'] = 1; // type 1 = mailing address
//json($mailaddrdata); die();

        $this->model->insert($mailaddrdata, 'users_addresses');
        
        // get the new record's id 
        $mailaddrid = $this->model->get_max('users_addresses');
                 
        // Auditlog
        $type  = 'userupdate';
        $action = 'InsertMailAddr';
        $func = 'users-usersubmit-2924';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$mailaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Successfull';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);        
    }
    
}else{ // no address 1
// check to see if the tried to save anything else (other than the 3 default dropdowns) 
// and remind the address1 is required and do a retry with the form
// or just ignore and throw away the 3 dropdown defaults (00,00000,USA)and anything else 
    
// If no address 1 and just the defaults then save otherwise dont
$user_id = $userdata_post['id'];

/*
echo(2390);
echo('<br>');
print_r($user_id);
echo('<br>');
print_r(strlen($mailaddrdata['address2']));
echo('<br>');
print_r(strlen($mailaddrdata['city']));
echo('<br>');
print_r($mailaddrdata['state']);
echo('<br>');
print_r(strlen($mailaddrdata['zip']));
echo('<br>');
json($mailaddrdata); 
json($userdata_post); die(); 
*/

    // Since no address 1 and if just the defaults then delete, otherwise dont and will remain the same    
    if(strlen($mailaddrdata['address2']) == 0 AND strlen($mailaddrdata['city']) == 0 AND strlen($mailaddrdata['zip']) == 0 AND $mailaddrdata['state'] == '00'){
        $sql = "SELECT * FROM honcho_user_addresses WHERE user_id = $user_id AND type = 1"; 
        $maddrobj = $this->model->query($sql,'object'); 
        $deladdrid = $maddrobj[0]->id;
//echo(2965); 
//print_r($deladdrid); die();     
//json($maddrobj); die();
            if($deladdrid > 0){ // if editing a a user where address was already removed dont need to delete
                // run permanent delete query on users_addresses table
                $removeaddr1 = $this->model->delete($deladdrid, 'honcho_user_addresses');
                $flash_msg = $flash_msg.'The Mailing Address was successfully removed. '; 

                set_flashdata($flash_msg);
                $flashmsgisset = 1; 
                $_SESSION['flashmsgcolor'] = 1; // green  
                                   
                // Auditlog
                $type  = 'userupdate';
                $action = 'DeleteMailAddr';
                $func = 'users-usersubmit-2985';
                $un   = 'UN: '.$_SESSION['user_username'];
                $format = 'minitime'; // I added to Timedate.php
                $this->module('timedate');            
                $timestamp = time();
                $time   = $this->timedate->get_nice_date($timestamp, $format);
                $time = $time.' UTC';
                $str3 = 'Rec: '.$mailaddrid;
                $str4 = 'Tbl: users_addresses';
                $str5 = 'Successfull';
                $str6 = $_SESSION['usermode'];

                $this->module('system-auditlogger');
                $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            }
        
    }else{
        $flash_msg = $flash_msg.'Mailing Address Line 1 is required to update an address.';

        set_flashdata($flash_msg);
        $flashmsgisset = 1; 
        $_SESSION['flashmsgcolor'] = 0; // red
                                           
        // Auditlog
        $type  = 'userupdate';
        $action = 'UpdateMailAddr';
        $func = 'users-usersubmit-3012';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$mailaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Failed - No addr1';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
    }
}

/*       
echo(2481); 
echo('<br>');
print_r($physaddrdata['address1']);
echo('<br>');
print_r($physaddrid);
echo('<br>');
json($physaddrobj);
echo('<br>');
json($physaddrdata);die(); 
*/

    // update the table where the user_id = $user_id and type = 2 with $physaddrdata
    $physaddrsql = "SELECT * FROM honcho_user_addresses WHERE user_id = $userid AND type =2";
    $physaddrobj = $this->model->query($physaddrsql,'object');
    $physaddrid  = $physaddrobj[0]->id;

    // first determine if there is a physaddr1 which is required to have a physical address
    // a) if there is a physaddr1 and an existing physical address record then save the update
    // b) if there is a physaddr1 and no physical address record exists then create one and
    // initialize it to the update values
    // c) if there is no physaddr1 then skip the update (dont want to create and store with
    // only the dropdown defaults 00,00000,USA)

if(strlen($physaddrdata['address1']) > 0){
 //echo('3056 physaddr1'); die(); 
 
    if(isset($physaddrid)){ // if isset then a record exists and update it
     echo(2499);
     json($physaddrdata); die();
     
        $this->model->update($physaddrid, $physaddrdata, 'users_addresses');
        
        // Auditlog
        $type  = 'userupdate';
        $action = 'UpdatePhysAddr';
        $func = 'users-usersubmit-3062';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$physaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Successfull';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
               
    }else{ // need to create a record and initialize with the update
     //   echo('3083 have physaddr1 but no record'); die();
     $physaddrdata['user_id'] = $userstbldata['id'];
     $physaddrdata['type'] = 2; // type 2 = physical address
//json($physaddrdata); die();

        $this->model->insert($physaddrdata, 'honcho_user_addresses');
        
        // get the new record's id 
        $physaddrid = $this->model->get_max('honcho_user_addresses');
                 
        // Auditlog
        $type  = 'userupdate';
        $action = 'InsertPhysAddr';
        $func = 'users-usersubmit-3088';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$physaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Successfull';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);        
    }
    
}else{ // no address 1
// check to see if the tried to save anything else (other than the 3 default dropdowns) 
// and remind the address1 is required and do a retry with the form
// or just ignore and throw away the 3 dropdown defaults (00,00000,USA)and anything else 
    
// If no address 1 and just the defaults then save otherwise dont
$user_id = $userdata_post['id'];

/*
echo(2568);
echo('<br>');
print_r($user_id);
echo('<br>');
print_r(strlen($physaddrdata['address2']));
echo('<br>');
print_r(strlen($physaddrdata['city']));
echo('<br>');
print_r($physaddrdata['state']);
echo('<br>');
print_r(strlen($physaddrdata['zip']));
echo('<br>');
json($physaddrdata);
json($userdata_post); die(); 
*/

    // Since no address 1 and if just the defaults then delete, otherwise dont and will remain the same    
    if(strlen($physaddrdata['address2']) == 0 AND strlen($physaddrdata['city']) == 0 AND strlen($physaddrdata['zip']) == 0 AND $physaddrdata['state'] == '00'){
        $sql = "SELECT * FROM honcho_user_addresses WHERE user_id = $user_id AND type = 2"; 
        $paddrobj = $this->model->query($sql,'object'); 
        $deladdrid = $paddrobj[0]->id;
//echo(2582); 
//print_r($deladdrid); die();     
//json($maddrobj); die();
            if($deladdrid > 0){ // if editing a a user where address was already removed dont need to delete
                // run permanent delete query on users_addresses table
                $removeaddr1 = $this->model->delete($deladdrid, 'users_addresses');
                $flash_msg = $flash_msg.'The Physical Address was successfully removed. '; 

                set_flashdata($flash_msg);
                $flashmsgisset = 1; 
                $_SESSION['flashmsgcolor'] = 1; // green  
                                   
                // Auditlog
                $type  = 'userupdate';
                $action = 'DeletePhysAddr';
                $func = 'users-usersubmit-3144';
                $un   = 'UN: '.$_SESSION['user_username'];
                $format = 'minitime'; // I added to Timedate.php
                $this->module('timedate');            
                $timestamp = time();
                $time   = $this->timedate->get_nice_date($timestamp, $format);
                $time = $time.' UTC';
                $str3 = 'Rec: '.$physaddrid;
                $str4 = 'Tbl: users_addresses';
                $str5 = 'Successfull';
                $str6 = $_SESSION['usermode'];

                $this->module('system-auditlogger');
                $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            }
        
    }else{
        echo(2614); die();
        $flash_msg = $flash_msg.'Physical Address Line 1 is required to update an address.';

        set_flashdata($flash_msg);
        $flashmsgisset = 1; 
        $_SESSION['flashmsgcolor'] = 0; // red
                                           
        // Auditlog
        $type  = 'userupdate';
        $action = 'UpdatePhysAddr';
        $func = 'users-usersubmit-3180';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$physaddrid;
        $str4 = 'Tbl: users_addresses';
        $str5 = 'Failed - No addr1';
        $str6 = $_SESSION['usermode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
    }
}

/*      
echo(2648 ); 
echo('<br>');
print_r($physaddrdata['address1']);
echo('<br>');
print_r($physaddrid);
echo('<br>');
json($physaddrobj);
echo('<br>');
json($physaddrdata);
echo('<br>');
print_r($userstbldata['username']); die(); 
*/

//echo('3023 Addresses saved!'); die();   
    
// prepare to update Brevo        
$sms =  $userstbldata['mobile'];         
$sms = str_replace(' ', '', $sms);         
$sms = str_replace('-', '', $sms);
$sms = str_replace('(', '', $sms);
$sms = str_replace(')', '', $sms);
$sms = str_replace(',', '', $sms);
$sms = "+91".$sms;
//print_r($sms); die(); 
    
    
if(SYNC_BREVO == 1){          
echo(2675); die();
require APPPATH.'vendor/autoload.php';

$client = new \GuzzleHttp\Client();

$response = $client->request('PUT', 'https://api.brevo.com/v3/contacts/'.$_SESSION['current_email'], [
  'body' => '{"attributes":{"FIRSTNAME":"'.$userstbldata['first_name'].'", "LASTNAME":"'.$userstbldata['last_name'].'", "EMAIL":"'.$userstbldata['email_address'].'", "SMS":"'.$sms.'"}}',
  'headers' => [
    'accept' => 'application/json',
    'api-key' => BREVO_API_KEY,
    'content-type' => 'application/json',
  ],
]);
 
        // Auditlog
        $type  = 'brevoapicall';
        $action = 'UpdateCcmp';
        $func = 'users-usersubmit-3331';
        $un   = 'UN: '.$_SESSION['user_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: users';
        $str5 = 'Response: ';
       // $str5 = 'Response: '.$response;
        $str6 = $_SESSION['usermode'];
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
}

//echo(2708);
//print_r($recid); die();
        $recalc = $this->recalcstatus($recid);// line 8990 - nothing done with $recalc, just trigger.
//echo(2712); die();
        if(strlen($flash_msg) > 0){
    // stay with the message already set
}else{
        $flash_msg = $flash_msg.' The record was successfully updated.';
        set_flashdata($flash_msg);
        $flashmsgisset = 1; 
        $_SESSION['flashmsgcolor'] = 1; // green    
}

    }
    
//echo(2724); 
//print_r("Address Data Saved & status recalculated!"); die();

 //   echo(2727); 
 //   print_r($_SESSION['actionmode']); die();

               switch($_SESSION['actionmode']) {

                case 'updatemydata': // something changed it to change to updatemydata

                    $_SESSION['actionmode'] = 'viewmydata'; // change back to viewmydata
                    $this->viewuser($recid);

                break;
            
                case 'updateuser': // managing all users - view user
                      $_SESSION['actionmode'] = 'viewuser';
                      $this->viewuser($recid);

                break;
            
                case 'momu': // managing your subentity records - coming from manage or view pages

                    $_SESSION['usermode'] = 'momv';
                    $this->viewuser($recid);

                break;

                case 'mosu': // managing your subentity student records - coming from manage or view pages

                    $_SESSION['usermode'] = 'mosv';
                    $this->viewuser($recid);

                break;
            
                case 'mcmu': // managing current members - used for student members only
                      $_SESSION['usermode'] = 'mcmv';
                      $this->viewuser($recid);

                break;

              }


        }else{ // Passed Adding - only one place you add from and thats manage (camn). Show new record after adding.
//echo(3123); die();
                 // create a new trongate_user record, get the id and save as trongate_user_id
                 $usrlvl['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
                 $usrlvl['code'] = $this->_generate_rand_code();

                 $this->model->insert($usrlvl, 'trongate_users');

                 // get the new record's id and assign to $data array for the new record
                 $userstbldata['trongate_user_id']  = $this->model->get_max('trongate_users');
                 $userstbldata['code']              = $this->_generate_rand_code();                 

                 if($_SESSION['usermode'] == 'momc'){
                     // the subentity dropdown is disable for adding - need to assign subentity to that of subentity admin
                  // and overwrite the initialization of subentity at large dropdown - for mcmc & mamc
                     $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'honcho_user_accounts');
                     $chptnum = $usrobj->subentity;
                     $userstbldata['subentity'] = $chptnum; // this is where it s assigned when adding
                     $userstbldata['eligible_voter'] = 0; // let the system determine and update this field
                   }else{
                     $userstbldata['subentity'] = $_POST['subentity'];
                     $userstbldata['eligible_voter'] = 0; // let the system determine and update this field
                 }
//echo(3145);
//print_r($userstbldata['eligible_voter']); die();
//print_r($userstbldata['subentity']); die();
                 unset($userstbldata['recid']); // no recid passed to form when adding

                 // make the username = email
                 if(HONCHO_DEFAULT_USRNMEQEMAIL == 1){ // will overwrite anything typed in user field
                  $userstbldata['username'] = $userstbldata['email_address'];
                 }
                 $userstbldata['password']  = DEFAULT_CCMP_PASSWORD;
echo(2803);
print_r($userstbldata['username']); die();
      //$userstbldata['status']  = 0; // it will get recalculated after the save

      //echo('5181 about to insert a new users: ');
      //json($userstbldata); die();

      // status is always computed so should always be blank on a new record
      if(strlen($userstbldata['status'] < 1)){
          $userstbldata['status'] = 0;
      }

      $this->model->insert($userstbldata, 'honcho_user_accounts');
      //echo(5189); die();
       $new_id  = $this->model->get_max('honcho_user_accounts');
      //print_r($new_id); die();          
      //  unset($userstbldata['']);

    // All data saved at this point 
         $data  = $this->_get_a_single_record($new_id);    // anchor1           
         $data  = $this->_convert_to_user_friendly($data); // anchor3
         $recid = $new_id;
         //$data['recid'] = $new_id;


       switch($_SESSION['usermode']) {
// no mmdc - cant add own record

        case 'momc': // managing your subentity records - coming from manage or view pages
            $_SESSION['usermode'] = 'momv';
            $this->viewuser($recid);

        break;

        case 'mosc': // managing your subentity student records - coming from manage or view pages
            $_SESSION['usermode'] = 'mosv';
            $this->viewuser($recid);

        break;

        case 'mcmc': // managing current members - used for student members only
              $_SESSION['usermode'] = 'mcmv';
              $this->viewuser($recid);

        break;

        case 'mamc': // managing all members
              $_SESSION['usermode'] = 'mamv';
              $this->viewuser($recid);

        break;
      }

      } // end passed validation updating or adding

// never gets here because will be redirected by one of the cases above

  }else{  // failed a validation
// echo('3338 Failed validation either updating or adding '); die();
// could be from validation helper or any of the 3 checks above (email, username,member no).  
//print_r($recid); die();
      
      // if fail return to the crud form - send back the changes to the form
      // and initialize form with the posted values from this try.
      if($recid > 0){ // failed updating
    //    print_r($_SESSION['user_active_window']);
  //echo('3343 Failed validation updating'); die();
           $_SESSION['user_active_window'] =1; // needed ???
           $this->updateuser('yes'); // line 1760

        }else{ // failed adding
/*
  echo('5047 Failed validation adding');
  print_r($mcma); die();
*/
             $_SESSION['user_active_window'] =1; // was here. needed ???
             $this->createuser('yes');
          // redirect('honcho-users/createuser/yes/'.$mcma);

  //   echo('1723 Failed validation adding');


      } // failed adding or updating

  } // end passed or failed validation

// Successful save at this point
//echo(2885); die();
}  // if submit

//echo('Line 2476');
//print_r('nope not submit'); die();
// woulld execute view code if was a single form for viewing, adding, updating, and deleting.


} // end function

/*----------------------------------------------------------------------------*/
/*----------------------------- End usersubmit -------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------ function _USERS_FETCH_DATA_FROM_POST --------------------*/
/*----------------------------------------------------------------------------*/

    function _users_fetch_data_from_post() {  // anchor2
    // private function protected - attempt to direct access results in 404 error
    
    // Either a new or edited record could be posted to this function
    
    // All needed values to edit, create, or validate a record were passed to
    // the form to either visible or hidden controls.
     
    // Hidden controls are ones the user cannot, because of role or should not
    // because they are system controlled, edit - but may be needed to validate.
       
    // The posted values were named with the unique update/create field labels 
    // concatenated and with spaces, asterisks, or underscores removed by the form.
    
    // Cannot simply use the db field names as control names because the form may
    // have fields from several tables with the same name combined with the fact 
    // that fields are named on the fly using a loop as the controls are dynamically
    // created.
     
    // If you could db field names or if they were hard coded then this
    // section could be just one line: $data = $_POST; Those the user couldn't
    // edit would have been passed to and back to the controller by the hidden
    // fields unchanged.    

   // Get only the values returned by the form depending on the role's rights to
   // data by having a case for each role.
        
   // The cases dont have a "break;" so each one executes if you qualfy for that
   // case so your $data is built up and we dont have to repeat lines of code
   // that are the same in different cases. You will notice all admins have the 
   // last cas which includes the user because in the Core, an admin can edit
   // anything a user can. 
 
 //$_SESSION['actionmode'] = ''; // for testing
    switch ($_SESSION['actionmode']){ // 
  
     case 'mngsubentity': 
    
    // DB Field Names            Unique Label Names
    
    // user info
    $data['vip']               = post('vip', true); 
    $data['current_year']      = post('currentyear');  
    $data['eligible_voter']    = post('eligiblevoter', true);  
    $data['notes']             = post('notes');
    $data['subentity']         = post('subentity', true);    
    $data['subentity_role']    = post('subentityrole', true);   
    $data['national_officer']  = post('nationalofficer', true);
    $data['region']            = post('region', true); 
    $data['minor']             = post('minor', true);     
    $data['student']           = post('student', true); 
    
    // User Account
    $data['subentity_admin']   = post('subentityadmin', true);  
    $data['cms_admin']         = post('contentadmin', true);
    $data['admin']             = post('useradmin', true); 
    $data['student_admin']     = post('studentadmin', true);  
    $data['system_admin']      = post('systemadmin', true);
    $data['email_verified']    = post('emailverified', true);    
   
    $data['timed_reset']       = post('timedreset', true);  
    $data['reset_interval']    = post('resetinterval', true); 
           
     case 'updatemydata' || 'updateuser': // mngsubentity
     // DB Field Names             Unique Label Names  // $data[''] = post('', true);
        
    // user info
    $data['id']                = post('id', true); // passed from a hidden field
    $data['id_type']           = post('idtype', true); // needed to validated if email is required (some teens dont have)
    $data['deceased']          = post('deceased', true); // need to prove ok not to have emailaddress or username
    $data['id_number']         = post('employeeid', true); // to satisfy duplicate check  
    $data['username']          = post('username', true); // to satisfy duplicate check 
//print_r($data['id_number']); die();    
       
   // $data['dob']               = post('dob', true); // enable when put in date picker 
    $data['prefix']            = post('prefix');
    $data['first_name']        = post('first');     
    $data['middle_name']       = post('middle');  
    $data['last_name']         = post('last');  
    $data['suffix']            = post('suffix');
    $data['employer']          = post('employer');    
    $data['title']             = post('title');
    $data['gender']            = post('gender', true);  
    $data['birthday']          = post('birthday');      
    $data['department']        = post('department'); 
    $data['reports_to']        = post('supervisor'); 
    
    // Contacts
    $data['phone']             = post('phone');  
    $data['work_phone']        = post('workphone'); 
    $data['mobile']            = post('mobile');  
    $data['whatsapp']          = post('whatsapp');     
    $data['email_address']     = post('email');    
    $data['fax']               = post('fax');     
    $data['tty']               = post('tty');
    $data['use_alt_contact']   = post('usealtcontact', true);
    
    $data['alternate_contact'] = post('alternatecontact');    
    $data['alternate_phone']   = post('alternatephone'); 
    $data['alternate_email']   = post('alternateemail'); 
    
    $data['emergency_contact'] = post('emergencycontact');
    $data['emergency_phone']   = post('emergencyphone');
    $data['emergency_email']   = post('emergencyemail');
    
    // Addresses
    $data['mailaddress1']      = post('mailingaddr1');    
    $data['mailaddress2']      = post('mailingaddr2');
    $data['mailcity']          = post('mailingcity');
    $data['mailstate']         = post('mailingstate'); 
    
    $data['mailzip']           = post('mailingzip');
    $data['mailcounty']        = post('mailingcounty'); 
    $orgmailcounty             = post('orgmailingcounty');

// checkpoint
/*
echo(3371);
echo('<br>');
echo('mailcounty');
print_r($data['mailcounty']);
echo('<br>');
echo('orgmailcounty');
print_r($data['orgmailcounty']); die();
*/
    
if(strlen($data['mailcounty']) > 0){
}else{
    $data['mailcounty'] = $orgmailcounty;
}
    $data['mailcountry']    = post('mailingcountry');

    $data['mail_eq_phys']      = post('sameasmailing', true); 
    $data['physaddress1']      = post('physicaladdr1');    
    $data['physaddress2']      = post('physicaladdr2');
    $data['physcity']          = post('physicalcity');
    $data['physstate']         = post('physicalstate'); 
    $data['physzip']           = post('physicalzip');    
    $data['physcounty']        = post('physicalcounty'); 
    $orgphyscounty             = post('orgphysicalcounty');
    
// checkpoint
/*
echo(3558);
echo('<br>');
echo('physcounty');
print_r($data['physcounty']);
echo('<br>');
echo('orgphyscounty');
print_r($data['orgphyscounty']); die();
*/

if(strlen($data['physcounty']) > 0){
}else{
   
    $data['physcounty'] = $orgphyscounty;
    
}
    $data['physcountry']       = post('physicalcountry');
   
    // Miscellaneous
    $data['misc1']             = post('miscellaneous1');  
    $data['misc2']             = post('miscellaneous2');  
    $data['flags']             = post('flags');
    $data['alumnus']           = post('alumnus', true);     
    $data['active_duty']       = post('activeduty', true);  
    $data['former_military']   = post('formermilitary', true);
    
    // Preferences
    $data['limit_dir_info']    = post('limitdirinfo', true); 
    $data['directoryoptout']   = post('directoryoptout', true);    
    $data['emailoptout']       = post('emailoptout', true);
    $data['donotcall']         = post('donotcall', true);    
    $data['mail_notices']      = post('mailnotices', true);
    $data['language']          = post('language', true);    

    $data['force_pw_chg']      = post('forcepwchg', true); 
    $data['inactive']          = post('inactive', true);
    $data['locked']            = post('locked', true);  
         
    }
 
//echo(3436);
//json($data); die();

/* Unused
$data['tfontsize']         = post('tfontsize', true);
$data['website']           = post('website', true);  
$data['leadsource']        = post('leadsource', true);    
 */
 
 /* These are only changed by the application

// ccmo info
$data['status']         
// user acct
$data['id']
$data['username']
$data['level']     
$data['second_factor']      
$data['activate_code']  
$data['ip_address']
$data['last_login']
$data['last_login_device'] 
$data['last_logout']
$data['num_logins']
$data['password']    
$data['trongate_user_id'] 
$data['user_token'] 
$data['username']
$data['soft_deleted']
$data['picture']
$data['reset_code']
  
// Miscellaneous   
$data['updated_at']         
$data['updated_by']        
$data['created_at']       
$data['created_by']   
*/
    
// new records this is or could be blank
//echo(3478);
//json($_SESSION); die();

    if(strlen($data['id_number']) > 0 ){
// if one is subbmitted do nothing
    }else{

         // USERS_IDNUM_REQ if it is required
             if(USERS_IDNUM_REQ == 1 ){
                $token_length = 5;
                $characters = '23456789abcdefghjkmnpqrstuvwxyz';
                $random_code = '';
                for ($i = 0; $i < $token_length; $i++) {
                    $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
                }

                $data['id_number'] = 'temp-'.$random_string; 
             }
//echo(3148); die();
//print_r($data['id_number']); die(); 
    } 

        if(strlen($data['current_year']) > 0) {
// do nothing
        }else{               
                 $data['current_year'] = $_SESSION['users_current_year'] - 1;         
        }

        if(strlen($data['language']) > 0) {
// do nothing
        }else{               
                 $data['language'] = 1;         
        }               
            
// checkpoint
/*        
echo(3166);
echo('<br>');
echo('Filtered posted data');
echo('<br>');
json($data); die();
*/
    return $data;  // returns to anchor2 

    }

/*------------------------------------------------------------------------------------------------
/*--------------------------- function _ADDR_FETCH_DATA_FROM_POST -------------------------------
/*------------------------------------------------------------------------------------------------
    function _addr_fetch_data_from_post() {
    // private function protected - 404 error
//echo(5483);
//json($_POST); die();

 //   $mailaddr_obj = $this->model->get_one_where('id', $mailrecid, 'users_addresses');
//echo(5481);
//json( $mailaddr_obj); die();  

    $mailaddrdata['address1']      = post('mailaddr1', true);
    $mailaddrdata['address2']      = post('mailaddr2', true);
    $mailaddrdata['city']          = post('mailcity', true);
    $mailaddrdata['state']         = post('mailstate', true);
    $mailaddrdata['zip']           = post('mailzip', true);
echo(5495);
json($mailaddrdata); die();
    $physaddrdata['address1']      = post('physicaladdr1', true);
    $physaddrdata['address2']      = post('physicaladdr2', true);
    $physaddrdata['city']          = post('physicalcity', true);
    $physaddrdata['state']         = post('physicalstate', true);
    $physaddrdata['zip']           = post('physicalzip', true);
echo(5502);
json($physaddrdata); die();




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
*/
    
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
    
/*----------------------------------------------------------------------------*/
/*---------------- function _FINANCIAL_FETCH_DATA_FROM_POST ------------------*/
/*----------------------------------------------------------------------------*/

  function _financial_fetch_data_from_post() {
    // private function protected - 404 error
//echo(5842);
//json($_POST); die();
    // Financial Table

  //  $data['fin_id']             = post('fin_id', true);                                       
  //  $data['fin_code']           = post('fin_code', true);                                     
  //  $data['user_id']            = post('user_id', true);
                                 
  //  $data['acct_bal']           = post('acct_bal', true); 
  // only viewing not getting for now                                                                          
    $data['fin_email']          = post('billingemail', true);                                      
    $data['billname']           = post('billtoname', true);                                     
    $data['billphone']          = post('billtophone', true);                      
    $data['billaddress1']       = post('billaddress1', true);                                   
    $data['billaddress2']       = post('billaddress2', true);                                   
    $data['billcity']           = post('billcity', true);                                     
    $data['billstate']          = post('billstate', true);                                      
    $data['billzip']            = post('billzip', true); 

    $data['shipname']           = post('shiptoname', true);                                     
    $data['shipphone']          = post('shiptophone', true);                      
    $data['shipaddress1']       = post('shipaddress1', true);                                   
    $data['shipaddress2']       = post('shipaddress2', true);                                   
    $data['shipcity']           = post('shipcity', true);                                     
    $data['shipstate']          = post('shipstate', true);                                      
    $data['shipzip']            = post('shipzip', true);

    $data['fin_acct_type']      = post('fin_acct_type', true);   
    $data['fin_status']         = post('fin_status', true);

    $data['fin_notes']          = post('fin_notes', true);


                                    
/*  $data['fin_date_created']   = post('fin_date_created', true);                                 
    $data['fin_created_by']     = post('fin_created_by', true);
    $data['fin_updated_by']     = post('fin_updated_by', true);
    $data['fin_created_at']     = post('fin_created_at', true);
    $data['fin_updated_at']     = post('fin_updated_at', true); 
*/

    $fin_billship     = post('fin_billship', true);
 //   print_r($fin_billship); die();

    If($fin_billship == 1){
      $data['fin_billship'] = 1;

      $data['shipname']           = $data['billname']  ;                                     
      $data['shipphone']          = $data['billphone'];                      
      $data['shipaddress1']       = $data['billaddress1'];                                   
      $data['shipaddress2']       = $data['billaddress2'];                                   
      $data['shipcity']           = $data['billcity'];                                     
      $data['shipstate']          = $data['billstate'];                                      
      $data['shipzip']            = $data['billzip'];

    }else{
      $data['fin_billship'] = 0;  
    }

    $fin_inactive     = post('fin_inactive', true);

/*
echo('Line 1035 - Fetch Financial Data From Post:  '); 
echo('<br>');
json($findata); die();

*/
//echo('1384');
  //  print_r($data);

 //   $convdata = $this->_convert_posted_fintbl_to_numerics($data);
 // print_r($convdata); die();
 //   $data = array_merge($data, $convdata);
//echo('Line 1395');
//print_r($data); die();

      return $data;  // goes to 310 & 
    }

    
/*----------------------------------------------------------------------------*/
/*---------------- function _CONVERT_POSTED_FINTBL_TO_NUMERICS ---------------*/
/*----------------------------------------------------------------------------*/    
    
  function _convert_posted_fintbl_to_numerics($data = NULL) {  // posted data must be converted to save to DB or sent back to create form on failed validation
    // private function protected - 404 error  

   $finobj = $this->model->get_one_where('fin_type_title',$data['fin_acct_type'],'users_financial_types');
 //  echo('1405 ');
 //  print_r($finobj); die();
   $data['fin_acct_type'] = $finobj->id;

   $finobj2 = $this->model->get_one_where('fin_status_title',$data['fin_status'],'users_financial_statuses');
  // echo('1410 ');
  // print_r($finobj2); die();
   $data['fin_status'] = $finobj2->id;

   return $data;

}

 
// -------------------------------------------------------------------------- //
// ---------------------  function _get_subentity_data ---------------------- //
// -------------------------------------------------------------------------- //
  
   function _get_subentity_data() { 
 // protected - get 404 error if not logged in

//print_r($_SESSION['user_rec_id']); die();
          $userobj = $this->model->get_one_where('id', $_SESSION['user_rec_id'], 'honcho_user_accounts'); 

//print_r($userobj); die();
          $subentityid              = $userobj->subentity;
 //print_r($subentityid); die();         
          $subentityobj             = $this->model->get_where($subentityid,'users_subentities');
          $data['subentity_name']   = $subentityobj->description;
          $data['subentity']        = $subentityobj->id;
          $data['userhomepage']   = $subentityobj->userhomepage;

          return $data;
    }

// -------------------  function end _get_subentity_data -------------------- //
     
// -------------------------------------------------------------------------- //
// ------------------- function _CREATE_DROPDOWN_MENUS ---------------------- //
// -------------------------------------------------------------------------- //
  
function _create_dropdown_menus(){

    // genders
    $data['genders'] = $this->model->get('id','ref_genders'); 

    // subentitys
    $data['subentities'] = $this->model->get('id','honcho_user_subentities'); 

    // subentity roles
    $data['usersubentityroles'] = $this->model->get('id','honcho_subentity_offices'); 

    // national roles
    $data['nationalroles'] = $this->model->get('id','ref_national_offices'); 

    // states
    $data['state_codes'] = $this->model->get('id','ref_states'); 

    // membership types
    $data['usertypes'] = $this->model->get('id','honcho_user_types');    



    // Highest Certificate
 //   $data['highestcerts'] = $this->model->get('id','users_certificate_types');


    // Financial Acct Types
    $data['accttypes'] = $this->model->get('id','users_financial_types'); 


    // Financial Acct Status
    $data['finstatuses'] = $this->model->get('id','users_financial_statuses');      
 echo(3417);
    json($data); die();   
  return $data;  
    
}

// ------------------- end _CREATE_DROPDOWN_MENUS ---------------------- //
// 
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

  // -------------------------------------------------------------------------- //
// ------------------------ function GETDATA AJAX ------------------------ //
// -------------------------------------------------------------------------- //
  
  function getmailcntydata() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.
    // Only way to see any values here is in Developer Tools in Chrome. json, print_r, echo, etc die(); wont work!
    // Go to Chrome Network, clear, click on Name: getcntydata. Then Payload: mailingstate: {value posted}
      
      if(isset($_POST['mailingstate'])){
          $mstid = $_POST['mailingstate'];
 
          $sql = "SELECT * FROM ref_counties WHERE state = '$mstid'"; 
          $mailcntys = $this->model->query($sql,'array');

        // var_dump($mailcntys); // wont see on screen, look in Chrome Name: getcntydata. Then Reponse: (array)
         //  $mailcntys = (array) $mailcntys;
          
         if($mailcntys !=NULL){
            // echo '<option>Select County</option>';
             foreach($mailcntys as $cnty){
                 echo '<option value="'.$cnty['fips'].'">'.$cnty['title'].'</option>';
                 
             }
         }else{
                 echo '<option>No Counties Found</option>';
                 
         } 
         
      }
      
  
  }

// ------------------------ end getmailcntydata ajax ------------------------ //

    function getphyscntydata() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.
    // Only way to see any values here is in Developer Tools in Chrome. json, print_r, echo, etc die(); wont work!
    // Go to Chrome Network, clear, click on Name: getcntydata. Then Payload: mailingstate: {value posted}
      
      if(isset($_POST['physicalstate'])){
          $pstid = $_POST['physicalstate'];
 
          $sql = "SELECT * FROM ref_counties WHERE state = '$pstid'"; 
          $physcntys = $this->model->query($sql,'array');

        // var_dump($physcntys); // wont see on screen, look in Chrome Name: getcntydata. Then Reponse: (array)
         //  $physcntys = (array) $mailcntys;
          
         if($physcntys !=NULL){
            // echo '<option>Select County</option>';
             foreach($physcntys as $pcnty){
                 echo '<option value="'.$pcnty['fips'].'">'.$pcnty['title'].'</option>';
                 
             }
         }else{
                 echo '<option>No Counties Found</option>';
                 
         } 
         
      }
      
  
  }

// ------------------------ end getphyscntydata ajax ------------------------ //
// 
// -------------------------------------------------------------------------- //
// ------------------------ function FETCHCNTYS AJAX ------------------------ //
// -------------------------------------------------------------------------- //
  
  function fetchcntys() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.

    $mstid     = post('mstid');  
  //$mailcntys = $this->model->get_where_custom('state', $_POST['mstid'] ,'=', 'id', 'ref_counties'); 
    $mailcntys = $this->model->get_where_custom('state', $mstid ,'=', 'id', 'ref_counties');  
   // $mailcntys = (array)$mailcntys;
    
    echo  $mailcntys;
  }

// ------------------------ end fetchcntys ajax ----------------------------- //
  
/*----------------------- Function createuseruseraccount ---------------------*/

function createuseruseraccount($reposted=NULL){ // may be first time or with values after failed validation


  $recid    = segment(3); // 
  $_SESSION['returnto'] = segment(4); // if come from the manage page vs. view page - is this used ???

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//echo(4979);
//print_r($recid); die();

//print_r($_SESSION['returnto']; die();

// Get subentity name for the page header
//print_r($_SESSION['tg_user_id']); die();

//print_r($data); die();
$reposted = 0; // ???
/*-------------------------------- Set create page values ----------------------------------------*/
if($reposted > 0){ // if this is a subsequent try at adding after a failed validation

  $recid = $reposted;
  //echo('2639:');
//print_r($recid); die();

        // Reinitialize dropdowns to prior value from a failed add if it exists
        // so user wont have to reselt. If first attempt at adding they wont exist.
        // will exist on future add attempts 
        // Note: Yes/No and field values are reset by recalling _fetch_data_from_post()
// Search create.php for for "foreach" to find them

//echo('1273 member type:') ;
//print_r($data['id_type']); die();

// subentity admin, aircraft owner, accout type
/*
        $data['genderid']      = $data['gender'];
        $data['subentityid']     = $data['subentity'];
        $data['membertypeid']  = $data['id_type'];
        $data['subentityroleid'] = $data['subentity_role'];
        $data['mailstateid'] = $data['mailstate'];
        $data['physstateid'] = $data['physstate'];
        $data['highestcertid'] = $data['highest_certificate'];
        $data['accttypeid']    = $data['fin_acct_type'];
        $data['finstatusid']   = $data['fin_status'];
        $data['physstateid'] = $data['billstate'];
        $data['shipstateid'] = $data['shipstate'];
*/
        // User Level is not surfaced for update
        // $data['usrlvlid']   = $data['user_level_id'];

//echo('line 1243');
//print_r($data['accttypeid'] ); die();

}else{ // Set default values for new records

        $data['password'] = DEFAULT_CCMP_PASSWORD;
        // Subentity Id
        $data['subentity'] = $subentityobj->id; // dropdown not shown for new records
        $data['recid']   = $recid;

        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
        $data['first_name'] = $usrobj->first_name;
        $data['last_name'] = $usrobj->last_name;
        $data['email_address'] = $usrobj->email_address;
        $data['eligible_voter'] = 0;
        $data['minor'] = 0;
        $data['national_officer'] = 10;
        //Dropdowns
        // Gender - Let it default to male
        // $data['membertypeid '] = 1; Let it default to regular
     /*   
        $data['subentityroleid'] = 10; // regular member
        $data['mailstateid'] = 'NA'; // Unknown - using code and not id
        $data['physstateid'] = 'NA'; // Unknown
        $data['highestcertid'] = 14; // none
        $data['accttypeid']    = 1; // Personal financial acct
        $data['finstatusid']   = 9; // Unused - account never been used
        $data['physstateid'] = 'NA'; // Unknown
        $data['shipstateid'] = 'NA'; // Unknown
        */
}

/*------------------------- Populate Dropdowns  ------------------------------*/
/*        
        // membership types
        $data['usertypes'] = $this->model->get('id','users_types');    

        // certificate types
        $data['cert_titles'] = $this->model->get('id','users_certificate_types'); 

        // subentitys
        $data['subentitys'] = $this->model->get('id','users_subentities'); 

        // subentity roles
        $data['subentityroles'] = $this->model->get('id','users_subentity_offices'); 

        // states
        $data['state_codes'] = $this->model->get('id','ref_states'); 

        // genders
        $data['genders'] = $this->model->get('id','genders'); 

        // Highest Certificate
        $data['highestcerts'] = $this->model->get('id','users_certificate_types');

        // Financial Acct Types
        $data['accttypes'] = $this->model->get('id','users_financial_types'); 

        // Financial Acct Status
        $data['finstatuses'] = $this->model->get('id','users_financial_statuses'); 
*/

if(SKIP_CHG_DEFAULT_USERNAME == 1){ // currently set to 1

//unset($data['eligible_voter']); // where did this come from ???
//echo('line 3943 ');
//print_r($data); die();

  $this->useruseracctsubmit($data);

 }else{ 

    $data['bc1'] = CCMPSSUBENTITY.' Admin';
    $data['bc2'] = 'Create User Account';
    $data['view_module']   = 'honcho/users';
    $data['view_file']     = 'useruseracctcreate'; // 
//echo('line 2263 ');
//print_r($data); die();
    $this->templates->inspinia($data);
}

}

/*------------------ End function createuseruseraccount ----------------------*/

/*----------------------- Function useruseracctsubmit ------------------------*/


function useruseracctsubmit($data = NULL){ // subentity admin on computer needs edit/create form create.php

// print_r($rid); die();

if(SKIP_CHG_DEFAULT_USERNAME == 1){
  $_POST = $data; // fool it to think it was posted 
  $recid = $data['recid'];
  $submit = 'Submit';
}else{ 
  $recid = post('id', true);// get user number to add user account to
  $submit = post('submit', true);
}

/*  
  print_r($recid);
 die();
*/  


//$fn    = post('first_name', true);
   //   print_r($fn); die();

//print_r($_POST); die();

  if ($submit == 'Submit') { // in case where use the same form for viewing, updating and creating (we are not). If viewing OR updating or creating

// echo('Line 3989 - submit == Submit'); die();

//print_r($_POST); die();
// using JS
          //a check for duplicate member number below also can check if required
          //a check for duplicate emai addrees below also checks for required but this one checks format
       //   $this->validation_helper->set_rules('email_address', 'Contact Email', 'required|valid_email'); // optional I check for it below
          // will make username the email address later if left blank
        //  $this->validation_helper->set_rules('username',      'Username', 'required|min_length[5]');
      // validate the form - if it fails to will keeep executing
     //   $result = $this->validation_helper->run(); 
$result = 1;

//print_r($result); die();
        // dont do anything yet if failed because still need to cobble together what was posted and send back to the form
        // converted to numerics - $_POST returns Yes/No unconverted. So intercept at the save and redirect because was
        // converted for the save to the DB

        // Grab the user table data from the post
      //  $userdata_post = $this->_users_fetch_data_from_post(); // anchor2 - users table
   
        $userdata_post['email_address']   = post('email_address', true);
 
//print_r($userdata_post); die(); 
        $update_id = $recid;  // came in the URL not POST
//echo(2792);
//print_r($update_id); die();
//echo('Line 1378');
//print_r($userdata_post['subentity_admin']); die();

//print_r($userdata_post['subentity']); die(); //subentity id passed when updating but not adding cause disabled - added below

//echo('Line 684');
//print_r($userdata_post); die();
//print_r($userdata_post['password']); die();
//echo('Line 579');


// passed framework available validations now checking for uniqueness
//print_r('passed validation'); die();

        //echo('Line 582');
      //  $userdata_post = $this->_user_fetch_data_from_post(); // still users table
    //    $userdata_post['username']     = post('username', true);
    //    $userdata_post['locked']       = post('locked', true);
    //    $userdata_post['force_pw_chg'] = post('force_pw_chg', true);
       

       // print_r($userdata_post); die();

// check to see if the email address is already taken - somebody could attempt to change theirs to one that exists already
      
        $emadr = $userdata_post['email_address']; // member id card not record number

        if(strlen($emadr) > 0){ // if the user submitted a username - otherwise it will match on blank records
                  
            $emadr     = trim($emadr);
            // here we are trusting no duplicates to start with so if found should only be one
            // so it either belongs to user you want to create an account for or not
//  print_r($emadr); die();

/*         
            // cant just do a scan to see if it shows up (already taken) because your record will show and
            // there could be a dup that comes after your record unless you trust that the system has ensured uniqueness
            // Only duplicate if uploaded duplicates because system wont let you save a duplicate
            $emadrsql  = "SELECT * FROM users WHERE email_address = '$emadr' AND deceased != 1";
            $emadrs    = $this->model->query($emadrsql,'array');
//print_r($emadrs); die();            
            $numemadrs = count($emadrs,COUNT_NORMAL); // need to see how many times it is in table
//print_r($numemadrs); die();


    switch ($numemadrs){ 

    case '1': // need to find out if the one is yours then thats ok to use as your username

    case '2':

    case '3':
    // it is definitely already exist and duplicated
// print_r($numemadrs); die();
    break;
    }
*/

    $usr_obj = $this->model->get_one_where('email_address', $emadr, 'honcho_user_accounts');
    $username = $usr_obj->first_name.' '.$usr_obj->last_name;
   // echo(2680);
  //  print_r($username); die();
  //print_r($usr_obj); die();
    $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();

          if($recordfndid > 0){ // record found id exists so there is a user with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed
            // if there is no update_id then you are adding so it is not ok to find a duplicate
            if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate

              // its the same record being edited so everything OK
              // nothing to do here just keep executing
           //   echo('Found but Everything OK'); die();

            }else{ 
            //  echo('Found but not OK'); die();
              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $result = 0;  // failed validation

              $flash_msg = 'The Email Address is already taken '; //. <= $recordfndid 
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

            } // will keep executing
            
          } // the email address wasn't found so unique - keep executing
         // print_r('no duplicate found'); die();

        }else{ 
              $result = 0;  // failed validation

            //  $flash_msg = 'The Email Address is required.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;
  //print_r('1416 no username'); die();

        } 
//echo('5127 all good - no duplicate email'); die();

// check to see if the username is already taken - somebody could attempt to change theirs to one that exists already
        $usrnm = $userdata_post['username'];
//echo('5477');          
//print_r($usrnm); die();
        if(strlen($usrnm) > 0){ // if the user submitted a username - otherwise it will match on blank records
                  
          $usernm = trim($usrnm);

          $usr_obj = $this->model->get_one_where('username', $usernm, 'honcho_user_accounts');
 // print_r($usr_obj); die();
                     
          $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
          if($recordfndid > 0){ // record found id exists so there is a user with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed
            // if there is no update_id then you are adding so it is not ok to find a duplicate
            if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate

              // its the same record being edited so everything OK
              // nothing to do here just keep executing
     //         echo('Found but Everything OK'); die();

            }else{ 
//echo('Found but not OK'); die();
              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $result = 0;  // failed validation

              $flash_msg = 'The Username already exists.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

            } // will keep executing
            
          } // the username wasn't found so unique - keep executing
         // print_r('no duplicate username found'); die();

        }else{ // no username entered
//echo('2432 no username entered'); die();
            // when adding the username is set to the email address
          // by here we have validated that an email exist and properly formatted and not duplicated

//echo(2980);
//print_r($userdata_post['email_address']); die();

             // make the username = email also see line 1658
         if(HONCHO_DEFAULT_USRNMEQEMAIL == 1){ // 
     
            if(strlen($userdata_post['email_address']) > 0){

                $userdata_post['username'] = $userdata_post['email_address'];

            }else{
          
              $result = 0;  // failed validation

              $flash_msg = $flash_msg.' A Username is required and no email address is available.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;
              
            }
        }else{
              $result = 0;  // failed validation

              $flash_msg = ' A Username is required.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

        }

      } 
   
      /*  unset($userdata_post['approved']);
        unset($userdata_post['confirmed']);
        unset($userdata_post['timed_reset']);
        unset($userdata_post['reset_interval']);
        unset($userdata_post['inactive']); */
//echo(3017);
//print_r($userdata_post); die();
echo('users 5146 obselete $userdata_post'); die();
        // add the user account data
        $userstbldata = array_merge($userdata_post,$userdata_post); // combine for users table

        $userstbldata['updated_by'] = $_SESSION['tg_user_id'];
        $userstbldata['updated_at'] = TIME();

//echo('2505: ');
//print_r($result); die();
  if($result > 0){ // if passed all validations above - save the updated record

         $usrlvl['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
         $usrlvl['code'] = $this->_generate_rand_code();
         // create a new trongate_user record, get the id and save as trongate_user_id

         $this->model->insert($usrlvl, 'trongate_users');

         // get the new record's id and assign to $data array for the new record
         $userstbldata['trongate_user_id']  = $this->model->get_max('trongate_users');
         $userstbldata['code'] = $this->_generate_rand_code();

         // make the username = email
         if(HONCHO_DEFAULT_USRNMEQEMAIL == 1){ // will overwrite anything typed in user field
          $userstbldata['username'] = $userstbldata['email_address'];
         }
          $userstbldata['password'] = DEFAULT_CCMP_PASSWORD;

//print_r($userstbldata); die(); 

        unset($userstbldata['recid']); // not in any DB - will break update query

        unset($userstbldata['email_address']); // dont want to overwrite
        unset($userstbldata['locked']); // is commented out on create account page

//echo('4200 about to update users: ');
//print_r($userstbldata); die();        
        $this->model->update($recid, $userstbldata, 'honcho_user_accounts');
        $recalc = $this->recalcstatus($recid);// nothing done with recalc, just trigger.
 
 //print_r("CCMPS Data Saved!"); die();
//echo(4205);
       // print_r($username); die();
//print_r($_SESSION['returnto']); die(); // not used

/* not used
        if($_SESSION['returnto'] == 'manage') { // can call create acct from manage or view page

            $flash_msg = 'A User Account was successfully created for '.$username.'.';
          //   print_r($flash_msg); die();
           //   $flash_msg = 'A User Account was successfully created.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;


            switch($_SESSION['usermode']) {

              case 'momm': // managing your subentity records

            //  echo(2851); die();
                    redirect('honcho-users/manage/momm');

              break;

              case 'mcmm': // managing current members
                    redirect('honcho-users/manage/mcmm');

              break;

              case 'mngallusers': // managing all members
                    redirect('honcho-users/manage/mngallusers');

              break;

              default;



              }
*/
    /*    }else{ */

            $flash_msg = 'A User Account was successfully created for '.$username.'.';
            set_flashdata($flash_msg);
            $flashmsgisset = 1;
   /*    } */
/*
  echo(4278);
  print_r($_SESSION['returnto']);
  print_r($recid);
   die();
*/
        if(SKIP_NEW_ACCT_CONFIRMATION == 1) {
  //echo(4254); die();

            if($_SESSION['returnto'] == 'manage'){

            

            switch($_SESSION['usermode']) {

              case 'momm': // managing your subentity records


                    redirect('honcho-users/manage/momm');

              break;

              case 'mosm': // managing your student subentity records


                    redirect('honcho-users/manage/mosm');

              break;
          
              case 'mcmm': // managing current members - used for student members only
                    redirect('honcho-users/manage/mcmm');

              break;

              case 'mngallusers': // managing all members
                    redirect('honcho-users/manage/mngallusers');

              break;

              default;

              }
          }else{ // = 'view'
            // threfore will never skip the view record when add an account to a record
          // setting the tab so with open user account upon returning
              $flash_msg = 'A User Account was successfully created for '.$username.'.';
              set_flashdata($flash_msg);
              $flashmsgisset = 1;

              $_SESSION['user_active_window'] = 4;
              redirect('honcho-users/viewuser/'.$recid.'/4');

          }

        }else{
          $_SESSION['user_active_window'] = 4;
          redirect('honcho-users/viewuser/'.$recid);

        }


         
            // All data saved at this point 
/*
            $data          = $this->_get_a_single_record($recid); // anchor1
            $data          = $this->_convert_to_user_friendly($data); // anchor3

        $data['recid'] = $recid;

            $data['view_module']   = 'honcho/users';
            $data['view_file']     = 'usercrud'; // 
       // } 

        $this->templates->inspinia($data);
*/

  }else{  // failed a validation

               $result = 0;  // failed validation

           //   $flash_msg = ' A Contact Email is required.';
           //   set_flashdata($flash_msg);

              $flashmsgisset = 1;
  redirect('honcho-users/createuseruseraccount/'.$recid);



  } // end passed or failed validation

// Successful save at this point
//echo('919 Successful Update'); 

//print_r($recid); die();

   //     $data   = $this->_get_a_single_record($recid); // anchor1 - returns array - values not codes

   //     $data['recid'] = $recid; // need to be paased to form for update button
//print_r($data); die();
   //     $view = "view"; // Bare login page login.php called instead of application dashboard dashboard.php
  //      $this->view($view, $data);
        //echo('930 went past view?'); die(); reset password came here. did I delete too much from view? saved in temp2.php




}  // if submit



} // end function

/*--------------------------- End useruseracctsubmit -------------------------*/
 
/*--------------------------- Function currentroster -------------------------*/

    function currentroster($posterid = null) {  // this is the subentity directory on the sidemenu - posterid comes from bulletin link
 // protected - get 500 error if not logged in
    $usersfunction = 'currentroster';
    $authorized = $this->_check_function_permissions($usersfunction); 

      $recid      = $_SESSION['user_rec_id'];

      if($recid < 1){ // session expired - not logged in
        $this->login(); // ???
      }

      $userobj    = $this->model->get_one_where('id', $recid, 'honcho_user_accounts'); 
      $subentity  = $userobj->subentity;
 //     print_r($subentity );die();
//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();

      // get the particulars of the person logged in
      $user_array   = $this->_get_a_single_record($recid); // anchor1 - returns array - values not codes
 //     print_r($user_array); die();
  
      $subentity_role = $user_array['subentity_role'];
   

      $thisdate = time();

//      $todaysdate = $this->timedate->get_nice_date($thisdate, $format); // 09/30/2022


//print_r($posterid); die();

      $currentyear  = $_SESSION['users_current_year'];

    if($currentyear < 2023){
        $currentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-currentroster-1225';
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
      $currentyear  = $currentyear - 1; // since using > in query
   //   print_r($subentity); die();
      // get the roster records from user table for the subentity number
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        //  $data['usersrecs']      = $this->model->get('last_name','honcho_user_accounts'); // works manage
      if($posterid > 0){
      //  echo(1009); die();
        $sql = "SELECT * FROM honcho_user_accounts WHERE id = $posterid"; // temporary until national directory - just for demo - put result in popup???
       }else{ 
          $sql = "SELECT * FROM honcho_user_accounts WHERE subentity = $subentity AND deceased != 1  AND soft_deleted != 1 AND current_year > $currentyear OR  subentity = $subentity AND deceased != 1  AND soft_deleted != 1 AND status = 2 ORDER BY last_name";
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity AND deceased < 1 AND current_year > $currentyear "; // for read only roster
       }
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
      $data['usersrecs'] = $this->model->query($sql,'object');
  
 //print_r($data['usersrecs']); die();
          foreach($data['usersrecs'] as $row) { // step through the array of records and pull out needed values
           
              $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
              $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users
  
              /*------------------ Change values to display descriptions instead of codes -----------------*/ 
  
              // Change codes to names
  
              $highcert                 = $row->highest_certificate;  // get the integer
              $highcertobj               = $this->model->get_where($highcert,'users_certificate_types'); // use the integer to get the object
              $row->highest_certificate = $highcertobj->description; // reset the value from integer to string from the object
  
              $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
              $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
              $levelname = $levelobj->level_title;  // capture the level name
              // now we need to insert the levelnames in the array for display
              $row->levelname = $levelname;
  
              $memtypeid        = $row->id_type;
              $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
              $row->id_type = $memtypeobj->id_type;

              $natoffcrid            = $row->national_officer;
              $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
              $row->national_officer = $natoffcrobj->description;

              $statusid    = $row->status;
              $statusobj   = $this->model->get_where($statusid,'users_status');
              $row->status = $statusobj->title;

              $actypeid           = $row->aircraft_type;
              $actypeobj          = $this->model->get_where($actypeid,'aircraft_types');
              $row->aircraft_type = $actypeobj->name;

              $subentityrole    = $row->subentity_role;
              $subentityobj   = $this->model->get_where($subentityrole,'users_subentity_offices');
              $row->subentity_role = $subentityobj->description;
  
              $subentityid    = $row->subentity;
              $subentityobj   = $this->model->get_where($subentityid,'users_subentities');
              $row->subentity = $subentityobj->description;
  
              $fintypeid          = $row->fin_acct_type;
              $fintypeobj         = $this->model->get_where($fintypeid ,'users_financial_types');
              $row->fin_acct_type = $fintypeobj->fin_type_title;
  
              $finstatusid     = $row->fin_status;
              $finstatusobj    = $this->model->get_where($finstatusid,'users_financial_statuses');
              $row->fin_status = $finstatusobj->fin_status_title;
  
              $this->module('timedate');
              $format = 'datepicker_us';
              $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);
  
              if($row->updated_at == '01/01/1970'){
                $row->updated_at = ' ';
              }
  
              // Get the address data
              $recid = $row->id;
              $addrdataobj = $this->model->get_one_where('user_id',$recid,'users_addresses');
  
              $row->mailaddress1 = $addrdataobj->mailaddress1;
              $row->mailaddress2 = $addrdataobj->mailaddress2;
              $row->mailcity     = $addrdataobj->mailcity;
              $row->mailstate    = $addrdataobj->mailstate;
              $row->mailzip      = $addrdataobj->mailzip;

              $row->physaddress1 = $addrdataobj->physaddress1;
              $row->physaddress2 = $addrdataobj->physaddress2;
              $row->physcity     = $addrdataobj->physcity;
              $row->physstate    = $addrdataobj->physstate;
              $row->physzip      = $addrdataobj->physzip;  
          }
  
              $data['subentity_name']  = $subentity_name;
              $data['view_module']   = 'honcho/users';
              $data['view_file']     = 'currentroster'; // read only roster

              $data['bc1'] = 'MSP';
              $data['bc2'] = CCMPSSUBENTITY.'Roster';

              $this->templates->inspinia($data);
    }
 
/*---------------------------- End currentroster -----------------------------*/
     

/*------------------------- Function currentdirectory ------------------------*/

    
    function currentdirectory($posterid = null) { // National Directory of Current Members

    $usersfunction = 'currentdirectory';
    $authorized = $this->_check_function_permissions($usersfunction); // can see a member if pass record id without this check

      $thisdate = time();

      //*----------------- Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//print_r($posterid); die();

      $syscurrentyear  = $_SESSION['users_current_year'];

    if($syscurrentyear < 2023){
        $syscurrentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-currentdirectory-1355';
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

      $currentyear  = $syscurrentyear - 1; // since using > in query
      // get the roster records from user table for the subentity number
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        //  $data['usersrecs']      = $this->model->get('last_name','honcho_user_accounts'); // works manage

      if($posterid > 0){
        $sql = "SELECT * FROM honcho_user_accounts WHERE id = $posterid"; // just for demo - put result in popup???
       }else{ 
          $sql = "SELECT * FROM honcho_user_accounts WHERE deceased != 1 AND directoryoptout != 1  AND soft_deleted != 1 AND current_year > $currentyear OR deceased != 1 AND directoryoptout != 1  AND soft_deleted != 1 And status = 2";
 //         echo(787); die(); // for national directory
       }
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
      $data['usersrecs']  = $this->model->query($sql,'object');
 // print_r($currentyear); die();
 // print_r($data['usersrecs']); die();
          foreach($data['usersrecs'] as $row) { // step through the array of records and pull out needed values
           
              $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
              $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users
  
              /*------------------ Change values to display descriptions instead of codes -----------------*/ 
  
              // Change codes to names
  
              $highcert                 = $row->highest_certificate;  // get the integer
              $highcertobj               = $this->model->get_where($highcert,'users_certificate_types'); // use the integer to get the object
              $row->highest_certificate = $highcertobj->description; // reset the value from integer to string from the object
  
              $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
              $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
              $levelname = $levelobj->level_title;  // capture the level name
              // now we need to insert the levelnames in the array for display
              $row->levelname = $levelname;
  
              $memtypeid        = $row->id_type;
              $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
              $row->id_type = $memtypeobj->id_type;

              $actypeid           = $row->aircraft_type;
              $actypeobj          = $this->model->get_where($actypeid,'aircraft_types');
              $row->aircraft_type = $actypeobj->name;

              $subentityrole    = $row->subentity_role;
              $subentityobj   = $this->model->get_where($subentityrole,'users_subentity_offices');
              $row->subentity_role = $subentityobj->description;
  
              $subentityid    = $row->subentity;
              $subentityobj   = $this->model->get_where($subentityid,'users_subentities');
              $row->subentity = $subentityobj->description;
  
              $fintypeid          = $row->fin_acct_type;
              $fintypeobj         = $this->model->get_where($fintypeid ,'users_financial_types');
              $row->fin_acct_type = $fintypeobj->fin_type_title;
  
              $finstatusid     = $row->fin_status;
              $finstatusobj    = $this->model->get_where($finstatusid,'users_financial_statuses');
              $row->fin_status = $finstatusobj->fin_status_title;
  
              $this->module('timedate');
              $format = 'datepicker_us';
              $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);
  
              if($row->updated_at == '01/01/1970'){
                $row->updated_at = ' ';
              }              
  
              // Get the address data
              $recid = $row->id;
              $addrdataobj = $this->model->get_one_where('user_id',$recid,'users_addresses');
  
              $row->mailaddress1 = $addrdataobj->mailaddress1;
              $row->mailaddress2 = $addrdataobj->mailaddress2;
              $row->mailcity     = $addrdataobj->mailcity;
              $row->mailstate    = $addrdataobj->mailstate;
              $row->mailzip      = $addrdataobj->mailzip;

              $row->physaddress1 = $addrdataobj->physaddress1;
              $row->physaddress2 = $addrdataobj->physaddress2;
              $row->physcity     = $addrdataobj->physcity;
              $row->physstate    = $addrdataobj->physstate;
              $row->physzip      = $addrdataobj->physzip;  
          }
  
              $data['subentity_name']  = $subentity_name;

              $data['view_module']   = 'honcho/users';
              $data['view_file']     = 'directorylist'; // full member directory
//print_r($_SESSION['usermode']); die();  // IS NULL because not adding, viewing or updating a record
             // switch($_SESSION['usermode']) { // 

             // case 'viewmydata': // managing your subentity records

                    $data['bc1'] = 'MSP';
                    $data['bc2'] = 'National Roster';

             // break;
             // }

              $this->templates->inspinia($data);

    }  

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

// **************************  function CCMPUPLOAD ************************** //  
  
  function userupload(){
      
    // passed from sidemenu button sets the mode
    $_SESSION['usermode'] = segment(3);
    
  //  echo(70); 
  //  print_r($_SESSION['usermode'] ); die();

if(isset($_FILES['file_upload'])){
  
  $dir='uploads/';
  $upload_file_name=$_FILES['file_upload']['name'];
  $upload_file_size=$_FILES['file_upload']['size'];
  $tmp_file_name   =$_FILES['file_upload']['tmp_name'];

  if($extension == 'csv'){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
  }else if($extension == 'xls'){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
  }else{
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  }

  $spreadsheet = $reader->load($_FILES['file_upload']['tmp_name']);
  $sheetdata   = $spreadsheet->getActiveSheet()->toArray();

  move_uploaded_file($tmp_file_name,$dir.$upload_file_name);
/*
    // Test
  echo('<pre>');
  print_r($sheetdata); die();
*/
}
/////////////////////////////////
 $sheetcount = count($sheetdata);

// print_r($sheetcount); die();

 if($sheetcount > 1) { // ignoring the header which will be record 1 so starting at 2 to see if any records

    $data = array();
    for ($i =1; $i < $sheetcount; $i++){

     // echo($id_type  = $sheetdata[$i][1]); die();
      $id_number           = $sheetdata[$i][0]; 
      $id_type         = $sheetdata[$i][1]; // if there is an id key in first column then start at 1.
      $salutation          = $sheetdata[$i][2];
      $first_name          = $sheetdata[$i][3];
      $middle_name         = $sheetdata[$i][4];
      $last_name           = $sheetdata[$i][5];
      $suffix              = $sheetdata[$i][6];
      $gender              = $sheetdata[$i][7];
      $subentity             = $sheetdata[$i][8];
      $mailaddress1        = $sheetdata[$i][9];
      $mailaddress2        = $sheetdata[$i][10];
      $mailcity            = $sheetdata[$i][11];
      $mailstate           = $sheetdata[$i][12];
      $mailzip             = $sheetdata[$i][13];
      $phone               = $sheetdata[$i][14];
      $mobile              = $sheetdata[$i][15];
      $email_address       = $sheetdata[$i][16];
      $fax                 = $sheetdata[$i][17];
      $birthday            = $sheetdata[$i][18];
      $highest_certificate = $sheetdata[$i][19];
      $certificate_number  = $sheetdata[$i][20];
      $total_time          = $sheetdata[$i][21];


      $row_data['id_number']           = $id_number;
      $row_data['id_type']             = $id_type;
      $row_data['salutation']          = $salutation;
      $row_data['first_name']          = $first_name;
      $row_data['middle_name']         = $middle_name;
      $row_data['last_name']           = $last_name;
      $row_data['suffix']              = $suffix;
      $row_data['gender']              = $gender;
      $row_data['subentity']             = $subentity;
      $row_data['mailaddress1']        = $mailaddress1;
      $row_data['mailaddress2']        = $mailaddress2;
      $row_data['mailcity']            = $mailcity;
      $row_data['mailstate']           = $mailstate;
      $row_data['mailzip']             = $mailzip;
      $row_data['phone']               = $phone;
      $row_data['mobile']              = $mobile; 
      $row_data['email_address']       = $email_address;
      $row_data['fax']                 = $fax;
      $row_data['birthday']            = $birthday;
      $row_data['highest_certificate'] = $highest_certificate;
      $row_data['certificate_number']  = $certificate_number;
      $row_data['total_time']          = $total_time;

      $data[] = $row_data;

/*
      $data[] = array(
        'id_number'           =>$id_number, 
        'id_type'         =>$id_type,
        'salutation'          =>$salutation,
        'first_name'          =>$first_name,
        'middle_name'         =>$middle_name,
        'last_name'           =>$last_name,
        'suffix'              =>$suffix,
        'gender'              =>$gender,
     //   'subentity'             =>$subentity,
        'mailaddress1'        =>$mailaddress1,
        'mailaddress2'        =>$mailaddress2,
        'mailcity'            =>$mailcity,
        'mailstate'           =>$mailstate,
        'mailzip'             =>$mailzip,
        'phone'               =>$phone,
        'mobile'              =>$mobile,
        'email_address'       =>$email_address,
        'fax'                 =>$fax,
        'birthday'            =>$birthday,
      //  'highest_certificate' =>$highest_certificate,
        'certificate_number'  =>$certificate_number,
       // 'total_time'          =>$total_time, */
      //); 
    }

  //  print_r($data); die();
  $num_uploaded =  $this->model->insert_batch('users_uploaded', $data);
//echo('Records uploaded!'); die();
    
  //    $this->model->insert($data, 'users_uploaded');
 
  }

switch($_SESSION['usermode']){

  case 'momm': // Subentity Administration

        $recid      = $_SESSION['user_rec_id'];

        if($recid < 1){ // session expired - not logged in
          $this->login();
        }
        
        // returns array - values not codes
        $user_array   = $this->_get_a_single_record($recid); // anchor1
    //  print_r($user_array); die();
        $subentityadmin  = $user_array['subentity_admin'];
        $subentity_name  = $user_array['subentity'];
        $subentity       = $user_array['subentity'];


        $subentity_role = $user_array['subentity_role'];
       
        $subentity_role_id = $user_array['subentity_role'];

        $sql = "SELECT * FROM users_uploaded WHERE subentity = $subentity"; // 

        $datauploaded  = $this->model->query($sql,'object');

          break;

  case 'mngallusers': // Member Administration

        $datauploaded = $this->model->get('id','users_uploaded'); 

  break;

}

//print_r($datauploaded ); die();

// echo(85); die();

        foreach($datauploaded as $row) { // step through the array of records and pull out needed values
         
            $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate_users
            $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

            /*------------------ Change values to display descriptions instead of codes -----------------*/ 

            // Change codes to names

            $highcert                 = $row->highest_certificate;  // get the integer
            $subentityobj               = $this->model->get_where($highcert,'users_certificate_types'); // use the integer to get the object
            $row->highest_certificate = $subentityobj->description; // reset the value from integer to string from the object

            $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
            $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
            $levelname = $levelobj->level_title;  // capture the level name
            // now we need to insert the levelnames in the array for display
            $row->levelname = $levelname;

            $memtypeid        = $row->id_type;
            $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
            $row->id_type = $memtypeobj->id_type;

            $actypeid           = $row->aircraft_type;
            $actypeobj          = $this->model->get_where($actypeid,'aircraft_types');
            $row->aircraft_type = $actypeobj->name;

            $subentityrole    = $row->subentity_role;
            $subentityobj   = $this->model->get_where($subentityrole,'users_subentity_offices');
            $row->subentity_role = $subentityobj->description;

            $subentityid    = $row->subentity;
            $subentityobj   = $this->model->get_where($subentityid,'users_subentities');
            $row->subentity = $subentityobj->description;

            $fintypeid          = $row->fin_acct_type;
            $fintypeobj         = $this->model->get_where($fintypeid ,'users_financial_types');
            $row->fin_acct_type = $fintypeobj->fin_type_title;

            $finstatusid     = $row->fin_status;
            $finstatusobj    = $this->model->get_where($finstatusid,'users_financial_statuses');
            $row->fin_status = $finstatusobj->fin_status_title;

            $this->module('timedate');
            $format = 'datepicker_us';
            $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

            if($row->updated_at == '01/01/1970'){
              $row->updated_at = ' ';
            }

            // Get the address data
            $recid = $row->id;
            $addrdataobj = $this->model->get_one_where('user_id',$recid,'users_addresses');

            $row->mailaddress1 = $addrdataobj->mailaddress1;
            $row->mailaddress2 = $addrdataobj->mailaddress2;
            $row->mailcity     = $addrdataobj->mailcity;
            $row->mailstate    = $addrdataobj->mailstate;
            $row->mailzip      = $addrdataobj->mailzip;

            $row->physaddress1 = $addrdataobj->physaddress1;
            $row->physaddress2 = $addrdataobj->physaddress2;
            $row->physcity     = $addrdataobj->physcity;
            $row->physstate    = $addrdataobj->physstate;
            $row->physzip      = $addrdataobj->physzip;
//print_r($addrdataobj); die();
        } // end foreach
   
        $data['datauploaded']   = $datauploaded;

        $data['logged_in']      = $_SESSION['logged_in'];
        $data['home_page']      = 0;
 //       print_r($data['logged_in']); die();

        //$data['site_name']   = "AYMP";  // perhaps put in config db or file
        $data['content_name']   = "Black Pilots of America";  // perhaps put in config db or file

    
        $data['subentity_name']   = $subentity_name; // not sure I do anything with this
  
      //  $data['mcma']          = $mcma; // treasurer/sysadmin managing current members or all members

        $data['view_module']    = 'honcho/users';
        $data['view_file']      = 'uploaduser'; // 

//print_r($_SESSION['usermode']); die();  // IS NULL because not adding, viewing or updating a record
             // switch($_SESSION['usermode']) { // 

             // case 'viewmydata': // managing your subentity records

                    $data['bc1'] = CCMP.' Admin';
                    $data['bc2'] = 'Upload <?= CCMPS ?>';

             // break;
             // }

              $this->templates->inspinia($data);
  }
  
// **************************  function UPLOAD_FORM ************************* //  

  function upload_form(){
      
      error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

      if(isset($_FILES['file_upload'])){
        $dir='uploads/';
        $file_name=$_FILES['file_upload']['name'];
        $size=$_FILES['file_upload']['size'];
        $tmp_file_name=$_FILES['file_upload']['tmp_name'];
         echo $tmp_file_name.'<br>';
         echo $file_name.'<br>';
         echo $size;
        move_uploaded_file($tmp_file_name,$dir.$file_name);
        echo 'success<br>';
        include 'read_file.php';
      }else{
          echo 'File not selected';
      } 

  }

/*----------------------------------------------------------------------------*/
/*------------------------------- Reports ------------------------------------*/
/*----------------------------------------------------------------------------*/

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
    
// ***********************  function MASTERCURRENTROSTER ******************** //
    
    function mastercurrentroster($recid = null) { // Treasurer Master Spreadsheet Format
    $usersfunction = 'mastercurrentroster';
    $authorized = $this->_check_function_permissions($usersfunction); 

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
      $recid    = segment(3); 
    // query for all records - (syntax: 'order_by', 'table', limit, offset)


      $currentyear  = $_SESSION['users_current_year'];
//echo(6418);
//print_r($currentyear ); die();

      if($currentyear < 2023){
        $currentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'users-mastercurrentroster-6087';
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

      $currentyear  = $currentyear - 1;

      if( $recid > 0){
        $sql = "SELECT * FROM honcho_user_accounts WHERE id = $recid"; // what if deleted or archived off ???
      }else{ 

         $sql = "SELECT * FROM honcho_user_accounts WHERE deceased != 1 AND current_year > $currentyear"; 
      }
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data = $this->model->query($sql,'object');
    // convert the object to an array to add additional data for the view 
    $data = (array)$data;
 //     print_r($data); die();
    foreach($data as $row) { // step through the array of records and pull out needed values
      $userrecid = $row->id;
//print_r($userrecid); die();
      $addrobj   = $this->model->get_one_where('user_id',$userrecid,'users_addresses');
//  print_r($addrobj); die();
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


 //     print_r($data); die();


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

          $memtypeid        = $row->id_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
          $row->id_type = $memtypeobj->id_type;

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description;

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


} // end for each $data

//echo(6985);
//json($data); die();

$previousyear = $currentyear; // because 1 has been subtracted from current year already to use the > sign in query becuase some pay for yesrs in advance

//print_r($previousyear); die();
      $sql2 = "SELECT * FROM honcho_user_accounts WHERE deceased != 1 AND current_year = $previousyear"; // for read only roster
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data2 = $this->model->query($sql2,'object');
    // convert the object to an array to add additional data for the view 
    $data2 = (array)$data2;
  //    print_r($data2); die();
    foreach($data2 as $row) { // step through the array of records and pull out needed values
      $userrecid = $row->id;
//print_r($userrecid); die();
      $addrobj   = $this->model->get_one_where('user_id',$userrecid,'users_addresses');
//  print_r($addrobj); die();
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

/*
echo(6864);
print_r($currentyear ); 
print_r($data2); die();
*/

      foreach($data2 as $row) { // step through the array of records and pull out needed values
    
          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/ 

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
          $levelname = $levelobj->level_title;  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->id_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
          $row->id_type = $memtypeobj->id_type;

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description;

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


} // for each $data2

//echo(7372);
//json($data2); die();

$twoyearsago = $currentyear - 1; // because 1 has already been subtracted from current year already to use the > sign in query because some pay for yesrs in advance
//echo(7210);
//print_r($previousyear); die();
      $sql3 = "SELECT * FROM honcho_user_accounts WHERE deceased != 1 AND current_year = $twoyearsago"; // for read only roster
       //   $sql = "SELECT * FROM users WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data3 = $this->model->query($sql3,'object');
    // convert the object to an array to add additional data for the view 
    $data3 = (array)$data3;
  //    print_r($data2); die();
    foreach($data3 as $row) { // step through the array of records and pull out needed values
      $userrecid = $row->id;
//print_r($userrecid); die();
      $addrobj   = $this->model->get_one_where('user_id',$userrecid,'users_addresses');
//  print_r($addrobj); die();
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

  }



  //    print_r($data); die();


      foreach($data3 as $row) { // step through the array of records and pull out needed values
    
          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/ 

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
          $levelname = $levelobj->level_title;  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->id_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'users_types');
          $row->id_type = $memtypeobj->id_type;

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description;

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

          if($row->donotcall == 1) { 
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


} // for each $data3
        // Add these elements to properly draw the screen

              $data['data2']         = $data2;
              $data['data3']         = $data3;
              $data['view_module']   = 'honcho/users';
              $data['view_file']     = 'mastercurrentroster'; // read only roster


              $data['bc1'] = CCMP.' Admin';
              $data['bc2'] = 'National Roster';
//echo(6864);

//json($data2); die();
              $this->templates->inspinia($data);                  
    
    }

/*------------------------------------------------------------------------------------------------*/
/*-------------------------------- Common Utility Functions --------------------------------------*/
/*------------------------------------------------------------------------------------------------*/

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

// *************************  function MODALADDEMAIL ************************ //
      
  function modaladdemail() {  // called from non-honcho module that uses the add email modal form
    // url protected - white page 

    // since called by a javascript routine print_r and echo render in the calling form which disappers - die() stops execution

    // If this segment exists then must be coming from honcho as it is passed in URL through a button. 
    //  $dbtupd = segment(5); 
     $dbtupd = post('dbtupd');     
      //print_r($dbtupd); die();
  
  
      // Get the input values & system acct recid hidden in the modal form and passed to javascript then posted here
      $nem   = post('nemail'); // why not new_email? what is the point of that line in the JS nemail:new_email?
  
      // get system account record number for the user, not the sys/assist/admin $_SESSION['honcho_acct_rec_id']; who is logged in as in the change password function below   
      $sarid = post('recid');

// the echo output shows up on the modal form until it times out. Can only show two echo lines on form.
   //   echo(6561);
   //   echo('-');
   //   echo('sarid - ');
   //   print_r($sarid); die();
        if(strlen($nem) > 0){ // if the user submitted a username - otherwise it will match on blank records
                  
          $nem = trim($nem);
//print_r($mbrno); die();
          $usr_obj = $this->model->get_one_where('email_address', $nem, 'honcho_user_accounts');
//print_r($usr_obj); die();
                     
          $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
          if($recordfndid > 0){ // record found id exists so there is a user with that username

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed

            // if there is no update_id then you are adding so it is not ok to find a duplicate
                  if($recordfndid == $sarid){ // when adding there is no update_id so automatically not ok to duplicate
      //echo('Email address found but Everything OK'); die();


                  }else{ 
      //echo('Email Address found but NOT OK'); die();

                    // here a different user trying to change his username to someone elses
                    // need to set flash msg fo rthe error and send back to the create form
                    $result = 0;  // failed validation

                    $flash_msg = 'The Email Address is already taken.';
                    set_flashdata($flash_msg);
                    $flashmsgisset = 1;

            //print_r($_SESSION['usermode']); die();
                    switch($_SESSION['usermode']) {

                      case 'momm': // managing your subentity records
                            redirect('honcho-users/manage/momm');

                      break;

                      case 'momm': // managing your subentity records
                            redirect('honcho-users/manage/momm');

                      break;
                  
                      case 'mosm': // managing current subentity student members
                            redirect('honcho-users/manage/mosm');

                      break;

                      case 'mngallusers': // managing all members

 //                         print_r('Email address already taken...please try again'); 
//echo'<input type="button" value="Reload Page" onClick="document.location.reload(true)">';

                      break;
                      default;          
                      }


                    } 
                  
              }else{ // no duplicate found
//print_r('no duplicate found'); 
                    $nemdata['email_address'] = $nem;
                    $nemdata['username']      = $nem;

                    if($dbtupd == "users"){
                          $this->model->update($sarid, $nemdata, 'honcho_user_accounts');
                        //  echo "Success! Email Address & Username were both updated";
                          $flash_msg = 'Success! Email Address & Username were both updated';
                          set_flashdata($flash_msg);
                          $flashmsgisset = 1;

                          // redirect('honcho-users/viewuser/'.$sarid.);


                    }else{
                          if($dbtupd == "honcho_user_accounts"){
                            $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
                            echo "Your email address was successfully updated.";  
                          }else{
                            echo "No DB was specified - honcho-users/modaladdemail line 6577";  
                  
                          }
                    }

              } 
          }

    }

// **************************  function MODALRESETPW ************************ //

  function modalresetpw() {  // called from honcho-users module that uses the reset password modal form
        // url protected - white page 
    // since called by a javascript routine print_r and echo render in the calling form which disappers - die() stops execution

     $dbtupd = post('dbtupd');     
 
      // Get the input values & system acct recid hidden in the modal form and passed to javascript then posted here
      $npw   = post('npass');
  
      // get system account record number for the user, not the sys/assist/admin $_SESSION['honcho_acct_rec_id']; who is logged in as in the change password function below   
      $sarid = post('recid');
   
      //  Hash the new password
        $newhpw = $this->_hash_string($npw);
  
        // Save the new password on acct reset by admin - modalchangepw below uses logged in user

        $npwdata['password']     = $newhpw;
        $npwdata['force_pw_chg'] = 1;
  
        if($dbtupd == "users"){
          $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
          echo "The Password Was Successfully Reset";  
        }else{
          if($dbtupd == "honcho_user_accounts"){
            $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
            echo "The Password Was Successfully Reset";  
          }else{
                $flash_msg = 'No database was specified.'; 
                set_flashdata($flash_msg);

                redirect('honcho-users/userhome');
          }
        }
 
    }
    
// *************************  function MODALCHANGEPW ************************ //
    
function modalchangepw() { //for changing your own system acct password. users not passed because separate code in honcho to change own users password


    // Get the input values
    $rpwl   = post('rpwl'); // required password length hidden in form field - currently blank
    $pw     = post('crpass');
    $npw    = post('npass');
    $cpw    = post('cpass');
    $dbtupd = post('dbtupd'); // works 
    $sarid  = post('recid');  // 
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

    // find the honcho_user_accounts record - if were using this for front end would be a case statement for users vs. honcho_user_accounts

    $useracctobj = $this->model->get_one_where('id', $sarid, 'honcho_user_accounts');

    // get the saved hashed password
    $realpw = $useracctobj->password;

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

      $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
      echo "Your Password Was Successfully Changed";  

   }else{ //current password was not verified

    if($_SESSION['user_logged_in'] == 1){
        echo('Current Password is incorrect, try again.');
    }else{
        $flash_msg = 'No database was specified.'; 
        set_flashdata($flash_msg);

        redirect('honcho/login');
    }

    
    

   }

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

// ***************************  function LOCKACCT *************************** //
       
    function lockacct() {
     // 404 if not logged in. White page if you are but will lock if pass a recid
 //   $usersfunction = 'lockacct';
 //   $authorized = $this->_check_function_permissions($usersfunction); 

      $recid = segment(3);
   //   $frmpg = segment(4); // can lock and unlock from manage or view


   //   echo(5916);
   //   print_r($frmpg); die();
      $data['locked'] = 1;

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

 // **************************  function UNLOCKACCT ************************* //
    
    function unlockacct() {
     // 404 if not logged in. White page if you are but will lock if pass a recid
 //   $usersfunction = 'lockacct';
 //   $authorized = $this->_check_function_permissions($usersfunction); 

      $recid = segment(3);
   //   $frmpg = segment(4); // can lock and unlock from manage or view


   //   echo(5916);
   //   print_r($frmpg); die();
      $data['locked'] = 0;

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

// *******************  function _GET_USER_TOKEN_EXPIRATION ***************** //
    
    function _get_user_token_expiration($tguserid2){  // used by Ccmps.php 
    // protected - private function

// Do conversions
      // get tg user level and convert to text
      // pull out the user_level_id from
      $tguserobj4 = $this->model->get_one_where('user_id', $tguserid2, 'trongate_tokens');
//  print_r($tguserobj4); die();

/*
Convert datepicker to Unix timestamps
$dptots = $data['htg_birthdate'];
$this->module('timedate');
$data['htg_birthdate'] = $this->timedate->make_timestamp_from_datepicker_us($dptots);

Convert Unix Timestamps to user friendly dates
$format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
$this->module('timedate');
$nicedate = $this->timedate->get_nice_date($timestamp, $format) 
*/
  
      $tokenexpires     = $tguserobj4->expiry_date;
      $tokenexpires_raw = $tguserobj4->expiry_date; // wont be translated to nice date - for tabular report
//print_r($tokenexpires); die();          
      if(isset($tokenexpires)) {
//echo('token set and expires: ');       
//print_r($tokenexpires); die();
        $this->module('timedate');
        $format = 'datepicker_us';
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);
 
      }else{
     //   echo('token not set'); die();
        $tokenexpires = '';                 
      }
//echo('token expires: ');       
//print_r($tokenexpires); die();

       return $tokenexpires;
  }

      function _convert_level_id_to_name($tguserid){
      // protected - private function

// Do conversions
        // get tg user level and convert to text
        // pull out the user_level_id from
        $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');
  // json($tguserobj); die();       
   //     $tguserlevel = $tguserobj->user_level_id;

        // Get the name of the trongate_user_level
   //     $tguserlevelobj = $this->model->get_one_where('id', $tguserlevel, 'trongate_user_levels');
      //   json($tguserlevelobj); die();
       
        // Convert the User Level to a user friendly name
        if($tguserlevel > 0){
          $levelname = $tguserlevelobj->level_title;
        }else{
          $levelname = "None";
        }
      //  echo('Line 162 - levelname: ');
    //  print_r($levelname); die();

      return $levelname;
  }

function uploaduserpic($recid){ 
// white page

 $submit = post('submit', true); // = "Upload"
//echo(8646);
//print_r($submit); die();
$this->submit_upload_picture($recid, $submit);

// flow doesnt come back here

}

function _init_picture_settings() {

// protected - private function

  $picture_settings['max_file_size'] = 2000;
  $picture_settings['max_width'] = 1200;
  $picture_settings['max_height'] = 1200;
  $picture_settings['resized_max_width'] = 450;
  $picture_settings['resized_max_height'] = 450;
  $picture_settings['destination'] =  ''; // users_photos when using public (ie upload to module = false)
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'thumbnail';
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  $picture_settings['upload_to_module'] = true; // no destination needed because update_id will be directory name tacked on to assests rather than users_photos tacked on to public
  $picture_settings['target_submodule'] = 'honcho/users'; // i added - framework img_helper assumed target_module is a parent module in the code and grabbed segment(1) which would be honcho-users which isnt
  // a valid filesystem directory - i edited img_helper

  return $picture_settings;

/* sample
function _init_picture_settings() {
  $picture_settings['max_file_size'] = 2000;
  $picture_settings['max_width'] = 1200;
  $picture_settings['max_height'] = 1200;
  $picture_settings['resized_max_width'] = 450;
  $picture_settings['resized_max_height'] = 450;
  $picture_settings['destination'] = 'bands_pics';
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'bands_pics_thumbnails';
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  return $picture_settings;
}
*/
}

function submit_upload_picture($update_id) {
//echo(8924); die();
 // $this->module('trongate_security');
 // $this->trongate_security->_make_sure_allowed();


//echo(8694); die(); 
  $submit = post('submit');

  if ($submit == 'Upload') {
//echo(8698); die();     
    $picture_settings = $this->_init_picture_settings(); // the old one passed the update_id
    extract($picture_settings);
//    echo(8936);
//    json($picture_settings); die();
 //   print_r($destination); die();

$ok = $this->_make_sure_got_destination_folders($update_id, $picture_settings); // i added, makes dir if dont exist
//echo(8787); die();

    $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
    $this->validation_helper->set_rules('picture', 'item picture', $validation_str);
    $result = $this->validation_helper->run();
//$result = 1; // temporary

    if ($result == true) {
        if(strlen($destination) > 0){
            $config['destination'] = $destination.'/'.$update_id;
            
        }else{
            $config['destination'] = $update_id;
        }

      $config['max_width'] = $resized_max_width;
      $config['max_height'] = $resized_max_height;

/*      if ($thumbnail_dir !== '') {
        $config['thumbnail_dir'] = $thumbnail_dir.'/'.$update_id;
        $config['thumbnail_max_width'] = $thumbnail_max_width;
        $config['thumbnail_max_height'] = $thumbnail_max_height;
      } */

$config['upload_to_module'] = $picture_settings['upload_to_module'];
$config['target_submodule'] = $picture_settings['target_submodule']; // i added this to picture settings

      //upload the picture
      $this->image->upload($config);

      //update the database
      $data['picture'] = $_FILES['picture']['name'];

      // replace any spaces with underscore because that is what the file uploader does
      $data['picture'] = str_replace(' ', '_', $data['picture']);

      // save as lowercase to database because filename was converted to lowercase on the upload
      $data['picture'] = strtolower($data['picture']);

      $this->model->update($update_id, $data, 'honcho_user_accounts');

      $flash_msg = 'The picture was successfully uploaded';
      set_flashdata($flash_msg);

      $_SESSION['user_active_window'] = 4;

// if it is your picture then reset picture session variable, if not dont because if you edited someone else it will change your displayed picture until you login again
$usrrecobj = $this->model->get_one_where('id', $update_id,'honcho_user_accounts'); // user record being changed
//print_r($update_id); die();
//print_r($usrrecobj); die();
$usrpic = $usrrecobj->picture;
//print_r($_SESSION['user_rec_id']); die();
//print_r($usrpic); die();
    if($_SESSION['user_rec_id'] == $update_id){ // if person logged owns the user record

        $_SESSION['picture'] = $usrpic;
    }
//echo(8996); die();

      redirect($_SERVER['HTTP_REFERER']);

    } else {
  //      echo(9001); die();
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  echo(9007); die();
}

    function _make_sure_got_destination_folders($update_id, $picture_settings) {

        if(strlen($destination) > 0){     
            $destination = $picture_settings['destination'];
        }else{ 
            $destination = $update_id;
        }
        $target_submodule = $picture_settings['target_submodule'];
        $upload_to_module = $picture_settings['upload_to_module'];
//echo(8748);
//print_r($picture_settings); die();
//print_r($destination); die();
//print_r(APPPATH); die();

        if ($upload_to_module == true) {
         //   $target_dir = APPPATH.'modules/'.segment(1).'/assets/'.$destination.'/'.$update_id;  //

            if(strlen($target_submodule) > 0){ //if in assets under submodule vs. a parent module - I added
                      
              // submodule passed form picture_settings
              $target_dir = APPPATH.'modules/'.$target_submodule.'/assets/'.$destination;  
  //echo(8857);
  //print_r($target_dir); die();
            }else{
            // target module determined from segment(1)
                
               $target_dir = APPPATH.'modules/'.$target_module.'/assets/'.$destination;

            }

//echo(8867);
//print_r($target_dir); die();
        if (!file_exists($target_dir)) {
            //generate the image folder
            mkdir($target_dir, 0777, true);
//echo('made directory: '); print_r($target_dir); die();            
        }

//echo(8881); die();        

/*

//echo('directory exists'); die();
        //attempt to create thumbnail directory
        if (strlen($picture_settings['thumbnail_dir'])>0) {
          //  $ditch = $destination.'/'.$update_id;
            $ditch = $destination;
          //  $replace = $picture_settings['thumbnail_dir'].'/'.$update_id;
            $replace = $update_id.'/'.$picture_settings['thumbnail_dir'];
            $thumbnail_dir = str_replace($ditch, $replace, $target_dir);
            if (!file_exists($thumbnail_dir)) {
                //generate the image folder
                mkdir($thumbnail_dir, 0777, true);
            }
        }
*/
    }
}

// ***********************  function DITCH_PICTURE ************************** //
    
    function ditch_picture($update_id) {
  //  $usersfunction = 'ditch_picture';
    //$authorized = $this->_check_function_permissions($usersfunction); 

        if (!is_numeric($update_id)) {
            redirect($_SERVER['HTTP_REFERER']);
        }

   //     $this->module('trongate_security');
   //     $this->trongate_security->_make_sure_allowed();

        $result = $this->model->get_where($update_id);

        if ($result == false) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $picture_settings = $this->_init_picture_settings();
        $target_column_name = $picture_settings['target_column_name'];
        $picture_name = $result->$target_column_name;

        if ($picture_settings['upload_to_module'] == true) {
            $picture_path = APPPATH.'modules/'.segment(1).'/assets/'.$picture_settings['destination'].'/'.$update_id.'/'.$picture_name;
        } else {
            $picture_path = APPPATH.'public/'.$picture_settings['destination'].'/'.$update_id.'/'.$picture_name;
        }

        $picture_path = str_replace('\\', '/', $picture_path);

        if (file_exists($picture_path)) {
            unlink($picture_path);
        }

        if (isset($picture_settings['thumbnail_dir'])) {
            $ditch = $picture_settings['destination'].'/'.$update_id;
            $replace = $picture_settings['thumbnail_dir'].'/'.$update_id;
            $thumbnail_path = str_replace($ditch, $replace, $picture_path);

            if (file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }
        }

        $data[$target_column_name] = '';
        $this->model->update($update_id, $data);
        
        $flash_msg = 'The picture was successfully deleted';
        set_flashdata($flash_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }


// ******************  function _CHECK_FUNCTION_PERMISSIONS ***************** //
    
    function _check_function_permissions($usersfunction, $recid = NULL) {  // protected - private function
        //first thing is to determine if session has expired or not logged in at all
        // before checking permissions
                 
        if($_SESSION['authenticated'] == 1){ 
 
            if($_SESSION['security_group_id'] == 1){ // sysadmin group
                // skip all rights checking and proceed
            }else{
              //
              //                          
//echo(8175);
                $funcid  = $usersfunction;
                $roleid  = $_SESSION['user_role_id'];
$sql = "SELECT * FROM honcho_user_roles_functions WHERE role_id = $roleid AND function_id = $funcid"; 
$sgf_obj = $this->model->query($sql,'object');

// $sgid    = $_SESSION['security_group_id'];
//print_r($sgid); die();
//$sql     = "SELECT * FROM honcho_user_roles_functions WHERE security_group_id = $sgid AND function_id = $funcid"; 
//$sgf_obj = $this->model->query($sql,'object');


echo('users8191');
echo('<br>');
print_r($roleid);
echo('<br>');
print_r($funcid);
echo('<br>');
json($sgf_obj); die();


            if(isset($sgf_obj)){
    // authorized because that combination exists so execution returns to the calling function                     

            }else{
        $flash_msg = 'You are not authorized to execute this function'; //
        set_flashdata($flash_msg);            

            }
        
        }             
                          
         }else{
             $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
                set_flashdata($flash_msg);
            // you logged out or session timed out - login again
              redirect('honcho/logout'); // clears everything then takes to login page

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

// ****************  function REFRESHMYSESSIONDATA ************************** //
    
    function refreshmysessiondata() {
    // reset any Session variables
//echo(9733);
//json($_SESSION); die();
$userrecid = $_SESSION['user_rec_id'];
$user_obj = $this->model->get_one_where('id', $userrecid , 'honcho_user_accounts');
//echo(9737);
//json($user_obj); die();
 
    $tguid = $user_obj->trongate_user_id;
    $trg_user_obj = $this->model->get_one_where('id', $tguid , 'trongate_users');
    $_SESSION['tg_user_level']    = $trg_user_obj->user_level_id ;// not in users
//echo(9664);
//json($_SESSION['tg_user_level']); die();

    $_SESSION['fontsize']         = $user_obj->fontsize;
    $_SESSION['tfontsize']        = $user_obj->tfontsize;
//print_r($_SESSION['fontsize']); die();
    
    // Module specific
    $_SESSION['users_subentity']        = $user_obj->subentity;
    $_SESSION['users_subentity_role']   = $user_obj->subentity_role;    
    $_SESSION['users_cms_admin']        = $user_obj->cms_admin;
    $_SESSION['users_admin']            = $user_obj->admin;
    $_SESSION['users_student_admin']    = $user_obj->student_admin;
    $_SESSION['users_subentity_admin']  = $user_obj->subentity_admin;
    $_SESSION['users_system_admin']     = $user_obj->system_admin;
    
    $_SESSION['honcho_national_officer'] = $user_obj->national_officer;
    $_SESSION['minor']            = $user_obj->minor;

// in case I edited my record I can refresh what is stored about me in session variables
    $_SESSION['user_first']       = $user_obj->first_name;
    $_SESSION['user_last']        = $user_obj->last_name;
    $_SESSION['id_number']        = $user_obj->id_number;
    $_SESSION['call_sign']        = $user_obj->call_sign;
    $_SESSION['user_mobile']      = $user_obj->mobile;
    $_SESSION['picture']          = $user_obj->picture;
    $_SESSION['language']         = $user_obj->language;


    if($_SESSION['subentity_role'] == 1){ // subentity president
        $_SESSION['subentity_admin'] = 1;
    }
    
//echo(9767);
//json($_SESSION); die();

/* some of these session variables could be for honcho - otherwise track them down and delete
    "first_name": "",
    "studentadmin": 0,
    "subentityadmin": 0,
    "memberadmin": 0,
    "systemadmin": 0,
    "button_loc": "BUTTON_LOC",
    "usertab": "",
    "user_photo": "",
*/

    $flash_msg = 'Your settings have been updated!'; 
    set_flashdata($flash_msg);



    // if no admin roles or rights get member menu
    
    if($_SESSION['userssidemenu'] == 'admin'){ 
                redirect('honcho-users/adminmenu');

    }else{
               redirect('honcho-users/usermenu');
    } 
  }
  
// ************************  function RECALCSTATUS ************************** //
  
function recalcstatus($recid){ // triggered after an update or new record save

    $syssettingid                     = 1;
    $sys_setting_obj                  = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['users_current_year']  =  $sys_setting_obj->settingvalue;
    $syscuryear =  $_SESSION['users_current_year'];

    $syssettingid              = 2;
    $sys_setting_obj           = $this->model->get_where($syssettingid ,'system_settings');
    $_SESSION['grace_period']  =  $sys_setting_obj->settingvalue;  

/*    
print_r($_SESSION['users_current_year'] );
echo('<br>');
print_r($_SESSION['grace_period'] ); 
echo('<br>');
print_r( $recid ); die();
*/
    
  //  $usersfunction = 'recalc_status';
  //  $authorized = $this->_check_function_permissions($usersfunction); 

  //  $recid = segment(3); // for testing using url - if not test comment out because it is passed as a parameter
    $usrobj = $this->model->get_one_where('id', $recid,'honcho_user_accounts');

    $curntstatus  =  $usrobj->status; 
    $curntyear    =  $usrobj->current_year; 

    $compareyear = $syscuryear - 1;

/*    
echo(9019);    
print_r($curntyear ); 
print_r($compareyear);
print_r($_SESSION['grace_period']);die();
*/
    
    if($curntyear > $compareyear){
        // still paid up
          $upddata['status'] = 1; //  Current
    }else{ // not paid up

        if($_SESSION['grace_period'] == 1){

             if($curntyear   == $compareyear ){ // if you are only one year behind

                $upddata['status'] = 2; //Past Due
             }else{
                // more than 1 year behind stay expired
                $upddata['status'] = 5; //  Expired
             }
           
        }else{ 
            // if no grace period everyone is or stays expired
            $upddata['status'] = 5; //  Expired
        }
    }
// override results - status not implemented 

//$this->model->update($recid, $upddata, 'honcho_user_accounts');

return; // 2710,4130,4912, 
}

// ************************  function NUMVAL ******************************** //

function numval($type, $vallimit, $val){

/*    echo ('Type = ');
    print_r($type);
    echo (' Limit = ');
    print_r($vallimit);    
    echo (' Value = ');
    print_r($val); 
*/

    switch($type) {

      case 'min': //
       if($val > $vallimit - 1){
    
         return 1;
       }else{
              return 0;
       }
       
      break;

      case 'max': //
            if($val < $vallimit + 1){
         return 1;
       }else{
         return 0;
       }  

      break;

      case 'equal': //
            if($val == $vallimit){
         return 1;
       }else{
         return 0;
       }  

      break;
      }
}


// ************************************************************************** //
// ************************  function EVENTS ******************************** //
// ************************************************************************** //

    function events($id = NULL) {
    $usersfunction = 'events';
    $authorized = $this->_check_function_permissions($usersfunction); 
//echo(83);
    $_SESSION['selectedid'] = $id;  // id of the selected event. Want to eliminate from array of Other Events below.
     // pass by storing in a session variable.
//print_r($_SESSION['selectedid']); die(); 


    if($id == NULL){
 //print_r('made it'); die();  
          $eventsdata = $this->model->get('id','events');
// print_r($data); die();  
          $data['eventsdata']       = $eventsdata;
          
          $data['contentfile']      = 'events';          
          $data['view_module']      = 'honcho/users';
          $data['view_file']        = 'layout'; // sidemenu and space for contentfile
  //echo(104);
  //print_r($data); die();

          $this->templates->boss($data);   

    } else {

          $affilid = segment(4);  // affiliate Id for carousel       

  //    echo($affilid); die();

          $eventdata = $this->model->get_where($id,'events');
//print_r($eventdata); die();
          $data['event'] = $eventdata; // 
//echo(112);          
//print_r($data['event']); die();
          $data['contentfile']      = 'event'; // comprehensive events calendar     
          $data['view_module']      = 'honcho/users';
          $data['view_file']        = 'layout'; // sidemenu and space for contentfile

          // template is the default location (templates/views/cool_mobi) using old engine, new engine uses public/themes/cool_mobi/black
          $this->templates->boss($data);
              
    }
}

// ************************************************************************** //
// *************************  function SPONSORS ***************************** //
// ************************************************************************** //
  
  function sponsors(){
//    echo(60);
//print_r(strlen($_SESSION['user_first'])); die();
if(strlen($_SESSION['user_first']) > 0){
    $data['view_module']   = 'honcho/users';
    $data['view_file']     = 'sponsors'; // full member directory

    $data['bc1'] = 'EMS';
    $data['bc2'] = 'Sponsors';


}else{

        $flash_msg = 'Your Session has expired - please login again.'; // 
        set_flashdata($flash_msg);

        // you logged out or session timed out - login again
        redirect('honcho/logout'); // clears everything then takes to login page
}


    $this->templates->inspinia($data);
    
  }

// ************************************************************************** //
// ******************  function SENDSPONSORSFORMEMAIL *********************** //
// ************************************************************************** //
  
    function sendsponsorsformemail(){

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