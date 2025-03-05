<?php

use Contributor\Loader;

defined( 'ABSPATH' ) || exit;

/**
 * Initialisation.
 *
*/
function rt_contributors_init() {
    error_log(' this is where');
    ( new Loader )->init();
}

add_action( 'plugins_loaded', 'rt_contributors_init' );