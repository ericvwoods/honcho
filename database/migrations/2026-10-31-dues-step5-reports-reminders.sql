-- ---------------------------------------------------------------------------
-- Dues, step 5: reports, receipts, member dues history, reminders (2026-10-31; FIN-04 to FIN-07).
--   dues_reminders: every reminder email sent (who, which kind, for which year), so nobody gets
--     the same reminder twice and the Financial Admin can see who was reminded.
--   Settings (Financial tab): reminders on/off (off until switched on), days before the due date,
--     how often while Past Due or while a National invoice is open.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS dues_reminders (
  id               int unsigned NOT NULL AUTO_INCREMENT,
  ccmp_id          int          NOT NULL,
  kind             varchar(20)  NOT NULL,      -- upcoming | past_due | invoice_open
  membership_year  int          NOT NULL,
  sent_on          date         NOT NULL,
  email            varchar(255) NOT NULL DEFAULT '',
  ok               tinyint(1)   NOT NULL DEFAULT 0,
  created_at       int          NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY ix_dues_reminders_member (ccmp_id, kind, membership_year, sent_on)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO system_settings (title, label, settingvalue, type, category, input_type, options, rbac_function, description, help, sort_order, created_at) VALUES
('DUES_REMINDERS', 'Send dues reminder emails', '0', 'tinyint', 'Financial', 'yesno', '', 'edit_financial_settings', 'DUES_REMINDERS',
 'On: the nightly job emails members before the due date (if they haven''t renewed), while Past Due, and while their National invoice is open. Each email is one Brevo email.', 36, UNIX_TIMESTAMP()),
('DUES_REMIND_BEFORE', 'Remind this many days before the due date', '30,7', 'varchar', 'Financial', 'text', '', 'edit_financial_settings', 'DUES_REMIND_BEFORE',
 'Comma-separated days before the due date to send the "your dues are coming due" reminder, for example 30,7.', 37, UNIX_TIMESTAMP()),
('DUES_REMIND_EVERY', 'Remind Past Due members and open invoices every (days)', '14', 'int', 'Financial', 'number', '1-90', 'edit_financial_settings', 'DUES_REMIND_EVERY',
 'How often to remind members who are Past Due, or whose National invoice is still open.', 38, UNIX_TIMESTAMP()),
('DUES_REMIND_MAX', 'Most reminder emails a night', '250', 'int', 'Financial', 'number', '1-5000', 'edit_financial_settings', 'DUES_REMIND_MAX',
 'Keeps a night''s reminders within the Brevo plan''s daily limit (the free plan sends 300 emails a day, shared with every other email). The rest go the following nights.', 39, UNIX_TIMESTAMP());
