<?php
/*


Tables: auditlog, auditlogger_bulk_actions
Templates: inspinia.php
*/

class Subentities extends Trongate {

  function _construct(){
    $this->parent_module = 'system';
    $this->child_module  = 'subentities';
  }
  
  function _destruct(){
    $this->parent_module = '';
    $this->child_module = '';
  }

  function index() {
  $ntcfunction = 'index';
  $authorized = $this->_check_function_permissions($ntcfunction); 

    echo "System-subentities-index()"; die();

  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
    function manage(){ 
echo(33); die();
/*---------------------------- Security Checks -------------------------------*/
  $ntcfunction = 'manage';
  $authorized = $this->_check_function_permissions($ntcfunction); 

    // check to see if security token has expired
        
    if(strlen($_SESSION['trongatetoken']) > 0){
        // ok do nothing
    }else{
        $flash_msg = 'Your Session has expired - please login again.'; 
        set_flashdata($flash_msg);

        // you logged out or session timed out - login again
        redirect('welcome/logout'); // clears everything then to login page
    }
    
    // passed from sidemenu button sets the mode - mmyads or cmmads 
    // member or content manager respectively

    
/*----------------------- Get Passed Parameters ------------------------------*/
  
  //  $_SESSION['admode'] = segment(3); 
    
/*------------------ Get logged in user's info & preferences -----------------*/
  
// Get font size preference for views & manage page  
 // $this->_get_font_sizes();

/*----------------------------------- Populate Dropdowns  ----------------------------------------*/
        
        // regions types
        $data['regions'] = $this->model->get('id','system_region_codes');  
//echo(68);
//json( $data['regions'] ); die();

    /*-------------------- Get Subentities -----------------------*/

    $sql = "SELECT * FROM system_subentities";
        
    //$sql = "SELECT * FROM ccmps_notices WHERE chapter = $chapter AND"
    //        . " tg_user_id = $tg_user_id";
    //        
    // Dont need the chapter parameter if have tg User Id could change chapters
    // Order By ignored by Datatables. Also if the value of any hidden input
    // field in a form is = NULL the recs wont be included in the result set!

    // create the $data array and fill it with the rows from the table
    $data['subentities'] = $this->model->query($sql,'object');

    foreach($data['subentities'] as $row) {

            $subentid    = $row->region;
            $subentobj   = $this->model->get_where($subentid,'system_region_codes');
            $row->region = $subentobj->description;
    }
//echo(77);
//json( $data['subentities']); die(); // for debugging

    /*----------- Add $data array elements for manage view -----------------*/
    
    $data['ccmp_logged_in']     = $_SESSION['ccmp_logged_in'];
 //   $data['home_page']      = 0;

    $data['content_name']   = SITENAME;  
//  $data['chapter_name']  = $chapter_name; // do anything with this ???

    $_SESSION['admode']    = 'sysadminm';
    $data['view_module']   = 'system/subentities';
    $data['view_file']     = 'manage'; // 

        $data['bc1']      = 'System Admin ';
    $data['bc2']          = SUBENTITIES;
    $data['header']       = 'Manage '.SUBENTITIES;

 //   echo(101);
 //   json($data); die();
        $this->templates->inspinia($data);

  }

/*----------------------------------------------------------------------------*/
/*------------------------------ End manage ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*-------------------------- FUNCTION VIEW RECORD-----------------------------*/
/*-------------------------------------------------- -------------------------*/
  
function viewrecord($recid = NULL){ // recid which one to view
//echo(127); die();
/*---------------------------- Security Check --------------------------------*/
//  $ntcfunction = 'view';  NOT WORKING!
//  $authorized = $this->_check_function_permissions($ntcfunction, $recid); 

if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('welcome/logout'); // clears everything then takes to login page
}

/*----------------------- Get Passed Parameters ------------------------------*/



/*----------------- Get logged in user's info & preferences ------------------*/
  
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
/*---------------------------- Run Queries -----------------------------------*/ 
  // Get record to view
  $adobj = $this->model->get_where($recid,'system_subentities');
  
  //print_r($adobj); die();

  $data['id']           = $adobj->id; 
  $data['title']        = $adobj->title;
  $data['description']  = $adobj->description;
  $data['chartered']    = $adobj->chartered;
  $data['region']       = $adobj->region;
  $data['logo']         = $adobj->logo;
  $data['website']      = $adobj->website;
  $data['facebook']     = $adobj->facebook;
  $data['instagram']    = $adobj->instagram;
  $data['youtube']      = $adobj->youtube;

  $tgusrid        = $adobj->created_by; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['actor'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

/*--------------------- Convert to User Friendly Values ----------------------*/


  $data   = $this->_convert_to_user_friendly($data); 

  $data['created_at']        = $adobj->created_at;
  $data['updated_at']        = $adobj->updated_at;
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);


// echo(167);
//json($data); die(); 
  
// print_r($_SESSION['tab']); die();
// print_r($_SESSION['admode']); die();

/*--------------------- Set Navbar & Header Information ----------------------*/
     
  $_SESSION['admode']   = 'sysadminv'; // manage all  viewing 
  $data['bc1']          = 'System Admin';
  $data['bc2']          = 'View '.SUBENTITY;
  $data['header']       = SUBENTITIES;
  $data['subheader']    = $adobj->description;

        


/*--------------------------- Set Additional Values --------------------------*/

/*
  $userobj     = $this->model->get_where($recid,'ccmps');
  $usrchptrid  = $userobj->chapter;
  $chapterobj  = $this->model->get_where($usrchptrid,'system_subentities');
  $chapternm   = $chapterobj->description;

  $data   = $this->_get_a_single_record($recid); // returns array
  $data   = $this->_convert_to_user_friendly($data); 
  */

  $data['recid']         = $recid;
  $data['view_module']   = 'system/subentities';
  $data['view_file']     = 'crud'; // use all-in-one crud form for viewing

   //json($data); die();

          $this->templates->inspinia($data);
}

/*----------------------------------------------------------------------------*/
/*-------------------------------- End View ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION UPDATE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
  function update($retrying){  

  $recid = segment(3);
//  $ntcfunction = 'update';
//  $authorized = $this->_check_function_permissions($ntcfunction, $recid); 

//print_r($recid); die();
    // firsttime through it passes the recid automatically so have code
    //  ingore it unless it is a "yes"

/*------------------- Get logged in user's info & preferences ----------------*/
    
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
 // print_r($retrying); die();

