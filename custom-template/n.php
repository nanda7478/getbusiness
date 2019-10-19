<?php
  /*
   Display Template Name: n
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




echo $current_date = date('Y-m-d');
$month = 10;
echo $effectiveDate = date('Y-m-d', strtotime("+$month months", strtotime($current_date)));
die();

if(isset($_POST['secondsignlisting']) == "Now, Choose a Plan"){
 
 $_SESSION['secondsignlisting'] = $_POST;


 // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags( $_SESSION['secondsignlisting']['titleforthisadd'] ),
    'post_content'  => $_SESSION['secondsignlisting']['businessdescription'],
    'post_status'   => 'publish',
    'post_type'   => 'buy',
    //'post_author'   => get_current_user_id()
  );
    // Insert the post into the database
  $my_post_id = wp_insert_post( $my_post );
  if($my_post_id) {


          update_post_meta($my_post_id, '_business_price', $_SESSION['secondsignlisting']['price'] );
          update_post_meta($my_post_id, '_business_annual_turnover', $_SESSION['secondsignlisting']['annualturnover'] );
          update_post_meta($my_post_id, 'trading_hours', $_SESSION['secondsignlisting']['tradinghours'] );
         
          update_post_meta($my_post_id, '_business_property_details', $_SESSION['secondsignlisting']['propertydetails'] );
          update_post_meta($my_post_id, '_business_other_details', $_SESSION['secondsignlisting']['otherdetail'] );
          update_post_meta($my_post_id, '_business_operation_details', $_SESSION['secondsignlisting']['operationdeatil'] );
          update_post_meta($my_post_id, '_business_miscellaneous', $_SESSION['secondsignlisting']['miscellaneous'] );


         update_post_meta($my_post_id, '_business_price', $_SESSION['secondsignlisting']['features'] );
         update_post_meta($my_post_id, 'city', $_SESSION['secondsignlisting']['city'] );
         update_post_meta($my_post_id, 'street_address', $_SESSION['secondsignlisting']['streetaddress'] );
         update_post_meta($my_post_id, 'contact_name', $_SESSION['secondsignlisting']['contactname'] );
         update_post_meta($my_post_id, 'contact_phone', $_SESSION['secondsignlisting']['contactphone'] );
         update_post_meta($my_post_id, 'contact_email', $_SESSION['secondsignlisting']['contactemailaddress'] );
         update_post_meta($my_post_id, 'no_of_emp', $_SESSION['secondsignlisting']['numberofemployees'] );
         update_post_meta($my_post_id, 'year_established', $_SESSION['secondsignlisting']['yearestablished'] );
         update_post_meta($my_post_id, 'location', $_SESSION['secondsignlisting']['bussinesslocation'] );

         wp_set_object_terms( $my_post_id, $_SESSION['secondsignlisting']['features'], 'business-feature', true);
         wp_set_object_terms( $my_post_id, $_SESSION['secondsignlisting']['businesstype'], 'business-type', true);


  if($_POST['image_array']) {

      $attachArray = array();
      if($_POST['featured_image']) {
        set_post_thumbnail( $my_post_id, $_POST['featured_image'] );
        $attachArray = array_diff( $_POST['image_array'], array($_POST['featured_image']) );
      } else {
        $attachArray = $_POST['image_array'];
      }
       //$test =  implode(",", $attachArray);
      if( !empty($attachArray) ) {
        update_post_meta($my_post_id, 'uploade_images',$attachArray);

      }
    }

 
  }



}
?>
<div class="container">
 <div class="sell-business">
  <div class="sell-business-wrapper">
  <div class="row"> 
    <div class="col-md-9">
      <div class="basic-info">
        <div class="description">
        <h2>A little basic <span> business info.</span></h2>
        <p>You may keep certain information confidential but keep in mind, the more details you provide the more effective your ad will be. </p>
    </div>
    <div class="business-info-form"> 

    <form  method="post" name="signuplistingsecond">
       <input type="hidden" name="stepcount1" value="2">
      <div class="row">
        <div class="from-group col-md-6">
    <input type="text" name="titleforthisadd" class="from-control"  placeholder="Title for this ad*">
        </div>


         <div class="from-group col-md-6">
    <input type="text" name="price" class="from-control"  placeholder="Price*">
        </div>

         <div class="from-group col-md-6">
    <input type="text" name="annualturnover" class="from-control"  placeholder="Annual Turnover*">
        </div>
       
      <div class="from-group col-md-6">
    <input type="text" name="tradinghours" class="from-control"  placeholder="Trading Hours*">
        </div>

        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select" name="businesstype">
        <option value="">Select Business type</option>
       <?php  $listingtype = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $listingtypeterm = get_terms("business-type", $listingtype);
                      foreach($listingtypeterm as $list) { ?>
        <option value="<?php echo $list->slug; ?>"><?php echo $list->name; ?></option>
      <?php } ?>
       
      </select>
        </div>
        


        <div class="from-group col-md-12">
      <h4>Gallery Images >> </h4>
        </div>
        <div class="from-group col-md-12">
            <div class="row" id="images-div"></div>
            <input type="file" id="property_images" name="property_images">
            Please uploade one by one

            <div id='loadingmessage' style='display:none'>
  images loading..
</div>
        </div>


            <div class="from-group col-md-12">
      <h4>Business Description  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="businessdescription" placeholder="Business Description..."></textarea>
        </div>

        <div class="from-group col-md-12">
      <h4>Property Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="propertydetails" placeholder="Property Details..."></textarea>
        </div>

        <div class="from-group col-md-12">
      <h4>Other Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="otherdetail" placeholder="Other Details..."></textarea>
        </div>


        <div class="from-group col-md-12">
      <h4>Operation Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="operationdeatil" placeholder="Operation Details..."></textarea>
        </div>

          <div class="from-group col-md-12">
      <h4>Miscellaneous  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="miscellaneous" placeholder="Miscellaneous..."></textarea>
        </div>

         <div class="from-group col-md-12">
      <h4>Feature  >> </h4>
        </div>
        <div class="from-group col-md-12">
             <?php
                      $feature_args = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $feature__terms = get_terms("business-feature", $feature_args);
                      foreach($feature__terms as $feature) {
                        
                        echo '<div class="col-sm-4">';
                          echo '<div class="checkbox">';
                            echo '<label class="input-checkbox">';
                            echo '<input type="checkbox" name="features[]" value="'.$feature->slug.'"> '.$feature->name;
                            echo '<span class="checkmark"></span>';
                            echo '</label>';
                          echo '</div>';
                        echo '</div>';
                      }
                    ?>
        </div>



       
        <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
   

      <select class="from-control select" name="bussinesslocation">
    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antartica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
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
    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
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
    <option value="Congo">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
    <option value="Croatia">Croatia (Hrvatska)</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
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
    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="France Metropolitan">France, Metropolitan</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories">French Southern Territories</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
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
    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
    <option value="Holy See">Holy See (Vatican City State)</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran (Islamic Republic of)</option>
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
    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
    <option value="Korea">Korea, Republic of</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao">Lao People's Democratic Republic</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon" selected>Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia, Federated States of</option>
    <option value="Moldova">Moldova, Republic of</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
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
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn">Pitcairn</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russian Federation</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA">Saint LUCIA</option>
    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia (Slovak Republic)</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
    <option value="Span">Spain</option>
    <option value="SriLanka">Sri Lanka</option>
    <option value="St. Helena">St. Helena</option>
    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syrian Arab Republic</option>
    <option value="Taiwan">Taiwan, Province of China</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania, United Republic of</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Viet Nam</option>
    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Yugoslavia">Yugoslavia</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
</select>





        </div>
         <div class="from-group col-md-6">
      <input type="text" name="city" class="from-control" placeholder="Enter City*">
        </div>

          <div class="from-group col-md-12">
      <input type="text" name="streetaddress" class="from-control" placeholder="Street Address*">
        </div>
     <!-- <div class="from-group col-md-12">
          <ul class="label_list">
    <li>  <h4>  ? Make Confidential:</h4></li>

   <li>
      <label class="input-checkbox"> <input type="checkbox" name=""> State  <span class="checkmark"></span></label</li>
<li>  <label class="input-checkbox"> <input type="checkbox" name=""> Country  <span class="checkmark"></span></label>
</li>
<li><label class="input-checkbox"> <input type="checkbox" name=""> City  <span class="checkmark"></span></label>
</li>

<li><label class="input-checkbox"> <input type="checkbox" name=""> Address  <span class="checkmark"></span></label>
</li></ul>
</div> -->
          <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>

<div class="from-group col-md-6">
    <input type="text" name="contactname" class="from-control" placeholder="Contact Name*">
        </div>
        <div class="from-group col-md-6">
    <input type="text" name="contactphone" class="from-control" placeholder="Contact Phone*">
        </div>
        <div class="from-group col-md-12">
    <input type="text" name="contactemailaddress" class="from-control" placeholder="Contact Email Address*">
        </div>
      <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>
<!-- <div class="from-group col-md-6 select_box">
  <span class="select_border"></span>
      <select class="from-control select">
        <option>Best Matching Category</option>
        <option>Business Country 1</option>
        <option>Business Country 2</option>
        <option>Business Country 3</option>
        <option>Business Country 4</option>
        <option>Business Country 5</option>
        <option>Business Country 6</option>
        <option>Business Country 7</option>
        <option>Business Country 8</option>
      </select>
        </div>
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select">
        <option>Other Matching Category</option>
        <option>Category 1</option>
        <option>Category 2</option>
        <option>Category 3</option>
        <option>Category 4</option>
        <option>Category 5</option>
        <option>Category 6</option>
        <option>Category 7</option>
        <option>Category 8</option>
      </select>
        </div> -->
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select" name="numberofemployees">
        <option>Number Of Employees</option>
        <option value="1">Employees 1</option>
        <option value="2">Employees 2</option>
        <option value="3">Employees 3</option>
        <option value="4">Employees 4</option>
        <option value="5">Employees 5</option>
        <option value="6">Employees 6</option>
        <option value="7">Employees 7</option>
        <option value="8">Employees 8</option>
      </select>
        </div>
        <div class="from-group col-md-6 select_box">
       <span class="select_border"></span>
      <select class="from-control select" name="yearestablished">
        <option>Year Established</option>
        <option>Year 1</option>
        <option>Year 2</option>
        <option>Year 3</option>
        <option>Year 4</option>
        <option>Year 5</option>
        <option>Year 6</option>
        <option>Year 7</option>
        <option>Year 8</option>
      </select>
        </div>

<!-- <div class="from-group col-md-12 web-link">
  <span>https:// </span>
  <input type="text" name="" class="from-control" placeholder="Bussiness Website*">
</div>
<div class="from-group col-md-12">
    <label class="input-checkbox"> <input type="checkbox" name=""> Keep Website Confidential <span class="checkmark"></span></label>
    </div> -->
<!-- <div class="from-group col-md-12">
  <ul class="label_list"><li>
      <h4> ?  Business is:</h4></li>

     <li> <label class="input-checkbox"> <input type="checkbox" name=""> Relocatable    
        <span class="checkmark"></span></label></li>

    <li> <label class="input-checkbox"> <input type="checkbox" name=""> Home-based  
        <span class="checkmark"></span></label></li>

    <li>  <label class="input-checkbox"> <input type="checkbox" name=""> Established Franchise  
        <span class="checkmark"></span></label></li>
      </ul>
        </div> -->
         <input type="hidden" name="countstep" value="3">
          <div class="from-group col-md-6">
        <input type="submit" name="secondsignlisting" value="Now, Choose a Plan" class="btn">
        </div>
      </div>
    </form>

    </div>
  </div>
  </div>

<div class="col-md-3">
  <div class="question_box">
  <h4>Have Qusestiomns? We can Help. </h4>
  <h3>Call <span> Toll</span> -Free </h3>
  <span class="icon_box"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/call_icon.png"> </span>
  <h2>(123-456-789)</h2>
  </div>
</div>
</div>
</div>
</div>
</div>

<?php
  get_footer();
  ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ajaxupload.3.5.js"></script>
<script>
 var btnUpload = jQuery('#property_images');

    new AjaxUpload(btnUpload, {
      action: '<?php echo get_bloginfo('stylesheet_directory'); ?>/upload-images.php',
      name: 'uploadfile',
      onSubmit: function(file, ext){
          $('#loadingmessage').show();
        if( ! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)) ){
          // extension is not allowed
          alert('Only jpg, png or gif files are allowed');
          return false;
        }
      },
      onComplete: function(file, response){
        
        //Add uploaded file to list
        if(response == 'error') {
          alert('Problem with Image.');
        } else {
          jQuery("#images-div").append(response);
          $('#loadingmessage').hide();
        }
      }
    });
    jQuery('#images-div').on("click", ".deleteimg", function() {
    var dataid = jQuery(this).attr("data-id");
    jQuery('#' + dataid).remove();
  });
</script>