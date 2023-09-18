 <?php if ($args['enable_image_block_body'] == 1) { ?>
     <section class="bg-white flexible-ctablocks imageblocks-large">
         <div class="container">
             <div class="row ">
                 <?php if (!empty($args['title'])) {
                    ?>
                     <div class="col-12">
                         <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                     </div>
                 <?php
                    } ?>
                 <div class="col-12">
                     <!-- <h1 class="color-purple text-center"><?php echo $args['title']; ?></h1> -->
                 </div>
                 <div class="d-none d-sm-flex flex-wrap flex-wrap-nowrap  wrapper-el">
                     <?php
                        $i = 1;
                        foreach ($args['image_blocks'] as $ctablock) {

                            $link_type =   $ctablock['image_block']['link_type'];
                            $url = "";
                            if ($link_type == "url") {
                                $url = $ctablock['image_block']['link_url'];
                            } else {
                                $url = "mailto:" . $ctablock["image_block"]["link_email"];
                            }
                        ?>
                         <div class="col-lg-6 py-3 col-md-6 wrapper-item">
                             <img src="<?php echo $ctablock['image_block']['image']['url']; ?>">
                             <div class="card  mx-md-3">
                                 <h3><?php echo $ctablock['image_block']['title']; ?></h3>
                                 <div class="blurb"><?php echo $ctablock['image_block']['body']; ?></div>
                                 <a href="<?php echo $url; ?>" class="morelink "><?php if (!empty($ctablock['image_block']['link_url'] || !empty($ctablock['image_block']['link_email'])) && !empty($ctablock['image_block']['link_text'])) {
                                                                                        echo $ctablock['image_block']['link_text'];
                                                                                    } elseif (!empty($ctablock['image_block']['link_url']) || !empty($ctablock['image_block']['link_email']) && empty($ctablock['image_block']['link_text'])) {
                                                                                        echo "Learn More";
                                                                                    }  ?></a>
                             </div>
                         </div>
                     <?php
                            $i++;
                        }
                        ?>
                 </div>

                 <div class="d-sm-none imageblocks-large-slider slider">
                     <?php
                        $i = 1;
                        foreach ($args['image_blocks'] as $ctablock) {



                            $link_type =   $ctablock['image_block']['link_type'];
                            $url = "";
                            if ($link_type == "url") {
                                $url = $ctablock['image_block']['link_url'];
                            } else {
                                $url = "mailto:" . $ctablock["image_block"]["link_email"];
                            }
                        ?>
                         <div class="py-3 col-12 wrapper-item">
                             <img src="<?php echo $ctablock['image_block']['image']['url']; ?>">
                             <div class="card  mx-md-3">
                                 <h3><?php echo $ctablock['image_block']['title']; ?></h3>
                                 <div class="blurb"><?php echo $ctablock['image_block']['body']; ?></div>
                                 <a href="<?php echo $url; ?>" class="morelink "><?php if (!empty($ctablock['image_block']['link_url']) || !empty($ctablock['image_block']['link_email']) && !empty($ctablock['image_block']['link_text'])) {
                                                                                        echo $ctablock['image_block']['link_text'];
                                                                                    } elseif (!empty($ctablock['image_block']['link_url']) || !empty($ctablock['image_block']['link_email']) && empty($ctablock['image_block']['link_text'])) {
                                                                                        echo "Learn More";
                                                                                    }  ?></a>
                             </div>
                         </div>
                     <?php
                            $i++;
                        }
                        ?>
                 </div>

             </div>
         </div>
     </section>

 <?php } else {
    ?>
     <section class="bg-white imagesblocks-small">
         <div class="container">
             <div class="row justify-content-center wrapper-el">
                 <?php if (!empty($args['title'])) {
                    ?>
                     <div class="col-12">
                         <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                     </div>
                 <?php
                    } ?>
                 <?php
                    if (!empty($args['image_blocks'])) {
                        $i = 1;
                        foreach ($args['image_blocks'] as $ctablock) {

                            $link_type =   $ctablock['image_block']['link_type'];
                            $url = "";
                            if ($link_type == "url") {
                                $url = $ctablock['image_block']['link_url'];
                            } else {
                                $url = "mailto:" . $ctablock["image_block"]["link_email"];
                            }
                    ?>
                         <<?php if ($ctablock['image_block']['link_url'] || $ctablock["image_block"]["link_email"]) {
                                echo "a";
                            } else {
                                echo "div";
                            } ?> class="col-lg-6 py-3 wrapper-item  col-md-6 block columnheight" href="<?php echo $url; ?>">
                             <div class="grad_img_wrap ">
                                 <div class="gradient_overlay"></div>
                                 <img src="<?php echo $ctablock['image_block']['image']['url']; ?>">
                             </div>
                             <div class="card  mx-3">
                                 <div class="morelink no-color"><?php if (!empty($ctablock['image_block']['title'])) {
                                                                        echo $ctablock['image_block']['title'];
                                                                    } ?>
                                 </div>
                             </div>
                         </<?php if ($ctablock['image_block']['link_url'] || $ctablock["image_block"]["link_email"]) {
                                echo "a";
                            } else {
                                echo "div";
                            } ?>>
                 <?php
                            $i++;
                        }
                    }
                    ?>
             </div>
         </div>
     </section>
 <?php
    }
    ?>