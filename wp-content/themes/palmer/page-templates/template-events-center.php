<?php
/*
* Template Name: Events Center
* Template Post Type: landing_page
*/
    get_header();
    
    event_ajax_filter_scripts();
    
    ?>

    <div class="main-container events-center-template" role="main">
    	<div class="container">
    		<div class="row">
    			<div class="col-12 headline">
    				<p class="h1 color-purple text-center"><?php echo get_the_title(); ?></p>
    				<p class="text-center breadcrumb"><?php echo get_breadcrumb(); ?></p>
    			</div>
    		</div>
    	</div>
    	<?php

    	get_template_part('components/featured-event');
    	?>

    	<section class="d-md-none mobile_filter_header"> 
    		<div class="container">
    		  <div class="row">
    		  	<div class="col-12">
    		  		<div class="header d-flex">
	    		  		<h2>Events</h2>
	    			    <p class="toggle_filter">Filters </p><img src="<?php echo get_template_directory_uri(); ?>/dist/images/toggle.svg">
    		       </div>
    		  	</div>
    		  </div>	
    		</div>
    	</section> 

    	<section class="events">
    		<div class="container">
    			<?php
    			get_template_part('components/event-center-filter');
    			?>
    		</div>
    	</section>			

    	<section class="event-listing">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-2"></div>
    				<div class="col-md-8"><div id="event-list"></div></div>
    				<div class="col-md-2"></div>
    			</div>
    		</div>
    	</section>
    	<section class="events_pagination">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-2"></div>
    				<div class="col-md-8 d-flex">
    					<div class="prev_paginates">
    						<ul>
    							<li class="first page-numbers"><i class="fas fa-angle-double-left"></i> First</li>
    							<li class="prev page-numbers"><i class="fas fa-angle-double-left"></i> Prev</li>
    						</ul>
    					</div>
    					<div id="pagination_events"></div>
    					<div class="next_paginates">
    						<ul>
    							<li class="next page-numbers">Next <i class="fas fa-angle-double-right"></i></li>
    							<li class="last page-numbers">Last <i class="fas fa-angle-double-right"></i></li>
    						</ul>
    					</div>
    				</div>
    				<div class="col-md-2"></div>
    			</div>
    		</div>		
    	</section>
    	<?php
					//Pagination
    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    	$args = array(
    		'post_type' => 'event_listing',
    		'posts_per_page' => 10,
    		'paged' => $paged
    	);       

					// The Query
    	$the_query = new WP_Query($args);
    	?>


    	<div class="pagination-directory container d-none">						    
    		<?php
    		if ($the_query->found_posts > 1) {
    			?>
    			<div class="first-link">
    				« First
    			</div>
    			<?php
    		}
    		?>

    		<?php
    		echo paginate_links(array(
    			'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
    			'total'        => $the_query->max_num_pages,
    			'current'      => max(10, get_query_var('paged')),
    			'format'       => '?paged=%#%',
    			'show_all'     => true,
    			'type'         => 'list',
    			'prev_next'    => true,
    			'prev_text'    => sprintf('<i></i> %1$s', __('‹ Prev', 'text-domain')),
    			'next_text'    => sprintf('%1$s <i></i>', __('Next ›', 'text-domain')),
    			'add_args'     => false,
    			'add_fragment' => '',
    		));

    		if ($the_query->found_posts > 1) {
    			?>
    			<div class="last-link">
    				Last »
    			</div>
    			<?php
    		}
    		?>
    	</div>

    </div>
    <?php get_footer(); ?>