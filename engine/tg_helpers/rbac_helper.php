<?php
/*
  RBAC helper - one permission check for every module (Honcho RBAC plan, 2026-10-18)

  person (trongate_users.id) -> system_group_users -> system_groups (active)
         -> system_group_functions -> system_functions -> system_modules (enabled)

  rbac_allowed($module, $function)              true/false for the logged-in person - for showing or hiding a link
  rbac_require($module, $function)              stops with a flash message if not allowed
  rbac_allowed_for($tg_user_id, $module, $fn)   true/false for someone else (e.g. before adding them to a team)
  rbac_module_enabled($module)                  is this module switched on (system_modules.enabled)?
  rbac_person($tg_user_id)                      name, email and kind (staff/member) of one login
  rbac_people($kinds)                           every login of those kinds, named, sorted by name
        _rbac_function_list($tg_user_id)        everything one person may do, read once per page

  Who is always $_SESSION['tg_user_id'] (set by both logins), never the URL or a form.
  The database is read on every page (once, then remembered for that page), so a
  change on the Security screens works on the person's next click.
  RBAC answers WHAT someone may do; WHICH records (own chapter, own teams) stays
  in each module's queries.
*/

function rbac_allowed(string $module, string $function): bool {
    $allowed = _rbac_function_list((int) ($_SESSION['tg_user_id'] ?? 0));
    return isset($allowed[$module.'/'.$function]);
}

function rbac_allowed_for(int $tg_user_id, string $module, string $function): bool {
    $allowed = _rbac_function_list($tg_user_id);
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

function rbac_module_enabled(string $module): bool {
    static $enabled = null;
    if ($enabled === null) {
        $enabled = array();
        $model = new Model();
        foreach ((array) $model->query("SELECT code, enabled FROM system_modules", 'object') as $row) {
            $enabled[$row->code] = ((int) $row->enabled === 1);
        }
    }
    return $enabled[$module] ?? false;
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

function rbac_people(array $kinds = array('staff', 'member')): array {
    // every login of the given kinds: objects with id (tg user id), kind, name, email - sorted by name
    $tables = array();
    if (in_array('staff', $kinds, true))  { $tables[] = "'honcho_user_accounts'"; }
    if (in_array('member', $kinds, true)) { $tables[] = "'ccmps'"; }
    if (empty($tables)) {
        return array();
    }

    $model = new Model();
    return $model->query("SELECT t.id,
                                 CASE t.login_acct_info_table WHEN 'honcho_user_accounts' THEN 'staff'
                                                              WHEN 'ccmps' THEN 'member' ELSE 'unknown' END AS kind,
                                 COALESCE(NULLIF(TRIM(CONCAT_WS(' ', c.first_name, c.last_name)), ''),
                                          NULLIF(TRIM(CONCAT_WS(' ', h.first_name, h.last_name)), ''),
                                          NULLIF(t.title, ''), NULLIF(h.username, ''), NULLIF(c.username, '')) AS name,
                                 COALESCE(c.email_address, h.email_address, '') AS email
                            FROM trongate_users t
                            LEFT JOIN ccmps c                ON t.login_acct_info_table = 'ccmps' AND c.id = t.login_acct_table_id
                            LEFT JOIN honcho_user_accounts h ON t.login_acct_info_table = 'honcho_user_accounts' AND h.id = t.login_acct_table_id
                           WHERE t.login_acct_info_table IN (".implode(',', $tables).")
                           ORDER BY name, t.id", 'object');
}

function _rbac_function_list(int $tg_user_id): array {
    // 'module/function' => true for one person; read once per page per person
    static $cache = array();
    if (isset($cache[$tg_user_id])) {
        return $cache[$tg_user_id];
    }

    $cache[$tg_user_id] = array();
    if ($tg_user_id < 1) {
        return $cache[$tg_user_id];
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
        $cache[$tg_user_id][$row->module_code.'/'.$row->function_code] = true;
    }
    return $cache[$tg_user_id];
}
