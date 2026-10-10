<?php
session_start();
require_once APPPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
 

class Contacts extends Trongate {

/*
1)  Replace lcparent with the lowercase parent module name ex. dashboards
2)  Replace all Ccmodname with the camelcase controller name ex. Contacts
3)  Replace all lcmodname with lowercase submodule name ex. contacts
4)  Replace all UCMODNAME with upercase submodule name ex. CONTACTS
5)  Replace all lcsingular with lowercase singular object name ex. scrmcontact
6)  Replace all UCSINGULAR with  uppercasesingular name SCRMCONTACT (none yet)
7)  Replace all Ccsingular with camelcase singular name ex. Scrmcontact
8)  Replace all lcplural with lowercase plural object name ex. contacts
9)  Replace all UCPLURAL with  uppercase plural name ex. CONTACTS (none yet)
10) Replace all Ccplural with camelcase plural name ex. Contacts
11) Replace all Ccviewdir with camelcase parent view directory ex. People - for location of view files
12) Replace all lcviewdir with lowercase parent view directory ex. people - for location of view files
13) Replace all dbtablename with the database table name ex. contacts
14) Update validation rules (line 238)
15) Update database fields in functions _contacts_fetch_data_from_post , _contacts_fetch_data_from_db
    and _display_code_names (starting on line 436)
16) Update display code names for the view file (line 169)
17) Add code for all dropdowns (line 217)
*/

function _construct(){
  $this->parent_module = 'dashboards';
  $this->child_module = 'contacts';

//echo($strkey); die();
}

function _destruct(){
  $this->parent_module = '';
  $this->child_module = '';
}

function task($task, $role_id, $recid, $theme, $frmpg){

// passed from Dashboards/index

/*
  echo('In contacts function task()');
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

      //  $this->module('eventlog');
      //  $this->eventlog->logevent('People-Contacts-Manage', 'ran','contacts', 'manage');

        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $data['contentfile']    = "people/contacts/manage"; //location of view file
        $data['contentheader']  = " People | Contacts";               
        $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file
        $data['content_name']   = "Manage Contacts"; 
// print_r($data); die();

        // query for all rows not marked deleted
        if ($role_id == 1){
          $data['rows'] = $this->model->get('id','contacts');
         
      }else{
        $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

      }
       // $result = $this->model->get_where_custom('status',9,'!=','id','contacts');
 //print_r($data); die();

          $dr = $data['rows'];
          // $data will be passed back with numeric codes replaced by the code names in the data array sent to the view page
          $data['rows'] = $this->_display_code_names($dr);
// print_r($data['rows']); die();



       //   $data['rows'] = $this->model->get('id','contacts');
    //      print_r($data['rows']); die();  // array with 1 object for everything
    //      print_r($data); die(); // array with eveything
        //  $data['rows'] = (array)$data['rows'];


      //  $tstmp = time();
      //  echo($tstmp); die();

      //    foreach($rows as $row){

      //      echo('Made it!'); die();

      //    }
      //  print_r($result); die();

       // while ($row = $result->fetch(PDO::FETCH_OBJ)){
       //   $firstname = $row->firstname;
       //   echo($firstname); die();
//
       //   $key = $_SESSION['key'];
       //   $data['firstname'] = $this->_decrypt_encoded($firstname, $key);

       //   print_r($data['firstname']); die();
      //  }





        // display the code names for (list them) instead of their ids
      //  $dr = $data['rows'];
      //  $data['rows'] = $this->_display_code_names($dr);

//print_r($data); die();

      } // End manage

      

      if ($task == 'permdel'){
        $this->module('eventlog');
        $this->eventlog->logevent('People-Contacts-Permdel', 'ran','contacts', 'permdel');

        //Find and delete the record delete(id, table)
        $this->model->delete($recid, 'contacts');
        // Delete any addresses that were assigned to this contact 


        // Set flash data
        $flash_msg = 'The contact was permanently deleted';
        set_flashdata($flash_msg);
        $data['alerttype'] = "success"; // success, error, info, block


        // Return to the page that called the delete
        if ($frmpg == 'm'){ // return to manage

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/manage"; //location of view file
          $data['contentheader']  = "Manage Contacts";               
          $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file
  
          // query for all rows not marked deleted
          $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

          // display the code names for (list them) instead of their ids
          $dr = $data['rows'];
          $data['rows'] = $this->_display_code_names($dr);          
  //print_r($data); die();

        }else{ // presumed "v" View - only two choices at this point
// believe in this case also have to return to manage since deleted the record cant return to single rec view
// echo('Just deleted from the view page'); die();
// same code as above - placeholder for another future situation

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/manage"; //location of view file
          $data['contentheader']  = "Manage Contacts";               
          $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file

          // query for all rows not marked deleted
          $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

          // display the code names for (list them) instead of their ids
          $dr = $data['rows'];
          $data['rows'] = $this->_display_code_names($dr);

        }
      } // End task del - soft delete

      if ($task == 'del'){

        $this->module('eventlog');
        $this->eventlog->logevent('People-Contacts-Del', 'ran','contacts', 'del');

        //Find and mark record as deleted
        // Get an array of the record data to be updated
        $recdata = $this->_contacts_fetch_data_from_db($recid);
       // $recid = ['id'];
        $recdata['status'] = 9;

      //  unset($recdata['frmpg']); // frmpg not in the DB and will cause an error
        unset($recdata['recid']); // don't want to change the record id

   //  print_r($recid);       
   // print_r($recdata); die();
 
        $data['updated_by'] = $_SESSION['user_id'];
        $data['updated_at'] = TIME();            

        $this->model->update($recid, $recdata, 'contacts');
          
      
// echo('Update Saved!'); die();
        // Set flash data
        $flash_msg = 'The contact was successfully deleted';
        set_flashdata($flash_msg);
        $data['alerttype'] = "success"; // success, error, info, block

        // Return to the page that called the delete
        if ($frmpg == 'm'){ // return to manage

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/manage"; //location of view file
          $data['contentheader']  = "Manage Contacts";               
          $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file

          // query for all rows not marked deleted
          //get_where_custom($column, $value, $operator='=', $order_by='id', $target_tbl=NULL, $limit=NULL, $offset=NULL)
          $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

          // display the code names for (list them) instead of their ids
         // $dr = $data['rows'];
        //  $data['rows'] = $this->_display_code_names($dr); // wipes out the data array from above

  //print_r($data); die();

        }else{ // presumed "v" View - only two choices at this point
// believe in this case also have to return to manage since deleted the record cant return to single rec view
// echo('Just deleted from the view page'); die();
// same code as above - placeholder for another future situation

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/manage"; //location of view file
          $data['contentheader']  = "Manage Contacts";               
          $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file

          // query for all rows not marked deleted
          $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

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

    //    echo 'made it!'; print_r($recid); die();
        $recdata = $this->_contacts_fetch_data_from_db($recid);

        // get the addresses
        // get the address types and ids
    //    $addrsntypes = $this->model->get_where_custom('contact_id',$recid,'=','id','contact_address');
   // print_r($addrsntypes); die();
   // print_r(session_id()); die();

    // load the 4 addresses into the data array
    $addrdata = $this->_contacts_fetch_address_data_from_db($recid);
    $data = array_merge($addrdata,$data);

  //    print_r($addrtype1); die(); 
    //$data = array_merge($addrtype1,$data,);

  //  print_r($data); die();
 
        $dr = $recdata;
        // $data will be passed back with numeric codes replaced by the code names in the data array sent to the view page
        $recdata = $this->_display_code_names_for_view($dr);
 // print_r($recdata); die();

        // get the dashboard menu array
       // $data =  $this->assigndshbrd($rid);
        // print_r($data); die();

        // Add record data array to $data array
        $data = array_merge($recdata,$data);
        // print_r($data); die();  

        $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
        $data['contentfile']    = "people/contacts/view"; //location of view file
        $data['contentheader']  = "View Contact";                    
        $data['breadcrumb2']    = "View Contact"; // displayed in the content file   
        $data['recid']          = $recid; // record id to view

        // display the code names instead of the ids
        // Get the topic id
       // $tpc = $data['topic'];
        // get the topic code record object
       // $tp = $this->model->get_where($tpc,'gstopics');
        // replace the topic code with the name
       // $data['topic'] = $tp->title;

        // Get the level id
       // $levl = $data['level'];
        // get the level code  record object
       // $lvl = $this->model->get_where($levl,'gslevels');
        // replace the level code with the name
       // $data['level'] = $lvl->title;	             

     // print_r($data); die();
      } // End task view

      if ($task == 'create'){


//echo('In contacts task=create');
//echo(' Recid: ');        
//echo($recid); die();

        // will be here either editing or adding
        if (is_numeric($recid)){ // updating

          // Get an array of the record data to be edited
          $recdata = $this->_contacts_fetch_data_from_db($recid);
          // print_r($recdata); die();
          // Add record data array to the $data array
          $data = array_merge($recdata,$data);

          // load the 4 addresses into the data array
          $addrdata = $this->_contacts_fetch_address_data_from_db($recid);
          $data = array_merge($addrdata,$data);

          // print_r($data); die();

          // Add code for all dropdowns
          // get all companies object for dropdown
          $data['companies'] = $this->model->get('id','companies');
 //  print_r($data['companies']); die();

   // get company id from contact_company for this contact

        $params['recid'] = $recid;
        $sql = 'SELECT
        contact_company.company_id                 
        FROM contact_company WHERE contact_company.contact_id = :recid';
        $compidobj = $this->model->query_bind($sql, $params, 'object');
   // print_r($compidobj); die();

        $compidarrayobj = $compidobj[0];
        $comp_id = $compidarrayobj->company_id;        
        $compinfo = $this->model->get_one_where('id', $comp_id, 'companies');
        $data['companyinfo'] = $compinfo;
        $data['company_id'] = $compinfo->id;
  //print_r($data['companyinfo']); die();
  // print_r($data['company_id']); die();
          // get contact types object for dropdown - you can show $row->title but save $row->id
          $data['contdpdwn'] = $this->model->get('id','contacttypes');

          // get leadsource object for dropdown - you can show $row->title but save $row->id
          $data['lsdpdwn'] = $this->model->get('id','leadsources');
  // print_r($data['lsdpdwn']); die();
          // get organizations object for dropdown - you can show $row->title but save $row->id
          $data['orgdpdwn'] = $this->model->get('id','companies');
  // print_r($data['orgdpdwn']); die();
          // get donor levels object for dropdown - you can show $row->title but save $row->id
          $data['dldpdwn'] = $this->model->get('id','donorlevels');

          // Add content parameters to the data array
          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/create"; //location of view file
          $data['contentheader']  = "Update Contact";                  
          $data['breadcrumb2']    = "-Contacts-Update"; // displayed in the content file   
          $data['recid']          = $recid; // record id to update
          $data['frmpg']          = $frmpg;    
        
        //  print_r($data); die();

        }else{ // adding

          // Add code for all dropdowns
          // get leadsource object for dropdown - you can show $row->title but save $row->id
          $data['lsdpdwn'] = $this->model->get('id','leadsources');

          // get contact types object for dropdown - you can show $row->title but save $row->id
          $data['contdpdwn'] = $this->model->get('id','contacttypes');

          // get donor levels object for dropdown - you can show $row->title but save $row->id
          $data['dldpdwn'] = $this->model->get('id','donorlevels');

          $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
          $data['contentfile']    = "people/contacts/create"; //location of view file
          $data['contentheader']  = "Create Contacts";                  
          $data['breadcrumb2']    = "-Contacts-New"; // displayed in the content file   
          $data['frmpg']          = $frmpg;
         // print_r($data); die();

        }
      } // End task create

      if ($task == 'submit'){

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {
//echo('In contacts task=submit');

        /* Field validations */

        // Check to see if any dropdowns are still Please select... and set to "" so they fail
        $gndr = $_POST['gender'];
        if($gndr == "Please select..."){
          $_POST['gender'] = "";
        }
// print_r($_POST['gender']); die();
print_r($_POST); die();

          // field, field name in error msg, conditions - add a line for each form field
          $this->validation_helper->set_rules('lastname', 'Last Name', 'required|min_length[4]');
          $this->validation_helper->set_rules('gender', 'Gender', 'required');
          
          $this->validation_helper->set_rules('birthdate', 'Birthdate', 'required');

       //  dont work $this->validation_helper->set_rules('gender', 'gender', 'callback_selected_check');

        // validate the form
          $result = $this->validation_helper->run();
          // echo($result); die();  // 1 or 0

          // Grab the posted values in case it fails validation and you have to prepopulate the form
          $data2 = $this->_contacts_fetch_data_from_post();
          $frmpg = $data2['frmpg'];
          $update_id = $data2['recid'];

// print_r($data2); die();
//echo(' Update_id: ');        
//print_r($update_id); die();

          // if passes validation:
          if ($result == 1) {

            // Get the data posted from the form, both adding or updating
            $data = $this->_contacts_fetch_data_from_post();
// print_r($data) ; die();
             // Get frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.

             $frmpg = $data['frmpg'];

            // need to determine if adding new or editing existing record
            // if there is a record id then must be editing, if not, we are adding
            $update_id = $data['recid'];
// print_r($data['recid']); die();  // should be blank page when adding
// print_r($data); die();

            if (is_numeric($update_id)){ // or if () - updating  or $update_id > 0
             //  echo('Updating!'); die();              
             //  print_r($data); die();
//print_r($frmpg); die();

// *************************************      
              // doesnt like these fields to be null/blank for some unexplained reason

              $data['poc'] = 0;
              $data['contacttype'] = 0;
              $data['status'] = 0;
              $data['accountid'] = 0;
//              $data['orgid'] = 0;
              $data['shopcustomer'] = 0;
              $data['level'] = 0;
              $data['vip'] = 0;          
// *************************************
// Copy the full $data array to $addressdata then eliminate the contact data

              $addressdata = $data;
              $addressdata['contactId'] = $data['recid']; // for contact_address join table

              unset($addressdata['donor']);
              unset($addressdata['level']);
              unset($addressdata['vip']);
              unset($addressdata['shopcustomer']);
              unset($addressdata['suffix']);
              unset($addressdata['middlename']);
              unset($addressdata['gender']);
              unset($addressdata['notes']);
              unset($addressdata['poc']);
              unset($addressdata['photo']);
              unset($addressdata['phoneother']);
              unset($addressdata['assistant']);
              unset($addressdata['assistantemail']);
              unset($addressdata['assistantphone']);
              unset($addressdata['leadsource']);
              unset($addressdata['birthdate']);
              unset($addressdata['status']);
              unset($addressdata['accountid']);
              unset($addressdata['orgid']);
              unset($addressdata['salutation']);
              unset($addressdata['firstname']);
              unset($addressdata['lastname']);
              unset($addressdata['email']);
              unset($addressdata['phone']);
              unset($addressdata['mobile']);
              unset($addressdata['title']);
              unset($addressdata['department']);
              unset($addressdata['fax']);
              unset($addressdata['reportsto']); // used for full name field because js concactenates fn & ln
              unset($addressdata['contacttype']);
              unset($addressdata['website']);
              unset($addressdata['secondaryemail']);
              unset($addressdata['donotcall']);
              unset($addressdata['emailoptout']);
              unset($addressdata['imagename']);
              unset($addressdata['frmpg']); // frmpg not in the DB and will cause an error
              unset($addressdata['recid']); // already captured as contactId above

           //   print_r($addressdata); die();

// *************************************
// Now unset the address data from the contacts array

              unset($data['typeId']);
              unset($data['shipName']);
              unset($data['shipPhone']);
              unset($data['address1']);
              unset($data['address2']);
              unset($data['district']);
              unset($data['county']);
              unset($data['city']);
              unset($data['state']);
              unset($data['country']);
              unset($data['zip']);
              unset($data['fullAddress']);
              unset($data['comment']);

              unset($data['frmpg']); // frmpg not in the DB and will cause an error
              unset($data['recid']); // don't want to change the record id & would fail since no recid field, only id
// *************************************       

              // Convert datepicker to Unix timestamps
              $dptots = $data['birthdate'];
              $this->module('timedate');
              $data['birthdate'] = $this->timedate->make_timestamp_from_datepicker_us($dptots);
 
              $data['created_by'] = $_SESSION['user_id'];
              $data['created_at'] = TIME();
// *************************************
echo('About to save Update ');  
print_r($data); die();

              $this->model->update($update_id, $data, 'contacts');
 //             $this->model->update($update_id, $addressdata, 'addresses');
 // echo('Update Saved!'); die();

              // Prepare flash message
              $flash_msg = 'The contact was successfully updated';
              set_flashdata($flash_msg);
              $data['alerttype'] = "success"; // success, error, info, block

              // Return to the page you launched the updating from

              if ($frmpg == 'm'){

                // Assign Dashboard again - data got wiped out for the record insert above
               // $data =  $this->assigndshbrd($rid);

                // Setup for manage courses (copied from above)
                $data['contentfile']    = "people/contacts/manage"; //location of view file
                $data['contentheader']  = "Manage Contacts";               
                $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file
                print_r('stop'); die();
                // query for all records - get('order_by', 'table', limit, offset)
                $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

                // display the code names for (list them) instead of their ids

                // this wipes out the query all for manage - BROKEN!!
                // Pass a copy of the $data array to the display code names function when displaying the records
                $dr = $data['rows'];
                // $data will be passed back with numeric codes replaced by the code names in the data array sent to the view page
                $data['rows'] = $this->_display_code_names($dr);
//print_r($data); die();
              
              } else { // Must be coming from view record $frmpg = 'v' since currently only two options

                // echo('Coming from view page after saving update'); die();
                // echo($update_id); die();

                // Get an array of the record data to be shown after changes saved to DB
                $recdata = $this->_contacts_fetch_data_from_db($update_id);
                //  print_r($recdata); die();

                // Add record data array to the $data array
                $data = array_merge($recdata,$data);
                // print_r($data); die();  

                $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
                $data['contentfile']    = "people/contacts/view"; //location of view file
                $data['contentheader']  = "View Contact";                    
                $data['breadcrumb2']    = "View Contact"; // displayed in the content file   
                $data['recid']          = $update_id; // record id to view

                // display the code names instead of the ids
                // Get the topic id
               // $tpc = $data['topic'];
                // get the topic code record object
              //  $tp = $this->model->get_where($tpc,'gstopics');
                // replace the topic code with the name
              //  $data['topic'] = $tp->title;

                // Get the level id
              //  $levl = $data['level'];
                // get the level code  record object
             //   $lvl = $this->model->get_where($levl,'gslevels');
                // replace the level code with the name
             //   $data['level'] = $lvl->title;	
                // print_r($data); die(); 

              }

            } else { //adding
          //   echo('Adding!');             
          //     print_r($data); die();

             // Get frmpg from the posted data array to determine where to return to.
             // When you come from hrefs you can pass parameters in URL & extract using segments.
             // When you come from forms you must use hidden fields & extract from the posted values.
// *************************************      
              // doesnt like these fields to be null/blank for some unexplained reason

              $data['poc'] = 0;
              $data['contacttype'] = 0;
              $data['status'] = 0;
              $data['accountid'] = 0;
//              $data['orgid'] = 0;
              $data['shopcustomer'] = 0;
              $data['level'] = 0;
              $data['vip'] = 0;          
// *************************************
// Copy the full $data array to $addressdata then eliminate the contact data

              $addressdata = $data;
              $addressdata['contactId'] = $data['recid']; // for contact_address join table

              unset($addressdata['donor']);
              unset($addressdata['level']);
              unset($addressdata['vip']);
              unset($addressdata['shopcustomer']);
              unset($addressdata['suffix']);
              unset($addressdata['middlename']);
              unset($addressdata['gender']);
              unset($addressdata['notes']);
              unset($addressdata['poc']);
              unset($addressdata['photo']);
              unset($addressdata['phoneother']);
              unset($addressdata['assistant']);
              unset($addressdata['assistantemail']);
              unset($addressdata['assistantphone']);
              unset($addressdata['leadsource']);
              unset($addressdata['birthdate']);
              unset($addressdata['status']);
              unset($addressdata['accountid']);
              unset($addressdata['orgid']);
              unset($addressdata['salutation']);
              unset($addressdata['firstname']);
              unset($addressdata['lastname']);
              unset($addressdata['email']);
              unset($addressdata['phone']);
              unset($addressdata['mobile']);
              unset($addressdata['title']);
              unset($addressdata['department']);
              unset($addressdata['fax']);
              unset($addressdata['reportsto']); // used for full name field because js concactenates fn & ln
              unset($addressdata['contacttype']);
              unset($addressdata['website']);
              unset($addressdata['secondaryemail']);
              unset($addressdata['donotcall']);
              unset($addressdata['emailoptout']);
              unset($addressdata['imagename']);
              unset($addressdata['frmpg']); // frmpg not in the DB and will cause an error
              unset($addressdata['recid']); // already captured as contactId above

           //   print_r($addressdata); die();

// *************************************
              // Now unset the address data from the contacts array
              // but first grab the typeId for the contact_address join table
              $joindata['typeId'] = $data['typeId'];
   
              unset($data['typeId']);
              unset($data['shipName']);
              unset($data['shipPhone']);
              unset($data['address1']);
              unset($data['address2']);
              unset($data['district']);
              unset($data['county']);
              unset($data['city']);
              unset($data['state']);
              unset($data['country']);
              unset($data['zip']);
              unset($data['fullAddress']);
              unset($data['comment']);

              unset($data['frmpg']); // frmpg not in the DB and will cause an error
              unset($data['recid']); // don't want to change the record id & would fail since no recid field, only id
// *************************************   
              
               
//echo('Adding!');
// print_r($data); die();

              // Convert datepicker to Unix timestamps
              $dptots = $data['birthdate'];
              $this->module('timedate');
              $data['birthdate'] = $this->timedate->make_timestamp_from_datepicker_us($dptots);
 
              $data['created_by'] = $_SESSION['user_id'];
              $data['created_at'] = TIME();
    
// print_r($data);

              //insert the new contact record            
              $new_id = $this->model->insert($data, 'contacts');
              $addressdata['contactId'] = $new_id;
// print_r($addressdata); die();
              //insert the new address record            
              $new_addr_id = $this->model->insert($addressdata, 'addresses');
              
// echo('New record added!'); print_r($new_id); print_r($new_addr_id); die();   

              //
              $joindata['contactId'] = $new_id;              
              $joindata['addressId'] = $new_addr_id;

              //insert the new contact_address record            
              $new_join_id = $this->model->insert($joindata, 'contact_address');

              // Prepare flash message
              $flash_msg = 'The contact was successfully created';
              set_flashdata($flash_msg);
              $data['alerttype'] = "success"; // success, error, info, block

              // Return to the page you launched the adding from

              if ($frmpg = 'm'){

                // Setup for manage courses (copied from above)
                $data['contentfile']    = "people/contacts/manage"; //location of view file
                $data['contentheader']  = "Manage Contacts";               
                $data['breadcrumb2']    = "Manage Contacts"; // displayed in the content file

                // query for all records - get('order_by', 'table', limit, offset)
                $data['rows'] = $this->model->get_where_custom('status',9,'!=','id','contacts');

                // display the code names for (list them) instead of their ids - broken
             //   $dr = $data['rows'];
            //    $data['rows'] = $this->_display_code_names($dr);

              } else { // Must be coming from view record $frmpg = 'v' since currently only two options
                       // Currently no ADD button on the view page, only UPDATE
              }

            } // end isnumeric

          } else { // failed validation

              // Prepare flash message
              $flash_msg = 'The record failed validation';
              set_flashdata($flash_msg);
              $data['alerttype'] = "error"; // success, error, info, block

              // Add the posted values ($data2) to the dashboard menus
              $data = array_merge($data,$data2);

              if (is_numeric($update_id)){ // failed updating

              // Prepare flash message
              $flash_msg = 'The record failed validation';
              set_flashdata($flash_msg);
              $data['alerttype'] = "error"; // success, error, info, block

              // Add content parameters to the data array
              $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
              $data['contentfile']    = "people/contacts/create"; //location of view file
              $data['contentheader']  = "Failed Validation - Update Contact";                  
              $data['breadcrumb2']    = "-Contacts-Update"; // displayed in the content file   
              $data['recid']          = $update_id; // record id to update
              $data['frmpg']          = $frmpg;  

              //print_r(validation_errors()); die();
              //print_r($data); die();

              }else{ // failed adding

              // Prepare flash message
              $flash_msg = 'The record failed validation';
              set_flashdata($flash_msg);
              $data['alerttype'] = "error"; // success, error, info, block

              // Add content parameters to the data array
              $data['task'] = $task; // can be used to control which buttons shown & cancel redirects (add vs update)
              $data['contentfile']    = "people/contacts/create"; //location of view file
              $data['contentheader']  = "Failed Validation - Contacts";                  
              $data['breadcrumb2']    = "-Contacts-New"; // displayed in the content file   
              $data['frmpg']          = $frmpg;

              }

          } // end result (validation)
        }
      }else{ // this should run only first time when page is drawn and then continue execution below
             // fetching data either from post or database. When return it will be a submit and this
             // code will not run again because it will pass validation and be saved or not and cancelled. 
      } // End task submit


