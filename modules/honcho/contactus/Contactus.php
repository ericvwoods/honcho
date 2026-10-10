<?php
class Contactus extends Trongate {

/*
1)  Replace lcparent with the lowercase parent module name ex. dashboards
2)  Replace all Ccmodname with the camelcase controller name ex. Gsclasses
3)  Replace all lcmodname with lowercase submodule name ex. gsclasses
4)  Replace all UCMODNAME with upercase submodule name ex. GSCLASSES
5)  Replace all lcsingular with lowercase singular object name ex. class
6)  Replace all UCSINGULAR with  uppercasesingular name CLASS (none yet)
7)  Replace all Ccsingular with camelcase singular name ex. Class
8)  Replace all lcplural with lowercase plural object name ex. classes
9)  Replace all UCPLURAL with  uppercase plural name ex. CLASSES (none yet)
10) Replace all Ccplural with camelcase plural name ex. Classes
11) Replace all Ccviewdir with camelcase parent view directory ex. Groundschool - for location of view files
12) Replace all lcviewdir with lowercase parent view directory ex. groundschool - for location of view files
13) Replace all dbtablename with the database table name ex. gsclasses
14) Update validation rules (line 238)
15) Update database fields in functions _gslevels_fetch_data_from_post , _gslevels_fetch_data_from_db
    and _display_code_names (starting on line 436)
16) Update display code names for the view file (line 169)
17) Add code for all dropdowns (line 217)
*/

function _construct(){
  $this->parent_module = 'dashboards';
  $this->child_module = 'contsctus';
}

function _destruct(){
  $this->parent_module = '';
  $this->child_module = '';
}

function task($task, $role_id, $recid, $theme, $frmpg){

/*
  echo('In lcplural function task()');
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

    $data['role_id'] = $role_id;

      if ($task == 'manage'){


        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $data['contentfile']    = "lcviewdir/lcmodname/manage"; //location of view file
        $data['contentheader']  = "Manage Ccviewdir Ccplural";               
        $data['breadcrumb2']    = "Manage Ccplural"; // displayed in the content file
//print_r($data); die();

        // query for all records - ('order_by', 'table', limit, offset)
        $data['rows'] = $this->model->get('id','dbtablename');

        // display the code names for (list them) instead of their ids
        $dr = $data['rows'];
        $data['rows'] = $this->_display_code_names($dr);

//print_r($data); die();

      } // End manage

      if ($task == 'del'){
        //Find and delete the record delete(id, table)
        $this->model->delete($recid, 'dbtablename');
        // Unassociate any   that were assigned to this 


        // Set flash data
        $flash_msg = 'The lcsingular was successfully deleted';
        set_flashdata($flash_msg);
//echo($flash_msg); die();
        // Return to the page that called the delete
        if ($frmpg == 'm'){ // return to manage

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "lcviewdir/lcmodname/manage"; //location of view file
          $data['contentheader']  = "Manage Ccviewdir Ccplural";               
          $data['breadcrumb2']    = "Manage Ccplural"; // displayed in the content file
        //  $data['flash_msg'] = $flash_msg;

  //print_r($data); die();
  
          // query for all records - ('order_by', 'table', limit, offset)
          $data['rows'] = $this->model->get('id','dbtablename');

          // display the code names for (list them) instead of their ids
          $dr = $data['rows'];
          $data['rows'] = $this->_display_code_names($dr);          
  //print_r($data); die();

        }else{ // presumed "v" View - only two choices at this point
// believe in this case also have to return to manage since deleted the record cant return to single rec view
// echo('Just deleted from the view page'); die();
// same code as above - placeholder for another future situation

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "lcviewdir/lcmodname/manage"; //location of view file
          $data['contentheader']  = "Manage Ccviewdir Ccplural";               
          $data['breadcrumb2']    = "Manage Ccplural"; // displayed in the content file
          //  $data['flash_msg'] = $flash_msg;

          //print_r($data); die();

          // query for all records - ('order_by', 'table', limit, offset)
          $data['rows'] = $this->model->get('id','dbtablename');

          // display the code names for (list them) instead of their ids
          $dr = $data['rows'];
          $data['rows'] = $this->_display_code_names($dr);

        }
      } // End task del

      if ($task == 'view'){
 /*
  echo('In gsclasses task view');
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
        // Get an array of the record data to be shown
        $recdata = $this->_lcmodname_fetch_data_from_db($recid);
        //print_r($recdata); die();

        // get the dashboard menu array
       // $data =  $this->assigndshbrd($rid);
        // print_r($data); die();

        // Add record data array to $data array
        $data = array_merge($recdata,$data);
        // print_r($data); die();  

        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $data['contentfile']    = "lcviewdir/lcmodname/view"; //location of view file
        $data['contentheader']  = "View Ccviewdir Ccsingular";                    
        $data['breadcrumb2']    = "View Ccsingular"; // displayed in the content file   
        $data['recid']          = $recid; // record id to view

        // display the code names instead of the ids
        // Get the topic id
        $tpc = $data['topic'];
        // get the topic code record object
        $tp = $this->model->get_where($tpc,'gstopics');
        // replace the topic code with the name
        $data['topic'] = $tp->title;

        // Get the level id
        $levl = $data['level'];
        // get the level code  record object
        $lvl = $this->model->get_where($levl,'gslevels');
        // replace the level code with the name
        $data['level'] = $lvl->title;	             

        // print_r($data); die();
      } // End task view

      if ($task == 'create'){


//echo('In gsclasses task=create');
//echo(' Recid: ');        
//echo($recid); die();

        // will be here either editing or adding
        if (is_numeric($recid)){ // updating

          // Get an array of the record data to be edited
          $recdata = $this->_lcmodname_fetch_data_from_db($recid);
          //print_r($recdata); die();

          // Add record data array to the $data array
          $data = array_merge($recdata,$data);
         // print_r($data); die();         

          // Add code for all dropdowns
          // get all topics object for dropdown - you can show $row->title but save $row->id
          //$data['tpcs'] = $this->model->get('id','gstopics');

          // Add content parameters to the data array
          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "lcviewdir/lcmodname/create"; //location of view file
          $data['contentheader']  = "Update Ccviewdir Ccplural";                  
          $data['breadcrumb2']    = "-Ccplural-Update"; // displayed in the content file   
          $data['recid']          = $recid; // record id to update
          $data['frmpg']          = $frmpg;    
        
          //print_r($data); die();

        }else{ // adding

          // Add code for all dropdowns
          // get all topics object for dropdown - you can show $row->title but save $row->id
          //$data['tpcs'] = $this->model->get('id','gstopics');

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "lcviewdir/lcmodname/create"; //location of view file
          $data['contentheader']  = "Create Ccviewdir Ccplural";                  
          $data['breadcrumb2']    = "-Ccplural-New"; // displayed in the content file   
          $data['frmpg']          = $frmpg;
         // print_r($data); die();

        }
      } // End task create

      if ($task == 'submit'){

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {
echo('In Contactus task=submit'); die();

        /* Field validations */

        // Check to see if any dropdowns are still Please select... and set to "" so they fail
        //$gndr = $_POST['htg_gender'];
        //if($gndr == "Please select..."){
        //  $_POST['htg_gender'] = "";
        //}

          /* Update the field validations*/

          // field, field name in error msg, conditions - add a line for each form field
          $this->validation_helper->set_rules('title', 'lcsingular name', 'required|min_length[4]');

        // validate the form
          $result = $this->validation_helper->run();
           //echo($result); die();  // 1 or 0

          // Grab the posted values in case it fails validation and you have to prepopulate the form
          $data2 = $this->_lcmodname_fetch_data_from_post();
          $frmpg = $data2['frmpg'];
          $update_id = $data2['recid'];
//echo(' Update_id: ');        
//print_r($update_id); die();

          // if passes validation:
          if ($result == 1) {

            // Get the data posted from the form, both adding or updating
            $data = $this->_lcmodname_fetch_data_from_post();

             // Get frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];

            // need to determine if adding new or editing existing record
            // if there is a record id then must be editing, if not, we are adding
            $update_id = $data['recid'];
         //    print_r($data['recid']); die();  // should be blank page when adding
//echo($update_id); die();
//print_r($data); die();

            if (is_numeric($update_id)){ // or if () - updating  or $update_id > 0
             //  echo('Updating!'); die();              
             //  print_r($data); die();

              unset($data['frmpg']); // frmpg not in the DB and will cause an error
              unset($data['recid']); // don't want to change the record id

              $this->model->update($update_id, $data, 'dbtablename');

              // echo('Update Saved!'); die();

              // Prepare flash message
              $flash_msg = 'The lcsingular was successfully updated';
              set_flashdata($flash_msg);

              // Return to the page you launched the updating from
//  echo('From pg: ');
//  echo($frmpg); die();

              if ($frmpg == 'm'){

                // Assign Dashboard again - data got wiped out for the record insert above
               // $data =  $this->assigndshbrd($rid);

                // Setup for manage courses (copied from above)
                $data['contentfile']    = "lcviewdir/lcmodname/manage"; //location of view file
                $data['contentheader']  = "Manage Ccviewdir Ccplural";               
                $data['breadcrumb2']    = "Manage Ccplural"; // displayed in the content file

                // query for all records - get('order_by', 'table', limit, offset)
                $data['rows'] = $this->model->get('id','dbtablename');

                // display the code names for (list them) instead of their ids
                $dr = $data['rows'];
                $data['rows'] = $this->_display_code_names($dr);

              
              } else { // Must be coming from view record $frmpg = 'v' since currently only two options

                // echo('Coming from view page after saving update'); die();
                // echo($update_id); die();

                // Get an array of the record data to be shown after changes saved to DB
                $recdata = $this->_lcmodname_fetch_data_from_db($update_id);
                //  print_r($recdata); die();

                // Add record data array to the $data array
                $data = array_merge($recdata,$data);
                // print_r($data); die();  

                $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
                $data['contentfile']    = "lcviewdir/lcmodname/view"; //location of view file
                $data['contentheader']  = "View Ccviewdir Ccsingular";                    
                $data['breadcrumb2']    = "View Ccsingular"; // displayed in the content file   
                $data['recid']          = $update_id; // record id to view

                // display the code names instead of the ids
                // Get the topic id
                $tpc = $data['topic'];
                // get the topic code record object
                $tp = $this->model->get_where($tpc,'gstopics');
                // replace the topic code with the name
                $data['topic'] = $tp->title;

                // Get the level id
                $levl = $data['level'];
                // get the level code  record object
                $lvl = $this->model->get_where($levl,'gslevels');
                // replace the level code with the name
                $data['level'] = $lvl->title;	
                // print_r($data); die(); 

              }

            } else { //adding

             // Get frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];
             //echo('Frmpg!:');
             //echo($frmpg); die();

             // Must remove $data['frmpg] from the array or you will get an error during insert
             // since frmpg doesn't exist in the database & no recid either & undefined since new
              unset($data['frmpg']);
              unset($data['recid']);

//echo('Adding!');
//print_r($data); die();

              //insert the new record            
              $this->model->insert($data, 'dbtablename');
           //   echo('New record added!'); die();   

              // get the new record's id
              $new_id = $this->model->get_max('dbtablename');

              // Prepare flash message
              $flash_msg = 'The lcsingular was successfully created';
              set_flashdata($flash_msg);

              // Return to the page you launched the adding from
              // Determine where to return to
//print_r($frmpg); die();

              if ($frmpg = 'm'){

                // Setup for manage courses (copied from above)
                $data['contentfile']    = "lcviewdir/lcmodname/manage"; //location of view file
                $data['contentheader']  = "Manage Ccviewdir Ccplural";               
                $data['breadcrumb2']    = "Manage Ccplural"; // displayed in the content file

                // query for all records - get('order_by', 'table', limit, offset)
                $data['rows'] = $this->model->get('id','dbtablename');

                // display the code names for (list them) instead of their ids
                $dr = $data['rows'];
                $data['rows'] = $this->_display_code_names($dr);

              } else { // Must be coming from view record $frmpg = 'v' since currently only two options
                       // Currently no ADD button on the view page, only UPDATE
              }

            } // end isnumeric

          } else { // failed validation

              // Prepare flash message
              $flash_msg = 'The record failed validation';
              set_flashdata($flash_msg);

              // Add the posted values ($data2) to the dashboard menus
              $data = array_merge($data,$data2);

              if (is_numeric($update_id)){ // failed updating

//echo 'failed validation updating-';
//echo('Update id: ');
//echo($update_id);

              // Add content parameters to the data array
              $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
              $data['contentfile']    = "lcviewdir/lcmodname/create"; //location of view file
              $data['contentheader']  = "Failed Validation - Update Ccviewdir Ccsingular";                  
              $data['breadcrumb2']    = "-Ccplural-Update"; // displayed in the content file   
              $data['recid']          = $update_id; // record id to update
              $data['frmpg']          = $frmpg;  

              //print_r($data); die();

              }else{ // failed adding

              //echo('Failed Validation Adding');

              // Add content parameters to the data array
              $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
              $data['contentfile']    = "lcviewdir/lcmodname/create"; //location of view file
              $data['contentheader']  = "Failed Validation - Create Ccviewdir Ccplural";                  
              $data['breadcrumb2']    = "-Ccplural-New"; // displayed in the content file   
              $data['frmpg']          = $frmpg;

              //print_r($data); die();

              }

          } // end result (validation)
        }
      }else{ // this should run only first time when page is drawn and then continue execution below
             // fetching data either from post or database. When return it will be a submit and this
             // code will not run again because it will pass validation and be saved or not and cancelled. 
      } // End task submit


