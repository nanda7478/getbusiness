<?php
/*
 Display Template Name: Login
*/
if (is_user_logged_in() ) {
wp_redirect ( home_url("/home") );

}
else{
	
}
?><?php
global $user_ID;  
  
if (!$user_ID) 
{    
if($_POST){  
//We shall SQL escape all inputs  
$username = $wpdb->escape($_REQUEST['username']);  
$password = $wpdb->escape($_REQUEST['password']);  
$remember = $wpdb->escape($_REQUEST['rememberme']);  
  
if($remember) $remember = "true";  
else $remember = "false";  
$login_data = array();  
$login_data['user_login'] = $username;  
$login_data['user_password'] = $password;  
$login_data['remember'] = $remember;  
$user_verify = wp_signon( $login_data, true );   
      
if ( is_wp_error($user_verify) )   
{  ?>
	<?php
get_header();  
?>
<section class="buyer_register_bradcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="http://demosrvr.com/wp/getabusiness/">Home</a> <span>/Login</span>
			</div>
		</div>
	</div>
</section>
<div id="content">  
<div class="broker_login-section">
<div id="container" class="container"> 
<form id="wp_login_form" action="" method="post">  
  <div class="broker_login_heading">
				<h2>Login your to <span>Account</span></h2>
			</div>
<!-- <label>Username</label><br>   -->
<input name="username" class="text" value="" type="text" placeholder="Username"><br>  
<!-- <label>Password</label><br>  --> 
<input name="password" class="text" value="" type="password" placeholder="Password"> <br>  
<div class="input-check">
<label class="input-checkbox">  
<input name="rememberme" value="forever" type="checkbox">Remember me <span class="checkmark"></span></label>  
<h5><a href="http://demosrvr.com/wp/getabusiness/forgot-password/">Forgot Password?</a> </h5>
 </div>
<input id="submitbtn" name="submit" value="Login" type="submit">  
<?php echo "<span class='error'>Invalid username or password. Please try again!</span>"; ?>
  <div class="extra-dt"> <p>Don't have an account yet? </p> <a href="http://demosrvr.com/wp/getabusiness/buyer-register" 
  	class="btn"> Sign up here</a> </div>
</form>  
</div>
</div>
</div>

<?php
get_footer();  
    
   exit();  
 } else   
 {    
   echo "<script type='text/javascript'>window.location='". home_url("/my-account") ."'</script>";  
   exit();  
 }  
} else {   
  
get_header();  
  
?>  
<section class="buyer_register_bradcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="http://demosrvr.com/wp/getabusiness/">Home</a> <span>/Login</span>
			</div>
		</div>
	</div>
</section>
<div id="content">  
<div class="broker_login-section">
<div id="container" class="container">  

  
<!--?php the_title(); ?-->  
  
<div id="result"></div> <!-- To hold validation results -->  
<form id="wp_login_form" action="" method="post">  
  <div class="broker_login_heading">
				<h2>Login your to <span>Account</span></h2>
			</div>
<!-- <label>Username</label><br>   -->
<input name="username" class="text" value="" type="text" placeholder="Username"><br>  
<!-- <label>Password</label><br>  --> 
<input name="password" class="text" value="" type="password" placeholder="Password"> <br>  
<div class="input-check">
<label class="input-checkbox">  
<input name="rememberme" value="forever" type="checkbox">Remember me <span class="checkmark"></span></label>  
<h5><a href="http://demosrvr.com/wp/getabusiness/forgot-password/">Forgot Password?</a> </h5>
 </div>
<input id="submitbtn" name="submit" value="Login" type="submit">  
  <div class="extra-dt"> <p>Don't have an account yet? </p> <a href="<?php echo site_url();?>/buyer-register" 
  	class="btn"> Sign up here</a> </div>
</form>  

</div>
</div>
 <?php
 get_footer();
 ?>
<script type="text/javascript">                           
$("#submitbtn").click(function() {  
  
$('#result').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" />').fadeIn();  
var input_data = $('#wp_login_form').serialize();  
$.ajax({  
type: "POST",  
url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",  
data: input_data,  
success: function(msg){  
$('.loader').remove();  
$('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');  
}  
});  
return false;  
  
});  
</script>  
  

<?php  
get_footer();  
    }  
}  

else {  
    echo "<script type='text/javascript'-->window.location='". home_url("/my-account") ."'";  
}  
?>  