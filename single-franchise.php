<?php
 /**
 * The template for displaying all single posts and attachments
 */
 global $post, $current_user;
 $post_id =  $post->ID;
 $post_title =  get_the_title( $post_id );
 $post_url = get_permalink( $post_id );
 $post_author_id = get_post_field( 'post_author', $post_id );
 $author_email =  get_the_author_meta( 'user_email', $post->post_author );
 $user_id = $current_user->ID;
 $current_user_email = $current_user->user_email;
 $current_user_first_name = $current_user->user_firstname;
 $current_user_first_last = $current_user->user_lastname; 
 $telephone = get_user_meta( $user_id, 'tel', true );
 if(is_user_logged_in()){ 
 if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $country_name = $_POST['country_name'];
            $tel = $_POST['tel'];
            $company = $_POST['company'];
            $address = $_POST['address'];
            $investment_level =$_POST['investment_level'];
            $finance_ready = $_POST['finance_ready'];
            $time_scale = $_POST['time_scale'];
            $post_code = $_POST['post_code'];
            $message = $_POST['message'];
            
            $message = "<html><body>
                        First Name    :  $first_name<br>
                        Last Name   :  $last_name<br>
                        Country Name  :  $country_name<br>
                        Phone Number : $tel<br>                     
                        Company : $company<br>
                        Address : $address<br>
                        Investment Level : $investment_level<br>
                        Finance Ready : $finance_ready<br>
                        Time Scale : $time_scale<br>
                        Email : $current_user_email<br>
                        Post Code : $post_code<br>
                        Message : $message<br>
                        Post Title : $post_title<br>
                        Post URL : $post_url
                        </body></html>";
                        
            $to = $author_email;//to email
            $from = $current_user_email;//from email 
            $sub = "Enquiry Details";
            
            $headers = "From: ".$from."\r\n". "Reply-To:" . $from . "\r\n" ;
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    

            mail($to,$sub,$message,$headers);
         $success = 'Thank you for filling out your information!';
}
} else {
       
       if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $country_name = $_POST['country_name'];
            $tel = $_POST['tel'];
            $company = $_POST['company'];
            $address = $_POST['address'];
            $investment_level =$_POST['investment_level'];
            $finance_ready = $_POST['finance_ready'];
            $time_scale = $_POST['time_scale'];
            $post_code = $_POST['post_code'];
            $message = $_POST['message'];
            
            $message = "<html><body>
                        First Name    :  $first_name<br>
                        Last Name   :  $last_name<br>
                        Country Name  :  $country_name<br>
                        Phone Number : $tel<br>                     
                        Company : $company<br>
                        Address : $address<br>
                        Investment Level : $investment_level<br>
                        Finance Ready : $finance_ready<br>
                        Time Scale : $time_scale<br>
                        Email : $email<br>
                        Post Code : $post_code<br>
                        Message : $message<br>
                        Post Title : $post_title<br>
                        Post URL : $post_url
                        </body></html>";
                        
            $to = $author_email;//to email
            $from = $email;//from email 
            $sub = "Enquiry Details";
            
            $headers = "From: ".$from."\r\n". "Reply-To:" . $from . "\r\n" ;
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    

            mail($to,$sub,$message,$headers);
         $success = 'Thank you for filling out your information!';
}
     
	/*$error= '';
	$success = '';
 
	global $wpdb, $PasswordHash, $current_user, $user_ID;
 
	if(isset($_POST['submit']) && $_POST['task'] == 'register' ) {
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name  = $wpdb->escape(trim($_POST['last_name']));
		$username   = $wpdb->escape(trim($_POST['username']));
		$email      = $wpdb->escape(trim($_POST['email']));
		$password  = $wpdb->escape(trim($_POST['password']));
		$newsletter  = $wpdb->escape(trim($_POST['newsletter']));
		$agree_terms  = $wpdb->escape(trim($_POST['agree_terms']));
		
		
		
		$newsletter  = $wpdb->escape(trim($_POST['newsletter']));
		$agree_terms  = $wpdb->escape(trim($_POST['agree_terms']));
		
if($first_name == "" || $last_name == "" || $username == "" || $email == "" || $password == "" || $newsletter == "" || $agree_terms == "") 

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
		     } 

		else 
		{
			?><script>window.location = "<?php echo home_url('/login/');?>"</script><?php
	$user_id = wp_insert_user( array ('first_name' => apply_filters
		     ('pre_user_first_name', $first_name), 
		      'last_name'  => apply_filters('pre_user_last_name', $last_name),  
		      'user_pass'  => apply_filters('pre_user_user_pass', $password1), 
		      'user_login' => apply_filters('pre_user_user_login', $username), 
		      'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'buyer' ));

			    update_user_meta( $user_id, 'tel',          $_POST['tel'] );
			    update_user_meta( $user_id, 'country',      $_POST['country'] );
			    update_user_meta( $user_id, 'zip_code',     $_POST['zip_code'] );
			    update_user_meta( $user_id, 'newsletter',     $_POST['newsletter'] );
			    update_user_meta( $user_id, 'agree_terms',     $_POST['agree_terms'] );
			
			if(is_wp_error($user_id)) 
			{$error= 'Error on user creation.';} 
		else{
				do_action('user_register', $user_id);	
				$success = 'You\'re successfully register';
			}	
		}	
	}*/


}
get_header(); ?>
<section class="bradcrumbs_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <?php while(have_posts()): the_post();?>
            <a href="<?php echo site_url();?>">Home</a> / <a href="<?php echo site_url();?>/buy-a-franchise">Buy a Franchise</a> / <span><?php the_title();?></span>
            <?php endwhile;?>
         </div>
      </div>
   </div>
