# Honcho Administrator's Guide — Word Export Tooling

Builds `Honcho_Administrators_Guide.docx`: step-by-step setup and everyday tasks for
Chapter, Member, Student, Content, Event, Financial and System Admins and staff
(created 2026-10-29 from the admin chapters of the old Users' Guide). Members' own
tasks are in `docs/member-guide`; code, servers and conventions in `docs/developer-guide`.

- `guide.js` — parts and chapters, in order (chapter numbers are referenced in the text).
- `chapters/*.js` — the content (same block format as `docs/developer-guide/`).
- `generate.js` — the same generator as the other guides, with this guide's title.

Build: `node generate.js` (needs Node.js and the `docx` npm package).
When an admin screen changes, update the matching chapter here as well as the Developer's Guide.
