# Honcho Developer's Guide — Word Export Tooling

This folder is **build tooling only**: nothing here is loaded by the running
application. It builds the **Honcho Developer's Guide** (`Honcho_Developers_Guide.docx`),
one chapter per module, and the same text as the Developer's Guide Help pages in Honcho.
(Moved here on 2026-10-06 from `modules/welcome/ccmps-docs-source/`, when the guide
grew beyond CCMPS; the old CCMPS-only `CCMPS_Developer_Documentation.docx` was deleted
on 2026-10-30.)

## Files

- **`guide.js`**: the table of contents, parts and chapters in order. Add a chapter here.
- **`chapters/*.js`**: the content, one file per chapter, as structured data (headings,
  paragraphs, tables, alert boxes, code blocks). **These are the files to edit.**
  - Part I, Core: `ccmps.js` (members), `dms.js` (Document Library), `security.js`
    (RBAC, System Settings, login hardening), `cms.js` (Website).
  - Part II, Add-ons: `pms.js` (Projects), `ai.js` (Honcho AI and the Coffee Report).
  - Part III, Installation & Configuration: `workstation.js`, `deployment.js`
    (DigitalOcean, staging), `configuration.js`, `conventions.js`.
- **`generate.js`**: reads `guide.js`, writes `Honcho_Developers_Guide.docx` here, then
  `modules/help/content/developer.json` through `../export-web.js` (the Help pages).
  Only touch it for structural or styling changes.

Heading levels in the Word file: Part = title page, Chapter = Heading 1,
tab = Heading 2, `h2` blocks = Heading 3, `h3` blocks = Heading 4.

## Regenerating

Needs Node.js (https://nodejs.org, LTS installer) and the `docx` npm package:

```bash
cd docs/developer-guide
npm install docx      # first time only
node generate.js
```

Commit the `.docx` and `modules/help/content/developer.json` together with the
chapter change. Never edit the JSON by hand.

## The other documents

Built the same way, each in its own folder: the **Member Guide** (`docs/member-guide`),
the **Administrator's Guide** (`docs/admin-guide`), and the private **Honcho
Requirements** book (`docs/requirements`, no Help pages). When a module's code
changes, update its chapter here, the matching user-facing guide, and its requirements
in the same piece of work.

## If you edit a chapter file yourself

Make sure the next change starts from your edited copy, so edits never get silently
overwritten by a stale working copy.
