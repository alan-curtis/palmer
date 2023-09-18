<?php

//scripts for  event page
function event_ajax_filter_scripts()
{
    wp_enqueue_script('event_ajax_moment', get_stylesheet_directory_uri() . '/dist/js/moment.min.js', array(), '1.0', true);
    wp_enqueue_script('event_ajax_datepicker', get_stylesheet_directory_uri() . '/dist/js/daterangepicker.min.js', array(), '1.0', true);
    wp_enqueue_script('event_ajax_filter', get_stylesheet_directory_uri() . '/dist/js/events-ajax.js', array('event_ajax_moment', 'event_ajax_datepicker'), '1.0', true);
    wp_enqueue_style('event_ajax_filter_css', get_stylesheet_directory_uri() . '/dist/css/daterangepicker.css');
    wp_localize_script('event_ajax_filter', 'ajax_url', admin_url('admin-ajax.php'));
}

//Ajax init for event template
add_action('wp_ajax_event_ajax_filter', 'event_ajax_filter_callback');
add_action('wp_ajax_nopriv_event_ajax_filter', 'event_ajax_filter_callback');

//ajax callback function
function event_ajax_filter_callback()
{
    $data =  $_POST['data'];
    //print_r($_POST);
    //exit;
    //get all values from data variable sent by the ajax call
    $event_type = $data['event_type'];
    $event_audience = $data['event_audience'];
    $event_campus = $data['event_campus'];
    $event_end_date = $data['end_date'];
    $event_start = $data['start_date'];

     //get all events
     $numb_item = 7;
     $page_number = $data['page_number'];
     $offset = ($page_number - 1) * 7 ;

     // print_r($offset);
     $event_data['offset'] = $offset;

     //echo $offset;
     $args = array(
        'post_type' => 'event_listing',
        'offset' => $offset,
        'post_status' => 'publish',
        'orderby' => 'meta_value date',
        'meta_key' => '_event_start_date',
        'posts_per_page' => $numb_item,
        'order' => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_event_start_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATETIME'
            ),
            array(
                'key' => '_event_end_date',
                'value' => $event_end_date,
                'compare' => '<=',
                'type' => 'DATETIME'
            )
        )
    );
    $args['tax_query']['relation'] = 'AND';
    if ($event_type != '') {
        $args['tax_query'][] = array(
            'taxonomy' => 'event_listing_type',
            'field' => 'slug',
            'terms' => $event_type,
            'include_children' => FALSE,
            'operator' => 'IN'
        );
    }

    if ($event_audience != "all_active") {
        $args['tax_query'][] = array(
            'taxonomy' => 'event_audience',
            'field' => 'slug',
            'terms' => $event_audience,
            'include_children' => FALSE,
            'operator' => 'IN'
        );
    }


    if ($event_campus != "all_active") {
        $args['tax_query'][] = array(
            'taxonomy' => 'campus',
            'field' => 'slug',
            'terms' => $event_campus,
            'include_children' => FALSE,
            'operator' => 'IN',
        );
    }

    $events = new WP_Query($args);

    if ($events->have_posts()) {
        $event_data = array();
        $tt_event = $events->found_posts;
        while ($events->have_posts()) {
            $events->the_post();
            //return all data as json
            $event_id = get_the_ID();
            $event_title = get_the_title();
            $event_start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
            $event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
            $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
            $event_end_time = get_post_meta(get_the_ID(), '_event_end_time', true);
            $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            $event_address = get_post_meta(get_the_ID(), '_event_address', true);
            $event_city = get_post_meta(get_the_ID(), '_event_city', true);
            $event_state = get_post_meta(get_the_ID(), '_event_state', true);
            $event_zip = get_post_meta(get_the_ID(), '_event_zip', true);
            $event_cost = get_post_meta(get_the_ID(), '_event_cost', true);
            $event_cost_description = get_post_meta(get_the_ID(), '_event_cost_description', true);
            $event_description = get_post_meta(get_the_ID(), '_event_description', true);
            $event_registration_link = get_post_meta(get_the_ID(), '_event_registration_link', true);
            $event_registration_link_text = get_post_meta(get_the_ID(), '_event_registration_link_text', true);
            $event_registration_link_text = ($event_registration_link_text == '') ? 'Register' : $event_registration_link_text;
            $event_registration_link_text = ($event_registration_link == ''
                || $event_registration_link == 'http://') ? 'Register' : $event_registration_link_text;
            $event_registration_link = ($event_registration_link == ''

                || $event_registration_link == 'http://') ? '#' : $event_registration_link;
            $event_registration_link_target = get_post_meta(get_the_ID(), '_event_registration_link_target', true);

            $campuses=get_the_terms(get_the_ID(),'campus');
            foreach($campuses as $campus){
            $campus_name=$campus->name;
            }
            $event_types=get_the_terms(get_the_ID(),'event_listing_type');
            foreach($event_types as $type){
            //print_r($type);
            $type_link = get_term_link($type->slug, 'event_listing_type');
            $type=$type->name;
            //$type_link=get_term_link($type);
            //print_r($type_link);
            }

            $timezone = get_post_meta(get_the_ID(), '_timezone');
            switch ($timezone[0]) {
                case "America/Anchorage":
                    $timezone = '(AKT)';
                    break;
                case "America/Boise":
                    $timezone = '(MT)';
                    break;
                case "America/Chicago":
                    $timezone = '(CT)';
                    break;
                case "America/Los_Angeles":
                    $timezone = '(PT)';
                    break;
                case "America/New_York":
                    $timezone = '(ET)';
                    break;
                case "Pacific/Honolulu":
                    $timezone = '(HT)';
                    break;
                case "America/Puerto_Rico":
                    $timezone = '(AST)';
                    break;
            }


            $amorpm_of_starttime=date("a", strtotime($event_start_time));
            $start_time_event=date("g:i", strtotime($event_start_time)).' '.trim( chunk_split($amorpm_of_starttime, 1, '.') );
            $amorpm_of_endtime=date("a", strtotime($event_end_time));
            $end_time_event=date("g:i", strtotime($event_end_time)).' '.trim( chunk_split($amorpm_of_endtime, 1, '.') );

            $event_data[] = array(
            'event_id' => $event_id,
            'event_title' => $event_title,
            'event_start_date' => $event_start_date,
            'event_start_month' => date('M',strtotime($event_start_date)) ,
            'event_start_day' => date('d',strtotime($event_start_date)) ,
            'event_end_date' => $event_end_date,
            'event_end_month' => date('M',strtotime($event_end_date)) ,
            'event_end_day' => date('d',strtotime($event_end_date)) ,
            'event_start_time' => $start_time_event,
            'event_end_time' => $end_time_event,
            'event_location' => $event_location,
            'event_address' => $event_address,
            'event_city' => $event_city,
            'event_state' => $event_state,
            'event_zip' => $event_zip,
            'event_cost' => $event_cost,
            'event_cost_description' => $event_cost_description,
            'event_description' => $event_description,
            'event_registration_link' => $event_registration_link,
            'event_registration_link_text' => $event_registration_link_text,
            'event_registration_link_target' => $event_registration_link_target,
            'campus' => $campus_name,
            'type' => $type,
            'type_link' => $type_link,
            'total_events' => $tt_event,
            'post_link' => get_the_permalink(get_the_ID()),
            'timezone' => $timezone,
        );


        }
         // $event_data['total_events'] = $tt_event;


        wp_reset_query();
        echo json_encode($event_data);

    } else {
        echo json_encode('no_result');
    }

    wp_die();
}
