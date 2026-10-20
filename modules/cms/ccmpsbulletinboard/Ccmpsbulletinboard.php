<?php

class Ccmpsbulletinboard extends Trongate {

  function _construct(){
    $this->parent_module = 'cms';
    $this->child_module  = 'ccmpsbulletinboard';
  }
  
  function _destruct(){
    $this->parent_module = '';
    $this->child_module = '';
  }

  function index() {
    $bbfunction = 'index';
    $authorized = $this->_check_function_permissions($bbfunction); 

    echo "CMS-bulletinboard-index()"; die();

  }

  function bulkaction() {
  $bbfunction = 'bulkaction';
  $authorized = $this->_check_function_permissions($bbfunction); 

   //     print_r($_SESSION); die();
        
//echo(24);
//print_r($_POST); // array of ids called id
    
//print_r($_POST['selected']); die(); // the dropdown item id - for option button <not <li><a>
          
        $data = $_POST; // array of record ids called id & the dropdown item id
        
        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action
 
        break;
               
         case '2':        
                if(!isset($data)){
                   die('2Nothing Checked - use browser back button');
                }else{
  print_r($data); die('Approve Bulletins not available yet - use browser back button');
                }       
               
        break;
        
         case '3': 
                if(!isset($data)){
                   die('3Nothing Checked - use browser back button');
                }else{
  print_r($data); die('Disapprove Bulletins not available yet - use browser back button');
                }                    
        break;

        
         case '4':        
                if(!isset($data)){
                   die('4Nothing Checked - use browser back button');
                }else{
  print_r($data); die('Hide Bulletins not available yet - use browser back button');
                }       
               
        break;
        
         case '5': 
                if(!isset($data)){
                   die('5Nothing Checked');
                }else{
  print_r($data); die('Unhide Bulletins not available yet - use browser back button');
                }                    
        break;
        
         case '6':  // bulk delete           
                if(!isset($data)){
                   die('6Nothing Checked - use browser back button');
                }else{
 //  print_r($data);                 
//  print_r($data['id']) ; die('Delete');                  
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number
                           
//print_r($delid );  
                            // Need to grab title before delete for the log
                            $adobj = $this->model->get_where($delid,'ccmps_bulletins');
                            $title = $adobj->title;
                           // print_r($title); die();
                              
                            


                            // Hard delete
                            $this->model->delete($delid, 'ccmps_bulletins');
//echo('Deleted!'); die();

                            // Auditlog
                            $type  = 'bulkdelete';
                            $action = 'HardDeleteBulletin';
                            $func = 'bulletinboard-bulkaction-case 6';
                            $un   = 'UN: '.$_SESSION['ccmp_username'];
                             $format = 'minitime'; // I added to Timedate.php
                             $this->module('timedate');            
                             $timestamp = time();
                             $time   = $this->timedate->get_nice_date($timestamp, $format);
                            $time = $time.' UTC';
                            $str3 = 'Rec: '.$delid;
                            $str4 = 'Tbl: ccmps_bulletins';
                            $str5 = 'Title: '.$title;
                            $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];
                            
                            $this->module('system-auditlogger');
                            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);                            
                            
                            //print_r('deleted all'); die(); 
                        }else{
                            echo('Line 120 Bulletinboard.php - row IS BLANK - use browser back button'); die();
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
    //    print_r($_SESSION['admode']); die();
        
        switch($_SESSION['admode']) {

          case 'mmyads': //  Chapter Admin managing your chapter bulletins
                redirect('cms-bulletinboard/manage/mmyads');

          break;

          case 'momads': //  Chapter Admin managing your chapter bulletins
                redirect('cms-bulletinboard/manage/momads');

          break;

          case 'cmmads': // Content Mgr managing all records
                redirect('cms-bulletinboard/manage/cmmads');

          break;

        }        

  }
