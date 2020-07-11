<?php
 /*
  * Programs Post Type
  */ 
add_action('init','programs_post_type', 10);
function programs_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Programs", "post type general name"),
		'singular_name' => _x("Programs", "post type singular name"),
		'menu_name' => 'Programs',
		'add_new' => _x("Add New", "program"),
		'add_new_item' => __("Add New Programs"),
		'edit_item' => __("Edit Programs"),
		'new_item' => __("New Programs"),
		'view_item' => __("View Programs"),
		'search_items' => __("Search Programs"),
		'not_found' =>  __("No Programs Found"),
		'not_found_in_trash' => __("No Programs Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('programs' , array( 
		'labels' => $labels,
		'public' => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
        'rest_base'          => 'programs',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => array('slug' => 'programs'),
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies'       => array('programs-category', 'programs-tags')
	) ); 
}
  
/**
 * Programs Category Taxonomy
 */
add_action( 'init', 'programs_taxonomy', 0 );
function programs_taxonomy() {  
	
	// Labels
	$singular = 'Programs Category';
	$plural = 'Programs Categories'; 
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
        
	register_taxonomy( strtolower('programs-category'), 'Programs', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'programs-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
}

/**
 * Programs Tags Taxonomy
 */
add_action( 'init', 'programs_taxonomy2', 0 );
function programs_taxonomy2() {  
	
	// Labels
	$singular = 'Programs Tag';
	$plural = 'Programs Tags'; 
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
        
	register_taxonomy( strtolower('programs-tags'), 'Programs', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'programs-tags',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
} 

/*
 * Programs Meta Box
 */
//add_action( 'add_meta_boxes', 'programs_meta_box' );
function programs_meta_box(){
    add_meta_box( 'programs-details', 'Programs Details', 'programs_metabox_cb', 'Programs', 'normal', 'default');
}
 
function programs_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'programs_client',
                'label'=>'Client Name',
                'classes'=>'programs-field'
            ), 
            array(
                'name'=>'programs_location',
                'label'=>'Location',
                'classes'=>'programs-field'
            ), 
            array(
                'name'=>'programs_url',
                'label'=>'URL',
                'classes'=>'programs-field'
            )
        );    
    $html = '';
    if($profolio_metafields) { 
        foreach($profolio_metafields as $profolio) {
            $values = get_post_meta( $post->ID, $profolio['name'], true );
            $value = isset( $values ) ? esc_attr( $values ) : "";
            $html .= '<label>'.$profolio['label'].'</label>'; 
            $html .= '<input type="text" name="'.$profolio['name'].'" id="'.$profolio['name'].'" style=" margin-bottom:15px; width:100%;" value="'.$value.'" />';          
        }
    }
   
    echo $html;
}

