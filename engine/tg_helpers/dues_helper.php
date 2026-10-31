<?php
/**
 * Dues helper - the dues status engine (dues step 2, 2026-10-31; requirements FIN-20 to FIN-26 and the
 * owner's concept of operations in the Honcho Requirements book, Financial chapter).
 *
 * Membership year Y runs from the day after the due date in Y-1 to the due date in Y: with BPA's
 * due date 09-30, dues paid by Sep 30, 2026 are for 2027, and Oct 1, 2026 starts membership year 2027.
 *
 * Status for the membership year in force (ccmps.status codes, table ccmps_status):
 *   1 Current   chapter dues and National dues both settled (or chapter dues none and National settled)
 *   3 Pending   chapter dues settled, National invoice not yet
 *   2 Past Due  paid up for last year, not renewed for this year, grace period on
 *   5 Expired   not renewed and the grace period is off or ended, or behind by more than a year
 *   0 None      deceased or deleted
 * Lifetime (Current Year 2099) and types marked always_current (Honorary) are always Current.
 * "Settled" = paid or waived, or (quarterly / monthly plans) every installment due so far is paid.
 * Legacy members with no dues records count as renewed when their Current Year reaches the year.
 *
 *   dues_settings()                    the dues settings, read once per page
 *   dues_year_for($date)               the membership year in force on a date
 *   dues_due_date($year)               the date dues for membership year $year are due
 *   dues_grace_active($date)           is the grace period on (manual flag, or before the calendar end)?
 *   dues_member_status($member, $date) [code, reason] for one member row
 *   dues_recalc_member($ccmp_id, $write)       [old, new, reason]; writes ccmps.status when $write
 *   dues_recalc_all($write)            every member: counts, and the members whose status would change
 *   dues_roll_year($write)             keeps system_current_year on the year in force; returns [old, new]
 *         _dues_charge_settled($charge, $date), _dues_member_charges($ccmp_id, $year)
 */

function dues_settings(): array {
    static $s = null;
    if ($s === null) {
        $s = array(
            'due'        => preg_match('/^\d{2}-\d{2}$/', (string) setting('DUES_DUE_DATE', '09-30')) ? (string) setting('DUES_DUE_DATE', '09-30') : '09-30',
            'grace_mode' => setting('DUES_GRACE_MODE', 'manual') === 'calendar' ? 'calendar' : 'manual',
            'grace_end'  => preg_match('/^\d{2}-\d{2}$/', (string) setting('DUES_GRACE_END', '12-31')) ? (string) setting('DUES_GRACE_END', '12-31') : '12-31',
            'grace_flag' => (int) setting('grace_period', 0) === 1,
            'lifetime'   => defined('CCMP_LIFETIME_YEAR') ? (int) CCMP_LIFETIME_YEAR : 2099,
        );
    }
    return $s;
}

function dues_due_date(int $year): string { // dues for membership year $year are due on this date (in $year - 1)
    return ($year - 1).'-'.dues_settings()['due'];
}

function dues_year_for(?string $date = null): int {
    $date = $date ?: date('Y-m-d');
    $y    = (int) substr($date, 0, 4);
    return $date > $y.'-'.dues_settings()['due'] ? $y + 1 : $y; // after this year's due date: next year's membership is in force
}

function dues_grace_active(?string $date = null): bool {
    $date = $date ?: date('Y-m-d');
    $s    = dues_settings();
    if ($s['grace_mode'] === 'manual') {
        return $s['grace_flag'];
    }
    $due = dues_due_date(dues_year_for($date));               // e.g. 2026-09-30
    $end = substr($due, 0, 4).'-'.$s['grace_end'];             // e.g. 2026-12-31
    if ($end < $due) {
        $end = ((int) substr($due, 0, 4) + 1).'-'.$s['grace_end']; // a grace end early in the next calendar year
    }
    return $date <= $end;
}

function _dues_member_charges(int $ccmp_id, int $year): array {
    $model = new Model();
    $out   = array();
    foreach ((array) $model->query_bind("SELECT * FROM dues_charges WHERE ccmp_id = :m AND membership_year = :y AND status != 'void'",
                                         array('m' => $ccmp_id, 'y' => $year), 'object') as $c) {
        $out[$c->kind] = $c;
    }
    return $out;
}

