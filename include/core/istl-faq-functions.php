<?php


 /*
  * FAQ Post Type
  */ 
add_action('init','istl_faq_post_type');
function istl_faq_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("FAQ", "post type general name"),
		'singular_name' => _x("FAQ", "post type singular name"),
		'menu_name' => 'FAQ',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New FAQ"),
		'edit_item' => __("Edit FAQ"),
		'new_item' => __("New FAQ"),
		'view_item' => __("View FAQ"),
		'search_items' => __("Search FAQ"),
		'not_found' =>  __("No FAQ Found"),
		'not_found_in_trash' => __("No FAQ Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('faq' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => array('slug' => 'faq'),
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}
 
/**
 * FAQ Category Taxonomy
 */
add_action( 'init', 'istl_faq_taxonomy', 0 );
function istl_faq_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('faq_cat'), 'faq', array(
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
 * FAQ Meta Box
 */
//add_action( 'add_meta_boxes', 'istl_faq_meta_box' );
function istl_faq_meta_box(){
    add_meta_box( 'faq-details', 'FAQ Details', 'istl_faq_metabox_cb', 'faq', 'normal', 'default');
}

function istl_faq_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'faq_client',
                'label'=>'Client Name',
                'classes'=>'faq-field'
            ), 
            array(
                'name'=>'faq_location',
                'label'=>'Location',
                'classes'=>'faq-field'
            ), 
            array(
                'name'=>'faq_url',
                'label'=>'URL',
                'classes'=>'faq-field'
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
 * Save FAQ Meta Fields Value
 */
//add_action( 'save_post', 'istl_faq_save_meta_box' );
function istl_faq_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $faq_fields = array('faq_client', 'faq_location', 'faq_url' );  

    if($faq_fields) {   
        foreach($faq_fields as $faq_field) {    
            if(isset( $_POST[$faq_field] ) ) {
                update_post_meta( $post_id, $faq_field, $_POST[$faq_field]);
            }  
        }
    }    
} 

/*
 * Get FAQ Details 
 * Return Array
 */
function istl_get_faq_details($post_id) {   
    
    $output = array();
    $output['faq_title'] = get_the_title($post_id); 
    $output['faq_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $faq_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $faq_image = get_stylesheet_directory_uri().'/images/default-faq.jpg'; 
    } 
    
    $output['faq_image'] = $faq_image;   

    $faq_fields = array('faq_client', 'faq_location', 'faq_url');   
    if($faq_fields) { 
        foreach($faq_fields as $faq_field) {  
            $output[$faq_field] = get_post_meta($post_id, $faq_field, true);  
        } 
    }
    return $output;  
}
