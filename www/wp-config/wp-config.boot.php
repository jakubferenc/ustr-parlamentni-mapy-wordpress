<?php

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__) . '/');

}

define( 'WP_CONTENT_DIR', ROOT_DIR . 'wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );


define('HOST_DB_USER_PREFIX', '20330');

// Try environment variable 'WP_ENV'
if (getenv('WP_ENV') !== false) {
    // Filter non-alphabetical characters for security
    define('WP_ENV', preg_replace('/[^a-z]/', '', getenv('WP_ENV')));
}

// Define site host
if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
    $hostname = $_SERVER['HTTP_X_FORWARDED_HOST'];
} else {
    $hostname = $_SERVER['HTTP_HOST'];
}

// If WordPress has been bootstrapped via WP-CLI detect environment from --env=<environment> argument
if (PHP_SAPI == "cli" && defined('WP_CLI_ROOT')) {
    foreach ($argv as $arg) {
        if (preg_match('/--env=(.+)/', $arg, $m)) {
            define('WP_ENV', $m[1]);
        }
    }
	$hostname = "localhost";
}

// Filter
$hostname = filter_var($hostname, FILTER_SANITIZE_STRING);

// Try server hostname
if (!defined('WP_ENV')) {
    // Set environment based on hostname
    include ROOT_DIR . 'wp-config/wp-config.env.php';
}

// Are we in SSL mode?
if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
    (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}

// Load default config
include ROOT_DIR . 'wp-config/wp-config.default.php';

// Load config file for current environment
include ROOT_DIR . 'wp-config/wp-config.' . WP_ENV . '.php';

// Define WordPress Site URLs if not already set in config files
if (!defined('WP_SITEURL')) {
    define('WP_SITEURL', $protocol . rtrim($hostname, '/') . '/wordpress/');
}
if (!defined('WP_HOME')) {
    define('WP_HOME', $protocol . rtrim($hostname, '/'));
}


// Clean up
unset($hostname, $protocol);

/** End of WordPress Multi-Environment Config **/



// Absolute path to the WordPress directory
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/wordpress/');

}



/* That's all, stop editing! Happy blogging. */

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
