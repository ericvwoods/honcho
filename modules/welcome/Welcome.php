<?php
session_start();
if (defined('DEBUGGING') && DEBUGGING == true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
//session_start(); // not necessary - in ignition.php
/*----------------------------------------------------------------------------*/
/*--------------------------- module WELCOME ---------------------------------*/
/*------------------------------------------------------------------------------*/

/*--------------------------- function list ----------------------------------*/
/*
  index()          the Website when CMS_PUBLIC_SITE = 1, otherwise the login
  website()        the public website (content manager sections ticked for the public site)
  job()            a public job posting's page
  login()
  authenticate()
  secondfactor()
  secondfactor_check()
  successfullogin()
  logout()
  username_pw_check($usrname, $usrpw, $fprem, $fpusertype)
  getchangepassword()
  changepassword()

  forgotpassword() calls forgot_password form to get email address
  checkemail()     checks email from forgot_password form & emails token link
  checkresetlink() checks reset link for valid token & renders new_password form
  newpassword()    validates replacement from new_password form & saves

  _convert_level_id_to_name($tguserid)
  _hash_string($str)
  _verify_hash($plain_text_str, $hashed_string)
  _generate_rand_code()
  _clear_duplicate_cookies

*/
/*----------------------------------------------------------------------------*/
// Include PHPMailer
/* require statements break it
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
*/
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
*/
class Welcome extends Trongate {

// ************************************************************************** //
// **************************  function INDEX ******************************* //
// ************************************************************************** //

    function index() {
        if (CMS_PUBLIC_SITE == 1) { // this install's public website is the content manager's Website
            $this->website();
            return;
        }
        $this->login();
    }

// ************************************************************************** //
// *************************  function WEBSITE ****************************** //
// ************************************************************************** //

    function website() { // the public website; anyone, no login (also the preview when the front address goes to the login)
        $data['cms']              = cms_page('public', 0);
        $data['page_title']       = '';
        $data['page_description'] = SITENAME;
        $data['view_module']      = 'welcome';
        $data['view_file']        = 'website';
        $this->templates->website($data);
    }

// ************************************************************************** //
// ***************************  function JOB ******************************** //
// ************************************************************************** //

    function job() { // a public job posting (Careers posts ticked "Also on the public website")
        $today = date('Y-m-d');
        $rows  = $this->model->query_bind("SELECT p.*, m.file_name, m.alt_text FROM cms_posts p
                                             LEFT JOIN cms_media m ON m.id = p.media_id
                                            WHERE p.id = :id AND p.kind = 'job' AND p.active = 1 AND p.status = 'approved' AND p.is_public = 1
                                              AND (p.starts_on IS NULL OR p.starts_on <= :t1)
                                              AND (p.ends_on IS NULL OR p.ends_on >= :t2)",
                                          array('id' => intval(segment(3)), 't1' => $today, 't2' => $today), 'object');
        if (empty($rows)) {
            redirect('welcome/website#sec-careers');
        }
        $job          = $rows[0];
        $job->picture = $job->file_name ? cms_media_url($job->file_name) : '';

        $data['job']              = $job;
        $data['page_title']       = $job->title;
        $data['page_description'] = $job->summary !== '' ? $job->summary : $job->title;
        $data['view_module']      = 'welcome';
        $data['view_file']        = 'websitejob';
        $this->templates->website($data);
    }

// ************************************************************************** //
// **************************  function LOGIN ******************************* //
// ************************************************************************** //

    function login() { // draw login screen

 //   $this->adminlogin();

 //echo(64); die();
    $this->_clear_duplicate_cookies();
    $this->module('trongate_tokens');
    $this->trongate_tokens->_destroy();

    $flashdata =  $_SESSION['flashdata'];

    // Initialize certain session variables
    $_SESSION['flashdata']   =  $flashdata;
    $_SESSION['auditlogger'] = AUDITLOGGER;

//echo(32);
//json( $_SESSION); die();

    $view = "/security/login";
    $this->view($view);

 //   $this->module('honcho');
 //   $this->honcho->login();

    }

// ************************************************************************** //
// *********************  function ADMINLOGIN ******************************* //
// ************************************************************************** //

    function adminlogin() { // draw login screen

    $this->_clear_duplicate_cookies();
    $this->module('trongate_tokens');
    $this->trongate_tokens->_destroy();

    $flashdata =  $_SESSION['flashdata'];

    // Initialize certain session variables
    $_SESSION['flashdata']   =  $flashdata;
    $_SESSION['auditlogger'] = AUDITLOGGER;

//echo(84); die();
//json( $_SESSION); die();
    $this->module('honcho');
    $this->honcho->login();
   // $view = "/inspinia/login";
   // $this->view($view);

    }

// ************************************************************************** //
// **************************  function LOGOUT ****************************** //
// ************************************************************************** //

    function logout() {

    $ccmpactdata['last_logout'] = time();
    $ccmprecid = $_SESSION['ccmp_rec_id'];
//json($_SESSION); die();
    if(strlen($ccmprecid  > 0)){ // if logged in - otherwise selected login button on homepage
    $this->model->update($ccmprecid, $ccmpactdata, 'ccmps');
//echo(101); die();
    // Auditlog  - log values before resetting
    $type  = 'logout';
    $action = 'Logout successful';
    $func = 'welcome-logout';
    $un   = 'UN: '.$_SESSION['ccmp_username'];
    $format = 'minitime'; // I added to Timedate.php
    $this->module('timedate');
    $timestamp = time();
    $time   = $this->timedate->get_nice_date($timestamp, $format);
    $time = $time.' UTC';
    $str3 = 'CntMgr='.($_SESSION['ccmps_content_admin'] ?? '').' StuAdmin='.$_SESSION['ccmps_student_admin'].' ChpAdmin='.$_SESSION['ccmps_subentity_admin'] .' MemAdmin='.$_SESSION['ccmps_ccmp_admin'] .' SysAdmin='.$_SESSION['ccmps_system_admin'];

    $ip_address = 'IP: '.getenv("REMOTE_ADDR");

    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);
}
    // Unset all of the session variables.
//    $_SESSION = array(); //session_unset(); //session_destroy();
 //   session_destroy();
   // session_unset();
    $_POST    = array();
    $this->_clear_duplicate_cookies();

    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));

    $this->module('trongate_tokens');
    $this->trongate_tokens->_destroy();

