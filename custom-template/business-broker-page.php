<?php
/*
 Display Template Name: Business Broker
*/
get_header();
?>
<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> / <span>Business Broker</span>
			</div>
		</div>
	</div>
</section>
     
<section class="busniess_broker">
<div class="container">
<div class="row"> 
<div class="col-md-4 col-lg-3">
<div class="filter_broker">
<h4>Find a <span>Business</span> Broker</h4>

<form action="" name="search" method="POST">
		<div class="form-group select_box">
			<span class="select_border"></span>
			<?php
$countries = $wpdb->get_col("SELECT Distinct(c.meta_value) FROM $wpdb->usermeta AS r INNER JOIN $wpdb->usermeta AS c ON r.user_id = c.user_id WHERE r.meta_value LIKE '%broker%' AND c.meta_key = 'country'");
	/*echo "<pre>";
print_r( $countries );*/
		?>
		<select class="from-control" name="country_name">
			<option value="">All Counties</option>
			<?php foreach($countries as $country){ ?>
			<option value="<?php echo $country;?>" <?php echo ($_POST['country_name'] == ''.$country.'') ? ' selected="selected"' : '';?>><?php echo $country;?></option>
		<?php } ?>
		</select>
	 </div>
	<div class="form-group select_box">
		<span class="select_border"></span>
		<?php echo get_user_meta($user->ID, 'state', true); ?>
		<?php
$states = $wpdb->get_col("SELECT DISTINCT(meta_value) FROM $wpdb->usermeta WHERE meta_key = 'state'" );
/*echo "<pre>";
print_r( $states );*/
	?>
		<select class="from-control" name="state_name">
			<option value="">Select a state.</option>
			<?php foreach($states as $state){ ?>
			<option value="<?php echo $state;?>" <?php echo ($_POST['state_name'] == ''.$state.'') ? ' selected="selected"' : '';?>><?php echo $state;?></option>
		<?php } ?>
		</select>
	 </div>
	<div class="form-group">
		<input type="text" placeholder="City (optional)" class="from-control" name="city_name" value="<?php echo $_POST['city_name'];?>">
	 </div>
	<div class="form-group">
		<input type="text" placeholder="Keyword (optional)" class="from-control" name="Keywords" id="Keywords" value="<?php echo $_POST['Keywords'];?>">
	 </div>

	<!-- <div class="form-group"> 
		<label class="input-checkbox"> 
			<input type="checkbox" name=""> Member of Broker Association  <span class="checkmark"></span>
		</label> </div> -->

	<!-- <div class="form-group"> 
		<label class="input-checkbox"> 
			<input type="checkbox" name=""> Certified Broker  <span class="checkmark"></span>
		</label> </div> -->
	<!-- <div class="form-group"> 
		<label class="input-checkbox"> 
			<input type="checkbox" name=""> Licensed Broker <span class="checkmark"></span>
		</label> </div> -->

	<div class="form-group"> 
		<input type="submit" name="submit" value="Search" class="btn">
	 </div>

</form>

<div class="new_user"> 

<h4>New <span>User</span></h4>
<p>Whether you are a buyer, seller
or broker we have a range of 
services to help you.</p>

<div class="register_btn">
<a href="<?php echo site_url();?>/buyer-register/" class="btn">Register to Buy a Business</a>
</div>
<div class="register_btn">
<a href="<?php echo site_url();?>/seller-register/" class="btn">Register to Sell a Business</a>
</div>
</div>




 </div>
 </div>

<div class="col-md-8 col-lg-9">
<div class="busniess_broker_wrapper">

<div class="section-heading">
<h1>Top <span>Brokers</span></h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem 
Ipsum has been the industry's standard dummy </p>
 </div>

