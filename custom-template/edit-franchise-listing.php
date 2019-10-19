<?php
/*
 Display Template Name: Edit Franchise Listing
*/

 if(!is_user_logged_in()){
 	wp_redirect ( home_url("/") );
 }
$userID = get_current_user_id();
$query = new WP_Query(array('post_type' => 'franchise', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
    if(isset($_GET['editfranchise'])) {
        
        if($_GET['editfranchise'] == $post->ID) {
            $current_post = $post->ID;

            $title = get_the_title();
            $featuredImage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            $content = get_the_content();
            $require_content = get_field('require_content', $current_post);
            $franchise_cat = strip_tags( get_the_term_list( $current_post, 'franchise-category', '', ', ', '' ) );
            $country = get_field('country', $current_post);
            $location = get_field('location', $current_post);
            $rangefrom = get_field('investment_from', $current_post);
            $rangeto = get_field('investment_to', $current_post);
            $support = get_field('support', $current_post);
            $availability = get_field('availability', $current_post);
            $minimum_investment = get_field('minimum_investment', $current_post);

        }
    }

endwhile; endif;
wp_reset_query();

global $current_post;
$postTitleError = '';
if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce'))  {
   if(trim($_POST['title']) === '') {
    $postTitleError = 'Please enter a title.';
    $hasError = true;
  } else {
    $postTitle = trim($_POST['title']);
  }
  $post_information = array(
        'ID' => $current_post,
        'post_title' => esc_attr(strip_tags($_POST['title'])),
        'post_content' => esc_attr(strip_tags($_POST['body'])),
        'post-type' => 'franchise',
        'post_status' => 'publish'
    );
    $post_id = wp_update_post($post_information);
    if($post_id){

    update_post_meta($post_id, 'require_content', $_POST['require_content']);
    update_post_meta($post_id, 'country', $_POST['country']);
    update_post_meta($post_id, 'location', $_POST['location']);
    update_post_meta($post_id, 'investment_from', $_POST['investment_from']);
    update_post_meta($post_id, 'investment_to', $_POST['investment_to']);
    update_post_meta($post_id, 'support', $_POST['support']);
    update_post_meta($post_id, 'availability', $_POST['availability']);
    update_post_meta($post_id, 'minimum_investment', $_POST['minimum_investment']);
    wp_set_object_terms($post_id, $_POST['franchise_category'], 'franchise-category',false);

	$filename = $_FILES['image']['name'];
	$wp_filetype = wp_check_filetype( basename($filename), null );
	$wp_upload_dir = wp_upload_dir();

	// Move the uploaded file into the WordPress uploads directory
	move_uploaded_file( $_FILES['image']['tmp_name'], $wp_upload_dir['path']  . '/' . $filename );

	$attachment = array(
	'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
	'post_mime_type' => $wp_filetype['type'],
	'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	'post_content' => '',
	'post_status' => 'inherit'
	);

	$filename = $wp_upload_dir['path']  . '/' . $filename;

	$attach_id = wp_insert_attachment( $attachment, $filename, 37 );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	update_post_meta($post_id, '_thumbnail_id', $attach_id);

    // Redirect
  
    wp_redirect(home_url('/view-franchise-listing'));
    exit;
    }

}
get_header();
?>
<section class="view_active_buyer_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			<?php if(current_user_can( 'broker' ) || current_user_can( 'seller' ) ) { ?>
    <div class="list-group ">
              <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/my-properties/" class="list-group-item list-group-item-action"><?php echo esc_html__('My Properties', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/add-bussiness/" class="list-group-item list-group-item-action"><?php echo esc_html__('Add Business', 'Add Business');?></a>
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
			<?php while(have_posts()): the_post();?>
		<form name="frmContact" action="" method="post" enctype="multipart/form-data" onsubmit="return validateContactForm()">
        <div class="row">
            <div class="from-group col-md-6">
           <input id="title" type="text"  class="from-control input-field" placeholder="Title*" name="title" value="<?php echo $title;?>" />
           <span id="usertitle" class="info"></span>
            </div>

          <div class="from-group col-md-6">
               <!-- <span>Featured Image </span> -->
               <img src="<?php echo esc_url($featuredImage); ?>" />
               <input type="file"  name="image"  class="from-control input-field" placeholder="Featured Image" />
            </div>
            <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="body" name="body" placeholder="Content" ><?php echo $content;?></textarea>
          <span id="userbody" class="info"></span>
            </div>

          <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="require_content" placeholder="Extra Details*" name="require_content"><?php echo $require_content;?></textarea>
          <span id="userrequire_content" class="info"></span>
            </div>
            <div class="from-group col-md-6 select_box">
<span class="select_border"></span>
<?php 
            $taxonomy_name = 'franchise-category';
            $name = strip_tags( get_the_term_list( $current_post, 'franchise-category', '', ', ', '' ) );
            ?>
               <select iclass='from-control' name="franchise_category">
                <option value="0"><?php esc_html_e('Franchise-Category', 'contempo'); ?></option>
                <?php foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) : ?>
                    <?php if ($franchise_cat == $t->name) { $selected = 'selected="selected" '; } else { $selected = ''; } ?>
                    <option <?php echo esc_html($selected); ?>value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
                <?php endforeach; ?>
            </select>
               
            </div>
    <div class="from-group col-md-6 select_box">
        <span class="select_border"></span>
