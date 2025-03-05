<?php
/**
 * Plugin Name: Contributors
 * Plugin URI: https://khadreal.github.io
 * Description: A WordPress contributors plugin that allows you to select multiple authors for your post.
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
define( 'RT_CONTRIBUTOR_PATH', realpath( plugin_dir_path( RT_CONTRIBUTOR_FILE ) ) . '/' );
define( 'RT_CONTRIBUTOR_TEMPLATE_PATH', realpath( plugin_dir_path( RT_CONTRIBUTOR_FILE ) ) . '/views' );

require_once RT_CONTRIBUTOR_PATH . 'inc/main.php';

/**
 * Check requirements before installing/uninstalling process.
 *
*/
function rt_contributors_check_requirement() {

}

register_activation_hook( RT_CONTRIBUTOR_FILE, 'rt_contributors_check_requirement' );

register_uninstall_hook( RT_CONTRIBUTOR_FILE, 'rt_contributors_check_requirement' );