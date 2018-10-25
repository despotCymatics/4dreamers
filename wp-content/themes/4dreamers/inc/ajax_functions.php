<?php
require_once 'functions.php';
require_once 'model.php';

function fourdreams_ajax_get_place(){
	$slug = str_replace("'","", $_POST['slug']);
	$city_code = str_replace("'","", $_POST['city_code']);
	if($slug !=''){
		$tax_query = array(
			'taxonomy'         => 'place-category',
			'field'            => 'slug',
			'terms'            =>  $slug, 
			'include_children' => false
		);
	}
	
	$places = get_posts(array(
		'post_type'	 => 'place',
		'tax_query'  => array($tax_query),
		'meta_key'	 => 'city_code',
		'meta_value' => $city_code,
		'posts_per_page' => 21,
	));

	$template = places_template( sizeof($places) );
	$new_row_array=$template['new_row_array']  ;
	$big_element_array = $template['big_element_array'];
	
	$html = '<div  class="row"  style="position: relative;">  ';
	for($i=0;$i<sizeof($places);$i++){ 
				$is_big_element = in_array($i,$big_element_array);
			$html .='<div ';
			if($is_big_element){
				$html .='class="col-sm-6"'; 
			}else{  
				$html .='class="col-sm-3"';
			} 
			$html .='>';
				$html .='<div class="box">';
					$html .='<a href="'.get_permalink($places[$i]->ID).'" class="title-block single-place cboxElement">';
						if($is_big_element){
							$html .= get_the_post_thumbnail( $places[$i]->ID,  'place-thumb-big' ); 
						}else{
							$html .= get_the_post_thumbnail( $places[$i]->ID,  'place-thumb-small' ); 
						}
						$html .='<div class="box-title">';
							$html .='<h3 class="title">'.$places[$i]->post_title.'</h3>';
						$html .='</div>';
					$html .='</a>';
				$html .='</div>';
			$html .='</div>	';
			
			if(in_array($i,$new_row_array)){
				$html.='</div>';
				if($i==6 && sizeof($places)>7){
					$html .='<div class="row post-more-btn">
								<div class="col-sm-12">
									<a href="javascript:fourDreamersShowMorePlaces();"  class="more"><span>'.pll__('view more').'</span></a>
								</div>
							</div>
							<div class="post-more" style="display:none;">';
				}
				$html.='<div class="row">';
			}
		
	} 
	echo $html;
	die();
}
add_action('wp_ajax_nopriv_fourdreams_ajax_get_place','fourdreams_ajax_get_place');
add_action('wp_ajax_fourdreams_ajax_get_place','fourdreams_ajax_get_place');


function fourdreams_ajax_get_hotel(){
	$slug = str_replace("'","", $_POST['slug']);
	$city_code = str_replace("'","", $_POST['city_code']);
	if($slug !=''){
		$tax_query = array(
			'taxonomy'         => 'hotel-category',
			'field'            => 'slug',
			'terms'            =>  $slug, 
			'include_children' => false
		);
	}
	
	$hotels = get_posts(array(
		'post_type'	 => 'hotel',
		'tax_query'  => array($tax_query),
		'meta_key'	 => 'city_code',
		'meta_value' => $city_code,
	));

	$html = '';
	for($i=0; $i<sizeof($hotels); $i++){ 

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

		$html .= '<li>';
	    	$html .= '<div class="box">';
	        	$html .= '<a href="'.$link.'">' . get_the_post_thumbnail($hotels[$i]->ID,'hotel-thumb') . '</a>';
	             	$html .= '<div class="box-title">';
	                 	$html .= '<p class="title"><a href="#">' . $hotels[$i]->post_title .'</a></p>';
	                     	$html .= '<span class="rating">';
	                                	for($j=0; $j<get_field('number_of_stars',$hotels[$i]->ID); $j++){
	                                		$html .= '<i class="fa fa-star"></i>';
	                                	} 
	                        $html .= '</span>';
	                $html .= '</div>';
	        $html .= '</div>';
	    $html .= ' </li>';
    }
	echo $html;
	die();
}
function fourdreamers_ajax_load_dest_page(){
	$page     = ( is_numeric( $_POST['page_number'] ) && $_POST['page_number'] > 0 ) ? $_POST['page_number'] : 1;
	$no_items = ( is_numeric( $_POST['no_items'] ) && $_POST['no_items'] > 0 ) ? $_POST['no_items'] : 1 ;
	$perpage  = ( is_numeric( $_POST['no_perppage'] ) && $_POST['no_perppage'] > 0 ) ? $_POST['no_perppage'] : 7;

	$args = array(
		'post_type'	     => array('country','city'),
		'orderby'        => 'post_date',
		'order'          => 'DESC',
		'posts_per_page' => $perpage,
	  	'paged'          => $page ,
	);

	$destinations = get_posts($args);

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

	for($i=0;$i<sizeof($destinations);$i++){ 
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
								<span class="from"><?php echo pll__('From')?></span>								  					
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
	<?php }	

	die();
}

add_action('wp_ajax_nopriv_fourdreams_ajax_get_hotel','fourdreams_ajax_get_hotel');
add_action('wp_ajax_fourdreams_ajax_get_hotel','fourdreams_ajax_get_hotel');

add_action('wp_ajax_fourdreamers_ajax_load_dest_page','fourdreamers_ajax_load_dest_page');
add_action('wp_ajax_nopriv_fourdreamers_ajax_load_dest_page','fourdreamers_ajax_load_dest_page');

?>