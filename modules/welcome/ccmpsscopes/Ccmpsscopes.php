<?php

/*----------------------------------------------------------------------------*/
/*-------------------- module WELCOME-CCMPSSCOPES ----------------------------*/
/*----------------------------------------------------------------------------*/

/*
  manage()
        _check_function_permissions($ccmpsscopesfunction)
        _get_font_sizes()
  createscope($retrying)
        _get_font_sizes()
  updatescope($retrying)
        _get_a_single_record($recid) anchor1
  scopesubmit()
        _scopes_fetch_data_from_post() anchor2
        manage()
        createscope('yes')
        updatescope('yes')
  _scopes_fetch_data_from_post() anchor2
  _get_a_single_record($recid) anchor1
  delrecord()
  undelrecord()
  _check_function_permissions($ccmpsscopesfunction, $recid = NULL)
  _get_font_sizes()
*/

/* ccmps_scopes is a simple maintenance/lookup table:
       id            (auto increment)
       title         (varchar 255)
       description   (varchar 255)
*/

/*----------------------------------------------------------------------------*/

class Ccmpsscopes extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'ccmpsscopes';
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

        $scope_data = $this->model->get_where($recid, 'ccmps_scopes');

        return $scope_data; // returns to updatescope()
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the ccmpsscopes manage page

//echo(72); die();
 //   $ccmpsscopesfunction = 'manage';
//    $authorized = $this->_check_function_permissions($ccmpsscopesfunction);

    // Get font size preference for views & manage page
    $this->_get_font_sizes();

    if(strlen($_SESSION['trongatetoken']) > 0){
        // ok do nothing
    }else{
        $flash_msg = 'Your Session has expired - please login again.';
        set_flashdata($flash_msg);

        // you logged out or session timed out - login again
        redirect('welcome/logout'); // clears everything then takes to login page
    }

    // Get all scope records, ordered by title
    $data['ccmpsscopesrecs'] = $this->model->get('title', 'ccmps_scopes');

    $data['view_module'] = 'welcome/ccmpsscopes';
    $data['view_file']   = 'manage';

// customize form    
    $data['entityname']  = 'Scope';
    $data['entitynames'] = 'Scopes';

    $data['bc1']      = CCMP.' Admin';
    $data['bc2']      = 'Manage '.$data['entitynames'];
    $data['header']   = 'Manage '.$data['entitynames'];
    $data['activity'] = CCMP.' Administrator';

//json($data); die();
    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- function CREATESCOPE -----------------------------*/
/*----------------------------------------------------------------------------*/

function createscope($retrying = NULL){ // Adding - may be first time or with values after failed validation

  $retry = $retrying; // for failed validation repost

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

  if($retry == 'yes'){
        $retry = 'no'; // reset
        $data = $_POST; // get what was posted from the form
  }else{
        $data['id']          = '';
        $data['title']       = '';
        $data['description'] = '';
  }

  $data['recid']       = '';

// customize module path and crud form name  
  $data['view_module'] = 'welcome/ccmpsscopes';
  $data['view_file']   = 'ccmpsscopescrud'; // use the single-page crud form for creating

// customize form    
  $data['entityname']  = 'Scope';
  $data['entitynames'] = 'Scopes';

  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Create New '.$data['entityname'];

  $this->templates->inspinia($data);
}

/*----------------------- End function createscope ---------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- function UPDATESCOPE -----------------------------*/
/*----------------------------------------------------------------------------*/

function updatescope($retrying = NULL){ // edit form for an existing scope

  $retry = $retrying;
  $recid = segment(3);

  if($retry == 'yes'){
        $retry = 'no'; // reset
        $data = $_POST; // get what was posted from the form
        $recid = $data['recid'];
  }else{
        $data = (array)$this->_get_a_single_record($recid); // anchor1
  }

  $data['recid']       = $recid;

// customize module path and crud form name  
  $data['view_module'] = 'welcome/ccmpsscopes';
  $data['view_file']   = 'ccmpsscopescrud'; // use the single-page crud form for updating

  $data['entityname'] = 'Scope';
  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Update '.$data['entityname'];

  $this->templates->inspinia($data);

}

