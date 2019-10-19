<?php
/*
 Display Template Name: add Bussiness
*/
 if(!is_user_logged_in()){
  wp_redirect ( home_url("/") );  
 }

global $current_user, $wp_roles;
get_currentuserinfo();
$user = wp_get_current_user();

$userroles = $user->roles['0'];


if(isset($_POST['secondsignlisting']) == "Submit"){

if($userroles == 'broker'){


$author_id = get_current_user_id();
$args777858 = array(
  'author'        =>  $author_id,
  'orderby'       =>  'post_date',
  'order'         =>  'ASC',
  'post_type' => 'buy',
  'posts_per_page' => 1
);
$query = new WP_Query($args777858);
if ( $query->have_posts() ){

 echo ("<script LANGUAGE='JavaScript'>
          window.alert('list allow one list');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties/';
          </script>");

  }else{
    
    // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags( $_POST['titleforthisadd'] ),
    'post_content'  => $_POST['businessdescription'],
    'post_status'   => 'publish',
    'post_type'   => 'buy',
    //'post_author'   => get_current_user_id()
  );
    // Insert the post into the database
  $my_post_id = wp_insert_post( $my_post );
  if($my_post_id) {


          update_post_meta($my_post_id, 'bprice', $_POST['price'] );
          update_post_meta($my_post_id, '_business_annual_turnover', $_POST['annualturnover'] );
          update_post_meta($my_post_id, 'trading_hours', $_POST['tradinghours'] );
         
          update_post_meta($my_post_id, '_business_property_details', $_POST['propertydetails'] );
          update_post_meta($my_post_id, '_business_other_details', $_POST['otherdetail'] );
          update_post_meta($my_post_id, '_business_operation_details', $_POST['operationdeatil'] );
          update_post_meta($my_post_id, '_business_miscellaneous', $_POST['miscellaneous'] );


         
         update_post_meta($my_post_id, 'city', $_POST['city'] );
         update_post_meta($my_post_id, 'street_address', $_POST['streetaddress'] );
         update_post_meta($my_post_id, 'contact_name', $_POST['contactname'] );
         update_post_meta($my_post_id, 'contact_phone', $_POST['contactphone'] );
         update_post_meta($my_post_id, 'contact_email', $_POST['contactemailaddress'] );
         update_post_meta($my_post_id, 'no_of_emp', $_POST['numberofemployees'] );
         update_post_meta($my_post_id, 'year_established', $_POST['yearestablished'] );
        


          $country_id = $_POST['country'];
    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 
     update_post_meta($my_post_id, 'country', $country_name);


    $state_id = $_POST['state'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     update_post_meta($my_post_id, 'state',  $state_name);

       $city_id = $_POST['city'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 
     update_post_meta($my_post_id, 'city', $city_name);


         wp_set_object_terms( $my_post_id, $_POST['features'], 'business-feature', true);
         wp_set_object_terms( $my_post_id, $_POST['businesstype'], 'business-category', true);


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

 
               echo ("<script LANGUAGE='JavaScript'>
          window.alert('listing add Succesfully');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties/';
          </script>");

  }


}else{

  // Create post object
  $my_post = array(
    'post_title'    => wp_strip_all_tags( $_POST['titleforthisadd'] ),
    'post_content'  => $_POST['businessdescription'],
    'post_status'   => 'publish',
    'post_type'   => 'buy',
    //'post_author'   => get_current_user_id()
  );
    // Insert the post into the database
  $my_post_id = wp_insert_post( $my_post );
  if($my_post_id) {


          update_post_meta($my_post_id, 'bprice', $_POST['price'] );
          update_post_meta($my_post_id, '_business_annual_turnover', $_POST['annualturnover'] );
          update_post_meta($my_post_id, 'trading_hours', $_POST['tradinghours'] );
         
          update_post_meta($my_post_id, '_business_property_details', $_POST['propertydetails'] );
          update_post_meta($my_post_id, '_business_other_details', $_POST['otherdetail'] );
          update_post_meta($my_post_id, '_business_operation_details', $_POST['operationdeatil'] );
          update_post_meta($my_post_id, '_business_miscellaneous', $_POST['miscellaneous'] );


         
         update_post_meta($my_post_id, 'city', $_POST['city'] );
         update_post_meta($my_post_id, 'street_address', $_POST['streetaddress'] );
         update_post_meta($my_post_id, 'contact_name', $_POST['contactname'] );
         update_post_meta($my_post_id, 'contact_phone', $_POST['contactphone'] );
         update_post_meta($my_post_id, 'contact_email', $_POST['contactemailaddress'] );
         update_post_meta($my_post_id, 'no_of_emp', $_POST['numberofemployees'] );
         update_post_meta($my_post_id, 'year_established', $_POST['yearestablished'] );
        


          $country_id = $_POST['country'];
    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 
     update_post_meta($my_post_id, 'country', $country_name);


    $state_id = $_POST['state'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     update_post_meta($my_post_id, 'state',  $state_name);

       $city_id = $_POST['city'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 
     update_post_meta($my_post_id, 'city', $city_name);


         wp_set_object_terms( $my_post_id, $_POST['features'], 'business-feature', true);
         wp_set_object_terms( $my_post_id, $_POST['businesstype'], 'business-category', true);


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

 
               echo ("<script LANGUAGE='JavaScript'>
          window.alert('listing add Succesfully');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties/';
          </script>");


}


 

}




/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) )
       wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_attr( $_POST['url'] )));
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['display_name'] ) )
        wp_update_user(array('ID' => $current_user->ID, 'display_name' => esc_attr( $_POST['display_name'] )));
      update_user_meta($current_user->ID, 'display_name' , esc_attr( $_POST['display_name'] ));
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink().'?updated=true' ); exit;
    }       
}


