<?php

/**
 *
 * @link              https://www.kwallcompany.com/
 * @since             1.0.0
 * @package           Palmer
 *
 * @wordpress-plugin
 * Plugin Name:       Palmer
 * Plugin URI:        https://www.kwallcompany.com/
 * Description:       Palmer admin and public facing functionality.
 * Version:           1.0.0 Author:
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PALMER_VERSION', '1.0.0');

/**
 * Define plugin directory.
 */
define('PALMER_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-palmer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_palmer() {

  $plugin = new Palmer();
  $plugin->run();

}

run_palmer();
