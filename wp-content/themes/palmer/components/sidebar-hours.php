
    <div class="sidebar-hours">
         <div class="row">
             <div class="col-12">
                <div class="hrs_wrap">
                    <p class="title">Library Hours</p>
                    <ul>
                        <?php 
                        foreach($args['items'] as $item){
                        ?>
                        <li class="d-flex align-items-center">
                            <i class="fa fa-clock-o"></i><p class="hours"><b><?php echo $item['title']; ?></b> <span><?php echo $item['hours']; ?></span></p>
                        </li>
                        <?php
                        }
                         ?>   
                    </ul>
                    <img class="clock_hand d-block d-md-none" src="<?php echo get_template_directory_uri(); ?>/dist/images/Vector.svg">
                    <img class="clock_circum d-block d-md-none" src="<?php echo get_template_directory_uri(); ?>/dist/images/Vector-clock1.svg">
               </div>
            </div>
        </div>
    </div>
