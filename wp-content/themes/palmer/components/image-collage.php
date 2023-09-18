<?php
if (!empty($args)) {
    $i = 1;
    $images_array = array();
    foreach ($args['images'] as $image) {
        $images_array[$i] = $image['image']['url'];
        $images_alt[$i] = $image['image']['alt'];
        $i++;
    }
?>
    <section class="collage-image-section" id="content">
        <img class="crest d-xxl-none" src="<?php echo get_template_directory_uri(); ?>/dist/images/Palmer-Seal-Bg.png" alt="Palmer Seal">
        <div class="container position-relative">
            <img class="crest d-none d-xxl-block" src="<?php echo get_template_directory_uri(); ?>/dist/images/Palmer-Seal-Bg.png" alt="Palmer Seal">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-4 collage-image pr-0">
                    <img src="<?php echo $images_array[1]; ?>" alt="<?php echo $images_alt[1]; ?>">
                    <img src="<?php echo $images_array[2]; ?>" alt="<?php echo $images_alt[2]; ?>">
                </div>
                <div class="col-6 col-md-4 col-lg-4 collage-image pl-0">
                    <img src="<?php echo $images_array[3]; ?>" alt="<?php echo $images_alt[3]; ?>">
                    <img src="<?php echo $images_array[4]; ?>" alt="<?php echo $images_alt[4]; ?>">
                </div>
                <div class="col-12 col-md-4 col-lg-4 content-box">
                    <div class="collage-image-box">
                        <h2 class="color-grey"><?php echo $args['title']; ?></h2>
                        <p><?php echo $args['caption']; ?></p>
                        <?php if (!empty($args['link']['title'])) {
                        ?>
                            <a href="<?php echo $args['link']['url']; ?>" class="morelink color-blue"><?php echo $args['link']['title']; ?></a>
                        <?php
                        } ?>

                    </div>
                </div>
                <!-- <div class="col-3 d-flex align-items-center d-md-none">
                    <img src="<?php //echo get_template_directory_uri();
                                ?>/dist/images/LeftCrstGOLDTraced.png">
                </div> -->
            </div>
        </div>
    </section>
<?php
}
?>
