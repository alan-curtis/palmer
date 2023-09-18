<?php
if ($args['media_position'] == 'media_left') {
	$i = 1;
	$j = 2;
}
if ($args['media_position'] == 'media_right') {
	$i = 2;
	$j = 1;
}
$inc = rand(999, 111);

?>

<section class="featured-media bg-white">
	<?php if ($args['title']) { ?> <h2 class="color-purple text-center"><?php echo $args['title']; ?></h2> <?php } ?>
	<div class="row">
		<div class="order-lg-<?php echo $i; ?> order-1 col-lg-6 p-0 img-block">
			<img class="w-100 thumb_<?php echo $inc; ?>" src="<?php echo $args['image']['url']; ?>">
			<?php
			if (!empty($args['video_embed_url'])) {

				$link = $args['video_embed_url'];

				//echo getDomain($link); // outputs 'example.com'

				if (getDomain($link) == 'youtube.com') {
					$playicon = 'youtubeplayicon';
					$videoiconsrc = get_template_directory_uri() . '/dist/images/youtubeicon.svg';
					$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
					if (empty($video_id[1]))
						$video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
					$video_id = explode("&", $video_id[1]); // Deleting any other params
					$video_id = $video_id[0];
					?>
					<img class="playicon" type="<?php echo $playicon; ?>" data-id="<?php echo $inc; ?>" src="<?php echo $videoiconsrc; ?>">
					<?php
				} elseif (getDomain($link) == 'vimeo.com') {
					$playicon = 'vimeoplayicon';
					$videoiconsrc = get_template_directory_uri() . '/dist/images/generalplayicon.png';
					?>
					<i class="playicon vimeoIcon fa fa-play" type="<?php echo $playicon; ?>" data-id="<?php echo $inc; ?>"></i>
					<?php
				}


				?>


				<div class="wrapiframe" data-id="<?php echo $inc; ?>">
					<?php
					if (getDomain($link) == 'youtube.com') {
						?>
						<iframe data-id="<?php echo $inc; ?>" width="853" height="480" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?php } elseif (getDomain($link) == 'vimeo.com') {
						
						?>
						<iframe data-id="<?php echo $inc; ?>" src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($link, PHP_URL_PATH), 1); ?>?h=ba7556abf4" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
						<?php
					}

					?>
				</div>
				<?php
			}
			?>

		</div>
		<div class="order-lg-<?php echo $j; ?> order-2 text-block col-lg-6 bg-<?php echo $args['background_color']; ?> d-flex flex-column justify-content-center">
			<?php
			if (!empty($args['subtitle'])) { ?>
				<h3 class="color-white"><?php echo $args['subtitle']; ?></h3>
				<?php
			}
			?>

			<div class="blurb color-white"><?php echo $args['body']; ?></div>
			<?php if (!empty($args['link']['title'])) { ?>
				<a class="cta bg-darkpurple color-white" href="<?php if (!empty($args['link']['url'])) {
					echo $args['link']['url'];
				}  ?>"><?php
				if (!empty($args['link']['title'])) {
					echo $args['link']['title'];
				}  ?></a>
			<?php } ?>
		</div>
	</div>

</section>