<?php 
/*

Template Name: Destinations Template 

*/
require_once 'inc/model.php';
require_once 'inc/functions.php';

$posts_per_page = 14;
$total_number_of_items = count(get_posts( array('post_type'=> array('country','city'),'posts_per_page' => -1)));
$total_page_number = ceil( $total_number_of_items / $posts_per_page );

$destinations = get_posts(array(
	'post_type'	  => array('country','city'),
	'orderby'     => 'post_date',
	'order'       => 'DESC',
	'numberposts' => $posts_per_page,
));
foreach ($destinations as $place) {
	if( $place->post_type == 'city' ){
		$temp_country_name =  get_field( 'country_name', $place->ID );
		if( trim( $temp_country_name ) != ""){
			$place->country = $temp_country_name;
		}else{
			$city_code =  get_field( 'city_code', $place->ID );

			$city_codes_array= array();
			$cities_form_country = cp_get_popular_cities($city_code);

			foreach ($cities_form_country as $temp_city) {
				array_push($city_codes_array, $temp_city->CityCode);
			}
			$temp_country   =  get_posts(array(
				'post_type'	     => 'country',
				'posts_per_page' => 1,
				'meta_key'		 => 'city_code',
				'meta_query' => array(
						array(
							'key'     => 'city_code',
							'value'   => $city_codes_array,
							'compare' => 'IN',
						),
				),	
			));
			if( count($temp_country) > 0 ){
				$place->country = $temp_country[0]->post_title;;
			}
		}
	}
}


$template = places_template( sizeof($destinations) );
$new_row_array=$template['new_row_array']  ;
$big_element_array = $template['big_element_array'];

get_header(); 
?>
<input id="pagenumber" type="hidden" autocomplete="off" value="1">
<input id="no_items" type="hidden" autocomplete="off" value="<?php echo $total_number_of_items ?>">
<input id="no_perppage" type="hidden" autocomplete="off" value="<?php echo $posts_per_page ?>">
<section class="canvas-block" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>')">
    <div class="container">
        <div class="row">
        	<div class="col-md-12"><?php require 'search_form/search_forms.php'; ?></div>
        </div>
    </div>    	 
</section>

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

<section class="light-gray blog-list" style=""> 
	<div class="container">
	<div class="row destination-list">
        <h2 class="section-title"><?php echo pll__('Destinations'); ?></h2>
		<?php for($i=0;$i<sizeof($destinations);$i++){ 
				$is_big_element = in_array($i,$big_element_array);?>
			<div <?php if($is_big_element){?> class="col-sm-6" <?php }else{ ?> class="col-sm-3"<?php } ?> >
				<div class="box">
					<a href="<?php echo  get_permalink($destinations[$i]->ID);?>" class="title-block">
						<?php if($is_big_element){
								echo get_the_post_thumbnail( $destinations[$i]->ID,  'place-thumb-big' ); 
							}else{
								echo get_the_post_thumbnail( $destinations[$i]->ID,  'place-thumb-small' ); 
							}?> 
						<div class="box-title">
							<?php if(isset($destinations[$i]->country)){ ?>
								 <span class="date"><?php echo $destinations[$i]->country ?></span>
							<?php } ?>
							<h3 class="title"><?php echo $destinations[$i]->post_title; ?></h3>
						</div>
						<?php 
							$offer = getOfferForCity(get_field('city_code',$destinations[$i]->ID));
							if ($offer->Price) { ?>
							<div class="box-price">
								<span class="from"><?php echo pll__('From'); ?></span>								  					
  						<?php if(get_bloginfo('language') == 'sr-RS') { ?>
                				<h3 class="price"><?php echo substr($offer->Price, 0, -3).'RSD'; ?></h3>
                		<?php }else { ?>
								<h3 class="price"><?php echo $offer->Price2.'&euro;'; ?></h3>
               			<?php  } ?>	
							</div>
						<?php } ?>
					</a>
				</div>
			</div>	
		
		<?php } ?>	
	</div><!-- end last row-->
		<?php if($posts_per_page < $total_number_of_items){ ?>
			<div class="row more-button">
				<div class="col-md-12">
					<a href="javascript:fourdreamers_ajax_load_dest_page();"  class="more"><span><?php echo pll__('view more'); ?></span></a>
				</div>
			</div>
		<?php } ?>
	</div><!-- end container-->
</section> 

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

<!-- Footer Banners -->
<?php require_once 'inc/footer-banners.php'; ?>

<?php get_footer(); ?>