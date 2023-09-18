
<section class="image_blocks_simple">
	<div class="container">
		<div class="row">
			<?php if(!empty($args['title'])){
               ?>
            <div class="col-12">
				<p class="h3 color-purple"><?php echo $args['title']; ?></p>
			</div>
               <?php
			} ?>
			
            
            <div class="col-12">
            	<div class="resource_wrap d-none d-lg-flex">
            		<?php foreach($args['items'] as $item){
                    ?>
                    <a href="<?php echo $item['link']['url']; ?>">
	            		<img src="<?php echo $item['image']['url']; ?>">
	            		<span><?php echo $item['link']['title']; ?></span>
	            		<div class="overlay"></div>
	            	</a>
                    <?php
                    } ?>
            	</div>

                <div class="resource_wrap_slider slider d-lg-none">
                	<?php foreach($args['items'] as $item){
                    ?>
                    <a href="<?php echo $item['link']['url']; ?>">
	            		<img src="<?php echo $item['image']['url']; ?>">
	            		<span><?php echo $item['link']['title']; ?></span>
	            		<div class="overlay"></div>
	            	</a>
                    <?php
                    } ?>
                </div>


            </div>

			<!-- <div class="col-lg-3">
				<a href="#" class="resource">
					<img src="/wp-content/uploads/2022/01/image-14.png">
				</a>	
			</div>
			<div class="col-lg-3">
				<a href="#" class="resource">
					<img src="/wp-content/uploads/2022/01/unsplash_8rNKkypykTg.png">
				</a>		
			</div>
			<div class="col-lg-3">
				<a href="#" class="resource">
					<img src="/wp-content/uploads/2022/01/image-14-2.png">
				</a>
			</div>
			<div class="col-lg-3">
				<a href="#" class="resource">
					<img src="/wp-content/uploads/2022/01/image-14-2.png">
				</a>
			</div>
			<div class="col-lg-3">
				<a href="#" class="resource">
					<img src="/wp-content/uploads/2022/01/image-14-1.png">
				</a>
			</div> -->
		</div>
	</div>	
</section>


<!-- <script type="text/javascript">
	//Resources slider
          $(".resource_wrap_slider").slick({
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  fade: false,
                  arrows: false,
                },
              },
            ],
          });
</script> -->