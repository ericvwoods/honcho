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

/*------------------------------ recording dues (step 3, 2026-10-31) ------------------------------*/
/*
 *   dues_open_year()                     the year renewals are recorded for (current_dues_pmt_year)
 *   dues_chapter($subentity_id)          the chapter row (annual_dues, dues_collected_by)
 *   dues_prorate_factor($scope, $type, $date)  the scope's factor for a new member of this type joining then
 *   dues_record_chapter($ccmp_id, $year, $opts)   chapter dues paid (or renewed), National invoice raised and emailed
 *   dues_reverse_chapter($ccmp_id, $year, $reason, $by)  undoes it: invoice voided, or flagged if already paid
 *   dues_send_invoice($charge)           the National invoice email
 *   dues_financial_admin_emails()        the Financial Admins' addresses (alerts)
 */

function dues_open_year(): int {
    $y = (int) setting('current_dues_pmt_year', 0);
    return $y > 0 ? $y : dues_year_for();
}

function dues_chapter(int $subentity_id) {
    $model = new Model();
    return $subentity_id > 0 ? $model->get_where($subentity_id, 'ccmps_subentities') : false;
}

function dues_prorate_factor(int $scope, int $type_id, string $date): float {
    $model = new Model();
    $applies = $model->query_bind('SELECT 1 FROM dues_proration_types WHERE subentity_id = :s AND ccmp_type_id = :t',
                                  array('s' => $scope, 't' => $type_id), 'object');
    if (empty($applies)) {
        return 1.0;
    }
    $row = $model->query_bind('SELECT factor FROM dues_proration WHERE subentity_id = :s AND join_month = :m',
                              array('s' => $scope, 'm' => (int) substr($date, 5, 2)), 'object');
    return $row ? max(0.0, min(1.0, (float) $row[0]->factor)) : 1.0;
}

function _dues_is_new_member($m): bool { // never paid dues before: proration is for new members only (owner)
    if ((int) $m->current_year > 0) {
        return false;
    }
    $model = new Model();
    $rows  = $model->query_bind("SELECT COUNT(*) AS n FROM dues_charges WHERE ccmp_id = :m AND status IN ('paid', 'waived')", array('m' => (int) $m->id), 'object');
    return (int) ($rows[0]->n ?? 0) === 0;
}

function _dues_charge(int $ccmp_id, int $year, string $kind) {
    $model = new Model();
    $rows  = $model->query_bind('SELECT * FROM dues_charges WHERE ccmp_id = :m AND membership_year = :y AND kind = :k',
                                array('m' => $ccmp_id, 'y' => $year, 'k' => $kind), 'object');
    return $rows ? $rows[0] : false;
}

