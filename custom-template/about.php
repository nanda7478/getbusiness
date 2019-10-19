<?php
/**
 * Display Template Name: About Us
 */

get_header(); ?>

<?php $image = get_field('about_header_image');?>
<section class="about_us_banner" style="background: url(<?php echo $image['url'];?>); background-size: cover;">
	
<div class="container">
<div class="row">
<div class="col-12">
<div class="caption_aera">
<div class="section-heading">
<h2><?php the_field('about_title');?> </h2>
</div>
<div class="bradcrumbs"><a href="<?php echo site_url();?>">Home</a> / <?php the_field('about_title');?> </div>
</div>
</div>
</div>
</div>
</section>

<section class="about_details">
	<div class="container">
		<?php 
		while(have_rows('about_repeater_section')): the_row();
		$image = get_sub_field('about_section_image');
		?>
		<div class="row">
			<div class="col-md-8 col-lg-9">

				<div class="about_details_content">
						<h2> <?php the_sub_field('about_section_title');?> </h2>
						<div class="decription"> 
						<?php the_sub_field('about_section_content');?>
                       </div>

<div class="view_btn">
<a href="<?php the_sub_field('view_more_button_url');?>" class="btn"><?php the_sub_field('view_more_button_title');?></a>
</div>
</div>
</div>
<div class="col-md-4 col-lg-3">
	<div class="about_img" style="background: url(<?php echo $image['url'];?>);">
	</div>
</div>
</div>
<?php endwhile;?>
</div>
</section>

<section class="history_section">
	<div class=" container"> 
		<?php 
		while(have_rows('our_history_repeater')): the_row();
		$image = get_sub_field('our_history_image');
		?>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="history-bg" style="background: url(<?php echo $image['url'];?>);">


</div>
</div>
	<div class="col-lg-6 col-md-6">
	<div class="history-content">
		<h2><?php the_sub_field('our_history_title');?></h2>
		<?php the_sub_field('our_history_content');?>
		</div>
		</div>

</div>
<?php endwhile;?>
</div>

</section>

<section class="about_testimonials">
	<div class=" container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="section-heading">
					<h2><?php the_field('testimonial_title');?></h2>
				</div>
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
  	<?php
  	$i = 0;
  	while(have_rows('testimonial_repeater_section', 'option')): the_row();
     $image = get_sub_field('testimonial_image');
  	?>
    <li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){ echo 'active'; } ?>"> 
    	<div class="test-img"><img src="<?php echo $image['url'];?>" alt="Los Angeles"></div></li>
   <?php
   $i++;
endwhile;
?>
   <!--  <li data-target="#demo" data-slide-to="1"> 
    	<div class="test-img"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/07/text2.jpg" alt="Chicago"></div></li>
    <li data-target="#demo" data-slide-to="2"> 
    	<div class="test-img"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/07/test1.jpg" alt="New York"></div></li> -->
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
<?php
  	$i = 0;
  	while(have_rows('testimonial_repeater_section', 'option')): the_row();
  	?>
    <div class="carousel-item <?php if($i==0){ echo 'active'; } ?>">
  <div class="test_content">
<?php the_sub_field('testimonial_content');?>
<div class="name_date"><?php the_sub_field('testimonial_name');?>, <?php the_sub_field('designation');?> <span>(<?php the_sub_field('testimonial_date');?>)</span> </div>
<div class="sign"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/07/sign1.png"> </div>
   </div>
    </div>
     <?php
   $i++;
endwhile;
?>
    <!-- <div class="carousel-item">
    <div class="test_content">
<p>We have been delighted with the results from our ‘pubs for sale/tenancy’ advertising campaign on Daltons.
 We have carried out lots of good quality interviews from Daltons enquiries and have 
signed up 2 new licensees already.</p>
<div class="name_date">Shelley Castle, Shepherd Neame <span>(01/08/2015)</span> </div>
<div class="sign"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/07/sign1.png"> </div>
   </div>
    </div> -->
  <!--   <div class="carousel-item">
    <div class="test_content">
<p>We have been delighted with the results from our ‘pubs for sale/tenancy’ advertising campaign on Daltons.
 We have carried out lots of good quality interviews from Daltons enquiries and have 
signed up 2 new licensees already.</p>
<div class="name_date">Shelley Castle, Shepherd Neame <span>(01/08/2015)</span> </div>
<div class="sign"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/07/sign1.png"> </div>
   </div>
    </div> -->
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
</div>

</div>
</div>
</div>
</section>

<?php get_footer(); ?>
