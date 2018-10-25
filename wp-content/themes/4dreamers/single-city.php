<?php
/**
 * The Template for displaying city post
 */

get_header();
require_once 'inc/model.php';
require_once 'inc/functions.php';


//City that represents the country and other cities
$cityCode = get_field('city_code');
$offer = getOfferForCity($cityCode);

$allCities = cp_get_popular_cities($cityCode);
$cities_form_country_temp = cp_get_popular_cities($cityCode);
$currentCity = NULL;
$popularCities = array();
$city_codes_populare_cities = array();

foreach ($cities_form_country_temp as $cy) {
	if ($cy->CityCode != $cityCode) {
		array_push($city_codes_populare_cities, $cy->CityCode);
	}else{
		$currentCity = get_posts(array(
			'post_type'		=> 'city',
			'posts_per_page'=> 1,
			'meta_key'		=> 'city_code',
			'meta_value'	=> $cy->CityCode
		));
		$currentCity = $currentCity[0];
		if($cy->TimeZone !=""){
			$date = new DateTime("now", new DateTimeZone($cy->TimeZone) );
			$curretn_time = $date->format('H:i');
		}
	}
}
$popularCities = get_posts(array(
		'post_type'		=> 'city',
		'posts_per_page'=> 7,
		'meta_query'    => array(
								array(
									'key'     => 'city_code',
									'value'   =>  $city_codes_populare_cities,
									'compare' => 'IN',
								),
							),	
));
array_push($city_codes_populare_cities, $cityCode);

$hotels = get_posts(array(
	'post_type'	=> 'hotel',
	'meta_key'	 => 'city_code',
	'meta_value' => $cityCode,
));

if( sizeof($hotels) > 0 ){
	$hotel_categories = array_values( get_terms(array('hotel-category')) );
	
	$no_hotel_categories = sizeof($hotel_categories); 
	for ($i=0; $i < $no_hotel_categories; $i++) { 

		$slug = $hotel_categories[$i]->slug;
		$tax_query = array(
			'taxonomy'         => 'place-category',
			'field'            => 'slug',
			'terms'            =>  $slug, 
			'include_children' => false
		);
		
		$temp_hotel = get_posts(array(
			'post_type'	 => 'place',
			'tax_query'  => array($tax_query),
			'meta_key'	 => 'city_code',
			'meta_value' => $cityCode,
			'posts_per_page' => 1,
		));
	
		if( sizeof( $temp_hotel ) < 1 ){
			unset( $hotel_categories[$i] );
		}
	}
	$hotel_categories = array_values( $hotel_categories );
}


$places = get_posts(array(
	'post_type'	     => 'place',
	'posts_per_page' => 21,
	'meta_key'	 => 'city_code',
	'meta_value' => $cityCode,
				
));


if( sizeof($places) > 0 ){
	$place_categories = array_values( get_terms(array('place-category')) );
	
	$no_place_categories = sizeof($place_categories); 
	for ($i=0; $i < $no_place_categories; $i++) { 

		$slug = $place_categories[$i]->slug;
		$tax_query = array(
			'taxonomy'         => 'place-category',
			'field'            => 'slug',
			'terms'            =>  $slug, 
			'include_children' => false
		);
		
		$temp_place = get_posts(array(
			'post_type'	 => 'place',
			'tax_query'  => array($tax_query),
			'meta_key'	 => 'city_code',
			'meta_value' => $cityCode,
			'posts_per_page' => 1,
		));

		
		if( sizeof( $temp_place ) < 1 ){
			unset( $place_categories[$i] );
		}
	}

	$place_categories = array_values( $place_categories );

}

if(sizeof($popularCities)<7){
	$simular_destinations = get_posts(array(
	'post_type'	=> array('country','city'),
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'numberposts' => (7-(sizeof($popularCities))),
	'meta_query' => array(
		array(
			'key'     => 'city_code',
			'value'   =>  $city_codes_populare_cities,
			'compare' => 'NOT IN',
		),
	),			
	));
	$popularCities=array_merge($popularCities, $simular_destinations);

}