// print_r($data); die();
return $data; // back to parent dashboards module
 
if ($task == 'makepdf'){ // 
  $this->makepdf();


}

if ($task == 'makexls'){ // 
$this->makexls();


}

if ($task == 'encrypt'){ // just for testing the function
$str = 'Hello World';
$strkey = $_SESSION['strkey']; 
$key = hex2bin($strkey); 
//echo($key); die();
$encoded = $this->_encrypt_string($str, $key);
echo($encoded); die();
}

if ($task == 'decrypt'){ // just for testing the function
//  $encoded = 'hofyGi0bepItTAVP/njqHWo5h+WPDUBNwwysoyXkuyvGmeGaEZFRvBJuNH34YKQTEpYN';  // Hello World
$encoded = 'Qh6wAy72hQ8cPi+gJeHJob98lh2Y0mzIjomYhXGyG9AHJV8qor/HxulcUDI=';  // Eric
$strkey = 'de784089138620d5110588dc1fb7bd4411bf8298a405ed7c735d2a69492da8c8'; 
$key = hex2bin($strkey); // �x@�� �����D�����|s]*iI-��
//print_r($key); die();
$decoded = $this->_decrypt_encoded($encoded, $key);
echo($decoded); die();
}   

      }// End task()

     function _contacts_fetch_data_from_post() {

// fields prefixed with  were added to the vtiger tablestructure
// For contacts table

$data['recid']              = $this->input('recid', true); // if editing this is the id from the contact table
$data['donor']              = $this->input('donor', true);
$data['level']              = $this->input('level', true);
$data['vip']                = $this->input('vip', true);
$data['shopcustomer']       = $this->input('shopcustomer', true);
$data['suffix']             = $this->input('suffix', true);
$data['middlename']         = $this->input('middlename', true);
$data['gender']             = $this->input('gender', true);
$data['notes']              = $this->input('notes', true);
$data['poc']                = $this->input('poc', true);
$data['photo']              = $this->input('photo', true);
$data['phoneother']         = $this->input('phoneother', true);
$data['assistant']          = $this->input('assistant', true);
$data['assistantemail']     = $this->input('assistantemail', true);
$data['assistantphone']     = $this->input('assistantphone', true);
$data['leadsource']         = $this->input('leadsource', true);
$data['birthdate']          = $this->input('birthdate', true);
$data['status']                 = $this->input('status', true);
$data['frmpg']                  = $this->input('frmpg', true); // for navigation but not stored in DB

$data['accountid']              = $this->input('accountid', true);
$data['orgid']                  = $this->input('orgid', true);
$data['salutation']             = $this->input('salutation', true);
$data['firstname']              = $this->input('firstname', true);
$data['lastname']               = $this->input('lastname', true);
$data['email']                  = $this->input('email', true);
$data['phone']                  = $this->input('phone', true);
$data['mobile']                 = $this->input('mobile', true);
$data['title']                  = $this->input('title', true);
$data['department']             = $this->input('department', true);
$data['fax']                    = $this->input('fax', true);
$data['reportsto']              = $this->input('reportsto', true); // used for full name field because js concactenates fn & ln
$data['contacttype']            = $this->input('contacttype', true);
$data['website']             = $this->input('website', true);
$data['secondaryemail']         = $this->input('secondaryemail', true);
$data['donotcall']              = $this->input('donotcall', true);
$data['emailoptout']            = $this->input('emailoptout', true);
$data['imagename']              = $this->input('imagename', true);

// for addresses table

$data['typeId']                 = $this->input('typeId', true);
$data['shipName']               = $this->input('shipName', true);
$data['shipPhone']              = $this->input('shipPhone', true);
$data['address1']               = $this->input('address1', true);
$data['address2']               = $this->input('address2', true);
$data['district']               = $this->input('district', true);
$data['county']                 = $this->input('county', true);
$data['city']                   = $this->input('city', true);
$data['state']                  = $this->input('state', true);
$data['country']                = $this->input('country', true);
$data['zip']                    = $this->input('zip', true);
$data['fullAddress']            = $this->input('fullAddress', true);
$data['comment']                = $this->input('comment', true);

return $data;

   }

   function _contacts_fetch_data_from_db($update_id) {
// echo('Made it to fetch data from db'); die();       
//$strkey = 'de784089138620d5110588dc1fb7bd4411bf8298a405ed7c735d2a69492da8c8'; 
//$key = hex2bin($strkey); // �x@�� �����D�����|s]*iI-��
//$key = $_SESSION['key'];

      // query for single record - ('order_by', 'table', limit, offset)
      $updrec = $this->model->get_where($update_id,'contacts');
      $upaddr1 =
      $upaddr2 = 
      $upaddr3 = 
      $upaddr4 =  

// print_r($updrec); die();

    // load values in the recdata array from the record object
    $recdata['id']                 = $updrec->id;
    $recdata['orgid']              = $updrec->orgid;    
    $recdata['donor']              = $updrec->donor;
    $recdata['level']              = $updrec->level;
    $recdata['vip']                = $updrec->vip;
    $recdata['shopcustomer']       = $updrec->shopcustomer;    
    $recdata['suffix']             = $updrec->suffix;
    $recdata['middlename']         = $updrec->middlename;
    $recdata['gender']             = $updrec->gender;
    $recdata['notes']              = $updrec->notes;
    $recdata['poc']                = $updrec->poc;
    $recdata['photo']              = $updrec->photo;
    $recdata['phoneother']         = $updrec->phoneother;
    $recdata['assistant']          = $updrec->assistant;
    $recdata['assistantphone']     = $updrec->assistantphone;
    $recdata['assistantemail']     = $updrec->assistantemail;
    $recdata['leadsource']         = $updrec->leadsource;

    $recdata['birthdate']          = $updrec->birthdate;
    $tstodp = $recdata['birthdate'];
    //echo('Made it!');
//print_r($tstodp); die();

    $this->module('timedate');
    $recdata['birthdate'] = $this->timedate->get_nice_date($tstodp, 'datepicker_us'); 
//print_r($recdata['birthdate'] ); die();

    $recdata['status']                 = $updrec->status;
    $recdata['accountid']              = $updrec->accountid;  // billing
    $recdata['orgid']                  = $updrec->orgid;      // belonging
    $recdata['salutation']             = $updrec->salutation;

    $recdata['firstname']              = $updrec->firstname;
//    $enc = $recdata['firstname']; 
//    print_r($enc ); die();
//    $recdata['firstname'] = $this->_decrypt_encoded($enc, $key);
//    $recdata['firstname'] = $this->_encrypt_string($enc, $key);
//print_r($recdata['firstname'] ); die();

    $recdata['lastname']               = $updrec->lastname;
    $recdata['email']                  = $updrec->email;
    $recdata['phone']                  = $updrec->phone;
    $recdata['mobile']                 = $updrec->mobile;
    $recdata['title']                  = $updrec->title;
    $recdata['department']             = $updrec->department;
    $recdata['fax']                    = $updrec->fax;
    $recdata['reportsto']              = $updrec->reportsto;
    $recdata['contacttype']            = $updrec->contacttype;
    $recdata['website']             = $updrec->website;
    $recdata['secondaryemail']         = $updrec->secondaryemail;
    $recdata['donotcall']              = $updrec->donotcall;
    $recdata['emailoptout']            = $updrec->emailoptout;
    $recdata['imagename']              = $updrec->imagename;

    // from addresses table - take some thought
    //$addrrec = $this->model->get_where($update_id,'contact_address');

    //$recdata['typeId']                 = $addrrec->typeId;
   // $recdata['shipName']               = $addrrec->shipName;
   // $recdata['shipPhone']              = $addrrec->shipPhone;
   // $recdata['address1']               = $addrrec->address1;
   // $recdata['address2']               = $addrrec->address2;
   // $recdata['district']               = $addrrec->district;
   // $recdata['county']                 = $addrrec->county;
   // $recdata['city']                   = $addrrec->city;
   // $recdata['state']                  = $addrrec->state;
   // $recdata['country']                = $addrrec->country;
   // $recdata['zip']                    = $addrrec->zip;
   // $recdata['fullAddress']            = $addrrec->fullAddress;
   // $recdata['comment']                = $addrrec->comment;

   // print_r($data['title']); die();

    // if no record was found
    if(!isset($recdata)){
      $recdata = "";
    }
         
    // print_r($data); die();
    // Return the array
    return $recdata;
 } 
 
    function _contacts_fetch_address_data_from_db($recid = NULL){
// echo('Made it!'); die();
    // get the record id (should be already set and not needed to  be passed, was passed from Dashboards.php)
    $params['recid'] = $recid;

    // get address type 1 for this contact
    $sql1 = 'SELECT
    contact_address.id                 
    FROM contact_address WHERE contact_address.contact_id = :recid AND contact_address.address_type = 1';

    // get address type 2 for this contact
    $sql2 = 'SELECT
    contact_address.id                 
    FROM contact_address WHERE contact_address.contact_id = :recid AND contact_address.address_type = 2';

    // get address type 3 for this contact
    $sql3 = 'SELECT
    contact_address.id                 
    FROM contact_address WHERE contact_address.contact_id = :recid AND contact_address.address_type = 3';

    // get address type 4 for this contact
    $sql4 = 'SELECT
    contact_address.id                 
    FROM contact_address WHERE contact_address.contact_id = :recid AND contact_address.address_type = 4';


    $addrtype1obj = $this->model->query_bind($sql1, $params, 'object');
    $addrtype2obj = $this->model->query_bind($sql2, $params, 'object');
    $addrtype3obj = $this->model->query_bind($sql3, $params, 'object');
    $addrtype4obj = $this->model->query_bind($sql4, $params, 'object');

  // print_r($addrtype1obj); die();

    $addrtype1arrayobj = $addrtype1obj[0];
    $addrtype2arrayobj = $addrtype2obj[0];
    $addrtype3arrayobj = $addrtype3obj[0];
    $addrtype4arrayobj = $addrtype5obj[0];
  //  print_r($addrtype1arrayobj); die();

    $addrtype1_id = $addrtype1arrayobj->id;
    $addrtype2_id = $addrtype2arrayobj->id;
    $addrtype3_id = $addrtype3arrayobj->id;
    $addrtype4_id = $addrtype4arrayobj->id;
  // print_r($addrtype1_id); die();

    // get the address for this contacts address type 1
    $addrtype1 = $this->model->get_one_where('id', $addrtype1_id, 'addresses');
    $addrtype2 = $this->model->get_one_where('id', $addrtype2_id, 'addresses'); 
    $addrtype3 = $this->model->get_one_where('id', $addrtype3_id, 'addresses'); 
    $addrtype4 = $this->model->get_one_where('id', $addrtype4_id, 'addresses');  
  // print_r($addrtype1); die();

    $addrdata['addrtype1'] = $addrtype1;
    $addrdata['addrtype2'] = $addrtype2;
    $addrdata['addrtype3'] = $addrtype3;
    $addrdata['addrtype4'] = $addrtype4;

 //print_r($addrdata); die();
      return $addrdata;

    }

    function _display_code_names($dr){
      $data['rows'] = $dr;
      // display the code name instead of it's id
      foreach($data['rows'] as $row) { 
        // get the leadsource title
          $lsid = $row->leadsource;
        // get the leadsource record object for that id
          $lsrec = $this->model->get_where($lsid,'leadsources'); // object
          // replace the leadsource  id with the title from the record object
          $row->leadsource = $lsrec->title;

          // ??? need to replace this with contacttype
          // get the org title
          //$orid = $row->orgid;
          // get the org record object for that id
          //$orgrec = $this->model->get_where($orid,'companies'); // object
          // replace the org  id with the title from the record object
          //$row->orgid = $orgrec->code;

          // get the donor level title
          $dlid = $row->level;
          // get the donor level record object for that id
          $dlrec = $this->model->get_where($dlid,'donorlevels'); // object
          // replace the donor level id with the title from the record object
          $row->level = $dlrec->title;

          // get the donor flag value
          $donor = $row->donor;
          if ($donor == 1){
            $row->donor = 'Yes';
          }else{
            $row->donor = 'No';
          }

        }
      // return the data array with the code values changed to code names  
      return $data['rows'];
    }

    function _display_code_names_for_view($dr){
  

      // display the code name instead of it's id

        // get the values to be translated
          $lsid     = $dr['leadsource'];
          $orgid    = $dr['orgid'];
          $dlid     = $dr['level'];
          $donor    = $dr['donor'];
          $lsid     = $dr['leadsource'];
          $orgid    = $dr['orgid'];
          $dlid     = $dr['level'];
          $vip      = $dr['vip'];
          $shopcust = $dr['shopcust'];
          $dnc      = $dr['donotcall'];
          $eoptout  = $dr['emailoptout'];        

          if($lsid == 0){
            $lsid = 1;
          }
        // get the leadsource record object for that id
          $lsrec = $this->model->get_where($lsid,'leadsources'); // object
          // replace the leadsource  id with the title from the record object
          $dr['leadsource'] = $lsrec->title;
//print_r($dr['leadsource']); die();


          if ($orgid == 0){
            $dr['orgid'] = 'na';
          }else{
          // get the organization record object for that id
          $orgrec = $this->model->get_where($orgid,'organizations'); // object
          // replace the organization  id with the title from the record object
          $dr['orgid'] = $orgrec->code;
          }

          if ($dlid == 0){
            $dr['level'] = 'na';
          }else{
          // get the level record object for that id
          $dlrec = $this->model->get_where($dlid,'donorlevels'); // object
          // replace the level  id with the title from the record object
          $dr['level'] = $dlrec->title;
          }

          // get the donor flag value
          if ($donor == 1){
            $dr['donor'] = 'Yes';
          }else{
            $dr['donor'] = 'No';
          }

          // get the VIP flag value
          if ($vip == 1){
            $dr['vip'] = 'Yes';
          }else{
            $dr['vip'] = 'No';
          }

          // get the Shop Customer flag value
          if ($shopcust == 1){
            $dr['shopcustomer'] = 'Yes';
          }else{
            $dr['shopcustomer'] = 'No';
          }

          // get the donotcall flag value
          if ($dnc == 1){
            $dr['donotcall'] = 'Yes';
          }else{
            $dr['donotcall'] = 'No';
          }

          // get the email opt out flag value
          if ($eoptout == 1){
            $dr['emailoptout'] = 'Yes';
          }else{
            $dr['emailoptout'] = 'No';
          }

          // get the mailing list flag value
          if ($eoptout == 1){
            $dr['emailoptout'] = 'Yes';
          }else{
            $dr['emailoptout'] = 'No';
          }          
//print_r($dr); die();  

      // return the data array with the code values changed to code names  
      return $dr;
    }

    public function _encrypt_string($str, $key) // php 7.2+  SODIUM
    {
      //echo('Made it!'); die();

      // this is what I used one time to create the permanent $strkey
      //$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
      //$strkey = bin2hex($key);
      //print_r($strkey); die();

      // lets see what was passed
     // print($str);
     // print($key); die();

      $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      //print_r($nonce);
      $ciphertext = sodium_crypto_secretbox($str, $nonce, $key);
      //print_r($ciphertext);
      // store the nonce with encrypted text, will separate out on the decrypt
      $encoded = base64_encode($nonce . $ciphertext);
      print_r($encoded); die();

      return $encoded;

    }

    public function _decrypt_encoded($encoded, $key)
    {
      //echo('Made it!'); die();
  //   $strkey = 'de784089138620d5110588dc1fb7bd4411bf8298a405ed7c735d2a69492da8c8'; 
  //   $key = hex2bin($strkey); // �x@�� �����D�����|s]*iI-��
  //    print($encoded);
  //    print_r(' : ');
  //    print_r($key);
  //    print_r(' : ');
      $decoded = base64_decode($encoded);
  //    print_r(' : ');
  //    print_r($decoded);
  //    print_r(' : ');     
      $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
  //    print_r($nonce);
  //    print_r(' : ');
      $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
  //    print_r($ciphertext);
  //    print_r(' : ');      
      $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
  //    print_r($plaintext); die();

      return $plaintext;

    }

    function makepdf(){
      // print contacts
    require('fpdf182/fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    
    // define new alias for total page numbers
    $pdf->AliasNbPages('{pages}');
    
    $pdf->SetAutoPageBreak(true,15);
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',9);
    $pdf->SetDrawColor(50,50,100);
    
    $query = $this->model->get('id','contacts');
    
    // convert object to array
    //$query = json_decode(json_encode($query), true);
    // only puts the objects into an array: $query = array($query);
    //print_r($query); die();
    
    $pdf->Cell(50,5,'Name','C',0);
    
    $pdf->Cell(10,5,'Org','C',1);
    
    foreach($query as $row) { 
      //print_r($row->firstname);
    // Convert ids to codes
    // get the org title
    $orid = $row->orgid;
    // get the org record object for that id
    $orgrec = $this->model->get_where($orid,'organizations'); // object
    // replace the org  id with the title from the record object
    $row->orgid = $orgrec->code;
    
    if($pdf->GetStringWidth($row->salutation)+$pdf->GetStringWidth($row->firstname)+$pdf->GetStringWidth($row->middlename)+$pdf->GetStringWidth($row->lastname)+$pdf->GetStringWidth($row->suffix) >49){
      $pdf->SetFont('Arial','',7);
      if($pdf->GetStringWidth($row->salutation)>0 AND $pdf->GetStringWidth($row->suffix)>0 ){
        $pdf->Cell(50,5,$row->salutation.' '.$row->firstname.' '.$row->middlename.' '.$row->lastname.', '.$row->suffix,'LR',0);
      }
      if($pdf->GetStringWidth($row->salutation)>0 AND $pdf->GetStringWidth($row->suffix)==0 ){
        $pdf->Cell(50,5,$row->salutation.' '.$row->firstname.' '.$row->middlename.' '.$row->lastname,'LR',0);
      }
      if($pdf->GetStringWidth($row->salutation)==0 AND $pdf->GetStringWidth($row->suffix)>0 ){
        $pdf->Cell(50,5,$row->firstname.' '.$row->middlename.' '.$row->lastname.', '.$row->suffix,'LR',0);
      }
      if($pdf->GetStringWidth($row->salutation)==0 AND $pdf->GetStringWidth($row->suffix)==0 ){
        $pdf->Cell(50,5,$row->firstname.' '.$row->middlename.' '.$row->lastname,'LR',0);
      }
      $pdf->SetFont('Arial','',9);  
    //  echo('>10'); die();
    }else{
    
    if($pdf->GetStringWidth($row->salutation)>0 AND $pdf->GetStringWidth($row->suffix)>0 ){
      $pdf->Cell(50,5,$row->salutation.' '.$row->firstname.' '.$row->middlename.' '.$row->lastname.', '.$row->suffix,'LR',0);
    }
    if($pdf->GetStringWidth($row->salutation)>0 AND $pdf->GetStringWidth($row->suffix)==0 ){
      $pdf->Cell(50,5,$row->salutation.' '.$row->firstname.' '.$row->middlename.' '.$row->lastname,'LR',0);
    }
    if($pdf->GetStringWidth($row->salutation)==0 AND $pdf->GetStringWidth($row->suffix)>0 ){
      $pdf->Cell(50,5,$row->firstname.' '.$row->middlename.' '.$row->lastname.', '.$row->suffix,'LR',0);
    }
    if($pdf->GetStringWidth($row->salutation)==0 AND $pdf->GetStringWidth($row->suffix)==0 ){
      $pdf->Cell(50,5,$row->firstname.' '.$row->middlename.' '.$row->lastname,'LR',0);
    }
    }
      //$pdf->Cell(25,5,$row->firstname,'LR',0);
      //$pdf->Cell(6,5,$row->firstname,'LR',0);
      //$pdf->Cell(25,5,$row->lastname,'LR',0);
      //$pdf->Cell(10,5,$row->suffix,'LR',0);
      $pdf->Cell(12,5,$row->orgid,'LR',1);
    //  $pdf->Cell(40,5,$row->reportsto,'LR',1);
    }
    // Dummy cell to finish the table
    //$pdf->Cell(190,0,',T',1,'',true);
    
    $pdf->Output(D,'contactlist.pdf');
    echo('done'); die();
    
    }
    
    function org_makepdf(){
      $name = 'Jack';
      require('fpdf182/fpdf.php');
      
      $pdf = new FPDF('P','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',14);
      $pdf->Cell(130,5,'Hello World',1,0);
      // string Output([string dest [, string name [, boolean isUTF8]]])
      $pdf->Output(D,'contact.pdf');
      echo('done'); die();
      
      }
    
    function makexls(){
    
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet()->setTitle('Simple');
      $sheet->setCellValue('A1', 'Hello World !');
      $writer = new Xlsx($spreadsheet);
     //$writer->save('hello world.xlsx');  // saves in the root of public by default (i.e. on server)
    
    
     //or to download
      // We'll be outputting an excel xlsx file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    // It will be called export.xls
    header('Content-Disposition: attachment; filename="export.xlsx"');
    header ('Content-Transfer-Encoding: binary');
    
    $writer->save('php://output');
     
    
      //echo('made it!'); die(); 
     
    
    }
}