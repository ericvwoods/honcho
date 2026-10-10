<?php
/*

Tables: cms_ccmps_filelibrary_docs, cms_ccmps_filelibrary_doctags, cms_ccmps_filelibrary_doctags3, filelibray_filetypes,
    //   cms_ccmps_filelibrary_bulk_actions
Templates: inspinia.php 
*/
/* Add-ins
 CKEditor.js (inspinia.php)
 pdf.js
*/
//require APPPATH.'vendor/autoload.php'; // composer dependency manager

// Composer
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ccmpslibrary extends Trongate { 

  function _construct(){
    $this->parent_module = 'cms';
    $this->child_module  = 'ccmpslibrary';
  }
  
  function _destruct(){
    $this->parent_module = '';
    $this->child_module = '';
  }

  function index() {

echo "CMS-library-index()...Call System Admin on 202-207-5353...Use Back button"; die();

    $data['bc1']         = 'DMS';
    $data['bc2']         = 'Library';
    $data['activity']    = 'Content Manager';
    $data['header']      = 'Document Management System';
          
    $data['view_module']   = 'cms/ccmpslibrary';
    $data['view_file']     = 'pdfs'; 

    $this->templates->inspinia($data);

  }

          
     
       function showreason(){
           
          $recid  = segment(3);
         // print_r(   $recid); die();
          $docobj = $this->model->get_where($recid,'cms_ccmps_filelibrary_docs');
          $holdreason =  $docobj ->holdreason;
          print_r($holdreason); die();
       }
/*----------------------------------------------------------------------------*/
/*---------------------------- function KANBAN -------------------------------*/
/*----------------------------------------------------------------------------*/
  
    function kanban(){
 $bklgsql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 5"; 
    $data['backlog'] = $this->model->query($bklgsql,'object');
//json($data['backlog']); die(); // now 1
    $inprsql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 4"; 
    $data['inprogress'] = $this->model->query($inprsql,'object');

    $inrvsql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 3"; 
    $data['inreview'] = $this->model->query($inrvsql,'object');

    $pnapsql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 2"; 
    $data['docpending'] = $this->model->query($pnapsql,'object');  

    foreach($data['backlog'] as $row) { 
        $doctag1obj = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;
        
        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);        
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        
        if($row->updated_at == '01/01/1970'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970'){
          $row->created_at = ' ';
        }
        if($row->assigdate == '01/01/1970'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970'){
          $row->startdate = ' ';
        }         
        if($row->duedate == '01/01/1970'){
          $row->duedate = ' ';
        }         
        
        
//print_r($row->lead); die();
       if($row->lead > 0){        
        $tguidobj = $this->model->get_where($row->lead, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();        
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->lead,
                $user_acct_table);
        $row->lead =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->lead =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->lead = "Not Assigned";  
       } 
    }

    foreach($data['inprogress'] as $row) { 
        $doctag1obj = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;
        
        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->assigndate= $this->timedate->get_nice_date($row->assigndate, $format);
        $row->startdate= $this->timedate->get_nice_date($row->startdate, $format);        
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        
        if($row->updated_at == '01/01/1970'){
          $row->updated_at = ' ';
        }
        if($row->created_at == '01/01/1970'){
          $row->created_at = ' ';
        }
        if($row->assigdate == '01/01/1970'){
          $row->assigndate = ' ';
        }
        if($row->startdate == '01/01/1970'){
          $row->startdate = ' ';
        }         
        if($row->duedate == '01/01/1970'){
          $row->duedate = ' ';
        } 
        
        
//print_r($row->lead); die();
       if($row->lead > 0) {        
        $tguidobj = $this->model->get_where($row->lead, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();        
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->lead,
                $user_acct_table);
         $row->lead =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->lead =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;        
       }else{
         $row->lead = "Not Assigned";  
       }        
    }
    

    foreach($data['inreview'] as $row) { 
        $doctag1obj = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;
        
        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        if($row->updated_at == '01/01/1970'){
          $row->updated_at = ' ';
        }

       if($row->lead > 0){        
        $tguidobj = $this->model->get_where($row->lead, 'trongate_users');
        $userm_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();        
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->lead,
                $user_acct_table);
         $row->lead =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->lead =  $usrobj->first_name;
                 $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->lead = "Not Assigned";  
       }   


    }
    

    foreach($data['docpending'] as $row) { 
        $doctag1obj = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
        $row->doctag1 = $doctag1obj->title;
        $doctag2obj = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
        $row->doctag2 = $doctag2obj->title;
        $doctag3obj = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
        $row->doctag3 = $doctag3obj->title;
        
        $this->module('timedate');
        $format = 'datepicker_us';
        $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
        $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);
        $row->duedate= $this->timedate->get_nice_date($row->duedate, $format);
        if($row->updated_at == '01/01/1970'){
          $row->updated_at = ' ';
        }
//print_r($row->lead); die();
       if($row->lead > 0){        
        $tguidobj = $this->model->get_where($row->lead, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();        
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->lead,
                $user_acct_table);
         $row->lead =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->lead =  $usrobj->first_name;
                 $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->lead = "Not Assigned";  
       }        
    }
    
    $data['bc1']         = 'DMS';
    $data['bc2']         = 'Library';
    $data['activity']    = 'Kanban Board';
    $data['header']      = 'Document Library';

    $data['view_module']   = 'cms/ccmpslibrary';
    $data['view_file']     = 'librarykanban'; // use all-in-one crud form for viewing
    $data['managemode']     = $managemode;

    $this->templates->inspinia($data);
        




    }

/*----------------------------------------------------------------------------*/
/*---------------------------- function MANAGE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
    function manage(){

   
/*---------------------------- Security Checks -------------------------------*/
  $docfunction = 'manage';
  $authorized = $this->_check_function_permissions($docfunction);
//echo(274); die();
    // check to see if security token has expired
        
    if(strlen($_SESSION['trongatetoken']) > 0){
        // ok do nothing
    }else{
        $flash_msg = 'Your Session has expired - please login again.'; 
        set_flashdata($flash_msg);
        $_SESSION['flashmsgcolor'] = 0;// red
        // you logged out or session timed out - login again
        redirect('welcome/logout'); // clears everything then to login page
    }

    // passed from sidemenu button sets the mode - ccmp or dmslibadmin 
    // member or content manager respectively
    
/*----------------------- Get Passed Parameters ------------------------------*/
  
    $managemode  = segment(3);
/*
echo('Ccmpslibrary 288');
echo('<br>');
print_r($managemode); die(); 
*/
    
//dmslibccmp ($managemode = 'ccmp')  
//json($_POST); die(); // all 0 first time through because no post - run filter was not pressed
    $sqlfiltersub      = $_POST['sqlfiltersub'];
    $sqlfiltertag1     = $_POST['sqlfiltertag1'];
    $sqlfiltertag2     = $_POST['sqlfiltertag2'];
    $sqlfiltertag3     = $_POST['sqlfiltertag3'];
    $sqlfilterformat   = $_POST['sqlfilterformat'];
    $sqlfilteruploader = $_POST['sqlfilteruploader'];
    $sqlfilteraccess   = $_POST['sqlfilteraccess'];    
    $sqlfilterregion   = $_POST['sqlfilterregion'];
    $sqlfilterstaff    = $_POST['sqlfilterstaff'];
    $sqlfilterccmp     = $_POST['sqlfilterccmp'];    
    
/*    
    echo(90);
    echo('<br>');
    print_r($sqlfiltersub);
    echo('<br>');
    print_r($sqlfiltertag1);
    echo('<br>');
    print_r($sqlfiltertag2);
    echo('<br>');
    print_r($sqlfiltertag3); 
    echo('<br>');
    print_r($sqlfilterformat);
    echo('<br>');
    print_r($sqlfilteruploader);    
    echo('<br>');
    print_r($sqlfilteraccess);
    echo('<br>');
    print_r($sqlfilterregion);    
    echo('<br>');
    print_r($sqlfilterstaff);    
    echo('<br>');
    print_r($sqlfilterccmp);    
    die();
*/
    
    
/*------------------ Get logged in user's info & preferences -----------------*/
  
// Get font size preference for views & manage page  
 // $this->_get_font_sizes();

//    echo(409); 
//    print_r($managemode ); die(); // for debugging

// what subentity does the poster belong to. Relevant for member or subentity admin.
// Content Mgr always Chapter 10 (At Large) synonomous with National.

    $ccmp_id  = $_SESSION['ccmp_rec_id'];
    $ccmp_obj = $this->model->get_where($ccmp_id,'ccmps');
//json($ccmp_obj); die();
    $tg_user_id      = $ccmp_obj->trongate_user_id;
    $subentityadmin  = $ccmp_obj->subentity_admin;
    $subentity       = $ccmp_obj->subentity;

    $subentityobj      = $this->model->get_where($subentity,'ccmps_subentities');
    $subentity_name    = $subentityobj->description;        

    $subentity_role    = $ccmp_obj->subentity_role;
    $subentity_role_id = $ccmp_obj->subentity_role;

    // get dropdown for all tabs

    $data = $this->_populate_dropdowns();
    
//echo(148); 
//json($data); die(); // checkpoint
 
 
/*    
    $data['bulk_actions'] = $this->model->get('id','cms_ccmps_filelibrary_bulk_actions');
//echo($subentity_name); die();
    $data['doctags']   = $this->model->get('id','cms_ccmps_filelibrary_doctags');
    $data['doctags3']  = $this->model->get('id','cms_ccmps_filelibrary_doctags3');
    $data['filetypes'] = $this->model->get('id','cms_ccmps_filelibrary_filetypes');
    $data['rectypes']  = $this->model->get('id','cms_ccmps_filelibrary_rectypes');
*/

 //   json($data['rectypes']); die();
    unset($data['bulk_actions'][1]); // Cannot approve
    unset($data['bulk_actions'][2]); // Cannot Disapprove
    unset($data['bulk_actions'][6]); // Cannot Archive
    
    /*-------------------- Get Appropriate Docs -----------------------*/

    // commented out in manage.php because not used
 //   $sqlfiltersub = 0;
 //   $sqlfilteruploader = 0;

/* 
echo(173);
echo('<br>');
echo('SESSION[ccmpmode]: '); 
print_r($managemode);
echo('<br>');
echo('managemode: '); //
print_r($managemode);
echo('<br>');
echo('subentity: '); 
echo($subentity); 
echo('<br>');
echo('sqlfiltersub: ');
print_r($sqlfiltersub);
echo('<br>');
echo('sqlfiltertag1: ');
print_r($sqlfiltertag1);
echo('<br>');
echo('sqlfiltertag2: ');
print_r($sqlfiltertag2);
echo('<br>');
echo('sqlfiltertag3: ');
print_r($sqlfiltertag3); 
echo('<br>');
echo('sqlfilterformat: ');
print_r($sqlfilterformat);
echo('<br>');
echo('sqlfilterregion: ');
print_r($sqlfilterregion);
echo('<br>');
echo('sqlfilteruploader: ');
print_r($sqlfilteruploader);
echo('<br>');
echo('sqlfilteraccess: ');
print_r($sqlfilteraccess);
echo('<br>');
echo('sqlfilterstaff: ');
print_r($sqlfilterstaff);
echo('<br>');
echo('sqlfilterccmp: ');
print_r($sqlfilterccmp);
echo('<br>');
echo('sqlfiltersub_length: ');
print_r(strlen($sqlfiltersub));
echo('<br>');
echo('sqlfiltertag1_length: ');
print_r(strlen($sqlfiltertag1));
echo('<br>');
echo('sqlfiltertag2_length: ');
print_r(strlen($sqlfiltertag2));
echo('<br>');
echo('sqlfiltertag3_length: ');
print_r(strlen($sqlfiltertag3)); 
echo('<br>');
echo('sqlfilterformat_length: ');
print_r(strlen($sqlfilterformat)); 
echo('<br>');
echo('sqlfilterregion_length: ');
print_r(strlen($sqlfilterregion)); 
echo('<br>');
echo('sqlfilteruploader_length: ');
print_r(strlen($sqlfilteruploader));
echo('<br>');
echo('sqlfilteraccess_length: ');
print_r(strlen($sqlfilteraccess));
echo('<br>');
echo('sqlfilterstaff_length: ');
print_r(strlen($sqlfilterstaff));
echo('<br>');
echo('sqlfilterccmp_length: ');
print_r(strlen($sqlfilterccmp));      
 die();
*/
 //echo(457); die();
// when the page first loads no filer button is pressed so filters all null so get all docs for that ccmpmode
// check to see if all null therefore page just loaded
// OR or perhaps the page has loaded and the filter button pressed but all the filters on the default All (1)
//echo(210); die();
    //Case 1: No filters set. Either all = 0 (Run Filter button pushed with all set to All) or initial page load and all are Null //|| ( strlen($sqlfiltertag1) == 0 AND strlen($sqlfiltertag2) == 0 AND strlen($sqlfiltertag3) == 0 AND strlen($sqlfilterformat) == 0 AND strlen($sqlfilterregion) == 0 AND strlen($sqlfilteruploader) == 0 AND strlen($sqlfilteraccess) == 0  AND strlen($sqlfilterstaff) == 0  AND strlen($sqlfilterccmp) == 0 )
    if($sqlfiltersub == 0 AND $sqlfiltertag1 == 0 AND $sqlfiltertag2 == 0 AND $sqlfiltertag3 == 0 AND $sqlfilterformat == 0 AND $sqlfilterregion == 0 AND $sqlfilteruploader == 0 AND $sqlfilteraccess == 0  AND $sqlfilterstaff == 0 AND $sqlfilterccmp == 0 ){ // NO FILTERS SET - all are 1(All) or NULL
//echo(464); 
//print_r($managemode); die();
    switch ($managemode){ 
        
        case 'dmslibccmp'; // logged in user is acting as himself - filetype = 0 is all. 1 is database where there is no physical file, 2 text, 3 pdf, 4 word, 5 ppt, 6 excel, 7 zip
            $usr_obj = $this->model->get_one_where('username', $_SESSION['username'], $_SESSION['acct_table']);
            $usr_tguid =  $usr_obj->trongate_user_id;
            $_SESSION['libacclevel'] = $usr_obj->libacclevel;
            $usrdocseclevel = $_SESSION['libacclevel'] + 1;
//            echo(208); 
//print_r($usrdocseclevel); die();            
            // if you come from another module the $_SESSION['ccmpmode'] may be still set to that last value - reset here
            $_SESSION['ccmpmode'] = 'ccmp'; // case dmslibccmp because user chose Library sidemenu link for a ccmp
         //   $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 1 AND filename != 'NULL'"; 
        // show a non-admin only things that are final and ready - will show admin everything so they can fix them
        $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 1 AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel OR active = 1 AND status > 0 AND lead = $usr_tguid"; 
//echo(207); die();
        break;
    
        case 'momads'; // Chapter Admin - Dont need to be active or final because he can change that
                       // but must belong to his subentity

            $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE subentity = $subentity"; 
//echo(279);
//print_r($subentity); 
//print_r($sql); die();
        break;

        case 'dmslibadmin'; // Content Mgr - Can do everything so see all records
            $_SESSION['libacclevel'] = 13; // overrides your libacclevel setting
            $usrdocseclevel = $_SESSION['libacclevel'] + 1; 
//echo(210);
//print_r($manageview); die();
            $sql = "SELECT * FROM cms_ccmps_filelibrary_docs"; 

        break;
    }

    $filter = 'None';
    $case = 'Case 1: No filters set. Either all = 0 (Set Filter button pushed with all set to All) or initial page load and all are Null';

/*
echo(506);//
echo('<br>');
print_r($filter);
echo('<br>');
print_r($sql); die();
*/

    }else{ // AT LEAST ONE FILTER IS SET (not all 0 or null)
//echo(302); die();
/*
echo(251);
echo('<br>');
print_r($subentity);
echo('<br>');
print_r($sqlfiltersub);
echo('<br>');
//print_r($_SESSION['ccmpmode']); die();
print_r($managemode); die();
*/
        
         $usrdocseclevel = $_SESSION['libacclevel'] + 1; // because using < vs <=
//echo(262); 
//print_r($usrdocseclevel); die();
            $whereclausealreadyset = 0; // reset just in case
           // $term10 = ''; // reset because of back button actions, etc.
            
            if($sqlfiltersub > 0){
echo(532);
    print_r($managemode); die();

                switch ($managemode){
                      case 'dmslibccmp';                     
                            $whereclausealreadyset = 1;
                            $subterm = ' WHERE subentity = '.$sqlfiltersub; 
                            $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                      break;
                      case 'dmslibadmin'; // admin not restricted by status or security level
                            $whereclausealreadyset = 1;
                            $subterm = ' WHERE subentity = '.$sqlfiltersub;           
                      break;
                }    
//echo(267);
//print_r($subterm); 
//echo('<br>');
//print_r($term5); die();
            }else{
//echo(270);
//print_r($sqlfiltersub); die();
                $subterm = '';
            }

            
            if($sqlfiltertag1 > 0){
                if($whereclausealreadyset == 1){

                    switch ($managemode){
                          case 'dmslibccmp';
                                $term1 = ' AND doctag1 = '.$sqlfiltertag1; 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL'  AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                      break;
                          case 'dmslibadmin';
                                $term1 = ' AND doctag1 = '.$sqlfiltertag1;           
                          break;
                    }
//echo(287);
//print_r($term1); 
//echo('<br>');
//print_r($term5); die();                   
                }else{
                    
                    switch ($managemode){
                          case 'dmslibccmp';
                                $whereclausealreadyset = 1;
                                $term1 = ' WHERE doctag1 = '.$sqlfiltertag1; 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                       break;
                          case 'dmslibadmin';
                                $whereclausealreadyset = 1;
                                $term1 = ' WHERE doctag1 = '.$sqlfiltertag1;           
                          break;
                    }                    
                }
echo(587);
print_r($term1);
echo('<br>');
print_r($term5); die();
            }else{
                $term1 = '';
            }
            
            if($sqlfiltertag2 > 0){
              
                switch ($managemode){
                     case 'dmslibccmp';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term2 = ' AND doctag2 = '.$sqlfiltertag2;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term2 = ' WHERE doctag2 = '.$sqlfiltertag2;  
                    } 
               $term5 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                  
                      break;
                      
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term2 = ' AND doctag2 = '.$sqlfiltertag2;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term2 = ' WHERE doctag2 = '.$sqlfiltertag2;  
                    }      
                             
                      break;
                }
echo(625);
print_r($term2);
echo('<br>');
print_r($term5); die();                
            }else{
                $term2 = '';
            } 
            
            if($sqlfiltertag3 > 0){
              

                switch ($managemode){
                     case 'dmslibccmp';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term3 = ' AND doctag3 = '.$sqlfiltertag3;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term3 = ' WHERE doctag3 = '.$sqlfiltertag3;  
                    }
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                      break;                
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term3 = ' AND doctag3 = '.$sqlfiltertag3;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term3 = ' WHERE doctag3 = '.$sqlfiltertag3;  
                    }      
                             
                      break;
                }         
            }else{
                $term3 = '';
            }              

            if($sqlfilterformat > 0){
              

                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term4 = ' AND filetype = '.$sqlfilterformat;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term4 = ' WHERE filetype = '.$sqlfilterformat;  
                    } 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term4 = ' AND filetype = '.$sqlfilterformat;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term4 = ' WHERE filetype = '.$sqlfilterformat;  
                    }      
                             
                      break;
                }         
            }else{
                $term4 = '';
            }
            
            if($sqlfilterregion > 0){
              

                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term5 = ' AND region = '.$sqlfilterregion;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term5 = ' WHERE region = '.$sqlfilterregion;  
                    } 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term5 = ' AND region = '.$sqlfilterregion;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term5 = ' WHERE region = '.$sqlfilterregion;  
                    }      
                             
                      break;
                }         
            }else{
                $term5 = '';
            }            

               if($sqlfilteruploader > 0){
              
                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term6 = ' AND uploaded_by = '.$sqlfilteruploader;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term6 = ' WHERE uploaded_by = '.$sqlfilteruploader;  
                    } 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term6 = ' AND uploaded_by = '.$sqlfilteruploader;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term6 = ' WHERE uploaded_by = '.$sqlfilteruploader;  
                    }      
                             
                      break;
                }         
            }else{
                $term6 = '';
            }
            
               if($sqlfilteraccess > 0){
              
                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term7 = ' AND access = '.$sqlfilteraccess;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term7 = ' WHERE access = '.$sqlfilteraccess;  
                    } 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term7 = ' AND access = '.$sqlfilteraccess;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term7 = ' WHERE access = '.$sqlfilteraccess;  
                    }      
                             
                      break;
                }         
            }else{
                $term7 = '';
            }

            
               if($sqlfilterstaff > 0){
              
                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term8 = ' AND tg_user_id = '.$sqlfilterstaff;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term8 = ' WHERE tg_user_id = '.$sqlfilterstaff;  
                    } 
               $term10 = " AND active = 1 AND status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term8 = ' AND tg_user_id = '.$sqlfilterstaff;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term8 = ' WHERE tg_user_id = '.$sqlfilterstaff;  
                    }      
                             
                      break;
                }         
            }else{
                $term8 = '';
            }            
            
               if($sqlfilterccmp > 0){
              
                switch ($managemode){
                 case 'dmslibccmp';
                    if($whereclausealreadyset == 1){
                        
                         $term9 = ' AND ccmp_id = '.$sqlfilterccmp;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term9 = ' WHERE ccmp_id = '.$sqlfilterccmp;  
                    } 
               $term10 = " AND active = 1 AND "
                       . "status = 1 AND filename != 'NULL' AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";
                                 
                    break;                    
                      case 'dmslibadmin';
                          
                    if($whereclausealreadyset == 1){
                        
                         $term9 = ' AND ccmp_id = '.$sqlfilterccmp;
                        
                    }else{
                         $whereclausealreadyset = 1;
                         $term9 = ' WHERE ccmp_id = '.$sqlfilterccmp;  
                    }      
                             
                      break;
                }         
            }else{
                $term9 = '';
            }
            
                        
    echo(864);
    echo('<br>');
    print_r($managemode);
    echo('<br>');
    print_r($subterm);
    echo('<br>');
    print_r($term1);
    echo('<br>');
    print_r($term2);    
    echo('<br>');
    print_r($term3);    
    echo('<br>');
    print_r($term4);    
    echo('<br>');
    print_r($term5);
    echo('<br>');
    print_r($term6); 
    echo('<br>');
    print_r($term7);
    echo('<br>');
    print_r($term8);
    echo('<br>');
    print_r($term9);
    echo('<br>');  
    print_r($term10);  die();

