<?php

/*
 * Add Scripts and Localize Script in WP Footer
 */
add_action('wp_footer','istl_wp_footer_scripts');
function istl_wp_footer_scripts() {   
wp_enqueue_script( 'theme-scripts-ajax', get_stylesheet_directory_uri().'/js/theme-scripts-ajax.js' );     

     wp_localize_script('theme-scripts-ajax', 'local', array(
     'ajaxurl' => admin_url('admin-ajax.php')
     ));

 }  