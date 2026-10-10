<?php
/* ============================================================
   JwtHelper.php — minimal JWT encode/decode, no composer dependency
   ============================================================
   Deliberately hand-rolled rather than pulling in firebase/php-jwt or
   similar: this app's needs are simple (one claim that matters — the
   member's ccmp_id — signed with HMAC-SHA256, checked for expiry), and
   avoiding a new composer dependency means this drops in without
   needing `composer require` run on a server we may not have shell
   access to. If the token's needs grow more complex later (multiple
   signing keys, key rotation, etc.), swap this for a real library then.

   Usage:
       $token = JwtHelper::encode(['ccmp_id' => 1538], JWT_SECRET, 3600);
       $payload = JwtHelper::decode($token, JWT_SECRET); // throws on invalid/expired
   ============================================================ */

class JwtHelper {

    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data) {
        $padded = str_pad($data, strlen($data) % 4 === 0 ? strlen($data) : strlen($data) + (4 - strlen($data) % 4), '=');
        return base64_decode(strtr($padded, '-_', '+/'));
    }

    /**
     * Encodes a payload into a signed JWT.
     * @param array $claims Arbitrary claims to embed (e.g. ['ccmp_id' => 1538])
     * @param string $secret Signing secret — must match what decode() uses
     * @param int $ttl_seconds How long the token is valid for, from now
     * @return string The encoded token
     */
    public static function encode($claims, $secret, $ttl_seconds = 3600) {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload = $claims;
        $payload['iat'] = time();
        $payload['exp'] = time() + $ttl_seconds;

        $header_encoded = self::base64UrlEncode(json_encode($header));
        $payload_encoded = self::base64UrlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', $header_encoded . '.' . $payload_encoded, $secret, true);
        $signature_encoded = self::base64UrlEncode($signature);

        return $header_encoded . '.' . $payload_encoded . '.' . $signature_encoded;
    }

    /**
     * Decodes and verifies a JWT. Throws an Exception if the token is
     * malformed, the signature doesn't match, or it's expired — callers
     * should catch this and respond with 401, never let it propagate as
     * a raw fatal to the client.
     * @return array The decoded claims
     */
    public static function decode($token, $secret) {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            throw new Exception('Malformed token');
        }
        [$header_encoded, $payload_encoded, $signature_encoded] = $parts;

        $expected_signature = self::base64UrlEncode(
            hash_hmac('sha256', $header_encoded . '.' . $payload_encoded, $secret, true)
        );

        // hash_equals specifically to avoid a timing-attack side channel
        // on the signature comparison — a plain === here would leak
        // information about how many leading bytes matched.
        if (!hash_equals($expected_signature, $signature_encoded)) {
            throw new Exception('Invalid signature');
        }

        $payload = json_decode(self::base64UrlDecode($payload_encoded), true);
        if (!$payload) {
            throw new Exception('Malformed payload');
        }

        if (!isset($payload['exp']) || $payload['exp'] < time()) {
            throw new Exception('Token expired');
        }

        return $payload;
    }
}
