<?php
// Organization settings from the system_settings table (System Settings screen).
// config.php defines its changeable constants from here, e.g.
//     define('SUBENTITY', setting('SUBENTITY', 'Chapter'));
// so code keeps using the constant and the value can be changed on the screen.
// The default is used when the row doesn't exist or the table can't be read
// (a fresh install before its migrations, or the database down).
// Settings plan, phase 2 (2026-10-22). Needs env.php (the DB_* settings).

require_once __DIR__.'/env.php';

/**
 * One value from system_settings, by its title. All rows are read once per page,
 * with their own connection, because config.php runs before the database layer.
 *
 * @param string $title   system_settings.title, e.g. 'SUBENTITY', 'system_current_year'
 * @param mixed  $default Returned when there is no such row
 * @param bool   $refresh Read the table again (after a save on the screen)
 * @return mixed
 */
function setting(string $title, $default = null, bool $refresh = false) {
    static $values = null;
    if ($values === null || $refresh) {
        $values = array();
        try {
            $dsn = 'mysql:host='.env('DB_HOST', 'localhost').';port='.env('DB_PORT', '3306').';dbname='.env('DB_DATABASE', 'bpausa').';charset=utf8mb4';
            $pdo = new PDO($dsn, env('DB_USER', 'root'), env('DB_PASSWORD', ''), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            foreach ($pdo->query('SELECT title, settingvalue FROM system_settings') as $row) {
                $values[$row['title']] = $row['settingvalue'];
            }
        } catch (Throwable $e) {
            error_log('setting(): system_settings could not be read, using defaults: '.$e->getMessage());
        }
    }
    return array_key_exists($title, $values) ? $values[$title] : $default;
}
