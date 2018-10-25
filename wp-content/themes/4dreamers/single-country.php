<?php
/**
 * The Template for displaying country posts
 */

get_header();
require_once 'inc/model.php';
require_once 'inc/functions.php';

//City that represents the country and other cities
$cityCode = get_field('city_code');
$airports = get_airports_for_city($cityCode);
$allCities = cp_get_popular_cities($cityCode);
$currentCity = NULL;
$popularCities = array();
$offer = getOfferForCity($cityCode);

foreach ($allCities as $c) {

	$posts = get_posts(array(
		'post_type'		=> 'city',
		'posts_per_page'	=> 1,
		'meta_key'		=> 'city_code',
		'meta_value'		=> $c->CityCode
	));

	if(!empty($posts)) {
		if ($c->CityCode == $cityCode) {
			$currentCity = $posts[0];
		}
		array_push($popularCities, $posts[0]);	
	}

	if(sizeof($popularCities) == 7){
		break;
	}
}

$template = places_template( sizeof($popularCities) );
$new_row_array=$template['new_row_array']  ;
$big_element_array = $template['big_element_array'];

wp_reset_postdata();

$content = get_the_content();

if( strpos( $content, '##' ) != false ){
	$content = str_replace(array('<p>','</p>','<div>','</div>'), '', $content );
	$content = explode( '##', $content, 2);
}

?>
<section class="canvas-block country" style="background-image:url(<?php echo  wp_get_attachment_url(get_post_thumbnail_id()) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
        </div>
    </div>
</section>

<section class="canvas-block light-gray about" style="">
	<div class="container">
        <div class="row">
            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('About The Country'); ?></h2></div>
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
</section>

<?php if(trim(strip_tags(get_field('general_information'))) != ''){?>
	<section class="canvas-block about" style="">
		<div class="container">
	        <div class="row">
	            <div class="col-sm-12"><h2 class="section-title"><?php echo pll__('General infrormation'); ?></h2></div>
	            <?php the_field('general_information'); ?>
	        </div>
	    </div>
	</section>
<?php } ?>

<!-- Weather and Charts -->
<section class="canvas-block dark-gray weather-block" >
	<div class="container">
        <div class="row">
            <div class="col-sm-12" style="margin:0 0 30px 0;">
				<?php if(isset($currentCity->post_title)){ ?>	
            		<h2 class="section-title"><?php echo pll__('Weather forecast for') .' '. $currentCity->post_title; ?> </h2>
				<?php }else{?>
					<h2 class="section-title"><?php echo pll__('Weather forecast for').' '.pll__('capital city') ?></h2>
				<? } ?>
				<?php echo do_shortcode('[wunderground location="'.$cityCode.'" numdays="10" layout="simple" measurement="C" showdata="daynames,icon,date,highlow" language="EN"]'); ?>
			</div>
        </div>
 		<div class="row" >
			<?php if (count(explode(",", get_field('average_high_temperatures'))) == 12 && count(explode(",", get_field('average_low_temperatures'))) == 12) { ?>
				<div class="col-sm-6">
					<!-- Chart Temp -->
					<div id="temp-graph" data-title="<?php echo pll__('Average Temperature');?>(°C) <?php echo pll__('for');?> <?php echo (isset($currentCity->post_title)) ? $currentCity->post_title : pll__('capital city') ; ?>" data-axis-title="<?php echo pll__('Temperature');?>(°C)" data-fst-title="<?php echo pll__('Average high temperature');?>" data-sec-title="<?php echo pll__('Average low temperature');?>" data-fst-data="<?php echo get_field('average_high_temperatures'); ?>" data-sec-data="<?php echo get_field('average_low_temperatures'); ?>" data-categories="Jan,Feb,Mar,Apr,<?php echo pll__('May');?>,Jun,Jul,<?php echo pll__('Aug');?>,Sep,<?php echo pll__('Oct');?>,Nov,Dec" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
					<script>
						$(function ($) {
							generateGraph('temp-graph','avgtemp');
						});
					</script>
				</div>
			<?php } 


			if (count(explode(",", get_field('average_rainfall_precipitation'))) == 12 && count(explode(",", get_field('average_rainfall_days'))) == 12) { ?>
				<div class="col-sm-6">
					<!-- Chart Rainfall -->
					<div id="rain-graph" data-title="<?php echo pll__('Average rainfall');?>(mm) <?php echo pll__('for');?> <?php echo (isset($currentCity->post_title)) ? $currentCity->post_title : pll__('capital city'); ?>" data-axis-title="<?php echo pll__('Precipitation');?>(mm)" data-fst-title="<?php echo pll__('Precipitation');?>" data-sec-title="<?php echo pll__('Average rainfall days');?>" data-fst-data="<?php echo get_field('average_rainfall_precipitation'); ?>" data-sec-data="<?php echo get_field('average_rainfall_days'); ?>" data-categories="Jan,Feb,Mar,Apr,<?php echo pll__('May');?>,Jun,Jul,<?php echo pll__('Aug');?>,Sep,<?php echo pll__('Oct');?>,Nov,Dec" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
					<script>
						$(function ($) {
							generateGraph('rain-graph','rainfall');
						});
					</script>
				</div>
			<?php } ?>
		</div>
  	</div>
</section>

<?php if( sizeof( $popularCities ) > 0 ) {?>
	<section class="light-gray blog-list" style=""> 
		<div class="container">
		<div class="row">
	        <h2 class="section-title"><?php the_title(); ?> - <?php echo pll__('Popular destinations'); ?></h2>
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
								<!-- <span class="date"><?php echo date("d.m.Y.",strtotime($popularCities[$i]->post_date)); ?></span> -->
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

<!--  
<iframe scrolling="no" width="100%" id="myiframe" src="http://novosti.rs/detail.php"></iframe>


<script type="text/javascript">
	
	function receiveMessage(event)
	{
		console.log(event);
		var new_height = event.data;
		var old_height = jQuery('#myiframe').height();
		if(new_height != old_height){
			jQuery('#myiframe').height(new_height);
		}
		

	}


	window.addEventListener("message", receiveMessage, false);


</script> -->
<?php get_footer();