<?php
/*
 Display Template Name: Buy a Business
*/
session_start();
get_header();




if(empty($_SESSION["countrycode"])){
 $_SESSION["countrycode"] = 100;
}
if(empty($_SESSION["statecode"])){
	 $_SESSION["statecode"] = 732;
}
if(empty($_SESSION["citycode"])){
	 $_SESSION["citycode"] = 3356;
}

 //unset($_SESSION['countrycode']);
 /// unset($_SESSION['statecode']);
//   unset($_SESSION['citycode']);

//unset($_SESSION['filterserch']);
if($_POST['submit'] == 'Reset'){
	 unset($_SESSION['filterserch']);
     unset($_SESSION['countrycode']);
     unset($_SESSION['statecode']);
     unset($_SESSION['citycode']);

     wp_redirect('http://demosrvr.com/wp/getabusiness/buy-a-business');
exit;

}
if($_POST['business_type'] && $_POST['searchlocation']){

				   $business_type =  $_POST['business_type'];
				   $searchlocation =  $_POST['searchlocation'];

                   
                   $meta_query[] = array(
				    'key' => 'location',
				    'value' =>  $searchlocation,
				    'compare' => 'LIKE'
				  );

				    

				    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				    $args = array('post_type' => 'buy', 'posts_per_page' => 6,  'order' => 'DASC','tax_query' => array(array('taxonomy' => 'business-type','field' => 'name','terms' => $business_type)),
				    	'meta_query' => $meta_query,'paged' => $paged);
                   /* echo '<pre>';
				    print_r($args);
				    echo '</pre>';
                    die();*/


				}
                 elseif($_POST['submit'] == 'Search'){


                 	$_SESSION['filterserch'] = $_POST;

                    $listing_tags = $_POST['listing_tags'];
                    $lcation = $_POST['lcation'];
                    $typeofbussiness = $_POST['typeofbussiness'];

                     $from_price = $_POST['from_price'];
                     $to_price = $_POST['to_price'];


     $country_id = $_POST['gender'];
    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 
    


    $state_id = $_POST['ucity'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     

       $city_id = $_POST['ucity11'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 
    

   
                    

                   $tax_query = array('relation' => 'AND');

                   if(isset($typeofbussiness)&&$typeofbussiness!=""){

                       $tax_query[1]['relation'] =  'OR'; 
						foreach ($typeofbussiness as $ct) {
						$tax_query[1][] = array(
						'taxonomy' => 'business-feature',
						'field' => 'slug',
						'terms' => $ct,
						);
						}


					}

                  if(isset($listing_tags)&&$listing_tags!=""){

                       $tax_query[1]['relation'] =  'OR'; 
						foreach ($listing_tags as $ct) {
						$tax_query[1][] = array(
						'taxonomy' => 'business-category',
						'field' => 'slug',
						'terms' => $ct,
						);
						}


					}
					
								
                    $meta_query = array('relation'=>'AND');

                    

					if($lcation){
						$meta_query[1]['relation'] =  'OR'; 
						foreach ($lcation as $gr) {
							if($gr){
							$meta_query[1][] = array(
							'key' => 'location',
							'value' => $gr,
							'compare' => 'LIKE',
							);
						}
						}	
					}

					if($from_price){
							
						$meta_query[] = array(
						'key' => 'bprice',
							'value' => $from_price,
							'compare' => '>=',
						);
						}
						if($to_price){
						$meta_query[] = array(
						'key' => 'bprice',
							'value' => $to_price,
							'compare' => '<=',
						);
						}


						if($country_name){
						$meta_query[] = array(
						'key' => 'country',
							'value' => $country_name,
							'compare' => 'LIKE',
						);
						}
						if($state_name){
						$meta_query[] = array(
						'key' => 'state',
							'value' => $state_name,
							'compare' => 'LIKE',
						);
						}
						if($city_name){
						$meta_query[] = array(
						'key' => 'city',
							'value' => $city_name,
							'compare' => 'LIKE',
						);
						}



                 	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				    $args = array('post_type' => 'buy', 'posts_per_page' => 6,  'order' => 'DASC','tax_query' => $tax_query,
                         'meta_query' => $meta_query,
				    	'paged' => $paged);

                   /* echo '<pre>'; 
				    print_r($args);
				    echo '</pre>'; */
   
                    

                 }


               elseif($_POST['submit'] == 'Update'){


                 	$_SESSION['filterserch'] = $_POST;

                    $listing_tags = $_POST['listing_tags'];
                    $lcation = $_POST['lcation'];
                    $typeofbussiness = $_POST['typeofbussiness'];

                     $from_price = $_POST['from_price'];
                     $to_price = $_POST['to_price'];


     $country_id = $_POST['gender'];
    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 
    


    $state_id = $_POST['ucity'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     

       $city_id = $_POST['ucity11'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 
    

   
                    

                   $tax_query = array('relation' => 'AND');

                   if(isset($typeofbussiness)&&$typeofbussiness!=""){

                       $tax_query[1]['relation'] =  'OR'; 
						foreach ($typeofbussiness as $ct) {
						$tax_query[1][] = array(
						'taxonomy' => 'business-feature',
						'field' => 'slug',
						'terms' => $ct,
						);
						}


					}

                  if(isset($listing_tags)&&$listing_tags!=""){

                       $tax_query[1]['relation'] =  'OR'; 
						foreach ($listing_tags as $ct) {
						$tax_query[1][] = array(
						'taxonomy' => 'business-category',
						'field' => 'slug',
						'terms' => $ct,
						);
						}


					}
					
								
                    $meta_query = array('relation'=>'AND');

                    

					if($lcation){
						$meta_query[1]['relation'] =  'OR'; 
						foreach ($lcation as $gr) {
							if($gr){
							$meta_query[1][] = array(
							'key' => 'location',
							'value' => $gr,
							'compare' => 'LIKE',
							);
						}
						}	
					}

					if($from_price){
							
						$meta_query[] = array(
						'key' => 'bprice',
							'value' => $from_price,
							'compare' => '>=',
						);
						}
						if($to_price){
						$meta_query[] = array(
						'key' => 'bprice',
							'value' => $to_price,
							'compare' => '<=',
						);
						}


						if($country_name){
						$meta_query[] = array(
						'key' => 'country',
							'value' => $country_name,
							'compare' => 'LIKE',
						);
						}
						if($state_name){
						$meta_query[] = array(
						'key' => 'state',
							'value' => $state_name,
							'compare' => 'LIKE',
						);
						}
						if($city_name){
						$meta_query[] = array(
						'key' => 'city',
							'value' => $city_name,
							'compare' => 'LIKE',
						);
						}



                 	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				    $args = array('post_type' => 'buy', 'posts_per_page' => 6,  'order' => 'DASC','tax_query' => $tax_query,
                         'meta_query' => $meta_query,
				    	'paged' => $paged);

                   /* echo '<pre>'; 
				    print_r($args);
				    echo '</pre>'; 
				    die();*/
   
                    

                 }

				else{
	             $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				 $args = array('post_type' => 'buy', 'posts_per_page' => 6, 'order' => 'DASC', 'paged' => $paged);
                }
               $query = new WP_Query($args);
?>

<?php



 if($_GET['ctstid'] ||  $_GET['ctid'] || $_GET['ctctid']){



    $countrycode =	$_GET['ctid'];
    


    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$countrycode." AND status = 1";
    $sqlquery  = $wpdb->get_results($sqlcountry);
    $country_name =   $sqlquery['0']->country_name; 


  $state_id = $_GET['ctstid'];
    $sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
    $sqlstate7  = $wpdb->get_results($sqlstate);
    $state_name =   $sqlstate7['0']->state_name; 
     

       $city_id = $_GET['ctctid'];
      $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
      $sqlcityy7  = $wpdb->get_results($sqlcity);
      $city_name =   $sqlcityy7['0']->city_name; 







   $meta_query = array('relation'=>'AND');

    if($country_name){
		$meta_query[] = array(
		'key' => 'country',
		'value' => $country_name,
		'compare' => 'LIKE',
		);
	}

		if($state_name){
						$meta_query[] = array(
						'key' => 'state',
							'value' => $state_name,
							'compare' => 'LIKE',
						);
						}
						if($city_name){
						$meta_query[] = array(
						'key' => 'city',
							'value' => $city_name,
							'compare' => 'LIKE',
						);
						}


	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				    $args = array('post_type' => 'buy', 'posts_per_page' => 6,  'order' => 'DASC','tax_query' => $tax_query,
                         'meta_query' => $meta_query,
				    	'paged' => $paged);
				    	$query = new WP_Query($args);




}

?>
<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> / <span>Listings</span>
			</div>
		</div>
	</div>
</section>
<form name="busearching" method="POST" id="busearching1">
<section class="fliter_listing_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<div class="filter_section">
					<h2>Filter <span>By</span></h2>
					<div class="business_category_filter">
						<h4>Business</h4>
					<!-- <?php
$taxonomies = array( 
    'business-category'
);
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
);

$terms = get_terms($taxonomies,$args);

if (count($terms) > 0):
$i = 0;
    foreach ($terms as $term): ?>
        <div class="listing_tag_list">
        	
         
            <input type="radio"  value="<?php echo $term->slug; ?>"  name="listing_tags" class="listing_tag_list_ckb" <?php if($_SESSION['filterserch']['listing_tags'] == $term->slug){ echo 'checked'; } ?>>
            <label class="listing_tag_list_ckbl">
                <?php echo $term->name; ?>
            </label>


           
        </div>

<?php
    $i++; endforeach;
endif; ?> -->



     <ul id="myUL177">


       	<?php
$taxonomies = array( 
    'business-category'
);
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
);
 $selected_features = array();
 $propertyfeature = $_SESSION['filterserch']['listing_tags'];
 if($propertyfeature){
foreach($propertyfeature as $features) {
array_push($selected_features, $features);
}

}

$terms = get_terms($taxonomies,$args);
?>

       	<?php
    foreach ($terms as $term): ?>
  
<?php 
 if (in_array($term->slug, $selected_features)) {
?>
 <li class="listing_tag_list"><label class="input-checkbox"><input type="checkbox" checked="checked" name="listing_tags[]"  value="<?php echo $term->slug; ?>"> <a href="javascript:void(0)" style="color: #fff;"><?php echo $term->name; ?></a><span class="checkmark white"></span></label></li>
<?php }else{ ?>
	<li class="listing_tag_list"><label class="input-checkbox"><input type="checkbox"  name="listing_tags[]" value="<?php echo $term->slug; ?>"> <a href="javascript:void(0)" style="color: #fff;"><?php echo $term->name; ?></a><span class="checkmark white"></span></label></li>

<?php } ?>

 <?php
    endforeach;
    ?>
 
 
  
</ul>


<div class="show-more">Show more</div>

<input class="form-control" type="submit" name="submit" value="Update">

      </div>

      <div class="location_filter">


      	<div class="outercounrycontent">

    	<span id="countryid">
      		
      		<?php 
                
                if($_GET['ctid']){
                    $_SESSION["countrycode"] = $_GET['ctid'];
                    $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$_SESSION["countrycode"]." AND status = 1";
			    $sqlquery  = $wpdb->get_results($sqlcountry);
			   echo  $sqlquery['0']->country_name; 


		     $sqlquery  = $wpdb->get_results("SELECT * FROM states WHERE country_id = ".$_GET['ctid']." AND status = 1 ORDER BY state_name ASC");
		     $radioValue1 = $sqlquery['0']->state_id;
		     $sqlquery114  = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$radioValue1." AND status = 1 ORDER BY city_name ASC");
		     $radioValue2 = $sqlquery114['0']->city_id;

       $_SESSION["statecode"] = $radioValue1;
       $_SESSION["citycode"] = $radioValue2;



                 }else{


                 	$country_id = $_SESSION["countrycode"];
			        $sqlcountry =  "SELECT * FROM countries WHERE country_id = ".$country_id." AND status = 1";
			        $sqlquery  = $wpdb->get_results($sqlcountry);
			        $country_name =  $sqlquery['0']->country_name;
					if(isset($country_name)){
					echo 'Select Country';
					} else {
					echo $country_name;
					} 


                 }

      		
      		?>
      	</span>

	

	<div class="trigger">
	<a id="region-trigger-1"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
	</div>




       <div class="outercountry" style="display: none;">
		<div class="row">
		<div class="col-12">
	    
		<div class="input-group input-group-sm">
		<span class="form-control-label"> <i class="fas fa-map-marker-alt"></i></span>
		<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Location">
        </div>
		</div>
		</div>
	 <ul id="myUL">
		<?php
		global $wpdb;
		$sqlquery = $wpdb->get_results("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");

		?>
		<?php
		foreach ($sqlquery as  $value) {
		?>
		<li><a href="<?php echo bloginfo('url'); ?>/buy-a-business/?ctid=<?php echo $value->country_id; ?>" style="color: #fff;"><?php echo $value->country_name; ?></a></li>
		<?php
		}
		?>
<div class="show-more-country">Show more</div>
</ul>
</div>
</div>

<div class="outersatecontent">
<span id="countryid">
		<?php 


  if($_GET['ctstid']){

   $_SESSION["statecode"] = $_GET['ctstid'];
		$sqlstate =  "SELECT * FROM states WHERE state_id = ".$_SESSION["statecode"]." AND status = 1";
		$sqlstate7  = $wpdb->get_results($sqlstate);
		echo $state_name =   $sqlstate7['0']->state_name; 

      
   $sqlquery114  = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$_GET['ctstid']." AND status = 1 ORDER BY city_name ASC");
   $radioValue2 = $sqlquery114['0']->city_id;
   $_SESSION["citycode"] = $radioValue2;

  }else{

  	    $state_id = $_SESSION["statecode"];
		$sqlstate =  "SELECT * FROM states WHERE state_id = ".$state_id." AND status = 1";
		$sqlstate7  = $wpdb->get_results($sqlstate);
		$state_name =   $sqlstate7['0']->state_name; 
		if(isset($state_name)){
			echo 'Select State';
		} else {
			echo $state_name;
		}
  }

		
		?>
      	</span>
        <div class="trigger">
		<a id="region-trigger-41"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
		</div>
		
		<div class="outerstate" style="display: none;">
		<div class="row">
		<div class="col-12">
	    
		<div class="input-group input-group-sm">
		<span class="form-control-label"> <i class="fas fa-map-marker-alt"></i></span>
		<input type="text" id="myInput11" class="form-control" onkeyup="myFunction11()" placeholder="Location">
        </div>
		</div>
		</div>
	 <ul id="myUL11">
		<?php
          if($_SESSION["countrycode"]){
     		$country_id = $_SESSION["countrycode"];

		}else{
			//$country_id = 100;
		}
		global $wpdb;
	   $sqlquery44 = $wpdb->get_results("SELECT * FROM states WHERE country_id = ".$country_id." AND status = 1 ORDER BY state_name ASC");
  
		?>
		<?php
		foreach ($sqlquery44 as  $value) {
		?>
		<li>


     <a href="<?php echo bloginfo('url'); ?>/buy-a-business/?<?php if($_GET['ctid']){ echo 'ctid='.$_GET['ctid'].'&'; } ?>ctstid=<?php echo $value->state_id; ?>" style="color: #fff;"><?php echo $value->state_name; ?></a></li>
		<?php
		}
		?>
