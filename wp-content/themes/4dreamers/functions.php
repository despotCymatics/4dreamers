<?php
require('custom_posts.php');
require_once( 'shortcodes.php' );
require_once( 'inc/ajax_functions.php' );

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

register_nav_menu( 'primary', __( 'Primary Menu', '4dreamers' ) );
register_nav_menu( 'footer-menu',  __( 'Footer Menu', '4dreamers' ) );
wp_register_script( 'fordreamers-highcharts', get_stylesheet_directory_uri() . '/js/highcharts.js', array('jquery'),'',false );

//Label translataions
pll_register_string('login', 'Login', false);
pll_register_string('register', 'Register', false);
//FORMS
pll_register_string('flights_from', 'Flights from', false);
pll_register_string('more_about_the_city', 'More About The City', false);
pll_register_string('search', 'Search', false);
pll_register_string('drop_off_date', 'Drop off date', false);
pll_register_string('pick_up_date', 'Pick up date', false);
pll_register_string('pick_up_location', 'Pick up location', false);
pll_register_string('drop_off_location', 'Drop off location', false);
pll_register_string('flight_time', 'Flight time', false);
pll_register_string('rooms', 'Rooms', false);
pll_register_string('renta_car', 'Renta Car', false);
pll_register_string('hotel', 'Hotel', false);
pll_register_string('flight', 'Flight', false);
pll_register_string('check_out_date', 'Check-out date', false);
pll_register_string('check_in_date', 'Check-in date', false);
pll_register_string('destination', 'Destination', false);
pll_register_string('city', 'City', false);
pll_register_string('return_flight_time', 'Return flight time', false);
pll_register_string('anytime', 'Anytime', false);
pll_register_string('morning', 'Morning', false);
pll_register_string('afternoon', 'Afternoon', false);
pll_register_string('evening', 'Evening', false);
pll_register_string('outbound_flight_time', 'Outbound flight time', false);
pll_register_string('airline_name', 'Airline Name', false);
pll_register_string('airline', 'Airline', false);
pll_register_string('economy', 'Economy', false);
pll_register_string('premium', 'Premium', false);
pll_register_string('business', 'Business', false);
pll_register_string('first', 'First', false);
pll_register_string('flight_cabin_class', 'Flight cabin class', false);
pll_register_string('reset_search_criteria', 'Reset Search Criteria', false);
pll_register_string('advanced_search', 'Advanced Search', false);
pll_register_string('days', 'days', false);
pll_register_string('infant', 'Infant', false);
pll_register_string('child', 'Child', false);
pll_register_string('adult', 'Adult', false);
pll_register_string('returning', 'Returning', false);
pll_register_string('departing', 'Departing', false);
pll_register_string('city_or_airport', 'City or airport', false);
pll_register_string('flying_to', 'Flying to', false);
pll_register_string('you_must_fill_this_field', 'You must fill this field!', false);
pll_register_string('from', 'From', false);
pll_register_string('multileg', 'Multileg', false);
pll_register_string('one_way', 'One way', false);
pll_register_string('round_trip', 'Round trip', false);

pll_register_string('local_time', 'Local time', false);
pll_register_string('capital_city', 'capital city', false);
pll_register_string('view_more', 'view more', false);
pll_register_string('hotels', 'Hotels', false);
pll_register_string('news', 'News', false);
pll_register_string('interesting_places_nearby', 'Interesting places nearby', false);
pll_register_string('demographics', 'Demographics', false);
pll_register_string('price_info', 'Price Info', false);
pll_register_string('country_code', 'Country Code', false);
pll_register_string('average_temperature', 'Average Temperature', false);
pll_register_string('for', 'for', false);
pll_register_string('temperature', 'Temperature', false);
pll_register_string('average__high_temperature', 'Average high temperature', false);
pll_register_string('average__low_temperature', 'Average low temperature', false);
pll_register_string('may', 'May', false);
pll_register_string('aug', 'Aug', false);
pll_register_string('oct', 'Oct', false);
pll_register_string('averange_rainfall_days', 'Average rainfall days', false);
pll_register_string('average_rainfall', 'Average rainfall', false);
pll_register_string('precipitation', 'Precipitation', false);
pll_register_string('destinations', 'Destinations', false);
pll_register_string('popular_destination', 'Popular destinations', false);
pll_register_string('about_the_country', 'About The Country', false);
pll_register_string('about_the_country', 'About The City', false);
pll_register_string('weather_forecast_for', 'Weather forecast for', false);
pll_register_string('similar_destinations', 'Similar destinations', false);
pll_register_string('verything', 'Everything', false);
pll_register_string('dry_days', 'Dry days', false);
pll_register_string('snow_days', 'Snow days', false);
pll_register_string('population', 'Population', false);
pll_register_string('currency', 'Currency', false);
pll_register_string('general_infrormation', 'General infrormation', false);
pll_register_string('weather_information', 'Weather information', false);
pll_register_string('Copyright', 'All rights reserved.', false);
pll_register_string('bestdeals', 'Best Deals', false);



