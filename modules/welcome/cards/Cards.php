<?php

/*----------------------------------------------------------------------------*/
/*-------------------------- module WELCOME-CARDS ----------------------------*/
/*----------------------------------------------------------------------------*/

/*
  Digital membership cards (plan 2026-10-26), phase 1: the card in the member portal.
  The card's logic is in engine/tg_helpers/card_helper.php, shared with the phone API
  (welcome-api/mycard). Google Wallet (phase 3, wallet_helper.php) is the googlewallet()
  button; door check-in (phase 2) comes next, Apple Wallet later.

  mycard()
        _check_function_permissions('mycard')
        _show_card($ccmp_id, false)
  card($ccmp_id)                  an admin looks at (and can reissue) a member's card
        _check_function_permissions('card', $ccmp_id)
        _can_manage($ccmp_id)
        _show_card($ccmp_id, true)
  reissue()                       POST: cancel the active card, issue a new one (lost phone)
        _check_function_permissions('mycard')
        _can_manage($ccmp_id)
        card_reissue(), gwallet_deactivate()
        _audit()
  googlewallet()                  Add to Google Wallet: gwallet_save_url(), then redirect to Google
        _check_function_permissions('mycard')
        _audit()
  _show_card($ccmp_id, $admin_view)
        card_for_member(), card_details(), card_code()
        _token()
  _can_manage($ccmp_id)
  _token()
  _audit($action, $ccmp_id, $what)
  _check_function_permissions($cardsfunction, $ccmp_id = NULL)
*/

class Cards extends Trongate {

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'cards';
    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module  = '';
    }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MYCARD -------------------------------*/
/*----------------------------------------------------------------------------*/
  function mycard(){ // the logged-in member's own card

    $this->_check_function_permissions('mycard');

    $ccmp_id = (int) $_SESSION['ccmp_rec_id'];
    $this->_show_card($ccmp_id, false);
  }

/*----------------------------------------------------------------------------*/
/*----------------------------- function CARD --------------------------------*/
/*----------------------------------------------------------------------------*/
  function card($ccmp_id = NULL){ // an admin's view of a member's card

    $ccmp_id = (int) ($ccmp_id ?? segment(3));
    $this->_check_function_permissions('card', $ccmp_id);
    $this->_show_card($ccmp_id, true);
  }