/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
    function manage(){ 
//echo(165); die();
/*---------------------------- Security Checks -------------------------------*/
  $bbfunction = 'manage';
  $authorized = $this->_check_function_permissions($bbfunction); 
//echo(167);
//print_r($_SESSION['tab']); die(); // =0 when return to ccmphome dont open any tab
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
  
  //  echo(57); 
    //print_r($_SESSION['admode'] ); die(); // for debugging

    switch ($_SESSION['admode']){
        
    case 'mmyads'; // logged in user is acting as himself
// what chapter does the poster belong to
    $ccmp_id  = $_SESSION['ccmp_rec_id'];
    $ccmp_obj = $this->model->get_where($ccmp_id,'ccmps');

    $tg_user_id      = $ccmp_obj->trongate_user_id;
    $chapteradmin    = $ccmp_obj->chapter_admin;
    $chapter         = $ccmp_obj->chapter;

    $chapterobj      = $this->model->get_where($chapter,'system_subentities');
    $chapter_name    = $chapterobj->description;        

    $chapter_role    = $ccmp_obj->chapter_role;
    $chapter_role_id = $ccmp_obj->chapter_role;

    // get dropdown for all tabs 
    $data['bulk_actions'] = $this->model->get('id','bulletins_bulk_actions');
    
 //   print_r($data['bulk_actions']); die();
    unset($data['bulk_actions'][1]); // Cannot approve
    unset($data['bulk_actions'][2]); // Cannot Disapprove
    unset($data['bulk_actions'][6]); // Cannot Archive
    
    /*-------------------- Get Appropriate Bulletins -----------------------*/

    $sql = "SELECT * FROM ccmps_bulletins WHERE tg_user_id = $tg_user_id";
        
    //$sql = "SELECT * FROM ccmps_bulletins WHERE chapter = $chapter AND"
    //        . " tg_user_id = $tg_user_id";
    //        
    // Dont need the chapter parameter if have tg User Id could change chapters
    // Order By ignored by Datatables. Also if the value of any hidden input
    // field in a form is = NULL the recs wont be included in the result set!

    // create the $data array and fill it with the rows from the table
    $data['rows'] = $this->model->query($sql,'object');

    //print_r($data['rows']); die(); // for debugging
    
    break;

    case 'momads';

// Chapter the chapter admin belongs to. Can only work with those records.
    $ccmp_id  = $_SESSION['ccmp_rec_id'];
    $ccmp_obj = $this->model->get_where($ccmp_id,'ccmps');

    $tg_user_id      = $ccmp_obj->trongate_user_id;
    $chapteradmin    = $ccmp_obj->chapter_admin;
    $chapter         = $ccmp_obj->chapter;

    $chapterobj      = $this->model->get_where($chapter,'system_subentities');
    $chapter_name    = $chapterobj->description;        

    $chapter_role    = $ccmp_obj->chapter_role;
    $chapter_role_id = $ccmp_obj->chapter_role;        
        
    $sql = "SELECT * FROM ccmps_bulletins WHERE chapter = $chapter"; 
    
    // create a $data array and fill it with the rows from the table
    $data['rows'] = $this->model->query($sql,'object');

    // get dropdown for all tabs 
    $data['bulk_actions'] = $this->model->get('id','bulletins_bulk_actions');
   
    break;

    case 'cmmads';
    $sql = "SELECT * FROM ccmps_bulletins"; // get all the records to manage

    // create a $data array and fill it with the rows from the table
    $data['rows'] = $this->model->query($sql,'object');
  // echo(273);
 //  print_r($data['rows']); die();
    // get dropdown for all tabs 
    $data['bulk_actions'] = $this->model->get('id','bulletins_bulk_actions');
 //  echo(277);
 //  print_r($data['bulk_actions']); die();
   
    break;
    }
    
    // step through the array of records and pull out needed values for view pg
    foreach($data['rows'] as $row) {  

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.
            
    $tgusrid   = $row->tg_user_id;
//print_r($tgusrid ); die();

//         echo(297); die();     
            $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); 
            $user_acct_table = $tgusrobj->user_acct_info_table;
                   
            // Get the poster's name for each record 
            $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid, $user_acct_table);
                       

            $row->poster =  $poster_obj->first_name.' '.$poster_obj->last_name;
      
//print_r($row->poster); die();

/*----------- Change values to display descriptions instead of code ----------*/

    $scopeobj   = $this->model->get_where($row->scope, 'ccmps_scopes');             
    $row->scope = $scopeobj->title;
//print_r($row->scope); die();
/*    switch($row->scope) {
    case '1':  
            $scopeobj   = $this->model->get_where($row->scope, 'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break; 

    case '2':  
            $scopeobj   = $this->model->get_where($row->scope, 'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break;

    case '3':  
            $scopeobj   = $this->model->get_where($row->scope, 'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break;

    }  */
    
   // unset($data['bulk_actions'][0]); // NA - used with std HTML dropdown with submit button   
   // $chapterrole = $row->chapter_role; 
    $chapterrole = $poster_obj->chapter_role; // was $row->chapter_role
 // print_r($chapterrole); die();
    $chapterobj = $this->model->get_where($chapterrole,'ccmps_chapter_offices');
    $row->chapter_role = $chapterobj->description;

    $chapterid    = $row->chapter;
    $chapterobj   = $this->model->get_where($chapterid,'system_subentities');
    $row->chapter = $chapterobj->description;
