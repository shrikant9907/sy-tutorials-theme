<?php


 /*
  * Tutorial Post Type
  */ 
add_action('init','tutorials_post_type');
function tutorials_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Tutorial", "post type general name"),
		'singular_name' => _x("Tutorial", "post type singular name"),
		'menu_name' => 'Tutorial',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Tutorial"),
		'edit_item' => __("Edit Tutorial"),
		'new_item' => __("New Tutorial"),
		'view_item' => __("View Tutorial"),
		'search_items' => __("Search Tutorial"),
		'not_found' =>  __("No Tutorial Found"),
		'not_found_in_trash' => __("No Tutorial Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('tutorial' , array( 
		'labels' => $labels,
		'public' => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
        'rest_base'          => 'tutorial',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => array('slug' => 'tutorial'),
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies'       => array('tutorial_cat', 'tutorial_tag')
	) ); 
}
  
/**
 * Tutorial Category Taxonomy
 */
add_action( 'init', 'tutorials_taxonomy', 0 );
function tutorials_taxonomy() {  
	
	// Labels
	$singular = 'Tutorial Category';
	$plural = 'Tutorial Categories'; 
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
        
	register_taxonomy( strtolower('tutorial_cat'), 'tutorial', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'tutorial_cat',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
}

/**
 * Tutorial Tags Taxonomy
 */
add_action( 'init', 'tutorials_taxonomy2', 0 );
function tutorials_taxonomy2() {  
	
	// Labels
	$singular = 'Tutorial Tag';
	$plural = 'Tutorial Tags'; 
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
        
	register_taxonomy( strtolower('tutorial_tag'), 'tutorial', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_in_rest'          => true,
		'rest_base'             => 'tutorial_tag',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'labels' => $labels 
	) );
} 

/*
 * Tutorial Meta Box
 */
//add_action( 'add_meta_boxes', 'tutorials_meta_box' );
function tutorials_meta_box(){
    add_meta_box( 'tutorial-details', 'Tutorial Details', 'tutorials_metabox_cb', 'tutorial', 'normal', 'default');
}
 
function tutorials_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'tutorial_client',
                'label'=>'Client Name',
                'classes'=>'tutorial-field'
            ), 
            array(
                'name'=>'tutorial_location',
                'label'=>'Location',
                'classes'=>'tutorial-field'
            ), 
            array(
                'name'=>'tutorial_url',
                'label'=>'URL',
                'classes'=>'tutorial-field'
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

/*
 * Save Tutorial Meta Fields Value
 */
//add_action( 'save_post', 'tutorials_save_meta_box' );
function tutorials_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $tutorial_fields = array('tutorial_client', 'tutorial_location', 'tutorial_url' );  

    if($tutorial_fields) {   
        foreach($tutorial_fields as $tutorial_field) {    
            if(isset( $_POST[$tutorial_field] ) ) {
                update_post_meta( $post_id, $tutorial_field, $_POST[$tutorial_field]);
            }  
        }
    }    
} 

/*
 * Get Tutorial Details 
 * Return Array
 */
function istl_get_tutorial_details($post_id) {   
    
    $output = array();
    $output['tutorial_title'] = get_the_title($post_id); 
    $output['tutorial_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $tutorial_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $tutorial_image = get_stylesheet_directory_uri().'/images/default-tutorial.jpg'; 
    } 
    
    $output['tutorial_image'] = $tutorial_image;   

    $tutorial_fields = array('tutorial_client', 'tutorial_location', 'tutorial_url');   
    if($tutorial_fields) { 
        foreach($tutorial_fields as $tutorial_field) {  
            $output[$tutorial_field] = get_post_meta($post_id, $tutorial_field, true);  
        } 
    }
    return $output;  
}
  