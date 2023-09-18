<?php if (!empty($args)) {
    if (count($args['locations']) == 2) {
        $class_center = 'justify-content-center';
    }
    ?>
<section class="bg-white campus-locations">
    <div class="container">
        <div class="row <?php echo $class_center; ?>">
            <div class="col-12">
                <h1 class="color-purple text-center"><?php echo $args['title']; ?></h1>
            </div>
            <?php
            if (!empty($args['locations'])) {
                $i = 1;
                foreach ($args['locations'] as $location) {

                    if ($i == 3) {
                        $borderbottom = 'b-teal';
                    }
                    if ($i == 2) {
                        $borderbottom = 'b-secondarygold';
                    }
                    if ($i == 1) {
                        $borderbottom = 'b-blue';
                    }
                    ?>
                    <div class="col-lg-4 py-3 col-md-6 col-sm-12">
                        <div class="card d-flex text-center align-items-center flex-column <?php echo $borderbottom; ?>">
                        	<img src="<?php echo $location['image']['url']; ?>" alt="<?php echo $location['image']['alt']; ?>">
                        	<div class="iconbox">
                        	<img class="icon mt-5" src="<?php echo $location['icon']['url']; ?>" alt="<?php  $location['icon']['alt']?>">
                            </div>
                            <h3 class="color-purple text-capitalize"><?php echo $location['title']; ?></h3>
                            <h4 class="color-grey text-uppercase"><?php echo $location['location_name']; ?></h4>
                            <div class="links d-flex flex-column">
                            <?php foreach($location['links'] as $link){

                            	?>
                            <a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title'] ?></a>
                            <?php
                            } ?>
                            </div>
                            <p class="address text-uppercase font-weight-bold"><?php echo $location['address_txt']; ?></p>
                            <div class="contactwrap d-flex  color-purple">
                            <a class="smalltext font-weight-bold" href="tel:<?php echo $location['phone_txt']; ?>"><?php echo $location['phone_txt']; ?></a>
                            <a class="smalltext font-weight-bold" href="mailto:<?php echo $location['email']; ?>"> | <?php echo $location['email']; ?></a>
                            </div>
                            <?php if ($location['social_links']): ?>
                                <div class="social-links">
                                    <?php foreach ($location['social_links'] as $social_link) { ?>
                                        <a href="<?php echo $social_link['social_link'] ?>"><?php echo $social_link['social_link'] ?></a>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</section>
 <?php
} ?>