//print_r($row->chapter); die();
    $this->module('timedate');
    $format = 'datepicker_us';
    $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
    $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);

    if($row->updated_at == '01/01/1970'){
      $row->updated_at = ' ';
    }
//print_r(350); die();
    } // end foreach

//print_r(352); die();

    /*----------- Add $data array elements for manage view -----------------*/
    
    $data['logged_in']     = $_SESSION['logged_in'];
    $data['home_page']      = 0;

    $data['content_name']   = SITENAME;  
//  $data['chapter_name']  = $chapter_name; // do anything with this ???

    $data['view_module']   = 'cms/bulletinboard';
    $data['view_file']     = 'manage'; // 

    //echo(190); 
    //print_r($_SESSION['admode'] ); die(); // for debugging
    
    switch($_SESSION['admode']) { 

    case 'mmyads': // managing your own ads/bulletins

          $data['bc1']          = 'MSP';
          $data['bc2']          = 'Manage My Bulletins';
          $data['salutation']   = $ccmp_obj->salutation;
          $data['first_name']   = $ccmp_obj->first_name;
          $data['middle_name']  = $ccmp_obj->middle_name;
          $data['last_name']    = $ccmp_obj->last_name;
          $data['suffix']       = $ccmp_obj->suffix;
          $data['header']       = 'Manage My Bulletins';

    break;

    case 'momads': // chapter admin

          $data['bc1']         = 'CMS';
          $data['bc2']         = SUBENTITY.' Bulletins';
          $data['activity']    = SUBENTITY.' Admin';
          $data['header']      = 'Manage '.SUBENTITY.' Bulletins';
    break;

    case 'cmmads': // content manager

          $data['bc1']         = 'CMS';
          $data['bc2']         = 'All Bulletins';
          $data['activity']    = 'Content Manager';
          $data['header']      = 'Manage Bulletins';
          
    break;

    }
    
    //    print_r($data['bulk_actions']); die();
  // print_r($data); die();
        $this->templates->inspinia($data);

  }

/*----------------------------------------------------------------------------*/
/*------------------------------ End manage ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION VIEW ---------------------------------*/
/*-------------------------------------------------- -------------------------*/
  
function viewbull($recid = NULL){ // recid which one to view

/*---------------------------- Security Check --------------------------------*/
  $bbfunction = 'view';
  $authorized = $this->_check_function_permissions($bbfunction, $recid); 

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
    $_SESSION['crudtab'] = segment(4);
    $vbe = ''; // reset
//echo(429); die();
  } // else viewing after editing so want to return to tab just edited so dont
    // change value of tab #
//echo(433);
//print_r($_SESSION['tab']); die(); // =1 when return to ccmphome dont open any tab

/*----------------- Get logged in user's info & preferences ------------------*/
  
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
/*---------------------------- Run Queries -----------------------------------*/ 
  // Get record to view
  $adobj = $this->model->get_where($recid,'ccmps_bulletins');
  
  $data['title']             = $adobj->title;
  $data['shortdescription']  = $adobj->shortdescription;
  $data['fulldescription']   = $adobj->fulldescription;
  $data['contact_info']      = $adobj->contact_info;
  $data['alt_contact_info']  = $adobj->alt_contact_info;
  $data['cost']              = $adobj->cost;
  $data['current_bid']       = $adobj->current_bid;
  
  $tgusrid        = $adobj->tg_user_id; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

/*--------------------- Convert to User Friendly Values ----------------------*/
  
  $data['created_at']        = $adobj->created_at;
  $data['updated_at']        = $adobj->updated_at;
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);

  $data['active'] = $adobj->active;
  if($data['active'] == 1){
  	$data['active'] = 'Yes';
  }else{ 
  	$data['active'] = 'No';
  }

  $data['alt_contact_only'] = $adobj->alt_contact_only;
  if($data['alt_contact_only'] == 1){
  	$data['alt_contact_only'] = 'Yes';
  }else{ 
  	$data['alt_contact_only'] = 'No';
  }

  $data['approved'] = $adobj->approved;
  if($data['approved'] == 1){
  	$data['approved'] = 'Yes';
  }else{ 
        $data['approved'] = 'No';
  }

  $data['scope'] = $adobj->scope;
    $scopeobj      = $this->model->get_where($data['scope'], 'ccmps_scopes');             
    $data['scope'] = $scopeobj->title;

  $data['chapter'] = $adobj->chapter;
    $chptrobj      = $this->model->get_where($data['chapter'], 'system_subentities');            
    $data['chapternm'] = $chptrobj->description;