get_header(); // Loads the header.php template. ?>
<section id="content">
<div class="container"> 
<div class="row">
<div class="col-lg-3">
<?php if(current_user_can( 'broker' ) || current_user_can( 'seller' ) ) { ?>
    <div class="list-group ">
              <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action"><?php echo esc_html__('My Account', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/my-properties/" class="list-group-item list-group-item-action"><?php echo esc_html__('My Properties', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/add-bussiness/" class="list-group-item list-group-item-action active"><?php echo esc_html__('Add Business', 'Add Business');?></a>
              <a href="<?php echo site_url();?>/sell-a-franchise/" class="list-group-item list-group-item-action"><?php echo esc_html__('Sell a Franchise', 'Get Business');?></a>
              <!-- <a href="#" class="list-group-item list-group-item-action">
              <?php //echo esc_html__('Messages', 'Get Business');?>
              </a> -->
              <a href="<?php echo site_url();?>/membership/" class="list-group-item list-group-item-action"><?php echo esc_html__('Membership', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-invoices/" class="list-group-item list-group-item-action"><?php echo esc_html__('Invoice', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/view-franchise-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('View Franchise Listing', 'Get Business');?></a>
              <a href="<?php echo get_author_posts_url($current_user->ID); ?>" class="list-group-item list-group-item-action"><?php echo esc_html__('User Profile', 'Get Business');?></a>

              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>

            </div>
            <?php } elseif(current_user_can( 'administrator' )) { ?>
            <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
              
              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>
            <?php } else { ?>
            <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
            <a href="<?php echo site_url();?>/membership/" class="list-group-item list-group-item-action"><?php echo esc_html__('Membership', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-invoices/" class="list-group-item list-group-item-action"><?php echo esc_html__('Invoice', 'Get Business');?></a>
            
            <a href="<?php echo site_url();?>/add-active-buyer-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('Add Buyer Listing', 'Get Business');?></a>
            <a href="<?php echo site_url();?>/view-active-buyer-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('View Buyer Listing', 'Get Business');?></a>
              
              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>
            <?php } ?>
</div>
<div class="col-lg-9">
<div class="profile">
	
<div class="business-info-form"> 
   <div class="sell-business">
  <div class="sell-business-wrapper">
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
        <option value="">Select Business Category</option>
       <?php  $listingtype = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $listingtypeterm = get_terms("business-category", $listingtype);
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

         <div class="from-group  col-md-12">
      <h4>Feature  >> </h4>
        </div>
        <div class="from-group feature col-md-12">
          <div class="row">
             <?php
                      $feature_args = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $feature__terms = get_terms("business-feature", $feature_args);
                      foreach($feature__terms as $feature) {
                        
                        echo '<div class="col-sm-12">';
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
</div>


       
        <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>
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
        <option>1990</option>
        <option>1991</option>
        <option>1992</option>
        <option>1993</option>
        <option>1994</option>
        <option>1995</option>
        <option>1996</option>
        <option>1997</option>
        <option>1998</option>
        <option>1999</option>
        <option>2000</option>
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
        <input type="submit" name="secondsignlisting" value="Submit" class="btn">
        </div>
      </div>
    </form>

</div>

  </div>

    </div>
      </div>


 </div>
 </div>
 </div>
</div>
</section>

<?php
get_footer();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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