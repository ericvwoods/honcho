<?php
/*
  RBAC helper - one permission check for every module (Honcho RBAC plan, 2026-10-18)

  person (trongate_users.id) -> system_group_users -> system_groups (active)
         -> system_group_functions -> system_functions -> system_modules (enabled)

  rbac_allowed($module, $function)   true/false - for showing or hiding a link
  rbac_require($module, $function)   stops with a flash message if not allowed
  rbac_person($tg_user_id)           name, email and kind (staff/member) of one login
        _rbac_function_list()        everything the logged-in person may do, read once per page

  Who is always $_SESSION['tg_user_id'] (set by both logins), never the URL or a form.
  The database is read on every page (once, then remembered for that page), so a
  change on the Security screens works on the person's next click.
  RBAC answers WHAT someone may do; WHICH records (own chapter, own teams) stays
  in each module's queries.
*/

function rbac_allowed(string $module, string $function): bool {
    $allowed = _rbac_function_list();
    return isset($allowed[$module.'/'.$function]);
}

function rbac_require(string $module, string $function): void {
    if (rbac_allowed($module, $function)) {
        return;
    }

    if (empty($_SESSION['honcho_logged_in']) && empty($_SESSION['ccmp_logged_in'])) {
        redirect('welcome/logout'); // not logged in - clears everything then to login page
    }

    set_flashdata('You are not authorized to use that function. Contact the System Administrator.');
    $_SESSION['flashmsgcolor'] = 0; // crimson
    redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome');
}

function rbac_person(int $tg_user_id): object|false {
    // follows trongate_users to the account row; falls back to trongate_users.title, then the username, for the name
    $model = new Model();
    $tg = $model->get_where($tg_user_id, 'trongate_users');
    if (!$tg) {
        return false;
    }

    $kinds = array('honcho_user_accounts' => 'staff', 'ccmps' => 'member'); // only these tables are read
    $table = $tg->login_acct_info_table;

    $person = new stdClass();
    $person->tg_user_id = (int) $tg->id;
    $person->kind       = $kinds[$table] ?? 'unknown';
    $person->name       = '';
    $person->email      = '';

    if (isset($kinds[$table])) {
        $acct = $model->get_where((int) $tg->login_acct_table_id, $table);
        if ($acct) {
            $person->name  = trim(($acct->first_name ?? '').' '.($acct->last_name ?? ''));
            $person->email = $acct->email_address ?? '';
        }
    }

    if ($person->name == '') {
        $person->name = (string) $tg->title;
    }
    if ($person->name == '' && !empty($acct)) {
        $person->name = $acct->username ?? '';
    }
    return $person;
}

function _rbac_function_list(): array {
    // 'module/function' => true for the logged-in person; read once per page
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }

    $cache = array();
    $tg_user_id = (int) ($_SESSION['tg_user_id'] ?? 0);
    if ($tg_user_id < 1) {
        return $cache;
    }

    $sql = "SELECT DISTINCT m.code AS module_code, f.code AS function_code
              FROM system_group_users gu
              JOIN system_groups g           ON g.id = gu.group_id AND g.active = 1
              JOIN system_group_functions gf ON gf.group_id = g.id
              JOIN system_functions f        ON f.id = gf.function_id
              JOIN system_modules m          ON m.id = f.module_id AND m.enabled = 1
             WHERE gu.tg_user_id = :tg_user_id";

    $model = new Model();
    $rows = $model->query_bind($sql, array('tg_user_id' => $tg_user_id), 'object');
    foreach ((array) $rows as $row) {
        $cache[$row->module_code.'/'.$row->function_code] = true;
    }
    return $cache;
}
