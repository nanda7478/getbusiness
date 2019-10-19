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
 //if(is_user_logged_in()){ 
 if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $country_name = $_POST['country'];
            $tel = $_POST['tel'];
            $company = $_POST['company'];
            $address = $_POST['address'];
            $location =$_POST['location'];
            $city = $_POST['city'];
            $post_code = $_POST['post_code'];
            $message = $_POST['message'];
            
            $message = "<html><body>
                        First Name    :  $first_name<br>
                        Last Name   :  $last_name<br>
                        Country Name  :  $country_name<br>
                        Phone Number : $tel<br>                     
                        Company : $company<br>
                        Address : $address<br>
                        Location : $location<br>
                        City : $city<br>
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
//}
get_header(); ?>
<style type="text/css">
	#myCarousel .list-inline {
    white-space:nowrap;
    overflow-x:auto;
}

#myCarousel .carousel-indicators {
    position: static;
    left: initial;
    width: initial;
    margin-left: initial;
}

#myCarousel .carousel-indicators > li {
    width: initial;
    height: initial;
    text-indent: initial;
}

#myCarousel .carousel-indicators > li.active img {
    opacity: 0.7;
}
</style>
<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<?php while(have_posts()): the_post();?>
				<a href="<?php echo site_url();?>">Home</a> / <a href="<?php echo site_url();?>/buy-a-business">Buy a Business</a> / <span><?php the_title();?></span>
			<?php endwhile;?>
			</div>
		</div>
	</div>
</section>
<?php while(have_posts()): the_post();?>
 <section class="business_listing_single_section">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-6">
 			<div class="single_buy_gallery">
 			<?php
 			$files = get_post_meta( get_the_ID(), '_business_gallery_images', 1 );
 			?>
 <div id="slider" class="flexslider">
   
          <ul class="slides">
           <?php

           $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

           if($large_image_url[0]){
           ?>
           <li>
              <img src="<?php echo $large_image_url[0]; ?>" />
            </li>
            <?php
            }
            ?>
             <?php $uploade_images =  get_field('uploade_images'); 
              if($uploade_images){
             foreach ($uploade_images as  $value) {
             ?>
             <li>
              <img src="<?php echo wp_get_attachment_url($value); ?>" />
            </li>
            <?php 
          }
             }
            ?>


          
          </ul>
        </div>
        <div id="carousel" class="flexslider">
          <ul class="slides">
            <?php
           $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
           if($large_image_url[0]){
           ?>
           <li>
              <img src="<?php echo $large_image_url[0]; ?>" />
            </li>
            <?php
            }
            ?>
               <?php $uploade_images =  get_field('uploade_images'); 
               if($uploade_images){
             foreach ($uploade_images as  $value) {
             ?>
             <li>
              <img src="<?php echo wp_get_attachment_url($value); ?>" />
            </li>
            <?php 
             }
           }
            ?>
           
          </ul>
        </div>

 			</div>
 			</div>
 			<div class="col-lg-6">
 				<div class="single_buy_details_section">
 					<h2><?php the_title();?></h2>
 					<div class="price_annual_location">

 						<div class="price_sec">
 						<span>Price:</span> $<?php echo get_field('bprice'); ?> 
 						</div>
 					
 						<?php $offer_price = get_post_meta( get_the_ID(), '_business_offer_price', 1 );?>
 						<?php if($offer_price){ ?>
 						<div class="price_sec">
 						<span>Price:</span> <?php echo $offer_price;?> 
 						</div>
 						<?php } ?>
 						<div class="annual_turnover"><span>Annual Turnover:</span> $<?php echo get_post_meta( get_the_ID(), '_business_annual_turnover', 1 ); ?></div>
 						<div class="location_sec">
 						<span>Location:</span> <?php
           echo  $location = get_field('country'); 
               
            ?>
 						</div>
 						<div class="trading_hours">
 						<span>Trading Hours:</span> <?php echo get_field('trading_hours'); ?>
 						</div>
 						<!-- <div class="tenure">
 						<span>Tenure:</span> 
 						</div> -->
 					</div>
                   <div class="bussiness_feature_section">
                  <?php
                  $location__terms = get_terms("business-feature");

                  ?>
                   	<ul>
                       <?php foreach($location__terms as $location) { ?>
                   		<li><?php echo $location->name;?></li>
                   		<?php } ?>
                   	</ul>
                   </div>
                  
                  <p>This lease allows you to sublet the business</p>
                 <div class="request_details">
                 	<a href="#contact_seller_section" class="scroll_details">Request Details</a>
                 </div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>

 <section class="business_tabs_section">
 	<div class="container">
              <div class="row">
                <div class="col-lg-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="business-description-tab" data-toggle="tab" href="#business-description" role="tab" aria-controls="business-description" aria-selected="true">Business Description</a>
                      <a class="nav-item nav-link" id="property-details-tab" data-toggle="tab" href="#property-details" role="tab" aria-controls="property-details" aria-selected="false">Property Details</a>
                      <a class="nav-item nav-link" id="other-details-tab" data-toggle="tab" href="#other-details" role="tab" aria-controls="other-details" aria-selected="false">Other Details</a>
                      <a class="nav-item nav-link" id="operation-details-tab" data-toggle="tab" href="#operation-details" role="tab" aria-controls="operation-details" aria-selected="false">Operation Details</a>
                      <a class="nav-item nav-link" id="miscellaneous-tab" data-toggle="tab" href="#miscellaneous" role="tab" aria-controls="miscellaneous" aria-selected="false">
                      Miscellaneous
                      </a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="business-description" role="tabpanel" aria-labelledby="business-description-tab">
                     <?php the_content();?>
                    </div>
                    <div class="tab-pane fade" id="property-details" role="tabpanel" aria-labelledby="property-details-tab">
                      <?php echo get_post_meta( get_the_ID(), '_business_property_details', 1 );?>
                    </div>
                    <div class="tab-pane fade" id="other-details" role="tabpanel" aria-labelledby="other-details-tab">
                      <?php echo get_post_meta( get_the_ID(), '_business_other_details', 1 );?>
                    </div>
                    <div class="tab-pane fade" id="operation-details" role="tabpanel" aria-labelledby="operation-details-tab">
                      <?php echo get_post_meta( get_the_ID(), '_business_Operation_details', 1 );?>
                    </div>
                    <div class="tab-pane fade" id="miscellaneous" role="tabpanel" aria-labelledby="miscellaneous-tab">
                     <?php echo get_post_meta( get_the_ID(), '_business_miscellaneous', 1 );?>
                    </div>

                  </div>
                
                </div>
              </div>
        </div>
      </div>
