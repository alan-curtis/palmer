<div class="container">

<section class="sidebar-cta-buttons">

     <div class="row">
         <div class="col-12">
             <ul>
                <?php foreach($args['buttons'] as $button){
                    ?>
                <li>
                    <a class="d-flex align-items-center justify-content-center" href="<?php echo $button['link']['url']; ?>"><?php echo $button['link']['title']; ?> <i class="fas fa-arrow-right"></i></a>
                </li>
                <?php
                } ?>
            </ul>
        </div>
    </div>
 
</section>
</div>