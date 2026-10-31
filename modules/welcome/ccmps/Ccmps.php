<?php

/*----------------------------------------------------------------------------*/
/*------------------------ module WELCOME-CCMPS ------------------------------*/
/*----------------------------------------------------------------------------*/

/*--------------------------- function list ----------------------------------*/
/*
  index()
        _check_function_permissions($ccmpsfunction)
  adminmenu()
  ccmpmenu()
  ccmphome()
        _check_function_permissions($ccmpsfunction)
  mydata
        _get_a_single_record($recid) anchor1
        _convert_to_user_friendly($data_sr)
  _get_a_single_record($recid)
  viewccmp($recid = NULL)
        _check_function_permissions($ccmpsfunction, $recid)
        _get_font_sizes()
        _get_a_single_record($recid)  anchor1
        _convert_to_user_friendly($data)  anchor3
  manage()
        _check_function_permissions($ccmpsfunction)
        _get_font_sizes()
        _get_a_single_record($recid) anchor1
  updateccmp($retrying)
        _get_a_single_record($recid) anchor1
        _convert_null_integers_to_zeros($data) anchor4
  createccmp($retrying)
        _get_font_sizes()
        _create_dropdowns()1975
  ccmpsubmit()
        $this->validation_helper
        _ccmps_fetch_data_from_post() anchor2
        _addr_simple_fetch_data_from_post()
        recalcstatus($recid)
        _addr_fetch_data_from_post()
        viewccmp($recid)
        _generate_rand_code()
        _get_a_single_record($new_id) anchor1
        _convert_to_user_friendly($data) anchor3
        updateccmp('yes')
        createccmp('yes')
  _ccmps_fetch_data_from_post() anchor2
  _addr_simple_fetch_data_from_post($mailrecid,$physrecid)
  _financial_fetch_data_from_post()
  _convert_posted_fintbl_to_numerics($data = NULL)
  _user_fetch_data_from_post()
  _get_subentity_data()
  _create_dropdown_menus()
  _convert_to_user_friendly($data) anchor3
        Change codes to names
        Convert the Binary Yes/No fields
  _convert_null_integers_to_zeros($data) ancho4
  bulkaction()
        _check_function_permissions($ccmpsfunction)
        recalcstatus($mcid)
        _generate_rand_code()
  fontsize()
  createccmpuseraccount($reposted=NULL)
        ccmpuseracctsubmit($data)
        _get_font_sizes()
        ccmpuseracctsubmit($data)
  ccmpuseracctsubmit($data = NULL)
        _generate_rand_code()
        recalcstatus($recid)
  currentroster($posterid = null)
        _check_function_permissions($ccmpsfunction)
        _get_font_sizes()
        _get_a_single_record($recid) anchor1
        _member_select()
        _first_aircraft($ccmp_id)
  currentdirectory($posterid = null)
        _check_function_permissions($ccmpsfunction)
        _get_font_sizes()
        _member_select()
        _first_aircraft($ccmp_id)
  _member_select() // "SELECT ... FROM ccmps" with ccmps_aux joined when CCMPS_AUX_MODULE is on
  _first_aircraft($ccmp_id) // the member's first ccmps_aircraft row, or false
  function spreadsheet_format_download()
  function ccmpupload()
  function upload_form()
  function export()
        _member_select()
        _first_aircraft($ccmp_id)
  function mastercurrentroster($recid = null)
        _member_select()
        _first_aircraft($ccmp_id)
  function lesxlsfile()
  function _generate_rand_code()
  function modaladdemail()
  modalresetpw()
  modalchangepw()
  _hash_string($str)
  function lockacct()
  function unlockacct()
  function delrecord()
  function undelrecord()
  function helpdocs() // now redirects to help/guide/developer (Help pages, 2026-10-29)
  function managefontsizes() // system_admin CRUD for all ccmps_settings display values (size + color)
  function savefontsizesettings() // saves all 15 ccmps_settings pixel values at once
  function permdelete() // permanent cascading delete: ccmps + ccmps_aux + ccmps_addresses
  _get_user_token_expiration($tguserid2)
  _convert_level_id_to_name($tguserid)
  uploadccmppic($recid)
  _init_picture_settings()
  submit_upload_picture($update_id)
        _init_picture_settings()
        _make_sure_got_destination_folders($update_id, $picture_settings)
        upload_picture($config)
  _make_sure_got_destination_folders($update_id, $picture_settings)
  ditch_picture($update_id)
  _reset_cart_dropdown()
  recalc_totals($data)
  _check_function_permissions($ccmpsfunction, $recid = NULL)
  _get_font_sizes()
  refreshmysessiondata()
  recalcstatus($recid)
  numval($type, $vallimit, $val)
  events($id = NULL)
  sponsors()
  sendsponsorsformemail()
  _creds_fetch_data_from_post()

*/

/* SECURITY SESSION VARIABLES  - Logged in as CCMP
 USED
 ccmps_admin
 ccmps_subentity_admin
 ccmps_student_admin
 ccmps_cms_admin
 ccmps_system_admin
 ccmp_logged_in
 logged_in

 NOT USED
 ccmps_lib_access
 tg_user_level
*/

/* SECURITY SESSION VARIABLES  - Logged in as Honcho Admin
/* Honcho CCMP Module Roles

    $_SESSION['honcho_sysadmin']      is honcho_user_accounts->honcho_honcho_admin;
    $_SESSION['honcho_ccmps_admin']    is honcho_user_accounts->ccmp_admin;  // "member" admin

USED
 honcho_sysadmin
 honcho_ccmps_admin

 NOT USED
 authenticated
 dms_lib_access
 honcho_logged_in
 sysadmin
 admin
 assistadmin
 subadmin
 cmsadmin
 ccmpsadmin
 useradmin
 */

/* Add-ins

*/
/*----------------------------------------------------------------------------*/

//require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ccmps extends Trongate {

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'welcome';
      $this->child_module  = 'ccmps';

    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module = '';
    }

/*----------------------------------------------------------------------------*/
/*---------------------------- function INDEX --------------------------------*/
/*----------------------------------------------------------------------------*/

  function index() {

// $ccmpsfunction = 'index';
// $authorized = $this->_check_function_permissions($ccmpsfunction);

  // Get font size preference for views & manage page
  $this->_get_font_sizes();

// echo "Welcome-ccmps-index()"; die();

  }

/*----------------------------------------------------------------------------*/
/*-------------------------- function ADMINMENU ------------------------------*/
/*----------------------------------------------------------------------------*/

    function adminmenu(){

 $_SESSION['ccmpssidemenu'] = 'admin'; // admin menu
 redirect('welcome-ccmps/ccmphome');

  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function CCMPMENU ------------------------------*/
/*----------------------------------------------------------------------------*/

    function ccmpmenu(){

    $_SESSION['ccmpssidemenu'] = ''; // member button sidemenu default
    redirect('welcome-ccmps/ccmphome');
  }

/*----------------------------------------------------------------------------*/
/*--------------------------- function CCMPHOME ------------------------------*/
/*----------------------------------------------------------------------------*/

    function ccmphome() {
//echo(225); die();
    $checkfunction = 'ccmphome';
    // $authorized = $this->_check_function_permissions($checkfunction);

//echo(228); die();
    $_SESSION['ccmp_active_window'] = 0; // start with all member record tabs close

    if(strlen($_SESSION['tg_user_id']) > 0){
        // ok do nothing
    }else{
        $_SESSION['flashdata'] = 'Your Session has expired - please login again.';
        set_flashdata($_SESSION['flashdata']);

        // you logged out or session timed out - login again
        redirect('welcome/login'); // clears everything then takes to login page
    }

/*--------------------- Calculate the Metrics/Statistics  --------------------*/

    $currentyear = $_SESSION['ccmps_current_year'];
    $subentity   = $_SESSION['ccmps_subentity'];
//echo(248); print_r($subentity); die();

    /* Total records in ccmps table  */
    $_SESSION['num_ccmps_records']  = $this->model->count('ccmps');

    /* Totalotal ccmps not deleted or deceased */
    $sql = "SELECT * FROM ccmps WHERE deceased != 1  AND soft_deleted != 1";
    $allccmps = $this->model->query($sql,'array');
    $_SESSION['num_total_ccmps'] = count($allccmps, COUNT_NORMAL);
//echo(254); die();
    // These calculations do not take into account a grace period
    // If you want to take into account a grace period ypu must use status field
    // instead because that gets recalculated as grace period is turned on and off

    /* Current ccmps */

    $cy = $currentyear - 1; // since using > in $sql not >=
    $sql = "SELECT * FROM ccmps WHERE deceased != 1  AND soft_deleted != 1 AND current_year > $cy";
    $currentccmps = $this->model->query($sql,'array');
    $_SESSION['num_current_ccmps'] = count($currentccmps, COUNT_NORMAL);

    /* Past Due ccmps (within 1 year of due date) */
    $currentyear = $_SESSION['ccmps_current_year'];
    $sql = "SELECT * FROM ccmps WHERE deceased != 1 AND soft_deleted != 1 AND current_year = ($currentyear - 1)";
    $pdccmps = $this->model->query($sql,'array');
    $_SESSION['num_pd_ccmps'] = count($pdccmps, COUNT_NORMAL);

    /* Current & 1 Year Past Due ccmps */ // or just add two numbers above
    $currentyear = $_SESSION['ccmps_current_year'];
    $sql = "SELECT * FROM ccmps WHERE deceased != 1 AND soft_deleted != 1 AND current_year >= ($currentyear - 1)";
    $curpluspdccmps = $this->model->query($sql,'array');
    $_SESSION['num_current_and_pd_ccmps'] = count($curpluspdccmps,COUNT_NORMAL);
/*
echo(278);
echo('<br>');
print_r($subentity);
echo('<br>');
print_r($currentyear);die();
*/
//  Number of current fellow subentity folks
    if(strlen($subentity) > 0 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 ){
// add subentity field to ccmps
// echo(290); die(); //- no subentity field in ccmps
    $sql = "SELECT * FROM ccmps WHERE subentity = $subentity AND current_year >= $currentyear AND deceased != 1  AND soft_deleted != 1";
    $cursubfolks = $this->model->query($sql,'array');
//echo(293); die();
    $_SESSION['num_current_subentity_members'] =  count($cursubfolks,COUNT_NORMAL);

    }else{
        $flash_msg = 'Your '.CCMPSSUBENTITY.' code is missing. Calculation failed. '; // username was not valid
        set_flashdata($flash_msg);
    }
//echo(300); die();
    //  Number of 1 Year past due fellow subentity folks
    $subentity = $_SESSION['ccmps_subentity'];
    if(strlen($subentity) > 0){
        $sql = "SELECT * FROM ccmps WHERE subentity = $subentity AND current_year = $currentyear - 1 AND deceased != 1  AND soft_deleted != 1";
        $pdsubfolks = $this->model->query($sql,'array');
        $_SESSION['num_pd_subentity_members'] =  count($pdsubfolks,COUNT_NORMAL);
     }else{
        $flash_msg = 'Your '.CCMPSSUBENTITY.' code is missing. Calculation failed. '; // username was not valid
        set_flashdata($flash_msg);
    }

    // Number of fellow student subentity folks
    $subentity = $_SESSION['ccmps_subentity'];
    if(strlen($subentity) > 0){
        $sql = "SELECT * FROM ccmps WHERE subentity = $subentity AND current_year >= $currentyear AND deceased != 1  AND soft_deleted != 1 AND ccmp_type = 3 OR subentity = $subentity AND current_year >= $currentyear AND deceased != 1  AND soft_deleted != 1 AND ccmp_type = 4";
        $curstuchapmembrs = $this->model->query($sql,'array');
        $_SESSION['num_current_subentity_student_members'] =  count($curstuchapmembrs,COUNT_NORMAL);
    }else{
        $flash_msg = 'Your '.CCMPSSUBENTITY.' code is missing. Calculation failed. '; // username was not valid
        set_flashdata($flash_msg);
    }

    // Number of Subentities
    $sql = "SELECT * FROM ccmps_subentities";
    $numsubentities = $this->model->query($sql,'array');
    $_SESSION['num_subentities'] =  count($numsubentities,COUNT_NORMAL); // HQ/National is subentity 1.

    // Number of Chartered Subentities
    $sql = "SELECT * FROM ccmps_subentities WHERE chartered = 1";
    $chtrdsubentities = $this->model->query($sql,'array');
    $_SESSION['num_chartered_subentities'] =  count($chtrdsubentities,COUNT_NORMAL);

    // Counts shown in () on the My Chapter Roster and National Directory buttons.
    // Same filters as currentroster() and currentdirectory() so the numbers match those pages.
    $rosteryear = max((int) $currentyear, 2023) - 1; // since using > in $sql not >=
    $subentity  = (int) $_SESSION['ccmps_subentity'];
    $sql = "SELECT COUNT(*) AS n FROM ccmps WHERE subentity = $subentity AND deceased != 1 AND soft_deleted != 1 AND (current_year > $rosteryear OR status = 2)";
    $rows = $this->model->query($sql,'object');
    $_SESSION['num_current_chapter_members'] = $rows ? (int) $rows[0]->n : 0;

    $sql = "SELECT COUNT(*) AS n FROM ccmps WHERE deceased != 1 AND directoryoptout != 1 AND soft_deleted != 1 AND (current_year > $rosteryear OR status = 2)";
    $rows = $this->model->query($sql,'object');
    $_SESSION['num_current_members'] = $rows ? (int) $rows[0]->n : 0;

    $data['device_type']  = $_SESSION['device_type']; //  $data['show_buttons']  = 0; // 1 0r 2 will show in mobile interface
    $data['tg_user_level'] = $_SESSION['tg_user_level'];

/* Marquee, jumbotron, notices, jobs, activities and bulletins were read here from the old
   cms_ccmps_* tables (removed 2026-10-20); the page didn't show them. The member home's
   content comes from the Website content manager (cms_* tables) from phase 4. */

 // checkpoint
/*
echo('514: Going to ccmphome');
echo('<br>');
echo('$data');
json($data);
echo('<br>');
echo('$_SESSION');
// json($_SESSION); die();
*/

    // Website sections for the lower half of the page (content manager, cms_helper.php)
    $data['cms'] = cms_page('member', (int) ($_SESSION['ccmps_subentity'] ?? 0));

    $data['contentfile']   = 'ccmphome';
    $data['view_module']   = 'welcome/ccmps';
    $data['view_file']     = 'ccmphome'; //
    $this->templates->inspinia($this->_with_fontsize_style($data));

    }
/* -----------------------------  END CCMPHOME ------------------------------ */

/*----------------------------------------------------------------------------*/
/*----------------------------  function MYDATA ------------------------------*/
/*----------------------------------------------------------------------------*/

    function mydata() { // parameters passed only after update otherwise passed in URL by menu button
    //get login screen if not logged in.

        // should this be passed when editing each section so return to that section? already does and works!
        $_SESSION['ccmp_active_window'] = segment(3);
//print_r($_SESSION['ccmp_active_window']); die();
          if($_SESSION['ccmp_logged_in'] == 1){ // if not logged in
            // continue everything is ok
          }else{
            $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
                set_flashdata($flash_msg);
            // you logged out or session timed out - login again
              redirect('welcome/logout'); // clears everything then takes to login page
          }

 /*------------------------ Get logged in user's data ------------------------*/

    // Set mode
    $_SESSION['ccmpmode']   = "ccmp";  // who am I
    $_SESSION['actionmode'] = "ccmpv"; //what mode am I in

    $recid = $_SESSION['ccmp_rec_id'];
//print_r($recid); die();
    $data = $this->_get_a_single_record($recid); // returns array anchor1
//echo(558);
//json($data); die();
    $data = $this->_convert_to_user_friendly($data); // anchor3
//echo(561); die();

 /*------------------- Set values needed for user interface ------------------*/

    $data = (array)$data; // view files expect an array

    // The 5 per-element font-size settings (tab/header/label/value/button)
    // are read fresh from the ccmps record directly in inspinia.php on
    // every page load — no session caching needed, unlike the old single
    // fontsize value this replaced.

    $data['recid']          = $_SESSION['ccmp_rec_id'];
    $data['ccmp_logged_in'] = $_SESSION['ccmp_logged_in'];
    $data['device_type']    = $_SESSION['device_type'];
    $data['show_buttons']   = 0; // 1 0r 2 will show
    $data['home_page']      = 1; // ???
 //   $data['tg_user_level']  = $_SESSION['tg_user_level'];

    $data['view_module']   = 'welcome/ccmps';
    $data['view_file']     = 'viewccmp'; // genuine read-only view, not the edit form
    $data['bc1'] = 'MP'; // Member Portal
    $data['bc2'] = 'My Profile';

//echo(590);
//print_r($_SESSION['ccmp_active_window']); die();

if($_SESSION['ccmp_active_window'] > 0) { // if it was set to something by another operation leave alone

}else{
       $_SESSION['ccmp_active_window'] = 1; // start with all ccmp profile collapse open
}

// checkpoint
/*
  echo('Ccmps 611 going to ccmpcrud from mydata');
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  // die();
*/
    $this->templates->inspinia($this->_with_fontsize_style($data));


        //  redirect('welcome-ccmps/viewccmp/'.$recid);
    }
/* -------------------------------  END MYDATA ------------------------------ */


/*----------------------------------------------------------------------------*/
/*--------------------- function _GET_A_SINGLE_RECORD ------------------------*/
/*----------------------------------------------------------------------------*/

function _get_a_single_record($recid) { //anchor 1 - called when viewing, updating, and for mydata

    /*-------------------------- Get the CCMP Core ----------------------------*/
    $ccmp_data = $this->model->get_where($recid, 'ccmps'); // object
    $ccmpid = $ccmp_data->id;

    /*-------------------------- Get the CCMP Auxiliary data -------------------*/
    $ccmp_aux_data = $this->model->get_one_where('ccmp_id', $ccmpid, 'ccmps_aux'); // object

    // tfontsize removed — confirmed via php_error_log that this column doesn't exist on ccmps.
    // The single-value fontsize column itself has also been superseded by
    // the 5-element tab/header/label/value/button system — see inspinia.php.

    // The person's own `region` (ccmps.region, a ref_region_codes id) stays
    // untouched here on purpose — it's a distinct concept from the region
    // their chapter belongs to. The chapter's region is added under its own
    // key instead, so nothing gets silently overwritten.
    if (!empty($ccmp_data->subentity)) {
        $subentity_obj = $this->model->get_one_where('id', $ccmp_data->subentity, 'ccmps_subentities');
        if ($subentity_obj) {
            $ccmp_data->subentity_region = $subentity_obj->region;
        }
    }

    /*----------------------- Get the CCMP addresses ---------------------------*/
    $ccmp_addr = $this->model->get_one_where('ccmp_id', $ccmpid, 'ccmps_addresses'); // object

    $ccmp_data = (array) $ccmp_data;
    $ccmp_aux_data = (array) $ccmp_aux_data;
    $ccmp_addr = (array) $ccmp_addr;

    // Drop the duplicate id / ccmp_id keys from the child tables before
    // merging, so $data['id'] reliably stays the person's own ccmps.id
    // rather than getting clobbered by ccmps_aux's or ccmps_addresses'
    // own unrelated primary key.
    unset($ccmp_aux_data['id'], $ccmp_aux_data['ccmp_id']);
    unset($ccmp_addr['id'], $ccmp_addr['ccmp_id']);

    $data = array_merge(
        $ccmp_data,
        $ccmp_aux_data,
        $ccmp_addr
    );

    /*----------------------- Get the CCMP aircraft (one-to-many) --------------*/
    // A member can own/rent multiple aircraft, so this is a genuine list of
    // ccmps_aircraft rows, not a merged single-value field like the rest of
    // $data above.
    $aircraft_records = $this->model->get_where_custom('ccmp_id', $ccmpid, '=', 'id', 'ccmps_aircraft');
    $data['aircraft_records'] = $aircraft_records ?: [];

    // Sync aircraft_owner with reality on every page load: true if ANY
    // ccmps_aircraft row for this person has own_rent = 1 ("owned," per
    // the database's own convention — 0 means rented). This overwrites
    // whatever was previously stored in ccmps_aux.aircraft_owner, so the
    // checkbox always reflects the actual aircraft list rather than a
    // manually-set flag that could drift out of sync with it. The
    // checkbox itself stays editable — this just sets its starting value.
    $has_owned_aircraft = false;
    foreach ($data['aircraft_records'] as $ac) {
        if (!empty($ac->own_rent)) {
            $has_owned_aircraft = true;
            break;
        }
    }
    $data['aircraft_owner'] = $has_owned_aircraft ? 1 : 0;

    return $data; // array — used directly by the CRUD form, and passed to _convert_to_user_friendly() for the read-only view
}


/*----------------------------------------------------------------------------*/
/*--------------------  function end _get_a_single_record --------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/* ---------------------------  function VIEWCCMP --------------------------- */
/*----------------------------------------------------------------------------*/

function viewccmp($recid = NULL){ // chaper admin on computer viewing ccmp - passes recid after an update to return to view the changes
    //get login screen if not logged in. However if logged in can pass a recid in url and see someone elses
    // record and change it

    if (empty($recid)) {
        $recid = segment(3); // fall back to the URL segment since this app's routing doesn't reliably pass URL segments as function arguments
    }

    // $ccmpsfunction = 'viewccmp';
    // $authorized = $this->_check_function_permissions($ccmpsfunction, $recid);
    if (!empty($_SESSION['trongatetoken']) && !$this->_member_access($recid, 'view')) {
        $this->_deny_member_access(); // own record, or an admin for this member (2026-10-27)
    }
//echo(875); die();
if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
    set_flashdata($flash_msg);

    // you logged out or session timed out - login again
    redirect('welcome/logout'); // clears everything then takes to login page
}

//echo(721);
//print_r($recid);
// print_r($_SESSION['ccmpmode']); die();

  $vbe = segment(5); // viewing before editing

  if($vbe == 'vbe'){ // if you are viewing before editing
    $_SESSION['ccmp_active_window'] = segment(4);
    $vbe = ''; // reset

  } // else viewing after editing so want to return to tab just edited so dont change value of tab #
// print_r($_SESSION['ccmp_active_window']); die();

 /*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

  // mode ccmp does not need to change because you do straight to your member record and not through an admin ccmpmode
//echo(738);
//print_r($_SESSION['ccmpmode']); die();


 switch($_SESSION['ccmpmode']) {

//  switch($_SESSION['actionmode']) {
  case 'subentity_admin': // managing your subentity records

//  if($_SESSION['actionmode'] == 'subentity_admin_update'){
//  }else{}

      $_SESSION['actionmode'] = 'subentity_admin_view'; // Chapter Admin viewing
  break;

//  case 'momc': // managing your subentity records

//      $_SESSION['ccmpmode'] = 'momv'; // mom viewing
//      $_SESSION['actionmode'] = 'momv'; // mom viewing
//  break;

//  case 'momm' : // managing your subentity records

//      $_SESSION['ccmpmode'] = 'momv'; // mom viewing
//      $_SESSION['actionmode'] = 'momv'; // mom viewing
//  break;

  case 'mosu' : // managing your student subentity records

       $_SESSION['ccmpmode'] = 'mosv'; // mos
      $_SESSION['actionmode'] = 'mosv'; // mos

  break;

  case 'mosc': // managing your student subentity records

       $_SESSION['ccmpmode'] = 'mosv'; // mos
      $_SESSION['actionmode'] = 'mosv'; // mos

  break;

  case 'mosm' : // managing your student subentity records

       $_SESSION['ccmpmode'] = 'mosv'; // mos
      $_SESSION['actionmode'] = 'mosv'; // mos

  break;

  case 'mcmu': // managing current members - used for student members only

       $_SESSION['ccmpmode'] = 'mcmv'; // mom
      $_SESSION['actionmode'] = 'mcmv'; // mcm creating

  break;


  case 'mcmc': // managing current members - used for student members only

       $_SESSION['ccmpmode'] = 'mcmv'; // mom
      $_SESSION['actionmode'] = 'mcmv'; // mcm creating

  break;


  case 'mcmm': // managing current members - used for student members only

    $_SESSION['ccmpmode'] = 'mcmv'; // mom
      $_SESSION['actionmode'] = 'mcmv'; // mcm creating

  break;

  case 'mamv' : // managing all members - whichever one you came in you are now in view mode

      $_SESSION['ccmpmode'] = 'ccmp_admin'; //
      $_SESSION['actionmode'] = 'mamv'; //

  break;

  case 'mamu' : // managing all members

      $_SESSION['ccmpmode'] = 'ccmp_admin'; // mom
      $_SESSION['actionmode'] = 'mamv'; // mam updating

  break;

  case 'mamc' : // managing all members

       $_SESSION['ccmpmode'] = 'ccmp_admin'; // mom
      $_SESSION['actionmode'] = 'mamv'; // mam updating

  break;

  case 'mamm' : // managing all members manage ??? used?

       $_SESSION['ccmpmode'] = 'ccmp_admin'; // mom
      $_SESSION['actionmode'] = 'mamv'; // mam updating

  break;

  case 'honchomngallccmps': // system_admin honcho managing all members

      $_SESSION['ccmpmode'] = 'mamv'; // mam viewing

  break;

  case 'mngallccmps': // All Members list - keep the mode so Update gets a Save button and Close returns to the list
  case 'mngdeleted':

      $_SESSION['actionmode'] = 'mamv'; // mam viewing

  break;


}
//echo(837); die();
  $data   = $this->_get_a_single_record($recid); // anchor1 - returns array
  $data   = $this->_convert_to_user_friendly($data); // anchor 3

  // Both functions above return arrays — use array syntax, not ->,
  // or these assignments silently no-op (PHP doesn't error on
  // property-assignment to an array, it just does nothing).
  $data['recid']        = $recid;
  $data['view_module']  = 'welcome/ccmps';
  $data['view_file']    = 'viewccmp'; // genuine read-only view, not the edit form
 //print_r($data->recid); die();

 /*
    echo(1000);
    echo('<br>');
    print_r($_SESSION['ccmpmode'] );
    json($data);
     // die();
  */

 switch($_SESSION['ccmpmode']) { //
// switch($_SESSION['actionmode'])
  case 'ccmp': //

        $data['bc1'] = 'MSP';
        $data['bc2'] = 'My Profile';

  break;

  case 'momv': //

        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'View '.CCMP;

  break;

  case 'subentity_admin': //

        $data['bc1'] = CCMPSSUBENTITY.' 889Admin';
        $data['bc2'] = 'View '.CCMP;

  break;

  case 'mcmv': //  - used for student members only

        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'View Current '.CCMP;

  break;

  case 'mamv': //

        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'View '.CCMP;

  break;
}


if($_SESSION['ccmp_active_window'] > 0) { // if it was set to something by another operation leave alone

}else{
       $_SESSION['ccmp_active_window'] = 1; // start with all ccmp profile collapse open
}
// $data is already an array — no cast needed here anymore.

// checkpoint
/*
  echo(1013);
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  // die();
 */
    $this->templates->inspinia($this->_with_fontsize_style($data));
}
/*----------------------------------------------------------------------------*/
/* ----------------------------  END VIEWCCMP ------------------------------- */
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/* ---------------------------- function MANAGE ----------------------------- */
/*----------------------------------------------------------------------------*/

function manage() { // subentity/system admin management list — view, edit, bulk-action members

    if (empty($_SESSION['ccmps_admin']) && empty($_SESSION['honcho_sysadmin']) && empty($_SESSION['honcho_ccmps_admin'])) {
        // $ccmpsfunction = 'manage';
        // $authorized = $this->_check_function_permissions($ccmpsfunction);
    }

    $this->_get_font_sizes();

    if (strlen($_SESSION['trongatetoken']) == 0) {
        $flash_msg = 'Your Session has expired - please login again.';
        set_flashdata($flash_msg);
        redirect('welcome/logout');
        return;
    }

    if (segment(3) == 'honcho') {
        $_SESSION['ccmpmode'] = segment(4);
    } else {
        $_SESSION['ccmpmode'] = segment(3);
    }
//echo(960); print_r($_SESSION['ccmpmode']); die(); // subentity admin from sidemenu
    $_SESSION['ccmp_active_window'] = 0; // reset which tab opens first when viewing a record

    $system_current_year = (int) $_SESSION['ccmps_current_year'];

    // Base SELECT, joined against the tables that actually hold the columns
    // the manage view needs — the old query only selected from `ccmps` and
    // could never have populated city/state or friendly chapter/type names.
    $base_select = "
        SELECT
            c.id, c.first_name, c.middle_name, c.last_name, c.suffix,
            c.ccmp_number, c.ccmp_type, c.subentity, c.current_year, c.status,
            c.soft_deleted, c.deceased, c.misc1,
            a.mailcity, a.mailstate,
            s.chapter_title,
            t.description AS ccmp_type_desc
        FROM ccmps c
        LEFT JOIN ccmps_addresses a ON a.ccmp_id = c.id
        LEFT JOIN ccmps_subentities s ON s.id = c.subentity
        LEFT JOIN ccmps_types t ON t.id = c.ccmp_type
    ";

    if ($_SESSION['ccmpmode'] === 'mngdeleted') {
        // Soft-deleted records awaiting permanent removal or restore — a
        // distinct single-table view, not part of the 5-tab year-tier
        // structure below (deletion status is orthogonal to dues year).
        $sql = $base_select . " WHERE c.soft_deleted = 1";
        $data['ccmpsrecs'] = $this->model->query($sql, 'object');
        $data['show_chapter_column'] = true;
        $data['tabbed'] = false;
    } else {
        // Every other mode gets the same 5 year-tier tabs — Current, Past
        // Due (1yr), Expired (2yr), Expired (3yr+), All Records — the
        // original tabbed interface this restores. Rebuilt clean: one
        // reusable scope fragment (varies by ccmpmode, same cases as
        // before) combined with one reusable year-tier fragment, looped
        // 5 times, instead of the original's ~35 hand-duplicated query
        // blocks (7 modes × 5 tiers).
        $recid = $_SESSION['ccmp_rec_id'];

//echo(999); print_r($_SESSION['actionmode']); die();
//echo(1001); print_r($_SESSION['ccmpmode']); die();
//echo(1001); json($_SESSION); die();
        switch ($_SESSION['ccmpmode']) {

            case 'subentity_admin': // subentity admin managing only their own chapter's records
            $_SESSION['actionmode'] = 'subentity_admin_manage';
                if ($recid < 1) { $this->login(); return; }
                $ccmp_rec = $this->model->get_one_where('id', $recid, 'ccmps');
                $scope_where = "c.subentity = " . (int) $ccmp_rec->subentity;
                $data['show_chapter_column'] = false;
                break;

            case 'honcho_admin': // Honcho admin managing all members was honchomngallccmps
                $scope_where = "1=1";
                $data['show_chapter_column'] = true;
                break;


            case 'ccmp_admin': // same as mngallccmps - reached via the Close button added to viewccmp.php
            $_SESSION['actionmode'] = 'ccmp_admin_manage';
            default:
                $scope_where = "1=1";
                $data['show_chapter_column'] = true;
                break;
        }

        // The 5 year-tier boundaries, matching the original's exact logic:
        //   0: current      -> current_year >= system_current_year
        //   1: 1 year past  -> current_year  = system_current_year - 1
        //   2: 2 years past -> current_year  = system_current_year - 2
        //   3: 3+ years     -> current_year  < system_current_year - 2
        //   4: all records  -> no year filter, no deceased/soft_deleted filter either
        $tier_labels = [
            0 => 'All Current Members for ' . $system_current_year,
            1 => 'Past Due Members from ' . ($system_current_year - 1),
            2 => 'Expired Members from ' . ($system_current_year - 2),
            3 => 'Expired Members from ' . ($system_current_year - 3) . ' and earlier',
            4 => 'All Member Records',
        ];

        $tabs = [];
        foreach ($tier_labels as $tier => $label) {
            if ($tier === 0) {
                $year_where = "c.current_year >= " . $system_current_year . " AND c.deceased != 1 AND c.soft_deleted != 1";
            } elseif ($tier === 1) {
                $year_where = "c.current_year = " . ($system_current_year - 1) . " AND c.deceased != 1 AND c.soft_deleted != 1";
            } elseif ($tier === 2) {
                $year_where = "c.current_year = " . ($system_current_year - 2) . " AND c.deceased != 1 AND c.soft_deleted != 1";
            } elseif ($tier === 3) {
                $year_where = "c.current_year < " . ($system_current_year - 2) . " AND c.deceased != 1 AND c.soft_deleted != 1";
            } else { // tier 4: all records, deliberately unfiltered by year/deceased/soft_deleted
                $year_where = "1=1";
            }

            $sql = $base_select . " WHERE " . $scope_where . " AND " . $year_where;
            $records = $this->model->query($sql, 'object');

            $tabs[] = [
                'key'     => 'tier' . $tier,
                'label'   => $label . ' (' . count($records) . ')',
                'records' => $records,
            ];
        }

        $data['tabs'] = $tabs;
        $data['tabbed'] = true;
    }

    $data['bulk_actions'] = array_values(array_filter((array) $this->model->get('id', 'ccmps_bulk_actions'), function($a){ // bulk actions on ccmps records
        if ((int) $a->id === 12) { return dues_engine_on() && rbac_allowed('fin', 'settle_national_dues'); } // National Dues Paid: Financial Admins
        return (int) $a->id !== 11 || (dues_engine_on() && rbac_allowed('fin', 'record_chapter_dues')); // Chapter Dues Paid: only with the dues engine and the right
    }));
    $data['statuses'] = $this->model->get('id', 'ccmps_status');
    $data['bc1'] = 'Manage';
    $data['bc2'] = ucwords(str_replace('_', ' ', $_SESSION['ccmpmode']));
    $data['view_module'] = 'welcome/ccmps';
    $data['view_file']   = 'manage';

    $this->templates->inspinia($this->_with_fontsize_style($data));
}

