<?php
if (!empty($args)) {
?>
    <section class="fullwidthslideshowsection bg-white">
        <?php
        if (!empty($args['title'])) { ?>
            <h1 class="color-purple text-center"><?php echo $args['title']; ?></h1>
        <?php }
        ?>

        <section class="fullwidthslideshow slider">
            <?php
            foreach ($args['slides'] as $key => $slide) {
                switch ($key) {
                    case 0:
                        $color = 'b-purple';

                        break;
                    case 1:
                        $color = 'b-teal';

                        break;
                    case 2:
                        $color = 'b-secondarygold';

                        break;
                    case 3:
                        $color = 'b-blue';

                        break;
                    default:
                        $color = 'b-purple';
                }

            ?>
                <div class="overflow-hidden <?php echo $color  ?>" data-color="<?php echo $color ?>">

                    <img src="<?php echo $slide["image"]["sizes"]["full-slide-thumb"] ?>" alt="<?php echo $slide['image']['alt']; ?>">
                    <div class="overlay"></div>
                    <div class="header-text">
                        <span class="smalltext caption color-grey <?php echo $color ?>"><?php echo $slide['caption']; ?></span>
                        <div class="page-info">Image <?php echo $key + 1 ?> of <?php echo count($args['slides']) ?></div>
                    </div><!-- /header-text -->
                </div>
            <?php
            }
            ?>
        </section>
    </section>
<?php
}
?>