    $retry = $retrying;  

//print_r($retry); die();

    if( $retry == 'yes'){ 
      // retry does not pass a segment value
      // keep tab number the same for the retry
    }else{
      $retry = 'No';
   //   $_SESSION['tab'] = segment(4);
    }

/*
    $userobj     = $this->model->get_where($recid,'ccmps');
    $usrchptrid  = $userobj->chapter;
    $chapterobj  = $this->model->get_where($usrchptrid,'system_subentities');
    $chapternm   = $chapterobj->description;
*/

//echo(251);
//print_r($retry); 
//print_r($recid);
 //die();

    if($retry == 'yes'){
      $retry = 'no'; // reset - not sure if necessary
      $data = $_POST;
      unset($_POST['submit']);// not in DB will cause error
//print_r($_POST); die();

      // need to reset dropdowns to attempted values ???

    }else{ // getting record to edit

      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid); 
        
//echo(268);
//print_r($data); die();

        $data = $this->_convert_null_integers_to_zeros($data);
        // need to preset dropdowns to attempted values ???
    }

    // some dropdowns want to preselect something other than default first value
/*    
    if(strlen($data['mailstatecode']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstatecode'] = 'NA';
    }
*/

/*----------------------- Set Navbar & Header Information --------------------*/
 //echo(283);
 //print_r($_SESSION['admode']); die();

  $adobj = $this->model->get_where($recid,'system_subentities'); 
 // print_r($adobj); die();

  $data['subheader']        = $adobj->description;


 switch($_SESSION['admode']) { // 

  case 'sysadminm': // came from amanage page

        $_SESSION['frmpg']  = 'sysadminm'; // came from manage page so if cancel go back there
        $_SESSION['admode'] = 'sysadminu'; // updating 

        $data['bc1']        = SUBENTITIES;
        $data['bc2']        = 'Update '.SUBENTITIES;
        $data['header']     = 'Updating A '.SUBENTITY;

  break;

  case 'sysadminv': // came from view page

        $_SESSION['frmpg']  = 'sysadminv'; // came from view page so if cancel go back there
        $_SESSION['admode'] = 'sysadminu'; // updating 
        $data['bc1']        = SUBENTITIES;
        $data['bc2']        = 'Update '.SUBENTITIES;
        $data['header']     = 'Updating A '.SUBENTITY;

  break;

  case 'sysadminu': // in case they hit refresh while editing it has already beencahnged to sysadminu
                    // so if they cancel they will return to the view even if they started from Manage page

        $_SESSION['frmpg']  = 'sysadminv'; // came from view page so if cancel go back there
        $_SESSION['admode'] = 'sysadminu'; // updating 
        $data['bc1']        = SUBENTITIES;
        $data['bc2']        = 'Update '.SUBENTITIES;
        $data['header']     = 'Updating A '.SUBENTITY;

  break;

  }
  
