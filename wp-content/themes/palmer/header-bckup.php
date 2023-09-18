<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/dist/images/favicon.png" type="image/png"/>
    <?php wp_head(); ?>
</head>
<body class="<?php generateBodyClass(); ?>">
<?php wp_body_open(); ?>
<header>
    <div class="container">
        <div class="row">
            <div class="d-flex px-0">
                <div class="col-md-4 pl-0 d-flex align-items-center">
                    <?php
                    if (have_rows('header', 'option')) {
                        while (have_rows('header', 'option')) {
                            the_row();

                            $logo = get_sub_field('header_logo');
                            $logo_tagline = get_sub_field('header_tagline');
                            $headermenu = get_sub_field('header_menu'); //topmenu id
                            $headermenuslug = wp_get_nav_menu_object($headermenu)->slug; //top menu slug
                            $quicklinksmenuid = get_sub_field('quicklinks_menu');//Quick links menu id
                            $quicklinksmenu = wp_get_nav_menu_items($quicklinksmenuid); //Quick links menu object

                            if (!empty($logo)) {
                                ?>
                                <a class="branding" href="<?php echo home_url(); ?>">
                                    <img src="<?php echo $logo['url']; ?>" alt="logo">
                                </a>
                                <?php if (!empty($logo_tagline)) { ?>
                                    <img src="<?php echo $logo_tagline['url']; ?>" alt="logo tagline">
                                    <?php

                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-8 navbar navbar-expand-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-end float-right">
                                <ul class="navbar-nav top-nav-bar">
                                    <li class="nav-item dropdown">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'header-menu',
                                            'container_class' => 'top-header-menu-wrapper',
                                            'menu_class' => 'top-header__menu__list d-flex',
                                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                                            'add_li_class' => 'fws-list-items',
                                        ));
                                        ?>
                                    </li>
                                </ul>
                                <ul class="navbar-nav quicklinks-nav-bar">
                                    <div class="dropdown">
                                        <button class="text-uppercase dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Quicklinks
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?php
                                            foreach ($quicklinksmenu as $quickmenuitem) {
                                                ?>
                                                <a class="dropdown-item"
                                                   href="<?php echo $quickmenuitem->url; ?>"><?php echo $quickmenuitem->title; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </ul>

                            </div>
                            <div class="row justify-content-end main-menu-nav-bar float-right">
                                <ul class="d-flex main-menu-nav-bar float-right">
                                    <?php
                                    // Generated Main Menu HTML
                                    echo generateMenuHTML($headermenuslug);
                                    ?>
                                    <li><i class="fa fa-search"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</header>
