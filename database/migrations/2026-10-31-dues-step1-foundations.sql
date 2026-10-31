-- ---------------------------------------------------------------------------
-- Dues, step 1: foundations (owner's concept of operations and design, 2026-10-31;
-- requirements FIN-01..FIN-09, FIN-20..FIN-29, PAY-07). Nothing reads these yet:
-- the status engine (step 2) and the screens (steps 3-5) switch over to them.
--
--   Settings (Financial tab): due date, grace mode, calendar grace end, billing plans.
--   Member types: active (Family retired), always_current (Honorary), at_large (available
--     in the Chapter at Large).
--   Chapters: dues_collected_by (chapter | national; the Chapter at Large = national).
--   dues_proration / dues_proration_types: a schedule per scope (0 = National) by join
--     month, and which member types it applies to. New members only.
--   dues_charges: two per member per membership year (chapter, national), with balance,
--     plan and status; dues_installments for quarterly / monthly plans.
--   pay_payments: the Payments module's one payment record for every method (cash,
--     check and other first; online gateways later).
--   RBAC module 'fin' (Core) with its functions and group grants.
--   Carry-over of ccmps_financial_transactions into dues_charges (national), and the
--   Family member type retired (members become Regular with a pilot or mechanic
--   certificate, otherwise Associate).
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

-- Settings ------------------------------------------------------------------
INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at) VALUES
('DUES_DUE_DATE', 'Dues due date (month-day)', '09-30', 'varchar', 'Financial', 'text', '', 'edit_financial_settings', 'DUES_DUE_DATE',
 'Month and day dues are due for the coming membership year, as MM-DD (BPA: 09-30). Unpaid members change status the day after.', 30, UNIX_TIMESTAMP()),
('DUES_GRACE_MODE', 'Grace period mode', 'manual', 'varchar', 'Financial', 'select', 'manual=Manual (the grace period flag);calendar=Calendar (ends on the grace end date)', 'edit_financial_settings', 'DUES_GRACE_MODE',
 'Manual: the grace period runs while the Grace Period flag is on. Calendar: it ends on the grace end date below.', 31, UNIX_TIMESTAMP()),
('DUES_GRACE_END', 'Grace period end (calendar mode, month-day)', '12-31', 'varchar', 'Financial', 'text', '', 'edit_financial_settings', 'DUES_GRACE_END',
 'Calendar mode only: the last day of the grace period after the due date, as MM-DD. Unpaid members become Expired the day after.', 32, UNIX_TIMESTAMP()),
('DUES_BILLING_PLANS', 'Dues billing plans offered', 'annual,quarterly,monthly', 'varchar', 'Financial', 'text', '', 'edit_financial_settings', 'DUES_BILLING_PLANS',
 'Which ways members may pay their annual dues: annual, quarterly, monthly (comma-separated).', 33, UNIX_TIMESTAMP());

-- Member types and chapters --------------------------------------------------
ALTER TABLE ccmps_types ADD COLUMN IF NOT EXISTS active tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE ccmps_types ADD COLUMN IF NOT EXISTS always_current tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE ccmps_types ADD COLUMN IF NOT EXISTS at_large tinyint(1) NOT NULL DEFAULT 1;
UPDATE ccmps_types SET always_current = 1 WHERE ccmp_type = 'H';   -- Honorary is always Current (owner)

ALTER TABLE ccmps_subentities ADD COLUMN IF NOT EXISTS dues_collected_by varchar(10) NOT NULL DEFAULT 'chapter';
UPDATE ccmps_subentities SET dues_collected_by = 'national' WHERE chapter_title = 'ChptrAtLrg';  -- the Chapter at Large

