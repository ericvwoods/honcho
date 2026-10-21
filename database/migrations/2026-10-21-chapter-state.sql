-- ---------------------------------------------------------------------------
-- Chapter state (2026-10-21): ccmps_subentities.state, the two-letter code
-- (ref_states.state_code) of the state a chapter is in. By the Numbers counts
-- the distinct states (_cms_metrics() in engine/tg_helpers/cms_helper.php).
--
-- Prefill: each chapter gets the most common mailing state of its living,
-- not-deleted members (ccmps_addresses.mailstate, valid codes only, 'NA'
-- ignored). Ties and chapters with no usable addresses are left blank to be
-- filled in by hand. The prefill runs only while no chapter has a state yet,
-- so re-running never overwrites corrections.
--
-- Also adds ccmps_subentities.active (1 = a working chapter). Inactive rows are
-- left out of the By the Numbers counts; the 'Place Holder' rows start
-- inactive. Both are edited on the new Chapters screen (system-subentities).
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

ALTER TABLE ccmps_subentities
  ADD COLUMN IF NOT EXISTS state char(2) NULL DEFAULT NULL AFTER region,
  ADD COLUMN IF NOT EXISTS active tinyint(1) NOT NULL DEFAULT 1 AFTER chartered;

UPDATE ccmps_subentities SET active = 0 WHERE chapter_title = 'Place Holder';

UPDATE ccmps_subentities s
  JOIN (SELECT subentity, MIN(st) AS st
          FROM (SELECT c.subentity, r.state_code AS st,
                       RANK() OVER (PARTITION BY c.subentity ORDER BY COUNT(*) DESC) AS rk
                  FROM ccmps c
                  JOIN ccmps_addresses a ON a.ccmp_id = c.id
                  JOIN ref_states r ON r.state_code = UPPER(TRIM(a.mailstate)) AND r.state_code != 'NA'
                 WHERE COALESCE(c.deceased,0) != 1 AND COALESCE(c.soft_deleted,0) != 1 AND c.subentity > 0
                 GROUP BY c.subentity, r.state_code) ranked
         WHERE rk = 1
         GROUP BY subentity
        HAVING COUNT(*) = 1) best ON best.subentity = s.id
   SET s.state = best.st
 WHERE (SELECT COUNT(*) FROM (SELECT id FROM ccmps_subentities WHERE state IS NOT NULL AND state != '') filled) = 0;