/*----------------------------------------------------------------------------*/
/*----------------------- End function manage --------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------------- function UPDATECCMP ------------------------------*/
/*----------------------------------------------------------------------------*/

function updateccmp($retrying = 'no'){ // subentity admin on computer needs edit/create form create.php

    $retry = $retrying;  // first time through for unknown reason it passes the recid, on retry = yes.
    $recid = segment(3);

    if (empty($_SESSION['trongatetoken']) || !$this->_member_access($recid, 'edit')) {
        $this->_deny_member_access(); // own record, or an admin for this member (2026-10-27)
    }

    if( $retry == 'yes'){
      // retry does not pass a segment value
      // keep tab number the same for the retry
        $retry = 'no'; // reset - not sure if necessary
        $data = $_POST; // get what was posted from the form
  // echo(1770);
  // json($_POST); die();
    }else{
          $_SESSION['ccmp_active_window'] = segment(4); // what collapse called the update - return with that tab open
    }
//print_r($_SESSION['ccmp_active_window']); die();
    $userobj     = $this->model->get_where($recid,'ccmps');

    $_SESSION['current_email'] = $userobj->email_address;
    $usrchptrid    = $userobj->subentity;
    $subentityobj  = $this->model->get_where($usrchptrid,'ccmps_subentities');
    $subentitynm   = $subentityobj->chapter_title;
  //  $ccmp_type       = $subentityobj->ccmp_type;
//echo(1120);
//print_r($_SESSION['ccmpmode']);
//print_r($_SESSION['actionmode']);
//die();

if($_SESSION['ccmpmode'] == 'ccmp'){ // member managing his data coming from sidemenu
    $_SESSION['actionmode'] = 'ccmpu'; // member updating their data
}

if($_SESSION['ccmpmode'] == 'subentity_admin'){ // chapter admin managing his chapter member
    $_SESSION['actionmode'] = 'subentity_admin_update'; // manage our members update
}

if($_SESSION['ccmpmode'] == 'mamv'){ // member admin managing all member
    $_SESSION['actionmode'] = 'mamu'; // manage all members update
}

// All Members list (manage/mngallccmps and its siblings) - without this the form showed no Save button
if(in_array($_SESSION['ccmpmode'], array('mngallccmps', 'ccmp_admin', 'honcho_admin', 'honchomngallccmps', 'mngdeleted'))){
    $_SESSION['actionmode'] = 'mamu'; // manage all members update
}

/*
echo(1138);
echo('<br>');
print_r($_SESSION['ccmpmode']);
echo('<br>');
print_r($_SESSION['actionmode']);
json($userobj);
echo('<br>');
json($_SESSION); die();
*/

/*----- Need to change mode to what was requested and by whom ----------------*/
/*
 //switch($_SESSION['ccmpmode']) {  // mngsubentity
  switch($_SESSION['actionmode']){

      case 'mmdu': // managing your record own  - from view pages

          $_SESSION['ccmpmode'] = 'updatemydata'; // updating - updatemydata

      break;

      case 'momu': // managing a chapter record-from view page

       //   $_SESSION['ccmpmode'] = 'updatemydata'; // updating - updatemydata

      break;



  case 'wasviewmydata': //now ccmp.  managing your record own  - from view pages

      $_SESSION['ccmpmode'] = 'updatemydata'; // updating - updatemydata

  break;

  case 'updatemydata': // managing your subentity records - coming from manage or view pages

      $_SESSION['ccmpmode'] = 'updatemydata'; // updating - updatemydata
 //echo(3350); die();
  break;

  case 'momm': // managing your subentity records - coming from manage or view pages

      $_SESSION['ccmpmode'] = 'momu'; // mom updating

  break;

  case 'momv': // managing your subentity records - coming from manage or view pages

      $_SESSION['ccmpmode'] = 'momu'; // mom updating

  break;

  case 'mosm': // managing your subentity student records - coming from manage or view pages

      $_SESSION['ccmpmode'] = 'mosu'; // mom updating

  break;

  case 'mosv': // managing your subentity student records - coming from manage or view pages

      $_SESSION['ccmpmode'] = 'mosu'; // mom updating

  break;

  case 'mcmm': // managing current members - used for student members only

      $_SESSION['ccmpmode'] = 'mcmu'; // mcm updating

  break;

  case 'mcmv': // managing current members - used for student members only

      $_SESSION['ccmpmode'] = 'mcmu'; // mcm updating

  break;

  case 'mngallccmps': // managing all members

      $_SESSION['ccmpmode'] = 'mamu'; // mam updating

  break;

    case 'mamv': // managing all members

      $_SESSION['ccmpmode'] = 'mamu'; // mam updating

  break;

}
*/
    if($retry == 'yes'){
      $retry = 'no'; // reset -not sure if necessary
        $data = $_POST;
    }else{
      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid); // anchor1 - returns a flat array
    }
    // Note: the old *stateid/*cntyid/*cntryid alias keys and the four
    // "if a state code value is NULL" default blocks that used to live
    // here have been removed — they operated on a nested object shape
    // ($data->mailaddrdata->state) that _get_a_single_record() no longer
    // returns (it returns a flat array now), and the rebuilt form reads
    // mailstate/physstate/etc. directly via cf_select(), so none of
    // these aliases were needed by anything still in use.

/*------------------------ Populate Dropdowns  -------------------------------*/

$data= (array)$data;

    // genders
    $data['genders'] = $this->model->get('id','ref_genders');

    // languages
    $data['languages'] = $this->model->get('id','ref_languages');

        // regions
    $data['regions'] = $this->model->get('id','ref_region_codes');

    // subentitys
    $data['subentities'] = $this->model->get('id','ccmps_subentities');

    // subentity roles — renamed to match ccmpcrudcontact.php's expected variable name
    $data['ccmpsubentityroles'] = $this->model->get('id','ccmps_subentity_roles');

    // national roles — renamed to match ccmpcrudcontact.php's expected variable name
    $data['national_offices'] = $this->model->get('id','ref_national_offices');

    // states — renamed to match ccmpcrudcontact.php's expected variable name
    $data['states'] = $this->model->get('id','ref_states');

    // counties — renamed to match ccmpcrudcontact.php's expected variable name
    $data['counties'] = $this->model->get('id','ref_counties');

    // countries — renamed to match ccmpcrudcontact.php's expected variable name
    $data['countries'] = $this->model->get('id','ref_countries');

    // lead sources — was missing entirely; ccmpcrudcontact.php needs this
    $data['leadsources'] = $this->model->get('id','ref_leadsource');

    // salutations — was missing entirely; ccmpcrudcontact.php needs this
    $data['salutations'] = $this->model->get('id','ref_salutations');

    // Header display only (ccmpcrud.php shows salutation + name at the
    // top) — deliberately a SEPARATE key from $data['salutation'], which
    // must stay the raw id for the dropdown in ccmpcrudcontact.php to
    // correctly match/select the right option. Overwriting the raw
    // value here would silently break that dropdown instead.
    $data['salutation_display'] = '';
    if (!empty($data['salutation'])) {
        foreach ($data['salutations'] as $sal_row) {
            if ((string) $sal_row->id === (string) $data['salutation']) {
                $data['salutation_display'] = $sal_row->title;
                break;
            }
        }
    }

    // membership types
    $data['ccmptypes'] = $this->model->query('SELECT * FROM ccmps_types WHERE active = 1 ORDER BY id', 'object'); // switched-off types (Family, retired 2026-10-31) aren't offered

    // Font-size element dropdowns (Preferences tab) — each pre-filtered to
    // its own type from the same ccmps_settings table. Was previously
    // missing entirely here, leaving the 5 dropdowns iterating over
    // undefined variables (empty/broken) — this is the actual fix.
    $all_ccmps_settings_for_dropdowns = $this->model->get('id', 'ccmps_settings');
    $data['tab_settings']    = [];
    $data['header_settings'] = [];
    $data['label_settings']  = [];
    $data['value_settings']  = [];
    $data['button_settings'] = [];
    foreach ($all_ccmps_settings_for_dropdowns as $ccmps_setting_row) {
        $target_key = $ccmps_setting_row->type . '_settings';
        if (array_key_exists($target_key, $data)) {
            $data[$target_key][] = $ccmps_setting_row;
        }
    }

    // Financial Acct Types
    // $data['accttypes'] = $this->model->get('id','ccmps_financial_types');

    // Financial Acct Status
    // $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses');

// To control input fields.
    $data['recid']         = $recid;
    $data['subentitynm']   = $subentitynm;
    $data['view_module']   = 'welcome/ccmps';

    // header - cant use the _convert_to_user_friendly() because need to pass raw id to the dropdown when editing
    if (!empty($data['subentity'])) {
        $data['subentity_id'] = $data['subentity']; // raw id, preserved for same-chapter permission checks
        $obj = $this->model->get_where($data['subentity'], 'ccmps_subentities');
        $data['chapter_name'] = $obj ? $obj->chapter_title : $data['subentity'];
    } else {
        $data['chapter_name'] = 'Not assigned to a '; // nothing selected (0/default) — show blank, not the raw id
    }

/*
echo(1325);
print_r($_SESSION['ccmpmode']);
print_r($_SESSION['actionmode']); die();
*/
  switch($_SESSION['actionmode']){
  case 'ccmpu': //
        $data['bc1'] = 'MSP';
        $data['bc2'] = 'My Profile > Updating';
        $data['subentitynm'] = $subentitynm;

  break;

  case 'momu': //
//echo(1274); die();
        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'View '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;
  break;
/*
  case 'mosu': //
echo(1281); die();
        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'View '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;
  break;


  case 'mcmu': //  - used for student members only
echo(1289); die();
        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'View Current '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;
  break;


  case 'mamu': //
echo(1297); die();
        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'View '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;

  break;

  case 'honchomngallccmps': //
echo(1305); die();
        $data['bc1'] = 'Honcho '.CCMP.' Admin';
        $data['bc2'] = 'View '.CCMP.' > Updating';
        $data['subentitynm'] = $subentitynm;

  break;
*/
  }

//echo(2171); die();
     // CCMP Single Page CRUD
    $data['view_file']  = 'ccmpcrud'; // use all-in-one crud form for updating
  //$data   = $this->_convert_to_user_friendly($data); // anchor 3
/*
  echo(2064);
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  // die();
*/
    $this->templates->inspinia($this->_with_fontsize_style($data));

}
/*----------------------------------------------------------------------------*/
// ------------------------- End function updateccmp ------------------------ //
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*-------------------------- function CREATECCMP -----------------------------*/
/*----------------------------------------------------------------------------*/