/*
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
*/
    //$this->index();
 //   redirect('welcome/index');
    redirect('welcome/login');

    }

// ************************************************************************** //
// **********************  function AUTHENTICATE **************************** //
// ************************************************************************** //

    function authenticate(){ // validate inputs from login form

    /* Calls
        username_pw_check($fpun, $fppw, $fprem, $fpusertype)
        secondfactor()
        logevent()
     */

    // get posted inputs from the login form
    $fpun  = post('username', true);

    $fppw  = post('password', true);

    $fprem = post('remember', true);

    $fpdt  = post('mobileformat', true);

    if($fpdt == true){
        $_SESSION['device_type'] = 2;  // Mobile or tablet

    }else{
         $_SESSION['device_type'] = 1; // Computer
    }

    $fpusertype = 'none'; // set it to none and if still none after the checks then not found

    // check all entity tables to find user credentials if sharing same login box


    if($exists = $this->model->get_one_where('username', $fpun, 'ccmps')){
        $usr_obj = $this->model->get_one_where('username', $fpun, 'ccmps');
        $fpusertype   = 'ccmpuser';
        $acct_table = 'ccmps';
    }

    if($exists = $this->model->get_one_where('username', $fpun, 'honcho_user_accounts')){
        $usr_obj = $this->model->get_one_where('username', $fpun, 'honcho_user_accounts');
        $fpusertype   = 'sysuser';
        $acct_table = 'honcho_user_accounts';
    }
   // echo(196);
   // print_r($fpusertype); die();
    if($fpusertype == 'none'){  // if it is still none then username wasn't found

        // Auditlog
        $type  = 'login';
        $action = 'InvalidUsername';
        $func = 'welcome-authenticate';
        $un   = 'UN: '.$fpun; // attempted Username
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';

        $fppw = 'PW: '.$fppw;
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $fppw, $time, $ip_address);

        // Prepare flash message


        $flash_msg = 'Username & Password combination was not valid'; // username was not valid
        set_flashdata($flash_msg);

        redirect('welcome/login');  // login page
    }

    //print_r( $fpusertype ); die();

    // if make it this far then username was found and record in usr_obj
    // now need to authenticate credentials against whats on the record
    $result = $this->username_pw_check($fpun, $fppw, $fprem, $fpusertype);

    // passed un & pw check otherwise username_pw_check() would have redirected to login page
    $_SESSION['user_type']  = $fpusertype;
    $_SESSION['acct_table'] = $acct_table;
//echo(263);
//print_r($_SESSION['acct_table']); die();
    // to recreate obj in successfullogin() if pass all validations
    $_SESSION['username'] = $fpun;

    switch($acct_table){

        case ('ccmps'):
            $_SESSION['ccmp_rec_id']   = $usr_obj->id;
  //echo( $_SESSION['ccmp_rec_id']); die();
            // for interface
            $_SESSION['ccmp_username'] = $fpun;
            $_SESSION['ccmp_first']    = $usr_obj->first_name;
            $_SESSION['ccmp_last']     = $usr_obj->last_name;
            $_SESSION['minor']         = $usr_obj->minor;

            // get second factor verification value - in this case member number

            $sffn =  CCMP_SECOND_FACTOR_FIELD_NAME;
           // echo(259);
           // print_r($sffn); die();
            $_SESSION['second_factor'] = $usr_obj->ccmp_number;
          //  print_r($_SESSION['second_factor']); die();

        break;

            case ('honcho_user_accounts'):
            $_SESSION['honcho_user_rec_id']    = $usr_obj->id;

            // for interface
            $_SESSION['honcho_user_username']  = $fpun;
            $_SESSION['honcho_user_first']     = $usr_obj->first_name;
            $_SESSION['honcho_user_last']      = $usr_obj->last_name;

            // get second factor verification value from config.php
            $sffn =  SYSTEM_SECOND_FACTOR_FIELD_NAME;
            $_SESSION['second_factor'] = $usr_obj->$sffn;
            // print_r($_SESSION['second_factor']); die();

        break;

        default:
    }
    $_SESSION['last_ip_address'] = $usr_obj->ip_address;

/*
echo('Line 309');
echo('<br>');
echo('Passed un/pw check');
echo('<br>');
echo('$result: ');
print_r($result);
echo('<br>');
echo('$acct_table: ');
print_r($acct_table);
echo('<br>');
echo('$usr_obj: ');
json($usr_obj);
echo('<br>');
echo('$_SESSION: ');
json($_SESSION); die();


// Check to see if there are any holds on the account

    $locked = $usr_obj->locked;
    if($locked == 1){
        $flash_msg  = 'Your account has been locked. Please contact your Administrator.' ;
        set_flashdata($flash_msg);
//$this->login();
        redirect('welcome/login');  // redirect to login page
    }
/*
    $email_verified = $usr_obj->email_verified;
    if($email_verified == 0){
        $flash_msg  = 'You have not verified your email address. Please do so now or contact your Administrator.' ;
        set_flashdata($flash_msg);

        redirect('welcome/login');  // redirect to login page
    }
*/
    $inactive = $usr_obj->inactive;
    if($inactive == 1){
        $flash_msg  = 'Your account is inactive. Please contact your Administrator.' ;
        set_flashdata($flash_msg);
        redirect('welcome/login');  // redirect to login page
    }

/*
print_r($_SESSION['last_ip_address']);
echo('<br>');
print_r($getenv("REMOTE_ADDR");); die();
*/
    // if user is logging in from same machine they logged in from last time
    if($_SESSION['last_ip_address'] == getenv("REMOTE_ADDR")){
 //print_r('I know you'); die();
        $this->successfullogin();

    }

    // Run second factor check
    $this->secondfactor();

    // can bypass the second factor check by setting the constant
    // in the config file
    }

