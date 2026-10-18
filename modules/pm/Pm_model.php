<?php
/**
 * Pm_model - all database work for the PM (Project Management) add-on.
 *
 * The controller (Pm.php) decides WHAT happens; this file does the
 * reading and writing. The controller reaches it through $this->model.
 *
 * Every query that includes a value uses $this->query_bind() with a
 * named placeholder (:id, :team_id ...). The value is sent to MySQL
 * separately from the SQL text, so it can never be treated as SQL.
 *
 * This app has no v2 Db module: Pm_model extends the legacy v1 Model
 * (engine/Model.php), so the query methods are called on $this.
 */
class Pm_model extends Model {

    // WHITELIST: the only pm_settings keys this module reads.
    private array $setting_keys = ['include_ccmps_users'];

    // Each person is looked up once per page, then remembered here.
    private array $user_cache = [];

/* =========================================================================
   SETTINGS & PERMISSIONS
   ========================================================================= */

    /**
     * Read one pm_settings value by key. Unknown keys return ''.
     */
    public function get_setting(string $key): string {
        if (!in_array($key, $this->setting_keys, true)) {
            return '';
        }
        $row = $this->get_one_where('setting_key', $key, 'pm_settings');
        return ($row !== false) ? (string) $row->settingvalue : '';
    }

    /**
     * Someone just put on a team who can't open PMS yet goes into the
     * "PM Users" security group (Security Groups screens can change it).
     * Returns true when they were added.
     */
    public function grant_pm_user_if_missing(int $tg_user_id, int $added_by): bool {
        if (rbac_allowed_for($tg_user_id, 'pm', 'view_projects')) {
            return false;
        }
        $group = $this->get_one_where('title', 'PM Users', 'system_groups');
        if ($group === false) {
            return false;
        }
        $this->query_bind('INSERT IGNORE INTO system_group_users (group_id, tg_user_id, created_by, created_at)
                           VALUES (:gid, :uid, :by, :at)',
                          ['gid' => (int) $group->id, 'uid' => $tg_user_id, 'by' => $added_by, 'at' => time()]);
        return true;
    }

/* =========================================================================
   PEOPLE
   ========================================================================= */

    /**
     * Everyone who may be put on a team or made Product Owner.
     * Returns [tg_user_id => 'First Last'] sorted by name.
     * Every staff login; member logins too when include_ccmps_users = 1.
     * Built from the login list (trongate_users) by rbac_people().
     */
    public function get_eligible_users(): array {
        $kinds = ['staff'];
        if ($this->get_setting('include_ccmps_users') === '1') {
            $kinds[] = 'member';
        }

        $users = [];
        foreach (rbac_people($kinds) as $p) {
            $users[(int) $p->id] = $p->name . ($p->kind === 'member' ? ' (' . CCMP . ')' : '');
        }

        asort($users, SORT_FLAG_CASE | SORT_STRING);
        return $users;
    }

    /**
     * The ONE place PM turns a tg_user_id into a person (via rbac_person()).
     */
    public function get_user(int $tg_user_id): object {
        if (isset($this->user_cache[$tg_user_id])) {
            return clone $this->user_cache[$tg_user_id];
        }

        $person = (object) [
            'tg_user_id' => $tg_user_id,
            'name'       => ($tg_user_id > 0) ? 'Unknown user #' . $tg_user_id : 'Not Assigned',
            'email'      => '',
            'source'     => '',
        ];

        if ($tg_user_id > 0) {
            $found = rbac_person($tg_user_id);   // engine/tg_helpers/rbac_helper.php
            if ($found !== false) {
                $person->name   = $found->name;
                $person->email  = $found->email;
                $person->source = $found->kind;   // 'staff' or 'member'
            }
        }

        $this->user_cache[$tg_user_id] = $person;
        return clone $person;
    }

/* =========================================================================
   LOOKUP LISTS  ([id => title] arrays - also used as WHITELISTS)
   ========================================================================= */

    public function get_active_teams(): array {
        $rows = $this->query('SELECT id, name FROM pm_teams WHERE active = 1 ORDER BY name', 'object');
        $list = [];
        foreach ($rows as $r) {
            $list[(int) $r->id] = $r->name;
        }
        return $list;
    }

    public function get_project_statuses(): array {
        $rows = $this->query('SELECT id, title FROM pm_project_status ORDER BY id', 'object');
        $list = [];
        foreach ($rows as $r) {
            $list[(int) $r->id] = $r->title;
        }
        return $list;
    }

/* =========================================================================
   PROJECTS
   ========================================================================= */

