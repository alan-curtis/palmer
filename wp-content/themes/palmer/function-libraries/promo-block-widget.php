<?php
/* 
* Register Promo block widget  
*/

// Creating the widget 
class menu_promo_block extends WP_Widget {

    function __construct() {
        parent::__construct(

// Base ID of your widget
            'menu_promo_block', 

// Widget name will appear in UI
            __('Menu Promo Block Widget', 'menu_promo_block_domain'), 

// Widget description
            array( 'description' => __( 'Widget for mega menu', 'menu_promo_block_domain' ), ) 
        );
    }

// Creating widget front-end

    public function widget( $args, $instance ) {
   
        $image = get_field('image','widget_menu_promo_block-2');
        $title = get_field('title','widget_menu_promo_block-2');
        $caption = get_field('caption','widget_menu_promo_block-2');
        $link_text = get_field('link','widget_menu_promo_block-2')['title'];
        $link_url = get_field('link','widget_menu_promo_block-2')['url'];
  
        echo '<div class="textwidget">';
        if(!empty($image)){
        echo '<img src="'.$image.'">';
        }
        echo '<div class="content">'; 
        
        if(!empty($title)){
        echo '<p class="title">'.$title.'</p>';
        }
        
        if(!empty($caption)){
        echo '<p class="blurb">'.$caption.'</p>';
        }
        
        if(!empty($link_text)){
        echo '<a class="morelink" href="'.$link_url.'">'.$link_text.'</a>';
        }
        
        echo '</div></div>';  
    }

// Widget Backend 
    public function form( $instance ) {
    
    }
// Class menu_promo_block ends here
} 


// Register and load the widget
function menu_promo_block_load_widget() {
    register_widget( 'menu_promo_block' );
}
add_action( 'widgets_init', 'menu_promo_block_load_widget' );

