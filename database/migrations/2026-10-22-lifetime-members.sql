-- ---------------------------------------------------------------------------
-- Lifetime members (decided 2026-10-22): current_year 2099 means a lifetime
-- member, who is always Current (status 1). 9999 meant the same; it becomes
-- 2099 so there is one value (CCMP_LIFETIME_YEAR in config.php).
-- Ccmps::recalcstatus() now leaves them Current; before, re-checking statuses
-- marked them Past Due or Expired because they have no dues payment on record.
-- Deceased and deleted members keep status 0. Safe to run more than once.
-- ---------------------------------------------------------------------------

UPDATE ccmps SET current_year = 2099 WHERE current_year = 9999;

UPDATE ccmps SET status = 1
 WHERE current_year = 2099 AND COALESCE(deceased, 0) != 1 AND COALESCE(soft_deleted, 0) != 1;
