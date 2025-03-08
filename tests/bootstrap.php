<?php
namespace Contributor\Tests\Unit;

define( 'RT_CONTRIBUTOR_PLUGIN_ROOT', dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR );
$test_dir = getenv( 'WP_TESTS_DIR' );

// Composer autoloader must be loaded before WP_PHPUNIT__DIR will be available
require_once dirname( dirname( __FILE__ ) ) . '/vendor/autoload.php';

if ( ! defined( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH' ) ) {
    define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', dirname( dirname( __FILE__ ) ) . '/vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php' );
}

if ( ! file_exists( $test_dir . '/includes/functions.php' ) ) {
    echo "Could not find $test_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?";
    exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $test_dir . '/includes/functions.php';

tests_add_filter( 'muplugins_loaded', function() {
    require RT_CONTRIBUTOR_PLUGIN_ROOT . 'contributor.php';
} );

// Start up the WP testing environment.
require getenv( 'WP_TESTS_DIR' ) . '/includes/bootstrap.php';