<?php 

add_action('wp_ajax_institutions_listing', 'institutions_listing');
add_action('wp_ajax_nopriv_institutions_listing', 'institutions_listing');


//ajax callback function
function institutions_listing()
{

   $institution=$_POST['data']['institution'];
   $campus=$_POST['data']['campus'];
   $agreement=$_POST['data']['agreement'];

   $args = array(
        'post_type' => 'institution',      
        'post_status' => 'publish',
        'posts_per_page' => -1,
       'orderby' => 'title',
       'order' => 'ASC',
       'relation' => 'AND',
        ); 

   if(!empty($institution)){

     $args['meta_query'][] =   array(
            'key'       => 'state',
            'value'     => $institution,
            );
       
   }
   
   if(!empty($agreement)){

     $args['meta_query'][] =   array(
            'key'       => 'agreement',
            'value'     => $agreement,
            );
       
   }


   if(!empty($campus)){

     $args['tax_query'][] =   array(
           'taxonomy' => 'campus',
           'field' => 'slug',
           'terms' => $campus,   
            );
       
   }


    $institutions = new WP_Query($args);

    if ($institutions->have_posts()) {
        $institution_data = array();
        $tt_institution = $institutions->found_posts;

        while ($institutions->have_posts()) {

            $institutions->the_post();
            $institution_id = get_the_ID();
            $institution_title = get_the_title();
            
            $campuses=get_the_terms(get_the_ID(),'campus');
            $campus_name = [];
            if(!empty($campuses)){
                foreach($campuses as $campus){
                $campus_name[] = $campus->name;
                }
            }
            else{
                $campus_name='';
            }

            $agreement=get_field('agreement');
            $contact_details=get_field('contact');
            //Get address
            $address_data=get_field('address');
            
            //print_r($address_data);

            $latitude=$address_data['lat'];
            $longitude=$address_data['lng'];
            $full_address=$address_data['address'];
            $address_title=$address_data['name'];

            $institution_data[] = array(
            'institution_id' => $institution_id,
            'institution_title' => $institution_title,
            'campus' => $campus_name,
            'agreement' => $agreement['label'],
            'contact_name' => $contact_details['contact_name'],
            'contact_email' => $contact_details['contact_email'],
            'contact_caption' => $contact_details['contact_caption'],
            'contact_number' => $contact_details['contact_number'],
            'address_title'=> $address_title,
            'full_address'=> $full_address,
            'longitude'=> $longitude,
            'latitude'=> $latitude,
            'street_number'=> $address_data['street_number'],
            'street_name'=> $address_data['street_name'],
            'city'=> $address_data['city'],
            'state'=> $address_data['state'],
            'state_short' => $address_data['state_short'],
            'post_code'=> $address_data['post_code'],
            'total_institutions' => $tt_institution,
        );
    
        }
        
        wp_reset_query();
        echo json_encode($institution_data);

    } else {
        echo json_encode('no_result');
    }



wp_die();
}    

 ?>