<?php
/**
 * PM (Project Management) add-on module - Phase 1: Teams & Projects
 * Trongate v2
 *
 * Files:  modules/pm/Pm.php         (this file - decides what happens)
 *         modules/pm/Pm_model.php   (all database work - $this->model->...)
 *         modules/pm/views/*.php
 *
 * URLs (Security Groups function, pm/<code>, in brackets):
 *   pm                          [view_projects]    My projects (planning + active)
 *   pm/show_project/ID          [view_projects]    One project
 *   pm/manage_projects          [manage_projects]  Every project (admin)
 *   pm/create_project[/ID]      [edit_projects]    New project form, or edit form when ID given
 *   pm/submit_project[/ID]      [edit_projects]    POST target for the project form
 *   pm/delete_project/ID        [delete_projects]  POST: soft delete
 *   pm/manage_teams             [view_teams]       Teams list
 *   pm/show_team/ID             [view_teams]       One team + members
 *   pm/create_team[/ID]         [edit_teams]       New / edit team form
 *   pm/submit_team[/ID]         [edit_teams]       POST target for the team form
 *   pm/add_member/TEAM_ID       [edit_teams]       POST: add a person
 *   pm/remove_member/MEMBER_ID  [edit_teams]       POST: remove a person
 *   pm/delete_team/ID           [delete_teams]     POST: deactivate (blocked if open projects)
 *
 * Permissions (RBAC step 3, 2026-10-18): the shared Security Groups system
 * (engine/tg_helpers/rbac_helper.php) decides - rbac_require('pm', <code>).
 * "Admin" in PMS = has pm/manage_projects. On/off = the Projects module's
 * switch on the Security Groups page (system_modules.enabled).
 * The old pm_roles / pm_security_* tables are no longer read.
 *
 * How the v2 pieces fit together:
 *   - Data work lives in Pm_model.php; this file calls $this->model->...
 *   - Every form uses form_open() / form_close(). form_close() adds a
 *     hidden csrf_token field. $this->validation->run() checks it before
 *     anything is saved, and sends a forged request back to BASE_URL.
 *   - Form rules use $this->validation->set_rules(). The *_check methods
 *     near the bottom are validation callbacks - that is where the
 *     WHITELIST checks live.
 *   - Private methods can never be reached from a URL (v2 returns 404).
 *     Callbacks must be public, so each one starts with block_url().
 */
class Pm extends Trongate {

    public function __construct(?string $module_name = null) {
        parent::__construct($module_name);   // must be first in v2
        $this->check_pm_enabled();
    }

/* =========================================================================
   PROJECTS
   ========================================================================= */

    /**
     * My Projects - planning and active projects for my teams.
     */
    public function index(): void {
        $this->check_permission('view_projects');

        $data = $this->base_data('My Projects', 'My Projects', 'projectlist');
        $data['projects'] = $this->model->get_my_projects($this->me(), $this->is_admin());
        $data['listmode'] = 'mine';

        $this->templates->inspinia($data);
    }

    /**
     * Every project, any status (admin).
     */
    public function manage_projects(): void {
        $this->check_permission('manage_projects');

        $data = $this->base_data('All Projects', 'All Projects', 'projectlist');
        $data['projects'] = $this->model->get_all_projects();
        $data['listmode'] = 'all';

        $this->templates->inspinia($data);
    }

    public function show_project(): void {
        $this->check_permission('view_projects');

        $id      = segment(3, 'int');
        $project = $this->model->get_project($id);

        if ($project === false) {
            $this->flash('That project could not be found.', false);
            redirect('pm');
        }
        if (!$this->model->can_view_project($project, $this->me(), $this->is_admin())) {
            $this->flash('You are not on the team for that project.', false);
            redirect('pm');
        }

        $data = $this->base_data('Project', $project->name, 'showproject');
        $data['project'] = $project;
        $data['members'] = $this->model->get_team_members((int) $project->team_id);

        $this->templates->inspinia($data);
    }