<div class="show-more-country">Show more</div>
</ul>
</div>
</div>

<div class="outercitycontent">


<span id="countryid">
      		
      		<?php 


              if($_GET['ctctid']){

            $_SESSION["citycode"] = $_GET['ctctid'];

            $sqlcity =  "SELECT * FROM cities WHERE city_id = ".$_SESSION["citycode"]." AND status = 1";
				$sqlcityy7  = $wpdb->get_results($sqlcity);
				echo $city_name =   $sqlcityy7['0']->city_name; 

              }else{

              	$city_id = $_SESSION["citycode"];
				
				$sqlcity =  "SELECT * FROM cities WHERE city_id = ".$city_id." AND status = 1";
				$sqlcityy7  = $wpdb->get_results($sqlcity);
				$city_name =   $sqlcityy7['0']->city_name;
					if(isset($city_name)){
					echo 'Select City';
					} else {
					echo $city_name;
					}
              }    

      		?>
      	</span>

<div class="trigger">
		<a id="region-trigger-42"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
		</div>
		
		<div class="outercity" style="display: none;">
		<div class="row">
		<div class="col-12">
	   
		<div class="input-group input-group-sm">
		<span class="form-control-label"> <i class="fas fa-map-marker-alt"></i></span>
		<input type="text" id="myInput22" class="form-control" onkeyup="myFunction22()" placeholder="Location">
        </div>
		</div>
		</div>
		<ul id="myUL22">
		<?php
		if($_SESSION["statecode"]){
		$statecode = $_SESSION["statecode"];	
		}else{
			//$statecode = 752;
		}
	    
		global $wpdb;
		$sqlquery44 = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$statecode." AND status = 1 ORDER BY city_name ASC");
	    ?>
		<?php
		foreach ($sqlquery44 as  $value) 
		{
		?>
		<li><a href="<?php echo bloginfo('url'); ?>/buy-a-business/?<?php if($_GET['ctstid']){ echo 'ctstid='.$_GET['ctstid'].'&'; } ?><?php if($_GET['ctid']){ echo 'ctid='.$_GET['ctid'].'&'; } ?>ctctid=<?php echo $value->city_id; ?>" style="color: #fff;"><?php echo $value->city_name; ?></a></li>
		<?php
		}
		?>
		<div class="show-more-country">Show more</div>
		</ul>
