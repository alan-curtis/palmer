<?php
if($args['accent_image'] == true){
    $accent_image = 'spine_img';
}
?>

<section class="heroslider hero-video hero-section <?php echo $accent_image;?>">
    <div id="herocarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
                $i = 1;
             
                    ?>
                    <div class="<?php echo $args['overlay_style']; ?> carousel-item <?php echo $i == 1 ? "active" : ""; ?>">
                        <img class="preview w-100" src="<?php echo $args['image']['sizes']['hero-slider']; ?>" alt="slide">
                        <video loop muted class="video" id="player">
                        <source src="<?php echo $args['video']['url']; ?>" type="video/mp4">
                        </video>
                        <div class="shadow"></div>
                        <div class="carousel-caption text-left">
                            <?php
                            if (!empty($args['title'])) {
                                ?>
                                <h1><?php echo $args['title']; ?></h1>
                                <?php
                            }
                            if (!empty($args['caption'])) {
                                ?>
                                <p class=""><?php echo $args['caption']; ?></p>
                                <?php
                            }
                            if (!empty($args['link']['title'])) {
                                ?>
                                <a class="morelink" href="<?php echo $args['link']['url']; ?>"><?php echo $args['link']['title']; ?>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <?php
                    $i++;
            ?>
        </div>

        <div id="carouselButtons">
            <button id="playButton" type="button" class="btn btn-default btn-xs pause-btn">
                <span class="glyphicon glyphicon-pause"></span>
            </button>
            <button id="pauseButton" type="button" class="btn btn-default btn-xs play-btn d-none">
                <span class="glyphicon glyphicon-play"></span>
            </button>
        </div>
    </div>
</section>


