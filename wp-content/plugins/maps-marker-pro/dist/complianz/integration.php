<?php
if (!defined('ABSPATH')) {
	die;
}

add_filter('cmplz_known_script_tags', function ($tags) {
	if (wp_script_is('mmp-googlemaps', 'enqueued')) {
		$tags[] = 'maps.googleapis.com/maps/api/js';
	}
	$tags[] = 'MapsMarkerPro.init';

	return $tags;
});

add_filter('cmplz_dependencies', function ($tags) {
	if (wp_script_is('mmp-googlemaps', 'enqueued')) {
		$tags['maps.googleapis.com/maps/api/js'] = 'MapsMarkerPro.init';
	}

	return $tags;
});

add_filter('cmplz_placeholder_markers', function ($tags) {
	$tags['openstreetmaps'][] = 'maps-marker-pro';

	return $tags;
});

add_action('wp_enqueue_scripts', function () {
	wp_add_inline_style('mapsmarkerpro', '.maps-marker-pro.cmplz-blocked-content-container>div{display:none}');
});
