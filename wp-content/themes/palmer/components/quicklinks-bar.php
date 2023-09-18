<?php
if (!empty($args)) {
?>
    <div id="sticky-anchor"></div>
    <section class="quicklinksbar" id="quicklinksbar">
        <div class="container-fluid">
            <div class="row align-items-center bg-white">
                <div class="col-12 col-xl-4 quick-links-left">
                    <div class="row">
                        <div class="col-10">
                            <h4><?php echo $args['title']; ?></h4>
                            <p><?php echo $args['caption']; ?></p>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo $args['link']['url']; ?>"><i class="quick-links-icon fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8 p-5 p-xl-0 quick-links-right d-md-flex justify-content-center">
                    <?php foreach ($args['quick_links'] as $quick_link) {
                    ?>
                        <a class="d-flex justify-content-center color-white" href="<?php echo $quick_link['link']['url']; ?>">
                            <?php echo $quick_link['link']['title']; ?>
                            <?php echo trim($quick_link['link']['title']) == 'Apply Now' ? '<i class="fa fa-arrow-right"></i>' : ''; ?>

                        </a>
                    <?php
                    } ?>
                </div>

            </div>
        </div>
    </section>
<?php
}
?>