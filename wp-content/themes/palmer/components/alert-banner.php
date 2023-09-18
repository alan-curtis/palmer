<?php if( have_rows('alert_repeater','option')): ?>
  <div class="alerts_main_container">
  <?php
  while( have_rows('alert_repeater','option') ) : the_row();
  $color = get_sub_field('alert_color','option');
  $value = $color['value'];
  $current_date_time = current_datetime()->format('Y-m-d H:i:s');
  $expiration = get_sub_field('alert_expiration','option');

  if( $expiration > $current_date_time  ) {
    ?>
      <div class="alert_msg alert alert-dismissible fade show alert_<?php echo esc_attr($value); ?>" role="alert">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="d-flex text_wrap align-items-center">
                          <img src="<?php echo get_template_directory_uri(); ?>/dist/images/alert-icon.png"><strong
                                  class="text-uppercase"><?php echo get_sub_field('title', 'option'); ?></strong> <a
                                  class="text"
                                  href="<?php echo get_sub_field('link', 'option'); ?>"> <?php echo get_sub_field('body', 'option'); ?></a>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  </div>
              </div>
            </div>
      </div>
      <?php
    }
    ?>
    <?php endwhile;?>
  </div>
    <?php else: ?>

<?php endif; ?>