//            echo(587); die();

    $sql = 'SELECT * FROM cms_ccmps_filelibrary_docs'.$subterm.$term1.$term2.$term3.$term4.$term5.$term6.$term7.$term8.$term9.$term10;         
        } // end if filter set

    $orgsql = $sql; // to show what failed query was to user
/*    
echo(898);//
echo('<br>');
echo('User doc Sec Level ');
print_r($usrdocseclevel);
echo('<br>');
print_r($sql); die();
*/

/*
// checkpoint  
$submit = post('submit', true);
if($submit == 'Submit'){   
      
if(!isset($data['rows'])){
    echo(341);
    echo('<br>');
    print_r($case);
    echo('<br>');
    print_r($sql);  
    echo('<br>');
    echo("data['filter']: ");
    print_r($data['filter']); die();
}else{
    echo(352);
    echo('<br>');
    echo("case: ");
    print_r($case);
    echo('<br>');
    echo("data['filter']: ");
    print_r($data['filter']);   
    echo('<br>');
    print_r($sql);
    echo('<br>');
    json($data['rows']);     
 die();
};

} 
// end checkpoint
*/
//echo(938); 
//print_r($subterm); die();
    if(strlen($subterm) < 1){
   
        $subterm = ' = All ';
    }else{ // convert to description
  
        $subobj = $this->model->get_where($sqlfiltersub, 'ccmps_subentities');
        $subtitle = $subobj->title;
        $subterm = $subtitle;
        $subterm = ' = '.$subterm.' ';
        
        $filter = '<span style="color:darkgreen;">'.SUBENTITY.'</span>: <span style="color:crimson;">'.$subtitle.'</span> ';
    };
    
    if(strlen($term1) < 1){
        $term1 = ' = All ';
    }else{
        $formatobj1 = $this->model->get_where($sqlfiltertag1, 'cms_ccmps_filelibrary_doctags1');
        $fmttitle1 = $formatobj1->title;
        $term1 = $fmttitle1;
        $term1 = ' = '.$term1.' ';
        
        $filter = $filter.'<span style="color:darkgreen;">'.CCMPS_FL_TAG1.'</span>: <span style="color:crimson;">'.$fmttitle1.'</span> ';
   
      //   $filter = $filter.CCMPS_FL_TAG1.' [<span style="color:crimson;">'.$fmttitle1.'</span>] '; 
    };
    
    if(strlen($term2) < 1){
        $term2 = ' = All ';
    }else{
        $formatobj2 = $this->model->get_where($sqlfiltertag2, 'cms_ccmps_filelibrary_doctags2');
        $fmttitle2 = $formatobj2->title;
        $term2 = $fmttitle2;
        $term2 = ' = '.$term2.' '; 
        
       $filter = $filter.'<span style="color:darkgreen;">'.CCMPS_FL_TAG2.'</span>: <span style="color:crimson;">'.$fmttitle2.'</span> ';
        
    };
      
    if(strlen($term3) < 1){
        $term3 = ' = All ';
    }else{
        $formatobj3 = $this->model->get_where($sqlfiltertag3, 'cms_ccmps_filelibrary_doctags3');
        $fmttitle3 = $formatobj3->title;
        $term3 = $fmttitle3;
        $term3 = ' = '.$term3.' '; 
        
    $filter = $filter.'<span style="color:darkgreen;">'.CCMPS_FL_TAG3.'</span>: <span style="color:crimson;">'.$fmttitle3.'</span> ';
         
    };
    
    if(strlen($term4) < 1){
        $term4 = ' = All ';
    }else{ // convert to description
   
        $formatobj4 = $this->model->get_where($sqlfilterformat, 'cms_ccmps_filelibrary_filetypes');
        $fmttitle4 = $formatobj4->description;
        $term4 = $fmttitle4;
        $term4 = ' = '.$term4.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">Filetype</span>: <span style="color:crimson;">'.$fmttitle4.'</span> ';
             
    };

    if(strlen($term5) < 1){
        $term5 = ' = All ';
    }else{ // convert to description
   
        $formatobj5 = $this->model->get_where($sqlfilterregion, 'ref_region_codes');
        $fmttitle5 = $formatobj5->description;
        $term5 = $fmttitle5;
        $term5 = ' = '.$term5.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">Region</span>: <span style="color:crimson;">'.$fmttitle5.'</span> ';
             
    };    

    if(strlen($term6) < 1){
        $term6 = ' = All ';
    }else{ // convert to description
   
        $formatobj6 = $this->model->get_where($sqlfilteruploader, 'trongate_users');
        $fmttitle6 = $formatobj6->code;
        $term6 = $fmttitle6;
        $term6 = ' = '.$term6.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">Uploader</span>: <span style="color:crimson;">'.$fmttitle6.'</span> ';
             
    };    

    if(strlen($term7) < 1){
        $term7 = ' = All ';
    }else{ // convert to description
   
        $formatobj7 = $this->model->get_where($sqlfilteraccess, 'cms_ccmps_filelibrary_access');
        $fmttitle7 = $formatobj7->description;
        $term7 = $fmttitle7;
        $term7 = ' = '.$term7.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">Access</span>: <span style="color:crimson;">'.$fmttitle7.'</span> ';
             
    }; 

    if(strlen($term8) < 1){
        $term8 = ' = All ';
    }else{ // convert to description
   
        $formatobj8 = $this->model->get_where($sqlfilterstaff, 'trongate_users');
        $fmttitle8 = $formatobj8->code;
        $term8 = $fmttitle8;
        $term8 = ' = '.$term8.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">Staff</span>: <span style="color:crimson;">'.$fmttitle8.'</span> ';
             
    }; 

    if(strlen($term9) < 1){
        $term9 = ' = All ';
    }else{ // convert to description
   
        $formatobj9 = $this->model->get_where($sqlfilterccmp, 'ccmps');
        $fmttitle9 = $formatobj9->last_name;
        $term9 = $fmttitle9;
        $term9 = ' = '.$term9.' ';
          
        $filter = $filter.'<span style="color:darkgreen;">'.CCMP.'</span>: <span style="color:crimson;">'.$fmttitle9.'</span> ';
             
    }; 
  
    if(strlen($subtitle) < 1){
        $subtitle = 'All';
    }    
    if(strlen($fmttitle1) < 1){
        $fmttitle1 = 'All';
    }
    if(strlen($fmttitle2) < 1){
        $fmttitle2 = 'All';
    }    
    if(strlen($fmttitle3) < 1){
        $fmttitle3 = 'All';
    }
    if(strlen($fmttitle4) < 1){
        $fmttitle4 = 'All';
    }
    if(strlen($fmttitle5) < 1){
        $fmttitle5 = 'All';
    }    
    if(strlen($fmttitle6) < 1){
        $fmttitle6 = 'All';
    }    
    if(strlen($fmttitle7) < 1){
        $fmttitle7 = 'All';
    }    
    if(strlen($fmttitle8) < 1){
        $fmttitle8 = 'All';
    }
    if(strlen($fmttitle9) < 1){
        $fmttitle9 = 'All';
    }    
//  print_r($subtitle);
  
    $allfilter = SUBENTITY.$subterm.CCMPS_FL_TAG1.$term1.CCMPS_FL_TAG2.$term2.CCMPS_FL_TAG3.$term3.'Format '.$term5.'Region '.$term5.'Uploader '.$term6.'Access '.$term7.'Staff '.$term8.CCMP.$term9;
    
    if( $subtitle == 'All' AND $fmttitle1 == 'All' AND $fmttitle2 == 'All' AND $fmttitle3 == 'All' AND $fmttitle4 == 'All' AND $fmttitle5 == 'All' AND $fmttitle6 == 'All' AND $fmttitle7 == 'All' AND $fmttitle8 == 'All' AND $fmttitle9 == 'All'){
      $filter = 'None';        
    }
 /*     
 echo(1106);    
 print_r($filter);
 print_r($sql); die();
*/
   // create the $data and fill it with the rows from the table
  $data['rows'] = $this->model->query($sql,'object');
  
//echo(1113);
//json($data['rows']);   die();

  
  if($data['rows']){ // if you find records to match the query then continue   
   // since not null ok   
    
/*
   if(strlen($allfilter) == 50){ //strlen Tag 1 = All Tag 2 = All Tag 3 = All Format = All is 50. Hopefully others arent
         $filter = 'None';
         $data['showclearfilterbtn'] = 0;
   }else{
        $data['showclearfilterbtn'] = 1;
   } */
   //print_r($filter); die(); 
    $data['sql'] = $sql; // for user interface
    $data['filter'] = $filter; // for user interface 
    $data['showclearfilterbtn'] = 1;
    //

//    echo(1133); die();
   }else{
     // null since no records found or empty library  
       
        $data['showclearfilterbtn'] = 0;
        switch ($managemode){
        case 'dmslibccmp'; // logged in user is acting as himself - filetype = 0 is all. 1 is database where there is no physical file, 2 text, 3 pdf, 4 word, 5 ppt, 6 excel, 7 zip

      //old      $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 1 AND filename != 'NULL' AND access < '.$usrdocseclevel.' OR active = 1 AND status = 1 AND filetype = 0";
 $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND status = 1 AND access < $usrdocseclevel OR active = 1 AND status = 1 AND filetype = 0 AND access < $usrdocseclevel";             
                $data['rows'] = $this->model->query($sql,'object');
                $data['filter'] = '<span style="color:crimson;">No matches for </span> '.$filter;
                $data['showclearfilterbtn'] = 0;
                break;            
              case 'dmslibadmin';
                $sql = 'SELECT * FROM cms_ccmps_filelibrary_docs';
                $data['rows'] = $this->model->query($sql,'object');
                $data['filter'] = '<span style="color:crimson;">No matches for </span> '.$filter;
                $data['showclearfilterbtn'] = 0;
              break;
        } 

        
//echo(388);
//echo('<br>');
//print_r( $filter); die();

    }
/*----------------- Add User Friendly Values ------------------*/
//echo(1162); die();
//loop through the records and add a user friendly values to each record
// cannot convert values because interface uses the id key values
//echo(1165);
//echo('<br>');
//json($data['rows']); die();   
 foreach($data['rows'] as $row) { 
     $filetype = $row->filetype;
  switch($filetype) {

  case '1': // DB Record 
       $row->fileicon = 'fa fa-database fa-1x';
  break;

  case '2': // Text 
        $row->fileicon = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $row->fileicon = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
       $row->fileicon = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
       $row->fileicon = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $row->fileicon = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
       $row->fileicon = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3 
      $row->fileicon = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $row->fileicon = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV 
       $row->fileicon = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
       $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
       $row->fileicon = 'fa fa-file-picture-o fa-1x';
  break;

  default;  
 // $data['fileicon'] = 'fa fa-file-text-o fa-1x';
    $row->fileicon = 'fa fa-file-text-o fa-1x';   
}
    $tagobj1 = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
    $row->doctag1 = $tagobj1->title;

    if(strlen($row->doctag1) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
//echo(1230); die();
        $row->doctag1 = '';
    }

    $tagobj2 = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
    $row->doctag2 = $tagobj2->title;

    if(strlen($row->doctag2) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags2
//echo(349); die();
        $row->doctag2 = '';
    }

    $tagobj3 = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
    $row->doctag3 = $tagobj3->title;

    if(strlen($row->doctag3) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags3
//echo(349); die();
        $row->doctag3 = '';
    }

    $ftypeobj = $this->model->get_where($row->filetype, 'cms_ccmps_filelibrary_filetypes');
    $row->filetypetitle = $ftypeobj->title;

    if(strlen($row->filetypetitle) < 1){ 
//echo(349); die();
        $row->filetypetitle = 'Missing';
    }
// extract the subentity
    $subid = $row->subentity;
    if($subid == 0){ // parent org record - no subentity
        $subid = 1;
        $row->subentity = 1;        
    }
        $subentobj = $this->model->get_where($subid, 'ccmps_subentities');
        $row->subenttitle = $subentobj->title;        
    
    if(strlen($row->subenttitle) < 1){ 
//echo(349); die();
        $row->subenttitle = 'NA';
    }
    if($subid == 0){ // parent org record - no subentity
         $subid = 1;
                 $row->subentity = 1;  
    }   
    $subregobj = $this->model->get_one_where('subentity', $subid, 'ref_subentity_region');   
    $regid = $subregobj->region;
    $regobj = $this->model->get_where($regid, 'ref_region_codes');   
    $row->regiontitle = $regobj->description;
    
    if(strlen($row->regiontitle) < 1){ 
//echo(349); die();
        $row->regiontitle = 'NA';
    }    
   
    if(strlen($row->filename) < 1){ 

        if($row->filetype < 2){ // 2 or less
            $row->filename = 'NA';
        }else{
            $row->filename = 'File Missing';
        }

    }

}

//echo(1296);
//json($data['rows']); die(); // checkpoint - user friendly values

/*------------------------------------------------------------------------------------------*/    

    // step through the array of records and pull out needed values for view pg
    foreach($data['rows'] as $row) {  

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.
            
    $tgusrid   = $row->uploaded_by;
//print_r($tgusrid ); die();  
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users');
// json($tgusrobj); die();    
    $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table); die();     
//print_r($tgusrobj); die();           
    // Get the poster's name for each record
    if($tgusrid > 0){
    $uploader_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
     $row->uploader =  $uploader_obj->first_name.' '.$uploader_obj->last_name;
    }else{
      $row->uploader = 'NA';  
    }
//echo(1321);   
//print_r( $row->uploader); die(); // ok


/*----------- Change values to display descriptions instead of code ----------*/

       if($row->lead > 0){        
        $tguidobj = $this->model->get_where($row->lead, 'trongate_users');
        $user_acct_table = $tguidobj->login_acct_info_table;
//print_r($user_acct_table); die();        
        $usrobj = $this->model->get_one_where('trongate_user_id', $row->lead,
                $user_acct_table);
        $row->lead =  $usrobj->first_name.' '.$usrobj->last_name;
       // $row->lead =  $usrobj->first_name;
         $row->phone =  $usrobj->phone;
        $row->mobile =  $usrobj->mobile;
         $row->whatsapp =  $usrobj->whatsapp;
          $row->email =  $usrobj->email_address;
       }else{
         $row->lead = "NA";  
       }    
    
  
    
    $scopeobj   = $this->model->get_where($row->scope,'cms_ccmps_filelibrary_scopes');             
    $row->scope = $scopeobj->title;

    $accessobj   = $this->model->get_where($row->access,'cms_ccmps_filelibrary_access');             
    $row->access = $accessobj->title;


/*    switch($row->scope) {
    case '1':  
            $scopeobj   = $this->model->get_where($row->scope,'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break; 

    case '2':  
            $scopeobj   = $this->model->get_where($row->scope,'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break;

    case '3':  
            $scopeobj   = $this->model->get_where($row->scope,'ccmps_scopes');             
            $row->scope = $scopeobj->title;
    break;

    }  */
    
   // unset($data['bulk_actions'][0]); // NA - used with std HTML dropdown with submit button
 //echo(1372);   
 //json($data['rows']); die();


    $ccmp_id  =  $row->ccmp_id;
    if($ccmp_id == 0){
$row->subentity_role = 'Regular';
    }else{
    $ccmp_obj = $this->model->get_where($ccmp_id,'ccmps');
//json($ccmp_obj); die();
    $tg_user_id      = $ccmp_obj->trongate_user_id;
    $subentity       = $ccmp_obj->subentity;     
// Add a row for subentity_role - for some reason it wasnt there
    $row->subentity_role  = $ccmp_obj->subentity_role;

    $subentityrole = $row->subentity_role;//print_r($subentityrole); die();   
    $subentityobj = $this->model->get_where($subentityrole,'ccmps_subentity_offices');
    
    $row->subentity_role = $subentityobj->description;
//print_r($row->subentity_role); die();
//json($data['rows']); die(); 
}
    $subentityid    = $row->subentity;
    $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
    $row->subentity = $subentityobj->description;


    $this->module('timedate');
    $format = 'datepicker_us';
    $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
    $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);

    if($row->updated_at == '01/01/1970'){
      $row->updated_at = ' ';
    }

//echo(1405);   
// json($data['rows']); die(); 
    } // end foreach


//echo(1415);
//json($data['rows']); die(); // checkpoint - descriptions in place of codes
    
    /*----------- Add $data array elements for manage view -----------------*/
    
    $data['logged_in']     = $_SESSION['logged_in'];
    $data['home_page']      = 0;

    $data['content_name']   = SITENAME;  
//  $data['subentity_name']  = $subentity_name; // do anything with this ???

    $data['view_module']   = 'cms/ccmpslibrary';
    $data['view_file']     = 'manage'; // 

    $data['managemode']     = $managemode;
/* 
    echo(505);
    echo('<br>'); 
    print_r($_SESSION['ccmpmode'] );
    echo('<br>'); 
    json($_SESSION); die();
*/    
    
    switch($managemode) { 

    case 'dmslibccmp': // managing your own ads/docs

          $data['bc1']          = 'DMS';
     //     $data['bc2']          = 'Manage My Documents'; not allowing ccmps to have own docs
          $data['bc2']          = 'Document Library';
          $data['salutation']   = $ccmp_obj->salutation;
          $data['first_name']   = $ccmp_obj->first_name;
          $data['middle_name']  = $ccmp_obj->middle_name;
          $data['last_name']    = $ccmp_obj->last_name;
          $data['suffix']       = $ccmp_obj->suffix;
        //  $data['header']       = 'Manage My Documents';
          $data['header']      = CCMPS.' Document Library';
        //  $data['activity']    = 'Content Manager';
          
    break;

    case 'momads': // subentity admin

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'Chapter Documents';
          $data['activity']    = $_SESSION['subentity_name'];
       //   $data['header']      = 'Manage Chapter Documents'; hard coded
    break;

    case 'dmslibadmin': // content manager

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'All Document Records';
 
          $data['header']      = 'Document Management System'; 
          $data['activity']    = 'Document Library';

          
    break;

    }

      // bulk actions may be too dangerous
     //   print_r($data['bulk_actions']); die();
/*    
  echo(555); 
  json($data); die(); // checkpoint
*/  
        $this->templates->inspinia($data);

  }

/*----------------------------------------------------------------------------*/
/*------------------------------ End manage ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------------- FUNCTION VIEWDOCREC ------------------------------*/
/*-------------------------------------------------- -------------------------*/
  
