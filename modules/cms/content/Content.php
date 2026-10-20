<?php

/*----------------------------------------------------------------------------*/
/*---------------------------- module CMS-CONTENT ----------------------------*/
/*----------------------------------------------------------------------------*/

/*
  The content manager (menu name CMS_LABEL, "Website" for BPA): what the member
  home (ccmphome) and the public website show, section by section. Used from
  both logins; rbac_allowed('cms', 'manage_content') decides (Content Admins,
  System Admins). Tables: cms_sections, cms_items, cms_media (see
  database/migrations/2026-10-20-cms-content-phase1.sql).

  sections()                         list of page sections
        _check_access()
        _layouts()
        _token()
  updatesection()                    edit one section's heading, subtitle, menu label
        _check_access()
  sectionsubmit()
        _check_access()
        _check_token()
        _audit()
  togglesection()                    AJAX: show_member / show_public on or off
        _check_access()
        _check_token()
        _audit()
  ordersections()                    AJAX: new order after a drag
        _check_access()
        _check_token()
  items()                            the items in one section
        _check_access()
        _layouts()
        _media_url()
  createitem()
        _item_form()
  updateitem()
        _item_form()
  _item_form($section, $item)        shared by createitem / updateitem / itemsubmit
        _layouts()
        _media_url()
  itemsubmit()
        _check_access()
        _check_token()
        _item_from_post()
        _valid_link()
        _item_form()
        _audit()
  toggleitem()                       AJAX: active on or off
        _check_access()
        _check_token()
  orderitems()                       AJAX: new order after a drag
        _check_access()
        _check_token()
  delitem()
        _check_access()
        _check_token()
        _audit()
  media()                            the picture library
        _check_access()
        _media_url()
  uploadmedia()                      one or more pictures
        _check_access()
        _check_token()
        _save_upload()
        _audit()
  updatemedia()                      AJAX: alt text
        _check_access()
        _check_token()
  delmedia()                         only when nothing uses the picture
        _check_access()
        _check_token()
        _audit()
  posts()                            Sunshine, Bulletin Board, Marquee or Careers list (segment 3 = kind)
        _check_access()
        _kinds()
        _chapters()
  createpost() / updatepost()
        _post_form()
  _post_form($kind, $post)           shared by createpost / updatepost
        _kinds()
        _chapters()
        _media_url()
  postsubmit()
        _check_access()
        _check_token()
        _post_from_post()
        _valid_link()
        _audit()
  togglepost() / orderposts()        AJAX: active on or off / new order
        _check_access()
        _check_token()
  delpost()
        _check_access()
        _check_token()
        _audit()
  job()                              a job's detail page, for anyone logged in (public site: phase 6)
        _media_url()
  events()                           calendar events: all (Event Admins) or your chapter's (Chapter Admins)
        _event_scope()
        _chapters()
  createevent() / updateevent()
        _event_form()
  _event_form($event)                shared by createevent / updateevent
        _event_scope()
        _chapters()
        _media_url()
  eventsubmit()
        _event_scope()
        _check_token()
        _valid_link()
        _audit()
  delevent()
        _event_scope()
        _check_token()
        _audit()
  _event_scope()                     'all', a chapter id, or back home with a message
  _kinds()                           post kind => menu name, icon, fields and labels
  _chapters()                        id => name, for the chapter picker
  _post_from_post($kind)
  _layouts()                         layout => description and the item fields it uses
  _check_access()
        _home_url()
  _home_url()                        staff dashboard or member home
  _token() / _check_token()          form and AJAX token (another site can't post in your name)
  _item_from_post()
  _valid_link($url)
  _save_upload($file)                checks, shrinks large pictures, stores in public/uploads/cms/
  _media_url($file_name)
  _json($ok, $msg)
  _audit($action, $recid, $table, $what)
*/

/*----------------------------------------------------------------------------*/

class Content extends Trongate {

    private $upload_dir = 'public/uploads/cms/'; // under APPPATH; served as BASE_URL.'uploads/cms/'
    private $max_bytes  = 10485760;              // 10 MB per picture
    private $max_width  = 1920;                  // larger pictures are shrunk to this width

/*----------------------------------------------------------------------------*/
/*------------------------------ CONSTRUCTORS --------------------------------*/
/*----------------------------------------------------------------------------*/

    function _construct(){
      $this->parent_module = 'cms';
      $this->child_module  = 'content';
    }

    function _destruct(){
      $this->parent_module = '';
      $this->child_module  = '';
    }

/*----------------------------------------------------------------------------*/
/*--------------------------- function SECTIONS ------------------------------*/
/*----------------------------------------------------------------------------*/

