<?php


/*
 * Post Type for Codes
 */
function istl_codes_posttype() {
  $args = array(
    'labels' => array(
      'name' => __('Codes'),
      'singular_name' => __('Codes'),
      'all_items' => __('All Code'),
      'add_new_item' => __('Add New Code'),
      'edit_item' => __('Edit Code'),
      'view_item' => __('View Code')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'codes'),
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'capability_type' => 'page',
    'supports' => array('title', 'editor', 'thumbnail'),
    'exclude_from_search' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-format-status'
    );
  register_post_type('codes', $args);
}
add_action( 'init', 'istl_codes_posttype');


/**
 * Code Category Taxonomy
 */
add_action( 'init', 'istl_code_taxonomy', 0 );
function istl_code_taxonomy() {  
	
	// Labels
	$singular = 'Category';
	$plural = 'Categories'; 
	$labels = array( 
		'name' => _x( $plural, "taxonomy general name"),
		'singular_name' => _x( $singular, "taxonomy singular name"),
		'search_items' =>  __("Search $singular"),
		'all_items' => __("All $singular"),
		'parent_item' => __("Parent $singular"),
		'parent_item_colon' => __("Parent $singular:"),
		'edit_item' => __("Edit $singular"),
		'update_item' => __("Update $singular"),
		'add_new_item' => __("Add New $singular"),
		'new_item_name' => __("New $singular Name"),
	);
        
	register_taxonomy( strtolower('code_cat'), 'codes', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'labels' => $labels 
	) );
}