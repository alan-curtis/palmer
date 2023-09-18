<section class="events_grid">
	<div class="container">
		<div class="row">
			<div class="col-md-9"><div class="h1 event_grid_heading color-white"><?php echo $args['title']; ?></div></div>
			<?php if(!empty($args['link']['title'])){
				?>
				<div class="col-md-3 directory d-flex align-items-center justify-content-lg-end"><a href="<?php echo $args['link']['url']; ?>" class="directory-link color-white"><?php echo $args['link']['title']; ?></a></div>
				<?php
			} ?>
        </div>
        <div class="row justify-content-center">
			<div class="col-lg-4 event_grid_column">
				<p class="campus_name color-white">
					<?php
					$term = get_term_by('slug','main-campus','campus');
					echo $name = $term->name;
					$event_term = $args['type_taxonomy'];
					$event_name = $event_term->name;
					?>



				</p>
				<div class="campus_events">


					<?php
					global $post;
					$loop = new WP_Query(
						array('post_type' => 'event_listing',
							'posts_per_page' => 2,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'campus',
									'field' => 'slug',
									'terms' => 'main-campus',
									'operator' => 'AND',
								),
								array(
									'taxonomy' => 'event_listing_type',
									'field' => 'name',
									'terms' =>  $event_name,
									'operator' => 'AND',
								),
							),
							'meta_query' => array(
          array(
						'meta_key'    => '_event_start_date',
						'value' => date('Y-m-d'),
						'compare' => '>=',
            'type' => 'DATETIME'
					),
				),
							'orderby'     => 'meta_value date',
							'order'       => 'asc',
						)
					);
					while ($loop->have_posts()) : $loop->the_post();
						$metaData=get_post_meta(get_the_ID());

                      		$now = time(); // or your date as well
                      		$your_date = strtotime($metaData['_event_start_date'][0]);

                        // Timezone
                        $timezone = $metaData['_timezone'][0];
                        switch ($timezone) {
                            case "America/Anchorage":
                                $timezone = '(AKT)';
                                break;
                            case "America/Boise":
                                $timezone = '(MT)';
                                break;
                            case "America/Chicago":
                                $timezone = '(CT)';
                                break;
                            case "America/Los_Angeles":
                                $timezone = '(PT)';
                                break;
                            case "America/New_York":
                                $timezone = '(ET)';
                                break;
                            case "Pacific/Honolulu":
                                $timezone = '(HT)';
                                break;
                            case "America/Puerto_Rico":
                                $timezone = '(AST)';
                                break;
                        }

                      		$datediff =  $your_date - $now;

                      		if(round($datediff / (60 * 60 * 24)) >= 0){

                      			?>
                      			<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="event d-flex">
                      				<div class="date">
                      					<p class="month text-center color-purple">
                      						<?php
                      						$time=strtotime($metaData['_event_start_date'][0]);
                      						echo $month=date("M",$time);
                      						?>
                      					</p>
                      					<p class="day text-center color-purple">
                      						<?php
                      						echo $day=date("d",$time);
                      						?>
                      					</p>
                      				</div>
                      				<div class="event_details">
                      					<p class="name color-white"><?php echo get_the_title(); ?></p>
                      					<p class="timings color-lightgold">
                      						<?php if($metaData['_event_start_time'][0]){
                      								$amorpm_of_starttime=date("a", strtotime($metaData['_event_start_time'][0]));
                      					     	$amorpm_of_endtime=date("a", strtotime($metaData['_event_end_time'][0]));
                      							echo date("g:i", strtotime($metaData['_event_start_time'][0])).' '.trim( chunk_split($amorpm_of_starttime, 1, '.') ).' - '.date("g:i", strtotime($metaData['_event_end_time'][0])).' '.trim( chunk_split($amorpm_of_endtime, 1, '.') ) ;

                      						}else{
                      							echo "All Day";
                      						} ?>
                                            <?php echo $timezone; ?>
                      					</p>
                      				</div>
                      			</a>
                      			<?php
                      		}
                      		?>
                      		<?php
                //echo $metaData['_event_end_date'][0];
                      	endwhile;
												wp_reset_query();
                      	?>
                      </div>
                  </div>
                  <div class="col-lg-4 toggleclass_2">
                  	<p class="campus_name color-white">
                  		<?php
                  		$term = get_term_by('slug','florida-campus','campus');
                  		echo $name = $term->name;
											$event_term = $args['type_taxonomy'];
											$event_name = $event_term->name;
                  		?>
                  	</p>
                  	<div class="campus_events">
                  		<?php
                  		global $post;
                  		$looping = new WP_Query(
												array('post_type' => 'event_listing',
													'posts_per_page' => 3,
													'tax_query' => array(
														'relation' => 'AND',
														array(
															'taxonomy' => 'campus',
															'field' => 'slug',
															'terms' => 'florida-campus',
															'operator' => 'AND',
														),
														array(
															'taxonomy' => 'event_listing_type',
															'field' => 'name',
															'terms' =>  $event_name,
															'operator' => 'AND',
														),
													),
													'meta_query' => array(
						          array(
												'meta_key'    => '_event_start_date',
												'value' => date('Y-m-d'),
												'compare' => '>=',
						            'type' => 'DATETIME'
											),
										),
													'orderby'     => 'meta_value date',
													'order'       => 'asc',
												)
											);
                  		while ($looping->have_posts()) : $looping->the_post();
                  			$metaData=get_post_meta(get_the_ID());
						$now = time(); // or your date as well
						$your_date = strtotime($metaData['_event_start_date'][0]);

                            // Timezone
                            $timezone = $metaData['_timezone'][0];
                            switch ($timezone) {
                                case "America/Anchorage":
                                    $timezone = '(AKT)';
                                    break;
                                case "America/Boise":
                                    $timezone = '(MT)';
                                    break;
                                case "America/Chicago":
                                    $timezone = '(CT)';
                                    break;
                                case "America/Los_Angeles":
                                    $timezone = '(PT)';
                                    break;
                                case "America/New_York":
                                    $timezone = '(ET)';
                                    break;
                                case "Pacific/Honolulu":
                                    $timezone = '(HT)';
                                    break;
                                case "America/Puerto_Rico":
                                    $timezone = '(AST)';
                                    break;
                            }

						$datediff =  $your_date - $now;

						if(round($datediff / (60 * 60 * 24)) >= 0){
							?>
							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="event d-flex">
								<div class="date">
									<p class="month text-center color-purple">
										<?php
										$time=strtotime($metaData['_event_start_date'][0]);
										echo $month=date("M",$time);
										?>
									</p>
									<p class="day text-center color-purple">
										<?php
										echo $day=date("d",$time);
										?>
									</p>
								</div>
								<div class="event_details">
									<p class="name color-white"><?php echo get_the_title(); ?></p>
									<p class="timings color-lightgold">
										<?php if($metaData['_event_start_time'][0]){
												$amorpm_of_starttime=date("a", strtotime($metaData['_event_start_time'][0]));
                      					     	$amorpm_of_endtime=date("a", strtotime($metaData['_event_end_time'][0]));
                      							echo date("g:i", strtotime($metaData['_event_start_time'][0])).' '.trim( chunk_split($amorpm_of_starttime, 1, '.') ).' - '.date("g:i", strtotime($metaData['_event_end_time'][0])).' '.trim( chunk_split($amorpm_of_endtime, 1, '.') ) ;

										}else{
											echo "All Day";
										} ?>
                                        <?php echo $timezone; ?>
									</p>
								</div>
							</a>
							<?php
						}
						?>

						<?php
                //echo $metaData['_event_end_date'][0];
					endwhile;
					wp_reset_query();
					?>
				</div>
			</div>
			<!--<div class="col-lg-4 toggleclass_3">
				<p class="campus_name color-white">
					<?php
