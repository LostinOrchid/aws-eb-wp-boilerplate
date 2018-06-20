<?php

function env($env, $default = null) {
    return isset($_SERVER[$env]) ? $_SERVER[$env] : $$default;
}

// Avoid infinite redirect on servers under ELB.
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS']='on';
}

define('DB_NAME', env('RDS_DB_NAME', 'wordpress'));
define('DB_USER', env('RDS_USERNAME', 'root'));
define('DB_PASSWORD', env('RDS_PASSWORD', ''));
define('DB_HOST', env('RDS_HOSTNAME', 'localhost'));
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('AUTH_KEY',         env('AUTH_KEY', 'test'));
define('SECURE_AUTH_KEY',  env('SECURE_AUTH_KEY', 'test'));
define('LOGGED_IN_KEY',    env('LOGGED_IN_KEY', 'test'));
define('NONCE_KEY',        env('NONCE_KEY', 'test'));
define('AUTH_SALT',        env('AUTH_SALT', 'test'));
define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT', 'test'));
define('LOGGED_IN_SALT',   env('LOGGED_IN_SALT', 'test'));
define('NONCE_SALT',       env('NONCE_SALT', 'test'));

$table_prefix  = env('WP_TABLE_PREFIX', 'wp_anh_');

define('WP_DEBUG', env('WP_DEBUG', '1') );
define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', '1') );
define("DISALLOW_FILE_EDIT", env('DISALLOW_FILE_EDIT', '0'));
define("DISALLOW_FILE_MODS", env('DISALLOW_FILE_MODS', '0'));


if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
