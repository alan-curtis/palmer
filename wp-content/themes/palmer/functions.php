<?php

/** Enqueue scripts */
require_once('function-libraries/enqueue-scripts.php');

/** Add theme support */
require_once('function-libraries/theme-support.php');
require_once('function-libraries/theme-helper.php');
require_once('function-libraries/navigation.php');
require_once('function-libraries/directory-ajax.php');
require_once('function-libraries/events-ajax.php');
require_once('function-libraries/news-filter-ajax.php');
require_once('function-libraries/promo-block-widget.php');
require_once('function-libraries/class-sidebar-walker.php');
require_once('function-libraries/events_with_map.php');
// require_once('function-libraries/chiropractor_save.php');
require_once('function-libraries/map-events-listing.php');
require_once('function-libraries/institutions-shortcode.php');
require_once('function-libraries/institutions-ajax.php');

/** =============================================================== **/
/** General Wordpress Theme Settings **/
/** =============================================================== **/
/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');
// Add theme support for Featured Images
add_theme_support('post-thumbnails');
// Add theme support for Menus
add_theme_support('menus');
/** =============================================================== **/
/** Include Scripts and CSS **/
/** =============================================================== **/
function wpcustomtheme_register_styles()
{
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style('Fonts', 'https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@300;400;500;600;700;800;900&display=swap');
    wp_enqueue_style('Font', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap');
    wp_enqueue_style('wpcustomtheme-theme-vendors', get_template_directory_uri() . '/dist/css/theme-vendors.css', NULL, $theme_version);
    wp_enqueue_style('wpcustomtheme-theme-main', get_template_directory_uri() . '/dist/css/theme-main.css', NULL, $theme_version);
}

add_action('wp_enqueue_scripts', 'wpcustomtheme_register_styles');
/**
 * Register and Enqueue Scripts.
 */
function wpcustomtheme_register_scripts()
{
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_script('wpcustomtheme-manifest-js', get_template_directory_uri() . '/dist/js/manifest.js', array(), $theme_version, FALSE);
    wp_enqueue_script('wpcustomtheme-vendors-js', get_template_directory_uri() . '/dist/js/vendor.js', array(), $theme_version, FALSE);
    wp_enqueue_script('wpcustomtheme-theme-main-js', get_template_directory_uri() . '/dist/js/theme-main.js', array(), $theme_version, FALSE);
    wp_enqueue_script('wpcustomtheme-alert-banner', get_template_directory_uri() . '/dist/js/alert-banner.js', array(), '1.1', true);
}

add_action('wp_enqueue_scripts', 'wpcustomtheme_register_scripts');
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'icon_url' => 'dashicons-art',
    ));
}
/** =============================================================== **/
/** General Theme Helpers **/
/** =============================================================== **/
/** =============================================================== **/
/** Menu Settings & Generation **/
/** =============================================================== **/
// Register WordPress Menus
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
        'breadcrumb-menu' => 'Breadcrumb Menu',
    ));
}
// Get Menu by Theme Location
function getMenuItemsByLocation($locationSlug)
{
    $menuLocations = get_nav_menu_locations();
    if ($locationSlug == 'header-menu') {
        $menuID = $menuLocations['main-nav'];
    }
    $menuObject = wp_get_nav_menu_object($menuID);
    $menuItems = wp_get_nav_menu_items($menuObject->slug);

    return $menuItems;
}

// Generate a given menu position HTML
function generateMenuHTML($menuSlug)
{
    global $post;
    $menuHTML = "";
    $menuItems = getMenuItemsByLocation($menuSlug);
    //print_r($menuItems);
    if (is_array($menuItems)) {
        // Loop and echo the menu items
        foreach ($menuItems as $key => $menuItem) {
            $menuLinkClass = (is_array($menuItem->classes)) ? implode(" ", $menuItem->classes) : $menuItem->classes;
            $menuItemClass = (get_permalink() == $menuItem->url) ? ' active' : '';
            $menuTarget = !empty($menuItem->target) ? ' target="' . esc_attr($menuItem->target) . '"' : '';
            // Blog Menu Item Exception Fix
            if ($menuItemClass == '' && $post->post_type == "post" && (is_home() || is_single()) && $menuItem->url == get_permalink(get_option('page_for_posts'))) {
                $menuItemClass = ' active';
            }
            $menuHTML .= '<li class="nav-item ' . $menuLinkClass . '">';
            $menuHTML .= '<a href="' . $menuItem->url . '" class="nav-link h4' . $menuItemClass . '" ' . $menuTarget . ' title="' . $menuItem->title . '">' . $menuItem->title . '</a>';
            $menuHTML .= '</li>';
        }
    }

    return $menuHTML;
}



