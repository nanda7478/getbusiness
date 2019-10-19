<?php
/*
 Display Template Name: My properties
*/
 session_start();
 if(!is_user_logged_in()){
  wp_redirect ( home_url("/") );  
 }

if($_SESSION['packagelisting']['countstep']){
}else{
 $_SESSION['friststep'] = 1; 
}
if ( ! function_exists( 'wp_handle_upload' ) ) {
  require_once ( ABSPATH . 'wp-admin/includes/file.php' );
}
// Include image.php
require_once(ABSPATH . 'wp-admin/includes/image.php');


$editbussiness  = $_GET['editbussiness'];
$propertyData = get_post( intval($editbussiness) );

global $current_user, $wp_roles;
get_currentuserinfo();

 $user_id111 = $current_user->ID;



if(isset($_POST['fristpakage']) == "Select Showcase Ad"){

unset($_SESSION['friststep']);
$_SESSION['packagelisting'] = $_POST; 
 
}

if(isset($_POST['secondpakagepakage']) == "Select Basic Ad"){

 unset($_SESSION['friststep']);
 $_SESSION['packagelisting'] = $_POST; 
 
}


if( isset($_POST['secondsignlisting']) && $_POST['secondsignlisting'] == "Submit" ) {

    $my_post = array(
        'ID' => $propertyData->ID,
        'post_title'    => wp_strip_all_tags( $_POST['titleforthisadd'] ),
        'post_content'  => $_POST['businessdescription'],
        'post_status'   => 'publish',
        'post_type'   => 'buy',
        'post_author'   => $user_id111
      );
      $my_post_id = wp_update_post( $my_post );



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
   
    echo ("<script LANGUAGE='JavaScript'>
          window.alert('bussiness updated successfully.');
          window.location.href='http://demosrvr.com/wp/getabusiness/my-properties';
          </script>");
}



}


/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    