    /**
     * New project (pm/create_project) or edit (pm/create_project/ID).
     * Also redisplays the form, with what was typed, when submit fails.
     */
    public function create_project(): void {
        $this->check_permission('edit_projects');

        $update_id = segment(3, 'int');
        $submit    = post('submit');

        if ($update_id === 0 || $submit === 'Submit') {
            $data = $this->model->get_project_data_from_post();
        } else {
            $data = $this->model->get_project_data_from_db($update_id);
            if ($data === false) {
                $this->flash('That project could not be found.', false);
                redirect('pm/manage_projects');
            }
        }

        if ($update_id === 0 && $submit !== 'Submit') {
            $data['status'] = 1;   // new projects start in Planning
        }

        $headline = ($update_id === 0) ? 'New Project' : 'Edit Project: ' . $data['name'];
        $data     = array_merge($this->base_data($headline, $headline, 'projectform'), $data);

        $data['update_id']     = $update_id;
        $data['form_location'] = BASE_URL . 'pm/submit_project/' . $update_id;
        $data['cancel_url']    = ($update_id > 0) ? 'pm/show_project/' . $update_id : 'pm/manage_projects';
        $data['teams']         = $this->model->get_active_teams();
        $data['users']         = $this->model->get_eligible_users();
        $data['statuses']      = $this->model->get_project_statuses();

        // Keep a PO who is no longer "eligible" visible in the dropdown
        $po = (int) $data['product_owner'];
        if ($po > 0 && !isset($data['users'][$po])) {
            $data['users'][$po] = $this->model->get_user($po)->name . ' (not eligible)';
        }

        $this->templates->inspinia($data);
    }

    public function submit_project(): void {
        $this->check_permission('edit_projects');

        $update_id = segment(3, 'int');
        if ($update_id > 0 && $this->model->get_project($update_id) === false) {
            $this->flash('That project could not be found.', false);
            redirect('pm/manage_projects');
        }

        $this->validation->set_rules('name', 'project name', 'required|max_length[150]');
        $this->validation->set_rules('team_id', 'team', 'callback_team_check');
        $this->validation->set_rules('product_owner', 'Product Owner', 'callback_po_check');
        $this->validation->set_rules('status', 'status', 'callback_status_check');
        $this->validation->set_rules('startdate', 'start date', 'valid_date');
        $this->validation->set_rules('enddate', 'end date', 'valid_date|callback_enddate_check');
        $this->validation->set_rules('shortdescription', 'short description', 'max_length[255]');

        // run() checks the CSRF token first, then the rules above.
        if ($this->validation->run() !== true) {
            $this->create_project();   // redisplay with errors + what they typed
            return;
        }

        $data = $this->model->get_project_data_from_post();
        $id   = $this->model->save_project($update_id, $data, $this->me());

        if ($update_id > 0) {
            $this->audit('update', 'UpdateProject', 'pm-submit_project', $id, 'pm_projects', $data['name']);
            $this->flash('The project was updated.');
        } else {
            $this->audit('insert', 'CreateProject', 'pm-submit_project', $id, 'pm_projects', $data['name']);
            $this->flash('The project was created.');
        }

        redirect('pm/show_project/' . $id);
    }

    public function delete_project(): void {
        $this->check_permission('delete_projects');
        $this->require_post_with_token();

        $id      = segment(3, 'int');
        $project = $this->model->get_project($id);

        if ($project === false) {
            $this->flash('That project could not be found.', false);
            redirect('pm/manage_projects');
        }

        $this->model->soft_delete_project($id, $this->me());
        $this->audit('update', 'DeleteProject', 'pm-delete_project', $id, 'pm_projects', $project->name);
        $this->flash('The project "' . $project->name . '" was deleted.');
        redirect('pm/manage_projects');
    }

/* =========================================================================
   TEAMS
   ========================================================================= */

    public function manage_teams(): void {
        $this->check_permission('view_teams');

        $data = $this->base_data('Teams', 'Teams', 'teamlist');
        $data['teams'] = $this->model->get_teams_with_counts();

        $this->templates->inspinia($data);
    }

    public function show_team(): void {
        $this->check_permission('view_teams');

        $id   = segment(3, 'int');
        $team = $this->model->get_team($id);

        if ($team === false) {
            $this->flash('That team could not be found.', false);
            redirect('pm/manage_teams');
        }

        $members    = $this->model->get_team_members($id);
        $member_ids = array_map(fn($m) => (int) $m->tg_user_id, $members);

        // Picker = everyone eligible who is not already on the team
        $candidates = array_filter(
            $this->model->get_eligible_users(),
            fn($uid) => !in_array((int) $uid, $member_ids, true),
            ARRAY_FILTER_USE_KEY);

        $data = $this->base_data('Team', $team->name, 'showteam');
        $data['team']       = $team;
        $data['members']    = $members;
        $data['candidates'] = $candidates;
        $data['projects']   = $this->model->get_team_projects($id);

        $this->templates->inspinia($data);
    }

    public function create_team(): void {
        $this->check_permission('edit_teams');

        $update_id = segment(3, 'int');
        $submit    = post('submit');

        if ($update_id === 0 || $submit === 'Submit') {
            $data = $this->model->get_team_data_from_post();
        } else {
            $data = $this->model->get_team_data_from_db($update_id);
            if ($data === false) {
                $this->flash('That team could not be found.', false);
                redirect('pm/manage_teams');
            }
        }

        $headline = ($update_id === 0) ? 'New Team' : 'Edit Team: ' . $data['name'];
        $data     = array_merge($this->base_data($headline, $headline, 'teamform'), $data);

        $data['update_id']     = $update_id;
        $data['form_location'] = BASE_URL . 'pm/submit_team/' . $update_id;
        $data['cancel_url']    = ($update_id > 0) ? 'pm/show_team/' . $update_id : 'pm/manage_teams';

        $this->templates->inspinia($data);
    }