function createccmp($retrying = 'no'){ // Adding - may be first time or with values after failed validation ('no' default: the plain address crashed for everyone, 2026-10-27)

  $retry = $retrying; // for failed validation repost

  if (empty($_SESSION['trongatetoken']) || !$this->_member_access(0, 'create')) {
      $this->_deny_member_access(); // admins only (2026-10-27)
  }

  //*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

//print_r($_SESSION['ccmpmode']);
//print_r($reposted); die();

  // who is creating - subentity admin ca or member admin ma so if cancel go back to correct manage page
  //$who_creating_from_btn = segment(3); // ca or ma

//print_r($who_creating_from_btn); die();

echo(2169);
// print_r($_SESSION['ccmpmode']); die();

 switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
  case 'momm': // managing your subentity records - coming from manage or view pages
      $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
      $chptnum = $usrobj->subentity;
      $subentityobj = $this->model->get_one_where('id', $chptnum,'ccmps_subentities');

      $_SESSION['ccmpmode'] = 'momc'; // mom - ca creating from subentity members page
 //print_r($_SESSION['ccmpmode']); die();
  break;

  case 'mosm': // managing your subentity student records - coming from manage or view pages
      $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
      $chptnum = $usrobj->subentity;
      $subentityobj = $this->model->get_one_where('id', $chptnum,'ccmps_subentities');

      $_SESSION['ccmpmode'] = 'mosc'; // mom - ca creating from subentity students page
 //print_r($_SESSION['ccmpmode']); die();
  break;

  case 'mcmm': // managing current members - used for student members only

      $_SESSION['ccmpmode'] = 'mcmc'; // mcm - ma creating from current member page

  break;

  case 'mngallccmps': // managing all members

      $_SESSION['ccmpmode'] = 'mamc'; // mam - ma creating from all members page

  break;
}

 $_SESSION['ccmp_active_window'] = 1; // open the first tab

    if($retry == 'yes'){
        $retry = 'no'; // reset -not sure if necessary

        $data = $_POST; // get what was posted from the form

        // the names of the posted values are derived from the label names of the form to ensure uniqueness
        // as a loop is used to create the input code and each name="" value must be unique
        // however values sent to the form use the another name in some cases (typically database name)
        // so if you are retrying you must convert what was sent back from the form to the names expected to
        // be received by the form. Ex. $data['first_name'] orig sent to form and $_POST['first'] returned
        // by the form. So must id which value names coming back from the form are different than those passed
        // to the form.

        // $itemsv100 in ccmpcrudcifaq-item1.php
/*
                    Passed Back         Passed To Form

                    "Prefix"            => "$salutation",
                    "First"             => "$first_name",
                    "Middle"            => "$middle_name",
                    "Last"              => "$last_name",
            Same         "Suffix"            => "$suffix",
                    "Member Number"     => "$id_number",
                    "Member Type"       => "$ccmp_type",
            Same         "Status"            => "$status",
                    "Current Year"      => "$current_year",
                    "Email"             => "$email_address",
            Same        "Phone"             => "$phone",
            Same        "Mobile"            => "$mobile",
            Same        "Fax"               => "$fax",
                    "Restricted Access" => "$vip",
                    "Opt Out Directory" => "$directoryoptout",
                    "Opt Out Emails"    => "$emailoptout",
            Same        "Do Not Call"       => "$donotcall",
                    "Mail Newsletter"   => "$mail_notices",
                    "Eligible Voter"    => "$eligible_voter",
                    "Alternate Contact" => "$alternate_contact",
                    "Alternate Phone"   => "$alternate_phone",
                    "Alternate Email"   => "$alternate_email",
                    "Date Created"      => "$created_at",
                    "Created By"        => "$created_by"

*/
        // th ones marked same alresy exist in $data because same name
        // therefore only need:
        // To form second try    passed from form 1st try
        $data['salutation']        = $data['prefix'];
        $data['first_name']        = $data['first'];
        $data['middle_name']       = $data['middle'];
        $data['last_name']         = $data['last'];
        $data['id_number']         = $data['idnumber'];
        $data['ccmp_type']           = $data['idtype'];
        $data['current_year']      = $data['currentyear'];
        $data['email_address']     = $data['email'];
        $data['vip']               = $data['restrictedaccess'];
        $data['directoryoptout']   = $data['optoutdirectory'];
        $data['emailoptout']       = $data['optoutemails'];
        $data['mail_notices']      = $data['mailnewsletter'];
        $data['eligible_voter']    = $data['eligiblevoter'];
        $data['alternate_contact'] = $data['alternatecontact'];
        $data['alternate_phone']   = $data['alternatephone'];
        $data['alternate_email']   = $data['alternateemail'];
        $data['created_at']        = $data['datecreated'];
        $data['created_by']        = $data['createdby'];

        // need to reset dropdowns to attempted values - these are special case since share the same dropdown list
        $data['mailstateid'] = $data['mailstate'];
        $data['physstateid'] = $data['physstate'];
        $data['physstateid'] = $data['billstate'];
        $data['shipstateid'] = $data['shipstate'];
        $data['subentityid'] = $data['subentity'];

        $data['password']      = DEFAULT_CCMP_PASSWORD;
        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
//echo(4267);
//json($data); die();
    }else{

        $data['password'] = DEFAULT_CCMP_PASSWORD;

        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;

        //Dropdowns
        // Gender - Let it default to male
 //       $data['unverified']          = 1;
        $data['ccmp_type']         = 1; //Let it default to regular
        $data['subentity_role']        = 10; // regular member
        $data['mailstateid']       = 'NA'; // Unknown - using code and not id
        $data['physstateid']       = 'NA'; // Unknown

        $data['fin_acct_type']       = 1; // Personal financial acct
        $data['fin_status']          = 9; // Unused - account never been used
        $data['physstateid']       = 'NA'; // Unknown
        $data['shipstateid']       = 'NA'; // Unknown

        $data['subentity']             = 10; // subentity at large
        $data['national_officer']    = 10;// no national office
        $data['minor']               = 0;
      }

    // if a state code value is NULL we dont want the dropdown to default to AL
    if(strlen($data['mailstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstateid'] = 'NA';
    }
    if(strlen($data['physstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['physstateid'] = 'NA';
    }
    if(strlen($data['physstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['physstateid'] = 'NA';
    }
    if(strlen($data['shipstateid']) >0){
      // Ok not null do nothing
    }else{

      $data['shipstateid'] = 'NA';
    }

/*------------------ Populate Dropdowns  ---------------------*/

        // membership types
        $data['ccmptypes'] = $this->model->query('SELECT * FROM ccmps_types WHERE active = 1 ORDER BY id', 'object'); // switched-off types (Family, retired 2026-10-31) aren't offered

        // salutations — was missing entirely here too (createccmp renders
        // the same form as updateccmp for brand-new records), leaving the
        // Salutation dropdown with no options at all.
        $data['salutations'] = $this->model->get('id','ref_salutations');
        $data['salutation_display'] = '';
        if (!empty($data['salutation'])) {
            foreach ($data['salutations'] as $sal_row) {
                if ((string) $sal_row->id === (string) $data['salutation']) {
                    $data['salutation_display'] = $sal_row->title;
                    break;
                }
            }
        }

        // Font-size element dropdowns (Preferences tab) — same fix as
        // updateccmp(), needed here too since createccmp() renders the
        // same form for brand-new records.
        $all_ccmps_settings_for_dropdowns = $this->model->get('id', 'ccmps_settings');
        $data['tab_settings']    = [];
        $data['header_settings'] = [];
        $data['label_settings']  = [];
        $data['value_settings']  = [];
        $data['button_settings'] = [];
        foreach ($all_ccmps_settings_for_dropdowns as $ccmps_setting_row) {
            $target_key = $ccmps_setting_row->type . '_settings';
            if (array_key_exists($target_key, $data)) {
                $data[$target_key][] = $ccmps_setting_row;
            }
        }

        // subentitys
        $data['subentitys'] = $this->model->get('id','ccmps_subentities');

        // subentity roles
        $data['subentityroles'] = $this->model->get('id','ccmps_subentity_roles');

        // national roles
        $data['nationalroles'] = $this->model->get('id','ref_national_offices');

        // states
        $data['state_codes'] = $this->model->get('id','ref_states');

        // genders
        $data['genders'] = $this->model->get('id','ref_genders'); // was 'genders', which doesn't exist (2026-10-27)

        // Financial Acct Types
  //      $data['accttypes'] = $this->model->get('id','ccmps_financial_types');

        // Financial Acct Status
 //       $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses');

        $data['view_module']   = 'welcome/ccmps';

     // CCMP Single Page CRUD

        $data['view_file']     = 'ccmpcrud'; // use all-in-one crud form for creating
echo(2366);
// print_r($_SESSION['ccmpmode']); die();
 switch($_SESSION['ccmpmode']) { //
//  switch($_SESSION['actionmode']){
  case 'momc': // managing your subentity records

        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'Create New '.CCMP;
//echo(2860);
//print_r($data['bc1']); die();
  break;

  case 'mosc': // managing your subentity student records

        $data['bc1'] = CCMPSSUBENTITY.' Admin';
        $data['bc2'] = 'Create New '.CCMP;
//echo(2860);
//print_r($data['bc1']); die();
  break;

  case 'mcmc': //  - used for student members only

        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'Create New '.CCMP;
  break;

  case 'mamc': // managing all members
//echo(2868); die();
        $data['bc1'] = CCMP.' Admin';
        $data['bc2'] = 'Create New '.CCMP;

  break;
}
  echo(2328);
  echo('<br>');
  echo('$data');
  echo('<br>');
  json($data);
  echo('$_SESSION');
  echo('<br>');
  json($_SESSION);
  // die();

          // template is the default location (templates/views/cool_mobi) using old engine, new engine uses public/themes/cool_mobi/black
          $this->templates->inspinia($this->_with_fontsize_style($data));
}

/*----------------------------------------------------------------------------*/
/*----------------------- End function createccmp ----------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function CCMPSUBMIT -----------------------------*/
/*----------------------------------------------------------------------------*/

function ccmpsubmit(){ // used by both ccmp & admin when editing/creating

    // make sure session is still active so session variables are available
    if (strlen($_SESSION['trongatetoken']) == 0) {
        $flash_msg = 'Your Session has expired - please login again.';
        set_flashdata($flash_msg);
        redirect('welcome/logout'); // clears everything then takes to login page
        return;
    }

    $recid  = segment(3); // if updating there will be a record id, if adding nothing
    $submit = post('submit', true);
    $crud   = ($recid > 0) ? 'updating' : 'adding';

    // Only your own record, or an admin for this member; adding is for admins only (2026-10-27)
    if (!$this->_member_access($recid, $crud == 'updating' ? 'edit' : 'create')) {
        $this->_deny_member_access();
    }
    // A Chapter Admin without wider rights adds members to their own chapter only
    if ($crud == 'adding' && !empty($_SESSION['ccmps_subentity_admin']) && empty($_SESSION['ccmps_system_admin'])
        && empty($_SESSION['ccmps_ccmp_admin']) && empty($_SESSION['ccmps_admin']) && empty($_SESSION['ccmps_student_admin'])
        && empty($_SESSION['honcho_sysadmin']) && empty($_SESSION['honcho_ccmps_admin'])
        && empty($_SESSION['honcho_ccmps_module_all']) && empty($_SESSION['honcho_all_modules'])) {
        $_POST['subentity'] = (string) ($_SESSION['ccmps_subentity'] ?? '');
    }

    if ($submit != 'Submit') {
        return; // nothing posted - nothing to do
    }

    // -----------------------------------------------------------------------
    // 1. WHITELISTS — only fields listed here can ever be written.
    //    Anything else in $_POST is ignored, even if someone tampers
    //    with the form in browser dev tools.
    // -----------------------------------------------------------------------

    $ccmps_text_fields = [
        'salutation', 'first_name', 'middle_name', 'last_name', 'suffix', 'gender', 'birthday',
        'email_address', 'phone', 'mobile', 'fax', 'website', 'username', 'url_string',
        'alternate_contact', 'alternate_phone', 'alternate_email',
        'emergency_contact', 'emergency_phone', 'emergency_email',
        'employer', 'title', 'department', 'reports_to',
        'ccmp_number', 'ccmp_type', 'subentity', 'subentity_role', 'current_year', 'region',
        'national_officer', 'language', 'leadsource', 'notes',
        'activate_code', 'reset_code',
        'tab_setting', 'header_setting', 'label_setting', 'value_setting', 'button_setting'
    ];

    $ccmps_bool_fields = [
        'minor', 'student', 'active_duty', 'former_military', 'eligible_voter', 'deceased',
        'donotcall', 'emailoptout', 'directoryoptout', 'mail_notices', 'vip',
        // admin-only — see guard below
        'system_admin', 'student_admin', 'subentity_admin', 'ccmp_admin', 'content_admin', 'event_admin', 'financial_admin',
        'locked', 'inactive', 'approved', 'soft_deleted'
    ];

    $aux_text_fields = [
        'call_sign', 'total_time', 'highest_certificate', 'certificate_number',
        'other_crewmember', 'ocm_certnum', 'other_faa_cert', 'ofc_certnum',
        'ap_number', 'maintenance', 'cred_notes'
    ];

    $aux_bool_fields = [
        'hall_of_fame',
        // admin-only — see guard below
        'military_pilot', 'private', 'commercial', 'atp', 'cfi', 'cfii', 'mei', 'dpe', 'bgi', 'agi', 'dispatcher',
        'se_land', 'me_land', 'se_sea', 'me_sea', 'instrument', 'rotocraft', 'glider', 'balloon', 'drone',
        'airship', 'atc', 'ap', 'ia', 'military_maint',
        'aircraft_owner'
    ];

    $addr_text_fields = [
        'mailaddress1', 'mailaddress2', 'mailcity', 'mailstate', 'mailzip', 'mailcounty', 'mailcountry',
        'physaddress1', 'physaddress2', 'physcity', 'physstate', 'physzip', 'physcounty', 'physcountry',
        'billname', 'billphone', 'billaddress1', 'billaddress2', 'billcity', 'billstate', 'billzip', 'billcounty', 'billcountry',
        'shipname', 'shipphone', 'shipaddress1', 'shipaddress2', 'shipcity', 'shipstate', 'shipzip', 'shipcounty', 'shipcountry'
    ];

    $addr_bool_fields = ['mail_phys', 'bill_ship'];

    // Two-tier permission model, matching what the form does client-side:
    // - system_admin_only: true system/security flags — narrowest group.
    // - broader_admin_only: membership + all ccmps_aux extension fields +
    //   notes — editable by subentity_admin, ccmp_admin, or system_admin,
    //   but not by the member themselves. This is the REAL enforcement —
    //   the form's `disabled` attributes are just client-side UX; anyone
    //   can strip that in dev tools, so the server must independently
    //   refuse to save these fields for anyone outside the allowed roles.
    // Recognizes either the module-scoped flag (set from ccmps.system_admin,
    // grants system-admin rights within this module only) or the future
    // enterprise-wide flag (unprefixed, set by the honcho module once built,
    // from honcho_user_accounts — grants system-admin rights across every
    // module). checking an unset key via empty() is always safe, so this
    // works today even though honcho isn't wired up yet.
    $is_system_admin = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['system_admin']);
    $is_admin = !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || $is_system_admin;

    // VIP: visible/editable only to system_admin, subentity_admin, or
    // ccmp_admin — deliberately excludes student_admin, per explicit spec.
    $is_vip_admin = $is_system_admin || !empty($_SESSION['ccmps_subentity_admin']) || !empty($_SESSION['ccmps_ccmp_admin']);

    // Chapter-admin-granting exception: a chapter president can promote
    // another member of their own chapter to subentity_admin, without
    // needing full system_admin access. Looked up fresh here via direct
    // query rather than trusting a lookup array from a prior page render,
    // since this is a separate request and the client can't be trusted
    // to submit its own permission level honestly.
    $is_chapter_president = false;
    if (!empty($_SESSION['ccmps_subentity_role'])) {
        $president_role = $this->model->get_where_custom('title', 'President', '=', 'id', 'ccmps_subentity_roles');
        if (!empty($president_role[0]) && (string) $president_role[0]->id === (string) $_SESSION['ccmps_subentity_role']) {
            $is_chapter_president = true;
        }
    }

    // Same-chapter constraint for subentity_admin/president: look up the
    // TARGET record's actual current chapter directly from the database,
    // never from $_POST — otherwise someone could submit a changed
    // subentity value in the same request that also grants chapter admin,
    // sidestepping the restriction entirely.
    $is_own_chapter = false;
    if ($crud == 'updating' && !empty($_SESSION['ccmps_subentity'])) {
        $target = $this->model->get_where($recid, 'ccmps');
        if ($target && (string) $target->subentity === (string) $_SESSION['ccmps_subentity']) {
            $is_own_chapter = true;
        }
    }

    $can_grant_chapter_admin = $is_system_admin
        || !empty($_SESSION['ccmps_ccmp_admin'])
        || (($is_chapter_president || !empty($_SESSION['ccmps_subentity_admin'])) && $is_own_chapter);

    if (!$is_system_admin) {
        $system_admin_only = [
            'system_admin', 'student_admin', 'ccmp_admin', 'content_admin', 'event_admin', 'financial_admin',
            'locked', 'inactive', 'approved', 'soft_deleted'
        ];
        $ccmps_bool_fields = array_diff($ccmps_bool_fields, $system_admin_only);
        $aux_bool_fields   = array_diff($aux_bool_fields, $system_admin_only);

        $system_admin_only_text = ['activate_code', 'reset_code'];
        $ccmps_text_fields = array_diff($ccmps_text_fields, $system_admin_only_text);
    }

    if (!$is_vip_admin) {
        $ccmps_bool_fields = array_diff($ccmps_bool_fields, ['vip']);
    }

    if (!$can_grant_chapter_admin) {
        $ccmps_bool_fields = array_diff($ccmps_bool_fields, ['subentity_admin']);
    }

    if (!$is_admin) {
        $broader_admin_only_text = [
            'ccmp_number', 'ccmp_type', 'subentity', 'subentity_role', 'current_year', 'region',
            'national_officer', 'leadsource', 'notes'
        ];
        $broader_admin_only_bool = [
            'student', 'eligible_voter', 'hall_of_fame', 'deceased'
        ];
        $ccmps_text_fields = array_diff($ccmps_text_fields, $broader_admin_only_text);
        $ccmps_bool_fields = array_diff($ccmps_bool_fields, $broader_admin_only_bool);
        $aux_text_fields   = array_diff($aux_text_fields, $broader_admin_only_text);
        $aux_bool_fields   = array_diff($aux_bool_fields, $broader_admin_only_bool);
    }

    $ccmps_data = $this->extract_text($_POST, $ccmps_text_fields);
    $ccmps_data = array_merge($ccmps_data, $this->extract_bools($_POST, $ccmps_bool_fields));

    // These are all integer-typed FK/lookup columns whose dropdown has a
    // blank "-- Select --" option — submitting that sends an empty
    // string, which MySQL's strict mode rejects outright for an int
    // column (a real fatal, confirmed via error log for salutation
    // specifically after its varchar->int conversion). 0 is the
    // established "nothing selected" convention used everywhere else
    // these fields are read. Applied to all of them defensively, not
    // just salutation, since the rest are equally vulnerable to the
    // same failure the moment someone leaves one unselected.
    $ccmps_integer_fk_fields = ['salutation', 'ccmp_type', 'subentity', 'subentity_role', 'region', 'national_officer', 'leadsource'];
    foreach ($ccmps_integer_fk_fields as $ccmps_int_field) {
        if (array_key_exists($ccmps_int_field, $ccmps_data) && $ccmps_data[$ccmps_int_field] === '') {
            $ccmps_data[$ccmps_int_field] = 0;
        }
    }

    // dob comes in from the <input type="date"> as a "YYYY-MM-DD" string,
    // but the column stores it as a unix timestamp — convert here, since
    // it's not a plain trim-and-save like the rest of $ccmps_text_fields.
    if (!empty($_POST['dob'])) {
        $ccmps_data['dob'] = strtotime($_POST['dob']);
    } else {
        $ccmps_data['dob'] = null;
    }

    $aux_data = $this->extract_text($_POST, $aux_text_fields);
    $aux_data = array_merge($aux_data, $this->extract_bools($_POST, $aux_bool_fields));

    $addr_data = $this->extract_text($_POST, $addr_text_fields);
    $addr_data = array_merge($addr_data, $this->extract_bools($_POST, $addr_bool_fields));

    // If "same as mailing" is checked, copy the mailing address fields over
    // the physical address fields before saving, so the physical address
    // columns stay populated even though the user only filled in mailing.
    if (!empty($addr_data['mail_phys'])) {
        $addr_data['physaddress1'] = $addr_data['mailaddress1'] ?? '';
        $addr_data['physaddress2'] = $addr_data['mailaddress2'] ?? '';
        $addr_data['physcity']     = $addr_data['mailcity'] ?? '';
        $addr_data['physstate']    = $addr_data['mailstate'] ?? '';
        $addr_data['physzip']      = $addr_data['mailzip'] ?? '';
        $addr_data['physcounty']   = $addr_data['mailcounty'] ?? '';
        $addr_data['physcountry']  = $addr_data['mailcountry'] ?? '';
    }

    // Same idea for shipping = billing.
    if (!empty($addr_data['bill_ship'])) {
        $addr_data['shipname']     = $addr_data['billname'] ?? '';
        $addr_data['shipphone']    = $addr_data['billphone'] ?? '';
        $addr_data['shipaddress1'] = $addr_data['billaddress1'] ?? '';
        $addr_data['shipaddress2'] = $addr_data['billaddress2'] ?? '';
        $addr_data['shipcity']     = $addr_data['billcity'] ?? '';
        $addr_data['shipstate']    = $addr_data['billstate'] ?? '';
        $addr_data['shipzip']      = $addr_data['billzip'] ?? '';
        $addr_data['shipcounty']   = $addr_data['billcounty'] ?? '';
        $addr_data['shipcountry']  = $addr_data['billcountry'] ?? '';
    }

    // -----------------------------------------------------------------------
    // 2. VALIDATION — email/username uniqueness, carried over from the
    //    original ccmpsubmit(), adapted to the current schema.
    // -----------------------------------------------------------------------

    $result = 1; // passing, until proven otherwise below

    $emadr = trim($ccmps_data['email_address'] ?? '');

    // ccmp_type and deceased may have been stripped from $ccmps_data above
    // if the submitter isn't an admin (both are now admin-only fields).
    // For an existing record, fall back to what's actually stored in the
    // database rather than assuming "not present in this submission" means
    // "false" — otherwise a non-admin editing their own profile would look
    // like their student/deceased status just disappeared, incorrectly
    // triggering the email-required rule below.
    if (array_key_exists('ccmp_type', $ccmps_data)) {
        $ccmp_type_id = $ccmps_data['ccmp_type'];
    } elseif ($crud == 'updating') {
        $existing = $this->model->get_where($recid, 'ccmps');
        $ccmp_type_id = $existing->ccmp_type ?? null;
    } else {
        $ccmp_type_id = null;
    }
    $is_student_type = in_array($ccmp_type_id, [3, 4]); // Qualified Student / Student, per ccmps_types

    if (array_key_exists('deceased', $ccmps_data)) {
        $is_deceased = !empty($ccmps_data['deceased']);
    } elseif ($crud == 'updating') {
        $existing = $existing ?? $this->model->get_where($recid, 'ccmps');
        $is_deceased = !empty($existing->deceased);
    } else {
        $is_deceased = false;
    }

    if (strlen($emadr) > 0) {
        $existing = $this->model->get_one_where('email_address', $emadr, 'ccmps');
        if ($existing && (int) $existing->id !== (int) $recid) {
            $result = 0;
            $flash_msg = 'The Email Address is already taken.';
            set_flashdata($flash_msg);
        }
    } elseif (!$is_student_type && !$is_deceased) {
        $result = 0;
        $flash_msg = 'The Email Address is required.';
        set_flashdata($flash_msg);
    }

    // Username: only relevant when adding (mydata/edit flows for existing
    // members don't expose a username field), and only enforced when
    // uniqueness actually matters — same spirit as the original function.
    $usrnm = trim($ccmps_data['username'] ?? '');

    if ($result == 1 && strlen($usrnm) > 0) {
        $existing = $this->model->get_one_where('username', $usrnm, 'ccmps');
        if ($existing && (int) $existing->id !== (int) $recid) {
            $result = 0;
            $flash_msg = 'The Username already exists.';
            set_flashdata($flash_msg);
        }
    } elseif ($result == 1 && strlen($usrnm) == 0 && $crud == 'adding') {
        // No username submitted on a new record — auto-generate one.
        if (defined('DEFAULT_USRNMEQEMAIL') && DEFAULT_USRNMEQEMAIL == 1 && strlen($emadr) > 0) {
            $ccmps_data['username'] = $emadr;
        } elseif ($is_student_type) {
            // Student members may have no email — generate a random username
            // so they still have something unique to log in with.
            $characters = '23456789abcdefghjkmnpqrstuvwxyz';
            $random_string = '';
            for ($i = 0; $i < 6; $i++) {
                $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
            $ccmps_data['username'] = $random_string;
        }
    }

    if ($result == 0) {
        // Validation failed — send back to the form rather than saving.
        redirect(BASE_URL . 'welcome-ccmps/' . ($crud == 'adding' ? 'createccmp' : 'viewccmp/' . $recid . '/1'));
        return;
    }

    // -----------------------------------------------------------------------
    // 2b. DUES YEAR VALIDATION — current_year may only move to the National
    //     Treasurer's currently open dues payment year
    //     (system_settings current_dues_pmt_year). See
    //     ccmps_financial_transactions_plan.md, Section 4, Steps 1-3.
    // -----------------------------------------------------------------------

    $current_dues_pmt_year = (int) $this->_get_financial_setting('current_dues_pmt_year');
    $is_new_member = ($crud == 'adding');
    $prior_ccmp = null;

    if (!$is_new_member) {
        // Fetch the pre-save record so we know what to revert to, and so
        // ccmp_type/subentity/ccmp_number fall back correctly below if this
        // submitter wasn't allowed to change them.
        $prior_ccmp = $this->model->get_where($recid, 'ccmps');
    }

    // Resolve the ccmp_type that will actually end up stored — needed both
    // for the new-member default check below and for the dues-amount
    // calculation after save. array_key_exists check mirrors the same
    // pattern already used above for ccmp_type/deceased fallback.
    if (array_key_exists('ccmp_type', $ccmps_data)) {
        $resolved_ccmp_type_id = (int) $ccmps_data['ccmp_type'];
    } elseif (!$is_new_member && $prior_ccmp) {
        $resolved_ccmp_type_id = (int) $prior_ccmp->ccmp_type;
    } else {
        $resolved_ccmp_type_id = 1; // Regular — matches createccmp()'s own default
    }

    // Dues engine on (dues step 3, 2026-10-31): Current Year changes go through the dues steps after the save:
    // raising it to the open dues year records the chapter dues (and raises the National invoice); lowering it
    // reverses them. Who may: dues_can_record(). The old rules below still apply when the engine is off.
    $dues_engine        = dues_engine_on();
    $dues_posted_year   = array_key_exists('current_year', $ccmps_data) ? (int) $ccmps_data['current_year'] : null;
    $dues_record_year   = 0;
    $dues_reverse_year  = 0;
    $dues_note          = '';

    if (array_key_exists('current_year', $ccmps_data)) {

        $posted_current_year = (int) $ccmps_data['current_year'];

        if ($posted_current_year >= CCMP_LIFETIME_YEAR) {
            // Lifetime member (2099): kept as posted, no dues transaction (3a only
            // creates one for the open dues payment year). recalcstatus() makes them Current.
            $ccmps_data['current_year'] = CCMP_LIFETIME_YEAR;
        } elseif ($is_new_member) {
            // Bug fix: a brand-new member's dues year must default to the
            // currently open dues payment year, not system_current_year.
            // Any other posted value is silently corrected to match — a
            // new member cannot be behind or ahead of the open year.
            if ($posted_current_year !== $current_dues_pmt_year) {
                if ($posted_current_year > $current_dues_pmt_year) {
                    $flash_msg = 'Advance payment of future dues years is not currently available. Please contact the National Treasurer to make arrangements.';
                    set_flashdata($flash_msg);
                }
                $ccmps_data['current_year'] = $current_dues_pmt_year;
            }
        } else {
            $prior_current_year = (int) $prior_ccmp->current_year;

            if ($posted_current_year > $current_dues_pmt_year) {
                // Attempted advance payment of a future year — revert to
                // the prior stored value and tell the user why.
                $ccmps_data['current_year'] = $prior_current_year;
                $flash_msg = 'Advance payment of future dues years is not currently available. Please contact the National Treasurer to make arrangements.';
                set_flashdata($flash_msg);
            } elseif ($posted_current_year < $current_dues_pmt_year) {
                // Behind the currently open dues year — revert silently,
                // no transaction is created for this save.
                $ccmps_data['current_year'] = $prior_current_year;
            }
            // else: posted_current_year == current_dues_pmt_year -> proceed as posted
        }

    } elseif ($is_new_member) {
        // current_year wasn't part of this submission at all — still make
        // sure a brand-new member gets the correct default.
        $ccmps_data['current_year'] = $current_dues_pmt_year;
    }

    if ($dues_engine && ($dues_posted_year === null || $dues_posted_year < CCMP_LIFETIME_YEAR)) {
        $dues_who = $is_new_member ? (object) array('subentity' => (int) ($ccmps_data['subentity'] ?? 0)) : $prior_ccmp;
        $dues_ok  = dues_can_record($dues_who);
        if ($is_new_member) { // a new member's record means their chapter dues were received (as before), if this person may record them
            $ccmps_data['current_year'] = 0;
            if ($dues_ok) { $dues_record_year = $current_dues_pmt_year; }
            else { $dues_note = ' Dues not recorded: ask someone who records '.strtolower(SUBENTITY).' dues to do it.'; }
        } elseif ($dues_posted_year !== null && $prior_ccmp && $dues_posted_year !== (int) $prior_ccmp->current_year) {
            $prior_year = (int) $prior_ccmp->current_year;
            $ccmps_data['current_year'] = $prior_year; // the dues steps set it
            if ($prior_year >= CCMP_LIFETIME_YEAR) {
                $ccmps_data['current_year'] = $dues_posted_year; // no longer lifetime: just the year, no dues steps
            } elseif (!$dues_ok) {
                $dues_note = ' Current Year not changed: '.strtolower(SUBENTITY).' dues are recorded with the Dues button by someone allowed to.';
            } elseif ($dues_posted_year > $prior_year && $dues_posted_year === $current_dues_pmt_year) {
                $dues_record_year = $current_dues_pmt_year;
            } elseif ($dues_posted_year < $prior_year && $prior_year < CCMP_LIFETIME_YEAR) {
                $dues_reverse_year = $prior_year;
            }
        }
    }

    // -----------------------------------------------------------------------
    // 3. SAVE — insert if adding, update if editing an existing record.
    // -----------------------------------------------------------------------

    if ($crud == 'adding') {

        $ccmps_data['code'] = $this->_generate_rand_code();
        $ccmpid = $this->model->insert($ccmps_data, 'ccmps');

        $aux_data['ccmp_id'] = $ccmpid;
        $this->model->insert($aux_data, 'ccmps_aux');

        $addr_data['ccmp_id'] = $ccmpid;
        $this->model->insert($addr_data, 'ccmps_addresses');

    } else { // updating

        $ccmpid = (int) $recid;
        $this->model->update($ccmpid, $ccmps_data, 'ccmps');

        $aux_row = $this->model->get_one_where('ccmp_id', $ccmpid, 'ccmps_aux');
        if ($aux_row) {
            $this->model->update($aux_row->id, $aux_data, 'ccmps_aux');
        } else {
            $aux_data['ccmp_id'] = $ccmpid;
            $this->model->insert($aux_data, 'ccmps_aux');
        }

        $addr_row = $this->model->get_one_where('ccmp_id', $ccmpid, 'ccmps_addresses');
        if ($addr_row) {
            $this->model->update($addr_row->id, $addr_data, 'ccmps_addresses');
        } else {
            $addr_data['ccmp_id'] = $ccmpid;
            $this->model->insert($addr_data, 'ccmps_addresses');
        }
    }

    // RBAC step 5: the four admin roles live in Security Groups - each saved box joins or
    // leaves its group (only boxes this person was allowed to change are in $ccmps_data)
    foreach (rbac_member_roles() as $role_fn => $role) {
        if (array_key_exists($role['col'], $ccmps_data)) {
            rbac_set_member_role((int) $ccmpid, $role_fn, (int) $ccmps_data[$role['col']] === 1, (int) ($_SESSION['tg_user_id'] ?? 0));
        }
    }
    if ($is_deceased) { // a deceased member keeps no roles or group memberships
        rbac_clear_member_access((int) $ccmpid);
    }

    // -----------------------------------------------------------------------
    // 3a. DUES TRANSACTION — create a National dues transaction for the
    //     open dues year if one doesn't already exist for this member.
    //     See ccmps_financial_transactions_plan.md, Section 4, Steps 4-7.
    // -----------------------------------------------------------------------

    $saved_current_year = (int) ($ccmps_data['current_year'] ?? 0);

    if (!$dues_engine && $saved_current_year > 0 && $saved_current_year == $current_dues_pmt_year) { // the engine raises dues_charges instead

        $existing_txn_sql = "SELECT id FROM ccmps_financial_transactions
                              WHERE ccmp_id = " . (int) $ccmpid . "
                              AND dues_year = " . (int) $saved_current_year . "
                              LIMIT 1";
        $existing_txn = $this->model->query($existing_txn_sql, 'object');

        if (empty($existing_txn)) {

            $type_row = $this->model->get_where($resolved_ccmp_type_id, 'ccmps_types');
            $national_dues = $type_row ? (float) $type_row->national_dues : 0;

            // Proration applies only on a brand-new member's very first
            // save, and only for type R (Regular, ccmps_types.id = 1).
            if ($is_new_member && $resolved_ccmp_type_id === 1) {
                $proration = (float) $this->_get_financial_setting('dues_proration');
                $national_dues = round($national_dues * $proration, 2);
            } else {
                $national_dues = round($national_dues, 2);
            }

            $resolved_subentity_id = (int) ($ccmps_data['subentity'] ?? ($prior_ccmp->subentity ?? 0));
            $subentity_row = $this->model->get_where($resolved_subentity_id, 'ccmps_subentities');

            $resolved_ccmp_number = $ccmps_data['ccmp_number'] ?? ($prior_ccmp->ccmp_number ?? '');

            $txn_data = [
                'ccmp_id'             => $ccmpid,
                'member_no'           => $resolved_ccmp_number,
                'chapter'             => $resolved_subentity_id,
                'transaction_type'    => 1, // National Annual Dues — ccmps_financial_transaction_types
                'transaction_date'    => time(),
                'transaction_amt'     => $national_dues,
                'transaction_bal'     => $national_dues,
                'dues_year'           => $saved_current_year,
                'billname'            => $addr_data['billname']     ?? '',
                'billphone'           => $addr_data['billphone']    ?? '',
                'billaddress1'        => $addr_data['billaddress1'] ?? '',
                'billaddress2'        => $addr_data['billaddress2'] ?? '',
                'billcity'            => $addr_data['billcity']     ?? '',
                'billstate'           => $addr_data['billstate']    ?? '',
                'billzip'             => $addr_data['billzip']      ?? '',
                'shipname'            => $addr_data['shipname']     ?? '',
                'shipphone'           => $addr_data['shipphone']    ?? '',
                'shipaddress1'        => $addr_data['shipaddress1'] ?? '',
                'shipaddress2'        => $addr_data['shipaddress2'] ?? '',
                'shipcity'            => $addr_data['shipcity']     ?? '',
                'shipstate'           => $addr_data['shipstate']    ?? '',
                'shipzip'             => $addr_data['shipzip']      ?? '',
                'transaction_phone'   => $subentity_row->financial_phone   ?? '',
                'transaction_email'   => $subentity_row->financial_email   ?? '',
                'transaction_contact' => $subentity_row->financial_contact ?? '',
                'created_by'          => $_SESSION['tg_user_id'],
                'created_at'          => time(),
                'updated_by'          => $_SESSION['tg_user_id'],
                'updated_at'          => time(),
            ];

            $this->model->insert($txn_data, 'ccmps_financial_transactions');
        }
    }

    // -----------------------------------------------------------------------
    // 3b. SAVE aircraft records — a genuine one-to-many list, not a single
    //     merged row like everything above. Each submitted row either
    //     deletes an existing ccmps_aircraft row (if its "delete" checkbox
    //     was checked), updates an existing row (if it carries a real id
    //     matching one that belongs to this ccmp_id), or inserts a new one
    //     (if it has no id but has some real data in it). Completely blank
    //     rows — the empty "add another" placeholders the form always
    //     shows a couple of — are silently skipped.
    // -----------------------------------------------------------------------

    if (!empty($_POST['aircraft']) && is_array($_POST['aircraft'])) {

        $aircraft_fields = ['registration_number', 'make', 'model', 'hp', 'engines'];

        // Only allow updating aircraft rows that actually belong to this
        // person — never trust a submitted id blindly, or one member
        // could overwrite another member's aircraft by guessing an id.
        $existing_aircraft = $this->model->get_where_custom('ccmp_id', $ccmpid, '=', 'id', 'ccmps_aircraft');
        $owned_aircraft_ids = [];
        foreach ($existing_aircraft as $ac) {
            $owned_aircraft_ids[] = (string) $ac->id;
        }

        foreach ($_POST['aircraft'] as $row) {
            $ac_data = [];
            foreach ($aircraft_fields as $field) {
                if (isset($row[$field])) {
                    $ac_data[$field] = trim($row[$field]);
                }
            }
            $ac_data['own_rent'] = isset($row['own_rent']) ? 1 : 0;

            $has_real_data = false;
            foreach ($aircraft_fields as $field) {
                if (!empty($ac_data[$field])) {
                    $has_real_data = true;
                    break;
                }
            }

            $submitted_id = !empty($row['id']) ? (string) $row['id'] : '';
            $wants_delete = !empty($row['delete']);

            if ($submitted_id !== '' && in_array($submitted_id, $owned_aircraft_ids, true)) {
                if ($wants_delete) {
                    // Same ownership check as update — only ever delete a
                    // row that's actually confirmed to belong to this person.
                    $this->model->delete((int) $submitted_id, 'ccmps_aircraft');
                } else {
                    // Existing row that belongs to this person — update it,
                    // even if now blank (lets them clear a row out manually).
                    $this->model->update((int) $submitted_id, $ac_data, 'ccmps_aircraft');
                }
            } elseif ($submitted_id === '' && $has_real_data && !$wants_delete) {
                // Genuinely new row with real data — insert it.
                $ac_data['ccmp_id'] = $ccmpid;
                $this->model->insert($ac_data, 'ccmps_aircraft');
            }
            // Anything else (blank new row, or an id that doesn't belong
            // to this person) is silently ignored rather than saved.
        }
    }

    // Recalculate current/past-due/expired status based on current_year,
    // same trigger the original function called after every save.
    $this->recalcstatus($ccmpid);

    if ($dues_record_year) {
        $dues_opts = array('method' => 'other', 'note' => 'Current Year set on the record');
        if ($is_new_member) { $dues_opts['new_member'] = true; }
        list(, $dues_msg) = dues_record_chapter((int) $ccmpid, $dues_record_year, $dues_opts);
        $dues_note .= ' '.$dues_msg;
    } elseif ($dues_reverse_year) {
        list(, $dues_msg) = dues_reverse_chapter((int) $ccmpid, $dues_reverse_year, 'Current Year changed back on the record');
        $dues_note .= ' '.$dues_msg;
    }
    $flash_msg = (($crud == 'adding') ? 'The member was created successfully.' : 'The member was updated successfully.').$dues_note;
    set_flashdata($flash_msg);
if($_SESSION['actionmode'] == 'ccmpu'){ // if the member is updating their own record
    redirect(BASE_URL . 'welcome-ccmps/mydata/' . $ccmpid . '/1');
}else{ // one of the admins is updating the record
    redirect(BASE_URL . 'welcome-ccmps/viewccmp/' . $ccmpid . '/1');
}

}

/**
 * Pulls only whitelisted text/number fields out of $_POST.
 */
private function extract_text($source, $allowed_keys) {
    $result = [];
    foreach ($allowed_keys as $key) {
        if (isset($source[$key])) {
            $result[$key] = trim($source[$key]);
        }
    }
    return $result;
}

/**
 * Checkbox fields need special handling: an UNCHECKED checkbox is simply
 * absent from $_POST entirely (browsers don't submit unchecked boxes at
 * all) — so "not present" must be treated as 0, not skipped, or an admin
 * would never be able to un-check something once it was checked.
 */
private function extract_bools($source, $allowed_keys) {
    $result = [];
    foreach ($allowed_keys as $key) {
        $result[$key] = isset($source[$key]) ? 1 : 0;
    }
    return $result;
}


/*----------------------------------------------------------------------------*/
/*----------------------------- End ccmpsubmit -------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------ function _CCMPS_FETCH_DATA_FROM_POST --------------------*/
/*----------------------------------------------------------------------------*/

    function _ccmps_fetch_data_from_post() {  // anchor2
    // private function protected - attempt to direct access results in 404 error

    // Either a new or edited record could be posted to this function

    // All needed values to edit, create, or validate a record were passed to
    // the form to either visible or hidden controls.

    // Hidden controls are ones the user cannot, because of role or should not
    // because they are system controlled, edit - but may be needed to validate.

    // The posted values were named with the unique update/create field labels
    // concatenated and with spaces, asterisks, or underscores removed by the form.

    // Cannot simply use the db field names as control names because the form may
    // have fields from several tables with the same name combined with the fact
    // that fields are named on the fly using a loop as the controls are dynamically
    // created.

    // If you could db field names or if they were hard coded then this
    // section could be just one line: $data = $_POST; Those the user couldn't
    // edit would have been passed to and back to the controller by the hidden
    // fields unchanged.

   // Get only the values returned by the form depending on the role's rights to
   // data by having a case for each role.

   // The cases dont have a "break;" so each one executes if you qualfy for that
   // case so your $data is built up and we dont have to repeat lines of code
   // that are the same in different cases. You will notice all admins have the
   // last cas which includes the ccmp because in the Core, an admin can edit
   // anything a ccmp can.

 //$_SESSION['ccmpmode'] = 'mngsubentity'; // for testing


  //      echo('3616 All good!');
  //      print_r($_SESSION['ccmpmode']); die();
  //      json($_POST); die();


 //echo('3621');
 //json($data); die();
  if($_SESSION['ccmpmode'] == 'updatemydata' || $_SESSION['ccmpmode'] == 'mamu' || $_SESSION['ccmpmode'] == 'mngsubentity'){
    // DB Field Names             Unique Label Names  // $data[''] = post('', true);
 //echo(3625); die();
    // ccmp info
    $data['id']                = post('id', true); // passed from a hidden field
    $data['ccmp_type']           = post('idtype', true); // needed to validated if email is required (some teens dont have)
    $data['deceased']          = post('deceased', true); // need to prove ok not to have emailaddress or username
    $data['id_number']         = post('idnumber', true); // to satisfy duplicate check
    $data['username']          = post('username', true); // to satisfy duplicate check
   // $data['dob']               = post('dob', true); // enable when put in date picker
    $data['prefix']            = post('prefix');
    $data['first_name']        = post('first');
    $data['middle_name']       = post('middle');
    $data['last_name']         = post('last');
    $data['suffix']            = post('suffix');
    $data['employer']          = post('employer');
    $data['title']             = post('title');
    $data['gender']            = post('gender', true);
    $data['birthday']          = post('birthday');
    $data['department']        = post('department');
    $data['reports_to']        = post('supervisor');

    // Contacts
    $data['phone']             = post('phone');
    $data['work_phone']        = post('workphone');
    $data['mobile']            = post('mobile');
    $data['whatsapp']          = post('whatsapp');
    $data['email_address']     = post('email');
    $data['fax']               = post('fax');
    $data['tty']               = post('tty');
    $data['use_alt_contact']   = post('usealtcontact', true);

    $data['alternate_contact'] = post('alternatecontact');
    $data['alternate_phone']   = post('alternatephone');
    $data['alternate_email']   = post('alternateemail');

    $data['emergency_contact'] = post('emergencycontact');
    $data['emergency_phone']   = post('emergencyphone');
    $data['emergency_email']   = post('emergencyemail');

    // Addresses
    $data['mailaddress1']      = post('mailingaddr1');
    $data['mailaddress2']      = post('mailingaddr2');
    $data['mailcity']          = post('mailingcity');
    $data['mailstate']         = post('mailingstate');

    $data['mailzip']           = post('mailingzip');
    $data['mailcounty']        = post('mailingcounty');
    $orgmailcounty             = post('orgmailingcounty');

// checkpoint
/*
echo(3371);
echo('<br>');
echo('mailcounty');
print_r($data['mailcounty']);
echo('<br>');
echo('orgmailcounty');
// print_r($data['orgmailcounty']); die();
*/

if(strlen($data['mailcounty']) > 0){
}else{
    $data['mailcounty'] = $orgmailcounty;
}
    $data['mailcountry']    = post('mailingcountry');

    $data['mail_eq_phys']      = post('sameasmailing', true);
    $data['physaddress1']      = post('physicaladdr1');
    $data['physaddress2']      = post('physicaladdr2');
    $data['physcity']          = post('physicalcity');
    $data['physstate']         = post('physicalstate');
    $data['physzip']           = post('physicalzip');
    $data['physcounty']        = post('physicalcounty');
    $orgphyscounty             = post('orgphysicalcounty');

// checkpoint
/*
echo(3558);
echo('<br>');
echo('physcounty');
print_r($data['physcounty']);
echo('<br>');
echo('orgphyscounty');
// print_r($data['orgphyscounty']); die();
*/

if(strlen($data['physcounty']) > 0){
}else{

    $data['physcounty'] = $orgphyscounty;

}
    $data['physcountry']       = post('physicalcountry');

    // Miscellaneous
    $data['misc1']             = post('miscellaneous1');
    $data['misc2']             = post('miscellaneous2');
    $data['misc3']             = post('miscellaneous3');
    $data['alumnus']           = post('alumnus', true);
    $data['active_duty']       = post('activeduty', true);
    $data['former_military']   = post('formermilitary', true);

    // Preferences
    $data['limit_dir_info']    = post('limitdirinfo', true);
    $data['directoryoptout']   = post('directoryoptout', true);
    $data['emailoptout']       = post('emailoptout', true);
    $data['donotcall']         = post('donotcall', true);
    $data['mail_notices']      = post('mailnotices', true);
    $data['language']          = post('language', true);

    $data['force_pw_chg']      = post('forcepwchg', true);
    $data['inactive']          = post('inactive', true);
    $data['locked']            = post('locked', true);
  }

 if($_SESSION['ccmpmode'] == 'mamu' || $_SESSION['ccmpmode'] == 'mngsubentity'){

        // DB Field Names            Unique Label Names

    // ccmp info
    $data['vip']               = post('vip', true);
    $data['current_year']      = post('currentyear', true);
    $data['eligible_voter']    = post('eligiblevoter', true);
    $data['notes']             = post('notes', true);
    $data['subentity']         = post('subentity', true);
    $data['subentity_role']    = post('subentityrole', true);
    $data['national_officer']  = post('nationalofficer', true);
    $data['region']            = post('region', true);
    $data['minor']             = post('minor', true);
    $data['student']           = post('student', true);

    // User Account
    $data['subentity_admin']   = post('subentityadmin', true);
    $data['cms_admin']         = post('contentadmin', true);
    $data['admin']             = post('ccmpadmin', true);
    $data['student_admin']     = post('studentadmin', true);
    $data['system_admin']      = post('systemadmin', true); // if no honcho module

    $data['email_verified']    = post('emailverified', true);
    $data['timed_reset']       = post('timedreset', true);
    $data['reset_interval']    = post('resetinterval', true);

 }


echo(3787);
echo('<br>');
print_r($_SESSION['ccmpmode']);
echo('<br>');
echo('$data) = ');
// json($data); die();


/* Unused
$data['tfontsize']         = post('tfontsize', true);
$data['website']           = post('website', true);
$data['leadsource']        = post('leadsource', true);
 */

 /* These are only changed by the application

// ccmo info
$data['status']

// user acct
$data['id']
$data['username']
$data['level']
$data['second_factor']
$data['activate_code']
$data['ip_address']
$data['last_login']
$data['last_login_device']
$data['last_logout']
$data['num_logins']
$data['password']
$data['trongate_user_id']
$data['user_token']
$data['username']
$data['soft_deleted']
$data['picture']
$data['reset_code']

// Miscellaneous
$data['updated_at']
$data['updated_by']
$data['created_at']
$data['created_by']
*/

// new records this is or could be blank
//echo(3478);
//json($_SESSION); die();

    if(strlen($data['id_number']) > 0 ){
// if one is subbmitted do nothing
    }else{
         if($_SESSION['ccmpmode'] == 'mngsubentity' ){ // put all non-ccmp editing modes here
             // if admin is editing and wants to blank it out - ok
             // ccmp cant edit id number
         }else{
         //if it is a new record create one
            $token_length = 5;
            $characters = '23456789abcdefghjkmnpqrstuvwxyz';
            $random_code = '';
            for ($i = 0; $i < $token_length; $i++) {
                $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
            }

            $data['id_number'] = 'temp-'.$random_string;
         }
    }

        if(strlen($data['current_year']) > 0) {
// do nothing
        }else{
                 $data['current_year'] = $_SESSION['ccmps_current_year'] - 1;
        }

        if(strlen($data['language']) > 0) {
// do nothing
        }else{
                 $data['language'] = 1;
        }

// checkpoint

/*
echo(3845);
echo('<br>');
echo('Filtered posted data');
echo('<br>');
// json($data); die();
*/
    return $data;  // returns to anchor2 or

    }

/*------------------------------------------------------------------------------------------------
/*--------------------------- function _ADDR_FETCH_DATA_FROM_POST -------------------------------
/*------------------------------------------------------------------------------------------------
    function _addr_fetch_data_from_post() {
    // private function protected - 404 error
//echo(5483);
//json($_POST); die();

 //   $mailaddr_obj = $this->model->get_one_where('id', $mailrecid, 'ccmps_addresses');
//echo(5481);
//json( $mailaddr_obj); die();

    $mailaddrdata['address1']      = post('mailaddr1', true);
    $mailaddrdata['address2']      = post('mailaddr2', true);
    $mailaddrdata['city']          = post('mailcity', true);
    $mailaddrdata['state']         = post('mailstate', true);
    $mailaddrdata['zip']           = post('mailzip', true);
echo(5495);
// json($mailaddrdata); die();
    $physaddrdata['address1']      = post('physicaladdr1', true);
    $physaddrdata['address2']      = post('physicaladdr2', true);
    $physaddrdata['city']          = post('physicalcity', true);
    $physaddrdata['state']         = post('physicalstate', true);
    $physaddrdata['zip']           = post('physicalzip', true);
echo(5502);
// json($physaddrdata); die();




// evaluate mailphys - if yes then reset physaddresses to equal mailaddresses
    $data['mail_eq_phys']         = post('sameasmailing', true);

    if($data['mail_eq_phys'] == 1){
      $data['mail_eq_phys'] = 1;

      $data['physaddress1']      =     $data['mailaddress1'];
      $data['physaddress2']      =     $data['mailaddress2'];
      $data['physcity']          =     $data['mailcity'];
      $data['physstate']         =     $data['mailstate'];
      $data['physzip']           =     $data['mailzip'];

    }else{
      $data['mail_eq_phys'] = 0;

    }

return $data;

    }
*/

/*----------------------------------------------------------------------------*/
/*---------------- function _ADDR_SIMPLE_FETCH_DATA_FROM_POST ----------------*/
/*----------------------------------------------------------------------------*/

  function _addr_simple_fetch_data_from_post($mailrecid,$physrecid) {
    // private function protected - 404 error
//echo(5798);
//json($_POST); die();

    // CCMPS Address Table

    $data['mailaddress1']      = post('mailaddr1', true);
    $data['mailaddress2']      = post('mailaddr2', true);
    $data['mailcity']          = post('mailcity', true);
    $data['mailstate']         = post('mailstate', true);
    $data['mailzip']           = post('mailzip', true);
  //  $atdata['mailcountry']       = post('mailcountry', true);

    $data['physaddress1']      = post('physicaladdr1', true);
    $data['physaddress2']      = post('physicaladdr2', true);
    $data['physcity']          = post('physicalcity', true);
    $data['physstate']         = post('physstate', true);

    $data['physzip']           = post('physicalzip', true);
  //  $atdata['physcountry']       = post('physcountry', true);

// evaluate mailphys - if yes then reset physaddresses to equal mailaddresses
    $data['mail_eq_phys']         = post('sameasmailing', true);

    if($data['mail_eq_phys'] == 1){
      $data['mail_eq_phys'] = 1;

      $data['physaddress1']      =     $data['mailaddress1'];
      $data['physaddress2']      =     $data['mailaddress2'];
      $data['physcity']          =     $data['mailcity'];
      $data['physstate']         =     $data['mailstate'];
      $data['physzip']           =     $data['mailzip'];

    }else{
      $data['mail_eq_phys'] = 0;

    }

    return $data;

    }

/*----------------------------------------------------------------------------*/
/*---------------- function _FINANCIAL_FETCH_DATA_FROM_POST ------------------*/
/*----------------------------------------------------------------------------*/

  function _financial_fetch_data_from_post() {
    // private function protected - 404 error
//echo(5842);
//json($_POST); die();
    // Financial Table

  //  $data['fin_id']             = post('fin_id', true);
  //  $data['fin_code']           = post('fin_code', true);
  //  $data['ccmp_id']            = post('ccmp_id', true);

  //  $data['acct_bal']           = post('acct_bal', true);
  // only viewing not getting for now
    $data['fin_email']          = post('billingemail', true);
    $data['billname']           = post('billtoname', true);
    $data['billphone']          = post('billtophone', true);
    $data['billaddress1']       = post('billaddress1', true);
    $data['billaddress2']       = post('billaddress2', true);
    $data['billcity']           = post('billcity', true);
    $data['billstate']          = post('billstate', true);
    $data['billzip']            = post('billzip', true);

    $data['shipname']           = post('shiptoname', true);
    $data['shipphone']          = post('shiptophone', true);
    $data['shipaddress1']       = post('shipaddress1', true);
    $data['shipaddress2']       = post('shipaddress2', true);
    $data['shipcity']           = post('shipcity', true);
    $data['shipstate']          = post('shipstate', true);
    $data['shipzip']            = post('shipzip', true);

    $data['fin_acct_type']      = post('fin_acct_type', true);
    $data['fin_status']         = post('fin_status', true);

    $data['fin_notes']          = post('fin_notes', true);



/*  $data['fin_date_created']   = post('fin_date_created', true);
    $data['fin_created_by']     = post('fin_created_by', true);
    $data['fin_updated_by']     = post('fin_updated_by', true);
    $data['fin_created_at']     = post('fin_created_at', true);
    $data['fin_updated_at']     = post('fin_updated_at', true);
*/

    $fin_billship     = post('fin_billship', true);
 //   print_r($fin_billship); die();

    If($fin_billship == 1){
      $data['fin_billship'] = 1;

      $data['shipname']           = $data['billname']  ;
      $data['shipphone']          = $data['billphone'];
      $data['shipaddress1']       = $data['billaddress1'];
      $data['shipaddress2']       = $data['billaddress2'];
      $data['shipcity']           = $data['billcity'];
      $data['shipstate']          = $data['billstate'];
      $data['shipzip']            = $data['billzip'];

    }else{
      $data['fin_billship'] = 0;
    }

    $fin_inactive     = post('fin_inactive', true);

/*
echo('Line 1035 - Fetch Financial Data From Post:  ');
echo('<br>');
// json($findata); die();

*/
//echo('1384');
  //  print_r($data);

 //   $convdata = $this->_convert_posted_fintbl_to_numerics($data);
 // print_r($convdata); die();
 //   $data = array_merge($data, $convdata);
//echo('Line 1395');
//print_r($data); die();

      return $data;  // goes to 310 &
    }


/*----------------------------------------------------------------------------*/
/*---------------- function _CONVERT_POSTED_FINTBL_TO_NUMERICS ---------------*/
/*----------------------------------------------------------------------------*/

  function _convert_posted_fintbl_to_numerics($data = NULL) {  // posted data must be converted to save to DB or sent back to create form on failed validation
    // private function protected - 404 error

   $finobj = $this->model->get_one_where('fin_type_title',$data['fin_acct_type'],'ccmps_financial_types');
 //  echo('1405 ');
 //  print_r($finobj); die();
   $data['fin_acct_type'] = $finobj->id;

   $finobj2 = $this->model->get_one_where('fin_status_title',$data['fin_status'],'ccmps_financial_statuses');
  // echo('1410 ');
  // print_r($finobj2); die();
   $data['fin_status'] = $finobj2->id;

   return $data;

}


// -------------------------------------------------------------------------- //
// ---------------------  function _get_subentity_data ---------------------- //
// -------------------------------------------------------------------------- //

   function _get_subentity_data() {
 // protected - get 404 error if not logged in

//print_r($_SESSION['ccmp_rec_id']); die();
          $userobj = $this->model->get_one_where('id', $_SESSION['ccmp_rec_id'], 'ccmps');

//print_r($userobj); die();
          $subentityid              = $userobj->subentity;
 //print_r($subentityid); die();
          $subentityobj             = $this->model->get_where($subentityid,'ccmps_subentities');
          $data['subentity_name']   = $subentityobj->description;
          $data['subentity']        = $subentityobj->id;
          $data['ccmphomepage']   = $subentityobj->ccmphomepage;

          return $data;
    }

// -------------------  function end _get_subentity_data -------------------- //

// -------------------------------------------------------------------------- //
// ------------------- function _CREATE_DROPDOWN_MENUS ---------------------- //
// -------------------------------------------------------------------------- //

function _create_dropdown_menus(){

    // genders
    $data['genders'] = $this->model->get('id','ref_genders');

    // subentitys
    $data['subentities'] = $this->model->get('id','ccmps_subentities');

    // subentity roles
    $data['ccmpsubentityroles'] = $this->model->get('id','ccmps_subentity_roles');

    // national roles
    $data['nationalroles'] = $this->model->get('id','ref_national_offices');

    // states
    $data['state_codes'] = $this->model->get('id','ref_states');

    // membership types
    $data['ccmptypes'] = $this->model->query('SELECT * FROM ccmps_types WHERE active = 1 ORDER BY id', 'object'); // switched-off types (Family, retired 2026-10-31) aren't offered



    // Highest Certificate
 //   $data['highestcerts'] = $this->model->get('id','ccmps_certificate_types');


    // Financial Acct Types
    // $data['accttypes'] = $this->model->get('id','ccmps_financial_types');


    // Financial Acct Status
    // $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses');
 //json($data); die();
  return $data;

}

// ------------------- end _CREATE_DROPDOWN_MENUS ---------------------- //
//
// -------------------------------------------------------------------------- //
// ------------------- function _CONVERT_TO_USER_FRIEDLY -------------------- //
// -------------------------------------------------------------------------- //

function _convert_to_user_friendly($data) { // anchor3 - invoked after _get_a_single_record() when viewing a record read-only
    // $data is an ARRAY (from _get_a_single_record), not an object — every
    // lookup below uses array syntax to match.

    /*------------------- Codes to friendly names -------------------------*/

    // Real lookup against ccmps_status, rather than assuming which ids exist.
    if (!empty($data['status'])) {
        $obj = $this->model->get_where($data['status'], 'ccmps_status');
        $data['status'] = $obj ? $obj->title : 'Unknown';
    } else {
        $data['status'] = 'Unknown';
    }

    if (!empty($data['ccmp_type'])) {
        $obj = $this->model->get_where($data['ccmp_type'], 'ccmps_types');
        $data['ccmp_type'] = $obj ? $obj->description : $data['ccmp_type'];
    } else {
        $data['ccmp_type'] = ''; // nothing selected (0/default) — show blank, not the raw id
    }

    if (!empty($data['subentity'])) {
        $data['subentity_id'] = $data['subentity']; // raw id, preserved for same-chapter permission checks
        $obj = $this->model->get_where($data['subentity'], 'ccmps_subentities');
        $data['subentity'] = $obj ? $obj->chapter_title : $data['subentity'];
    } else {
        $data['subentity'] = ''; // nothing selected (0/default) — show blank, not the raw id
    }

    // Confirmed directly by user (Aug 27) — real table is ccmps_subentity_roles.
    // (An earlier "confirmation" from the legacy code's own string literal,
    // ccmps_subentity_offices, turned out to be wrong — that table doesn't
    // exist. Legacy code referencing a name isn't proof it's correct.)
    if (!empty($data['subentity_role'])) {
        $obj = $this->model->get_where($data['subentity_role'], 'ccmps_subentity_roles');
        $data['subentity_role'] = $obj ? $obj->title : $data['subentity_role'];
    } else {
        $data['subentity_role'] = ''; // nothing selected (0/default) — show blank, not the raw id
    }

    if (!empty($data['subentity_region'])) {
        $obj = $this->model->get_where($data['subentity_region'], 'ref_region_codes');
        $data['subentity_region'] = $obj ? $obj->description : $data['subentity_region'];
    }

    if (!empty($data['region'])) {
        $obj = $this->model->get_where($data['region'], 'ref_region_codes');
        $data['region'] = $obj ? $obj->description : $data['region'];
    } else {
        $data['region'] = ''; // nothing selected (0/default) — show blank, not the raw id
    }

    if (!empty($data['salutation'])) {
        $obj = $this->model->get_where($data['salutation'], 'ref_salutations');
        $data['salutation'] = $obj ? $obj->title : $data['salutation'];
    } else {
        $data['salutation'] = ''; // nothing selected (0/default) — show blank, not the raw id
    }

    // Font-size element preferences (tab/header/label/value/button) — each
    // stores an id pointing at ccmps_settings. Same fragility guard as the
    // inline style generator in inspinia.php: if the stored id is missing
    // or points at the wrong type (stale data after a reseed), fall back
    // to that type's "medium" row found by matching type+title, never by
    // assuming a specific id.
    $fontsize_element_fields = [
        'tab_setting'    => 'tab',
        'header_setting' => 'header',
        'label_setting'  => 'label',
        'value_setting'  => 'value',
        'button_setting' => 'button',
    ];
    if (array_intersect_key($fontsize_element_fields, $data)) {
        $all_ccmps_settings = $this->model->get('id', 'ccmps_settings');
        foreach ($fontsize_element_fields as $field => $type) {
            if (!array_key_exists($field, $data)) {
                continue;
            }
            $chosen_id = $data[$field];
            $row = null;
            foreach ($all_ccmps_settings as $candidate) {
                if ((string) $candidate->id === (string) $chosen_id && $candidate->type === $type) {
                    $row = $candidate;
                    break;
                }
            }
            if (!$row) {
                foreach ($all_ccmps_settings as $candidate) {
                    if ($candidate->type === $type && $candidate->title === 'medium') {
                        $row = $candidate;
                        break;
                    }
                }
            }
            $data[$field] = $row ? $row->description : '';
        }
    }

    if (!empty($data['gender'])) {
        $obj = $this->model->get_where($data['gender'], 'ref_genders');
        $data['gender'] = $obj ? $obj->description : $data['gender'];
    }

    if (!empty($data['national_officer'])) {
        $obj = $this->model->get_where($data['national_officer'], 'ref_national_offices');
        $data['national_officer'] = $obj ? $obj->description : $data['national_officer'];
    }

    if (!empty($data['language'])) {
        $obj = $this->model->get_where($data['language'], 'ref_languages');
        $data['language'] = $obj ? $obj->title : $data['language']; // title, not description — per confirmed spec
    }

    if (!empty($data['leadsource'])) {
        $obj = $this->model->get_where($data['leadsource'], 'ref_leadsource');
        $data['leadsource'] = $obj ? $obj->title . (!empty($obj->referrer) ? ' (' . $obj->referrer . ')' : '') : $data['leadsource'];
    } else {
        $data['leadsource'] = 'NA';
    }

    switch ((int) ($data['last_login_device'] ?? 0)) {
        case 1: $data['last_login_device'] = 'Computer/Laptop'; break;
        case 2: $data['last_login_device'] = 'Phone'; break;
        default: $data['last_login_device'] = 'Never Logged In'; break;
    }

    /*------------------- Binary Yes/No fields ------------------------------*/
    // Removed entirely — viewccmp.php's vf_bool_row() reads these fields
    // directly with its own !empty() check to decide which icon to show
    // (checked square vs. empty square). Pre-converting them to the
    // strings 'Yes'/'No' here meant vf_bool_row() saw a non-empty string
    // either way and showed every icon as checked regardless of the real
    // value — same bug class as the edit form's checkboxes, just also
    // present on the view page. Raw 0/1 values now pass through untouched.


    /*------------------- Dates --------------------------------------------*/

    $format = 'datepicker_us';
    $this->module('timedate');

    $date_fields = ['dob', 'last_login', 'last_logout', 'date_created', 'updated_at', 'created_at'];

    foreach ($date_fields as $field) {
        if (!empty($data[$field])) {
            $data[$field . '_raw'] = $data[$field]; // preserve the raw value before formatting
            $data[$field] = $this->timedate->get_nice_date($data[$field], $format);
            if ($data[$field] == '01/01/1970') {
                $data[$field] = ''; // blank out the epoch-zero false date
            }
        } else {
            $data[$field] = '';
        }
    }

    // Token expiration — depends on trongate_user_id / trongate_tokens,
    // both carried over from the original function; not independently
    // re-verified against your current schema this pass.
    if (!empty($data['trongate_user_id'])) {
        $token_row = $this->model->get_where_custom('user_id', $data['trongate_user_id'], '=', 'id', 'trongate_tokens');
        $tokenexpires = $token_row[0]->expiry_date ?? null;

        if (!empty($tokenexpires)) {
            $data['token_expires'] = $this->timedate->get_nice_date($tokenexpires, $format);
            if ($data['token_expires'] == '01/01/1970') {
                $data['token_expires'] = '';
            }
        } else {
            $data['token_expires'] = 'No Token Found';
        }
    }

    return $data;
}

// -------------------------------------------------------------------------- //
// -------------- function _CONVERT_NULL_INTEGERS_TO_ZEROS ------------------ //
// -------------------------------------------------------------------------- //

function _convert_null_integers_to_zeros($data){ // anchor4

// if any of these iteger valueswere null on the save it would cause an error.
    // could check each one and set to a value and log the error
 /*
    "status": 2,
    "approved": 1,
    "email_verified": 1,
    "locked": 0,
    "inactive": 0,
    "language": 1,
    "ccmp_type": 1,
    "minor": 0,
    "subentity": 2,
    "subentity_role": 1,
    "cms_admin": 1,
    "student_admin": 1,
    "subentity_admin": 1,
    "admin": 1,
    "system_admin": 1,
    "national_officer": 10,
    "eligible_voter": 0,
    "gender": 1,
    "dob": 0,
    "use_alt_contact": 0,
    "alumnus": 1,
    "active_duty": 1,
    "former_military": 0,
    "student": 0,
    "region": 1,
    "emailoptout": 0,
    "directoryoptout": 0,
    "limit_dir_info": 0,
    "mail_notices": 0,
    "mail_eq_phys": 0,
    "bill_eq_ship": 0,
    "deceased": 0,
    "vip": 0,
    "leadsource": 0,
    "date_created": 0,
    "num_logins": 0,
    "last_login_device": 1,
    "force_pw_chg": 0,
    "timed_reset": 0,
    "reset_interval": 0,
    "soft_deleted": 0,
    "created_by": 0,
    "created_at": 0,
    "updated_by": 3,
    "updated_at": 1705322307,
    "tguserlevel": 7,

if($data['eligible_voter'] !=1) {
  $data['eligible_voter'] = 0;
}

if($data['student_admin'] != 1) {
  $data['student_admin'] = 0;
}

if($data['cms_admin'] != 1) {
  $data['cms_admin'] = 0;
}

if($data['subentity_admin'] != 1) {
  $data['subentity_admin'] = 0;
}

if($data['admin'] != 1) {
  $data['admin'] = 0;
}

if($data['system_admin'] != 1) {
  $data['system_admin'] = 0;
}

if($data['emailoptout'] !=1) {
  $data['emailoptout'] = 0;
}

if($data['directoryoptout'] !=1) {
  $data['directoryoptout'] = 0;
}

if($data['donotcall'] !=1) {
  $data['donotcall'] = 0;
}

if($data['mail_notices'] !=1) {
  $data['mail_notices'] = 0;
}

if($data['deceased'] !=1) {
  $data['deceased'] = 0;
}

if($data['alumnus'] !=1) {
  $data['alumnus'] = 0;
}

if($data['active_duty'] !=1) {
  $data['active_duty'] = 0;
}

if($data['former_military'] !=1) {
  $data['former_military'] = 0;
}

if($data['vip'] !=1) {
  $data['vip'] = 0;
}

  if($data['student'] !=1) {
    $data['student'] = 0;
  }

if($data['minor'] !=1) {
  $data['minor'] = 0;
}
*/
  return $data;

} //end function

// ------------------ end _CONVERT_NULL_INTEGERS_TO_ZEROS ------------------- //

// -------------------------------------------------------------------------- //
// ---------------------------- function BULKACTION ------------------------- //
// -------------------------------------------------------------------------- //

  function bulkaction() {
  // $ccmpsfunction = 'bulkaction';
  // $authorized = $this->_check_function_permissions($ccmpsfunction);
 //       print_r($_SESSION); die();
/*
echo(155);
print_r($_POST); // array of ids called id
// print_r($_POST['selected']); die(); // the dropdown item id
*/
        // Admins only, and only the selected members they're an admin for (2026-10-27)
        if (empty($_SESSION['trongatetoken']) || !$this->_member_access(0, 'create')) {
            $this->_deny_member_access();
        }
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            $_POST['id'] = array_values(array_filter($_POST['id'], function ($id) {
                return strlen((string) $id) > 0 && $this->_member_access($id, 'admin');
            }));
        }

        $data = $_POST; // array of record ids called id & the dropdown item id

        // Chapter Dues Paid (11), and the old Current Year (2) once the dues engine is on: a confirmation page
        // records each ticked member through the dues steps (fin/bulkchapterdues; dues step 3, 2026-10-31)
        if ((string) ($_POST['selected'] ?? '') === '12' && dues_engine_on() && rbac_allowed('fin', 'settle_national_dues')) { // National Dues Paid (FIN-31)
            $_SESSION['fin_inv_ids'] = array_values(array_map('intval', (array) ($_POST['id'] ?? array())));
            redirect('fin/invoices?picked=1&return='.rawurlencode('welcome-ccmps/manage/'.($_SESSION['ccmpmode'] ?? '')));
        }
        if (in_array((string) ($_POST['selected'] ?? ''), array('2', '11'), true) && dues_engine_on()) {
            $_SESSION['fin_bulk_ids']    = array_values(array_map('intval', (array) ($_POST['id'] ?? array())));
            $_SESSION['fin_bulk_return'] = 'welcome-ccmps/manage/'.($_SESSION['ccmpmode'] ?? '');
            redirect('fin/bulkchapterdues');
        }

        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action

                if(!isset($data)){
                    // die('Nothing Checked');
                }else{
 // print_r($data); die('SomethingChecked but no action chosen');
                }
        break;

         case '2': // Make Current
                if(!isset($data)){
                   // die('Nothing Checked');
                }else{
//print_r($data);
//print_r($data['id']) ; die('make current');
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $mcid           = $row; // got the row number
                            $currentyear = $_SESSION['ccmps_current_year'] ;

    if($currentyear < 2023){
        $currentyear = 2023;
  //  echo(187); die();
        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'ccmps-bulkaction-110';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: ccmps';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['ccmpmode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    }

                            $mcdata['current_year'] = $currentyear ;
//print_r($mcid );
//print_r($mcdata); die();
                            $this->model->update($mcid, $mcdata, 'ccmps');
                            $recalc = $this->recalcstatus($mcid);// nothing done with recalc, just trigger.

                 //           print_r('ccmp line 214 made current all'); die();
                        }else{
                            // echo('Line 216 ccmps - row IS BLANK'); die();
                        }
                    } // end foreach
                }
        break;

         case '3': // Create Acct

       //  print_r($data); die();
                if(!isset($data)){ // ignored because [selected] = 3 in array
                    // die('Nothing Checked');

                }else{


        foreach($data['id'] as $row){

        $recid = $row;
        $usrobj = $this->model->get_one_where('id', $recid,'ccmps');

        $chptnum = $usrobj->subentity;
        $subentityobj = $this->model->get_one_where('id', $chptnum,'ccmps_subentities');
//echo(107);
//print_r($recid); die();
//print_r($chptnum); die();


        // for trongate_users table
        // $data['user_level_id']  = DEFAULT_CCMP_USER_LEVEL;


        // loop through with ccmp record id
        // get email address and assign to username

        $emailaddr = $usrobj->email_address;
        $username  = $usrobj->username;

        if(strlen($username) > 0){
            // username & therefore an account already exists so skip adding
           // echo(136);
           //     print_r($username); die();
        }else{
            if(strlen($emailaddr) > 0){ // if email exists
                 $datac['username'] = $emailaddr;
            }else{
                // if no email set username to random 6 alphanumeric string
                $token_length = 5;
                $characters = '23456789abcdefghjkmnpqrstuvwxyz';
                $random_code = '';
                for ($i = 0; $i < $token_length; $i++) {
                    $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
                }
                $datac['username'] = 'temp-'.$random_string;
            }

                // for ccmps table
                $datac['password']       = DEFAULT_CCMP_PASSWORD;
              //  $data['subentity']        = $subentityobj->id; // dropdown not shown for new records
                $datac['force_pw_chg']   = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0

            // save new record to trongate users and get trongate_user_id for ccmps table
                $usrlvl['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
                $usrlvl['user_acct_info_table'] = 'ccmps';
                $usrlvl['code'] = $this->_generate_rand_code();
    //echo(155);
    //print_r($usrlvl); die();
                $this->model->insert($usrlvl, 'trongate_users');
                $datac['trongate_user_id']  = $this->model->get_max('trongate_users');

                // Save user acct data to ccmps
                $this->model->update($recid, $datac, 'ccmps');

        } // end if username exists
   // print_r($recid);
   // print_r($datac); die();

  //print_r($data); die('Create Acct');
                }

        } // end foreach

        break;

         case '4': // Lock Acct   - not implemented
                if(!isset($data)){
                    // die('Nothing Checked');
                }else{
  // print_r($data); die('Lock Acct');
                }
        break;

         case '5': // Unlock Acct - not implemented
                if(!isset($data)){
                    // die('Nothing Checked');
                }else{
  // print_r($data); die('Unlock Acct');
                }
        break;

         case '6':
                if(!isset($data)){
                   // die('Nothing Checked');
                }else{
  // print_r($data); die('Approve Account');
                }

        break;

         case '7':
                if(!isset($data)){
                   // die('Nothing Checked');
                }else{
  // print_r($data); die('Approve Member');
                }
        break;

         case '8':
                if(!isset($data)){
                   // die('Nothing Checked');
                }else{
 //  print_r($data);
  //print_r($data['id']) ; die('Delete');
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number
                            $deldata['soft_deleted'] = 1;
                        //    unset($data['selected']); // not in DB throws error
                        //    unset($data['id']); // no value, it was value of
                        //                        // selected item in dropdown 1-8
                        //    unset($data); // removes [DataTables_Table_0_length] => 25
                            $data['soft_deleted'] = 1;
//print_r($delid );
//print_r($deldata); die();
                            $this->model->update($delid, $deldata, 'ccmps');
                            $this->recalcstatus($delid); // deleted members have no status
                            //print_r('deleted all'); die();
                        }else{
                            // echo('Line 141 ccmps - row IS BLANK'); die();
                        }
                    } // end foreach
                }

        break;

         case '9':
                if(!isset($data)){
                   // die('Nothing Checked');
                }else{
  // print_r($data); die('Archive');
                }

        break;

         case '10': // Undelete (2026-10-31): bring back deleted members, then their status
                foreach((array) ($data['id'] ?? array()) as $row){
                    if(strlen((string) $row) > 0){
                        $this->model->update((int) $row, array('soft_deleted' => 0), 'ccmps');
                        $this->recalcstatus((int) $row);
                    }
                }
        break;

        }

        echo('4939 All good!');
        // print_r($_SESSION['ccmpmode']); die();

        switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
          case 'momm': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

                case 'mosm': // managing our subentity student members - used for student members only (S or Q)
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmm': // managing current members - used for student members only (S or Q)
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mngallccmps': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;

          case 'momv': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

          case 'mosv': // managing our current subentity student members - used for student members only
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmv': // managing current members - used for student members only
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mamv': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;
        }

  }