    /**
     * Planning + Active projects this person may see
     * (admins see all; others see their teams' projects and ones they PO).
     */
    public function get_my_projects(int $tg_user_id, bool $is_admin): array {
        if ($is_admin) {
            $sql    = 'SELECT * FROM pm_projects
                        WHERE soft_deleted = 0 AND status IN (1,2) ORDER BY name';
            $params = [];
        } else {
            $sql = 'SELECT * FROM pm_projects
                     WHERE soft_deleted = 0 AND status IN (1,2)
                       AND (product_owner = :me
                            OR team_id IN (SELECT team_id FROM pm_team_members
                                            WHERE tg_user_id = :me2 AND active = 1))
                     ORDER BY name';
            $params = ['me' => $tg_user_id, 'me2' => $tg_user_id];
        }
        $rows = $this->query_bind($sql, $params, 'object');
        return $this->decorate_projects($rows);
    }

    public function get_all_projects(): array {
        $rows = $this->query('SELECT * FROM pm_projects WHERE soft_deleted = 0 ORDER BY name', 'object');
        return $this->decorate_projects($rows);
    }

    public function get_team_projects(int $team_id): array {
        $rows = $this->query_bind(
            'SELECT * FROM pm_projects WHERE team_id = :team_id AND soft_deleted = 0 ORDER BY name',
            ['team_id' => $team_id], 'object');
        return $this->decorate_projects($rows);
    }

    /**
     * One live (not deleted) project with display fields added, or false.
     */
    public function get_project(int $id): object|false {
        $row = $this->get_where($id, 'pm_projects');
        if ($row === false || (int) $row->soft_deleted === 1) {
            return false;
        }
        return $this->decorate_projects([$row])[0];
    }

    public function count_open_team_projects(int $team_id): int {
        $rows = $this->query_bind(
            'SELECT COUNT(*) AS cnt FROM pm_projects
              WHERE team_id = :team_id AND soft_deleted = 0 AND status IN (1,2)',
            ['team_id' => $team_id], 'object');
        return (int) $rows[0]->cnt;
    }

    /**
     * Form values from the POST (as typed - dates stay 'Y-m-d').
     */
    public function get_project_data_from_post(): array {
        return [
            'name'             => $this->post_str('name'),
            'team_id'          => (int) $this->post_str('team_id'),
            'product_owner'    => (int) $this->post_str('product_owner'),
            'status'           => (int) $this->post_str('status'),
            'startdate'        => $this->post_str('startdate'),
            'enddate'          => $this->post_str('enddate'),
            'shortdescription' => $this->post_str('shortdescription'),
            'description'      => $this->post_str('description', false),
        ];
    }

    /**
     * Form values from the database (timestamps turned into 'Y-m-d').
     */
    public function get_project_data_from_db(int $id): array|false {
        $row = $this->get_where($id, 'pm_projects');
        if ($row === false || (int) $row->soft_deleted === 1) {
            return false;
        }
        $data = (array) $row;
        $data['startdate'] = $this->ts_to_date((int) $row->startdate);
        $data['enddate']   = $this->ts_to_date((int) $row->enddate);
        return $data;
    }

    /**
     * Insert (update_id 0) or update. Returns the record id.
     */
    public function save_project(int $update_id, array $data, int $tg_user_id): int {
        $data['startdate']  = $this->date_to_ts($data['startdate']);
        $data['enddate']    = $this->date_to_ts($data['enddate']);
        $data['updated_at'] = time();
        $data['updated_by'] = $tg_user_id;

        if ($update_id > 0) {
            $this->update($update_id, $data, 'pm_projects');
            return $update_id;
        }
        $data['created_at'] = time();
        $data['created_by'] = $tg_user_id;
        return $this->insert($data, 'pm_projects');
    }

    public function soft_delete_project(int $id, int $tg_user_id): void {
        $this->update($id, [
            'soft_deleted' => 1,
            'active'       => 0,
            'updated_at'   => time(),
            'updated_by'   => $tg_user_id,
        ], 'pm_projects');
    }

    /**
     * Add team name, PO name, status title and nice dates to project rows.
     */
    private function decorate_projects(array $rows): array {
        if (empty($rows)) {
            return [];
        }
        $teams    = $this->query('SELECT id, name FROM pm_teams', 'object');
        $teamname = [];
        foreach ($teams as $t) {
            $teamname[(int) $t->id] = $t->name;
        }
        $statuses = $this->get_project_statuses();

        foreach ($rows as $row) {
            $row->team_name     = $teamname[(int) $row->team_id] ?? '(no team)';
            $row->po_name       = $this->get_user((int) $row->product_owner)->name;
            $row->status_title  = $statuses[(int) $row->status] ?? '';
            $row->startdate_fmt = $this->nice_date((int) $row->startdate);
            $row->enddate_fmt   = $this->nice_date((int) $row->enddate);
        }
        return $rows;
    }

/* =========================================================================
   TEAMS & MEMBERS
   ========================================================================= */

    /**
     * Active teams with member and open-project counts.
     */
    public function get_teams_with_counts(): array {
        $sql = 'SELECT t.*,
                       (SELECT COUNT(*) FROM pm_team_members m
                         WHERE m.team_id = t.id AND m.active = 1) AS member_count,
                       (SELECT COUNT(*) FROM pm_projects p
                         WHERE p.team_id = t.id AND p.soft_deleted = 0
                           AND p.status IN (1,2)) AS project_count
                  FROM pm_teams t
                 WHERE t.active = 1
                 ORDER BY t.name';
        return $this->query($sql, 'object');
    }