    public function submit_team(): void {
        $this->check_permission('edit_teams');

        $update_id = segment(3, 'int');
        if ($update_id > 0 && $this->model->get_team($update_id) === false) {
            $this->flash('That team could not be found.', false);
            redirect('pm/manage_teams');
        }

        $this->validation->set_rules('name', 'team name', 'required|max_length[100]|callback_teamname_check');
        $this->validation->set_rules('description', 'description', 'max_length[255]');

        if ($this->validation->run() !== true) {
            $this->create_team();
            return;
        }

        $data = $this->model->get_team_data_from_post();
        $id   = $this->model->save_team($update_id, $data, $this->me());

        if ($update_id > 0) {
            $this->audit('update', 'UpdateTeam', 'pm-submit_team', $id, 'pm_teams', $data['name']);
            $this->flash('The team was updated.');
        } else {
            $this->audit('insert', 'CreateTeam', 'pm-submit_team', $id, 'pm_teams', $data['name']);
            $this->flash('The team was created. Now add its members.');
        }

        redirect('pm/show_team/' . $id);
    }

    public function add_member(): void {
        $this->check_permission('edit_teams');
        $this->require_post_with_token();

        $team_id    = segment(3, 'int');
        $tg_user_id = (int) $this->model->post_str('tg_user_id');

        if ($this->model->get_team($team_id) === false) {
            $this->flash('That team could not be found.', false);
            redirect('pm/manage_teams');
        }

        // WHITELIST: only people the picker is allowed to offer
        $eligible = $this->model->get_eligible_users();
        if (!array_key_exists($tg_user_id, $eligible)) {
            $this->flash('Please choose a person from the list.', false);
            redirect('pm/show_team/' . $team_id);
        }

        $result = $this->model->add_member($team_id, $tg_user_id, $this->me());
        if ($result === 'already') {
            $this->flash($eligible[$tg_user_id] . ' is already on this team.', false);
            redirect('pm/show_team/' . $team_id);
        }

        $granted = $this->model->grant_pm_user_if_missing($tg_user_id, $this->me());
        $this->audit('insert', 'AddTeamMember', 'pm-add_member', $team_id, 'pm_team_members', $eligible[$tg_user_id]);
        if ($granted) {
            $this->audit('insert', 'AddGroupMember', 'pm-add_member', $team_id, 'system_group_users', $eligible[$tg_user_id] . ' -> PM Users');
        }
        $this->flash($eligible[$tg_user_id] . ' was added to the team.'
                   . ($granted ? ' They were also given PM User access (Security Groups > PM Users).' : ''));
        redirect('pm/show_team/' . $team_id);
    }

    public function remove_member(): void {
        $this->check_permission('edit_teams');
        $this->require_post_with_token();

        $member_id = segment(3, 'int');
        $member    = $this->model->get_member($member_id);

        if ($member === false) {
            $this->flash('That team member could not be found.', false);
            redirect('pm/manage_teams');
        }

        $this->model->remove_member($member_id);

        $person = $this->model->get_user((int) $member->tg_user_id);
        $this->audit('update', 'RemoveTeamMember', 'pm-remove_member', (int) $member->team_id, 'pm_team_members', $person->name);
        $this->flash($person->name . ' was removed from the team.');
        redirect('pm/show_team/' . (int) $member->team_id);
    }

    public function delete_team(): void {
        $this->check_permission('delete_teams');
        $this->require_post_with_token();

        $id   = segment(3, 'int');
        $team = $this->model->get_team($id);

        if ($team === false) {
            $this->flash('That team could not be found.', false);
            redirect('pm/manage_teams');
        }

        if ($this->model->count_open_team_projects($id) > 0) {
            $this->flash('This team still has planning or active projects. '
                       . 'Complete, cancel or move them first.', false);
            redirect('pm/show_team/' . $id);
        }

        $this->model->deactivate_team($id, $this->me());
        $this->audit('update', 'DeleteTeam', 'pm-delete_team', $id, 'pm_teams', $team->name);
        $this->flash('The team "' . $team->name . '" was deleted.');
        redirect('pm/manage_teams');
    }

/* =========================================================================
   VALIDATION CALLBACKS
   Each returns true (OK) or an error message. {label} becomes the field
   label from set_rules(). They must be public for the validation module
   to call them, so block_url() stops anyone visiting them as pages.
   ========================================================================= */