<select id="country" class="form-control input-field" name="country">
 <option value="AF" <?php echo ($country == "AF")?  'selected="selected"' : '' ?>>Afghanistan</option>
 <option value="AL" <?php echo ($country == "AL")?  'selected="selected"' : '' ?>>Albania</option>
 <option value="DZ" <?php echo ($country == "DZ")?  'selected="selected"' : '' ?>>Algeria</option>
 <option value="AS" <?php echo ($country == "AS")?  'selected="selected"' : '' ?>>American Samoa</option>
 <option value="AD" <?php echo ($country == "AD")?  'selected="selected"' : '' ?>>Andorra</option>
 <option value="AO" <?php echo ($country == "AO")?  'selected="selected"' : '' ?>>Angola</option>
 <option value="AI" <?php echo ($country == "AI")?  'selected="selected"' : '' ?>>Anguilla</option>
 <option value="AQ" <?php echo ($country == "AQ")?  'selected="selected"' : '' ?>>Antarctica</option>
 <option value="AG" <?php echo ($country == "AG")?  'selected="selected"' : '' ?>>Antigua and Barbuda</option>
 <option value="AR" <?php echo ($country == "AR")?  'selected="selected"' : '' ?>>Argentina</option>
 <option value="AM" <?php echo ($country == "AM")?  'selected="selected"' : '' ?>>Armenia</option>
 <option value="AW" <?php echo ($country == "AW")?  'selected="selected"' : '' ?>>Aruba</option>
 <option value="AU" <?php echo ($country == "AU")?  'selected="selected"' : '' ?>>Australia</option>
 <option value="AT" <?php echo ($country == "AT")?  'selected="selected"' : '' ?>>Austria</option>
 <option value="AZ" <?php echo ($country == "AZ")?  'selected="selected"' : '' ?>>Azerbaijan</option>
 <option value="BH" <?php echo ($country == "BH")?  'selected="selected"' : '' ?>>Bahrain</option>
 <option value="BD" <?php echo ($country == "BD")?  'selected="selected"' : '' ?>>Bangladesh</option>
 <option value="BB" <?php echo ($country == "BB")?  'selected="selected"' : '' ?>>Barbados</option>
 <option value="BY" <?php echo ($country == "BY")?  'selected="selected"' : '' ?>>Belarus</option>
 <option value="BE" <?php echo ($country == "BE")?  'selected="selected"' : '' ?>>Belgium</option>
 <option value="BZ" <?php echo ($country == "BZ")?  'selected="selected"' : '' ?>>Belize</option>
 <option value="BJ" <?php echo ($country == "BZ")?  'selected="selected"' : '' ?>>Benin</option>
 <option value="BM" <?php echo ($country == "BM")?  'selected="selected"' : '' ?>>Bermuda</option>
 <option value="BT" <?php echo ($country == "BT")?  'selected="selected"' : '' ?>>Bhutan</option>
 <option value="BO" <?php echo ($country == "BO")?  'selected="selected"' : '' ?>>Bolivia</option>
 <option value="BA" <?php echo ($country == "BA")?  'selected="selected"' : '' ?>>Bosnia and Herzegovina</option>
 <option value="BW" <?php echo ($country == "BW")?  'selected="selected"' : '' ?>>Botswana</option>
 <option value="BV" <?php echo ($country == "BV")?  'selected="selected"' : '' ?>>Bouvet Island</option>
 <option value="BR" <?php echo ($country == "BR")?  'selected="selected"' : '' ?>>Brazil</option>
 <option value="IO" <?php echo ($country == "IO")?  'selected="selected"' : '' ?>>British Indian Ocean Territory</option>
 <option value="VG" <?php echo ($country == "VG")?  'selected="selected"' : '' ?>>British Virgin Islands</option>
 <option value="BN" <?php echo ($country == "BN")?  'selected="selected"' : '' ?>>Brunei</option>
 <option value="BG" <?php echo ($country == "BG")?  'selected="selected"' : '' ?>>Bulgaria</option>
 <option value="BF" <?php echo ($country == "BF")?  'selected="selected"' : '' ?>>Burkina Faso</option>
 <option value="BI" <?php echo ($country == "BI")?  'selected="selected"' : '' ?>>Burundi</option>
 <option value="CI" <?php echo ($country == "CI")?  'selected="selected"' : '' ?>>Côte d'Ivoire</option>
 <option value="KH" <?php echo ($country == "KH")?  'selected="selected"' : '' ?>>Cambodia</option>
 <option value="CM" <?php echo ($country == "CM")?  'selected="selected"' : '' ?>>Cameroon</option>
 <option value="CA" <?php echo ($country == "CA")?  'selected="selected"' : '' ?>>Canada</option>
 <option value="CV" <?php echo ($country == "CV")?  'selected="selected"' : '' ?>>Cape Verde</option>
 <option value="KY" <?php echo ($country == "KY")?  'selected="selected"' : '' ?>>Cayman Islands</option>
 <option value="CF" <?php echo ($country == "CF")?  'selected="selected"' : '' ?>>Central African Republic</option>
 <option value="TD" <?php echo ($country == "TD")?  'selected="selected"' : '' ?>>Chad</option>
 <option value="CL" <?php echo ($country == "CL")?  'selected="selected"' : '' ?>>Chile</option>
 <option value="CN" <?php echo ($country == "CN")?  'selected="selected"' : '' ?>>China</option>
 <option value="CX" <?php echo ($country == "CX")?  'selected="selected"' : '' ?>>Christmas Island</option>
 <option value="CC" <?php echo ($country == "CC")?  'selected="selected"' : '' ?>>Cocos (Keeling) Islands</option>
 <option value="CO" <?php echo ($country == "CO")?  'selected="selected"' : '' ?>>Colombia</option>
 <option value="KM" <?php echo ($country == "KM")?  'selected="selected"' : '' ?>>Comoros</option>
 <option value="CG" <?php echo ($country == "CG")?  'selected="selected"' : '' ?>>Congo</option>
 <option value="CK" <?php echo ($country == "CK")?  'selected="selected"' : '' ?>>Cook Islands</option>
 <option value="CR" <?php echo ($country == "CR")?  'selected="selected"' : '' ?>>Costa Rica</option>
 <option value="HR" <?php echo ($country == "HR")?  'selected="selected"' : '' ?>>Croatia</option>
 <option value="CU" <?php echo ($country == "CU")?  'selected="selected"' : '' ?>>Cuba</option>
 <option value="CY" <?php echo ($country == "CY")?  'selected="selected"' : '' ?>>Cyprus</option>
 <option value="CZ" <?php echo ($country == "CZ")?  'selected="selected"' : '' ?>>Czech Republic</option>
 <option value="CD" <?php echo ($country == "CD")?  'selected="selected"' : '' ?>>Democratic Republic of the Congo</option>
 <option value="DK" <?php echo ($country == "DK")?  'selected="selected"' : '' ?>>Denmark</option>
 <option value="DJ" <?php echo ($country == "DJ")?  'selected="selected"' : '' ?>>Djibouti</option>
 <option value="DM" <?php echo ($country == "DM")?  'selected="selected"' : '' ?>>Dominica</option>
 <option value="DO" <?php echo ($country == "DO")?  'selected="selected"' : '' ?>>Dominican Republic</option>
 <option value="TP" <?php echo ($country == "TP")?  'selected="selected"' : '' ?>>East Timor</option>
 <option value="EC" <?php echo ($country == "EC")?  'selected="selected"' : '' ?>>Ecuador</option>
 <option value="EG" <?php echo ($country == "EG")?  'selected="selected"' : '' ?>>Egypt</option>
 <option value="SV" <?php echo ($country == "SV")?  'selected="selected"' : '' ?>>El Salvador</option>
 <option value="GQ" <?php echo ($country == "GQ")?  'selected="selected"' : '' ?>>Equatorial Guinea</option>
 <option value="ER" <?php echo ($country == "ER")?  'selected="selected"' : '' ?>>Eritrea</option>
 <option value="EE" <?php echo ($country == "EE")?  'selected="selected"' : '' ?>>Estonia</option>
 <option value="ET" <?php echo ($country == "ET")?  'selected="selected"' : '' ?>>Ethiopia</option>
 <option value="FO" <?php echo ($country == "FO")?  'selected="selected"' : '' ?>>Faeroe Islands</option>
 <option value="FK" <?php echo ($country == "FK")?  'selected="selected"' : '' ?>>Falkland Islands</option>
 <option value="FJ" <?php echo ($country == "FJ")?  'selected="selected"' : '' ?>>Fiji</option>
 <option value="FI" <?php echo ($country == "FI")?  'selected="selected"' : '' ?>>Finland</option>
 <option value="MK" <?php echo ($country == "MK")?  'selected="selected"' : '' ?>>Former Yugoslav Republic of Macedonia</option>
 <option value="FR" <?php echo ($country == "FR")?  'selected="selected"' : '' ?>>France</option>
 <option value="FX" <?php echo ($country == "FX")?  'selected="selected"' : '' ?>>France, Metropolitan</option>
 <option value="GF" <?php echo ($country == "GF")?  'selected="selected"' : '' ?>>French Guiana</option>
 <option value="PF" <?php echo ($country == "PF")?  'selected="selected"' : '' ?>>French Polynesia</option>
 <option value="TF" <?php echo ($country == "TF")?  'selected="selected"' : '' ?>>French Southern Territories</option>
 <option value="GA" <?php echo ($country == "GA")?  'selected="selected"' : '' ?>>Gabon</option>
 <option value="GE" <?php echo ($country == "GE")?  'selected="selected"' : '' ?>>Georgia</option>
 <option value="DE" <?php echo ($country == "DE")?  'selected="selected"' : '' ?>>Germany</option>
 <option value="GH" <?php echo ($country == "GH")?  'selected="selected"' : '' ?>>Ghana</option>
 <option value="GI" <?php echo ($country == "GI")?  'selected="selected"' : '' ?>>Gibraltar</option>
 <option value="GR" <?php echo ($country == "GR")?  'selected="selected"' : '' ?>>Greece</option>
 <option value="GL" <?php echo ($country == "GL")?  'selected="selected"' : '' ?>>Greenland</option>
 <option value="GD" <?php echo ($country == "GD")?  'selected="selected"' : '' ?>>Grenada</option>
 <option value="GP" <?php echo ($country == "GP")?  'selected="selected"' : '' ?>>Guadeloupe</option>
 <option value="GU" <?php echo ($country == "GU")?  'selected="selected"' : '' ?>>Guam</option>
 <option value="GT" <?php echo ($country == "GT")?  'selected="selected"' : '' ?>>Guatemala</option>
 <option value="GN" <?php echo ($country == "GN")?  'selected="selected"' : '' ?>>Guinea</option>
 <option value="GW" <?php echo ($country == "GW")?  'selected="selected"' : '' ?>>Guinea-Bissau</option>
 <option value="GY" <?php echo ($country == "GY")?  'selected="selected"' : '' ?>>Guyana</option>
 <option value="HT" <?php echo ($country == "HT")?  'selected="selected"' : '' ?>>Haiti</option>
 <option value="HM" <?php echo ($country == "HM")?  'selected="selected"' : '' ?>>Heard and Mc Donald Islands</option>
 <option value="HN" <?php echo ($country == "HN")?  'selected="selected"' : '' ?>>Honduras</option>
 <option value="HK" <?php echo ($country == "HK")?  'selected="selected"' : '' ?>>Hong Kong</option>
 <option value="HU" <?php echo ($country == "HU")?  'selected="selected"' : '' ?>>Hungary</option>
 <option value="IS" <?php echo ($country == "IS")?  'selected="selected"' : '' ?>>Iceland</option>
 <option value="IN" <?php echo ($country == "IN")?  'selected="selected"' : '' ?>>India</option>
 <option value="ID" <?php echo ($country == "ID")?  'selected="selected"' : '' ?>>Indonesia</option>
 <option value="IR" <?php echo ($country == "IR")?  'selected="selected"' : '' ?>>Iran</option>
 <option value="IQ" <?php echo ($country == "IQ")?  'selected="selected"' : '' ?>>Iraq</option>
 <option value="IE" <?php echo ($country == "IE")?  'selected="selected"' : '' ?>>Ireland</option>
 <option value="IL" <?php echo ($country == "IL")?  'selected="selected"' : '' ?>>Israel</option>
 <option value="IT" <?php echo ($country == "IT")?  'selected="selected"' : '' ?>>Italy</option>
 <option value="JM" <?php echo ($country == "JM")?  'selected="selected"' : '' ?>>Jamaica</option>
 <option value="JP" <?php echo ($country == "JP")?  'selected="selected"' : '' ?>>Japan</option>
 <option value="JO" <?php echo ($country == "JO")?  'selected="selected"' : '' ?>>Jordan</option>
 <option value="KZ" <?php echo ($country == "KZ")?  'selected="selected"' : '' ?>>Kazakhstan</option>
 <option value="KE" <?php echo ($country == "KE")?  'selected="selected"' : '' ?>>Kenya</option>
 <option value="KI" <?php echo ($country == "KI")?  'selected="selected"' : '' ?>>Kiribati</option>
 <option value="KW" <?php echo ($country == "KW")?  'selected="selected"' : '' ?>>Kuwait</option>
 <option value="KG" <?php echo ($country == "KG")?  'selected="selected"' : '' ?>>Kyrgyzstan</option>
 <option value="LA" <?php echo ($country == "LA")?  'selected="selected"' : '' ?>>Laos</option>
 <option value="LV" <?php echo ($country == "LV")?  'selected="selected"' : '' ?>>Latvia</option>
 <option value="LB" <?php echo ($country == "LB")?  'selected="selected"' : '' ?>>Lebanon</option>
 <option value="LS" <?php echo ($country == "LS")?  'selected="selected"' : '' ?>>Lesotho</option>
 <option value="LR" <?php echo ($country == "LR")?  'selected="selected"' : '' ?>>Liberia</option>
 <option value="LY" <?php echo ($country == "LY")?  'selected="selected"' : '' ?>>Libya</option>
 <option value="LI" <?php echo ($country == "LI")?  'selected="selected"' : '' ?>>Liechtenstein</option>
 <option value="LT" <?php echo ($country == "LT")?  'selected="selected"' : '' ?>>Lithuania</option>
 <option value="LU" <?php echo ($country == "LU")?  'selected="selected"' : '' ?>>Luxembourg</option>
 <option value="MO" <?php echo ($country == "MO")?  'selected="selected"' : '' ?>>Macau</option>
 <option value="MG" <?php echo ($country == "MG")?  'selected="selected"' : '' ?>>Madagascar</option>
 <option value="MW" <?php echo ($country == "MW")?  'selected="selected"' : '' ?>>Malawi</option>
 <option value="MY" <?php echo ($country == "MY")?  'selected="selected"' : '' ?>>Malaysia</option>
 <option value="MV" <?php echo ($country == "MV")?  'selected="selected"' : '' ?>>Maldives</option>
 <option value="ML" <?php echo ($country == "ML")?  'selected="selected"' : '' ?>>Mali</option>
 <option value="MT" <?php echo ($country == "MT")?  'selected="selected"' : '' ?>>Mayotte</option>
 <option value="MH" <?php echo ($country == "MH")?  'selected="selected"' : '' ?>>Marshall Islands</option>
 <option value="MQ" <?php echo ($country == "MQ")?  'selected="selected"' : '' ?>>Martinique</option>
 <option value="MR" <?php echo ($country == "MR")?  'selected="selected"' : '' ?>>Mauritania</option>
 <option value="MU" <?php echo ($country == "MU")?  'selected="selected"' : '' ?>>Mauritius</option>
 <option value="MX" <?php echo ($country == "MX")?  'selected="selected"' : '' ?>>Mexico</option>
 <option value="FM" <?php echo ($country == "FM")?  'selected="selected"' : '' ?>>Micronesia</option>
 <option value="MD" <?php echo ($country == "MD")?  'selected="selected"' : '' ?>>Moldova</option>
 <option value="MC" <?php echo ($country == "MC")?  'selected="selected"' : '' ?>>Monaco</option>
 <option value="MN" <?php echo ($country == "MN")?  'selected="selected"' : '' ?>>Mongolia</option>
 <option value="ME" <?php echo ($country == "ME")?  'selected="selected"' : '' ?>>Montenegro</option>
 <option value="MS" <?php echo ($country == "MS")?  'selected="selected"' : '' ?>>Montserrat</option>
 <option value="MA" <?php echo ($country == "MA")?  'selected="selected"' : '' ?>>Morocco</option>
 <option value="MZ" <?php echo ($country == "MZ")?  'selected="selected"' : '' ?>>Mozambique</option>
 <option value="MM" <?php echo ($country == "MM")?  'selected="selected"' : '' ?>>Myanmar</option>
 <option value="NA" <?php echo ($country == "NA")?  'selected="selected"' : '' ?>>Namibia</option>
 <option value="NR" <?php echo ($country == "NR")?  'selected="selected"' : '' ?>>Nauru</option>
 <option value="NP" <?php echo ($country == "NP")?  'selected="selected"' : '' ?>>Nepal</option>
 <option value="NL" <?php echo ($country == "NL")?  'selected="selected"' : '' ?>>Netherlands</option>
 <option value="AN" <?php echo ($country == "AN")?  'selected="selected"' : '' ?>>Netherlands Antilles</option>
 <option value="NC" <?php echo ($country == "NC")?  'selected="selected"' : '' ?>>New Caledonia</option>
 <option value="NZ" <?php echo ($country == "NZ")?  'selected="selected"' : '' ?>>New Zealand</option>
 <option value="NI" <?php echo ($country == "NI")?  'selected="selected"' : '' ?>>Nicaragua</option>
 <option value="NE" <?php echo ($country == "NE")?  'selected="selected"' : '' ?>>Niger</option>
 <option value="NG" <?php echo ($country == "NG")?  'selected="selected"' : '' ?>>Nigeria</option>
 <option value="NU" <?php echo ($country == "NU")?  'selected="selected"' : '' ?>>Niue</option>
 <option value="NF" <?php echo ($country == "NF")?  'selected="selected"' : '' ?>>Norfolk Island</option>
 <option value="KP" <?php echo ($country == "KP")?  'selected="selected"' : '' ?>>North Korea</option>
 <option value="MP" <?php echo ($country == "MP")?  'selected="selected"' : '' ?>>Northern Marianas</option>
 <option value="NO" <?php echo ($country == "NO")?  'selected="selected"' : '' ?>>Norway</option>
 <option value="OM" <?php echo ($country == "OM")?  'selected="selected"' : '' ?>>Oman</option>
 <option value="PK" <?php echo ($country == "PK")?  'selected="selected"' : '' ?>>Pakistan</option>
 <option value="PW" <?php echo ($country == "PW")?  'selected="selected"' : '' ?>>Palau</option>
 <option value="PA" <?php echo ($country == "PA")?  'selected="selected"' : '' ?>>Panama</option>
 <option value="PG" <?php echo ($country == "PG")?  'selected="selected"' : '' ?>>Papua New Guinea</option>
 <option value="PY" <?php echo ($country == "PY")?  'selected="selected"' : '' ?>>Paraguay</option>
 <option value="PE" <?php echo ($country == "PE")?  'selected="selected"' : '' ?>>Peru</option>
 <option value="PH" <?php echo ($country == "PH")?  'selected="selected"' : '' ?>>Philippines</option>
 <option value="PN" <?php echo ($country == "PN")?  'selected="selected"' : '' ?>>Pitcairn Islands</option>
 <option value="PL" <?php echo ($country == "PL")?  'selected="selected"' : '' ?>>Poland</option>
 <option value="PT" <?php echo ($country == "PT")?  'selected="selected"' : '' ?>>Portugal</option>
 <option value="PR" <?php echo ($country == "PR")?  'selected="selected"' : '' ?>>Puerto Rico</option>
 <option value="QA" <?php echo ($country == "QA")?  'selected="selected"' : '' ?>>Qatar</option>
 <option value="RE" <?php echo ($country == "RE")?  'selected="selected"' : '' ?>>Reunion</option>
 <option value="RO" <?php echo ($country == "RO")?  'selected="selected"' : '' ?>>Romania</option>
 <option value="RU" <?php echo ($country == "RU")?  'selected="selected"' : '' ?>>Russia</option>
 <option value="RW" <?php echo ($country == "RW")?  'selected="selected"' : '' ?>>Rwanda</option>
 <option value="ST" <?php echo ($country == "ST")?  'selected="selected"' : '' ?>>São Tomé and Príncipe</option>
 <option value="SH" <?php echo ($country == "SH")?  'selected="selected"' : '' ?>>Saint Helena</option>
 <option value="PM" <?php echo ($country == "PM")?  'selected="selected"' : '' ?>>St. Pierre and Miquelon</option>
 <option value="KN" <?php echo ($country == "KN")?  'selected="selected"' : '' ?>>Saint Kitts and Nevis</option>
 <option value="LC" <?php echo ($country == "LC")?  'selected="selected"' : '' ?>>Saint Lucia</option>
 <option value="VC" <?php echo ($country == "VC")?  'selected="selected"' : '' ?>>Saint Vincent and the Grenadines</option>
 <option value="WS" <?php echo ($country == "WS")?  'selected="selected"' : '' ?>>Samoa</option>
 <option value="SM" <?php echo ($country == "SM")?  'selected="selected"' : '' ?>>San Marino</option>
 <option value="SA" <?php echo ($country == "SA")?  'selected="selected"' : '' ?>>Saudi Arabia</option>
 <option value="SN" <?php echo ($country == "SN")?  'selected="selected"' : '' ?>>Senegal</option>
 <option value="RS" <?php echo ($country == "RS")?  'selected="selected"' : '' ?>>Serbia</option>
 <option value="SC" <?php echo ($country == "SC")?  'selected="selected"' : '' ?>>Seychelles</option>
 <option value="SL" <?php echo ($country == "SL")?  'selected="selected"' : '' ?>>Sierra Leone</option>
 <option value="SG" <?php echo ($country == "SG")?  'selected="selected"' : '' ?>>Singapore</option>
 <option value="SK" <?php echo ($country == "SK")?  'selected="selected"' : '' ?>>Slovakia</option>
 <option value="SI" <?php echo ($country == "SI")?  'selected="selected"' : '' ?>>Slovenia</option>
 <option value="SB" <?php echo ($country == "SB")?  'selected="selected"' : '' ?>>Solomon Islands</option>
 <option value="SO" <?php echo ($country == "SO")?  'selected="selected"' : '' ?>>Somalia</option>
 <option value="ZA" <?php echo ($country == "ZA")?  'selected="selected"' : '' ?>>South Africa</option>
 <option value="GS" <?php echo ($country == "GS")?  'selected="selected"' : '' ?>>South Georgia and the South Sandwich Islands</option>
 <option value="KR" <?php echo ($country == "KR")?  'selected="selected"' : '' ?>>South Korea</option>
 <option value="ES" <?php echo ($country == "ES")?  'selected="selected"' : '' ?>>Spain</option>
 <option value="LK" <?php echo ($country == "LK")?  'selected="selected"' : '' ?>>Sri Lanka</option>
 <option value="SD" <?php echo ($country == "SD")?  'selected="selected"' : '' ?>>Sudan</option>
 <option value="SR" <?php echo ($country == "SR")?  'selected="selected"' : '' ?>>Suriname</option>
 <option value="SJ" <?php echo ($country == "SJ")?  'selected="selected"' : '' ?>>Svalbard and Jan Mayen Islands</option>
 <option value="SZ" <?php echo ($country == "SZ")?  'selected="selected"' : '' ?>>Swaziland</option>
 <option value="SE" <?php echo ($country == "SE")?  'selected="selected"' : '' ?>>Sweden</option>
 <option value="CH" <?php echo ($country == "CH")?  'selected="selected"' : '' ?>>Switzerland</option>
 <option value="SY" <?php echo ($country == "SY")?  'selected="selected"' : '' ?>>Syria</option>
 <option value="TW" <?php echo ($country == "TW")?  'selected="selected"' : '' ?>>Taiwan</option>
 <option value="TJ" <?php echo ($country == "TJ")?  'selected="selected"' : '' ?>>Tajikistan</option>
 <option value="TZ" <?php echo ($country == "TZ")?  'selected="selected"' : '' ?>>Tanzania</option>
 <option value="TH" <?php echo ($country == "TH")?  'selected="selected"' : '' ?>>Thailand</option>
 <option value="BS" <?php echo ($country == "BS")?  'selected="selected"' : '' ?>>The Bahamas</option>
 <option value="GM" <?php echo ($country == "GM")?  'selected="selected"' : '' ?>>The Gambia</option>
 <option value="TG" <?php echo ($country == "TG")?  'selected="selected"' : '' ?>>Togo</option>
 <option value="TK" <?php echo ($country == "TK")?  'selected="selected"' : '' ?>>Tokelau</option>
 <option value="TO" <?php echo ($country == "TO")?  'selected="selected"' : '' ?>>Tonga</option>
 <option value="TT" <?php echo ($country == "TT")?  'selected="selected"' : '' ?>>Trinidad and Tobago</option>
 <option value="TN" <?php echo ($country == "TN")?  'selected="selected"' : '' ?>>Tunisia</option>
 <option value="TR" <?php echo ($country == "TR")?  'selected="selected"' : '' ?>>Turkey</option>
 <option value="TM" <?php echo ($country == "TM")?  'selected="selected"' : '' ?>>Turkmenistan</option>
 <option value="TC" <?php echo ($country == "TC")?  'selected="selected"' : '' ?>>Turks and Caicos Islands</option>
 <option value="TV" <?php echo ($country == "TV")?  'selected="selected"' : '' ?>>Tuvalu</option>
 <option value="VI" <?php echo ($country == "VI")?  'selected="selected"' : '' ?>>US Virgin Islands</option>
 <option value="UG" <?php echo ($country == "UG")?  'selected="selected"' : '' ?>>Uganda</option>
 <option value="UA" <?php echo ($country == "UA")?  'selected="selected"' : '' ?>>Ukraine</option>
 <option value="AE" <?php echo ($country == "AE")?  'selected="selected"' : '' ?>>United Arab Emirates</option>
 <option value="GB" <?php echo ($country == "GB")?  'selected="selected"' : '' ?>>United Kingdom</option>
 <option value="US" <?php echo ($country == "US")?  'selected="selected"' : '' ?>>United States</option>
 <option value="UM" <?php echo ($country == "UM")?  'selected="selected"' : '' ?>>United States Minor Outlying Islands</option>
 <option value="UY" <?php echo ($country == "UY")?  'selected="selected"' : '' ?>>Uruguay</option>
 <option value="UZ" <?php echo ($country == "UZ")?  'selected="selected"' : '' ?>>Uzbekistan</option>
 <option value="VU" <?php echo ($country == "VU")?  'selected="selected"' : '' ?>>Vanuatu</option>
 <option value="VA" <?php echo ($country == "VA")?  'selected="selected"' : '' ?>>Vatican City</option>
 <option value="VE" <?php echo ($country == "VE")?  'selected="selected"' : '' ?>>Venezuela</option>
 <option value="VN" <?php echo ($country == "VN")?  'selected="selected"' : '' ?>>Vietnam</option>
 <option value="WF" <?php echo ($country == "WF")?  'selected="selected"' : '' ?>>Wallis and Futuna Islands</option>
 <option value="EH" <?php echo ($country == "EH")?  'selected="selected"' : '' ?>>Western Sahara</option>
 <option value="YE" <?php echo ($country == "YE")?  'selected="selected"' : '' ?>>Yemen</option>
 <option value="ZM" <?php echo ($country == "ZM")?  'selected="selected"' : '' ?>>Zambia</option>
 <option value="ZW" <?php echo ($country == "ZW")?  'selected="selected"' : '' ?>>Zimbabwe</option>
