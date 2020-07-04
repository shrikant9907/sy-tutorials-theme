<?php

/* 
 * User Capabilites
 */
add_action('admin_init', 'ric_user_capabilities');
function ric_user_capabilities() {
  
    // Admin
    $adminrole = get_role( 'admin' );
    $adminrole->remove_cap( 'manage_options' );  
    $adminrole->remove_cap( 'delete_user' );    
    $adminrole->remove_cap( 'remove_user' );        
    $adminrole->add_cap( 'upload_files' );         
    $adminrole->add_cap( 'delete_posts' );              
    $adminrole->add_cap( 'edit_others_posts' );              
    $adminrole->add_cap( 'edit_others_pages' );              
    $adminrole->add_cap( 'edit_posts' );              
    $adminrole->add_cap( 'edit_published_posts' );              

    
}  