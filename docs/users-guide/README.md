# Honcho User's Guide — Word Export Tooling

Builds `Honcho_Users_Guide.docx`, the end-user guide (members, chapter/member/content
admins, Document Library, Projects, system admins, staff portal). Written for the BPA
deployment's wording (Member / Chapter).

- `guide.js` — parts and chapters, in order.
- `chapters/*.js` — the content (same block format as `docs/developer-guide/`).
- `generate.js` — a copy of the Developer's Guide generator with this guide's title.

Build: `node generate.js` (needs Node.js and the `docx` npm package).
When a screen changes, update the matching chapter here as well as the Developer's Guide.
