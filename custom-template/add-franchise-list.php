<?php
 /*
 * Display Template Name: Franchise List
 */

$pack_valie = $_SERVER['REQUEST_URI']; 
  $price=$_GET['price'];

if (is_user_logged_in() ) {

}
else{
 wp_redirect ( home_url("/seller-register") );  
}

get_header();
?>
<div class="container">
   <div class="content">
   <?php $user_id = get_current_user_id(); ?>
   <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "franchise") { ?>
      <?php
         if(isset($_POST['submit'])){
          $title=$_POST['title'];
         $body=$_POST['body'];
         $franchise_category=$_POST['franchise-category'];
         $require_content = $_POST['require_content'];


        $country_id = $_POST['country'];
        $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
        $sqlquery  = $wpdb->get_results($sqlcountry);
        $country =   $sqlquery['0']->country_name; 

        $state_id = $_POST['state'];
        $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
        $sqlstate7  = $wpdb->get_results($sqlstate);
        $state =   $sqlstate7['0']->state_name; 

        $city_id = $_POST['city'];
        $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
        $sqlcityy7  = $wpdb->get_results($sqlcity);
        $city =   $sqlcityy7['0']->city_name; 


         $location = $_POST['location'];
         $investment_from = $_POST['investment_from'];
         $investment_to = $_POST['investment_to'];
         $support = $_POST['support'];
         $availability = $_POST['availability'];
         $minimum_investment = $_POST['minimum_investment'];
         
         
         // Create post object
         $post = array(
         'post_title'    => $title,
         'post_content'  => $body,
         'post_type'     =>'franchise',
         'post_status'   => 'publish',
         'post_author'   => $user_id,
         );
         
         // Insert the post into the database ref.https://codex.wordpress.org/Function_Reference/wp_insert_post
         $post_id = wp_insert_post( $post, $wp_error='' );
         if($post_id!=0){
         
         ///upload image ref. https://codex.wordpress.org/Function_Reference/add_post_meta
         
         
         ///ref. https://codex.wordpress.org/Function_Reference/wp_handle_upload
         
         $uploaddir = wp_upload_dir();
         $file = $_FILES["image"]["name"];
         $uploadfile = $uploaddir['path'] . '/' . basename( $file );
         
         move_uploaded_file( $_FILES["image"]["tmp_name"] , $uploadfile );
         $filename = basename( $uploadfile );
         
         $wp_filetype = wp_check_filetype(basename($filename), null );
         
         $attachment = array(
          'post_mime_type' => $wp_filetype['type'],
          'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
          'post_content' => '',
          'post_status' => 'inherit',
          'menu_order' => $_i + 1000
         );
         $attach_id = wp_insert_attachment( $attachment, $uploadfile );
         set_post_thumbnail( $post_id, $attach_id ); 
         
         ///////////////////////////////////////////////////////////
         
         
         add_post_meta($post_id, 'require_content', $require_content);
         
         add_post_meta($post_id, 'country', $country);
         add_post_meta($post_id, 'state', $state);
         add_post_meta($post_id, 'city', $city);

         add_post_meta($post_id, 'location', $location);
         add_post_meta($post_id, 'investment_from', $investment_from);
         add_post_meta($post_id, 'investment_to', $investment_to);
         add_post_meta($post_id, 'support', $support);
         add_post_meta($post_id, 'availability', $availability);
         add_post_meta($post_id, 'minimum_investment', $minimum_investment);
         
         //insert taxonomy terms
         //ref. https://codex.wordpress.org/Function_Reference/wp_set_object_terms
         
         ////for taxonomy 'news-category'//////////////////////////////
         $cat_ids = array($franchise_category);
         
         $cat_ids = array_map( 'intval', $cat_ids );
         $cat_ids = array_unique( $cat_ids );
         
         $term_taxonomy_ids = wp_set_object_terms($post_id, $cat_ids, 'franchise-category' );
         
         /////////////End for taxonomy 'news-category'//////////////////////////////
         
         $success =  "New Franchise successfully added";
         }  
         
         
         }
         
         }
         ?>
      <h1>Add New Franchise</h1>
     <?php if(!is_user_logged_in()) {

               echo '<div class="must-be-logged-in">';
               echo '<h4 class="center marB20">' . __('You must be logged in to view this page.', 'contempo') . '</h4>';
                    echo '<p class="center login-register-btn marB0"><a class="btn login-register" href="'.site_url().'/seller-register/">Login/Register</a></p>';
                echo '</div>';
                
            }  elseif(in_array('broker', (array) $current_user->roles) || in_array('seller', (array) $current_user->roles) ) { 

                $item_count = $wpdb->get_var( "SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'franchise' AND post_author = $userdata->ID" );
                $events = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."posts WHERE post_author = $userdata->ID AND post_type = 'package_order' order by id" );
               
               foreach($events as $data){    
                  $post_id = $data->ID;
                }   
                
                $listing_included = 0;

                if(!empty($post_id)){   
                   $post_meta_id = get_post_meta($post_id,'packageID',true);
                   $post_data = get_post($post_meta_id);
                   $package_id = $post_data->ID;
                   $listing_included = get_post_meta($package_id,'listing',true);
                }     
         

         if(function_exists('ct_create_packages') && $item_count == 0 && empty($post_id)) {

                  echo '<div class="col span_12 first packages-notification-large">';
                       echo '<h4 class="marB20">' . __( 'You haven\'t chosen a package yet…', 'contempo' ) . '</h4>';
                       echo '<p class="marB0"><a class="btn" href="'.site_url().'/package-list">' . __('Get Started!', 'contempo') . '</a></p>';
                   echo '</div>';

               } elseif(function_exists('ct_create_packages') && $item_count >= $listing_included) {
                  
                  echo '<div class="col span_12 first packages-notification-large">';
                       echo '<h4 class="marB5">' . __( 'Listings Limit Reached', 'contempo' ) . '</h4>';
                       echo '<p class="marB20">' . __('You\'ve reached the listings limit for your membership package.', 'contempo') . '</p>';
                       echo '<p class="marB0"><a class="btn" href="'.site_url().'/package-list/?package=update">' . __('Upgrade Today!', 'contempo') . '</a></p>';
                   echo '</div>';
                
                } else { ?>


       <form name="frmContact" action="" method="post" enctype="multipart/form-data" onsubmit="return validateContactForm()">
        <div class="row">
            <div class="from-group col-md-6">
           <input id="title" type="text"  class="from-control input-field" placeholder="Title*" name="title" />
           <span id="usertitle" class="info"></span>
            </div>

          <div class="from-group col-md-6">
               <!-- <span>Featured Image </span> -->
               <input type="file"  name="image"  class="from-control input-field" placeholder="Featured Image" />
            </div>
            <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="body" name="body" placeholder="Content" ></textarea>
          <span id="userbody" class="info"></span>
            </div>

          <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="require_content" placeholder="Extra Details*" name="require_content"></textarea>
          <span id="userrequire_content" class="info"></span>
            </div>
            <div class="from-group col-md-6 select_box">
<span class="select_border"></span>
                  <?php
                     //ref. https://codex.wordpress.org/Function_Reference/get_terms
                      $terms = get_terms("franchise-category",'order_by=count&hide_empty=0');
                     if ( !empty( $terms ) && !is_wp_error( $terms ) ){
                         echo "<select name='franchise-category' class='from-control'>";
                         echo "<option selected='selected'> Franchise-Category </option>";
                     
                         foreach ( $terms as $term ) {
                           echo "<option value='".$term->term_id."'>" . $term->name . "</option>";
                            
                         }
                         echo "</select>";
                     }
                     ?>
            </div>
    <!-- <div class="from-group col-md-6 select_box">
        <span class="select_border"></span>
                      <select id="country11" class="form-control input-field" name="country11">
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
                     <option value="Cocos Islands">Cocos (Keeling) Islands</option>
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
                     <option value="Former Yugoslav Republic of Macedonia">Former Yugoslav Republic of Macedonia</option>
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
                     <option value="New Zealan">New Zealand</option>
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
                     <option value="Pitcairn Island">Pitcairn Islands</option>
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


      </div> -->



      


      <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
   


       <?php
          global $wpdb;
      $sqlquery = $wpdb->get_results("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");
          
        ?>
     <select name="country" id="country" class="from-control select" required>
        <option value="">Select Country</option>
       <?php
       foreach ($sqlquery as  $value) {
        ?>
        <option value="<?php echo $value->country_id; ?>"><?php echo $value->country_name; ?></option>
        <?php
       }
       ?>
    </select>


        </div>
         <div class="from-group col-md-6"> 
    <select name="state" id="state" class="from-control select" required>
    <option value="">Select State</option>
    </select>
   </div>
   <div class="from-group col-md-6"> 
      <select name="city" id="city" class="form-control select" required>
      <option value="">Select City</option>
      </select>
      </div>


          <!-- <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
          <input id="location" type="text" class="from-control input-field" placeholder="Location*" name="location" />
           <span id="userlocation" class="info"></span>
            </div> -->
            <div class="from-group col-md-6 select_box">
                <span class="select_border"></span>
                <input id="investment_from" type="text" class="from-control input-field" placeholder="Investment Range From*" name="investment_from" />
                 <span id="userinvestment_from" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <input id="investment_to" type="text" class="from-control input-field" placeholder="Investment Range To*" name="investment_to"/>
            <span id="userinvestment_to" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <input id="support" type="text" class="from-control input-field" placeholder="Support & Training" name="support"/>
            <span id="usersupport" class="info"></span>
            </div>
            <div class="from-group col-md-6">
              <input id="availability" type="text" placeholder="Availability" class="from-control input-field" name="availability"/>
              <span id="useravailability" class="info"></span>
            </div>
            <div class="from-group col-md-6">
              <input id="minimum_investment" type="text" placeholder="Minimum Investment" class="from-control input-field" name="minimum_investment"/>
              <span id="userminimum_investment" class="info"></span>
            </div>
            <div class="from-group col-md-6">
               <!-- <span style="background: #ffa733; color: #fff; text-align: center; font-weight: bold;"> <?php echo $price; ?>
               </span> -->
             </div>
            <div class="from-group col-md-12 submit_btn">
<input class="btn" type="submit" name="submit"  value="Submit"/>
<input type="hidden" name="action" value="franchise" />
            </div>

        
   </div>
 </form>
 <?php 
 } 
}
 ?>
 <p style="padding:10px 0px 20px 0px;color:#ed6900"><?php if(isset($success)){echo $success;}?></p>
