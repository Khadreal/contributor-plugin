<?php

use Contributor\Loader;

defined( 'ABSPATH' ) || exit;

if ( file_exists( RT_CONTRIBUTOR_PATH . 'vendor/autoload.php' ) ) {
    require_once RT_CONTRIBUTOR_PATH . 'vendor/autoload.php';
}

/**
 * Initialisation.
 */
function rt_contributors_init() {
    ( new Loader() )->init();
}

add_action( 'plugins_loaded', 'rt_contributors_init' );