$template = places_template( sizeof($popularCities) );
$new_row_array=$template['new_row_array']  ;
$big_element_array = $template['big_element_array'];

$template = places_template( sizeof($places) );
$new_row_array_place=$template['new_row_array']  ;
$big_element_array_place = $template['big_element_array'];

$country = get_posts(array(
	'post_type'	     => 'country',
	'posts_per_page' => '1',
	'meta_key'	 => 'city_code',
	'meta_query' => array(
		array(
			'key'     => 'city_code',
			'value'   =>  $city_codes_populare_cities,
			'compare' => 'IN',
		),
	),
));

foreach ($popularCities as $place) {
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
				$place->country = $temp_country[0]->post_title;
			}
		}
	}
}

wp_reset_postdata();

$content = get_the_content();

if( strpos( $content, '##' ) != false ){
	$content = str_replace(array('<p>','</p>','<div>','</div>'), '', $content );
	$content = explode( '##', $content, 2);
}

$temperature              = get_field('temperature');
$dry_days                 = get_field('dry_days');
$average_rainfall         = get_field('average_rainfall');
$snow_days                = get_field('snow_days');
$show_weather_information = (trim(get_field('temperature')) != "" || trim(get_field('dry_days')) != "" || trim(get_field('average_rainfall')) != "" || trim(get_field('snow_days')) != "");


$population        = get_field('population');
$currency          = get_field('currency');
$show_demographics = (trim($population) != "" || trim($currency) != "" || isset($curretn_time));


$extra_info_button_text = get_field ( 'extra_info_button_text' );
$extra_info_1           = get_field ( 'extra_info_1' );
$extra_info_2           = get_field ( 'extra_info_2' );
$show_extra_info = ( trim( $extra_info_button_text ) != "" || trim( $extra_info_1 ) != "" || trim( $extra_info_2 ) != "");
$fullTextStyle = "";
$more_about_the_city = get_field ( 'more_about_the_city' );

?>
<input id="city_code" type="hidden" value="<?php echo $cityCode ?>">

<section class="canvas-block country" style="background-image:url(<?php echo  wp_get_attachment_url(get_post_thumbnail_id()) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
				<?php if(sizeof($country)>0){ ?>
               		<h5 class="country_name"><a href="<?php echo get_permalink($country[0]->ID);?>"><?php echo $country[0]->post_title;?></a></h5>
				<?php } elseif( trim( get_field( 'country_name' ) ) != "") {?>
					<h5 class="country_name"><span><?php echo get_field('country_name');?></span></h5>
				<?php } ?>

                <h1 class="destination"><?php the_title(); ?></h1>
                <?php if ($offer->Price) { ?>
  					<p><?php echo pll__('Flights from'); ?></p>
  					<?php if(get_bloginfo('language') == 'sr-RS') { ?>
                		<h1 class="price"><?php echo substr($offer->Price, 0, -3).'RSD'; ?></h1>
                	<?php }else { ?>
						<h1 class="price"><?php echo $offer->Price2.'&euro;'; ?></h1>
                <?php 	} ?>	
                <?php }else {echo '<p class="more_height">&nbsp;</p>';} ?>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
            <?php if( trim( get_field( 'quote' ) ) != "") {?>
            	<blockquote><?php echo get_field( 'quote' ); ?></blockquote>
            </div>
            <?php 	} ?>
        </div>
    </div>
</section>

<section class="canvas-block light-gray about" style="">
	<div class="container">
        <div class="row">
            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('About The City'); ?></h2></div>
            <div class="fullText" style="<?php echo $fullTextStyle; ?>" >
            <?php if(sizeof($content)>1){ ?>
            
            	<div class="col-sm-6">
	            	<p><?php echo $content[0]; ?></p>
	            </div>
	            <div class="col-sm-6">
					<p><?php echo $content[1]; ?></p>
	            </div>
	         
			<?php }else{ ?>
				<div class="col-sm-12">
	            	<?php the_content(); ?>
	            </div>
			<?php } ?>
			</div>
        </div>
    </div>
</section>