/*------------------------- Populate Dropdowns  ------------------------------*/

    // regions types
    $data['regions'] = $this->model->get('id','system_region_codes');  
//echo(68);
//json( $data['regions'] ); die();

    // To control input fields
    $data['recid']         = $recid;
//print_r($recid); die();
    $data['view_module']   = 'system/subentities';
    $data['view_file']     = 'crud'; // use all-in-one crud form for updating

  // Get font size preference for views & manage page  
  //$this->_get_font_sizes();
 //echo(656);
 //print_r($_SESSION['admode']); die();

    $this->templates->inspinia($data);
         
}

/*----------------------------------------------------------------------------*/
/*------------------------------ End update ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION CREATE -------------------------------*/
/*----------------------------------------------------------------------------*/

function create($retrying){ // only used by CA Adding - may be first time or
                            // with values after failed validation
  $ntcfunction = 'create';
  $authorized = $this->_check_function_permissions($ntcfunction); 

/*------------------ Get logged in user's info & preferences -----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
  $retry = $retrying; // for failed validation repost
//echo(395);
//print_r($_SESSION['admode']); die();
//print_r($retry); die();

    if($retry == 'yes'){
        $retry = 'no'; // reset -not sure if necessary

        $data = $_POST; // get what was posted from the form

        // need to reset dropdowns to attempted values 
        // these are special case since share the same dropdown list
     /*   $data['mailstatecode'] = $data['mailstate'];
        $data['physstatecode'] = $data['physstate'];
        $data['billstatecode'] = $data['billstate'];
        $data['shipstatecode'] = $data['shipstate'];
        $data['chapterid']     = $data['chapter']; 

        $data['password']      = DEFAULT_CCMP_PASSWORD;
        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL; */

    }else{

   /*     $data['password'] = DEFAULT_CCMP_PASSWORD;

        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;

        //Dropdowns
        // Gender - Let it default to male
        $data['member_type'] = 1; //Let it default to regular
        $data['chapter_role'] = 10; // regular member
        $data['mailstatecode'] = 'NA'; // Unknown - using code and not id
        $data['physstatecode'] = 'NA'; // Unknown
        $data['highest_certificate'] = 14; // none
        $data['fin_acct_type']    = 1; // Personal financial acct
        $data['fin_status']   = 9; // Unused - account never been used
        $data['billstatecode'] = 'NA'; // Unknown
        $data['shipstatecode'] = 'NA'; // Unknown */

      }

    // if a state code value is NULL we dont want the dropdown to default to AL
/*    if(strlen($data['mailstatecode']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstatecode'] = 'NA';
    } */



/*-------------------------- Populate Dropdowns  -----------------------------*/
        
    // scopes dropdown
    $data['scopes'] = $this->model->get('id','scopes'); 

    // chapters dropdown for member admin only - ccmp & chapter admin default
    //  to home chapter
    $data['chapters'] = $this->model->get('id','system_subentities'); 


    $data['regions'] = $this->model->get('id','system_region_codes'); 

