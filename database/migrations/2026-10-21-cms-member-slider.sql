-- ---------------------------------------------------------------------------
-- Separate sliders (2026-10-21): the existing 'slider' section becomes the
-- public website's slider ("Website Slider", off the member home) and a new
-- 'member_slider' section ("Member Home Slider", member home only) is added.
-- Both use the slider layout (site/slider.php). The member slider starts with
-- copies of the website slides, to be replaced on the content manager's
-- Page Sections screen.
-- Safe to run more than once: the rename / switch-off and the copy happen
-- only the first time (while member_slider doesn't exist / has no slides).
-- ---------------------------------------------------------------------------

UPDATE cms_sections
   SET title = IF(title = 'Slider', 'Website Slider', title), show_member = 0, updated_at = UNIX_TIMESTAMP()
 WHERE code = 'slider'
   AND (SELECT COUNT(*) FROM (SELECT id FROM cms_sections WHERE code = 'member_slider') x) = 0;

INSERT IGNORE INTO cms_sections (code, layout, title, subtitle, menu_label, show_member, show_public, allow_public, sort_order, created_at)
VALUES ('member_slider', 'slider', 'Member Home Slider', '', '', 1, 0, 0, 10, UNIX_TIMESTAMP());

INSERT INTO cms_items (section_id, heading, subheading, body, icon, media_id, link_url, link_label, extra, active, sort_order, created_at)
SELECT m.id, i.heading, i.subheading, i.body, i.icon, i.media_id, i.link_url, i.link_label, i.extra, i.active, i.sort_order, UNIX_TIMESTAMP()
  FROM cms_items i
  JOIN cms_sections s ON s.id = i.section_id AND s.code = 'slider'
  JOIN cms_sections m ON m.code = 'member_slider'
 WHERE (SELECT COUNT(*) FROM (SELECT ci.id FROM cms_items ci JOIN cms_sections cs ON cs.id = ci.section_id WHERE cs.code = 'member_slider') y) = 0
 ORDER BY i.sort_order, i.id;