function viewdocrec(){ 

    $recid      = segment(3);
    $managemode = segment(4);
    
/*
echo(1236);
echo('<br>');
print_r($recid);
echo('<br>');
print_r($managemode);die();
*/
    
/*---------------------------- Security Check --------------------------------*/
  $docfunction = 'view';
  $authorized = $this->_check_function_permissions($docfunction, $recid); 
//echo(628); die();
if(strlen($_SESSION['trongatetoken']) > 0){
    // ok do nothing
}else{
    $flash_msg = 'Your Session has expired - please login again.'; // username was not valid
    set_flashdata($flash_msg);
    $_SESSION['flashmsgcolor'] = 0; //red
    // you logged out or session timed out - login again
    redirect('welcome/logout'); // clears everything then takes to login page
}

/*----------------------- Get Passed Parameters ------------------------------*/

//  $vbe = segment(5); // viewing before editing

//  if($vbe == 'vbe'){ // if you are viewing before editing
//    $_SESSION['crudtab'] = segment(4);
//    $vbe = ''; // reset

//  } // else viewing after editing so want to return to tab just edited so dont
    // change value of tab #
//print_r( $_SESSION['crudtab']); die();
/*----------------- Get logged in user's info & preferences ------------------*/
  
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();

/*---------------------------- Run Queries -----------------------------------*/ 
  // Get record to view
  
  $data = $this->_get_a_single_record($recid);
  
 /*   $adobj = $this->model->get_where($recid,'cms_ccmps_filelibrary_docs');
  
    $data['id']               = $adobj->id;
    $data['tg_user_id']       = $adobj->tg_user_id; 
    $data['ccmp_id']          = $adobj->ccmp_id;
    $data['downloads']        = $adobj->downloads;
    $data['active']           = $adobj->active;
    $data['approved']         = $adobj->approved;
    $data['status']           = $adobj->status;
    
    $data['rectype']          = $adobj->rectype; // DB Record or Upload File
    $data['subentity']        = $adobj->subentity;    
    $data['doctag1']          = $adobj->doctag1;
    $data['doctag2']          = $adobj->doctag2;
    $data['doctag3']          = $adobj->doctag3;      
    $data['filetype']         = $adobj->filetype;
    $data['filemime']         = $adobj->filemime;
    
    $data['featured']         = $adobj->featured;                               
    $data['scope']            = $adobj->scope;
    $data['access']           = $adobj->access;
    $data['affiliate']        = $adobj->affiliate;
    $data['title']            = $adobj->title;  
    $data['author']           = $adobj->author;  
    $data['shortdescription'] = $adobj->shortdescription;  
    $data['fulldescription']  = $adobj->fulldescription;
    $data['notes']            = $adobj->notes;  
    $data['filename']         = $adobj->filename;
    $data['filesize']         = $adobj->filesize;
    $data['filedate']         = $adobj->filedate;     
    $data['location']         = $adobj->location;  
    $data['orglogo']          = $adobj->orglogo;  
    $data['smallimage']       = $adobj->smallimage;  
    $data['largeimage']       = $adobj->largeimage;  
    $data['extlink']          = $adobj->extlink;
    $data['uploaded_at']      = $adobj->uploaded_at;
    $data['uploaded_by']      = $adobj->uploaded_by;     
    $data['created_at']       = $adobj->created_at; 
    $data['created_by']       = $adobj->created_by; 
    $data['updated_at']       = $adobj->updated_at;
    $data['updated_by']       = $adobj->updated_by;

    $data['lead']             = $adobj->assignedto;
    $data['assigndate']       = $adobj->assigned;
    $data['duedate']          = $adobj->duedate;
    $data['eststartdate']     = $adobj->eststart;
    $data['startdate']        = $adobj->actualstart;
    $data['estenddate']       = $adobj->estend;
    $data['enddate']          = $adobj->actualend;
    $data['submitted']        = $adobj->submitted;   
    
    $data['onhold']           = $adobj->onhold;
    $data['holdreason']       = $adobj->holdreason;
    $data['blocked']          = $adobj->blocked;
    $data['blocker']          = $adobj->blocker;
                                         
    $_SESSION['oldfilename']  = $adobj->filename; 

  $tgusrid        = $adobj->tg_user_id; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
*/
  
  $_SESSION['oldfilename']  = $data->filename; 

  $tgusrid        = $data->tg_user_id; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;
  
  
/*--------------------- Convert to User Friendly Values ----------------------*/

      if($data['onhold'] == 1){
        $data['onhold'] = 'Yes';
    }else{
        $data['onhold'] = 'No';
    }

    if($data['blocked'] == 1){
        $data['blocked'] = 'Yes';
    }else{
        $data['blocked'] = 'No';
    }

    if($data['rejected'] == 1){
        $data['rejected'] = 'Yes';
    }else{
        $data['rejected'] = 'No';
    }
    
  $data['created_at']        = $adobj->created_at;
  $data['updated_at']        = $adobj->updated_at;
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);
   $data['uploaded_at']  = $this->timedate->get_nice_date($data['uploaded_at'],
          $format);

/*   
   print_r($data['filetypetitle']); die();

if(strlen($data['filetypetitle']) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags
//echo(349); die();
    $data['filetypetitle'] = 'Missing';
}else{
    $data['filetypetitle'] = $filetypetitle;
} */
//print_r($data['uploaded_by']); die(); 
    $tgusrid = $data['uploaded_by'];
    if($tgusrid > 0){
    $tgusrobj  = $this->model->get_where( $tgusrid,'trongate_users'); 
    $user_acct_table = $tgusrobj->login_acct_info_table;

    $uploader_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
    
       $data['uploaded_by'] =  $uploader_obj->first_name.' '.$uploader_obj->last_name;
    }else{
       $data['uploaded_by'] = 'NA';  
    }
    

    
if($data['rectype'] == 1){ // DB entry no doc
    $data['rectype']     = 'DB Record';
    $data['filetype']    = 'NA';
    $data['filename']    = 'NA';
    $data['filemime']    = 'NA';
    $data['filesize']    = 'NA';
    $data['filedate']    = 'NA';
    $data['uploaded_by'] = 'NA';
    $data['uploaded_at'] = 'NA';
    $data['downloads']   = 'NA';
    $data['rectype']     = 'DB Record';
}else{
    
    if(strlen($data['filename']) < 1){
        $data['rectype']     = 'Document Awaiting Upload';        
    }else{
        
        $data['rectype']     = 'Document';         
    }

    $ftypeobj = $this->model->get_where($data['filetype'], 'cms_ccmps_filelibrary_filetypes');
    $filetypetitle = $ftypeobj->title;
    $filetype = $ftypeobj->id;
    $data['filetype'] = $ftypeobj->title;

    if(strlen($data['filesize']) == 0){
       $data['filesize'] = '';
    }
   
 }
 
  $data['active'] = $adobj->active;
  if($data['active'] == 1){
  	$data['active'] = 'Yes';
  }else{ 
  	$data['active'] = 'No';
  }

  $data['alt_contact_only'] = $adobj->alt_contact_only;
  if($data['alt_contact_only'] == 1){
  	$data['alt_contact_only'] = 'Yes';
  }else{ 
  	$data['alt_contact_only'] = 'No';
  }

  $data['approved'] = $adobj->approved;
  if($data['approved'] == 1){
  	$data['approved'] = 'Yes';
  }else{ 
        $data['approved'] = 'No';
  }
  
  if($data['uploaded_at'] == '01/01/1970'){
  	$data['uploaded_at'] = 'NA';
  }

   // $data['scope'] = $adobj->scope;
    $scopeobj      = $this->model->get_where($data['scope'], 'cms_ccmps_filelibrary_scopes');             
    $data['scope'] = $scopeobj->title;

    $accessobj      = $this->model->get_where($data['access'], 'cms_ccmps_filelibrary_access');             
    $data['access'] = $accessobj->title;
    
    $subentobj      = $this->model->get_where($data['subentity'], 'ccmps_subentities');            
    $data['subentity']  = $subentobj->title;
    if(strlen( $data['subentity']) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
        $data['subentity'] = '';
    }

    
    $statusobj      = $this->model->get_where($data['status'], 'cms_ccmps_filelibrary_status');            
    $data['status'] = $statusobj->title;
    if(strlen( $data['status']) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
        $data['status'] = 'Pre-Backlog';
    }
    
    $regobj         = $this->model->get_where($data['region'], 'ref_region_codes');            
    $data['region'] = $regobj->title;
    if(strlen( $data['region']) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
        $data['region'] = '';
    }

    $ccmpobj      = $this->model->get_where($data['ccmp_id'], 'ccmps');            
    $fn  = $ccmpobj->first_name;
    $ln  = $ccmpobj->last_name;
    $data['ccmp'] = $fn.' '.$ln;
    if(strlen( $data['ccmp']) < 2){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
        $data['ccmp'] = '';
    }

    $husrobj = $this->model->get_one_where('trongate_user_id', $data['tg_user_id'], 'honcho_user_accounts');
    $fn  = $husrobj->first_name;
    $ln  = $husrobj->last_name;
    $data['staff'] = $fn.' '.$ln;
    if(strlen( $data['staff']) < 2){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
        $data['staff'] = '';
    }

    
    $tagobj1 = $this->model->get_where($data['doctag1'], 'cms_ccmps_filelibrary_doctags1');
    $tagtitle = $tagobj1->title;
    $data['doctag1'] = $tagobj1->title;
          
          
    if(strlen($tagtitle) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1

        $data['tagtitle'] = 'Missing';
    }else{
        $data['tagtitle'] = $tagtitle;

    }

    $tagobj2 = $this->model->get_where($data['doctag2'], 'cms_ccmps_filelibrary_doctags2');
    $tagtitle = $tagobj2->title;
    $data['doctag2'] = $tagobj2->title;    
    
    
    $typeobj = $this->model->get_where($data['doctag3'], 'cms_ccmps_filelibrary_doctags3');
    $typetitle = $typeobj->title;
    $data['doctag3'] = $typeobj->title;
    
    if(strlen($typetitle) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags3
//echo(349); die();
        $data['typetitle'] = 'Missing';
    }else{
        $data['typetitle'] = $typetitle;
    }

/*--------------------- Set Navbar & Header Information ----------------------*/
/*
echo(1486);
echo('<br>');
print_r($recid);
echo('<br>');
print_r($managemode);die();
*/

 switch($managemode) {
  case 'dmslibccmp': // manage my docs

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
  //      $data['subentitynm']    = $subentity_name;
        $data['header']       = $adobj->title;
 //echo(963);
 //print_r($data['header']); die();
        //  $data['subheader']    = $adobj->title;
        
  break;

  case 'momads': // subentity admin from manage page
      
        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = SUBENTITY.' Administrator';
     
  break;

  case 'dmslibadmin': // content manager from manage page

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Administrator';
        
  break;

  default;
//echo('1530 - No matching managemode');
//print_r($managemode); die();
        // Auditlog
        $type  = 'viewdocrecrec';
        $action = '1530 - No matching managemode'; 
        $func = 'docrecord-view';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'File: '.$docdata['filename'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 1550: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

}

/*--------------------------- Set Additional Values --------------------------*/
//echo(1153);
//print_r($recid);
//print_r($managemode);die();
  $data['recid']         = $recid;
  $data['view_module']   = 'cms/ccmpslibrary';
  $data['view_file']     = 'ccmpslibrarycrud'; // use all-in-one crud form for viewing
  $data['managemode']     = $managemode;

 switch( $filetype) {

  case '1': // DB Record 
        $data['fileicon'] = 'fa fa-database fa-1x';
  break;

  case '2': // Text 
        $data['fileicon'] = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $data['fileicon'] = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
        $data['fileicon'] = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
        $data['fileicon'] = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $data['fileicon'] = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
        $data['fileicon'] = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3 
        $data['fileicon'] = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV 
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  default;  
  $data['fileicon'] = 'fa fa-file-text-o fa-1x';
} 
  // Where the Upload Button posts the selected file from the Choose File button
 // $data['form_location'] = BASE_URL.'cms-ccmpslibrary/submit_upload/docs';
  
// this really is not a physical location it is where to post form to
  $data['form_location'] = BASE_URL.'cms-ccmpslibrary/submit_upload/'.$recid.'/'.$managemode;
//legacy code
//$data['form_location'] = str_replace('/submit', '/submit_upload', current_url());
//$data['form_location']  = $data['form_location'].$recid;

 // echo(1879);
//print_r($managemode); die();
//json($data); die();
          $this->templates->inspinia($data);
}

/*----------------------------------------------------------------------------*/
/*-------------------------------- End View ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION UPDATE -------------------------------*/
/*----------------------------------------------------------------------------*/
  
  function update($retrying){  // either yes or docid which it will ignore
//print_r($retrying); die();

  $recid = segment(3);
  $managemode = segment(4);
  $docfunction = 'update';
  
//  $authorized = $this->_check_function_permissions($docfunction, $recid);
   
//  echo(1916); die();
//print_r($recid); 
//print_r($managemode); die();
    // firsttime through it passes the recid automatically so have code
    //  ingore it unless it is a "yes"

/*------------------- Get logged in user's info & preferences ----------------*/
    
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
    $retry = $retrying;  

    if( $retry == 'yes'){ 
      // retry does not pass a segment value
      // keep tab number the same for the retry
    }else{
      $_SESSION['crudtab'] = segment(4);
 
    }

/*
    $userobj     = $this->model->get_where($recid,'ccmps');
    $usrchptrid  = $userobj->subentity;
    $subentityobj  = $this->model->get_where($usrchptrid,'ccmps_subentities');
    $subentitynm   = $subentityobj->description;
*/

//echo(1604);
//print_r($retry); 
//print_r($retrying); 
//print_r($recid);
//print_r($_SESSION['tab']); die();

    if($retry == 'yes'){
      $retry = 'no'; // reset - not sure if necessary
      $data = $_POST;
      unset($_POST['submit']);// not in DB will cause error
//print_r($_POST); die();

      // need to reset dropdowns to attempted values ???

    }else{ // getting record to edit
      // get data from DB instead of Post
        $data   = $this->_get_a_single_record($recid, $managemode); 
 //echo(1961);
 //json($data); die();
        
      // change to datepicker format to initialize datepicker fields
      // comes in as "01/01/1970"
      //Format needed   $data['assigndate'] = "2024-06-13";
 
 /*
  $this->module('timedate');
  $format = 'datepicker';
  $data['assigndate']  = $this->timedate->get_nice_date($data['assigndate'],
          $format);
  $data['duedate']  = $this->timedate->get_nice_date($data['duedate'],
          $format);
  $data['eststartdate']  = $this->timedate->get_nice_date($data['eststartdate'],
          $format);
  $data['startdate']  = $this->timedate->get_nice_date($data['startdate'],
          $format);  
  $data['estenddate']  = $this->timedate->get_nice_date($data['estenddate'],
          $format); 
  $data['enddate']  = $this->timedate->get_nice_date($data['enddate'],
          $format);
  $data['submitted']  = $this->timedate->get_nice_date($data['submitted'],
          $format);
      
 */
 //echo(1974);
 //json($data); die();


    }

/*--------------------------- Get Dropdown Values ----------------------------*/
//json($data); die();
    // get dropdown for all tabs

   $dropdowndata =  $this->_populate_dropdowns();
   $data = array_merge($data, $dropdowndata);
//json($data); die();   

/*    
    $data['bulk_actions'] = $this->model->get('id','cms_ccmps_filelibrary_bulk_actions');

    $data['doctags1']   = $this->model->get('id','cms_ccmps_filelibrary_doctags1');
    $data['doctags2']   = $this->model->get('id','cms_ccmps_filelibrary_doctags2');
    $data['doctags3']   = $this->model->get('id','cms_ccmps_filelibrary_doctags3');
    $data['filetypes']  = $this->model->get('id','cms_ccmps_filelibrary_filetypes');
*/
    // some dropdowns want to preselect something other than default first value
/*    
    if(strlen($data['mailstatecode']) >0){
      // Ok not null do nothing
    }else{

      $data['mailstatecode'] = 'NA';
    }
*/

/*----------------------- Set Navbar & Header Information --------------------*/
 //echo(1725);
 //print_r($managemode); die();

 switch($managemode) { // 

  case 'dmslibuserupdate': // ccmp updating from manage page
            // regular ccmp or user who can only update docs assigned to them
        $data['managemode'] = 'dmslibuserupdate';      
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';      
  break;

  case 'dmslibadminupdate': // content manager updating any Doc from manage page

        $data['managemode'] = 'dmslibadminupdate';      
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';
      //  $data['subentitynm']  = $subentitynm; // set dropdown?
  break;

  case 'dmssublibadminupdate': // subentity admin updating a subentity Doc from manage page

        $data['managemode'] = 'dmssublibadminupdate';      
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Update Document';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Updating Document Record';
        
        $data['subheader']  = SUBENTITY.' Lead';
      //  $data['subentitynm']  = $subentitynm;// set dropdown?
  break;

  } 

/*--------------------------- Set Additional Values --------------------------*/

  switch($data['filetype']) {

  case '1': // DB Record 
        $data['fileicon'] = 'fa fa-database fa-1x';
  break;

  case '2': // Text 
        $data['fileicon'] = 'fa fa-file-text-o fa-1x';
  break;

  case '3': //PDF
        $data['fileicon'] = 'fa fa-file-pdf-o fa-1x';
  break;

  case '4': //  Word
        $data['fileicon'] = 'fa fa-file-word-o fa-1x';
  break;

  case '5': //  Powerpoint
        $data['fileicon'] = 'fa fa-file-powerpoint-o fa-1x';
  break;

  case '6': //  Excel
        $data['fileicon'] = 'fa fa-file-excel-o fa-1x';
  break;

  case '7': //  Zip
        $data['fileicon'] = 'fa fa-file-zip-o fa-1x';
  break;

  case '8': // MP3 
        $data['fileicon'] = 'fa fa-file-sound-o fa-1x';
  break;

  case '9': //  MP4
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '10': // MOV 
        $data['fileicon'] = 'fa fa-file-video-o fa-1x';
  break;

  case '11': //  JPG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '12': //  PNG
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  case '13': //  BMP
        $data['fileicon'] = 'fa fa-file-picture-o fa-1x';
  break;

  default;  
  $data['fileicon'] = 'fa fa-file-text-o fa-1x';
}

    // Header Information
    $data['subentitynm']   = $_SESSION['subentity_name'];
    
    // To control input fields
    $data['recid']         = $recid;
//print_r($recid); die();
    $data['view_module']   = 'cms/ccmpslibrary';
    $data['view_file']     = 'ccmpslibrarycrud'; // use all-in-one crud form for updating

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
 //echo(2107);
 //print_r($managemode); die();
 //json($data); die();

    $this->templates->inspinia($data);
         
}

/*----------------------------------------------------------------------------*/
/*------------------------------ End update ----------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*---------------------------- FUNCTION CREATE -------------------------------*/
/*----------------------------------------------------------------------------*/

function create($retrying){ // either Yes or dmslibadmincreate which it will ignore

  $docfunction = 'create';
  $authorized = $this->_check_function_permissions($docfunction); 

/*------------------ Get logged in user's info & preferences -----------------*/
  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
  $retry = $retrying; // for failed validation repost
//echo(1862);
//print_r($retry); die();
// print_r($managemode); // not passed on retry through url
// print_r($_POST['manamgemode']); // posted on a retry

//echo(1867);
//print_r($retry); die();
  
    if($retry == 'yes'){

        $data = $_POST; // get what was posted from the form
        $managemode = $_POST['managemode']; // dmslibadmincreate or dmssublibadmincreate
//json($data); die();

      }else{
        $managemode = segment(3); // preserve managemode 1st try from changing to blank on retry 
          
      }
//print_r($managemode);
//echo('<br>');
//print_r($retrying); die();
/*-------------------------- Populate Dropdowns  -----------------------------*/
    // get dropdown for all tabs
    if($retry == 'yes'){
       // need to reset dropdowns to attempted values 
       $dropdowndata =  $this->_populate_dropdowns(); 
       $data = array_merge($data, $dropdowndata);
       //$retry = 'no'; // reset - not sure if necessary
    }else{
       $data =  $this->_populate_dropdowns(); // creates the $data array and wipes out any settings before

    }
    
//echo(1892);
//json($data); die();

 /* // remove any dropdown choices not priviledged to  
    if($_SESSION['ccmpmode'] == 'ccmp' || $_SESSION['ccmpmode'] == 'momads'){ // momads when CA creating a doc

    // remove the Visible option public which is the 1st element
   // unset($data['ccmps_scopes'][0]); // no public docs
*/

/*
echo(1895);
print_r($managemode); die();
*/
    
switch($managemode) { // 

  case 'dmslibccmp': 
            // regular ccmp w/o admin rights cannot create document records
  break;

  case 'dmslibadmincreate': // content manager creating any Doc from manage page

        $data['managemode'] = 'dmslibadmincreate';      
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Create Record';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Creating Document Record';
      //  $data['subentitynm']  = $subentitynm; // set dropdown?
  break;

  case 'dmssublibadmincreate': // subentity admin updating a subentity Doc from manage page

        //$data['access'] - limited dropdwn choices
        
        $data['managemode'] = 'dmssublibadmincreate';      
        $data['bc1']        = 'DMS';
        $data['bc2']        = 'Create Record';
        $data['header']     = 'Document Library';
        $data['subheader']  = 'Creating Document Record';
        
        $data['subheader']  = SUBENTITY.' Lead';
      //  $data['subentitynm']  = $subentitynm;// set dropdown?
  break;

  } 
//echo(1938);
//json($data); die();  

        
  if($retry == 'yes'){ // headed back to create form        
        // already the correct names
        $data['rectype']           = $data['attachingafile'];
        $data['shortdescription']  = $data['description'];    
        //$data['tg_user_id']       = $data['staff'];
//echo(1944);
//json($data); die();
  }else{ // if initial try need posted values to match DB field names
       
        // Initialize New Record after array has been created so not wiped out
        
        $data['rectype']        = 2; // defaulting to rectype = physical document vs. 1 = DB record
        $data['active']         = 1;
       // $data['approved']       = 1;
        
        // translate field labels which tagged values may not match
        // DB field name values originally submitted to the form
        // this is a result of the dynamic field generation system in the UI
      
        $data['shortdescription'] = $data['description'];    
        $data['ccmp']          = 0;          
        $data['staff']         = 0;

//echo(1938);
//json($data); die();
     
  }        

                
       // $data['tg_user_id'] =  $_SESSION['tg_user_id']; // you are posting
       // $data['ccmp_id']    =  $_SESSION['ccmp_rec_id'];
        $data['view_module']   = 'cms/ccmpslibrary';
        $data['view_file']     = 'ccmpslibrarycrud'; 

 //echo(1960);
 //json($data); die();

        $this->templates->inspinia($data);

}

