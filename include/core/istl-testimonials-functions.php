<?php 

/*
 * Testimonials Post Type
 */
function istl_testimonials_posttype() {
  $args = array(
    'labels' => array(
      'name' => __('Testimonials'),
      'singular_name' => __('Testimonials'),
      'all_items' => __('All Testimonials'),
      'add_new_item' => __('Add New Testimonial'),
      'edit_item' => __('Edit Testimonial'),
      'view_item' => __('View Testimonial')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'testimonials'),
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'capability_type' => 'page',
    'supports' => array('title', 'editor', 'thumbnail'),
    'exclude_from_search' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-format-status'
    );
  register_post_type('testimonials', $args);
}
add_action( 'init', 'istl_testimonials_posttype');

/*
 * Testimonials Meta Box
 */
add_action( 'add_meta_boxes', 'istl_testimonials_meta_box' );
function istl_testimonials_meta_box(){
    add_meta_box( 'testimonial-details', 'Testimonial Details', 'istl_testimonials_metabox_cb', 'testimonials', 'normal', 'default');
}

function istl_testimonials_metabox_cb($post){
    $values = get_post_custom( $post->ID );
    $client_name = isset( $values['star_rate'] ) ? esc_attr( $values['star_rate'][0] ) : "";
    $company = isset( $values['company'] ) ? esc_attr( $values['company'][0] ) : "";
    wp_nonce_field( 'testimonial_details_nonce_action', 'testimonial_details_nonce' );
    $html = '';
    $html .= '<label>Rating (Star)</label> <br />';
    $html .= '<input type="number" min="0" max="5" name="star_rate" id="star_rate" style="margin-top:15px;  margin-bottom:15px; width:50px; " value="'. $client_name .'" /><br/>';
    $html .= '<label>Company</label>';
    $html .= '<input type="text" name="company" id="company" style=" margin-bottom:15px; width:100%;" value="'. $company .'" />';
    echo $html;
}

/*
 * Save Testimonails Meta Fields Value
 */
add_action( 'save_post', 'istl_testimonials_save_meta_box' );
function istl_testimonials_save_meta_box($post_id){
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
 
    if( !isset( $_POST['testimonial_details_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_details_nonce'], 'testimonial_details_nonce_action' ) ) return;
 
    if( !current_user_can( 'edit_post' ) ) return;
 
    if(isset( $_POST['star_rate'] ) )
        update_post_meta( $post_id, 'star_rate', $_POST['star_rate']);
 
    if(isset( $_POST['company'] ) )
        update_post_meta( $post_id, 'company', $_POST['company']);
}

/*
 * Get Testimonails Details 
 * Return Array
 */
function istl_get_testimonial_detail($post_id) {
    $output = array(); 
    
    $output['client_name'] = get_the_title($post_id); 
    $output['client_testimonial'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $profile_photo = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $profile_photo = get_stylesheet_directory_uri().'/images/default-member-photo.jpg'; 
    }
    
    $output['profile_photo'] = $profile_photo; 
    
        $testimonials_array = array('company', 'star_rate');
        if($testimonials_array) {
            foreach($testimonials_array as $testimonial) {
                $output[$testimonial] = get_post_meta($post_id, $testimonial, true);     
            }
        }
    
    return $output;
}
 