-- Proration schedules (New members only) ------------------------------------
CREATE TABLE IF NOT EXISTS dues_proration (
  id           int unsigned NOT NULL AUTO_INCREMENT,
  subentity_id int          NOT NULL DEFAULT 0,       -- 0 = National's schedule, else the chapter's
  join_month   tinyint      NOT NULL,                 -- 1-12, the month the new member joins
  factor       decimal(5,4) NOT NULL DEFAULT 1.0000,  -- multiplied by the dues amount
  updated_by   int          NOT NULL DEFAULT 0,
  updated_at   int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY ux_dues_proration (subentity_id, join_month)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS dues_proration_types (
  subentity_id int NOT NULL DEFAULT 0,
  ccmp_type_id int NOT NULL,
  PRIMARY KEY (subentity_id, ccmp_type_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- National's schedule starts as today's single factor for every month (same result as the legacy rule);
-- the Financial Admin sets real monthly factors on the dues settings screen.
INSERT IGNORE INTO dues_proration (subentity_id, join_month, factor, updated_at)
SELECT 0, m.n, COALESCE((SELECT CAST(settingvalue AS DECIMAL(5,4)) FROM system_settings WHERE title = 'dues_proration' LIMIT 1), 1.0), UNIX_TIMESTAMP()
  FROM (SELECT 1 n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
        UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) m;
INSERT IGNORE INTO dues_proration_types (subentity_id, ccmp_type_id)
SELECT 0, id FROM ccmps_types WHERE ccmp_type = 'R';  -- BPA prorates National dues for new Regular members only

-- Dues charges and installments ----------------------------------------------
CREATE TABLE IF NOT EXISTS dues_charges (
  id               int unsigned NOT NULL AUTO_INCREMENT,
  ccmp_id          int          NOT NULL,
  subentity_id     int          NOT NULL DEFAULT 0,          -- the member's chapter when charged
  membership_year  int          NOT NULL,
  kind             varchar(10)  NOT NULL,                    -- chapter | national
  amount           decimal(9,2) NOT NULL DEFAULT 0.00,       -- after proration
  full_amount      decimal(9,2) NOT NULL DEFAULT 0.00,       -- before proration
  prorate_factor   decimal(5,4) NOT NULL DEFAULT 1.0000,
  balance          decimal(9,2) NOT NULL DEFAULT 0.00,
  plan             varchar(10)  NOT NULL DEFAULT 'annual',   -- annual | quarterly | monthly
  status           varchar(10)  NOT NULL DEFAULT 'open',     -- open | paid | void | waived
  reason           varchar(255) NOT NULL DEFAULT '',         -- for void / waived
  invoice_number   varchar(30)  NOT NULL DEFAULT '',
  invoiced_at      int          NOT NULL DEFAULT 0,          -- the National invoice email
  paid_at          int          NOT NULL DEFAULT 0,
  legacy_txn_id    int unsigned NULL,                        -- the ccmps_financial_transactions row it came from
  created_by       int          NOT NULL DEFAULT 0,
  created_at       int          NOT NULL DEFAULT 0,
  updated_by       int          NOT NULL DEFAULT 0,
  updated_at       int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY ux_dues_charge (ccmp_id, membership_year, kind),
  KEY ix_dues_charges_open (status, kind, membership_year),
  KEY ix_dues_charges_chapter (subentity_id, membership_year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS dues_installments (
  id          int unsigned NOT NULL AUTO_INCREMENT,
  charge_id   int unsigned NOT NULL,
  seq         tinyint      NOT NULL,
  due_date    date         NOT NULL,
  amount      decimal(9,2) NOT NULL DEFAULT 0.00,
  paid_amount decimal(9,2) NOT NULL DEFAULT 0.00,
  paid_at     int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE KEY ux_dues_installment (charge_id, seq)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- The Payments module's payment record (PAY-07) ------------------------------
CREATE TABLE IF NOT EXISTS pay_payments (
  id              int unsigned NOT NULL AUTO_INCREMENT,
  receipt_number  varchar(30)  NOT NULL DEFAULT '',
  payer_ccmp_id   int          NOT NULL DEFAULT 0,
  received_by     int          NOT NULL DEFAULT 0,       -- scope that received the money: 0 = National, else the chapter
  amount          decimal(9,2) NOT NULL DEFAULT 0.00,
  method          varchar(12)  NOT NULL,                 -- cash | check | other | paypal | ...
  reference       varchar(100) NOT NULL DEFAULT '',      -- check number, gateway id
  received_on     date         NULL,
  applies_to      varchar(20)  NOT NULL DEFAULT '',      -- dues_charge | invoice | order
  applies_to_id   int unsigned NOT NULL DEFAULT 0,
  status          varchar(10)  NOT NULL DEFAULT 'completed',  -- completed | refunded | void
  notes           varchar(255) NOT NULL DEFAULT '',
  recorded_by     int          NOT NULL DEFAULT 0,
  created_at      int          NOT NULL DEFAULT 0,
  updated_at      int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY ix_pay_payments_for (applies_to, applies_to_id),
  KEY ix_pay_payments_payer (payer_ccmp_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Permissions: module 'fin' (Core) ------------------------------------------
INSERT IGNORE INTO system_modules (code, title, is_addon, enabled, sort_order, created_at)
VALUES ('fin', 'Financial (dues)', 0, 1, 60, UNIX_TIMESTAMP());

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'record_chapter_dues', 'Record chapter dues', 'Record a member''s chapter dues (or renew where there are none); raises the National invoice. Own chapter only, except National for the Chapter at Large', 10, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'fin';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'settle_national_dues', 'Settle National dues invoices', 'Mark National dues invoices paid, void or waive them', 20, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'fin';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'manage_dues_settings', 'Manage dues settings', 'Dues amounts by member type, proration schedules, due date and grace period', 30, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'fin';
INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'view_dues_reports', 'See dues reports', 'Dues reports and exports (Chapter Admins: their chapter)', 40, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'fin';

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_modules m ON m.code = 'fin'
  JOIN system_functions f ON f.module_id = m.id
 WHERE g.title IN ('System Admins', 'Member System Admins', 'Financial Admins')
    OR (g.title = 'Chapter Admins' AND f.code IN ('record_chapter_dues', 'view_dues_reports'));

-- Carry over today's National dues records -----------------------------------
INSERT IGNORE INTO dues_charges (ccmp_id, subentity_id, membership_year, kind, amount, full_amount, prorate_factor, balance, status,
                                 invoice_number, paid_at, legacy_txn_id, created_by, created_at, updated_at)
SELECT t.ccmp_id, t.chapter, t.dues_year, 'national', COALESCE(t.transaction_amt, 0), COALESCE(t.transaction_amt, 0), 1.0,
       CASE WHEN t.rec_by_national = 1 THEN 0 ELSE COALESCE(t.transaction_bal, t.transaction_amt, 0) END,
       CASE WHEN t.rec_by_national = 1 AND COALESCE(t.transaction_bal, 0) = 0 THEN 'paid' ELSE 'open' END,
       COALESCE(t.invoice_num, ''), CASE WHEN t.rec_by_national = 1 THEN t.updated_at ELSE 0 END, t.id, t.created_by, t.created_at, UNIX_TIMESTAMP()
  FROM ccmps_financial_transactions t
 WHERE t.ccmp_id IS NOT NULL AND t.dues_year > 0 AND COALESCE(t.deleted, 0) = 0;

-- Retire the Family member type (owner, 2026-10-31) --------------------------
-- Regular with a pilot or mechanic certificate (Sport, Recreational, Private, Commercial, ATP, A&P,
-- Drone Pilot, Military, or the military pilot / ATP ticks), otherwise Associate.
UPDATE ccmps m
  JOIN ccmps_types f ON f.id = m.ccmp_type AND f.ccmp_type = 'F'
  LEFT JOIN ccmps_aux a ON a.ccmp_id = m.id
  LEFT JOIN ccmps_certificate_types c ON c.id = a.highest_certificate
   SET m.ccmp_type = (SELECT id FROM ccmps_types WHERE ccmp_type =
         CASE WHEN c.cert_title IN ('SP', 'R', 'P', 'C', 'A', 'AP', 'DP', 'M') OR COALESCE(a.military_pilot, 0) = 1 OR COALESCE(a.atp, 0) = 1
              THEN 'R' ELSE 'A' END),
       m.updated_at = UNIX_TIMESTAMP();
UPDATE ccmps_types SET active = 0 WHERE ccmp_type = 'F';
