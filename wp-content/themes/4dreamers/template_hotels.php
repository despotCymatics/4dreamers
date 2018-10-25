<?php 
/*

Template Name: Hotels Template

*/
require_once 'inc/functions.php';

$tax_query_en = array(
			'taxonomy'         => 'category',
			'field'            => 'slug',
			'terms'            => 'hotels', 
			'include_children' => false
);
$tax_query_sr = array(
			'taxonomy'         => 'category',
			'field'            => 'slug',
			'terms'            => 'hoteli', 
			'include_children' => false
);




$news = get_posts(array(
	'post_type'	=> 'post',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
		'tax_query'   => array($tax_query_en,$tax_query_sr),

	'numberposts' => 4,
));

$hotels = get_posts(array(
	'post_type'	=> 'hotel',
	'meta_key'	 => 'city_code',
	//'meta_value' => $cityCode,
));
$hotel_categories = get_terms(array('hotel-category'));

get_header(); 

?>
<!--section class="canvas-block" style="background-color:#2B333A"-->
<section class="canvas-block inner-search" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>')">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-holder inner"><?php require 'search_form/hotel_search.php'; ?></div>
        	</div>
        </div>
    </div>    	 
</section>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/search_query.js"></script>

<?php if(sizeof($hotels)>0){ ?>
	<section class="dark-gray carousel" style="">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('Hotels'); ?></h2></div>
	            <div class="col-sm-12 hotel-categories">
	            	<div class="choose-box">
	                	<a href="#"  class="active"><i class="fa fa-circle-o"></i><i class="fa fa-dot-circle-o"></i> <?php echo pll__('Everything'); ?></a>
	                	<?php for($i=0; $i<sizeof($hotel_categories); $i++){ ?>
							<a class="<?php echo $hotel_categories[$i]->slug?>" href="#"><i class="fa fa-circle-o"></i><i class="fa fa-dot-circle-o"></i> <?php echo $hotel_categories[$i]->name?></a>
	                	<?php } ?>
	                </div>
	            </div>
	            <div class="col-sm-12">
	                <ul id="hotel-content" class="bxslider hotelItems">
	                	<?php for($i=0; $i<sizeof($hotels); $i++){ 

	                		$link = get_permalink(get_page_by_title('Result Page'));
	                		$link .= '?params=ProviderSelection=OnlyAmadeus&Method=HotelSearch&Culture=';
	                		if(get_bloginfo('language') == 'sr-RS') {
	                			$lang = 'sr-Latn-CS';
	                		}else {
	                			$lang = 'en-GB';
	                		}
	                		$link .= $lang;
	                		$link .= '&CityCode='.trim(get_field('city_code',$hotels[$i]->ID));
	                		$link .= '&HotelName='.trim($hotels[$i]->post_title);
	                		$link .= '&CheckInDate='.date('d/m/Y',strtotime("+1 days")).'&CheckOutDate='.date('d/m/Y',strtotime("+4 days"));
	                		$link .= '&RoomAdultChild=1';

	                	?>
		                    <li>
		                    	<div class="box">
		                            <a href="<?php echo $link; ?>"><?php echo  get_the_post_thumbnail($hotels[$i]->ID,'hotel-thumb');?></a>
		                            <div class="box-title">
		                                <p class="title"><a href="#"><?php echo $hotels[$i]->post_title; ?></a></p>
		                                <span class="rating">
		                                	<?php for($j=0; $j<get_field('number_of_stars',$hotels[$i]->ID); $j++){ ?>
		                                		<i class="fa fa-star"></i>
		                                	<?php } ?>
		                                </span>
		                            </div>
		                        </div>
		                    </li>
	                    <?php } ?>
	                </ul>
	            </div>
	        </div>
	    </div>
	</section>
<?php } ?>

<!-- Banner 1 -->
<section class="light-gray news-list" style="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<?php if (get_field('banner_1_code') != "") {
					echo get_field('banner_1_code') ;
				} elseif (get_field('banner_1_image') != "") {	?>
					<a target="_blank" style="text-align:center; display:block; margin:30px 0;" href="<?php echo get_field('banner_1_link'); ?>"><img src="<?php echo get_field('banner_1_image'); ?>"></a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<?php if ( sizeof( $news ) > 0 ) {?>
	<section class="light-gray news-list" style="">
		<div class="container">
	    	<div class="row">
	        	<h2 class="section-title">News</h2>
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
	        
	        <div class="row">
	        	<div class="col-sm-12">
	            	<a href="<?php echo get_permalink(pll_get_post(188)); ?>" class="more"><span>view more</span></a>
	            </div>
	        </div>
	        
	    </div>
	</section>
<?php } ?>

<!-- Banner 2 -->
<section class="light-gray news-list" style="">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<?php if (get_field('banner_2_code') != "") {
					echo get_field('banner_2_code') ;
				} elseif (get_field('banner_2_image') != "") {	?>
					<a target="_blank" style="text-align:center; display:block; margin:30px 0;" href="<?php echo get_field('banner_2_link'); ?>"><img src="<?php echo get_field('banner_2_image'); ?>"></a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<?php
    $the_query = new WP_Query( array ( 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC',  'post_parent' => get_queried_object_id(), 'posts_per_page' => -1 ) );

    if ( is_page() ) {

        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            
            the_content();
        }

        wp_reset_postdata();
    }

?>  

<!-- Footer Banners -->
<?php require_once 'inc/footer-banners.php'; ?>
<?php get_footer(); ?>