<?php
// Get Header
get_header();
the_post();
global $post;
?>

    <div class="section-top">
        <div class="container" id=content>
            <h1><?php echo get_the_title(); ?></h1>
            <?php wpcustomtheme_breadcrumb(true, '/'); ?>
        </div>
    </div>

    <div class="main-container basic-page" role="main">
        <?php if (have_rows('post_component')) {
            while (have_rows('post_component')) {
                the_row();
                if (get_row_layout() == 'hero_slideshow') {
                    get_template_part('components/hero', 'slideshow', $args = array('slides' => get_sub_field('hero_slides')));
                }
                if (get_row_layout() == 'hero_banner') {
                    get_template_part('components/hero', 'banner', $args = array('image' => get_sub_field('image'), 'overlay_style' => get_sub_field('overlay_style'), 'accent_image' => get_sub_field('accent_image')));
                }
                if (get_row_layout() == 'hero_video') {
                    get_template_part('components/hero', 'video', $args = array('video' => get_sub_field('video'), 'image' => get_sub_field('image'), 'title' => get_sub_field('title'), 'link' => get_sub_field('link'), 'caption' => get_sub_field('caption'), 'overlay_style' => get_sub_field('overlay_style'), 'accent_image' => get_sub_field('accent_image')));
                }
            }
        }
        ?>

        <div class="container content-section">
            <div class="row">
                <div class="col-lg-2">
                    <div class="container">
                        <div class="post-categories">
                            <div class="categories">
                                <p class="title title font-weight-bold">Blog Categories</p>
                                <ul class="listing">
                                    <?php
                                    $categories = get_categories();
                                    foreach ($categories as $category) {
                                        echo '<li class="list-item"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php
/*                    if (have_rows('components_sidebar')) {
                        while (have_rows('components_sidebar')) {
                            the_row();
                            if (get_row_layout() == 'sidebar_buttons') {
                                get_template_part('components/sidebar', 'ctabuttons', $args = array('buttons' => get_sub_field('buttons')));
                            }
                            if (get_row_layout() == 'sidebar_links') {
                                get_template_part('components/sidebar', 'links', $args = array('title' => get_sub_field('title'), 'links' => get_sub_field('links')));
                            }
                            if (get_row_layout() == 'sidebar_contacts') {
                                get_template_part('components/sidebar', 'contact', $args = array('contacts' => get_sub_field('contacts')));
                            }
                        }
                    }
                    */?>
                </div>
                <div class="col-lg-10 main-content">

                    <?php
                    $teaser_txt = get_field('teaser_txt', $post->ID);
                    ?>

                    <div class="container">
                        <div class="content-description">
                            <?php the_content();?>
                        </div>
                    </div>

                    <?php
                    if (have_rows('post_components_main')) {
                        while (have_rows('post_components_main')) {
                            the_row();
                            if (get_row_layout() == 'accordion') {
                                get_template_part('components/accordian', 'section', $args = array('accordion_items' => get_sub_field('accordion_items'), 'title' => get_sub_field('title')));
                            }
                            if (get_row_layout() == 'blockquote') {
                                get_template_part('components/blockquote', 'section', $args = array('body' => get_sub_field('body'), 'author' => get_sub_field('author'), 'title' => get_sub_field('title')));
                            }
                            if (get_row_layout() == 'image_blocks_sm') {
                                get_template_part('components/imagesblocks', 'small', $args = array('enable_image_block_body' => get_sub_field('enable_image_block_body'), 'image_blocks' => get_sub_field('image_blocks'), 'title' => get_sub_field('title')));
                            }
                            if (get_row_layout() == 'tabs') {
                                get_template_part('components/tabs', 'section', $args = array('tabs' => get_sub_field('tabs'), 'title' => get_sub_field('title')));
                            }
                            if (get_row_layout() == 'wysiwyg') {
                                get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
                            }
                            if (get_row_layout() == 'testimonial_carousel') {
                                get_template_part('components/testimonial', 'carousel', $args = array('carousel_items' => get_sub_field('carousel_items'), 'title' => get_sub_field('title')));
                            }
                            if (get_row_layout() == 'token_grid') {
                                get_template_part('components/token', 'grid', $args = array('title' => get_sub_field('title'), 'token_style' => get_sub_field('token_style'), 'columns' => get_sub_field('columns'), 'items' => get_sub_field('items')));
                            }
                            if (get_row_layout() == 'image_gallery') {
                                get_template_part('components/image', 'gallery', $args = array('items' => get_sub_field('items'), 'title' => get_sub_field('title')));
                            }

                        }
                    }
                    ?>

                    <div class="container">
                        <div class="post-info">
                            <span>Posted on <?php echo get_the_modified_date('F j, Y'); ?> by <?php if(!empty(get_field('author_txt'))){ echo get_field('author_txt'); }else{ echo get_the_author(); }  ?>.</span>
                        </div>

                        <?php $post_tags = get_the_tags();
                        if ($post_tags) :
                            ?>
                            <div class="post-tag">
                                <ul>
                                    <?php
                                    if ($post_tags) {
                                        foreach ($post_tags as $tag) {
                                            ?>
                                            <li><a href="<?php echo  get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="sharethis_button">
                            <?php echo sharethis_inline_buttons(); ?>
                        </div>
                    </div>

                    <div class="container">
                        <div class="pre_nxt_post">
                            <span class="previous"><?php previous_post_link('%link', 'Previous'); ?></span>
                            <span class="next"><?php next_post_link('%link', 'Next'); ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
<?php
// Get Footer
get_footer();
?>