/*----------------------------------------------------------------------------*/
/*----------------------- End function create --------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*--------------------------- FUNCTION SUBMIT --------------------------------*/
/*----------------------------------------------------------------------------*/

  function submit() {
      
  $docfunction = 'submit';
  $authorized = $this->_check_function_permissions($docfunction); 

  $recid = segment(3); // if updating there will be a record id

  $submit     = post('submit', true);
  $managemode = post('managemode', true); // from a hidden field to pass along
  
  $crudmode = ''; // RESETTING - could be updating or adding. Will determine below

  if($recid > 0){ // if a record number exists then you must be updating
     $crudmode  = 'updating';
  }else{
     $crudmode  = 'adding';
  }


  //$shortdescription = $_POST['description']; // not required
//print_r($title); die();

/*  
  echo(1997);
  echo('<br>');
  echo('$_POST = ');
  json($_POST);
  echo('<br>');
  echo('$recid = ');
  print_r($recid);
  echo('<br>');
  echo('$submit = ');
  print_r($submit);
  echo('<br>');
  echo('$crudmode = ');
  print_r($crudmode);
  echo('<br>');
  echo('$retrying = ');
  print_r($retrying);
  echo('<br>');
  echo('$_session[ccmp_rec_id] = ');
  print_r($_SESSION['ccmp_rec_id']);
  echo('<br>');
  echo('$managemode = ');
  print_r($managemode);
  echo('<br>');
  echo('$_session = ');
  json($_SESSION); die();
*/

if ($submit == 'Submit') { 
  // Get values from post for validation purposes
  
  $title = $_POST['title'];
  
// Your are editing or creating the record - uploading the file is submit_upload 

    $titlelen = strlen($_POST['title']);        
    $msglen = strlen($_POST['shortdescription']);
    
    $this->validation_helper->set_rules('title', 'Title field is '.$titlelen.
     ' characters long and the', 'required|min_length[1]|max_length[50]');
/*
    $this->validation_helper->set_rules('shortdescription', 'Message field'
    . ' is '.$msglen.' characters long and the',
       'required|min_length[1]|max_length[500]');
*/
  // used to cause program to logout with new engine - beta works fine so substituted validation_helper.php from beta ??? still true?

   // $result = $this->validation_helper->run();
    $result = 1; // commented out because only required field is title and using Javascript to check for that
//      echo(2036);
//      print_r($result); die();
//      print_r($_POST['access']); die(); 
    
    if($_POST['access'] == 0){ // did not select an access - default 0 was posted
     //   echo(2040); die();
       set_flashdata('Error: An Access selection is required');  
     
    $_SESSION['flashmsgcolor'] = 0; //  set flash message to red
        $result = 0;
    }

}
     
/*
echo(2318);
echo('<br>');
echo('$recid = ');
print_r($recid);
echo('<br>');
echo('Results of validation helpers');
echo('<br>');
echo('$result = ');
print_r($result);
echo('<br>');
echo('$_POST = ');
json($_POST); die();
*/


  if($result > 0){ // if passed all validations above - save the record
        
        if($recid > 0){ // Passed Updating
//print_r($recid); die();
              
            
            // get some comparison information for other operations
//print_r($docdata); die();
            $docobj = $this->model->get_where($recid,'cms_ccmps_filelibrary_docs');
            $currentloc = $docobj->location;
            $filename   = $docobj->filename;
            $filetype   = $docobj->filetype;
            $filedate   = $docobj->filedate;
            
 // only if chapter librarian would we move file          
         //   $newloc     = $docdata['location']; ???
            
/*           
echo(2400);
print_r($newloc); 
echo(2402);
print_r($currentloc); die();

 */
$newloc = $currentloc;

            if($newloc == $currentloc){// did not reassign to new subentity during the editing
                // no need to move file
            }else{ // assigned doc to new subentity so need to move the file

                // however if it is DB only than no file to move so skip that step
                if($filetype == 1 || $filetype == 0){
                    // Do nothing
                }else{ // $filetype not 0 or 1

                
$filepath = APPPATH.'modules/cms/ccmpslibrary/assets/'.$currentloc.'/'.$filename;

//print_r($filepath); die();

$yep = copy(APPPATH.'modules/cms/ccmpslibrary/assets/'.$currentloc.'/'.$filename, APPPATH.'modules/cms/ccmpslibrary/assets/'.$newloc.'/'.$filename);

if($yep == TRUE){
    // since the copy was successful now delete the orphaned file 
        if (!unlink($filepath)) {

        // Auditlog
        $type  = 'CopyDeleteDoc';
        $action = 'UpdateChapter';
        $func = 'Library-submit';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Filepath:'.$filepath;
        $str5 = 'Title: '.$title;
        $str6 = 'Error 2150: File copied to new directory but the old file cannot be deleted'; 
                            
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);  

        echo ("Error 2156: The subentity on the file was successfully changed and the file copied to the new direftory but the old file cannot be deleted. Contact the System Administrator 202-207-5353. Use the back button."); die();
        }else {
         // Everything OK. The file was moved and orphaned record deleted. 
         // So now update the location
           $docdata['location'] = $newloc;
        } 
               
}else{
        // Auditlog
        $type  = 'CopyDeleteDoc';
        $action = 'UpdateChapter';
        $func = 'Library-submit';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Filepath:'.$filepath;
        $str5 = 'Title: '.$title;
        $str6 = 'Error 2177: The file failed to copy to the new subentity location'; 
                            
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 

    echo ("Error 2469: The file failed to copy to the new subentity location so the subentity cannot be changed. Contact the System Administrator 202-207-5353. Use the back button."); die();

}
                } // $filetype not 0 or 1

            } // end of code to copy a record to a new record to avoid being overwritten
     

// Compare location to see if changed. If so copy file to new location 
// and delete from old location
            // only using a single location in this implementation
            
            // get values from the form
            $docdata = $_POST; 
            
            // convert date picker dates to unix integer timestamps
                           
            $docdata['assigndate']       = strtotime($docdata['assigndate']);
            $docdata['duedate']          = strtotime($docdata['duedate']); 
            $docdata['eststartdate']     = strtotime($docdata['eststartdate']);
            $docdata['startdate']        = strtotime($docdata['startdate']); 
            $docdata['estenddate']       = strtotime($docdata['estenddate']);
            $docdata['enddate']          = strtotime($docdata['enddate']);
            $docdata['submitted']        = strtotime($docdata['submitted']); 

            // Add timestamps
            $docdata['updated_at'] = TIME();
            $docdata['updated_by'] = $_SESSION['tg_user_id']; 
           
            // translate to fields in the DB

            $docdata['shortdescription'] = $docdata['description'];
            $docdata['rectype']          = $docdata['attachingafile'];
            $docdata['ccmp_id']          = $docdata['ccmp'];
            $docdata['tg_user_id']       = $docdata['staff'];            
            
            if($docdata['rectype'] == 2){ // set to 2 or edited from 1 to 2
                
                if($docdata['filetype'] == 0 || $docdata['filetype'] == 1 || strlen($docdata['filetype']) < 1){ // was set to DB Record - converting to doc
//echo(2217);
//print_r($docdata['filetype']); die(); 
                    $docdata['filetype'] == 0; // Reset to 0 until file uploaded
                }
            }
//echo(2452);
//print_r($docdata['filetype']); die();            
            // these are not fields in the DB and would cause an 500 error           
            unset($docdata['submit']);
            unset($docdata['csrf_token']);
            unset($docdata['managemode']);
            unset($docdata['description']);            
            unset($docdata['attachingafile']);              
            unset($docdata['ccmp']);
            unset($docdata['staff']); 
/*
echo(2473);
echo('<br>');
print_r($recid);
echo('<br>');
json($docdata); die();
*/            
            $this->model->update($recid, $docdata, 'cms_ccmps_filelibrary_docs');
/*
echo(2222);
print_r("Updated Data Saved!"); die();
print_r($managemode); die();
*/
            // Auditlog
            $type  = 'update';
            $action = 'UpdateDocRec'; 
            $func = 'ccmp-doclib-sumbit-updating';
            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
            $format = 'minitime'; // I added to Timedate.php
            $this->module('timedate');            
            $timestamp = time();
            $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$recid;
            $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
            $str5 = 'Title: '.$docdata['title'];
            $str6 = 'Mode: '.$managemode;
        
            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

    if($docdata['filetype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was updated successfully.');
    }else{
      set_flashdata('The document record was updated successfully.');  
    }
    $_SESSION['flashmsgcolor'] = 1; // green

//echo(2251);
//print_r($managemode ); die();
            switch($managemode) {

             case 'ccmp': // CCMP managing my docs


             break;

             case 'dmssublibadminupdate': // CA managing subentity docs

                 $managemode = 'dmssublibadmin';


             break;

             case 'dmslibadminupdate': // CM managing all docs

                   $managemode = 'dmslibadmin';

             break;

           default:
 
        // Auditlog
        $type  = 'update';
        $action = 'No managemode'; 
        $func = 'ccmp-doclib-submit-update';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 2296: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

           }
         redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/'.$managemode); // show the updated record 

        }else{ // Passed Adding - only one place you add from and thats manage
        
            // Show new record after adding            
            $docdata = $_POST; // already did the validations so its good to go
//echo(2320);
//json( $docdata ); die();
//
            // translate to fields in the DB

            $docdata['shortdescription'] = $docdata['description'];
            $docdata['rectype']          = $docdata['attachingafile'];
            $docdata['ccmp_id']          = $docdata['ccmp'];
            $docdata['tg_user_id']       = $docdata['staff'];

            // these are not fields in the DB and would cause an 500 error           
            unset($docdata['submit']);
            unset($docdata['managemode']);
            unset($docdata['description']);            
            unset($docdata['attachingafile']);              
            unset($docdata['ccmp']);
            unset($docdata['staff']);               
           
/*
echo(2294);
echo "<br>";
json($docdata); die();
*/
            
// dont let subentity admin or ccmp change the subentity - only the content manager
// the subentity dropdown is disable for adding - need to assign subentity
//    if($_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'momadsc'){ 
            
/*            
    if($managemode == 'dmslibadmincreate' || $managemode == 'dmssublibadmincreate'){ 

        $usrobj = $this->model->get_one_where('trongate_user_id', $_SESSION['tg_user_id'],'ccmps');
        $chptnum = $usrobj->subentity;
        $docdata['subentity']  = $chptnum; // this is where it is assigned when adding
        $docdata['location'] = $chptnum; ; 

     }else{ // ccmadsc
        $docdata['subentity']  = $_POST['subentity'];
        $docdata['location'] = $_POST['subentity']; 
     }

    // Initialize Defaults redundant ???
    $docdata['active'] = 1;
    $docdata['approved'] = 1;      
    $docdata['ccmp_id']    = $_SESSION['ccmp_rec_id'];
*/
    // If it is a DB only record user will not be uploading a file to populate the filetype field
    // So if the posted rectype = 1 the initialize with a filetype of 1 DB Record (no file)
            
    // no rectype or filetype posted
  //  if( $docdata['rectype'] == 1){ // DB Record
  //      $docdata['filetype'] = 1; // DB Record
  //  }
    
    // Other initializations not editable by the user
    $docdata['downloads'] = 0; 
    $docdata['previews'] = 0;     
    $docdata['featured'] = 0; 
    $docdata['scope'] = 0;
    $docdata['affiliate'] = 0;
    
    // Add timestamps
    $docdata['updated_at'] = TIME();
    $docdata['created_at'] = TIME(); 
    $docdata['created_by'] =  $_SESSION['tg_user_id'];     

/*    
echo('2340 about to insert a new doc record: ');
echo "<br>";
json($docdata); die();
*/
    //insert the new document record            
    $this->model->insert($docdata, 'cms_ccmps_filelibrary_docs');
 //echo('Line 2369 - New doc record added!'); die(); 
 
/* This was when save filetype first (DB or filetype. Now saving rectype first (DB or file)
   if($docdata['filetype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');  
    }
    */

    if($docdata['rectype'] > 1){ // 1 = database where there is no physical file
      set_flashdata('The document record was successfully created. Please upload the file.');
    }else{
      set_flashdata('The document record was successfully created. DB entry so no file upload required.');  
    }   
    $_SESSION['flashmsgcolor'] = 1; //  set flash message to green

// get the new record's id so can view 
// OR when need to add to other tables with this foreign key
    $newid = $this->model->get_max('cms_ccmps_filelibrary_docs');

    // Auditlog
    $type  = 'insert';
    $action = 'CreateDocRec';
    $func = 'ccmp-doclib-sumbit-adding';
    $un   = 'TGuid: '.$_SESSION['tg_user_id']; //$un   = 'UN: '.$_SESSION['ccmp_username'];
    $format = 'minitime'; // I added to Timedate.php
    $this->module('timedate');            
    $timestamp = time();
    $time   = $this->timedate->get_nice_date($timestamp, $format);
    $time = $time.' UTC';
    $str3 = 'Rec: '.$newid;
    $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
    $str5 = 'Title: '.$docdata['title'];
    $str6 = 'Mode: '.$managemode;
            
    $this->module('system-auditlogger');
    $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

/*
echo('2409 $managemode');
echo "<br>";
print_r($managemode); die();
*/
    switch($managemode) { // return to the normal state which by default is viewing

      case 'dmslibccmp': // ccmp updating from manage page
                // regular ccmp w/o admin rights cannot update document records
      break;

      case 'dmslibadmincreate': // content manager creating any Doc from manage page

            $managemode = 'dmslibadmin';      

      break;

      case 'dmssublibadmincreate': // subentity admin creating a subentity Doc from manage page

            $managemode = 'dmssublibadmin';      

      break;

      default;

        // Auditlog
        $type  = 'createrec';
        $action = 'No managemode'; 
        $func = 'docrecord-create';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$newid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 2452: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

    }
        redirect('cms-ccmpslibrary/viewdocrec/'.$newid.'/'.$managemode); // show the new record 
    
      } // end passed validation updating or adding

// echo('1063 passed all validations and added or updated a record'); die();

  }else{  // failed a validation
 
// echo('1067 Failed validation either updating or adding '); die();
 
// print_r($recid); die();
      if($recid > 0){ // failed updating
     
// echo('1072 Failed validation updating'); die();
// print_r($docdata); die();
          
        $this->update('yes');

      }else{ // failed adding

// echo('1079 Failed validation adding');
// print_r($docdata); die();

        $this->create('yes');

      } // failed adding or updating

  } // end passed or failed validation

// Successful save happened by line 

} // end function

/*----------------------------------------------------------------------------*/
/*------------------------ Function Fulldoc -----------------------------*/
/* Populates fulldescription.php view to show the fulldescription field       */
/*----------------------------------------------------------------------------*/

  function fulldoc() { // called ccmphome view <a> tag
  $docfunction = 'fulldoc';
  $authorized = $this->_check_function_permissions($docfunction); 

 $doc_id = segment(3);
// $tgusrid = segment(4);
$_SESSION['tab'] = 0; // doc board section - open collapse when close doc - no doc collapse
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences -----------------*/

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//echo(1114);
//print_r($doc_id); die();
//
// Get record to view
 
    $adobj = $this->model->get_where($doc_id,'cms_ccmps_filelibrary_docs');

    $data['tg_user_id']       = $adobj->tg_user_id; 
    $data['ccmp_id']          = $adobj->ccmp_id;
    $data['downloads']        = $adobj->downloads;
    $data['active']           = $adobj->active;
    $data['approved']         = $adobj->approved;
    $data['status']           = $adobj->status;
    $data['doctag']           = $adobj->doctag;
    $data['doctype']          = $adobj->doctype;
    $data['filetype']         = $adobj->filetype; 
    $data['filemime']         = $adobj->filemime;     
    $data['featured']         = $adobj->featured;                               
    $data['scope']            = $adobj->scope;
    $data['access']           = $adobj->access;
    $data['subentity']        = $adobj->subentity;
    $data['affiliate']        = $adobj->affiliate;
    $data['title']            = $adobj->title;  
    $data['author']           = $adobj->author;  
    $data['shortdescription'] = $adobj->shortdescription;  
    $data['fulldescription']  = $adobj->fulldescription;
    $data['notes']            = $adobj->notes;  
    $data['filename']         = $adobj->filename;
    $data['filesize']         = $adobj->filesize;
    $data['filedate']         = $adobj->filedate; 
    $data['location']         = $adobj->location;  
    $data['orglogo']          = $adobj->orglogo;  
    $data['smallimage']       = $adobj->smallimage;  
    $data['largeimage']       = $adobj->largeimage;  
    $data['extlink']          = $adobj->extlink;
    $data['uploaded_at']      = $adobj->uploaded_at;
    $data['uploaded_by']      = $adobj->uploaded_by;    
    $data['created_at']       = $adobj->created_at; 
    $data['created_by']       = $adobj->created_by; 
    $data['updated_at']       = $adobj->updated_at;
    $data['updated_by']       = $adobj->updated_by;

    $data['lead']             = $adobj->assignedto;
    $data['assigndate']       = $adobj->assigned;
    $data['duedate']          = $adobj->duedate;
    $data['eststartdate']     = $adobj->eststart;
    $data['startdate']        = $adobj->actualstart;
    $data['estenddate']       = $adobj->estend;
    $data['enddate']          = $adobj->actualend;
    $data['submitted']        = $adobj->submitted;     
    
    $data['onhold']           = $adobj->onhold;
    $data['holdreason']       = $adobj->holdreason;
    $data['blocked']          = $adobj->blocked;
    $data['blocker']          = $adobj->blocker;

    $data['rejected']         = $adobj->rejected;
    $data['rejectreason']     = $adobj->rejectreason;
    
    $tgusrid                  = $adobj->tg_user_id;

  // Translate codes
      $tgusrid   = $adobj->tg_user_id;
      // Check the ccmp 
      $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid, 'ccmps');
      $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

      $this->module('timedate');
      $format = 'datepicker_us';
      $data['created_at']  = $this->timedate->get_nice_date($data
              ['created_at'], $format);
      $data['updated_at']  = $this->timedate->get_nice_date($data
              ['updated_at'], $format);
 //print_r($data['created_at']); die();     
      $data['bc1'] = 'DMS';
      $data['bc2'] = 'View Document';

      $data['view_module']      = 'cms/ccmpslibrary';
      $data['view_file']        = 'fulldescription'; 

//echo(1152);
//print_r($data); die();
      
        $this->templates->inspinia($data);

  }
  
/*----------------------------------------------------------------------------*/
/*------------------------------- End fullDoc ---------------------------*/
/*----------------------------------------------------------------------------*/

  /*----------------------------------------------------------------------------*/