</section>
<?php
   /*$args = array(
   'post_type' => 'franchise',
   'post_status' => 'publish',
   'posts_per_page' => '1'
   );
   
   $franchise_loop = new WP_Query( $args );*/
   if ( have_posts() ) :
   while ( have_posts() ) : the_post();
     // Set variables
   
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); $title = get_the_title();
       $description = get_the_content();
       
     // Output
     ?>
<section class="franchise_listing_single_section">
   <div class="container">
      <div class="frachise_single_page">
      <div class="row">
         <div class="col-lg-3">
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
            <img src="<?php echo $image[0]; ?>" alt="" />
         </div>
         <div class="col-lg-5">
            <div class="single_buy_details_section">
               <h2><?php the_title();?></h2>
               <div class="minimum_annual_location">
                  <?php $minimum_investment = get_post_meta( get_the_ID(), 'minimum_investment', 1 );?>
                  <?php if($minimum_investment){ ?>
                  <div class="minimum_sec">
                     <span>Minimum Investment :</span> $<?php echo $minimum_investment;?> 
                  </div>
                  <?php } ?>
                  <div class="business-type"><span>Business Type :</span> <?php
                     $category_detail=get_the_terms($post->ID, 'franchise-category');//$post->ID
                     foreach($category_detail as $cd){
                     echo $cd->name;
                     }
                     ?></div>
                  <div class="support"><span>Support & Training :</span><?php echo get_post_meta( get_the_ID(), 'support', 1 ); ?></div>
                  <br>
                  <div class="availability_sec">
                     <span>Availability :</span><?php echo get_post_meta( get_the_ID(), 'availability', 1 );?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="buyer_social">
               <ul>
                  <li><a href="<?php the_field('facebook_link', 'option');?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="<?php the_field('twitter_link', 'option');?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="<?php the_field('instagram_link', 'option');?>" target="_blank"><i class="fab fa-instagram"></i></i></a></li>
                  <li><a href="<?php the_field('linkedin_link', 'option');?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
               </ul>
            </div>
            <div class="investment_form_section">
               <span>Capital Required :</span> $<?php  echo get_field ('investment_from'); ?>  
               <span>To</span> $<?php  echo get_field ('investment_to'); ?>
               <!-- <span class="investment_to_section">
                  
               </span> -->
            </div>
         </div>
      </div>
   </div>
</div>
</section>
<section class="business_tabs_section franchise">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 ">
            <nav class="franchise_single_tabing">
               <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="business-description-tab" data-toggle="tab" href="#business-description" role="tab" aria-controls="business-description" aria-selected="true">Franchise Information</a>
                  <a class="nav-item nav-link" id="property-details-tab" data-toggle="tab" href="#property-details" role="tab" aria-controls="property-details" aria-selected="false">Require Content</a>
               </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
               <div class="tab-pane fade show active" id="business-description" role="tabpanel" aria-labelledby="business-description-tab">
                  <?php the_content();?>
               </div>
               <div class="tab-pane fade" id="property-details" role="tabpanel" aria-labelledby="property-details-tab">
                  <?php echo get_field('require_content');?>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
</section>
<?php
   endwhile;
   endif;
   ?>
