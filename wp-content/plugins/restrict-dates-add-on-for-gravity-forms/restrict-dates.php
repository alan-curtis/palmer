<?php
/*
Plugin Name: Restrict Dates Add-On for Gravity Forms
Plugin Url: https://pluginscafe.com
Version: 1.1.0
Description: This plugin adds date restrict options on gravity forms datepicker field
Author: KaisarAhmmed
Author URI: https://pluginscafe.com
License: GPLv2 or later
Text Domain: gravityforms
*/

define( 'GF_RESTRICT_DATES_ADDON_VERSION', '1.1.0' );

add_action( 'gform_loaded', array( 'GF_Restrict_Dates_AddOn_Bootstrap', 'load' ), 5 );

class GF_Restrict_Dates_AddOn_Bootstrap {

    public static function load() {

        if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
            return;
        }
        // are we on GF 2.5+
		define( 'GFIC_GF_MIN_2_5', version_compare( GFCommon::$version, '2.5-dev-1', '>=' ) );

        require_once( 'class-gfrestrictdates.php' );

        GFAddOn::register( 'GFRestrictDatesAddOn' );
    }

}

function gf_restrict_dates() {
    return GFRestrictDatesAddOn::get_instance();
}