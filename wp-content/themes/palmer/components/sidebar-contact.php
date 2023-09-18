 <div class="sidebar-contacts bg-white">
 	<div class="container">
        <?php if (!empty(get_sub_field('title'))) { ?>
        <h5><?php echo get_sub_field('title'); ?></h5>
        <?php } ?>
 		<?php
 		foreach($args['contacts'] as $contact){
 			?>
 			<div class="sidebar-contact-block">
 				<ul>
                    <?php if (!empty($contact['title'])) { ?>
                    <li class="contact-name"><i class="fas fa-user"></i><span class="contact-name-text"><?php echo $contact['title']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($contact['address'])){
                        ?>
                    <li class="address"><i class="fas fa-map-marker-alt"></i><a target="_blank" href="https://www.google.com/maps/place/<?php echo $contact['address']['address']; ?>+<?php echo $contact['address']['post_code']; ?>"><?php echo $contact['address']['address']; ?></a></li>
                    <?php
                    } ?>

                    <?php if (!empty($contact['phone'])) { ?>
                        <li class="contact-number">
                            <i class="fas fa-phone-alt"></i>
                            <?php
                            $i = 1;
                            $numbers = count(explode(',', $contact['phone']));
                            foreach (explode(',', $contact['phone']) as $nos) {
                                if ($i > 1 && $i <= $numbers) {
                                    echo ',';
                                }
                                ?>
                                <a href="tel:<?php echo $nos; ?>"><?php echo $nos; ?></a>
                                <?php
                                $i++;
                            }
                            ?>
                        </li>
                        <?php
                    } ?>
                    <?php if(!empty($contact['email'])){
                        ?>
                        <li class="email"><i class="fas fa-envelope"></i><a href="mailto: <?php echo $contact['email']; ?>"><?php echo $contact['email']; ?></a></li>
                        <?php
                    } ?>
 				</ul>
 			</div>
 			<?php
 		}
 		?>
 	</div>
 </div>