function header_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'header_menu');
function footer_menu()
{
    register_nav_menu('footer-menu', __('Footer Menu'));
}

add_action('init', 'footer_menu');
function add_classes_on_li($classes, $item, $args)
{
    $classes[] = 'menu_list_item';

    return $classes;
}

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);




add_filter('body_class', 'er_logged_in_filter');
function er_logged_in_filter($classes)
{
    if (is_user_logged_in()) {
        $classes[] = 'logged-in';
    }
    // return the $classes array
    return $classes;
}


//get domain by passing url
function getDomain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return FALSE;
}

//Disable post format meta box
add_action('init', 'remove_post_format');

function remove_post_format()
{
    remove_theme_support('post-formats');
}



//Full Width Slideshow image size
add_image_size('full-slide-thumb', 1116, 626, true); // Hard Crop Mode

add_image_size('testimonial-image', 502, 502, true);

add_image_size('testimonial-image-thumb', 102, 102, true);

add_image_size('hero-slider', 1440, 654, true);

add_image_size('hero-slider-125-gold', 1440, 654, true);

add_image_size('hero-slider-125-normal', 1440, 811, true);

add_image_size('person-image-directory', 160, 200, true);

add_image_size('featured-event-thumb-mobile', 375, 310, true);

add_image_size('featured-event-thumb-desktop', 870, 531, true);

add_image_size('featured-news-thumb-mobile', 375, 311, true);

add_image_size('featured-news-thumb-desktop', 720, 599, true);

add_image_size('person-grid', 480, 285, true);

add_image_size('news-grid-left', 935, 700, true);

add_image_size('news-grid-right', 440, 275, true);

add_image_size('categories-thumb', 275, 275, true);

add_image_size('news-post-thumb', 440, 440, true);

// /**
//  * Registers an editor stylesheet for the theme.
//  */
function wpdocs_theme_add_editor_styles()
{
    add_editor_style('/dist/css/theme-main.css');
    add_editor_style('/dist/css/wysiwyg.css');
}
add_action('admin_init', 'wpdocs_theme_add_editor_styles');

/**
 * Sets custom post type as Homepage
 */

function populate_in_dropdown($pages)
{
    $args = array(
        'post_type' => 'homepage'
    );
    $items = get_posts($args);
    $pages = array_merge($pages, $items);

    return $pages;
}
add_filter('get_pages', 'populate_in_dropdown');

function fix_permalink($query)
{
    if ('' == $query->query_vars['post_type'] && 0 != $query->query_vars['page_id'])
        $query->query_vars['post_type'] = array('page', 'homepage');
}
add_action('pre_get_posts', 'fix_permalink');

// Add class using wysiwyg

function wpb_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');



