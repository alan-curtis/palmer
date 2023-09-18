<section class="bg-white flexible-ctablocks">
    <div class="container">
        <div class="row">

            <?php
                foreach ($args['wysiwyg_repeater'] as $wysiwyg) {
    ?>
      <div class="col-sm wysiwyg_repeater">


                    <?php echo $wysiwyg['wysiwyg']; ?>
                        </div>
                    <?php
                }
            ?>

        </div>
    </div>
</section>
