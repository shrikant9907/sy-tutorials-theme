<?php
 /*
  * Examples Post Type
  */ 
add_action('init','examples_post_type');
function examples_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Examples", "post type general name"),
		'singular_name' => _x("Examples", "post type singular name"),
		'menu_name' => 'Examples',
		'add_new' => _x("Add New", "program"),
		'add_new_item' => __("Add New Examples"),
		'edit_item' => __("Edit Examples"),
		'new_item' => __("New Examples"),
		'view_item' => __("View Examples"),
		'search_items' => __("Search Examples"),
		'not_found' =>  __("No Examples Found"),
		'not_found_in_trash' => __("No Examples Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('Examples' , array( 
		'labels' => $labels,
		'public' => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
        'rest_base'          => 'Examples',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => array('slug' => 'Examples'),
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies'       => array('examples-category', 'examples-tags')
	) ); 
}
  
/**
 * Examples Category Taxonomy
 */
add_action( 'init', 'examples_taxonomy', 0 );
function examples_taxonomy() {  
	
	// Labels
	$singular = 'Examples Category';
	$plural = 'Examples Categories'; 
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
        
	register_taxonomy( strtolower('examples-category'), 'Examples', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'examples-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
}

/**
 * Examples Tags Taxonomy
 */
add_action( 'init', 'examples_taxonomy2', 0 );
function examples_taxonomy2() {  
	
	// Labels
	$singular = 'Examples Tag';
	$plural = 'Examples Tags'; 
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
        
	register_taxonomy( strtolower('examples-tags'), 'Examples', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'examples-tags',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
} 

/*
 * Examples Meta Box
 */
//add_action( 'add_meta_boxes', 'examples_meta_box' );
function examples_meta_box(){
    add_meta_box( 'examples-details', 'Examples Details', 'examples_metabox_cb', 'Examples', 'normal', 'default');
}
 
function examples_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'examples_client',
                'label'=>'Client Name',
                'classes'=>'examples-field'
            ), 
            array(
                'name'=>'examples_location',
                'label'=>'Location',
                'classes'=>'examples-field'
            ), 
            array(
                'name'=>'examples_url',
                'label'=>'URL',
                'classes'=>'examples-field'
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

