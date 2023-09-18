<?php
/*
* Template Name: News Center
*
*/
get_header();

news_ajax_filter_scripts();


?>

    <div class="main-container">
       <section class="news-center-template">
          <div class="cont">
               <div class="row">
                    <div class="col-12 headline bg-white">
                    <p class="h1 color-purple text-center"><?php echo get_the_title(); ?></p>
                    <p class="text-center breadcrumb">  <?php  wpcustomtheme_breadcrumb(true, '/'); ?></p>
                    </div>
                </div>
                        <?php
                        if (have_rows('np_component_hero')) {
                            while (have_rows('np_component_hero')) {
                                the_row();
                                 if (get_row_layout() == 'hero_slideshow') {
                                get_template_part('components/hero', 'slideshow', $args = array('slides' => get_sub_field('hero_slides')));
                                }
                                if (get_row_layout() == 'hero_video') {
                                get_template_part('components/hero', 'video', $args = array('video' => get_sub_field('video'),'image' => get_sub_field('image'),'title' => get_sub_field('title'),'link' => get_sub_field('link'),'caption' => get_sub_field('caption'), 'overlay_style' => get_sub_field('overlay_style')));
                                }
                                if (get_row_layout() == 'hero_banner') {
                                    get_template_part('components/hero', 'banner', $args = array('image' => get_sub_field('image'),'overlay_style' => get_sub_field('overlay_style')));
                                }
                                if (get_row_layout() == 'featured_news_carousel') {
                                                    get_template_part('components/featured_news_carousel', 'section', $args = array('posts' => get_sub_field('post_refs')));
                                }
                            }
                        }
                        ?>
            </div>

        <div class="news"  id="content">
            <div class="container">
                <?php
                get_template_part('components/news-center-filter');
                ?>
            </div>
        </div>

        <div class="news-list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 cats">
                       <p class="title font-weight-bold"> Blog Categories </p>
                       <ul class="listing">
                        <li data-id="all">All Categories</li>
                      <?php $categories = get_categories();
                        foreach($categories as $category) {
                            if($category->slug == "uncategorized"){
                             continue;
                            }
                           echo '<li data-id="'.$category->slug.'">' . $category->name . '</li>';
                        } ?>
                        </ul>
                    </div>
                    <div class="col-lg-10" id="search_results">

                    </div>
                </div>
            </div>
        </div>

        <div class="events_pagination">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 d-flex">
                        <div class="prev_paginates">
                            <ul>
                                <li class="first page-numbers"><i class="fas fa-angle-double-left"></i> First</li>
                                <li class="prev page-numbers"><i class="fas fa-angle-double-left"></i> Prev</li>
                            </ul>
                        </div>
                        <div id="pagination_events"></div>
                        <div class="next_paginates">
                            <ul>
                                <li class="next page-numbers">Next <i class="fas fa-angle-double-right"></i></li>
                                <li class="last page-numbers">Last <i class="fas fa-angle-double-right"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       </section>
    </div>

<?php get_footer(); ?>
