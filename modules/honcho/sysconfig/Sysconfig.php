<?php
class Sysconfig extends Trongate {

function _construct(){
  $this->parent_module = 'honcho';
  $this->child_module  = 'sysconfig';
}

function _destruct(){
  $this->parent_module = '';
  $this->child_module = '';
}

  function index() {
      
 // $ntcfunction = 'index';
//  $authorized = $this->_check_function_permissions($ntcfunction); 

    echo('Honcho-sysconfig-index()'); die();

  }
  
/* Ccmps Accounts  */

function task($task, $role_id, $recid, $theme, $frmpg){

//If token expired while logged in or if logged out will get 500 error
// so prevent 500 error by checking for token and redirecting to login page
// if necessary
  
$this->protect_backend();

  // get the number of unique functions in the ccmps_access table
//print_r($user_level); die();
  // get the permissions for each function in this submodule for the current user's user_level

$user_level = $_SESSION['tg_user_level'];

  for ($i = 1; $i <= 20; $i++) 
{
$sql = "SELECT * FROM sysconfig_access WHERE ccmps_access.action_id = $i AND ccmps_access.level_id = $user_level";

  $access_array = $this->model->query($sql,'array');

  print_r($access_array); die(); // only see the first one cause havent iterated thru table yet

${"action".$i. "_c"} =  $access_array[0]['create'];
${"action".$i. "_r"} =  $access_array[0]['read'];
${"action".$i. "_u"} =  $access_array[0]['update'];
${"action".$i. "_d"} =  $access_array[0]['delete'];
//print_r($func1_r); die();

} 
//print_r($action3_r); die();
//print_r($action3_d); die();

// //$x = $access_array[0]['read'];
 //$jim = $x;
// print_r($r); die();
//print_r($func1_r); die();
//  
//  $func1_r = $access_array[0]['read'];
 // $func1_c = $access_array[0]['create']; 
 // $func1_u = $access_array[0]['update'];
 // $func1_d = $access_array[0]['delete']; 

//print_r($func1_r ); die();


/*
//or can use this code in each function - set the $func_id
  // get the user level
  $this->module('trongate_tokens');
  $trongate_user_obj = $this->trongate_tokens->_get_user_obj();
  $user_level = $trongate_user_obj->user_level_id;

  $sql = "SELECT * FROM system_accounts_access WHERE system_accounts_access.func_id = $func_id AND system_accounts_access.level_id = $user_level";
  $access_array = $this->model->query($sql,'array');

print_r($access_array); die();
 // print_r($access_obj->read); die();
 // print_r($access_obj[0]['read']); die();
  $func_r = $access_array[0]['read'];
 // print_r($func_r); die();
*/



// For Debugging
/*
   echo('SA line 77 - In the order passed:');
   echo('<br>');
   echo('Task: ');
   print_r($task);
   echo('<br>');
   echo('Role Id: ');
   print_r($role_id);
   echo('<br>');
   echo('Rec id: '); // if no record id then adding, if so then editing
   print_r($recid);
   echo('<br>');
   echo ('Theme: ');
   print_r($theme);
      echo('<br>');
   echo('Came From Page: ');
   print_r($frmpg);
   echo('<br>');
    
  die();
*/

    $data['role_id'] = $role_id;  // capture who is doing this for privileges & auditing purposes



        // At the end of the day you are perfoming some operations on the data and returning a dataset to the
        // Honcho.php controller to display using the layoutone.php webapp template

/*---------------------------------------------------------------------------------------------*/

/*---------------------------- Export the Master Member Record Spreadsheet --------------------*/

/*---------------------------------------------------------------------------------------------*/

if ($task == 'export'){ 

    // get parent record data
    // query for all records - (syntax: 'order_by', 'table', limit, offset)
    $data = $this->model->get('member_no','ccmps'); // works manage
    // convert the object to an array to add additional data for the view 
    $data = (array)$data;
//      print_r($data); die();
    foreach($data as $row) { // step through the array of records and pull out needed values
      $ccmprecid = $row->id;
//print_r($ccmprecid); die();
      $addrobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_addresses');
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
 //     print_r($ccmprecid); die();

      // dont need any financial data for Master Spreadsheet
      //$finobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_financial');
      //print_r($finobj); die();

  }



  //    print_r($data); die();


      foreach($data as $row) { // step through the array of records and pull out needed values
    
          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from system_accounts
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/ 

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
          $levelname = $levelobj->level_title;  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->member_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
          $row->member_type = $memtypeobj->ccmp_type;

          $chapterid    = $row->chapter;
          $chapterobj   = $this->model->get_where($chapterid,'chapters_bpa');
          $row->chapter = $chapterobj->description;

          $chapterroleid     = $row->chapter_role;
          $chapterroleobj    = $this->model->get_where($chapterroleid,'ccmps_chapter_offices');
          $row->chapter_role = $chapterroleobj->description;

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'ccmps_certificate_types');
          $row->highest_certificate = $highcertobj->description;

          $fintypeid          = $row->fin_acct_type;
          $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
          $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          $finstatusid     = $row->fin_status;
          $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
          $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/
          if($row->chapter_admin == 1) { 
               $row->chapter_admin = 'TRUE';
          }else{ 
               $row->chapter_admin = 'FALSE';
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


} // for each
        // Add these elements to properly draw the screen

        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $data['content_name']   = "People"; 
        $data['contentfile']    = __DIR__."/../views/inspinia/export"; //dashboard file is a shell that calls those above
        $data['contentheader']  = ""; //not used                    
        $data['breadcrumb1']    = "Member Records"; // displayed in the content file
        $data['breadcrumb2']    = "Export Member Records"; // displayed in the content file
        $data['breadcrumb3']    = ""; // displayed in the content file      
        $data['recid']          = $recid; // record id to view
        $data['frmpg']          = $frmpg;
       
      //  $viewdata['picture']
//echo('Line 1023 - recid '); print_r($viewdata['recid'] );  
//echo(' Line 1023 - frmpg '); print_r($viewdata['frmpg'] ); die();

        // convert obj to array to add elements [otherwise lines like 543 will produce 500 error]
      
     //   $data = array_merge($viewdata, $data);
//print_r($data); die();
        return $data;
  }


/*---------------------------------------------------------------------------------------------*/

/*--------------------------- Task is Upload User Picture -------Not Used ---------------------*/

/*---------------------------------------------------------------------------------------------*/

if ($task == 'uploadccmpacctpic'){ 


 $submit = $this->input('submit', true); // = "Upload"

 // print_r($submit); die();
$this->submit_upload_picture($recid, $submit);

}



/*---------------------------------------------------------------------------------------------*/

/*-------------------------------------- Task is Create ---------------------------------------*/

/*---------------------------------------------------------------------------------------------*/

      if ($task == 'create'){ // get data for create.php form to update or just headed to add

/*
  echo('In system_accounts.php task = create');
  echo('<br>');
  echo ('Task: ');
  echo $task;
  echo('<br>');
  echo ('Role id: ');
  echo $role_id;
  echo('<br>');
  echo ('Theme: ');
  echo $theme;
  echo('<br>');
  echo ('Rec id: '); // // if no record id then adding, if so then editing
  echo $recid;
  echo('<br>');
  echo ('From pg: '); // where should flow return to when done - manage page (m) or view page (v)
  echo $frmpg;
  echo('<br>');
  echo ('$data: ');
  json($data);
  echo('<br>');    
  die();
*/

/*------------------------------------- Create - Updating -------------------------------------*/

        if (is_numeric($recid)){ // updating - get the current records data to edit

          // must have the flag set to true for updating or
          // get the tg user id on the record and comapare with the user logged in.
          // If the same you should be able to edit parts of your own record.
          $rec_obj = $this->_get_a_single_record($recid);
//          print_r($rec_obj); die();
          $rectgusrid = $rec_obj['trongate_user_id'];
          $loginusrid = $_SESSION['tg_user_id'];
/*
echo('loginusrid');          
print_r($loginusrid);
echo('<br>');
echo('rectgusrid');
print_r($rectgusrid); die();
*/
            if($action1_u > 0  || $loginusrid == $rectgusrid){ // must have the flag set to true for updating
    
//$this->module('trongate_tokens');
//$user_level = $this->trongate_tokens->_get_user_level($token);
//echo $user_level; //outputs (something like) 'admin'
          // Get an array of the record data to be edited

          $recdata = $this->_get_a_single_record($recid);
/*
echo('Line 555 - $recdata: ');
echo('<br>');
print_r($recdata); die();
*/

/* _get_a_single_record returns a record formatted for user friendly viewing, not editing.
  Need to pass ids for dropdowns and no the user friendly title or description
  Created in _get_a_single_record() when translate to user friendly these save original raw code
  These values were added to $recdata in _get_a_single_record()
     NAME                     CURRENT RECORD                      DROPDOWN RECORDSET ($xxx as $row)
  Member_Type              = $recdata['membertypeid']  line 2015  membertypes  line 2576
  gender                   = $ccmpdata['genderid']     line 1988  genders
  Account_Type             = $recdata['finaccttypeid'] line 2129  accttypes    line 2582
  Fin_status               = $findata['finstatusid']   line 2108  finstatuses  line 2585
  Chapter                  = $ccmpdata['chapterid']    line 1993  chapters     line 2579
  Chapter_Role             = $data['chapterroleid']    line 1998  chapterroles line 2582
  Highest_Certificate      = $data['highestcertid']    line 2002  highestcerts line 2585
  user_level_id (tg users) = $ccmpdata['tguserlevel']  line 1838  usrlvls     line 2573  $culid?
  mailstateid              = $addrdata['mailstateid']  line 2025  state_codes line 2579
  physstateid              = $addrdata['physstateid']  line 2030  "
  billstateid              = $findata['billstateid']   line 2078  "
  shipstateid              = $findata['shipstateid']   line 2085  "
Only what is in brackets is used in the CURRENT RECORD column
  use the _raw version of any date
 //date_created - use in new, not update
 date_updated
All the dropdown values are below in _add_view_page_update_header() line 2568

*/

          $data = $this->_add_view_page_update_header($recdata, $task, $recid, $user_level, $frmpg); // same as 573

      //    print_r($data); die();
// Full dataset posted from the create form line 952
// compiled from ccmps table _ccmp_fetch_data_from_post() line 1585, ccmps_financial table _financial_accounts_fetch_data_from_post() line 1675
          // line 970 will try to save updates to database

          $data['action3_d'] = $action3_d;

        //  print_r($action3_d); die(); //blank

            }else{  // not allowed to update
                // Set flash data

              //$flash_msg = ": Code 1.".$user_level.".U - Access denied to Update a System Account"; breadcrumb
                $flash_msg = "Error Code 1.".$user_level.".U.SA.167 - Access denied to Update a System Account";
                set_flashdata($flash_msg);

                // Need a space between the flash message and the breadcrumb2 right hash "/"
                $data['breadcrumb3'] = ' ';

                // Return to the page that called the update
                if ($frmpg == 'm'){

                  // return to manage page
                  $data = $this->_manage_all_records();

                }else{ // presumed to be "v" View - only two choices at this point m or v
                      
                  // return to view page
                  $data_sr = $this->_get_a_single_record($recid);

                  $data = $this->_add_view_page_header_data($data_sr, $task, $recid, $user_level, $frmpg);  
                }

            }

/*-------------------------------------- Create - Adding --------------------------------------*/

        }else{ // adding
            if($action1_c > 0){ // must have a true flag set for create
/*
 echo('Line 190 - adding new rec');
 echo('<br>');
 print_r($submit);
 echo('<br>');
 echo('Frmpg: ');
print_r($frmpg);
 echo('<br>');  
 print_r($data); die(); 
*/

                $data = $this->_add_view_page_create_header($data, $task, $recid, $user_level, $frmpg); // same as 591
//echo "line 237: ";
//  print_r($data); die();  

/*
 echo('Line 231 - adding new rec');
 echo('<br>');
 print_r($submit);
 echo('<br>');
 echo('Frmpg: ');
print_r($frmpg);
 echo('<br>');  
 print_r($data); die(); 
 */

            }else{
                // Set flash data
            //    $flash_msg = ": Code 1.".$user_level.".C - Access denied to Create a System Account"; for breadcrumbs
                $flash_msg = "Error Code 1.".$user_level.".C.SA.214 - Access denied to Create a System Account";
                set_flashdata($flash_msg);

                // Need a space between the flash message and the breadcrumb2 right hash "/"
                $data['breadcrumb3'] = ' ';

                // Return to the page that called it - only adding from the manage page currently

                $data = $this->_manage_all_records();

            }

        } // End Adding or Updating

      } // End task create


/*---------------------------------------------------------------------------------------------*/

/*------------------------------ Task is Manage a List of Records -----------------------------*/

/*------------------------------------------[READ]---------------------------------------------*/

      if ($task == 'manage'){ // action id for manage is 1 (action1_id = 1) in system_accounts_access

//echo('Task is manage'); die();
        $action1_r = 1; // ???
        if($action1_r > 0){
          $data = $this->_manage_all_records();
          print_r($data); die();
        }else{
          // Set flash data

        //  $flash_msg = ": Code 1.".$user_level.".R - Access denied to System Accounts"; breadcrumb
          $flash_msg = "Error Code 1.".$user_level.".R.SA.246 - Access denied to System Accounts";
          set_flashdata($flash_msg);

          // Need a space between the flash message and the breadcrumb2 right hash "/"
          $data['breadcrumb3'] = ' ';
          $data['breadcrumbfile'] = "admin/adminbreadcrumbserror";



/*
        $('.xyz').click(function () {
          swal({
            title: "Sweet!",
            text: "Here's a custom image.",
            imageUrl: 'thumbs-up.jpg'
          });
        });
 */
        }

      } // End if task is manage - goes to line 424 and returns $data back to Honcho.php



/*---------------------------------------------------------------------------------------------*/

/*--------------------------------------- Task is Delete --------------------------------------*/

/*------------------------------------------[DELETE]-------------------------------------------*/

      if ($task == 'del'){ // action id for delete is 2 (action1_id = 2) in system_accounts_access

        if($action2_d > 0){
          // Using the recid find the trongate_user_id so can delete from trongate_users table after deleting from system_accounts
          $delrec  = $this->model->get_where($recid,'ccmps');
          $tgusrid = $delrec->trongate_user_id;

          //Find and delete the record delete(id, table)
          $this->model->delete($recid, 'ccmps');

          // Unassociate any classes that were assigned to this course
          $this->model->delete($tgusrid, 'trongate_users');

          // Set flash data
          $flash_msg = 'The member record was successfully deleted.';
          set_flashdata($flash_msg);

/*-------------------------- Task is Delete - Coming from the Manage Page ---------------------*/


          // Return to the page that called the delete
          if ($frmpg == 'm'){ // return to manage

          $data = $this->_manage_all_records();

/*-------------------------- Task is Delete - Coming from the View Page -----------------------*/


          }else{ // presumed to be "v" View - only two choices at this point m or v
                 // also have to return to manage since deleted the record & cant return to single rec view

        // same code as above - placeholder for another future situation
          $data = $this->_manage_all_records();

          }
        }else{ // not allowed to delete
          // Set flash data

        //  $flash_msg = ": Code 1.".$user_level.".D - Access denied to Delete a System Account"; breadcrumb
          $flash_msg = "Error Code 1.".$user_level.".D.SA.312 - Access denied to Delete a System Account";
          set_flashdata($flash_msg);

          // Need a space between the flash message and the breadcrumb2 right hash "/"
          $data['breadcrumb3'] = ' ';

          // Return to the page that called the delete
          if ($frmpg == 'm'){ // return to manage

          $data = $this->_manage_all_records();

          }else{ // presumed to be "v" View - only two choices at this point m or v
                
                // return to view page
                $data_sr = $this->_get_a_single_record($recid);

                $data = $this->_add_view_page_header_data($data_sr, $task, $recid, $user_level, $frmpg);  
          }

        }
      } // End task delete

/*---------------------------------------------------------------------------------------------*/

/*-------------------------------- Task is View Single Record ---------------------------------*/

/*---------------------------------------------------------------------------------------------*/

      if ($task == 'view'){
/* 
  echo('In system_accounts.php line 130 task = view');
  echo('<br>');
  echo ('Task: ');
  echo $task;
  echo('<br>');
  echo ('Role id: ');
  echo $role_id;
  echo('<br>');
  echo ('Theme: ');
  echo $theme;
  echo('<br>');
  echo ('Rec id: ');
  echo $recid;
  echo('<br>');
  echo ('From pg: ');
  echo $frmpg;
  echo('<br>');    
  die();
  */

        $data_sr = $this->_get_a_single_record($recid);

/*
 echo('Line 405 - $data_sr');
 echo('<br>');
 print_r($data_sr); die();
*/
        //  echo('Line 368 - $action3_d = ');
       //   print_r($action3_d); die();
  //    print_r($action2_r); die();
       // $action = $action2_r;
         // View - Add view data to the Array - line 1011 - REPEATED line 507 - create header function
        $data = $this->_add_view_page_header_data($data_sr, $task, $recid, $user_level, $frmpg);

      //  print_r($data); die();  

      } // End task view - execution resumes on line 587 which returns $data to Honcho controller


/*---------------------------------------------------------------------------------------------*/

/*---------------------------------------- Task is Submit -------------------------------------*/

/*---------------------------------------------------------------------------------------------*/

      if ($task == 'submit'){ // passed by URL, not button.
//print_r($task); die();
          // old engine
          $submit = $this->input('submit', true); // name="submit" value="Submit" in button definition are passed by button

         // new engine
         // no solution yet to get Submit to pass from <button class="btn btn-rounded btn-outline btn-primary" type="submit" name="submit" value="Submit" >Save New Account</button>  and capture and assign to $submit

/*
echo('Line 272');
echo('<br>');
print_r($submit); die();
*/

/*-------------------------------------- submit = Submit --------------------------------------*/
/*--------------- A form full of data was submitted by selecting a save button --------------- */

        if ($submit == 'Submit') {
/*
 echo('Line 824 - submit == Submit');
 echo('<br>');
 print_r($data); die(); // only thing is role_id 
*/
          // field, field name in error msg, conditions - this reads from posted data without having to explicitly fetch it

          $this->validation_helper->set_rules('first_name',    'First Name', 'required|min_length[1]');
          $this->validation_helper->set_rules('last_name',     'Last Name', 'required|min_length[1]');
          $this->validation_helper->set_rules('email_address', 'Email', 'required|valid_email');
          $this->validation_helper->set_rules('username',      'Username', 'required|min_length[5]');
          $recid = $this->url->segment(5);
//print_r($recid); die();
          if($recid > 0){
            // editing so don't require password because the password field is only shown during adding
          }else{
            $this->validation_helper->set_rules('password', 'Password', 'required|min_length[5]');            
          }

          // validate the form
           $result = $this->validation_helper->run();  // nothing is required on the financial acct table
//echo($result); die();  // 1 or 0

          // frmpg (from page) - were you on the Manage page (m) or the View individual record page (v) when you pressed Update
          // so you can be redirected back there when save or cancel
          $frmpg  = $this->url->segment(6); 
          // print_r($frmpg); die(); 

          // posted data are separated into two different datasets $sysdata_post & $findata for evaluation
          // because you will need two separate datasets for the two sequel statements - update & insert 

          // Grab the ccmp table data from the post
          $ccmpdata_post = $this->_ccmps_fetch_data_from_post();
          $ccmpdata_post['frmpg'] = $frmpg;
        //  $update_id = $sysdata_post['recid'];
          $update_id = $recid;  // came in the URL not POST
          $ccmpdata_post['recid'] = $recid; // add recid from url to post data

        // Check the username that was submitted if adding & not unique set $result to 0.

//print_r($ccmpdata_post); die(); // no $userlevel
        // If editing and get a duplicate match, check to see if they are editing their own record so its ok
          // check to see if the username is already taken - somebody could attempt to change theirs to one that exists already
          $usrnm = $ccmpdata_post['username'];
          $usernm = trim($usrnm);
        $usr_obj = $this->model->get_one_where('username', $usernm, 'ccmps');
//print_r($usr_obj); die();              
          $recordfndid = $usr_obj->id;
//print_r($recordid); die();
          if($recordfndid > 0){ // record found id exists so there is a user with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid);
//echo('<br>');
//print_r($update_id); die();

            // check if record found id is same as the current user
            if($recordfndid == $update_id){

              // its the same user editing his own record so everything OK
              // nothing to do here just keep executing
              //echo('Found but Everything OK'); die();

            }else{ 

              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $flash_msg = 'Username already exists'; // this will occur also if somehow username is blank line 909 $recordfnid defaults to 1
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

              $result = 0;

            } // will keep executing if same username for the same guy
            

          } // the username wasnt found so keep executing

//print_r($result); die(); // = 1 if all ok so far. Tested for below


/*
echo('Line 312 - Create Form submitted - existence of an $recid will determine if adding or updating');
echo('<br>');
echo('$sysdata_post: ');
echo('<br>');                    
print_r($sysdata_post); die();
*/
          // Grab the financial table data from the post
          $findata_post = $this->_financial_accounts_fetch_data_from_post();
/*
echo('Line 912 - $findata_post: ');
echo('<br>');                    
print_r($findata_post); die();
  */       

/*---------------------------- submit = Submit: Passed Validation -----------------------------*/
          //  $result = true; // returns a integer 1 - FOR TESTING ONLY WHEN NO VALIDATIONS SET
          // if passes validation on line 292 

          if ($result == 1) {  // failure is on line 954
          
//echo('Line - 317: result of validation helper $result = 1 - passed!'); die();

            // Get the data posted from the form, both adding or updating
            $data = $ccmpdata_post; // $ccmpdata_post already got the new user level & the frmpg
 //    echo('Line 953 - Data posted from the create form: '); 
 //    print_r($data); die();
             // Extract the frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];
//print_r($frmpg); die();
            // need to determine if adding new or editing existing record
            // if there is a record id then must be editing, if not, we are adding
            $update_id = $data['recid'];
/*
 echo('Line 939 if exist then updating if not exist adding - $updateid = ');
 print_r($update_id); die();  // should be blank page when adding
*/


/*---------------------- submit = Submit: Passed Validation - Updating ----------------------*/

            if (is_numeric($update_id)){ // or if () - updating  or $update_id > 0 - Updating an existing record line 478 adding
//echo('Updating!');              
//print_r($update_id); die();

             
              // unset calculated values that are not in the DB or will get an error
              // frmpg & User Level

              unset($data['frmpg']); // not in the DB and will cause an error
              unset($data['tguserlevelname']);
              unset($data['recid']); // not in db and don't want to change the record id
              $data['updated_by'] = $_SESSION['tg_user_id'];
              $data['updated_at'] = TIME();

              // Grab the user level chosen on the create page before unsetting so the query will save since userlevel is not in this table

              // user_level will not come in from post when account edited by someone without the rights to this field
              if($data['userlevel'] > 0){
              $userlevel = $data['userlevel']; // used below to update the trongate_users table with the new user_level_id after the system accounts table
              }else{
                unset($data['userlevel']); // if no updated value then remove so wont have DB error
              }
              
//print_r($data['reset_interval']); die();
              // Do not try to save an interger than is a NULL. Either Unset or set = 0.
              if($data['reset_interval'] > 0 || $data['reset_interval'] = 0){
                // Do nothing
               // echo "do nothing"; die();
              }else{

                  unset($data['reset_interval']);         
              }


    /*      // log attempt
          $recidtext = var_export($recid, true);
          $arraytext = var_export($recdata, true);
          $prntext =   'Recid= '.$recidtext.' $recdata= '.$arraytext;

        //  $prntext =   var_export($recdata,true); 
          $this->module('eventlog');       
          $new_log_id = $this->eventlog->logevent('people-test contacts-del-$recdata[]', 'attempt','contacts_test.php line 154', 'update table','contacts_test',$prntext);
*/

                  // since updating dont want the password overwritten with blank
                  unset($data['password']);
                  unset($data['userlevel']); // not in CCMPS table
/*---------------------- submit = Submit: Passed Validation - Saving the User Account Updates ----------------------*/                  
/*
echo('Line 1020 - Updated user account dataset about to be saved for record: ');
print_r($update_id);
echo('<br>');
echo('frmpg: ');
echo($frmpg);
echo('<br>');
print_r($data); die();
*/

                  // no financial data so wont throw a DB error
                  $this->model->update($update_id, $data, 'ccmps');

//echo('Line 1006');
//echo('Update Saved!'); die();
//print_r($userlevel); die();                  
                 // If the user_level has been returned by the create form (for updates it always has a value)
                 if($userlevel > 0){
                  $this->model->update($update_id, $userlevel, 'trongate_users');
                 }


//echo('Line 1014');
//echo('Update Saved!'); die();

//print_r($findata_post); die();
              // create a dataset for the corresponding financial account
              // $findata_post contains what as filled in on the create form.

              // 11 gathered from the user on the create form - if blank leave blank
              $fin_id                        = $findata_post['fin_id'];
              $updfindata['billaddress1']    = $findata_post['billaddress1'];
              $updfindata['billaddress2']    = $findata_post['billaddress2'];
              $updfindata['billcity']        = $findata_post['billcity'];
              $updfindata['billstate']       = $findata_post['billstate'];
              $updfindata['billzip']         = $findata_post['billzip'];
              $updfindata['fin_inactive']    = $findata_post['fin_inactive']; // returns 1 or 0
              $updfindata['fin_billship']  = $findata_post['fin_billship'];
              $updfindata['fin_notes']       = $findata_post['fin_notes'];          
//print_r($findata_post['fin_billisship']); die();
//print_r($updfindata['fin_billisship']); die();
              // if these 9 fields are left blank on the create form, set values or use the info from the system form

              if($findata_post['fin_acct_type'] > 0){ // if it was filled in on the create form
                $updfindata['fin_acct_type']  = $findata_post['fin_acct_type']; // the use what was filled in
              }else{ 
                $updfindata['fin_acct_type']  = 1; // otherwise set it to 1-personal 2-corp 3-sponsor
              }
            
              if($findata_post['fin_status'] > 0){
                $updfindata['fin_status'] = $findata_post['fin_status'];
              }else{
                $updfindata['fin_status'] = 9; // 9-unused
              }

              if($findata_post['acct_bal'] > 0){
                $updfindata['acct_bal']   = $findata_post['acct_bal'];
              }else{
                $updfindata['acct_bal']   = 0;
              }

              // if a billing name was given use it, otherwise use the system account first & last name              
              if(strlen($findata_post['billname']) > 0){
                $updfindata['billname']   = $findata_post['billname'];
              }else{
                $updfindata['billname']   = $data['first_name'].' '.$data['last_name'].' '.$data['suffix'];
              }

              // if an email address was given use it, otherwise use the system account email
              if(strlen($findata_post['fin_email']) > 0){
                $updfindata['fin_email']  = $findata_post['fin_email']; 
              }else{
                $updfindata['fin_email']  = $data['email_address'];
              }

              // if a bill phone was given use it, otherwise use the system bill phone              
              if(strlen($findata_post['billphone']) > 0){
                $updfindata['billphone']    = $findata_post['billphone']; 
              }else{
                $updfindata['billphone']    = $data['phone'];
              }


//print_r($findata_post['shipname']); die();                
//print_r($updfindata['billname']); die();
//print_r($findata_post['fin_billisship']); die();
              // If Bill To equal to Ship To box is checked set ship to values to bill to values 
              if($findata_post['fin_billisship'] > 0){ // if bill info = ship info is checked

                $updfindata['shipname']      = $updfindata['billname'];
                $updfindata['shipphone']     = $updfindata['billphone']; 
                $updfindata['shipaddress1']  = $updfindata['billaddress1'];
                $updfindata['shipaddress2']  = $updfindata['billaddress2'];
                $updfindata['shipcity']      = $updfindata['billcity'];
                $updfindata['shipstate']     = $updfindata['billstate'];
                $updfindata['shipzip']       = $updfindata['billzip'];

              }else{  // bill data is not = ship data (not checked)

                $updfindata['shipname']      = $findata_post['shipname'];
                $updfindata['shipphone']     = $findata_post['shipphone']; 
                $updfindata['shipaddress1']  = $findata_post['shipaddress1'];
                $updfindata['shipaddress2']  = $findata_post['shipaddress2'];
                $updfindata['shipcity']      = $findata_post['shipcity'];
                $updfindata['shipstate']     = $findata_post['shipstate'];
                $updfindata['shipzip']       = $findata_post['shipzip'];
              }

              // Reset bill to = ship to so dont accidently overwrite an edited ship to
              // because user didn't notice the flag was still set
              $updfindata['fin_billship'] = 0;

//print_r($updfindata['fin_billisship']); die();

//echo('Line 1107 - $updfindata');
//echo('<br>');                    
//print_r($updfindata); die();

/*---------------------- submit = Submit: Passed Validation - Saving the Financial Account Updates ----------------------*/
//print_r($fin_id); die();
              // update financial account record            
              $this->model->update($fin_id, $updfindata, 'ccmps_financial');
// echo('Line 1115 - financial account data updated!'); die();  


              // Prepare flash message
              $flash_msg = 'The record was successfully updated';
              set_flashdata($flash_msg);

/*-------------------------------------------------------------------------------------------*/              
/*------------- submit = Submit: Passed Validation - Updating - from Manage Page ------------*/
/*-------------------------------------------------------------------------------------------*/

/*
echo('Line 1127 - Updated financial account dataset about to be saved for record: ');
print_r($update_id);
echo('<br>');
echo('frmpg: ');
echo($frmpg);
echo('<br>');
print_r($updfindata); die();
*/

              // Return to the page you launched the updating from
              if ($frmpg == 'm'){
/*                
echo('Line 408 - submit = Submit - Updating');
echo ('<br>');             
echo('frmpg = '); print_r($frmpg);
echo ('<br>'); 
echo('$update_id = '); print_r($update_id); die();
*/


      //  print_r($data); die();  
                // Same as $task == 'manage' line 53
                $data = $this->_manage_all_records();

                // add permissions for buttons and data partioning
                $data['action2_r'] = $action2_r;
                $data['action3_d'] = $action3_d;
                $data['action3_c'] = $action3_c;
                $data['action3_u'] = $action3_u;

/*-------------- submit = Submit: Passed Validation - Updating - from View Page -------------*/ 

              } else { // Must be coming from view record $frmpg = 'v' since currently only two options v or m
/*
echo('Line 422 - Task = submit - submit = Submit - Updating');
echo ('<br>');             
echo('frmpg = '); print_r($frmpg);
echo ('<br>'); 
echo('$update_id = '); print_r($update_id); die();
*/

                // echo('Coming from view page after saving update'); die();
                 //echo($update_id); die();


                // Get an array of the record data to be shown after changes saved to DB
                // $data only has database values not computed values

                // where cut out
                $data_sr = $this->_get_a_single_record($update_id);

/* 
echo('Line 416 - Task = submit - submit = Submit - Updating');
echo ('<br>'); 
echo('$data_sr = ');
echo ('<br>'); 
print_r($data_sr); die();
*/ 
                $recid = $update_id;  
                $data = $this->_add_view_page_header_data($data_sr, $task, $recid, $user_level, $frmpg); // line 1011

                

/* 
echo('Line 423 - Task = submit - submit = Submit - Updating');
echo ('<br>'); 
echo('Added view data: $data = ');
echo ('<br>'); 
print_r($data); die();
*/
              } // frmpg



           // goes to honcho.php line 258

/*-------------------------------------------------------------------------------------------*/
/*----------------------- submit = Submit: Passed Validation - Adding -----------------------*/
/*-------------------------------------------------------------------------------------------*/

            } else { //no $update_id therefore adding new account (from 319)

// Just ran _system_accounts_fetch_data_from_post
// Now we need to add any database fields that the system will determine and not input by the user:
// code, url_string, user_token, ip_address, activate_code, reset_code, date_created, created_by, created_at

       // Timestamps
             $data['created_by']   = $_SESSION['tg_user_id'];
             $data['created_at']   = TIME();
             $data['date_created'] = TIME();        
/*
echo('Line 472 - Adding!');
print_r($data); die();
*/
// will have to extract userlevel and create a new trongate_users record then bring back the id and insert into $data to be saved as the trongate_user_id

             // Get frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];
             //echo('Frmpg!:');
             //echo($frmpg); die();
//print_r($data); die();
             // Must remove fields that do not exist in the database from the array or you will get an error during insert
              unset($data['frmpg']);
              unset($data['recid']);
              unset($data['tguserlevelname']);
              $usrlvl['user_level_id'] = $data['userlevel']; // must capture before unset
              unset($data['userlevel']);

              // Do not try to save an interger than is a NULL. Either Unset or set = 0.
              if($data['reset_interval'] > 0 | $data['reset_interval'] = 0){
                // Do nothing
              }else{

                unset($data['reset_interval']);         
              }
//print_r($data); die();
              // Hash initial password before saving
              $pword            = $this->input('password');
              $data['password'] = $this->_hash_string($pword);
              $usernm           = $this->input('username');
              $usernm           = trim($usernm);

              // check to see if the username is already taken

              $user_obj = $this->model->get_one_where('username', $usernm, 'ccmps');

              $unexist = $user_obj->username;

              if(strlen($unexist) > 0){
                // Prepare flash message
                $flash_msg = 'Username already exists';
                set_flashdata($flash_msg);

                // Add the posted values ($sysdata_post) and go back to the create form
                $data = array_merge($data,$sysdata_post); 

              }else{

              // Set the force password change flag to TRUE since new account created by someone other than the user
//$data['force_pw_chg'] = 1;

              // create a new trongate_user record, get the id and save as trongate_user_id
         
              $this->model->insert($usrlvl, 'trongate_users');

              // get the new record's id and assign to $data array for the new record
              $data['trongate_user_id']  = $this->model->get_max('trongate_users');

              // Generate a random code for the Code field so can use in place of id if desired
              $data['code'] = $this->_generate_rand_code();
/*
echo('Line 538 - about to be saved ');
print_r($data); die();
*/
              //insert the new system account record            
              $this->model->insert($data, 'ccmps');
 //echo('Line 539 - New system account record added!'); die();   

              // get the new record's id
              $new_id = $this->model->get_max('ccmps');

              // create a dataset for the coreesponding financial account
              // $findata_post contains what as filled in on the create form.

              // 5 set by system for all new accts

              $newfindata['code']         = $this->_generate_rand_code();
              $newfindata['ccmp_id']  = $new_id;
              $newfindata['fin_date_created'] = TIME();
              $newfindata['created_at']   = TIME();
              $newfindata['created_by']   = $_SESSION['tg_user_id'];

              // 11 gathered from the user on the create form - if blank leave blank

              $newfindata['billaddress1']    = $findata_post['billaddress1'];
              $newfindata['billaddress2']    = $findata_post['billaddress2'];
              $newfindata['billcity']        = $findata_post['billcity'];
              $newfindata['billstate']       = $findata_post['billstate'];
              $newfindata['billzip']         = $findata_post['billzip'];
              $newfindata['fin_billisship']  = $findata_post['fin_billisship'];
              $newfindata['fin_inactive']    = $findata_post['fin_inactive']; // returns 1 or 0
              $newfindata['fin_notes']       = $findata_post['fin_notes'];          

              // if these 9 fields are left blank on the create form, set values or use the info from the system form

              if($findata_post['fin_acct_type'] > 0){ // if it was filled in on the create form
                $newfindata['fin_acct_type']  = $findata_post['fin_acct_type']; // the use what was filled in
              }else{ 
                $newfindata['fin_acct_type']  = 1; // otherwise set it to 1-personal 2-corp 3-sponsor
              }
            
              if($findata_post['fin_status'] > 0){
                $newfindata['fin_status'] = $findata_post['fin_status'];
              }else{
                $newfindata['fin_status'] = 9; // 9-unused
              }
              if($findata_post['acct_bal'] > 0){
                $newfindata['acct_bal']   = $findata_post['acct_bal'];
              }else{
                $newfindata['acct_bal']   = 0;
              }

              // if a billing name was given use it, otherwise use the system account first & last name              
              if(strlen($findata_post['billname']) > 0){
                $newfindata['billname']   = $findata_post['billname'];
              }else{
                $newfindata['billname']   = $data['first_name'].' '.$data['last_name'].' '.$data['suffix'];
              }

              // if an email address was given use it, otherwise use the system account email
              if(strlen($findata_post['fin_email']) > 0){
                $newfindata['fin_email']  = $findata_post['fin_email']; 
              }else{
                $newfindata['fin_email']  = $data['email_address'];
              }

              // if a bill phone was given use it, otherwise use the system bill phone              
              if(strlen($findata_post['billphone']) > 0){
                $newfindata['billphone']    = $findata_post['billphone']; 
              }else{
                $newfindata['billphone']    = $data['phone'];
              }

              // If Bill To equal to Ship To box is checked set ship to values to bill to values

              if($findata_post['fin_billisship'] > 0){ // if bill info = ship info is checked

                $newfindata['shipname']      = $newfindata['billname'];
                $newfindata['shipphone']     = $newfindata['billphone']; 
                $newfindata['shipaddress1']  = $newfindata['billaddress1'];
                $newfindata['shipaddress2']  = $newfindata['billaddress2'];
                $newfindata['shipcity']      = $newfindata['billcity'];
                $newfindata['shipstate']     = $newfindata['billstate'];
                $newfindata['shipzip']       = $newfindata['billzip'];

              }else{  // bill data is not = ship data (not checked)

                $newfindata['shipname']      = $findata_post['shipname'];
                $newfindata['shipphone']     = $findata_post['shipphone']; 
                $newfindata['shipaddress1']  = $findata_post['shipaddress1'];
                $newfindata['shipaddress2']  = $findata_post['shipaddress2'];
                $newfindata['shipcity']      = $findata_post['shipcity'];
                $newfindata['shipstate']     = $findata_post['shipstate'];
                $newfindata['shipzip']       = $findata_post['shipzip'];
              }  
         
//print_r($newfindata); die();
              //insert the new financial account record            
              $this->model->insert($newfindata, 'ccmps_financial');
 //echo('Line 770 - New financial account data added!'); die();  
              // Prepare flash message
              $flash_msg = 'The record was successfully created';
              set_flashdata($flash_msg);
//print_r($frmpg); die();
              // Return to the page you launched the adding from

/*-------------- submit = Submit: Passed Validation - Adding - from page Manage -------------*/

              if ($frmpg = 'm'){ //coming from manage when adding and returning to manage


                 $data = $this->_manage_all_records();

                // display the code names for topic & level instead of their ids
                //  $dr = $data['rows'];
                //  $data['rows'] = $this->_display_code_names($dr);

/*--------------- submit = Submit: Passed Validation - Adding - from page View --------------*/

              } else { // Must be coming from view record $frmpg = 'v' since currently only two options
                       // Currently no ADD (Create Account)  button on the view page, only UPDATE (Update Account)
              }



              } // username exists, updating or adding
            } // end isnumeric - Updating or adding from line 343.  Goes to honcho.php line 258
/*
 echo('Line 543 - end if update or new');
 echo('<br>');
 json($data); die();
*/

/*---------------------------- submit = Submit: Failed Validation ---------------------------*/

          } else { // failed validation line 508

              // If a flash msg was set above for duplicate username
              // it will display just before any failed validation messages

              // Add the posted values ($sysdata_post) to the dashboard menus
              $data = array_merge($data,$sysdata_post);
/*
 echo('Line 986 - failed validation line 508');
 echo('<br>');
 echo('combine sys & fin array data for the retry');
 echo('<br>');
 print_r($data); die();
*/


/*-------------- submit = Submit: Failed Validation - Updating - from page View -------------*/

              if (is_numeric($update_id)){ // failed updating
/*
echo 'failed validation updating-';
echo('Update id: ');
echo($update_id); 
echo('Record id: ');
echo($recid);
echo('Record Data: ');
print_r($data); die();
*/
          // $recdata = $data;
           $data  = $this->_add_view_page_update_header($data, $task, $recid, $user_level, $frmpg); // same as 212
/*
echo('Record Data: ');
print_r($data); die();
*/

/*--------------- submit = Submit: Failed Validation - Adding - from page View --------------*/

              }else{ // failed adding

echo('Line 1082');
echo('<br>');
echo('Failed Validation Adding');
echo('<br>');
echo('Frmpg: '); print_r($frmpg);
echo('<br>');
echo('Record Data: ');
echo('<br>');
print_r($data); die();

                $data = $this->_add_view_page_create_header($data, $task, $recid, $user_level, $frmpg); // same as 225
/*                
echo('Line 621');
echo('<br>');
echo('Failed Validation Adding');
echo('<br>');
echo('Frmpg: '); print_r($frmpg);
echo('<br>');
echo('Record Data: ');
echo('<br>');
print_r($data); die();
*/

              } // failed validation while updating or adding

          } // end result (validation) Line 316

        } // end if $submit = Submit within $task = 'submit' line 282. no else statement.
        

      } // End task submit - Last task case

// All task cases end here
/*
 echo('Line 654 - All task cases ended - return $data  to Honcho controller index() line 170');
 echo('<br>');
 print_r($data); die();
*/
return $data; // back to parent honcho module index() line 170
        
      }// End task()

/*---------------------------------------------------------------------------------------------*/

/*------------------------------- Supporting Functions (SF) -----------------------------------*/

/*---------------------------------------------------------------------------------------------*/


/*----------------------------- SF - Random Code Generator --------------------------------*/

