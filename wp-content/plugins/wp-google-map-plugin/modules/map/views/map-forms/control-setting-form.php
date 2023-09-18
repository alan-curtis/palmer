<?php
/**
 * Control Setting(s).
 * @package Maps
 */

$form->add_element( 'group', 'map_control_setting', array(
	'value' => esc_html__( 'Map Control Settings', 'wp-google-map-plugin' ),
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));

$form->add_element( 'checkbox', 'map_all_control[zoom_control]', array(
	'lable' => esc_html__( 'Turn Off Zoom Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'wpgmp_zoom_control',
	'current' => (isset($_POST['map_all_control']['zoom_control']) ) ? sanitize_text_field($_POST['map_all_control']['zoom_control']) : '',
	'desc' => esc_html__( 'Please check to disable zoom control.', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class',
));


$form->add_element( 'checkbox', 'map_all_control[full_screen_control]', array(
	'lable' => esc_html__( 'Turn Off Full Screen Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'full_screen_control',
	'current' => (isset($_POST['map_all_control']['full_screen_control'])) ? sanitize_text_field($_POST['map_all_control']['full_screen_control']) : '',
	'desc' => esc_html__( 'Please check to disable full screen control.', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class',
));


$form->add_element( 'checkbox', 'map_all_control[map_type_control]', array(
	'lable' => esc_html__( 'Turn Off Map Type Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'map_type_control',
	'current' => (isset($_POST['map_all_control']['map_type_control'])) ? sanitize_text_field($_POST['map_all_control']['map_type_control']) : '',
	'desc' => esc_html__( 'Please check to disable map type control.', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class',
));

$form->add_element( 'checkbox', 'map_all_control[street_view_control]', array(
	'lable' => esc_html__( 'Turn Off Street View Control', 'wp-google-map-plugin' ),
	'value' => 'false',
	'id' => 'wpgmp_street_view_control',
	'current' => (isset($_POST['map_all_control']['street_view_control'])) ? sanitize_text_field($_POST['map_all_control']['street_view_control']) : '',
	'desc' => esc_html__( 'Please check to disable street view control.', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class',
));

$form->add_element( 'checkbox', 'map_all_control[search_control]', array(
	'lable' => esc_html__( 'Turn On Search Control', 'wp-google-map-plugin' ),
	'value' => 'true',
	'id' => 'search_control',
	'current' => (isset($_POST['map_all_control']['search_control'])) ? sanitize_text_field($_POST['map_all_control']['search_control']) : '',
	'desc' => esc_html__( 'Please check to enable search box control.', 'wp-google-map-plugin' ),
	'class' => 'chkbox_class',
));

$form->add_element(
	'group', 'map_styles_settings', array(
		'value'  => esc_html__( 'Map Style Settings', 'wp-google-map-plugin' ),
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
	)
);


$snazzy_link = '<a href="http://snazzymaps.com" target="_blank">  '.esc_html__( 'Snazzy Maps','wp-google-map-plugin').'</a>';
$slink =  sprintf( esc_html__( 'Get free style for your google maps from %s You can copy javascript style array from there and paste here.', 'wp-google-map-plugin' ), $snazzy_link );

$form->add_element(
	'message', 'styles_message', array(
		'value'  => $slink,
		'class'  => 'alert',
		'id'     => 'styles_message',
		'before' => '<div class="fc-12">',
		'after'  => '</div>',
	)
);


$form->add_element(
	'textarea', 'map_all_control[custom_style]', array(
		'label'         => esc_html__( 'Paste Style here', 'wp-google-map-plugin' ),
		'value'         => ( isset( $_POST['map_all_control']['custom_style'] ) && ! empty( $_POST['map_all_control']['custom_style'] ) ) ? sanitize_text_field($_POST['map_all_control']['custom_style']) : '',
		'desc'          => sprintf( esc_html__( 'Copy google map javascript style array from %s paste here.', 'wp-google-map-plugin' ), $snazzy_link ),
		'textarea_rows' => 20,
		'textarea_name' => 'location_messages',
		'class'         => 'form-control',
		'id'            => 'map_custom_style',
		'before'        => '<div class="fc-11">',
		'after'         => '</div>',
	)
);
