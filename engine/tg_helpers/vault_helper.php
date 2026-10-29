<?php
/**
 * Credential vault (2026-10-29, Honcho AI phase 0): encrypts secrets that are
 * stored in the database, such as each scope's AI API key (ai_connections).
 * AES-256-GCM with a key from .env: VAULT_KEY, or one derived from JWT_SECRET
 * when VAULT_KEY isn't set (same pattern as card_helper.php's CARD_SECRET).
 * The key is never in the database or git, so a copy of the database alone
 * can't reveal the secrets. Changing VAULT_KEY (or JWT_SECRET without a
 * VAULT_KEY) makes every stored secret unreadable: they must be entered again.
 *
 *   vault_encrypt($plain)   'v1:' + base64(iv | tag | ciphertext)
 *   vault_decrypt($stored)  the plain text, or '' if it can't be read
 *   vault_hint($plain)      last 4 characters, to recognize a key without showing it
 */

function _vault_key(): string {
    $key = (string) env('VAULT_KEY', '');
    if ($key === '') {
        $jwt = (string) env('JWT_SECRET', '');
        if ($jwt === '') {
            throw new RuntimeException('The credential vault needs VAULT_KEY or JWT_SECRET in .env.');
        }
        $key = hash_hmac('sha256', 'honcho-credential-vault', $jwt); // a separate key derived from the API key
    }
    return hash('sha256', $key, true); // 32 bytes for AES-256
}

function vault_encrypt(string $plain): string {
    $iv     = random_bytes(12);
    $tag    = '';
    $cipher = openssl_encrypt($plain, 'aes-256-gcm', _vault_key(), OPENSSL_RAW_DATA, $iv, $tag);
    if ($cipher === false) {
        throw new RuntimeException('The credential vault could not encrypt.');
    }
    return 'v1:'.base64_encode($iv.$tag.$cipher);
}

function vault_decrypt(?string $stored): string {
    if ($stored === null || strncmp($stored, 'v1:', 3) !== 0) {
        return '';
    }
    $raw = base64_decode(substr($stored, 3), true);
    if ($raw === false || strlen($raw) < 29) {
        return '';
    }
    $plain = openssl_decrypt(substr($raw, 28), 'aes-256-gcm', _vault_key(), OPENSSL_RAW_DATA, substr($raw, 0, 12), substr($raw, 12, 16));
    return $plain === false ? '' : $plain; // a changed key or a damaged value reads as empty
}

function vault_hint(string $plain): string {
    return strlen($plain) > 8 ? substr($plain, -4) : '';
}
