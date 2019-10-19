<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="page-404">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
		<div class="container">
		 	<div class="row">		
<div class="col-sm-12">
		 		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
					<h2> 404 </h2>
					<a href="<?php echo site_url();?>" class="theme-btn">home </a>
</div>
				</div>
			</div>

				</header><!-- .page-header -->

			 
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

		<?php get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->
 
<?php get_footer(); ?>