//ADD IMAGE SIZE
add_image_size( 'place-thumb-small', 279, 245, array( 'left', 'top' ) );
add_image_size( 'place-thumb-big', 564, 245, array( 'left', 'top' ) );
add_image_size( 'news-thumb', 279, 190, array( 'left', 'top' ) );
add_image_size( 'news-inner', 1135, 380, array( 'left', 'top' ) );
add_image_size( 'hotel-thumb', 205, 140, array( 'left', 'top' ) );

//image link none
update_option('image_default_link_type','none');


function fordreamers_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 960, 9999 ); // Unlimited height, soft crop
}

add_action( 'after_setup_theme', 'fordreamers_setup' );


/**
 * Enqueue scripts and styles for front-end.
 */

function fordreamers_scripts_styles() {
	global $wp_styles;
	wp_deregister_script('jquery');
	//wp_deregister_style('open-sans');
	wp_register_script('fordreamers-jquery', (get_template_directory_uri() . '/js/jquery-1.11.0.min.js'),array(), false, false);

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	
	wp_enqueue_script('fordreamers-jquery');
	//wp_enqueue_script( 'fordreamers-jquery', get_template_directory_uri() . '/js/jquery-1.11.0.min.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-autocomplete-html', get_template_directory_uri() . '/js/autocomplete.jq-ui.html.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-colorbox.min', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-bxslider.min', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), false, false );
	wp_enqueue_script( 'fordreamers-misc', get_template_directory_uri() . '/js/misc.js', array(), false, false );

	/*if (is_page_template( 'template_flights.php' )) {
		wp_enqueue_script( 'fordreamers-captcha', '//www.google.com/recaptcha/api.js?onload=onloadCallbackFlight&render=explicit', array(), false, true );
	}
	if (is_page_template( 'template_hotels.php' )) {
		wp_enqueue_script( 'fordreamers-captcha', '//www.google.com/recaptcha/api.js?onload=onloadCallbackHotel&render=explicit', array(), false, true );
	}
	if (is_page_template( 'template_home.php' ) || is_page_template( 'template_destinations.php' )) {

		wp_enqueue_script( 'fordreamers-captcha', '//www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit', array(), false, true );
	}*/

	if ( 'country' == get_post_type() ){
		wp_enqueue_script('fordreamers-highcharts2', get_template_directory_uri() .'/js/highcharts.js', array('fordreamers-jquery'),	false, false);
		wp_enqueue_script('fordreamers-chartfunctions', get_template_directory_uri() .'/js/chart-functions.js', array(), false, false);
	}

	// Loads our main stylesheet.
	wp_enqueue_style( 'fordreamers-jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-jquery-ui_autocomplete', get_template_directory_uri() . '/css/jquery-ui-autocomplete.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-bootstrap-overrides', get_template_directory_uri() . '/css/bootstrap-overrides.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-colorbox.css', get_template_directory_uri() . '/js/colorbox/colorbox.css', array(), false, "screen, projection" );
	wp_enqueue_style( 'fordreamers-bxslider.css', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), false, "screen, projection" );	
	wp_enqueue_style( 'fordreamers-style', get_stylesheet_uri() );
	wp_enqueue_style( 'fordreamers-mobile', get_template_directory_uri() . '/css/mobile.css', array(), false, "only screen and (max-width: 1280px)" );

}

add_action( 'wp_enqueue_scripts', 'fordreamers_scripts_styles' );


/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function fordreamers_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fordreamers' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fordreamers_wp_title', 10, 2 );


class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
           $attributes .= ! empty( $item->description )        ? ' data-icon-fa="'   . esc_attr( $item->description        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           //$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            //$item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}


//FILTERS
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}



/**
 * Register sidebars and widgetized areas.
 *
 */

function fordreamers_widgets_init() {

	register_sidebar( array(
		'name' => 'Right Sidebar',
		'id' => 'right-sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'fordreamers_widgets_init' );


// Facebook Open Graph
add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {	
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		//$description = get_bloginfo('description');
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

<?php 	}
}

function my_excerpt($text, $excerpt){
	
    if ($excerpt) return $excerpt;

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}

function new_excerpt_more($more) {
    global $post;
	return '<a class="more readFullText" href="javascript:fourDreamersReadMore();">'.pll__('read more').'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



add_action('admin_menu', 'fourdreamers_remove_sub_menus');
function fourdreamers_remove_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	remove_meta_box( 'tagsdiv-post_tag','post','normal' ); // Tags Metabox
}


add_action('wp_footer', 'add_googleanalytics');

function add_googleanalytics() { ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  //ga('create', 'UA-57751793-2', 'auto');
  ga('create', 'UA-57751793-2', 'auto', {'allowLinker': true});
  ga('require', 'linker');
  ga('linker:autoLink', ['epower.amadeus.com/fordreamers/'] );
  ga('send', 'pageview');

</script>


<?php } 