      // generate a random 16 character code for unique ids
      function _generate_rand_code() {
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

/*----------------------------- SF - Random Password Generator --------------------------------*/

      // generate a random 6 character password for password resets
      function _generate_rand_pw() {
        $token_length = 6;
        $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $random_pw = '';
        for ($i = 0; $i < $token_length; $i++) {
            $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        $random_pw = $random_string;
       // echo('Line 1117 Random PW ');
        //print_r($random_pw); die();

        return $random_pw;
      }

/*------------------------------ SF - String Hashing Function ---------------------------------*/

function _hash_string($str){

    //       echo('in hasher'); die();
   
           $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
               'cost' => 11 ));
   
           return $hashed_string;
       }
   
       function _verify_hash($plain_text_str, $hashed_string){
   
           $result =  password_verify($plain_text_str, $hashed_string);
   
           return $result; // true or false
       }

/*-------------------------- SF - Fetch Data Posted from the Forms ----------------------------*/

    function _ccmps_fetch_data_from_post() {
//    $data['']      = $this->input('', true);
// the name="..." in the form control parameters is what is passed as an input through the post

    // CCMPS Table

    $data['recid']           = $this->input('id', true);
    $data['first_name']      = $this->input('first_name', true);
    $data['middle_name']     = $this->input('middle_name', true);
    $data['last_name']       = $this->input('last_name', true);
    $data['suffix']          = $this->input('suffix', true);
    $data['username']        = $this->input('username', true);
    $data['tguserlevelname'] = $this->input('tguserlevelname', true); // ?? not populated
    $data['title']           = $this->input('title', true);
    $data['department']      = $this->input('department', true);
    $data['phone']           = $this->input('phone', true);
    $data['email_address']   = $this->input('email_address', true);
    $data['picture']         = $this->input('picture', true); // not used on create page
    $data['homepage']        = $this->input('homepage', true); // not used on create page
    $data['notes']           = $this->input('notes', true);
    $data['password']        = $this->input('password', true);
    $data['gender']          = $this->input('gender', true);
    $data['cred_notes']      = $this->input('cred_notes', true);

    // add chapter & chapter role
    $data['chapter']          = $this->input('chapter', true);
    $data['chapter_role']     = $this->input('chapter_role', true);
    $data['chapter_admin']    = $this->input('chapter_admin', true);


//print_r( $data['chapter_role'] ); die();

    // CCMP Table Integers

    if ($data['chapter_admin'] == "Yes"){
     $data['chapter_admin'] = 1;
   }else{
     $data['chapter_admin'] = 0;
   }

    $locked          = $this->input('locked', true);
//print_r($locked); die(); if checkbox, $locked = "on" when checked, NULL when not checked
    // if dropdown "Yes" or "No", the values in the dropdown
    If($locked == 'Yes'){
      $data['locked'] = 1;
    }else{
      $data['locked'] = 0;  
    }

    $inactive        = $this->input('inactive', true);

    If($inactive == 'Yes'){
      $data['inactive'] = 1;
    }else{
      $data['inactive'] = 0;  
    }
    
    $confirmed       = $this->input('confirmed', true);  //self registration - email has been confirmed

    If($confirmed == 'Yes'){
      $data['confirmed'] = 1;
    }else{
      $data['confirmed'] = 0; 
    }
    
    $force_pw_chg    = $this->input('force_pw_chg', true);

    If($force_pw_chg == 'Yes'){
      $data['force_pw_chg'] = 1;
    }else{
      $data['force_pw_chg'] = 0;  
    }
    
    $timed_reset     = $this->input('timed_reset', true);

    If($timed_reset == 'Yes'){
      $data['timed_reset'] = 1;
    }else{
      $data['timed_reset'] = 0; 
    }
    
    $verified     = $this->input('verified', true); //self registration - verified identity - fishing for past participants

    If($verified == 'Yes'){
      $data['verified'] = 1;
    }else{
      $data['verified'] = 0;  
    }

    $approved     = $this->input('approved', true);  // if email confirmed and identity verified (usually as participant)

    If($approved == 'Yes'){
      $data['approved'] = 1;
    }else{
      $data['approved'] = 0;  
    }
    //$ul  = $this->input('userlevel', true);
    
    $data['userlevel']    = $this->input('userlevel', true);

    $data['reset_interval']    = $this->input('reset_interval', true);

      return $data;  // goes to line 855
    }