    public function get_team(int $id): object|false {
        $row = $this->get_where($id, 'pm_teams');
        return ($row !== false && (int) $row->active === 1) ? $row : false;
    }

    public function get_team_data_from_post(): array {
        return [
            'name'        => $this->post_str('name'),
            'description' => $this->post_str('description'),
        ];
    }

    public function get_team_data_from_db(int $id): array|false {
        $row = $this->get_team($id);
        return ($row !== false) ? (array) $row : false;
    }

    /**
     * True if another active team already uses this name (any capitalisation).
     */
    public function team_name_taken(string $name, int $exclude_id): bool {
        $rows = $this->query_bind(
            'SELECT id FROM pm_teams
              WHERE active = 1 AND id != :exclude_id AND LOWER(TRIM(name)) = LOWER(TRIM(:name))
              LIMIT 1',
            ['exclude_id' => $exclude_id, 'name' => $name], 'object');
        return !empty($rows);
    }

    public function save_team(int $update_id, array $data, int $tg_user_id): int {
        $data['updated_at'] = time();
        $data['updated_by'] = $tg_user_id;

        if ($update_id > 0) {
            $this->update($update_id, $data, 'pm_teams');
            return $update_id;
        }
        $data['active']     = 1;
        $data['created_at'] = time();
        $data['created_by'] = $tg_user_id;
        return $this->insert($data, 'pm_teams');
    }

    public function deactivate_team(int $id, int $tg_user_id): void {
        $this->update($id, [
            'active'     => 0,
            'updated_at' => time(),
            'updated_by' => $tg_user_id,
        ], 'pm_teams');
    }

    /**
     * Active members as person objects (plus member_id), sorted by name.
     */
    public function get_team_members(int $team_id): array {
        $rows = $this->query_bind(
            'SELECT id, tg_user_id FROM pm_team_members WHERE team_id = :team_id AND active = 1',
            ['team_id' => $team_id], 'object');

        $members = [];
        foreach ($rows as $m) {
            $person            = $this->get_user((int) $m->tg_user_id);
            $person->member_id = (int) $m->id;
            $members[]         = $person;
        }
        usort($members, fn($a, $b) => strcasecmp($a->name, $b->name));
        return $members;
    }

    public function get_member(int $member_id): object|false {
        return $this->get_where($member_id, 'pm_team_members');
    }

    /**
     * Returns 'added', 'reactivated' or 'already'.
     */
    public function add_member(int $team_id, int $tg_user_id, int $added_by): string {
        $rows = $this->query_bind(
            'SELECT id, active FROM pm_team_members WHERE team_id = :team_id AND tg_user_id = :uid LIMIT 1',
            ['team_id' => $team_id, 'uid' => $tg_user_id], 'object');

        if (!empty($rows)) {
            if ((int) $rows[0]->active === 1) {
                return 'already';
            }
            $this->update((int) $rows[0]->id, ['active' => 1], 'pm_team_members');
            return 'reactivated';
        }

        $this->insert([
            'team_id'    => $team_id,
            'tg_user_id' => $tg_user_id,
            'active'     => 1,
            'created_at' => time(),
            'created_by' => $added_by,
        ], 'pm_team_members');
        return 'added';
    }

    public function remove_member(int $member_id): void {
        $this->update($member_id, ['active' => 0], 'pm_team_members');
    }

    /**
     * May this person see this project?  (Admin, its PO, or on its team.)
     */
    public function can_view_project(object $project, int $tg_user_id, bool $is_admin): bool {
        if ($is_admin || (int) $project->product_owner === $tg_user_id) {
            return true;
        }
        $rows = $this->query_bind(
            'SELECT id FROM pm_team_members WHERE team_id = :team_id AND tg_user_id = :uid AND active = 1 LIMIT 1',
            ['team_id' => (int) $project->team_id, 'uid' => $tg_user_id], 'object');
        return !empty($rows);
    }

/* =========================================================================
   SMALL UTILITIES
   ========================================================================= */

    /**
     * A posted value as a string. A tampered form that posts an array
     * (name[]=x) gets '' instead of crashing the page.
     */
    public function post_str(string $key, bool $clean_up = true): string {
        $value = post($key, $clean_up);
        return is_string($value) ? $value : (is_numeric($value) ? (string) $value : '');
    }

    // Dates are stored as Unix timestamps; 0 = no date.
    public function date_to_ts(string $ymd): int {
        if ($ymd === '') {
            return 0;
        }
        $d = DateTime::createFromFormat('!Y-m-d', $ymd);
        return ($d !== false) ? $d->getTimestamp() : 0;
    }

    public function ts_to_date(int $ts): string {
        return ($ts > 0) ? date('Y-m-d', $ts) : '';
    }

    public function nice_date(int $ts): string {
        return ($ts > 0) ? date('m/d/Y', $ts) : '';
    }

}
