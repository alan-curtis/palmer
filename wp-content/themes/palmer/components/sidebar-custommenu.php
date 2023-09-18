<section class=" bg-white">
	<div class="container">
		<div class="sidebar-menu-block">
			<div id="nav-main" class="sidebar-dynamic-menu">
				<ul id="menu-library" class="menu">
					<?php foreach($args['sidebar_links'] as $links){ ?>
						<li id="menu-item-8133" class="menu-item menu-item-type-post_type menu-item-object-landing_page current-menu-item menu-item-has-children menu-item-8133 nav-item  level-0 menu_list_item">
							<div class="menu-item-parent">
								<a href="<?php echo $links['sidebar_link']['url']; ?>" class="nav-link"><?php echo $links['sidebar_link']['title']; ?>
								</a>
								<?php if(!empty($links['sidebar_child_links'])){
                                ?>
                                <span class="fas collapsed fa-angle-down" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_8133"></span>
                                <?php
								} ?>
							</div>
							<div id="collapse_8133" class="collapse " aria-labelledby="link_collapse_8133" role="tabpanel" data-parent="#accordion" style="display: none;">
								<ul>
									<?php foreach($links['sidebar_child_links'] as $child){
										?>
										<li id="menu-item-8179" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-8179 nav-item level-1 menu_list_item">
											<div class="menu-item-parent">
												<a href="<?php echo $child['sidebar_child_links']['url']; ?>" class="link-item"><?php echo $child['sidebar_child_links']['title']; ?></a>
											</div>
										</li>
										<?php
									} ?>	
								</ul>
							</div>
						</li>
						<?php
					} ?>
				</ul>
			</div>
		</div>
	</div>
</section>