// ************************************************************************** //
// **********************  function SECONDFACTOR **************************** //
// ************************************************************************** //

    function secondfactor(){

    $data['view_module']   = 'welcome';
    $data['view_file']     = 'security/secondfactor'; //

     // template is the default location (templates/views/cool_mobi) using old engine, new engine uses public/themes/cool_mobi/black
     $this->templates->inspinia($data);
    }

    // ************************************************************************* //
    // ************************  function SECONDFACTOR_CHECK ******************* //
    // ************************************************************************* //

    function secondfactor_check(){

    if(WELCOME_BYPASS_2ND_FACTOR == true){


        $this->successfullogin();

    }

    // get posted input from the second factor form
    $second_factor  = post('second_factor', true);
//    echo(398);
//    echo('<br>');
//   print_r($second_factor); die(); // strips off leading zeros bug! ???
//
/*
echo('Line 405');
echo('<br>');
echo('Inputted 2nd Factor: ');
print_r($second_factor);
echo('<br>');
echo('Correct 2nd Factor: ');
print_r($_SESSION['second_factor']); // got from DB with successful un/pw ck above
json($_SESSION); die();
*/

    // Now you need to validate the second factor input against the correct one.
    // A blank second factor on record never matches (a blank entry used to pass),
    // and there is no shared temporary code any more (TEMP_2ND_FACTOR removed 2026-10-22):
    // an account with no second factor can't log in until one is set on its record.
    $correct_second_factor = isset($_SESSION['second_factor']) ? (string) $_SESSION['second_factor'] : '';

    if(strlen($correct_second_factor) > 0 AND hash_equals($correct_second_factor, (string) $second_factor)){  // valid second factor
//echo(256); die();
        $this->successfullogin();

    }else{
 //       echo(' they are NOT equal'); die();

        // Auditlog
        $type  = 'login';
        $action = 'Invalid2ndFactor';
        $func = 'welcome-validate2nd';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $str3 = 'SF: '.$second_factor;
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';

        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);
// xxx need cases for CCMP_SECOND_FACTOR_NAME and SYSTEM_SECOND_FACTOR_NAME
        $flash_msg = 'Your Second Factor was not valid'; // 2nd factor was not valid
        //$flash_msg = 'Your '.SECOND_FACTOR_NAME.' was not valid'; // 2nd factor was not valid
        set_flashdata($flash_msg);

        redirect('welcome/login');  // login page
    }
}

// ************************************************************************** //
// **********************  function SUCCESSFULLOGIN ************************* //
// ************************************************************************** //

    function successfullogin() {

    // New session id now the login has passed, so an id planted before login
    // (session fixation) is worthless. Session data is kept.
    session_regenerate_id(true);

    // Successful login at this point!
 // print_r(  $_SESSION['username']); die();
    // reconstite the usr_obj from before that has now passed all validations
    $usr_obj = $this->model->get_one_where('username', $_SESSION['username'], $_SESSION['acct_table']);
// echo(471);
//json($usr_obj);
//print_r($_SESSION['acct_table']); die();
     switch($_SESSION['acct_table']){

        case ('honcho_user_accounts'):

            // update account record with latest login parameters
            $upddata['last_login_device'] = $_SESSION['device_type']; // 1 - computer 2 - phone 3 - tablet/ipad
            $upddata['last_login'] = time();

            // get ip address of client machine for the Remeber Me functionalty
           $upddata['ip_address'] = getenv("REMOTE_ADDR");
            //json($upddata); die();

            $this->model->update($_SESSION['honcho_user_rec_id'], $upddata, 'honcho_user_accounts');

            break;

        case ('ccmps'):
 //         echo(450); die();
            // Set user id, username, etc.
            $_SESSION['tg_user_id']           = $usr_obj->trongate_user_id;
            $_SESSION['approved']             = $usr_obj->approved;
 //           $_SESSION['email_verified']       = $usr_obj->email_verified;
            $_SESSION['status']               = $usr_obj->status;
            $_SESSION['locked']               = $usr_obj->locked;
            $_SESSION['inactive']             = $usr_obj->inactive;
            $_SESSION['last_login']           = $usr_obj->last_login;
            $_SESSION['picture']              = $usr_obj->picture;

            // Font-size preference (tab/header/label/value/button) needs
            // no session handling — read fresh from ccmps directly in
            // inspinia.php on every page load.
            $_SESSION['language']             = $usr_obj->language; // manage page

            // Module specific
            $_SESSION['ccmps_subentity']       = $usr_obj->subentity;
            $_SESSION['ccmps_subentity_role']  = $usr_obj->subentity_role;  // used to set menu
            //
            // Set the frontend authorizations (super users ccmps, etc.)
            // get superuser rights — ccmps_ prefix means "scoped to this
            // module only"; an unprefixed equivalent (set separately by
            // the honcho module, once built) means enterprise-wide.
         //   $_SESSION['security_group']        = $usr_obj->security_group;
  //          $_SESSION['ccmps_lib_access']      = $usr_obj->libacclevel;
            $_SESSION['ccmps_subentity_admin'] = $usr_obj->subentity_admin;
            $_SESSION['ccmps_student_admin']   = $usr_obj->student_admin;
            $_SESSION['ccmps_ccmp_admin']      = $usr_obj->ccmp_admin;
  //          $_SESSION['ccmps_cms_admin']       = $usr_obj->cms_admin; // cms_admin not a confirmed real column on ccmps — left disabled
            $_SESSION['ccmps_system_admin']    = $usr_obj->system_admin;
            rbac_member_session_flags((int) $usr_obj->id); // RBAC step 5: the four roles come from Security Groups (columns above are the fallback)

            $_SESSION['honcho_national_officer'] = $usr_obj->national_officer;

 // field dont exist           $_SESSION['id_type']      = $usr_obj->id_type;

//echo(524);
//json($_SESSION); die();
            // get subentity data
            $subentityid                = $usr_obj->subentity;
            $subentityobj               = $this->model->get_where($subentityid,'ccmps_subentities');
            // What Chapter/Branch does user belong to
            $_SESSION['subentity_name'] = $subentityobj->description;
            $_SESSION['subentity_title'] = $subentityobj->title;

            // get flag to determine if should go to change password page after login
            $_SESSION['force_pw_chg']  = $usr_obj->force_pw_chg;
//echo(536);
//json($_SESSION); die();
            // Using the trongate user id go get the trongate user object and extract the level (assigned as 2 if self-registration account creation)
            $tg_user = $this->model->get_one_where('id', $_SESSION['tg_user_id'], 'trongate_users');

 // no user_level_id field  $_SESSION['tg_user_level'] = $tg_user->user_level_id;  // should be 7 (ccmp). Right now only used to control menu access in the backend
//echo(542);
//json($_SESSION); die();
            // update account record with latest login parameters (same cases as line 340)
            $upddata['last_login_device'] = $_SESSION['device_type']; // 1 - computer 2 - phone 3 - tablet/ipad
            $upddata['last_login'] = time();
            // get ip address of client machine for the Remeber Me functionalty
            $upddata['ip_address'] = getenv("REMOTE_ADDR");

            $this->model->update($_SESSION['ccmp_rec_id'], $upddata, 'ccmps');

        break;

        default:
    }

/*
// checkpoint 1
echo('Line 560');
echo('<br>');
echo('Successful Login!');
echo('<br>');
echo('$upddata: ');
json($upddata);
echo('<br>');
echo('$_SESSION: ');
json($_SESSION); die();
*/

/*  is this still true ???
 If you login as sysadmin to the front end you are automatically going to the ccmps module.
 It will get your ccmps rights from the honcho_user_table
 */

/**************  Extract module settings from table ***************************/

    // The financial settings live in system_settings (Financial tab of System
    // Settings; moved there from ccmps_financial_settings 2026-10-22), read by
    // title with setting(). Both legacy session variable names are still
    // populated (with the same value) since other parts of the app read one or the other.
    $system_current_year_val = intval(setting('system_current_year', 0));
    $grace_period_val        = intval(setting('grace_period', 0));

    $_SESSION['system_current_year'] = $system_current_year_val;
    $_SESSION['system_grace_period'] = $grace_period_val;
    $_SESSION['ccmps_current_year']  = $system_current_year_val;
    $_SESSION['ccmps_grace_period']  = $grace_period_val;

/* The "new content since last login" flags (new_notice, new_bulletin, new_activity, new_sunshine) were
   removed 2026-10-20 with the old CMS tables they read; nothing live showed them. */

/************* Log Login Information and go to Private Homepage  **************/

        switch($_SESSION['acct_table']){

        case ('honcho_user_accounts'):
             $_SESSION['system_logged_in'] = 1;
             $homepage = 'welcome-ccmps/ccmphome';
        break;

        case ('ccmps'):
             $_SESSION['ccmpmode'] = 'ccmp';
             $_SESSION['ccmp_logged_in'] = 1;
             $homepage = 'welcome-ccmps/ccmphome';
        break;

        default:
    }

        // Generic logged in indicator
        $_SESSION['logged_in'] = 1;

        // Auditlog
        $type  = 'login';
        $action = 'LoginSuccessful';
        $func = 'welcome-username_pw_check';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'CntMgr='.($_SESSION['ccmps_content_admin'] ?? '').' StuAdmin='.$_SESSION['ccmps_student_admin'].' ChpAdmin='.$_SESSION['ccmps_subentity_admin'] .' MemAdmin='.$_SESSION['ccmps_ccmp_admin'] .' SysAdmin='.$_SESSION['ccmps_system_admin'];
        $str4 = '$_SESSION[ccmp_logged_in] set TRUE';

        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $ip_address);

        // Check to see if you need to change your password
        if($_SESSION['force_pw_chg'] == 1){
            $flash_msg  = 'Your password has expired. Please change it now.' ;
            set_flashdata($flash_msg);

            $this->getchangepassword();
        }

        // go to the private area homepage
