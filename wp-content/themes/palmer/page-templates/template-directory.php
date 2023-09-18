<?php
/*
* Template Name: Directory
* Template Post Type: landing_page
*/
get_header();
?>
<div class="template-directory">
    <div class="container">
        <div class="row">
            <section class="title-wrapper text-center col-md-12">
                <h1><?php echo get_the_title() ?> </h1>
                <div class="breadcrumb "><?php get_breadcrumb(); ?></div>
            </section>
            <section class="person-campus-wrapper w-100">
                <nav class="tabs col-md-6 mx-auto ">
                    <ul class="d-flex justify-content-center">
                        <?php
                        $event_campus = get_terms(array('taxonomy' => 'campus'), array('hide_empty' => false, 'orderby' => 'id', 'order' => 'asc'));
                        foreach ($event_campus as $index => $campus) {
                        ?>
                            <li data-id="<?php echo $campus->term_id  ?>" data-slug="<?php echo $campus->slug ?>" class="<?php echo $index == 0 ? 'is-active' : '' ?> "><a href="#<?php echo $campus->slug ?>"><?php echo $campus->name; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <section class="search-wrapper" id="directory-search">
                    <form method="get">
                        <label for="#search-input-directory-page">
                            Search
                        </label>
                        <div class="input-wrapper">
                            <input name="search" placeholder="Who are you looking for?" type="text" id="search-input-directory-page" />
                            <button type="submit" id="submit-button-search-page" name="submit" value="Search">Search</button>
                            <button class="ml-xl-4" id="reset-button-search-page" name="reset" value="Reset">Reset</button>
                        </div>
                    </form>
                </section>

                <?php
                foreach ($event_campus as $index => $campus) {
                ?>
                    <section class="person-campus-content <?php echo $index == 0 ? 'is-active' : '' ?> " id="<?php echo $campus->slug ?>">
                        <?php
                        echo do_shortcode("[directory_ajax_filter  campus_id='$campus->term_id' campus='$campus->slug']");
                        ?>
                    </section>
                <?php
                }
                echo the_content();
                ?>
                <div id="directory_pagination">
                    <div class="pagination-directory container">
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php


get_footer(); ?>
