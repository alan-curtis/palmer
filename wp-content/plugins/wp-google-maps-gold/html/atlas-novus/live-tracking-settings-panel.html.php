<div class="heading">
	<?php esc_html_e('Live Tracking Settings', 'wp-google-maps'); ?>
</div>

<!-- Helper -->
<div class="general-heading-notice">
	<p>
		<?php esc_html_e('Please use the setting below to control Live Tracking broadcasting.', 'wp-google-maps'); ?>
	</p>

	<p>
		<?php  esc_html_e('Please note this does not affect recording - you can always record your live location and polyline routes, this setting enables visitors to your site to receive your updated location as they view your pages.', 'wp-google-maps'); ?>
	</p>
</div>

<div class="tab-row">
	<div class="title">
		<?php esc_html_e('Enable Broadcasting', 'wp-google-maps'); ?>
	</div>

	<div class='switch'>
		<input name='enable_live_tracking' 
				class='cmn-toggle cmn-toggle-round-flat' 
				type='checkbox' 
				id='enable_live_tracking' 
				value='yes'/>
		
		<label for='enable_live_tracking'></label>
	</div>
</div>

<h3>
	<?php esc_html_e('Live Tracking Devices', 'wp-google-maps'); ?> 
	<i id="wpgmza-refresh-live-tracking-devices" class="fa fa-refresh" aria-hidden="true"></i>
</h3>

<!-- Helper -->
<div class="general-heading-notice">
	<p>
		<?php esc_html_e('Devices which have attempted to pair with your site will appear here. You must approve devices before they will appear on the map.', 'wp-google-maps'); ?>
	</p>
</div>

<div>
	<table id="wpgmza-live-tracking-devices" class="wp-list-table widefat fixed wpgmza-listing">
		<thead>
			<tr>
				<td><?php esc_html_e('Device ID', 'wp-google-maps'); ?></td>
				<td><?php esc_html_e('Name', 'wp-google-maps'); ?></td>
				<td><?php esc_html_e('Draw Polylines', 'wp-google-maps'); ?></td>
				<td><?php esc_html_e('Line Color and Weight', 'wp-google-maps'); ?></td>
				<td><?php esc_html_e('Approved', 'wp-google-maps'); ?></td>
			</tr>
		</thead>
			
		<tbody>
			<tr>
				<td data-name="deviceID"></td>
				<td data-name="name"></td>
				<td>
					<input data-ajax-name="drawPolylines" type="checkbox"/>
				</td>
				<td>
					<input data-ajax-name="polylineColor" type="color"/>
					<input data-ajax-name="polylineWeight" type="number" min="1" max="50"/>
				</td>
				<td>
					<input data-ajax-name="approved" type="checkbox"/>
					
					<input type="hidden" data-ajax-name="id"/>
				</td>
			</tr>
		</tbody>
	</table>
</div>