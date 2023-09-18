<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both
 * the public-facing side of the site and the admin area.
 *
 * @link       https://www.kwallcompany.com/
 * @since      1.0.0
 *
 * @package    Palmer
 * @subpackage Palmer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Palmer
 * @subpackage Palmer/includes
 * @author     Kwall <info@kwallcompany.com>
 */
class Palmer {

  /**
   * The loader that's responsible for maintaining and registering all hooks
   * that power the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Palmer_Loader $loader Maintains and registers all hooks for the
   *   plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string $plugin_name The string used to uniquely identify this
   *   plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string $version The current version of the plugin.
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the
   * plugin. Load the dependencies, define the locale, and set the hooks for
   * the admin area and the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {
    if (defined('PALMER_VERSION')) {
      $this->version = PALMER_VERSION;
    }
    else {
      $this->version = '1.0.0';
    }
    $this->plugin_name = 'palmer';

    $this->load_dependencies();
    $this->define_admin_func();

  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Palmer_Loader. Orchestrates the hooks of the plugin.
   * - Palmer_i18n. Defines internationalization functionality.
   * - Palmer_Admin. Defines all hooks for the admin area.
   * - Palmer_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-palmer-loader.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-palmer-admin.php';

    $this->loader = new Palmer_Loader();

  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_func() {

    $plugin_admin = new Palmer_Admin($this->get_plugin_name(), $this->get_version());

    // Defining admin hooks.
    //		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    //		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    // Change ACF Local JSON save location to /acf folder inside this plugin
    $this->loader->add_filter('acf/settings/save_json', $plugin_admin, 'acf_save_json');
    // Include the /acf folder in the places to look for ACF Local JSON files
    $this->loader->add_filter('acf/settings/load_json', $plugin_admin, 'acf_load_json');

    // Add acf theme options.
    $plugin_admin->add_theme_option_page();
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @return    string    The name of the plugin.
   * @since     1.0.0
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @return    Palmer_Loader    Orchestrates the hooks of the plugin.
   * @since     1.0.0
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @return    string    The version number of the plugin.
   * @since     1.0.0
   */
  public function get_version() {
    return $this->version;
  }

}
