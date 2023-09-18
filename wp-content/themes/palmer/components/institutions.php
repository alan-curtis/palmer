<?php
$apiKey = get_option('wpgmza_google_maps_api_key');
$mapUrl = "https://maps.googleapis.com/maps/api/js?key={$apiKey}";
?>
<section class="institutions-section">

    <form id="institution-form" method="POST">

        <div class="row">

            <div class="col-12">
                <h2 class="color-purple">Participating Institution Search</h2>
                <div id="institutionsMap" style="height:446px;width:100%;"></div>
                <script async defer src="<?php echo $mapUrl; ?>">
                </script>

                <script type="text/javascript">


                </script>

            </div>

            <div class="col-md-4">
                <div class="d-flex flex-column filter">
                    <label>Institution State</label>
                    <select id="inst_select">

                        <option value="">- All -</option>

                        <?php
                        $parms = array('post_type' => 'institution', // your post type
                            'posts_per_page' => -1, // grab all the posts
                            'meta_key' => 'state',
                            'meta_compare' => 'EXISTS', // make sure the post have this acf value
                            'orderby' => 'state',
                            'order' => 'ASC');

                        $states_value = array();
                        $states_label = array();
                        $query = new WP_Query($parms);
                        $c = 0;
                        while ($query->have_posts()): $query->the_post();
                            $states_value[$c] = get_field('state', get_the_ID())['value'];
                            $states_label[$c] = get_field('state', get_the_ID())['label'];
                            $c++;
                        endwhile;
                        wp_reset_query();
                        $states_values_array = array_values(array_unique($states_value));
                        $states_labels_array = array_values(array_unique($states_label));
                        foreach ($states_labels_array as $key => $value) {
                            ?>
                            <option value="<?php echo $states_values_array[$key]; ?>"><?php echo $value; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex flex-column filter">

                    <label>Palmer Campus</label>
                    <select id="campus_select">
                        <option value="">- All -</option>
                        <?php
                        $parm = array('post_type' => 'institution', // your post type
                            'posts_per_page' => -1, // grab all the posts
                            'tax_query' => array(array('taxonomy' => 'campus', 'operator' => 'EXISTS'),),);

                        $quer = new WP_Query($parm);

                        while ($quer->have_posts()): $quer->the_post();

                            $terms = get_the_terms(get_the_ID(), 'campus');
                            foreach ($terms as $term) {
                                ?>
                                <option data-id="<?php echo $term->term_id; ?>" value="<?php echo $term->slug; ?>"><?php echo $term->name; ?>
                                </option>
                                <?php
                            }
                            ?>
                        <?php
                        endwhile;

                        wp_reset_query();
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex flex-column filter">
                    <label>Agreement</label>
                    <select id="agree_select">
                        <option value="">- All -</option>
                        <?php
                        $parms = array('post_type' => 'institution', // your post type
                            'posts_per_page' => -1, // grab all the posts
                            'meta_key' => 'agreement',
                            'meta_compare' => 'EXISTS' // make sure the post have this acf value
                        );

                        $query = new WP_Query($parms);

                        while ($query->have_posts()): $query->the_post();
                            // because the image value is saved as attachment_id
                            ?>
                            <option value="<?php echo get_field('agreement', get_the_ID())['value']; ?>"><?php echo get_field('agreement', get_the_ID())['label']; ?>
                            </option>
                        <?php
                        endwhile;

                        wp_reset_query();
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="buttons d-flex">
                    <input type="reset" name="reset" value="Clear Filters">
                    <input type="submit" name="submit" value="Search">
                </div>
            </div>

        </div>

    </form>

    <div class="row">

        <div class="col-12">
            <h2 class="color-purple">Participating Schools</h2>
        </div>

        <div class="col-12">
            <div class="institutions_listing accordian-section bg-white p-0">
                <?php

                $args = array('post_type' => 'institution', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC',);

                $loop = new WP_Query($args);
                ?>

                <?php
                $s = 1;
                $i = 1;
                ?>
                <div class="row">
                    <div class="panel-group" id="accordion">

                    </div>
                </div>

            </div>
        </div>

    </div>

</section>


