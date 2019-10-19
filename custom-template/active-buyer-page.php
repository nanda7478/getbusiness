<?php
/*
 Display Template Name: Active Buyer
*/
get_header();
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
				<a href="<?php echo site_url();?>">Home</a> / <span>Active Buyer</span>
			</div>
		</div>
	</div>
</section>


<section class="active-buyers"> 
<div class="container">
<div class="row">
<div class="col-md-4"> 
<div class="active-buyer-filter">
<h4>Top <span>Businesses</span> Search</h4>

<ul>
	<li><?php

$taxonomy = 'buyer-category';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy

if ( $terms && !is_wp_error( $terms ) ) :
?>
    <ul>
        <?php foreach ( $terms as $term ) { ?>
            <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
    </ul>
<?php endif;?>  

<h4>Start  <span>A New</span> Search </h4>


<form class="active-buyers-form" name="search" action="" method="post">

<div class="from-group"> 
<select class="form-control" name="country_name">
<option value="">Select Country</option>
<?php 
  $result = get_distinct_country_meta_values('country', 'active-buyer', 'publish');
  foreach ( $result as $val ) :
  ?>
 <option value="<?php echo $val->meta_value;?>" <?php echo ($_POST['country_name'] == ''.$val->meta_value.'') ? ' selected="selected"' : '';?>><?php echo $val->meta_value;?></option>
<?php endforeach; ?>
</select>

</div>

<div class="from-group"> 
<select class="from-control" name="location_type">
  <option value="">Select Location</option>
  <?php 
  $result = get_distinct_meta_values('location', 'active-buyer', 'publish');
  foreach ( $result as $val ) :
  ?>
 <option value="<?php echo $val->meta_value;?>" <?php echo ($_POST['location_type'] == ''.$val->meta_value.'') ? ' selected="selected"' : '';?>><?php echo $val->meta_value;?></option>
<?php endforeach; ?>
  
	</select>

</div>
<div class="from-group"> 
<span></span>
<input type="number" name="price_from" placeholder="Price From" class="from-control" value="<?php echo $_POST['price_from'];?>">
</div>

<div class="from-group"> 
<span></span>
<input type="number" name="price_to" placeholder="Price To" class="from-control" value="<?php echo $_POST['price_to'];?>">
</div>

<div class="from-group"> 
<span></span>
<input type="submit" name="submit" value="Search" class="btn">
</div>

 </form>



</div>
 </div>

<div class="col-md-8"> 
<div class="active-buyers-wrapper">
<?php while(have_posts()): the_post();?>
<div class="section-heading"> 
<h1><?php echo get_field('buyer_listing_tittle');?></h1>
 <?php echo get_field('buyer_listing_content');?>
</div>
<?php endwhile;?>
<?php
global $wp_query;
$country_name = $_POST['country_name'];
$location_type = $_POST['location_type'];
$price_from = $_POST['price_from'];
$price_to = $_POST['price_to'];
if($country_name || $location_type || $price_from || $price_to ){
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



 $args = array('post_type' => 'active-buyer', 'posts_per_page' => -1, 'order' => 'ASC', 'meta_query' => $meta_query,);
 /*echo '<pre>';   
        print_r($args);
         echo '<pre>';*/
 $query = new WP_Query($args);
 if ( $query->have_posts() ){
 while($query->have_posts()): $query->the_post();

 ?>
       <?php
            $author_id = get_the_author_meta('ID');
            $image = get_field('profile_image', 'user_'. $author_id );
             ?>
             <?php
$field = get_field_object('country');
$value = get_field('country');
$label = $field['choices'][ $value ];
?>
<div class="buyer-listing">

<div class="buyer-pic"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> <a href="#" class="btn">View >></a> </div>
<div class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
<div class="looking-for">
<ul class="buyer-details">
<li> <div class="icon"><i class="fas fa-map-marker-alt"></i> </div> <div class="description"> <h5> Desired location</h5>
<span><?php echo get_field('location');?>, <?php echo $label; ?></span> </div> </li>
<li> <div class="icon"><i class="fas fa-file-invoice-dollar"></i> </div> <div class="description"> <h5> Investment</h5>
<span>$<?php echo get_field('investment_from');?> - $<?php echo get_field('investment_to');?></span></div> </li>
<li> <div class="icon"><i class="fas fa-home"></i> </div> <div class="description"> <h5> Industry</h5>
<span><?php
    $terms = wp_get_post_terms( $post->ID, 'buyer-category');
    foreach ( $terms as $term ) {
       $term_link = get_term_link( $term );
       echo '<a href="' . $term_link . '">' . $term->name . '</a>' . ' ';
       }
  ?></span> </div> </li>
</ul>
</div>
 </div>

<?php
endwhile;
wp_reset_postdata();
} else {
?>
<h2>There is no data</h2>
<?php } ?>
<?php } else { ?>
  <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
       $args = array('post_type' => 'active-buyer', 'posts_per_page' => 6, 'order' => 'ASC', 'paged' => $paged);
       $query = new WP_Query($args);
       if ( $query->have_posts() ):
       while($query->have_posts()): $query->the_post();
      
       ?>
       <?php
            $author_id = get_the_author_meta('ID');
            $image = get_field('profile_image', 'user_'. $author_id );
             ?>
<?php
$field = get_field_object('country');
$value = get_field('country');
$label = $field['choices'][ $value ];
?>
<div class="buyer-listing">

<div class="buyer-pic"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> <a href="#" class="btn">View >></a> </div>
<div class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
<div class="looking-for">
<ul class="buyer-details">
<li> <div class="icon"><i class="fas fa-map-marker-alt"></i> </div> <div class="description"> <h5> Desired location</h5>
<span><?php echo get_field('location');?>, <?php echo $label; ?></span> </div> </li>
<li> <div class="icon"><i class="fas fa-file-invoice-dollar"></i> </div> <div class="description"> <h5> Investment</h5>
<span>$<?php echo get_field('investment_from');?> - $<?php echo get_field('investment_to');?></span></div> </li>
<li> <div class="icon"><i class="fas fa-home"></i> </div> <div class="description"> <h5> Industry</h5>
<span><?php
    $terms = wp_get_post_terms( $post->ID, 'buyer-category');
    foreach ( $terms as $term ) {
       $term_link = get_term_link( $term );
       echo '<a href="' . $term_link . '">' . $term->name . '</a>' . ' ';
       }
  ?></span> </div> </li>
</ul>
</div>
 </div>

<?php
        endwhile;
        ?>

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
 </div>
 </section>
<?php
get_footer();
?>