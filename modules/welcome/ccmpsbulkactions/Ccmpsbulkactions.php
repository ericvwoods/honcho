<?php

/*----------------------------------------------------------------------------*/
/*----------------- module WELCOME-CCMPSBULKACTIONS ---------------------------*/
/*----------------------------------------------------------------------------*/

/*
  manage()
        _check_function_permissions($ccmpsbulkactionsfunction)
        _get_font_sizes()
  createbulkaction($retrying)
        _get_font_sizes()
  updatebulkaction($retrying)
        _get_a_single_record($recid) anchor1
  bulkactionsubmit()
        _bulkactions_fetch_data_from_post() anchor2
        manage()
        createbulkaction('yes')
        updatebulkaction('yes')
  _bulkactions_fetch_data_from_post() anchor2
  _get_a_single_record($recid) anchor1
  delrecord()
  undelrecord()
  _check_function_permissions($ccmpsbulkactionsfunction, $recid = NULL)
  _get_font_sizes()
*/

/* ccmps_bulk_actions is a simple maintenance/lookup table:
       id            (auto increment)
       title         (varchar 125)
       description   (varchar 255)
*/

/*----------------------------------------------------------------------------*/

class Ccmpsbulkactions extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'ccmpsbulkactions';
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

        $bulkaction_data = $this->model->get_where($recid, 'ccmps_bulk_actions');

        return $bulkaction_data; // returns to updatebulkaction()
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the ccmpsbulkactions manage page

    $ccmpsbulkactionsfunction = 'manage';
    $authorized = $this->_check_function_permissions($ccmpsbulkactionsfunction);

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

    // Get all bulk action records, ordered by title
    $data['ccmpsbulkactionsrecs'] = $this->model->get('title', 'ccmps_bulk_actions');

    $data['view_module'] = 'welcome/ccmpsbulkactions';
    $data['view_file']   = 'manage';

// customize form
    $data['entityname']  = 'Bulk Action';
    $data['entitynames'] = 'Bulk Actions';

    $data['bc1']      = CCMP.' Admin';
    $data['bc2']      = 'Manage '.$data['entitynames'];
    $data['header']   = 'Manage '.$data['entitynames'];
    $data['activity'] = CCMP.' Administrator';

    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function CREATEBULKACTION ---------------------------*/
/*----------------------------------------------------------------------------*/

function createbulkaction($retrying = NULL){ // Adding - may be first time or with values after failed validation

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
  $data['view_module'] = 'welcome/ccmpsbulkactions';
  $data['view_file']   = 'ccmpsbulkactionscrud'; // use the single-page crud form for creating

// customize form
  $data['entityname']  = 'Bulk Action';
  $data['entitynames'] = 'Bulk Actions';

  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Create New '.$data['entityname'];

  $this->templates->inspinia($data);
}

/*----------------------- End function createbulkaction -----------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------- function UPDATEBULKACTION ---------------------------*/
/*----------------------------------------------------------------------------*/

function updatebulkaction($retrying = NULL){ // edit form for an existing bulk action

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
  $data['view_module'] = 'welcome/ccmpsbulkactions';
  $data['view_file']   = 'ccmpsbulkactionscrud'; // use the single-page crud form for updating

  $data['entityname'] = 'Bulk Action';
  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Update '.$data['entityname'];

  $this->templates->inspinia($data);

}

/*----------------------- End function updatebulkaction ------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function BULKACTIONSUBMIT --------------------------*/
/*----------------------------------------------------------------------------*/

function bulkactionsubmit(){ // used by both create & update

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

    $bulkactiondata_post = $this->_bulkactions_fetch_data_from_post(); // anchor2

    $result = 1; // passing validation until proven otherwise

    if(strlen($bulkactiondata_post['title']) > 0){
        // check for a duplicate title
        $usr_obj = $this->model->get_one_where('title', $bulkactiondata_post['title'], 'ccmps_bulk_actions');
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

            $this->model->update($recid, $bulkactiondata_post, 'ccmps_bulk_actions');

            $flash_msg = 'The record was successfully updated.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }else{ // adding

            $this->model->insert($bulkactiondata_post, 'ccmps_bulk_actions');

            $flash_msg = 'The record was successfully created.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }

        $this->manage();

    }else{ // failed validation - return to the crud form with the attempted values

        if($recid > 0){ // failed updating
             $this->updatebulkaction('yes');
        }else{ // failed adding
             $this->createbulkaction('yes');
        }

    }

  }

}

/*----------------------------- End bulkactionsubmit ----------------------------*/


/*----------------------------------------------------------------------------*/
/*--------------- function _BULKACTIONS_FETCH_DATA_FROM_POST -----------------*/
/*----------------------------------------------------------------------------*/

    function _bulkactions_fetch_data_from_post() { // anchor2
    // private function protected - attempt to direct access results in 404 error

    $data['title']       = post('title', true);
    $data['description'] = post('description', true);

    return $data; // returns to bulkactionsubmit()

    }

/*-------------------- End _bulkactions_fetch_data_from_post -------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function DELRECORD ---------------------------*/
/*----------------------------------------------------------------------------*/

    function delrecord() { // delete single record

    $ccmpsbulkactionsfunction = 'delrecord';
    $authorized = $this->_check_function_permissions($ccmpsbulkactionsfunction);

        $recid = segment(3); // passed by button on manage page

        if(strlen($recid) > 0){
            $this->model->delete($recid, 'ccmps_bulk_actions');

            $flash_msg = 'The record was successfully deleted.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green
        }else{
            die('No recid passed to delete');
        }

        redirect('welcome-ccmpsbulkactions/manage');

    }

/*--------------------------- End function delrecord -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($ccmpsbulkactionsfunction, $recid = NULL) {
    // protected - private function

        switch($ccmpsbulkactionsfunction) {

          case 'manage': //

if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // logged in
     if($_SESSION['ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // has rights
                    $data = "goodtogo";
                    return $data;
                  }else{
                        $flash_msg = 'You are not authorized to manage Bulk Actions.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
}else{ // not logged in at all - send to login form

        $flash_msg = 'You are not authorized to manage Bulk Actions.';
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
