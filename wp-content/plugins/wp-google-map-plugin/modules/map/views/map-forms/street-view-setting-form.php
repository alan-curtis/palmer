<?php
/**
 * Contro Positioning over google maps.
 * @package Maps
 * @author Flipper Code <hello@flippercode.com>
 */

$form->add_element( 'group', 'map_street_view_setting', array(
	'value' => esc_html__( 'Street View Settings', 'wp-google-map-plugin' ),
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));

$form->add_element( 'checkbox', 'map_street_view_setting[street_control]', array(
	'lable' => esc_html__( 'Turn On Street View', 'wp-google-map-plugin' ),
	'value' => 'true',
	'id' => 'wpgmp_street_control',
	'current' => (isset($_POST['map_street_view_setting']['street_control'])) ? sanitize_text_field($_POST['map_street_view_setting']['street_control']) : '',
	'desc' => esc_html__( 'Please check to enable street view', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class switch_onoff',
	'data' => array( 'target' => '.street_view_setting' ),
));

$form->add_element( 'checkbox', 'map_street_view_setting[street_view_close_button]', array(
	'lable' => esc_html__( 'Turn On Close Button', 'wp-google-map-plugin' ),
	'value' => 'true',
	'id' => 'wpgmp_street_view_close_button',
	'current' => ( isset($_POST['map_street_view_setting']['street_view_close_button']) ) ? sanitize_text_field($_POST['map_street_view_setting']['street_view_close_button']) : '',
	'desc' => esc_html__( 'Please check to turn on close button.', 'wp-google-map-plugin' ),
	'data' => array( 'target' => '#geo_tags_table,#geo_tags_message' ),
	'class' => 'street_view_setting',
	'show' => 'false',
));

$form->add_element( 'checkbox', 'map_street_view_setting[links_control]', array(
	'lable' => esc_html__( 'Turn Off links Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'wpgmp_links_control',
	'current' => (isset($_POST['map_street_view_setting']['links_control'])) ? sanitize_text_field($_POST['map_street_view_setting']['links_control']) : '',
	'desc' => esc_html__( 'Please check to disable links control.', 'wp-google-map-plugin' ),
	'data' => array( 'target' => '#geo_tags_table,#geo_tags_message' ),
	'class' => 'street_view_setting',
	'show' => 'false',
));

$form->add_element( 'checkbox', 'map_street_view_setting[street_view_pan_control]', array(
	'lable' => esc_html__( 'Turn Off Street View Pan Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'wpgmp_street_view_pan_control',
	'current' => (isset($_POST['map_street_view_setting']['street_view_pan_control'])) ? sanitize_text_field($_POST['map_street_view_setting']['street_view_pan_control']) : '',
	'desc' => esc_html__( 'Please check to disable Street View Pan control.', 'wp-google-map-plugin' ),
	'data' => array( 'target' => '#geo_tags_table,#geo_tags_message' ),
	'class' => 'street_view_setting',
	'show' => 'false',
));

$form->add_element( 'text', 'map_street_view_setting[pov_heading]', array(
	'lable' => esc_html__( 'POV Heading', 'wp-google-map-plugin' ),
	'value' => (isset($_POST['map_street_view_setting']['pov_heading'])) ? sanitize_text_field($_POST['map_street_view_setting']['pov_heading']) : '',
	'id' => 'pov_heading',
	'desc' => esc_html__( 'Please enter numeric integer value for POV heading.', 'wp-google-map-plugin' ),
	'class' => 'form-control street_view_setting',
	'show' => 'false',
));

$form->add_element( 'text', 'map_street_view_setting[pov_pitch]', array(
	'lable' => esc_html__( 'POV Pitch', 'wp-google-map-plugin' ),
	'value' => ( isset($_POST['map_street_view_setting']['pov_pitch']) ) ? sanitize_text_field($_POST['map_street_view_setting']['pov_pitch']) : '',
	'id' => 'pov_heading',
	'desc' => esc_html__( 'Please enter numeric integer value for POV Pitch.', 'wp-google-map-plugin' ),
	'class' => 'form-control street_view_setting',
	'show' => 'false',
));

$form->add_element(
	'group',
	'route_direction_settings',
	array(
		'value'  => esc_html__('Route Direction Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'marker_cluster_settings',
	array(
		'value'  => esc_html__('Marker Cluster Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'overlay_settings',
	array(
		'value'  => esc_html__('Overlays Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'tabs_settings',
	array(
		'value'  => esc_html__('Tabs Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'custom_filters',
	array(
		'value'  => esc_html__('Custom Filters', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'advanced_filter_functionality',
	array(
		'value'  => esc_html__('Advanced Filter Functionality', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'listing_settings',
	array(
		'value'  => esc_html__('Listing Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'listing_item_skin',
	array(
		'value'  => esc_html__('Listing Item Skin', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'map_filter_setting',
	array(
		'value'  => esc_html__('Map Filter Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'geo_json_setting',
	array(
		'value'  => esc_html__('Geo Json Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'map_theme_setting',
	array(
		'value'  => esc_html__('Map Theme Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'url_filter_setting',
	array(
		'value'  => esc_html__('URL Filters Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);

$form->add_element(
	'group',
	'import_setting',
	array(
		'value'  => esc_html__('Import Settings', 'wpgmp-google-map'),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
		'parent_class'		=> 'fc-locked',
	)
);