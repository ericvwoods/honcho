# Honcho Member Guide — Word Export Tooling

Builds `Honcho_Member_Guide.docx`, the guide for every member: logging in, your profile
and card, rosters, the directory, events and the Document Library. Renamed from the
Users' Guide on 2026-10-29; the admin chapters moved to `docs/admin-guide`.

- `guide.js` — parts and chapters, in order.
- `chapters/*.js` — the content (same block format as `docs/developer-guide/`).
- `generate.js` — the same generator as the other guides, with this guide's title.

Build: `node generate.js` (needs Node.js and the `docx` npm package).
When a member screen changes, update the matching chapter here.
