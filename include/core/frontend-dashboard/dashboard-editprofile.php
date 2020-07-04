<?php
    // Save user profile info
    if(isset($_POST['save_custom_userprofile'])) {

        $newdisplayname = $_POST['custom_display_name'];
        $newcustom_email = $_POST['custom_email'];
        $newcustom_address = $_POST['custom_address'];
        $newcustom_contact = $_POST['custom_contact'];
        $newcustom_fax = $_POST['custom_fax'];

        $newfirstname = $_POST['custom_firstname'];
        $newlastname = $_POST['custom_lastname'];

        $userdata = array(
                'ID' => $current_user_id,
                'display_name' => $newdisplayname,
                'user_email' => $newcustom_email,
                'first_name' => $newfirstname,
                'last_name' => $newlastname
            );


        $newuserdata = wp_update_user( $userdata,false );
        

        if( is_wp_error( $newuserdata )){
            
            $new_dashboard_url = network_site_url('/dashboard/?editprofile=&profileupdate=0');
            wp_redirect($new_dashboard_url);
            die();
            
        } else {
            
        if($newcustom_email!=$user_email) {
            update_user_meta($current_user_id,'app_email_status',0);
        }
        
        if(($app_email_status!=1) && ($newcustom_email!=$user_email)) {
            send_activation_mail($current_user_id, $newcustom_email, $newfirstname);
         }    

        update_usermeta( $current_user_id, '_user_address', $newcustom_address );
        update_usermeta( $current_user_id, '_user_contact', $newcustom_contact );
        update_usermeta( $current_user_id, '_user_fax', $newcustom_fax );

            // Change Password 
            $newpassword = trim($_POST['custom_password']);
            $newcpassword = trim($_POST['custom_cpassword']);

            if(!empty($newpassword) && !empty($newcpassword)) {      

                if($newpassword!=$newcpassword) {
                    $passwordstatus = '&passwordstatus=0';                  
                } else {
                    wp_set_password( $newcpassword, $current_user_id );
                    $passwordstatus = '&passwordstatus=1';     
                }

            }

            $new_dashboard_url = network_site_url('/dashboard/?editprofile=&profileupdate=1'.$passwordstatus);

            wp_redirect($new_dashboard_url);

            die();
        }

    }

?>

  <form action="<?php echo network_site_url('/dashboard/?editprofile'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <ul>
        <li>
            <label>Username: </label>
            <input type="text" disabled name="custom_user_login" data-title="Username can't change." class="form-control" value="<?php echo $user_login; ?>"/>
        </li>
        <li>
            <label>Display Name: </label>
            <input type="text" name="custom_display_name" data-title="Enter display name." class="form-control" value="<?php echo $displayname; ?>"/>
        </li>
        <li>
            <label>First Name: </label>
            <input type="text"   name="custom_firstname" data-title="Enter First name." class="form-control" value="<?php echo $firstname; ?>"/>
        </li>
        <li>
            <label>Last Name: </label>
            <input type="text"   name="custom_lastname" data-title="Enter last name." class="form-control" value="<?php echo $lastname; ?>"/>
        </li>
        <li>
            <label>Email: <?php echo $app_email_status_msg; ?></label>
            <input type="email" name="custom_email" data-title="Enter email address." class="form-control" value="<?php  echo $user_email; ?>" />
        </li>
        <li>
            <label>Address: </label>
            <textarea class="form-control" data-title="Enter address." name ="custom_address"><?php echo $user_address; ?></textarea>                                                  
        </li>
       <?Php /*
        <li>
            <label>Contact: </label> 
            <input type="text" name="custom_contact" data-title="Enter contact number." class="form-control" value="<?php  echo $user_contact; ?>" />
        </li>
        <li>
            <label>Fax: </label> 
            <input type="text" name="custom_fax" data-title="Enter Fax number." class="form-control" value="<?php  echo $user_fax; ?>" />
        </li>
        */ ?>
        <li>
            <label>Password: </label> 
            <input type="password" data-title="Enter strong password. OR Leave empty if don't want to change password." name="custom_password" class="form-control" value="" />
        </li>

        <li>
            <label>Confirm Password: </label> 
            <input type="password" data-title="Confirm password. OR Leave empty if don't want to change password." name="custom_cpassword" class="form-control" value="" />
        </li>
        
        <li>
            <input class="btn button-primary" type="submit" name="save_custom_userprofile" value="Update" />
        </li>
    </ul>
    </form>