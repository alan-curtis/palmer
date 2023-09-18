<?php  


function news_ajax_filter_scripts()
{
    wp_enqueue_script('news_ajax_moment', get_stylesheet_directory_uri() . '/dist/js/moment.min.js', array(), '1.0', true);
    wp_enqueue_script('news_ajax_filter', get_stylesheet_directory_uri() . '/dist/js/news-filter-ajax.js');
    wp_localize_script('news_ajax_filter', 'ajax_url', admin_url('admin-ajax.php'));
}
add_action('wp_ajax_news_ajax_filter', 'news_ajax_filter_callback');
add_action('wp_ajax_nopriv_news_ajax_filter', 'news_ajax_filter_callback');

function news_ajax_filter_callback()
{

$data=$_POST['data'];
$title=$data['title'];
$date=$data['date'];
$category=$data['cat'];
//pagination code
     $numb_item = 7;
     $page_number = $data['page_number'];
     $offset = ($page_number - 1) * 7 ;
     
     // print_r($offset);
     $event_data['offset'] = $offset;
//pagination code ends


$args  =  array('post_type' => 'post',
                'post_status' => 'publish' ,
                'offset' => $offset,
                'posts_per_page' => $numb_item,
                "s" => $title,
               );

if($date!='all'){
  $start_date_url=$date;
  $start_date=explode('/', $start_date_url)[3].'-'.explode('/', $start_date_url)[4].'-01';
  $start_date=explode('/', $start_date_url)[3].'-'.explode('/', $start_date_url)[4].'-01';
  $time = strtotime($start_date);
  $next_month = date("Y-m-d", strtotime("+1 month -1 day", $time));

  $args['date_query'][]= array(
                            'after' => $start_date,
                            'before' => $next_month,
                            'inclusive' => true,
                        );  
}

if($category != 'all'){
    $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' =>  $category,
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
            if (!empty(get_the_post_thumbnail_url(get_the_ID()))) {
               $img= get_the_post_thumbnail_url(get_the_ID());
            } else {
              $img = get_template_directory_uri() . "/dist/images/palmer-placehold.png";
            }
            $campuses=get_the_terms(get_the_ID(),'campus');
            foreach($campuses as $campus){
            $campus_name=$campus->name;
            }
            $category=get_the_terms(get_the_ID(),'category');
            foreach($category as $cat){
            $cat_link=get_category_link($cat->term_id);
            $cat=$cat->name;
            }
             $excerpt='';
            if(get_post_meta(get_the_ID())['teaser_txt'][0]){
                $excerpt=get_post_meta(get_the_ID())['teaser_txt'][0];
            }
            
 
            $event_data[] = array(
            'event_id' => $event_id,
            'event_title' => $event_title,
            'total_events' => $tt_event,
            'img_src' => $img, 
            'campus' => $campus_name,
            'category' => $cat,
            'excerpt' => $excerpt,
            'post_link' => get_the_permalink(get_the_ID()),
            'cat_link' => $cat_link,
        );
            
        }
        
        wp_reset_query();
        echo json_encode($event_data);

    } else {
        echo json_encode('no_result');
    }


wp_die();
}    