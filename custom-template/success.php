<?php
  /*
   Display Template Name: Success 
  */
session_start();
if ( ! function_exists( 'wp_handle_upload' ) ) {
  require_once ( ABSPATH . 'wp-admin/includes/file.php' );
}
// Include image.php
require_once(ABSPATH . 'wp-admin/includes/image.php');
global $current_user;
wp_get_current_user();
$userID = $current_user->ID;
get_header();
?>
<?php
//print_r($_GET);
/*echo $item_number = $_GET['item_number']; 
echo $txn_id = $_GET['tx'];
echo $payment_gross = $_GET['amt'];
echo $currency_code = $_GET['cc'];
echo $payment_status = $_GET['st'];*/


 global $wpdb;
    

if($payment_status = $_GET['st'] == 'Completed'){

 if($_SESSION['packagelisting']['newcountstep'] == 'new'){


            if($_SESSION['packagelisting']['packagename'] == '1'){
            $packagename1 = 'Showcase Ad';
         }
         if($_SESSION['packagelisting']['packagename'] == '2'){
           $packagename1 = 'Basic Ad';
         }

              
              
               $current_date = date('Y-m-d');
         $month = $_SESSION['packagelisting']['datetime'];
         $expDate = date('Y-m-d', strtotime("+$month months", strtotime($current_date)));
             
        $my_post77 = array(
          'post_title'    => "Order ".$packagename1.'-'.$current_date,
          'post_status'   => 'publish',
          'post_author'   => $userID,
           'post_type'   => 'package_order',

         );
               $my_post_id4747 = wp_insert_post( $my_post77 );

               if($my_post_id4747){
            
              update_post_meta($my_post_id4747, 'package_name', $packagename1);
               update_post_meta($my_post_id4747, 'current_user_id', $userID);
               update_post_meta($my_post_id4747, 'package_current_date', $current_date);
               update_post_meta($my_post_id4747, 'package_expire_date', $expDate);
               update_post_meta($my_post_id4747, 'current_user_email', $_SESSION['signlisting']['emailid']);
               update_post_meta($my_post_id4747, 'paypal_payment_amount',$_GET['amt']);
               update_post_meta($my_post_id4747, 'currency', '$');
                   
               }

        session_unset($_SESSION['friststep']);
        session_unset($_SESSION['packagelisting']);
       
               echo ("<script LANGUAGE='JavaScript'>
          window.alert('Membership update Succesfully');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties';
          </script>");

 }else{
 

   
  ?>

       <?php


$user_id111 = wp_insert_user( array ('first_name' => apply_filters
         ('pre_user_first_name', $_SESSION['signlisting']['fristname']), 
          'last_name'  => apply_filters('pre_user_last_name', $_SESSION['signlisting']['lastname']),  
          'user_pass'  => apply_filters('pre_user_user_pass', $_SESSION['signlisting']['upassword']), 
          'user_login' => apply_filters('pre_user_user_login', $_SESSION['signlisting']['emailid']), 
          'user_email' => apply_filters('pre_user_user_email', $_SESSION['signlisting']['emailid']), 'role' => $_SESSION['signlisting']['userroles'] ));

          $username = $_SESSION['signlisting']['emailid'];
                $password1 = $_SESSION['signlisting']['upassword'];
                $to      =  $_SESSION['signlisting']['emailid'];
        $subject = 'Congratulations! Account Created on GetAbusiness.co.uk';
        $headers = 'From: dev@ptiwebtech.com' . "\r\n" .
        'Reply-To: dev@ptiwebtech.com' . "\r\n" .
        'Content-Type: text/html; charset=UTF-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $message .= '<h2>Dear '.$username.',</h2>';
        $message .= '<p>Thank you for registering with GetAbusiness.co.uk. The world&#39;s favourite website to buy and sell a business. <br/> You will enjoy some great features to make your experience using our site smooth and productive.<br>Please find below a record of your log in details:</p>';
        $message .= '<p>Username: <b>'.$username.'</b></p>';
        $message .= '<p>Password: <b>'.$password1.'</b></p>';
        $message .= '<p>Our best wishes as you embark on this wonderful journey of business ownership that we hope be very rewarding, personally and financially.</p>';
        $message .= '<p>Kind regards, <br>GetAbusiness.co.uk</p>';
        mail($to, $subject, $message, $headers);



		       // Create post object
		  $my_post = array(
		    'post_title'    => wp_strip_all_tags( $_SESSION['secondsignlisting']['titleforthisadd'] ),
		    'post_content'  => $_SESSION['secondsignlisting']['businessdescription'],
		    'post_status'   => 'publish',
		    'post_type'   => 'buy',
		    'post_author'   => $user_id111
		  );
		  $my_post_id = wp_insert_post( $my_post );
		    if($my_post_id) {
         update_post_meta($my_post_id, 'bprice', $_SESSION['secondsignlisting']['price'] );
          update_post_meta($my_post_id, '_business_annual_turnover', $_SESSION['secondsignlisting']['annualturnover'] );
          update_post_meta($my_post_id, 'trading_hours', $_SESSION['secondsignlisting']['tradinghours'] );
         
          update_post_meta($my_post_id, '_business_property_details', $_SESSION['secondsignlisting']['propertydetails'] );
          update_post_meta($my_post_id, '_business_other_details', $_SESSION['secondsignlisting']['otherdetail'] );
          update_post_meta($my_post_id, '_business_operation_details', $_SESSION['secondsignlisting']['operationdeatil'] );
          update_post_meta($my_post_id, '_business_miscellaneous', $_SESSION['secondsignlisting']['miscellaneous'] );


         
         update_post_meta($my_post_id, 'city', $_SESSION['secondsignlisting']['city'] );
         update_post_meta($my_post_id, 'street_address', $_SESSION['secondsignlisting']['streetaddress'] );
         update_post_meta($my_post_id, 'contact_name', $_SESSION['secondsignlisting']['contactname'] );
         update_post_meta($my_post_id, 'contact_phone', $_SESSION['secondsignlisting']['contactphone'] );
         update_post_meta($my_post_id, 'contact_email', $_SESSION['secondsignlisting']['contactemailaddress'] );
         update_post_meta($my_post_id, 'no_of_emp', $_SESSION['secondsignlisting']['numberofemployees'] );
         update_post_meta($my_post_id, 'year_established', $_SESSION['secondsignlisting']['yearestablished'] );




         $country_id = $_SESSION['secondsignlisting']['country'];
    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 
     update_post_meta($my_post_id, 'country', $country_name);


    $state_id = $_SESSION['secondsignlisting']['state'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     update_post_meta($my_post_id, 'state',  $state_name);

       $city_id = $_SESSION['secondsignlisting']['city'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 
     update_post_meta($my_post_id, 'city', $city_name);


         wp_set_object_terms( $my_post_id, $_SESSION['secondsignlisting']['features'], 'business-feature', true);
         wp_set_object_terms( $my_post_id, $_SESSION['secondsignlisting']['businesstype'], 'business-category', true);


  if($_SESSION['secondsignlisting']['image_array']) {

      $attachArray = array();
      if($_SESSION['secondsignlisting']['featured_image']) {
        set_post_thumbnail( $my_post_id, $_SESSION['secondsignlisting']['featured_image'] );
        $attachArray = array_diff( $_SESSION['secondsignlisting']['image_array'], array($_SESSION['secondsignlisting']['featured_image']) );
      } else {
        $attachArray = $_SESSION['secondsignlisting']['image_array'];
      }
       //$test =  implode(",", $attachArray);
      if( !empty($attachArray) ) {
        update_post_meta($my_post_id, 'uploade_images',$attachArray);

      }
    }
}

            

                 
            if($_SESSION['packagelisting']['packagename'] == '1'){
            $packagename1 = 'Showcase Ad';
         }
         if($_SESSION['packagelisting']['packagename'] == '2'){
           $packagename1 = 'Basic Ad';
         }

              
              
               $current_date = date('Y-m-d');
			   $month = $_SESSION['packagelisting']['datetime'];
			   $expDate = date('Y-m-d', strtotime("+$month months", strtotime($current_date)));
             
				$my_post77 = array(
			    'post_title'    => "Order ".$packagename1.'-'.$current_date,
			    'post_status'   => 'publish',
          'post_author'   => $user_id111,
			     'post_type'   => 'package_order',

			   );
               $my_post_id4747 = wp_insert_post( $my_post77 );

                if($my_post_id4747){

                      update_post_meta($my_post_id4747, 'package_name', $packagename1);
                      update_post_meta($my_post_id4747, 'current_user_id', $user_id111);
                      update_post_meta($my_post_id4747, 'package_current_date', $current_date);
                      update_post_meta($my_post_id4747, 'package_expire_date', $expDate);
                      update_post_meta($my_post_id4747, 'current_user_email', $_SESSION['signlisting']['emailid']);
                      update_post_meta($my_post_id4747, 'paypal_payment_amount',$_GET['amt']);
                      update_post_meta($my_post_id4747, 'currency', '$');
                }

                $creds = array();
                $creds['user_login'] = $_SESSION['signlisting']['emailid'];
                $creds['user_password'] = $_SESSION['signlisting']['upassword'];
                $user = wp_signon( $creds, false );

				      unset($_SESSION['signlisting']);
              unset($_SESSION['secondsignlisting']);
              unset($_SESSION['packagelisting']);


               echo ("<script LANGUAGE='JavaScript'>
			    window.alert('listing add Succesfully');
			    window.location.href='http://demosrvr.com/wp/getabusiness/my-properties/';
			    </script>");





?>






  <?php
}
}
?>
<?php
get_footer();
?>

