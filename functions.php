<?php
   
// Nav Walker File
require_once('include/wp-bootstrap-navwalker.php');

//Basic Theme Functions
require_once('include/theme-default-functions.php');  

//Custom Post Types 
require_once('include/post-types/post-type-tutorials.php');
require_once('include/post-types/post-type-programs.php');
require_once('include/post-types/post-type-examples.php');
require_once('include/post-types/post-type-interview-questions.php');

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
