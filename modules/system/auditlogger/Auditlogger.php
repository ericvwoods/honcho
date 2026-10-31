<?php
/*


Tables: system_auditlog, system_auditlogger_bulk_actions
Templates: inspinia.php
*/

class Auditlogger extends Trongate {

  // System Settings & Auditlog pages: staff sysadmins when Honcho is deployed,
  // member system admins in Honcho Lite (HONCHO_MODULE). Internal calls such as
  // logevent() from other modules are not checked.
  function __construct(?string $module_name = null){
    parent::__construct($module_name);
    system_admin_only('system-auditlogger');
  }

  function _construct(){
    $this->parent_module = 'system';
    $this->child_module  = 'auditlogger';
  }
  
  function _destruct(){
    $this->parent_module = '';
    $this->child_module = '';
  }

  function index() {
 // $ntcfunction = 'index';
  //$authorized = $this->_check_function_permissions($ntcfunction); 

    echo "system-auditlogger-index()"; die();

  }
    function logevent ($type, $action, $func, $str1 = NULL, $str2 = NULL, $str3 = NULL, $str4 = NULL, $str5 = NULL, $str6 = NULL){
//echo(29); die();
        if (function_exists('viewas_active') && viewas_active() && is_string($str1) && strpos($str1, 'UN:') === 0) { // View as a Member (LOGIN-26)
            $str1 = 'UN: '.$_SESSION['viewas']['admin_username'].' as '.trim(substr($str1, 3));
        }
        $logdata['type']       = $type; 
        $logdata['action']     = $action;
        $logdata['func']       = $func;
        $logdata['str1']       = $str1;
        $logdata['str2']       = $str2;
        $logdata['str3']       = $str3;
        $logdata['str4']       = $str4;
        $logdata['str5']       = $str5;
        $logdata['str6']       = $str6;



        // cant tell who created because may not know becasue sys or str not saved 
       // if ($_SESSION['sys_user_id'] >0){
      //      $logdata['created_by'] = $_SESSION['sys_user_id'];
       // }else{
      //      $logdata['created_by'] = $_SESSION['str_user_id'];
      //  }
        // trongate_user_id is unique
      $logdata['created_by'] = $_SESSION['tg_user_id'];
      $logdata['created_at'] = TIME();

 //print_r($logdata); die();
        //insert the new record            
        $new_log_id = $this->model->insert($logdata, 'system_auditlog');
 //        echo 'Saved!'; die();
 //       $cnt = $cnt +1;
 //       print_r($cnt);
       // print_r($data); die();
        return $new_log_id;

    //   echo 'Saved!'; die();

     //   echo $type;
     //   echo $action;
     //   echo $str1;
     //   echo $str2;
     //  echo $created_by;
     //   echo $created_at;
    //  die();

    }

  function bulkaction() {
  $ntcfunction = 'bulkaction';
  $authorized = $this->_check_function_permissions($ntcfunction); 

   //     print_r($_SESSION); die();
        
//echo(79);
//print_r($_POST); // array of ids called id
    
//print_r($_POST['selected']); die(); // the dropdown item id - for option button <not <li><a>
          
        $data = $_POST; // array of record ids called id & the dropdown item id
        
        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action
 
        break;
               
         case '2':        
                if(!isset($data)){
                   die('2Nothing Checked');
                }else{
  print_r($data); die('Approve Notices');
                }       
               
        break;
        
         case '3': 
                if(!isset($data)){
                   die('3Nothing Checked');
                }else{
  print_r($data); die('Disapprove Notices');
                }                    
        break;

        
         case '4':        
                if(!isset($data)){
                   die('4Nothing Checked');
                }else{
  print_r($data); die('Hide Notices');
                }       
               
        break;
        
         case '5': 
                if(!isset($data)){
                   die('5Nothing Checked');
                }else{
  print_r($data); die('Unhide Notices');
                }                    
        break;
        
         case '8':    // delete       
                if(!isset($data)){
                   die('8Nothing Checked');
                }else{
 //  print_r($data);                 
 // print_r($data['id']) ; die('Delete');                  
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number
                           
//print_r($delid );  
                            // Need to grab title before delete for the log
                            $adobj = $this->model->get_where(intval($delid),'system_auditlog');
                            $title = $adobj ? $adobj->type.' / '.$adobj->action : ''; // auditlog has no title column
                           // print_r($title); die();
                              
                            // Hard delete
                            $this->model->delete($delid, 'system_auditlog');
//echo('Deleted!'); die();

                            // Auditlog
                            $type  = 'bulkdelete';
                            $action = 'HardDeleteLog';
                            $func = 'auditlogger-bulkaction-case 8';
                            $un   = 'UN: '.$_SESSION['ccmp_username'];
                             $format = 'minitime'; // I added to Timedate.php
                             $this->module('timedate');            
                             $timestamp = time();
                             $time   = $this->timedate->get_nice_date($timestamp, $format);
                            $time = $time.' UTC';
                            $str3 = 'Rec: '.$delid;
                            $str4 = 'Tbl: system_auditlog';
                            $str5 = 'Title: '.$title;
                            $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];
                            
                            $this->module('system-auditlogger');
                            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);                            
                            
