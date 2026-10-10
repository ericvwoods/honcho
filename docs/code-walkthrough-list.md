# Code Walkthrough List

Code that was written in a style different from the rest of the app (usually because the
framework required it) and should be walked through and explained before the owner relies on it.
Tick an item off once it has been walked through.

## Engine / framework (added 2026-10-06 to get the PM module running)

- [ ] **`engine/Trongate.php` → `make_model()`**: how `$this->model` decides between the shared
      legacy `Model` (all 1.x code) and a module's own `<Module>_model.php` (currently only PM).
- [ ] **`modules/validation/Validation.php`** (new): `set_rules()` / `run()`, the CSRF token check,
      rule handling, and how `callback_*` methods on the controller are found and called.
- [ ] **`engine/tg_helpers/utilities_helper.php` → `block_url()`**: how it differs from the existing
      `block_url_invocation()`.
- [ ] **`modules/pm/Pm_model.php`**: why `$this->db->` became `$this->` (the app has no v2 Db module).
- [ ] **`modules/templates/Templates.php` → `error_404($data = [])`**: why every 404 page crashed before.

## PM module (modules/pm/)

- [ ] Overall v2 structure: controller vs. model file, `check_permission()` and the PM roles/
      security-group tables, `require_post_with_token()`.