/*
        print_r('Welcome Line ~777 - going to PA homepage!');
        echo('<br>');
        echo('$homepage: ');
        print_r($homepage);
        echo('<br>');
        echo('$_POST: ');
        echo('<br>');
        json($_POST);
        echo('$usr_obj: ');
        echo('<br>');
        json($usr_obj);
        echo('<br>');
        echo('$_SESSION:');
        echo('<br>');
        json($_SESSION); die();
*/
        redirect($homepage);
}

// ************************************************************************** //
// ************************  FUNCTION MOBILE_BRIDGE  ************************* //
// ************************************************************************** //
    /**
     * Entry point for the mobile app's "Home" screen. The mobile app has no
     * PHP session at all (JWT/token auth only, via welcome-api), so this
     * exists to convert an already-valid JWT into a real, full web session —
     * letting the mobile app render this app's own live ccmphome page
     * (member counts, notices, everything) rather than maintaining a
     * separate, manually-synced copy of it.
     *
     * Deliberately does NOT duplicate any of successfullogin()'s own
     * session-establishment logic (dozens of variables, new-content checks,
     * force-password-change handling) — instead sets just the handful of
     * variables that function reads at its own start (mirroring what
     * authenticate() would normally have set after a real username/password
     * check passed), then calls straight into it. Any future change to the
     * real login flow's session setup automatically applies here too, since
     * this runs the exact same code path rather than a copy of it.
     *
     * Security note: trusts the JWT alone as proof of identity, skipping the
     * web login's own IP-based second-factor check — a deliberate choice,
     * confirmed acceptable given that check's rudimentary nature and the
     * fact the JWT itself was only ever issued after a real password check
     * (see Api.php's own login()). Revisit this if/when a stronger second
     * factor (e.g. a text code) replaces the current IP check.
     */
    function mobile_bridge() {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            redirect('welcome/login');
            return;
        }

        // Reuses the exact same, already-tested JWT class the mobile API
        // itself relies on — not a duplicated copy of it.
        require_once __DIR__ . '/api/lib/JwtHelper.php';

        if (!defined('JWT_SECRET') || strlen(JWT_SECRET) < 32) {
            redirect('welcome/login');
            return;
        }

        try {
            $claims = JwtHelper::decode($token, JWT_SECRET);
        } catch (Exception $e) {
            redirect('welcome/login');
            return;
        }

        if (empty($claims['ccmp_id'])) {
            redirect('welcome/login');
            return;
        }

        $ccmp = $this->model->get_where((int) $claims['ccmp_id'], 'ccmps');
        if (!$ccmp || !empty($ccmp->soft_deleted) || !empty($ccmp->deceased)) { // deceased members are refused login
            redirect('welcome/login');
            return;
        }

        // Minimal prerequisite state successfullogin() itself reads at its
        // start. ccmp_rec_id was the one genuinely missing piece,
        // confirmed via a real crash: it's set by authenticate() in the
        // normal login flow (before successfullogin() ever runs there),
        // and successfullogin() reads it directly for its own
        // ccmps.update() call — omitting it here passed null where an
        // int was required.
        //
        // device_type = 1 (not 2) is deliberate, confirmed against a
        // real screenshot showing what device_type == 2 actually does:
        // ccmphome.php has a SECOND, separate device_type == 2 block
        // (distinct from the sidebar include) that swaps in an entirely
        // different, simplified "mobile menu" list in place of the rich
        // dashboard content — not just hiding the sidebar the way it
        // was first assumed to. Using 1 avoids that block and the
        // regular sidebar include's OWN device_type != 2 condition both
        // render normally, so the sidebar is instead suppressed purely
        // via CSS below — independent of this flag, so it doesn't
        // disturb whatever else in this app relies on device_type's
        // existing meaning.
        //
        // ccmpssidemenu is a completely SEPARATE switch from
        // device_type, confirmed by tracing it through ccmphome.php,
        // Ccmps.php's own adminmenu()/ccmpmenu() routes, and the fact
        // it's never set anywhere in Welcome.php's normal login flow at
        // all. It toggles rich admin dashboard content vs a simplified
        // "Member Services Portal" — set to '' (not 'admin') on purpose:
        // the mobile app deliberately has no admin functionality for
        // now, confirmed after 'admin' was tried and showed a full
        // Chapter Administration dashboard, not what was wanted.
        // Matches Ccmps::ccmpmenu()'s own "member button sidemenu
        // default" value exactly.
        $_SESSION['username']       = $ccmp->username;
        $_SESSION['acct_table']     = 'ccmps';
        $_SESSION['device_type']    = 1;
        $_SESSION['ccmp_rec_id']    = $ccmp->id;
        $_SESSION['ccmpssidemenu']  = '';
        // Dedicated flag inspinia.php checks to hide the sidebar via
        // CSS — deliberately separate from device_type, which has its
        // own, different meaning elsewhere on this page (see comment
        // block above).
        $_SESSION['mobile_app_view'] = true;

        $this->successfullogin();
    }


