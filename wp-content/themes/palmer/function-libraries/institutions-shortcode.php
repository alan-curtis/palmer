<?php

function get_institutions($atts) {
  ob_start();
  get_template_part('components/institutions' ,'', $args = array('items' => 'dummy')); 
  return ob_get_clean();
}
add_shortcode('GoogleMap_Institutions', 'get_institutions');

 ?>