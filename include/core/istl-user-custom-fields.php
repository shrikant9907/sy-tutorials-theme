<?php
 
/*
 * Create Custom Fields for User Profile
 */
add_action( 'show_user_profile', 'istl_user_field_fields' );
add_action( 'edit_user_profile', 'istl_user_field_fields' );
function istl_user_field_fields( $user ) 
{ 
    
    // User ID
    $user_id = $user->ID; 
    
    // Set All Fields Values
    $user_profile_headline = get_user_meta($user_id, 'profile_headline', true); 
    $user_alternative_email = get_user_meta($user_id, 'alternative_email', true); 
    $user_alternative_phone = get_user_meta($user_id, 'alternative_phone', true);  
    $user_skype = get_user_meta($user_id, 'skype', true);  
    $user_linkedin = get_user_meta($user_id, 'linkedin', true);  
    $birth_date = get_user_meta($user_id, 'birth_date', true);   
    
//    Custom User Profile Fields 
    ?>
    <h3>Additional Details</h3>

    <table class="form-table">
        <tr>
            <th><label for="profile_headline">Profile Headline</label></th> 
            <td>
                <input id="profile_headline" class="regular-text" name="profile_headline" type="email" value="<?php echo $user_profile_headline; ?>" placeholder="Enter headline for profie. eg. WordPress Developer"/>
            </td>
        </tr>
        <tr>
            <th><label for="alternative_email">Alternative Email Address</label></th> 
            <td>
                <input id="alternative_email" class="regular-text" name="alternative_email" type="email" value="<?php echo $user_alternative_email; ?>" placeholder="Enter alternative email address."/>
            </td>
        </tr>
        <tr>
            <th><label for="alternative_phone">Alternative Phone Number</label></th> 
            <td>
                <input id="alternative_phone" class="regular-text" name="alternative_phone" type="text" value="<?php echo $user_alternative_phone; ?>" placeholder="Enter alternative phone number."/>
            </td>
        </tr>
        <tr>
            <th><label for="skype">Skype ID</label></th> 
            <td>
                <input id="skype" class="regular-text" name="skype" type="text" value="<?php echo $user_skype; ?>" placeholder="Enter your skype id."/>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin">linkedin URL</label></th> 
            <td>
                <input id="linkedin" class="regular-text" name="linkedin" type="text" value="<?php echo $user_linkedin; ?>" placeholder="Enter linkedin profile URL."/>
            </td>
        </tr> 
        <tr>   
            <th><label for="birth_date">Date Of Birth</label></th> 
            <td>
                <input id="birth_date" class="regular-text datepicker" name="birth_date" type="text" value="<?php echo $birth_date; ?>" placeholder="Select Data of Birth eg. DD/MM/YYYY"/>
            </td>
        </tr>
    </table>
<?php }

/*
 * Save User Profile Custom Fields
 */
add_action( 'personal_options_update', 'save_istl_user_field_fields' );
add_action( 'edit_user_profile_update', 'save_istl_user_field_fields' );

function save_istl_user_field_fields( $user_id )  
{
    update_user_meta( $user_id, 'profile_headline', $_POST['profile_headline'] );
    update_user_meta( $user_id, 'alternative_email', $_POST['alternative_email'] );
    update_user_meta( $user_id, 'alternative_phone', $_POST['alternative_phone'] );
    update_user_meta( $user_id, 'skype', $_POST['skype'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] ); 
    update_user_meta( $user_id, 'birth_date', $_POST['birth_date'] ); 
   
}