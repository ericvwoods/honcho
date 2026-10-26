<?php
/* ============================================================
   Api.php — mobile API controller (welcome-api child module)
   ============================================================
   A deliberately SEPARATE controller from Ccmps.php, not new methods
   bolted onto it. Ccmps.php renders full HTML pages via session-based
   auth; this returns JSON via token-based auth — different enough
   concerns that keeping them apart avoids tangling the two auth models
   together, and keeps this addable without touching the existing
   ~8,000-line controller at all.

   Lives as its own child module of welcome (sibling to ccmps, not
   nested inside it) — Trongate's routing is parent-dash-child, so
   welcome-ccmps-api (two dashes) wasn't valid; welcome-api is.
   Endpoints below are reached as welcome-api/<method-name>, e.g.
   welcome-api/login, welcome-api/mydata.

   Scope, per explicit spec: Contact Information and Addresses fields
   (not the full member record) — see CONTACT_TEXT_FIELDS /
   ADDR_TEXT_FIELDS / ADDR_BOOL_FIELDS below — plus call_sign
   (AUX_TEXT_FIELDS), added afterward and living on the separate
   ccmps_aux table rather than ccmps itself. Extending further means
   adding to these lists and, if a new field lives on yet another
   table, giving it its own array the same way AUX_TEXT_FIELDS was
   added alongside the original two.

   Auth: JWT (see lib/JwtHelper.php), not $_SESSION — a mobile app has
   no browser cookie jar shared with the web app, and needs a token it
   can store and resend itself. JWT_SECRET must be defined somewhere in
   config (see the constant check in _get_secret() below) — treat it
   like a password: long, random, never committed to a public repo.

   JwtHelper.php lives in its own lib/ subfolder, not directly
   alongside Api.php — done as a precaution after noticing every other
   module in this app has exactly one PHP file directly in its folder
   (the controller itself), on the theory that Trongate's router might
   expect exactly one class extending Trongate per module folder. That
   specific 404 turned out to have a different, unrelated cause (a
   missing .php extension on Api.php itself) — this move was never
   confirmed to matter one way or the other, but kept since it's
   harmless and matches the rest of the app's convention regardless.
   ============================================================ */

require_once __DIR__ . '/lib/JwtHelper.php';

class Api extends Trongate {

    // Only these fields are ever readable/writable through this API —
    // matches the explicit scope: Contact Information + Addresses only,
    // not the full member record. Deliberately NOT reusing Ccmps.php's
    // much broader $ccmps_text_fields whitelist, since that includes
    // membership/admin fields well outside what was asked for here.
    private $CONTACT_TEXT_FIELDS = [
        'email_address', 'phone', 'mobile', 'fax', 'website', 'url_string',
        'alternate_contact', 'alternate_phone', 'alternate_email',
        'emergency_contact', 'emergency_phone', 'emergency_email',
    ];

    private $ADDR_TEXT_FIELDS = [
        'mailaddress1', 'mailaddress2', 'mailcity', 'mailstate', 'mailzip', 'mailcounty', 'mailcountry',
        'physaddress1', 'physaddress2', 'physcity', 'physstate', 'physzip', 'physcounty', 'physcountry',
        'billname', 'billphone', 'billaddress1', 'billaddress2', 'billcity', 'billstate', 'billzip', 'billcounty', 'billcountry',
        'shipname', 'shipphone', 'shipaddress1', 'shipaddress2', 'shipcity', 'shipstate', 'shipzip', 'shipcounty', 'shipcountry',
    ];

    private $ADDR_BOOL_FIELDS = ['mail_phys', 'bill_ship'];

    // Lives directly on ccmps, alongside CONTACT_TEXT_FIELDS — kept as
    // its own separate list purely for readability/organization on the
    // client (these render at the top of the form, contact fields
    // below), not because they need different save logic.
    // salutation is a foreign key into ref_salutations, submitted here
    // as a plain numeric id, same as the web form's own dropdown does —
    // there's no id-to-label lookup built into this mobile form (see
    // the note in index.html), so entering the wrong number silently
    // saves whatever id was typed, not a validation error.
    private $NAME_TEXT_FIELDS = ['salutation', 'first_name', 'middle_name', 'last_name', 'suffix'];

