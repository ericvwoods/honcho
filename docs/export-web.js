// ============================================================
// export-web.js — writes a guide's web copy for Honcho's Help pages (added 2026-10-29)
// ============================================================
// Each guide's generate.js calls this after building the Word file, so the Word
// and web versions always come from the same chapter files. The copy goes into
// modules/help/content/<key>.json (inside the app, because docs/ is not deployed).
// Help (modules/help) renders the same blocks: p, h2, h3, ul, ol, alert, code,
// table, with **bold**, `code` and _italic_ inline.
// ============================================================

const fs = require('fs');
const path = require('path');

function slug(text) {
  return String(text).toLowerCase().replace(/&/g, 'and').replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
}

module.exports = function exportWeb(guide, meta) {
  const chapters = [];
  let num = 0;
  guide.forEach(part => {
    part.chapters.forEach(chapter => {
      num++;
      chapters.push({
        num,
        part: part.part,
        title: chapter.title,
        slug: slug(chapter.title),
        sections: chapter.sections.map(s => ({ tab: s.tab, slug: slug(s.tab), blocks: s.blocks })),
      });
    });
  });
  const out = { key: meta.key, title: meta.title, subtitle: meta.subtitle || '', generated: new Date().toISOString().slice(0, 10), chapters };
  const dir = path.join(__dirname, '..', 'modules', 'help', 'content');
  fs.mkdirSync(dir, { recursive: true });
  fs.writeFileSync(path.join(dir, meta.key + '.json'), JSON.stringify(out, null, 1));
  console.log('Written: modules/help/content/' + meta.key + '.json');
};
