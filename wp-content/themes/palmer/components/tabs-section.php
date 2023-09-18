<section class="tabs-section bg-white">
	<div class="container">
		<div class="row">
			<?php if(!empty($args['title'])){
                ?>
                <div class="col-12">
                    <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                </div>
                <?php 
            } ?>
			<div class="col-12">
				<ul class="nav nav-tabs">
					<?php
					$i=1;
					foreach($args['tabs'] as $tab){
						$idForTab=strtolower(str_replace(' ','',trim($tab['title'])));
						?>
						<li <?php if($i==1){echo "class='active'";} ?>><a <?php if($i==1){echo "class='active'";} ?> data-toggle="tab" href="#<?php echo $idForTab; ?>"><?php echo $tab['title']; ?></a></li>
						<?php
						$i++;
					}
					?>
				</ul>
				<div class="tab-content">
					<?php 
					$j=1;
					foreach($args['tabs'] as $tab){
						$idForTab=strtolower(str_replace(' ','',trim($tab['title'])));
						?>
						<div id="<?php echo $idForTab; ?>" class="tab-pane fade <?php if($j==1){echo "in active show";} ?>">
							<?php echo $tab['body']; ?>
						</div>
						<?php
						$j++;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>