// ************************************************************************** //
// ********************** FUNCTION USERNAME_PW_CHECK ************************ //
// ************************************************************************** //

  function username_pw_check($usrname, $usrpw, $fprem, $fpusertype){  // check to see if the username exists then checks the password

    // the username was already validated to get this far, checking again is overkill unless you use this function not as a callback

    // Now lets go to the proper table and get the credentials to compare with what was passed in

    switch($fpusertype){
        case ('sysuser'):
                $user_obj = $this->model->get_one_where('username', $usrname, 'honcho_user_accounts');

        break;

        case ('ccmpuser'):
                $user_obj = $this->model->get_one_where('username', $usrname, 'ccmps');

        break;

        default:

    }

/*
echo(823);
echo('<br>');
json($user_obj);
echo('<br>');
json($_SESSION); die();
*/

// We already know the record exists because we checked that the username existed before.
    if ($user_obj == false) {  // if came thru mobilogin this was already done so wont fail (same test)
    //    cant really get here because its existance was checked earlier on line 3221 in authenticate(). ???
          // Prepare flash message
          $flash_msg = 'Username & Password combination was not valid';
          set_flashdata($flash_msg);

//        echo('677 Bad username - need a redirect - not in this controller anymore'); die();
          $this->login();

    }else{ // username always exist because was checked by authenticate(), now check the password

        $savedpw = $user_obj->password;
 // print_r( $usrpw);
 // print_r($savedpw); die();

        $password_result = $this->_verify_hash($usrpw, $savedpw);

//  print_r('848 password_result:');
//  print_r($password_result); die();

        if ($password_result == false) { // failed password check

        // Auditlog
        $type  = 'login';
        $action = 'InvalidPassword';
        $func = 'welcome-username_pw_check';
        $un   = 'UN: '.$_POST['username'];
         $format = 'minitime'; // I added to Timedate.php
         $this->module('timedate');
         $timestamp = time();
         $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'PW: '.$usrpw; // attempted PW

        $ip_address = 'IP: '.getenv("REMOTE_ADDR");

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);
          //  echo(825); die();
          // Prepare flash message
          $flash_msg = 'Username & Password combination was not valid'; // Username Valid - PW not valid (line 2067 Invalid Username)
          set_flashdata($flash_msg);

            // echo('line 668 Bad password - go back to login'); die();
             redirect('welcome/login');  // login page

        }else{ // password was correct - username already verified but havent done the secondfactor at this point
            // doing these checks before second factor is validated
            // check to make sure the account has been verified and activated
   //         echo(836); die();
            // change to email verification for self registration
            $email_verified = 1; // $user_obj->email_verified;
            $approved      = $user_obj->unapproved;
            $inactive      = $user_obj->inactive;
            $locked        = $user_obj->locked;
            $soft_deleted  = $user_obj->soft_deleted;

// run checks on valid account before going to homepage/main menu screen
// or all these checks could be moved to after the second factor is validated like force_pw_chg is in a two factor situation

            if ($email_verified == 0){  //
                //$error = 'Your account has not been verified. Please use the verification code or link in the email sent to you when the account was created or contact the System Administrator.';
                //return $error;
//echo "1220 email unverified";
//print_r($emailverified ); die();
                $flash_msg = 'You have not verified your email address. Please do so now or contact your Administrator';
                set_flashdata($flash_msg);
                $this->mobilogin();
            }

            if ($unapproved > 0){
                $error = 'Your account has not been approved yet.';
                return $error;
            }
            if ($inactive > 0){
                $error = 'Your account is inactive. Please contact the System Administrator.';
                return $error;
            }
            if ($locked > 0){ // shown on the login page - returning an error here was ignored by authenticate()
                $who = ($fpusertype == 'ccmpuser') ? 'your '.SUBENTITY.' Administrator' : 'your System Administrator';
                $flash_msg = 'Your account has been locked. Please contact '.$who.'.';
                set_flashdata($flash_msg);
                redirect('welcome/login');
            }
            if ($soft_deleted > 0){ // shown on the login page - returning an error here was ignored by authenticate()
                $flash_msg = 'Your account has been deleted. Please contact the System Administrator.';
                set_flashdata($flash_msg);
                redirect('welcome/login');
            }
            if ($fpusertype == 'ccmpuser' && !empty($user_obj->deceased)){ // deceased members are refused login - before any token is made
                $flash_msg = 'This account is no longer active. Please contact your Administrator.';
                set_flashdata($flash_msg);
                redirect('welcome/login');
            }

            $remember = $fprem;
          //  $remember = post('remember', true);  // 1 if box checked
/*
print_r('Welcome line 911: ');
print_r('remember: ');
print_r($remember); die();
*/
            $this->module('trongate_tokens');  // I used [] instead of () and there was no error but it didn't work

            $token_data['user_id'] = $user_obj->trongate_user_id;

            if ($remember == 1) { // set 3 day token (uses a cookie)
  //echo(1268); die();
             //   $thirty_days = 86400*30;
                $three_days = 86400*3;
                $nowtime = time();
                $token_data['expiry_date'] = $nowtime+$three_days;
                $token_data['set_cookie'] = true;

                $_SESSION['trongatetoken'] = $this->trongate_tokens->_generate_token($token_data);


            } else { // set short term token (uses a session)

                if (ENV == 'prod') {

                    $_SESSION['trongatetoken'] = $this->trongate_tokens->_generate_token($token_data);

                }else{ // 3 days if not production
                    $three_days = 86400*3;
                    $nowtime = time();
                    $token_data['expiry_date'] = $nowtime+$three_days;
                    $token_data['set_cookie'] = true;

                    $_SESSION['trongatetoken'] = $this->trongate_tokens->_generate_token($token_data);
                }

            }

            return true; // password was correct - also set a cookie or token after verified correct - line 378

        }
    }
   }