//echo(906);
//print_r($_SESSION['admode']); die();
    
    if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'momads'){ // momads when CA creatinga notice

    // remove the Visible option public which is the 1st element
    unset($data['scopes'][0]);

// Initialize New Record
// Set to users chapter 
   $data['chapter'] =  $_SESSION['chapter'];
     }else{
         
     $data['chapter'] = 10;  // chapter at large is default for new ccmp     
         
     }

// Initialize New Record con't.
  $data['active']     = 1;
  $data['approved']   = 1;// for dropdown unless mmyads cause dropdown not shown
                          // thus mmyads is auto-approved
  $data['scope']   = 2;
  $data['tg_user_id'] =  $_SESSION['tg_user_id']; // you are posting
  $data['ccmp_id']    =  $_SESSION['ccmp_rec_id'];
//echo(478);
//print_r($_SESSION['admode']); die();

 switch($_SESSION['admode']) {

  case 'cmmadsm': // content manager creating from the manage page

      $_SESSION['admode'] = 'cmmadsc'; // 
      $data['bc1']        = 'CMS';
      $data['bc2']        = 'Create New Chapter';
      $data['subheader']  = 'Content Manager';
  break;

  case 'sysadminm': // sysadmin creating from manage page
//echo(511); die();
   //     $_SESSION['frmpg']  = 'sysadminv'; // came from view page so if cancel go back there
        $_SESSION['admode'] = 'sysadminc'; // creating
        $data['bc1']        = 'System Admin / '.SUBENTITIES;
        $data['bc2']        = 'Create '.SUBENTITY;
        $data['header']     = 'Creating A '.SUBENTITY;

  break;

    case 'sysadminc': // sysadmin creating from manage page
//echo(511); die();
   //     $_SESSION['frmpg']  = 'sysadminv'; // came from view page so if cancel go back there
        $_SESSION['admode'] = 'sysadminc'; // creating
        $data['bc1']        = 'System Admin / '.SUBENTITIES;
        $data['bc2']        = 'Create '.SUBENTITY;
        $data['header']     = 'Creating A '.SUBENTITY;

  break;

  default;

        // Auditlog
        $type  = 'Error';
        $action = 'Create'; 
        $func = 'subentities-sumbit-creating';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Case $_SESSION[admode] not found';
        $str5 = '$_SESSION[admode] = '.$_SESSION['admode'] ;
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        $flash_msg = 'Error: Unexpected adsmode - subentities-476'; 
        set_flashdata($flash_msg);

        redirect('system-subentities/manage');
//echo(525); die(); 

}

/*------------------------- Populate Dropdowns  ------------------------------*/

    // regions types
    $data['regions'] = $this->model->get('id','system_region_codes');  

    $data['view_module']   = 'system/subentities';
    $data['view_file']     = 'crud'; 

 // json($data); die();

    $this->templates->inspinia($data);

}

/*----------------------------------------------------------------------------*/
/*----------------------- End function create --------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*--------------------------- FUNCTION SUBMIT --------------------------------*/
/*----------------------------------------------------------------------------*/

  function submit() {
 // $ntcfunction = 'submit';
 // $authorized = $this->_check_function_permissions($ntcfunction); 

  $recid = segment(3); // if updating there will be a record id

  $submit = post('submit', true);

  // Change to database table names



  $crud = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crud  = 'updating';
  }else{
     $crud  = 'adding';
  }

 $_POST['title']       = $_POST['shortname'];
 $_POST['description'] = $_POST['fullname'];
 unset($_POST['shortname']);
 unset($_POST['fullname']);

/*
  echo(570);
  echo('<br>');
  echo('$_session[ccmp_rec_id] = ');
  print_r($_SESSION['ccmp_rec_id']);
  echo('<br>');
  echo('$_session[admode] = ');
  print_r($_SESSION['admode']);
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

  if ($submit == 'Submit') { // If updating or creating

/*
echo(557);
echo('<br>');
echo('if $submit == Submit TRUE');
echo('<br>');
echo('$recid = ');
print_r($recid); die();
*/

    if($recid > 0){ // updating
      


           $result = 1;



      }else{ // adding new record
          

  
             $result = 1;       
      }