    function _financial_accounts_fetch_data_from_post() {
//    $data['']      = $this->input('', true);
// the name="..." in the form control parameters is what is passed as an input through the post

    // Financial Table

    $findata['fin_id']             = $this->input('fin_id', true);                                       
    $findata['fin_code']           = $this->input('fin_code', true);                                     
    $findata['ccmp_id']            = $this->input('ccmp_id', true);
    $findata['fin_acct_type']      = $this->input('fin_acct_type', true);                                    
    $findata['acct_bal']           = $this->input('acct_bal', true);                                                                           
    $findata['fin_email']          = $this->input('fin_email', true);                                      
    $findata['billname']           = $this->input('billname', true);                                     
    $findata['billphone']          = $this->input('billphone', true);                      
    $findata['billaddress1']       = $this->input('billaddress1', true);                                   
    $findata['billaddress2']       = $this->input('billaddress2', true);                                   
    $findata['billcity']           = $this->input('billcity', true);                                     
    $findata['billstate']          = $this->input('billstate', true);                                      
    $findata['billzip']            = $this->input('billzip', true);                                      
    $findata['shipname']           = $this->input('shipname', true);                                     
    $findata['shipphone']          = $this->input('shipphone', true);                      
    $findata['shipaddress1']       = $this->input('shipaddress1', true);                                   
    $findata['shipaddress2']       = $this->input('shipaddress2', true);                                   
    $findata['shipcity']           = $this->input('shipcity', true);                                     
    $findata['shipstate']          = $this->input('shipstate', true);                                      
    $findata['shipzip']            = $this->input('shipzip', true);
    $findata['fin_notes']          = $this->input('fin_notes', true);                                
/*    $findata['fin_date_created']   = $this->input('fin_date_created', true);                                 
    $findata['fin_created_by']     = $this->input('fin_created_by', true);
    $findata['fin_updated_by']     = $this->input('fin_updated_by', true);
    $findata['fin_created_at']     = $this->input('fin_created_at', true);
    $findata['fin_updated_at']     = $this->input('fin_updated_at', true); */

    // Convert back to INTEGER to save to database
    //$xyz     = $this->input('xyz', true);
    //If($xyz == 'Yes'){
    //  $data['xyz'] = 1;
    //}else{
    //  $data['xyz'] = 0; 
    //}

    // Financial Table Integers


    //$data['fin_acct_type']          = ;

    $fin_billisship     = $this->input('fin_billisship', true);
    If($fin_billisship == 'Yes'){
      $findata['fin_billisship'] = 1;
    }else{
      $findata['fin_billisship'] = 0;  
    }

    $fin_inactive     = $this->input('fin_inactive', true);
    If($fin_inactive == 'Yes'){
      $findata['fin_inactive'] = 1;
    }else{
      $findata['fin_inactive'] = 0;  
    }

    $fin_status     = $this->input('fin_status', true);
    If($fin_status == 'Yes'){
      $findata['fin_status'] = 1;
    }else{
      $findata['fin_status'] = 0;  
    }

/*
echo('Line 1035 - Fetch Financial Data From Post:  '); 
echo('<br>');
json($findata); die();
*/
      return $findata;  // goes to 310 & 
    }


/*-------------------------- SF - List All Records on Manage Page ---------------------------*/ 