// print_r($data); die();
return $data; // back to parent dashboards module
        
      }// End task()

     function _lcmodname_fetch_data_from_post() {
      $data['recid']      = $this->input('recid', true);
      $data['certcode']   = $this->input('certcode', true);        
      $data['title']      = $this->input('title', true);
      $data['note']       = $this->input('note', true);
      $data['frmpg']      = $this->input('frmpg', true); // for navigation but not stored in DB

      return $data;
   }

   function _lcmodname_fetch_data_from_db($update_id) {
// echo('Made it to fetch data from db'); die();       

      // query for single record - ('order_by', 'table', limit, offset)
      $updrec = $this->model->get_where($update_id,'dbtablename');
//print_r($data['updrec']); die();

    // load values in the recdata array from the record object
      $recdata['recid']      = $updrec->id;
      $recdata['certcode']   = $updrec->certcode;        
      $recdata['title']      = $updrec->title;
      $recdata['note']       = $updrec->note;

      $recdata['htg_somedate'] = $updrec->htg_somedate;
      $tstodp = $recdata['htg_somedate'];
      //echo('Made it!');
  //print_r($tstodp); die();
      $this->module('timedate');
      $recdata['htg_somedate'] = $this->timedate->get_nice_date($tstodp, 'datepicker_us'); 
  //print_r($recdata['htg_somedate'] ); die();


    // if no record was found
    if(!isset($recdata)){
      $recdata = "";
    }
         
    // print_r($data); die();
    // Return the array
    return $recdata;
 } 

    function _display_code_names($dr){
      $data['rows'] = $dr;
      // display the code name instead of it's id
      foreach($data['rows'] as $row) { 
        // get the topic id  
          $tpid = $row->topic;
        // get the topic record object for that id
          $tprec = $this->model->get_where($tpid,'gstopics'); // object
          // replace the topic id with the title from the record object
          $row->topic = $tprec->title;

          // get the level id  
          $lvlid = $row->level;
          // get the level record object for that id
          $lvlrec = $this->model->get_where($lvlid,'gslevels'); // object
          // replace the topic id with the title from the record object
          $row->level = $lvlrec->title;
        
        }
      return $data['rows'];
    }

    public function _encrypt_string($str, $key) // php 7.2+  SODIUM
    {
      //echo('Made it!'); die();

      // this is what I used one time to create the permanent $strkey
      //$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
      //$strkey = bin2hex($key);
      //print_r($strkey); die();

      // lets see what was passed
      //print($str);
      //print($key); die();

      $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      //print_r($nonce);
      $ciphertext = sodium_crypto_secretbox($str, $nonce, $key);
      //print_r($ciphertext);
      // store the nonce with encrypted text, will separate out on the decrypt
      $encoded = base64_encode($nonce . $ciphertext);
      //print_r($encoded); die();

      return $encoded;

    }

    public function _decrypt_encoded($encoded, $key)
    {
     // echo('Made it!'); die();
      //print($encoded);
      //print_r($key);
      $decoded = base64_decode($encoded);
      $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
      //print_r($nonce);
      $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
      //print_r($ciphertext);      
      $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
     // print_r($plaintext); die();

      return $plaintext;

    }
}