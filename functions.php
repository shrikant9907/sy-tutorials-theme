<?php
   
// Nav Walker File
require_once('include/wp-bootstrap-navwalker.php');

//Basic Theme Functions
require_once('include/theme-default-functions.php');  

// Core Functions
require_once('include/core-functions.php');  

//Custom Post Types 
require_once('include/tutorials-posttype-functions.php');
require_once('include/interview-questions-functions.php'); 

// Ajax Functions   
require_once('include/ajax-functions.php');

/*
 * Admin Bar Hide
 */
add_filter('show_admin_bar', '__return_false');

/* 
 * Auto Update Plugins 
 */
add_filter( 'auto_update_plugin', '__return_true' );  