// ---------------------------- end bulkaction  ----------------------------- //

// -------------------------------------------------------------------------- //
// ----------------------------- function FONTSIZE -------------------------- //
// -------------------------------------------------------------------------- //

  function fontsize() {  // call by ajax function in template inspinia.php
  // navbar.php calls ajax in inspinia.php
//*----------------- Get logged in user's info & preferences ----------------*/
      // If there is ANY error in the function code the execution with fail
      // with no error messages surfaced. This code must be perfect!

      // Get the input values posted here
      //Do not use $_POST when called by an ajax function. Use plain post.

      $fs     = post('fontsize');
     // $mfs    = post('tfontsize');
      $sarid  = post('recid');

// If the user entered something that was not 1,2,3 then set it to 2 medium for pages
// NOTE: no longer entered, dropdown menu hard coded for 1,2 or 3
if($fs == 1 || $fs == 2 || $fs == 3){
}else{
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 0;
    $fs = 2; // default to medium if no value
}

if($fs == 1){  // override tabs choice and make horz if large font
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 1;
}else{
    $_SESSION['CCMPS_VIEW_TABS_HORZ'] = 0;

}

// If the user entered something that was not 1,2,3 then set it to 3 small for tables
//if($mfs == 1 || $mfs == 2 || $mfs == 3 || $mfs == 4){
//}else{
//    $mfs = 3;
//}
 //print_r($sarid); die();
      $fontdata['fontsize']   = $fs;
 //     $fontdata['tfontsize']  = $mfs;
// echo(4691); die();
      $this->model->update($sarid, $fontdata, 'ccmps');
// Just saved the new font values
// Get font size preference for views & manage page
  $this->_get_font_sizes();
//  redirect('');
  }

// ------------------------------- end FONTSIZE ----------------------------- //

  // -------------------------------------------------------------------------- //
// ------------------------ function GETDATA AJAX ------------------------ //
// -------------------------------------------------------------------------- //

  function getmailcntydata() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.
    // Only way to see any values here is in Developer Tools in Chrome. json, print_r, echo, etc die(); wont work!
    // Go to Chrome Network, clear, click on Name: getcntydata. Then Payload: mailingstate: {value posted}

      if(isset($_POST['mailingstate'])){
          $mstid = $_POST['mailingstate'];

          $sql = "SELECT * FROM ref_counties WHERE state = '$mstid'";
          $mailcntys = $this->model->query($sql,'array');

        // var_dump($mailcntys); // wont see on screen, look in Chrome Name: getcntydata. Then Reponse: (array)
         //  $mailcntys = (array) $mailcntys;

         if($mailcntys !=NULL){
            // echo '<option>Select County</option>';
             foreach($mailcntys as $cnty){
                 echo '<option value="'.$cnty['fips'].'">'.$cnty['title'].'</option>';

             }
         }else{
                 echo '<option>No Counties Found</option>';

         }

      }


  }

// ------------------------ end getmailcntydata ajax ------------------------ //

    function getphyscntydata() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.
    // Only way to see any values here is in Developer Tools in Chrome. json, print_r, echo, etc die(); wont work!
    // Go to Chrome Network, clear, click on Name: getcntydata. Then Payload: mailingstate: {value posted}

      if(isset($_POST['physicalstate'])){
          $pstid = $_POST['physicalstate'];

          $sql = "SELECT * FROM ref_counties WHERE state = '$pstid'";
          $physcntys = $this->model->query($sql,'array');

        // var_dump($physcntys); // wont see on screen, look in Chrome Name: getcntydata. Then Reponse: (array)
         //  $physcntys = (array) $mailcntys;

         if($physcntys !=NULL){
            // echo '<option>Select County</option>';
             foreach($physcntys as $pcnty){
                 echo '<option value="'.$pcnty['fips'].'">'.$pcnty['title'].'</option>';

             }
         }else{
                 echo '<option>No Counties Found</option>';

         }

      }


  }

// ------------------------ end getphyscntydata ajax ------------------------ //
//
// -------------------------------------------------------------------------- //
// ------------------------ function FETCHCNTYS AJAX ------------------------ //
// -------------------------------------------------------------------------- //

  function fetchcntys() {  // called by ajax function in template inspinia.php

    // If there is ANY error in the function code the execution with fail
    // with no error messages surfaced. This code must be perfect!

    // Get the input values posted here
    // Do not use $_POST when called by an ajax function. Use plain post.

    $mstid     = post('mstid');
  //$mailcntys = $this->model->get_where_custom('state', $_POST['mstid'] ,'=', 'id', 'ref_counties');
    $mailcntys = $this->model->get_where_custom('state', $mstid ,'=', 'id', 'ref_counties');
   // $mailcntys = (array)$mailcntys;

    echo  $mailcntys;
  }

// ------------------------ end fetchcntys ajax ----------------------------- //

/*----------------------- Function createccmpuseraccount ---------------------*/