/*------------------------ Function Fulldescription --------------------------*/
/* Populates fulldescription.php view to show the fulldescription field       */
/*----------------------------------------------------------------------------*/

  function fulldescription() { // called ccmphome view <a> tag
 // $bbfunction = 'fulldescription';
 // $authorized = $this->_check_function_permissions($bbfunction); 

 $rec_id = segment(3);
 $data['frompage']  = segment(4); // came from either manage (m) or view (v) pageso return there in back button

 $_SESSION['tab'] = 3; // bulletin board section - open collapse when close bulletin
//print_r($_SESSION['tab']); die();
//
/*------------------ Get logged in user's info & preferences -----------------*/

  // Get font size preference for views & manage page  
  $this->_get_font_sizes();
  
//echo(1114);
//print_r($bulletin_id); die();
//
  // Get record to view
  $adobj = $this->model->get_where($rec_id,'cms_ccmps_filelibrary_docs');

  // assign values to the data array and pass to fulldescription view page
  
    $data['id']               = $adobj->id;
    $data['tg_user_id']       = $adobj->tg_user_id; 
    $data['ccmp_id']          = $adobj->ccmp_id;
    $data['downloads']        = $adobj->downloads;
    $data['active']           = $adobj->active;
    $data['approved']         = $adobj->approved;
    $data['rectype']          = $adobj->rectype;
    $data['doctag']           = $adobj->doctag;
    $data['doctype']          = $adobj->doctype;
    $data['filetype']         = $adobj->filetype;
    $data['filemime']         = $adobj->filemime;     
    $data['featured']         = $adobj->featured;                               
    $data['scope']            = $adobj->scope;
    $data['access']           = $adobj->access;    
    $data['subentity']        = $adobj->subentity;
    $data['affiliate']        = $adobj->affiliate;
    $data['title']            = $adobj->title;  
    $data['author']           = $adobj->author;  
    $data['shortdescription'] = $adobj->shortdescription;  
    $data['fulldescription']  = $adobj->fulldescription; 
    $data['notes']            = $adobj->notes;  
    $data['filename']         = $adobj->filename;
    $data['filesize']         = $adobj->filesize;
    $data['filedate']         = $adobj->filedate;     
    $data['location']         = $adobj->location;  
    $data['orglogo']          = $adobj->orglogo;  
    $data['smallimage']       = $adobj->smallimage;  
    $data['largeimage']       = $adobj->largeimage;  
    $data['extlink']          = $adobj->extlink; 
    $data['uploaded_at']      = $adobj->uploaded_at;
    $data['uploaded_by']      = $adobj->uploaded_by;   
    $data['created_at']       = $adobj->created_at; 
    $data['created_by']       = $adobj->created_by; 
    $data['updated_at']       = $adobj->updated_at;
    $data['updated_by']       = $adobj->updated_by;

    $data['lead']             = $adobj->assignedto;
    $data['assigndate']       = $adobj->assigned;
    $data['duedate']          = $adobj->duedate;
    $data['eststartdate']     = $adobj->eststart;
    $data['startdate']        = $adobj->actualstart;
    $data['estenddate']       = $adobj->estend;
    $data['enddate']          = $adobj->actualend;
    $data['submitted']        = $adobj->submitted;     
    
    $data['onhold']           = $adobj->onhold;
    $data['holdreason']       = $adobj->holdreason;
    $data['blocked']          = $adobj->blocked;
    $data['blocker']          = $adobj->blocker;
    
    $data['rejected']         = $adobj->rejected;
    $data['rejectreason']     = $adobj->rejectreason;
    
    $_SESSION['oldfilename']  = $adobj->filename; 

  $tgusrid        = $adobj->tg_user_id; 
  $poster_obj     = $this->model->get_one_where('trongate_user_id', $tgusrid,
          'ccmps');
  $data['poster'] =  $poster_obj->first_name.' '.$poster_obj->last_name;

/*--------------------- Convert to User Friendly Values ----------------------*/
  
  $data['created_at']       = $adobj->created_at;
  $data['updated_at']       = $adobj->updated_at;
  $data['uploaded_at']      = $adobj->uploaded_at; 
      
  $this->module('timedate');
  $format = 'datepicker_us';
  $data['created_at']  = $this->timedate->get_nice_date($data['created_at'],
          $format);
  $data['updated_at']  = $this->timedate->get_nice_date($data['updated_at'],
          $format);
  $data['uploaded_at']  = $this->timedate->get_nice_date($data['uploaded_at'],
          $format);
/*--------------------- Set Navbar & Header Information ----------------------*/
//echo(113);
//print_r($_SESSION['ccmpmode']); die(); // dmslibadminv
 switch($_SESSION['ccmpmode']) {

  case 'ccmp': // Refresh page while viewing

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View DB Record';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
 //       $data['subentitynm']    = $subentity_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;
    
  break;

  case 'ccmpv': // Refresh page while viewing

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['salutation']   = $ccmp_obj->salutation;
        $data['first_name']   = $ccmp_obj->first_name;
        $data['middle_name']  = $ccmp_obj->middle_name;
        $data['last_name']    = $ccmp_obj->last_name;
        $data['suffix']       = $ccmp_obj->suffix;
 //       $data['subentitynm']    = $subentity_name;
        $data['header']       = $adobj->title;
      //  $data['subheader']    = $adobj->title;
     
  break;

  case 'momads': // subentity admin refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A DB Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Chapter Admin'; 
        
  break;

  case 'momadsv': // subentity admin refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Chapter Admin'; 
        
  break;

  case 'dmslibadmin': // content manager refreshes page during view

        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A DB Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager';

        
  break;

  case 'dmslibadminv': // content manager refreshes page during view
//echo(828); die();      
        $_SESSION['ccmpmode']   = 'dmslibadminv'; // manage all  viewing 
        $data['bc1']          = 'DMS';
        $data['bc2']          = 'View A Document Record';
        $data['header']       = $adobj->title;
        $data['subheader']    = 'Content Manager';

        
  break;

  default;

        // Auditlog
        $type  = 'viewfulldesc';
        $action = 'No ccmpmode'; 
        $func = 'docrecord-view';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 2692: No matching ccmpmode. Contact the System Administrator 202-207-5353. Use the back button."); die();

}

      $data['view_module']      = 'cms/ccmpslibrary';
      $data['view_file']        = 'fulldescription'; 

//echo(180);
//print_r($data); die();

        $this->templates->inspinia($data);
     // $this->view('layout', $data);

  }
  
/*----------------------------------------------------------------------------*/
/*------------------------------- End fulldescription ------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*------------------------------- Function Bulkaction ------------------------*/
/*----------------------------------------------------------------------------*/

  function bulkaction() {

echo "CMS-library-bulkaction()...Call System Admin on 202-207-5353...Use Back button"; die();

  $libraryfunction = 'bulkaction';
  $authorized = $this->_check_function_permissions($libraryfunction); 

   //     print_r($_SESSION); die();
        
//echo(24);
//print_r($_POST); // array of ids called id
    
//print_r($_POST['selected']); die(); // the dropdown item id - for option button <not <li><a>
          
        $data = $_POST; // array of record ids called id & the dropdown item id
        
        switch ($_POST['selected']){ // the option number chosen from the dropdown
          case '1': // default blank no action
 
        break;
               
         case '2':        
                if(!isset($data)){
                   die('2Nothing Checked');
                }else{
  print_r($data); die('Approve Docs');
                }       
               
        break;
        
         case '3': 
                if(!isset($data)){
                   die('3Nothing Checked');
                }else{
  print_r($data); die('Disapprove Docs');
                }                    
        break;

        
         case '4':        
                if(!isset($data)){
                   die('4Nothing Checked');
                }else{
  print_r($data); die('Hide Docs');
                }       
               
        break;
        
         case '5': 
                if(!isset($data)){
                   die('5Nothing Checked');
                }else{
  print_r($data); die('Unhide Docs');
                }                    
        break;
        
         case '6':           
                if(!isset($data)){
                   die('6Nothing Checked');
                }else{
 //  print_r($data);                 
//  print_r($data['id']) ; die('Delete');                  
                    foreach($data['id'] as $row){
 //print_r($row); die();
                       if(strlen($row) >0){ // if passed from bulk action update
                            $delid           = $row; // got the row number
                           
//print_r($delid );  
                            // Need to grab title before delete for the log
                            $adobj = $this->model->get_where($delid,'cms_ccmps_filelibrary_docs');
                            $title = $adobj->title;
                           // print_r($title); die();
                              
                            // Hard delete
                            $this->model->delete($delid, 'cms_ccmps_filelibrary_docs');
//echo('Deleted!'); die();

                            // Auditlog
                            $type  = 'bulkdelete';
                            $action = 'HardDeleteDoc';
                            $func = 'docs-bulkaction-case 6';
                            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
                            $format = 'minitime'; // I added to Timedate.php
                            $this->module('timedate');            
                            $timestamp = time();
                            $time   = $this->timedate->get_nice_date($timestamp, $format);
                            $time = $time.' UTC';
                            $str3 = 'Rec: '.$delid;
                            $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
                            $str5 = 'Title: '.$title;
                            $str6 = 'Mode: '.$managemode;
        
                            $this->module('system-auditlogger');
                            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);                            
                            
                            //print_r('deleted all'); die(); 
                        }else{
                            echo('Line 117 library.php - row IS BLANK'); die();
                        }                 
                    } // end foreach
                } 
       
        break;
        
         case '7':
                if(!isset($data)){
                   die('7Nothing Checked');
                }else{
  print_r($data); die('Archive');
                }       
               
        break;
        
        }
    //    echo('109');
    //    print_r($_SESSION['ccmpmode']); die();
        
        switch($_SESSION['ccmpmode']) {

          case 'ccmp': //  Chapter Admin managing your subentity docs
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;

          case 'momads': //  Chapter Admin managing your subentity docs
                redirect('cms-ccmpslibrary/manage/momads');

          break;

          case 'dmslibadmin': // Content Mgr managing all records
                redirect('cms-ccmpslibrary/manage/dmslibadmin');

          break;

        }        

  }
  
/*----------------------------------------------------------------------------*/
/*--------------------------- SUPPORTING FUNCTIONS ---------------------------*/
/*----------------------------------------------------------------------------*/  
  
    function _populate_dropdowns() { 
       
    $data['bulk_actions'] = $this->model->get('id','cms_ccmps_filelibrary_bulk_actions');

// Filtered dropdowns for searching   
    
 // doctags1
    $sqldt1 = 'SELECT * FROM cms_ccmps_filelibrary_doctags1 WHERE id IN (SELECT DISTINCT doctag1 FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtdoctags1'] = $this->model->query($sqldt1,'object'); 
    
  //doctags2
    $sqldt2 = 'SELECT * FROM cms_ccmps_filelibrary_doctags2 WHERE id IN (SELECT DISTINCT doctag2 FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtdoctags2'] = $this->model->query($sqldt2,'object');     
    
  //doctags3
    $sqldt3 = 'SELECT * FROM cms_ccmps_filelibrary_doctags3 WHERE id IN (SELECT DISTINCT doctag3 FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtdoctags3'] = $this->model->query($sqldt3,'object');    
    
    // file types
    $sqlft = 'SELECT * FROM cms_ccmps_filelibrary_filetypes WHERE id IN (SELECT DISTINCT filetype FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtfiletypes'] = $this->model->query($sqlft,'object'); 
    
     // access dropdown
    $sqlaccess = 'SELECT * FROM cms_ccmps_filelibrary_access WHERE id IN (SELECT DISTINCT access FROM cms_ccmps_filelibrary_docs)';
    $data['filtdoclib_access'] = $this->model->query($sqlaccess,'object'); 
    
    // subentitys dropdown 
    $sqlsubs = 'SELECT * FROM ccmps_subentities WHERE id IN (SELECT DISTINCT subentity FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtsubentities'] = $this->model->query($sqlsubs,'object');   

    // regions dropdown
    $sqlregions = 'SELECT * FROM ref_region_codes WHERE id IN (SELECT DISTINCT region FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtregions'] = $this->model->query($sqlregions,'object');  
           
    // uploaders
    $sqlupld = 'SELECT trongate_user_id, first_name, last_name FROM ccmps WHERE trongate_user_id IN (SELECT DISTINCT uploaded_by FROM cms_ccmps_filelibrary_docs) ORDER BY last_name';
    $data['filtuploaders'] = $this->model->query($sqlupld,'object');
    //   json( $data['filtuploaders'] ); die(); 

    // ccmps
    $sqlccmps = 'SELECT id, first_name, last_name FROM ccmps WHERE id IN (SELECT DISTINCT ccmp_id FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtccmps'] = $this->model->query($sqlccmps,'object');
    //   json( $data['filtccmps'] ); die();

    // staff
    $sqlstaffs = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts WHERE trongate_user_id IN (SELECT DISTINCT tg_user_id FROM cms_ccmps_filelibrary_docs) ORDER BY last_name';
    $data['filtstaffs'] = $this->model->query($sqlstaffs,'object');
    //   json( $data['filtstaffs'] ); die(); 

     // status
    $sqlfiltstatus = 'SELECT * FROM cms_ccmps_filelibrary_status WHERE id IN (SELECT DISTINCT status FROM cms_ccmps_filelibrary_docs) ORDER BY title';
    $data['filtstatuses'] = $this->model->query($sqlfiltstatus,'object'); 
    
// unfiltered dropdowns for editing and creating
 // status
    $sqlstatus = 'SELECT * FROM cms_ccmps_filelibrary_status ORDER BY id DESC';
    $data['statuses'] = $this->model->query($sqlstatus,'object'); 

 // doctags1
    $sqldt1 = 'SELECT * FROM cms_ccmps_filelibrary_doctags1 ORDER BY description';
    $data['doctags1'] = $this->model->query($sqldt1,'object'); 
    
  //doctags2
    $sqldt2 = 'SELECT * FROM cms_ccmps_filelibrary_doctags2 ORDER BY title';
    $data['doctags2'] = $this->model->query($sqldt2,'object');     
    
  //doctags3
    $sqldt3 = 'SELECT * FROM cms_ccmps_filelibrary_doctags3 ORDER BY title';
    $data['doctags3'] = $this->model->query($sqldt3,'object');    
    
    // file types
    $sqlft = 'SELECT * FROM cms_ccmps_filelibrary_filetypes ORDER BY title';
    $data['filetypes'] = $this->model->query($sqlft,'object'); 
    
     // access dropdown
    $sqlaccess = 'SELECT * FROM cms_ccmps_filelibrary_access ORDER BY level';
    $data['ccmps_doclib_access'] = $this->model->query($sqlaccess,'object'); 
 //json($data['ccmps_doclib_access']); die();   
 
    // subentitys dropdown 
    $sqlsubs = 'SELECT * FROM ccmps_subentities ORDER BY title';
    $data['subentities'] = $this->model->query($sqlsubs,'object');   
// json($data['subentities']); die();

    // regions dropdown
    $sqlregions = 'SELECT * FROM ref_region_codes ORDER BY title';
    $data['regions'] = $this->model->query($sqlregions,'object');  
//json($data['regions'] ); die(); 

    // uploaders
    $sqlupld = 'SELECT trongate_user_id, first_name, last_name FROM ccmps ORDER BY last_name';
    $data['uploaders'] = $this->model->query($sqlupld,'object');
//json($data['uploaders'] ); die(); 

    // ccmps
    $sqlccmps = 'SELECT id, first_name, last_name FROM ccmps ORDER BY last_name';
    $data['ccmps'] = $this->model->query($sqlccmps,'object');
 //json( $data['ccmps'] ); die();

    // staff
//    $sqlstaffs = 'SELECT trongate_user_id, first_name, last_name FROM honcho_user_accounts';
    
    $sqlstaffs = 'SELECT id, first_name, last_name FROM honcho_user_accounts ORDER BY last_name';
    $data['staffs'] = $this->model->query($sqlstaffs,'object');
    unset($data['staffs'][0]);
//    json($data['staffs']); die(); 
   
    return $data;
    
    }
    
    
    function _get_a_single_record($recid, $managemode = NULL) {  //called from line xxx when viewing
    // protected - private function
    // & line xxx when updating and xxx for my data

//print_r($recid); die();
    // Get an object of the record data to be shown

        $addata = $this->model->get_where($recid,'cms_ccmps_filelibrary_docs');

//print_r($addata); die();

/*--------- View - Convert Updated By & Created By to a Name -----------*/

        $updated_by = $addata->updated_by;
//echo('Line 1181');
//print_r($updated_by); die();

        $created_by = $addata->created_by;
//print_r($created_by); die(); 
        // raw are the codes
        $updated_by_raw = $addata->updated_by;
        $created_by_raw = $ccmpdata->created_by;

        // get tg user id, use trongate_users tbl to get acct_table, get name
        
        
        // updater could be the ccmp himself updated_by is their trongate userid
        $tguserobj2 = $this->model->get_one_where
        ('trongate_user_id', $updated_by, 'ccmps');
      //  echo('1193 $tguserobj2');
     //   print_r($tguserobj2); die();
// if null then updater must be a system account

        $updated_by_first = $tguserobj2->first_name;
        $updated_by_last  = $tguserobj2->last_name;

        $tguserobj3 = $this->model->get_one_where
        ('trongate_user_id', $created_by, 'ccmps');

        $created_by_first = $tguserobj3->first_name;
        $created_by_last  = $tguserobj3->last_name;
      //  json($addata); die();
//print_r($addata->lead); die();

    $tgusrid = $addata->lead;
    if($tgusrid > 0){
    $tgusrobj4  = $this->model->get_where( $tgusrid,'trongate_users'); 
    $user_acct_table = $tgusrobj4->login_acct_info_table;

    $lead_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
    
       $addata->lead =  $lead_obj->first_name.' '.$lead_obj->last_name;
    }else{
       $addata->lead = 'Unassigned';  
    }
       
        // if not a real record pass thru updated_by & created_by as the NULL
        //  that it is so wont show up in data-present only tabular reports
        // otherwise you are passing spaces and it will come thru as not null
        //  and not empty and isset = true
        
        if(strlen($updated_by_first) >0){
            $updatedby        = $updated_by_first.' '.$updated_by_last;
        }
        if(strlen($created_by_first) >0){
          $createdby        = $created_by_first.' '.$created_by_last;
        }

//echo "line 1219";
//print_r($createdby); die();

/*------------ View - Convert Codes & Convert Dates to Nice Dates ------------*/
//echo(3386); die();
        // Get dates

        
        $updated_at   = $addata->updated_at;
        $created_at   = $addata->created_at;
        
        $startdate    = $addata->startdate;
        $enddate      = $addata->enddate;
        $assigndate   = $addata->assigndate;
        $duedate      = $addata->duedate;
        $eststartdate = $addata->eststartdate;
        $estenddate   = $addata->estenddate;
        $submitted    = $addata->submitted;   

    
//print_r($created_at); die();
        // Same as above but wont be translated for a raw tabular report

        $date_created_raw = $addata->date_created;
        $updated_at_raw   = $addata->updated_at;
        $created_at_raw   = $addata->created_at;

        // NULL date fields that do get_nice_date return not_NULL and ISSET to be true and show 01/01/1970
        if($managemode == 'dmslibadminupdate'){
        $format = 'datepicker'; //full, cool,shorter,mini, oldschool,datepicker_us,monyear
        }else{
         $format = 'datepicker_us';   
        }
        $this->module('timedate');

        $startdate   = $this->timedate->get_nice_date($startdate, $format);
        $enddate     = $this->timedate->get_nice_date($enddate, $format);
        $assigndate  = $this->timedate->get_nice_date($assigndate, $format);
        $duedate     = $this->timedate->get_nice_date($duedate, $format);
        $eststartdate    = $this->timedate->get_nice_date($eststartdate, $format);
        $estenddate      = $this->timedate->get_nice_date($estenddate, $format);
        $submitted   = $this->timedate->get_nice_date($submitted, $format);
        
        $created_at = $this->timedate->get_nice_date($created_at, $format);
        $updatedat     = $this->timedate->get_nice_date($updated_at, $format);
        $createdat     = $created_at;
        $tokenexpires  = $this->timedate->get_nice_date($tokenexpires, $format);
//print_r($createdat); die();

/*------ View - Add Converted Codes &  Nice Dates to the Array ----------*/

        
        // convert the object to an array to add additional data for the view 
        $addata = (array)$addata;

        $addata['assigndate']     = $assigndate;
        $addata['duedate']        = $duedate;
        $addata['eststartdate']   = $eststartdate;
        $addata['startdate']      = $startdate;
        $addata['estenddate']     = $estenddate;
        $addata['enddate']        = $enddate;
        $addata['submitted']      = $submitted;   
    
       // Translated Codes 
       $addata['updated_by']      = $updatedby;

//print_r($ccmpdata['updated_by'] ); die();
       $addata['created_by']      = $createdby;

       // Translated Dates

       $addata['updated_at']      = $updatedat;
       $addata['created_at']      = $createdat;

       $addata['updated_by']      = $_SESSION['tg_user_id'];
//print_r($addata['updated_by']); die();
        if($addata['updated_at'] == '01/01/1970'){

          $addata['updated_at'] = 0; // before was ' '; i guess for display
        }else{
          // Do nothing
        }

        if($addata['created_at'] == '01/01/1970'){

          $addata['created_at'] = 0;
        }else{
          // Do nothing
        }
        
      $data = $addata;


//echo('Line 3483'); 
//json($data); die();
      
  
      return $data; // returns to 555 when editing and other placed when viewing
    }
 
    
    
    function xclearfilters(){
        $sql = "SELECT * FROM cms_ccmps_filelibrary_docs WHERE active = 1 AND approved = 1 AND filename != 'NULL' OR active = 1 AND approved = 1 AND filetype = 1"; 
        $data['rows'] = $this->model->query($sql,'object');

 foreach($data['rows'] as $row) { 

    $tagobj1 = $this->model->get_where($row->doctag1, 'cms_ccmps_filelibrary_doctags1');
    $row->doctag1 = $tagobj1->title;

    if(strlen($row->doctag1) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags1
//echo(349); die();
        $row->doctag1 = '';
    }

    $tagobj2 = $this->model->get_where($row->doctag2, 'cms_ccmps_filelibrary_doctags2');
    $row->doctag2 = $tagobj2->title;

    if(strlen($row->doctag2) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags2
//echo(349); die();
        $row->doctag2 = '';
    }

    $tagobj3 = $this->model->get_where($row->doctag3, 'cms_ccmps_filelibrary_doctags3');
    $row->doctag3 = $tagobj3->title;

    if(strlen($row->doctag3) < 1){ // happens if default 0 is used and nothing returned from cms_ccmps_filelibrary_doctags3
//echo(349); die();
        $row->doctag3 = '';
    }

    $ftypeobj = $this->model->get_where($row->filetype, 'cms_ccmps_filelibrary_filetypes');
    $row->filetypetitle = $ftypeobj->title;

    if(strlen($row->filetypetitle) < 1){ 
//echo(349); die();
        $row->filetypetitle = 'Missing';
    }

    if(strlen($row->filename) < 1){ 

        if($row->filetype < 2){ // 1 or less
            $row->filename = 'NA';
        }else{
            $row->filename = 'File Missing';
        }

    }

}

//echo(2495);
//json($data['rows']); die(); // checkpoint - user friendly values

/*------------------------------------------------------------------------------------------*/    

    // step through the array of records and pull out needed values for view pg
    foreach($data['rows'] as $row) {  

    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.
            
    $tgusrid   = $row->tg_user_id;
//print_r($tgusrid ); die();  
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); 
    $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table); die();     