/*----------------------- End function updatescope ---------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function SCOPESUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/

function scopesubmit(){ // used by both create & update
//echo(190); die();
  if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
  }else{
    $flash_msg = 'Your Session has expired - please login again.';
    set_flashdata($flash_msg);

    redirect('welcome/logout');
  }

  $recid  = segment(3); // if updating there will be a record id, if adding nothing
  $submit = post('submit', true);

  if($recid > 0){
     $crud = 'updating';
  }else{
     $crud = 'adding';
  }

  if($submit == 'Submit'){

    $scopedata_post = $this->_scopes_fetch_data_from_post(); // anchor2

    $result = 1; // passing validation until proven otherwise

    if(strlen($scopedata_post['title']) > 0){
        // check for a duplicate title
        $usr_obj = $this->model->get_one_where('title', $scopedata_post['title'], 'ccmps_scopes');
        $recordfndid = $usr_obj->id;

        if($recordfndid > 0 AND $recordfndid != $recid){
            $result = 0; // failed validation

            $flash_msg = 'That Title already exists.';
            set_flashdata($flash_msg);
        }
    }else{
        $result = 0; // failed validation

        $flash_msg = 'A Title is required.';
        set_flashdata($flash_msg);
    }

    if($result > 0){ // passed validation - save the record

        if($recid > 0){ // updating

            $this->model->update($recid, $scopedata_post, 'ccmps_scopes');

            $flash_msg = 'The record was successfully updated.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }else{ // adding

            $this->model->insert($scopedata_post, 'ccmps_scopes');

            $flash_msg = 'The record was successfully created.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }

        $this->manage();

    }else{ // failed validation - return to the crud form with the attempted values

        if($recid > 0){ // failed updating
             $this->updatescope('yes');
        }else{ // failed adding
             $this->createscope('yes');
        }

    }

  }

}

/*----------------------------- End scopesubmit ------------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------ function _SCOPES_FETCH_DATA_FROM_POST -------------------*/
/*----------------------------------------------------------------------------*/

    function _scopes_fetch_data_from_post() { // anchor2
    // private function protected - attempt to direct access results in 404 error
//json($_POST); die();
    $data['title']       = post('title', true);
    $data['description'] = post('description', true);

    return $data; // returns to scopesubmit()

    }

/*-------------------- End _scopes_fetch_data_from_post ----------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function DELRECORD ---------------------------*/
/*----------------------------------------------------------------------------*/

    function delrecord() { // delete single record

    $ccmpsscopesfunction = 'delrecord';
    $authorized = $this->_check_function_permissions($ccmpsscopesfunction);

        $recid = segment(3); // passed by button on manage page

        if(strlen($recid) > 0){
            $this->model->delete($recid, 'ccmps_scopes');

            $flash_msg = 'The record was successfully deleted.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green
        }else{
            die('No recid passed to delete');
        }

        redirect('welcome-ccmpsscopes/manage');

    }

/*--------------------------- End function delrecord -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($ccmpsscopesfunction, $recid = NULL) {
    // protected - private function

        switch($ccmpsscopesfunction) {

          case 'manage': //

if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // logged in
     if($_SESSION['ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // has rights
                    $data = "goodtogo";
                    return $data;
                  }else{
                        $flash_msg = 'You are not authorized to manage Scopes.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
}else{ // not logged in at all - send to login form

        $flash_msg = 'You are not authorized to manage Scopes.';
        set_flashdata($flash_msg);
        $_SESSION['flashmsgcolor'] = 0; // crimson

    redirect('welcome/logout'); // clears everything then takes to login page

}

          break;

          case 'delrecord': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1){ //

              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

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

if($_SESSION['ccmp_rec_id']){
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id, 'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize;  // view pages
    $_SESSION['tfontsize']      = $ccmp_obj->tfontsize; // tables
}

         switch($_SESSION['fontsize']) {
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

          switch($_SESSION['tfontsize']) {
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
