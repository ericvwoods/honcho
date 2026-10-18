-- ---------------------------------------------------------------------------
-- RBAC step 4: DMS uses Security Groups (2026-10-18).
-- Chapter Admins manage their own chapter's documents (decided 2026-10-18):
-- they get every DMS function; Dmslibrary::_check_doc_scope() limits them to
-- documents of their own chapter. Run after 2026-10-18-system-rbac-step2.sql.
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_modules m   ON m.code = 'dms'
  JOIN system_functions f ON f.module_id = m.id
 WHERE g.title = 'Chapter Admins';

UPDATE system_groups
   SET description = 'Members with the Chapter (Subentity) Admin role; manage their own chapter''s documents in DMS'
 WHERE title = 'Chapter Admins';

-- Saving a new document failed in strict mode: document_id is required, has no
-- default, and no code fills or reads it (existing rows hold ''). Give it one.
ALTER TABLE dms_filelibrary_docs MODIFY document_id varchar(255) NOT NULL DEFAULT '';