/*  switch($data['scope'] ){ 
  case '1':
        $data['scope'] = 'Public';
  break;

  case '2':
        $data['scope'] = 'Members Only';
  break;

  case '3':
        $data['scope'] = SUBENTITY.' Members Only';
  break;

  } */
  
// print_r($_SESSION['tab']); die();
// print_r($_SESSION['admode']); die();

/*--------------------- Set Navbar & Header Information ----------------------*/

 switch($_SESSION['admode']) {

  case 'mmyads': // manage my bulletins

        $_SESSION['admode']   = 'mmyadsv'; // mange my ads/bulletins viewing 
        $data['bc1']          = 'MSP';
        $data['bc2']          = 'View A Bulletin';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
 //       $data['chapternm']    = $chapter_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;
        
  break;

  case 'mmyadsu': //  returns from or cancels update
                  // mmyadsu mode - do same as manage case

        $_SESSION['admode']   = 'mmyadsv'; // manage my ads/bulletins viewing 
        $data['bc1']          = 'MSP';
        $data['bc2']          = 'View A Bulletin';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
    //    $data['chapternm']    = $chapter_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;
        
  break;

  case 'mmyadsv': // Refresh page while viewing


        $_SESSION['admode']   = 'mmyadsv'; // manage my ads/bulletins viewing 
        $data['bc1']          = 'MSP';
        $data['bc2']          = 'View A Bulletin';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
  //      $data['chapternm']    = $chapter_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;
        
  break;

  case 'momads': // chapter admin from manage page
      
        $_SESSION['admode']   = 'momadsv'; // manage chapter viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Admin';
     
  break;

  case 'momadsv': // chapter admin refreshes page during view

        $_SESSION['admode']   = 'momadsv'; // manage chapter viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Admin'; 
        
  break;

  case 'momadsu': // chapter admin returns from or cancel update

        $_SESSION['admode']   = 'cmmadsv'; // manage chapter viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager'; 
        
  break;

  case 'cmmads': // content manager from manage page
      
        $_SESSION['admode']   = 'cmmadsv'; // manage all  viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager';

        
  break;

  case 'cmmadsv': // content manager refreshes page during view
      
        $_SESSION['admode']   = 'cmmadsv'; // manage all  viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager';

        
  break;

  case 'cmmadsu': // content manager returns from or cancels update 

        $_SESSION['admode']   = 'cmmadsv'; // manage all  viewing 
        $data['bc1']          = 'CMS';
        $data['bc2']          = 'View A Bulletin';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager'; 
        
  break;

}

/*--------------------------- Set Additional Values --------------------------*/

  $data['recid']         = $recid;
  $data['view_module']   = 'cms/bulletinboard';
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
  
  function update($retrying){  

  $recid = segment(3);
  $bbfunction = 'update';

  $authorized = $this->_check_function_permissions($bbfunction, $recid); 

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
      $_SESSION['crudtab'] = segment(4); // this comes from update button on the manage page if there is more than one crud section
      // this gets confused witht he collapses on ccmphome so make crudtab instead of tab
    }

/*
    $userobj     = $this->model->get_where($recid,'ccmps');
    $usrchptrid  = $userobj->chapter;
    $chapterobj  = $this->model->get_where($usrchptrid,'system_subentities');
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
      $data['bc2']          = 'Update Bulletin';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Bulletin:';
//print_r($_SESSION['admode']); die();
  break;

  case 'mmyadsv': // ccmp updating from view page

      $_SESSION['admode']   = 'mmyadsu'; // updating 
      $data['bc1']          = 'MSP';
      $data['bc2']          = 'Update Bulletin';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Bulletin:';
//print_r($_SESSION['admode']); die();
  break;

  case 'mmyadsu': // ccmp refreshed page while editing

      $_SESSION['admode']   = 'mmyadsu'; // updating 
      $data['bc1']          = 'MSP';
      $data['bc2']          = 'Update Bulletin';
  /*    $data['salutation']   = $ccmp_obj->salutation;
      $data['first_name']   = $ccmp_obj->first_name;
      $data['middle_name']  = $ccmp_obj->middle_name;
      $data['last_name']    = $ccmp_obj->last_name;
      $data['suffix']       = $ccmp_obj->suffix;
      $data['chapternm']    = $chapter_name; */
      $data['header']       = 'Updating My Bulletin:';
