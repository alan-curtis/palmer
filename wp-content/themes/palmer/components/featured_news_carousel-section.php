<div class="featured-news hero-section">
    <div id="featured-news-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <?php

            function getExcerpt($str, $startPos=0, $maxLength=100) {
                if(strlen($str) > $maxLength) {
                    $excerpt   = substr($str, $startPos, $maxLength-3);
                    $lastSpace = strrpos($excerpt, ' ');
                    $excerpt   = substr($excerpt, 0, $lastSpace);
                    $excerpt  .= '...';
                } else {
                    $excerpt = $str;
                }

                return $excerpt;
            }

            if (!empty($args)) {
                foreach ($args['posts'] as $key => $item) {
                
                    //$post = $item->ID;
                    ?>
                    <div class="carousel-item <?php echo $key == 1 ? "active" : ""; ?>">
                        <div class="row">
                            <div class="col-lg-6 px-0">
                                <div class="pic"> 
                                <picture>
                                <source media="(min-width:466px)" srcset="<?php if (!empty(get_the_post_thumbnail_url($item->ID, 'featured-news-thumb-desktop'))) {
                                                                          echo get_the_post_thumbnail_url($post, 'featured-news-thumb-desktop');
                                                                        } else {
                                                                          echo "https://via.placeholder.com/720x599";
                                                                        }  ?>">
                                <source media="(max-width:465px)" srcset="<?php if (!empty(get_the_post_thumbnail_url($item->ID, 'featured-news-thumb-mobile'))) {
                                                                          echo get_the_post_thumbnail_url($post, 'featured-news-thumb-mobile');
                                                                        } else {
                                                                          echo "https://via.placeholder.com/375x311";
                                                                        }  ?>">
                                <img src="<?php if (!empty(get_the_post_thumbnail_url($item->ID))) {
                                          echo get_the_post_thumbnail_url($item->ID);
                                        } else {
                                          echo "https://via.placeholder.com/720x599";
                                        }  ?>">
                              </picture>
                              </div>
                            </div>
                            <div class="col-lg-6 conten">
                                <div class="news-content">
                                    <div class="news-cat">
                                        <?php
                                         if(!empty(get_the_terms($item->ID,'campus'))){
                                             $i=1;
                                             $trm_count=count(get_the_terms($item->ID,'campus'));
                                             foreach(get_the_terms($item->ID,'campus') as $trm){
                                             echo $trm->name;
                                                 if($i<$trm_count){
                                                 echo ' , ';
                                                 }
                                             $i++;
                                             }
                                         }
                                          ?>
                                    </div>
                                    <div class="news-title">
                                        <h2><?php echo $item->post_title; ?></h2>
                                    </div>
                                    <div class="news-body">
                                        <?php echo getExcerpt(get_post_meta($item->ID)['teaser_txt'][0],0,150); ?>
                                    </div>
                                    <?php if(!empty(get_post_meta($item->ID)['teaser_button_txt'][0])){
                                        ?>
                                        <div class="news-link">
                                        <a href="<?php echo the_permalink($item->ID)?>"><?php echo get_post_meta($item->ID)['teaser_button_txt'][0]; ?></a>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6 dots_car">
                <ol class="carousel-indicators">
                    <?php
                    foreach ($args['posts'] as $key => $item) { ?>
                        <li data-target="#featured-news-carousel" data-slide-to="<?php echo $key == 1 ? "active" : ""; ?>"
                            class="<?php echo $key == 1 ? "active" : ""; ?>"></li>
                        <?php
                    }
                    ?>
                </ol>
            </div>
        </div>

        <a class="carousel-control-prev" href="#featured-news-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#featured-news-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>