function createccmpuseraccount($reposted=NULL){ // may be first time or with values after failed validation


  $recid    = segment(3); //
  $_SESSION['returnto'] = segment(4); // if come from the manage page vs. view page - is this used ???

  if (empty($_SESSION['trongatetoken']) || !$this->_member_access($recid, 'admin')) {
      $this->_deny_member_access(); // an admin for this member only (2026-10-27)
  }

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

//echo(4979);
//print_r($recid); die();

//print_r($_SESSION['returnto']; die();

// Get subentity name for the page header
//print_r($_SESSION['tg_user_id']); die();

//print_r($data); die();
$reposted = 0; // ???
/*-------------------------------- Set create page values ----------------------------------------*/
if($reposted > 0){ // if this is a subsequent try at adding after a failed validation

  $recid = $reposted;
  //echo('2639:');
//print_r($recid); die();

        // Reinitialize dropdowns to prior value from a failed add if it exists
        // so user wont have to reselt. If first attempt at adding they wont exist.
        // will exist on future add attempts
        // Note: Yes/No and field values are reset by recalling _fetch_data_from_post()
// Search create.php for for "foreach" to find them

//echo('1273 member type:') ;
//print_r($data['ccmp_type']); die();

// subentity admin, aircraft owner, accout type
/*
        $data['genderid']      = $data['gender'];
        $data['subentityid']     = $data['subentity'];
        $data['membertypeid']  = $data['ccmp_type'];
        $data['subentityroleid'] = $data['subentity_role'];
        $data['mailstateid'] = $data['mailstate'];
        $data['physstateid'] = $data['physstate'];
        $data['highestcertid'] = $data['highest_certificate'];
        $data['accttypeid']    = $data['fin_acct_type'];
        $data['finstatusid']   = $data['fin_status'];
        $data['physstateid'] = $data['billstate'];
        $data['shipstateid'] = $data['shipstate'];
*/
        // User Level is not surfaced for update
        // $data['usrlvlid']   = $data['user_level_id'];

//echo('line 1243');
//print_r($data['accttypeid'] ); die();

}else{ // Set default values for new records

        $data['password'] = DEFAULT_CCMP_PASSWORD;
        // Subentity Id
        $data['subentity'] = $subentityobj->id; // dropdown not shown for new records
        $data['recid']   = $recid;

        $data['force_pw_chg']  = FORCE_PW_CHG_NEW_CCMP; // 1 OR 0
        $data['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
        $data['first_name'] = $usrobj->first_name;
        $data['last_name'] = $usrobj->last_name;
        $data['email_address'] = $usrobj->email_address;
        $data['eligible_voter'] = 0;
        $data['minor'] = 0;
        $data['national_officer'] = 10;
        //Dropdowns
        // Gender - Let it default to male
        // $data['membertypeid '] = 1; Let it default to regular
     /*
        $data['subentityroleid'] = 10; // regular member
        $data['mailstateid'] = 'NA'; // Unknown - using code and not id
        $data['physstateid'] = 'NA'; // Unknown
        $data['highestcertid'] = 14; // none
        $data['accttypeid']    = 1; // Personal financial acct
        $data['finstatusid']   = 9; // Unused - account never been used
        $data['physstateid'] = 'NA'; // Unknown
        $data['shipstateid'] = 'NA'; // Unknown
        */
}

/*------------------------- Populate Dropdowns  ------------------------------*/
/*
        // membership types
        $data['ccmptypes'] = $this->model->query('SELECT * FROM ccmps_types WHERE active = 1 ORDER BY id', 'object'); // switched-off types (Family, retired 2026-10-31) aren't offered

        // certificate types
        $data['cert_titles'] = $this->model->get('id','ccmps_certificate_types');

        // subentitys
        $data['subentitys'] = $this->model->get('id','ccmps_subentities');

        // subentity roles
        $data['subentityroles'] = $this->model->get('id','ccmps_subentity_roles');

        // states
        $data['state_codes'] = $this->model->get('id','ref_states');

        // genders
        $data['genders'] = $this->model->get('id','ref_genders'); // was 'genders', which doesn't exist (2026-10-27)

        // Highest Certificate
        $data['highestcerts'] = $this->model->get('id','ccmps_certificate_types');

        // Financial Acct Types
        // $data['accttypes'] = $this->model->get('id','ccmps_financial_types');

        // Financial Acct Status
        // $data['finstatuses'] = $this->model->get('id','ccmps_financial_statuses');
*/

if(SKIP_CHG_DEFAULT_USERNAME == 1){ // currently set to 1

//unset($data['eligible_voter']); // where did this come from ???
//echo('line 3943 ');
//print_r($data); die();

  $this->ccmpuseracctsubmit($data);

 }else{

    $data['bc1'] = CCMPSSUBENTITY.' Admin';
    $data['bc2'] = 'Create User Account';
    $data['view_module']   = 'welcome/ccmps';
    $data['view_file']     = 'ccmpuseracctcreate'; //
//echo('line 2263 ');
//print_r($data); die();
    $this->templates->inspinia($this->_with_fontsize_style($data));
}

}

/*------------------ End function createccmpuseraccount ----------------------*/

/*----------------------- Function ccmpuseracctsubmit ------------------------*/


function ccmpuseracctsubmit($data = NULL){ // subentity admin on computer needs edit/create form create.php

// print_r($rid); die();

if(SKIP_CHG_DEFAULT_USERNAME == 1){
  $_POST = $data; // fool it to think it was posted
  $recid = $data['recid'];
  $submit = 'Submit';
}else{
  $recid = post('id', true);// get ccmp number to add user account to
  $submit = post('submit', true);
}

if (empty($_SESSION['trongatetoken']) || !$this->_member_access($recid, 'admin')) {
    $this->_deny_member_access(); // an admin for this member only (2026-10-27)
}

/*
  print_r($recid);
 // die();
*/


//$fn    = post('first_name', true);
   //   print_r($fn); die();

//print_r($_POST); die();

  if ($submit == 'Submit') { // in case where use the same form for viewing, updating and creating (we are not). If viewing OR updating or creating

// echo('Line 3989 - submit == Submit'); die();

//print_r($_POST); die();
// using JS
          //a check for duplicate member number below also can check if required
          //a check for duplicate emai addrees below also checks for required but this one checks format
       //   $this->validation_helper->set_rules('email_address', 'Contact Email', 'required|valid_email'); // optional I check for it below
          // will make username the email address later if left blank
        //  $this->validation_helper->set_rules('username',      'Username', 'required|min_length[5]');
      // validate the form - if it fails to will keeep executing
     //   $result = $this->validation_helper->run();
$result = 1;

//print_r($result); die();
        // dont do anything yet if failed because still need to cobble together what was posted and send back to the form
        // converted to numerics - $_POST returns Yes/No unconverted. So intercept at the save and redirect because was
        // converted for the save to the DB

        // Grab the ccmp table data from the post
      //  $ccmpdata_post = $this->_ccmps_fetch_data_from_post(); // anchor2 - ccmps table

        $ccmpdata_post['email_address']   = post('email_address', true);

//print_r($ccmpdata_post); die();
        $update_id = $recid;  // came in the URL not POST
//echo(2792);
//print_r($update_id); die();
//echo('Line 1378');
//print_r($ccmpdata_post['subentity_admin']); die();

//print_r($ccmpdata_post['subentity']); die(); //subentity id passed when updating but not adding cause disabled - added below

//echo('Line 684');
//print_r($ccmpdata_post); die();
//print_r($ccmpdata_post['password']); die();
//echo('Line 579');


// passed framework available validations now checking for uniqueness
//print_r('passed validation'); die();

        //echo('Line 582');
      //  $userdata_post = $this->_user_fetch_data_from_post(); // still ccmps table
    //    $userdata_post['username']     = post('username', true);
    //    $userdata_post['locked']       = post('locked', true);
    //    $userdata_post['force_pw_chg'] = post('force_pw_chg', true);


       // print_r($userdata_post); die();

// check to see if the email address is already taken - somebody could attempt to change theirs to one that exists already

        $emadr = $ccmpdata_post['email_address']; // member id card not record number

        if(strlen($emadr) > 0){ // if the user submitted a username - otherwise it will match on blank records

            $emadr     = trim($emadr);
            // here we are trusting no duplicates to start with so if found should only be one
            // so it either belongs to user you want to create an account for or not
//  print_r($emadr); die();

/*
            // cant just do a scan to see if it shows up (already taken) because your record will show and
            // there could be a dup that comes after your record unless you trust that the system has ensured uniqueness
            // Only duplicate if uploaded duplicates because system wont let you save a duplicate
            $emadrsql  = "SELECT * FROM ccmps WHERE email_address = '$emadr' AND deceased != 1";
            $emadrs    = $this->model->query($emadrsql,'array');
//print_r($emadrs); die();
            $numemadrs = count($emadrs,COUNT_NORMAL); // need to see how many times it is in table
//print_r($numemadrs); die();


    switch ($numemadrs){

    case '1': // need to find out if the one is yours then thats ok to use as your username

    case '2':

    case '3':
    // it is definitely already exist and duplicated
// print_r($numemadrs); die();
    break;
    }
*/

    $usr_obj = $this->model->get_one_where('email_address', $emadr, 'ccmps');
    $ccmpname = $usr_obj->first_name.' '.$usr_obj->last_name;
   // echo(2680);
  //  print_r($ccmpname); die();
  //print_r($usr_obj); die();
    $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();

          if($recordfndid > 0){ // record found id exists so there is a ccmp with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed
            // if there is no update_id then you are adding so it is not ok to find a duplicate
            if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate

              // its the same record being edited so everything OK
              // nothing to do here just keep executing
           //   echo('Found but Everything OK'); die();

            }else{
            //  echo('Found but not OK'); die();
              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $result = 0;  // failed validation

              $flash_msg = 'The Email Address is already taken '; //. <= $recordfndid
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

            } // will keep executing

          } // the email address wasn't found so unique - keep executing
         // print_r('no duplicate found'); die();

        }else{
              $result = 0;  // failed validation

            //  $flash_msg = 'The Email Address is required.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;
  //print_r('1416 no username'); die();

        }
//echo('5127 all good - no duplicate email'); die();

// check to see if the username is already taken - somebody could attempt to change theirs to one that exists already
        $usrnm = $ccmpdata_post['username'];
//echo('5477');
//print_r($usrnm); die();
        if(strlen($usrnm) > 0){ // if the user submitted a username - otherwise it will match on blank records

          $usernm = trim($usrnm);

          $usr_obj = $this->model->get_one_where('username', $usernm, 'ccmps');
 // print_r($usr_obj); die();

          $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
          if($recordfndid > 0){ // record found id exists so there is a ccmp with that username
//echo('recordid > 0 so username found'); die();
//print_r($recordfndid); print_r($update_id); die();

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed
            // if there is no update_id then you are adding so it is not ok to find a duplicate
            if($recordfndid == $update_id){ // when adding there is no update_id so automatically not ok to duplicate

              // its the same record being edited so everything OK
              // nothing to do here just keep executing
     //         echo('Found but Everything OK'); die();

            }else{
//echo('Found but not OK'); die();
              // here a different user trying to change his username to someone elses
              // need to set flash msg fo rthe error and send back to the create form
              $result = 0;  // failed validation

              $flash_msg = 'The Username already exists.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

            } // will keep executing

          } // the username wasn't found so unique - keep executing
         // print_r('no duplicate username found'); die();

        }else{ // no username entered
//echo('2432 no username entered'); die();
            // when adding the username is set to the email address
          // by here we have validated that an email exist and properly formatted and not duplicated

//echo(2980);
//print_r($ccmpdata_post['email_address']); die();

             // make the username = email also see line 1658
         if(DEFAULT_USRNMEQEMAIL == 1){ //

            if(strlen($ccmpdata_post['email_address']) > 0){

                $ccmpdata_post['username'] = $ccmpdata_post['email_address'];

            }else{

              $result = 0;  // failed validation

              $flash_msg = $flash_msg.' A Username is required and no email address is available.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

            }
        }else{
              $result = 0;  // failed validation

              $flash_msg = ' A Username is required.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;

        }

      }

      /*  unset($userdata_post['approved']);
        unset($userdata_post['confirmed']);
        unset($userdata_post['timed_reset']);
        unset($userdata_post['reset_interval']);
        unset($userdata_post['inactive']); */
//echo(3017);
//print_r($userdata_post); die();
// echo('ccmps 5146 obselete $userdata_post'); die();
        // add the user account data
        $ccmpstbldata = array_merge($ccmpdata_post,$userdata_post); // combine for ccmps table

        $ccmpstbldata['updated_by'] = $_SESSION['tg_user_id'];
        $ccmpstbldata['updated_at'] = TIME();

//echo('2505: ');
//print_r($result); die();
  if($result > 0){ // if passed all validations above - save the updated record

         $usrlvl['user_level_id'] = DEFAULT_CCMP_USER_LEVEL;
         $usrlvl['code'] = $this->_generate_rand_code();
         // create a new trongate_user record, get the id and save as trongate_user_id

         $this->model->insert($usrlvl, 'trongate_users');

         // get the new record's id and assign to $data array for the new record
         $ccmpstbldata['trongate_user_id']  = $this->model->get_max('trongate_users');
         $ccmpstbldata['code'] = $this->_generate_rand_code();

         // make the username = email
         if(DEFAULT_USRNMEQEMAIL == 1){ // will overwrite anything typed in user field
          $ccmpstbldata['username'] = $ccmpstbldata['email_address'];
         }
          $ccmpstbldata['password'] = DEFAULT_CCMP_PASSWORD;

//print_r($ccmpstbldata); die();

        unset($ccmpstbldata['recid']); // not in any DB - will break update query

        unset($ccmpstbldata['email_address']); // dont want to overwrite
        unset($ccmpstbldata['locked']); // is commented out on create account page

//echo('4200 about to update ccmps: ');
//print_r($ccmpstbldata); die();
        $this->model->update($recid, $ccmpstbldata, 'ccmps');
        $recalc = $this->recalcstatus($recid);// nothing done with recalc, just trigger.

 //print_r("CCMPS Data Saved!"); die();
//echo(4205);
       // print_r($ccmpname); die();
//print_r($_SESSION['returnto']); die(); // not used

/* not used
        if($_SESSION['returnto'] == 'manage') { // can call create acct from manage or view page

            $flash_msg = 'A User Account was successfully created for '.$ccmpname.'.';
          //   print_r($flash_msg); die();
           //   $flash_msg = 'A User Account was successfully created.';
              set_flashdata($flash_msg);

              $flashmsgisset = 1;


            switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
              case 'momm': // managing your subentity records

            //  echo(2851); die();
                    redirect('welcome-ccmps/manage/momm');

              break;

              case 'mcmm': // managing current members
                    redirect('welcome-ccmps/manage/mcmm');

              break;

              case 'mngallccmps': // managing all members
                    redirect('welcome-ccmps/manage/mngallccmps');

              break;

              default;



              }
*/
    /*    }else{ */

            $flash_msg = 'A User Account was successfully created for '.$ccmpname.'.';
            set_flashdata($flash_msg);
            $flashmsgisset = 1;
   /*    } */
/*
  echo(4278);
  print_r($_SESSION['returnto']);
  print_r($recid);
   // die();
*/
        if(SKIP_NEW_ACCT_CONFIRMATION == 1) {
  //echo(4254); die();

            if($_SESSION['returnto'] == 'manage'){


        echo('5626 All good!');
        // print_r($_SESSION['ccmpmode']); die();

            switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
              case 'momm': // managing your subentity records


                    redirect('welcome-ccmps/manage/momm');

              break;

              case 'mosm': // managing your student subentity records


                    redirect('welcome-ccmps/manage/mosm');

              break;

              case 'mcmm': // managing current members - used for student members only
                    redirect('welcome-ccmps/manage/mcmm');

              break;

              case 'mngallccmps': // managing all members
                    redirect('welcome-ccmps/manage/mngallccmps');

              break;

              default;

              }
          }else{ // = 'view'
            // threfore will never skip the view record when add an account to a record
          // setting the tab so with open user account upon returning
              $flash_msg = 'A User Account was successfully created for '.$ccmpname.'.';
              set_flashdata($flash_msg);
              $flashmsgisset = 1;

              $_SESSION['ccmp_active_window'] = 4;
              redirect('welcome-ccmps/viewccmp/'.$recid.'/4');

          }

        }else{
          $_SESSION['ccmp_active_window'] = 4;
          redirect('welcome-ccmps/viewccmp/'.$recid);

        }



            // All data saved at this point
/*
            $data          = $this->_get_a_single_record($recid); // anchor1
            $data          = $this->_convert_to_user_friendly($data); // anchor3

        $data['recid'] = $recid;

            $data['view_module']   = 'welcome/ccmps';
            $data['view_file']     = 'ccmpcrud'; //
       // }

        $this->templates->inspinia($this->_with_fontsize_style($data));
*/

  }else{  // failed a validation

               $result = 0;  // failed validation

           //   $flash_msg = ' A Contact Email is required.';
           //   set_flashdata($flash_msg);

              $flashmsgisset = 1;
  redirect('welcome-ccmps/createccmpuseraccount/'.$recid);



  } // end passed or failed validation

// Successful save at this point
//echo('919 Successful Update');

//print_r($recid); die();

   //     $data   = $this->_get_a_single_record($recid); // anchor1 - returns array - values not codes

   //     $data['recid'] = $recid; // need to be paased to form for update button
//print_r($data); die();
   //     $view = "view"; // Bare login page login.php called instead of application dashboard dashboard.php
  //      $this->view($view, $data);
        //echo('930 went past view?'); die(); reset password came here. did I delete too much from view? saved in temp2.php




}  // if submit



} // end function

/*--------------------------- End ccmpuseracctsubmit -------------------------*/

/*------------------- Helpers for the roster / export queries -----------------*/

    function _member_select() { // aux fields (certificates, ratings, total time...) live in ccmps_aux
        if (CCMPS_AUX_MODULE == 1) {
            return "SELECT ccmps_aux.*, ccmps.* FROM ccmps LEFT JOIN ccmps_aux ON ccmps_aux.ccmp_id = ccmps.id"; // ccmps.* last so ccmps.id wins
        }
        return "SELECT * FROM ccmps";
    }

    function _first_aircraft($ccmp_id) { // aircraft moved from ccmps columns to ccmps_aircraft rows
        $rows = $this->model->query_bind("SELECT * FROM ccmps_aircraft WHERE ccmp_id = :id ORDER BY id LIMIT 1", array('id' => (int) $ccmp_id), 'object');
        return !empty($rows) ? $rows[0] : false;
    }

/*--------------------------- Function currentroster -------------------------*/

    function currentroster($posterid = null) {  // this is the subentity directory on the sidemenu - posterid comes from bulletin link
 // protected - get 500 error if not logged in
    // $ccmpsfunction = 'currentroster';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);

      $recid      = $_SESSION['ccmp_rec_id'];

      if($recid < 1){ // session expired - not logged in
        $this->login(); // ???
      }

      $userobj    = $this->model->get_one_where('id', $recid, 'ccmps');
      $subentity  = $userobj->subentity ?? '';
 //     print_r($subentity );die();
//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

      // get the particulars of the person logged in
      $ccmp_array   = $this->_get_a_single_record($recid); // anchor1 - returns array - values not codes
 //     print_r($ccmp_array); die();

      $subentity_role = $ccmp_array['subentity_role'];


      $thisdate = time();

//      $todaysdate = $this->timedate->get_nice_date($thisdate, $format); // 09/30/2022


//print_r($posterid); die();

      $currentyear  = $_SESSION['ccmps_current_year'];

    if($currentyear < 2023){
        $currentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'ccmps-currentroster-1225';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: ccmps';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['ccmpmode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    }
      $currentyear  = $currentyear - 1; // since using > in query
   //   print_r($subentity); die();
      // get the roster records from ccmp table for the subentity number
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        //  $data['ccmpsrecs']      = $this->model->get('last_name','ccmps'); // works manage
      if($posterid > 0){
      //  echo(1009); die();
        $sql = $this->_member_select()." WHERE ccmps.id = $posterid"; // temporary until national directory - just for demo - put result in popup???
       }else{
          $sql = $this->_member_select()." WHERE subentity = $subentity AND deceased != 1  AND soft_deleted != 1 AND current_year > $currentyear OR  subentity = $subentity AND deceased != 1  AND soft_deleted != 1 AND status = 2 ORDER BY last_name";
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity AND deceased < 1 AND current_year > $currentyear "; // for read only roster
       }
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
      $data['ccmpsrecs'] = $this->model->query($sql,'object');

 //print_r($data['ccmpsrecs']); die();
          foreach($data['ccmpsrecs'] as $row) { // step through the array of records and pull out needed values

              $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
              $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

              /*------------------ Change values to display descriptions instead of codes -----------------*/

              // Change codes to names

              $highcert                 = $row->highest_certificate;  // get the integer
              $highcertobj               = $this->model->get_where($highcert,'ccmps_certificate_types'); // use the integer to get the object
              $row->highest_certificate = $highcertobj->description ?? ''; // reset the value from integer to string from the object

              $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
              $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
              $levelname = $levelobj->level_title ?? '';  // capture the level name
              // now we need to insert the levelnames in the array for display
              $row->levelname = $levelname;

              $memtypeid        = $row->ccmp_type;
              $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
              $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

              $natoffcrid            = $row->national_officer;
              $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
              $row->national_officer = $natoffcrobj->description ?? '';

              $statusid    = $row->status;
              $statusobj   = $this->model->get_where($statusid,'ccmps_status');
              $row->status = $statusobj->title ?? '';

              $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

              $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

              $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

              $subentityrole    = $row->subentity_role;
              $subentityobj   = $this->model->get_where($subentityrole,'ccmps_subentity_roles');
              $row->subentity_role = $subentityobj->description ?? '';

              $subentityid    = $row->subentity;
              $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
              $row->subentity = $subentityobj->description ?? '';

              // $fintypeid          = $row->fin_acct_type;
              // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
              // $row->fin_acct_type = $fintypeobj->fin_type_title;

              // $finstatusid     = $row->fin_status;
              // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
              // $row->fin_status = $finstatusobj->fin_status_title;

              $this->module('timedate');
              $format = 'datepicker_us';
              $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

              if($row->updated_at == '01/01/1970'){
                $row->updated_at = ' ';
              }

              // Get the address data
              $recid = $row->id;
              $addrdataobj = $this->model->get_one_where('ccmp_id',$recid,'ccmps_addresses');

              $row->mailaddress1 = $addrdataobj->mailaddress1 ?? '';
              $row->mailaddress2 = $addrdataobj->mailaddress2 ?? '';
              $row->mailcity     = $addrdataobj->mailcity ?? '';
              $row->mailstate    = $addrdataobj->mailstate ?? '';
              $row->mailzip      = $addrdataobj->mailzip ?? '';

              $row->physaddress1 = $addrdataobj->physaddress1 ?? '';
              $row->physaddress2 = $addrdataobj->physaddress2 ?? '';
              $row->physcity     = $addrdataobj->physcity ?? '';
              $row->physstate    = $addrdataobj->physstate ?? '';
              $row->physzip      = $addrdataobj->physzip ?? '';
          }

              $data['subentity_name']  = $_SESSION['subentity_name'] ?? ''; // set at login
              $data['view_module']   = 'welcome/ccmps';
              $data['view_file']     = 'currentroster'; // read only roster

              $data['bc1'] = 'MSP';
              $data['bc2'] = CCMPSSUBENTITY.'Roster';

              $this->templates->inspinia($this->_with_fontsize_style($data));
    }

/*---------------------------- End currentroster -----------------------------*/


/*------------------------- Function currentdirectory ------------------------*/


    function currentdirectory($posterid = null) { // National Directory of Current Members

    // $ccmpsfunction = 'currentdirectory';
    // $authorized = $this->_check_function_permissions($ccmpsfunction); // can see a member if pass record id without this check

      $thisdate = time();

      //*----------------- Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

//print_r($posterid); die();

      $syscurrentyear  = $_SESSION['ccmps_current_year'];

    if($syscurrentyear < 2023){
        $syscurrentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'ccmps-currentdirectory-1355';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: ccmps';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['ccmpmode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    }

      $currentyear  = $syscurrentyear - 1; // since using > in query
      // get the roster records from ccmp table for the subentity number
        // query for all records - (syntax: 'order_by', 'table', limit, offset)
        //  $data['ccmpsrecs']      = $this->model->get('last_name','ccmps'); // works manage

      if($posterid > 0){
        $sql = $this->_member_select()." WHERE ccmps.id = $posterid"; // just for demo - put result in popup???
       }else{
          $sql = $this->_member_select()." WHERE deceased != 1 AND directoryoptout != 1  AND soft_deleted != 1 AND current_year > $currentyear OR deceased != 1 AND directoryoptout != 1  AND soft_deleted != 1 And status = 2";
 //         echo(787); die(); // for national directory
       }
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
      $data['ccmpsrecs']  = $this->model->query($sql,'object');
 // print_r($currentyear); die();
 // print_r($data['ccmpsrecs']); die();
          foreach($data['ccmpsrecs'] as $row) { // step through the array of records and pull out needed values

              $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
              $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

              /*------------------ Change values to display descriptions instead of codes -----------------*/

              // Change codes to names

              $highcert                 = $row->highest_certificate;  // get the integer
              $highcertobj               = $this->model->get_where($highcert,'ccmps_certificate_types'); // use the integer to get the object
              $row->highest_certificate = $highcertobj->description ?? ''; // reset the value from integer to string from the object

              $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
              $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
              $levelname = $levelobj->level_title ?? '';  // capture the level name
              // now we need to insert the levelnames in the array for display
              $row->levelname = $levelname;

              $memtypeid        = $row->ccmp_type;
              $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
              $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

              $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

              $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

              $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

              $subentityrole    = $row->subentity_role;
              $subentityobj   = $this->model->get_where($subentityrole,'ccmps_subentity_roles');
              $row->subentity_role = $subentityobj->description ?? '';

              $subentityid    = $row->subentity;
              $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
              $row->subentity = $subentityobj->description ?? '';

              // $fintypeid          = $row->fin_acct_type;
              // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
              // $row->fin_acct_type = $fintypeobj->fin_type_title;

              // $finstatusid     = $row->fin_status;
              // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
              // $row->fin_status = $finstatusobj->fin_status_title;

              $this->module('timedate');
              $format = 'datepicker_us';
              $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

              if($row->updated_at == '01/01/1970'){
                $row->updated_at = ' ';
              }

              // Get the address data
              $recid = $row->id;
              $addrdataobj = $this->model->get_one_where('ccmp_id',$recid,'ccmps_addresses');

              $row->mailaddress1 = $addrdataobj->mailaddress1 ?? '';
              $row->mailaddress2 = $addrdataobj->mailaddress2 ?? '';
              $row->mailcity     = $addrdataobj->mailcity ?? '';
              $row->mailstate    = $addrdataobj->mailstate ?? '';
              $row->mailzip      = $addrdataobj->mailzip ?? '';

              $row->physaddress1 = $addrdataobj->physaddress1 ?? '';
              $row->physaddress2 = $addrdataobj->physaddress2 ?? '';
              $row->physcity     = $addrdataobj->physcity ?? '';
              $row->physstate    = $addrdataobj->physstate ?? '';
              $row->physzip      = $addrdataobj->physzip ?? '';
          }

              $data['subentity_name']  = $_SESSION['subentity_name'] ?? ''; // set at login

              $data['view_module']   = 'welcome/ccmps';
              $data['view_file']     = 'directorylist'; // full member directory
//print_r($_SESSION['ccmpmode']); die();  // IS NULL because not adding, viewing or updating a record
             // switch($_SESSION['ccmpmode']) { //


                    $data['bc1'] = 'MSP';
                    $data['bc2'] = 'National Roster';

             // break;
             // }

              $this->templates->inspinia($this->_with_fontsize_style($data));

    }

// ******************  function SPREADSHEET_FORMAT_DOWNOAD ****************** //

  function spreadsheet_format_download() {
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="hello_world.xlsx"');

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1','Col Header 1');
      $sheet->setCellValue('B1','Col Header 2');
      $sheet->setCellValue('C1','Col Header 3');
      $sheet->setCellValue('D1','Col Header 4');

      $writer = new Xlsx($spreadsheet);
      $writer->save("php://output");
  }

// **************************  function CCMPUPLOAD ************************** //

  function ccmpupload(){

    // passed from sidemenu button sets the mode
    $_SESSION['ccmpmode'] = segment(3);

  //  echo(70);
  //  print_r($_SESSION['ccmpmode'] ); die();

if(isset($_FILES['file_upload'])){

  $dir='uploads/';
  $upload_file_name=$_FILES['file_upload']['name'];
  $upload_file_size=$_FILES['file_upload']['size'];
  $tmp_file_name   =$_FILES['file_upload']['tmp_name'];

  if($extension == 'csv'){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
  }else if($extension == 'xls'){
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
  }else{
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  }

  $spreadsheet = $reader->load($_FILES['file_upload']['tmp_name']);
  $sheetdata   = $spreadsheet->getActiveSheet()->toArray();

  move_uploaded_file($tmp_file_name,$dir.$upload_file_name);
/*
    // Test
  echo('<pre>');
  // print_r($sheetdata); die();
*/
}
/////////////////////////////////
 $sheetcount = count($sheetdata);

// print_r($sheetcount); die();

 if($sheetcount > 1) { // ignoring the header which will be record 1 so starting at 2 to see if any records

    $data = array();
    for ($i =1; $i < $sheetcount; $i++){

     // echo($ccmp_type  = $sheetdata[$i][1]); die();
      $id_number           = $sheetdata[$i][0];
      $ccmp_type         = $sheetdata[$i][1]; // if there is an id key in first column then start at 1.
      $salutation          = $sheetdata[$i][2];
      $first_name          = $sheetdata[$i][3];
      $middle_name         = $sheetdata[$i][4];
      $last_name           = $sheetdata[$i][5];
      $suffix              = $sheetdata[$i][6];
      $gender              = $sheetdata[$i][7];
      $subentity             = $sheetdata[$i][8];
      $mailaddress1        = $sheetdata[$i][9];
      $mailaddress2        = $sheetdata[$i][10];
      $mailcity            = $sheetdata[$i][11];
      $mailstate           = $sheetdata[$i][12];
      $mailzip             = $sheetdata[$i][13];
      $phone               = $sheetdata[$i][14];
      $mobile              = $sheetdata[$i][15];
      $email_address       = $sheetdata[$i][16];
      $fax                 = $sheetdata[$i][17];
      $birthday            = $sheetdata[$i][18];
      $highest_certificate = $sheetdata[$i][19];
      $certificate_number  = $sheetdata[$i][20];
      $total_time          = $sheetdata[$i][21];


      $row_data['id_number']           = $id_number;
      $row_data['ccmp_type']             = $ccmp_type;
      $row_data['salutation']          = $salutation;
      $row_data['first_name']          = $first_name;
      $row_data['middle_name']         = $middle_name;
      $row_data['last_name']           = $last_name;
      $row_data['suffix']              = $suffix;
      $row_data['gender']              = $gender;
      $row_data['subentity']             = $subentity;
      $row_data['mailaddress1']        = $mailaddress1;
      $row_data['mailaddress2']        = $mailaddress2;
      $row_data['mailcity']            = $mailcity;
      $row_data['mailstate']           = $mailstate;
      $row_data['mailzip']             = $mailzip;
      $row_data['phone']               = $phone;
      $row_data['mobile']              = $mobile;
      $row_data['email_address']       = $email_address;
      $row_data['fax']                 = $fax;
      $row_data['birthday']            = $birthday;
      $row_data['highest_certificate'] = $highest_certificate;
      $row_data['certificate_number']  = $certificate_number;
      $row_data['total_time']          = $total_time;

      $data[] = $row_data;

/*
      $data[] = array(
        'id_number'           =>$id_number,
        'ccmp_type'         =>$ccmp_type,
        'salutation'          =>$salutation,
        'first_name'          =>$first_name,
        'middle_name'         =>$middle_name,
        'last_name'           =>$last_name,
        'suffix'              =>$suffix,
        'gender'              =>$gender,
     //   'subentity'             =>$subentity,
        'mailaddress1'        =>$mailaddress1,
        'mailaddress2'        =>$mailaddress2,
        'mailcity'            =>$mailcity,
        'mailstate'           =>$mailstate,
        'mailzip'             =>$mailzip,
        'phone'               =>$phone,
        'mobile'              =>$mobile,
        'email_address'       =>$email_address,
        'fax'                 =>$fax,
        'birthday'            =>$birthday,
      //  'highest_certificate' =>$highest_certificate,
        'certificate_number'  =>$certificate_number,
       // 'total_time'          =>$total_time, */
      //);
    }

  //  print_r($data); die();
  $num_uploaded =  $this->model->insert_batch('ccmps_uploaded', $data);
//echo('Records uploaded!'); die();

  //    $this->model->insert($data, 'ccmps_uploaded');

  }

        echo('6237 All good!');
        // print_r($_SESSION['ccmpmode']); die();
switch($_SESSION['ccmpmode']){
//  switch($_SESSION['actionmode']){
  case 'momm': // Subentity Administration

        $recid      = $_SESSION['ccmp_rec_id'];

        if($recid < 1){ // session expired - not logged in
          $this->login();
        }

        // returns array - values not codes
        $ccmp_array   = $this->_get_a_single_record($recid); // anchor1
    //  print_r($ccmp_array); die();
        $subentityadmin  = $ccmp_array['subentity_admin'];
        $subentity_name  = $ccmp_array['subentity'];
        $subentity       = $ccmp_array['subentity'];


        $subentity_role = $ccmp_array['subentity_role'];

        $subentity_role_id = $ccmp_array['subentity_role'];

        $sql = "SELECT * FROM ccmps_uploaded WHERE subentity = $subentity"; //

        $datauploaded  = $this->model->query($sql,'object');

          break;

  case 'mngallccmps': // Member Administration

        $datauploaded = $this->model->get('id','ccmps_uploaded');

  break;

}

//print_r($datauploaded ); die();

// echo(85); die();

        foreach($datauploaded as $row) { // step through the array of records and pull out needed values

            $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate_users
            $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

            /*------------------ Change values to display descriptions instead of codes -----------------*/

            // Change codes to names

            $highcert                 = $row->highest_certificate;  // get the integer
            $subentityobj               = $this->model->get_where($highcert,'ccmps_certificate_types'); // use the integer to get the object
            $row->highest_certificate = $subentityobj->description ?? ''; // reset the value from integer to string from the object

            $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
            $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
            $levelname = $levelobj->level_title ?? '';  // capture the level name
            // now we need to insert the levelnames in the array for display
            $row->levelname = $levelname;

            $memtypeid        = $row->ccmp_type;
            $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
            $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

            $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

            $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

            $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

            $subentityrole    = $row->subentity_role;
            $subentityobj   = $this->model->get_where($subentityrole,'ccmps_subentity_roles');
            $row->subentity_role = $subentityobj->description ?? '';

            $subentityid    = $row->subentity;
            $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
            $row->subentity = $subentityobj->description ?? '';

            // $fintypeid          = $row->fin_acct_type;
            // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
            // $row->fin_acct_type = $fintypeobj->fin_type_title;

            // $finstatusid     = $row->fin_status;
            // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
            // $row->fin_status = $finstatusobj->fin_status_title;

            $this->module('timedate');
            $format = 'datepicker_us';
            $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

            if($row->updated_at == '01/01/1970'){
              $row->updated_at = ' ';
            }

            // Get the address data
            $recid = $row->id;
            $addrdataobj = $this->model->get_one_where('ccmp_id',$recid,'ccmps_addresses');

            $row->mailaddress1 = $addrdataobj->mailaddress1 ?? '';
            $row->mailaddress2 = $addrdataobj->mailaddress2 ?? '';
            $row->mailcity     = $addrdataobj->mailcity ?? '';
            $row->mailstate    = $addrdataobj->mailstate ?? '';
            $row->mailzip      = $addrdataobj->mailzip ?? '';

            $row->physaddress1 = $addrdataobj->physaddress1 ?? '';
            $row->physaddress2 = $addrdataobj->physaddress2 ?? '';
            $row->physcity     = $addrdataobj->physcity ?? '';
            $row->physstate    = $addrdataobj->physstate ?? '';
            $row->physzip      = $addrdataobj->physzip ?? '';
//print_r($addrdataobj); die();
        } // end foreach

        $data['datauploaded']   = $datauploaded;

        $data['logged_in']      = $_SESSION['logged_in'];
        $data['home_page']      = 0;
 //       print_r($data['logged_in']); die();

        //$data['site_name']   = "AYMP";  // perhaps put in config db or file
        $data['content_name']   = "Black Pilots of America";  // perhaps put in config db or file


        $data['subentity_name']   = $subentity_name; // not sure I do anything with this

      //  $data['mcma']          = $mcma; // treasurer/sysadmin managing current members or all members

        $data['view_module']    = 'welcome/ccmps';
        $data['view_file']      = 'uploadccmp'; //

//print_r($_SESSION['ccmpmode']); die();  // IS NULL because not adding, viewing or updating a record
             // switch($_SESSION['ccmpmode']) { //
//  switch($_SESSION['actionmode']){
             // managing your subentity records

                    $data['bc1'] = CCMP.' Admin';
                    $data['bc2'] = 'Upload <?= CCMPS ?>';

             // break;
             // }

              $this->templates->inspinia($this->_with_fontsize_style($data));
  }

// **************************  function UPLOAD_FORM ************************* //

  function upload_form(){

      error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

      if(isset($_FILES['file_upload'])){
        $dir='uploads/';
        $file_name=$_FILES['file_upload']['name'];
        $size=$_FILES['file_upload']['size'];
        $tmp_file_name=$_FILES['file_upload']['tmp_name'];
         echo $tmp_file_name.'<br>';
         echo $file_name.'<br>';
         echo $size;
        move_uploaded_file($tmp_file_name,$dir.$file_name);
        echo 'success<br>';
        include 'read_file.php';
      }else{
          echo 'File not selected';
      }

  }

