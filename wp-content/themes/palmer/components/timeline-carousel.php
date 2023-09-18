<?php if(empty($args['hide_timeline'][0])){
	$index_bar_on="index-bar-on";
}
else{
	$index_bar_on="index-bar-off";
}
?>
<section class="timeline-carousel-section <?php echo $index_bar_on; ?>">
	<div class="container">	
		<div class="row">
			<div class="col-12">
			<h1 class="color-purple text-center w-100"><?php echo $args['title']; ?></h1>
		</div>
			<?php if(empty($args['hide_timeline'][0]) && !$args['hide_timeline'][0]=='hide'){
				?>
				<div class="col-md-8 mx-auto">
					<div class="timeline-carousel-nav <?php echo $index_bar_on; ?> nav-slides slider index">
						<?php
						$i=1;
						foreach($args['items'] as $item){
							?>
							<div class="slide-main">
								<?php if(!empty($item['year'])){ ?> 
									<div class="year"><?php echo $item['year']; ?></div>	
									<img class="d-none pointer-drop" src="<?php echo get_template_directory_uri(); ?>/dist/images/drop.png">
								<?php } ?>		
							</div>
							<?php
							$i++;
						} ?>
					</div>
					<!-- <img class="years_bar" src="<?php echo get_template_directory_uri(); ?>/dist/images/bar.png"> -->
				</div> 
				<?php  
			} ?> 
		</div>	 	
		<div class="row">
			<div class="col-md-6">
				<div class="timeline-carousel <?php echo $index_bar_on; ?> slider">			
					<?php foreach($args['items'] as $item){
						?>
						<div class="slide-navs">
							<img src="<?php echo $item['image']['url']; ?>">
						</div>
						<?php
					} ?>		
				</div>
			</div>
			<div class="col-md-6">
				<div class="timeline-carousel-content <?php echo $index_bar_on; ?> slider">			
					<?php foreach($args['items'] as $item){
						?>
						<div class="slide-nav">
							<h3 class="color-purple">
								<?php echo $item['title']; ?>
							</h3>
							<div class="blurb"><?php echo substr($item['body'],0,387); ?></div>
						</div>
						<?php
					} ?>
				</div>
				<div class="nav-buttons d-flex">
					<div class="timeline-index-prev">
						<span class="color-white">Prev</span>
					</div>
					<div class="timeline-index-next">
						<span class="color-white">Next</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
//Timeline carousel section
$(document).ready(function(){
 $('.timeline-carousel.<?php echo $index_bar_on; ?>').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.timeline-carousel-nav.<?php echo $index_bar_on; ?>,.timeline-carousel-content.<?php echo $index_bar_on; ?>',
    infinite: true,
  });
  $('.timeline-carousel-nav.<?php echo $index_bar_on; ?>').slick({
    slidesToShow: 16,
    slidesToScroll: 1,
    asNavFor: '.timeline-carousel.<?php echo $index_bar_on; ?>,.timeline-carousel-content.<?php echo $index_bar_on; ?>',
    //dots: true,
    arrows: false,
    infinite: true,
    //centerMode: true,
    focusOnSelect: true
  });
  $('.timeline-carousel-content.<?php echo $index_bar_on; ?>').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.timeline-carousel.<?php echo $index_bar_on; ?>,.timeline-carousel-nav.<?php echo $index_bar_on; ?>',
    //dots: true,
    arrows: true,
    infinite: true
  });	

//hide empty year slide in timeline carousel
  $(".timeline-carousel-nav.index-bar-on").find('.slick-slide').each(function () {
    $(this).find('.slide-main').each(function () {
      if ($(this).children().length == 0) {
        $(this).addClass('hidemyslide');
        $('.hidemyslide').closest('.slick-slide').hide();
      }
    });
  });

 
 //next and prev buttons functionality for timeline sliders

  $('.timeline-carousel-section.index-bar-on .timeline-index-next').click(function () {
    $('.timeline-carousel-section.index-bar-on .slick-next').click();
  });
  $('.timeline-carousel-section.index-bar-on .timeline-index-prev').click(function () {
    $('.timeline-carousel-section.index-bar-on .slick-prev').click();
  });
  $('.timeline-carousel-section.index-bar-off .timeline-index-next').click(function () {
    $('.timeline-carousel-section.index-bar-off .slick-next').click();
  });
  $('.timeline-carousel-section.index-bar-off .timeline-index-prev').click(function () {
    $('.timeline-carousel-section.index-bar-off .slick-prev').click();
  }); 


});
 
</script>