<?php if( $show_weather_information || $show_demographics || $show_extra_info ){?> 
	<section class="canvas-block about" style="">
		<div class="container">
	        <div class="row">
	            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('General infrormation'); ?></h2></div>
	            <?php if( $show_weather_information ){?> 
		            <div class="col-sm-3">
		            	<h4><?php echo pll__('Weather information'); ?></h4>
		            	<ul class="box">
							<?php if( trim($temperature) != "" ){?> 
			                	<li>
			                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/temperature.png"></span>  <?php echo $temperature; ?> &deg;C</h2>
			                        <h5><?php echo pll__('Temperature'); ?></h5>
			                    </li>
							<?php }?>
							<?php if( trim($dry_days) != ""){?> 
			                    <li>
			                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/dray-days.png"></span>  <?php echo $dry_days; ?></h2>
			                        <h5><?php echo pll__('Dry days'); ?></h5>
			                    </li>
		                    <?php }?>
		                    <?php if( trim($average_rainfall) != ""){?> 
			                    <li>
			                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/avaerage-rainfall.png"></span> <?php echo $average_rainfall; ?>mm</h2>
			                        <h5><?php echo pll__('Average rainfall'); ?></h5>
			                    </li>
		                    <?php }?>
		                    <?php if( trim($snow_days) != ""){?> 
			                    <li>
			                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/snow-days.png"></span> <?php echo $snow_days; ?></h2>
			                        <h5><?php echo pll__('Snow days'); ?></h5>
			                    </li>
		                    <?php }?>
		                </ul>
		            </div>
	            <?php }?>

	           <?php if( $show_demographics ){?> 
	            <div class="col-sm-3">
	            	<h4><?php echo pll__('Demographics'); ?></h4>
	            	<ul class="box">
	                	<?php if( trim($population) != ""){?> 
		                	<li>
		                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/population.png"></span> <?php echo $population;?></h2>
		                        <h5><?php echo pll__('Population'); ?></h5>
		                    </li>
						<?php }?>
						<?php if(isset($curretn_time)){?> 
		                    <li>
		                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/local-time.png"></span> <?php echo $curretn_time;?></h2>
		                        <h5><?php echo pll__('Local time'); ?></h5>
		                    </li>
						<?php }?>
	                	<?php if( trim($currency) != ""){?> 
		                    <li>
		                    	<h2><span><img src="<?php echo get_template_directory_uri();?>/images/icon/currency.png"></span> <?php echo $currency?></h2>
		                        <h5><?php echo pll__('Currency'); ?></h5>
		                    </li>
	                    <?php }?>
	                </ul>
	            </div>
	            <?php }?>
				<?php if( $show_extra_info ) { ?>
		            <div class="col-sm-6">
		            	<h4><?php echo pll__('Price Info'); ?></h4>
		                <div class="col-sm-6">
		            		<?php echo $extra_info_1; ?>
		                </div>
		                <div class="col-sm-6">
		            		<?php echo $extra_info_2; ?>
		                </div>
		                <?php if( trim( $extra_info_button_text ) != "" && trim(get_field ( 'extra_info_button_link' )) != ""){ ?>
			                <div class="col-sm-12">
			                	<a href="<?php the_field('extra_info_button_link')?>" class="btn btn-primary btn-lg spec" name="singlebutton" id="singlebutton"><?php echo $extra_info_button_text; ?></a>
			                </div>
		                <? } ?>
		            </div>
				<?php } ?>
	        </div>
	    </div>
	</section>
<?php } ?>

