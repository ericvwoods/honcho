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

    // Lives on ccmps_aux, not ccmps or ccmps_addresses — a genuinely
    // separate table, so it needs its own save logic in update_mydata()
    // rather than just being added to CONTACT_TEXT_FIELDS. Added on
    // request alongside the original Contact Info + Addresses scope,
    // not part of the original spec.
    private $AUX_TEXT_FIELDS = ['call_sign'];

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
        if (!$ccmp || !empty($ccmp->soft_deleted)) {
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

        if (!$ccmp || !empty($ccmp->soft_deleted)) {
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

        $result = [
            'ccmp_id'    => $ccmp_id,
            'first_name' => $ccmp->first_name,
            'last_name'  => $ccmp->last_name,
        ];

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
        foreach ($this->CONTACT_TEXT_FIELDS as $field) {
            if (array_key_exists($field, $submitted)) {
                $ccmp_update[$field] = trim((string) $submitted[$field]);
            }
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
            $this->json_error('You are not assigned to a chapter.', 404);
            return;
        }

        $sql = "
            SELECT c.id, c.first_name, c.last_name,
                   c.email_address, c.phone, c.mobile, c.directoryoptout,
                   a.call_sign
            FROM ccmps c
            LEFT JOIN ccmps_aux a ON a.ccmp_id = c.id
            WHERE c.subentity = " . (int) $subentity_id . "
              AND c.deceased != 1
              AND c.soft_deleted != 1
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

        $system_current_year = (int) ($this->model->get_where(1, 'system_settings')->settingvalue ?? date('Y'));

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

}
