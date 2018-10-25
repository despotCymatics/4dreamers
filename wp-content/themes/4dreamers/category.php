<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'posts_per_page' => 8,
	'paged' => $paged,
	'cat' => $cat
);
//query_posts($args);

global $wp_query;

$pag_args = array(
	'format'       => 'page/%#%',
	'total'        => $wp_query->max_num_pages,
	'current'      => $paged,
	'show_all'     => true,
	'end_size'     => 1,
	'mid_size'     => 2,
	'prev_next'    => True,
	'prev_text'    => '&laquo;',
	'next_text'    => '&raquo;',
	'type'         => 'list',
	'add_args'     => False,
	'add_fragment' => '',
	'before_page_number' => '',
	'after_page_number' => ''
);

$pagination_links = paginate_links( $pag_args );
$paginate_links_html = str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $pagination_links );


get_header();
?>
	<section class="light-gray news-list inner" style="">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="section-title"><?php single_cat_title( '' ); ?></h2>
				</div>
				<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
					<div class="col-sm-3">
						<div class="box">
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail('news-thumb'); ?></a>
							<div class="box-title">
								<span class="date"><?php echo get_the_date("d.m.Y."); ?></span>
								<h3 class="title"><a href="<?php the_permalink();?>"><?php the_title();; ?></a></h3>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php else : ?>
					<!-- No posts found -->
				<?php endif; ?>

			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="pagination-holder">
						<?php echo $paginate_links_html;?>
					</div>
				</div>
			</div>

		</div>
	</section>

<?php get_footer(); ?>