</div>


<?php get_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
 function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".input-field").css('border', '#e0dfdf 1px solid');
            var Title = $("#title").val();
            var Content = $("#body").val();
            var Extra_Details = $("#require_content").val();
            var Country = $("#country").val();
            var Location = $("#location").val();
            var Investment_Range_From = $("#investment_from").val();
            var Investment_Range_To = $("#investment_to").val();
            var Support_And_Training = $("#support").val();
            var Availability = $("#availability").val();
           
            
            
            if (Title == "") {
                $("#usertitle").html("Please Enter Title.");
                $("#title").css('border', '#e66262 1px solid');
                valid = false;
            }
              if (Content == "") {
                $("#userbody").html("Please Enter Content.");
                $("#body").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (Extra_Details == "") {
                $("#userrequire_content").html("Please Enter Require Content.");
                $("#require_content").css('border', '#e66262 1px solid');
                valid = false;
            }
             if (Country == "") {
                $("#usercountry").html("Please Select Country Name.");
                $("#country").css('border', '#e66262 1px solid');
                valid = false;
            }
            
            if (Location == "") {
                $("#userlocation").html("Please Enter Location.");
                $("#location").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (Investment_Range_From == "") {
                $("#userinvestment_from").html("Please Enter Invest Value.");
                $("#investment_from").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (Investment_Range_To == "") {
                $("#userinvestment_to").html("Please Enter Investment To.");
                $("#investment_to").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (Support_And_Training == "") {
                $("#usersupport").html("Please Select Support.");
                $("#support").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (Availability == "") {
                $("#useravailability").html("Please Select Availability.");
                $("#availability").css('border', '#e66262 1px solid');
                valid = false;
            }
            
            return valid;
        }


</script>
<script type="text/javascript">
jQuery(document).ready(function(){

        jQuery('#country').on('change',function(){

          var countryID = $(this).val();
          
           jQuery.ajax({
            type:'post',
            url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                      data: 'country_id='+countryID,
            success:function(html) 
            {

                          jQuery('#state').html(html);
                      jQuery('#city').html('<option value="">Select state first</option>'); 
            }
        });

      });



    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });


});
</script>