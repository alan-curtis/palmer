<?php if (!empty($args)) {
    if ($args['columns'] == 4) {
        $columns = "col-lg-3 col-md-6";
    }
    if ($args['columns'] == 3) {
        $columns = "col-lg-4 col-md-6";
    }
    ?>
    <section class="token-grid-section bg-white <?php echo $args['title'] ? '' : "pt-0" ?>">
        <div class="container">
            <div class="row">
                <?php if ($args['title']) {
                    ?>
                    <div class="col-12">
                        <div class="color-purple text-md-left text-center token-grid-title"><?php echo $args['title']; ?></div>
                    </div>
                    <?php
                }
                $i = 1;
                foreach ($args['items'] as $stat) {
                    $path_info = pathinfo($stat['url_txt']);
                    $argument='';
                    if($path_info['extension']=='pdf' || $path_info['extension']=='pptx' || $path_info['extension']=='docx'){
                     $argument="download ";
                 }
                 else{
                     $argument="target='_blank'";   
                 }
                 ?>
                 <<?php if ($stat['url_txt']) {
                    echo "a ".$argument." href=".$stat['url_txt'];
                } else {
                    echo "div";
                } ?> class="<?php echo $columns; ?> token d-flex text-center align-items-center flex-column">
                <div class="icon-wrap">
                    <?php
                    if ($args['token_style'] == 'number') {
                    ?>
                     <div class="number font-weight-bold color-white d-flex align-items-center justify-content-center"><?php echo $i; ?></div>
                    <?php    }
                    if ($args['token_style'] == 'icon') {
                        echo $style = $stat['icon'];
                    }
                    ?>
                <div class="token-title"><?php echo $stat['title']; ?></div>
            </div>
            <p class="caption"><?php echo $stat['caption']; ?></p>
            </<?php if ($stat['url_txt']) {
                echo "a";
            } else {
                echo "div";
            } ?>>
            <?php
            $i++;
        } ?>
    </div>
</div>
</section>
<?php
} ?>