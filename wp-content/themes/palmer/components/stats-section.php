<?php if (!empty($args)) {
?>
    <section class="statssection" id="counter-box">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="color-white text-center"><?php echo $args['title']; ?></h1>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p class="color-white text-center"><?php echo $args['caption']; ?></p>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12 buttons_wrap text-center">
                    <?php
                    if ($args['links']) {
                        foreach ($args['links'] as $link) {
                    ?>
                            <a class="morelink color-lightgold" href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?> <i class="fa fa-arrow-right"></i> </a>
                    <?php
                        }
                    }
                    ?>
                </div>

                <?php foreach ($args['stats'] as $stat) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 d-flex text-center align-items-center flex-column stat mb-sm-5 mb-md-5 mb-lg-0">
                        <div class="icon-wrap">
                            <div class="imgBox">
                                <img class="mx-auto" src="<?php echo $stat['image']['url']; ?>" alt="<?php echo $stat['image']['alt']; ?>">
                            </div>
                            <h2 class="color-lightgold">
                                <span class="prefix" data-prefix="<?php echo trim($stat['prefix']); ?>">
                                    <?php echo trim($stat['prefix']); ?>
                                </span>
                                <span class="counter" data-number="<?php echo $stat['number']; ?>"></span>
                                <span class="suffix" data-suffix="<?php echo trim($stat['suffix']); ?>">
                                    <?php echo trim($stat['suffix']);  ?>
                                </span>
                            </h2>
                        </div>
                        <p class="color-white"><?php echo $stat['caption']; ?></p>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </section>
<?php
} ?>