<?php
/**
 *  Display Template Name: Support
 */

get_header(); ?>
<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> <span>/ Support</span>
			</div>
		</div>
	</div>
</section>
<?php while(have_posts()): the_post();?>
<section class="privacy_policy_section">
	<div class="container">
	<div class="privacy_policy-wapper">

	<div class="section-heading"> <h2>Support</h2> </div>
<?php the_content();?>

</div>
</div>
</section>
<?php endwhile;?>
<?php get_footer(); ?>
