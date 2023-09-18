<?php
if($args['accent_image'] == true){
    $accent_image = 'spine_img';
}
$overlay_style = get_sub_field('overlay_style');
?>
<div class="hero-banner-block hero-section <?php echo $overlay_style; ?> <?php echo $accent_image;?>">
    <div class="shadow"></div>
    <div class="image">
        <img src="<?php print_r($args['image']['url']); ?>">
    </div>
    <div class="container">
        <div class="hero-banner-captions">
            <h1><?php echo get_the_title(); ?></h1>
            <?php  //wpcustomtheme_breadcrumb(true, '/'); ?>
            <?php //bcn_display();?>
            <?php
              if ( function_exists( 'menu_breadcrumb') ) {
                  menu_breadcrumb(
                      'breadcrumb-menu',                             // Menu Location to use for breadcrumb
                      ' &#47; ',                        // separator between each breadcrumb
                      '<p class="breadcrumb-items">',      // output before the breadcrumb
                      '</p>'                              // output after the breadcrumb
                  );
              }

          ?>

        </div>
    </div>
</div>
