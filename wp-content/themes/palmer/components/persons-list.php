<section class="bg-white persons-list">
    <div class="container">
        <div class="row blocks align-items-center">
            <div class="d-none d-sm-block col-sm-9">
                <h2 class="color-purple"><?php echo $args['title']; ?></h2>
            </div>
            <?php if (!empty($args['link']['title'])) {
            ?>
                <div class="d-none d-sm-block col-sm-3 directory"><a href="<?php echo $args['link']['url']; ?>" class="directory-link color-purple"><?php echo $args['link']['title']; ?></a></div>
        </div>
        <div class="row blocks">
        <?php
            } ?>
        <?php
        foreach ($args['items'] as $item) {
            $link_array = unserialize(get_post_meta($item['person_ref']->ID)['link'][0]);
        ?>
            <div class="d-none d-sm-block col-12 person">
                <div class="d-flex card flex-row">
                    <div class="image">
                        <img src="<?php if (!empty(get_the_post_thumbnail_url($item['person_ref']->ID))) {
                                        echo get_the_post_thumbnail_url($item['person_ref']->ID);
                                    } else {
                                        echo get_template_directory_uri() . "/dist/images/palmer-placehold.png";
                                    } ?>">
                    </div>
                    <div class="content">

                        <a target="<?php if ($link_array['url']) {
                                        echo "_blank";
                                    } ?>" href="<?php if ($link_array['url']) {
                                                                                                    echo $link_array['url'];
                                                                                                } else {
                                                                                                    echo "javascript:void(0)";
                                                                                                } ?>" class="person-name"><?php echo get_the_title($item['person_ref']->ID); ?></a>
                        <ul class="contact-details">
                            <?php if (get_post_meta($item['person_ref']->ID)['email'][0]) {
                            ?>
                                <li class="email color-purple"><i class="fas fa-envelope"></i><a href="mailto: <?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?></a></li>
                            <?php
                            } ?>

                            <?php if (get_post_meta($item['person_ref']->ID)['phone'][0]) {
                            ?>
                                <li class="contact-number color-purple"><i class="fas fa-phone-alt"></i><a href="tel:<?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?></a></li>
                            <?php
                            } ?>
                        </ul>
                        <?php if (!empty(get_post_meta($item['person_ref']->ID)['short_bio'][0])) {
                        ?>
                            <div class="bio"><?php echo get_post_meta($item['person_ref']->ID)['short_bio'][0]; ?></div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
        <div class="row d-sm-none">
            <div class="col-sm-9">
                <h2 class="color-purple"><?php echo $args['title']; ?></h2>
            </div>
            <?php if (!empty($args['link']['title'])) {
            ?>
                <div class="col-sm-3 directory"><a href="<?php echo $args['link']['url']; ?>" class="directory-link color-purple"><?php echo $args['link']['title']; ?></a></div>
            <?php
            } ?>
            <div class="persons-list-slider slider">
                <?php
                foreach ($args['items'] as $item) {
                    $link_array = unserialize(get_post_meta($item['person_ref']->ID)['link'][0]);
                ?>
                    <div class="card">
                        <div class="d-flex title_img_wrap">
                            <img src="<?php if (!empty(get_the_post_thumbnail_url($item['person_ref']->ID))) {
                                            echo get_the_post_thumbnail_url($item['person_ref']->ID);
                                        } else {
                                            echo get_template_directory_uri() . "/dist/images/palmer-placehold.png";
                                        } ?>">
                            <a target="<?php if ($link_array['url']) {
                                            echo "_blank";
                                        } ?>" href="<?php if ($link_array['url']) {
                                                                                                        echo $link_array['url'];
                                                                                                    } else {
                                                                                                        echo "javascript:void(0)";
                                                                                                    } ?>" class="person-name"><?php echo get_the_title($item['person_ref']->ID); ?></a>
                        </div>
                        <div class="content-wrap">
                            <ul class="contact-details">
                                <?php if (get_post_meta($item['person_ref']->ID)['email'][0]) {
                                ?>
                                    <li class="email color-purple"><i class="fas fa-envelope"></i><a href="mailto: <?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['email'][0]; ?></a></li>
                                <?php
                                } ?>

                                <?php if (get_post_meta($item['person_ref']->ID)['phone'][0]) {
                                ?>
                                    <li class="contact-number color-purple"><i class="fas fa-phone-alt"></i><a href="tel:<?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?>"><?php echo get_post_meta($item['person_ref']->ID)['phone'][0]; ?></a></li>
                                <?php
                                } ?>
                            </ul>
                            <p class="bio"><?php echo get_post_meta($item['person_ref']->ID)['short_bio'][0]; ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</section>