  function sections(){ // the list of page sections

    $this->_check_access();

    $data['sectionrecs'] = $this->model->query("SELECT s.*, (SELECT COUNT(*) FROM cms_items i WHERE i.section_id = s.id) AS item_count
                                                  FROM cms_sections s ORDER BY s.sort_order, s.id", 'object');
    $data['layouts']     = $this->_layouts();
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'sections';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = 'Page Sections';
    $data['header'] = CMS_LABEL.': Page Sections';

    $this->templates->inspinia($data);
  }

/*---------------------------- End function sections -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function UPDATESECTION ----------------------------*/
/*----------------------------------------------------------------------------*/

  function updatesection(){ // heading, subtitle and menu label of one section

    $this->_check_access();

    $section = $this->model->get_where(intval(segment(3)), 'cms_sections');
    if(!$section){
        set_flashdata('That section was not found.');
        redirect('cms-content/sections');
    }

    $data = (array) $section;
    if(!empty($_SESSION['cms_retry'])){ // failed validation: show what was typed
        $data = array_merge($data, $_SESSION['cms_retry']);
        unset($_SESSION['cms_retry']);
    }
    $layouts             = $this->_layouts();
    $data['layout_desc'] = $layouts[$section->layout][0] ?? $section->layout;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'sectioncrud';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = 'Edit Section';
    $data['header'] = 'Edit Section: '.$section->title;

    $this->templates->inspinia($data);
  }

/*------------------------- End function updatesection -----------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function SECTIONSUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/

  function sectionsubmit(){

    $this->_check_access();
    $this->_check_token();

    $recid   = intval(segment(3));
    $section = $this->model->get_where($recid, 'cms_sections');
    if(!$section){
        set_flashdata('That section was not found.');
        redirect('cms-content/sections');
    }

    $post = array(
        'title'      => trim(post('title')),
        'subtitle'   => trim(post('subtitle')),
        'menu_label' => trim(post('menu_label')),
    );

    $errors = array();
    if($post['title'] === '' || mb_strlen($post['title']) > 150){ $errors[] = 'A heading of up to 150 characters is required.'; }
    if(mb_strlen($post['subtitle']) > 255)                        { $errors[] = 'The subtitle can be up to 255 characters.'; }
    if(mb_strlen($post['menu_label']) > 40)                       { $errors[] = 'The menu label can be up to 40 characters.'; }

    if(!empty($errors)){
        $_SESSION['cms_retry']     = $post;
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata(implode(' ', $errors));
        redirect('cms-content/updatesection/'.$recid);
    }

    $post['updated_by'] = intval($_SESSION['tg_user_id'] ?? 0);
    $post['updated_at'] = time();
    $this->model->update($recid, $post, 'cms_sections');
    $this->_audit('UpdateSection', $recid, 'cms_sections', $post['title']);

    $_SESSION['flashmsgcolor'] = 1;
    set_flashdata('The section was saved.');
    redirect('cms-content/sections');
  }

/*------------------------- End function sectionsubmit -----------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function TOGGLESECTION ----------------------------*/
/*----------------------------------------------------------------------------*/

  function togglesection(){ // AJAX: show on the member home / public website

    $this->_check_access(true);
    $this->_check_token(true);

    $recid = intval(post('recid'));
    $field = post('field');
    $value = (post('value') == 1) ? 1 : 0;

    if(!in_array($field, array('show_member', 'show_public'), true)){
        $this->_json(false, 'Unknown setting.');
    }
    $section = $this->model->get_where($recid, 'cms_sections');
    if(!$section){
        $this->_json(false, 'That section was not found.');
    }
    if($field == 'show_public' && $value == 1 && empty($section->allow_public)){
        $this->_json(false, $section->title.' is for the member home only.');
    }

    $this->model->update($recid, array($field => $value, 'updated_by' => intval($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'cms_sections');
    $this->_audit($value ? 'ShowSection' : 'HideSection', $recid, 'cms_sections', $section->title.' '.$field.'='.$value);

    $where = ($field == 'show_member') ? 'the '.CCMP.' home' : 'the public website';
    $this->_json(true, $section->title.($value ? ' now shows on ' : ' is now hidden from ').$where.'.');
  }

/*------------------------- End function togglesection -----------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------ function ORDERSECTIONS ----------------------------*/
/*----------------------------------------------------------------------------*/

  function ordersections(){ // AJAX: ids in their new order

    $this->_check_access(true);
    $this->_check_token(true);

    $ids = post('ids');
    if(!is_array($ids)){
        $this->_json(false, 'Nothing to order.');
    }
    $pos = 0;
    foreach($ids as $id){
        $pos += 10;
        $this->model->query_bind('UPDATE cms_sections SET sort_order = :pos WHERE id = :id', array('pos' => $pos, 'id' => intval($id)));
    }
    $this->_json(true, 'The new order was saved.');
  }

/*------------------------- End function ordersections -----------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function ITEMS -------------------------------*/
/*----------------------------------------------------------------------------*/

  function items(){ // the items in one section

    $this->_check_access();

    $section = $this->model->get_where(intval(segment(3)), 'cms_sections');
    $layouts = $this->_layouts();
    if(!$section || empty($layouts[$section->layout][1])){ // feeds have no items here
        set_flashdata('That section has no items to manage here.');
        redirect('cms-content/sections');
    }

    $rows = $this->model->query_bind("SELECT i.*, m.file_name, m.alt_text FROM cms_items i
                                        LEFT JOIN cms_media m ON m.id = i.media_id
                                       WHERE i.section_id = :sid ORDER BY i.sort_order, i.id",
                                     array('sid' => $section->id), 'object');
    foreach($rows as $row){
        $row->picture = $row->file_name ? $this->_media_url($row->file_name) : '';
    }

    $data['section']     = $section;
    $data['fields']      = $layouts[$section->layout][1];
    $data['layout_desc'] = $layouts[$section->layout][0];
    $data['itemrecs']    = $rows;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'items';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = $section->title;
    $data['header'] = $section->title.': Items';

    $this->templates->inspinia($data);
  }

/*----------------------------- End function items ---------------------------*/


/*----------------------------------------------------------------------------*/
/*--------------------- function CREATEITEM / UPDATEITEM ---------------------*/
/*----------------------------------------------------------------------------*/

  function createitem(){ // segment 3 = section id

    $this->_check_access();

    $section = $this->model->get_where(intval(segment(3)), 'cms_sections');
    if(!$section){
        set_flashdata('That section was not found.');
        redirect('cms-content/sections');
    }
    $this->_item_form($section, null);
  }

  function updateitem(){ // segment 3 = item id

    $this->_check_access();

    $item    = $this->model->get_where(intval(segment(3)), 'cms_items');
    $section = $item ? $this->model->get_where((int) $item->section_id, 'cms_sections') : false;
    if(!$section){
        set_flashdata('That item was not found.');
        redirect('cms-content/sections');
    }
    $this->_item_form($section, $item);
  }

/*--------------------- End function createitem / updateitem -----------------*/


/*----------------------------------------------------------------------------*/
/*--------------------------- function _ITEM_FORM ----------------------------*/
/*----------------------------------------------------------------------------*/

  function _item_form($section, $item){ // shared form for adding and changing an item

    $layouts = $this->_layouts();
    if(empty($layouts[$section->layout][1])){
        set_flashdata('That section has no items to manage here.');
        redirect('cms-content/sections');
    }

    $blank = array('id' => 0, 'heading' => '', 'subheading' => '', 'body' => '', 'icon' => '', 'media_id' => null,
                   'link_url' => '', 'link_label' => '', 'extra' => '', 'active' => 1);
    $data  = $item ? array_merge($blank, (array) $item) : $blank;
    if(!empty($_SESSION['cms_retry'])){ // failed validation: show what was typed
        $data = array_merge($data, $_SESSION['cms_retry']);
        unset($_SESSION['cms_retry']);
    }

    $media = $this->model->query("SELECT id, file_name, alt_text, original_name FROM cms_media ORDER BY id DESC", 'object');
    foreach($media as $m){
        $m->url = $this->_media_url($m->file_name);
    }
    $picked = '';
    foreach($media as $m){
        if((int) $m->id === (int) $data['media_id']){ $picked = $m->url; }
    }

    $data['recid']       = $item ? (int) $item->id : 0;
    $data['section']     = $section;
    $data['fields']      = $layouts[$section->layout][1];
    $data['layout_desc'] = $layouts[$section->layout][0];
    $data['mediarecs']   = $media;
    $data['picked_url']  = $picked;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'itemcrud';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = $section->title;
    $data['header'] = ($item ? 'Edit Item' : 'Add an Item').': '.$section->title;

    $this->templates->inspinia($data);
  }

/*-------------------------- End function _item_form -------------------------*/


/*----------------------------------------------------------------------------*/
/*--------------------------- function ITEMSUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/

  function itemsubmit(){ // segment 3 = item id when changing; post section_id when adding

    $this->_check_access();
    $this->_check_token();

    $recid = intval(segment(3));
    if($recid > 0){
        $item       = $this->model->get_where($recid, 'cms_items');
        $section_id = $item ? (int) $item->section_id : 0;
    }else{
        $section_id = intval(post('section_id'));
    }
    $section = $this->model->get_where($section_id, 'cms_sections');
    $layouts = $this->_layouts();
    if(!$section || empty($layouts[$section->layout][1])){
        set_flashdata('That section was not found.');
        redirect('cms-content/sections');
    }

    $post   = $this->_item_from_post();
    $errors = array();
    $limits = array('heading' => 150, 'subheading' => 255, 'icon' => 60, 'link_url' => 255, 'link_label' => 60, 'extra' => 100);
    foreach($limits as $field => $max){
        if(mb_strlen($post[$field]) > $max){ $errors[] = 'One of the fields is longer than '.$max.' characters.'; break; }
    }
    if($post['heading'] === '' && $post['body'] === '' && empty($post['media_id'])){
        $errors[] = 'Give the item at least a heading, some text or a picture.';
    }
    if($post['link_url'] !== '' && !$this->_valid_link($post['link_url'])){
        $errors[] = 'The link must start with https://, http://, mailto:, tel:, / or #.';
    }
    if($post['icon'] !== '' && !preg_match('/^fa-[a-z0-9-]+$/', $post['icon'])){
        $errors[] = 'The icon must be a Font Awesome name such as fa-plane.';
    }
    if(!empty($post['media_id']) && !$this->model->get_where((int) $post['media_id'], 'cms_media')){
        $post['media_id'] = null;
    }

    if(!empty($errors)){
        $_SESSION['cms_retry']     = $post;
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata(implode(' ', $errors));
        redirect($recid > 0 ? 'cms-content/updateitem/'.$recid : 'cms-content/createitem/'.$section->id);
    }

    $by = intval($_SESSION['tg_user_id'] ?? 0);
    $post['updated_by'] = $by;
    $post['updated_at'] = time();
    if($recid > 0){
        $this->model->update($recid, $post, 'cms_items');
        $this->_audit('UpdateItem', $recid, 'cms_items', $section->title.': '.$post['heading']);
        set_flashdata('The item was saved.');
    }else{
        $last = $this->model->query_bind('SELECT COALESCE(MAX(sort_order), 0) AS n FROM cms_items WHERE section_id = :sid', array('sid' => $section->id), 'object');
        $post['section_id'] = $section->id;
        $post['sort_order'] = (int) $last[0]->n + 10;
        $post['created_by'] = $by;
        $post['created_at'] = time();
        $recid = $this->model->insert($post, 'cms_items');
        $this->_audit('CreateItem', $recid, 'cms_items', $section->title.': '.$post['heading']);
        set_flashdata('The item was added.');
    }
    $_SESSION['flashmsgcolor'] = 1;
    redirect('cms-content/items/'.$section->id);
  }

/*-------------------------- End function itemsubmit -------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------- function TOGGLEITEM / ORDERITEMS --------------------*/
/*----------------------------------------------------------------------------*/

  function toggleitem(){ // AJAX: show or hide one item

    $this->_check_access(true);
    $this->_check_token(true);

    $recid = intval(post('recid'));
    $value = (post('value') == 1) ? 1 : 0;
    $item  = $this->model->get_where($recid, 'cms_items');
    if(!$item){
        $this->_json(false, 'That item was not found.');
    }
    $this->model->update($recid, array('active' => $value, 'updated_by' => intval($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'cms_items');
    $this->_json(true, $value ? 'The item is shown.' : 'The item is hidden.');
  }

  function orderitems(){ // AJAX: ids in their new order

    $this->_check_access(true);
    $this->_check_token(true);

    $ids = post('ids');
    if(!is_array($ids)){
        $this->_json(false, 'Nothing to order.');
    }
    $pos = 0;
    foreach($ids as $id){
        $pos += 10;
        $this->model->query_bind('UPDATE cms_items SET sort_order = :pos WHERE id = :id', array('pos' => $pos, 'id' => intval($id)));
    }
    $this->_json(true, 'The new order was saved.');
  }

/*-------------------- End function toggleitem / orderitems ------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------------- function DELITEM ------------------------------*/
/*----------------------------------------------------------------------------*/

  function delitem(){ // POST from the items page

    $this->_check_access();
    $this->_check_token();

    $item = $this->model->get_where(intval(post('recid')), 'cms_items');
    if(!$item){
        set_flashdata('That item was not found.');
        redirect('cms-content/sections');
    }
    $this->model->delete($item->id, 'cms_items');
    $this->_audit('DeleteItem', $item->id, 'cms_items', $item->heading);

    $_SESSION['flashmsgcolor'] = 1;
    set_flashdata('The item was deleted.');
    redirect('cms-content/items/'.$item->section_id);
  }

/*---------------------------- End function delitem --------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function MEDIA -------------------------------*/
/*----------------------------------------------------------------------------*/

  function media(){ // the picture library

    $this->_check_access();

    $rows = $this->model->query("SELECT m.*,
                                        (SELECT COUNT(*) FROM cms_items i WHERE i.media_id = m.id)
                                      + (SELECT COUNT(*) FROM cms_posts p WHERE p.media_id = m.id)
                                      + (SELECT COUNT(*) FROM events e    WHERE e.media_id = m.id) AS used
                                   FROM cms_media m ORDER BY m.id DESC", 'object');
    foreach($rows as $row){
        $row->url = $this->_media_url($row->file_name);
    }

    $data['mediarecs']   = $rows;
    $data['token']       = $this->_token();
    $data['max_mb']      = round($this->max_bytes / 1048576);

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'media';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = 'Pictures';
    $data['header'] = CMS_LABEL.': Pictures';

    $this->templates->inspinia($data);
  }

/*----------------------------- End function media ---------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function UPLOADMEDIA ----------------------------*/
/*----------------------------------------------------------------------------*/

  function uploadmedia(){ // one or more pictures from the Pictures page

    $this->_check_access();
    $this->_check_token();

    $files = $_FILES['pictures'] ?? null;
    if(!$files || !is_array($files['name'])){
        set_flashdata('Choose one or more pictures first.');
        redirect('cms-content/media');
    }

    $saved = 0;
    $problems = array();
    foreach($files['name'] as $i => $name){
        if($files['error'][$i] === UPLOAD_ERR_NO_FILE){ continue; }
        $result = $this->_save_upload(array(
            'name'     => $name,
            'tmp_name' => $files['tmp_name'][$i],
            'error'    => $files['error'][$i],
            'size'     => $files['size'][$i],
        ));
        if(is_string($result)){
            $problems[] = out($name).': '.$result; // flash messages print as HTML
        }else{
            $saved++;
            $this->_audit('UploadPicture', $result, 'cms_media', $name);
        }
    }

    $msg = $saved.' picture'.($saved == 1 ? '' : 's').' uploaded.';
    if(!empty($problems)){
        $msg .= ' Not uploaded - '.implode('; ', $problems);
    }
    $_SESSION['flashmsgcolor'] = empty($problems) ? 1 : 0;
    set_flashdata($msg);
    redirect('cms-content/media');
  }

/*------------------------- End function uploadmedia -------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------- function UPDATEMEDIA / DELMEDIA ---------------------*/
/*----------------------------------------------------------------------------*/

  function updatemedia(){ // AJAX: the picture's description (alt text)

    $this->_check_access(true);
    $this->_check_token(true);

    $recid = intval(post('recid'));
    $alt   = trim(post('alt_text'));
    if(!$this->model->get_where($recid, 'cms_media')){
        $this->_json(false, 'That picture was not found.');
    }
    if(mb_strlen($alt) > 255){
        $this->_json(false, 'The description can be up to 255 characters.');
    }
    $this->model->update($recid, array('alt_text' => $alt, 'updated_by' => intval($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'cms_media');
    $this->_json(true, 'The description was saved.');
  }

  function delmedia(){ // POST from the Pictures page; refused while something uses it

    $this->_check_access();
    $this->_check_token();

    $media = $this->model->get_where(intval(post('recid')), 'cms_media');
    if(!$media){
        set_flashdata('That picture was not found.');
        redirect('cms-content/media');
    }
    $used = $this->model->query_bind("SELECT (SELECT COUNT(*) FROM cms_items WHERE media_id = :a)
                                           + (SELECT COUNT(*) FROM cms_posts WHERE media_id = :b)
                                           + (SELECT COUNT(*) FROM events    WHERE media_id = :c) AS n",
                                     array('a' => $media->id, 'b' => $media->id, 'c' => $media->id), 'object');
    if((int) $used[0]->n > 0){
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata('That picture is still used on the site. Choose another picture there first.');
        redirect('cms-content/media');
    }

    $this->model->delete($media->id, 'cms_media');
    $path = APPPATH.$this->upload_dir.basename($media->file_name);
    if(is_file($path)){
        unlink($path);
    }
    $this->_audit('DeletePicture', $media->id, 'cms_media', $media->original_name);

    $_SESSION['flashmsgcolor'] = 1;
    set_flashdata('The picture was deleted.');
    redirect('cms-content/media');
  }

/*-------------------- End function updatemedia / delmedia -------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function POSTS -------------------------------*/
/*----------------------------------------------------------------------------*/

  function posts(){ // segment 3 = sunshine | bulletin | marquee | job

    $this->_check_access();

    $kind  = segment(3);
    $kinds = $this->_kinds();
    if(!isset($kinds[$kind])){
        redirect('cms-content/sections');
    }

    $rows = $this->model->query_bind("SELECT p.*, m.file_name, m.alt_text FROM cms_posts p
                                        LEFT JOIN cms_media m ON m.id = p.media_id
                                       WHERE p.kind = :kind ORDER BY p.sort_order, p.id DESC",
                                     array('kind' => $kind), 'object');
    $chapters = $this->_chapters();
    $today    = date('Y-m-d');
    foreach($rows as $row){
        $row->picture = $row->file_name ? $this->_media_url($row->file_name) : '';
        $row->chapter = $row->subentity_id > 0 ? ($chapters[$row->subentity_id] ?? SUBENTITY.' '.$row->subentity_id) : 'National';
        // what a visitor sees today: hidden, scheduled, expired or showing
        if(!$row->active)                                           { $row->status = 'Hidden'; }
        elseif($row->starts_on && $row->starts_on > $today)         { $row->status = 'Starts '.date('M j', strtotime($row->starts_on)); }
        elseif($row->ends_on && $row->ends_on < $today)             { $row->status = 'Ended '.date('M j', strtotime($row->ends_on)); }
        else                                                        { $row->status = 'Showing'; }
    }

    $data['kind']        = $kind;
    $data['k']           = $kinds[$kind];
    $data['postrecs']    = $rows;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'posts';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = $kinds[$kind]['title'];
    $data['header'] = CMS_LABEL.': '.$kinds[$kind]['title'];

    $this->templates->inspinia($data);
  }

/*----------------------------- End function posts ---------------------------*/


/*----------------------------------------------------------------------------*/
/*--------------------- function CREATEPOST / UPDATEPOST ---------------------*/
/*----------------------------------------------------------------------------*/

  function createpost(){ // segment 3 = kind

    $this->_check_access();

    $kind = segment(3);
    if(!isset($this->_kinds()[$kind])){
        redirect('cms-content/sections');
    }
    $this->_post_form($kind, null);
  }

  function updatepost(){ // segment 3 = post id

    $this->_check_access();

    $post = $this->model->get_where(intval(segment(3)), 'cms_posts');
    if(!$post || !isset($this->_kinds()[$post->kind])){
        set_flashdata('That post was not found.');
        redirect('cms-content/sections');
    }
    $this->_post_form($post->kind, $post);
  }

/*-------------------- End function createpost / updatepost ------------------*/


/*----------------------------------------------------------------------------*/
/*--------------------------- function _POST_FORM ----------------------------*/
/*----------------------------------------------------------------------------*/

  function _post_form($kind, $post){

    $kinds = $this->_kinds();
    $blank = array('id' => 0, 'title' => '', 'summary' => '', 'body' => '', 'location' => '', 'link_url' => '', 'link_label' => '',
                   'media_id' => null, 'color' => 'yellow', 'subentity_id' => 0, 'is_public' => 0, 'active' => 1, 'starts_on' => '', 'ends_on' => '');
    $data  = $post ? array_merge($blank, (array) $post) : $blank;
    if(!empty($_SESSION['cms_retry'])){ // failed validation: show what was typed
        $data = array_merge($data, $_SESSION['cms_retry']);
        unset($_SESSION['cms_retry']);
    }

    $media = $this->model->query("SELECT id, file_name, alt_text, original_name FROM cms_media ORDER BY id DESC", 'object');
    $picked = '';
    foreach($media as $m){
        $m->url = $this->_media_url($m->file_name);
        if((int) $m->id === (int) $data['media_id']){ $picked = $m->url; }
    }

    $data['recid']       = $post ? (int) $post->id : 0;
    $data['kind']        = $kind;
    $data['k']           = $kinds[$kind];
    $data['chapters']    = $this->_chapters();
    $data['colors']      = array('yellow' => 'Yellow', 'green' => 'Green', 'blue' => 'Blue', 'pink' => 'Pink');
    $data['mediarecs']   = $media;
    $data['picked_url']  = $picked;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'postcrud';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = $kinds[$kind]['title'];
    $data['header'] = ($post ? 'Edit ' : 'Add ').$kinds[$kind]['one'];

    $this->templates->inspinia($data);
  }

/*-------------------------- End function _post_form -------------------------*/


/*----------------------------------------------------------------------------*/
/*--------------------------- function POSTSUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/

  function postsubmit(){ // segment 3 = post id when changing; post kind when adding

    $this->_check_access();
    $this->_check_token();

    $recid = intval(segment(3));
    $kinds = $this->_kinds();
    if($recid > 0){
        $old  = $this->model->get_where($recid, 'cms_posts');
        $kind = $old ? $old->kind : '';
    }else{
        $kind = post('kind');
    }
    if(!isset($kinds[$kind])){
        set_flashdata('That post was not found.');
        redirect('cms-content/sections');
    }

    $post   = $this->_post_from_post($kind);
    $errors = array();
    if($post['title'] === '' || mb_strlen($post['title']) > 150){ $errors[] = $kinds[$kind]['fields']['title'].' is required (up to 150 characters).'; }
    if(mb_strlen($post['summary']) > 500)                        { $errors[] = 'The short text can be up to 500 characters.'; }
    foreach(array('location' => 150, 'link_url' => 255, 'link_label' => 60) as $field => $max){
        if(mb_strlen($post[$field]) > $max){ $errors[] = 'One of the fields is longer than '.$max.' characters.'; }
    }
    if($post['link_url'] !== '' && !$this->_valid_link($post['link_url'])){
        $errors[] = 'The link must start with https://, http://, mailto:, tel:, / or #.';
    }
    foreach(array('starts_on', 'ends_on') as $field){
        if($post[$field] !== null && !(preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $post[$field], $d) && checkdate((int) $d[2], (int) $d[3], (int) $d[1]))){
            $errors[] = 'Dates must be real dates.';
            break;
        }
    }
    if($post['starts_on'] && $post['ends_on'] && $post['ends_on'] < $post['starts_on']){
        $errors[] = 'The end date is before the start date.';
    }
    if($post['subentity_id'] > 0 && !isset($this->_chapters()[$post['subentity_id']])){
        $post['subentity_id'] = 0;
    }
    if(!empty($post['media_id']) && !$this->model->get_where((int) $post['media_id'], 'cms_media')){
        $post['media_id'] = null;
    }

    if(!empty($errors)){
        $_SESSION['cms_retry']     = $post;
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata(out(implode(' ', array_unique($errors))));
        redirect($recid > 0 ? 'cms-content/updatepost/'.$recid : 'cms-content/createpost/'.$kind);
    }

    $by = intval($_SESSION['tg_user_id'] ?? 0);
    $post['updated_by'] = $by;
    $post['updated_at'] = time();
    if($recid > 0){
        $this->model->update($recid, $post, 'cms_posts');
        $this->_audit('UpdatePost', $recid, 'cms_posts', $kind.': '.$post['title']);
        set_flashdata(out($kinds[$kind]['one']).' saved.');
    }else{
        $first = $this->model->query_bind('SELECT COALESCE(MIN(sort_order), 0) AS n FROM cms_posts WHERE kind = :kind', array('kind' => $kind), 'object');
        $post['kind']       = $kind;
        $post['sort_order'] = (int) $first[0]->n - 10; // new posts go to the top
        $post['created_by'] = $by;
        $post['created_at'] = time();
        $recid = $this->model->insert($post, 'cms_posts');
        $this->_audit('CreatePost', $recid, 'cms_posts', $kind.': '.$post['title']);
        set_flashdata(out($kinds[$kind]['one']).' added.');
    }
    $_SESSION['flashmsgcolor'] = 1;
    redirect('cms-content/posts/'.$kind);
  }

/*-------------------------- End function postsubmit -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------- function TOGGLEPOST / ORDERPOSTS / DELPOST -------------*/
/*----------------------------------------------------------------------------*/

  function togglepost(){ // AJAX: show or hide one post

    $this->_check_access(true);
    $this->_check_token(true);

    $recid = intval(post('recid'));
    $value = (post('value') == 1) ? 1 : 0;
    if(!$this->model->get_where($recid, 'cms_posts')){
        $this->_json(false, 'That post was not found.');
    }
    $this->model->update($recid, array('active' => $value, 'updated_by' => intval($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'cms_posts');
    $this->_json(true, $value ? 'The post is shown.' : 'The post is hidden.');
  }

  function orderposts(){ // AJAX: ids in their new order

    $this->_check_access(true);
    $this->_check_token(true);

    $ids = post('ids');
    if(!is_array($ids)){
        $this->_json(false, 'Nothing to order.');
    }
    $pos = 0;
    foreach($ids as $id){
        $pos += 10;
        $this->model->query_bind('UPDATE cms_posts SET sort_order = :pos WHERE id = :id', array('pos' => $pos, 'id' => intval($id)));
    }
    $this->_json(true, 'The new order was saved.');
  }

  function delpost(){ // POST from the posts list

    $this->_check_access();
    $this->_check_token();

    $post = $this->model->get_where(intval(post('recid')), 'cms_posts');
    if(!$post){
        set_flashdata('That post was not found.');
        redirect('cms-content/sections');
    }
    $this->model->delete($post->id, 'cms_posts');
    $this->_audit('DeletePost', $post->id, 'cms_posts', $post->kind.': '.$post->title);

    $_SESSION['flashmsgcolor'] = 1;
    set_flashdata('The post was deleted.');
    redirect('cms-content/posts/'.$post->kind);
  }

/*------------------ End function togglepost / orderposts / delpost ----------*/


/*----------------------------------------------------------------------------*/
/*------------------------------ function JOB --------------------------------*/
/*----------------------------------------------------------------------------*/

  function job(){ // a job's detail page; anyone logged in (the public website gets its own in phase 6)

    if(empty($_SESSION['trongatetoken'])){
        redirect('welcome/login');
    }

    $today = date('Y-m-d');
    $rows  = $this->model->query_bind("SELECT p.*, m.file_name, m.alt_text FROM cms_posts p
                                         LEFT JOIN cms_media m ON m.id = p.media_id
                                        WHERE p.id = :id AND p.kind = 'job' AND p.active = 1
                                          AND (p.starts_on IS NULL OR p.starts_on <= :t1)
                                          AND (p.ends_on IS NULL OR p.ends_on >= :t2)",
                                      array('id' => intval(segment(3)), 't1' => $today, 't2' => $today), 'object');
    if(empty($rows)){
        set_flashdata('That job posting is no longer open.');
        redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome');
    }
    $job          = $rows[0];
    $job->picture = $job->file_name ? $this->_media_url($job->file_name) : '';

    $data['job']         = $job;
    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'job';

    $data['bc1']    = 'Careers';
    $data['bc2']    = $job->title;
    $data['header'] = $job->title;

    $this->templates->inspinia($data);
  }

/*------------------------------ End function job ----------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------- function EVENTS ------------------------------*/
/*----------------------------------------------------------------------------*/

  function events(){ // segment 3 = 'past' for events that are over

    $scope = $this->_event_scope();
    $past  = (segment(3) == 'past');

    $params = array('now' => date('Y-m-d 00:00:00'));
    $where  = $past ? 'COALESCE(e.end_at, e.start_at) < :now' : 'COALESCE(e.end_at, e.start_at) >= :now';
    if($scope !== 'all'){
        $where .= ' AND e.subentity_id = :sub';
        $params['sub'] = $scope;
    }
    $rows = $this->model->query_bind("SELECT e.* FROM events e WHERE $where ORDER BY e.start_at ".($past ? 'DESC' : 'ASC')." LIMIT 500", $params, 'object');
    $chapters = $this->_chapters();
    foreach($rows as $row){
        $row->chapter = $row->subentity_id > 0 ? ($chapters[$row->subentity_id] ?? SUBENTITY.' '.$row->subentity_id) : 'National';
    }

    $data['eventrecs']   = $rows;
    $data['past']        = $past;
    $data['scope_name']  = $scope === 'all' ? '' : ($chapters[$scope] ?? '');
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'events';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = 'Events';
    $data['header'] = ($scope === 'all' ? 'Events' : out($data['scope_name']).' Events').($past ? ' (past)' : '');

    $this->templates->inspinia($data);
  }

/*----------------------------- End function events --------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------- function CREATEEVENT / UPDATEEVENT --------------------*/
/*----------------------------------------------------------------------------*/

  function createevent(){
    $this->_event_scope();
    $this->_event_form(null);
  }

  function updateevent(){ // segment 3 = event id

    $scope = $this->_event_scope();
    $event = $this->model->get_where(intval(segment(3)), 'events');
    if(!$event || ($scope !== 'all' && (int) $event->subentity_id !== $scope)){
        set_flashdata('That event was not found.');
        redirect('cms-content/events');
    }
    $this->_event_form($event);
  }

/*------------------- End function createevent / updateevent -----------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function _EVENT_FORM ----------------------------*/
/*----------------------------------------------------------------------------*/

  function _event_form($event){

    $scope = $this->_event_scope();
    $blank = array('id' => 0, 'title' => '', 'summary' => '', 'description' => '', 'location' => '', 'all_day' => 0,
                   'subentity_id' => ($scope === 'all' ? 0 : $scope), 'is_public' => 0, 'media_id' => null, 'link_url' => '', 'link_label' => '',
                   'start_date' => date('Y-m-d', strtotime('+7 days')), 'start_time' => '09:00', 'end_date' => '', 'end_time' => '');
    $data = $blank;
    if($event){
        $data = array_merge($blank, (array) $event);
        $data['start_date'] = substr($event->start_at, 0, 10);
        $data['start_time'] = substr($event->start_at, 11, 5);
        $data['end_date']   = $event->end_at ? substr($event->end_at, 0, 10) : '';
        $data['end_time']   = $event->end_at ? substr($event->end_at, 11, 5) : '';
    }
    if(!empty($_SESSION['cms_retry'])){ // failed validation: show what was typed
        $data = array_merge($data, $_SESSION['cms_retry']);
        unset($_SESSION['cms_retry']);
    }

    $media = $this->model->query("SELECT id, file_name, alt_text, original_name FROM cms_media ORDER BY id DESC", 'object');
    $picked = '';
    foreach($media as $m){
        $m->url = $this->_media_url($m->file_name);
        if((int) $m->id === (int) $data['media_id']){ $picked = $m->url; }
    }

    $data['recid']       = $event ? (int) $event->id : 0;
    $data['scope']       = $scope;
    $data['chapters']    = $this->_chapters();
    $data['mediarecs']   = $media;
    $data['picked_url']  = $picked;
    $data['token']       = $this->_token();

    $data['view_module'] = 'cms/content';
    $data['view_file']   = 'eventcrud';

    $data['bc1']    = CMS_LABEL;
    $data['bc2']    = 'Events';
    $data['header'] = $event ? 'Edit Event' : 'Add an Event';

    $this->templates->inspinia($data);
  }

/*-------------------------- End function _event_form ------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------- function EVENTSUBMIT ----------------------------*/
/*----------------------------------------------------------------------------*/

  function eventsubmit(){ // segment 3 = event id when changing

    $scope = $this->_event_scope();
    $this->_check_token();

    $recid = intval(segment(3));
    if($recid > 0){
        $old = $this->model->get_where($recid, 'events');
        if(!$old || ($scope !== 'all' && (int) $old->subentity_id !== $scope)){
            set_flashdata('That event was not found.');
            redirect('cms-content/events');
        }
    }

    $form = array(
        'title'        => trim(post('title')),
        'summary'      => trim(post('summary')),
        'description'  => trim(post('description')),
        'location'     => trim(post('location')),
        'all_day'      => post('all_day') == 1 ? 1 : 0,
        'subentity_id' => $scope === 'all' ? intval(post('subentity_id')) : $scope, // chapter admins: always their own chapter
        'is_public'    => post('is_public') == 1 ? 1 : 0,
        'media_id'     => intval(post('media_id')) > 0 ? intval(post('media_id')) : null,
        'link_url'     => trim(post('link_url')),
        'link_label'   => trim(post('link_label')),
        'start_date'   => trim(post('start_date')),
        'start_time'   => trim(post('start_time')),
        'end_date'     => trim(post('end_date')),
        'end_time'     => trim(post('end_time')),
    );

    $errors = array();
    $date_ok = function($d){ return preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $d, $m) && checkdate((int) $m[2], (int) $m[3], (int) $m[1]); };
    $time_ok = function($t){ return $t === '' || preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $t); };
    if($form['title'] === '' || mb_strlen($form['title']) > 150){ $errors[] = 'A title of up to 150 characters is required.'; }
    if(mb_strlen($form['summary']) > 500)  { $errors[] = 'The short description can be up to 500 characters.'; }
    if(mb_strlen($form['location']) > 150) { $errors[] = 'The location can be up to 150 characters.'; }
    if(mb_strlen($form['link_label']) > 60){ $errors[] = 'The button label can be up to 60 characters.'; }
    if(!$date_ok($form['start_date']))     { $errors[] = 'Choose the date the event starts.'; }
    if($form['end_date'] !== '' && !$date_ok($form['end_date'])){ $errors[] = 'The end date must be a real date.'; }
    if(!$time_ok($form['start_time']) || !$time_ok($form['end_time'])){ $errors[] = 'Times must be real times.'; }
    if($form['link_url'] !== '' && (mb_strlen($form['link_url']) > 255 || !$this->_valid_link($form['link_url']))){
        $errors[] = 'The link must start with https://, http://, mailto:, tel:, / or #.';
    }
    if($form['subentity_id'] > 0 && !isset($this->_chapters()[$form['subentity_id']])){ $form['subentity_id'] = 0; }
    if(!empty($form['media_id']) && !$this->model->get_where((int) $form['media_id'], 'cms_media')){ $form['media_id'] = null; }

    $start = $end = null;
    if(empty($errors)){
        $start = $form['start_date'].' '.($form['all_day'] || $form['start_time'] === '' ? '00:00' : $form['start_time']).':00';
        if($form['end_date'] !== '' || $form['end_time'] !== ''){
            $end_date = $form['end_date'] !== '' ? $form['end_date'] : $form['start_date'];
            $end = $end_date.' '.($form['all_day'] ? '23:59' : ($form['end_time'] !== '' ? $form['end_time'] : '23:59')).':00';
            if($end < $start){ $errors[] = 'The event ends before it starts.'; }
        }
    }

    if(!empty($errors)){
        $_SESSION['cms_retry']     = $form;
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata(out(implode(' ', $errors)));
        redirect($recid > 0 ? 'cms-content/updateevent/'.$recid : 'cms-content/createevent');
    }

    $by  = intval($_SESSION['tg_user_id'] ?? 0);
    $row = array(
        'title' => $form['title'], 'summary' => $form['summary'], 'description' => $form['description'], 'location' => $form['location'],
        'start_at' => $start, 'end_at' => $end, 'all_day' => $form['all_day'], 'subentity_id' => $form['subentity_id'],
        'is_public' => $form['is_public'], 'approved' => 1, 'media_id' => $form['media_id'],
        'link_url' => $form['link_url'], 'link_label' => $form['link_label'], 'updated_by' => $by, 'updated_at' => time(),
    );
    if($recid > 0){
        $this->model->update($recid, $row, 'events');
        $this->_audit('UpdateEvent', $recid, 'events', $row['title'].' '.$row['start_at']);
        set_flashdata('The event was saved.');
    }else{
        $row['created_by'] = $by;
        $row['created_at'] = time();
        $recid = $this->model->insert($row, 'events');
        $this->_audit('CreateEvent', $recid, 'events', $row['title'].' '.$row['start_at']);
        set_flashdata('The event was added.');
    }
    $_SESSION['flashmsgcolor'] = 1;
    redirect('cms-content/events');
  }

/*-------------------------- End function eventsubmit ------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------------- function DELEVENT -----------------------------*/
/*----------------------------------------------------------------------------*/

  function delevent(){ // POST from the events list

    $scope = $this->_event_scope();
    $this->_check_token();

    $event = $this->model->get_where(intval(post('recid')), 'events');
    if(!$event || ($scope !== 'all' && (int) $event->subentity_id !== $scope)){
        set_flashdata('That event was not found.');
        redirect('cms-content/events');
    }
    $this->model->delete($event->id, 'events');
    $this->_audit('DeleteEvent', $event->id, 'events', $event->title.' '.$event->start_at);

    $_SESSION['flashmsgcolor'] = 1;
    set_flashdata('The event was deleted.');
    redirect('cms-content/events');
  }

/*---------------------------- End function delevent -------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------------- function _LAYOUTS -----------------------------*/
/*----------------------------------------------------------------------------*/

  function _layouts(){
    // layout => array(what it is, item fields => label on the item form, or null when the
    // content comes from elsewhere, where it comes from, and the post kind when it is a cms_posts list).
    // Field names are cms_items columns.
    $features = array('heading' => 'Title', 'body' => 'Text', 'icon' => 'Icon', 'media_id' => 'Picture');
    return array(
        'slider'       => array('Large picture slides with a headline', array('heading' => 'Headline', 'subheading' => 'Text under the headline', 'media_id' => 'Picture', 'link_url' => 'Button link', 'link_label' => 'Button label')),
        'services'     => array('A row of short boxes', array('heading' => 'Title', 'body' => 'Text', 'link_url' => 'Link', 'link_label' => 'Link label')),
        'features'     => array('Features beside a picture', $features),
        'features2'    => array('Features beside a picture', $features),
        'features3'    => array('Features beside a picture', $features),
        'team'         => array('People with photos', array('heading' => 'Name', 'subheading' => 'Role or title', 'body' => 'Short bio', 'media_id' => 'Photo', 'link_url' => 'Profile link')),
        'timeline'     => array('Steps in order', array('heading' => 'Step', 'body' => 'Text', 'icon' => 'Icon', 'extra' => 'Time or date label')),
        'testimonials' => array('One large quote', array('body' => 'Quote', 'heading' => 'Who said it', 'subheading' => 'Their role')),
        'comments'     => array('Quotes with photos', array('body' => 'Quote', 'heading' => 'Name', 'subheading' => 'Organization', 'media_id' => 'Photo')),
        'pricing'      => array('Plans and prices', array('heading' => 'Plan name', 'extra' => 'Price', 'subheading' => 'Price note (e.g. per year)', 'body' => 'What is included (one per line)', 'link_url' => 'Sign-up link', 'link_label' => 'Button label')),
        'contact'      => array('Contact details', array('heading' => 'Name or office', 'body' => 'Address (one line each)', 'extra' => 'Phone', 'link_url' => 'Email or web link', 'link_label' => 'Link label')),
        'marquee'      => array('A scrolling line of announcements', null, 'the Marquee page', 'marquee'),
        'sunshine'     => array('Illnesses and passings', null, 'the Sunshine page', 'sunshine'),
        'bulletins'    => array('Sticky notes', null, 'the Bulletin Board page', 'bulletin'),
        'careers'      => array('Job postings with detail pages', null, 'the Careers page', 'job'),
        'calendar'     => array('Events calendar', null, 'the Events page'),
        'metrics'      => array(CCMP.' numbers (automatic)', null, CCMP.' records, counted when the page opens'),
    );
  }

/*---------------------------- End function _layouts -------------------------*/


/*----------------------------------------------------------------------------*/
/*------------------------- ACCESS, TOKENS, HELPERS --------------------------*/
/*----------------------------------------------------------------------------*/

  function _check_access($ajax = false){ // logged in (either login) and allowed to manage content
    if(empty($_SESSION['trongatetoken'])){
        if($ajax){ $this->_json(false, 'Your session has expired - please log in again.'); }
        set_flashdata('Your Session has expired - please login again.');
        redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout');
    }
    if(!rbac_allowed('cms', 'manage_content')){
        if($ajax){ $this->_json(false, 'You are not allowed to manage the '.strtolower(CMS_LABEL).'.'); }
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata('You are not allowed to manage the '.strtolower(CMS_LABEL).'.');
        redirect($this->_home_url());
    }
  }

  function _home_url(){ // where Home and Close go: staff dashboard or member home
    return !empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome';
  }

  function _token(){
    if(empty($_SESSION['cms_token'])){
        $_SESSION['cms_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['cms_token'];
  }

  function _check_token($ajax = false){
    if(empty($_SESSION['cms_token']) || !hash_equals($_SESSION['cms_token'], (string) post('token'))){
        if($ajax){ $this->_json(false, 'Page expired - please reload it.'); }
        $_SESSION['flashmsgcolor'] = 0;
        set_flashdata('That page had expired - please try again.');
        redirect('cms-content/sections');
    }
  }

  function _event_scope(){
    // who may manage which events: 'all' (cms/manage_events: Event Admins, System Admins) or the
    // member's own chapter id (cms/chapter_events: Chapter Admins); anyone else goes home
    if(empty($_SESSION['trongatetoken'])){
        set_flashdata('Your Session has expired - please login again.');
        redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho/logout' : 'welcome/logout');
    }
    if(rbac_allowed('cms', 'manage_events')){
        return 'all';
    }
    $chapter = intval($_SESSION['ccmps_subentity'] ?? 0);
    if(empty($_SESSION['honcho_logged_in']) && $chapter > 0 && rbac_allowed('cms', 'chapter_events')){
        return $chapter;
    }
    $_SESSION['flashmsgcolor'] = 0;
    set_flashdata('You are not allowed to manage events.');
    redirect($this->_home_url());
  }

  function _kinds(){
    // post kind => list title, one post's name, icon, and the cms_posts fields its form shows (field => label)
    return array(
        'sunshine' => array('title' => 'Sunshine', 'one' => 'Sunshine Post', 'icon' => 'fa-heart',
                            'about' => 'Illnesses, recoveries and passings in our family. Shown in the Sunshine section.',
                            'fields' => array('title' => 'Name', 'summary' => 'News (e.g. is recovering at home after surgery)', 'body' => 'More details (service times, where to send cards)',
                                              'media_id' => 'Photo', 'link_url' => 'Link (e.g. obituary)', 'link_label' => 'Link label', 'subentity_id' => SUBENTITY, 'dates' => 'Show')),
        'bulletin' => array('title' => 'Bulletin Board', 'one' => 'Sticky Note', 'icon' => 'fa-thumb-tack',
                            'about' => 'Short notes shown as sticky notes on the Bulletin Board.',
                            'fields' => array('title' => 'Heading', 'summary' => 'Note', 'color' => 'Colour', 'link_url' => 'Link', 'link_label' => 'Link label', 'subentity_id' => SUBENTITY, 'dates' => 'Show')),
        'marquee'  => array('title' => 'Marquee', 'one' => 'Marquee Line', 'icon' => 'fa-ellipsis-h',
                            'about' => 'Short announcements that scroll across the Marquee line.',
                            'fields' => array('title' => 'Announcement', 'link_url' => 'Link', 'subentity_id' => SUBENTITY, 'dates' => 'Show')),
        'job'      => array('title' => 'Careers', 'one' => 'Job Posting', 'icon' => 'fa-briefcase',
                            'about' => 'Job postings. Each has its own page with the full description.',
                            'fields' => array('title' => 'Job title', 'location' => 'Employer and location', 'summary' => 'Short description (shown in the list)', 'body' => 'Full description',
                                              'media_id' => 'Logo or picture', 'link_url' => 'How to apply (link)', 'link_label' => 'Apply button label', 'subentity_id' => SUBENTITY, 'dates' => 'Open')),
    );
  }

  function _chapters(){ // id => name, for the chapter picker and lists
    $rows = $this->model->query("SELECT id, COALESCE(NULLIF(description, ''), chapter_title) AS name FROM ccmps_subentities ORDER BY name", 'object');
    $list = array();
    foreach($rows as $row){
        $list[(int) $row->id] = (string) $row->name;
    }
    return $list;
  }

  function _post_from_post($kind){
    $media_id = intval(post('media_id'));
    $fields   = $this->_kinds()[$kind]['fields'];
    $date     = function($name){ $v = trim(post($name)); return $v === '' ? null : $v; };
    return array(
        'title'        => trim(post('title')),
        'summary'      => isset($fields['summary'])  ? trim(post('summary'))  : '',
        'body'         => isset($fields['body'])     ? trim(post('body'))     : '',
        'location'     => isset($fields['location']) ? trim(post('location')) : '',
        'link_url'     => trim(post('link_url')),
        'link_label'   => isset($fields['link_label']) ? trim(post('link_label')) : '',
        'media_id'     => (isset($fields['media_id']) && $media_id > 0) ? $media_id : null,
        'color'        => isset($fields['color']) && in_array(post('color'), array('yellow', 'green', 'blue', 'pink'), true) ? post('color') : '',
        'subentity_id' => intval(post('subentity_id')),
        'is_public'    => post('is_public') == 1 ? 1 : 0,
        'active'       => post('active') == 1 ? 1 : 0,
        'starts_on'    => $date('starts_on'),
        'ends_on'      => $date('ends_on'),
    );
  }

  function _item_from_post(){
    $media_id = intval(post('media_id'));
    return array(
        'heading'    => trim(post('heading')),
        'subheading' => trim(post('subheading')),
        'body'       => trim(post('body')),
        'icon'       => trim(post('icon')),
        'media_id'   => $media_id > 0 ? $media_id : null,
        'link_url'   => trim(post('link_url')),
        'link_label' => trim(post('link_label')),
        'extra'      => trim(post('extra')),
        'active'     => post('active') == 1 ? 1 : 0,
    );
  }

  function _valid_link($url){ // web, email and phone links, a page on this site, or a section (#)
    return (bool) preg_match('~^(https?://|mailto:|tel:|/|#)~i', $url);
  }

  function _save_upload($file){ // returns the new cms_media id, or a message saying why not
    if($file['error'] !== UPLOAD_ERR_OK){
        return ($file['error'] == UPLOAD_ERR_INI_SIZE || $file['error'] == UPLOAD_ERR_FORM_SIZE) ? 'too large' : 'the upload failed';
    }
    if($file['size'] > $this->max_bytes){
        return 'larger than '.round($this->max_bytes / 1048576).' MB';
    }
    $types = array('image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp');
    $mime  = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if(!isset($types[$mime])){
        return 'not a JPEG, PNG, GIF or WebP picture';
    }
    $size = @getimagesize($file['tmp_name']);
    if(!$size){
        return 'the picture could not be read';
    }

    $dir = APPPATH.$this->upload_dir;
    if(!is_dir($dir) && !mkdir($dir, 0755, true)){
        return 'the pictures folder could not be created';
    }
    $stored = date('Ymd').'-'.bin2hex(random_bytes(6)).'.'.$types[$mime];
    $target = $dir.$stored;
    list($width, $height) = $size;

    // shrink large JPEG/PNG pictures so pages load quickly (GD); others are kept as they are
    $shrunk = false;
    if($width > $this->max_width && in_array($mime, array('image/jpeg', 'image/png'), true) && function_exists('imagecreatetruecolor')){
        $src = ($mime == 'image/jpeg') ? @imagecreatefromjpeg($file['tmp_name']) : @imagecreatefrompng($file['tmp_name']);
        if($src){
            $new_h = (int) round($height * $this->max_width / $width);
            $dst   = imagecreatetruecolor($this->max_width, $new_h);
            if($mime == 'image/png'){
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
            }
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $this->max_width, $new_h, $width, $height);
            $shrunk = ($mime == 'image/jpeg') ? imagejpeg($dst, $target, 85) : imagepng($dst, $target, 6);
            imagedestroy($src);
            imagedestroy($dst);
            if($shrunk){
                $width  = $this->max_width;
                $height = $new_h;
            }
        }
    }
    if(!$shrunk && !move_uploaded_file($file['tmp_name'], $target)){
        return 'the picture could not be saved';
    }
    chmod($target, 0644);

    $base = pathinfo($file['name'], PATHINFO_FILENAME);
    $by   = intval($_SESSION['tg_user_id'] ?? 0);
    return $this->model->insert(array(
        'file_name'     => $stored,
        'original_name' => mb_substr($file['name'], 0, 255),
        'alt_text'      => mb_substr(ucfirst(trim(preg_replace('/[-_]+/', ' ', $base))), 0, 255), // a start; edit it on the Pictures page
        'mime'          => $mime,
        'width'         => $width,
        'height'        => $height,
        'bytes'         => (int) filesize($target),
        'created_by'    => $by,
        'created_at'    => time(),
    ), 'cms_media');
  }

  function _media_url($file_name){
    return BASE_URL.'uploads/cms/'.rawurlencode($file_name);
  }

  function _json($ok, $msg){
    header('Content-Type: application/json');
    echo json_encode(array('ok' => $ok, 'msg' => $msg));
    die();
  }

  function _audit($action, $recid, $table, $what){
    $un = !empty($_SESSION['honcho_logged_in']) ? 'UN: '.($_SESSION['honcho_username'] ?? '') : 'UN: '.($_SESSION['ccmp_username'] ?? '');
    $this->module('timedate');
    $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
    $this->module('system-auditlogger');
    $this->auditlogger->logevent('update', $action, 'cms-content', $un, $time, 'Rec: '.$recid, 'Tbl: '.$table, mb_substr((string) $what, 0, 200));
  }

/*----------------------------------------------------------------------------*/

} // end controller