</div>
</div>


      </div>

      <div class="location_filter buttonsfetured">
		<form role="form">
		<div class="row">
		<div class="col-12">
		<div class="input-group input-group-sm">
		<span class="form-control-label"> <i class="fas fa-sitemap"></i></span>
		<input type="text" id="myInput1" class="form-control" onkeyup="myFunction1()" placeholder="Business feature">
        </div>
		</div>
		</div>
		</form>
		 
       <ul id="myUL1">


       	<?php
$taxonomies = array( 
    'business-feature'
);
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
);
 $selected_features = array();
 $propertyfeature = $_SESSION['filterserch']['typeofbussiness'];
 if($propertyfeature){
foreach($propertyfeature as $features) {
array_push($selected_features, $features);
}

}



$terms = get_terms($taxonomies,$args);
?>

       	<?php
    foreach ($terms as $term): ?>
  
<?php 
 if (in_array($term->slug, $selected_features)) {
?>
 <li><label class="input-checkbox"><input type="checkbox" checked="checked" name="typeofbussiness[]" value="<?php echo $term->slug; ?>"> <a href="javascript:void(0)" style="color: #fff;"><?php echo $term->name; ?></a><span class="checkmark white"></span></label></li>
<?php }else{ ?>
	<li><label class="input-checkbox"><input type="checkbox"  name="typeofbussiness[]" value="<?php echo $term->slug; ?>"> <a href="javascript:void(0)" style="color: #fff;"><?php echo $term->name; ?></a><span class="checkmark white"></span></label></li>

<?php } ?>

 <?php
    endforeach;
    ?>
 
 
  
