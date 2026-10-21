-- ---------------------------------------------------------------------------
-- Chapter state corrections (2026-10-21), after reviewing the prefill from
-- 2026-10-21-chapter-state.sql. Each row is matched by id AND name so it only
-- touches the intended chapter. Safe to run more than once.
--   National HQ (SUBENTITY_NATIONAL_ID = 99): not a chapter - no state, inactive
--   Arkansas Thunderbirds: MS (members were split evenly AR / MS)
--   Colorado Chapter: CO (no member addresses to go on)
--   Chicago Area Pilots Association: IL (members in IL and IN)
-- James H. Green Chapter is left blank until its state is known.
-- ---------------------------------------------------------------------------

UPDATE ccmps_subentities SET state = NULL, active = 0 WHERE id = 99 AND description = 'National HQ';
UPDATE ccmps_subentities SET state = 'MS' WHERE id = 3  AND description = 'Arkansas Thunderbirds';
UPDATE ccmps_subentities SET state = 'CO' WHERE id = 12 AND description = 'Colorado Chapter';
UPDATE ccmps_subentities SET state = 'IL' WHERE id = 11 AND description = 'Chicago Area Pilots Association';
