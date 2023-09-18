<section class="bg-white flexible-ctablocks">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="color-purple text-center"><?php echo $args['title']; ?></h1>
            </div>
            <div class="d-none d-sm-flex flex-wrap flex-wrap-nowrap">
            <?php
            if (!empty($args)) {
                $i = 1;
                foreach ($args['cta_blocks'] as $ctablock) {
                    
                    if ($i == 1) {
                        $borderbottom = 'b-purple';
                        $learnmorecolor = 'text-purple';
                    }
                    if ($i == 2) {
                        $borderbottom = 'b-teal';
                        $learnmorecolor = 'text-teal';
                    }
                    if ($i == 3) {
                        $borderbottom = 'b-secondarygold';
                        $learnmorecolor = 'text-secondarygold';
                    }
                    if ($i == 4) {
                        $borderbottom = 'b-blue';
                        $learnmorecolor = 'text-blue';
                    }
                    ?>
                    <a href="<?php echo $ctablock['link']['url']; ?>" target="<?php echo $ctablock['link']['target']; ?>" class="d-none d-sm-block col-lg-3 py-3 py-lg-0 col-sm-6 block <?php  echo "block_".$i;  ?>" data-id="<?php echo $i; ?>">
                        <div class="card <?php echo $borderbottom; ?>">
                            <h3><?php echo $ctablock['title']; ?></h3>
                            <p><?php echo $ctablock['caption']; ?></p>
                            <div class="morelink <?php echo $learnmorecolor; ?>"
                               ><?php echo $ctablock['link']['title']; ?></div>
                        </div>
                    </a>
                    <?php
                    $i++;
                }
            }
            ?>
            </div>

              <div class="d-sm-none flexible-ctablocks-slider slider">
                   <?php 
                    $i = 1;
                    foreach ($args['cta_blocks'] as $ctablock) {

                     if ($i == 1) {
                        $borderbottom = 'b-purple';
                        $learnmorecolor = 'text-purple';
                    }
                    if ($i == 2) {
                        $borderbottom = 'b-teal';
                        $learnmorecolor = 'text-teal';
                    }
                    if ($i == 3) {
                        $borderbottom = 'b-secondarygold';
                        $learnmorecolor = 'text-secondarygold';
                    }
                    if ($i == 4) {
                        $borderbottom = 'b-blue';
                        $learnmorecolor = 'text-blue';
                    }
                          ?>
                          <a href="<?php echo $ctablock['link']['url']; ?>" target="<?php echo $ctablock['link']['target']; ?>" class="card <?php echo $borderbottom; ?> block">
                            <h3><?php echo $ctablock['title']; ?></h3>
                            <p><?php echo $ctablock['caption']; ?></p>
                            <div class="morelink <?php echo $learnmorecolor; ?>"
                               href="<?php echo $ctablock['link']['url']; ?>"><?php echo $ctablock['link']['title']; ?></div>
                        </a>
                          <?php
                          $i++;
                          }
                    ?>
              </div>      
       
        </div>
    </div>
</section>