</ul>

<input class="form-control" type="submit" name="submit" value="Update">

      </div>


  <input type="hidden" id="customstateid" name="customstateid" value="<?php if(isset($_SESSION['filterserch']['customstateid'])){ echo $_SESSION['filterserch']['customstateid']; } ?>">

      <div class="price_filter_section">
      	<h4>Price</h4>
      	<p>Asking <span>Price</span> <span id="currencycode"></span></p>
      	
      		<div class="row">
      			<div class="col-lg-4">
      				<input type="text" name="from_price" value="<?php if(isset($_SESSION['filterserch']['from_price'])){ echo $_SESSION['filterserch']['from_price']; } ?>" class="form-control" placeholder="From">
      			</div>
      			<div class="col-lg-4">
      				<input type="text" name="to_price" value="<?php if(isset($_SESSION['filterserch']['to_price'])){ echo $_SESSION['filterserch']['to_price']; } ?>" class="form-control" placeholder="To">
      			</div>
      			<div class="col-lg-4 submit-btn">
      				<!-- <span class="form-control-label"><img src="../images/search_icon.png"></span> -->
      				<input class="form-control" type="submit" name="submit" value="Search">
      			</div>
      			
      		</div>
      	
      </div>
<div class="reset-btn">
      				<!-- <span class="form-control-label"><img src="../images/search_icon.png"></span> -->
      				<input class="form-control" type="submit" name="submit" value="Reset">
      			</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8">
			<?php while(have_posts()): the_post();?>
				<div class="buy_business_wrapper">
					<h1><?php the_title();?></h1>
					<?php the_content();?>
				</div>
			<?php endwhile;?>
            <div class="listing_section">
            	<div class="row">
                    <?php
               
			 if ($query->have_posts()){
			 	unset($_SESSION['countrycode44444']);
			 while($query->have_posts()): $query->the_post();
			 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			 ?>
            		<div class="col-lg-6 col-6">
            			 <div class="sale_listing">
					<div class="sale_pic">
						<a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $large_image_url[0]);?>"></a>
					</div>
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $price = get_post_meta( get_the_ID(), 'bprice', 1 );?>
					<?php if($price){ ?>
					<p class="price"><span>Price:</span> 
                      <?php
                       if($_SESSION['filterserch']['country'] == '100'){
                       	echo '₹';

                       }
                        if($_SESSION['filterserch']['country'] == '224'){
                       	echo '$';

                       }
                        if($_SESSION['filterserch']['country'] == '77'){
                       	echo '£';

                       }
                      ?>

						<?php echo $price;?>
                      <?php
                       if($_SESSION['filterserch']['country'] == '100'){
                       	echo 'INR';

                       }
                        if($_SESSION['filterserch']['country'] == '224'){
                       	echo 'USD';

                       }
                        if($_SESSION['filterserch']['country'] == '8'){
                       	echo 'Pound';

                       }
                      ?>
					</p>
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
            		</div>
               <?php
				endwhile;
			}else{
				unset($_SESSION['countrycode44444']);
				echo 'Not found';
			}
				?>
            	</div>
            </div>
            <div class="pagination_bar">
