<?php
  /*
   Display Template Name: Cancel 
  */
session_start();
global $current_user;
wp_get_current_user();
$userID = $current_user->ID;
get_header();
?>
 
<div class="container Cancel">
		 	<div class="row">
		 		<div class="col-sm-12">
<h1>Your PayPal transaction has been canceled.</h1>
</div>
</div>
</div>


<?php
get_footer();
?>

