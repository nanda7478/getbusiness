<?php
/*
 Display Template Name: Register As a Buyer
*/
if (is_user_logged_in() ) {
wp_redirect ( home_url("/home") );

}
else{
	
}

	$error= '';
	$success = '';
 
	global $wpdb, $PasswordHash, $current_user, $user_ID;
 
	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
 
	
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name  = $wpdb->escape(trim($_POST['last_name']));
		$username   = $wpdb->escape(trim($_POST['username']));
		$email      = $wpdb->escape(trim($_POST['email']));
		$password1  = $wpdb->escape(trim($_POST['password1']));
		$password2  = $wpdb->escape(trim($_POST['password2']));
		$vehicle1  = $wpdb->escape(trim($_POST['vehicle1']));
		$vehicle2  = $wpdb->escape(trim($_POST['vehicle2']));
		$userroles  = $wpdb->escape(trim($_POST['userroles']));
		
		
		
		$vehicle1  = $wpdb->escape(trim($_POST['vehicle1']));
		$vehicle2  = $wpdb->escape(trim($_POST['vehicle2']));
		
if($first_name == "" || $last_name == "" || $username == "" || $email == "" || $password1 == "" || $password2 == "" || $vehicle1 == "" || $vehicle2 == "") 

             {               
	            $error= 'Please don\'t leave the required fields.';
		    }
		       else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		       {
			    $error= 'Invalid email address.';
		       }  
		     else if(email_exists($email) ) 
		     {
			    $error= 'Email already exist.';
		     }  else if($password1 <> $password2 )
		{ $error= 'Password do not match.'; } 




		else 
		{
			?>
           <!-- <script>window.location = "<?php echo home_url('/login/');?>"</script> -->
			<?php
	        $user_id = wp_insert_user( array ('first_name' => apply_filters
		     ('pre_user_first_name', $first_name), 
		      'last_name'  => apply_filters('pre_user_last_name', $last_name),  
		      'user_pass'  => apply_filters('pre_user_user_pass', $password1), 
		      'user_login' => apply_filters('pre_user_user_login', $username), 
		      'user_email' => apply_filters('pre_user_user_email', $email), 'role' => $userroles));

			    update_user_meta( $user_id, 'tel',          $_POST['tel'] );
			    update_user_meta( $user_id, 'country',      $_POST['country'] );
			    update_user_meta( $user_id, 'flat_num',     $_POST['flat_num'] );
			    update_user_meta( $user_id, 'street_number',$_POST['street_number'] );
			    update_user_meta( $user_id, 'zip_code',     $_POST['zip_code'] );
			    update_user_meta( $user_id, 'vehicle1',     $_POST['vehicle1'] );
			    update_user_meta( $user_id, 'vehicle2',     $_POST['vehicle2'] );

                $to      = $email;
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


			
			if(is_wp_error($user_id)) 
			{$error= 'Error on user creation.';} 
		else{
				//do_action('user_register', $user_id);	
				$success = 'You\'re successfully register';
				
			}	
		}	
	}
	
get_header();
?>
<section class="buyer_register_bradcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> <span>/ Register as a buyer</span>
			</div>
		</div>
	</div>
</section>

<section class="broker_register_section">
	<div class="container">
		<div class="broker_register_wrapper">
			<div class="buyer_register_message">
				<h4>
<?php if(isset($success)){echo $success;}?>
<?php if(isset($error)){echo $error;}?>
</h4>
			</div>
			<div class="broker_register_heading">
				<h2>Register for <span>FREE</span></h2>
			</div>
         <div class="row">
         	<div class="col-lg-12">
         		
	<!-- <div id="message">
		<?php 
			if(! empty($err) ) :
				echo '<p class="error">'.$err.'';
			endif;
		?>		
		<?php 
			if(! empty($success) ) :
				echo '<p class="error">'.$success.'';
			endif;
		?>
	</div> -->	
<?php
	if($_POST['submit']) {
  // we will add the code to process submitted form here
    // we can also echo some text here if form is submitted
} else {
?><?php

}
?>


<form name="frmContact" action="" method="post" onsubmit="return validateContactForm()">
<div class="row">
	<div class="from-group col-md-6">
