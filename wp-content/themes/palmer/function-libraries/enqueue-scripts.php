<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

if ( ! function_exists( 'wpcustomtheme_scripts' ) ) :
	function wpcustomtheme_scripts() {
		global $post;
		$owl_crasoul_enable = get_field('enable_quick_move_ins', $post->ID);
	//	$build_with_elementor = \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);

		// Enqueue the main Stylesheet.
		if (!is_front_page() || $owl_crasoul_enable){
		//	wp_enqueue_style( 'owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
		}
		// wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/stylesheets/jquery.fancybox.3.5.6.min.css' );
		// wp_enqueue_style( 'main-stylesheet', get_template_directory_uri() . '/assets/stylesheets/foundation.min.css', array(), '2.7.201', 'all' );
		// wp_enqueue_style( 'temporary-stylesheet', get_template_directory_uri() . '/assets/stylesheets/temporary.min.css', array(), '1.0.04', 'all' );
		wp_enqueue_style( 'popup-stylesheet', get_template_directory_uri() . '/dist/css/video.popup.css', array(), '1.0.04', 'all' );


		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script( 'jquery' );

		wp_enqueue_script('add-to-calender-free', get_template_directory_uri() . '/dist/js/add-to-calendar.js');

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.

		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', false, '2.1.7' );

		wp_enqueue_script( 'jquery' );

		// If is the Smart Guide or  QMI, Floorplan, Communities page, or Model search pages
		if ( is_page_template( 'page-templates/page-floorplan-search.php' ) || is_page( 5314 ) || is_page( 5283 ) || is_page( 20371 ) || is_page( 20373 ) || is_page( 20275 ) ) {
			wp_enqueue_script( 'jquery-form' );
		}

		// If you'd like to cherry-pick the foundation components you need in your project, head over to gulpfile.js and see lines 35-54.
		// It's a good idea to do this, performance-wise. No need to load everything if you're just going to use the grid anyway, you know :)
		if (!is_front_page() || $owl_crasoul_enable){
			wp_enqueue_script( 'owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		}
		wp_enqueue_script( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js', array( 'jquery' ), '3.5.6', true );
		wp_enqueue_script( 'scrollreveal', 'https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js', array( 'jquery' ), '4.0.0', true );
		// wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/javascript/foundation.js', array( 'jquery' ), '2.6.71', true );
        wp_enqueue_script( 'videopopup', get_template_directory_uri() . '/dist/js/video.popup.js', array( 'jquery' ), '2.6.71', true );
        
        //
        wp_enqueue_script('map_events_listing', get_stylesheet_directory_uri() . '/dist/js/map-events-listing.js');
        wp_enqueue_script('institutions_listing', get_stylesheet_directory_uri() . '/dist/js/institutions-listing.js');
                 
        wp_enqueue_script('palmer-jquerycookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js');

		wp_localize_script( 'foundation', 'wpVar', array( 'srcPath' => get_bloginfo( 'stylesheet_directory' ) ) );
		wp_localize_script( 'foundation', 'ro_ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

		//Events map page ajax
		wp_localize_script( 'map_events_listing', 'ajaxscript', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		//Institutions map ajax
		wp_localize_script( 'institutions_listing', 'ajaxscript', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/javascript/custom/custom.js', '', '', true );

		if ( is_front_page() && is_home() ) {
			// Default homepage
		} elseif ( is_front_page() ) {
			// static homepage
		} elseif ( is_home() || is_page_template( 'page-templates/page-event.php' ) ) {
			wp_enqueue_script( 'ro_custom', get_template_directory_uri() . '/assets/javascript/additional-custom.js', array( 'jquery' ), '1.0.0', true );
			wp_localize_script( 'ro_custom', 'ro_event_ajax',
				array(
					'api_nonce' => wp_create_nonce( 'wp_rest' ),
					'api_url'   => site_url('/wp-json/ro/v1/')
				)
			);
		}

		// Remove elementor.
//		if(is_front_page() || !$build_with_elementor){
//			// Remove elementor icons css
//			wp_dequeue_style('elementor-icons');
//			wp_deregister_style('elementor-icons');
//			// Remove elementor animations css
//			wp_dequeue_style('elementor-animations');
//			wp_deregister_style('elementor-animations');
//			// Remove elementor frontend lagacy css
//			wp_dequeue_style('elementor-frontend-legacy');
//			wp_deregister_style('elementor-frontend-legacy');
//			// Remove elementor frontend css
//			wp_dequeue_style('elementor-frontend');
//			wp_deregister_style('elementor-frontend');
//			// Remove elementor global css
//			wp_dequeue_style('elementor-global');
//			wp_deregister_style('elementor-global');
//			// Remove elementor
//			wp_dequeue_style('elementor-post-41133');
//			wp_deregister_style('elementor-post-41133');
//		}
	}

	add_action( 'wp_enqueue_scripts', 'wpcustomtheme_scripts', 100 );

	
endif;