//print_r($_SESSION['admode']); die();
  break;

  case 'cmmads': // content manager updating any bulletin from manage page

        $_SESSION['admode'] = 'cmmadsu'; // updating 
        $data['bc1']        = 'CMS';
        $data['bc2']        = 'Update Bulletin';
        $data['header']     = 'Updating A Bulletin';
        $data['subheader']  = 'Content Manager';
      //  $data['chapternm']  = $chapternm; // set dropdown?
  break;

  case 'cmmadsv': // content manager updating any bulletin from view page

        $_SESSION['admode'] = 'cmmadsu'; // updating 
        $data['bc1']        = 'CMS';
        $data['bc2']        = 'Update Bulletin';
        $data['header']     = 'Updating A Bulletin';
        $data['subheader']  = 'Content Manager';
      //  $data['chapternm']  = $chapternm; // set dropdown?
  break;

  case 'momads': // chapter admin updating a chapter bulletin from manage page

        $_SESSION['admode'] = 'momadsu'; // updating 
        $data['bc1']        = 'CMS';
        $data['bc2']        = 'Update Bulletin';
      //  $data['chapternm']  = $chapternm;// set dropdown?
  break;

  case 'momadsv': // chapter admin updating a chapter bulletin from view page

        $_SESSION['admode'] = 'momadsu'; // updating 
        $data['bc1']        = 'CMS';
        $data['bc2']        = 'Update Bulletin';
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

    // chapters dropdown for member admin only - ccmp & chapter admin default
    //  to home chapter
    $data['chapters'] = $this->model->get('id','system_subentities'); 
    
/*---------------------------------------------------------------------------*/

    // Header Information
    $data['chapternm']   = $_SESSION['chapter_name'];
    
    // To control input fields
    $data['recid']         = $recid;
//print_r($recid); die();
    $data['view_module']   = 'cms/bulletinboard';
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
  $bbfunction = 'create';
  $authorized = $this->_check_function_permissions($bbfunction); 

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
    $data['chapters'] = $this->model->get('id','system_subentities'); 
    