  function _manage_all_records() { //called by lines 53,85,94,390,604
// $task = NULL cause not passed as paramenter
        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (adding vs updating)

 //print_r($task); die();
        // __DIR__ = /Applications/MAMP/htdocs/honchotg/modules/honcho/system_accounts/controllers/
        $data['content_name']   = "System Administrator"; 
        $data['contentfile']    = __DIR__."/../views/inspinia/manage"; //relative to honcho/views/inspinia (layoutone.php)
        $data['contentheader']  = "Manage Member Records";
      //  $data['contentmenu']    = '';  // in case you want to provide a navigation menu instead of just buttons on the page
        $data['breadcrumb1']    = "People";               
        $data['breadcrumb2']    = "Members"; // displayed in the content file
        $data['breadcrumb3']    = "Manage Member Records";

// print_r($data); die();
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        $data['rows']      = $this->model->get('last_name','ccmps'); // works manage
//print_r($data['rows'][0]); die();
        foreach($data['rows'] as $row) { // step through the array of records and pull out needed values
         
            $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from system_accounts
            $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

            /*------------------ Change values to display descriptions instead of codes -----------------*/ 

            // Change codes to names

            $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
            $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
            $levelname = $levelobj->level_title;  // capture the level name
            // now we need to insert the levelnames in the array for display
            $row->levelname = $levelname;

            $memtypeid        = $row->member_type;
            $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
            $row->member_type = $memtypeobj->ccmp_type;

            $chapterid    = $row->chapter;
            $chapterobj   = $this->model->get_where($chapterid,'chapters_bpa');
            $row->chapter = $chapterobj->chapter_title;

            $fintypeid          = $row->fin_acct_type;
            $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
            $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
            $finstatusid     = $row->fin_status;
            $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
            $row->fin_status = $finstatusobj->fin_status_title;

            $this->module('timedate');
            $format = 'datepicker_us';
            $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

            if($row->updated_at == '01/01/1970'){
              $row->updated_at = ' ';
            }
        
        }
//print_r($data); die();
        return $data;
  }

/*------------------------ SF - Get a Single Record for the View Page -------------------------*/ 

