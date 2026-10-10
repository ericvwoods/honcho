<?php
 class Auditlog extends Trongate {

    function logevent ($eventmsg, $type, $str1 = NULL, $str2 = NULL, $str3 = NULL, $str4 = NULL){

        $logdata['type']   = $type; 
        $logdata['action'] = $eventmsg;
        $logdata['str1']   = $str1;
        $logdata['str2']   = $str2;
        $logdata['str3']   = $str3;
        $logdata['str4']   = $str4;

        // cant tell who created because may not know becasue sys or str not saved 
       // if ($_SESSION['sys_user_id'] >0){
      //      $logdata['created_by'] = $_SESSION['sys_user_id'];
       // }else{
      //      $logdata['created_by'] = $_SESSION['str_user_id'];
      //  }
        // trongate_user_id is unique
      $logdata['created_by'] = $_SESSION['tg_user_id'];
      $logdata['created_at'] = TIME();


        //insert the new record            
        $new_log_id = $this->model->insert($logdata, 'auditlog');
 //       $cnt = $cnt +1;
 //       print_r($cnt);
       // print_r($data); die();
        return $new_log_id;

    //   echo 'Saved!'; die();

     //   echo $type;
     //   echo $action;
     //   echo $str1;
     //   echo $str2;
     //  echo $created_by;
     //   echo $created_at;
    //  die();

    }

}