                            //print_r('deleted all'); die(); 
                        }else{
                            echo('Line 167 Auditlogger.php - row IS BLANK'); die();
                        }                 
                    } // end foreach
                } 
       
        break;
        
         case '7':
                if(!isset($data)){
                   die('7Nothing Checked');
                }else{
  //print_r($data); die('Archive');
                }       
               
        break;
        
        }
    //    echo('109');
    //    print_r($_SESSION['admode']); die();
        
        switch($_SESSION['admode']) {

          case 'sysadmin': //  Chapter Admin managing your chapter notices
                redirect('system-auditlogger/manage/sysadmin');

          break;

        }        

  }
/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
    function manage(){ 
//echo(202); die();
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
  
    $_SESSION['admode'] = segment(3); 
    
/*------------------ Get logged in user's info & preferences -----------------*/
  
// Get font size preference for views & manage page  
  $this->_get_font_sizes();

 //   echo(232); 
 //   print_r($_SESSION['admode'] ); die(); // for debugging

    switch ($_SESSION['admode']){
        
    case 'sysadmin'; // logged in user is acting as himself
// what chapter does the poster belong to
  if(!empty($_SESSION['ccmp_logged_in']) && empty($_SESSION['honcho_logged_in'])){ // staff have no ccmps record
    $ccmp_id  = $_SESSION['ccmp_rec_id'];
    $ccmp_obj = $this->model->get_where($ccmp_id,'ccmps');

    $tg_user_id      = $ccmp_obj->trongate_user_id;
    $chapteradmin    = $ccmp_obj->subentity_admin; // chapter_* fields renamed subentity_*
    $chapter         = intval($ccmp_obj->subentity);
//print_r($chapter); die();
    $chapterobj      = $this->model->get_where($chapter,'ccmps_subentities'); // system_subentities never existed
    $chapter_name    = $chapterobj ? $chapterobj->description : '';

    $chapter_role    = $ccmp_obj->subentity_role;
    $chapter_role_id = $ccmp_obj->subentity_role;
  }

    // get dropdown for all tabs 
    $data['bulk_actions'] = $this->model->get('id','system_auditlogger_bulk_actions');
    
 
    unset($data['bulk_actions'][1]); // Cannot approve
    unset($data['bulk_actions'][2]); // Cannot 
    unset($data['bulk_actions'][3]); // Cannot 
    unset($data['bulk_actions'][4]); // Cannot 
    unset($data['bulk_actions'][5]); // Cannot 
    unset($data['bulk_actions'][6]); // Cannot     
   //    print_r($data['bulk_actions']); die();
    /*-------------------- Get Appropriate Notices -----------------------*/

    $sql = "SELECT * FROM system_auditlog";
        
    //$sql = "SELECT * FROM ccmps_notices WHERE chapter = $chapter AND"
    //        . " tg_user_id = $tg_user_id";
    //        
    // Dont need the chapter parameter if have tg User Id could change chapters
    // Order By ignored by Datatables. Also if the value of any hidden input
    // field in a form is = NULL the recs wont be included in the result set!

    // create the $data array and fill it with the rows from the table
    $data['rows'] = $this->model->query($sql,'object');
//echo(276);
//print_r($data['rows']); die(); // for debugging
    
    break;


    }
   

 //  echo(300); die(); 
    /*----------- Add $data array elements for manage view -----------------*/
    
    $data['logged_in']     = $_SESSION['logged_in'] ?? 0;
    $data['home_page']      = 0;

    $data['content_name']   = SITENAME;  
//  $data['chapter_name']  = $chapter_name; // do anything with this ???

    $data['view_module']   = 'system/auditlogger';
    $data['view_file']     = 'manage'; // 

 //   echo(348); 
 //   print_r($_SESSION['admode'] ); die(); // for debugging
    
    switch($_SESSION['admode']) { 

    case 'sysadmin': // managing your own ads/notices

          $data['bc1']          = 'SA';
          $data['bc2']          = 'Auditlog';
     /*     $data['salutation']   = $ccmp_obj->salutation;
          $data['first_name']   = $ccmp_obj->first_name;
          $data['middle_name']  = $ccmp_obj->middle_name;
          $data['last_name']    = $ccmp_obj->last_name;
          $data['suffix']       = $ccmp_obj->suffix; */
          $data['header']       = 'System Auditlog';

    break;



    }
    
     //   print_r($data['bulk_actions']); die();
  // print_r($data); die();
        $this->templates->inspinia($data);

  }