  function _get_a_single_record($recid) {  //called from line 129 when viewing & line 452 when updating

//print_r($recid); die();
        // Get an object of the record data to be shown
              // query for single record - ('order_by', 'table', limit, offset)

        $ccmpdata = $this->model->get_where($recid,'ccmps');
//print_r($ccmpdata); die();
/*--------------- View - Convert to TG UL ID to Name -------------------*/

        // pull out the trongate user id to search the trongate_users table for user_level_id

        $tguserid = $ccmpdata->trongate_user_id; // record id for the user in trongate_user
        $tguserlevelname = $this->_convert_level_id_to_name($tguserid);
//print_r($tguserlevelname); die();

          $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');      
          $ccmpdata->tguserlevel = $tguserobj->user_level_id; // for update dropdown
//print_r($ccmpdata->tguserlevel ); die();

/*----------------- View - Get User Token Expiration -------------------*/

        // pull out the trongate user id to search the trongate_users table for token expiration date
        $tguserid2 = $ccmpdata->trongate_user_id; // record id for the user in trongate_user
        $tokenexpires = $this->_get_user_token_expiration($tguserid2); 

/*--------- View - Convert Updated By & Created By to a Name -----------*/

        $updated_by = $ccmpdata->updated_by;
        $created_by = $ccmpdata->created_by;
//print_r($updated_by); die(); 
        // raw are the codes
        $updated_by_raw = $ccmpdata->updated_by;
        $created_by_raw = $ccmpdata->created_by;
//print_r($updated_by); die();

        // updater could be a ccmp (the ccmp himself) or a system account user - updated_by is their trongate user id
        $tguserobj2       = $this->model->get_one_where('trongate_user_id', $updated_by, 'ccmps');
// if null then updater must be a system account
        if(strlen($tguserobj2)){
          // continue
        //  echo "set"; die();
        }else{
          $tguserobj2       = $this->model->get_one_where('trongate_user_id', $updated_by, 'system_accounts');
        }
//print_r($tguserobj2); die();

        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;



        $tguserobj3       = $this->model->get_one_where('trongate_user_id', $created_by, 'ccmps');
        if(strlen($tguserobj3)){
          // continue
        //  echo "set"; die();
        }else{
          $tguserobj3       = $this->model->get_one_where('trongate_user_id', $created_by, 'system_accounts');
        }

        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;
//print_r($created_by_last); die();

        // if not a real record pass thru updated_by & created_by as the NULL that it is so wont show up in data-present only tabular reports
        // otherwise you are passing spaces and it will come thru as not null and not empty and isset = true
        if(strlen($updated_by_first) >0){
            $updatedby        = $updated_by_first.' '.$updated_by_last;
        }
        if(strlen($created_by_first) >0){
          $createdby        = $created_by_first.' '.$created_by_last;
        }
//echo "line 1443";
//print_r($createdby); die();

/*-------- View - Convert Codes & Convert Dates to Nice Dates ----------*/

        // Get dates
        $last_login   = $ccmpdata->last_login;
        $last_logout  = $ccmpdata->last_logout;
        $date_created = $ccmpdata->date_created;
        $updated_at   = $ccmpdata->updated_at;
        $created_at   = $ccmpdata->created_at;
//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report
        $last_login_raw   = $ccmpdata->last_login;
        $last_logout_raw  = $ccmpdata->last_logout;
        $date_created_raw = $ccmpdata->date_created;
        $updated_at_raw   = $ccmpdata->updated_at;
        $created_at_raw   = $ccmpdata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        $format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
        $this->module('timedate');
        $lastlogin     = $this->timedate->get_nice_date($last_login, $format);
        $lastlogout    = $this->timedate->get_nice_date($last_logout, $format);
        $datecreated   = $this->timedate->get_nice_date($date_created, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $this->timedate->get_nice_date($created_at, $format);
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);

        if(strlen($tokenexpires) > 0){
                 $ccmpdata->token_expires   = $tokenexpires; // translation on line 192
        }else{

                 $ccmpdata->token_expires   = 'Not Logged In'; // translation on line 192
        }

/*------ View - Add Converted Codes &  Nice Dates to the Array ----------*/

       // convert the object to an array to add additional data for the view 
       $ccmpdata = (array)$ccmpdata;

       // Translated Codes 
       $ccmpdata['tguserlevelname'] = $tguserlevelname;
       $ccmpdata['updated_by']      = $updatedby;

       $ccmpdata['created_by']      = $createdby;
//print_r($createdby); die();
       // Translated Dates
       $ccmpdata['last_login']      = $lastlogin;
       $ccmpdata['last_logout']     = $lastlogout;
       $ccmpdata['date_created']    = $datecreated;
       $ccmpdata['updated_at']      = $updatedat;
       $ccmpdata['created_at']      = $createdat;

        if($ccmpdata['updated_at'] == '01/01/1970'){

          $ccmpdata['updated_at'] = ' ';
        }else{
          // Do nothing
        }

        if($ccmpdata['created_at'] == '01/01/1970'){

          $ccmpdata['created_at'] = ' ';
        }else{
          // Do nothing
        }

     // Non-Translated 
       $ccmpdata['last_login_raw']     = $last_login_raw;
       $ccmpdata['last_logout_raw']    = $last_logout_raw;
       $ccmpdata['date_created_raw']   = $date_created_raw;
       $ccmpdata['updated_at_raw']     = $updated_at_raw;
       $ccmpdata['created_at_raw']     = $created_at_raw;
       $ccmpdata['tokenexpires_raw']   = $tokenexpires_raw;
       $ccmpdata['updated_by_raw']     = $updated_by_raw;
       $ccmpdata['created_by_raw']     = $created_by_raw;

        if($ccmpdata['last_login'] == '01/01/1970'){

          $ccmpdata['last_login'] = ' ';
        }else{
          // Do nothing
        }

        if($ccmpdata['last_logout'] == '01/01/1970'){

          $ccmpdata['last_logout'] = ' ';
        }else{
          // Do nothing
        }

      // Change codes to names - at this point $ccmpdata has been converted to an array

      $memtypeid                = $ccmpdata['member_type'];     
      $memtypeobj               = $this->model->get_where($memtypeid,'ccmps_types');
      $ccmpdata['member_type']  = $memtypeobj->description; // for view file
      $ccmpdata['membertypeid'] = $memtypeid; // for update dropdown
//print_r($memtypeid); die();
      $genderid                = $ccmpdata['gender'];     
      $gendertypeobj           = $this->model->get_where($genderid,'genders');
      $ccmpdata['gender']      = $gendertypeobj->description; // for view file
      $ccmpdata['genderid']    = $genderid; // for update dropdown
//print_r($genderid); die();

      $chapterid             = $ccmpdata['chapter'];
      $chapterobj            = $this->model->get_where($chapterid,'chapters_bpa');
      $ccmpdata['chapter']   = $chapterobj->chapter_title;
      $ccmpdata['chapterid'] =  $chapterid ; // for update dropdown

      $chapterroleid         = $ccmpdata['chapter_role'];
      $chapterroleobj        = $this->model->get_where($chapterroleid,'ccmps_chapter_offices');
      $ccmpdata['chapter_role']  = $chapterroleobj->description;
      $ccmpdata['chapterroleid'] = $chapterroleid; // for update dropdown

      $highcertid                      = $ccmpdata['highest_certificate'];
      $highcertobj                     = $this->model->get_where($highcertid,'ccmps_certificate_types');
      $ccmpdata['highest_certificate'] = $highcertobj->description;
      $ccmpdata['highestcertid']        = $highcertid; // for update dropdown
//print_r($ccmpdata['highestcertid']); die();
      $regionid       = $data['region'];
      $regionobj      = $this->model->get_where($regionid,'ccmps_region_codes');
      $data['region'] = $regionobj->description;
     // region won't be picked from a dropdown it is assigned by chapter choice

      // Get the address data
       $addrdata = $this->model->get_one_where('ccmp_id',$recid,'ccmps_addresses');
//print_r($addrdata); die();

      // convert the object to an array for later combining with $data
      $addrdata = (array) $addrdata;

     $mailstate = $addrdata['mailstate'];
     $stateobj = $this->model->get_one_where('state_code',$mailstate,'states');
     $mailstateid = $stateobj->id;
     $addrdata['mailstateid'] = $mailstateid; // for update dropdown

     $physstate = $addrdata['physstate'];
     $stateobj = $this->model->get_one_where('state_code',$physstate,'states');
     $physstateid = $stateobj->id;
     $addrdata['physstateid'] = $physstateid; // for update dropdown
 //    print_r($physstateid); die();

   
     

   //   $this->module('timedate');
   //   $format = 'datepicker_us';
   //   $ccmpdata['updated_at']  = $this->timedate->get_nice_date($ccmpdata['updated_at'], $format);


      // Values must be unique when combine (because they appear on same page view.php)
      // so change the name of fields with same name on each table and get rid of the original

      $addrdata['adr_id'] = $addrdata['id'];
      unset($addrdata['id']);

      $addrdata['adr_code'] = $addrdata['code'];
      unset($addrdata['code']);

      //get these fields and save as raw valiues for the export tab in view.php
      // then drop the duplicative names that appear in the system accts section of the view.php

  /*    $addrdata['adr_created_by_raw'] = $addrdata['created_by'];
      unset($addrdata['created_by']);

      $addrdata['adr_updated_by_raw'] = $addrdata['updated_by'];
      unset($adrdata['updated_by']);

      $addrdata['adr_created_at_raw'] = $addrdata['created_at'];
      unset($adrdata['created_at']);

      $addrdata['adr_updated_at_raw'] = $addrdata['updated_at'];
      unset($adrdata['updated_at']); */

      $data = array_merge($ccmpdata,$addrdata);

//print_r($data); die();
      // Get the financial data
       $findata = $this->model->get_one_where('ccmp_id',$recid,'ccmps_financial');
//print_r($findata); die();

      // convert the object to an array for later combining with $data
      $findata = (array) $findata;

      $billstate = $findata['billstate'];
      $stateobj = $this->model->get_one_where('state_code',$billstate,'states');
      $billstateid = $stateobj->id;
      $findata['billstateid'] = $billstateid; // for update dropdown
//     echo('Billstateid ');
//     print_r($billstateid); die();

      $shipstate = $findata['shipstate'];
      $stateobj = $this->model->get_one_where('state_code',$shipstate,'states');
      $shipstateid = $stateobj->id;
      $findata['shipstateid'] = $shipstateid; // for update dropdown
 //     echo('shipstateid ');
 //     print_r($shipstateid); die();


      // translate codes
      // get values to be translated
/*      $fincb = $findata['created_by'];
      $finub = $findata['updated_by'];
      $finca = $findata['created_at'];
      $finua = $findata['updated_at'];
      $findc = $findata['fin_date_created'];
//print_r($finca); die();
      // Convert the dates
      // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
      $format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
      $this->module('timedate');
      $finca     = $this->timedate->get_nice_date($finca, $format);
      $finua     = $this->timedate->get_nice_date($finua, $format);
      $findc     = $this->timedate->get_nice_date($findc, $format);


      $findata['fin_created_at'] = $finca;
      $findata['fin_updated_at'] = $finua;
      $findata['fin_date_created'] = $findc; */
//print_r($findata['fin_date_created']); die();     

        if(strlen($updated_by_first) >0){
          $finub = $updated_by_first.' '.$updated_by_last;
        }
        if(strlen($created_by_first) >0){
          $fincb = $created_by_first.' '.$created_by_last;
        }
//print_r($created_by_first); die();

      // created by & updated by are same as ccmpdata unless you allow the ccmps_financial table
      // to be edited by some other means
      $findata['fin_created_by'] = $fincb;
      $findata['fin_updated_by'] = $finub;
//print_r($findata['fin_updated_by']); die();

      // Values must be unique when combine (because they appear on same page view.php)
      // so change the name of fields wirth same name on each table and get rid of the original

      $findata['fin_id'] = $findata['id'];
      unset($findata['id']);

      $findata['fin_code'] = $findata['code'];
      unset($findata['code']);

      //get these fields and save as raw valiues for the export tab in view.php
      // then drop the duplicative names that appear in the system accts section of the view.php

      $fintypeid                = $findata['fin_acct_type'];
      $fintypeobj               = $this->model->get_where($fintypeid ,'ccmps_financial_types');
      $findata['fin_acct_type'] = $fintypeobj->fin_type_title;
      $findata['finaccttypeid'] = $fintypeid; // for update dropdown
//print_r($fintypeid); die();

      $finstatusid            = $findata['fin_status'];
      $finstatusobj           = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
      $findata['fin_status']  = $finstatusobj->fin_status_title;
      $findata['finstatusid'] = $finstatusid; // for dropdown

            if($row->updated_at == '01/01/1970'){
              $row->updated_at = ' ';
            }

      $data = array_merge($data,$findata);
//print_r($data); die();

/*------ Convert the Codes to descriptions ----------*/


     $data['lastlogindevice'] = $data['last_login_device'];  // for dropdown
      if($data['last_login_device'] == 1){
        $data['last_login_device'] = 'Phone';
      }else{
        $data['last_login_device'] = 'Comp/Tablet';
      }
      

//print_r($chapterroleid); die();

/*------ Convert the Binary Yes/No fields ----------*/

     if($data['chapter_admin'] == 1) { 
          $data['chapter_admin'] = 'Yes';
     }else{ 
          $data['chapter_admin'] = 'No';
     }

      if($data['eligible_voter'] == 1) { 
           $data['eligible_voter'] = 'Yes';
      }else{ 
           $data['eligible_voter'] = 'No';
      }

      if($data['emailoptout'] == 1) { 
           $data['emailoptout'] = 'Yes';
      }else{ 
           $data['emailoptout'] = 'No';
      }

      if($data['donotcall'] == 1) { 
           $data['donotcall'] = 'Yes';
      }else{ 
           $data['donotcall'] = 'No';
      }

      if($data['mail_notices'] == 1) { 
           $data['mail_notices'] = 'Yes';
      }else{ 
           $data['mail_notices'] = 'No';
      }

      if($data['deceased'] == 1) { 
           $data['deceased'] = 'Yes';
      }else{ 
           $data['deceased'] = 'No';
      }

      if($data['no_address'] == 1) { 
           $data['no_address'] = 'Yes';
      }else{ 
           $data['no_address'] = 'No';
      }

      if($data['special_event'] == 1) { 
           $data['special_event'] = 'Yes';
      }else{ 
           $data['special_event'] = 'No';
      }

      if($data['mail_notices'] == 1) { 
           $data['mail_notices'] = 'Yes';
      }else{ 
           $data['mail_notices'] = 'No';
      }

      if($data['aircraft_owner'] == 1) { 
           $data['aircraft_owner'] = 'Yes';
      }else{ 
           $data['aircraft_owner'] = 'No';
      }


      if($data['hall_of_fame'] == 1) { 
           $data['hall_of_fame'] = 'Yes';
      }else{ 
           $data['hall_of_fame'] = 'No';
      }

      if($data['active_duty'] == 1) { 
           $data['active_duty'] = 'Yes';
      }else{ 
           $data['active_duty'] = 'No';
      }

      if($data['former_military'] == 1) { 
           $data['former_military'] = 'Yes';
      }else{ 
           $data['former_military'] = 'No';
      }

      if($data['military_pilot'] == 1) { 
           $data['military_pilot'] = 'Yes';
      }else{ 
           $data['military_pilot'] = 'No';
      }

      if($data['vip'] == 1) { 
           $data['vip'] = 'Yes';
      }else{ 
           $data['vip'] = 'No';
      }

      if($data['student'] == 1) { 
           $data['student'] = 'Yes';
      }else{ 
           $data['student'] = 'No';
      }

      if($data['private'] == 1) { 
           $data['private'] = 'Yes';
      }else{ 
           $data['private'] = 'No';
      }


      if($data['commercial'] == 1) { 
           $data['commercial'] = 'Yes';
      }else{ 
           $data['commercial'] = 'No';
      }

      if($data['atp'] == 1) { 
           $data['atp'] = 'Yes';
      }else{ 
           $data['atp'] = 'No';
      } 

      if($data['drone'] == 1) { 
           $data['drone'] = 'Yes';
      }else{ 
           $data['drone'] = 'No';
      }

      if($data['ap'] == 1) { 
           $data['ap'] = 'Yes';
      }else{ 
           $data['ap'] = 'No';
      }

      if($data['ia'] == 1) { 
           $data['ia'] = 'Yes';
      }else{ 
           $data['ia'] = 'No';
      }

      if($data['military_maint'] == 1) { 
           $data['military_maint'] = 'Yes';
      }else{ 
           $data['military_maint'] = 'No';
      }

      if($data['maintenance'] == 1) { 
           $data['maintenance'] = 'Yes';
      }else{ 
           $data['maintenance'] = 'No';
      }

      if($data['atc'] == 1) { 
           $data['atc'] = 'Yes';
      }else{ 
           $data['atc'] = 'No';
      }

      if($data['dispatcher'] == 1) { 
           $data['dispatcher'] = 'Yes';
      }else{ 
           $data['dispatcher'] = 'No';
      }


      if($data['se_land'] == 1) { 
           $data['se_land'] = 'Yes';
      }else{ 
           $data['se_land'] = 'No';
      }

      if($data['me_land'] == 1) { 
           $data['me_land'] = 'Yes';
      }else{ 
           $data['me_land'] = 'No';
      }

      if($data['se_sea'] == 1) { 
           $data['se_sea'] = 'Yes';
      }else{ 
           $data['se_sea'] = 'No';
      }

      if($data['me_sea'] == 1) { 
           $data['me_sea'] = 'Yes';
      }else{ 
           $data['me_sea'] = 'No';
      } 

      if($data['instrument'] == 1) { 
           $data['instrument'] = 'Yes';
      }else{ 
           $data['instrument'] = 'No';
      }

      if($data['cfi'] == 1) { 
           $data['cfi'] = 'Yes';
      }else{ 
           $data['cfi'] = 'No';
      }

      if($data['cfii'] == 1) { 
           $data['cfii'] = 'Yes';
      }else{ 
           $data['cfii'] = 'No';
      }

      if($data['mei'] == 1) { 
           $data['mei'] = 'Yes';
      }else{ 
           $data['mei'] = 'No';
      } 

      if($data['dpe'] == 1) { 
           $data['dpe'] = 'Yes';
      }else{ 
           $data['dpe'] = 'No';
      }

      if($data['bgi'] == 1) { 
           $data['bgi'] = 'Yes';
      }else{ 
           $data['bgi'] = 'No';
      }

      if($data['agi'] == 1) { 
           $data['agi'] = 'Yes';
      }else{ 
           $data['agi'] = 'No';
      }

      if($data['rotocraft'] == 1) { 
           $data['rotocraft'] = 'Yes';
      }else{ 
           $data['rotocraft'] = 'No';
      }

      if($data['glider'] == 1) { 
           $data['glider'] = 'Yes';
      }else{ 
           $data['glider'] = 'No';
      }

      if($data['balloon'] == 1) { 
           $data['balloon'] = 'Yes';
      }else{ 
           $data['balloon'] = 'No';
      }

      if($data['airship'] == 1) { 
           $data['airship'] = 'Yes';
      }else{ 
           $data['airship'] = 'No';
      }



// print_r($data); die();
        return $data; // returns to 555 when editing and other placed when viewing
  }

/*-------------------------------- Add View Page Header Data ----------------------------------*/

