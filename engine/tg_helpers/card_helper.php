<?php
/*
  Card helper - digital membership cards (plan 2026-10-26; phase 1: the card in the
  portal and the phone app). Used by modules/welcome/cards and the phone API.

  card_for_member($ccmp_id, $create)        the member's active card row (made when $create), or false
  card_code($card)                          the text in the QR code: HC1:<card id>:<signature>
  card_lookup($code)                        a scanned code -> its active card row, or false
  card_reissue($ccmp_id, $by, $reason)      cancels the active card and issues a new one
  card_details($ccmp_id)                    what the card shows: name, number, chapter, type, valid through, photo
        _card_secret()                      the signing key: CARD_SECRET from .env, or derived from JWT_SECRET
        _card_signature($card)              HMAC of the card id and issue time, 22 characters

  The code holds no personal information and the table holds nothing that makes a
  working code: a code is only valid if its signature matches with the key from .env
  and its card row is still active. Changing the key cancels every card at once.
*/

function _card_secret(): string {
    $secret = (string) env('CARD_SECRET', '');
    if ($secret === '') {
        $jwt = (string) env('JWT_SECRET', '');
        if ($jwt === '') {
            throw new RuntimeException('Member cards need CARD_SECRET or JWT_SECRET in .env.');
        }
        $secret = hash_hmac('sha256', 'honcho-member-cards', $jwt); // a separate key derived from the API key
    }
    return $secret;
}

function _card_signature(object $card): string {
    $raw = hash_hmac('sha256', 'card:'.(int) $card->id.':'.(int) $card->issued_at, _card_secret(), true);
    return rtrim(strtr(base64_encode(substr($raw, 0, 16)), '+/', '-_'), '='); // 128 bits, URL-safe
}

function card_code(object $card): string {
    return 'HC1:'.(int) $card->id.':'._card_signature($card);
}

function card_for_member(int $ccmp_id, bool $create = true) {
    $model = new Model();
    $rows  = $model->query_bind("SELECT * FROM ccmps_cards WHERE ccmp_id = :id AND status = 'active' ORDER BY id DESC LIMIT 1",
                                array('id' => $ccmp_id), 'object');
    if (!empty($rows)) {
        return $rows[0];
    }
    if (!$create) {
        return false;
    }
    $member = $model->get_where($ccmp_id, 'ccmps');
    if (!$member || !empty($member->deceased) || !empty($member->soft_deleted)) {
        return false; // no card for deceased or deleted members
    }
    $id = $model->insert(array('ccmp_id' => $ccmp_id, 'status' => 'active', 'issued_at' => time(), 'issued_by' => 0), 'ccmps_cards');
    return $model->get_where((int) $id, 'ccmps_cards');
}

function card_lookup(string $code) {
    if (!preg_match('/^HC1:(\d{1,10}):([A-Za-z0-9_-]{22})$/', trim($code), $m)) {
        return false; // not one of our codes
    }
    $model = new Model();
    $card  = $model->get_where((int) $m[1], 'ccmps_cards');
    if (!$card || !hash_equals(_card_signature($card), $m[2])) {
        return false; // made up, or signed with another key
    }
    return $card; // the caller checks $card->status ('cancelled' = lost or replaced)
}

function card_reissue(int $ccmp_id, int $by, string $reason = 'Lost or replaced') {
    $model = new Model();
    $model->query_bind("UPDATE ccmps_cards SET status = 'cancelled', cancelled_at = :at, cancelled_by = :by, cancel_reason = :reason
                         WHERE ccmp_id = :id AND status = 'active'",
                       array('at' => time(), 'by' => $by, 'reason' => substr($reason, 0, 100), 'id' => $ccmp_id));
    $member = $model->get_where($ccmp_id, 'ccmps');
    if (!$member || !empty($member->deceased) || !empty($member->soft_deleted)) {
        return false;
    }
    $id = $model->insert(array('ccmp_id' => $ccmp_id, 'status' => 'active', 'issued_at' => time(), 'issued_by' => $by), 'ccmps_cards');
    return $model->get_where((int) $id, 'ccmps_cards');
}

function card_details(int $ccmp_id) {
    $model = new Model();
    $rows  = $model->query_bind("SELECT c.id, c.first_name, c.last_name, c.suffix, c.ccmp_number, c.current_year, c.picture,
                                        t.description AS member_type, s.description AS chapter
                                   FROM ccmps c
                                   LEFT JOIN ccmps_types t       ON t.id = c.ccmp_type
                                   LEFT JOIN ccmps_subentities s ON s.id = c.subentity
                                  WHERE c.id = :id", array('id' => $ccmp_id), 'object');
    if (empty($rows)) {
        return false;
    }
    $m    = $rows[0];
    $year = (int) $m->current_year;
    return (object) array(
        'ccmp_id'       => (int) $m->id,
        'name'          => trim($m->first_name.' '.$m->last_name.' '.$m->suffix),
        'member_number' => (string) $m->ccmp_number,
        'member_type'   => (string) $m->member_type,
        'chapter'       => (string) $m->chapter,
        'valid_through' => $year >= CCMP_LIFETIME_YEAR ? 'Lifetime' : ($year > 0 ? (string) $year : ''),
        'photo_url'     => $m->picture != '' ? BASE_URL.'welcome-ccmps_module/assets/'.(int) $m->id.'/'.rawurlencode($m->picture) : '',
        'initials'      => strtoupper(substr((string) $m->first_name, 0, 1).substr((string) $m->last_name, 0, 1)),
        'org_name'      => SITENAME,
        'org_short'     => SHORTSITENAME,
        'member_word'   => CCMP,
    );
}