<section class="contact_seller_form_section">
   <div class="container">
      <div class="contact_seller_form_wrapper franchise">
        
        <?php if(is_user_logged_in()){ ?>
          <?php if(isset($success)){ ?>
             <div class="message_text_info">
            <h4><?php echo $success; ?></h4>
         </div>
           <?php }?>
         <div class="contact_seller_form_heading">
            <h2>Contact <span>Futurenet</span></h2>
            <!-- <?php if(is_user_logged_in()){ ?>
            <div class="already_member">
               <h4>Existing account ? <a href="<?php echo wp_logout_url(home_url('/'));?>">Log out</a></h4>
            </div>
            <?php } else { ?>
            <div class="already_member">
               <h4>Existing account ? <a href="<?php echo site_url();?>/login/">Sign in here</a></h4>
            </div>
            <?php } ?> -->
         </div>
         <form name="frmContact" action="" method="post" onsubmit="return validateContactForm()">
         	<input type="hidden" class="form-control" name="target_email" value="<?php echo $author_email;?>">
         	<input type="hidden" class="form-control" name="franchise_id" value="<?php echo $post_id;?>">
         	<input type="hidden" class="form-control" name="franchise_title" value="<?php echo $post_title;?>">
            <input type="hidden" class="form-control" name="franchise_title_url" value="<?php echo $post_url;?>">
         	<input type="hidden" class="form-control" name="author_id" value="<?php echo $post_author_id;?>">
         	
            <div class="row">
               <div class="col-lg-6">
                  <input id="first_name" type="text" class="form-control input-field" placeholder="First name*" name="first_name" value="<?php echo $current_user_first_name;?>">
                  <span id="userfirst_name" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="last_name" type="text" class="form-control input-field" placeholder="Last name*" name="last_name" value="<?php echo $current_user_first_last;?>">
                  <span id="userlast_name" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select id="country" class="form-control input-field" name="country_name">
                     <option value="">Select Country</option>
                     <option value="Afghanistan">Afghanistan</option>
                     <option value="Albania">Albania</option>
                     <option value="Algeria">Algeria</option>
                     <option value="American Samoa">American Samoa</option>
                     <option value="Andorra">Andorra</option>
                     <option value="Angola">Angola</option>
                     <option value="Anguilla">Anguilla</option>
                     <option value="Antarctica">Antarctica</option>
                     <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                     <option value="Argentina">Argentina</option>
                     <option value="Armenia">Armenia</option>
                     <option value="Aruba">Aruba</option>
                     <option value="Australia">Australia</option>
                     <option value="Austria">Austria</option>
                     <option value="Azerbaijan">Azerbaijan</option>
                     <option value="Bahrain">Bahrain</option>
                     <option value="Bangladesh">Bangladesh</option>
                     <option value="Barbados">Barbados</option>
                     <option value="Belarus">Belarus</option>
                     <option value="Belgium">Belgium</option>
                     <option value="Belize">Belize</option>
                     <option value="Benin">Benin</option>
                     <option value="Bermuda">Bermuda</option>
                     <option value="Bhutan">Bhutan</option>
                     <option value="Bolivia">Bolivia</option>
                     <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                     <option value="Botswana">Botswana</option>
                     <option value="Bouvet Island">Bouvet Island</option>
                     <option value="Brazil">Brazil</option>
                     <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                     <option value="British Virgin Islands">British Virgin Islands</option>
                     <option value="Brunei">Brunei</option>
                     <option value="Bulgaria">Bulgaria</option>
                     <option value="Burkina Faso">Burkina Faso</option>
                     <option value="Burundi">Burundi</option>
                     <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                     <option value="Cambodia">Cambodia</option>
                     <option value="Cameroon">Cameroon</option>
                     <option value="Canada">Canada</option>
                     <option value="Cape Verde">Cape Verde</option>
                     <option value="Cayman Islands">Cayman Islands</option>
                     <option value="Central African Republic">Central African Republic</option>
                     <option value="Chad">Chad</option>
                     <option value="Chile">Chile</option>
                     <option value="China">China</option>
                     <option value="Christmas Island">Christmas Island</option>
                     <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                     <option value="Colombia">Colombia</option>
                     <option value="Comoros">Comoros</option>
                     <option value="Congo">Congo</option>
                     <option value="Cook Islands">Cook Islands</option>
                     <option value="Costa Rica">Costa Rica</option>
                     <option value="Croatia">Croatia</option>
                     <option value="Cuba">Cuba</option>
                     <option value="Cyprus">Cyprus</option>
                     <option value="Czech Republic">Czech Republic</option>
                     <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                     <option value="Denmark">Denmark</option>
                     <option value="Djibouti">Djibouti</option>
                     <option value="Dominica">Dominica</option>
                     <option value="Dominican Republic">Dominican Republic</option>
                     <option value="East Timor">East Timor</option>
                     <option value="Ecuador">Ecuador</option>
                     <option value="Egypt">Egypt</option>
                     <option value="El Salvador">El Salvador</option>
                     <option value="Equatorial Guinea">Equatorial Guinea</option>
                     <option value="Eritrea">Eritrea</option>
                     <option value="Estonia">Estonia</option>
                     <option value="Ethiopia">Ethiopia</option>
                     <option value="Faeroe Islands">Faeroe Islands</option>
                     <option value="Falkland Islands">Falkland Islands</option>
                     <option value="Fiji">Fiji</option>
                     <option value="Finland">Finland</option>
                     <option value="Macedonia">Former Yugoslav Republic of Macedonia</option>
                     <option value="France">France</option>
                     <option value="France, Metropolitan">France, Metropolitan</option>
                     <option value="French Guiana">French Guiana</option>
                     <option value="French Polynesia">French Polynesia</option>
                     <option value="French Southern Territories">French Southern Territories</option>
                     <option value="Gabon">Gabon</option>
                     <option value="Georgia">Georgia</option>
                     <option value="Germany">Germany</option>
                     <option value="Ghana">Ghana</option>
                     <option value="Gibraltar">Gibraltar</option>
                     <option value="Greece">Greece</option>
                     <option value="Greenland">Greenland</option>
                     <option value="Grenada">Grenada</option>
                     <option value="Guadeloupe">Guadeloupe</option>
                     <option value="Guam">Guam</option>
                     <option value="Guatemala">Guatemala</option>
                     <option value="Guinea">Guinea</option>
                     <option value="Guinea-Bissau">Guinea-Bissau</option>
                     <option value="Guyana">Guyana</option>
                     <option value="Haiti">Haiti</option>
                     <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                     <option value="Honduras">Honduras</option>
                     <option value="Hong Kong">Hong Kong</option>
                     <option value="Hungary">Hungary</option>
                     <option value="Iceland">Iceland</option>
                     <option value="India">India</option>
                     <option value="Indonesia">Indonesia</option>
                     <option value="Iran">Iran</option>
                     <option value="Iraq">Iraq</option>
                     <option value="Ireland">Ireland</option>
                     <option value="Israel">Israel</option>
                     <option value="Italy">Italy</option>
                     <option value="Jamaica">Jamaica</option>
                     <option value="Japan">Japan</option>
                     <option value="Jordan">Jordan</option>
                     <option value="Kazakhstan">Kazakhstan</option>
                     <option value="Kenya">Kenya</option>
                     <option value="Kiribati">Kiribati</option>
                     <option value="Kuwait">Kuwait</option>
                     <option value="Kyrgyzstan">Kyrgyzstan</option>
                     <option value="Laos">Laos</option>
                     <option value="Latvia">Latvia</option>
                     <option value="Lebanon">Lebanon</option>
                     <option value="Lesotho">Lesotho</option>
                     <option value="Liberia">Liberia</option>
                     <option value="Libya">Libya</option>
                     <option value="Liechtenstein">Liechtenstein</option>
                     <option value="Lithuania">Lithuania</option>
                     <option value="Luxembourg">Luxembourg</option>
                     <option value="Macau">Macau</option>
                     <option value="Madagascar">Madagascar</option>
                     <option value="Malawi">Malawi</option>
                     <option value="Malaysia">Malaysia</option>
                     <option value="Maldives">Maldives</option>
                     <option value="Mali">Mali</option>
                     <option value="Mayotte">Mayotte</option>
                     <option value="Marshall Islands">Marshall Islands</option>
                     <option value="Martinique">Martinique</option>
                     <option value="Mauritania">Mauritania</option>
                     <option value="Mauritius">Mauritius</option>
                     <option value="Mexico">Mexico</option>
                     <option value="Micronesia">Micronesia</option>
                     <option value="Moldova">Moldova</option>
                     <option value="Monaco">Monaco</option>
                     <option value="Mongolia">Mongolia</option>
                     <option value="Montenegro">Montenegro</option>
                     <option value="Montserrat">Montserrat</option>
                     <option value="Morocco">Morocco</option>
                     <option value="Mozambique">Mozambique</option>
                     <option value="Myanmar">Myanmar</option>
                     <option value="Namibia">Namibia</option>
                     <option value="Nauru">Nauru</option>
                     <option value="Nepal">Nepal</option>
                     <option value="Netherlands">Netherlands</option>
                     <option value="Netherlands Antilles">Netherlands Antilles</option>
                     <option value="New Caledonia">New Caledonia</option>
                     <option value="New Zealand">New Zealand</option>
                     <option value="Nicaragua">Nicaragua</option>
                     <option value="Niger">Niger</option>
                     <option value="Nigeria">Nigeria</option>
                     <option value="Niue">Niue</option>
                     <option value="Norfolk Island">Norfolk Island</option>
                     <option value="North Korea">North Korea</option>
                     <option value="Northern Marianas">Northern Marianas</option>
                     <option value="Norway">Norway</option>
                     <option value="Oman">Oman</option>
                     <option value="Pakistan">Pakistan</option>
                     <option value="Palau">Palau</option>
                     <option value="Panama">Panama</option>
                     <option value="Papua New Guinea">Papua New Guinea</option>
                     <option value="Paraguay">Paraguay</option>
                     <option value="Peru">Peru</option>
                     <option value="Philippines">Philippines</option>
                     <option value="Pitcairn Islands">Pitcairn Islands</option>
                     <option value="Poland">Poland</option>
                     <option value="Portugal">Portugal</option>
                     <option value="Puerto Rico">Puerto Rico</option>
                     <option value="Qatar">Qatar</option>
                     <option value="Reunion">Reunion</option>
                     <option value="Romania">Romania</option>
                     <option value="Russia">Russia</option>
                     <option value="Rwanda">Rwanda</option>
                     <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                     <option value="Saint Helena">Saint Helena</option>
                     <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                     <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                     <option value="Saint Lucia">Saint Lucia</option>
                     <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                     <option value="Samoa">Samoa</option>
                     <option value="San Marino">San Marino</option>
                     <option value="Saudi Arabia">Saudi Arabia</option>
                     <option value="Senegal">Senegal</option>
                     <option value="Serbia">Serbia</option>
                     <option value="Seychelles">Seychelles</option>
                     <option value="Sierra Leone">Sierra Leone</option>
                     <option value="Singapore">Singapore</option>
                     <option value="Slovakia">Slovakia</option>
                     <option value="Slovenia">Slovenia</option>
                     <option value="Solomon Islands">Solomon Islands</option>
                     <option value="Somalia">Somalia</option>
                     <option value="South Africa">South Africa</option>
                     <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                     <option value="South Korea">South Korea</option>
                     <option value="Spain">Spain</option>
                     <option value="Sri Lanka">Sri Lanka</option>
                     <option value="Sudan">Sudan</option>
                     <option value="Suriname">Suriname</option>
                     <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                     <option value="Swaziland">Swaziland</option>
                     <option value="Sweden">Sweden</option>
                     <option value="Switzerland">Switzerland</option>
                     <option value="Syria">Syria</option>
                     <option value="Taiwan">Taiwan</option>
                     <option value="Tajikistan">Tajikistan</option>
                     <option value="Tanzania">Tanzania</option>
                     <option value="Thailand">Thailand</option>
                     <option value="The Bahamas">The Bahamas</option>
                     <option value="The Gambia">The Gambia</option>
                     <option value="Togo">Togo</option>
                     <option value="Tokelau">Tokelau</option>
                     <option value="Tonga">Tonga</option>
                     <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                     <option value="Tunisia">Tunisia</option>
                     <option value="Turkey">Turkey</option>
                     <option value="Turkmenistan">Turkmenistan</option>
                     <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                     <option value="Tuvalu">Tuvalu</option>
                     <option value="US Virgin Islands">US Virgin Islands</option>
                     <option value="Uganda">Uganda</option>
                     <option value="Ukraine">Ukraine</option>
                     <option value="United Arab Emirates">United Arab Emirates</option>
                     <option value="United Kingdom">United Kingdom</option>
                     <option value="United States">United States</option>
                     <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                     <option value="Uruguay">Uruguay</option>
                     <option value="Uzbekistan">Uzbekistan</option>
                     <option value="Vanuatu">Vanuatu</option>
                     <option value="Vatican City">Vatican City</option>
                     <option value="Venezuela">Venezuela</option>
                     <option value="Vietnam">Vietnam</option>
                     <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                     <option value="Western Sahara">Western Sahara</option>
                     <option value="Yemen">Yemen</option>
                     <option value="Zambia">Zambia</option>
                     <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                  <span id="usercountry" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="tel" type="text" class="form-control input-field" placeholder="Telephone*" name="tel" value="<?php echo $telephone; ?>">
                  <span id="usertel" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <input id="email" type="email" class="form-control input-field" id="inputEmail4" placeholder="Email*" name="email" value="<?php echo $current_user_email;?>">
                  <span id="useremail" class="info"></span>
               </div>
               <!-- <div class="col-lg-6">
                  <input type="text" class="form-control" placeholder="Create Password*" name="password">
               </div> -->
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <input id="company" type="text" class="form-control input-field" placeholder="Company" name="company">
                  <span id="usercompany" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <textarea class="form-control input-field" id="address" rows="2" name="address" placeholder="Address"></textarea>
                  <span id="useraddress" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select class="form-control input-field" id="investment_level" name="investment_level">
                     <option value="">Investment Level</option>
                     <option value="Less than $5,000">Less than $5,000</option>
                     <option value="$5,000 to $10,000">$5,000 to $10,000</option>
                     <option value="$10,000 to $25,000">$10,000 to $25,000</option>
                     <option value="$25,000 to $50,000">$25,000 to $50,000</option>
                     <option value="$50,000 to $75,000">$50,000 to $75,000</option>
                     <option value="$75,000 to $100,000">$75,000 to $100,000</option>
                     <option value="$100,000 to $150,000">$100,000 to $150,000</option>
                     <option value="$150,000 to $200,000">$150,000 to $200,000</option>
                     <option value="$200,000 to $250,000">$200,000 to $250,000</option>
                     <option value="$250,000 to $500,000">$250,000 to $500,000</option>
                     <option value="$500,000 to $1,000,000">$500,000 to $1,000,000</option>
                     <option value="More than $1,000,000">More than $1,000,000</option>
                  </select>
                  <span id="userinvestment_level" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <select class="form-control input-field" id="finance_ready" name="finance_ready">
                     <option value="">Finance Ready</option>
                     <option value="No">No</option>
                     <option value="Yes">Yes</option>
                  </select>
                  <span id="userfinance_ready" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select class="form-control input-field" id="time_scale" name="time_scale">
                     <option value="">Time Scale</option>
                     <option value="1-3 months">1-3 months</option>
                     <option value="3-6 months">3-6 months</option>
                     <option value="6-12 months">6-12 months</option>
                  </select>
                  <span id="usertime_scale" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="post_code" type="text" class="form-control input-field" placeholder="Post Code" name="post_code">
                  <span id="userpost_code" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="message" placeholder="Please send me more information about this franchise."></textarea>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">    
<div class="input-check">
<label class="input-checkbox" > 
   <input type="checkbox"  id="exampleCheck1" value="checkbox" name="newsletter" checked="checked"> 
   Please tick if you consent to being contacted by email  getabusiness and carefully 
selected 3rd party services. Note we do not sell, rent or share your data with third 
parties without your consent   
 <span class="checkmark"></span></label>
</div>
<div class="input-check">
   <label class="input-checkbox" > 
      <input type="checkbox" class="form-check-input input-field" value="checkbox" id="agree_terms" name="agree_terms" > 
   I have read and accept the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank"> Terms &amp; Conditions</a> and <a href="<?php echo site_url();?>/privacy-policy/" target="_blank"> Privacy Policy</a>   
        <span class="checkmark"></span></label>
</div>
                  <span id="useragree_terms" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="submit-btn">
                     <input class="btn" type="submit" name="submit" value="Send Message"> <span></span>
                  </div>
               </div>
            </div>
         </form>
         <?php } else { ?>
            <?php if(isset($success)){ ?>
             <div class="message_text_info">
            <h4><?php echo $success; ?></h4>
           <?php }?>
         </div>
            <div class="contact_seller_form_heading">
            <h2>Contact <span>Futurenet</span></h2>
            <!-- <?php if(is_user_logged_in()){ ?>
            <div class="already_member">
               <h4>Existing account ? <a href="<?php echo wp_logout_url(home_url('/'));?>">Log out</a></h4>
            </div>
            <?php } else { ?>
            <div class="already_member">
               <h4>Existing account ? <a href="<?php echo site_url();?>/login/">Sign in here</a></h4>
            </div>
            <?php } ?> -->
         </div>
        
        <form name="frmContact" action="" method="post" onsubmit="return validateContactForm()">
         	<input type="hidden" class="form-control" name="target_email" value="<?php echo $author_email;?>">
         	<input type="hidden" class="form-control" name="franchise_id" value="<?php echo $post_id;?>">
         	<input type="hidden" class="form-control" name="franchise_title" value="<?php echo $post_title;?>">
            <input type="hidden" class="form-control" name="franchise_title_url" value="<?php echo $post_url;?>">
         	<input type="hidden" class="form-control" name="author_id" value="<?php echo $post_author_id;?>">
         	
            <div class="row">
               <div class="col-lg-6">
                  <input id="first_name" type="text" class="form-control input-field" placeholder="First name*" name="first_name">
                  <span id="userfirst_name" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="last_name" type="text" class="form-control input-field" placeholder="Last name*" name="last_name">
                  <span id="userlast_name" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select id="country" class="form-control input-field" name="country_name">
                     <option value="">Select Country</option>
                     <option value="Afghanistan">Afghanistan</option>
                     <option value="Albania">Albania</option>
                     <option value="Algeria">Algeria</option>
                     <option value="American Samoa">American Samoa</option>
                     <option value="Andorra">Andorra</option>
                     <option value="Angola">Angola</option>
                     <option value="Anguilla">Anguilla</option>
                     <option value="Antarctica">Antarctica</option>
                     <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                     <option value="Argentina">Argentina</option>
                     <option value="Armenia">Armenia</option>
                     <option value="Aruba">Aruba</option>
                     <option value="Australia">Australia</option>
                     <option value="Austria">Austria</option>
                     <option value="Azerbaijan">Azerbaijan</option>
                     <option value="Bahrain">Bahrain</option>
                     <option value="Bangladesh">Bangladesh</option>
                     <option value="Barbados">Barbados</option>
                     <option value="Belarus">Belarus</option>
                     <option value="Belgium">Belgium</option>
                     <option value="Belize">Belize</option>
                     <option value="Benin">Benin</option>
                     <option value="Bermuda">Bermuda</option>
                     <option value="Bhutan">Bhutan</option>
                     <option value="Bolivia">Bolivia</option>
                     <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                     <option value="Botswana">Botswana</option>
                     <option value="Bouvet Island">Bouvet Island</option>
                     <option value="Brazil">Brazil</option>
                     <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                     <option value="British Virgin Islands">British Virgin Islands</option>
                     <option value="Brunei">Brunei</option>
                     <option value="Bulgaria">Bulgaria</option>
                     <option value="Burkina Faso">Burkina Faso</option>
                     <option value="Burundi">Burundi</option>
                     <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                     <option value="Cambodia">Cambodia</option>
                     <option value="Cameroon">Cameroon</option>
                     <option value="Canada">Canada</option>
                     <option value="Cape Verde">Cape Verde</option>
                     <option value="Cayman Islands">Cayman Islands</option>
                     <option value="Central African Republic">Central African Republic</option>
                     <option value="Chad">Chad</option>
                     <option value="Chile">Chile</option>
                     <option value="China">China</option>
                     <option value="Christmas Island">Christmas Island</option>
                     <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                     <option value="Colombia">Colombia</option>
                     <option value="Comoros">Comoros</option>
                     <option value="Congo">Congo</option>
                     <option value="Cook Islands">Cook Islands</option>
                     <option value="Costa Rica">Costa Rica</option>
                     <option value="Croatia">Croatia</option>
                     <option value="Cuba">Cuba</option>
                     <option value="Cyprus">Cyprus</option>
                     <option value="Czech Republic">Czech Republic</option>
                     <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                     <option value="Denmark">Denmark</option>
                     <option value="Djibouti">Djibouti</option>
                     <option value="Dominica">Dominica</option>
                     <option value="Dominican Republic">Dominican Republic</option>
                     <option value="East Timor">East Timor</option>
                     <option value="Ecuador">Ecuador</option>
                     <option value="Egypt">Egypt</option>
                     <option value="El Salvador">El Salvador</option>
                     <option value="Equatorial Guinea">Equatorial Guinea</option>
                     <option value="Eritrea">Eritrea</option>
                     <option value="Estonia">Estonia</option>
                     <option value="Ethiopia">Ethiopia</option>
                     <option value="Faeroe Islands">Faeroe Islands</option>
                     <option value="Falkland Islands">Falkland Islands</option>
                     <option value="Fiji">Fiji</option>
                     <option value="Finland">Finland</option>
                     <option value="Macedonia">Former Yugoslav Republic of Macedonia</option>
                     <option value="France">France</option>
                     <option value="France, Metropolitan">France, Metropolitan</option>
                     <option value="French Guiana">French Guiana</option>
                     <option value="French Polynesia">French Polynesia</option>
                     <option value="French Southern Territories">French Southern Territories</option>
                     <option value="Gabon">Gabon</option>
                     <option value="Georgia">Georgia</option>
                     <option value="Germany">Germany</option>
                     <option value="Ghana">Ghana</option>
                     <option value="Gibraltar">Gibraltar</option>
                     <option value="Greece">Greece</option>
                     <option value="Greenland">Greenland</option>
                     <option value="Grenada">Grenada</option>
                     <option value="Guadeloupe">Guadeloupe</option>
                     <option value="Guam">Guam</option>
                     <option value="Guatemala">Guatemala</option>
                     <option value="Guinea">Guinea</option>
                     <option value="Guinea-Bissau">Guinea-Bissau</option>
                     <option value="Guyana">Guyana</option>
                     <option value="Haiti">Haiti</option>
                     <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                     <option value="Honduras">Honduras</option>
                     <option value="Hong Kong">Hong Kong</option>
                     <option value="Hungary">Hungary</option>
                     <option value="Iceland">Iceland</option>
                     <option value="India">India</option>
                     <option value="Indonesia">Indonesia</option>
                     <option value="Iran">Iran</option>
                     <option value="Iraq">Iraq</option>
                     <option value="Ireland">Ireland</option>
                     <option value="Israel">Israel</option>
                     <option value="Italy">Italy</option>
                     <option value="Jamaica">Jamaica</option>
                     <option value="Japan">Japan</option>
                     <option value="Jordan">Jordan</option>
                     <option value="Kazakhstan">Kazakhstan</option>
                     <option value="Kenya">Kenya</option>
                     <option value="Kiribati">Kiribati</option>
                     <option value="Kuwait">Kuwait</option>
                     <option value="Kyrgyzstan">Kyrgyzstan</option>
                     <option value="Laos">Laos</option>
                     <option value="Latvia">Latvia</option>
                     <option value="Lebanon">Lebanon</option>
                     <option value="Lesotho">Lesotho</option>
                     <option value="Liberia">Liberia</option>
                     <option value="Libya">Libya</option>
                     <option value="Liechtenstein">Liechtenstein</option>
                     <option value="Lithuania">Lithuania</option>
                     <option value="Luxembourg">Luxembourg</option>
                     <option value="Macau">Macau</option>
                     <option value="Madagascar">Madagascar</option>
                     <option value="Malawi">Malawi</option>
                     <option value="Malaysia">Malaysia</option>
                     <option value="Maldives">Maldives</option>
                     <option value="Mali">Mali</option>
                     <option value="Mayotte">Mayotte</option>
                     <option value="Marshall Islands">Marshall Islands</option>
                     <option value="Martinique">Martinique</option>
                     <option value="Mauritania">Mauritania</option>
                     <option value="Mauritius">Mauritius</option>
                     <option value="Mexico">Mexico</option>
                     <option value="Micronesia">Micronesia</option>
                     <option value="Moldova">Moldova</option>
                     <option value="Monaco">Monaco</option>
                     <option value="Mongolia">Mongolia</option>
                     <option value="Montenegro">Montenegro</option>
                     <option value="Montserrat">Montserrat</option>
                     <option value="Morocco">Morocco</option>
                     <option value="Mozambique">Mozambique</option>
                     <option value="Myanmar">Myanmar</option>
                     <option value="Namibia">Namibia</option>
                     <option value="Nauru">Nauru</option>
                     <option value="Nepal">Nepal</option>
                     <option value="Netherlands">Netherlands</option>
                     <option value="Netherlands Antilles">Netherlands Antilles</option>
                     <option value="New Caledonia">New Caledonia</option>
                     <option value="New Zealand">New Zealand</option>
                     <option value="Nicaragua">Nicaragua</option>
                     <option value="Niger">Niger</option>
                     <option value="Nigeria">Nigeria</option>
                     <option value="Niue">Niue</option>
                     <option value="Norfolk Island">Norfolk Island</option>
                     <option value="North Korea">North Korea</option>
                     <option value="Northern Marianas">Northern Marianas</option>
                     <option value="Norway">Norway</option>
                     <option value="Oman">Oman</option>
                     <option value="Pakistan">Pakistan</option>
                     <option value="Palau">Palau</option>
                     <option value="Panama">Panama</option>
                     <option value="Papua New Guinea">Papua New Guinea</option>
                     <option value="Paraguay">Paraguay</option>
                     <option value="Peru">Peru</option>
                     <option value="Philippines">Philippines</option>
                     <option value="Pitcairn Islands">Pitcairn Islands</option>
                     <option value="Poland">Poland</option>
                     <option value="Portugal">Portugal</option>
                     <option value="Puerto Rico">Puerto Rico</option>
                     <option value="Qatar">Qatar</option>
                     <option value="Reunion">Reunion</option>
                     <option value="Romania">Romania</option>
                     <option value="Russia">Russia</option>
                     <option value="Rwanda">Rwanda</option>
                     <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                     <option value="Saint Helena">Saint Helena</option>
                     <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                     <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                     <option value="Saint Lucia">Saint Lucia</option>
                     <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                     <option value="Samoa">Samoa</option>
                     <option value="San Marino">San Marino</option>
                     <option value="Saudi Arabia">Saudi Arabia</option>
                     <option value="Senegal">Senegal</option>
                     <option value="Serbia">Serbia</option>
                     <option value="Seychelles">Seychelles</option>
                     <option value="Sierra Leone">Sierra Leone</option>
                     <option value="Singapore">Singapore</option>
                     <option value="Slovakia">Slovakia</option>
                     <option value="Slovenia">Slovenia</option>
                     <option value="Solomon Islands">Solomon Islands</option>
                     <option value="Somalia">Somalia</option>
                     <option value="South Africa">South Africa</option>
                     <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                     <option value="South Korea">South Korea</option>
                     <option value="Spain">Spain</option>
                     <option value="Sri Lanka">Sri Lanka</option>
                     <option value="Sudan">Sudan</option>
                     <option value="Suriname">Suriname</option>
                     <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                     <option value="Swaziland">Swaziland</option>
                     <option value="Sweden">Sweden</option>
                     <option value="Switzerland">Switzerland</option>
                     <option value="Syria">Syria</option>
                     <option value="Taiwan">Taiwan</option>
                     <option value="Tajikistan">Tajikistan</option>
                     <option value="Tanzania">Tanzania</option>
                     <option value="Thailand">Thailand</option>
                     <option value="The Bahamas">The Bahamas</option>
                     <option value="The Gambia">The Gambia</option>
                     <option value="Togo">Togo</option>
                     <option value="Tokelau">Tokelau</option>
                     <option value="Tonga">Tonga</option>
                     <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                     <option value="Tunisia">Tunisia</option>
                     <option value="Turkey">Turkey</option>
                     <option value="Turkmenistan">Turkmenistan</option>
                     <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                     <option value="Tuvalu">Tuvalu</option>
                     <option value="US Virgin Islands">US Virgin Islands</option>
                     <option value="Uganda">Uganda</option>
                     <option value="Ukraine">Ukraine</option>
                     <option value="United Arab Emirates">United Arab Emirates</option>
                     <option value="United Kingdom">United Kingdom</option>
                     <option value="United States">United States</option>
                     <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                     <option value="Uruguay">Uruguay</option>
                     <option value="Uzbekistan">Uzbekistan</option>
                     <option value="Vanuatu">Vanuatu</option>
                     <option value="Vatican City">Vatican City</option>
                     <option value="Venezuela">Venezuela</option>
                     <option value="Vietnam">Vietnam</option>
                     <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                     <option value="Western Sahara">Western Sahara</option>
                     <option value="Yemen">Yemen</option>
                     <option value="Zambia">Zambia</option>
                     <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                  <span id="usercountry" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="tel" type="text" class="form-control input-field" placeholder="Telephone*" name="tel">
                  <span id="usertel" class="info"></span>
               </div>
            </div>
            <!-- <div class="row">
               <div class="col-lg-12">
                  <input id="username" type="text" class="form-control input-field" placeholder="Username" name="username">
                  <span id="userusername" class="info"></span>
               </div>
            </div> -->
            <div class="row">
               <div class="col-lg-6">
                  <input id="email" type="email" class="form-control input-field" id="inputEmail4" placeholder="Email*" name="email">
                  <span id="useremail" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="company" type="text" class="form-control input-field" placeholder="Company" name="company">
                  <span id="usercompany" class="info"></span>
               </div>
               <!-- <div class="col-lg-6">
                  <input id="password" type="text" class="form-control input-field" placeholder="Create Password*" name="password">
                  <span id="userpassword" class="info"></span>
               </div> -->
            </div>
            <!-- <div class="row">
               <div class="col-lg-12">
                  <input id="company" type="text" class="form-control input-field" placeholder="Company" name="company">
                  <span id="usercompany" class="info"></span>
               </div>
            </div> -->
            <div class="row">
               <div class="col-lg-12">
                  <textarea class="form-control input-field" id="address" rows="2" name="address" placeholder="Address"></textarea>
                  <span id="useraddress" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select class="form-control input-field" id="investment_level" name="investment_level">
                     <option value="">Investment Level</option>
                     <option value="Less than $5,000">Less than $5,000</option>
                     <option value="$5,000 to $10,000">$5,000 to $10,000</option>
                     <option value="$10,000 to $25,000">$10,000 to $25,000</option>
                     <option value="$25,000 to $50,000">$25,000 to $50,000</option>
                     <option value="$50,000 to $75,000">$50,000 to $75,000</option>
                     <option value="$75,000 to $100,000">$75,000 to $100,000</option>
                     <option value="$100,000 to $150,000">$100,000 to $150,000</option>
                     <option value="$150,000 to $200,000">$150,000 to $200,000</option>
                     <option value="$200,000 to $250,000">$200,000 to $250,000</option>
                     <option value="$250,000 to $500,000">$250,000 to $500,000</option>
                     <option value="$500,000 to $1,000,000">$500,000 to $1,000,000</option>
                     <option value="More than $1,000,000">More than $1,000,000</option>
                  </select>
                  <span id="userinvestment_level" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <select class="form-control input-field" id="finance_ready" name="finance_ready">
                     <option value="">Finance Ready</option>
                     <option value="No">No</option>
                     <option value="Yes">Yes</option>
                  </select>
                  <span id="userfinance_ready" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <select class="form-control input-field" id="time_scale" name="time_scale">
                     <option value="">Time Scale</option>
                     <option value="1-3 months">1-3 months</option>
                     <option value="3-6 months">3-6 months</option>
                     <option value="6-12 months">6-12 months</option>
                  </select>
                  <span id="usertime_scale" class="info"></span>
               </div>
               <div class="col-lg-6">
                  <input id="zip_code" type="text" class="form-control input-field" placeholder="Post Code" name="post_code">
                  <span id="userzip_code" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="message" placeholder="Please send me more information about this franchise."></textarea>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="input-check">
<label class="input-checkbox" > 
   <input type="checkbox"  id="exampleCheck1" value="checkbox" name="newsletter" checked="checked"> 
   Please tick if you consent to being contacted by email  getabusiness and carefully 
selected 3rd party services. Note we do not sell, rent or share your data with third 
parties without your consent   
 <span class="checkmark"></span></label>
</div>
<div class="input-check">
   <label class="input-checkbox"> 
      <input type="checkbox" class="form-check-input input-field" value="checkbox" id="agree_terms" name="agree_terms"> 
   I have read and accept the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank"> Terms &amp; Conditions</a> and <a href="<?php echo site_url();?>/privacy-policy/" target="_blank"> Privacy Policy</a>   
        <span class="checkmark"></span></label>
</div>
                  <span id="useragree_terms" class="info"></span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="submit-btn">
                     <input class="btn" type="submit" name="submit" value="Send Message"> <span></span>
                     <input type="hidden" name="task" value="register" />
                  </div>
               </div>
            </div>
         </form>

      <?php } ?>
      </div>
   </div>
</section>
<?php         
get_footer();
?>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  $("form[name='frmContact']").validate({
    // Specify validation rules
    rules: {
      first_name: "required",
      last_name: "required",
      country_name: "required",
      tel: "required",
      email: {
        required: true,
        email: true
      },
      company: "required",
      address: "required",
      investment_level: "required",
      finance_ready: "required",
      time_scale: "required",
      post_code: "required",
      agree_terms: "required",
    },
    messages: {
      first_name: "Please enter your First Name",
      last_name: "Please enter your Last Name",
      country_name: "Please Select Country Name",
      email: "Please enter a valid Email Address",
      tel: "Please enter Phone Number",
      company: "Please enter Company Name",
      address: "Please enter Address",
      investment_level: "Please select Investment Level",
      finance_ready: "Please select Finance Ready",
      time_scale: "Please select Time Scale",
      post_code: "Please enter Zip Code",
      agree_terms: "Please accept Terms of use"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>

