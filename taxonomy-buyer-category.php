<?php
/*
The template for displaying archive pages
*/
get_header();
?>
 <?php 

$term = get_queried_object();
 $get_cat = $term->slug;
?>

<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="#">Home</a> / <span>Active Buyer Listing</span>
			</div>
		</div>
	</div>
</section>

<section class="buy_a_franchise">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="franchise_filter">
					<h4><?php echo get_field('franchies_side_head','13'); ?></h4>

					<form method="post">
						
<div class="form-group"> 

<?php

$taxonomy = 'buyer-category';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy

if ( $terms && !is_wp_error( $terms ) ) :
?>
<select class="form-control">
    <ul>

        <?php foreach ( $terms as $term ) { ?>
            <option value="1"><li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li></option>
        <?php } ?>
    </ul>
    </select>
<?php endif;?>

</div>
<div class="form-group"> 

	


		<select id="brands" name="brands" class="form-control" autocomplete="off">

		<option value="-1">Country</option>


<?php
 
$field = get_field_object('country',499);
if( $field['choices'] ): ?>
    
        <?php foreach( $field['choices'] as $value => $label ): ?>
           <option value="-1"><?php echo $label; ?></option>
        <?php endforeach; ?>
 
<?php endif; 

		

	?>
</select>
	
</div>
<div class="form-group"> 
<select class="form-control">
	<option value="1">Location</option>
	<option value="1">Location</option>
	<option value="1">Location</option>
	<option value="1">Location</option>
	<option value="1">Location</option>
	<option value="1">Location</option>
	<option value="1">Location</option>
</select>
</div>
<div class="form-group"> 
<select class="form-control">
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
	<option value="1">Investment Range</option>
</select>
</div>

<div class="form-group"> 
<a href="#" class="btn">Search</a>
</div>
</form>


<div class="top_active_buyer-category">
	
	<h4><?php echo get_field('bussiness_title','13'); ?></h4>

	<?php

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

	

 </div>
 </div>
</div>

<div class="col-md-9">
<div class="franchise_content_wrapper">
	<div class="section-heading">
<h1><?php echo get_field('buyer_listing_tittle','251'); ?></h1>
<?php echo get_field('buyer_listing_content','251'); ?>
 </div>

<div class="row">

<!--pagination-->
<?php 

$args = array(

'post_type' => 'active-buyer' , 'posts_per_page' => get_option('to_count_active-buyer'), 'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
'tax_query'=> array(
array(
'taxonomy'=>'buyer-category',
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