    // Lives on ccmps_aux, not ccmps or ccmps_addresses — a genuinely
    // separate table, so it needs its own save logic in update_mydata()
    // rather than just being added to CONTACT_TEXT_FIELDS. call_sign
    // was added first (displayed in the Contact section on the client);
    // the rest were added together as the "Pilot Certificates and
    // Ratings" section. highest_certificate is a foreign key into
    // ccmps_certificate_types, submitted as a plain numeric id — same
    // caveat as salutation above, no label lookup on this mobile form.
    private $AUX_TEXT_FIELDS = [
        'call_sign', 'total_time', 'highest_certificate', 'certificate_number',
        'other_crewmember', 'ocm_certnum', 'other_faa_cert', 'ofc_certnum',
        'ap_number', 'maintenance', 'cred_notes',
    ];

    // Same table as AUX_TEXT_FIELDS, just the boolean (checkbox)
    // columns, handled separately since they need the same "absent
    // from POST means false" checkbox logic the web form's
    // extract_bools() uses. Deliberately excludes aircraft_owner —
    // that one is auto-computed from the actual ccmps_aircraft records
    // on every load (matching Ccmps::_get_a_single_record()'s own
    // "sync with reality" logic), not something this form lets a
    // member directly override by hand.
    private $AUX_BOOL_FIELDS = [
        'military_pilot', 'military_maint',
        'private', 'commercial', 'atp', 'cfi', 'cfii', 'mei', 'dpe', 'bgi', 'agi',
        'dispatcher', 'atc', 'ap', 'ia',
        'se_land', 'me_land', 'se_sea', 'me_sea', 'instrument',
        'rotocraft', 'glider', 'balloon', 'drone', 'airship',
    ];

    // Lives directly on ccmps, not ccmps_aux — same table as
    // NAME_TEXT_FIELDS/CONTACT_TEXT_FIELDS. Matches Ccmps.php's own
    // ccmpsubmit() whitelist for the subset of ccmps boolean columns
    // that are genuinely member-editable (not admin-only, matching
    // that function's own broader_admin_only_bool exclusions).
    // former_military and the 4 Preferences checkboxes added on
    // request. Two siblings on the same table (active_duty, minor)
    // are equally member-editable per the web app's own permission
    // model but aren't yet exposed here; flagged rather than added
    // speculatively.
    private $CCMPS_BOOL_FIELDS = ['former_military', 'donotcall', 'emailoptout', 'directoryoptout', 'mail_notices'];

    /* ------------------------------------------------------------
       Response helpers — every endpoint funnels through these, so
       the response shape ({success, data} or {success, error}) and
       HTTP status codes stay consistent across the whole API.
       ------------------------------------------------------------ */

