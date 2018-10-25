<?php
/**
 * The Template for displaying single place
 */

//wp_head();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="canvas-block" style="min-height:500px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 ><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php the_post_thumbnail(); ?> 
            </div>
             <div class="col-sm-6">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; else : ?>
	
<?php endif; ?>
<?php //wp_footer();