function dues_record_chapter(int $ccmp_id, int $year, array $opts = array()): array {
    // $opts: method (cash | check | other | none), reference, date (Y-m-d), by (tg user id), note, new_member (bool, optional)
    // Returns [ok, message]. Records the chapter charge as paid (and the payment), raises the National invoice,
    // sets Current Year, recalculates status and emails the invoice.
    $model = new Model();
    $m     = $model->get_where($ccmp_id, 'ccmps');
    if (!$m || !empty($m->deceased) || !empty($m->soft_deleted)) {
        return array(false, 'No active member '.$ccmp_id.'.');
    }
    if ((int) $m->current_year >= dues_settings()['lifetime']) {
        return array(false, trim($m->first_name.' '.$m->last_name).' is a lifetime member: no dues.');
    }
    $date    = preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) ($opts['date'] ?? '')) ? $opts['date'] : date('Y-m-d');
    $by      = (int) ($opts['by'] ?? ($_SESSION['tg_user_id'] ?? 0));
    $method  = in_array($opts['method'] ?? '', array('cash', 'check', 'other', 'none'), true) ? $opts['method'] : 'other';
    $new     = array_key_exists('new_member', $opts) ? (bool) $opts['new_member'] : _dues_is_new_member($m);
    $chapter = dues_chapter((int) $m->subentity);
    $type    = $model->get_where((int) $m->ccmp_type, 'ccmps_types');
    $name    = trim($m->first_name.' '.$m->last_name);

    $existing = _dues_charge($ccmp_id, $year, 'chapter');
    if ($existing && in_array($existing->status, array('paid', 'waived'), true)) {
        return array(false, $name.': chapter dues for '.$year.' are already recorded.');
    }

    // chapter charge, paid (chapter dues may be 0: a plain renewal)
    $full   = round((float) ($chapter->annual_dues ?? 0), 2);
    $factor = $new ? dues_prorate_factor((int) $m->subentity, (int) $m->ccmp_type, $date) : 1.0;
    $amount = round($full * $factor, 2);
    $charge = array('subentity_id' => (int) $m->subentity, 'amount' => $amount, 'full_amount' => $full, 'prorate_factor' => $factor,
                    'balance' => 0, 'status' => 'paid', 'reason' => '', 'paid_at' => time(), 'updated_by' => $by, 'updated_at' => time());
    if ($existing) {
        $model->update((int) $existing->id, $charge, 'dues_charges');
        $chapter_charge_id = (int) $existing->id;
    } else {
        $chapter_charge_id = (int) $model->insert($charge + array('ccmp_id' => $ccmp_id, 'membership_year' => $year, 'kind' => 'chapter', 'plan' => 'annual',
                                                                   'created_by' => $by, 'created_at' => time()), 'dues_charges');
    }
    if ($amount > 0 && $method !== 'none') { // the payment record (Payments, PAY-07); the Chapter at Large's dues go to National
        $pid = (int) $model->insert(array('payer_ccmp_id' => $ccmp_id, 'received_by' => ($chapter && $chapter->dues_collected_by === 'national') ? 0 : (int) $m->subentity,
            'amount' => $amount, 'method' => $method, 'reference' => substr((string) ($opts['reference'] ?? ''), 0, 100), 'received_on' => $date,
            'applies_to' => 'dues_charge', 'applies_to_id' => $chapter_charge_id, 'status' => 'completed', 'notes' => substr((string) ($opts['note'] ?? ''), 0, 255),
            'recorded_by' => $by, 'created_at' => time(), 'updated_at' => time()), 'pay_payments');
        $model->update($pid, array('receipt_number' => sprintf('R%06d', $pid)), 'pay_payments');
    }

    // the National invoice: chapter dues paid is what triggers it (owner's concept of operations)
    $nat = _dues_charge($ccmp_id, $year, 'national');
    $sent = '';
    if (!$nat || $nat->status === 'void') {
        $nfull   = round((float) ($type->national_dues ?? 0), 2);
        $nfactor = $new ? dues_prorate_factor(0, (int) $m->ccmp_type, $date) : 1.0;
        $namount = round($nfull * $nfactor, 2);
        $row = array('subentity_id' => (int) $m->subentity, 'amount' => $namount, 'full_amount' => $nfull, 'prorate_factor' => $nfactor,
                     'balance' => $namount, 'status' => $namount > 0 ? 'open' : 'paid', 'reason' => '', 'paid_at' => $namount > 0 ? 0 : time(),
                     'updated_by' => $by, 'updated_at' => time());
        if ($nat) {
            $model->update((int) $nat->id, $row, 'dues_charges');
            $nat_id = (int) $nat->id;
        } else {
            $nat_id = (int) $model->insert($row + array('ccmp_id' => $ccmp_id, 'membership_year' => $year, 'kind' => 'national', 'plan' => 'annual',
                                                         'created_by' => $by, 'created_at' => time()), 'dues_charges');
        }
        $model->update($nat_id, array('invoice_number' => sprintf('N%d-%06d', $year, $nat_id)), 'dues_charges');
        if ($namount > 0) {
            $sent = dues_send_invoice($model->get_where($nat_id, 'dues_charges')) ? ' National invoice emailed.' : ' National invoice raised (not emailed: no email address).';
        }
    }

    if ((int) $m->current_year < $year) { // Current Year = paid through (chapter dues)
        $model->update($ccmp_id, array('current_year' => $year), 'ccmps');
    }
    dues_recalc_member($ccmp_id, true);
    return array(true, $name.': chapter dues for '.$year.' recorded'.($amount > 0 ? ' ($'.number_format($amount, 2).($factor < 1 ? ', prorated' : '').')' : ' (no chapter dues)').'.'.$sent);
}