/*
echo(627);
echo('<br>');
echo('$recid = ');
print_r($recid);
echo('<br>');
echo('Results of validation helpers');
echo('<br>');
echo('$result = ');
print_r($result); die();
*/

  if($result > 0){ // if passed all validations above - save the record
        
        if($recid > 0){ // Passed Updating

            $adsdata = $_POST;
            unset($adsdata['submit']);

//echo(624);
//print_r($adsdata); die();
            // Add timestamps - NO TIMESTAMPS
         //   $adsdata['updated_at'] = TIME();
         //   $adsdata['created_at'] = TIME(); // reset created when edit
/*
echo(655);
print_r($recid); 
json($adsdata); die();
*/

            $this->model->update($recid, $adsdata, 'system_subentities');
echo(657);die();


// echo(607);
//print_r("Updated Data Saved!"); die();
// print_r($_SESSION['admode']); die();

            // Auditlog
            $type  = 'update';
            $action = 'SubmitUpdate'; 
            $func = 'subentities-sumbit-updating';
            $un   = 'UN: '.$_SESSION['ccmp_username'];
             $format = 'minitime'; // I added to Timedate.php
             $this->module('timedate');            
             $timestamp = time();
             $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: system_subentities';
            $str5 = 'Title: '.$adsdata['title'];
            $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
            switch($_SESSION['admode']) {

             case 'sysadminu': // 

                 $_SESSION['admode'] = 'sysadminv';
                 $this->viewrecord($recid);

             break;

           }
 

        }else{ // Passed Adding - only one place you add from and thats manage.
        // Show new record after adding. Remove from the $_POST since adding
        // thus dont use _get_a_single_record which gets from DB
            $adsdata = $_POST;
            unset($adsdata['submit']);
// echo(1008);
// print_r($_SESSION['admode']); die();

/*
// dont let chapter admin change the chapter only the content manager
// the chapter dropdown is disable for adding - need to assign chapter
       if($_SESSION['admode'] == 'momadsc'){ 

                $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
                $chptnum = $usrobj->chapter;
                $adsdata['chapter'] = $chptnum; // this is where it s assigned when adding

        }else{ // ccmadsc
                $adsdata['chapter'] = $_POST['chapter'];
        }

        */
// echo(1022);
// print_r($adsdata['chapter']); die();

        // Add timestamps - No timestamps
  //      $adsdata['updated_at'] = TIME();
  //      $adsdata['created_at'] = TIME(); 

//echo('724 about to insert a new subentity: ');
//print_r($adsdata); die();
        //insert the new ccmp account record            
        $this->model->insert($adsdata, 'system_subentities');
// echo('Line 1033 - New notice record added!'); die();   
 
// get the new record's id so can view 
// OR when need to add to other tables with this foreign key
        $new_id = $this->model->get_max('system_subentities');
                
        // Auditlog
        $type  = 'insert';
        $action = 'CreateSubentity';
        $func = 'subentities-sumbit-adding';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$new_id;
        $str4 = 'Tbl: system_subentities';
        $str5 = 'Title: '.$adsdata['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
 
//echo(755);
//print_r($_SESSION['admode']); die();
$_SESSION['admode'] = 'xxx';
        switch($_SESSION['admode']) {

          case 'sysadminc': // CCMP view new notice that was just added
              $_SESSION['admode'] = 'mmyadsv';
              $this->viewrecord($new_id);

          break;

          case 'momadsc': // CA iew new notice that was just added
              $_SESSION['admode'] = 'momadsv';
              $this->viewrecord($new_id);

          break;

          case 'cmmadsc': // CM view new notice that was just added
              $_SESSION['admode'] = 'cmmadsv';
              $this->viewrecord($new_id);

          break;

        default;

        // Auditlog
        $type  = 'Error';
        $action = 'ViewNewRecord'; 
        $func = 'subentities-sumbit-creating';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Case $_SESSION[admode] not found';
        $str5 = '$_SESSION[admode] = '.$_SESSION['admode'] ;
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        $flash_msg = 'Error: Unexpected adsmode - subentities-758'; 
        set_flashdata($flash_msg);

        redirect('system-subentities/manage');



        }


      } // end passed validation updating or adding

// echo('1063 passed all validations and added or updated a record'); die();

  }else{  // failed a validation
 
// echo('1067 Failed validation either updating or adding '); die();
 
// print_r($recid); die();
      if($recid > 0){ // failed updating
     
// echo('1072 Failed validation updating'); die();
// print_r($adsdata); die();
          
        $this->update('yes');

      }else{ // failed adding

// echo('1079 Failed validation adding');
// print_r($adsdata); die();

        $this->create('yes');

      } // failed adding or updating

  } // end passed or failed validation

// Successful save happened by line 

}  // if submit != Submit

