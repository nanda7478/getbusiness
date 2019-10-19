<?php
/*
 Display Template Name: Buy Franchise
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
if($_POST['submit'] == 'Reset'){
   unset($_SESSION['filterserch']);
     unset($_SESSION['countrycode']);
     unset($_SESSION['statecode']);
     unset($_SESSION['citycode']);

     wp_redirect('http://demosrvr.com/wp/getabusiness/buy-a-franchise');
exit;

}
?>
<?php
    function get_distinct_meta_values($meta_key, $type = 'active-buyer', $status = 'publish'){
      
        global $wpdb;
      
        $result = $wpdb->get_results( $wpdb->prepare( "
                SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
                LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                WHERE pm.meta_key = '%s'
                AND p.post_status = '%s'
                AND p.post_type = '%s'
                ORDER BY pm.meta_value ASC
            ", $meta_key, $status, $type
        ));
         
      
        return $result;
    }
?>

<?php
    function get_distinct_country_meta_values($meta_key, $type = 'active-buyer', $status = 'publish'){
      
        global $wpdb;
      
        $result = $wpdb->get_results( $wpdb->prepare( "
                SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
                LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                WHERE pm.meta_key = '%s'
                AND p.post_status = '%s'
                AND p.post_type = '%s'
                ORDER BY pm.meta_value ASC
            ", $meta_key, $status, $type
        ));
         
      
        return $result;
    }
?>

<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> / <span>Buy a Franchise</span>
			</div>
		</div>
	</div>
</section>






<section class="buy_a_franchise">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="franchise_filter">
					<h4> <span> Start a </span> New <span> Search </span> </h4>
<form class="franchise_search_form" name="search" action="" method="post">		
<div class="form-group select_box"> 
<span class="select_border"></span>
<?php

$taxonomy = 'franchise-category';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy

if ( $terms && !is_wp_error( $terms ) ) :
?>
<select class="form-control" name="frachise_cat">
<option value="">Franchise Category</option>
<?php foreach ( $terms as $term ) { ?>
 <option value="<?php echo $term->term_id; ?>" <?php echo ($_POST['frachise_cat'] == ''.$term->term_id.'') ? ' selected="selected"' : '';?>><?php echo $term->name; ?></option>
  <?php } ?>
    </select>
<?php endif;?>

</div>

<div class="filter_section">
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
               <li><a href="<?php echo bloginfo('url'); ?>/buy-a-franchise/?ctid=<?php echo $value->country_id; ?>" style="color: #fff;"><?php echo $value->country_name; ?></a></li>
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
                  <a href="<?php echo bloginfo('url'); ?>/buy-a-franchise/?<?php if($_GET['ctid']){ echo 'ctid='.$_GET['ctid'].'&'; } ?>ctstid=<?php echo $value->state_id; ?>" style="color: #fff;"><?php echo $value->state_name; ?></a>
               </li>
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
               <li><a href="<?php echo bloginfo('url'); ?>/buy-a-franchise/?<?php if($_GET['ctstid']){ echo 'ctstid='.$_GET['ctstid'].'&'; } ?><?php if($_GET['ctid']){ echo 'ctid='.$_GET['ctid'].'&'; } ?>ctctid=<?php echo $value->city_id; ?>" style="color: #fff;"><?php echo $value->city_name; ?></a></li>
               <?php
                  }
                  ?>
               <div class="show-more-country">Show more</div>
            </ul>
         </div>
      </div>
   </div>
</div>





<!-- <div class="form-group select_box"> 
<span class="select_border"></span>
<select id="country" class="form-control" name="country_name">
<option value="">Select Country</option>
<?php 
  $result = get_distinct_country_meta_values('country', 'franchise', 'publish');
  foreach ( $result as $val ) :
  ?>
 <option value="<?php echo $val->meta_value;?>" <?php echo ($_POST['country_name'] == ''.$val->meta_value.'') ? ' selected="selected"' : '';?>><?php echo $val->meta_value;?></option>
<?php endforeach; ?>
</select>
	
</div> -->
<!-- <div class="form-group select_box"> 
	<span class="select_border"></span>
<select class="form-control" name="location_type">
	<option value="">Select Location</option>
	  <?php 
  $result = get_distinct_meta_values('location', 'franchise', 'publish');
  foreach ( $result as $val ) :
  ?>
 <option value="<?php echo $val->meta_value;?>" <?php echo ($_POST['location_type'] == ''.$val->meta_value.'') ? ' selected="selected"' : '';?>><?php echo $val->meta_value;?></option>
<?php endforeach; ?>
</select>
</div> -->
<!-- <div class="form-group select_box"> 
	<span class="select_border"></span>
<select class="form-control" name="investment_range">
<option value="">Investment Range</option>
<option value="LESS THAN $50,000">LESS THAN $50,000</option>
<option value="$50,000 TO $100,000">$50,000 TO $100,000</option>
<option value="$100,000 TO $250,000">$100,000 TO $250,000.</option>
<option value="$250,000 TO $500,000">$250,000 TO $500,000</option>
<option value="$500,000 TO $750,000">$500,000 TO $750,000</option>
<option value="$750,000 TO $10,00,000">$750,000 TO $10,00,000</option>
<option value="$1 Million AND ABOVE">$1 Million AND ABOVE</option>  
</select>
</div> -->
<div class="from-group"> 
<span></span>
<input type="number" name="price_from" placeholder="Price From" class="from-control" value="<?php echo $_POST['price_from'];?>">
</div>

<div class="from-group"> 
<span></span>
<input type="number" name="price_to" placeholder="Price To" class="from-control" value="<?php echo $_POST['price_to'];?>">
</div>

<div class="form-group"> 
<input type="submit" name="submit" value="Search" class="btn">
</div>
</form>


<div class="top_bussiness_category">
	
	<h4><?php //echo get_field('bussiness_title'); ?> <span>Top</span> Businesses</h4>

<?php
$taxonomy = 'franchise-category';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy

if ( $terms && !is_wp_error( $terms ) ) :
?>
    <ul>
        <?php foreach ( $terms as $term ) { ?>
            <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
    </ul>
<?php endif;?> 

	

 </div>
 <div class="reset-btn">
<form  name="resetform"  method="post">  
              <!-- <span class="form-control-label"><img src="../images/search_icon.png"></span> -->
              <input class="form-control" type="submit" name="submit" value="Reset">
            </form>
            </div>
 </div>
</div>

<div class="col-md-8 col-lg-8">
<div class="franchise_content_wrapper">
<?php while(have_posts()): the_post();?>
<div class="section-heading">
<h1><?php echo get_field('franchies_title'); ?></h1>
<?php echo get_field('franchies_content'); ?>
 </div>
<?php endwhile;?>

<div class="row">

<!--pagination-->



<?php
global $wp_query;
$frchise_cat = $_POST['frachise_cat'];
$country_name = $_POST['country_name'];
$location_type = $_POST['location_type'];
$price_from = $_POST['price_from'];
$price_to = $_POST['price_to'];

if($frchise_cat || $country_name || $location_type || $price_from || $price_to ){
?>

<?php
  $tax_query = array('relation'=>'AND');
  $meta_query = array('relation'=>'AND');

  if(!empty($frchise_cat)){ 
      $tax_query[] = array(
       'taxonomy' => 'franchise-category',
       'field' => 'term_id',
       'terms' => $frchise_cat
      );
     }


  if(!empty($country_name)){
    $meta_query[] = array(
       'key' => 'country',
        'value' => $country_name,
        'compare' => 'LIKE'
        
      );
  }
  if(!empty($location_type)){
    $meta_query[] = array(
       'key' => 'location',
        'value' => $location_type,
        'compare' => 'LIKE'
        
      );
  }

 if( isset($price_from) && ($price_from != 'any') && isset($price_to) && ($price_to != 'any') ){
        $price_from = doubleval($_POST['price_from']);
        $price_to = doubleval($_POST['price_to']);
        if( $price_from >= 0 && $price_to > $price_from ){

            $meta_query[] = array(
                'key' => 'investment_from',
                'value' => $price_from,
                'type' => 'NUMERIC',
                'compare' => '>='
            );

            $meta_query[] = array(
                'key' => 'investment_to',
                'value' => $price_to,
                'type' => 'NUMERIC',
                'compare' => '<='
            );

        }
    }elseif( isset($price_from) && ($price_from != 'any') ){
        $price_from = doubleval($_POST['price_from']);
        if( $price_from > 0 ){
            $meta_query[] = array(
                'key' => 'investment_from',
                'value' => $price_from,
                'type' => 'NUMERIC',
                'compare' => '>='
            );
        }
    }elseif( isset($price_to) && ($price_to != 'any') ){
        $price_to = doubleval($_POST['price_to']);
        if( $price_to > 0 ){
            $meta_query[] = array(
                'key' => 'investment_to',
                'value' => $price_to,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        }
    }








$args = array('post_type' => 'franchise', 'posts_per_page' => -1, 'order' => 'DASC', 'tax_query' => $tax_query, 'meta_query' => $meta_query,);
echo 'testing';
echo '<pre>';   
print_r($args);
echo '<pre>';

die();









$query = new WP_Query($args);
if ( $query->have_posts() ){
while($query->have_posts()): $query->the_post();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
?>



        <div class="col-lg-4 col-md-6  mb-20">
				 <div class="sale_listing">
					<a href="<?php the_permalink();?>"><div class="sale_pic">
		        

<img src="<?php echo $image[0]; ?>" alt="" />
		    
					</div></a>
	<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
	<p class="discription"><?php
$char_limit = 50; //character limit
$content = $post->post_content; //contents saved in a variable
echo substr(strip_tags($content), 0, $char_limit);
?>
		
	</p>
                    <div class="more_details">
					<a href="<?php the_permalink();?>">More Details</a>
					</div>
                  </div>
				</div>
        <?php endwhile; ?>  


<!--pagination-->

</div>
</div>
 <?php
wp_reset_postdata();
} else {
?>
<h2>There is no data</h2>

<?php } ?>

<?php } else { ?>
<?php



 if($_GET['ctstid'] ||  $_GET['ctid'] || $_GET['ctctid']){



  $countrycode =  $_GET['ctid'];
    


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
    $args = array('post_type' => 'franchise', 'posts_per_page' => 6,  'order' => 'DASC',
    'meta_query' => $meta_query,
    'paged' => $paged);
    $query = new WP_Query($args);


 }else{
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array('post_type' => 'franchise', 'posts_per_page' => 6, 'order' => 'DASC', 'paged' => $paged);

 }





$query = new WP_Query($args);
if ( $query->have_posts() ):
while($query->have_posts()): $query->the_post();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
?>



        <div class="col-lg-4 col-md-6  mb-20">
				 <div class="sale_listing">
					<a href="<?php the_permalink();?>"><div class="sale_pic">
		        

<img src="<?php echo $image[0]; ?>" alt="" />
		    
					</div></a>
	<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
	<p class="discription"><?php
$char_limit = 50; //character limit
$content = $post->post_content; //contents saved in a variable
echo substr(strip_tags($content), 0, $char_limit);
?>
		
	</p>
                    <div class="more_details">
					<a href="<?php the_permalink();?>">More Details</a>
					</div>
                  </div>
				</div>
        <?php endwhile; ?>  


<!--pagination-->

</div>
</div>



<div class="pagination_bar">
<nav class="pagination1">
        <?php pagination_bar( $query ); ?>
    </nav>
    </div>
 <?php
wp_reset_postdata();
endif;
?>
<?php } ?>

</div>
</div>
</div>
</section>




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

               //   alert(html);
                //  die();

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


.section-heading h1{
  margin-top: -10px;
}
</style>