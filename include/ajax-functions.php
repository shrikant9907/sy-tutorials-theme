<?php 

add_action( 'wp_ajax_apply_for_job', 'apply_for_job_function' );
add_action( 'wp_ajax_nopriv_apply_for_job', 'apply_for_job_function' );

function apply_for_job_function() {
    
    $jobid = $_POST['jobid']; 
    $cuid = get_current_user_id();
    
    $appliedby = get_post_meta($jobid,'applied_by',true);
    $appliedto = get_user_meta($cuid,'my_applied_jobs',true);
     
    
    // Update in Job
    if(is_array($appliedby)) {
        if(!in_array($cuid,$appliedby)) {
            $appliedby[] = $cuid;
            update_post_meta($jobid,'applied_by',$appliedby);       
        }
    } else { 
        $appliedby = array();
        $appliedby[] = $cuid;
        update_post_meta($jobid,'applied_by',$appliedby);
    }
     
    // Update in User
    if(is_array($appliedto)) {
        if(!in_array($jobid,$appliedto)) {
            $appliedto[] = $jobid;
            update_user_meta($cuid,'my_applied_jobs',$appliedto);       
        }
    } else {
        $appliedto = array();
        $appliedto[] = $jobid;
        update_user_meta($cuid,'my_applied_jobs',$appliedto);
    }
     
    wp_die();
}