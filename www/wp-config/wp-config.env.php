<?php
switch ($hostname) {
    case WP_ENV_DEV_HOSTNAME:
        define('WP_ENV', 'development');
        break;

    case WP_ENV_STAGING_HOSTNAME:
        define('WP_ENV', 'staging');
        break;

    case WP_ENV_PRODUCTION_HOSTNAME:
    default:
        define('WP_ENV', 'production');
}

