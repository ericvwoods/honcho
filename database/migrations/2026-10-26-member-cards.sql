-- ---------------------------------------------------------------------------
-- Digital membership cards, phase 1 (2026-10-26).
-- One active card per member. The QR code on the card is
--     HC1:<card id>:<signature>
-- where the signature is an HMAC of the card id and issue time with a key from
-- .env (CARD_SECRET, or derived from JWT_SECRET), so this table holds nothing
-- that would let someone make a working card. Cancelling a card (lost phone)
-- sets status = 'cancelled' and a new row is issued; the old code is refused.
-- google_object_id is for Google Wallet (phase 3).
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ccmps_cards (
  id               int unsigned NOT NULL AUTO_INCREMENT,
  ccmp_id          int          NOT NULL,
  status           varchar(12)  NOT NULL DEFAULT 'active',  -- active | cancelled
  issued_at        int          NOT NULL DEFAULT 0,
  issued_by        int          NOT NULL DEFAULT 0,          -- trongate_users.id, 0 = made on first view
  cancelled_at     int          NOT NULL DEFAULT 0,
  cancelled_by     int          NOT NULL DEFAULT 0,
  cancel_reason    varchar(100) NOT NULL DEFAULT '',
  google_object_id varchar(120) NULL,
  PRIMARY KEY (id),
  KEY ix_ccmps_cards_member (ccmp_id, status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