function dues_reverse_chapter(int $ccmp_id, int $year, string $reason, int $by = 0): array {
    // Backing out chapter dues (unpaid, bounced check, mistake; FIN-32). Returns [ok, message].
    $model = new Model();
    $m     = $model->get_where($ccmp_id, 'ccmps');
    $ch    = _dues_charge($ccmp_id, $year, 'chapter');
    if (!$m || !$ch || !in_array($ch->status, array('paid', 'waived'), true)) {
        return array(false, 'There are no chapter dues for '.$year.' to reverse.');
    }
    $by     = $by ?: (int) ($_SESSION['tg_user_id'] ?? 0);
    $reason = trim($reason) !== '' ? substr(trim($reason), 0, 200) : 'reversed';
    $name   = trim($m->first_name.' '.$m->last_name);
    $model->query_bind("UPDATE pay_payments SET status = 'reversed', notes = CONCAT(notes, :n), updated_at = :t
                         WHERE applies_to = 'dues_charge' AND applies_to_id = :c AND status = 'completed'",
                       array('n' => ' [reversed: '.$reason.']', 't' => time(), 'c' => (int) $ch->id));
    $model->update((int) $ch->id, array('status' => 'open', 'balance' => $ch->amount, 'paid_at' => 0, 'reason' => 'reversed: '.$reason,
                                        'updated_by' => $by, 'updated_at' => time()), 'dues_charges');
    $msg = $name.': chapter dues for '.$year.' reversed.';
    $nat = _dues_charge($ccmp_id, $year, 'national');
    if ($nat && $nat->status === 'open') { // National isn't expecting the money any more
        $model->update((int) $nat->id, array('status' => 'void', 'balance' => 0, 'reason' => 'chapter dues reversed: '.$reason,
                                             'updated_by' => $by, 'updated_at' => time()), 'dues_charges');
        $email = trim((string) $m->email_address);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            coffee_send_email(array($email), SHORTSITENAME.' National dues invoice '.$nat->invoice_number.' withdrawn',
                "Dear ".trim((string) $m->first_name).",\n\nYour ".SHORTSITENAME." National dues invoice ".$nat->invoice_number." for ".$year
                ." ($".number_format((float) $nat->amount, 2).") has been withdrawn because your chapter dues payment was reversed. You don't need to pay it.\n\n"
                ."If you think this is a mistake, please contact your ".SUBENTITY." Administrator.\n", 'dues');
        }
        $msg .= ' National invoice '.$nat->invoice_number.' voided and the member told.';
    } elseif ($nat && in_array($nat->status, array('paid', 'waived'), true)) { // already paid: a person decides (owner)
        $model->insert(array('ccmp_id' => $ccmp_id, 'charge_id' => (int) $nat->id, 'kind' => 'chapter_reversed_after_national_paid',
            'message' => $name.' ('.$ccmp_id.'): chapter dues for '.$year.' reversed ('.$reason.') after National invoice '.$nat->invoice_number.' was paid.',
            'created_by' => $by, 'created_at' => time()), 'dues_attention');
        $to = dues_financial_admin_emails();
        if ($to) {
            coffee_send_email($to, SHORTSITENAME.' dues: needs attention ('.$name.')',
                $name." (member ".$ccmp_id."): chapter dues for ".$year." were reversed (".$reason.") after National invoice ".$nat->invoice_number
                ." ($".number_format((float) $nat->amount, 2).") was already paid.\n\nNothing was undone on the National side. Please decide what to do; the case is on the dues Needs attention list.\n", 'dues');
        }
        $msg .= ' National invoice '.$nat->invoice_number.' was already paid: the Financial Admin has been alerted.';
    }
    if ((int) $m->current_year === $year) {
        $model->update($ccmp_id, array('current_year' => $year - 1), 'ccmps');
    }
    dues_recalc_member($ccmp_id, true);
    return array(true, $msg);
}

