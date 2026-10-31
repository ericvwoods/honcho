-- ---------------------------------------------------------------------------
-- Dues, step 3: recording chapter dues (2026-10-31; FIN-02, FIN-30, FIN-32).
--   dues_attention: things the Financial Admin must decide, e.g. chapter dues reversed after
--     the member already paid National's invoice.
--   ccmps_bulk_actions: Undelete (10) and Chapter Dues Paid (11) on the member lists.
--   DUES_PAY_INSTRUCTIONS: how to pay National, printed in the National invoice email
--     (until Payments adds a Pay now link).
-- Safe to run more than once.
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS dues_attention (
  id           int unsigned NOT NULL AUTO_INCREMENT,
  ccmp_id      int          NOT NULL,
  charge_id    int unsigned NOT NULL DEFAULT 0,
  kind         varchar(50)  NOT NULL,                 -- e.g. chapter_reversed_after_national_paid
  message      varchar(500) NOT NULL DEFAULT '',
  created_by   int          NOT NULL DEFAULT 0,
  created_at   int          NOT NULL DEFAULT 0,
  resolved_by  int          NOT NULL DEFAULT 0,
  resolved_at  int          NOT NULL DEFAULT 0,
  resolution   varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  KEY ix_dues_attention_open (resolved_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE dues_attention MODIFY kind varchar(50) NOT NULL;

INSERT IGNORE INTO ccmps_bulk_actions (id, title, description) VALUES
  (10, 'Undelete', 'Bring back deleted members'),
  (11, 'Chapter Dues Paid', 'Record chapter dues paid (or renew where there are none); raises the National invoices');

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at)
VALUES ('DUES_PAY_INSTRUCTIONS', 'How to pay National dues (invoice email)', 'Please pay your National dues by the due date. Contact the National Treasurer if you have any questions.', 'varchar', 'Financial', 'text', '', 'edit_financial_settings', 'DUES_PAY_INSTRUCTIONS',
        'Printed in the National dues invoice email: where and how members pay National (for example the payment page or the address for checks). Payments will add a Pay now link.', 35, UNIX_TIMESTAMP());
