<?php


 /*
  * Interview Questions Post Type
  */ 
add_action('init','istl_interview_questions_post_type');
function istl_interview_questions_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Interview Questions", "post type general name"),
		'singular_name' => _x("Interview Questions", "post type singular name"),
		'menu_name' => 'Interview Questions',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Interview Questions"),
		'edit_item' => __("Edit Interview Questions"),
		'new_item' => __("New Interview Questions"),
		'view_item' => __("View Interview Questions"),
		'search_items' => __("Search Interview Questions"),
		'not_found' =>  __("No Interview Questions Found"),
		'not_found_in_trash' => __("No Interview Questions Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('interview-questions' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => array('slug' => 'interview-questions'),
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}
 
/**
 * Interview Questions Category Taxonomy
 */
add_action( 'init', 'istl_interview_questions_taxonomy', 0 );
function istl_interview_questions_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('interview-questions-category'), 'interview-questions', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => true,
		'labels' => $labels 
	) );
}

 

/*
 * Save Interview Questions Meta Fields Value
 */
//add_action( 'save_post', 'istl_interview_questions_save_meta_box' );
function istl_interview_questions_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $interview_questions_fields = array('interview_questions_client', 'interview_questions_location', 'interview_questions_url' );  

    if($interview_questions_fields) {   
        foreach($interview_questions_fields as $interview_questions_field) {    
            if(isset( $_POST[$interview_questions_field] ) ) {
                update_post_meta( $post_id, $interview_questions_field, $_POST[$interview_questions_field]);
            }  
        }
    }    
} 

/*
 * Get Interview Questions Details 
 * Return Array
 */
function istl_get_interview_questions_details($post_id) {   
    
    $output = array();
    $output['interview_questions_title'] = get_the_title($post_id); 
    $output['interview_questions_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $interview_questions_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $interview_questions_image = get_stylesheet_directory_uri().'/images/default-interview_questions.jpg'; 
    } 
    
    $output['interview_questions_image'] = $interview_questions_image;   

    $interview_questions_fields = array('interview_questions_client', 'interview_questions_location', 'interview_questions_url');   
    if($interview_questions_fields) { 
        foreach($interview_questions_fields as $interview_questions_field) {  
            $output[$interview_questions_field] = get_post_meta($post_id, $interview_questions_field, true);  
        } 
    }
    return $output;  
}
