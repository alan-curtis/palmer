<?php wp_enqueue_script('library-filter', get_template_directory_uri() . '/dist/js/library-filter.js'); ?>
<section class="library-filter bg-white">
	<div class="container">
		<div class="row">
			<div class="col-12 headline">
				<p class="h1 color-purple text-center"><?php echo get_the_title(); ?></p>
				<p class="text-center breadcrumb"><?php echo get_breadcrumb(); ?></p>
			</div>
		</div>
	</div>

	<div class="filter_wrap" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>);">
		<div class="container">

			<div class="row">
				<div class="col-12">
					<ul class="tabs d-none d-lg-flex">
						<li data-id="" class="active subs">Search Library</li>
						<li class="subs" data-id="Artchap::artchap_artcl">Articles</li>
						<li class="subs" data-id="Book::book_digital">eBooks</li>
						<li class="formatted" format="Audiobook">Books&Media</li>
						<li class="formatted" format="Jrnl">eJournal Titles</li>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="form-wrap">
						<p class="lbel d-none d-lg-block">Search</p>
						<form>
							<p class="lbel d-lg-none">Location</p>
                            <select class="d-lg-none">
                            	<option data-id="" class="active subs">Search everything</option>
                            	<option class="subs" data-id="Artchap::artchap_artcl">Articles</option>
                            	<option class="subs" data-id="Book::book_digital">eBooks</option>
                            	<option class="formatted" data-id="Audiobook">Books&Media</option>
                            	<option class="formatted" data-id="Jrnl">eJournal Titles</option>
                            </select>
                            <p class="lbel d-lg-none">Search</p>
                            <input required type="text" name="" placeholder="What are you looking for?">
                            <input type="submit" value="Search">
                            <a target="_blank" class="advanced" href="https://palmercollegelibrary.on.worldcat.org/advancedsearch">Advanced settings</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

<div class="main-container basic-page" role="main">

<div class="d-lg-none mobile-version-hours">
    <div class="container">
        <div class="row">
            <div class="col-12 sidebar">
                <?php
                if (have_rows('library_components_sidebar')) {
                    while (have_rows('library_components_sidebar')) {
                        the_row();

                        if (get_row_layout() == 'sidebar_hours') {
                        get_template_part('components/sidebar', 'hours', $args = array('items' => get_sub_field('items')));
                        }
												if (get_row_layout() == 'wysiwyg') {
														get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
												}
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php if (have_rows('library_components_full')) {
        while (have_rows('library_components_full')) {
            the_row();

            if (get_row_layout() == 'image_blocks_simple') {
                 get_template_part('components/imageblocks', 'simple', $args = array('title' => get_sub_field('title'),'items' => get_sub_field('items')));
                }

        }
    }
      ?>
</div>


  <div class="container columnsblock">
    <div class="row">
        <div class="col-lg-4 sidebar d-none d-lg-block">
            <?php
            $theme_location = 'library';//your theme location name
            $locations = get_nav_menu_locations();
            $menuID = $locations[$theme_location];
             //If needs to fetch sidebar menu from menu then uncomment below line
             //get_template_part('components/sidebar', 'menu', $args = array('menu' => $menuID));
              ?>
            <?php
            if (have_rows('library_components_sidebar')) {
                while (have_rows('library_components_sidebar')) {
                    the_row();
                    if (get_row_layout() == 'sidebar_menu') {
                        get_template_part('components/sidebar', 'custommenu', $args = array('sidebar_links' => get_sub_field('sidebar_links')));
                    }
                    if (get_row_layout() == 'sidebar_hours') {
                    get_template_part('components/sidebar', 'hours', $args = array('items' => get_sub_field('items')));
                    }
										if (get_row_layout() == 'wysiwyg') {
												get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
										}
                }
            }
            ?>
        </div>
        <div class="col-12 sidebar d-lg-none">
            <?php
            //If needs to fetch sidebar menu from menu then uncomment below line
            //get_template_part('components/sidebar', 'menu', $args = array('menu' => $menuID));
            if (have_rows('library_components_sidebar')) {
                while (have_rows('library_components_sidebar')) {
                    the_row();
                    if (get_row_layout() == 'sidebar_menu') {
                        get_template_part('components/sidebar', 'custommenu', $args = array('sidebar_links' => get_sub_field('sidebar_links')));
                    }
                }
            }

                ?>
        </div>
        <div class="col-lg-8 main-column">

            <?php
            if (!empty(get_the_content())) {
                ?>
                <div class="container page_content">
                    <?php the_content(); ?>
                </div>
                <?php
            }

            if (have_rows('library_components_main')) {
                while (have_rows('library_components_main')) {
                    the_row();

                    if (get_row_layout() == 'accordion') {
                        get_template_part('components/accordian', 'section', $args = array('accordion_items' => get_sub_field('accordion_items'), 'title' => get_sub_field('title')));
                    }

                    if (get_row_layout() == 'wysiwyg') {
                        get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
                    }

                }
            }
            ?>
        </div>
    </div>
</div>


    <div class="d-none d-lg-block">
        <?php

        if (have_rows('library_components_full')) {
            while (have_rows('library_components_full')) {
                the_row();

                if (get_row_layout() == 'image_blocks_simple') {
                 get_template_part('components/imageblocks', 'simple', $args = array('title' => get_sub_field('title'),'items' => get_sub_field('items')));
                }

            }
        }
        ?>
    </div>

</div>
