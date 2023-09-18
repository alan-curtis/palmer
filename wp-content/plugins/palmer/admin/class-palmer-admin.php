<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.kwallcompany.com/
 * @since      1.0.0
 *
 * @package    Palmer
 * @subpackage Palmer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Palmer
 * @subpackage Palmer/admin
 * @author     Kwall <info@kwallcompany.com>
 */
class Palmer_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $plugin_name The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $version The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @param string $plugin_name The name of this plugin.
   * @param string $version The version of this plugin.
   *
   * @since    1.0.0
   */
  public function __construct($plugin_name, $version) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

  }

  /**
   * Add acf theme options.
   */
  public function add_theme_option_page() {
    if (function_exists('acf_add_options_page')) {

      acf_add_options_page([
        'page_title' => 'General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => FALSE,
      ]);

    }
  }

  /**
   * Define directory for saving local acf json.
   *
   * @return string
   */
  public function acf_save_json($path) {
    return PALMER_PLUGIN_DIR . 'acf';
  }

  /**
   * Define directory for loading loacl acf json.
   *
   * @return array
   */
  public function acf_load_json($paths) {
    $paths = [];
    $paths[] = PALMER_PLUGIN_DIR . 'acf';
    return $paths;
  }
}
