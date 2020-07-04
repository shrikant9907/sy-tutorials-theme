<?php


/*
 * Event Post Type
 */
function istl_event_post_type() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Events', 'text_domain' ),
		'name_admin_bar'        => __( 'Events', 'text_domain' ),
		'archives'              => __( 'Event Archives', 'text_domain' ),
		'attributes'            => __( 'Event Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
		'all_items'             => __( 'All Event', 'text_domain' ),
		'add_new_item'          => __( 'Add New Event', 'text_domain' ),
		'add_new'               => __( 'Add New Event', 'text_domain' ),
		'new_item'              => __( 'New Event', 'text_domain' ),
		'edit_item'             => __( 'Edit Event', 'text_domain' ),
		'update_item'           => __( 'Update Event', 'text_domain' ),
		'view_item'             => __( 'View Event', 'text_domain' ),
		'view_items'            => __( 'View Events', 'text_domain' ),
		'search_items'          => __( 'Search Event', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into event', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'our_events', $args );

}
add_action( 'init', 'istl_event_post_type', 0 ); 

/**
 * Event Type Taxonomy 
 */
add_action( 'init', 'istl_event_taxonomy', 0 );
function istl_event_taxonomy() {  
	
	// Labels
	$singular = 'Type';
	$plural = 'Types'; 
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
        
	register_taxonomy( strtolower('event_type'), 'our_events', array(
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
 * Event Meta Box
 */
add_action( 'add_meta_boxes', 'istl_event_meta_box' );
function istl_event_meta_box(){
    add_meta_box( 'event-details', 'Event Details', 'istl_event_metabox_cb', 'our_events', 'normal', 'default');
}

function istl_event_metabox_cb($post){
 
    $event_metafields = array( 
            array(
                'name'=>'event_start_date',
                'label'=>'Event Start Date',
                'classes'=>'event-field datepicker',
                'type'=>'text',
                'placeholder'=>'MM/DD/YY', 
                'description' => ''
            ),
            array(
                'name'=>'event_start_time',
                'label'=>'Event Start Time',
                'classes'=>'event-field',
                'type'=>'time_selector',
                'field_group' => array('event_start_time_hour','event_start_time_min','event_start_time_am_pm')
            ),
            array(
                'name'=>'event_end_date',
                'label'=>'Event End Date',
                'classes'=>'event-field datepicker',
                'type'=>'text',
                'placeholder'=>'MM/DD/YY', 
                'description' => ''
            ),
            array(
                'name'=>'event_end_time',
                'label'=>'Event End Time',
                'classes'=>'event-field',
                'type'=>'time_selector',
                'field_group' => array('event_end_time_hour','event_end_time_min','event_end_time_am_pm') 
            ),
            array(
                'name'=>'event_website_url',
                'label'=>'Event Website URL',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. http://example.com/', 
                'description' => ''
            ),
            array( 
                'name'=>'organizer_name',
                'label'=>'Organizer Name',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. Alex', 
                'description' => ''
            ),
            array(
                'name'=>'organizer_phone',
                'label'=>'Organizer Phone Number',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. 123456789', 
                'description' => ''
            ),
            array(
                'name'=>'organizer_website',
                'label'=>'Organizer Website',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. http://example.com/',  
                'description' => ''
            ),
            array(
                'name'=>'orgazier_email',
                'label'=>'Organizer Email',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. example@example.com',  
                'description' => ''
            ),
            array(
                'name'=>'venue_address',
                'label'=>'Venue',
                'classes'=>'event-field',
                'type'=>'textarea',
                'placeholder'=>'Address',  
                'description' => '' 
            ),
            array(
                'name'=>'venue_country',
                'label'=>'Country',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. India',  
                'description' => '' 
            ),
            array(
                'name'=>'venue_state',
                'label'=>'State',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. Madhya Pradesh',  
                'description' => '' 
            ),
            array(
                'name'=>'venue_city',
                'label'=>'City',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. Indore',  
                'description' => '' 
            ),
            array(
                'name'=>'venue_zip_code',
                'label'=>'Zip Code',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. 452001',  
                'description' => '' 
            ),
            array(
                'name'=>'venue_contact_number',
                'label'=>'Venue Contact Number',
                'classes'=>'event-field',
                'type'=>'text',
                'placeholder'=>'Eg. 123456789',  
                'description' => '' 
            ),
        
        );    
    $html = '<br />';
    if($event_metafields) { 
        foreach($event_metafields as $event) {
            $values = get_post_meta( $post->ID, $event['name'], true );
            $value = isset( $values ) ? esc_attr( $values ) : "";
               
            $html .= '<div class="istl-row"><div class="istl-col"><label>'.$event['label'].'</label>';
            if($event['description']!='') {
                $html .= '<p class="description">'.$event['description'].'</p>';
            }
            $html .= '</div>'; 
          
            // Text
            if($event['type']=='text')  {   
                $html .= '<div class="istl-col"><input class="'.$event['classes'].'" placeholder="'.$event['placeholder'].'" type="'.$event['type'].'" name="'.$event['name'].'" id="'.$event['name'].'" style=" margin-bottom:15px; width:400px;" value="'.$value.'" /></div>';     
            } 
            
            // Textarea
            if($event['type']=='textarea')  {  
                $html .= '<div class="istl-col"><textarea class="'.$event['classes'].'" placeholder="'.$event['placeholder'].'" type="'.$event['type'].'" name="'.$event['name'].'" id="'.$event['name'].'" style=" margin-bottom:15px; height:100px; width:400px;"/>'.$value.'</textarea></div>';     
            }
            
            // Time Selector
            if($event['type']=='time_selector')  {  
                $time_fields = $event['field_group'];
                 $hours = get_post_meta( $post->ID, $time_fields['0'], true );
                // Hour
                $html .= '<div class="istl-col"><p><select id="'.$time_fields['0'].'" name="'.$time_fields['0'].'" class="'.$time_fields['0'].'">';
                        for($i=0; $i<=12; $i++) { 
                            
                            if($i<10) {
                                $i = '0'.$i;  
                            }
                          $html .= '<option '.selected($hours,$i,true).' value="'.$i.'">'.$i.'</option>'; 
                       }
                $html .= '</select>';
                $html .= ' : ';
                
                $mins = get_post_meta( $post->ID, $time_fields['1'], true );
                // Min
                $html .= '<select id="'.$time_fields['1'].'" name="'.$time_fields['1'].'" class="'.$time_fields['1'].'">';
                        for($i=0; $i<=60; $i++) { 
                            if($i<10) {
                                $i = '0'.$i;  
                            }
                        $html .= '<option '.selected($mins,$i,true).' value="'.$i.'">'.$i.'</option>'; 
                       }
                $html .= '</select>';
                $html .= ' : ';
                
                $ampm = get_post_meta( $post->ID, $time_fields['2'], true );
                // AM OR PM
                $html .= '<select id="'.$time_fields['2'].'" name="'.$time_fields['2'].'" class="'.$time_fields['2'].'">';
                    $html .= '<option '.selected($ampm, 'AM', false).' value="AM">AM</option>'; 
                    $html .= '<option '.selected($ampm, 'PM', false).' value="PM">PM</option>'; 
                $html .= '</select></p></div>';
                
            }
           
            $html .= '</div>'; 
            
        }
    }
   
    echo $html;
}

/*
 * Save Event Meta Fields Value
 */
add_action( 'save_post', 'istl_event_save_meta_box' ); 
function istl_event_save_meta_box($post_id){   
 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post' ) ) return;
 
    $event_fields = array('event_start_date', 'event_start_time_hour', 'event_start_time_min', 'event_start_time_am_pm', 'event_end_date', 'event_end_time_hour', 'event_end_time_min', 'event_end_time_am_pm', 'event_website_url', 'organizer_name', 'organizer_phone', 'organizer_website', 'orgazier_email', 'venue_address', 'venue_country', 'venue_state', 'venue_city', 'venue_zip_code', 'venue_contact_number' );  

    if($event_fields) {   
        foreach($event_fields as $event_field) {    
            if(isset( $_POST[$event_field] ) ) {
                update_post_meta( $post_id, $event_field, $_POST[$event_field]);
            }  
        }
    }    
} 

/*
 * Get Event Details 
 * Return Array
 */
function istl_get_event_details($post_id) {   
    
    $output = array();
    $output['event_title'] = get_the_title($post_id); 
    $output['event_desc'] = get_post($post_id)->post_content;   
    
    if ( has_post_thumbnail($post_id) ) { 
        $event_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    } else {
        $event_image = get_stylesheet_directory_uri().'/images/default-event.jpg';  
    } 
    
    $output['event_image'] = $event_image;   

    $event_fields = array('event_start_date', 'event_start_time_hour', 'event_start_time_min', 'event_start_time_am_pm', 'event_end_date', 'event_end_time_hour', 'event_end_time_min', 'event_end_time_am_pm', 'event_website_url', 'organizer_name', 'organizer_phone', 'organizer_website', 'orgazier_email', 'venue_address', 'venue_country', 'venue_state', 'venue_city', 'venue_zip_code', 'venue_contact_number' );  
  
    if($event_fields) { 
        foreach($event_fields as $event_field) {  
            $output[$event_field] = get_post_meta($post_id, $event_field, true);  
        } 
    }
    return $output;  
}

