
	<div class="image-grid-block d-none d-md-block <?php echo $args['overlay_style']; ?>">
		<div class="row m-0">
			 <?php if(!empty($args['title'])){
                ?>
                <div class="col-12">
                    <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                </div>
                <?php 
            } ?>
			<div class="col-lg-8 pr-lg-2 mb-4 mb-lg-0 pl-0">
				 <div class="left-image-grid">
					<img src="<?php echo $args['featured_item']['image']['url']; ?>">
					<?php if(!empty($args['featured_item']['title']) || !empty($args['featured_item']['link']['title'])){ ?>
					<div class="img-grid-caption">
						<?php if(!empty($args['featured_item']['title'])){
							?>
							<h2><?php echo $args['featured_item']['title']; ?></h2>
							<?php
						} ?>
						<?php if(!empty($args['featured_item']['caption'])){ echo $args['featured_item']['caption']; }  ?>
						<?php if(!empty($args['featured_item']['link']['title'])){
							?>
							<a href="<?php echo $args['featured_item']['link']['url']; ?>"><?php echo $args['featured_item']['link']['title']; ?></a>
						<?php }
						?>
					</div>
					<?php
				}
					?>
				</div>
			</div>
			<div class="col-lg-4 pr-0">
                <div class="right-image-grid">
				<?php
				$i=1;
				foreach($args['items'] as $item){
					if($i==1){
						$class="right-image-top";
					}
					elseif($i==2){
						$class="right-image-bottom";
					}
					?>
					<div class="<?php echo $class; ?>">
						<img src="<?php echo $item['image']['url']; ?>">
						<?php if(!empty($item['title']) || !empty($item['link']['title'])){ ?>
						<div class="img-grid-caption">
							<?php if(!empty($item['title'])){
								?>
								<h2><?php echo $item['title']; ?></h2>
								<?php
							} ?>
							
							<?php if(!empty($item['link']['title'])){
								?>

								<a href="<?php echo $item['link']['url']; ?>"><?php echo $item['link']['title']; ?></a>

								<?php
							} ?>
						</div>
					<?php } ?>
					</div>
					<?php
					$i++;     
				} ?>
                </div>
			</div>
		</div>
	</div>

	<div class="image-grid-block d-md-none"> 
	 <?php if(!empty($args['title'])){
                ?>
                <div class="col-12">
                    <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                </div>
                <?php 
            } ?>         
		<div class="image-grid slider">
			<div class="slide-main right-image-featured">
				<img src="<?php echo $args['featured_item']['image']['url']; ?>">
				<div class="header-text">
					<h2 class="title"><?php echo $args['featured_item']['title']; ?></h2>
					<?php if(!empty($item['link']['title'])){
						?>
						<?php if(!empty($args['featured_item']['caption'])){ echo $args['featured_item']['caption']; }  ?>
						<?php if(!empty($args['featured_item']['link']['title'])){
							?>
							<a class="morelink" href="<?php echo $args['featured_item']['link']['url']; ?>"><?php echo $args['featured_item']['link']['title']; ?></a>
						<?php }
						?>
						<?php
					} ?>
				</div>
			</div>
			<?php
			$i=1;
			foreach($args['items'] as $item){
				if($i==1){
					$class="right-image-top";
				}
				elseif($i==2){
					$class="right-image-bottom";
				}
				?>
				<div class="slide-main <?php echo $class; ?>">
					<img src="<?php echo $item['image']['url']; ?>">
					<?php if(!empty($item['title'])){ ?>
					<div class="header-text">
						<h2 class="title"><?php echo $item['title']; ?></h2>
						<?php if(!empty($item['link']['title'])){
							?>
							<a class="morelink" href="<?php echo $item['link']['url']; ?>"><?php echo $item['link']['title']; ?></a>
							<?php
						} ?>
					</div>
				<?php } ?>
				</div>
				<?php
				$i++;
			} ?>
		</div>
	</div>	