function dues_send_invoice($charge): bool {
    $model = new Model();
    $m     = $charge ? $model->get_where((int) $charge->ccmp_id, 'ccmps') : false;
    $email = $m ? trim((string) $m->email_address) : '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    $type  = $model->get_where((int) $m->ccmp_type, 'ccmps_types');
    $due   = date('F j, Y', strtotime(dues_due_date((int) $charge->membership_year)));
    $text  = "Dear ".trim((string) $m->first_name).",\n\n"
           . "Thank you: your ".strtolower(SUBENTITY)." dues for membership year ".$charge->membership_year." have been recorded. Here is your "
           . SHORTSITENAME." National dues invoice.\n\n"
           . "Invoice: ".$charge->invoice_number."\n"
           . "Member: ".trim($m->first_name.' '.$m->last_name)." (".CCMP." No. ".$m->ccmp_number.")\n"
           . "Membership year: ".$charge->membership_year."\n"
           . "Member type: ".($type->description ?? '')."\n"
           . "Amount due: $".number_format((float) $charge->amount, 2)
           . ((float) $charge->prorate_factor < 1 ? " (new member, prorated from $".number_format((float) $charge->full_amount, 2).")" : '')."\n"
           . "Due by: ".$due."\n\n"
           . trim((string) setting('DUES_PAY_INSTRUCTIONS', ''))."\n\n"
           . "Your membership is Pending until National receives this payment.\n";
    $sent = coffee_send_email(array($email), SHORTSITENAME.' National dues invoice '.$charge->invoice_number, $text, 'dues');
    if ($sent['sent'] > 0) {
        $model->update((int) $charge->id, array('invoiced_at' => time()), 'dues_charges');
        return true;
    }
    return false;
}

function dues_financial_admin_emails(): array {
    $model = new Model();
    $rows  = $model->query("SELECT DISTINCT c.email_address FROM system_group_users gu
                              JOIN system_groups g ON g.id = gu.group_id AND g.title = 'Financial Admins'
                              JOIN ccmps c ON c.trongate_user_id = gu.tg_user_id
                             WHERE c.email_address LIKE '%@%' AND COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1", 'object');
    return array_values(array_filter(array_map(function ($r) { return trim((string) $r->email_address); }, (array) $rows)));
}

function dues_engine_on(): bool {
    return (int) setting('DUES_STATUS_ENGINE', 0) === 1;
}

function dues_can_record($m): bool {
    // may the signed-in person record or reverse this member's chapter dues? Chapter Admins: their own chapter's
    // members, unless the chapter's dues are collected by National (the Chapter at Large); National's dues people: anyone
    if (!$m || !dues_engine_on() || !rbac_allowed('fin', 'record_chapter_dues')) {
        return false;
    }
    $national = rbac_allowed('fin', 'settle_national_dues');
    if ($national) {
        return true;
    }
    $chapter = dues_chapter((int) $m->subentity);
    if ($chapter && $chapter->dues_collected_by === 'national') {
        return false;
    }
    return !empty($_SESSION['ccmps_subentity_admin']) && (int) ($_SESSION['ccmps_subentity'] ?? -1) === (int) $m->subentity;
}

/*------------------------- National's side (step 4, 2026-10-31) -------------------------*/
/*
 *   dues_mark_national_paid($charge_id, $opts)   the National invoice paid: payment recorded, member recalculated
 *   dues_reverse_national($charge_id, $reason)   a bounced or mistaken National payment: invoice reopened
 *   dues_set_charge_status($charge_id, 'void' | 'waived', $reason)   corrections by a Financial Admin
 *   dues_attention_open()                         the Needs attention cases not yet resolved
 */

function dues_mark_national_paid(int $charge_id, array $opts = array()): array {
    $model = new Model();
    $c     = $model->get_where($charge_id, 'dues_charges');
    if (!$c || $c->kind !== 'national') {
        return array(false, 'No such National invoice.');
    }
    $m    = $model->get_where((int) $c->ccmp_id, 'ccmps');
    $name = $m ? trim($m->first_name.' '.$m->last_name) : 'member '.$c->ccmp_id;
    if ($c->status !== 'open') {
        return array(false, $name.': invoice '.$c->invoice_number.' is '.$c->status.', not open.');
    }
    $by     = (int) ($opts['by'] ?? ($_SESSION['tg_user_id'] ?? 0));
    $date   = preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) ($opts['date'] ?? '')) ? $opts['date'] : date('Y-m-d');
    $method = in_array($opts['method'] ?? '', array('cash', 'check', 'other', 'paypal'), true) ? $opts['method'] : 'other';
    $pid = (int) $model->insert(array('payer_ccmp_id' => (int) $c->ccmp_id, 'received_by' => 0, 'amount' => $c->balance, 'method' => $method,
        'reference' => substr((string) ($opts['reference'] ?? ''), 0, 100), 'received_on' => $date, 'applies_to' => 'dues_charge', 'applies_to_id' => $charge_id,
        'status' => 'completed', 'notes' => substr((string) ($opts['note'] ?? ''), 0, 255), 'recorded_by' => $by, 'created_at' => time(), 'updated_at' => time()), 'pay_payments');
    $model->update($pid, array('receipt_number' => sprintf('R%06d', $pid)), 'pay_payments');
    $model->update($charge_id, array('status' => 'paid', 'balance' => 0, 'paid_at' => time(), 'updated_by' => $by, 'updated_at' => time()), 'dues_charges');
    dues_recalc_member((int) $c->ccmp_id, true);
    return array(true, $name.': National invoice '.$c->invoice_number.' paid ($'.number_format((float) $c->balance, 2).').');
}

