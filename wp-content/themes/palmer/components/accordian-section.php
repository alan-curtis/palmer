<section class="accordian-section bg-white">
	<div class="container">
		<div class="row">
			 <?php
			 $accordion_id = get_sub_field('accordion_id');
			 if(!empty($args['title'])){
                ?>
                <div class="col-12">
                    <p class="h1 color-purple text-center"><?php echo $args['title']; ?></p>
                </div>
                <?php
            }

						?>

			    <div class="panel-group" id="accordion">
			        <?php
			        $s=1;
			        $i = 1;
			        foreach ($args['accordion_items'] as $items) {
			            ?>
			            <div class="panel panel-default col-lg-3 col-md-4 col-12 col-sm-6 text-sm-left text-center mb-4 collapsed">
			            	<h4 class="text-left d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_<?php echo $s; ?><?php echo $accordion_id; ?>" aria-expanded="<?php if($s==1){ echo 'true';} ?>"><?php echo $items['title']; ?>
			            	</h4>
			                <div id="collapse_<?php echo $s; ?><?php echo $accordion_id; ?>" class="panel-collapse collapse" >
			                    <div class="text-left my-5"><?php echo $items['body']; ?></div>
			                </div>
			            </div>
			            <?php
			            $i++;
			            $s++;
			        } ?>
			    </div>

		</div>
	</div>
</section>
