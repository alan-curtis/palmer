<?php
/**
 * Plugin Name: Chiropractors Import
 * Description:  This handles the import process of chiropractors
 */

if( ! function_exists('add_action') ){
    echo "Not Wordpress";
    exit;
}

//Setup
 define('PLUGIN_URL', plugin_dir_url(__FILE__) );

//Includes
require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
include_once( 'includes/activate.php' );
include_once( 'includes/chiropractors.php' );

//Hooks
register_activation_hook( __FILE__ , 'chiro_activate_plugin' );
register_deactivation_hook( __FILE__ , 'chiro_deactivate_plugin' );
?>