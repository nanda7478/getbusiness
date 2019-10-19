<?php
/**
 * Display Template Name: Forgot Password
 */

global $wpdb, $user_ID;

function tg_validate_url() {
    global $post;
    $page_url = esc_url(get_permalink( $post->ID ));
    $urlget = strpos($page_url, "?");
    if ($urlget === false) {
        $concate = "?";
    } else {
        $concate = "&";
    }
    return $page_url.$concate;
}

if (!$user_ID) { //block logged in users

    if(isset($_GET['key']) && $_GET['action'] == "reset_pwd") {
        $reset_key = $_GET['key'];
        $user_login = $_GET['login'];
        $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
        
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        
        if(!empty($reset_key) && !empty($user_data)) {
            $new_password = wp_generate_password(7, false);
                //echo $new_password; exit();
                wp_set_password( $new_password, $user_data->ID );
                //mailing reset details to the user
            $message = __('Your new password for the account at:') . "\r\n\r\n";
            $message .= get_option('siteurl') . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
            $message .= sprintf(__('Password: %s'), $new_password) . "\r\n\r\n";
            $message .= __('You can now login with your new password at: ') . get_option('siteurl')."/login" . "\r\n\r\n";
            
            if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
                $error = "Email failed to send for some unknown reason";
                exit();
            }
            else {
                $redirect_to = get_bloginfo('url')."/login?action=reset_success";
                wp_safe_redirect($redirect_to);
                exit();
            }
        } 
        else exit('Not a Valid Key.');
        
    }
    //exit();

    if($_POST['action'] == "tg_pwd_reset"){
        if ( !wp_verify_nonce( $_POST['tg_pwd_nonce'], "tg_pwd_nonce")) {
          exit("No trick please");
       }  
        if(empty($_POST['user_input'])) {
            $error = "Please enter your Username or E-mail address";
            //exit();
        }
        //We shall SQL escape the input
        $user_input = $wpdb->escape(trim($_POST['user_input']));
        
        if ( strpos($user_input, '@') ) {
            $user_data = get_user_by_email($user_input);
            if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
                $error = "Invalid E-mail address!";
                //exit();
            }
        }
        else {
            $user_data = get_userdatabylogin($user_input);
            if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
                $error = "Invalid Username!";
                //exit();
            }
        }
        
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if(empty($key)) {
            //generate reset key
            $key = wp_generate_password(20, false);
            $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));  
        }
        
        //mailing reset details to the user
        $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
        $message .= get_option('siteurl') . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
        $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
        $message .= tg_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . "\r\n";
        
        if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
            $error = "Email failed to send for some unknown reason.";
            //exit();
        }
        else {
            $success = "We have just sent you an email with Password reset instructions.";
            //exit();
        }
        
    } 
}

get_header(); ?>

<!--<script type="text/javascript">
        function submit()
        {
            var f = document.getElementById('lostpasswordform');
            f.onclick = function () { };
            document.lostpasswordform.submit();
        }
    </script>-->
<section class="buyer_register_bradcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="http://demosrvr.com/wp/getabusiness/">Home</a><a href="http://demosrvr.com/wp/getabusiness/login/">/ Login</a> <span>/ Forgot Password</span>
			</div>
		</div>
	</div>
</section>
<section class="forgot_password_section">
	<div class="container">
	<div class="forgot_password-wapper">

		<?php if( ! empty( $error ) )
                echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
            
            if( ! empty( $success ) )
                echo '<div class="error_login"><p class="success">'. $success .'</p></div>';
       
?>
<form id="wp_pass_reset" action="" method="post" class="user_form">  
  <div class="broker_login_heading">
  				<h2>Send me a link to reset <br/> <span>My Password</span></h2>
				</div>
<?php //$user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
<input name="user_input" id="user_login" class="text" value="" type="text" placeholder="Email Address">  
<div class="input-submit">
<input type="hidden" name="action" value="tg_pwd_reset" />
<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>" />
<!-- <input id="submit" name="submit" class="btn" value="SEND ME THE LINK" type="submit">  --> 
<input type="submit" id="submit" class="btn reset_password" name="submit" value="SEND ME THE LINK" />  
</div>
</form> 
<div id="result"></div> <!-- To hold validation results -->
            <script type="text/javascript">                         
            $("#wp_pass_reset").submit(function() {         
            $('#result').html('<span class="loading">Validating...</span>').fadeIn();
            var input_data = $('#wp_pass_reset').serialize();
            $.ajax({
            type: "POST",
            url:  "<?php echo get_permalink( $post->ID ); ?>",
            data: input_data,
            success: function(msg){
            $('.loading').remove();
            $('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
            }
            });
            return false;
            
            });
            </script>

</div>
</div>
</section>

<?php 
get_footer(); 
?>