// ************************************************************************** //
// **********************  function GETCHANGEPASSWORD *********************** //
// ************************************************************************** //

    function getchangepassword() {

      $view = "/security/changepassword"; // must have leading / in some hosting environments
      $this->view($view); // dont pass $data cause doesnt exist here and causes 500 error

    }

// ************************************************************************** //
// ************************  function CHANGEPASSWORD ************************ //
// ************************************************************************** //

    function changepassword() {

    // Get the input values
    $un   = $_SESSION['ccmp_username'];
    $opw  = post('currentpassword', true);
    $npw  = post('newpassword', true);
    $cpw  = post('repeatnewpassword', true);
  //  print_r($un); die();
/*
echo('Line 108 ');
print_r($opw);
print_r($npw);
print_r($cpw); die();
*/
    // Validate the new password is up to standards  // MINPWLGTH

    //  $this->validation_helper->set_rules('newpassword', 'New Password', 'required|min_length[6]|max_length[50]');
    //  $result = $this->validation_helper->run();
$result = 1;

      if($result == 1){
            //  echo "passed"; die();
            // If passed do nothing or add more validations here
            if($npw == 'password'){
                // Prepare flash message
                $flash_msg = 'New password cannot be "password"... please try again';
                set_flashdata($flash_msg);
                $this->getchangepassword();
            }
            if($npw == 'Password'){
                          // Prepare flash message
                $flash_msg = 'New password cannot be "Password"... please try again';
                set_flashdata($flash_msg);
                $this->getchangepassword();
            }
            if($npw == 'Pa$$w0rd'){
                          // Prepare flash message
                $flash_msg = 'New password cannot be "Pa$$w0rd"... please try again';
                set_flashdata($flash_msg);
                $this->getchangepassword();
            }


        }else{ // this probably wont run because default validation helper message should show
            // Prepare flash message
            $flash_msg = 'Your new password was not long enough...please try again';
            set_flashdata($flash_msg);

                $this->getchangepassword();
        }
//echo(420); die();
        if($npw == $cpw){ // validate form input
//echo(422); die();
        // validate old password
            $ccmpacct_obj = $this->model->get_one_where('username', $un, 'ccmps');
//print_r($opw);
//print_r($ccmpacct_obj->password); die();
            $password_result = $this->_verify_hash($opw, $ccmpacct_obj->password);
 //echo(428);
//print_r($password_result);  die();
//echo('Line 169 - password Result '); die();
            if ($password_result == 1){

              // Save the new password & reset the force pw change flag to no
              $npwdata['password'] = $this->_hash_string($npw);

              // reset the force password change flag
              $npwdata['force_pw_chg'] = 0;

      //echo('Line 176 - new ccmp password data '); die();
              $this->model->update($ccmpacct_obj->id, $npwdata, 'ccmps');

                // Auditlog
                $type  = 'security';
                $action = 'Password Change';
                $func = 'welcome-changepassword';
                $un   = 'UN: '.$_SESSION['ccmp_username'];
                 $format = 'minitime'; // I added to Timedate.php
                 $this->module('timedate');
                 $timestamp = time();
                 $time   = $this->timedate->get_nice_date($timestamp, $format);
                $time = $time.' UTC';
                $str3 = 'CntMgr='.($_SESSION['ccmps_content_admin'] ?? '').' StuAdmin='.$_SESSION['ccmps_student_admin'].' ChpAdmin='.$_SESSION['ccmps_subentity_admin'] .' MemAdmin='.$_SESSION['ccmps_ccmp_admin'] .' SysAdmin='.$_SESSION['ccmps_system_admin'];

                $ip_address = 'IP: '.getenv("REMOTE_ADDR");

//echo ("MADE IT"); die();
//print_r($type); print_r($action); print_r($func);print_r($un);print_r($time);print_r($str3); die();
                $this->module('system-auditlogger');
 //echo ("MADE IT"); die();
                $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);

    //print_r($password_result);
    //echo('Line 185 - successfully changed password '); die();
              // prepare the success message
              $flash_msg = 'Your Password Was Successfully Changed';
              set_flashdata($flash_msg);

              // reset session variable
              $_SESSION['force_pw_chg'] = 0;

              // reset the change password flag force_pw_chg in the database to 0
              $data['force_pw_chg'] = 0;
              $update_id = $_SESSION['ccmp_rec_id'];
              $this->model->update($update_id, $data, 'ccmps');
  //print_r('459'); die();

              $_SESSION['ccmp_logged_in'] = 1;
              redirect('welcome-ccmps/ccmphome');

            }else{

                // Auditlog
                $type  = 'security';
                $action = 'Failed Password Change';
                $func = 'welcome-changepassword';
                $un   = 'UN: '.$_SESSION['ccmp_username'];
                 $format = 'minitime'; // I added to Timedate.php
                 $this->module('timedate');
                 $timestamp = time();
                 $time   = $this->timedate->get_nice_date($timestamp, $format);
                $time = $time.' UTC';
                $str3 = 'CntMgr='.($_SESSION['ccmps_content_admin'] ?? '').' StuAdmin='.$_SESSION['ccmps_student_admin'].' ChpAdmin='.$_SESSION['ccmps_subentity_admin'] .' MemAdmin='.$_SESSION['ccmps_ccmp_admin'] .' SysAdmin='.$_SESSION['ccmps_system_admin'];

                $ip_address = 'IP: '.getenv("REMOTE_ADDR");

//echo ("MADE IT"); die();
//print_r($type); print_r($action); print_r($func);print_r($un);print_r($time);print_r($str3); die();
                $this->module('system-auditlogger');
 //echo ("MADE IT"); die();
                $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $ip_address);

                // Prepare flash message
                $flash_msg = 'Your current password was incorrect...please try again';
                set_flashdata($flash_msg);
//echo(465); die();
                    $this->getchangepassword();

            }

        }else{
        // error passwords dont match
//echo(474); die();
            // Prepare flash message
            $flash_msg = 'The New & Repeat Passwords do not match';
            set_flashdata($flash_msg);

                $this->getchangepassword();

        }// if newpassword = confirmpassword

    }


