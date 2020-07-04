<?php


 /*
  * Portfolio Post Type
  */ 
add_action('init','istl_portfolio_post_type');
function istl_portfolio_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Portfolio", "post type general name"),
		'singular_name' => _x("Portfolio", "post type singular name"),
		'menu_name' => 'Portfolio',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Portfolio Item"),
		'edit_item' => __("Edit Portfolio Item"),
		'new_item' => __("New Portfolio Item"),
		'view_item' => __("View Portfolio"),
		'search_items' => __("Search Portfolio"),
		'not_found' =>  __("No Portfolio Item Found"),
		'not_found_in_trash' => __("No Portfolio Item Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('portfolio' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-images-alt2',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}

/**
 * Portfolio Category Taxonomy
 */
add_action( 'init', 'istl_portfolio_taxonomy', 0 );
function istl_portfolio_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('portfolio_cat'), 'portfolio', array(
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
 * Portfolio Meta Box
 */
add_action( 'add_meta_boxes', 'istl_portfolio_meta_box' );
function istl_portfolio_meta_box(){
    add_meta_box( 'portfolio-details', 'Portfolio Details', 'istl_portfolio_metabox_cb', 'portfolio', 'normal', 'default');
}

function istl_portfolio_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'portfolio_client',
                'label'=>'Client Name',
                'classes'=>'portfolio-field'
            ), 
            array(
                'name'=>'portfolio_location',
                'label'=>'Location',
                'classes'=>'portfolio-field'
            ), 
            array(
                'name'=>'portfolio_url',
                'label'=>'URL',
                'classes'=>'portfolio-field'
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
 * Save Portfolio Meta Fields Value
 */
add_action( 'save_post', 'istl_portfolio_save_meta_box' );
function istl_portfolio_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $portfolio_fields = array('portfolio_client', 'portfolio_location', 'portfolio_url' );  

    if($portfolio_fields) {   
        foreach($portfolio_fields as $portfolio_field) {    
            if(isset( $_POST[$portfolio_field] ) ) {
                update_post_meta( $post_id, $portfolio_field, $_POST[$portfolio_field]);
            }  
        }
    }    
} 

/*
 * Get Portfolio Details 
 * Return Array
 */
function istl_get_portfolio_details($post_id) {   
    
    $output = array();
    $output['portfolio_title'] = get_the_title($post_id); 
    $output['portfolio_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $portfolio_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $portfolio_image = get_stylesheet_directory_uri().'/images/default-portfolio.jpg'; 
    } 
    
    $output['portfolio_image'] = $portfolio_image;   

    $portfolio_fields = array('portfolio_client', 'portfolio_location', 'portfolio_url');   
    if($portfolio_fields) { 
        foreach($portfolio_fields as $portfolio_field) {  
            $output[$portfolio_field] = get_post_meta($post_id, $portfolio_field, true);  
        } 
    }
    return $output;  
}