/*----------------------------------------------------------------------------*/
/*------------------------------ End manage ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION VIEWNTC ---------------------------------*/
/*-------------------------------------------------- -------------------------*/
  
function viewntc($recid = NULL){ // recid which one to view

  // v2 engine doesn't pass URL segments as arguments; submit() still passes one
  if(empty($recid)){
    $recid = segment(3, 'int');
  }

/*---------------------------- Security Check --------------------------------*/
  $ntcfunction = 'view';
  $authorized = $this->_check_function_permissions($ntcfunction, $recid); 

if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('welcome/logout'); // clears everything then takes to login page
}

/*----------------------- Get Passed Parameters ------------------------------*/

  $vbe = segment(5); // viewing before editing

  if($vbe == 'vbe'){ // if you are viewing before editing
    $_SESSION['tab'] = segment(4);
    $vbe = ''; // reset

  } // else viewing after editing so want to return to tab just edited so dont
    // change value of tab #

/*----------------- Get logged in user's info & preferences ------------------*/
  
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
/*---------------------------- Run Queries -----------------------------------*/ 
  // Get record to view
  $adobj = $this->model->get_where($recid,'system_auditlog');
  
 // print_r($adobj); die();
 
  $data['type']      = $adobj->type;
  $data['action']    = $adobj->action;
  $data['function']  = $adobj->func; // column is func
  $data['str1']      = $adobj->str1;
  $data['str2']      = $adobj->str2;
  $data['str3']      = $adobj->str3;
  $data['str4']      = $adobj->str4;
  $data['str5']      = $adobj->str5;
  $data['str6']      = $adobj->str6;


  


  $tgusrid        = $adobj->created_by; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['actor'] = $poster_obj ? $poster_obj->first_name.' '.$poster_obj->last_name : '';

/*--------------------- Convert to User Friendly Values ----------------------*/
  
  $data['created_at']        = $adobj->created_at;
  $data['updated_at']        = $adobj->updated_at ?? $adobj->created_at; // log rows are never updated
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);

  
  
// print_r($_SESSION['tab']); die();
// print_r($_SESSION['admode']); die();

/*--------------------- Set Navbar & Header Information ----------------------*/

 switch($_SESSION['admode']) {

  case 'sysadmin': // content manager from manage page
      
        $_SESSION['admode']   = 'sysadmin'; // manage all  viewing 
        $data['bc1']          = 'SA';
        $data['bc2']          = 'View an Entry';
        $data['header']       = $adobj->action; // auditlog has no title column
        $data['subheader']    = 'Auditlog';

        
  break;

  case 'cmmadsv': // content manager refreshes page during view
      
        $_SESSION['admode']   = 'cmmadsv'; // manage all  viewing 
        $data['bc1']          = 'MSP';
        $data['bc2']          = 'View A Notice';
        $data['header']       = $adobj->action; // auditlog has no title column
        $data['subheader']    = 'Content Manager';

        
  break;

  case 'cmmadsu': // content manager returns from or cancels update 

        $_SESSION['admode']   = 'cmmadsv'; // manage all  viewing 
        $data['bc1']          = 'MSP';
        $data['bc2']          = 'View A Notice';
        $data['header']       = $adobj->action; // auditlog has no title column
        $data['subheader']    = 'Content Manager'; 
        
  break;

}