//print_r($tgusrobj); die();           
    // Get the poster's name for each record 
    $poster_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
// echo(742);   
//print_r($poster_obj); die(); // ok
    $row->poster =  $poster_obj->first_name.' '.$poster_obj->last_name;

/*----------- Change values to display descriptions instead of code ----------*/

    $scopeobj   = $this->model->get_where($row->scope,'cms_ccmps_filelibrary_scopes');             
    $row->scope = $scopeobj->title;
 
    $accessobj   = $this->model->get_where($row->access,'cms_ccmps_filelibrary_access');             
    $row->access = $accessobj->title;
  
    
   // unset($data['bulk_actions'][0]); // NA - used with std HTML dropdown with submit button
  
    $subentityrole = $row->subentity_role;
    $subentityobj = $this->model->get_where($subentityrole,'ccmps_subentity_offices');
    $row->subentity_role = $subentityobj->description;
 
    $subentityid    = $row->subentity;
    $subentityobj   = $this->model->get_where($subentityid,'ccmps_subentities');
    $row->subentity = $subentityobj->description;

    $this->module('timedate');
    $format = 'datepicker_us';
    $row->updated_at= $this->timedate->get_nice_date($row->updated_at, $format);
    $row->created_at= $this->timedate->get_nice_date($row->created_at, $format);

    if($row->updated_at == '01/01/1970'){
      $row->updated_at = ' ';
    }

    } // end foreach

/*
echo(482);
json($data['rows']); die(); // checkpoint - descriptions in place of codes
*/    
    /*----------- Add $data array elements for manage view -----------------*/
    
    $data['logged_in']     = $_SESSION['logged_in'];
    $data['home_page']      = 0;

    $data['content_name']   = SITENAME;  
//  $data['subentity_name']  = $subentity_name; // do anything with this ???

    $data['view_module']   = 'cms/ccmpslibrary';
    $data['view_file']     = 'manage'; // 

    $data['manageview']     = $manageview;
/* 
    echo(505);
    echo('<br>'); 
    print_r($_SESSION['ccmpmode'] );
    echo('<br>'); 
    json($_SESSION); die();
*/    
    
    switch($_SESSION['ccmpmode']) { 

    case 'ccmp': // managing your own ads/docs

          $data['bc1']          = 'DMS';
     //     $data['bc2']          = 'Manage My Documents'; not allowing ccmps to have own docs
          $data['bc2']          = 'Document Library';
          $data['salutation']   = $ccmp_obj->salutation;
          $data['first_name']   = $ccmp_obj->first_name;
          $data['middle_name']  = $ccmp_obj->middle_name;
          $data['last_name']    = $ccmp_obj->last_name;
          $data['suffix']       = $ccmp_obj->suffix;
        //  $data['header']       = 'Manage My Documents';
          $data['header']          = 'Document Library';

    break;

    case 'momads': // subentity admin

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'Chapter Documents';
          $data['activity']    = $_SESSION['subentity_name'];
          $data['header']      = 'Manage Chapter Documents';
    break;

    case 'dmslibadmin': // content manager

          $data['bc1']         = 'DMS';
          $data['bc2']         = 'All Document Records';
          $data['activity']    = 'Content Manager';
          $data['header']      = 'Manage All Documents';
          
    break;

    }

/*    
  echo(2625); 
  json($data); die(); // checkpoint
*/  
        $this->templates->inspinia($data);
        
        
    }
    
    function approvedoc() { // vs. approving a record which is the approved field
  $docfunction = 'approvedoc';
//  $authorized = $this->_check_function_permissions($docfunction); 

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.
//print_r( $managemode); die();

        $data['status']   = 1; // approved
        $data['blocked']  = 0;
        $data['onhold']   = 0;
        $data['rejected'] = 0;
                
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1321);
       // print_r($_SESSION['ccmpmode']); die();
       
        // Auditlog
        $type  = 'update';
        $action = 'ApproveDoc';
        $func = 'docs-approverecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }
              
          break;

      default;

        // Auditlog
        $type  = 'approvedoc';
        $action = 'No managemode'; 
        $func = 'doc-approvedoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3814: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }

    }

       function approverecord() { // vs. approving a doc. This is the approved field
  $docfunction = 'approverecord';
//  $authorized = $this->_check_function_permissions($docfunction); 

        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.
//print_r( $managemode); die();

        $data['approved'] = 1;
        
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1321);
       // print_r($_SESSION['ccmpmode']); die();
       
        // Auditlog
        $type  = 'update';
        $action = 'ApproveDocRecord';
        $func = 'docs-approverecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }
              
          break;

      default;

        // Auditlog
        $type  = 'approvedocrecord';
        $action = 'No managemode'; 
        $func = 'doc-approverecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3900: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }

    }
    
  function modalrejectdoc() {
  $docfunction = 'modalrejectdocument';
 // $authorized = $this->_check_function_permissions($docfunction);

  if($_POST['RejectBtn'] == "Submit"){ // values from modal form
       $rejectreason = $_POST['rejectreason']; // from manage, view or kanban
      // print_r(strlen($rejectreason)); die();
       $recid = $_POST['recid'];
       $managemode = $_POST['managemode'];
       $frmpg = $_POST['frmpg'];
       $status = $_POST['status'];
    //   echo(3920);
    //   print_r($status); die();       
      // echo(3922);
      // json($_POST); die();      
  }else{ // coming from reject button
       // $recid = segment(3);
       // $managemode = segment(4);
       // $frmpg = segment(5); // from manage, view or kanban
       echo(3925); die(); 
  }
    // Get the table name that contains the poster's credentials from the
    // trongate_users table. The profile information is in the same table.
            
    $tgusrid   = $_SESSION['tg_user_id'];
//print_r($tgusrid ); die();  
    $tgusrobj  = $this->model->get_where($tgusrid,'trongate_users'); 
    $user_acct_table = $tgusrobj->login_acct_info_table;
//print_r($user_acct_table); die();     
//print_r($tgusrobj); die();           
    // Get the rejector's name for each comment
    if($tgusrid > 0){
    $commenter_obj = $this->model->get_one_where('trongate_user_id', $tgusrid,
                $user_acct_table);
     $commenter  =  $commenter_obj->first_name.' '.$commenter_obj->last_name;
    }else{
     $commenter = 'Unk';  
    }
    
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.
$docrecobj = $this->model->get_one_where('id', $recid,'cms_ccmps_filelibrary_docs');
//json($docrecobj); die();
 $data['rejectreason'] = $docrecobj->rejectreason;
 
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
    
        if($status == 2){ // if rejecting from pending approval send back. Reviewers (status 3) dont reject just comment
            $data['rejected'] = 1; // True
            $data['status']   = 4; // In Progress
        }
        
      //  if(strlen($rejectreason) == strlen($data['rejectreason'])){ ??? how to stop submitting no change
            //nothing changed - stop from submitting a blank comment
      //  }else{
        
        if($status == 2){ // if rejecting from pending approval send back. Reviewers (status 3) dont reject just comment
            $data['rejectreason']   =  $rejectreason.'<br> Rejector '.$commenter.' @ '.$time.'<hr><br>'; //         
        }else{
            $data['rejectreason']   =  $rejectreason.'<br> Reviewer '.$commenter.' @ '.$time.'<hr><br>'; //         
        }

        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'RejectDocument';
        $func = 'docs-rejectdoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
       // }
 //print_r($_SESSION['ccmpmode']); die();           
        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
     
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }

          break;

    default;

        // Auditlog
        $type  = 'unapprovedocrec';
        $action = 'No managemode'; 
        $func = 'docrecord-unapprove';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3900: No matching managemode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }

    function inprogress() {
  $docfunction = 'inprogress';
//  $authorized = $this->_check_function_permissions($docfunction);
  
        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        //
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 4;
        
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'InProgress';
        $func = 'docs-inprogress';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die(); 

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
     
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No inprofress'; 
        $func = 'docrecord-inprogress';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3489: No matching manage mode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }

    function inreview() {
  $docfunction = 'inreview';
//  $authorized = $this->_check_function_permissions($docfunction);
  
        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        //
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 3;
        $data['rejected'] = 0;
                
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'InReview';
        $func = 'docs-inreview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die(); 

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
     
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No managemode'; 
        $func = 'docrecord-inreview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3489: No matching manage mode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }

    function pending() {
  $docfunction = 'pending';
//  $authorized = $this->_check_function_permissions($docfunction);
  
        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        //
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 2;
        
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'Pending';
        $func = 'docs-pending';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die(); 

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
     
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No managemode'; 
        $func = 'docrecord-pending';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 4067: No matching manage mode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }

    function backlog() {
  $docfunction = 'backlog';
//  $authorized = $this->_check_function_permissions($docfunction);
  
        $recid = segment(3);
        $managemode = segment(4);
        $frmpg = segment(5); // from manage, view or kanban
        //
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['status']   = 5;
        
        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1353);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'Backlog';
        $func = 'docs-backlog';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

 //print_r($managemode); die(); 

        switch($managemode) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
     
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                if($frmpg == 'k'){ // came from kanban board
                   redirect('cms-ccmpslibrary/kanban/k');
                }elseif ($frmpg == 'v'){
                   redirect('cms-ccmpslibrary/viewdocrec/'.$recid.'/dmslibadmin/k');      
                }else{
                   redirect('cms-ccmpslibrary/manage/dmslibadmin');                    
                }

          break;

    default;

        // Auditlog
        $type  = 'update';
        $action = 'No managemode'; 
        $func = 'docrecord-backlog';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 4154: No matching manage mode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }
    
    function hiderecord() {

    $recid = segment(3);
    $docfunction = 'hiderecord';
    $authorized = $this->_check_function_permissions($docfunction, $recid); 


        // if delete it doesnt matter where you came from you go back to manage
        //because intent at that time is not to see the details.

        $data['active'] = 0;

        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1384);
       // print_r($_SESSION['ccmpmode']); die();
  
        // Auditlog
        $type  = 'update';
        $action = 'HideDoc';
        $func = 'docs-hiderecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
            
        switch($_SESSION['ccmpmode']) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                redirect('cms-ccmpslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'hiderecrec';
        $action = 'No ccmpmode'; 
        $func = 'docrecord-hiderec';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3568: No matching ccmpmode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }
       
    }

    function unhiderecord() {
    $docfunction = 'unhiderecord';
    $authorized = $this->_check_function_permissions($docfunction); 

        $recid = segment(3);
        // if delete it doesnt matter where you came from you go back to manage
        // because intent at that time is not to see the details.

        $data['active'] = 1;

        $this->model->update($recid, $data, 'cms_ccmps_filelibrary_docs');

       // echo(1412);
       // print_r($_SESSION['ccmpmode']); die();

        // Auditlog
        $type  = 'update';
        $action = 'UnhideDoc';
        $func = 'docs-unhiderecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$data['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 
            
        switch($_SESSION['ccmpmode']) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                redirect('cms-ccmpslibrary/manage/dmslibadmin');

          break;

     default;

        // Auditlog
        $type  = 'unhiderec';
        $action = 'No ccmpmode'; 
        $func = 'docrecord-unhidedoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3644: No matching ccmpmode. Contact the System Administrator 202-207-5353. Use the back button."); die();         
        }
       
    }

    
    function delrecord() { 

        $recid = segment(3);
//print_r($recid); die();         
        $docfunction = 'delrecord';
        $authorized = $this->_check_function_permissions($docfunction, $recid);
     
        $docobj        = $this->model->get_one_where('id', $recid, 'cms_ccmps_filelibrary_docs');
        $title         = $docobj->title; // need the name for the auditlog
        $filename      = $docobj->filename;
        $filetype      = $docobj->filetype; // if 1 then no associated file to delete
        $subentfileloc = $docobj->subentity; // all documents are in a subentity file directory
//print_r( $filetype ); die();
if($filetype == 0 || $filetype == 1){ // 0 = File Missing or 1 = DB Record (no file)
    // no file to delete so skip removal step
}else{
        // remove file from disk
        $file_pointer = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filename;
     //   $path = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/';
        if (!unlink($file_pointer)) {
            echo ("Error: 2596 file cannot be deleted. Contact the System Administrator 202-207-5353. Use the back button."); die();
        }else {
         //   echo ("$file_pointer has been deleted"); die();
        }
}
//print_r($title); die();
//print_r($_SESSION['ccmpmode']);die();
    $result = $this->model->delete($recid,'cms_ccmps_filelibrary_docs');
//print_r($result); die();

    //  Auditlog
        $type  = 'delete';
        $action = 'HardDeleteDoc';
        $func = 'docs-delrecord';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$title;
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6); 

