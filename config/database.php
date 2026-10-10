<?php
//Database settings - values come from .env (see config/env.php and .env.example)
require_once __DIR__.'/env.php';
define('HOST', env('DB_HOST', 'localhost'));
define('PORT', env('DB_PORT', '3306'));
define('USER', env('DB_USER', 'root'));
define('PASSWORD', env('DB_PASSWORD', ''));
define('DATABASE', env('DB_DATABASE', 'bpausa'));

// Trongate v2: native database config format, used by the stock Db class
// (modules/db/Db.php) which powers $this->db and any new v2-style modules.
// Mirrors the constants above so both the legacy Model API (used by all
// existing $this->model->... calls) and the native v2 Db API point at the
// same database.
$databases = [
    'default' => [
        'host' => HOST,
        'port' => PORT,
        'user' => USER,
        'password' => PASSWORD,
        'database' => DATABASE
    ]
];
