<?php
   /**
    * The template for displaying all single posts and attachments
    *
    * @package WordPress
    * @subpackage Twenty_Sixteen
    * @since Twenty Sixteen 1.0
    */
   
   
   global $post, $current_user;
   $author_email = get_the_author_meta('user_email', $post->post_author);
   $current_user_email = $current_user->user_email;
   if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $country_name = $_POST['country_name'];
            $tel = $_POST['tel'];
            $text = $_POST['text-msg'];
            $target_title = $_POST['target_title'];
            $target_url =$_POST['target_url'];
            
            $message = "<html><body>
                        First Name : $first_name<br>
                        Last Name : $last_name<br>
                        Email : $email<br>
                        Country Name : $country_name<br>
                        Phone Number : $tel<br> 
                        Post Title : $target_title<br>
                        Post URL : $target_url<br>
                        Message : $text<br>
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


    get_header(); ?>
<section class="bradcrumbs_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <a href="<?php echo site_url();?>">Home</a> /<a href="<?php echo site_url();?>/active-buyers/">Active Buyer Listings</a> / <span><?php the_title();?></span>
         </div>
      </div>
   </div>
</section>
<?php
   if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        // Set variables
               $author_id = get_the_author_meta('ID');
               $image = get_field('profile_image', 'user_'. $author_id );
   
                   $author_facebook = get_the_author_meta( 'facebookurl', $author_id );
                   $author_twitter  = get_the_author_meta( 'twitterhandle', $author_id  );
                   $author_linkedin = get_the_author_meta( 'linkedinurl', $author_id );
                   $author_instagram  = get_the_author_meta( 'instagramurl', $author_id  );
                ?>
<section class="active-buyer-sec">
   <div class="container">
      <div class="details_sec">
         <div class="buyer_row">
            <div class="title"><?php the_title();?></div>
            <div class="buyer_social">
               <ul>
                  <li><a href="<?php echo $author_facebook; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="<?php echo $author_twitter; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="<?php echo $author_instagram; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="<?php echo $author_linkedin; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
               </ul>
            </div>
         </div>
         <div class="buyer_img"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
         <ul class="buyer-details">
            <li>
               <div class="icon"><i class="fas fa-map-marker-alt"></i> </div>
               <div class="content">
                  <h5> Desired location</h5>
                  <span><?php echo get_field('location');?>,<?php echo get_field('country');?></span> 
               </div>
            </li>
            <li>
               <div class="icon"><i class="fas fa-file-invoice-dollar"></i> </div>
               <div class="content">
                  <h5> Investment</h5>
                  <span>$<?php echo get_field('investment_from');?> - $<?php echo get_field('investment_to');?></span>
               </div>
            </li>
            <li>
               <div class="icon"><i class="fas fa-home"></i> </div>
               <div class="content">
                  <h5> Industry</h5>
                  <span><?php
                     $terms = wp_get_post_terms( $post->ID, 'buyer-category');
                     foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        echo '<a href="' . $term_link . '">' . $term->name . '</a>' . ' ';
                        }
                     ?></span> 
               </div>
            </li>
         </ul>
         <div class="description">
            <h4> My Requirement</h4>
            <?php the_content();?>
         </div>
      </div>
   </div>
</section>
<?php
   endwhile;
   ?>
<?php
   wp_reset_postdata();
   endif;
   ?>
<section class="active_buyer_contact">
   <div class="container">
      <?php if(isset($success)){ ?>
      <div class="active_buyer_message">
         <h4><?php echo $success; ?></h4>
      <?php } ?>
      </div>
      <div class="buyer_contact_form">
         <h2>Contact <span><?php the_author_meta('user_nicename' , $author_id ); ?> </span> </h2>
         <form name="frmContact" action="" method="post" onsubmit="return validateContactForm()">
            
            <div class="row">
               <div class="from-group col-md-6">
                  <input id="firstname" type="text" class="form-control input-field" placeholder="First name*" name="first_name">
                  <span id="userfirstname" class="info"></span>
               </div>
               <div class="from-group col-md-6">
                  <input id="lastname" type="text" class="form-control input-field" placeholder="Last Name*" name="last_name">
                  <span id="userlastname" class="info"></span>
               </div>
               <div class="from-group col-md-6">
                  <select id="contry" class="form-control input-field" name="country_name">
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
               <div class="from-group col-md-6">
                  <input id="phonenumber" type="text" class="form-control input-field" placeholder="Phone Number*" name="tel" value="<?php echo $phone; ?>">
                  <span id="userphonenumber" class="info"></span>
               </div>
               <div class="from-group col-md-12">
                  <input id="email" type="email" class="form-control input-field" id="inputEmail4" placeholder="Email Address*" name="email">
                  <span id="useremail" class="info"></span>
               </div>
               <div class="from-group col-md-12">
                  
                  <textarea class="form-control" id="text-msg" rows="4" name="text-msg" placeholder="Please send me more information about this Active Buyer."></textarea>
                  <span id="textmessages" class="info"></span>
               </div>
               <div class="col-md-12">
                  <label class="input-checkbox">  
                  <input name="rememberme" value="checkbox" type="checkbox" checked="">
                  Yes I wish to receive the monthly newsletter and other emails directly from Getabusiness
                  <span class="checkmark"></span></label>
               </div>
               <div class="col-md-12">
                  <label class="input-checkbox">  
                  <input name="agree_terms" value="checkbox" type="checkbox">
                  I have read and agree with the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank">Terms &amp; Conditions</a> &amp; <a href="<?php echo site_url();?>/privacy-policy/" target="_blank">Privacy</a> 
                  <span class="checkmark"></span></label>
               </div>
               <div class="from-group btn-sec col-md-12">
                  <input class="btn" type="submit" name="submit" value="Send Message"> <span></span>
                  <input type="hidden" class="form-control" name="target_id" value="<?php $post_id = get_the_ID();
                     echo $post_id;
                     ?>">
                  <input type="hidden" class="form-control" name="target_title" value=" <?php the_title();?>">
                  <input type="hidden" class="form-control" name="target_email" value="<?php echo $author_email;?>">
                  <input type="hidden" class="form-control" name="target_url" value="<?php echo get_permalink( $post->ID ); ?>">
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
<?php get_footer(); ?>
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
      agree_terms: "required",
    },
    messages: {
      first_name: "Please enter your First Name",
      last_name: "Please enter your Last Name",
      country_name: "Please Select Country Name",
      email: "Please enter a valid Email Address",
      tel: "Please enter Phone Number",
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
