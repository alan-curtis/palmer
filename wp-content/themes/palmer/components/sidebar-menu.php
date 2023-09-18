<section class="custom-menu-block bg-white">
    <div class="container">
        <div class="sidebar-menu-block">
            <?php
            global $post;
            $menu_args = [
                'menu' => $args['menu'] ?? 0,
                'container'       => 'div',
                'container_id'    => 'nav-main',
                'container_class' => 'sidebar-dynamic-menu',
                "depth" => 3,
                "start_in" => $post->ID,
                "menu_type" => "sidebar_menu",
                'walker' => new Sidebar_Walker()
            ];
            echo wp_nav_menu($menu_args); ?>
        </div>
    </div>
</section>
