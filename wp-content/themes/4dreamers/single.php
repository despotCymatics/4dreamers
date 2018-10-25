<?php
/**
 * The Template for displaying all single posts
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="light-gray news-list inner" style="">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-12">
            	<div class="featured"><?php the_post_thumbnail('news-inner');?></div>
            	<div class="inner-news">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 

$news = get_posts(array(
	'post_type'    => 'post',
	'orderby'      => 'post_date',
	'order'        => 'DESC',
	'post__not_in' => array($post->ID),
	'numberposts'  => 4,
));

endwhile; ?>

<?php if ( sizeof( $news ) > 0 ) { ?>
	<section class="light-gray news-list" style="">
		<div class="container">
			<h2 class="section-title"><?php echo pll__('view more'); ?></h2>
	    	<div class="row">
	        	<?php for($i=0;$i<sizeof($news);$i++){ ?>
		        	<div class="col-sm-3">
		            	<div class="box">
		                	<a href="<?php echo  get_permalink($news[$i]->ID);?>"><?php echo get_the_post_thumbnail( $news[$i]->ID,  'news-thumb' ) ;?></a>
		                    <div class="box-title">
		                        <span class="date"><?php echo date("d.m.Y.",strtotime($news[$i]->post_date)); ?></span>
		                        <h3 class="title"><a href="<?php echo  get_permalink($news[$i]->ID);?>"><?php echo $news[$i]->post_title; ?></a></h3>
		                    </div>
		                </div>
		            </div>
	            <?php } ?>
	        </div>
	    </div>
	</section>
<?php } ?>
<?php get_footer(); ?>