// ************************************************************************** //
// ************************  function FORGOTPASSWORD ************************ //
// ************************************************************************** //

    function forgotpassword() { //calls forgot_password to get email address

    $view = "/security/forgot_password";
    $this->view($view);

    }

// ************************************************************************** //
// ************************  function CHECKEMAIL ************************ //
// ************************************************************************** //

    function checkemail() { //checks email address from forgot_password form
                              // and emails token link

     $resetemail             = $_POST['username'];
     $resetemail             = trim($resetemail);

    //if email exists in ccmp table then render new password form

    if($exists = $this->model->get_one_where('username', $resetemail, 'ccmps')){
        //echo('Exists'); die();
        $_SESSION['resetemail'] =  $resetemail; // for newpassword()
        $ccmp_obj = $this->model->get_one_where('username', $resetemail, 'ccmps');
//json($ccmp_obj); die();

//var_dump(class_exists(\PHPMailer\PHPMailer\PHPMailer::class));die();

// compose email and embed reset token
$resettoken = $ccmp_obj->reset_code;
//print_r($resettoken); die();

// send email with reset link

$mail = new PHPMailer(true);
try {
    //Enable verbose debug output
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //Send using SMTP
    $mail->isSMTP();
    //Set the SMTP server to send through
    $mail->Host = SMTP_HOST;
    //Enable SMTP authentication
    $mail->SMTPAuth = true;
    //SMTP username
    $mail->Username = SMTP_USERNAME;
    //SMTP password
    $mail->Password = SMTP_PASSWORD; // from .env
    //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //TCP port to connect to; use 587 if you have set 'SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS'
    $mail->Port = SMTP_PORT;

    //Add a recipient - From inputted email address
    $mail->addAddress('evw123@gmail.com');

    //Content
    //Set email format to HTML
    $mail->isHTML(true);
    $mail->Subject = 'Honcho Password Reset';
    $mail->Body    = '<strong>Here is your requested password reset link: https://honcho.cloud/welcome/checkresetlink/HeWRSXwHLvmNqC79</strong>';
    $mail->AltBody = 'We have successfully received your registration.';

    $mail->send();
    echo 'Successfully sent';
} catch (Exception $e) {}
//echo(1178); die();
// log email sent

          // Auditlog
        $flash_msg = '1-If it exists an email has been sent.  Check your junk mail too!'; //
        set_flashdata($flash_msg);
  //              $flashmsgisset = 1;
        $_SESSION['flashmsgcolor'] = 1; //
        $type  = 'security';
        $action = 'ResetEmailSent';
        $func = 'welcome-checkemail';
        $un   = 'UN: '.$resetemail;
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

         redirect('welcome/login');
// for testing
//    $view = "/security/new_password";
//    $this->view($view);

    }else{
        // if doesnt exist just log the attempt & return to login page
          // Auditlog
        $flash_msg = '0-If it exists an email has been sent.  Check your junk mail too!'; //
        set_flashdata($flash_msg);
  //              $flashmsgisset = 1;
        $_SESSION['flashmsgcolor'] = 1; //
        $type  = 'security';
        $action = 'InvalidFPemail';
        $func = 'welcome-checkemail';
        $un   = 'UN: '.$resetemail;
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

        // return to login page
//  echo('Dont Exist'); die();
           redirect('welcome/login');

    }





    }

// ************************************************************************** //
// ************************  function CHECKRESETLINK ************************ //
// ************************************************************************** //

    function checkresetlink() { //checks reset link for valid token & renders new_password form

    // check reset link for valid token
    $returnedtoken = segment(3);
//print_r($returnedtoken); die();

     // use the token to find the ccmp account if valid
if($ccmpusracct_obj = $this->model->get_one_where('reset_code', $returnedtoken, 'ccmps')){

   $_SESSION['resetemail'] = $ccmpusracct_obj->username;
   $_SESSION['ccmpid'] = $ccmpusracct_obj->id;

//echo (1217);
//echo('<br>');
//json($_SESSION); die(); // resetemail, ccmpid

    // render new password form
    $view = "/security/new_password";
    $this->view($view);

}else{ // returned token was not valid

          // Auditlog
        $flash_msg = 'Your password reset link is invalid. Contact the System Administrator.'; //
        set_flashdata($flash_msg);
  //              $flashmsgisset = 1;
        $_SESSION['flashmsgcolor'] = 0; //
        $type  = 'security';
        $action = 'ResetLinkCheck';
        $func = 'welcome-checkresetlink';
        $un   = 'UN: '.$resetemail;
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

         redirect('welcome/login');

};


    }

