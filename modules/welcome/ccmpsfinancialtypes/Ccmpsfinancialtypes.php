<?php

/*----------------------------------------------------------------------------*/
/*---------------- module WELCOME-CCMPSFINANCIALTYPES ------------------------*/
/*----------------------------------------------------------------------------*/

/*
  manage()
        _check_function_permissions($ccmpsfinancialtypesfunction)
        _get_font_sizes()
  createfinancialtype($retrying)
        _get_font_sizes()
  updatefinancialtype($retrying)
        _get_a_single_record($recid) anchor1
  financialtypesubmit()
        _financialtypes_fetch_data_from_post() anchor2
        manage()
        createfinancialtype('yes')
        updatefinancialtype('yes')
  _financialtypes_fetch_data_from_post() anchor2
  _get_a_single_record($recid) anchor1
  delrecord()
  undelrecord()
  _check_function_permissions($ccmpsfinancialtypesfunction, $recid = NULL)
  _get_font_sizes()
*/

/* ccmps_financial_types is a simple maintenance/lookup table:
       id              (auto increment)
       fin_type_title  (varchar 125)
       description     (varchar 255)
*/

/*----------------------------------------------------------------------------*/

class Ccmpsfinancialtypes extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    // Legacy, never finished: the ccmps_financial_types table doesn't exist and
    // isn't planned, so every page here would 500. Blocked until it's built.
    function __construct(?string $module_name = null){
      parent::__construct($module_name);
      block_url_invocation('welcome-ccmpsfinancialtypes');
    }

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'ccmpsfinancialtypes';
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

        $financialtype_data = $this->model->get_where($recid, 'ccmps_financial_types');

        return $financialtype_data; // returns to updatefinancialtype()
  }

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  function manage(){ // takes you to the ccmpsfinancialtypes manage page

    $ccmpsfinancialtypesfunction = 'manage';
    $authorized = $this->_check_function_permissions($ccmpsfinancialtypesfunction);

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

    // Get all financial type records, ordered by fin_type_title
    $data['ccmpsfinancialtypesrecs'] = $this->model->get('fin_type_title', 'ccmps_financial_types');

    $data['view_module'] = 'welcome/ccmpsfinancialtypes';
    $data['view_file']   = 'manage';

// customize form
    $data['entityname']  = 'Financial Type';
    $data['entitynames'] = 'Financial Types';

    $data['bc1']      = CCMP.' Admin';
    $data['bc2']      = 'Manage '.$data['entitynames'];
    $data['header']   = 'Manage '.$data['entitynames'];
    $data['activity'] = CCMP.' Administrator';

    $this->templates->inspinia($data);

  }

/*-------------------------- End function manage -----------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------- function CREATEFINANCIALTYPE --------------------------*/
/*----------------------------------------------------------------------------*/

function createfinancialtype($retrying = NULL){ // Adding - may be first time or with values after failed validation

  $retry = $retrying; // for failed validation repost

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

  if($retry == 'yes'){
        $retry = 'no'; // reset
        $data = $_POST; // get what was posted from the form
  }else{
        $data['id']             = '';
        $data['fin_type_title'] = '';
        $data['description']    = '';
  }

  $data['recid']       = '';

// customize module path and crud form name
  $data['view_module'] = 'welcome/ccmpsfinancialtypes';
  $data['view_file']   = 'ccmpsfinancialtypescrud'; // use the single-page crud form for creating

// customize form
  $data['entityname']  = 'Financial Type';
  $data['entitynames'] = 'Financial Types';

  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Create New '.$data['entityname'];

  $this->templates->inspinia($data);
}

/*----------------------- End function createfinancialtype --------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------- function UPDATEFINANCIALTYPE ---------------------------*/
/*----------------------------------------------------------------------------*/

function updatefinancialtype($retrying = NULL){ // edit form for an existing financial type

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
  $data['view_module'] = 'welcome/ccmpsfinancialtypes';
  $data['view_file']   = 'ccmpsfinancialtypescrud'; // use the single-page crud form for updating

  $data['entityname'] = 'Financial Type';
  $data['bc1'] = CCMP.' Admin';
  $data['bc2'] = 'Update '.$data['entityname'];

  $this->templates->inspinia($data);

}

/*----------------------- End function updatefinancialtype ---------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function FINANCIALTYPESUBMIT -----------------------*/
/*----------------------------------------------------------------------------*/

function financialtypesubmit(){ // used by both create & update

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

    $financialtypedata_post = $this->_financialtypes_fetch_data_from_post(); // anchor2

    $result = 1; // passing validation until proven otherwise

    if(strlen($financialtypedata_post['fin_type_title']) > 0){
        // check for a duplicate title
        $usr_obj = $this->model->get_one_where('fin_type_title', $financialtypedata_post['fin_type_title'], 'ccmps_financial_types');
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

            $this->model->update($recid, $financialtypedata_post, 'ccmps_financial_types');

            $flash_msg = 'The record was successfully updated.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }else{ // adding

            $this->model->insert($financialtypedata_post, 'ccmps_financial_types');

            $flash_msg = 'The record was successfully created.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green

        }

        $this->manage();

    }else{ // failed validation - return to the crud form with the attempted values

        if($recid > 0){ // failed updating
             $this->updatefinancialtype('yes');
        }else{ // failed adding
             $this->createfinancialtype('yes');
        }

    }

  }

}

/*----------------------------- End financialtypesubmit -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------- function _FINANCIALTYPES_FETCH_DATA_FROM_POST ----------------*/
/*----------------------------------------------------------------------------*/

    function _financialtypes_fetch_data_from_post() { // anchor2
    // private function protected - attempt to direct access results in 404 error

    $data['fin_type_title'] = post('fin_type_title', true);
    $data['description']    = post('description', true);

    return $data; // returns to financialtypesubmit()

    }

/*-------------------- End _financialtypes_fetch_data_from_post ----------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function DELRECORD ---------------------------*/
/*----------------------------------------------------------------------------*/

    function delrecord() { // delete single record

    $ccmpsfinancialtypesfunction = 'delrecord';
    $authorized = $this->_check_function_permissions($ccmpsfinancialtypesfunction);

        $recid = segment(3); // passed by button on manage page

        if(strlen($recid) > 0){
            $this->model->delete($recid, 'ccmps_financial_types');

            $flash_msg = 'The record was successfully deleted.';
            set_flashdata($flash_msg);
            $_SESSION['flashmsgcolor'] = 1; // green
        }else{
            die('No recid passed to delete');
        }

        redirect('welcome-ccmpsfinancialtypes/manage');

    }

/*--------------------------- End function delrecord -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($ccmpsfinancialtypesfunction, $recid = NULL) {
    // protected - private function

        switch($ccmpsfinancialtypesfunction) {

          case 'manage': //

if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // logged in
     if($_SESSION['ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // has rights
                    $data = "goodtogo";
                    return $data;
                  }else{
                        $flash_msg = 'You are not authorized to manage Financial Types.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
}else{ // not logged in at all - send to login form

        $flash_msg = 'You are not authorized to manage Financial Types.';
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
