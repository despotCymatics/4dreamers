<?php 
/*

Template Name: Homepage 

*/
require_once 'inc/model.php';
require_once 'inc/functions.php';

$destinations = get_posts(array(
	'post_type'	  => array('country','city'),
	'orderby'     => 'post_date',
	'order'       => 'DESC',
	'numberposts' => 14,
));

foreach ($destinations as $destination) {
	if( $destination->post_type == 'city' ){
		$temp_country_name =  get_field( 'country_name', $destination->ID );
		if( trim( $temp_country_name ) != ""){
			$destination->country = $temp_country_name;
		}else{
			$city_code =  get_field( 'city_code', $destination->ID );

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
				$destination->country = $temp_country[0]->post_title;;
			}
		}
	}
}

$news = get_posts(array(
	'post_type'   => 'post',
	'orderby'     => 'post_date',
	'order'       => 'DESC',
	'numberposts' => 4,
));

$template = places_template( sizeof($destinations) );
$new_row_array=$template['new_row_array']  ;
$big_element_array = $template['big_element_array'];

get_header(); 
?>
<section class="canvas-block" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>')">
    <div class="container">
        <div class="row">
        	<div class="col-md-12"><?php require 'search_form/search_forms.php'; ?></div>
        </div>
    </div>    	 
</section>

<?php
if (have_posts()) {
	while (have_posts()) : the_post();
		
		if(get_bloginfo('language') == 'sr-RS') $bannerLink = "/sr/letovi/";
		else $bannerLink = "/en/flights/";
		?>
		<section style="">
			<div class="container">
				<div class="row" style="margin-top: 30px;">

          <div class="col-md-12">
            <a href="<?php echo $bannerLink; ?>">
              <img style="margin:20px auto; display: block;" src="/wp-content/uploads/banners/LHGA.png">
            </a>
          </div>
          <div class="col-md-12">
            <a href="<?php echo $bannerLink; ?>">
              <img style="margin:20px auto; display: block;" src="/wp-content/uploads/banners/LH_banner.jpg">
            </a>
          </div>

          <?php if (false) { ?>
					<div class="col-md-4">
						<a href="<?php echo $bannerLink; ?>">
							<img style="margin:20px auto; display: block;" src="/wp-content/uploads/banners/aitalia-barcelona-madrif-ny-300x250.gif">
						</a>
					</div>
					<div class="col-md-4">
						<?php echo do_shortcode(get_the_content()); ?>
					</div>
					<div class="col-md-4">
						<a href="<?php echo $bannerLink; ?>">
							<img style="margin: 20px auto; display: block;" src="/wp-content/uploads/banners/AUS_myGEMÜTLICHKEIT_300x250_B2B_en[5].jpg">
						</a>
					</div>
          <?php } ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php } ?>


<?php require_once 'inc/best_deals_home.php'; ?>

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
	<div class="row">
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
			
		<?php if(in_array($i,$new_row_array)){?>
			</div>

			<?php if($i==6 && sizeof($destinations)>7){ ?>
				<div class="row post-more-btn">
					<div class="col-sm-12">
						<a href="javascript:fourDreamersShowMorePosts();"  class="more"><span><?php echo pll__('view more'); ?></span></a>
					</div>
				</div>
			<?php }?>
			
			<?php if( $i > 5 ){ ?>
				<div class="row post-more" style="display:none;">	
			<?php }else{ ?>
				<div class="row">
			<?php } ?>
		<?php }?>
		
		<?php } ?>
		
			</div><!-- end last row-->
			<div class="row all-destinations" style="display:none;">
				<div class="col-sm-12">
					<?php 
						$dest_slug = 'destinations'; 
						if(get_bloginfo('language') == 'sr-RS') $dest_slug = 'destinacije';
					?>
					<a href="<?php echo get_permalink( get_page_by_path( $dest_slug ) ); ?>"  class="more"><span><?php echo pll__('view more'); ?></span></a>
				</div>
			</div>
		<!--</div> end post-more row-->
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

<?php if ( sizeof( $news ) > 0 ) {?>
	<section class="light-gray news-list" style="">
		<div class="container">
	    	<div class="row">
	        	<h2 class="section-title"><?php echo pll__('News'); ?></h2>
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
			<?php if ( sizeof( $news ) > 3 ) {?>
	        <div class="row">
	        	<div class="col-sm-12">
	            	<a href="<?php echo get_permalink(pll_get_post(188)); ?>" class="more"><span><?php echo pll__('view more'); ?></span></a>
	            </div>
	        </div>
	        <?php } ?>
	    </div>
	</section>
<?php } ?> 

<!-- Footer Banners -->
 <?php require_once 'inc/footer-banners.php'; ?>

<?php get_footer(); ?>