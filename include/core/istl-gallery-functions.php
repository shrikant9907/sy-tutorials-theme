<?php


  /*
  * Gallery Post Type
  */ 
add_action('init','istl_gallery_post_type');
function istl_gallery_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Gallery", "post type general name"),
		'singular_name' => _x("Gallery", "post type singular name"),
		'menu_name' => 'Gallery',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Gallery Image"),
		'edit_item' => __("Edit Gallery Image"),
		'new_item' => __("New Gallery Image"),
		'view_item' => __("View Gallery"),
		'search_items' => __("Search Gallery"),
		'not_found' =>  __("No Gallery Image Found"),
		'not_found_in_trash' => __("No Gallery Image Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('ourgallery' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-format-gallery',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}

/**
 * Gallery Category Taxonomy 
 */
add_action( 'init', 'istl_gallery_taxonomy', 0 );
function istl_gallery_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('gallery_cat'), 'ourgallery', array(
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
 * Gallery Meta Box
 */
add_action( 'add_meta_boxes', 'istl_gallery_meta_box' );
function istl_gallery_meta_box(){
    add_meta_box( 'gallery-details', 'Gallery Details', 'istl_gallery_metabox_cb', 'ourgallery', 'normal', 'default');
}

function istl_gallery_metabox_cb($post){
 
    $gallery_metafields = array(
            array(
                'name'=>'image_caption',
                'label'=>'Image Caption',
                'classes'=>'gallery-field',
                'type'=>'text',
                'placeholder'=>'', 
                'description' => ''
            )
        );    
    $html = '';
    if($gallery_metafields) { 
        foreach($gallery_metafields as $gallery) {
            $values = get_post_meta( $post->ID, $gallery['name'], true );
            $value = isset( $values ) ? esc_attr( $values ) : "";
               
            $html .= '<label>'.$gallery['label'].'</label>'; 
            $html .= '<p class="description">'.$gallery['description'].'</p>'; 
            $html .= '<input placeholder="'.$gallery['placeholder'].'" type="'.$gallery['type'].'" name="'.$gallery['name'].'" id="'.$gallery['name'].'" style=" margin-bottom:15px; width:100%;" value="'.$value.'" />';     
        }
    }
   
    echo $html;
}

/*
 * Save Gallery Meta Fields Value
 */
add_action( 'save_post', 'istl_gallery_save_meta_box' ); 
function istl_gallery_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $gallery_fields = array('image_caption' );  

    if($gallery_fields) {   
        foreach($gallery_fields as $gallery_field) {    
            if(isset( $_POST[$gallery_field] ) ) {
                update_post_meta( $post_id, $gallery_field, $_POST[$gallery_field]);
            }  
        }
    }    
} 

/*
 * Get Gallery Details 
 * Return Array
 */
function istl_get_gallery_details($post_id) {   
    
    $output = array();
    $output['gallery_title'] = get_the_title($post_id); 
    $output['gallery_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $gallery_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $gallery_image = get_stylesheet_directory_uri().'/images/default-gallery.jpg';  
    } 
    
    $output['gallery_image'] = $gallery_image;   

    $gallery_fields = array('image_caption');    
    if($gallery_fields) { 
        foreach($gallery_fields as $gallery_field) {  
            $output[$gallery_field] = get_post_meta($post_id, $gallery_field, true);  
        } 
    }
    return $output;  
}
 
  