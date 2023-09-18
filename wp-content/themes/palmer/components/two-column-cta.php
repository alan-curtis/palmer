<section class="bg-white two-column-section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php if( get_sub_field('column_title') ): ?>
          <h1><?php echo get_sub_field('column_title'); ?></h1>
        <?php endif; ?>
      </div>
    </div>


    <?php if( have_rows('column_repeater')): ?>

      <?php
      while( have_rows('column_repeater') ) : the_row();

      $title = get_sub_field('title');
      $copy = get_sub_field('copy');
      $link = get_sub_field('link');

      ?>
        <div class="row two-column-wrap align-items-center">
      <div class="col-lg-6">
        <h2><?php echo $title; ?></h2>

      </div>
      <div class="col-lg-6">
        <?php echo $copy; ?>
        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"> <?php echo $link['title']; ?></a>
      </div>

    </div>
<?php endwhile;
else:
 ?>


  <?php endif; ?>
  </div>
</section>
