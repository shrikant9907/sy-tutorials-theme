<?php


 
add_action( 'wp_ajax_subscribe_action', 'subscribe_action_fn' );
add_action( 'wp_ajax_nopriv_subscribe_action', 'subscribe_action_fn' );
function subscribe_action_fn() {
    
    $formdata = $_POST['formdata'];
    
    parse_str($formdata, $formdata);
    
    $subscriber_name = trim($formdata['subscriber_name']); 
    $subscriber_email = trim($formdata['subscriber_email']);
    
    if(($subscriber_name!='') && ($subscriber_email!=''))  {  
        if ( is_email( $subscriber_email ) ) {
            
            // Create post object
            $subscribe_post = array(
                'post_title'    => $subscriber_name,
                'post_content'  => trim($subscriber_email),
                'post_status'   => 'publish',
                'post_type' => 'istl_subscribers'
            );

            // Insert the post into the database
            $subscription_id = wp_insert_post( $subscribe_post ); 
            if($subscription_id) {
                
                update_post_meta($subscription_id,'subscriber_name', $subscriber_name);
                update_post_meta($subscription_id,'subscriber_email', $subscriber_email);
                
            }
            
            echo '<div class="thankyou_subs">Thank you for subscribing.</div>';
            
        } else {
              echo '<div class="thankyou_subs subs_warning">Invalid Email.</div>';  
        }
        
    } else {
        echo '<div class="thankyou_subs subs_warning">Name and Emails Required</div>'; 
    } 
     
    wp_die();
}


/*
 * Subscribers Post Type
 */
function istl_subscribers_posttype() {
  $args = array(
    'labels' => array(
      'name' => __('Subscribers'),
      'singular_name' => __('Subscribers'),
      'all_items' => __('All Subscriber'),
      'add_new_item' => __('Add New Subscriber'),
      'edit_item' => __('Edit Subscriber'),
      'view_item' => __('View Subscriber')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'subscribers'),
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'capability_type' => 'page',
    'supports' => array('title', 'editor', 'thumbnail'),
    'exclude_from_search' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-format-status'
    );
  register_post_type('istl_subscribers', $args);
}
add_action( 'init', 'istl_subscribers_posttype'); 