</div>

 </section>

 <section id="contact_seller_section" class="contact_seller_form_section">
 	<div class="container">
 		<div class="contact_seller_form_wrapper">
      <?php if(isset($success)){?>
      <div class="contact_seller_message"><h4><?php echo $success; ?></h4></div>
    <?php } ?>
 			<div class="contact_seller_form_heading">
 				<h2>Contact this <span>Seller</span></h2>
        <?php if(!is_user_logged_in()){ ?>
 				<!-- <div class="already_member">
 					<h4>Already a Member ? <a href="<?php echo wp_logout_url(home_url('/'));?>">Log out</a></h4>
 				</div>
        <?php //} else { ?> -->
        <!-- <div class="already_member">
          <h4>Already a Member ? <a href="<?php echo site_url();?>/login/">Login</a></h4>
        </div> -->
        <?php } ?>
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
 				<input type="email" class="form-control input-field" id="email" placeholder="Email*" name="email" value="<?php echo $current_user_email;?>">
        <span id="useremail" class="info"></span>
 				</div>
 				<div class="col-lg-6">
 					<input id="tel" type="text" class="form-control input-field" placeholder="Telephone*" name="tel" value="<?php echo $telephone; ?>">
          <span id="usertel" class="info"></span>
 				</div>
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
 					<select id="country" class="form-control input-field" name="country">
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
        <input id="location" type="text" class="form-control input-field" placeholder="Location" name="location">
					<span id="userlocation" class="info"></span>
 				</div>
 			</div>

 			<div class="row">
 				<div class="col-lg-6">
 				<input id="city" type="text" class="form-control input-field" placeholder="City*" name="city">
        <span id="usercity" class="info"></span>
 				</div>
 				<div class="col-lg-6">
 				<input id="post_code" type="text" class="form-control input-field" placeholder="Post Code" name="post_code">
        <span id="userpost_code" class="info"></span>
 				</div>
 			</div>

 			<div class="row">
 				<div class="col-lg-12">
 					<textarea class="form-control input-field" id="message" rows="4" name="message" placeholder="Please contact me with information about this business."></textarea>
          <span id="usermessage" class="info"></span>
 				</div>
 			</div>

 			<div class="row">
 				<div class="col-lg-12">
          <label class="input-checkbox"  for="exampleCheck1"> <input  type="checkbox" class="form-check-input" id="exampleCheck1" name="newsletter" checked="checked"> 
