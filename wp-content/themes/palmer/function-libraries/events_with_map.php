<?php
//Before Event is deleted
function check_values($post_ID, $post_after, $post_before){
    // echo '<b>Post ID:</b><br />';
    //print_r($post_ID);
    if($post_after->post_status=='trash' && $post_after->post_type=='event_listing'){
        global $wpdb;



        /* ===================Check for event id added in previous objects and delete it from there if exits===================== */

        echo "<br>marker exist But check if this event exist somewhere else so that it can be deleted<br> ";
    // check for event saved earlier in marker meta
        $query_to_check_for_already_saved_event_id_in_marker = "SELECT * FROM `wp_wpgmza_markers_has_custom_fields` WHERE value LIKE '%$post_ID%' ";
        $executed_query_to_check_for_already_saved_event_id_in_marker = $wpdb->get_results($query_to_check_for_already_saved_event_id_in_marker);
        print_r($executed_query_to_check_for_already_saved_event_id_in_marker);
        echo "<br>";
        if($executed_query_to_check_for_already_saved_event_id_in_marker){
          print_r(explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
          echo 'event found in marker meta object_id : '.$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id . '<br>';
          if(in_array($post_ID,explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value))){
              echo 'event id : '.$post_ID;
              $key = array_search ($post_ID, explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
              echo 'key : '.$key;
              $exploded_event_ids_in_array=explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value);
              array_filter($exploded_event_ids_in_array);
              print_r($exploded_event_ids_in_array);
              unset($exploded_event_ids_in_array[$key]);
              print_r($exploded_event_ids_in_array);
       //array_filter($exploded_event_ids_in_array);
      //exit;
      //event ids list after deletion of event id found
              $event_ids_list_after_deletion_of_event_id_found=implode(',',$exploded_event_ids_in_array);
      // Now update same marker meta row with object id $executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id and value $event_ids_list_after_deletion_of_event_id_found 

              $object_id_to_update=$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id;
              $update_event_ids_in_marker_meta_query="UPDATE wp_wpgmza_markers_has_custom_fields SET value = '$event_ids_list_after_deletion_of_event_id_found' WHERE  object_id = $object_id_to_update AND field_id=1";
              $execute_update_event_ids_in_marker_meta_query = $wpdb->get_results($update_event_ids_in_marker_meta_query);
              var_dump($execute_update_event_ids_in_marker_meta_query);
              
      

          }
      }


      /* ======================checking event id inserted already code ends====================== */





      //exit;
  }

    // echo '<b>Post Object AFTER update:</b><br />';
    // var_dump($post_after);

    // echo '<b>Post Object BEFORE update:</b><br />';
    // var_dump($post_before);

}

add_action( 'post_updated', 'check_values', 10, 3 ); //don't forget the last argument to allow all three arguments of the function


//After event is saved
add_action('save_post','save_event_post_callback');