function _dues_charge_settled($charge, string $date): bool {
    if (!$charge) {
        return false;
    }
    if (in_array($charge->status, array('paid', 'waived'), true)) {
        return true;
    }
    if ($charge->status !== 'open' || $charge->plan === 'annual') {
        return false;
    }
    $model = new Model();
    $rows  = $model->query_bind("SELECT COUNT(*) AS n FROM dues_installments WHERE charge_id = :c AND due_date <= :d AND paid_amount < amount",
                                array('c' => (int) $charge->id, 'd' => $date), 'object');
    return (int) ($rows[0]->n ?? 1) === 0; // installments up to date (owner, 2026-10-31)
}

function dues_member_status($m, ?string $date = null): array {
    $date = $date ?: date('Y-m-d');
    $s    = dues_settings();
    if (!empty($m->deceased) || !empty($m->soft_deleted)) {
        return array(0, 'deceased or deleted');
    }
    if ((int) $m->current_year >= $s['lifetime']) {
        return array(1, 'lifetime');
    }
    static $always = null;
    if ($always === null) {
        $model  = new Model();
        $always = array_map('intval', array_column((array) $model->query('SELECT id FROM ccmps_types WHERE always_current = 1', 'array'), 'id'));
    }
    if (in_array((int) $m->ccmp_type, $always, true)) {
        return array(1, 'member type always Current');
    }
    $year    = dues_year_for($date);
    $charges = _dues_member_charges((int) $m->id, $year);
    $chapter = $charges['chapter'] ?? null;
    $nat     = $charges['national'] ?? null;
    $legacy  = !$chapter && !$nat && (int) $m->current_year >= $year;       // renewed in the old way, no dues records
    $chapter_paid = $chapter ? _dues_charge_settled($chapter, $date) : $legacy;
    if ($chapter_paid) {
        if ($legacy) {
            return array(1, 'legacy: Current Year '.(int) $m->current_year.', no dues records');
        }
        return _dues_charge_settled($nat, $date) ? array(1, 'chapter and National paid for '.$year)
                                                 : array(3, 'chapter paid, National '.($nat ? 'invoice open' : 'invoice not raised').' for '.$year);
    }
    // Past Due only for someone paid up last year who missed this year's due date; anyone further behind is Expired
    $prev      = _dues_member_charges((int) $m->id, $year - 1);
    $last_year = isset($prev['chapter']) ? _dues_charge_settled($prev['chapter'], $date) : ((int) $m->current_year >= $year - 1);
    if (!$last_year) {
        return array(5, 'not renewed for '.$year.' or '.($year - 1));
    }
    return dues_grace_active($date) ? array(2, 'paid for '.($year - 1).', not renewed for '.$year.', grace period on')
                                    : array(5, 'paid for '.($year - 1).', not renewed for '.$year.', grace period off');
}

function dues_recalc_member(int $ccmp_id, bool $write = true, ?string $date = null): array {
    $model = new Model();
    $m     = $model->get_where($ccmp_id, 'ccmps');
    if (!$m) {
        return array(null, null, 'no member');
    }
    list($new, $reason) = dues_member_status($m, $date);
    if ($write && (int) $m->status !== $new) {
        $model->update($ccmp_id, array('status' => $new), 'ccmps');
    }
    return array((int) $m->status, $new, $reason);
}

function dues_recalc_all(bool $write = false, ?string $date = null): array {
    $model   = new Model();
    $counts  = array();
    $changes = array();
    foreach ((array) $model->query('SELECT * FROM ccmps', 'object') as $m) {
        list($new, $reason) = dues_member_status($m, $date);
        $counts[$new] = ($counts[$new] ?? 0) + 1;
        if ((int) $m->status !== $new) {
            $changes[] = array('id' => (int) $m->id, 'old' => (int) $m->status, 'new' => $new, 'reason' => $reason, 'current_year' => (int) $m->current_year);
            if ($write) {
                $model->update((int) $m->id, array('status' => $new), 'ccmps');
            }
        }
    }
    ksort($counts);
    return array('year' => dues_year_for($date), 'grace' => dues_grace_active($date), 'counts' => $counts, 'changes' => $changes);
}

function dues_roll_year(bool $write = false, ?string $date = null): array {
    // keeps system_current_year (read by lists, counts and exports) on the membership year in force
    $old = (int) setting('system_current_year', 0);
    $new = dues_year_for($date);
    if ($write && $old !== $new) {
        $model = new Model();
        $model->query_bind("UPDATE system_settings SET settingvalue = :v, updated_at = UNIX_TIMESTAMP() WHERE title = 'system_current_year'", array('v' => (string) $new));
    }
    return array($old, $new);
}