function dues_reverse_national(int $charge_id, string $reason, int $by = 0): array {
    $model = new Model();
    $c     = $model->get_where($charge_id, 'dues_charges');
    if (!$c || $c->kind !== 'national' || $c->status !== 'paid') {
        return array(false, 'Only a paid National invoice can be reversed.');
    }
    $by     = $by ?: (int) ($_SESSION['tg_user_id'] ?? 0);
    $reason = trim($reason) !== '' ? substr(trim($reason), 0, 200) : 'reversed';
    $model->query_bind("UPDATE pay_payments SET status = 'reversed', notes = CONCAT(notes, :n), updated_at = :t
                         WHERE applies_to = 'dues_charge' AND applies_to_id = :c AND status = 'completed'",
                       array('n' => ' [reversed: '.$reason.']', 't' => time(), 'c' => $charge_id));
    $model->update($charge_id, array('status' => 'open', 'balance' => $c->amount, 'paid_at' => 0, 'reason' => 'payment reversed: '.$reason,
                                     'updated_by' => $by, 'updated_at' => time()), 'dues_charges');
    dues_recalc_member((int) $c->ccmp_id, true);
    return array(true, 'National invoice '.$c->invoice_number.' payment reversed; the invoice is open again.');
}

function dues_set_charge_status(int $charge_id, string $status, string $reason, int $by = 0): array {
    // Void (a mistake: the charge no longer counts) or Waive (forgiven: counts as settled); a reason is required
    $model = new Model();
    $c     = $model->get_where($charge_id, 'dues_charges');
    if (!$c || !in_array($status, array('void', 'waived'), true) || trim($reason) === '') {
        return array(false, 'Choose the invoice and give a reason.');
    }
    if (!in_array($c->status, array('open'), true)) {
        return array(false, ($c->invoice_number ?: 'That charge').' is '.$c->status.': only an open one can be voided or waived.');
    }
    $model->update($charge_id, array('status' => $status, 'balance' => 0, 'reason' => $status.': '.substr(trim($reason), 0, 200),
                                     'updated_by' => $by ?: (int) ($_SESSION['tg_user_id'] ?? 0), 'updated_at' => time()), 'dues_charges');
    dues_recalc_member((int) $c->ccmp_id, true);
    return array(true, ($c->invoice_number ?: ucfirst($c->kind).' charge').' '.($status === 'void' ? 'voided' : 'waived').'.');
}

function dues_attention_open(): array {
    $model = new Model();
    return (array) $model->query("SELECT a.*, CONCAT(c.first_name, ' ', c.last_name) AS member_name FROM dues_attention a
                                    LEFT JOIN ccmps c ON c.id = a.ccmp_id WHERE a.resolved_at = 0 ORDER BY a.id", 'object');
}
