<?php if (get_field('footer_banner_1_image') != "" || get_field('footer_banner_2_image') != "" || get_field('footer_banner_3_image') != "" || get_field('footer_banner_1_code') != "" || get_field('footer_banner_2_code') != "" || get_field('footer_banner_3_code') != "") { ?>
<section class="dark-gray banners">
	<div class="container">
    	<div class="row">
    	<?php if (get_field('footer_banner_1_code') != "") { ?>
			<div class="col-sm-4"><?php echo get_field('footer_banner_1_code'); ?></div>
    	<?php }elseif (get_field('footer_banner_1_image') != "") { ?>
        	<div class="col-sm-4">
            	<a target="_blank" href="<?php echo get_field( 'footer_banner_1_link'); ?>"><img src="<?php echo get_field( 'footer_banner_1_image'); ?>"></a>
            </div>
        <?php } ?>
        <?php if (get_field('footer_banner_2_code') != "") { ?>
			<div class="col-sm-4"><?php echo get_field('footer_banner_2_code'); ?></div>
    	<?php }elseif (get_field('footer_banner_2_image') != "") { ?>    
            <div class="col-sm-4">
            	<a target="_blank" href="<?php echo get_field( 'footer_banner_2_link'); ?>"><img src="<?php echo get_field( 'footer_banner_2_image'); ?>"></a>
            </div>
        <?php } ?>
       <?php if (get_field('footer_banner_3_code') != "") { ?>
			<div class="col-sm-4"><?php echo get_field('footer_banner_3_code'); ?></div>
    	<?php }elseif (get_field('footer_banner_3_image') != "") { ?> 
            <div class="col-sm-4">
            	<a target="_blank" href="<?php echo get_field( 'footer_banner_3_link'); ?>"><img src="<?php echo get_field( 'footer_banner_3_image'); ?>"></a>
            </div>
        <?php } ?>   
        </div>
    </div>
</section>
<?php } ?>