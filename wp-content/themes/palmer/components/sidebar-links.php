<section class=" bg-white">
	<div class="container">
		<div class="related-links-block">
			<h5><?php echo $args['title']; ?></h5>
			<ul>
				<?php foreach($args['links'] as $link){
					?>
					<li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?><i class="fa fa-angle-right"></i> </a></li>
					<?php
				} ?>
			</ul>
		</div>
	</div>	 
</section>

