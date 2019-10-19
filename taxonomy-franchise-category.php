<?php
/*
The template for displaying archive pages
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


 <?php 

$term = get_queried_object();
 $get_cat = $term->slug;
?>

<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="#">Home</a> / <span>Buy a Franchise</span>
			</div>
		</div>
	</div>
</section>

<section class="buy_a_franchise">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
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
<div class="form-group select_box"> 
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
	
</div>
<div class="form-group select_box"> 
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
</div>
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
	
	<h4> <span>Top</span> Businesses</h4>

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
 </div>
</div>

<div class="col-md-9">
<div class="franchise_content_wrapper">
	<div class="section-heading">
<h1><?php echo get_field('franchies_title','13'); ?></h1>
<?php echo get_field('franchies_content','13'); ?> 
 </div>

<div class="row">

<!--pagination-->
<?php /*$loop = new WP_Query(array('post_type' => 'franchise' , 'posts_per_page' => get_option('to_count_franchise'), 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 )
); 
*/

$args = array(

'post_type' => 'franchise' , 'posts_per_page' => get_option('to_count_franchise'), 'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
'tax_query'=> array(
array(
'taxonomy'=>'franchise-category',
'field'=>'slug',
'terms'=>$get_cat
)
)
);
$loop = new WP_Query( $args );


?>
    <?php while ( $loop->have_posts() ) : $loop->the_post(); 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
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
</div>


</div>

<?php

$big = 999999999; // need an unlikely integer
 echo paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $loop->max_num_pages
) );
?>
</div>

</section>
<?php
get_footer();
?>
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