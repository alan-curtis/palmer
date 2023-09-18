<?php
// Get Header
get_header();
the_post();
?>
<div class="main-container landing-page" role="main">
<?php

  if (have_rows('lp_component_hero')) {
            while (have_rows('lp_component_hero')) {
                the_row();
                if (get_row_layout() == 'hero_slideshow') {

                    get_template_part('components/hero', 'slideshow', $args = array('slides' => get_sub_field('hero_slides')));
                }
                if (get_row_layout() == 'hero_slideshow_125') {
                    $data = get_sub_field('theme');
                    get_template_part('components/hero', 'slideshow-125', $args = array('slides' => get_sub_field('items'),'theme'=>get_sub_field('theme')));
                }
                if (get_row_layout() == 'hero_banner') {
                    get_template_part('components/hero', 'banner', $args = array('image' => get_sub_field('image'),'overlay_style' => get_sub_field('overlay_style'), 'accent_image' => get_sub_field('accent_image')));
                }
                if (get_row_layout() == 'featured_news_carousel') {
                                    get_template_part('components/featured_news_carousel', 'section', $args = array('posts' => get_sub_field('post_refs')));
                }
                if (get_row_layout() == 'hero_video') {
                    get_template_part('components/hero', 'video', $args = array('video' => get_sub_field('video'),'image' => get_sub_field('image'),'title' => get_sub_field('title'),'link' => get_sub_field('link'),'caption' => get_sub_field('caption'), 'overlay_style' => get_sub_field('overlay_style'), 'accent_image' => get_sub_field('accent_image')));
                }

                if (get_row_layout() == 'hero_events') {

                    get_template_part('components/featured', 'event' , $args = array('campus' => get_sub_field('campus')) );
                }

            }
        }

         if (have_rows('component_pre')) {
            while (have_rows('component_pre')) {
                the_row();
                if (get_row_layout() == 'quick_links_bar') {
                    get_template_part('components/quicklinks', 'bar', $args = array('title' => get_sub_field('title'), 'caption' => get_sub_field('caption'), 'link' => get_sub_field('link'), 'quick_links' => get_sub_field('links')));
                }
            }
}



     if (!empty(get_the_content())) {
      ?>
      <div class="container"  id="content">
        <div class="row">
             <div class="col-lg-4 sidebar">
                 <?php
                 $custom_menu = 'true';

                 if (have_rows('lp_components_sidebar')) {
                     while (have_rows('lp_components_sidebar')) {
                         $object_counter++;
                         the_row();
                         if (get_row_layout() == 'sidebar_buttons') {
                             get_template_part('components/sidebar', 'ctabuttons', $args = array('buttons' => get_sub_field('buttons')));
                         }
                         if (get_row_layout() == 'sidebar_links') {
                             get_template_part('components/sidebar', 'links', $args = array('title' => get_sub_field('title'), 'links' => get_sub_field('links')));
                         }
                         if (get_row_layout() == 'sidebar_contacts') {
                             get_template_part('components/sidebar', 'contact', $args = array('contacts' => get_sub_field('contacts')));
                         }
                         if (get_row_layout() == 'wysiwyg') {
                             get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
                         }
                         if (get_row_layout() == 'sidebar_menu') {
                             $custom_menu = 'false';
                             get_template_part('components/sidebar', 'custommenu', $args = array('sidebar_links' => get_sub_field('sidebar_links')));
                         }
                     }
                 }

                 if($custom_menu == 'true') {
                     get_template_part('components/sidebar', 'menu', $args = array('menu' => getMenuId()));
                 }
                 ?>
             </div>
             <div class="col-lg-8 main-column page_content">
                  <?php get_template_part('components/title-breadcrumb', 'section'); ?>
                  <?php the_content(); ?>
             </div>
        </div>
      </div>
      <?php
  }

  if (have_rows('lp_components_full')) {
            while (have_rows('lp_components_full')) {
                the_row();

                if (get_row_layout() == 'quick_links') {
                    get_template_part('components/quicklinks', 'bar', $args = array('title' => get_sub_field('title'), 'caption' => get_sub_field('caption'), 'link' => get_sub_field('link'), 'quick_links' => get_sub_field('links')));
                }

                if (get_row_layout() == 'news_events_combo') {
                            get_template_part('components/news_events_combo', 'section', $args = array('title' => get_sub_field('title'), 'news_posts' => get_sub_field('posts'), 'more_posts_link' => get_sub_field("more_posts_link"), 'events' => get_sub_field("events"), "more_events_link" => get_sub_field("more_events_link") ));
                }
                if (get_row_layout() == 'countdown') {
                    get_template_part('components/countdown', 'section', $args = array('datetime' => get_sub_field('datetime'),'expiration_text' => get_sub_field('expiration_text'),'expiration_title' => get_sub_field('expiration_title')));
                }
                if (get_row_layout() == 'flexible_cta_blocks') {
                    get_template_part('components/flexible', 'ctablocks', $args = array('cta_blocks' => get_sub_field('cta_blocks'), 'title' => get_sub_field('title')));
                } if (get_row_layout() == 'stats_section') {
                    get_template_part('components/stats', 'section', $args = array('title' => get_sub_field('title'), 'caption' => get_sub_field('caption'), 'links' => get_sub_field('links'), 'stats' => get_sub_field('stats')));
                } if (get_row_layout() == 'fullwidth_media_section') {
                    get_template_part('components/fullwidthmedia', 'section', $args = array('image' => get_sub_field('image'), 'video' => get_sub_field('video'), 'title' => get_sub_field('title'), 'body' => get_sub_field('body'), 'link' => get_sub_field('link'),'video_embed' => get_sub_field('video_embed')));
                } if (get_row_layout() == 'fullwidth_slideshow') {
                    get_template_part('components/fullwidth', 'slideshow', $args = array('slides' => get_sub_field('slides'), 'title' => get_sub_field('title')));
                }  if (get_row_layout() == 'image_collage') {
                    get_template_part('components/image', 'collage', $args = array('title' => get_sub_field('title'), 'caption' => get_sub_field('caption'), 'link' => get_sub_field('link'), 'images' => get_sub_field('images')));
                }
                if (get_row_layout() == 'campus_locations') {
                    get_template_part('components/campus', 'locations', $args = array('title' => get_sub_field('title'), 'locations' => get_sub_field('locations')));
                }
                 if (get_row_layout() == 'image_blocks_lg') {
                    get_template_part('components/imageblocks', 'large', $args = array('enable_image_block_body'=>get_sub_field('enable_image_block_body'),'image_blocks' => get_sub_field('image_blocks'), 'columns' => get_sub_field('columns'), 'title' => get_sub_field('title')));
                }
                 if (get_row_layout() == 'featured_media') {
                    get_template_part('components/featured', 'media', $args = array('video_embed_url'=> get_sub_field('video_embed_url'),'body' => get_sub_field('body'),'link' => get_sub_field('link'),'background_color' => get_sub_field('background_color'),'media_position' => get_sub_field('media_position'),'image' => get_sub_field('image'), 'title' => get_sub_field('title'),'subtitle' => get_sub_field('subtitle')));
                }
                if (get_row_layout() == 'image_grid') {
                    get_template_part('components/image', 'grid', $args = array('featured_item' => get_sub_field('featured_item'), 'items' => get_sub_field('items'), 'overlay_style' => get_sub_field('overlay_style'), 'title' => get_sub_field('title')));
                }
                if (get_row_layout() == 'timeline_carousel') {
                    get_template_part('components/timeline', 'carousel', $args = array('title' => get_sub_field('title'), 'items' => get_sub_field('items'), 'hide_timeline' => get_sub_field('hide_timeline')));
                }
                if (get_row_layout() == 'wysiwyg') {
                    get_template_part('components/wysiwyg', 'section', $args = array('body' => get_sub_field('body')));
                }
                if (get_row_layout() == 'persons_grid') {
                    get_template_part('components/persons', 'grid', $args = array('title' => get_sub_field('title'),'items' => get_sub_field('items'),'link' => get_sub_field('link')));
                }
                if (get_row_layout() == 'persons_list') {
                    get_template_part('components/persons', 'list', $args = array('title' => get_sub_field('title'),'items' => get_sub_field('items'),'link' => get_sub_field('link')));
                }
                 if (get_row_layout() == 'news_grid') {
                    get_template_part('components/news', 'grid', $args = array('title' => get_sub_field('title'),'items' => get_sub_field('items'),'link' => get_sub_field('link')));
                }
                if (get_row_layout() == 'events_grid') {
                    get_template_part('components/events', 'grid', $args = array('title' => get_sub_field('title'),'link' => get_sub_field('link'), 'type_taxonomy' => get_sub_field('event_type_taxonomy')));
                }
                if (get_row_layout() == 'accordion') {
                    get_template_part('components/accordian', 'section', $args = array('accordion_items' => get_sub_field('accordion_items'), 'title' => get_sub_field('title')));
                }
                if (get_row_layout() == 'blockquote') {
                    get_template_part('components/blockquote', 'section', $args = array('body' => get_sub_field('body'),'author' => get_sub_field('author'), 'title' => get_sub_field('title')));
                }
                if (get_row_layout() == 'image_gallery') {
                    get_template_part('components/image', 'gallery', $args = array('items' => get_sub_field('items'),'title' => get_sub_field('title')));
                }
                if (get_row_layout() == 'tabs') {
                    get_template_part('components/tabs', 'section', $args = array('tabs' => get_sub_field('tabs'), 'title' => get_sub_field('title')));
                }
                if (get_row_layout() == 'testimonial_carousel') {
                    get_template_part('components/testimonial', 'carousel', $args = array('carousel_items' => get_sub_field('carousel_items'), 'title' => get_sub_field('title')));
                }
                 if (get_row_layout() == 'token_grid') {
                    get_template_part('components/token', 'grid', $args = array(
                    'title' => get_sub_field('title'),
                    'token_style' => get_sub_field('token_style'),
                    'columns' => get_sub_field('columns'),
                    'items' => get_sub_field('items')));
                }
                if (get_row_layout() == 'two_column_cta') {
                   get_template_part('components/two-column', 'cta');
               }
            }
        }
 ?>
</div>
 <?php
//Get Footer
get_footer();
?>
