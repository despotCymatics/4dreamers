<?php
/**
 * The template for displaying all pages
 */
get_header(); ?>

	<div id="primary" class="site-content <?php echo get_post_meta($post->ID,'page_class',true) ;?>">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<section class="light-gray inner" style="">
					<div class="container ">
				    	<div class="row">
				        	<div class="col-sm-12 nopadding">
				            	<?php the_post_thumbnail('news-inner');?>

				            	<div class="inner-news ">
				                    <h2><?php the_title(); ?></h2>
				                    <?php the_content(); ?>
				                </div>
				            </div>
				        </div>
				    </div>
				</section>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>