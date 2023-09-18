<section class="testimonial-carousel-section bg-white">
    <div class="container">
        <div class="row">
            <?php if (!empty($args['title'])) { ?>
                <div class="col-12">
                    <h1 class="h1 color-purple text-center"><?php echo $args['title']; ?></h1>
                </div>
            <?php } ?>
            <div class="col-md-12">
                <div id="custCarousel-<?php echo $args['obj_count_id'];?>" class="carousel slide" data-ride="false" align="center">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <?php foreach ($args['carousel_items'] as $key => $item) {  ?>
                            <div class="carousel-item <?php if ($key == 0) : ?>active <?php endif; ?>">
                                <div class="row">
                                    <div class="col person-wrapper d-flex">
                                        <div class="person-image-outer">
                                            <div class="person-image">
                                                <img src="<?php echo $item['image']['sizes']['testimonial-image']; ?>" alt="<?php echo $item['image']['alt']; ?>">
                                            </div>
                                        </div>
                                        <div class="person-desc-wrapper">
                                        <div class="person-testimonial">
                                            <div class="lead author">
                                                <?php if (!empty($item['author_url'])) { ?>
                                                    <a href="<?php echo $item['author_url']; ?>">
                                                        <?php echo $item['author']; ?>
                                                    </a>
                                                <?php
                                                } else {
                                                    echo $item['author'];
                                                } ?>
                                             </div>
                                            <div class="quote"><?php echo $item['quote']; ?>
                                            </div>
                                        </div>
                                        <!-- Thumbnails -->
                                        <ol class="carousel-indicators list-inline">
                                            <?php foreach ($args['carousel_items'] as $keythumb => $itemthumb) {  ?>
                                                <li class="list-inline-item <?php if ($keythumb == $key) : ?>active <?php endif; ?>"><a class="selected" data-slide-to="<?php echo $keythumb; ?>" data-target="#custCarousel-<?php echo $args['obj_count_id'];?>"> <img src="<?php echo $itemthumb['image']['sizes']['testimonial-image-thumb']; ?>" alt="<?php echo $itemthumb['image']['alt']; ?>" class="img-fluid"> </a></li>
                                            <?php } ?>
                                        </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
