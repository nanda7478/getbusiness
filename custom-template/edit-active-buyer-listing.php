<?php
/*
 Display Template Name: Edit Active Buyer Listing
*/
 if(!is_user_logged_in()){
 	wp_redirect ( home_url("/") );
 }
$userID = get_current_user_id();

$query = new WP_Query(array('post_type' => 'active-buyer', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
    if(isset($_GET['activebuyer'])) {
        
        if($_GET['activebuyer'] == $post->ID) {
            $current_post = $post->ID;

            $title = get_the_title();
            $content = get_the_content();
            $summery = get_field('my_requirement', $current_post);
            $location = get_field('location', $current_post);
            $rangefrom = get_field('investment_from', $current_post);
            $rangeto = get_field('investment_to', $current_post);
            $buyer_cat = strip_tags( get_the_term_list( $current_post, 'buyer-category', '', ', ', '' ) );
            $country = get_field('country', $current_post);

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
        'post-type' => 'active-buyer',
        'post_status' => 'publish'
    );
    $post_id = wp_update_post($post_information);
      if($post_id)
  {
    update_post_meta($post_id, 'my_requirement', $_POST['my_requirement']);
    update_post_meta($post_id, 'country', $_POST['country']);
    update_post_meta($post_id, 'location', $_POST['location']);
    update_post_meta($post_id, 'investment_from', $_POST['investment_from']);
    update_post_meta($post_id, 'investment_to', $_POST['investment_to']);
    wp_set_object_terms($post_id, $_POST['buyer_category'], 'buyer-category',false);
    // Redirect
  
    wp_redirect(home_url('/view-active-buyer-listing'));
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
			<form name="frmContact" action="" method="post">
        <div class="row">
            <div class="from-group col-md-6">
           <input id="title" type="text"  class="from-control input-field" placeholder="Title*" name="title" value="<?php echo $title;?>" />
           <span id="usertitle" class="info"></span>
            </div>

            <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="body" name="body" placeholder="Content" ><?php echo $content;?></textarea>
          <span id="userbody" class="info"></span>
            </div>

          <div class="from-group col-md-6">
          <textarea class="from-control input-field" id="require_content" placeholder="Extra Details*" name="my_requirement"><?php echo $summery;?></textarea>
          <span id="userrequire_content" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <?php 
            $taxonomy_name = 'buyer-category';
            $name = strip_tags( get_the_term_list( $current_post, 'buyer-category', '', ', ', '' ) );
            ?>
               <select iclass='from-control' name="buyer_category">
                <option value="0"><?php esc_html_e('Buyer-Category', 'contempo'); ?></option>
                <?php foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) : ?>
                    <?php if ($buyer_cat == $t->name) { $selected = 'selected="selected" '; } else { $selected = ''; } ?>
                    <option <?php echo esc_html($selected); ?>value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
                <?php endforeach; ?>
            </select>

            </div>
    <div class="from-group col-md-6">
      <select id="country" class="form-control input-field" name="country">
<option value="Afghanistan" <?php echo ($country == "Afghanistan")?  'selected="selected"' : '' ?>>Afghanistan</option>
<option value="Åland Islands" <?php echo ($country == "Åland Islands")?  'selected="selected"' : '' ?>>Åland Islands</option>
<option value="Albania" <?php echo ($country == "Albania")?  'selected="selected"' : '' ?>>Albania</option>
<option value="Algeria" <?php echo ($country == "Algeria")?  'selected="selected"' : '' ?>>Algeria</option>
<option value="merican Samoa" <?php echo ($country == "merican Samoa")?  'selected="selected"' : '' ?>>American Samoa</option>
<option value="Andorra" <?php echo ($country == "Andorra")?  'selected="selected"' : '' ?>>Andorra</option>
<option value="Angola" <?php echo ($country == "Angola")?  'selected="selected"' : '' ?>>Angola</option>
<option value="Anguilla" <?php echo ($country == "Anguilla")?  'selected="selected"' : '' ?>>Anguilla</option>
<option value="Antarctica" <?php echo ($country == "Antarctica")?  'selected="selected"' : '' ?>>Antarctica</option>
<option value="Antigua" <?php echo ($country == "Antigua")?  'selected="selected"' : '' ?>>Antigua and Barbuda</option>
<option value="Argentina" <?php echo ($country == "Argentina")?  'selected="selected"' : '' ?>>Argentina</option>
<option value="Armenia" <?php echo ($country == "Armenia")?  'selected="selected"' : '' ?>>Armenia</option>
<option value="Aruba" <?php echo ($country == "Aruba")?  'selected="selected"' : '' ?>>Aruba</option>
<option value="Australia" <?php echo ($country == "Australia")?  'selected="selected"' : '' ?>>Australia</option>
<option value="Austria" <?php echo ($country == "Austria")?  'selected="selected"' : '' ?>>Austria</option>
<option value="Azerbaijan" <?php echo ($country == "Azerbaijan")?  'selected="selected"' : '' ?>>Azerbaijan</option>
<option value="Bahamas" <?php echo ($country == "Bahamas")?  'selected="selected"' : '' ?>>Bahamas</option>
<option value="Bahrain" <?php echo ($country == "Bahrain")?  'selected="selected"' : '' ?>>Bahrain</option>
<option value="Bangladesh" <?php echo ($country == "Bangladesh")?  'selected="selected"' : '' ?>>Bangladesh</option>
<option value="Barbados" <?php echo ($country == "Barbados")?  'selected="selected"' : '' ?>>Barbados</option>
<option value="Belarus" <?php echo ($country == "Belarus")?  'selected="selected"' : '' ?>>Belarus</option>
<option value="Belgium" <?php echo ($country == "Belgium")?  'selected="selected"' : '' ?>>Belgium</option>
<option value="Belize" <?php echo ($country == "Belize")?  'selected="selected"' : '' ?>>Belize</option>
<option value="Benin" <?php echo ($country == "Benin")?  'selected="selected"' : '' ?>>Benin</option>
<option value="Bermuda" <?php echo ($country == "Bermuda")?  'selected="selected"' : '' ?>>Bermuda</option>
<option value="Bhutan" <?php echo ($country == "Bhutan")?  'selected="selected"' : '' ?>>Bhutan</option>
<option value="Bolivia" <?php echo ($country == "Bolivia")?  'selected="selected"' : '' ?>>Bolivia, Plurinational State of</option>
<option value="Bonaire" <?php echo ($country == "Bonaire")?  'selected="selected"' : '' ?>>Bonaire, Sint Eustatius and Saba</option>
<option value="Bosnia" <?php echo ($country == "Bosnia")?  'selected="selected"' : '' ?>>Bosnia and Herzegovina</option>
<option value="Botswana" <?php echo ($country == "Botswana")?  'selected="selected"' : '' ?>>Botswana</option>
<option value="ouvet Island" <?php echo ($country == "ouvet Island")?  'selected="selected"' : '' ?>>Bouvet Island</option>
<option value="Brazil" <?php echo ($country == "Brazil")?  'selected="selected"' : '' ?>>Brazil</option>
<option value="British Indian Ocean" <?php echo ($country == "British Indian Ocean")?  'selected="selected"' : '' ?>>British Indian Ocean Territory</option>
<option value="Brunei Darussalam" <?php echo ($country == "Brunei Darussalam")?  'selected="selected"' : '' ?>>Brunei Darussalam</option>
<option value="Bulgaria" <?php echo ($country == "Bulgaria")?  'selected="selected"' : '' ?>>Bulgaria</option>
<option value="Burkina Faso" <?php echo ($country == "Burkina Faso")?  'selected="selected"' : '' ?>>Burkina Faso</option>
<option value="Burundi" <?php echo ($country == "Burundi")?  'selected="selected"' : '' ?>>Burundi</option>
<option value="Cambodia" <?php echo ($country == "Cambodia")?  'selected="selected"' : '' ?>>Cambodia</option>
<option value="Cameroon" <?php echo ($country == "Cameroon")?  'selected="selected"' : '' ?>>Cameroon</option>
<option value="Canada" <?php echo ($country == "Canada")?  'selected="selected"' : '' ?>>Canada</option>
<option value="Cape Verde" <?php echo ($country == "Cape Verde")?  'selected="selected"' : '' ?>>Cape Verde</option>
<option value="Cayman Islands" <?php echo ($country == "Cayman Islands")?  'selected="selected"' : '' ?>>Cayman Islands</option>
<option value="Central African Republic" <?php echo ($country == "Central African Republic")?  'selected="selected"' : '' ?>>Central African Republic</option>
<option value="Chad" <?php echo ($country == "Chad")?  'selected="selected"' : '' ?>>Chad</option>
<option value="Chile" <?php echo ($country == "Chile")?  'selected="selected"' : '' ?>>Chile</option>
<option value="China" <?php echo ($country == "China")?  'selected="selected"' : '' ?>>China</option>
<option value="Christmas Island" <?php echo ($country == "Christmas Island")?  'selected="selected"' : '' ?>>Christmas Island</option>
<option value="Cocos Islands" <?php echo ($country == "Cocos Islands")?  'selected="selected"' : '' ?>>Cocos (Keeling) Islands</option>
	<option value="Colombia" <?php echo ($country == "Colombia")?  'selected="selected"' : '' ?>>Colombia</option>
	<option value="Comoros" <?php echo ($country == "Comoros")?  'selected="selected"' : '' ?>>Comoros</option>
	<option value="Congo" <?php echo ($country == "Congo")?  'selected="selected"' : '' ?>>Congo</option>
	<option value="Congo, the Democratic Republic of the" <?php echo ($country == "Congo, the Democratic Republic of the")?  'selected="selected"' : '' ?>>Congo, the Democratic Republic of the</option>
	<option value="Cook Islands" <?php echo ($country == "Cook Islands")?  'selected="selected"' : '' ?>>Cook Islands</option>
	<option value="Costa Rica" <?php echo ($country == "Costa Rica")?  'selected="selected"' : '' ?>>Costa Rica</option>
	<option value="Côte d'Ivoire" <?php echo ($country == "Côte d'Ivoire")?  'selected="selected"' : '' ?>>Côte d'Ivoire</option>
	<option value="Croatia" <?php echo ($country == "Croatia")?  'selected="selected"' : '' ?>>Croatia</option>
	<option value="Cuba" <?php echo ($country == "Cuba")?  'selected="selected"' : '' ?>>Cuba</option>
	<option value="Curaçao" <?php echo ($country == "Curaçao")?  'selected="selected"' : '' ?>>Curaçao</option>
	<option value="Cyprus" <?php echo ($country == "Cyprus")?  'selected="selected"' : '' ?>>Cyprus</option>
	<option value="Czech Republic" <?php echo ($country == "Czech Republic")?  'selected="selected"' : '' ?>>Czech Republic</option>
	<option value="Denmark" <?php echo ($country == "Denmark")?  'selected="selected"' : '' ?>>Denmark</option>
	<option value="Djibouti" <?php echo ($country == "Djibouti")?  'selected="selected"' : '' ?>>Djibouti</option>
	<option value="Dominica" <?php echo ($country == "Dominica")?  'selected="selected"' : '' ?>>Dominica</option>
	<option value="Dominican Republic" <?php echo ($country == "Dominican Republic")?  'selected="selected"' : '' ?> >Dominican Republic</option>
	<option value="Egypt" <?php echo ($country == "Egypt")?  'selected="selected"' : '' ?>>Egypt</option>
	<option value="El Salvador" <?php echo ($country == "El Salvador")?  'selected="selected"' : '' ?> >El Salvador</option>
	<option value="Equatorial Guinea" <?php echo ($country == "Equatorial Guinea")?  'selected="selected"' : '' ?>>Equatorial Guinea</option>
	<option value="Eritrea" <?php echo ($country == "Eritrea")?  'selected="selected"' : '' ?>>Eritrea</option>
	<option value="Estonia" <<?php echo ($country == "Estonia")?  'selected="selected"' : '' ?> >Estonia</option>
	<option value="Ethiopia" <?php echo ($country == "Ethiopia")?  'selected="selected"' : '' ?>>Ethiopia</option>
	<option value="Falkland Islands" <?php echo ($country == "Falkland Islands")?  'selected="selected"' : '' ?> >Falkland Islands (Malvinas)</option>
	<option value="Faroe Islands" <?php echo ($country == "Faroe Islands")?  'selected="selected"' : '' ?> >Faroe Islands</option>
	<option value="Fiji" <?php echo ($country == "Fiji")?  'selected="selected"' : '' ?>>Fiji</option>
	<option value="Finland" <?php echo ($country == "Finland")?  'selected="selected"' : '' ?>>Finland</option>
	<option value="France" <?php echo ($country == "France")?  'selected="selected"' : '' ?>>France</option>
	<option value="French Guiana" <?php echo ($country == "French Guiana")?  'selected="selected"' : '' ?>>French Guiana</option>
	<option value="French Polynesia" <?php echo ($country == "French Polynesia")?  'selected="selected"' : '' ?>>French Polynesia</option>
	<option value="French Southern Territories" <?php echo ($country == "French Southern Territories")?  'selected="selected"' : '' ?>>French Southern Territories</option>
	<option value="Gabon" <?php echo ($country == "Gabon")?  'selected="selected"' : '' ?>>Gabon</option>
	<option value="Gambia" <?php echo ($country == "Gambia")?  'selected="selected"' : '' ?>>Gambia</option>
	<option value="Georgia" <?php echo ($country == "Georgia")?  'selected="selected"' : '' ?>>Georgia</option>
	<option value="Germany" <?php echo ($country == "Germany")?  'selected="selected"' : '' ?>>Germany</option>
	<option value="Ghana" <?php echo ($country == "Ghana")?  'selected="selected"' : '' ?>>Ghana</option>
	<option value="Gibraltar" <?php echo ($country == "Gibraltar")?  'selected="selected"' : '' ?>>Gibraltar</option>
	<option value="Greece" <?php echo ($country == "Greece")?  'selected="selected"' : '' ?>>Greece</option>
	<option value="Greenland" <?php echo ($country == "Greenland")?  'selected="selected"' : '' ?>>Greenland</option>
	<option value="Grenada" <?php echo ($country == "Grenada")?  'selected="selected"' : '' ?>>Grenada</option>
	<option value="Guadeloupe" <?php echo ($country == "Guadeloupe")?  'selected="selected"' : '' ?>>Guadeloupe</option>
	<option value="Guam" <?php echo ($country == "Guam")?  'selected="selected"' : '' ?>>Guam</option>
	<option value="Guatemala" <?php echo ($country == "Guatemala")?  'selected="selected"' : '' ?>>Guatemala</option>
	<option value="Guernsey" <?php echo ($country == "Guernsey")?  'selected="selected"' : '' ?>>Guernsey</option>
	<option value="Guinea" <?php echo ($country == "Guinea")?  'selected="selected"' : '' ?>>Guinea</option>
   <option value="Guinea-Bissau" <?php echo ($country == "Guinea-Bissau")?  'selected="selected"' : '' ?>>Guinea-Bissau</option>
	<option value="Guyana" <?php echo ($country == "Guyana")?  'selected="selected"' : '' ?>>Guyana</option>
	<option value="Haiti" <?php echo ($country == "Haiti")?  'selected="selected"' : '' ?>>Haiti</option>
	<option value="Heard Island" <?php echo ($country == "Heard Island")?  'selected="selected"' : '' ?>>Heard Island and McDonald Islands</option>
		<option value="Vatican City" <?php echo ($country == "Vatican City")?  'selected="selected"' : '' ?>>Holy See (Vatican City State)</option>
	<option value="Honduras" <?php echo ($country == "Honduras")?  'selected="selected"' : '' ?>>Honduras</option>
	<option value="Hong Kong" <?php echo ($country == "Hong Kong")?  'selected="selected"' : '' ?>>Hong Kong</option>
	<option value="Hungary" <?php echo ($country == "Hungary")?  'selected="selected"' : '' ?>>Hungary</option>
	<option value="Iceland" <?php echo ($country == "Iceland")?  'selected="selected"' : '' ?>>Iceland</option>
	<option value="India" <?php echo ($country == "India")?  'selected="selected"' : '' ?>>India</option>
	<option value="Indonesia" <?php echo ($country == "Indonesia")?  'selected="selected"' : '' ?>>Indonesia</option>
	<option value="Iran" <?php echo ($country == "Iran")?  'selected="selected"' : '' ?>>Iran, Islamic Republic of</option>
	<option value="Iraq" <?php echo ($country == "Iraq")?  'selected="selected"' : '' ?>>Iraq</option>
	<option value="Ireland" <?php echo ($country == "Ireland")?  'selected="selected"' : '' ?>>Ireland</option>
	<option value="Isle of Man" <?php echo ($country == "Isle of Man")?  'selected="selected"' : '' ?>>Isle of Man</option>
	<option value="Israel" <?php echo ($country == "Israel")?  'selected="selected"' : '' ?>>Israel</option>
	<option value="Italy" <?php echo ($country == "Italy")?  'selected="selected"' : '' ?>>Italy</option>
	<option value="Jamaica" <?php echo ($country == "Jamaica")?  'selected="selected"' : '' ?>>Jamaica</option>
	<option value="Japan" <?php echo ($country == "Japan")?  'selected="selected"' : '' ?>>Japan</option>
	<option value="Jersey" <?php echo ($country == "Jersey")?  'selected="selected"' : '' ?>>Jersey</option>
	<option value="Jordan" <?php echo ($country == "Jordan")?  'selected="selected"' : '' ?>>Jordan</option>
	<option value="Kazakhstan" <?php echo ($country == "Kazakhstan")?  'selected="selected"' : '' ?>>Kazakhstan</option>
	<option value="Kenya" <?php echo ($country == "Kenya")?  'selected="selected"' : '' ?>>Kenya</option>
	<option value="Kiribati" <?php echo ($country == "Kiribati")?  'selected="selected"' : '' ?>>Kiribati</option>
	<option value="Korea, Democratic People's Republic of" <?php echo ($country == "Korea, Democratic People's Republic of")?  'selected="selected"' : '' ?>>Korea, Democratic People's Republic of</option>
	<option value="Korea, Republic of" <?php echo ($country == "Korea, Republic of")?  'selected="selected"' : '' ?>>Korea, Republic of</option>
	<option value="Kuwait" <?php echo ($country == "Kuwait")?  'selected="selected"' : '' ?>>Kuwait</option>
	<option value="Kyrgyzstan" <?php echo ($country == "Kyrgyzstan")?  'selected="selected"' : '' ?>>Kyrgyzstan</option>
	<option value="Lao" <?php echo ($country == "Lao")?  'selected="selected"' : '' ?>>Lao People's Democratic Republic</option>
	<option value="Latvia" <?php echo ($country == "Latvia")?  'selected="selected"' : '' ?>>Latvia</option>
	<option value="Lebanon" <?php echo ($country == "Lebanon")?  'selected="selected"' : '' ?>>Lebanon</option>
	<option value="Lesotho" <?php echo ($country == "Lesotho")?  'selected="selected"' : '' ?>>Lesotho</option>
	<option value="Liberia" <?php echo ($country == "Liberia")?  'selected="selected"' : '' ?>>Liberia</option>
	<option value="Libya" <?php echo ($country == "Libya")?  'selected="selected"' : '' ?>>Libya</option>
	<option value="Liechtenstein" <?php echo ($country == "Liechtenstein")?  'selected="selected"' : '' ?>>Liechtenstein</option>
	<option value="Lithuania" <?php echo ($country == "Lithuania")?  'selected="selected"' : '' ?>>Lithuania</option>
	<option value="Luxembourg" <?php echo ($country == "Luxembourg")?  'selected="selected"' : '' ?>>Luxembourg</option>
	<option value="Macao" <?php echo ($country == "Macao")?  'selected="selected"' : '' ?>>Macao</option>
	<option value="Macedonia" <?php echo ($country == "Macedonia")?  'selected="selected"' : '' ?>>Macedonia, the former Yugoslav Republic of</option>
	<option value="Madagascar" <?php echo ($country == "Madagascar")?  'selected="selected"' : '' ?>>Madagascar</option>
	<option value="Malawi" <?php echo ($country == "Malawi")?  'selected="selected"' : '' ?>>Malawi</option>
	<option value="Malaysia" <?php echo ($country == "Malaysia")?  'selected="selected"' : '' ?>>Malaysia</option>
	<option value="Maldives" <?php echo ($country == "Maldives")?  'selected="selected"' : '' ?>>Maldives</option>
	<option value="Mali" <?php echo ($country == "Mali")?  'selected="selected"' : '' ?>>Mali</option>
	<option value="Malta"<?php echo ($country == "Malta")?  'selected="selected"' : '' ?>>Malta</option>
	<option value="Marshall Islands" <?php echo ($country == "Marshall Islands")?  'selected="selected"' : '' ?>>Marshall Islands</option>
	<option value="Martinique" <?php echo ($country == "Martinique")?  'selected="selected"' : '' ?>>Martinique</option>
	<option value="Mauritania" <?php echo ($country == "Mauritania")?  'selected="selected"' : '' ?>>Mauritania</option>
	<option value="Mauritius" <?php echo ($country == "Mauritius")?  'selected="selected"' : '' ?>>Mauritius</option>
	<option value="Mayotte" <?php echo ($country == "Mayotte")?  'selected="selected"' : '' ?>>Mayotte</option>
	<option value="Mexico" <?php echo ($country == "Mexico")?  'selected="selected"' : '' ?>>Mexico</option>
	<option value="Micronesia" <?php echo ($country == "Micronesia")?  'selected="selected"' : '' ?>>Micronesia, Federated States of</option>
	<option value="Moldova" <?php echo ($country == "Moldova")?  'selected="selected"' : '' ?>>Moldova, Republic of</option>
	<option value="Monaco" <?php echo ($country == "Monaco")?  'selected="selected"' : '' ?>>Monaco</option>
	<option value="Mongolia" <?php echo ($country == "Mongolia")?  'selected="selected"' : '' ?>>Mongolia</option>
	<option value="Montenegro" <?php echo ($country == "Montenegro")?  'selected="selected"' : '' ?>>Montenegro</option>
	<option value="Montserrat" <?php echo ($country == "Montserrat")?  'selected="selected"' : '' ?>>Montserrat</option>
	<option value="Morocco" <?php echo ($country == "Morocco")?  'selected="selected"' : '' ?>>Morocco</option>
	<option value="Mozambique" <?php echo ($country == "Mozambique")?  'selected="selected"' : '' ?>>Mozambique</option>
	<option value="Myanmar" <?php echo ($country == "Myanmar")?  'selected="selected"' : '' ?>>Myanmar</option>
	<option value="Namibia" <?php echo ($country == "Namibia")?  'selected="selected"' : '' ?>>Namibia</option>
	<option value="Nauru" <?php echo ($country == "Nauru")?  'selected="selected"' : '' ?>>Nauru</option>
	<option value="Nepal" <?php echo ($country == "Nepal")?  'selected="selected"' : '' ?>>Nepal</option>
	<option value="Netherlands" <?php echo ($country == "Netherlands")?  'selected="selected"' : '' ?>>Netherlands</option>
	<option value="New Caledonia" <?php echo ($country == "New Caledonia")?  'selected="selected"' : '' ?>>New Caledonia</option>
	<option value="New Zealand" <?php echo ($country == "New Zealand")?  'selected="selected"' : '' ?>>New Zealand</option>
	<option value="Nicaragua" <?php echo ($country == "Nicaragua")?  'selected="selected"' : '' ?>>Nicaragua</option>
	<option value="Niger" <?php echo ($country == "Niger")?  'selected="selected"' : '' ?>>Niger</option>
	<option value="Nigeria" <?php echo ($country == "Nigeria")?  'selected="selected"' : '' ?>>Nigeria</option>
	<option value="Niue" <?php echo ($country == "Niue")?  'selected="selected"' : '' ?>>Niue</option>
<option value="Norfolk Island" <?php echo ($country == "Norfolk Island")?  'selected="selected"' : '' ?>>Norfolk Island</option>
<option value="Northern Mariana Islands" <?php echo ($country == "Northern Mariana Islands")?  'selected="selected"' : '' ?>>Northern Mariana Islands</option>
<option value="Norway" <?php echo ($country == "Norway")?  'selected="selected"' : '' ?>>Norway</option>
<option value="Oman" <?php echo ($country == "Oman")?  'selected="selected"' : '' ?>>Oman</option>
<option value="Pakistan" <?php echo ($country == "Pakistan")?  'selected="selected"' : '' ?>>Pakistan</option>
<option value="Palau" <?php echo ($country == "Palau")?  'selected="selected"' : '' ?>>Palau</option>
<option value="Palestinian" <?php echo ($country == "Palestinian")?  'selected="selected"' : '' ?>>Palestinian Territory, Occupied</option>
	<option value="Panama" <?php echo ($country == "Panama")?  'selected="selected"' : '' ?>>Panama</option>
	<option value="Papua New Guinea" <?php echo ($country == "Papua New Guinea")?  'selected="selected"' : '' ?>>Papua New Guinea</option>
	<option value="Paraguay" <?php echo ($country == "Paraguay")?  'selected="selected"' : '' ?>>Paraguay</option>
	<option value="Peru" <?php echo ($country == "Peru")?  'selected="selected"' : '' ?>>Peru</option>
	<option value="Philippines" <?php echo ($country == "Philippines")?  'selected="selected"' : '' ?>>Philippines</option>
	<option value="Pitcairn" <?php echo ($country == "Pitcairn")?  'selected="selected"' : '' ?>>Pitcairn</option>
	<option value="Poland" <?php echo ($country == "Poland")?  'selected="selected"' : '' ?>>Poland</option>
	<option value="Portugal" <?php echo ($country == "Portugal")?  'selected="selected"' : '' ?>>Portugal</option>
	<option value="Puerto Rico" <?php echo ($country == "Puerto Rico")?  'selected="selected"' : '' ?>>Puerto Rico</option>
	<option value="Qatar" <?php echo ($country == "Qatar")?  'selected="selected"' : '' ?>>Qatar</option>
	<option value="Réunion" <?php echo ($country == "Réunion")?  'selected="selected"' : '' ?>>Réunion</option>
	<option value="Romania" <?php echo ($country == "Romania")?  'selected="selected"' : '' ?>>Romania</option>
	<option value="Russian Federation" <?php echo ($country == "Russian Federation")?  'selected="selected"' : '' ?>>Russian Federation</option>
	<option value="Rwanda" <?php echo ($country == "Rwanda")?  'selected="selected"' : '' ?>>Rwanda</option>
	<option value="Saint Barthélemy" <?php echo ($country == "Saint Barthélemy")?  'selected="selected"' : '' ?>>Saint Barthélemy</option>
	<option value="Saint Helena" <?php echo ($country == "Saint Helena")?  'selected="selected"' : '' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="Saint Kitts and Nevis" <?php echo ($country == "Saint Kitts and Nevis")?  'selected="selected"' : '' ?>>Saint Kitts and Nevis</option>
	<option value="Saint Lucia"<?php echo ($country == "Saint Lucia")?  'selected="selected"' : '' ?>>Saint Lucia</option>
	<option value="Saint Martin" <?php echo ($country == "Saint Martin")?  'selected="selected"' : '' ?>>Saint Martin (French part)</option>
	<option value="Saint Pierre and Miquelon" <?php echo ($country == "Saint Pierre and Miquelon")?  'selected="selected"' : '' ?>>Saint Pierre and Miquelon</option>
	<option value="Saint Vincent and the Grenadines" <?php echo ($country == "Saint Vincent and the Grenadines")?  'selected="selected"' : '' ?>>Saint Vincent and the Grenadines</option>
	<option value="Samoa" <?php echo ($country == "Samoa")?  'selected="selected"' : '' ?>>Samoa</option>
	<option value="San Marino" <?php echo ($country == "San Marino")?  'selected="selected"' : '' ?>>San Marino</option>
	<option value="Sao Tome and Principe" <?php echo ($country == "Sao Tome and Principe")?  'selected="selected"' : '' ?>>Sao Tome and Principe</option>
	<option value="Saudi Arabia" <?php echo ($country == "Saudi Arabia")?  'selected="selected"' : '' ?>>Saudi Arabia</option>
	<option value="Senegal" <?php echo ($country == "Senegal")?  'selected="selected"' : '' ?>>Senegal</option>
	<option value="Serbia" <?php echo ($country == "Serbia")?  'selected="selected"' : '' ?>>Serbia</option>
	<option value="Seychelles" <?php echo ($country == "Seychelles")?  'selected="selected"' : '' ?>>Seychelles</option>
	<option value="Sierra Leone" <?php echo ($country == "Sierra Leone")?  'selected="selected"' : '' ?>>Sierra Leone</option>
	<option value="Singapore" <?php echo ($country == "Singapore")?  'selected="selected"' : '' ?>>Singapore</option>
	<option value="Sint Maarten" <?php echo ($country == "Sint Maarten")?  'selected="selected"' : '' ?>>Sint Maarten (Dutch part)</option>
	<option value="Slovakia" <?php echo ($country == "Slovakia")?  'selected="selected"' : '' ?>>Slovakia</option>
	<option value="Slovenia" <?php echo ($country == "Slovenia")?  'selected="selected"' : '' ?>>Slovenia</option>
	<option value="Solomon Islands" <?php echo ($country == "Solomon Islands")?  'selected="selected"' : '' ?>>Solomon Islands</option>
	<option value="Somalia" <?php echo ($country == "Somalia")?  'selected="selected"' : '' ?>>Somalia</option>
	<option value="South Africa" <?php echo ($country == "South Africa")?  'selected="selected"' : '' ?>>South Africa</option>
	<option value="South Georgia and the South Sandwich Islands" <?php echo ($country == "South Georgia and the South Sandwich Islands")?  'selected="selected"' : '' ?>>South Georgia and the South Sandwich Islands</option>
	<option value="South Sudan" <?php echo ($country == "South Sudan")?  'selected="selected"' : '' ?>>South Sudan</option>
	<option value="Spain" <?php echo ($country == "Spain")?  'selected="selected"' : '' ?>>Spain</option>
	<option value="Sri Lanka" <?php echo ($country == "Sri Lanka")?  'selected="selected"' : '' ?>>Sri Lanka</option>
	<option value="Sudan" <?php echo ($country == "Sudan")?  'selected="selected"' : '' ?>>Sudan</option>
	<option value="Suriname" <?php echo ($country == "Suriname")?  'selected="selected"' : '' ?>>Suriname</option>
	<option value="Svalbard and Jan Mayen" <?php echo ($country == "Svalbard and Jan Mayen")?  'selected="selected"' : '' ?>>Svalbard and Jan Mayen</option>
	<option value="Swaziland" <?php echo ($country == "Swaziland")?  'selected="selected"' : '' ?>>Swaziland</option>
	<option value="Sweden" <?php echo ($country == "Sweden")?  'selected="selected"' : '' ?>>Sweden</option>
	<option value="Switzerland"<?php echo ($country == "Switzerland")?  'selected="selected"' : '' ?>>Switzerland</option>
<option value="Syrian Arab Republic" <?php echo ($country == "Syrian Arab Republic")?  'selected="selected"' : '' ?>>Syrian Arab Republic</option>
	<option value="Taiwan, Province of China" <?php echo ($country == "Taiwan, Province of China")?  'selected="selected"' : '' ?>>Taiwan, Province of China</option>
	<option value="Tajikistan" <?php echo ($country == "Tajikistan")?  'selected="selected"' : '' ?>>Tajikistan</option>
	<option value="Tanzania, United Republic of" <?php echo ($country == "Tanzania, United Republic of")?  'selected="selected"' : '' ?>>Tanzania, United Republic of</option>
	<option value="Thailand" <?php echo ($country == "Thailand")?  'selected="selected"' : '' ?>>Thailand</option>
	<option value="Timor-Leste" <?php echo ($country == "Timor-Leste")?  'selected="selected"' : '' ?>>Timor-Leste</option>
	<option value="Togo" <?php echo ($country == "Togo")?  'selected="selected"' : '' ?>>Togo</option>
	<option value="Tokelau" <?php echo ($country == "Tokelau")?  'selected="selected"' : '' ?>>Tokelau</option>
	<option value="Tonga" <?php echo ($country == "Tonga")?  'selected="selected"' : '' ?>>Tonga</option>
	<option value="Trinidad and Tobago" <?php echo ($country == "Trinidad and Tobago")?  'selected="selected"' : '' ?>>Trinidad and Tobago</option>
	<option value="Tunisia" <?php echo ($country == "Tunisia")?  'selected="selected"' : '' ?>>Tunisia</option>
	<option value="Turkey" <?php echo ($country == "Turkey")?  'selected="selected"' : '' ?>>Turkey</option>
	<option value="Turkmenistan" <?php echo ($country == "Turkmenistan")?  'selected="selected"' : '' ?>>Turkmenistan</option>
	<option value="Turks and Caicos Islands" <?php echo ($country == "Turks and Caicos Islands")?  'selected="selected"' : '' ?>>Turks and Caicos Islands</option>
	<option value="Tuvalu" <?php echo ($country == "Tuvalu")?  'selected="selected"' : '' ?>>Tuvalu</option>
	<option value="Uganda" <?php echo ($country == "Uganda")?  'selected="selected"' : '' ?>>Uganda</option>
	<option value="Ukraine" <?php echo ($country == "Ukraine")?  'selected="selected"' : '' ?>>Ukraine</option>
	<option value="United Arab Emirates" <?php echo ($country == "United Arab Emirates")?  'selected="selected"' : '' ?>>United Arab Emirates</option>
	<option value="United Kingdom" <<?php echo ($country == "United Kingdom")?  'selected="selected"' : '' ?>>United Kingdom</option>
	<option value="United States" <?php echo ($country == "United States")?  'selected="selected"' : '' ?>>United States</option>
	<option value="United States Minor Outlying Islands" <?php echo ($country == "United States Minor Outlying Islands")?  'selected="selected"' : '' ?>>United States Minor Outlying Islands</option>
	<option value="Uruguay" <?php echo ($country == "Uruguay")?  'selected="selected"' : '' ?>>Uruguay</option>
	<option value="Uzbekistan" <?php echo ($country == "Uzbekistan")?  'selected="selected"' : '' ?>>Uzbekistan</option>
	<option value="Vanuatu" <?php echo ($country == "Vanuatu")?  'selected="selected"' : '' ?>>Vanuatu</option>
	<option value="Venezuela, Bolivarian Republic of" <?php echo ($country == "Venezuela, Bolivarian Republic of")?  'selected="selected"' : '' ?>>Venezuela, Bolivarian Republic of</option>
	<option value="Viet Nam" <?php echo ($country == "Viet Nam")?  'selected="selected"' : '' ?>>Viet Nam</option>
	<option value="Virgin Islands, British" <?php echo ($country == "Virgin Islands, British")?  'selected="selected"' : '' ?>>Virgin Islands, British</option>
	<option value="Virgin Islands, U.S."<?php echo ($country == "Virgin Islands, U.S.")?  'selected="selected"' : '' ?>>Virgin Islands, U.S.</option>
	<option value="Wallis and Futuna" <?php echo ($country == "Wallis and Futuna")?  'selected="selected"' : '' ?>>Wallis and Futuna</option>
	<option value="Western Sahara" <?php echo ($country == "Western Sahara")?  'selected="selected"' : '' ?>>Western Sahara</option>
	<option value="Yemen" <?php echo ($country == "Yemen")?  'selected="selected"' : '' ?>>Yemen</option>
	<option value="Zambia" <?php echo ($country == "Zambia")?  'selected="selected"' : '' ?>>Zambia</option>
	<option value="Zimbabwe" <?php echo ($country == "Zimbabwe")?  'selected="selected"' : '' ?>>Zimbabwe</option>
                    </select>
  <span id="usercountry" class="info"></span>


      </div>

          <div class="from-group col-md-6">
          <input id="location" type="text" class="from-control input-field" placeholder="Location*" name="location" value="<?php echo $location;?>" />
           <span id="userlocation" class="info"></span>
            </div>
            <div class="from-group col-md-6">
                <input id="investment_from" type="text" class="from-control input-field" placeholder="Investment Range From*" name="investment_from" pattern="\d+(\.\d{2})?" value="<?php echo $rangefrom;?>" />
                 <span id="userinvestment_from" class="info"></span>
            </div>
            <div class="from-group col-md-6">
            <input id="investment_to" type="text" class="from-control input-field" placeholder="Investment Range To*" name="investment_to" pattern="\d+(\.\d{2})?" value="<?php echo $rangeto;?>" />
            <span id="userinvestment_to" class="info"></span>
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