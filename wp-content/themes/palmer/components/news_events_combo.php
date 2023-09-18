<div class="container news-events-combo">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center news-header justify-content-between">
                    <div class="title"><?php echo $args["title"]; ?></div>
                    <?php if(!empty($args["more_posts_link"]["title"]) && !empty($args["more_posts_link"]["url"])){
                    ?>
                    <a href="<?php echo $args["more_posts_link"]["url"]; ?>"
                       class="link-arrow"><?php echo $args["more_posts_link"]["title"]; ?></a>
                    <?php
                    } ?>
                    
            </div>
            <div class="row news-post-content">
                <?php $cls = count($args["news_posts"]) == 2 ? "col-md-6" : "col-md-12"; ?>
                <?php foreach ($args["news_posts"] as $key => $item): ?>
                    <div class="<?php echo $cls; ?>">
                        <?php $post = get_post($item["post_ref"]);
                        ?>
                        <a href="<?php echo get_permalink($post); ?>">
                            <div class="post-container">
                                <div class="post-image">
                                    <?php if (!empty(get_the_post_thumbnail_url($post))): ?>
                                        <img src="<?php echo get_the_post_thumbnail_url($post, 'news-post-thumb'); ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/default(386x200).png"/>
                                    <?php endif; ?>
                                </div>
                                <div class="post-content">
                                    <div class="post-title">
                                        <?php echo $post->post_title; ?>
                                    </div>
                                    <div class="post-date">
                                        <?php echo date("F j, Y", strtotime($post->post_date)); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row align-items-center event-header justify-content-end">
                <div class="event-link">
                    <?php if(!empty($args["more_events_link"]["title"]) && !empty($args["more_events_link"]["url"])){
                    ?>
                    <a href="<?php echo $args["more_events_link"]["url"]; ?>"
                       class="link-arrow"><?php echo $args["more_events_link"]["title"]; ?></a>
                       <?php
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="event-container">
                    <?php
                     if(!empty($args["events"])){
                     foreach ($args["events"] as $key => $item): ?>
                        <?php $post = $item["event_ref"]; 
                        $metaData = get_post_meta($post->ID);
                        ?>
                        <a href="<?php echo get_permalink($post); ?>">
                            <div class="event-row d-flex align-center">
                                <div class="event-date">
                                    <div class="event-date-wrap text-center">
                                        <div class="date-month"><?php $time = strtotime($metaData['_event_start_date'][0]);
                                        echo $month = date("M", $time);; ?></div>
                                        <div class="date-day"><?php echo $day = date("d", $time); ?></div>
                                    </div>
                                </div>
                                <div class="event-title">
                                    <h4> <?php echo $post->post_title; ?></h4>
                                    <div class="event-time">
                                      <?php
                                        
                                        if($metaData['_event_start_time'][0]){ $amorpm_of_starttime=date("a", strtotime($metaData['_event_start_time'][0])); 
                                                $amorpm_of_endtime=date("a", strtotime($metaData['_event_end_time'][0])); 
                                                echo date("g:i", strtotime($metaData['_event_start_time'][0])).' '.trim( chunk_split($amorpm_of_starttime, 1, '.') ).' - '.date("g:i", strtotime($metaData['_event_end_time'][0])).' '.trim( chunk_split($amorpm_of_endtime, 1, '.') ) ; } else{
                                                    echo "All Day";
                                                }  ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; 
                     }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>