<?php
namespace Contributor\Tests\Unit;

define( 'RT_CONTRIBUTOR_PLUGIN_ROOT', dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR );
define( 'RT_CONTRIBUTOR_TEMPLATE_PATH', __DIR__ . '/views' );
$test_dir = getenv( 'WP_TESTS_DIR' );

// Composer autoloader must be loaded before WP_PHPUNIT__DIR will be available.
require_once dirname( dirname( __FILE__ ) ) . '/vendor/autoload.php';

require_once dirname( dirname( __FILE__ ) ) . '/vendor/yoast/wp-test-utils/src/BrainMonkey/bootstrap.php';

if ( ! defined( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH' ) ) {
    define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', dirname( dirname( __FILE__ ) ) . '/vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php' );
}