/*----------------------------------------------------------------------------*/
/*------------------------------- Reports ------------------------------------*/
/*----------------------------------------------------------------------------*/

  // ****************************  function EXPORT ************************** //

    function export() { // Master Spreadsheet Format
    // $ccmpsfunction = 'export';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);

    // Every member's details: national admins only; a Chapter Admin gets their own chapter (2026-10-27)
    if (empty($_SESSION['trongatetoken'])) {
        $this->_deny_member_access();
    }
    if (!$this->_national_admin()) {
        if (empty($_SESSION['ccmps_subentity_admin']) || segment(3) != 'subentity') {
            $this->_deny_member_access();
        }
        $_SESSION['subentity'] = (int) ($_SESSION['ccmps_subentity'] ?? 0); // their own chapter, whatever was set before
    }

        //*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

    $scope    = segment(3);
    $subentity = $_SESSION['subentity'];
//print_r($scope); die();
//print_r($subentity); die();
if($scope == 'subentity'){
        // query for subentity records
    $sql = $this->_member_select()." WHERE subentity = $subentity";
    $data = $this->model->query($sql,'object');

//json($data); die();
}else{
    // query for all records - (syntax: 'order_by', 'table', limit, offset)
    $data = $this->model->query($this->_member_select()." ORDER BY subentity", 'object'); // with the aux fields

}

    // convert the object to an array to add additional data for the view
  //  $data = (array)$data;
 //json($data); die();
    foreach($data as $row) { // step through the array of records and pull out needed values

      $ccmprecid = $row->id;
//print_r($ccmprecid); die();
      $addrobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_addresses');
 // json($addrobj); die();
      $row->mailaddress1 = $addrobj->mailaddress1 ?? '';
      $row->mailaddress2 = $addrobj->mailaddress2 ?? '';
      $row->mailcity     = $addrobj->mailcity ?? '';
      $row->mailstate    = $addrobj->mailstate ?? '';
      $row->mailzip      = $addrobj->mailzip ?? '';
      $row->mailcountry  = $addrobj->mailcountry ?? '';
      $row->physaddress1 = $addrobj->physaddress1 ?? '';
      $row->physaddress2 = $addrobj->physaddress2 ?? '';
      $row->physcity     = $addrobj->physcity ?? '';
      $row->physstate    = $addrobj->physstate ?? '';
      $row->physzip      = $addrobj->physzip ?? '';
      $row->physcountry  = $addrobj->physcountry ?? '';
 //     print_r($ccmprecid); die();

      // dont need any financial data for Master Spreadsheet
      //$finobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_financial');
      //print_r($finobj); die();

  }

// dont add this before you do the loop above or it will fail when trying to loop through these non-ccmp entries


 //    json($data); die();


      foreach($data as $row) { // step through the array of records and pull out needed values

          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
          $levelname = $levelobj->level_title ?? '';  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $natofficeid        = $row->national_officer;
          $natofficeobj       = $this->model->get_where($natofficeid,'ref_national_offices');
          $row->national_officer = $natofficeobj->description ?? '';


          $memtypeid        = $row->ccmp_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
          $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

          $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

          $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

          $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

          $subentityid    = $row->subentity;
          $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
          $row->subentity = $subentityobj->description ?? '';

          $subentityroleid     = $row->subentity_role;
          $subentityroleobj    = $this->model->get_where($subentityroleid,'ccmps_subentity_roles');
          $row->subentity_role = $subentityroleobj->description ?? '';

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'ccmps_certificate_types');
          $row->highest_certificate = $highcertobj->description ?? '';

          // $fintypeid          = $row->fin_acct_type;
          // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
          // $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          // $finstatusid     = $row->fin_status;
          // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
          // $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/

          if(!empty($row->student_admin)) {
               $row->student_admin = 'TRUE';
          }else{
               $row->student_admin = 'FALSE';
          }

          if(!empty($row->cms_admin)) {
               $row->cms_admin = 'TRUE';
          }else{
               $row->cms_admin = 'FALSE';
          }

          if(!empty($row->subentity_admin)) {
               $row->subentity_admin = 'TRUE';
          }else{
               $row->subentity_admin = 'FALSE';
          }

          if(!empty($row->admin)) {
               $row->admin = 'TRUE';
          }else{
               $row->admin = 'FALSE';
          }


          if(!empty($row->system_admin)) {
               $row->system_admin = 'TRUE';
          }else{
               $row->system_admin = 'FALSE';
          }

          if(!empty($row->eligible_voter)) {
               $row->eligible_voter = 'TRUE';
          }else{
               $row->eligible_voter = 'FALSE';
          }

          if(!empty($row->emailoptout)) {
               $row->emailoptout = 'TRUE';
          }else{
               $row->emailoptout = 'FALSE';
          }

          if(!empty($row->directoryoptout)) {
               $row->directoryoptout = 'TRUE';
          }else{
               $row->directoryoptout = 'FALSE';
          }

          if(!empty($row->dontcall)) {
               $row->donotcall = 'TRUE';
          }else{
               $row->donotcall = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->deceased)) {
               $row->deceased = 'TRUE';
          }else{
               $row->deceased = 'FALSE';
          }

          if(!empty($row->no_address)) {
               $row->no_address = 'TRUE';
          }else{
               $row->no_address = 'FALSE';
          }

          if(!empty($row->special_event)) {
               $row->special_event = 'TRUE';
          }else{
               $row->special_event = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->aircraft_owner)) {
               $row->aircraft_owner = 'TRUE';
          }else{
               $row->aircraft_owner = 'FALSE';
          }


          if(!empty($row->hall_of_fame)) {
               $row->hall_of_fame = 'TRUE';
          }else{
               $row->hall_of_fame = 'FALSE';
          }

          if(!empty($row->alumnus)) {
               $row->alumnus = 'TRUE';
          }else{
               $row->alumnus = 'FALSE';
          }

          if(!empty($row->active_duty)) {
               $row->active_duty = 'TRUE';
          }else{
               $row->active_duty = 'FALSE';
          }

          if(!empty($row->former_military)) {
               $row->former_military = 'TRUE';
          }else{
               $row->former_military = 'FALSE';
          }

          if(!empty($row->military_pilot)) {
               $row->military_pilot = 'TRUE';
          }else{
               $row->military_pilot = 'FALSE';
          }

          if(!empty($row->vip)) {
               $row->vip = 'TRUE';
          }else{
               $row->vip = 'FALSE';
          }

          if(!empty($row->student)) {
               $row->student = 'TRUE';
          }else{
               $row->student = 'FALSE';
          }

          if(!empty($row->minor)) {
               $row->minor = 'TRUE';
          }else{
               $row->minor = 'FALSE';
          }

          if(!empty($row->private)) {
               $row->private = 'TRUE';
          }else{
               $row->private = 'FALSE';
          }


          if(!empty($row->commercial)) {
               $row->commercial = 'TRUE';
          }else{
               $row->commercial = 'FALSE';
          }

          if(!empty($row->atp)) {
               $row->atp = 'TRUE';
          }else{
               $row->atp = 'FALSE';
          }

          if(!empty($row->drone)) {
               $row->drone = 'TRUE';
          }else{
               $row->drone = 'FALSE';
          }

          if(!empty($row->ap)) {
               $row->ap = 'TRUE';
          }else{
               $row->ap = 'FALSE';
          }

          if(!empty($row->ia)) {
               $row->ia = 'TRUE';
          }else{
               $row->ia = 'FALSE';
          }

          if(!empty($row->military_maint)) {
               $row->military_maint = 'TRUE';
          }else{
               $row->military_maint = 'FALSE';
          }

          if(!empty($row->maintenance)) {
               $row->maintenance = 'TRUE';
          }else{
               $row->maintenance = 'FALSE';
          }

          if(!empty($row->atc)) {
               $row->atc = 'TRUE';
          }else{
               $row->atc = 'FALSE';
          }

          if(!empty($row->dispatcher)) {
               $row->dispatcher = 'TRUE';
          }else{
               $row->dispatcher = 'FALSE';
          }

          if(!empty($row->se_land)) {
               $row->se_land = 'TRUE';
          }else{
               $row->se_land = 'FALSE';
          }

          if(!empty($row->me_land)) {
               $row->me_land = 'TRUE';
          }else{
               $row->me_land = 'FALSE';
          }

          if(!empty($row->se_sea)) {
               $row->se_sea = 'TRUE';
          }else{
               $row->se_sea = 'FALSE';
          }

          if(!empty($row->me_sea)) {
               $row->me_sea = 'TRUE';
          }else{
               $row->me_sea = 'FALSE';
          }

          if(!empty($row->instrument)) {
               $row->instrument = 'TRUE';
          }else{
               $row->instrument = 'FALSE';
          }

          if(!empty($row->cfi)) {
               $row->cfi = 'TRUE';
          }else{
               $row->cfi = 'FALSE';
          }

          if(!empty($row->cfii)) {
               $row->cfii = 'TRUE';
          }else{
               $row->cfii = 'FALSE';
          }

          if(!empty($row->mei)) {
               $row->mei = 'TRUE';
          }else{
               $row->mei = 'FALSE';
          }

          if(!empty($row->dpe)) {
               $row->dpe = 'TRUE';
          }else{
               $row->dpe = 'FALSE';
          }

          if(!empty($row->bgi)) {
               $row->bgi = 'TRUE';
          }else{
               $row->bgi = 'FALSE';
          }

          if(!empty($row->agi)) {
               $row->agi = 'TRUE';
          }else{
               $row->agi = 'FALSE';
          }

          if(!empty($row->rotocraft)) {
               $row->rotocraft = 'TRUE';
          }else{
               $row->rotocraft = 'FALSE';
          }

          if(!empty($row->glider)) {
               $row->glider = 'TRUE';
          }else{
               $row->glider = 'FALSE';
          }

          if(!empty($row->balloon)) {
               $row->balloon = 'TRUE';
          }else{
               $row->balloon = 'FALSE';
          }

          if(!empty($row->airship)) {
               $row->airship = 'TRUE';
          }else{
               $row->airship = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }


} // end foreach

        // Add these elements to properly draw the screen

if($scope == 'subentity'){
    $data['bc1'] = CCMPSSUBENTITY.' Admin';
    $data['bc2'] = CCMPSSUBENTITY.' Spreadsheet';

    $data['h1']         = 'Export '.CCMPSSUBENTITY.' Spreadsheet';
    $data['h2']         = CCMPSSUBENTITY.' Administrator';
    $data['tablabel']   = 'All '.CCMPSSUBENTITY.' '.CCMP.' Records';
    $data['panellabel'] = CCMPSSUBENTITY.' '.CCMPS.' Master Sheet';
//json($data); die();
}else{
    $data['bc1'] = CCMP.' Admin';
    $data['bc2'] = 'Master Spreadsheet';

    $data['h1']         = 'Export Master Spreadsheet';
    $data['h2']         = 'Member Administrator';
    $data['tablabel']   = 'All '.CCMP.' Records';
    $data['panellabel'] = CCMP.' Master Sheet';

}

    //   $data['subentity_name']  = $_SESSION['subentity_name'] ?? ''; // set at login
      $data['view_module']   = 'welcome/ccmps';
      $data['view_file']     = 'export'; // read only roster

//     json($data); die();
      $this->templates->inspinia($this->_with_fontsize_style($data));

    }

// ***********************  function MASTERCURRENTROSTER ******************** //

    function mastercurrentroster($recid = null) { // Treasurer Master Spreadsheet Format
    // $ccmpsfunction = 'mastercurrentroster';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);
    if (empty($_SESSION['trongatetoken']) || !$this->_national_admin()) {
        $this->_deny_member_access(); // the national roster: national admins only (2026-10-27)
    }

//*------------------ Get logged in user's info & preferences ----------------*/
  // Get font size preference for views & manage page
  $this->_get_font_sizes();

      $recid    = segment(3);
    // query for all records - (syntax: 'order_by', 'table', limit, offset)


      $currentyear  = $_SESSION['ccmps_current_year'];
//echo(6418);
//print_r($currentyear ); die();

      if($currentyear < 2023){
        $currentyear = 2023;

        // Auditlog
        $type  = 'errorcatch';
        $action = 'SetCurrentYear';
        $func = 'ccmps-mastercurrentroster-6087';
        $un   = 'UN: '.$_SESSION['ccmp_username'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$delid;
        $str4 = 'Tbl: ccmps';
        $str5 = 'Title: '.$title;
        $str6 = $_SESSION['ccmpmode'];

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    }

      $currentyear  = $currentyear - 1;

      if( $recid > 0){
        $sql = $this->_member_select()." WHERE ccmps.id = $recid"; // what if deleted or archived off ???
      }else{

         $sql = $this->_member_select()." WHERE deceased != 1 AND current_year > $currentyear";
      }
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data = $this->model->query($sql,'object');
    // convert the object to an array to add additional data for the view
    $data = (array)$data;
 //     print_r($data); die();
    foreach($data as $row) { // step through the array of records and pull out needed values
      $ccmprecid = $row->id;
//print_r($ccmprecid); die();
      $addrobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_addresses');
//  print_r($addrobj); die();
      $row->mailaddress1 = $addrobj->mailaddress1 ?? '';
      $row->mailaddress2 = $addrobj->mailaddress2 ?? '';
      $row->mailcity     = $addrobj->mailcity ?? '';
      $row->mailstate    = $addrobj->mailstate ?? '';
      $row->mailzip      = $addrobj->mailzip ?? '';
      $row->mailcountry  = $addrobj->mailcountry ?? '';
      $row->physaddress1 = $addrobj->physaddress1 ?? '';
      $row->physaddress2 = $addrobj->physaddress2 ?? '';
      $row->physcity     = $addrobj->physcity ?? '';
      $row->physstate    = $addrobj->physstate ?? '';
      $row->physzip      = $addrobj->physzip ?? '';
      $row->physcountry  = $addrobj->physcountry ?? '';
 //     print_r($ccmprecid); die();

      // dont need any financial data for Master Spreadsheet
      //$finobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_financial');
      //print_r($finobj); die();

  }


 //     print_r($data); die();


      foreach($data as $row) { // step through the array of records and pull out needed values

          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
          $levelname = $levelobj->level_title ?? '';  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->ccmp_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
          $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description ?? '';

          $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

          $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

          $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

          $subentityid    = $row->subentity;
          $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
          $row->subentity = $subentityobj->description ?? '';

          $subentityroleid     = $row->subentity_role;
          $subentityroleobj    = $this->model->get_where($subentityroleid,'ccmps_subentity_roles');
          $row->subentity_role = $subentityroleobj->description ?? '';

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'ccmps_certificate_types');
          $row->highest_certificate = $highcertobj->description ?? '';

          // $fintypeid          = $row->fin_acct_type;
          // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
          // $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          // $finstatusid     = $row->fin_status;
          // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
          // $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/

          if(!empty($row->student_admin)) {
               $row->student_admin = 'TRUE';
          }else{
               $row->student_admin = 'FALSE';
          }

          if(!empty($row->cms_admin)) {
               $row->cms_admin = 'TRUE';
          }else{
               $row->cms_admin = 'FALSE';
          }

          if(!empty($row->subentity_admin)) {
               $row->subentity_admin = 'TRUE';
          }else{
               $row->subentity_admin = 'FALSE';
          }

          if(!empty($row->admin)) {
               $row->admin = 'TRUE';
          }else{
               $row->admin = 'FALSE';
          }

          if(!empty($row->system_admin)) {
               $row->system_admin = 'TRUE';
          }else{
               $row->system_admin = 'FALSE';
          }

          if(!empty($row->eligible_voter)) {
               $row->eligible_voter = 'TRUE';
          }else{
               $row->eligible_voter = 'FALSE';
          }

          if(!empty($row->emailoptout)) {
               $row->emailoptout = 'TRUE';
          }else{
               $row->emailoptout = 'FALSE';
          }

          if(!empty($row->directoryoptout)) {
               $row->directoryoptout = 'TRUE';
          }else{
               $row->directoryoptout = 'FALSE';
          }

          if(!empty($row->dontcall)) {
               $row->donotcall = 'TRUE';
          }else{
               $row->donotcall = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->deceased)) {
               $row->deceased = 'TRUE';
          }else{
               $row->deceased = 'FALSE';
          }

          if(!empty($row->no_address)) {
               $row->no_address = 'TRUE';
          }else{
               $row->no_address = 'FALSE';
          }

          if(!empty($row->special_event)) {
               $row->special_event = 'TRUE';
          }else{
               $row->special_event = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->aircraft_owner)) {
               $row->aircraft_owner = 'TRUE';
          }else{
               $row->aircraft_owner = 'FALSE';
          }


          if(!empty($row->hall_of_fame)) {
               $row->hall_of_fame = 'TRUE';
          }else{
               $row->hall_of_fame = 'FALSE';
          }


          if(!empty($row->alumnus)) {
               $row->alumnus = 'TRUE';
          }else{
               $row->alumnus = 'FALSE';
          }

          if(!empty($row->active_duty)) {
               $row->active_duty = 'TRUE';
          }else{
               $row->active_duty = 'FALSE';
          }

          if(!empty($row->former_military)) {
               $row->former_military = 'TRUE';
          }else{
               $row->former_military = 'FALSE';
          }

          if(!empty($row->military_pilot)) {
               $row->military_pilot = 'TRUE';
          }else{
               $row->military_pilot = 'FALSE';
          }

          if(!empty($row->vip)) {
               $row->vip = 'TRUE';
          }else{
               $row->vip = 'FALSE';
          }

          if(!empty($row->student)) {
               $row->student = 'TRUE';
          }else{
               $row->student = 'FALSE';
          }

          if(!empty($row->private)) {
               $row->private = 'TRUE';
          }else{
               $row->private = 'FALSE';
          }


          if(!empty($row->commercial)) {
               $row->commercial = 'TRUE';
          }else{
               $row->commercial = 'FALSE';
          }

          if(!empty($row->atp)) {
               $row->atp = 'TRUE';
          }else{
               $row->atp = 'FALSE';
          }

          if(!empty($row->drone)) {
               $row->drone = 'TRUE';
          }else{
               $row->drone = 'FALSE';
          }

          if(!empty($row->ap)) {
               $row->ap = 'TRUE';
          }else{
               $row->ap = 'FALSE';
          }

          if(!empty($row->ia)) {
               $row->ia = 'TRUE';
          }else{
               $row->ia = 'FALSE';
          }

          if(!empty($row->military_maint)) {
               $row->military_maint = 'TRUE';
          }else{
               $row->military_maint = 'FALSE';
          }

          if(!empty($row->maintenance)) {
               $row->maintenance = 'TRUE';
          }else{
               $row->maintenance = 'FALSE';
          }

          if(!empty($row->atc)) {
               $row->atc = 'TRUE';
          }else{
               $row->atc = 'FALSE';
          }

          if(!empty($row->dispatcher)) {
               $row->dispatcher = 'TRUE';
          }else{
               $row->dispatcher = 'FALSE';
          }

          if(!empty($row->se_land)) {
               $row->se_land = 'TRUE';
          }else{
               $row->se_land = 'FALSE';
          }

          if(!empty($row->me_land)) {
               $row->me_land = 'TRUE';
          }else{
               $row->me_land = 'FALSE';
          }

          if(!empty($row->se_sea)) {
               $row->se_sea = 'TRUE';
          }else{
               $row->se_sea = 'FALSE';
          }

          if(!empty($row->me_sea)) {
               $row->me_sea = 'TRUE';
          }else{
               $row->me_sea = 'FALSE';
          }

          if(!empty($row->instrument)) {
               $row->instrument = 'TRUE';
          }else{
               $row->instrument = 'FALSE';
          }

          if(!empty($row->cfi)) {
               $row->cfi = 'TRUE';
          }else{
               $row->cfi = 'FALSE';
          }

          if(!empty($row->cfii)) {
               $row->cfii = 'TRUE';
          }else{
               $row->cfii = 'FALSE';
          }

          if(!empty($row->mei)) {
               $row->mei = 'TRUE';
          }else{
               $row->mei = 'FALSE';
          }

          if(!empty($row->dpe)) {
               $row->dpe = 'TRUE';
          }else{
               $row->dpe = 'FALSE';
          }

          if(!empty($row->bgi)) {
               $row->bgi = 'TRUE';
          }else{
               $row->bgi = 'FALSE';
          }

          if(!empty($row->agi)) {
               $row->agi = 'TRUE';
          }else{
               $row->agi = 'FALSE';
          }

          if(!empty($row->rotocraft)) {
               $row->rotocraft = 'TRUE';
          }else{
               $row->rotocraft = 'FALSE';
          }

          if(!empty($row->glider)) {
               $row->glider = 'TRUE';
          }else{
               $row->glider = 'FALSE';
          }

          if(!empty($row->balloon)) {
               $row->balloon = 'TRUE';
          }else{
               $row->balloon = 'FALSE';
          }

          if(!empty($row->airship)) {
               $row->airship = 'TRUE';
          }else{
               $row->airship = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }


} // end for each $data

//echo(6985);
//json($data); die();

$previousyear = $currentyear; // because 1 has been subtracted from current year already to use the > sign in query becuase some pay for yesrs in advance

//print_r($previousyear); die();
      $sql2 = $this->_member_select()." WHERE deceased != 1 AND current_year = $previousyear"; // for read only roster
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data2 = $this->model->query($sql2,'object');
    // convert the object to an array to add additional data for the view
    $data2 = (array)$data2;
  //    print_r($data2); die();
    foreach($data2 as $row) { // step through the array of records and pull out needed values
      $ccmprecid = $row->id;
//print_r($ccmprecid); die();
      $addrobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_addresses');
//  print_r($addrobj); die();
      $row->mailaddress1 = $addrobj->mailaddress1 ?? '';
      $row->mailaddress2 = $addrobj->mailaddress2 ?? '';
      $row->mailcity     = $addrobj->mailcity ?? '';
      $row->mailstate    = $addrobj->mailstate ?? '';
      $row->mailzip      = $addrobj->mailzip ?? '';
      $row->mailcountry  = $addrobj->mailcountry ?? '';
      $row->physaddress1 = $addrobj->physaddress1 ?? '';
      $row->physaddress2 = $addrobj->physaddress2 ?? '';
      $row->physcity     = $addrobj->physcity ?? '';
      $row->physstate    = $addrobj->physstate ?? '';
      $row->physzip      = $addrobj->physzip ?? '';
      $row->physcountry  = $addrobj->physcountry ?? '';
 //     print_r($ccmprecid); die();

      // dont need any financial data for Master Spreadsheet
      //$finobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_financial');
      //print_r($finobj); die();

  }

/*
echo(6864);
print_r($currentyear );
// print_r($data2); die();
*/

      foreach($data2 as $row) { // step through the array of records and pull out needed values

          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
          $levelname = $levelobj->level_title ?? '';  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->ccmp_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
          $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description ?? '';

          $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

          $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

          $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

          $subentityid    = $row->subentity;
          $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
          $row->subentity = $subentityobj->description ?? '';

          $subentityroleid     = $row->subentity_role;
          $subentityroleobj    = $this->model->get_where($subentityroleid,'ccmps_subentity_roles');
          $row->subentity_role = $subentityroleobj->description ?? '';

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'ccmps_certificate_types');
          $row->highest_certificate = $highcertobj->description ?? '';

          // $fintypeid          = $row->fin_acct_type;
          // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
          // $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          // $finstatusid     = $row->fin_status;
          // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
          // $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/

          if(!empty($row->student_admin)) {
               $row->student_admin = 'TRUE';
          }else{
               $row->student_admin = 'FALSE';
          }

          if(!empty($row->cms_admin)) {
               $row->cms_admin = 'TRUE';
          }else{
               $row->cms_admin = 'FALSE';
          }

          if(!empty($row->subentity_admin)) {
               $row->subentity_admin = 'TRUE';
          }else{
               $row->subentity_admin = 'FALSE';
          }

          if(!empty($row->admin)) {
               $row->admin = 'TRUE';
          }else{
               $row->admin = 'FALSE';
          }

          if(!empty($row->system_admin)) {
               $row->system_admin = 'TRUE';
          }else{
               $row->system_admin = 'FALSE';
          }

          if(!empty($row->eligible_voter)) {
               $row->eligible_voter = 'TRUE';
          }else{
               $row->eligible_voter = 'FALSE';
          }

          if(!empty($row->emailoptout)) {
               $row->emailoptout = 'TRUE';
          }else{
               $row->emailoptout = 'FALSE';
          }

          if(!empty($row->directoryoptout)) {
               $row->directoryoptout = 'TRUE';
          }else{
               $row->directoryoptout = 'FALSE';
          }

          if(!empty($row->dontcall)) {
               $row->donotcall = 'TRUE';
          }else{
               $row->donotcall = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->deceased)) {
               $row->deceased = 'TRUE';
          }else{
               $row->deceased = 'FALSE';
          }

          if(!empty($row->no_address)) {
               $row->no_address = 'TRUE';
          }else{
               $row->no_address = 'FALSE';
          }

          if(!empty($row->special_event)) {
               $row->special_event = 'TRUE';
          }else{
               $row->special_event = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->aircraft_owner)) {
               $row->aircraft_owner = 'TRUE';
          }else{
               $row->aircraft_owner = 'FALSE';
          }


          if(!empty($row->hall_of_fame)) {
               $row->hall_of_fame = 'TRUE';
          }else{
               $row->hall_of_fame = 'FALSE';
          }

          if(!empty($row->alumnus)) {
               $row->alumnus = 'TRUE';
          }else{
               $row->alumnus = 'FALSE';
          }

          if(!empty($row->active_duty)) {
               $row->active_duty = 'TRUE';
          }else{
               $row->active_duty = 'FALSE';
          }

          if(!empty($row->former_military)) {
               $row->former_military = 'TRUE';
          }else{
               $row->former_military = 'FALSE';
          }

          if(!empty($row->military_pilot)) {
               $row->military_pilot = 'TRUE';
          }else{
               $row->military_pilot = 'FALSE';
          }

          if(!empty($row->vip)) {
               $row->vip = 'TRUE';
          }else{
               $row->vip = 'FALSE';
          }

          if(!empty($row->student)) {
               $row->student = 'TRUE';
          }else{
               $row->student = 'FALSE';
          }

          if(!empty($row->private)) {
               $row->private = 'TRUE';
          }else{
               $row->private = 'FALSE';
          }


          if(!empty($row->commercial)) {
               $row->commercial = 'TRUE';
          }else{
               $row->commercial = 'FALSE';
          }

          if(!empty($row->atp)) {
               $row->atp = 'TRUE';
          }else{
               $row->atp = 'FALSE';
          }

          if(!empty($row->drone)) {
               $row->drone = 'TRUE';
          }else{
               $row->drone = 'FALSE';
          }

          if(!empty($row->ap)) {
               $row->ap = 'TRUE';
          }else{
               $row->ap = 'FALSE';
          }

          if(!empty($row->ia)) {
               $row->ia = 'TRUE';
          }else{
               $row->ia = 'FALSE';
          }

          if(!empty($row->military_maint)) {
               $row->military_maint = 'TRUE';
          }else{
               $row->military_maint = 'FALSE';
          }

          if(!empty($row->maintenance)) {
               $row->maintenance = 'TRUE';
          }else{
               $row->maintenance = 'FALSE';
          }

          if(!empty($row->atc)) {
               $row->atc = 'TRUE';
          }else{
               $row->atc = 'FALSE';
          }

          if(!empty($row->dispatcher)) {
               $row->dispatcher = 'TRUE';
          }else{
               $row->dispatcher = 'FALSE';
          }

          if(!empty($row->se_land)) {
               $row->se_land = 'TRUE';
          }else{
               $row->se_land = 'FALSE';
          }

          if(!empty($row->me_land)) {
               $row->me_land = 'TRUE';
          }else{
               $row->me_land = 'FALSE';
          }

          if(!empty($row->se_sea)) {
               $row->se_sea = 'TRUE';
          }else{
               $row->se_sea = 'FALSE';
          }

          if(!empty($row->me_sea)) {
               $row->me_sea = 'TRUE';
          }else{
               $row->me_sea = 'FALSE';
          }

          if(!empty($row->instrument)) {
               $row->instrument = 'TRUE';
          }else{
               $row->instrument = 'FALSE';
          }

          if(!empty($row->cfi)) {
               $row->cfi = 'TRUE';
          }else{
               $row->cfi = 'FALSE';
          }

          if(!empty($row->cfii)) {
               $row->cfii = 'TRUE';
          }else{
               $row->cfii = 'FALSE';
          }

          if(!empty($row->mei)) {
               $row->mei = 'TRUE';
          }else{
               $row->mei = 'FALSE';
          }

          if(!empty($row->dpe)) {
               $row->dpe = 'TRUE';
          }else{
               $row->dpe = 'FALSE';
          }

          if(!empty($row->bgi)) {
               $row->bgi = 'TRUE';
          }else{
               $row->bgi = 'FALSE';
          }

          if(!empty($row->agi)) {
               $row->agi = 'TRUE';
          }else{
               $row->agi = 'FALSE';
          }

          if(!empty($row->rotocraft)) {
               $row->rotocraft = 'TRUE';
          }else{
               $row->rotocraft = 'FALSE';
          }

          if(!empty($row->glider)) {
               $row->glider = 'TRUE';
          }else{
               $row->glider = 'FALSE';
          }

          if(!empty($row->balloon)) {
               $row->balloon = 'TRUE';
          }else{
               $row->balloon = 'FALSE';
          }

          if(!empty($row->airship)) {
               $row->airship = 'TRUE';
          }else{
               $row->airship = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }


} // for each $data2

//echo(7372);
//json($data2); die();

$twoyearsago = $currentyear - 1; // because 1 has already been subtracted from current year already to use the > sign in query because some pay for yesrs in advance
//echo(7210);
//print_r($previousyear); die();
      $sql3 = $this->_member_select()." WHERE deceased != 1 AND current_year = $twoyearsago"; // for read only roster
       //   $sql = "SELECT * FROM ccmps WHERE subentity = $subentity ORDER BY last_name DESC"; // doesnt work for read only roster. if hidden = NULL recs wont be included!
          $data3 = $this->model->query($sql3,'object');
    // convert the object to an array to add additional data for the view
    $data3 = (array)$data3;
  //    print_r($data2); die();
    foreach($data3 as $row) { // step through the array of records and pull out needed values
      $ccmprecid = $row->id;
//print_r($ccmprecid); die();
      $addrobj   = $this->model->get_one_where('ccmp_id',$ccmprecid,'ccmps_addresses');
//  print_r($addrobj); die();
      $row->mailaddress1 = $addrobj->mailaddress1 ?? '';
      $row->mailaddress2 = $addrobj->mailaddress2 ?? '';
      $row->mailcity     = $addrobj->mailcity ?? '';
      $row->mailstate    = $addrobj->mailstate ?? '';
      $row->mailzip      = $addrobj->mailzip ?? '';
      $row->mailcountry  = $addrobj->mailcountry ?? '';
      $row->physaddress1 = $addrobj->physaddress1 ?? '';
      $row->physaddress2 = $addrobj->physaddress2 ?? '';
      $row->physcity     = $addrobj->physcity ?? '';
      $row->physstate    = $addrobj->physstate ?? '';
      $row->physzip      = $addrobj->physzip ?? '';
      $row->physcountry  = $addrobj->physcountry ?? '';

  }



  //    print_r($data); die();


      foreach($data3 as $row) { // step through the array of records and pull out needed values

          $tgusrid   = $row->trongate_user_id; // now we have the trongate_user_id from trongate users
          $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); // from trongate_users

          /*------------------ Change values to display descriptions instead of codes -----------------*/

          // Change codes to names

          $levelid   = $tgusrobj->user_level_id ?? null; // capture the level id to query for the level name
          $levelobj  = $this->model->get_where($levelid,'trongate_user_levels'); // from trongate_user_levels
          $levelname = $levelobj->level_title ?? '';  // capture the level name
          // now we need to insert the levelnames in the array for display
          $row->levelname = $levelname;

          $memtypeid        = $row->ccmp_type;
          $memtypeobj       = $this->model->get_where($memtypeid,'ccmps_types');
          $row->ccmp_type = $memtypeobj->ccmp_type ?? '';

          $natoffcrid            = $row->national_officer;
          $natoffcrobj           = $this->model->get_where( $natoffcrid,'ref_national_offices');
          $row->national_officer = $natoffcrobj->description ?? '';

          $acobj = $this->_first_aircraft($row->id); // first aircraft from ccmps_aircraft

          $row->aircraft_type = $acobj ? trim($acobj->make.' '.$acobj->model) : '';

          $row->aircraft_reg  = $acobj ? $acobj->registration_number : '';

          $subentityid    = $row->subentity;
          $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
          $row->subentity = $subentityobj->description ?? '';

          $subentityroleid     = $row->subentity_role;
          $subentityroleobj    = $this->model->get_where($subentityroleid,'ccmps_subentity_roles');
          $row->subentity_role = $subentityroleobj->description ?? '';

          $highcertid               = $row->highest_certificate;
          $highcertobj              = $this->model->get_where($highcertid,'ccmps_certificate_types');
          $row->highest_certificate = $highcertobj->description ?? '';

          // $fintypeid          = $row->fin_acct_type;
          // $fintypeobj         = $this->model->get_where($fintypeid ,'ccmps_financial_types');
          // $row->fin_acct_type = $fintypeobj->fin_type_title;
//print_r($row->fin_acct_type); die();
          // $finstatusid     = $row->fin_status;
          // $finstatusobj    = $this->model->get_where($finstatusid,'ccmps_financial_statuses');
          // $row->fin_status = $finstatusobj->fin_status_title;

          $this->module('timedate');
          $format = 'datepicker_us';
          $row->updated_at  = $this->timedate->get_nice_date($row->updated_at, $format);

          if($row->updated_at == '01/01/1970'){
            $row->updated_at = ' ';
          }