<nav class="pagination1">
        <?php pagination_bar( $query ); ?>
    </nav>
    </div>
 <?php
wp_reset_postdata();

?>


			</div>
		</div>
	</div>
</section>
</form>



<?php
get_footer();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/jquery.treefilter.css">
<script src="<?php bloginfo('template_url');?>/js/jquery.treefilter.js"></script>
<script>
$(function() {

	var tree = new treefilter($("#my-tree"), {
		searcher : $("input#my-search"),
		multiselect : false
	});
});
</script>

<script>
$(function() {

	var tree = new treefilter($("#my-tree1"), {
		searcher : $("input#my-search1"),
		multiselect : false
	});
});
</script>
<script type="text/javascript">
	if ($('.listing_tag_list').length > 5) {
  $('.listing_tag_list:gt(4)').hide();
  $('.show-more').show();
}

$('.show-more').on('click', function() {
  //toggle elements with class .ty-compact-list that their index is bigger than 2
  $('.listing_tag_list:gt(4)').toggle();
  //change text of show more element just for demonstration purposes to this demo
  $(this).text() === 'Show more' ? $(this).text('Show less') : $(this).text('Show more');
});
</script>
<script type="text/javascript">
	if ($('#myUL li').length > 12) {
  $('#myUL li:gt(11)').hide();
  $('.show-more-country').show();
}

