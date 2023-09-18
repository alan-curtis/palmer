<?php
// Get Header
get_header();
global $post;
?>

    <div class="section-top">
        <div class="container">
            <h1>
                <?php
                $object = get_queried_object();
                if($object->taxonomy == 'post_tag'){
                    echo single_tag_title();
                    $tag_id = get_queried_object()->term_id;
                }
                elseif($object->taxonomy == 'category'){
                    $category = get_category( get_query_var( 'cat' ) );
                    echo $category->cat_name;
                    $category = $category->cat_ID;
                }


                ?>
            </h1>
            <?php wpcustomtheme_breadcrumb(true, '/'); ?>
        </div>
    </div>

    <div class="main-container" role="main">
        <div class="container">
            <div class="blog-post-category-content">
                <div class="content">
                    <div class="blog-post-items">
                        <?php
                       // $category = get_category( get_query_var( 'cat' ) );

                       if($tag_id){
                        $posts = get_posts(array('numberposts' => 5, 'offset' => 0, 'tag_id'=> $tag_id, 'post_status' => 'publish', 'order' => 'ASC'));
                       }
                        elseif($category){
                        $posts = get_posts(array('numberposts' => 5, 'offset' => 0, 'category'=> $category, 'post_status' => 'publish', 'order' => 'ASC'));
                        }
                        foreach ($posts as $post) :
                            setup_postdata($post);
                            ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </div>
                                        <div class="description">
                                            <?php // echo wp_trim_words(get_the_content(), 100, '...'); ?>
                                                                                                                          <?php echo get_field('teaser_txt'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="featured-image">
                                            <?php if (has_post_thumbnail($post->ID)): ?>
                                                <?php the_post_thumbnail('categories-thumb'); ?>
                                            <?php else: ?>
                                                <img src="/wp-content/themes/palmer/dist/images/palmer-placehold.png"
                                                     alt="">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
// Get Footer
get_footer();
?>
