<?php
   /*
 * Template Name: Video Gridder
 * Template Post Type: landing_page
 */

get_header();
the_post();
?>
<div class="main-container landing-page" role="main">

<?php get_template_part('components/video_gridder'); ?>

</div>

<?php
get_footer();
?>    