/*------ Convert the Binary Yes/No fields ----------*/


          if(!empty($row->student_admin)) {
               $row->student_admin = 'TRUE';
          }else{
               $row->student_admin = 'FALSE';
          }

          if(!empty($row->cms_admin)) {
               $row->cms_admin = 'TRUE';
          }else{
               $row->cms_admin = 'FALSE';
          }

          if(!empty($row->subentity_admin)) {
               $row->subentity_admin = 'TRUE';
          }else{
               $row->subentity_admin = 'FALSE';
          }

          if(!empty($row->admin)) {
               $row->admin = 'TRUE';
          }else{
               $row->admin = 'FALSE';
          }

          if(!empty($row->system_admin)) {
               $row->system_admin = 'TRUE';
          }else{
               $row->system_admin = 'FALSE';
          }

          if(!empty($row->eligible_voter)) {
               $row->eligible_voter = 'TRUE';
          }else{
               $row->eligible_voter = 'FALSE';
          }

          if(!empty($row->emailoptout)) {
               $row->emailoptout = 'TRUE';
          }else{
               $row->emailoptout = 'FALSE';
          }

          if(!empty($row->directoryoptout)) {
               $row->directoryoptout = 'TRUE';
          }else{
               $row->directoryoptout = 'FALSE';
          }

          if(!empty($row->donotcall)) {
               $row->donotcall = 'TRUE';
          }else{
               $row->donotcall = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->deceased)) {
               $row->deceased = 'TRUE';
          }else{
               $row->deceased = 'FALSE';
          }

          if(!empty($row->no_address)) {
               $row->no_address = 'TRUE';
          }else{
               $row->no_address = 'FALSE';
          }

          if(!empty($row->special_event)) {
               $row->special_event = 'TRUE';
          }else{
               $row->special_event = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }

          if(!empty($row->aircraft_owner)) {
               $row->aircraft_owner = 'TRUE';
          }else{
               $row->aircraft_owner = 'FALSE';
          }


          if(!empty($row->hall_of_fame)) {
               $row->hall_of_fame = 'TRUE';
          }else{
               $row->hall_of_fame = 'FALSE';
          }

          if(!empty($row->alumnus)) {
               $row->alumnus = 'TRUE';
          }else{
               $row->alumnus = 'FALSE';
          }

          if(!empty($row->active_duty)) {
               $row->active_duty = 'TRUE';
          }else{
               $row->active_duty = 'FALSE';
          }

          if(!empty($row->former_military)) {
               $row->former_military = 'TRUE';
          }else{
               $row->former_military = 'FALSE';
          }

          if(!empty($row->military_pilot)) {
               $row->military_pilot = 'TRUE';
          }else{
               $row->military_pilot = 'FALSE';
          }

          if(!empty($row->vip)) {
               $row->vip = 'TRUE';
          }else{
               $row->vip = 'FALSE';
          }

          if(!empty($row->student)) {
               $row->student = 'TRUE';
          }else{
               $row->student = 'FALSE';
          }

          if(!empty($row->private)) {
               $row->private = 'TRUE';
          }else{
               $row->private = 'FALSE';
          }


          if(!empty($row->commercial)) {
               $row->commercial = 'TRUE';
          }else{
               $row->commercial = 'FALSE';
          }

          if(!empty($row->atp)) {
               $row->atp = 'TRUE';
          }else{
               $row->atp = 'FALSE';
          }

          if(!empty($row->drone)) {
               $row->drone = 'TRUE';
          }else{
               $row->drone = 'FALSE';
          }

          if(!empty($row->ap)) {
               $row->ap = 'TRUE';
          }else{
               $row->ap = 'FALSE';
          }

          if(!empty($row->ia)) {
               $row->ia = 'TRUE';
          }else{
               $row->ia = 'FALSE';
          }

          if(!empty($row->military_maint)) {
               $row->military_maint = 'TRUE';
          }else{
               $row->military_maint = 'FALSE';
          }

          if(!empty($row->maintenance)) {
               $row->maintenance = 'TRUE';
          }else{
               $row->maintenance = 'FALSE';
          }

          if(!empty($row->atc)) {
               $row->atc = 'TRUE';
          }else{
               $row->atc = 'FALSE';
          }

          if(!empty($row->dispatcher)) {
               $row->dispatcher = 'TRUE';
          }else{
               $row->dispatcher = 'FALSE';
          }

          if(!empty($row->se_land)) {
               $row->se_land = 'TRUE';
          }else{
               $row->se_land = 'FALSE';
          }

          if(!empty($row->me_land)) {
               $row->me_land = 'TRUE';
          }else{
               $row->me_land = 'FALSE';
          }

          if(!empty($row->se_sea)) {
               $row->se_sea = 'TRUE';
          }else{
               $row->se_sea = 'FALSE';
          }

          if(!empty($row->me_sea)) {
               $row->me_sea = 'TRUE';
          }else{
               $row->me_sea = 'FALSE';
          }

          if(!empty($row->instrument)) {
               $row->instrument = 'TRUE';
          }else{
               $row->instrument = 'FALSE';
          }

          if(!empty($row->cfi)) {
               $row->cfi = 'TRUE';
          }else{
               $row->cfi = 'FALSE';
          }

          if(!empty($row->cfii)) {
               $row->cfii = 'TRUE';
          }else{
               $row->cfii = 'FALSE';
          }

          if(!empty($row->mei)) {
               $row->mei = 'TRUE';
          }else{
               $row->mei = 'FALSE';
          }

          if(!empty($row->dpe)) {
               $row->dpe = 'TRUE';
          }else{
               $row->dpe = 'FALSE';
          }

          if(!empty($row->bgi)) {
               $row->bgi = 'TRUE';
          }else{
               $row->bgi = 'FALSE';
          }

          if(!empty($row->agi)) {
               $row->agi = 'TRUE';
          }else{
               $row->agi = 'FALSE';
          }

          if(!empty($row->rotocraft)) {
               $row->rotocraft = 'TRUE';
          }else{
               $row->rotocraft = 'FALSE';
          }

          if(!empty($row->glider)) {
               $row->glider = 'TRUE';
          }else{
               $row->glider = 'FALSE';
          }

          if(!empty($row->balloon)) {
               $row->balloon = 'TRUE';
          }else{
               $row->balloon = 'FALSE';
          }

          if(!empty($row->airship)) {
               $row->airship = 'TRUE';
          }else{
               $row->airship = 'FALSE';
          }

          if(!empty($row->mail_notices)) {
               $row->mail_notices = 'TRUE';
          }else{
               $row->mail_notices = 'FALSE';
          }


} // for each $data3
        // Add these elements to properly draw the screen

              $data['data2']         = $data2;
              $data['data3']         = $data3;
              $data['view_module']   = 'welcome/ccmps';
              $data['view_file']     = 'mastercurrentroster'; // read only roster


              $data['bc1'] = CCMP.' Admin';
              $data['bc2'] = 'National Roster';
//echo(6864);

//json($data2); die();
              $this->templates->inspinia($this->_with_fontsize_style($data));

    }

/*------------------------------------------------------------------------------------------------*/
/*-------------------------------- Common Utility Functions --------------------------------------*/
/*------------------------------------------------------------------------------------------------*/

// **********************  function _GENERATE_RAND_CODE ********************* //

    // generate a random 16 character code for unique ids
    function _generate_rand_code() {
  // protected - private function

      $token_length = 16;
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

// *************************  function MODALADDEMAIL ************************ //

  function modaladdemail() {  // called from non-honcho module that uses the add email modal form
    // url protected - white page

    // since called by a javascript routine print_r and echo render in the calling form which disappers - die() stops execution

    // If this segment exists then must be coming from Welcome as it is passed in URL through a button.
    //  $dbtupd = segment(5);
     $dbtupd = post('dbtupd');
      //print_r($dbtupd); die();


      // Get the input values & system acct recid hidden in the modal form and passed to javascript then posted here
      $nem   = post('nemail'); // why not new_email? what is the point of that line in the JS nemail:new_email?

      // get system account record number for the user, not the sys/assist/admin $_SESSION['honcho_acct_rec_id']; who is logged in as in the change password function below
      $sarid = post('recid');

// the echo output shows up on the modal form until it times out. Can only show two echo lines on form.
   //   echo(6561);
   //   echo('-');
   //   echo('sarid - ');
   //   print_r($sarid); die();
        if(strlen($nem) > 0){ // if the user submitted a username - otherwise it will match on blank records

          $nem = trim($nem);
//print_r($mbrno); die();
          $usr_obj = $this->model->get_one_where('email_address', $nem, 'ccmps');
//print_r($usr_obj); die();

          $recordfndid = $usr_obj->id;
//print_r($recordfndid); die();
          if($recordfndid > 0){ // record found id exists so there is a ccmp with that username

            // check if record found id is same as the record being edited which is ok
            // because changing your username is allowed

            // if there is no update_id then you are adding so it is not ok to find a duplicate
                  if($recordfndid == $sarid){ // when adding there is no update_id so automatically not ok to duplicate
      //echo('Email address found but Everything OK'); die();


                  }else{
      //echo('Email Address found but NOT OK'); die();

                    // here a different user trying to change his username to someone elses
                    // need to set flash msg fo rthe error and send back to the create form
                    $result = 0;  // failed validation

                    $flash_msg = 'The Email Address is already taken.';
                    set_flashdata($flash_msg);
                    $flashmsgisset = 1;

            //print_r($_SESSION['ccmpmode']); die();
                    switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
                      case 'momm': // managing your subentity records
                            redirect('welcome-ccmps/manage/momm');

                      break;

                      case 'momm': // managing your subentity records
                            redirect('welcome-ccmps/manage/momm');

                      break;

                      case 'mosm': // managing current subentity student members
                            redirect('welcome-ccmps/manage/mosm');

                      break;

                      case 'mngallccmps': // managing all members

                          print_r('Email address already taken...please try again');
//echo'<input type="button" value="Reload Page" onClick="document.location.reload(true)">';

                      break;
                      default;
                      }


                    }

              }else{ // no duplicate found
//print_r('no duplicate found');
                    $nemdata['email_address'] = $nem;
                    $nemdata['username']      = $nem;

                    if($dbtupd == "ccmps"){
                          $this->model->update($sarid, $nemdata, 'ccmps');
                        //  echo "Success! Email Address & Username were both updated";
                          $flash_msg = 'Success! Email Address & Username were both updated';
                          set_flashdata($flash_msg);
                          $flashmsgisset = 1;

                          // redirect('welcome-ccmps/viewccmp/'.$sarid.);


                    }else{
                          if($dbtupd == "honcho_user_accounts"){
                            $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
                            echo "Your email address was successfully updated.";
                          }else{
                            echo "No DB was specified - welcome-ccmps/modaladdemail line 6577";

                          }
                    }

              }
          }

    }

// **************************  function MODALRESETPW ************************ //

  function modalresetpw() {  // called from non-honcho module that uses the reset password modal form
        // url protected - white page
    // since called by a javascript routine print_r and echo render in the calling form which disappers - die() stops execution

    // If this segment exists then must be coming from Welcome as it is passed in URL through a button.
    //  $dbtupd = segment(5);
     $dbtupd = post('dbtupd');
  //    print_r($dbtupd); die();


      // Get the input values & system acct recid hidden in the modal form and passed to javascript then posted here
      $npw   = post('npass');

      // get system account record number for the user, not the sys/assist/admin $_SESSION['honcho_acct_rec_id']; who is logged in as in the change password function below
      $sarid = post('recid');
//print_r($sarid); die();

      //  Hash the new password
        $newhpw = $this->_hash_string($npw);
  //echo ($newhpw); die();

        // Save the new password on acct reset by admin - modalchangepw below uses logged in user
  //print_r($sarid); die();
        $npwdata['password']     = $newhpw;
        $npwdata['force_pw_chg'] = 1;

        if($dbtupd == "ccmps"){
          $this->model->update($sarid, $npwdata, 'ccmps');
          echo "The Password Was Successfully Reset";
        }else{
          if($dbtupd == "honcho_user_accounts"){
            $this->model->update($sarid, $npwdata, 'honcho_user_accounts');
            echo "The Password Was Successfully Reset";
          }else{
                $flash_msg = 'No database was specified.';
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
         //   echo "No database was specified -  welcome-ccmps/modelresetpw() line 7837";

          }
        }



    //  redirect('');

    }

// *************************  function SAVEFONTSIZES ************************ //
// The Font pop-up in the member top bar (views/navbar.php, 2026-10-27): POST of the
// five size choices (tab/header/label/value/button_setting) for your OWN record only.
// Each must be a small/medium/large row of ccmps_settings of the right type. JSON reply;
// the page reloads so _with_fontsize_style() applies the new sizes.
function savefontsizes() {

    header('Content-Type: application/json');
    if (empty($_SESSION['ccmp_logged_in']) || empty($_SESSION['ccmp_rec_id'])) {
        echo json_encode(array('ok' => false, 'msg' => 'Please log in again.'));
        die();
    }
    if (REQUEST_TYPE != 'POST' || empty($_SESSION['fontsize_token']) || !hash_equals($_SESSION['fontsize_token'], (string) post('token'))) {
        echo json_encode(array('ok' => false, 'msg' => 'The page had expired - please reload it and try again.'));
        die();
    }

    $ccmp_id = (int) $_SESSION['ccmp_rec_id'];
    $upd = array();
    foreach (member_font_sizes($ccmp_id) as $type => $choice) {
        $picked = (int) post($choice['column']);
        if (!isset($choice['options'][$picked])) {
            echo json_encode(array('ok' => false, 'msg' => 'Please choose a size for '.$choice['label'].'.'));
            die();
        }
        $upd[$choice['column']] = $picked;
    }
    $this->model->update($ccmp_id, $upd, 'ccmps');

    $this->module('timedate');
    $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
    $this->module('system-auditlogger');
    $this->auditlogger->logevent('update', 'FontSizes', 'welcome-ccmps-savefontsizes', 'UN: '.($_SESSION['ccmp_username'] ?? ''), $time, 'Rec: '.$ccmp_id, 'Tbl: ccmps', json_encode($upd));

    echo json_encode(array('ok' => true));
    die();
}

// *************************  function MODALCHANGEPW ************************ //

function modalchangepw() { //for changing your own system acct password. ccmps not passed because separate code in Welcome to change own ccmps password


    // Get the input values
    $rpwl   = post('rpwl'); // required password length hidden in form field - currently blank
    $pw     = post('crpass');
    $npw    = post('npass');
    $cpw    = post('cpass');
    $dbtupd = post('dbtupd'); // works
    $sarid  = post('recid');  //
//print_r($sarid); die();

    // The new password and the repeat new password were already confirmed in the modals javascript
    // the new passwords format was also validated in the javascript

//If(strlen($npw) > 4 ){ // new password must be 5 or more character
 // not needed because validated in the javascript. Uncomment if you'd rather validate here but modal will
 // disappear because no javascript validation would have failed. Will have to select Change Password option again.

/*
    // get account record number of the currently logged in user
    $sarid = $_SESSION['honcho_acct_rec_id'];

    //echo ($pw); die(); */

    // find the honcho_user_accounts record - if were using this for front end would be a case statement for ccmps vs. honcho_user_accounts

    $ccmpacctobj = $this->model->get_one_where('id', $sarid, 'ccmps');

    // get the saved hashed password
    $realpw = $ccmpacctobj->password;

  // Verify that the current password entered when hashed matches the saved hashed password (trongate function)
    $pw_result =  password_verify($pw, $realpw);
//echo "pw_result: ";
//echo($pw_result); die();
   // If the current password is verified
    if($pw_result > 0){
//echo('passed!'); die();
    //  Hash the new password
      $newhpw = $this->_hash_string($npw);
//echo ($newhpw); die();

      // Save the new password on the currently logged in account & reset force pw chg flag back to No since the just did it
      $npwdata['password']     = $newhpw;
      $npwdata['force_pw_chg'] = 0;

      $this->model->update($sarid, $npwdata, 'ccmps');
      echo "Your Password Was Successfully Changed";

   }else{ //current password was not verified

    if($_SESSION['ccmp_logged_in'] == 1){
        echo('Current Password is incorrect, try again.');
    }else{
        $flash_msg = 'No database was specified.';
        set_flashdata($flash_msg);

        redirect('welcome/login');
    }




   }

  }

// *************************  function _HASH_STRING ************************* //

    function _hash_string($str){

    //       echo('in hasher'); die();

           $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
               'cost' => 11 ));

           return $hashed_string;
       }

// ***********************  function _VERIFY_HASH *************************** //

    function _verify_hash($plain_text_str, $hashed_string){

           $result =  password_verify($plain_text_str, $hashed_string);

           return $result; // true or false
       }

// ***************************  function LOCKACCT *************************** //

    function lockacct() {
     // 404 if not logged in. White page if you are but will lock if pass a recid
    // $ccmpsfunction = 'lockacct';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);

      $recid = segment(3);
      $frmpg = segment(4); // can lock and unlock from manage or view

      if (empty($_SESSION['trongatetoken']) || !$this->_member_access($recid, 'admin')) {
          $this->_deny_member_access(); // an admin for this member only (2026-10-27)
      }

   //   echo(5916);
   //   print_r($frmpg); die();
      $data['locked'] = 1;

      $this->model->update($recid, $data, 'ccmps');

      if($frmpg == 'v'){

        echo('8331 All good!');
        // print_r($_SESSION['ccmpmode']); die();
        switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
          case 'momm': // managing your subentity records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mosm': // managing your subentity student records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mcmm': // managing current members - used for student members only
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mngallccmps': // managing all members
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'momv': // managing your subentity records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mosv': // managing your subentity student records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mcmv': // managing current members - used for student members only
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mamv': // managing all members
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;
        }
      }else{ // m

        switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
          case 'momm': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

          case 'mosm': // managing your subentity student records
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmm': // managing current members - used for student members only
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mngallccmps': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;

          case 'momv': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

          case 'mosv': // managing your subentity records
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmv': // managing current members - used for student members only
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mamv': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;
        }
      }
    }

 // **************************  function UNLOCKACCT ************************* //

    function unlockacct() {
     // 404 if not logged in. White page if you are but will lock if pass a recid
    // $ccmpsfunction = 'unlockacct';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);

        $recid = segment(3);
        $frmpg = segment(4); // can lock and unlock from manage or view

        if (empty($_SESSION['trongatetoken']) || !$this->_member_access($recid, 'admin')) {
            $this->_deny_member_access(); // an admin for this member only (2026-10-27)
        }

//echo(5963);
      //  print_r($frmpg); die();

        $data['locked'] = 0;

        $this->model->update($recid, $data, 'ccmps');

      if($frmpg == 'v'){

        echo('8441 All good!');
        // print_r($_SESSION['ccmpmode']); die();
        switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
          case 'momm': // managing your subentity records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mosm': // managing your subentity student records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mcmm': // managing current members - used for student members only
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mngallccmps': // managing all members
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'momv': // managing your subentity records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mosv': // managing your subentity student records
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mcmv': // managing current members - used for student members only
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;

          case 'mamv': // managing all members
                redirect('welcome-ccmps/viewccmp/'.$recid.'/4/vbe');

          break;
        }
      }else{ // m

        switch($_SESSION['ccmpmode']) {
//  switch($_SESSION['actionmode']){
          case 'momm': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

          case 'mosm': // managing your subentity student records
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmm': // managing current members - used for student members only
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mngallccmps': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;

          case 'momv': // managing your subentity records
                redirect('welcome-ccmps/manage/momm');

          break;

          case 'mosv': // managing your subentity student records
                redirect('welcome-ccmps/manage/mosm');

          break;

          case 'mcmv': // managing current members - used for student members only
                redirect('welcome-ccmps/manage/mcmm');

          break;

          case 'mamv': // managing all members
                redirect('welcome-ccmps/manage/mngallccmps');

          break;

        }
      }
    }

// **************************  function DELRECORD *************************** //

    function delrecord() { // soft delete: sets soft_deleted = 1 on a single ccmps record — system_admin or subentity_admin (chapter admin) only

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin']) && empty($_SESSION['ccmps_subentity_admin'])) {
            set_flashdata('You do not have permission to delete this record.');
            redirect('welcome-ccmps/manage/mngallccmps');
            return;
        }

        $recid = segment(3); // passed by button on manage form
        // if delete it doesn't matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        if (strlen($recid) > 0) {
            $data['soft_deleted'] = 1;
            $this->model->update($recid, $data, 'ccmps');
        } else {
            die('delrecord: no recid passed to delete');
        }

        $flash_msg = 'The member was moved to the deleted list.';
        set_flashdata($flash_msg);

        switch ($_SESSION['ccmpmode']) {
            case 'momm': // managing your subentity records
            case 'momv':
                redirect('welcome-ccmps/manage/momm');
                break;

            case 'mosm': // managing your subentity student records
            case 'mosv':
                redirect('welcome-ccmps/manage/mosm');
                break;

            case 'mcmm': // managing current members - used for student members only
            case 'mcmv':
                redirect('welcome-ccmps/manage/mcmm');
                break;

            case 'mngallccmps': // managing all members
            case 'mamv':
                redirect('welcome-ccmps/manage/mngallccmps');
                break;

            default:
                redirect('welcome-ccmps/manage/mngallccmps');
                break;
        }
    }

// **************************  function UNDELRECORD ************************* //

    function undelrecord() { // soft undelete: sets soft_deleted = 0 on a single ccmps record — same permission level as delrecord

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin']) && empty($_SESSION['ccmps_subentity_admin'])) {
            set_flashdata('You do not have permission to restore this record.');
            redirect('welcome-ccmps/manage/mngallccmps');
            return;
        }

        $recid = segment(3);
        $frmpg = segment(4);

        $data['soft_deleted'] = 0;
        $this->model->update($recid, $data, 'ccmps');

        $flash_msg = 'The member was restored.';
        set_flashdata($flash_msg);

        if ($frmpg == 'v') {
            switch ($_SESSION['ccmpmode']) {
                case 'momm':
                case 'mosm':
                case 'mcmm':
                case 'mngallccmps':
                case 'momv':
                case 'mosv':
                case 'mcmv':
                case 'mamv':
                    redirect('welcome-ccmps/viewccmp/' . $recid . '/1/vbe');
                    break;

                default:
                    redirect('welcome-ccmps/viewccmp/' . $recid . '/1/vbe');
                    break;
            }
        } else {
            switch ($_SESSION['ccmpmode']) {
                case 'momm':
                case 'momv':
                    redirect('welcome-ccmps/manage/momm');
                    break;

                case 'mosm':
                case 'mosv':
                    redirect('welcome-ccmps/manage/mosm');
                    break;

                case 'mcmm':
                case 'mcmv':
                    redirect('welcome-ccmps/manage/mcmm');
                    break;

                case 'mngallccmps':
                case 'mamv':
                    redirect('welcome-ccmps/manage/mngallccmps');
                    break;

                default:
                    redirect('welcome-ccmps/manage/mngallccmps');
                    break;
            }
        }
    }

// *************************  function REMOVERECORD ************************* //

    function helpdocs() { // developer documentation / help section — system_admin only

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin'])) {
            set_flashdata('You do not have permission to view this page.');
            redirect('welcome-ccmps/ccmphome');
            return;
        }

        // Replaced 2026-10-29 by the Help pages: the Developer's Guide, CCMPS chapter, from the same
        // chapter files as the Word guide (views/helpdocs.php is no longer kept in sync)
        redirect('help/guide/developer/1');
    }

    function managefontsizes() { // system_admin CRUD for all ccmps_settings display values (tab/header/label/value/button x small/medium/large/color)

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin'])) {
            set_flashdata('You do not have permission to view this page.');
            redirect('welcome-ccmps/ccmphome');
            return;
        }

        $all_settings = $this->model->get('id', 'ccmps_settings');

        // Grouped by type for the view, in a fixed display order — this is
        // purely for a sensible layout, not something the save logic
        // depends on (each row is still saved individually by its own id).
        $grouped = ['tab' => [], 'header' => [], 'label' => [], 'value' => [], 'button' => []];
        foreach ($all_settings as $row) {
            if (isset($grouped[$row->type])) {
                $grouped[$row->type][] = $row;
            }
        }

        $data['grouped_settings'] = $grouped;
        $data['view_module']      = 'welcome/ccmps';
        $data['view_file']        = 'managefontsizes';

        $this->templates->inspinia($this->_with_fontsize_style($data));
    }

    function savefontsizesettings() { // saves all 15 ccmps_settings pixel values at once — system_admin only

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin'])) {
            set_flashdata('You do not have permission to do this.');
            redirect('welcome-ccmps/ccmphome');
            return;
        }

        $submitted = post('px', true); // array: [ccmps_settings.id => submitted value]
        $submitted_notes = post('notes', true); // array: [ccmps_settings.id => notes text]

        if (is_array($submitted)) {
            // Only ever update rows that genuinely exist in ccmps_settings,
            // and only the settingvalue/notes columns — title/type/
            // description are reference data, not something this form
            // edits. Also need each row's title here, not just its id,
            // to know whether to validate as a pixel size or accept as
            // a color.
            $real_rows = [];
            foreach ($this->model->get('id', 'ccmps_settings') as $row) {
                $real_rows[(string) $row->id] = $row->title;
            }

            foreach ($submitted as $id => $value) {
                $id = (string) $id;
                if (!array_key_exists($id, $real_rows)) {
                    continue; // ignore anything not a genuine existing row id
                }

                // Notes is free text, always optional — no validation
                // needed beyond a trim. Combined into the same update()
                // call as settingvalue below, one query per row rather
                // than two.
                $update_data = ['notes' => trim($submitted_notes[$id] ?? '')];

                if ($real_rows[$id] === 'color') {
                    // Deliberately permissive — the whole point of this
                    // field is "no limitations on color," so hex, rgb(),
                    // rgba(), hsl(), a CSS variable reference, or a named
                    // color are all valid. Empty is ALSO valid on
                    // purpose: it means "use the theme's own default,"
                    // not "invalid input" — never skip/reject it the way
                    // an out-of-range pixel value gets skipped below.
                    $update_data['settingvalue'] = trim($value);
                    $this->model->update((int) $id, $update_data, 'ccmps_settings');
                } else {
                    $px = (int) $value;
                    if ($px < 1) {
                        continue; // ignore nonsensical size values rather than saving garbage
                    }
                    $update_data['settingvalue'] = $px;
                    $this->model->update((int) $id, $update_data, 'ccmps_settings');
                }
            }
        }

        set_flashdata('Font size settings saved.');
        redirect('welcome-ccmps/managefontsizes');
    }

    // savefontsize() removed — font size is now 5 separate per-element
    // settings (tab/header/label/value/button), saved as ordinary dropdown
    // fields through the normal Preferences-tab/ccmpsubmit() save flow,
    // not a standalone AJAX modal. See inspinia.php for how they're read.

    function permdelete() { // permanently removes a member and all related child records — system_admin only

        if (empty($_SESSION['ccmps_system_admin']) && empty($_SESSION['system_admin'])) {
            set_flashdata('You do not have permission to permanently delete records.');
            redirect('welcome-ccmps/manage/mngallccmps');
            return;
        }

        $recid = segment(3); // passed by button on manage form

        if (strlen($recid) == 0) {
            die('permdelete: no recid passed to delete');
        }

        // Only allow permanently deleting a record that has already been soft-deleted.
        // This is a safety rail: it forces a two-step confirmation (soft delete first,
        // then permanent delete later) rather than allowing a single click to wipe
        // an active member record with no way back.
        $ccmp_row = $this->model->get_one_where('id', $recid, 'ccmps');
        if (!$ccmp_row || (int) $ccmp_row->soft_deleted !== 1) {
            $flash_msg = 'This record must be soft-deleted before it can be permanently removed.';
            set_flashdata($flash_msg);
            redirect('welcome-ccmps/manage/mngallccmps');
        }

        // Delete child records first (ccmps_aux, ccmps_addresses), then the parent (ccmps).
        // Order matters here in case a foreign key constraint exists on ccmp_id.
        $aux_row = $this->model->get_one_where('ccmp_id', $recid, 'ccmps_aux');
        if ($aux_row) {
            $this->model->delete($aux_row->id, 'ccmps_aux');
        }

        $addr_row = $this->model->get_one_where('ccmp_id', $recid, 'ccmps_addresses');
        if ($addr_row) {
            $this->model->delete($addr_row->id, 'ccmps_addresses');
        }

        $this->model->delete($recid, 'ccmps');

        $flash_msg = 'The member was permanently deleted.';
        set_flashdata($flash_msg);

        switch ($_SESSION['ccmpmode']) {
            case 'momm':
            case 'momv':
                redirect('welcome-ccmps/manage/momm');
                break;

            case 'mosm':
            case 'mosv':
                redirect('welcome-ccmps/manage/mosm');
                break;

            case 'mcmm':
            case 'mcmv':
                redirect('welcome-ccmps/manage/mcmm');
                break;

            case 'mngallccmps':
            case 'mamv':
                redirect('welcome-ccmps/manage/mngallccmps');
                break;

            case 'honchomngallccmps':
                redirect('welcome-ccmps/manage/honcho/honchomngallccmps');
                break;

            default:
                redirect('welcome-ccmps/manage/mngallccmps');
                break;
        }
    }

// *******************  function _GET_USER_TOKEN_EXPIRATION ***************** //

    function _get_user_token_expiration($tguserid2){  // used by Ccmps.php
    // protected - private function

// Do conversions
      // get tg user level and convert to text
      // pull out the user_level_id from
      $tguserobj4 = $this->model->get_one_where('user_id', $tguserid2, 'trongate_tokens');
//  print_r($tguserobj4); die();

/*
Convert datepicker to Unix timestamps
$dptots = $data['htg_birthdate'];
$this->module('timedate');
$data['htg_birthdate'] = $this->timedate->make_timestamp_from_datepicker_us($dptots);

Convert Unix Timestamps to user friendly dates
$format = 'datepicker_us'; //full, cool,shorter,mini, oldschool,datepicker,monyear
$this->module('timedate');
$nicedate = $this->timedate->get_nice_date($timestamp, $format)
*/

      $tokenexpires     = $tguserobj4->expiry_date;
      $tokenexpires_raw = $tguserobj4->expiry_date; // wont be translated to nice date - for tabular report
//print_r($tokenexpires); die();
      if(isset($tokenexpires)) {
//echo('token set and expires: ');
//print_r($tokenexpires); die();
        $this->module('timedate');
        $format = 'datepicker_us';
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);

      }else{
     //   echo('token not set'); die();
        $tokenexpires = '';
      }
//echo('token expires: ');
//print_r($tokenexpires); die();

       return $tokenexpires;
  }

      function _convert_level_id_to_name($tguserid){
      // protected - private function
//print_r($tguserid); die();
// Do conversions
        // get tg user level and convert to text
        // pull out the user_level_id from
        $tguserobj = $this->model->get_one_where('id', $tguserid, 'trongate_users');
   // json($tguserobj); die();
        $tguserlevel = $tguserobj->user_level_id;

        // Get the name of the trongate_user_level
        $tguserlevelobj = $this->model->get_one_where('id', $tguserlevel, 'trongate_user_levels');
         // json($tguserlevelobj); die();

        // Convert the User Level to a user friendly name
        if($tguserlevel > 0){
          $levelname = $tguserlevelobj->level_title;
        }else{
          $levelname = "None";
        }
      //  echo('Line 162 - levelname: ');
    //  print_r($levelname); die();

      return $levelname;
  }

function uploadccmppic($recid){
// white page

 $submit = post('submit', true); // = "Upload"
//echo(8646);
//print_r($submit); die();
$this->submit_upload_picture($recid, $submit);

// flow doesnt come back here

}

function _init_picture_settings() {

// protected - private function

  $picture_settings['max_file_size'] = 2000;
  $picture_settings['max_width'] = 1200;
  $picture_settings['max_height'] = 1200;
  $picture_settings['resized_max_width'] = 450;
  $picture_settings['resized_max_height'] = 450;
  $picture_settings['destination'] =  ''; // ccmps_photos when using public (ie upload to module = false)
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'thumbnail';
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  $picture_settings['upload_to_module'] = true; // no destination needed because update_id will be directory name tacked on to assests rather than ccmps_photos tacked on to public
  $picture_settings['target_submodule'] = 'welcome/ccmps'; // i added - framework img_helper assumed target_module is a parent module in the code and grabbed segment(1) which would be welcome-ccmps which isnt
  // a valid filesystem directory - i edited img_helper

  return $picture_settings;

/* sample
function _init_picture_settings() {
  $picture_settings['max_file_size'] = 2000;
  $picture_settings['max_width'] = 1200;
  $picture_settings['max_height'] = 1200;
  $picture_settings['resized_max_width'] = 450;
  $picture_settings['resized_max_height'] = 450;
  $picture_settings['destination'] = 'bands_pics';
  $picture_settings['target_column_name'] = 'picture';
  $picture_settings['thumbnail_dir'] = 'bands_pics_thumbnails';
  $picture_settings['thumbnail_max_width'] = 120;
  $picture_settings['thumbnail_max_height'] = 120;
  return $picture_settings;
}
*/
}

