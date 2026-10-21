<?php

/*----------------------------------------------------------------------------*/
/*-------------------- module SYSTEM-SUBENTITIES -----------------------------*/
/*----------------------------------------------------------------------------*/

/*
  The Chapters screen (SUBENTITIES): maintains ccmps_subentities. Rebuilt 2026-10-21 on the
  maintenance-table pattern (welcome/ccmpsscopes); the old screen read a system_subentities
  table that no longer exists.

  manage()
        _check_function_permissions('manage')
        _get_font_sizes()
  createsubentity($retrying)
        _check_function_permissions('manage')
        _get_font_sizes()
        _get_lookups()
  updatesubentity($retrying)
        _check_function_permissions('manage')
        _get_a_single_record($recid) anchor1
        _get_lookups()
  subentitysubmit()
        _check_function_permissions('manage')
        _subentities_fetch_data_from_post() anchor2
        _audit()
        manage()
        createsubentity('yes')
        updatesubentity('yes')
  delrecord()
        _check_function_permissions('manage')
        _members_in_subentity($recid)
        _audit()
  _subentities_fetch_data_from_post() anchor2
  _get_a_single_record($recid) anchor1
  _get_lookups()
  _members_in_subentity($recid)
  _home_url()
  _token()
  _audit($action, $recid, $what)
  _check_function_permissions($subentitiesfunction, $recid = NULL)
  _get_font_sizes()
*/

/* ccmps_subentities (one row per chapter; ccmps.subentity = its id):
       id                (auto increment)
       chapter_title     (varchar 125)  short name, required and unique
       description       (varchar 255)  full name
       chartered         (tinyint)      1 = chartered
       active            (tinyint)      1 = a working chapter; 0 = left out of counts (e.g. Place Holder rows)
       region            (int)          ref_region_codes.id
       state             (char 2)       ref_states.state_code - By the Numbers counts the states
       logo, website, facebook, instagram, youtube              (varchar 255)
       chapter_email, financial_email, financial_phone, financial_contact (varchar 255)
       annual_dues       (decimal 7,2)
*/

/*----------------------------------------------------------------------------*/

class Subentities extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'system';
      $this->child_module  = 'subentities';
    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module  = '';
    }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*--------------------- function _GET_A_SINGLE_RECORD ------------------------*/
