<?php wp_enqueue_style('wp-event-manager-jquery-ui-daterangepicker'); ?>
<?php wp_enqueue_style('wp-event-manager-jquery-ui-daterangepicker-style'); ?>
<?php wp_enqueue_script('wp-event-manager-jquery-ui-daterangepicker'); ?>
<?php wp_enqueue_script('wp-event-manager-ajax-filters'); ?>

<?php do_action('event_manager_event_filters_before', $atts); ?>

<form class="wpem-main wpem-form-wrapper wpem-event-filter-wrapper event_filters  from-palmer-theme" id="event_filters">
	<?php do_action('event_manager_event_filters_start', $atts); ?>
	<div class="search_events search-form-container">
		<?php do_action('event_manager_event_filters_search_events_start', $atts); ?>
		<div class="wpem-row">

			<div class="wpem-col-4">

			</div>
			<div class="wpem-col-6">
				<div class="wpem-row">
					<!-- Search by date section start -->
					<?php if ($datetimes) : ?>

						<?php
						$arr_selected_datetime = [];
						if (!empty($selected_datetime)) {
							$selected_datetime = explode(',', $selected_datetime);

							$start_date = esc_attr(strip_tags($selected_datetime[0]));
							$end_date = esc_attr(strip_tags($selected_datetime[1]));



							//get date and time setting defined in admin panel Event listing -> Settings -> Date & Time formatting
							$datepicker_date_format 	= WP_Event_Manager_Date_Time::get_datepicker_format();

							//covert datepicker format  into php date() function date format
							$php_date_format 		= WP_Event_Manager_Date_Time::get_view_date_format_from_datepicker_date_format($datepicker_date_format);

							if ($start_date == 'today') {
								$start_date = date($php_date_format);
							} else if ($start_date == 'tomorrow') {
								$start_date = date($php_date_format, strtotime('+1 day'));
							}

							$arr_selected_datetime['start'] = WP_Event_Manager_Date_Time::date_parse_from_format($php_date_format, $start_date);
							$arr_selected_datetime['end'] = WP_Event_Manager_Date_Time::date_parse_from_format($php_date_format, $end_date);

							$arr_selected_datetime['start'] 	= date_i18n($php_date_format, strtotime($arr_selected_datetime['start']));
							$arr_selected_datetime['end'] 	= date_i18n($php_date_format, strtotime($arr_selected_datetime['end']));

							$selected_datetime = json_encode($arr_selected_datetime);
						}
						?>

						<div class="col">
							<div class="wpem-form-group">
								<label for="search_datetimes" class="wpem-form-label"><?php _e('Filter by Date', 'wp-event-manager'); ?></label>
								<input type="text" name="search_datetimes[]" id="search_datetimes" value='<?php echo $selected_datetime; ?>' class="event-manager-category-dropdown date_range_picker">
							</div>
						</div>
					<?php endif; ?>
					<!-- Search by date section end -->




					<!-- Search by event type section start -->
					<?php if ($event_types) : ?>
						<?php foreach ($event_types as $event_type) : ?>
							<input type="hidden" name="search_event_types[]" value="<?php echo sanitize_title($event_type); ?>" />
						<?php endforeach; ?>
					<?php elseif ($show_event_types && !is_tax('event_listing_type') && get_terms('event_listing_type', ['hide_empty' => false])) : ?>
						<div class="wpem-col">
							<div class="wpem-form-group">
								<label for="search_event_types" class="wpem-form-label"><?php _e('Type of Event', 'wp-event-manager'); ?></label>
								<?php if ($show_event_type_multiselect) : ?>
									<?php event_manager_dropdown_selection(array('value' => 'slug', 'taxonomy' => 'event_listing_type', 'hierarchical' => 1, 'name' => 'search_event_types', 'orderby' => 'name', 'selected' => $selected_event_type, 'hide_empty' => false)); ?>
								<?php else : ?>
									<?php event_manager_dropdown_selection(array('value' => 'slug', 'taxonomy' => 'event_listing_type', 'hierarchical' => 1, 'show_option_all' => __('All types', 'wp-event-manager'), 'name' => 'search_event_types', 'orderby' => 'name', 'selected' => $selected_event_type, 'multiple' => false, 'hide_empty' => false)); ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<!-- Search by event type section end -->

					<!-- Search by any ticket price section start -->
					<?php if ($show_ticket_prices) : ?>

						<?php if ($ticket_prices) : ?>
							<?php foreach ($ticket_prices as $ticket_price) : ?>
								<input type="hidden" name="search_ticket_prices[]" value="<?php echo sanitize_title($ticket_price); ?>" />
							<?php endforeach; ?>

						<?php else : ?>
							<div class="wpem-col">
								<div class="wpem-form-group">
									<label for="search_ticket_prices" class="wpem-form-label"><?php _e('Ticket Prices', 'wp-event-manager'); ?></label>
									<select name="search_ticket_prices[]" id="search_ticket_prices" class="event-manager-category-dropdown" data-placeholder="Choose any ticket price…" data-no_results_text="<?php _e('No results match', 'wp-event-manager'); ?>" data-multiple_text="<?php __('Select Some Options', 'wp-event-manager'); ?>">
										<?php
										$ticket_prices	=	WP_Event_Manager_Filters::get_ticket_prices_filter();
										foreach ($ticket_prices as $key => $value) :
											if (!strcasecmp($selected_ticket_price, $value) || $selected_ticket_price == $key) : ?>
												<option selected=selected value="<?php echo $key != 'ticket_price_any' ? $key : ""; ?>"><?php echo  $value; ?></option>
											<?php else : ?>
												<option value="<?php echo $key != 'ticket_price_any' ? $key : ""; ?>"><?php echo  $value; ?></option>
										<?php endif;
										endforeach; ?>
									</select>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<!-- Search by any ticket price section end -->

					<?php /* ?>	  
			<!-- Search by Online Event start -->  
			<div class="wpem-col">
				<div class="wpem-form-group">
					<label for="event_online" class="wpem-form-label"></label>
					<?php if($event_online) : ?>
						<input type="checkbox" name="event_online" id="event_online" value='1' class="event-manager-filter" checked="checked" > <?php _e( 'Online Event', 'wp-event-manager' ); ?>
					<?php else: ?>
						<input type="checkbox" name="event_online" id="event_online" value='1' class="event-manager-filter" > <?php _e( 'Online Event', 'wp-event-manager' ); ?>
					<?php endif; ?>
					
				</div>
			</div>
			<!-- Search by Online Event end -->
			<?php */ ?>


				</div>

			</div>

		</div> <!-- /row -->
		<!-- /row -->

		<?php do_action('event_manager_event_filters_search_events_end', $atts); ?>

	</div>




	<?php do_action('event_manager_event_filters_end', $atts); ?>
</form>
<?php do_action('event_manager_event_filters_after', $atts); ?>
<noscript><?php _e('Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-event-manager'); ?></noscript>