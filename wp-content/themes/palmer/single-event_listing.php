<?php get_header();
$metaData = get_post_meta(get_the_ID());
 $event_start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
             $event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
             $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
             $event_end_time = get_post_meta(get_the_ID(), '_event_end_time', true);

             $start_d = date('M',strtotime($event_start_date)).' '.date('d',strtotime($event_start_date)).' , '.date('Y',strtotime($event_start_date));

             $end_d = date('M',strtotime($event_end_date)).' '.date('d',strtotime($event_end_date)).' , '.date('Y',strtotime($event_end_date));

            $campuses=get_the_terms(get_the_ID(),'campus');
            foreach($campuses as $campus){
              $campus_name[]= $campus->name;
            }

            $timezone = get_post_meta(get_the_ID(), '_timezone');
            switch ($timezone[0]) {
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

?>
<div class="main-container" id="single_event_temp" role="main">

<?php




 ?>
	<div class="container">
		<div class="row">
			<div class="col-12 headline">
				<h1 class="color-purple text-center"><?php echo get_the_title(); ?></h1>
				<p class="text-center breadcrumb"><?php echo get_breadcrumb(); ?></p>
			</div>
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="row meta-grid">
					<div class="col-lg-6">
						<p class="date"><i class="far fa-calendar">
						</i><?php echo $start_d.' - '.$end_d; ?></p>
                        <p class="time"><i class="fa fa-clock-o"></i>
                            <?php if ($metaData['_event_start_time'][0]) {
                                $amorpm_of_starttime = date("a", strtotime($metaData['_event_start_time'][0]));
                                $amorpm_of_endtime = date("a", strtotime($metaData['_event_end_time'][0]));
                                echo date("g:i", strtotime($metaData['_event_start_time'][0])) . ' ' . trim(chunk_split($amorpm_of_starttime, 1, '.')) . ' - ' . date("g:i", strtotime($metaData['_event_end_time'][0])) . ' ' . trim(chunk_split($amorpm_of_endtime, 1, '.'));
                            } else {
                                echo "All Day";
                            }
                            echo ' '.$timezone; ?>
                        </p>
					</div>
					<div class="col-lg-6">
						<p class="campus"><?php echo  implode(',' , $campus_name ) ; ?></p>
						<p class="location"><?php echo $event_location = get_post_meta(get_the_ID(), '_event_location', true); ?></p>
					</div>
				</div>
				<div class="row" id="content">
					<div class="col-12">

						<div class="sharing">

							<div class="socia">
							<!-- <a target="_blank" class="twitter_share" href="https://twitter.com/share?text=twitter&url=<?php echo get_the_permalink(); ?>"><i class="fa fa-twitter"></i>Tweet</a> -->
							<?php echo do_shortcode('[posts_like_dislike id='.get_the_ID().']');?>

							 <?php echo sharethis_inline_buttons(); ?>
							</div>
						     <a id="cal_add" class="add_to_calender" data-atc-start="<?php echo $event_start_date; ?>" data-atc-end="<?php echo $event_end_date; ?>" data-atc-title="<?php echo get_the_title(); ?>" data-atc-location="<?php echo get_post_meta(get_the_ID(), '_event_location', true); ?>"  data-atc-description="">+ Add to calendar</a>
					         <!-- init Add to calendar -->
					         <script>
					         new atc(document.querySelector('#cal_add'));
					         </script>
					     </div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="wysiwyg-section">
							<?php echo wpautop( get_the_content() ); ?>
						</div>
						<div class="cats">
							<?php
                            $event_types=get_the_terms(get_the_ID(),'event_listing_category');
                            if($event_types){
				            foreach($event_types as $type){
				            $type_link = get_term_link($type->slug, 'event_listing_category');
				            $type=$type->name;
				            ?>
				             <a target="_blank" href="<?php echo $type_link; ?>" class="category"><?php echo $type; ?></a>
				            <?php
				            }
				          }
							 ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>

</div>
<?php
get_footer();
?>
