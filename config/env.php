<?php
// Per-install settings and secrets.
// Values come from the .env file in the project root (never committed),
// or from real environment variables (Docker), which win over the file.
// See .env.example for the full list.

$env_file = dirname(dirname(__FILE__)).'/.env';
if (is_readable($env_file)) {
    foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }
        list($name, $value) = array_map('trim', explode('=', $line, 2));
        // strip matching surrounding quotes
        if (strlen($value) > 1 && ($value[0] === '"' || $value[0] === "'") && substr($value, -1) === $value[0]) {
            $value = substr($value, 1, -1);
        }
        if (getenv($name) === false) {
            putenv($name.'='.$value);
            $_ENV[$name] = $value;
        }
    }
}

// env('NAME', 'default') - read a setting; default is used when it is not set
function env($name, $default = null) {
    $value = getenv($name);
    return ($value === false) ? $default : $value;
}