/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats($init_array)
{

    // Define the style_formats array

    $style_formats = array(
        /*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(
            'title' => 'CTA Button',
            'block' => 'div',
            'classes' => 'cta-button',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');





//Bredcrumb for directory page
function get_breadcrumb()
{
    echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo " &nbsp;&nbsp;/&nbsp;&nbsp; ";
            the_title();
        }
    } elseif (is_page()) {
        //echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}


//Register Custom Post Type person

function cptui_register_my_cpts_person()
{

    /**
     * Post Type: Persons.
     */

    $labels = [
        "name" => __("Persons", "Palmer CustomDomain"),
        "singular_name" => __("Person", "Palmer CustomDomain"),
        "menu_name" => __("Persons", "Palmer CustomDomain"),
        "all_items" => __("All Persons", "Palmer CustomDomain"),
        "add_new" => __("Add New Person", "Palmer CustomDomain"),
        "add_new_item" => __("Add New Person", "Palmer CustomDomain"),
        "edit_item" => __("Edit Person", "Palmer CustomDomain"),
        "new_item" => __("New Person", "Palmer CustomDomain"),
        "view_item" => __("View Person", "Palmer CustomDomain"),
        "view_items" => __("View Persons", "Palmer CustomDomain"),
        "search_items" => __("Search Persons", "Palmer CustomDomain"),
        "not_found" => __("No Persons found", "Palmer CustomDomain"),
        "not_found_in_trash" => __("No Persons found in trash", "Palmer CustomDomain"),
        "parent" => __("Parent Person:", "Palmer CustomDomain"),
        "featured_image" => __("Profile Photo for this Person", "Palmer CustomDomain"),
        "set_featured_image" => __("Set Profile Photo for this Person", "Palmer CustomDomain"),
        "remove_featured_image" => __("Remove Profile Photo for this Person", "Palmer CustomDomain"),
        "use_featured_image" => __("Use as Profile Photo for this Person", "Palmer CustomDomain"),
        "archives" => __("Person archives", "Palmer CustomDomain"),
        "insert_into_item" => __("Insert into Person", "Palmer CustomDomain"),
        "uploaded_to_this_item" => __("Upload to this Person", "Palmer CustomDomain"),
        "filter_items_list" => __("Filter Persons list", "Palmer CustomDomain"),
        "items_list_navigation" => __("Persons list navigation", "Palmer CustomDomain"),
        "items_list" => __("Persons list", "Palmer CustomDomain"),
        "attributes" => __("Persons attributes", "Palmer CustomDomain"),
        "name_admin_bar" => __("Person", "Palmer CustomDomain"),
        "item_published" => __("Person published", "Palmer CustomDomain"),
        "item_published_privately" => __("Person published privately.", "Palmer CustomDomain"),
        "item_reverted_to_draft" => __("Person reverted to draft.", "Palmer CustomDomain"),
        "item_scheduled" => __("Person scheduled", "Palmer CustomDomain"),
        "item_updated" => __("Person updated.", "Palmer CustomDomain"),
        "parent_item_colon" => __("Parent Person:", "Palmer CustomDomain"),
    ];

    $args = [
        "label" => __("Persons", "Palmer CustomDomain"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "person", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "thumbnail", "custom-fields", "revisions"],
        "taxonomies" => ["campus"],
        "show_in_graphql" => false,
    ];

    register_post_type("person", $args);
}

add_action('init', 'cptui_register_my_cpts_person');

function cptui_register_my_cpts_chiropractor() {

    /**
     * Post Type: Find a Chiropractor Listings.
     */

    $labels = [
        "name" => __( "Find a Chiropractor Listings", "Palmer CustomDomain" ),
        "singular_name" => __( "Find a Chiropractor Listing", "Palmer CustomDomain" ),
        "menu_name" => __( "Find a Chiropractor", "Palmer CustomDomain" ),
        "all_items" => __( "All Find a Chiropractor Listings", "Palmer CustomDomain" ),
        "add_new" => __( "Add New Chiropractor Listing", "Palmer CustomDomain" ),
        "add_new_item" => __( "Add New Chiropractor Listing", "Palmer CustomDomain" ),
        "edit_item" => __( "Add Chiropractor Listing", "Palmer CustomDomain" ),
        "new_item" => __( "New Chiropractor Listing", "Palmer CustomDomain" ),
        "view_item" => __( "View Chiropractor Listing", "Palmer CustomDomain" ),
        "view_items" => __( "View Chiropractor Listings", "Palmer CustomDomain" ),
    ];

    $args = [
        "label" => __( "Find a Chiropractor Listings", "Palmer CustomDomain" ),
        "labels" => $labels,
        "description" => "This post contains all the ",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "chiropractor", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "chiropractor", $args );
}

add_action( 'init', 'cptui_register_my_cpts_chiropractor' );

function cptui_register_my_taxes_chiro_techniques() {

    /**
     * Taxonomy: Chiropractor Techniques.
     */

    $labels = [
        "name" => __( "Chiropractor Techniques", "Palmer CustomDomain" ),
        "singular_name" => __( "Chiropractor Technique", "Palmer CustomDomain" ),
    ];


    $args = [
        "label" => __( "Chiropractor Techniques", "Palmer CustomDomain" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'chiro_techniques', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "chiro_techniques",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "chiro_techniques", [ "chiropractor" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_chiro_techniques' );

//Google maps api
function my_acf_google_map_api( $api ){
    $api['key'] = get_option('wpgmza_google_maps_api_key');
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


//gravity forms submit button change html
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}


function get_domain($url)
    {
      $pieces = parse_url($url);
      $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
      if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

add_action('admin_head', 'event_timezone_select_list');

function event_timezone_select_list() {
    echo '<style>
      select#_timezone optgroup, select#_timezone optgroup option {
      display: none;
      }
      select#_timezone optgroup[label="America"],
      select#_timezone optgroup[label="America"] option[value="America/Anchorage"],
      select#_timezone optgroup[label="America"] option[value="America/Boise"],
      select#_timezone optgroup[label="America"] option[value="America/Chicago"],
      select#_timezone optgroup[label="America"] option[value="America/Los_Angeles"],
      select#_timezone optgroup[label="America"] option[value="America/New_York"],
      select#_timezone optgroup[label="America"] option[value="America/Puerto_Rico"],
      select#_timezone optgroup[label="Pacific"],
      select#_timezone optgroup[label="Pacific"] option[value="Pacific/Honolulu"] {
      display: block;
      }
      .post-type-event_listing #tagsdiv-campus ul li a.tag-link-40 {
      display: none;
      }
  </style>';
}
