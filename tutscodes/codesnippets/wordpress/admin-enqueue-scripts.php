<?php

/*
 * Admin Scripts
 */
function istl_admin_enqueue_scripts() {
    
    // Admin Styles 
    wp_enqueue_style( 'istl-jquery-ui-style', get_stylesheet_directory_uri().'/css/jquery-ui.css' );
    wp_enqueue_style( 'istl-admin-style', get_stylesheet_directory_uri().'/css/admin-style.css' );
 
    // Admin Scripts
    wp_enqueue_script( 'istl-admin-scripts', get_stylesheet_directory_uri().'/js/admin-scripts.js', '20170926', true );

}
add_action( 'admin_enqueue_scripts', 'istl_admin_enqueue_scripts' );