// Can delete from Manage or View pages so need both cases for each mode
        switch($_SESSION['ccmpmode']) {

          case 'ccmp': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momads': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadmin': // CM managing all records
                redirect('cms-ccmpslibrary/manage/dmslibadmin');

          break;

          case 'ccmpv': // CCMP managing my records
                redirect('cms-ccmpslibrary/manage/ccmp');

          break;
      
          case 'momadsv': // CA managing our subentity record
                redirect('cms-ccmpslibrary/manage/momads');

          break;
      
          case 'dmslibadminv': // CM managing all records
                redirect('cms-ccmpslibrary/manage/dmslibadmin');

          break;

    default;

        // Auditlog
        $type  = 'unhiderec';
        $action = 'No ccmpmode'; 
        $func = 'docrecord-unhide';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 3751: No matching ccmpmode. Contact the System Administrator 202-207-5353. Use the back button."); die();

        }

}


    function _get_font_sizes() {
    // protected - private function
    // Get ccmp's fontsize preferences for manage page and all other pages
    $ccmp_id                    = $_SESSION['ccmp_rec_id'];
    $ccmp_obj                   = $this->model->get_where($ccmp_id,'ccmps');
    $_SESSION['fontsize']       = $ccmp_obj->fontsize;  // view pages
    $_SESSION['tfontsize']      = $ccmp_obj->tfontsize; // manage page 
    
    
 //  print_r($_SESSION['fontsize']); die();
   
    // default sizes
    
         switch($_SESSION['fontsize']) {

          case '0': // managing my records
                $_SESSION['fontsize'] = 2;
                $_SESSION['fontname'] = 'Medium'; 
          break;
      
          case '1': // managing my records
   
               $_SESSION['fontname']   = 'Large';  
          break;

          case '2': // managing my records
                 $_SESSION['fontname'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['fontname'] = 'Small';
          break;

        }   

   //print_r($_SESSION['dfontsize']); die();
    
          switch($_SESSION['tfontsize']) {

          case '1': // managing my records
                 $_SESSION['tfontsize'] = 'Large';
          break;

          case '2': // managing my records
                 $_SESSION['tfontsize'] = 'Medium';
          break;

          case '3': // managing my records
                 $_SESSION['tfontsize'] = 'Small';
          break;

        }      
    
    return;
    }


    function _check_function_permissions($docfunction) {
//echo(3823);
//print_r($docfunction); die();

// need one for - index,manage,view, update,approverecord,create,delrecord,fulldoc
// hiderecord,submit,unapproverecord,unhiderecord
 
//echo(1844);
//print_r($recid); die();

        switch($docfunction) {

          case 'index': //

                redirect('welcome/logout'); 

          break;

          case 'bulkaction': // filters determine what bulk actions you have access to by role - only need to know logged in.

              if($_SESSION['ccmp_logged_in'] == 1){// 


              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears session variables, flags and settings then redirects to login page

              }
          
          break; 

          case 'manage': //
              if($_SESSION['ccmp_logged_in'] == 1){ // 
                // continue
              }else{ // not logged in at all - send to login form


                redirect('welcome/logout'); // clears everything then takes to login page

              }

          break;

          case 'view': //
   //get login screen if not logged in. However if logged can pass a recid in url and see someone elses

//Only certain roles should be passing other record ids other than their own

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['subentity_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has subentity or member admin rights
            // authorized...continue
           // $data = "goodtogo"; not used
          //  return $data;

          }else{ // not an admin role

         //   As a member you only need to be logged in to see the records - so do nothing

        /*        $recobj = $this->model->get_one_where(id, $recid, cms_ccmps_filelibrary_docs);
                $ownerid = $recobj->ccmp_id;


            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'view';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to view someone elses records'; 
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                redirect('welcome-ccmps/ccmphome');
            }
            */
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }

          break;

          case 'update': //



            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // Here recid is of doc not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['subentity_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has subentity or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mydocs); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['ccmpmode'] == 'ccmp' || $_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'ccmpv'){

                $recobj = $this->model->get_one_where(id, $recid, cms_ccmps_filelibrary_docs);
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'update';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to edit someone elses records'; 
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;          

          case 'create': //

        // Can only create for themselves anyway because a recid is not passed

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form
echo(4887); die();
                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'submit': // 

              if($_SESSION['ccmp_logged_in'] == 1){// 

//echo(2001); die();
              }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page

              }
          
          break;

          case 'fulldoc': //

        // anyone can see

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'approverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of doc not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'unapproverecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of doc not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'hiderecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of doc not person. Need to know it belongs to person
         

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['subentity_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has subentity or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mydocs); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['ccmpmode'] == 'ccmp' || $_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'ccmpv'){

                $recobj = $this->model->get_one_where(id, $recid, cms_ccmps_filelibrary_docs);
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'hiderecord';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to hide someone elses records'; 
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          break;

          case 'unhiderecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // here recid is of doc not person. Need to know it belongs to person
            // get an array all all ids that belong to that user and see if it is in the list    // mark with ??? to do later - ???

        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in



        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;

          case 'delrecord': //


            // If not an admin role above need to check that the $recid you put in the URL is only yours
            // Here recid is of doc not person. Need to know it belongs to person

        //get login screen if not logged in. However if logged can pass a recid in url and see someone elses
        if($_SESSION['ccmp_logged_in'] == 1){// check to see if logged in

          //Only certain roles should be passing other record ids other than their own
          if($_SESSION['content_mgr'] > 0 || $_SESSION['student_admin'] > 0 || $_SESSION['subentity_admin'] > 0 || $_SESSION['member_admin'] > 0 || $_SESSION['system_admin'] > 0){ // has subentity or member admin rights
            // authorized...continue

          }else{ // not an admin role
//echo(2148);
//print_r($recid); die();  
//print_r($mydocs); die(); 
//print_r($_SESSION['ccmp_rec_id']); die();
            // if it is a ccmp make sure the reord belongs to them
            // Check to see if you are a ccmp executing the function - must be if you are not one of the 5 roles mentioned above. There are only 6 roles.
           // if($_SESSION['ccmpmode'] == 'ccmp' || $_SESSION['ccmpmode'] == 'ccmpc' || $_SESSION['ccmpmode'] == 'ccmpv'){

                $recobj = $this->model->get_one_where(id, $recid, cms_ccmps_filelibrary_docs);
                $ownerid = $recobj->ccmp_id;
//                print_r($ownerid);
//                print_r($_SESSION['ccmp_rec_id']); die(); // since you are not an admin its ok to use $_SESSION['ccmp_rec_id'] because that must be you

          //  }

            if($ownerid == $_SESSION['ccmp_rec_id']){ 
                // continue
            }else{ // 
                // send to ccmps homepage
                $funcname = 'delrecord';
                $ccmp = CCMP;

                $flash_msg = 'You are not authorized to delete someone elses records'; 
                set_flashdata($flash_msg);
                $_SESSION['flashmsgcolor'] = 0;
                redirect('welcome-ccmps/ccmphome');
            }
          }

        }else{ // not logged in at all - send to login form

                redirect('welcome/logout'); // clears everything then takes to login page
            
        }
          
          break;
  default;

      echo('Error 4109: No $docfunction match. Contact the System Administrator 202-207-5353. Use the back button.'); die();

                           
        }

  }

    function previewdocrec() {
    $docid    = segment(3);
    $filename = segment(4);  
    $filetype = segment(5); 

// Replace %20 with a space but when upload system inserts _ for spaces so Ill do this here
    $filenm = str_replace('%20', '_', $filename);
//print_r($filenm); die();

        switch($filetype) {

          case '1': // show database entry in a modal
echo(4128);
print_r($fulldescription); die();
            exit;

          break;

          case '2': // Text .txt Will open in same browser window if don't target = use _blank
//echo(2556); die();
            header('Content-disposition: inline');
            header('Content-type: text/plain');
            readfile('../public/filelibrary/'.$filenm); // not in public in cms/filelibrary/assets/...
            exit;

          break;

          case '3': // PDF .pdf

            header('Content-disposition: inline');
            header('Content-type: application/pdf');
            readfile('../public/filelibrary/'.$filenm);
            exit;

          break;
          case '4': // Word .docx
header('Content-disposition: inline');
header('Content-type: application/msword'); // not sure if this is the correct MIME type
readfile('<?= BASE_URL ?>/cms-ccmpslibrary/50/hello.docx');
exit;
          //  readfile('../public/filelibrary/'.$filenm);
          //  exit;

          break;      
        default;

        // Auditlog
        $type  = 'docfunction';
        $action = 'UnsupportedDoctype'; 
        $func = 'docfunction-preview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$recid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docdata['title'];
        $str6 = 'Mode: '.$managemode;
        
        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

        echo ("Error 4229: Preview not supported for document type. Contact the System Administrator 202-207-5353. Use the back button."); die();       
// set flash and return to either manage or crud
 
      }
    }

  function downloaddoc() {
//    echo(3170); die(); // this stop breaks pdf downloads but not word docs
    $docid    = segment(3);
    $preview  = segment(4); // if pass a p as the last parameter
 //   $filename = segment(4);  // cant pass in URL - server blocks
//print_r($docid); die();// 1
//print_r($preview); die(); //  'p'

// Replace %20 with a space - works but server wont pass %20 in URL and get 403 and this function wont run
// therefore only pass docid and go get the filename & type from DB
// and then correct

    $docobj    = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');

    $filename  = $docobj->filename;
    $filetype  = $docobj->filetype;
    $filemime  = $docobj->filemime;  // what was automatically saved when the file was uploaded - read from $_FILES as file_type
    
    $filenm    = str_replace('%20', '_', $filename);
//print_r($filenm); die();
    $downloads = $docobj->downloads;
    $previews  = $docobj->previews;

    $subentfileloc = $docobj->subentity;
    $fileloc       = $docobj->location;
    
 //  print_r($subentfileloc); die();

//print_r($previews); die(); // 0
    
// Use the $filetype to get the proper mime
    $filetypeobj = $this->model->get_one_where('id', $filetype, 'cms_ccmps_filelibrary_filetypes');
    $mimetype    = $filetypeobj->mime;
    // $mimetype   = $filemime; // doesnt download - loads machine code
 //   $mimetype    = "application/octet-stream";

/*    
echo(4278);
print_r($mimetype);
echo('<br>');
print_r($filemime);
die();
*/
    // If there is a subdirectory for each subentity by number so don't overwrite other subentitys doc with same name

/*
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/force-download";
*/
    /*
echo(2636);
print_r($previews);
echo('<br>');
print_r($preview); die();
*/

//   echo(4295);
//    print_r($filetype); die();
 //   print($subentfileloc); die();
    
if($preview == 'p'){    
        switch($filetype) {

          case '2': // Text .txt

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
         //   header('Content-type: application/octet-stream');  // or text/plain
         //   readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm); // all in one dir filelibrary
            readfile(APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm);
           // exit;

          break;

          case '3': // PDF .pdf
//echo(3641); die(); // previews is correct it has added 1
      $filepath = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm;
 //print_r($filepath); die();     
//      if(file_exists($filepath)){
            header('Content-disposition: inline; filename='.$filenm);
//echo(2726); die(); // here the number has added 1
             
            header($mimetype);

               readfile($filepath);
//echo(2729); die(); // here the number has added 2 - try to subtract 1
   //     $docobj    = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');
   //     $previews  = $docobj->previews;              
   //     $previews = $previews - .5;
   //     $upddata['previews'] = $previews;
   //     $this->model->update($docid, $upddata, 'cms_ccmps_filelibrary_docs');
   // echo(2735); die(); // if try to subtract 1 above you get 0 (it subtracts 2)
   // // if you try to subtract a half it adds 2!   
          //  header('Content-type: application/pdf');
//            readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);
         

//          }else{
//echo('Error: 3344 No file exist - hit the back button and contact the administrator'); die();
 //         }

          break;

          case '4': // Word Doc .docx only

//  echo(3328); die();  
//$filenm = "Hello.docx"; // for testing
              
               if($preview == 'p'){
                       $filepath = APPPATH.'modules/cms/ccmpslibrary/assets/'.$fileloc.'/'.$filenm;
/*                       
               echo('fileloc');
              print_r($fileloc);
              echo('<br>');
              print_r($filenm);
              echo('<br>'); 
              print_r($mimetype);
              echo('<br>'); 
              print_r($filepath);
              echo('<br>'); 
             echo('Does file exist? (blank = No, 1 = Yes): '); print_r(file_exists($filepath)); die();
*/                       
          if(file_exists($filepath)){
            /*    header('Content-disposition: inline');
                header('Content-type: application/octet-stream'); // not sure if this is the correct MIME type
                readfile($filepath); */
$file = $filepath;
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: inline; filename="' . basename($file) . '"');
header('Content-Length: ' . filesize($file));

readfile($file);

          }else{
echo('Library Error: 3706 Preview File not found - hit the back button and contact the administrator'); die();
          }                       
                       
                       
               }else{  
              
              $filepath = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm;
/*
              print_r($subentfileloc);
              echo('<br>');
              print_r($filenm);
              echo('<br>'); 
              print_r($mimetype);
              echo('<br>'); 
              print_r($filepath);
              echo('<br>'); 
             echo('Does file exist? (blank = No, 1 = Yes): '); print_r(file_exists($filepath)); die();
*/
          if(file_exists($filepath)){
            header('Content-Type: application/msword');
          //  header('Content-Type: application/octet-stream');
            header('Content-Description: File Transfer');    
            header('Content-Disposition: attachment; filename='.$filenm); // New filename (set to old)
            //header('Content-Disposition: inline; filename='.$filenm);
        
            readfile($filepath);

      //  readfile(APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm);

        //    header('Content-disposition: inline; filename='.$filenm);
        //    header($mimetype);

         //   header('Content-type: application/msword');
         //   header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

 
         //   readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);
//$checkpath = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm;
//print_r($checkpath); die();
          //  readfile(APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$filenm);

          }else{
echo('Library Error: 3764 Download File not found - hit the back button and contact the administrator'); die();
          }




       // s     echo(3331); die(); // never makes it here  

          }
          break;

          
          case '6': // Powerpoint  .pptx only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
         //   header('Content-type: application/ms-powerpoint');            
            readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);
            exit;

          break;

      
          case '7': // Excel  .xlsx only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
        //    header('Content-type: application/ms-excel');            
        //   header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);
            exit;

          break;

          case '8': // Zip  .zip only

            header('Content-disposition: inline; filename='.$filenm);
            header($mimetype);
          //  header('Content-type: application/zip');            
          //  readfile('../public/filelibrary/'.$filenm);
            readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);            
            exit;

          break;          
// .doc Content-type: application/msword
// .csv text/csv
// .gif image/gif
// .htm, .html text/html
// unknown application/octet-stream

    }

        
        // Opens pdf in browser where download will open pdf in acrobat
        // if preview dont count as a download
       // $previews = $previews + 1;
       // $upddata['previews'] = $previews;
    //    $this->model->update($docid, $upddata, 'cms_ccmps_filelibrary_docs');
/*
echo(2651);
echo('<br>');
print_r($previews);         
echo('<br>');
print_r($upddata['previews']); die();
 */       
    //    $previews = 0;// reset to avoid double counting if run twice in a row
     //   $upddata['previews'] = 0; // reset to avoid double counting if run twice in a row
        
        // Auditlog
        $type  = 'preview';
        $action = 'PreviewDoc';
        $func = 'library-downloaddoc-preview';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docobj->id;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docobj->title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);        
    }else{ // not previewing - downloading   

        header('Content-disposition: inline; filename='.$filenm);
        header($mimetype);
        readfile(APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$filenm);

        $downloads = $downloads + 1;
        $upddata['downloads'] = $downloads;

        
    //print_r($upddata); die();
        $this->model->update($docid, $upddata, 'cms_ccmps_filelibrary_docs');
    //print_r($upddata['downloads']); die();
        $downloads = 0;// reset to avoid double counting if run twice in a row
        $upddata['downloads'] = 0; // reset to avoid double counting if run twice in a row

//print_r($downloads);
//print_r($upddata['downloads']); die();
        // Auditlog
        $type  = 'download';
        $action = 'DownloadDoc';
        $func = 'library-downloaddoc';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docobj->id;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$docobj->title;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
    }
//print_r('exited'); die();
  }

