<?php

/*
* Network admin menu
*/
add_action('network_admin_menu', 'google_import_network_menu');

function google_import_network_menu() {
        add_menu_page( "Gmail Importer Settings", "Gmail Importer Settings", 'capability', 'gmail_importer_settings', 'gmail_importer_settings_cb');	
}

function gmail_importer_settings_cb() {
    
        if(isset($_POST['submit_google_settings_form'])) {

            // New value
            $new_google_api_username = trim($_POST['google_api_username']);
            $new_google_clinet_secret = trim($_POST['google_clinet_secret']);
            $new_google_redirect_uri = trim($_POST['google_redirect_uri']);
            
            // Update
            update_site_option('google_api_username',$new_google_api_username);
            update_site_option('google_clinet_secret',$new_google_clinet_secret);
            update_site_option('google_redirect_uri',$new_google_redirect_uri);
            
            ?>
            <div class="notice notice-success is-dismissible"><p><?php _e( 'Settings updated.', 'social-savvi' ); ?></p></div>
            <?php

        }

        // Saved value
        $google_api_username = get_site_option('google_api_username');
        $google_clinet_secret = get_site_option('google_clinet_secret');
        $google_redirect_uri = get_site_option('google_redirect_uri'); 
         
    ?>
    <div class="wrap sso-google_settings_wrapper">
        <h1>Gmail Importer Settings</h1>        
        <p><a href="https://code.google.com/apis/console#access">Click here</a> and get api credentials for google contact api.</p>
        <h3>API Credentials</h3>
        <form action="" method="post" enctype="multipart/form-data" class="google_settings_form">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="google_api_username">Google Client ID</label></th>
                <td><input type="text" value="<?php echo $google_api_username; ?>" style="width:100%;" placeholder="200004693222-4rg0i4ilj18j4j7hht9btf3870k0o05e.apps.googleusercontent.com" name="google_api_username" id="google_api_username"></td>
            </tr>
            <tr>
                <th scope="row"><label for="google_clinet_secret">Google Client Secret</label></th>
                <td><input type="text" value="<?php echo $google_clinet_secret; ?>" style="width:100%;" placeholder="4_JB51SHlkEbnDQb9dzPqLKu" name="google_clinet_secret" id="google_clinet_secret"></td>
            </tr>
            <tr>
                <th scope="row"><label for="google_redirect_uri">Google Redirect URI</label></th>
                <td><input type="text" value="<?php echo $google_redirect_uri; ?>" style="width:100%;"  placeholder="https://www.socialsavvi.org/dashboard/?account_settings" name="google_redirect_uri" id="google_redirect_uri"></td>
            </tr>
            </tbody>
            </table>
        <input type="submit" name="submit_google_settings_form" value="Save" class="button button-primary">
        </form>
    </div>
    <?php
}

/*
 *  Shortcode for google import
 */
