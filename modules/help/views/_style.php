<style>
  /* Help pages: guide text at the member's Values size (Font pop-up), headings in the scheme's primary color */
  .help-page { font-size: <?= (int) ($font_px ?? 16) ?>px; line-height: 1.6; color: #333; }
  .help-page p, .help-page li { max-width: 78ch; }
  .help-page h2.help-section { color: <?= SN_CLR ?>; font-size: 1.5em; margin: 28px 0 12px; padding-bottom: 6px; border-bottom: 1px solid #e7eaec; scroll-margin-top: 20px; }
  .help-page h3.help-h2 { font-size: 1.2em; font-weight: 600; margin: 20px 0 8px; }
  .help-page h4.help-h3 { font-size: 1.05em; font-weight: 600; margin: 16px 0 6px; }
  .help-page code { color: #b02020; background: #f6f6f6; padding: 1px 4px; border-radius: 3px; font-size: .9em; }
  .help-page .help-code { background: #f6f6f6; border: 1px solid #e7eaec; padding: 10px; font-size: .85em; white-space: pre-wrap; }
  .help-page .help-table { font-size: .95em; }
  .help-page .help-table th { background: #f3f3f4; }
  .help-toc { font-size: 15px; }
  .help-toc a { display: block; padding: 4px 0; color: #555; }
  .help-toc a.current { color: <?= SN_CLR ?>; font-weight: bold; }
  .help-toc .help-part { margin-top: 12px; font-size: 12px; letter-spacing: .06em; text-transform: uppercase; color: #999; }
  .help-search { display: flex; gap: 8px; max-width: 520px; }
  .help-search input { font-size: 16px; }
</style>
