<section class="bg-white persons-grid">
    <div class="container">
        <h2 class="color-purple"><?php echo $args['title']; ?></h2>
        <div class="row align-items-center person-wrapper-heading">
            <?php if(!empty($args['link']['title'])){
            ?>
            <div class="col-sm-3 directory d-flex align-items-center justify-content-sm-end"><a href="<?php echo $args['link']['url']; ?>" class="directory-link color-purple"><?php echo $args['link']['title']; ?></a></div>
        </div>
        <div class="row">
            <?php
            } ?>
            <?php
            if(count($args['items'])==3){
                $column='4';
            }
            elseif(count($args['items'])==4){
                $column='3';
            }
            foreach ($args['items'] as $item) {
              $link_array = unserialize(get_post_meta($item['person_ref']->ID)['link'][0]);
              ?>
              <div class="d-none py-3 d-sm-block col-lg-<?php echo $column; ?> col-md-6 block" >
                  <div class="image">
                      <img src="<?php if (!empty(get_the_post_thumbnail_url($item['person_ref']->ID))) {
                          echo get_the_post_thumbnail_url($item['person_ref']->ID, 'person-grid');
                      } else {
                          echo get_template_directory_uri() . "/dist/images/palmer-placehold.png";
                      } ?>">
                  </div>
                <div class="card">
                   <a target="<?php if( $link_array['url'] ) { echo "_blank"; } ?>" href="<?php if( $link_array['url'] ){ echo $link_array['url']; } else{ echo "javascript:void(0)"; } ?>" class="person-name"><?php echo get_the_title($item['person_ref']->ID); ?></a>
                   <div class="caption smalltext"><?php echo get_post_meta($item['person_ref']->ID)['caption'][0]; ?></div>
                   <!-- <p class="bio"><?php //echo get_post_meta($item['person_ref']->ID)['short_bio'][0]; ?></p> -->
                   <ul class="contact-details">
                    <?php if(get_post_meta($item['person_ref']->ID)['email'][0]){
                        ?>
                        <li class="email color-purple"><i class="fas fa-envelope"></i><a href="mailto: <?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?></a></li>
                        <?php
                    } ?>

                    <?php if(get_post_meta($item['person_ref']->ID)['phone'][0]){
                        ?>
                        <li class="contact-number color-purple"><i class="fas fa-phone-alt"></i><a href="tel:<?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?></a></li>
                        <?php
                    } ?>
                </ul>                             
            </div>
        </div>
        <?php
    }     
    ?>

    <div class="d-sm-none persons-grid-slider slider">
     <?php 
     foreach ($args['items'] as $item) {
        $link_array = unserialize(get_post_meta($item['person_ref']->ID)['link'][0]);
      ?>
      <div>
          <img src="<?php if(!empty(get_the_post_thumbnail_url($item['person_ref']->ID))){ echo get_the_post_thumbnail_url($item['person_ref']->ID); } else{ echo get_template_directory_uri()."/dist/images/palmer-placehold.png"; } ?>"> 
          <div class="card">
            <a target="<?php if( $link_array['url'] ) { echo "_blank"; } ?>" href="<?php if( $link_array['url'] ){ echo $link_array['url']; } else{ echo "javascript:void(0)"; } ?>" class="person-name"><?php echo get_the_title($item['person_ref']->ID); ?></a>
            <div class="caption smalltext"><?php echo get_post_meta($item['person_ref']->ID)['caption'][0]; ?></div>
            <!-- <p class="bio"><?php //echo get_post_meta($item['person_ref']->ID)['short_bio'][0]; ?></p> -->
            <ul class="contact-details">
                <?php if(get_post_meta($item['person_ref']->ID)['email'][0]){
                    ?>
                    <li class="email color-purple"><i class="fas fa-envelope"></i><a href="mailto: <?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?></a></li>
                    <?php
                } ?>

                <?php if(get_post_meta($item['person_ref']->ID)['phone'][0]){
                    ?>
                    <li class="contact-number color-purple"><i class="fas fa-phone-alt"></i><a href="tel:<?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?></a></li>
                    <?php
                } ?>
            </ul>                             
        </div>
    </div>
    <?php
}
?>
</div>         

</div>
</div>
</section>