<input class="input-field" type="text" value="" name="first_name" id="first_name" placeholder="First Name*"/>
<span id="userfirst_name" class="info"></span>
</div>

<div class="from-group col-md-6">
<input class="input-field" type="text" value="" name="last_name" id="last_name" placeholder="Last Name*"/>
<span id="userlast_name" class="info"></span>
</div>
<div class="from-group col-md-6">
<input class="input-field" type="text" value="" name="tel" id="tel" placeholder="Telephone*"/>
<span id="usertel" class="info"></span>
</div>
<div class="from-group col-md-6">
	<select class="input-field" name="country" id="country" placeholder="Country" >
	<option value="">Select Country</option>	
	<option value="AF">Afghanistan</option>
	<option value="AX">Åland Islands</option>
	<option value="AL">Albania</option>
	<option value="DZ">Algeria</option>
	<option value="AS">American Samoa</option>
	<option value="AD">Andorra</option>
	<option value="AO">Angola</option>
	<option value="AI">Anguilla</option>
	<option value="AQ">Antarctica</option>
	<option value="AG">Antigua and Barbuda</option>
	<option value="AR">Argentina</option>
	<option value="AM">Armenia</option>
	<option value="AW">Aruba</option>
	<option value="AU">Australia</option>
	<option value="AT">Austria</option>
	<option value="AZ">Azerbaijan</option>
	<option value="BS">Bahamas</option>
	<option value="BH">Bahrain</option>
	<option value="BD">Bangladesh</option>
	<option value="BB">Barbados</option>
	<option value="BY">Belarus</option>
	<option value="BE">Belgium</option>
	<option value="BZ">Belize</option>
	<option value="BJ">Benin</option>
	<option value="BM">Bermuda</option>
	<option value="BT">Bhutan</option>
	<option value="BO">Bolivia, Plurinational State of</option>
	<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
	<option value="BA">Bosnia and Herzegovina</option>
	<option value="BW">Botswana</option>
	<option value="BV">Bouvet Island</option>
	<option value="BR">Brazil</option>
	<option value="IO">British Indian Ocean Territory</option>
	<option value="BN">Brunei Darussalam</option>
	<option value="BG">Bulgaria</option>
	<option value="BF">Burkina Faso</option>
	<option value="BI">Burundi</option>
	<option value="KH">Cambodia</option>
	<option value="CM">Cameroon</option>
	<option value="CA">Canada</option>
	<option value="CV">Cape Verde</option>
	<option value="KY">Cayman Islands</option>
	<option value="CF">Central African Republic</option>
	<option value="TD">Chad</option>
	<option value="CL">Chile</option>
	<option value="CN">China</option>
	<option value="CX">Christmas Island</option>
	<option value="CC">Cocos (Keeling) Islands</option>
	<option value="CO">Colombia</option>
	<option value="KM">Comoros</option>
	<option value="CG">Congo</option>
	<option value="CD">Congo, the Democratic Republic of the</option>
	<option value="CK">Cook Islands</option>
	<option value="CR">Costa Rica</option>
	<option value="CI">Côte d'Ivoire</option>
	<option value="HR">Croatia</option>
	<option value="CU">Cuba</option>
	<option value="CW">Curaçao</option>
	<option value="CY">Cyprus</option>
	<option value="CZ">Czech Republic</option>
	<option value="DK">Denmark</option>
	<option value="DJ">Djibouti</option>
	<option value="DM">Dominica</option>
	<option value="DO">Dominican Republic</option>
	<option value="EC">Ecuador</option>
	<option value="EG">Egypt</option>
	<option value="SV">El Salvador</option>
	<option value="GQ">Equatorial Guinea</option>
	<option value="ER">Eritrea</option>
	<option value="EE">Estonia</option>
	<option value="ET">Ethiopia</option>
	<option value="FK">Falkland Islands (Malvinas)</option>
	<option value="FO">Faroe Islands</option>
	<option value="FJ">Fiji</option>
	<option value="FI">Finland</option>
	<option value="FR">France</option>
	<option value="GF">French Guiana</option>
	<option value="PF">French Polynesia</option>
	<option value="TF">French Southern Territories</option>
	<option value="GA">Gabon</option>
	<option value="GM">Gambia</option>
	<option value="GE">Georgia</option>
	<option value="DE">Germany</option>
	<option value="GH">Ghana</option>
	<option value="GI">Gibraltar</option>
	<option value="GR">Greece</option>
	<option value="GL">Greenland</option>
	<option value="GD">Grenada</option>
	<option value="GP">Guadeloupe</option>
	<option value="GU">Guam</option>
	<option value="GT">Guatemala</option>
	<option value="GG">Guernsey</option>
	<option value="GN">Guinea</option>
	<option value="GW">Guinea-Bissau</option>
	<option value="GY">Guyana</option>
	<option value="HT">Haiti</option>
	<option value="HM">Heard Island and McDonald Islands</option>
	<option value="VA">Holy See (Vatican City State)</option>
	<option value="HN">Honduras</option>
	<option value="HK">Hong Kong</option>
	<option value="HU">Hungary</option>
	<option value="IS">Iceland</option>
	<option value="IN">India</option>
	<option value="ID">Indonesia</option>
	<option value="IR">Iran, Islamic Republic of</option>
	<option value="IQ">Iraq</option>
	<option value="IE">Ireland</option>
	<option value="IM">Isle of Man</option>
	<option value="IL">Israel</option>
	<option value="IT">Italy</option>
	<option value="JM">Jamaica</option>
	<option value="JP">Japan</option>
	<option value="JE">Jersey</option>
	<option value="JO">Jordan</option>
	<option value="KZ">Kazakhstan</option>
	<option value="KE">Kenya</option>
	<option value="KI">Kiribati</option>
	<option value="KP">Korea, Democratic People's Republic of</option>
	<option value="KR">Korea, Republic of</option>
	<option value="KW">Kuwait</option>
	<option value="KG">Kyrgyzstan</option>
	<option value="LA">Lao People's Democratic Republic</option>
	<option value="LV">Latvia</option>
	<option value="LB">Lebanon</option>
	<option value="LS">Lesotho</option>
	<option value="LR">Liberia</option>
	<option value="LY">Libya</option>
	<option value="LI">Liechtenstein</option>
	<option value="LT">Lithuania</option>
	<option value="LU">Luxembourg</option>
	<option value="MO">Macao</option>
	<option value="MK">Macedonia, the former Yugoslav Republic of</option>
	<option value="MG">Madagascar</option>
	<option value="MW">Malawi</option>
	<option value="MY">Malaysia</option>
	<option value="MV">Maldives</option>
	<option value="ML">Mali</option>
	<option value="MT">Malta</option>
	<option value="MH">Marshall Islands</option>
	<option value="MQ">Martinique</option>
	<option value="MR">Mauritania</option>
	<option value="MU">Mauritius</option>
	<option value="YT">Mayotte</option>
	<option value="MX">Mexico</option>
	<option value="FM">Micronesia, Federated States of</option>
	<option value="MD">Moldova, Republic of</option>
	<option value="MC">Monaco</option>
	<option value="MN">Mongolia</option>
	<option value="ME">Montenegro</option>
	<option value="MS">Montserrat</option>
	<option value="MA">Morocco</option>
	<option value="MZ">Mozambique</option>
	<option value="MM">Myanmar</option>
	<option value="NA">Namibia</option>
	<option value="NR">Nauru</option>
	<option value="NP">Nepal</option>
	<option value="NL">Netherlands</option>
	<option value="NC">New Caledonia</option>
	<option value="NZ">New Zealand</option>
	<option value="NI">Nicaragua</option>
	<option value="NE">Niger</option>
	<option value="NG">Nigeria</option>
	<option value="NU">Niue</option>
	<option value="NF">Norfolk Island</option>
	<option value="MP">Northern Mariana Islands</option>
	<option value="NO">Norway</option>
	<option value="OM">Oman</option>
	<option value="PK">Pakistan</option>
	<option value="PW">Palau</option>
	<option value="PS">Palestinian Territory, Occupied</option>
	<option value="PA">Panama</option>
	<option value="PG">Papua New Guinea</option>
	<option value="PY">Paraguay</option>
	<option value="PE">Peru</option>
	<option value="PH">Philippines</option>
	<option value="PN">Pitcairn</option>
	<option value="PL">Poland</option>
	<option value="PT">Portugal</option>
	<option value="PR">Puerto Rico</option>
	<option value="QA">Qatar</option>
	<option value="RE">Réunion</option>
	<option value="RO">Romania</option>
	<option value="RU">Russian Federation</option>
	<option value="RW">Rwanda</option>
	<option value="BL">Saint Barthélemy</option>
	<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="KN">Saint Kitts and Nevis</option>
	<option value="LC">Saint Lucia</option>
	<option value="MF">Saint Martin (French part)</option>
	<option value="PM">Saint Pierre and Miquelon</option>
	<option value="VC">Saint Vincent and the Grenadines</option>
	<option value="WS">Samoa</option>
	<option value="SM">San Marino</option>
	<option value="ST">Sao Tome and Principe</option>
	<option value="SA">Saudi Arabia</option>
	<option value="SN">Senegal</option>
	<option value="RS">Serbia</option>
	<option value="SC">Seychelles</option>
	<option value="SL">Sierra Leone</option>
	<option value="SG">Singapore</option>
	<option value="SX">Sint Maarten (Dutch part)</option>
	<option value="SK">Slovakia</option>
	<option value="SI">Slovenia</option>
	<option value="SB">Solomon Islands</option>
	<option value="SO">Somalia</option>
	<option value="ZA">South Africa</option>
	<option value="GS">South Georgia and the South Sandwich Islands</option>
	<option value="SS">South Sudan</option>
	<option value="ES">Spain</option>
	<option value="LK">Sri Lanka</option>
	<option value="SD">Sudan</option>
	<option value="SR">Suriname</option>
	<option value="SJ">Svalbard and Jan Mayen</option>
	<option value="SZ">Swaziland</option>
	<option value="SE">Sweden</option>
	<option value="CH">Switzerland</option>
	<option value="SY">Syrian Arab Republic</option>
	<option value="TW">Taiwan, Province of China</option>
	<option value="TJ">Tajikistan</option>
	<option value="TZ">Tanzania, United Republic of</option>
	<option value="TH">Thailand</option>
	<option value="TL">Timor-Leste</option>
	<option value="TG">Togo</option>
	<option value="TK">Tokelau</option>
	<option value="TO">Tonga</option>
	<option value="TT">Trinidad and Tobago</option>
	<option value="TN">Tunisia</option>
	<option value="TR">Turkey</option>
	<option value="TM">Turkmenistan</option>
	<option value="TC">Turks and Caicos Islands</option>
	<option value="TV">Tuvalu</option>
	<option value="UG">Uganda</option>
	<option value="UA">Ukraine</option>
	<option value="AE">United Arab Emirates</option>
	<option value="GB">United Kingdom</option>
	<option value="US">United States</option>
	<option value="UM">United States Minor Outlying Islands</option>
	<option value="UY">Uruguay</option>
	<option value="UZ">Uzbekistan</option>
	<option value="VU">Vanuatu</option>
	<option value="VE">Venezuela, Bolivarian Republic of</option>
	<option value="VN">Viet Nam</option>
	<option value="VG">Virgin Islands, British</option>
	<option value="VI">Virgin Islands, U.S.</option>
	<option value="WF">Wallis and Futuna</option>
	<option value="EH">Western Sahara</option>
	<option value="YE">Yemen</option>
	<option value="ZM">Zambia</option>	
	<option value="ZW">Zimbabwe</option>
