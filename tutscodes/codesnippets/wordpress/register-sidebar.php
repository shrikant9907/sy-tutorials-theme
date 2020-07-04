<?php

/* 
 * Register Sidebar 
 */
function custom_wordpress_theme_widgets_init() { 

  register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'wordpress-theme' ),
    'description'   => 'It will display on Post Details OR Listing pages.',
    'id'            => 'main-sidebar-1',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));   
    
  register_sidebar( array(
    'name'          => __( 'Footer Sidebar1', 'wordpress-theme' ),
    'id'            => 'footer-sidebar-1',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));  
   
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar2', 'wordpress-theme' ),
    'id'            => 'footer-sidebar-2',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  )); 
    
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar3', 'wordpress-theme' ),
    'id'            => 'footer-sidebar-3',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  )); 
   
   register_sidebar( array(
    'name'          => __( 'Footer Sidebar4', 'wordpress-theme' ),
    'id'            => 'footer-sidebar-4',
    'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  )); 
 
}  
add_action( 'widgets_init', 'custom_wordpress_theme_widgets_init',10, 0 ); 
