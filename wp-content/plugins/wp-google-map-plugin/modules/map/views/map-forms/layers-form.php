<?php

/**
 * Contro Positioning over google maps.
 * @package Maps
 * @author Flipper Code <hello@flippercode.com>
 */

$form->add_element('group', 'map_control_settings', array(
	'value' => esc_html__('Infowindow Settings', 'wp-google-map-plugin'),
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));
$url = admin_url('admin.php?page=wpgmp_how_overview');
$link =  esc_html__('Enter placeholders {marker_title},{marker_address},{marker_message},{marker_latitude},{marker_longitude}.', 'wp-google-map-plugin');


$default_value = '';

$default_value = (isset($_POST['map_all_control']['infowindow_setting']) && '' != $_POST['map_all_control']['infowindow_setting']) ? sanitize_text_field($_POST['map_all_control']['infowindow_setting']) : $default_value;

$form->add_element('textarea', 'map_all_control[infowindow_setting]', array(
	'lable' => esc_html__('Infowindow Message', 'wp-google-map-plugin'),
	'value' => (isset($_POST['map_all_control']['infowindow_setting'])) ? wp_kses_post($_POST['map_all_control']['infowindow_setting']) : '',
	'desc' => $link,
	'textarea_rows' => 10,
	'textarea_name' => 'location_messages',
	'class' => 'form-control',
	'id' => 'googlemap_infomessage',
	'default_value' => $default_value,
));

if (isset($_POST) && isset($_POST['map_all_control']) && isset($_POST['map_all_control']['infowindow_openoption']) && 'mouseclick' == $_POST['map_all_control']['infowindow_openoption']) {
	$_POST['map_all_control']['infowindow_openoption'] = 'click';
} else if (isset($_POST) && isset($_POST['map_all_control']) && isset($_POST['map_all_control']['infowindow_openoption']) && 'mousehover' == $_POST['map_all_control']['infowindow_openoption']) {
	$_POST['map_all_control']['infowindow_openoption'] = 'mouseover';
}

$event = array('click' => esc_html__('Mouse Click', 'wp-google-map-plugin'), 'mouseover' => esc_html__('Mouse Hover', 'wp-google-map-plugin'));
$form->add_element('select', 'map_all_control[infowindow_openoption]', array(
	'lable' => esc_html__('Show Infowindow on', 'wp-google-map-plugin'),
	'current' => (isset($_POST['map_all_control']['infowindow_openoption'])) ? sanitize_text_field($_POST['map_all_control']['infowindow_openoption']) : '',
	'desc' => esc_html__('Open infowindow on Mouse Click or Mouse Hover.', 'wp-google-map-plugin'),
	'options' => $event,
));

$form->add_element('image_picker', 'map_all_control[marker_default_icon]', array(
	'lable' => esc_html__('Choose Marker Image', 'wp-google-map-plugin'),
	'src' => (isset($_POST['map_all_control']['marker_default_icon'])  ? wp_unslash($_POST['map_all_control']['marker_default_icon']) : WPGMP_IMAGES . '/default_marker.png'),
	'required' => false,
	'choose_button' => esc_html__('Choose', 'wp-google-map-plugin'),
	'remove_button' => esc_html__('Remove', 'wp-google-map-plugin'),
	'id' => 'marker_category_icon',
));

