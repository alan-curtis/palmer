<?php
$campus_id = '';
if (!empty($args['campus'])) {
    $campus_id = $args['campus'];
}
?>

<?php global $post;
$event_start = date('Y-m-d');
//print_r($event_start);
$looparg = array(
    'post_type' => 'event_listing',
    'posts_per_page' => 1,
    'meta_key' => '_event_start_date',
    'orderby' => 'meta_value date',
    'meta_type' => 'DATE',
    'order' => 'ASC',
    'relation' => 'AND',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => '_event_start_date',
            'value' => $event_start,
            'compare' => '>=',
            'type' => 'DATETIME'
        ),
    )
);

if (!empty($campus_id)) {
    $looparg['tax_query'][] = array(
        'taxonomy' => 'campus',
        'field' => 'term_id',
        'terms' => $campus_id,
    );
} else {
    $looparg['meta_query'][] = array(
        'key' => '_featured',
        'value' => 1
    );

}

$loop = new WP_Query($looparg);

if ($loop->have_posts()) {
    ?>
    <section class="events_grid featured_events">
        <div class="row">
            <?php

            while ($loop->have_posts()) : $loop->the_post();
                $metaData = get_post_meta(get_the_ID());
                ?>
                <div class="col-lg-7 latest_event">
                    <picture>
                        <source media="(min-width:466px)"
                                srcset="<?php if (!empty(get_the_post_thumbnail_url(get_the_ID(), 'featured-event-thumb-desktop'))) {
                                    echo get_the_post_thumbnail_url(get_the_ID(), 'featured-event-thumb-desktop');
                                } else {
                                    echo get_template_directory_uri() . "/dist/images/palmer-placehold-event.png";
                                } ?>">
                        <source media="(max-width:465px)"
                                srcset="<?php if (!empty(get_the_post_thumbnail_url(get_the_ID(), 'featured-event-thumb-mobile'))) {
                                    echo get_the_post_thumbnail_url(get_the_ID(), 'featured-event-thumb-mobile');
                                } else {
                                    echo get_template_directory_uri() . "/dist/images/palmer-placehold.png";
                                } ?>">
                        <img src="<?php if (!empty(get_the_post_thumbnail_url(get_the_ID()))) {
                            echo get_the_post_thumbnail_url(get_the_ID());
                        } else {
                            echo get_template_directory_uri() . "/dist/images/palmer-placehold-event.png";
                        } ?>">
                    </picture>
                    <div class="campus_events">
                        <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="event d-flex">
                            <div class="date">
                                <p class="month text-center color-purple">
                                    <?php
                                    $time = strtotime($metaData['_event_start_date'][0]);
                                    echo $month = date("M", $time);
                                    ?>
                                </p>
                                <p class="day text-center color-purple">
                                    <?php
                                    echo $day = date("d", $time);
                                    ?>
                                </p>
                            </div>
                            <div class="event_details">
                                <p class="campus_name color-white">
                                    <?php
                                    $campuses = get_the_terms(get_the_ID(), 'campus');
                                    foreach ($campuses as $campus) {
                                        $campus_name[] = $campus->name;
                                    }
                                    echo implode(',', $campus_name);
                                    ?>
                                </p>
                                <p class="h2 color-white"><?php echo get_the_title(); ?></p>
                                <p class="timings color-white">
                                    <?php if ($metaData['_event_start_time'][0]) {
                                        $amorpm_of_starttime = date("a", strtotime($metaData['_event_start_time'][0]));
                                        $amorpm_of_endtime = date("a", strtotime($metaData['_event_end_time'][0]));
                                        echo date("g:i", strtotime($metaData['_event_start_time'][0])) . ' ' . trim(chunk_split($amorpm_of_starttime, 1, '.')) . ' - ' . date("g:i", strtotime($metaData['_event_end_time'][0])) . ' ' . trim(chunk_split($amorpm_of_endtime, 1, '.'));
                                    } else {
                                        echo "All Day";
                                    } ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>

            <div class="col-lg-5 event_grid_column">
                <p class="heading color-white">
                    Trending Events
                </p>
                <div class="campus_events">
                    <?php
                    global $post;
                    $loopar = array(
                        'post_type' => 'event_listing',
                        'posts_per_page' => 4,
                        'offset' => 1,
                        'meta_key' => '_event_start_date',
                        'orderby' => '_event_start_date',
                        'order' => 'ASC',
                        'meta_type' => 'DATE',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => '_event_start_date',
                                'value' => $event_start,
                                'compare' => '>=',
                                'type' => 'DATE'
                            ),
                        )
                    );

                    if (!empty($campus_id)) {
                        $loopar['tax_query'][] = array(
                            'taxonomy' => 'campus',
                            'field' => 'term_id',
                            'terms' => $campus_id,
                        );
                    } else {
                        $loopar['meta_query'][] = array(
                            'key' => '_featured',
                            'value' => 1
                        );
                    }

                    $looplist = new WP_Query($loopar);

                    while ($looplist->have_posts()) : $looplist->the_post();
                        $metaData = get_post_meta(get_the_ID());

                        // Timezone
                        $timezone = $metaData['_timezone'][0];
                        switch ($timezone) {
                            case "America/Anchorage":
                                $timezone = '(AKT)';
                                break;
                            case "America/Boise":
                                $timezone = '(MT)';
                                break;
                            case "America/Chicago":
                                $timezone = '(CT)';
                                break;
                            case "America/Los_Angeles":
                                $timezone = '(PT)';
                                break;
                            case "America/New_York":
                                $timezone = '(ET)';
                                break;
                            case "Pacific/Honolulu":
                                $timezone = '(HT)';
                                break;
                            case "America/Puerto_Rico":
                                $timezone = '(AST)';
                                break;
                        }
                        ?>
                        <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="event d-flex">
                            <div class="date">
                                <p class="month text-center color-purple">
                                    <?php
                                    $time = strtotime($metaData['_event_start_date'][0]);
                                    echo $month = date("M", $time);
                                    ?>
                                </p>
                                <p class="day text-center color-purple">
                                    <?php
                                    echo $day = date("d", $time);
                                    ?>
                                </p>
                            </div>
                            <div class="event_details">
                                <p class="name color-white"><?php echo get_the_title(); ?></p>
                                <p class="timings color-lightgold">
                                    <?php if ($metaData['_event_start_time'][0]) {
                                        $amorpm_of_starttime = date("a", strtotime($metaData['_event_start_time'][0]));
                                        $amorpm_of_endtime = date("a", strtotime($metaData['_event_end_time'][0]));
                                        echo date("g:i", strtotime($metaData['_event_start_time'][0])) . ' ' . trim(chunk_split($amorpm_of_starttime, 1, '.')) . ' - ' . date("g:i", strtotime($metaData['_event_end_time'][0])) . ' ' . trim(chunk_split($amorpm_of_endtime, 1, '.'));
                                    } else {
                                        echo "All Day";
                                    } ?>
                                    <?php echo $timezone; ?>
                                </p>
                            </div>
                        </a>
                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
