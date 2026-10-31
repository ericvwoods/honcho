// chapters/financial.js — Financial and Payments chapter of the Honcho Developer's Guide (Core).
// Started 2026-10-31 with dues step 1 (foundations). Requirements: Financial (FIN-) and Payments (PAY-)
// chapters of the Honcho Requirements book, which also holds the owner's concept of operations for dues.
// Same block format and inline markup as chapters/ccmps.js.

module.exports = [

{ tab: "Overview", blocks: [
  { type: 'p', text: "**Financial** decides what is owed (dues first; invoices, accounts and expenses later as an add-on). **Payments** moves the money (one payment record for every method; PayPal and other gateways later). Dues and Payments are Core. Financial never talks to a payment provider." },
  { type: 'table', headers: ['Step', 'What', 'State'], rows: [
    ['1', 'Foundations: settings, member-type and chapter flags, proration schedules, dues charges and installments, the payment record, RBAC module `fin`, Family retired', 'Built 2026-10-31 (Mac). Nothing reads the new tables yet'],
    ['2', 'Status engine on the dues charges, run nightly by the scheduler', 'Built 2026-10-31; switched on on the Mac only (`DUES_STATUS_ENGINE`)'],
    ['3', 'Record chapter dues / Renew (raises and emails the National invoice), bulk, Reverse', 'Built 2026-10-31 (Mac)'],
    ['4', 'Financial Admin: National invoices, Mark paid (one or many; bulk action 12), Void, Waive, Resend, Reverse National payment, Needs attention; Dues Settings and chapter dues pages; Dues menu', 'Built 2026-10-31 (Mac)'],
    ['5', 'Dues report, receipts, member dues history, reminders', 'Planned'],
  ]},
]},

{ tab: "Tables", blocks: [
  { type: 'p', text: "Created by `database/migrations/2026-10-31-dues-step1-foundations.sql` (safe to re-run)." },
  { type: 'table', headers: ['Table / column', 'Holds'], rows: [
    ['`system_settings` (Financial tab)', '`DUES_DUE_DATE` (MM-DD, BPA 09-30), `DUES_GRACE_MODE` (manual | calendar), `DUES_GRACE_END` (MM-DD, calendar mode), `DUES_BILLING_PLANS`; alongside the existing `system_current_year`, `grace_period` (the manual flag), `current_dues_pmt_year`, `dues_proration` (legacy single factor, superseded by the schedules)'],
    ['`ccmps_types.active`, `.always_current`, `.at_large`', 'Switched-off types (Family, retired) are not offered in the type pickers; Honorary is always Current; which types the Chapter at Large offers'],
    ['`ccmps_subentities.dues_collected_by`', '`chapter` or `national` (the Chapter at Large: National bills and records its chapter dues). Chapter dues amount: the existing `annual_dues`'],
    ['`dues_proration`, `dues_proration_types`', 'A schedule per scope (`subentity_id` 0 = National): a factor per join month 1-12, and which member types it applies to. **New members only.** National seeded with the legacy factor for every month, Regular only'],
    ['`dues_charges`', 'Two per member per membership year: `kind` chapter | national (the National invoice). `amount` (after proration), `full_amount`, `prorate_factor`, `balance`, `plan` (annual | quarterly | monthly), `status` (open | paid | void | waived), `reason`, `invoice_number`, `invoiced_at`, `paid_at`, `legacy_txn_id`. Unique per member, year and kind'],
    ['`dues_installments`', 'Dated parts of a quarterly or monthly charge: `due_date`, `amount`, `paid_amount`, `paid_at`'],
    ['`pay_payments`', 'The Payments module\'s record of every payment: `receipt_number`, payer, `received_by` (0 = National, else the chapter), amount, `method` (cash | check | other | paypal...), `reference`, `received_on`, what it `applies_to` (`dues_charge`, later invoice, order), `status`'],
  ]},
  { type: 'p', text: "**Carry-over:** existing `ccmps_financial_transactions` rows become `dues_charges` of kind national (paid where National had received them). The old table stays until step 2 switches the status rule over." },
  { type: 'p', text: "**Family retired** (FIN-29): members of type F became Regular when their highest certificate is Sport, Recreational, Private, Commercial, ATP, A&P, Drone Pilot or Military, or the military pilot or ATP tick is set; otherwise Associate. The type picker queries in `Ccmps.php` (4) and `Sysconfig.php` now read `ccmps_types WHERE active = 1`." },
]},

{ tab: "Status Engine", blocks: [
  { type: 'p', text: "`engine/tg_helpers/dues_helper.php` (dues step 2). Membership year Y runs from the day after the due date in Y-1 to the due date in Y (`dues_year_for()`; BPA 09-30: Oct 1, 2026 starts 2027)." },
  { type: 'table', headers: ['Status', 'Rule (for the year in force)'], rows: [
    ['1 Current', 'Chapter charge and National charge settled; or lifetime (Current Year 2099); or a member type with `always_current` (Honorary); or legacy: no dues records but Current Year reaches the year'],
    ['3 Pending', 'Chapter charge settled, National not (invoice open or not raised)'],
    ['2 Past Due', 'Not renewed for Y, but settled for Y-1, and the grace period is on'],
    ['5 Expired', 'Not renewed, and the grace period is off or ended, or behind by more than a year'],
    ['0 None', 'Deceased or deleted'],
  ]},
  { type: 'ul', items: [
    "**Settled** = `paid` or `waived`, or for a quarterly / monthly plan every installment due by today is paid (`_dues_charge_settled()`). Void charges don't count.",
    "**Grace period:** manual mode reads the `grace_period` flag; calendar mode ends on `DUES_GRACE_END` after the due date (`dues_grace_active()`).",
    "**Switch:** `DUES_STATUS_ENGINE` (Financial tab, default off; migration `2026-10-31-dues-step2-engine.sql`). When on, `Ccmps::recalcstatus()` calls `dues_recalc_member()` and `recalc_all_member_statuses()` calls `dues_roll_year()` + `dues_recalc_all()`; when off, the old rule (with its 2026 cutover guard) runs. Both methods now refuse being opened from the address bar (`_internal_only()`).",
    "**Nightly:** `fin/nightly/<CRON_KEY>` (`modules/fin/Fin.php`; `CRON_KEY` in `.env`, else `COFFEE_CRON_KEY`) moves `system_current_year` on to the year in force and recalculates everyone; logged as `DuesNightly` when anything changed. Servers need a daily crontab line, e.g. `5 0 * * * docker exec honcho-honcho-staging-1 curl -s http://localhost/fin/nightly/<key>`.",
    "**Dry run:** `dues_recalc_all(false)` returns the counts and every member whose status would change, without writing; run it before switching the engine on anywhere. On the Mac (31 Oct 2026) it moved the year 2026 to 2027 and changed 421 statuses (377 Current to Past Due: paid through 2026, 2027 dues due Sep 30, 2026; 43 deceased or deleted to None; 1 Honorary to Current).",
  ]},
]},

{ tab: "Recording Chapter Dues", blocks: [
  { type: 'p', text: "Dues step 3 (migration `2026-10-31-dues-step3-chapter-dues.sql`: `dues_attention`, bulk actions 10 Undelete and 11 Chapter Dues Paid, `DUES_PAY_INSTRUCTIONS`)." },
  { type: 'table', headers: ['Function (dues_helper.php)', 'Does'], rows: [
    ['`dues_record_chapter($ccmp_id, $year, $opts)`', 'Chapter charge paid (chapter dues × the chapter\'s proration factor for a new member), a `pay_payments` row (receipt `R000123`; `received_by` 0 for the Chapter at Large) unless the amount is 0 or method `none`, the National charge (member type\'s dues × National\'s factor for a new member; invoice `N2027-000123`), Current Year raised, status recalculated, `dues_send_invoice()`'],
    ['`dues_reverse_chapter($ccmp_id, $year, $reason)`', 'Payments marked `reversed`, chapter charge reopened; an open National charge is voided and the member emailed; a paid one goes to `dues_attention` and the Financial Admins are emailed (`dues_financial_admin_emails()`); Current Year back one year'],
    ['`dues_can_record($m)`', '`fin/record_chapter_dues` and either `fin/settle_national_dues` (anyone) or Chapter Admin of the member\'s chapter, unless that chapter\'s dues are collected by National'],
    ['`dues_open_year()`', 'The year renewals are recorded for: `current_dues_pmt_year`'],
  ]},
  { type: 'ul', items: [
    "**Pages** (`modules/fin/Fin.php`): `memberdues/<id>` (history, Record or Renew, Reverse with two clicks), `recorddues`, `reversedues`, `bulkchapterdues` and `bulkchapterduessubmit` (the ticked ids come from `Ccmps::bulkaction()` in `$_SESSION['fin_bulk_ids']`; results shown on the page). All POSTs carry `fin_token`. Close returns to where the person came from.",
    "**Member record:** a Dues button on `viewccmp.php` when `dues_can_record()`. `Ccmps::ccmpsubmit()` with the engine on: raising Current Year to the open year calls `dues_record_chapter()` after the save (a new member's record too, with `new_member`); lowering it calls `dues_reverse_chapter()`; the old `ccmps_financial_transactions` insert is skipped. Without the right to record dues, the Current Year change is refused with a message.",
    "**Bulk actions:** 2 (Current Year) and 11 (Chapter Dues Paid) redirect to `fin/bulkchapterdues` when the engine is on; 10 Undelete now works; 8 Delete recalculates status.",
    "**Emails** go through `coffee_send_email()` (Brevo) with the tag `dues`.",
  ]},
]},

{ tab: "National's Side", blocks: [
  { type: 'p', text: "Dues step 4 (migration `2026-10-31-dues-step4-national.sql`: bulk action 12, National Dues Paid)." },
  { type: 'table', headers: ['Page / function', 'Does'], rows: [
    ['`fin/invoices` (+ `invoicespaid`)', 'National charges by year, chapter, status; tick and mark paid. `?picked=1` shows the members ticked with bulk action 12 (`$_SESSION[\'fin_inv_ids\']`)'],
    ['`fin/nationalaction`', 'From a member\'s Dues page: `paid` (`dues_mark_national_paid()`), `void` / `waive` (`dues_set_charge_status()`, reason required), `resend` (`dues_send_invoice()`), `reverse` (`dues_reverse_national()`: payments `reversed`, charge reopened)'],
    ['`fin/attention` (+ `attentionresolve`)', '`dues_attention` cases with `dues_attention_open()`; resolved with a note'],
    ['`fin/settings` (+ `settingssubmit`)', '`manage_dues_settings`: `ccmps_types.national_dues`, `always_current`, `at_large`; National\'s proration (`dues_proration`, `dues_proration_types` scope 0); every chapter\'s `annual_dues` and `dues_collected_by`'],
    ['`fin/chapterdues/<id>` (+ `chapterduessubmit`)', 'One chapter\'s `annual_dues` and proration schedule: its Chapter Admins (own chapter) or `manage_dues_settings` (any; also `dues_collected_by`)'],
  ]},
  { type: 'ul', items: [
    "**Menus:** a Dues group in the member EMS menu (`sidemenu.php`, after Financial Settings) and the staff menu (`adminsidemenu.php`), shown only with the engine on and the rights; Needs Attention shows the open count.",
    "**Not yet:** amounts don't change per membership year (FIN-01's 'effective for a chosen year'); a new amount applies to dues recorded from then on and existing charges keep theirs.",
  ]},
]},

{ tab: "Permissions", blocks: [
  { type: 'table', headers: ['Function (module `fin`)', 'Given to'], rows: [
    ['`record_chapter_dues`', 'Chapter Admins (own chapter), Financial Admins (also the Chapter at Large), System Admins'],
    ['`settle_national_dues`', 'Financial Admins, System Admins'],
    ['`manage_dues_settings`', 'Financial Admins, System Admins'],
    ['`view_dues_reports`', 'Chapter Admins (own chapter), Financial Admins, System Admins'],
  ]},
  { type: 'p', text: "A chapter treasurer role later is a new group with `record_chapter_dues` and `view_dues_reports`; no code change." },
]},

];