/*--------------------------- Set Additional Values --------------------------*/

/*
  $userobj     = $this->model->get_where($recid,'ccmps');
  $usrchptrid  = $userobj->chapter;
  $chapterobj  = $this->model->get_where($usrchptrid,'system_subentites');
  $chapternm   = $chapterobj->description;

  $data   = $this->_get_a_single_record($recid); // returns array
  $data   = $this->_convert_to_user_friendly($data); 
  */

  $data['recid']         = $recid;
  $data['chapternm']     = $chapternm;
  $data['view_module']   = 'system/auditlogger';
  $data['view_file']     = 'crud'; // use all-in-one crud form for viewing

 //  print_r($data); die();

          $this->templates->inspinia($data);
}

/*----------------------------------------------------------------------------*/
/*-------------------------------- End View ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION UPDATE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
  function update($retrying = ''){  // 'yes' only when submit() retries

  $recid = segment(3, 'int');
  $ntcfunction = 'update';
  $authorized = $this->_check_function_permissions($ntcfunction, $recid); 

    // firsttime through it passes the recid automatically so have code
    //  ingore it unless it is a "yes"

/*------------------- Get logged in user's info & preferences ----------------*/
    
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
    $retry = $retrying;  



    if( $retry == 'yes'){ 
      // retry does not pass a segment value
      // keep tab number the same for the retry
    }else{
      $_SESSION['tab'] = segment(4);
    }

/*
    $userobj     = $this->model->get_where($recid,'ccmps');
    $usrchptrid  = $userobj->chapter;
    $chapterobj  = $this->model->get_where($usrchptrid,'system_subentites');
    $chapternm   = $chapterobj->description;
*/
/*
echo(512);
print_r($retry); 
print_r($recid);
print_r($_SESSION['tab']); die();
*/
    if($retry == 'yes'){
      $retry = 'no'; // reset - not sure if necessary
      $data = $_POST;
      unset($_POST['submit']);// not in DB will cause error
//print_r($_POST); die();

      // need to reset dropdowns to attempted values ???

    }else{ // getting record to edit
      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid); 
        
// echo(529);
// print_r($data); die();

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
 //echo(547);
 //print_r($_SESSION['admode']); die();

 switch($_SESSION['admode']) { // 

       case 'mmyads': // ccmp updating from manage page

      $_SESSION['admode']   = 'mmyadsu'; // updating 
      $data['bc1']          = 'MSP';
      $data['bc2']          = 'Update Notice';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Notice:';
//print_r($_SESSION['admode']); die();
  break;

  case 'mmyadsv': // ccmp updating from view page

      $_SESSION['admode']   = 'mmyadsu'; // updating 
      $data['bc1']          = 'MSP';
      $data['bc2']          = 'Update Notice';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Notice:';
//print_r($_SESSION['admode']); die();
  break;

  case 'mmyadsu': // ccmp refreshed page while editing

      $_SESSION['admode']   = 'mmyadsu'; // updating 
      $data['bc1']          = 'MSP';
      $data['bc2']          = 'Update Notice';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Notice:';
//print_r($_SESSION['admode']); die();
  break;

  case 'cmmads': // content manager updating any notice from manage page

        $_SESSION['admode'] = 'cmmadsu'; // updating 
        $data['bc1']        = 'Content Mgmt';
        $data['bc2']        = 'Update Notice';
        $data['header']     = 'Updating A Notice';
        $data['subheader']  = 'Content Manager';
      //  $data['chapternm']  = $chapternm; // set dropdown?
  break;

  case 'cmmadsv': // content manager updating any notice from view page

        $_SESSION['admode'] = 'cmmadsu'; // updating 
        $data['bc1']        = 'Content Mgmt';
        $data['bc2']        = 'Update Notice';
        $data['header']     = 'Updating A Notice';
        $data['subheader']  = 'Content Manager';
      //  $data['chapternm']  = $chapternm; // set dropdown?
  break;

  case 'momads': // chapter admin updating a chapter notice from manage page

        $_SESSION['admode'] = 'momadsu'; // updating 
        $data['bc1']        = 'Content Mgmt';
        $data['bc2']        = 'Update Notice';
      //  $data['chapternm']  = $chapternm;// set dropdown?
  break;

  case 'momadsv': // chapter admin updating a chapter notice from view page

        $_SESSION['admode'] = 'momadsu'; // updating 
        $data['bc1']        = 'Content Mgmt';
        $data['bc2']        = 'Update Notice';
      //  $data['chapternm']  = $chapternm;// set dropdown?
  break;

  }
  
