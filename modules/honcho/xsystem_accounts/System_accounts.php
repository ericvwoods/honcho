<?php
class System_accounts extends Trongate {

function _construct(){
  $this->parent_module = 'honcho';
  $this->child_module  = 'system_accounts';
}

function _destruct(){
  $this->parent_module = '';
  $this->child_module = '';
}

/* System Accounts  */

function task($task, $role_id, $recid, $theme, $frmpg){

//If token expired while logged in or if logged out will get 500 error
// so prevent 500 error by checking for token and redirecting to login page
// if necessary

  $this-> protect_backend();


  // get the user level
  $this->module('trongate_tokens');
  $trongate_user_obj = $this->trongate_tokens->_get_user_obj();
  $user_level = $trongate_user_obj->user_level_id;


  // get the number of unique functions in the system_accounts_access table

  // get the permissions for each function in this submodule for the current user's user_level
  for ($i = 1; $i <= 20; $i++) 
{
  $sql = "SELECT * FROM system_accounts_access WHERE system_accounts_access.action_id = $i AND system_accounts_access.level_id = $user_level";
  $access_array = $this->model->query($sql,'array');

 // print_r($access_array); die(); // only see the first one cause havent iterated thru table yet

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

/*-------------------------------- Task is Upload User Picture -------Not Used -------------------------*/

/*---------------------------------------------------------------------------------------------*/

if ($task == 'uploadsysacctpic'){ 


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
echo('Line 184 - $recdata: ');
 echo('<br>');
 print_r($recdata); die();
 */

//    print_r($user_level); die();
          $data = $this->_add_view_page_update_header($recdata, $task, $recid, $user_level, $frmpg); // same as 573

          $data['action3_d'] = $action3_d;

        //  print_r($action3_d); die();

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
        if($action1_r > 0){
          $data = $this->_manage_all_records();
 //         print_r($data); die();
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
          $delrec  = $this->model->get_where($recid,'system_accounts');
          $tgusrid = $delrec->trongate_user_id;

          //Find and delete the record delete(id, table)
          $this->model->delete($recid, 'system_accounts');

          // Unassociate any classes that were assigned to this course
          $this->model->delete($tgusrid, 'trongate_users');

          // Set flash data
          $flash_msg = 'The system account was successfully deleted.';
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
 echo('Line 458 - submit == Submit');
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

          // Grab the account table data from the post
          $sysdata_post = $this->_system_accounts_fetch_data_from_post();
          $sysdata_post['frmpg'] = $frmpg;
        //  $update_id = $sysdata_post['recid'];
          $update_id = $recid;  // came in the URL not POST
          $sysdata_post['recid'] = $recid; // add recid from url to post data

        // Check the username that was submitted if adding & not unique set $result to 0.

//print_r($sysdata_post); die(); // no $userlevel
        // If editing and get a duplicate match, check to see if they are editing their own record so its ok
          // check to see if the username is already taken - somebody could attempt to change theirs to one that exists already
          $usrnm = $sysdata_post['username'];
          $usernm = trim($usrnm);
          $usr_obj = $this->model->get_one_where('username', $usernm, 'system_accounts');
//print_r($usr_obj); die();              
          $recordfndid = $usr_obj->id;
//print_r($recordid); die();
          if($recordfndid > 0){ // record found id exists so there is a user with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the current user
            if($recordfndid == $update_id){

              // its the same user editing his own record so everything OK
              // nothing to do here just keep executing
              //echo('Found but Everything OK'); die();

            }else{ 

              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $flash_msg = 'Username already exists';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

              $result = 0;

            } // will keep executing if same username for the same guy
            

          } // the username wasnt found so keep executing

//print_r($result); die();


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
echo('Line 321 - $findata_post: ');
echo('<br>');                    
print_r($findata_post); die();
*/         

/*---------------------------- submit = Submit: Passed Validation -----------------------------*/
          //  $result = true; // returns a integer 1 - FOR TESTING ONLY WHEN NO VALIDATIONS SET
          // if passes validation on line 292 

          if ($result == 1) {  // failure is on line 954
          
//echo('Line - 317: result of validation helper $result = 1 - passed!'); die();

            // Get the data posted from the form, both adding or updating
            $data = $sysdata_post; // $sysdata_post already got the new user level & the frmpg
//print_r($data); die();

             // Extract the frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];
//print_r($frmpg); die();
            // need to determine if adding new or editing existing record
            // if there is a record id then must be editing, if not, we are adding
            $update_id = $data['recid'];
/*
 echo('Line 336 - $updateid - if exist then updating if not exist adding - $updateid=');
 print_r($update_id); die();  // should be blank page when adding
*/


/*---------------------- submit = Submit: Passed Validation - Updating ----------------------*/

            if (is_numeric($update_id)){ // or if () - updating  or $update_id > 0 - Updating an existing record line 478 adding
//echo('Updating!');              
//print_r($update_id); die();

             
        			// unset calculated values that are not in the DB or will get an error
        			// frmpg & User Level
              unset($data['userlevel']); // not in the system_accounts table table and will cause an error
              unset($data['frmpg']); // not in the DB and will cause an error
              unset($data['tguserlevelname']);
              unset($data['recid']); // not in db and don't want to change the record id
              $data['updated_by'] = 1; //$_SESSION['tg_user_id'];
              $data['updated_at'] = TIME();

    //          print_r($sysdata_post['userlevel']); die();  
//print_r($data); die();
              // Grab the user level chosen on the create page before unsetting so the query will save since userlevel is not in this table

              // user_level will not come in from post when account edited by someone without the rights to this field
          /**    if($data['userlevel'] > 0){
              $userlevel = $data['userlevel']; // used below to update the trongate_users table with the new user_level_id after the system accounts table
              }else{
                unset($data['userlevel']); // if no updated value then remove so wont have DB error
              } */
   
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

/*---------------------- submit = Submit: Passed Validation - Saving the User Account Updates ----------------------*/                  
/*
echo('Line 615 - Updated user account dataset about to be saved for record: ');
print_r($update_id);
echo('<br>');
echo('frmpg: ');
echo($frmpg);
echo('<br>');
print_r($data); die();
*/

                  // no financial data so wont throw a DB error
                  $this->model->update($update_id, $data, 'system_accounts');
$userlevel = $sysdata_post['userlevel'];
$datausrlvl['user_level_id'] = $userlevel;
//print_r($userlevel); die();
                 // If the user_level has been returned by the create form 
                 if($userlevel > 0){
                  $this->model->update($update_id, $datausrlvl, 'trongate_users');
                 }

//echo('Line 595'); die();
//echo('Line 551'); die();
//echo('Update Saved!'); die();

              // create a dataset for the corresponding financial account
              // $findata_post contains what as filled in on the create form.

              // 2 set by system for all updated accts

              $updfindata['updated_at']       = TIME();
              $updfindata['updated_by']       = $_SESSION['tg_user_id'];

              // 11 gathered from the user on the create form - if blank leave blank
              $fin_id                        = $findata_post['fin_id'];
              $updfindata['billaddress1']    = $findata_post['billaddress1'];
              $updfindata['billaddress2']    = $findata_post['billaddress2'];
              $updfindata['billcity']        = $findata_post['billcity'];
              $updfindata['billstate']       = $findata_post['billstate'];
              $updfindata['billzip']         = $findata_post['billzip'];
              $updfindata['fin_inactive']    = $findata_post['fin_inactive']; // returns 1 or 0
              $updfindata['fin_billisship']  = $findata_post['fin_billisship'];
              $updfindata['fin_notes']       = $findata_post['fin_notes'];          
//print_r($findata_post['fin_billisship']); die();
//print_r($updfindata['fin_billisship']); die();
              // if these 9 fields are left blank on the create form, set values or use the info from the system form

              if($findata_post['acct_type'] > 0){ // if it was filled in on the create form
                $updfindata['acct_type']  = $findata_post['acct_type']; // the use what was filled in
              }else{ 
                $updfindata['acct_type']  = 1; // otherwise set it to 1-personal 2-corp 3-sponsor
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
              $updfindata['fin_billisship'] = 0;

//print_r($updfindata['fin_billisship']); die();

//echo('Line 452 - $updfindata');
//echo('<br>');                    
//print_r($updfindata); die();

/*---------------------- submit = Submit: Passed Validation - Saving the Financial Account Updates ----------------------*/
//print_r($fin_id); die();
              //insert the upd financial account record            
              $this->model->update($fin_id, $updfindata, 'system_accounts_financial');
// echo('Line 459 - financial account data updated!'); die();  


              // Prepare flash message
              $flash_msg = 'The account was successfully updated';
              set_flashdata($flash_msg);

/*-------------------------------------------------------------------------------------------*/              
/*------------- submit = Submit: Passed Validation - Updating - from Manage Page ------------*/
/*-------------------------------------------------------------------------------------------*/

/*
echo('Line 709 - Updated financial account dataset about to be saved for record: ');
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
echo('Line 826 - Task = submit - submit = Submit - Updating');
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

//echo('Line 853 - Adding!');
//print_r($data); die();

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
              print_r($data['userlevel']); die();
              $usrlvl['user_level_id'] = $data['userlevel']; // must capture before unset
              unset($data['userlevel']);

      			  // Do not try to save an interger than is a NULL. Either Unset or set = 0.
      			  if($data['reset_interval'] > 0 | $data['reset_interval'] = 0){
      			  	// Do nothing
      			  }else{

                unset($data['reset_interval']);			  	
      			  }

              // Hash initial password before saving
              $pword            = $this->input('password');
              $data['password'] = $this->_hash_string($pword);
              $usernm           = $this->input('username');
              $usernm           = trim($usernm);

              // check to see if the username is already taken

              $user_obj = $this->model->get_one_where('username', $usernm, 'system_accounts');

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
              $this->model->insert($data, 'system_accounts');
 //echo('Line 539 - New system account record added!'); die();   

              // get the new record's id
              $new_id = $this->model->get_max('system_accounts');

              // create a dataset for the coreesponding financial account
              // $findata_post contains what as filled in on the create form.

              // 5 set by system for all new accts

              $newfindata['code']         = $this->_generate_rand_code();
              $newfindata['sys_acct_id']  = $new_id;
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

              if($findata_post['acct_type'] > 0){ // if it was filled in on the create form
                $newfindata['acct_type']  = $findata_post['acct_type']; // the use what was filled in
              }else{ 
                $newfindata['acct_type']  = 1; // otherwise set it to 1-personal 2-corp 3-sponsor
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
              $this->model->insert($newfindata, 'system_accounts_financial');
 //echo('Line 770 - New financial account data added!'); die();  
              // Prepare flash message
              $flash_msg = 'The account was successfully created';
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

    function _system_accounts_fetch_data_from_post() {
//		$data['']      = $this->input('', true);
// the name="..." in the form control parameters is what is passed as an input through the post

    // System Accounts Table
      
 		$data['recid']           = $this->input('id', true);
 		$data['first_name']      = $this->input('first_name', true);
 		$data['middle_name']     = $this->input('middle_name', true);
		$data['last_name']       = $this->input('last_name', true);
		$data['suffix']          = $this->input('suffix', true);
		$data['username']        = $this->input('username', true);
		$data['tguserlevelname'] = $this->input('tguserlevelname', true);
		$data['title']           = $this->input('title', true);
		$data['department']      = $this->input('department', true);
		$data['phone']           = $this->input('phone', true);
		$data['email_address']   = $this->input('email_address', true);
		$data['picture']         = $this->input('picture', true);
		$data['homepage']        = $this->input('homepage', true);
		$data['notes']           = $this->input('notes', true);
		$data['password']        = $this->input('password', true);
		$data['userlevel']       = $this->input('userlevel', true);
    // System Table Integers

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

      return $data;  // goes to 489
    }

    function _financial_accounts_fetch_data_from_post() {
//    $data['']      = $this->input('', true);
// the name="..." in the form control parameters is what is passed as an input through the post

    // Financial Table

    $findata['fin_id']             = $this->input('fin_id', true);                                       
    $findata['fin_code']           = $this->input('fin_code', true);                                     
    $findata['sys_acct_id']        = $this->input('sys_acct_id', true);
    $findata['acct_type']          = $this->input('acct_type', true);                                    
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
    $findata['fin_date_created']   = $this->input('fin_date_created', true);                                 
    $findata['fin_created_by']     = $this->input('fin_created_by', true);
    $findata['fin_updated_by']     = $this->input('fin_updated_by', true);
    $findata['fin_created_at']     = $this->input('fin_created_at', true);
    $findata['fin_updated_at']     = $this->input('fin_updated_at', true);

    // Convert back to INTEGER to save to database
    //$xyz     = $this->input('xyz', true);
    //If($xyz == 'Yes'){
    //  $data['xyz'] = 1;
    //}else{
    //  $data['xyz'] = 0; 
    //}

    // Financial Table Integers


    //$data['acct_type']          = ;

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
        $data['contentfile']    = __DIR__."/../views/inspinia/manage"; //relative to honcho/views/inspinia (layoutone.php)
        $data['contentheader']  = "Manage System Accounts";
      //  $data['contentmenu']    = '';  // in case you want to provide a navigation menu instead of just buttons on the page
        $data['breadcrumb1']    = "Accounts";               
        $data['breadcrumb2']    = "System Accounts"; // displayed in the content file
        $data['breadcrumb3']    = "Manage System Accounts";

// print_r($data); die();
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        $data['rows'] = $this->model->get('id','system_accounts'); // works manage
//print_r($data['rows']); die();
      	foreach($data['rows'] as $row) { // step through the array of records and pull out needed values
         
        $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from system_accounts
		    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users
        $levelid   = $tgusrobj->user_level_id; // capture the level id to query for the level name
        $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels        
        $levelname = $levelobj->level_title;  // capture the level name
        // now we need to insert the levelnames in the array for display
        $row->levelname = $levelname;
        
        }
//print_r($data); die();
        return $data;
 	}

/*------------------------ SF - Get a Single Record for the View Page -------------------------*/ 

 	function _get_a_single_record($recid) {  //called when updating from line 129 when viewing & line 452 when updating

//print_r($recid); die();
 		    // Get an object of the record data to be shown
              // query for single record - ('order_by', 'table', limit, offset)

        $sysdata = $this->model->get_where($recid,'system_accounts');

/*--------------- View - Convert to TG UL ID to Name -------------------*/

        // pull out the trongate user id to search the trongate_users table for user_level_id

        $tguserid = $sysdata->trongate_user_id; // record id for the user in trongate_user

        $tguserlevelname = $this->_convert_level_id_to_name($tguserid);

/*----------------- View - Get User Token Expiration -------------------*/

        // pull out the trongate user id to search the trongate_users table for token expiration date
        $tguserid2 = $sysdata->trongate_user_id; // record id for the user in trongate_user
        $tokenexpires = $this->_get_user_token_expiration($tguserid2); 

/*--------- View - Convert Updated By & Created By to a Name -----------*/

    		$updated_by = $sysdata->updated_by;
    		$created_by = $sysdata->created_by;

    		$updated_by_raw = $sysdata->updated_by;
    		$created_by_raw = $sysdata->created_by;

		// only a system account user can add/update a system_account
        $tguserobj2       = $this->model->get_one_where('trongate_user_id', $updated_by, 'system_accounts');
        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;


        $tguserobj3       = $this->model->get_one_where('trongate_user_id', $created_by, 'system_accounts');
        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;
//print_r($tguserobj3); die();
        // if not a real record pass thru updated_by & created_by as the NULL that it is so wont show up in data-present only tabular reports
        // otherwise you are passing spaces and it will come thru as not null and not empty and isset = true
        if(strlen($updated_by_first) >0){
            $updatedby        = $updated_by_first.' '.$updated_by_last;
		    }
        if(strlen($created_by_first) >0){
        	$createdby        = $created_by_first.' '.$created_by_last;
		    }
//print_r($updated_by_first); die();
/*-------- View - Convert Codes & Convert Dates to Nice Dates ----------*/

  /* 
   // display the code names instead of the ids
   // Get the cert code id
   $ccid = $data['certcode'];
   // get the cert code record object
   $ccrec = $this->model->get_where($ccid,'gscerts');
   // replace the cert code id with the name
   $data['certcode'] = $ccrec->title;
 */

        // Get dates
        $last_login   = $sysdata->last_login;
        $last_logout  = $sysdata->last_logout;
        $date_created = $sysdata->date_created;
        $updated_at   = $sysdata->updated_at;
        $created_at   = $sysdata->created_at;
//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report
        $last_login_raw   = $sysdata->last_login;
        $last_logout_raw  = $sysdata->last_logout;
        $date_created_raw = $sysdata->date_created;
        $updated_at_raw   = $sysdata->updated_at;
        $created_at_raw   = $sysdata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        $format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
        $this->module('timedate');
        $lastlogin     = $this->timedate->get_nice_date($last_login, $format);
        $lastlogout    = $this->timedate->get_nice_date($last_logout, $format);
        $datecreated   = $this->timedate->get_nice_date($date_created, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $this->timedate->get_nice_date($created_at, $format);

/*------ View - Add Converted Codes &  Nice Dates to the Array ----------*/

       // convert the object to an array to add additional data for the view 
       $sysdata = (array)$sysdata;

       // Translated Codes 
       $sysdata['tguserlevelname'] = $tguserlevelname;
 	     $sysdata['updated_by']      = $updatedby;
 	     $sysdata['created_by']      = $createdby;

       // Translated Dates
       $sysdata['last_login']      = $lastlogin;
       $sysdata['last_logout']     = $lastlogout;
 	     $sysdata['date_created']    = $datecreated;
 	     $sysdata['updated_at']      = $updatedat;
 	     $sysdata['created_at']      = $createdat;
	     $sysdata['token_expires']   = $tokenexpires; // translation on line 192

	   // Non-Translated 
       $sysdata['last_login_raw']     = $last_login_raw;
       $sysdata['last_logout_raw']    = $last_logout_raw;
 	     $sysdata['date_created_raw']   = $date_created_raw;
 	     $sysdata['updated_at_raw']     = $updated_at_raw;
 	     $sysdata['created_at_raw']     = $created_at_raw;
	     $sysdata['tokenexpires_raw']   = $tokenexpires_raw;
 	     $sysdata['updated_by_raw']     = $updated_by_raw;
 	     $sysdata['created_by_raw']     = $created_by_raw;


       $findata = $this->model->get_one_where('sys_acct_id',$recid,'system_accounts_financial');
//print_r($findata); die();

      // convert the object to an array for later combining with $data
      $findata = (array) $findata;

      // translate codes
      // get values to be translated
      $fincb = $findata['created_by'];
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
      $findata['fin_date_created'] = $findc;
//print_r($findata['fin_date_created']); die();     

        if(strlen($updated_by_first) >0){
          $finub = $updated_by_first.' '.$updated_by_last;
        }
        if(strlen($created_by_first) >0){
          $fincb = $created_by_first.' '.$created_by_last;
        }
//print_r($created_by_first); die();

      // created by & updated by are same as sysdata unless you allow the system_accounts_financial table
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

      $findata['fin_created_by_raw'] = $findata['created_by'];
      unset($findata['created_by']);

      $findata['fin_updated_by_raw'] = $findata['updated_by'];
      unset($findata['updated_by']);

      $findata['fin_created_at_raw'] = $findata['created_at'];
      unset($findata['created_at']);

      $findata['fin_updated_at_raw'] = $findata['updated_at'];
      unset($findata['updated_at']);

      $data = array_merge($sysdata,$findata);

 //print_r($data); die();
        return $data;
 	}

/*-------------------------------- Add View Page Header Data ----------------------------------*/

    function _add_view_page_header_data($data, $task = NULL, $recid=NULL, $userlevel=NULL, $frmpg=NULL){  // from 173, 506

        // Add these elements to properly draw the screen

        $viewdata['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $viewdata['contentfile']    = __DIR__."/../views/inspinia/view"; //dashboard file is a shell that calls those above
        $viewdata['contentheader']  = "View System Account"; //not used                    
        $viewdata['breadcrumb1']    = "System Accounts"; // displayed in the content file
        $viewdata['breadcrumb2']    = "View System Account"; // displayed in the content file
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
      $sql = "SELECT * FROM system_accounts_access WHERE system_accounts_access.action_id = $i AND system_accounts_access.level_id = $userlevel";
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
      $data['contentfile']    = __DIR__."/../views/inspinia/create"; //dashboard file is a shell that calls those above
      $data['contentheader']  = "Create System Account";
      $data['breadcrumb1']    = "Accounts"; // displayed in the content file                      
      $data['breadcrumb2']    = "System Accounts"; // displayed in the content file
      $data['breadcrumb3']    = "Create System Account"; // displayed in the content file    
      $data['frmpg']          = $frmpg; 


      // User Levels dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['usrlvls'] = $this->model->get('id','trongate_user_levels'); // gets passed to the create form to populate dropdown

      // Account Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['accttypes'] = $this->model->get('id','financial_account_types'); // gets passed to the create form to populate dropdown

      // Account Status dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['finstatuses'] = $this->model->get('id','system_accounts_financial_statuses'); // gets passed to the create form to populate dropdown

      // states
      $data['state_codes'] = $this->model->get('id','states'); 

    // get the permissions for each function in this submodule for the current user's user_level
      for ($i = 1; $i <= 20; $i++) 
      {
      $sql = "SELECT * FROM system_accounts_access WHERE system_accounts_access.action_id = $i AND system_accounts_access.level_id = $userlevel";
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

      // states
      $data['state_codes'] = $this->model->get('id','states'); 

      // Account Types dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['accttypes'] = $this->model->get('id','financial_account_types'); // gets passed to the create form to populate dropdown

      // Account Status dropdown - (query for all records 'order_by', 'table', limit, offset)
      $data['finstatuses'] = $this->model->get('id','system_accounts_financial_statuses'); // gets passed to the create form to populate dropdown

      // Get current user level to make default in the dropdown when editing
      $tguserid = $data['trongate_user_id']; 

      // pull out the current user_level_id from trongate_users table to be potentially updated by the create form
      $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');     
      $data['currentuserlevel'] = $tguserobj->user_level_id; // this is the current level

     //print_r($userlevel); die();  User level of the user editing (logged-in user). $data['currentuserlevel'] is that of record being edited.

    // get the permissions for each function in this submodule for the current user's user_level
      for ($i = 1; $i <= 20; $i++) 
      {
      $sql = "SELECT * FROM system_accounts_access WHERE system_accounts_access.action_id = $i AND system_accounts_access.level_id = $userlevel";
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


/*      
echo('Line 1751');
print_r($data); die();  
*/
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
				$tokenexpires = 'No Token';									
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
  if($user_level > 0){  //$user_level is 0 if object doesnt exist

    // continue
   
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
//print_r($update_id); 
//print_r($destination); die();

    $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
    $this->validation_helper->set_rules('picture', 'item picture', $validation_str);

    $result = $this->validation_helper->run();
    
  //  $result = TRUE;
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
   //   print_r($picture_settings); die();

      //upload the picture
      $config['upload_to_module'] = (!isset($picture_settings['upload_to_module']) ? false : $picture_settings['upload_to_module']);   
//print_r($config); die();   
      $this->image->upload($config);

      //update the database
      $picdata['picture'] = $_FILES['picture']['name'];  // returns only the file name, not path
//echo('Picture should have uploaded');
//echo('<br>');
//print_r($data['picture'] ); die();
    //  $this->model->update($update_id, $picdata);
//print_r($update_id); die();
      $this->model->update($update_id, $picdata, 'system_accounts');

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
  $picture_settings['destination'] = 'system_accounts_photos';  // under public directory
//  $picture_settings['destination'] = 'assets';  // under systems_accounts directory
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'system_accounts_photos_thumbnails';
//  $picture_settings['thumbnail_dir'] = ''; // cant have separate dir for thumbnails because can go down one level
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  $picture_settings['upload_to_module'] = true; // upload to module media or public

  return $picture_settings;
}

    function _make_sure_got_destination_folders($update_id, $picture_settings) {

        $destination = $picture_settings['destination'];
//echo(1984);
//print_r($update_id); 
//print_r($destination); die();
//print_r(APPPATH); die();

        if ($picture_settings['upload_to_module'] == true) {
         //   $target_dir = APPPATH.'modules/'.segment(1).'/assets/'.$destination.'/'.$update_id;  //org
         //   $target_dir = APPPATH.'modules/'.$this->url->segment(1).'/assets/'.$destin 

              $target_dir = APPPATH.'public/'.$destination.'/'.$update_id;
          //     $target_dir = APPPATH.'modules/honcho/system_accounts/assets/'.$destination.'/'.$update_id;


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
