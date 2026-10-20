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

  Member admin roles (RBAC step 5) - the roles on the member record (System, Member,
  Chapter, Student, Content and Event Admin) live in Security Groups;
  the ccmps columns are kept as a copy, re-synced after every change:
  rbac_member_roles()                           ccmps/<function> => column, group, session flag
  rbac_member_login($ccmp_id, $create)          the member's login (trongate_users id); can create it
  rbac_set_member_role($ccmp_id, $fn, $on, $by) tick / untick a role = join / leave its group
  rbac_sync_member_columns($ccmp_id)            copy the member's roles from the groups to the columns
  rbac_sync_group_members($group_id)            the same for every member login in a group
  rbac_member_session_flags($ccmp_id)           set the ccmps_* session flags from the groups (login)

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

function rbac_allowed_for(int $tg_user_id, string $module, string $function, bool $refresh = false): bool {
    $allowed = _rbac_function_list($tg_user_id, $refresh);
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

function _rbac_function_list(int $tg_user_id, bool $refresh = false): array {
    // 'module/function' => true for one person; read once per page per person ($refresh after a change)
    static $cache = array();
    if (isset($cache[$tg_user_id]) && !$refresh) {
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

/* --------------------------- member admin roles --------------------------- */

function rbac_member_roles(): array {
    // ccmps/<function> => the ccmps column (kept as a copy), the group a tick joins, the session flag login sets
    return array(
        'system_admin'  => array('col' => 'system_admin',    'group' => 'Member System Admins', 'session' => 'ccmps_system_admin'),
        'member_admin'  => array('col' => 'ccmp_admin',      'group' => 'Member Admins',        'session' => 'ccmps_ccmp_admin'),
        'chapter_admin' => array('col' => 'subentity_admin', 'group' => 'Chapter Admins',       'session' => 'ccmps_subentity_admin'),
        'student_admin' => array('col' => 'student_admin',   'group' => 'Student Admins',       'session' => 'ccmps_student_admin'),
        'content_admin' => array('col' => 'content_admin',   'group' => 'Content Admins',       'session' => 'ccmps_content_admin'),
        'event_admin'   => array('col' => 'event_admin',     'group' => 'Event Admins',         'session' => 'ccmps_event_admin'),
    );
}

function rbac_member_login(int $ccmp_id, bool $create = false): int {
    // the member's login (trongate_users id), or 0. With $create, a missing login row is made
    // (members sign in with the username on their ccmps row; the row is what groups hang on)
    $model  = new Model();
    $member = $model->get_where($ccmp_id, 'ccmps');
    if (!$member) {
        return 0;
    }

    $tg = (int) $member->trongate_user_id;
    if ($tg > 0) {
        $row = $model->get_where($tg, 'trongate_users');
        if ($row && $row->login_acct_info_table == 'ccmps' && (int) $row->login_acct_table_id == $ccmp_id) {
            return $tg;
        }
        if (!$row && $create) { // the number is the member's; only the row is missing
            $model->query_bind('INSERT INTO trongate_users (id, title, login_acct_table_id, login_acct_info_table) VALUES (:id, :title, :acct, :tbl)',
                               array('id' => $tg, 'title' => _rbac_login_title($member), 'acct' => $ccmp_id, 'tbl' => 'ccmps'));
            return $tg;
        }
        if (!$create) {
            return 0;
        }
        // the number belongs to someone else's login - give this member a new one below
    }
    if (!$create) {
        return 0;
    }

    $new = (int) $model->insert(array('title' => _rbac_login_title($member), 'login_acct_table_id' => $ccmp_id,
                                      'login_acct_info_table' => 'ccmps'), 'trongate_users');
    $model->update($ccmp_id, array('trongate_user_id' => $new), 'ccmps');
    return $new;
}

function _rbac_login_title(object $member): string {
    $title = trim((string) ($member->username ?? '')) ?: trim((string) ($member->email_address ?? '')) ?: 'member '.$member->id;
    return substr($title, 0, 32);
}

function _rbac_role_group(string $function): int {
    // the group a tick on the member record joins: the one named in rbac_member_roles(),
    // or - if that was renamed - the first group holding ccmps/<function>
    $roles = rbac_member_roles();
    $model = new Model();
    $group = $model->get_one_where('title', $roles[$function]['group'], 'system_groups');
    if ($group) {
        return (int) $group->id;
    }
    $rows = $model->query_bind("SELECT gf.group_id FROM system_group_functions gf
                                  JOIN system_functions f ON f.id = gf.function_id AND f.code = :fn
                                  JOIN system_modules m   ON m.id = f.module_id AND m.code = 'ccmps'
                                 ORDER BY gf.group_id LIMIT 1", array('fn' => $function), 'object');
    return !empty($rows) ? (int) $rows[0]->group_id : 0;
}

function rbac_set_member_role(int $ccmp_id, string $function, bool $on, int $by = 0): void {
    // tick = join the role's group, untick = leave it; then the ccmps columns are re-synced
    $roles = rbac_member_roles();
    if (!isset($roles[$function])) {
        return;
    }

    $tg       = rbac_member_login($ccmp_id, $on); // a login row is only made when giving a role
    $group_id = $tg > 0 ? _rbac_role_group($function) : 0;
    $model    = new Model();

    if ($group_id > 0 && $on) {
        $model->query_bind('INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_by, created_at) VALUES (:gid, :uid, :by, :at)',
                           array('gid' => $group_id, 'uid' => $tg, 'by' => $by, 'at' => time()));
    } elseif ($group_id > 0) {
        $model->query_bind('DELETE FROM system_group_users WHERE group_id = :gid AND tg_user_id = :uid',
                           array('gid' => $group_id, 'uid' => $tg));
    }

    if ($tg > 0) {
        rbac_sync_member_columns($ccmp_id);
    } else { // no login and taking a role away: just the column
        $model->update($ccmp_id, array($roles[$function]['col'] => 0), 'ccmps');
    }
}

function rbac_sync_member_columns(int $ccmp_id): void {
    // the ccmps role columns (system_admin, ccmp_admin, ... event_admin) = what the groups give now.
    // Members with no login row keep their columns (login falls back to them).
    $tg = rbac_member_login($ccmp_id, false);
    if ($tg < 1) {
        return;
    }
    $data = array();
    foreach (rbac_member_roles() as $function => $role) {
        $data[$role['col']] = rbac_allowed_for($tg, 'ccmps', $function, true) ? 1 : 0;
    }
    $model = new Model();
    $model->update($ccmp_id, $data, 'ccmps');
}

function rbac_clear_member_access(int $ccmp_id): void {
    // deceased member: out of every Security Group, and the role columns cleared
    $tg    = rbac_member_login($ccmp_id, false);
    $model = new Model();
    if ($tg > 0) {
        $model->query_bind('DELETE FROM system_group_users WHERE tg_user_id = :uid', array('uid' => $tg));
    }
    $data = array();
    foreach (rbac_member_roles() as $role) {
        $data[$role['col']] = 0;
    }
    $model->update($ccmp_id, $data, 'ccmps');
}

function rbac_sync_group_members(int $group_id): void {
    // after a group's people, functions or active flag change: re-sync every member login in it
    $model = new Model();
    $rows  = $model->query_bind("SELECT t.login_acct_table_id AS ccmp_id FROM system_group_users gu
                                   JOIN trongate_users t ON t.id = gu.tg_user_id AND t.login_acct_info_table = 'ccmps'
                                  WHERE gu.group_id = :gid", array('gid' => $group_id), 'object');
    foreach ((array) $rows as $row) {
        rbac_sync_member_columns((int) $row->ccmp_id);
    }
}

function rbac_member_session_flags(int $ccmp_id): void {
    // at login / refresh: the ccmps_* role flags from the groups. A member with no login row
    // keeps the flags already set from the ccmps columns.
    $tg = rbac_member_login($ccmp_id, false);
    if ($tg > 0) {
        foreach (rbac_member_roles() as $function => $role) {
            $_SESSION[$role['session']] = rbac_allowed_for($tg, 'ccmps', $function, true) ? 1 : 0;
        }
    }
    $_SESSION['ccmps_admin'] = !empty($_SESSION['ccmps_ccmp_admin']) ? 1 : 0; // the menus check ccmps_admin
}
