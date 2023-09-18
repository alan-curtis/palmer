<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/dist/images/favicon.png" type="image/png"/>
    <?php wp_head(); ?>

    <?php if (!is_user_logged_in()): ?>
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" async="" src="https://www.googleadservices.com/pagead/conversion_async.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-M622HC"></script>

    <!-- Google Tag Manager -->
    <script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
        'gtm.start':
            new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M622HC');
    </script>
    <?php endif; ?>
</head>
<body <?php body_class('class-name'); ?>>
  <?php if (!is_user_logged_in()): ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M622HC" height="0" width="0" style="display: none; visibility: hidden"></iframe>
  </noscript>
  <?php endif; ?>
<?php wp_body_open(); ?>

<header class="d-xl-block d-none desktop-nav">

  <a class="skip-content-link" href="#content">Skip to content</a>
<?php echo get_template_part('components/alert','banner'); ?>

    <div class="container">
        <div class="header-inner-wrapper row align-items-center justify-content-xl-between">
            <div class="brandingwrap d-flex align-items-center">
                <?php
                if (have_rows('header', 'option')) {
                    while (have_rows('header', 'option')) {
                        the_row();
                        //$menuLocation=get_sub_field('top_menu');
                        $logo = get_sub_field('header_logo');
                        $logo_tagline = get_sub_field('header_tagline');
                        $headermenu = get_sub_field('header_menu'); //topmenu id
                        $headermenuslug = wp_get_nav_menu_object($headermenu)->slug; //top menu slug
                        $quicklinksmenuid = get_sub_field('quicklinks_menu');//Quick links menu id
                        $quicklinksmenu = wp_get_nav_menu_items($quicklinksmenuid); //Quick links menu object
                        $ribbon=get_sub_field('ribbon_image');
                        $floating_menu_menuid = get_sub_field('floating_menu');
                        $floating_menu_menu = wp_get_nav_menu_items($floating_menu_menuid);

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
            <div>
                <?php if(!empty($ribbon['url'])){
                  ?>
                  <div class="header-years">
                    <img src="<?php echo $ribbon['url']; ?>" alt="<?php echo $ribbon['alt']; ?>"/>
                  </div>
                  <?php
                } ?>

            </div>
            <div class="navbar navbar-expand-sm d-none d-lg-block">
                <div class="d-flex mr-0 topmenuwrap align-items-center">
                    <?php
                    echo do_shortcode('[multilevel_navigation_menu]');
                    ?>
                    <ul class="navbar-nav quicklinks-nav-bar">
                        <div class="dropdown">
                            <button class="text-uppercase dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quicklinks</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($quicklinksmenu as $quickmenuitem) { ?>
                                    <a class="dropdown-item" href="<?php echo $quickmenuitem->url; ?>"><?php echo $quickmenuitem->title; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="main-menu-nav-bar d-flex justify-content-end">
                    <?php wp_nav_menu( array( 'theme_location' => 'main-nav' ) ); ?>
                    <!-- <ul class="d-flex justify-content-end align-items-center">
                        <?php //echo generateMenuHTML($headermenuslug); ?>

                         <?php
                         $menuitemsobject = wp_get_nav_menu_items(3);
                         foreach ($menuitemsobject as $menuitem) {
                            if($menuitem->menu_item_parent == 0){
                             ?>
                             <li class="nav-item "><a href="<?php //echo $menuitem->url; ?>" class="nav-link h4" title="<?php //echo $menuitem->title; ?>">
                        <?php //echo $menuitem->title; ?></a></li>
                             <?php
                            }
                        ?>

                        <?php
                    }
                    ?>
                    </ul> -->
                    <li><i class="fa fa-search"></i></li>
                </div>

                <div class="floating-menu">
                    <?php foreach ($floating_menu_menu as $quicksmenuitem) { ?>
                        <a class="dropdown-item" href="<?php echo $quicksmenuitem->url; ?>"><?php echo $quicksmenuitem->title; ?></a>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</header>
