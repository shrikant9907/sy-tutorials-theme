<?php

/*
 * Add / Remove User Roles
 */
function add_new_user_roles() {
  
add_role( 'admin', 'Admin', array( 'read' => true, 'level_7' => true ) );  

if( get_role('author') ){
      remove_role( 'author' );
}

if( get_role('contributor') ){
      remove_role( 'contributor' );
}

if( get_role('subscriber') ){
      remove_role( 'subscriber' );
}
  
}
add_action('init','add_new_user_roles');