// ************************************************************************** //
// ************************  function NEWPASSWORD ************************ //
// ************************************************************************** //

    function newpassword() { // validates replacement from new_password form & saves
                             // Secured by token match instead of current password
//echo('newpassword'); die();
    // Get the input values from new password form

    $npw = $_POST['newpassword'];
    $cpw = $_POST['repeatnewpassword'];

/*
echo('Line 1188');
echo('<br>');
print_r($npw);
echo('<br>');
print_r($cpw);
echo('<br>');
print_r($_POST);
echo('<br>');
print_r($_SESSION); die();
*/
    // Validate the new password is up to standards  // MINPWLGTH

    //  $this->validation_helper->set_rules('newpassword', 'New Password', 'required|min_length[6]|max_length[50]');
    //  $result = $this->validation_helper->run();
$result = 1;

      if($result == 1){
            //  echo "passed pw requirements"; die();
            // If passed do nothing or add more validations here

            if($npw == 'password'){
                // Prepare flash message
                $flash_msg = 'New password cannot be "password"... please try again';
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                   // render new password form
    $view = "/security/new_password";
    $this->view($view);
            }
            if($npw == 'Password'){
                          // Prepare flash message
                $flash_msg = 'New password cannot be "Password"... please try again';
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                  // render new password form
    $view = "/security/new_password";
    $this->view($view);
            }
            if($npw == 'Pa$$w0rd'){
                          // Prepare flash message
                $flash_msg = 'New password cannot be "Pa$$w0rd"... please try again';
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                 // render new password form
    $view = "/security/new_password";
    $this->view($view);
            }


        }else{ // passed $result = 1 validation


        }

//echo(1242);
//echo('<br>');
//echo('passed pw requirement validation'); die();

        if($npw == $cpw){ // validate form input
//echo(1247);
//echo('<br>');
//echo('passwords matched'); die();

 $resetemail = $_SESSION['resetemail'];
 $resetemail = trim($resetemail);
 //print_r($resetemail); die();
 $ccmpacct_obj = $this->model->get_one_where('username', $resetemail, 'ccmps');
//json($ccmpacct_obj); die();
              $usrid = $ccmpacct_obj->id;
//print_r($usrid); die();

              // Save the new password & reset the force pw change flag to no
              $npwdata['password'] = $this->_hash_string($npw);

              // reset the force password change flag
              $npwdata['force_pw_chg'] = 0;
//print_r($npwdata['password']); die();

             // reset session variable
              $_SESSION['force_pw_chg'] = 0;

              // reset the change password flag force_pw_chg in the database to 0
              $npwdata['force_pw_chg'] = 0;

              // replace the token since it was shown in the url
              $npwdata['reset_code'] = $this->_generate_rand_code(); // 16 characters

              $update_id = $_SESSION['ccmpid'];
              $this->model->update($update_id, $npwdata, 'ccmps');
//print_r('1369'); die();

          // Auditlog
        $flash_msg = 'Your password has been successfully reset. Please login.'; //
        set_flashdata($flash_msg);
        $_SESSION['flashmsgcolor'] = 1; //
        $type  = 'security';
        $action = 'resetFP';
        $func = 'welcome-newpassword';
        $un   = 'UN: '.$resetemail; //  ??? not passed?
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'RoleId: '.$_SESSION['user_role_id'];
        $str4 = 'TGUID: '.$_SESSION['tg_user_id'];
        $str5 = 'Name: '.$_SESSION['whoisit'];
        $ip_address = 'IP: '.getenv("REMOTE_ADDR");
        $str6 =  $ip_address;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func,$str5, $str6, $un, $time, $str3, $str4);

        redirect('welcome/login');
    //    redirect('welcome-ccmps/ccmphome');
        }else{
        // error passwords dont match
//echo(1302);
//echo('<br>');
//echo('passwords dont match'); die();
            // Prepare flash message
            $flash_msg = "New & Repeat Passwords don't match. Please try again.";
            set_flashdata($flash_msg);
           $_SESSION['flashmsgcolor'] = 0;

      $view = "/security/new_password";
    $this->view($view);

        }// end if newpassword = confirmpassword

    }


// ************************************************************************** //
// ******************  function _CONVERT_LEVEL_ID_TO_NAME ******************* //
// ************************************************************************** //

    function _convert_level_id_to_name($tguserid){

    // Do conversions
        // get tg user level and convert to text
        // pull out the user_level_id from
        $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');
  // json($tguserobj); die();
        $tguserlevel = $tguserobj->user_level_id;

        // Get the name of the trongate_user_level
        $tguserlevelobj = $this->model->get_one_where('id', $tguserlevel, 'trongate_user_levels');
      //   json($tguserlevelobj); die();

        // Convert the User Level to a user friendly name
        if($tguserlevel > 0){
          $tguserlevelname = $tguserlevelobj->level_title;
        }else{
          $tguserlevelname = "None";
        }
      //  echo('Line 162 - tguserlevelname: ');
    //  print_r($tguserlevelname); die();

      return $tguserlevelname;
    }

// ************************************************************************** //
// *********************** function _HASH_STRING **************************** //
// ************************************************************************** //

function _hash_string($str){

    //       echo('in hasher'); die();

           $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
               'cost' => 11 ));

           return $hashed_string;
       }

    function _verify_hash($plain_text_str, $hashed_string){

       $result =  password_verify($plain_text_str, $hashed_string);

       return $result; // true or false
    }

/*----------------------------------------------------------------------------------------------*/

    // generate a random 16 character code for unique ids
    function _generate_rand_code() {
      $token_length = 16;  // one, L, "oh", and zero removed to eliminate confusion
      $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
      $random_code = '';
      for ($i = 0; $i < $token_length; $i++) {
          $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
      }
      $random_code = $random_string;
     // echo('Line 1117 Random PW ');
      //print_r($random_pw); die();

      return $random_code;
    }

/**
* Every time you call session_start(), PHP adds another
* identical session cookie to the response header. Do this
* enough times, and your response header becomes big enough
* to choke the web server.
*
* This method clears out the duplicate session cookies. You can
* call it after each time you've called session_start(), or call it
* just before you send your headers.
*/
function _clear_duplicate_cookies() {

    // If headers have already been sent, there's nothing we can do
    if (headers_sent()) {
        return;
    }

    $cookies = array();
    foreach (headers_list() as $header) {
        // Identify cookie headers
        if (strpos($header, 'Set-Cookie:') === 0) {
            $cookies[] = $header;
        }
    }
    // Removes all cookie headers, including duplicates
    header_remove('Set-Cookie');

    // Restore one copy of each cookie
    foreach(array_unique($cookies) as $cookie) {
        header($cookie, false);
    }
}


}
