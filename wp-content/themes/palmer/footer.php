<div class="footer-border"></div>
<footer>
    <div class="container">
        <?php
        if (have_rows('footer', 'option')) {
            while (have_rows('footer', 'option')) {
                the_row();
                $footerlogo = get_sub_field('footer_logo');
                $footerctas = get_sub_field('footer_ctas');
                $socialicons = get_sub_field('social_icons');
                $footermenucolumns = get_sub_field('footer_menu_columns');
                $footercopyright = get_sub_field('footer_copyright');
            }
        }
        ?>
        <div class="row">
            <div class="col-md-4 footer-logo">
                <div class="logobox">
                    <?php
                    if (!empty($footerlogo)) {
                        ?>
                        <a href="<?php echo home_url(); ?>">
                            <img class="mx-auto mx-sm-0" src="<?php echo $footerlogo['url']; ?>" class="img-fluid"
                                 alt="drglow-footer-logo">
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6 d-sm-flex align-items-center justify-content-md-end justify-content-sm-start justify-content-center ctas">
                <?php
                foreach ($footerctas as $ctas) {
                    ?>
                    <li class="text-center text-sm-left text-md-center">
                        <a class="h4"
                           href="<?php echo $ctas['cta_link']['url']; ?>"><?php echo $ctas['cta_link']['title']; ?></a>
                    </li>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="tabs-columns row footer-menu-columns">
            <div class="panel-group" id="accordion">
                <?php
                foreach ($footermenucolumns as $index => $columns) {
                    $menuitemsobject = wp_get_nav_menu_items($columns['menu']);
                    if (!empty($menuitemsobject)) {
                        ?>
                        <div class="panel panel-default col-lg-3 col-md-4 col-12 col-sm-6 text-sm-left text-center">
                            <p class="smalltext text-sm-uppercase
                        <?php if ($index != 0) {
                                echo 'collapsed';
                            } ?>" data-toggle="collapse" data-parent="#accordion"
                               data-target="#collapse<?php echo $index; ?>" aria-expanded="<?php if ($index == 0) {
                                echo 'true';
                            } ?>"> <?php foreach ($menuitemsobject as $i => $menuitem_top) {
                                    if ($i == 0) {
                                        ?>
                                        <a class="smalltext text-sm-uppercase"
                                           href="<?php echo $menuitem_top->url; ?>"><?php echo $menuitem_top->title; ?></a>
                                        <?php
                                    }
                                } ?>
                            </p>
                            <div id="collapse<?php echo $index; ?>"
                                 class="panel-collapse collapse <?php if ($index == 0) {
                                     echo 'show';
                                 } ?>">
                                <?php
                                foreach ($menuitemsobject as $in => $menuitem) {
                                    if ($in != 0) {
                                        ?><p><a class="color-grey"
                                                href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?></a>
                                        </p><?php }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>

        <div class="default-columns row footer-menu-columns">
            <?php foreach ($footermenucolumns as $columns) {
                $menuitemsobject = wp_get_nav_menu_items($columns['menu']);
                if (!empty($menuitemsobject)) { ?>
                    <div class="col-md-3 text-sm-left text-center menu-column">
                        <div class="items">
                            <?php

                            foreach ($menuitemsobject as $key => $menuitem) {
                                ?>
                                <p><a class="<?php echo $key == 0 ? "smalltext text-uppercase" : "color-grey"; ?>" target="<?php echo $menuitem->target; ?>"
                                      href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?></a></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>

        <div class="socialicons row">
            <div class="col-md-12">
                <ul class="d-flex justify-content-sm-start justify-content-center">
                    <?php foreach ($socialicons as $icons) {
                        ?>
                        <li><a class="color-grey"
                               href="<?php echo $icons['social_url']; ?>"><span class="<?php echo $icons['social_icon']; ?>"></span></a>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
    <div class="section justify-content-center smalltext copyright">
        <div class="col-md-12">
            <?php echo $footercopyright; ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>



<script async src="https://js.sitesearch360.com/plugin/bundle/2465.js"></script>
<script async src="https://siteimproveanalytics.com/js/siteanalyze_66358270.js"></script>
</body>

</html>