/*------------------------- Populate Dropdowns  ------------------------------*/

    // scopes dropdown
    $data['scopes'] = $this->model->get('id', 'ccmps_scopes'); 

     if($_SESSION['admode'] == 'mmyadsu' || $_SESSION['admode'] == 'momadsu'){
    // remove the public option which is the first element for ccmp or CA
        unset($data['scopes'][0]);
     }

    // Header Information
    $data['chapternm']   = $_SESSION['chapter_name'];
    
    // To control input fields
    $data['recid']         = $recid;
//print_r($recid); die();
    $data['view_module']   = 'cms/notices';
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

function create($retrying = ''){ // only used by CA Adding - may be first time or
                            // with values after failed validation
  $ntcfunction = 'create';
  $authorized = $this->_check_function_permissions($ntcfunction); 

/*------------------ Get logged in user's info & preferences -----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
  $retry = $retrying; // for failed validation repost
//echo(679);
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
    $data['scopes'] = $this->model->get('id', 'ccmps_scopes'); 

    // chapters dropdown for member admin only - ccmp & chapter admin default
    //  to home chapter
    $data['chapters'] = $this->model->get('id','system_subentites'); 
    
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

 switch($_SESSION['admode']) {

  case 'mmyads': // ccmp creating from manage page (only page can create from)

      $tgusrid   = $_SESSION['tg_user_id']; // managing your own you logged in
      $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
              'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
      
      $data['header']     = 'Creating a New Notice';      
      $data['subheader']= $poster_obj->salutation.' '.$poster_obj->first_name.
' '.$poster_obj->middle_name.' '.$poster_obj->last_name.' '.$poster_obj->suffix;
      $_SESSION['admode'] = 'mmyadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create My New Notice';

  break;

  case 'mmyadsc': // ccmp refreshed page during the create

      $tgusrid   = $_SESSION['tg_user_id']; 
      $poster_obj = $this->model->get_one_where
                    ('trongate_user_id', $tgusrid, 'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
      
      $data['header']     = 'Creating a New Notice';      
      $data['subheader']  = 'for '.$poster_obj->salutation.' '.
      $poster_obj->first_name.' '.$poster_obj->middle_name.' '.
      $poster_obj->last_name.' '.$poster_obj->suffix;
      $_SESSION['admode'] = 'mmyadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create My New Notice';

  break;

  case 'cmmads': // content manager

      $_SESSION['admode'] = 'cmmadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create New Notice';
      $data['header']     = 'Creating a New Notice';
      $data['subheader']  = 'Content Manager';
  break;

  case 'cmmadsc': // content manager refreshed page during the create

      $_SESSION['admode'] = 'cmmadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create New Notice';
      $data['header']     = 'Creating a New Notice';
      $data['subheader']  = 'Content Manager';
  break;

  case 'momads': // chapter admin

      $_SESSION['admode'] = 'momadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create New Notice';
      $data['header']     = 'Creating a New '.SUBENTITY.' Notice';

  break;

  case 'momadsc': // chapter admin refreshed page during the create

    //  $_SESSION['admode'] = 'momadsc'; // already this value
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create New Notice';
      $data['header']     = 'Creating a New '.SUBENTITY.' Notice';

  break;
}

        $data['view_module']   = 'cms/notices';
        $data['view_file']     = 'crud'; 

  // print_r($data); die();

        $this->templates->inspinia($data);

}

/*----------------------------------------------------------------------------*/
/*----------------------- End function create --------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*--------------------------- FUNCTION SUBMIT --------------------------------*/
/*----------------------------------------------------------------------------*/

  function submit() {
  $ntcfunction = 'submit';
  $authorized = $this->_check_function_permissions($ntcfunction); 

  $recid = segment(3); // if updating there will be a record id

  $submit = post('submit', true);

  $crud = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crud  = 'updating';
  }else{
     $crud  = 'adding';
  }

/*  
  echo(869);
  echo('<br>');
  echo('$_session[ccmp_rec_id] = ');
  print_r($_SESSION['ccmp_rec_id']);
  echo('<br>');
  echo('$_session[admode] = ');
  print_r($_SESSION['admode']);
  echo('<br>');
  echo('$_session[tab] = ');
  print_r($_SESSION['tab']);
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
  print_r($_POST); die();
*/

  if ($submit == 'Submit') { // If updating or creating

/*
echo(896);
echo('<br>');
echo('if $submit == Submit TRUE');
echo('<br>');
echo('$recid = ');
print_r($recid); die();
*/

    if($recid > 0){ // updating
      
        if($_SESSION['tab'] == 1){ 

        // these fields only occur on tab 1 Dont want to fail editing other tabs
        // Could be defaulted to tab 1 but on create form but recid should be 0.
          $titlelen = strlen($_POST['title']);        
          $msglen = strlen($_POST['shortdescription']);
       $this->validation_helper->set_rules('title', 'Title field is '.$titlelen.
           ' characters long and the', 'required|min_length[1]|max_length[36]');
          $this->validation_helper->set_rules('shortdescription', 'Message field'
          . ' is '.$msglen.' characters long and the',
             'required|min_length[1]|max_length[56]');
// $this->validation_helper->set_rules('email_address', 'Email',
//  'required|valid_email');
// $this->validation_helper->set_rules('password', 'Password',
//  'required|min_length[6]'); // field is hidden 
         // $result = $this->validation_helper->run();  
// using JS but no max length checker
           $result = 1;

     //     echo(922); die();
        }else{ // not on tab 1 pass them because $result need a value later on

            $result = 1;
        }
      }else{ // adding new record
          
          $titlelen = strlen($_POST['title']);        
          $msglen = strlen($_POST['shortdescription']);
          $this->validation_helper->set_rules('title', 'Title field is '.
 $titlelen.' characters long and the', 'required|min_length[1]|max_length[36]');
          $this->validation_helper->set_rules('shortdescription',
          'Message field is '.$msglen.' characters long and the',
          'required|min_length[1]|max_length[56]');

          // validate the form - if it fails to will keeep executing and $result
          // evaluated after all none validation_helper checks are run
        //  $result = $this->validation_helper->run();   
             $result = 1;       
      }

/*
echo(943);
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
//print_r($recid); die();
            $adsdata = $_POST;
            unset($adsdata['submit']);

//echo(961);
//print_r($adsdata); die();
            // Add timestamps
            $adsdata['updated_at'] = TIME();
            $adsdata['created_at'] = TIME(); // reset created when edit
      
            $this->model->update($recid, $adsdata, 'ccmps_notices');

// echo(969);
// print_r("Updated Data Saved!"); die();
// print_r($_SESSION['admode']); die();

            // Auditlog
            $type  = 'update';
            $action = 'SubmitUpdate'; 
            $func = 'notices-sumbit-updating';
            $un   = 'UN: '.$_SESSION['ccmp_username'];
             $format = 'minitime'; // I added to Timedate.php
             $this->module('timedate');            
             $timestamp = time();
             $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: ccmps_notices';
            $str5 = 'Title: '.$adsdata['title'];
            $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
            switch($_SESSION['admode']) {

             case 'mmyadsu': // CCMP managing my notices

                 $_SESSION['admode'] = 'mmyadsv'; 
                 $this->viewntc($recid);

             break;

             case 'momadsu': // CA managing chapter notices

                 $_SESSION['admode'] = 'momadsv';
                 $this->viewntc($recid);

             break;

             case 'cmmadsu': // CM managing all notices
                   $_SESSION['admode'] = 'cmmadsv';
                   $this->viewntc($recid);

             break;

           }
 

        }else{ // Passed Adding - only one place you add from and thats manage.
        // Show new record after adding. Remove from the $_POST since adding
        // thus dont use _get_a_single_record which gets from DB
            $adsdata = $_POST;
            unset($adsdata['submit']);
// echo(1008);
// print_r($_SESSION['admode']); die();

// dont let chapter admin or ccmp change the chapter only the content manager
// the chapter dropdown is disable for adding - need to assign chapter
       if($_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'momadsc'){ 

                $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
                $chptnum = $usrobj->chapter;
                $adsdata['chapter'] = $chptnum; // this is where it s assigned when adding

        }else{ // ccmadsc
                $adsdata['chapter'] = $_POST['chapter'];
        }
// echo(1022);
// print_r($adsdata['chapter']); die();

        // Add timestamps
        $adsdata['updated_at'] = TIME();
        $adsdata['created_at'] = TIME(); 

//echo('1173 about to insert a new notice: ');
//print_r($adsdata); die();
        //insert the new ccmp account record            
        $this->model->insert($adsdata, 'ccmps_notices');
// echo('Line 1033 - New notice record added!'); die();   
 
    
// get the new record's id so can view 
// OR when need to add to other tables with this foreign key
        $new_id = $this->model->get_max('ccmps_notices');
                
        // Auditlog
        $type  = 'insert';
        $action = 'CreateNotice';
        $func = 'notices-sumbit-adding';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$new_id;
        $str4 = 'Tbl: ccmps_notices';
        $str5 = 'Title: '.$adsdata['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyadsc': // CCMP view new notice that was just added
              $_SESSION['admode'] = 'mmyadsv';
              $this->viewntc($new_id);

          break;

          case 'momadsc': // CA iew new notice that was just added
              $_SESSION['admode'] = 'momadsv';
              $this->viewntc($new_id);

          break;

          case 'cmmadsc': // CM view new notice that was just added
              $_SESSION['admode'] = 'cmmadsv';
              $this->viewntc($new_id);

          break;

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
/*------------------------ Function FULLNOTICE -----------------------------*/
/* Populates fulldescription.php view to show the fulldescription field       */
/*----------------------------------------------------------------------------*/

  function fullnotice() { // called ccmphome view <a> tag
  $ntcfunction = 'fullnotice';
  $authorized = $this->_check_function_permissions($ntcfunction); 

 $notice_id = segment(3);
// $tgusrid = segment(4);
$_SESSION['tab'] = 3; // notice board section - open collapse when close notice
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences -----------------*/

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//echo(1114);
//print_r($notice_id); die();
//
// Get record to view
 
      $adobj = $this->model->get_where($notice_id,'ccmps_notices');

      $data['title']             = $adobj->title;
      $data['shortdescription']  = $adobj->shortdescription;
      $data['fulldescription']   = $adobj->fulldescription;
      $data['contact_info']      = $adobj->contact_info;
      $data['alt_contact_info']  = $adobj->alt_contact_info;
      $data['cost']              = $adobj->cost;
      $data['current_bid']       = $adobj->current_bid;
      $data['ccmp_id']           = $adobj->ccmp_id;
      $data['updated_at']        = $adobj->updated_at;
      $data['created_at']        = $adobj->created_at;
      $tgusrid                   = $adobj->tg_user_id;

  // Translate codes
      $tgusrid   = $adobj->tg_user_id;
      // Check the ccmp 
      $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid, 'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

      $this->module('timedate');
      $format = 'datepicker_us';
      $data['created_at']  = $this->timedate->get_nice_date($data
              ['created_at'], $format);
      $data['updated_at']  = $this->timedate->get_nice_date($data
              ['updated_at'], $format);
 //print_r($data['created_at']); die();     
      $data['bc1'] = 'MSP';
      $data['bc2'] = 'View Notice';

      $data['view_module']      = 'cms/notices';
      $data['view_file']        = 'fulldescription'; 

//echo(1152);
//print_r($data); die();
      
        $this->templates->inspinia($data);

  }
  
/*----------------------------------------------------------------------------*/
/*------------------------------- End fullnotice ---------------------------*/
/*----------------------------------------------------------------------------*/
  
/*----------------------------------------------------------------------------*/
/*--------------------------- SUPPORTING FUNCTIONS ---------------------------*/
/*----------------------------------------------------------------------------*/  
  
    function _get_a_single_record($recid) {  //called from line xxx when viewing
    // protected - private function
    // & line xxx when updating and xxx for my data

//print_r($recid); die();
    // Get an object of the record data to be shown

        $addata = $this->model->get_where($recid,'ccmps_notices');

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
        $startdate    = $addata->startdate;
        $enddate      = $addata->enddate;
        $date_created = $addata->date_created;
        $updated_at   = $addata->updated_at;
        $created_at   = $addata->created_at;

//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report

        $date_created_raw = $addata->date_created;
        $updated_at_raw   = $addata->updated_at;
        $created_at_raw   = $addata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        $format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
        $this->module('timedate');

        $created_at = $this->timedate->get_nice_date($created_at, $format);

        $startdate = $this->timedate->get_nice_date($startdate, $format);
        $enddate   = $this->timedate->get_nice_date($enddate, $format);

        $datecreated   = $this->timedate->get_nice_date($date_created, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $this->timedate->get_nice_date($created_at, $format);
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);
//print_r($createdat); die();

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
 //   echo('Line 1288'); 
//print_r($data); die();
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

        $this->model->update($recid, $data, 'ccmps_notices');

       // echo(1321);
       // print_r($_SESSION['ccmpmode']); die();
       
        // Auditlog
        $type  = 'update';
        $action = 'ApproveNotice';
        $func = 'notices-approverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_notices';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-notices/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-notices/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-notices/manage/cmmads');

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

        $this->model->update($recid, $data, 'ccmps_notices');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'DisapproveNotice';
        $func = 'notices-unapproverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_notices';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-notices/manage/mmyads');

          break;
     
          case 'momads': // CA managing our chapter record
                redirect('cms-notices/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-notices/manage/cmmads');

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

        $this->model->update($recid, $data, 'ccmps_notices');

       // echo(1384);
       // print_r($_SESSION['admode']); die();
  
        // Auditlog
        $type  = 'update';
        $action = 'HideNotice';
        $func = 'notices-hiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_notices';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['sysadmin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-notices/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-notices/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-notices/manage/cmmads');

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

        $this->model->update($recid, $data, 'ccmps_notices');

       // echo(1412);
       // print_r($_SESSION['admode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'UnhideNotice';
        $func = 'notices-unhiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_notices';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['studentadmin'].' ChpAdmin='.$_SESSION['chapteradmin'] .' MemAdmin='.$_SESSION['member_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-notices/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-notices/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-notices/manage/cmmads');

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
    $result = $this->model->delete($recid,'system_auditlog');
// print_r($result); die(); // always null even if successsful

    //  Auditlog
        $type  = 'delete';
        $action = 'HardDeleteLog';
        $func = 'notices-delrecord';
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
    // Get user's fontsize preferences: staff from honcho_user_accounts, members from ccmps
    if(!empty($_SESSION['honcho_logged_in'])){
        $user_obj               = $this->model->get_where(intval($_SESSION['honcho_acct_rec_id']),'honcho_user_accounts');
        $_SESSION['fontsize']   = $user_obj ? $user_obj->fontsize : 2;  // view pages
        $_SESSION['mfontsize']  = $user_obj ? $user_obj->tfontsize : 3; // manage page
    }else{
    // Get ccmp's fontsize preferences for manage page and all other pages
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id,'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize;  // view pages
    $_SESSION['mfontsize']      = $ccmp_obj->mfontsize; // manage page 
    }
    
    
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
        // Every page here is system-admin only, checked once in __construct()
        // by system_admin_only(). The per-function checks that used to be here
        // were copied from Notices and let any logged-in member in.
        return true;
    }

} // End controller