    private function json_success($data = []) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
    }

    private function json_error($message, $status = 400) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $message]);
    }

    private function get_secret() {
        if (!defined('JWT_SECRET') || strlen(JWT_SECRET) < 32) {
            // Fails loudly rather than falling back to a weak/guessable
            // default — a short-circuit secret would be a genuine
            // security hole, not a convenience worth having.
            throw new Exception('JWT_SECRET is not configured. Add a long, random JWT_SECRET constant to config.php before using this API.');
        }
        return JWT_SECRET;
    }

    /**
     * Reads the Bearer token from the Authorization header, verifies
     * it, and returns the authenticated member's ccmps.id — or sends a
     * 401 JSON error and returns null if anything's wrong. Every
     * endpoint below except login() calls this first.
     */
    private function require_auth() {
        // getallheaders() alone isn't reliable on every hosting setup —
        // many shared/cPanel Apache+PHP configurations silently strip
        // the Authorization header before it reaches PHP's normal
        // header list, unless something explicitly passes it through.
        // $_SERVER['HTTP_AUTHORIZATION'] and the REDIRECT_ variant
        // (populated when Apache internally redirects the request,
        // common in CGI/FastCGI setups) are the standard fallbacks for
        // this exact, well-known quirk — checked in order, first
        // non-empty one wins.
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $auth_header = $headers['Authorization']
            ?? $headers['authorization']
            ?? $_SERVER['HTTP_AUTHORIZATION']
            ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
            ?? '';

        if (empty($auth_header) || stripos($auth_header, 'Bearer ') !== 0) {
            $this->json_error('Missing or malformed Authorization header.', 401);
            return null;
        }

        $token = trim(substr($auth_header, 7));

        try {
            $claims = JwtHelper::decode($token, $this->get_secret());
        } catch (Exception $e) {
            $this->json_error('Invalid or expired token.', 401);
            return null;
        }

        if (empty($claims['ccmp_id'])) {
            $this->json_error('Malformed token.', 401);
            return null;
        }

        // Confirm the member this token claims to be actually still
        // exists and isn't soft-deleted — a token issued before someone
        // was deactivated shouldn't keep working just because it hasn't
        // technically expired yet.
        $ccmp = $this->model->get_where((int) $claims['ccmp_id'], 'ccmps');
        if (!$ccmp || !empty($ccmp->soft_deleted) || !empty($ccmp->deceased)) {
            $this->json_error('Account no longer active.', 401);
            return null;
        }

        return (int) $claims['ccmp_id'];
    }

    /* ------------------------------------------------------------
       POST /welcome-api/login
       Body: { "username": "...", "password": "..." }
       ------------------------------------------------------------ */

    function login() {
        $username = post('username', true);
        $password = post('password', true);

        if (empty($username) || empty($password)) {
            $this->json_error('Username and password are required.');
            return;
        }

        // Matches the same lookup ccmps' own web login uses — one
        // record per username, password checked via password_verify()
        // against the bcrypt hash already stored in ccmps.password.
        $ccmp = $this->model->get_one_where('username', $username, 'ccmps');

        if (!$ccmp || !empty($ccmp->soft_deleted) || !empty($ccmp->deceased)) {
            // Deliberately the same error for "no such user" and "wrong
            // password" — a different message for each would let an
            // attacker enumerate valid usernames.
            $this->json_error('Invalid username or password.', 401);
            return;
        }

        if (!password_verify($password, $ccmp->password)) {
            $this->json_error('Invalid username or password.', 401);
            return;
        }

        try {
            $secret = $this->get_secret();
        } catch (Exception $e) {
            $this->json_error($e->getMessage(), 500);
            return;
        }

        $ttl_seconds = 60 * 60 * 24 * 30; // 30 days — a mobile app shouldn't force a re-login every hour
        $token = JwtHelper::encode(['ccmp_id' => (int) $ccmp->id], $secret, $ttl_seconds);

        $this->json_success([
            'token'      => $token,
            'expires_at' => time() + $ttl_seconds,
            'ccmp_id'    => (int) $ccmp->id,
            'first_name' => $ccmp->first_name,
            'last_name'  => $ccmp->last_name,
        ]);
    }

    /* ------------------------------------------------------------
       GET /welcome-api/mydata
       Header: Authorization: Bearer <token>
       Returns only the Contact Information + Addresses fields.
       ------------------------------------------------------------ */

    function mydata() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return; // require_auth() already sent the error response
        }

        $ccmp = $this->model->get_where($ccmp_id, 'ccmps');
        $addr = $this->model->get_one_where('ccmp_id', $ccmp_id, 'ccmps_addresses');
        $aux  = $this->model->get_one_where('ccmp_id', $ccmp_id, 'ccmps_aux');

        // ccmp_type is a foreign key into ccmps_types — resolved here,
        // server-side, to its human-readable description, since this
        // is read-only display only (unlike salutation/
        // highest_certificate, there's no need for the client to know
        // the raw id at all). Falls back to the raw id if the lookup
        // table or matching row isn't found, rather than failing the
        // whole mydata() call over one missing reference row.
        $ccmp_type_label = '';
        if (!empty($ccmp->ccmp_type)) {
            try {
                $type_row = $this->model->get_where($ccmp->ccmp_type, 'ccmps_types');
                $ccmp_type_label = $type_row->description ?? (string) $ccmp->ccmp_type;
            } catch (\Throwable $e) {
                $ccmp_type_label = (string) $ccmp->ccmp_type;
            }
        }

        $result = [
            'ccmp_id' => $ccmp_id,
            // All five of these are read-only display, matching the web
            // app's own conventions — none are in any whitelist, so
            // update_mydata() will never accept a client-submitted
            // change to any of them. Membership number/type, voter
            // eligibility, and Hall of Fame status are admin-managed,
            // not member-editable.
            'ccmp_number'    => $ccmp->ccmp_number ?? '',
            'ccmp_type'      => $ccmp_type_label,
            'current_year'   => $ccmp->current_year ?? '',
            'eligible_voter' => !empty($ccmp->eligible_voter) ? 1 : 0,
            'hall_of_fame'   => !empty($aux->hall_of_fame) ? 1 : 0,
        ];

        foreach ($this->NAME_TEXT_FIELDS as $field) {
            $result[$field] = $ccmp->{$field} ?? '';
        }

        foreach ($this->CCMPS_BOOL_FIELDS as $field) {
            $result[$field] = !empty($ccmp->{$field}) ? 1 : 0;
        }

        foreach ($this->CONTACT_TEXT_FIELDS as $field) {
            $result[$field] = $ccmp->{$field} ?? '';
        }

        foreach ($this->ADDR_TEXT_FIELDS as $field) {
            $result[$field] = $addr->{$field} ?? '';
        }

        foreach ($this->ADDR_BOOL_FIELDS as $field) {
            $result[$field] = !empty($addr->{$field}) ? 1 : 0;
        }

        foreach ($this->AUX_TEXT_FIELDS as $field) {
            $result[$field] = $aux->{$field} ?? '';
        }

        foreach ($this->AUX_BOOL_FIELDS as $field) {
            $result[$field] = !empty($aux->{$field}) ? 1 : 0;
        }

        // Aircraft — a genuine one-to-many list, not a flat field like
        // everything above, matching Ccmps::_get_a_single_record()'s
        // own handling of the same table.
        $aircraft_rows = $this->model->get_where_custom('ccmp_id', $ccmp_id, '=', 'id', 'ccmps_aircraft');
        $result['aircraft'] = [];
        foreach ($aircraft_rows as $row) {
            $result['aircraft'][] = [
                'id'                  => (int) $row->id,
                'registration_number' => $row->registration_number ?? '',
                'make'                => $row->make ?? '',
                'model'               => $row->model ?? '',
                'hp'                  => $row->hp ?? '',
                'engines'             => $row->engines ?? '',
                'own_rent'            => !empty($row->own_rent) ? 1 : 0,
            ];
        }

        $this->json_success($result);
    }

    /* ------------------------------------------------------------
       POST /welcome-api/update_mydata
       Header: Authorization: Bearer <token>
       Body: JSON object with any subset of the whitelisted fields.
       Same two-whitelist save pattern as Ccmps::ccmpsubmit() — only
       fields on the list can ever be written, everything else in the
       submitted body is silently ignored.
       ------------------------------------------------------------ */

    function update_mydata() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $raw_body = file_get_contents('php://input');
        $submitted = json_decode($raw_body, true);

        if (!is_array($submitted)) {
            $this->json_error('Request body must be a JSON object.');
            return;
        }

        $ccmp_update = [];
        foreach ($this->NAME_TEXT_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $ccmp_update[$field] = trim((string) $submitted[$field]);
            }
        }
        foreach ($this->CCMPS_BOOL_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $ccmp_update[$field] = !empty($submitted[$field]) ? 1 : 0;
            }
        }
        foreach ($this->CONTACT_TEXT_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $ccmp_update[$field] = trim((string) $submitted[$field]);
            }
        }

        // salutation is an integer FK column — an empty string here
        // (the "-- Select --" case on a proper dropdown, or simply a
        // blank text field on this mobile form) gets rejected outright
        // by MySQL strict mode for an int column. Same fix Ccmps.php's
        // own ccmpsubmit() already applies to this exact column.
        if (array_key_exists('salutation', $ccmp_update) && $ccmp_update['salutation'] === '') {
            $ccmp_update['salutation'] = 0;
        }

        $addr_update = [];
        foreach ($this->ADDR_TEXT_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $addr_update[$field] = trim((string) $submitted[$field]);
            }
        }
        foreach ($this->ADDR_BOOL_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $addr_update[$field] = !empty($submitted[$field]) ? 1 : 0;
            }
        }

        $aux_update = [];
        foreach ($this->AUX_TEXT_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $aux_update[$field] = trim((string) $submitted[$field]);
            }
        }
        foreach ($this->AUX_BOOL_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $aux_update[$field] = !empty($submitted[$field]) ? 1 : 0;
            }
        }

        // Same reasoning as salutation above — highest_certificate is
        // also a dropdown now, and an empty selection submits as ''.
        // Not confirmed whether ccmps_aux enforces strict-int the same
        // way ccmps.salutation does, but coercing '' to 0 is harmless
        // either way and cheap insurance against the same failure mode.
        if (array_key_exists('highest_certificate', $aux_update) && $aux_update['highest_certificate'] === '') {
            $aux_update['highest_certificate'] = 0;
        }

        // Same email-uniqueness rule as the web form's ccmpsubmit() —
        // re-checked here independently, since this is a completely
        // separate request path and can't assume the mobile client
        // validated anything honestly.
        if (isset($ccmp_update['email_address']) && strlen($ccmp_update['email_address']) > 0) {
            $existing = $this->model->get_one_where('email_address', $ccmp_update['email_address'], 'ccmps');
            if ($existing && (int) $existing->id !== $ccmp_id) {
                $this->json_error('That email address is already in use by another member.');
                return;
            }
        }

        if (!empty($ccmp_update)) {
            $this->model->update($ccmp_id, $ccmp_update, 'ccmps');
        }

        if (!empty($addr_update)) {
            $addr_row = $this->model->get_one_where('ccmp_id', $ccmp_id, 'ccmps_addresses');
            if ($addr_row) {
                $this->model->update($addr_row->id, $addr_update, 'ccmps_addresses');
            } else {
                $addr_update['ccmp_id'] = $ccmp_id;
                $this->model->insert($addr_update, 'ccmps_addresses');
            }
        }

        if (!empty($aux_update)) {
            $aux_row = $this->model->get_one_where('ccmp_id', $ccmp_id, 'ccmps_aux');
            if ($aux_row) {
                $this->model->update($aux_row->id, $aux_update, 'ccmps_aux');
            } else {
                $aux_update['ccmp_id'] = $ccmp_id;
                $this->model->insert($aux_update, 'ccmps_aux');
            }
        }

        // Aircraft — a genuine one-to-many list, not a flat set of
        // fields. Same per-row logic as Ccmps::ccmpsubmit()'s own
        // aircraft handling: a row with a real id that's confirmed to
        // belong to this member gets updated (or deleted, if its
        // "delete" flag is set); a row with no id but real data gets
        // inserted; a genuinely blank row is silently skipped.
        // Ownership is always re-verified against the database — never
        // trust a submitted id at face value.
        if (isset($submitted['aircraft']) && is_array($submitted['aircraft'])) {
            $aircraft_fields = ['registration_number', 'make', 'model', 'hp', 'engines'];

            $existing_aircraft = $this->model->get_where_custom('ccmp_id', $ccmp_id, '=', 'id', 'ccmps_aircraft');
            $owned_aircraft_ids = [];
            foreach ($existing_aircraft as $ac) {
                $owned_aircraft_ids[] = (string) $ac->id;
            }

            foreach ($submitted['aircraft'] as $row) {
                if (!is_array($row)) {
                    continue;
                }

                $ac_data = [];
                foreach ($aircraft_fields as $field) {
                    if (isset($row[$field])) {
                        $ac_data[$field] = trim((string) $row[$field]);
                    }
                }
                $ac_data['own_rent'] = !empty($row['own_rent']) ? 1 : 0;

                $has_real_data = false;
                foreach ($aircraft_fields as $field) {
                    if (!empty($ac_data[$field])) {
                        $has_real_data = true;
                        break;
                    }
                }

                $submitted_id = !empty($row['id']) ? (string) $row['id'] : '';
                $wants_delete = !empty($row['delete']);

                if ($submitted_id !== '' && in_array($submitted_id, $owned_aircraft_ids, true)) {
                    if ($wants_delete) {
                        $this->model->delete((int) $submitted_id, 'ccmps_aircraft');
                    } else {
                        $this->model->update((int) $submitted_id, $ac_data, 'ccmps_aircraft');
                    }
                } elseif ($submitted_id === '' && $has_real_data && !$wants_delete) {
                    $ac_data['ccmp_id'] = $ccmp_id;
                    $this->model->insert($ac_data, 'ccmps_aircraft');
                }
                // Anything else (blank new row, or an id that doesn't
                // belong to this person) is silently ignored.
            }
        }

        $this->json_success(['updated' => true]);
    }

    /* ------------------------------------------------------------
       GET /welcome-api/chapterroster
       Header: Authorization: Bearer <token>
       The authenticated member's own chapter, determined server-side
       from their own record — never from a client-submitted chapter
       id, so nobody can request a different chapter's roster by
       tampering with a request parameter.
       ------------------------------------------------------------ */

    function chapterroster() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $me = $this->model->get_where($ccmp_id, 'ccmps');
        $subentity_id = $me->subentity ?? null;

        if (empty($subentity_id)) {
            $this->json_error('You are not assigned to a '.strtolower(SUBENTITY).'.', 404);
            return;
        }

        // Same "current members only" rule as directory() — added on
        // request, since this was previously missing here, meaning a
        // lapsed member would still show up in their own chapter's
        // roster despite already correctly disappearing from Directory.
        $system_current_year = (int) setting('system_current_year', date('Y'));

        $sql = "
            SELECT c.id, c.first_name, c.last_name,
                   c.email_address, c.phone, c.mobile, c.directoryoptout,
                   a.call_sign
            FROM ccmps c
            LEFT JOIN ccmps_aux a ON a.ccmp_id = c.id
            WHERE c.subentity = " . (int) $subentity_id . "
              AND c.deceased != 1
              AND c.soft_deleted != 1
              AND c.current_year >= " . $system_current_year . "
            ORDER BY c.last_name, c.first_name
        ";
        $rows = $this->model->query($sql, 'object');

        $members = [];
        foreach ($rows as $row) {
            // Chapter roster still respects directoryoptout, same as
            // the web directory does — being visible to your own
            // chapter isn't automatically implied by membership if
            // someone's explicitly opted out of being listed at all.
            if (!empty($row->directoryoptout)) {
                continue;
            }
            $members[] = [
                'id'            => (int) $row->id,
                'first_name'    => $row->first_name,
                'last_name'     => $row->last_name,
                'call_sign'     => $row->call_sign,
                'email_address' => $row->email_address,
                'phone'         => $row->phone,
                'mobile'        => $row->mobile,
            ];
        }

        $this->json_success(['members' => $members]);
    }

    /* ------------------------------------------------------------
       GET /welcome-api/directory
       Header: Authorization: Bearer <token>
       All current members, across every chapter.
       ------------------------------------------------------------ */

    function directory() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $system_current_year = (int) setting('system_current_year', date('Y'));

        $sql = "
            SELECT c.id, c.first_name, c.last_name,
                   c.email_address, c.phone, c.mobile, c.directoryoptout,
                   s.chapter_title, a.call_sign
            FROM ccmps c
            LEFT JOIN ccmps_subentities s ON s.id = c.subentity
            LEFT JOIN ccmps_aux a ON a.ccmp_id = c.id
            WHERE c.deceased != 1
              AND c.soft_deleted != 1
              AND c.current_year >= " . $system_current_year . "
            ORDER BY c.last_name, c.first_name
        ";
        $rows = $this->model->query($sql, 'object');

        $members = [];
        foreach ($rows as $row) {
            if (!empty($row->directoryoptout)) {
                continue;
            }
            $members[] = [
                'id'            => (int) $row->id,
                'first_name'    => $row->first_name,
                'last_name'     => $row->last_name,
                'call_sign'     => $row->call_sign,
                'email_address' => $row->email_address,
                'phone'         => $row->phone,
                'mobile'        => $row->mobile,
                'chapter_title' => $row->chapter_title,
            ];
        }

        $this->json_success(['members' => $members]);
    }

    /* ------------------------------------------------------------
       GET /welcome-api/lookups
       Header: Authorization: Bearer <token>
       Reference data for the two foreign-key fields on the Profile
       form (salutation, highest_certificate) that were originally
       shown as raw numeric-id text inputs — this lets the client
       build real dropdowns with human-readable labels instead.
       Behind auth like everything else, for consistency, even though
       this data itself isn't member-specific or sensitive.
       ------------------------------------------------------------ */

    function lookups() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $salutations = $this->model->get('id', 'ref_salutations');
        $certificate_types = $this->model->get('id', 'ccmps_certificate_types');
        $states = $this->model->get('id', 'ref_states');

        $result = ['salutations' => [], 'certificate_types' => [], 'states' => []];

        foreach ($salutations as $row) {
            $result['salutations'][] = ['id' => (int) $row->id, 'label' => $row->title];
        }

        foreach ($certificate_types as $row) {
            $result['certificate_types'][] = ['id' => (int) $row->id, 'label' => $row->description];
        }

        // Unlike salutation/highest_certificate, the address state
        // fields (mailstate/physstate/billstate/shipstate) already
        // store the 2-letter code directly as text (e.g. "MD"), not a
        // numeric id pointing back at ref_states — confirmed from an
        // actual mydata() response before this endpoint existed. So
        // "id" here is genuinely state_code, not ref_states.id — kept
        // under the same {id, label} shape as the other two lists
        // purely so the client's existing populateSelect() helper
        // works unmodified; the key name is just reused, not literal.
        foreach ($states as $row) {
            $result['states'][] = ['id' => $row->state_code, 'label' => $row->name];
        }

        $this->json_success($result);
    }

    /* ------------------------------------------------------------
       POST /welcome-api/change_password
       Header: Authorization: Bearer <token>
       Body: { "current_password": "...", "new_password": "..." }

       Same hashing convention as login()'s own password_verify()
       check against ccmps.password — confirmed from that already-
       working, tested code, not guessed at. password_hash() with
       PASSWORD_DEFAULT (currently bcrypt) is PHP's own standard,
       recommended pairing with password_verify(), so a hash written
       here will verify correctly against login()'s existing check,
       and vice versa for whatever the web app's own change-password
       flow eventually writes once it's wired up too.
       ------------------------------------------------------------ */

    function change_password() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $raw_body = file_get_contents('php://input');
        $submitted = json_decode($raw_body, true);

        if (!is_array($submitted)) {
            $this->json_error('Request body must be a JSON object.');
            return;
        }

        $current_password = (string) ($submitted['current_password'] ?? '');
        $new_password = (string) ($submitted['new_password'] ?? '');

        if ($current_password === '' || $new_password === '') {
            $this->json_error('Current and new password are both required.');
            return;
        }

        // Minimum length assumed at 8 characters — not confirmed
        // against the web app's own policy (that logic hasn't been
        // reviewed here), so this may need adjusting once the web
        // app's change-password flow is actually wired up, to keep
        // both surfaces enforcing the same rule.
        if (strlen($new_password) < 8) {
            $this->json_error('New password must be at least 8 characters.');
            return;
        }

        $ccmp = $this->model->get_where($ccmp_id, 'ccmps');
        if (!$ccmp || !password_verify($current_password, $ccmp->password)) {
            $this->json_error('Current password is incorrect.', 401);
            return;
        }

        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $this->model->update($ccmp_id, ['password' => $new_hash], 'ccmps');

        $this->json_success(['updated' => true]);
    }

    /* ------------------------------------------------------------
       GET /welcome-api/mycard
       Header: Authorization: Bearer <token>
       The member's digital membership card (card_helper.php, 2026-10-26):
       what the card shows plus the QR text. The app draws the QR itself.
       ------------------------------------------------------------ */

    function mycard() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }

        $card    = card_for_member($ccmp_id, true);
        $details = card_details($ccmp_id);
        if (!$card || !$details) {
            $this->json_error('No card for this account.', 404);
            return;
        }

        $this->json_success([
            'code'          => card_code($card),
            'issued_at'     => (int) $card->issued_at,
            'name'          => $details->name,
            'member_number' => $details->member_number,
            'member_type'   => $details->member_type,
            'chapter'       => $details->chapter,
            'valid_through' => $details->valid_through,
            'photo_url'     => $details->photo_url,
            'initials'      => $details->initials,
            'org_name'      => $details->org_name,
            'member_word'   => $details->member_word,
            'card_color'    => CCMPS_CRUD_LABEL_CLR,
            'accent_color'  => SN2_CLR,
        ]);
    }

    /* ------------------------------------------------------------
       POST /welcome-api/reissuecard
       Header: Authorization: Bearer <token>
       Lost phone: cancels the member's card and issues a new one; the
       old QR code stops working at once. Returns the new card (as mycard).
       ------------------------------------------------------------ */

    function reissuecard() {
        $ccmp_id = $this->require_auth();
        if ($ccmp_id === null) {
            return;
        }
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->json_error('Use POST.', 405);
            return;
        }

        $member = $this->model->get_where($ccmp_id, 'ccmps');
        $card   = card_reissue($ccmp_id, (int) ($member->trongate_user_id ?? 0), 'Replaced by the member (phone app)');
        if (!$card) {
            $this->json_error('No card for this account.', 404);
            return;
        }

        $this->module('timedate');
        $time = $this->timedate->get_nice_date(time(), 'minitime').' UTC';
        $this->module('system-auditlogger');
        $this->auditlogger->logevent('update', 'ReissueCard', 'welcome-api', 'UN: '.($member->username ?? ''), $time, 'Rec: '.$ccmp_id, 'Tbl: ccmps_cards', 'new card '.$card->id);

        $this->mycard();
    }

}