<?php if(sizeof($hotels)>0){?>
	<section class="dark-gray carousel hotel" style="">
	    <div class="container">
	    <div class="loading-overlay col-sm-12" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"></div>
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
		                                <p class="title"><a href="<?php echo $link; ?>"><?php echo $hotels[$i]->post_title; ?></a></p>
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

<?php if(sizeof($places)>0){?>
	<script>
		jQuery(function ($) {
			$('.single-place').colorbox();
		});		
	</script>
	<section class="light-gray blog-list place" style=" padding:30px 0 0 0">
	    <div class="container">
	        <div class="row">
	            <h2 class="section-title"><?php echo pll__('Interesting places nearby'); ?></h2>
	            <div class="col-sm-12 place-categories">
	            	<div class="choose-box">
	                	<a href="#" class="active"><i class="fa fa-circle-o"></i><i class="fa fa-dot-circle-o"></i> <?php echo pll__('Everything'); ?></a>
	                	<?php for($i=0; $i<sizeof($place_categories); $i++){ ?>
	                		<a href="#" class="<?php echo $place_categories[$i]->slug?>"><i class="fa fa-circle-o"></i><i class="fa fa-dot-circle-o"></i> <?php echo $place_categories[$i]->name?></a>
	                	<?php } ?>
	                </div>
	            </div>
	         </div>  
	        <div class="ajax-content">
	        	<div class="loading-overlay col-sm-12" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"></div>
				<div id="place-content">
			        <div class="row" style="position: relative;">   
			            <?php for($i=0;$i<sizeof($places);$i++){ 
							$is_big_element = in_array($i,$big_element_array_place);?>
						<div <?php if($is_big_element){?> class="col-sm-6" <?php }else{ ?> class="col-sm-3"<?php } ?> >
							<div class="box">
								<a href="<?php echo  get_permalink($places[$i]->ID);?>" class="title-block single-place">
									<?php if($is_big_element){
											echo get_the_post_thumbnail( $places[$i]->ID,  'place-thumb-big' ); 
										}else{
											echo get_the_post_thumbnail( $places[$i]->ID,  'place-thumb-small' ); 
										}?> 
									<div class="box-title">
										<h3 class="title"><?php echo $places[$i]->post_title; ?></h3>
									</div>
								</a>
							</div>
						</div>	
						<?php if(in_array($i,$new_row_array_place)){?>
							</div>
							<?php if($i==6 && sizeof($places)>7){ ?>
								<div class="row post-more-btn">
									<div class="col-sm-12">
										<a href="javascript:fourDreamersShowMorePlaces();"  class="more"><span><?php echo pll__('view more'); ?></span></a>
									</div>
								</div>
								<div class="post-more" style="display:none;">
							<?php } ?>
						<div class="row">
						<?php }?>
					
					<?php } ?>

			        </div>
			        </div>
			    </div>
	        </div>
	</section>	
<?php } ?>	

<?php if( trim( $more_about_the_city ) != '' ){ ?>

<section class="canvas-block light-gray about" style="">
	<div class="container">
        <div class="row">
            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('More About The City'); ?></h2></div>
            <div class="fullText" style="<?php echo $fullTextStyle; ?>" >
				<div class="col-sm-12">
	            	<?php echo $more_about_the_city; ?>
	            </div>
			</div>
        </div>
    </div>
</section>

<?php } ?>

<?php if(sizeof($popularCities)>0){?>	
	<section class="light-gray blog-list" style=""> 
		<div class="container">
		<div id="city-places" class="row">
	        <h2 class="section-title"><?php echo pll__('Similar destinations'); ?></h2>
			<?php for($i=0;$i<sizeof($popularCities);$i++){ 
					$is_big_element = in_array($i,$big_element_array);?>
				<div <?php if($is_big_element){?> class="col-sm-6" <?php }else{ ?> class="col-sm-3"<?php } ?> >
					<div class="box">
						<a href="<?php echo  get_permalink($popularCities[$i]->ID);?>" class="title-block">
							<?php if($is_big_element){
									echo get_the_post_thumbnail( $popularCities[$i]->ID,  'place-thumb-big' ); 
								}else{
									echo get_the_post_thumbnail( $popularCities[$i]->ID,  'place-thumb-small' ); 
								}?> 
							<div class="box-title">
								<?php if(isset($popularCities[$i]->country)){ ?>
								 	<span class="date"><?php echo $popularCities[$i]->country; ?></span>
								<?php } ?>
								<h3 class="title"><?php echo $popularCities[$i]->post_title; ?></h3>
							</div>
	
						<?php 
							$offer = getOfferForCity(get_field('city_code',$popularCities[$i]->ID));
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
					</div><div class="row">
				<?php }?>
			
			<?php } ?>
			
			</div><!-- end last row-->
		</div><!-- end container-->
	</section>
<?php } ?>



<?php get_footer();