</select>
<span id="usercountry" class="info"></span>
</div>

<div class="from-group col-md-12">
<input class="input-field" type="text" value="" name="flat_num" id="flat_num" placeholder="House/Flat Number"/>
<span id="userflat_num" class="info"></span>
</div>

<div class="from-group col-md-6">
<input class="input-field" type="text" value="" name="street_number" id="street_number" placeholder="Street Number" />
<span id="userstreet_number" class="info"></span>
</div>
<div class="from-group col-md-6">
<input class="input-field" type="text" value="" name="zip_code" id="zip_code" placeholder="Post Code" />
<span id="userzip_code" class="info"></span>
</div>

<div class="from-group col-md-12">
<input class="input-field" type="text" value="" name="username" id="username" placeholder="Username" />
<span id="userusername" class="info"></span>
</div>

<div class="from-group col-md-12">
<input class="input-field" type="text" value="" name="email" id="email" placeholder="Email"/>
<span id="useremail" class="info"></span>
</div>
<div class="from-group col-md-6">
<input class="input-field" type="password" value="" name="password1" id="password1" placeholder="Password" />
<span id="userpassword1" class="info"></span>
</div>

<div class="from-group col-md-6">
<input class="input-field" type="password" value="" name="password2" id="password2" placeholder="Password Again" />
<span id="userpassword2" class="info"></span>
</div>
<div class="from-group col-md-6">
	<select class="input-field" name="userroles" id="userroles" style="display: block;margin-bottom: 20px;">
	<option value="">Select Roles</option>	
	<option value="buyer">Business Owner</option>
	<option value="broker">Business Broker</option>