    // WHITELIST: team must be one of the active teams
    public function team_check(mixed $value): string|bool {
        block_url('pm/team_check');
        $value = is_scalar($value) ? trim((string) $value) : '';
        return array_key_exists((int) $value, $this->model->get_active_teams())
            ? true : 'Please choose a {label}.';
    }

    // WHITELIST: PO must be none (0), an eligible person, or the PO
    // already on this project (they may no longer be "eligible")
    public function po_check(mixed $value): string|bool {
        block_url('pm/po_check');
        $value = is_scalar($value) ? trim((string) $value) : '';
        $po = (int) $value;
        if ($po === 0 || array_key_exists($po, $this->model->get_eligible_users())) {
            return true;
        }
        $existing = $this->model->get_project(segment(3, 'int'));
        if ($existing !== false && (int) $existing->product_owner === $po) {
            return true;
        }
        return 'Please choose a valid {label}.';
    }

    // WHITELIST: status must exist in pm_project_status
    public function status_check(mixed $value): string|bool {
        block_url('pm/status_check');
        $value = is_scalar($value) ? trim((string) $value) : '';
        return array_key_exists((int) $value, $this->model->get_project_statuses())
            ? true : 'Please choose a valid {label}.';
    }

    public function enddate_check(mixed $value): string|bool {
        block_url('pm/enddate_check');
        $value = is_scalar($value) ? trim((string) $value) : '';
        $start = $this->model->post_str('startdate');
        if ($value === '' || $start === '') {
            return true;
        }
        return ($value >= $start) ? true : 'The {label} cannot be before the start date.';
    }

    public function teamname_check(mixed $value): string|bool {
        block_url('pm/teamname_check');
        $value = is_scalar($value) ? trim((string) $value) : '';
        return $this->model->team_name_taken($value, segment(3, 'int'))
            ? 'Another active team already uses that name.' : true;
    }

/* =========================================================================
   PRIVATE HELPERS  (private = can never be reached from a URL)
   ========================================================================= */

    /**
     * Is the add-on switched on for this customer? (Security Groups > Modules)
     */
    private function check_pm_enabled(): void {
        if (!rbac_module_enabled('pm')) {
            $this->flash('The Project Management module is not enabled for this site.', false);
            redirect(!empty($_SESSION['honcho_logged_in']) ? 'honcho' : 'welcome-ccmps/ccmphome');
        }
    }

    /**
     * PMS needs the staff login (it is sold with Honcho), then Security Groups
     * decides: person -> groups -> functions (pm/<code>). Read on every request,
     * so a change on the Security screens works on the next click.
     */
    private function check_permission(string $function): void {
        if (empty($_SESSION['trongatetoken'])) {
            $this->flash('Your Session has expired - please login again.', false);
            redirect('honcho/logout');
        }
        if (($_SESSION['authenticated'] ?? 0) != 1) {
            redirect('honcho/logout');
        }

        if (!rbac_allowed('pm', $function)) {
            $this->flash('You are not authorized to use that part of Project Management. '
                       . 'Contact the System Administrator ' . SYS_ADMIN_PHONE, false);
            redirect('honcho');
        }
    }

    /**
     * For the small POST-only actions (delete, add/remove member).
     * With no rules set, run() does just the CSRF token check.
     */
    private function require_post_with_token(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            redirect('pm');
        }
        $this->validation->run();
    }

    private function me(): int {
        return (int) ($_SESSION['tg_user_id'] ?? 0);
    }

    private function is_admin(): bool {
        return rbac_allowed('pm', 'manage_projects');
    }

    /**
     * Flash message plus the colour flag the Honcho views use (1 green, 0 red).
     */
    private function flash(string $msg, bool $ok = true): void {
        set_flashdata($msg);
        $_SESSION['flashmsgcolor'] = $ok ? 1 : 0;
    }

    /**
     * Same auditlogger call the DMS module makes.
     */
    private function audit(string $type, string $action, string $func, int $recid, string $table, string $title): void {
        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime') . ' UTC';

        $this->module('system-auditlogger');
        $this->auditlogger->logevent(
            $type, $action, $func,
            'TGuid: ' . $this->me(),
            $time,
            'Rec: ' . $recid,
            'Tbl: ' . $table,
            'Title: ' . $title,
            'Mode: ' . ($this->is_admin() ? 'pmadmin' : 'pmuser')
        );
    }

    /**
     * The $data keys the inspinia template and the PM navbar expect.
     */
    private function base_data(string $bc2, string $headline, string $view_file): array {
        return [
            'bc1'         => 'PM',
            'bc2'         => $bc2,
            'headline'    => $headline,
            'is_admin'    => $this->is_admin(),
            'view_module' => 'pm',
            'view_file'   => $view_file,
        ];
    }

}
