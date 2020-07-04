<?php



/*
  * Service Post Type
  */ 
add_action('init','istl_our_services_post_type');
function istl_our_services_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Services", "post type general name"),
		'singular_name' => _x("Service", "post type singular name"),
		'menu_name' => 'Services',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Service Item"),
		'edit_item' => __("Edit Service Item"),
		'new_item' => __("New Service Item"),
		'view_item' => __("View Service"),
		'search_items' => __("Search Service"),
		'not_found' =>  __("No Service Item Found"),
		'not_found_in_trash' => __("No Service Item Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('ourservices' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-media-code',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}

/**
 * Service Category Taxonomy
 */
add_action( 'init', 'istl_our_services_taxonomy', 0 );
function istl_our_services_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('service_cat'), 'ourservices', array(
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => false,
		'labels' => $labels 
	) );
}

/*
 * Service Meta Box
 */
add_action( 'add_meta_boxes', 'istl_our_services_meta_box' );
function istl_our_services_meta_box(){
    add_meta_box( 'service-details', 'Service Details', 'istl_our_services_metabox_cb', 'ourservices', 'normal', 'default');
}

function istl_our_services_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'service_icon',
                'label'=>'Service Icon',
                'classes'=>'service-field',
                'type'=>'text',
                'placeholder'=>'Eg. fa fa-wordpress',
                'description'=>'Copy and Paste Font Awesome class eg. "fa fa-wordpress" <a target="_blank" href="http://fontawesome.io/icons/">Font Awesome Link</a>' 
            ), 
            array(
                'name'=>'service_link',
                'label'=>'Service Link(Optional)',
                'classes'=>'service-field',
                'type'=>'text',
                'placeholder'=>'Eg. http://example.com/', 
                'description' => ''
            )
        );    
    $html = '';
    if($profolio_metafields) { 
        foreach($profolio_metafields as $profolio) {
            $values = get_post_meta( $post->ID, $profolio['name'], true );
            $value = isset( $values ) ? esc_attr( $values ) : "";
            $html .= '<label>'.$profolio['label'].'</label>'; 
            $html .= '<p class="description">'.$profolio['description'].'</p>'; 
            $html .= '<input placeholder="'.$profolio['placeholder'].'" type="'.$profolio['type'].'" name="'.$profolio['name'].'" id="'.$profolio['name'].'" style=" margin-bottom:15px; width:100%;" value="'.$value.'" />';     
        }
    }
   
    echo $html;
}

/*
 * Save Service Meta Fields Value
 */
add_action( 'save_post', 'istl_our_services_save_meta_box' );
function istl_our_services_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $service_fields = array('service_icon', 'service_link' );  

    if($service_fields) {   
        foreach($service_fields as $service_field) {    
            if(isset( $_POST[$service_field] ) ) {
                update_post_meta( $post_id, $service_field, $_POST[$service_field]);
            }  
        }
    }    
} 

/*
 * Get Service Details 
 * Return Array
 */
function istl_get_our_services_details($post_id) {   
    
    $output = array();
    $output['service_title'] = get_the_title($post_id); 
    $output['service_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $service_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $service_image = get_stylesheet_directory_uri().'/images/default-service.jpg';  
    } 
    
    $output['service_image'] = $service_image;   

    $service_fields = array('service_icon', 'service_link');    
    if($service_fields) { 
        foreach($service_fields as $service_field) {  
            $output[$service_field] = get_post_meta($post_id, $service_field, true);  
        } 
    }
    return $output;  
}