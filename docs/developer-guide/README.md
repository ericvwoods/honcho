# Honcho Developer's Guide — Word Export Tooling

This folder is **build tooling only** — nothing here is loaded by the running
application. It builds one Word (`.docx`) file, the Honcho Developer's Guide,
with a chapter per module. (Moved here on 2026-10-06 from
`modules/welcome/ccmps-docs-source/`, when the guide grew beyond CCMPS.)

## Files

- **`guide.js`** — the table of contents: parts and chapters, in order.
  Add a chapter here.
- **`chapters/*.js`** — the actual content, one file per chapter, as
  structured data (headings, paragraphs, tables, alert boxes, code blocks).
  **These are the files to edit.**
  - `ccmps.js` — Core: CCMPS (members). Mirrors the in-app page
    `modules/welcome/ccmps/views/helpdocs.php`.
  - `dms.js` — Core: DMS (document management).
  - `pms.js` — Add-on: PMS (project management).
  - `deployment.js` — Installation & Configuration: hosting on
    DigitalOcean, BPA's droplet, server access, setup steps (DO-xx cards).
- **`generate.js`** — reads `guide.js` and builds
  `Honcho_Developers_Guide.docx` in this folder. Only touch it for
  structural/styling changes.
- `CCMPS_Developer_Documentation.docx` — the last CCMPS-only build
  (2026-08-30). Delete once the new guide has been generated.

Heading levels in the Word file: Part = title page, Chapter = Heading 1,
tab = Heading 2, `h2` blocks = Heading 3, `h3` blocks = Heading 4.

## Regenerating the Word document

Needs Node.js (https://nodejs.org, LTS installer) and the `docx` npm package:

```bash
cd docs/developer-guide
npm install docx      # first time only
node generate.js
```

## Keeping this in sync

`chapters/ccmps.js` is hand-kept in sync with `helpdocs.php` — not
auto-derived. Whenever `helpdocs.php` changes:

1. Update the matching section in `chapters/ccmps.js` (find the block by its
   `tab:` name).
2. Run `node generate.js`.
3. Open the `.docx` and check it before treating it as final.

DMS and PMS have no in-app help page yet; Honcho's built-in online help for
developers is planned and should follow the same chapters.

When a module's code changes, update its chapter in the same piece of work.

## If you edit a chapter file yourself

If you hand-edit a chapter file directly, make sure the next change starts
from your edited copy, so edits never get silently overwritten by a stale
working copy.
