-- ---------------------------------------------------------------------------
-- Website content manager: who may post Sunshine, Bulletin Board and Careers
-- (decided 2026-10-20).
--
--   Content Admins / System Admins  any kind, any scope, Public allowed
--   Chapter Admins (cms/chapter_posts)  Sunshine, Bulletin Board, Careers for
--                    All Members (the default) or their own chapter; never Public
--   Members          Bulletin Board sticky notes, same two scopes; posted
--                    approved, and a Chapter Admin, Content Admin or System
--                    Admin can set them to pending or disapproved
--                    (switched off with CMS_MEMBER_BULLETINS=0)
--
-- New cms_posts columns:
--   status               approved | pending | disapproved (only approved shows)
--   poster_subentity_id  the chapter of the Chapter Admin or member who posted
--                        it (0 = posted by a Content Admin); lets a Chapter Admin
--                        find and moderate their chapter's notes
-- Safe to run more than once.
-- ---------------------------------------------------------------------------

ALTER TABLE cms_posts
  ADD COLUMN IF NOT EXISTS status varchar(12) NOT NULL DEFAULT 'approved' AFTER active,
  ADD COLUMN IF NOT EXISTS poster_subentity_id int NOT NULL DEFAULT 0 AFTER subentity_id;

INSERT IGNORE INTO system_functions (module_id, code, title, description, sort_order, created_at)
SELECT m.id, 'chapter_posts', 'Post for own chapter', 'Sunshine, Bulletin Board and Careers posts for all members or your own chapter; approve members'' sticky notes', 40, UNIX_TIMESTAMP()
  FROM system_modules m WHERE m.code = 'cms';

INSERT IGNORE INTO system_group_functions (group_id, function_id, created_at)
SELECT g.id, f.id, UNIX_TIMESTAMP()
  FROM system_groups g
  JOIN system_modules m   ON m.code = 'cms'
  JOIN system_functions f ON f.module_id = m.id AND f.code = 'chapter_posts'
 WHERE g.title = 'Chapter Admins';