</select>
<span id="usercountry" class="info"></span>
</div>

<div class="input-check">
	<label class="input-checkbox"> <input type="checkbox" name="vehicle1" id="vehicle1" value="checkbox" checked=""> 
	Please tick if you consent to being contacted by email  getabusiness and carefully 
selected 3rd party services. Note we do not sell, rent or share your data with third 
parties without your consent   
 <span class="checkmark"></span></label></div>

<div class="input-check">
	<label class="input-checkbox"> <input type="checkbox" name="vehicle2" id="vehicle2" value="checkbox"> 
	I have read and accept the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank"> Terms & Conditions</a> and <a href="<?php echo site_url();?>/privacy-policy/" target="_blank"> Privacy Policy</a>   
        <span class="checkmark"></span></label>
 </div>

 <!-- <div class="alignleft"><p><?php if($sucess != "") { echo $sucess; } ?><?php if($error!= "") { echo $error; } ?></p></div>  -->
<div class="login-btn"> <button type="submit" name="btnregister" class="button" >SIGN UP</button> </div>
<input type="hidden" name="task" value="register" />
<div class="all-regis" ><h4>Already have an Account</h4> <h5> <a href="<?php echo site_url();?>/login"> Login here</a></h5></div>

</div>
</form>

	
</div>
</div>

