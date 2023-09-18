<?php //echo $args['body'];
//echo $args['author'];
 ?>
 <section class="blockquote-section bg-white">
    <div class="container">
        <div class="row justify-content-end">
            <?php if(!empty($args['title'])){
                ?>
                <div class="col-12">
                    <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                </div>
                <?php 
            } ?>
           
            <div class="col-12 wrapper-quote ">
                <div class="blockquote-content bg-white">
                    <img class="quote-icon" src="<?php echo get_template_directory_uri(); ?>/dist/images/blockquote.svg">
                    <div class="block-body open-sans-26 mb-3"><?php echo $args['body']; ?></div>
                    <p class="font-weight-bold">-<?php echo $args['author']; ?></p>
                </div>
            </div>
        </div>
    </div>
 </section> 