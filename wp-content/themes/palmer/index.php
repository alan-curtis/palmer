<?php
// Get Header
get_header();
the_post();
?>
    <div class="main-container" role="main">
        <?php 
        the_title();
        the_content();
        ?>
    </div>
<?php
// Get Footer
get_footer();
?>