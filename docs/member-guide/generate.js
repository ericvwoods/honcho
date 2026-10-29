// ============================================================
// generate.js — builds Honcho_Member_Guide.docx from guide.js
// ============================================================
// Usage: node generate.js
//
// Heading levels: Part = title page, Chapter = Heading 1,
// tab = Heading 2, block h2 = Heading 3, block h3 = Heading 4.
// ============================================================

const fs = require('fs');
const {
  Document, Packer, Paragraph, TextRun, HeadingLevel, Table, TableRow, TableCell,
  WidthType, BorderStyle, ShadingType, AlignmentType, PageOrientation,
  LevelFormat, convertInchesToTwip
} = require('docx');
const path = require('path');

const guide = require('./guide.js');

const FONT = 'Calibri';
const MONO = 'Consolas';

// ---- Inline markup parser: **bold**  `code`  _italic_ ----
// Italic delimiters require a non-word-character (or string boundary) on
// the outside of each underscore, so genuine emphasis like "_for_" matches
// but snake_case identifiers like "activate_code" never do.
function parseRuns(text, baseOpts = {}) {
  const runs = [];
  const tokens = text.split(/(\*\*[^*]+\*\*|`[^`]+`|(?<![\w`])_[^_]+_(?![\w`]))/g);
  for (const tok of tokens) {
    if (!tok) continue;
    if (tok.startsWith('**') && tok.endsWith('**')) {
      runs.push(new TextRun({ text: tok.slice(2, -2), bold: true, font: FONT, ...baseOpts }));
    } else if (tok.startsWith('`') && tok.endsWith('`')) {
      runs.push(new TextRun({ text: tok.slice(1, -1), font: MONO, size: 20, color: 'B02020', ...baseOpts }));
    } else if (tok.startsWith('_') && tok.endsWith('_')) {
      runs.push(new TextRun({ text: tok.slice(1, -1), italics: true, font: FONT, ...baseOpts }));
    } else {
      runs.push(new TextRun({ text: tok, font: FONT, ...baseOpts }));
    }
  }
  return runs;
}

function para(text, opts = {}) {
  return new Paragraph({ children: parseRuns(text), spacing: { after: 160 }, ...opts });
}

function heading2(text) { // block h2 -> Word Heading 3
  return new Paragraph({
    text,
    heading: HeadingLevel.HEADING_3,
    spacing: { before: 320, after: 160 },
  });
}

function heading3(text) { // block h3 -> Word Heading 4
  return new Paragraph({
    children: parseRuns(text),
    heading: HeadingLevel.HEADING_4,
    spacing: { before: 240, after: 120 },
  });
}

function bulletList(items, ordered = false) {
  return items.map((item, i) => new Paragraph({
    children: parseRuns(item),
    numbering: { reference: ordered ? 'ordered-list' : 'bullet-list', level: 0 },
    spacing: { after: 100 },
  }));
}

function alertBox(text, variant) {
  const bg = variant === 'warning' ? 'FCF1DC' : 'D9EDF7';
  const border = variant === 'warning' ? 'E8A33D' : '5BC0DE';
  return new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    borders: {
      top: { style: BorderStyle.SINGLE, size: 4, color: border },
      bottom: { style: BorderStyle.SINGLE, size: 4, color: border },
      left: { style: BorderStyle.SINGLE, size: 4, color: border },
      right: { style: BorderStyle.SINGLE, size: 4, color: border },
    },
    rows: [
      new TableRow({
        children: [
          new TableCell({
            width: { size: 100, type: WidthType.PERCENTAGE },
            shading: { type: ShadingType.CLEAR, fill: bg },
            margins: { top: 160, bottom: 160, left: 200, right: 200 },
            children: [new Paragraph({ children: parseRuns(text), spacing: { after: 0 } })],
          }),
        ],
      }),
    ],
  });
}

function codeBlock(text) {
  const lines = text.split('\n');
  return new Table({
    width: { size: 100, type: WidthType.PERCENTAGE },
    borders: {
      top: { style: BorderStyle.SINGLE, size: 4, color: 'CCCCCC' },
      bottom: { style: BorderStyle.SINGLE, size: 4, color: 'CCCCCC' },
      left: { style: BorderStyle.SINGLE, size: 4, color: 'CCCCCC' },
      right: { style: BorderStyle.SINGLE, size: 4, color: 'CCCCCC' },
    },
    rows: [
      new TableRow({
        children: [
          new TableCell({
            width: { size: 100, type: WidthType.PERCENTAGE },
            shading: { type: ShadingType.CLEAR, fill: 'F5F5F5' },
            margins: { top: 160, bottom: 160, left: 200, right: 200 },
            children: lines.map(line => new Paragraph({
              children: [new TextRun({ text: line || ' ', font: MONO, size: 19 })],
              spacing: { after: 0 },
            })),
          }),
        ],
      }),
    ],
  });
}

function dataTable(headers, rows) {
  const colWidthTotal = 9360; // DXA, fits within a US Letter page with 1" margins
  const colWidth = Math.floor(colWidthTotal / headers.length);
  const colWidths = headers.map(() => colWidth);

  const headerRow = new TableRow({
    tableHeader: true,
    children: headers.map((h, i) => new TableCell({
      width: { size: colWidths[i], type: WidthType.DXA },
      shading: { type: ShadingType.CLEAR, fill: '2C3E50' },
      margins: { top: 100, bottom: 100, left: 120, right: 120 },
      children: [new Paragraph({
        children: [new TextRun({ text: h, bold: true, color: 'FFFFFF', font: FONT, size: 20 })],
        spacing: { after: 0 },
      })],
    })),
  });

  const bodyRows = rows.map((rowCells, rIdx) => new TableRow({
    children: rowCells.map((cell, i) => new TableCell({
      width: { size: colWidths[i], type: WidthType.DXA },
      shading: { type: ShadingType.CLEAR, fill: rIdx % 2 === 0 ? 'FFFFFF' : 'F7F9FA' },
      margins: { top: 100, bottom: 100, left: 120, right: 120 },
      children: [new Paragraph({ children: parseRuns(cell, { size: 19 }), spacing: { after: 0 } })],
    })),
  }));

  return new Table({
    width: { size: colWidthTotal, type: WidthType.DXA },
    columnWidths: colWidths,
    rows: [headerRow, ...bodyRows],
  });
}

// ---- Build the document body ----
const children = [];

// Title page content
children.push(new Paragraph({
  children: [new TextRun({ text: "Honcho Member Guide", bold: true, size: 56, font: FONT, color: '2C3E50' })],
  spacing: { after: 200 },
}));
children.push(new Paragraph({
  children: [new TextRun({ text: 'How to use the member portal: logging in, your profile and card, rosters, the directory and the Document Library. Written for the Black Pilots of America deployment. Admins: see the Honcho Administrator\'s Guide.', italics: true, size: 24, font: FONT, color: '666666' })],
  spacing: { after: 100 },
}));
children.push(new Paragraph({
  children: [new TextRun({ text: `Generated ${new Date().toISOString().slice(0, 10)}`, size: 20, font: FONT, color: '999999' })],
  spacing: { after: 600 },
}));

let chapterNum = 0;

guide.forEach(part => {
  // Part title page
  children.push(new Paragraph({
    children: [new TextRun({ text: part.part, bold: true, size: 48, font: FONT, color: '2C3E50' })],
    pageBreakBefore: true,
    spacing: { before: 2400, after: 600 },
  }));

  part.chapters.forEach(chapter => {
  chapterNum++;
  children.push(new Paragraph({
    text: `Chapter ${chapterNum}: ${chapter.title}`,
    heading: HeadingLevel.HEADING_1,
    pageBreakBefore: true,
    spacing: { before: 0, after: 300 },
  }));

  chapter.sections.forEach((section, sIdx) => {
  children.push(new Paragraph({
    text: section.tab,
    heading: HeadingLevel.HEADING_2,
    spacing: { before: sIdx === 0 ? 0 : 500, after: 240 },
    border: { bottom: { style: BorderStyle.SINGLE, size: 6, color: '2C3E50', space: 8 } },
  }));

  section.blocks.forEach(block => {
    switch (block.type) {
      case 'h2':
        children.push(heading2(block.text));
        break;
      case 'h3':
        children.push(heading3(block.text));
        break;
      case 'p':
        children.push(para(block.text));
        break;
      case 'ul':
        children.push(...bulletList(block.items, false));
        children.push(new Paragraph({ text: '', spacing: { after: 120 } }));
        break;
      case 'ol':
        children.push(...bulletList(block.items, true));
        children.push(new Paragraph({ text: '', spacing: { after: 120 } }));
        break;
      case 'alert':
        children.push(alertBox(block.text, block.variant));
        children.push(new Paragraph({ text: '', spacing: { after: 200 } }));
        break;
      case 'code':
        children.push(codeBlock(block.text));
        children.push(new Paragraph({ text: '', spacing: { after: 200 } }));
        break;
      case 'table':
        children.push(dataTable(block.headers, block.rows));
        children.push(new Paragraph({ text: '', spacing: { after: 240 } }));
        break;
    }
  });
  });
  });
});

const doc = new Document({
  numbering: {
    config: [
      {
        reference: 'bullet-list',
        levels: [{ level: 0, format: LevelFormat.BULLET, text: '\u2022', alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 460, hanging: 260 } } } }],
      },
      {
        reference: 'ordered-list',
        levels: [{ level: 0, format: LevelFormat.DECIMAL, text: '%1.', alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 460, hanging: 260 } } } }],
      },
    ],
  },
  styles: {
    default: {
      document: { run: { font: FONT, size: 22 } },
    },
    paragraphStyles: [
      { id: 'Heading1', name: 'Heading 1', basedOn: 'Normal', next: 'Normal', quickFormat: true,
        run: { size: 40, bold: true, color: '2C3E50', font: FONT } },
      { id: 'Heading2', name: 'Heading 2', basedOn: 'Normal', next: 'Normal', quickFormat: true,
        run: { size: 32, bold: true, color: '2C3E50', font: FONT } },
      { id: 'Heading3', name: 'Heading 3', basedOn: 'Normal', next: 'Normal', quickFormat: true,
        run: { size: 26, bold: true, color: '1AB394', font: FONT } },
      { id: 'Heading4', name: 'Heading 4', basedOn: 'Normal', next: 'Normal', quickFormat: true,
        run: { size: 23, bold: true, color: '444444', font: FONT } },
    ],
  },
  sections: [{
    properties: {
      page: {
        size: { width: 12240, height: 15840 }, // US Letter, DXA
        margin: { top: 1440, bottom: 1440, left: 1440, right: 1440 },
      },
    },
    children,
  }],
});

Packer.toBuffer(doc).then(buffer => {
  fs.writeFileSync(path.join(__dirname, 'Honcho_Member_Guide.docx'), buffer);
  console.log('Written: Honcho_Member_Guide.docx');
});

// Web copy for Honcho's Help pages (same chapter files): modules/help/content/member.json
require('../export-web.js')(guide, { key: 'member', title: "Honcho Member Guide", subtitle: "How to use the member portal." });
