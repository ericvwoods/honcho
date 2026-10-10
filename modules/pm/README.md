# PM Module – Phase 1 (Teams & Projects) – Trongate v2

## Folder layout

```
modules/
  pm/
    Pm.php            ← controller: decides what happens
    Pm_model.php      ← all database work (reached as $this->model->...)
    views/
      projectlist.php  showproject.php  projectform.php
      teamlist.php     showteam.php     teamform.php
      navbar.php  pmmenu.php  flashmsg.php  formerrors.php  datatable.php
```

`pm_schema.sql` sits next to this README. It's the same schema as before;
only the `pm_functions` titles changed, to match the v2 method names.

## Install

1. **Copy** the `pm` folder into `modules/`.

2. **Run** `pm_schema.sql`.

3. **Add the on/off switch.** Insert a `system_settings` row with
   `settingvalue = 1`, then set its id at the top of `Pm.php`:

   ```php
   private const PM_SYS_SETTING_ID = 0;   // <-- your row's id
   ```

4. **Add the inspinia template to the v2 templates module.** In v2,
   templates are an ordinary module (`modules/templates/`). If you haven't
   already moved inspinia there:

   - Move `inspinia.php` to `modules/templates/views/inspinia.php`, and
     change the one line that shows the page content:

     ```php
     <main><?= Template::display($data) ?></main>   // v1
     <main><?= display($data) ?></main>             // v2
     ```

   - Add this method to `modules/templates/Templates.php`, next to `admin()`:

     ```php
     public function inspinia(array $data): void {
         $this->display('inspinia', $data);
     }
     ```

   - v2 serves CSS/JS from `public/`, so `themes/inspinia/...` must live
     under `public/themes/inspinia/`.

5. **Give yourself PM Admin access:**

   ```sql
   INSERT INTO pm_tguserid_security_group (tg_user_id, security_group_id)
   VALUES (YOUR_TG_USER_ID, 1);   -- 1 = PM Admins, 2 = PM Users
   ```

6. **Menu link on ccmphome.** In the controller that loads ccmphome:

   ```php
   $pm = $this->db->get_where(YOUR_PM_SETTING_ID, 'system_settings');
   $data['pm_enabled'] = ($pm !== false && intval($pm->settingvalue) === 1);
   ```

   And in the view:

   ```php
   <?php if (!empty($pm_enabled)): ?>
       <a href="<?= BASE_URL ?>pm"><i class="fa fa-tasks"></i> Projects</a>
   <?php endif; ?>
   ```

7. **Optional:** offer CCMP members in the team picker:

   ```sql
   UPDATE pm_settings SET settingvalue = '1' WHERE setting_key = 'include_ccmps_users';
   ```

PM also uses your own `timedate` and `system-auditlogger` modules, and the
Honcho constants `SYS_ADMIN_PHONE`, `NB_CLR`, `SN_*` and `PUBLIC_WEBSITE`.
All of these need to exist in your v2 app.

## URLs

| URL | What it does | Who |
|---|---|---|
| `pm` | My Projects | all PM users |
| `pm/show_project/ID` | One project | admin, the PO, or team members |
| `pm/manage_projects` | Every project | admin |
| `pm/create_project` | New project form | admin |
| `pm/create_project/ID` | Edit project form | admin |
| `pm/manage_teams`, `pm/show_team/ID` | Teams | admin |
| `pm/create_team`, `pm/create_team/ID` | New / edit team | admin |

Everything else (`submit_*`, `delete_*`, `add_member`, `remove_member`)
is a POST target for a form.

## v1 → v2: what changed and why

**Controller location.** `modules/pm/controllers/Pm.php` became
`modules/pm/Pm.php`. v2 removed the `controllers/` subfolder.

**Controller and model split.** Database code moved into `Pm_model.php`.
The controller calls it as `$this->model->get_project($id)`, and the model
uses `$this->db`. In v2, `$this->model` means *this module's model file*,
not the database.

**Bound parameters.** v1 cast ids with `(int)` and pasted them into SQL.
v2 uses `$this->db->query_bind()`:

```php
$this->db->query_bind(
    'SELECT * FROM pm_projects WHERE team_id = :team_id',
    ['team_id' => $team_id], 'object');
```

The value travels separately from the SQL text, so it can never become SQL.

**Constructor.** v2 requires this signature, with the parent call first:

```php
public function __construct(?string $module_name = null) {
    parent::__construct($module_name);
    ...
}
```

**Private helpers.** Helpers are now `private function` instead of
`_underscore` names. v2 returns a 404 if a URL points at a private method.

**Validation.** Each form uses v2's validation module:

```php
$this->validation->set_rules('team_id', 'team', 'callback_team_check');
if ($this->validation->run() !== true) { $this->create_project(); return; }
```

`run()` checks the CSRF token first, then the rules. The whitelist checks
are the `*_check` callbacks in `Pm.php`. Each returns `true` or an error
message, and `{label}` in the message becomes the field's label. Callbacks
must be public so the validation module can call them, so each one starts
with `block_url()`.

**CSRF.** Forms use `form_open()` and `form_close()`. `form_close()` adds
the hidden `csrf_token` field. The small POST-only actions (delete,
add/remove member) call `$this->validation->run()` with no rules, which
does just the token check. A forged request is sent to `BASE_URL`.

**Create/update pattern.** One form method handles both new and edit:
`create_project` for new, `create_project/ID` for edit. After a failed
submit it redisplays with the typed values.

**Escaping.** `pm_e()` became v2's built-in `out()`.

**Flash messages.** v2's `flashdata()` clears itself once shown, so the
`set_flashdata('')` reset lines are gone. `$_SESSION['flashmsgcolor']` still
picks green or red.

**Navbar.** PM has its own copy of your navbar that only uses values PM
always sets, so it never warns about a missing `ccmpmode`.

## How it was tested

It ran on the real Trongate v2 engine (release 2.2026.0927) with MariaDB
and a PHP web server, and the pages were driven over HTTP. There was no
`ccmps` table at first; one was added later to test the CCMP setting.
42 of 42 checks passed, including:

- **Forms:** validation errors show and keep what was typed; duplicate team
  names are rejected regardless of case or spacing; bad team, PO, status and
  date values are all reported.
- **CSRF and tampering:** forged or missing tokens are blocked on every
  action; GET requests to delete URLs do nothing; posting an array instead
  of a value doesn't crash anything.
- **Permissions:** PM Users see only their teams' projects and are bounced
  from admin pages; people without PM access are bounced; typing a project
  URL for another team is refused; switching PM off in `system_settings`
  redirects everyone.
- **Routing:** private methods return 404. Validation callbacks can't be
  run from a URL: v2 refuses any method with a required parameter
  ("Direct URL access not permitted", a 500 in dev and a 403 in production).
- **Output:** HTML typed into fields is shown as text; dates are stored as
  timestamps and shown correctly on edit.
- **Rules and logging:** a team with open projects can't be deleted; the
  audit log gets one entry per change; CCMP members appear and are labeled
  when the setting is on.