function save_event_post_callback($post_id){
    global $post; 
    if ($post->post_type != 'event_listing'){
        return;
    }
    $address_for_marker=get_post_meta($post->ID)['_event_location'][0];
    global $wpdb;
    $address_for_marker=get_post_meta($post->ID)['_event_location'][0];

    if(strpos($address_for_marker, "'") !== FALSE){
      $sanitized_address_for_markers=str_replace("'","\'",$address_for_marker); // Sanitized string for database
  }
  else{
     $sanitized_address_for_markers=$address_for_marker;
 }

 echo $lat=get_post_meta($post->ID)['_latitude'][0];
 echo $long=get_post_meta($post->ID)['_longitude'][0];

 /* ============================== SELECT Query for checking address exists or not ======================================================= */

$markers_query = "SELECT * FROM `wp_wpgmza` WHERE address='$sanitized_address_for_markers' AND map_id = 2"; // check if marker already exist with this address coming from saved event
$markers_results = $wpdb->get_results($markers_query);

/* ==============================if condition starts when marker already exists======================================================= */

if(!empty($markers_results)){
echo '<br>marker id : '.$markers_results[0]->id;
     
    /* ===================Check for event id added in previous objects and delete it from there if exits===================== */

    echo "<br>marker exist But check if this event exist somewhere else so that it can be deleted<br> ";
    // check for event saved earlier in marker meta
    $query_to_check_for_already_saved_event_id_in_marker = "SELECT * FROM `wp_wpgmza_markers_has_custom_fields` WHERE value LIKE '%$post->ID%' ";
    $executed_query_to_check_for_already_saved_event_id_in_marker = $wpdb->get_results($query_to_check_for_already_saved_event_id_in_marker);
    print_r($executed_query_to_check_for_already_saved_event_id_in_marker);
    echo "<br>";
    if($executed_query_to_check_for_already_saved_event_id_in_marker){
      print_r(explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
      echo 'event found in marker meta object_id : '.$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id . '<br>';
      
     

      if(in_array($post->ID,explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value))){
          echo 'event id : '.$post->ID;
          $key = array_search ($post->ID, explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
          echo 'key : '.$key;
          $exploded_event_ids_in_array=explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value);
          array_filter($exploded_event_ids_in_array);
          print_r($exploded_event_ids_in_array);
          unset($exploded_event_ids_in_array[$key]);
          print_r($exploded_event_ids_in_array);
          $exploded_event_ids_in_array=array_filter($exploded_event_ids_in_array);
          print_r($exploded_event_ids_in_array);
       //array_filter($exploded_event_ids_in_array);
     // exit;
      //event ids list after deletion of event id found
          $event_ids_list_after_deletion_of_event_id_found=implode(',',$exploded_event_ids_in_array);
      // Now update same marker meta row with object id $executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id and value $event_ids_list_after_deletion_of_event_id_found 

          $object_id_to_update=$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id;
          $update_event_ids_in_marker_meta_query="UPDATE wp_wpgmza_markers_has_custom_fields SET value = '$event_ids_list_after_deletion_of_event_id_found' WHERE  object_id = $object_id_to_update AND field_id = 1";
          $execute_update_event_ids_in_marker_meta_query = $wpdb->get_results($update_event_ids_in_marker_meta_query);
          //var_dump($execute_update_event_ids_in_marker_meta_query);
          echo $object_id_to_update . " now has values";
          print_r($exploded_event_ids_in_array);

           if($executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id == $markers_results[0]->id){
       echo '<br>marker id : '.$markers_results[0]->id;
      echo ' == event found in marker meta object_id : '.$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id . '<br>';
      }
      else{
         if(empty($exploded_event_ids_in_array)){ 
            //exit;
          //Delete marker
          echo 'delete marker with id : '.$object_id_to_update;
          $delete_marker_query = "DELETE FROM wp_wpgmza WHERE id = $object_id_to_update AND map_id = 2";
          $execute_delete_marker=$wpdb->get_results($delete_marker_query);
          $delete_marker_meta_query = "DELETE FROM wp_wpgmza_markers_has_custom_fields WHERE object_id = $object_id_to_update AND field_id = 1";
          $execute_delete_meta_marker=$wpdb->get_results($delete_marker_meta_query);
          //print_r($execute_delete_meta_marker);
          }
      }


         


      //exit;
      }
  }


  /* ======================checking event id inserted already code ends====================== */



  echo 'marker id: '.$markers_results[0]->id.'<br>';
  echo " Marker with this address already exist , Run update query<br>";
 //exit;
 // Get post ids from meta table
  $marker_id=$markers_results[0]->id;
 //Get Events ids with this marker id attached
  $markers_meta_query = "SELECT value FROM `wp_wpgmza_markers_has_custom_fields` WHERE object_id='$marker_id' AND field_id = 1";
  $markers_meta_results = $wpdb->get_results($markers_meta_query);
  echo 'Event id attached to marker is : '.$markers_meta_results[0]->value.'<br>';
  echo ' Event saved by client is : '.$post->ID.'<br>';
  $event_ids_in_array=explode(',',$markers_meta_results[0]->value);
  print_r($event_ids_in_array);


 //if event id already added in markers meta 
  if(in_array($post->ID,$event_ids_in_array)){
   echo "This Event: ".$post->ID. " Already is attached to marker".$marker_id.'<br>';
   echo "Now Update coordinates of this marker , no need to update marker meta as event id is same<br>";
   $update_already_existing_address_with_coordinates_query = "UPDATE wp_wpgmza SET lat = $lat , lng=$long WHERE  id = $marker_id AND map_id = 2";
   print_r($update_already_existing_address_with_coordinates_query);

   $updated_markers_results=$wpdb->get_results($update_already_existing_address_with_coordinates_query);
   print_r($updated_markers_results);
}
else{
 // if event is not found for this marker location then add it along with old event   
   echo $event_ids=$markers_meta_results[0]->value.','.$post->ID;
   $update_marker_meta_query="UPDATE wp_wpgmza_markers_has_custom_fields SET value = '$event_ids' WHERE  object_id = $marker_id AND field_id = 1";
   $updated_markers_meta_results=$wpdb->get_results($update_marker_meta_query);
   print_r($updated_markers_meta_results);
}


// exit;
}

/* ==============================if condition ends when marker already exists======================================================= */

/* =============================if marker dont exist then else starts======================= */

else{

    /* ===================Check for event id added in previous objects and delete it from there if exits===================== */

    echo "<br>marker dont exist But check if this event exist somewhere else so that it can be deleted<br> ";
    // check for event saved earlier in marker meta
    $query_to_check_for_already_saved_event_id_in_marker = "SELECT * FROM `wp_wpgmza_markers_has_custom_fields` WHERE value LIKE '%$post->ID%' ";
    $executed_query_to_check_for_already_saved_event_id_in_marker = $wpdb->get_results($query_to_check_for_already_saved_event_id_in_marker);
    print_r($executed_query_to_check_for_already_saved_event_id_in_marker);
    //exit;
    echo "<br>";
    if($executed_query_to_check_for_already_saved_event_id_in_marker){
      print_r(explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
      //exit;
      echo 'event found in marker meta object_id : '.$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id . '<br>';
      if(in_array($post->ID,explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value))){
          echo 'event id : '.$post->ID;
          
          $key = array_search ($post->ID, explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value));
          echo 'key : '.$key;
          //exit;
          $exploded_event_ids_in_array=explode(',',$executed_query_to_check_for_already_saved_event_id_in_marker[0]->value);
          array_filter($exploded_event_ids_in_array);
          print_r($exploded_event_ids_in_array);
          unset($exploded_event_ids_in_array[$key]);
          print_r($exploded_event_ids_in_array);
          //array_filter($exploded_event_ids_in_array);
      //print_r(array_filter($exploded_event_ids_in_array));
          $exploded_event_ids_in_array=array_filter($exploded_event_ids_in_array);
          print_r($exploded_event_ids_in_array);
          //exit;

      //event ids list after deletion of event id found
          $event_ids_list_after_deletion_of_event_id_found=implode(',',$exploded_event_ids_in_array);
      // Now update same marker meta row with object id $executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id and value $event_ids_list_after_deletion_of_event_id_found 

          $object_id_to_update=$executed_query_to_check_for_already_saved_event_id_in_marker[0]->object_id;
          $update_event_ids_in_marker_meta_query="UPDATE wp_wpgmza_markers_has_custom_fields SET value = '$event_ids_list_after_deletion_of_event_id_found' WHERE  object_id = $object_id_to_update AND field_id = 1";
          $execute_update_event_ids_in_marker_meta_query = $wpdb->get_results($update_event_ids_in_marker_meta_query);
          var_dump($execute_update_event_ids_in_marker_meta_query);

           if(empty($exploded_event_ids_in_array)){ 
          //Delete marker
          echo 'delete marker with id : '.$object_id_to_update;
          //exit;
          $delete_marker_query_a = "DELETE FROM wp_wpgmza WHERE id = $object_id_to_update AND map_id = 2";
          $execute_delete_marker_a=$wpdb->get_results($delete_marker_query_a);
          print_r($execute_delete_marker_a);
          //exit;
          $delete_marker_meta_query_a = "DELETE FROM wp_wpgmza_markers_has_custom_fields WHERE object_id = $object_id_to_update AND field_id = 1";
          $execute_delete_meta_marker=$wpdb->get_results($delete_marker_meta_query_a);
          //print_r($execute_delete_meta_marker);
          }
      //exit;
      }
  }

  /* ======================checking event id inserted already code ends====================== */    

    //exit;
  $sql = "INSERT INTO `wp_wpgmza`( `map_id`, `address`, `description`, `pic`, `link`, `icon`, `lat`, `lng`, `anim`, `title`, `infoopen`, `category`, `approved`, `retina`, `type`, `did`, `sticky`, `other_data`, `latlng`) VALUES (2,'$sanitized_address_for_markers','','','','',$lat , $long,0,'',0,'',1,0,0,'',0,'',POINT($lat , $long))";
  $results = $wpdb->get_results($sql);

  echo $getLastInsertedId = $wpdb->insert_id;

  if($getLastInsertedId!=0){
    echo "inserted marker<br>";
    echo $sql_cf_insert = "INSERT INTO `wp_wpgmza_markers_has_custom_fields`(`field_id`, `object_id`, `value`) VALUES (1,$getLastInsertedId,$post->ID)";
    $results_cf = $wpdb->get_results($sql_cf_insert);
    echo "inserted meta<br>";
}

}

/* =============================else condition ends======================= */

//exit;

}




?>