$('.show-more-country').on('click', function() {
  //toggle elements with class .ty-compact-list that their index is bigger than 2
  $('#myUL li:gt(11)').toggle();
  //change text of show more element just for demonstration purposes to this demo
  $(this).text() === 'Show more' ? $(this).text('Show less') : $(this).text('Show more');
});
</script>

<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myFunction11() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput11");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL11");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myFunction22() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput22");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL22");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<script>
function myFunction1() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput1");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL1");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<script type="text/javascript">
jQuery(document).ready(function(){

	  var countryID1 = $("#country").val();
	  var customstateid = $("#customstateid").val();

	  if(customstateid){

            $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'state_id='+customstateid,
                success:function(html){

                    $('#city').html(html);

                }
            }); 
        }
	  
	  
	  if(countryID1){

	  	jQuery.ajax({
						type:'post',
						url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
	                    data: 'country_id='+countryID1,
						success:function(html) 
						{
	                        jQuery('#state').html(html);
			                jQuery('#city').html('<option value="">Select state first</option>'); 
						}
				});
	  }
	 

	 

	   
        jQuery('#country').on('change',function(){

        	
	        var countryID = $(this).val();
	        if(countryID == 100){
              $("#currencycode").text("(₹)");
        	 }
        	  var countryID = $(this).val();
	        if(countryID == 224){
              $("#currencycode").text("($)");
        	 }
        	 if(countryID == 77){
              $("#currencycode").text("(£)");
        	 }


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

                	$('#customstateid').val(stateID);
                    $('#city').html(html);

                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });


});
</script>
<script>
$(document).ready(function(){
	
  $("#region-trigger-1").click(function(){
  	$(".outercountry").toggle();
  	$('.outerstate').css('display', 'none');
  	$('.outercity').css('display', 'none');
    
  });

  $("#region-trigger-41").click(function(){
  	$(".outerstate").toggle();
  	$('.outercountry').css('display', 'none');
  	$('.outercity').css('display', 'none');
  	
    
  });
   $("#region-trigger-42").click(function(){
  	$(".outercity").toggle();
  	$('.outerstate').css('display', 'none');
  	$('.outercountry').css('display', 'none');
  	});

 
 /* $("input[name='gender']").click(function(){
   var radioValue = $("input[name='gender']:checked"). val();
  	window.location.replace("http://demosrvr.com/wp/getabusiness/buy-a-business/");
  	   $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'radioValue='+radioValue,
                success:function(html){

               // 	alert(html);
                //	die();

               window.location.replace("http://demosrvr.com/wp/getabusiness/buy-a-business/");

                }
        }); 

	  
  	});


  $("input[name='ucity']").click(function(){
   var radioValue = $("input[name='ucity']:checked"). val();
  		window.location.reload();
  	   $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'ucity='+radioValue,
                success:function(html){

                     	window.location.reload();

                }
        }); 

	  
  	});
  $("input[name='ucity11']").click(function(){

   var radioValue = $("input[name='ucity11']:checked"). val();
  		window.location.reload();
  	   $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'ucity11='+radioValue,
                success:function(html){

                     	window.location.reload();

                }
        }); 

	  
  	});*/

  


});
</script>
<style type="text/css">
	.input-checkbox input:checked ~ .checkmark,
	.checkmark.white { border-color: #fff; }
	.checkmark.white:after { border-color: #fff; }

  .outercounrycontent, .outersatecontent, .outercitycontent{position:relative; width:100%; height:auto;} 
  .trigger i {width:15px; height:15px; font-size:24px; color:#fff; cursor:pointer;}

/*  .outerstate {width:100%; position:absolute; top:100%; left:0; padding:10px; background:#ffa733; z-index:10; box-shadow: 0 0 19px 3px #2a2a2a80; max-height:400px; overflow-y: scroll;}  */

.outercountry .form-control-label i,
.outercity .form-control-label i, 
.outerstate .form-control-label i {display:none!important;}

.outercountry .form-control-label:before, 
.outerstate .form-control-label:before,
.outercity .form-control-label:before
{
	content:"\f002";
	font-family:'Font Awesome 5 Pro';
	font-size:18px;
	display:inline-block;
}


.location_filter .outercity, .location_filter .outerstate, .location_filter .outercountry { display:block; clear:both; max-height:400px; overflow-y: scroll; width: 100%;
overflow-x: hidden; }

.filter_section .location_filter input[type="submit"] {background:#404040; border-color:#404040; }



</style>