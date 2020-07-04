<?php


/*
 * Team Profiles Post Type
 */
add_action( 'init', 'istl_team_post_type');
function istl_team_post_type() {
   
   // Labels
	$labels = array(
		'name' => _x("Team", "post type general name"),
		'singular_name' => _x("Team", "post type singular name"),
		'menu_name' => 'Team Profiles',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Profile"),
		'edit_item' => __("Edit Profile"),
		'new_item' => __("New Profile"),
		'view_item' => __("View Profile"),
		'search_items' => __("Search Profiles"),
		'not_found' =>  __("No Profiles Found"),
		'not_found_in_trash' => __("No Profiles Found in Trash"),
		'parent_item_colon' => ''
	);
	
	// Register post type
	register_post_type('team' , array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
                'menu_icon' => 'dashicons-groups',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	) ); 
}

/**
 * Team Department Taxonomy
 */
add_action( 'init', 'istl_team_taxonomy', 0 );
function istl_team_taxonomy() {
	
	// Labels
	$singular = 'Department';
	$plural = 'Departments';
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
        
	register_taxonomy( strtolower($singular), 'team', array(
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
 * Team Meta Box
 */
add_action( 'add_meta_boxes', 'istl_team_meta_box' );
function istl_team_meta_box(){
    add_meta_box( 'team-details', 'Team Details', 'istl_team_metabox_cb', 'team', 'normal', 'default');
}

function istl_team_metabox_cb($post){
    $values = get_post_custom( $post->ID );
    $member_position = isset( $values['member_position'] ) ? esc_attr( $values['member_position'][0] ) : "";
    $member_email = isset( $values['member_email'] ) ? esc_attr( $values['member_email'][0] ) : "";
    $member_phone = isset( $values['member_phone'] ) ? esc_attr( $values['member_phone'][0] ) : "";
    $member_twitter = isset( $values['member_twitter'] ) ? esc_attr( $values['member_twitter'][0] ) : "";
    $member_facebook = isset( $values['member_facebook'] ) ? esc_attr( $values['member_facebook'][0] ) : "";
    $member_linkedin = isset( $values['member_linkedin'] ) ? esc_attr( $values['member_linkedin'][0] ) : "";
    $member_youtube = isset( $values['member_youtube'] ) ? esc_attr( $values['member_youtube'][0] ) : "";
    $member_instagram = isset( $values['member_instagram'] ) ? esc_attr( $values['member_instagram'][0] ) : "";
    $html = '';
    $html .= '<label>Position</label>';
    $html .= '<input type="text" name="member_position" id="member_position" style="margin-top:15px; margin-bottom:15px; width:100%; " value="'. $member_position .'" /><br/>';
    $html .= '<label>Email ID</label>';
    $html .= '<input type="text" name="member_email" id="member_email" style=" margin-bottom:15px; width:100%;" value="'. $member_email .'" /><br/>';
    $html .= '<label>Phone Number</label>';
    $html .= '<input type="text" name="member_phone" id="member_phone" style=" margin-bottom:15px; width:100%;" value="'. $member_phone .'" /><br/>';
    $html .= '<label>Twitter Link</label>';
    $html .= '<input type="text" name="member_twitter" id="member_twitter" style=" margin-bottom:15px; width:100%;" value="'. $member_twitter .'" /><br/>';
    $html .= '<label>Facebook Link</label>';
    $html .= '<input type="text" name="member_facebook" id="member_facebook" style=" margin-bottom:15px; width:100%;" value="'. $member_facebook .'" /><br/>';
    $html .= '<label>Linkedin Link</label>';
    $html .= '<input type="text" name="member_linkedin" id="member_linkedin" style=" margin-bottom:15px; width:100%;" value="'. $member_linkedin .'" /><br/>';
    $html .= '<label>Youtube Link</label>';
    $html .= '<input type="text" name="member_youtube" id="member_youtube" style=" margin-bottom:15px; width:100%;" value="'. $member_youtube .'" /><br/>';
    $html .= '<label>Instagram Link</label>';
    $html .= '<input type="text" name="member_instagram" id="member_instagram" style=" margin-bottom:15px; width:100%;" value="'. $member_instagram .'" />';
    echo $html;
}

/*
 * Save Team Meta Fields Value
 */
add_action( 'save_post', 'istl_team_save_meta_box' );
function istl_team_save_meta_box($post_id){
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $team_fields = array('member_position', 'member_email', 'member_phone', 'member_twitter', 'member_facebook', 'member_linkedin', 'member_youtube', 'member_instagram'); 

    if($team_fields) { 
        foreach($team_fields as $team_field) {  
            if(isset( $_POST[$team_field] ) )
                update_post_meta( $post_id, $team_field, $_POST[$team_field]);  
        }
    }    
}

/*
 * Get Team Details By ID
 * Return Array
 */
function istl_get_team_member_details($post_id) {   

    $output = array();
    $output['member_name'] = get_the_title($post_id); 
    $output['member_description'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $profile_photo = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $profile_photo = get_stylesheet_directory_uri().'/images/default-member-photo.jpg'; 
    }
    
    $output['profile_photo'] = $profile_photo; 

    $team_fields = array('member_position', 'member_email', 'member_phone', 'member_twitter', 'member_facebook', 'member_linkedin', 'member_youtube', 'member_instagram'); 
    if($team_fields) { 
        foreach($team_fields as $team_field) {  
            $output[$team_field] = get_post_meta($post_id, $team_field, true);
        }
    }
    return $output;  
}
 