<?php
/*


Tables: auditlog, auditlogger_bulk_actions
Templates: inspinia.php
*/

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

    echo('Honcho-modules-sysconfig-index()'); die();

  }
}