<?php
   /*
 * Template Name: Library Page
 * Template Post Type: landing_page
 */

get_header();
the_post();
?>
<div class="main-container library-template basic-page" role="main">

<?php get_template_part('components/library', 'filter'); ?>

</div>

<?php
get_footer();
?>    