/*					$term = get_term_by('slug','west-campus','campus');
					echo $name = $term->name;
					*/?>
				</p>
				<div class="campus_events">
					<?php /*
					global $post;
					$loop = new WP_Query(
						array('post_type' => 'event_listing',
							'posts_per_page' => 2,
							'tax_query' => array(
								array(
									'taxonomy' => 'campus',
									'field' => 'slug',
									'terms' => 'west-campus',
								),
							),
							'meta_key'    => '_event_start_date',
							'orderby'     => 'meta_value',
							'order'       => 'desc',
						)
					);
					while ($loop->have_posts()) : $loop->the_post();
						$metaData=get_post_meta(get_the_ID());


		               $now = time(); // or your date as well
		               $your_date = strtotime($metaData['_event_start_date'][0]);
		               $datediff =  $your_date - $now;

		               if(round($datediff / (60 * 60 * 24)) >= 0){
		               	*/?>
		               	<a href="<?php /*echo get_the_permalink(get_the_ID()); */?>" class="event d-flex">
		               		<div class="date">
		               			<p class="month text-center color-purple">
		               				<?php
/*		               				$time=strtotime($metaData['_event_start_date'][0]);
		               				echo $month=date("M",$time);
		               				*/?>
		               			</p>
		               			<p class="day text-center color-purple">
		               				<?php
/*		               				echo $day=date("d",$time);
		               				*/?>
		               			</p>
		               		</div>
		               		<div class="event_details">
		               			<p class="name color-white"><?php /*echo get_the_title(); */?></p>
		               			<p class="timings color-lightgold">
		               				<?php /*if($metaData['_event_start_time'][0]){
		               						$amorpm_of_starttime=date("a", strtotime($metaData['_event_start_time'][0]));
                      					     	$amorpm_of_endtime=date("a", strtotime($metaData['_event_end_time'][0]));
                      							echo date("g:i", strtotime($metaData['_event_start_time'][0])).' '.trim( chunk_split($amorpm_of_starttime, 1, '.') ).' - '.date("g:i", strtotime($metaData['_event_end_time'][0])).' '.trim( chunk_split($amorpm_of_endtime, 1, '.') ) ;

		               				}else{
		               					echo "All Day";
		               				} */?>
		               			</p>
		               		</div>
		               	</a>
		               	<?php
/*		               }
		               */?>
		               <?php
/*                //echo $metaData['_event_end_date'][0];
		           endwhile;
		            wp_reset_postdata();
		           */?>
		       </div>
		   </div>-->
		   <a class="color-white text-center w-100" id="hide">load less</a>
		   <a class="color-white text-center w-100" id="show">load more</a>
		</div>
	</div>
</section>
