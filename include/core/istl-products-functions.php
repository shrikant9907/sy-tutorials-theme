<?php


   
/*
  * Product Post Type
  */ 
add_action('init','istl_our_products_post_type');
function istl_our_products_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Products", "post type general name"),
		'singular_name' => _x("Product", "post type singular name"),
		'menu_name' => 'Products',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Product Item"),
		'edit_item' => __("Edit Product Item"),
		'new_item' => __("New Product Item"),
		'view_item' => __("View Product"),
		'search_items' => __("Search Product"),
		'not_found' =>  __("No Product Item Found"),
		'not_found_in_trash' => __("No Product Item Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('ourproducts' , array( 
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-cart',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}

/**
 * Product Category Taxonomy
 */
add_action( 'init', 'istl_our_products_taxonomy', 0 );
function istl_our_products_taxonomy() {  
	
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
        
	register_taxonomy( strtolower('our_product_cat'), 'ourproducts', array(
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
 * Product Meta Box
 */
add_action( 'add_meta_boxes', 'istl_our_products_meta_box' );
function istl_our_products_meta_box(){
    add_meta_box( 'product-details', 'Product Details', 'istl_our_products_metabox_cb', 'ourproducts', 'normal', 'default');
}

function istl_our_products_metabox_cb($post){
 
    $profolio_metafields = array(
            array(
                'name'=>'product_regular_price',
                'label'=>'Product Regular Price',
                'classes'=>'product-field',
                'type'=>'text',
                'placeholder'=>'', 
                'description'=>'' 
            ), 
            array(
                'name'=>'product_sales_price',
                'label'=>'Product Sales Price',
                'classes'=>'product-field',
                'type'=>'text',
                'placeholder'=>'',
                'description'=>''     
            ), 
            array(
                'name'=>'product_short_description',
                'label'=>'Product Short Description',
                'classes'=>'product-field',
                'type'=>'text',
                'placeholder'=>'',
                'description'=>''     
            ), 
            array(
                'name'=>'product_offer_message',
                'label'=>'Offer Message',
                'classes'=>'product-field',
                'type'=>'text',
                'placeholder'=>'',
                'description'=>''     
            ), 
            array(
                'name'=>'product_link',
                'label'=>'Product Link(Optional)',
                'classes'=>'product-field',
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
 * Save Product Meta Fields Value
 */
add_action( 'save_post', 'istl_our_products_save_meta_box' );
function istl_our_products_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $product_fields = array('product_regular_price', 'product_sales_price', 'product_offer_message', 'product_short_description', 'product_link' );  

    if($product_fields) {   
        foreach($product_fields as $product_field) {    
            if(isset( $_POST[$product_field] ) ) {
                update_post_meta( $post_id, $product_field, $_POST[$product_field]);
            }  
        }
    }    
} 

/*
 * Get Product Details 
 * Return Array
 */
function istl_get_our_products_details($post_id) {   
    
    $output = array();
    $output['product_title'] = get_the_title($post_id); 
    $output['product_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $product_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $product_image = get_stylesheet_directory_uri().'/images/default-product.jpg';  
    } 
    
    $output['product_image'] = $product_image;   

    $product_fields = array('product_regular_price', 'product_sales_price', 'product_link');    
    if($product_fields) { 
        foreach($product_fields as $product_field) {  
            $output[$product_field] = get_post_meta($post_id, $product_field, true);  
        }  
    }
    return $output;  
}
   