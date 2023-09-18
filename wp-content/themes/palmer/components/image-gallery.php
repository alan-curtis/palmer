<section class="image-gallery-section">
    <div class="container">
        <div class="row">

<!--            <div class="col-12">-->
<!--                <div class="color-purple text-md-left text-center image-gallery-title">--><?php //echo $args['title']; ?><!--</div>-->
<!--            </div>-->

            <div class="col-12">

                <div class="image-gallery currentslide slider">
                    <?php
                    $noOfSlides = count($args['items']);
                    $i = 1;
                    foreach ($args['items'] as $item) {
                        ?>
                        <div class="slide-main">
                            <img src="<?php echo $item['image']['url']; ?>">
                            <div class="header-text">
                                <span class="slidecount font-weight-bold color-grey d-md-block d-none"><?php echo $i . '/' . $noOfSlides; ?></span>
                                <div class="content smalltext color-grey"><?php echo $item['caption']; ?></div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    } ?>
                </div>

                <div class="image-gallery-navigation">
                    <div class="image-gallery-arrows">
                    </div>
                    <div class="d-md-block d-none image-gallery-nav nav-slides slider">
                        <?php foreach ($args['items'] as $item) {
                            ?>
                            <div class="slide-nav">
                                <img src="<?php echo $item['image']['url']; ?>">
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>