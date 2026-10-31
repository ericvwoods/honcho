-- ---------------------------------------------------------------------------
-- Family member link (owner, 2026-10-31): ccmps.family_member_id is the id of
-- one other member (ccmps.id) of the same chapter who is family. Chosen from
-- a list of the chapter's members on the member create and update screens;
-- admins only. Empty (NULL) = none. Links for migrated members are set by hand
-- after the legacy data load. "Who is related to whom" becomes a report in the
-- Reporting module (requirements MEM-30, MEM-31).
-- Replaces the retired Family member type (2026-10-31-dues-step1-foundations).
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

ALTER TABLE ccmps
  ADD COLUMN IF NOT EXISTS family_member_id int(11) NULL DEFAULT NULL AFTER subentity_role;

ALTER TABLE ccmps
  ADD INDEX IF NOT EXISTS idx_family_member_id (family_member_id);