</div> 
</div>
</section>

<?php
get_footer();
?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
 function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".input-field").css('border', '#e0dfdf 1px solid');
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var tel = $("#tel").val();
            var country = $("#country").val();
            var flat_num = $("#flat_num").val();
            var street_number = $("#street_number").val();
            var zip_code = $("#zip_code").val();
            var username = $("#username").val();
            var email = $("#email").val();
            var password1 = $("#password1").val();
            var password2 = $("#password2").val();           
            
            
            if (first_name == "") {
                $("#userfirst_name").html("Please Enter First Name.");
                $("#first_name").css('border', '#e66262 1px solid');
                valid = false;
            }
              if (last_name == "") {
                $("#userlast_name").html("Please Enter Last Name.");
                $("#last_name").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (tel == "") {
                $("#usertel").html("Please Enter Phone Number.");
                $("#tel").css('border', '#e66262 1px solid');
                valid = false;
            }
             if (country == "") {
                $("#usercountry").html("Please Select Country Name.");
                $("#country").css('border', '#e66262 1px solid');
                valid = false;
            }
            
            if (flat_num == "") {
                $("#userflat_num").html("Please Enter Flat Number.");
                $("#flat_num").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (street_number == "") {
                $("#userstreet_number").html("Please Enter Street Number.");
                $("#street_number").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (zip_code == "") {
                $("#userzip_code").html("Please Enter Zip Code.");
                $("#zip_code").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (username == "") {
                $("#userusername").html("Please Enter User Name.");
                $("#username").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (email == "") {
                $("#useremail").html("Please Enter User Email.");
                $("#email").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (password1 == "") {
                $("#userpassword1").html("Please Enter Password.");
                $("#password1").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (password1 != password2) {
                $("#userpassword2").html("Password And Confirm Password Not Match.");
                $("#password2").css('border', '#e66262 1px solid');
                valid = false;
            }

            
            return valid;
        }


</script>