<?php
/*
The template for displaying archive pages
*/
get_header();
?>
<section class="fliter_listing_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="filter_section">
					<h2>Filter By</h2>
					<div class="business_category_filter">
					<?php
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
         <a href="<?php echo get_term_link($term->slug, 'business-category');?>">
            <input type="radio" value="<?php echo $term->term_id; ?>" name="listing_tags" class="listing_tag_list_ckb" <?php if ( $i == 0 ) { ?>checked<?php } ?>>
            <label class="listing_tag_list_ckbl">
                <?php echo $term->name; ?>
            </label>
            </a>
        </div>
<?php
    $i++; endforeach;
endif; ?>
      </div>

      <div class="location_filter">
		<form role="form">
		<div class="row">
		<div class="col-xs-12">
		<div class="input-group input-group-sm">
		<input id="my-search" class="form-control" placeholder="Location" type="text">
		</div>
		</div>
		</div>
		</form>
		<ul id="my-tree">
			<li>
				<div>Asia</div>
				<ul>
				<li>
				<div>India</div>
                <ul>
				<li><div>Andhra Pradesh</div></li>
				<li><div>Arunachal Pradesh</div></li>
				<li>
				<div>Rajasthan</div>
				<ul>
                <li><div>Jaipur</div></li>
				<li><div>Jaisalmer</div></li>
				</ul>
				</li>
			   </ul>
				</li>
				<li><div>Pakistan</div></li>
				<li><div>Butan</div></li>
				<li><div>Indonesia</div></li>
				<li><div>Vietnam</div></li>
				<li><div>malaysia</div></li>
				<li><div>China</div></li>
				<li><div>North Korea</div></li>
				<li><div>South Korea</div></li>
				<li><div>Japan</div></li>
				<li><div>Mongol</div></li>
				<li><div>kazakhstan</div></li>
				<li><div>kyrgyzstan</div></li>
				</ul>
			</li>
			<li>
				<div>Africa</div>
				<ul>
					<li><div>Moroco</div></li>
					<li><div>Egypt</div></li>
					<li><div>Ghana</div></li>
				</ul>
			</li>
			<li>
				<div>Europe</div>
				<ul>
					<li><div>United Kingdom</div></li>
					<li><div>Sweden</div></li>
					<li><div>Germany</div></li>
					<li><div>France</div></li>
					<li><div>Spain</div></li>
					<li><div>Italy</div></li>
					<li><div>Austria</div></li>
					<li><div>Turkey</div></li>
					<li><div>Russia</div></li>
					<li><div>Denmark</div></li>
					<li><div>Finland</div></li>
					<li><div>Iceland</div></li>
					<li><div>Switzerland</div></li>
					<li><div>Hungary</div></li>
				</ul>
			</li>
			<li><div>North America</div>
				<ul>
					<li><div>USA</div></li>
					<li><div>Canada</div></li>
					<li><div>Mexico</div></li>
					<li><div>Panama</div></li>
					<li><div>Cuba</div></li>
				</ul>
			</li>
			<li>
				<div>South America</div>
				<ul>
					<li><div>Columbia</div></li>
					<li><div>Argentina</div></li>
					<li><div>Brazil</div></li>
					<li><div>Chile</div></li>
					<li><div>Peru</div></li>
					<li><div>Venezuela</div></li>
				</ul>
			</li>
			<li>
				<div>Oceania</div>
				<ul>
					<li><div>Austrailia</div></li>
					<li><div>New kaledonia</div></li>
					<li><div>New Zealand</div></li>
				</ul>
			</li>
		</ul>
      </div>


      <div class="type_of_business_filter">
      <form role="form">
		<div class="row">
		<div class="col-xs-12">
		<div class="input-group input-group-sm">
		<input id="my-search1" class="form-control" placeholder="Type Of Business" type="text">
		</div>
		</div>
		</div>
		</form>
      	<div class="business_type_filter">
	<?php
$taxonomies = array( 
    'business-type'
);
$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false
);

$terms = get_terms($taxonomies,$args);
?>
<ul id="my-tree1">
<?php
    foreach ($terms as $term): ?>
    <li>
        <div>
            <input type="checkbox" value="<?php echo $term->term_id; ?>" name="listing_tags" class="listing_tag_list_ckb">
            <label class="listing_tag_list_ckbl">
                <?php echo $term->name; ?>
            </label>
        </div>
        </li>
<?php
    endforeach;
    ?>
    </ul>
      </div>
      </div>

      <div class="price_filter_section">
      	<h4>Price</h4>
      	<p>Asking Price (£)</p>
      	<form action="">
      		<div class="row">
      			<div class="col-lg-4">
      				<input type="text" name="from_price" class="form-control" placeholder="From">
      			</div>
      			<div class="col-lg-4">
      				<input type="text" name="to_price" class="form-control" placeholder="To">
      			</div>
      			<div class="col-lg-4">
      				<input class="form-control" type="submit" name="submit" value="Search">
      			</div>
      		</div>
      	</form>
      </div>

				</div>
			</div>
			<div class="col-lg-8">
            <div class="listing_section">
            	<div class="row">
                    <?php
              
			 while(have_posts()): the_post();
			 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			 ?>
            		<div class="col-lg-6">
            			 <div class="sale_listing">
					<div class="sale_pic">
						<a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $large_image_url[0]);?>"></a>
					</div>
					<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php $price = get_post_meta( get_the_ID(), '_business_price', 1 );?>
					<?php if($price){ ?>
					<p class="price"><span>Price:</span> $<?php echo $price;?></p>
					<?php } ?>
					<?php $offer_price = get_post_meta( get_the_ID(), '_business_offer_price', 1 );?>
					<?php if($offer_price){ ?>
					<p class="price"><span>Price:</span> <?php echo $offer_price;?></p>
					<?php } ?>
					<p class="location"><span>Location:</span> <?php echo get_post_meta( get_the_ID(), '_business_location_text', 1 );?></p>
                    <div class="more_details">
					<a href="<?php the_permalink();?>">More Details</a>
					</div>
                  </div>
            		</div>
               <?php
				endwhile;
				?>
            	</div>
            </div>

			</div>
		</div>
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