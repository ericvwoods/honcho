<?php

/*----------------------------------------------------------------------------*/
/*------------------------------- module FIN ---------------------------------*/
/*----------------------------------------------------------------------------*/

/*
  Financial (Core; dues first, 2026-10-31). Dues step 2: the nightly job. The screens
  (record chapter dues, National invoices, settings, reports) come in steps 3-5.

  nightly($key)          for the server's scheduler, once a day (no login): moves the membership year
                         on when its due date passes (dues_roll_year()) and recalculates every member's
                         status (dues_recalc_all()). Only while DUES_STATUS_ENGINE is on. $key must equal
                         CRON_KEY in .env (or COFFEE_CRON_KEY when CRON_KEY isn't set).
        _audit($action, $what)
*/

class Fin extends Trongate {

/*----------------------------------------------------------------------------*/
/*---------------------------- function NIGHTLY ------------------------------*/
/*----------------------------------------------------------------------------*/
  function nightly($key = NULL){

    $expected = (string) env('CRON_KEY', env('COFFEE_CRON_KEY', ''));
    $key      = (string) ($key ?? segment(3));
    header('Content-Type: text/plain; charset=utf-8');
    if($expected === '' || strlen($expected) < 24 || !hash_equals($expected, $key)){
        http_response_code(403);
        echo "Forbidden\n";
        return;
    }
    if((int) setting('DUES_STATUS_ENGINE', 0) !== 1){
        echo "Dues status engine off\n";
        return;
    }
    set_time_limit(900);
    list($old, $new) = dues_roll_year(true);
    $r = dues_recalc_all(true);
    $names = array(0 => 'none', 1 => 'current', 2 => 'past due', 3 => 'pending', 5 => 'expired');
    $counts = array();
    foreach($r['counts'] as $code => $n){ $counts[] = ($names[$code] ?? $code).' '.$n; }
    $summary = 'membership year '.$new.($old !== $new ? ' (was '.$old.')' : '').', grace '.($r['grace'] ? 'on' : 'off').'; '
             .count($r['changes']).' status change(s); '.implode(', ', $counts);
    if($old !== $new || !empty($r['changes'])){
        $this->_audit('DuesNightly', $summary);
    }
    echo $summary."\n";
  }

/*----------------------------------------------------------------------------*/
/*------------------------------- helpers ------------------------------------*/
/*----------------------------------------------------------------------------*/
    function _audit($action, $what){
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', $action, 'fin', 'UN: scheduler', $time, 'Rec: all members', 'Tbl: ccmps', substr($what, 0, 250));
    }

} // end controller
