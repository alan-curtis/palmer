<section class="heroslider hero-section">
    <div id="herocarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators d-lg-none">
            <?php
            $j = 0;
            foreach ($args['slides'] as $slideitem) { ?>
                <li data-target="#herocarousel" data-slide-to="<?php echo $j; ?>"
                    class="<?php echo $j == 0 ? "active" : ""; ?>"></li>
                <?php
                $j++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            if (!empty($args)) {
                $i = 1;
                foreach ($args['slides'] as $slideitem) {
                    if ($slideitem['accent_image'] == true) {
                        $accent_image = 'spine_img';
                    }else {
                        $accent_image = '';
                    }
                    ?>
                    <div class="<?php echo $slideitem['overlay_style']; ?> <?php echo $accent_image; ?> carousel-item <?php echo $i == 1 ? "active" : ""; ?>">
                        <img class="d-block w-100" src="<?php echo $slideitem['image']['sizes']['hero-slider']; ?>" alt="slide">
                        <div class="shadow"></div>
                        <div class="carousel-caption text-left">
                            <?php
                            if (!empty($slideitem['title'])) {
                                ?>
                                <h1><?php echo $slideitem['title']; ?></h1>
                                <?php
                            }
                            if (!empty($slideitem['caption'])) {
                                ?>
                                <p class=""><?php echo $slideitem['caption']; ?></p>
                                <?php
                            }
                            if (!empty($slideitem['link']['title'])) {
                                ?>
                                <a class="morelink" href="<?php echo $slideitem['link']['url']; ?>"><?php echo $slideitem['link']['title']; ?>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
        </div>

        <div id="carouselButtons">
            <button id="playCarousel" type="button" class="btn btn-default btn-xs play-btn">
                <span class="glyphicon glyphicon-pause"></span>
            </button>
            <button id="pauseCarousel" type="button" class="btn btn-default btn-xs pause-btn d-none">
                <span class="glyphicon glyphicon-play"></span>
            </button>
        </div>

        <a class="carousel-control-prev" href="#herocarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#herocarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