</select>
    <span id="usercountry" class="info"></span>
     </div>

          <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
          <input id="location" type="text" class="from-control input-field" placeholder="Location*" name="location" value="<?php echo $location;?>" />
           <span id="userlocation" class="info"></span>
            </div>
            <div class="from-group col-md-6 select_box">
                <span class="select_border"></span>
                <input id="investment_from" type="text" class="from-control input-field" placeholder="Investment Range From*" name="investment_from" value="<?php echo $rangefrom;?>" />
                 <span id="userinvestment_from" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <input id="investment_to" type="text" class="from-control input-field" placeholder="Investment Range To*" name="investment_to" value="<?php echo $rangeto;?>" />
            <span id="userinvestment_to" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <input id="support" type="text" class="from-control input-field" placeholder="Support & Training" name="support" value="<?php echo $support;?>" />
            <span id="usersupport" class="info"></span>
            </div>
            <div class="from-group col-md-6">
              <input id="availability" type="text" placeholder="Availability" class="from-control input-field" name="availability" value="<?php echo $availability;?>" />
              <span id="useravailability" class="info"></span>
            </div>
            <div class="from-group col-md-6">
              <input id="minimum_investment" type="text" placeholder="Minimum Investment" class="from-control input-field" name="minimum_investment" value="<?php echo $minimum_investment;?>" />
            </div>
            <div class="from-group col-md-6">
               <!-- <span style="background: #ffa733; color: #fff; text-align: center; font-weight: bold;"> <?php echo $price; ?>
               </span> -->
             </div>
            <div class="from-group col-md-12 submit_btn">
            	<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
            <input type="hidden" name="submitted" id="submitted" value="true" />
<input class="btn" type="submit" name="submit"  value="Update"/>
            </div>

        
   </div>
 </form>
<?php endwhile;?>
             </div>
            
		</div>
	</div>
</section>

<?php
get_footer();
?>