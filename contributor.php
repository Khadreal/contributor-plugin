<?php
/**
 * Plugin Name: Contributors
 * Plugin URI: https://khadreal.github.io
 * Description: Wordpress contributors plugin.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.3
 * Author: Opeyemi Ibrahim
 * Author URI: https://khadreal.github.io
 * Licence: GPLv2 or later
 *
 * Text Domain: rt-contributor
 *
 */

defined( 'ABSPATH' ) || exit;

//Define constant.
define( 'RT_CONTRIBUTOR_FILE', __FILE__ );
define( 'RT_TEMPLATE_PATH', realpath( plugin_dir_path( RT_CONTRIBUTOR_FILE ) ) . '/views' );