// echo('Line 1092');
// print_r('nope submit not Submit'); die();

} // end function

  
/*----------------------------------------------------------------------------*/
/*--------------------------- SUPPORTING FUNCTIONS ---------------------------*/
/*----------------------------------------------------------------------------*/  
  
    function _get_a_single_record($recid) {  //called from line xxx when viewing
    // protected - private function
    // & line xxx when updating and xxx for my data

//print_r($recid); die();
    // Get an object of the record data to be shown

        $addata = $this->model->get_where($recid,'system_subentities');

//print_r($addata); die();

/*--------- View - Convert Updated By & Created By to a Name -----------*/

        $updated_by = $addata->updated_by;
//echo('Line 1181');
//print_r($updated_by); die();

        $created_by = $addata->created_by;
//print_r($created_by); die(); 
        // raw are the codes
        $updated_by_raw = $addata->updated_by;
        $created_by_raw = $ccmpdata->created_by;

        // updater could be the ccmp himself updated_by is their trongate userid
        $tguserobj2 = $this->model->get_one_where
        ('trongate_user_id', $updated_by, 'ccmps');
      //  echo('1193 $tguserobj2');
     //   print_r($tguserobj2); die();
// if null then updater must be a system account

        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;

        $tguserobj3 = $this->model->get_one_where
        ('trongate_user_id', $created_by, 'ccmps');

        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;
//print_r($created_by_last); die();

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

/*------------ View - Convert Codes & Convert Dates to Nice Dates ------------*/

        // Get dates
     //   $startdate    = $addata->startdate;
     //   $enddate      = $addata->enddate;
        $date_created = $addata->date_created;
        $updated_at   = $addata->updated_at;
        $created_at   = $addata->created_at;


        // Same as above but wont be translated for a raw tabular report

        $date_created_raw = $addata->date_created;
        $updated_at_raw   = $addata->updated_at;
        $created_at_raw   = $addata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        $format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
        $this->module('timedate');


        $startdate = $this->timedate->get_nice_date($startdate, $format);
        $enddate   = $this->timedate->get_nice_date($enddate, $format);

        $datecreated   = $this->timedate->get_nice_date($date_created, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat    = $this->timedate->get_nice_date($created_at, $format);

        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);

/*------ View - Add Converted Codes &  Nice Dates to the Array ----------*/

       // convert the object to an array to add additional data for the view 
       $addata = (array)$addata;

       // Translated Codes 
       $addata['updated_by']      = $updatedby;

//print_r($ccmpdata['updated_by'] ); die();
       $ccmpdata['created_by']      = $createdby;

       // Translated Dates

       $addata['updated_at']      = $updatedat;
       $addata['created_at']      = $createdat;

       $addata['updated_by']      = $_SESSION['tg_user_id'];
//print_r($addata['updated_by']); die();
        if($addata['updated_at'] == '01/01/1970'){

          $addata['updated_at'] = 0; // before was ' '; i guess for display
        }else{
          // Do nothing
        }

        if($addata['created_at'] == '01/01/1970'){

          $addata['created_at'] = 0;
        }else{
          // Do nothing
        }

      $data = $addata;

/*------ Convert the Codes to descriptions ----------*/
          
 //         if($addata['chartered'] == 1) { 
 //              $addata['chartered']  = 'Yes';
 //         }else{ 
 //              $addata['chartered'] = 'No';  // so even a null will show up as No
 //         }
 //   echo('Line 1069'); 
//json($data); die();
      return $data; // returns to 555 when editing and other placed when viewing
    }
 

    function _convert_null_integers_to_zeros($data){
// protected - private function
    /*
    if($data['total_time'] > 0) { 
    }else{
      $data['total_time'] = 0;

    }

    */

      return $data;

    } //end function


    function approverecord() {
  $ntcfunction = 'approverecord';
  $authorized = $this->_check_function_permissions($ntcfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.


        $data['approved'] = 1;

        $this->model->update($recid, $data, 'system_subentities');

       // echo(1321);
       // print_r($_SESSION['ccmpmode']); die();
       
        // Auditlog
        $type  = 'update';
        $action = 'ApproveNotice';
        $func = 'subentities-approverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: system_subentities';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('system-subentities/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('system-subentities/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('system-subentities/manage/cmmads');

          break;
        }

       
    }

    
  function unapproverecord() {
  $ntcfunction = 'unapproverecord';
  $authorized = $this->_check_function_permissions($ntcfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.


        $data['approved'] = 0;

        $this->model->update($recid, $data, 'system-subentities');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'DisapproveSubentities';
        $func = 'subentities-unapproverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: system_subentities';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('system-subentities/manage/mmyads');

          break;
     
          case 'momads': // CA managing our chapter record
                redirect('system-subentities/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('system-subentities/manage/cmmads');

          break;
        }
       
    }

    
    function hiderecord() {

    $recid = segment(3);
    $ntcfunction = 'hiderecord';
    $authorized = $this->_check_function_permissions($ntcfunction, $recid); 


        // if delete it doesnt matter where you came from you go back to manage
        //because intent at that time is not to see the details.

        $data['active'] = 0;

        $this->model->update($recid, $data, 'system-subentities');

       // echo(1384);
       // print_r($_SESSION['admode']); die();
  
        // Auditlog
        $type  = 'update';
        $action = 'HideSubentities';
        $func = 'subentities-hiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: system_subentities';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('system_subentities/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('system_subentities/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('system_subentities/manage/cmmads');

          break;
        }
       
    }

    function unhiderecord() {
    $ntcfunction = 'unhiderecord';
    $authorized = $this->_check_function_permissions($ntcfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['active'] = 1;

        $this->model->update($recid, $data, 'system-subentities');

       // echo(1412);
       // print_r($_SESSION['admode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'UnhideSubentities';
        $func = 'subentities-unhiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: system_subentities';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('system-subentities/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('system-subentities/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('system-subentities/manage/cmmads');

          break;
        }
       
    }

    
    function delrecord() { 
      $recid = segment(3);
      $type = segment(4); 
//print_r($type); die(); 
 //     print_r($recid); die();

      $ntcfunction = 'delrecord';
      $authorized = $this->_check_function_permissions($ntcfunction, $recid);
//echo(1574); die();
 //     $title = segment(4); 
//print_r($title); die();
//print_r($_SESSION['admode']);die();
    $result = $this->model->delete($recid,'auditlog');
// print_r($result); die(); // always null even if successsful

    //  Auditlog
        $type  = 'delete';
        $action = 'HardDeleteLog';
        $func = 'subentities-delrecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: auditlog';
        $str5 = 'Type: '.$type;
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
                            
        switch($_SESSION['admode']) {

          case 'sysadmin': // CCMP managing my records
                redirect('system-auditlogger/manage/sysadmin');

          break;
      

        }

}


    function _get_font_sizes() {
    // protected - private function

    // Get ccmp's fontsize preferences for manage page and all other pages
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id,'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize;  // view pages
    $_SESSION['mfontsize']      = $ccmp_obj->mfontsize; // manage page 
    
    
   //print_r($_SESSION['fontsize']); die();
   
    // default sizes
    
         switch($_SESSION['fontsize']) {

          case '1': // managing my records
                 $_SESSION['dfontsize'] = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['dfontsize'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['dfontsize'] = 'Small';
          break;

          case '4': // managing my records
                 $_SESSION['dfontsize'] = 'X Small';
          break;

        }   
        
   //print_r($_SESSION['dfontsize']); die();
    
          switch($_SESSION['mfontsize']) {

          case '1': // managing my records
                 $_SESSION['dmfontsize'] = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['dmfontsize'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['dmfontsize'] = 'Small';
          break;

          case '4': // managing my records
                 $_SESSION['dmfontsize'] = 'X Small';
          break;

        }      
    
    return;
    }


    function _check_function_permissions($ntcfunction, $recid = NULL) {
//echo(1515);
//print_r($ntcfunction); die();

// need one for - index,manage,view, update,approverecord,create,delrecord,fullnotice
// hiderecord,submit,unapproverecord,unhiderecord
 
//echo(1844);
//print_r($recid); die();

        switch($ntcfunction) {

          case 'index': //

                redirect('welcome/logout'); 

          break;

          case 'bulkaction': // filters determine what bulk actions you have access to by role - only need to know logged in.

              if($_SESSION['ccmp_logged_in'] == 1){// 


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears session variables, flags and subentities then redirects to login page

              }
          
          break; 

          case 'manage': //
              if($_SESSION['ccmp_logged_in'] == 1){ // 
                // continue
              }else{ // not logged in at all - send to login form


                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'view': //
   //get login screen if not logged in. However if logged can pass a recid in url and see someone elses

//Only certain roles should be passing other record ids other than their own

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          if($_SESSION['contentmgr'] > 0 || $_SESSION['studentadmin'] > 0 || $_SESSION['chapteradmin'] > 0 || $_SESSION['memberadmin'] > 0 || $_SESSION['systemadmin'] > 0){ // has chapter or member admin rights
            // authorized...continue
           // $data = "goodtogo"; not used
          //  return $data;

          }else{ // not an admin role
//print_r($recid); die();  
//print_r($mynotices); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of notice not person. Need to know it belongs to person

            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
          //  if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where(id, $recid, ccmps_notices);
                $ownerid = $recobj->ccmp_id;
           //     print_r($ownerid);
           //     print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you
/*
                $ccmpri = $_SESSION['ccmp_rec_id'];
                $sql = "SELECT id FROM ccmps_notices WHERE ccmp_id = $ccmpri"; // 
                $mynotices  = $this->model->query($sql,'array');
*/
           // }

          //  Is the record id of the notice in the array of my notice's record ids
          //    $inarray = array_search($recid, array_column($mynotices, 'id')) ? "found" : "not found"; // looking at the values but wouldnt see the first one
          //  $inarray = isset($mynotices[$recid]) ? "found" : "not found"; // looking at the keys
          //  if($inarray == 'found'){ 

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'view';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to view someone elses records'; 
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }

          break;

          case 'update': //



            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // Here recid is of notice not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['contentmgr'] > 0 || $_SESSION['studentadmin'] > 0 || $_SESSION['chapteradmin'] > 0 || $_SESSION['memberadmin'] > 0 || $_SESSION['systemadmin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mynotices); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where(id, $recid, ccmps_notices);
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'update';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to edit someone elses records'; 
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;          

          case 'create': //

        // Can only create for themselves anyway because a recid is not passed

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'submit': // 

              if($_SESSION['ccmp_logged_in'] == 1){// 

//echo(2001); die();
              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }
          
          break;

          case 'fullnotice': //

        // anyone can see

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'approverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of notice not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'unapproverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of notice not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'hiderecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of notice not person. Need to know it belongs to person
         

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['contentmgr'] > 0 || $_SESSION['studentadmin'] > 0 || $_SESSION['chapteradmin'] > 0 || $_SESSION['memberadmin'] > 0 || $_SESSION['systemadmin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mynotices); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where(id, $recid, ccmps_notices);
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'hiderecord';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to hide someone elses records'; 
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          break;

          case 'unhiderecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of notice not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'delrecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // Here recid is of notice not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['contentmgr'] > 0 || $_SESSION['studentadmin'] > 0 || $_SESSION['chapteradmin'] > 0 || $_SESSION['memberadmin'] > 0 || $_SESSION['systemadmin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role

redirect('welcome/logout'); // clears everything then takes to login page
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;


                           
        }

  }
    
function _convert_to_user_friendly($data){ // used by mydata.php

//Convert the Binary Yes/No fields 
          
    if($data['chartered'] == 1) { 
         $data['chartered']  = 'Yes';
    }else{ 
         $data['chartered'] = 'No';  // so even a null will show up as No
    }

  // Change codes to names

    $regionid       = $data['region'];
    $regionobj      = $this->model->get_where($regionid,'system_region_codes');
    $data['region'] = $regionobj->description;



    return $data;

} // end function



} // End controller