function submit_upload_picture($update_id) {
//echo(8924); die();
 // $this->module('trongate_security');
 // $this->trongate_security->_make_sure_allowed();


//echo(8694); die();
  $submit = post('submit');

  if ($submit == 'Upload') {
//echo(8698); die();
    $picture_settings = $this->_init_picture_settings(); // the old one passed the update_id
    extract($picture_settings);
//    echo(8936);
//    json($picture_settings); die();
 //   print_r($destination); die();

$ok = $this->_make_sure_got_destination_folders($update_id, $picture_settings); // i added, makes dir if dont exist
//echo(8787); die();

    $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
    $this->validation_helper->set_rules('picture', 'item picture', $validation_str);
    $result = $this->validation_helper->run();
//$result = 1; // temporary

    if ($result == true) {
        if(strlen($destination) > 0){
            $config['destination'] = $destination.'/'.$update_id;

        }else{
            $config['destination'] = $update_id;
        }

      $config['max_width'] = $resized_max_width;
      $config['max_height'] = $resized_max_height;

/*      if ($thumbnail_dir !== '') {
        $config['thumbnail_dir'] = $thumbnail_dir.'/'.$update_id;
        $config['thumbnail_max_width'] = $thumbnail_max_width;
        $config['thumbnail_max_height'] = $thumbnail_max_height;
      } */

$config['upload_to_module'] = $picture_settings['upload_to_module'];
$config['target_submodule'] = $picture_settings['target_submodule']; // i added this to picture settings

      //upload the picture
      $this->image->upload($config);

      //update the database
      $data['picture'] = $_FILES['picture']['name'];

      // replace any spaces with underscore because that is what the file uploader does
      $data['picture'] = str_replace(' ', '_', $data['picture']);

      // save as lowercase to database because filename was converted to lowercase on the upload
      $data['picture'] = strtolower($data['picture']);

      $this->model->update($update_id, $data, 'ccmps');

      $flash_msg = 'The picture was successfully uploaded';
      set_flashdata($flash_msg);

      $_SESSION['ccmp_active_window'] = 4;

// if it is your picture then reset picture session variable, if not dont because if you edited someone else it will change your displayed picture until you login again
$usrrecobj = $this->model->get_one_where('id', $update_id,'ccmps'); // user record being changed
//print_r($update_id); die();
//print_r($usrrecobj); die();
$usrpic = $usrrecobj->picture;
//print_r($_SESSION['ccmp_rec_id']); die();
//print_r($usrpic); die();
    if($_SESSION['ccmp_rec_id'] == $update_id){ // if person logged owns the user record

        $_SESSION['picture'] = $usrpic;
    }
//echo(8996); die();

      redirect($_SERVER['HTTP_REFERER']);

    } else {
  //      echo(9001); die();
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  // echo(9007); die();
}

    function _make_sure_got_destination_folders($update_id, $picture_settings) {

        if(strlen($destination) > 0){
            $destination = $picture_settings['destination'];
        }else{
            $destination = $update_id;
        }
        $target_submodule = $picture_settings['target_submodule'];
        $upload_to_module = $picture_settings['upload_to_module'];
//echo(8748);
//print_r($picture_settings); die();
//print_r($destination); die();
//print_r(APPPATH); die();

        if ($upload_to_module == true) {
         //   $target_dir = APPPATH.'modules/'.segment(1).'/assets/'.$destination.'/'.$update_id;  //

            if(strlen($target_submodule) > 0){ //if in assets under submodule vs. a parent module - I added

              // submodule passed form picture_settings
              $target_dir = APPPATH.'modules/'.$target_submodule.'/assets/'.$destination;
  //echo(8857);
  //print_r($target_dir); die();
            }else{
            // target module determined from segment(1)

               $target_dir = APPPATH.'modules/'.$target_module.'/assets/'.$destination;

            }

//echo(8867);
//print_r($target_dir); die();
        if (!file_exists($target_dir)) {
            //generate the image folder
            mkdir($target_dir, 0777, true);
//echo('made directory: '); print_r($target_dir); die();
        }

//echo(8881); die();

/*

//echo('directory exists'); die();
        //attempt to create thumbnail directory
        if (strlen($picture_settings['thumbnail_dir'])>0) {
          //  $ditch = $destination.'/'.$update_id;
            $ditch = $destination;
          //  $replace = $picture_settings['thumbnail_dir'].'/'.$update_id;
            $replace = $update_id.'/'.$picture_settings['thumbnail_dir'];
            $thumbnail_dir = str_replace($ditch, $replace, $target_dir);
            if (!file_exists($thumbnail_dir)) {
                //generate the image folder
                mkdir($thumbnail_dir, 0777, true);
            }
        }
*/
    }
}

// ***********************  function DITCH_PICTURE ************************** //

    function ditch_picture($update_id = NULL) {
        $update_id = $update_id ?? segment(3); // the address doesn't pass arguments: it crashed for everyone (2026-10-27)
  //  $ccmpsfunction = 'ditch_picture';
    //$authorized = $this->_check_function_permissions($ccmpsfunction);

        if (!is_numeric($update_id)) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (empty($_SESSION['trongatetoken']) || !$this->_member_access($update_id, 'edit')) {
            $this->_deny_member_access(); // your own picture, or an admin for this member (2026-10-27)
        }

   //     $this->module('trongate_security');
   //     $this->trongate_security->_make_sure_allowed();

        $result = $this->model->get_where($update_id);

        if ($result == false) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $picture_settings = $this->_init_picture_settings();
        $target_column_name = $picture_settings['target_column_name'];
        $picture_name = $result->$target_column_name;

        if ($picture_settings['upload_to_module'] == true) {
            $picture_path = APPPATH.'modules/'.segment(1).'/assets/'.$picture_settings['destination'].'/'.$update_id.'/'.$picture_name;
        } else {
            $picture_path = APPPATH.'public/'.$picture_settings['destination'].'/'.$update_id.'/'.$picture_name;
        }

        $picture_path = str_replace('\\', '/', $picture_path);

        if (file_exists($picture_path)) {
            unlink($picture_path);
        }

        if (isset($picture_settings['thumbnail_dir'])) {
            $ditch = $picture_settings['destination'].'/'.$update_id;
            $replace = $picture_settings['thumbnail_dir'].'/'.$update_id;
            $thumbnail_path = str_replace($ditch, $replace, $picture_path);

            if (file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }
        }

        $data[$target_column_name] = '';
        $this->model->update($update_id, $data);

        $flash_msg = 'The picture was successfully deleted';
        set_flashdata($flash_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }


// *********************  function _MEMBER_ACCESS **************************** //
// Who may view / edit / create a member record (security fix 2026-10-27: until then
// viewccmp, updateccmp and createccmp had no check and ccmpsubmit only checked that
// someone was logged in, so any member could open and save anyone's record).
//   own record                                   view, edit
//   Member Admin / System Admin (member), staff  any record, create
//   Chapter Admin                                their own chapter's members, create (own chapter)
//   Student Admin                                Q and S members (ccmp_type 3, 4), create
// $action: 'view' | 'edit' | 'create' | 'admin' ('admin' = edit, but your own record
// doesn't count: lock/unlock, create a login, bulk actions)
// _national_admin(): Member Admin / System Admin (member) or staff - the whole membership
    function _national_admin() {
        return !empty($_SESSION['honcho_sysadmin']) || !empty($_SESSION['honcho_ccmps_admin'])
            || !empty($_SESSION['honcho_ccmps_module_all']) || !empty($_SESSION['honcho_all_modules'])
            || !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || !empty($_SESSION['ccmps_admin']);
    }

    function _member_access($recid, $action) {

        $staff_admin  = !empty($_SESSION['honcho_sysadmin']) || !empty($_SESSION['honcho_ccmps_admin'])
                     || !empty($_SESSION['honcho_ccmps_module_all']) || !empty($_SESSION['honcho_all_modules']);
        $member_admin = !empty($_SESSION['ccmps_system_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || !empty($_SESSION['ccmps_admin']);
        $chapter_admin = !empty($_SESSION['ccmps_subentity_admin']);
        $student_admin = !empty($_SESSION['ccmps_student_admin']);

        if ($staff_admin || $member_admin) {
            return true;
        }
        if ($action == 'create') {
            return $chapter_admin || $student_admin;
        }

        $recid = (int) $recid;
        if ($action != 'admin' && $recid > 0 && !empty($_SESSION['ccmp_logged_in']) && $recid == (int) ($_SESSION['ccmp_rec_id'] ?? 0)) {
            return true; // your own record
        }
        if ($recid < 1 || (!$chapter_admin && !$student_admin)) {
            return false;
        }
        $member = $this->model->get_where($recid, 'ccmps');
        if (!$member) {
            return false;
        }
        if ($chapter_admin && (string) $member->subentity !== '' && (string) $member->subentity === (string) ($_SESSION['ccmps_subentity'] ?? '')) {
            return true;
        }
        if ($student_admin && in_array((int) $member->ccmp_type, array(3, 4))) {
            return true;
        }
        return false;
    }

    function _deny_member_access() { // not allowed: back home with a message (or to the login if not logged in)
        if (empty($_SESSION['trongatetoken'])) {
            redirect('welcome/logout');
        }
        set_flashdata('You are not authorized to see or change that '.strtolower(CCMP).' record.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect(!empty($_SESSION['honcho_logged_in']) && empty($_SESSION['ccmp_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome');
    }

// ******************  function _CHECK_FUNCTION_PERMISSIONS ***************** //

    function _check_function_permissions($ccmpsfunction, $recid = NULL) {
    // protected - private function

/* SECURITY SESSION VARIABLES  - Logged in as CCMP
 USED
 ccmps_admin
 ccmps_subentity_admin
 ccmps_student_admin
 ccmps_cms_admin
 ccmps_system_admin
 ccmp_logged_in
 logged_in

 NOT USED
 ccmps_lib_access
 tg_user_level
*/

/* SECURITY SESSION VARIABLES  - Logged in as Honcho Admin
USED
 honcho_ccmps_admin

 NOT USED
 authenticated
 dms_lib_access
 honcho_logged_in
 sysadmin
 admin
 assistadmin
 subadmin
 cmsadmin
 ccmpsadmin
 useradmin
 */

//echo(9110);
//print_r(CCMPS);
//print_r($recid);
//print_r($ccmpsfunction); die();

        switch($ccmpsfunction) {

          case 'bulkaction': //
              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'manage': //
if($_SESSION['ccmp_logged_in'] == 1  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// no CA rights but logged in
     if($_SESSION['ccmps_cms_admin'] > 0 || $_SESSION['ccmps_student_admin'] > 0 || $_SESSION['ccmps_subentity_admin'] > 0 || $_SESSION['ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ // has rights
                    // authorized...continue
                    $data = "goodtogo";
                    return $data;
                  }else{
                        // send to ccmps homepage
                        $funcname = 'manage';
                        $ccmp = CCMP;

                        $flash_msg = 'You are not authorized to execute the '.$funcname.' '.$ccmp.' function.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
}else{ // not logged in at all - send to login form
// ??? flash msg not showing
                        $funcname = 'manage';
                        $ccmp = CCMP;

        $flash_msg = 'You are not authorized to execute the '.$funcname.' '.$ccmp.' function.';
        set_flashdata($flash_msg);
        $flashmsgisset = 1;
        $_SESSION['flashmsgcolor'] = 0; // crimson
    redirect('welcome/logout'); // clears everything then takes to login page

}

          break;

          case 'ccmphome': //

/* Honcho CCMP Module Roles

    $_SESSION['honcho_sysadmin']      is honcho_user_accounts->honcho_honcho_admin;
    $_SESSION['honcho_ccmps_admin']   is honcho_user_accounts->ccmp_admin;  // "member" admin
*/


              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// logged in
                // everything ok - continue to ccmphome page

                return true; // goes back to lines 58,

              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
//echo(8593); die(); // even without this line it goes to login if not logged in - why ???
              }


          break;

          case 'index': //

                redirect('welcome/logout');

          break;

          case 'events': //
              if($_SESSION['ccmp_logged_in'] == 1  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// no CA rights but logged in
                if($_SESSION['cms_admin'] > 0 || $_SESSION['ccmps_student_admin'] > 0 || $_SESSION['ccmps_subentity_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){ //

                    // authorized...continue
                    $data = "goodtogo";
                    return $data;
                  }else{
                        // send to ccmps homepage
                        $funcname = 'events';
                        $ccmp = CCMP;

                        $flash_msg = 'You are not authorized to execute the '.$funcname.' '.$ccmp.' function.';
                        set_flashdata($flash_msg);

                        redirect('welcome-ccmps/ccmphome');
                  }
              }else{ // not logged in at all - send to login form


                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'currentdirectory': //


              if($_SESSION['ccmp_logged_in'] == 1  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//

                // only need to be logged in
              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }


          break;

          case 'viewccmp': //
   //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
    // record and change it
//print_r($recid); die();
//Only certain roles should be passing other record ids other than their own
//echo(9312);
//json($_SESSION); die();
        if($_SESSION['ccmp_logged_in'] == 1  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// check to see if logged in

          if($_SESSION['cms_admin'] > 0 || $_SESSION['ccmps_student_admin'] > 0 || $_SESSION['ccmps_subentity_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_sysadmin'] > 0){ // has subentity or member admin rights
            // authorized...continue
            $data = "goodtogo";
            return $data;

          }else{ // not an admin role

            // If not an admin role above need to check that the $recid you put in the URL is only yours
            if($recid == $_SESSION['ccmp_rec_id']  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){

            }else{ // not you
                // send to ccmps homepage
                $funcname = 'viewccmp';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to execute this function with someone elses record.';
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

        }

          break;

          case 'updateccmp': //

//Only certain roles should be passing other record ids other than their own

        if($_SESSION['ccmp_logged_in'] == 1  || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// check to see if logged in

          if($_SESSION['cms_admin'] > 0 || $_SESSION['ccmps_student_admin'] > 0 || $_SESSION['ccmps_subentity_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_sysadmin'] > 0){ // has subentity or member admin rights
            // authorized...continue
            $data = "goodtogo";
            return $data;

          }else{ // not an admin role

            // If not an admin role above need to check that the $recid you put in the URL is only yours
            if($recid == $_SESSION['ccmp_rec_id']){

            }else{ // not you
                // send to ccmps homepage
                $funcname = 'updateccmp';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to execute this function with someone elses record.';
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

        }

          break;

          case 'createccmp': //

//Only certain roles should be passing other record ids other than their own

        if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// check to see if logged in

          if($_SESSION['cms_admin'] > 0 || $_SESSION['ccmps_student_admin'] > 0 || $_SESSION['ccmps_subentity_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] > 0 || $_SESSION['ccmps_system_admin'] > 0 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_sysadmin'] > 0){ // has subentity or member admin rights
            // authorized...continue
            $data = "goodtogo";
            return $data;

          }else{ // not an admin role

            // If not an admin role above need to check that the $recid you put in the URL is only yours
            if($recid == $_SESSION['ccmp_rec_id']){

            }else{ // not you
                // send to ccmps homepage
                $funcname = 'createccmp';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to execute this function with someone elses record.';
                set_flashdata($flash_msg);

                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

        }

          break;

          case 'ccmpsubmit': // 3840

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'createccmpuseraccount': // 4837

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'ccmpuseracctsubmit': // 4994

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'export': // 5695

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'currentroster': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'mastercurrentroster': // 6095

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'lesxlsfile': // 7837

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'lockacct': // 7937

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'unlockacct': // 8043

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'delrecord': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'undelrecord': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'ditch_picture': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1 ){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'recalc_totals': //

              if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1 ){//


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

         case 'recalc_status': //

//Only certain roles should be passing other record ids other than their own

        if($_SESSION['ccmp_logged_in'] == 1 || $_SESSION['honcho_sysadmin'] == 1 || $_SESSION['honcho_ccmps_admin'] == 1 || $_SESSION['honcho_sysadmin'] == 1){// check to see if logged in

            // authorized...continue
            $data = "goodtogo";
            return $data;



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

        }

          break;

        }
    }

// ****************  function _WITH_FONTSIZE_STYLE  ************** //

    function _with_fontsize_style($data) {
    // Computes the per-user, per-element inline <style> block — font
    // SIZE (per-member choice, tab/header/label/value/button) plus
    // element COLOR (module-wide, system_admin-configured only, not a
    // per-member choice — a single 'color' row per type in
    // ccmps_settings, no ccmps column involved at all). See the
    // Styling section in the developer docs for the full mechanism.
    // Adds the result to $data as 'ccmps_fontsize_style', for
    // inspinia.php to just safely echo.
    //
    // This has to happen HERE, in the controller, not inside inspinia.php
    // itself — confirmed via a real fatal error and its stack trace that
    // Trongate's template loader (Templates->inspinia() -> a plain
    // load() helper function -> require_once()) does NOT preserve the
    // controller's object context, so $this->model was never going to
    // be available inside the template file. $data, unlike $this, is
    // confirmed to flow through correctly (it's passed as a normal
    // argument, visible in the same stack trace).
    //
    // Wrap every call site that renders via $this->templates->inspinia()
    // with this — e.g. change:
    //     $this->templates->inspinia($data);
    // to:
    //     $this->templates->inspinia($this->_with_fontsize_style($data));
    $data['ccmps_fontsize_style'] = '';

    if (empty($_SESSION['ccmp_rec_id'])) {
        return $data;
    }

    try {
        $ccmp = $this->model->get_where($_SESSION['ccmp_rec_id'], 'ccmps');
        $all_settings = $this->model->get('id', 'ccmps_settings');

        if (!$ccmp || !$all_settings) {
            return $data;
        }

        $by_id = [];
        foreach ($all_settings as $row) {
            $by_id[$row->id] = $row;
        }

        $find_medium = function ($type) use ($all_settings) {
            foreach ($all_settings as $row) {
                if ($row->type === $type && $row->title === 'medium') {
                    return $row;
                }
            }
            return null;
        };

        // Same idea as $find_medium, but for the single color row per
        // type — no per-user id involved, this is a module-wide setting.
        $find_color = function ($type) use ($all_settings) {
            foreach ($all_settings as $row) {
                if ($row->type === $type && $row->title === 'color') {
                    return $row;
                }
            }
            return null;
        };

        // Fragility guard: never trust a stored id blindly. If it's
        // missing, or points at a row whose type doesn't match what this
        // element actually needs (e.g. stale data after ccmps_settings
        // gets reseeded/reordered), fall back to that type's "medium"
        // row found by matching type+title — never by assuming a
        // specific id.
        $element_map = [
            // view page: .tabs-container; update form: .ccmp-form-section (collapsible boxes, 2026-10-27)
            'tab_setting'    => ['tab',    '.tabs-container .nav-tabs > li > a, .ccmp-form-section .faq-question'],
            'header_setting' => ['header', '.tabs-container h4, .ccmp-form-section h4'],
            'label_setting'  => ['label',  '.tabs-container label, .ccmp-form-section label'],
            'value_setting'  => ['value',  '.tabs-container .form-control-static, .ccmp-form-section .form-control'],
            'button_setting' => ['button', '.btn-label-text'],
        ];

        $rules = [];
        foreach ($element_map as $column => $pair) {
            [$type, $selector] = $pair;
            $chosen_id = $ccmp->{$column} ?? null;
            $row = ($chosen_id && isset($by_id[$chosen_id])) ? $by_id[$chosen_id] : null;

            if (!$row || $row->type !== $type) {
                $row = $find_medium($type);
            }

            $declarations = [];

            if ($row) {
                $px = (int) $row->settingvalue;
                $declarations[] = 'font-size: ' . $px . 'px;';
            }

            // Color is deliberately separate from the size lookup above —
            // module-wide, not per-user, and optional: a blank
            // settingvalue means "emit no color rule at all," letting the
            // theme's own default apply. This is specifically how Button
            // Color stays unused by design — buttons currently carry
            // different colors per type (Save=teal, Cancel=orange,
            // Delete=red) for semantic meaning, and a single override
            // would flatten that away, so it's left blank on purpose.
            $color_row = $find_color($type);
            if ($color_row && !empty(trim((string) $color_row->settingvalue))) {
                $declarations[] = 'color: ' . htmlspecialchars($color_row->settingvalue, ENT_QUOTES) . ';';
            }

            if (!empty($declarations)) {
                $rules[] = $selector . ' { ' . implode(' ', $declarations) . ' }';
            }
        }

        if (!empty($rules)) {
            $data['ccmps_fontsize_style'] = "<style>\n" . implode("\n", $rules) . "\n</style>\n";
        }
    } catch (\Throwable $e) {
        // Degrade silently — a font-size lookup failure should never
        // break the page. $data['ccmps_fontsize_style'] stays ''.
    }

    return $data;
    }

// ************************  function _GET_FONT_SIZES *********************** //

    function _get_font_sizes() {
    // Now a deliberate no-op, kept only because 12+ call sites still call
    // it. The single-value session-based fontsize system this used to
    // maintain has been fully superseded by 5 separate per-element
    // settings (tab/header/label/value/button) stored directly on the
    // ccmps record and read fresh in inspinia.php on every page load —
    // there's nothing left for this function to defensively guard.
    //
    // History: originally referenced $ccmp_id before it was ever assigned
    // (so its whole database-lookup body was silently dead code) and also
    // read a tfontsize column that doesn't exist — neither issue was
    // doing anything even when this function still ran, which is
    // presumably why it went unnoticed despite so many call sites.
    return;
    }

// ****************  function REFRESHMYSESSIONDATA ************************** //

    function refreshmysessiondata() {
    // reset any Session variables
//echo(9733);
//json($_SESSION); die();
$ccmprecid = $_SESSION['ccmp_rec_id'];
$user_obj = $this->model->get_one_where('id', $ccmprecid , 'ccmps');
//echo(9737);
//json($user_obj); die();

    $tguid = $user_obj->trongate_user_id;
    $trg_user_obj = $this->model->get_one_where('id', $tguid , 'trongate_users');
    $_SESSION['tg_user_level']    = $trg_user_obj->user_level_id ;// not in ccmps
//echo(9664);
//json($_SESSION['tg_user_level']); die();

    // Font-size preference (tab/header/label/value/button) no longer
    // needs any session handling — read fresh from the ccmps record
    // directly in inspinia.php on every page load. tfontsize removed
    // separately: confirmed no such column exists.

    // Module specific
    $_SESSION['ccmps_subentity']        = $user_obj->subentity;
    $_SESSION['ccmps_subentity_role']   = $user_obj->subentity_role;

    // Security
    $_SESSION['ccmps_cms_admin']        = $user_obj->content_admin; // no cms_admin column; the old flag follows Content Admin
    $_SESSION['ccmps_ccmp_admin']       = $user_obj->ccmp_admin; // was ccmps_admin from a nonexistent admin column
    $_SESSION['ccmps_student_admin']    = $user_obj->student_admin;
    $_SESSION['ccmps_subentity_admin']  = $user_obj->subentity_admin;
    $_SESSION['ccmps_system_admin']     = $user_obj->system_admin;
    rbac_member_session_flags((int) $user_obj->id); // RBAC step 5: from Security Groups; also sets ccmps_admin
    $_SESSION['ccmps_lib_access']       = $user_obj->libacclevel;

    $_SESSION['honcho_national_officer'] = $user_obj->national_officer;
    $_SESSION['minor']                   = $user_obj->minor;

// in case I edited my record I can refresh what is stored about me in session variables
    $_SESSION['ccmp_first']       = $user_obj->first_name;
    $_SESSION['ccmp_last']        = $user_obj->last_name;
    $_SESSION['id_number']        = $user_obj->id_number;
    $_SESSION['call_sign']        = $user_obj->call_sign;
    $_SESSION['ccmp_mobile']      = $user_obj->mobile;
    $_SESSION['picture']          = $user_obj->picture;
    $_SESSION['language']         = $user_obj->language;


    if($_SESSION['subentity_role'] == 1){ // subentity president
        $_SESSION['ccmps_subentity_admin'] = 1;
    }

//echo(9767);
//json($_SESSION); die();

/* some of these session variables could be for honcho - otherwise track them down and delete
    "first_name": "",
    "studentadmin": 0,
    "subentityadmin": 0,
    "memberadmin": 0,
    "systemadmin": 0,
    "button_loc": "BUTTON_LOC",
    "ccmptab": "",
    "user_photo": "",
*/

    $flash_msg = 'Your settings have been updated!';
    set_flashdata($flash_msg);



    // if no admin roles or rights get member menu

    if($_SESSION['ccmpssidemenu'] == 'admin'){
                redirect('welcome-ccmps/adminmenu');

    }else{
               redirect('welcome-ccmps/ccmpmenu');
    }
  }

// ************************  function RECALCSTATUS ************************** //

// ***********************  function _GET_FINANCIAL_SETTING ***************** //
// The financial settings are rows of system_settings (Financial tab of System
// Settings; moved from ccmps_financial_settings 2026-10-22). Look up a
// setting by its title, e.g. 'system_current_year', 'grace_period',
// 'dues_proration', 'current_dues_pmt_year'.
function _get_financial_setting($title){

    return setting($title);
}

// ************************  function RECALCSTATUS ************************** //
// Triggered after an update or new record save (single-member
// recalculation — ccmps_financial_transactions_plan.md, Section 6-A).
// Also called by recalc_all_member_statuses() for the batch path
// (Section 6-B), which System Settings runs when the current year or
// grace period is saved.
// ***********************  function _INTERNAL_ONLY ************************* //
// recalcstatus() and recalc_all_member_statuses() are public because other
// modules call them (System Settings), but they aren't pages: opened from the
// address bar (welcome-ccmps/<method>) they go back home instead (2026-10-31).
function _internal_only($method){
    if(strcasecmp((string) segment(1), 'welcome-ccmps') === 0 && strcasecmp((string) segment(2), $method) === 0){
        redirect('welcome-ccmps/ccmphome');
    }
}

function recalcstatus($recid){

    $this->_internal_only('recalcstatus'); // not a page: refuse it from the address bar (2026-10-31)
    if((int) setting('DUES_STATUS_ENGINE', 0) === 1){ // the dues status engine (dues_helper.php, dues step 2)
        dues_recalc_member((int) $recid, true);
        return;
    }

    $usrobj = $this->model->get_one_where('id', $recid,'ccmps');

    if(!$usrobj){
        return; // nothing to recalculate
    }

    // Rule 1 — deceased or soft-deleted members always carry status 0
    // regardless of dues standing.
    if($usrobj->deceased == 1 || $usrobj->soft_deleted == 1){
        $upddata['status'] = 0; // None
        $this->model->update($recid, $upddata, 'ccmps');
        return;
    }

    // Rule 2 — lifetime members (current_year = CCMP_LIFETIME_YEAR, 2099) are
    // always Current: they pay no dues, so there is no transaction to check.
    // (9999 meant the same and was changed to 2099 on 2026-10-22.)
    if((int) $usrobj->current_year >= CCMP_LIFETIME_YEAR){
        $upddata['status'] = 1; // Current
        $this->model->update($recid, $upddata, 'ccmps');
        return;
    }

    // -----------------------------------------------------------------------
    // TEMPORARY CUTOVER GUARD — ccmps_financial_transactions has no
    // historical data; it only starts filling in from the point this
    // feature went live. A member whose current_year is 2026 or earlier
    // predates that and has no transaction on file, so recalculating them
    // here would incorrectly drop them to Past Due/Expired regardless of
    // their real standing. Leave their status exactly as-is until they
    // actually renew into 2027+ under the new system, at which point
    // ccmpsubmit() creates a real transaction and they start being
    // evaluated normally below.
    //
    // REMOVE (or raise the year) once the current membership has been
    // through at least one renewal cycle under this system — left in
    // place indefinitely, this will also mask a legacy member who
    // genuinely stops renewing, since they'll never move off whatever
    // status they were frozen at.
    // -----------------------------------------------------------------------
    if((int) $usrobj->current_year <= 2026){
        return;
    }

    $system_current_year   = (int) $this->_get_financial_setting('system_current_year');
    $grace_period          = (int) $this->_get_financial_setting('grace_period');
    $member_current_year   = (int) $usrobj->current_year;

    if($member_current_year < $system_current_year){
        // Behind — the active year has moved past what this member last
        // renewed for, and they haven't caught up.
        $status = ($grace_period == 1) ? 2 : 5; // Past Due / Expired
        $upddata['status'] = $status;
        $this->model->update($recid, $upddata, 'ccmps');
        return;
    }

    // Caught up (or ahead — renewed early into a not-yet-active year).
    // Check against the member's OWN current_year, not system_current_year:
    // their transaction was created for whichever year they last renewed
    // into, and with no historical data to fall back on, comparing against
    // system_current_year here would wrongly flag a member who just paid.
    $sql = "SELECT id, rec_by_national, transaction_bal FROM ccmps_financial_transactions
            WHERE ccmp_id = " . (int) $recid . "
            AND dues_year = " . $member_current_year . "
            LIMIT 1";
    $txn_rows = $this->model->query($sql, 'object');

    if(!empty($txn_rows)){

        $txn = $txn_rows[0];

        if((int) $txn->rec_by_national == 1 && (float) $txn->transaction_bal == 0.00){
            $status = 1; // Current — paid and reconciled by National
        }else{
            $status = 3; // Pending — paid the chapter, awaiting National receipt/reconciliation
        }

    }else{

        // Current_year says they're caught up, but no transaction exists —
        // shouldn't happen via the normal ccmpsubmit() flow (a known gap is
        // a direct DB edit to current_year bypassing the app entirely).
        // Treat conservatively, same as "behind."
        if($grace_period == 1){
            $status = 2; // Past Due — grace period active
        }else{
            $status = 5; // Expired — no grace period
        }
    }

    $upddata['status'] = $status;
    $this->model->update($recid, $upddata, 'ccmps');
}

// ****************  function RECALC_ALL_MEMBER_STATUSES ******************** //
// Batch recalculation (ccmps_financial_transactions_plan.md, Section 6-B).
// Called by System Settings (Settings::_recheck_member_statuses()), ONLY
// when system_current_year or grace_period actually changed value — not on
// every settings save (e.g. dues_proration or current_dues_pmt_year
// changing alone doesn't require a full re-scan).
function recalc_all_member_statuses(){

    $this->_internal_only('recalc_all_member_statuses');
    if((int) setting('DUES_STATUS_ENGINE', 0) === 1){ // dues step 2: the year in force, then every member
        dues_roll_year(true);
        dues_recalc_all(true);
        return;
    }

    $sql = "SELECT id FROM ccmps WHERE deceased != 1 AND soft_deleted != 1";
    $rows = $this->model->query($sql, 'object');

    foreach($rows as $row){
        $this->recalcstatus($row->id);
    }
}

// ************************  function NUMVAL ******************************** //

function numval($type, $vallimit, $val){

/*    echo ('Type = ');
    print_r($type);
    echo (' Limit = ');
    print_r($vallimit);
    echo (' Value = ');
    print_r($val);
*/

    switch($type) {

      case 'min': //
       if($val > $vallimit - 1){

         return 1;
       }else{
              return 0;
       }

      break;

      case 'max': //
            if($val < $vallimit + 1){
         return 1;
       }else{
         return 0;
       }

      break;

      case 'equal': //
            if($val == $vallimit){
         return 1;
       }else{
         return 0;
       }

      break;
      }
}


// ************************************************************************** //
// ************************  function EVENTS ******************************** //
// ************************************************************************** //

    function events($id = NULL) {
    // $ccmpsfunction = 'events';
    // $authorized = $this->_check_function_permissions($ccmpsfunction);
//echo(83);
    $_SESSION['selectedid'] = $id;  // id of the selected event. Want to eliminate from array of Other Events below.
     // pass by storing in a session variable.
//print_r($_SESSION['selectedid']); die();


    if($id == NULL){
 //print_r('made it'); die();
          $eventsdata = $this->model->get('id','events');
// print_r($data); die();
          $data['eventsdata']       = $eventsdata;

          $data['contentfile']      = 'events';
          $data['view_module']      = 'welcome/ccmps';
          $data['view_file']        = 'layout'; // sidemenu and space for contentfile
  //echo(104);
  //print_r($data); die();

          $this->templates->boss($data);

    } else {

          $affilid = segment(4);  // affiliate Id for carousel

  //    echo($affilid); die();

          $eventdata = $this->model->get_where($id,'events');
//print_r($eventdata); die();
          $data['event'] = $eventdata; //
//echo(112);
//print_r($data['event']); die();
          $data['contentfile']      = 'event'; // comprehensive events calendar
          $data['view_module']      = 'welcome/ccmps';
          $data['view_file']        = 'layout'; // sidemenu and space for contentfile

          // template is the default location (templates/views/cool_mobi) using old engine, new engine uses public/themes/cool_mobi/black
          $this->templates->boss($data);

    }
}

// ************************************************************************** //
// *************************  function SPONSORS ***************************** //
// ************************************************************************** //

  function sponsors(){
//    echo(60);
//print_r(strlen($_SESSION['ccmp_first'])); die();
if(strlen($_SESSION['ccmp_first']) > 0){
    $data['view_module']   = 'welcome/ccmps';
    $data['view_file']     = 'sponsors'; // full member directory

    $data['bc1'] = 'EMS';
    $data['bc2'] = 'Sponsors';


}else{

        $flash_msg = 'Your Session has expired - please login again.'; //
        set_flashdata($flash_msg);

        // you logged out or session timed out - login again
        redirect('welcome/logout'); // clears everything then takes to login page
}


    $this->templates->inspinia($this->_with_fontsize_style($data));

  }

// ************************************************************************** //
// ******************  function SENDSPONSORSFORMEMAIL *********************** //
// ************************************************************************** //

    function sendsponsorsformemail(){

        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $message  = $_POST['message'];
        $message  = wordwrap($message,70);
        $sender   = "bpaems@gmail.com"; // or $email - inquirers email from form
        $receiver = "bpaems@gmail.com,ericvwoods@hotmail.com";
        $subject  = "Sponsor Volunteer Submission - $name";
        $body     = "Subject: $subject\nFrom: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

        if(mail($receiver, $subject, $body, $sender)){  // mail is an inbuilt php mail function
      //      echo('Message Sent');
        $flash_msg = 'Your message was sent successfully!'; //
        set_flashdata($flash_msg);

        $data['view_module']   = 'welcome/ccmps';
        $data['view_file']     = 'sponsors'; // full member directory

        $data['bc1'] = 'MSP';

        $this->templates->inspinia($this->_with_fontsize_style($data));

        }else{

        $flash_msg = 'Your message failed to send.'; //
        set_flashdata($flash_msg);

        $data['view_module']   = 'welcome/ccmps';
        $data['view_file']     = 'sponsors'; // full member directory

        $data['bc1'] = 'MSP';

        $this->templates->inspinia($this->_with_fontsize_style($data));

        }
    }



} // end controller
