<?php

define('DB_NAME', PROJECT_NAME . '.localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

define('WP_DEBUG', true);
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );

@ini_set( 'display_errors', 1 );
ini_set('log_errors', 'On');

define( 'SAVEQUERIES', true );

define( 'SCRIPT_DEBUG', true );

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if ( class_exists('Jetpack') && Jetpack::is_active() ) {

    define( 'JETPACK_DEV_DEBUG', true);

}

define('WP_CACHE', false); //Added by WP-Cache Manager


define('BLOG_PUBLIC', '0');
