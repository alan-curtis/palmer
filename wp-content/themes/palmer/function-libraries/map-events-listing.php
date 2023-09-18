<?php 

add_action('wp_ajax_map_events_listing', 'map_events_listing');
add_action('wp_ajax_nopriv_map_events_listing', 'map_events_listing');


//ajax callback function
function map_events_listing()
{

   //echo json_encode($_POST);
   //echo json_encode('results show');
  // $data=$_POST['data'];
    $location=$_POST['data']['location'];
    
   //print_r(json_decode($data));
   //exit;
  // $metaData=get_post_meta(get_the_ID());
   $current_date = date('ymd'); // or your date as well
                            // $your_date = strtotime($metaData['_event_start_date'][0]);
                            // $datediff =  $your_date - $now;

                            // if(round($datediff / (60 * 60 * 24)) >= 0){}

   $args = array(
        'post_type' => 'event_listing',      
        'post_status' => 'publish',
        'posts_per_page' => -1,
         'relation'      => 'AND',
         'orderby'           => 'meta_value',
         'order'             => 'ASC',
         'meta_query'        => array (
        
        array(
            'key'       => '_event_start_date',
            'value'     => $current_date,
            'compare'   => '>=',
            'type'      => 'DATE'
            ),
       
        )
         


        ); 

   


   if(!empty($_POST['data']['events'])){
        $events=$_POST['data']['events'];
        $event_ids=explode(',',$events);

        $args['post__in'] =  $event_ids;
    }


    $events = new WP_Query($args);

    if ($events->have_posts()) {
        $event_data = array();
        $tt_event = $events->found_posts;

        while ($events->have_posts()) {
            // $metaData=get_post_meta(get_the_ID());
            //   $now = time(); // or your date as well
            //                 $your_date = strtotime($metaData['_event_start_date'][0]);
            //                 $datediff =  $your_date - $now;

            //                 if(round($datediff / (60 * 60 * 24)) >= 0){
                            
                             
                              
            //                 }      
      

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

            if(!empty($campuses)){
                foreach($campuses as $campus){
                $campus_name=$campus->name;
                }
            }
            else{
                $campus_name='';
            }


            $event_types=get_the_terms(get_the_ID(),'event_listing_type');
            if(!empty($event_types)){
                foreach($event_types as $type){
                //print_r($type);
                $type_link = get_term_link($type->slug, 'event_listing_type');  
                $type=$type->name;   
                //$type_link=get_term_link($type);
                //print_r($type_link);
                }
            }
            else{
                  $type_link=''; 
                  $type=''; 
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

 ?>