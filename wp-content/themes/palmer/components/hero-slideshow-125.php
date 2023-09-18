<section class="heroslider-125 hero-section">
    <div id="herocarousel-125" class="carousel slide <?php echo $args['theme'] ?> " ata-ride="carousel">
        <ol class="carousel-indicators ">
            <?php
            $j = 0;
            foreach ($args['slides'] as $slideitem) {
                if ($j != 0) {
            ?>
                    <li data-target="#herocarousel-125" data-slide-to="<?php echo $j; ?>" class="<?php echo $j == 0 ? "active" : ""; ?>"></li>

                <?php
                }
                ?>

            <?php
                $j++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php

            if (!empty($args)) {

                $i = 1;
                foreach ($args['slides'] as $index => $slideitem) {
                    $slide_theme = "";
                    $image_url = '' ;
                    if ($args['theme'] == 'gold') {
                        $gradient = 'radial-gradient(
                                    73.42% 73.42% at 32.41% 26.58%,
                                    #d5a228 0%,
                                    #ffd570 100%';
                        $slide_theme = 'gold_theme';
                        $image_url= $slideitem['image']['sizes']['hero-slider-125-gold'];
                     
                    } else {
                        $slide_theme = 'normal_theme';
                        $image_url= $slideitem['image']['sizes']['hero-slider-125-normal'];
                    }

                    $site_url = get_site_url();

            ?>
                    <div class="<?php echo  $slide_theme . ' '  ?> carousel-item <?php echo $i == 1 ? "active" : ""; ?>" style="background: <?php echo $image_url ? "url($image_url)"  : "url($site_url/wp-content/themes/palmer/dist/images/static-125-bg.svg)"; ?> ,no-repeat <?php echo $gradient ?  $gradient : "" ?>">
                        <div class="container">
                            <div class="row carousel-caption">
                                <div class="<?php echo $slide_theme = 'gold_theme' ? "col-md-6" : "col-md-3" ?>  col-12 left-section-wrapper ">
                                    <div class="<?php echo $args['theme'] == 'gold' ? "text-left" : "text-center" ?>">
                                        <?php
                                        if (!empty($slideitem["title_section"])) {
                                        ?>
                                            <div class="slide-title"> <?php echo $slideitem["title_section"]["title_line1"]; ?></div>
                                            <div class="slide-year-num"><?php echo $slideitem["title_section"]["title_line2"]; ?></div>
                                            <div class="slide-year-text"><?php echo $slideitem["title_section"]["title_line3"]; ?></div>
                                        <?php
                                        }
                                        if (!empty($slideitem["caption"])) {
                                        ?>
                                            <div class="mobile-caption">
                                                <?php echo $slideitem['caption']; ?>
                                            </div>
                                        <?php
                                        }
                                        if (!empty($slideitem['link']['title'])) {
                                        ?>
                                            <a class="slide-morelink" href="<?php echo $slideitem['link']['url']; ?>"><?php echo $slideitem['link']['title']; ?>

                                            </a>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class=" col-md-6 col-12 right-section-wrapper">
                                    <div class="button-wrapper">
                                        <?php
                                        if (!empty($slideitem["caption"])) {
                                        ?>
                                            <p class="slide-right-caption"><?php echo $slideitem['caption']; ?></p>
                                        <?php
                                        }
                                        if (!empty($slideitem['link']['title']) && $args['theme'] !== 'gold') {
                                        ?>
                                            <a class="slide-morelink" href="<?php echo $slideitem['link']['url']; ?>"><?php echo $slideitem['link']['title']; ?>

                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;
                }
            }
            ?>
        </div>
        <?php

        if ($index != 0) {
        ?>
            <a class="carousel-control-prev" href="#herocarousel-125" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#herocarousel-125" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        <?php
        }
        ?>

    </div>
</section>