/*----------------------------------------------------------------------------*/
/*---------------------------- function REISSUE ------------------------------*/
/*----------------------------------------------------------------------------*/
  function reissue(){ // POST from the card page: the old QR code stops working at once

    $this->_check_function_permissions('mycard');

    if(REQUEST_TYPE != 'POST' || empty($_SESSION['cards_token']) || !hash_equals($_SESSION['cards_token'], (string) post('token'))){
        set_flashdata('The page had expired - nothing was changed. Please try again.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('welcome-cards/mycard');
    }

    $ccmp_id = (int) post('ccmp_id');
    $own     = ($ccmp_id == (int) ($_SESSION['ccmp_rec_id'] ?? 0));
    if(!$own && !$this->_can_manage($ccmp_id)){
        set_flashdata('You are not authorized to change that card.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('welcome-cards/mycard');
    }

    $old  = card_for_member($ccmp_id, false);
    $card = card_reissue($ccmp_id, (int) ($_SESSION['tg_user_id'] ?? 0), $own ? 'Replaced by the member' : 'Replaced by an admin');
    if($old){
        $old->status = 'cancelled';
        gwallet_deactivate($old); // the old card in Google Wallet shows as inactive
    }
    $this->_audit('ReissueCard', $ccmp_id, $card ? 'new card '.$card->id : 'no card (deceased or deleted)');

    if(!$card){
        set_flashdata('No card was issued.');
    }else{
        set_flashdata($own ? 'Your old card has been cancelled. This is your new card.' : 'The old card has been cancelled and a new one issued.');
    }
    $_SESSION['flashmsgcolor'] = $card ? 1 : 0;
    redirect($own ? 'welcome-cards/mycard' : 'welcome-cards/card/'.$ccmp_id);
  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function GOOGLEWALLET ---------------------------*/
/*----------------------------------------------------------------------------*/
  function googlewallet(){ // "Add to Google Wallet": refresh the card's Wallet object, then off to Google

    $this->_check_function_permissions('mycard');
    if(empty($_SESSION['ccmp_logged_in'])){
        redirect('welcome-cards/mycard');
    }

    $ccmp_id = (int) $_SESSION['ccmp_rec_id'];
    $card    = card_for_member($ccmp_id, true);
    $details = card_details($ccmp_id);
    try {
        $url = gwallet_save_url($card, $details);
    } catch (Throwable $e) {
        error_log('welcome-cards/googlewallet: '.$e->getMessage());
        set_flashdata('Google Wallet isn\'t available right now. Please try again later.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect('welcome-cards/mycard');
    }
    $this->_audit('GoogleWallet', $ccmp_id, 'card '.$card->id);
    redirect($url);
  }

/*----------------------------------------------------------------------------*/
/*------------------------------ SMALL HELPERS -------------------------------*/
/*----------------------------------------------------------------------------*/

    function _show_card($ccmp_id, $admin_view){ // the card page, for the member or an admin
        $card    = card_for_member($ccmp_id, true);
        $details = card_details($ccmp_id);
        if(!$card || !$details){
            set_flashdata('There is no card for that '.strtolower(CCMP).'.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect('welcome-ccmps/ccmphome');
        }

        $data['card']        = $card;
        $data['details']     = $details;
        $data['code']        = card_code($card);
        $data['admin_view']  = $admin_view;
        $data['gwallet']     = !$admin_view && gwallet_configured(); // Add to Google Wallet button
        $data['token']       = $this->_token();
        $data['home_url']    = !empty($_SESSION['honcho_logged_in']) ? 'honcho/index' : 'welcome-ccmps/ccmphome';
        $data['card_bg']     = CCMPS_CRUD_LABEL_CLR; // the scheme's Label color: dark in every scheme, so white text reads
        $data['card_accent'] = SN2_CLR;              // the scheme's Accent color

        $data['view_module'] = 'welcome/cards';
        $data['view_file']   = 'mycard';
        $data['bc1']    = $admin_view ? CCMPS : 'My '.CCMP;
        $data['bc2']    = $admin_view ? $details->name.' - Card' : 'My Card';
        $data['header'] = $admin_view ? $details->name.' - '.CCMP.' Card' : 'My '.CCMP.' Card';
        $this->templates->inspinia($data);
    }

    function _can_manage($ccmp_id){ // admins who may see and reissue someone else's card
        if(!empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_admin']) || is_system_admin()
           || !empty($_SESSION['honcho_ccmps_admin']) || !empty($_SESSION['honcho_ccmps_module_all']) || !empty($_SESSION['honcho_all_modules'])){
            return true;
        }
        if(!empty($_SESSION['ccmps_subentity_admin'])){ // Chapter Admins: their own chapter's members
            $member = $this->model->get_where((int) $ccmp_id, 'ccmps');
            return $member && (int) $member->subentity == (int) ($_SESSION['ccmps_subentity'] ?? -1);
        }
        return false;
    }

    function _token(){ // ties the reissue form to this session
        if(empty($_SESSION['cards_token'])){
            $_SESSION['cards_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['cards_token'];
    }

    function _audit($action, $ccmp_id, $what){
        $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', $action, 'welcome-cards', $un, $time, 'Rec: '.$ccmp_id, 'Tbl: ccmps_cards', $what);
    }

/*----------------------------------------------------------------------------*/
/*------------------------ function _CHECK_FUNCTION_PERMISSIONS --------------*/
/*----------------------------------------------------------------------------*/

    function _check_function_permissions($cardsfunction, $ccmp_id = NULL) {
    // mycard / reissue: a logged-in member (staff have no member card).
    // card: an admin who may manage that member (_can_manage()).

        if(empty($_SESSION['trongatetoken'])){ // not logged in at all
            set_flashdata('Your Session has expired - please login again.');
            $_SESSION['flashmsgcolor'] = 0;
            redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout');
        }

        switch($cardsfunction) {
          case 'mycard':
            if(empty($_SESSION['ccmp_logged_in']) && !$this->_can_manage((int) post('ccmp_id'))){
                set_flashdata('Member cards are for '.strtolower(CCMPS).' - log in with your '.strtolower(CCMP).' account.');
                $_SESSION['flashmsgcolor'] = 0;
                redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome/logout');
            }
            return "goodtogo";
          case 'card':
            if(!$this->_can_manage($ccmp_id)){
                set_flashdata('You are not authorized to see that card.');
                $_SESSION['flashmsgcolor'] = 0;
                redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome');
            }
            return "goodtogo";
        }
    }

} // end controller
