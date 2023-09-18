<div class="news-grid-block bg-white">
	<div class="container">
		<div class="row news-title-heading">
			<div class="col-9">
				<div class="h1 news_title color-purple"><?php echo $args['title']; ?></div>
			</div>
			<?php if (!empty($args['link']['title'])) {
			?>
				<div class="col-3 directory d-flex align-items-center justify-content-end"><a href="<?php echo $args['link']['url']; ?>" class="directory-link color-purple"><?php echo $args['link']['title']; ?></a></div>
			<?php
			} ?>
		</div>
		<div class="row">
			<div class="col-lg-8 pr-lg-2 mb-lg-0">
				<?php

				if (!empty($args['items'])) {
					$j = 1;
					foreach ($args['items'] as $item) {
						if ($j == 2) {
							break;
						}
						$featured_post = $item['post_ref'];
						    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_post->ID ), 'thumbnail-size', true )[0];
						$alt = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_post->ID ), '_wp_attachment_image_alt', true )[0]
				?>
						<a class="post_block left-image-grid" href="<?php echo get_the_permalink($item['post_ref']->ID); ?>">
							<div class="img_wrap">
								<img src="<?php if (!empty(get_the_post_thumbnail_url($item['post_ref']->ID))) {
												echo get_the_post_thumbnail_url($item['post_ref']->ID, 'news-grid-left');
											} else {
												echo get_template_directory_uri() . "/dist/images/palmer-placehold@2x.png";
											}  ?>" alt="<?php echo $item['post_ref']->post_title; ?>">
							</div>
							<div class="img-grid-caption">
								<?php if ($item['post_ref']->post_title) {
								?>
									<p class="post_title"><?php echo $item['post_ref']->post_title; ?></p>
								<?php
								} ?>
                                <p class="date">
                                    <?php $date = $item['post_ref']->post_modified;
                                    echo date("F j, Y", strtotime($date));
                                    ?>
                                </p>
							</div>
						</a>
						<?php
						$j++;
					}
				} else {
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 1
					);
					$post_query = new WP_Query($args);

					if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {
							$post_query->the_post();
							$alt = get_post_meta( $attachment_img->ID, '_wp_attachment_image_alt', true );
						?>
							<a class="post_block left-image-grid" href="<?php echo get_the_permalink(get_the_ID()); ?>">
								<div class="img_wrap">
									<img src="<?php if (!empty(get_the_post_thumbnail_url(get_the_ID()))) {
													echo get_the_post_thumbnail_url(get_the_ID(), 'news-grid-left');
												} else {
													echo get_template_directory_uri() . "/dist/images/palmer-placehold@2x.png";
												}  ?>" alt="<?php echo $alt;
												 ?>">
								</div>
								<div class="img-grid-caption">

									<p class="post_title"><?php echo get_the_title(); ?></p>

									<p class="date"><?php echo get_the_date(); ?></p>
								</div>
							</a>
				<?php
						}
					}
				}
				?>
			</div>
			<div class="col-lg-4">
				<?php
				if (!empty($args['items'])) {
					$i = 0;
					foreach ($args['items'] as $item) {
						$i++;
						if ($i == 1) {
							continue;
						} elseif ($i == 2) {
							$class = "right-image-top";
						} elseif ($i == 3) {
							$class = "right-image-bottom";
						}
				?>
						<a class="post_block <?php echo $class; ?>" href="<?php echo get_the_permalink($item['post_ref']->ID); ?>">
							<div class="img_wrap">
								<img src="<?php if (!empty(get_the_post_thumbnail_url($item['post_ref']->ID))) {
												echo get_the_post_thumbnail_url($item['post_ref']->ID, 'news-grid-right');
											} else {
												echo get_template_directory_uri() . "/dist/images/palmer-placehold@2x.png";
											}  ?>" alt="<?php echo $item['post_ref']->post_title; ?>">
							</div>
							<div class="img-grid-caption">
								<?php if (!empty($item['post_ref']->post_title)) {
								?>
									<p class="post_title"><?php echo $item['post_ref']->post_title; ?></p>
								<?php
								} ?>
                                <p class="date">
                                    <?php $date = $item['post_ref']->post_modified;
                                    echo date("F j, Y", strtotime($date));
                                    ?>
                                </p>
							</div>
						</a>
						<?php
					}
				} else {
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 2,
						'offset' => 1,
					);
					$post_query = new WP_Query($args);

					if ($post_query->have_posts()) {
						$i = 0;
						while ($post_query->have_posts()) {
							$i++;
							if ($i == 1) {
								continue;
							} elseif ($i == 2) {
								$class = "right-image-top";
							} elseif ($i == 3) {
								$class = "right-image-bottom";
							}
							$post_query->the_post();
						?>
							<a class="post_block <?php echo $class; ?>" href="<?php echo get_the_permalink(get_the_ID()); ?>">
								<div class="img_wrap">
									<img src="<?php if (!empty(get_the_post_thumbnail_url(get_the_ID()))) {
													echo get_the_post_thumbnail_url(get_the_ID(),'news-grid-right');
												} else {
													echo get_template_directory_uri() . "/dist/images/palmer-placehold@2x.png";
												}  ?>">
								</div>
								<div class="img-grid-caption">

									<p class="post_title"><?php echo get_the_title(); ?></p>

									<p class="date"><?php echo get_the_date(); ?></p>
								</div>
							</a>
				<?php
						}
						wp_reset_postdata();
					}
				}
				?>

			</div>
		</div>
	</div>
</div>