add_shortcode('show_google_import' ,'show_google_import');
function show_google_import($atts) { 

ob_start(); 

/*
 *  Send Inviation on submit
 */
send_invitation_email();

require_once('google-api-php-client/src/Google/autoload.php');
    
//Declare your Google Client ID, Google Client secret and Google redirect uri in  php variables

// Saved value
$google_client_id               =   get_site_option('google_api_username');
$google_client_secret       =   get_site_option('google_clinet_secret');
$google_redirect_uri        =   get_site_option('google_redirect_uri'); 

//setup new google client
$client = new Google_Client();
$client -> setApplicationName('Social Savvi Google Email Importer');
$client -> setClientid($google_client_id);
$client -> setClientSecret($google_client_secret);
$client -> setRedirectUri($google_redirect_uri);
$client -> setAccessType('online'); 
$client -> setScopes('https://www.googleapis.com/auth/contacts.readonly');
$googleImportUrl = $client -> createAuthUrl();

/*
 * Set Session with google response
 */
if (isset($_GET['code'])) {
    $auth_code = $_GET["code"];
    $_SESSION['google_code'] = $auth_code;
}


if(!isset($_SESSION['google_code'])) {
    ?> 
<div class="refer_by_email_box">
	<h3>Refer by email</h3>
	<p>Import your contacts from Gmail.</p>
	<a id="google_import_url_button" class="button button-default sso_common_button_effect" href="<?php echo $googleImportUrl; ?>" >Invite Contacts</a>
         
</div>
<?php }  else {
    
    $auth_code = $_SESSION['google_code'];
    $max_results = 200;
    
    $fields=array(
        'code'=>  urlencode($auth_code),
        'client_id'=>  urlencode($google_client_id),
        'client_secret'=>  urlencode($google_client_secret),
        'redirect_uri'=>  urlencode($google_redirect_uri),
        'grant_type'=>  urlencode('authorization_code')
    );
    
    $post = '';
    
    foreach($fields as $key=>$value)
        {
            $post .= $key.'='.$value.'&';
        }	
        
    $post = rtrim($post,'&');
		
    $result = curl('https://accounts.google.com/o/oauth2/token',$post);
    $response =  json_decode($result);
    $accesstoken = $response->access_token;
    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
    $xmlresponse =  curl($url);
    $contacts = json_decode($xmlresponse,true);
//    print_r($contacts);
	
	$return = array();
	if (!empty($contacts['feed']['entry'])) {
		foreach($contacts['feed']['entry'] as $contact) {
			
			//retrieve user photo
			if (isset($contact['link'][0]['href'])) {
                                                                                $url =   $contact['link'][0]['href'];
                                                                                $url = $url . '&access_token=' . urlencode($accesstoken);
                                                                                $curl = curl_init($url);
                                                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                                                                curl_setopt($curl, CURLOPT_TIMEOUT, 15);
                                                                                curl_setopt($curl, CURLOPT_VERBOSE, true);
                                                                                $image = curl_exec($curl);
                                                                                curl_close($curl);
			}
			
			//retrieve Name + email and store into array
			$return[] = array (
				'name'=> $contact['title']['$t'],
				'email' => $contact['gd$email'][0]['address'],
				'image' => $image
			);
		}				
	}
	
	$google_contacts = $return;
						
	unset($_SESSION['google_code']);
	
	//Now that we have the google contacts stored in an array, display all in a table
	if(!empty($google_contacts)) {
                                            ?>
                                            <div class='invite_gmail_form_wrapper'>

                                            <?php
		echo '<form action="https://www.socialsavvi.org/dashboard/?account_settings" id="invite_gmail_emails_form" method="post" enctype="multipart/form-data">
                                                                    <span class="invite_gmail_form_close md-close"><a href="'.network_site_url('dashboard/?account_settings').'"><img draggable="false" class="emoji" alt="✖" src="https://s.w.org/images/core/emoji/2/svg/2716.svg"></a></span>
                                                                    <h3>Invite your friends</h3>
                                                        <p>invite your contacts.</p>
                                                                <div id="gmail_email_list">
                                                                <p> <input class="search"  placeholder="Search Gmail Contacts" /></p>
			<ul class="list">';
				foreach ($google_contacts as $gkey => $contact) {
                                                                                                    echo '<li ><input class="css-checkbox" id="invite_gmail_emails'.$gkey.'"  name="invite_gmail_emails[]" type="checkbox" value="'.$contact['email'].'" /><label for="invite_gmail_emails'.$gkey.'" class="emails css-label">'.$contact['email'].'</label></li>';
				}	 			
			echo '</ul>
                                                                </div>
                                            <div class="submit_invites_email"><input type="submit" name="submit_invite_emails" value="Send Invites" /></div>
		</form>';
                                            echo "</div>";
                
                        ?>
                            <script type='text/javascript' src='https://www.socialsavvi.org/wp-content/plugins/sso-membership/js/list.min.js?ver=4.7.3'></script>
                            <script type="text/javascript">
                            
                                var options = {
                                    valueNames: [ 'emails' ]
                                };

                                var userList = new List('gmail_email_list', options);
                            
                            </script>

                         <?php 
                            
                    } else {
                        
                        ?>
                        <div class="refer_by_email_box">
                        <h3>Refer by email</h3>
                        <p>Import your contacts from Gmail.</p>
                        <a id="google_import_url_button" class="button button-default sso_common_button_effect" href="<?php echo $googleImportUrl; ?>" >Invite Contacts</a>

                        </div>
                           <?php
                        
                    }

						
} 


return ob_get_clean();

} // End Show google import

 
/*
 * Curl Function 
 */
function curl($url, $post = "") {
            $curl = curl_init();
            $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            if ($post != "") {
                    curl_setopt($curl, CURLOPT_POST, 5);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            }
            curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            $contents = curl_exec($curl);
            curl_close($curl);
            return $contents;
}

/*
 *  Function submit send mail
 */
function send_invitation_email() {
if(isset($_POST['submit_invite_emails'])) {
       
            $emails = $_POST['invite_gmail_emails'];
            $email_counts  = count($emails);

                            if($emails) {
                                
                                 $partnerdata = sk_get_partner_data();

                                foreach($emails as $email) {

                                    $subject = "Social Savvi Activation Request.";
                                    $body = '<!DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Social Savvi</title></head>
                                    <body style="background-color: #000;"><table border="0" cellpadding="5" cellspacing="0" style="font-family:arial; background-color: #fff; height:auto; width:100%; margin:0px auto; max-width:100%;">
                                    <tr><td align="left" style="border-bottom: 10px solid #f1913b; padding: 20px 50px;"><img src="https://www.socialsavvi.org/wp-content/uploads/2016/09/logo.png" alt="logo"></td></tr><tr><td align="left" style="padding:0px 50px 20px; color:#000;">
                                    <br />
                                    <br />
                                    Hey,  <br /><br />
                                    '.$partnerdata['full_name'].'  would like to invite you to test drive a FREE 7-Day trial of <a href="'.$partnerdata['blog_details']->siteurl.'">'.$partnerdata['blog_details']->siteurl.'</a>.  <br />
                                    Socialsavvi is a great new startup and a dream come true for online marketers & social entrepreneurs. <br />
                                    If your trying to market a product, service or company online...socialsavvi is the place for you. <br />
                                    We have bundled over 35 of the leading social media marketing apps on one platform and much, much more...all for less than a cup of coffee per day!
                                    <br />
                                    <br />
                                    Thanks, <br /> 
                                    The Social Savvi Support Team 
                                    <br /> 
                                    '.network_site_url('/').'</td></tr></table></body></html>';
                                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                                    $headers[] = 'From: Social Savvi <support@socialsavvi.org>';

                                    wp_mail( $email, $subject, $body, $headers );

                                }

                                ?>
                                <div style="margin-top:18px;" class="alert alert-success fade in">
                                <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
                                (<?php echo $email_counts ; ?>)   Contacts invited successfully.
                                </div> 
                                <?php

                            }
                                                 
}

}