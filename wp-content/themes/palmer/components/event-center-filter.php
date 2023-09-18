<div class="events-filters" id="events-center-page">
<form method="get">
  <div class="row row-1">
    <div class="col-lg-1"></div>
    <div class="col-lg-4 taxonomy-filters order-1 order-md-0">
      <div class="audience-filter-wrapper">
        <label for="event-audience-filter">Audience</label>
        <ul class="" id="event-audience-filter">
          <?php
          $event_audience = get_terms(array('taxonomy' => 'event_audience'));
          ?>
          <li class="all_active active">All</li>
          <?php
          foreach ($event_audience as $index => $audience) {
          ?>
            <li data-id="<?php echo $audience->term_id  ?>" data-slug="<?php echo $audience->slug ?>"><?php echo $audience->name; ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="col-lg-3 order-3 order-md-0">
      <div class="right-filter-wrapper d-flex">
        <div class="listing-type-filter-wrapper">
          <label for="search_event_types" class="wpem-form-label"><?php _e('Type of Event', 'wp-event-manager'); ?></label>
          <?php event_manager_dropdown_selection(array('value' => 'slug', 'taxonomy' => 'event_listing_type', 'hierarchical' => 1, 'show_option_all' => __('All types', 'wp-event-manager'), 'name' => 'search_event_types', 'orderby' => 'name', 'selected' => $selected_event_type, 'multiple' => false, 'hide_empty' => false)); ?>
        </div>
      </div>

    </div>
    <div class="col-lg-3 order-4 order-md-0">
      <div class="date-range">
          <label>Filter by Date</label>
          <input type="text" name="daterange" value="Jan 1 - Dec 31" aria-label="filter by date" />
        </div>
    </div>
    <div class="col-lg-1"></div>
   </div>

   <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-4 d-none d-md-block">
       <div class="campus-filter-wrapper">
        <label for="event-campus-filter">Campus</label>
        <ul class="nav nav-tabs" id="event-campus-filter">
          <?php
          $event_campus = get_terms(array('taxonomy' => 'campus'));
          ?>
          <li class="all_active active">All</li>
          <?php
          foreach ($event_campus as $index => $campus) {
            $camp_nme = explode(' ',trim($campus->name));
          ?>
            <li data-id="<?php echo $campus->term_id  ?>" data-slug="<?php echo $campus->slug ?>"><?php echo $camp_nme[1]; ?></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-action-wrapper">
        <input type="hidden" value="1" name="pg_number" class="page_input_value">
        <button type="reset" class="btn clear">Clear Filters</button>
        <button type="submit" class="btn search">Filter Events</button>
      </div>
    </div>

      <div class="col-lg-1"></div>
    </div>
   </div>

</form>
</div>
