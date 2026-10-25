<?php
// Organization settings from the system_settings table (System Settings screen).
// config.php defines its changeable constants from here, e.g.
//     define('SUBENTITY', setting('SUBENTITY', 'Chapter'));
//     define('CCMPS_CRUD_LABEL_CLR', scheme_color('label', 'darkgreen'));
// so code keeps using the constant and the value can be changed on the screen.
// The default is used when the row doesn't exist or the table can't be read
// (a fresh install before its migrations, or the database down).
// Settings plan, phase 2 (2026-10-22) and phase 3 (color schemes, 2026-10-25).
// Needs env.php (the DB_* settings).

require_once __DIR__.'/env.php';

/**
 * The connection used by setting() and scheme_color(): their own, made once per
 * page, because config.php runs before the database layer. false when the
 * database can't be reached (callers then use their defaults).
 *
 * @return PDO|false
 */
function _settings_pdo() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host='.env('DB_HOST', 'localhost').';port='.env('DB_PORT', '3306').';dbname='.env('DB_DATABASE', 'bpausa').';charset=utf8mb4';
            $pdo = new PDO($dsn, env('DB_USER', 'root'), env('DB_PASSWORD', ''), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Throwable $e) {
            error_log('settings: database could not be reached, using defaults: '.$e->getMessage());
            $pdo = false;
        }
    }
    return $pdo;
}

/**
 * One value from system_settings, by its title. All rows are read once per page.
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
        $pdo = _settings_pdo();
        if ($pdo) {
            try {
                foreach ($pdo->query('SELECT title, settingvalue FROM system_settings') as $row) {
                    $values[$row['title']] = $row['settingvalue'];
                }
            } catch (Throwable $e) {
                error_log('setting(): system_settings could not be read, using defaults: '.$e->getMessage());
            }
        }
    }
    return array_key_exists($title, $values) ? $values[$title] : $default;
}

/**
 * One of the six colors of the scheme in use (COLOR_SCHEME, system_color_schemes).
 * Classic stores no colors, so every constant keeps its own color ($default),
 * exactly as before schemes existed.
 *
 * @param string $slot    primary, accent, highlight, label, value or menu
 * @param string $default The color config.php has always used for this constant
 * @return string
 */
function scheme_color(string $slot, string $default): string {
    static $scheme = null;
    if ($scheme === null) {
        $scheme = array();
        $pdo = _settings_pdo();
        if ($pdo) {
            try {
                $stmt = $pdo->prepare('SELECT * FROM system_color_schemes WHERE id = ?');
                $stmt->execute(array((int) setting('COLOR_SCHEME', 0)));
                $scheme = $stmt->fetch(PDO::FETCH_ASSOC) ?: array();
            } catch (Throwable $e) {
                error_log('scheme_color(): system_color_schemes could not be read, using defaults: '.$e->getMessage());
            }
        }
    }
    $color = $scheme[$slot.'_clr'] ?? '';
    return preg_match('/^#[0-9a-fA-F]{6}$/', (string) $color) ? $color : $default;
}