/*----------------------------------------------------------------------------*/

  function _get_a_single_record($recid) { // anchor1 - called when updating

        $subentity_data = $this->model->get_where($recid, 'ccmps_subentities');

        return $subentity_data; // returns to updatesubentity()
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the subentities manage page

    $subentitiesfunction = 'manage';
    $authorized = $this->_check_function_permissions($subentitiesfunction);

    // Get font size preference for views & manage page
    $this->_get_font_sizes();

    // Get all chapters with their member count, ordered by short name
    $sql = "SELECT s.*, r.title AS region_title,
                   (SELECT COUNT(*) FROM ccmps c WHERE c.subentity = s.id AND COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1) AS members
              FROM ccmps_subentities s
              LEFT JOIN ref_region_codes r ON r.id = s.region
             ORDER BY s.active DESC, s.chapter_title, s.id";
    $data['subentitiesrecs'] = $this->model->query($sql, 'object');

    $data['view_module'] = 'system/subentities';
    $data['view_file']   = 'manage';

// customize form
    $data['entityname']  = SUBENTITY;
    $data['entitynames'] = SUBENTITIES;
    $data['token']       = $this->_token();
    $data['home_url']    = $this->_home_url();

    $data['bc1']      = 'System Admin';
    $data['bc2']      = 'Manage '.$data['entitynames'];
    $data['header']   = 'Manage '.$data['entitynames'];
    $data['activity'] = 'System Administrator';

    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function CREATESUBENTITY ---------------------------*/
/*----------------------------------------------------------------------------*/

function createsubentity($retrying = NULL){ // Adding - may be first time or with values after failed validation

  $subentitiesfunction = 'manage';
  $authorized = $this->_check_function_permissions($subentitiesfunction);

  $retry = $retrying; // for failed validation repost

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

  if($retry == 'yes'){
        $retry = 'no'; // reset
        $data = $this->_subentities_fetch_data_from_post(); // what was posted from the form
  }else{
        $data['chapter_title']     = '';
        $data['description']       = '';
        $data['chartered']         = 0;
        $data['active']            = 1;
        $data['region']            = '';
        $data['state']             = '';
        $data['logo']              = '';
        $data['website']           = '';
        $data['facebook']          = '';
        $data['instagram']         = '';
        $data['youtube']           = '';
        $data['chapter_email']     = '';
        $data['financial_email']   = '';
        $data['financial_phone']   = '';
        $data['financial_contact'] = '';
        $data['annual_dues']       = '';
  }

  $data['id']          = '';
  $data['recid']       = '';
  $data = array_merge($data, $this->_get_lookups());

// customize module path and crud form name
  $data['view_module'] = 'system/subentities';
  $data['view_file']   = 'subentitiescrud'; // use the single-page crud form for creating

// customize form
  $data['entityname']  = SUBENTITY;
  $data['entitynames'] = SUBENTITIES;
  $data['token']       = $this->_token();
  $data['home_url']    = $this->_home_url();

  $data['bc1'] = 'System Admin';
  $data['bc2'] = 'Create New '.$data['entityname'];

  $this->templates->inspinia($data);
}

/*--------------------- End function createsubentity -------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function UPDATESUBENTITY ---------------------------*/
/*----------------------------------------------------------------------------*/

function updatesubentity($retrying = NULL){ // edit form for an existing chapter

  $subentitiesfunction = 'manage';
  $authorized = $this->_check_function_permissions($subentitiesfunction);

  $this->_get_font_sizes();

  $retry = $retrying;
  $recid = (int) segment(3);

  if($retry == 'yes'){
        $retry = 'no'; // reset
        $data = $this->_subentities_fetch_data_from_post(); // what was posted from the form
  }else{
        $record = $this->_get_a_single_record($recid); // anchor1
        if(!$record){
            $_SESSION['flashmsgcolor'] = 0; // crimson
            set_flashdata('That '.SUBENTITY.' was not found.');
            redirect('system-subentities/manage');
        }
        $data = (array) $record;
  }

  $data['id']          = $recid;
  $data['recid']       = $recid;
  $data = array_merge($data, $this->_get_lookups());

// customize module path and crud form name
  $data['view_module'] = 'system/subentities';
  $data['view_file']   = 'subentitiescrud'; // use the single-page crud form for updating

  $data['entityname']  = SUBENTITY;
  $data['entitynames'] = SUBENTITIES;
  $data['token']       = $this->_token();
  $data['home_url']    = $this->_home_url();

  $data['bc1'] = 'System Admin';
  $data['bc2'] = 'Update '.$data['entityname'];

  $this->templates->inspinia($data);

}

/*--------------------- End function updatesubentity -------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function SUBENTITYSUBMIT ---------------------------*/
/*----------------------------------------------------------------------------*/

function subentitysubmit(){ // used by both create & update

  $subentitiesfunction = 'manage';
  $authorized = $this->_check_function_permissions($subentitiesfunction);

  $recid  = (int) segment(3); // if updating there will be a record id, if adding nothing
  $submit = post('submit', true);

  if($submit == 'Submit'){

    if(!hash_equals($this->_token(), (string) post('token'))){
        $_SESSION['flashmsgcolor'] = 0; // crimson
        set_flashdata('The form had expired - please try again.');
        redirect('system-subentities/manage');
    }

    $subentitydata_post = $this->_subentities_fetch_data_from_post(); // anchor2

    $result = 1; // passing validation until proven otherwise
    $_SESSION['flashmsgcolor'] = 0; // crimson for any failure below

    if(strlen($subentitydata_post['chapter_title']) > 0){
        // check for a duplicate short name
        $usr_obj = $this->model->get_one_where('chapter_title', $subentitydata_post['chapter_title'], 'ccmps_subentities');
        $recordfndid = $usr_obj ? $usr_obj->id : 0;

        if($recordfndid > 0 AND $recordfndid != $recid){
            $result = 0; // failed validation
            set_flashdata('That Short Name already exists.');
        }
    }else{
        $result = 0; // failed validation
        set_flashdata('A Short Name is required.');
    }

    if($result > 0 && $subentitydata_post['state'] !== null){
        $state_obj = $this->model->get_one_where('state_code', $subentitydata_post['state'], 'ref_states');
        if(!$state_obj){
            $result = 0;
            set_flashdata('Please choose a State from the list.');
        }
    }

    if($result > 0 && $subentitydata_post['annual_dues'] !== null && !is_numeric($subentitydata_post['annual_dues'])){
        $result = 0;
        set_flashdata('Annual Dues must be a number, e.g. 25.00.');
    }

    if($result > 0){ // passed validation - save the record

        if($recid > 0){ // updating

            $this->model->update($recid, $subentitydata_post, 'ccmps_subentities');
            $this->_audit('SubmitUpdate', $recid, $subentitydata_post['chapter_title']);

            set_flashdata('The record was successfully updated.');
            $_SESSION['flashmsgcolor'] = 1; // green

        }else{ // adding

            $newid = $this->model->insert($subentitydata_post, 'ccmps_subentities');
            $this->_audit('SubmitCreate', $newid, $subentitydata_post['chapter_title']);

            set_flashdata('The record was successfully created.');
            $_SESSION['flashmsgcolor'] = 1; // green

        }

        redirect('system-subentities/manage');

    }else{ // failed validation - return to the crud form with the attempted values

        if($recid > 0){ // failed updating
             $this->updatesubentity('yes');
        }else{ // failed adding
             $this->createsubentity('yes');
        }

    }

  }else{
    redirect('system-subentities/manage');
  }

}

/*-------------------------- End subentitysubmit -----------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------- function _SUBENTITIES_FETCH_DATA_FROM_POST ----------------*/
/*----------------------------------------------------------------------------*/

    function _subentities_fetch_data_from_post() { // anchor2
    // private function protected - attempt to direct access results in 404 error
    // blanks are saved as NULL, as the existing rows have them

    $text = array('chapter_title', 'description', 'logo', 'website', 'facebook', 'instagram', 'youtube',
                  'chapter_email', 'financial_email', 'financial_phone', 'financial_contact');
    foreach($text as $field){
        $value = trim((string) post($field, true));
        $data[$field] = ($value === '' && $field !== 'chapter_title') ? null : $value;
    }

    $data['chartered'] = post('chartered') == 1 ? 1 : 0;
    $data['active']    = post('active') == 1 ? 1 : 0;

    $region = (int) post('region');
    $data['region'] = $region > 0 ? $region : null;

    $state = strtoupper(trim((string) post('state', true)));
    $data['state'] = $state !== '' ? $state : null;

    $dues = trim(str_replace(array('$', ','), '', (string) post('annual_dues', true)));
    $data['annual_dues'] = $dues !== '' ? $dues : null;

    return $data; // returns to subentitysubmit()

    }

/*----------------- End _subentities_fetch_data_from_post --------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function DELRECORD ---------------------------*/
/*----------------------------------------------------------------------------*/

    function delrecord() { // delete single record - only when no member belongs to it

    $subentitiesfunction = 'manage';
    $authorized = $this->_check_function_permissions($subentitiesfunction);

        $recid = (int) segment(3); // passed by the form on the manage page

        if($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($this->_token(), (string) post('token'))){
            $_SESSION['flashmsgcolor'] = 0; // crimson
            set_flashdata('The page had expired - please try again.');
            redirect('system-subentities/manage');
        }

        $record = $recid > 0 ? $this->model->get_where($recid, 'ccmps_subentities') : false;
        if(!$record){
            die('No recid passed to delete');
        }

        $members = $this->_members_in_subentity($recid);
        if($members > 0){
            $_SESSION['flashmsgcolor'] = 0; // crimson
            set_flashdata($record->chapter_title.' still has '.$members.' '.($members == 1 ? CCMP : CCMPS).' and was not deleted. Untick Active instead to leave it out of the counts.');
            redirect('system-subentities/manage');
        }

        $this->model->delete($recid, 'ccmps_subentities');
        $this->_audit('DeleteRecord', $recid, $record->chapter_title);

        set_flashdata('The record was successfully deleted.');
        $_SESSION['flashmsgcolor'] = 1; // green

        redirect('system-subentities/manage');

    }

/*--------------------------- End function delrecord -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------------ SMALL HELPERS -------------------------------*/
/*----------------------------------------------------------------------------*/

    function _get_lookups(){ // dropdown lists for the crud form
        $data['regions'] = $this->model->query("SELECT id, title, description FROM ref_region_codes ORDER BY title", 'object');
        $data['states']  = $this->model->query("SELECT state_code, name FROM ref_states WHERE state_code != 'NA' ORDER BY name", 'object');
        return $data;
    }

    function _members_in_subentity($recid){ // every member record, deceased and deleted included
        $rows = $this->model->query_bind("SELECT COUNT(*) AS n FROM ccmps WHERE subentity = :id", array('id' => (int) $recid), 'object');
        return !empty($rows) ? (int) $rows[0]->n : 0;
    }

    function _home_url(){ // where Home and Close go: staff dashboard or member home
        return !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
    }

    function _token(){ // ties the forms to this session
        if(empty($_SESSION['subentities_token'])){
            $_SESSION['subentities_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['subentities_token'];
    }

    function _audit($action, $recid, $what){
        $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', $action, 'system-subentities', $un, $time, 'Rec: '.$recid, 'Tbl: ccmps_subentities', 'Title: '.$what);
    }

/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($subentitiesfunction, $recid = NULL) {
    // protected - private function
    // the same people who see the Chapters link under System Admin on the member side menu,
    // plus staff system admins and staff member admins

        switch($subentitiesfunction) {

          case 'manage': //

if(!empty($_SESSION['trongatetoken'])){ // logged in
     if(!empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['honcho_sysadmin']) || !empty($_SESSION['honcho_ccmps_admin'])
        || !empty($_SESSION['honcho_ccmps_module_all']) || !empty($_SESSION['honcho_all_modules'])){ // has rights
                    $data = "goodtogo";
                    return $data;
                  }else{
                        $_SESSION['flashmsgcolor'] = 0; // crimson
                        set_flashdata('You are not authorized to manage '.SUBENTITIES.'.');

                        redirect($this->_home_url());
                  }
}else{ // not logged in at all - send to login form

        set_flashdata('Your Session has expired - please login again.');
        $_SESSION['flashmsgcolor'] = 0; // crimson

    redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout'); // clears everything then takes to login page

}

          break;

        }
    }

/*----------------------- End _check_function_permissions --------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function _GET_FONT_SIZES ---------------------*/
/*----------------------------------------------------------------------------*/

    function _get_font_sizes() {
    // protected - private function
    // Reuses the ccmp's fontsize preferences, same as the parent Ccmps module

if(!empty($_SESSION['ccmp_rec_id'])){
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id, 'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize ?? '';  // view pages
    $_SESSION['tfontsize']      = $ccmp_obj->tfontsize ?? ''; // tables
}

         switch($_SESSION['fontsize'] ?? '') {
          case '1':
                 $_SESSION['fontsize'] = 'Large';
          break;
          case '2':
                 $_SESSION['fontsize'] = 'Medium';
          break;
          case '3':
                 $_SESSION['fontsize'] = 'Small';
          break;
        }

          switch($_SESSION['tfontsize'] ?? '') {
          case '1':
                 $_SESSION['tfontsize'] = 'Large';
          break;
          case '2':
                 $_SESSION['tfontsize'] = 'Medium';
          break;
          case '3':
                 $_SESSION['tfontsize'] = 'Small';
          break;
        }

    return;
    }
/*------------------------- End _get_font_sizes ------------------------------*/


} // end controller
