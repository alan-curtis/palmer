<?php $inc=rand(999,111); ?>
<section class="fullwidthmediasection px-md-4">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            if (!empty($args)) {
                ?>
                <div class="carousel-item <?php
                echo "active";
                ?>">
                    <img class="d-block w-100" src="<?php echo $args['image']['url']; ?>"
                         alt="<?php echo $args['image']['alt']; ?>">
                    <div class="verticalline"></div>
                    <?php if(!empty($args['title'])) { ?>
                    <div class="carousel-caption">
                        <?php if(!empty($args['title'])){ ?> <h2 class="color-grey"><?php echo $args['title'];   ?></h2> <?php } ?>
                        <?php if(!empty($args['body'])){ ?><div class="content"><?php echo $args['body']; ?></div><?php } ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <a class="morelink color-lightpurple"
                               href="<?php if(!empty($args['link']['url'])) { echo $args['link']['url']; }  ?>"><?php  if (!empty($args['link']['title'])) {  echo $args['link']['title']; } ?>
                            </a>
                            <?php

                        ?>

                        <?php if ($args['video_embed']) {

                            ?>
                            <button type="button" role="button" title="Play Video" video-url="<?php echo $args['video_embed']; ?>" id="playfullwidthvideo<?php echo $inc; ?><?php echo strtolower(preg_replace('/[^a-zA-Z0-9]+/', '',trim($args['title']))); ?>"><i class="fa fa-play color-lightpurple"
                                                          aria-hidden="true"></i></button>
                            <?php
                        } ?>

                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<script>
    $(function(){
        $("#playfullwidthvideo<?php echo $inc; ?><?php echo strtolower(preg_replace('/[^a-zA-Z0-9]+/', '',trim($args['title']))); ?>").videoPopup({
            autoplay: 1,
            mute: 1,
            controlsColor: 'white',
            showVideoInformations: 0,
            width: 1000,
            customOptions: {
                rel: 0,
                end: 60
            }
        });

    });

    $(document).ready(function(){
        $('#playfullwidthvideo<?php echo $inc; ?><?php echo strtolower(preg_replace('/[^a-zA-Z0-9]+/', '',trim($args['title']))); ?>').click(function(){
          $('iframe')[0].src += "&mute=1";
      });

    });
</script>