<?php

/*----------------------------------------------------------------------------*/
/*-------------------- module DMS-DMSFILELIBRARYFUNCTIONS --------------------*/
/*----------------------------------------------------------------------------*/

/*
  manage()
        _check_function_permissions($dmsfilelibraryfunctionsfunction)
        _get_font_sizes()
  createfunction($retrying)
        _get_font_sizes()
  updatefunction($retrying)
        _get_a_single_record($recid) anchor1
  functionsubmit()
        _function_fetch_data_from_post() anchor2
        manage()
        createfunction('yes')
        updatefunction('yes')
  _function_fetch_data_from_post() anchor2
  _get_a_single_record($recid) anchor1
  delrecord()
  undelrecord()
  _check_function_permissions($dmsfilelibraryfunctionsfunction, $recid = NULL)
  _get_font_sizes()
*/

/* dms_filelibrary_functions is a simple maintenance/lookup table:
       id            (auto increment)
       title         (varchar 255)
       description   (varchar 255)
*/

/*----------------------------------------------------------------------------*/

class Dmsfilelibraryfunctions extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'dms';
      $this->child_module  = 'dmsfilelibraryfunctions';
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

        $function_data = $this->model->get_where($recid, 'dms_filelibrary_functions');

        return $function_data; // returns to updatefunction()
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the dmsfilelibraryfunctions manage page

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

    // Get all function records, ordered by title
    $data['dmsfilelibraryfunctionsrecs'] = $this->model->get('title', 'dms_filelibrary_functions');

    $data['view_module'] = 'dms/dmsfilelibraryfunctions';
    $data['view_file']   = 'manage';

// customize form    
    $data['entityname']  = 'File Library Function';
    $data['entitynames'] = 'File Library Functions';

    $data['bc1']      = CCMP.' Admin';
    $data['bc2']      = 'Manage '.$data['entitynames'];
    $data['header']   = $data['entitynames'];
    $data['activity'] = CCMP.' Administrator';

    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- function CREATEFUNCTION --------------------------*/
/*----------------------------------------------------------------------------*/

function createfunction($retrying = NULL){ // Adding - may be first time or with values after failed validation

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
  $data['view_module'] = 'dms/dmsfilelibraryfunctions';
  $data['view_file']   = 'dmsfilelibraryfunctionscrud'; // use the single-page crud form for creating

// customize form    
  $data['entityname']  = 'File Library Function';
  $data['entitynames'] = 'File Library Functions';

  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Create New '.$data['entityname'];

  $this->templates->inspinia($data);
}

/*----------------------- End function createfunction ------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- function UPDATEFUNCTION --------------------------*/
/*----------------------------------------------------------------------------*/

function updatefunction($retrying = NULL){ // edit form for an existing function

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
  $data['view_module'] = 'dms/dmsfilelibraryfunctions';
  $data['view_file']   = 'dmsfilelibraryfunctionscrud'; // use the single-page crud form for updating

  $data['entityname'] = 'File Library Function';
  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Update '.$data['entityname'];

  $this->templates->inspinia($data);

}

/*----------------------- End function updatefunction ------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function FUNCTIONSUBMIT -------------------------*/
/*----------------------------------------------------------------------------*/

function functionsubmit(){ // used by both create & update

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

    $functiondata_post = $this->_function_fetch_data_from_post(); // anchor2

    $result = 1; // passing validation until proven otherwise

    if(strlen($functiondata_post['title']) > 0){
        // check for a duplicate title
        $usr_obj = $this->model->get_one_where('title', $functiondata_post['title'], 'dms_filelibrary_functions');
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

            $this->model->update($recid, $functiondata_post, 'dms_filelibrary_functions');

            $flash_msg = 'The record was successfully updated.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }else{ // adding

            $this->model->insert($functiondata_post, 'dms_filelibrary_functions');

            $flash_msg = 'The record was successfully created.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }

        $this->manage();

    }else{ // failed validation - return to the crud form with the attempted values

        if($recid > 0){ // failed updating
             $this->updatefunction('yes');
        }else{ // failed adding
             $this->createfunction('yes');
        }

    }

  }

}

/*----------------------------- End functionsubmit ---------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------ function _FUNCTION_FETCH_DATA_FROM_POST ----------------*/
/*----------------------------------------------------------------------------*/

    function _function_fetch_data_from_post() { // anchor2
    // private function protected - attempt to direct access results in 404 error

    $data['title']       = post('title', true);
    $data['description'] = post('description', true);

    return $data; // returns to functionsubmit()

    }

/*-------------------- End _function_fetch_data_from_post --------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function DELRECORD ---------------------------*/
/*----------------------------------------------------------------------------*/

    function delrecord() { // delete single record

    $dmsfilelibraryfunctionsfunction = 'delrecord';
    $authorized = $this->_check_function_permissions($dmsfilelibraryfunctionsfunction);

        $recid = segment(3); // passed by button on manage page

        if(strlen($recid) > 0){
            $this->model->delete($recid, 'dms_filelibrary_functions');

            $flash_msg = 'The record was successfully deleted.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green
        }else{
            die('No recid passed to delete');
        }

        redirect('dms-dmsfilelibraryfunctions/manage');

    }

/*--------------------------- End function delrecord -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($dmsfilelibraryfunctionsfunction, $recid = NULL) {
    // protected - private function

        switch($dmsfilelibraryfunctionsfunction) {

          case 'manage': //

if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // logged in
     if($_SESSION['ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // has rights
                    $data = "goodtogo";
                    return $data;
                  }else{
                        $flash_msg = 'You are not authorized to manage File Library Functions.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
}else{ // not logged in at all - send to login form

        $flash_msg = 'You are not authorized to manage File Library Functions.';
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