<div class="row">
<?php
global $wp_query;
$country_name = $_POST['country_name'];
$state_name = $_POST['state_name'];
$city_name = $_POST['city_name'];
$search = $_POST['Keywords'];
if($country_name || $state_name || $city_name || $search){
?>
<?php
 $meta_query = array('relation'=>'AND');
  if(!empty($country_name)){
    $meta_query[] = array(
       'key' => 'country',
        'value' => $country_name,
        'compare' => 'LIKE'
        
      );
  }
  if(!empty($state_name)){
    $meta_query[] = array(
       'key' => 'state',
        'value' => $state_name,
        'compare' => 'LIKE'
        
      );
  }

  if(!empty($city_name)){
    $meta_query[] = array(
       'key' => 'city',
        'value' => $city_name,
        'compare' => 'LIKE'
        
      );
  }
?>
<?php
$roles = array('broker');
$users = array();
foreach($roles as $role){
    $args = array(
                 'orderby' => 'nicename',
                 'role' => $role,
                 'search' => '*' . $search . '*',
                 'meta_query' => $meta_query
                 );
    $current_role_users = get_users($args);
    $users = array_merge($current_role_users, $users);

    /* echo '<pre>';   
        print_r($users);
         echo '<pre>';*/
}
if($users) {
    foreach ($users as $user) {
?>

<div class="col-lg-4 col-md-6 mb-20">
				 <div class="sale_listing">
					<div class="sale_pic">
       <?php $images = get_the_author_meta( 'profile_image', $user->ID );
             $images = explode(',',$images);
             foreach($images as $img) {
             ?>
             
		     <a href="<?php echo get_author_posts_url($user->ID); ?>"><img src="<?php echo wp_get_attachment_url( $img );?>"></a>
		       <?php } ?>
					</div>
					<h4 class="broker_name"><a href="<?php echo get_author_posts_url($user->ID); ?>"><?php echo $user->display_name;?></a></h4>

					<p class="dec"><?php echo get_user_meta($user->ID, 'user_destination', true); ?> <span> <?php echo get_user_meta($user->ID, 'state', true); ?>, <?php echo get_user_meta($user->ID, 'country', true); ?></span></p>
                    <div class="more_details">
					<a href="<?php echo get_author_posts_url($user->ID); ?>">More Details</a>
					</div>
                  </div>
				</div>

<?php 
  } 
?>
<?php } else { ?>
<div class="col-lg-12 col-md-6 mb-20">
 <h2>No users found</h2>
</div>
<?php } ?>
</div>
 <?php } else { ?>
<?php
$number = 9;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $number;

$args = array(
    'role' => 'broker',
    'orderby' => 'nicename',
    //'order' => 'ASC',
);
$users = get_users($args);
$args = array(
    'role' => 'broker',
    'orderby' => 'nicename',
    'order' => 'ASC',
    'number' => $number,
    'offset' => $offset
);
$meber_arr = get_users($args);
$total_users = count($users);
$total_query = count($meber_arr);
$total_pages = ceil($total_users / $number);

 foreach ($meber_arr as $user) {
?>
<div class="col-lg-4 col-md-6 mb-20">
				 <div class="sale_listing">
					<div class="sale_pic">
       <?php $images = get_the_author_meta( 'profile_image', $user->ID );
             $images = explode(',',$images);
             foreach($images as $img) {
             ?>
             
		     <a href="<?php echo get_author_posts_url($user->ID); ?>"><img src="<?php echo wp_get_attachment_url( $img );?>"></a>
		       <?php } ?>
					</div>
					<h4 class="broker_name"><a href="<?php echo get_author_posts_url($user->ID); ?>"><?php echo $user->display_name;?></a></h4>

					<p class="dec"><?php echo get_user_meta($user->ID, 'user_destination', true); ?> <span> <?php echo get_user_meta($user->ID, 'state', true); ?>, <?php echo get_user_meta($user->ID, 'country', true); ?></span></p>
                    <div class="more_details">
					<a href="<?php echo get_author_posts_url($user->ID); ?>">More Details</a>
					</div>
                  </div>
				</div>
<?php 
  } 
?>
</div>
<div class="broker_pagication">

<div class="pagination_bar">
<nav class="pagination1">
	<!-- <a class="prev page-numbers" href="#">Next »</a>
        <span aria-current="page" class="page-numbers current">1</span>
<a class="page-numbers" href="#">2</a>
<a class="page-numbers" href="#">3</a>
<a class="page-numbers" href="#">4</a>
<a class="page-numbers" href="#">256</a>
<a class="next page-numbers" href="#">Next »</a>   -->  
   
<?php
$big = 999999999; // need an unlikely integer
$mypagei = paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '&p=%#%',
    'prev_text' => __('&laquo; Previous'),
    'next_text' => __('Next &raquo;'),
    'total' => $total_pages,
    'current' => $paged,
    'end_size' => 1,
    'mid_size' => 5,
));

if ($mypagei != '') {
echo $mypagei; 
}
?>
</nav>
 </div>
 </div>

 <?php } ?>
	<div class="row"> 

 </div>

 </div>
 </div>
</div>
</div>
</section>
<?php get_footer();?>