$form->add_element('checkbox', 'map_all_control[infowindow_open]', array(
	'lable' => esc_html__('InfoWindow Open', 'wp-google-map-plugin'),
	'value' => 'true',
	'id' => 'wpgmp_infowindow_open',
	'current' => (isset($_POST['map_all_control']['infowindow_open'])) ? sanitize_text_field($_POST['map_all_control']['infowindow_open']) : '',
	'desc' => esc_html__('Please check to enable infowindow default open.', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));

$form->add_element('checkbox', 'map_all_control[infowindow_close]', array(
	'lable' => esc_html__('Close InfoWindow', 'wp-google-map-plugin'),
	'value' => 'true',
	'id' => 'wpgmp_infowindow_close',
	'current' => (isset($_POST['map_all_control']['infowindow_close'])) ? sanitize_text_field($_POST['map_all_control']['infowindow_close']) : '',
	'desc' => esc_html__('Please check to close infowindow on map click.', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));

$event = array('' => esc_html__('Select Animation', 'wp-google-map-plugin'), 'click' => esc_html__('Mouse Click', 'wp-google-map-plugin'), 'mouseover' => esc_html__('Mouse Hover', 'wp-google-map-plugin'));
$form->add_element('select', 'map_all_control[infowindow_bounce_animation]', array(
	'lable' => esc_html__('Bounce Animation', 'wp-google-map-plugin'),
	'current' => (isset($_POST['map_all_control']['infowindow_bounce_animation'])) ? sanitize_text_field($_POST['map_all_control']['infowindow_bounce_animation']) : '',
	'desc' => esc_html__('Apply bounce animation on mousehover or mouse click. BOUNCE indicates that the marker should bounce in place.', 'wp-google-map-plugin'),
	'options' => $event,
));

$form->add_element('checkbox', 'map_all_control[infowindow_drop_animation]', array(
	'lable' => esc_html__('Apply Drop Animation', 'wp-google-map-plugin'),
	'value' => 'true',
	'id' => 'infowindow_drop_animation',
	'current' => (isset($_POST['map_all_control']['infowindow_drop_animation'])) ? sanitize_text_field($_POST['map_all_control']['infowindow_drop_animation']) : '',
	'desc' => esc_html__('DROP indicates that the marker should drop from the top of the map. ', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));

$form->add_element(
	'group',
	'map_infowindow_settings',
	array(
		'value'  => esc_html__('Infowindow Customization Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'map_infowindow_message_settings',
	array(
		'value'  => esc_html__('Infowindow Message for Locations', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);


$form->add_element('group', 'map_control_layers', array(
	'value' => esc_html__('Map Layers Settings', 'wp-google-map-plugin'),
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));

$form->add_element('checkbox', 'map_layer_setting[choose_layer][traffic_layer]', array(
	'lable' => esc_html__('Traffic Layer', 'wp-google-map-plugin'),
	'value' => 'TrafficLayer',
	'id' => 'wpgmp_traffic_layer',
	'current' => (isset($_POST['map_layer_setting']['choose_layer']['traffic_layer'])) ? sanitize_text_field($_POST['map_layer_setting']['choose_layer']['traffic_layer']) : '',
	'desc' => esc_html__('Please check to enable the traffic layer on map.', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));

$form->add_element('checkbox', 'map_layer_setting[choose_layer][transit_layer]', array(
	'lable' => esc_html__('Transit Layer', 'wp-google-map-plugin'),
	'value' => 'TransitLayer',
	'id' => 'wpgmp_transit_layer',
	'current' => (isset($_POST['map_layer_setting']['choose_layer']['transit_layer'])) ? sanitize_text_field($_POST['map_layer_setting']['choose_layer']['transit_layer']) : '',
	'desc' => esc_html__('Please check to enable the transit layer on map.', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));


$form->add_element('checkbox', 'map_layer_setting[choose_layer][bicycling_layer]', array(
	'lable' => esc_html__('Bicycling Layer', 'wp-google-map-plugin'),
	'value' => 'BicyclingLayer',
	'id' => 'wpgmp_bicycling_layer',
	'current' => (isset($_POST['map_layer_setting']['choose_layer']['bicycling_layer'])) ? sanitize_text_field($_POST['map_layer_setting']['choose_layer']['bicycling_layer']) : '',
	'desc' => esc_html__('Please check to enable the bicycling layer on map.', 'wp-google-map-plugin'),
	'class' => 'chkbox_class',
));

$form->add_element(
	'group',
	'map_geotags_settings',
	array(
		'value'  => esc_html__('Show Posts Using Custom Fields', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);
$form->add_element(
	'group',
	'map_acf_settings',
	array(
		'value'  => esc_html__('Show Posts using ACF Plugin', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'map_styles_settings',
	array(
		'value'  => esc_html__('Map Styling Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
	)
);


