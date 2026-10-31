<?php
/**
 * Session helper (2026-10-31): the member session setup, shared by the member login and View as a Member
 * (requirements LOGIN-20 to LOGIN-29), so the two can never set up a member differently.
 *
 *   member_session_setup($usr_obj)   everything a member login puts in the session for that member, after the
 *                                    password and second factor (identity, chapter, admin roles from Security Groups,
 *                                    the membership year settings, member mode). Doesn't record a login.
 *   login_settings_to_session()      the membership year and grace period settings every login copies in
 *   viewas_active()                  is an admin viewing Honcho as a member right now?
 *   viewas_can($target)              [ok, reason]: may the signed-in admin view as this member?
 *   viewas_block($what, $back)       stops an action that isn't allowed while viewing as a member (LOGIN-25)
 */

function login_settings_to_session(): void {
    $system_current_year_val = intval(setting('system_current_year', 0));
    $grace_period_val        = intval(setting('grace_period', 0));
    $_SESSION['system_current_year'] = $system_current_year_val;
    $_SESSION['system_grace_period'] = $grace_period_val;
    $_SESSION['ccmps_current_year']  = $system_current_year_val;
    $_SESSION['ccmps_grace_period']  = $grace_period_val;
}

function member_session_setup(object $usr_obj): void {
    // what Welcome::authenticate() sets for a member (before the second factor)
    $_SESSION['user_type']     = 'ccmpuser';
    $_SESSION['acct_table']    = 'ccmps';
    $_SESSION['username']      = $usr_obj->username;
    $_SESSION['ccmp_rec_id']   = $usr_obj->id;
    $_SESSION['ccmp_username'] = $usr_obj->username;
    $_SESSION['ccmp_first']    = $usr_obj->first_name;
    $_SESSION['ccmp_last']     = $usr_obj->last_name;
    $_SESSION['minor']         = $usr_obj->minor;
    $_SESSION['last_ip_address'] = $usr_obj->ip_address;

    // what Welcome::successfullogin() sets for a member
    $_SESSION['tg_user_id']            = $usr_obj->trongate_user_id;
    $_SESSION['approved']              = $usr_obj->approved;
    $_SESSION['status']                = $usr_obj->status;
    $_SESSION['locked']                = $usr_obj->locked;
    $_SESSION['inactive']              = $usr_obj->inactive;
    $_SESSION['last_login']            = $usr_obj->last_login;
    $_SESSION['picture']               = $usr_obj->picture;
    $_SESSION['language']              = $usr_obj->language; // manage page
    $_SESSION['ccmps_subentity']       = $usr_obj->subentity;
    $_SESSION['ccmps_subentity_role']  = $usr_obj->subentity_role;  // used to set menu
    $_SESSION['ccmps_subentity_admin'] = $usr_obj->subentity_admin;
    $_SESSION['ccmps_student_admin']   = $usr_obj->student_admin;
    $_SESSION['ccmps_ccmp_admin']      = $usr_obj->ccmp_admin;
    $_SESSION['ccmps_system_admin']    = $usr_obj->system_admin;
    rbac_member_session_flags((int) $usr_obj->id); // RBAC step 5: the roles come from Security Groups (columns above are the fallback)
    $_SESSION['honcho_national_officer'] = $usr_obj->national_officer;
    $model = new Model();
    $subentityobj                = $model->get_where($usr_obj->subentity, 'ccmps_subentities');
    $_SESSION['subentity_name']  = $subentityobj->description ?? '';
    $_SESSION['subentity_title'] = $subentityobj->title ?? '';
    $_SESSION['force_pw_chg']    = $usr_obj->force_pw_chg;

    login_settings_to_session();
    $_SESSION['ccmpmode']       = 'ccmp';
    $_SESSION['ccmp_logged_in'] = 1;
}

function viewas_active(): bool {
    return !empty($_SESSION['viewas']['ccmp_id']);
}

function _viewas_has_admin_role(object $m): bool {
    if (!empty($m->system_admin) || !empty($m->ccmp_admin) || !empty($m->subentity_admin) || !empty($m->student_admin)
        || !empty($m->content_admin) || !empty($m->event_admin) || !empty($m->financial_admin)) {
        return true;
    }
    $model = new Model();
    $rows  = $model->query_bind("SELECT COUNT(*) AS n FROM system_group_users gu JOIN system_groups g ON g.id = gu.group_id
                                  WHERE gu.tg_user_id = :t AND g.title NOT IN ('DMS Users')", array('t' => (int) $m->trongate_user_id), 'object');
    return (int) ($rows[0]->n ?? 0) > 0; // any Security Group beyond the everyday members' one counts as an admin role
}

function viewas_can($target): array {
    if (!$target) {
        return array(false, 'No such '.strtolower(CCMP).'.');
    }
    if (viewas_active()) {
        return array(false, 'Return to your own account first.');
    }
    if (!rbac_allowed('system', 'view_as_member')) {
        return array(false, 'You are not allowed to view Honcho as a '.strtolower(CCMP).'.');
    }
    if (!empty($target->deceased) || !empty($target->soft_deleted)) {
        return array(false, 'Not available for a deceased or deleted '.strtolower(CCMP).'.');
    }
    if ((int) $target->id === (int) ($_SESSION['ccmp_rec_id'] ?? 0) && !empty($_SESSION['ccmp_logged_in'])) {
        return array(false, 'That is your own account.');
    }
    if (!empty($target->system_admin) || rbac_allowed_for((int) $target->trongate_user_id, 'ccmps', 'system_admin')) {
        return array(false, 'Nobody can view Honcho as a System Admin.'); // LOGIN-24
    }
    $system = is_system_admin() || !empty($_SESSION['ccmps_system_admin']);
    if (!$system && _viewas_has_admin_role($target)) {
        return array(false, 'Only System Admins can view as a '.strtolower(CCMP).' who has an admin role.');
    }
    $national = $system || !empty($_SESSION['ccmps_admin']) || !empty($_SESSION['ccmps_ccmp_admin']) || !empty($_SESSION['honcho_logged_in']);
    if (!$national) { // Chapter Admins: their own chapter's members only (LOGIN-23)
        if (empty($_SESSION['ccmps_subentity_admin']) || (int) ($_SESSION['ccmps_subentity'] ?? -1) !== (int) $target->subentity) {
            return array(false, 'You can view as '.strtolower(CCMPS).' of your own '.strtolower(SUBENTITY).' only.');
        }
    }
    return array(true, '');
}

function viewas_block(string $what, string $back): void {
    if (viewas_active()) {
        set_flashdata('Not available while viewing as a '.strtolower(CCMP).': '.$what.'. Return to your own account first.');
        $_SESSION['flashmsgcolor'] = 0;
        redirect($back);
    }
}