    function _add_view_page_header_data($data, $task = NULL, $recid=NULL, $userlevel=NULL, $frmpg=NULL){  // from 173, 506

        // Add these elements to properly draw the screen

        $viewdata['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $viewdata['content_name']   = "People"; 
        $viewdata['contentfile']    = __DIR__."/../views/inspinia/view"; //dashboard file is a shell that calls those above
        $viewdata['contentheader']  = "View Member record"; //not used                    
        $viewdata['breadcrumb1']    = "Member Records"; // displayed in the content file
        $viewdata['breadcrumb2']    = "View Member Record"; // displayed in the content file
        $viewdata['breadcrumb3']    = ""; // displayed in the content file      
        $viewdata['recid']          = $recid; // record id to view
        $viewdata['frmpg']          = $frmpg;
       
      //  $viewdata['picture']
//echo('Line 1023 - recid '); print_r($viewdata['recid'] );  
//echo(' Line 1023 - frmpg '); print_r($viewdata['frmpg'] ); die();

        // convert obj to array to add elements [otherwise lines like 543 will produce 500 error]
      
        $data = array_merge($viewdata, $data);

    // get the permissions for each function in this submodule for the current user's user_level
      for ($i = 1; $i <= 20; $i++) 
      {
      $sql = "SELECT * FROM ccmps_access WHERE ccmps_access.action_id = $i AND ccmps_access.level_id = $userlevel";
      $access_array = $this->model->query($sql,'array');

       // print_r($access_array); die(); // only see the first one cuase havent iterated thru table yet

      ${"action".$i. "_c"} =  $access_array[0]['create'];
      ${"action".$i. "_r"} =  $access_array[0]['read'];
      ${"action".$i. "_u"} =  $access_array[0]['update'];
      ${"action".$i. "_d"} =  $access_array[0]['delete'];
      //print_r($func1_r); die();

    }

        // add permissions for buttons and data partioning
        $data['action2_r'] = $action2_r;
        $data['action3_d'] = $action3_d;
        $data['action3_c'] = $action3_c;
        $data['action3_u'] = $action3_u;
        $data['action3_r'] = $action3_r;

    return $data;
  }

/*------------------------------- Add View Page Create Header ---------------------------------*/

    function _add_view_page_create_header($data, $task = NULL, $recid = NULL, $userlevel, $frmpg){  // from 225 & 591

      // Add these elements to properly draw the screen

// Add code for all dropdowns

      // View data - there is no existing record to add to
      $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
      $data['content_name']   = "System Administrator"; 
      $data['contentfile']    = __DIR__."/../views/inspinia/create"; //dashboard file is a shell that calls those above
      $data['contentheader']  = "Create System Account";
      $data['breadcrumb1']    = "Accounts"; // displayed in the content file                      
      $data['breadcrumb2']    = "System Accounts"; // displayed in the content file
      $data['breadcrumb3']    = "Create System Account"; // displayed in the content file    
      $data['frmpg']          = $frmpg; 

//echo('Line 2516'); die();
// Compare to list of dropdowns line 558 for updating

      // User Levels dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['usrlvls'] = $this->model->get('id','trongate_user_levels'); // gets passed to the create form to populate dropdown

      // Account Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['accttypes'] = $this->model->get('id','financial_account_types'); // gets passed to the create form to populate dropdown

      // Account Status dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses'); // gets passed to the create form to populate dropdown

      // Chapter dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['chapter_title'] = $this->model->get('id','chapters_bpa');

      //  Office Titles dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['office_title'] = $this->model->get('id','ccmps_chapter_offices'); 

      //  Member Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['member_type'] = $this->model->get('id','ccmps_member_types'); 

      //  Certificate Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['cert_title'] = $this->model->get('id','ccmps_certificate_types'); 

      // states
      $data['state_codes'] = $this->model->get('id','states'); 

    // get the permissions for each function in this submodule for the current user's user_level
      for ($i = 1; $i <= 20; $i++) 
      {
      $sql = "SELECT * FROM ccmps_access WHERE ccmps_access.action_id = $i AND ccmps_access.level_id = $userlevel";
      $access_array = $this->model->query($sql,'array');

       // print_r($access_array); die(); // only see the first one cuase havent iterated thru table yet

      ${"action".$i. "_c"} =  $access_array[0]['create'];
      ${"action".$i. "_r"} =  $access_array[0]['read'];
      ${"action".$i. "_u"} =  $access_array[0]['update'];
      ${"action".$i. "_d"} =  $access_array[0]['delete'];
      //print_r($func1_r); die();

    }

      // add permissions for buttons and data partioning
      $data['action2_r'] = $action2_r;
      $data['action3_d'] = $action3_d;
      $data['action3_c'] = $action3_c;
      $data['action3_u'] = $action3_u;
      $data['action3_r'] = $action3_r;
//echo "line49: ";
//print_r($data['action3_r']); die();
/*
        $recdata = (array)$recdata; 
//      print_r($recdata); die();

        // Add record data array to the $data array 
        $data = array_merge($viewdata, $recdata);
*/
    return $data;
  }

/*------------------------------- Add View Page Update Header ---------------------------------*/

    function _add_view_page_update_header($recdata, $task = NULL, $recid = NULL, $userlevel, $frmpg){  // from 212 & 573

        // Add these elements to properly draw the screen


        $viewdata['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $viewdata['content_name']   = "System Administrator"; 
        $viewdata['contentfile']    = __DIR__."/../views/inspinia/create"; //dashboard file is a shell that calls those above
        $viewdata['contentheader']  = "System Account Update"; // not used
        $viewdata['breadcrumb1']    = "Accounts"; // displayed in the content file                      
        $viewdata['breadcrumb2']    = "System Accounts"; // displayed in the content file
        $viewdata['breadcrumb3']    = "Update System Account"; // displayed in the content file    
        $viewdata['recid']          = $recid; // record id to view
        $viewdata['frmpg']          = $frmpg; 
//print_r($viewdata['recid'] ); die();
//echo('Line 1048 - frmpg');print_r($viewdata['frmpg'] ); die();

        $recdata = (array)$recdata; 
      //      json($recdata); die();

        // Add record data array to the $data array 
        $data = array_merge($viewdata, $recdata);
//echo('Line 1032');
//print_r($data); die();

      // Add code for all dropdowns - must come after the array_merge statement to be added as an object in the $data array
      // get all object for dropdown - you can show $row->title but save $row->id

    // Here we will update a field on a related table (trongate_users - user_level_id) using a dropdown list from a third table (trongate_user_levels)
      // User Levels dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['usrlvls'] = $this->model->get('id','trongate_user_levels'); // gets passed to the create form to populate dropdown

      // Member Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['membertypes'] = $this->model->get('id','ccmps_types'); // gets passed to the create form to populate dropdown

     // chapters
     $data['chapters'] = $this->model->get('id','chapters_bpa'); 

     // chapter roles
     $data['chapterroles'] = $this->model->get('id','ccmps_chapter_offices'); 

     // highest certificate
     $data['highestcerts'] = $this->model->get('id','ccmps_certificate_types'); 

      // states
      $data['state_codes'] = $this->model->get('id','states'); 

     // genders
     $data['genders'] = $this->model->get('id','genders'); 

      // Account Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['accttypes'] = $this->model->get('id','financial_account_types'); // gets passed to the create form to populate dropdown

      // Account Status dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses'); // gets passed to the create form to populate dropdown




      // Get current user level to make default in the dropdown when editing
      $tguserid = $data['trongate_user_id']; 

      // pull out the current user_level_id from trongate_users table to be potentially updated by the create form
      $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');     
      $data['currentuserlevel'] = $tguserobj->user_level_id; // this is the current level

     //print_r($userlevel); die();  User level of the user editing (logged-in user). $data['currentuserlevel'] is that of record being edited.

    // get the permissions for each function in this submodule for the current user's user_level
      for ($i = 1; $i <= 20; $i++) 
      {
      $sql = "SELECT * FROM ccmps_access WHERE ccmps_access.action_id = $i AND ccmps_access.level_id = $userlevel";
      $access_array = $this->model->query($sql,'array');

       // print_r($access_array); die(); // only see the first one cuase havent iterated thru table yet

      ${"action".$i. "_c"} =  $access_array[0]['create'];
      ${"action".$i. "_r"} =  $access_array[0]['read'];
      ${"action".$i. "_u"} =  $access_array[0]['update'];
      ${"action".$i. "_d"} =  $access_array[0]['delete'];
      //print_r($func1_r); die();

    }
//print_r($action3_r); die();
      // add permissions for buttons and data partioning
      $data['action2_r'] = $action2_r;
      $data['action3_d'] = $action3_d;
      $data['action3_c'] = $action3_c;
      $data['action3_u'] = $action3_u;
      $data['action3_r'] = $action3_r;


// Line 556 show just the user record part with the clutter of the dropdowns      
//echo('Final dataset to the create & view forms for a single record either view, create or update - Line 2621');
//print_r($data); die();  

    return $data;
  }
/*-------------------------- SF - Display Code Names vs. ID Numbers ---------------------------*/ 

     function _display_level_names($dr){
      $data['rows'] = $dr;
      // display the code name instead of it's id
      foreach($data['rows'] as $row) { 
        // get the cert code id  
          $levelid = $row->id;
        // get the cert code record object for that id
          $levelrec = $this->model->get_where($levelid,'trongate_user_levels'); // object
          // replace the cert code id with the cert code title from the record object
          $row->id = $levelrec->title;
        
        }
      return $data['rows'];
    }

/*--------------------------- SF - Display Code Names vs. ID Numbers -----------------------------*/ 

    function _convert_level_id_to_name($tguserid){


// Do conversions
        // get tg user level and convert to text
        // pull out the user_level_id from
        $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');
  // json($tguserobj); die();       
        $tguserlevel = $tguserobj->user_level_id;

        // Get the name of the trongate_user_level
        $tguserlevelobj = $this->model->get_one_where('id', $tguserlevel, 'trongate_user_levels');
      //   json($tguserlevelobj); die();
       
        // Convert the User Level to a user friendly name
        if($tguserlevel > 0){
          $tguserlevelname = $tguserlevelobj->level_title;
        }else{
          $tguserlevelname = "None";
        }
      //  echo('Line 162 - tguserlevelname: ');
    //  print_r($tguserlevelname); die();

      return $tguserlevelname;
  }

/*-------------------------- SF - Get the User Token Expiration Date -----------------------------*/ 

    function _get_user_token_expiration($tguserid2){  // is this used anywhere?


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

  function protect_backend(){

  // get the user level
  $this->module('trongate_tokens');
  $trongate_user_obj = $this->trongate_tokens->_get_user_obj();
  $user_level = $trongate_user_obj->user_level_id;
  
  // if your token has expired (expired while you were logged in) _get_user_obj() will fail
  // and there will be no $user_level so the $sql statement will fail and throw a 500 error!
//print_r(strlen($user_level)); die();
//  if($user_level > 0){ //$user_level is 0 if object doesnt exist b- not enough -if simul logged into front in it is set
  if($_SESSION['honcho_logged_in'] == 1){  //$user_level is 0 if object doesnt exist

    // continue
  // print_r($_SESSION['honcho_logged_in'] ); die();
  }else{

    // token has expired, $user_level not found - return to login

        // Prepare flash message
        $flash_msg = 'Your session has expired - Please Sign In again';
        set_flashdata($flash_msg);

//        $this->_destruct();
   // echo "load welcome";
        $this->module('honcho');
        $this->honcho->login();
  }



  }


function submit_upload_picture($update_id, $submit) {

  // if using default security only let admins do this
  //$this->module('trongate_security');
  //$this->trongate_security->_make_sure_allowed();
//print_r($update_id); die();

//print_r($submit); die();

 // $submit = post('submit');  // no need - got it in $task function above

  error_reporting(E_ALL);ini_set('display_errors', 'On');

  if ($submit == 'Upload') {

    $picture_settings = $this->_init_picture_settings();
    extract($picture_settings);

    $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
    $this->validation_helper->set_rules('picture', 'item picture', $validation_str);

    $result = $this->validation_helper->run();
//print_r($result); die();
    if ($result == true) {

      $config['destination'] = $destination.'/'.$update_id;
      $config['max_width'] = $resized_max_width;
      $config['max_height'] = $resized_max_height;

      if ($thumbnail_dir !== '') {
        $config['thumbnail_dir'] = $thumbnail_dir.'/'.$update_id;
        $config['thumbnail_max_width'] = $thumbnail_max_width;
        $config['thumbnail_max_height'] = $thumbnail_max_height;
      }
//print_r($config); die();
      $ok = $this->_make_sure_got_destination_folders($update_id, $picture_settings);
//echo('Directories should have been created, $ok = ');
//echo('<br>');
//print_r($ok); die();

      //upload the picture
      $config['upload_to_module'] = (!isset($picture_settings['upload_to_module']) ? false : $picture_settings['upload_to_module']);      
      $this->image->upload($config);

      //update the database
      $picdata['picture'] = $_FILES['picture']['name'];  // returns only the file name, not path
//echo('Picture should have uploaded');
//echo('<br>');
//print_r($data['picture'] ); die();
    //  $this->model->update($update_id, $picdata);
//print_r($update_id); die();
      $this->model->update($update_id, $picdata, 'ccmps');

      $flash_msg = 'Your photo was successfully uploaded';
      set_flashdata($flash_msg);

      redirect($_SERVER['HTTP_REFERER']);

    } else {
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
}

function _init_picture_settings() {
  $picture_settings['max_file_size'] = 2000;
  $picture_settings['max_width'] = 1200;
  $picture_settings['max_height'] = 1200;
  $picture_settings['resized_max_width'] = 450;
  $picture_settings['resized_max_height'] = 450;
  $picture_settings['destination'] = 'ccmps_photos';  // under public directory
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'ccmps_photos_thumbnails';
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  $picture_settings['upload_to_module'] = true; // upload to module media or public

  return $picture_settings;
}

    function _make_sure_got_destination_folders($update_id, $picture_settings) {

        $destination = $picture_settings['destination'];
//print_r($destination); die();
//print_r(APPPATH); die();

        if ($picture_settings['upload_to_module'] == true) {
         //   $target_dir = APPPATH.'modules/'.segment(1).'/assets/'.$destination.'/'.$update_id;  //org
         //   $target_dir = APPPATH.'modules/'.$this->url->segment(1).'/assets/'.$destination.'/'.$update_id; // old engine
            $target_dir = APPPATH.'modules/honcho/ccmps/assets/'.$destination.'/'.$update_id;
//print_r($target_dir); die();

        } else {
            $target_dir = APPPATH.'public/'.$destination.'/'.$update_id;
        }
//print_r($target_dir); die();
        if (!file_exists($target_dir)) {
            //generate the image folder
            mkdir($target_dir, 0777, true);
        }
//echo('made directory: '); print_r($target_dir); die();
        //attempt to create thumbnail directory
        if (strlen($picture_settings['thumbnail_dir'])>0) {
            $ditch = $destination.'/'.$update_id;
            $replace = $picture_settings['thumbnail_dir'].'/'.$update_id;
            $thumbnail_dir = str_replace($ditch, $replace, $target_dir);
            if (!file_exists($thumbnail_dir)) {
                //generate the image folder
                mkdir($thumbnail_dir, 0777, true);
            }
        }

    }


    function ditch_picture($update_id) {

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

} // End of Class