get_header(); // Loads the header.php template. ?>
<section id="content" class="view_active_buyer_section">
<div class="container"> 
<div class="row">
<div class="col-lg-3">
<?php if(current_user_can( 'broker' ) || current_user_can( 'seller' ) ) { ?>
    <div class="list-group ">
              <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action"><?php echo esc_html__('My Account', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/my-properties/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Properties', 'Get Business');?></a>

              <a href="<?php echo site_url();?>/add-bussiness/" class="list-group-item list-group-item-action"><?php echo esc_html__('Add Business', 'Add Business');?></a>

              <a href="<?php echo site_url();?>/sell-a-franchise/" class="list-group-item list-group-item-action"><?php echo esc_html__('Sell a Franchise', 'Get Business');?></a>
             <!--  <a href="#" class="list-group-item list-group-item-action">
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

        <?php

        $args = array(
        'post_type'         => 'package_order',
        'author__in'        => $user_id111,
        'posts_per_page'    => -1,
        );
        $wp_query = new wp_query($args);
        if ($wp_query->have_posts()){
              while($wp_query->have_posts() ) : $wp_query->the_post();

              $package_name = get_post_meta($post->ID, 'package_name', true);

              if($package_name == 'Showcase Ad' OR $package_name == 'Basic Ad')
              {
                    $today = strtotime(date("Y-m-d"));
                    $package_expire_date = strtotime(get_post_meta($post->ID, 'package_expire_date', true));
                    if($today <= $package_expire_date){


                               if($editbussiness){
                                ?>

                                    <form  method="post" name="signuplistingsecond">
                                    <input type="hidden" name="stepcount1" value="2">
                                    <div class="row">
                                    <div class="from-group col-md-6">
                                    <input type="text" name="titleforthisadd" class="from-control"  placeholder="Title for this ad*" value="<?php echo get_the_title( $propertyData->ID ); ?>" required>
                                    </div>


                                    <div class="from-group col-md-6">
                                    <input type="text" name="price" class="from-control"  placeholder="Price*"  value="<?php echo get_field('bprice',$propertyData->ID); ?>" required>
                                    </div>

                                    <div class="from-group col-md-6">
                                    <input type="text" name="annualturnover" class="from-control" value="<?php echo get_field('_business_annual_turnover',$propertyData->ID); ?>  "  placeholder="Annual Turnover*" required>
                                    </div>

                                    <div class="from-group col-md-6">
                                    <input type="text" name="tradinghours" class="from-control" value="<?php echo get_field('trading_hours',$propertyData->ID); ?>"  placeholder="Trading Hours*" required>
                                    </div>

                                    <div class="from-group col-md-6 select_box">
                                    <span class="select_border"></span>
                                    <select class="from-control select" name="businesstype" required>

                                    <?php  $propertyaction = wp_get_post_terms( $propertyData->ID, "business-category" );
                                    $propertyaction[0]->slug;   

                                    ?>
                                    <option value="">Select Business type</option>
                                    <?php  $listingtype = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                                    $listingtypeterm = get_terms("business-category", $listingtype);
                                    foreach($listingtypeterm as $list) { ?>
                                    <option value="<?php echo $list->slug; ?>" <?php if($propertyaction[0]->slug == $list->slug){ echo 'selected="selected"'; } ?>><?php echo $list->name; ?></option>
                                    <?php } ?>

                                    </select>
                                    </div>



                                    <div class="from-group col-md-12">
                                    <h4>Gallery Images >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">

                                    <div class="row" id="images-div">

                                    <?php if(get_post_thumbnail_id( $propertyData->ID )) { ?>
                                    <?php $thumbnailid = get_post_thumbnail_id( $propertyData->ID ); ?>
                                    <?php $thumbnaildata = wp_get_attachment_image_src($thumbnailid, 'thumbnail' ); ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4" id="<?php echo $thumbnailid; ?>">
                                    <a href="javascript:void(0)" class="thumbnail">
                                    <img class="img-thumbnail img-responsive" src="<?php echo $thumbnaildata[0]; ?>">
                                    <label class="radio text-center">
                                    <input type="radio" value="<?php echo $thumbnailid; ?>" checked="checked" name="featured_image">Featured
                                    </label>
                                    <input type="hidden" value="<?php echo $thumbnailid; ?>" name="image_array[]">
                                    </a>
                                    <i class="fa fa-times-circle fa-2x deleteimg" data-id="<?php echo $thumbnailid; ?>" aria-hidden="true"></i>
                                    </div>
                                    <?php } ?>

                                    <?php
                                    if(get_post_meta($propertyData->ID, 'uploade_images', true)) {
                                    $image_gallery = get_post_meta($propertyData->ID, 'uploade_images', true);
                                    //  $easy_image_gallery = explode(",", $image_gallery);

                                    foreach($image_gallery as $gallery) {

                                    $gallerydata = wp_get_attachment_image_src($gallery, 'thumbnail' );
                                    echo '<div class="col-lg-4 col-md-4 col-sm-4" id="'.$gallery.'">';
                                    echo '<a href="javascript:void(0)" class="thumbnail">';
                                    echo '<img class="img-thumbnail img-responsive" src="'.$gallerydata[0].'">';
                                    echo '<label class="radio text-center">';
                                    echo '<input type="radio" value="'.$gallery.'" name="featured_image">Featured';
                                    echo '</label>';
                                    echo '<input type="hidden" value="'.$gallery.'" name="image_array[]">';
                                    echo '</a>';
                                    echo '<i class="fa fa-times-circle fa-2x deleteimg" data-id="'.$gallery.'" aria-hidden="true"></i>';
                                    echo '</div>';
                                    }
                                    }
                                    ?>
                                    </div>
                                    <input type="file" id="property_images" name="property_images">



                                    </div>


                                    <div class="from-group col-md-12">
                                    <h4>Business Description  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <textarea class="from-control" name="businessdescription"  placeholder="Business Description..." required><?php echo $propertyData->post_content ?>
                                    </textarea>
                                    </div>

                                    <div class="from-group col-md-12">
                                    <h4>Property Details  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <textarea class="from-control" name="propertydetails" placeholder="Property Details..." required><?php echo get_field('_business_property_details',$propertyData->ID); ?></textarea>
                                    </div>

                                    <div class="from-group col-md-12">
                                    <h4>Other Details  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <textarea class="from-control" name="otherdetail"  placeholder="Other Details..." required><?php echo get_field('_business_other_details',$propertyData->ID); ?></textarea>
                                    </div>


                                    <div class="from-group col-md-12">
                                    <h4>Operation Details  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <textarea class="from-control" name="operationdeatil"  placeholder="Operation Details..." required><?php echo get_field('_business_Operation_details',$propertyData->ID); ?>
                                    </textarea>
                                    </div>

                                    <div class="from-group col-md-12">
                                    <h4>Miscellaneous  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <textarea class="from-control" name="miscellaneous"  placeholder="Miscellaneous..." required><?php echo get_field('_business_miscellaneous',$propertyData->ID); ?>
                                    </textarea>
                                    </div>

                                    <div class="from-group col-md-12">
                                    <h4>Feature  >> </h4>
                                    </div>
                                    <div class="from-group col-md-12">



                                    <?php
                                    $selected_features = array();
                                    $propertyfeature = wp_get_post_terms( $propertyData->ID, "business-feature" );
                                    foreach($propertyfeature as $features) {
                                    array_push($selected_features, $features->term_id);
                                    }

                                    $feature_args = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                                    $feature__terms = get_terms("business-feature", $feature_args);
                                    foreach($feature__terms as $feature) {

                                    echo '<div class="col-sm-4">';
                                    echo '<div class="checkbox">';
                                    echo '<label class="input-checkbox">';
                                    if (in_array($feature->term_id, $selected_features)) {
                                    echo '<input type="checkbox" checked="checked" name="features[]" value="'.$feature->slug.'"> '.$feature->name;
                                    } else {
                                    echo '<input type="checkbox" name="features[]" value="'.$feature->slug.'"> '.$feature->name;
                                    }
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
                                    <input type="text" name="streetaddress" value="<?php echo get_field('street_address',$propertyData->ID); ?>" class="from-control" placeholder="Street Address*" required>
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
                                    <input type="text" name="contactname" class="from-control" value="<?php echo get_field('contact_name',$propertyData->ID); ?>" placeholder="Contact Name*" required>
                                    </div>
                                    <div class="from-group col-md-6">
                                    <input type="text" name="contactphone" class="from-control" value="<?php echo get_field('contact_phone',$propertyData->ID); ?>" placeholder="Contact Phone*" required>
                                    </div>
                                    <div class="from-group col-md-12">
                                    <input type="text" name="contactemailaddress" value="<?php echo get_field('contact_email',$propertyData->ID); ?>" class="from-control" placeholder="Contact Email Address*" required>
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
                                    <select class="from-control select" name="numberofemployees" required>
                                    <?php $no_of_emp = get_field('no_of_emp',$propertyData->ID); ?>
                                    <option>Number Of Employees</option>
                                    <option value="1" <?php if($no_of_emp == 1){ echo 'selected="selected"'; } ?>>Employees 1</option>
                                    <option value="2" <?php if($no_of_emp == 2){ echo 'selected="selected"'; } ?>>Employees 2</option>
                                    <option value="3" <?php if($no_of_emp == 3){ echo 'selected="selected"'; } ?>>Employees 3</option>
                                    <option value="4" <?php if($no_of_emp == 4){ echo 'selected="selected"'; } ?>>Employees 4</option>
                                    <option value="5" <?php if($no_of_emp == 5){ echo 'selected="selected"'; } ?>>Employees 5</option>
                                    <option value="6" <?php if($no_of_emp == 6){ echo 'selected="selected"'; } ?>>Employees 6</option>
                                    <option value="7" <?php if($no_of_emp == 7){ echo 'selected="selected"'; } ?>>Employees 7</option>
                                    <option value="8" <?php if($no_of_emp == 8){ echo 'selected="selected"'; } ?>>Employees 8</option>
                                    </select>
                                    </div>
                                    <div class="from-group col-md-6 select_box">
                                    <span class="select_border"></span>
                                    <select class="from-control select" name="yearestablished" required="">
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

                               <?php
                               }else{
                                ?>
                                        <?php
                                        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                                        $query = new WP_Query(
                                        array(
                                        'post_type' => 'buy',
                                        'author'   =>  get_current_user_id(),
                                        'paged' => $paged,
                                        'posts_per_page' => -1,
                                        'post_status' => array('publish', 'pending', 'draft'),
                                        'order' => 'DASC'
                                        )
                                        ); 

                                        ?>
                                        <?php 
                                        if($query->have_posts()) : 
                                        while($query->have_posts()) : $query->the_post();
                                        ?>
                                        <?php
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                                        ?>
                                        <div class="active-buyer-listings">
                                        <div class="buyer-listing">
                                        <div class="buyer-pic"> <img src="<?php echo $image[0]; ?>"></div>
                                        <div class="looking-for">
                                        <div class="title"><a href="<?php the_permalink();?>"> <?php the_title();?></a> </div>
                                        <div class="active_buyer_summary">
                                        <?php
                                        echo wp_trim_words( get_the_content(), 40, '...' );
                                        ?>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="edit_views_button">

                                        <ul>
                                        <?php $edit_post = add_query_arg('editbussiness', get_the_ID(), 'http://demosrvr.com/wp/getabusiness/my-properties/'); ?>
                                        <li>

                                        <!-- <a href="<?php echo site_url();?>/edit-active-buyer-listing/?activebuyer = <?php echo the_ID();?>"><i class="fa fa-edit"></i></a> -->
                                        <a class="btn edit-listing" href="<?php echo $edit_post; ?>" data-tooltip="<?php _e('Edit','contempo'); ?>"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li>
                                        <a href="<?php the_permalink();?>"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <li>
                                        <?php if( current_user_can( 'delete_post' ) ) : ?>
                                        <?php $nonce = wp_create_nonce('franchise_delete_post_nonce1') ?>
                                        <a href="<?php echo admin_url( 'admin-ajax.php?action=franchise_delete_post1&id=' . get_the_ID() . '&nonce=' . $nonce ) ?>" data-id="<?php the_ID() ?>" data-nonce="<?php echo $nonce ?>" class="delete-post"><i class="fas fa-trash"></i></a>
                                        <?php endif ?>
                                        </li>
                                        </ul>
                                        </div>

                                        </div>
                                        <?php endwhile; ?>
                                        <?php endif; wp_reset_postdata(); ?>

                               <?php
                               }
                               ?>
                                




                   <?php
                    }else{
                       ?>
                            <section id="tabs" class="sell-business">
                            <div class="container">
                            <div class="row">
                            <div class="col-md-12">
                            <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">



                            <a class="nav-item nav-link <?php if($_SESSION['friststep'] == '1'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>

                            <a class="nav-item nav-link <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan-2" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not c omplete)  >></a>


                            </div>
                            </nav>

                            <!-- first tabing start -->
                            <div class="tab-content" id="nav-tabContent">



                            <div class="tab-pane fade <?php if($_SESSION['friststep'] == '1'){ echo 'show active'; } ?>" id="select-plan" role="tabpanel" aria-labelledby="plan-select-tab">

                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-12">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Choose a <span> Plan to Meet</span> Your Needs. </h2>
                            <p>Choose an ad type below, then in the next step you will be able to add photos and additional details. You will also have access to a Valuation Report to help set the right asking price.</p>
                            </div>
                            <div class="select-plan-tab"> 
                            <h4>Choose from one of <span>2 Advertising</span> Plans</h4>

                            <div class="row showcase_row"> 


                            <div class="col-md-6"> 
                            <form  name="fristpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Showcase <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p><span>Multiple</span> Photos, Attachments & Video</p>
                            <p>View Stats & Leads Online</p>
                            <p><span>Higher Placement</span> in Search</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>
                            <p>Contact List of Interested Buyers</p>
                            <p>Targeted Email Blast Included</p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="fristplian" name="datetime">
                            <option value="6">6-month Showcase Ad: $69.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="1">
                            <input type="hidden" name="packagetotal" id="packagetotal" value="<?php echo 69.40*6; ?>">

                            <div class="select-btn"> 
                            <input type="submit" name="fristpakage" value="Select Showcase Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>



                            <div class="col-md-6"> 
                            <form name="secondpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Basic <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p>Single Photo and Attachment</p>
                            <p>View Stats & Leads Online</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="secondplian" name="datetime">
                            <option value="6">6-month Basic Ad: $49.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="2">
                            <input type="hidden" name="packagetotal" id="packagetotal1" value="<?php echo 49.95*6; ?>">


                            <div class="select-btn"> 
                            <input type="submit" name="secondpakagepakage" value="Select Basic Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>
                            </div>

                            <div class="product_description">
                            <div class="titile"> <h3>Product Description: </h3>  <span class="price">Price </span></div>
                            <div class="monthly-plan"> <h3>Month Basic Ad - ($<span class="monthid">69.95</span>/month) </h3><spna class="price">$<span class="totalpriceo"><?php echo 69.40*6; ?></spna></spna> </div>
                            <p>Your 6-month initial term begins one week after your purchase date, but you can publish your ad as soon as you 
                            are ready. Following your initial 6-month term, your ad will be billed monthly at $49.95/month unless you turn off 
                            renewal via the My Listings page.</p>
                            <div class="total_price"> Total $<span class="totalpriceo"><?php echo 69.40*6; ?></span> </div>
                            </div>



                            </div>
                            </div>
                            </div>


                            </div>
                            </div>
                            </div>




                            <div class="tab-pane fade <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'show active'; } ?>" id="select-plan-2" role="tabpanel" aria-labelledby="plan-select-2-tab">
                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-9">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Payment </h2>
                            package : <?php 
                            if($_SESSION['packagelisting']['packagename'] == '1'){
                            echo 'Showcase Ad';
                            }
                            if($_SESSION['packagelisting']['packagename'] == '2'){
                            echo 'Basic Ad';
                            }


                            ?><br>
                            Package time :   <?php echo $_SESSION['packagelisting']['datetime'] ?>Month<br>
                            Total Price :   <?php echo $_SESSION['packagelisting']['packagetotal'] ?><br>
                            By Paypal 

                            </div>

                            </div>

                            <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" onsubmit="return validateForm()">
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" value="dasun_1358759028_biz@archmage.lk" name="business">
                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" value="_xclick" name="cmd">
                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" value="sell-a-business" name="item_name">
                            <input type="hidden" id="amountval" value="<?php echo $_SESSION['packagelisting']['packagetotal'] ?>" name="amount">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" value="item_number" name="item_number">
                            <!-- Display the payment button. -->
                            <input type='hidden' name='cancel_return' value='http://demosrvr.com/wp/getabusiness/cancel'>
                            <input type='hidden' name='return' value='http://demosrvr.com/wp/getabusiness/success'>
                            <input type='hidden' name='notify_url' value='<?php bloginfo('template_url'); ?>/ipn.php'>
                            <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                            <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                            </form>






                            </div>
                            </div>
                            </div>
                            </section>
                       <?php
                    }



              }else{

              if($package_name == 'Three Month Listing' OR $package_name == 'One Year Listing' OR $package_name == 'Six Months Listing')
              {

              }else{
               ?>

               <section id="tabs" class="sell-business">
                            <div class="container">
                            <div class="row">
                            <div class="col-md-12">
                            <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">



                            <a class="nav-item nav-link <?php if($_SESSION['friststep'] == '1'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>

                            <a class="nav-item nav-link <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan-2" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>


                            </div>
                            </nav>

                            <!-- first tabing start -->
                            <div class="tab-content" id="nav-tabContent">



                            <div class="tab-pane fade <?php if($_SESSION['friststep'] == '1'){ echo 'show active'; } ?>" id="select-plan" role="tabpanel" aria-labelledby="plan-select-tab">

                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-12">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Choose a <span> Plan to Meet</span> Your Needs. </h2>
                            <p>Choose an ad type below, then in the next step you will be able to add photos and additional details. You will also have access to a Valuation Report to help set the right asking price.</p>
                            </div>
                            <div class="select-plan-tab"> 
                            <h4>Choose from one of <span>2 Advertising</span> Plans</h4>

                            <div class="row showcase_row"> 


                            <div class="col-md-6"> 
                            <form  name="fristpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Showcase <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p><span>Multiple</span> Photos, Attachments & Video</p>
                            <p>View Stats & Leads Online</p>
                            <p><span>Higher Placement</span> in Search</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>
                            <p>Contact List of Interested Buyers</p>
                            <p>Targeted Email Blast Included</p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="fristplian" name="datetime">
                            <option value="6">6-month Showcase Ad: $69.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="1">
                            <input type="hidden" name="packagetotal" id="packagetotal" value="<?php echo 69.40*6; ?>">

                            <div class="select-btn"> 
                            <input type="submit" name="fristpakage" value="Select Showcase Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>



                            <div class="col-md-6"> 
                            <form name="secondpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Basic <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p>Single Photo and Attachment</p>
                            <p>View Stats & Leads Online</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="secondplian" name="datetime">
                            <option value="6">6-month Basic Ad: $49.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="2">
                            <input type="hidden" name="packagetotal" id="packagetotal1" value="<?php echo 49.95*6; ?>">


                            <div class="select-btn"> 
                            <input type="submit" name="secondpakagepakage" value="Select Basic Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>
                            </div>

                            <div class="product_description">
                            <div class="titile"> <h3>Product Description: </h3>  <span class="price">Price </span></div>
                            <div class="monthly-plan"> <h3>Month Basic Ad - ($<span class="monthid">69.95</span>/month) </h3><spna class="price">$<span class="totalpriceo"><?php echo 69.40*6; ?></spna></spna> </div>
                            <p>Your 6-month initial term begins one week after your purchase date, but you can publish your ad as soon as you 
                            are ready. Following your initial 6-month term, your ad will be billed monthly at $49.95/month unless you turn off 
                            renewal via the My Listings page.</p>
                            <div class="total_price"> Total $<span class="totalpriceo"><?php echo 69.40*6; ?></span> </div>
                            </div>



                            </div>
                            </div>
                            </div>


                            </div>
                            </div>
                            </div>




                            <div class="tab-pane fade <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'show active'; } ?>" id="select-plan-2" role="tabpanel" aria-labelledby="plan-select-2-tab">
                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-9">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Payment </h2>
                            package : <?php 
                            if($_SESSION['packagelisting']['packagename'] == '1'){
                            echo 'Showcase Ad';
                            }
                            if($_SESSION['packagelisting']['packagename'] == '2'){
                            echo 'Basic Ad';
                            }


                            ?><br>
                            Package time :   <?php echo $_SESSION['packagelisting']['datetime'] ?>Month<br>
                            Total Price :   <?php echo $_SESSION['packagelisting']['packagetotal'] ?><br>
                            By Paypal 

                            </div>

                            </div>

                            <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" onsubmit="return validateForm()">
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" value="dasun_1358759028_biz@archmage.lk" name="business">
                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" value="_xclick" name="cmd">
                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" value="sell-a-business" name="item_name">
                            <input type="hidden" id="amountval" value="<?php echo $_SESSION['packagelisting']['packagetotal'] ?>" name="amount">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" value="item_number" name="item_number">
                            <!-- Display the payment button. -->
                            <input type='hidden' name='cancel_return' value='http://demosrvr.com/wp/getabusiness/cancel'>
                            <input type='hidden' name='return' value='http://demosrvr.com/wp/getabusiness/success'>
                            <input type='hidden' name='notify_url' value='<?php bloginfo('template_url'); ?>/ipn.php'>
                            <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                            <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                            </form>






                            </div>
                            </div>
                            </div>
                            </section>
               <?php

              }  


                  }
             endwhile;
        
                

        }
        else{
           ?>
           <section id="tabs" class="sell-business">
                            <div class="container">
                            <div class="row">
                            <div class="col-md-12">
                            <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">



                            <a class="nav-item nav-link <?php if($_SESSION['friststep'] == '1'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>

                            <a class="nav-item nav-link <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan-2" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>


                            </div>
                            </nav>

                            <!-- first tabing start -->
                            <div class="tab-content" id="nav-tabContent">



                            <div class="tab-pane fade <?php if($_SESSION['friststep'] == '1'){ echo 'show active'; } ?>" id="select-plan" role="tabpanel" aria-labelledby="plan-select-tab">

                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-12">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Choose a <span> Plan to Meet</span> Your Needs. </h2>
                            <p>Choose an ad type below, then in the next step you will be able to add photos and additional details. You will also have access to a Valuation Report to help set the right asking price.</p>
                            </div>
                            <div class="select-plan-tab"> 
                            <h4>Choose from one of <span>2 Advertising</span> Plans</h4>

                            <div class="row showcase_row"> 


                            <div class="col-md-6"> 
                            <form  name="fristpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Showcase <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p><span>Multiple</span> Photos, Attachments & Video</p>
                            <p>View Stats & Leads Online</p>
                            <p><span>Higher Placement</span> in Search</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>
                            <p>Contact List of Interested Buyers</p>
                            <p>Targeted Email Blast Included</p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="fristplian" name="datetime">
                            <option value="6">6-month Showcase Ad: $69.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="1">
                            <input type="hidden" name="packagetotal" id="packagetotal" value="<?php echo 69.40*6; ?>">

                            <div class="select-btn"> 
                            <input type="submit" name="fristpakage" value="Select Showcase Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>



                            <div class="col-md-6"> 
                            <form name="secondpackage" method="post">
                            <div class="showcase"> 
                            <div class="title"> <h2>Basic <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
                            <p>Single Photo and Attachment</p>
                            <p>View Stats & Leads Online</p>
                            <p>Free Valuation Report <span>($59.95 value)</span></p>

                            <div class="plan_select">
                            <span class="select_border"></span>
                            <select class="from-control select" id="secondplian" name="datetime">
                            <option value="6">6-month Basic Ad: $49.95/mo</option>
                            <option value="12">Year 1</option>
                            <option value="24">Year 2</option>
                            <option value="36">Year 3</option>
                            </select>
                            </div>
                            <input type="hidden" name="newcountstep" value="new">
                            <input type="hidden" name="countstep" value="4">
                            <input type="hidden" name="packagename" value="2">
                            <input type="hidden" name="packagetotal" id="packagetotal1" value="<?php echo 49.95*6; ?>">


                            <div class="select-btn"> 
                            <input type="submit" name="secondpakagepakage" value="Select Basic Ad" class="btn">
                            </div>
                            </div> 
                            </form>
                            </div>
                            </div>

                            <div class="product_description">
                            <div class="titile"> <h3>Product Description: </h3>  <span class="price">Price </span></div>
                            <div class="monthly-plan"> <h3>Month Basic Ad - ($<span class="monthid">69.95</span>/month) </h3><spna class="price">$<span class="totalpriceo"><?php echo 69.40*6; ?></spna></spna> </div>
                            <p>Your 6-month initial term begins one week after your purchase date, but you can publish your ad as soon as you 
                            are ready. Following your initial 6-month term, your ad will be billed monthly at $49.95/month unless you turn off 
                            renewal via the My Listings page.</p>
                            <div class="total_price"> Total $<span class="totalpriceo"><?php echo 69.40*6; ?></span> </div>
                            </div>



                            </div>
                            </div>
                            </div>


                            </div>
                            </div>
                            </div>




                            <div class="tab-pane fade <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'show active'; } ?>" id="select-plan-2" role="tabpanel" aria-labelledby="plan-select-2-tab">
                            <div class="sell-business-wrapper">
                            <div class="row"> 
                            <div class="col-md-9">
                            <div class="select-basic-plan">
                            <div class="description">
                            <h2>Payment </h2>
                            package : <?php 
                            if($_SESSION['packagelisting']['packagename'] == '1'){
                            echo 'Showcase Ad';
                            }
                            if($_SESSION['packagelisting']['packagename'] == '2'){
                            echo 'Basic Ad';
                            }


                            ?><br>
                            Package time :   <?php echo $_SESSION['packagelisting']['datetime'] ?>Month<br>
                            Total Price :   <?php echo $_SESSION['packagelisting']['packagetotal'] ?><br>
                            By Paypal 

                            </div>

                            </div>

                            <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" onsubmit="return validateForm()">
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" value="dasun_1358759028_biz@archmage.lk" name="business">
                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" value="_xclick" name="cmd">
                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" value="sell-a-business" name="item_name">
                            <input type="hidden" id="amountval" value="<?php echo $_SESSION['packagelisting']['packagetotal'] ?>" name="amount">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" value="item_number" name="item_number">
                            <!-- Display the payment button. -->
                            <input type='hidden' name='cancel_return' value='http://demosrvr.com/wp/getabusiness/cancel'>
                            <input type='hidden' name='return' value='http://demosrvr.com/wp/getabusiness/success'>
                            <input type='hidden' name='notify_url' value='<?php bloginfo('template_url'); ?>/ipn.php'>
                            <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                            <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                            </form>






                            </div>
                            </div>
                            </div>
                            </section>
           <?php
        }     
      ?>


  </div></div></div></section>


<?php
get_footer();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#secondplian').on('change', function() {
  
     var secondplianvalue = this.value; 
    var totalvalue = secondplianvalue*49.95;
    var totalvaluen = totalvalue.toFixed(2);
    $('.totalpriceo').text(totalvaluen);
    $('#packagetotal1').val(totalvaluen);
    $('.monthid').text("49.95");

    
  });

  $('#fristplian').on('change', function() {

    var secondplianvalue = this.value; 
    var totalvalue = secondplianvalue*69.95;
    var totalvaluen = totalvalue.toFixed(2);
    $('.totalpriceo').text(totalvaluen);
   $('#packagetotal').val(totalvaluen);

    $('.monthid').text("69.95");

 
  });

});
</script>
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
  function validateForm() {
  var amountval = $('#amountval').val();
  
  if(amountval == "" && amountval == undefined){
    alert("Please Fill All step");
    return false;
  }else{
    return true;
  }
  
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