function submit_upload() {

  $docid = segment(3);
  $managemode = segment(4);
  $orgfiledate = substr($_POST['moddate'], 0,25);
  
 // print_r($filedate); die();
//json($_POST); die();
//  print_r($_POST['moddate']); die();


/*
echo(4545);
echo("<br>");
print_r($docid);
echo("<br>");
print_r($managemode);
echo("<br>");
print_r($orgfiledate); 
echo("<br>");  
print_r($_FILES['my_file']['name']); die(); 
*/


  if ($_FILES['my_file']['name'] == '') {
    redirect($_SERVER['HTTP_REFERER']);
  }

    // Stores the file name
    $filename = $_FILES['my_file']['name'];
  
    // Store the file mime type - NOT USED - but can show what mime to add to filetype table
    $type = $_FILES["my_file"]["type"];
    $filemime = $type;
    
    // Store the files full path
    $fullpath = $_FILES["my_file"][""];

    // Store the file size
    $size = $_FILES["my_file"]["size"];
    $filesize = $size/1024;
    $filesize = round($filesize , 1);
                
    $ext =  strtolower(pathinfo($filename,PATHINFO_EXTENSION));

    $docrecobj = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');
//json($docrecobj); die();
    $filetype    = $docrecobj->filetype; // number
    $subentfileloc  = $docrecobj->subentity; // number
  //  $docrecfilename = $docrecobj->filename; // to test if spelled wrong

 /*
    echo "File actual name is ". $filename."<br>";
    echo "File has ".$type." mime type" . "<br>"; // not in tg docs
    echo "File has size of ".$filesize."<br>"; // not in tg docs
    echo "File has extension of ".$ext."<br>"; // not in tg docs
    echo "Record filetype is ".$docfiletype."<br>"; // not in tg docs    
 //   echo "File fullpath of ".$fullpath."<br>"; // not used ??? - not in tg docs
 //   echo "File location of ".$location."<br>"; // not used ??? - not in tg docs
    die(); 
*/

            switch ($ext){ 
            case 'txt': 
                $uploadfiletype = 2;
            break;

            case 'pdf':            
                $uploadfiletype = 3;
            break;          

            case 'doc':            
                $uploadfiletype = 4;
            break; 

            case 'docx':            
                $uploadfiletype = 4;
            break;   

            case 'ppt':            
                $uploadfiletype = 5;
            break; 

            case 'pptx':            
                $uploadfiletype = 5;
            break;
        
            case 'xls':            
                $uploadfiletype = 6;
            break; 

            case 'xlsx':            
                $uploadfiletype = 6;
            break;  

            case 'zip':            
                $uploadfiletype = 7;
            break; 

            case 'mp3':            
                $uploadfiletype = 8;
            break;   

            case 'mp4':            
                $uploadfiletype = 9;
            break; 

            case 'mov':            
                $uploadfiletype = 10;
            break;   

            case 'jpg':            
                $uploadfiletype = 11;
            break; 

            case 'jpeg':            
                $uploadfiletype = 11;
            break;   

            case 'png':            
                $uploadfiletype = 12;
            break; 

            case 'bmp':            
                $uploadfiletype = 13;
            break;   

            default;
          //     echo ('Error 2921: Unknown file type = '.$ext.' Please contact System Administrator'); die();
    set_flashdata('Error 4668: File type '.$ext.' is not allowed. Contact the System Administrator 202-207-5353. Use the back button.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('cms-ccmpslibrary/viewdocrec/'.$docid); 
        }

/* this whole section was if you asked for and saved the filetype on the record first.

// if $filetype has been saved then see if it matches what trying to upload

if( $uploadfiletype  ==  $docfiletype ){
    // uploading the type of file you specified
    // all is OK
//echo('2933 filetypes match!'); die();

}else{
// not uploading the filetype specified on the record
    $result = 0; // fail validation

//echo('2940 filetypes dont match!'); die();

    set_flashdata('The document file type does not match the type on the record. Try another document or change the file type on the record.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('cms-ccmpslibrary/viewdocrec/'.$docid);
}
*/
  //PLEASE NOTE: max_size is in kilobytes
  $validation_str = 'allowed_types[pdf,txt,xlsx,docx,pptx,gif,jpg,jpeg,png,bmp,zip,mp3,mp4,mov]|max_size[20000]'; // 20mb
  $this->validation_helper->set_rules('my_file', 'file', $validation_str);

  $result = $this->validation_helper->run();

//print_r($result);
//print_r($filename); die();
//print_r($docid); die();  
  if ($result == true) {
      
    //print_r($docid); die();
    $docobj = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');
    $subentfileloc = $docobj->subentity; // number
 //json($docobj); die();
    

    // If you are replacing a file there will be an old filename
    // If you are uploading to a newly created record it will be NULL
    $oldfilename     = $docobj->filename;
//print_r($oldfilename); die();
// Ex. "1 YIAP Brochure - Signed - Rayan Salahuddin.pdf "" -> 1_yiap_brochure_signed_rayan_salahuddin.pdf
// Must be done in this order. There may be threes and twos underscores after system replaces things with underscores
    $oldfilename = str_replace(' ', '_', $oldfilename); // replace space with underscore
    $oldfilename = str_replace('___', '_', $oldfilename);  // convert triple underscores to single  
    $oldfilename = str_replace('__', '_', $oldfilename);  // convert double underscores to single 
    $oldfilename = strtolower($oldfilename); 
    
    $oldfilelocation = $docobj->location;
    $oldfilelocation = str_replace(' ', '_', $oldfilelocation);
    $oldfilelocation = strtolower($oldfilelocation);

    $newfilename = $filename;

    $newfilename = str_replace(' ', '_', $newfilename); // replace space with underscore
    $newfilename = str_replace('___', '_', $newfilename);  // convert triple underscores to single  
    $newfilename = str_replace('__', '_', $newfilename);  // convert double underscores to single 
    $newfilename = strtolower($newfilename); 
    
    // if you didnt already save filetype on record before strating the upload
    // $docdata will save it on the update below.
    // if you are using the ask the user for filetype upfront then comment this out
    // and use commented out code below that compares what was already saved on the record
    // with what was just uploaded

    $docdata['filetype'] = $uploadfiletype;
    $docdata['filesize'] = $filesize;
/*
echo(4722);
echo("<br>");
//print_r($oldfilelocation);
echo("<br>");
print_r($filename);
echo("<br>");
print_r($oldfilename);
echo("<br>");
print_r($docid);
die();
*/

// this is when you always want the most current newsletter to be docid 1 so you can hardcode a button on the ccmphome
if ($docid == 'x'){ // currently not implemented. docid 1 always most current newsletter to link to button.
    
// the first doc is the ATIS. It is overwritten if replaced by a ATIS with the same name
// or the old ATIS is saved as new document if replaced by a ATIS with a different name

    if ($oldfilename == $newfilename){ // ex. perhaps a mistake in the first one and re-uploading
        
        // if the file has the same name you need to delete it before uploading or filesystem with append
        // something to make it unique
        
        // Need to lookup how to delete a file off the disk

        $file_pointer = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$oldfilename;
        $path = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'; 

        /* delete instead of rename */
        if (!unlink($file_pointer)) {
            echo ("Error: 3580 file : $file_pointer cannot be replaced due to an error. Contact the System Administrator 202-207-5353. Use the back button."); die();
        }else {
         //   echo ("$file_pointer has been deleted"); die();
        }
//       echo(3100); die();
         
        // Now upload the new file of the same name
        //$config['destination'] = '../public/filelibrary';
    //    $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';           
        $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc;
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->file->upload($config); // inherited function
             
        //replaced with same file, do not need to update the document record (perhaps timestamps)
        set_flashdata('The file '.$newfilename.' successfully overwrote a file having the same name.');
        $_SESSION['flashmsgcolor'] = 1;
    }else{ // different filename
 echo(4801); die();       
        //upload the file
        //$config['destination'] = '../public/filelibrary';
//        $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';
        $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc;
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->file->upload($config); // inherited function    
             
        // now want to copy the old ATIS to its own new record to preserve access to it
        // no need for a file upload because the file is already there
        
        $doc1obj = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');

        // Initialize New Record with old data
        $copydata['tg_user_id']       = $doc1obj->tg_user_id; 
        $copydata['ccmp_id']          = $doc1obj->ccmp_id;
        $copydata['downloads']        = $doc1obj->downloads;
        $copydata['active']           = $doc1obj->active;
        $copydata['approved']         = $doc1obj->approved;
        $copydata['doctag']           = $doc1obj->doctag;
        $copydata['doctype']          = $doc1obj->doctype;
        $copydata['filetype']         = $doc1obj->filetype;               
        $copydata['featured']         = $doc1obj->featured;                               
        $copydata['scope']            = $doc1obj->scope;
        $copydata['access']           = $doc1obj->access;        
        $copydata['subentity']        = $doc1obj->subentity;
        $copydata['affiliate']        = $doc1obj->affiliate;
        $copydata['title']            = $doc1obj->title;  
        $copydata['author']           = $doc1obj->author;  
        $copydata['shortdescription'] = $doc1obj->shortdescription;  
        $copydata['fulldescription']  = $doc1obj->fulldescription;
        $copydata['notes']            = $doc1obj->notes;  
        $copydata['filename']         = $doc1obj->filename;
        $copydata['filesize']         = $doc1obj->filesize;
        $copydata['filedate']         = $doc1obj->filedate;        
        $copydata['location']         = $doc1obj->location;  
        $copydata['orglogo']          = $doc1obj->orglogo;  
        $copydata['smallimage']       = $doc1obj->smallimage;  
        $copydata['largeimage']       = $doc1obj->largeimage;  
        $copydata['extlink']          = $doc1obj->extlink;
        $copydata['uploaded_at']      = $doc1obj->uploaded_at;
        $copydata['uploaded_by']      = $doc1obj->uploaded_by;          
        $copydata['created_at']       = $doc1obj->created_at; 
        $copydata['created_by']       = $doc1obj->created_by; 
        $copydata['updated_at']       = $doc1obj->updated_at;
        $copydata['updated_by']       = $doc1obj->updated_by;

//echo('2849 uploaded ATIS and about to create a new record with the old ATIS information: ');
//json($copydata); die();        

        // Replace filename with new name and location AFTER you copy the old information for the new record
        $docdata['filename'] = $newfilename;
        $docdata['location'] = $subentfileloc;

        // If title hasnt changed when this new ATIS was uploaded then CM didnt edit the record first
        // with the new name so we need to change it and prompt CM to edit title & description fields
        // But there is no way to know what it was before if CM edited first so just set defaults
        // Make the procedure upload first then edit if necessary
        // One constriant is you cant edit & upload in the same transaction without completing one of them first.
        // Two independent actions you are trying to account for.
        
        $docdata['title']            = 'Newsletter';
        $docdata['shortdescription'] = 'Current Newsletter';
        // new poster & subentity and let CM edit the rest if necessary        
        $docdata['ccmp_id']    = $_SESSION['ccmp_rec_id'];
        $docdata['tg_user_id'] = $_SESSION['tg_user_id'];
      // probably not needed $docdata['subentity']    = 50;// subentity should always be 50 for ATIS
        $docdata['scope']      = 1; // Newsletter should be public
        $docdata['access']     = 1; // Newsletter should be public
        $docdata['downloads']  = 0;
        $docdata['created_by']  = $_SESSION['tg_user_id'];
        $docdata['updated_by']  = $_SESSION['tg_user_id'];
        $docdata['created_at']  = time();
        $docdata['updated_at']  = time();        
// ??? Why need all ccmp_id, tg_user_id, created_by and update_by?        
        
echo(4888);
//json( $_SESSION);
json( $docdata); die();

        $this->model->update($docid, $docdata, 'cms_ccmps_filelibrary_docs'); 

        //insert the new record for the old ATIS            
        $this->model->insert($copydata, 'cms_ccmps_filelibrary_docs');
        
// echo('Line 2862 - New doc record added!'); die();   
 
        // get the new record's id so can view 

        $new_id = $this->model->get_max('cms_ccmps_filelibrary_docs');
                
        // Auditlog
        $type  = 'insert';
        $action = 'ReplacedATIS';
        $func = 'library-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$new_id;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Title: '.$copydata['title'];
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);


        set_flashdata('The new ATIS '.$newfilename.' was successfully uploaded and new record created for prior ATIS '.$oldfilename);
        $_SESSION['flashmsgcolor'] = 0;
    } // if oldfilename = newfilename
    
        // Only CM maintains ATIS but make it flexible in case add others
        $mode = $_SESSION['ccmpmode']; // dmslibadminv for CM
        $modeprefix = substr($mode, 0,3); // cmm so want pass dmslibadmin to manage
//print_r($modeprefix); die();  
    
        switch ($modeprefix){ 
            case 'cmm': 
                redirect('cms-ccmpslibrary/manage/dmslibadmin');
            break;

            case '':            

            break;          

  default;

    set_flashdata('Error 4788: No matching modeprefix '.$modeprefix. '. Contact the System Administrator 202-207-5353. Use the back button.');
    $_SESSION['flashmsgcolor'] = 0;
    redirect('cms-ccmpslibrary/viewdocrec/'.$docid); 

        }

  }else{ // if $docid not = 1
      
/*      
echo(4910);
echo('<br>'); 
print_r($docid); // ok
echo("<br>");
print_r($filename);
echo("<br>");
print_r($oldfilename);
echo("<br>");
print_r($filesize); 
echo("<br>");
print_r($filetype); die();
*/  
    // Newly uploaded file is $filename
    // Get the old one for comparison - it will be null if a new record
    // File has already uploaded so just update the document record with the file information

// Ex. "1 YIAP Brochure - Signed - Rayan Salahuddin.pdf" => 1_yiap_brochure_signed_rayan_salahuddin.pdf
// Must be done in this order. There may be threes and twos underscores after system replaces things with underscores
    $newfilename = str_replace(' ', '_', $newfilename); // replace space with underscore
    $newfilename = str_replace('___', '_', $newfilename);  // convert triple underscores to single  
    $newfilename = str_replace('__', '_', $newfilename);  // convert double underscores to single 

    $filename    = strtolower($newfilename);
//print_r($filename);die();
    $docdata['filename']    = $filename;
    $docdata['filedate']    = $orgfiledate;
    $docdata['filesize']    = $filesize;
    $docdata['filemime']    = $filemime;
    $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
    $docdata['uploaded_at'] = time();
    $docdata['downloads']   = 0;    
  //  $docdata['location']    = $subentfileloc; // not implementing separate doc directories by subentities
 
    $oldfilename = str_replace(' ', '_', $oldfilename); // replace space with underscore
    $oldfilename = str_replace('___', '_', $oldfilename);  // convert triple underscores to single  
    $oldfilename = str_replace('__', '_', $oldfilename);  // convert double underscores to single 
    $oldfilename = strtolower($oldfilename);
    
    //  tc1 - Upload a "Missing File" - added a new record and now uploading the file
    if (strlen($oldfilename) == 0) { // 
        //upload the file
            // now we have established that the filename is different from the existing one
            // now need to determine if it exists on another record, if so we will be
            // compromising the other record if we allow it somwe wont
            
            $dupobj =  $this->model->get_one_where('filename', $filename, 'cms_ccmps_filelibrary_docs');
            
            if(isset($dupobj)){ // duplicate found on another record
//json($dupobj); die();
             $rectitle = $dupobj->title;
             $dupid = $dupobj->id;
echo(4993); die(); 
 //print_r( $dupid); die();            
        set_flashdata("The document $filename already exists on document $rectitle.  Link: '.<p href='$dupid'> <? $rectitle ?> </p>.'");
        $_SESSION['flashmsgcolor'] = 0;                
                
                $this->ccmpslibrary->viewdocrec($docid,$managemode);
         //       redirect('cms-ccmpslibrary/viewdocrec/'.$docid.'/'.$managemode);
   
            }else{ // not found in library so continue
                echo(5213); die();
            
            
            
        //$config['destination'] = '../public/filelibrary';
        // $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc;          
        $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';      
        $config['make_rand_name'] = false;
//print_r($config['destination']);die();

        // Note: upload_file() converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->file->upload($config); // upload_file inherited from Trongate.php at bottom   
 //json($file_info);
 //json($docdata); die();    
        // no old file to delete so just add file data to the document record
        $this->model->update($docid, $docdata, 'cms_ccmps_filelibrary_docs'); 
        //set some flashdata
        set_flashdata('The document '.$docdata['filename'].' was successfully uploaded.');
        $_SESSION['flashmsgcolor'] = 1;

        // Auditlog
        $type  = 'FileUpload';
        $action = 'tc1NewOrMissing';
        $func = 'library-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);
                
        redirect('cms-ccmpslibrary/viewdocrec/'.$docid.'/'.$managemode);
    }
    }else{ //There is an existing file on the record
    //    echo('5023 There is an existing file'); die();
     
        if ($oldfilename == $filename){
    //    echo('5028 tc3 - Replacing existing file with one of the same name'); die();
       
      //  $file_pointer = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/'.$docdata['filename'];
      //  $path = APPPATH.'modules/cms/ccmpslibrary/assets/'.$subentfileloc.'/';
          $file_pointer = APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$docdata['filename'];
          $path = APPPATH.'modules/cms/ccmpslibrary/assets/docs/';
          
        $docdata['filedate'] =  filectime($file_pointer);
/*
echo(4987);
echo("<br>");
print_r($file_pointer);
echo("<br>");
print_r($docdata['filedate']);
echo("<br>");
print_r($docdata['filesize']);
echo("<br>");
print_r($path); die();
*/
  $this->model->update($docid, $docdata, 'cms_ccmps_filelibrary_docs'); 

/* could not get to rename or copy so will delete and replace  
if (file_exists($path))     { 
  //  echo(3269); die();
        $i=1; 
        $new_path=$path;
         
        while (file_exists($new_path)) 
        { 
            // get file extension 
          //  $extension = pathinfo($path, PATHINFO_EXTENSION); 
            $extension = pathinfo($file_pointer, PATHINFO_EXTENSION); 

          
            // get file's name 
            $filename = pathinfo($file_pointer, PATHINFO_FILENAME); 
           
            // get file's directory
         //   $directory=dirname($path);
             
            // add and combine the filename, iterator, extension 
            $new_filename = $filename . '-' . $i . '.' . $extension; 
 //    print_r($new_filename); die();              
            // add file name to the end of the path to place it in the new directory; the while loop will check it again 
            $new_path = $new_filename; 
            
            $i++;  
        } 
         
           $new_path = $path.$new_path;
         //  $new_path = $new_path;
     //      $opendirectory = opendir($path);
           print_r($file_pointer);
           echo('<br>');
           print_r($new_path); die();

        if(!copy($filepointer, $new_path)){
            echo 'Error 3303: error renaming file'; die();
        }else{
            echo(3294); die(); 
        }

     //   closedir($opendirectory);
}else{

    echo('Error: 3293 File not found! Contact the System Administrator. Use back button.'); die();

}  */
//echo(5029);
//echo("<br>");
//print_r($ext); die();
     if ( CCMPS_FL_SAVE_BAK == 1){ // rename to a backup file
        $fileroot = pathinfo($file_pointer, PATHINFO_FILENAME);          
        $bakfilename = $path.$fileroot.'_'.$ext.'.bak' ;
//echo(5034);
//echo("<br>");
//print_r($file_pointer);
//echo("<br>");
//print_r($bakfilename); die();

//  tc4 - Upload a "Missing File" - added a new record and now uploading the file
// must check to see if a backup file exists - if so it will delete existing file and keep old backup instead of rename (dont know why)
if(file_exists($bakfilename)){ // delete it so existing file will be backed up (renamed) and not auto deleted by the system
  //echo('5107 tc4 - Replacing existing file with one of the same name'); die();
            /* delete old backup */
            unlink($bakfilename);

            // echo ("$bakfilename has been deleted"); die();
            // Auditlog
            $type  = 'delete';
            $action = 'DeletedBackup';
            $func = 'library-submit_upload';
            $un   = 'TGuid: '.$_SESSION['tg_user_id'];
            $format = 'minitime'; // I added to Timedate.php
            $this->module('timedate');            
            $timestamp = time();
            $time   = $this->timedate->get_nice_date($timestamp, $format);
            $time = $time.' UTC';
            $str3 = 'Rec: '.$docid;
            $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
            $str5 = 'Fullpath: '.$bakfilename;
            $str6 = 'Mode: '.$managemode;

            $this->module('system-auditlogger');
            $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);

     //   set_flashdata('The new ATIS '.$newfilename.' was successfully uploaded and new record created for prior ATIS '.$oldfilename);
     //   $_SESSION['flashmsgcolor'] = 0;                   
}
       rename($file_pointer, $bakfilename);  // if replacing a file rename original with .bak extension

         
     }else {
            /* delete instead of rename */
            if (!unlink($file_pointer)) {
                echo ("Error: 5139 file cannot be found most probably because the name of the file in the directory does not match the name in the datanbase. Contact the System Administrator 202-207-5353. Use the back button."); die();
            }else {
                echo ("$file_pointer has been deleted"); die();
            }
     }
//echo(5076); die();        
//    
        // Now upload the new file of the same name
        //$config['destination'] = '../public/filelibrary';
      //  $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';
        $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';       
        $config['make_rand_name'] = false;

        // Note: converts the filename to all lowercase before saving to the harddrive
        $file_info = $this->file->upload($config); // inherited function
                
        //replaced with file of same name, no need to update record but could have different date
        
            $docdata['filename']    = $filename;
            $docdata['filedate']    = $orgfiledate; //org saved above - info on source file changes to todays date when uploaded
            $docdata['filesize']    = $filesize;
            $docdata['filemime']    = $filemime;
            $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
            $docdata['uploaded_at'] = time();
            $docdata['downloads']   = 0; 
    
         //   $docdata['location'] = $subentfileloc ; // see if need to add path to download or not  ???
//json(  $docdata); die();
//json($_FILES); die();      
            // now update the doc record with the new filename
            $this->model->update($docid, $docdata, 'cms_ccmps_filelibrary_docs'); 
            
        set_flashdata('The document '.$docdata['filename'].' was successfully uploaded and replaced.');
        $_SESSION['flashmsgcolor'] = 1;
        
        // Auditlog
        $type  = 'upload';
        $action = 'tc3ReplaceSame';
        $func = 'ccmpslibrary-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);        
        
        redirect('cms-ccmpslibrary/viewdocrec/'.$docid.'/'.$managemode);
               
        }else{ // you are replacing the file with a different name so delete first one so not orphaned
     //   echo('5181 tc2 - Replacing existing file with one of a different name'); die();

            $old_pointer = APPPATH.'modules/cms/ccmpslibrary/assets/docs/'.$oldfilename;
            $path = APPPATH.'modules/cms/ccmpslibrary/assets/docs/';
            $fileroot = pathinfo($old_pointer, PATHINFO_FILENAME); // existing file w/o ext          
            $bakfilename = $path.$fileroot.'_'.$ext.'.bak' ;
//print_r($oldfilename); // existing file
//echo('<br>');
//print_r($filename); die(); // new file
            // now we have established that the filename is different from the existing one
            // now need to determine if it exists on another record, if so we will be
            // compromising the other record if we allow it somwe wont
            
            $dupobj =  $this->model->get_one_where('filename', $filename, 'cms_ccmps_filelibrary_docs');
            
            if(isset($dupobj)){ // duplicate found on another record
//json($dupobj); die();
             $rectitle = $dupobj->title;
             $dupid = $dupobj->id;
//echo(5236); die();  
 //print_r( $dupid); die();      
//  set_flashdata("<a href='cms-ccmpslibrary/viewdocrec/$dupid/$managemode'> The document $filename already exists on document $rectitle</a>"); 

set_flashdata("The file $filename already associated with document $rectitle. File not replaced."); 


        $_SESSION['flashmsgcolor'] = 0;                
                
                $this->ccmpslibrary->viewdocrec($docid,$managemode);
         //       redirect('cms-ccmpslibrary/viewdocrec/'.$docid.'/'.$managemode);
   
            }else{ // not found in library so continue
                echo(5213); die();
            }
echo(5247); die();          

/*          
            echo(5188);
            print_r($oldfilename);
            echo('<br>');
            print_r($path);
            echo('<br>');
            print_r($fileroot);
            echo('<br>');
            print_r($old_pointer);
            echo('<br>');
            print_r($bakfilename);
            echo('<br>');
            echo('End'); die();
*/            
            // Instead of deleting the old file rename it with a .bak extension and tack on the old ext with an underscore
            rename($old_pointer, $bakfilename);  // if replacing a file rename original with .bak extension
                   
            //upload the file
            //$config['destination'] = '../public/filelibrary';
 
            $config['destination'] = APPPATH.'modules/cms/ccmpslibrary/assets/docs';              
            $config['make_rand_name'] = false;
            
            // Upload the new file with a framework function upload_file
            // Note: converts the filename to all lowercase before saving to the harddrive
            $file_info = $this->file->upload($config); // inherited function     
//json($file_info); die();
//json($_FILES); die();
//print_r($file_info['file_path']); die();

// kept in case other filedates are desired in the future
/*
$file_name = $file_info['file_path'];

$filedatea =  date("F d Y H:i:s.", fileatime($file_name));
$filedatem =  date("F d Y H:i:s.", filemtime($file_name));
$filedatec =  date("F d Y H:i:s.", filectime($file_name));            
print_r($filedatea);
echo('<br>');
print_r($filedatem);
echo('<br>');
print_r($filedatec); die();
*/
    
            $docdata['filename']    = $filename;
            $docdata['filedate']    = $orgfiledate; //org saved above - info on source file changes to todays date when uploaded
            $docdata['filesize']    = $filesize;
            $docdata['filemime']    = $filemime;
            $docdata['uploaded_by'] = $_SESSION['tg_user_id'];
            $docdata['uploaded_at'] = time();
            $docdata['downloads']   = 0; 
    
         //   $docdata['location'] = $subentfileloc ; // see if need to add path to download or not  ???
//json(  $docdata); die();
//json($_FILES); die();      
            // now update the doc record with the new filename
            $this->model->update($docid, $docdata, 'cms_ccmps_filelibrary_docs'); 
            
            //set some flashdata
            set_flashdata('The document '.$docdata['filename'].' was successfully uploaded.');
            $_SESSION['flashmsgcolor'] = 1;
          //  redirect('cms-ccmpslibrary/viewdocrec/'.$docid);
            
        
        // Auditlog
        $type  = 'upload';
        $action = 'tc2ReplaceDifferent';
        $func = 'ccmpslibrary-submit_upload';
        $un   = 'TGuid: '.$_SESSION['tg_user_id'];
        $format = 'minitime'; // I added to Timedate.php
        $this->module('timedate');            
        $timestamp = time();
        $time   = $this->timedate->get_nice_date($timestamp, $format);
        $time = $time.' UTC';
        $str3 = 'Rec: '.$docid;
        $str4 = 'Tbl: cms_ccmps_filelibrary_docs';
        $str5 = 'Fullpath: '.$config['destination'].'/'.$filename;
        $str6 = 'Mode: '.$managemode;

        $this->module('system-auditlogger');
        $this->auditlogger->logevent($type, $action, $func, $un, $time, $str3, $str4, $str5, $str6);             
            
              redirect('cms-ccmpslibrary/viewdocrec/'.$docid.'/'.$managemode);
        }
    
    }
echo(5190); die();

      
 
  }
  
   
  } else { // $result = false
    echo(5175); 
    print_r($docid);die();
    //validation error! Present the form again.
   // $this->upload();
 //redirect('cms-ccmpslibrary/manage/ccmp');
     set_flashdata('The document '.$newfilename.' has an invalid file extension. Please choose another file.');
     $_SESSION['flashmsgcolor'] = 1;
     redirect('cms-ccmpslibrary/viewdocrec/'.$docid);
  }// if $result = true
  
} // function submit upload

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

public function saveAndPreviewDocx()
{
   // echo(4472); die();
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    $description_data = "This is a sample text and i want it to preview this in a browser in word file";       
    $section->addText($description_data);

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    try {
        $objWriter->save(storage_path('new_doc12.docx'));
    } catch (Exception $e) {
    }
 // How can i view the file in the browser form here or form the view using the phpWord

}
function docx_to_text($input_file = NULL){
        $docid    = segment(3);
            $docobj    = $this->model->get_one_where('id', $docid, 'cms_ccmps_filelibrary_docs');
    $filetype  = $docobj->filetype;
    $filename  = $docobj->filename;
    $filenm    = str_replace('%20', '_', $filename);
//print_r($filenm); die();

    $fileloc = $docobj->location;
    
          $input_file = APPPATH.'modules/cms/ccmpslibrary/assets/'.$fileloc.'/'.$filenm;
 //print_r($input_file); die();         
    $xml_filename = "word/document.xml"; //content file name
    $zip_handle = new ZipArchive;
    $output_text = "";

    if(true === $zip_handle->open($input_file)){
         
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text = strip_tags($xml_handle->saveXML());
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{
          
    $output_text .="";
    }
    print_r($output_text); die();
    return $output_text;
}

//echo docx_to_text("file.docx");
function get_mimetype($filepath) {
    if(!preg_match('/\.[^\/\\\\]+$/',$filepath)) {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filepath);
    }
    switch(strtolower(preg_replace('/^.*\./','',$filepath))) {
        // START MS Office 2007 Docs
        case 'docx':
            return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        case 'docm':
            return 'application/vnd.ms-word.document.macroEnabled.12';
        case 'dotx':
            return 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
        case 'dotm':
            return 'application/vnd.ms-word.template.macroEnabled.12';
        case 'xlsx':
            return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        case 'xlsm':
            return 'application/vnd.ms-excel.sheet.macroEnabled.12';
        case 'xltx':
            return 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
        case 'xltm':
            return 'application/vnd.ms-excel.template.macroEnabled.12';
        case 'xlsb':
            return 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
        case 'xlam':
            return 'application/vnd.ms-excel.addin.macroEnabled.12';
        case 'pptx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
        case 'pptm':
            return 'application/vnd.ms-powerpoint.presentation.macroEnabled.12';
        case 'ppsx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
        case 'ppsm':
            return 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12';
        case 'potx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.template';
        case 'potm':
            return 'application/vnd.ms-powerpoint.template.macroEnabled.12';
        case 'ppam':
            return 'application/vnd.ms-powerpoint.addin.macroEnabled.12';
        case 'sldx':
            return 'application/vnd.openxmlformats-officedocument.presentationml.slide';
        case 'sldm':
            return 'application/vnd.ms-powerpoint.slide.macroEnabled.12';
        case 'one':
            return 'application/msonenote';
        case 'onetoc2':
            return 'application/msonenote';
        case 'onetmp':
            return 'application/msonenote';
        case 'onepkg':
            return 'application/msonenote';
        case 'thmx':
            return 'application/vnd.ms-officetheme';
            //END MS Office 2007 Docs

    }
    return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filepath);
}

} // End controller