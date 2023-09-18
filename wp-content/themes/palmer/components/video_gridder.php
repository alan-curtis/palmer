
<?php $categories=get_field('categories',get_the_ID());
?>

<section class="video-gridder-section bg-white">
	<div class="container position-relative">
		<img class="crest" src="/wp-content/themes/palmer/dist/images/Palmer-Seal-Bg.png">
		<div class="row">

			<div class="col-12 headline">
				<p class="h1 color-purple text-center"><?php echo get_the_title(); ?></p>
				<p class="text-center breadcrumb"><?php echo get_breadcrumb(); ?></p>
			</div>

			<div class="col-12">
				<ul class="nav nav-tabs til-four">
					<?php
					$i=1;
					foreach($categories as $category){
						$idForTab=strtolower(str_replace(' ','',trim($category['title'])));
						?>
						<li <?php if($i==1){echo "class='active'";} ?>>
							<a <?php if($i==1){echo "class='active'";} ?> data-toggle="tab" href="#<?php echo $idForTab; ?>"><?php echo $category['title']; ?>
						</a>
					</li>
					<?php
					$i++;
				}
				?>
			</ul>
		</div>

		<div class="col-md-12">
			<div class="tab-content">
				<?php 
				$j=1;
				foreach($categories as $category){
					$idForTab=strtolower(str_replace(' ','',trim($category['title'])));
					?>
					<div id="<?php echo $idForTab; ?>" class="tab-pane fade <?php if($j==1){echo "in active show";} ?>">
						<div class="row">
							<div class="col-md-4">
								<div class="left_column">
								<?php
								$t=1;
								foreach($category['items'] as $item){
									?>
									<div class="video_title <?php if($t==1){echo "active";} ?>" data-id="<?php echo $t; ?>" video-name="<?php echo strtolower(str_replace(' ','',trim($item['title']))); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/dist/images/play_icon.svg"><p>
											<?php
											echo $item['title'];
											?>
										</p>
									</div>
									<?php
									$t++; 
								}
								?>
							</div>
							</div>
							<div class="col-md-8 right_column">
								<?php
								$u=1;
								foreach($category['items'] as $item){

									?>
									<div class="video_detail <?php if($u==1){echo "active";} ?>" data-id="<?php echo $u; ?>" video-name="<?php echo strtolower(str_replace(' ','',trim($item['title']))); ?>">
										<?php
										echo $item['embed_url'];
										?>

										<div class="video_description">
											<h2 class="video_heading"> <?php echo $item['title']; ?> </h2>
											<?php echo $item['description']; ?>
										</div>
										<div class="video_transcription">
											<h2 class="video_heading"> Transcript </h2>
											<?php echo $item['transcription'];  ?>
										</div> 
										<a class="switch_button"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/switch_button_icon.svg"><span>see transcript</span></a>
									</div>
									<?php
									$u++;
								}
								?>
							</div>
						</div>
					</div> 
					<?php
					$j++;
				}
				?>  
			</div> 
		</div>
         
        <div class="col-12">
				<ul class="nav nav-tabs after-four">
					<?php
					$i=1;
					foreach($categories as $category){
						$idForTab=strtolower(str_replace(' ','',trim($category['title'])));
						?>
						<li <?php if($i==1){echo "class='active'";} ?>>
							<a <?php if($i==1){echo "class='active'";} ?> data-toggle="tab" href="#<?php echo $idForTab; ?>"><?php echo $category['title']; ?>
						</a>
					</li>
					<?php
					$i++;
				}
				?>
			</ul>
		</div> 

	</div>
</div>
</section>