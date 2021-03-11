<?php

define('PROJECT_NAME', 'ustr-parlamentni-mapy');

// Define environment hostnames
define('WP_ENV_DEV_HOSTNAME', PROJECT_NAME . '.local');
define('WP_ENV_STAGING_HOSTNAME', PROJECT_NAME . '.jakubferenc' . '.cz');
define('WP_ENV_PRODUCTION_HOSTNAME', 'www.' . PROJECT_NAME . '.cz');

// load project specific settings
require_once(__DIR__ . '/wp-config/wp-config.boot.php');