Yes I wish to receive the monthly newsletter and other emails directly from Getabusiness  
 <span class="checkmark"></span></label>

  <label class="input-checkbox"  for="exampleCheck2"> <input  type="checkbox" class="form-check-input" id="agree_terms" name="agree_terms">
I have read and agree with the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank">Terms & Conditions</a> & <a href="<?php echo site_url();?>/privacy-policy/" target="_blank">Privacy</a> 
 <span class="checkmark"></span></label>
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
 		</div>
 	</div>
 </section>
<?php endwhile;?>
<section class="similar_listing_section">
  <div class="container">
    <div class="similar_listing_wrapper">
      <div class="similar_listing_heading text-center">
        <h2>Similar <span>Listings</span></h2>
      </div>
    
    
    

 

<div class="flexslider carousel">
          <ul class="slides">
            <?php
       $args = array('post_type' => 'buy', 'posts_per_page' => 6, 'order' => 'ASC');
       $query = new WP_Query($args);
       while($query->have_posts()): $query->the_post();
       $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
       ?>
            <li>
              <div class="sale_listing">
          <div class="sale_pic">
            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $large_image_url[0]);?>"></a>
          </div>
          <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
          <?php $price = get_post_meta( get_the_ID(), 'bprice', 1 );?>
          <?php if($price){ ?>
          <p class="price"><span>Price:</span> $<?php echo $price;?></p>
          <?php } ?>
          <!-- <?php $offer_price = get_post_meta( get_the_ID(), '_business_offer_price', 1 );?>
          <?php if($offer_price){ ?>
          <p class="price"><span>Price:</span> <?php echo $offer_price;?></p>
          <?php } ?> -->
          <p class="location"><span>Location:</span> <?php echo get_post_meta( get_the_ID(), 'country', 1 );?></p>
                    <div class="more_details">
          <a href="<?php the_permalink();?>">More Details</a>
          </div>
                  </div>
            </li>
            <?php
        endwhile;
        ?>
            
          </ul>
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
            var country = $("#country").val();
            var tel = $("#tel").val();
            var email = $("#email").val();
            var company = $("#company").val();
            var address = $("#address").val();
            var location = $("#location").val();
            var city = $("#city").val();
            var message = $("#message").val();
            var post_code = $("#post_code").val();
            
            
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
             if (country == "") {
                $("#usercountry").html("Please Select Country Name.");
                $("#country").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (tel == "") {
                $("#usertel").html("Please Enter Phone Number.");
                $("#tel").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (email == "") {
                $("#useremail").html("Please Enter Email Address.");
                $("#email").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
                $("#useremail").html("Invalid Email Address.");
                $("#email").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (company == "") {
                $("#usercompany").html("Please Enter Company Name.");
                $("#company").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (address == "") {
                $("#useraddress").html("Please Enter Address.");
                $("#address").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (location == "") {
                $("#userlocation").html("Please Enter Location.");
                $("#location").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (city == "") {
                $("#usercity").html("Please Enter City Name.");
                $("#city").css('border', '#e66262 1px solid');
                valid = false;
            }
            
            if (post_code == "") {
                $("#userpost_code").html("Please Please Enter Post Code.");
                $("#post_code").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (message == "") {
                $("#usermessage").html("Please Enter Message.");
                $("#message").css('border', '#e66262 1px solid');
                valid = false;
            }
             if (!agree_terms.checked) {
                $("#useragree_terms").html("Please Check Terms & Conditions.");
                $("#agree_terms").css('border', '#e66262 1px solid');
                valid = false;
            }
            return valid;
        }


</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 93,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth:410,
        itemMargin:5,
        pausePlay: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  <script src="<?php bloginfo('template_url');?>/js/jquery.easing.js"></script>
  <script src="<?php bloginfo('template_url');?>/js/jquery.mousewheel.js"></script>
 
<script type="text/javascript">
 $('.scroll_details').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top-200
        }, 2000);
    }
});
</script>