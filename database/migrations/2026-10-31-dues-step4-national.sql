-- ---------------------------------------------------------------------------
-- Dues, step 4: National's side (2026-10-31; FIN-03, FIN-27, FIN-31, FIN-33).
-- The screens (fin/invoices, fin/attention, fin/settings, fin/chapterdues) use the step 1-3 tables;
-- this adds the National Dues Paid bulk action (12) for Financial Admins on the member lists.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------
INSERT IGNORE INTO ccmps_bulk_actions (id, title, description)
VALUES (12, 'National Dues Paid', 'Mark the National dues invoices of the ticked members paid (Financial Admins)');