//echo(906);
//print_r($_SESSION['admode']); die();
    
    if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'momads'){ // momads when CA creating bulletin

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
  $data['tg_user_id'] =  $_SESSION['tg_user_id']; 
  $data['ccmp_id']    =  $_SESSION['ccmp_rec_id'];


 switch($_SESSION['admode']) {

  case 'mmyads': // ccmp creating from manage page (only page can create from)

      $tgusrid   = $_SESSION['tg_user_id']; // managing your own you logged in
      $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
              'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
      
      $data['header']     = 'Creating a New Bulletin';      
      $data['subheader']= $poster_obj->salutation.' '.$poster_obj->first_name.
' '.$poster_obj->middle_name.' '.$poster_obj->last_name.' '.$poster_obj->suffix;
      $_SESSION['admode'] = 'mmyadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create My New Bulletin';

  break;

  case 'mmyadsc': // ccmp refreshed page during the create

      $tgusrid   = $_SESSION['tg_user_id']; 
      $poster_obj = $this->model->get_one_where
                    ('trongate_user_id', $tgusrid, 'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
      
      $data['header']     = 'Creating a New Bulletin';      
      $data['subheader']  = 'for '.$poster_obj->salutation.' '.
      $poster_obj->first_name.' '.$poster_obj->middle_name.' '.
      $poster_obj->last_name.' '.$poster_obj->suffix;
      $_SESSION['admode'] = 'mmyadsc'; // 
      $data['bc1']        = 'MSP';
      $data['bc2']        = 'Create My New Bulletin';

  break;

  case 'cmmads': // content manager

      $_SESSION['admode'] = 'cmmadsc'; // 
      $data['bc1']        = 'CMS';
      $data['bc2']        = 'Create New Bulletin';
      $data['header']     = 'Creating a New Bulletin';
      $data['subheader']  = 'Content Manager';
  break;

  case 'cmmadsc': // content manager refreshed page during the create

      $_SESSION['admode'] = 'cmmadsc'; // 
      $data['bc1']        = 'CMS';
      $data['bc2']        = 'Create New Bulletin';
      $data['header']     = 'Creating a New Bulletin';
      $data['subheader']  = 'Content Manager';
  break;

  case 'momads': // chapter admin

      $_SESSION['admode'] = 'momadsc'; // 
      $data['bc1']        = 'CMS';
      $data['bc2']        = 'Create New Bulletin';
      $data['header']     = 'Creating a New '.SUBENTITY.' Bulletin';

  break;

  case 'momadsc': // chapter admin refreshed page during the create

    //  $_SESSION['admode'] = 'momadsc'; // already this value
      $data['bc1']        = 'CMS';
      $data['bc2']        = 'Create New Bulletin';
      $data['header']     = 'Creating a New '.SUBENTITY.' Bulletin';

  break;
}

        $data['view_module']   = 'cms/bulletinboard';
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
  $bbfunction = 'submit';
  $authorized = $this->_check_function_permissions($bbfunction); 

  $recid = segment(3); // if updating there will be a record id

  $submit = post('submit', true);

  $crud = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crud  = 'updating';
  }else{
     $crud  = 'adding';
  }

//echo(1051); 
//print_r($_SESSION['tab']); die(); // = 0 

 /* 
  echo(1038);
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
echo(1092);
echo('<br>');
echo('if $submit == Submit TRUE');
echo('<br>');
echo('$recid = ');
print_r($recid); die();
*/

    if($recid > 0){ // updating
      
    

        // these fields only occur on tab 1 Dont want to fail editing other tabs
        // Could be defaulted to tab 1 but on create form but recid should be 0.
          $titlelen = strlen($_POST['title']);        
          $msglen = strlen($_POST['shortdescription']);
          $this->validation_helper->set_rules('title', 'Title field is '.$titlelen.
           ' characters long and the', 'required|min_length[1]|max_length[36]');
          $this->validation_helper->set_rules('shortdescription', 'Message field'
          . ' is '.$msglen.' characters long and the',
             'required|min_length[1]|max_length[56]');
 //         $this->validation_helper->set_rules('ontact_info', 'Contact Email', 'required|valid_email');
 //         $this->validation_helper->set_rules('alt_contact_info', 'Alternate Email', 'required|valid_email');
          $result = $this->validation_helper->run(); 
//echo(1116);
//print_r($result); die(); 


      }else{ // adding new record
          
          $titlelen = strlen($_POST['title']);        
          $msglen = strlen($_POST['shortdescription']);
  //        $this->validation_helper->set_rules('title', 'Title field is '.
 //$titlelen.' characters long and the', 'required|min_length[1]|max_length[36]');
 //         $this->validation_helper->set_rules('shortdescription',
 //         'Message field is '.$msglen.' characters long and the',
 //         'required|min_length[1]|max_length[56]');

          // validate the form - if it fails to will keeep executing and $result
          // evaluated after all none validation_helper checks are run
        //  $result = $this->validation_helper->run();  

        // using JS for not blank only
          $result = 1;        
      }

/*
echo(1145);
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


//print_r($adsdata); die();
            // Add timestamps
            $adsdata['updated_at'] = TIME();
            $adsdata['created_at'] = TIME(); // reset created when edit
            $adsdata['updated_by'] =  $_SESSION['tg_user_id']; 

            $this->model->update($recid, $adsdata, 'ccmps_bulletins');

// print_r("Updated Data Saved!"); die();
// print_r($_SESSION['admode']); die();

            // Auditlog
            $type  = 'update';
            $action = 'SubmitUpdate'; 
            $func = 'bulletinboard-sumbit-updating';
            $un   = 'UN: '.$_SESSION['ccmp_username'];
             $format = 'minitime'; // I added to Timedate.php
             $this->module('timedate');            
             $timestamp = time();
             $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: ccmps_bulletins';
            $str5 = 'Title: '.$adsdata['title'];
            $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];             
            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
            switch($_SESSION['admode']) {

             case 'mmyadsu': // CCMP managing my bulletins

                 $_SESSION['admode'] = 'mmyadsv'; 
                 $this->viewbull($recid);

             break;

             case 'momadsu': // CA managing chapter bulletins

                 $_SESSION['admode'] = 'momadsv';
                 $this->viewbull($recid);

             break;

             case 'cmmadsu': // CM managing all bulletins
                   $_SESSION['admode'] = 'cmmadsv';
                   $this->viewbull($recid);

             break;

           }
 

        }else{ // Passed Adding - only one place you add from and thats manage.
        // Show new record after adding. Remove from the $_POST since adding
        // thus dont use _get_a_single_record which gets from DB
            $adsdata = $_POST;
            unset($adsdata['submit']);
// echo(1222); die();
// print_r($_SESSION['admode']); die();

// dont let chapter admin or ccmp change the chapter only the content manager
// the chapter dropdown is disable for adding - need to assign chapter
       if($_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'momadsc'){ 
 //echo(1228);
// print_r($_SESSION['tg_user_id']); die();
                $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
                $chptnum = $usrobj->chapter;
                $adsdata['chapter'] = $chptnum; // this is where it s assigned when adding

        }else{ // ccmadsc
                $adsdata['chapter'] = $_POST['chapter'];
        }
// echo(1236); die();
// print_r($adsdata['chapter']); die();

        // Add timestamps
        $adsdata['updated_at'] = TIME();
        $adsdata['created_at'] = TIME(); 
        $adsdata['created_by'] =  $_SESSION['tg_user_id']; 

//echo('1245 about to insert a new bulletin: ');
//json($adsdata); die();
        //insert the new ccmp account record            
        $this->model->insert($adsdata, 'ccmps_bulletins');
 //echo('Line 1249 - New bulletin record added!'); die();   
 
    
// get the new record's id so can view 
// OR when need to add to other tables with this foreign key
        $new_id = $this->model->get_max('ccmps_bulletins');
              
        // Auditlog
        $type  = 'insert';
        $action = 'CreateBulletin';
        $func = 'bulletinboard-sumbit-adding';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$new_id;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$adsdata['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
     
        switch($_SESSION['admode']) {

          case 'mmyadsc': // CCMP view new bulletin that was just added
              $_SESSION['admode'] = 'mmyadsv';
              $this->viewbull($new_id);

          break;

          case 'momadsc': // CA view new bulletin that was just added
              $_SESSION['admode'] = 'momadsv';
              $this->viewbull($new_id);

          break;

          case 'cmmadsc': // CM view new bulletin that was just added
              $_SESSION['admode'] = 'cmmadsv';
              $this->viewbull($new_id);

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
/*------------------------ Function FULLBULLETIN -----------------------------*/
/* Populates fulldescription.php view to show the fulldescription field       */
/*----------------------------------------------------------------------------*/

  function fullbulletin() { // called ccmphome view <a> tag
  $bbfunction = 'fullbulletin';
  $authorized = $this->_check_function_permissions($bbfunction); 

 $bulletin_id = segment(3);
// $tgusrid = segment(4);
$_SESSION['tab'] = 3; // bulletin board section - open collapse when close bulletin
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences -----------------*/

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//echo(1114);
//print_r($bulletin_id); die();
//
// Get record to view
 
      $adobj = $this->model->get_where($bulletin_id,'ccmps_bulletins');

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
      $data['bc1'] = 'CMS';
      $data['bc2'] = 'View Bulletin';

      $data['view_module']      = 'cms/bulletinboard';
      $data['view_file']        = 'fulldescription'; 

//echo(1152);
//print_r($data); die();
      
        $this->templates->inspinia($data);
     // $this->view('layout', $data);

  }
  
/*----------------------------------------------------------------------------*/
/*------------------------------- End fullbulletin ---------------------------*/
/*----------------------------------------------------------------------------*/
  
/*----------------------------------------------------------------------------*/
/*--------------------------- SUPPORTING FUNCTIONS ---------------------------*/
/*----------------------------------------------------------------------------*/  
  
    function _get_a_single_record($recid) {  //called from line xxx when viewing
    // protected - private function
    // & line xxx when updating and xxx for my data

//print_r($recid); die();
    // Get an object of the record data to be shown

        $addata = $this->model->get_where($recid,'ccmps_bulletins');

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
        $createdat     = $created_at;
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
  $bbfunction = 'approverecord';
  $authorized = $this->_check_function_permissions($bbfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.


        $data['approved'] = 1;

        $this->model->update($recid, $data, 'ccmps_bulletins');

       // echo(1321);
       // print_r($_SESSION['ccmpmode']); die();
       
        // Auditlog
        $type  = 'update';
        $action = 'ApproveBulletin';
        $func = 'bulletinboard-approverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-bulletinboard/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-bulletinboard/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-bulletinboard/manage/cmmads');

          break;
        }

       
    }

    
  function unapproverecord() {
  $bbfunction = 'unapproverecord';
  $authorized = $this->_check_function_permissions($bbfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.


        $data['approved'] = 0;

        $this->model->update($recid, $data, 'ccmps_bulletins');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'DisapproveBulletin';
        $func = 'bulletinboard-unapproverecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-bulletinboard/manage/mmyads');

          break;
     
          case 'momads': // CA managing our chapter record
                redirect('cms-bulletinboard/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-bulletinboard/manage/cmmads');

          break;
        }
       
    }

    
    function hiderecord() {

    $recid = segment(3);
    $bbfunction = 'hiderecord';
    $authorized = $this->_check_function_permissions($bbfunction, $recid); 


        // if delete it doesnt matter where you came from you go back to manage
        //because intent at that time is not to see the details.

        $data['active'] = 0;

        $this->model->update($recid, $data, 'ccmps_bulletins');

       // echo(1384);
       // print_r($_SESSION['admode']); die();
  
        // Auditlog
        $type  = 'update';
        $action = 'HideBulletin';
        $func = 'bulletinboard-hiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-bulletinboard/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-bulletinboard/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-bulletinboard/manage/cmmads');

          break;
        }
       
    }

    function unhiderecord() {
    $bbfunction = 'unhiderecord';
    $authorized = $this->_check_function_permissions($bbfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['active'] = 1;

        $this->model->update($recid, $data, 'ccmps_bulletins');

       // echo(1412);
       // print_r($_SESSION['admode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'UnhideBulletin';
        $func = 'bulletinboard-unhiderecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin'];             
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
            
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-bulletinboard/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-bulletinboard/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-bulletinboard/manage/cmmads');

          break;
        }
       
    }

    
    function delrecord() { 
      $recid = segment(3); 
   //   print_r($recid); die();

      $bbfunction = 'delrecord';
      $authorized = $this->_check_function_permissions($bbfunction, $recid);

      $title = segment(4); 
//print_r($title); die();
//print_r($_SESSION['admode']);die();
    $result = $this->model->delete($recid,'ccmps_bulletins');
//print_r($result); die(); // NUll even if successful

    //  Auditlog
        $type  = 'delete';
        $action = 'HardDeleteBulletin';
        $func = 'bulletinboard-delrecord';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');            
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
     //     echo(1754); die(); 
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: ccmps_bulletins';
        $str5 = 'Title: '.$title;
        $str6 = 'CntMgr='.$_SESSION['content_mgr'].' StuAdmin='.$_SESSION['student_admin'].' ChpAdmin='.$_SESSION['chapter_admin'] .' MemAdmin='.$_SESSION['member_admin'].' SysAdmin='.$_SESSION['system_admin']; 
    //  echo(1760); die(); 
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
 //echo(1762); die();                           
        switch($_SESSION['admode']) {

          case 'mmyads': // CCMP managing my records
                redirect('cms-bulletinboard/manage/mmyads');

          break;
      
          case 'momads': // CA managing our chapter record
                redirect('cms-bulletinboard/manage/momads');

          break;
      
          case 'cmmads': // CM managing all records
                redirect('cms-bulletinboard/manage/cmmads');

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


    function _check_function_permissions($bbfunction, $recid = NULL) {
//echo(1515);
//print_r($bbfunction); die();

// need one for - index,manage,view, update,approverecord,create,delrecord,fullbulletin
// hiderecord,submit,unapproverecord,unhiderecord
 
//echo(1844);
//print_r($recid); die();

        switch($bbfunction) {

          case 'index': //

                redirect('welcome/logout'); 

          break;

          case 'bulkaction': // filters determine what bulk actions you have access to by role - only need to know logged in.

              if($_SESSION['ccmp_logged_in'] == 1){// 


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears session variables, flags and settings then redirects to login page

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

          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['chapter_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has chapter or member admin rights
            // authorized...continue
           // $data = "goodtogo"; not used
          //  return $data;

          }else{ // not an admin role
//print_r($recid); die();  
//print_r($mybulletins); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of bulletin not person. Need to know it belongs to person

            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
          //  if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where('id', $recid, 'ccmps_bulletins');
                $ownerid = $recobj->ccmp_id;
           //     print_r($ownerid);
           //     print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you
/*
                $ccmpri = $_SESSION['ccmp_rec_id'];
                $sql = "SELECT id FROM ccmps_bulletins WHERE ccmp_id = $ccmpri"; // 
                $mybulletins  = $this->model->query($sql,'array');
*/
           // }

          //  Is the record id of the bulletin in the array of my bulletin's record ids
          //    $inarray = array_search($recid, array_column($mybulletins, 'id')) ? "found" : "not found"; // looking at the values but wouldnt see the first one
          //  $inarray = isset($mybulletins[$recid]) ? "found" : "not found"; // looking at the keys
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
            // Here recid is of bulletin not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['chapter_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(1996); die();
//print_r($recid); die();  
//print_r($mybulletins); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){
     
   
                $recobj = $this->model->get_one_where('id', $recid, 'ccmps_bulletins');

                $ownerid = $recobj->ccmp_id;
        //print_r('2002'); 
        //print_r($ownerid); die();  

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

          case 'fullbulletin': //

        // anyone can see

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'approverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of bulletin not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'unapproverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of bulletin not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'hiderecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of bulletin not person. Need to know it belongs to person
         

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['chapter_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mybulletins); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where('id', $recid, 'ccmps_bulletins');
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
            // here recid is of bulletin not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'delrecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // Here recid is of bulletin not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['chapter_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has chapter or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mybulletins); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['admode'] == 'mmyads' || $_SESSION['admode'] == 'mmyadsc' || $_SESSION['admode'] == 'mmyadsv'){

                $recobj = $this->model->get_one_where('id', $recid, 'ccmps_bulletins');
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'delrecord';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to delete someone elses records'; 
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;


                           
        }

  }
    
} // End controller
