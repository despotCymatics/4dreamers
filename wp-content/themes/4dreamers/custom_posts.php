<?php

// COUNTRY Custom Post Type
function country_custom_post() {

	$labels = array(
		'name'                => _x( 'Countries', 'Post Type General Name', 'country' ),
		'singular_name'       => _x( 'Country', 'Post Type Singular Name', 'country' ),
		'menu_name'           => __( 'Country', 'country' ),
		'parent_item_colon'   => __( 'Parent Country:', 'country' ),
		'all_items'           => __( 'All Countries', 'country' ),
		'view_item'           => __( 'View Country', 'country' ),
		'add_new_item'        => __( 'Add New Country', 'country' ),
		'add_new'             => __( 'Add New', 'country' ),
		'edit_item'           => __( 'Edit Country', 'country' ),
		'update_item'         => __( 'Update Item', 'country' ),
		'search_items'        => __( 'Search Country', 'country' ),
		'not_found'           => __( 'Not found', 'country' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'country' ),
	);
	$args = array(
		'label'               => __( 'country', 'country' ),
		'description'         => __( 'Country Description', 'country' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => get_bloginfo('template_url').'/images/country-admin-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'country', $args );

}

// Hook into the 'init' action
add_action( 'init', 'country_custom_post', 0 );


// CITY Custom Post Type
function city_custom_post() {

	$labels = array(
		'name'                => _x( 'Cities', 'Post Type General Name', 'city' ),
		'singular_name'       => _x( 'City', 'Post Type Singular Name', 'city' ),
		'menu_name'           => __( 'City', 'city' ),
		'parent_item_colon'   => __( 'Parent City:', 'city' ),
		'all_items'           => __( 'All Cities', 'city' ),
		'view_item'           => __( 'View City', 'city' ),
		'add_new_item'        => __( 'Add New City', 'city' ),
		'add_new'             => __( 'Add New', 'city' ),
		'edit_item'           => __( 'Edit City', 'city' ),
		'update_item'         => __( 'Update City', 'city' ),
		'search_items'        => __( 'Search City', 'city' ),
		'not_found'           => __( 'Not found', 'city' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'city' ),
	);
	$args = array(
		'label'               => __( 'city', 'city' ),
		'description'         => __( 'City Description', 'city' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => get_bloginfo('template_url').'/images/city-admin-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'city', $args );

}

// Hook into the 'init' action
add_action( 'init', 'city_custom_post', 0 );

// PLACE Custom Post Type
function place_custom_post() {

	$labels = array(
		'name'                => _x( 'Places', 'Post Type General Name', 'place' ),
		'singular_name'       => _x( 'Place', 'Post Type Singular Name', 'place' ),
		'menu_name'           => __( 'Place', 'place' ),
		'parent_item_colon'   => __( 'Parent Place:', 'place' ),
		'all_items'           => __( 'All Places', 'place' ),
		'view_item'           => __( 'View Place', 'place' ),
		'add_new_item'        => __( 'Add New Place', 'place' ),
		'add_new'             => __( 'Add New', 'place' ),
		'edit_item'           => __( 'Edit Place', 'place' ),
		'update_item'         => __( 'Update Place', 'place' ),
		'search_items'        => __( 'Search Place', 'place' ),
		'not_found'           => __( 'Not found', 'place' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'place' ),
	);
	$args = array(
		'label'               => __( 'place', 'place' ),
		'description'         => __( 'Place Description', 'place' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'          => array( 'place-category'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => get_bloginfo('template_url').'/images/place-admin-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	$taxonomy_args = array(
		'label' => __( 'Place Categories' ),
		'rewrite' => array( 'slug' => 'place-category' ),
		'hierarchical' => true,
		
	);
	register_taxonomy('place-category','place',$taxonomy_args);
	register_post_type( 'place', $args );


}

// Hook into the 'init' action
add_action( 'init', 'place_custom_post', 0 );

// HOTEL Custom Post Type
function hotel_custom_post() {

	$labels = array(
		'name'                => _x( 'Hotels', 'Post Type General Name', 'hotel' ),
		'singular_name'       => _x( 'Hotel', 'Post Type Singular Name', 'hotel' ),
		'menu_name'           => __( 'Hotel', 'hotel' ),
		'parent_item_colon'   => __( 'Parent Hotel:', 'hotel' ),
		'all_items'           => __( 'All Hotels', 'hotel' ),
		'view_item'           => __( 'View Hotel', 'hotel' ),
		'add_new_item'        => __( 'Add New Hotel', 'hotel' ),
		'add_new'             => __( 'Add New', 'hotel' ),
		'edit_item'           => __( 'Edit Hotel', 'hotel' ),
		'update_item'         => __( 'Update Hotel', 'hotel' ),
		'search_items'        => __( 'Search Hotel', 'hotel' ),
		'not_found'           => __( 'Not found', 'hotel' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'hotel' ),
	);
	$args = array(
		'label'               => __( 'hotel', 'hotel' ),
		'description'         => __( 'Hotel Description', 'hotel' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'taxonomies'          => array( 'hotel-category'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => get_bloginfo('template_url').'/images/hotel-admin-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	$taxonomy_args = array(
		'label' => __( 'Hotel Categories' ),
		'rewrite' => array( 'slug' => 'hotel-category' ),
		'hierarchical' => true,
		
	);
	register_taxonomy('hotel-category','hotel',$taxonomy_args);
	register_post_type( 'hotel', $args );

}

// Hook into the 'init' action
add_action( 'init', 'hotel_custom_post', 0 );

?>